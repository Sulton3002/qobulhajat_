<?php
include 'koneksi.php';

$keyword = isset($_GET['q']) ? mysqli_real_escape_string($koneksi, $_GET['q']) : '';
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Hasil Pencarian "<?php echo $keyword; ?>"</title>
  <link rel="stylesheet" href="assets/style.css">
</head>
<body>
  <header>
    <h1>Hasil Pencarian</h1>
    <nav>
      <a href="index.php">Beranda</a>
      <a href="about.php">Tentang</a>
      <a href="contact.php">Kontak</a>
    </nav>
  </header>

  <main class="konten">
    <div class="kiri">
      <h3>Hasil pencarian untuk: "<?php echo htmlspecialchars($keyword); ?>"</h3>
      <?php
        if ($keyword != '') {
          $result = mysqli_query($koneksi, "SELECT * FROM article 
              WHERE title LIKE '%$keyword%' OR content LIKE '%$keyword%' 
              ORDER BY date DESC");

          if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
      ?>
              <div class="card">
                <img src="images/<?php echo $row['picture']; ?>" width="100%">
                <h3><?php echo $row['title']; ?></h3>
                <p><small><?php echo $row['date']; ?></small></p>
                <p><?php echo substr(strip_tags($row['content']), 0, 150); ?>...</p>
                <a href="artikel.php?id=<?php echo $row['id']; ?>">Selengkapnya →</a>
              </div>
      <?php
            }
          } else {
            echo "<p>Tidak ada artikel ditemukan.</p>";
          }
        } else {
          echo "<p>Masukkan kata kunci untuk mencari artikel.</p>";
        }
      ?>
    </div>

    <aside class="kanan">
      <div class="widget">
        <h4>Pencarian</h4>
        <form action="search.php" method="GET">
          <input type="text" name="q" placeholder="Masukkan kata kunci..." value="<?php echo htmlspecialchars($keyword); ?>">
          <button type="submit">Cari</button>
        </form>
      </div>

      <div class="widget">
        <h4>Kategori</h4>
        <ul>
          <?php
            $kategori = mysqli_query($koneksi, "SELECT * FROM category");
            while ($kat = mysqli_fetch_assoc($kategori)) {
              echo "<li><a href='kategori/index.php?id={$kat['id']}'>{$kat['name']}</a></li>";
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
