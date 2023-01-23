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
    $judul_halaman = 'ubah mata kuliah';

    //Definisi objek koneksi
    $db = new koneksi();
    $koneksi =  $db->panggilDatabase();
    $proses = new proses($koneksi);

    //Hasil tampil data
    $dosen = $proses->tampil_data_where('user','peran_id = 2 AND status = "Y"');
    $matkul = ($proses->tampil_data_where('matkul','id = ' . $_GET['id']))[0];
    
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
                                    <h4 class="m-t-0 header-title">Form Mata Kuliah</h4>
                                    <p class="text-muted mb-3 font-13">Form untuk ubah data mata kuliah.</p>

                                    <form method="POST" action="<?php echo BASE_URL ?>kontrol/mata-kuliah?aksi=ubah&id=<?php echo $_GET['id'] ?>">
                                        <div class="form-row">
                                            <div class="form-group col-md-3">
                                                <label for="inputNama" class="col-form-label">Nama</label>
                                                <input type="text" class="form-control" id="inputNama" name="nama" value="<?php echo $matkul['nama'] ?>">
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="inputDosen" class="col-form-label">Dosen</label>
                                                <select class="form-control" id="inputDosen" name="dosen_id">
                                                    <?php for ($i=0; $i <count($dosen) ; $i++) { ?>
                                                        <option value="<?php echo $dosen[$i]['id'] ?>"<?php echo $dosen[$i]['id'] == $matkul['dosen_id'] ? ' selected' : '' ?>><?php echo $dosen[$i]['nama'] ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-2">
                                                <label for="inputHari" class="col-form-label">Hari</label>
                                                <select class="form-control" id="inputHari" name="hari">
                                                    <option value="Senin"<?php echo 'Senin' == $matkul['hari'] ? ' selected' : '' ?>>Senin</option>
                                                    <option value="Selasa"<?php echo 'Selasa' == $matkul['hari'] ? ' selected' : '' ?>>Selasa</option>
                                                    <option value="Rabu"<?php echo 'Rabu' == $matkul['hari'] ? ' selected' : '' ?>>Rabu</option>
                                                    <option value="Kamis"<?php echo 'Kamis' == $matkul['hari'] ? ' selected' : '' ?>>Kamis</option>
                                                    <option value="Jumat"<?php echo 'Jumat' == $matkul['hari'] ? ' selected' : '' ?>>Jumat</option>
                                                    <option value="Sabtu"<?php echo 'Sabtu' == $matkul['hari'] ? ' selected' : '' ?>>Sabtu</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-2">
                                                <label for="inputJamMulai" class="col-form-label">Jam Mulai</label>
                                                <input type="time" class="form-control" id="inputJamMulai" name="jam_mulai" value="<?php echo $matkul['jam_mulai'] ?>">
                                            </div>
                                            <div class="form-group col-md-2">
                                                <label for="inputJamSelesai" class="col-form-label">Jam Selesai</label>
                                                <input type="time" class="form-control" id="inputJamSelesai" name="jam_selesai" value="<?php echo $matkul['jam_selesai'] ?>">
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