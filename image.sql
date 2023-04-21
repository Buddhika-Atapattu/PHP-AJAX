-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 21, 2023 at 10:03 PM
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
  `name` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `image`
--

INSERT INTO `image` (`id`, `image_url`, `name`) VALUES
(1, './image/1762446586676451.png', 'cihe jbej'),
(2, './image/1762446594926826.png', 'icac fajj'),
(3, './image/1762446601967270.png', 'fcbf gdhe'),
(4, './image/1762446608768380.png', 'efed bfji'),
(5, './image/1762446615757277.png', 'hbai jdda'),
(6, './image/1762446623147889.png', 'ibdc gjba'),
(7, './image/1762446639412801.png', 'dhdd jehd'),
(8, './image/1762446647311862.png', 'jfai feea'),
(9, './image/1762446654678228.png', 'cghc iegb'),
(10, './image/1762446861126773.png', 'faei hbda'),
(11, './image/1762447277375769.png', 'jfbc jjde'),
(12, './image/1762447294291058.png', 'igbe bjaj'),
(13, './image/1762453518334535.png', 'cjdh eaff'),
(14, './image/1762453619900286.png', 'edhe jaci'),
(15, './image/1762453810493227.png', 'jaje gefa'),
(16, './image/1762453842767838.png', 'hjdc hcgg'),
(17, './image/1762453843168490.png', 'jhda fahh'),
(18, './image/1762453891939657.png', 'fcgh cbbb'),
(19, './image/1762453977384684.png', 'bbia bega'),
(20, './image/1762453995323843.png', 'iagj fedb'),
(21, './image/1762454104748955.png', 'gcja bfgh'),
(22, './image/1762454147213531.png', 'gidi jhff'),
(23, './image/1762454224027850.png', 'hcba fjaf'),
(24, './image/1762454264642918.png', 'ebag cddf'),
(25, './image/1762454405759109.png', 'faej dbji'),
(26, './image/1762454426778693.png', 'djji fjcd'),
(27, './image/1762454579037791.png', 'eebd dggd'),
(28, './image/1762454846618656.png', 'hiib fbbb'),
(29, './image/1762456372103750.png', 'jdfj eiia'),
(30, './image/1762458989932874.png', 'hbii ihif'),
(31, './image/1762697562504287.png', 'ehjf hjfh'),
(32, './image/1762709078308090.png', 'dhia bhig'),
(33, './image/1763797931768336.png', 'jeab gihi'),
(34, './image/1763814020294181.png', 'image 20343'),
(35, './image/1763815506701763.png', ' image 30499');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
