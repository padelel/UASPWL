<?php
session_start();
include 'koneksi.php';

// Periksa apakah pengguna sudah login atau belum
if (!isset($_SESSION['username'])) {
    header("Location: Login.php"); // Redirect ke halaman login jika belum login
    exit();
}

// Ambil data dari form edit profile
$newUsername = $_POST['newUsername'];
$newPassword = $_POST['newPassword'];

// If a new password is provided, hash it; otherwise, use the existing hashed password
if (!empty($newPassword)) {
    $newPassword = password_hash($newPassword, PASSWORD_DEFAULT);
}

// Update informasi pengguna di dalam database
$query = "UPDATE admins SET name='$newUsername'";
// Only update the password if a new password is provided
if (!empty($newPassword)) {
    $query .= ", password='$newPassword'";
}
$query .= " WHERE name='" . $_SESSION['username'] . "'";
$result = mysqli_query($koneksi, $query);

if ($result) {
    // Update informasi pengguna di sesi
    $_SESSION['username'] = $newUsername;

    // Redirect ke halaman edit profile dengan pesan sukses
    header("Location: Home.php");
    exit();
} else {
    // Error saat menjalankan query
    echo "Error: " . mysqli_error($koneksi);
}

// Menutup koneksi database
mysqli_close($koneksi);
?>