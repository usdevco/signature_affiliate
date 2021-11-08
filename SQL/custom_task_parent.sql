/*
SQLyog Ultimate v13.1.1 (64 bit)
MySQL - 5.7.22-log : Database - avacrm_copy
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`avacrm_copy` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `avacrm_copy`;

/*Table structure for table `custom_task_parent` */

DROP TABLE IF EXISTS `custom_task_parent`;

CREATE TABLE `custom_task_parent` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `custom_task_id` int(11) DEFAULT NULL,
  `parent_task_id` int(11) DEFAULT NULL,
  `parent_task_value` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

/*Data for the table `custom_task_parent` */

insert  into `custom_task_parent`(`id`,`custom_task_id`,`parent_task_id`,`parent_task_value`) values 
(1,5,4,'yes'),
(2,6,5,NULL),
(3,10,9,'yes'),
(4,11,10,'yes'),
(5,13,8,'yes'),
(6,14,13,NULL),
(7,15,14,NULL),
(8,16,2,'Check'),
(9,17,2,'Ygrene'),
(10,19,18,NULL),
(11,20,22,NULL),
(12,21,18,NULL),
(13,22,1,'yes'),
(14,23,2,'Ygrene'),
(15,24,3,'yes'),
(16,25,24,NULL),
(17,26,25,NULL),
(18,27,26,NULL),
(19,28,27,NULL),
(20,29,7,'yes'),
(21,31,30,'yes'),
(22,32,1,NULL),
(23,32,2,NULL),
(24,32,6,NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
