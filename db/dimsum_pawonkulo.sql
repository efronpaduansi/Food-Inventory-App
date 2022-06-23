-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 23, 2022 at 06:44 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dimsum_pawonkulo`
--

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` varchar(10) NOT NULL,
  `makanan` varchar(15) NOT NULL,
  `varian_rasa` varchar(15) NOT NULL,
  `harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `makanan`, `varian_rasa`, `harga`) VALUES
('DPK001', 'Dimsum', 'Ayam', 5000),
('DPK002', 'Dimsum', 'Beef', 5000),
('DPK003', 'Dimsum', 'Cumi', 5000),
('DPK004', 'Dimsum', 'Udang', 5000);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` varchar(20) NOT NULL,
  `id_menu` varchar(10) NOT NULL,
  `id_user` varchar(20) NOT NULL,
  `hrg_beli` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `tgl_order` date NOT NULL,
  `administrator` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `id_menu`, `id_user`, `hrg_beli`, `jumlah`, `tgl_order`, `administrator`) VALUES
('ID-230622001', 'DPK001', 'USR230622002', 3000, 30, '2022-06-23', 'Administrator'),
('ID-230622002', 'DPK002', 'USR230622002', 3500, 45, '2022-06-23', 'Administrator'),
('ID-230622003', 'DPK003', 'USR230622002', 3000, 35, '2022-06-23', 'Administrator'),
('ID-230622004', 'DPK004', 'USR230622002', 3000, 30, '2022-06-23', 'Administrator');

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `id` varchar(20) NOT NULL,
  `id_stock` int(11) NOT NULL,
  `id_menu` varchar(10) NOT NULL,
  `id_user` varchar(20) NOT NULL,
  `hrg_jual` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `profit` int(11) NOT NULL,
  `tgl` date NOT NULL,
  `administrator` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penjualan`
--

INSERT INTO `penjualan` (`id`, `id_stock`, `id_menu`, `id_user`, `hrg_jual`, `jumlah`, `profit`, `tgl`, `administrator`) VALUES
('DPK-230622001', 2, 'DPK002', 'USR230622003', 5000, 2, 3000, '2022-06-23', 'Helna Santika');

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `id` int(11) NOT NULL,
  `id_menu` varchar(10) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`id`, `id_menu`, `total`) VALUES
(1, 'DPK001', 30),
(2, 'DPK002', 43),
(3, 'DPK003', 35),
(4, 'DPK004', 30);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` varchar(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `fname`, `password`, `level`) VALUES
('USR230622002', 'admin2022', 'Administrator', '$2y$10$KfoBspXvevnZ9d0L4wreKunGvN3Lug/XLl2omCAU98IE59mTAX/lK', 'Superadmin'),
('USR230622003', 'helnasantika', 'Helna Santika', '$2y$10$EdxU4P3PlXDvDgTylrFt7OGj8N2iasEi5jqNAhGUhDWHGv3N4MyAO', 'Admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_menu` (`id_menu`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_stock` (`id_stock`),
  ADD KEY `id_menu` (`id_menu`),
  ADD KEY `id_stock_2` (`id_stock`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_menu` (`id_menu`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`id_menu`) REFERENCES `menu` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD CONSTRAINT `penjualan_ibfk_1` FOREIGN KEY (`id_menu`) REFERENCES `menu` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `penjualan_ibfk_2` FOREIGN KEY (`id_stock`) REFERENCES `stock` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `penjualan_ibfk_3` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `stock`
--
ALTER TABLE `stock`
  ADD CONSTRAINT `stock_ibfk_1` FOREIGN KEY (`id_menu`) REFERENCES `menu` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
