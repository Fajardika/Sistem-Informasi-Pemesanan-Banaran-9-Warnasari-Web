<script>
function logout(){
 swal({
      text: "Apakah Anda Yakin Ingin Logout?",
      icon: "warning",
      buttons: [
        'Tidak',
        'Ya'
      ],
      dangerMode: true,
    }).then(function(isConfirm) {
      if (isConfirm) {
        swal({
          text: 'Berhasil Logout',
          icon: 'success',
          dangerMode: true,
        }).then(function() {
           window.location = "logout.php";
        });
      }
    });
}
function logout_2(){
 swal({
      text: "Apakah Anda Yakin Ingin Logout?",
      icon: "warning",
      buttons: [
        'Tidak',
        'Ya'
      ],
      dangerMode: true,
    }).then(function(isConfirm) {
      if (isConfirm) {
        swal({
          text: 'Berhasil Logout',
          icon: 'success',
          dangerMode: true,
        }).then(function() {
           window.location = "../logout.php";
        });
      }
    });
}
function tambah_menu_favorit_berhasil(){
  swal({  text: "Berhasil Menambahkan Menu Ke Favorit",
          icon: "success",
          dangerMode: true,
          closeOnClickOutside: false,
      }).then(function() {
    window.location = "menu.php";
});
}
function tambah_menu_favorit_gagal(){
  swal({  text: "Di Menu Favorit Sudah Ada",
          icon: "error",
          dangerMode: true,
          closeOnClickOutside: false,
      }).then(function() {
    window.location = "menu.php";
});
}
function hapus_menu_favorit_berhasil(){
  swal({  text: "Berhasil Menghapus Menu Favorit",
          icon: "success",
          dangerMode: true,
          closeOnClickOutside: false,
      }).then(function() {
    window.location = "dashboard.php";
});
}
function hapus_menu_favorit_gagal(){
  swal({  text: "Gagal Menghapus Menu Favorit",
          icon: "error",
          dangerMode: true,
          closeOnClickOutside: false,
      }).then(function() {
    window.location = "dashboard.php";
});
}
function ganti_password_pelanggan_berhasil(){
  swal({  text: "Berhasil Menyimpan Password Baru",
          icon: "success",
          dangerMode: true,
          closeOnClickOutside: false,
      }).then(function() {
    window.location = "dashboard.php";
});
}
function edit_pelanggan_berhasil(){
  swal({  text: "Profil Berhasil Diedit",
          icon: "success",
          dangerMode: true,
          closeOnClickOutside: false,
      }).then(function() {
    window.location = "dashboard.php";
});
}
function edit_pelanggan_gagal(){
  swal({  text: "Profil Gagal Diedit",
          icon: "error",
          dangerMode: true,
          closeOnClickOutside: false,
      }).then(function() {
    window.location = "dashboard.php";
});
}
function daftar_akun_berhasil(){
  swal({  text: "Daftar Akun Berhasil",
          icon: "success",
          dangerMode: true,
          closeOnClickOutside: false,
      }).then(function() {
    window.location = "login.php";
});
}
function username_sudah_terdaftar(){
  swal({  text: "Username Sudah Terdaftar, Silahkan Menggunakan Username Lainya",
          icon: "warning",
          dangerMode: true,
          closeOnClickOutside: false,
      }).then(function() {
    window.location = "daftar_akun.php";
});
}
function konfirmasi_password_tidak_sesuai(){
  swal({  text: "Password dan Ulangi Password Tidak Sama",
          icon: "warning",
          dangerMode: true,
          closeOnClickOutside: false,
      }).then(function() {
    window.location = "daftar_akun.php";
});
}
function konfirmasi_password_tidak_sesuai_pelanggan(){
  swal({  text: "Password dan Ulangi Password Tidak Sama",
          icon: "warning",
          dangerMode: true,
          closeOnClickOutside: false,
      }).then(function() {
    window.location = "dashboard.php";
});
}
function username_salah(){
  swal({  text: "Username Salah atau Username Belum Terdaftar",
          icon: "warning",
          dangerMode: true,
          closeOnClickOutside: false,
      }).then(function() {
    window.location = "login.php";
});
}
function password_salah(){
  swal({  text: "Password Yang Anda Masukkan Tidak Sesuai",
          icon: "warning",
          dangerMode: true,
          closeOnClickOutside: false,
      }).then(function() {
    window.location = "login.php";
});
}
function ganti_foto_berhasil(){
  swal({  text: "Foto Profil Berhasil Di Ganti",
          icon: "success",
          dangerMode: true,
          closeOnClickOutside: false,
      }).then(function() {
    window.location = "dashboard.php";
});
}
function bukan_foto(){
  swal({  text: "File Tidak Didukung, Harus Foto",
          icon: "warning",
          dangerMode: true,
          closeOnClickOutside: false,
      }).then(function() {
    window.location = "dashboard.php";
});
}
function ukuran_foto_pelanggan(){
  swal({  text: "Ukuran File Terlalu Besar",
          icon: "warning",
          dangerMode: true,
          closeOnClickOutside: false,
      }).then(function() {
    window.location = "dashboard.php";
});
}

