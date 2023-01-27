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
    <title>Home</title>
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
          <a class="nav-link active me-2 ms-2" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link me-2 ms-2" aria-current="page" href="menu.php">Menu</a>
        </li>
        <li class="nav-item">
          <a class="nav-link me-2 ms-2" href="gallery.php">Gallery</a>
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

<!-- Banner Home -->
<div id="bawah_navbar">
  <img src="img/banner_1.png" class="img-fluid">
</div>

<!-- Pengantar -->
<div class="container mt-5">
<div class="row justify-content-center">
  <div class="col-lg-5 d-lg-block d-sm-none d-md-none d-none" id="left">
    <img src="img/1.jpg" class="img-fluid w-100">
  </div>
  <div class="col-lg-7 col-md-12 col-sm-12 col-12" id="right">
    <p class="fs-1 mb-3 text-center" id="sub_judul7">Banaran 9 Warnasari</p>
    <p class="text-center" style="color: #fd8d19; text-align: justify; ">Restoran Banaran 9 Warnasari hadir sebagai restoran yang menyajikan makanan enak dan sehat dengan menggunakan bahan-bahan berkualitas dan terpilih sehingga menghasilkan citra rasa terbaik. Restoran Banaran 9 Warnasari memiliki minuman khas yaitu Banaran Coffee yang terbuat dari 100% biji kopi terbaik dan diproses oleh tenaga ahli sehingga menghasilkan aroma kopi hitam yang nikmat.</p>
  <div class="text-center">
    <a href="menu.php"class="btn btn-md mt-3 rounded-pill text-white pe-2 ps-2" id="btn_user3">Lihat Menu <i class="bi bi-arrow-bar-right"></i></a>
  </div>
  </div>  
</div>
</div>

<!-- Layanan -->
<div class="container mt-5">
  <div class="container-fluid text-center">
    <div class="row justify-content-center">
    <div id="top">
      <p class="fs-1 mb-5 text-center" id="sub_judul7">Layanan</p>
    </div>
          <div class="col-lg-3 col-md-3 col-sm-6 col-6" id="left">
            <img src="img/layanan_001.png" class="image-fluid w-75 mb-3" alt="Layanan Satu" id="gambar">
            <h4 style="color: #008037">Meeting Room</h4>
            <p style="color: #fd8d19;">Tersedia Meeting Room dengan kapasitas besar</p>
          </div>
          <div class="col-lg-3 col-md-3 col-sm-6 col-6" id="left">
            <img src="img/layanan_002.png" class="image-fluid w-75 mb-3" alt="Layanan Dua" id="gambar">
            <h4 style="color: #008037">Food and Drink</h4>
            <p style="color: #fd8d19;">Berbagai macam makanan, minuman dan snack</p>
          </div>
          <div class="col-lg-3 col-md-3 col-sm-6 col-6" id="right">
            <img src="img/layanan_003.png" class="image-fluid w-75 mb-3" alt="Layanan Dua" id="gambar">
            <h4 style="color: #008037">Catering</h4>
            <p style="color: #fd8d19;">Melayani catering dengan jumlah yang besar</p>
          </div>
          <div class="col-lg-3 col-md-3 col-sm-6 col-6" id="right">
            <img src="img/layanan_004.png" class="image-fluid w-75 mb-3" alt="Layanan Tiga" id="gambar">
            <h4 style="color: #008037">Live Music</h4>
            <p style="color: #fd8d19;">Tersedia live musik setiap malam minggu</p>
          </div>
    </div>
  </div>
</div>

