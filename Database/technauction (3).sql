-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 04, 2024 at 07:23 AM
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
  `admin_id` int DEFAULT NULL,
  `message` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `Paid` varchar(7) NOT NULL COMMENT '(Paid/Not Paid)',
  PRIMARY KEY (`id`),
  KEY `admin_id` (`admin_id`)
) ENGINE=MyISAM AUTO_INCREMENT=111 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admin_notifications`
--

INSERT INTO `admin_notifications` (`id`, `admin_id`, `message`, `created_at`, `Paid`) VALUES
(110, 29, 'Auction for product \'Watch\' has ended.\nHighest Bidder: Jon Snow\nBidder Email: snow@mail.com\nBid Amount: MK4500\nDetails: Clear hour glass\nCondition: New', '2024-04-04 07:11:43', 'NotPaid'),
(109, 29, 'Auction for product \'Jam\' has ended.\nHighest Bidder: Jon Snow\nBidder Email: snow@mail.com\nBid Amount: MK4000\nDetails: Blue jam stone\nCondition: New', '2024-04-04 07:02:31', 'NotPaid'),
(108, 29, 'Auction for product \'Jam\' has ended.\nHighest Bidder: Jon Snow\nBidder Email: snow@mail.com\nBid Amount: MK4000\nDetails: Blue jam stone\nCondition: New', '2024-04-04 07:00:54', 'Paid'),
(107, 29, 'Auction for product \'Jam\' has ended.\nHighest Bidder: Ben Phiri\nBidder Email: luwe@mail\nBid Amount: MK3000\nDetails: Blue jam stone\nCondition: New', '2024-04-03 09:25:06', 'NotPaid'),
(106, 32, 'Auction for product \'Jam\' has ended.\nHighest Bidder: Jon Snow\nBidder Email: snow@mail.com\nBid Amount: MK4000\nDetails: Blue jam stone\nCondition: New', '2024-04-02 11:57:05', 'Paid'),
(105, 32, 'Auction for product \'Book\' has ended.\nHighest Bidder: Ben Phiri\nBidder Email: luwe@mail\nBid Amount: MK2000\nDetails: Black Book\nCondition: New', '2024-04-02 11:53:25', 'NotPaid');

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
) ENGINE=MyISAM AUTO_INCREMENT=70 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `bids`
--

INSERT INTO `bids` (`id`, `user_id`, `product_id`, `bid_amount`, `created_at`) VALUES
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
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `name`, `email`, `message`, `created_at`) VALUES
(1, 'Adrian Mailka', 'adrianmalika01@gmail.com', 'Love the website', '2024-04-03 07:34:10'),
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
) ENGINE=MyISAM AUTO_INCREMENT=49 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `message`, `timestamp`, `product_id`, `is_read`) VALUES
(48, 29, 'A new product has been added: Jam. Click here to view it.', '2024-04-03 09:23:59', 140, 0),
(46, 29, 'A new product has been added: Book. Click here to view it.', '2024-04-02 09:17:31', 138, 0),
(47, 32, 'A new product has been added: Jam. Click here to view it.', '2024-04-02 11:55:14', 139, 0),
(45, 32, 'A new product has been added: Book. Click here to view it.', '2024-04-02 08:39:45', 137, 0),
(43, 27, 'A new product has been added: Watch. Click here to view it.', '2024-04-02 07:31:40', 135, 0),
(44, 32, 'A new product has been added: Watch. Click here to view it.', '2024-04-02 08:28:54', 136, 0),
(42, 27, 'A new product has been added: Infleted dog. Click here to view it.', '2024-04-02 06:28:52', 134, 0),
(40, 27, 'A new product has been added: Infleted dog. Click here to view it.', '2024-03-30 03:53:41', 132, 0),
(41, 32, 'A new product has been added: Watch. Click here to view it.', '2024-04-02 06:28:03', 133, 0),
(38, 29, 'A new product has been added: Ring. Click here to view it.', '2024-03-29 08:30:54', 130, 0);

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
) ENGINE=MyISAM AUTO_INCREMENT=141 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`Id`, `Title`, `price`, `starting_price`, `state`, `category`, `description`, `owner_id`, `image`, `end_time`) VALUES
(139, 'Jam', 4000, 2000, 'New', 'Accessories', 'Blue jam stone', 32, 'items/photo-1599643477877-530eb83abc8e.avif', '2024-04-02 11:57:00'),
(138, 'Book', 2000, 1000, 'New', 'Books', 'Black Book', 29, 'items/photo-1544947950-fa07a98d237f.avif', '2024-04-02 09:19:00'),
(136, 'Watch', 4000, 2000, 'New', 'Watches', 'Clear hour glass', 32, 'items/photo-1524805444758-089113d48a6d.avif', '2024-04-02 08:30:00'),
(135, 'Watch', 4500, 1200, 'New', 'Watches', 'Clear hour glass', 27, 'items/photo-1518281420975-50db6e5d0a97.avif', '2024-04-02 07:33:00'),
(134, 'Infleted dog', 5500, 500, 'New', 'Appliance', 'big blue ballon dog ', 27, 'items/photo-1544947950-fa07a98d237f.avif', '2024-04-02 06:33:00'),
(132, 'Infleted dog', 5600, 5000, 'New', 'Art', 'big blue ballon dog ', 27, 'items/photo-1590342823852-2ab98729f250.avif', '2024-03-30 03:57:00'),
(133, 'Watch', 10000, 4000, 'New', 'Watches', 'Brown in colour rolex.', 32, 'items/photo-1622434641406-a158123450f9.avif', '2024-04-21 06:30:00'),
(130, 'Ring', 4500, 4000, 'New', 'Accessories', 'This is a ring with a pick diamond. ', 29, 'items/photo-1603561591411-07134e71a2a9.avif', '2024-03-29 08:33:00');

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
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`Id`, `FirstName`, `LastName`, `Email`, `Password`, `status`) VALUES
(31, 'Yankho', 'Kampanje', 'yankhokampanje70@gmail.com', '$2y$10$ltiah6QhXnAUdkwI892vb.hayKBoQB6nV8DfdgaEBLpSr9Rnva2mG', 'active'),
(29, 'Ben', 'Phiri', 'luwe@mail', '$2y$10$2s6OiGbUkNLpZXxjyH3ff.NDTz0MX9StPfO3NtUug8t52pDd1Qi.i', 'active'),
(27, 'Dee', 'Malika', 'Deemalika@gmail.com', '$2y$10$YRNpxzOBbC9tEOr6/ZIRjut0qkPL4G96oI3hZEcwkTh20xm9vUIdK', 'active'),
(32, 'Jon', 'Snow', 'snow@mail.com', '$2y$10$ZP0IdlYJl8HFYVgcIbsu3usPdZRqh4aEqwboJU9Phbb7VaMuwG50G', 'active');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
