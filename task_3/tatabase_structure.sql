-- --------------------------------------------------------
-- Host:                         testdb.c9pwet9rfj2i.eu-west-2.rds.amazonaws.com
-- Server version:               5.6.41 - Source distribution
-- Server OS:                    Linux
-- HeidiSQL Version:             9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for test
CREATE DATABASE IF NOT EXISTS `test` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `test`;

-- Dumping structure for table test.employees
CREATE TABLE IF NOT EXISTS `employees` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `birthdate` timestamp NOT NULL,
  `snn` varchar(32) NOT NULL,
  `current_employee` tinyint(1) NOT NULL DEFAULT '1',
  `email` varchar(32) NOT NULL,
  `phone` varchar(16) NOT NULL,
  `address` varchar(128) NOT NULL,
  `log_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `employees_fk0` (`log_id`),
  CONSTRAINT `employees_fk0` FOREIGN KEY (`log_id`) REFERENCES `logs` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table test.employees_info
CREATE TABLE IF NOT EXISTS `employees_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lang` varchar(2) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `introduction` text NOT NULL,
  `work_experience` text NOT NULL,
  `education` text NOT NULL,
  `log_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `employees_info_fk1` (`log_id`),
  KEY `employees_info_fk0` (`employee_id`),
  CONSTRAINT `employees_info_fk0` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`),
  CONSTRAINT `employees_info_fk1` FOREIGN KEY (`log_id`) REFERENCES `logs` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table test.logs
CREATE TABLE IF NOT EXISTS `logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `entity` varchar(64) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `logs_fk0` (`user_id`),
  CONSTRAINT `logs_fk0` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table test.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(32) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
