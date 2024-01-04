-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 04, 2024 at 09:57 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `my-pos`
--

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2021_03_12_095813_create_table_pelanggan', 1),
(4, '2021_03_12_104938_create_table_pemasok', 2),
(5, '2021_03_15_141157_create_table_unit', 3),
(6, '2021_03_15_142415_create_table_kategori', 4),
(7, '2021_03_15_144451_create_table_produk', 5),
(8, '2021_03_17_060802_create_table_penjualan', 6),
(9, '2021_03_17_061254_create_table_keranjang', 7),
(10, '2021_03_17_061921_create_table_penjualan_detail', 8),
(11, '2021_03_17_091558_create_table_pembelian', 9);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) NOT NULL,
  `token` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_keranjang`
--

CREATE TABLE `tbl_keranjang` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_produk` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `diskon` int(11) DEFAULT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pelanggan`
--

CREATE TABLE `tbl_pelanggan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_pelanggan` varchar(191) NOT NULL,
  `email_pelanggan` varchar(191) NOT NULL,
  `no_telp_pelanggan` varchar(191) NOT NULL,
  `alamat_pelanggan` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_pelanggan`
--

INSERT INTO `tbl_pelanggan` (`id`, `nama_pelanggan`, `email_pelanggan`, `no_telp_pelanggan`, `alamat_pelanggan`, `created_at`, `updated_at`) VALUES
(3, 'asep', 'asep@gmail.com', '082215581222', 'pelanggan tetap', '2024-01-04 05:46:16', '2024-01-04 05:46:42'),
(4, 'Ananda', 'Ananda@gmail.com', '08974346656', 'gg. semangka', '2024-01-04 08:49:54', '2024-01-04 08:49:54'),
(5, 'andy', 'andy@gmail.com', '0896524352738', 'gg. pepaya', '2024-01-04 08:50:27', '2024-01-04 08:50:27');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pemasok`
--

CREATE TABLE `tbl_pemasok` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_pemasok` varchar(191) NOT NULL,
  `no_telp_pemasok` varchar(191) NOT NULL,
  `alamat_pemasok` text NOT NULL,
  `keterangan` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_pemasok`
--

INSERT INTO `tbl_pemasok` (`id`, `nama_pemasok`, `no_telp_pemasok`, `alamat_pemasok`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 'Andy', '0812323232', 'jalan pepaya', 'teh gelas', '2021-03-17 02:37:07', '2021-03-17 02:37:07'),
(2, 'asep', '082215581222', 'jalan anggur', 'Saus', '2024-01-04 05:48:16', '2024-01-04 08:38:18');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pembelian`
--

CREATE TABLE `tbl_pembelian` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_produk` int(11) NOT NULL,
  `id_pemasok` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga_satuan` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_penjualan`
--

CREATE TABLE `tbl_penjualan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `no_penjualan` varchar(191) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nama_pelanggan` varchar(191) DEFAULT NULL,
  `no_telp_pelanggan` varchar(191) DEFAULT NULL,
  `alamat_pelanggan` text DEFAULT NULL,
  `total` int(11) NOT NULL,
  `diskon` int(11) DEFAULT NULL,
  `subtotal` int(11) NOT NULL,
  `uang` int(11) NOT NULL,
  `kembali` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_penjualan`
--

INSERT INTO `tbl_penjualan` (`id`, `no_penjualan`, `id_user`, `nama_pelanggan`, `no_telp_pelanggan`, `alamat_pelanggan`, `total`, `diskon`, `subtotal`, `uang`, `kembali`, `created_at`, `updated_at`) VALUES
(8, '0401241704358473', 2, NULL, '-', '-', 18000, 0, 18000, 50000, 32000, '2024-01-04 08:54:57', '2024-01-04 08:54:57');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_penjualan_detail`
--

CREATE TABLE `tbl_penjualan_detail` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_penjualan` int(11) NOT NULL,
  `kode_produk` varchar(191) NOT NULL,
  `nama_produk` varchar(191) NOT NULL,
  `unit` varchar(191) NOT NULL,
  `harga_jual` int(11) NOT NULL,
  `harga_beli` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `diskon_produk` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_penjualan_detail`
--

INSERT INTO `tbl_penjualan_detail` (`id`, `id_penjualan`, `kode_produk`, `nama_produk`, `unit`, `harga_jual`, `harga_beli`, `qty`, `diskon_produk`) VALUES
(1, 1, 'ABC001', 'Sarden', 'Kg', 15000, 10000, 25, 0),
(2, 2, 'ABC002', 'Aqua', 'Pcs', 20000, 10000, 25, 10000),
(3, 3, 'ABC002', 'Aqua', 'Pcs', 20000, 10000, 15, 5000),
(4, 3, 'ABC001', 'Sarden', 'Kg', 15000, 10000, 20, 5000),
(5, 4, 'ABC002', 'Aqua', 'Pcs', 20000, 10000, 10, 1000),
(6, 4, 'ABC001', 'Sarden', 'Kg', 15000, 10000, 25, 0),
(7, 5, 'ABC001', 'Sarden', 'Kg', 15000, 10000, 5, 0),
(8, 6, 'ABC001', 'Sarden', 'Kg', 15000, 10000, 1, 0),
(9, 7, 'ABC002', 'Aqua', 'Pcs', 20000, 10000, 1, 0),
(10, 7, 'ABC001', 'Sarden', 'Kg', 15000, 10000, 1, 0),
(11, 8, 'ABC003', 'Saus', 'Pcs', 1500, 1000, 2, 0),
(12, 8, 'ABC001', 'Sarden', 'Kg', 15000, 10000, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_produk`
--

