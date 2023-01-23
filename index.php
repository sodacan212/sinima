<?php
    //Set Hak Akses
    $auth = ['Administrator','Dosen','Mahasiswa'];

    //Memanggil variabel global dan cek auth
    require 'setting/global.php';
    require 'setting/auth.php';

    //Definisi judul halaman
    $judul_halaman = 'dashboard';
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

                        <div class="row justify-content-center">
                            <div class="col-sm-6">
                                <div class="card-box">
                                    <div class="row justify-content-center">
                                        <div class="col-sm-6">
                                            <div class="text-center">
                                                <h3>Selamat Datang</h3>
                                                <p class="text-muted">Aplikasi Web <?php echo APP_HEADER ?></p>
                                            </div>
                                        </div><!-- end col -->
                                    </div><!-- end row -->

                                    <div class="row mt-4 mb-4 justify-content-center">
                                        <div class="col-sm-6">
                                            <div class="text-center">
                                                <img src="assets/images/logo-kampus.png" alt="Logo STIKOM">
                                            </div>
                                        </div>
                                        <!-- end col -->
                                    </div>
                                    <!-- end row -->


                                </div>
                            </div><!-- end col -->
                        </div>
                        
                    </div> <!-- container-fluid -->

                </div> <!-- content -->

                <?php include 'template/footer.php' ?>

            </div>

        </div>

        <?php include 'template/script.php' ?>
        
    </body>

</html>