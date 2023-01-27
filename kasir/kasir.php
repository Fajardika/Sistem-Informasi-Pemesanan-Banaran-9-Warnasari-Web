<?php
session_start();
require '../functions.php';
error_reporting(0);

// Cek Session?
if( !isset($_SESSION["login"])) {
  header("Location: ../login.php");
  exit;
}

// INT Ke Rupiah
function rupiah($angka){
	
	$hasil_rupiah = "Rp " . number_format($angka,2,',','.');
	return $hasil_rupiah;
 
}

// Random String
function randomString($length)
{
    $str        = "";
    $characters = '123456789';
    $max        = strlen($characters) - 1;
    for ($i = 0; $i < $length; $i++) {
        $rand = mt_rand(0, $max);
        $str .= $characters[$rand];
    }
    return $str;
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

if (isset($_SESSION["username"])){ 
  $username = $_SESSION['username'];
    // Menampilkan data pengguna sesuai dengan username yang ada
    $pengguna  = query("SELECT id,foto,nama,jenis_kelamin,no_telp,alamat,username,password,level FROM pengguna WHERE username = '$username'");

}

// Button Pembayaran
if(isset($_POST["pembayaran"])){
  //cek data berhasil atau tidak
  if(pembayaran($_POST) > 0 ) {
    $pembayaran_berhasil = true;
  }else{
    $pembayaran_gagal = true;
  }
}

// Button hitung
if(isset($_POST["hitung"])){

  $total_pembayaran =htmlspecialchars($_POST['total']);
  $uang_cash        =htmlspecialchars($_POST['uang_cash']);
  $uang_kembalian   = $uang_cash - $total_pembayaran;
}

$kode_pemesanan   = $_GET["kode_pemesanan"];
$detail_pemesanan = query("SELECT * FROM detail_pesanan WHERE kode_pemesanan= '$kode_pemesanan'");
$data_pemesanan   = query("SELECT * FROM data_pemesanan WHERE kode_pemesanan= '$kode_pemesanan'");

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
<body>
<!-- Side Bar dan Konten -->
<div class="container-fluid">
  <div class="row" >
    <!-- Konten -->
    <div class="col-lg-8 col-md-7 col-sm-12 col-12 bg-light me-sm-auto order-lg-first order-md-first">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg border-bottom border-success bg-ligt" id="top">
    <div class="container-fluid">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <img src="../img/Logo_Banaran_Transparant.png" alt="LOGO" class="img-fluid ms-auto" width="15%">
    </div>
    </nav>

    <div id="print-area-2" class="print-area">
    <!-- Tabel Semua Pesanan Menu dan Harga -->
    <div class="card ps-3 pe-3 pt-3 mt-3" id="bottom">
    <h6 class="text-center pt-1" style="text-align:center;" id="sub_judul4">Nota Pembayaran<br>Restoran Banaran 9 Warnasari<br>Jl. Raya Banjar-Majenang Banjar Km.9 Ciawitali, Cilacap</h6>

    <div class="row border-top border-success me-1 ms-1">
    <div class="col-lg-6 mt-1">
    <div class="table-responsive">
    <table style="font-size: 13px;" class="table table-sm table-borderless">
      <tr>
        <td class="col-sm-5 col-5">Kode Pemesanan</td>
        <td class="col-sm-7 col-9">: <?php echo $kode_pemesanan; ?> </td>
      </tr>
      <?php foreach($data_pemesanan as $row) : ?>
      <tr>
        <td class="col-sm-5 col-5">Nomor Meja</td>
        <td class="col-sm-7 col-9">: <?php echo $row['no_meja']; ?></td>
      </tr>
      <tr>
        <td class="col-sm-5 col-5">Tanggal</td>
        <td class="col-sm-7 col-9">: <?php echo $row['tanggal_pemesanan']; ?></td>
      </tr>
      <?php endforeach ?> 
    </table>
    </div>      
    </div>
    </div>
    <div class="table-responsive">
    <table border="1" style="border-collapse: collapse; text-align:center; width: 100%;" class="table text-center table-bordered display border mt-6 table-hover table-sm">
                <thead class="text-white">
                  <tr class="text-center">           
                    <th>No</th>
                    <th>Menu</th>
                    <th>Jumlah</th>
                    <th>Harga</th>
                    <th>Total</th>
                  </tr>
                </thead>
                <tbody  class="table-light text-center" id="tbody">
                <!-- Looping Table -->
                  <?php $i = 1; ?>
                  <?php foreach($detail_pemesanan as $row) : ?>
                    <tr>
                      <td class="col-sm-1"><?= $i++; ?></td>
                      <td class="col-sm-3"><?= $row["nama_menu"] ?></td>
                      <td class="col-sm-2"><?= $row["jumlah"] ?></td>
                      <td class="col-sm-3" style="text-align: left;"><?= rupiah($row["harga"]); ?></td>   
                      <td class="col-sm-3" style="text-align: left;"><?= rupiah($harga[] = $row['jumlah']*$row["harga"]); ?></td>                  
                    </tr>
                  <?php endforeach ?>
                    <tr>
                      <td colspan="4"><b>Total Keseluruhan</b></td>
                      <?php $total = array_sum($harga);  ?>
                      <td style="text-align: left;"><b><?php echo rupiah($total); ?></b></td>
                    </tr>
                </tbody>
                </table>
    </div> 
    <div class="row justify-content-end"  style="float: right;">
    <div class="col-lg-4 mt-3">
    <div class="table-responsive">
    <table  style="font-size: 13px; text-align: center;" class="table text-center table-sm table-borderless">
      <tr>
        <td>Ciawitali, <?php echo date("m-d-Y"); ?></td>
      </tr>
      <tr>
        <td></td>
      </tr>
      <tr>
        <td></td>
      </tr>
      <tr>
        <td></td>
      </tr>
      <tr>
      <?php foreach( $pengguna as $row) : ?>
        <td><u><b><?= $row["nama"] ?></b></u></td>
      <?php endforeach; ?>
      </tr>
    </table>
    </div>      
    </div>
    </div>
    </div>
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
        <td class="col-sm-5 col-5">Kode Pemesanan</td>
        <td class="col-sm-7 col-9">: <?php echo $kode_pemesanan; ?> </td>
      </tr>
      <?php foreach( $data_pemesanan as $row) : ?>
      <tr>
        <td class="col-sm-5 col-5">Nama Pelayan</td>
        <td class="col-sm-7 col-9">: <?php echo $row['nama']; ?> </td>
      </tr>
      <tr>
        <td class="col-sm-5 col-5">Nama Pembeli</td>
        <td class="col-sm-7 col-9">: <?php echo $row['nama_pembeli']; ?></td>
      </tr>
      <tr>
        <td class="col-sm-5 col-5">Nomor Meja</td>
        <td class="col-sm-7 col-9">: <?php echo $row['no_meja']; ?></td>
      </tr>
      <tr>
        <td class="col-sm-5 col-5">Tanggal</td>
        <td class="col-sm-7 col-9">: <?php echo $row['tanggal_pemesanan']; ?></td>
      </tr>
      <?php endforeach ?> 
    </table>
    </div>
    </div>
    </div>

    <div class="card mt-2 mb-2" id="right">
    <div class="card-body">
    <h5 class="text-center pt-1 pb-2" id="sub_judul4">Pembayaran</h5>
    <!-- Form Kalkulator -->
    <form action="" method="POST">
    <div class="input-group mb-3" >
      <form action="" method="POST">      
        <input type="hidden" class="form-control rounded-pill" name="total" required value="<?php echo "$total"; ?>">
        <input type="text" style="border-radius: 50px 0px 0px 50px;" name="uang_cash" required class="form-control" autocomplete="off" title="Hanya Bisa Angka. Contoh 100000" pattern="[0-9]+" placeholder="Nominal Uang Cash">
        <button type="submit" name="hitung" style="border-radius: 0px 50px 50px 0px;" class="btn text-white btn-md" id="btn_user"><i class="bi bi-file-spreadsheet"></i> Hitung</button>                    
      </form>
    </div>
    
    <div class="table-responsive">
    <table class="table table-sm border-light">
      <tr>
        <td class="col-sm-5 col-5">Total Pembayaran</td>
        <td class="col-sm-7 col-9">: <?php echo rupiah($total); ?> </td>
      </tr>
      <tr>
        <td class="col-sm-5 col-5">Uang Cash</td>
        <td class="col-sm-7 col-9">: <?php echo rupiah($uang_cash); ?></td>
      </tr>
      <tr>
        <td class="col-sm-5 col-5">Uang Kembalian</td>
        <td class="col-sm-7 col-9">: <?php echo rupiah($uang_kembalian); ?></td>
      </tr>
    </table>
    </div>  

    <div class="d-grid mb-2">
        <a href="javascript:printDiv('print-area-2');" id="btn_user2" class="btn text-white rounded-pill btn-md">Cetak Nota</a>                    
    </div>
    </form>


    <!-- Form Simpan Data -->
    <form action="" method="POST">
      <input type="hidden" class="form-control rounded-pill" name="kode_pemesanan" required value="<?php echo $kode_pemesanan; ?>">
      <input type="hidden" class="form-control rounded-pill" name="total" required value="<?php echo "$total"; ?>">
      <input type="hidden" class="form-control" name="tanggal_pembayaran" value="<?php date_default_timezone_set('Asia/Jakarta'); echo date('Y-m-d H:i:s'); ?>">
    <div class="d-grid mb-2">
        <button type="submit" name="pembayaran" class="btn text-white rounded-pill btn-md" id="btn_user">Selesai</button>       
        <a href="index.php" id="btn_user3" class="btn text-white rounded-pill btn-md mt-2">Kembali</a>                   
    </div>   
    </form>
    </div>
    </div>

    </div>
    </div>
  </div>
</div>

<iframe id="printing-frame" name="print_frame" src="about:blank" style="display:none;"></iframe>
<script>
function printDiv(elementId) {
    var a = "/path/to/printing-css.css";
    var b = document.getElementById(elementId).innerHTML;
    window.frames["print_frame"].document.title = document.title;
    window.frames["print_frame"].document.body.innerHTML = '<link rel="stylesheet" href="' + a + '">' + b;
    window.frames["print_frame"].window.focus();
    window.frames["print_frame"].window.print();
}
</script>

<!-- Script -->
<?php include '../kerangka/sweet_alert.php'; ?>

<?php   
    // Jika variabel tambah menu berhasil memiliki nilai
    if(isset($pembayaran_berhasil)) {
      echo "<script> pembayaran_berhasil(); </script>";
    }else if(isset($pembayaran_gagal)){
      echo "<script> pembayaran_gagal(); </script>";
    }else{
      exit;
    };
?>

</body>
</html>
