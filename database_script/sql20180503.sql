/*
SQLyog Ultimate v11.11 (64 bit)
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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

/*Data for the table `account` */

insert  into `account`(`id`,`name`,`card_number`) values (12,'Mua','1'),(13,'Bán','1');

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

/*Table structure for table `auth_assignment` */

CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `auth_assignment_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `auth_assignment` */

/*Table structure for table `auth_item` */

CREATE TABLE `auth_item` (
  `name` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text,
  `rule_name` varchar(64) DEFAULT NULL,
  `data` text,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `group_code` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `idx-auth_item-type` (`type`),
  KEY `fk_auth_item_group_code` (`group_code`),
  CONSTRAINT `fk_auth_item_group_code` FOREIGN KEY (`group_code`) REFERENCES `auth_item_group` (`code`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `auth_item` */

insert  into `auth_item`(`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`,`group_code`) values ('/*',3,NULL,NULL,NULL,1524826886,1524826886,NULL),('/asset/*',3,NULL,NULL,NULL,1524826886,1524826886,NULL),('/asset/compress',3,NULL,NULL,NULL,1524826886,1524826886,NULL),('/asset/template',3,NULL,NULL,NULL,1524826886,1524826886,NULL),('/cache/*',3,NULL,NULL,NULL,1524826886,1524826886,NULL),('/cache/flush',3,NULL,NULL,NULL,1524826886,1524826886,NULL),('/cache/flush-all',3,NULL,NULL,NULL,1524826886,1524826886,NULL),('/cache/flush-schema',3,NULL,NULL,NULL,1524826886,1524826886,NULL),('/cache/index',3,NULL,NULL,NULL,1524826886,1524826886,NULL),('/fixture/*',3,NULL,NULL,NULL,1524826886,1524826886,NULL),('/fixture/load',3,NULL,NULL,NULL,1524826886,1524826886,NULL),('/fixture/unload',3,NULL,NULL,NULL,1524826886,1524826886,NULL),('/hello/*',3,NULL,NULL,NULL,1524826886,1524826886,NULL),('/hello/index',3,NULL,NULL,NULL,1524826886,1524826886,NULL),('/help/*',3,NULL,NULL,NULL,1524826886,1524826886,NULL),('/help/index',3,NULL,NULL,NULL,1524826886,1524826886,NULL),('/help/list',3,NULL,NULL,NULL,1524826886,1524826886,NULL),('/help/list-action-options',3,NULL,NULL,NULL,1524826886,1524826886,NULL),('/help/usage',3,NULL,NULL,NULL,1524826886,1524826886,NULL),('/message/*',3,NULL,NULL,NULL,1524826886,1524826886,NULL),('/message/config',3,NULL,NULL,NULL,1524826886,1524826886,NULL),('/message/config-template',3,NULL,NULL,NULL,1524826886,1524826886,NULL),('/message/extract',3,NULL,NULL,NULL,1524826886,1524826886,NULL),('/migrate/*',3,NULL,NULL,NULL,1524826886,1524826886,NULL),('/migrate/create',3,NULL,NULL,NULL,1524826886,1524826886,NULL),('/migrate/down',3,NULL,NULL,NULL,1524826886,1524826886,NULL),('/migrate/history',3,NULL,NULL,NULL,1524826886,1524826886,NULL),('/migrate/mark',3,NULL,NULL,NULL,1524826886,1524826886,NULL),('/migrate/new',3,NULL,NULL,NULL,1524826886,1524826886,NULL),('/migrate/redo',3,NULL,NULL,NULL,1524826886,1524826886,NULL),('/migrate/to',3,NULL,NULL,NULL,1524826886,1524826886,NULL),('/migrate/up',3,NULL,NULL,NULL,1524826886,1524826886,NULL),('/serve/*',3,NULL,NULL,NULL,1524826886,1524826886,NULL),('/serve/index',3,NULL,NULL,NULL,1524826886,1524826886,NULL),('/user-management/*',3,NULL,NULL,NULL,1524826886,1524826886,NULL),('/user-management/auth/change-own-password',3,NULL,NULL,NULL,1524826887,1524826887,NULL),('/user-management/user-permission/set',3,NULL,NULL,NULL,1524826887,1524826887,NULL),('/user-management/user-permission/set-roles',3,NULL,NULL,NULL,1524826887,1524826887,NULL),('/user-management/user/bulk-activate',3,NULL,NULL,NULL,1524826887,1524826887,NULL),('/user-management/user/bulk-deactivate',3,NULL,NULL,NULL,1524826887,1524826887,NULL),('/user-management/user/bulk-delete',3,NULL,NULL,NULL,1524826887,1524826887,NULL),('/user-management/user/change-password',3,NULL,NULL,NULL,1524826887,1524826887,NULL),('/user-management/user/create',3,NULL,NULL,NULL,1524826886,1524826886,NULL),('/user-management/user/delete',3,NULL,NULL,NULL,1524826887,1524826887,NULL),('/user-management/user/grid-page-size',3,NULL,NULL,NULL,1524826886,1524826886,NULL),('/user-management/user/index',3,NULL,NULL,NULL,1524826886,1524826886,NULL),('/user-management/user/update',3,NULL,NULL,NULL,1524826886,1524826886,NULL),('/user-management/user/view',3,NULL,NULL,NULL,1524826886,1524826886,NULL),('Admin',1,'Admin',NULL,NULL,1524826886,1524826886,NULL),('assignRolesToUsers',2,'Assign roles to users',NULL,NULL,1524826887,1524826887,'userManagement'),('bindUserToIp',2,'Bind user to IP',NULL,NULL,1524826887,1524826887,'userManagement'),('changeOwnPassword',2,'Change own password',NULL,NULL,1524826887,1524826887,'userCommonPermissions'),('changeUserPassword',2,'Change user password',NULL,NULL,1524826887,1524826887,'userManagement'),('commonPermission',2,'Common permission',NULL,NULL,1524826881,1524826881,NULL),('createUsers',2,'Create users',NULL,NULL,1524826886,1524826886,'userManagement'),('deleteUsers',2,'Delete users',NULL,NULL,1524826887,1524826887,'userManagement'),('editUserEmail',2,'Edit user email',NULL,NULL,1524826887,1524826887,'userManagement'),('editUsers',2,'Edit users',NULL,NULL,1524826886,1524826886,'userManagement'),('viewRegistrationIp',2,'View registration IP',NULL,NULL,1524826887,1524826887,'userManagement'),('viewUserEmail',2,'View user email',NULL,NULL,1524826887,1524826887,'userManagement'),('viewUserRoles',2,'View user roles',NULL,NULL,1524826887,1524826887,'userManagement'),('viewUsers',2,'View users',NULL,NULL,1524826886,1524826886,'userManagement'),('viewVisitLog',2,'View visit log',NULL,NULL,1524826887,1524826887,'userManagement');

/*Table structure for table `auth_item_child` */

CREATE TABLE `auth_item_child` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`),
  CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `auth_item_child` */

