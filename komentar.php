<?php
// Fungsi untuk menghitung waktu yang lalu
function waktuYangLalu($timestamp)
{
    $selisih = time() - strtotime($timestamp);

    if ($selisih < 60) {
        return 'beberapa detik yang lalu';
    } elseif ($selisih < 3600) {
        $menit = round($selisih / 60);
        return $menit . ' menit yang lalu';
    } elseif ($selisih < 86400) {
        $jam = round($selisih / 3600);
        return $jam . ' jam yang lalu';
    } else {
        $hari = round($selisih / 86400);
        return $hari . ' hari yang lalu';
    }
} ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Komentar</title>
    <link rel="stylesheet" href="css/komentar-admin.css">
    <style>
        /* ... (style yang sudah ada) ... */
        /* Menambahkan gaya khusus untuk konten daftar */
        .daftar-foto {
            /* Sesuaikan tinggi maksimal sesuai kebutuhan */
            overflow-y: auto;
            /* Menambahkan scroll vertikal jika lebih tinggi dari max-height */
            margin-top: 20px;
            /* Menambahkan jarak dari h1 */
            display: grid;
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
            max-width: 100%;
            height: auto;
            display: block;
            margin: 0 auto;
            margin-bottom: 10px;
            /* Jarak antara gambar */
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

        p {
            margin-block: 0;
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
        if (!isset($_SESSION['userid'])) {
        ?>
            <li><a href="daftar.php">Daftar</a></li>
            <li><a href="masuk.php">Masuk</a></li>
    </ul>
<?php
        } else {
?>


    <ul style="float: right;">
        <li><a href="admin.php">Beranda</a></li>
        <li><a href="album-admin.php">Album</a></li>
        <li><a href="foto-admin.php">Foto</a></li>
        <li><a href="data-user.php">Data User</a></li>
        <li><a href="logout.php" onclick="return confirm('Apakah Anda yakin ingin keluar?')">Keluar</a></li>
    </ul>
    </ul>
<?php
        }
?>


<form action="tambah_komentar.php" method="post">
    <h2 style="text-align: center;">Komentar</h2>
    <?php
    include "koneksi.php";
    $fotoid = $_GET['fotoid'];
    $sql = mysqli_query($conn, "select * from foto where fotoid='$fotoid'");
    while ($data = mysqli_fetch_array($sql)) {
    ?>

        <input type="text" name="fotoid" value="<?= $data['fotoid'] ?>" hidden>
        <table class="postingan" style="margin: 0 auto; text-align: left;">

            <tr style="text-align: center;">
                <td>
                    <p style="float: left;">Judul Foto:</p>
                    <p style="border-style: none;" type="text" name="judulfoto" disabled value=""><?= $data['judulfoto'] ?></p>
                </td>
            </tr>
            </tr>
            <tr style="text-align: center;">
                <td>
                    <p style="float: left;">Deskripsi:</p>
                    <p style="border-style: none;" type="text" name="deskripsifoto" disabled value=""><?= $data['deskripsifoto'] ?></p>
                </td>
            </tr>
            <tr>
                <td><img src="gambar/<?= $data['lokasifile'] ?>" width="200px"></td>
            </tr>
            <tr>
                <td>Komentar</td>
                <td><input type="text" name="isikomentar"></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" value="Tambah"></td>
            </tr>
        </table>
        <div class="komentar">
            <div class="kolomkomen">
                <div class="top-username">
                </div>
                <div class="isikomen">

                    <?php
                    include "koneksi.php";

                    $sql = mysqli_query($conn, "SELECT komentarfoto.*, user.username
                                FROM komentarfoto
                                INNER JOIN user ON komentarfoto.userid = user.userid
                                WHERE komentarfoto.fotoid = '$fotoid'");

                    while ($data = mysqli_fetch_array($sql)) {
                    ?>
                        <div class="komen">
                            <p><b><?= $data['username'] ?></b> : <?= $data['isikomentar'] ?></p>
                            <p class="waktu"><?= $data['tanggalkomentar'] ?></p>
                        </div>
                    <?php
                    }
                    ?>
                <?php
            }
                ?>
</form>


</body>

</html>