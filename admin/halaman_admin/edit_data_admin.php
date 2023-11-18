<?php
include 'koneksiuser.php';

// Inisialisasi variabel
$id = $nama = $jenis_kelamin = $username = $password = "";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM admin WHERE id = $id";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $data = mysqli_fetch_assoc($result);
        $nama = $data['nama'];
        $jenis_kelamin = $data['jenis_kelamin'];
        $username = $data['username'];
        $password = $data['password'];
    } else {
        echo "Query Error: " . mysqli_error($conn);
        exit;
    }
} else {
    echo "Parameter ID tidak ditemukan.";
    exit;
}

if (isset($_POST['update'])) {
    // Ambil data yang diisi dalam form
    $nama = $_POST['nama'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Update data pengguna
    $updateQuery = "UPDATE admin SET 
        nama = '$nama',  
        jenis_kelamin = '$jenis_kelamin', 
        username = '$username', 
        password = '$password' 
        WHERE id = $id";

    $updateResult = mysqli_query($conn, $updateQuery);

    if ($updateResult) {
        header("Location: admin.php"); // Redirect ke halaman data user setelah mengedit.
        exit;
    } else {
        echo "Update Error: " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Admin</title>
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
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Edit Data Admin</a>
        </div>
    </nav>

    <div class="container">
        <form method="post">
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama" required value="<?php echo $nama; ?>">
            </div>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" name="username" id="username" placeholder="Username" required value="<?php echo $username; ?>">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="Password" required value="<?php echo $password; ?>">
            </div>
            <div class="form-group">
                <label for="jenis_kelamin">Jenis Kelamin</label>
                <select class="form-control" name="jenis_kelamin" id="jenis_kelamin">
                    <option value="Laki-Laki" <?php if ($jenis_kelamin == "Laki-Laki") echo "selected"; ?>>Laki-Laki</option>
                    <option value="Perempuan" <?php if ($jenis_kelamin == "Perempuan") echo "selected"; ?>>Perempuan</option>
                </select>
            </div>
            <button type="submit" name="update" class="btn btn-primary">Simpan Perubahan</button>
            <a class="btn btn-danger" href="admin.php">Batal</a>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
