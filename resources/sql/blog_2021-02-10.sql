# ************************************************************
# Sequel Pro SQL dump
# Version 5446
#
# https://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.7.31)
# Database: blog
# Generation Time: 2021-02-10 01:57:51 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
SET NAMES utf8mb4;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table access_message
# ------------------------------------------------------------

DROP TABLE IF EXISTS `access_message`;

CREATE TABLE `access_message` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `username` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `article_id` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Imgsrc` mediumtext COLLATE utf8mb4_unicode_ci,
  `value` varchar(256) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `access_message` WRITE;
/*!40000 ALTER TABLE `access_message` DISABLE KEYS */;

INSERT INTO `access_message` (`id`, `username`, `name`, `article_id`, `Imgsrc`, `value`, `date`)
VALUES
	(1,'文蛇','杨文蛇','1','https://t7.baidu.com/it/u=2582370511,530426427&fm=193&f=GIF','2323','2021-01-12'),
	(2,'园园','王园园','2','https://t7.baidu.com/it/u=2582370511,530426427&fm=193&f=GIF','2222','2021-11-12');

/*!40000 ALTER TABLE `access_message` ENABLE KEYS */;
UNLOCK TABLES;

DELIMITER ;;
/*!50003 SET SESSION SQL_MODE="NO_AUTO_VALUE_ON_ZERO" */;;
/*!50003 CREATE */ /*!50017 DEFINER=`root`@`%` */ /*!50003 TRIGGER `delete_reply_message` AFTER DELETE ON `access_message` FOR EACH ROW BEGIN
delete from detail_reply where reply_username=old.username and reply_date = old.date; -- old表示tab1表中刚被删除的记录
END */;;
DELIMITER ;
/*!50003 SET SESSION SQL_MODE=@OLD_SQL_MODE */;


# Dump of table admin
# ------------------------------------------------------------

DROP TABLE IF EXISTS `admin`;

CREATE TABLE `admin` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `username` varchar(16) NOT NULL,
  `password` varchar(255) NOT NULL DEFAULT '',
  `email` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;

INSERT INTO `admin` (`id`, `username`, `password`, `email`)
VALUES
	(1,'六十','$2y$10$khe2dOfJKM.pT.szo3u7FeqGVE5UF6WR4pk1J7dtoYkeqGm4ilogK','aa1111'),
	(3,'六十','$2y$10$0TgKqdn/z3QtLzpgEISCMegYkPRXaSSdVFthbiDBk99PITgNjdv9W','aa1111');

/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table article
# ------------------------------------------------------------

DROP TABLE IF EXISTS `article`;

CREATE TABLE `article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `article_category` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `article_brief` text COLLATE utf8mb4_unicode_ci,
  `article_img` text COLLATE utf8mb4_unicode_ci,
  `accessPulish_count` bigint(20) DEFAULT '0',
  `visited` bigint(20) NOT NULL DEFAULT '0',
  `like_Star` bigint(20) NOT NULL DEFAULT '0',
  `label` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `time` date DEFAULT NULL,
  `article_id` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `article` WRITE;
/*!40000 ALTER TABLE `article` DISABLE KEYS */;

INSERT INTO `article` (`id`, `article_category`, `article_brief`, `article_img`, `accessPulish_count`, `visited`, `like_Star`, `label`, `content`, `title`, `time`, `article_id`)
VALUES
	(3,NULL,'我是简介','http://www.blog-api.com/storage/uploads/2021-02-07/601f8ed00fc09.jpg',0,0,0,'我是标签','我是内容','我是标题',NULL,''),
	(4,NULL,'我是简介','http://www.blog-api.com/storage/uploads/2021-02-07/601f8ed00fc09.jpg',0,0,0,'我是标签','我是内容','我是标题',NULL,''),
	(5,NULL,'简介1',NULL,0,0,0,'标签1','内容1','标题1',NULL,'');

/*!40000 ALTER TABLE `article` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table demos
# ------------------------------------------------------------

DROP TABLE IF EXISTS `demos`;

CREATE TABLE `demos` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `video_path` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `video_pic` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `datetime` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code_path` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table detail_reply
# ------------------------------------------------------------

DROP TABLE IF EXISTS `detail_reply`;

CREATE TABLE `detail_reply` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `reply_username` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reply_date` timestamp NULL DEFAULT NULL,
  `article_type` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_imgsrc` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `datetime` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `reply_name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table leave_message
# ------------------------------------------------------------

DROP TABLE IF EXISTS `leave_message`;

CREATE TABLE `leave_message` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Imgsrc` mediumtext COLLATE utf8mb4_unicode_ci,
  `value` varchar(256) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  KEY `index` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `leave_message` WRITE;
/*!40000 ALTER TABLE `leave_message` DISABLE KEYS */;

