<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Admin</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <style>
        .navbar {
            background-color: #222831;
        }

        .navbar-brand {
            color: #fff;
        }

        .navbar-nav {
            margin-left: auto;
        }

        .navbar-nav .nav-item {
            margin-right: 15px;
        }

        .navbar-nav .nav-link {
            color: #fff;
        }

        .table-container {
            margin-top: 20px;
        }

        .table-container .table th,
        .table-container .table td {
            vertical-align: middle;
        }

        .table-container .table th {
            background-color: #30475e;
            color: #fff;
        }

        .table-container .table th:first-child,
        .table-container .table td:first-child {
            border-radius: 0.25rem 0 0 0.25rem;
        }

        .table-container .table th:last-child,
        .table-container .table td:last-child {
            border-radius: 0 0.25rem 0.25rem 0;
        }

        .table-container .table .action-icons i {
            cursor: pointer;
            font-size: 1.25rem;
            margin-right: 10px;
        }

        .table-container .table .action-icons i.delete {
            color: #ff5733;
        }

        .table-container .table .action-icons i.edit {
            color: #33ccff;
        }

        /* Tambahkan CSS khusus untuk formulir pencarian */
        .search-form {
            display: flex;
            align-items: center;
        }

        .search-form .form-control {
            flex: 1;
            margin-right: 10px;
        }

        /* Tambahkan CSS untuk tombol "Kembali" */
        .back-button {
            margin-top: 10px;
            display: none; /* Sembunyikan tombol secara default */
        }

        /* CSS untuk pagination */
        .pagination-container {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="../../img/profl_admin.png" alt="Logo" width="50" height="50" class="d-inline-block align-text-center">
                Hai, Admin
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="data_user.php">Data User</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Admin.php">Admin</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="stok_barang.php">Data Barang</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php" onclick="return confirm('Apakah Anda yakin ingin logout?')">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container table-container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Data User</h2>
            <!-- Formulir pencarian -->
            <form method="post" action="" class="search-form">
                <input type="text" name="keyword" class="form-control" placeholder="Cari user...">
                <button type="submit" class="btn btn-outline-secondary">Cari</button>
            </form>
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Tempat Lahir</th>
                    <th>Tanggal Lahir</th>
                    <th>No. Telepon</th>
                    <th>Jenis Kelamin</th>
                    <th>Alamat</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody id="table-body">
                <!-- Isi tabel akan diisi melalui JavaScript -->
            </tbody>
        </table>
        <!-- Tombol untuk kembali ke halaman sebelumnya -->
        <a class="btn btn-secondary back-button" href="data_user.php">Kembali</a>
        <!-- Pagination container -->
        <div class="pagination-container">
            <ul class="pagination" id="pagination">
                <!-- Isi pagination akan diisi melalui JavaScript -->
            </ul>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        // Data user contoh (ganti dengan data sesungguhnya)
        var userData = [
            <?php
            include 'koneksiuser.php';
            $select = mysqli_query($conn, "SELECT * FROM user");
            while ($hasil = mysqli_fetch_array($select)) {
                echo "{";
                echo "nama: '" . $hasil['nama'] . "', ";
                echo "tempat_lahir: '" . $hasil['tempat_lahir'] . "', ";
                echo "tanggal_lahir: '" . $hasil['tanggal_lahir'] . "', ";
                echo "no_telepon: '" . $hasil['no_telepon'] . "', ";
                echo "jenis_kelamin: '" . $hasil['jenis_kelamin'] . "', ";
                echo "alamat: '" . $hasil['alamat'] . "', ";
                echo "username: '" . $hasil['username'] . "', ";
                echo "password: '" . $hasil['password'] . "'";
                echo "},";
            }
            ?>
        ];

        var currentPage = 1;
        var rowsPerPage = 5;
        var totalRows = userData.length;
        var totalPages = Math.ceil(totalRows / rowsPerPage);
        var startIndex = (currentPage - 1) * rowsPerPage;
        var endIndex = startIndex + rowsPerPage;

        function showTablePage() {
            var tableBody = document.getElementById("table-body");
            tableBody.innerHTML = "";
            for (var i = startIndex; i < endIndex; i++) {
                if (i >= totalRows) break;
                var row = document.createElement("tr");
                row.innerHTML = `
                    <td>${i + 1}</td>
                    <td>${userData[i].nama}</td>
                    <td>${userData[i].tempat_lahir}</td>
                    <td>${userData[i].tanggal_lahir}</td>
                    <td>${userData[i].no_telepon}</td>
                    <td>${userData[i].jenis_kelamin}</td>
                    <td>${userData[i].alamat}</td>
                    <td>${userData[i].username}</td>
                    <td>${userData[i].password}</td>
                    <td class="action-buttons">
                        <a href="hapus_data_user.php?id=${i + 1}" class="btn btn-danger delete" title="Hapus" onclick="return confirmDelete();">Hapus</a>
                        <a href="edit_data_user.php?id=${i + 1}" class="btn btn-primary edit" title="Edit">Edit</a>
                    </td>
                `;
                tableBody.appendChild(row);
            }
        }

        function showPagination() {
            var pagination = document.getElementById("pagination");
            pagination.innerHTML = "";

            var prevButton = document.createElement("li");
            prevButton.classList.add("page-item");
            prevButton.innerHTML = `
                <a class="page-link" href="#" aria-label="Previous" id="prev-button">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            `;

            prevButton.addEventListener("click", function (e) {
                e.preventDefault();
                if (currentPage > 1) {
                    currentPage--;
                    updatePage();
                }
            });

            pagination.appendChild(prevButton);

            for (let i = 1; i <= totalPages; i++) {
                var pageButton = document.createElement("li");
                pageButton.classList.add("page-item");
                if (i === currentPage) {
                    pageButton.classList.add("active");
                }
                pageButton.innerHTML = `
                    <a class="page-link" href="#" id="page-${i}">${i}</a>
                `;

                pageButton.addEventListener("click", function (e) {
                    e.preventDefault();
                    currentPage = i;
                    updatePage();
                });

                pagination.appendChild(pageButton);
            }

            var nextButton = document.createElement("li");
            nextButton.classList.add("page-item");
            nextButton.innerHTML = `
                <a class="page-link" href="#" aria-label="Next" id="next-button">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            `;

            nextButton.addEventListener("click", function (e) {
                e.preventDefault();
                if (currentPage < totalPages) {
                    currentPage++;
                    updatePage();
                }
            });

            pagination.appendChild(nextButton);
        }

        function updatePage() {
            startIndex = (currentPage - 1) * rowsPerPage;
            endIndex = startIndex + rowsPerPage;
            showTablePage();
            showPagination();
        }

        updatePage();
    </script>
</body>
</html>