insert  into `auth_item_child`(`parent`,`child`) values ('changeOwnPassword','/user-management/auth/change-own-password'),('assignRolesToUsers','/user-management/user-permission/set'),('assignRolesToUsers','/user-management/user-permission/set-roles'),('editUsers','/user-management/user/bulk-activate'),('editUsers','/user-management/user/bulk-deactivate'),('deleteUsers','/user-management/user/bulk-delete'),('changeUserPassword','/user-management/user/change-password'),('createUsers','/user-management/user/create'),('deleteUsers','/user-management/user/delete'),('viewUsers','/user-management/user/grid-page-size'),('viewUsers','/user-management/user/index'),('editUsers','/user-management/user/update'),('viewUsers','/user-management/user/view'),('Admin','assignRolesToUsers'),('Admin','changeOwnPassword'),('Admin','changeUserPassword'),('Admin','createUsers'),('Admin','deleteUsers'),('Admin','editUsers'),('editUserEmail','viewUserEmail'),('assignRolesToUsers','viewUserRoles'),('Admin','viewUsers'),('assignRolesToUsers','viewUsers'),('changeUserPassword','viewUsers'),('createUsers','viewUsers'),('deleteUsers','viewUsers'),('editUsers','viewUsers');

/*Table structure for table `auth_item_group` */

