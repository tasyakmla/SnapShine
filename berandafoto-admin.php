<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Admin</title>
    <link rel="stylesheet" href="css/beranda.css">
    <link rel="stylesheet" href="css/admin-beranda.css">
    <style>
        /* ... (style yang sudah ada) ... */
        /* Menambahkan gaya khusus untuk konten daftar */
        .daftar-foto {
            overflow-y: auto;
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

        ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
        }

        ul li {
            display: inline;
            margin-right: 10px;

        }

        .navbar li {
            display: inline;
            margin-right: 10px;
            text-align: center;
            float: left;
            font-size: 10px;
        }

        .navbar ul {
            padding-top: 15px;
        }

        .button {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 8px;
        }

        .like {
            background-color: #9e7481;
            color: white;
            padding: 8px 12px;
            border-radius: 5px;
            text-decoration: none;
            display: inline-block;
        }

        .like a {
            color: white;
            text-decoration: none;
        }

        .like:hover {
            background-color: #944E63;
        }

        .komentar {
            background-color: #9e7481;
            color: white;
            padding: 8px 12px;
            border-radius: 5px;
            text-decoration: none;
            display: inline-block;
        }

        .komentar a {
            color: white;
            text-decoration: none;

        }

        .komentar:hover {
            background-color: #944E63;
        }

        .card-description {
            text-align: left;
            font-size: 10px;
        }

        .card-description2 {
            text-align: left;
            font-size: 9px;
        }
    </style>
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
                    <li><a href="admin.php">Beranda</a></li>
                    <li><a href="album-admin.php">Album</a></li>
                    <li><a href="foto-admin.php">Foto</a></li>
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
?>

<div class="cek">
    <h3>Selamat datang <b><?= $_SESSION['namalengkap'] ?></h3>
</div>
<div class="daftar-foto">
<?php
include "koneksi.php";

// Pastikan parameter albumid telah diterima dari URL
if (isset($_GET['albumid'])) {
    $albumid = $_GET['albumid'];

    // Selanjutnya, gunakan $albumid dalam kueri SQL untuk mengambil foto berdasarkan album
    $sql = mysqli_query($conn, "SELECT foto.*, user.namalengkap, user.username FROM foto
                                INNER JOIN user ON foto.userid = user.userid
                                WHERE foto.albumid = '$albumid'");

    while ($data = mysqli_fetch_array($sql)) {
?>

        <ul class="card-list">

            <li class="card">
                <img src="gambar/<?= $data['lokasifile'] ?>" alt="<?= $data['judulfoto'] ?>" />

                <a class="card-description" href="https://michellezauner.bandcamp.com/album/psychopomp-2" target="_blank">
                    <h2><?= $data['namalengkap'] ?></h2>
                    <h2 class="card-description2">Username: <?= $data['username'] ?></h2>
                    <h2 class="card-description2">Judul: <?= $data['judulfoto'] ?></h2>
                    <p class="card-description2">Deskripsi: <?= $data['deskripsifoto'] ?></p>
                </a>

                <div class="button">
                    <div class="like">
                        <a href="like-admin.php?fotoid=<?= $data['fotoid'] ?>&albumid=<?= $data['albumid'] ?>">Like</a>
                        <?php
                        $fotoid = $data['fotoid'];
                        $sql2 = mysqli_query($conn, "SELECT * FROM likefoto WHERE fotoid='$fotoid'");
                        echo mysqli_num_rows($sql2);
                        ?>
                    </div>
                    <div class="komentar">
                        <a href="komentar-admin.php?fotoid=<?= $data['fotoid'] ?>">Komentar</a>
                    </div>
                </div>
            </li>

        </ul>
<?php
    }
} else {
    // Tindakan yang diambil jika parameter albumid tidak diterima
    echo "ID album tidak ditemukan.";
}
?>
    
</div>
</div>
<script src="js/admin-beranda.js"></script>
</body>

</html>