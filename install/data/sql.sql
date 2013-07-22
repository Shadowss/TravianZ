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
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ckey` varchar(255) NOT NULL,
  `time_check` int(11) unsigned NOT NULL DEFAULT '0',
  `to_vid` int(11) unsigned NOT NULL,
  `u1` int(11) unsigned NOT NULL,
  `u2` int(11) unsigned NOT NULL,
  `u3` int(11) unsigned NOT NULL,
  `u4` int(11) unsigned NOT NULL,
  `u5` int(11) unsigned NOT NULL,
  `u6` int(11) unsigned NOT NULL,
  `u7` int(11) unsigned NOT NULL,
  `u8` int(11) unsigned NOT NULL,
  `u9` int(11) unsigned NOT NULL,
  `u10` int(11) unsigned NOT NULL,
  `u11` int(11) unsigned NOT NULL,
  `type` smallint(1) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `%PREFIX%a2b`
--

--
-- Table structure for table `%PREFIX%links`
--

CREATE TABLE `%PREFIX%links` (
  `id` INT( 25 ) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY ,
  `userid` INT( 25 ) NOT NULL ,
  `name` VARCHAR( 50 ) NOT NULL ,
  `url` VARCHAR( 150 ) NOT NULL ,
  `pos` INT( 10 ) NOT NULL
) ENGINE = MYISAM;

--
-- Dumping data for table `%PREFIX%links`
--

-- --------------------------------------------------------

--
-- Table structure for table `%PREFIX%abdata`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%abdata` (
  `vref` int(11) unsigned NOT NULL,
  `a1` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `a2` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `a3` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `a4` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `a5` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `a6` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `a7` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `a8` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `b1` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `b2` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `b3` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `b4` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `b5` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `b6` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `b7` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `b8` tinyint(2) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`vref`)
) ENGINE=MYISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `%PREFIX%abdata`
--


-- --------------------------------------------------------

--
-- Table structure for table `%PREFIX%activate`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%activate` (
  `id` int(255) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` text NOT NULL,
  `tribe` tinyint(1) unsigned NOT NULL,
  `access` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `act` varchar(10) NOT NULL,
  `timestamp` int(11) unsigned NOT NULL DEFAULT '0',
  `location` text NOT NULL,
  `act2` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `%PREFIX%activate`
--


-- --------------------------------------------------------

--
-- Table structure for table `%PREFIX%active`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%active` (
  `username` varchar(100) NOT NULL,
  `timestamp` int(11) unsigned NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `%PREFIX%active`
--


-- --------------------------------------------------------

--
-- Table structure for table `%PREFIX%admin_log`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%admin_log` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user` text NOT NULL,
  `log` text NOT NULL,
  `time` int(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=80 ;

--
-- Dumping data for table `%PREFIX%admin_log`
--


-- --------------------------------------------------------
--
-- Table structure for table `%PREFIX%allimedal`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%allimedal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `allyid` int(11) NOT NULL,
  `categorie` int(11) NOT NULL,
  `plaats` int(11) NOT NULL,
  `week` int(11) NOT NULL,
  `points` bigint(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  `del` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `%PREFIX%artefacts`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%artefacts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `vref` int(11) unsigned NOT NULL,
  `owner` int(11) unsigned NOT NULL,
  `type` tinyint(2) unsigned NOT NULL,
  `size` tinyint(1) unsigned NOT NULL,
  `conquered` int(11) unsigned NOT NULL,
  `name` varchar(100) NOT NULL,
  `desc` text NOT NULL,
  `effect` varchar(100) NOT NULL,
  `img` varchar(20) NOT NULL,
  `active` tinyint(1) unsigned NOT NULL,
  `kind` tinyint(1) unsigned NOT NULL,
  `bad_effect` tinyint(1) unsigned NOT NULL,
  `effect2` tinyint(2) unsigned NOT NULL,
  `lastupdate` int(11) unsigned NOT NULL,  
  PRIMARY KEY (`id`)
) ENGINE=MYISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Table structure for table `s1_artefacts`
--
-- --------------------------------------------------------

--
-- Table structure for table `%PREFIX%alidata`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%alidata` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `tag` varchar(100) NOT NULL,
  `leader` int(11) unsigned NOT NULL,
  `coor` int(11) unsigned NOT NULL,
  `advisor` int(11) unsigned NOT NULL,
  `recruiter` int(11) unsigned NOT NULL,
  `notice` text NOT NULL,
  `desc` text NOT NULL,
  `max` tinyint(2) unsigned NOT NULL,
  `ap` bigint(255) unsigned NOT NULL DEFAULT '0',
  `dp` bigint(255) unsigned NOT NULL DEFAULT '0',
  `Rc` bigint(255) unsigned NOT NULL DEFAULT '0',
  `RR` bigint(255)  NOT NULL DEFAULT '0',
  `Aap` bigint(255) unsigned NOT NULL DEFAULT '0',
  `Adp` bigint(255) unsigned NOT NULL DEFAULT '0',
  `clp` bigint(255) NOT NULL DEFAULT '0',
  `oldrank` bigint(255) unsigned NOT NULL DEFAULT '0',
  `forumlink` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `%PREFIX%alidata`
