-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 07, 2022 at 11:26 AM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `get_devs_db`
--
CREATE DATABASE IF NOT EXISTS `get_devs_db` DEFAULT CHARACTER SET utf16 COLLATE utf16_unicode_ci;
USE `get_devs_db`;

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE IF NOT EXISTS `companies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf16_unicode_ci NOT NULL,
  `owner` varchar(50) COLLATE utf16_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf16_unicode_ci NOT NULL,
  `phone` varchar(50) COLLATE utf16_unicode_ci NOT NULL,
  `location` varchar(100) COLLATE utf16_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_ci;

--
-- Dumping data for table `companies`
--

INSERT IGNORE INTO `companies` (`id`, `name`, `owner`, `email`, `phone`, `location`) VALUES
(1, 'Kompanija1', 'Ime Prezime1', 'email1@mail.com', '+381600000001', 'Lokacija1'),
(2, 'Kompanija2', 'Ime Prezime2', 'email2@mail.com', '+381600000002', 'Lokacija2'),
(3, 'Kompanija3', 'Ime Prezime3', 'email3@mail.com', '+381600000003', 'Lokacija3'),
(4, 'Kompanija4', 'Ime Prezime4', 'email4@mail.com', '+381600000004', 'Lokacija4'),
(5, 'Kompanija5', 'Ime Prezime5', 'email5@mail.com', '+381600000005', 'Lokacija5'),
(6, 'Kompanija6', 'Ime Prezime6', 'email6@mail.com', '+381600000006', 'Lokacija6'),
(7, 'IT Company', 'Ivan Vaskovic', 'company@company', '+381641231231', 'Beograd');

-- --------------------------------------------------------

--
-- Table structure for table `devs`
--

CREATE TABLE IF NOT EXISTS `devs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf16_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf16_unicode_ci NOT NULL,
  `phone` varchar(50) COLLATE utf16_unicode_ci NOT NULL,
  `location` varchar(100) COLLATE utf16_unicode_ci NOT NULL,
  `profile_picture` varchar(300) COLLATE utf16_unicode_ci NOT NULL,
  `price_per_hour` smallint(6) NOT NULL,
  `javascript` tinyint(1) NOT NULL,
  `java` tinyint(1) NOT NULL,
  `net` tinyint(1) NOT NULL,
  `flutter` tinyint(1) NOT NULL,
  `python` tinyint(1) NOT NULL,
  `php` tinyint(1) NOT NULL,
  `description` text COLLATE utf16_unicode_ci NOT NULL,
  `years_of_exp` tinyint(4) NOT NULL,
  `native_language` varchar(50) COLLATE utf16_unicode_ci NOT NULL,
  `linked_in` varchar(100) COLLATE utf16_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_ci;

--
-- Dumping data for table `devs`
--

