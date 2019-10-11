<?php 
    require 'models/auth.php';
    $ctrl_auth = new Auth();

    $ctrl_auth->logout();
?>