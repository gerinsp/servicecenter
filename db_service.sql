-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 16 Agu 2023 pada 08.20
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_service`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id_admin` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` varchar(500) NOT NULL,
  `telepon` varchar(20) NOT NULL,
  `jeniskelamin` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_barang`
--

CREATE TABLE `tbl_barang` (
  `id_barang` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `nomorservice` varchar(100) NOT NULL,
  `tanggalservice` date NOT NULL,
  `layar` varchar(100) NOT NULL,
  `keyboard` varchar(100) NOT NULL,
  `speaker` varchar(100) NOT NULL,
  `batrei` varchar(100) NOT NULL,
  `casing` varchar(100) NOT NULL,
  `touchpad` varchar(100) NOT NULL,
  `diagnosis` varchar(255) NOT NULL,
  `persiapan` varchar(255) NOT NULL,
  `status` int(11) DEFAULT NULL COMMENT 'jika status = 1 -> status unit masuk\r\njika status = 2 -> status unit diagnosis\r\njika status = 3 -> status persiapan\r\njika status = 4 -> status pengerjaan\r\njika status = 5 -> status selesai'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_pelanggan`
--

CREATE TABLE `tbl_pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `namapelanggan` varchar(100) NOT NULL,
  `merklaptop` varchar(50) NOT NULL,
  `keluhan` varchar(10000) NOT NULL,
  `telepon` varchar(25) NOT NULL,
  `kelengkapan` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_role`
--

CREATE TABLE `tbl_role` (
  `id` int(11) NOT NULL,
  `role` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_role`
--

INSERT INTO `tbl_role` (`id`, `role`) VALUES
(1, 'Owner'),
(2, 'Admin'),
(3, 'Teknisi'),
(4, 'Pelanggan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_teknisi`
--

CREATE TABLE `tbl_teknisi` (
  `id_teknisi` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` varchar(500) NOT NULL,
  `telepon` varchar(20) NOT NULL,
  `jeniskelamin` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(130) NOT NULL,
  `username` varchar(50) NOT NULL,
  `image` varchar(130) NOT NULL,
  `password` varchar(250) NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` int(11) NOT NULL,
  `tanggal_daftar` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_user`
--

INSERT INTO `tbl_user` (`id_user`, `nama`, `username`, `image`, `password`, `role_id`, `is_active`, `tanggal_daftar`) VALUES
(1, 'Owner', 'owner', 'PLL-MP3D005BT-00.jpg', '$2y$10$3r8gHGbgYh0/4xqEBqTFgedJFhf.neGYJx9AVQhrELWdtSXm7AgXK', 1, 1, '2021-01-01'),
(2, 'Admin Saja', 'admin', 'default.png', '$2y$10$p/V0ClrNLzaWnvywodsHdOZGeGAH64ZTq/Hrvuoojt58ZrGjCBVCG', 2, 1, '2021-01-01'),
(3, 'Teknisi', 'teknisi', 'default.png', '$2y$10$gsRlvQpYeSwoC8mvFtuk1OZZg75QUGsA1SpyS3tg92uhucqQ22bEO', 3, 1, '2023-01-05'),
(5, 'Pelanggan', 'pelanggan', 'default.png', '$2y$10$b0Rqz2Qs1NULKb7.y8xEKulLl3ajyhBTEkxr8jZeVnUFhtc0gyJVi', 4, 1, '2022-10-27'),
(47, 'Angga Kusuma', 'anggakusuma', 'default.png', '$2y$10$buRunHFqK52736eFaDW4uOUBXPh2w5aCLVuLwilzNlzKtU43qChxq', 4, 1, '2023-08-15'),
(48, 'Fajar', 'fajar', 'default.png', '$2y$10$cG8IBcmMKPqhdhTaYHYSnuUmj2mLyH84f9nGSprseN.9Kvqlb6Siy', 4, 1, '2023-08-15'),
(49, 'Sri', 'sri', 'default.png', '$2y$10$.7H6AUiAou.JzHBXP4bud.LreZFdAl9zJaKQLbmYU0eXMfu2WMs6m', 4, 1, '2023-08-15'),
(50, 'Wadimor', 'wadimor', 'default.png', '$2y$10$8HJDCMbik99hwjBhFssXueGU8fMfzPhBsUCi5oi2y4mGNWUi2Uvd2', 4, 1, '2023-08-15'),
(51, 'Le Minerale', 'leminerale', 'default.png', '$2y$10$Q1wniGbqoq0XoJZoV8ZQt.NLzgUn467UsfewfNTx87ce7eSFymBQq', 4, 1, '2023-08-15');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indeks untuk tabel `tbl_barang`
--
ALTER TABLE `tbl_barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indeks untuk tabel `tbl_pelanggan`
--
ALTER TABLE `tbl_pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indeks untuk tabel `tbl_role`
--
ALTER TABLE `tbl_role`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_teknisi`
--
ALTER TABLE `tbl_teknisi`
  ADD PRIMARY KEY (`id_teknisi`);

--
-- Indeks untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tbl_barang`
--
ALTER TABLE `tbl_barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tbl_pelanggan`
--
ALTER TABLE `tbl_pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tbl_role`
--
ALTER TABLE `tbl_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `tbl_teknisi`
--
ALTER TABLE `tbl_teknisi`
  MODIFY `id_teknisi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
