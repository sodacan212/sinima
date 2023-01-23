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
    $judul_halaman = 'tambah mata kuliah';

    //Definisi objek koneksi
    $db = new koneksi();
    $koneksi =  $db->panggilDatabase();
    $proses = new proses($koneksi);

    //Hasil tampil data
    $dosen = $proses->tampil_data_where('user','peran_id = 2 AND status = "Y"');
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
                                    <p class="text-muted mb-3 font-13">Form untuk tambah data mata kuliah.</p>

                                    <form method="POST" action="<?php echo BASE_URL ?>kontrol/mata-kuliah?aksi=tambah">
                                        <div class="form-row">
                                            <div class="form-group col-md-3">
                                                <label for="inputNama" class="col-form-label">Nama</label>
                                                <input type="text" class="form-control" id="inputNama" name="nama">
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="inputDosen" class="col-form-label">Dosen</label>
                                                <select class="form-control" id="inputDosen" name="dosen_id">
                                                    <?php for ($i=0; $i <count($dosen) ; $i++) { ?>
                                                        <option value="<?php echo $dosen[$i]['id'] ?>"><?php echo $dosen[$i]['nama'] ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-2">
                                                <label for="inputHari" class="col-form-label">Hari</label>
                                                <select class="form-control" id="inputHari" name="hari">
                                                    <option value="Senin">Senin</option>
                                                    <option value="Selasa">Selasa</option>
                                                    <option value="Rabu">Rabu</option>
                                                    <option value="Kamis">Kamis</option>
                                                    <option value="Jumat">Jumat</option>
                                                    <option value="Sabtu">Sabtu</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-2">
                                                <label for="inputJamMulai" class="col-form-label">Jam Mulai</label>
                                                <input type="time" class="form-control" id="inputJamMulai" name="jam_mulai">
                                            </div>
                                            <div class="form-group col-md-2">
                                                <label for="inputJamSelesai" class="col-form-label">Jam Selesai</label>
                                                <input type="time" class="form-control" id="inputJamSelesai" name="jam_selesai">
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