// Admin Pengguna
function tambah_data_pengguna_berhasil(){
  swal({  text: "Tambah Data Pengguna Berhasil",
          icon: "success",
          dangerMode: true,
          closeOnClickOutside: false,
      }).then(function() {
    window.location = "pengguna.php";
});
}
function tambah_data_pengguna_gagal(){
  swal({  text: "Tambah Data Pengguna Gagal",
          icon: "error",
          dangerMode: true,
          closeOnClickOutside: false,
      }).then(function() {
    window.location = "pengguna.php";
});
}
function edit_data_pengguna_berhasil(){
  swal({  text: "Edit Data Pengguna Berhasil",
          icon: "success",
          dangerMode: true,
          closeOnClickOutside: false,
      }).then(function() {
    window.location = "pengguna.php";
});
}
function edit_data_pengguna_gagal(){
  swal({  text: "Edit Data Pengguna Gagal",
          icon: "error",
          dangerMode: true,
          closeOnClickOutside: false,
      }).then(function() {
    window.location = "pengguna.php";
});
}
function bukan_foto_pengguna(){
  swal({  text: "Foto Yang Diupload Tidak Didukung, Harus (.jpg, .png, .jpeg)",
          icon: "warning",
          dangerMode: true,
          closeOnClickOutside: false,
      }).then(function() {
    window.location = "pengguna.php";
});
}
function ukuran_foto(){
  swal({  text: "Ukuran Foto Yang Diupload Terlalu Besar",
          icon: "warning",
          dangerMode: true,
          closeOnClickOutside: false,
      }).then(function() {
    window.location = "pengguna.php";
});
}
function username_pengguna_sudah_terdaftar(){
  swal({  text: "Username Sudah Terdaftar, Silahkan Menggunakan Username Lainya",
          icon: "warning",
          dangerMode: true,
          closeOnClickOutside: false,
      }).then(function() {
    window.location = "pengguna.php";
});
}
function ganti_foto_pengguna_berhasil(){
  swal({  text: "Foto Profil Berhasil Di Ganti",
          icon: "success",
          dangerMode: true,
          closeOnClickOutside: false,
      }).then(function() {
    window.location = "pengguna.php";
});
}
function ganti_password_pengguna_berhasil(){
  swal({  text: "Berhasil Menyimpan Password Baru",
          icon: "success",
          dangerMode: true,
          closeOnClickOutside: false,
      }).then(function() {
    window.location = "pengguna.php";
});
}
function konfirmasi_password_pengguna_tidak_sesuai(){
  swal({  text: "Password dan Ulangi Password Tidak Sama",
          icon: "warning",
          dangerMode: true,
          closeOnClickOutside: false,
      }).then(function() {
    window.location = "pengguna.php";
});
}
function hapus_data_pengguna_berhasil(){
  swal({  text: "Hapus Data Pengguna Berhasil",
          icon: "success",
          dangerMode: true,
          closeOnClickOutside: false,
      }).then(function() {
    window.location = "pengguna.php";
});
}
function hapus_data_pengguna_gagal(){
  swal({  text: "Hapus Data Pengguna Gagal",
          icon: "error",
          dangerMode: true,
          closeOnClickOutside: false,
      }).then(function() {
    window.location = "pengguna.php";
});
}


