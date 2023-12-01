<?php
include 'koneksi.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <style>
        .centered-text {
            text-align: center;
        }

        .orange-underline {
            border-bottom: 3px solid #86A789;
            display: inline-block;
            padding: 0 2px;
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

        .search-box {
        display: flex;
        margin-bottom: 20px;
        position: relative;
    }

    #search-input {
        flex: 1;
        margin-right: 10px;
        border: 1px solid #219C90;
        border-radius: 5px;
        padding: 8px;
        color: #219C90;
        transition: border-color 0.3s;
    }

    #search-input:hover, #search-input:focus {
        border-color: #4C7068;
    }

    .btn-cari {
        background-color: #219C90;
        color: #fff;
        border: 1px solid #219C90;
        border-radius: 5px;
        padding: 8px 15px;
        transition: background-color 0.3s;
    }

    .btn-cari:hover {
        background-color: #4C7068;
        border-color: #4C7068;
    }  
    .btn-cari-produk {
    flex: 1;
    margin-right: 10px;
    border: 1px solid #219C90;
    border-radius: 5px;
    padding: 8px;
    color: #fff; /* Mengubah warna tulisan menjadi putih */
    background-color: #219C90;
    transition: border-color 0.3s;
}

.btn-cari-produk:hover {
    background-color: #4C7068;
    border-color: #4C7068;
}

        
    </style>
</head>

<body>
    
<div class="container mb-2 mt-5">
<h2 class="centered-text mb-3">
        <span class="orange-underline">
            <h1>Produk</h1>
        </span> 
    </h2>
    <div class="d-flex justify-content-between">
        <div class="kembali mb-3">
            <a class="btn btn-primary" href="index.php"><i class="fas fa-chevron-left"></i> Kembali</a>
        </div>

        <!-- Formulir pencarian -->
        <form method="get" action="cari_produk.php" class="search-box d-flex mb-3">
            <input type="text" id="search-input" name="keyword" class="btn btn-outline-secondary btn-cari" placeholder="Cari produk...">
            <button type="submit" class="btn btn-outline-secondary btn-cari">Cari</button>
        </form>
    </div>
    
    <div class="row">
        <?php
        $query = mysqli_query($koneksi, "SELECT * FROM barang");
        while ($row = mysqli_fetch_array($query)) {
        ?>
            <div class="col-md-3">
                <div class="card mb-4">
                    <img src="gambar/<?= $row['gambar_produk'] ?>" class="card-img-top" alt="Produk 1">
                    <div class="card-body">
                        <h5 class="card-title"><?= $row['nama_barang'] ?></h5>
                        <p class="card-text">Rp <?php echo number_format($row['harga_jual'], 0, ',', '.'); ?></p>
                        <div class="card-footer p-2 pt-0 border-top-0 bg-transparent">
                            <div class="text-center">
                                <a type="button" class="btn btn-outline-success" href="detail.php?id=<?php echo $row['id_barang']; ?>">Beli Sekarang</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
</div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>