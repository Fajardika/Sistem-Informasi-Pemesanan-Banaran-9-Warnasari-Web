<?php 
//koneksi database


$conn = mysqli_connect("localhost", "root", "", "db_banaran");
function query($query) {
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows   = [];
    while($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

// ADMIN
function edit_pengguna($data){
    global $conn;

    $id              = htmlspecialchars($data["id"]);
    $nama            = htmlspecialchars($data["nama"]);
    $no_telp         = htmlspecialchars($data["no_telp"]);
    $jenis_kelamin   = htmlspecialchars($data["jenis_kelamin"]);
    $username        = htmlspecialchars($data["username"]);
    $level           = htmlspecialchars($data["level"]);
    $alamat          = htmlspecialchars($data["alamat"]);
    
    $query = "UPDATE pengguna SET nama = '$nama', no_telp ='$no_telp', jenis_kelamin = '$jenis_kelamin', username = '$username', level = '$level', alamat = '$alamat' WHERE id= $id";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function hapus_pengguna($data){
    global $conn;
    $id   = htmlspecialchars($data["id"]);

    mysqli_query($conn,"DELETE FROM pengguna WHERE id= $id");
    return mysqli_affected_rows($conn);
}

function tambah_kategori($data){
    global $conn;
    $nama_kategori = htmlspecialchars($data["nama_kategori"]);
  
    $query="INSERT INTO kategori (kode_kategori, nama_kategori) values('','$nama_kategori')";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function edit_kategori($data){
    global $conn;

    $kode_kategori   = htmlspecialchars($data["kode_kategori"]);
    $nama_kategori   = htmlspecialchars($data["nama_kategori"]);

    $query = "UPDATE kategori SET nama_kategori ='$nama_kategori' WHERE kode_kategori= $kode_kategori";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function hapus_kategori($data){
    global $conn;
    $kode_kategori   = htmlspecialchars($data["kode_kategori"]);

    mysqli_query($conn,"DELETE FROM kategori WHERE kode_kategori= $kode_kategori");
    return mysqli_affected_rows($conn);
}

function edit_menu($data){
    global $conn;

    $kode_menu       = htmlspecialchars($data["kode_menu"]);
    $kode_kategori   = htmlspecialchars($data["kode_kategori"]);
    $nama_menu       = htmlspecialchars($data["nama_menu"]);
    $harga           = htmlspecialchars($data["harga"]);
    
    $query = "UPDATE menu SET kode_kategori = '$kode_kategori', nama_menu ='$nama_menu', harga = '$harga' WHERE kode_menu= $kode_menu";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function hapus_menu($data){
    global $conn;
    $kode_menu   = htmlspecialchars($data["kode_menu"]);

    mysqli_query($conn,"DELETE FROM menu WHERE kode_menu= $kode_menu");
    return mysqli_affected_rows($conn);
}

function hapus_pemesanan($data){
    global $conn;
    $kode_pemesanan   = htmlspecialchars($data["kode_pemesanan"]);

    mysqli_query($conn,"DELETE FROM pemesanan WHERE kode_pemesanan = $kode_pemesanan");
    return mysqli_affected_rows($conn);
}

function hapus_pembayaran($data){
    global $conn;
    $kode_pembayaran   = htmlspecialchars($data["kode_pembayaran"]);

    mysqli_query($conn,"DELETE FROM pembayaran WHERE kode_pembayaran = $kode_pembayaran");
    return mysqli_affected_rows($conn);
}


// PELANGGAN
function edit_pengguna_pelanggan($data){
    global $conn;

    $id              = htmlspecialchars($data["id"]);
    $nama            = htmlspecialchars($data["nama"]);
    $no_telp         = htmlspecialchars($data["no_telp"]);
    $jenis_kelamin   = htmlspecialchars($data["jenis_kelamin"]);
    $username        = htmlspecialchars($data["username"]);
    $alamat          = htmlspecialchars($data["alamat"]);
    
    $query = "UPDATE pengguna SET nama = '$nama', no_telp ='$no_telp', jenis_kelamin = '$jenis_kelamin', username = '$username', alamat = '$alamat' WHERE id= $id";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function tambah_favorit($data){
    global $conn;
    $kode_menu    = htmlspecialchars($data["kode_menu"]);
    $id_pelanggan = htmlspecialchars($data["id_pelanggan"]);
    $result       = mysqli_query($conn, "SELECT kode_menu FROM favorit WHERE kode_menu= '$kode_menu' AND id_pelanggan='$id_pelanggan'");

    //cek kode menu sudah terdaftar atau belum
    if (mysqli_fetch_assoc($result)) {
        // echo "<script> alert('Menu sudah tersimpan di favorit');</script>";  
    }else{

    $query="INSERT INTO favorit (kode_favorit, id_pelanggan, kode_menu) values('','$id_pelanggan','$kode_menu')";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
    }
}

function hapus_favorit($data){
    global $conn;
    $kode_favorit   = htmlspecialchars($data["kode_favorit"]);

    mysqli_query($conn,"DELETE FROM favorit WHERE kode_favorit = $kode_favorit");
    return mysqli_affected_rows($conn);
}

// PELAYAN
function ganti_keterangan($data){
    global $conn;

    $kode_pemesanan   = htmlspecialchars($data["kode_pemesanan"]);
    $keterangan       = htmlspecialchars($data["keterangan"]);
    $catatan          = htmlspecialchars($data["catatan"]);

    $query = "UPDATE pemesanan SET keterangan ='$keterangan', catatan='$catatan' WHERE kode_pemesanan= $kode_pemesanan";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function hapus_pemesanan_pelayan($data){
    global $conn;
    $kode_pemesanan   = htmlspecialchars($data["kode_pemesanan"]);

    mysqli_query($conn,"DELETE FROM pemesanan WHERE kode_pemesanan= $kode_pemesanan");
    return mysqli_affected_rows($conn);
}

// KOKI
function konfirmasi_pesanan($data){
    global $conn;

    $kode_pemesanan   = htmlspecialchars($data["kode_pemesanan"]);

    $query = "UPDATE pemesanan SET keterangan ='Selesai' WHERE kode_pemesanan= $kode_pemesanan";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

// KASIR
function pembayaran($data){
    global $conn;
    $kode_pembayaran    = randomString(10);
    $kode_pemesanan     = htmlspecialchars($data["kode_pemesanan"]);
    $tanggal_pembayaran = htmlspecialchars($data["tanggal_pembayaran"]);
    $total              = htmlspecialchars($data["total"]);
  
    $query1="INSERT INTO pembayaran (kode_pembayaran, kode_pemesanan, tanggal, total) values('$kode_pembayaran','$kode_pemesanan', '$tanggal_pembayaran','$total')";
    $query2="UPDATE pemesanan SET keterangan = 'Lunas' WHERE kode_pemesanan= $kode_pemesanan";

    mysqli_query($conn, $query1);
    mysqli_query($conn, $query2);
    return mysqli_affected_rows($conn);
}
