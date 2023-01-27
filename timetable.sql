-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 12, 2019 at 06:42 AM
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
-- Table structure for table `timetable`
--

CREATE TABLE `timetable` (
  `id` int(11) NOT NULL,
  `grade_id` int(11) NOT NULL,
  `weekday` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `timetable`
--

INSERT INTO `timetable` (`id`, `grade_id`, `weekday`, `subject_id`) VALUES
(35, 1, 1, 1),
(36, 2, 1, 3),
(37, 3, 1, 6),
(38, 4, 1, 6),
(39, 5, 1, 8),
(40, 6, 1, 1),
(41, 1, 2, 1),
(42, 2, 2, 12),
(43, 3, 2, 6),
(45, 4, 2, 6),
(46, 5, 2, 17),
(47, 6, 2, 4),
(48, 7, 2, 8),
(49, 1, 3, 10),
(50, 2, 3, 11),
(51, 3, 3, 6),
(52, 4, 3, 3),
(53, 5, 3, 4),
(54, 6, 3, 12),
(55, 7, 3, 18),
(56, 1, 4, 4),
(57, 2, 4, 3),
(58, 3, 4, 9),
(59, 4, 4, 14),
(60, 5, 4, 8),
(61, 6, 4, 7),
(63, 7, 4, 15),
(64, 8, 4, 19),
(65, 1, 5, 13),
(66, 2, 5, 8),
(67, 3, 5, 1),
(68, 4, 5, 11),
(69, 5, 5, 7),
(70, 6, 5, 1),
(71, 1, 6, 4),
(72, 2, 6, 7),
(73, 3, 6, 2),
(74, 4, 6, 2),
(75, 5, 6, 16),
(76, 6, 6, 16);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `timetable`
--
ALTER TABLE `timetable`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `timetable`
--
ALTER TABLE `timetable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
