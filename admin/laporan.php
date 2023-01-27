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


// INT Ke Rupiah
function rupiah($angka){
	
	$hasil_rupiah = "Rp " . number_format($angka,2,',','.');
	return $hasil_rupiah;
 
}

// Menampilkan data 
$laporan = query("SELECT * FROM data_laporan");


// Menampilkan laporan
if(isset($_POST['submit'])){
    $bulan = $_POST['bulan'];
    $tahun = $_POST['tahun'];
    $laporan = query("SELECT * FROM data_laporan WHERE month(tanggal)='$bulan' AND year(tanggal)='$tahun' ORDER BY tanggal ASC");
    if($bulan == 1){
      $bulan = 'Januari';
    }else if($bulan == 2){
      $bulan = 'Februari';
    }else if($bulan == 3){
      $bulan = 'Maret';
    }else if($bulan == 4){
      $bulan = 'April';
    }else if($bulan == 5){
      $bulan = 'Meni';
    }else if($bulan == 6){
      $bulan = 'Juni';
    }else if($bulan == 7){
      $bulan = 'Juli';
    }else if($bulan == 8){
      $bulan = 'Agustus';
    }else if($bulan == 9){
      $bulan = 'September';
    }else if($bulan == 10){
      $bulan = 'Oktober';
    }else if($bulan == 11){
      $bulan = 'November';
    }else if($bulan == 12){
      $bulan = 'Desember';
    }
}else{
    $laporan = query("SELECT * FROM data_laporan ORDER BY tanggal ASC");
}

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
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light shadow sidebar1 collapse position-fixed">
    <img src="../img/Logo_Banaran_Transparant.png" class="img-fluid mt-3" alt="Logo Banaran" width="100%" id="left">
      <div class="position-sticky pt-3 sidebar1-sticky">
        <ul class="nav flex-column" id="left">
          <li class="nav-item">
            <a class="nav-link" href="index.php" id="gambar1"><i class="bi bi-house"></i> Dashboard</a>
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
            <a class="nav-link active" href="laporan.php" id="gambar1"><i class="bi bi-clipboard-data"></i> Laporan</a>
          </li>          
        </ul>
      </div>
    </nav>

    <!-- Konten -->
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="border-bottom border-success">
      <div class="row">
        <div class="col-lg-6">
        <!-- Pencarian Data Laporan Sesuai Bulan dan Tahun -->
        <form action="" method="post">
            <div class="input-group input-group-sm pt-1 pb-3" id="left">    
                <span class="input-group-text" style="border-radius: 50px 0px 0px 50px;">Bulan</span>
                <select class="form-select" name="bulan" aria-label="Default select example">
                    <option value="01">Januari</option>
                    <option value="02">Februari</option>
                    <option value="03">Maret</option>
                    <option value="04">April</option>
                    <option value="05">Mei</option>
                    <option value="06">Juni</option>
                    <option value="07">Juli</option>
                    <option value="08">Agustus</option>
                    <option value="09">September</option>
                    <option value="10">Oktober</option>
                    <option value="11">November</option>
                    <option value="12">Desember</option>
                </select>
                <span class="input-group-text">Tahun</span>
                <select class="form-select" name="tahun" aria-label="Default select example" aria-placeholder="a">
                    <option value="2020">2020</option>
                    <option value="2021">2021</option>
                    <option value="2022">2022</option>
                    <option value="2023">2023</option>
                    <option value="2024">2024</option>
                    <option value="2025">2025</option>
                    <option value="2026">2026</option>
                    <option value="2027">2027</option>
                    <option value="2028">2028</option>
                    <option value="2029">2029</option>
                    <option value="2030">2030</option>
                </select>
              
              <button type="submit" name="submit" class="btn text-white ps-3 pe-3" id="btn_user" style="border-radius: 0px 50px 50px 0px;"><i class="bi bi-search"></i> Cari</button>
            </div>
        </form>
        </div>
        <div class="col-lg-6 text-end">
        <div class="btn-group pt-1 pb-3" id="right">
              <a href="laporan.php" class="btn text-white btn-sm" id="btn_user2" style="border-radius: 50px 0px 0px 50px;"><i class="bi bi-arrow-counterclockwise pe-1"></i> Tampilkan Semua Data</a> 
              <a href="javascript:printDiv('print-area-2');" class="btn text-white btn-sm" id="btn_user3" style="border-radius: 0px 50px 50px 0px;"><i class="bi bi-printer pe-1"></i> Cetak Laporan</a>   
        </div>
        </div>
      </div>
    </div>
    


    <div class="table-responsive mt-3 pb-3">
    <div id="print-area-2" class="print-area" style="text-align:center;">
    <h4 id="sub_judul4" style="text-align:center;" class="text-center">Laporan Pendapatan <span id="sub_judul2"><?php echo $bulan; echo ' '.$tahun; ?></span></h4>
    <table border="1" style="border-collapse: collapse; text-align:center;" class="table text-center table-bordered display border mt-6 table-hover table-sm">
    <thead class="text-center">
      <tr>           
        <th>No</th>
        <th>Kode Pembayaran</th>
        <th>Kode Pemesanan</th>
        <th>Pelayan</th> 
        <th>Pembeli</th> 
        <th>No. Meja</th>
        <th>Tanggal Pembayaran</th>
        <th>Total</th>
      </tr>
    </thead>
    <tbody  class="table-light text-center" id="tbody">
    <!-- Looping Table -->
      <?php $i = 1; ?>
      <?php foreach( $laporan as $row) : ?>
        <tr>
        <td class="col-sm-1"><?= $i++; ?></td>
        <td class="col-sm-1"><?= $row["kode_pembayaran"] ?></td>
        <td class="col-sm-1"><?= $row["kode_pemesanan"] ?></td>
        <td class="col-sm-2"><?= $row["nama"] ?></td>
        <td class="col-sm-2"><?= $row["nama_pembeli"] ?></td>
        <td class="col-sm-1"><?= $row["no_meja"] ?></td>
        <td class="col-sm-2"><?= $row["tanggal"] ?></td>
        <td class="col-sm-2" style="text-align:left;"><?= rupiah($total[] = $row["total"]); ?></td>                      
        </tr>
      <?php endforeach ?>
      <tr class="fw-bold">
        <th colspan="7" style="text-align:center;">Total Keseluruhan</th>
        <?php $total_seluruh = array_sum($total);  ?>
        <th style="text-align:left;"> <?php echo rupiah($total_seluruh); ?></th>
      </tr>
    </tbody>
    </table>
    </div> 
    </div>
    </main>
  </div>
</div>

<iframe id="printing-frame" name="print_frame" src="about:blank" style="display:none;"></iframe>
<script>

function printDiv(elementId) {
    var a = "/path/to/printing-css.css";
    var b = document.getElementById(elementId).innerHTML;
    window.frames["print_frame"].document.title = document.title;
    window.frames["print_frame"].
    document.body.innerHTML = '<link rel="stylesheet" href="' + a + '">' + b;
    window.frames["print_frame"].window.focus();
    window.frames["print_frame"].window.print();
}
</script>

<!-- Script -->
<?php include '../kerangka/sweet_alert.php'; ?>

  </body>
</html>
