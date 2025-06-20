<?php
session_start();
include 'koneksi.php';
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Qobul Hajat Healing</title>
    <link rel="stylesheet" href="assets/style.css">
</head>

<body>
    <header>
        <h1>Selamat Datang di Blog Kami!</h1>
        <p>Blog Catatan Wisata dan Jalan-jalan</p>
        <nav>
            <a href="index.php">Beranda</a>
            <a href="about.php">Tentang</a>
            <a href="contact.php">Kontak</a>

            <?php if (isset($_SESSION['user_name'])): ?>
                <span style="color:white;">| Halo, <?php echo $_SESSION['user_name']; ?></span>
                <a href="logout-user.php" class="login-link">Logout</a>
            <?php else: ?>
                <div class="dropdown">
                    <button class="dropbtn">Login ▼</button>
                    <div class="dropdown-content">
                        <a href="/login-user.php">Login User</a>
                        <a href="admin/login.php">Login Admin</a>
                    </div>
                </div>
            <?php endif; ?>
        </nav>


    </header>

    <main class="konten">
        <div class="kiri">
            <?php
            $query = "SELECT * FROM article ORDER BY date DESC LIMIT 7";
            $result = mysqli_query($koneksi, $query);
            while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <div class="card">
                    <img src="images/<?php echo $row['picture']; ?>" alt="<?php echo $row['title']; ?>" width="100%">
                    <h3><?php echo $row['title']; ?></h3>
                    <p><small><?php echo $row['date']; ?></small></p>
                    <p><?php echo substr(strip_tags($row['content']), 0, 150); ?>...</p>
                    <a href="artikel.php?id=<?php echo $row['id']; ?>">Selengkapnya →</a>
                </div>
            <?php } ?>
        </div>

        <aside class="kanan">
            <div class="widget">
                <h4>Pencarian</h4>
                <form action="search.php" method="GET">
                    <input type="text" name="q" placeholder="Masukkan kata kunci...">
                    <button type="submit">Go!</button>
                </form>
            </div>

            <div class="widget">
                <h4>Kategori</h4>
                <ul>
                    <li><a href="kategori/index.php?id=1">Alam</a></li>
                    <li><a href="kategori/index.php?id=2">Budaya</a></li>
                    <li><a href="kategori/index.php?id=3">Petualangan</a></li>
                    <li><a href="kategori/index.php?id=4">Sejarah</a></li>
                    <li><a href="kategori/index.php?id=5">Religi</a></li>
                    <li><a href="kategori/index.php?id=6">Rekreasi</a></li>
                </ul>
            </div>

            <div class="widget">
                <h4>Tentang</h4>
                <p>Sekedar buah tangan catatan wisata dan jalan-jalan ke tempat wisata seputar Malang Raya.</p>
            </div>
        </aside>
    </main>

    <footer>
        <p>&copy; Qobul Hajat 2025</p>
    </footer>
</body>

</html>