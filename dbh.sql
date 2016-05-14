
-- phpMyAdmin SQL Dump
-- version 2.11.11.3
-- http://www.phpmyadmin.net
--
-- Host: 68.178.217.10
-- Generation Time: May 11, 2016 at 07:46 AM
-- Server version: 5.5.43
-- PHP Version: 5.1.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dbhlimo`
--

-- --------------------------------------------------------

--
-- Table structure for table `category_images`
--

CREATE TABLE `category_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `category_images`
--

INSERT INTO `category_images` VALUES(5, 'General');

-- --------------------------------------------------------

--
-- Table structure for table `site_admin`
--

CREATE TABLE `site_admin` (
  `adminid` int(11) NOT NULL AUTO_INCREMENT,
  `admin_name` varchar(18) NOT NULL,
  `password` varchar(50) CHARACTER SET latin1 NOT NULL,
  `email` varchar(50) CHARACTER SET latin1 NOT NULL,
  `fullname` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `site` varchar(105) CHARACTER SET latin1 NOT NULL,
  `country` varchar(50) CHARACTER SET latin1 NOT NULL,
  `city` varchar(50) CHARACTER SET latin1 NOT NULL,
  `tel` varchar(50) CHARACTER SET latin1 NOT NULL,
  `profile` text CHARACTER SET latin1 NOT NULL,
  `regdate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ipaddress` varchar(50) CHARACTER SET latin1 NOT NULL,
  `lastlogin` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`adminid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `site_admin`
--

INSERT INTO `site_admin` VALUES(1, 'admin', '7a52ccfbecd8bcb3dae84535bd915d06', 'laura@wedosites.com', 'We Do Sites', '', '', '', '', '', '0000-00-00 00:00:00', '98.124.77.213', '2015-01-29 15:43:29');
INSERT INTO `site_admin` VALUES(11, 'beverly', '49e8149097e4177641c8bc7acdd28c8f', 'bkb@ballingerlawfirm.com', 'Bev Ballinger', '', '', '', '', '', '2010-02-23 08:43:57', '68.143.213.130', '2010-03-11 13:22:50');

-- --------------------------------------------------------

--
-- Table structure for table `site_cfg`
--

CREATE TABLE `site_cfg` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `keywords` longtext NOT NULL,
  `description` longtext NOT NULL,
  `page_title` text NOT NULL,
  `site_name` text NOT NULL,
  `admin_email` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `site_cfg`
--

INSERT INTO `site_cfg` VALUES(1, 'Test', 'Test', 'Ballinger Law Firm', 'Ballinger Law Firm', 'bkb@ballingerlawfirm.com');

-- --------------------------------------------------------

--
-- Table structure for table `site_images`
--

CREATE TABLE `site_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `img` text NOT NULL,
  `name` text NOT NULL,
  `ymd` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `cat` tinyint(4) NOT NULL,
  `type` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `site_images`
--


-- --------------------------------------------------------

--
-- Table structure for table `site_modules`
--

CREATE TABLE `site_modules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mod_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `mod_file` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `site_modules`
--


-- --------------------------------------------------------

--
-- Table structure for table `site_options`
--

CREATE TABLE `site_options` (
  `site_name` text CHARACTER SET utf8 NOT NULL,
  `site_email` varchar(50) CHARACTER SET utf8 NOT NULL,
  `site_url` varchar(50) CHARACTER SET utf8 NOT NULL,
  `site_info` text CHARACTER SET utf8 NOT NULL,
  `language` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `validate` tinyint(1) NOT NULL,
  `site_keywords` longtext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `site_options`
--

INSERT INTO `site_options` VALUES('DBH Limo', 'info@geeksinabox.com', 'http://www.dbhlimo.com', '', 'english', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `site_pages`
--

CREATE TABLE `site_pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hdr` text NOT NULL,
  `ctext` longtext NOT NULL,
  `u_ymd` datetime NOT NULL,
  `o_ymd` datetime NOT NULL,
  `page` int(11) NOT NULL,
  `img` text NOT NULL,
  `published` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `site_pages`
--

INSERT INTO `site_pages` VALUES(1, 'WELCOME', '<p>Leave the frustration of traffic and waiting behind. You can always rely on us to provide comfortable and reliable transportation. Our professionally trained drivers know their way around the city, suburbs and the airports and our reputation for being on-time is impeccable. Don''t risk missing your flight.</p>\r\n<p><strong>Early morning flight?</strong> No problem, we pick up and drop off 24 hours a day.<br />\r\n<strong><br type="_moz" />\r\n</strong></p>\r\n<div><strong>Wedding? </strong>Leave your special day to us. You can&nbsp;be sure our professional and courteous drivers are ready to offer you the fantastic service you deserve. You''re in good hands with our licensed professionals. Rent one of our beautiful stretch limo''s for your wedding needs or bachelor or bachelorette party.&nbsp;</div>\r\n<div>&nbsp;</div>\r\n<div><strong>Night Out? </strong>Take your special someone out for a night on the town, and leave the driving to us. Our limousine or Excursions are available for night on the town trips. &nbsp;Don''t worry about who the designated driver is. Let us do the driving, you just go out and have a great time.</div>\r\n<div>&nbsp;</div>\r\n<div>&nbsp;</div>', '2015-01-29 15:45:39', '2009-01-22 23:38:40', 1, '', 1);
INSERT INTO `site_pages` VALUES(2, 'ABOUT US', '<p>We are a full service limousine service and airport transportation company serving the Kiawah, Seabrook, and Charleston SC area. We specialize in nights on the town, corporate travel and weddings. We have full service fleet to handle any and all of your needs. Call us today and see what a difference dealing with a professional can really make. We can provide balloons, champagne, or anything your hearts desire. Just ask!&nbsp;</p>', '2014-06-26 14:04:50', '2009-01-22 23:38:40', 1, '', 1);
INSERT INTO `site_pages` VALUES(3, 'SERVICES', '', '2009-01-27 12:58:39', '2009-01-22 23:39:37', 1, '', 1);
INSERT INTO `site_pages` VALUES(4, 'FLEET', '', '2010-02-23 08:50:27', '2009-01-22 23:39:37', 1, '', 1);
INSERT INTO `site_pages` VALUES(5, 'RATES', '<p>Our rates vary on the type of vehicle you are requesting as well as the type of service you need. We are always happy to give a free quote over the phone. Call 303-4761 to find out more about our affordable, delux, executive transportation can be. Airport runs start as low as $50.&nbsp;</p>\r\n<div>&nbsp;</div>\r\n<div>Limo rates start at $100/hour anytime.</div>', '2014-06-26 14:38:52', '2009-03-23 17:35:38', 1, '', 1);
INSERT INTO `site_pages` VALUES(7, 'CONTACT', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '', 1);
INSERT INTO `site_pages` VALUES(6, 'RESERVE', '<p>&nbsp;Coming Soon.&nbsp;</p>', '2015-01-29 15:43:42', '2009-03-23 17:42:45', 1, '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `site_users`
--

CREATE TABLE `site_users` (
  `userid` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(10) NOT NULL DEFAULT '',
  `password` varchar(50) NOT NULL DEFAULT '',
  `email` varchar(50) NOT NULL DEFAULT '',
  `fullname` varchar(50) DEFAULT NULL,
  `site` varchar(105) NOT NULL DEFAULT '',
  `country` varchar(50) NOT NULL DEFAULT '',
  `city` varchar(50) NOT NULL DEFAULT '',
  `tel` varchar(50) NOT NULL DEFAULT '',
  `profile` text NOT NULL,
  `regdate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ipaddress` varchar(50) NOT NULL DEFAULT '',
  `lastlogin` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `isactive` tinyint(1) NOT NULL DEFAULT '0',
  `code` varchar(10) NOT NULL,
  PRIMARY KEY (`userid`),
  KEY `userid` (`userid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `site_users`
--

