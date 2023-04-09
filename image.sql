-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 09, 2023 at 07:40 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.5

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
  `image_url` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `image`
--

INSERT INTO `image` (`id`, `image_url`) VALUES
(1, './image/1762446586676451.png'),
(2, './image/1762446594926826.png'),
(3, './image/1762446601967270.png'),
(4, './image/1762446608768380.png'),
(5, './image/1762446615757277.png'),
(6, './image/1762446623147889.png'),
(7, './image/1762446639412801.png'),
(8, './image/1762446647311862.png'),
(9, './image/1762446654678228.png'),
(10, './image/1762446861126773.png'),
(11, './image/1762447277375769.png'),
(12, './image/1762447294291058.png'),
(13, './image/1762453518334535.png'),
(14, './image/1762453619900286.png'),
(15, './image/1762453810493227.png'),
(16, './image/1762453842767838.png'),
(17, './image/1762453843168490.png'),
(18, './image/1762453891939657.png'),
(19, './image/1762453977384684.png'),
(20, './image/1762453995323843.png'),
(21, './image/1762454104748955.png'),
(22, './image/1762454147213531.png'),
(23, './image/1762454224027850.png'),
(24, './image/1762454264642918.png'),
(25, './image/1762454405759109.png'),
(26, './image/1762454426778693.png'),
(27, './image/1762454579037791.png'),
(28, './image/1762454846618656.png'),
(29, './image/1762456372103750.png'),
(30, './image/1762458989932874.png'),
(31, './image/1762697562504287.png'),
(32, './image/1762709078308090.png');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
