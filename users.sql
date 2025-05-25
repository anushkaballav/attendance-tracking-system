-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 14, 2025 at 04:04 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `attendance_tracker`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `Name`, `email`, `password`, `created_at`) VALUES
(3, 'Apratim Nandy', 'nandyapratim@gmail.com', '$2y$10$dUc898PLQNRMSK/6XcuVhO5Ad1LalpFVrmLTg6Ty8NHS4JSBIOwzq', '2024-11-21 07:14:39'),
(6, 'Apratim Nandy', 'apratim0427@gmail.com', '$2y$10$6QREGX.PIkCe1Q3SBUiSW.K2c9i9TcwieNbtPEp8hzreZ1lqtGMc.', '2024-11-21 09:36:49'),
(7, 'ANUBRATA PAL', 'anubrata@gmail.com', '$2y$10$35JHd8UkTyunFntSBN32N.ozZYEdHrfaOoYPlAZEujLqQDRiXJD6a', '2024-11-21 10:16:58'),
(8, 'Joe', 'joe@gmail.com', '$2y$10$eC3U7i7p9jRWWEgeNRBn9OGxIaApLI/YUjkQxdvg8c1CEOGnZnN8y', '2024-11-21 13:00:12'),
(9, 'Phuchun', 'phuchun@gmial.com', '$2y$10$Ww11AaHVgqZuQoVLcMJtSOTgCfpgRKWDNfbhHgF8u3irrQX/8M22e', '2024-11-22 08:41:45');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
