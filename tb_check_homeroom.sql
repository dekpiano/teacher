-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 05, 2022 at 09:56 AM
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
-- Table structure for table `tb_check_homeroom`
--

CREATE TABLE `tb_check_homeroom` (
  `chk_home_id` int(11) NOT NULL COMMENT 'รหัสตาราง',
  `chk_home_date` datetime NOT NULL COMMENT 'วันที่เช็ค',
  `chk_home_teacher` varchar(15) COLLATE utf8_unicode_ci NOT NULL COMMENT 'ครูผู้เช็ค',
  `chk_home_room` varchar(10) COLLATE utf8_unicode_ci NOT NULL COMMENT 'ห้อง',
  `chk_home_ma` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'มาเรีย',
  `chk_home_khad` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'ขาดเรียน',
  `chk_home_la` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'ลา',
  `chk_home_sahy` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'สาย',
  `chk_home_kid` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'กิจกรรม',
  `chk_home_hnee` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'หนีเรียน',
  `chk_home_term` varchar(1) COLLATE utf8_unicode_ci NOT NULL COMMENT 'ภาคเรียน',
  `chk_home_yaer` varchar(4) COLLATE utf8_unicode_ci NOT NULL COMMENT 'ปีการศึกษา'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tb_check_homeroom`
--

INSERT INTO `tb_check_homeroom` (`chk_home_id`, `chk_home_date`, `chk_home_teacher`, `chk_home_room`, `chk_home_ma`, `chk_home_khad`, `chk_home_la`, `chk_home_sahy`, `chk_home_kid`, `chk_home_hnee`, `chk_home_term`, `chk_home_yaer`) VALUES
(1, '2022-06-05 14:54:56', 'pers_013', '5/4', '18313|18323|18626|18629|18641|18997|19029|19341|19342|19345', '', '18924|19331|19334|19339|19346|19347|19353', '18926|19041|19340', '18328|18449|18625|18643|18666|19333|19349', '19356|19399', '1', '2565');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_check_homeroom`
--
ALTER TABLE `tb_check_homeroom`
  ADD PRIMARY KEY (`chk_home_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_check_homeroom`
--
ALTER TABLE `tb_check_homeroom`
  MODIFY `chk_home_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสตาราง', AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
