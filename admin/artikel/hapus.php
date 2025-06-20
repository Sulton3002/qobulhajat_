<?php
session_start();
if (!isset($_SESSION['author_id'])) {
  header("Location: ../login.php");
  exit;
}

include '../../koneksi.php';

if (!isset($_GET['id'])) {
  echo "ID artikel tidak ditemukan.";
  exit;
}

$id = intval($_GET['id']);

// Ambil gambar untuk dihapus dari folder
$data = mysqli_query($koneksi, "SELECT picture FROM article WHERE id=$id");
$artikel = mysqli_fetch_assoc($data);
if ($artikel && $artikel['picture'] != "") {
  $gambar_path = "../../images/" . $artikel['picture'];
  if (file_exists($gambar_path)) {
    unlink($gambar_path); // Hapus file gambar
  }
}

// Hapus artikel, kategori, dan penulis (karena pakai FOREIGN KEY CASCADE)
mysqli_query($koneksi, "DELETE FROM article WHERE id=$id");

header("Location: index.php");
exit;
?>
