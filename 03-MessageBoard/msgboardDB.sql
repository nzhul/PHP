-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 03, 2013 at 11:23 PM
-- Server version: 5.5.32
-- PHP Version: 5.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `msgboard`
--
CREATE DATABASE IF NOT EXISTS `msgboard` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `msgboard`;

-- --------------------------------------------------------

--
-- Table structure for table `cat`
--

CREATE TABLE IF NOT EXISTS `cat` (
  `cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `cname` varchar(50) NOT NULL,
  PRIMARY KEY (`cat_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `cat`
--

INSERT INTO `cat` (`cat_id`, `cname`) VALUES
(1, 'Diablo III'),
(2, 'Starcraft II');

-- --------------------------------------------------------

--
-- Table structure for table `msg`
--

CREATE TABLE IF NOT EXISTS `msg` (
  `msg_id` int(11) NOT NULL AUTO_INCREMENT,
  `author_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `date_added` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `content` varchar(250) NOT NULL,
  PRIMARY KEY (`msg_id`),
  KEY `author` (`author_id`),
  KEY `cat_id` (`cat_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `msg`
--

INSERT INTO `msg` (`msg_id`, `author_id`, `cat_id`, `date_added`, `title`, `content`) VALUES
(1, 1, 1, 1380834235, 'Заглавие на темата', 'Чей да помрънкам малко. Тоя народ се е побъркал,честно. Оправям си аз докоменти''пари и някъв бастун идва да залага на гонки. Аз му казвам че съм приключил той почва да мърмори. '),
(2, 1, 1, 1380836702, 'Как/Защо избрахте първия си герой?', 'В Diablo II любим ми беше Варварина и си казах, че с него ще продължа.Като играх отворената бета имах малки колебания дали да не започна с Монаха, но се радвам, че не го направих.'),
(3, 1, 2, 1380836984, 'I just got level 90', 'So I most likely have mediocre gold level skill with all three races. ^_^ One thing I learned from off racing is that all races are OP and every race has OP units.');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`) VALUES
(1, 'admin', '12345');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
