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

    <!-- konten -->
    <section id="content" class="content">
        <div class="container">
            <div id="dashboard">
                <div class="content-header">
                    <h5>Tambah Pengguna</h5>
                </div>
                <div class="main-content pt-4">

                    <form action="" method="post" class="ms-3 me-3">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control" name="nama" aria-describedby="nama"
                                placeholder="Nama Lengkap" required>
                        </div>
                        <div class="mb-3">
                            <label for="user" class="form-label">Username</label>
                            <input type="text" class="form-control" name="user" placeholder="Username" required>
                        </div>
                        <div class="mb-3">
                            <label for="level" class="form-label">Level</label>
                            <select name="level" class="form-select">
                                <option value="Admin">Pilih</option>
                                <option value="Admin">Admin</option>
                                <option value="Super Admin">Super Admin</option>
                            </select>
                        </div>

                        <button type="submit" name="submit" class="btn btn-primary" value="simpan">Tambah</button>
                        <a href="pengguna.php"><button type="button" class="btn btn-danger">Kembali</button></a>
                        <br>

                        <?php
                            if(isset($_POST['submit'])) {
                                $nama  = addslashes(ucwords($_POST['nama']));
                                $user  = addslashes($_POST['user']);
                                $level = $_POST['level'];
                                $pass  = '12345';

                                $cek   = mysqli_query($conn, "SELECT username FROM pengguna WHERE username = '".$user."' ");
                                if(mysqli_num_rows($cek) > 0 ){
                                    
                                    echo '<div class="alert alert-warning mt-3 mb-3">Username sudah ada</div>';
                                }else{

                                    $tambah = mysqli_query($conn,  "INSERT INTO pengguna VALUE(    
                                        null,
                                        '".$nama."',
                                        '".$user."',
                                        '".md5($pass)."',
                                        '".$level."',
                                        null,
                                        null
                                    )");
                                    
                                    if($tambah){
                                        
                                        echo "<script>window.location='pengguna.php?success=ditambahkan'</script>";
                                    }
                                    else{
                                       
                                        echo '<div class="alert alert-danger mt-3 mb-3"Data >gagal disimpan</div>'.mysqli_error($conn);
                                    }
                                }
                            }
                        ?>
                </div>
                </form>
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

</html>