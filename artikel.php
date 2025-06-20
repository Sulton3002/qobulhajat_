<?php
include 'koneksi.php';

// Cek apakah parameter id ada
if (!isset($_GET['id'])) {
  echo "Artikel tidak ditemukan.";
  exit;
}

$id = intval($_GET['id']);

// Ambil data artikel
$query = "SELECT a.*, c.id AS cat_id, c.name AS cat_name 
          FROM article a
          LEFT JOIN article_category ac ON a.id = ac.article_id
          LEFT JOIN category c ON ac.category_id = c.id
          WHERE a.id = $id";
$result = mysqli_query($koneksi, $query);
$data = mysqli_fetch_assoc($result);

if (!$data) {
  echo "Artikel tidak ditemukan.";
  exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title><?php echo $data['title']; ?> - Jalan Santai</title>
  <link rel="stylesheet" href="assets/style.css">
</head>
<body>
  <header>
    <h1>Jalan Santai</h1>
    <nav>
      <a href="index.php">Beranda</a>
      <a href="about.php">Tentang</a>
      <a href="contact.php">Kontak</a>
    </nav>
  </header>

  <main class="konten">
    <div class="kiri">
      <h2><?php echo $data['title']; ?></h2>
      <p><small><?php echo $data['date']; ?> | Kategori: 
        <a href="kategori/index.php?id=<?php echo $data['cat_id']; ?>"><?php echo $data['cat_name']; ?></a>
      </small></p>
      <img src="images/<?php echo $data['picture']; ?>" alt="<?php echo $data['title']; ?>" width="100%">
      <div>
        <?php echo $data['content']; ?>
      </div>
    </div>

    <aside class="kanan">
      <div class="widget">
        <h4>Pencarian</h4>
        <form action="search.php" method="GET">
          <input type="text" name="q" placeholder="Kata kunci...">
          <button type="submit">Cari</button>
        </form>
      </div>

      <div class="widget">
        <h4>Artikel Terkait</h4>
        <ul>
          <?php
          $cat_id = $data['cat_id'];
          $related = mysqli_query($koneksi, "SELECT id, title FROM article a 
              JOIN article_category ac ON a.id = ac.article_id 
              WHERE ac.category_id = $cat_id AND a.id != $id 
              ORDER BY date DESC LIMIT 5");
          while ($rel = mysqli_fetch_assoc($related)) {
            echo "<li><a href='artikel.php?id={$rel['id']}'>{$rel['title']}</a></li>";
          }
          ?>
        </ul>
      </div>
    </aside>
  </main>

  <footer>
    <p>&copy; Jalan Santai 2024</p>
  </footer>
</body>
</html>
