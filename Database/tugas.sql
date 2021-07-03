-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 03 Jul 2021 pada 17.10
-- Versi server: 10.4.19-MariaDB
-- Versi PHP: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tugas`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `id_barang` varchar(100) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `harga` int(11) NOT NULL,
  `stok` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`id_barang`, `nama_barang`, `harga`, `stok`) VALUES
('554724077', 'Air Jordan 1 Mid', 1649000, 25),
('69XXFIX', 'Nike Jordan Special Edition', 2000000, 55),
('921948102', 'Nike Air More Uptempo \'96', 2389000, 95),
('A01', 'Air Jordan XXXV Low PF', 2459000, 42),
('CJ0781101', 'Jordan Westbrook One Take PF', 998000, 25),
('CV7903411', 'Paris Saint-Germain 2021/22 Stadium Home', 999000, 90),
('CV8121101', 'Jordan Delta 2', 1979000, 20),
('CW2458007', 'Jordan One Take II PF', 1429000, 18),
('CW3146003', 'PG 5 EP', 1649000, 100),
('CZ0170400', 'KD14 EP', 2279000, 10),
('CZ1631100', 'Nike Air Force 1 \'07 Premium', 1979000, 1),
('CZ8295100', 'Jordan Sport DNA', 400000, 100),
('CZ9206008', 'Nike Windrunner A.I.R.Kelly Anna London', 1549000, 20),
('CZ9882492', 'Nike Dri-FIT A.I.R. Kelly Anna London', 429000, 400),
('DA3129100', 'Zion 1 PF', 1649000, 1),
('DA5552107', 'Air Jordan 1 Mid LX', 1799000, 21),
('DB2533-688', 'Liverpool F.C. 2021/22 Match Home', 1979000, 5),
('DD4886100', 'Jordan \'Why Not?\' Zer0.4 PF', 1979000, 10),
('DH5929006', 'Jordan 1 Low', 799000, 20);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembeli`
--

CREATE TABLE `pembeli` (
  `id_pembeli` varchar(100) NOT NULL,
  `nama_pembeli` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pembeli`
--

INSERT INTO `pembeli` (`id_pembeli`, `nama_pembeli`, `email`, `alamat`) VALUES
('CKTPYX6ZKDJ', 'Winda Suartini', 'windni@gmail.com', 'Dk. Katamso No. 217, Bandung 62974, SulTeng'),
('CMOAOU21', 'Galang Sihombing', 'galangng@gmail.com', 'Kpg. Pasir Koja No. 415, Padangsidempuan 76793, Riau'),
('CSMBEO53', 'Edward Situmorang', 'edwaang@gmail.com', 'Psr. Raya Ujungberung No. 131, Cimahi 20551, KalTeng'),
('ELHHVJ2JJOH', 'Eka Lailasari', 'ekalaiari@gmail.com', 'Ki. Kusmanto No. 811, Mataram 59804, NTB'),
('ESATTACH', 'Titin Astuti', 'titinti@gmail.com', 'Jr. Ters. Jakarta No. 764, Depok 93995, Bali'),
('HFXKWZGX', 'Mulyanto Mangunsong', 'mulyang@gmail.com', 'Ki. Salam No. 931, Surakarta 56562, Aceh'),
('IMRTVF2YR41', 'Irnanto Hutapea', 'irnantea@gmail.com', 'Dk. Raya Ujungberung No. 959, Pekalongan 20978, MalUt'),
('IVEBIL0UY2C', 'Shakila Haryanti', 'shakilti@gmail.com', 'Dk. Lembong No. 46, Tomohon 19410, SulTeng'),
('JHNPPNXF', 'Umay Saptono', 'umaysono@gmail.com', 'Dk. Adisumarmo No. 520, Subulussalam 69831, DIY'),
('MMMAEXEKQIE', 'Jumadi Pranowo', 'jumadwo@gmail.com', 'Kpg. Ters. Buah Batu No. 147, Pontianak 15848, KepR'),
('NISFDAE1X3X', 'Rina Hasanah', 'rinanah@gmail.com', 'Jln. Labu No. 553, Bukittinggi 29207, SulTeng'),
('OUGNLJ3J', 'Ina Andriani', 'inaandni@gmail.com', ' Dk. Raya Setiabudhi No. 911, Depok 19907, Bengkulu'),
('RBGXVIH4M54', 'Jaeman Iswahyudi', 'jaemudi@gmail.com', 'Ki. Thamrin No. 334, Lubuklinggau 71079, SulUt'),
('RVHQMEHL', 'Cinthia Padmasari', 'cintri@gmail.com', 'Dk. Tambak No. 70, Batu 10166, Riau'),
('SDASD12SD', 'Rinaldi Hendrawan', 'rinaldih84@gmail.com', 'Jetak Kembang RT 03 RW 05 Kecamatan Kota'),
('SNZBVTPN', 'Ozy Siregar', 'ozysiar@gmail.com', 'Gg. Bagas Pati No. 221, Semarang 26298, SulBar'),
('TVTORXHA', 'Farhunnisa Uyainah', 'farhunah@gmail.com', 'Ds. Bass No. 344, Pasuruan 44160, SulTeng'),
('UUNGGJCV', 'Qori Hartati', 'qoriati@gmail.com', 'Jr. Flores No. 406, Bandar Lampung 37037, Banten'),
('UXRVUTIW', 'Latika Palastri', 'latikri@gmail.com', 'Gg. Nangka No. 606, Sabang 17663, BaBel');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` varchar(100) NOT NULL,
  `id_pembeli` varchar(100) NOT NULL,
  `id_barang` varchar(100) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `id_pembeli`, `id_barang`, `jumlah`, `total`) VALUES
