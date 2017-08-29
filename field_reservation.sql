/*
SQLyog Ultimate v12.09 (64 bit)
MySQL - 10.1.21-MariaDB : Database - field_reservation
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`field_reservation` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `field_reservation`;

/*Table structure for table `branches` */

DROP TABLE IF EXISTS `branches`;

CREATE TABLE `branches` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `location` text NOT NULL,
  `phone` text NOT NULL,
  `contact_person` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Data for the table `branches` */

insert  into `branches`(`id`,`name`,`address`,`location`,`phone`,`contact_person`) values (2,'Makati','test','sadasdasd','1111','John'),(7,'Taguig','Taguig','','56623','john Doe');

/*Table structure for table `customers` */

DROP TABLE IF EXISTS `customers`;

CREATE TABLE `customers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `passport_id` varchar(50) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `activation` varchar(255) DEFAULT NULL,
  `token` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `customers` */

insert  into `customers`(`id`,`name`,`email`,`phone`,`passport_id`,`username`,`password`,`activation`,`token`,`created_at`,`updated_at`) values (1,'test','johnenricocomia@yahoo.com','3213123213','123','21321312321','WVhOa1lYTms=',NULL,'','2017-08-28 17:14:29','2017-08-28 18:25:23');

/*Table structure for table `fields` */

DROP TABLE IF EXISTS `fields`;

CREATE TABLE `fields` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

/*Data for the table `fields` */

insert  into `fields`(`id`,`name`,`branch_id`,`status`) values (4,'C1',2,1),(5,'C2',2,1),(6,'C3',2,1),(7,'C1',7,1),(8,'C2',7,1),(9,'C3',7,1);

/*Table structure for table `module` */

DROP TABLE IF EXISTS `module`;

CREATE TABLE `module` (
  `modid` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT '0',
  `mod_name` varchar(255) DEFAULT NULL,
  `mod_alias` varchar(255) DEFAULT NULL,
  `icon` varchar(50) DEFAULT NULL,
  `permalink` varchar(255) DEFAULT NULL,
  `mod_order` int(11) DEFAULT '0',
  `published` enum('y','n') DEFAULT 'y',
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`modid`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `module` */

insert  into `module`(`modid`,`parent_id`,`mod_name`,`mod_alias`,`icon`,`permalink`,`mod_order`,`published`,`created`) values (1,0,'Branches','branch','ion-levels','branch',6,'y',NULL),(2,0,'Users','users','ion-ios7-people','users',5,'y',NULL),(3,0,'User Group','user_group','ion-ios7-locked','usergroup',7,'y',NULL),(4,0,'Time Slots','time_slot','ion-clock','time_slot',3,'y',NULL),(5,0,'Reports','reports','ion-pie-graph','reports',4,'y',NULL),(6,0,'Customers','customers','ion-android-social','customers',2,'y',NULL),(7,0,'Fields','fields','ion-ios7-football','fields',3,'y',NULL),(8,0,'Reservation','reservation','ion-clipboard','reservation',1,'y',NULL);

/*Table structure for table `reservation` */

DROP TABLE IF EXISTS `reservation`;

CREATE TABLE `reservation` (
  `id` int(11) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `field_id` int(11) NOT NULL,
  `time_slot` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `date_reserved` date NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

/*Data for the table `reservation` */

insert  into `reservation`(`id`,`field_id`,`time_slot`,`customer_id`,`status`,`date_reserved`,`updated_at`) values (00000000005,6,4,1,0,'0000-00-00','2017-08-28 22:02:53'),(00000000006,4,5,1,0,'2017-08-02','2017-08-28 22:04:27'),(00000000007,4,6,1,0,'2017-08-02','2017-08-28 22:05:11'),(00000000008,4,7,1,0,'2017-08-02','2017-08-28 22:05:28'),(00000000009,4,8,1,0,'2017-08-02','2017-08-28 22:05:44'),(00000000011,5,4,1,0,'2017-08-02','2017-08-28 22:09:19'),(00000000012,5,5,1,0,'2017-08-02','2017-08-28 22:09:51'),(00000000013,5,6,1,0,'2017-08-02','2017-08-28 22:10:30'),(00000000014,5,7,1,0,'2017-08-02','2017-08-28 22:11:24'),(00000000015,5,8,1,0,'2017-08-02','2017-08-28 22:11:50'),(00000000017,6,4,1,0,'2017-08-02','2017-08-28 22:15:19'),(00000000018,6,5,1,0,'2017-08-02','2017-08-28 22:21:34'),(00000000019,6,6,1,0,'2017-08-02','2017-08-28 22:22:24'),(00000000022,6,7,1,0,'2017-08-02','2017-08-29 10:43:06');

/*Table structure for table `settings` */

DROP TABLE IF EXISTS `settings`;

CREATE TABLE `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `data` text,
  `uid` int(11) DEFAULT NULL,
  `created_at` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `settings` */

insert  into `settings`(`id`,`name`,`data`,`uid`,`created_at`) values (1,'filetype','jpeg,docs,docx,png,jpg,pdf',1,NULL);

/*Table structure for table `time_slots` */

DROP TABLE IF EXISTS `time_slots`;

CREATE TABLE `time_slots` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `start` time NOT NULL,
  `end` time NOT NULL,
  `amount` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Data for the table `time_slots` */

insert  into `time_slots`(`id`,`start`,`end`,`amount`) values (3,'06:00:00','07:00:00',500),(4,'07:00:00','08:00:00',100),(5,'08:00:00','09:00:00',1000),(6,'09:00:00','10:00:00',500),(7,'10:00:00','11:00:00',100),(8,'12:00:00','13:00:00',100);

/*Table structure for table `user_group` */

DROP TABLE IF EXISTS `user_group`;

CREATE TABLE `user_group` (
  `guid` int(11) NOT NULL AUTO_INCREMENT,
  `gname` varchar(255) DEFAULT NULL,
  `role` text,
  PRIMARY KEY (`guid`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `user_group` */

insert  into `user_group`(`guid`,`gname`,`role`) values (1,'Super Admin','{\"view\":\"8,6,4,7,2,1,3\",\"create\":\"8,6,4,7,2,1,3\",\"alter\":\"8,6,4,7,2,1,3\",\"drop\":\"8,6,4,7,2,1,3\"}'),(2,'Evaluator','{\"view\":\"1\",\"create\":\"\",\"alter\":\"\",\"drop\":\"\"}');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `guid` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `remember_token` text,
  `token` text NOT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `created_at` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `guid` (`guid`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

/*Data for the table `users` */

insert  into `users`(`id`,`username`,`password`,`guid`,`name`,`email`,`phone`,`remember_token`,`token`,`branch_id`,`created_at`) values (1,'supersu','YzNWd1pYSnpkVEV5TXpRPQ==',1,'John Michael Doe','cuevas.badillio@evalapp.com','','TVRBMU9HSXdaVGd5TWpkbE1qWXg=','',NULL,'');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
