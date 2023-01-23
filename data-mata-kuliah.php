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
    $judul_halaman = 'data mata kuliah';

    //Definisi objek koneksi
    $db = new koneksi();
    $koneksi =  $db->panggilDatabase();
    $proses = new proses($koneksi);

    //Hasil tampil data
    if($_SESSION['nama_peran'] == "Administrator") {
        $matkul = $proses->tampil_data('matkul','INNER JOIN user ON dosen_id=user.id','matkul.*, user.nama as nama_dosen');
    } else {
        $matkul = $proses->tampil_data_where('matkul','dosen_id = ' . $_SESSION['sinima']['id'],'INNER JOIN user ON dosen_id=user.id','matkul.*, user.nama as nama_dosen');
    }
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
                                    <?php if($_SESSION['nama_peran'] == "Administrator") { ?>
                                        <div class="float-right">
                                            <a href="<?php echo BASE_URL ?>tambah-mata-kuliah" class="btn btn-info">Tambah</a>
                                        </div>
                                    <?php } ?>
                                    <h4 class="mt-0 header-title">Mata Kuliah</h4>
                                    <p class="text-muted font-14 mb-3">
                                        Data mata kuliah yang telah tersimpan.
                                    </p>

                                    <div class="table-responsive">
                                        <table class="table mb-0">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th width="1%">#</th>
                                                    <th>Nama</th>
                                                    <th>Hari</th>
                                                    <th>Jam</th>
                                                    <?php if($_SESSION['nama_peran'] == "Administrator") { ?>
                                                        <th>Dosen</th>
                                                    <?php } ?>
                                                    <th>Status</th>
                                                    <th width="1%">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php for ($i=0; $i <count($matkul) ; $i++) { ?>
                                                    <tr>
                                                        <th scope="row"><?php echo $i+1 ?></th>
                                                        <td><?php echo $matkul[$i]['nama'] ?></td>
                                                        <td><?php echo $matkul[$i]['hari'] ?></td>
                                                        <td><?php echo date_format(date_create($matkul[$i]['jam_mulai']),"H:i") ?> - <?php echo date_format(date_create($matkul[$i]['jam_selesai']),"H:i") ?></td>
                                                        <?php if($_SESSION['nama_peran'] == "Administrator") { ?>
                                                            <td><?php echo $matkul[$i]['nama_dosen'] ?></td>
                                                        <?php } ?>
                                                        <td><?php echo $matkul[$i]['status'] == 'Y'? 'Aktif' : 'Nonaktif' ?></td>
                                                        <td>
                                                            <div class="btn-group">
                                                                <a href="<?php echo BASE_URL ?>detail-mata-kuliah?id=<?php echo $matkul[$i]['id'] ?>" class="btn btn-secondary">Detail</a>
                                                                <?php if($_SESSION['nama_peran'] == "Administrator") { ?>
                                                                    <a href="<?php echo BASE_URL ?>tambah-mahasiswa-mata-kuliah?id=<?php echo $matkul[$i]['id'] ?>" class="btn btn-primary">Mahasiswa</a>
                                                                    <a href="<?php echo BASE_URL ?>ubah-mata-kuliah?id=<?php echo $matkul[$i]['id'] ?>" class="btn btn-warning">Ubah</a>
                                                                    <?php if ($matkul[$i]['status'] == 'Y') { ?>
                                                                        <button onclick="location.href='<?php echo BASE_URL ?>kontrol/mata-kuliah?aksi=nonaktifkan&id=<?php echo $matkul[$i]['id'] ?>'" class="btn btn-danger">Nonaktifkan</button>
                                                                    <?php } else { ?>
                                                                        <button onclick="location.href='<?php echo BASE_URL ?>kontrol/mata-kuliah?aksi=aktifkan&id=<?php echo $matkul[$i]['id'] ?>'" class="btn btn-success">Aktifkan</button>
                                                                    <?php } ?>
                                                                <?php } else { ?>
                                                                    <?php if ($matkul[$i]['status'] == 'Y') { ?>
                                                                        <a href="<?php echo BASE_URL ?>penilaian-mata-kuliah?id=<?php echo $matkul[$i]['id'] ?>" class="btn btn-success">Penilaian</a>
                                                                    <?php } else { ?>

                                                                    <?php } ?>
                                                                <?php } ?>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php } if (!count($matkul)) { ?>
                                                    <tr>
                                                        <td colspan="7" style="text-align: center; font-weight: bold;">Belum ada data ditemukan!</td>
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