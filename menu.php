<?php
// Session Start
session_start();
require 'functions.php';
error_reporting(0);

// Session username
if (isset($_SESSION["username"])){ 
  $username = $_SESSION['username'];
  // Menampilkan data pengguna sesuai dengan username yang ada
  $pengguna  = query("SELECT id FROM pengguna WHERE username = '$username'");
}

// INT Ke Rupiah
function rupiah($angka){
	$hasil_rupiah = "Rp " . number_format($angka,2,',','.');
	return $hasil_rupiah;
}

// Button Favorit
if(isset($_POST["tambah_favorit"]) > 0){
  // Cek Aapakah Ada Session?
  if( !isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
  }
  //cek data berhasil atau tidak
  if(tambah_favorit($_POST) > 0 ) {
    $tambah_menu_favorit_berhasil = true;
  }else{
    $tambah_menu_favorit_gagal = true;
  }
}

$makanan   = query("SELECT * FROM menu_makanan ORDER BY nama_menu ASC");
$minuman   = query("SELECT * FROM menu_minuman ORDER BY nama_menu ASC");

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Menu</title>
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
          <a class="nav-link active me-2 ms-2" aria-current="page" href="menu.php">Menu</a>
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
          <button type="button" class="btn dropdown-toggle text-white btn-sm mt-1 pb-1" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false" id="btn_user">
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

<!-- Banner Menu -->
<div id="bawah_navbar">
  <img src="img/banner_menu.png" class="img-fluid">
</div>

<!-- Navbar Food And Drink -->
<div class="container mt-3">
<nav class="navbar navbar-expand-lg border-bottom border-success">
    <div class="container-fluid text-center justify-content-center">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="nav navbar-nav me-auto" id="left">
          <li class="nav-item">
            <a class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-makanan" type="button" role="tab" aria-controls="nav-makanan" aria-selected="true">Food</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-minuman" type="button" role="tab" aria-controls="nav-minuman" aria-selected="false">Drink</a>
          </li>
        </ul>
      </div>
      <!-- Pencarian -->
      <div class="col-lg-5 col-md-10 col-sm-10 col-10" id="right">
        <input type="text" id="pencarian" class="form-control rounded-pill  m-2" placeholder="Pencarian Menu">
      </div>
    </div>
</nav>

<!-- Konten Menu -->
<div class="tab-content" id="nav-tabContent">
  <!-- Makanan -->
  <div class="tab-pane fade show active" id="nav-makanan" role="tabpanel" aria-labelledby="nav-makanan-tab" tabindex="0">
  <div class="container-fluid">
  <div class="row pb-2 pt-3 row-cols-lg-5 row-cols-md-3 row-cols-sm-2 row-cols-2 g-3 justify-content-center">
  <?php foreach( $makanan as $row) : ?>
    <section>    
    <form action="" method="post">
    <div class="col" id="bottom">
        <div class="card text-center bg-light" id="gambar">
        <?php foreach( $pengguna as $row1) : ?>
          <input type="hidden" class="form-control" name="id_pelanggan" value="<?php echo $row1['id'] ?>">
        <?php endforeach; ?>
        <input type="hidden" class="form-control" name="kode_menu" value="<?php echo $row['kode_menu'] ?>">
        <input type="hidden" class="form-control" name="kode_pemesanan" value="<?php echo $kode_pemesanan; ?>"> 
          <img src="img/foto/<?php echo $row['foto']; ?>" class="card-img-top" alt="...">
          <div class="card-body">
              <h6 class="fw-bold"><?php echo $row['nama_menu']; ?></h6>
              <h6 class="text-danger fw-bold"><?php echo rupiah($row['harga']); ?></h6>
              <div class="d-grid gap-2">
              <button type="submit" name="tambah_favorit" class="btn btn-sm rounded-pill text-white" id="btn_user"><i class="bi bi-plus-circle"></i> Favorit</button>
              </div>
          </div>
        </div>
    </div>
  </form>
  </section>  
  <?php endforeach ?> 
  </div>
  </div>
  </div>
  
  <!-- Minuman -->
  <div class="tab-pane fade" id="nav-minuman" role="tabpanel" aria-labelledby="nav-minuman-tab" tabindex="0">
  <div class="container-fluid">
  <div class="row pb-2 pt-3 row-cols-lg-5 row-cols-md-3 row-cols-sm-2 row-cols-2 g-3 justify-content-center">
  <?php foreach( $minuman as $row) : ?>
  <section>
    <form action="" method="post">
    <div class="col" id="bottom">
        <div class="card text-center bg-light" id="gambar">
        <?php foreach( $pengguna as $row1) : ?>
        <input type="hidden" class="form-control" name="id_pelanggan" value="<?php echo $row1['id'] ?>">
        <?php endforeach; ?>
        <input type="hidden" class="form-control" name="kode_menu" value="<?php echo $row['kode_menu'] ?>">
        <input type="hidden" class="form-control" name="kode_pemesanan" value="<?php echo $kode_pemesanan; ?>"> 
          <img src="img/foto/<?php echo $row['foto']; ?>" class="card-img-top" alt="...">
          <div class="card-body">
              <h6 class="fw-bold"><?php echo $row['nama_menu']; ?></h6>
              <h6 class="text-danger fw-bold"><?php echo rupiah($row['harga']); ?></h6>
              <div class="d-grid gap-2">
              <button type="submit" name="tambah_favorit" class="btn btn-sm rounded-pill text-white" id="btn_user"><i class="bi bi-plus-circle"></i> Favorit</button>
              </div>
          </div>
        </div>
    </div>
  </form>
  </section>
  <?php endforeach ?> 
  </div>
  </div>
  </div>
</div>
</div>

<!-- Footer -->
<?php include 'kerangka/footer.php'; ?>
<!-- Script -->
<?php include 'kerangka/search.php'; ?>
<!-- Script -->
<?php include 'kerangka/sweet_alert.php'; ?>

<?php   
    // Jika variabel tambah menu berhasil memiliki nilai
    if(isset($tambah_menu_favorit_berhasil)) {
      echo "<script> tambah_menu_favorit_berhasil(); </script>";
    }
    // Jika variabel tambah menu gagal memiliki nilai
    else if(isset($tambah_menu_favorit_gagal)){
      echo "<script> tambah_menu_favorit_gagal(); </script";
    }else{
      exit;
    };
?>

</body>
</html>
