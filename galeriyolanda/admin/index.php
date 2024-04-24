<?php 
session_start();
$userid = $_SESSION['userid'];
include '../config/koneksi.php';
if ($_SESSION['status'] != 'login'){
	echo "<script>
	alert('Anda belum login!');
	location.href='../index.php';

  </script>";
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>website Galeri Foto</title>
	<link rel="stylesheet" type="text/css" href="../aseets/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"/>
</head>
<body style="background-image: url('h.jpg'); background-repeat: no-repeat; background-size: cover; background-position: center center;">
  <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container">
      <a class="navbar-brand" href="index.php">Website Galeri Foto</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse mt-2" id="navbarNavAltMarkup">
        <div class="navbar-nav me-auto">
         <a href="home.php" class="nav-link">Home</a>
         <a href="album.php" class="nav-link">Album</a>
         <a href="foto.php" class="nav-link">Foto</a>
       </div>

       <a href="../config/aksi_logout.php" class="btn btn-outline-danger m-1">Keluar</a>
     </div>
   </div>
 </nav>

 <div class="container mt-2">
  <div class="row">
    <?php  
    $query = mysqli_query($koneksi, "SELECT * FROM  foto ");
    while ($data = mysqli_fetch_array($query)) {
      ?>
      <div class="col-md-3 mt-3 ">
        <a type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#Komentar <?php echo $data['fotoid'] ?>">

          <div class="card mb-2">
            <img src="../aseets/img/<?php echo $data['lokasifile'] ?>" class="card-img-top" title="<?php echo $data['judulfoto'] ?>" style="height:12rem;" >
            <div class="card-footer text-center">

              <?php 
              $fotoid = $data['fotoid'];
              $ceksuka = mysqli_query($koneksi, "SELECT * FROM likefoto WHERE fotoid='$fotoid' AND userid='$userid' ");
              if (mysqli_num_rows($ceksuka) ==1 ) { ?>
                <a href="../config/proses_like.php?fotoid=<?php echo $data['fotoid'] ?>" type="submit" name="batalsuka"><i class="fa fa-heart"></i></a>

              <?php }else{?>
                <a href="../config/proses_like.php?fotoid=<?php echo $data['fotoid'] ?>" type="submit" name="batalsuka"><i class="fa-regular fa-heart"></i></a>

              <?php }
              $like = mysqli_query($koneksi, "SELECT * FROM likefoto WHERE fotoid='$fotoid' ");
              echo mysqli_num_rows($like). 'suka';
              ?>
              <a href=""><i class="fa-regular fa-comment"></i>4 Komentar</a>
            </div>
          </div>
        </a>

        
        <div class="modal fade" id="Komentar <?php echo $data['fotoid'] ?> " tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-x1">
            <div class="modal-content">
              <div class="modal-body">
                <div class="row">
                  <div class="col-md-8">
                    <img src="../aseets/img/<?php echo $data['lokasifile'] ?>"
                     class="card-img-top" title="<?php echo $data['judulfoto'] ?>" >
                  </div>
                  <div class="col-md-4">
                    <div class="m-2">
                      <div class="overflow-auto">
                        <div class="sticky-top">
                         <strong> <?php echo $data['judulfoto'] ?></strong>
                         <span class="badge bg-secondary" <?php echo $data['userid'] ?>></span>
                         <span class="badge bg-secondary" <?php echo $data['tanggalunggah'] ?>></span>
                         <span class="badge bg-primary" <?php echo $data['albumid'] ?>></span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>



      </div>
    <?php } ?>
  </div>
</div>



<footer class="d-flex justify-content-center border-top mt-3 bg-light fixed-bottom">
	<p>&copy; UKK RPL 2024 | </p>
</footer>



<script type="text/javascript" src="../aseets/js/bootsrap.min.js"></script>
</body>
</html>