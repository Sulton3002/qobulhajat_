<?php
session_start();
include '../koneksi.php';

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = $_POST['password'];

    $q = mysqli_query($koneksi, "SELECT * FROM user WHERE username='$username' LIMIT 1");
    $user = mysqli_fetch_assoc($q);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['username'];
        header('Location: ../index.php');
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
    <title>Login User</title>
    <link rel="stylesheet" href="../assets/style.css">
    <style>
        body {
            background: #f7f7f7;
        }
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
        <h2>Login User</h2>
        <form method="POST" action="">
            <?php if ($error): ?>
                <div class="error"><?php echo $error; ?></div>
            <?php endif; ?>
            <label for="username">Username</label>
            <input type="text" name="username" id="username" autocomplete="username" required>
            <label for="password">Password</label>
            <input type="password" name="password" id="password" autocomplete="current-password" required>
            <button type="submit">Login</button>
        </form>
        <a href="register-user.php" class="back-link">Belum punya akun? Register</a>
        <a href="../login.php" class="back-link">← Kembali ke laman masuk</a>
    </div>
</body>
</html>
