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

// INT Ke Rupiah
function rupiah($angka){
	
	$hasil_rupiah = "Rp " . number_format($angka,2,',','.');
	return $hasil_rupiah;
 
}

// Button Tambah
if(isset($_POST["tambah"])){

  $kode_kategori   = htmlspecialchars($_POST["kode_kategori"]);
  $nama_menu       = htmlspecialchars($_POST["nama_menu"]);
  $harga           = htmlspecialchars($_POST["harga"]);
  
  $fileName       = $_FILES['foto']['name'];
  $ukuran         = $_FILES['foto']['size'];
  $error          = $_FILES['foto']['error'];
  $tmpName        = $_FILES['foto']['tmp_name'];
  $ekstensi       = ['jpg', 'png', 'jpeg'];
  $ekstensiGambar = explode('.', $fileName);
  $ekstensiGambar = strtolower(end($ekstensiGambar));

    // Cek apakah yang di upload foto atau bukan
    if(!in_array($ekstensiGambar,$ekstensi) ) {
       $bukan_foto_menu = true;
    }else{
      if($ukuran < 1000000){		
          // Foto
          $namaFileBaru  = uniqid();
          $namaFileBaru .= '.';
          $namaFileBaru .= $ekstensiGambar;
    
          move_uploaded_file($tmpName, 'e:/xampp/htdocs/Banaran/img/foto/'. $namaFileBaru);
  
          // tambahkan menu baru
          $query="INSERT INTO menu (kode_menu, kode_kategori, nama_menu, foto, harga) values('','$kode_kategori','$nama_menu', '$namaFileBaru','$harga')";
          mysqli_query($conn, $query);
          $tambah_menu_berhasil = true;
      }else{
         $ukuran_foto_menu = true;
      }
     }
}    

// Button Ganti Foto
if(isset($_POST["ganti_foto"]) > 0){

  $kode_menu      = htmlspecialchars($_POST['kode_menu']);
   
  $fileName       = $_FILES['foto']['name'];
  $ukuran         = $_FILES['foto']['size'];
  $error          = $_FILES['foto']['error'];
  $tmpName        = $_FILES['foto']['tmp_name'];
  
  $ekstensi       = ['jpg', 'png', 'jpeg'];
  $ekstensiGambar = explode('.', $fileName);
  $ekstensiGambar = strtolower(end($ekstensiGambar));

  // Cek apakah yang di upload foto atau bukan
  if(!in_array($ekstensiGambar,$ekstensi) ) {
    $bukan_foto_menu = true;
    
  }else{
    if($ukuran < 1000000){		
      $namaFileBaru  = uniqid();
      $namaFileBaru .= '.';
      $namaFileBaru .= $ekstensiGambar;

      move_uploaded_file($tmpName, 'e:/xampp/htdocs/Banaran/img/foto/'. $namaFileBaru);
      mysqli_query($conn, "UPDATE menu SET foto ='$namaFileBaru' WHERE kode_menu ='$kode_menu'");

      $ganti_foto_menu_berhasil = true;
      
    }else{

      $ukuran_foto = true;

    }
  }

}

// Button Edit
if(isset($_POST["edit"])){
  //cek data berhasil atau tidak
  if(edit_menu($_POST) > 0 ) {
      $edit_menu_berhasil = true;
  }else{
      $edit_menu_gagal = true;
  }
}

// Button Hapus
if(isset($_POST["hapus"]) > 0){
  //cek data berhasil atau tidak
  if(hapus_menu($_POST) > 0 ) {
    $hapus_menu_berhasil = true;
  }else{
    $hapus_menu_gagal = true;
}
}


