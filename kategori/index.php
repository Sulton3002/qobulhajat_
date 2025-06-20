<?php
include '../koneksi.php';

if (!isset($_GET['id'])) {
  echo "Kategori tidak ditemukan.";
  exit;
}

$kategori_id = intval($_GET['id']);

// Ambil nama kategori
$kategori_q = mysqli_query($koneksi, "SELECT * FROM category WHERE id = $kategori_id");
$kategori = mysqli_fetch_assoc($kategori_q);

if (!$kategori) {
  echo "Kategori tidak ditemukan.";
  exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title><?php echo $kategori['name']; ?> - Jalan Santai</title>
  <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
  <header>
    <h1>Kategori: <?php echo $kategori['name']; ?></h1>
    <nav>
      <a href="../index.php">Beranda</a>
      <a href="../about.php">Tentang</a>
      <a href="../contact.php">Kontak</a>
    </nav>
  </header>

  <main class="konten">
    <div class="kiri">
      <?php
        $artikel = mysqli_query($koneksi, "SELECT * FROM article a 
                  JOIN article_category ac ON a.id = ac.article_id 
                  WHERE ac.category_id = $kategori_id 
                  ORDER BY date DESC");

        if (mysqli_num_rows($artikel) < 1) {
          echo "<p>Belum ada artikel di kategori ini.</p>";
        }

        while ($row = mysqli_fetch_assoc($artikel)) {
      ?>
        <div class="card">
          <img src="../images/<?php echo $row['picture']; ?>" width="100%">
          <h3><?php echo $row['title']; ?></h3>
          <p><small><?php echo $row['date']; ?></small></p>
          <p><?php echo substr(strip_tags($row['content']), 0, 150); ?>...</p>
          <a href="../artikel.php?id=<?php echo $row['id']; ?>">Selengkapnya →</a>
        </div>
      <?php } ?>
    </div>

    <aside class="kanan">
      <div class="widget">
        <h4>Pencarian</h4>
        <form action="../search.php" method="GET">
          <input type="text" name="q" placeholder="Kata kunci...">
          <button type="submit">Cari</button>
        </form>
      </div>

      <div class="widget">
        <h4>Kategori Lain</h4>
        <ul>
          <?php
            $kat = mysqli_query($koneksi, "SELECT * FROM category");
            while ($k = mysqli_fetch_assoc($kat)) {
              echo "<li><a href='index.php?id={$k['id']}'>{$k['name']}</a></li>";
            }
          ?>
        </ul>
      </div>

      <div class="widget">
        <h4>Tentang</h4>
        <p>Blog wisata seputar Malang Raya dan tempat seru lainnya.</p>
      </div>
    </aside>
  </main>

  <footer>
    <p>&copy; Jalan Santai 2024</p>
  </footer>
</body>
</html>