CREATE TABLE `tbl_produk` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode_produk` varchar(191) NOT NULL,
  `nama_produk` varchar(191) NOT NULL,
  `id_unit` int(11) NOT NULL,
  `harga_produk_beli` int(11) NOT NULL,
  `harga_produk_jual` int(11) NOT NULL,
  `stok_produk` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_produk`
--

INSERT INTO `tbl_produk` (`id`, `kode_produk`, `nama_produk`, `id_unit`, `harga_produk_beli`, `harga_produk_jual`, `stok_produk`, `created_at`, `updated_at`) VALUES
(1, 'ABC001', 'Sarden', 3, 10000, 15000, 130, '2021-03-15 09:56:29', '2024-01-04 08:54:57'),
(3, 'ABC002', 'Aqua', 2, 10000, 20000, 80, '2021-03-15 23:50:56', '2024-01-04 08:31:05'),
(4, 'ABC003', 'Saus', 2, 1000, 1500, 300, '2024-01-04 08:34:59', '2024-01-04 08:54:57');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_unit`
--

CREATE TABLE `tbl_unit` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_unit` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_unit`
--

INSERT INTO `tbl_unit` (`id`, `nama_unit`, `created_at`, `updated_at`) VALUES
(2, 'Pcs', '2021-03-15 07:46:08', '2021-03-15 07:46:08'),
(3, 'Kg', '2021-03-15 09:52:21', '2021-03-15 09:52:21');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `username` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `foto` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `email_verified_at`, `password`, `remember_token`, `foto`, `created_at`, `updated_at`) VALUES
(2, 'Admin', 'admin', 'admin@itera.ac.id', NULL, '$2y$10$ZmrHqCmc7BG0usC9gamEB.1iWah2/tSinV/IlF3iCnwGbstCiRZ4a', NULL, '1704358133.png', '2021-03-15 23:42:04', '2024-01-04 08:48:53'),
(3, 'budi', 'budiman', 'budi@gmail.com', NULL, '$2y$10$mas4rAAbkeDaYlpAKxYGCOQIeBzEUQMDsPIUXjcxHuxTo6gxb9cV.', NULL, 'no-photo.png', '2021-03-22 09:26:38', '2021-03-22 09:26:38'),
(4, 'nandi muhamad ramdhani', 'nandimr', 'nanditarou@gmail.com', NULL, '$2y$10$Ap4Y9XXiuZRHry45W2.wAueRCQWCpNpRPArBz62aihPHaZwi9pMr.', NULL, 'no-photo.png', '2024-01-04 05:43:22', '2024-01-04 05:43:22'),
(5, 'Ananda', 'Ananda12', 'Ananda@gmail.com', NULL, '$2y$10$Fjj1E0b.ztCDgsRV9iUxxe/zHYp4CPMVeu0L4o6HaCiPon/pJljdS', NULL, 'no-photo.png', '2024-01-04 08:40:40', '2024-01-04 08:40:40');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `tbl_keranjang`
--
ALTER TABLE `tbl_keranjang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_pelanggan`
--
ALTER TABLE `tbl_pelanggan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_pemasok`
--
ALTER TABLE `tbl_pemasok`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_pembelian`
--
ALTER TABLE `tbl_pembelian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_penjualan`
--
ALTER TABLE `tbl_penjualan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_penjualan_detail`
--
ALTER TABLE `tbl_penjualan_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_produk`
--
ALTER TABLE `tbl_produk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_unit`
--
ALTER TABLE `tbl_unit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_keranjang`
--
ALTER TABLE `tbl_keranjang`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_pelanggan`
--
ALTER TABLE `tbl_pelanggan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_pemasok`
--
ALTER TABLE `tbl_pemasok`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_pembelian`
--
ALTER TABLE `tbl_pembelian`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_penjualan`
--
ALTER TABLE `tbl_penjualan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_penjualan_detail`
--
ALTER TABLE `tbl_penjualan_detail`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_produk`
--
ALTER TABLE `tbl_produk`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_unit`
--
ALTER TABLE `tbl_unit`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
