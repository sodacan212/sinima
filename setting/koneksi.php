<?php
    class koneksi{
		//Function untuk memanggil koneksi database
        public function panggilDatabase(){
			$host = 'localhost'; //Set host
			$user = 'root'; //Set username
            $pass = '';  //Set password
			$daba = 'sinima'; //Set database

			//Pengecekan koneksi database sesuai dengan konfigurasi yang sudah disetting
			try {
				$koneksi_database = new PDO("mysql:host=$host;dbname=$daba", $user, $pass);
				$koneksi_database->exec("set names utf8");
                $koneksi_database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

				//Mengembalikan data koneksi database
                return  $koneksi_database;
			}
			//Jika koneksi gagal
			catch (PDOException $e) {
				//Menampilkan error yang terjadi
				echo "<script>alert('Koneksi database gagal atau salah!');document.location='../login';</script>";
			}
		}
	}
?>