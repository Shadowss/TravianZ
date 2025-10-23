-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 21, 2011 at 02:49 AM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

-- --------------------------------------------------------

--
-- Table structure for table `%PREFIX%a2b`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%a2b` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `ckey` varchar(255) NULL,
 `time_check` int(11) NULL DEFAULT '0',
 `to_vid` int(11) NULL,
 `u1` int(11) NULL,
 `u2` int(11) NULL,
 `u3` int(11) NULL,
 `u4` int(11) NULL,
 `u5` int(11) NULL,
 `u6` int(11) NULL,
 `u7` int(11) NULL,
 `u8` int(11) NULL,
 `u9` int(11) NULL,
 `u10` int(11) NULL,
 `u11` int(11) NULL,
 `type` smallint(1) NULL,
 PRIMARY KEY (`id`),
 KEY `ckey` (`ckey`(25))
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `%PREFIX%a2b`
--

--
-- Table structure for table `%PREFIX%links`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%links` (
 `id` INT( 25 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
 `userid` INT( 25 ) NULL ,
 `name` VARCHAR( 50 ) NULL ,
 `url` VARCHAR( 150 ) NULL ,
 `pos` INT( 10 ) NULL,
 KEY `userid-pos` (`userid`,`pos`) USING BTREE
) ENGINE = InnoDB;

--
-- Dumping data for table `%PREFIX%links`
--

-- --------------------------------------------------------

--
-- Table structure for table `%PREFIX%abdata`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%abdata` (
 `vref` int(11) NOT NULL,
 `a1` tinyint(2) NULL DEFAULT '0',
 `a2` tinyint(2) NULL DEFAULT '0',
 `a3` tinyint(2) NULL DEFAULT '0',
 `a4` tinyint(2) NULL DEFAULT '0',
 `a5` tinyint(2) NULL DEFAULT '0',
 `a6` tinyint(2) NULL DEFAULT '0',
 `a7` tinyint(2) NULL DEFAULT '0',
 `a8` tinyint(2) NULL DEFAULT '0',
 `b1` tinyint(2) NULL DEFAULT '0',
 `b2` tinyint(2) NULL DEFAULT '0',
 `b3` tinyint(2) NULL DEFAULT '0',
 `b4` tinyint(2) NULL DEFAULT '0',
 `b5` tinyint(2) NULL DEFAULT '0',
 `b6` tinyint(2) NULL DEFAULT '0',
 `b7` tinyint(2) NULL DEFAULT '0',
 `b8` tinyint(2) NULL DEFAULT '0',
 PRIMARY KEY (`vref`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `%PREFIX%abdata`
--


-- --------------------------------------------------------

--
-- Table structure for table `%PREFIX%activate`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%activate` (
 `id` int(255) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `tribe` tinyint(1) DEFAULT NULL,
  `access` tinyint(1) DEFAULT '1',
  `act` varchar(10) DEFAULT NULL,
  `timestamp` int(11) DEFAULT '0',
  `location` text,
  `act2` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `%PREFIX%activate`
--


-- --------------------------------------------------------

--
-- Table structure for table `%PREFIX%active`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%active` (
 `username` varchar(100) NOT NULL,
 `timestamp` int(11) NULL,
 PRIMARY KEY (`username`),
 KEY `timestamp` (`timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `%PREFIX%active`
--


-- --------------------------------------------------------

--
-- Table structure for table `%PREFIX%admin_log`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%admin_log` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `user` text NULL,
 `log` text NULL,
 `time` int(25) NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `%PREFIX%admin_log`
--


-- --------------------------------------------------------
--
-- Table structure for table `%PREFIX%allimedal`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%allimedal` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `allyid` int(11) NULL,
 `categorie` int(11) NULL,
 `plaats` int(11) NULL,
 `week` int(11) NULL,
 `points` bigint(255) NULL,
 `img` varchar(255) NULL,
 `del` tinyint(1) NULL DEFAULT '0',
 PRIMARY KEY (`id`),
 KEY `week` (`week`),
 KEY `allyid` (`allyid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `%PREFIX%artefacts`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%artefacts` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `vref` int(11) NULL,
 `owner` int(11) NULL,
 `type` tinyint(2) NULL,
 `size` tinyint(1) NULL,
 `conquered` int(11) NULL,
 `name` varchar(100) NULL,
 `desc` text NULL,
 `effect` varchar(100) NULL,
 `img` varchar(20) NULL,
 `active` tinyint(1) NULL,
 `kind` tinyint(1) NULL DEFAULT '0',
 `bad_effect` tinyint(1) NULL DEFAULT '0',
 `effect2` tinyint(2) NULL DEFAULT '0',
 `lastupdate` int(11) NULL DEFAULT '0', 
 `del` tinyint(1) NULL DEFAULT '0',
 PRIMARY KEY (`id`),
 KEY `owner-active` (`owner`,`active`),
 KEY `vref-type-kind` (`vref`,`type`,`kind`) USING BTREE,
 KEY `active-type-lastupdate` (`active`,`type`,`lastupdate`),
 KEY `size-type` (`size`, `type`),
 KEY `active-owner-conquered-del` (`active`, `owner`, `conquered`, `del`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `%PREFIX%artefacts`
--
-- --------------------------------------------------------

--
-- Table structure for `%PREFIX%artefacts_chrono`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%artefacts_chrono` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `artefactid` int(11) NULL,
  `uid` int(11) NULL,
  `vref` int(11) NULL,
  `conqueredtime` int(11) NULL,
  PRIMARY KEY (`id`),
  KEY `artefactid-conqueredtime` (`artefactid`,`conqueredtime`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `%PREFIX%artefacts_chrono`
--
-- --------------------------------------------------------

--
-- Table structure for table `%PREFIX%alidata`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%alidata` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `name` varchar(100) NULL,
 `tag` varchar(100) NULL,
 `leader` int(11) NULL,
 `coor` int(11) NULL,
 `advisor` int(11) NULL,
 `recruiter` int(11) NULL,
 `notice` text NULL,
 `desc` text NULL,
 `max` tinyint(2) NULL,
 `ap` bigint(255) NULL DEFAULT '0',
 `dp` bigint(255) NULL DEFAULT '0',
 `Rc` bigint(255) NULL DEFAULT '0',
 `RR` bigint(255) NULL DEFAULT '0',
 `Aap` bigint(255) NULL DEFAULT '0',
 `Adp` bigint(255) NULL DEFAULT '0',
 `clp` bigint(255) NULL DEFAULT '0',
 `oldrank` bigint(255) NULL DEFAULT '0',
 `forumlink` varchar(150) NULL,
 PRIMARY KEY (`id`),
 KEY `tag` (`tag`),
 KEY `name` (`name`),
 KEY `leader` (`leader`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `%PREFIX%alidata`
--


-- --------------------------------------------------------

--
-- Table structure for table `%PREFIX%ali_invite`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%ali_invite` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `uid` int(11) NULL,
 `alliance` int(11) NULL,
 `sender` int(11) NULL,
 `timestamp` int(11) NULL,
 `accept` int(1) NULL,
 PRIMARY KEY (`id`),
 KEY `alliance-accept` (`alliance`, `accept`),
 KEY `uid` (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `%PREFIX%ali_invite`
--


-- --------------------------------------------------------

--
-- Table structure for table `%PREFIX%ali_log`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%ali_log` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `aid` int(11) NULL,
 `comment` text NULL,
 `date` int(11) NULL,
 PRIMARY KEY (`id`),
 KEY `aid` (`aid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `%PREFIX%ali_log`
--


-- --------------------------------------------------------

--
-- Table structure for table `%PREFIX%ali_permission`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%ali_permission` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `uid` int(11) NULL,
 `alliance` int(11) NULL,
 `rank` varchar(100) NULL,
 `opt1` int(1) NULL DEFAULT '0',
 `opt2` int(1) NULL DEFAULT '0',
 `opt3` int(1) NULL DEFAULT '0',
 `opt4` int(1) NULL DEFAULT '0',
 `opt5` int(1) NULL DEFAULT '0',
 `opt6` int(1) NULL DEFAULT '0',
 `opt7` int(1) NULL DEFAULT '0',
 `opt8` int(1) NULL DEFAULT '0',
 PRIMARY KEY (`id`),
 UNIQUE KEY `uid-alliance` (`uid`, `alliance`) USING BTREE,
 KEY `alliance` (`alliance`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `%PREFIX%ali_permission`
--


-- --------------------------------------------------------

--
-- Table structure for table `%PREFIX%attacks`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%attacks` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `vref` int(11) NULL,
 `t1` int(11) NULL,
 `t2` int(11) NULL,
 `t3` int(11) NULL,
 `t4` int(11) NULL,
 `t5` int(11) NULL,
 `t6` int(11) NULL,
 `t7` int(11) NULL,
 `t8` int(11) NULL,
 `t9` int(11) NULL,
 `t10` int(11) NULL,
 `t11` int(11) NULL,
 `attack_type` tinyint(1) NULL,
 `ctar1` int(11) NULL, 
 `ctar2` int(11) NULL,
 `spy` int(11) NULL, 
 `b1` tinyint(1) NULL, 
 `b2` tinyint(1) NULL, 
 `b3` tinyint(1) NULL, 
 `b4` tinyint(1) NULL, 
 `b5` tinyint(1) NULL, 
 `b6` tinyint(1) NULL, 
 `b7` tinyint(1) NULL, 
 `b8` tinyint(1) NULL, 
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `%PREFIX%attacks`
--


-- --------------------------------------------------------

--
-- Table structure for table `%PREFIX%banlist`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%banlist` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `reason` varchar(30) DEFAULT NULL,
  `time` int(11) UNSIGNED DEFAULT NULL,
  `end` int(11) UNSIGNED DEFAULT NULL,
  `admin` int(11) DEFAULT NULL,
  `active` tinyint(1) UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `active-end` (`active`,`end`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `%PREFIX%banlist`
--


-- --------------------------------------------------------

--
-- Table structure for table `%PREFIX%bdata`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%bdata` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `wid` int(11) NULL,
 `field` tinyint(2) NULL,
 `type` tinyint(2) NULL,
 `loopcon` tinyint(1) NULL,
 `timestamp` int(11) NULL,
 `master` tinyint(1) NULL,
 `level` tinyint(3) NULL,
 PRIMARY KEY (`id`),
 KEY `master` (`master`),
 KEY `timestamp` (`timestamp`),
 KEY `master-timestamp` (`master`,`timestamp`) USING BTREE,
 KEY `wid` (`wid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `%PREFIX%bdata`
--


-- --------------------------------------------------------

--
-- Table structure for table `%PREFIX%build_log`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%build_log` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `wid` int(11) NULL,
 `log` text NULL,
 `date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `%PREFIX%build_log`
--


-- --------------------------------------------------------

--
-- Table structure for table `%PREFIX%chat`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%chat` (
 `id` int(20) NOT NULL AUTO_INCREMENT,
 `id_user` int(11) NULL,
 `name` varchar(255) NULL,
 `alli` varchar(255) NULL,
 `date` varchar(255) NULL,
 `msg` varchar(255) NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `%prefix%chat`
--


-- --------------------------------------------------------

--
-- Table structure for table `%prefix%config`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%config` (
 `lastgavemedal` int(11) NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
INSERT INTO `%PREFIX%config` VALUES (0);

--
-- Dumping data for table `%prefix%config`
--


-- --------------------------------------------------------

--
-- Table structure for table `%prefix%deleting`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%deleting` (
 `uid` int(11) NOT NULL,
 `timestamp` int(11) NULL,
 PRIMARY KEY (`uid`),
 KEY `timestamp` (`timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `%prefix%deleting`
--


-- --------------------------------------------------------

--
-- Table structure for table `%prefix%demolition`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%demolition` (
 `vref` int(11) NOT NULL,
 `buildnumber` int(11) NULL DEFAULT '0',
 `lvl` int(11) NULL DEFAULT '0',
 `timetofinish` int(11) NULL,
 PRIMARY KEY (`vref`),
 KEY `timetofinish` (`timetofinish`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `%prefix%demolition`
--


-- --------------------------------------------------------

--
-- Table structure for table `%prefix%diplomacy`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%diplomacy` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `alli1` int(11) NULL,
 `alli2` int(11) NULL,
 `type` tinyint(1) NULL,
 `accepted` tinyint(1) NULL,
 PRIMARY KEY (`id`),
 KEY `alli1` (`alli1`),
 KEY `alli2` (`alli2`),
 KEY `type-accepted` (`type`,`accepted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
--
-- Dumping data for table `%prefix%diplomacy`
--


-- --------------------------------------------------------

--
-- Table structure for table `%prefix%enforcement`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%enforcement` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `u1` int(11) NULL DEFAULT '0',
 `u2` int(11) NULL DEFAULT '0',
 `u3` int(11) NULL DEFAULT '0',
 `u4` int(11) NULL DEFAULT '0',
 `u5` int(11) NULL DEFAULT '0',
 `u6` int(11) NULL DEFAULT '0',
 `u7` int(11) NULL DEFAULT '0',
 `u8` int(11) NULL DEFAULT '0',
 `u9` int(11) NULL DEFAULT '0',
 `u10` int(11) NULL DEFAULT '0',
 `u11` int(11) NULL DEFAULT '0',
 `u12` int(11) NULL DEFAULT '0',
 `u13` int(11) NULL DEFAULT '0',
 `u14` int(11) NULL DEFAULT '0',
 `u15` int(11) NULL DEFAULT '0',
 `u16` int(11) NULL DEFAULT '0',
 `u17` int(11) NULL DEFAULT '0',
 `u18` int(11) NULL DEFAULT '0',
 `u19` int(11) NULL DEFAULT '0',
 `u20` int(11) NULL DEFAULT '0',
 `u21` int(11) NULL DEFAULT '0',
 `u22` int(11) NULL DEFAULT '0',
 `u23` int(11) NULL DEFAULT '0',
 `u24` int(11) NULL DEFAULT '0',
 `u25` int(11) NULL DEFAULT '0',
 `u26` int(11) NULL DEFAULT '0',
 `u27` int(11) NULL DEFAULT '0',
 `u28` int(11) NULL DEFAULT '0',
 `u29` int(11) NULL DEFAULT '0',
 `u30` int(11) NULL DEFAULT '0',
 `u31` int(11) NULL DEFAULT '0',
 `u32` int(11) NULL DEFAULT '0',
 `u33` int(11) NULL DEFAULT '0',
 `u34` int(11) NULL DEFAULT '0',
 `u35` int(11) NULL DEFAULT '0',
 `u36` int(11) NULL DEFAULT '0',
 `u37` int(11) NULL DEFAULT '0',
 `u38` int(11) NULL DEFAULT '0',
 `u39` int(11) NULL DEFAULT '0',
 `u40` int(11) NULL DEFAULT '0',
 `u41` int(11) NULL DEFAULT '0',
 `u42` int(11) NULL DEFAULT '0',
 `u43` int(11) NULL DEFAULT '0',
 `u44` int(11) NULL DEFAULT '0',
 `u45` int(11) NULL DEFAULT '0',
 `u46` int(11) NULL DEFAULT '0',
 `u47` int(11) NULL DEFAULT '0',
 `u48` int(11) NULL DEFAULT '0',
 `u49` int(11) NULL DEFAULT '0',
 `u50` int(11) NULL DEFAULT '0',
 `hero` tinyint(1) NULL DEFAULT '0',
 `from` int(11) NULL DEFAULT '0',
 `vref` int(11) NULL DEFAULT '0',
 PRIMARY KEY (`id`),
 KEY `vref` (`vref`),
 KEY `from` (`from`,`hero`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `%prefix%enforcement`
--

-- --------------------------------------------------------

--
-- Table structure for table `%prefix%farmlist`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%farmlist` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `wref` int(11) NULL,
 `owner` int(11) NULL,
 `name` varchar(100) NULL,
 PRIMARY KEY (`id`),
 KEY `wref` (`wref`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `%prefix%farmlist`
--


-- --------------------------------------------------------

--
-- Table structure for table `%prefix%fdata`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%fdata` (
 `vref` int(11) NOT NULL,
 `f1` tinyint(2) NULL DEFAULT '0',
 `f1t` tinyint(2) NULL DEFAULT '0',
 `f2` tinyint(2) NULL DEFAULT '0',
 `f2t` tinyint(2) NULL DEFAULT '0',
 `f3` tinyint(2) NULL DEFAULT '0',
 `f3t` tinyint(2) NULL DEFAULT '0',
 `f4` tinyint(2) NULL DEFAULT '0',
 `f4t` tinyint(2) NULL DEFAULT '0',
 `f5` tinyint(2) NULL DEFAULT '0',
 `f5t` tinyint(2) NULL DEFAULT '0',
 `f6` tinyint(2) NULL DEFAULT '0',
 `f6t` tinyint(2) NULL DEFAULT '0',
 `f7` tinyint(2) NULL DEFAULT '0',
 `f7t` tinyint(2) NULL DEFAULT '0',
 `f8` tinyint(2) NULL DEFAULT '0',
 `f8t` tinyint(2) NULL DEFAULT '0',
 `f9` tinyint(2) NULL DEFAULT '0',
 `f9t` tinyint(2) NULL DEFAULT '0',
 `f10` tinyint(2) NULL DEFAULT '0',
 `f10t` tinyint(2) NULL DEFAULT '0',
 `f11` tinyint(2) NULL DEFAULT '0',
 `f11t` tinyint(2) NULL DEFAULT '0',
 `f12` tinyint(2) NULL DEFAULT '0',
 `f12t` tinyint(2) NULL DEFAULT '0',
 `f13` tinyint(2) NULL DEFAULT '0',
 `f13t` tinyint(2) NULL DEFAULT '0',
 `f14` tinyint(2) NULL DEFAULT '0',
 `f14t` tinyint(2) NULL DEFAULT '0',
 `f15` tinyint(2) NULL DEFAULT '0',
 `f15t` tinyint(2) NULL DEFAULT '0',
 `f16` tinyint(2) NULL DEFAULT '0',
 `f16t` tinyint(2) NULL DEFAULT '0',
 `f17` tinyint(2) NULL DEFAULT '0',
 `f17t` tinyint(2) NULL DEFAULT '0',
 `f18` tinyint(2) NULL DEFAULT '0',
 `f18t` tinyint(2) NULL DEFAULT '0',
 `f19` tinyint(2) NULL DEFAULT '0',
 `f19t` tinyint(2) NULL DEFAULT '0',
 `f20` tinyint(2) NULL DEFAULT '0',
 `f20t` tinyint(2) NULL DEFAULT '0',
 `f21` tinyint(2) NULL DEFAULT '0',
 `f21t` tinyint(2) NULL DEFAULT '0',
 `f22` tinyint(2) NULL DEFAULT '0',
 `f22t` tinyint(2) NULL DEFAULT '0',
 `f23` tinyint(2) NULL DEFAULT '0',
 `f23t` tinyint(2) NULL DEFAULT '0',
 `f24` tinyint(2) NULL DEFAULT '0',
 `f24t` tinyint(2) NULL DEFAULT '0',
 `f25` tinyint(2) NULL DEFAULT '0',
 `f25t` tinyint(2) NULL DEFAULT '0',
 `f26` tinyint(2) NULL DEFAULT '0',
 `f26t` tinyint(2) NULL DEFAULT '0',
 `f27` tinyint(2) NULL DEFAULT '0',
 `f27t` tinyint(2) NULL DEFAULT '0',
 `f28` tinyint(2) NULL DEFAULT '0',
 `f28t` tinyint(2) NULL DEFAULT '0',
 `f29` tinyint(2) NULL DEFAULT '0',
 `f29t` tinyint(2) NULL DEFAULT '0',
 `f30` tinyint(2) NULL DEFAULT '0',
 `f30t` tinyint(2) NULL DEFAULT '0',
 `f31` tinyint(2) NULL DEFAULT '0',
 `f31t` tinyint(2) NULL DEFAULT '0',
 `f32` tinyint(2) NULL DEFAULT '0',
 `f32t` tinyint(2) NULL DEFAULT '0',
 `f33` tinyint(2) NULL DEFAULT '0',
 `f33t` tinyint(2) NULL DEFAULT '0',
 `f34` tinyint(2) NULL DEFAULT '0',
 `f34t` tinyint(2) NULL DEFAULT '0',
 `f35` tinyint(2) NULL DEFAULT '0',
 `f35t` tinyint(2) NULL DEFAULT '0',
 `f36` tinyint(2) NULL DEFAULT '0',
 `f36t` tinyint(2) NULL DEFAULT '0',
 `f37` tinyint(2) NULL DEFAULT '0',
 `f37t` tinyint(2) NULL DEFAULT '0',
 `f38` tinyint(2) NULL DEFAULT '0',
 `f38t` tinyint(2) NULL DEFAULT '0',
 `f39` tinyint(2) NULL DEFAULT '0',
 `f39t` tinyint(2) NULL DEFAULT '0',
 `f40` tinyint(2) NULL DEFAULT '0',
 `f40t` tinyint(2) NULL DEFAULT '0',
 `f99` tinyint(2) NULL DEFAULT '0',
 `f99t` tinyint(2) NULL DEFAULT '0',
 `wwname` varchar(100) NULL DEFAULT 'World Wonder',
 `ww_lastupdate` int(11) DEFAULT NULL,
 PRIMARY KEY (`vref`),
 KEY `f99` (`f99`),
 KEY `f99t` (`f99t`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `%prefix%fdata`
--


-- --------------------------------------------------------

--
-- Table structure for table `%prefix%forum_cat`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%forum_cat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sorting` int(11) NOT NULL,
  `owner` varchar(255) DEFAULT NULL,
  `alliance` int(11) NOT NULL,
  `forum_name` varchar(255) DEFAULT NULL,
  `forum_des` text,
  `forum_area` varchar(255) DEFAULT NULL,
  `display_to_alliances` text,
  `display_to_users` text,
  PRIMARY KEY (`id`),
  KEY `alliance-forum_area` (`alliance`,`forum_area`),
  KEY `display_to_alliances` (`display_to_alliances`(11)),
  KEY `display_to_users` (`display_to_users`(11)),
  KEY `sorting` (`sorting`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `%prefix%forum_cat`
--


-- --------------------------------------------------------

--
-- Table structure for table `%prefix%forum_edit`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%forum_edit` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `alliance` int(11) NOT NULL,
 `result` varchar(255) NULL,
 PRIMARY KEY (`id`),
 KEY `alliance` (`alliance`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `%prefix%forum_edit`
--


-- --------------------------------------------------------

--
-- Table structure for table `%prefix%forum_post`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%forum_post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post` longtext,
  `topic` int(11) NOT NULL,
  `owner` int(11) NOT NULL,
  `date` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
 KEY `topic-owner` (`topic`,`owner`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `%prefix%forum_post`
--


-- --------------------------------------------------------

--
-- Table structure for table `%prefix%forum_survey`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%forum_survey` (
 `topic` int(11) NULL,
 `title` varchar(255) NULL,
 `option1` varchar(255) NULL,
 `option2` varchar(255) NULL,
 `option3` varchar(255) NULL,
 `option4` varchar(255) NULL,
 `option5` varchar(255) NULL,
 `option6` varchar(255) NULL,
 `option7` varchar(255) NULL,
 `option8` varchar(255) NULL,
 `vote1` int(11) NULL DEFAULT '0',
 `vote2` int(11) NULL DEFAULT '0',
 `vote3` int(11) NULL DEFAULT '0',
 `vote4` int(11) NULL DEFAULT '0',
 `vote5` int(11) NULL DEFAULT '0',
 `vote6` int(11) NULL DEFAULT '0',
 `vote7` int(11) NULL DEFAULT '0',
 `vote8` int(11) NULL DEFAULT '0',
 `voted` text NULL,
 `ends` int(11) NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `%prefix%forum_survey`
--


-- --------------------------------------------------------

--
-- Table structure for table `%prefix%forum_topic`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%forum_topic` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `post` longtext,
  `date` int(11) NOT NULL,
  `post_date` int(11) NOT NULL,
  `cat` int(11) NOT NULL,
  `owner` int(11) NOT NULL,
  `alliance` int(11) NOT NULL,
  `ends` int(11) NOT NULL,
  `close` tinyint(4) NOT NULL,
  `stick` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cat-stick` (`cat`, `stick`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `%prefix%forum_topic`
--


-- --------------------------------------------------------

--
-- Table structure for table `%prefix%general`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%general` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `casualties` int(11) NULL,
 `time` int(11) NULL,
 `shown` tinyint(1) NULL,
 PRIMARY KEY (`id`),
 KEY `shown` (`shown`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `%prefix%general`
--


-- --------------------------------------------------------

--
-- Table structure for table `%prefix%gold_fin_log`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%gold_fin_log` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `wid` int(11) NULL,
 `log` text NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `%prefix%gold_fin_log`
--


-- --------------------------------------------------------

--
-- Table structure for table `%prefix%hero`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%hero` (
 `heroid` int(11) NOT NULL AUTO_INCREMENT,
 `uid` int(11) NULL,
 `unit` smallint(2) NULL,
 `name` tinytext NULL,
 `wref` int(11) NULL,
 `level` tinyint(3) NULL,
 `points` int(3) NULL,
 `experience` int(11) NULL,
 `dead` tinyint(1) NULL,
 `health` float(12,9) NULL,
 `attack` tinyint(3) NULL,
 `defence` tinyint(3) NULL,
 `attackbonus` tinyint(3) NULL,
 `defencebonus` tinyint(3) NULL,
 `regeneration` tinyint(3) NULL,
 `autoregen` int(2) NULL,
 `lastupdate` int(11) NULL,
 `trainingtime` int(11) NULL,
 `inrevive` tinyint(1) NULL,
 `intraining` tinyint(1) NULL,
 PRIMARY KEY (`heroid`),
 KEY `uid` (`uid`, `dead`) USING BTREE,
 KEY `lastupdate` (`lastupdate`),
 KEY `inrevive` (`inrevive`),
 KEY `intraining` (`intraining`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `%prefix%hero`
--



-- --------------------------------------------------------

--
-- Table structure for table `%prefix%illegal_log`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%illegal_log` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `user` int(11) NULL,
 `log` text NULL,
 `date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `%prefix%illegal_log`
--


-- --------------------------------------------------------

--
-- Table structure for table `%prefix%login_log`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%login_log` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `uid` int(11) NULL,
 `ip` varchar(15) NULL,
 `date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `%prefix%login_log`
--


-- --------------------------------------------------------

--
-- Table structure for table `%prefix%market`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%market` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `vref` int(11) NULL,
 `gtype` tinyint(1) NULL,
 `gamt` int(11) NULL,
 `wtype` tinyint(1) NULL,
 `wamt` int(11) NULL,
 `accept` tinyint(1) NULL,
 `maxtime` int(11) NULL,
 `alliance` int(11) NULL,
 `merchant` tinyint(2) NULL,
 PRIMARY KEY (`id`),
 KEY `vref-accept-merchant` (`vref`,`accept`,`merchant`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `%prefix%market`
--


-- --------------------------------------------------------

--
-- Table structure for table `%prefix%market_log`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%market_log` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `wid` int(11) NULL,
 `log` text NULL,
 `date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `%prefix%market_log`
--


-- --------------------------------------------------------

--
-- Table structure for table `%prefix%mdata`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%mdata` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `target` int(11) NULL,
 `owner` int(11) NULL,
 `topic` varchar(100) NULL,
 `message` text NULL,
 `viewed` tinyint(1) NULL,
 `archived` tinyint(1) NULL,
 `send` tinyint(1) NULL,
 `time` int(11) NULL DEFAULT '0',
 `deltarget` int(11) NULL,
 `delowner` int(11) NULL,
 `alliance` int(11) NULL,
 `player` int(11) NULL,
 `coor` int(11) NULL,
 `report` int(11) NULL,
 PRIMARY KEY (`id`),
 KEY `target-time` (`target`,`time`) USING BTREE,
 KEY `owner` (`owner`),
 KEY `target-viewed` (`target`,`viewed`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `%prefix%mdata`
--


-- --------------------------------------------------------

--
-- Table structure for table `%prefix%medal`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%medal` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `userid` int(11) NULL,
 `categorie` int(11) NULL,
 `plaats` int(11) NULL,
 `week` int(11) NULL,
 `points` varchar(15) NULL,
 `img` varchar(10) NULL,
 `del` tinyint(1) NULL DEFAULT '0',
 PRIMARY KEY (`id`),
 KEY `week` (`week`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `%prefix%medal`
--


-- --------------------------------------------------------

--
-- Table structure for table `%prefix%movement`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%movement` (
  `moveid` int(11) NOT NULL AUTO_INCREMENT,
  `sort_type` tinyint(4) DEFAULT '0',
  `from` int(11) DEFAULT '0',
  `to` int(11) DEFAULT '0',
  `ref` int(11) DEFAULT '0',
  `ref2` int(11) DEFAULT '0',
  `starttime` int(11) DEFAULT '0',
  `endtime` int(11) DEFAULT '0',
  `proc` tinyint(1) DEFAULT '0',
  `send` tinyint(1) DEFAULT NULL,
  `wood` int(11) DEFAULT NULL,
  `clay` int(11) DEFAULT NULL,
  `iron` int(11) DEFAULT NULL,
  `crop` int(11) DEFAULT NULL,
  PRIMARY KEY (`moveid`),
  KEY `ref` (`ref`),
  KEY `from-proc-sort_type` (`from`,`proc`,`sort_type`),
  KEY `proc-sort_type-endtime` (`proc`,`sort_type`,`endtime`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `%prefix%movement`
--


-- --------------------------------------------------------

--
-- Table structure for table `%prefix%ndata`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%ndata` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `uid` int(11) NULL,
 `toWref` int(11) NULL,
 `ally` int(11) NULL,
 `topic` text NULL,
 `ntype` tinyint(1) NULL,
 `data` text NULL,
 `time` int(11) NULL,
 `viewed` tinyint(1) NULL,
 `archive` tinyint(1) NULL DEFAULT '0',
 `del` tinyint(1) NULL DEFAULT '0',
 PRIMARY KEY (`id`),
 KEY `time` (`time`),
 KEY `uid-time` (`uid`,`time`) USING BTREE,
 KEY `del` (`del`),
 KEY `toWref` (`toWref`),
 KEY `uid-viewed` (`uid`,`viewed`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `%prefix%ndata`
--


-- --------------------------------------------------------

--
-- Table structure for table `%prefix%odata`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%odata` (
 `wref` int(11) NOT NULL,
 `type` tinyint(2) NULL,
 `conqured` int(11) NULL,
 `wood` int(11) NULL,
 `iron` int(11) NULL,
 `clay` int(11) NULL,
 `maxstore` int(11) NULL,
 `crop` int(11) NULL,
 `maxcrop` int(11) NULL,
 `lastupdated` int(11) NULL,
 `lastupdated2` int(11) NULL,
 `loyalty` float(9,6) NULL DEFAULT '100',
 `owner` int(11) NULL DEFAULT '2',
 `name` varchar(32) NULL DEFAULT 'Unoccupied Oasis',
 `high` tinyint(1) NULL,
 PRIMARY KEY (`wref`),
 KEY `lastupdated2` (`lastupdated2`) USING BTREE,
 KEY `conqured` (`conqured`),
 KEY `wood` (`wood`),
 KEY `iron` (`iron`),
 KEY `clay` (`clay`),
 KEY `crop` (`crop`),
 KEY `loyalty` (`loyalty`),
 KEY `maxcrop` (`maxcrop`),
 KEY `maxstore` (`maxstore`),
 KEY `owner` (`owner`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `%prefix%odata`
--


-- --------------------------------------------------------

--
-- Table structure for table `%prefix%online`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%online` (
 `name` varchar(32) NULL,
 `uid` int(11) NULL,
 `time` varchar(32) NULL,
 `sit` tinyint(1) NULL,
 UNIQUE KEY `name` (`name`),
 KEY `uid` (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `%prefix%online`
--

-- --------------------------------------------------------

--
-- Table structure for table `%PREFIX%prisoners`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%prisoners` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `wref` int(11) NULL,
 `from` int(11) NULL,
 `t1` int(11) NULL,
 `t2` int(11) NULL,
 `t3` int(11) NULL,
 `t4` int(11) NULL,
 `t5` int(11) NULL,
 `t6` int(11) NULL,
 `t7` int(11) NULL,
 `t8` int(11) NULL,
 `t9` int(11) NULL,
 `t10` int(11) NULL,
 `t11` int(11) NULL,
 PRIMARY KEY (`id`),
 KEY `wref` (`wref`),
 KEY `from` (`from`,`t11`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `%PREFIX%prisoners`
--


-- --------------------------------------------------------

--
-- Table structure for table `%prefix%raidlist`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%raidlist` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `lid` int(11) NULL,
 `towref` int(11) NULL,
 `x` int(11) NULL,
 `y` int(11) NULL,
 `distance` FLOAT NULL DEFAULT '0',
 `t1` int(11) NULL,
 `t2` int(11) NULL,
 `t3` int(11) NULL,
 `t4` int(11) NULL,
 `t5` int(11) NULL,
 `t6` int(11) NULL,
 PRIMARY KEY (`id`),
 KEY `lid-distance` (`lid`, `distance`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `%prefix%raidlist`
--


-- --------------------------------------------------------

--
-- Table structure for table `%prefix%research`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%research` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `vref` int(11) NULL,
 `tech` varchar(3) NULL,
 `timestamp` int(11) NULL,
 PRIMARY KEY (`id`),
 KEY `vref` (`vref`),
 KEY `timestamp` (`timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `%prefix%research`
--


-- --------------------------------------------------------

--
-- Table structure for table `%prefix%route`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%route` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `uid` int(11) NULL,
 `wid` int(11) NULL,
 `from` int(11) NULL,
 `wood` int(5) NULL,
 `clay` int(5) NULL,
 `iron` int(5) NULL,
 `crop` int(5) NULL,
 `start` tinyint(2) NULL,
 `deliveries` tinyint(1) NULL,
 `merchant` int(11) NULL,
 `timestamp` int(11) NULL,
 `timeleft` int(11) NULL,
 PRIMARY KEY (`id`),
 KEY `uid` (`uid`),
 KEY `wid` (`wid`),
 KEY `timestamp` (`timestamp`),
 KEY `timeleft` (`timeleft`),
 KEY `uid-timestamp` (`uid`, `timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `%prefix%route`
--


-- --------------------------------------------------------

--
-- Table structure for table `%prefix%send`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%send` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `wood` int(11) NULL,
 `clay` int(11) NULL,
 `iron` int(11) NULL,
 `crop` int(11) NULL,
 `merchant` tinyint(2) NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `%prefix%send`
--


-- --------------------------------------------------------

--
-- Table structure for table `%prefix%tdata`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%tdata` (
 `vref` int(11) NOT NULL,
 `t2` tinyint(1) NULL DEFAULT '0',
 `t3` tinyint(1) NULL DEFAULT '0',
 `t4` tinyint(1) NULL DEFAULT '0',
 `t5` tinyint(1) NULL DEFAULT '0',
 `t6` tinyint(1) NULL DEFAULT '0',
 `t7` tinyint(1) NULL DEFAULT '0',
 `t8` tinyint(1) NULL DEFAULT '0',
 `t9` tinyint(1) NULL DEFAULT '0',
 `t12` tinyint(1) NULL DEFAULT '0',
 `t13` tinyint(1) NULL DEFAULT '0',
 `t14` tinyint(1) NULL DEFAULT '0',
 `t15` tinyint(1) NULL DEFAULT '0',
 `t16` tinyint(1) NULL DEFAULT '0',
 `t17` tinyint(1) NULL DEFAULT '0',
 `t18` tinyint(1) NULL DEFAULT '0',
 `t19` tinyint(1) NULL DEFAULT '0',
 `t22` tinyint(1) NULL DEFAULT '0',
 `t23` tinyint(1) NULL DEFAULT '0',
 `t24` tinyint(1) NULL DEFAULT '0',
 `t25` tinyint(1) NULL DEFAULT '0',
 `t26` tinyint(1) NULL DEFAULT '0',
 `t27` tinyint(1) NULL DEFAULT '0',
 `t28` tinyint(1) NULL DEFAULT '0',
 `t29` tinyint(1) NULL DEFAULT '0',
 `t32` tinyint(1) NULL DEFAULT '0',
 `t33` tinyint(1) NULL DEFAULT '0',
 `t34` tinyint(1) NULL DEFAULT '0',
 `t35` tinyint(1) NULL DEFAULT '0',
 `t36` tinyint(1) NULL DEFAULT '0',
 `t37` tinyint(1) NULL DEFAULT '0',
 `t38` tinyint(1) NULL DEFAULT '0',
 `t39` tinyint(1) NULL DEFAULT '0',
 `t42` tinyint(1) NULL DEFAULT '0',
 `t43` tinyint(1) NULL DEFAULT '0',
 `t44` tinyint(1) NULL DEFAULT '0',
 `t45` tinyint(1) NULL DEFAULT '0',
 `t46` tinyint(1) NULL DEFAULT '0',
 `t47` tinyint(1) NULL DEFAULT '0',
 `t48` tinyint(1) NULL DEFAULT '0',
 `t49` tinyint(1) NULL DEFAULT '0',
 PRIMARY KEY (`vref`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `%prefix%tdata`
--


-- --------------------------------------------------------

--
-- Table structure for table `%prefix%tech_log`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%tech_log` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `wid` int(11) NULL,
 `log` text NULL,
 `date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `%prefix%tech_log`
--


-- --------------------------------------------------------

--
-- Table structure for table `%prefix%training`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%training` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `vref` int(11) NULL,
 `unit` tinyint(2) NULL,
 `amt` int(11) NULL,
 `pop` int(11) NULL,
 `timestamp` int(11) NULL,
 `eachtime` int(11) NULL,
 `timestamp2` int(11) NULL,
 PRIMARY KEY (`id`),
 KEY `vref` (`vref`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `%prefix%training`
--


-- --------------------------------------------------------

--
-- Table structure for table `%prefix%units`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%units` (
 `vref` int(11) NOT NULL,
 `u1` int(11) NULL DEFAULT '0',
 `u2` int(11) NULL DEFAULT '0',
 `u3` int(11) NULL DEFAULT '0',
 `u4` int(11) NULL DEFAULT '0',
 `u5` int(11) NULL DEFAULT '0',
 `u6` int(11) NULL DEFAULT '0',
 `u7` int(11) NULL DEFAULT '0',
 `u8` int(11) NULL DEFAULT '0',
 `u9` int(11) NULL DEFAULT '0',
 `u10` int(11) NULL DEFAULT '0',
 `u11` int(11) NULL DEFAULT '0',
 `u12` int(11) NULL DEFAULT '0',
 `u13` int(11) NULL DEFAULT '0',
 `u14` int(11) NULL DEFAULT '0',
 `u15` int(11) NULL DEFAULT '0',
 `u16` int(11) NULL DEFAULT '0',
 `u17` int(11) NULL DEFAULT '0',
 `u18` int(11) NULL DEFAULT '0',
 `u19` int(11) NULL DEFAULT '0',
 `u20` int(11) NULL DEFAULT '0',
 `u21` int(11) NULL DEFAULT '0',
 `u22` int(11) NULL DEFAULT '0',
 `u23` int(11) NULL DEFAULT '0',
 `u24` int(11) NULL DEFAULT '0',
 `u25` int(11) NULL DEFAULT '0',
 `u26` int(11) NULL DEFAULT '0',
 `u27` int(11) NULL DEFAULT '0',
 `u28` int(11) NULL DEFAULT '0',
 `u29` int(11) NULL DEFAULT '0',
 `u30` int(11) NULL DEFAULT '0',
 `u31` int(11) NULL DEFAULT '0',
 `u32` int(11) NULL DEFAULT '0',
 `u33` int(11) NULL DEFAULT '0',
 `u34` int(11) NULL DEFAULT '0',
 `u35` int(11) NULL DEFAULT '0',
 `u36` int(11) NULL DEFAULT '0',
 `u37` int(11) NULL DEFAULT '0',
 `u38` int(11) NULL DEFAULT '0',
 `u39` int(11) NULL DEFAULT '0',
 `u40` int(11) NULL DEFAULT '0',
 `u41` int(11) NULL DEFAULT '0',
 `u42` int(11) NULL DEFAULT '0',
 `u43` int(11) NULL DEFAULT '0',
 `u44` int(11) NULL DEFAULT '0',
 `u45` int(11) NULL DEFAULT '0',
 `u46` int(11) NULL DEFAULT '0',
 `u47` int(11) NULL DEFAULT '0',
 `u48` int(11) NULL DEFAULT '0',
 `u49` int(11) NULL DEFAULT '0',
 `u50` int(11) NULL DEFAULT '0',
 `u99` int(11) NULL DEFAULT '0',
 `u99o` int(11) NULL DEFAULT '0',
 `hero` int(11) NULL DEFAULT '0',
 PRIMARY KEY (`vref`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `%prefix%units`
--


-- --------------------------------------------------------

--
-- Table structure for table `%PREFIX%users`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%users` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `tribe` tinyint(1) DEFAULT NULL,
  `access` tinyint(1) DEFAULT '1',
  `gold` int(9) DEFAULT '0',
  `gender` tinyint(1) DEFAULT '0',
  `birthday` date DEFAULT '1970-01-01',
  `location` text,
  `desc1` text,
  `desc2` text,
  `plus` int(11) DEFAULT '0',
  `goldclub` int(11) DEFAULT '0',
  `b1` int(11) DEFAULT '0',
  `b2` int(11) DEFAULT '0',
  `b3` int(11) DEFAULT '0',
  `b4` int(11) DEFAULT '0',
  `sit1` int(11) DEFAULT '0',
  `sit2` int(11) DEFAULT '0',
  `alliance` int(11) DEFAULT '0',
  `sessid` varchar(100) DEFAULT NULL,
  `act` varchar(10) DEFAULT NULL,
  `timestamp` int(11) DEFAULT '0',
  `ap` int(11) DEFAULT '0',
  `apall` int(11) DEFAULT '0',
  `dp` int(11) DEFAULT '0',
  `dpall` int(11) DEFAULT '0',
  `protect` int(11) DEFAULT NULL,
  `quest` tinyint(2) DEFAULT NULL,
  `quest_time` int(11) DEFAULT NULL,
  `gpack` varchar(255) DEFAULT '/gpack/travian_default/',
  `cp` float(14,5) DEFAULT '1.00000',
  `lastupdate` int(11) DEFAULT NULL,
  `RR` int(255) DEFAULT '0',
  `Rc` int(255) DEFAULT '0',
  `ok` tinyint(1) DEFAULT '0',
  `clp` bigint(255) DEFAULT '0',
  `oldrank` bigint(255) DEFAULT '0',
  `regtime` int(11) DEFAULT '0',
  `invited` int(11) DEFAULT '0',
  `friend0` int(11) DEFAULT '0',
  `friend1` int(11) DEFAULT '0',
  `friend2` int(11) DEFAULT '0',
  `friend3` int(11) DEFAULT '0',
  `friend4` int(11) DEFAULT '0',
  `friend5` int(11) DEFAULT '0',
  `friend6` int(11) DEFAULT '0',
  `friend7` int(11) DEFAULT '0',
  `friend8` int(11) DEFAULT '0',
  `friend9` int(11) DEFAULT '0',
  `friend10` int(11) DEFAULT '0',
  `friend11` int(11) DEFAULT '0',
  `friend12` int(11) DEFAULT '0',
  `friend13` int(11) DEFAULT '0',
  `friend14` int(11) DEFAULT '0',
  `friend15` int(11) DEFAULT '0',
  `friend16` int(11) DEFAULT '0',
  `friend17` int(11) DEFAULT '0',
  `friend18` int(11) DEFAULT '0',
  `friend19` int(11) DEFAULT '0',
  `friend0wait` int(11) DEFAULT '0',
  `friend1wait` int(11) DEFAULT '0',
  `friend2wait` int(11) DEFAULT '0',
  `friend3wait` int(11) DEFAULT '0',
  `friend4wait` int(11) DEFAULT '0',
  `friend5wait` int(11) DEFAULT '0',
  `friend6wait` int(11) DEFAULT '0',
  `friend7wait` int(11) DEFAULT '0',
  `friend8wait` int(11) DEFAULT '0',
  `friend9wait` int(11) DEFAULT '0',
  `friend10wait` int(11) DEFAULT '0',
  `friend11wait` int(11) DEFAULT '0',
  `friend12wait` int(11) DEFAULT '0',
  `friend13wait` int(11) DEFAULT '0',
  `friend14wait` int(11) DEFAULT '0',
  `friend15wait` int(11) DEFAULT '0',
  `friend16wait` int(11) DEFAULT '0',
  `friend17wait` int(11) DEFAULT '0',
  `friend18wait` int(11) DEFAULT '0',
  `friend19wait` int(11) DEFAULT '0',
  `maxevasion` mediumint(3) DEFAULT '0',
  `village_select` bigint(20) DEFAULT NULL,
  `vac_time` varchar(255) DEFAULT '0',
  `vac_mode` int(2) DEFAULT '0',
  `vactwoweeks` varchar(255) DEFAULT '0',
  `is_bcrypt` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `username` (`username`),
  KEY `invited` (`invited`),
  KEY `lastupdate` (`lastupdate`),
  KEY `alliance` (`alliance`),
  KEY `tribe` (`tribe`),
  KEY `timestamp-tribe` (`timestamp`,`tribe`),
  KEY `access` (`access`),
  KEY `sit1` (`sit1`),
  KEY `sit2` (`sit2`),
  KEY `gold` (`gold`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `%prefix%users`
--

INSERT INTO `%PREFIX%users` (`id`, `username`, `password`, `email`, `tribe`, `access`, `gold`, `gender`, `birthday`, `location`, `desc1`, `desc2`, `plus`, `b1`, `b2`, `b3`, `b4`, `sit1`, `sit2`, `alliance`, `sessid`, `act`, `timestamp`, `ap`, `apall`, `dp`, `dpall`, `protect`, `quest`, `gpack`, `cp`, `lastupdate`, `RR`, `Rc`, `ok`, `is_bcrypt`) VALUES
(1, 'Support', '', 'support@travianz.game', 0, 8, 0, 0, '1970-01-01', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '', '', 0, 0, 0, 0, 0, 0, 0, '/gpack/travian_default/', 1, 0, 0, 0, 0, 1),
(2, 'Nature', '', 'nature@travianz.game', 4, 2, 0, 0, '1970-01-01', '', '[#NATURE]', '', 0, 0, 0, 0, 0, 0, 0, 0, '', '', 0, 0, 0, 0, 0, 0, 0, '/gpack/travian_default/', 1, 0, 0, 0, 0, 1),
(4, 'Taskmaster', '', 'taskmaster@travianz.game', 0, 8, 0, 0, '1970-01-01', '', '[#TASKMASTER]', '', 0, 0, 0, 0, 0, 0, 0, 0, '', '', 0, 0, 0, 0, 0, 0, 0, '/gpack/travian_default/', 1, 0, 0, 0, 0, 1),
(5, 'Multihunter', '', 'multihunter@travianz.game', 1, 9, 0, 0, '1970-01-01', '', '[#MH]', '[#MULTIHUNTER]', 0, 0, 0, 0, 0, 0, 0, 0, '', '', 0, 0, 0, 0, 0, 0, 0, '/gpack/travian_default/', 1, 0, 0, 0, 0, 1);

ALTER TABLE `%PREFIX%users` AUTO_INCREMENT=6;

-- --------------------------------------------------------

--
-- Table structure for table `%prefix%vdata`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%vdata` (
`wref` int(11) NOT NULL,
`owner` int(11) NULL,
`name` varchar(100) NULL,
`capital` tinyint(1) NULL,
`pop` int(11) NULL,
`cp` int(11) NULL,
`celebration` int(11) NULL DEFAULT '0',
`type` int(11) NULL DEFAULT '0',
`wood` float(12,2) NULL,
`clay` float(12,2) NULL,
`iron` float(12,2) NULL,
`maxstore` int(11) NULL,
`crop` float(12,2) NULL,
`maxcrop` int(11) NULL,
`lastupdate` int(11) NULL,
`lastupdate2` int(11) NULL DEFAULT '0', 
`loyalty` float(9,6) NULL DEFAULT '100',
`exp1` int(11) NULL DEFAULT '0',
`exp2` int(11) NULL DEFAULT '0',
`exp3` int(11) NULL DEFAULT '0',
`created` int(11) NULL,
`natar` tinyint(1) NULL DEFAULT '0',
`starv` int(11) NULL DEFAULT '0',
`starvupdate` int(11) NULL DEFAULT '0',
`evasion` tinyint(1) NULL DEFAULT '0',
PRIMARY KEY (`wref`),
KEY `owner-capital-pop` (`owner`,`capital`,`pop`),
KEY `maxstore` (`maxstore`),
KEY `maxcrop` (`maxcrop`),
KEY `celebration` (`celebration`),
KEY `wood` (`wood`),
KEY `clay` (`clay`),
KEY `iron` (`iron`),
KEY `crop` (`crop`),
KEY `starv` (`starv`),
KEY `loyalty` (`loyalty`),
KEY `exp1` (`exp1`),
KEY `exp2` (`exp2`),
KEY `exp3` (`exp3`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `%prefix%vdata`
--


-- --------------------------------------------------------

--
-- Table structure for table `%prefix%wdata`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%wdata` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `fieldtype` tinyint(2) NULL,
 `oasistype` tinyint(2) NULL,
 `x` int(11) NULL,
 `y` int(11) NULL,
 `occupied` tinyint(1) NULL,
 `image` varchar(3) NULL,
 PRIMARY KEY (`id`),
 KEY `occupied` (`occupied`),
 KEY `fieldtype` (`fieldtype`),
 KEY `x-y` (`x`, `y`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `%prefix%wdata`
--

-- --------------------------------------------------------
--
-- Table structure for table `%prefix%password`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%password` (
 `uid` int(11) NOT NULL,
 `npw` varchar(100) NULL,
 `cpw` varchar(100) NULL,
 `used` tinyint(1) NULL DEFAULT '0',
 `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
 PRIMARY KEY (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ;

--
-- Dumping data for table `%prefix%password`
--

-- --------------------------------------------------------
--
-- Table structure for table `%prefix%ww_attacks`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%ww_attacks` (
  `vid` int(25) DEFAULT NULL,
  `attack_time` int(11) DEFAULT NULL,
  KEY `attack_time` (`attack_time`),
  KEY `vid` (`vid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ;

--
-- Dumping data for table `%prefix%ww_attacks`
--

-- --------------------------------------------------------
--
-- Table structure for table `%prefix%croppers`
--

CREATE TABLE IF NOT EXISTS %PREFIX%croppers (
	wref INT UNSIGNED NOT NULL PRIMARY KEY,
	x INT NOT NULL,
	y INT NOT NULL,
	fieldtype TINYINT UNSIGNED NOT NULL, -- 1 = 9c, 6 = 15c
	best_oasis_bonus TINYINT UNSIGNED NOT NULL, -- 0,25,50,75,100,125,150
	updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	CHECK (best_oasis_bonus IN (0,25,50,75,100,125,150))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE INDEX idx_ft_bonus_xy ON %PREFIX%croppers (fieldtype, best_oasis_bonus, x, y);
CREATE INDEX idx_xy ON %PREFIX%croppers (x, y);
CREATE INDEX idx_bonus ON %PREFIX%croppers (best_oasis_bonus);

--
-- Dumping data for table `%prefix%croppers`
--