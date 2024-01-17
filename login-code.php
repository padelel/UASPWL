<?php
require 'config/function.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifikasi reCAPTCHA
    $recaptchaSecretKey = '6LctJFQpAAAAADhrp6bbDo24l670K7YZ0eLyZ1Zf';
    $recaptchaResponse = $_POST['g-recaptcha-response'];
    $recaptchaUrl = "https://www.google.com/recaptcha/api/siteverify?secret=$recaptchaSecretKey&response=$recaptchaResponse";
    $recaptchaData = json_decode(file_get_contents($recaptchaUrl));

    if (!$recaptchaData->success) {
        setAlert('danger', 'reCAPTCHA verification failed. Please try again.');
        header('Location: login.php');
        exit;
    }

    // Proses login jika reCAPTCHA valid
    $name = validate($_POST['name']);
    $password = validate($_POST['password']);

    $query = "SELECT * FROM admins WHERE name ='$name' AND password ='$password'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $count = mysqli_num_rows($result);

    if ($count == 1) {
        $_SESSION['name'] = $name;
        redirect('admin/index.php', 'Login success');
    } else {
        redirect('login.php', 'Invalid username or password');
    }
} else {
    // Redirect jika mencoba mengakses secara langsung
    header('Location: login.php');
    exit;
}
?>
