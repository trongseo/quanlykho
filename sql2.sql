/*
SQLyog Ultimate v9.63 
MySQL - 5.6.19-0ubuntu0.14.04.1 : Database - zzzstock
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `account` */

CREATE TABLE `account` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `card_number` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

/*Data for the table `account` */

/*Table structure for table `admin_user` */

CREATE TABLE `admin_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `passwd` blob,
  `description` varchar(255) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `is_read_personal` tinyint(4) DEFAULT NULL,
  `is_downloaded_personal` tinyint(4) DEFAULT NULL,
  `is_maker` tinyint(4) DEFAULT NULL,
  `maker_name` varchar(255) DEFAULT NULL,
  `pass_modified` datetime DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `deleted` datetime DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `utc_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8;

/*Data for the table `admin_user` */

/*Table structure for table `admin_user_copy` */

CREATE TABLE `admin_user_copy` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `passwd` blob,
  `description` varchar(255) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `is_read_personal` tinyint(4) DEFAULT NULL,
  `is_downloaded_personal` tinyint(4) DEFAULT NULL,
  `is_maker` tinyint(4) DEFAULT NULL,
  `maker_name` varchar(255) DEFAULT NULL,
  `pass_modified` datetime DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `deleted` datetime DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `utc_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8;

/*Data for the table `admin_user_copy` */

/*Table structure for table `collection` */

CREATE TABLE `collection` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `account_id` int(10) unsigned NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `money` float NOT NULL,
  `customer_id` int(10) unsigned NOT NULL,
  `note` varchar(100) DEFAULT NULL,
  `flg_thuchi` int(11) DEFAULT '0' COMMENT 'thu1,chi 0',
  PRIMARY KEY (`id`),
  KEY `account_id` (`account_id`),
  KEY `customer_id` (`customer_id`),
  CONSTRAINT `collection_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`),
  CONSTRAINT `collection_ibfk_2` FOREIGN KEY (`account_id`) REFERENCES `account` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

/*Data for the table `collection` */

/*Table structure for table `customer` */

CREATE TABLE `customer` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `info` varchar(128) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `unpay` decimal(10,2) NOT NULL DEFAULT '0.00',
  `payed` decimal(10,2) NOT NULL DEFAULT '0.00',
  `sum` decimal(10,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

/*Data for the table `customer` */

/*Table structure for table `delivery` */

CREATE TABLE `delivery` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` int(10) unsigned NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `money` decimal(10,2) NOT NULL DEFAULT '0.00',
  `profit` decimal(10,2) NOT NULL DEFAULT '0.00',
  `state` enum('D','A') NOT NULL DEFAULT 'A',
  PRIMARY KEY (`id`),
  KEY `customer_id` (`customer_id`),
  CONSTRAINT `delivery_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

/*Data for the table `delivery` */

/*Table structure for table `delivery_detail` */

CREATE TABLE `delivery_detail` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `delivery_id` int(10) unsigned NOT NULL,
  `product_id` int(10) unsigned NOT NULL,
  `count` int(10) unsigned NOT NULL,
  `price` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`),
  KEY `delivery_id` (`delivery_id`),
  CONSTRAINT `delivery_detail_ibfk_1` FOREIGN KEY (`delivery_id`) REFERENCES `delivery` (`id`),
  CONSTRAINT `delivery_detail_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

/*Data for the table `delivery_detail` */

/*Table structure for table `m_cost` */

CREATE TABLE `m_cost` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cost_name` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `m_cost` */

/*Table structure for table `product` */

