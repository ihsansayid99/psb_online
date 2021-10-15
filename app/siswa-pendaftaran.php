<?php
if (!isset($_POST['submit'])) {
    //mempersiapkan kode terbesar
    $query2 = mysqli_query($db_conn, "SELECT max(id) as id_pendaftaran FROM pendaftaran");
    $data = mysqli_fetch_array($query2);
    $id_pendaftaran_number = $data['id_pendaftaran'];

    $urutan = (int) substr($id_pendaftaran_number, 3, 3);
    $urutan++;

    $id_pendaftaran_number = 'REG' . sprintf("%03s", $urutan);

    //Data Jurusan
    $query_jurusan = mysqli_query($db_conn, "SELECT * FROM jurusan where status='aktif'");
    $query_jurusan_2 = mysqli_query($db_conn, "SELECT * FROM jurusan where status='aktif'");
    
    //Check Sudah mengisi form atau belum
    $id_session = $_SESSION['id_user'];
    $query_check_form_pendaftaran = mysqli_query($db_conn, "SELECT * FROM pendaftaran WHERE id_user = '$id_session'");
    $row_form_pendaftaran = mysqli_num_rows($query_check_form_pendaftaran);
?>
<?php
    if($row_form_pendaftaran <= 0){  
?>
    <h2>Form Pendaftaran Siswa Baru</h2>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php?p=beranda">Homepage</a></li>
            <li class="breadcrumb-item active" aria-current="page">Pendaftaran Siswa Baru</li>
        </ol>
    </nav>
    <div class="container">
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="text-left my-5">
                <h6>Data Diri :</h4>
                    <input type="hidden" class="form-control" name="id_pendaftaran" value="<?php echo $id_pendaftaran_number; ?>">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="nisn">Nomor Induk Nasional Siswa</label>
                            <input type="text" class="form-control" name="nisn" placeholder="Nisn anda..." required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="nama_lengkap">Nama Lengkap</label>
                            <input type="text" class="form-control" name="nama_lengkap" placeholder="Nama anda..." required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="alamat">Alamat</label>
                            <textarea name="alamat" class="form-control" cols="30" rows="2"></textarea>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="no_telp_siswa">No Telp/Hp</label>
                            <input type="text" class="form-control" name="no_telp_siswa" placeholder="No Telp/Hp anda..." required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="password">Jenis Kelamin</label> <br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="jenis_kelamin" id="lakilaki" value="L" required>
                                <label class="form-check-label" for="lakilaki">Laki-Laki</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="jenis_kelamin" id="perempuan" value="P" required>
                                <label class="form-check-label" for="perempuan">Perempuan</label>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="foto">Upload Foto ( 3x4 )</label>
                            <input name="foto" class="form-control" type="file" accept="image/png, image/jpeg" required>
                        </div>
                    </div>
                    <hr class="border-menu">
                    <h6>Data Pendidikan Sebelumnya :</h4>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="asal_sekolah">Asal Sekolah <span class="text-danger small">*Nama Sekolah</span></label>
                                <input type="text" class="form-control" name="asal_sekolah" placeholder="Asal Sekolah anda..." required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="nilai_ebtanas_murni">Nilai Ebtanas Murni ( NEM )</label>
                                <input type="text" class="form-control" name="nilai_ebtanas_murni" placeholder="NEM anda..." required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="foto_ijazah">Scan Ijazah ( *pdf )</label>
                                <input type="file" accept="application/pdf" name="foto_ijazah" class="form-control" required />
                            </div>
                            <div class="form-group col-md-6">
                                <label for="foto_skhun">Scan SKHUN ( *pdf )</label>
                                <input type="file" accept="application/pdf" name="foto_skhun" class="form-control" required />
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="minat_id_jurusan_1">Minat Jurusan 1</label>
                                <select name="minat_id_jurusan_1" class="form-control" required>
                                    <?php
                                    while ($data_jurusan = mysqli_fetch_array($query_jurusan)) {
                                    ?>
                                        <option value="<?= $data_jurusan['id'] ?>"><?= $data_jurusan['nama_jurusan'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="minat_id_jurusan_2">Minat Jurusan 2</label>
                                <select name="minat_id_jurusan_2" class="form-control" required>
                                    <?php
                                    while ($data_jurusan = mysqli_fetch_array($query_jurusan_2)) {
                                    ?>
                                        <option value="<?=$data_jurusan['id'] ?>"><?=$data_jurusan['nama_jurusan'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <hr class="border-menu">
                        <h6>Data Orangtua / Wali :</h4>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="nama_orangtua">Nama Orangtua / wali</label>
                                    <input type="text" class="form-control" name="nama_orangtua" placeholder="Nama Orang tua..." required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="no_telp_orangtua">No telp/hp orangtua</label>
                                    <input type="text" class="form-control" name="no_telp_orangtua" placeholder="No HP orang tua..." required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="alamat_orangtua">Alamat Orangtua/Wali</label>
                                    <textarea name="alamat_orangtua" class="form-control" cols="30" rows="5" required></textarea>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="pekerjaan_orangtua">Pekerjaan Orangtua/Wali</label>
                                    <select name="pekerjaan_orangtua" class="form-control" required>
                                        <option value="irt">Ibu Rumah Tangga</option>
                                        <option value="pns">Pegawai Negeri Sipil</option>
                                        <option value="aparatur-negara">Aparatur Negara</option>
                                        <option value="pengusaha">Pengusaha</option>
                                        <option value="wiraswasta">Wiraswasta</option>
                                        <option value="lainnya">Lainnya</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="gaji_orangtua">Gaji Orangtua</label>
                                    <select name="gaji_orangtua" class="form-control" required>
                                        <option value=">500K"> > 500.000 </option>
                                        <option value=">1JT"> > 1.000.000</option>
                                        <option value=">5JT"> > 5.000.000 </option>
                                        <option value=">10JT"> > 10.000.000 </option>
                                    </select>
                                </div>
                            </div>
                            <button type="submit" name="submit" class="btn btn-primary w-100">Ajukan Sekarang</button>
            </div>
        </form>
    </div>

    <?php 
        } else {
    ?>

    <div class="text-center px-5 py-5">
        <h3>Anda sudah mendaftar, Silahkan klik tombol dibawah untuk melihat instruksi selanjutnya!</h1>
        <a href="index.php?p=siswa-status-pendaftaran" class="btn btn-primary">Status Pendaftaran</a>
    </div>

    <?php } ?>

<?php
} else {
    // Proses Penyimpnanan data dari form
    $id_pendaftaran         = $_POST['id_pendaftaran'];
    $id_user                = $_SESSION['id_user'];
    $nisn                   = $_POST['nisn'];
    $nama_lengkap           = $_POST['nama_lengkap'];
    $alamat                 = $_POST['alamat'];
    $no_telp_siswa          = $_POST['no_telp_siswa'];
    $asal_sekolah           = $_POST['asal_sekolah'];
    $jenis_kelamin          = $_POST['jenis_kelamin'];
    $nilai_ebtanas_murni    = $_POST['nilai_ebtanas_murni'];
    $minat_id_jurusan_1     = $_POST['minat_id_jurusan_1'];
    $minat_id_jurusan_2     = $_POST['minat_id_jurusan_2'];
    $nama_orangtua          = $_POST['nama_orangtua'];
    $alamat_orangtua        = $_POST['alamat_orangtua'];
    $pekerjaan_orangtua     = $_POST['pekerjaan_orangtua'];
    $no_telp_orangtua       = $_POST['no_telp_orangtua'];
    $gaji_orangtua          = $_POST['gaji_orangtua'];
    $status_pendaftaran     = 'menunggu-verifikasi-berkas';
    $created_at             = date('Y-m-d H:i:s');

    //File Upload
    $foto_siswa             = $_FILES['foto']['name'];
    $scan_ijazah            = $_FILES['foto_ijazah']['name'];
    $scan_skhun             = $_FILES['foto_skhun']['name'];

    // kondisi upload foto siswa
    if (!empty($foto_siswa)) {
        // Rename File foto
        $ext_file = pathinfo($foto_siswa, PATHINFO_EXTENSION);
        $file_foto_rename = 'foto-' . $id_pendaftaran . '.' . $ext_file;
        $dir_images = './images/';
        $path_image = $dir_images . $file_foto_rename;
        $foto_siswa = $file_foto_rename; // Keperluan insert to DB
        move_uploaded_file($_FILES['foto']['tmp_name'], $path_image);
    } else {
        $foto_siswa = '-';
    }

    //Kondisi Upload file Ijazah
    if(!empty($scan_ijazah)){
        //Rename File 
        $ext_file = pathinfo($scan_ijazah, PATHINFO_EXTENSION);
        $file_rename = 'IJAZAH-' . $id_pendaftaran . '.' . $ext_file;
        $dir_images = './pdf_siswa/';
        $path_image = $dir_images . $file_rename;
        $scan_ijazah = $file_rename; // Keperluan insert to DB
        move_uploaded_file($_FILES['foto_ijazah']['tmp_name'], $path_image);
    } else {
        $scan_ijazah = '-';
    }

    //Kondisi Upload file SKHUN
    if(!empty($scan_skhun)){
        //Rename File 
        $ext_file = pathinfo($scan_skhun, PATHINFO_EXTENSION);
        $file_rename = 'SKHUN-' . $id_pendaftaran . '.' . $ext_file;
        $dir_images = './pdf_siswa/';
        $path_image = $dir_images . $file_rename;
        $scan_skhun = $file_rename; // Keperluan insert to DB
        move_uploaded_file($_FILES['foto_skhun']['tmp_name'], $path_image);
    } else {
        $scan_skhun = '-';
    }

    //Query
    $sql = "INSERT INTO pendaftaran 
                    VALUES('{$id_pendaftaran}', '{$id_user}', NULL,
                    '{$nisn}', '{$nama_lengkap}', '{$alamat}',
                    '{$no_telp_siswa}', '{$asal_sekolah}', '{$jenis_kelamin}',
                    '{$foto_siswa}', '{$nilai_ebtanas_murni}', '{$scan_ijazah}',
                    '{$scan_skhun}', '{$minat_id_jurusan_1}', '{$minat_id_jurusan_2}',
                    '{$nama_orangtua}', '{$alamat_orangtua}', '{$no_telp_orangtua}',
                    '{$pekerjaan_orangtua}', '{$gaji_orangtua}', '{$status_pendaftaran}',
                    '{$created_at}', NULL)";
    $query = mysqli_query($db_conn, $sql);
    if (!$query) {
        echo "<script>alert('Data gagal diubah!');</script>";
        echo $db_conn->error;
    }
    // mengalihkan halaman
    echo "<meta http-equiv='refresh' content='0; url=index.php?p=beranda'>";
}
?>