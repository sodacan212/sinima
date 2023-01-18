<?php
    //Set Hak Akses
    $auth = ['Administrator','Dosen'];

    //Memanggil variabel global dan cek auth
    require '../setting/global.php';

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
        else {
            //Memanggil class koneksi & proses
            require '../setting/koneksi.php';
            require '../setting/proses.php';

            //Pembuatan objek koneksi dan proses
            $db = new koneksi();
            $koneksi =  $db->panggilDatabase();
            $proses = new proses($koneksi);

            //Definisi tabel
            $tabel = 'user';

            //Aksi nonaktifkan mahasiswa
            if(!empty($_GET['aksi'] == 'nonaktifkan'))
            {
                //Definisi id data mahasiswa
                $id = $_GET['id'];

                //Mencari data mahasiswa
                $mahasiswa = $proses->tampil_data_where($tabel,'peran_id = 3 AND id = ' . $id);

                //Jika data mahasiswa tidak ditemukan
                if (!$mahasiswa) {
                    //Menuju halaman data mahasiswa dan menampilkan alert gagal
                    echo "<script>alert('Gagal menonaktifkan! Data mahasiswa tidak ditemukan!');document.location='../data-mahasiswa';</script>";
                }
                //Jika data mahasiswa ditemukan
                else {
                    //Melakukan proses nonaktifkan mahasiswa
                    $hasil = $proses->nonaktifkan_data($tabel,'id',$id);

                    //Jika proses gagal
                    if (!$hasil) {
                        //Menuju halaman data mahasiswa dan menampilkan alert gagal
                        echo "<script>alert('Gagal menonaktifkan! Data mahasiswa gagl dinonaktifkan!');document.location='../data-mahasiswa';</script>";
                    }
                    //Jika proses berhasil
                    else {
                        //Menuju halaman data mahasiswa dan menampilkan alert berhasil
                        echo "<script>alert('Berhasil menonaktifkan! Data mahasiswa telah dinonaktifkan');document.location='../data-mahasiswa';</script>";
                    }
                }
            }
            
            //Aksi aktifkan mahasiswa
            elseif(!empty($_GET['aksi'] == 'aktifkan'))
            {
                //Definisi id data mahasiswa
                $id = $_GET['id'];

                //Mencari data mahasiswa
                $mahasiswa = $proses->tampil_data_where($tabel,'peran_id = 3 AND id = ' . $id);

                //Jika data mahasiswa tidak ditemukan
                if (!$mahasiswa) {
                    //Menuju halaman data mahasiswa dan menampilkan alert gagal
                    echo "<script>alert('Gagal mengaktifkan! Data mahasiswa tidak ditemukan!');document.location='../data-mahasiswa';</script>";
                }
                //Jika data mahasiswa ditemukan
                else {
                    //Melakukan proses aktifkan mahasiswa
                    $hasil = $proses->aktifkan_data($tabel,'id',$id);

                    //Jika proses gagal
                    if (!$hasil)     {
                        //Menuju halaman data mahasiswa dan menampilkan alert gagal
                        echo "<script>alert('Gagal mengaktifkan! Data mahasiswa gagl diaktifkan!');document.location='../data-mahasiswa';</script>";
                    }
                    //Jika proses berhasil
                    else {
                        //Menuju halaman data mahasiswa dan menampilkan alert berhasil
                        echo "<script>alert('Berhasil mengaktifkan! Data mahasiswa telah diaktifkan');document.location='../data-mahasiswa';</script>";
                    }
                }
            }

            //Jika tidak ada aksi
            else {
                //Menuju halaman login
                header("Location:" . BASE_URL . "login");
            }
        }
    }
?>