CREATE TABLE `product` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `unit` enum('P','B') NOT NULL DEFAULT 'B',
  `specification` varchar(100) NOT NULL,
  `price` decimal(10,0) NOT NULL DEFAULT '0',
  `cost` decimal(10,0) NOT NULL DEFAULT '0',
  `quantity` int(11) DEFAULT NULL,
  `unit_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

/*Data for the table `product` */

insert  into `product`(`id`,`name`,`unit`,`specification`,`price`,`cost`,`quantity`,`unit_id`) values (1,'dam hai tac','P','0','0','0',0,9),(2,'den','P','0','0','0',0,9),(3,'ban','P','1','0','1',0,9),(4,'NGa','P','8','0','7',0,9),(5,'bad','P','3','0','3',0,9),(6,'sugar','B','3','0','2',0,9),(7,'hat','P','2','0','3',0,9),(8,'pen','P','3','0','0',0,9),(9,'nut','B','3','0','0',0,9),(10,'eee','B','ss','0','0',0,9),(11,'3rrr','','222','0','0',0,9),(12,'guỳn','P','kjdfkj','0','0',0,9),(13,'Điện thoại nokia 1','','0','0','0',0,9);

/*Table structure for table `product_month` */

CREATE TABLE `product_month` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `unit` enum('P','B') NOT NULL DEFAULT 'B',
  `specification` varchar(100) NOT NULL,
  `price` decimal(10,0) NOT NULL DEFAULT '0',
  `cost` decimal(10,0) NOT NULL DEFAULT '0',
  `quantity` int(11) DEFAULT NULL,
  `yearmonth` datetime DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8;

/*Data for the table `product_month` */

/*Table structure for table `stockin` */

CREATE TABLE `stockin` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `money` decimal(10,0) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

/*Data for the table `stockin` */

insert  into `stockin`(`id`,`time`,`money`) values (17,'2018-01-01 18:08:58','2'),(18,'2018-01-24 18:29:51','9'),(19,'2018-01-24 18:42:03','13');

/*Table structure for table `stockin_detail` */

CREATE TABLE `stockin_detail` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `stockin_id` int(10) unsigned NOT NULL,
  `product_id` int(10) unsigned NOT NULL,
  `count` int(10) unsigned NOT NULL,
  `price` float DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`),
  KEY `stockin_id` (`stockin_id`),
  CONSTRAINT `stockin_detail_ibfk_1` FOREIGN KEY (`stockin_id`) REFERENCES `stockin` (`id`),
  CONSTRAINT `stockin_detail_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8;

/*Data for the table `stockin_detail` */

insert  into `stockin_detail`(`id`,`stockin_id`,`product_id`,`count`,`price`) values (40,17,1,2,1),(41,18,1,3,3),(42,19,4,2,2),(43,19,4,3,3);

/*Table structure for table `t_cost` */

CREATE TABLE `t_cost` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cost_desc` varchar(30) DEFAULT NULL,
  `cost_id` int(11) DEFAULT NULL,
  `date_cost` datetime DEFAULT NULL,
  `date_update` datetime DEFAULT NULL,
  `cost_fee` float DEFAULT NULL COMMENT 'chi phi',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `t_cost` */

/*Table structure for table `unit` */

CREATE TABLE `unit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `unit_name` varchar(2000) DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

/*Data for the table `unit` */

insert  into `unit`(`id`,`unit_name`,`update_date`) values (9,'cái','2018-04-24 17:14:42');

/*Table structure for table `unit_pro` */

CREATE TABLE `unit_pro` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `unit_name` varchar(2000) DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

/*Data for the table `unit_pro` */

insert  into `unit_pro`(`id`,`unit_name`,`update_date`) values (9,'Hộp',NULL);

/*Table structure for table `warehouse` */

CREATE TABLE `warehouse` (
  `idwarehouse` int(11) NOT NULL AUTO_INCREMENT,
  `idchungtu` varchar(45) DEFAULT NULL,
  `idproduct` varchar(45) DEFAULT NULL,
  `productname` varchar(100) DEFAULT NULL,
  `unit` varchar(100) DEFAULT NULL,
  `count` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `cost` int(11) DEFAULT NULL,
  `idnhacungcap` varchar(100) DEFAULT NULL,
  `note` varchar(200) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `idunit` int(11) DEFAULT NULL,
  PRIMARY KEY (`idwarehouse`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4;

/*Data for the table `warehouse` */

insert  into `warehouse`(`idwarehouse`,`idchungtu`,`idproduct`,`productname`,`unit`,`count`,`price`,`cost`,`idnhacungcap`,`note`,`date`,`idunit`) values (31,'1','1','1','9',1,1,1,'1','1','2018-04-02 00:00:00',NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
