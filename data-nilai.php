<?php
    //Set Hak Akses
    $auth = ['Mahasiswa'];

    //Memanggil variabel global dan cek auth
    require 'setting/global.php';
    require 'setting/auth.php';

    //Memanggil objek koneksi dan proses
    require 'setting/koneksi.php';
    require 'setting/proses.php';

    //Definisi judul halaman
    $judul_halaman = 'data nilai';

    //Definisi objek koneksi
    $db = new koneksi();
    $koneksi =  $db->panggilDatabase();
    $proses = new proses($koneksi);

    //Hasil tampil data
    $nilai = $proses->tampil_data_where('mahasiswa_matkul','mahasiswa_id = ' . $_SESSION['sinima']['id'],'INNER JOIN matkul ON matkul_id=matkul.id INNER JOIN user ON dosen_id=user.id','matkul.*,mahasiswa_matkul.*, user.nama as nama_dosen');
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
                                    <h4 class="mt-0 header-title">Nilai</h4>
                                    <p class="text-muted font-14 mb-3">
                                        Data nilai dari mata kuliah yang diikuti.
                                    </p>

                                    <div class="table-responsive">
                                        <table class="table mb-0">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th width="1%">#</th>
                                                    <th>Nama</th>
                                                    <th>Hari</th>
                                                    <th>Jam</th>
                                                    <th>Dosen</th>
                                                    <th>Nilai Tugas</th>
                                                    <th>Nilai Keaktifan</th>
                                                    <th>Nilai Kehadiran</th>
                                                    <th>Nilai UTS</th>
                                                    <th>Nilai UAS</th>
                                                    <th>Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php for ($i=0; $i <count($nilai) ; $i++) { $total = ($nilai[$i]['nilai_tugas']+$nilai[$i]['nilai_keaktifan']+$nilai[$i]['nilai_kehadiran']+$nilai[$i]['nilai_uts']+$nilai[$i]['nilai_uas'])/5; ?>
                                                    <tr>
                                                        <th scope="row"><?php echo $i+1 ?></th>
                                                        <td><?php echo $nilai[$i]['nama'] ?></td>
                                                        <td><?php echo $nilai[$i]['hari'] ?></td>
                                                        <td><?php echo date_format(date_create($nilai[$i]['jam_mulai']),"H:i") ?> - <?php echo date_format(date_create($nilai[$i]['jam_selesai']),"H:i") ?></td>
                                                        <td><?php echo $nilai[$i]['nama_dosen'] ?></td>
                                                        <td><?php echo $nilai[$i]['nilai_tugas'] ?></td>
                                                        <td><?php echo $nilai[$i]['nilai_keaktifan'] ?></td>
                                                        <td><?php echo $nilai[$i]['nilai_kehadiran'] ?></td>
                                                        <td><?php echo $nilai[$i]['nilai_uts'] ?></td>
                                                        <td><?php echo $nilai[$i]['nilai_uas'] ?></td>
                                                        <td><?php echo $total ?></td>
                                                    </tr>
                                                <?php } if (!count($nilai)) { ?>
                                                    <tr>
                                                        <td colspan="11" style="text-align: center; font-weight: bold;">Belum ada data ditemukan!</td>
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