<!-- Produk -->
<div class="container-fluid mt-5">
<div class="pt-4 pb-4 background_kopi" style=" border-radius: 20px; box-shadow: 0px 0px 10px 5px #008037">
  <div class="container">
    <div class="row justify-content-center pt-3">
        <div class="col-lg-3 col-md-6 col-sm-6 col-6 mb-4 order-mb-2 order-3" id="right">
            <img src="img/kopi_kemasan.png" class="image-fluid w-100 rounded-3" style="box-shadow: 0px 0px 20px 5px #5e3f13;" alt="Produk Banaran" id="gambar_zoom">
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-6 mb-4 order-mb-3 order-3" id="right">
            <img src="img/kopi_seduh.png" class="image-fluid w-100 rounded-3" style="box-shadow: 0px 0px 20px 5px #5e3f13;" alt="Produk Banaran" id="gambar_zoom">
        </div>
        <div class="col-lg-6 col-md-12 col-sm-12 col-12 order-mb-1 order-1 justify-content-center" id="left">
          <div id="bg_produk1" class="rounded-3" >
          <h1 class="mb-2 pt-5 text-center text-white" style="font-family: Brush Script MT; text-shadow: 1px 1px #fd8d19">Special Banaran Coffee</h1>
          <p class="text-center pb-5 pt-4 me-2 ms-2 text-white">Cita rasa unik <b>Mocha Java</b> merupakan ciri khas <b>Banaran Original.</b> Terbuat dari 100% biji kopi terbaik dan diproses oleh tenaga ahli sehingga menghasilkan <b>Aroma</b> dan <b>Cita Rasa</b> kopi hitam yang nikmat</p>   
          </div>
        </div>
    </div>
  </div>
</div>
</div>

<!-- Fasilitas -->
<div class="container mt-5">
<div class="container-fluid text-center">
  <div id="top">
    <p class="fs-1 mb-5 text-center" id="sub_judul7">Fasilitas</p>
  </div>
    <div class="row justify-content-center text-center">
          <div class="col-lg-4 col-md-3 col-sm-6 col-6" id="left">
          <img src="img/24_jam.png" class="img-fluid" width="25%" alt="toilet" id="gambar">
            <h4 style="color: #008037">Buka 24 Jam</h4>
            <p style="color: #fd8d19;">Melayani 24 jam setiap hari</p>
          </div>
          <div class="col-lg-4 col-md-3 col-sm-6 col-6" id="left">
          <img src="img/mushola.png" class="img-fluid" width="25%" alt="toilet" id="gambar">
            <h4 style="color: #008037">Mushola</h4>
            <p style="color: #fd8d19;">Terdapat mushola yang nyaman</p>
          </div>
          <div class="col-lg-4 col-md-3 col-sm-6 col-6" id="left">
          <img src="img/toilet.png" class="img-fluid" width="25%" alt="toilet" id="gambar">
            <h4 style="color: #008037">Toilet</h4>
            <p style="color: #fd8d19;">Toilet nyaman dan bersih</p>
          </div>
          <div class="col-lg-4 col-md-3 col-sm-6 col-6" id="right">
          <img src="img/panggung.png" class="img-fluid" width="25%" alt="toilet" id="gambar">
            <h4 style="color: #008037">Panggung Hiburan</h4>
            <p style="color: #fd8d19;">Tersedia panggung hiburan</p>
          </div>
          <div class="col-lg-4 col-md-3 col-sm-6 col-6" id="right">
          <img src="img/keamanan.png" class="img-fluid" width="25%" alt="toilet" id="gambar">
            <h4 style="color: #008037">Keamanan</h4>
            <p style="color: #fd8d19;">Dilengkapi CCTV dan Satpam</p>
          </div>
          <div class="col-lg-4 col-md-3 col-sm-6 col-6" id="right">
          <img src="img/parkir.png" class="img-fluid" width="25%" alt="toilet" id="gambar">
            <h4 style="color: #008037">Parkir</h4>
            <p style="color: #fd8d19;">Parkiran yang luas dan aman</p>
          </div>
    </div>
    </div>
</div>

<!-- Script -->
<?php include 'kerangka/sweet_alert.php'; ?>
<!-- Footer -->
<?php include 'kerangka/footer.php'; ?>

</body>
</html>
