-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 18, 2024 at 01:01 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `marinaexpress`
--

-- --------------------------------------------------------

--
-- Table structure for table `registro_datos`
--

CREATE TABLE `registro_datos` (
  `id` int(20) NOT NULL,
  `usuario` varchar(20) NOT NULL,
  `contraseña` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `fecha` varchar(50) NOT NULL,
  `rol` enum('admin','regular') DEFAULT 'regular'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `registro_datos`
--

INSERT INTO `registro_datos` (`id`, `usuario`, `contraseña`, `email`, `fecha`, `rol`) VALUES
(107, '1', '$2y$10$Mu/LCSwwD6AUZm7l8GeUkelVeZjdKeFKeHGLfNccFypXJttp/BdQ.', '1', '15/05/24', 'regular'),
(108, '2', '$2y$10$r4Q.lMmsvxSuhbcEAL/x3On.N5k7Af3h.gtiTppehh6SDMRV5aaWi', '2', '16/05/24', 'regular'),
(109, '3', '$2y$10$yBxwJOYOmAjNLrC98pMPDehI/7f5xxHTearGOmwTtrKaaqsIw8Lly', '3', '17/05/24', 'regular'),
(110, '4', '$2y$10$lZAhcRPpxhT.m0MKQ9W2EOYWrMjd2FaFpyQW6BFPuSW3m/4rs2VwC', '4', '17/05/24', 'regular'),
(111, '5', '$2y$10$LMxnKD3SsE0Jf9v4Wt.22.NI0cXHKJpuqcbd5EHqLMXrMSKa2UWWK', '5', '17/05/24', 'regular'),
(112, 'gabriel', '$2y$10$WP5ENQyJILgzKEN5rTITkeqHsEQuRi3BbnAh/UOZxlp7KMlB97VLG', 'gabrielsabatini16@gmail.com', '17/05/24', 'regular'),
(114, 'marinaexpress', '$2y$10$VSUs1JFFAH0rcn9.c4VLWe.AQRYDg8cJvR0/VKx9Xtb8GL080BRIu', 'MarinaExpress@gmail.com', '18/05/24', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `reservas`
--

CREATE TABLE `reservas` (
  `id` int(11) NOT NULL,
  `codigo_qr` varchar(255) NOT NULL,
  `usuario` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reservas`
--

INSERT INTO `reservas` (`id`, `codigo_qr`, `usuario`, `email`, `fecha_creacion`) VALUES
(76, '0fd4a562-1ede-4083-a584-050a47024eda', 'gabriel', 'gabrielsabatini16@gmail.com', '2024-05-17 22:05:32'),
(77, '79655f9f-14fd-46d6-b191-21555923015b', 'gabriel', 'gabrielsabatini16@gmail.com', '2024-05-17 22:07:36'),
(78, '71f479ce-70a2-42ba-b4df-2bbeeb7703cd', '1', '1', '2024-05-17 22:50:53'),
(79, '0960cfed-b61c-4acb-9643-80ca434d3a26', '1', '1', '2024-05-17 22:50:53'),
(80, 'f348d05b-85c1-4292-9e0b-fd1a133d7dcb', '1', '1', '2024-05-17 22:52:28'),
(81, '501154fc-c295-4e53-81bf-b0311091ec22', '1', '1', '2024-05-17 22:52:46'),
(82, 'dc748bb3-c495-48fd-914a-dfb0c38ce711', '1', '1', '2024-05-17 22:53:14'),
(83, '31bff72b-54df-46eb-a9ac-cbf21850d2f1', '1', '1', '2024-05-17 22:53:14'),
(84, '121a99cd-6d1e-4ca1-a17a-02432e16b863', '2', '2', '2024-05-17 22:54:52'),
(85, '1eb71f9c-9327-4947-be1f-a35d26d45f73', '2', '2', '2024-05-17 22:54:52'),
(86, '2a2212a3-87fe-40b2-ac27-e3d9d7727119', '2', '2', '2024-05-17 22:55:25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `registro_datos`
--
ALTER TABLE `registro_datos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reservas`
--
ALTER TABLE `reservas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `registro_datos`
--
ALTER TABLE `registro_datos`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- AUTO_INCREMENT for table `reservas`
--
ALTER TABLE `reservas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
