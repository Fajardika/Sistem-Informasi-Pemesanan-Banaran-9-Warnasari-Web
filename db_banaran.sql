-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 03 Jan 2023 pada 03.21
-- Versi server: 10.4.25-MariaDB
-- Versi PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_banaran`
--

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `data_favorit`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `data_favorit` (
`kode_favorit` int(5)
,`username` varchar(100)
,`nama_menu` varchar(100)
,`foto` varchar(100)
,`harga` int(10)
,`nama_kategori` varchar(100)
);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `data_laporan`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `data_laporan` (
`kode_pembayaran` varchar(15)
,`kode_pemesanan` varchar(15)
,`nama` varchar(255)
,`nama_pembeli` varchar(100)
,`no_meja` int(5)
,`tanggal` datetime
,`total` int(10)
);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `data_pembayaran`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `data_pembayaran` (
`kode_pembayaran` varchar(15)
,`kode_pemesanan` varchar(15)
,`nama_pembeli` varchar(100)
,`no_meja` int(5)
,`tanggal` datetime
,`total` int(10)
);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `data_pemesanan`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `data_pemesanan` (
`kode_pemesanan` varchar(15)
,`id` int(11)
,`username` varchar(100)
,`nama` varchar(255)
,`nama_pembeli` varchar(100)
,`no_meja` int(5)
,`catatan` text
,`keterangan` enum('Pending','Proses','Selesai','Lunas')
,`tanggal_pemesanan` datetime
);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `detail_menu`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `detail_menu` (
`kode_menu` int(5)
,`foto` varchar(100)
,`nama_menu` varchar(100)
,`kode_kategori` int(5)
,`nama_kategori` varchar(100)
,`harga` int(10)
);

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_pemesanan`
--

