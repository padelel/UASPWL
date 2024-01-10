<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Mengambil nilai input dari formulir
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Melakukan query untuk menyimpan informasi pengguna ke dalam database
    $query = "INSERT INTO admins (name, password) VALUES (?, ?)";
    $stmt = mysqli_prepare($koneksi, $query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, 'ss', $username, $password);

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