('0a36147b66a5db11c1d7da5a5fc10a3c3641348214845edee356bed1b96656cb', 'CKTPYX6ZKDJ', '921948102', 5, 11945000),
('408919f7a3d3aa93bb6bc9ac304678eb91064f091f62af9fd7c6d052d4c6d1f5', 'CKTPYX6ZKDJ', 'DA3129100', 1, 1649000),
('74de5a1cd41bca7556252c65788ed5ca60ed66cc801aedf9790e1e5be71e498d', 'ELHHVJ2JJOH', '554724077', 3, 4947000),
('7cf62c77bd4a1a1e604fc5dc88ab314f3912fd32bd7e9af57e08f34af627619a', 'JHNPPNXF', 'CJ0781101', 5, 4990000),
('c4dafe7b0d81b109dac4db29b538a22f57531846cc9bcdf344c70754c47ae18c', 'OUGNLJ3J', 'DA5552107', 1, 1799000),
('cfe09c2792967e30e0e05c79046dde5554ca7d406091cbc638b3816c500c6665', 'ESATTACH', 'CV8121101', 2, 3958000),
('d1870b11ed237e64d4740198446010e4364f873b793c4c9dc43429d0bad68d8c', 'UUNGGJCV', 'CV8121101', 2, 3958000),
('d1c1267181d4063184c4a36a7b260fc5eb17bf47916a2318e5b765b213345050', 'ESATTACH', 'CJ0781101', 2, 1996000),
('d388347907cea938ce6494a02c1511fe833286cdb66b1879216f8865f8f19a49', 'IVEBIL0UY2C', 'CJ0781101', 1, 998000),
('e1cb57eeddde1f32f1bca879509639bc9b7f46bf8a0f13234df4665b03190305', 'ELHHVJ2JJOH', 'CZ0170400', 3, 6837000),
('e25e58518b22143240154c26b39c2f5b09af2f08ddd3bd7ccc210d6ce849c50d', 'IVEBIL0UY2C', 'CZ0170400', 2, 4558000),
('eac2cd774e0276977c4b5ffeb30d20302a2c87f3c8ce1533a0cf39f813df4c64', 'NISFDAE1X3X', 'CV8121101', 3, 5937000);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indeks untuk tabel `pembeli`
--
ALTER TABLE `pembeli`
  ADD PRIMARY KEY (`id_pembeli`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `id_pembeli` (`id_pembeli`),
  ADD KEY `id_barang` (`id_barang`);

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_2` FOREIGN KEY (`id_pembeli`) REFERENCES `pembeli` (`id_pembeli`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksi_ibfk_3` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
