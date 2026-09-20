-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 15, 2026 at 08:33 AM
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
-- Database: `bdabon`
--

-- --------------------------------------------------------

--
-- Table structure for table `abonne`
--

CREATE TABLE `abonne` (
  `cin` varchar(8) NOT NULL,
  `nom` varchar(20) NOT NULL,
  `prenom` varchar(20) NOT NULL,
  `adress` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `abonne`
--

INSERT INTO `abonne` (`cin`, `nom`, `prenom`, `adress`, `email`) VALUES
('04545459', 'belgacem', 'nadia', 'nabeul', 'nadia@gmail.com'),
('12323237', 'rahmeni', 'bechir', 'touzeur', 'bechir@hitmail.com'),
('13636638', 'channoufi', 'rim', 'hammem chat', 'rym105@yahoo.fr');

-- --------------------------------------------------------

--
-- Table structure for table `abonnement`
--

CREATE TABLE `abonnement` (
  `cin` varchar(8) NOT NULL,
  `code` varchar(20) NOT NULL,
  `dateabon` date NOT NULL,
  `dateech` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `revue`
--

CREATE TABLE `revue` (
  `code` varchar(5) NOT NULL,
  `titre` varchar(20) NOT NULL,
  `prixmens` decimal(6,3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `revue`
--

INSERT INTO `revue` (`code`, `titre`, `prixmens`) VALUES
('infl1', 'java pour  debutants', 12.250),
('lit13', 'mots fleches', 999.999),
('sci04', 'sc et vie', 999.999),
('spt01', 'le meilleur du foot', 999.999);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `abonne`
--
ALTER TABLE `abonne`
  ADD PRIMARY KEY (`cin`);

--
-- Indexes for table `abonnement`
--
ALTER TABLE `abonnement`
  ADD PRIMARY KEY (`cin`,`code`,`dateabon`),
  ADD KEY `fk2` (`code`);

--
-- Indexes for table `revue`
--
ALTER TABLE `revue`
  ADD PRIMARY KEY (`code`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `abonnement`
--
ALTER TABLE `abonnement`
  ADD CONSTRAINT `fk1` FOREIGN KEY (`cin`) REFERENCES `abonne` (`cin`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk2` FOREIGN KEY (`code`) REFERENCES `revue` (`code`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
