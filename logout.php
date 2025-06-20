<?php
session_start();
session_destroy();
header('Location: index.php');
exit;
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="refresh" content="1.5;url=login.php">
    <link rel="stylesheet" href="style.css">
    <title>Logout - My Blog</title>
</head>
<body>
    <div class="auth-container">
        <div class="auth-icon">👋</div>
        <h2>Logout</h2>
        <div class="auth-message success">Anda berhasil logout.<br>Mengalihkan ke halaman login...</div>
    </div>
</body>
</html>
