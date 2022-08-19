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
            <header>Nama Sekolah</header>
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
            <li><a href="index.php"><i class="bi bi-speedometer"></i>Dashboard</a></li>
            <li class="active"><a href="pengguna.php"><i class="bi bi-gear"></i>Pengguna</a></li>

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
    </div>
    <!-- end sidebar -->

    <!-- konten -->
    <section id="content" class="content">
        <div class="container">
            <div id="dashboard">
                <div class="content-header">
                    <h5>Pengguna</h5>
                </div>

                <div class="main-content">
                    <?php 
                         if(isset($_GET['success'])){
                            echo "<div class='alert alert-success alert-dismissible fade show mt-3 mb-3' role='alert'>Data berhasil 
                            <strong>".$_GET['success']."</strong><button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                          </div>";
                            ;
                         }
                        
                     ?>

                    <a href="tambah-pengguna.php"><button type="button" class="mybtn btn-success ms-4 mt-2 mb-2">+Tambah
                        </button></a>

                    <table class="tabel mx-auto">

                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Username</th>
                                <th>Level</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>

                            <?php 
                            $no = 1;
                            $where = " WHERE 1=1 ";

                            if(isset($_GET['key'])) {
                                $where .= "AND nama LIKE '%".addslashes($_GET['key'])."%' ";
                            }

                            $pengguna = mysqli_query($conn, "SELECT * FROM pengguna $where ORDER BY id ASC");
                            if(mysqli_num_rows($pengguna) > 0 ) {
                                while($p = mysqli_fetch_array($pengguna)) {

                            ?>

                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $p['nama'] ?></td>
                                <td><?= $p['username'] ?></td>
                                <td class=" text-center"><?= $p['level'] ?></td>

                                <td class="text-center mx-auto">
                                    <a href="edit-pengguna.php?idpengguna=<?= $p['id'] ?>"><button type="button"
                                            class="mybtn btn-warning"><i class="bi bi-pencil text-light"></i>
                                        </button></a>

                                    <a href="hapus.php?idpengguna=<?= $p['id'] ?>"
                                        onclick="return confirm('Hapus pengguna ini?')"><button type="button"
                                            class="mybtn btn-danger"><i class="bi bi-trash text-light"></i>
                                        </button></a>
                                </td>
                            </tr>
                            <?php }  } else { ?>
                            <tr>
                                <td colspan="5">Data tidak ada</td>
                            </tr>
                            <?php }  ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- footer -->
        <?php include 'footer.php'?>
        <!-- end footer -->
    </section>

    <!-- end content -->

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