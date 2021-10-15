<?php
	include '../config/koneksi-db.php';
	require("../assets/vendor/autoload.php");
	use Dompdf\Dompdf; 
	$dompdf = new Dompdf();
	if(isset($_GET['id'])) { // memperoleh anggota_id
		$id_pendaftar = $_GET['id'];

		if(!empty($id_pendaftar)) {
			// Query
			$sql = "SELECT * FROM pendaftaran WHERE id = '{$id_pendaftar}';";
			$query = mysqli_query($db_conn, $sql);
			$row = $query->num_rows;
			ob_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Detail Pendaftar</title>
	<style>
		* { margin: 0; font-family: Arial, Helvetica, sans-serif; }
		h3 { text-align: center; margin: 15px; text-decoration: underline; }
		#member-card { margin: 0 auto; width: 450px; }
		#member-photo { float: left; width: 120px; margin-right: 10px; }
		#member-data { float: left; width: 320px; }
		#member-data p { line-height: 24px; }
        hr{
            margin: 1rem 0;
        }
	</style>
</head>
<body>
		<?php
			if($row > 0) {
				$data = mysqli_fetch_array($query); // memperoleh data anggota
				$id_pendaftar = $data['id'];
				$nama_lengkap = $data['nama_lengkap'];
				$jenis_kelamin = $data['jenis_kelamin'];
				$alamat = $data['alamat'];
                $nisn = $data['nisn'];
                $asal_sekolah = $data['asal_sekolah'];
                $nilai_ebtanas_murni = $data['nilai_ebtanas_murni'];
                $minat_id_jurusan_1 = $data['minat_id_jurusan_1'];
                $minat_id_jurusan_2 = $data['minat_id_jurusan_2'];
                $nama_orangtua = $data['nama_orangtua'];
                $alamat_orangtua = $data['alamat_orangtua'];
                $no_telp_orangtua = $data['no_telp_orangtua'];
                $pekerjaan_orangtua = $data['pekerjaan_orangtua'];
                $gaji_orangtua = $data['gaji_orangtua'];
                $status_pendaftaran = $data['status_pendaftaran'];
                $query2 = mysqli_query($db_conn, "SELECT nama_jurusan FROM jurusan WHERE id = '$minat_id_jurusan_1'");
                $query3 = mysqli_query($db_conn, "SELECT nama_jurusan FROM jurusan WHERE id = '$minat_id_jurusan_2'");
                $jurusan1 = mysqli_fetch_array($query2);
                $jurusan2 = mysqli_fetch_array($query3);
				$data_foto = $data['foto'];
				if($data_foto == '-') {
					$data_foto = 'foto-default.jpg';
				}
				$path = "../images/" . $data_foto;
				$type = pathinfo($path, PATHINFO_EXTENSION);
				$data = file_get_contents($path);
				$base64 = 'data:image/' . $type . ';base64,'. base64_encode($data);
		?>
	<section id="member-card">
		<h3>Detail Pendaftar</h3>

		<div id="member-photo">
			<img src="<?php echo $base64 ?>" width="120">
		</div>
		<div id="member-data">
			<p><strong>ID Pendaftaran</strong>: <?php echo $id_pendaftar; ?></p>
            <p><strong>NISN</strong>: <?php echo $nisn; ?></p>
			<p><strong>Nama Lengkap</strong>: <?php echo $nama_lengkap; ?></p>
			<p><strong>Jenis Kelamin</strong>: <?php echo ($jenis_kelamin == 'L') ? 'Pria' : 'Wanita'; ?></p>
			<p><strong>Alamat</strong>: <?php echo $alamat; ?></p>
            <hr>
            <p><strong>NEM</strong>: <?php echo $nilai_ebtanas_murni; ?></p>
            <p><strong>Asal Sekolah</strong>: <?php echo $asal_sekolah; ?></p>
            <p><strong>Minat Jurusan 1</strong>: <?php echo $jurusan1['nama_jurusan']; ?></p>
            <p><strong>Minat Jurusan 2</strong>: <?php echo $jurusan2['nama_jurusan']; ?></p>
            <hr>
            <p><strong>Nama Orangtua / Wali</strong>: <?php echo $nama_orangtua; ?></p>
            <p><strong>Alamat Orangtua / Wali</strong>: <?php echo $alamat_orangtua; ?></p>
            <p><strong>Pekerjaan Orangtua / Wali</strong>: <?php echo $pekerjaan_orangtua; ?></p>
            <p><strong>Gaji Orangtua / Wali</strong>: <?php echo $gaji_orangtua; ?></p>
            
        </div>
	</section>
		<?php
			}
		?>
</body>
</html>

<?php
			$html = ob_get_clean();
			$f;
			$l;
			if(headers_sent($f,$l))
			{
				echo $f,'<br/>',$l,'<br/>';
				die('now detect line');
			}
			$dompdf->loadHtml($html); 
			$dompdf->setPaper('A5', 'landscape'); 
			$dompdf->render(); 
			ob_end_clean();
			$dompdf->stream("Pendaftaran-PSB-".$id_pendaftar, array("Attachment"=>false));
			exit();
		}
	}
?>