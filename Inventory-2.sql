-- phpMyAdmin SQL Dump
-- version 4.4.3
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 19, 2016 at 09:09 AM
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
  `Time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Advances`
--

INSERT INTO `Advances` (`Advance_id`, `ref_id`, `Amount`, `Time_stamp`) VALUES
(28, 8, '500.0000', '2016-01-18 16:24:59'),
(29, 4, '78.0000', '2016-01-05 16:24:59'),
(30, 7, '0.1000', '2016-01-21 16:24:59'),
(33, 0, '0.0000', '0000-00-00 00:00:00'),
(34, 0, '0.0000', '0000-00-00 00:00:00'),
(35, 0, '0.0000', '0000-00-00 00:00:00'),
(37, 0, '0.0000', '0000-00-00 00:00:00'),
(38, 0, '0.0000', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `Missing`
--

CREATE TABLE IF NOT EXISTS `Missing` (
  `Missing_id` int(11) NOT NULL,
  `Ref_id` int(11) NOT NULL,
  `Product_id` int(11) NOT NULL,
  `Time_Stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `totalMissingcost` double(19,4) NOT NULL,
  `NoOfItem` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Missing`
--

INSERT INTO `Missing` (`Missing_id`, `Ref_id`, `Product_id`, `Time_Stamp`, `totalMissingcost`, `NoOfItem`) VALUES
(10, 3, 7, '2016-01-07 18:09:49', 10000.0000, 0),
(11, 4, 8, '2016-01-17 19:14:47', 330.0000, 0),
(12, 4, 9, '2016-01-06 19:40:20', 250.0000, 0),
(14, 2, 3, '2016-01-18 08:17:40', -132.2300, 0),
(15, 2, 3, '2016-01-18 08:17:43', -132.2300, 0),
(16, 8, 7, '2016-01-01 08:20:24', 12500.0000, 0),
(17, 7, 5, '2016-01-18 08:21:22', 12300.0000, 0),
(18, 7, 7, '2016-01-18 08:21:57', -125000.0000, 0),
(19, 7, 7, '2016-01-18 08:22:57', -125000.0000, 0),
(20, 7, 5, '2016-01-18 08:23:19', -12300.0000, 0),
(21, 9, 5, '2016-01-18 08:24:35', 1230.0000, 0),
(22, 9, 7, '2016-01-18 08:25:26', -12500.0000, 0),
(23, 10, 11, '2016-01-18 08:27:32', 60.0000, 0),
(24, 10, 11, '2016-01-18 08:28:08', -60.0000, 0),
(25, 10, 11, '2016-01-18 08:28:53', -24.0000, 0);

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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Product`
--

INSERT INTO `Product` (`Product_id`, `Product_Name`, `Cost`, `Selling_price`, `Commision`, `currentStock`) VALUES
(5, 'testB', '123.0100', '1000.0000', '1231212.0000', 99),
(6, 'asdase', '22134.3300', '32422.3450', '3252.2340', 234416),
(7, 'DVD', '1250.0000', '5000.0000', '150.0000', 123512),
(8, 'led', '33.0000', '342.0000', '324.0000', 1000000),
(9, 'gas', '50.0000', '100.0000', '1000.0000', -26),
(10, 'new', '23.0800', '324.0000', '324.0000', 0),
(11, '11', '12.0000', '123.0000', '213.0000', 12),
(12, 'wed', '213.0000', '123.0000', '123.0000', 0),
(13, 'led', '123.0000', '123.0000', '234.0000', 0),
(14, 'AAAA', '78.0000', '898.0000', '89.0000', 0),
(15, 'yay"', '67.0000', '67.0000', '9.0000', 0),
(16, 'hello', '100000.0000', '2.0000', '5.0000', 0);

-- --------------------------------------------------------

--
-- Table structure for table `Ref`
--

CREATE TABLE IF NOT EXISTS `Ref` (
  `Ref_id` int(11) NOT NULL,
  `Ref_Name` varchar(45) DEFAULT NULL,
  `Basic_salary` varchar(45) DEFAULT NULL,
  `Other` varchar(45) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Ref`
--

INSERT INTO `Ref` (`Ref_id`, `Ref_Name`, `Basic_salary`, `Other`) VALUES
(1, '123', '123', '123'),
(2, 'test2', '123.99', 'None'),
(3, 'Tharaka', '67', ''),
(4, 'malshan', '234', ''),
(5, 'abcd', '500', ''),
(6, 'newRef', '100', '23'),
(7, 'pink', '0', ''),
(8, '8y8', '324', ''),
(9, 'lol', '0', '0'),
(10, 'lol2', '2', '');

-- --------------------------------------------------------

--
-- Table structure for table `refSalary`
--

CREATE TABLE IF NOT EXISTS `refSalary` (
  `salary_id` int(11) NOT NULL,
  `ref_id` int(11) DEFAULT NULL,
  `time_Stamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `salary` double(19,4) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB AUTO_INCREMENT=96 DEFAULT CHARSET=latin1;

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
(76, '2016-01-17 08:15:10', 0, 0, 13, 7, 0),
(77, '2016-01-17 19:14:16', 100, 0, NULL, 8, 0),
(78, '2016-01-17 19:33:38', 1000, 0, NULL, 5, 0),
(79, '2016-01-17 19:33:52', 0, 10000, NULL, 6, 0),
(80, '2016-01-17 19:33:59', 0, 100000, NULL, 6, 0),
(81, '2016-01-17 19:34:09', 0, 100000, NULL, 6, 0),
(82, '2016-01-17 19:34:28', 100, 0, NULL, 5, 0),
(83, '2016-01-17 19:34:35', 0, 100, NULL, 5, 0),
(84, '2016-01-17 19:38:40', 0, 100, NULL, 5, 0),
(85, '2016-01-17 19:38:48', 0, 100, NULL, 5, 0),
(86, '2016-01-17 19:38:54', 100, 0, NULL, 5, 0),
(87, '2016-01-17 19:39:13', 1000000, 0, NULL, 8, 0),
(88, '2016-01-18 07:49:45', 10, 0, NULL, 5, 0),
(89, '2016-01-18 07:51:11', 2, 0, NULL, 5, 0),
(90, '2016-01-18 07:51:26', 0, 21, NULL, 5, 0),
(91, '2016-01-18 07:51:37', 0, 40, NULL, 5, 0),
(92, '2016-01-18 08:27:02', 10, 0, NULL, 11, 0),
(93, '2016-01-18 11:01:56', 100, 0, NULL, 7, 0),
(94, '2016-01-18 16:58:13', 10, 0, NULL, 5, 0),
(95, '2016-01-18 16:58:17', 0, 20, NULL, 5, 0);

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
  `returns` int(11) DEFAULT NULL,
  `commission` double(19,4) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=143 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Transaction`
--

INSERT INTO `Transaction` (`Transaction_id`, `Time_Stamp`, `ref_id`, `product_id`, `selles`, `returns`, `commission`) VALUES
(139, '2016-01-18 16:42:11', 6, 5, 10, 10, 0.0000),
(140, '2016-01-18 16:42:11', 6, 6, 3, 0, 975.7020);

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
  ADD PRIMARY KEY (`Transaction_id`,`Time_Stamp`,`ref_id`,`product_id`),
  ADD KEY `ref_id` (`ref_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Advances`
--
ALTER TABLE `Advances`
  MODIFY `Advance_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT for table `Missing`
--
ALTER TABLE `Missing`
  MODIFY `Missing_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `Product`
--
ALTER TABLE `Product`
  MODIFY `Product_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `Ref`
--
ALTER TABLE `Ref`
  MODIFY `Ref_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `refSalary`
--
ALTER TABLE `refSalary`
  MODIFY `salary_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=71;
--
-- AUTO_INCREMENT for table `Stock`
--
ALTER TABLE `Stock`
  MODIFY `Stock_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=96;
--
-- AUTO_INCREMENT for table `Transaction`
--
ALTER TABLE `Transaction`
  MODIFY `Transaction_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=143;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