// Menampilkan data 
$menu     = query("SELECT * FROM detail_menu ORDER BY kode_menu ASC");
$kategori = query("SELECT * FROM kategori");

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
            <a class="nav-link" href="index.php" id="gamba1"><i class="bi bi-house"></i> Dashboard</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="pengguna.php" id="gambar1"><i class="bi bi-people"></i> Pengguna</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="kategori.php" id="gambar1"><i class="bi bi-ui-checks"></i> Kategori Menu</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="menu.php" id="gambar1"><i class="bi bi-cup-straw"></i> Menu</a>
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
          <h4 class="text-center" id="sub_judul4">Menu</h4>
        </div>
      </div>
    </div>
    <div class="table-responsive mt-3">
    <table id="table" class="table table-striped table-bordered display border mt-6 table-hover table-sm ">
    <thead class="text-white">
      <tr class="text-center">           
        <th>No</th>
        <th>Kode Menu</th>
        <th>Foto Makanan</th>
        <th>Nama Menu</th>
        <th>Nama Kategori</th>
        <th>Harga</th>
        <th>Aksi</th> 
      </tr>
    </thead>
    <tbody  class="table-light text-center" id="tbody">
    <!-- Looping Table -->
      <?php $i = 1; ?>
      <?php foreach( $menu as $row_menu) : ?>
        <tr>
        <td class="col-sm-1"><?= $i++; ?></td>
        <td class="col-sm-2"><?= $row_menu["kode_menu"] ?></td>
        <td class="col-sm-1"><img src="../img/foto/<?= $row_menu["foto"] ?>" class="img-fluid w-100"></td>
        <td class="col-sm-2"><?= $row_menu["nama_menu"] ?></td>
        <td class="col-sm-2"><?= $row_menu["nama_kategori"] ?></td>
        <td class="col-sm-2"><?= rupiah($row_menu["harga"]); ?></td>
        <td class="col-sm-2">
        <div class="text-center">
          <a href="" class="btn btn-sm rounded-pill text-white" id="btn_user" data-bs-toggle="modal" data-bs-target="#edit<?php echo $row_menu['kode_menu']; ?>"><i class="bi bi-pencil-square"></i></a>
          <a href="" class="btn btn-sm rounded-pill text-white" id="btn_user2" data-bs-toggle="modal" data-bs-target="#ganti_foto<?php echo $row_menu['kode_menu']; ?>"><i class="bi bi-image"></i></a> 
          <a href="" class="btn btn-sm rounded-pill text-white" id="btn_user3" data-bs-toggle="modal" data-bs-target="#hapus<?php echo $row_menu['kode_menu']; ?>"><i class="bi bi-trash"></i></a> 
        </td>                      
        </tr>
        <!-- Modal Edit -->
        <div class="modal fade" id="edit<?php echo $row_menu['kode_menu']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header text-center" id="background_modal">
                <h5 class="modal-title" id="sub_judul5">Edit Menu</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="mb-3 mt-3 ms-3 me-3">
              <form action="" method="post" enctype="multipart/form-data"> 
                <input type="hidden" class="form-control rounded-pill" name="kode_menu"  value="<?= $row_menu["kode_menu"] ?>">
                <div class="mb-3">
                  <label for="disabledSelect" class="form-label ms-1">Kode Menu</label>
                  <input type="text" class="form-control rounded-pill" readonly id="bg-readonly" value="<?= $row_menu["kode_menu"] ?>">
                </div>  
                <div class="mb-3">
                  <label for="disabledSelect" class="form-label ms-1">Nama Menu</label>
                  <input type="text" class="form-control rounded-pill" name="nama_menu" required autofocus autocomplete="off" title="Hanya Bisa Huruf dan Angka" pattern="[A-Za-z0-9 ]+" placeholder="Masukan Nama Menu" value="<?= $row_menu["nama_menu"] ?>">
                </div> 
                <div class="mb-3">
                <input type="hidden" class="form-control" name="kode_kategori"  value="<?= $row_menu['kode_kategori']; ?>">
                    <label class="form-label">Kode dan Nama Kategori</label>
                    <select class="form-select rounded-pill" name="kode_kategori" aria-label="Default select example">
                        <?php $status = $row_menu['kode_kategori']; ?>
                        <!-- Looping -->
                        <?php foreach( $kategori as $row) : ?>
                            <option <?php echo ($status ==  $row["kode_kategori"]) ? "selected": "" ?>>  <?= $row["kode_kategori"]; ?> - <?= $row["nama_kategori"]; ?></option>
                        <?php endforeach ?>
                    </select>
                </div>   
                <div class="mb-3">
                  <label class="form-label">Harga</label>
                  <input type="text" class="form-control rounded-pill" name="harga" required autocomplete="off" title="Hanya Bisa Angka dan Tidak Boleh Ada Space" pattern="[0-9]+" placeholder="Masukan Harga" value="<?= $row_menu["harga"]; ?>">
                </div>  
                <div class="d-grid gap-2">
                  <button type="submit" name="edit" class="btn text-white rounded-pill" id="btn_user">Simpan</button>
                </div>
              </form>
              </div>
              </div>
          </div>
        </div>
        <!-- Modal Ganti Foto -->
        <div class="modal fade" id="ganti_foto<?php echo $row_menu['kode_menu']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header text-center" id="background_modal">
                <h5 class="modal-title" id="sub_judul5">Ganti Foto Menu</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="mb-3 mt-3 ms-3 me-3">
              <form action="" method="post" enctype="multipart/form-data"> 
                <input type="hidden" class="form-control rounded-pill" name="kode_menu"  value="<?= $row_menu["kode_menu"] ?>">
                <!-- Foto Lama -->
                <div class="row justify-content-center">
                <div class="card col-lg-5">
                  <img src="../img/foto/<?php echo $row_menu['foto'];?>" alt="Foto Profil" class="img-fluid mt-2 mb-2 rounded w-100">
                </div>
                </div>
                <!-- Input Foto -->
                <div class="mb-3">
                  <label for="formFile" class="form-label ms-1">Foto Baru</label>
                  <input class="form-control rounded-pill" required name="foto" type="file"">
                </div>
                <h6 class="mt-2 mb-2 text-danger"><b>Ketentuan :</b><br>1. Ketentuan Foto Menu Harus (.jpg), (.png), (.jpeg)<br>2. Ukuran File Maksimal 1 MB</h6>
                
                <div class="row">
                  <div class="col-lg-6 mb-2 mt-1">
                  <div class="d-grid gap-2">
                    <a href="" class="btn btn-md rounded-pill text-white" id="btn_user3" data-bs-toggle="modal" data-bs-target="#detail<?php echo $row['id'] ?>">Batal</a>                
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
        <!-- Modal Hapus -->
        <div class="modal fade" id="hapus<?php echo $row_menu['kode_menu']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header text-center" id="background_modal">
                <h5 class="modal-title" id="sub_judul5">Hapus Menu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="mb-4 ms-3 me-3 text-center">
              <form action="" method="post"  enctype="multipart/form-data"> 
                <img src="../img/icon_warning.png" class="img-fluid w-25 mb-3" id="gambar_effect" alt="Warning">
                <input type="hidden" class="form-control rounded-pill" name="kode_menu"  value="<?= $row_menu["kode_menu"] ?>">
                <P>Anda Yakin Akan Menghapus Menu Dengan Kode Menu <b><?= $row_menu["kode_menu"] ?></b>?
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

