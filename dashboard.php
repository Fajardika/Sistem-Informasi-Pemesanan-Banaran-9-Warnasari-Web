<?php
session_start();
require 'functions.php';
error_reporting(0);

// Cek Session?
if(!isset($_SESSION["login"])) {
  header("Location: login.php");
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
  if($level != $level5){
    if($level == $level3){
      header("Location: kasir/index.php");
    }else if($level == $level4){
      header("Location: koki/index.php");
    }else if($level == $level2){
      header("Location: pelayan/index.php");
    }else if($level == $level1){
      header("Location: admin/index.php");
    }else{
      header("Location: dashboard.php");
    }
  }
}

if (isset($_SESSION["username"])){ 
  $username = $_SESSION['username'];
    // Menampilkan data sesuai dengan username yang login
    $pengguna  = query("SELECT id,foto,nama,jenis_kelamin,no_telp,alamat,username,password,level FROM pengguna WHERE username = '$username'");
    $data_pemesanan = query("SELECT * FROM data_pemesanan WHERE username='$username'");
    $makanan   = query("SELECT * FROM data_favorit WHERE nama_kategori='makanan' AND username='$username' ORDER BY nama_menu ASC");
    $minuman   = query("SELECT * FROM data_favorit WHERE nama_kategori='minuman' AND username='$username' ORDER BY nama_menu ASC");
}

// Button Ganti Foto
if(isset($_POST["ganti_foto"]) > 0){

  $id   = htmlspecialchars($_POST['id']);
   
  $fileName       = $_FILES['foto']['name'];
  $ukuran         = $_FILES['foto']['size'];
  $error          = $_FILES['foto']['error'];
  $tmpName        = $_FILES['foto']['tmp_name'];

  $ekstensi       = ['jpg', 'png', 'jpeg'];
  $ekstensiGambar = explode('.', $fileName);
  $ekstensiGambar = strtolower(end($ekstensiGambar));

  // Cek apakah yang di upload foto atau bukan
  if(!in_array($ekstensiGambar,$ekstensi) ) {
    $bukan_foto = true;
    
  }else{
    if($ukuran < 1000000){		
      $namaFileBaru  = uniqid();
      $namaFileBaru .= '.';
      $namaFileBaru .= $ekstensiGambar;

      move_uploaded_file($tmpName, 'e:/xampp/htdocs/Banaran/img/profil/'. $namaFileBaru);
      mysqli_query($conn, "UPDATE pengguna SET foto ='$namaFileBaru' WHERE id ='$id'");

      $ganti_foto_berhasil = true;
      
    }else{

      $ukuran_foto = true;

    }
  }
}


// INT Ke Rupiah
function rupiah($angka){
	$hasil_rupiah = "Rp " . number_format($angka,2,',','.');
	return $hasil_rupiah;
}

// Kode Acak
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

// Button Edit
if(isset($_POST["edit"])){
  //cek data berhasil atau tidak
  if(edit_pengguna_pelanggan($_POST) > 0 ) {
    $edit_pelanggan_berhasil = true;
  }else{
    $edit_pelanggan_gagal = true;
  }
}

// Button Ganti Password
if(isset($_POST["ganti_password"]) > 0){
  $id              = stripcslashes($_POST["id"]);
  $password        = mysqli_real_escape_string($conn, $_POST["password"]);
  $ulangi_password = mysqli_real_escape_string($conn, $_POST["ulangi_password"]);

  //konfirmasi password
  if ($password == $ulangi_password) {
    //enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    $query = "UPDATE pengguna SET password = '$password' WHERE id= $id";
    mysqli_query($conn, $query);

    $ganti_password_pelanggan_berhasil = true;

  }else{
    $konfirmasi_password_tidak_sesuai = true; 
  }
}

// Hapus Menu Favorit
if(isset($_POST["hapus_favorit"]) > 0){
  //cek data berhasil atau tidak
  if(hapus_favorit($_POST) > 0 ) {
    $hapus_menu_favorit_berhasil = true;
  }else{
    $hapus_menu_favorit_gagal = true;
  }
}

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>
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
          <a class="nav-link me-2 ms-2" aria-current="page" href="menu.php">Menu</a>
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
          <button type="button" class="btn dropdown-toggle text-white btn-sm mt-1 pb-1" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false" id="btn_user2">
            <i class="bi bi-person-circle"></i></i> User
          </button>
            <ul class="dropdown-menu dropdown-menu-lg-end">
              <li class="border-bottom border-success">
                <a class="nav-link" href="dashboard.php">Dashboard</a>
              </li>
              <li>
              <div class="d-grid gap-2 me-2 ms-2 mt-2"> 
                <button type="button" onclick="logout()" id="btn_user3" class="btn rounded-pill btn-sm text-white">Logout</button>
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

