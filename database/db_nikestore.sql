-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 17, 2024 at 08:24 AM
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
-- Database: `db_nikestore`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_nikestore`
--

CREATE TABLE `tb_nikestore` (
  `id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `img` varchar(255) NOT NULL,
  `size` varchar(20) NOT NULL,
  `stock` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_nikestore`
--

INSERT INTO `tb_nikestore` (`id`, `product_name`, `description`, `price`, `img`, `size`, `stock`) VALUES
(17, 'Lebron 20', 'The LeBron 20 is a sleek, low-profile shoe designed to celebrate James’ historic career and serve the performance needs of a new generation of athletes.', 1895.00, 'uploads/lebron20-.png', '13', 25),
(18, 'Nike Joyride Run Flyknit', 'Experience unparalleled comfort with tiny beads in the sole conforming to your foot for a personalized fit. ', 9500.00, 'uploads/nikejoyride-.png', '12', 15),
(19, 'Nike React Element 55', 'Sleek and modern, featuring innovative React cushioning for a smooth ride all day long.', 6500.00, 'uploads/nikereacat-.png', '12', 5),
(20, 'Nike Air Max 270', 'Combining comfort and style with a large Air unit for superior cushioning and impact protection', 7200.00, 'uploads/nikeairmax270-.png', '14', 7),
(21, 'Nike Zoom Pegasus Turbo 2', 'Designed for speed and efficiency, with ZoomX foam providing responsive cushioning for high-mileage runs.', 8000.00, 'uploads/nikezoom-.png', '10', 8),
(22, 'Nike Kyrie 8', 'Designed for Kyrie Irving\'s signature quick cuts and agile moves, these shoes feature responsive cushioning and a lockdown fit for superior court control.', 7500.00, 'uploads/kyrie8-.png', '10', 23),
(23, 'Nike KD 14', 'Engineered for Kevin Durant\'s versatility, these shoes combine plush cushioning with lightweight support, ensuring comfort and performance on the hardwood. ', 8200.00, 'uploads/kd14-.png', '11', 16);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'admin', '$2y$10$/d4xJoKJXjzH1AJbR6Lxn.1n7BwspFPsoE5QgN9993QFcf/Z6TU0u'),
(6, 'admin1', '$2y$10$Sx..vCys4WjqSKsxCk3EIe0jWKHCjoAZtcB/VobWQIvI3au3YUsyK'),
(7, 'elmer', '$2y$10$gUlJbrR2bMAiHTwtkpXGweUdnSAB2SI4oqf.1v73/LiX0ehj7JKKi');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_nikestore`
--
ALTER TABLE `tb_nikestore`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_nikestore`
--
ALTER TABLE `tb_nikestore`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
