<?php
    //Memanggil class koneksi & proses
    require '../setting/koneksi.php';
    require '../setting/proses.php';

    //Pembuatan objek koneksi dan proses
    $db = new koneksi();
    $koneksi =  $db->panggilDatabase();
    $proses = new proses($koneksi);

    //Aksi login
    if(!empty($_GET['aksi'] == 'login'))
    {
        //Definisi username & password
        $username = strip_tags($_POST['username']);
        $password = strip_tags($_POST['password']);

        //Mencari data mahasiswa
        $hasil = $proses->proses_login($username,$password);

        //Jika proses pencarian gagal
        if(!$hasil){
            //Menuju halaman data login dan menampilkan alert gagal
            echo "<script>alert('Gagal login! Username atau password salah!');document.location='../login';</script>";
        }
        //Jika proses pencarian berhasil
        else{
            //Jika status T (nonaktif)
            if($hasil['status'] == 'T'){
                //Menuju halaman data login dan menampilkan alert gagal
                if ($hasil['nama_peran'] == "Mahasiswa") {
                    //Menuju halaman data login dan menampilkan alert gagal
                    echo "<script>alert('Akun dinonaktifkan! Harap hubungi administrator atau dosen!');document.location='../login';</script>";
                }
                else {
                    //Menuju halaman data login dan menampilkan alert gagal
                    echo "<script>alert('Akun dinonaktifkan! Harap hubungi administrator!');document.location='../login';</script>";
                }
            }
            //Jika status Y (aktif)
            else{
                //Memulai sesi
                session_start();

                //Mendefinisikan data sesi
                $_SESSION['sinima'] = $hasil;
                $_SESSION['username'] = $hasil['username'];
                $_SESSION['nama'] = $hasil['nama'];
                $_SESSION['nama_peran'] = $hasil['nama_peran'];

                //Menuju halaman data utama dan menampilkan alert berhasil
                echo "<script>alert('Berhasil login! Selamat datang $username!');document.location='../';</script>";
            }
        }
    }
?>