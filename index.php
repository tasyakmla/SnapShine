<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman guest</title>
    <link rel="stylesheet" href="css/beranda.css">
    <link rel="stylesheet" href="css/admin.css">
    <style>
        /* ... (style yang sudah ada) ... */
        /* Menambahkan gaya khusus untuk konten daftar */
        .daftar-foto {
            margin-top: 20px;
            display: flex;
            flex-wrap: wrap;
            align-items: stretch;
            justify-content: normal;
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

        /* Gaya untuk tombol "Halaman Selanjutnya" */
        .next-button {
            display: inline-block;
            padding: 8px 16px;
            /* Mengurangi ukuran tombol */
            background-color: #9e7481;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            margin-top: 20px;
            margin-bottom: 15px;

        }

        .next-more {
            display: inline-block;
            padding: 8px 16px;
            /* Mengurangi ukuran tombol */
            background-color: #9e7481;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            margin-top: 174px;


        }

        .next-more:hover {
            background-color: #944E63;
        }

        .next-button:hover {
            background-color: #944E63;
        }
    </style>
</head>

<body>
    <ul class="navbar">
        <li>
            <h2>SnapShine</h2>
        </li>
        <ul>
            <li><a href="daftar.php">Daftar</a></li>
            <li><a href="masuk.php">Masuk</a></li>

        </ul>

        </ul>
        <div class="daftar-foto">
            <?php
            include "koneksi.php";

            // Mengambil daftar album
            $sql_album = mysqli_query($conn, "SELECT * FROM album");
            while ($album = mysqli_fetch_array($sql_album)) {
                $album_id = $album['albumid'];
                $album_name = $album['namaalbum'];
                $album_description = $album['deskripsi'];

                // Mengambil foto terakhir dan informasi username dari setiap album
                $sql_foto_terakhir = mysqli_query($conn, "SELECT foto.*, user.username 
                                                    FROM foto 
                                                    INNER JOIN user ON foto.userid = user.userid
                                                    WHERE foto.albumid = '$album_id' 
                                                    ORDER BY foto.fotoid DESC LIMIT 1");
                $foto_terakhir = mysqli_fetch_array($sql_foto_terakhir);

                // Jika album memiliki foto
                if ($foto_terakhir) {
            ?>
                    <div class="card">
                        <p>‣<?= $foto_terakhir['username'] ?></p>
                        <img src="gambar/<?= $foto_terakhir['lokasifile'] ?>" alt="<?= $foto_terakhir['judulfoto'] ?>" />
                        <a class="card-description" href="#">
                            <h2><?= $album_name ?></h2>
                            <p><?= $album_description ?></p>
                        </a>
                        <a href="berandafoto-guest.php?albumid=<?= $album_id ?>" class="next-button">More</a>
                    </div>
                <?php
                } else {
                    // Jika album tidak memiliki foto
                ?>
                    <div class="card">
                        <h2><?= $album_name ?></h2>
                        <p><?= $album_description ?></p>
                        <p>Album ini belum memiliki foto.</p>
                    </div>
            <?php
                }
            }
            ?>
        </div>


        </div>
        <script src="js/admin-beranda.js"></script>
</body>

</html>