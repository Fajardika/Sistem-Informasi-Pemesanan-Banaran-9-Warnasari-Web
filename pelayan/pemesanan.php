<?php
session_start();
require '../functions.php';
error_reporting(0);

// Cek Session?
if( !isset($_SESSION["login"])) {
  header("Location: ../login.php");
  exit;
}

//mengecek level yang login
if(isset($_SESSION["level"] )) {
  $level = $_SESSION['level'];
  $level1   = 'Admin';
  $level2   = 'Pelayan';
  $level3   = 'Kasir';
  $level4   = 'Chef';
  $level5   = 'Pelanggan';
  if($level != $level2){
    if($level == $level1){
      header("Location: ../admin/index.php");
    }else if($level == $level3){
      header("Location: ../kasir/index.php");
    }else if($level == $level4){
      header("Location: ../koki/index.php");
    }else if($level == $level5){
      header("Location: ../dashboard.php");
    }else{
      header("Location: ../index.php");
    }
  }
}

if (isset($_SESSION["kode_pemesanan"])){ 
  $kode_pemesanan   = $_SESSION['kode_pemesanan'];
  $pemesanan        = query("SELECT * FROM data_pemesanan WHERE kode_pemesanan='$kode_pemesanan';");
  $detail_pemesanan = query("SELECT * FROM detail_pesanan WHERE kode_pemesanan='$kode_pemesanan';");
  
}

if(isset($_POST["simpan_detail"])){
  $kode_pemesanan         = htmlspecialchars($_POST["kode_pemesanan"]);
  $kode_menu              = htmlspecialchars($_POST["kode_menu"]);
  $jumlah                 = htmlspecialchars($_POST["jumlah"]);

  $query="INSERT INTO detail_pemesanan (kode_detail_pemesanan, kode_pemesanan, kode_menu, jumlah) values('','$kode_pemesanan','$kode_menu','$jumlah')";
  mysqli_query($conn, $query);
  $_SESSION['kode_pemesanan']   = $kode_pemesanan;
  $menu_berhasil_ditambahkan = true;
}

// Hapus Detail Pemesanan
if(isset($_GET["kode_detail_pemesanan"])){

  $kode_detail_pemesanan = htmlspecialchars($_GET["kode_detail_pemesanan"]);
  
  $query="DELETE FROM detail_pemesanan WHERE kode_detail_pemesanan = $kode_detail_pemesanan";
  mysqli_query($conn, $query);
  $_SESSION['kode_pemesanan']   = $kode_pemesanan;
  $menu_berhasil_dihapus= true;
}

// Button Ganti Keterangan Pemesanan
if(isset($_POST["ganti_keterangan"]) > 0){
  //cek data berhasil atau tidak
  if(ganti_keterangan($_POST) > 0 ) {
    $pemesanan_berhasil_diproses = true;
  }else{
    $pemesanan_gagal_diproses = true;
  }
}

// Button hapus Pemesanan
if(isset($_POST["hapus_pemesanan"]) > 0){
  //cek data berhasil atau tidak
  if(hapus_pemesanan_pelayan($_POST) > 0 ) {
    $pemesanan_batal_berhasil = true;
   }else{
    $pemesanan_batal_gagal = true;}
}

// INT Ke Rupiah
function rupiah($angka){
	
	$hasil_rupiah = "Rp " . number_format($angka,2,',','.');
	return $hasil_rupiah;
 
}

$makanan   = query("SELECT * FROM menu_makanan ORDER BY nama_menu ASC");
$minuman   = query("SELECT * FROM menu_minuman ORDER BY nama_menu ASC");

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pelayan</title>
    <link rel="shortcut icon" href="../img/title.png">
    <?php include '../kerangka/head.php'; ?>