INSERT INTO `leave_message` (`id`, `username`, `name`, `Imgsrc`, `value`, `date`)
VALUES
	(1,'游客','游客','','你好啊','2021-01-13'),
	(2,'游客','游客','','反反复复','2021-01-13'),
	(3,'游客','游客','','我是袁哥','2021-01-13'),
	(4,'游客','游客','','我是超哥','2021-01-13'),
	(5,'游客','游客','https://ss0.bdstatic.com/70cFvHSh_Q1YnxGkpoWK1HF6hhy/it/u=3582194852,1481557220&fm=26&gp=0.jpg','你好','2021-01-13'),
	(6,'游客','游客','https://ss0.bdstatic.com/70cFvHSh_Q1YnxGkpoWK1HF6hhy/it/u=2871119264,233376496&fm=26&gp=0.jpg','飞飞飞飞飞','2021-01-13'),
	(7,'游客','游客','https://ss1.bdstatic.com/70cFuXSh_Q1YnxGkpoWK1HF6hhy/it/u=2271550032,3475765659&fm=26&gp=0.jpg','飞飞飞飞飞33','2021-01-13'),
	(8,'游客','游客','https://ss0.bdstatic.com/70cFvHSh_Q1YnxGkpoWK1HF6hhy/it/u=251289958,1860898046&fm=26&gp=0.jpg','服务范围','2021-01-15'),
	(9,'匿名','匿名','https://ss1.bdstatic.com/70cFvXSh_Q1YnxGkpoWK1HF6hhy/it/u=2715272079,1912335992&fm=11&gp=0.jpg','服务分期','2021-01-15'),
	(10,'匿名','匿名','https://ss3.bdstatic.com/70cFv8Sh_Q1YnxGkpoWK1HF6hhy/it/u=1427449583,2042113504&fm=26&gp=0.jpg','你好','2021-02-08');

/*!40000 ALTER TABLE `leave_message` ENABLE KEYS */;
UNLOCK TABLES;

DELIMITER ;;
/*!50003 SET SESSION SQL_MODE="NO_AUTO_VALUE_ON_ZERO" */;;
/*!50003 CREATE */ /*!50017 DEFINER=`root`@`%` */ /*!50003 TRIGGER `delete_leavemessage_reply` AFTER DELETE ON `leave_message` FOR EACH ROW BEGIN
delete from leaveM_reply where reply_username=old.username and reply_date=old.date;
END */;;
DELIMITER ;
/*!50003 SET SESSION SQL_MODE=@OLD_SQL_MODE */;


# Dump of table leavem_reply
# ------------------------------------------------------------

DROP TABLE IF EXISTS `leavem_reply`;

CREATE TABLE `leavem_reply` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `reply_username` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reply_date` timestamp NULL DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_imgsrc` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `datetime` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `reply_name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table music
# ------------------------------------------------------------

DROP TABLE IF EXISTS `music`;

CREATE TABLE `music` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `music_id` bigint(20) NOT NULL,
  PRIMARY KEY (`music_id`),
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `music` WRITE;
/*!40000 ALTER TABLE `music` DISABLE KEYS */;

INSERT INTO `music` (`id`, `music_id`)
VALUES
	(1,2);

/*!40000 ALTER TABLE `music` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table talk
# ------------------------------------------------------------

DROP TABLE IF EXISTS `talk`;

CREATE TABLE `talk` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `imgsrc` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `datetime` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `talk` WRITE;
/*!40000 ALTER TABLE `talk` DISABLE KEYS */;

INSERT INTO `talk` (`id`, `content`, `imgsrc`, `datetime`)
VALUES
	(1,NULL,'http://www.blog-api.com/storage/uploads/2021-02-07/601f8ed00fc09.jpg',NULL);

/*!40000 ALTER TABLE `talk` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table user
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `name` varchar(10) DEFAULT NULL,
  `username` varchar(11) NOT NULL,
  `password` varchar(16) NOT NULL,
  `email` text NOT NULL,
  `info` varchar(255) NOT NULL DEFAULT '这里还是空的，写一些你的介绍吧~',
  `uploadimg` varchar(100) NOT NULL DEFAULT 'http://codelei.cn/api/images/4ccfce737d0177a4e60a4341c5c6d399.jpg',
  `registerTime` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
