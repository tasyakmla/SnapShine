
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Edit Album</title>
    
    <link rel="stylesheet" href="style.css">

    <link rel="stylesheet" href="css/album.css">
</head>
<body>
    

<ul class="navbar">
        <li>
            <h2>SnapShine</h2>
        </li>
        <?php
        // kondisi untuk guest
        session_start();
        if (!isset($_SESSION['userid'])) {
        ?>
            <ul>
                <li><a href="daftar.php">Daftar</a></li>
                <li><a href="masuk.php">Masuk</a></li>
            </ul>
            <?php
        } else {
            // Mendapatkan informasi level pengguna dari sesi atau tabel user
            $level = isset($_SESSION['level']) ? $_SESSION['level'] : '';

            // Kondisi untuk user
            if ($level == 'user') {
            ?>
                <ul>
                    <li><a href="user.php">Beranda</a></li>
                    <li><a href="album.php">Album</a></li>
                    <li><a href="foto.php">Foto</a></li>
                    <li><a href="logout.php"onclick="return confirm('Apakah Anda yakin ingin keluar?')">Keluar</a></li>
                </ul>

            <?php
                // kondisi untuk admin
            } elseif ($level == 'admin') {
            ?>
                <ul>
                    <li><a href="user.php">Beranda</a></li>
                    <li><a href="album.php">Album</a></li>
                    <li><a href="foto.php">Foto</a></li>
                    <li><a href="data-user.php">Data User</a></li>
                    <li><a href="logout.php"onclick="return confirm('Apakah Anda yakin ingin keluar?')">Keluar</a></li>
                </ul>
            <?php
                // Kondisi untuk level tidak terdeteksi
            } else {
                // Tindakan yang diambil ketika level tidak terdeteksi
                echo "Level tidak terdeteksi";
            }

            ?>



    </ul>
<?php
        }
?>  <form action="update_album.php" method="post" class="input">
        <?php
            include "koneksi.php";
            $albumid=$_GET['albumid'];
            $sql=mysqli_query($conn,"select * from album where albumid='$albumid'");
            while($data=mysqli_fetch_array($sql)){
        ?>
        <input type="text" name="albumid" value="<?=$data['albumid']?>" hidden>
        <table>
            <tr>
                <td>Nama Album</td>
                <td><input type="text" name="namaalbum" value="<?=$data['namaalbum']?>"></td>
            </tr>
            <tr>
                <td>Deskripsi</td>
                <td><input type="text" name="deskripsi" value="<?=$data['deskripsi']?>"></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" value="Ubah"></td>
            </tr>
        </table>
        <?php
            }
        ?>
    </form>

    
</body>
</html>