<?php session_start(); ?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Kontak Kami - Jalan Santai</title>
    <link rel="stylesheet" href="assets/style.css">
</head>

<body>
    <header>
        <h1>Kontak Kami</h1>
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
            <h2>Hubungi Kami</h2>
            <p>Jika Anda ingin bekerja sama, memberikan saran, atau sekadar menyapa, silakan hubungi kami melalui
                informasi berikut:</p>

            <ul>
                <li>Email: <a href="mailto:qobulhajatstore@gmail.com" target="_blank">qobulhajatstore@gmail.com</a>
                <li>Instagram: <a href="https://instagram.com/soelthoen_03" target="_blank">@qobulhajat</a></li>
                <li>WhatsApp: <a href="https://wa.me/qr/WBAMKYCAOQJTD1" target="_blank">+62 858-9587-0811</a></li>
            </ul>
        </div>
    </main>

    <footer>
        <p>&copy; Qobul Hajat 2025</p>
    </footer>
</body>

</html>