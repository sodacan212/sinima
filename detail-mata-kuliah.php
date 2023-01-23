<?php
    //Set Hak Akses
    $auth = ['Administrator','Dosen','Mahasiswa'];

    //Memanggil variabel global dan cek auth
    require 'setting/global.php';
    require 'setting/auth.php';

    //Memanggil objek koneksi dan proses
    require 'setting/koneksi.php';
    require 'setting/proses.php';

    //Definisi judul halaman
    $judul_halaman = 'detail mata kuliah';

    //Definisi objek koneksi
    $db = new koneksi();
    $koneksi =  $db->panggilDatabase();
    $proses = new proses($koneksi);

    //Hasil tampil data
    $mahasiswa = $proses->tampil_data_where('mahasiswa_matkul','matkul_id = ' . $_GET['id'], 'INNER JOIN user ON mahasiswa_id=user.id','mahasiswa_matkul.*, user.nama as nama_mahasiswa, user.nomer_induk as nim');
    $matkul = ($proses->tampil_data_where('matkul','matkul.id = ' . $_GET['id'],'INNER JOIN user ON dosen_id=user.id','matkul.*, user.nama as nama_dosen'))[0];
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
                                    <h4 class="mb-3 header-title">Mata Kuliah</h4>
                                    <div class="form-row">
                                        <div class="form-group col-md-3">
                                            <label class="col-form-label">Nama</label>
                                            <p><?php echo $matkul['nama'] ?></p>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label class="col-form-label">Dosen</label>
                                            <p><?php echo $matkul['nama_dosen'] ?></p>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label class="col-form-label">Hari</label>
                                            <p><?php echo $matkul['hari'] ?></p>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label class="col-form-label">Jam</label>
                                            <p><?php echo date_format(date_create($matkul['jam_mulai']),"H:i") ?> - <?php echo date_format(date_create($matkul['jam_selesai']),"H:i") ?></p>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card-box">
                                    <h4 class="mt-0 header-title">Mahasiswa</h4>
                                    <p class="text-muted font-14 mb-3">
                                        Data mahasiswa yang mengikuti mata kuliah ini.
                                    </p>

                                    <div class="table-responsive">
                                        <table class="table mb-0">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th width="1%">#</th>
                                                    <th>NIM</th>
                                                    <th>Nama</th>
                                                    <th>Nilai Tugas</th>
                                                    <th>Nilai Keaktifan</th>
                                                    <th>Nilai Kehadiran</th>
                                                    <th>Nilai UTS</th>
                                                    <th>Nilai UAS</th>
                                                    <th>Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php for ($i=0; $i <count($mahasiswa) ; $i++) { ?>
                                                    <tr>
                                                        <th scope="row"><?php echo $i+1 ?></th>
                                                        <td><?php echo $mahasiswa[$i]['nim'] ?></td>
                                                        <td><?php echo $mahasiswa[$i]['nama_mahasiswa'] ?></td>
                                                        <td><?php echo $mahasiswa[$i]['nilai_tugas'] ?></td>
                                                        <td><?php echo $mahasiswa[$i]['nilai_keaktifan'] ?></td>
                                                        <td><?php echo $mahasiswa[$i]['nilai_kehadiran'] ?></td>
                                                        <td><?php echo $mahasiswa[$i]['nilai_uts'] ?></td>
                                                        <td><?php echo $mahasiswa[$i]['nilai_uas'] ?></td>
                                                        <td><?php echo ($mahasiswa[$i]['nilai_tugas']+$mahasiswa[$i]['nilai_keaktifan']+$mahasiswa[$i]['nilai_kehadiran']+$mahasiswa[$i]['nilai_uts']+$mahasiswa[$i]['nilai_uas'])/5 ?></td>
                                                    </tr>
                                                <?php } if (!count($mahasiswa)) { ?>
                                                    <tr>
                                                        <td colspan="9" style="text-align: center; font-weight: bold;">Belum ada data ditemukan!</td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <button class="btn btn-primary mt-3" onclick="history.back()">Kembali</button>
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