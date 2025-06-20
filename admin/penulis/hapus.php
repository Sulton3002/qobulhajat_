<?php
session_start();
if (!isset($_SESSION['admin_login'])) {
    header("Location: ../login.php");
    exit;
}
include '../../config/koneksi.php';

$id = $_GET['id'];
mysqli_query($conn, "DELETE FROM authors WHERE id = $id");

header("Location: index.php");
?>
