-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 30, 2024 at 09:18 PM
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
-- Database: `technauction`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `Id` int NOT NULL AUTO_INCREMENT,
  `Name` text NOT NULL,
  `Email` text NOT NULL,
  `Password` text NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`Id`, `Name`, `Email`, `Password`) VALUES
(3, 'Admin', 'Admin1@gmail.com', '$2y$10$ApQ.vB9S./omi8GsUb5wf./G27YdjifVT.OybbitdB5tpLxoussru'),
(4, 'Jack', 'admin@gmail.com', '$2y$10$rJglKJ6jfahPt38jkEUiEOtXnIhJzfYPak4ZgmcdeZVs2Tbu4Uu0W');

-- --------------------------------------------------------

--
-- Table structure for table `admin_notifications`
--

DROP TABLE IF EXISTS `admin_notifications`;
CREATE TABLE IF NOT EXISTS `admin_notifications` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `message` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `Paid` varchar(7) NOT NULL COMMENT '(Paid/Not Paid)',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=139 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bids`
--

DROP TABLE IF EXISTS `bids`;
CREATE TABLE IF NOT EXISTS `bids` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `product_id` int DEFAULT NULL,
  `bid_amount` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `product_id` (`product_id`)
) ENGINE=MyISAM AUTO_INCREMENT=108 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `bids`
--

INSERT INTO `bids` (`id`, `user_id`, `product_id`, `bid_amount`, `created_at`) VALUES
(105, 33, 155, 2500.00, '2024-04-23 06:53:40'),
(104, 27, 153, 5500.00, '2024-04-13 14:52:05'),
(101, 29, 150, 2500.00, '2024-04-09 08:23:10'),
(100, 27, 149, 4000.00, '2024-04-08 10:33:16'),
(96, 27, 149, 3500.00, '2024-04-08 10:25:12'),
(95, 29, 149, 3000.00, '2024-04-08 10:24:56'),
(75, 27, 143, 5500.00, '2024-04-05 08:49:48'),
(74, 27, 142, 4000.00, '2024-04-05 08:36:39'),
(73, 32, 142, 3500.00, '2024-04-05 08:36:20'),
(72, 27, 141, 4000.00, '2024-04-05 08:30:30'),
(71, 29, 141, 3500.00, '2024-04-05 08:30:19'),
(70, 27, 141, 3000.00, '2024-04-05 08:30:05'),
(69, 29, 140, 3000.00, '2024-04-03 09:24:15'),
(68, 32, 139, 4000.00, '2024-04-02 11:56:17'),
(67, 29, 139, 3000.00, '2024-04-02 11:55:46'),
(66, 29, 138, 2000.00, '2024-04-02 09:17:51'),
(65, 27, 136, 4000.00, '2024-04-02 08:29:50'),
(64, 32, 133, 10000.00, '2024-04-02 08:25:55'),
(63, 32, 135, 4500.00, '2024-04-02 07:32:29'),
(62, 27, 133, 4500.00, '2024-04-02 07:29:23'),
(61, 32, 134, 5500.00, '2024-04-02 06:29:49'),
(60, 29, 134, 5000.00, '2024-04-02 06:29:31'),
(59, 32, 132, 5600.00, '2024-03-30 03:56:30'),
(58, 27, 132, 5500.00, '2024-03-30 03:55:26'),
(57, 29, 132, 5300.00, '2024-03-30 03:54:45'),
(56, 27, 132, 5200.00, '2024-03-30 03:54:01'),
(52, 32, 130, 4500.00, '2024-03-29 08:31:41');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `name`, `email`, `message`, `created_at`) VALUES
(1, 'Adrian Mailka', 'adrianmalika01@gmail.com', 'Love the website', '2024-04-03 07:34:10'),
(7, 'Adrian Malika', 'adrianmalika10@gmail.com', 'hello', '2024-04-09 12:12:24'),
(5, 'Eugene Onions', 'eugeneonions8@gmail.com', 'This service is very well polished, 10/10', '2024-04-03 09:20:09'),
(6, 'Yankho Kampanje', 'yankhokampanje70@gmail.com', 'Hie', '2024-04-04 07:05:10');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
CREATE TABLE IF NOT EXISTS `notifications` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `message` text,
  `timestamp` datetime DEFAULT NULL,
  `product_id` int DEFAULT NULL,
  `is_read` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `product_id` (`product_id`)
) ENGINE=MyISAM AUTO_INCREMENT=68 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `Id` int NOT NULL AUTO_INCREMENT,
  `Title` text NOT NULL,
  `price` int NOT NULL,
  `starting_price` int NOT NULL,
  `state` text NOT NULL,
  `category` text NOT NULL,
  `description` text NOT NULL,
  `owner_id` int NOT NULL,
  `image` text NOT NULL,
  `end_time` timestamp NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=160 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`Id`, `Title`, `price`, `starting_price`, `state`, `category`, `description`, `owner_id`, `image`, `end_time`) VALUES
(143, 'Laptop', 5500, 4000, 'New', 'Electronics', 'Sliver Lenovo', 29, 'items/photo-1575024357670-2b5164f470c3.avif', '2024-04-05 08:50:00'),
(142, 'Earrings', 4000, 3000, 'Used - like new', 'Accessories', 'Blue diamond earrings', 29, 'items/premium_photo-1681276170291-27698ccc0a8e.avif', '2024-04-05 08:38:00'),
(139, 'Jam', 4000, 2000, 'New', 'Accessories', 'Blue jam stone', 32, 'items/photo-1599643477877-530eb83abc8e.avif', '2024-04-02 11:57:00'),
(138, 'Book', 2000, 1000, 'New', 'Books', 'Black Book', 29, 'items/photo-1544947950-fa07a98d237f.avif', '2024-04-02 09:19:00'),
(141, 'Wallpaper', 4000, 2000, 'New', 'Art', 'Cartoon art', 29, 'items/photo-1608371945786-d47d3cdd31da.avif', '2024-04-05 08:31:00'),
(136, 'Watch', 4000, 2000, 'New', 'Watches', 'Clear hour glass', 32, 'items/photo-1524805444758-089113d48a6d.avif', '2024-04-02 08:30:00'),
(135, 'Watch', 4500, 1200, 'New', 'Watches', 'Clear hour glass', 27, 'items/photo-1518281420975-50db6e5d0a97.avif', '2024-04-02 07:33:00'),
(132, 'Inflated dog', 5600, 5000, 'New', 'Art', 'big blue ballon dog ', 27, 'items/photo-1590342823852-2ab98729f250.avif', '2024-03-30 03:57:00'),
(133, 'Watch', 10000, 4000, 'New', 'Watches', 'Brown in colour rolex.', 32, 'items/photo-1622434641406-a158123450f9.avif', '2024-04-21 06:30:00'),
(130, 'Ring', 4500, 4000, 'New', 'Accessories', 'This is a ring with a pick diamond. ', 29, 'items/photo-1603561591411-07134e71a2a9.avif', '2024-03-29 08:33:00'),
(153, 'Necklace ', 5500, 5000, 'New', 'Accessories', 'heart shaped necklace with a blue jam stone.', 29, 'items/photo-1610661022658-5068c4d8f286.avif', '2024-04-13 14:55:00'),
(155, 'RIng', 2500, 2000, 'New', 'Accessories', 'gold ring', 29, 'items/photo-1543294001-f7cd5d7fb516.avif', '2024-05-02 13:10:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `Id` int NOT NULL AUTO_INCREMENT,
  `FirstName` text NOT NULL,
  `LastName` text NOT NULL,
  `Email` text NOT NULL,
  `Password` text NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'active',
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`Id`, `FirstName`, `LastName`, `Email`, `Password`, `status`) VALUES
(31, 'Yankho', 'Kampanje', 'yankhokampanje70@gmail.com', '$2y$10$ltiah6QhXnAUdkwI892vb.hayKBoQB6nV8DfdgaEBLpSr9Rnva2mG', 'active'),
(29, 'Ben', 'Phiri', 'luwe@mail', '$2y$10$2s6OiGbUkNLpZXxjyH3ff.NDTz0MX9StPfO3NtUug8t52pDd1Qi.i', 'active'),
(27, 'Dee', 'Mailka', 'adrianmalika01@gmail.com', '$2y$10$gUlcXpedEloHg3QcCFgQeuJ6PuHry/5EAtx1OYRLQvyz1wWoxannu', 'active'),
(32, 'Jon', 'Snow', 'snow@mail.com', '$2y$10$ZP0IdlYJl8HFYVgcIbsu3usPdZRqh4aEqwboJU9Phbb7VaMuwG50G', 'active'),
(33, 'Lisa', 'Gulumba', 'lisagulumba044@gmail.com', '$2y$10$I01yssjxBnbwN3cug4Wv3eocWKzxCxIEwisiFVSAcE7dZpjM2FDOC', 'active');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
