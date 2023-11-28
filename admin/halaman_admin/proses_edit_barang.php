<?php
include 'koneksiuser.php';

if (isset($_POST['update'])) {
    $id_barang = $_POST['id_barang'];
    $nama_barang = $_POST['nama_barang'];
    $nama_penjual = $_POST['nama_penjual'];
    $no_telpone = $_POST['no_telpone'];
    $harga_jual = $_POST['harga_jual'];
    $stok = $_POST['stok'];
    $deksripsi_barang = $_POST['deksripsi_barang'];

    // Inisialisasi variabel untuk menyimpan nama gambar
    $image_name = "";
    $image_dana = "";

    // Cek apakah gambar diunggah
    if ($_FILES['gambar_produk']['name']) {
        $image_name = $_FILES['gambar_produk']['name'];
        $temp_image_name = $_FILES['gambar_produk']['tmp_name'];

        // Pindahkan gambar yang diunggah ke folder (misalnya 'gambar/')
        move_uploaded_file($temp_image_name, '../../gambar/' . $image_name);
    }

    // Cek apakah gambar qris dana diunggah
    if ($_FILES['dana']['name']) {
        $image_dana = $_FILES['dana']['name'];
        $temp_image_dana = $_FILES['dana']['tmp_name'];

        // Pindahkan gambar yang diunggah ke folder (misalnya 'gambar/')
        move_uploaded_file($temp_image_dana, '../../dana/' . $image_dana);
    }

    // Tentukan query SQL untuk melakukan update berdasarkan apakah gambar diunggah atau tidak
    if ($image_name || $image_dana) {
        $query = "UPDATE barang SET nama_barang = '$nama_barang', nama_penjual = '$nama_penjual', no_telpone = '$no_telpone', harga_jual = $harga_jual, stok = $stok, deksripsi_barang = '$deksripsi_barang', gambar_produk = '$image_name', dana = '$image_dana' WHERE id_barang = $id_barang";
    } else {
        $query = "UPDATE barang SET nama_barang = '$nama_barang', nama_penjual = '$nama_penjual', no_telpone = '$no_telpone', harga_jual = $harga_jual, stok = $stok, deksripsi_barang = '$deksripsi_barang' WHERE id_barang = $id_barang";
    }

    $update_result = mysqli_query($conn, $query);

    if ($update_result) {
        echo "<script>alert('Data berhasil diupdate.');window.location='stok_barang.php';</script>";
    } else {
        echo "Update failed: " . mysqli_error($conn);
    }
}
