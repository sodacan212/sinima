<?php 
    class proses {
        //Definisi variabel db
        protected $db;
        
        //Function yang akan dijalankan paling pertama
        function __construct($db)
        {
            //Set variabel db
            $this->db = $db;
        }

        //Function proses login
        function proses_login($username,$password)
        {
            //Sql pencarian user login
            $sql = $this->db->prepare('SELECT user.id, username, user.nama, nomer_induk, peran.nama as nama_peran FROM user INNER JOIN peran ON peran.id = user.peran_id WHERE username=? AND password=?');

            //Set variabel username dan password md5
            $sql->execute(array($username,md5($password)));

            //Jika ditemukan data
            if($sql->rowCount() > 0){
                //Set variabel hasil dengan data
                $hasil = $sql->fetch();
            }
            //Jika tidak ditemukan data
            else{
                //Set variabel hasil dengan string gagal
                $hasil = false;
            }

            //Mengembalikan hasil
            return $hasil;
        }
    }
?>