<?php
include "koneksi.php";
session_start();

// Ambil data yang dikirimkan melalui form
$judulfoto = $_POST['judulfoto'];
$deskripsifoto = $_POST['deskripsifoto'];
$albumid = $_POST['albumid'];
$tanggalunggah = date("Y-m-d");
$userid = $_SESSION['userid'];

// Pastikan file diunggah dengan benar sebelum mencoba mengaksesnya
if (isset($_FILES['lokasifile'])) {
    // Ambil informasi file yang diupload
    $filename = $_FILES['lokasifile']['name'];
    $ukuran = $_FILES['lokasifile']['size'];
    $tmp_name = $_FILES['lokasifile']['tmp_name'];

    // Tentukan lokasi folder penyimpanan gambar
    $lokasiFolder = "gambar/";

    // Buat nama file unik dengan menambahkan timestamp
    $namaFileBaru = time() . '_' . $filename;

    // Simpan file ke folder gambar
    if (move_uploaded_file($tmp_name, $lokasiFolder . $namaFileBaru)) {
        // Jika berhasil diunggah, masukkan data ke database
        $sql = "INSERT INTO foto (judulfoto, deskripsifoto, albumid, userid, tanggalunggah, lokasifile) 
                    VALUES ('$judulfoto', '$deskripsifoto', '$albumid', '$userid', '$tanggalunggah', '$namaFileBaru')";

        if (mysqli_query($conn, $sql)) {
            // Redirect ke halaman foto.php jika berhasil
            header("location: foto.php");
            exit;
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    } else {
        // Jika gagal diunggah, kembalikan ke halaman foto.php dengan pesan error
        header("location: foto.php?error=gagal_upload");
        exit;
    }
} else {
    // Jika tidak ada file yang diunggah, kembalikan ke halaman foto.php dengan pesan error
    header("location: foto.php?error=no_file_uploaded");
    exit;
}
