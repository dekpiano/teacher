-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 21, 2021 at 12:04 PM
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
-- Table structure for table `tb_extra_subject`
--

CREATE TABLE `tb_extra_subject` (
  `extra_id` int(5) NOT NULL,
  `extra_year` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  `extra_term` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `extra_course_code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `extra_course_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `extra_course_teacher` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `extra_grade_level` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `extra_number_students` int(3) NOT NULL,
  `extra_comment` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tb_extra_subject`
--

INSERT INTO `tb_extra_subject` (`extra_id`, `extra_year`, `extra_term`, `extra_course_code`, `extra_course_name`, `extra_course_teacher`, `extra_grade_level`, `extra_number_students`, `extra_comment`) VALUES
(1, '2564', '2', 'ว20151', 'วิทย์คอม 1', 'นางสาวสุนันทา ภักดีวณิชย์', '1|2|3|4|5|6', 30, ''),
(2, '2564', '2', 'ว20151', 'วิทย์คอม 1', 'นางสาวกุสุมา ฤทธิ์บำรุง', '2|3', 30, '555'),
(3, '2564', '1', 'ว20151', 'วิทย์คอม 1', 'นางสาวนงนุช บุรุษพัฒน์', '5', 30, '555'),
(4, '2565', '2', 'ว20151', 'วิทย์คอม 1', 'นางสาวนงนุช บุรุษพัฒน์', '2', 30, ''),
(5, '2564', '1', 'ส30012', 'สังคมเพิ่ม', 'นางสาวนกแก้ว สีคำน้อย', '5|6', 30, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_extra_subject`
--
ALTER TABLE `tb_extra_subject`
  ADD PRIMARY KEY (`extra_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_extra_subject`
--
ALTER TABLE `tb_extra_subject`
  MODIFY `extra_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
