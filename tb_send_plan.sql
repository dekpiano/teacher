-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 26, 2021 at 05:05 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.0

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
-- Table structure for table `tb_send_plan`
--

CREATE TABLE `tb_send_plan` (
  `seplan_ID` int(5) NOT NULL,
  `seplan_namesubject` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `seplan_coursecode` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `seplan_typeplan` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `seplan_createdate` datetime NOT NULL,
  `seplan_usersend` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `seplan_learning` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `seplan_inspector1` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `seplan_inspector2` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `seplan_status1` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `seplan_status2` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `seplan_year` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  `seplan_term` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `seplan_file` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tb_send_plan`
--

INSERT INTO `tb_send_plan` (`seplan_ID`, `seplan_namesubject`, `seplan_coursecode`, `seplan_typeplan`, `seplan_createdate`, `seplan_usersend`, `seplan_learning`, `seplan_inspector1`, `seplan_inspector2`, `seplan_status1`, `seplan_status2`, `seplan_year`, `seplan_term`, `seplan_file`) VALUES
(1, 'คอมพิวเตอร์', 'ว30222', 'โครงการสอน', '2021-04-25 09:36:49', 'pers_024', '', '', '', '', '', '', '', 'คูมื่อการเข้าใช้งานระบบรับสมัครนักเรียน_64.pdf'),
(2, 'คอมพิวเตอร์', 'ว30222', 'แผนการสอนหน้าเดียว', '2021-04-25 09:38:07', 'pers_021', '', '', '', '', '', '', '', '(IT)_ระบบบริหารจัดการตารางสอน.pdf'),
(3, 'คอมพวิตเรอื', 'ว30222', 'โครงการสอน', '2021-04-25 09:42:45', 'pers_021', '', '', '', '', '', '', '', '158348315_673781260682866_4257662597501816815_n.jpg'),
(4, 'คอมพวิตเรอื', 'ว30222', 'โครงการสอน', '2021-04-25 09:43:31', 'pers_021', '', '', '', '', '', '', '', 'ประกาศปิดสถานศึกษา.jpg'),
(5, 'คอมพวิตเรอื', 'ว30222', 'แผนการสอนหน้าเดียว', '2021-04-25 09:45:02', 'pers_022', '', '', '', '', '', '', '', '158348315_673781260682866_4257662597501816815_n1.jpg'),
(6, 'คอมพวิตเรอื', 'ว30222', 'โครงการสอน', '2021-04-25 09:45:57', 'pers_021', '', '', '', '', '', '', '', '(IT)_ระบบบริหารจัดการตารางสอน1.pdf'),
(7, 'คอมพิวเตอร์', 'ว30222', 'โครงการสอน', '2021-04-25 09:46:18', 'pers_021', '', '', '', '', '', '', '', 'ประกาศปิดสถานศึกษา.pptx'),
(8, 'คอมพวิตเรอื', 'ว30222', 'โครงการสอน', '2021-04-25 09:53:54', 'pers_023', '', '', '', '', '', '', '', 'ประกาศปิดสถานศึกษา2.pptx'),
(9, 'คอมพวิตเรอื', 'ว30222', 'โครงการสอน', '2021-04-25 09:54:28', 'pers_021', '', '', '', '', '', '', '', 'คูมื่อการเข้าใช้งานระบบรับสมัครนักเรียน_641.pdf'),
(10, 'ภาษาไทย', 'ว30222', 'โครงการสอน', '2021-04-25 09:54:34', 'pers_021', '', '', '', '', '', '', '', 'คูมื่อการเข้าใช้งานระบบรับสมัครนักเรียน_642.pdf'),
(11, 'คอมพวิตเรอื', 'ว30222', 'แผนการสอนเต็ม', '2021-04-25 10:24:05', 'pers_021', 'lear_003', '', '', '', '', '', '', '(IT)_ระบบบริหารจัดการตารางสอน2.pdf'),
(12, 'ภาษาอังกฤษ 1', 'อ32152', 'บันทึกหลังสอน', '2021-04-25 15:35:41', 'pers_021', 'lear_003', '', '', '', '', '', '', '(IT)_ระบบบริหารจัดการตารางสอน3.pdf');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_send_plan`
--
ALTER TABLE `tb_send_plan`
  ADD PRIMARY KEY (`seplan_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_send_plan`
--
ALTER TABLE `tb_send_plan`
  MODIFY `seplan_ID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