</head>
<body>
<!-- Side Bar dan Konten -->
<div class="container-fluid">
  <div class="row">
    <!-- Konten Menu -->
    <div class="col-lg-8 col-md-7 col-sm-6 col-12 me-sm-auto bg-light order-lg-first order-md-first order-sm-first">
    <!-- Navbar Konten Menu -->
    <nav class="navbar navbar-expand-lg border-bottom border-success">
    <div class="container-fluid text-center justify-content-center">
      <button class="navbar-toggler navbar-light" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
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
    
  <div class="menu-sticky">
  <div class="tab-content" id="nav-tabContent">
  <div class="tab-pane fade show active" id="nav-makanan" role="tabpanel" aria-labelledby="nav-makanan-tab" tabindex="0">
  <!-- Makanan -->
  <div class="container-fluid">
  <div class="row pb-2 pt-3 row-cols-lg-4 row-cols-md-3 row-cols-sm-2 row-cols-2 g-0">

  <?php foreach( $makanan as $row) : ?>
    <section>    
    <form action="" method="post">
    <div class="col">
        <div class="card h-100 mb-3 text-center">
        <input type="hidden" class="form-control" name="kode_menu" value="<?php echo $row['kode_menu'] ?>">
        <input type="hidden" class="form-control" name="kode_pemesanan" value="<?php echo $kode_pemesanan; ?>"> 
          <img src="../img/foto/<?php echo $row['foto']; ?>" class="card-img-top" alt="...">
          <div class="row justify-content-end">
              <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                  <select class="form-select text-dark form-select-sm" name="jumlah">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                  </select>
              </div>
            </div>
          <div class="card-body">
              <h6 class="fw-bold"><?php echo $row['nama_menu']; ?></h6>
              <h6 class="text-danger fw-bold"><?php echo rupiah($row['harga']); ?></h6>
              <div class="d-grid gap-2">
              <button type="submit" name="simpan_detail" class="btn btn-sm rounded-pill text-white" id="btn_user">Pesan</button>
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
  
  <div class="tab-pane fade" id="nav-minuman" role="tabpanel" aria-labelledby="nav-minuman-tab" tabindex="0">
  <!-- Minuman -->
  <div class="container-fluid">
  <div class="row pb-2 pt-3 row-cols-lg-4 row-cols-md-3 row-cols-sm-2 row-cols-2 g-0">
  <?php foreach( $minuman as $row) : ?>
  <section>
    <form action="" method="post">
    <div class="col">
        <div class="card mb-3 h-100 text-center">
        <input type="hidden" class="form-control" name="kode_menu" value="<?php echo $row['kode_menu'] ?>">
        <input type="hidden" class="form-control" name="kode_pemesanan" value="<?php echo $kode_pemesanan; ?>"> 
          <img src="../img/foto/<?php echo $row['foto']; ?>" class="card-img-top" alt="...">
          <div class="row justify-content-end">
              <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                  <select class="form-select text-dark form-select-sm" name="jumlah">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                  </select>
              </div>
            </div>
          <div class="card-body">
              <h6 class="fw-bold"><?php echo $row['nama_menu']; ?></h6>
              <h6 class="text-danger fw-bold"><?php echo rupiah($row['harga']); ?></h6>
              <div class="d-grid gap-2">
              <button type="submit" name="simpan_detail" class="btn btn-sm rounded-pill text-white" id="btn_user">Pesan</button>
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
  </div>

    <!-- Side Bar -->
    <div id="sidebarMenu" class="col-lg-4 col-md-5 col-sm-6 col-12 order-first d-md-block d-sm-block d-block shadow sidebar collapse">
    <div class="position-sticky sidebar-sticky">
    <div class="card mt-3 mb-3">
    <div class="card-body">
    <h5 class="text-center pt-1 pb-1" id="sub_judul4">Daftar Pemesanan</h5>
    <!-- No Pesanan dan No Meja --> 
    <div class="table-responsive">
    <table class="table table-sm table-borderless">
      <tr>
        <td class="col-sm-5 col-4">Kode Pemesanan</td>
        <td class="col-sm-7 col-8">: <?php echo $kode_pemesanan; ?> </td>
      </tr>
      <?php foreach( $pemesanan as $row) : ?>
      <tr>
        <td class="col-sm-5 col-4">Nama Pelayan</td>
        <td class="col-sm-7 col-8">: <?php echo $row['nama']; ?> </td>
      </tr>
      <tr>
        <td class="col-sm-5 col-4">Nama Pembeli</td>
        <td class="col-sm-7 col-8">: <?php echo $row['nama_pembeli']; ?></td>
      </tr>
      <tr>
        <td class="col-sm-5 col-4">Nomor Meja</td>
        <td class="col-sm-7 col-8">: <?php echo $row['no_meja']; ?></td>
      </tr>
      <tr>
        <td class="col-sm-5 col-4">Tanggal</td>
        <td class="col-sm-7 col-8">: <?php echo $row['tanggal_pemesanan']; ?></td>
      </tr>
      <?php endforeach ?> 
    </table>
    </div>
    <!-- Table Pesanan -->
    <div class="table-responsive">
      <table class=" table table-bordered table-sm table-hover table-striped">
      <thead class="text-center">
        <th>No</th>
        <th>Menu</th>
        <th>Jumlah</th>
        <th>Batal</th>
      </thead>
      <tbody>
      <?php $i = 1; ?>
      <?php foreach( $detail_pemesanan as $row) : ?>
      <tr class="text-center"> 
        <input type="hidden" value="><?= $row["kode_detail_pemesanan"] ?>">
        <td class="col-sm-1"><?= $i++; ?></td>
        <td class="col-sm-9"><?= $row["nama_menu"] ?></td>
        <td class="col-sm-1"><?= $row["jumlah"] ?></td>
        <td class="col-sm-1">
        <div class="text-center">
          <a class="btn btn-sm text-white rounded-circle" id="btn_user3" href="pemesanan.php?kode_detail_pemesanan=<?=$row["kode_detail_pemesanan"];?>"><i class="bi bi-trash"></i></a>
        </div>
        </td> 
      </tr>
      <?php endforeach ?>
      </tbody>
      </table>
    </div>
    <!-- Button Edit Supaya Status Pemesanan Jadi Di Proses -->
    <form action="" method="POST">
    <input type="hidden" name="kode_pemesanan" value="<?php echo $kode_pemesanan; ?>">
    <input type="hidden" name="keterangan" value="Proses">
    <div class="mb-3">
      <label for="disabledSelect" class="form-label ms-1">Catatan Pesanan</label>
      <textarea class="form-control" name="catatan" required placeholder="Masukan Catatan Pemesanan" autocomplete="off" title="Hanya Bisa Huruf dan Angka" pattern="[A-Za-z0-9 .,]+" rows="3">-</textarea>
    </div>
    <div class="d-grid gap-1">
        <button type="submit" name="ganti_keterangan" class="btn btn-sm rounded-pill text-white" id="btn_user">Selesai</button>
    </div>
    </form>
    <!-- Button Hapus Pemesanan Yang Dibatalkan -->
    <form action="" method="POST">
    <input type="hidden" name="kode_pemesanan" value="<?php echo $kode_pemesanan; ?>">
    <div class="d-grid gap-1">
        <button type="submit" name="hapus_pemesanan" class="btn mt-2 btn-sm rounded-pill text-white" id="btn_user3">Batal</button>
    </div>    
    </form>
    </div>
    </div>

    </div>
    </div>
  
  </div>
</div>

<!-- Script -->
<?php include '../kerangka/search.php'; ?>
<!-- Script -->
<?php include '../kerangka/sweet_alert.php'; ?>

<?php   
    // Jika variabel tambah menu berhasil memiliki nilai
    if(isset($pemesanan_batal_berhasil)) {
      echo "<script> pemesanan_batal_berhasil(); </script>";
    }else if(isset($pemesanan_batal_gagal)){
      echo "<script> pemesanan_batal_gagal(); </script>";
    }else if(isset($pemesanan_berhasil_diproses )){
      echo "<script> pemesanan_berhasil_diproses(); </script>";
    }else if(isset($pemesanan_gagal_diproses)){
      echo "<script> pemesanan_gagal_diproses(); </script>";
    }
    
    else if(isset($menu_berhasil_ditambahkan )){
      echo "<script> menu_berhasil_ditambahkan(); </script>";
    }else if(isset($menu_berhasil_dihapus)){
      echo "<script> menu_berhasil_dihapus(); </script>";
    }else{
      exit;
    };
?>

</body>
</html>
