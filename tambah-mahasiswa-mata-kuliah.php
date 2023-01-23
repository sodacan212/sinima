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
    $judul_halaman = 'tambah mahasiswa ke mata kuliah';

    //Definisi objek koneksi
    $db = new koneksi();
    $koneksi =  $db->panggilDatabase();
    $proses = new proses($koneksi);

    //Hasil tampil data
    $mahasiswa = $proses->tampil_data_where('mahasiswa_matkul','matkul_id = ' . $_GET['id'], 'INNER JOIN user ON mahasiswa_id=user.id','user.*');
    $daftar_mahasiswa = array();
    $where = null;
    foreach ($mahasiswa as $key => $value)
    {
        $daftar_mahasiswa[] = $value['id'];
    }
    if ($daftar_mahasiswa) {
        $where = ' AND id NOT IN (' . implode(',', $daftar_mahasiswa) . ')';
    }
    $semua_mahasiswa = $proses->tampil_data_where('user','peran_id = 3' . $where);
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
                            <div class="col-lg-6">
                                <div class="card-box">
                                    <h4 class="mt-0 header-title">Daftar Mahasiswa</h4>
                                    <p class="text-muted font-14 mb-3">
                                        Data semua mahasiswa.
                                    </p>

                                    <div class="table-responsive">
                                        <table class="table mb-0">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th width="1%">#</th>
                                                    <th>NIM</th>
                                                    <th>Nama</th>
                                                    <th width="1%">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php for ($i=0; $i <count($semua_mahasiswa) ; $i++) { ?>
                                                    <tr>
                                                        <th scope="row"><?php echo $i+1 ?></th>
                                                        <td><?php echo $semua_mahasiswa[$i]['nomer_induk'] ?></td>
                                                        <td><?php echo $semua_mahasiswa[$i]['nama'] ?></td>
                                                        <td><button onclick="location.href='<?php echo BASE_URL ?>kontrol/mata-kuliah?aksi=tambah_mahasiswa&id=<?php echo $matkul['id'] ?>&mahasiswa=<?php echo $semua_mahasiswa[$i]['id'] ?>'" class="btn btn-success">Tambah</button></td>
                                                    </tr>
                                                <?php } if (!count($semua_mahasiswa)) { ?>
                                                    <tr>
                                                        <td colspan="4" style="text-align: center; font-weight: bold;">Belum ada data ditemukan!</td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>

                            <div class="col-lg-6">
                                <div class="card-box">
                                    <h4 class="mt-0 header-title">Daftar Mahasiswa</h4>
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
                                                    <th width="1%">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php for ($i=0; $i <count($mahasiswa) ; $i++) { ?>
                                                    <tr>
                                                        <th scope="row"><?php echo $i+1 ?></th>
                                                        <td><?php echo $mahasiswa[$i]['nomer_induk'] ?></td>
                                                        <td><?php echo $mahasiswa[$i]['nama'] ?></td>
                                                        <td><button onclick="location.href='<?php echo BASE_URL ?>kontrol/mata-kuliah?aksi=hapus_mahasiswa&id=<?php echo $matkul['id'] ?>&mahasiswa=<?php echo $mahasiswa[$i]['id'] ?>'" class="btn btn-danger">Hapus</button></td>
                                                    </tr>
                                                <?php } if (!count($mahasiswa)) { ?>
                                                    <tr>
                                                        <td colspan="4" style="text-align: center; font-weight: bold;">Belum ada data ditemukan!</td>
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