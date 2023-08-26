-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 26, 2023 at 02:05 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

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
-- Table structure for table `tbl_barang`
--

CREATE TABLE `tbl_barang` (
  `id_barang` int NOT NULL,
  `id_pelanggan` int NOT NULL,
  `nomorservice` varchar(100) NOT NULL,
  `layar` varchar(100) NOT NULL,
  `keyboard` varchar(100) NOT NULL,
  `speaker` varchar(100) NOT NULL,
  `batrei` varchar(100) NOT NULL,
  `casing` varchar(100) NOT NULL,
  `touchpad` varchar(100) NOT NULL,
  `diagnosis` varchar(255) NOT NULL,
  `persiapan` varchar(255) NOT NULL,
  `ket_batal` varchar(255) NOT NULL,
  `biaya` int NOT NULL,
  `status` int DEFAULT NULL COMMENT 'jika status = 1 -> status unit masuk\r\njika status = 2 -> status unit diagnosis\r\njika status = 3 -> status persiapan\r\njika status = 4 -> status pengerjaan\r\njika status = 5 -> status selesai'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_barang`
--

INSERT INTO `tbl_barang` (`id_barang`, `id_pelanggan`, `nomorservice`, `layar`, `keyboard`, `speaker`, `batrei`, `casing`, `touchpad`, `diagnosis`, `persiapan`, `ket_batal`, `biaya`, `status`) VALUES
(1, 1, 'SRVC-00001', 'oke', 'oke', 'oke', 'oke', 'oke', 'oke', 'harus ganti lcd', 'persiapan beli lcd', 'kemalahalan hehe', 200000, 6);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pelanggan`
--

CREATE TABLE `tbl_pelanggan` (
  `id_pelanggan` int NOT NULL,
  `namapelanggan` varchar(100) NOT NULL,
  `merklaptop` varchar(50) NOT NULL,
  `keluhan` varchar(10000) NOT NULL,
  `telepon` varchar(25) NOT NULL,
  `kelengkapan` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_pelanggan`
--

INSERT INTO `tbl_pelanggan` (`id_pelanggan`, `namapelanggan`, `merklaptop`, `keluhan`, `telepon`, `kelengkapan`) VALUES
(1, 'Gerin SP', 'Lenovo', 'LCD goyang', '085863865446', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_role`
--

CREATE TABLE `tbl_role` (
  `id` int NOT NULL,
  `role` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_role`
--

INSERT INTO `tbl_role` (`id`, `role`) VALUES
(1, 'Owner'),
(2, 'Admin'),
(3, 'Teknisi'),
(4, 'Pelanggan');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id_user` int NOT NULL,
  `nama` varchar(130) NOT NULL,
  `username` varchar(50) NOT NULL,
  `image` varchar(130) NOT NULL,
  `password` varchar(250) NOT NULL,
  `role_id` int NOT NULL,
  `is_active` int NOT NULL,
  `tanggal_daftar` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id_user`, `nama`, `username`, `image`, `password`, `role_id`, `is_active`, `tanggal_daftar`) VALUES
(1, 'Owner', 'owner', 'PLL-MP3D005BT-00.jpg', '$2y$10$3r8gHGbgYh0/4xqEBqTFgedJFhf.neGYJx9AVQhrELWdtSXm7AgXK', 1, 1, '2021-01-01'),
(2, 'Admin Saja', 'admin', 'default.png', '$2y$10$p/V0ClrNLzaWnvywodsHdOZGeGAH64ZTq/Hrvuoojt58ZrGjCBVCG', 2, 1, '2021-01-01'),
(3, 'Teknisi', 'teknisi', 'default.png', '$2y$10$gsRlvQpYeSwoC8mvFtuk1OZZg75QUGsA1SpyS3tg92uhucqQ22bEO', 3, 1, '2023-01-05'),
(5, 'Pelanggan', 'pelanggan', 'default.png', '$2y$10$b0Rqz2Qs1NULKb7.y8xEKulLl3ajyhBTEkxr8jZeVnUFhtc0gyJVi', 4, 1, '2022-10-27'),
(33, 'Angga Kusuma', 'anggakusuma', 'default.png', '$2y$10$7mNn/UjbVDoWnFNwY954P.iKnoIg5EB6UXQZ6ETAbIKLuDy2d4SJO', 4, 1, '2023-07-23'),
(34, 'Angga Kusuma', 'anggakusuma', 'default.png', '$2y$10$eYorHxGPWUwFQnFWQK6HAuLkh6TcsoDn7/ajSHgMI197azJ3AWgi2', 4, 1, '2023-07-23'),
(35, 'Angga Kusuma', 'anggakusuma', 'default.png', '$2y$10$F3GhROUE0bSi9DTDNqcdpui0r1g7dfHl5rX7XzDFm/JrpEcsMUwiS', 4, 1, '2023-07-23'),
(36, 'Angga Kusuma', 'anggakusuma', 'default.png', '$2y$10$I0FIjfGsPCoJnEOQkRroDe3Inxha7Dh7MA8BqqFRafgki4L2aY0hO', 4, 1, '2023-07-23'),
(37, 'Angga Kusuma Putra', 'anggakusumaputra', 'default.png', '$2y$10$Wujuj2LF9NTE9CtdGykI6.QE4MbuoWZxu8y5ga21TUQmVP2UQehVG', 4, 1, '2023-07-31'),
(38, 'Putra', 'putra', 'default.png', '$2y$10$56VhaKmD0ZS3pdhLwoG4OusPRl9xBJL/dCtqrTzzxpIwDSeQiqu.a', 4, 1, '2023-07-31'),
(39, 'Angga Kusuma', 'anggakusuma', 'default.png', '$2y$10$mzsJWcakEPLFL7pOGlrlReFnw2g8HXIawVfOASMT.Mrsl6hZoA5zC', 4, 1, '2023-07-31'),
(40, 'Fajar', 'fajar', 'default.png', '$2y$10$GmcxYfIVMJsMRWJVCqfN0.FG2RO7nuQ11O9G8gVHwqX3CuH/IqAjK', 4, 1, '2023-07-31'),
(41, 'Gerin SP', 'gerinsp', 'default.png', '$2y$10$zH1nXXjjjSzIvBkmqMS1vu/nNRu.8gN393kB/dR9Hgnmk2gGxc8My', 4, 1, '2023-08-11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_barang`
--
ALTER TABLE `tbl_barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `tbl_pelanggan`
--
ALTER TABLE `tbl_pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indexes for table `tbl_role`
--
ALTER TABLE `tbl_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_barang`
--
ALTER TABLE `tbl_barang`
  MODIFY `id_barang` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_pelanggan`
--
ALTER TABLE `tbl_pelanggan`
  MODIFY `id_pelanggan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_role`
--
ALTER TABLE `tbl_role`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
