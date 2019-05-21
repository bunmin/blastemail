-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.1.34-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win32
-- HeidiSQL Version:             10.1.0.5464
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for blast_email
CREATE DATABASE IF NOT EXISTS `blast_email` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `blast_email`;

-- Dumping structure for table blast_email.email_group
CREATE TABLE IF NOT EXISTS `email_group` (
  `uuid` char(50) DEFAULT NULL,
  `group_name` varchar(500) NOT NULL,
  `created_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  UNIQUE KEY `group_name` (`group_name`),
  UNIQUE KEY `uuid` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table blast_email.email_group: ~0 rows (approximately)
/*!40000 ALTER TABLE `email_group` DISABLE KEYS */;
/*!40000 ALTER TABLE `email_group` ENABLE KEYS */;

-- Dumping structure for table blast_email.email_group_detail
CREATE TABLE IF NOT EXISTS `email_group_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uuid_email_group` char(36) NOT NULL,
  `email` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table blast_email.email_group_detail: ~0 rows (approximately)
/*!40000 ALTER TABLE `email_group_detail` DISABLE KEYS */;
/*!40000 ALTER TABLE `email_group_detail` ENABLE KEYS */;

-- Dumping structure for table blast_email.email_log
CREATE TABLE IF NOT EXISTS `email_log` (
  `uuid` char(36) DEFAULT NULL,
  `receiver` varchar(100) DEFAULT NULL,
  `cc` varchar(1000) DEFAULT NULL,
  `bcc` varchar(1000) DEFAULT NULL,
  `subject` varchar(1000) DEFAULT NULL,
  `message` longtext,
  `status` varchar(500) DEFAULT NULL,
  `send_dt` datetime DEFAULT CURRENT_TIMESTAMP,
  `read_dt` datetime DEFAULT NULL,
  UNIQUE KEY `uuid` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table blast_email.email_log: ~0 rows (approximately)
/*!40000 ALTER TABLE `email_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `email_log` ENABLE KEYS */;

-- Dumping structure for table blast_email.user
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table blast_email.user: ~0 rows (approximately)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id_user`, `nama`, `username`, `password`) VALUES
	(1, 'Administrator', 'admin', '21232f297a57a5a743894a0e4a801fc3');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

-- Dumping structure for trigger blast_email.before_insert_email_log
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `before_insert_email_log` BEFORE INSERT ON `email_log` FOR EACH ROW BEGIN
  IF new.uuid IS NULL THEN
    SET new.uuid = uuid();
  END IF;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
