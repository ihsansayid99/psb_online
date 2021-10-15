-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 15, 2021 at 02:16 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `psb_online`
--

-- --------------------------------------------------------

--
-- Table structure for table `jurusan`
--

CREATE TABLE `jurusan` (
  `id` char(6) NOT NULL,
  `nama_jurusan` varchar(100) NOT NULL,
  `status` enum('aktif','tidak-aktif') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jurusan`
--

INSERT INTO `jurusan` (`id`, `nama_jurusan`, `status`, `created_at`, `updated_at`) VALUES
('JUR001', 'Rekayasa Perangkat Lunak', 'aktif', '2021-10-14 13:49:21', NULL),
('JUR002', 'Teknik Komputer Jaringan', 'aktif', '2021-10-14 13:49:56', NULL),
('JUR003', 'Teknik Sipil', 'tidak-aktif', '2021-10-14 13:50:03', '2021-10-14 14:04:08'),
('JUR004', 'Administrasi Perkantoran', 'aktif', '2021-10-14 13:50:12', NULL),
('JUR005', 'Pemasaran', 'aktif', '2021-10-14 13:50:21', NULL),
('JUR006', 'Akuntansi', 'aktif', '2021-10-14 14:10:14', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pendaftaran`
--

CREATE TABLE `pendaftaran` (
  `id` char(6) NOT NULL,
  `id_user` char(6) NOT NULL,
  `id_admin` char(6) DEFAULT NULL,
  `nisn` varchar(16) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `no_telp_siswa` varchar(16) NOT NULL,
  `asal_sekolah` varchar(100) NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `foto` varchar(255) NOT NULL,
  `nilai_ebtanas_murni` float NOT NULL,
  `foto_ijazah` varchar(100) NOT NULL,
  `foto_skhun` varchar(100) NOT NULL,
  `minat_id_jurusan_1` char(6) NOT NULL,
  `minat_id_jurusan_2` char(6) NOT NULL,
  `nama_orangtua` varchar(100) NOT NULL,
  `alamat_orangtua` text NOT NULL,
  `no_telp_orangtua` varchar(14) NOT NULL,
  `pekerjaan_orangtua` varchar(50) NOT NULL,
  `gaji_orangtua` varchar(100) NOT NULL,
  `status_pendaftaran` enum('diterima','menunggu-verifikasi-berkas','menunggu-pembayaran','tidak-diterima','cadangan','menunggu-kelulusan') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pendaftaran`
--

INSERT INTO `pendaftaran` (`id`, `id_user`, `id_admin`, `nisn`, `nama_lengkap`, `alamat`, `no_telp_siswa`, `asal_sekolah`, `jenis_kelamin`, `foto`, `nilai_ebtanas_murni`, `foto_ijazah`, `foto_skhun`, `minat_id_jurusan_1`, `minat_id_jurusan_2`, `nama_orangtua`, `alamat_orangtua`, `no_telp_orangtua`, `pekerjaan_orangtua`, `gaji_orangtua`, `status_pendaftaran`, `created_at`, `updated_at`) VALUES
('REG001', 'USR001', NULL, '1829101208', 'Ihsan Sayid Muharrom', 'Perumbina karya 2 blok a 81', '081214674169', 'SMKN 1 Cianjur', 'L', 'foto-REG001.png', 36.44, 'IJAZAH-REG001.pdf', 'SKHUN-REG001.pdf', 'JUR001', 'JUR002', 'Deddy Misdarpon', 'Peurmbina karyais jda sama', '081214515121', 'aparatur-negara', '>1JT', 'tidak-diterima', '2021-10-14 15:19:35', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` char(6) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','siswa') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nama_lengkap`, `email`, `password`, `role`, `created_at`, `updated_at`) VALUES
('ADM001', 'Andra adi nugroho', 'andra@smkn1jakarta.ac.id', '$2y$10$ONyMejqe/vq/VyAeecrOV.74Yi9SNx6zQ3G/2c7Dk7Te3YACWLtNW', 'admin', '2021-10-14 15:34:39', NULL),
('USR001', 'Ihsan Sayid Muharrom', 'ihsansayid66@gmail.com', '$2y$10$k012.WsEMJP12ClX6eTOve54YSorENjAbFpVB//a9eynZujvd1ysa', 'siswa', '2021-10-14 15:34:25', NULL),
('USR002', 'gantira suriadinata', 'gantira@poltek.ac.id', '$2y$10$jJd5It8BdMuRC2HXZ8W3lO9VFjsiZUxzf/5cdchPaEX.ScrAZs3cC', 'siswa', '2021-10-14 15:37:36', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jurusan`
--
ALTER TABLE `jurusan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pendaftaran`
--
ALTER TABLE `pendaftaran`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_user` (`id_user`),
  ADD KEY `jurusan_fk_1` (`minat_id_jurusan_1`),
  ADD KEY `jurusan_fk_2` (`minat_id_jurusan_2`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pendaftaran`
--
ALTER TABLE `pendaftaran`
  ADD CONSTRAINT `jurusan_fk_1` FOREIGN KEY (`minat_id_jurusan_1`) REFERENCES `jurusan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `jurusan_fk_2` FOREIGN KEY (`minat_id_jurusan_2`) REFERENCES `jurusan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pendaftaran_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