<div class="container-fluid pt-4" id="bawah_navbar">
  <div class="row">
  <!-- Profil -->
  <div class="col-lg-3 col-md-3 col-sm-12 col-12">
  <div class="card pe-3 ps-3 mb-3 bg-light">
  <?php foreach( $pengguna as $row) : ?>
  <div class="text-center">
    <div class="card mt-2 mb-2" style="background-color: var(--brand3);">
    <img src="img/profil/<?php echo $row['foto'];?>" style="width: 100%;" alt="Foto Profil" class="img-fluid p-2 rounded">
    </div>
    <p class="text-center">Hallo, Selamat Datang <i class="bi bi-emoji-smile"></i><br><b style="font-size: 18px"><?= $row["nama"] ?></b></p>
    <div class="d-grid gap-2">   
      <button class="btn btn-md p-2 text-white rounded-pill mb-4" id="btn_user" data-bs-toggle="modal" data-bs-target="#profil<?= $row["id"] ?>">Profil</button>       
  </div>
  </div>
        <!-- Modal Detail -->
        <div class="modal fade" id="profil<?= $row["id"] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header text-center" id="background_modal">
                <h5 class="modal-title" id="sub_judul5">Profil</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="mb-3 mt-3 ms-3 me-3">
              <form action="" method="post"> 
                <input type="hidden" class="form-control rounded-pill" name="id"  value="<?= $row["id"] ?>">
              <div class="row">
                <!-- Kolom 1 -->
                <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                <div class="text-center">
                  <div class="card p-2 mb-2">
                    <img src="img/profil/<?php echo $row['foto'];?>" style="width: 100%;" alt="Foto Profil" class="img-fluid rounded">
                    <a href=""  class="btn btn-md rounded-pill mt-2 text-white" id="btn_user" data-bs-toggle="modal" data-bs-target="#ganti_foto<?= $row["id"] ?>">Ganti Foto</a>    
                  </div>
                  <div class="d-grid gap-2 mt-3">   
                    <a href="" class="btn btn-md rounded-pill me-2 ms-2 text-white" id="btn_user2" data-bs-toggle="modal" data-bs-target="#edit_profil<?= $row["id"] ?>">Edit Profil</a>    
                    <a href=""  class="btn btn-md rounded-pill me-2 ms-2 text-white" id="btn_user3" data-bs-toggle="modal" data-bs-target="#ganti_password<?= $row["id"] ?>">Ganti Password</a>              
                  </div>
                </div>
                </div>
                <!-- Kolom 2 -->
                <div class="col-lg-8 col-md-8 col-sm-12 col-12">
                <div class="row">
                  <div class="col-lg-6">
                  <div class="mb-3">
                    <label for="disabledSelect" class="form-label ms-1">Nama</label>
                    <input type="text" class="form-control rounded-pill" id="bg-readonly" readonly value="<?= $row["nama"] ?>">
                  </div> 
                  <div class="mb-3">
                    <label for="disabledSelect" class="form-label ms-1">Jenis Kelamin</label>
                    <input type="text" class="form-control rounded-pill" id="bg-readonly" readonly value="<?= $row["jenis_kelamin"] ?>">
                  </div>    
                  <div class="mb-3">
                    <label for="disabledSelect" class="form-label ms-1">Nomor Telpon</label>
                    <input type="text" class="form-control rounded-pill" id="bg-readonly" readonly value="<?= $row["no_telp"] ?>">
                  </div>    
                  </div>
                  <div class="col-lg-6">
                  <div class="mb-3">
                    <label for="disabledSelect" class="form-label ms-1">Username</label>
                    <input type="text" class="form-control rounded-pill" id="bg-readonly" readonly value="<?= $row["username"] ?>">
                  </div>  
                  <div class="mb-3">
                    <label for="disabledSelect" class="form-label ms-1">Password</label>
                    <input type="password" class="form-control rounded-pill" id="bg-readonly" readonly value="123456789">
                  </div>  
                  <div class="mb-3">
                    <label for="disabledSelect" class="form-label ms-1">Level</label>
                    <input type="text" class="form-control rounded-pill" id="bg-readonly" readonly value="<?= $row["level"] ?>">
                  </div>  
                  </div>
                </div>
                  <label for="disabledSelect" class="form-label ms-1">Alamat</label>
                  <textarea class="form-control" id="bg-readonly" readonly rows="5"><?= $row["alamat"] ?></textarea>
                </div>
              </div>                
              </form>
              </div>
              </div>
          </div>
        </div>
        <!-- Modal Ganti Foto -->
        <div class="modal fade" id="ganti_foto<?= $row["id"] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header text-center" id="background_modal">
                <h5 class="modal-title" id="sub_judul5">Ganti Foto Profil</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="mb-3 mt-3 ms-3 me-3">
              <form action="" method="post" enctype="multipart/form-data"> 
                <input type="hidden" class="form-control rounded-pill" name="id"  value="<?= $row["id"] ?>">
                <!-- Foto Lama -->
                <div class="row justify-content-center">
                <div class="card col-lg-5 col-md-5 col-sm-5 col-5">
                  <img src="img/profil/<?php echo $row['foto'];?>" alt="Foto Profil" class="img-fluid mt-2 mb-2 rounded w-100">
                </div>
                </div>
                <!-- Input Foto -->
                <div class="mb-3">
                  <label for="formFile" class="form-label ms-1">Foto Baru</label>
                  <input class="form-control rounded-pill" required name="foto" type="file"">
                </div>
                <h6 class="mt-2 mb-2 text-danger"><b>Ketentuan :</b><br>1. Ketentuan Foto Profil Harus (.jpg), (.png), (.jpeg)<br>2. Ukuran File Maksimal 1 MB</h6>
                <div class="row">
                  <div class="col-lg-6 mb-2 mt-1">
                  <div class="d-grid gap-2">
                    <a href="" class="btn btn-md rounded-pill text-white" id="btn_user3" data-bs-toggle="modal" data-bs-target="#profil<?= $row["id"] ?>">Batal</a>                
                  </div>
                  </div>
                  <div class="col-lg-6">
                  <div class="d-grid gap-2 mb-2 mt-1">
                    <button type="submit" name="ganti_foto" class="btn text-white rounded-pill" id="btn_user">Simpan</button>                    
                  </div>
                  </div>
                </div>                
              </form>
              </div>
              </div>
          </div>
        </div>
        <!-- Modal Edit Profil-->
        <div class="modal fade" id="edit_profil<?= $row["id"] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header text-center" id="background_modal">
                <h5 class="modal-title" id="sub_judul5">Edit Profil</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="mb-3 mt-3 ms-3 me-3">
              <form action="" method="post" enctype="multipart/form-data"> 
                <input type="hidden" class="form-control rounded-pill" name="id"  value="<?= $row["id"] ?>">
                <div class="row">
                  <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                  <div class="mb-3">
                    <label for="disabledSelect" class="form-label ms-1">Id Pengguna</label>
                    <input type="text" class="form-control rounded-pill" id="bg-readonly" readonly name="id" value="<?= $row["id"] ?>">
                  </div>  
                  <div class="mb-3">
                    <label for="disabledSelect" class="form-label ms-1">Nama</label>
                    <input type="text" class="form-control rounded-pill" required name="nama" autofocus autocomplete="off" title="Hanya Bisa Huruf dan Angka" pattern="[A-Za-z0-9 ]+" placeholder="Masukan Nama" value="<?= $row["nama"] ?>">
                  </div>
                  <div class="mb-3">
                    <label for="disabledSelect" class="form-label ms-1">Nomor Telpon</label>
                    <input type="text" class="form-control rounded-pill" required name="no_telp" autocomplete="off" title="Hanya Bisa Angka dan Tidak Boleh Ada Space" pattern="[0-9]+" placeholder="Masukan Nomor Telpon" value="<?= $row["no_telp"] ?>">
                  </div>    
                  <div class="mb-3">
                  <label class="form-label ms-1">Jenis Kelamin</label><br>
                  <div class="form-check form-check-inline mt-1 ms-2">
                      <input class="form-check-input" type="radio" <?php if($row['jenis_kelamin']=='Laki-Laki') echo 'checked'?> required name="jenis_kelamin" id="jenis_kelamin" value="Laki-Laki">
                      <label class="form-check-label" for="inlineRadio1">Laki-Laki</label>
                  </div>
                  <div class="form-check form-check-inline mt-1 ms-2">
                      <input class="form-check-input" type="radio" <?php if($row['jenis_kelamin']=='Perempuan') echo 'checked'?> required name="jenis_kelamin" id="jenis_kelamin" value="Perempuan">
                      <label class="form-check-label" for="inlineRadio2">Perempuan</label>
                  </div>
                  </div> 
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-12 col-12">  
                  <div class="mb-3">
                    <label for="disabledSelect" class="form-label ms-1">Username</label>
                    <input type="text" class="form-control rounded-pill" required name="username" autocomplete="off" title="Hanya Bisa Huruf, Angka dan Tidak Boleh Ada Space" readonly id="bg-readonly" pattern="[A-Za-z0-9]+" placeholder="Masukan Username" value="<?= $row["username"] ?>">
                  </div> 
                  <div class="mb-1">
                    <label for="disabledSelect" class="form-label ms-1">Alamat</label>
                    <textarea class="form-control" required name="alamat" autocomplete="off" title="Hanya Bisa Huruf dan Angka" pattern="[A-Za-z0-9 .,]+" placeholder="Masukan Alamat" rows="8"><?= $row["alamat"] ?></textarea>
                  </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-6 mb-2 mt-1">
                  <div class="d-grid gap-2">
                    <a href="" class="btn btn-md rounded-pill text-white" id="btn_user3" data-bs-toggle="modal" data-bs-target="#profil<?= $row["id"] ?>">Batal</a>                
                  </div>
                  </div>
                  <div class="col-lg-6">
                  <div class="d-grid gap-2 mb-2 mt-1">
                    <button type="submit" name="edit" class="btn text-white rounded-pill" id="btn_user">Simpan</button>                    
                  </div>
                  </div>
                </div>                
              </form>
              </div>
              </div>
          </div>
        </div>
        <!-- Modal Ganti Password -->
        <div class="modal fade" id="ganti_password<?= $row["id"] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header text-center" id="background_modal">
                <h5 class="modal-title" id="sub_judul5">Ganti Password</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="mb-3 ms-3 pt-3 me-3">
              <form action="" method="post"> 
                <input type="hidden" class="form-control rounded-pill" name="id"  value="<?= $row["id"] ?>">
                <div class="mb-3">
                  <label for="disabledSelect" class="form-label ms-1">Password Baru</label>
                  <div class="input-group">
                  <input type="password" class="form-control rounded-pill" name="password" data-toggle="password" required autocomplete="off" title="Hanya Bisa Huruf, Angka dan Tidak Boleh Ada Space" pattern="[A-Za-z0-9]+" placeholder="Masukan Password Baru">
                  <div class="input-group-append">
                      <span class="input-group-text ms-1 rounded-pill" style="padding:0.6rem;"><i class="fa fa-eye"></i></span>
                  </div>
                  </div>
                </div>  
                <div class="mb-4">
                  <label for="disabledSelect" class="form-label ms-1">Ulangi Password</label>
                  <div class="input-group">
                  <input type="password" class="form-control rounded-pill" name="ulangi_password" data-toggle="password" required autocomplete="off" title="Hanya Bisa Huruf, Angka dan Tidak Boleh Ada Space" pattern="[A-Za-z0-9]+" placeholder="Masukan Ulangi Password">
                  <div class="input-group-append">
                      <span class="input-group-text ms-1 rounded-pill" style="padding:0.6rem;"><i class="fa fa-eye"></i></span>
                  </div>
                  </div>
                </div>        
                <div class="row">
                  <div class="col-lg-6">
                  <div class="d-grid gap-2">
                    <a href="" class="btn btn-md rounded-pill text-white mb-2" id="btn_user3" data-bs-toggle="modal" data-bs-target="#profil<?= $row["id"] ?>">Batal</a>                
                  </div>
                  </div>
                  <div class="col-lg-6">
                  <div class="d-grid gap-2">
                    <button type="submit" name="ganti_password" class="btn text-white rounded-pill" id="btn_user">Simpan</button>                    
                  </div>
                  </div>
                </div>
              </form>
              </div>
              </div>
          </div>
        </div>
  <?php endforeach; ?>
  </div>
  </div>

  <!-- Content Menu -->
  <div class="col-lg-9 col-md-9 col-sm-12 col-12">
  <div class="card pe-3 ps-3 bg-light">
  
  <h4 class="text-center pt-2 pb-1" id="sub_judul">Menu Favorit</h4>
  <!-- Navbar Menu Favorit -->
  <nav class="navbar navbar-expand-lg border-bottom border-success bg-light">
    <div class="container-fluid justify-content-center">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="nav navbar-nav me-auto">
          <li class="nav-item">
            <a class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-makanan" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Food</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-minuman" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Drink</a>
          </li>
        </ul>
      </div>
      <!-- Pencarian -->
      <div class="col-lg-5 col-md-10 col-sm-10 col-10">
        <input type="text" id="pencarian" class="form-control rounded-pill ms-2" placeholder="Pencarian Menu">
      </div>
    </div>
  </nav>

  <div class="position-sticky menu-sticky-dashboard">
  <div class="tab-content" id="nav-tabContent">
  <!-- Makanan -->
  <div class="tab-pane fade show active" id="nav-makanan" role="tabpanel" aria-labelledby="nav-home-tab" tabindex="0">
  <div class="container-fluid">
  <div class="row pb-2 pt-3 row-cols-lg-2 row-cols-md-4 row-cols-2 g-2"> 
  <?php foreach( $makanan as $row) : ?>
    <section>
    <form action="" method="post">
    <div class="col">
      <div class="card me-2 ms-2">
        <div class="row">
          <div class="col-lg-3">
            <input type="hidden" class="form-control" name="kode_favorit" value="<?php echo $row['kode_favorit'] ?>">
            <img src="img/foto/<?php echo $row['foto']; ?>" class="card-img-top" alt="...">
          </div>
          <div class="col-lg-7">
            <h6 class="fw-bold text-start pt-3"><?php echo $row['nama_menu']; ?></h6>
            <h6 class="text-danger fw-bold text-start"><?php echo rupiah($row['harga']); ?></h6>
          </div>
          <div class="col-lg-2">
            <div class="text-end">
              <button type="submit" name="hapus_favorit" class="btn btn-sm btn-outline-danger mt-1 me-1"><i class="bi bi-trash"></i></button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
  </section>  
  <?php endforeach ?> 
  
  <!-- Button Ke Halaman Menu -->
  <div class="row mt-1">
    <div class="col-lg-2">
      <a href="menu.php">
        <img src="img/add.png" class="img-fluid mt-1" id="gambar">
      </a>
    </div>
    <div class="col-lg-1"></div>
  </div>

  </div>
  </div>
  </div>

  <!-- Minuman -->
  <div class="tab-pane fade" id="nav-minuman" role="tabpanel" aria-labelledby="nav-profile-tab" tabindex="0">
  <div class="container-fluid">
  <div class="row pb-2 pt-3 row-cols-lg-2 row-cols-md-4 row-cols-2 g-2">
  <?php foreach( $minuman as $row) : ?>
    <section>
    <form action="" method="post">
    <div class="col">
      <div class="card me-2 ms-2">
        <div class="row">
          <div class="col-lg-3">
            <input type="hidden" class="form-control" name="kode_favorit" value="<?php echo $row['kode_favorit'] ?>">
            <img src="img/foto/<?php echo $row['foto']; ?>" class="card-img-top" alt="...">
          </div>
          <div class="col-lg-7">
            <h6 class="fw-bold text-start pt-3"><?php echo $row['nama_menu']; ?></h6>
            <h6 class="text-danger fw-bold text-start"><?php echo rupiah($row['harga']); ?></h6>
          </div>
          <div class="col-lg-2">
            <div class="text-end">
              <button type="submit" name="hapus_favorit" class="btn btn-sm btn-outline-danger mt-1 me-1"><i class="bi bi-trash"></i></button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
  </section>
  <?php endforeach ?> 

  <!-- Button Ke Halaman Menu -->
  <div class="row mt-1">
    <div class="col-lg-2">
      <a href="menu.php">
        <img src="img/add.png" class="img-fluid mt-1" id="gambar">
      </a>
    </div>
    <div class="col-lg-1"></div>
  </div>

  </div>
  </div>
  </div>

  </div>
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
    // Jika variabel hapus menu berhasil memiliki nilai
    if(isset($hapus_menu_favorit_berhasil)) {
      echo "<script> hapus_menu_favorit_berhasil(); </script>";
    }
    else if(isset($hapus_menu_favorit_gagal)){
      echo "<script> hapus_menu_favorit_gagal(); </script>";
    }else if(isset($ganti_password_pelanggan_berhasil)){
      echo "<script> ganti_password_pelanggan_berhasil(); </script>";
    }else if(isset($edit_pelanggan_berhasil)){
      echo "<script> edit_pelanggan_berhasil(); </script>";
    }else if(isset($edit_pelanggan_gagal)){
      echo "<script> edit_pelanggan_gagal(); </script>";
    }else if(isset($konfirmasi_password_tidak_sesuai)){
      echo "<script> konfirmasi_password_tidak_sesuai_pelanggan(); </script>";
    }else if(isset($ganti_foto_berhasil)){
      echo "<script> ganti_foto_berhasil(); </script>";
    }else if(isset($bukan_foto)){
      echo "<script> bukan_foto(); </script>";
    }else if(isset($ukuran_foto)){
      echo "<script> ukuran_foto_pelanggan(); </script>";
    }else{
      exit;
    }

?>


</body>
</html>
