<?php 
    // menentukan halaman berdasarkan menu yang dipilih
    $app_dir = 'app';

    $p = '';
    if(isset($_GET['p'])){
        $p = $_GET['p'];
    }

    // Lakukan include file *.php sesuai halaman yang dituju
    if(!empty($p)){
        $file = $app_dir . '/' . $p . '.php';

        if(file_exists($file)){ // memeriksa file .php tersedia / tidak
            include $file;
        } else {
            include $app_dir . '/404.php';
        }
    } else {
        include $app_dir . '/beranda.php';
    }
?>