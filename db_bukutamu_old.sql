-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 01 Mar 2021 pada 15.41
-- Versi server: 5.7.24
-- Versi PHP: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
-- Struktur dari tabel `tb_konsultasi`
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
  `solusi` text,
  `id_pengguna` int(11) DEFAULT NULL,
  `ttd_pengguna` varchar(255) DEFAULT NULL,
  `ttd_pengunjung` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_konsultasi`
--

INSERT INTO `tb_konsultasi` (`id`, `tanggal`, `waktu`, `nama_pengunjung`, `id_pengunjung`, `instansi_perusahaan`, `alamat`, `notelp`, `email`, `permasalahan`, `solusi`, `id_pengguna`, `ttd_pengguna`, `ttd_pengunjung`) VALUES
(1, '2021-02-25', '16:49:34', 'tes', 3, 'tes', 'tes', '081234567890', 'test@gmail.com', 'tes', 'jos', 2, '23022021225917.png', NULL),
(2, '2021-02-26', '16:43:18', 'tes', 3, 'tes', 'tes', '081234567890', 'test@gmail.com', 'tesssss', NULL, NULL, NULL, NULL),
(3, '2021-02-26', '16:43:30', 'woi', 5, 'woi', 'woi', '081234567890', 'woi@gmail.com', 'woi', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pegawai`
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
-- Dumping data untuk tabel `tb_pegawai`
--

INSERT INTO `tb_pegawai` (`id`, `nama`, `nip`, `jabatan`, `pangkat`, `status`, `foto`) VALUES
(2, 'Teguh Hadi Purwanto', '-', 'Staf', '-', 'Aktif', '23022021225917.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pengguna`
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
-- Dumping data untuk tabel `tb_pengguna`
--

INSERT INTO `tb_pengguna` (`id`, `username`, `password`, `nama_lengkap`, `is_pegawai`, `level`, `status`, `id_pegawai`) VALUES
(1, 'kadimas', '$2y$10$oVKhHELD6URSu56kskfzxO1qCTI33vHsEWthgSGUlU3eXCLLOwwTG', 'Kadimas Yusufathur Rahman', 't', 'Super Admin', 'Aktif', NULL),
(2, 'teguh', '$2y$10$/tUa3lnaAa7sdxBlmBVNW.ND7VXekr2Bc/bI3W5JUpW3/7i2IpNiy', 'Teguh Hadi Purwanto', 'y', 'Admin', 'Aktif', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pengunjung`
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
-- Dumping data untuk tabel `tb_pengunjung`
--

INSERT INTO `tb_pengunjung` (`id`, `nama`, `instansi_perusahaan`, `alamat`, `notelp`, `email`, `kategori`) VALUES
(3, 'tes', 'tes', 'tes', '081234567890', 'test@gmail.com', 'Perusahaan'),
(4, 'tis', 'tis', 'tis', '0812343589', 'tis@gmail.com', 'Perangkat Daerah'),
(5, 'woi', 'woi', 'woi', '081234567890', 'woi@gmail.com', 'Perangkat Daerah');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
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
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Kadimas Yusufathur Rahman', 'yusufathurkadimas@gmail.com', NULL, '$2y$10$oVKhHELD6URSu56kskfzxO1qCTI33vHsEWthgSGUlU3eXCLLOwwTG', NULL, '2021-02-06 00:52:56', '2021-02-06 00:52:56');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_konsultasi`
--
ALTER TABLE `tb_konsultasi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pengunjung` (`id_pengunjung`),
  ADD KEY `id_pengguna` (`id_pengguna`);

--
-- Indeks untuk tabel `tb_pegawai`
--
ALTER TABLE `tb_pegawai`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_pengguna`
--
ALTER TABLE `tb_pengguna`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_pengunjung`
--
ALTER TABLE `tb_pengunjung`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_konsultasi`
--
ALTER TABLE `tb_konsultasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tb_pegawai`
--
ALTER TABLE `tb_pegawai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tb_pengguna`
--
ALTER TABLE `tb_pengguna`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tb_pengunjung`
--
ALTER TABLE `tb_pengunjung`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
