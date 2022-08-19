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
                    <h5>Ubah Password</h5>
                </div>
                <div class="main-content pt-4">

                    <form action="" method="post" class="ms-3 me-3">
                        <div class="mb-3">
                            <label for="pass" class="form-label">Password</label>
                            <input type="password" class="form-control" name="pass" aria-describedby="pass"
                                placeholder="Ubah Password" required>
                        </div>
                        <div class="mb-3">
                            <label for="pass2" class="form-label">Konfirmasi Password</label>
                            <input type="password" class="form-control" name="pass2" placeholder="Konfirmasi Password"
                                required>
                        </div>

                        <button type="submit" name="submit" class="btn btn-primary">Ubah</button>
                        <a href="index.php"><button type="button" class="btn btn-danger">Kembali</button></a>
                        <br>

                        <?php
                        
                        if(isset($_POST['submit'])) {
                            $pass   = addslashes($_POST['pass']);
                            $pass2  = addslashes($_POST['pass2']);

                            if($pass2 != $pass) {
                                
                                echo '<div class="alert alert-warning mt-3 mb-3">Ulangi password tidak sesuai</div>';
                            }else{
                                $ubahp  = mysqli_query($conn, "UPDATE pengguna SET 
                                password  = '".md5($pass)."'
                                                           
                                WHERE id = '".$_SESSION['uid']."'
                            
                            ");

                            if($ubahp) {
                                 
                                    echo '<div class="alert alert-success mt-3 mb-3">Password berhasil diubah</div>';
                                }
                                else{
                                   
                                    echo '<div class="alert alert-danger mt-3 mb-3">Password gagal diubah</div>'.mysqli_error($conn);
                                }
                                    

                            }
                                                        
                            
                        }                  
                    ?>

                    </form>


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