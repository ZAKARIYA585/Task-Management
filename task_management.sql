-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 28, 2026 at 01:30 AM
-- Server version: 9.1.0
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `task_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `add_tasks`
--

DROP TABLE IF EXISTS `add_tasks`;
CREATE TABLE IF NOT EXISTS `add_tasks` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text,
  `priority` enum('Low','Medium','High') DEFAULT 'Medium',
  `status` enum('Pending','In Progress','Completed') DEFAULT 'Pending',
  `due_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `add_tasks`
--

INSERT INTO `add_tasks` (`id`, `user_id`, `title`, `description`, `priority`, `status`, `due_date`, `created_at`) VALUES
(9, 6, 'css', 'inline', 'High', 'Completed', '2026-01-10', '2026-01-01 12:13:20'),
(7, 6, 'PHP learning', 'class. absteract', 'Low', 'Pending', '2026-11-10', '2026-01-01 10:57:10'),
(13, 7, 'PHP', 'class. absteract', 'High', 'In Progress', '2026-01-05', '2026-01-02 09:46:40'),
(12, 6, 'Learning Sql', 'mysql', 'Low', 'In Progress', '2026-01-03', '2026-01-02 06:14:13');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '',
  `email` varchar(50) NOT NULL DEFAULT '',
  `password` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`) VALUES
(7, 'Aadil', 'Aadil@gmail.com', '$2y$10$2.LMUDeNDBAI0K9JIfy1T.sMKf2szHr2JA9BsQZAI.7GNDNVPYjJG'),
(6, 'Hasan', 'admin@gmail.com', '$2y$10$Vs.Ol23f8d70jFjaizHfsOZnsNnhcq4Vw6VEzRhnIEZX2Xpu9ry2W'),
(5, 'Aadil', 'raliyamohammadaadil90@gmail.com', '$2y$10$QyFbsJgIVUsbzH4CfMwgX.ReBfn3myd5U850yEixFAVzh4ezhIJEu'),
(8, 'Samir', 'samir@gmail.com', '$2y$10$c9VVx6kW7/Ia0boM3pdjC.uchzPV6oiiPfOUo0VGubeOB2yPC.p0m');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
