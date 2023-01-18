<?php
    //Set Hak Akses
    $auth = ['Administrator','Dosen'];

    //Memanggil variabel global dan cek auth
    require 'setting/global.php';
    require 'setting/auth.php';

    require 'setting/koneksi.php';
    require 'setting/proses.php';

    //Definisi judul halaman
    $judul_halaman = 'data mahasiswa';

    $db = new koneksi();
    $koneksi =  $db->panggilDatabase();
    $proses = new proses($koneksi);

    $mahasiswa = $proses->tampil_data_where('user','peran_id = 3');
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
                            <div class="col-lg-12">
                                <div class="card-box">
                                    <h4 class="mt-0 header-title">Mahasiswa</h4>
                                    <p class="text-muted font-14 mb-3">
                                        Data mahasiswa yang telah tersimpan.
                                    </p>

                                    <div class="table-responsive">
                                        <table class="table mb-0">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th width="1%">#</th>
                                                    <th>NIM</th>
                                                    <th>Nama</th>
                                                    <th>Username</th>
                                                    <th>Status</th>
                                                    <th width="1%">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php for ($i=0; $i <count($mahasiswa) ; $i++) { ?>
                                                    <tr>
                                                        <th scope="row"><?php echo $i+1 ?></th>
                                                        <td><?php echo $mahasiswa[$i]['nomer_induk'] ?></td>
                                                        <td><?php echo $mahasiswa[$i]['nama'] ?></td>
                                                        <td><?php echo $mahasiswa[$i]['username'] ?></td>
                                                        <td><?php echo $mahasiswa[$i]['status'] == 'Y'? 'Aktif' : 'Nonaktif' ?></td>
                                                        <td style="text-align: center;">
                                                            <div class="btn-group">
                                                                <button onclick="location.href='<?php echo BASE_URL ?>edit-mahasiswa?id=<?php echo $mahasiswa[$i]['id'] ?>'" class="btn btn-icon waves-effect waves-light btn-warning"> <i class="fa fa-wrench"></i> </button>
                                                                <?php if ($mahasiswa[$i]['status'] == 'Y') { ?>
                                                                    <button onclick="location.href='<?php echo BASE_URL ?>kontrol/mahasiswa?aksi=nonaktifkan&id=<?php echo $mahasiswa[$i]['id'] ?>'" class="btn btn-icon waves-effect waves-light btn-danger"> <i class="fas fa-times"></i> </button>
                                                                <?php } else { ?>
                                                                    <button onclick="location.href='<?php echo BASE_URL ?>kontrol/mahasiswa?aksi=aktifkan&id=<?php echo $mahasiswa[$i]['id'] ?>'" class="btn btn-icon waves-effect waves-light btn-danger"> <i class="fas fa-check"></i> </button>
                                                                <?php } ?>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
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