<?php
include './config/konfig-umum.php';
include './config/koneksi-db.php';

if (!isset($_POST['register'])) {
    $query2 = mysqli_query($db_conn, "SELECT max(id) as id_user FROM user WHERE role = 'siswa'");
    $data = mysqli_fetch_array($query2);
    $id_user_number = $data['id_user'];

    $urutan = (int) substr($id_user_number, 3, 3);
    $urutan++;

    $id_user_number = 'USR' . sprintf('%03s', $urutan);
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Register</title>
        <link rel="stylesheet" type="text/css" href="assets/vendor/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="assets/css/style.css">
        <!-- Font styles -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">
    </head>

    <body>
        <div class="container py-5">
            <h1>Register Akun</h1>
            <hr class="border-menu">
            <div class="wrapper">
                <form action="" method="POST">
                    <input type="hidden" class="form-control" name="id_user" value="<?php echo $id_user_number; ?>">
                    <div class="form-group">
                        <label for="nama_lengkap">Nama Lengkap</label>
                        <input type="text" class="form-control" name="nama_lengkap" placeholder="Nama anda...">
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email" placeholder="Email">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" name="password" placeholder="Password">
                        </div>
                    </div>
                    <button type="submit" name="register" class="btn btn-primary w-100">Daftar</button>
                </form>
            </div>
        </div>
    </body>

    </html>

<?php
} else {
    date_default_timezone_set('Asia/Bangkok');
    $id_user = $_POST['id_user'];
    $nama_lengkap = $_POST['nama_lengkap'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password_hash = password_hash($password, PASSWORD_DEFAULT);
    $role = 'siswa';
    $created_at = date('Y-m-d H:i:s');

    $sql = "INSERT INTO user 
                VALUES ('{$id_user}', '{$nama_lengkap}', '{$email}', '{$password_hash}', '{$role}', '{$created_at}', NULL)";
    $query = mysqli_query($db_conn, $sql);
    if (!$query) {
        echo 'gagal' . $db_conn->error;
    }
    //mengalihkan halaman
    echo "<meta http-equiv='refresh' content='0; url=login.php'>";
}
?>