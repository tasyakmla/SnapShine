<?php
include "koneksi.php";
    session_start();

    $userid=$_GET['userid'];

    $sql=mysqli_query($conn,"delete from user where userid='$userid'");

    header("location:data-user.php");
?>