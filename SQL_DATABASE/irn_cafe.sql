-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 17, 2025 at 02:59 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

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

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `email`, `menu_id`, `quantity`, `added_at`) VALUES
(135, 'ian@gmail.com', 41, 1, '2025-01-31 06:21:27');

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
(51, 'ian@gmail.com', '[{\"item\":\"1 - pc. Fried Chicken\",\"price\":\"139.00\",\"quantity\":1,\"total\":139},{\"item\":\"2 - pc. Fried Chicken\",\"price\":\"229.00\",\"quantity\":1,\"total\":229}]', 368.00, 'completed', '2025-01-26 07:20:07'),
(52, 'ian@gmail.com', '[{\"item\":\"Iced Tea\",\"price\":\"49.00\",\"quantity\":1,\"total\":49},{\"item\":\"Grilled Pork Chop\",\"price\":\"249.00\",\"quantity\":1,\"total\":249}]', 298.00, 'canceled', '2025-01-26 07:22:33'),
(53, 'ian@gmail.com', '[{\"item\":\"1 - pc. Fried Chicken\",\"price\":\"139.00\",\"quantity\":1,\"total\":139}]', 139.00, 'canceled', '2025-01-26 10:55:58'),
(54, 'ian@gmail.com', '[{\"item\":\"2 - pc. Fried Chicken\",\"price\":\"229.00\",\"quantity\":1,\"total\":229},{\"item\":\"Chicken Burger\",\"price\":\"129.00\",\"quantity\":1,\"total\":129}]', 358.00, 'completed', '2025-01-26 10:57:36'),
(55, 'ian@gmail.com', '[{\"item\":\"Grilled Pork Chop\",\"price\":\"249.00\",\"quantity\":1,\"total\":249}]', 249.00, 'completed', '2025-01-26 11:01:33'),
(56, 'ian@gmail.com', '[{\"item\":\"Cheesy Hotdog\",\"price\":\"79.00\",\"quantity\":1,\"total\":79}]', 79.00, 'canceled', '2025-01-26 16:11:52'),
(57, 'ian@gmail.com', '[{\"item\":\"Grilled Pork Chop\",\"price\":\"249.00\",\"quantity\":1,\"total\":249}]', 249.00, 'canceled', '2025-01-26 16:12:08'),
(58, 'ian@gmail.com', '[{\"item\":\"1 - pc. Fried Chicken\",\"price\":\"139.00\",\"quantity\":1,\"total\":139}]', 139.00, 'canceled', '2025-01-26 16:12:15'),
(59, 'ian@gmail.com', '[{\"item\":\"Spaghetti\",\"price\":\"79.00\",\"quantity\":1,\"total\":79}]', 79.00, 'canceled', '2025-01-26 16:12:24'),
(60, 'ian@gmail.com', '[{\"item\":\"2 - pc. Fried Chicken\",\"price\":\"229.00\",\"quantity\":1,\"total\":229}]', 229.00, 'canceled', '2025-01-26 16:23:48'),
(61, 'ian@gmail.com', '[{\"item\":\"1 - pc. Fried Chicken\",\"price\":\"139.00\",\"quantity\":2,\"total\":278},{\"item\":\"2 - pc. Fried Chicken\",\"price\":\"229.00\",\"quantity\":2,\"total\":458},{\"item\":\"Chicken Burger\",\"price\":\"129.00\",\"quantity\":3,\"total\":387},{\"item\":\"Cheesy Hotdog\",\"price\":\"79.00\",\"quantity\":2,\"total\":158}]', 1281.00, 'completed', '2025-01-27 10:51:13'),
(62, 'ian@gmail.com', '[{\"item\":\"Chicken Burger\",\"price\":\"129.00\",\"quantity\":1,\"total\":129},{\"item\":\"2 - pc. Fried Chicken\",\"price\":\"229.00\",\"quantity\":1,\"total\":229},{\"item\":\"1 - pc. Fried Chicken\",\"price\":\"139.00\",\"quantity\":2,\"total\":278},{\"item\":\"Iced Tea\",\"price\":\"49.00\",\"quantity\":1,\"total\":49},{\"item\":\"Royal\",\"price\":\"49.00\",\"quantity\":1,\"total\":49},{\"item\":\"Coke Zero\",\"price\":\"49.00\",\"quantity\":1,\"total\":49},{\"item\":\"Pork Shawarma\",\"price\":\"119.00\",\"quantity\":1,\"total\":119},{\"item\":\"Sisig\",\"price\":\"149.00\",\"quantity\":1,\"total\":149},{\"item\":\"Grilled Pork Chop\",\"price\":\"249.00\",\"quantity\":1,\"total\":249}]', 1300.00, 'completed', '2025-01-27 10:56:12'),
(63, 'ian@gmail.com', '[{\"item\":\"1 - pc. Fried Chicken\",\"price\":\"139.00\",\"quantity\":1,\"total\":139},{\"item\":\"2 - pc. Fried Chicken\",\"price\":\"229.00\",\"quantity\":1,\"total\":229},{\"item\":\"Coke Zero\",\"price\":\"49.00\",\"quantity\":2,\"total\":98}]', 466.00, 'completed', '2025-01-27 11:36:32'),
(64, 'ian@gmail.com', '[{\"item\":\"Chicken Burger\",\"price\":\"129.00\",\"quantity\":2,\"total\":258}]', 258.00, 'canceled', '2025-01-27 11:39:14'),
(65, 'ian@gmail.com', '[{\"item\":\"Chicken Burger\",\"price\":\"129.00\",\"quantity\":2,\"total\":258}]', 258.00, 'completed', '2025-01-31 06:18:33'),
(66, 'russell@gmail.com', '[{\"item\":\"Cheesy Hotdog\",\"price\":\"79.00\",\"quantity\":1,\"total\":79},{\"item\":\"Spaghetti\",\"price\":\"79.00\",\"quantity\":1,\"total\":79},{\"item\":\"1 - pc. Fried Chicken\",\"price\":\"139.00\",\"quantity\":1,\"total\":139}]', 297.00, 'completed', '2025-01-31 06:46:30'),
(67, 'russell@gmail.com', '[{\"item\":\"1 - pc. Fried Chicken\",\"price\":\"139.00\",\"quantity\":1,\"total\":139},{\"item\":\"Spaghetti\",\"price\":\"79.00\",\"quantity\":1,\"total\":79}]', 218.00, 'canceled', '2025-01-31 06:50:58'),
(68, 'russell@gmail.com', '[{\"item\":\"1 - pc. Fried Chicken\",\"price\":\"139.00\",\"quantity\":1,\"total\":139}]', 139.00, 'completed', '2025-01-31 06:56:19'),
(69, 'nicacomia@gmail.com', '[{\"item\":\"Chicken Burger\",\"price\":\"129.00\",\"quantity\":1,\"total\":129},{\"item\":\"Coke Zero\",\"price\":\"49.00\",\"quantity\":1,\"total\":49}]', 178.00, 'completed', '2025-01-31 07:04:33'),
(70, 'asdf@gmail.com', '[{\"item\":\"Grilled Pork Chop\",\"price\":\"249.00\",\"quantity\":4,\"total\":996},{\"item\":\"2 - pc. Fried Chicken\",\"price\":\"229.00\",\"quantity\":1,\"total\":229}]', 1225.00, 'completed', '2025-09-17 06:50:19');

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
(31, 'Chicken Burger', 'Philippines’ crispylicious, juicylicious, and tenderlicious chicken burger is crispy on the inside, tender and juicy on the inside.', 129.00, 'chicken', 'uploads/JBPH-P-SEOUL-THUMBNAIL_SOLO_SPICY_750X750px_FA-min.png'),
(32, '2 - pc. Fried Chicken', 'Philippines’ best-tasting crispylicious, juicylicious fried chicken that is crispy on the outside, tender and juicy on the inside.', 229.00, 'chicken', 'uploads/2pc-Chickenjoy-Solo.png'),
(33, '1 - pc. Fried Chicken', 'Philippines’ best-tasting crispylicious, juicylicious fried chicken that is crispy on the outside, tender and juicy on the inside.', 139.00, 'chicken', 'uploads/1pc-Chickenjoy-Solo.png'),
(34, 'Coke Zero', 'Refreshing, ice-cold Coke Zero to perfectly match your favorite meal', 49.00, 'drinks', 'uploads/Coke-Zero-Regular.png'),
(35, 'Royal', 'Refreshing, ice-cold Royal to perfectly match your favorite meal', 49.00, 'drinks', 'uploads/Royal-Regular.png'),
(36, 'Iced Tea', 'Delicous, ice-cold lemon flavored Iced Tea that will definitely complement any meal', 49.00, 'drinks', 'uploads/Ice-Tea-Regular.png'),
(37, 'Palabok', 'A classic bihon noodles topped with saucy-tasty signature sauce and loaded with delicious toppings!', 79.00, 'dessert', 'uploads/Palabok-Solo.png'),
(38, 'Spaghetti', 'The meatiest and cheesiest spaghetti! Freshly prepared noodles topped with meaty spaghetti sauce, hotdog chunks.', 79.00, 'dessert', 'uploads/Jolly-Spaghetti-Solo.png'),
(39, 'Cheesy Hotdog', 'Meaty sausage in a soft hotdog bun, topped with a tangy special dressing, grated cheese, and tomato catsup.', 79.00, 'dessert', 'uploads/Cheesy-Classic-Jolly-Hotdog-Solo.png'),
(40, 'Grilled Pork Chop', 'Grilled pork chop is juicy, smoky, and perfectly seasoned with a delicious charred finish.', 249.00, 'pork', 'uploads/f08326e8c9e1728f9f7991e42451b395.jpg'),
(41, 'Sisig', 'Sisig is a savory, crispy pork dish with a tangy, flavorful kick. It\'s often served sizzling hot.', 149.00, 'pork', 'uploads/3c3ecc439ba98330e6f233bf07bf2350.jpg'),
(42, 'Pork Shawarma', 'Pork shawarma is a flavorful, tender dish with a perfect blend of spices, wrapped in pita.', 119.00, 'pork', 'uploads/42d3b71daf2091f1e4c8bf6a9dd99924.jpg'),
(45, 'Hot choco', 'fsdfsdfsd', 50.00, 'drinks', 'uploads/Hot-Choco.png');

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
(77, 'Ian', 'Purificacion', 'ian', 'ian@gmail.com', '$2y$10$3VOhZAA00V.Yn4BT5raNzuNUpJKdcBU.tI13I7jro/WmPFI/x1Z66', '2025-01-26 07:02:02'),
(80, 'russell', 'vizarra', 'russell', 'russell@gmail.com', '$2y$10$sxt8wBX4rayaFtkdfKkMU.6ZX.G5Dtt/srLzifF77tof30KGVRANe', '2025-01-31 06:45:29'),
(81, 'Nica', 'Comia', 'nicacomia', 'nicacomia@gmail.com', '$2y$10$Ymwf95FTRncC8HNjehd4iebB07EDoWFZS9Ikchta.5uDUVbC1cXAm', '2025-01-31 07:03:52'),
(82, 'fas', 'fdsa', 'qwwe', 'qwwe@qwer.com', '$2y$10$vQ25GDGIFwd1EESrEw7OxelWh96QzCaLqwXbb5DdL7nVic2NgdREq', '2025-06-14 18:06:14'),
(83, 'asdf', 'asdf', 'asdf', 'asdf@gmail.com', '$2y$10$E3uWE7y53TZx6trQHr.x1.M4G77e7QHymwjLQRRWNjEHSw6TM98uW', '2025-09-17 06:49:57'),
(84, 'admin', 'admin', 'admin', 'admin@gmail.com', '$2y$10$5Xp/AyCZH4JUpZBUlpR9m.czgteAiaD6KtR4dFEMvijyx.No67w5O', '2025-09-17 07:11:47');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=146;

--
-- AUTO_INCREMENT for table `checkouts`
--
ALTER TABLE `checkouts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

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
