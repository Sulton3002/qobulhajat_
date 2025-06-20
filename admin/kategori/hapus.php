<?php
session_start();
if (!isset($_SESSION['author_id'])) {
  header("Location: ../login.php");
  exit;
}

include '../../koneksi.php';

if (!isset($_GET['id'])) {
  echo "ID kategori tidak ditemukan.";
  exit;
}

$id = intval($_GET['id']);

// Hapus kategori
mysqli_query($koneksi, "DELETE FROM category WHERE id = $id");

header("Location: index.php");
exit;
?>
