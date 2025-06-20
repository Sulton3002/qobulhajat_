<?php
session_start();
include 'koneksi.php';
$kategori_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$kategori = mysqli_query($conn, "SELECT * FROM category WHERE id=$kategori_id");
$kat = mysqli_fetch_assoc($kategori);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Artikel Kategori <?= htmlspecialchars($kat['name'] ?? '') ?> - My Blog</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include 'navbar.php'; ?>
    <main class="container">
        <div class="row">
            <section class="main-content col-lg-8 mb-4">
                <h2 class="section-title mb-4">Kategori: <?= htmlspecialchars($kat['name'] ?? 'Tidak Ditemukan') ?></h2>
                <div class="row g-4">
                    <?php
                    $result = mysqli_query($conn, "SELECT * FROM article WHERE category_id=$kategori_id ORDER BY date DESC");
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<div class="col-md-6 col-lg-4">';
                        echo '  <div class="card h-100 shadow-sm">';
                        if (!empty($row['picture'])) {
                            echo "      <img src='img/" . htmlspecialchars($row['picture']) . "' alt='Gambar Artikel' class='card-img-top' style='object-fit:cover;height:180px;'>";
                        }
                        echo '      <div class="card-body d-flex flex-column">';
                        echo "          <h5 class='card-title'><a href='detail.php?id={$row['id']}' class='text-decoration-none'>" . htmlspecialchars($row['title']) . "</a></h5>";
                        echo "          <p class='card-subtitle mb-2 text-muted'>" . date('l, d F Y', strtotime($row['date'])) . "</p>";
                        echo "          <p class='card-text'>" . htmlspecialchars(mb_substr(strip_tags($row['content']), 0, 120)) . "...</p>";
                        echo "          <a href='detail.php?id={$row['id']}' class='btn btn-primary mt-auto'>Baca Selengkapnya &rarr;</a>";
                        echo '      </div>';
                        echo '  </div>';
                        echo '</div>';
                    }
                    ?>
                </div>
            </section>
            <aside class="sidebar col-lg-4">
                <?php include 'templates/sidebar.php'; ?>
            </aside>
        </div>
    </main>
    <footer class="site-footer bg-dark text-white py-3 mt-4">
        <div class="container text-center">
            &copy; <?= date('Y') ?> My Blog. All rights reserved.
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
