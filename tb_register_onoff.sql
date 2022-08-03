-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 03, 2022 at 11:19 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `skjacth_academic`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_register_onoff`
--

CREATE TABLE `tb_register_onoff` (
  `onoff_id` int(11) NOT NULL,
  `onoff_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `onoff_status` varchar(15) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tb_register_onoff`
--

INSERT INTO `tb_register_onoff` (`onoff_id`, `onoff_name`, `onoff_status`) VALUES
(1, 'DoGradeStudent', 'true'),
(2, 'ก่อนกลางภาค', 'on'),
(3, 'สอบกลางภาค', 'off'),
(4, 'หลังกลางภาค', 'on'),
(5, 'สอบปลายภาค', 'off');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_register_onoff`
--
ALTER TABLE `tb_register_onoff`
  ADD PRIMARY KEY (`onoff_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_register_onoff`
--
ALTER TABLE `tb_register_onoff`
  MODIFY `onoff_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
