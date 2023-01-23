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
            $tabel = 'matkul';

            //Aksi tambah mata kuliah
            if(!empty($_GET['aksi'] == 'tambah'))
            {
                //Definisi data input dalam bentuk array
                $data = array(
                    'nama'		    => strip_tags($_POST['nama']),
                    'hari'	        => strip_tags($_POST['hari']),
                    'jam_mulai'		=> strip_tags($_POST['jam_mulai']),
                    'jam_selesai'	=> strip_tags($_POST['jam_selesai']),
                    'dosen_id'		=> strip_tags($_POST['dosen_id']),
                );
                
                //Melakukan proses tambah mata kuliah
                $hasil = $proses->tambah_data($tabel,$data);

                //Jika proses gagal
                if (!$hasil) {
                    //Menuju halaman data mata kuliah dan menampilkan alert gagal
                    echo "<script>alert('Gagal menambahkan! Data mata kuliah gagal ditambahkan!');document.location='../data-mata-kuliah';</script>";
                }
                //Jika proses berhasil
                else {
                    //Menuju halaman data mata kuliah dan menampilkan alert berhasil
                    echo "<script>alert('Berhasil menambahkan! Data mata kuliah telah ditambahkan!');document.location='../data-mata-kuliah';</script>";
                }
            }

            //Aksi ubah mata kuliah
            elseif(!empty($_GET['aksi'] == 'ubah'))
            {
                //Definisi data input dalam bentuk array
                $data = array(
                    'nama'		    => strip_tags($_POST['nama']),
                    'hari'	        => strip_tags($_POST['hari']),
                    'jam_mulai'		=> strip_tags($_POST['jam_mulai']),
                    'jam_selesai'	=> strip_tags($_POST['jam_selesai']),
                    'dosen_id'		=> strip_tags($_POST['dosen_id']),
                );

                //Melakukan proses ubah mata kuliah
                $hasil = $proses->ubah_data($tabel,$data,"id",strip_tags($_GET['id']));

                //Jika proses gagal
                if (!$hasil) {
                    //Menuju halaman data mata kuliah dan menampilkan alert gagal
                    echo "<script>alert('Gagal mengubah! Data mata kuliah gagal diubah!');document.location='../data-mata-kuliah';</script>";
                }
                //Jika proses berhasil
                else {
                    //Menuju halaman data mata kuliah dan menampilkan alert berhasil
                    echo "<script>alert('Berhasil mengubah! Data mata kuliah telah diubah!');document.location='../data-mata-kuliah';</script>";
                }
            }

            //Aksi nonaktifkan mata kuliah
            elseif(!empty($_GET['aksi'] == 'nonaktifkan'))
            {
                //Definisi id data mata kuliah
                $id = $_GET['id'];

                //Melakukan proses nonaktifkan mata kuliah
                $hasil = $proses->nonaktifkan_data($tabel,'id',$id);

                //Jika proses gagal
                if (!$hasil) {
                    //Menuju halaman data mata kuliah dan menampilkan alert gagal
                    echo "<script>alert('Gagal menonaktifkan! Data mata kuliah gagal dinonaktifkan!');document.location='../data-mata-kuliah';</script>";
                }
                //Jika proses berhasil
                else {
                    //Menuju halaman data mata kuliah dan menampilkan alert berhasil
                    echo "<script>alert('Berhasil menonaktifkan! Data mata kuliah telah dinonaktifkan!');document.location='../data-mata-kuliah';</script>";
                }
            }
            
            //Aksi aktifkan mata kuliah
            elseif(!empty($_GET['aksi'] == 'aktifkan'))
            {
                //Definisi id data mata kuliah
                $id = $_GET['id'];

                //Melakukan proses aktifkan mata kuliah
                $hasil = $proses->aktifkan_data($tabel,'id',$id);

                //Jika proses gagal
                if (!$hasil)     {
                    //Menuju halaman data mata kuliah dan menampilkan alert gagal
                    echo "<script>alert('Gagal mengaktifkan! Data mata kuliah gagal diaktifkan!');document.location='../data-mata-kuliah';</script>";
                }
                //Jika proses berhasil
                else {
                    //Menuju halaman data mata kuliah dan menampilkan alert berhasil
                    echo "<script>alert('Berhasil mengaktifkan! Data mata kuliah telah diaktifkan!');document.location='../data-mata-kuliah';</script>";
                }
            }

            //Aksi tambah mahasiswa ke mata kuliah
            elseif(!empty($_GET['aksi'] == 'tambah_mahasiswa'))
            {
                //Mencari data
                $mahasiswa = $proses->tampil_data_where('mahasiswa_matkul','matkul_id = ' . $_GET['id'] . ' AND mahasiswa_id = ' . $_GET['mahasiswa']);

                //Jika data ditemukan
                if ($mahasiswa) {
                    //Menuju halaman data mahasiswa ke mata kuliah dan menampilkan alert gagal
                    echo "<script>alert('Gagal menambahkan! Data mahasiswa sudah ada di mata kuliah!');document.location='../tambah-mahasiswa-mata-kuliah?id=" . $_GET['id'] . "';</script>";
                }
                //Jika data tidak ditemukan
                else {
                    //Definisi data input dalam bentuk array
                    $data = array(
                        'matkul_id'		=> $_GET['id'],
                        'mahasiswa_id'	=> $_GET['mahasiswa'],
                    );
                    
                    //Melakukan proses tambah mahasiswa ke mata kuliah
                    $hasil = $proses->tambah_data('mahasiswa_matkul',$data);

                    //Jika proses gagal
                    if (!$hasil) {
                        //Menuju halaman data mahasiswa ke mata kuliah dan menampilkan alert gagal
                        echo "<script>alert('Gagal menambahkan! Data mahasiswa gagal ditambahkan ke mata kuliah!');document.location='../tambah-mahasiswa-mata-kuliah?id=" . $_GET['id'] . "';</script>";
                    }
                    //Jika proses berhasil
                    else {
                        //Menuju halaman data mahasiswa ke mata kuliah dan menampilkan alert berhasil
                        echo "<script>alert('Berhasil menambahkan! Data mahasiswa telah ditambahkan ke mata kuliah!');document.location='../tambah-mahasiswa-mata-kuliah?id=" . $_GET['id'] . "';</script>";
                    }
                }
            }
            
            //Aksi hapus mahasiswa ke mata kuliah
            elseif(!empty($_GET['aksi'] == 'hapus_mahasiswa'))
            {
                //Mencari data
                $mahasiswa = $proses->tampil_data_where('mahasiswa_matkul','matkul_id = ' . $_GET['id'] . ' AND mahasiswa_id = ' . $_GET['mahasiswa']);

                //Jika data ditemukan
                if (!$mahasiswa) {
                    //Menuju halaman data mahasiswa ke mata kuliah dan menampilkan alert gagal
                    echo "<script>alert('Gagal menghapus! Data mahasiswa tidak ditemukan di mata kuliah!');document.location='../tambah-mahasiswa-mata-kuliah?id=" . $_GET['id'] . "';</script>";
                }
                //Jika data tidak ditemukan
                else {
                    //Definisi data input dalam bentuk array
                    $data = array(
                        'matkul_id'		=> $_GET['id'],
                        'mahasiswa_id'	=> $_GET['mahasiswa'],
                    );
                    
                    //Melakukan proses hapus mahasiswa ke mata kuliah
                    $hasil = $proses->hapus_data('mahasiswa_matkul','matkul_id = ' . $_GET['id'] . ' AND mahasiswa_id = ' . $_GET['mahasiswa']);

                    //Jika proses gagal
                    if (!$hasil) {
                        //Menuju halaman data mahasiswa ke mata kuliah dan menampilkan alert gagal
                        echo "<script>alert('Gagal menghapus! Data mahasiswa gagal dihapus dari mata kuliah!');document.location='../tambah-mahasiswa-mata-kuliah?id=" . $_GET['id'] . "';</script>";
                    }
                    //Jika proses berhasil
                    else {
                        //Menuju halaman data mahasiswa ke mata kuliah dan menampilkan alert berhasil
                        echo "<script>alert('Berhasil menghapus! Data mahasiswa telah dihapus dari mata kuliah!');document.location='../tambah-mahasiswa-mata-kuliah?id=" . $_GET['id'] . "';</script>";
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