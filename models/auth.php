<?php
    require "models/security.php";

    class Auth extends Security {

        function checkSession() {
            if(!isset($_SESSION['nama'])) {
                echo "<script>location.replace('./')</script>";
                exit; 
            }
        }

        function hasSession() {
            if(isset($_SESSION['nama'])) {
                echo "<script>location.replace('dashboard.php')</script>";
                exit; 
            }
        }

        function register($data) {
            $nama       = $this->clean_all($data['nama']);
            $email      = $this->clean_all($data['email']);
            $password   = $this->clean_all(md5($data['password']));

            $query      = "SELECT email FROM user WHERE email = '$email' ";
            if($this->num_rows($query) > 0) {
                echo "<script>alert('Email sudah ada')
                location.replace('./')</script>";
                exit; 
            }

            $query      = $this->query("INSERT INTO user(nama, email, password) VALUES('$nama','$email','$password')");
            if($query) {
                echo "<script>alert('Register berhasil')
                location.replace('dashboard.php')</script>"; 
            }
        }

        function login($data) {
            $email      = $this->clean_all($data['email']);
            $password   = $this->clean_all(md5($data['password']));

            $query      = "SELECT * FROM user WHERE email = '$email' AND BINARY password = '$password'";
            $rowUser    = $this->getOne($query);

            if($this->num_rows($query) > 0) {
                $_SESSION['nama'] = $rowUser['nama'];

                echo "<script>alert('Sign in berhasil')
                location.replace('dashboard.php')</script>"; 
            } else {
                echo "<script>alert('Username atau Password salah!')
                location.replace('./');</script>";
            }
        }

        function logout() {
            session_start();
            session_unset();
            session_destroy();
            echo "<script>location.replace('./');</script>";
        }
    }
?>