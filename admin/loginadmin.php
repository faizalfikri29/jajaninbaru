<?php
session_start();
require '../koneksi.php';

$username = ""; // Inisialisasi variabel $username

if (isset($_POST['log_admin'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $login = mysqli_query($koneksi, "SELECT username, password FROM admin WHERE username='$username' AND password='$password'");
    $data = mysqli_fetch_assoc($login);
    $cek = mysqli_num_rows($login);

    if ($cek > 0) {
        $_SESSION['username'] = $data['username'];
        $_SESSION['password'] = $data['password'];

        echo "<meta http-equiv=refresh content=0;URL='halaman_admin/index.php'>";
    } else {
        echo "<p align=center><b> Username dan Password salah! <b></p>";
        echo "<meta http-equiv=refresh content=2;URL='loginadmin.php'>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-image: url('../img/4.png'); /* Ganti dengan URL gambar latar belakang Anda */
            background-size: cover;
            background-position: center;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="login-container">
                <h2 class="text-center mb-4">Login Admin</h2>
                <form method="post">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" placeholder="Masukkan Username" name="username" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" placeholder="Masukkan Password" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block" name="log_admin">Login</button>
                    <a class="btn btn-danger btn-block" href="../index.php">Batal</a>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