CREATE TABLE `detail_pemesanan` (
  `kode_detail_pemesanan` int(5) NOT NULL,
  `kode_pemesanan` varchar(15) DEFAULT NULL,
  `kode_menu` int(5) DEFAULT NULL,
  `jumlah` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `detail_pemesanan`
--

INSERT INTO `detail_pemesanan` (`kode_detail_pemesanan`, `kode_pemesanan`, `kode_menu`, `jumlah`) VALUES
(1, '1196593285', 20002, 1),
(2, '1196593285', 20007, 1),
(3, '1196593285', 10011, 1),
(6, '8186391177', 20002, 1),
(7, '8186391177', 10011, 1);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `detail_pesanan`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `detail_pesanan` (
`kode_pemesanan` varchar(15)
,`nama` varchar(255)
,`nama_pembeli` varchar(100)
,`no_meja` int(5)
,`tanggal_pemesanan` datetime
,`catatan` text
,`keterangan` enum('Pending','Proses','Selesai','Lunas')
,`kode_detail_pemesanan` int(5)
,`kode_menu` int(5)
,`nama_menu` varchar(100)
,`nama_kategori` varchar(100)
,`harga` int(10)
,`jumlah` int(5)
);

-- --------------------------------------------------------

--
-- Struktur dari tabel `favorit`
--

CREATE TABLE `favorit` (
  `kode_favorit` int(5) NOT NULL,
  `id_pelanggan` int(5) DEFAULT NULL,
  `kode_menu` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `favorit`
--

INSERT INTO `favorit` (`kode_favorit`, `id_pelanggan`, `kode_menu`) VALUES
(1, 5, 20012),
(2, 5, 20010),
(3, 5, 20007),
(4, 5, 20030),
(5, 5, 20020);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `kode_kategori` int(5) NOT NULL,
  `nama_kategori` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`kode_kategori`, `nama_kategori`) VALUES
(7, 'Makanan'),
(8, 'Minuman');

-- --------------------------------------------------------

--
-- Struktur dari tabel `menu`
--

CREATE TABLE `menu` (
  `kode_menu` int(5) NOT NULL,
  `kode_kategori` int(5) DEFAULT NULL,
  `nama_menu` varchar(100) DEFAULT NULL,
  `foto` varchar(100) DEFAULT NULL,
  `harga` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `menu`
--

INSERT INTO `menu` (`kode_menu`, `kode_kategori`, `nama_menu`, `foto`, `harga`) VALUES
(10001, 8, 'Hot Coffee Latte', '636705b4f3182.png', 19000),
(10002, 8, 'Hot Macchiato', '636705bf0ae00.png', 20000),
(10003, 8, 'Hot Moccacino', '636705c897661.png', 22500),
(10004, 8, 'Hot Cappuccino', '636705d40cfc8.png', 19500),
(10005, 8, 'Hot Choco Latte', '636705de762f6.png', 20500),
(10006, 8, 'Black Coffee', '636705e88ab94.png', 17000),
(10007, 8, 'Expreso Coffee', '636705f257832.png', 17000),
(10008, 8, 'Special Coffee', '63670600a3bec.png', 10000),
(10009, 8, 'Tubruk Coffee', '6367060c098c7.png', 9000),
(10010, 8, 'Lemon Tea', '63670876aa4e2.png', 7000),
(10011, 8, 'Es Black Tea', '63670883e9b30.png', 6500),
(10012, 8, 'Es Tea Cream', '63670890b4511.png', 8000),
(10013, 8, 'Es Lemon Tea', '6367089d50adb.png', 8000),
(10014, 8, 'Tea Latte', '636708a9475f1.png', 19000),
(10015, 8, 'Poci Tea', '636708b6518c5.png', 18000),
(10016, 8, 'Es Macchiato', '636708c41e1a7.png', 20500),
(10017, 8, 'Es Moccacino', '636708d818ee8.png', 23500),
(10018, 8, 'Es Choco Latte', '636708e81e59c.png', 21000),
(10019, 8, 'Es Coffee Latte', '636708f4a3439.png', 20500),
(10020, 8, 'Es Cappucino', '63670901b3119.png', 20500),
(10021, 8, 'Es Kopi Cream', '6367093bbe929.png', 14500),
(10022, 8, 'Juice Banana Coffee', '6367092e6a458.png', 13000),
(10023, 8, 'Wedang Jahe', '636707d4ea6c1.png', 10000),
(10024, 8, 'Susu Jahe', '636707e2b791d.png', 10000),
(10025, 8, 'Wedang Uwuh', '636707f65dec6.png', 11000),
(10026, 8, 'Es Jeruk Nipis', '636706c631d3e.png', 11000),
(10027, 8, 'Es Soda Gembira', '636706d3a0579.png', 15000),
(10028, 8, 'Jeruk Panas', '636706e12ee90.png', 8000),
(10029, 8, 'Jeruk Nipis Panas', '636706fcb1fc3.png', 10000),
(10030, 8, 'Jus Alpukat', '6367070f81877.png', 14000),
(10031, 8, 'Jus Anti Kolesterol ', '6367071d84c64.png', 10000),
(10032, 8, 'Jus Apel', '6367072bc7040.png', 10000),
(10033, 8, 'Jus Leci', '63670744db4da.png', 12000),
(10034, 8, 'Jus Jeruk', '636707553ec2a.png', 10000),
(10035, 8, 'Jus Mangga', '63670761e9904.png', 12000),
(10036, 8, 'Jus Melon', '636707706a47e.png', 10000),
(10037, 8, 'Jus Sirsak', '6367077dcfc8a.png', 14000),
(10038, 8, 'Jus Seledri', '6367078e6fc20.png', 7000),
(10039, 8, 'Jus Strawberry', '6367079ad3416.png', 12000),
(10040, 8, 'Jus Tomat', '636707a761471.png', 10000),
(20001, 7, 'Nasi Timbel', '63670b475d8b1.png', 27000),
(20002, 7, 'Ikan Bakar', '63670b5fdf1a9.png', 20000),
(20003, 7, 'Nasi Rawon', '63670b6cdb6fe.png', 35000),
(20004, 7, 'Nasi Ayam Goreng', '63670b78d7774.png', 25000),
(20005, 7, 'Nasi Ayam Kosek', '63670b868be2d.png', 25000),
(20006, 7, 'Nasi Ayam Kremes', '63670b9a69fcc.png', 26000),
(20007, 7, 'Iga Bakar', '63670ba8eada5.png', 32000),
(20008, 7, 'Nasi Pecel Telur', '63670bb72b34c.png', 18000),
(20009, 7, 'Pecel Lele', '63670bc5038b3.png', 20000),
(20010, 7, 'Gado-Gado', '63670bd886439.png', 18000),
(20011, 7, 'Nasi Goreng Kremes', '63670be61101d.png', 18000),
(20012, 7, 'Cah Kangkung', '63670bf5b6a1d.png', 12000),
(20013, 7, 'Nasi Goreng Hijau', '63670c00dc203.png', 18000),
(20014, 7, 'Nasi Ayam Banaran', '63670c0df08b5.png', 27000),
(20015, 7, 'Sop Iga', '63670c2b2ad7a.png', 32000),
(20016, 7, 'Nasi Soto Banaran', '63670c3956ce9.png', 20000),
(20017, 7, 'Mie Goreng Jawa', '63670c4722ad9.png', 17000),
(20018, 7, 'Nasi Goreng Merah', '63670c54942bd.png', 18000),
(20019, 7, 'Mie Kuah Jawa', '63670c64b3956.png', 17000),
(20020, 7, 'Mie Goreng', '63670c7531c5b.png', 18000),
(20021, 7, 'Nasi Goreng Putih', '63670c8ad0ee0.png', 18000),
(20022, 7, 'Mie Kuah', '63670c9acbc1e.png', 15000),
(20023, 7, 'Snack Kombinasi', '63670ca77eb34.png', 11000),
(20024, 7, 'Kentang Goreng', '63670cb8bd256.png', 11000),
(20025, 7, 'Pisang Madu', '63670cc5bb2a4.png', 11000),
(20026, 7, 'Tahu Goreng', '63670cd1a61a5.png', 2000),
(20027, 7, 'Mendoan', '63670cdf21cce.png', 8000),
(20028, 7, 'Pisang Goreng', '63670e36eaf6c.png', 10000),
(20029, 7, 'Ketela Goreng', '63670e82bf366.png', 7500),
(20030, 7, 'Ketela Keju', '63670d1c19811.png', 12000),
(20031, 7, 'Pisang Penyet', '63670e95d5129.png', 11000),
(20032, 7, 'Pisang Keju', '63670d4cc6579.png', 13000);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `menu_makanan`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `menu_makanan` (
`kode_menu` int(5)
,`nama_menu` varchar(100)
,`foto` varchar(100)
,`harga` int(10)
,`nama_kategori` varchar(100)
);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `menu_minuman`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `menu_minuman` (
`kode_menu` int(5)
,`nama_menu` varchar(100)
,`foto` varchar(100)
,`harga` int(10)
,`nama_kategori` varchar(100)
);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayaran`
--

CREATE TABLE `pembayaran` (
  `kode_pembayaran` varchar(15) NOT NULL,
  `kode_pemesanan` varchar(15) DEFAULT NULL,
  `tanggal` datetime DEFAULT NULL,
  `total` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pembayaran`
--

INSERT INTO `pembayaran` (`kode_pembayaran`, `kode_pemesanan`, `tanggal`, `total`) VALUES
('1117939914', '1196593285', '2022-12-14 09:13:10', 58500);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemesanan`
--

CREATE TABLE `pemesanan` (
  `kode_pemesanan` varchar(15) NOT NULL,
  `id_pelayan` int(10) DEFAULT NULL,
  `nama_pembeli` varchar(100) DEFAULT NULL,
  `no_meja` int(5) DEFAULT NULL,
  `tanggal_pemesanan` datetime DEFAULT NULL,
  `catatan` text NOT NULL DEFAULT '-',
  `keterangan` enum('Pending','Proses','Selesai','Lunas') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pemesanan`
--

INSERT INTO `pemesanan` (`kode_pemesanan`, `id_pelayan`, `nama_pembeli`, `no_meja`, `tanggal_pemesanan`, `catatan`, `keterangan`) VALUES
('1196593285', 2, 'Fadhlika', 1, '2022-12-14 09:03:34', '-', 'Lunas'),
('8186391177', 3, 'Mamur', 12, '2022-12-14 09:11:17', '-', 'Proses');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengguna`
--

CREATE TABLE `pengguna` (
  `id` int(11) NOT NULL,
  `foto` varchar(100) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `jenis_kelamin` enum('Laki-Laki','Perempuan') DEFAULT NULL,
  `no_telp` varchar(13) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `level` enum('Admin','Pelayan','Kasir','Chef','Pelanggan') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pengguna`
--

INSERT INTO `pengguna` (`id`, `foto`, `nama`, `jenis_kelamin`, `no_telp`, `alamat`, `username`, `password`, `level`) VALUES
(1, '637640374b45a.png', 'Ajiz Suhendar', 'Laki-Laki', '082124864187', 'Cilacap RT02/RW12, Panulisan Timur, Dayeuhluhur, Cilacap', 'admin', '$2y$10$3kptKfYqMzvliruYwigpEurdwiRPZDj9hrg1QUVqqqNhHt/2QVHhm', 'Admin'),
(2, '637640a2bbaba.png', 'Gisela Azhmarini', 'Perempuan', '082124864187', 'Cilacap RT02/RW12, Panulisan Timur, Dayeuhluhur, Cilacap', 'pelayan1', '$2y$10$kXvPTSejYLJclWvCpyr/3uU40c48M6cYC51sO1k1yZaIrnvon3eH2', 'Pelayan'),
(3, '6376409709122.png', 'Tanti Puteri', 'Perempuan', '082124864187', 'Cilacap RT02/RW12, Panulisan Timur, Dayeuhluhur, Cilacap', 'pelayan2', '$2y$10$u4jlWAOhAzLdoQXumMoByuuNqigJutPKHgsGhUgjm2BHHbZvz/Xc.', 'Pelayan'),
(4, '63764087cec68.png', 'Susi Susanti', 'Perempuan', '082124864187', 'Cilacap RT02/RW12, Panulisan Timur, Dayeuhluhur, Cilacap', 'koki1', '$2y$10$OCrCBDa8/DJc.qUQK3TsK.BF9rM/vKbDjRE1k2AJcE2UR/R2r7twK', 'Chef'),
(5, '63992edd6e16c.png', 'Fajardika Dwi Yulianto', 'Laki-Laki', '082124864187', 'Cilacap RT02/RW12, Panulisan Timur, Dayeuhluhur, Cilacap.', 'pengguna', '$2y$10$yyxDe3FJI6xoTNZ8N0bViebnB/9mUjWxYFuDYwoR.fLmHcxeU3gwa', 'Pelanggan'),
(6, '637640ddd1ff2.png', 'Shabrina Azhmarini Puteri', 'Perempuan', '082124567182', 'Cilacap', 'pengguna2', '$2y$10$L4aZY/xbUwfcgSn7P4Jn7O5m2bVOSLzD8bbfVFkam9hNFBwPXIvZW', 'Pelanggan'),
(7, '6376463c27b38.png', 'Putera Adzam', 'Laki-Laki', '082123456654', 'Cilacap RT02/RW12, Panulisan Timur, Dayeuhluhur, Cilacap', 'kasir1', '$2y$10$Wt0ulWCe4htBy.sFFW163OaYf9t08gwkAuhZz0T1zbQIiBN.OJeLy', 'Kasir');

-- --------------------------------------------------------

--
-- Struktur untuk view `data_favorit`
--
DROP TABLE IF EXISTS `data_favorit`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `data_favorit`  AS SELECT `favorit`.`kode_favorit` AS `kode_favorit`, `pengguna`.`username` AS `username`, `menu`.`nama_menu` AS `nama_menu`, `menu`.`foto` AS `foto`, `menu`.`harga` AS `harga`, `kategori`.`nama_kategori` AS `nama_kategori` FROM (((`favorit` join `pengguna`) join `menu`) join `kategori`) WHERE `pengguna`.`id` = `favorit`.`id_pelanggan` AND `favorit`.`kode_menu` = `menu`.`kode_menu` AND `menu`.`kode_kategori` = `kategori`.`kode_kategori``kode_kategori`  ;

-- --------------------------------------------------------

--
-- Struktur untuk view `data_laporan`
--
DROP TABLE IF EXISTS `data_laporan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `data_laporan`  AS SELECT `pembayaran`.`kode_pembayaran` AS `kode_pembayaran`, `pemesanan`.`kode_pemesanan` AS `kode_pemesanan`, `pengguna`.`nama` AS `nama`, `pemesanan`.`nama_pembeli` AS `nama_pembeli`, `pemesanan`.`no_meja` AS `no_meja`, `pembayaran`.`tanggal` AS `tanggal`, `pembayaran`.`total` AS `total` FROM ((`pemesanan` join `pembayaran`) join `pengguna`) WHERE `pemesanan`.`kode_pemesanan` = `pembayaran`.`kode_pemesanan` AND `pengguna`.`id` = `pemesanan`.`id_pelayan` AND `pemesanan`.`keterangan` = 'Lunas''Lunas'  ;

-- --------------------------------------------------------

--
-- Struktur untuk view `data_pembayaran`
--
DROP TABLE IF EXISTS `data_pembayaran`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `data_pembayaran`  AS SELECT `pembayaran`.`kode_pembayaran` AS `kode_pembayaran`, `pemesanan`.`kode_pemesanan` AS `kode_pemesanan`, `pemesanan`.`nama_pembeli` AS `nama_pembeli`, `pemesanan`.`no_meja` AS `no_meja`, `pembayaran`.`tanggal` AS `tanggal`, `pembayaran`.`total` AS `total` FROM ((`pembayaran` join `pemesanan`) join `pengguna`) WHERE `pembayaran`.`kode_pemesanan` = `pemesanan`.`kode_pemesanan` AND `pengguna`.`id` = `pemesanan`.`id_pelayan``id_pelayan`  ;

-- --------------------------------------------------------

--
-- Struktur untuk view `data_pemesanan`
--
DROP TABLE IF EXISTS `data_pemesanan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `data_pemesanan`  AS SELECT `pemesanan`.`kode_pemesanan` AS `kode_pemesanan`, `pengguna`.`id` AS `id`, `pengguna`.`username` AS `username`, `pengguna`.`nama` AS `nama`, `pemesanan`.`nama_pembeli` AS `nama_pembeli`, `pemesanan`.`no_meja` AS `no_meja`, `pemesanan`.`catatan` AS `catatan`, `pemesanan`.`keterangan` AS `keterangan`, `pemesanan`.`tanggal_pemesanan` AS `tanggal_pemesanan` FROM (`pemesanan` join `pengguna`) WHERE `pemesanan`.`id_pelayan` = `pengguna`.`id` ORDER BY `pemesanan`.`tanggal_pemesanan` ASC  ;

-- --------------------------------------------------------

--
-- Struktur untuk view `detail_menu`
--
DROP TABLE IF EXISTS `detail_menu`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `detail_menu`  AS SELECT `menu`.`kode_menu` AS `kode_menu`, `menu`.`foto` AS `foto`, `menu`.`nama_menu` AS `nama_menu`, `kategori`.`kode_kategori` AS `kode_kategori`, `kategori`.`nama_kategori` AS `nama_kategori`, `menu`.`harga` AS `harga` FROM (`menu` join `kategori`) WHERE `menu`.`kode_kategori` = `kategori`.`kode_kategori``kode_kategori`  ;

-- --------------------------------------------------------

--
-- Struktur untuk view `detail_pesanan`
--
DROP TABLE IF EXISTS `detail_pesanan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `detail_pesanan`  AS SELECT `pemesanan`.`kode_pemesanan` AS `kode_pemesanan`, `pengguna`.`nama` AS `nama`, `pemesanan`.`nama_pembeli` AS `nama_pembeli`, `pemesanan`.`no_meja` AS `no_meja`, `pemesanan`.`tanggal_pemesanan` AS `tanggal_pemesanan`, `pemesanan`.`catatan` AS `catatan`, `pemesanan`.`keterangan` AS `keterangan`, `detail_pemesanan`.`kode_detail_pemesanan` AS `kode_detail_pemesanan`, `menu`.`kode_menu` AS `kode_menu`, `menu`.`nama_menu` AS `nama_menu`, `kategori`.`nama_kategori` AS `nama_kategori`, `menu`.`harga` AS `harga`, `detail_pemesanan`.`jumlah` AS `jumlah` FROM ((((`pengguna` join `pemesanan`) join `detail_pemesanan`) join `menu`) join `kategori`) WHERE `pengguna`.`id` = `pemesanan`.`id_pelayan` AND `detail_pemesanan`.`kode_pemesanan` = `pemesanan`.`kode_pemesanan` AND `menu`.`kode_menu` = `detail_pemesanan`.`kode_menu` AND `kategori`.`kode_kategori` = `menu`.`kode_kategori``kode_kategori`  ;

-- --------------------------------------------------------

--
-- Struktur untuk view `menu_makanan`
--
DROP TABLE IF EXISTS `menu_makanan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `menu_makanan`  AS SELECT `menu`.`kode_menu` AS `kode_menu`, `menu`.`nama_menu` AS `nama_menu`, `menu`.`foto` AS `foto`, `menu`.`harga` AS `harga`, `kategori`.`nama_kategori` AS `nama_kategori` FROM (`menu` join `kategori`) WHERE `kategori`.`kode_kategori` = `menu`.`kode_kategori` AND `kategori`.`nama_kategori` = 'Makanan''Makanan'  ;

-- --------------------------------------------------------

--
-- Struktur untuk view `menu_minuman`
--
DROP TABLE IF EXISTS `menu_minuman`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `menu_minuman`  AS SELECT `menu`.`kode_menu` AS `kode_menu`, `menu`.`nama_menu` AS `nama_menu`, `menu`.`foto` AS `foto`, `menu`.`harga` AS `harga`, `kategori`.`nama_kategori` AS `nama_kategori` FROM (`menu` join `kategori`) WHERE `kategori`.`kode_kategori` = `menu`.`kode_kategori` AND `kategori`.`nama_kategori` = 'Minuman''Minuman'  ;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `detail_pemesanan`
--
ALTER TABLE `detail_pemesanan`
  ADD PRIMARY KEY (`kode_detail_pemesanan`),
  ADD KEY `kode_menu` (`kode_menu`),
  ADD KEY `kode_pemesanan` (`kode_pemesanan`);

--
-- Indeks untuk tabel `favorit`
--
ALTER TABLE `favorit`
  ADD PRIMARY KEY (`kode_favorit`),
  ADD KEY `id_pelanggan` (`id_pelanggan`),
  ADD KEY `kode_menu` (`kode_menu`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`kode_kategori`);

--
-- Indeks untuk tabel `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`kode_menu`),
  ADD KEY `menu_ibfk_1` (`kode_kategori`);

--
-- Indeks untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`kode_pembayaran`),
  ADD KEY `no_pemesanan` (`kode_pemesanan`);

--
-- Indeks untuk tabel `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD PRIMARY KEY (`kode_pemesanan`),
  ADD KEY `id_pelayan` (`id_pelayan`);

--
-- Indeks untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `detail_pemesanan`
--
ALTER TABLE `detail_pemesanan`
  MODIFY `kode_detail_pemesanan` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `favorit`
--
ALTER TABLE `favorit`
  MODIFY `kode_favorit` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `kode_kategori` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `menu`
--
ALTER TABLE `menu`
  MODIFY `kode_menu` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20033;

--
-- AUTO_INCREMENT untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `detail_pemesanan`
--
ALTER TABLE `detail_pemesanan`
  ADD CONSTRAINT `detail_pemesanan_ibfk_1` FOREIGN KEY (`kode_pemesanan`) REFERENCES `pemesanan` (`kode_pemesanan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_pemesanan_ibfk_2` FOREIGN KEY (`kode_menu`) REFERENCES `menu` (`kode_menu`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `favorit`
--
ALTER TABLE `favorit`
  ADD CONSTRAINT `favorit_ibfk_1` FOREIGN KEY (`id_pelanggan`) REFERENCES `pengguna` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `menu_ibfk_1` FOREIGN KEY (`kode_kategori`) REFERENCES `kategori` (`kode_kategori`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `pembayaran_ibfk_1` FOREIGN KEY (`kode_pemesanan`) REFERENCES `pemesanan` (`kode_pemesanan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD CONSTRAINT `pemesanan_ibfk_1` FOREIGN KEY (`id_pelayan`) REFERENCES `pengguna` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
