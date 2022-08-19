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

    <!-- my css -->
    <link rel="stylesheet" href="assets/style.css">

    <link rel="icon" href="uploads/identitas/<?= $d->favicon ?>">
    <title>Halaman Login</title>

</head>

<body>
    <!-- page login -->
    <div class="page-login">

        <!-- box -->
        <div class="box col-lg-4 col-md-5">

            <div class="box-header text-center">
                Halaman Login
            </div>

            <div class="box-body">

                <?php 
                if (isset($_GET['msg'])) {
                    echo "<div class='my-alert alert-danger mb-2 text-center'>".$_GET['msg']."</div>";
                }
                
                ?>

                <form action="" method="post">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" placeholder="username" class="inputC"
                            placeholder="Username" required>
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" placeholder="password" class="inputC"
                            placeholder="Password" required>
                    </div>
                    <button type="submit" name="submit" class="btn btn-login">Login</button>
                </form>

                <!-- otorisasi -->
                <?php   
                    if (isset($_POST['submit'])) {
                        $user = mysqli_real_escape_string($conn, $_POST['username']);
                        $pass = $_POST['password'];

                    $cek = mysqli_query($conn, "SELECT * FROM pengguna WHERE username = '".$user."' ");
                    if (mysqli_num_rows($cek) > 0) {

                        $d = mysqli_fetch_object($cek);
                        if(md5($pass) == $d-> password) {

                            $_SESSION['status_login'] = true;
                            $_SESSION['uid']          = $d -> id;
                            $_SESSION['uname']        = $d -> nama;
                            $_SESSION['ulevel']       = $d -> level;

                            header("location: admin/index.php");

                        } else {
                            echo '<br>';
                            echo '<div class="my-alert alert-danger">Password anda salah</div>';
                        }
                    }  else {
                        echo '<br>';
                        echo '<div class="my-alert alert-danger">Username tidak ditemukan</div>';
                    }
                }    
                
                ?>
            </div>

            <div class="box-footer text-center">
                <a href="index.php">Beranda</a>
            </div>

        </div>

    </div>

</body>

</html>