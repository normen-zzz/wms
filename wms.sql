-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 11, 2024 at 02:58 PM
-- Server version: 5.7.44
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wms`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id_barang` int(11) NOT NULL,
  `uuid` varchar(100) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `uom` varchar(20) NOT NULL,
  `is_deleted` int(2) NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_barang`, `uuid`, `nama_barang`, `uom`, `is_deleted`, `created_at`, `created_by`) VALUES
(1, 'sakxnskajxnsajkx as', 'bioderm', 'pcs', 0, NULL, 0),
(2, 'f2a4452f51574a46b23a463a3a654a5d', 'kntl', 'pcs', 0, NULL, 0),
(3, 'b3b8ea1738984390b32687873e04528a', 'kntl', 'pcs', 0, NULL, 0),
(4, 'ef8b104a429b4e1981515d3b2c7403eb', 'kntl', 'pcs', 0, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

CREATE TABLE `jabatan` (
  `jabatan_id` int(11) NOT NULL,
  `jabatan_nama` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jabatan`
--

INSERT INTO `jabatan` (`jabatan_id`, `jabatan_nama`) VALUES
(1, 'Barang dan Jasa Keuangan'),
(11, 'Keuangan'),
(12, 'Testing');

-- --------------------------------------------------------

--
-- Table structure for table `rack`
--

CREATE TABLE `rack` (
  `id_rack` int(11) NOT NULL,
  `uuid` varchar(100) NOT NULL,
  `sloc` varchar(100) NOT NULL,
  `zone` varchar(50) NOT NULL,
  `rack` varchar(50) NOT NULL,
  `row` varchar(50) DEFAULT NULL,
  `column_rack` varchar(50) DEFAULT NULL,
  `max_qty` int(11) DEFAULT NULL,
  `uom` varchar(50) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `is_deleted` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rack`
--

INSERT INTO `rack` (`id_rack`, `uuid`, `sloc`, `zone`, `rack`, `row`, `column_rack`, `max_qty`, `uom`, `created_at`, `created_by`, `is_deleted`) VALUES
(1, '97d3bd7146bc4a578efaa7795f5a91c0', '1c', '1', '1', '1', 'c', NULL, 'pcs', '2024-09-11 15:13:27', 3, 0),
(2, '917e22de4b5a4831bd304f8e1964338c', '2c', '1', '1', '2', 'c', 100, 'pcs', '2024-09-11 15:13:47', 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `status_setting` int(1) NOT NULL DEFAULT '0',
  `nama_instansi` varchar(255) NOT NULL,
  `jumbotron_lead_set` varchar(125) NOT NULL,
  `nama_app_absensi` varchar(20) NOT NULL DEFAULT 'Absensi Online',
  `logo_instansi` varchar(255) NOT NULL,
  `timezone` varchar(35) NOT NULL,
  `absen_mulai` varchar(13) NOT NULL,
  `absen_mulai_to` varchar(13) NOT NULL,
  `absen_pulang` varchar(13) NOT NULL,
  `maps_use` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`status_setting`, `nama_instansi`, `jumbotron_lead_set`, `nama_app_absensi`, `logo_instansi`, `timezone`, `absen_mulai`, `absen_mulai_to`, `absen_pulang`, `maps_use`) VALUES
(1, '[Ubah Nama Instansi]', '[Ubah Text Berjalan Halaman Depan Disini Pada Setting Aplikasi]', 'Absensi Online', 'default-logo.png', 'Asia/Jakarta', '06:00:00', '11:00:00', '16:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_users` int(11) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role_id` enum('1','2') NOT NULL,
  `photo` varchar(120) DEFAULT NULL,
  `jabatan_id` int(11) NOT NULL,
  `waktu_masuk` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_users`, `nama`, `jenis_kelamin`, `email`, `password`, `role_id`, `photo`, `jabatan_id`, `waktu_masuk`) VALUES
(1, 'Administrator', 'L', 'admin@gmail.com', '$2y$10$VqvV0UfbaEhwfR0v1nQUOOz0SY461B3Q41cwaHiqocwfN5uG9lUge', '1', 'default.png', 10, '2021-05-10'),
(2, 'Gian Akbar', 'L', 'adminku1@gmail.com', '$2y$10$83XE53/1Xh7Vcr289muZ0uqsnI/GYtycEyc98b.VpKX5xgJJ.Cc2e', '2', 'default.png', 0, '2019-04-09'),
(3, 'Teman tugas', 'L', 'adminku12@gmail.com', '$2y$10$lXFwH2lGChG8jt7BToklXuMRQo0rBsX6zGQ.ImlT6sJc14.aVrKfa', '2', '1068538.jpg', 12, '2021-06-20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`jabatan_id`);

--
-- Indexes for table `rack`
--
ALTER TABLE `rack`
  ADD PRIMARY KEY (`id_rack`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_users`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `jabatan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `rack`
--
ALTER TABLE `rack`
  MODIFY `id_rack` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_users` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
