<?php
session_start();
require '../functions.php';
error_reporting(0);

// Cek Session?
if(!isset($_SESSION["login"])) {
  header("Location: ../login.php");
  exit;
}
// Mengecek level yang login
if(isset($_SESSION["level"] )) {
  $level = $_SESSION['level'];
  $level1   = 'Admin';
  $level2   = 'Pelayan';
  $level3   = 'Kasir';
  $level4   = 'Chef';
  $level5   = 'Pelanggan';
  if($level != $level4){
    if($level == $level1){
      header("Location: ../admin/index.php");
    }else if($level == $level3){
      header("Location: ../kasir/index.php");
    }else if($level == $level2){
      header("Location: ../pelayan/index.php");
    }else if($level == $level5){
      header("Location: ../dashboard.php");
    }else{
      header("Location: ../index.php");
    }
  }
}

// Button Tambah
if(isset($_POST["selesai"])){
    //cek data berhasil atau tidak
    if(konfirmasi_pesanan($_POST) > 0 ) {
        $pemesanan_selesai_berhasil = true;
    }else{
        $pemesanan_selesai_gagal = true;
    }
}

$kode_pemesanan   = $_GET["kode_pemesanan"];
$detail_pemesanan = query("SELECT * FROM detail_pesanan WHERE kode_pemesanan= '$kode_pemesanan'")[0];
$detail_menu      = query("SELECT * FROM detail_pesanan WHERE kode_pemesanan= '$kode_pemesanan'");
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Koki</title>
    <link rel="shortcut icon" href="../img/title.png">
    <?php include '../kerangka/head.php'; ?>
</head>
<body>
<!-- Side Bar dan Konten -->
<div class="container-fluid">
  <div class="row" >
    <!-- Konten Menu -->
    <div class="col-lg-8 col-md-7 col-sm-12 col-12 bg-light me-sm-auto order-lg-first order-md-first">
    <!-- Navbar Konten Menu -->
    <nav class="navbar navbar-expand-lg border-bottom border-success" id="top">
    <div class="container-fluid">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <img src="../img/Logo_Banaran_Transparant.png" alt="LOGO" class="img-fluid ms-auto" width="15%">
    </div>
    </nav>
    <div class="table-responsive pt-3 pb-3" id="bottom">
      <table id="table" class="table table-striped table-bordered display border table-hover table-sm ">
      <thead class="text-white text-center">
        <tr>         
          <th>No</th>
          <th>Menu</th>           
          <th>Kategori</th>
          <th>Jumlah</th>  
        </tr>
      </thead>
      <tbody  class="table-light text-center" id="tbody">
      <!-- Looping Table -->
        <?php $i = 1; ?>
        <?php foreach( $detail_menu as $row1) : ?>
          <tr>
          <td class="col-sm-1"><?= $i++; ?></td>
          <td class="col-sm-3"><?= $row1["nama_menu"]; ?></td>
          <td class="col-sm-3"><?= $row1["nama_kategori"]; ?></td>
          <td class="col-sm-2"><?= $row1["jumlah"]; ?></td>                    
          </tr>
        <?php endforeach ?>
      </tbody>
      <script>
        $(document).ready(function(){
        $('#table').DataTable();});
    </script>
      </table>
      </div>   
  </div>

    <!-- Side Bar -->
    <div id="sidebarMenu" class="col-lg-4 col-md-5 col-sm-12 col-12 order-sm-first order-first d-md-block d-sm-block d-block shadow sidebar collapse">
    <div class="position-sticky sidebar-sticky">
    <div class="card mt-2" id="right">
    <div class="card-body">
    <h5 class="text-center pt-1 pb-1" id="sub_judul4">Data Pemesanan</h5>
    <!-- No Pesanan dan No Meja --> 
    <div class="table-responsive">
    <table class="table table-sm border-light">
      <tr>
        <td class="col-sm-5 col-4">Kode Pemesanan</td>
        <td class="col-sm-7 col-8">: <?php echo $detail_pemesanan['kode_pemesanan']; ?> </td>
      </tr>
      <tr>
        <td class="col-sm-3 col-4">Nama Pelayan</td>
        <td class="col-sm-9 col-8">: <?php echo $detail_pemesanan['nama']; ?> </td>
      </tr>
      <tr>
        <td class="col-sm-3 col-4">Nama Pembeli</td>
        <td class="col-sm-9 col-8">: <?php echo $detail_pemesanan['nama_pembeli']; ?></td>
      </tr>
      <tr>
        <td class="col-sm-3 col-4">Nomor Meja</td>
        <td class="col-sm-9 col-8">: <?php echo $detail_pemesanan['no_meja']; ?></td>
      </tr>
      <tr>
        <td class="col-sm-3 col-4">Tanggal</td>
        <td class="col-sm-9 col-8">: <?php echo $detail_pemesanan['tanggal_pemesanan']; ?></td>
      </tr>
      <tr>
        <td class="col-sm-3 col-4">Keterangan</td>
        <td class="col-sm-9 col-8">: <?php echo $detail_pemesanan['keterangan']; ?></td>
      </tr>
      <tr>
        <td class="col-sm-3 col-4">Catatan</td>
        <td class="col-sm-9 col-8">: <?php echo $detail_pemesanan['catatan']; ?></td>
      </tr>
    </table>
    </div>
    <form action="" method="POST">
    <div class="d-grid gap-2">
        <input type="hidden" name="kode_pemesanan" value="<?php echo $detail_pemesanan['kode_pemesanan']; ?>">
        <button type="submit" name="selesai" class="btn  btn-sm rounded-pill text-white" id="btn_user">Selesai</button>                    
        <a class="btn btn-sm text-white mt-1 rounded-pill" id="btn_user3" href="index.php">Kembali</a>
    </div>
    </form>
    </div>
    </div>

    </div>
    </div>

  </div>
</div>

<!-- Script -->
<?php include '../kerangka/sweet_alert.php'; ?>

<?php   
    // Jika variabel tambah menu berhasil memiliki nilai
    if(isset($pemesanan_selesai_berhasil)) {
      echo "<script> pemesanan_selesai_berhasil(); </script>";
    }else if(isset($pemesanan_selesai_gagal)){
      echo "<script> pemesanan_selesai_gagal(); </script>";
    }else{
      exit;
    };
?>


</body>
</html>
