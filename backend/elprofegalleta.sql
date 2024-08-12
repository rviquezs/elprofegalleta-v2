-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 12, 2024 at 05:17 AM
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
-- Table structure for table `cursos`
--

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cursos`
--

INSERT INTO `cursos` (`id`, `name`, `duration`, `modalidad`, `category`, `price`, `promoter`, `inscriptions`, `qr_code`, `img1`, `img2`, `img3`, `last_updated`) VALUES
(3, 'Curso de Inglés Básico', 30, 'Presencial', 'Idiomas', '150', 3, 0, 'qr_code1', 'img1.jpg', 'img2.jpg', 'img3.jpg', '2024-08-08 23:20:51'),
(4, 'Curso de Inglés Avanzado', 60, 'Online', 'Idiomas', '300', 4, 0, 'qr_code2', 'img1.jpg', 'img2.jpg', 'img3.jpg', '2024-08-08 23:20:51'),
(5, 'Curso de Francés Inicial', 40, 'Presencial', 'Idiomas', '200', 5, 0, 'qr_code3', 'img1.jpg', 'img2.jpg', 'img3.jpg', '2024-08-08 23:20:51'),
(6, 'Curso de Alemán Intermedio', 50, 'Online', 'Idiomas', '250', 6, 0, 'qr_code4', 'img1.jpg', 'img2.jpg', 'img3.jpg', '2024-08-08 23:20:51');

-- --------------------------------------------------------

--
-- Table structure for table `promotores`
--

CREATE TABLE `promotores` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone_number` int(11) NOT NULL,
  `whatsapp` int(11) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `promotores`
--

INSERT INTO `promotores` (`id`, `name`, `phone_number`, `whatsapp`, `email`) VALUES
(3, 'Juan Pérez', 123456789, 987654321, 'juan.perez@example.com'),
(4, 'María Gómez', 234567890, 876543210, 'maria.gomez@example.com'),
(5, 'Carlos Martínez', 345678901, 765432109, 'carlos.martinez@example.com'),
(6, 'Ana López', 456789012, 654321098, 'ana.lopez@example.com');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `testimonios`
--

INSERT INTO `testimonios` (`id`, `user_id`, `course_id`, `rating`, `comment`, `created_at`) VALUES
(11, 1, 3, 5, 'Este curso de inglés básico ha sido increíble. Los profesores son muy capacitados y el material es excelente.', '2024-08-08 23:23:50'),
(12, 2, 4, 4, 'El curso de inglés avanzado es muy completo, aunque me gustaría más material práctico.', '2024-08-08 23:23:50'),
(13, 3, 5, 5, 'Me encantó el curso de francés inicial. La modalidad presencial facilitó mucho el aprendizaje.', '2024-08-08 23:23:50'),
(14, 4, 6, 3, 'El curso de alemán intermedio fue bueno, pero creo que podría mejorarse la interacción en línea.', '2024-08-08 23:23:50');

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `cedula` varchar(9) NOT NULL,
  `password` varchar(100) NOT NULL,
  `reset_token_hash` varchar(100) NOT NULL,
  `reset_token_expires_at` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `last_name1` varchar(100) NOT NULL,
  `last_name2` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `whatsapp` int(8) NOT NULL,
  `phone_number` int(8) DEFAULT NULL,
  `picture` text DEFAULT NULL,
  `role` varchar(50) NOT NULL DEFAULT 'user',
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id`, `cedula`, `password`, `reset_token_hash`, `reset_token_expires_at`, `name`, `last_name1`, `last_name2`, `email`, `whatsapp`, `phone_number`, `picture`, `role`, `date_created`) VALUES
(1, '123456789', 'hashedpassword1', '', 0, 'Carlos', 'Gómez', 'Morales', 'carlos.gomez@example.com', 12345678, 87654321, NULL, 'user', '2024-08-08 23:23:05'),
(2, '987654321', 'hashedpassword2', '', 0, 'Ana', 'Pérez', 'Rojas', 'ana.perez@example.com', 23456789, NULL, NULL, 'user', '2024-08-08 23:23:05'),
(3, '456789123', 'hashedpassword3', '', 0, 'Luis', 'Hernández', 'Jiménez', 'luis.hernandez@example.com', 34567890, 98765432, NULL, 'user', '2024-08-08 23:23:05'),
(4, '789123456', 'hashedpassword4', '', 0, 'María', 'López', 'Martínez', 'maria.lopez@example.com', 45678901, 12345678, NULL, 'user', '2024-08-08 23:23:05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `promoter` (`promoter`);

--
-- Indexes for table `promotores`
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
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cedula` (`cedula`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cursos`
--
ALTER TABLE `cursos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `promotores`
--
ALTER TABLE `promotores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `testimonios`
--
ALTER TABLE `testimonios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cursos`
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
