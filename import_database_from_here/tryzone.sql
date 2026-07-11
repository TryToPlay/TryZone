-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 11, 2026 at 07:59 AM
-- Server version: 8.4.7
-- PHP Version: 8.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tryzonedb`
--
CREATE DATABASE IF NOT EXISTS `tryzonedb` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `tryzonedb`;

-- --------------------------------------------------------

--
-- Table structure for table `user_accounts`
--

DROP TABLE IF EXISTS `user_accounts`;
CREATE TABLE IF NOT EXISTS `user_accounts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` char(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reg_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `pfp` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default.png',
  `bio` char(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_accounts`
--

INSERT INTO `user_accounts` (`id`, `name`, `password`, `email`, `reg_date`, `pfp`, `bio`) VALUES
(1, 'TryToPlay', '$2y$10$cfH9kMh/9Es3s0PQndHn7u0rIUIPEh5jq0QI/VoEaCZB7aHZNI.mG', 'prarit27feburay@gmail.com', '2026-07-07 21:12:21', 'TryToPlay.webp', 'I am the one above all!!!\r\n\r\nThe creator of this realm.'),
(2, 'testUser', '$2y$10$7iuozqlJDbPh2q1mIc.i/e8kfzwMDfI9MsR2EUqCVbVi2NlWWlk0W', 'test@example0.com', '2026-07-07 21:17:29', 'testUser.jpg', 'i am a tester\r\n\r\nand this is definitely one of the websites of all time.\r\n\r\n\r\nyippie!!! 😄'),
(3, 'user1234', '$2y$10$Mx01edSFqL.eynE8Oa0P0eqtDl47esZ6y2OViiAD2nZDJBwRGx3f6', 'test@example1.com', '2026-07-07 21:20:21', 'default.png', 'placeholder here\r\nplaceholder there\r\n\r\nplaceholder everywhereeee');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
