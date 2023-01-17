<?php
    ///Memanggil variabel global dan cek auth
    include '../setting/global.php';
    include '../setting/auth.php';

    //Simpan username user
	$username = $_SESSION['username'];

    //Menghancurkan sesi
	session_destroy();
    
    //Menampilkan alert logout dan kembali ke home
	echo "<script>alert('Terima kasih $username, anda berhasil logout!');document.location='../login';</script>";
?>