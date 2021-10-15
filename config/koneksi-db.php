<?php 
    $hostname = 'localhost';
    $user = 'root';
    $password = '';
    $db_name = 'psb_online';

    $db_conn = mysqli_connect($hostname, $user, $password, $db_name);

    if(!$db_conn) {
        die('Gagal terhubung ke database : ' . mysqli_connect_error());
    }
?>