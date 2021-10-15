<?php
$id_session = $_SESSION['id_user'];
$query = mysqli_query($db_conn, "SELECT * FROM pendaftaran WHERE id_user = '$id_session'");
$data = mysqli_fetch_array($query);
$row = mysqli_num_rows($query);
//Data jurusan  
$query2 = mysqli_query($db_conn, "SELECT p.minat_id_jurusan_1, j.nama_jurusan FROM pendaftaran p INNER JOIN jurusan j ON j.id = p.minat_id_jurusan_1");
$data2 = mysqli_fetch_array($query2);

$query3 = mysqli_query($db_conn, "SELECT p.minat_id_jurusan_2, j.nama_jurusan FROM pendaftaran p INNER JOIN jurusan j ON j.id = p.minat_id_jurusan_2");
$data3 = mysqli_fetch_array($query3);
?>
<h2>Status Pendaftaran</h2>
<hr class="border-menu">
<div class="py-4">
    <?php 
        if($row > 0){
    ?>
    <div class="card mx-auto" style="width: 18rem;">
        <img class="card-img-top" src="./images/<?php echo $data['foto'];  ?>" alt="Card image cap">
        <div class="card-body">
            <h5 class="card-title"><?= $data['nama_lengkap'] ?></h5>
            <p class="card-text">Asal Sekolah : <?= $data['asal_sekolah'] ?></p>
            <p class="card-text">Jurusan Minat 1 : <?= $data2['nama_jurusan'] ?></p>
            <p class="card-text">Jurusan Minat 2 : <?= $data3['nama_jurusan'] ?></p>
            <a href="./pdf_siswa/<?= $data['foto_skhun'] ?>" target="_blank" class="btn btn-primary">Lihat SKHUN</a>
            <a href="./pdf_siswa/<?= $data['foto_ijazah'] ?>" target="_blank" class="btn btn-primary">Lihat Ijazah</a>
            <?php
            if ($data['status_pendaftaran'] == 'menunggu-verifikasi-berkas') {
            ?>
                <a href="#" class="btn btn-warning mt-2 w-100 btn-sm disabled">Status: Menunggu Verifikasi Berkas Oleh Admin </a>
            <?php } elseif ($data['status_pendaftaran'] == 'menunggu-kelulusan') { ?>
                <a href="#" class="btn btn-primary mt-2 w-100 btn-sm disabled">Status: Persyaratan Umum telah selesai, selanjutnya silahkan tunggu pengumuman kelulusan!</a>
            <?php } elseif ($data['status_pendaftaran'] == 'diterima') { ?>
                <a href="./app/siswa-diterima.php?&id=<?php echo $data['id']; ?>" target="_blank" class="btn btn-success mt-2 w-100 btn-sm">Status: Selamat Anda Dinyatakan Lulus PMB-SMKN1JAKARTA-2021! </a>
            <?php } elseif ($data['status_pendaftaran'] == 'tidak-diterima') { ?>
                <a href="./app/siswa-ditolak.php?&id=<?php echo $data['id']; ?>" target="_blank" class="btn btn-danger mt-2 w-100 btn-sm">Status: Anda gagal masuk ke SMKN 1 JAKARTA! </a>
            <?php } elseif ($data['status_pendaftaran'] == 'cadangan') { ?>
                <a href="./app/siswa-cadangan.php?&id=<?php echo $data['id']; ?>" target="_blank" class="btn btn-info mt-2 w-100 btn-sm">Status: Anda Menjadi Siswa cadangan, silahkan klik untuk informasi selanjutnya! </a>
            <?php } ?>
        </div>
    </div>
    <?php } else { ?>
    <div class="text-center">
        <h1>Silahkan isi form pendaftaran terlebih dahulu</h1>
        <a href="index.php?p=siswa-pendaftaran" class="btn btn-primary">Daftar</a>
    </div>
    <?php } ?>
</div>