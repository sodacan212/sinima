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
            $sql = $this->db->prepare('SELECT user.id, username, user.nama, nomer_induk, peran.nama as nama_peran, status FROM user INNER JOIN peran ON peran.id = user.peran_id WHERE username=? AND password=?');

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

        //Function tampil data
        function tampil_data($tabel)
        {
            //Sql tampil data
            $sql = $this->db->prepare("SELECT * FROM $tabel");
            //Eksekusi sql
            $sql->execute();
            //Mengirim hasil tampil data
            return $sql->fetchAll();
        }

        //Function tampil data dengan kondisi
        function tampil_data_where($tabel,$where)
        {
            //Sql tampil data
            $sql = $this->db->prepare("SELECT * FROM $tabel WHERE $where");
            //Eksekusi sql
            $sql->execute();
            //Mengirim hasil tampil data
            return $sql->fetchAll();
        }
        
        //Function tampil data single
        function tampil_data_single($tabel,$where,$id)
        {
            //Sql tampil data single
            $sql = $this->db->prepare("SELECT * FROM $tabel WHERE $where = ?");
            //Eksekusi sql
            $sql->execute(array($id));
            //Mengirim hasil tampil data single
            return $sql->fetch();
        }

        //Function nonaktifkan data
        function nonaktifkan_data($tabel,$where,$id)
        {
            //Sql nonaktifkan data
            $sql = $this->db->prepare("UPDATE $tabel SET status = 'T' WHERE $where = ?");
            //Kembali & eksekusi sql
            return $sql->execute(array($id));
        }

        //Function aktifkan data
        function aktifkan_data($tabel,$where,$id)
        {
            //Sql aktifkan data
            $sql = $this->db->prepare("UPDATE $tabel SET status = 'Y' WHERE $where = ?");
            //Kembali & eksekusi sql
            return $sql->execute(array($id));
        }
    }
?>