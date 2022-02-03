/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- smarthome 데이터베이스 구조 내보내기
CREATE DATABASE IF NOT EXISTS `smarthome` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `smarthome`;

-- 테이블 smarthome.control_info 구조 내보내기
CREATE TABLE IF NOT EXISTS `control_info` (
  `id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `control_info` varchar(50) DEFAULT NULL,
  `control_time` varchar(50) DEFAULT NULL,
  KEY `PRIMARY KEY` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8;

-- 내보낼 데이터가 선택되어 있지 않습니다.

-- 테이블 smarthome.occupancy_info 구조 내보내기
CREATE TABLE IF NOT EXISTS `occupancy_info` (
  `id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `user` varchar(50) NOT NULL DEFAULT '',
  `occupancy` varchar(255) NOT NULL DEFAULT '',
  `in_time` varchar(50) DEFAULT NULL,
  `out_time` varchar(50) DEFAULT NULL,
  `real_in_time` varchar(50) DEFAULT NULL,
  `real_out_time` varchar(50) DEFAULT NULL,
  `occupancy2` varchar(50) DEFAULT NULL,
  `out_time2` varchar(50) DEFAULT NULL,
  `occupancy3` varchar(50) DEFAULT NULL,
  KEY `PRIMARY KEY` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- 내보낼 데이터가 선택되어 있지 않습니다.

-- 테이블 smarthome.occupancy_log 구조 내보내기
CREATE TABLE IF NOT EXISTS `occupancy_log` (
  `id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `device_name` varchar(50) DEFAULT NULL,
  `state` varchar(50) DEFAULT NULL,
  `time` varchar(50) DEFAULT NULL,
  `state_time` varchar(50) DEFAULT NULL,
  KEY `PRIMARY KEY` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1525 DEFAULT CHARSET=utf8;

-- 내보낼 데이터가 선택되어 있지 않습니다.

-- 테이블 smarthome.system_log 구조 내보내기
CREATE TABLE IF NOT EXISTS `system_log` (
  `id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `system_info` varchar(50) DEFAULT NULL,
  `log_time` varchar(50) DEFAULT NULL,
  `message` varchar(255) DEFAULT NULL,
  KEY `PRIMARY_KEY` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=572627 DEFAULT CHARSET=utf8;

-- 내보낼 데이터가 선택되어 있지 않습니다.

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
