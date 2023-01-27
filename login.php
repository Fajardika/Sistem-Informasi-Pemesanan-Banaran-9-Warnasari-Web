<?php
session_start();
require 'functions.php';
error_reporting(0);

if(isset($_SESSION["login"])) {
   header("Location: dashboard.php");
   exit;
}  
 
// Button Login
if( isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $level1   = 'Admin';
    $level2   = 'Pelayan';
    $level3   = 'Kasir';
    $level4   = 'Chef';
    $level5   = 'Pelanggan';
    $result = mysqli_query($conn, "SELECT * FROM pengguna WHERE username = '$username'");
    //cek username
    if (mysqli_num_rows($result) === 1) {
        //cek password
        $row = mysqli_fetch_assoc($result);
        if( password_verify($password, $row["password"]) ) {
            //set session
            if($row["level"] == $level1){
              $_SESSION["login"]      = true;
              $_SESSION['username']   = $username;
              $_SESSION['level']      = $level1;
              header("Location: admin/index.php");
            
            }else if($row["level"] == $level2){
              $_SESSION["login"]      = true;
              $_SESSION['username']   = $username;
              $_SESSION['level']      = $level2;
              header("Location: pelayan/index.php");

            }else if($row["level"] == $level3){
              $_SESSION["login"]      = true;
              $_SESSION['username']   = $username;
              $_SESSION['level']      = $level3;
              header("Location: kasir/index.php");

            }else if($row["level"] == $level4){
              $_SESSION["login"]      = true;
              $_SESSION['username']   = $username;
              $_SESSION['level']      = $level4;
              header("Location: koki/index.php");
            }else{
              $_SESSION["login"]      = true;
              $_SESSION['username']   = $username;
              $_SESSION['level']      = $level5;
              header("Location: dashboard.php");
            }
        }
        $password_salah = true;
    }
     $username_salah = true;
}

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link rel="shortcut icon" href="img/title.png">
    <?php include 'kerangka/head.php'; ?>
  </head>
<body class="background_login">


<div class="container-fluid" style="display: flex; justify-content: center; align-items: center; margin-top:5%;">
<div class="card mb-3" style="max-width: 850px; ">
  <div class="row g-0">
    <div class="col-lg-6 col-md-6 d-lg-block d-md-block d-sm-none d-none">
      <img src="img/banner_login.png" class="img-fluid rounded-start" alt="...">
    </div>
    <div class="col-lg-6 col-md-6 text-white" style=" background-image: linear-gradient(to right, var(--brand2) , #fd8f19a1); ">
    <a href="index.php" class="nav-link btn-close  btn-close-white mt-2 me-2 ms-auto" aria-label="Close"></a>
    <div id="top">
      <h2 class="text-center mb-1" id="sub_judul2">Login</h2>
    </div>
      <div class="card-body mt-3 me-3 ms-3" id="top">
      <form action="" method="post">
            <div class="mb-3">
                <label class="form-label ms-1">Username</label>
                <input type="text" class="form-control rounded-pill" autofocus autocomplete="off" title="Hanya Bisa Huruf, Angka dan Tidak Boleh Ada Space" pattern="[A-Za-z0-9]+" name="username" id="username" required placeholder="Masukan Username">
            </div>
            <div class="mb-3">
                <label for="disabledSelect" class="form-label ms-1">Password</label>
                <div class="input-group">
                  <input type="password" class="form-control rounded-pill" autocomplete="off" title="Hanya Bisa Huruf, Angka dan Tidak Boleh Ada Space" pattern="[A-Za-z0-9]+" name="password" data-toggle="password" required placeholder="Masukan Password">
                  <div class="input-group-append">
                      <span class="input-group-text ms-1 rounded-pill bg-light" style="padding:0.6rem;"><i class="fa fa-eye"></i></span>
                  </div>
                </div>
            </div>
            <div class="d-grid gap-2">
                <button type="submit" name="login" class="btn mt-3 rounded-pill text-white" id="btn_user">Login</button>
            </div>
            <div class="text-center">
                <label class="form-label mt-3">Belum Memiliki Akun? <a class="fw-bold text-success" href="daftar_akun.php" style="text-decoration: none;">Daftar</a></label>
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
    if(isset($username_salah)) {
      echo "<script> username_salah(); </script>";
    }else{
      exit;
    };
    if(isset($password_salah)){
      echo "<script> password_salah(); </script";
    }else{
      exit;
    };
?>

</body>
</html>