--


-- --------------------------------------------------------

--
-- Table structure for table `%PREFIX%ali_invite`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%ali_invite` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) unsigned NOT NULL,
  `alliance` int(11) unsigned NOT NULL,
  `sender` int(11) NOT NULL,
  `timestamp` int(11) NOT NULL,
  `accept` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `%PREFIX%ali_invite`
--


-- --------------------------------------------------------

--
-- Table structure for table `%PREFIX%ali_log`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%ali_log` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `aid` int(11) NOT NULL,
  `comment` text NOT NULL,
  `date` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `%PREFIX%ali_log`
--


-- --------------------------------------------------------

--
-- Table structure for table `%PREFIX%ali_permission`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%ali_permission` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) unsigned NOT NULL,
  `alliance` int(11) unsigned NOT NULL,
  `rank` varchar(100) NOT NULL,
  `opt1` int(1) unsigned NOT NULL DEFAULT '0',
  `opt2` int(1) unsigned NOT NULL DEFAULT '0',
  `opt3` int(1) unsigned NOT NULL DEFAULT '0',
  `opt4` int(1) unsigned NOT NULL DEFAULT '0',
  `opt5` int(1) unsigned NOT NULL DEFAULT '0',
  `opt6` int(1) unsigned NOT NULL DEFAULT '0',
  `opt7` int(1) unsigned NOT NULL DEFAULT '0',
  `opt8` int(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `%PREFIX%ali_permission`
--


-- --------------------------------------------------------

--
-- Table structure for table `%PREFIX%attacks`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%attacks` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `vref` int(11) unsigned NOT NULL,
  `t1` int(11) unsigned NOT NULL,
  `t2` int(11) unsigned NOT NULL,
  `t3` int(11) unsigned NOT NULL,
  `t4` int(11) unsigned NOT NULL,
  `t5` int(11) unsigned NOT NULL,
  `t6` int(11) unsigned NOT NULL,
  `t7` int(11) unsigned NOT NULL,
  `t8` int(11) unsigned NOT NULL,
  `t9` int(11) unsigned NOT NULL,
  `t10` int(11) unsigned NOT NULL,
  `t11` int(11) unsigned NOT NULL,
  `attack_type` tinyint(1) NOT NULL,
  `ctar1` int(11) unsigned NOT NULL, 
  `ctar2` int(11) unsigned NOT NULL,
  `spy` int(11) unsigned NOT NULL, 
  `b1` tinyint(1) unsigned NOT NULL, 
  `b2` tinyint(1) unsigned NOT NULL, 
  `b3` tinyint(1) unsigned NOT NULL, 
  `b4` tinyint(1) unsigned NOT NULL, 
  `b5` tinyint(1) unsigned NOT NULL, 
  `b6` tinyint(1) unsigned NOT NULL, 
  `b7` tinyint(1) unsigned NOT NULL, 
  `b8` tinyint(1) unsigned NOT NULL, 
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `%PREFIX%attacks`
--


-- --------------------------------------------------------

--
-- Table structure for table `%PREFIX%banlist`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%banlist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `reason` varchar(30) NOT NULL,
  `time` int(11) NOT NULL,
  `end` varchar(10) NOT NULL,
  `admin` int(11) NOT NULL,
  `active` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `%PREFIX%banlist`
--


-- --------------------------------------------------------

--
-- Table structure for table `%PREFIX%bdata`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%bdata` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `wid` int(11) unsigned NOT NULL,
  `field` tinyint(2) unsigned NOT NULL,
  `type` tinyint(2) unsigned NOT NULL,
  `loopcon` tinyint(1) unsigned NOT NULL,
  `timestamp` int(11) unsigned NOT NULL,
  `master` tinyint(1) unsigned NOT NULL,
  `level` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `%PREFIX%bdata`
--


-- --------------------------------------------------------

--
-- Table structure for table `%PREFIX%build_log`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%build_log` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `wid` int(11) unsigned NOT NULL,
  `log` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `%PREFIX%build_log`
--


-- --------------------------------------------------------

