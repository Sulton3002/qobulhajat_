<?php
session_start();
if (!isset($_SESSION['admin_login'])) {
    header("Location: ../login.php");
    exit;
}
include '../../config/koneksi.php';

$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM authors WHERE id = $id"));

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    mysqli_query($conn, "UPDATE authors SET name='$name' WHERE id=$id");
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Penulis</title>
</head>
<body>
    <h2>Edit Penulis</h2>
    <form method="post">
        <label>Nama Penulis:</label>
        <input type="text" name="name" value="<?= $data['name']; ?>" required>
        <button type="submit">Update</button>
    </form>
</body>
</html>
