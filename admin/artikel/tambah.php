<?php
session_start();
if (!isset($_SESSION['author_id'])) {
  header("Location: ../login.php");
  exit;
}

include '../../koneksi.php';

// Proses simpan artikel
if (isset($_POST['submit'])) {
  $judul = $_POST['title'];
  $tanggal = $_POST['date'];
  $konten = $_POST['content'];
  $kategori_id = $_POST['category_id'];
  $penulis_id = $_SESSION['author_id']; // login user
  $gambar = $_FILES['picture']['name'];

  // Upload gambar
  if ($gambar != "") {
    $tmp = $_FILES['picture']['tmp_name'];
    move_uploaded_file($tmp, "../../images/" . $gambar);
  }

  // Simpan ke tabel article
  $query = "INSERT INTO article (date, title, content, picture) VALUES ('$tanggal', '$judul', '$konten', '$gambar')";
  $insert = mysqli_query($koneksi, $query);
  $article_id = mysqli_insert_id($koneksi);

  // Simpan ke relasi kategori & author
  mysqli_query($koneksi, "INSERT INTO article_category (article_id, category_id) VALUES ($article_id, $kategori_id)");
  mysqli_query($koneksi, "INSERT INTO article_author (article_id, author_id) VALUES ($article_id, $penulis_id)");

  header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Tambah Artikel</title>
  <link rel="stylesheet" href="../../assets/style.css">
</head>
<body>
  <header>
    <h2>Tambah Artikel</h2>
    <nav>
      <a href="../dashboard.php">Dashboard</a> |
      <a href="index.php">Artikel</a>
    </nav>
  </header>

  <main class="konten">
    <form method="POST" enctype="multipart/form-data">
      <p>
        Judul<br>
        <input type="text" name="title" required>
      </p>
      <p>
        Tanggal<br>
        <input type="text" name="date" value="<?php echo date('j F Y'); ?>" required>
      </p>
      <p>
        Kategori<br>
        <select name="category_id" required>
          <option value="">-- Pilih Kategori --</option>
          <?php
          $kategori = mysqli_query($koneksi, "SELECT * FROM category");
          while ($kat = mysqli_fetch_assoc($kategori)) {
            echo "<option value='{$kat['id']}'>{$kat['name']}</option>";
          }
          ?>
        </select>
      </p>
      <p>
        Gambar Artikel<br>
        <input type="file" name="picture">
      </p>
      <p>
        Konten Artikel<br>
        <textarea name="content" rows="10" cols="60" required></textarea>
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
