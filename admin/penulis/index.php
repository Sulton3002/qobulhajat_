<?php
session_start();
if (!isset($_SESSION['admin_login'])) {
    header("Location: ../login.php");
    exit;
}
include '../../config/koneksi.php';

$penulis = mysqli_query($conn, "SELECT * FROM authors");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Penulis</title>
</head>
<body>
    <h2>Data Penulis</h2>
    <a href="tambah.php">+ Tambah Penulis</a>
    <table border="1" cellpadding="10">
        <tr>
            <th>Nama Penulis</th>
            <th>Aksi</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($penulis)) : ?>
        <tr>
            <td><?= $row['name']; ?></td>
            <td>
                <a href="edit.php?id=<?= $row['id']; ?>">Edit</a> |
                <a href="hapus.php?id=<?= $row['id']; ?>" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
