-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 10, 2020 at 05:37 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10
drop database phplogin;
create database phplogin;
use phplogin;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `phplogin`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `Role` varchar(20) DEFAULT 'Nada',
  `Telefono` varchar(10) DEFAULT NULL,
  `calle` varchar(25) DEFAULT NULL,
  `numExt` int(11) DEFAULT NULL,
  `numInt` int(11) DEFAULT NULL,
  `colonia` varchar(25) DEFAULT NULL,
  `municipio` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `username`, `password`, `email`, `Role`, `Telefono`, `calle`, `numExt`, `numInt`, `colonia`, `municipio`) VALUES
(1, 'admin', '$2y$10$5oiTwTcOIXewFef7FMKW/u9hLOoxzDVkYu17LKn7tQ1hKKqAUdYEO', 'admin@admin.com', 'Admin', '1231231234', 'Street', 21, 1, '0', '0'),
(13, 'af', '$2y$10$Syufu0A2e72le25UbCOOW.evG7g5N1TItxhuZTGHtU/9AQIQ1ctZy', 'a@a', 'Capturista', '123', '123', 123, 123, '123', '123'),
(14, 'cxz', '$2y$10$7sR8dhudbWTPILvsALKeqeNV6uvt609epk0pOW6/8p.BqADfGxFwm', 'xzc', 'Nada', '4921196944', 'dsa', 0, 0, 'dsa', 'sda');

-- --------------------------------------------------------

--
-- Table structure for table `lideres`
--

CREATE TABLE `lideres` (
  `id` int(11) NOT NULL,
  `Nombre` varchar(40) NOT NULL,
  `paterno` varchar(40) NOT NULL,
  `materno` varchar(40) NOT NULL,
  `domicilio` varchar(40) NOT NULL,
  `colonia` varchar(40) NOT NULL,
  `municipio` varchar(40) NOT NULL,
  `seccion` varchar(40) NOT NULL,
  `ocr` varchar(40) NOT NULL,
  `telefono` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `promotores`
--

CREATE TABLE `promotores` (
  `id` int(11) NOT NULL,
  `Nombre` varchar(40) NOT NULL,
  `paterno` varchar(40) NOT NULL,
  `materno` varchar(40) NOT NULL,
  `id_lider` int(11) DEFAULT NULL,
  `domicilio` varchar(40) NOT NULL,
  `colonia` varchar(40) NOT NULL,
  `municipio` varchar(4) NOT NULL,
  `seccion` varchar(40) NOT NULL,
  `ocr` varchar(40) NOT NULL,
  `telefono` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `promovidos`
--

CREATE TABLE `promovidos` (
  `id` int(11) NOT NULL,
  `id_promotor` int(11) NOT NULL,
  `nombre` varchar(40) NOT NULL,
  `paterno` varchar(40) NOT NULL,
  `materno` varchar(40) NOT NULL,
  `domicilio` varchar(40) NOT NULL,
  `colonia` varchar(40) NOT NULL,
  `municipio` varchar(40) NOT NULL,
  `seccion` varchar(40) NOT NULL,
  `telefono` varchar(40) NOT NULL,
  `clave_elector` varchar(40) NOT NULL,
  `id_red` int(40) NOT NULL,
  `fecha_red` date NOT NULL,
  `fecha_captura` date NOT NULL DEFAULT current_timestamp(),
  `votado` varchar(2) NOT NULL DEFAULT 'No',
  `Sexo` varchar(1) DEFAULT NULL,
  `EDAD` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lideres`
--
ALTER TABLE `lideres`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `promotores`
--
ALTER TABLE `promotores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_LiderPromot` (`id_lider`);

--
-- Indexes for table `promovidos`
--
ALTER TABLE `promovidos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_movmot` (`id_promotor`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `lideres`
--
ALTER TABLE `lideres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `promotores`
--
ALTER TABLE `promotores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `promovidos`
--
ALTER TABLE `promovidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `promotores`
--
ALTER TABLE `promotores`
  ADD CONSTRAINT `FK_LiderPromot` FOREIGN KEY (`id_lider`) REFERENCES `lideres` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `promovidos`
--
ALTER TABLE `promovidos`
  ADD CONSTRAINT `fk_movmot` FOREIGN KEY (`id_promotor`) REFERENCES `promotores` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
