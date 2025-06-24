<?php
session_start();
include 'koneksi.php';
$error = '';

// Pastikan tabel register sudah ada di database Anda sebelum menjalankan query di bawah ini.

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $result = mysqli_query($conn, "SELECT * FROM register WHERE username='$username' AND password=MD5('$password')");

    if ($row = mysqli_fetch_assoc($result)) {
        $_SESSION['user'] = $row['username'];
        header('Location: dashboard.php');
        exit;
    } else {
        $error = 'Username atau password salah!';
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pilih Login</title>
    <link rel="stylesheet" href="assets/style.css">
    <style>
        body { background: #f7f7f7; }
        .login-choice-container {
            max-width: 350px;
            margin: 80px auto;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            padding: 32px 28px 24px 28px;
            text-align: center;
        }
        .login-choice-container h2 {
            margin-bottom: 28px;
            color: #333;
        }
        .login-choice-container a {
            display: block;
            margin: 18px 0;
            padding: 12px 0;
            background: #2d8cf0;
            color: #fff;
            border-radius: 4px;
            font-size: 17px;
            font-weight: 600;
            text-decoration: none;
            transition: background 0.2s;
        }
        .login-choice-container a:hover {
            background: #1976d2;
        }
    </style>
</head>
<body>
    <div class="login-choice-container">
        <h2>Masuk Sebagai</h2>
        <a href="admin/login.php">Admin</a>
        <a href="user/user-login.php">User</a>
        <a href="index.php" style="background:#aaa;">← Kembali ke Beranda</a>
    </div>
</body>
</html>
