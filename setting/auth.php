<?php
    //Cek apakah sudah login (sudah ada sesi)
    if(!isset($_SESSION['sinima']) && !isset($_SESSION['username']) && !isset($_SESSION['nama_peran'])) {
        header("Location:" . BASE_URL . "login");
    }
?>