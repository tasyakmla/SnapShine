<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link rel="stylesheet" href="style.css">

    <link rel="stylesheet" href="css/album.css">

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
?>
<div class="pinggir">
    <form action="update_user.php" method="post" enctype="multipart/form-data" class="input">
        <?php
        include "koneksi.php";
        $userid = $_GET['userid'];
        $sql = mysqli_query($conn, "select * from user where userid='$userid'");
        while ($data = mysqli_fetch_array($sql)) {
        ?>
            <input type="text" name="userid" value="<?= $data['userid'] ?>" hidden>
            <table>
                <tr>
                    <td>Username</td>
                    <td><input type="text" name="username" value="<?= $data['username'] ?>"></td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td><input type="password" name="password" value="<?= $data['password'] ?>"></td>
                </tr>
                <tr>
                    <td>Nama Lengkap</td>
                    <td><input type="text" name="namalengkap" value="<?= $data['namalengkap'] ?>"></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td><input type="text" name="email" value="<?= $data['email'] ?>"></td>
                </tr>
                <tr>
                    <td>level</td>
                    <td><input type="text" name="level" value="<?= $data['level'] ?>"></td>
                </tr>
                <tr>
                <tr>
                    <td></td>
                    <td><input type="submit" value="Ubah"></td>
                </tr>
            </table>
        <?php
        }
        ?>
    </form>
</div>





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