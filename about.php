<?php session_start(); ?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Tentang Kami - Qobul Hajat</title>
    <link rel="stylesheet" href="assets/style.css">
</head>

<body>
    <header>
        <h1>Tentang Qobul Hajat</h1>
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
                        <a href="login-user.php">Login Pengunjung</a>
                        <a href="admin/login.php">Login Admin</a>
                    </div>
                </div>
            <?php endif; ?>
        </nav>


    </header>

    <main class="konten">
        <div class="kiri">
            <h2>Siapa Kami?</h2>
            <p><strong>Qobul Hajat</strong> adalah blog sederhana yang berbagi cerita perjalanan wisata ke berbagai
                tempat menarik, terutama seputar Malang Raya dan sekitarnya.</p>

            <h3>Visi</h3>
            <p>Membagikan informasi wisata lokal dengan cara yang santai dan menyenangkan.</p>

            <h3>Misi</h3>
            <ul>
                <li>Mengenalkan potensi wisata lokal</li>
                <li>Membantu pembaca merencanakan perjalanan</li>
                <li>Menjadi referensi wisata yang informatif dan inspiratif</li>
            </ul>
        </div>
    </main>
    
    <footer>
        <p>&copy; Qobul Hajat 2025</p>
    </footer>
</body>

</html>