-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 08, 2024 at 04:48 AM
-- Server version: 8.3.0
-- PHP Version: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `portfolio`
--
CREATE DATABASE IF NOT EXISTS portfolio;

USE portfolio;
-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

DROP TABLE IF EXISTS `admin_users`;
CREATE TABLE IF NOT EXISTS `admin_users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`id`, `username`, `password`) VALUES
(1, 'joojo', '$2y$10$y/87/q4HfF8rSVcrmf.WCuk5WHtW6jhJzJPH3UBMauHpTm4nn3M6O');

-- --------------------------------------------------------

--
-- Table structure for table `portfolio_items`
--

DROP TABLE IF EXISTS `portfolio_items`;
CREATE TABLE IF NOT EXISTS `portfolio_items` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `back_image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `portfolio_items`
--

INSERT INTO `portfolio_items` (`id`, `title`, `description`, `image`, `back_image`, `created_at`) VALUES
(6, 'TransPro', 'TransPro - A Transport Service Management Suite ', 'transproimg.png', 'portfolio-2.jpg', '2024-05-29 19:19:48'),
(7, 'SMS', 'SMS - Stores Management System', 'sms.png', 'portfolio-3.jpg', '2024-05-29 20:15:14'),
(8, 'EPES', 'EPES - Employee Performance Evaluation System', 'epes.png', 'portfolio-4.jpg', '2024-05-29 20:17:45'),
(9, 'Portfolio', 'A CMS Solution for Portfolio portrayal', 'portfolio-cms.png', 'portfolio-3.jpg', '2024-05-29 20:22:41'),
(10, 'SPMS', 'SPMS - Supplier Management System', 'spms.png', 'portfolio-1.jpg', '2024-05-29 21:36:17');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
