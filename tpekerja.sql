-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 18, 2026 at 03:03 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gmi-member`
--

-- --------------------------------------------------------

--
-- Table structure for table `tpekerja`
--

CREATE TABLE `tpekerja` (
  `pekerja_id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mobile_phone` varchar(50) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `tanggal_diterima` date NOT NULL,
  `tanggal_tahbis` date NOT NULL,
  `status` varchar(10) NOT NULL,
  `penempatan` varchar(50) NOT NULL,
  `tanggal_sk` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tpekerja`
--

INSERT INTO `tpekerja` (`pekerja_id`, `nama`, `email`, `mobile_phone`, `tanggal_lahir`, `tanggal_diterima`, `tanggal_tahbis`, `status`, `penempatan`, `tanggal_sk`) VALUES
(1, 'xcwece', '', '7777', '2026-11-05', '2026-11-06', '0000-00-00', 'Guru Injil', 'Asisten', '2026-11-07'),
(2, 'vrvrvr', 'silalahitotok@gmail.com', '7777', '2026-11-05', '2026-11-06', '2026-11-05', 'Pendeta', 'Asisten', '2026-11-07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tpekerja`
--
ALTER TABLE `tpekerja`
  ADD UNIQUE KEY `pekerja_id` (`pekerja_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tpekerja`
--
ALTER TABLE `tpekerja`
  MODIFY `pekerja_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
