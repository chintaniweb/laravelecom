-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 23, 2016 at 09:06 AM
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
-- Table structure for table `home_scroll`
--

CREATE TABLE IF NOT EXISTS `home_scroll` (
  `home_scroll_id` int(12) NOT NULL AUTO_INCREMENT,
  `headline` varchar(200) NOT NULL,
  `link` varchar(200) NOT NULL,
  `scroll_sort` float NOT NULL,
  `added_date` date NOT NULL,
  `updated_date` date NOT NULL,
  PRIMARY KEY (`home_scroll_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `home_scroll`
--

INSERT INTO `home_scroll` (`home_scroll_id`, `headline`, `link`, `scroll_sort`, `added_date`, `updated_date`) VALUES
(1, 'TEAS exam needed to enroll in LPN program given Thursdays in March to May.', 'http://www.wswheboces.org/news.cfm?story=513&school=0', 1, '2016-04-08', '2016-04-08');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
