<?php
    //Memanggil variabel global dan memanggil class proses
    require '../setting/koneksi.php';
    require '../setting/proses.php';

    //Pembuatan objek koneksi dan proses
    $db = new koneksi();
    $koneksi =  $db->panggilDatabase();
    $proses = new proses($koneksi);

    if(!empty($_GET['aksi'] == 'login'))
    {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $hasil = $proses->proses_login($username,$password);

        if(!$hasil){
            echo "<script>alert('Gagal login! Username atau password salah!');document.location='../login';</script>";
        }
        else{
            session_start();
            $_SESSION['sinima'] = $hasil;
            $_SESSION['username'] = $hasil['username'];
            $_SESSION['nama'] = $hasil['nama'];
            $_SESSION['nama_peran'] = $hasil['nama_peran'];

            echo "<script>alert('Berhasil login! Selamat datang $username!');document.location='../';</script>";
        }
    }
?>