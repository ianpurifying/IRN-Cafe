-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 14, 2025 at 03:56 PM
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
(7, 'kupalboss@gmail.com', '[{\"item\":\"Pork\",\"price\":\"2000.00\",\"quantity\":1,\"total\":2000}]', 2000.00, 'completed', '2025-01-09 08:51:57'),
(8, 'bobo@user.com', '[{\"item\":\"IAN\",\"price\":\"1000000.00\",\"quantity\":1,\"total\":1000000}]', 1000000.00, 'canceled', '2025-01-10 11:04:05'),
(9, 'kupal@gmail.com', '[{\"item\":\"Chicken\",\"price\":\"1000.00\",\"quantity\":1,\"total\":1000},{\"item\":\"Pork\",\"price\":\"2000.00\",\"quantity\":1,\"total\":2000},{\"item\":\"IAN\",\"price\":\"1000000.00\",\"quantity\":1,\"total\":1000000}]', 1003000.00, 'completed', '2025-01-11 17:17:31'),
(10, 'kupal@gmail.com', '[{\"item\":\"Chicken\",\"price\":\"1000.00\",\"quantity\":1,\"total\":1000}]', 1000.00, 'pending', '2025-01-11 17:17:47'),
(11, 'sup@gmail.com', '[{\"item\":\"Chicken\",\"price\":\"1000.00\",\"quantity\":1,\"total\":1000}]', 1000.00, 'pending', '2025-01-12 07:55:42'),
(12, 'sup@gmail.com', '[{\"item\":\"Chicken\",\"price\":\"1000.00\",\"quantity\":1,\"total\":1000}]', 1000.00, 'pending', '2025-01-12 08:01:03'),
(13, 'sup@gmail.com', '[{\"item\":\"Drinks\",\"price\":\"4000.00\",\"quantity\":1,\"total\":4000}]', 4000.00, 'pending', '2025-01-12 08:03:17'),
(14, 'sup@gmail.com', '[{\"item\":\"Drinks\",\"price\":\"4000.00\",\"quantity\":1,\"total\":4000}]', 4000.00, 'pending', '2025-01-12 08:05:25'),
(15, 'sup@gmail.com', '[{\"item\":\"Dessert\",\"price\":\"3000.00\",\"quantity\":1,\"total\":3000}]', 3000.00, 'pending', '2025-01-12 08:06:33'),
(16, 'sup@gmail.com', '[{\"item\":\"Drinks\",\"price\":\"4000.00\",\"quantity\":1,\"total\":4000}]', 4000.00, 'canceled', '2025-01-12 08:30:13'),
(17, 'ianpurificacion@gmail.com', '[{\"item\":\"Chicken\",\"price\":\"1000.00\",\"quantity\":1,\"total\":1000}]', 1000.00, 'completed', '2025-01-13 11:48:06'),
(18, 'sup@gmail.com', '[{\"item\":\"Chicken\",\"price\":\"1000.00\",\"quantity\":1,\"total\":1000}]', 1000.00, 'completed', '2025-01-14 14:40:18'),
(19, 'sup@gmail.com', '[{\"item\":\"Dessert\",\"price\":\"3000.00\",\"quantity\":1,\"total\":3000}]', 3000.00, 'canceled', '2025-01-14 14:40:29');

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
(21, 'Drinks', 'drinks menu', 4000.00, 'drinks', 'uploads/470638981_432028323314385_8833281772872529337_n.jpg'),
(22, 'IAN', 'PURIFICACION', 1000000.00, 'dessert', 'uploads/ian_img.jpg'),
(24, 'KUPALIN', 'SUPOT', 2000000.00, 'pork', 'uploads/Share.png');

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
(40, 'ian', 'puri', 'ianpurifi', 'ianpurifi@cafe.com', '$2y$10$2kIo5pOb8QZPl.HAb.TC..Y3L64p6ATsn3QfLLEYGpWc3K2AMW/Tm', '2025-01-05 09:45:45'),
(41, 'kupal', 'kaba', 'kupalkaba', 'kupalkaba@cafe.com', '$2y$10$n9GY.3w9KwTpvhXtgbjJIuSqJTu8zTVoAiH6QSNy8Wj3bwktyfuti', '2025-01-05 10:33:32'),
(42, 'fucker', 'lol', 'fucker', 'fucker@gmail.com', '$2y$10$yr04DR5zqWOe.oJDoZydKekgbuhO/0be1027SZnCse.ItDkjHwIxi', '2025-01-05 11:52:13'),
(43, 'lapuk boss', 'boss lapuk', 'ssob', 'kupalboss@gmail.com', '$2y$10$RUb7NF3RJjrcNw.x2tQrFeRIVn20Ld210PvKmpwDud86YmhVwf3je', '2025-01-05 12:12:17'),
(45, 'admin', 'admin', 'admin', 'admin@irncafe.com', '$2y$10$U/tJ4W3ue4bZfwWE36jYKOcWEzzwqnomHKDklcYLomVZ0/dipwaVu', '2025-01-05 13:10:17'),
(46, 'BOBO', 'TANGA', 'bobo', 'bobo@gmail.com', '$2y$10$LH5obnSlQqSsQ7.zYNr4uest7V8IRHV6WdTwk1WN2svTIg0IYT3kS', '2025-01-08 11:07:11'),
(47, 'Sad', 'Girl', 'sadgirl', 'sadgirl@gmail.com', '$2y$10$bUUrR5v1SCT0Sv2Ek1osbe4FUdCVBy2bjFW5JfaR3moHD5jAo1xbu', '2025-01-10 11:54:02'),
(50, 'kupal', 'kupal', 'kupal', 'kupal@gmail.com', '$2y$10$Mfxtc8ewjM/7jW1PmC6SfOPqaIV9dFVBW2zBZ7Kk1.QTVKF9v0vbm', '2025-01-11 17:16:39'),
(51, 'tanga', 'supot', 'sup', 'sup@gmail.com', '$2y$10$SRFg3nYoxQ1djDSog5X31eIjFXS/4xF6OA.ee7AgRK6xgVRmCQRIm', '2025-01-12 07:39:27'),
(52, 'IAN', 'PURIFICACION', 'ianpurificacion', 'ianpurificacion@gmail.com', '$2y$10$SbPkJbz4oyX3NsrSteKlnuNv4bFfWEbqZ4JgxJ5ZtyhUeaIOM6S2O', '2025-01-13 11:47:19');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `checkouts`
--
ALTER TABLE `checkouts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

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
