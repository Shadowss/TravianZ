-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 21, 2018 at 2:16 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.0.31

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

-- --------------------------------------------------------

--
-- Table structure for table `%PREFIX%a2b`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%a2b` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ckey` char(10) NOT NULL DEFAULT '0',
  `from` int(11) NOT NULL DEFAULT '0',
  `to` int(11) NOT NULL DEFAULT '0',
  `u1` int(11) NOT NULL DEFAULT '0',
  `u2` int(11) NOT NULL DEFAULT '0',
  `u3` int(11) NOT NULL DEFAULT '0',
  `u4` int(11) NOT NULL DEFAULT '0',
  `u5` int(11) NOT NULL DEFAULT '0',
  `u6` int(11) NOT NULL DEFAULT '0',
  `u7` int(11) NOT NULL DEFAULT '0',
  `u8` int(11) NOT NULL DEFAULT '0',
  `u9` int(11) NOT NULL DEFAULT '0',
  `u10` int(11) NOT NULL DEFAULT '0',
  `u11` int(11) NOT NULL DEFAULT '0',
  `type` smallint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `ckey` (`ckey`),
  KEY `from` (`from`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `%PREFIX%abdata`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%abdata` (
  `vref` int(11) NOT NULL,
  `a1` tinyint(2) DEFAULT '0',
  `a2` tinyint(2) DEFAULT '0',
  `a3` tinyint(2) DEFAULT '0',
  `a4` tinyint(2) DEFAULT '0',
  `a5` tinyint(2) DEFAULT '0',
  `a6` tinyint(2) DEFAULT '0',
  `a7` tinyint(2) DEFAULT '0',
  `a8` tinyint(2) DEFAULT '0',
  `b1` tinyint(2) DEFAULT '0',
  `b2` tinyint(2) DEFAULT '0',
  `b3` tinyint(2) DEFAULT '0',
  `b4` tinyint(2) DEFAULT '0',
  `b5` tinyint(2) DEFAULT '0',
  `b6` tinyint(2) DEFAULT '0',
  `b7` tinyint(2) DEFAULT '0',
  `b8` tinyint(2) DEFAULT '0',
  PRIMARY KEY (`vref`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `invite` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `%PREFIX%alidata`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%alidata` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `tag` varchar(100) DEFAULT NULL,
  `leader` int(11) DEFAULT NULL,
  `coor` int(11) DEFAULT NULL,
  `advisor` int(11) DEFAULT NULL,
  `recruiter` int(11) DEFAULT NULL,
  `notice` text,
  `desc` text,
  `max` tinyint(2) DEFAULT NULL,
  `ap` bigint(255) DEFAULT '0',
  `dp` bigint(255) DEFAULT '0',
  `Rc` bigint(255) DEFAULT '0',
  `RR` bigint(255) DEFAULT '0',
  `Aap` bigint(255) DEFAULT '0',
  `Adp` bigint(255) DEFAULT '0',
  `clp` bigint(255) DEFAULT '0',
  `oldrank` bigint(255) DEFAULT '0',
  `forumlink` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tag` (`tag`),
  KEY `name` (`name`),
  KEY `leader` (`leader`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `%PREFIX%ali_invite`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%ali_invite` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `alliance` int(11) DEFAULT NULL,
  `sender` int(11) DEFAULT NULL,
  `timestamp` int(11) DEFAULT NULL,
  `accept` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `alliance-accept` (`alliance`,`accept`),
  KEY `uid` (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `%PREFIX%ali_permission`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%ali_permission` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `alliance` int(11) DEFAULT NULL,
  `rank` varchar(100) DEFAULT NULL,
  `opt1` int(1) DEFAULT '0',
  `opt2` int(1) DEFAULT '0',
  `opt3` int(1) DEFAULT '0',
  `opt4` int(1) DEFAULT '0',
  `opt5` int(1) DEFAULT '0',
  `opt6` int(1) DEFAULT '0',
  `opt7` int(1) DEFAULT '0',
  `opt8` int(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uid-alliance` (`uid`,`alliance`) USING BTREE,
  KEY `alliance` (`alliance`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `%PREFIX%allimedal`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%allimedal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `allyid` int(11) DEFAULT NULL,
  `categorie` int(11) DEFAULT NULL,
  `plaats` int(11) DEFAULT NULL,
  `week` int(11) DEFAULT NULL,
  `points` bigint(255) DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL,
  `del` tinyint(1) DEFAULT '0',
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
  `vref` int(11) DEFAULT NULL,
  `owner` int(11) DEFAULT NULL,
  `type` tinyint(2) DEFAULT NULL,
  `size` tinyint(1) DEFAULT NULL,
  `conquered` int(11) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `desc` text,
  `effect` varchar(100) DEFAULT NULL,
  `img` varchar(20) DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  `kind` tinyint(1) DEFAULT '0',
  `bad_effect` tinyint(1) DEFAULT '0',
  `effect2` tinyint(2) DEFAULT '0',
  `lastupdate` int(11) DEFAULT '0',
  `del` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `owner-active` (`owner`,`active`),
  KEY `vref-type-kind` (`vref`,`type`,`kind`) USING BTREE,
  KEY `active-type-lastupdate` (`active`,`type`,`lastupdate`),
  KEY `size-type` (`size`,`type`),
  KEY `active-owner-conquered-del` (`active`,`owner`,`conquered`,`del`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `%PREFIX%artefacts_chrono`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%artefacts_chrono` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `artefactid` int(11) DEFAULT NULL,
  `uid` int(11) DEFAULT NULL,
  `vref` int(11) DEFAULT NULL,
  `conqueredtime` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `artefactid-conqueredtime` (`artefactid`,`conqueredtime`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `%PREFIX%attacks`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%attacks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vref` int(11) DEFAULT '0',
  `u1` int(11) DEFAULT '0',
  `u2` int(11) DEFAULT '0',
  `u3` int(11) DEFAULT '0',
  `u4` int(11) DEFAULT '0',
  `u5` int(11) DEFAULT '0',
  `u6` int(11) DEFAULT '0',
  `u7` int(11) DEFAULT '0',
  `u8` int(11) DEFAULT '0',
  `u9` int(11) DEFAULT '0',
  `u10` int(11) DEFAULT '0',
  `u11` int(11) DEFAULT '0',
  `ctar1` int(11) DEFAULT '0',
  `ctar2` int(11) DEFAULT '0',
  `spy` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

-- --------------------------------------------------------

--
-- Table structure for table `%PREFIX%bdata`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%bdata` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `wid` int(11) NOT NULL DEFAULT '0',
  `field` tinyint(2) NOT NULL DEFAULT '0',
  `type` tinyint(2) NOT NULL DEFAULT '0',
  `timestamp` int(11) NOT NULL DEFAULT '0',
  `level` tinyint(3) NOT NULL DEFAULT '0',
  `sort` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `master` (`sort`),
  KEY `timestamp` (`timestamp`),
  KEY `master-timestamp` (`sort`,`timestamp`) USING BTREE,
  KEY `wid` (`wid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `%PREFIX%chat`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%chat` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `alli` varchar(255) DEFAULT NULL,
  `date` varchar(255) DEFAULT NULL,
  `msg` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `%PREFIX%config`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%config` (
  `lastgavemedal` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
INSERT INTO `%PREFIX%config` VALUES (0);

-- --------------------------------------------------------

--
-- Table structure for table `%PREFIX%deleting`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%deleting` (
  `uid` int(11) NOT NULL,
  `timestamp` int(11) DEFAULT NULL,
  PRIMARY KEY (`uid`),
  KEY `timestamp` (`timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `%PREFIX%diplomacy`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%diplomacy` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `alli1` int(11) DEFAULT NULL,
  `alli2` int(11) DEFAULT NULL,
  `type` tinyint(1) DEFAULT NULL,
  `accepted` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `alli1` (`alli1`),
  KEY `alli2` (`alli2`),
  KEY `type-accepted` (`type`,`accepted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `%PREFIX%enforcement`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%enforcement` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `u1` int(11) DEFAULT '0',
  `u2` int(11) DEFAULT '0',
  `u3` int(11) DEFAULT '0',
  `u4` int(11) DEFAULT '0',
  `u5` int(11) DEFAULT '0',
  `u6` int(11) DEFAULT '0',
  `u7` int(11) DEFAULT '0',
  `u8` int(11) DEFAULT '0',
  `u9` int(11) DEFAULT '0',
  `u10` int(11) DEFAULT '0',
  `u11` int(11) DEFAULT '0',
  `from` int(11) DEFAULT '0',
  `vref` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `vref` (`vref`),
  KEY `from` (`from`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `%PREFIX%farmlist`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%farmlist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `from` int(11) DEFAULT NULL,
  `owner` int(11) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `wref` (`from`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `%PREFIX%fdata`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%fdata` (
  `vref` int(11) NOT NULL,
  `f1` tinyint(2) DEFAULT '0',
  `f1t` tinyint(2) DEFAULT '0',
  `f2` tinyint(2) DEFAULT '0',
  `f2t` tinyint(2) DEFAULT '0',
  `f3` tinyint(2) DEFAULT '0',
  `f3t` tinyint(2) DEFAULT '0',
  `f4` tinyint(2) DEFAULT '0',
  `f4t` tinyint(2) DEFAULT '0',
  `f5` tinyint(2) DEFAULT '0',
  `f5t` tinyint(2) DEFAULT '0',
  `f6` tinyint(2) DEFAULT '0',
  `f6t` tinyint(2) DEFAULT '0',
  `f7` tinyint(2) DEFAULT '0',
  `f7t` tinyint(2) DEFAULT '0',
  `f8` tinyint(2) DEFAULT '0',
  `f8t` tinyint(2) DEFAULT '0',
  `f9` tinyint(2) DEFAULT '0',
  `f9t` tinyint(2) DEFAULT '0',
  `f10` tinyint(2) DEFAULT '0',
  `f10t` tinyint(2) DEFAULT '0',
  `f11` tinyint(2) DEFAULT '0',
  `f11t` tinyint(2) DEFAULT '0',
  `f12` tinyint(2) DEFAULT '0',
  `f12t` tinyint(2) DEFAULT '0',
  `f13` tinyint(2) DEFAULT '0',
  `f13t` tinyint(2) DEFAULT '0',
  `f14` tinyint(2) DEFAULT '0',
  `f14t` tinyint(2) DEFAULT '0',
  `f15` tinyint(2) DEFAULT '0',
  `f15t` tinyint(2) DEFAULT '0',
  `f16` tinyint(2) DEFAULT '0',
  `f16t` tinyint(2) DEFAULT '0',
  `f17` tinyint(2) DEFAULT '0',
  `f17t` tinyint(2) DEFAULT '0',
  `f18` tinyint(2) DEFAULT '0',
  `f18t` tinyint(2) DEFAULT '0',
  `f19` tinyint(2) DEFAULT '0',
  `f19t` tinyint(2) DEFAULT '0',
  `f20` tinyint(2) DEFAULT '0',
  `f20t` tinyint(2) DEFAULT '0',
  `f21` tinyint(2) DEFAULT '0',
  `f21t` tinyint(2) DEFAULT '0',
  `f22` tinyint(2) DEFAULT '0',
  `f22t` tinyint(2) DEFAULT '0',
  `f23` tinyint(2) DEFAULT '0',
  `f23t` tinyint(2) DEFAULT '0',
  `f24` tinyint(2) DEFAULT '0',
  `f24t` tinyint(2) DEFAULT '0',
  `f25` tinyint(2) DEFAULT '0',
  `f25t` tinyint(2) DEFAULT '0',
  `f26` tinyint(2) DEFAULT '0',
  `f26t` tinyint(2) DEFAULT '0',
  `f27` tinyint(2) DEFAULT '0',
  `f27t` tinyint(2) DEFAULT '0',
  `f28` tinyint(2) DEFAULT '0',
  `f28t` tinyint(2) DEFAULT '0',
  `f29` tinyint(2) DEFAULT '0',
  `f29t` tinyint(2) DEFAULT '0',
  `f30` tinyint(2) DEFAULT '0',
  `f30t` tinyint(2) DEFAULT '0',
  `f31` tinyint(2) DEFAULT '0',
  `f31t` tinyint(2) DEFAULT '0',
  `f32` tinyint(2) DEFAULT '0',
  `f32t` tinyint(2) DEFAULT '0',
  `f33` tinyint(2) DEFAULT '0',
  `f33t` tinyint(2) DEFAULT '0',
  `f34` tinyint(2) DEFAULT '0',
  `f34t` tinyint(2) DEFAULT '0',
  `f35` tinyint(2) DEFAULT '0',
  `f35t` tinyint(2) DEFAULT '0',
  `f36` tinyint(2) DEFAULT '0',
  `f36t` tinyint(2) DEFAULT '0',
  `f37` tinyint(2) DEFAULT '0',
  `f37t` tinyint(2) DEFAULT '0',
  `f38` tinyint(2) DEFAULT '0',
  `f38t` tinyint(2) DEFAULT '0',
  `f39` tinyint(2) DEFAULT '0',
  `f39t` tinyint(2) DEFAULT '0',
  `f40` tinyint(2) DEFAULT '0',
  `f40t` tinyint(2) DEFAULT '0',
  `f99` tinyint(2) DEFAULT '0',
  `f99t` tinyint(2) DEFAULT '0',
  `wwname` varchar(100) DEFAULT 'World Wonder',
  `ww_lastupdate` int(11) DEFAULT NULL,
  PRIMARY KEY (`vref`),
  KEY `f99` (`f99`),
  KEY `f99t` (`f99t`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `%PREFIX%forum_cat`
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

-- --------------------------------------------------------

--
-- Table structure for table `%PREFIX%forum_edit`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%forum_edit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `alliance` int(11) NOT NULL,
  `result` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `alliance` (`alliance`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `%PREFIX%forum_post`
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

-- --------------------------------------------------------

--
-- Table structure for table `%PREFIX%forum_survey`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%forum_survey` (
  `topic` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `option1` varchar(255) DEFAULT NULL,
  `option2` varchar(255) DEFAULT NULL,
  `option3` varchar(255) DEFAULT NULL,
  `option4` varchar(255) DEFAULT NULL,
  `option5` varchar(255) DEFAULT NULL,
  `option6` varchar(255) DEFAULT NULL,
  `option7` varchar(255) DEFAULT NULL,
  `option8` varchar(255) DEFAULT NULL,
  `vote1` int(11) DEFAULT '0',
  `vote2` int(11) DEFAULT '0',
  `vote3` int(11) DEFAULT '0',
  `vote4` int(11) DEFAULT '0',
  `vote5` int(11) DEFAULT '0',
  `vote6` int(11) DEFAULT '0',
  `vote7` int(11) DEFAULT '0',
  `vote8` int(11) DEFAULT '0',
  `voted` text,
  `ends` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `%PREFIX%forum_topic`
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
  KEY `cat-stick` (`cat`,`stick`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `%PREFIX%general`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%general` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `casualties` int(11) DEFAULT NULL,
  `time` int(11) DEFAULT NULL,
  `shown` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `shown` (`shown`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `%PREFIX%hero`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%hero` (
  `heroid` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `unit` smallint(2) DEFAULT NULL,
  `name` tinytext,
  `wref` int(11) DEFAULT NULL,
  `level` tinyint(3) DEFAULT NULL,
  `points` int(3) DEFAULT NULL,
  `experience` int(11) DEFAULT NULL,
  `dead` tinyint(1) DEFAULT NULL,
  `health` float(12,9) DEFAULT NULL,
  `attack` tinyint(3) DEFAULT NULL,
  `defence` tinyint(3) DEFAULT NULL,
  `attackbonus` tinyint(3) DEFAULT NULL,
  `defencebonus` tinyint(3) DEFAULT NULL,
  `regeneration` tinyint(3) DEFAULT NULL,
  `autoregen` int(2) DEFAULT NULL,
  `lastupdate` int(11) DEFAULT NULL,
  `trainingtime` int(11) DEFAULT NULL,
  `inrevive` tinyint(1) DEFAULT NULL,
  `intraining` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`heroid`),
  UNIQUE KEY `wref` (`wref`),
  KEY `uid` (`uid`,`dead`) USING BTREE,
  KEY `lastupdate` (`lastupdate`),
  KEY `inrevive` (`inrevive`),
  KEY `intraining` (`intraining`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `%PREFIX%links`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%links` (
  `id` int(25) NOT NULL AUTO_INCREMENT,
  `userid` int(25) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `url` varchar(150) DEFAULT NULL,
  `pos` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `userid-pos` (`userid`,`pos`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `%PREFIX%logs`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` text,
  `log` text,
  `time` int(25) DEFAULT NULL,
  `type` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `type` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `%PREFIX%market`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%market` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vref` int(11) NOT NULL DEFAULT '0',
  `offered` tinyint(1) NOT NULL DEFAULT '1',
  `offeredAmount` int(11) NOT NULL DEFAULT '0',
  `wanted` tinyint(1) NOT NULL DEFAULT '1',
  `wantedAmount` int(11) NOT NULL DEFAULT '0',
  `accept` tinyint(1) NOT NULL DEFAULT '0',
  `maxtime` tinyint(2) NOT NULL DEFAULT '0',
  `alliance` int(11) NOT NULL DEFAULT '0',
  `merchants` tinyint(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `vref-accept-alliance` (`vref`,`accept`,`alliance`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `%PREFIX%medal`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%medal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) DEFAULT NULL,
  `categorie` int(11) DEFAULT NULL,
  `plaats` int(11) DEFAULT NULL,
  `week` int(11) DEFAULT NULL,
  `points` varchar(15) DEFAULT NULL,
  `img` varchar(10) DEFAULT NULL,
  `del` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `week` (`week`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `%PREFIX%messages`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `target` int(11) DEFAULT NULL,
  `owner` int(11) DEFAULT NULL,
  `topic` varchar(100) DEFAULT NULL,
  `message` text,
  `viewed` tinyint(1) DEFAULT '0',
  `archived` tinyint(1) DEFAULT '0',
  `send` tinyint(1) DEFAULT '0',
  `time` int(11) DEFAULT '0',
  `deltarget` int(11) DEFAULT '0',
  `delowner` int(11) DEFAULT '0',
  `alliance` int(11) DEFAULT '0',
  `player` int(11) DEFAULT '0',
  `coor` int(11) DEFAULT '0',
  `report` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `target-time` (`target`,`time`) USING BTREE,
  KEY `owner` (`owner`),
  KEY `target-viewed` (`target`,`viewed`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `%PREFIX%movement`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%movement` (
  `moveid` int(11) NOT NULL AUTO_INCREMENT,
  `from` int(11) NOT NULL DEFAULT '0',
  `to` int(11) NOT NULL DEFAULT '0',
  `ref` int(11) NOT NULL DEFAULT '0',
  `starttime` int(11) NOT NULL DEFAULT '0',
  `endtime` int(11) NOT NULL DEFAULT '0',
  `proc` tinyint(1) NOT NULL DEFAULT '0',
  `merchants` tinyint(1) NOT NULL DEFAULT '0',
  `repetitions` tinyint(1) NOT NULL DEFAULT '0',
  `wood` int(11) NOT NULL DEFAULT '0',
  `clay` int(11) NOT NULL DEFAULT '0',
  `iron` int(11) NOT NULL DEFAULT '0',
  `crop` int(11) NOT NULL DEFAULT '0',
  `type` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`moveid`),
  KEY `ref` (`ref`),
  KEY `proc-endtime` (`proc`,`endtime`) USING BTREE,
  KEY `from-proc` (`from`,`proc`) USING BTREE,
  KEY `to` (`to`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `%PREFIX%odata`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%odata` (
  `wref` int(11) NOT NULL,
  `type` tinyint(2) DEFAULT NULL,
  `conquered` int(11) DEFAULT NULL,
  `wood` int(11) DEFAULT NULL,
  `iron` int(11) DEFAULT NULL,
  `clay` int(11) DEFAULT NULL,
  `maxstore` int(11) DEFAULT NULL,
  `crop` int(11) DEFAULT NULL,
  `maxcrop` int(11) DEFAULT NULL,
  `lastupdated` int(11) DEFAULT NULL,
  `lastupdated2` int(11) DEFAULT NULL,
  `loyalty` float(9,6) DEFAULT '100.000000',
  `owner` int(11) DEFAULT '2',
  `name` varchar(32) DEFAULT 'Unoccupied Oasis',
  `high` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`wref`),
  KEY `lastupdated2` (`lastupdated2`) USING BTREE,
  KEY `wood` (`wood`),
  KEY `iron` (`iron`),
  KEY `clay` (`clay`),
  KEY `crop` (`crop`),
  KEY `loyalty` (`loyalty`),
  KEY `maxcrop` (`maxcrop`),
  KEY `maxstore` (`maxstore`),
  KEY `conquered` (`conquered`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `%PREFIX%password`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%password` (
  `uid` int(11) NOT NULL,
  `npw` varchar(100) DEFAULT NULL,
  `cpw` varchar(100) DEFAULT NULL,
  `used` tinyint(1) DEFAULT '0',
  `timestamp` int(11) DEFAULT '0',
  PRIMARY KEY (`uid`),
  KEY `used` (`used`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `%PREFIX%prisoners`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%prisoners` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vref` int(11) DEFAULT NULL,
  `from` int(11) DEFAULT NULL,
  `u1` int(11) DEFAULT '0',
  `u2` int(11) DEFAULT '0',
  `u3` int(11) DEFAULT '0',
  `u4` int(11) DEFAULT '0',
  `u5` int(11) DEFAULT '0',
  `u6` int(11) DEFAULT '0',
  `u7` int(11) DEFAULT '0',
  `u8` int(11) DEFAULT '0',
  `u9` int(11) DEFAULT '0',
  `u10` int(11) DEFAULT '0',
  `u11` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `wref` (`vref`),
  KEY `from` (`from`,`u11`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `%PREFIX%raidlist`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%raidlist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lid` int(11) NOT NULL DEFAULT '0',
  `to` int(11) NOT NULL DEFAULT '0',
  `u1` int(11) NOT NULL DEFAULT '0',
  `u2` int(11) NOT NULL DEFAULT '0',
  `u3` int(11) NOT NULL DEFAULT '0',
  `u4` int(11) NOT NULL DEFAULT '0',
  `u5` int(11) NOT NULL DEFAULT '0',
  `u6` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `lid-distance` (`lid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `%PREFIX%reports`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%reports` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `owner` int(11) DEFAULT NULL,
  `from` int(11) NOT NULL,
  `to` int(11) DEFAULT NULL,
  `ally` int(11) DEFAULT NULL,
  `topic` text,
  `type` tinyint(1) DEFAULT NULL,
  `data` text,
  `time` int(11) DEFAULT NULL,
  `viewed` tinyint(1) DEFAULT '0',
  `archived` tinyint(1) DEFAULT '0',
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `time` (`time`),
  KEY `del` (`deleted`),
  KEY `owner-time` (`owner`,`time`) USING BTREE,
  KEY `to` (`to`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `%PREFIX%route`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%route` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL DEFAULT '0',
  `from` int(11) NOT NULL DEFAULT '0',
  `to` int(11) NOT NULL DEFAULT '0',
  `wood` int(5) NOT NULL DEFAULT '0',
  `clay` int(5) NOT NULL DEFAULT '0',
  `iron` int(5) NOT NULL DEFAULT '0',
  `crop` int(5) NOT NULL DEFAULT '0',
  `start` tinyint(2) NOT NULL DEFAULT '0',
  `deliveries` tinyint(1) NOT NULL DEFAULT '0',
  `timestamp` int(11) NOT NULL DEFAULT '0',
  `timeleft` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`),
  KEY `timestamp` (`timestamp`),
  KEY `timeleft` (`timeleft`),
  KEY `uid-timestamp` (`uid`,`timestamp`),
  KEY `from` (`from`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `%PREFIX%tdata`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%tdata` (
  `vref` int(11) NOT NULL,
  `t2` int(11) DEFAULT '0',
  `t3` int(11) DEFAULT '0',
  `t4` int(11) DEFAULT '0',
  `t5` int(11) DEFAULT '0',
  `t6` int(11) DEFAULT '0',
  `t7` int(11) DEFAULT '0',
  `t8` int(11) DEFAULT '0',
  `t9` int(11) DEFAULT '0',
  PRIMARY KEY (`vref`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `%PREFIX%training`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%training` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vref` int(11) DEFAULT '0',
  `unit` tinyint(2) DEFAULT '0',
  `amount` int(11) DEFAULT '0',
  `eachtime` int(11) DEFAULT '0',
  `lasttrainedtime` int(11) DEFAULT '0',
  `finishtime` int(11) NOT NULL DEFAULT '0',
  `great` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `vref` (`vref`),
  KEY `great` (`great`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `%PREFIX%units`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%units` (
  `vref` int(11) NOT NULL,
  `u1` int(11) DEFAULT '0',
  `u2` int(11) DEFAULT '0',
  `u3` int(11) DEFAULT '0',
  `u4` int(11) DEFAULT '0',
  `u5` int(11) DEFAULT '0',
  `u6` int(11) DEFAULT '0',
  `u7` int(11) DEFAULT '0',
  `u8` int(11) DEFAULT '0',
  `u9` int(11) DEFAULT '0',
  `u10` int(11) DEFAULT '0',
  `u11` int(11) DEFAULT '0',
  `u12` int(11) DEFAULT '0',
  `u13` int(11) DEFAULT '0',
  PRIMARY KEY (`vref`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `act` varchar(10) DEFAULT NULL,
  `timestamp` int(11) DEFAULT '0',
  `beerfest` int(11) NOT NULL DEFAULT '0',
  `ap` int(11) DEFAULT '0',
  `apall` int(11) DEFAULT '0',
  `dp` int(11) DEFAULT '0',
  `dpall` int(11) DEFAULT '0',
  `protect` int(11) DEFAULT NULL,
  `quest` tinyint(2) DEFAULT NULL,
  `quest_time` int(11) DEFAULT NULL,
  `gpack` varchar(255) DEFAULT 'gpack/travian_default/',
  `cp` float(14,5) DEFAULT '1.00000',
  `lastupdate` int(11) DEFAULT NULL,
  `RR` int(255) DEFAULT '0',
  `Rc` int(255) DEFAULT '0',
  `ok` tinyint(1) DEFAULT '0',
  `clp` bigint(255) DEFAULT '0',
  `oldrank` bigint(255) DEFAULT '0',
  `regtime` int(11) DEFAULT '0',
  `invited` int(11) DEFAULT '0',
  `maxevasion` mediumint(3) DEFAULT '0',
  `actualvillage` bigint(20) DEFAULT '0',
  `vac_time` varchar(255) DEFAULT '0',
  `vac_mode` int(2) DEFAULT '0',
  `vactwoweeks` varchar(255) DEFAULT '0',
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
INSERT INTO `%PREFIX%users` (`id`, `username`, `password`, `email`, `tribe`, `access`, `gold`, `gender`, `birthday`, `location`, `desc1`, `desc2`, `plus`, `b1`, `b2`, `b3`, `b4`, `sit1`, `sit2`, `alliance`, `act`, `timestamp`, `ap`, `apall`, `dp`, `dpall`, `protect`, `quest`, `gpack`, `cp`, `lastupdate`, `RR`, `Rc`, `ok`) VALUES
(5, 'Multihunter', '', 'multihunter@travianz.game', 1, 9, 0, 0, '1970-01-01', '', '[#MH]', '[#MULTIHUNTER]', 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 'gpack/travian_default/', 0, 0, 0, 0, 0),
(1, 'Support', '', 'support@travianz.game', 0, 8, 0, 0, '1970-01-01', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 'gpack/travian_default/', 0, 0, 0, 0, 0),
(2, 'Nature', '', 'nature@travianz.game', 4, 2, 0, 0, '1970-01-01', '', '[#NATURE]', '', 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 'gpack/travian_default/', 0, 0, 0, 0, 0),
(4, 'Taskmaster', '', 'taskmaster@travianz.game', 0, 8, 0, 0, '1970-01-01', '', '[#TASKMASTER]', '', 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 'gpack/travian_default/', 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `%PREFIX%vdata`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%vdata` (
  `wref` int(11) NOT NULL,
  `owner` int(11) NOT NULL DEFAULT '5',
  `name` varchar(100) DEFAULT NULL,
  `capital` tinyint(1) NOT NULL DEFAULT '0',
  `pop` int(11) NOT NULL DEFAULT '2',
  `cp` int(11) NOT NULL DEFAULT '0',
  `celebration` int(11) NOT NULL DEFAULT '0',
  `type` int(11) NOT NULL DEFAULT '3',
  `wood` float(12,2) NOT NULL DEFAULT '0.00',
  `clay` float(12,2) NOT NULL DEFAULT '0.00',
  `iron` float(12,2) NOT NULL DEFAULT '0.00',
  `maxstore` int(11) NOT NULL DEFAULT '0',
  `crop` float(12,2) NOT NULL DEFAULT '0.00',
  `maxcrop` int(11) NOT NULL DEFAULT '0',
  `lastupdate` int(11) NOT NULL DEFAULT '0',
  `lastupdate2` int(11) NOT NULL DEFAULT '0',
  `loyalty` float(9,6) NOT NULL DEFAULT '100.000000',
  `exp1` int(11) NOT NULL DEFAULT '0',
  `exp2` int(11) NOT NULL DEFAULT '0',
  `exp3` int(11) NOT NULL DEFAULT '0',
  `created` int(11) NOT NULL DEFAULT '0',
  `natar` tinyint(1) NOT NULL DEFAULT '0',
  `starv` int(11) NOT NULL DEFAULT '0',
  `starvupdate` int(11) NOT NULL DEFAULT '0',
  `evasion` tinyint(1) NOT NULL DEFAULT '0',
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

-- --------------------------------------------------------

--
-- Table structure for table `%PREFIX%wdata`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%wdata` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fieldtype` tinyint(2) DEFAULT NULL,
  `oasestype` tinyint(2) DEFAULT NULL,
  `x` int(11) DEFAULT NULL,
  `y` int(11) DEFAULT NULL,
  `occupied` tinyint(1) DEFAULT NULL,
  `image` varchar(3) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `occupied` (`occupied`),
  KEY `fieldtype` (`fieldtype`),
  KEY `x-y` (`x`,`y`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
