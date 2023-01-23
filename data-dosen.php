<?php
    //Set Hak Akses
    $auth = ['Administrator'];

    //Memanggil variabel global dan cek auth
    require 'setting/global.php';
    require 'setting/auth.php';

    //Memanggil objek koneksi dan proses
    require 'setting/koneksi.php';
    require 'setting/proses.php';

    //Definisi judul halaman
    $judul_halaman = 'data dosen';

    //Definisi objek koneksi
    $db = new koneksi();
    $koneksi =  $db->panggilDatabase();
    $proses = new proses($koneksi);

    //Hasil tampil data
    $dosen = $proses->tampil_data_where('user','peran_id = 2');
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
                                    <div class="float-right">
                                        <a href="<?php echo BASE_URL ?>tambah-dosen" class="btn btn-info">Tambah</a>
                                    </div>
                                    <h4 class="mt-0 header-title">Dosen</h4>
                                    <p class="text-muted font-14 mb-3">
                                        Data dosen yang telah tersimpan.
                                    </p>

                                    <div class="table-responsive">
                                        <table class="table mb-0">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th width="1%">#</th>
                                                    <th>NIP</th>
                                                    <th>Nama</th>
                                                    <th>Username</th>
                                                    <th>Status</th>
                                                    <th width="1%">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php for ($i=0; $i <count($dosen) ; $i++) { ?>
                                                    <tr>
                                                        <th scope="row"><?php echo $i+1 ?></th>
                                                        <td><?php echo $dosen[$i]['nomer_induk'] ?></td>
                                                        <td><?php echo $dosen[$i]['nama'] ?></td>
                                                        <td><?php echo $dosen[$i]['username'] ?></td>
                                                        <td><?php echo $dosen[$i]['status'] == 'Y'? 'Aktif' : 'Nonaktif' ?></td>
                                                        <td>
                                                            <div class="btn-group">
                                                                <a href="<?php echo BASE_URL ?>ubah-dosen?id=<?php echo $dosen[$i]['id'] ?>" class="btn btn-warning">Ubah</a>
                                                                <?php if ($dosen[$i]['status'] == 'Y') { ?>
                                                                    <button onclick="location.href='<?php echo BASE_URL ?>kontrol/dosen?aksi=nonaktifkan&id=<?php echo $dosen[$i]['id'] ?>'" class="btn btn-danger">Nonaktifkan</button>
                                                                <?php } else { ?>
                                                                    <button onclick="location.href='<?php echo BASE_URL ?>kontrol/dosen?aksi=aktifkan&id=<?php echo $dosen[$i]['id'] ?>'" class="btn btn-success">Aktifkan</button>
                                                                <?php } ?>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php } if (!count($dosen)) { ?>
                                                    <tr>
                                                        <td colspan="6" style="text-align: center; font-weight: bold;">Belum ada data ditemukan!</td>
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