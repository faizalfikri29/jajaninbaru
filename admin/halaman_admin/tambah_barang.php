<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Barang</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .container {
            max-width: 600px;
            margin: 0 auto;
            margin-top: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        img {
            display: block;
            max-width: 120px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Tambah Data Barang</a>
        </div>
    </nav>

    <div class="container">
        <form method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nama_barang">Nama Barang</label>
                <input type="text" class="form-control" name="nama_barang" id="nama_barang" placeholder="Nama barang" required>
            </div>
            <div class="form-group">
                <label for="nama_penjual">Nama Penjual</label>
                <input type="text" class="form-control" name="nama_penjual" id="nama_penjual" placeholder="Nama penjual" required>
            </div>
            <div class="form-group">
                <label for="gambar_produk">Gambar Produk</label>
                <input type="file" class="form-control" name="gambar_produk" id="gambar_produk" required>
            </div>
            <div class="form-group">
                <label for="no_telpone">No Telepon Penjual</label>
                <input type="text" class="form-control" name="no_telpone" id="no_telpone" placeholder="No telepon penjual" required>
            </div>
            <div class="form-group">
                <label for="harga_jual">Harga Jual</label>
                <input type="text" class="form-control" name="harga_jual" id="harga_jual" placeholder="Harga jual" required>
            </div>
            <div class="form-group">
                <label for="stok">Stok</label>
                <input type="text" class="form-control" name="stok" id="stok" placeholder="Stok" required>
            </div>
            <div class="form-group">
                <label for="deksripsi_barang">Deskripsi Barang</label>
                <textarea class="form-control" name="deksripsi_barang" id="deksripsi_barang" rows="4" required></textarea>
            </div>
            <button type="submit" name="simpan" class="btn btn-primary btn-block">Tambah</button>
            <a class="btn btn-danger btn-block" href="stok_barang.php">Batal</a>
        </form>
        <?php
        include 'koneksiuser.php';

        if (isset($_POST['simpan'])) {
            $nama_barang = $_POST['nama_barang'];
            $nama_penjual = $_POST['nama_penjual'];
            $harga_jual = $_POST['harga_jual'];
            $no_telpone = $_POST['no_telpone'];
            $stok = $_POST['stok'];
            $deksripsi_barang = $_POST['deksripsi_barang'];

            // Perbaikan format nomor telepon untuk Indonesia
            $no_telpone = preg_replace("/[^0-9]/", "", $no_telpone); // Hapus karakter selain angka
            $no_telpone = "+62" . ltrim($no_telpone, "0"); // Tambahkan kode negara (+62) jika tidak ada

            if ($_FILES['gambar_produk']['name']) {
                $nama_file = $_FILES['gambar_produk']['name'];
                $ukuran_file = $_FILES['gambar_produk']['size'];
                $tipe_file = $_FILES['gambar_produk']['type'];
                $tmp_file = $_FILES['gambar_produk']['tmp_name'];

                $ekstensi_diperbolehkan = array('png', 'jpg');
                $x = explode('.', $nama_file);
                $ekstensi = strtolower(end($x));

                if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
                    move_uploaded_file($tmp_file, '../../gambar/' . $nama_file);
                    $query = "INSERT INTO barang (nama_barang, nama_penjual, gambar_produk, harga_jual, stok, deksripsi_barang, no_telpone) 
                    VALUES ('$nama_barang', '$nama_penjual', '$nama_file', '$harga_jual', '$stok', '$deksripsi_barang', '$no_telpone')";
                    $result = mysqli_query($conn, $query);
                    if ($result) {
                        echo "<script>alert('Data berhasil ditambahkan!'); window.location='stok_barang.php';</script>";
                    } else {
                        echo "Query Error: " . mysqli_error($conn);
                    }
                } else {
                    echo "<script>alert('Ekstensi gambar hanya bisa jpg dan png!');</script>";
                }
            } else {
                echo "<script>alert('Silahkan upload gambar ke jpg atau png!');</script>";
            }
        }
        ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
