-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 03, 2016 at 06:19 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `boces_cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `filing_cabinet_category_intro`
--

CREATE TABLE IF NOT EXISTS `filing_cabinet_category_intro` (
  `filing_cabinet_category_intro_id` int(12) NOT NULL AUTO_INCREMENT,
  `headline` varchar(50) NOT NULL,
  `header_image` varchar(100) NOT NULL,
  `filesystem_intro` blob NOT NULL,
  PRIMARY KEY (`filing_cabinet_category_intro_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `filing_cabinet_category_intro`
--

INSERT INTO `filing_cabinet_category_intro` (`filing_cabinet_category_intro_id`, `headline`, `header_image`, `filesystem_intro`) VALUES
(1, 'Filesystem Intro', '', 0x3c703e506c6561736520636c69636b206f6e2074686520666f6c646572732062656c6f7720746f2066696e64207468652066696c6520796f7520617265206c6f6f6b696e6720666f72203c7374726f6e673e6f723c2f7374726f6e673e20757365207468652065617379203c7374726f6e673ee2809846696e642046696c65e28099206c696e6b20746f20736561726368206279206b6579776f72643c2f7374726f6e673e2e3c2f703e0d0a);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
