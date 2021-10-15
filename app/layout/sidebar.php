<aside class="p-0 bg-white text-secondary sidebar sidebar-md-open elevation-4" id="NavbarText">
    <ul class="sidebar-menu">
        <li class="profile">
            <div class="profile-img bg-info rounded-circle mx-auto" style="width: 80px;height: 80px; background-image: url('./assets/img/default-user.png'); background-repeat: no-repeat; background-size: cover; background-position: center;"></div>
            <p class="text-center" style="padding: 5px 10px;">Hai, <?php echo $_SESSION['sesi'];?>!</p>
            <p class="text-center"><?php echo $_SESSION['role'] == 'siswa' ? 'Calon' : '' ?> <?php echo strtoupper($_SESSION['role']); ?></p>
        </li>
        <hr class="border-menu">
        <li class="sidebar-items <?php echo ($_GET['p'] == 'beranda') ? 'bg-primary' : ''; ?>">
            <a href="index.php?p=beranda" class="sidebar-link <?php echo ($_GET['p'] == 'beranda') ? 'text-white' : ''; ?>">Homepage</a>
        </li>
        <?php 
            if($_SESSION['role'] == 'siswa'){
        ?>
            <li class="sidebar-items bg-graylight">Data Master</li>
            <li class="sidebar-items <?php echo ($_GET['p'] == 'siswa-pendaftaran' || $_GET['p'] == 'siswa-pendaftaran-tambah' || $_GET['p'] == 'siswa-pendaftaran-ubah') ? 'bg-primary' : ''; ?>">
                <a href="index.php?p=siswa-pendaftaran" class="sidebar-link <?php echo ($_GET['p'] == 'siswa-pendaftaran' || $_GET['p'] == 'siswa-pendaftaran-tambah' || $_GET['p'] == 'siswa-pendaftaran-ubah') ? 'text-white' : ''; ?>">Pendaftaran Siswa Baru</a>
            </li>
            <li class="sidebar-items  <?php echo ($_GET['p'] == 'siswa-status-pendaftaran' || $_GET['p'] == 'siswa-status-pendaftaran' || $_GET['p'] == 'siswa-status-pendaftaran') ? 'bg-primary' : ''; ?>">
                <a href="index.php?p=siswa-status-pendaftaran" class="sidebar-link <?php echo ($_GET['p'] == 'siswa-status-pendaftaran') ? 'text-white' : ''; ?>">Status Pendaftaran</a>
            </li>
        <?php } else { ?>
            <li class="sidebar-items bg-graylight">Data Master</li>
            <li class="sidebar-items <?php echo ($_GET['p'] == 'admin-jurusan') || $_GET['p'] == 'admin-jurusan-tambah' || $_GET['p'] == 'admin-jurusan-ubah'  ? 'bg-primary' : ''; ?>">
                <a href="index.php?p=admin-jurusan" class="sidebar-link <?php echo ($_GET['p'] == 'admin-jurusan') || $_GET['p'] == 'admin-jurusan-tambah' || $_GET['p'] == 'admin-jurusan-ubah'  ? 'text-white' : ''; ?>">Jurusan</a>
            </li>
            <li class="sidebar-items <?php echo ($_GET['p'] == 'admin-pendaftaran')  || $_GET['p'] == 'admin-pendaftaran-ubah'  ? 'bg-primary' : ''; ?>">
                <a href="index.php?p=admin-pendaftaran" class="sidebar-link <?php echo ($_GET['p'] == 'admin-pendaftaran') || $_GET['p'] == 'admin-jurusan-ubah'  ? 'text-white' : ''; ?>">Pendaftaran PSB</a>
            </li>
            <li class="sidebar-items <?php echo ($_GET['p'] == 'admin-users')  || $_GET['p'] == 'admin-users-ubah'  ? 'bg-primary' : ''; ?>">
                <a href="index.php?p=admin-users" class="sidebar-link <?php echo ($_GET['p'] == 'admin-users') || $_GET['p'] == 'admin-jurusan-ubah'  ? 'text-white' : ''; ?>">Akun</a>
            </li>
        <?php } ?>
        <hr class="border-menu">
        <li class="sidebar-items">
            <a href="logout.php" class="sidebar-link">Logout</a>
        </li>
    </ul>
</aside>