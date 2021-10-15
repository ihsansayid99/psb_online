<?php
	if(isset($_GET['id'])) { // memperoleh id
		$id_jurusan = $_GET['id'];

		if(!empty($id_jurusan)) {
			// Query
			$sql = "DELETE FROM jurusan WHERE id = '{$id_jurusan}';";
			$query = mysqli_query($db_conn, $sql);

			if(!$query) {
				echo "<script>alert('Data gagal dihapus!');</script>";
			}
		} else {
			echo "<script>alert('ID Jurusan kosong!');</script>";
		}
	} else {
		echo "<script>alert('ID Jurusan tidak didefinisikan!');</script>";		
	}

	// mengalihkan halaman
	echo "<meta http-equiv='refresh' content='0; url=index.php?p=admin-jurusan'>";
