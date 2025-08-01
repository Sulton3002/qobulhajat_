<?php
session_start();
include '../koneksi.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = mysqli_real_escape_string($koneksi, trim($_POST['username']));
    $email = mysqli_real_escape_string($koneksi, trim($_POST['email']));
    $nama = mysqli_real_escape_string($koneksi, trim($_POST['nama']));
    $password = $_POST['password'];
    $password2 = $_POST['password2'];

    if ($password !== $password2) {
        $error = 'Konfirmasi password tidak cocok!';
    } elseif (strlen($username) < 3 || strlen($password) < 4) {
        $error = 'Username minimal 3 karakter dan password minimal 4 karakter!';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Format email tidak valid!';
    } else {
        $cek = mysqli_query($koneksi, "SELECT id FROM user WHERE username='$username' OR email='$email' LIMIT 1");
        if (mysqli_num_rows($cek) > 0) {
            $error = 'Username atau email sudah terdaftar!';
        } else {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $insert = mysqli_query($koneksi, "INSERT INTO user (username, password, email, nama) VALUES ('$username', '$hash', '$email', '$nama')");
            if ($insert) {
                $success = 'Registrasi berhasil! Silakan <a href="user-login.php">login</a>.';
            } else {
                $error = 'Registrasi gagal, coba lagi.';
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Register User</title>
    <link rel="stylesheet" href="../assets/style.css">
    <style>
        body { background: #f7f7f7; }
        .login-container {
            max-width: 350px;
            margin: 60px auto;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            padding: 32px 28px 24px 28px;
        }
        .login-container h2 {
            text-align: center;
            margin-bottom: 24px;
            color: #333;
        }
        .login-container label {
            font-weight: 500;
            margin-bottom: 6px;
            display: block;
        }
        .login-container input[type="text"],
        .login-container input[type="password"] {
            width: 100%;
            padding: 8px 10px;
            margin-bottom: 18px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 15px;
        }
        .login-container button {
            width: 100%;
            background: #2d8cf0;
            color: #fff;
            border: none;
            padding: 10px 0;
            border-radius: 4px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s;
        }
        .login-container button:hover {
            background: #1976d2;
        }
        .login-container .error {
            color: #d32f2f;
            background: #ffeaea;
            border: 1px solid #f5c6cb;
            padding: 8px 10px;
            border-radius: 4px;
            margin-bottom: 16px;
            text-align: center;
        }
        .login-container .success {
            color: #388e3c;
            background: #eaffea;
            border: 1px solid #b2dfdb;
            padding: 8px 10px;
            border-radius: 4px;
            margin-bottom: 16px;
            text-align: center;
        }
        .login-container .back-link {
            display: block;
            text-align: center;
            margin-top: 18px;
            color: #2d8cf0;
            text-decoration: none;
        }
        .login-container .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Register User</h2>
        <form method="POST" action="">
            <?php if ($error): ?>
                <div class="error"><?php echo $error; ?></div>
            <?php elseif ($success): ?>
                <div class="success"><?php echo $success; ?></div>
            <?php endif; ?>
            <label for="nama">Nama</label>
            <input type="text" name="nama" id="nama" required>
            <label for="email">Email</label>
            <input type="text" name="email" id="email" autocomplete="email" required>
            <label for="username">Username</label>
            <input type="text" name="username" id="username" autocomplete="username" required>
            <label for="password">Password</label>
            <input type="password" name="password" id="password" autocomplete="new-password" required>
            <label for="password2">Konfirmasi Password</label>
            <input type="password" name="password2" id="password2" autocomplete="new-password" required>
            <button type="submit">Register</button>
        </form>
        <a href="user-login.php" class="back-link">← Kembali ke Login</a>
        <a href="../index.php" class="back-link">← Kembali ke Beranda</a>
    </div>
</body>
</html>
