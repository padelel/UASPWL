<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Mengambil nilai input dari formulir
    $username = $_POST['username'];
    $raw_password = $_POST['password'];

    // Menggunakan password_hash untuk menghasilkan hash dari password
    $hashed_password = password_hash($raw_password, PASSWORD_DEFAULT);

    // Melakukan query untuk menyimpan informasi pengguna ke dalam database
    $query = "INSERT INTO admins (name, password) VALUES (?, ?)";
    $stmt = mysqli_prepare($koneksi, $query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, 'ss', $username, $hashed_password);

        if (mysqli_stmt_execute($stmt)) {
            // Registrasi berhasil, redirect ke halaman login atau halaman beranda
            header("Location: Login.php");
            exit();
        } else {
            // Error saat menjalankan query
            echo "Error: " . mysqli_error($koneksi);
        }

        mysqli_stmt_close($stmt);
    } else {
        // Error saat membuat statement
        echo "Error: " . mysqli_error($koneksi);
    }

    // Menutup koneksi database
    mysqli_close($koneksi);
}
?>