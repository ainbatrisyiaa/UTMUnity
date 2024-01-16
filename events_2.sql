-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 03, 2024 at 06:47 AM
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
-- Database: `volunteering_events`
--

-- --------------------------------------------------------

--
-- Table structure for table `events_2`
--

CREATE TABLE `events_2` (
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `details` text NOT NULL,
  `category` varchar(100) NOT NULL,
  `meta_description` varchar(255) NOT NULL,
  `meta_keywords` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events_2`
--

INSERT INTO `events_2` (`id`, `image`, `title`, `description`, `details`, `category`, `meta_description`, `meta_keywords`) VALUES
(1, 'img1.jpg', 'Planting trees is fun', 'Volunteering in tree planting activities involves actively participating in the cultivation and establishment of trees in designated areas. This hands-on environmental initiative aims to enhance and restore ecosystems, combat deforestation, and contribute to overall ecological sustainability.', 'Date: Saturday, November 18, 2023 <br>\r\nTime: 9:00 AM - 12:00 PM <br>\r\nLocation: Tropical Park UTM <br>\r\nTargeting 100 volunteers <br>\r\nProvided: Shovels, gloves, watering can, mulch <br>\r\nOnline registration form available on the community website', 'UTMVolunteer', 'event description', 'event keywords'),
(2, 'img2.jpg', 'HarmonyQuest: Bridging Cultures Through Volunteerism', 'HarmonyQuest is a unique volunteer event designed to foster understanding and connection between different cultures, specifically focusing on visits to tribal communities. This program aims to create a bridge of harmony between volunteers and tribal people, fostering mutual respect, cultural exchange, and meaningful interactions.', 'Date: Saturday, December 2, 2023 - Thursday, December 7, 2023 <br>\r\n6 Days <br>\r\nLocation: Kampung Koa Pasir Putih <br>\r\nTargeting 50 volunteers<br>\r\nProvided: Food, Tent, Transportation <br> Acommodation: Volunteers will stay in Kampung Koa Pasir Putih to immerse themselves in the local environment <br> Fees: RM30 per person', 'NGO', 'event description', 'event keywords'),
(3, 'img3.jpeg', 'EcoCycle: Renewing Communities Through Recycling', 'EcoCycle is an impactful volunteer event dedicated to making a positive difference in our environment by focusing on recycling initiatives. This program is designed to empower volunteers to contribute actively to recycling efforts, promoting sustainability, and fostering a sense of environmental responsibility.', 'Date: Saturday, January 6, 2024 <br>\r\nTime: 9:00 AM - 4:00 PM <br>\r\nLocation: UTM Campus <br>\r\nTargeting 150 volunteers', 'UTMVolunteer', 'event description', 'event keywords'),
(4, 'img4.jpg', 'Beach Cleanup Initiative', 'Contribute to the preservation of coastal ecosystems by participating in beach cleanup activities.', 'Date: Every third Saturday of the month <br>\r\nTime: 10:00 AM to 12:00 PM <br>\r\nLocation: Pantai Tanjung Lompat, Desaru <br>\r\nTargeting 100 volunteers <br>\r\nBring gloves and reusable bags to collect and properly dispose of litter <br>\r\nCoordinate with local environmental organizations for meeting points and logistics. <br>\r\nAdditionally, organize educational sessions on marine conservation in collaboration with local schools and communities.', 'NGO', 'event description', 'event keywords'),
(5, 'img5.jpg', 'Senior Center Companion', 'Spending time at the senior center every Sunday afternoon from 2:00 PM to 4:00 PM as a companion to the elderly is a heartwarming service. Your organization of activities and assistance with errands on Wednesdays and Fridays brings joy and support to the senior community.', 'Date: Every Sunday <br>\r\nTime: Afternoon from 2:00 PM to 4:00 PM <br>\r\nLocation: Pusat Jagaan Orang Tua Ceria <br>\r\nAssist with errands on Wednesdays and Fridays', 'UTMVolunteer', 'event description', 'event keywords'),
(6, 'img6.jpg', 'Big Brother/Big Sister Program', 'Mentor and be a positive influence on a younger person\'s life. Your role in the Big Brother/Big Sister Program goes beyond mentorship; it\'s about being a positive influence. Spending time with your mentees  and engaging in monthly constructive activities like bowling or hiking fosters a supportive and impactful relationship.', 'Date: 27 January 2024 <br>\r\nTime: 8 AM - 4 PM <br>\r\nLocation: SK Taman Tun Aminah <br>\r\n', 'UTMVolunteer', 'event description', 'event keywords'),
(7, 'img7.jpg', 'Health and Wellness Workshops', 'Your involvement in health and wellness workshops is crucial in promoting a holistic approach to well-being. By inviting professionals to speak on nutrition, mental health, and fitness, you provide valuable insights and resources to empower your peers in maintaining a healthy lifestyle.', 'Date: 19 January 2024 <br>\r\nTime: 8 AM - 12 PM <br>\r\nLocation: L50, UTM <br>\r\nGuest speakers include nutritionists, mental health professionals, and fitness trainers. <br>\r\nLimited to 150 participants.', 'UTMVolunteer', 'event description', 'event keywords'),
(8, 'img8.jpg', 'Career Development Seminars', 'Help students prepare for the workforce through resume building and interview skills.', 'Date: 1 February 2024 <br>\r\nTime: 2.30 PM - 4.30PM <br>\r\nLocation: UTM Career Center', 'UTMVolunteer', 'event description', 'event keywords'),
(9, 'img9.jpg', 'Campus Blood Donation Campaign', 'Organizing blood donation drives to contribute to local healthcare needs.', 'The campaign aims to boost blood supplies in collaboration with local hospitals, encouraging students and staff to donate blood on campus. <br>\r\n\r\nDate: February 3, 2024 <br>\r\nTime: 8 AM - 5 PM <br>\r\nVenue: Dewan Sultan Ibrahim, UTM', 'UTMVolunteer', 'event description', 'event keywords'),
(10, 'img10.jpg', 'Community Health Fair', 'Offering free health check-ups, vaccinations, and health education to underserved communities.\r\nThe event will bring together healthcare professionals and volunteers to provide essential health services to local residents.', 'Date: January 30, 2024 <br>\r\nTime: 9 AM - 4 PM <br>\r\nVenue: Dewan Serbaguna Skudai', 'NGO', 'event description ', 'event keywords'),
(11, 'img11.jpg', 'Women\'s Empowerment Workshop', 'Empowering women in nearby communities through skill-building and confidence-building workshops.\r\nWorkshops will cover topics such as entrepreneurship, financial literacy, and self-defense, aiming to empower women to lead independent lives.', 'Date: February 4, 2024 <br>\r\nTime: 2 PM - 6 PM <br>\r\nVenue: Dewan Raya Taman Sri Skudai', 'NGO', 'event description ', 'event keywords'),
(12, 'img12.jpeg', 'Animal Shelter Volunteer Day', 'Assisting local animal shelters with care, cleaning, and adoption events. <br>\r\nVolunteers will spend a day at the animal shelter, providing care for animals, and participating in adoption events to find loving homes for pets.', 'Date: December 30, 2023 <br>\r\nTime: 10 AM - 5 PM <br>\r\nVenue: Noah\'s Ark Natural Animal Sanctuary <br>\r\nTargeting 50 volunteers', 'NGO', 'event description ', 'event keywords'),
(13, 'img13.jpg', 'Sustainable Agriculture Project', 'Implementing sustainable farming practices in collaboration with local farmers and agricultural organizations. <br>\r\nVolunteers will participate in hands-on farming activities, promoting sustainable agriculture and environmental conservation.', 'Date: February 10, 2024 <br>\r\nTime: 9 AM - 6 PM <br>\r\nVenue: Desaru Fruit Farm <br>\r\n\r\nTargeting 50 volunteers', 'NGO', 'event description', 'event keywords'),
(14, 'img14.jpg', 'Clean Water Initiative', 'Installing water purification systems in underserved communities to ensure access to clean and safe drinking water. <br>\r\nThe project will involve installing water purification systems, conducting hygiene awareness sessions, and monitoring water quality in collaboration with local communities.', 'Date: January 25, 2024 <br>\r\nTime: 8 AM - 4 PM <br>\r\nVenue: Kampung Rantau Panjang <br>\r\n\r\nTargeting 60 volunteers', 'NGO', 'event description', 'event keywords');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `events_2`
--
ALTER TABLE `events_2`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events_2`
--
ALTER TABLE `events_2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
