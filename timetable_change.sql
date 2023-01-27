-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 12, 2019 at 06:44 AM
-- Server version: 10.3.14-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id5580813_main`
--

-- --------------------------------------------------------

--
-- Table structure for table `timetable_change`
--

CREATE TABLE `timetable_change` (
  `id` int(11) NOT NULL,
  `date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `grade_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `timetable_change`
--

INSERT INTO `timetable_change` (`id`, `date`, `grade_id`, `subject_id`) VALUES
(1, '29.9.2018', 1, 4),
(2, '29.9.2018', 2, 3),
(3, '29.9.2018', 3, 2),
(4, '29.9.2018', 4, 2),
(5, '29.9.2018', 5, 1),
(6, '13.10.2018', 1, 20),
(7, '13.10.2018', 2, 7),
(8, '13.10.2018', 3, 2),
(9, '13.10.2018', 4, 2),
(10, '13.10.2018', 5, 16),
(11, '13.10.2018', 6, 16),
(12, '13.10.2018', 7, 4),
(13, '18.10.2018', 7, 19),
(14, '9.11.2018', 5, 20),
(15, '9.11.2018', 6, 20),
(16, '12.11.2018', 2, 15),
(17, '30.11.2018', 6, 2),
(18, '30.11.2018', 4, 9),
(19, '3.12.2018', 5, 1),
(20, '3.12.2018', 6, 2),
(21, '27.8.2018', 1, 20),
(22, '7.12.2018', 1, 8),
(23, '7.12.2018', 2, 11),
(24, '7.12.2018', 4, 13),
(25, '6.12.2018', 8, 20),
(26, '6.12.2018', 5, 19),
(29, '24.12.2018', 6, 21),
(30, '24.12.2018', 5, 21),
(31, '29.12.2018', 1, 22),
(32, '29.12.2018', 2, 17),
(33, '29.12.2018', 3, 21),
(34, '29.12.2018', 4, 21),
(35, '29.12.2018', 5, 21),
(36, '29.12.2018', 6, 21),
(37, '27.12.2018', 8, 21),
(38, '27.12.2018', 7, 21),
(39, '15.1.2019', 2, 8),
(40, '15.1.2019', 7, 21),
(44, '27.12.2018', 1, 4),
(45, '22.1.2019', 2, 8),
(46, '22.1.2019', 7, 21),
(47, '23.1.2019', 1, 20),
(48, '23.1.2019', 2, 10),
(49, '26.1.2019', 3, 16),
(50, '26.1.2019', 4, 4),
(51, '26.1.2019', 5, 21),
(52, '26.1.2019', 6, 21),
(53, '1.2.2019', 7, 19),
(54, '5.2.2019', 7, 21),
(55, '5.2.2019', 2, 8),
(56, '12.2.2019', 2, 8),
(57, '12.2.2019', 5, 21),
(58, '12.2.2019', 6, 21),
(59, '12.2.2019', 7, 21),
(60, '14.2.2019', 1, 20),
(61, '14.2.2019', 2, 20),
(62, '21.2.2019', 2, 4),
(63, '26.2.2019', 5, 3),
(64, '26.2.2019', 2, 12),
(65, '26.2.2019', 7, 8),
(66, '4.3.2019', 3, 1),
(67, '4.3.2019', 4, 1),
(68, '5.3.2019', 1, 2),
(69, '5.3.2019', 3, 2),
(70, '5.3.2019', 4, 2),
(71, '6.3.2019', 1, 20),
(72, '6.3.2019', 3, 10),
(73, '7.3.2019', 8, 21),
(74, '18.3.2019', 1, 2),
(75, '18.3.2019', 6, 2),
(76, '19.3.2019', 1, 2),
(77, '19.3.2019', 3, 2),
(78, '19.3.2019', 4, 2),
(79, '21.3.2019', 2, 4),
(80, '21.3.2019', 3, 4),
(81, '22.3.2019', 5, 17),
(82, '22.3.2019', 6, 21),
(83, '4.4.2019', 2, 4),
(84, '4.4.2019', 3, 4),
(85, '9.4.2019', 1, 2),
(86, '12.4.2019', 3, 2),
(87, '18.4.2019', 2, 4),
(88, '18.4.2019', 3, 4),
(89, '18.4.2019', 4, 4),
(90, '24.4.2019', 1, 20),
(91, '25.4.2019', 2, 4),
(92, '18.5.2019', 1, 20),
(93, '24.5.2019', 3, 22),
(94, '24.5.2019', 4, 21),
(95, '24.5.2019', 5, 21),
(96, '24.5.2019', 6, 21);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `timetable_change`
--
ALTER TABLE `timetable_change`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `timetable_change`
--
ALTER TABLE `timetable_change`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;