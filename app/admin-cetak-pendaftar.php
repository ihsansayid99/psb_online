<?php
include '../config/koneksi-db.php';
require("../assets/vendor/autoload.php");

use Dompdf\Dompdf;

$dompdf = new Dompdf();
$sql = "SELECT * FROM pendaftaran ORDER BY id DESC;";
$query = mysqli_query($db_conn, $sql);
$row = $query->num_rows;
ob_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Kartu Anggota</title>
    <style>
        * {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
        }

        h3 {
            text-align: center;
            margin: 15px;
            text-decoration: underline;
        }

        section {
            margin: 0 auto;
            width: 960px;
        }

        table {
            border-collapse: collapse;
        }

        table,
        table th,
        table td {
            padding: 5px;
            border: 1px solid #CCC;
        }

        .text-center {
            text-align: center;
        }
    </style>
</head>

<body>
    <section id="member-card">
        <?php
        if ($row > 0) {
        ?>
            <h3>Daftar Pendaftaran Siswa Baru</h3>
            <div class="table-responsive">
                <table>
                    <tr>
                        <th>No.</th>
                        <th>NISN</th>
                        <th>Nama lengkap</th>
                        <th>Alamat</th>
                        <th>No Telp/Hp</th>
                        <th>Asal Sekolah</th>
                        <th>Jenis Kelamin</th>
                        <th>Status Pendaftaran</th>
                    </tr>
                    <?php
                    $i = 1;
                    while ($data = mysqli_fetch_array($query)) {
                    ?>
                        <tr>
                            <td><?= $i++ ?></td>
                            <td><?= $data['nisn'] ?></td>
                            <td><?= $data['nama_lengkap'] ?></td>
                            <td><?= $data['alamat'] ?></td>
                            <td><?= $data['no_telp_siswa'] ?></td>
                            <td><?= $data['asal_sekolah'] ?></td>
                            <td><?= $data['jenis_kelamin'] == 'L' ? 'Laki - Laki' : 'Perempuan' ?></td>
                            <td><?= $data['status_pendaftaran']; ?></td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
    </section>
</body>

</html>

<?php
        }
        $html = ob_get_clean();
        $f;
        $l;
        if (headers_sent($f, $l)) {
            echo $f, '<br/>', $l, '<br/>';
            die('now detect line');
        }
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        ob_end_clean();
        $dompdf->stream("Siswa-Pendaftar-All", array("Attachment" => false));
        exit();
?>