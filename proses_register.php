<?php
include "koneksi.php";

$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];
$namalengkap = $_POST['namalengkap'];

// Set level ke nilai default
$level = "user";

// Set tanggal_dibuat ke tanggal dan waktu saat ini
$tanggaldibuat = date('Y-m-d H:i:s');

$sql = mysqli_query($conn, "INSERT INTO user (username, password, email, namalengkap, level, tanggaldibuat) VALUES ('$username', '$password', '$email', '$namalengkap', '$level', '$tanggaldibuat')");

// Cek apakah query berhasil dijalankan
if ($sql) {
    // Redirect ke halaman masuk.php dengan parameter notifikasi
    header("location: masuk.php?registered=true");
} else {
    // Jika terjadi kesalahan, Anda dapat menangani sesuai kebutuhan aplikasi Anda
    echo "Gagal menambahkan pengguna. Silakan coba lagi atau hubungi administrator.";
}
?>
