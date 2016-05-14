-- phpMyAdmin SQL Dump
-- version 2.8.2.4
-- http://www.phpmyadmin.net
-- 
-- Host: localhost:3306
-- Generation Time: Jul 07, 2009 at 03:01 PM
-- Server version: 5.0.27
-- PHP Version: 5.2.3
-- 
-- Database: `inurface_db`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `category_images`
-- 

CREATE TABLE `category_images` (
  `id` int(11) NOT NULL auto_increment,
  `name` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

-- 
-- Dumping data for table `category_images`
-- 

INSERT INTO `category_images` (`id`, `name`) VALUES (5, 'General');

-- --------------------------------------------------------

-- 
-- Table structure for table `site_admin`
-- 

CREATE TABLE `site_admin` (
  `adminid` int(11) NOT NULL auto_increment,
  `admin_name` varchar(18) NOT NULL,
  `password` varchar(50) character set latin1 NOT NULL,
  `email` varchar(50) character set latin1 NOT NULL,
  `fullname` varchar(50) character set latin1 default NULL,
  `site` varchar(105) character set latin1 NOT NULL,
  `country` varchar(50) character set latin1 NOT NULL,
  `city` varchar(50) character set latin1 NOT NULL,
  `tel` varchar(50) character set latin1 NOT NULL,
  `profile` text character set latin1 NOT NULL,
  `regdate` datetime NOT NULL default '0000-00-00 00:00:00',
  `ipaddress` varchar(50) character set latin1 NOT NULL,
  `lastlogin` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`adminid`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

-- 
-- Dumping data for table `site_admin`
-- 

INSERT INTO `site_admin` (`adminid`, `admin_name`, `password`, `email`, `fullname`, `site`, `country`, `city`, `tel`, `profile`, `regdate`, `ipaddress`, `lastlogin`) VALUES (1, 'admin', '7a52ccfbecd8bcb3dae84535bd915d06', 'laura@wedosites.com', 'We Do Sites', '', '', '', '', '', '0000-00-00 00:00:00', '68.59.29.136', '2009-03-23 17:47:09'),
(10, 'chefdemal', 'ac1b822062c0ae150f3e98cc8cb2ce6c', 'chef@inyourkitchencatering.com', 'Chef Mattson', '', '', '', '', '', '2009-03-17 19:06:05', '68.58.206.232', '2009-07-07 10:51:11');

-- --------------------------------------------------------

-- 
-- Table structure for table `site_cfg`
-- 

CREATE TABLE `site_cfg` (
  `id` tinyint(4) NOT NULL auto_increment,
  `keywords` longtext NOT NULL,
  `description` longtext NOT NULL,
  `page_title` text NOT NULL,
  `site_name` text NOT NULL,
  `admin_email` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- 
-- Dumping data for table `site_cfg`
-- 

INSERT INTO `site_cfg` (`id`, `keywords`, `description`, `page_title`, `site_name`, `admin_email`) VALUES (1, 'Test', 'Test', 'In Your Kitchen Catering', 'In Your Kitchen Catering', 'demalm3@yahoo.com');

-- --------------------------------------------------------

-- 
-- Table structure for table `site_images`
-- 

CREATE TABLE `site_images` (
  `id` int(11) NOT NULL auto_increment,
  `img` text NOT NULL,
  `name` text NOT NULL,
  `ymd` datetime NOT NULL default '0000-00-00 00:00:00',
  `cat` tinyint(4) NOT NULL,
  `type` tinyint(4) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

-- 
-- Dumping data for table `site_images`
-- 

INSERT INTO `site_images` (`id`, `img`, `name`, `ymd`, `cat`, `type`) VALUES (1, '600033702.JPG', '', '2009-03-23 18:11:23', 5, 0),
(2, '472548861.JPG', '', '2009-03-23 18:11:40', 5, 0),
(3, '621714351.jpg', '', '2009-03-23 18:11:53', 5, 0),
(4, '91462428.jpg', '', '2009-03-23 18:12:05', 5, 0),
(5, '257477246.jpg', '', '2009-03-23 18:12:19', 5, 0),
(6, '253615482.jpg', '', '2009-03-23 18:15:31', 5, 0),
(7, '938341544.jpg', '', '2009-03-23 18:15:47', 5, 0),
(8, '242947652.jpg', '', '2009-03-23 18:16:06', 5, 0),
(9, '334886746.jpg', '', '2009-03-23 18:26:06', 5, 0),
(10, '995112949.jpg', '', '2009-03-23 18:26:25', 5, 0),
(11, '454380517.jpg', '', '2009-03-23 18:26:36', 5, 0),
(12, '59853860.jpg', '', '2009-03-23 18:26:48', 5, 0),
(13, '376253263.jpg', '', '2009-03-23 18:27:00', 5, 0),
(14, '846486297.jpg', '', '2009-03-23 18:27:16', 5, 0),
(15, '644423082.jpg', '', '2009-03-23 18:27:26', 5, 0),
(16, '240838809.jpg', '', '2009-03-23 18:27:39', 5, 0),
(17, '13663095.jpg', '', '2009-03-23 18:27:51', 5, 0),
(18, '396128053.jpg', '', '2009-03-23 18:28:04', 5, 0),
(19, '965121154.jpg', '', '2009-03-23 18:28:20', 5, 0),
(20, '411728828.jpg', '', '2009-03-23 18:28:33', 5, 0),
(21, '825502942.jpg', '', '2009-03-23 18:28:44', 5, 0);

-- --------------------------------------------------------

-- 
-- Table structure for table `site_modules`
-- 

CREATE TABLE `site_modules` (
  `id` int(11) NOT NULL auto_increment,
  `mod_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `mod_file` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

-- 
-- Dumping data for table `site_modules`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `site_options`
-- 

CREATE TABLE `site_options` (
  `site_name` text character set utf8 NOT NULL,
  `site_email` varchar(50) character set utf8 NOT NULL,
  `site_url` varchar(50) character set utf8 NOT NULL,
  `site_info` text character set utf8 NOT NULL,
  `language` varchar(50) character set utf8 default NULL,
  `validate` tinyint(1) NOT NULL,
  `site_keywords` longtext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `site_options`
-- 

INSERT INTO `site_options` (`site_name`, `site_email`, `site_url`, `site_info`, `language`, `validate`, `site_keywords`) VALUES ('In Your Kitchen Catering', 'info@inyourkitchencatering.com', 'http://www.inyorukitchencatering.com', '', 'english', 0, '');

-- --------------------------------------------------------

-- 
-- Table structure for table `site_pages`
-- 

CREATE TABLE `site_pages` (
  `id` int(11) NOT NULL auto_increment,
  `hdr` text NOT NULL,
  `ctext` longtext NOT NULL,
  `u_ymd` datetime NOT NULL,
  `o_ymd` datetime NOT NULL,
  `page` int(11) NOT NULL,
  `img` text NOT NULL,
  `published` tinyint(4) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=utf8 AUTO_INCREMENT=29 ;

-- 
-- Dumping data for table `site_pages`
-- 

INSERT INTO `site_pages` (`id`, `hdr`, `ctext`, `u_ymd`, `o_ymd`, `page`, `img`, `published`) VALUES (1, 'WELCOME', '<p><span class="hdr">WELCOME TO IN YOUR KITCHEN CATERING</span></p>\r\n<p class="txt">A no hassel sophisticated dinning experience with casual home comfort.  Locally owned and operated by Award Winning Chef Demal Mattson, Chef Mattson brings that personal touch to all events in order to make each occasion unique and memorable.</p>\r\n<p class="txt" align="center">&ldquo;I REGARD FOOD AS ART AND THRIVE ON CREATING EYE CATCHING  PRESENTATIONS WITH PALLET PLEASING FLAVORS.&rdquo; - CHEF MATSON</p>', '2009-03-17 20:07:50', '2009-01-22 23:38:40', 1, '', 1),
(2, 'MENUS', '<p>MENUS&nbsp;<br />\r\n<br />\r\n<a href="/files/file/site_text.txt?phpMyAdmin=eiEY9FtnF1wiPzgXNWIyyVQnfnf">Dinner Menu Test</a></p>', '2009-03-23 20:55:05', '2009-01-22 23:38:40', 1, '', 1),
(3, 'CHEF MATTSON', '<span class="hdr">MEET CHEF DEMAL MATTSON</span>\r\n\r\n<p class="txt">Graduated from Charleston Culinary School top of his class 1992</p>\r\n\r\n<p class="txt">Chef Demal has worked in Upscale Catering and Fine Dinning Facilities since 1995\r\n\r\n<p class="txt">He Has Cooked For:<br>\r\nLee Majors<br>\r\nTed Turner<br>\r\nJane Fonda<br>\r\nBridget Fonda<br>\r\nas well as many of Charleston High-Level Executives</p>', '2009-01-27 12:58:39', '2009-01-22 23:39:37', 1, '57155384.JPG', 1),
(4, 'CONTACT', '<p><span class="hdr">CONTACT US</span></p>\r\nPlease Feel free to contact us either via e-mail at <a href="mailto:demalm3@yahoo.com">demalm3@yahoo.com</a> or via telephone at (843) 478-0368', '2009-03-23 20:52:48', '2009-01-22 23:39:37', 1, '593063828.JPG', 1),
(27, 'TESTIMONIALS', '<p><span class="hdr">\r\n<div>TESTIMONIALS</div>\r\n<div>&nbsp;</div>\r\n<div>Robert''s b day dinner was a huge sucess. Every thing was wonderfull, and the She crab soup was the best I''ve ever had. Thanks Caroline Mcquenny</div>\r\n<div>&nbsp;</div>\r\n<div>Thank you so much for the attention to all the details of Shannon&quot;s 007 theme suprise party. The food was exquised and the displays beautiful.</div>\r\n<div>Jennifer Maddox</div>\r\n<div>&nbsp;</div>\r\n<div>Chef Mattson</div>\r\n<div>The oyster roast was amazing. You and your staff really pulled out all the stops.</div>\r\n<div>The feed backon&nbsp;the fish stew was&nbsp;Incredible I''m so glad you sold me on it</div>\r\n<div>See you next year.</div>\r\n<div>thank you</div>\r\n<div>Wayne evans.</div>\r\n</span><br />\r\n<br />\r\n&nbsp;</p>', '2009-07-07 10:52:57', '2009-03-23 17:35:38', 1, '', 0),
(28, 'PERSONAL CHEF', '<p>&nbsp;PERSONAL CHEF</p>\r\n<p>Enter the personal chef information here.</p>', '2009-03-23 20:59:17', '2009-03-23 17:42:45', 1, '', 0);

-- --------------------------------------------------------

-- 
-- Table structure for table `site_users`
-- 

CREATE TABLE `site_users` (
  `userid` int(11) NOT NULL auto_increment,
  `username` varchar(10) NOT NULL default '',
  `password` varchar(50) NOT NULL default '',
  `email` varchar(50) NOT NULL default '',
  `fullname` varchar(50) default NULL,
  `site` varchar(105) NOT NULL default '',
  `country` varchar(50) NOT NULL default '',
  `city` varchar(50) NOT NULL default '',
  `tel` varchar(50) NOT NULL default '',
  `profile` text NOT NULL,
  `regdate` datetime NOT NULL default '0000-00-00 00:00:00',
  `ipaddress` varchar(50) NOT NULL default '',
  `lastlogin` datetime NOT NULL default '0000-00-00 00:00:00',
  `isactive` tinyint(1) NOT NULL default '0',
  `code` varchar(10) NOT NULL,
  PRIMARY KEY  (`userid`),
  KEY `userid` (`userid`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- 
-- Dumping data for table `site_users`
-- 

