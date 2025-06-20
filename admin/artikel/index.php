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
  <title>Data Artikel</title>
  <link rel="stylesheet" href="../../assets/style.css">
</head>
<body>
  <header>
    <h2>Manajemen Artikel</h2>
    <p>Halo, <?php echo $_SESSION['nickname']; ?> | <a href="../logout.php">Logout</a></p>
    <nav>
      <a href="../dashboard.php">Dashboard</a> |
      <a href="index.php">Artikel</a> |
      <a href="../kategori/index.php">Kategori</a> |
      <a href="../penulis/index.php">Penulis</a>
    </nav>
  </header>

  <main class="konten">
    <a href="tambah.php" class="btn">+ Tambah Artikel</a>
    <table border="1" cellpadding="10" cellspacing="0">
      <tr>
        <th>No</th>
        <th>Judul</th>
        <th>Tanggal</th>
        <th>Gambar</th>
        <th>Aksi</th>
      </tr>
      <?php
        $no = 1;
        $artikel = mysqli_query($koneksi, "SELECT * FROM article ORDER BY id DESC");
        while ($row = mysqli_fetch_assoc($artikel)) {
      ?>
      <tr>
        <td><?php echo $no++; ?></td>
        <td><?php echo $row['title']; ?></td>
        <td><?php echo $row['date']; ?></td>
        <td>
          <?php if ($row['picture']) { ?>
            <img src="../../images/<?php echo $row['picture']; ?>" width="100">
          <?php } else { echo "-"; } ?>
        </td>
        <td>
          <a href="edit.php?id=<?php echo $row['id']; ?>">Edit</a> | 
          <a href="hapus.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Hapus artikel ini?')">Hapus</a>
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
