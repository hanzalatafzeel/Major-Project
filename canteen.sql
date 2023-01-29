-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 29, 2023 at 10:20 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `canteen`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` double NOT NULL,
  `name` tinytext NOT NULL,
  `email` tinytext NOT NULL,
  `contact` double NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `canteen`
--

CREATE TABLE `canteen` (
  `id` double NOT NULL,
  `name` tinytext NOT NULL,
  `email` tinytext NOT NULL,
  `contact` double NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `canteen`
--

INSERT INTO `canteen` (`id`, `name`, `email`, `contact`, `password`) VALUES
(0, 'Abdul Hadi', 'ahadi520@gmail.com', 9956875787, '9526ee6a76f048c25c970840189c3d22'),
(995615250, 'Abdul Hadi', 'ahadi520@gmail.com', 9956875787, '9526ee6a76f048c25c970840189c3d22');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` double NOT NULL,
  `name` tinytext NOT NULL,
  `email` tinytext NOT NULL,
  `contact` double NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `name`, `email`, `contact`, `password`) VALUES
(202003268, 'Fahad Ansari', 'fahadansari6913@gmail.com', 9956875787, '2af9b1ba42dc5eb01743e6b3759b6e4b'),
(202003271, 'Adnan Hassan', 'addu6913@gmail.com', 8417814091, 'fb9abce118c6f8c034ec673f9f447870'),
(202003271, 'Raiyan Ahmad', 'raiyan00@gmail.com', 6290634911, '221875e3f2f8b7f319c35c8bd4f5fd33'),
(202203268, 'Faraz Ansari', 'farazfz626@gmail.com', 8417814091, 'ff7fcb96b922c6830ed7625eecb70954'),
(202303271, 'Hanzala Tafzeel', 'hanzala123@gmail.com', 8417814091, 'fb29ed3264c5a92bcf74eccd7489e828');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`,`email`(32));

--
-- Indexes for table `canteen`
--
ALTER TABLE `canteen`
  ADD PRIMARY KEY (`id`,`email`(32));

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`,`email`(32));
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
