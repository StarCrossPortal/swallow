CREATE DATABASE swallow;
USE swallow;

DROP TABLE IF EXISTS `fortify`;
CREATE TABLE `fortify` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `create_time` datetime DEFAULT CURRENT_TIMESTAMP,
  `project_id` int(11) DEFAULT '1',
  `Category` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `Folder` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `Kingdom` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `Abstract` varchar(512) COLLATE utf8mb4_bin DEFAULT NULL,
  `Friority` varchar(512) COLLATE utf8mb4_bin DEFAULT NULL,
  `Primary` longtext COLLATE utf8mb4_bin,
  `hash` varchar(32) COLLATE utf8mb4_bin DEFAULT NULL,
  `git_addr` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `is_repair` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `project_id` (`project_id`,`hash`)
) ENGINE=InnoDB AUTO_INCREMENT=199 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

DROP TABLE IF EXISTS `git_addr`;
CREATE TABLE `git_addr` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) DEFAULT '0',
  `git_addr` varchar(512) DEFAULT '',
  `create_time` datetime DEFAULT CURRENT_TIMESTAMP,
  `semgrep_scan_time` datetime DEFAULT '2000-01-01 00:00:00',
  `mofei_scan_time` datetime DEFAULT NULL,
  `fortify_scan_time` datetime DEFAULT NULL,
  `hema_scan_time` datetime DEFAULT NULL,
  `code_path` varchar(255) DEFAULT NULL COMMENT '代码存放路径',
  PRIMARY KEY (`id`),
  UNIQUE KEY `un_domain` (`git_addr`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=1442 DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `hema`;
CREATE TABLE `hema` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `create_time` datetime DEFAULT CURRENT_TIMESTAMP,
  `type` varchar(256) COLLATE utf8mb4_bin DEFAULT NULL,
  `filename` varchar(512) COLLATE utf8mb4_bin DEFAULT NULL,
  `project_id` int(11) DEFAULT '1',
  `git_addr` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `is_repair` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=375 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

DROP TABLE IF EXISTS `mf_vulns`;
CREATE TABLE `mf_vulns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) DEFAULT '1',
  `cve_id` varchar(50) COLLATE utf8mb4_bin DEFAULT NULL,
  `description` varchar(1024) COLLATE utf8mb4_bin DEFAULT NULL,
  `level` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `influence` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `poc` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `publish_time` int(11) DEFAULT NULL,
  `affected_version` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `min_fixed_version` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `references` text COLLATE utf8mb4_bin,
  `solutions` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `suggest_level` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `vuln_no` varchar(50) COLLATE utf8mb4_bin DEFAULT NULL,
  `vuln_path` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `git_addr` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `is_repair` int(11) DEFAULT '0',
  `create_time` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

DROP TABLE IF EXISTS `murphysec`;
CREATE TABLE `murphysec` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) DEFAULT '1',
  `create_time` datetime DEFAULT CURRENT_TIMESTAMP,
  `comp_name` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `show_level` int(11) DEFAULT NULL,
  `min_fixed_version` varchar(30) COLLATE utf8mb4_bin DEFAULT NULL,
  `dispose_plan` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `version` varchar(30) COLLATE utf8mb4_bin DEFAULT NULL,
  `license` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `is_direct_dependency` varchar(1024) COLLATE utf8mb4_bin DEFAULT NULL,
  `language` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `fix_type` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `comp_sec_score` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

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
) ENGINE=InnoDB AUTO_INCREMENT=382 DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `semgrep`;
CREATE TABLE `semgrep` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `create_time` datetime DEFAULT CURRENT_TIMESTAMP,
  `project_id` int(11) DEFAULT '1',
  `check_id` varchar(100) COLLATE utf8mb4_bin DEFAULT NULL,
  `end` varchar(200) COLLATE utf8mb4_bin DEFAULT NULL,
  `extra` text COLLATE utf8mb4_bin,
  `path` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `start` varchar(200) COLLATE utf8mb4_bin DEFAULT NULL,
  `git_addr` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `is_repair` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `un_vul` (`project_id`,`path`,`start`,`end`,`check_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=1809 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

