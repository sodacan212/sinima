<?php
    //Set hak akses
    $auth = ['Administrator'];

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

            //Aksi tambah dosen
            if(!empty($_GET['aksi'] == 'tambah'))
            {
                //Definisi data input dalam bentuk array
                $data = array(
                    'nomer_induk'   => strip_tags($_POST['nomer_induk']),
                    'nama'		    => strip_tags($_POST['nama']),
                    'username'	    => strip_tags($_POST['username']),
                    'password'		=> md5(strip_tags($_POST['password'])),
                    'peran_id'		=> 2,
                );
                
                //Melakukan proses tambah dosen
                $hasil = $proses->tambah_data($tabel,$data);

                //Jika proses gagal
                if (!$hasil) {
                    //Menuju halaman data dosen dan menampilkan alert gagal
                    echo "<script>alert('Gagal menambahkan! Data dosen gagal ditambahkan!');document.location='../data-dosen';</script>";
                }
                //Jika proses berhasil
                else {
                    //Menuju halaman data dosen dan menampilkan alert berhasil
                    echo "<script>alert('Berhasil menambahkan! Data dosen telah ditambahkan!');document.location='../data-dosen';</script>";
                }
            }

            //Aksi ubah dosen
            elseif(!empty($_GET['aksi'] == 'ubah'))
            {
                //Definisi data input dalam bentuk array
                $data = array(
                    'nomer_induk'   => strip_tags($_POST['nomer_induk']),
                    'nama'		    => strip_tags($_POST['nama']),
                    'username'	    => strip_tags($_POST['username']),
                );

                //Jika input password diisi
                if ($_POST['password']) {
                    $data['password'] = md5(strip_tags($_POST['password']));
                }
                
                //Melakukan proses ubah dosen
                $hasil = $proses->ubah_data($tabel,$data,"id",strip_tags($_GET['id']));

                //Jika proses gagal
                if (!$hasil) {
                    //Menuju halaman data dosen dan menampilkan alert gagal
                    echo "<script>alert('Gagal mengubah! Data dosen gagal diubah!');document.location='../data-dosen';</script>";
                }
                //Jika proses berhasil
                else {
                    //Menuju halaman data dosen dan menampilkan alert berhasil
                    echo "<script>alert('Berhasil mengubah! Data dosen telah diubah!');document.location='../data-dosen';</script>";
                }
            }

            //Aksi nonaktifkan dosen
            elseif(!empty($_GET['aksi'] == 'nonaktifkan'))
            {
                //Definisi id data dosen
                $id = $_GET['id'];

                //Mencari data dosen
                $dosen = $proses->tampil_data_where($tabel,'peran_id = 2 AND id = ' . $id);

                //Jika data dosen tidak ditemukan
                if (!$dosen) {
                    //Menuju halaman data dosen dan menampilkan alert gagal
                    echo "<script>alert('Gagal menonaktifkan! Data dosen tidak ditemukan!');document.location='../data-dosen';</script>";
                }
                //Jika data dosen ditemukan
                else {
                    //Melakukan proses nonaktifkan dosen
                    $hasil = $proses->nonaktifkan_data($tabel,'id',$id);

                    //Jika proses gagal
                    if (!$hasil) {
                        //Menuju halaman data dosen dan menampilkan alert gagal
                        echo "<script>alert('Gagal menonaktifkan! Data dosen gagal dinonaktifkan!');document.location='../data-dosen';</script>";
                    }
                    //Jika proses berhasil
                    else {
                        //Menuju halaman data dosen dan menampilkan alert berhasil
                        echo "<script>alert('Berhasil menonaktifkan! Data dosen telah dinonaktifkan!');document.location='../data-dosen';</script>";
                    }
                }
            }
            
            //Aksi aktifkan dosen
            elseif(!empty($_GET['aksi'] == 'aktifkan'))
            {
                //Definisi id data dosen
                $id = $_GET['id'];

                //Mencari data dosen
                $dosen = $proses->tampil_data_where($tabel,'peran_id = 2 AND id = ' . $id);

                //Jika data dosen tidak ditemukan
                if (!$dosen) {
                    //Menuju halaman data dosen dan menampilkan alert gagal
                    echo "<script>alert('Gagal mengaktifkan! Data dosen tidak ditemukan!');document.location='../data-dosen';</script>";
                }
                //Jika data dosen ditemukan
                else {
                    //Melakukan proses aktifkan dosen
                    $hasil = $proses->aktifkan_data($tabel,'id',$id);

                    //Jika proses gagal
                    if (!$hasil)     {
                        //Menuju halaman data dosen dan menampilkan alert gagal
                        echo "<script>alert('Gagal mengaktifkan! Data dosen gagal diaktifkan!');document.location='../data-dosen';</script>";
                    }
                    //Jika proses berhasil
                    else {
                        //Menuju halaman data dosen dan menampilkan alert berhasil
                        echo "<script>alert('Berhasil mengaktifkan! Data dosen telah diaktifkan!');document.location='../data-dosen';</script>";
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