<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Album Admin</title>
    <link rel="stylesheet" href="css/album.css">
    <style>
        .table {
            position: relative;
            top: 200px;
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
                <li><a href="logout.php"onclick="return confirm('Apakah Anda yakin ingin keluar?')">Keluar</a></li>
            </ul>
        <?php
        } else {
            echo "Level tidak terdeteksi atau Anda bukan admin.";
            exit(); // Hentikan eksekusi jika level tidak sesuai atau tidak ada sesi
        }
        ?>
    </ul>

    <div class="pinggir">
        <form action="tambah_album.php" method="post" style="border-color: darkgrey;" class="input">
            <table>
                <b>
                    <h3>Album</h3>
                </b>
                <tr>
                    <td>Nama Album</td>
                    <td><input type="text" name="namaalbum"></td>
                </tr>
                <tr>
                    <td>Deskripsi</td>
                    <td><input type="text" name="deskripsi"></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" value="Tambah"></td>
                </tr>
            </table>
        </form>

        <div class="table">
            <table border="1" cellpadding=5 cellspacing=0>
                <tr>
                    <th>ID</th>
                    <th>Nama album</th>
                    <th>Deskripsi</th>
                    <th>Tanggal dibuat</th>
                    <th>Aksi</th>
                </tr>
                <?php
                include "koneksi.php";
                $sql = mysqli_query($conn, "select * from album");
                while ($data = mysqli_fetch_array($sql)) {
                ?>
                    <tr>
                        <td><?= $data['albumid'] ?></td>
                        <td><?= $data['namaalbum'] ?></td>
                        <td><?= $data['deskripsi'] ?></td>
                        <td><?= $data['tanggaldibuat'] ?></td>
                        <td>
                            <a href="hapus_album.php?albumid=<?= $data['albumid'] ?>">Hapus</a>
                            <a href="edit_album.php?albumid=<?= $data['albumid'] ?>">Edit</a>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </table>
        </div>
    </div>
</body>

</html>
