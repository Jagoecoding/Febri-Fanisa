-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for jagocoding
CREATE DATABASE IF NOT EXISTS `jagocoding` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `jagocoding`;

-- Dumping structure for table jagocoding.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `phone` varchar(15) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `bio` text COLLATE utf8mb4_general_ci,
  `profile_picture` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `photo_path` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `registered_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `unique_email` (`email`),
  UNIQUE KEY `unique_username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table jagocoding.users: ~9 rows (approximately)
INSERT INTO `users` (`id`, `username`, `email`, `password`, `name`, `phone`, `bio`, `profile_picture`, `created_at`, `photo_path`, `registered_at`) VALUES
	(2, 'tyas', 'tyas@gmail.com', '$2y$10$kQgwb6ObiLNuJRKYaaOVe.i7pSeyamzs2WVFWzXkbIEzln82jaLHC', NULL, NULL, NULL, NULL, '2024-11-17 09:38:05', '', '2024-11-17 21:30:26'),
	(3, 'Rizki Ananda', 'Risskananda90@gmail.com', '$2y$10$wDxijMJ9PU.FmFMj45gZmetDxIzt..RZBgxVsksibWPmdp2uRHzwe', 'Riskiananda', '083188186757', 'Semangat belajar', NULL, '2024-11-17 09:38:05', '', '2024-11-17 21:30:26'),
	(7, 'fikaa', 'fikaa21@gmail.com', '$2y$10$Jska3NS7IcsYhl/Nfvng/.UlXIzRHVI.JY6kLQdThHnNRDXz3jYKG', 'afiqahh', '082260116061', '', NULL, '2024-11-17 09:38:05', '', '2024-11-17 21:30:26'),
	(8, 'nanang', 'nanang@gmail.com', '$2y$10$.3J3cLKWzbPArjArKPgvg.kR4QHnZ2Aut7ZKTkRqxekItIJ7sQZZ2', NULL, NULL, NULL, NULL, '2024-11-17 09:38:05', '', '2024-11-17 21:30:26'),
	(9, 'Bila', 'bila@gmail.com', '$2y$10$Ab.46.26DYm22n.jUvvgquIIt1MTphhw8vU..rmtYRYBl0FFCN816', NULL, NULL, NULL, NULL, '2024-11-17 09:38:05', '', '2024-11-17 21:30:26'),
	(10, 'mulyani_', 'mumul@gmail.com', '$2y$10$sAUn/Wwt9ayWmHVAzkdVve39pZLmjAESidJhuys.JhOuamPMW.2D2', 'mumulyani', '083188186758', 'sukses', NULL, '2024-11-17 09:38:05', '', '2024-11-17 21:30:26'),
	(11, 'intan_kusmayanti', 'intan@gmail.com', '$2y$10$Pd4t0yxherzecILa2f4dxuvRLJg4rHQbJOFNoeSTvqkG1mt36YJda', NULL, NULL, NULL, NULL, '2024-11-17 09:38:05', '', '2024-11-17 21:30:26'),
	(12, 'febrifanisa_', 'fanisafebri02@gmail.com', '$2y$10$vHVsFTzRdvcB8fibRp5NE.sNTDbA205bGTepSUgJatmPtSBSICj.2', NULL, NULL, NULL, NULL, '2024-11-17 09:38:05', '', '2024-11-17 21:30:26'),
	(13, 'farhan', 'farhanpratamaa01@gmail.com', '$2y$10$bh5DjquiPv..8Vqs8Cfdv.PM96cn7mkGWwWOQGz7NROImfOYsYTDC', 'farhan_pratama', '083188186758', 'bismillah', 'uploads/6739ce9456e66_Screenshot 2024-11-12 100337.png', '2024-11-17 11:05:29', '', '2024-11-17 21:30:26'),
	(14, 'andrian', 'andrian@gmail.com', '$2y$10$XBjtAiCKW.H.KLbl9nS7eOuJjGZ7uVgNu7sLQZS3aS1/B5frS1W.u', 'andrian fakhruza', '083188186758', 'sukses', 'uploads/673fd50e703c4_Screenshot 2024-11-12 091555.png', '2024-11-22 00:43:17', NULL, '2024-11-22 07:43:17');

-- Dumping structure for table jagocoding.user_settings
CREATE TABLE IF NOT EXISTS `user_settings` (
  `user_id` int NOT NULL,
  `challenge_update` tinyint(1) DEFAULT '0',
  `complete_level` tinyint(1) DEFAULT '0',
  `new_milestone` tinyint(1) DEFAULT '0',
  `programming_tip` tinyint(1) DEFAULT '0',
  `profile_update` tinyint(1) DEFAULT '0',
  `face_recognition_enabled` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`user_id`),
  CONSTRAINT `user_settings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table jagocoding.user_settings: ~2 rows (approximately)
INSERT INTO `user_settings` (`user_id`, `challenge_update`, `complete_level`, `new_milestone`, `programming_tip`, `profile_update`, `face_recognition_enabled`) VALUES
	(12, 1, 1, 0, 0, 0, 0),
	(13, 1, 0, 0, 1, 1, 0),
	(14, 1, 0, 0, 1, 0, 0);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
