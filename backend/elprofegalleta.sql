-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 08, 2024 at 11:58 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `elprofegalleta`
--

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--
CREATE DATABASE IF NOT EXISTS elprofegalleta;
USE elprofegalleta;

CREATE TABLE `cursos` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `duration` int(11) NOT NULL,
  `modalidad` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `promoter` int(11) NOT NULL,
  `inscriptions` int(11) NOT NULL DEFAULT 0,
  `qr_code` text NOT NULL,
  `img1` text NOT NULL,
  `img2` text NOT NULL,
  `img3` text NOT NULL,
  `last_updated` datetime NOT NULL DEFAULT current_timestamp()
);

--
-- Dumping data for table `courses`
--

-- INSERT INTO `cursos` (`id`, `name`, `duration`, `modalidad`, `category`, `price`, `promoter`, `inscriptions`, `qr_code`, `img1`, `img2`, `img3`, `last_updated`) VALUES
-- (1, 'Introduction to Python', 30, 'Online', 'Programming', '100', 1, 10, 'base64QRCode1', 'base64Img1_1', 'base64Img1_2', 'base64Img1_3', '2024-08-08 15:54:27'),
-- (2, 'Advanced Excel Techniques', 20, 'Online', 'Data Analysis', '150', 2, 25, 'base64QRCode2', 'base64Img2_1', 'base64Img2_2', 'base64Img2_3', '2024-08-08 15:54:27');

-- --------------------------------------------------------

--
-- Table structure for table `promoters`
--

CREATE TABLE `promotores` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone_number` int(11) NOT NULL,
  `whatsapp` int(11) NOT NULL,
  `email` varchar(100) NOT NULL
);

--
-- Dumping data for table `promoters`
--

-- INSERT INTO `promotores` (`id`, `name`, `phone_number`, `whatsapp`, `email`) VALUES
-- (1, 'John Doe', 1234567890, 1234567890, 'john.doe@example.com'),
-- (2, 'Jane Smith', 2147483647, 2147483647, 'jane.smith@example.com');

-- --------------------------------------------------------

--
-- Table structure for table `testimonios`
--

CREATE TABLE `testimonios` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `rating` tinyint(1) NOT NULL CHECK (`rating` between 1 and 5),
  `comment` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
);
--
-- Dumping data for table `testimonios`
--

-- INSERT INTO `testimonios` (`id`, `user_id`, `course_id`, `rating`, `comment`, `created_at`) VALUES
-- (1, 1, 1, 5, 'This course was incredibly insightful and well-organized. Highly recommended!', '2024-08-08 15:52:51'),
-- (2, 2, 2, 4, 'Great course with useful content, though it could use more advanced examples.', '2024-08-08 15:52:51');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `cedula` varchar(9) NOT NULL,
  `password` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `last_name1` varchar(100) NOT NULL,
  `last_name2` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `whatsapp` int(8) NOT NULL,
  `phone_number` int(8) DEFAULT NULL,
  `picture` text DEFAULT NULL,
  `role` varchar(50) NOT NULL DEFAULT 'user',
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
);

--
-- Dumping data for table `users`
--

-- INSERT INTO `usuarios` (`id`, `cedula`, `password`, `name`, `last_name1`, `last_name2`, `email`, `whatsapp`, `phone_number`, `picture`, `role`, `date_created`) VALUES
-- (1, '123456789', 'password123', 'Alice', 'Gonzalez', 'Martinez', 'alice@example.com', 12345678, 87654321, NULL, 'user', '2024-08-08 15:53:42'),
-- (2, '987654321', 'password456', 'Bob', 'Rodriguez', 'Lopez', 'bob@example.com', 87654321, NULL, NULL, 'admin', '2024-08-08 15:53:42');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `courses`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `promoter` (`promoter`);

--
-- Indexes for table `promoters`
--
ALTER TABLE `promotores`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testimonios`
--
ALTER TABLE `testimonios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cedula` (`cedula`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `cursos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `promoters`
--
ALTER TABLE `promotores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `testimonios`
--
ALTER TABLE `testimonios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `courses`
--
ALTER TABLE `cursos`
  ADD CONSTRAINT `cursos_ibfk_1` FOREIGN KEY (`promoter`) REFERENCES `promotores` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `testimonios`
--
ALTER TABLE `testimonios`
  ADD CONSTRAINT `testimonios_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `testimonios_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `cursos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
