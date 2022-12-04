-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.28 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.0.0.6468
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table guppy.item
CREATE TABLE IF NOT EXISTS `item` (
  `id` int NOT NULL AUTO_INCREMENT,
  `store_id` int NOT NULL DEFAULT '0',
  `name` varchar(150) COLLATE latin1_general_ci NOT NULL,
  `sku` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `bp` int NOT NULL DEFAULT '0',
  `sp` int NOT NULL DEFAULT '0',
  `stock` int NOT NULL DEFAULT '0',
  `created_by` int DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `modified_by` int DEFAULT NULL,
  `modified_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `store_id_sku` (`store_id`,`sku`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- Dumping data for table guppy.item: ~3 rows (approximately)
INSERT INTO `item` (`id`, `store_id`, `name`, `sku`, `bp`, `sp`, `stock`, `created_by`, `created_at`, `modified_by`, `modified_at`, `deleted_at`) VALUES
	(1, 2, 'Ikan Platy Size S', 'PM-S', 0, 1000, 5, 2, '2022-12-04 07:11:42', NULL, NULL, NULL),
	(2, 2, 'Ikan Platy Size M', 'PM-M', 0, 2000, -100, 2, '2022-12-04 07:12:21', NULL, NULL, NULL),
	(3, 2, 'Ikan Platy Size L', 'PM-L', 0, 5000, -10, 2, '2022-12-04 07:12:45', NULL, NULL, NULL),
	(4, 2, 'Molly Balon S', 'MB-S', 0, 1000, -100, 2, '2022-12-04 15:10:10', NULL, NULL, NULL),
	(5, 3, 'Kerudung Bayi', 'KB', 120000, 150000, -16, 4, '2022-12-04 17:41:48', NULL, NULL, NULL),
	(6, 3, 'Popok Bayi', 'PB', 30000, 50000, -1, 4, '2022-12-04 17:49:48', NULL, NULL, NULL);

-- Dumping structure for table guppy.sell
CREATE TABLE IF NOT EXISTS `sell` (
  `id` int NOT NULL AUTO_INCREMENT,
  `store_id` int NOT NULL DEFAULT '0',
  `date` date DEFAULT NULL,
  `remark` text CHARACTER SET latin1 COLLATE latin1_general_ci,
  `created_by` int DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `modified_by` int DEFAULT NULL,
  `modified_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table guppy.sell: ~0 rows (approximately)
INSERT INTO `sell` (`id`, `store_id`, `date`, `remark`, `created_by`, `created_at`, `modified_by`, `modified_at`, `deleted_at`) VALUES
	(1, 2, '2022-12-04', 'ket', 2, '2022-12-04 14:35:15', 2, '2022-12-04 15:00:44', '2022-12-04 15:00:50'),
	(2, 2, '2022-12-04', 'ket 2', 2, '2022-12-04 14:39:21', 2, '2022-12-04 15:01:29', '2022-12-04 15:01:35'),
	(3, 2, '2022-12-04', '', 2, '2022-12-04 15:02:19', 2, NULL, '2022-12-04 15:02:27'),
	(4, 2, '2022-12-04', '', 2, '2022-12-04 15:02:52', 2, '2022-12-04 15:03:13', '2022-12-04 15:03:27'),
	(5, 2, '2022-12-04', '', 2, '2022-12-04 15:10:37', NULL, NULL, NULL),
	(6, 3, '2022-12-04', 'Car free day', 4, '2022-12-04 17:42:45', NULL, NULL, NULL),
	(7, 3, '2022-12-04', 'belanja', 4, '2022-12-04 17:50:18', NULL, NULL, NULL);

-- Dumping structure for table guppy.sell_d
CREATE TABLE IF NOT EXISTS `sell_d` (
  `id` int NOT NULL AUTO_INCREMENT,
  `sell_id` int NOT NULL DEFAULT '0',
  `item_id` int DEFAULT NULL,
  `amount` int DEFAULT NULL,
  `qty` int DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `modified_by` int DEFAULT NULL,
  `modified_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table guppy.sell_d: ~0 rows (approximately)
INSERT INTO `sell_d` (`id`, `sell_id`, `item_id`, `amount`, `qty`, `created_by`, `created_at`, `modified_by`, `modified_at`, `deleted_at`) VALUES
	(22, 5, 4, 1000, 100, NULL, NULL, NULL, NULL, NULL),
	(23, 5, 2, 2000, 100, NULL, NULL, NULL, NULL, NULL),
	(24, 6, 5, 150000, 15, NULL, NULL, NULL, NULL, NULL),
	(25, 7, 6, 50000, 1, NULL, NULL, NULL, NULL, NULL),
	(26, 7, 5, 150000, 1, NULL, NULL, NULL, NULL, NULL);

-- Dumping structure for table guppy.store
CREATE TABLE IF NOT EXISTS `store` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `created_by` int DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `modified_by` int DEFAULT NULL,
  `modified_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table guppy.store: ~2 rows (approximately)
INSERT INTO `store` (`id`, `name`, `created_by`, `created_at`, `modified_by`, `modified_at`, `deleted_at`) VALUES
	(1, 'Adam Farm', NULL, NULL, NULL, NULL, NULL),
	(2, 'Adam Prasetia Livebearer Farm', 2, '2022-12-03 09:19:21', 2, '2022-12-04 07:31:46', NULL),
	(3, 'Phezara', 4, '2022-12-04 17:40:47', NULL, NULL, NULL);

-- Dumping structure for table guppy.trans
CREATE TABLE IF NOT EXISTS `trans` (
  `id` int NOT NULL AUTO_INCREMENT,
  `store_id` int NOT NULL DEFAULT '0',
  `type` enum('IN','OUT') COLLATE latin1_general_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `value` int DEFAULT NULL,
  `remark` text COLLATE latin1_general_ci,
  `created_by` int DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `modified_by` int DEFAULT NULL,
  `modified_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- Dumping data for table guppy.trans: ~0 rows (approximately)
INSERT INTO `trans` (`id`, `store_id`, `type`, `date`, `value`, `remark`, `created_by`, `created_at`, `modified_by`, `modified_at`, `deleted_at`) VALUES
	(1, 2, NULL, '0000-00-00', 0, NULL, NULL, NULL, 2, NULL, '2022-12-04 10:28:44'),
	(2, 2, NULL, '0000-00-00', 0, NULL, NULL, NULL, 2, NULL, '2022-12-04 10:28:48'),
	(3, 2, NULL, '0000-00-00', 0, NULL, NULL, NULL, 2, NULL, '2022-12-04 10:28:52'),
	(4, 2, 'IN', '2022-12-04', 5000, NULL, 2, '2022-12-04 10:31:15', NULL, NULL, NULL),
	(5, 2, 'OUT', '2022-12-04', 5000, 'baso tahu', 2, '2022-12-04 17:33:53', NULL, NULL, NULL),
	(6, 2, 'OUT', '2022-12-04', 5000, 'jajan baslub', 2, '2022-12-04 17:34:15', NULL, NULL, NULL),
	(7, 2, 'IN', '2022-12-04', 50000, 'saldo awal', 2, '2022-12-04 17:35:20', NULL, NULL, NULL),
	(8, 3, 'OUT', '2022-12-04', 1500000, 'Service Mobil', 4, '2022-12-04 18:29:20', NULL, NULL, NULL),
	(9, 3, 'OUT', '2022-12-04', 4000000, 'gaji karyawan', 4, '2022-12-04 18:35:23', NULL, NULL, NULL),
	(10, 3, 'IN', '2022-12-04', 700000, 'investor', 4, '2022-12-04 18:47:53', NULL, NULL, NULL);

-- Dumping structure for table guppy.user
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `fullname` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `email` varchar(255) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `password` varchar(255) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `phone` varchar(50) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `created_by` int DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `modified_by` int DEFAULT NULL,
  `modified_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `phone` (`phone`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- Dumping data for table guppy.user: ~1 rows (approximately)
INSERT INTO `user` (`id`, `fullname`, `email`, `password`, `phone`, `created_by`, `created_at`, `modified_by`, `modified_at`, `deleted_at`) VALUES
	(2, 'Adam Prasetia', 'adam.prasetia@gmail.com', '$2y$10$o0VnaDPDcWYADNlkJ3xcEuApsoQUc/Vxdz9xaQlUMGlksDGirecHy', '083817321885', NULL, '2022-12-03 09:19:21', NULL, NULL, NULL),
	(4, 'Ulfah Awaliah', 'phezara@gmail.com', '$2y$10$yARpgbzCsIj5WB4uEnzXYu2ecT.DFb7HkwErkcHmFvRbXQGRiFsb2', '083817321712', NULL, '2022-12-04 17:40:47', NULL, NULL, NULL);

-- Dumping structure for table guppy.user_store
CREATE TABLE IF NOT EXISTS `user_store` (
  `user_id` int NOT NULL,
  `store_id` int NOT NULL,
  PRIMARY KEY (`user_id`,`store_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- Dumping data for table guppy.user_store: ~2 rows (approximately)
INSERT INTO `user_store` (`user_id`, `store_id`) VALUES
	(1, 1),
	(2, 2),
	(4, 3);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
