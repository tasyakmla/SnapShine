<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman data user-admin</title>
    <link rel="stylesheet" href="style.css">

    <link rel="stylesheet" href="css/album.css">

    <style>
        input[type="text"], input[type="file"],input[type="password"],input[type="email"], select {
    width: 100%;
    padding: 8px;
    margin-bottom: 10px;
    box-sizing: border-box;
}
    </style>
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
<div class="pinggir">

    <form action="proses_tambah_user.php" method="post" enctype="multipart/form-data" class="input">
        <h3>Tambah User</h3>
        <table>
            <tr>
                <td>Username</td>
                <td><input type="text" name="username"></td>
            </tr>
            <tr>
                <td>Password</td>
                <td><input type="password" name="password"></td>
            </tr>
            <tr>
                <td>Nama Lengkap</td>
                <td><input type="text" name="namalengkap"></td>
            </tr>
            </tr>
            <tr>
                <td>Email</td>
                <td><input type="email" name="email"></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" value="Tambah"></td>
            </tr>
        </table>
    </form>
    <div class="table" style="position:relative;top:200px;">

        <table border="1" cellpadding=5 cellspacing=0 style="top: 200px;">
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Nama Lengkap</th>
                <th>Email</th>
                <th>Level</th>
                <th>Aksi</th>
            </tr>
            <?php
            include "koneksi.php";
            $userid = $_SESSION['userid'];
            $sql = mysqli_query($conn, "select * from user");
            while ($data = mysqli_fetch_array($sql)) {
            ?>
                <tr>
                    <td><?= $data['userid'] ?></td>
                    <td><?= $data['username'] ?></td>
                    <td><?= $data['namalengkap'] ?></td>
                    <td><?= $data['email'] ?></td>
                    <td><?= $data['level'] ?></td>
                    <td>
                        <a href="hapus_user.php?userid=<?= $data['userid'] ?>">Hapus</a>
                        <a href="edit_user.php?userid=<?= $data['userid'] ?>">Edit</a>
                    </td>
                </tr>
            <?php
            }
            ?>
        </table>

    </div>
</div>
<section class="home-section">



    <div class="grid align__item">

    </div>
</section>






<script>
    let sidebar = document.querySelector(".sidebar");
    let closeBtn = document.querySelector("#btn");
    let searchBtn = document.querySelector(".bx-search");

    closeBtn.addEventListener("click", () => {
        sidebar.classList.toggle("open");
        menuBtnChange(); //calling the function(optional)
    });

    searchBtn.addEventListener("click", () => { // Sidebar open when you click on the search iocn
        sidebar.classList.toggle("open");
        menuBtnChange(); //calling the function(optional)
    });

    // following are the code to change sidebar button(optional)
    function menuBtnChange() {
        if (sidebar.classList.contains("open")) {
            closeBtn.classList.replace("bx-menu", "bx-menu-alt-right"); //replacing the iocns class
        } else {
            closeBtn.classList.replace("bx-menu-alt-right", "bx-menu"); //replacing the iocns class
        }
    }
</script>
</body>

</html>