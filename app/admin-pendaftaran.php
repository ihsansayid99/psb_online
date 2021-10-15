<?php

$row = 0;
$num = 0;
$offset = 0;
if (!isset($_POST['cari'])) { // Jika tidak melakukan pencarian anggota
    /*** Pagination ***/
    if (isset($_GET['num'])) { // Jika menggunakan pagination
        $num = (int)$_GET['num'];

        if ($num > 0) {
            $offset = ($num * $_QUERY_LIMIT) - $_QUERY_LIMIT;
        }
    }

    /* Query Main */
    $sql = "SELECT * FROM pendaftaran ORDER BY id DESC LIMIT {$offset}, {$_QUERY_LIMIT};";
    $query = mysqli_query($db_conn, $sql);

    /* Query Count All */
    $sql_count = "SELECT id FROM pendaftaran;";
    $query_count = mysqli_query($db_conn, $sql_count);
    $row = $query_count->num_rows;
} else { // Jika melakukan pencarian anggota
    /*** Pencarian ***/
    $kata_kunci = $_POST['kata_kunci'];

    if (!empty($kata_kunci)) {
        /* Query Pencarian */
        $sql = "SELECT * FROM pendaftaran 
					WHERE id LIKE '%{$kata_kunci}%'
						OR nama_lengkap LIKE '%{$kata_kunci}%'
						OR alamat LIKE '%{$kata_kunci}%'
                        OR no_telp_siswa LIKE '%{$kata_kunci}%'
                        OR jenis_kelamin LIKE '%{$kata_kunci}%'
                        OR status_pendaftaran LIKE '%{$kata_kunci}%'
					ORDER BY id DESC;";
        $query = mysqli_query($db_conn, $sql);
        $row = $query->num_rows;
    }
}
?>

<?php
if (isset($_POST['ubah-status'])) {
    $id_pendaftaran = $_POST['id'];
    $status_pendaftaran = $_POST['status_pendaftaran'];

    $sql = "UPDATE pendaftaran SET status_pendaftaran = '{$status_pendaftaran}'
            WHERE id = '{$id_pendaftaran}'";
    $query = mysqli_query($db_conn, $sql);
    if (!$query) {
        echo "<script>alert('gagal diubah!');</script>";
    }
    header("refresh:0; url=index.php?p=admin-pendaftaran");
}
?>

<div id="container">
    <div class="page-title">
        <h3>Data Pendaftaran Siswa Baru</h3>
    </div>
    <div class="page-content">
        <div class="table-upper">
            <div class="table-upper-left">
                <a href="./app/admin-cetak-pendaftar.php" title="Cetak Anggota" target="_blank">
                    <img src="./assets/img/print.png" width="50" class="btn-print">
                </a>
            </div>
            <div class="table-upper-right">
                <form name="pencarian" action="" method="post" class="mg-top-15 text-right">
                    <input type="text" name="kata_kunci" class="input_search">
                    <input type="submit" name="cari" value="Cari" class="btn btn-success">
                </form>
            </div>
        </div>

        <?php
        if ($row > 0) {
        ?>
            <div class="table-responsive">
                <table class="table data-table">
                    <thead class="thead-dark">
                        <tr>
                            <th>No.</th>
                            <th>NISN</th>
                            <th>Nama lengkap</th>
                            <th>Alamat</th>
                            <th>No Telp/Hp</th>
                            <th>Asal Sekolah</th>
                            <th>Jenis Kelamin</th>
                            <th>Foto Siswa</th>
                            <th>Ijazah</th>
                            <th>SKHUN</th>
                            <th>Status Pendaftaran</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <?php
                    $i = 1;
                    while ($data = mysqli_fetch_array($query)) {
                    ?>
                        <tbody>
                            <tr>
                                <td class="text-center"><?php echo $i++; ?></td>
                                <td><?php echo $data['nisn']; ?></td>
                                <td><?php echo $data['nama_lengkap']; ?></td>
                                <td><?php echo $data['alamat']; ?></td>
                                <td><?php echo $data['no_telp_siswa']; ?></td>
                                <td><?php echo $data['asal_sekolah']; ?></td>
                                <td><?php echo $data['jenis_kelamin'] == 'L' ? 'Laki-Laki' : 'Perempuan'; ?></td>
                                <td><a href="./images/<?php echo $data['foto']; ?>" target="_blank"><img src="./images/<?php echo $data['foto']; ?>" alt="foto siswa" width="50" /></a></td>
                                <td><a href="./pdf_siswa/<?php echo $data['foto_ijazah']; ?>" class="btn btn-primary btn-sm" target="_blank">Lihat</a></td>
                                <td><a href="./pdf_siswa/<?php echo $data['foto_skhun']; ?>" class="btn btn-primary btn-sm" target="_blank">Lihat</a></td>
                                <td><span class="badge badge-primary"><?php echo $data['status_pendaftaran']; ?></span></td>
                                <td class="text-center">
                                    <a href="./app/admin-cetak-detail-pendaftar.php?&id=<?php echo $data['id']; ?>" class="btn btn-primary btn-sm mb-2" target="_blank">Detail</a>
                                    <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#exampleModalCenter-<?php echo $data['id'] ?>">
                                        Ubah
                                    </button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModalCenter-<?php echo $data['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenter-<?php echo $data['id'] ?>Title" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLongTitle">Ubah Status Pendaftaran id <?= $data['id'] ?></h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="" method="POST">
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <div class="col-12">
                                                                <input type="hidden" name="id" value="<?= $data['id'] ?>">
                                                                <label for="">Status Pendaftaran</label>
                                                                <select name="status_pendaftaran" class="form-control">
                                                                    <option value="menunggu-verifikasi-berkas" <?php echo $data['status_pendaftaran'] == 'menunggu-verifikasi-berkas' ? 'selected' : ''; ?> >menunggu verifikasi berkas</option>
                                                                    <option value="menunggu-kelulusan" <?php echo $data['status_pendaftaran'] == 'menunggu-kelulusan' ? 'selected' : '' ?>>Menunggu Kelulusan</option>
                                                                    <option value="diterima" <?php echo $data['status_pendaftaran'] == 'diterima' ? 'selected' : '' ?>>Diterima</option>
                                                                    <option value="tidak-diterima" <?php echo $data['status_pendaftaran'] == 'tidak-diterima' ? 'selected' : '' ?>>Ditolak</option>
                                                                    <option value="cadangan" <?php echo $data['status_pendaftaran'] == 'cadangan' ? 'selected' : '' ?>>Cadangan</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" name="ubah-status" class="btn btn-primary">Simpan Perubahan</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    <?php
                    }
                    ?>
                </table>
            </div>
            <div class="table-lower">
                <div class="table-lower-left mg-top-5">
                    Jumlah Data: <span class="font-weight-bold"><?php echo $row; ?></span>
                </div>
                <div class="table-lower-right text-right">
                    <?php if (!isset($_POST['cari'])) { // disable pagination untuk pencarian 
                    ?>
                        <ul class="table-pagination">
                        <?php
                        pagination($row, $num, 'admin-jurusan');
                    }
                        ?>
                        </ul>
                </div>
            </div>
        <?php } else { ?>
            <p class="text-center">Data tidak tersedia.</p>
        <?php } ?>
    </div>
</div>