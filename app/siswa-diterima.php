<?php
include '../config/koneksi-db.php';
require("../assets/vendor/autoload.php");

use Dompdf\Dompdf;

$dompdf = new Dompdf();
if (isset($_GET['id'])) { // memperoleh
    $id_pendaftar = $_GET['id'];

    if (!empty($id_pendaftar)) {
        // Query
        $sql = "SELECT * FROM pendaftaran WHERE id = '{$id_pendaftar}' AND status_pendaftaran = 'diterima';";
        $query = mysqli_query($db_conn, $sql);
        $row = $query->num_rows;
        ob_start();
?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>SURAT KETERANGAN LULUS</title>
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

                hr {
                    margin: 1rem 0;
                }

                body {
                    padding: 1rem 10rem;
                }

                .detail-info {
                    padding: 2 3rem;
                }

                .detail-info p {
                    line-height: 30px;
                }
            </style>
        </head>

        <body>
            <?php
            if ($row > 0) {
                $data = mysqli_fetch_array($query); // memperoleh data anggota
                $id_pendaftar = $data['id'];
                $nama_lengkap = $data['nama_lengkap'];
                $nisn = $data['nisn'];
                $data_foto = $data['foto'];
                if ($data_foto == '-') {
                    $data_foto = 'foto-default.jpg';
                }
                $path = "../images/" . $data_foto;
                $type = pathinfo($path, PATHINFO_EXTENSION);
                $data = file_get_contents($path);
                $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
            ?>
                <section id="member-card">
                    <h3>KOP SEKOLAH</h3>
                    <h3>SURAT KETERANGAN LULUS SMK NEGERI 1 JAKARTA</h3>
                    <p>Yang bertanda tangan dibawah ini Kepala Sekolah Menengah Kejuruan Negeri 1 Jakarta
                        Menerangkan bahwa:
                    </p>
                    <div class="detail-info">
                        <p>Nama : <span><?php echo $nama_lengkap; ?></span></p>
                        <p>ID Peserta : <span><?php echo $id_pendaftar; ?></span></p>
                        <p>Nomor induk Siswa Nasioal : <span><?php echo $nisn ?></span></p>
                    </div>
                    <p>
                        Berdasar kriteria kelulusan peserta didik yang sudah ditetapkan, maka yang bersangkutan
                        dinyatakan :
                    </p>
                    <h3>LULUS</h3>
                    <p>
                        Surat Keterangan ini bersifat sementara sampai dikeluarkannya Ijazah.
                        Demikian Surat Keterangan ini diberikan agar dapat digunakan sebagaimana mestinya, apabila
                        dikemudian hari terdapat kekeliruan, maka akan dilakukan perbaikan atau surat keterangan ini tidak berlaku.
                    </p>
                    <div id="member-photo" style="text-align: center; padding-top: 5rem;">
                        <img src="<?php echo $base64 ?>" width="120">
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
        if (headers_sent($f, $l)) {
            echo $f, '<br/>', $l, '<br/>';
            die('now detect line');
        }
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        ob_end_clean();
        $dompdf->stream("Keterangan-Diterima-" . $id_pendaftar, array("Attachment" => false));
        exit();
    }
}
?>