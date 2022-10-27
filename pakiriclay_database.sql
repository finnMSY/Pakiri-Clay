-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 27, 2022 at 09:13 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pakiriclay_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `product_id`, `account_id`, `quantity`) VALUES
(10, 2, 0, 3),
(12, 2, 4, 7),
(13, 3, 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_info`
--

CREATE TABLE `product_info` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `price` int(3) NOT NULL,
  `image` varchar(30) NOT NULL,
  `category` varchar(50) NOT NULL,
  `availability` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_info`
--

INSERT INTO `product_info` (`id`, `name`, `description`, `price`, `image`, `category`, `availability`) VALUES
(1, 'bowl1', 'this is a bowl', 2, 'image1.jpg', 'Bowl', 'Yes'),
(2, 'bowl2', 'this is a bowl', 12, 'image2.jpg', 'Bowl', 'Yes'),
(3, 'bowl3', 'this is a bowl', 12, 'image3.jpg', 'Bowl', 'Yes'),
(4, 'bowl4', 'this is a bowl', 1, 'image4.jpg', 'Bowl', 'No'),
(5, 'cup1', 'this is a bowl', 12, 'image5.jpg', 'Cup', 'Yes'),
(6, 'cup2', 'this is a bowl', 12, 'image6.jpg', 'Cup', 'No'),
(7, 'bowl7', 'this is a bowl', 12, 'image7.jpg', 'Plate', 'Yes'),
(8, 'bowl8', 'this is a bowl', 12, 'image8.jpg', 'Plate', 'Yes'),
(9, 'bowl9', 'this is a bowl', 12, 'image9.jpg', 'Plate', 'Yes'),
(10, 'bowl10', 'this is a bowl', 12, 'image10.jpg', 'Jug', 'Yes'),
(11, 'jug2', 'this is a jug', 20, 'image1.jpg', 'Jug', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `user_accounts`
--

CREATE TABLE `user_accounts` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(150) NOT NULL,
  `hash` varchar(100) NOT NULL,
  `active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_accounts`
--

INSERT INTO `user_accounts` (`id`, `username`, `email`, `password`, `hash`, `active`) VALUES
(4, 'Finn Massey', 'fmassey6@gmail.com', '$2y$10$nR589vQlRl8dNojmjfvuUOX/KH3t.v5YzpvxlcZA3SzMXH3gdnNmq', 'a1b17c44f88d34e61f0dda82beb18ed5', 0),
(5, 'Billy', 'billy@gmail.com', '$2y$10$sgqB5g1RfPr5JZvIZfeK0.LAd2Hvjfub.c.UCpU6m213emuaEmZtS', '289a3655db42f7cdf811dec0426ebb86', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_info`
--
ALTER TABLE `product_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_accounts`
--
ALTER TABLE `user_accounts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `hash` (`hash`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `product_info`
--
ALTER TABLE `product_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `user_accounts`
--
ALTER TABLE `user_accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
