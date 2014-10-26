-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 26, 2014 at 07:03 PM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `shoptn`
--

-- --------------------------------------------------------

--
-- Table structure for table `banner`
--

CREATE TABLE IF NOT EXISTS `banner` (
  `id` int(10) NOT NULL,
  `content` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bid`
--

CREATE TABLE IF NOT EXISTS `bid` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `user` varchar(20) NOT NULL,
  `id_pro` int(10) NOT NULL,
  `count` int(10) NOT NULL,
  `status` int(5) NOT NULL,
  `create_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `note` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `bid`
--

INSERT INTO `bid` (`id`, `user`, `id_pro`, `count`, `status`, `create_on`, `note`) VALUES
(2, 'admin', 4, 3, 2, '2014-03-11 14:55:47', '');

-- --------------------------------------------------------

--
-- Table structure for table `chatoline`
--

CREATE TABLE IF NOT EXISTS `chatoline` (
  `id` int(10) NOT NULL,
  `content` varchar(500) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `diachicuahang`
--

CREATE TABLE IF NOT EXISTS `diachicuahang` (
  `id` int(10) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `describe` varchar(500) CHARACTER SET utf8 NOT NULL,
  `phone` int(255) NOT NULL,
  `map` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `donhangchitiet`
--

CREATE TABLE IF NOT EXISTS `donhangchitiet` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `idDH` int(4) NOT NULL DEFAULT '0',
  `idSP` int(4) NOT NULL DEFAULT '0',
  `SoLuong` int(4) NOT NULL DEFAULT '0',
  `Gia` int(4) NOT NULL DEFAULT '0',
  `hinhthucthanhtoan` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE IF NOT EXISTS `files` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `file_name` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `id_pro` int(10) DEFAULT NULL,
  `title` varchar(100) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=46 ;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`id`, `file_name`, `id_pro`, `title`) VALUES
(1, 'Images/1621972_531160790331733_1537751453_n.png', 13, ''),
(2, 'Images/1520741_795556893793583_1545477775_n.jpg', 13, ''),
(3, 'Images/1017724_748623385156406_2084163695_n.jpg', 1, ''),
(4, 'Images/1017724_748623385156406_2084163695_n.jpg', 22, ''),
(21, 'Images/071210ngoinhagiuadoish5%5B1%5D.jpg', 21, ''),
(22, 'Images/071210ngoinhagiuadoish5%5B1%5D.jpg', 0, ''),
(23, 'Images/1017724_748623385156406_2084163695_n.jpg', 0, ''),
(24, 'Images/1452010_649215715100583_1588219163_n.jpg', 0, ''),
(25, 'Images/071210ngoinhagiuadoish5%5B1%5D.jpg', 0, ''),
(26, 'Images/1017724_748623385156406_2084163695_n.jpg', 0, ''),
(27, 'Images/1452010_649215715100583_1588219163_n.jpg', 0, ''),
(28, 'Images/071210ngoinhagiuadoish5%5B1%5D.jpg', 0, ''),
(29, 'Images/1017724_748623385156406_2084163695_n.jpg', 0, ''),
(30, 'Images/1452010_649215715100583_1588219163_n.jpg', 0, ''),
(31, 'Images/071210ngoinhagiuadoish5%5B1%5D.jpg', 0, ''),
(32, 'Images/1017724_748623385156406_2084163695_n.jpg', 0, ''),
(33, 'Images/1452010_649215715100583_1588219163_n.jpg', 0, ''),
(34, 'Images/071210ngoinhagiuadoish5%5B1%5D.jpg', 0, ''),
(35, 'Images/1017724_748623385156406_2084163695_n.jpg', 0, ''),
(36, 'Images/1452010_649215715100583_1588219163_n.jpg', 0, ''),
(37, 'Images/071210ngoinhagiuadoish5%5B1%5D.jpg', 0, ''),
(38, 'Images/1017724_748623385156406_2084163695_n.jpg', 0, ''),
(39, 'Images/1452010_649215715100583_1588219163_n.jpg', 0, ''),
(40, 'Images/071210ngoinhagiuadoish5%5B1%5D.jpg', 0, ''),
(41, 'Images/1017724_748623385156406_2084163695_n.jpg', 0, ''),
(42, 'Images/1452010_649215715100583_1588219163_n.jpg', 0, ''),
(43, 'Images/071210ngoinhagiuadoish5%5B1%5D.jpg', 0, ''),
(44, 'Images/1017724_748623385156406_2084163695_n.jpg', 0, ''),
(45, 'Images/1452010_649215715100583_1588219163_n.jpg', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `footer`
--

CREATE TABLE IF NOT EXISTS `footer` (
  `id` int(10) NOT NULL,
  `NoiDung` varchar(255) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hotrotructuyen`
--

CREATE TABLE IF NOT EXISTS `hotrotructuyen` (
  `id` int(10) NOT NULL,
  `HoTen` varchar(255) CHARACTER SET utf8 NOT NULL,
  `Email` varchar(255) CHARACTER SET utf8 NOT NULL,
  `DienThoai` int(20) NOT NULL,
  `TinNhan` varchar(500) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lienketweb`
--

CREATE TABLE IF NOT EXISTS `lienketweb` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `Ten` varchar(255) NOT NULL DEFAULT '',
  `Url` varchar(255) NOT NULL DEFAULT '',
  `ThuTu` int(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `luottruycap`
--

CREATE TABLE IF NOT EXISTS `luottruycap` (
  `id` int(10) NOT NULL,
  `LuotTruyCap` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `maytinhbang`
--

CREATE TABLE IF NOT EXISTS `maytinhbang` (
  `id` int(10) NOT NULL,
  `parents` int(10) NOT NULL,
  `level` int(10) NOT NULL,
  `lft` int(10) NOT NULL,
  `rgt` int(10) NOT NULL,
  `idMenu` int(11) NOT NULL,
  `Ten` varchar(255) NOT NULL,
  `Hang` int(50) NOT NULL,
  `Gia` int(50) NOT NULL,
  `UrlHinh` varchar(255) NOT NULL,
  `Ghichu` varchar(255) NOT NULL,
  `AnHien` int(10) NOT NULL,
  `GiamGia` int(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `maytinhdeban`
--

CREATE TABLE IF NOT EXISTS `maytinhdeban` (
  `id` int(10) NOT NULL,
  `parents` int(10) NOT NULL,
  `level` int(10) NOT NULL,
  `lft` int(10) NOT NULL,
  `rgt` int(10) NOT NULL,
  `idMenu` int(11) NOT NULL,
  `Ten` varchar(255) NOT NULL,
  `Hang` varchar(50) NOT NULL,
  `Gia` int(50) NOT NULL,
  `UrlHinh` varchar(255) NOT NULL,
  `Ghichu` varchar(255) NOT NULL,
  `AnHien` int(10) NOT NULL,
  `GiamGia` int(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `maytinhxachtay`
--

CREATE TABLE IF NOT EXISTS `maytinhxachtay` (
  `id` int(10) NOT NULL,
  `parents` int(10) NOT NULL,
  `level` int(10) NOT NULL,
  `lft` int(10) NOT NULL,
  `rgt` int(10) NOT NULL,
  `idMenu` int(11) NOT NULL,
  `Ten` varchar(255) NOT NULL,
  `Hang` varchar(50) NOT NULL,
  `Gia` int(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nested_set_tree`
--

CREATE TABLE IF NOT EXISTS `nested_set_tree` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `lft` int(10) unsigned NOT NULL DEFAULT '0',
  `rgt` int(10) unsigned NOT NULL DEFAULT '0',
  `name` varchar(200) NOT NULL,
  `parent_id` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `lft` (`lft`),
  KEY `rgt` (`rgt`),
  KEY `parent_id` (`parent_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=66 ;

--
-- Dumping data for table `nested_set_tree`
--

INSERT INTO `nested_set_tree` (`id`, `lft`, `rgt`, `name`, `parent_id`) VALUES
(1, 0, 26, 'Maketing manager 3xxxxxx', 0),
(2, 18, 19, 'CEO 2 chắc chắn là được r mà nhỉ', 1),
(5, 21, 22, 'Sale manager 5', 6),
(6, 20, 23, 'Group A 6', 1),
(7, 14, 15, 'Group B 7', 1),
(62, 30, 31, 'bbbbbbbbbbbbbbbbbbbbb', 61),
(9, 8, 9, 'tôi yêu việt nam', 1),
(10, 12, 13, 'con con mới nào', 1),
(11, 16, 17, 'Maketing manager 3 hình như được r mà', 1),
(12, 10, 11, 'tôi yêu việt nam', 1),
(13, 24, 25, 'con con mới nào xxx', 10),
(32, 0, 7, 'themmmmmmmmmmmmmmmmm', 0),
(61, 29, 32, 'aaaaaaaaa', 0),
(36, 27, 28, 'mới tinh', 0),
(63, 1, 4, 'x', 32),
(64, 2, 3, 'nguyen', 63),
(65, 5, 6, 'nguyen1', 64);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `page_id` int(10) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image_url` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `create_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `page_id`, `name`, `description`, `image_title`, `image_url`, `status`, `create_on`) VALUES
(1, 1, 'Chân lý cuộc sống', 'hay bien giac mo thanh hanh dong', '', '', 1, '0000-00-00 00:00:00'),
(7, 1, 'aaaaaaaaaaaa', 'fdasfdsafasd', '', '', 0, '2014-04-11 08:54:42');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `name`, `description`) VALUES
(1, 'Tin tức', ''),
(2, 'Tuyển dụng', ''),
(3, 'Quảng cáo', ''),
(8, 'cccccccccccc', 'fdsafasdfsd'),
(7, 'bbbbbbbbbbbb', 'fasfdsfasdf');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `proid` int(12) NOT NULL AUTO_INCREMENT,
  `cat_id` int(9) NOT NULL DEFAULT '0',
  `pro_name` varchar(100) NOT NULL DEFAULT '',
  `hang` varchar(50) NOT NULL,
  `price` int(10) NOT NULL DEFAULT '0',
  `discounts` int(50) NOT NULL,
  `description` text NOT NULL,
  `qty` int(10) NOT NULL,
  `technique` text NOT NULL,
  `baohanh` varchar(10) NOT NULL,
  `create_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `create_off` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `image` varchar(255) NOT NULL DEFAULT '',
  `number` int(10) NOT NULL,
  `number_views` int(4) DEFAULT '0',
  `number_by` int(4) DEFAULT '0',
  `number_inventory` int(4) DEFAULT '0',
  `alias` varchar(100) NOT NULL DEFAULT '',
  `slug` varchar(100) DEFAULT '1',
  `status` int(10) NOT NULL,
  PRIMARY KEY (`proid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=31 ;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`proid`, `cat_id`, `pro_name`, `hang`, `price`, `discounts`, `description`, `qty`, `technique`, `baohanh`, `create_on`, `create_off`, `image`, `number`, `number_views`, `number_by`, `number_inventory`, `alias`, `slug`, `status`) VALUES
(27, 5, '789', '', 12, 1, 'đ&acirc;y l&agrave; sản phẩm loại A', 5, 'C&aacute;c chỉ số đều đạt ti&ecirc;u chuẩn ISO', '6', '2014-04-26 09:40:48', '0000-00-00 00:00:00', '', 0, 0, 0, 0, '', '1', 0),
(28, 5, '10', '', 12, 1, 'đ&acirc;y l&agrave; sản phẩm loại A', 5, 'C&aacute;c chỉ số đều đạt ti&ecirc;u chuẩn ISO', '6', '2014-04-26 09:41:04', '0000-00-00 00:00:00', '', 0, 0, 0, 0, '', '1', 0),
(29, 5, '11', '', 12, 1, 'đ&acirc;y l&agrave; sản phẩm loại A', 5, 'C&aacute;c chỉ số đều đạt ti&ecirc;u chuẩn ISO', '6', '2014-04-26 09:41:12', '0000-00-00 00:00:00', '', 0, 0, 0, 0, '', '1', 0),
(30, 5, '12', '', 12, 1, 'đ&acirc;y l&agrave; sản phẩm loại A', 5, 'C&aacute;c chỉ số đều đạt ti&ecirc;u chuẩn ISO', '6', '2014-04-26 09:41:19', '0000-00-00 00:00:00', '', 0, 0, 0, 0, '', '1', 0),
(23, 5, 'laptopabc', '', 12, 1, 'đ&acirc;y l&agrave; sản phẩm loại A', 5, 'C&aacute;c chỉ số đều đạt ti&ecirc;u chuẩn ISO', '6', '2014-04-26 09:39:41', '0000-00-00 00:00:00', '', 0, 0, 0, 0, '', '1', 0),
(24, 5, 'laptopdef', '', 12, 1, 'đ&acirc;y l&agrave; sản phẩm loại A', 5, 'C&aacute;c chỉ số đều đạt ti&ecirc;u chuẩn ISO', '6', '2014-04-26 09:40:02', '0000-00-00 00:00:00', '', 0, 0, 0, 0, '', '1', 0),
(25, 5, '123', '', 12, 1, 'đ&acirc;y l&agrave; sản phẩm loại A', 5, 'C&aacute;c chỉ số đều đạt ti&ecirc;u chuẩn ISO', '6', '2014-04-26 09:40:16', '0000-00-00 00:00:00', '', 0, 0, 0, 0, '', '1', 0),
(26, 5, '456', '', 12, 1, 'đ&acirc;y l&agrave; sản phẩm loại A', 5, 'C&aacute;c chỉ số đều đạt ti&ecirc;u chuẩn ISO', '6', '2014-04-26 09:40:24', '0000-00-00 00:00:00', '', 0, 0, 0, 0, '', '1', 0);

-- --------------------------------------------------------

--
-- Table structure for table `quang_cao`
--

CREATE TABLE IF NOT EXISTS `quang_cao` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `MoTa` varchar(255) NOT NULL DEFAULT '',
  `Url` varchar(255) NOT NULL DEFAULT '',
  `urlHinh` varchar(255) NOT NULL DEFAULT '',
  `idLT` int(11) NOT NULL DEFAULT '0',
  `idViTri` int(4) NOT NULL DEFAULT '1',
  `SoLanClick` int(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE IF NOT EXISTS `setting` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `about` text COLLATE utf8_unicode_ci NOT NULL,
  `map` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`id`, `title`, `phone`, `email`, `address`, `about`, `map`) VALUES
(1, 'Trang web thuong mai dien tu ban hang laptop, dien may', '01653839939', 'tuannv.bka@gmail.com', 'Hoang mai ha noi', 'Day la trang web dau tien cua toi. kkk', 'map.google.com/hanoi');

-- --------------------------------------------------------

--
-- Table structure for table `slide`
--

CREATE TABLE IF NOT EXISTS `slide` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `file_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(10) NOT NULL,
  `create_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=24 ;

--
-- Dumping data for table `slide`
--

INSERT INTO `slide` (`id`, `title`, `file_name`, `status`, `create_on`) VALUES
(1, '2222222', 'Images/071210ngoinhagiuadoish5%5B1%5D.jpg', 1, '2014-04-24 18:00:26'),
(5, '666666666666', 'Images/071210ngoinhagiuadoish5%5B1%5D.jpg', 1, '2014-04-24 18:19:24'),
(6, '666666666666', 'Images/1017724_748623385156406_2084163695_n.jpg', 1, '2014-04-24 18:19:25'),
(7, '1111111111111', 'Images/1017724_748623385156406_2084163695_n.jpg', 1, '2014-04-26 02:06:43'),
(8, '1111111111111', 'Images/1452010_649215715100583_1588219163_n.jpg', 1, '2014-04-26 02:06:43'),
(9, '1111111111111', 'Images/1475799_795571023792170_325671938_n%20(1).jpg', 1, '2014-04-26 02:06:43'),
(10, '1111111111111', 'Images/1477601_649262421762579_2108438993_n.jpg', 1, '2014-04-26 02:06:43'),
(11, '1111111111111', 'Images/1530414_795570827125523_208378483_n.jpg', 1, '2014-04-26 02:06:43'),
(12, '1111111111111', 'Images/1520741_795556893793583_1545477775_n.jpg', 1, '2014-04-26 02:06:43'),
(13, '1111111111111', 'Images/1505565_795571057125500_1543172200_n.jpg', 1, '2014-04-26 02:06:43'),
(14, '1111111111111', 'Images/1503219_795570970458842_1237873401_n.jpg', 1, '2014-04-26 02:06:43'),
(15, '1111111111111', 'Images/1017724_748623385156406_2084163695_n.jpg', 1, '2014-04-26 02:09:19'),
(16, '1111111111111', 'Images/1452010_649215715100583_1588219163_n.jpg', 1, '2014-04-26 02:09:19'),
(17, '1111111111111', 'Images/1475799_795571023792170_325671938_n%20(1).jpg', 1, '2014-04-26 02:09:19'),
(19, '1111111111111', 'Images/1530414_795570827125523_208378483_n.jpg', 1, '2014-04-26 02:09:20'),
(20, '1111111111111', 'Images/1520741_795556893793583_1545477775_n.jpg', 1, '2014-04-26 02:09:20'),
(21, '1111111111111', 'Images/1505565_795571057125500_1543172200_n.jpg', 1, '2014-04-26 02:09:20'),
(22, '1111111111111', 'Images/1503219_795570970458842_1237873401_n.jpg', 1, '2014-04-26 02:09:20'),
(23, '222', 'Images/1503219_795570970458842_1237873401_n.jpg', 1, '2014-04-26 02:12:23');

-- --------------------------------------------------------

--
-- Table structure for table `songuoionline`
--

CREATE TABLE IF NOT EXISTS `songuoionline` (
  `id` int(10) NOT NULL,
  `HoTen` varchar(255) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tuyendung`
--

CREATE TABLE IF NOT EXISTS `tuyendung` (
  `id` int(10) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `create_on` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `firstname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lastname` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `active` int(1) DEFAULT NULL,
  `created` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT AUTO_INCREMENT=24 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `firstname`, `lastname`, `email`, `address`, `active`, `created`, `modified`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', '', '', 'admin@gmail.com                                                                                                                                                                                                                    THEME COLOR                 ', 'hoang mai ha noi', NULL, NULL, NULL),
(9, 'fsdfasdf', 'fsadfsd', 'dsfadf', 'sdfasdf', 'sdfasfds', '', NULL, NULL, NULL),
(13, 'tuanabc', '55a766d78157e74805b890f4c30173bd', 'nguyen', 'tuan', 'tuanabc@gmail.com                                                                                                                                                                                                                    THEME COLOR               ', 'ha noi', NULL, NULL, NULL),
(17, 'tuan123', 'tuan123', 'tuan', 'nguyen', 'adfasd', 'dfadsf', NULL, NULL, NULL),
(21, 'tuanvn', 'tuanvn', 'nguyen', 'tuan', 'tuanvn', 'fasdf', NULL, '2014-04-26 09:34:01', NULL),
(22, 'tuannguyenvan', '056909a218bd6867d75623add9c826c5', 'nguyen', 'tuan', 'tuan', 'tuan', NULL, '2014-04-26 09:35:48', NULL),
(23, 'tuannguyenvan', '056909a218bd6867d75623add9c826c5', 'nguyen', 'tuan', 'tuan', 'tuan', NULL, '2014-04-26 09:35:49', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `y_kien`
--

CREATE TABLE IF NOT EXISTS `y_kien` (
  `id` int(10) NOT NULL,
  `idUser` int(10) NOT NULL,
  `HoTen` varchar(255) CHARACTER SET utf8 NOT NULL,
  `NoiDung` varchar(255) CHARACTER SET utf8 NOT NULL,
  `GhiChu` varchar(255) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
