-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 31, 2013 at 07:43 PM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `fakebook`
--

-- --------------------------------------------------------

--
-- Table structure for table `photos`
--

CREATE TABLE IF NOT EXISTS `photos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `uploader` varchar(50) DEFAULT NULL,
  `date` varchar(20) DEFAULT NULL,
  `time` varchar(20) DEFAULT NULL,
  `human` varchar(10) DEFAULT NULL,
  `bird` varchar(10) DEFAULT NULL,
  `animal` varchar(10) DEFAULT NULL,
  `building` varchar(10) DEFAULT NULL,
  `vehicle` varchar(10) DEFAULT NULL,
  `object` varchar(10) DEFAULT NULL,
  `ufo` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `photos`
--

INSERT INTO `photos` (`id`, `name`, `uploader`, `date`, `time`, `human`, `bird`, `animal`, `building`, `vehicle`, `object`, `ufo`) VALUES
(1, 'fakebook_connect.jpg', 'sumedh@iitk.ac.in', '14-Apr-2013', '4:10:32 PM', '1', '0', '0', '0', '0', '0', '0'),
(2, 'option1.jpg', 'sumedh@iitk.ac.in', '14-Apr-2013', '7:07:54 PM', '0', '1', '0', '0', '0', '1', '0'),
(3, '16410_529564490407698_1754941987_n.jpg', 'sandk@iitk.ac.in', '14-Apr-2013', '7:38:40 PM', '0', '0', '1', '0', '0', '0', '0'),
(4, '182435_386825008092003_1430149720_n.jpg', 'milind@iitk.ac.in', '15-May-2013', '8:53:20 AM', '0', '1', '0', '0', '0', '0', '0'),
(5, '483752_10151524904613826_56500871_n.jpg', 'milind@iitk.ac.in', '15-May-2013', '8:55:52 AM', '0', '0', '0', '0', '0', '1', '0'),
(6, '544420_345012268944558_693613197_n.jpg', 'sumedh@iitk.ac.in', '25-May-2013', '1:39:00 PM', '0', '0', '1', '0', '0', '0', '0');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
