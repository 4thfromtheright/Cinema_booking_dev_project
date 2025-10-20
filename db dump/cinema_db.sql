-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Generation Time: Oct 20, 2025 at 03:36 PM
-- Server version: 5.7.44
-- PHP Version: 8.3.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cinema_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `CB_BOOKING`
--

CREATE TABLE `CB_BOOKING` (
  `booking_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `showing_id` int(11) NOT NULL,
  `seat_id` int(11) NOT NULL,
  `booking_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `confirmation_code` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `CB_BOOKING`
--

INSERT INTO `CB_BOOKING` (`booking_id`, `user_id`, `showing_id`, `seat_id`, `booking_time`, `confirmation_code`) VALUES
(1, 5, 12, 101, '2025-10-20 13:55:45', '6426B909'),
(2, 5, 12, 102, '2025-10-20 13:55:45', 'A3198E4D'),
(3, 5, 12, 103, '2025-10-20 13:55:45', '7A781843'),
(5, 5, 12, 104, '2025-10-20 14:12:14', 'C1F06C8B'),
(6, 5, 12, 105, '2025-10-20 14:12:14', '1D9D688C'),
(7, 5, 12, 106, '2025-10-20 14:12:14', 'C7BCBC36'),
(9, 6, 12, 107, '2025-10-20 14:27:26', '342560C3'),
(10, 6, 12, 108, '2025-10-20 14:27:26', 'E4F32A8E'),
(11, 6, 12, 109, '2025-10-20 14:27:26', 'D3F5828D'),
(13, 6, 12, 1, '2025-10-20 14:55:12', '92B9C2C5'),
(14, 6, 12, 2, '2025-10-20 14:55:12', 'F0509E64'),
(15, 6, 12, 3, '2025-10-20 14:55:12', '40D1B9F4'),
(16, 6, 1, 1, '2025-10-20 15:09:38', '80782758'),
(17, 6, 1, 2, '2025-10-20 15:09:38', 'BF3CEAFD'),
(18, 6, 1, 3, '2025-10-20 15:27:27', '3FD8EE17'),
(19, 6, 1, 4, '2025-10-20 15:27:27', 'A3121D4E');

-- --------------------------------------------------------

--
-- Table structure for table `CB_CINEMA`
--

CREATE TABLE `CB_CINEMA` (
  `cinema_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `location` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `CB_CINEMA`
--

INSERT INTO `CB_CINEMA` (`cinema_id`, `name`, `location`) VALUES
(1, 'Grand Cinema', 'Downtown'),
(2, 'Starplex', 'Uptown');

-- --------------------------------------------------------

--
-- Table structure for table `CB_FILMS`
--

CREATE TABLE `CB_FILMS` (
  `film_id` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `genre` varchar(50) DEFAULT NULL,
  `duration_minutes` int(11) DEFAULT NULL,
  `description` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `CB_FILMS`
--

INSERT INTO `CB_FILMS` (`film_id`, `title`, `genre`, `duration_minutes`, `description`) VALUES
(1, 'The Great Adventure', 'Action', 120, 'An epic action movie.'),
(2, 'Romantic Escape', 'Romance', 95, 'A touching love story.'),
(3, 'Mystery Manor', 'Thriller', 110, 'A suspenseful thriller.');

-- --------------------------------------------------------

--
-- Table structure for table `CB_SEATS`
--

CREATE TABLE `CB_SEATS` (
  `seat_id` int(11) NOT NULL,
  `theater_id` int(11) NOT NULL,
  `seat_number` varchar(10) NOT NULL,
  `row_label` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `CB_SEATS`
--

INSERT INTO `CB_SEATS` (`seat_id`, `theater_id`, `seat_number`, `row_label`) VALUES
(1, 1, 'A1', 'A'),
(2, 1, 'A2', 'A'),
(3, 1, 'A3', 'A'),
(4, 1, 'A4', 'A'),
(5, 1, 'A5', 'A'),
(6, 1, 'B1', 'B'),
(7, 1, 'B2', 'B'),
(8, 1, 'B3', 'B'),
(9, 1, 'B4', 'B'),
(10, 1, 'B5', 'B'),
(11, 1, 'C1', 'C'),
(12, 1, 'C2', 'C'),
(13, 1, 'C3', 'C'),
(14, 1, 'C4', 'C'),
(15, 1, 'C5', 'C'),
(16, 1, 'D1', 'D'),
(17, 1, 'D2', 'D'),
(18, 1, 'D3', 'D'),
(19, 1, 'D4', 'D'),
(20, 1, 'D5', 'D'),
(21, 1, 'E1', 'E'),
(22, 1, 'E2', 'E'),
(23, 1, 'E3', 'E'),
(24, 1, 'E4', 'E'),
(25, 1, 'E5', 'E'),
(26, 1, 'F1', 'F'),
(27, 1, 'F2', 'F'),
(28, 1, 'F3', 'F'),
(29, 1, 'F4', 'F'),
(30, 1, 'F5', 'F'),
(31, 2, 'A1', 'A'),
(32, 2, 'A2', 'A'),
(33, 2, 'A3', 'A'),
(34, 2, 'A4', 'A'),
(35, 2, 'A5', 'A'),
(36, 2, 'B1', 'B'),
(37, 2, 'B2', 'B'),
(38, 2, 'B3', 'B'),
(39, 2, 'B4', 'B'),
(40, 2, 'B5', 'B'),
(41, 2, 'C1', 'C'),
(42, 2, 'C2', 'C'),
(43, 2, 'C3', 'C'),
(44, 2, 'C4', 'C'),
(45, 2, 'C5', 'C'),
(46, 2, 'D1', 'D'),
(47, 2, 'D2', 'D'),
(48, 2, 'D3', 'D'),
(49, 2, 'D4', 'D'),
(50, 2, 'D5', 'D'),
(51, 2, 'E1', 'E'),
(52, 2, 'E2', 'E'),
(53, 2, 'E3', 'E'),
(54, 2, 'E4', 'E'),
(55, 2, 'E5', 'E'),
(56, 2, 'F1', 'F'),
(57, 2, 'F2', 'F'),
(58, 2, 'F3', 'F'),
(59, 2, 'F4', 'F'),
(60, 2, 'F5', 'F'),
(61, 3, 'A1', 'A'),
(62, 3, 'A2', 'A'),
(63, 3, 'A3', 'A'),
(64, 3, 'A4', 'A'),
(65, 3, 'A5', 'A'),
(66, 3, 'B1', 'B'),
(67, 3, 'B2', 'B'),
(68, 3, 'B3', 'B'),
(69, 3, 'B4', 'B'),
(70, 3, 'B5', 'B'),
(71, 3, 'C1', 'C'),
(72, 3, 'C2', 'C'),
(73, 3, 'C3', 'C'),
(74, 3, 'C4', 'C'),
(75, 3, 'C5', 'C'),
(76, 3, 'D1', 'D'),
(77, 3, 'D2', 'D'),
(78, 3, 'D3', 'D'),
(79, 3, 'D4', 'D'),
(80, 3, 'D5', 'D'),
(81, 3, 'E1', 'E'),
(82, 3, 'E2', 'E'),
(83, 3, 'E3', 'E'),
(84, 3, 'E4', 'E'),
(85, 3, 'E5', 'E'),
(86, 3, 'F1', 'F'),
(87, 3, 'F2', 'F'),
(88, 3, 'F3', 'F'),
(89, 3, 'F4', 'F'),
(90, 3, 'F5', 'F'),
(91, 4, 'A1', 'A'),
(92, 4, 'A2', 'A'),
(93, 4, 'A3', 'A'),
(94, 4, 'A4', 'A'),
(95, 4, 'A5', 'A'),
(96, 4, 'B1', 'B'),
(97, 4, 'B2', 'B'),
(98, 4, 'B3', 'B'),
(99, 4, 'B4', 'B'),
(100, 4, 'B5', 'B'),
(101, 4, 'C1', 'C'),
(102, 4, 'C2', 'C'),
(103, 4, 'C3', 'C'),
(104, 4, 'C4', 'C'),
(105, 4, 'C5', 'C'),
(106, 4, 'D1', 'D'),
(107, 4, 'D2', 'D'),
(108, 4, 'D3', 'D'),
(109, 4, 'D4', 'D'),
(110, 4, 'D5', 'D'),
(111, 4, 'E1', 'E'),
(112, 4, 'E2', 'E'),
(113, 4, 'E3', 'E'),
(114, 4, 'E4', 'E'),
(115, 4, 'E5', 'E'),
(116, 4, 'F1', 'F'),
(117, 4, 'F2', 'F'),
(118, 4, 'F3', 'F'),
(119, 4, 'F4', 'F'),
(120, 4, 'F5', 'F'),
(121, 5, 'A1', 'A'),
(122, 5, 'A2', 'A'),
(123, 5, 'A3', 'A'),
(124, 5, 'A4', 'A'),
(125, 5, 'A5', 'A'),
(126, 5, 'B1', 'B'),
(127, 5, 'B2', 'B'),
(128, 5, 'B3', 'B'),
(129, 5, 'B4', 'B'),
(130, 5, 'B5', 'B'),
(131, 5, 'C1', 'C'),
(132, 5, 'C2', 'C'),
(133, 5, 'C3', 'C'),
(134, 5, 'C4', 'C'),
(135, 5, 'C5', 'C'),
(136, 5, 'D1', 'D'),
(137, 5, 'D2', 'D'),
(138, 5, 'D3', 'D'),
(139, 5, 'D4', 'D'),
(140, 5, 'D5', 'D'),
(141, 5, 'E1', 'E'),
(142, 5, 'E2', 'E'),
(143, 5, 'E3', 'E'),
(144, 5, 'E4', 'E'),
(145, 5, 'E5', 'E'),
(146, 5, 'F1', 'F'),
(147, 5, 'F2', 'F'),
(148, 5, 'F3', 'F'),
(149, 5, 'F4', 'F'),
(150, 5, 'F5', 'F'),
(151, 6, 'A1', 'A'),
(152, 6, 'A2', 'A'),
(153, 6, 'A3', 'A'),
(154, 6, 'A4', 'A'),
(155, 6, 'A5', 'A'),
(156, 6, 'B1', 'B'),
(157, 6, 'B2', 'B'),
(158, 6, 'B3', 'B'),
(159, 6, 'B4', 'B'),
(160, 6, 'B5', 'B'),
(161, 6, 'C1', 'C'),
(162, 6, 'C2', 'C'),
(163, 6, 'C3', 'C'),
(164, 6, 'C4', 'C'),
(165, 6, 'C5', 'C'),
(166, 6, 'D1', 'D'),
(167, 6, 'D2', 'D'),
(168, 6, 'D3', 'D'),
(169, 6, 'D4', 'D'),
(170, 6, 'D5', 'D'),
(171, 6, 'E1', 'E'),
(172, 6, 'E2', 'E'),
(173, 6, 'E3', 'E'),
(174, 6, 'E4', 'E'),
(175, 6, 'E5', 'E'),
(176, 6, 'F1', 'F'),
(177, 6, 'F2', 'F'),
(178, 6, 'F3', 'F'),
(179, 6, 'F4', 'F'),
(180, 6, 'F5', 'F');

-- --------------------------------------------------------

--
-- Table structure for table `CB_SHOWINGS`
--

CREATE TABLE `CB_SHOWINGS` (
  `showing_id` int(11) NOT NULL,
  `theater_id` int(11) NOT NULL,
  `film_id` int(11) NOT NULL,
  `show_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `CB_SHOWINGS`
--

INSERT INTO `CB_SHOWINGS` (`showing_id`, `theater_id`, `film_id`, `show_time`) VALUES
(1, 1, 1, '2025-10-20 12:00:00'),
(2, 1, 1, '2025-10-20 15:00:00'),
(3, 1, 1, '2025-10-20 18:00:00'),
(4, 1, 1, '2025-10-21 12:00:00'),
(5, 1, 1, '2025-10-21 15:00:00'),
(6, 1, 1, '2025-10-21 18:00:00'),
(7, 1, 2, '2025-10-20 12:30:00'),
(8, 1, 2, '2025-10-20 15:30:00'),
(9, 1, 2, '2025-10-20 18:30:00'),
(10, 1, 3, '2025-10-20 13:00:00'),
(11, 1, 3, '2025-10-20 16:00:00'),
(12, 1, 3, '2025-10-20 19:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `CB_THEATER`
--

CREATE TABLE `CB_THEATER` (
  `theater_id` int(11) NOT NULL,
  `cinema_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `seat_count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `CB_THEATER`
--

INSERT INTO `CB_THEATER` (`theater_id`, `cinema_id`, `name`, `seat_count`) VALUES
(1, 1, 'Grand Theater 1', 30),
(2, 1, 'Grand Theater 2', 30),
(3, 1, 'Grand Theater 3', 30),
(4, 2, 'Starplex Hall 1', 30),
(5, 2, 'Starplex Hall 2', 30),
(6, 2, 'Starplex Hall 3', 30);

-- --------------------------------------------------------

--
-- Table structure for table `CB_USERS`
--

CREATE TABLE `CB_USERS` (
  `user_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `CB_USERS`
--

INSERT INTO `CB_USERS` (`user_id`, `name`, `email`, `password_hash`, `created_at`) VALUES
(1, 'Alice Johnson', 'alice@example.com', 'hashed_pw1', '2025-10-20 09:49:27'),
(2, 'Bob Smith', 'bob@example.com', 'hashed_pw2', '2025-10-20 09:49:27'),
(3, 'Carol Lee', 'carol@example.com', 'hashed_pw3', '2025-10-20 09:49:27'),
(4, 'David Kim', 'david@example.com', 'hashed_pw4', '2025-10-20 09:49:27'),
(5, 'Eve Park', 'eve@example.com', 'hashed_pw5', '2025-10-20 09:49:27'),
(6, 'test', 'test', '$2y$10$dB8kIzIoP7TwTTVW0EMBCeKKDI5FSsVUqlRRtfDvXtWsSvdQRgh.i', '2025-10-20 10:56:33');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `CB_BOOKING`
--
ALTER TABLE `CB_BOOKING`
  ADD PRIMARY KEY (`booking_id`),
  ADD UNIQUE KEY `showing_id` (`showing_id`,`seat_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `seat_id` (`seat_id`);

--
-- Indexes for table `CB_CINEMA`
--
ALTER TABLE `CB_CINEMA`
  ADD PRIMARY KEY (`cinema_id`);

--
-- Indexes for table `CB_FILMS`
--
ALTER TABLE `CB_FILMS`
  ADD PRIMARY KEY (`film_id`);

--
-- Indexes for table `CB_SEATS`
--
ALTER TABLE `CB_SEATS`
  ADD PRIMARY KEY (`seat_id`),
  ADD UNIQUE KEY `theater_id` (`theater_id`,`seat_number`);

--
-- Indexes for table `CB_SHOWINGS`
--
ALTER TABLE `CB_SHOWINGS`
  ADD PRIMARY KEY (`showing_id`),
  ADD KEY `theater_id` (`theater_id`),
  ADD KEY `film_id` (`film_id`);

--
-- Indexes for table `CB_THEATER`
--
ALTER TABLE `CB_THEATER`
  ADD PRIMARY KEY (`theater_id`),
  ADD KEY `cinema_id` (`cinema_id`);

--
-- Indexes for table `CB_USERS`
--
ALTER TABLE `CB_USERS`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `CB_BOOKING`
--
ALTER TABLE `CB_BOOKING`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `CB_CINEMA`
--
ALTER TABLE `CB_CINEMA`
  MODIFY `cinema_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `CB_FILMS`
--
ALTER TABLE `CB_FILMS`
  MODIFY `film_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `CB_SEATS`
--
ALTER TABLE `CB_SEATS`
  MODIFY `seat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=181;

--
-- AUTO_INCREMENT for table `CB_SHOWINGS`
--
ALTER TABLE `CB_SHOWINGS`
  MODIFY `showing_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `CB_THEATER`
--
ALTER TABLE `CB_THEATER`
  MODIFY `theater_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `CB_USERS`
--
ALTER TABLE `CB_USERS`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `CB_BOOKING`
--
ALTER TABLE `CB_BOOKING`
  ADD CONSTRAINT `CB_BOOKING_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `CB_USERS` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `CB_BOOKING_ibfk_2` FOREIGN KEY (`showing_id`) REFERENCES `CB_SHOWINGS` (`showing_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `CB_BOOKING_ibfk_3` FOREIGN KEY (`seat_id`) REFERENCES `CB_SEATS` (`seat_id`) ON DELETE CASCADE;

--
-- Constraints for table `CB_SEATS`
--
ALTER TABLE `CB_SEATS`
  ADD CONSTRAINT `CB_SEATS_ibfk_1` FOREIGN KEY (`theater_id`) REFERENCES `CB_THEATER` (`theater_id`) ON DELETE CASCADE;

--
-- Constraints for table `CB_SHOWINGS`
--
ALTER TABLE `CB_SHOWINGS`
  ADD CONSTRAINT `CB_SHOWINGS_ibfk_1` FOREIGN KEY (`theater_id`) REFERENCES `CB_THEATER` (`theater_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `CB_SHOWINGS_ibfk_2` FOREIGN KEY (`film_id`) REFERENCES `CB_FILMS` (`film_id`) ON DELETE CASCADE;

--
-- Constraints for table `CB_THEATER`
--
ALTER TABLE `CB_THEATER`
  ADD CONSTRAINT `CB_THEATER_ibfk_1` FOREIGN KEY (`cinema_id`) REFERENCES `CB_CINEMA` (`cinema_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
