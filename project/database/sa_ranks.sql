-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 29, 2024 at 03:26 PM
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
-- Database: `sa_ranks`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `registration_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`user_id`, `username`, `email`, `password_hash`, `registration_date`) VALUES
(1, 'Sanele', 'imanathi17@gmail.com', '$2y$10$paB8Sk3JNk/bouEIIHKbweLfeLFt4MrTMcoYrB1OS4dXSY/MzHuf.', '2024-02-28 13:16:09'),
(4, 'Samkelo', 'nkosi@gmail.com', '$2y$10$/fhm/xWxUfvrJJghn4bm7.STbLMmwf1voz0Sup9goKpL9yFyFnGE2', '2024-02-28 13:23:02'),
(6, 'onice', 'admin@gmail.com', '$2y$10$6fMuPNXscqqqN5C66S4oveav0Lq5KhzlchHdRIS7Wh53dtHQWGxtq', '2024-02-28 13:34:10');

-- --------------------------------------------------------

--
-- Table structure for table `destination_fares`
--

CREATE TABLE `destination_fares` (
  `fare_id` int(11) NOT NULL,
  `taxi_rank_id` int(11) NOT NULL,
  `destination` varchar(255) NOT NULL,
  `fare` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `destination_fares`
--

INSERT INTO `destination_fares` (`fare_id`, `taxi_rank_id`, `destination`, `fare`) VALUES
(1, 8, 'Midrand', 20.00),
(2, 9, 'Midrand', 20.00),
(3, 10, 'vodaworld', 19.50),
(4, 11, 'Midrand', 25.00),
(5, 11, 'Kaalfontein', 21.00),
(6, 11, 'MTN', 33.00);

-- --------------------------------------------------------

--
-- Table structure for table `taxi_ranks`
--

CREATE TABLE `taxi_ranks` (
  `rank_id` int(11) NOT NULL,
  `rank_name` varchar(255) NOT NULL,
  `tAddress` varchar(255) NOT NULL,
  `taxi_association` varchar(255) NOT NULL,
  `operating_hours` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `taxi_ranks`
--

INSERT INTO `taxi_ranks` (`rank_id`, `rank_name`, `tAddress`, `taxi_association`, `operating_hours`) VALUES
(8, 'Kaalfontein Taxi Rank', 'Taxi Rank - JR108, Kaalfontein Station, Kaalfontein, Midrand, 1632', 'iPTA', '05:00-20:00'),
(9, 'ivory 2 Taxi Rank', 'ivory park 2', 'iPTA', '05:00-20:00'),
(10, 'Kaalfontein Taxi Rank', 'Taxi Rank - JR108, Kaalfontein Station, Kaalfontein, Midrand, 1632', 'iPTA', '05:00-20:00'),
(11, 'Centurion Taxi rank', 'Centurion', 'iPTA', '05:00-20:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `destination_fares`
--
ALTER TABLE `destination_fares`
  ADD PRIMARY KEY (`fare_id`),
  ADD KEY `taxi_rank_id` (`taxi_rank_id`);

--
-- Indexes for table `taxi_ranks`
--
ALTER TABLE `taxi_ranks`
  ADD PRIMARY KEY (`rank_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `destination_fares`
--
ALTER TABLE `destination_fares`
  MODIFY `fare_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `taxi_ranks`
--
ALTER TABLE `taxi_ranks`
  MODIFY `rank_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `destination_fares`
--
ALTER TABLE `destination_fares`
  ADD CONSTRAINT `destination_fares_ibfk_1` FOREIGN KEY (`taxi_rank_id`) REFERENCES `taxi_ranks` (`rank_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
