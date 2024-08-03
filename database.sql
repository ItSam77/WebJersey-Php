-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 03, 2024 at 08:34 AM
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
-- Database: `jersey1`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `CustID` int(11) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Alamat` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `detailpemesanan`
--

CREATE TABLE `detailpemesanan` (
  `DetPemesananID` int(11) NOT NULL,
  `PemesananID` int(11) DEFAULT NULL,
  `ProdukID` int(11) DEFAULT NULL,
  `Kuantitas` int(11) NOT NULL,
  `desainproduk` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `PaymentID` int(11) NOT NULL,
  `Nama_Payment` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`PaymentID`, `Nama_Payment`) VALUES
(1, 'Transfer Bank'),
(2, 'Kartu Kredit'),
(3, 'PayPal'),
(4, 'GoPay'),
(5, 'OVO'),
(6, 'DANA'),
(7, 'ShopeePay'),
(8, 'Alfamart'),
(9, 'Indomaret'),
(10, 'COD (Cash on Delivery)');

-- --------------------------------------------------------

--
-- Table structure for table `pemesanan`
--

CREATE TABLE `pemesanan` (
  `PemesananID` int(11) NOT NULL,
  `CustID` int(11) DEFAULT NULL,
  `PenjahitID` int(11) DEFAULT NULL,
  `TglPengiriman` date DEFAULT NULL,
  `Paymentid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `penjahit`
--

CREATE TABLE `penjahit` (
  `PenjahitID` int(11) NOT NULL,
  `NamaPenjahit` varchar(255) NOT NULL,
  `NoTelp` varchar(15) DEFAULT NULL,
  `Keahlian` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penjahit`
--

INSERT INTO `penjahit` (`PenjahitID`, `NamaPenjahit`, `NoTelp`, `Keahlian`) VALUES
(1, 'Budi Muliawan', NULL, NULL),
(2, 'Yoga Putra', NULL, NULL),
(3, 'Udin Nazarudin', NULL, NULL),
(4, 'Yanto Gilang', NULL, NULL),
(5, 'Alexander Sitorus', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `ProdukID` int(11) NOT NULL,
  `Nama_Produk` varchar(255) NOT NULL,
  `Harga` int(11) NOT NULL,
  `Deskripsi` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`ProdukID`, `Nama_Produk`, `Harga`, `Deskripsi`) VALUES
(1, 'Pembuatan Jersey Tim Olahraga', 150000, 'Jersey tim olahraga berkualitas tinggi.'),
(2, 'Pembuatan Jersey Sekolah', 170000, 'Jersey seragam olahraga sekolah.'),
(3, 'Pembuatan Jersey Event', 200000, 'Jersey untuk event atau komunitas.'),
(4, 'Custom Jersey untuk Individu', 300000, 'Jersey custom dengan desain unik.'),
(5, 'Custom Jacket untuk Individu', 400000, 'Jacket custom sesuai dengan keinginan kalian.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`CustID`);

--
-- Indexes for table `detailpemesanan`
--
ALTER TABLE `detailpemesanan`
  ADD PRIMARY KEY (`DetPemesananID`),
  ADD KEY `PemesananID` (`PemesananID`),
  ADD KEY `ProdukID` (`ProdukID`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`PaymentID`);

--
-- Indexes for table `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD PRIMARY KEY (`PemesananID`),
  ADD KEY `CustID` (`CustID`),
  ADD KEY `PenjahitID` (`PenjahitID`),
  ADD KEY `Paymentid` (`Paymentid`);

--
-- Indexes for table `penjahit`
--
ALTER TABLE `penjahit`
  ADD PRIMARY KEY (`PenjahitID`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`ProdukID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `CustID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `detailpemesanan`
--
ALTER TABLE `detailpemesanan`
  MODIFY `DetPemesananID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `PaymentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pemesanan`
--
ALTER TABLE `pemesanan`
  MODIFY `PemesananID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `penjahit`
--
ALTER TABLE `penjahit`
  MODIFY `PenjahitID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `ProdukID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detailpemesanan`
--
ALTER TABLE `detailpemesanan`
  ADD CONSTRAINT `detailpemesanan_ibfk_1` FOREIGN KEY (`PemesananID`) REFERENCES `pemesanan` (`PemesananID`),
  ADD CONSTRAINT `detailpemesanan_ibfk_2` FOREIGN KEY (`ProdukID`) REFERENCES `produk` (`ProdukID`);

--
-- Constraints for table `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD CONSTRAINT `pemesanan_ibfk_1` FOREIGN KEY (`CustID`) REFERENCES `customer` (`CustID`),
  ADD CONSTRAINT `pemesanan_ibfk_2` FOREIGN KEY (`PenjahitID`) REFERENCES `penjahit` (`PenjahitID`),
  ADD CONSTRAINT `pemesanan_ibfk_3` FOREIGN KEY (`Paymentid`) REFERENCES `payment` (`PaymentID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
