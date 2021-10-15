<?php

	$row = 0;
	$num = 0;
	$offset = 0;
	if(!isset($_POST['cari'])) { // Jika tidak melakukan pencarian anggota
		/*** Pagination ***/
		if(isset($_GET['num'])) { // Jika menggunakan pagination
			$num = (int)$_GET['num'];

			if($num > 0) {
				$offset = ($num * $_QUERY_LIMIT) - $_QUERY_LIMIT;
			}
		}

		/* Query Main */
		$sql = "SELECT * FROM jurusan ORDER BY id DESC LIMIT {$offset}, {$_QUERY_LIMIT};";
		$query = mysqli_query($db_conn, $sql);

		/* Query Count All */
		$sql_count = "SELECT id FROM jurusan;";
		$query_count = mysqli_query($db_conn, $sql_count);
		$row = $query_count->num_rows;
	} else { // Jika melakukan pencarian anggota
		/*** Pencarian ***/
		$kata_kunci = $_POST['kata_kunci'];

		if(!empty($kata_kunci)) {
			/* Query Pencarian */
			$sql = "SELECT * FROM jurusan 
					WHERE id LIKE '%{$kata_kunci}%'
						OR nama_jurusan LIKE '%{$kata_kunci}%'
						OR status LIKE '%{$kata_kunci}%'
					ORDER BY id DESC;";
			$query = mysqli_query($db_conn, $sql);
			$row = $query->num_rows;
		}
	}
?>

		<div id="container">
			<div class="page-title">
				<h3>Data Jurusan</h3>	
			</div>
			<div class="page-content">
				<div class="table-upper">
					<div class="table-upper-left">
						<a href="index.php?p=admin-jurusan-tambah" class="btn btn-success btn-medium">Tambah</a>
					</div>
					<div class="table-upper-right">
						<form name="pencarian" action="" method="post" class="mg-top-15 text-right">
							<input type="text" name="kata_kunci" class="input_search">
							<input type="submit" name="cari" value="Cari" class="btn btn-success">
						</form>
					</div>
				</div>

			<?php 
				if($row > 0) {
			?>
				<div class="table-responsive">
					<table class="table data-table">
						<thead class="thead-dark">
							<tr>
								<th>No.</th>
								<th>ID Jurusan</th>
								<th>Nama Jurusan</th>
								<th>Status</th>
								<th>Aksi</th>
							</tr>
						</thead>
					<?php
						$i = 1;
						while($data = mysqli_fetch_array($query)) {
					?>
						<tbody>
							<tr>
								<td class="text-center"><?php echo $i++; ?></td>
								<td><?php echo $data['id']; ?></td>
								<td><?php echo $data['nama_jurusan']; ?></td>
                                <td><span class="badge badge-<?php echo $data['status'] == 'aktif' ? 'success' : 'danger'; ?>"><?php echo $data['status']; ?></span></td>
								<td class="text-center">
									<a href="index.php?p=admin-jurusan-ubah&id=<?php echo $data['id']; ?>" class="btn btn-warning btn-sm">Ubah</a>
									<a href="index.php?p=admin-jurusan-hapus&id=<?php echo $data['id']; ?>" class="btn btn-danger btn-sm confirm">Hapus</a>
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
					<?php if(!isset($_POST['cari'])) { // disable pagination untuk pencarian ?>
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