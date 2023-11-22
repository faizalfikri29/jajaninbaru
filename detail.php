<?php
include 'koneksi.php';

//mendapatkan id_produk dari url
$id_produk = $_GET['id'];

// query ambil data barang
$ambil = $koneksi->query("SELECT * FROM barang WHERE id_barang='$id_produk'");
$detail = $ambil->fetch_assoc();

// Mendapatkan nomor WhatsApp penjual dari data yang diambil
$nomorWhatsAppPenjual = $detail['no_telpone'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Produk</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <style>
        .product-card {
            display: flex;
            flex-direction: row;
            background-color: #fff;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .product-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .product-image {
            flex: 1;
            max-width: 50%;
            position: relative;
            overflow: hidden;
            border-radius: 8px 0 0 8px;
        }

        .product-image img {
            max-width: 100%;
            height: auto;
            object-fit: cover;
        }

        .product-details {
            flex: 1;
            padding: 1.5rem;
        }

        .product-title {
            font-size: 1.5rem;
            font-weight: bold;
            color: #333;
            margin-bottom: 1rem;
        }

        .product-price {
            font-size: 1.25rem;
            color: #4C7068;
            margin-bottom: 1rem;
        }

        .product-seller {
            font-size: 1rem;
            color: #777;
            margin-bottom: 1rem;
        }

        .product-description {
            font-size: 1rem;
            color: #555;
            margin-bottom: 1rem;
        }

        .buy-button {
            display: block;
            background-color: #4C7068;
            color: #fff;
            padding: 10px 20px;
            text-decoration: none;
            font-weight: bold;
            text-align: center;
            border-radius: 6px;
            transition: background-color 0.3s;
        }

        .buy-button:hover {
            background-color: #219C90;
        }

        /* Tampilan mobile */
        @media (max-width: 768px) {
            .product-card {
                flex-direction: column;
            }

            .product-image {
                max-width: 100%;
                border-radius: 8px 8px 0 0;
            }
        }

        .form-section {
            flex-grow: 1;
        }

        .form-section label {
            display: block;
            margin-bottom: 5px;
        }

        .form-section select,
        .form-section input {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            box-sizing: border-box;
        }

        .form-section button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            cursor: pointer;
        }

        .kembali {
            display: flex;
            align-items: center;
            justify-content: flex-start;
        }

        .kembali a {
            background-color: #219C90;
            color: #fff;
            padding: 10px 10px;
            text-decoration: none;
            font-weight: bold;
            display: flex;
            align-items: center;
            transition: background-color 0.3s;
        }

        .kembali a i {
            margin-left: 5px;
        }

        .kembali a:hover {
            background-color: #4C7068;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <!-- Tombol Kembali -->
        <div class="kembali mb-2">
            <a class="btn btn-primary" href="produk.php"><i class="fas fa-chevron-left"></i> Kembali</a>
        </div>

        <!-- Form Pembelian -->
        <div class="product-card">
            <div class="product-image">
                <img src="gambar/<?php echo $detail["gambar_produk"]; ?>" alt="Foto Produk">
            </div>
            <div class="product-details">
                <h2 class="product-title"><?php echo $detail["nama_barang"]; ?></h2>
                <p class="product-price">Harga: Rp. <?php echo number_format($detail["harga_jual"]); ?></p>
                <p class="product-seller">Penjual : <?php echo $detail["nama_penjual"]; ?> </p>
                <p class="product-seller">Stock : <?php echo $detail["stok"]; ?> </p>
                <p class="product-description"><?php echo $detail["deksripsi_barang"]; ?></p>

                <!-- ... Bagian lain dari kode HTML ... -->

                <!-- Formulir Pembelian -->
                <div class="form-section">
                    <label for="quantity">Jumlah yang Dibeli:</label>
                    <input type="number" id="quantity" name="quantity" min="1" value="#" oninput="updateTotal()">

                    <label for="total">Total:</label>
                    <input type="text" id="total" name="total" placeholder="Rp.0" readonly>

                    <label for="pembayaran">Pembayaran:</label>
                    <select id="pembayaran" name="pembayaran">
                        <option></option>
                        <option value="code">Cod</option>
                        <option value="dana">Dana</option>
                    </select>

                    <label for="buyerName">Nama Pembeli:</label>
                    <input type="text" id="buyerName" name="buyerName" placeholder="Masukkan nama pembeli">

                    <label for="buyerAddress">Alamat Pembeli: (ALAMAT ANTAR PESANAN)</label>
                    <input type="text" id="buyerAddress" name="buyerAddress" placeholder="Masukkan alamat pembeli"></textarea>

                    <label for="buyerPhone">Nomer Telepon Pembeli:</label>
                    <input type="tel" id="buyerPhone" name="buyerPhone" placeholder="Masukkan nomer telepon pembeli">

                    <button type="button" onclick="submitForm()">Beli Sekarang</button>
                </div>

                <script>
                    function updateTotal() {
                        // Ambil nilai jumlah dan harga dari elemen HTML
                        var quantity = document.getElementById('quantity').value;
                        var harga = <?php echo $detail["harga_jual"]; ?>;

                        // Hitung total dan format sebagai mata uang Rupiah
                        var total = quantity * harga;
                        var formattedTotal = "Rp " + number_format(total);

                        // Setel nilai total di elemen HTML
                        document.getElementById('total').value = formattedTotal;
                    }

                    function number_format(number) {
                        return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    }

                    function submitForm() {
                        // Tambahkan logika pengiriman formulir di sini
                        alert("Formulir terkirim!");
                    }
                </script>

                <!-- ... Bagian lain dari kode HTML ... -->
                <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
                <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
                <!-- ... Bagian HTML sebelumnya ... -->

                <script>
                    function submitForm() {
                        // Ambil nilai pembayaran dari elemen HTML
                        var metodePembayaran = document.getElementById('pembayaran').value;

                        // Ambil nilai formulir
                        var quantity = document.getElementById('quantity').value;
                        var total = document.getElementById('total').value;
                        var buyerName = document.getElementById('buyerName').value;
                        var buyerAddress = document.getElementById('buyerAddress').value;
                        var buyerPhone = document.getElementById('buyerPhone').value;

                        // Lakukan pengecekan metode pembayaran
                        if (metodePembayaran === 'code') {
                            // Jika metode pembayaran COD, arahkan ke nomor WhatsApp penjual
                            var message = "Pemesanan Produk";
                            message += "Nama Produk: " + "<?php echo $detail['nama_barang']; ?>";
                            message += "Jumlah: " + quantity;
                            message += "Total: " + total;
                            message += "Nama Pembeli: " + buyerName;
                            message += "Alamat Pembeli: " + buyerAddress;
                            message += "Nomor Telepon Pembeli: " + buyerPhone;

                            // Format nomor WhatsApp penjual
                            var waNumber = "<?php echo $nomorWhatsAppPenjual; ?>";

                            // Buat URL dengan pesan yang diformat
                            var waUrl = "https://wa.me/" + waNumber + "?text=" + encodeURIComponent(message);

                            // Arahkan pengguna ke WhatsApp
                            window.location.href = waUrl;
                        } else if (metodePembayaran === 'dana') {
                            // Jika metode pembayaran Dana, arahkan ke halaman dengan QR Code Dana penjual
                            window.location.href = 'URL_HALAMAN_DANA_QR_CODE_PENJUAL';
                        } else {
                            // Metode pembayaran tidak valid, tampilkan pesan kesalahan
                            alert('Pilih metode pembayaran terlebih dahulu.');
                        }
                    }
                </script>


                <!-- ... Bagian HTML setelahnya ... -->

</body>

</html>