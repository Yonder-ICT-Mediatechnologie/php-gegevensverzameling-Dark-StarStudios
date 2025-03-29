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
-- Table structure for table `monsters`
--

DROP TABLE IF EXISTS `monsters`;
CREATE TABLE IF NOT EXISTS `monsters` (
  `idMonster` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `armor` int NOT NULL,
  `HP` int NOT NULL,
  `strength` int NOT NULL,
  `dexterity` int NOT NULL,
  `constitution` int NOT NULL,
  `intelligence` int NOT NULL,
  `wisdom` int NOT NULL,
  `charisma` int NOT NULL,
  `speed` int NOT NULL,
  `Danger` float NOT NULL,
  `Mastery_Bonus` int NOT NULL,
  `Immunities` varchar(2000) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `vulnerabilities` varchar(2000) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `actions` varchar(2000) NOT NULL,
  `idUser` int NOT NULL,
  PRIMARY KEY (`idMonster`),
  KEY `idUser` (`idUser`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `monsters`
--

INSERT INTO `monsters` (`idMonster`, `name`, `armor`, `HP`, `strength`, `dexterity`, `constitution`, `intelligence`, `wisdom`, `charisma`, `speed`, `Danger`, `Mastery_Bonus`, `Immunities`, `vulnerabilities`, `actions`, `idUser`) VALUES
(9, 'alastor', 15, 666, 26, 26, 10, 30, 20, 30, 25, 30, 6, 'Fire, ice, force', 'holy artifacts', 'Manipulate radiowaves and move at that speed and broadcasts his killing', 5),
(10, 'Shoarma', 5, 1, 5, 5, 5, 5, 5, 5, 0, 30, 2, 'vegatarisch', 'Lol', 'Het kan word opgegeten', 5),
(11, 'Zeus', 30, 200, 20, 20, 20, 20, 20, 20, 100, 30, 15, 'Alles', 'A gnome bard that uses viciour mockery', 'alles', 5),
(12, 'Lololoshka', 12, 45, 12, 13, 10, 14, 8, 15, 30, 2, 4, '-', 'Haters', '-', 6),
(13, '------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------', 1, 0, 1, 1, 1, 1, 1, 1, 0, 1, 1, '-', '-', '-', 6),
(14, 'Chloe', 1, 8, 13, 17, 10, 14, 12, 8, 30, 1, 2, '-', '-', '-', 6),
(17, 'gfd', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '-', '-', '-', 5),
(18, 'test', 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 'empty', 'empty', 'empty', 8);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `monsters`
--
ALTER TABLE `monsters`
  ADD CONSTRAINT `monsters_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `users` (`idUser`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
