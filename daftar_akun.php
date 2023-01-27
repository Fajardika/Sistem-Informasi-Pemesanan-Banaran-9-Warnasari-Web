<?php
require 'functions.php';
error_reporting(0);

// Button Daftar Akun
if(isset($_POST["daftar"])){
  $nama            = htmlspecialchars($_POST["nama"]);
  $no_telp         = htmlspecialchars($_POST["no_telp"]);
  $jenis_kelamin   = htmlspecialchars($_POST["jenis_kelamin"]);
  $username        = htmlspecialchars($_POST["username"]);
  $password        = mysqli_real_escape_string($conn, $_POST["password"]);
  $ulangi_password = mysqli_real_escape_string($conn, $_POST["ulangi_password"]);
  $result   = mysqli_query($conn, "SELECT username FROM pengguna WHERE username= '$username'");

  //cek Username sudah terdaftar atau belum
  if (mysqli_fetch_assoc($result)) { 
       $username_sudah_terdaftar = true;
  }else{
      //konfirmasi password
      if ($password == $ulangi_password) {
      //enkripsi password
      $password = password_hash($password, PASSWORD_DEFAULT);
      //tambahkan akun baru
      $query="INSERT INTO pengguna (id,foto,nama,jenis_kelamin,no_telp,alamat,username,password,level) values('','','$nama','$jenis_kelamin','$no_telp','','$username','$password','Pelanggan')";
      mysqli_query($conn, $query);
    
      $daftar_akun_berhasil = true;
      
      }else{
        $konfirmasi_password_tidak_sesuai = true;
      }
  }
}

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar Akun</title>
    <link rel="shortcut icon" href="img/title.png">
    <?php include 'kerangka/head.php'; ?>
  </head>
<body class="background_login">

<div class="container-fluid" style="display: flex; justify-content: center; align-items: center; margin-top:4%;">
<div class="card mb-3" style="max-width: 1105px; ">
  <div class="row g-0">
    <!-- Gambar -->
    <div class="col-lg-5 d-lg-block d-md-none d-sm-none d-none">
      <img src="img/banner_login.png" class="img-fluid rounded-start" alt="...">
    </div>
    <!-- Inputan -->
    <div class="col-lg-7 col-md-12 text-white rounded-end" style="background-image: linear-gradient(to right, var(--brand2) , #fd8f19a1); ">
      <a href="login.php"" class="nav-link btn-close  btn-close-white mt-2 me-2 ms-auto" aria-label="Close"></a>
    <div id="top">
    <h4 class="text-center mb-1" id="sub_judul2">Daftar Akun</h4>
    </div>
      <div class="card-body mt-1 me-3 ms-3" id="top">
      <form action="" method="post">
      <div class="row">
      <div class="col-lg-6">
        <div class="mb-3">
          <label class="form-label ms-1">Nama</label>
          <input type="text" class="form-control rounded-pill" autocomplete="off" title="Hanya Bisa Huruf dan Angka" pattern="[A-Za-z0-9 ]+" name="nama" required placeholder="Masukan Nama">
        </div>
        <div class="mb-3">
          <label for="disabledSelect" class="form-label ms-1">Nomor Telepon</label>
          <input type="text" class="form-control rounded-pill" autocomplete="off" title="Hanya Bisa Angka dan Tidak Boleh Ada Space" pattern="[0-9]+" name="no_telp" required placeholder="Masukan Nomor Telepon">
        </div>  
        <div class="mb-3">
          <label class="form-label ms-1">Jenis Kelamin</label><br>
          <div class="form-check form-check-inline mt-2 ms-2">
              <input class="form-check-input" type="radio" required name="jenis_kelamin" id="jenis_kelamin" value="Laki-Laki">
              <label class="form-check-label" for="inlineRadio1">Laki-Laki</label>
          </div>
          <div class="form-check form-check-inline mt-2">
              <input class="form-check-input" type="radio" required name="jenis_kelamin" id="jenis_kelamin" value="Perempuan">
              <label class="form-check-label" for="inlineRadio2">Perempuan</label>
          </div>
        </div> 
      </div>
      <div class="col-lg-6">
        <div class="mb-3">
            <label class="form-label ms-1">Username</label>
            <input type="text" class="form-control rounded-pill" autocomplete="off" title="Hanya Bisa Huruf, Angka dan Tidak Boleh Ada Space" pattern="[A-Za-z0-9]+" name="username" id="username" required placeholder="Masukan Username">
        </div>
        <div class="mb-3">
            <label for="disabledSelect" class="form-label ms-1">Password</label>
            <div class="input-group">
              <input type="password" class="form-control rounded-pill input-md" name="password" data-toggle="password" required autocomplete="off" title="Hanya Bisa Huruf dan Angka" pattern="[A-Za-z0-9]+" placeholder="Masukan Password">
            <div class="input-group-append">
              <span class="input-group-text ms-1 rounded-pill bg-light" style="padding:0.6rem;"><i class="fa fa-eye"></i></span>
            </div>
            </div>
        </div>
        <div class="mb-3">
            <label for="disabledSelect" class="form-label ms-1">Ulangi Password</label>
            <div class="input-group">
              <input type="password" class="form-control rounded-pill input-md" name="ulangi_password" data-toggle="password" required autocomplete="off" title="Hanya Bisa Huruf, Angka dan Tidak Boleh Ada Space" pattern="[A-Za-z0-9]+" placeholder="Masukan Ulangi Password">
            <div class="input-group-append">
              <span class="input-group-text ms-1 rounded-pill bg-light" style="padding:0.6rem;"><i class="fa fa-eye"></i></span>
            </div>
            </div>
        </div>
      </div>
      </div>
        <!-- Button -->
        <div class="d-grid gap-2">
            <button type="submit" name="daftar" class="btn mt-3 rounded-pill text-white" id="btn_user">Daftar Akun</button>
        </div>
        <div class="text-center">
            <label class="form-label mt-3">Sudah Memiliki Akun? <a class="fw-bold text-success" href="login.php" style="text-decoration: none;">Login</a></label>
        </div>
        </form>
      </div>
    </div>
  </div>
</div>
</div>

<!-- Script -->
<?php include 'kerangka/sweet_alert.php'; ?>

<?php   
    if(isset($daftar_akun_berhasil)) {
      echo "<script> daftar_akun_berhasil(); </script>";
    }else if(isset($username_sudah_terdaftar)){
      echo "<script> username_sudah_terdaftar(); </script>";
    }else if(isset($konfirmasi_password_tidak_sesuai)){
      echo "<script> konfirmasi_password_tidak_sesuai(); </script>";
    }else{
      exit;
    };
?>

</body>
</html>
