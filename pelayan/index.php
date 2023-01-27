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

// Session membawa username pada saat login
if (isset($_SESSION["username"])){ 
  $username = $_SESSION['username'];
    // Menampilkan data pengguna sesuai dengan username yang ada
    $pengguna  = query("SELECT id,foto,nama,jenis_kelamin,no_telp,alamat,username,password,level FROM pengguna WHERE username = '$username'");
}

// Button Tambah Pemesanan
if(isset($_POST["pemesanan"])){
  $kode_pemesanan   = randomString(10);
  $id_pelayan       = htmlspecialchars($_POST["id"]);
  $no_meja          = htmlspecialchars($_POST["no_meja"]);
  $nama_pembeli     = htmlspecialchars($_POST["nama_pembeli"]);
  $tgl_pemesanan    = htmlspecialchars($_POST["tgl_pemesanan"]);   

  $query="INSERT INTO pemesanan (kode_pemesanan, id_pelayan, no_meja, nama_pembeli, tanggal_pemesanan, catatan, keterangan) values('$kode_pemesanan','$id_pelayan','$no_meja','$nama_pembeli', '$tgl_pemesanan', '', 'Pending')";
  mysqli_query($conn, $query);
  $_SESSION['kode_pemesanan']   = $kode_pemesanan;
  header("Location: pemesanan.php");
}

//Kode Acak
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

<body class="background_menu">
<div class="container">
  <div class="row justify-content-center">
    <div class="col-lg-6">
    <div id="top">
      <h2 class="pt-5 text-center" id="sub_judul2">Pelayan Restoran</h2>
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
          <img src="../img/menu_pemesanann.png" class="card-img" alt="..." style="box-shadow: 0px 0px 10px 5px var(--brand2)">
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
                  <button type="button" onclick="logout_2()" class="btn rounded-pill btn-sm text-white" id="btn_user3">Logout</button>
                  </div>
                </div>
                </div>
                <!-- Kolom 2 -->
                <div class="col-lg-8 col-md-12 col-sm-12 col-12">
                <div class="row pt-2">
                  <div class="col-lg-6">
                  <div class="mb-3">
                    <label for="disabledSelect" class="form-label ms-1">Nama</label>
                    <input type="text" class="form-control rounded-pill" id="bg-readonly"  readonly value="<?php echo $row['nama']; ?>">
                  </div>   
                  <div class="mb-3">
                    <label for="disabledSelect" class="form-label ms-1">Nomor Telpon</label>
                    <input type="text" class="form-control rounded-pill" id="bg-readonly"  readonly value="<?php echo $row['no_telp']; ?>">
                  </div>
                  <div class="mb-3">
                    <label for="disabledSelect" class="form-label ms-1">Jenis Kelamin</label>
                    <input type="text" class="form-control rounded-pill" id="bg-readonly"  readonly value="<?php echo $row['jenis_kelamin']; ?>">
                  </div>     
                  </div>
                  <div class="col-lg-6">
                  <div class="mb-3">
                    <label for="disabledSelect" class="form-label ms-1">Username</label>
                    <input type="text" class="form-control rounded-pill" id="bg-readonly" readonly value="<?php echo $row['username']; ?>">
                  </div>  
                  <div class="mb-3">
                    <label for="disabledSelect" class="form-label ms-1">Password</label>
                    <input type="password" class="form-control rounded-pill" id="bg-readonly"  readonly value="12345">
                  </div>  
                  <div class="mb-3">
                    <label for="disabledSelect" class="form-label ms-1">Level</label>
                    <input type="text" class="form-control rounded-pill" id="bg-readonly"  readonly value="<?php echo $row['level']; ?>">
                  </div>  
                  </div>
                </div> 
                <div class="mb-2">
                  <label for="disabledSelect" class="form-label ms-1">Alamat</label>
                  <textarea class="form-control" id="bg-readonly" readonly rows="2"><?php echo $row['alamat']; ?></textarea>
                </div>  
                </div>
              </div>                
              </div>
              </div>
          </div>
        </div>

<!-- Modal Pemesanan -->
<div class="modal fade" id="pemesanan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header text-center" id="background_modal">
                <h5 class="modal-title" id="sub_judul5">Pemesanan Menu</h5>
                <a href="index.php" class="nav-link btn-close  btn-close-white ms-auto" aria-label="Close"></a>
              </div>
              <div class="mb-3 mt-3 ms-3 me-3">
              <form action="" method="post">
              <input type="hidden" class="form-control" name="id" value="<?php echo $row['id'] ?>"> 
              <input type="hidden" class="form-control" name="tgl_pemesanan" value="<?php date_default_timezone_set('Asia/Jakarta'); echo date('Y-m-d H:i:s'); ?>">
                  <div class="mb-3">
                    <label for="disabledSelect" class="form-label ms-1">Nama Pelayan</label>
                    <input type="text" class="form-control rounded-pill" readonly id="bg-readonly" name="nama_pelayan" value="<?php echo $row['nama']; ?>">
                  </div>  
                  <div class="mb-3">
                    <label for="disabledSelect" class="form-label ms-1">Tanggal Pemesanan</label>
                    <input type="text" class="form-control rounded-pill" readonly id="bg-readonly" name="tgl_pemesanan" value="<?php date_default_timezone_set('Asia/Jakarta'); echo date('Y-m-d H:i:s'); ?>">
                  </div> 
                  <div class="mb-3">
                    <label for="disabledSelect" class="form-label ms-1">Nama Pembeli</label>
                    <input type="text" class="form-control rounded-pill" name="nama_pembeli" required autofocus autocomplete="off" title="Hanya Bisa Huruf dan Angka" pattern="[A-Za-z0-9 ]+" placeholder="Masukan Nama Pembeli">
                  </div> 
                  <div class="mb-3">
                    <label for="disabledSelect" class="form-label ms-1">Nomor Meja</label>
                    <select class="form-select rounded-pill mt-1" name="no_meja" aria-label="Default select example">
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
                      <option value="11">11</option>
                      <option value="12">12</option>
                      <option value="13">13</option>
                      <option value="14">14</option>
                      <option value="15">15</option>
                      <option value="16">16</option>
                      <option value="17">17</option>
                      <option value="18">18</option>
                      <option value="19">19</option>
                      <option value="20">20</option>
                      <option value="21">21</option>
                      <option value="22">22</option>
                      <option value="23">23</option>
                      <option value="24">24</option>
                      <option value="25">25</option>
                    </select>
                  </div>
                  <div class="d-grid gap-2">
                      <button type="submit" name="pemesanan" class="btn text-white rounded-pill mt-3 mb-1" id="btn_user">Membuat Pesanan</button>                    
                  </div>                
              </form>
              </div>
              </div>
          </div>
        </div>

<!-- Script -->
<?php include '../kerangka/sweet_alert.php'; ?>

</body>
</html>
