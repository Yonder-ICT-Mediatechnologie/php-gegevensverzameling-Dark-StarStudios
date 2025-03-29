-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 29, 2025 at 07:13 PM
-- Server version: 8.2.0
-- PHP Version: 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dnd_npc`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `idUser` int NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `hash` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`idUser`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`idUser`, `email`, `name`, `hash`) VALUES
(3, 't@t', 'test', '$2y$10$cdAW1QRUQqZR2HFc9lIICO4rJDhZGkWcjhlkynQEayLy5yMQmG/7.'),
(4, 'Mohamad-h8@hotmail.com', 'Mohamad', '$2y$10$fqi0hsbCe1t33tPIrONx6u/rArvdVjUSlbfHrflCVe1m..1FZfwUa'),
(5, 'goofy-ahh@gmail.com', 'Justin', '$2y$10$zsAjIP2Wv8E9evvt0OnvVOJ/7gTyRJ.DscOaFSsQBm65gBSOOCwVG'),
(6, 'l@l', 'LOL', '$2y$10$TWuR41y88TJaW4RmmoUcXeueOVQIuFqLJl5VmGTX9YGmBtjz2kgT2'),
(7, 'n@n', 'n', '$2y$10$tWELD/GaWSffM5O0Z8/IPOD4fQvfOpM1XmFZraaX3G7PGIZcYAnuW'),
(8, 'test@test', 'Test', '$2y$10$QOvx2zEn5P.Ts6zf3z2lB.c0queqvT.CxM8xctZu8goPp1aR05wqi'),
(9, 'goofy-ahh@gmail.com', 'Goofy', '$2y$10$28t2EyDpAjOFsvXEDO4KbOYoVYorxorqsHVE26ptZVmSjR6008slG');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
