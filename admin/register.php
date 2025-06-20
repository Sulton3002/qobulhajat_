<?php
include '../koneksi.php';

if (isset($_POST['daftar'])) {
  $nama = $_POST['nickname'];
  $email = $_POST['email'];
  $password = $_POST['password'];

  // Cek email sudah ada
  $cek = mysqli_query($koneksi, "SELECT * FROM author WHERE email='$email'");
  if (mysqli_num_rows($cek) > 0) {
    $error = "Email sudah terdaftar.";
  } else {
    mysqli_query($koneksi, "INSERT INTO author (nickname, email, password) VALUES ('$nama', '$email', '$password')");
    header("Location: login.php?pesan=daftar");
    exit;
  }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Register Admin</title>
  <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
  <div class="login-box">
    <h2>Daftar Admin</h2>
    <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
    <form method="POST">
      <input type="text" name="nickname" placeholder="Nama Lengkap" required><br>
      <input type="email" name="email" placeholder="Email" required><br>
      <input type="password" name="password" placeholder="Password" required><br>
      <button type="submit" name="daftar">Daftar</button><br><br>
      <a href="login.php">← Kembali ke Login</a>
    </form>
  </div>
</body>
</html>
