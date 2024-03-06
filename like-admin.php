<?php
    include "koneksi.php";
    session_start();

    if(!isset($_SESSION['userid'])){
        // Untuk bisa memberi suka, pengguna harus login terlebih dahulu
        header("location:masuk.php");
    } else {
        $fotoid = $_GET['fotoid'];
        $userid = $_SESSION['userid'];

        // Ambil albumid dari halaman sebelumnya
        if(isset($_GET['albumid'])){
            $album_id = $_GET['albumid'];
        } else {
            // Tindakan yang diambil jika albumid tidak ditemukan
            echo "ID album tidak ditemukan.";
            exit; // hentikan eksekusi lebih lanjut jika albumid tidak ditemukan
        }

        // Cek apakah user sudah pernah like foto ini atau belum
        $sql = mysqli_query($conn,"select * from likefoto where fotoid='$fotoid' and userid='$userid'");

        if(mysqli_num_rows($sql) == 1){
            // User sudah pernah like foto ini
            header("location:berandafoto-admin.php?albumid=$album_id");
        } else {
            $tanggallike = date("Y-m-d");
            mysqli_query($conn,"insert into likefoto values('','$fotoid','$userid','$tanggallike')");
            header("location:berandafoto-admin.php?albumid=$album_id");
        }
    }
?>
