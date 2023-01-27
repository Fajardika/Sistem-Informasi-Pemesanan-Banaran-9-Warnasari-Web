<?php
session_start();
require '../functions.php';
error_reporting(0);

// Cek Session?
if(!isset($_SESSION["login"])) {
  header("Location: ../login.php");
  exit;
}

if (isset($_SESSION["username"])){ 
  $username = $_SESSION['username'];
  // Menampilkan data pengguna sesuai dengan username yang ada
    $pengguna  = query("SELECT id,foto,nama,jenis_kelamin,no_telp,alamat,username,password,level FROM pengguna WHERE username = '$username'");
}

// Mengecek level yang login
if(isset($_SESSION["level"] )) {
  $level = $_SESSION['level'];
  $level1   = 'Admin';
  $level2   = 'Pelayan';
  $level3   = 'Kasir';
  $level4   = 'Chef';
  $level5   = 'Pelanggan';
  if($level != $level1){
    if($level == $level3){
      header("Location: ../kasir/index.php");
    }else if($level == $level4){
      header("Location: ../koki/index.php");
    }else if($level == $level2){
      header("Location: ../pelayan/index.php");
    }else if($level == $level5){
      header("Location: ../dashboard.php");
    }else{
      header("Location: ../index.php");
    }
  }
}


$jum_pengguna      = mysqli_query($conn,"SELECT * FROM pengguna");
$jumlah_pengguna   = mysqli_num_rows($jum_pengguna);
$jum_menu          = mysqli_query($conn,"SELECT * FROM menu");
$jumlah_menu       = mysqli_num_rows($jum_menu);
$jum_pemesanan     = mysqli_query($conn,"SELECT * FROM pemesanan");
$jumlah_pemesanan  = mysqli_num_rows($jum_pemesanan);
$jum_pembayaran    = mysqli_query($conn,"SELECT * FROM pembayaran");
$jumlah_pembayaran = mysqli_num_rows($jum_pembayaran);

?>

<!doctype html>
<html lang="en"> 
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin</title>
    <link rel="shortcut icon" href="../img/title.png">
    <?php include '../kerangka/head.php'; ?>
</head>
<body>

<!-- Navbar -->
<?php include '../kerangka/navbar_admin.php'; ?>


<!-- Side Bar dan Konten -->
<div class="container-fluid">
  <div class="row" id="bawah_navbar">
    <!-- Side Bar -->
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar1 shadow collapse position-fixed">
    <img src="../img/Logo_Banaran_Transparant.png" class="img-fluid mt-3" alt="Logo Banaran" width="100%" id="left">
      <div class="position-sticky pt-3 sidebar1-sticky">
        <ul class="nav flex-column" id="left">
          <li class="nav-item">
            <a class="nav-link  active" href="index.php" id="gambar1"><i class="bi bi-house"></i> Dashboard</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="pengguna.php" id="gambar1"><i class="bi bi-people"></i> Pengguna</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="kategori.php" id="gambar1"><i class="bi bi-ui-checks"></i> Kategori Menu</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="menu.php" id="gambar1"><i class="bi bi-cup-straw"></i> Menu</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="pemesanan.php" id="gambar1"><i class="bi bi-journal-text"></i> Pemesanan</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="pembayaran.php" id="gambar1"><i class="bi bi-cash-coin"></i> Pembayaran</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="laporan.php" id="gambar1"><i class="bi bi-clipboard-data"></i> Laporan</a>
          </li>          
        </ul>
      </div>
    </nav>

    <!-- Konten -->
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="row mt-4">
      <!-- Pengguna -->
      <div class="col-xl-3 col-md-6 col-sm-6 col-6 mb-3" id="top">
        <div class="card shadow border-start border-success border-5" id="gambar">
          <div class="card-body">
              <div class="row">
              <div class="col-5">
                <img src="../img/users.png" width="130%"> 
              </div>
              <div class="col-7 text-end">
                  <h6 class="fw-bold" style="color: #008037">Pengguna</h6>
                  <h2 class="fs-bold text-dark"><?php echo $jumlah_pengguna; ?></h2>
              </div>

              </div>
          </div>
        </div>
      </div>
      <!-- Menu -->
      <div class="col-xl-3 col-md-6 col-sm-6 col-6 mb-3" id="top">
        <div class="card shadow border-start border-success border-5" id="gambar"> 
          <div class="card-body">
              <div class="row">
              <div class="col-5">
                <img src="../img/menu.png" width="130%"> 
              </div>
              <div class="col-7 text-end">
                  <h6 class="fw-bold" style="color: #008037">Menu</h6>
                  <h2 class="fs-bold text-dark"><?php echo $jumlah_menu; ?></h2>
              </div>
              </div>
          </div>
        </div>
      </div>
      <!-- Pemesanan -->
      <div class="col-xl-3 col-md-6 col-sm-6 col-6 mb-3" id="top">
        <div class="card shadow border-start border-success border-5" id="gambar">
          <div class="card-body">
              <div class="row">
              <div class="col-5">
                <img src="../img/pemesanan.png" width="130%"> 
              </div>
              <div class="col-7 text-end">
                  <h6 class="fw-bold" style="color: #008037">Pemesanan</h6>
                  <h2 class="fs-bold text-dark"><?php echo $jumlah_pemesanan; ?></h2>
              </div>
              </div>
          </div>
        </div>
      </div>
      <!-- Pembayaran -->
      <div class="col-xl-3 col-md-6 col-sm-6 col-6 mb-3" id="top">
        <div class="card shadow border-start border-success border-5" id="gambar">
          <div class="card-body">
              <div class="row">
              <div class="col-5">
                <img src="../img/pembayaran.png" width="130%"> 
              </div>
              <div class="col-7 text-end">
                  <h6 class="fw-bold" style="color: #008037">Pembayaran</h6>
                  <h2 class="fs-bold text-dark"><?php echo $jumlah_pembayaran; ?></h2>
              </div>
              </div>
          </div>
        </div>
      </div>
    </div>
    <?php foreach( $pengguna as $row) : ?>
      <h4 id="left" class="mb-2 text-success">Selamat Datang <?= $row["nama"] ?></h4>
    <?php endforeach; ?> 
    <div class="row">
      <div class="col-xl-12" id="bottom">
        <img src="../img/banner_admin.png" class="img-fluid shadow border border-success border-1"> 
      </div>
    </div>

    </main>
  </div>
</div>

<!-- Script -->
<?php include '../kerangka/sweet_alert.php'; ?>

</body>
</html>
