<?php
include 'koneksi.php';
session_start();

if (isset($_POST['register'])) {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = $_POST['password'];

  // Cek email
  $cek = mysqli_query($koneksi, "SELECT * FROM users WHERE email='$email'");
  if (mysqli_num_rows($cek) > 0) {
    $error = "Email sudah digunakan.";
  } else {
    mysqli_query($koneksi, "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')");
    $_SESSION['user_name'] = $name;
    $_SESSION['user_email'] = $email;
    header("Location: index.php");
    exit;
  }
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Daftar Pengunjung</title>
  <link rel="stylesheet" href="assets/style.css">
</head>
<body>
  <div class="login-box">
    <h2>Register Pengunjung</h2>
    <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
    <form method="POST">
      <input type="text" name="name" placeholder="Nama Lengkap" required><br>
      <input type="email" name="email" placeholder="Email" required><br>
      <input type="password" name="password" placeholder="Password" required><br>
      <button type="submit" name="register">Daftar</button><br><br>
      <a href="login-user.php">Sudah punya akun? Login di sini</a>
    </form>
  </div>
</body>
</html>
