<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Foto</title>
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
    </style>
</head>

<body>

    <body>
        <ul class="navbar">
            <li>
                <h2>SnapShine</h2>
            </li>
            <?php
            session_start();
            // kondisi untuk user atau admin
            if (isset($_SESSION['userid'])) {
                if ($_SESSION['level'] == 'admin') {
            ?>
                    <ul>
                        <li><a href="user.php">Beranda</a></li>
                        <li><a href="album.php">Album</a></li>
                        <li><a href="foto.php">Foto</a></li>
                        <li><a href="logout.php" onclick="return confirm('Apakah Anda yakin ingin keluar?')">Keluar</a></li>
                    </ul>
                <?php
                } elseif ($_SESSION['level'] == 'user') {
                ?>
                    <ul>
                        <li><a href="user.php">Beranda</a></li>
                        <li><a href="album.php">Album</a></li>
                        <li><a href="foto.php">Foto</a></li>
                        <li><a href="logout.php" onclick="return confirm('Apakah Anda yakin ingin keluar?')">Keluar</a></li>
                    </ul>
            <?php
                } else {
                    echo "Level tidak terdeteksi.";
                    exit(); // Hentikan eksekusi jika level tidak sesuai
                }
            } else {
                echo "Anda belum login.";
                exit(); // Hentikan eksekusi jika tidak ada sesi
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

                    // Mendapatkan userid dari sesi yang sedang aktif
                    $userid = $_SESSION['userid'];

                    // Mengambil data album berdasarkan userid
                    $sql = mysqli_query($conn, "SELECT * FROM album WHERE userid = $userid");

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
            // Ambil user id dari sesi
            $userId = $_SESSION['userid'];

            // Mengambil data foto dari user yang sedang login
            $sql = mysqli_query($conn, "SELECT * FROM foto, album WHERE foto.albumid = album.albumid AND foto.userid = '$userId'");
            while ($data = mysqli_fetch_array($sql)) {
            ?>
                <ul class="card-list">
                    <li class="card">
                        <img src="gambar/<?= $data['lokasifile'] ?>" alt=<?= $data['judulfoto'] ?> />
                        <a class="card-description" href="https://michellezauner.bandcamp.com/album/psychopomp-2" target="_blank">
                            <h2 class="card-description2">Judul:<?= $data['judulfoto'] ?></h2>
                            <p class="card-description2">Deskripsi:<?= $data['deskripsifoto'] ?></p>
                            <p class="card-description2">Tanggal Unggah: <?= $data['tanggalunggah'] ?></p>
                        </a>
                        <div class="button">
                            <div class="like">
                                <a href="like-admin.php?fotoid=<?= $data['fotoid'] ?>">Like</a>
                                <?php
                                $fotoid = $data['fotoid'];
                                $sql2 = mysqli_query($conn, "SELECT * FROM likefoto WHERE fotoid = '$fotoid'");
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