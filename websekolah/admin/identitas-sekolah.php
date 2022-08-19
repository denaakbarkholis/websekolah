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
                    <h5>Identitas Sekolah</h5>
                </div>
                <div class="main-content pt-4">
                    <?php 
                         if(isset($_GET['success'])){
                            echo "<div class='alert alert-success alert-dismissible fade show mt-3 mb-3' role='alert'>
                            <strong>".$_GET['success']."</strong> diubah<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                          </div>";
                            ;
                         }
                        
                     ?>

                    <form action="" method="post" class="ms-3 me-3" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label class="form-label">Nama</label>
                            <input type="text" class="form-control" name="nama" placeholder="Nama Sekolah"
                                value="<?= $d->nama ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" placeholder="Email Sekolah"
                                value="<?= $d->email ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Telepon</label>
                            <input type="text" class="form-control" name="telp" placeholder="Telepon Sekolah"
                                value="<?= $d->telepon ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Alamat</label>
                            <input type="text" class="form-control" name="alamat" placeholder="Nama Sekolah"
                                value="<?= $d->alamat?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Google Maps</label>
                            <textarea name="gmaps" class="form-control" placeholder="Google Maps" cols="30"
                                rows="5"><?=  $d->google_maps?></textarea>
                        </div>
                        <div class=" mb-3">
                            <label class="form-label">Logo</label>
                            <br>
                            <img src="../uploads/identitas/<?= $d->logo ?>" alt="" width="200px" class="image">
                            <br>
                            <input type="hidden" name="logo_lama" value="<?= $d->logo ?>">
                            <input type="file" name="logo_baru" class="input-control">
                        </div>
                        <div class=" mb-3">
                            <label class="form-label">Favicon</label>
                            <br>
                            <img src="../uploads/identitas/<?= $d->favicon ?>" alt="" width="100px" class="image">
                            <br>
                            <input type="hidden" name="favicon_lama" value="<?= $d->logo ?>">
                            <input type="file" name="favicon_baru" class="input-control">
                        </div>

                        <button type="submit" name="submit" class="btn btn-primary">Ubah</button>
                        <a href="index.php"><button type="button" class="btn btn-danger">Kembali</button></a>
                        <br>
                        <br>

                        <?php
                        
                        if(isset($_POST['submit'])) {

                            $nama    = addslashes(ucwords($_POST['nama']));
                            $email   = addslashes($_POST['email']);
                            $telp    = addslashes($_POST['telp']);
                            $alamat  = addslashes($_POST['alamat']);
                            $gmaps   = addslashes($_POST['gmaps']);
                          
                            // menampung logo
                            if($_FILES['logo_baru']['name'] != '') {
                            
                                $filename = $_FILES['logo_baru']['name'];
                                $tmpname  = $_FILES['logo_baru']['tmp_name'];
                                $filesize = $_FILES['logo_baru']['size'];

                                $formatfile   = pathinfo($filename, PATHINFO_EXTENSION);
                                $rename_logo  = 'logo'.time().'.'.$formatfile;

                                $typefile_logo = array('png', 'jpg', 'jpeg', 'gif');

                                if(!in_array($formatfile, $typefile_logo)){
                                    
                                    echo '<div class="alert alert-warning mt-3 mb-3">Format file tidak diijinkan</div>';
                                    return false;

                                }elseif($filesize > 1000000){
                                        
                                        echo '<div class="alert alert-warning mt-3 mb-3">Ukuran file maksimal 1Mb. </div>';
                                        return false;
                                }else{
                                    
                                        if(file_exists("../uploads/identitas/".$_POST['logo_lama'])){
                                        unlink("../uploads/identitas/".$_POST['logo_lama']);
                                    }
                                move_uploaded_file($tmpname, "../uploads/identitas/".$rename_logo);
                                }
                                
                            }else {
                              
                                $rename_logo = $_POST['logo_lama'];                              
                            }
                             // menampung favivon
                             if($_FILES['favicon_baru']['name'] != '') {
                            
                                $filename = $_FILES['favicon_baru']['name'];
                                $tmpname  = $_FILES['favicon_baru']['tmp_name'];
                                $filesize = $_FILES['favicon_baru']['size'];

                                $formatfile   = pathinfo($filename, PATHINFO_EXTENSION);
                                $rename_favicon = 'favicon'.time().'.'.$formatfile;

                                $typefile_favicon = array('png', 'jpg', 'jpeg', 'gif');

                                if(!in_array($formatfile, $typefile_favicon)){
                                    
                                    echo '<div class="alert alert-warning mt-3 mb-3">Format file tidak diijinkan</div>';
                                    return false;

                                }elseif($filesize > 1000000){
                                        
                                        echo '<div class="alert alert-warning mt-3 mb-3">Ukuran file maksimal 1Mb. </div>';
                                        return false;
                                }else{
                                    
                                        if(file_exists("../uploads/identitas/".$_POST['favicon_lama'])){
                                        unlink("../uploads/identitas/".$_POST['favicon_lama']);
                                    }
                                move_uploaded_file($tmpname, "../uploads/identitas/".$rename_favicon);
                                }
                                
                            }else {
                              
                                $rename_favicon = $_POST['favicon_lama'];                              
                            }

                                    $update  = mysqli_query($conn, "UPDATE pengaturan SET 
                                    nama        = '".$nama."',
                                    email       = '".$email."',
                                    telepon     = '".$telp."',
                                    alamat      = '".$alamat."',
                                    google_maps = '".$nama."',
                                    logo        = '".$rename_logo."',
                                    favicon     = '".$rename_favicon."'                     
                                
                                    WHERE id = '".$d->id."'
                                
                                ");

                        if($update) {
                                echo "<script>window.location='identitas-sekolah.php?success=Data berhasil'</script>";
                            }
                            else{
                                
                                echo '<div class="alert alert-danger mt-3 mb-3">Data gagal diubah</div>'.mysqli_error($conn);
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