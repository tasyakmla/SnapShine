<?php
include "koneksi.php";
session_start();

$userid = $_POST['userid'];
$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];
$level = $_POST['level'];
$namalengkap = $_POST['namalengkap'];

// Lindungi nilai string dengan tanda kutip
$sql = mysqli_query($conn, "UPDATE user SET username='$username', password='$password', email='$email', level='$level', namalengkap='$namalengkap' WHERE userid='$userid'");

header("location:data-user.php");
