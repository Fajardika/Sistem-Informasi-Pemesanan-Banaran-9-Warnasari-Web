<?php
session_start();
require 'functions.php';
error_reporting(0);
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gallery</title>
    <link rel="shortcut icon" href="img/title.png">
    <?php include 'kerangka/head.php'; ?>
  </head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg fixed-top shadow" id="background_navbar">
<div class="container">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <img src="img/Logo_Banaran_Transparant.png" alt="LOGO" class="img-fluid" width="13%" id="left">
    <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
      <ul class="navbar-nav ms-auto" id="right">
        <li class="nav-item">
          <a class="nav-link me-2 ms-2" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link me-2 ms-2" aria-current="page" href="menu.php">Menu</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active me-2 ms-2" href="gallery.php">Gallery</a>
        </li>
        <li class="nav-item">
          <a class="nav-link me-2 ms-2" href="about.php">About Us</a>
        </li>
        <li class="nav-item me-2 ms-2">
        <!-- Percabangan Menampilkan Button Login dan Dashboard -->
        <?php
        // Jika terdapat session maka akan menampilkan button dashboard
        if (isset($_SESSION["username"])){ 
        ?>
          <button type="button" class="btn dropdown-toggle btn-sm mt-1 pb-1 text-white" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false" id="btn_user">
            <i class="bi bi-person-circle"></i></i> User
          </button>
            <ul class="dropdown-menu dropdown-menu-lg-end">
              <li class="border-bottom border-success">
                <a class="nav-link" href="dashboard.php">Dashboard</a>
              </li>
              <li>
              <div class="d-grid gap-2 me-2 ms-2 mt-2"> 
              <button type="button" onclick="logout()" id="btn_user3"  class="btn rounded-pill btn-sm text-white">Logout</button>
              </div>
              </li>
            </ul>
        <!-- Jika tidak terdapat session maka akan menampilkan button login -->
        <?php }else{ ?>
          <a class="btn btn-sm mt-1 pb-1 pe-3 ps-3 text-white" href="login.php" id="btn_user">Login</a>
        <?php } ?>
        </li>
      </ul>
    </div>
</div>
</nav>

<!-- Carousel -->
<div class="container pt-3" id="bawah_navbar">
<div class="card p-3 bg-light" id="top">
<div id="carouselExampleCaptions" class="carousel slide d-lg-block d-md-none d-sm-none d-none" data-bs-ride="false">
  <div class="carousel-inner">
    <div class="carousel-item active">
        <img src="img/galeri/01.png" class="img-fluid w-100" id="slide">
        <div class="gradiasi1"></div>
        <div class="gradiasi2"></div>
        <div class="logo-slide text-center">
            <img src="img/Logo_Banaran_Transparant.png" class="img-fluid" id="top" width="15%">
        </div>
    </div>
    <div class="carousel-item">
        <img src="img/galeri/02.png" class="img-fluid w-100" id="slide">
        <div class="gradiasi1"></div>
        <div class="gradiasi2"></div>
        <div class="logo-slide text-center">
            <img src="img/Logo_Banaran_Transparant.png" class="img-fluid" id="top" width="15%">
        </div>
    </div>
    <div class="carousel-item">
        <img src="img/galeri/03.png" style="width:100%">
        <div class="gradiasi1"></div>
        <div class="gradiasi2"></div>
        <div class="logo-slide text-center">
            <img src="img/Logo_Banaran_Transparant.png" class="img-fluid" id="top" width="15%">
        </div>
    </div>
    <div class="carousel-item">
        <img src="img/galeri/04.png" style="width:100%">
        <div class="gradiasi1"></div>
        <div class="gradiasi2"></div>
        <div class="logo-slide text-center">
            <img src="img/Logo_Banaran_Transparant.png" class="img-fluid" id="top" width="15%">
        </div>
    </div>
    <div class="carousel-item">
        <img src="img/galeri/05.png" style="width:100%">
        <div class="gradiasi1"></div>
        <div class="gradiasi2"></div>
        <div class="logo-slide text-center">
            <img src="img/Logo_Banaran_Transparant.png" class="img-fluid" id="top" width="15%">
        </div>
    </div>
    <div class="carousel-item">
        <img src="img/galeri/06.png" style="width:100%">
        <div class="gradiasi1"></div>
        <div class="gradiasi2"></div>
        <div class="logo-slide text-center">
            <img src="img/Logo_Banaran_Transparant.png" class="img-fluid" id="top" width="15%">
        </div>
    </div>
  </div>