INSERT IGNORE INTO `devs` (`id`, `name`, `email`, `phone`, `location`, `profile_picture`, `price_per_hour`, `javascript`, `java`, `net`, `flutter`, `python`, `php`, `description`, `years_of_exp`, `native_language`, `linked_in`) VALUES
(1, 'Ime Prezime1', 'mail1@mail.com', '+381600000001', 'Lokacija1', './images/faces/face1.jpg', 40, 1, 1, 0, 0, 1, 0, 'Opis developera1', 3, 'Serbian', 'https://www.linkedin.com/in/ivan-vaskovic-a9003222b/'),
(2, 'Ime Prezime2', 'mail2@mail.com', '+381600000002', 'Lokacija2', './images/faces/face2.jpg', 50, 0, 1, 0, 1, 1, 0, 'Opis developera2', 1, 'English', 'https://www.linkedin.com/in/ivan-vaskovic-a9003222b/'),
(3, 'Ime Prezime3', 'mail3@mail.com', '+381600000003', 'Lokacija3', './images/faces/face3.jpg', 45, 1, 1, 0, 0, 0, 0, 'Opis developera3', 4, 'Bulgarian', 'https://www.linkedin.com/in/ivan-vaskovic-a9003222b/'),
(4, 'Ime Prezime4', 'mail4@mail.com', '+381600000004', 'Lokacija4', './images/faces/face4.jpg', 30, 0, 1, 0, 0, 1, 1, 'Opis developera4', 4, 'Serbian', 'https://www.linkedin.com/in/ivan-vaskovic-a9003222b/'),
(5, 'Ime Prezime5', 'mail5@mail.com', '+381600000005', 'Lokacija5', './images/faces/face5.jpg', 43, 1, 1, 0, 1, 1, 0, 'Opis developera5', 3, 'Bulgarian', 'https://www.linkedin.com/in/ivan-vaskovic-a9003222b/'),
(6, 'Ime Prezime6', 'mail6@mail.com', '+381600000006', 'Lokacija6', './images/faces/face6.jpg', 60, 1, 1, 1, 0, 1, 0, 'Opis developera6', 3, 'Serbian', 'https://www.linkedin.com/in/ivan-vaskovic-a9003222b/'),
(7, 'Ime Prezime7', 'mail7@mail.com', '+381600000007', 'Lokacija7', './images/faces/face7.jpg', 50, 0, 1, 1, 1, 0, 1, 'Opis developera7', 1, 'English', 'https://www.linkedin.com/in/ivan-vaskovic-a9003222b/'),
(8, 'Ime Prezime8', 'mail8@mail.com', '+381600000008', 'Lokacija8', './images/faces/face8.jpg', 35, 0, 1, 0, 0, 1, 0, 'Opis developera8', 2, 'English', 'https://www.linkedin.com/in/ivan-vaskovic-a9003222b/'),
(9, 'Ime Prezime9', 'mail9@mail.com', '+381600000009', 'Lokacija9', './images/faces/face9.jpg', 30, 1, 1, 0, 0, 0, 1, 'Opis developera9', 4, 'Serbian', 'https://www.linkedin.com/in/ivan-vaskovic-a9003222b/'),
(10, 'Ime Prezime10', 'mail10@mail.com', '+381600000010', 'Lokacija10', './images/faces/face10.jpg', 40, 1, 1, 0, 0, 1, 0, 'Opis developera10', 3, 'English', 'https://www.linkedin.com/in/ivan-vaskovic-a9003222b/'),
(11, 'Ime Prezime11', 'mail11@mail.com', '+381600000011', 'Lokacija11', './images/faces/face11.jpg', 45, 0, 1, 1, 1, 1, 0, 'Opis developera11', 6, 'Bulgarian', 'https://www.linkedin.com/in/ivan-vaskovic-a9003222b/'),
(12, 'Ime Prezime12', 'mail12@mail.com', '+381600000012', 'Lokacija12', './images/faces/face12.jpg', 49, 1, 1, 0, 1, 0, 1, 'Opis developera12', 3, 'Serbian', 'https://www.linkedin.com/in/ivan-vaskovic-a9003222b/'),
(13, 'Ime Prezime13', 'mail13@mail.com', '+381600000013', 'Lokacija13', './images/faces/face13.jpg', 42, 0, 0, 0, 0, 1, 1, 'Opis developera13', 7, 'English', 'https://www.linkedin.com/in/ivan-vaskovic-a9003222b/'),
(14, 'Ime Prezime14', 'mail14@mail.com', '+381600000014', 'Lokacija14', './images/faces/face14.jpg', 55, 1, 0, 0, 0, 1, 0, 'Opis developera14', 5, 'English', 'https://www.linkedin.com/in/ivan-vaskovic-a9003222b/'),
(15, 'Ime Prezime15', 'mail15@mail.com', '+381600000015', 'Lokacija15', './images/faces/face15.jpg', 60, 0, 1, 0, 0, 1, 1, 'Opis developera15', 4, 'Serbian', 'https://www.linkedin.com/in/ivan-vaskovic-a9003222b/'),
(16, 'Ime Prezime16', 'mail16@mail.com', '+381600000016', 'Lokacija16', './images/faces/face16.jpg', 70, 1, 1, 1, 1, 1, 1, 'Opis developera16', 4, 'Bulgarian', 'https://www.linkedin.com/in/ivan-vaskovic-a9003222b/'),
(17, 'Ime Prezime17', 'mail17@mail.com', '+381600000017', 'Lokacija17', './images/faces/face17.jpg', 58, 0, 0, 1, 0, 1, 0, 'Opis developera17', 4, 'English', 'https://www.linkedin.com/in/ivan-vaskovic-a9003222b/'),
(18, 'Ime Prezime18', 'mail18@mail.com', '+381600000018', 'Lokacija18', './images/faces/face18.jpg', 50, 0, 1, 0, 1, 1, 1, 'Opis developera18', 6, 'Bulgarian', 'https://www.linkedin.com/in/ivan-vaskovic-a9003222b/'),
(19, 'Ime Prezime19', 'mail19@mail.com', '+381600000019', 'Lokacija19', './images/faces/face19.jpg', 35, 1, 1, 0, 0, 1, 1, 'Opis developera19', 9, 'Serbian', 'https://www.linkedin.com/in/ivan-vaskovic-a9003222b/'),
(20, 'Ime Prezime20', 'mail20@mail.com', '+381600000020', 'Lokacija20', './images/faces/face20.jpg', 45, 1, 0, 1, 0, 1, 0, 'Opis developera20', 7, 'English', 'https://www.linkedin.com/in/ivan-vaskovic-a9003222b/'),
(21, 'Petar Petrovic', 'dev@dev', '+381641234567', 'Niš', './images/users-profile-pictures/dev@dev', 30, 1, 0, 1, 0, 1, 1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 3, 'English', 'https://www.linkedin.com/in/ivan-vaskovic-a9003222b/'),
(22, 'Ime Prezime21', 'mail21@mail.com', '+381600000021', 'Lokacija21', './images/faces/face11.jpg', 45, 1, 0, 0, 1, 1, 0, 'Opis developera21', 2, 'Serbian', 'https://www.linkedin.com/in/ivan-vaskovic-a9003222b/'),
(23, 'Ime Prezime22', 'mail22@mail.com', '+381600000022', 'Lokacija22', './images/faces/face16.jpg', 30, 0, 1, 0, 1, 1, 1, 'Opis developera22', 5, 'English', 'https://www.linkedin.com/in/ivan-vaskovic-a9003222b/'),
(24, 'Ivan Vaskovic', 'ivan.vaskovic@gmail.com', '+381601111111', 'Niš', 'images/users-profile-pictures/mail@mail.com.jpg', 40, 1, 1, 1, 0, 0, 1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua', 1, 'Serbian', 'https://www.linkedin.com/in/ivan-vaskovic-a9003222b/');

-- --------------------------------------------------------

--
-- Table structure for table `hired`
--

CREATE TABLE IF NOT EXISTS `hired` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dev_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_dev_id` (`dev_id`),
  KEY `FK_project_id` (`project_id`),
  KEY `FK_comp_id` (`company_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE IF NOT EXISTS `projects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_name` varchar(100) COLLATE utf16_unicode_ci NOT NULL,
  `company_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_company_id` (`company_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_ci;

--
-- Dumping data for table `projects`
--

INSERT IGNORE INTO `projects` (`id`, `project_name`, `company_id`, `start_date`, `end_date`) VALUES
(1, 'Project1', 1, '2022-01-31', '2022-03-15'),
(3, 'Project2', 3, '2022-02-20', '2022-03-25'),
(4, 'Project3', 5, '2022-02-12', '2022-03-09'),
(5, 'Project4', 6, '2022-02-26', '2022-04-01'),
(6, 'Project5', 2, '2022-02-18', '2022-03-13');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) COLLATE utf16_unicode_ci NOT NULL,
  `pass` text COLLATE utf16_unicode_ci NOT NULL,
  `user_type` varchar(50) COLLATE utf16_unicode_ci NOT NULL,
  `dev_id` int(11) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `dev_id` (`dev_id`),
  KEY `company_id` (`company_id`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT IGNORE INTO `users` (`id`, `email`, `pass`, `user_type`, `dev_id`, `company_id`) VALUES
(1, 'admin@admin', '$2y$10$YtQVWTVbJpg9xz60JA9oleJH7ks7RVUxyrQnl8G8RfISRSIaqOkcu', 'admin', NULL, NULL),
(6, 'dev@dev', '$2y$10$kgxtPaD9ZD.YCbTYw1Bs8unzIXsH9tlgZjqDiHLpkNhQbZO6zOZfu', 'dev', 21, NULL),
(47, 'company@company', '$2y$10$Fl3Zh0uU3O/UuCbmp2SEWeJYZOsydtk2b6m2eYe6K7SDIFrQ7DHFO', 'company', NULL, 7);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `hired`
--
ALTER TABLE `hired`
  ADD CONSTRAINT `FK_comp_id` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_dev_id` FOREIGN KEY (`dev_id`) REFERENCES `devs` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_project_id` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `FK_company_id` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`dev_id`) REFERENCES `devs` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
