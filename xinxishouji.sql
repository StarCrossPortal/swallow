CREATE DATABASE swallow;
USE swallow;

DROP TABLE IF EXISTS `bugs`;
CREATE TABLE `bugs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) DEFAULT '1',
  `host` varchar(64) CHARACTER SET utf8mb4 DEFAULT NULL,
  `level` int(255) DEFAULT '5',
  `detail` longtext CHARACTER SET utf8mb4,
  `create_time` datetime DEFAULT CURRENT_TIMESTAMP,
  `tags` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
  `url` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
  `port` int(11) DEFAULT NULL,
  `is_repair` int(11) DEFAULT '0' COMMENT '是否已修复',
  PRIMARY KEY (`id`),
  KEY `un_bug` (`project_id`,`host`)
) ENGINE=InnoDB AUTO_INCREMENT=358 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

DROP TABLE IF EXISTS `domain`;
CREATE TABLE `domain` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) DEFAULT '0',
  `domain` varchar(255) DEFAULT '',
  `create_time` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `un_domain` (`domain`)
) ENGINE=InnoDB AUTO_INCREMENT=1422 DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `info_leak`;
CREATE TABLE `info_leak` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) DEFAULT NULL,
  `search_keyword` varchar(255) DEFAULT NULL,
  `url` varchar(512) DEFAULT NULL,
  `create_time` datetime DEFAULT CURRENT_TIMESTAMP,
  `leak_content` varchar(2048) DEFAULT NULL,
  `file_name` varchar(255) DEFAULT NULL,
  `tags` varchar(1024) DEFAULT '[]',
  `hash` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `un_leak` (`project_id`,`url`,`hash`)
) ENGINE=InnoDB AUTO_INCREMENT=151 DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `ip`;
CREATE TABLE `ip` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) DEFAULT '1',
  `ip` varchar(16) DEFAULT NULL,
  `create_time` datetime DEFAULT CURRENT_TIMESTAMP,
  `country_name` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `region` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `longitude` varchar(255) DEFAULT NULL,
  `latitude` varchar(255) DEFAULT NULL,
  `as_organization` varchar(255) DEFAULT NULL,
  `domain` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `un_ip` (`project_id`,`ip`)
) ENGINE=InnoDB AUTO_INCREMENT=509 DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `mail`;
CREATE TABLE `mail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mail` varchar(255) DEFAULT NULL,
  `create_time` datetime DEFAULT CURRENT_TIMESTAMP,
  `project_id` int(11) DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `un_email` (`mail`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `mail_url`;
CREATE TABLE `mail_url` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mail` varchar(32) DEFAULT NULL,
  `create_time` datetime DEFAULT CURRENT_TIMESTAMP,
  `project_id` int(11) DEFAULT '1',
  `url` varchar(512) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `un_hash` (`mail`,`project_id`,`url`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `main`;
CREATE TABLE `main` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `host` varchar(64) NOT NULL,
  `scan_time` datetime NOT NULL DEFAULT '2000-01-01 00:00:00',
  `create_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `un_host` (`host`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `ports`;
CREATE TABLE `ports` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) DEFAULT '1',
  `ip` varchar(128) DEFAULT NULL,
  `create_time` datetime DEFAULT CURRENT_TIMESTAMP,
  `port` int(11) DEFAULT NULL,
  `protocol` varchar(32) DEFAULT NULL COMMENT '协议',
  `base_protocol` varchar(255) DEFAULT NULL,
  `server` varchar(255) DEFAULT NULL,
  `banner` varchar(2048) DEFAULT NULL,
  `version` varchar(255) DEFAULT NULL,
  `product` varchar(255) DEFAULT NULL,
  `product_category` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `un_port` (`ip`,`port`)
) ENGINE=InnoDB AUTO_INCREMENT=1069 DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `product_categorys`;
CREATE TABLE `product_categorys` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `un_name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `category` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `un_name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

DROP TABLE IF EXISTS `project`;
CREATE TABLE `project` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `create_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `project_conf`;
CREATE TABLE `project_conf` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(255) DEFAULT NULL,
  `value` text,
  `create_time` datetime DEFAULT CURRENT_TIMESTAMP,
  `name` varchar(255) DEFAULT NULL,
  `project_id` int(11) DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `un_key` (`project_id`,`key`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=364 DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `setting_domain`;
CREATE TABLE `setting_domain` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) DEFAULT '0',
  `domain` varchar(255) DEFAULT '',
  `create_time` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `un_domain` (`domain`)
) ENGINE=InnoDB AUTO_INCREMENT=1420 DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `urls`;
CREATE TABLE `urls` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) DEFAULT '1',
  `url` varchar(512) DEFAULT '',
  `create_time` datetime DEFAULT CURRENT_TIMESTAMP,
  `title` varchar(255) DEFAULT NULL,
  `product` varchar(255) DEFAULT NULL,
  `product_category` varchar(255) DEFAULT NULL,
  `icon_hash` varchar(255) DEFAULT NULL,
  `icp` varchar(255) DEFAULT NULL,
  `domain` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `un_url` (`project_id`,`url`)
) ENGINE=InnoDB AUTO_INCREMENT=314 DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `web_requests`;
CREATE TABLE `web_requests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `create_time` datetime DEFAULT '2000-01-01 00:00:00',
  `r_head` varchar(1024) DEFAULT NULL,
  `r_body` text,
  `method` varchar(255) DEFAULT NULL,
  `params` varchar(255) DEFAULT NULL,
  `project_id` int(11) DEFAULT '1',
  `domain` varchar(255) DEFAULT NULL,
  `file_type` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `websites`;
CREATE TABLE `websites` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) DEFAULT '1',
  `protocol` varchar(10) DEFAULT NULL,
  `domain` varchar(255) DEFAULT NULL,
  `port` int(11) DEFAULT NULL,
  `product_category` varchar(255) DEFAULT NULL,
  `product` varchar(255) DEFAULT NULL,
  `url` varchar(512) DEFAULT '',
  `icon_hash` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `icp` varchar(255) DEFAULT NULL,
  `create_time` datetime DEFAULT CURRENT_TIMESTAMP,
  `cert` text,
  `header` text,
  `banner` text,
  `icon_url` varchar(512) DEFAULT NULL COMMENT 'ICON的URL地址',
  `screen_url` varchar(512) DEFAULT NULL COMMENT '截图URL',
  PRIMARY KEY (`id`),
  UNIQUE KEY `un_website` (`project_id`,`domain`,`protocol`,`port`)
) ENGINE=InnoDB AUTO_INCREMENT=193 DEFAULT CHARSET=utf8mb4;

