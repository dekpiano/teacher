-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 29, 2021 at 11:12 AM
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
-- Table structure for table `tb_room_online`
--

CREATE TABLE `tb_room_online` (
  `roomon_id` int(4) NOT NULL,
  `roomon_coursecode` varchar(7) COLLATE utf8_unicode_ci NOT NULL,
  `roomon_coursename` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `roomon_classlevel` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `roomon_linkroom` text COLLATE utf8_unicode_ci NOT NULL,
  `roomon_year` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  `roomon_term` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `roomon_teachid` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `roomon_datecreate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tb_room_online`
--

INSERT INTO `tb_room_online` (`roomon_id`, `roomon_coursecode`, `roomon_coursename`, `roomon_classlevel`, `roomon_linkroom`, `roomon_year`, `roomon_term`, `roomon_teachid`, `roomon_datecreate`) VALUES
(1, 'ว30113', 'การออกแบบเทคโนโลยี', '1/4', 'http://www.skr.ac.th/info/vc-googleclassroom.php', '2564', '2', 'pers_021', '2021-10-29 12:55:14'),
(2, 'ว30113', 'การออกแบบเทคโนโลยี', '5/1', 'http://www.skr.ac.th/info/vc-googleclassroom.php', '2564', '2', 'pers_021', '2021-10-29 12:56:33'),
(4, 'ว31013', 'วิทยาการคำนวณ', '3/1', 'https://api.jquery.com/removeclass/', '2564', '2', 'pers_021', '2021-10-29 15:09:44');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_room_online`
--
ALTER TABLE `tb_room_online`
  ADD PRIMARY KEY (`roomon_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_room_online`
--
ALTER TABLE `tb_room_online`
  MODIFY `roomon_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
