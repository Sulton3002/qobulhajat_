<?php
session_start();
include '../koneksi.php';

if (isset($_POST['login'])) {
  $email = $_POST['email'];
  $password = $_POST['password'];

  $query = mysqli_query($koneksi, "SELECT * FROM author WHERE email='$email' AND password='$password'");
  $cek = mysqli_num_rows($query);

  if ($cek > 0) {
    $data = mysqli_fetch_assoc($query);
    $_SESSION['author_id'] = $data['id'];
    $_SESSION['nickname'] = $data['nickname'];
    header("Location: dashboard.php");
  } else {
    $error = "Email atau Password salah!";
  }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Login Admin</title>
  <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
  <div class="login-box">
    <h2>Login Admin</h2>
    <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
    <form method="POST">
      <input type="email" name="email" placeholder="Email" required><br>
      <input type="password" name="password" placeholder="Password" required><br>
      <p><a href="register.php">Belum punya akun? Daftar admin baru</a></p>
      <button type="submit" name="login">Login</button>
    </form>
  </div>
</body>
</html>
