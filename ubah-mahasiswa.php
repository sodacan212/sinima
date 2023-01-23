<?php
    //Set Hak Akses
    $auth = ['Administrator','Dosen'];

    //Memanggil variabel global dan cek auth
    require 'setting/global.php';
    require 'setting/auth.php';

    //Memanggil objek koneksi dan proses
    require 'setting/koneksi.php';
    require 'setting/proses.php';

    //Definisi judul halaman
    $judul_halaman = 'ubah mahasiswa';

    //Definisi objek koneksi
    $db = new koneksi();
    $koneksi =  $db->panggilDatabase();
    $proses = new proses($koneksi);

    //Hasil tampil data
    $mahasiswa = ($proses->tampil_data_where('user','peran_id = 3 AND id = ' . $_GET['id']))[0];
    
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title><?php echo ucwords($judul_halaman) ?> - <?php echo APP_HEADER ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="<?php echo APP_HEADER ?>" name="description" />
        <meta content="Trio" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <?php include 'template/style.php' ?>

    </head>

    <body>

        <div id="wrapper">

            <?php include 'template/header.php' ?>

            <?php include 'template/menu.php' ?>
            
            <div class="content-page">
                <div class="content">

                    <!-- Start Content-->
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card-box">
                                    <h4 class="m-t-0 header-title">Form Mahasiswa</h4>
                                    <p class="text-muted mb-3 font-13">Form untuk ubah data mahasiswa.</p>

                                    <form method="POST" action="<?php echo BASE_URL ?>kontrol/mahasiswa?aksi=ubah&id=<?php echo $_GET['id'] ?>">
                                        <div class="form-row">
                                            <div class="form-group col-md-3">
                                                <label for="inputNIM" class="col-form-label">NIM</label>
                                                <input type="text" class="form-control" id="inputNIM" name="nomer_induk" value="<?php echo $mahasiswa['nomer_induk'] ?>">
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="inputNama" class="col-form-label">Nama</label>
                                                <input type="text" class="form-control" id="inputNama" name="nama" value="<?php echo $mahasiswa['nama'] ?>">
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="inputUsername" class="col-form-label">Username</label>
                                                <input type="text" class="form-control" id="inputUsername" name="username" value="<?php echo $mahasiswa['username'] ?>">
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="inputPassword" class="col-form-label">Password</label>
                                                <input type="text" class="form-control" id="inputPassword" name="password">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <button type="submit" class="btn btn-primary float-right">Ubah</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        
                        
                    </div> <!-- container-fluid -->

                </div> <!-- content -->

                <?php include 'template/footer.php' ?>

            </div>

        </div>

        <?php include 'template/script.php' ?>
        
    </body>

</html>