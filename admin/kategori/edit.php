<?php
session_start();
if (!isset($_SESSION['author_id'])) {
  header("Location: ../login.php");
  exit;
}

include '../../koneksi.php';

if (!isset($_GET['id'])) {
  echo "ID kategori tidak ditemukan.";
  exit;
}

$id = intval($_GET['id']);
$query = mysqli_query($koneksi, "SELECT * FROM category WHERE id = $id");
$kategori = mysqli_fetch_assoc($query);

if (!$kategori) {
  echo "Data kategori tidak ditemukan.";
  exit;
}

// Proses update
if (isset($_POST['update'])) {
  $nama = $_POST['name'];
  $deskripsi = $_POST['description'];

  mysqli_query($koneksi, "UPDATE category SET name='$nama', description='$deskripsi' WHERE id=$id");
  header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Edit Kategori</title>
  <link rel="stylesheet" href="../../assets/style.css">
</head>
<body>
  <header>
    <h2>Edit Kategori</h2>
    <nav>
      <a href="../dashboard.php">Dashboard</a> |
      <a href="index.php">Kategori</a>
    </nav>
  </header>

  <main class="konten">
    <form method="POST">
      <p>
        Nama Kategori<br>
        <input type="text" name="name" value="<?php echo $kategori['name']; ?>" required>
      </p>
      <p>
        Deskripsi<br>
        <textarea name="description" rows="5" cols="50" required><?php echo $kategori['description']; ?></textarea>
      </p>
      <p>
        <button type="submit" name="update">Update</button>
        <a href="index.php">Batal</a>
      </p>
    </form>
  </main>

  <footer>
    <p>&copy; Admin Jalan Santai 2024</p>
  </footer>
</body>
</html>
