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

// Menampilkan data 
$pemesanan = query("SELECT * FROM data_pemesanan WHERE keterangan='Selesai'");

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
<div class="container">
  <div class="row justify-content-center">
    <div class="col-lg-6">
    <div id="top">
      <h2 class="pt-5 text-center" id="sub_judul4">Kasir Restoran</h2>
      <?php foreach( $pengguna as $row) : ?>
        <h6 class="mb-4 text-center" style="color: var(--brand); text-shadow: 1px 1px white;">Selamat Datang <?= $row["nama"] ?></h6>
      <?php endforeach; ?>
    </div>
      <div class="row row-cols-1 row-cols-md-2 row-cols-sm-2 g-1">
        <div class="col" id="left">
          <a href="../index.php" target="blank_" class="nav-link" id="icon_zoom">
          <div class="card">
            <img src="../img/menu_homee.png" class="card-img" alt="..." style="box-shadow: 0px 0px 10px 5px var(--brand2)">
          </div>
          </a>
        </div>
        <div class="col" id="right">
          <a href="" class="nav-link" id="icon_zoom" data-bs-toggle="modal" data-bs-target="#profil">
          <div class="card">
            <img src="../img/menu_profill.png" class="card-img" alt="..." style="box-shadow: 0px 0px 10px 5px var(--brand2)">
          </div>
          </a>
        </div>
        <div class="col" id="left">
          <a href="" class="nav-link" id="icon_zoom" data-bs-toggle="modal" data-bs-target="#pemesanan">
          <div class="card">
            <img src="../img/menu_pembayarann.png" class="card-img" alt="..." style="box-shadow: 0px 0px 10px 5px var(--brand2)">
          </div>
          </a>
        </div>
        <div class="col" id="right">
          <a href="riwayat.php" class="nav-link" id="icon_zoom">
          <div class="card">
            <img src="../img/menu_riwayat_pemesanann.png" class="card-img" alt="..." style="box-shadow: 0px 0px 10px 5px var(--brand2)">
          </div>
          </a>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal Profil -->
<div class="modal fade" id="profil" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header text-center" id="background_modal">
                <h5 class="modal-title" id="sub_judul5">Profil</h5>
                <a href="index.php" class="nav-link btn-close  btn-close-white ms-auto" aria-label="Close"></a>
              </div>
              <div class="mb-3 mt-3 ms-3 me-3">
              <div class="row">
                <!-- Kolom 1 -->
                <div class="col-lg-4 col-md-12 col-sm-12 col-12">
                <div class="text-center">
                <div class="card mt-2 mb-2" style="background-color: var(--brand3);">
                  <img src="../img/profil/<?php echo $row['foto'];?>" style="width: 100%;" alt="Foto Profil" class="img-fluid p-2 rounded">
                </div>
                  <div class="d-grid gap-2 mt-3 mb-1">   
                  <button type="button" onclick="logout_2()" id="btn_user3" class="btn rounded-pill btn-sm text-white">Logout</button>
                  </div>
                </div>
                </div>
                <!-- Kolom 2 -->
                <div class="col-lg-8 col-md-12 col-sm-12 col-12">
                <div class="row pt-2">
                  <div class="col-lg-6">
                  <div class="mb-3">
                    <label for="disabledSelect" class="form-label ms-1">Nama</label>
                    <input type="text" class="form-control rounded-pill" readonly id="bg-readonly" value="<?php echo $row['nama']; ?>">
                  </div>   
                  <div class="mb-3">
                    <label for="disabledSelect" class="form-label ms-1">Nomor Telpon</label>
                    <input type="text" class="form-control rounded-pill" readonly id="bg-readonly" value="<?php echo $row['no_telp']; ?>">
                  </div>
                  <div class="mb-3">
                    <label for="disabledSelect" class="form-label ms-1">Jenis Kelamin</label>
                    <input type="text" class="form-control rounded-pill" readonly id="bg-readonly" value="<?php echo $row['jenis_kelamin']; ?>">
                  </div>        
                  </div>
                  <div class="col-lg-6">
                  <div class="mb-3">
                    <label for="disabledSelect" class="form-label ms-1">Username</label>
                    <input type="text" class="form-control rounded-pill" readonly id="bg-readonly" value="<?php echo $row['username']; ?>">
                  </div>  
                  <div class="mb-3">
                    <label for="disabledSelect" class="form-label ms-1">Password</label>
                    <input type="password" class="form-control rounded-pill" readonly id="bg-readonly" value="12345">
                  </div>  
                  <div class="mb-3">
                    <label for="disabledSelect" class="form-label ms-1">Level</label>
                    <input type="text" class="form-control rounded-pill" readonly id="bg-readonly" value="<?php echo $row['level']; ?>">
                  </div>  
                  </div>
                </div> 
                <div class="mb-2">
                  <label for="disabledSelect" class="form-label ms-1">Alamat</label>
                  <textarea class="form-control" readonly id="bg-readonly" rows="2"><?php echo $row['alamat']; ?></textarea>
                </div>  
                </div>
              </div>                
              </div>
              </div>
          </div>
        </div>
<!-- Modal Pemesanan -->
<div class="modal fade" id="pemesanan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header text-center" id="background_modal">
                <h5 class="modal-title" id="sub_judul5">Daftar Pembayaran</h5>
                <a href="index.php" class="nav-link btn-close  btn-close-white ms-auto" aria-label="Close"></a>
              </div>
              <div class="mb-3 mt-3 ms-3 me-3">
              <div class="table-responsive">
              <table id="table" class="table table-striped table-bordered display border mt-6 table-hover table-sm ">
              <thead class="text-white">
                <tr class="text-center">           
                  <th>No</th>
                  <th>Kode Pemesanan</th>
                  <th>No. Meja</th>
                  <th>Nama Pembeli</th>
                  <th>Tanggal</th>
                  <th>Keterangan</th>
                  <th>Aksi</th> 
                </tr>
              </thead>
              <tbody  class="table-light text-center" id="tbody">
              <!-- Looping Table -->
                <?php $i = 1; ?>
                <?php foreach( $pemesanan as $row) : ?>
                  <tr>
                  <td class="col-sm-1"><?= $i++; ?></td>
                  <td class="col-sm-2"><?= $row["kode_pemesanan"] ?></td>
                  <td class="col-sm-2"><?= $row["no_meja"] ?></td>
                  <td class="col-sm-3"><?= $row["nama_pembeli"] ?></td>
                  <td class="col-sm-3"><?= $row["tanggal_pemesanan"] ?></td>
                  <td class="col-sm-3"><?= $row["keterangan"] ?></td>
                  <td class="col-sm-1">
                  <div class="text-center">
                    <a href="kasir.php?kode_pemesanan=<?=$row["kode_pemesanan"];?>" class="btn btn-sm text-white rounded-pill" id="btn_user"><i class="bi bi-search"></i></a>
                  </td>                      
                  </tr>
                <?php endforeach ?>
              </tbody>
              <script>
                  $(document).ready(function(){
                  $('#table').DataTable();});
              </script>
              </table>
              <h6 class="mt-2 mb-2 text-danger fst-italic">*Daftar pembayaran diatas adalah semua daftar pemesanan dengan keterangan <b>Selesai</b></h6>
      
              </div> 
        
              </div>
              </div>
          </div>
        </div>

<!-- Script -->
<?php include '../kerangka/sweet_alert.php'; ?>

</body>
</html>
