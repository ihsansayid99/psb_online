<?php
    include './config/konfig-umum.php';
    session_start();
    include './config/koneksi-db.php';
    include './helpers/helper.php';
    if(isset($_SESSION['sesi'])){
?>

<?php 
    include './app/layout/header.php';
    include './app/layout/sidebar.php';
?>

    <div class="content-wrapper">
        <div class="col-md-12 py-3">
            <?php include './app/layout/container.php'; ?>
        </div>
    </div>

<?php include './app/layout/footer.php'; ?>

<?php 
    } else {
        header("refresh:0; url=login.php");
    }
?>
