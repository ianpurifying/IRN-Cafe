-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 09, 2025 at 10:23 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `irn_cafe`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `quantity` int(11) DEFAULT 1,
  `added_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `checkouts`
--

CREATE TABLE `checkouts` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `order_details` text NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `status` enum('pending','completed','canceled') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `checkouts`
--

INSERT INTO `checkouts` (`id`, `email`, `order_details`, `total_amount`, `status`, `created_at`) VALUES
(1, 'kupalboss@gmail.com', '[{\"item\":\"Chicken\",\"price\":\"1000.00\",\"quantity\":5,\"total\":5000}]', 5000.00, 'completed', '2025-01-09 08:00:03'),
(2, 'kupalboss@gmail.com', '[{\"item\":\"Pork\",\"price\":\"2000.00\",\"quantity\":1,\"total\":2000}]', 2000.00, 'completed', '2025-01-09 08:04:36'),
(3, 'kupalboss@gmail.com', '[{\"item\":\"Pork\",\"price\":\"2000.00\",\"quantity\":1,\"total\":2000},{\"item\":\"Drinks\",\"price\":\"4000.00\",\"quantity\":1,\"total\":4000}]', 6000.00, 'completed', '2025-01-09 08:06:44'),
(4, 'kupalboss@gmail.com', '[{\"item\":\"Chicken\",\"price\":\"1000.00\",\"quantity\":1,\"total\":1000}]', 1000.00, 'completed', '2025-01-09 08:07:33'),
(5, 'kupalboss@gmail.com', '[{\"item\":\"Pork\",\"price\":\"2000.00\",\"quantity\":1,\"total\":2000},{\"item\":\"Drinks\",\"price\":\"4000.00\",\"quantity\":1,\"total\":4000}]', 6000.00, 'completed', '2025-01-09 08:08:47'),
(6, 'bobo@user.com', '[{\"item\":\"Pork\",\"price\":\"2000.00\",\"quantity\":1,\"total\":2000},{\"item\":\"Chicken\",\"price\":\"1000.00\",\"quantity\":2,\"total\":2000}]', 4000.00, 'completed', '2025-01-09 08:12:45'),
(7, 'kupalboss@gmail.com', '[{\"item\":\"Pork\",\"price\":\"2000.00\",\"quantity\":1,\"total\":2000}]', 2000.00, 'completed', '2025-01-09 08:51:57');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `menu_name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `category` varchar(50) NOT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `menu_name`, `description`, `price`, `category`, `image`) VALUES
(18, 'Chicken', 'chicken menu', 1000.00, 'chicken', 'uploads/1500x500 (1).jpg'),
(19, 'Pork', 'pork menu', 2000.00, 'pork', 'uploads/kiki.png'),
(20, 'Dessert', 'dessert menu', 3000.00, 'dessert', 'uploads/Gggf7ULWQAA6ntf.png'),
(21, 'Drinks', 'drinks menu', 4000.00, 'drinks', 'uploads/470638981_432028323314385_8833281772872529337_n.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `username`, `email`, `password`, `created_at`) VALUES
(31, 'Ian', 'Purificacion', 'imian', 'ian@gmail.com', '$2y$10$YUarxWtXN9N0W2Dgu7Cj7.ob5nTtO3Ge1x2mHern/PHJjYB7g8rZK', '2024-12-30 11:07:30'),
(32, 'Ian', 'Lol', 'doffy0', 'loidaplena@gmail.com', '$2y$10$71imS3tik.o79IjM/7j/T.X22YPsm2xf/O49hn5NATAyLw6mSsrR.', '2024-12-30 12:10:27'),
(33, 'Ian', 'Purificacion', '20220482', 'onvena@gmail.com', '$2y$10$l34ZosXnPPrwaXNm8UftRuaisgzarCUSckI.zsbHjPW/tBX9x9kMu', '2024-12-30 12:17:58'),
(37, 'Thanga', 'haha', 'toothygrin', 'loidapurcionvelena@gmail.com', '$2y$10$HpGPzw6oi.Z63ivE7iQ4BOIDMkBR3ODGo079ieIQwU0d50VPWWaw2', '2024-12-30 14:28:05'),
(39, 'ian', 'puri', 'ianpuri', 'ian@cade.com', '123', '2025-01-05 08:56:53'),
(40, 'ian', 'puri', 'ianpurifi', 'ianpurifi@cafe.com', '$2y$10$2kIo5pOb8QZPl.HAb.TC..Y3L64p6ATsn3QfLLEYGpWc3K2AMW/Tm', '2025-01-05 09:45:45'),
(41, 'kupal', 'kaba', 'kupalkaba', 'kupalkaba@cafe.com', '$2y$10$n9GY.3w9KwTpvhXtgbjJIuSqJTu8zTVoAiH6QSNy8Wj3bwktyfuti', '2025-01-05 10:33:32'),
(42, 'fucker', 'lol', 'fucker', 'fucker@gmail.com', '$2y$10$yr04DR5zqWOe.oJDoZydKekgbuhO/0be1027SZnCse.ItDkjHwIxi', '2025-01-05 11:52:13'),
(43, 'kupal', 'boss', 'kupalboss', 'kupalboss@gmail.com', '$2y$10$9rlZRYj.sKNs3We2DKJ9O.N3ZH6Gblal0bwwqzr8iphRXNUX7j17.', '2025-01-05 12:12:17'),
(45, 'admin', 'admin', 'admin', 'admin@irncafe.com', '$2y$10$U/tJ4W3ue4bZfwWE36jYKOcWEzzwqnomHKDklcYLomVZ0/dipwaVu', '2025-01-05 13:10:17'),
(46, 'bobo', 'bobo', 'bobo', 'bobo@user.com', '$2y$10$YCWW8GBYoisFFCOsElkF6uFudWeFaMZLqxDUYdq9B522n6QS2/E12', '2025-01-08 11:07:11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`),
  ADD KEY `menu_id` (`menu_id`);

--
-- Indexes for table `checkouts`
--
ALTER TABLE `checkouts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `checkouts`
--
ALTER TABLE `checkouts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`email`) REFERENCES `users` (`email`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`menu_id`) REFERENCES `menu` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
