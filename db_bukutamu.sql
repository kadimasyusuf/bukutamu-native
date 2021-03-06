-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 06, 2021 at 11:45 AM
-- Server version: 10.3.25-MariaDB-0ubuntu0.20.04.1
-- PHP Version: 7.3.27-9+ubuntu20.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_bukutamu`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_konsultasi`
--

CREATE TABLE `tb_konsultasi` (
  `id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `waktu` time NOT NULL,
  `nama_pengunjung` varchar(100) NOT NULL,
  `id_pengunjung` int(11) NOT NULL,
  `instansi_perusahaan` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `notelp` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `permasalahan` text NOT NULL,
  `solusi` text DEFAULT NULL,
  `id_pengguna` int(11) DEFAULT NULL,
  `ttd_pengguna` varchar(255) DEFAULT NULL,
  `ttd_pengunjung` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_konsultasi`
--

INSERT INTO `tb_konsultasi` (`id`, `tanggal`, `waktu`, `nama_pengunjung`, `id_pengunjung`, `instansi_perusahaan`, `alamat`, `notelp`, `email`, `permasalahan`, `solusi`, `id_pengguna`, `ttd_pengguna`, `ttd_pengunjung`) VALUES
(1, '2021-02-25', '16:49:34', 'tes', 3, 'tes', 'tes', '081234567890', 'test@gmail.com', 'tes', 'jos', 2, '23022021225917.png', NULL),
(2, '2021-02-26', '16:43:18', 'tes', 3, 'tes', 'tes', '081234567890', 'test@gmail.com', 'tesssss', NULL, NULL, NULL, NULL),
(3, '2021-02-26', '16:43:30', 'woi', 5, 'woi', 'woi', '081234567890', 'woi@gmail.com', 'woi', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_pegawai`
--

CREATE TABLE `tb_pegawai` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `nip` varchar(20) NOT NULL,
  `jabatan` varchar(100) NOT NULL,
  `pangkat` varchar(100) NOT NULL,
  `status` enum('Aktif','Nonaktif') NOT NULL,
  `foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_pegawai`
--

INSERT INTO `tb_pegawai` (`id`, `nama`, `nip`, `jabatan`, `pangkat`, `status`, `foto`) VALUES
(2, 'Teguh Hadi Purwanto', '-', 'Staf', '-', 'Aktif', '23022021225917.png');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pengguna`
--

CREATE TABLE `tb_pengguna` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `is_pegawai` enum('y','t') NOT NULL,
  `level` enum('Super Admin','Pimpinan','Admin') NOT NULL,
  `status` enum('Aktif','Nonaktif') NOT NULL,
  `id_pegawai` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_pengguna`
--

INSERT INTO `tb_pengguna` (`id`, `username`, `password`, `nama_lengkap`, `is_pegawai`, `level`, `status`, `id_pegawai`) VALUES
(3, 'Super Admin', '$2y$10$9qzo1ZoTNT9Qq4Rx4bZrVulz.x3ZZikOZgjiGd5WLi.JDu/7Q.NLC', 'Super Admin', 't', 'Super Admin', 'Aktif', NULL),
(4, 'Admin', '', 'Teguh Hadi Purwanto', 'y', 'Admin', 'Aktif', 2),
(5, 'Pimpinan', '$2y$10$FFhMcNY4.GcOaVcOh6/a6eTNElyz6kDLZ75MGZ/yVD7WbgHKNgAvy', 'Pimpinan', 't', 'Pimpinan', 'Aktif', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_pengunjung`
--

CREATE TABLE `tb_pengunjung` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `instansi_perusahaan` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `notelp` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `kategori` enum('Perusahaan','Perangkat Daerah') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_pengunjung`
--

INSERT INTO `tb_pengunjung` (`id`, `nama`, `instansi_perusahaan`, `alamat`, `notelp`, `email`, `kategori`) VALUES
(3, 'tes', 'tes', 'tes', '081234567890', 'test@gmail.com', 'Perusahaan'),
(4, 'tis', 'tis', 'tis', '0812343589', 'tis@gmail.com', 'Perangkat Daerah'),
(5, 'woi', 'woi', 'woi', '081234567890', 'woi@gmail.com', 'Perangkat Daerah');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Kadimas Yusufathur Rahman', 'yusufathurkadimas@gmail.com', NULL, '$2y$10$oVKhHELD6URSu56kskfzxO1qCTI33vHsEWthgSGUlU3eXCLLOwwTG', NULL, '2021-02-06 00:52:56', '2021-02-06 00:52:56');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_konsultasi`
--
ALTER TABLE `tb_konsultasi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pengunjung` (`id_pengunjung`),
  ADD KEY `id_pengguna` (`id_pengguna`);

--
-- Indexes for table `tb_pegawai`
--
ALTER TABLE `tb_pegawai`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_pengguna`
--
ALTER TABLE `tb_pengguna`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_pengunjung`
--
ALTER TABLE `tb_pengunjung`
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
-- AUTO_INCREMENT for table `tb_konsultasi`
--
ALTER TABLE `tb_konsultasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_pegawai`
--
ALTER TABLE `tb_pegawai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_pengguna`
--
ALTER TABLE `tb_pengguna`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_pengunjung`
--
ALTER TABLE `tb_pengunjung`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
