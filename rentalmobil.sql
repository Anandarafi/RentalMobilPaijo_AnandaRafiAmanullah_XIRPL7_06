-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 07, 2020 at 08:13 AM
-- Server version: 10.1.35-MariaDB
-- PHP Version: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rentalmobil`
--

-- --------------------------------------------------------

--
-- Table structure for table `detail_transaksi`
--
-- Error reading structure for table rentalmobil.detail_transaksi: #1932 - Table 'rentalmobil.detail_transaksi' doesn't exist in engine
-- Error reading data for table rentalmobil.detail_transaksi: #1064 - You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'FROM `rentalmobil`.`detail_transaksi`' at line 1

-- --------------------------------------------------------

--
-- Table structure for table `jenis_mobil`
--

CREATE TABLE `jenis_mobil` (
  `id_jenis` int(20) NOT NULL,
  `nama_jenis` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga_per_hari` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jenis_mobil`
--

INSERT INTO `jenis_mobil` (`id_jenis`, `nama_jenis`, `harga_per_hari`) VALUES
(1, 'SEDAN', '100000'),
(2, 'MINIBUS', '250000'),
(3, 'SPORT', '400000'),
(4, 'PICKUP', '120000');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(7, '2014_10_12_000000_create_users_table', 1),
(8, '2020_03_31_060252_create_pelanggan_table', 1),
(9, '2020_03_31_060307_create_jenis_mobil_table', 1),
(10, '2020_03_31_060321_create_mobil_table', 1),
(11, '2020_03_31_060334_create_peminjaman_table', 1),
(12, '2020_03_31_060401_create_detail_transaksi_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `mobil`
--

CREATE TABLE `mobil` (
  `id_mobil` int(20) NOT NULL,
  `id_jenis` int(11) NOT NULL,
  `nama_mobil` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `platnomor` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mobil`
--

INSERT INTO `mobil` (`id_mobil`, `id_jenis`, `nama_mobil`, `platnomor`, `created_at`, `updated_at`) VALUES
(1, 1, 'TOYOTA AVANZA', 'B 1234 LO', NULL, NULL),
(4, 2, 'MITSUBISHI MINIBUS', 'B 3215 ASIK', NULL, NULL),
(5, 4, 'MITSUBISHI TRITONGLX', 'L 4 MA', NULL, NULL),
(6, 3, 'LAMBORGHINI AVENTADOR', 'B 4 AJA', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int(20) NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ktp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `nama`, `ktp`, `alamat`, `telp`, `created_at`, `updated_at`) VALUES
(1, 'Faiz Diandra Maulana', 'NIK12315123123', 'MALANG', '0851231251731', NULL, NULL),
(2, 'PAIJO BIN SUPRYADI', 'NIK99999999', 'KENANGAN', '085623124231', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id_peminjaman` int(20) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `id_petugas` int(11) NOT NULL,
  `tgl_peminjaman` date NOT NULL,
  `tgl_pengembalian` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `peminjaman`
--

INSERT INTO `peminjaman` (`id_peminjaman`, `id_pelanggan`, `id_petugas`, `tgl_peminjaman`, `tgl_pengembalian`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2020-04-02', '2020-04-06', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `petugas`
--

CREATE TABLE `petugas` (
  `id` int(20) NOT NULL,
  `nama_petugas` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `petugas`
--

INSERT INTO `petugas` (`id`, `nama_petugas`, `telp`, `username`, `password`, `level`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Ananda Rafi Amanullah', '082231954774', 'anndrf_', '$2y$10$qPqicltS5fsQCGCEa42IpuyquT0xVNTFeCbhhNlBBtuglahuhOlM6', 'admin', NULL, NULL, NULL),
(2, 'PAIJO', '082152415211', 'paijo1', '$2y$10$5KXH9nerrOFPMpeWzJ77O.SFs1YVjFeiCPJ3kbJAXwMJo5yZCgbJm', 'ADMIN', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jenis_mobil`
--
ALTER TABLE `jenis_mobil`
  ADD PRIMARY KEY (`id_jenis`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mobil`
--
ALTER TABLE `mobil`
  ADD PRIMARY KEY (`id_mobil`),
  ADD UNIQUE KEY `id_jenis` (`id_jenis`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id_peminjaman`),
  ADD UNIQUE KEY `id_pelanggan` (`id_pelanggan`,`id_petugas`),
  ADD KEY `id_petugas` (`id_petugas`);

--
-- Indexes for table `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jenis_mobil`
--
ALTER TABLE `jenis_mobil`
  MODIFY `id_jenis` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `mobil`
--
ALTER TABLE `mobil`
  MODIFY `id_mobil` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id_peminjaman` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `petugas`
--
ALTER TABLE `petugas`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `mobil`
--
ALTER TABLE `mobil`
  ADD CONSTRAINT `mobil_ibfk_1` FOREIGN KEY (`id_jenis`) REFERENCES `jenis_mobil` (`id_jenis`);

--
-- Constraints for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD CONSTRAINT `peminjaman_ibfk_1` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id_pelanggan`),
  ADD CONSTRAINT `peminjaman_ibfk_2` FOREIGN KEY (`id_petugas`) REFERENCES `petugas` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
