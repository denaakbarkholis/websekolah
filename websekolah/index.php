<?php
include 'koneksi.php';
session_start();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- bootstrap css -->
    <link rel="stylesheet" href="assets/bootstrap-5.0.2-dist/css/bootstrap.css">
    <link rel="stylesheet" href="assets/bootstrap-5.0.2-dist/css/bootstrap.min.css">

    <!-- bootsrap icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

    <!-- my css -->
    <link rel="stylesheet" href="assets/style.css">

    <link rel="icon" href="uploads/identitas/<?= $d->favicon ?>">
    <title>Beranda <?= $d->nama?></title>

</head>

<body>

    <?php
    include 'media.php'
    ?>

    <!-- Navbar -->
    <nav id="nav" class="navbar navbar-expand-lg navbar-light navbar-color">
        <div class="container">
            <a class="navbar-brand me-5" href="#">
                <img src="uploads/identitas/<?= $d->logo ?>" width="50px" alt="">
                <?= $d->nama?></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse ms-3" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link " href="#beranda">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Informasi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Galeri</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Jurusan</a>
                    </li>
                    <li class="nav-item">
                        <div class="dropdown">
                            <button class="btn nav-link dropdown-toggle mydrop" type="button" id="dropdown"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Blog
                            </button>
                            <ul class="dropdown-menu " aria-labelledby="dropdown">
                                <li><a class="dropdown-item" href="#">Blog Siswa</a>
                                </li>
                                <li><a class="dropdown-item" href="#">Blog Guru</a></li>

                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <div class="dropdown">
                            <button class="btn nav-link dropdown-toggle mydrop" type="button" id="dropdown"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Profil Sekolah
                            </button>
                            <ul class="dropdown-menu " aria-labelledby="dropdown">
                                <li><a class="dropdown-item" href="identitas-sekolah.php">Identitas Sekolah</a>
                                </li>
                                <li><a class="dropdown-item" href="tentang-sekolah.php">Tentang Sekolah</a></li>
                                <li><a class="dropdown-item" href="kepala-sekolah.php">Kepala Sekolah</a></li>
                            </ul>
                        </div>
                    </li>

                    <li class="nav-item">
                        <?php if(isset($_SESSION['status_login'])) { ?>
                        <div class="dropdown">
                            <button class="btn nav-link dropdown-toggle mydrop" type="button" id="dropdown"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <?= $_SESSION['uname']?>
                            </button>
                            <ul class="dropdown-menu " aria-labelledby="dropdown">
                                <li><a class="dropdown-item" href="logout.php">Keluar</a>
                                </li>
                                <li><a class="dropdown-item" href="admin/index.php">Panel Admin</a></li>
                            </ul>
                        </div>

                        <?php } else{?>

                        <a class="nav-link border-box" href="login.php">Masuk</a>

                        <?php }?>

                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- end navbar -->

    <!-- banner -->
    <section id="banner">
        <div class="banner" style="background-image: url('uploads/identitas/foto_sekolah1660659111.jpg')">
            <div class="container-fluid">
                <div class="banner-text">
                    <h3>Selamat Datang di <?= $d->nama ?></h3>
                    <p>Sekolah unggulan masa depan untuk bangsa yang adil dan
                        beradab dan ini dan itu dan ini itu dan in juga itu Lorem ipsum, dolor sit amet
                        consectetur
                        adipisicing elit. Repudiandae ab molestiae dicta officiis ad suscipit incidunt. Rem,
                        modi
                        assumenda quos nostrum maxime blanditiis, in nulla nesciunt vero eum sit aliquid.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- content -->
    <section id="informasi">
        <div class="container">
            <div class="row">
                <h2>INFORMASI</h2>
                <?php  
                $informasi = mysqli_query($conn, "SELECT * FROM informasi ORDER BY id DESC");
                if(mysqli_num_rows($informasi) > 0 ) {
                    while($p = mysqli_fetch_array($informasi)) {

                ?>
                <div class="col-4 view mx-auto">
                    <a href="#" class="thumbnail-link">
                        <div class="thumbnail-box"></div>
                        <div class="thumbnail-img"
                            style="background-image: url('uploads/informasi/<?= $p['gambar'] ?>')">
                        </div>
                        <div class="thumbnail-text"><?= $p['judul'] ?></div>
                    </a>
                </div>

                <?php }} else { ?>
                Tidak ada data
                <?php } ?>

            </div>
        </div>
    </section>


    <section id="jurusan">
        <div class="container">
            <div class="row">
                <h2>JURUSAN</h2>
                <?php  
                $jurusan = mysqli_query($conn, "SELECT * FROM jurusan ORDER BY id DESC");
                if(mysqli_num_rows($jurusan) > 0 ) {
                    while($j = mysqli_fetch_array($jurusan)) {

                ?>
                <div class="col-4 view mx-auto">
                    <a href="#">
                        <div class="thumbnail-box"></div>
                        <div class="thumbnail-img" style="background-image: url('uploads/jurusan/<?= $j['gambar'] ?>')">
                        </div>
                        <div class="thumbnail-text"><?= $j['nama'] ?></div>
                    </a>
                </div>

                <?php }} else { ?>
                Tidak ada data
                <?php } ?>
            </div>
        </div>
    </section>


    <section id="galeri">
        <div class="container">
            <div class="row">
                <h2>GALERI</h2>
                <?php  
                $galeri = mysqli_query($conn, "SELECT * FROM galeri ORDER BY id DESC");
                if(mysqli_num_rows($galeri) > 0 ) {
                    while($p = mysqli_fetch_array($galeri)) {

                ?>
                <div class="col-4 view mx-auto">
                    <a href="#">
                        <div class="thumbnail-box"></div>
                        <div class="thumbnail-img" style="background-image: url('uploads/galeri/<?= $p['foto'] ?>')">
                        </div>
                        <div class="thumbnail-text"><?= $p['keterangan'] ?></div>
                    </a>
                </div>

                <?php }} else { ?>
                Tidak ada data
                <?php } ?>
            </div>
        </div>
    </section>

    <!-- contact -->
    <section id="contact">
        <div class="container">
            <h2>Contact Us
            </h2>
            <hr>

            <div class="row">
                <form class="col-5 text-warning">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" id="name" aria-describedby="name" name="nama"
                            required />
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="email" name="email" aria-describedby="email">

                    </div>
                    <div class="mb-3">
                        <label for="pesan" class="form-label">Pesan</label>
                        <textarea class="form-control" id="pesan" rows="3" name="pesan" required></textarea>
                    </div>

                    <button type="submit" class="btn btn-kirim">Kirim</button>
                </form>

                <div class="col-4 about">
                    <ul class="list-unstyled text-warning">
                        <li><?= $d->nama ?><i class="bi bi-house ms-2"></i></li>
                        <li><?= $d->telepon ?><i class="bi bi-telephone ms-2"></i></li>
                        <li><?= $d->email ?><i class="bi bi-envelope ms-2"></i></li>
                        <li><?= $d->alamat ?><i class="bi bi-geo ms-2"></i></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <?php 
    include 'media.php'
    ?>

    <!-- footer -->
    <footer class="text-center text-light">
        Copyright <i class="bi bi-c-circle"></i> 2022, Created with <i class="bi bi-heart-fill text-danger"></i> to
        Indonesia by Dena AK
    </footer>
    <!-- end footer -->

    <!-- bootstrap script -->
    <script src="assets/bootstrap-5.0.2-dist/js/bootstrap.bundle.js">
    </script>

    <!-- jquery -->
    <script src="assets/jquery-3.6.0.min.js"></script>

    <!-- my script -->
    <script src="assets/script.js"></script>

</body>

</html>