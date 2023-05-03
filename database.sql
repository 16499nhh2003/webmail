-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 21, 2023 at 01:26 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `database`
--

-- --------------------------------------------------------

--
-- Table structure for table `accountuser`
--

CREATE TABLE `accountuser` (
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `idUser` int(11) NOT NULL,
  `blocked` int(11) NOT NULL,
  `ngayTao` date NOT NULL DEFAULT current_timestamp(),
  `role` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `accountuser`
--

INSERT INTO `accountuser` (`username`, `password`, `idUser`, `blocked`, `ngayTao`, `role`) VALUES
('admin123', 'admin123', 2, 0, '2023-04-20', 0),
('user001', 'user001', 3, 0, '2023-04-20', 1),
('user002', 'user002', 5, 0, '2023-04-21', 1);

-- --------------------------------------------------------

--
-- Table structure for table `email`
--

CREATE TABLE `email` (
  `id` int(11) NOT NULL,
  `chude` varchar(255) NOT NULL,
  `noidung` varchar(255) NOT NULL,
  `nguoigui` varchar(255) NOT NULL,
  `thoigian` date NOT NULL,
  `starred` int(11) NOT NULL,
  `read` int(11) NOT NULL,
  `idFolder` int(11) NOT NULL,
  `username` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `email`
--

INSERT INTO `email` (`id`, `chude`, `noidung`, `nguoigui`, `thoigian`, `starred`, `read`, `idFolder`, `username`) VALUES
(1, 'Web', 'website mailwebsite mailwebsite mailwebsite mailwebsite mailwebsite mailwebsite mailwebsite mailwebsite mailwebsite mailwebsite mailwebsite mailwebsite mailwebsite mailwebsite mailwebsite mailwebsite mailwebsite mailwebsite mailwebsite mailwebsite mailweb', 'nguyenhuyhoa1110@gmail.com', '2023-04-16', 0, 0, 1, 'user001'),
(2, 'TDTU', 'Final', 'vudinhhong@gmail.com', '2023-04-20', 1, 1, 1, 'user001'),
(3, 'Final Test', ' nguyenhuyhoa2003@gmail.comnguyenhuyhoa2003@gmail.comnguyenhuyhoa2003@gmail.comnguyenhuyhoa2003@gmail.comnguyenhuyhoa2003@gmail.comnguyenhuyhoa2003@gmail.comnguyenhuyhoa2003@gmail.comnguyenhuyhoa2003@gmail.com', 'nguyenhuyhoa1110@gmail.com', '2023-04-20', 0, 1, 2, 'user001'),
(54, 'ABC', 'ABC', 'nguyenhuyhoa2003@gmail.com', '2023-04-21', 0, 1, 2, 'user002'),
(55, 'ABC', 'ABC', 'nguyenhuyhoa1110@gmail.com', '2023-04-21', 0, 0, 1, 'user001');

-- --------------------------------------------------------

--
-- Table structure for table `folders`
--

CREATE TABLE `folders` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `folders`
--

INSERT INTO `folders` (`id`, `name`) VALUES
(1, 'Inbox'),
(2, 'Sent'),
(3, 'Draft'),
(4, 'Important');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `email` varchar(255) NOT NULL,
  `gioitinh` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `dob`, `email`, `gioitinh`) VALUES
(2, 'Nguyễn Huy Hòa', '2003-11-10', 'hhh@gmail.com', 1),
(3, 'Hoang Duc Minh', '2003-09-02', 'nguyenhuyhoa2003@gmail.com', 1),
(5, 'Hoàng Gia Khải', '2003-01-01', 'nguyenhuyhoa1110@gmail.com', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accountuser`
--
ALTER TABLE `accountuser`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `email`
--
ALTER TABLE `email`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `folders`
--
ALTER TABLE `folders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `email`
--
ALTER TABLE `email`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `folders`
--
ALTER TABLE `folders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
