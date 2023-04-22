-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 23, 2023 at 01:29 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `testdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

CREATE TABLE `image` (
  `id` int(11) NOT NULL,
  `image_url` text NOT NULL,
  `uid` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `image`
--

INSERT INTO `image` (`id`, `image_url`, `uid`) VALUES
(1, './image/1763833205389847.png', 'hgej-cchf-1763833205389461'),
(2, './image/1763833219279893.png', 'idjg-hjhj-1763833219279333'),
(3, './image/1763833232013446.png', 'jhci-dhgc-1763833232013071'),
(4, './image/1763833247138478.png', 'jiij-egdd-1763833247138111'),
(5, './image/1763833792520841.png', 'fdhh-jjhc-1763833792520458-eiib'),
(6, './image/1763834204467833.png', 'iddf-fjcc-1763834204467242-djbb'),
(7, './image/1763837662739046.png', 'ehhd-iiah-1763837662738593-ddec'),
(8, './image/1763838394760754.png', 'ebdc-cffb-1763838394760125-dige'),
(9, './image/1763876293507728.png', 'qjwt-qmcv-1763876293509070-mkem-8039'),
(10, './image/1763876964910833.png', 'uid-ldzy-xsqo-1763876964911523-lwxh-6073'),
(12, './image/1763889486749114.png', 'uid-mukj-dwre-1763889486750014-opdw-2597'),
(13, './image/1763912369104227.png', 'uid-zlmg-vbsf-1763912369103843-qdsk-3249'),
(14, './image/1763912880786089.png', 'uid-lemh-dtjh-1763912880785708-dhfp-6781');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `image`
--
ALTER TABLE `image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
