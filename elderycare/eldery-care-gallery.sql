-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 21, 2014 at 10:47 AM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `gallery`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(500) NOT NULL,
  `description` text NOT NULL,
  `date_added` int(11) NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `name`, `description`, `date_added`) VALUES
(1, 'environment', 'environment - Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 0),
(2, 'health-care', 'health-care Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 0),
(3, 'other', 'other - Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 0),
(5, 'warcraft', 'World of Warcraft (WoW) is a massively multiplayer online role-playing game (MMORPG) created in 2004 by Blizzard Entertainment. It is the fourth released game set in the fantasy Warcraft universe, which was first introduced by Warcraft: Orcs & Humans in 1994.[4] World of Warcraft takes place within the Warcraft world of Azeroth, approximately four years after the events at the conclusion of Blizzard''s previous Warcraft release, Warcraft III: The Frozen Throne.[5] Blizzard Entertainment announced World of Warcraft on September 2, 2001.[6] The game was released on November 23, 2004, on the 10th anniversary of the Warcraft franchise.', 1408529914);

-- --------------------------------------------------------

--
-- Table structure for table `photos`
--

CREATE TABLE IF NOT EXISTS `photos` (
  `photo_id` int(11) NOT NULL AUTO_INCREMENT,
  `filename` varchar(500) NOT NULL,
  `title` varchar(250) NOT NULL,
  `description` varchar(500) NOT NULL,
  `category_id` int(11) NOT NULL,
  `date_added` int(11) NOT NULL,
  PRIMARY KEY (`photo_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `photos`
--

INSERT INTO `photos` (`photo_id`, `filename`, `title`, `description`, `category_id`, `date_added`) VALUES
(1, 'image-1.jpg', 'Title of the image - 1', 'Description of the image - 1', 1, 1407854840),
(2, 'image-2.jpg', 'Автомобилни превози', 'Организиране и извършване на автомобилни превози посредством собствен и нает автомобилен парк, включително групажни пратки в цяла Европа и Азия', 1, 1407912881),
(3, 'image-3.jpg', 'Железопътни превози', 'Организиране и извършване на железопътни и превози от и за Западна и Централна Европа, Русия, Украйна и др.', 1, 1407912965),
(4, 'image-4.jpg', 'Обзавеждане', 'Нашият дом е обзаведен само с най-съвременни и естествени продукти', 2, 1407913614),
(5, 'image-5.jpg', 'Име на снимката', 'Описание 5', 1, 1407913740),
(6, 'image-6.jpg', 'Title of the image 6', 'Description of the image 6 - kinda long description', 1, 1407913861),
(7, 'image-7.jpg', 'Title of the image 7', 'Description of image 7 - also very long and long long long john', 2, 1407913953),
(13, '1408529842.jpg', 'Black Magic Woman2 - Edited', 'Description of the black magic woman :)2', 5, 1408525441),
(14, '1408530041.jpg', 'Black Magic Woman - Original', 'Black magic has traditionally referred to the use of supernatural powers or magic for evil and selfish purposes.[1] With respect to the left-hand path and right-hand path dichotomy, black magic is the malicious counterpart of benevolent white magic. In modern times', 5, 1408530044);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(40) NOT NULL,
  `date_registered` int(11) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `date_registered`) VALUES
(2, 'dudu', 'b38b1454a9551453396a6700880551ed', 1408349427);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
