<?php
    //Cek apakah sudah login (sudah ada sesi)
    if(!isset($_SESSION['sinima']) && !isset($_SESSION['username']) && !isset($_SESSION['nama_peran'])) {
        //Menuju halaman login
        header("Location:" . BASE_URL . "login");
    }
    else{
        //Cek apakah memiliki hak akses pada halaman yang dituju
        $tidakmemilikiakses = true;
        for ($i=0; $i < count($auth); $i++) {
            //Jika cocok maka memiliki akses
            if ($_SESSION['nama_peran'] == $auth[$i]) {
                $tidakmemilikiakses = false;
                break;
            }
        }

        //Jika tidak memiliki akses
        if ($tidakmemilikiakses) {
            //Menuju halaman login
            header("Location:" . BASE_URL . "login");
        }
    }
?>