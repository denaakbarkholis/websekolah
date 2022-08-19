<?php
include '../koneksi.php';
session_start();

if(!isset($_SESSION['status_login'])) {

	header("location: ../login.php?msg=Harap login terlebih dahulu");
	exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- bootstrap css -->
    <link rel="stylesheet" href="../assets/bootstrap-5.0.2-dist/css/bootstrap.css">
    <link rel="stylesheet" href="../assets/bootstrap-5.0.2-dist/css/bootstrap.min.css">

    <!-- bootsrap icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

    <!-- my css -->
    <link rel="stylesheet" href="admin.css">

    <link rel="icon" href="../uploads/identitas/<?= $d->favicon ?>">
    <title>Panel Admin | <?= $d->nama?></title>

</head>

<body>

    <!-- sidebar -->
    <i class="bi bi-list" id="btn-menu"></i>

    <div class="sidebar">

        <a href="../index.php" class="text-decoration-none ">
            <header> <?= $d->nama?></header>
        </a>

        <!-- icon -->

        <div class="search">
            <form>
                <input name="key" id="search" type="search" placeholder="Search" aria-label="Search">
                <button><i class="bi bi-search btn-search"></i></button>
            </form>
        </div>

        <!-- nav -->
        <ul class="list-unstyled ">
            <li class="active"><a href="index.php"><i class="bi bi-speedometer"></i>Dashboard</a></li>
            <?php if($_SESSION['ulevel'] == 'Super Admin') { ?>
            <li><a href="pengguna.php"><i class="bi bi-gear"></i>Pengguna</a></li>

            <?php } elseif($_SESSION['ulevel'] == 'Admin') { ?>

            <li><a href="jurusan.php"><i class="bi bi-bookmark"></i>Jurusan</a></li>
            <li><a href="galeri.php"><i class="bi bi-boxes"></i>Galeri</a></li>
            <li><a href="informasi.php"><i class="bi bi-question-circle"></i>Informasi</a></li>

            <li class="mydrop">
                <a href="#"><i class="bi bi-gear"></i>Pengaturan<i class="bi bi-caret-down-fill ms-5 drop-icon"></i></a>

                <ul class="my-drop">
                    <li class="drop-item"><a href="identitas-sekolah.php">Identitas
                            Sekolah</a></li>
                    <li class="drop-item"><a href="tentang-sekolah.php">Tentang
                            Sekolah</a></li>
                    <li class="drop-item"><a href="kepala-sekolah.php">Kepala
                            Sekolah</a></li>
                </ul>
            </li>

            <?php } ?>

            <li class="mydrop">
                <a href="#"><i class="bi bi-person-circle"></i><?= $_SESSION['uname'];?>
                    <i class="bi bi-caret-down-fill ms-5 drop-icon"></i>
                </a>

                <ul class="my-drop">
                    <li class="drop-item"><a href="../logout.php"><i class="bi bi-box-arrow-left"></i>Keluar</a></li>
                    <li class="drop-item"><a href="ubah-password.php"><i class="bi bi-key"></i>Ubah Password</a>
                    </li>
                </ul>
            </li>
        </ul>
        <!-- end nav -->
    </div>
    <!-- end sidebar -->

    <!-- konten -->
    <section id="content" class="content">
        <div class="container">
            <div>
                <div class="content-header">
                    <h5>Dashboard</h5>
                </div>
                <div class="main-content">
                    <h3> Selamat Datang <?= $_SESSION['uname']; ?>, di panel admin <?= $d->nama?></h3>
                    <hr>

                    <div class="row ms-5 text-white">
                        <div class="card bg-info" style="width: 18rem;">
                            <div class="card-body">
                                <div class="card-body-icon"><i class="bi bi-mortarboard-fill"></i></div>
                                <h5 class="card-title">JUMLAH SISWA</h5>
                                <div class="display-4 fw-bold">1.200</div>
                                <a href="">
                                    <p class="card-text text-white">Lihat Detail</p>
                                </a>

                            </div>
                        </div>
                        <div class="card bg-success  ms-5" style="width: 18rem;">
                            <div class="card-body">
                                <div class="card-body-icon"><i class="bi bi-person-video3"></i></div>
                                <h5 class="card-title">JUMLAH GURU</h5>
                                <div class="display-4 fw-bold">58</div>
                                <a href="">
                                    <p class="card-text text-white">Lihat Detail</p>
                                </a>

                            </div>
                        </div>
                        <div class="card bg-danger  ms-5" style="width: 18rem;">
                            <div class="card-body">
                                <div class="card-body-icon"><i class="bi bi-people-fill"></i></div>
                                <h5 class="card-title">JUMLAH PEGAWAI</h5>
                                <div class="display-4 fw-bold">34</div>
                                <a href="">
                                    <p class="card-text text-white">Lihat Detail</p>
                                </a>

                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>

        <!-- footer -->
        <?php include 'footer.php'?>
        <!-- end footer -->
    </section>
    <!-- end konten -->

    <!-- bootstrap script -->
    <script src="../assets/bootstrap-5.0.2-dist/js/bootstrap.bundle.js"></script>
    <!-- jquery -->
    <script src="../assets/jquery-3.6.0.min.js"></script>
    <!-- script admin -->
    <script src="admin.js"></script>
    <!-- tiny docs -->
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

</body>

</html>