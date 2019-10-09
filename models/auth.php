<?php
    require "models/security.php";

    class Auth extends Security {

        function register($data) {
            $nama       = $this->clean_all($data['nama']);
            $email      = $this->clean_all($data['email']);
            $password   = $this->clean_all($data['password']);

            $query      = "SELECT email FROM user WHERE email = '$emai' ";
            if($this->num_rows($query) > 0) {
                echo "<script>alert('Email sudah ada')
                location.replace('index.php')</script>";
                exit; 
            }

            $query      = $this->query("INSERT INTO user(nama, email, password) VALUES('$nama','$emai','$password')");
            if($query) {
                echo "<script>alert('Register berhasil')
                location.replace('dashboard.php')</script>"; 
            }
        }
    }
?>