<!-- MODAL -->
<!-- Modal Tambah -->
<div class="modal fade" id="tambah" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header text-center" id="background_modal">
        <h5 class="modal-title" id="sub_judul5">Tambah Menu</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="mt-2 mb-3 ms-3 me-3">
      <form action="" method="post" enctype="multipart/form-data"> 
        <div class="mb-3">
          <label for="disabledSelect" class="form-label ms-1">Nama Menu</label>
          <input type="text" class="form-control rounded-pill" name="nama_menu" required autocomplete="off" title="Hanya Bisa Huruf dan Angka" pattern="[A-Za-z0-9 ]+" autofocus placeholder="Masukan Nama Menu">
        </div> 
        <div class="mb-3">
          <label class="form-label">Kode Dan Nama Kategori</label>
          <select class="form-select rounded-pill" name="kode_kategori" id="kode_kategori" aria-label="Default select example">
            <!-- Looping -->
            <?php foreach( $kategori as $row) : ?>
              <option value="<?= $row["kode_kategori"] ?>"><?= $row["kode_kategori"] ?> - <?= $row["nama_kategori"] ?></option>
            <?php endforeach ?>
          </select>
        </div> 
        <div class="mb-3">
          <label for="disabledSelect" class="form-label ms-1">Harga</label>
          <input type="text" class="form-control rounded-pill" name="harga" required autocomplete="off" title="Hanya Bisa Angka dan Tidak Boleh Ada Space" pattern="[0-9]+" placeholder="Masukan Harga">
        </div> 
        <div class="mb-3">
          <label for="formFile" class="form-label ms-1">Gambar Menu</label>
          <input class="form-control rounded-pill" required name="foto" type="file" id="formFile">
        </div>
        <h6 class="mt-2 mb-2 text-danger"><b>Ketentuan :</b><br>1. Ketentuan Foto Menu Harus (.jpg), (.png), (.jpeg)<br>2. Ukuran File Maksimal 1 MB</h6>      
        <div class="d-grid gap-2">
          <button type="submit" name="tambah" class="btn text-white rounded-pill" id="btn_user">Simpan</button>
        </div>
      </form>
      </div>
  </div>
</div>

<!-- Script -->
<?php include '../kerangka/sweet_alert.php'; ?>

<?php   
    if(isset($bukan_foto_menu)) {
      echo "<script> bukan_foto_menu(); </script>";
    }else if(isset($tambah_menu_berhasil)){
      echo "<script> tambah_menu_berhasil(); </script>";
    }else if(isset($ukuran_foto_menu)){
      echo "<script> ukuran_foto_menu(); </script>";
    }else if(isset($hapus_menu_berhasil)){
      echo "<script> hapus_menu_berhasil(); </script>";
    }else if(isset($hapus_menu_gagal)){
      echo "<script> hapus_menu_gagal(); </script>";
    }
    else if(isset($edit_menu_berhasil)){
      echo "<script> edit_menu_berhasil(); </script>";
    }else if(isset($edit_menu_gagal)){
      echo "<script> edit_menu_gagal(); </script>";
    }
    else if(isset($ganti_foto_menu_berhasil)){
      echo "<script> ganti_foto_menu_berhasil(); </script>";
    }
    else{
      exit;
    };
?>
</body>
</html>
