<?php
    class Connection {
        var $host       = "localhost";
        var $username   = "root";
        var $password   = "";
        var $database   = "db_hacktober";

        function conn() {
            $koneksi = mysqli_connect($this->host, $this->username, $this->password) or die("Gagal koneksi database! msg: ". mysqli_connect_error());
            $select_db = mysqli_select_db($koneksi, $this->database) or die("Database tidak ditemukan! msg: ". mysqli_error($koneksi));
            return $koneksi;
        }

        function query($request) {
            return mysqli_query($this->conn(), $request);
        }

        function getList($request) {
            $rows = NULL;
            $query = $this->query($request);
            while($row = $query->fetch_assoc()){
                $rows[] = $row;
            }

            return $rows;
        }

        function getOne($request) {
            $query = $this->query($request);
            $row = $query->fetch_assoc();

            return $row;
        }

	    function num_rows($request){
            return mysqli_num_rows($this->query($request));
        }
    }

?>