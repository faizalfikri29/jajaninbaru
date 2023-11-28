<?php
include 'koneksi.php'; // Sesuaikan dengan file koneksi Anda

// Pastikan parameter 'id' ada pada URL
if (isset($_GET['id'])) {
    // Mendapatkan id_barang dari URL
    $id_barang = $_GET['id'];

    // Query ambil data barang
    $ambil = $koneksi->query("SELECT * FROM barang WHERE id_barang='$id_barang'");

    // Tampilkan informasi debugging
    echo "ID Barang: " . $id_barang . "<br>";
    var_dump($ambil);

    $stmt = $koneksi->prepare("SELECT * FROM barang WHERE id_barang = 'dana izal.jpg' ?");
    $stmt->bind_param("s", $id_barang);
    $stmt->execute();
    $result = $stmt->get_result();

    // Pastikan data ditemukan sebelum menggunakan fetch_assoc
    if ($ambil->num_rows > 0) {
        $detail = $ambil->fetch_assoc();

        // Tentukan path ke gambar QR Code Dana penjual
        $gambarQRDanaPath = 'dana/' . $detail['dana'];

        // Jika file gambar QR Code Dana penjual ada, tampilkan gambar
        if (file_exists($gambarQRDanaPath)) {
            echo '';
        } else {
            echo 'Gambar QR Code Dana tidak ditemukan.';
        }
    } else {
        echo 'Data barang tidak ditemukan.';
    }
} else {
    echo 'Parameter "id" tidak ditemukan dalam URL.';
} 
$stmt->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    // Tampilkan gambar hanya jika $detail tidak null
    if (isset($detail)) {
        echo '<img src="' . $gambarQRDanaPath . '" alt="QR Code Dana Penjual">';
    }
    ?>
</body>

</html>