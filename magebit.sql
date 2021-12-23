-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 11, 2021 at 01:40 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

CREATE DATABASE magebit;
USE magebit;

-- --------------------------------------------------------

--
-- Table structure for table `emails`
--

CREATE TABLE `emails` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `emails`
--

INSERT INTO `emails` (`id`, `email`, `created_at`) VALUES
(59, 'test3@hotmail.com', '2021-08-10 19:21:51'),
(60, 'hl@yahoo.com', '2021-08-10 19:21:59'),
(61, 'test@gmail.com', '2021-08-10 20:23:25'),
(62, 'aest@gmail.com', '2021-08-10 20:23:29'),
(63, 'best@gmail.com', '2021-08-10 20:23:32'),
(64, 'vcest@gmail.com', '2021-08-10 20:23:37'),
(65, 'cest@gmail.com', '2021-08-10 20:23:40'),
(66, 'aaest@gmail.com', '2021-08-10 20:23:44'),
(68, 'heinriks@gz.com', '2021-08-10 23:24:52'),
(69, 'heinriks.lecis@gmail.com', '2021-08-10 23:55:35'),
(70, '1@gmail.com', '2021-08-11 00:48:54'),
(71, '2@gmail.com', '2021-08-11 00:48:54'),
(72, '3@gmail.com', '2021-08-11 00:48:54'),
(73, 'ggg@gmail.com', '2021-08-11 00:48:54'),
(74, '324@gmail.com', '2021-08-11 00:48:54'),
(75, 'dsad@yahoo.com', '2021-08-11 00:48:54'),
(76, 'sadsad@hotmail.com', '2021-08-11 00:48:54'),
(77, '23sdfa@no.no', '2021-08-11 00:48:54'),
(78, 'dsa@gmail.com', '2021-08-11 00:48:54'),
(79, 'adasd1@gmail.com', '2021-08-11 00:48:54'),
(80, 'test43@gmail.com', '2021-08-11 00:58:43'),
(81, 'heinriks.lecis@gmail.coff', '2021-08-11 01:45:37'),
(82, 'test43@gmail.com.lol', '2021-08-11 02:14:53'),
(83, 'testyahoo@yahoo.com.lv', '2021-08-11 02:15:24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `emails`
--
ALTER TABLE `emails`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `emails`
--
ALTER TABLE `emails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
