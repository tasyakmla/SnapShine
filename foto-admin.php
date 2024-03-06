<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Foto Admin</title>
    <link rel="stylesheet" href="css/foto-admin.css">
    <style>
        .daftar-foto {
            position: absolute;
            margin-top: 20px;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .daftar-foto div {
            border: 1px solid #ccc;
            /* Menambahkan garis pembatas antara foto */
            padding: 10px;
            /* Menambahkan ruang di sekitar setiap foto */
            margin-bottom: 20px;
            /* Menambahkan jarak antara setiap foto */
        }

        .daftar-foto img {
            width: 200px;
            /* Atur lebar gambar */
            height: 150px;
            /* Atur tinggi gambar */
            object-fit: cover;
            /* Pastikan gambar diisi dan tidak distorsi */
            margin-bottom: 10px;
        }

        .userr{
            font-weight: bold;
        }
    </style>
</head>

<body>
    <ul class="navbar">
        <li>
            <h2>SnapShine</h2>
        </li>
        <?php
        session_start();
        // kondisi untuk admin
        if (isset($_SESSION['userid']) && isset($_SESSION['level']) && $_SESSION['level'] == 'admin') {
        ?>
            <ul>
                <li><a href="admin.php">Beranda</a></li>
                <li><a href="album-admin.php">Album</a></li>
                <li><a href="foto-admin.php">Foto</a></li>
                <li><a href="data-user.php">Data User</a></li>
                <li><a href="logout.php" onclick="return confirm('Apakah Anda yakin ingin keluar?')">Keluar</a></li>
            </ul>
        <?php
        } else {
            echo "Level tidak terdeteksi atau Anda bukan admin.";
            exit(); // Hentikan eksekusi jika level tidak sesuai atau tidak ada sesi
        }
        ?>
    </ul>

    <form action="tambah_foto.php" method="post" enctype="multipart/form-data" class="upload">
        <h3>Upload Foto</h3>
        <table>
            <tr>
                <td>Judul</td>
                <td><input type="text" name="judulfoto"></td>
            </tr>
            <tr>
                <td>Deskripsi</td>
                <td><input type="text" name="deskripsifoto"></td>
            </tr>
            <tr>
                <td>Picture</td>
                <td><input type="file" name="lokasifile"></td>
            </tr>
            <tr>
                <td>Album</td>
                <td>
                    <select name="albumid">

                        <?php
                        include "koneksi.php";

                        // Mengambil data album dari semua user
                        $sql = mysqli_query($conn, "SELECT * FROM album");

                        // Melakukan iterasi melalui hasil query untuk menampilkan opsi album dalam formulir
                        while ($data = mysqli_fetch_array($sql)) {
                        ?>
                            <option value="<?= $data['albumid'] ?>">
                                <?= $data['namaalbum'] ?>
                            </option>
                        <?php
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" value="Tambah" class="add"></td>
            </tr>
        </table>
    </form>



    <div class="daftar-foto">
        <?php
        include "koneksi.php";
        $sql = mysqli_query($conn, "SELECT * FROM foto
        INNER JOIN album ON foto.albumid = album.albumid
        INNER JOIN user ON foto.userid = user.userid");

        while ($data = mysqli_fetch_array($sql)) {
        ?>
            <ul class="card-list">

                <li class="card">
                    <?php if (isset($data['username'])) : ?>
                    <?php endif; ?>
                    
                    
                    <p class="userr">‣<?= $data['username'] ?></p>
                    <img src="gambar/<?= $data['lokasifile'] ?>" alt="<?= $data['judulfoto'] ?>" />

                        <h2 class="card-description2">Judul:<?= $data['judulfoto'] ?></h2>
                        <p class="card-description2">Deskripsi:<?= $data['deskripsifoto'] ?></p>
                        <p class="card-description2">tanggal unggah: <?= $data['tanggalunggah'] ?></p>
                    

                    <div class="button">
                        <div class="like">
                            <a href="like-admin.php?fotoid=<?= $data['fotoid'] ?>">Like</a>
                            <?php
                            $fotoid = $data['fotoid'];
                            $sql2 = mysqli_query($conn, "select * from likefoto where fotoid='$fotoid'");
                            echo mysqli_num_rows($sql2);
                            ?>
                        </div>
                        <div class="komentar">
                            <a href="komentar-admin.php?fotoid=<?= $data['fotoid'] ?>">Komentar</a>
                        </div>
                        <div class="aksi">
                            <a href="hapus_album.php?albumid=<?= $data['albumid'] ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus album ini?')">Hapus</a>
                            <a href="edit_album.php?albumid=<?= $data['albumid'] ?>">Edit</a>
                        </div>
                    </div>
                </li>



            </ul>

        <?php
        }
        ?>
    </div>


</body>

</html>