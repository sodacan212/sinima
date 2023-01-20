<?php
    //Set Hak Akses
    $auth = ['Administrator','Dosen'];

    //Memanggil variabel global dan cek auth
    require 'setting/global.php';
    require 'setting/auth.php';

    //Definisi judul halaman
    $judul_halaman = 'tambah mahasiswa';
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
                                    <p class="text-muted mb-3 font-13">Form untuk tambah data mahasiswa.</p>

                                    <form method="POST" action="<?php echo BASE_URL ?>kontrol/mahasiswa?aksi=tambah">
                                        <div class="form-row">
                                            <div class="form-group col-md-3">
                                                <label for="inputNIM" class="col-form-label">NIM</label>
                                                <input type="text" class="form-control" id="inputNIM" name="nomer_induk">
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="inputNama" class="col-form-label">Nama</label>
                                                <input type="text" class="form-control" id="inputNama" name="nama">
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="inputUsername" class="col-form-label">Username</label>
                                                <input type="text" class="form-control" id="inputUsername" name="username">
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="inputPassword" class="col-form-label">Password</label>
                                                <input type="text" class="form-control" id="inputPassword" name="password">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <button type="submit" class="btn btn-primary float-right">Tambah</button>
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