</div>

<div class="row pt-3">
    <div class="col-lg-2 mb-3">
    <div class="column">
      <img class="demo img-fluid w-100" src="img/galeri/01.png" onclick="currentSlide(1)">
    </div>
    </div>
    <div class="col-lg-2 mb-3">
    <div class="column">
      <img class="demo img-fluid w-100" src="img/galeri/02.png" onclick="currentSlide(2)">
    </div>        
    </div>
    <div class="col-lg-2 mb-3">
    <div class="column">
      <img class="demo img-fluid w-100" src="img/galeri/03.png" onclick="currentSlide(3)">
    </div>        
    </div>
    <div class="col-lg-2 mb-3">
    <div class="column">
      <img class="demo img-fluid w-100" src="img/galeri/04.png" onclick="currentSlide(4)">
    </div>        
    </div>
    <div class="col-lg-2 mb-3">
    <div class="column">
      <img class="demo img-fluid w-100" src="img/galeri/05.png" onclick="currentSlide(5)"> 
    </div>         
    </div>
    <div class="col-lg-2 mb-3">
    <div class="column">
      <img class="demo img-fluid w-100" src="img/galeri/06.png" onclick="currentSlide(6)">
    </div>        
    </div>
</div>
</div>

<!-- Gallery Card -->
<div class="card p-3 bg-light mt-4" id="bottom">
<div class="row justify-content-center">
<p class="fs-2 text-center" id="sub_judul7">Gallery Banaran 9 Warnasari</p>
    <div class="col-lg-3">
        <img src="img/galeri/001.png" class="image-fluid mb-2 w-100" id="gambar">
    </div>
    <div class="col-lg-9">
    <div class="row">
    <div class="col-lg-2 col-sm-4 col-6">
        <img src="img/galeri/1.png" class="img-fluid w-100 galeri mb-2 rounded-1" id="gambar">
    </div>
    <div class="col-lg-2 col-sm-4 col-6">
        <img src="img/galeri/2.png" class="img-fluid w-100 galeri mb-2 rounded-1" id="gambar">
    </div>
    <div class="col-lg-2 col-sm-4 col-6">
        <img src="img/galeri/3.png" class="img-fluid w-100 galeri mb-2 rounded-1" id="gambar">
    </div>
    <div class="col-lg-2 col-sm-4 col-6">
        <img src="img/galeri/4.png" class="img-fluid w-100 galeri mb-2 rounded-1" id="gambar">
    </div>
    <div class="col-lg-2 col-sm-4 col-6">
        <img src="img/galeri/5.png" class="img-fluid w-100 galeri mb-2 rounded-1" id="gambar">
    </div>
    <div class="col-lg-2 col-sm-4 col-6">
        <img src="img/galeri/6.png" class="img-fluid w-100 galeri mb-2 rounded-1" id="gambar">
    </div>
    </div>
    <div class="row pt-4">
    <div class="col-lg-2 col-sm-4 col-6">
        <img src="img/galeri/7.png" class="img-fluid w-100 galeri mb-2 rounded-1" id="gambar">
    </div>
    <div class="col-lg-2 col-sm-4 col-6">
        <img src="img/galeri/8.png" class="img-fluid w-100 galeri mb-2 rounded-1" id="gambar">
    </div>
    <div class="col-lg-2 col-sm-4 col-6">
        <img src="img/galeri/9.png" class="img-fluid w-100 galeri mb-2 rounded-1" id="gambar">
    </div>
    <div class="col-lg-2 col-sm-4 col-6">
        <img src="img/galeri/10.png" class="img-fluid w-100 galeri mb-2 rounded-1" id="gambar">
    </div>
    <div class="col-lg-2 col-sm-4 col-6">
        <img src="img/galeri/11.png" class="img-fluid w-100 galeri mb-2 rounded-1" id="gambar">
    </div>
    <div class="col-lg-2 col-sm-4 col-6">
        <img src="img/galeri/12.png" class="img-fluid w-100 galeri mb-2 rounded-1" id="gambar">
    </div>
    </div>
    </div>
</div>
</div>
</div>

<!-- Script -->
<?php include 'kerangka/sweet_alert.php'; ?>
<!-- Footer -->
<?php include 'kerangka/footer.php'; ?>
<!-- JS Slide Gallery -->
<?php include 'kerangka/slide_gallery.php'; ?>

</body>
</html>
