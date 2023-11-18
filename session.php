<?php

session_start();
if(!isset($_SESSION['username'])){
    header("location:halaman_user/index.php");
}

?>