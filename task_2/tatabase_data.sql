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

-- Dumping data for table test.employees: ~1 rows (approximately)
/*!40000 ALTER TABLE `employees` DISABLE KEYS */;
INSERT INTO `employees` (`id`, `name`, `birthdate`, `snn`, `current_employee`, `email`, `phone`, `address`, `log_id`) VALUES
	(1, 'Bohdan Petryshyn', '1987-04-30 00:00:00', '111-11-1111', 0, 'emaeglin@gmail.com', '+380989344677', 'Some street in Kiev', 1);
/*!40000 ALTER TABLE `employees` ENABLE KEYS */;

-- Dumping data for table test.employees_info: ~3 rows (approximately)
/*!40000 ALTER TABLE `employees_info` DISABLE KEYS */;
INSERT INTO `employees_info` (`id`, `lang`, `employee_id`, `introduction`, `work_experience`, `education`, `log_id`) VALUES
	(1, 'en', 1, '', '', '', 2),
	(8, 'es', 1, 'entroducción', 'experiencia laboral', 'educación', 3),
	(9, 'fr', 1, 'éducationón', 'lexpérience professionnelle', 'éducation', 4);
/*!40000 ALTER TABLE `employees_info` ENABLE KEYS */;

-- Dumping data for table test.logs: ~4 rows (approximately)
/*!40000 ALTER TABLE `logs` DISABLE KEYS */;
INSERT INTO `logs` (`id`, `user_id`, `created`, `updated`, `entity`) VALUES
	(1, 1, '2018-11-13 14:22:34', '2018-11-13 14:22:34', 'employees'),
	(2, 1, '2018-11-13 14:26:52', '2018-11-13 14:26:52', 'employees_info'),
	(3, 1, '2018-11-13 14:27:42', '2018-11-13 14:27:42', 'employees_info'),
	(4, 1, '2018-11-13 14:37:47', '2018-11-13 14:37:47', 'employees_info');
/*!40000 ALTER TABLE `logs` ENABLE KEYS */;

-- Dumping data for table test.users: ~2 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `username`) VALUES
	(1, 'admin'),
	(2, 'testuser');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
