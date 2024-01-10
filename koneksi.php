<?php
$host = "localhost"; // sesuaikan dengan host database Anda
$user = "root"; // sesuaikan dengan username database Anda
$pass = ""; // sesuaikan dengan password database Anda
$dbname = "toko_game"; // sesuaikan dengan nama database Anda

$koneksi = mysqli_connect($host, $user, $pass, $dbname);

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
