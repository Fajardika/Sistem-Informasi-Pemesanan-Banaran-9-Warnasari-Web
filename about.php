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
    <title>About Us</title>
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
          <a class="nav-link me-2 ms-2" href="gallery.php">Gallery</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active me-2 ms-2" href="about.php">About Us</a>
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
              <button type="button" onclick="logout()" id="btn_user3" class="btn rounded-pill btn-sm text-white">Logout</button>
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

<!-- Banner About Us -->
<div id="bawah_navbar">
  <img src="img/banner_about_us.png" class="img-fluid">
</div>

<!-- Profil Singkat -->
<div class="container mt-5" id="top">
    <p class="fs-2 mb-3 text-center" id="sub_judul7">Sejarah Singkat</p>
    <p style="color: #fd8d19; text-align: justify;line-height: 1.5rem;">PT Perkebunan Nusantara IX atau dikenal dengan PTPN IX merupakan perusahaan yang bergerak di bidang perkebunan tanaman tahunan yang berada di Jawa Tengah. Selain di bidang perkebunan tanaman tahunan, PTPN IX juga memiliki restoran. Salah satu restoran yang berada di unit kerja Warnasari adalah Restoran Banaran 9 Warnasari yang menyediakan berbagai hidangan makanan dan minuman. Minuman spesial dari Banaran 9 Warnasari adalah kopi Banaran, Kopi Banaran merupakan produk asli buatan sendiri dari Banaran 9 yang di produksi di Semarang. Selain makanan dan minuman Restoran ini menyediakan berbagai snack, seperti pisang goreng, kentang goreng dan lain-lain. Restoran ini didirikan pada tahun 2009 yang beralamat di Jl. Raya Banjar-Majenang Banjar Kilometer 9, Kabupaten Cilacap, Jawa Tengah.</p>
</div>

<div class="container mt-5">
<div class="row">
  <!-- Jadwal -->
  <div class="col-lg-4" id="left">
    <div class="card bg-light p-3 mb-3">
    <p class="fs-2 mb-3 text-center" id="sub_judul7">Jam Operasional</p>
    <table class="table text-center table-bordered table-hover">
      <thead>
        <th>Hari</th>
        <th>Jam</th>  
      </thead>
      <tbody>
        <tr>
          <td>Senin</td>
          <td>07:00 - 23:00</td>
        </tr>
        <tr>
          <td>Selasa</td>
          <td>07:00 - 23:00</td>
        </tr>
        <tr>
          <td>Rabu</td>
          <td>07:00 - 23:00</td>
        </tr>
        <tr>
          <td>Kamis</td>
          <td>07:00 - 23:00</td>
        </tr>
        <tr>
          <td>Jumat</td>
          <td>07:00 - 23:00</td>
        </tr>
        <tr>
          <td>Sabtu</td>
          <td>07:00 - 23:00</td>
        </tr>
        <tr>
          <td>Minggu</td>
          <td>07:00 - 23:00</td>
        </tr>
      </tbody>
      </table>
      <p style="color: var(--brand)"><b class="text-danger">Keterangan :</b><br> Jam operasional sewaktu-waktu bisa berubah.</p>
    </div>
  </div>

  <!-- Maps -->
  <div class="col-lg-8" id="right">
    <div class="card bg-light p-3">
    <p class="fs-2 mb-3 text-center" id="sub_judul7">Lokasi Restoran</p>
      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.2434511641413!2d108.59600701378376!3d-7.326530074083424!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6f633ea002d719%3A0x9a35e93e2b3d6b6e!2sBanaran%209%20Warnasari!5e0!3m2!1sid!2sid!4v1662874965755!5m2!1sid!2sid"  id="maps" width="100%" height="430"  allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
  </div>
</div>

<!-- Media Sosial -->
<div class="container text-center mt-5">
<div class="row justify-content-center">
      <div class="col-lg-3 col-md-3 col-sm-6 col-6" id="bottom">
        <a href="https://api.whatsapp.com/send/?phone=6287736605484&text&app_absent=0" target="_blank" id="image_hover"><img src="img/whatsapp.png" width="15%"></a>
        <p style="color: var(--brand2)" class="mt-3">087736605484</p>
      </div>
      <div class="col-lg-3 col-md-3 col-sm-6 col-6" id="bottom">
        <a href="https://www.instagram.com/banaran9warnasari/?hl=id" target="_blank" id="image_hover"><img src="img/ig.png" width="15%"></a>
        <p style="color: var(--brand2)" class="mt-3">@banaran9warnasari</p>
      </div>
      <div class="col-lg-3 col-md-3 col-sm-6 col-6" id="bottom">
        <a href="https://www.facebook.com/profile.php?id=100057246498293" target="_blank" id="image_hover"><img src="img/fb.png" width="15%"></a>
        <p style="color: var(--brand2)" class="mt-3">Banaran 9 Warnasari</p>
      </div>
      <div class="col-lg-3 col-md-3 col-sm-6 col-6" id="bottom">
        <a href="https://mail.google.com/mail/u/0/?fs=1&tf=cm&source=mailto&to=banaran9warnasari@gmail.com" target="_blank" id="image_hover"><img src="img/email.png" width="15%"></a>
        <p style="color: var(--brand2)" class="mt-3">banaran9@gmail.com</p>
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


