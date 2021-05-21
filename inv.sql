-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 21, 2021 at 09:29 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inv`
--

-- --------------------------------------------------------

--
-- Table structure for table `inv_main`
--

CREATE TABLE `inv_main` (
  `inv_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `company_id` varchar(10) NOT NULL,
  `create_dt` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `inv_main`
--

INSERT INTO `inv_main` (`inv_id`, `name`, `company_id`, `create_dt`) VALUES
(43, 'TurtleT', '1', '2021-05-17 16:40:35'),
(44, 'สถาพร', '1', '2021-05-17 16:40:38'),
(45, 'TurtleT', '3', '2021-05-18 08:41:56'),
(46, 'TurtleT', '2', '2021-05-18 09:15:25'),
(47, 'TurtleT', '4', '2021-05-18 15:05:10'),
(48, 'TurtleT', '3', '2021-05-19 14:05:10'),
(49, 'admin', '4', '2021-05-20 13:36:03');

-- --------------------------------------------------------

--
-- Table structure for table `inv_sub`
--

CREATE TABLE `inv_sub` (
  `sub_id` int(11) NOT NULL,
  `sub_name` varchar(200) NOT NULL,
  `company_id` varchar(200) NOT NULL,
  `create_dt` datetime NOT NULL DEFAULT current_timestamp(),
  `inv_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `inv_sub`
--

INSERT INTO `inv_sub` (`sub_id`, `sub_name`, `company_id`, `create_dt`, `inv_id`) VALUES
(41, 'asd', '1', '2021-05-17 16:40:43', 43),
(42, 'asd', '1', '2021-05-17 16:44:46', 44),
(43, 'asd', '3', '2021-05-18 08:42:00', 45),
(44, 'asd', '3', '2021-05-18 08:48:07', 45),
(45, 'asd', '2', '2021-05-18 09:15:30', 46),
(46, 'asd', '4', '2021-05-18 15:05:14', 47),
(47, 'asd', '3', '2021-05-19 14:05:34', 45),
(48, 'asd10', '3', '2021-05-19 14:05:43', 45),
(49, 'sub2', '4', '2021-05-20 13:37:13', 49),
(50, 'asd2', '4', '2021-05-20 14:18:05', 47),
(51, 'asd', '4', '2021-05-20 14:20:48', 47),
(52, 'asd', '2', '2021-05-20 16:53:08', 46);

-- --------------------------------------------------------

--
-- Table structure for table `prod`
--

CREATE TABLE `prod` (
  `pd_id` int(11) NOT NULL,
  `pd_c` varchar(200) NOT NULL,
  `quantity` int(11) NOT NULL,
  `sub_id` int(11) NOT NULL,
  `company_id` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `pd_id` int(11) NOT NULL,
  `pd_c` varchar(200) NOT NULL,
  `quantity` int(11) NOT NULL,
  `sub_id` int(11) NOT NULL,
  `company_id` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`pd_id`, `pd_c`, `quantity`, `sub_id`, `company_id`) VALUES
(208, '410007.03;HAR217', 5, 49, '4'),
(209, '410007.03;HAR217', 5, 50, '4'),
(210, '410007.03;HAR217', 5, 51, '4'),
(212, '11102028.03;VOU11', 5, 45, '2'),
(213, '11102028.03;VOU11', 1, 52, '2'),
(215, '410007.03;HAR217', 2, 46, '4'),
(218, '410007.03;HAR219', 1, 46, '4'),
(219, '410007.03;NTR1001', 1, 50, '4'),
(220, '410007.03;HAR219', 1, 50, '4');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `inv_main`
--
ALTER TABLE `inv_main`
  ADD PRIMARY KEY (`inv_id`);

--
-- Indexes for table `inv_sub`
--
ALTER TABLE `inv_sub`
  ADD PRIMARY KEY (`sub_id`);

--
-- Indexes for table `prod`
--
ALTER TABLE `prod`
  ADD PRIMARY KEY (`pd_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`pd_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `inv_main`
--
ALTER TABLE `inv_main`
  MODIFY `inv_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `inv_sub`
--
ALTER TABLE `inv_sub`
  MODIFY `sub_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `prod`
--
ALTER TABLE `prod`
  MODIFY `pd_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `pd_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=221;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
