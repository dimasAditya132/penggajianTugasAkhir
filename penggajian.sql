-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 15, 2020 at 10:07 PM
-- Server version: 5.7.29-0ubuntu0.18.04.1
-- PHP Version: 7.2.24-0ubuntu0.18.04.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `penggajian`
--

-- --------------------------------------------------------

--
-- Table structure for table `divisi`
--

CREATE TABLE `divisi` (
  `kode_divisi` varchar(3) NOT NULL,
  `nama_divisi` varchar(15) NOT NULL,
  `bonus` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `divisi`
--

INSERT INTO `divisi` (`kode_divisi`, `nama_divisi`, `bonus`) VALUES
('D01', 'Data Analyst', 600000),
('D02', 'Programmer', 520000);

-- --------------------------------------------------------

--
-- Table structure for table `golongan`
--

CREATE TABLE `golongan` (
  `kode_golongan` varchar(3) NOT NULL,
  `nama_golongan` varchar(10) NOT NULL,
  `gaji_pokok` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `golongan`
--

INSERT INTO `golongan` (`kode_golongan`, `nama_golongan`, `gaji_pokok`) VALUES
('G01', 'Manager', 10000000),
('G02', 'HRD', 5000000),
('G03', 'Karyawan', 4000000);

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `idlogin` int(5) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `status` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`idlogin`, `email`, `password`, `status`) VALUES
(0, 'Alex56@gmail.com', 'skyez', '');

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `kode_pegawai` varchar(5) NOT NULL,
  `nama_pegawai` varchar(40) NOT NULL,
  `jenis_kelamin` char(1) NOT NULL,
  `tempat_lahir` varchar(20) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `status_menikah` char(1) NOT NULL,
  `kode_golongan` varchar(3) NOT NULL,
  `gaji_pokok` float NOT NULL,
  `kode_divisi` varchar(3) NOT NULL,
  `bonus` float NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `tgl_masuk` date NOT NULL,
  `status` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`kode_pegawai`, `nama_pegawai`, `jenis_kelamin`, `tempat_lahir`, `tgl_lahir`, `status_menikah`, `kode_golongan`, `gaji_pokok`, `kode_divisi`, `bonus`, `alamat`, `tgl_masuk`, `status`) VALUES
('K0001', 'Thanos Putra', 'P', 'Gentan', '2020-04-01', 'B', 'G01', 10000000, 'D01', 600000, 'Jl. Adi Sucipto No.33, Manahan, Kec. Banjarsari, Kota Surakarta, Jawa Tengah 57139', '2020-04-14', 'A'),
('K0002', 'Scarlet johanson', 'P', 'Gentan', '2020-04-16', 'K', 'G02', 5000000, 'D02', 520000, 'Jl. L. U. Adisucipto No. 1, Manahan, Banjarsari, Manahan, Kec. Banjarsari, Kota Surakarta, Jawa Tengah 57139', '2020-04-13', 'A'),
('K0003', 'Sukiman', 'P', 'Sukoharjo', '2020-04-15', 'K', 'G02', 5000000, 'D02', 520000, 'Sukoharjo', '2020-04-22', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `kode_transaksi` varchar(9) NOT NULL,
  `kode_pegawai` varchar(5) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `gaji_pokok` float NOT NULL,
  `bonus` float NOT NULL,
  `total` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`kode_transaksi`, `kode_pegawai`, `tanggal`, `gaji_pokok`, `bonus`, `total`) VALUES
('200304001', 'K0002', '2020-04-15 13:17:22', 5000000, 520000, 5520000),
('200415001', 'K0002', '2020-04-15 11:33:35', 5000000, 520000, 5520000),
('200415002', 'K0003', '2020-04-15 11:34:11', 5000000, 520000, 5520000),
('200415003', 'K0002', '2020-04-15 13:24:01', 5000000, 520000, 5520000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `divisi`
--
ALTER TABLE `divisi`
  ADD PRIMARY KEY (`kode_divisi`);

--
-- Indexes for table `golongan`
--
ALTER TABLE `golongan`
  ADD PRIMARY KEY (`kode_golongan`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`idlogin`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`kode_pegawai`),
  ADD KEY `kode_golongan` (`kode_golongan`),
  ADD KEY `kode_divisi` (`kode_divisi`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`kode_transaksi`),
  ADD KEY `kode_pegawai` (`kode_pegawai`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD CONSTRAINT `pegawai_ibfk_1` FOREIGN KEY (`kode_golongan`) REFERENCES `golongan` (`kode_golongan`),
  ADD CONSTRAINT `pegawai_ibfk_2` FOREIGN KEY (`kode_divisi`) REFERENCES `divisi` (`kode_divisi`);

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`kode_pegawai`) REFERENCES `pegawai` (`kode_pegawai`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
