<?php
session_start();
if (!isset($_SESSION['author_id'])) {
  header("Location: ../login.php");
  exit;
}

include '../../koneksi.php';

// Cek artikel
if (!isset($_GET['id'])) {
  echo "ID tidak ditemukan.";
  exit;
}

$id = intval($_GET['id']);

// Ambil data artikel + kategori
$query = "SELECT a.*, ac.category_id 
          FROM article a
          LEFT JOIN article_category ac ON a.id = ac.article_id
          WHERE a.id = $id";
$result = mysqli_query($koneksi, $query);
$artikel = mysqli_fetch_assoc($result);

if (!$artikel) {
  echo "Artikel tidak ditemukan.";
  exit;
}

// Proses update
if (isset($_POST['update'])) {
  $judul = $_POST['title'];
  $tanggal = $_POST['date'];
  $konten = $_POST['content'];
  $kategori_id = $_POST['category_id'];

  // Upload gambar baru jika ada
  if ($_FILES['picture']['name'] != "") {
    $gambar = $_FILES['picture']['name'];
    $tmp = $_FILES['picture']['tmp_name'];
    move_uploaded_file($tmp, "../../images/" . $gambar);
  } else {
    $gambar = $artikel['picture'];
  }

  // Update artikel
  mysqli_query($koneksi, "UPDATE article SET title='$judul', date='$tanggal', content='$konten', picture='$gambar' WHERE id=$id");

  // Update kategori
  mysqli_query($koneksi, "UPDATE article_category SET category_id=$kategori_id WHERE article_id=$id");

  header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Edit Artikel</title>
  <link rel="stylesheet" href="../../assets/style.css">
</head>
<body>
  <header>
    <h2>Edit Artikel</h2>
    <nav>
      <a href="../dashboard.php">Dashboard</a> |
      <a href="index.php">Artikel</a>
    </nav>
  </header>

  <main class="konten">
    <form method="POST" enctype="multipart/form-data">
      <p>
        Judul<br>
        <input type="text" name="title" value="<?php echo $artikel['title']; ?>" required>
      </p>
      <p>
        Tanggal<br>
        <input type="text" name="date" value="<?php echo $artikel['date']; ?>" required>
      </p>
      <p>
        Kategori<br>
        <select name="category_id" required>
          <option value="">-- Pilih Kategori --</option>
          <?php
          $kategori = mysqli_query($koneksi, "SELECT * FROM category");
          while ($kat = mysqli_fetch_assoc($kategori)) {
            $sel = ($kat['id'] == $artikel['category_id']) ? 'selected' : '';
            echo "<option value='{$kat['id']}' $sel>{$kat['name']}</option>";
          }
          ?>
        </select>
      </p>
      <p>
        Gambar Saat Ini:<br>
        <?php if ($artikel['picture']) { ?>
          <img src="../../images/<?php echo $artikel['picture']; ?>" width="150"><br>
        <?php } ?>
        Ganti Gambar:<br>
        <input type="file" name="picture">
      </p>
      <p>
        Konten Artikel<br>
        <textarea name="content" rows="10" cols="60" required><?php echo $artikel['content']; ?></textarea>
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
