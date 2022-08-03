-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 24, 2022 at 10:47 AM
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
-- Table structure for table `tb_register_score`
--

CREATE TABLE `tb_register_score` (
  `regscore_ID` int(5) NOT NULL COMMENT 'รหัสตาราง',
  `regscore_subjectID` int(5) NOT NULL COMMENT 'รหัสวิชา',
  `regscore_namework` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT 'ชื่อรายการงาน',
  `regscore_score` int(3) NOT NULL COMMENT 'คะแนนที่เก็บ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tb_register_score`
--

INSERT INTO `tb_register_score` (`regscore_ID`, `regscore_subjectID`, `regscore_namework`, `regscore_score`) VALUES
(1, 5, 'ก่อนกลางภาค', 30),
(2, 5, 'สอบกลางภาค', 10),
(3, 5, 'หลังกลางภาค', 30),
(4, 5, 'สอบปลายภาค', 30);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_register_score`
--
ALTER TABLE `tb_register_score`
  ADD PRIMARY KEY (`regscore_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_register_score`
--
ALTER TABLE `tb_register_score`
  MODIFY `regscore_ID` int(5) NOT NULL AUTO_INCREMENT COMMENT 'รหัสตาราง', AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
