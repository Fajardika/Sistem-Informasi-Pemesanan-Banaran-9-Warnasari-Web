<?php
session_start();
require '../functions.php';
error_reporting(0);

// Cek Session?
if( !isset($_SESSION["login"])) {
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

// Button Hapus
if(isset($_POST["hapus"]) > 0){
  //cek data berhasil atau tidak
  if(hapus_pemesanan($_POST) > 0 ) {
    $hapus_pemesanan_berhasil = true;
  }else{
    $hapus_pemesanan_gagal = true;
}
}

// Menampilkan data 
$pemesanan = query("SELECT * FROM data_pemesanan");
$detail_pemesanan = query("SELECT * FROM detail_pesanan");


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
            <a class="nav-link active" href="pemesanan.php" id="gambar1"><i class="bi bi-journal-text"></i> Pemesanan</a>
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
    <div class="border-bottom border-success">
      <div id="top">
        <h4 class="text-center" id="sub_judul4">Pemesanan</h4>
      </div>
    </div>
    <div class="table-responsive mt-3 pb-3">
    <table id="table" class="table table-striped table-bordered display border mt-6 table-hover table-sm ">
    <thead class="text-center">
      <tr>           
        <th>No</th>
        <th>Kode Pemesanan</th>
        <th>Pelayan</th>
        <th>Pembeli</th>
        <th>No. Meja</th> 
        <th>Catatan</th>
        <th>Keterangan</th>
        <th>Tanggal</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody  class="table-light text-center" id="tbody">
    <!-- Looping Table -->
      <?php $i = 1; ?>
      <?php foreach( $pemesanan as $row) : ?>
        <tr>
        <td class="col-sm-1"><?= $i++; ?></td>
        <td class="col-sm-1"><?= $row["kode_pemesanan"] ?></td>
        <td class="col-sm-2"><?= $row["nama"] ?></td>
        <td class="col-sm-2"><?= $row["nama_pembeli"] ?></td>
        <td class="col-sm-1"><?= $row["no_meja"] ?></td>
        <td class="col-sm-2"><?= $row["catatan"] ?></td>
        <td class="col-sm-1"><?= $row["keterangan"] ?></td>
        <td class="col-sm-1"><?= $row["tanggal_pemesanan"] ?></td>
        <td class="col-sm-1">
        <div class="text-center">
          <a href="detail_pemesanan.php?kode_pemesanan=<?=$row['kode_pemesanan'];?>" class="btn btn-sm rounded-pill text-white" id="btn_user"><i class="bi bi-search"></i></a>
          <a href="" class="btn btn-sm rounded-pill text-white" id="btn_user3" data-bs-toggle="modal" data-bs-target="#hapus<?php echo $row['kode_pemesanan']; ?>"><i class="bi bi-trash"></i></a>
        </td>                      
        </tr>

        <!-- Modal Hapus -->
        <div class="modal fade" id="hapus<?php echo $row['kode_pemesanan']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header text-center" id="background_modal">
                <h5 class="modal-title" id="sub_judul5">Hapus Pemesanan</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="mb-4 ms-3 me-3 text-center">
              <form action="" method="post"  enctype="multipart/form-data"> 
                <img src="../img/icon_warning.png" class="img-fluid w-25 mb-3" id="gambar_effect" alt="Warning">
                <input type="hidden" class="form-control rounded-pill" name="kode_pemesanan"  value="<?= $row["kode_pemesanan"] ?>">
                <P>Anda Yakin Akan Menghapus Pemesanan Dengan Kode Pemesanan <b><?= $row["kode_pemesanan"] ?></b>?
                <div class="d-grid gap-2">
                  <button type="submit" name="hapus" id="btn_user3" class="btn text-white rounded-pill">Hapus</button>                    
                </div>
              </form>
              </div>
              </div>
          </div>
        </div>
      <?php endforeach ?>
    </tbody>
    <script>
        $(document).ready(function(){
        $('#table').DataTable();});
    </script>
    </table>
    <h6 class="mt-2 mb-2 text-danger fst-italic">*Data pemesanan diatas adalah data semua pemesanan dengan keterangan pemesanan <b>(Pending, Proses, Selesai, Lunas)</b></h6>
    </div> 
    </main>
  </div>
</div>

<!-- Script -->
<?php include '../kerangka/sweet_alert.php'; ?>

<?php   
    if(isset($hapus_pemesanan_berhasil)) {
      echo "<script> hapus_pemesanan_berhasil(); </script>";
    }else if(isset($hapus_pemesanan_gagal)) {
      echo "<script> hapus_pemesanan_gagal(); </script>";
    }else{
      exit;
    };
?>
</body>
</html>
