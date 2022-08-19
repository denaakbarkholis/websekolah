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
                    <h5>Tambah Jurusan</h5>
                </div>
                <div class="main-content pt-4">

                    <form action="" method="post" class="ms-3 me-3" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control" name="nama" aria-describedby="nama"
                                placeholder="Nama Jurusan" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Keterangan</label>
                            <textarea name="keterangan" class="form-control" placeholder="Keterangan" cols="30"
                                rows="5"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Gambar</label>
                            <input type="file" name="gambar" class="input-control">
                        </div>

                        <button type="submit" name="submit" class="btn btn-primary" value="simpan">Tambah</button>
                        <a href="jurusan.php"><button type="button" class="btn btn-danger">Kembali</button></a>
                        <br>

                        <?php
                            if(isset($_POST['submit'])) {

                                $nama  = addslashes(ucwords($_POST['nama']));
                                $ket   = addslashes($_POST['keterangan']);

                                $filename = $_FILES['gambar']['name'];
                                $tmpname  = $_FILES['gambar']['tmp_name'];
                                $filesize = $_FILES['gambar']['size'];

                                $formatfile = pathinfo($filename, PATHINFO_EXTENSION);
                                $rename     = 'jurusan'.time().'.'.$formatfile;

                                $typefile   = array('png', 'jpg', 'jpeg', 'gif');
                                
                                move_uploaded_file($tmpname, "../uploads/jurusan/".$rename);

                                if(!in_array($formatfile, $typefile)){
                                    
                                    echo '<div class="alert alert-warning mt-3 mb-3">Format file tidak diijinkan</div>';
                                   

                                }elseif($filesize > 1000000){
                                       
                                        echo '<div class="alert alert-warning  mt-3 mb-3">Ukuran file maksimal 1Mb. </div>';
                                    
                                }else{
                             
                                    $simpan = mysqli_query($conn,  "INSERT INTO jurusan VALUE(    
                                        null,
                                        '".$nama."',
                                        '".$ket."',
                                        '".$rename."',
                                        null,
                                        null
                                    )");
                                    
                                    if($simpan){
                                       
                                        echo "<script>window.location='jurusan.php?success=Data berhasil'</script>";
                                    }
                                    else{
                                   
                                        echo '<div class="alert alert-danger mt-3 mb-3">gagal simpan data
                                        </div>'.mysqli_error($conn);
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