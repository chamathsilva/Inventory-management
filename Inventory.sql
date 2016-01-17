-- phpMyAdmin SQL Dump
-- version 4.4.3
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 17, 2016 at 02:54 PM
-- Server version: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `Inventory`
--

-- --------------------------------------------------------

--
-- Table structure for table `Advances`
--

CREATE TABLE IF NOT EXISTS `Advances` (
  `Advance_id` int(11) NOT NULL,
  `ref_id` int(11) NOT NULL,
  `Amount` decimal(19,4) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Advances`
--

INSERT INTO `Advances` (`Advance_id`, `ref_id`, `Amount`, `Timestamp`) VALUES
(9, 4, '500.0000', '2016-01-27 16:31:35'),
(10, 5, '500.0000', '2016-01-20 16:46:18'),
(11, 3, '1234.1200', '2016-01-19 03:32:42'),
(12, 4, '-1.0000', '2016-01-17 13:10:08'),
(13, 2, '3.0000', '2016-01-05 13:27:59'),
(14, 3, '3.0000', '2016-01-14 13:29:12'),
(15, 3, '12.0000', '2015-12-17 13:31:20'),
(16, 4, '12.0000', '2016-01-13 13:31:38'),
(17, 2, '3.0000', '2016-01-13 13:32:47'),
(18, 2, '12.0000', '2016-01-07 13:32:47'),
(19, 2, '10.0000', '2016-01-12 13:38:03');

-- --------------------------------------------------------

--
-- Table structure for table `Missing`
--

CREATE TABLE IF NOT EXISTS `Missing` (
  `Missing_id` int(11) NOT NULL,
  `Ref_id` int(11) NOT NULL,
  `Product_id` int(11) NOT NULL,
  `Time_Stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `totalMissingcost` double(19,4) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Product`
--

CREATE TABLE IF NOT EXISTS `Product` (
  `Product_id` int(11) NOT NULL,
  `Product_Name` varchar(300) NOT NULL,
  `Cost` decimal(19,4) NOT NULL,
  `Selling_price` decimal(19,4) DEFAULT NULL,
  `Commision` decimal(19,4) DEFAULT NULL,
  `currentStock` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Product`
--

INSERT INTO `Product` (`Product_id`, `Product_Name`, `Cost`, `Selling_price`, `Commision`, `currentStock`) VALUES
(5, 'testA', '123.0000', '456.0000', '789.0000', -385),
(6, 'asdas', '2134.3300', '324.3450', '325.2340', 444550),
(7, 'DVD', '1250.0000', '5000.0000', '150.0000', 54);

-- --------------------------------------------------------

--
-- Table structure for table `Ref`
--

CREATE TABLE IF NOT EXISTS `Ref` (
  `Ref_id` int(11) NOT NULL,
  `Ref_Name` varchar(45) DEFAULT NULL,
  `Basic_salary` varchar(45) DEFAULT NULL,
  `Other` varchar(45) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Ref`
--

INSERT INTO `Ref` (`Ref_id`, `Ref_Name`, `Basic_salary`, `Other`) VALUES
(1, '123', '123', '123'),
(2, 'test2', '123.99', 'None'),
(3, 'Tharaka', '67', ''),
(4, 'malshan', '234', ''),
(5, 'abcd', '500', '');

-- --------------------------------------------------------

--
-- Table structure for table `refSalary`
--

CREATE TABLE IF NOT EXISTS `refSalary` (
  `salary_id` int(11) NOT NULL,
  `ref_id` int(11) DEFAULT NULL,
  `time_Stamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `salary` double(19,4) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `refSalary`
--

INSERT INTO `refSalary` (`salary_id`, `ref_id`, `time_Stamp`, `salary`) VALUES
(11, 4, '2016-01-17 08:15:10', 1950.0000);

-- --------------------------------------------------------

--
-- Table structure for table `Stock`
--

CREATE TABLE IF NOT EXISTS `Stock` (
  `Stock_id` int(11) NOT NULL,
  `time_Stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `InStock` int(11) DEFAULT '0',
  `OutStock` int(11) DEFAULT '0',
  `SalesOut` int(11) DEFAULT NULL,
  `product_id` int(11) NOT NULL,
  `Return_in` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=77 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Stock`
--

INSERT INTO `Stock` (`Stock_id`, `time_Stamp`, `InStock`, `OutStock`, `SalesOut`, `product_id`, `Return_in`) VALUES
(30, '2016-01-16 08:28:31', 0, 100, NULL, 5, 0),
(31, '2016-01-16 08:28:38', 0, 100, NULL, 6, 0),
(32, '2016-01-16 08:35:56', 0, 10, NULL, 6, 0),
(33, '2016-01-16 08:38:57', 12, 0, NULL, 5, 0),
(34, '2016-01-16 08:39:20', 12, 0, NULL, 5, 0),
(35, '2016-01-16 08:40:07', 76, 0, NULL, 5, 0),
(36, '2016-01-16 08:40:30', 0, 0, NULL, 5, 0),
(37, '2016-01-16 08:40:39', 1, 0, NULL, 5, 0),
(38, '2016-01-16 08:40:44', 0, 1, NULL, 5, 0),
(39, '2016-01-16 08:48:41', 12, 0, NULL, 5, 0),
(40, '2016-01-16 08:51:08', 0, 10, NULL, 5, 0),
(41, '2016-01-16 08:52:32', 10, 0, NULL, 5, 0),
(42, '2016-01-16 08:52:41', 0, 10000, NULL, 6, 0),
(43, '2016-01-16 08:52:50', 0, 10, NULL, 5, 0),
(44, '2016-01-16 16:32:45', 20, 0, NULL, 5, 0),
(45, '2016-01-16 16:32:56', 0, 10, NULL, 5, 0),
(46, '2016-01-16 16:44:50', 100, 0, NULL, 7, 0),
(47, '2016-01-16 18:30:32', 56, 0, NULL, 5, 0),
(48, '2016-01-17 07:03:28', 0, 0, 12, 2, 0),
(49, '2016-01-17 07:04:59', 0, 0, 50, 5, 0),
(50, '2016-01-17 07:12:14', 0, 0, NULL, 5, 20),
(51, '2016-01-17 07:12:34', 0, 0, 45, 5, 0),
(52, '2016-01-17 07:42:11', 0, 0, 10, 5, 0),
(53, '2016-01-17 07:43:20', 0, 0, 10, 5, 0),
(54, '2016-01-17 07:43:55', 0, 0, 10, 5, 0),
(55, '2016-01-17 07:43:55', 0, 0, 10, 6, 0),
(56, '2016-01-17 07:44:04', 0, 0, 10, 5, 0),
(57, '2016-01-17 07:44:04', 0, 0, NULL, 5, 10),
(58, '2016-01-17 07:44:04', 0, 0, 10, 6, 0),
(59, '2016-01-17 07:44:36', 0, 0, 10, 5, 0),
(60, '2016-01-17 07:44:36', 0, 0, NULL, 5, 10),
(61, '2016-01-17 07:44:36', 0, 0, 10, 6, 0),
(62, '2016-01-17 07:44:36', 0, 0, 1, 7, 0),
(63, '2016-01-17 07:54:08', 0, 0, 10, 5, 0),
(64, '2016-01-17 07:54:08', 0, 0, NULL, 5, 10),
(65, '2016-01-17 07:54:08', 0, 0, 10, 6, 0),
(66, '2016-01-17 07:54:08', 0, 0, 1, 7, 0),
(67, '2016-01-17 07:54:22', 0, 0, 10, 5, 0),
(68, '2016-01-17 07:54:22', 0, 0, NULL, 5, 10),
(69, '2016-01-17 07:54:22', 0, 0, 10, 6, 0),
(70, '2016-01-17 07:54:22', 0, 0, 1, 7, 0),
(71, '2016-01-17 07:57:24', 0, 0, 78, 5, 0),
(72, '2016-01-17 08:09:38', 0, 0, 123, 5, 0),
(73, '2016-01-17 08:09:57', 0, 0, 123, 5, 0),
(74, '2016-01-17 08:11:08', 0, 0, 12, 5, 0),
(75, '2016-01-17 08:11:51', 0, 0, 12, 5, 0),
(76, '2016-01-17 08:15:10', 0, 0, 13, 7, 0);

-- --------------------------------------------------------

--
-- Table structure for table `Transaction`
--

CREATE TABLE IF NOT EXISTS `Transaction` (
  `Transaction_id` int(11) NOT NULL,
  `Time_Stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ref_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `selles` int(11) DEFAULT NULL,
  `returns` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Transaction`
--

INSERT INTO `Transaction` (`Transaction_id`, `Time_Stamp`, `ref_id`, `product_id`, `selles`, `returns`) VALUES
(48, '2016-01-06 06:56:20', 2, 5, 12, 0),
(49, '2016-01-06 06:56:20', 2, 6, 0, 23),
(50, '2016-01-14 07:04:52', 4, 5, 50, 0),
(51, '2016-01-13 07:12:05', 4, 5, 0, 20),
(52, '2016-01-21 07:12:20', 2, 5, 45, 0),
(53, '2016-01-20 07:42:00', 2, 5, 10, 0),
(54, '2016-01-14 07:43:11', 3, 5, 10, 0),
(55, '2016-01-14 07:43:11', 3, 5, 10, 0),
(56, '2016-01-14 07:43:11', 3, 6, 10, 0),
(57, '2016-01-14 07:43:11', 3, 5, 10, 10),
(58, '2016-01-14 07:43:11', 3, 6, 10, 0),
(59, '2016-01-14 07:43:11', 3, 5, 10, 10),
(60, '2016-01-14 07:43:11', 3, 6, 10, 0),
(61, '2016-01-14 07:43:11', 3, 7, 1, 0),
(62, '2016-01-14 07:43:11', 3, 5, 10, 10),
(63, '2016-01-14 07:43:11', 3, 6, 10, 0),
(64, '2016-01-14 07:43:11', 3, 7, 1, 0),
(65, '2016-01-14 07:43:11', 3, 5, 10, 10),
(66, '2016-01-14 07:43:11', 3, 6, 10, 0),
(67, '2016-01-14 07:43:11', 3, 7, 1, 0),
(68, '2016-01-12 07:57:15', 4, 5, 78, 0),
(69, '2016-01-13 08:09:29', 4, 5, 123, 0),
(70, '2015-12-30 08:09:50', 2, 5, 123, 0),
(71, '2016-01-12 08:10:59', 4, 5, 12, 0),
(72, '2016-01-14 08:11:43', 3, 5, 12, 0),
(73, '2016-01-06 08:13:22', 4, 7, 13, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Advances`
--
ALTER TABLE `Advances`
  ADD PRIMARY KEY (`Advance_id`);

--
-- Indexes for table `Missing`
--
ALTER TABLE `Missing`
  ADD PRIMARY KEY (`Missing_id`),
  ADD KEY `Ref_id` (`Ref_id`),
  ADD KEY `Ref_id_2` (`Ref_id`);

--
-- Indexes for table `Product`
--
ALTER TABLE `Product`
  ADD PRIMARY KEY (`Product_id`);

--
-- Indexes for table `Ref`
--
ALTER TABLE `Ref`
  ADD PRIMARY KEY (`Ref_id`);

--
-- Indexes for table `refSalary`
--
ALTER TABLE `refSalary`
  ADD PRIMARY KEY (`salary_id`);

--
-- Indexes for table `Stock`
--
ALTER TABLE `Stock`
  ADD PRIMARY KEY (`Stock_id`,`time_Stamp`);

--
-- Indexes for table `Transaction`
--
ALTER TABLE `Transaction`
  ADD PRIMARY KEY (`Transaction_id`,`Time_Stamp`,`ref_id`,`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Advances`
--
ALTER TABLE `Advances`
  MODIFY `Advance_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `Missing`
--
ALTER TABLE `Missing`
  MODIFY `Missing_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `Product`
--
ALTER TABLE `Product`
  MODIFY `Product_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `Ref`
--
ALTER TABLE `Ref`
  MODIFY `Ref_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `refSalary`
--
ALTER TABLE `refSalary`
  MODIFY `salary_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `Stock`
--
ALTER TABLE `Stock`
  MODIFY `Stock_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=77;
--
-- AUTO_INCREMENT for table `Transaction`
--
ALTER TABLE `Transaction`
  MODIFY `Transaction_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=74;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