CREATE TABLE `auth_item_group` (
  `code` varchar(64) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `auth_item_group` */

insert  into `auth_item_group`(`code`,`name`,`created_at`,`updated_at`) values ('userCommonPermissions','User common permission',1524826887,1524826887),('userManagement','User management',1524826886,1524826886);

/*Table structure for table `auth_rule` */

CREATE TABLE `auth_rule` (
  `name` varchar(64) NOT NULL,
  `data` text,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `auth_rule` */

/*Table structure for table `collection` */

CREATE TABLE `collection` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `account_id` int(10) unsigned NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `money` float NOT NULL,
  `customer_id` int(10) unsigned NOT NULL,
  `note` varchar(100) DEFAULT NULL,
  `flg_thuchi` int(11) DEFAULT '0' COMMENT 'thu1,chi 0',
  `username` varchar(200) DEFAULT NULL,
  `image1` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `account_id` (`account_id`),
  KEY `customer_id` (`customer_id`),
  CONSTRAINT `collection_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`),
  CONSTRAINT `collection_ibfk_2` FOREIGN KEY (`account_id`) REFERENCES `account` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

/*Data for the table `collection` */

insert  into `collection`(`id`,`account_id`,`time`,`money`,`customer_id`,`note`,`flg_thuchi`,`username`,`image1`) values (15,12,'2018-04-26 11:40:47',1000000,12,'lay tien',1,NULL,NULL),(16,12,'2018-04-29 11:46:43',122,12,'222',0,NULL,NULL),(17,12,'2018-04-29 12:07:24',11,12,'111',0,NULL,NULL),(18,12,'2018-04-29 12:10:28',11,12,'11',0,'phuong',NULL),(19,13,'2018-04-29 12:11:19',444,12,'444',0,'phuong',NULL),(20,12,'2018-04-29 12:11:46',444,12,'4444',1,'phuong',NULL),(21,12,'2018-04-30 12:25:04',400000,13,'ê',1,'phuong',NULL),(22,12,'2018-05-03 22:12:57',20000,13,'ok',1,'phuong','RPtQW7fboCFaDq17mfzTFdSu4YgeI06T.jpg');

/*Table structure for table `customer` */

CREATE TABLE `customer` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `info` varchar(128) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `unpay` decimal(10,2) NOT NULL DEFAULT '0.00',
  `payed` decimal(10,2) NOT NULL DEFAULT '0.00',
  `sum` decimal(10,2) NOT NULL DEFAULT '0.00',
  `username` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

/*Data for the table `customer` */

insert  into `customer`(`id`,`name`,`info`,`time`,`unpay`,`payed`,`sum`,`username`) values (12,'Hương','Hương','2018-04-24 22:35:44',0.00,1001032.00,0.00,NULL),(13,'Tharo','kthao','2018-04-29 17:02:41',-39938.00,420000.00,380062.00,'phuong');

/*Table structure for table `delivery` */

CREATE TABLE `delivery` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` int(10) unsigned NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `money` decimal(10,2) NOT NULL DEFAULT '0.00',
  `profit` decimal(10,2) NOT NULL DEFAULT '0.00',
  `state` enum('D','A') NOT NULL DEFAULT 'A',
  `note` varchar(150) DEFAULT NULL,
  `username` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `customer_id` (`customer_id`),
  CONSTRAINT `delivery_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

/*Data for the table `delivery` */

insert  into `delivery`(`id`,`customer_id`,`time`,`money`,`profit`,`state`,`note`,`username`) values (14,12,'2018-04-24 23:58:35',60000.00,20000.00,'A',NULL,NULL),(15,12,'2018-04-25 11:13:02',20000.00,9000.00,'A',NULL,NULL),(17,12,'2018-03-20 22:43:10',128000.00,48000.00,'A',NULL,NULL),(18,12,'2018-04-26 11:23:10',240000.00,152000.00,'A',NULL,NULL),(20,12,'2018-04-26 22:18:17',11365643.00,11365643.00,'A',NULL,NULL),(21,12,'2018-04-27 18:38:46',147744.00,147708.00,'A','qqqqqqqqq',NULL),(23,13,'2018-04-30 12:14:58',40000.00,40000.00,'A','ee','phuong'),(24,13,'2018-04-30 16:34:32',160000.00,160000.00,'A','','phuong'),(25,13,'2018-04-30 16:54:35',160000.00,160000.00,'A','','phuong'),(26,13,'2018-04-30 17:16:22',20000.00,20000.00,'A','','phuong'),(27,13,'2018-04-30 17:54:57',62.00,0.00,'A','','phuong');

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
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;

/*Data for the table `delivery_detail` */

insert  into `delivery_detail`(`id`,`delivery_id`,`product_id`,`count`,`price`) values (19,14,1,2,15000.00),(20,14,1,2,15000.00),(21,15,8,1,20000.00),(23,17,1,8,16000.00),(24,18,8,8,30000.00),(25,20,3,33,343434.00),(26,20,12,1,20000.00),(27,20,6,111,111.00),(28,21,4,12,12312.00),(30,23,14,2,20000.00),(31,24,14,8,20000.00),(32,25,14,1,60000.00),(33,25,15,2,50000.00),(34,26,15,1,20000.00),(35,27,14,1,12.00),(36,27,16,5,10.00);

/*Table structure for table `m_cost` */

CREATE TABLE `m_cost` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cost_name` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `m_cost` */

/*Table structure for table `migration` */

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `migration` */

insert  into `migration`(`version`,`apply_time`) values ('m000000_000000_base',1524826795),('m140608_173539_create_user_table',1524826876),('m140611_133903_init_rbac',1524826879),('m140808_073114_create_auth_item_group_table',1524826881),('m140809_072112_insert_superadmin_to_user',1524826881),('m140809_073114_insert_common_permisison_to_auth_item',1524826881),('m141023_141535_create_user_visit_log',1524826882),('m141116_115804_add_bind_to_ip_and_registration_ip_to_user',1524826883),('m141121_194858_split_browser_and_os_column',1524826885),('m141201_220516_add_email_and_email_confirmed_to_user',1524826886),('m141207_001649_create_basic_user_permissions',1524826887);

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
  `username` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

/*Data for the table `product` */

insert  into `product`(`id`,`name`,`unit`,`specification`,`price`,`cost`,`quantity`,`unit_id`,`username`) values (1,'Quần thể thao','P','0',1,0,2,14,NULL),(2,'Áo thể thao','P','0',2,0,0,9,NULL),(3,'Đâm hải tặc','P','1',3,1,0,9,NULL),(4,'Mimo Massage','P','8',3,7,5,9,NULL),(5,'Trà Thái Nguyên','P','3',4,3,0,9,NULL),(6,'Pin Xiaomi','B','3',5,2,0,9,NULL),(7,'Khám răng cá sấu','P','2',6,3,0,9,NULL),(8,'Áo khoác','P','3',11000,0,20,9,NULL),(9,'Áo sơ mi','B','3',7,0,0,9,NULL),(10,'Trứng lười','B','ss',8,0,0,9,NULL),(11,'Slime Trái cây','','222',9,0,0,9,NULL),(12,'Slime Hộp kẹo','P','kjdfkj',10,0,0,9,NULL),(13,'Iphone X','','0',11,0,0,9,NULL),(14,'Basnh beo','','0',12,0,NULL,11,'phuong'),(15,'Dam hai tac','','0',13,0,NULL,10,'phuong'),(16,'Ổi chua','','0',10,0,NULL,14,'phuong'),(17,'Laptop del 12','','0',150000,0,NULL,10,'phuong');

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
  `note` varchar(150) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `image1` varchar(200) DEFAULT NULL,
  `username` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8;

/*Data for the table `stockin` */

insert  into `stockin`(`id`,`time`,`money`,`note`,`customer_id`,`image1`,`username`) values (22,'2018-04-24 23:57:44',20000,NULL,NULL,NULL,NULL),(23,'2018-04-25 11:12:21',9000,NULL,NULL,NULL,NULL),(24,'2018-03-25 22:03:57',100000,NULL,NULL,NULL,NULL),(25,'2018-04-26 23:01:13',104794,NULL,NULL,NULL,NULL),(26,'2018-04-27 11:49:14',4000000,'ấgasgasgsagsa',NULL,NULL,NULL),(27,'2018-04-27 11:50:42',1000000,'aqqqqqqqqqqqqqqqqqqqq',12,NULL,NULL),(28,'2018-04-28 20:41:00',10000,'',12,NULL,NULL),(29,'2018-04-28 21:30:45',1221,'sss',12,'RoLCcqEJZa83e1MjojpT6gs9U6OKly5A.jpg',NULL),(30,'2018-04-28 22:01:25',5332,'dfsd',12,NULL,NULL),(31,'2018-04-28 22:04:55',3960000,'852',12,'-uK2JuE8sfwjk-IE3F_-0NlMDrXOTJEt.jpg',NULL),(32,'2018-04-29 17:17:39',4182,'323',12,'gs2NBSIXUwi18ziF499wxZyUeIShpH_6.png',NULL),(33,'2018-04-29 17:20:13',7424,'fsd',12,'Q7CNh3Ks9sFLiJzTI29J8xu8D1wOXthk.png',NULL),(34,'2018-04-29 17:21:45',97032,'sdfsd',12,NULL,NULL),(36,'2018-04-30 12:14:37',2400000,'dá',13,'bFGFbKAikpWwYz3fD86kLWUkg_AYBVQh.jpg','phuong'),(37,'2018-04-30 16:53:44',90000,'',13,NULL,'phuong'),(38,'2018-04-30 17:07:15',80000,'',13,NULL,'phuong');

/*Table structure for table `stockin_detail` */

CREATE TABLE `stockin_detail` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `stockin_id` int(10) unsigned NOT NULL,
  `product_id` int(10) unsigned NOT NULL,
  `count` int(10) unsigned NOT NULL,
  `price` float DEFAULT '0',
  `note` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`),
  KEY `stockin_id` (`stockin_id`),
  CONSTRAINT `stockin_detail_ibfk_1` FOREIGN KEY (`stockin_id`) REFERENCES `stockin` (`id`),
  CONSTRAINT `stockin_detail_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=utf8;

/*Data for the table `stockin_detail` */

insert  into `stockin_detail`(`id`,`stockin_id`,`product_id`,`count`,`price`,`note`) values (46,22,1,2,10000,NULL),(47,23,8,10,900,NULL),(48,24,1,10,10000,NULL),(49,25,3,11,11,NULL),(50,25,6,11,111,NULL),(51,25,5,233,444,NULL),(52,26,2,100,40000,NULL),(53,27,1,10,100000,NULL),(54,28,2,1,10000,NULL),(55,29,3,11,111,NULL),(56,30,2,4,1333,NULL),(57,31,3,33,120000,NULL),(58,32,4,34,123,NULL),(59,33,5,232,32,NULL),(60,34,3,32344,3,NULL),(62,36,14,12,200000,NULL),(63,37,15,3,30000,NULL),(64,38,15,2,40000,NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

/*Data for the table `unit` */

insert  into `unit`(`id`,`unit_name`,`update_date`) values (9,'Cái','2018-04-24 17:14:42'),(10,'Hộp 10',NULL);

/*Table structure for table `unit_pro` */

CREATE TABLE `unit_pro` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `unit_name` varchar(2000) DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

/*Data for the table `unit_pro` */

insert  into `unit_pro`(`id`,`unit_name`,`update_date`) values (9,'Hộp',NULL),(10,'Bộ',NULL),(11,'Thùng',NULL),(12,'Kg',NULL),(13,'Gam',NULL),(14,'Tấn',NULL),(18,'Khác',NULL);

/*Table structure for table `user` */

CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `auth_key` varchar(32) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `confirmation_token` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `superadmin` smallint(6) DEFAULT '0',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `registration_ip` varchar(15) DEFAULT NULL,
  `bind_to_ip` varchar(255) DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  `email_confirmed` smallint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `user` */

insert  into `user`(`id`,`username`,`auth_key`,`password_hash`,`confirmation_token`,`status`,`superadmin`,`created_at`,`updated_at`,`registration_ip`,`bind_to_ip`,`email`,`email_confirmed`) values (1,'superadmin','QKsFZ8CNKqQd8Yqeg-kKQKal4jWpowB4','$2y$13$vadpV6nFKT8gjC9qo26ey.WtoqoHBHT2Pe111.aRfi7bS.pkg5ype',NULL,1,1,1524826881,1524828052,NULL,'',NULL,0),(2,'phuong','XFVTdugbRkKyepHOkaWK7DNqv1rD5zvE','$2y$13$zrC5bfdICfD8kUfvvyDAbu/2dtano9BIdcCmCP4u6C8P46HAcysLK',NULL,1,0,1524974280,1524974280,'::1','','',0),(3,'thiet','rhV2kY6dtUCQqW7kg_L4WlSqUYT4dbBU','$2y$13$m.mPKTekX00VS5EzwAyCo.sGPvi3j392O11pxj6z.BYaMxTnQQV4a',NULL,1,0,1525228932,1525228932,'::1','','',0);

/*Table structure for table `user_visit_log` */

CREATE TABLE `user_visit_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(255) NOT NULL,
  `ip` varchar(15) NOT NULL,
  `language` char(2) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `visit_time` int(11) NOT NULL,
  `browser` varchar(30) DEFAULT NULL,
  `os` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `user_visit_log_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

/*Data for the table `user_visit_log` */

insert  into `user_visit_log`(`id`,`token`,`ip`,`language`,`user_agent`,`user_id`,`visit_time`,`browser`,`os`) values (1,'5ae30444666dd','::1','en','Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/537.36',1,1524827204,'Chrome','Windows'),(2,'5ae30479e65fb','::1','en','Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/537.36',1,1524827257,'Chrome','Windows'),(3,'5ae305033d260','::1','en','Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/537.36',1,1524827395,'Chrome','Windows'),(4,'5ae3054b24078','::1','en','Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/537.36',1,1524827467,'Chrome','Windows'),(5,'5ae3055a62fc9','::1','en','Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/537.36',1,1524827482,'Chrome','Windows'),(6,'5ae308f41ba10','::1','en','Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/537.36',1,1524828404,'Chrome','Windows'),(7,'5ae542a90f495','::1','en','Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/537.36',1,1524974249,'Chrome','Windows'),(8,'5ae542dfe6e59','::1','en','Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/537.36',2,1524974303,'Chrome','Windows'),(9,'5ae54ba74ac76','::1','en','Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/537.36',1,1524976551,'Chrome','Windows'),(10,'5ae54f13b5418','::1','en','Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/537.36',2,1524977427,'Chrome','Windows'),(11,'5ae58a2cc6ac6','::1','en','Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/537.36',1,1524992556,'Chrome','Windows'),(12,'5ae58a44ec1ec','::1','en','Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/537.36',2,1524992580,'Chrome','Windows'),(13,'5ae59b4fd9f15','::1','en','Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/537.36',1,1524996943,'Chrome','Windows'),(14,'5ae6951f2c8fa','::1','en','Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/537.36',1,1525060895,'Chrome','Windows'),(15,'5ae695fcc0acd','::1','en','Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/537.36',1,1525061116,'Chrome','Windows'),(16,'5ae6961fb959d','::1','en','Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/537.36',2,1525061151,'Chrome','Windows'),(17,'5ae92574bcb21','::1','en','Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/537.36',1,1525228916,'Chrome','Windows'),(18,'5ae92977003e8','::1','en','Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/537.36',3,1525229943,'Chrome','Windows'),(19,'5ae95d553f20c','::1','en','Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/537.36',3,1525243221,'Chrome','Windows'),(20,'5aea70ffd8d88','::1','en','Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.139 Safari/537.36',3,1525313791,'Chrome','Windows'),(21,'5aea8cd9973a1','::1','en','Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.139 Safari/537.36',1,1525320921,'Chrome','Windows'),(22,'5aea8e179dc38','::1','en','Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.139 Safari/537.36',1,1525321239,'Chrome','Windows'),(23,'5aeb16a1530b0','::1','en','Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.139 Safari/537.36',2,1525356193,'Chrome','Windows');

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
