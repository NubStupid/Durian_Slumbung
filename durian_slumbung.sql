-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 20, 2023 at 06:15 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `durian_slumbung`
--

-- --------------------------------------------------------

--
-- Table structure for table `book_durian`
--

CREATE TABLE `book_durian` (
  `inv_id` varchar(25) NOT NULL,
  `tgl_pesan` date DEFAULT NULL,
  `tgl_dipesan` date DEFAULT NULL,
  `nama` varchar(25) DEFAULT NULL,
  `nowa` varchar(25) DEFAULT NULL,
  `kecil` int(11) DEFAULT NULL,
  `sedang` int(11) DEFAULT NULL,
  `besar` int(11) DEFAULT NULL,
  `bukti_bayar` varchar(255) DEFAULT NULL,
  `status` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `book_olahan`
--

CREATE TABLE `book_olahan` (
  `inv_id` varchar(25) NOT NULL,
  `tgl_pesan` date DEFAULT NULL,
  `tgl_dipesan` date DEFAULT NULL,
  `sesi` varchar(255) DEFAULT NULL,
  `olahan` varchar(255) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `nowa` varchar(255) DEFAULT NULL,
  `orang` int(11) DEFAULT NULL,
  `bukti_bayar` varchar(255) DEFAULT NULL,
  `status` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `olahan`
--

CREATE TABLE `olahan` (
  `nama` varchar(25) NOT NULL,
  `img` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stok_durian`
--

CREATE TABLE `stok_durian` (
  `tanggal` date NOT NULL,
  `kecil` int(11) DEFAULT NULL,
  `sedang` int(11) DEFAULT NULL,
  `besar` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `book_durian`
--
ALTER TABLE `book_durian`
  ADD PRIMARY KEY (`inv_id`);

--
-- Indexes for table `book_olahan`
--
ALTER TABLE `book_olahan`
  ADD PRIMARY KEY (`inv_id`);

--
-- Indexes for table `olahan`
--
ALTER TABLE `olahan`
  ADD PRIMARY KEY (`nama`);

--
-- Indexes for table `stok_durian`
--
ALTER TABLE `stok_durian`
  ADD PRIMARY KEY (`tanggal`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
