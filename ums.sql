/*
SQLyog Community Edition- MySQL GUI v6.16
MySQL - 5.1.45-community : Database - ums
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

create database if not exists `ums`;

USE `ums`;

/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

/*Table structure for table `accesslog` */

DROP TABLE IF EXISTS `accesslog`;

CREATE TABLE `accesslog` (
  `name` varchar(50) DEFAULT NULL,
  `action` varchar(50) DEFAULT NULL,
  `date` varchar(50) DEFAULT NULL,
  `ip` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `accesslog` */

/*Table structure for table `defect` */

DROP TABLE IF EXISTS `defect`;

CREATE TABLE `defect` (
  `id` varchar(20) NOT NULL,
  `project` varchar(50) DEFAULT NULL,
  `subproject` varchar(50) DEFAULT NULL,
  `defecttype` varchar(50) DEFAULT NULL,
  `testingtype` varchar(50) DEFAULT NULL,
  `stage1` varchar(50) DEFAULT NULL,
  `stage2` varchar(50) DEFAULT NULL,
  `issue` text,
  `category` varchar(50) DEFAULT NULL,
  `severity` varchar(20) DEFAULT NULL,
  `screen` text,
  `recommendation` text,
  `file` varchar(250) DEFAULT NULL,
  `environment` text,
  `submitdate` varchar(50) DEFAULT NULL,
  `status` varchar(50) DEFAULT 'Submitted',
  `scrubbingnote` text,
  `resolvenote` text,
  `verifynote` text,
  `resolvedate` varchar(50) DEFAULT NULL,
  `verifydate` varchar(50) DEFAULT NULL,
  `impact` text,
  `resolveby` varchar(50) DEFAULT NULL,
  `verifyby` varchar(50) DEFAULT NULL,
  `raiseby` varchar(50) DEFAULT NULL,
  `state` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `defect` */

/*Table structure for table `defectlog` */

DROP TABLE IF EXISTS `defectlog`;

CREATE TABLE `defectlog` (
  `id` varchar(50) DEFAULT NULL,
  `chgby` varchar(50) DEFAULT NULL,
  `action` varchar(50) DEFAULT NULL,
  `date` varchar(50) DEFAULT NULL,
  `ip` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `defectlog` */

/*Table structure for table `dfproject` */

DROP TABLE IF EXISTS `dfproject`;

CREATE TABLE `dfproject` (
  `project` varchar(100) NOT NULL,
  `subproject` varchar(100) NOT NULL,
  PRIMARY KEY (`project`,`subproject`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `dfproject` */

/*Table structure for table `heuristic` */

DROP TABLE IF EXISTS `heuristic`;

CREATE TABLE `heuristic` (
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `heuristic` */

insert  into `heuristic`(`name`) values ('Compatibility'),('Consistency and Standards'),('Error Prevention & Correction'),('Explicitness'),('Flexibility & Control'),('Functionality'),('Informative Feedback'),('Language & Content'),('Navigation'),('Privacy'),('User Guidance & Support'),('Visual Clarity');

/*Table structure for table `no` */

DROP TABLE IF EXISTS `no`;

CREATE TABLE `no` (
  `format` varchar(10) DEFAULT NULL,
  `no` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `no` */

insert  into `no`(`format`,`no`) values ('UR','000000');

/*Table structure for table `top_permission` */

DROP TABLE IF EXISTS `top_permission`;

CREATE TABLE `top_permission` (
  `role` varchar(20) NOT NULL,
  `project` varchar(10) DEFAULT NULL,
  `defect` varchar(10) DEFAULT NULL,
  `account` varchar(10) DEFAULT NULL,
  `report` varchar(10) DEFAULT NULL,
  `audit` varchar(10) DEFAULT NULL,
  `home` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`role`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `top_permission` */

insert  into `top_permission`(`role`,`project`,`defect`,`account`,`report`,`audit`,`home`) values ('admin','yes','yes','yes','yes','yes','yes'),('developer','no','yes','no','yes','no','yes'),('management','no','no','no','yes','no','yes'),('tester','yes','yes','no','yes','no','yes');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `role` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`,`email`),
  UNIQUE KEY `name` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `users` */

insert  into `users`(`id`,`email`,`password`,`name`,`role`) values (1,'admin@hotmail.com','Admin','Admin','admin');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
