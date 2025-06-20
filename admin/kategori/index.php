<?php
session_start();
if (!isset($_SESSION['author_id'])) {
  header("Location: ../login.php");
  exit;
}

include '../../koneksi.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Data Kategori</title>
  <link rel="stylesheet" href="../../assets/style.css">
</head>
<body>
  <header>
    <h2>Manajemen Kategori</h2>
    <p>Halo, <?php echo $_SESSION['nickname']; ?> | <a href="../logout.php">Logout</a></p>
    <nav>
      <a href="../dashboard.php">Dashboard</a> |
      <a href="../artikel/index.php">Artikel</a> |
      <a href="index.php">Kategori</a>
    </nav>
  </header>

  <main class="konten">
    <a href="tambah.php" class="btn">+ Tambah Kategori</a>
    <table border="1" cellpadding="10" cellspacing="0">
      <tr>
        <th>No</th>
        <th>Nama Kategori</th>
        <th>Deskripsi</th>
        <th>Aksi</th>
      </tr>
      <?php
        $no = 1;
        $kategori = mysqli_query($koneksi, "SELECT * FROM category ORDER BY id DESC");
        while ($kat = mysqli_fetch_assoc($kategori)) {
      ?>
      <tr>
        <td><?php echo $no++; ?></td>
        <td><?php echo $kat['name']; ?></td>
        <td><?php echo $kat['description']; ?></td>
        <td>
          <a href="edit.php?id=<?php echo $kat['id']; ?>">Edit</a> |
          <a href="hapus.php?id=<?php echo $kat['id']; ?>" onclick="return confirm('Hapus kategori ini?')">Hapus</a>
        </td>
      </tr>
      <?php } ?>
    </table>
  </main>

  <footer>
    <p>&copy; Admin Jalan Santai 2024</p>
  </footer>
</body>
</html>
