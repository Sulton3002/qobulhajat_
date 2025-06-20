<?php
session_start();
if (!isset($_SESSION['author_id'])) {
  header("Location: login.php");
  exit;
}

include '../koneksi.php';

// Ambil data ringkasan
$jumlah_artikel = mysqli_fetch_row(mysqli_query($koneksi, "SELECT COUNT(*) FROM article"))[0];
$jumlah_kategori = mysqli_fetch_row(mysqli_query($koneksi, "SELECT COUNT(*) FROM category"))[0];
$jumlah_penulis = mysqli_fetch_row(mysqli_query($koneksi, "SELECT COUNT(*) FROM author"))[0];
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Dashboard Admin</title>
  <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
  <header>
    <h2>Dashboard Admin</h2>
    <p>Selamat datang, <?php echo $_SESSION['nickname']; ?> | <a href="logout.php">Logout</a></p>
    <nav>
      <a href="dashboard.php">Beranda</a> |
      <a href="artikel/index.php">Artikel</a> |
      <a href="kategori/index.php">Kategori</a> |
      <a href="penulis/index.php">Penulis</a>
    </nav>
  </header>

  <main class="konten">
    <h3>Ringkasan Data</h3>
    <ul>
      <li>Total Artikel: <strong><?php echo $jumlah_artikel; ?></strong></li>
      <li>Total Kategori: <strong><?php echo $jumlah_kategori; ?></strong></li>
      <li>Total Penulis: <strong><?php echo $jumlah_penulis; ?></strong></li>
    </ul>
  </main>

  <footer>
    <p>&copy; Qobul Hajat 2025</p>
  </footer>
</body>
</html>
