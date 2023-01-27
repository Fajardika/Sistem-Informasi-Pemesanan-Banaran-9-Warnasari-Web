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

// INT Ke Rupiah
function rupiah($angka){
	
	$hasil_rupiah = "Rp " . number_format($angka,2,',','.');
	return $hasil_rupiah;
 
}

$kode_pemesanan   = $_GET["kode_pemesanan"];
$detail_pemesanan = query("SELECT * FROM detail_pesanan WHERE kode_pemesanan=$kode_pemesanan");

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin</title>
    <link rel="shortcut icon" href="../img/title.png">
    <link rel="stylesheet" href="../css/style_custom.css">
    <?php include '../kerangka/head.php'; ?>
</head>
<body class="background_menu">
    <div class="container-fluid">
    <div class="pt-3">
    <div class="card pe-3 ps-3">
    <div class="row justify-content-center">
      <div class="col-lg-2 col-md-2 order-lg-1 order-md-1 order-sm-3 order-3">
      </div>
      <div class="col-lg-8 col-md-8 order-lg-2 order-md-2 order-sm-2 order-2">
        <h4 class="text-center pt-2 pb-2" id="sub_judul">Detail Pesanan <?php echo $kode_pemesanan ?></h4>
      </div>
      <div class="col-lg-2 col-md-2 order-lg-3 order-md-3 order-sm-1 order-1 text-end pt-2 mt-1">
        <a href="pemesanan.php" class="btn rounded-pill text-white btn-sm" id="btn_user3">Kembali</a>
      </div>
    </div>


    <div class="table-responsive mt-3 pb-3" id="bottom">
              <table id="table1" class="table table-striped table-bordered display border mt-6 table-hover table-sm ">
              <thead class="text-white text-center">
                <tr>           
                  <th>No</th>
                  <th>Menu</th>
                  <th>Kategori</th>
                  <th>Jumlah</th> 
                  <th>Harga</th>
                </tr>
              </thead>
              <tbody  class="table-light text-center" id="tbody">
              <!-- Looping Table -->
                <?php $i = 1; ?>
                <?php foreach( $detail_pemesanan as $row) : ?>
                  <tr>
                  <td class="col-sm-1"><?= $i++; ?></td>
                  <td class="col-sm-1"><?= $row["nama_menu"] ?></td>
                  <td class="col-sm-2"><?= $row["nama_kategori"] ?></td>
                  <td class="col-sm-2"><?= $row["jumlah"] ?></td>
                  <td class="col-sm-1"><?= rupiah($row["harga"]); ?></td>                   
                  </tr>
                <?php endforeach ?>
              </tbody>
              <script>
                  $(document).ready(function(){
                  $('#table1').DataTable();});
              </script>
              </table>
              </div>
    </div>
    </div>
    </div>

<!-- Script -->
<?php include '../kerangka/sweet_alert.php'; ?>

</body>
</html>
