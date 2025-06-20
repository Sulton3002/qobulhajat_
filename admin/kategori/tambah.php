<?php
session_start();
if (!isset($_SESSION['author_id'])) {
  header("Location: ../login.php");
  exit;
}

include '../../koneksi.php';

// Proses simpan kategori
if (isset($_POST['submit'])) {
  $nama = $_POST['name'];
  $deskripsi = $_POST['description'];

  mysqli_query($koneksi, "INSERT INTO category (name, description) VALUES ('$nama', '$deskripsi')");
  header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Tambah Kategori</title>
  <link rel="stylesheet" href="../../assets/style.css">
</head>
<body>
  <header>
    <h2>Tambah Kategori</h2>
    <nav>
      <a href="../dashboard.php">Dashboard</a> |
      <a href="index.php">Kategori</a>
    </nav>
  </header>

  <main class="konten">
    <form method="POST">
      <p>
        Nama Kategori<br>
        <input type="text" name="name" required>
      </p>
      <p>
        Deskripsi<br>
        <textarea name="description" rows="5" cols="50" required></textarea>
      </p>
      <p>
        <button type="submit" name="submit">Simpan</button>
        <a href="index.php">Kembali</a>
      </p>
    </form>
  </main>

  <footer>
    <p>&copy; Admin Jalan Santai 2024</p>
  </footer>
</body>
</html>
