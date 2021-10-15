<?php
/* Kondisi jika tidak melakukan simpan/ submit, maka tampilkan formulir */
if (!isset($_POST['simpan'])) {
    // Mempersiapkan Kode Terbesar 
    $query2 = mysqli_query($db_conn, "SELECT max(id) as id_jurusan FROM jurusan");
    $data = mysqli_fetch_array($query2);
    $id_jurusan_number = $data['id_jurusan'];

    $urutan = (int) substr($id_jurusan_number, 3, 3);
    $urutan++;

    $id_jurusan_number = 'JUR' . sprintf("%03s", $urutan);
?>
    <div id="container">
        <div class="page-title">
            <h3>Tambah Data Jurusan</h3>
        </div>
        <div class="page-content">
            <form class="my-4" enctype="multipart/form-data" action="" method="post">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="id_jurusan">ID Jurusan</label>
                        <input type="text" class="form-control" name="id_jurusan" value="<?php echo $id_jurusan_number; ?>" readonly>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="nama_jurusan">Nama Jurusan</label>
                        <input type="text" class="form-control" name="nama_jurusan" placeholder="Masukan nama Jurusan">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="status">Status</label> <br>
                        <input type="radio" name="status" value="aktif" id="aktif" required>
                        <label for="aktif">Aktif</label>
                        <input type="radio" name="status" value="tidak-aktif" id="tidak_aktif" required>
                        <label for="tidak_aktif">Tidak Aktif</label>
                    </div>
                </div>
                <input type="submit" class="btn btn-primary w-100" name="simpan" value="Simpan" />
            </form>
        </div>
    </div>
<?php
} else {
    /* Proses Penyimpanan Data dari Form */
    $id_jurusan     = $_POST['id_jurusan'];
    $nama_jurusan     = $_POST['nama_jurusan'];
    $status    = $_POST['status'];
    $created_at = date('Y-m-d H:i:s');
    // Query
    $sql = "INSERT INTO jurusan
				VALUES('{$id_jurusan}', '{$nama_jurusan}', '{$status}',
						'{$created_at}', NULL)";
    $query = mysqli_query($db_conn, $sql);
    if (!$query) {
        echo "<script>alert('Data gagal diubah!');</script>";
    }
    // mengalihkan halaman
    echo "<meta http-equiv='refresh' content='0; url=index.php?p=admin-jurusan'>";
}
?>