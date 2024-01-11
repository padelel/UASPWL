<?php
include 'koneksi.php';

session_start();

// Periksa apakah pengguna sudah login atau belum
if (!isset($_SESSION['username'])) {
    header("Location: Login.php"); // Redirect ke halaman login jika belum login
    exit();
}
$username = $_SESSION['username'];
$query = "SELECT name, password FROM admins WHERE name='$username'";
$result = mysqli_query($koneksi, $query);
if ($result) {
    $row = mysqli_fetch_assoc($result);
    $name = $row['name'];
    $password = $row['password'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <!-- Tambahkan link ke file Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            max-width: 500px;
            margin-top: 50px;
        }

        h2 {
            color: #007bff;
            text-align: center;
            margin-bottom: 30px;
        }

        form {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.1);
        }

        label {
            color: #555555;
            font-weight: bold;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 15px;
            display: inline-block;
            border: 1px solid #ced4da;
            border-radius: 5px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Edit Profile</h2>

        <form action="ProsesEditProfile.php" method="post">
            <div class="form-group">
                <label for="newUsername">New Username:</label>
                <input type="text" id="newUsername" name="newUsername" class="form-control" value="<?php echo $name; ?>"
                    required>
            </div>

            <div class=" form-group">
                <label for="newPassword">New Password:</label>
                <input type="password" id="newPassword" name="newPassword" class="form-control"
                    placeholder="Enter new password">
                <small class="form-text text-muted">Leave it blank if you don't want to change the password.</small>
            </div>

            <button type="submit" class="btn btn-primary">Update Profile</button>
        </form>
    </div>
    <!-- Tambahkan link ke file Bootstrap JavaScript dan jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>