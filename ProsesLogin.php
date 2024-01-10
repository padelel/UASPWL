<?php
include 'koneksi.php';

// Memeriksa apakah formulir login telah disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Mengambil nilai input dari formulir
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Melakukan query untuk mendapatkan informasi pengguna
    $query = "SELECT * FROM admins WHERE name = '$username' LIMIT 1";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        // Memeriksa apakah username ditemukan
        if (mysqli_num_rows($result) == 1) {
            $user = mysqli_fetch_assoc($result);
    
            // Memeriksa apakah kata sandi cocok
            if ($password === $user['password']) {
                // Login berhasil, redirect ke halaman sukses atau halaman beranda
                header("Location: Home.php");
                exit();
            } else {
                // Kata sandi tidak cocok
                echo "Password tidak valid. Silakan coba lagi.";
            }
        } else {
            // Username tidak ditemukan
            echo "Username tidak ditemukan. Silakan coba lagi.";
        }
    
        // Membebaskan hasil query
        mysqli_free_result($result);
    } else {
        // Error saat menjalankan query
        echo "Error: " . mysqli_error($koneksi);
    }
    

    // Menutup koneksi database
    mysqli_close($koneksi);
}
?>