// Admin Kategori
function tambah_kategori_berhasil(){
  swal({  text: "Kategori Berhasil Ditambahkan",
          icon: "success",
          dangerMode: true,
          closeOnClickOutside: false,
      }).then(function() {
    window.location = "kategori.php";
});
}
function tambah_kategori_gagal(){
  swal({  text: "Kategori Gagal Ditambahkan",
          icon: "error",
          dangerMode: true,
          closeOnClickOutside: false,
      }).then(function() {
    window.location = "kategori.php";
});
}function edit_kategori_berhasil(){
  swal({  text: "Kategori Berhasil Diedit",
          icon: "success",
          dangerMode: true,
          closeOnClickOutside: false,
      }).then(function() {
    window.location = "kategori.php";
});
}
function edit_kategori_gagal(){
  swal({  text: "Kategori Gagal Diedit",
          icon: "error",
          dangerMode: true,
          closeOnClickOutside: false,
      }).then(function() {
    window.location = "kategori.php";
});
}
function hapus_kategori_berhasil(){
  swal({  text: "Kategori Berhasil Dihapus",
          icon: "success",
          dangerMode: true,
          closeOnClickOutside: false,
      }).then(function() {
    window.location = "kategori.php";
});
}
function hapus_kategori_gagal(){
  swal({  text: "Kategori Gagal Dihapus",
          icon: "error",
          dangerMode: true,
          closeOnClickOutside: false,
      }).then(function() {
    window.location = "kategori.php";
});
}

// Admin Menu
function bukan_foto_menu(){
  swal({  text: "Foto Yang Diupload Tidak Didukung, Harus (.jpg, .png, .jpeg)",
          icon: "warning",
          dangerMode: true,
          closeOnClickOutside: false,
      }).then(function() {
    window.location = "menu.php";
});
}
function tambah_menu_berhasil(){
  swal({  text: "Menu Berhasil Ditambahkan",
          icon: "success",
          dangerMode: true,
          closeOnClickOutside: false,
      }).then(function() {
    window.location = "menu.php";
});
}
function ukuran_foto_menu(){
  swal({  text: "Ukuran File Terlalu Besar",
          icon: "warning",
          dangerMode: true,
          closeOnClickOutside: false,
      }).then(function() {
    window.location = "menu.php";
});
}
function hapus_menu_berhasil(){
  swal({  text: "Menu Berhasil Dihapus",
          icon: "success",
          dangerMode: true,
          closeOnClickOutside: false,
      }).then(function() {
    window.location = "menu.php";
});
}
function hapus_menu_gagal(){
  swal({  text: "Menu Gagal Dihapus",
          icon: "error",
          dangerMode: true,
          closeOnClickOutside: false,
      }).then(function() {
    window.location = "menu.php";
});
}
function edit_menu_berhasil(){
  swal({  text: "Menu Berhasil Diedit",
          icon: "success",
          dangerMode: true,
          closeOnClickOutside: false,
      }).then(function() {
    window.location = "menu.php";
});
}
function edit_menu_gagal(){
  swal({  text: "Menu Gagal Diedit",
          icon: "error",
          dangerMode: true,
          closeOnClickOutside: false,
      }).then(function() {
    window.location = "menu.php";
});
}
function ganti_foto_menu_berhasil(){
  swal({  text: "Foto Menu Berhasil Di Ganti",
          icon: "success",
          dangerMode: true,
          closeOnClickOutside: false,
      }).then(function() {
    window.location = "menu.php";
});
}

