<?php
// Ganti '12345' dengan password MySQL root Anda, atau kosongkan jika tanpa password
$koneksi = mysqli_connect('localhost', 'root', 'sulton03', 'dbcms');
if (!$koneksi) {
    die('Koneksi gagal: ' . mysqli_connect_error());
}
?>
