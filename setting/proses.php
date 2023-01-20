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

            //Eksekusi dengan set variabel username dan password md5
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

        //Function tambah data
        function tambah_data($tabel,$data)
        {
            //Definisi nama kolom dan values
            $kolom = array_keys($data);
            $value = array_values($data);

            //Definisi tempat value
            $tempat_value = "?";
            for ($i=1; $i < count($data); $i++) { 
                $tempat_value .= ",?";
            }
            
            //Sql tambah data
            $sql = $this->db->prepare("INSERT INTO $tabel (" . implode(", ", $kolom) . ") VALUES (" . $tempat_value . ")");
            
            //Eksekusi dengan set variabel array input
            return $sql->execute($value);
        }

        //Function ubah data
        function ubah_data($tabel,$data,$where,$id)
        {
            //Definisi nama kolom dan values
            $values = array_values($data);
            $values[] = $id;
            $kolom = array();
            foreach ($data as $key => $value)
            {
                $kolom[] = $key . " = ?";
            }

            //Sql ubah data
            $sql = $this->db->prepare("UPDATE $tabel SET ".implode(', ', $kolom)." WHERE $where = ?");

            //Eksekusi dengan set variabel array input
            return $sql->execute($values);
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