// Admin Pemesanan
function hapus_pemesanan_berhasil(){
  swal({  text: "Hapus Pemesanan Berhasil",
          icon: "success",
          dangerMode: true,
          closeOnClickOutside: false,
      }).then(function() {
    window.location = "pemesanan.php";
});
}
function hapus_pemesanan_gagal(){
  swal({  text: "Hapus Pemesanan Gagal",
          icon: "error",
          dangerMode: true,
          closeOnClickOutside: false,
      }).then(function() {
    window.location = "pemesanan.php";
});
}

// Admin Pembayaran
function hapus_pembayaran_berhasil(){
  swal({  text: "Hapus Pembayaran Berhasil",
          icon: "success",
          dangerMode: true,
          closeOnClickOutside: false,
      }).then(function() {
    window.location = "pembayaran.php";
});
}
function hapus_pembayaran_gagal(){
  swal({  text: "Hapus Pembayaran Gagal",
          icon: "error",
          dangerMode: true,
          closeOnClickOutside: false,
      }).then(function() {
    window.location = "pembayaran.php";
});
}

// Pelayan
function pemesanan_batal_berhasil(){
  swal({  text: "Pemesanan Berhasil Dibatalkan",
          icon: "success",
          dangerMode: true,
          closeOnClickOutside: false,
      }).then(function() {
    window.location = "index.php";
});
}
function pemesanan_batal_gagal(){
  swal({  text: "Pemesanan Gagal Dibatalkan",
          icon: "error",
          dangerMode: true,
          closeOnClickOutside: false,
      }).then(function() {
    window.location = "index.php";
});
}

function pemesanan_berhasil_diproses(){
  swal({  text: "Pemesanan Berhasil Diproses",
          icon: "success",
          dangerMode: true,
          closeOnClickOutside: false,
      }).then(function() {
    window.location = "index.php";
});
}
function pemesanan_batal_diproses(){
  swal({  text: "Pemesanan Gagal Diproses",
          icon: "error",
          dangerMode: true,
          closeOnClickOutside: false,
      }).then(function() {
    window.location = "index.php";
});
}

function menu_berhasil_ditambahkan(){
  swal({  text: "Menu Berhasil Ditambahkan",
          icon: "success",
          dangerMode: true,
          closeOnClickOutside: false,
      }).then(function() {
    window.location = "pemesanan.php";
});
}
function menu_berhasil_dihapus(){
  swal({  text: "Menu Berhasil Dihapus",
          icon: "success",
          dangerMode: true,
          closeOnClickOutside: false,
      }).then(function() {
    window.location = "pemesanan.php";
});
}


// Koki
function menu_berhasil_dihapus(){
  swal({  text: "Menu Berhasil Dihapus",
          icon: "success",
          dangerMode: true,
          closeOnClickOutside: false,
      }).then(function() {
    window.location = "pemesanan.php";
});
}
function pemesanan_selesai_berhasil(){
  swal({  text: "Pemesanan Selesai",
          icon: "success",
          dangerMode: true,
          closeOnClickOutside: false,
      }).then(function() {
    window.location = "index.php";
});
}
function pemesanan_selesai_gagal(){
  swal({  text: "Pemesanan Gagal Selesai",
          icon: "error",
          dangerMode: true,
          closeOnClickOutside: false,
      }).then(function() {
    window.location = "index.php";
});
}

// Kasir
function pembayaran_berhasil(){
  swal({  text: "Pembayaran Berhasil",
          icon: "success",
          dangerMode: true,
          closeOnClickOutside: false,
      }).then(function() {
    window.location = "index.php";
});
}
function pembayaran_gagal(){
  swal({  text: "Pembayaran Gagal",
          icon: "error",
          dangerMode: true,
          closeOnClickOutside: false,
      }).then(function() {
    window.location = "index.php";
});
}
</script>