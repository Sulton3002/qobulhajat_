<?php
session_start();
include 'koneksi.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = mysqli_real_escape_string($koneksi, $_POST['username']);
    $pass = mysqli_real_escape_string($koneksi, $_POST['password']);
    $pass2 = mysqli_real_escape_string($koneksi, $_POST['password2']);

    if ($user == '' || $pass == '' || $pass2 == '') {
        $error = 'Semua kolom wajib diisi!';
    } elseif ($pass !== $pass2) {
        $error = 'Konfirmasi password tidak cocok!';
    } else {
        $cek = mysqli_query($koneksi, "SELECT * FROM user WHERE username='$user'");
        if (mysqli_num_rows($cek) > 0) {
            $error = 'Username sudah terdaftar!';
        } else {
            $hash = password_hash($pass, PASSWORD_DEFAULT);
            $q = mysqli_query($koneksi, "INSERT INTO user (username, password) VALUES ('$user', '$hash')");
            if ($q) {
                $success = 'Registrasi berhasil! Silakan <a href="login.php">login</a>.';
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
    <title>Register - My Blog</title>
    <link rel="stylesheet" href="assets/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include 'navbar.php'; ?>
    <main>
        <div class="register-container">
            <h2 class="mb-4">Register</h2>
            <?php if ($error): ?>
                <div class="alert alert-danger"><?= $error ?></div>
            <?php endif; ?>
            <?php if ($success): ?>
                <div class="alert alert-success"><?= $success ?></div>
            <?php endif; ?>
            <form method="post">
                <label>Username</label>
                <input type="text" name="username" class="form-control" required>
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
                <label>Konfirmasi Password</label>
                <input type="password" name="password2" class="form-control" required>
                <button class="btn btn-primary w-100 mt-3" type="submit">Register</button>
                <a href="index.php" class="btn btn-secondary w-100 mt-2">Kembali ke Beranda</a>
            </form>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
                </form>
            </div>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
