<?php
include 'koneksi.php';
session_start();

if (isset($_POST['login'])) {
  $email = $_POST['email'];
  $password = $_POST['password'];

  $cek = mysqli_query($koneksi, "SELECT * FROM users WHERE email='$email' AND password='$password'");
  if (mysqli_num_rows($cek) > 0) {
    $data = mysqli_fetch_assoc($cek);
    $_SESSION['user_name'] = $data['name'];
    $_SESSION['user_email'] = $data['email'];
    header("Location: index.php");
    exit;
  } else {
    $error = "Email atau password salah.";
  }
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Login Pengunjung</title>
  <link rel="stylesheet" href="assets/style.css">
</head>
<body>
  <div class="login-box">
    <h2>Login Pengunjung</h2>
    <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
    <form method="POST">
      <input type="email" name="email" placeholder="Email" required><br>
      <input type="password" name="password" placeholder="Password" required><br>
      <button type="submit" name="login">Login</button><br><br>
      <a href="register-user.php">Belum punya akun? Daftar</a>
    </form>
  </div>
</body>
</html>
