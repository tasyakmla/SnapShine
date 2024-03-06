<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk</title>
    <link rel="stylesheet" href="css/masuk.css">
</head>
<body>   
    <div class="container">
        <div class="login-card">
            <h2>Masuk</h2>

            <?php
            // Cek apakah terdapat parameter notifikasi
            if (isset($_GET['registered']) && $_GET['registered'] == 'true') {
                echo '<p class="registration-success" >Pendaftaran berhasil! Silakan masuk dengan akun baru Anda.</p>';
            }
            ?>

            <form id="sign-in-form" action="proses_login.php" method="post">

                <label for="username">Username:</label>
                <input type="text" id="username" name="username">

                <label for="password">Password:</label>
                <input type="password" id="password" name="password">

                <div class="login-container">
                    <p class="forgot-password">Anda belum mempunyai akun?</p><a href="daftar.php">Daftar</a>
                </div>

                <button type="submit">Masuk</button>
            </form>
        </div>
    </div>
</body>
</html>
