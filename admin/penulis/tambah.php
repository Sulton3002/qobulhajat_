<?php
session_start();
if (!isset($_SESSION['admin_login'])) {
    header("Location: ../login.php");
    exit;
}
include '../../config/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    mysqli_query($conn, "INSERT INTO authors (name) VALUES ('$name')");
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Penulis</title>
</head>
<body>
    <h2>Tambah Penulis</h2>
    <form method="post">
        <label>Nama Penulis:</label>
        <input type="text" name="name" required>
        <button type="submit">Simpan</button>
    </form>
</body>
</html>
