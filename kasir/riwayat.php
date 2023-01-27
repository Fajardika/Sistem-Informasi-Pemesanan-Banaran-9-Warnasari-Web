<?php
session_start();
require '../functions.php';
error_reporting(0);

// Cek Session?
if( !isset($_SESSION["login"])) {
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
  if($level != $level3){
    if($level == $level1){
      header("Location: ../admin/index.php");
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

$pembayaran = query("SELECT * FROM data_pembayaran");

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kasir</title>
    <link rel="shortcut icon" href="../img/title.png">
    <?php include '../kerangka/head.php'; ?>
</head>
<body class="background_menu">
    <div class="container-fluid">
    <div class="pt-3">
    <div class="card pe-3 ps-3" id="top">
    <div class="row justify-content-center">
      <div class="col-lg-2 col-md-2 order-lg-1 order-md-1 order-sm-3 order-3">
      </div>
      <div class="col-lg-8 col-md-8 order-lg-2 order-md-2 order-sm-2 order-2">
        <h4 class="text-center pt-2 pb-2" id="sub_judul">Riwayat Pembayaran</h4>
      </div>
      <div class="col-lg-2 col-md-2 order-lg-3 order-md-3 order-sm-1 order-1 text-end pt-2 mt-1">
        <a href="index.php" class="btn rounded-pill text-white btn-sm" id="btn_user3">Kembali</a>
      </div>
    </div>
    <div class="table-responsive pb-3">
      <table id="table" class="table table-striped table-bordered display border mt-6 table-hover table-sm ">
      <thead class="text-white text-center align-middle">
        <tr>      
          <th>No</th>     
          <th>Kode Pembayaran</th>  
          <th>Kode Pemesanan</th>    
          <th>Nama Pembeli</th>             
          <th>No. Meja</th>           
          <th>Tanggal</th> 
          <th>Total</th>          
        </tr>
      </thead>
      <tbody  class="table-light text-center" id="tbody">
      <!-- Looping Table -->
        <?php $i = 1; ?>
        <?php foreach( $pembayaran as $row) : ?>
          <tr>
            <td class="col-sm-1"><?= $i++; ?></td>
            <td class="col-sm-2"><?= $row["kode_pembayaran"] ?></td>
            <td class="col-sm-2"><?= $row["kode_pemesanan"] ?></td>
            <td class="col-sm-2"><?= $row["nama_pembeli"] ?></td>
            <td class="col-sm-1"><?= $row["no_meja"] ?></td>
            <td class="col-sm-2"><?= $row["tanggal_pembayaran"] ?></td>                   
            <td class="col-sm-2"><?= rupiah($row["total"]); ?></td>      
          </tr>
        <?php endforeach ?>
      </tbody>
      <script>
        $(document).ready(function(){
        $('#table').DataTable();});
    </script>
      </table>
      <h6 class="mt-2 mb-2 text-danger fst-italic">*Daftar semua pemesanan yang sudah melakukan pembayaran</h6>
      </div> 
    </div>
    </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
  </body>
</html>
