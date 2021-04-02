/*
SQLyog Community v13.1.5  (32 bit)
MySQL - 10.4.13-MariaDB : Database - timer
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `timer` */

DROP TABLE IF EXISTS `timer`;

CREATE TABLE `timer` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `first_datetime` timestamp NULL DEFAULT NULL,
  `second_datetime` timestamp NULL DEFAULT NULL,
  `type` int(2) NOT NULL,
  `reg_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8;

/*Data for the table `timer` */

insert  into `timer`(`id`,`first_datetime`,`second_datetime`,`type`,`reg_date`) values 
(38,'2021-02-05 12:29:17','2021-02-05 12:29:20',1,'2021-02-06 00:28:23'),
(39,'2021-02-05 12:29:34','2021-02-05 12:30:35',2,'2021-02-06 00:28:40'),
(40,'2021-02-05 12:30:52','2021-02-05 12:30:57',1,'2021-02-06 00:29:01');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
