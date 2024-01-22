-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 22, 2024 at 07:33 AM
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
-- Database: `devgenius`
--

-- --------------------------------------------------------

--
-- Table structure for table `calendar_event_master`
--

CREATE TABLE `calendar_event_master` (
  `event_id` int(11) NOT NULL,
  `event_name` varchar(255) DEFAULT NULL,
  `event_start_date` date DEFAULT NULL,
  `event_start_time` time DEFAULT NULL,
  `event_end_date` date DEFAULT NULL,
  `event_end_time` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `calendar_event_master`
--

INSERT INTO `calendar_event_master` (`event_id`, `event_name`, `event_start_date`, `event_start_time`, `event_end_date`, `event_end_time`) VALUES
(1, 'HarmonyQuest: Bridging Cultures Through Volunteerism', '2023-12-02', '08:00:00', '2023-12-07', '03:00:00'),
(2, 'Beach Cleanup Initiative', '2023-12-23', '10:00:00', '2023-12-23', '12:00:00'),
(3, 'Beach Cleanup Initiative', '2024-01-20', '10:00:00', '2024-01-20', '12:00:00'),
(4, 'Beach Cleanup Initiative', '2024-02-17', '10:00:00', '2024-02-17', '12:00:00'),
(5, 'Planting trees is fun', '2023-11-18', '09:00:00', '2023-11-18', '12:00:00'),
(6, 'EcoCycle: Renewing Communities Through Recycling', '2024-01-06', '09:00:00', '2024-01-06', '16:00:00'),
(8, 'Senior Center Companion', '2024-01-14', '14:00:00', '2024-01-14', '16:00:00'),
(9, 'Senior Center Companion', '2024-01-21', '14:00:00', '2024-01-21', '16:00:00'),
(10, 'Senior Center Companion', '2024-01-28', '14:00:00', '2024-01-28', '16:00:00'),
(11, 'Big Brother/ Big Sister Program', '2024-01-27', '08:00:00', '2024-01-27', '16:00:00'),
(12, 'Health and Wellness Workshops', '2024-01-19', '08:00:00', '2024-01-19', '16:00:00'),
(13, 'Career Development Seminars', '2024-02-01', '14:30:00', '2024-02-01', '16:30:00'),
(14, 'Campus Blood Donation Campaign', '2024-02-03', '08:00:00', '2024-02-03', '17:00:00'),
(15, 'Community Health Fair', '2024-01-30', '09:00:00', '2024-01-30', '16:00:02'),
(16, 'Women\'s Empowerment Workshop', '2024-02-04', '14:00:00', '2024-02-04', '18:00:00'),
(17, 'Animal Shelter Volunteer Day', '2023-12-30', '10:00:00', '2023-12-30', '17:00:00'),
(18, 'Sustainable Agriculture Project', '2024-02-10', '09:00:00', '2024-02-10', '18:00:00'),
(19, 'Clean Water Initiative', '2024-01-25', '08:00:00', '2024-01-25', '16:00:00'),
(20, 'Briefing of EcoCycle', '2024-01-06', '08:30:00', '2024-01-06', '08:45:00'),
(33, 'Serve Love', '2024-01-15', '14:00:00', '2024-01-15', '15:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `calendar_event_master`
--
ALTER TABLE `calendar_event_master`
  ADD PRIMARY KEY (`event_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `calendar_event_master`
--
ALTER TABLE `calendar_event_master`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
