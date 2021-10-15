<?php
if (!isset($_POST['simpan'])) {
    if (isset($_GET['id'])) { // memperoleh id dari param
        $id_jurusan = $_GET['id'];
        if (!empty($id_jurusan)) {
            // Query
            $sql = "SELECT * FROM jurusan WHERE id = '{$id_jurusan}';";
            $query = mysqli_query($db_conn, $sql);
            $row = $query->num_rows;
            if ($row > 0) {
                $data = mysqli_fetch_array($query); // memperoleh data
            } else {
                echo "<script>alert('ID Jurusan tidak ditemukan!');</script>";
                // mengalihkan halaman
                echo "<meta http-equiv='refresh' content='0; url=index.php?p=admin-jurusan'>";
                exit;
            }
        } else {
            echo "<script>alert('ID Jurusan kosong!');</script>";
            // mengalihkan halaman
            echo "<meta http-equiv='refresh' content='0; url=index.php?p=admin-jurusan'>";
            exit;
        }
    } else {
        echo "<script>alert('ID Jurusan tidak didefinisikan!');</script>";
        // mengalihkan halaman
        echo "<meta http-equiv='refresh' content='0; url=index.php?p=admin-jurusan'>";
        exit;
    }
?>
    <div id="container">
        <div class="page-title">
            <h3>Ubah Data Jurusan</h3>
        </div>
        <div class="page-content">
            <form class="my-4" enctype="multipart/form-data" action="" method="post">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="id_jurusan">ID Jurusan</label>
                        <input type="text" class="form-control" name="id_jurusan" value="<?php echo $data['id']; ?>" readonly>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="nama_jurusan">Nama Jurusan</label>
                        <input type="text" class="form-control" name="nama_jurusan" value="<?php echo $data['nama_jurusan']; ?>" placeholder="Masukan nama Jurusan">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="status">Status</label> <br>
                        <input type="radio" name="status" value="aktif" id="aktif" required <?php echo $data['status'] == 'aktif' ? 'checked' : ''; ?> >
                        <label for="aktif">Aktif</label>
                        <input type="radio" name="status" value="tidak-aktif" id="tidak_aktif" required <?php echo $data['status'] == 'tidak-aktif' ? 'checked' : ''; ?> >
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
    $updated_at = date('Y-m-d H:i:s');
    // Query
    $sql = "UPDATE jurusan
						SET nama_jurusan 	= '{$nama_jurusan}',
							status 	        = '{$status}',
							updated_at	    = '{$updated_at}'
						WHERE id	='{$id_jurusan}'";
    $query = mysqli_query($db_conn, $sql);

    if (!$query) {
        echo "<script>alert('Data gagal diubah!');</script>";
    }
    // mengalihkan halaman
    echo "<meta http-equiv='refresh' content='0; url=index.php?p=admin-jurusan'>";
}
?>