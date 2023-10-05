/*
SQLyog Ultimate v11.33 (64 bit)
MySQL - 8.0.31 : Database - soulcare
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`soulcare` /*!40100 DEFAULT CHARACTER SET latin1 */ /*!80016 DEFAULT ENCRYPTION='N' */;

USE `soulcare`;

/*Table structure for table `booking` */

DROP TABLE IF EXISTS `booking`;

CREATE TABLE `booking` (
  `booking_id` int NOT NULL AUTO_INCREMENT,
  `pid` varchar(100) NOT NULL,
  `sid` varchar(100) NOT NULL,
  `mode` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL DEFAULT 'Booked',
  PRIMARY KEY (`booking_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `booking` */

insert  into `booking`(`booking_id`,`pid`,`sid`,`mode`,`status`) values (1,'1','1','Online','Booked');

/*Table structure for table `councellor` */

DROP TABLE IF EXISTS `councellor`;

CREATE TABLE `councellor` (
  `cid` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `quali` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `address` varchar(300) NOT NULL,
  `time` varchar(100) NOT NULL,
  PRIMARY KEY (`cid`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `councellor` */

insert  into `councellor`(`cid`,`name`,`email`,`phone`,`quali`,`image`,`address`,`time`) values (1,'Joyel','joyel@gmail.com','9876543210','MSc Psychology','My project.png','Kochi','10:00 AM - 05:00 PM'),(4,'Manya','manya@gmail.com','9653252222','BSc','pexels-andrea-piacquadio-774909.jpg','Malappuram','10:00 AM - 05:00 PM');

/*Table structure for table `department` */

DROP TABLE IF EXISTS `department`;

CREATE TABLE `department` (
  `dept_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`dept_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `department` */

insert  into `department`(`dept_id`,`name`) values (3,'MBA'),(4,'MCA'),(5,'BBA'),(6,'BSc');

/*Table structure for table `feedback` */

DROP TABLE IF EXISTS `feedback`;

CREATE TABLE `feedback` (
  `id` int NOT NULL AUTO_INCREMENT,
  `uid` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `booking_id` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `title` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `feedback` varchar(300) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `date` date NOT NULL,
  `reply` varchar(300) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `feedback` */

insert  into `feedback`(`id`,`uid`,`booking_id`,`title`,`feedback`,`date`,`reply`) values (1,'1','1','Soul Man','Good Class','2023-08-25','Very Nice To Hear.Hope You Enjoyed');

/*Table structure for table `individual_booking` */

DROP TABLE IF EXISTS `individual_booking`;

CREATE TABLE `individual_booking` (
  `bid` int NOT NULL AUTO_INCREMENT,
  `cid` varchar(100) NOT NULL,
  `sid` varchar(100) NOT NULL,
  `date` varchar(100) NOT NULL,
  `time` varchar(100) NOT NULL,
  PRIMARY KEY (`bid`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `individual_booking` */

insert  into `individual_booking`(`bid`,`cid`,`sid`,`date`,`time`) values (1,'1','3','2023-10-04','5:05 AM'),(2,'4','3','2023-10-05','2:20 AM');

/*Table structure for table `login` */

DROP TABLE IF EXISTS `login`;

CREATE TABLE `login` (
  `login_id` int NOT NULL AUTO_INCREMENT,
  `reg_id` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `usertype` varchar(100) NOT NULL,
  `status` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'Pending',
  PRIMARY KEY (`login_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

/*Data for the table `login` */

insert  into `login`(`login_id`,`reg_id`,`email`,`password`,`usertype`,`status`) values (1,'0','admin@gmail.com','admin','Admin','Approved'),(5,'1','joyel@gmail.com','Joyel@123','Councellor','Approved'),(8,'1','ajal@gmail.com','Ajal@123','Student','Pending'),(9,'2','meenupro@gmail.com','Meenu@123','Student','Pending'),(13,'3','josna@gmail.com','Josna@123','Student','Approved'),(14,'9','arya@gmail.com','Arya@123','Staff','Approved'),(15,'4','manya@gmail.com','Manya@123','Councellor','Approved');

/*Table structure for table `programme` */

DROP TABLE IF EXISTS `programme`;

CREATE TABLE `programme` (
  `pid` int NOT NULL AUTO_INCREMENT COMMENT 'Programme Id',
  `cid` varchar(100) NOT NULL COMMENT 'Councellor Id',
  `sid` varchar(100) NOT NULL,
  `programme_name` varchar(100) NOT NULL,
  `description` varchar(300) NOT NULL,
  `date` varchar(100) NOT NULL,
  `time` varchar(100) NOT NULL,
  `location` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  PRIMARY KEY (`pid`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `programme` */

insert  into `programme`(`pid`,`cid`,`sid`,`programme_name`,`description`,`date`,`time`,`location`,`phone`) values (1,'1','4','Heal Your Soul','Mental health is a state of mental well-being that enables people to cope with the stresses of life.','2023-08-31','10:00 AM','College Auditorium','9876543210');

/*Table structure for table `staff` */

DROP TABLE IF EXISTS `staff`;

CREATE TABLE `staff` (
  `staff_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `dept` varchar(100) NOT NULL,
  `quali` varchar(100) NOT NULL,
  `address` varchar(300) NOT NULL,
  PRIMARY KEY (`staff_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Data for the table `staff` */

insert  into `staff`(`staff_id`,`name`,`email`,`phone`,`dept`,`quali`,`address`) values (7,'Vineeth','vineeth@gmail.com','9874563211','MCA','MCA','Idukki Pattumala'),(9,'Arya','arya@gmail.com','8965231458','BBA','BTech','Kottayam');

/*Table structure for table `student` */

DROP TABLE IF EXISTS `student`;

CREATE TABLE `student` (
  `sid` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `address` varchar(300) NOT NULL,
  `gender` varchar(100) NOT NULL,
  `department` varchar(100) NOT NULL,
  PRIMARY KEY (`sid`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `student` */

insert  into `student`(`sid`,`name`,`email`,`phone`,`address`,`gender`,`department`) values (1,'Ajal','ajal@gmail.com','9874563215','Vallikkunnu','Male','MCA'),(2,'Meenu','meenupro@gmail.com','8965232154','Vytila','Female','BBA'),(3,'Josna','josna@gmail.com','8956321245','Alappuzha\r\n','Female','BBA');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
