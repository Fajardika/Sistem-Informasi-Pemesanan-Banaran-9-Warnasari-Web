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
    $pengguna1  = query("SELECT id,foto,nama,jenis_kelamin,no_telp,alamat,username,password,level FROM pengguna WHERE username = '$username'");
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

// Button Tambah
if(isset($_POST["tambah"])){

$nama            = htmlspecialchars($_POST["nama"]);
$no_telp         = htmlspecialchars($_POST["no_telp"]);
$jenis_kelamin   = htmlspecialchars($_POST["jenis_kelamin"]);
$username        = htmlspecialchars($_POST["username"]);
$level           = htmlspecialchars($_POST["level"]);
$alamat          = htmlspecialchars($_POST["alamat"]);
$password        = mysqli_real_escape_string($conn, $_POST["password"]);
$ulangi_password = mysqli_real_escape_string($conn, $_POST["ulangi_password"]);
$result   = mysqli_query($conn, "SELECT username FROM pengguna WHERE username= '$username'");

$fileName       = $_FILES['foto']['name'];
$ukuran         = $_FILES['foto']['size'];
$error          = $_FILES['foto']['error'];
$tmpName        = $_FILES['foto']['tmp_name'];
$ekstensi       = ['jpg', 'png', 'jpeg'];
$ekstensiGambar = explode('.', $fileName);
$ekstensiGambar = strtolower(end($ekstensiGambar));


  // Cek apakah yang di upload foto atau bukan
  if(!in_array($ekstensiGambar,$ekstensi) ) {
     $bukan_foto_pengguna = true;
  }else{
    if($ukuran < 1000000){		
        //cek Username sudah terdaftar atau belum
        if (mysqli_fetch_assoc($result)) {
          $username_pengguna_sudah_terdaftar = true;
        }else{
        //konfirmasi password
        if ($password !== $ulangi_password) {
          $konfirmasi_password_pengguna_tidak_sesuai = true;
        }else{
        //enkripsi password
        $password = password_hash($password, PASSWORD_DEFAULT);
        // Foto
        $namaFileBaru  = uniqid();
        $namaFileBaru .= '.';
        $namaFileBaru .= $ekstensiGambar;
  
        move_uploaded_file($tmpName, 'e:/xampp/htdocs/Banaran/img/profil/'. $namaFileBaru);

        // tambahkan akun baru
        $query="INSERT INTO pengguna values('','$namaFileBaru','$nama','$jenis_kelamin','$no_telp','$alamat','$username','$password','$level')";
        mysqli_query($conn, $query);
        $tambah_data_pengguna_berhasil = true;

        }
      }
    }else{
       $ukuran_foto = true;
    }
   }  
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
    $bukan_foto_pengguna = true;
    
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

// Button Edit
if(isset($_POST["edit"])){
  //cek data berhasil atau tidak
  if(edit_pengguna($_POST) > 0 ) {
      $edit_data_pengguna_berhasil = true;
  }else{
      $edit_data_pengguna_gagal = true;
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

    $ganti_password_pengguna_berhasil = true;

  }else{
    $konfirmasi_password_pengguna_tidak_sesuai = true; 
  }
}

// Button Hapus
if(isset($_POST["hapus"]) > 0){
  //cek data berhasil atau tidak
  if(hapus_pengguna($_POST) > 0 ) {
    $hapus_data_pengguna_berhasil = true;
  }else{
    $hapus_data_pengguna_gagal = true;
  }
}

// Menampilkan data 
$pengguna = query("SELECT * FROM pengguna");

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
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar1 shadow collapse position-fixed">
    <img src="../img/Logo_Banaran_Transparant.png" class="img-fluid mt-3" alt="Logo Banaran" width="100%" id="left">
      <div class="position-sticky pt-3 sidebar1-sticky">
        <ul class="nav flex-column" id="left">
          <li class="nav-item">
            <a class="nav-link" href="index.php" id="gambar1"><i class="bi bi-house"></i> Dashboard</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="pengguna.php" id="gambar1"><i class="bi bi-people"></i> Pengguna</a>
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
            <a class="nav-link" href="laporan.php" id="gambar1"><i class="bi bi-clipboard-data"></i> Laporan</a>
          </li>          
        </ul>
      </div>
    </nav>

    <!-- Konten -->
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="border-bottom border-success">
      <div class="row" id="top">
        <div class="col-lg-2">
          <button type="button" class="btn btn-sm text-white rounded-pill mb-2" id="btn_user" data-bs-toggle="modal" data-bs-target="#tambah"><i class="bi bi-plus-square"></i> Tambah</button>
        </div>
        <div class="col-lg-8">
          <h4 class="text-center" id="sub_judul4">Pengguna</h4>
        </div>
      </div>
    </div>
    <div class="table-responsive mt-3">
    <table id="table" class="table table-striped table-bordered display border mt-6 table-hover table-sm ">
    <thead class="text-white">
      <tr class="text-center">           
        <th>No</th>
        <th>Id Pengguna</th>
        <th>Nama</th>
        <th>Jenis Kelamin</th>
        <th>No. Telp</th>
        <th>Aksi</th> 
      </tr>
    </thead>
    <tbody  class="table-light text-center" id="tbody">
    <!-- Looping Table -->
      <?php $i = 1; ?>
      <?php foreach( $pengguna as $row) : ?>
        <tr>
        <td class="col-sm-1"><?= $i++; ?></td>
        <td class="col-sm-2"><?= $row["id"] ?></td>
        <td class="col-sm-4"><?= $row["nama"] ?></td>
        <td class="col-sm-2"><?= $row["jenis_kelamin"] ?></td>
        <td class="col-sm-2"><?= $row["no_telp"] ?></td>
        <td class="col-sm-1">
        <div class="text-center">
          <a href="" class="btn btn-sm rounded-pill text-white" id="btn_user" data-bs-toggle="modal" data-bs-target="#detail<?php echo $row['id']; ?>"><i class="bi bi-search"></i></a>
          <a href="" class="btn btn-sm rounded-pill text-white" id="btn_user3" data-bs-toggle="modal" data-bs-target="#hapus<?php echo $row['id']; ?>"><i class="bi bi-trash"></i></a> 
        </td>                      
        </tr>
        <!-- Modal Detail -->
        <div class="modal fade" id="detail<?php echo $row['id']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header text-center" id="background_modal">
                <h5 class="modal-title" id="sub_judul5">Detail Pengguna</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="mb-3 mt-3 ms-3 me-3">
              <form action="" method="post"> 
                <input type="hidden" class="form-control rounded-pill" name="id"  value="<?= $row["id"] ?>">
              <div class="row">
                <!-- Kolom 1 -->
                <div class="col-lg-4">
                <div class="text-center">
                <div class="card p-2 mb-2">
                    <img src="../img/profil/<?php echo $row['foto'];?>" style="width: 100%;" alt="Foto Profil" class="img-fluid rounded">
                    <a href="" class="btn btn-md rounded-pill mt-2 text-white" id="btn_user" data-bs-toggle="modal" data-bs-target="#ganti_foto<?php echo $row['id']; ?>">Ganti Foto</a>    
                  </div>
                  <div class="d-grid gap-2 mt-3">   
                    <a href="" class="btn btn-md rounded-pill me-2 ms-2 text-white" id="btn_user2" data-bs-toggle="modal" data-bs-target="#profil<?php echo $row['id']; ?>">Edit Profil</a>    
                    <a href="" class="btn btn-md text-white me-2 ms-2 mt-2 rounded-pill mb-2" id="btn_user3" data-bs-toggle="modal" data-bs-target="#ganti_password<?php echo $row['id']; ?>">Ganti Password</a>              
                  </div>
                </div>
                </div>
                <!-- Kolom 2 -->
                <div class="col-lg-8">
                <div class="row">
                  <div class="col-lg-6">
                  <div class="mb-3">
                    <label for="disabledSelect" class="form-label ms-1">Nama</label>
                    <input type="text" class="form-control rounded-pill" readonly id="bg-readonly" value="<?= $row["nama"] ?>">
                  </div> 
                  <div class="mb-3">
                    <label for="disabledSelect" class="form-label ms-1">Jenis Kelamin</label>
                    <input type="text" class="form-control rounded-pill" readonly id="bg-readonly" value="<?= $row["jenis_kelamin"] ?>">
                  </div>    
                  <div class="mb-3">
                    <label for="disabledSelect" class="form-label ms-1">Nomor Telpon</label>
                    <input type="text" class="form-control rounded-pill" readonly id="bg-readonly" value="<?= $row["no_telp"] ?>">
                  </div>    
                  </div>
                  <div class="col-lg-6">
                  <div class="mb-3">
                    <label for="disabledSelect" class="form-label ms-1">Username</label>
                    <input type="text" class="form-control rounded-pill" readonly id="bg-readonly" value="<?= $row["username"] ?>">
                  </div>  
                  <div class="mb-3">
                    <label for="disabledSelect" class="form-label ms-1">Password</label>
                    <input type="password" class="form-control rounded-pill" readonly id="bg-readonly" value="123456789">
                  </div>  
                  <div class="mb-3">
                    <label for="disabledSelect" class="form-label ms-1">Level</label>
                    <input type="text" class="form-control rounded-pill" readonly id="bg-readonly" value="<?= $row["level"] ?>">
                  </div>  
                  </div>
                </div> 
                <div class="mb-2">
                  <label for="disabledSelect" class="form-label ms-1">Alamat</label>
                  <textarea class="form-control" readonly id="bg-readonly" rows="5"><?= $row["alamat"] ?></textarea>
                </div>  
                </div>
              </div>                
              </form>
              </div>
              </div>
          </div>
        </div>
        <!-- Modal Edit Profil-->
        <div class="modal fade" id="profil<?php echo $row['id']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                  <div class="col-lg-4">
                  <div class="mb-3">
                    <label for="disabledSelect" class="form-label ms-1">Id Pengguna</label>
                    <input type="text" class="form-control rounded-pill" readonly id="bg-readonly" name="id" value="<?= $row["id"] ?>">
                  </div>  
                  <div class="mb-3">
                    <label for="disabledSelect" class="form-label ms-1">Nama</label>
                    <input type="text" class="form-control rounded-pill" required name="nama" autofocus autocomplete="off" title="Hanya Bisa Huruf, Angka dan Tidak Boleh Ada Space" pattern="[A-Za-z0-9 ]+" placeholder="Masukan Nama" value="<?= $row["nama"] ?>">
                  </div>    
                  <div class="mb-1">
                  <label class="form-label ms-1">Jenis Kelamin</label><br>
                  <div class="form-check form-check-inline mt-1">
                      <input class="form-check-input" type="radio" <?php if($row['jenis_kelamin']=='Laki-Laki') echo 'checked'?> required name="jenis_kelamin" id="jenis_kelamin" value="Laki-Laki">
                      <label class="form-check-label" for="inlineRadio1">Laki-Laki</label>
                  </div>
                  <div class="form-check form-check-inline mt-1">
                      <input class="form-check-input" type="radio" <?php if($row['jenis_kelamin']=='Perempuan') echo 'checked'?> required name="jenis_kelamin" id="jenis_kelamin" value="Perempuan">
                      <label class="form-check-label" for="inlineRadio2">Perempuan</label>
                  </div>
                  </div> 
                  </div>
                  <div class="col-lg-4">  
                  <div class="mb-3">
                    <label for="disabledSelect" class="form-label ms-1">Nomor Telpon</label>
                    <input type="text" class="form-control rounded-pill" required name="no_telp" autocomplete="off" title="Hanya Bisa Angka dan Tidak Boleh Ada Space" pattern="[0-9]+" placeholder="Masukan Nomor Telpon" value="<?= $row["no_telp"] ?>">
                  </div>
                  <div class="mb-2">
                    <label for="disabledSelect" class="form-label ms-1">Username</label>
                    <input type="text" class="form-control rounded-pill" required name="username" autocomplete="off" title="Hanya Bisa Huruf, Angka dan Tidak Boleh Ada Space" pattern="[A-Za-z0-9]+" placeholder="Masukan Username" value="<?= $row["username"] ?>">
                  </div>
                  <div class="mb-3">
                  <label for="disabledSelect" class="form-label ms-1">Level</label>
                  <select class="form-select rounded-pill"  name="level" id="level">
                      <?php $status = $row['level']; ?>
                      <option <?php echo ($status == 'Admin') ? "selected": "" ?>>Admin</option>
                      <option <?php echo ($status == 'Pelayan') ? "selected": "" ?>>Pelayan</option>
                      <option <?php echo ($status == 'Kasir') ? "selected": "" ?>>Kasir</option>
                      <option <?php echo ($status == 'Chef') ? "selected": "" ?>>Chef</option>
                      <option <?php echo ($status == 'Pelanggan') ? "selected": "" ?>>Pelanggan</option>
                  </select>
                  </div>
                  </div>
                  <div class="col-lg-4">
                  <div class="mb-1">
                    <label for="disabledSelect" class="form-label ms-1">Alamat</label>
                    <textarea class="form-control" required name="alamat" autocomplete="off" title="Hanya Bisa Huruf dan Angka" pattern="[A-Za-z0-9 .,]+" placeholder="Masukan Alamat" rows="8"><?= $row["alamat"] ?></textarea>
                </div>                   
                  </div>
                </div>

                <div class="row">
                  <div class="col-lg-6 mb-2 mt-1">
                  <div class="d-grid gap-2">
                    <a href="" class="btn btn-md rounded-pill text-white" id="btn_user3" data-bs-toggle="modal" data-bs-target="#detail<?php echo $row['id']; ?>">Batal</a>                
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
        <!-- Modal Ganti Foto -->
        <div class="modal fade" id="ganti_foto<?php echo $row['id']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                <div class="card col-lg-5">
                  <img src="../img/profil/<?php echo $row['foto'];?>" alt="Foto Profil" class="img-fluid mt-2 mb-2 rounded w-100">
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
                    <a href="" class="btn btn-md rounded-pill text-white" id="btn_user3" data-bs-toggle="modal" data-bs-target="#detail<?php echo $row['id']; ?>">Batal</a>                
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
        <!-- Modal Ganti Password -->
        <div class="modal fade" id="ganti_password<?php echo $row['id']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                    <a href="" class="btn rounded-pill text-white mb-2" id="btn_user3" data-bs-toggle="modal" data-bs-target="#detail<?php echo $row['id']; ?>">Batal</a>                
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
        <!-- Modal Hapus -->
        <div class="modal fade" id="hapus<?php echo $row['id']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header text-center" id="background_modal">
                <h5 class="modal-title" id="sub_judul5">Hapus Pengguna</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="mb-2 mt-2 ms-3 me-3 text-center">
              <form action="" method="post"  enctype="multipart/form-data"> 
                <img src="../img/icon_warning.png" class="img-fluid w-25 mb-3" id="gambar_effect" alt="Warning">
                <input type="hidden" class="form-control rounded-pill" name="id"  value="<?= $row["id"] ?>">
                <P>Anda Yakin Akan Menghapus Data Pengguna Dengan ID <b><?= $row["id"] ?></b>?
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

    </div> 
    </main>
  </div>
</div>

<!-- Modal Tambah -->
<div class="modal fade" id="tambah" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header text-center" id="background_modal">
                <h5 class="modal-title" id="sub_judul5">Tambah Pengguna</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="mb-3 mt-3 ms-3 me-3">
              <form action="" method="post" enctype="multipart/form-data"> 
                <div class="row">
                  <div class="col-lg-4">
                  <div class="mb-3">
                    <label for="formFile" class="form-label ms-1">Foto</label>
                    <input class="form-control rounded-pill" required name="foto" type="file" id="formFile">
                  </div> 
                  <div class="mb-3">
                    <label for="disabledSelect" class="form-label ms-1">Nama</label>
                    <input type="text" class="form-control rounded-pill" required  name="nama" autofocus autocomplete="off" title="Hanya Bisa Huruf dan Angka" pattern="[A-Za-z0-9 ]+" placeholder="Masukan Nama">
                  </div>  
                  <div class="mb-3">
                    <label for="disabledSelect" class="form-label ms-1">Nomor Telpon</label>
                    <input type="text" class="form-control rounded-pill" required autocomplete="off" title="Hanya Bisa Angka dan Tidak Boleh Ada Space" pattern="[0-9]+" name="no_telp" placeholder="Masukan Nomor Telpon">
                  </div>  
                  <div class="">
                  <label class="form-label ms-1">Jenis Kelamin</label><br>
                  <div class="form-check form-check-inline mt-2">
                      <input class="form-check-input" type="radio" required  name="jenis_kelamin" id="jenis_kelamin" value="Laki-Laki">
                      <label class="form-check-label mt-1" for="inlineRadio1">Laki-Laki</label>
                  </div>
                  <div class="form-check form-check-inline mt-2">
                      <input class="form-check-input" type="radio" required name="jenis_kelamin" id="jenis_kelamin" value="Perempuan">
                      <label class="form-check-label mt-1" for="inlineRadio2">Perempuan</label>
                  </div>
                  </div>    
                  </div>
                  <div class="col-lg-4">
                    <div class="mb-3">
                      <label for="disabledSelect" class="form-label ms-1">Username</label>
                      <input type="text" class="form-control rounded-pill" required  name="username"  autocomplete="off" title="Hanya Bisa Huruf, Angka dan Tidak Boleh Ada Space" pattern="[A-Za-z0-9]+"placeholder="Masukan Username">
                    </div>  
                    <div class="mb-3">
                      <label for="disabledSelect" class="form-label ms-1">Password</label>
                      <div class="input-group">
                          <input type="password" class="form-control rounded-pill" required  name="password" data-toggle="password" autocomplete="off" title="Hanya Bisa Huruf, Angka dan Tidak Boleh Ada Space" pattern="[A-Za-z0-9]+" placeholder="Masukan Password">
                      <div class="input-group-append">
                          <span class="input-group-text ms-1 rounded-pill" style="padding:0.6rem;"><i class="fa fa-eye"></i></span>
                      </div>
                      </div>
                    </div>  
                    <div class="mb-3">
                      <label for="disabledSelect" class="form-label ms-1">Ulangi Password</label>
                      <div class="input-group">
                      <input type="password" class="form-control rounded-pill" required  name="ulangi_password" data-toggle="password" autocomplete="off" title="Hanya Bisa Huruf, Angka dan Tidak Boleh Ada Space" pattern="[A-Za-z0-9]+" placeholder="Ulangi Password">
                      <div class="input-group-append">
                          <span class="input-group-text ms-1 rounded-pill" style="padding:0.6rem;"><i class="fa fa-eye"></i></span>
                      </div>
                      </div>
                    </div> 
                    <div class="">
                    <label for="disabledSelect" class="form-label ms-1">Level</label>
                    <select class="form-select rounded-pill mt-1" name="level" aria-label="Default select example">
                      <option value="Admin">Admin</option>
                      <option value="Pelayan">Pelayan</option>
                      <option value="Kasir">Kasir</option>
                      <option value="Chef">Chef</option>
                      <option value="Pelanggan">Pelanggan</option>
                    </select>
                    </div>
                  </div>
                  <div class="col-lg-4">
                  <div class="">
                    <label for="disabledSelect" class="form-label ms-1">Alamat</label>
                    <textarea class="form-control" name="alamat" placeholder="Masukan Alamat" required autocomplete="off" title="Hanya Bisa Huruf dan Angka" pattern="[A-Za-z0-9 .,]+" rows="12"></textarea>
                  </div>
                  </div>
                  <h6 class="mt-2 mb-2 text-danger"><b>Ketentuan :</b><br>1. Ketentuan Foto Profil Harus (.jpg), (.png), (.jpeg)<br>2. Ukuran File Maksimal 1 MB</h6>
                
                  <div class="d-grid gap-2">
                      <button type="submit" name="tambah" class="btn text-white rounded-pill ms-3 me-3 mt-3 mb-1" id="btn_user">Simpan</button>                    
                  </div>
                </div>            
              </form>
              </div>
              </div>
          </div>
        </div>

<!-- Script -->
<?php include '../kerangka/sweet_alert.php'; ?>

<?php   
    if(isset($tambah_data_pengguna_berhasil)) {
      echo "<script> tambah_data_pengguna_berhasil(); </script>";
    }else if(isset($tambah_data_pengguna_gagal)){
      echo "<script> tambah_data_pengguna_gagal(); </script>";
    }else if(isset($bukan_foto_pengguna)){
      echo "<script> bukan_foto_pengguna(); </script>";
    }else if(isset($username_pengguna_sudah_terdaftar)){
      echo "<script> username_pengguna_sudah_terdaftar(); </script>";
    }else if(isset($ukuran_foto)){
      echo "<script> ukuran_foto(); </script>";
    }else if(isset($edit_data_pengguna_berhasil)){
      echo "<script> edit_data_pengguna_berhasil(); </script>";
    }else if(isset($edit_data_pengguna_gagal)){
      echo "<script> edit_data_pengguna_gagal(); </script>";
    }else if(isset($ganti_foto_berhasil)){
      echo "<script> ganti_foto_pengguna_berhasil(); </script>";
    }else if(isset($hapus_data_pengguna_berhasil)){
      echo "<script> hapus_data_pengguna_berhasil(); </script>";
    }else if(isset($hapus_data_pengguna_gagal)){
      echo "<script> hapus_data_pengguna_gagal(); </script>";
    }else if(isset($ganti_password_pengguna_berhasil)){
      echo "<script> ganti_password_pengguna_berhasil(); </script>";
    }else if(isset($konfirmasi_password_pengguna_tidak_sesuai)){
      echo "<script> konfirmasi_password_pengguna_tidak_sesuai(); </script>";
    }else{
      exit;
    };
?>

</body>
</html>
