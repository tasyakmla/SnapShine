<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar</title>
    <link rel="stylesheet" href="css/daftar.css">
    <script>
        function validateForm() {
            var namalengkap = document.getElementById("namalengkap").value;
            var username = document.getElementById("username").value;
            var password = document.getElementById("password").value;
            var email = document.getElementById("email").value;

            if (namalengkap === "" || username === "" || password === "" || email === "") {
                alert("Harap isi semua kolom.");
                return false;
            }
            return true;
        }
    </script>
</head>
<body>   
<div class="container">
    <div class="login-card">
        <h2>Daftar</h2>
        <form id="sign-in-form" action="proses_register.php" method="post" onsubmit="return validateForm()">

            <label for="namalengkap">Nama Lengkap:</label>
            <input type="text" id="namalengkap" name="namalengkap">

            <label for="username">Username:</label>
            <input type="text" id="username" name="username">

            <label for="password">Password:</label>
            <input type="password" id="password" name="password">

            <label for="email">Email:</label>
            <input type="email" id="email" name="email">

            <div class="login-container">
            <p class="forgot-password">Anda mempunyai akun? </p><a href="masuk.php">Masuk</a>
            </div>
            <button type="submit">Daftar</button>
            
        </form>
    </div>
</div>
</body>
</html>
