<?php
include 'koneksi.php'; // Sesuaikan dengan file koneksi Anda

// Mendapatkan id_barang dari URL
$id_barang = $_GET['id'];

// Query ambil data barang
$ambil = $koneksi->query("SELECT * FROM barang WHERE id_barang='$id_barang'");
$detail = $ambil->fetch_assoc();

// Tentukan path ke gambar QR Code Dana penjual
$gambarQRDanaPath = '../../dana/' . $detail['dana'];

// Jika file gambar QR Code Dana penjual ada, tampilkan gambar
if (file_exists($gambarQRDanaPath)) {
    echo '';
}
else {
    echo 'Gambar QR Code Dana tidak ditemukan.';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <img src="' . $gambarQRDanaPath . '" alt="QR Code Dana Penjual">
</body>
</html>