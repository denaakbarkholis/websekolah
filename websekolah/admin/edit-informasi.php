<?php
include '../koneksi.php';
session_start();



if(!isset($_SESSION['status_login'])) {

	header("location: ../login.php?msg=Harap login terlebih dahulu");
	exit;
}

$informasi = mysqli_query($conn, "SELECT * FROM informasi WHERE id = '".$_GET['idinformasi']."' ");

if(mysqli_num_rows($informasi) == 0){
    header("location: informasi.php");
}

$p  = mysqli_fetch_object($informasi);

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
                    <h5>Edit informasi</h5>
                </div>
                <div class="main-content pt-4">

                    <form action="" method="post" class="ms-3 me-3" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label class="form-label">Judul</label>
                            <input type="text" class="form-control" name="judul" aria-describedby="nama"
                                placeholder="Judul" value="<?= $p->judul?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Keterangan</label>
                            <textarea name="keterangan" class="form-control" placeholder="Keterangan" cols="30"
                                rows="5"><?=  $p->keterangan?></textarea>
                        </div>

                        <div class=" mb-3">
                            <label class="form-label">Gambar</label>
                            <br>
                            <img src="../uploads/informasi/<?= $p->gambar ?>" alt="" width="200px" class="image">
                            <br>
                            <input type="hidden" name="gambar2" value="<?= $p->gambar ?>">
                            <input type="file" name="gambar" class="input-control">
                        </div>

                        <button type="submit" name="submit" class="btn btn-primary">Ubah</button>
                        <a href="informasi.php"><button type="button" class="btn btn-danger">Kembali</button></a>

                        <br>

                        <?php
                        
                        if(isset($_POST['submit'])) {

                            $judul = addslashes(ucwords($_POST['judul']));
                            $ket   = addslashes($_POST['keterangan']);
                          
                            if($_FILES['gambar']['name'] != '') {
                            
                                $filename = $_FILES['gambar']['name'];
                                $tmpname  = $_FILES['gambar']['tmp_name'];
                                $filesize = $_FILES['gambar']['size'];

                                $formatfile = pathinfo($filename, PATHINFO_EXTENSION);
                                $rename     = 'informasi'.time().'.'.$formatfile;

                                $typefile   = array('png', 'jpg', 'jpeg', 'gif');

                                if(!in_array($formatfile, $typefile)){
                                    
                                    echo '<div class="alert alert-warning mt-3 mb-3">Format file tidak diijinkan</div>';
                                    return false;

                                }elseif($filesize > 1000000){
                                        
                                        echo '<div class="alert alert-warning mt-3 mb-3">Ukuran file maksimal 1Mb. </div>';
                                        return false;
                                }else{
                                    
                                        if(file_exists("../uploads/informasi/".$_POST['gambar2'])){
                                        unlink("../uploads/informasi/".$_POST['gambar2']);
                                    }
                                move_uploaded_file($tmpname, "../uploads/informasi/".$rename);
                                }
                                
                            }else {
                              
                                $rename = $_POST['gambar2'];                               


                            }
                                    $update  = mysqli_query($conn, "UPDATE informasi SET 
                                    judul       = '".$judul."',
                                    keterangan = '".$ket."',
                                    gambar     = '".$rename."'                        
                                
                                    WHERE id = '".$_GET['idinformasi']."'
                                
                                ");

                        if($update) {
                                echo "<script>window.location='informasi.php?success=Data berhasil'</script>";
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