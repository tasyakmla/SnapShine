<?php
include "koneksi.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data yang dikirim melalui form
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Query untuk mengecek keberadaan user dengan username dan password yang sesuai
    $sql = "SELECT * FROM user WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $sql);

    // Hitung jumlah baris hasil query
    $cek = mysqli_num_rows($result);

    if ($cek == 1) {
        // Jika data ditemukan, set session dan redirect berdasarkan level
        $data = mysqli_fetch_array($result);

        $_SESSION['userid'] = $data['userid'];
        $_SESSION['namalengkap'] = $data['namalengkap'];
        $_SESSION['level'] = $data['level']; // Kolom 'level' atau 'role' pada tabel user

        // Redirect berdasarkan level
        if ($_SESSION['level'] == 'user') {
            header("location: user.php");
        } elseif ($_SESSION['level'] == 'admin') {
            header("location: admin.php");
        } else {
            // Redirect ke halaman lain jika level tidak terdeteksi atau tidak ada level
            header("location: halaman_lain.php");
        }
    } else {
        // Jika data tidak ditemukan, redirect kembali ke halaman login (masuk.php)
        header("location: masuk.php");
    }
} else {
    // Jika bukan metode POST, redirect kembali ke halaman login (masuk.php)
    header("location: masuk.php");
}
?>
