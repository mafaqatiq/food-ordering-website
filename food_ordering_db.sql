-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 11, 2024 at 09:28 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `food_ordering_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `quantity` int(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `message` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `email` varchar(100) NOT NULL,
  `method` varchar(50) NOT NULL,
  `address` varchar(500) NOT NULL,
  `total_products` varchar(1000) NOT NULL,
  `total_price` int(100) NOT NULL,
  `placed_on` varchar(50) NOT NULL,
  `payment_status` varchar(20) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name`, `number`, `email`, `method`, `address`, `total_products`, `total_price`, `placed_on`, `payment_status`) VALUES
(21, 18, 'user1', '0325782663', 'user1@gmail.com', 'paypal', ', Gojra More, Lahore, Pakistan - 52251', ', Chicken Burger (2) , Coffee (1) ', 43, '03-Apr-2024', 'completed'),
(22, 18, 'Afaq Atiq', '03462526788', 'afaqatiq123@gmail.com', 'cash on delivery', ', UET, Lahore, Pakistan - 52251', ', Chicken Burger (2) , Hawaiian Pizza (1) ', 128, '17-Apr-2024', 'completed'),
(23, 18, '4567u74657657', '6776', 'jhvhjvhj766@ytvv', 'cash on delivery', ', 7676f67, f76f, f76f - 78787', ', BBQ Burger (2) ', 70, '18-Apr-2024', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `category`, `image`) VALUES
(20, 'Chicken Burger', 10, 'burger', '6.jpeg'),
(21, 'Humburger', 9, 'burger', '2.jpeg'),
(23, 'Mushroom Burger', 22, 'burger', '4.jpeg'),
(26, 'Beaf Burger', 23, 'burger', '7.jpeg'),
(27, 'Pepperoni Pizza', 59, 'pizza', 'p1.jpeg'),
(28, 'Hawaiian Pizza', 108, 'pizza', 'p2.jpeg'),
(29, 'Taco Pizza', 67, 'pizza', 'p3.jpeg'),
(30, 'Shrimp Pizza', 45, 'pizza', 'p4.jpeg'),
(32, 'Vanilla', 19, 'icecream', 'i1.jpeg'),
(33, 'Chocolate', 25, 'icecream', 'i2.jpeg'),
(34, 'Strawberry', 15, 'icecream', 'i3.jpeg'),
(35, 'Coffee', 23, 'icecream', 'i4.jpeg'),
(36, 'Hard Coffee', 56, 'icecream', 'i5.jpeg'),
(41, 'BBQ Burger', 35, 'burger', 'wepik-export-20240321112023OvDO.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `user_type` varchar(20) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `user_type`) VALUES
(17, 'admin', 'admin123@gmail.com', '$2y$10$JqEnNfwvXDUWM.y6Olr9zON3LTavo8vOA9S5uOp29vRePkQPccygG', 'admin'),
(18, 'user', 'user1@gmail.com', '$2y$10$HeK7v1pFZXH8AXZNO7EhH.uom16pIsV23aSlvCB1RwuYxOJjeGqrO', 'user'),
(21, 'Afaq Atiq', 'afaq123@gmail.com', '$2y$10$Sw3CyEbYrDHbZgX3MhAqtupGl1j7SxA0YtHtP.faUNacr8brUcRsG', 'user'),
(22, 'Muhammad afaq', 'afaq@gmail.com', '$2y$10$0.QQh13P7R/putyorT67/OERan6Qf2PiMF.fAzrmN3fPYrMKn5guS', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
