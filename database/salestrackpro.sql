-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 23, 2024 at 06:53 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `salestrackpro`
--

-- --------------------------------------------------------

--
-- Table structure for table `buy`
--

CREATE TABLE `buy` (
  `INO` varchar(50) NOT NULL,
  `NAME` varchar(20) NOT NULL,
  `ICAATAGORY` varchar(100) NOT NULL,
  `ISUCATAGORY` varchar(900) NOT NULL,
  `IQUANTITY` int(250) NOT NULL,
  `YID` varchar(700) NOT NULL,
  `Date` varchar(550) NOT NULL,
  `PRICE` varchar(400) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `buy`
--

INSERT INTO `buy` (`INO`, `NAME`, `ICAATAGORY`, `ISUCATAGORY`, `IQUANTITY`, `YID`, `Date`, `PRICE`) VALUES
('INV1708705182', 'gbdx2l laptop', 'Office laptop', 'Dell', 1, '223451231', '2024/10/25', '453000'),
('INV1708706544', 'gbdx24444l laptop', 'AMD Ryzen Laptops', 'Apple', 2, '3235235612v', '2024/10/28', '555000');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `name` varchar(700) NOT NULL,
  `phone` int(100) NOT NULL,
  `email` varchar(500) NOT NULL,
  `massage` varchar(900) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`name`, `phone`, `email`, `massage`) VALUES
('', 2147483647, 'aselagayan1010@gmail.com', 'fsdfsfsfs'),
('', 2147483647, 'aselagayan1010@gmail.com', 'fsdfsfsfs'),
('cloud', 769144426, 'cloud@gmail.com', 'Goodboy');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` varchar(50) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `contact` int(50) NOT NULL,
  `distric` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `fname`, `lname`, `contact`, `distric`) VALUES
('21', 'umesha', 'arunodi', 783323234, 'galle'),
('21', 'umesha', 'arunodi', 783323234, 'galle'),
('2116', 'asela', 'gayan', 783323234, 'galle'),
('2', 'cloud', 'cccc', 783323234, 'colombo');

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `ICODE` varchar(700) NOT NULL,
  `NAME` varchar(50) NOT NULL,
  `ICATAGORY` varchar(100) NOT NULL,
  `ISCATAGORY` varchar(50) NOT NULL,
  `QUANTITY` int(250) NOT NULL,
  `SID` varchar(700) NOT NULL,
  `PRICE` varchar(550) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`ICODE`, `NAME`, `ICATAGORY`, `ISCATAGORY`, `QUANTITY`, `SID`, `PRICE`) VALUES
('2', 'gbdx2l laptop', 'Office laptop', 'HP', 2, '22423423511', '453000'),
('3', 'dehn23 laptop', 'macOS Laptops', 'Apple', 33, '22423423335115', '256000');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