--
-- Table structure for table `%PREFIX%chat`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%chat` (
  `id` int(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `alli` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `msg` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `%prefix%chat`
--


-- --------------------------------------------------------

--
-- Table structure for table `%prefix%deleting`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%deleting` (
  `uid` int(11) unsigned NOT NULL,
  `timestamp` int(11) unsigned NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `%prefix%deleting`
--


-- --------------------------------------------------------

--
-- Table structure for table `%prefix%demolition`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%demolition` (
  `vref` int(11) unsigned NOT NULL,
  `buildnumber` int(11) unsigned NOT NULL DEFAULT '0',
  `lvl` int(11) unsigned NOT NULL DEFAULT '0',
  `timetofinish` int(11) NOT NULL,
  PRIMARY KEY (`vref`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `%prefix%demolition`
--


-- --------------------------------------------------------

--
-- Table structure for table `%prefix%diplomacy`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%diplomacy` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `alli1` int(11) unsigned NOT NULL,
  `alli2` int(11) unsigned NOT NULL,
  `type` tinyint(1) unsigned NOT NULL,
  `accepted` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
--
-- Dumping data for table `%prefix%diplomacy`
--


-- --------------------------------------------------------

--
-- Table structure for table `%prefix%enforcement`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%enforcement` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `u1` int(11) unsigned NOT NULL DEFAULT '0',
  `u2` int(11) unsigned NOT NULL DEFAULT '0',
  `u3` int(11) unsigned NOT NULL DEFAULT '0',
  `u4` int(11) unsigned NOT NULL DEFAULT '0',
  `u5` int(11) unsigned NOT NULL DEFAULT '0',
  `u6` int(11) unsigned NOT NULL DEFAULT '0',
  `u7` int(11) unsigned NOT NULL DEFAULT '0',
  `u8` int(11) unsigned NOT NULL DEFAULT '0',
  `u9` int(11) unsigned NOT NULL DEFAULT '0',
  `u10` int(11) unsigned NOT NULL DEFAULT '0',
  `u11` int(11) unsigned NOT NULL DEFAULT '0',
  `u12` int(11) unsigned NOT NULL DEFAULT '0',
  `u13` int(11) unsigned NOT NULL DEFAULT '0',
  `u14` int(11) unsigned NOT NULL DEFAULT '0',
  `u15` int(11) unsigned NOT NULL DEFAULT '0',
  `u16` int(11) unsigned NOT NULL DEFAULT '0',
  `u17` int(11) unsigned NOT NULL DEFAULT '0',
  `u18` int(11) unsigned NOT NULL DEFAULT '0',
  `u19` int(11) unsigned NOT NULL DEFAULT '0',
  `u20` int(11) unsigned NOT NULL DEFAULT '0',
  `u21` int(11) unsigned NOT NULL DEFAULT '0',
  `u22` int(11) unsigned NOT NULL DEFAULT '0',
  `u23` int(11) unsigned NOT NULL DEFAULT '0',
  `u24` int(11) unsigned NOT NULL DEFAULT '0',
  `u25` int(11) unsigned NOT NULL DEFAULT '0',
  `u26` int(11) unsigned NOT NULL DEFAULT '0',
  `u27` int(11) unsigned NOT NULL DEFAULT '0',
  `u28` int(11) unsigned NOT NULL DEFAULT '0',
  `u29` int(11) unsigned NOT NULL DEFAULT '0',
  `u30` int(11) unsigned NOT NULL DEFAULT '0',
  `u31` int(11) unsigned NOT NULL DEFAULT '0',
  `u32` int(11) unsigned NOT NULL DEFAULT '0',
  `u33` int(11) unsigned NOT NULL DEFAULT '0',
  `u34` int(11) unsigned NOT NULL DEFAULT '0',
  `u35` int(11) unsigned NOT NULL DEFAULT '0',
  `u36` int(11) unsigned NOT NULL DEFAULT '0',
  `u37` int(11) unsigned NOT NULL DEFAULT '0',
  `u38` int(11) unsigned NOT NULL DEFAULT '0',
  `u39` int(11) unsigned NOT NULL DEFAULT '0',
  `u40` int(11) unsigned NOT NULL DEFAULT '0',
  `u41` int(11) unsigned NOT NULL DEFAULT '0',
  `u42` int(11) unsigned NOT NULL DEFAULT '0',
  `u43` int(11) unsigned NOT NULL DEFAULT '0',
  `u44` int(11) unsigned NOT NULL DEFAULT '0',
  `u45` int(11) unsigned NOT NULL DEFAULT '0',
  `u46` int(11) unsigned NOT NULL DEFAULT '0',
  `u47` int(11) unsigned NOT NULL DEFAULT '0',
  `u48` int(11) unsigned NOT NULL DEFAULT '0',
  `u49` int(11) unsigned NOT NULL DEFAULT '0',
  `u50` int(11) unsigned NOT NULL DEFAULT '0',
  `hero` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `from` int(11) unsigned NOT NULL DEFAULT '0',
  `vref` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `%prefix%enforcement`
--

-- --------------------------------------------------------

--
-- Table structure for table `%prefix%farmlist`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%farmlist` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `wref` int(11) unsigned NOT NULL,
  `owner` int(11) unsigned NOT NULL,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `%prefix%farmlist`
--


-- --------------------------------------------------------

--
-- Table structure for table `%prefix%fdata`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%fdata` (
  `vref` int(11) unsigned NOT NULL,
  `f1` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f1t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f2` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f2t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f3` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f3t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f4` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f4t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f5` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f5t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f6` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f6t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f7` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f7t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f8` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f8t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f9` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f9t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f10` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f10t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f11` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f11t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f12` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f12t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f13` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f13t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f14` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f14t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f15` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f15t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f16` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f16t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f17` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f17t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f18` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f18t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f19` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f19t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f20` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f20t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f21` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f21t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f22` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f22t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f23` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f23t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f24` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f24t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f25` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f25t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f26` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f26t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f27` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f27t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f28` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f28t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f29` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f29t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f30` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f30t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f31` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f31t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f32` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f32t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f33` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f33t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f34` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f34t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f35` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f35t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f36` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f36t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f37` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f37t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f38` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f38t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f39` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f39t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f40` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f40t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f99` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f99t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `wwname` varchar(100) NOT NULL DEFAULT 'World Wonder',
  PRIMARY KEY (`vref`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED;

--
-- Dumping data for table `%prefix%fdata`
--


-- --------------------------------------------------------

--
-- Table structure for table `%prefix%forum_cat`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%forum_cat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `owner` varchar(255) NOT NULL,
  `alliance` varchar(255) NOT NULL,
  `forum_name` varchar(255) NOT NULL,
  `forum_des` text NOT NULL,
  `forum_area` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `%prefix%forum_cat`
--


-- --------------------------------------------------------

--
-- Table structure for table `%prefix%forum_edit`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%forum_edit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `alliance` varchar(255) NOT NULL,
  `result` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `%prefix%forum_edit`
--


-- --------------------------------------------------------

--
-- Table structure for table `%prefix%forum_post`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%forum_post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post` longtext NOT NULL,
  `topic` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `alliance0` int(11) unsigned NOT NULL,
  `player0` int(11) unsigned NOT NULL,
  `coor0` int(11) unsigned NOT NULL,
  `report0` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `%prefix%forum_post`
--


-- --------------------------------------------------------

--
-- Table structure for table `%prefix%forum_topic`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%forum_topic` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `post` longtext NOT NULL,
  `date` varchar(255) NOT NULL,
  `post_date` varchar(255) NOT NULL,
  `cat` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `alliance` varchar(255) NOT NULL,
  `ends` varchar(255) NOT NULL,
  `close` varchar(255) NOT NULL,
  `stick` varchar(255) NOT NULL,
  `alliance0` int(11) unsigned NOT NULL,
  `player0` int(11) unsigned NOT NULL,
  `coor0` int(11) unsigned NOT NULL,
  `report0` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `%prefix%forum_topic`
--


-- --------------------------------------------------------

--
-- Table structure for table `%prefix%general`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%general` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `casualties` int(11) unsigned NOT NULL,
  `time` int(11) unsigned NOT NULL,
  `shown` tinyint(1) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `%prefix%general`
--


-- --------------------------------------------------------

--
-- Table structure for table `%prefix%gold_fin_log`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%gold_fin_log` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `wid` int(11) unsigned NOT NULL,
  `log` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `%prefix%gold_fin_log`
--


-- --------------------------------------------------------

--
-- Table structure for table `%prefix%hero`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%hero` (
  `heroid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) unsigned NOT NULL,
  `unit` smallint(2) unsigned NOT NULL,
  `name` tinytext NOT NULL,
  `wref` int(11) unsigned NOT NULL,
  `level` tinyint(3) unsigned NOT NULL,
  `points` int(3) unsigned NOT NULL,
  `experience` int(11) NOT NULL,
  `dead` tinyint(1) unsigned NOT NULL,
  `health` float(12,9) unsigned NOT NULL,
  `attack` tinyint(3) unsigned NOT NULL,
  `defence` tinyint(3) unsigned NOT NULL,
  `attackbonus` tinyint(3) unsigned NOT NULL,
  `defencebonus` tinyint(3) unsigned NOT NULL,
  `regeneration` tinyint(3) unsigned NOT NULL,
  `autoregen` int(2) NOT NULL,
  `lastupdate` int(11) unsigned NOT NULL,
  `trainingtime` int(11) unsigned NOT NULL,
  `inrevive` tinyint(1) unsigned NOT NULL,
  `intraining` tinyint(1) unsigned NOT NULL,
  PRIMARY KEY (`heroid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

--
-- Dumping data for table `%prefix%hero`
--



-- --------------------------------------------------------

--
-- Table structure for table `%prefix%illegal_log`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%illegal_log` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user` int(11) unsigned NOT NULL,
  `log` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `%prefix%illegal_log`
--


-- --------------------------------------------------------

--
-- Table structure for table `%prefix%login_log`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%login_log` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) unsigned NOT NULL,
  `ip` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `%prefix%login_log`
--


-- --------------------------------------------------------

--
-- Table structure for table `%prefix%market`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%market` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `vref` int(11) unsigned NOT NULL,
  `gtype` tinyint(1) unsigned NOT NULL,
  `gamt` int(11) unsigned NOT NULL,
  `wtype` tinyint(1) unsigned NOT NULL,
  `wamt` int(11) unsigned NOT NULL,
  `accept` tinyint(1) unsigned NOT NULL,
  `maxtime` int(11) unsigned NOT NULL,
  `alliance` int(11) unsigned NOT NULL,
  `merchant` tinyint(2) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `%prefix%market`
--


-- --------------------------------------------------------

--
-- Table structure for table `%prefix%market_log`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%market_log` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `wid` int(11) unsigned NOT NULL,
  `log` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `%prefix%market_log`
--


-- --------------------------------------------------------

--
-- Table structure for table `%prefix%mdata`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%mdata` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `target` int(11) unsigned NOT NULL,
  `owner` int(11) unsigned NOT NULL,
  `topic` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `viewed` tinyint(1) unsigned NOT NULL,
  `archived` tinyint(1) unsigned NOT NULL,
  `send` tinyint(1) unsigned NOT NULL,
  `time` int(11) unsigned NOT NULL DEFAULT '0',
  `deltarget` int(11) unsigned NOT NULL,
  `delowner` int(11) unsigned NOT NULL,
  `alliance` int(11) unsigned NOT NULL,
  `player` int(11) unsigned NOT NULL,
  `coor` int(11) unsigned NOT NULL,
  `report` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `%prefix%mdata`
--


-- --------------------------------------------------------

--
-- Table structure for table `%prefix%medal`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%medal` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `userid` int(11) unsigned NOT NULL,
  `categorie` int(11) unsigned NOT NULL,
  `plaats` int(11) unsigned NOT NULL,
  `week` int(11) unsigned NOT NULL,
  `points` varchar(15) NOT NULL,
  `img` varchar(10) NOT NULL,
  `del` tinyint(1) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `%prefix%medal`
--


-- --------------------------------------------------------

--
-- Table structure for table `%prefix%movement`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%movement` (
  `moveid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `sort_type` tinyint(4) unsigned NOT NULL DEFAULT '0',
  `from` int(11) unsigned NOT NULL DEFAULT '0',
  `to` int(11) unsigned NOT NULL DEFAULT '0',
  `ref` int(11) unsigned NOT NULL DEFAULT '0',
  `ref2` int(11) unsigned NOT NULL DEFAULT '0',
  `starttime` int(11) unsigned NOT NULL DEFAULT '0',
  `endtime`  int(11) unsigned NOT NULL DEFAULT '0',
  `proc` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `send` tinyint(1) unsigned NOT NULL,
  `wood` int(11) unsigned NOT NULL,
  `clay` int(11) unsigned NOT NULL,
  `iron` int(11) unsigned NOT NULL,
  `crop` int(11) unsigned NOT NULL,
  PRIMARY KEY (`moveid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `%prefix%movement`
--


-- --------------------------------------------------------

--
-- Table structure for table `%prefix%ndata`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%ndata` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) unsigned NOT NULL,
  `toWref` int(11) unsigned NOT NULL,
  `ally` int(11) unsigned NOT NULL,
  `topic` text NOT NULL,
  `ntype` tinyint(1) unsigned NOT NULL,
  `data` text NOT NULL,
  `time` int(11) unsigned NOT NULL,
  `viewed` tinyint(1) unsigned NOT NULL,
  `archive` tinyint(1) unsigned NOT NULL,
  `del` tinyint(1) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `%prefix%ndata`
--


-- --------------------------------------------------------

--
-- Table structure for table `%prefix%odata`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%odata` (
  `wref` int(11) unsigned NOT NULL,
  `type` tinyint(2) unsigned NOT NULL,
  `conqured` int(11) unsigned NOT NULL,
  `wood` int(11) unsigned NOT NULL,
  `iron` int(11) unsigned NOT NULL,
  `clay` int(11) unsigned NOT NULL,
  `maxstore` int(11) unsigned NOT NULL,
  `crop` int(11) unsigned NOT NULL,
  `maxcrop` int(11) unsigned NOT NULL,
  `lastupdated` int(11) unsigned NOT NULL,
  `lastupdated2` int(11) unsigned NOT NULL,
  `loyalty` int(11) NOT NULL DEFAULT '100',
  `owner` int(11) unsigned NOT NULL DEFAULT '2',
  `name` varchar(32) NOT NULL DEFAULT 'Unoccupied Oasis',
  `high` tinyint(1) unsigned NOT NULL,
  PRIMARY KEY (`wref`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `%prefix%odata`
--


-- --------------------------------------------------------

--
-- Table structure for table `%prefix%online`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%online` (
  `name` varchar(32) NOT NULL,
  `uid` int(11) unsigned NOT NULL,
  `time` varchar(32) NOT NULL,
  `sit` tinyint(1) unsigned NOT NULL,
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `%prefix%online`
--

-- --------------------------------------------------------

--
-- Table structure for table `%PREFIX%prisoners`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%prisoners` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `wref` int(11) unsigned NOT NULL,
  `from` int(11) unsigned NOT NULL,
  `t1` int(11) unsigned NOT NULL,
  `t2` int(11) unsigned NOT NULL,
  `t3` int(11) unsigned NOT NULL,
  `t4` int(11) unsigned NOT NULL,
  `t5` int(11) unsigned NOT NULL,
  `t6` int(11) unsigned NOT NULL,
  `t7` int(11) unsigned NOT NULL,
  `t8` int(11) unsigned NOT NULL,
  `t9` int(11) unsigned NOT NULL,
  `t10` int(11) unsigned NOT NULL,
  `t11` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `%PREFIX%prisoners`
--


-- --------------------------------------------------------

--
-- Table structure for table `%prefix%raidlist`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%raidlist` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `lid` int(11) NOT NULL,
  `towref` int(11) unsigned NOT NULL,
  `x` int(11) NOT NULL,
  `y` int(11) NOT NULL,
  `distance` varchar(5) NOT NULL DEFAULT '0',
  `t1` int(11) unsigned NOT NULL,
  `t2` int(11) unsigned NOT NULL,
  `t3` int(11) unsigned NOT NULL,
  `t4` int(11) unsigned NOT NULL,
  `t5` int(11) unsigned NOT NULL,
  `t6` int(11) unsigned NOT NULL,
  `t7` int(11) unsigned NOT NULL,
  `t8` int(11) unsigned NOT NULL,
  `t9` int(11) unsigned NOT NULL,
  `t10` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `%prefix%raidlist`
--


-- --------------------------------------------------------

--
-- Table structure for table `%prefix%research`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%research` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `vref` int(11) unsigned NOT NULL,
  `tech` varchar(3) NOT NULL,
  `timestamp` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `%prefix%research`
--


-- --------------------------------------------------------

--
-- Table structure for table `%prefix%route`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%route` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) unsigned NOT NULL,
  `wid` int(11) unsigned NOT NULL,
  `from` int(11) unsigned NOT NULL,
  `wood` int(5) unsigned NOT NULL,
  `clay` int(5) unsigned NOT NULL,
  `iron` int(5) unsigned NOT NULL,
  `crop` int(5) unsigned NOT NULL,
  `start` tinyint(2) unsigned NOT NULL,
  `deliveries` tinyint(1) unsigned NOT NULL,
  `merchant` int(11) unsigned NOT NULL,
  `timestamp` int(11) unsigned NOT NULL,
  `timeleft` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `%prefix%route`
--


-- --------------------------------------------------------

--
-- Table structure for table `%prefix%send`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%send` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `wood` int(11) unsigned NOT NULL,
  `clay` int(11) unsigned NOT NULL,
  `iron` int(11) unsigned NOT NULL,
  `crop` int(11) unsigned NOT NULL,
  `merchant` tinyint(2) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `%prefix%send`
--


-- --------------------------------------------------------

--
-- Table structure for table `%prefix%tdata`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%tdata` (
  `vref` int(11) unsigned NOT NULL,
  `t2` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `t3` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `t4` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `t5` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `t6` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `t7` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `t8` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `t9` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `t12` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `t13` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `t14` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `t15` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `t16` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `t17` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `t18` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `t19` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `t22` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `t23` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `t24` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `t25` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `t26` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `t27` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `t28` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `t29` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `t32` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `t33` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `t34` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `t35` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `t36` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `t37` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `t38` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `t39` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `t42` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `t43` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `t44` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `t45` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `t46` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `t47` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `t48` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `t49` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`vref`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `%prefix%tdata`
--


-- --------------------------------------------------------

--
-- Table structure for table `%prefix%tech_log`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%tech_log` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `wid` int(11) unsigned NOT NULL,
  `log` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `%prefix%tech_log`
--


-- --------------------------------------------------------

--
-- Table structure for table `%prefix%training`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%training` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `vref` int(11) unsigned NOT NULL,
  `unit` tinyint(2) unsigned NOT NULL,
  `amt` int(11) unsigned NOT NULL,
  `pop` int(11) unsigned NOT NULL,
  `timestamp` int(11) unsigned NOT NULL,
  `eachtime` int(11) unsigned NOT NULL,
  `timestamp2` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `%prefix%training`
--


-- --------------------------------------------------------

--
-- Table structure for table `%prefix%units`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%units` (
  `vref` int(11) unsigned NOT NULL,
  `u1` int(11) unsigned NOT NULL DEFAULT '0',
  `u2` int(11) unsigned NOT NULL DEFAULT '0',
  `u3` int(11) unsigned NOT NULL DEFAULT '0',
  `u4` int(11) unsigned NOT NULL DEFAULT '0',
  `u5` int(11) unsigned NOT NULL DEFAULT '0',
  `u6` int(11) unsigned NOT NULL DEFAULT '0',
  `u7` int(11) unsigned NOT NULL DEFAULT '0',
  `u8` int(11) unsigned NOT NULL DEFAULT '0',
  `u9` int(11) unsigned NOT NULL DEFAULT '0',
  `u10` int(11) unsigned NOT NULL DEFAULT '0',
  `u11` int(11) unsigned NOT NULL DEFAULT '0',
  `u12` int(11) unsigned NOT NULL DEFAULT '0',
  `u13` int(11) unsigned NOT NULL DEFAULT '0',
  `u14` int(11) unsigned NOT NULL DEFAULT '0',
  `u15` int(11) unsigned NOT NULL DEFAULT '0',
  `u16` int(11) unsigned NOT NULL DEFAULT '0',
  `u17` int(11) unsigned NOT NULL DEFAULT '0',
  `u18` int(11) unsigned NOT NULL DEFAULT '0',
  `u19` int(11) unsigned NOT NULL DEFAULT '0',
  `u20` int(11) unsigned NOT NULL DEFAULT '0',
  `u21` int(11) unsigned NOT NULL DEFAULT '0',
  `u22` int(11) unsigned NOT NULL DEFAULT '0',
  `u23` int(11) unsigned NOT NULL DEFAULT '0',
  `u24` int(11) unsigned NOT NULL DEFAULT '0',
  `u25` int(11) unsigned NOT NULL DEFAULT '0',
  `u26` int(11) unsigned NOT NULL DEFAULT '0',
  `u27` int(11) unsigned NOT NULL DEFAULT '0',
  `u28` int(11) unsigned NOT NULL DEFAULT '0',
  `u29` int(11) unsigned NOT NULL DEFAULT '0',
  `u30` int(11) unsigned NOT NULL DEFAULT '0',
  `u31` int(11) unsigned NOT NULL DEFAULT '0',
  `u32` int(11) unsigned NOT NULL DEFAULT '0',
  `u33` int(11) unsigned NOT NULL DEFAULT '0',
  `u34` int(11) unsigned NOT NULL DEFAULT '0',
  `u35` int(11) unsigned NOT NULL DEFAULT '0',
  `u36` int(11) unsigned NOT NULL DEFAULT '0',
  `u37` int(11) unsigned NOT NULL DEFAULT '0',
  `u38` int(11) unsigned NOT NULL DEFAULT '0',
  `u39` int(11) unsigned NOT NULL DEFAULT '0',
  `u40` int(11) unsigned NOT NULL DEFAULT '0',
  `u41` int(11) unsigned NOT NULL DEFAULT '0',
  `u42` int(11) unsigned NOT NULL DEFAULT '0',
  `u43` int(11) unsigned NOT NULL DEFAULT '0',
  `u44` int(11) unsigned NOT NULL DEFAULT '0',
  `u45` int(11) unsigned NOT NULL DEFAULT '0',
  `u46` int(11) unsigned NOT NULL DEFAULT '0',
  `u47` int(11) unsigned NOT NULL DEFAULT '0',
  `u48` int(11) unsigned NOT NULL DEFAULT '0',
  `u49` int(11) unsigned NOT NULL DEFAULT '0',
  `u50` int(11) unsigned NOT NULL DEFAULT '0',
  `u99` int(11) unsigned NOT NULL DEFAULT '0',
  `u99o` int(11) unsigned NOT NULL DEFAULT '0',
  `hero` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`vref`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `%prefix%units`
--


-- --------------------------------------------------------

--
-- Table structure for table `%PREFIX%users`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` text NOT NULL,
  `tribe` tinyint(1) unsigned NOT NULL,
  `access` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `gold` int(9) unsigned NOT NULL DEFAULT '0',
  `gender` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `birthday` date NOT NULL DEFAULT '0000-00-00',
  `location` text NOT NULL,
  `desc1` text NOT NULL,
  `desc2` text NOT NULL,
  `plus` int(11) unsigned NOT NULL DEFAULT '0',
  `goldclub` int(11) unsigned NOT NULL DEFAULT '0',
  `b1` int(11) unsigned NOT NULL DEFAULT '0',
  `b2` int(11) unsigned NOT NULL DEFAULT '0',
  `b3` int(11) unsigned NOT NULL DEFAULT '0',
  `b4` int(11) unsigned NOT NULL DEFAULT '0',
  `sit1` int(11) unsigned NOT NULL DEFAULT '0',
  `sit2` int(11) unsigned NOT NULL DEFAULT '0',
  `alliance` int(11) unsigned NOT NULL DEFAULT '0',
  `sessid` varchar(100) NOT NULL,
  `act` varchar(10) NOT NULL,
  `timestamp` int(11) unsigned NOT NULL DEFAULT '0',
  `ap` int(11) unsigned NOT NULL DEFAULT '0',
  `apall` int(11) unsigned NOT NULL DEFAULT '0',
  `dp` int(11) unsigned NOT NULL DEFAULT '0',
  `dpall` int(11) unsigned NOT NULL DEFAULT '0',
  `protect` int(11) unsigned NOT NULL,
  `quest` tinyint(2) NOT NULL,
  `quest_time` int(11) unsigned NOT NULL,
  `gpack` varchar(255) NOT NULL DEFAULT 'gpack/travian_default/',
  `cp` float(14,5) unsigned NOT NULL DEFAULT '1',
  `lastupdate` int(11) unsigned NOT NULL,
  `RR` int(255) NOT NULL DEFAULT '0',
  `Rc` int(255) NOT NULL DEFAULT '0',
  `ok` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `clp` bigint(255) NOT NULL DEFAULT '0',
  `oldrank` bigint(255) unsigned NOT NULL DEFAULT '0',
  `regtime` int(11) unsigned NOT NULL DEFAULT '0',
  `invited` int(11) unsigned NOT NULL DEFAULT '0',
  `friend0` int(11) unsigned NOT NULL,
  `friend1` int(11) unsigned NOT NULL,
  `friend2` int(11) unsigned NOT NULL,
  `friend3` int(11) unsigned NOT NULL,
  `friend4` int(11) unsigned NOT NULL,
  `friend5` int(11) unsigned NOT NULL,
  `friend6` int(11) unsigned NOT NULL,
  `friend7` int(11) unsigned NOT NULL,
  `friend8` int(11) unsigned NOT NULL,
  `friend9` int(11) unsigned NOT NULL,
  `friend10` int(11) unsigned NOT NULL,
  `friend11` int(11) unsigned NOT NULL,
  `friend12` int(11) unsigned NOT NULL,
  `friend13` int(11) unsigned NOT NULL,
  `friend14` int(11) unsigned NOT NULL,
  `friend15` int(11) unsigned NOT NULL,
  `friend16` int(11) unsigned NOT NULL,
  `friend17` int(11) unsigned NOT NULL,
  `friend18` int(11) unsigned NOT NULL,
  `friend19` int(11) unsigned NOT NULL,
  `friend0wait` int(11) unsigned NOT NULL,
  `friend1wait` int(11) unsigned NOT NULL,
  `friend2wait` int(11) unsigned NOT NULL,
  `friend3wait` int(11) unsigned NOT NULL,
  `friend4wait` int(11) unsigned NOT NULL,
  `friend5wait` int(11) unsigned NOT NULL,
  `friend6wait` int(11) unsigned NOT NULL,
  `friend7wait` int(11) unsigned NOT NULL,
  `friend8wait` int(11) unsigned NOT NULL,
  `friend9wait` int(11) unsigned NOT NULL,
  `friend10wait` int(11) unsigned NOT NULL,
  `friend11wait` int(11) unsigned NOT NULL,
  `friend12wait` int(11) unsigned NOT NULL,
  `friend13wait` int(11) unsigned NOT NULL,
  `friend14wait` int(11) unsigned NOT NULL,
  `friend15wait` int(11) unsigned NOT NULL,
  `friend16wait` int(11) unsigned NOT NULL,
  `friend17wait` int(11) unsigned NOT NULL,
  `friend18wait` int(11) unsigned NOT NULL,
  `friend19wait` int(11) unsigned NOT NULL,
  `maxevasion` mediumint(3) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `%prefix%users`
--

INSERT INTO `%PREFIX%users` (`id`, `username`, `password`, `email`, `tribe`, `access`, `gold`, `gender`, `birthday`, `location`, `desc1`, `desc2`, `plus`, `b1`, `b2`, `b3`, `b4`, `sit1`, `sit2`, `alliance`, `sessid`, `act`, `timestamp`, `ap`, `apall`, `dp`, `dpall`, `protect`, `quest`, `gpack`, `cp`, `lastupdate`, `RR`, `Rc`, `ok`) VALUES
(5, 'Multihunter', '', 'multihunter@travianx.mail', 0, 9, 0, 0, '0000-00-00', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '', '', 0, 0, 0, 0, 0, 0, 0, 'gpack/travian_default/', 1, 0, 0, 0, 0),
(1, 'Support', '', 'support@travianx.mail', 0, 8, 0, 0, '0000-00-00', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '', '', 0, 0, 0, 0, 0, 0, 0, 'gpack/travian_default/', 1, 0, 0, 0, 0),
(2, 'Nature', '', 'support@travianx.mail', 4, 8, 0, 0, '0000-00-00', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '', '', 0, 0, 0, 0, 0, 0, 0, 'gpack/travian_default/', 1, 0, 0, 0, 0),
(4, 'Taskmaster', '', 'support@travianx.mail', 0, 8, 0, 0, '0000-00-00', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '', '', 0, 0, 0, 0, 0, 0, 0, 'gpack/travian_default/', 1, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `%prefix%vdata`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%vdata` (
`wref` int(11) unsigned NOT NULL,
`owner` int(11) unsigned NOT NULL,
`name` varchar(100) NOT NULL,
`capital` tinyint(1) unsigned NOT NULL,
`pop` int(11) unsigned NOT NULL,
`cp` int(11) unsigned NOT NULL,
`celebration` int(11) NOT NULL DEFAULT '0',
`type` int(11) NOT NULL DEFAULT '0',
`wood` float(12,2) NOT NULL,
`clay` float(12,2) NOT NULL,
`iron` float(12,2) NOT NULL,
`maxstore` int(11) unsigned NOT NULL,
`crop` float(12,2) NOT NULL,
`maxcrop` int(11) unsigned NOT NULL,
`lastupdate` int(11) unsigned NOT NULL,
`loyalty` float(9,6) unsigned NOT NULL DEFAULT '100',
`exp1` int(11) NOT NULL,
`exp2` int(11) NOT NULL,
`exp3` int(11) NOT NULL,
`created` int(11) NOT NULL,
`natar` tinyint(1) unsigned NOT NULL,
`starv` int(11) unsigned NOT NULL,
`starvupdate` int(11) unsigned NOT NULL,
`evasion` tinyint(1) unsigned NOT NULL,
PRIMARY KEY (`wref`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `%prefix%vdata`
--


-- --------------------------------------------------------

--
-- Table structure for table `%prefix%wdata`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%wdata` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `fieldtype` tinyint(2) unsigned NOT NULL,
  `oasistype` tinyint(2) unsigned NOT NULL,
  `x` int(11) NOT NULL,
  `y` int(11) NOT NULL,
  `occupied` tinyint(1) NOT NULL,
  `image` varchar(3) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `%prefix%wdata`
--

-- --------------------------------------------------------
--
-- Table structure for table `%prefix%password`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%password` (
  `uid` int(11) unsigned NOT NULL,
  `npw` varchar(100) NOT NULL,
  `cpw` varchar(100) NOT NULL,
  `used` tinyint(1) NOT NULL DEFAULT '0',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;

--
-- Dumping data for table `%prefix%password`
--

-- --------------------------------------------------------
--
-- Table structure for table `%prefix%ww_attacks`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%ww_attacks` (
  `vid` int(25) NOT NULL,
  `attack_time` int(25) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;

--
-- Dumping data for table `%prefix%password`
--

-- --------------------------------------------------------
