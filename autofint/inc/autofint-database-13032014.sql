-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 13, 2014 at 08:01 AM
-- Server version: 5.5.24-log
-- PHP Version: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `autofint`
--

-- --------------------------------------------------------

--
-- Table structure for table `fleetrequest`
--

CREATE TABLE IF NOT EXISTS `fleetrequest` (
  `fleet_id` int(11) NOT NULL AUTO_INCREMENT,
  `date` int(11) NOT NULL,
  `a1` varchar(500) NOT NULL,
  `a2` varchar(500) NOT NULL,
  `a3` varchar(500) NOT NULL,
  `a4` varchar(500) NOT NULL,
  `a5` varchar(500) NOT NULL,
  `a6` varchar(500) NOT NULL,
  `a7` text NOT NULL,
  PRIMARY KEY (`fleet_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `fleetrequest`
--

INSERT INTO `fleetrequest` (`fleet_id`, `date`, `a1`, `a2`, `a3`, `a4`, `a5`, `a6`, `a7`) VALUES
(1, 1394464040, 'Гошо гошев', 'Голфче баце', '300000', 'ВН 4578 СН', '115416464684', '088877894', '/ Моля опитеше проблема който има колата възможно най-обстойно. /'),
(2, 1394464419, 'ааааааааа', 'аааааааааааааа', 'ааааааааааааа', 'аааааааааааааа', 'аааааааааааааа', 'ааааааааааааааааааааа', '/ Моля опитеше проблема който има колата възможно най-обстойно. /'),
(3, 1394464739, 'шшшшшшшшшш', 'шшшшшшшшшшш', 'шшшшшшшшшшшшшш', 'шшшшшшшшшшшшшшш', 'шшшшшшшшшшшшшш', 'шшшшшшшшшшшшшшшш', '/ Моля опитеше проблема който има колата възможно най-обстойно. /'),
(4, 1394464875, 'ааааааааа', 'аааааааааааааа', 'ааааааааааааа', 'аааааааааааааа', 'аааааааааааааа', 'ааааааааааааааааааааа', '/ Моля опитеше проблема който има колата възможно най-обстойно. /'),
(5, 1394465014, 'Иван алексиевeqqq', 'БМВ БАЦЕez', '50000111', 'АА 6666 ААwww', '15646546486748', '08879879874633333', 'Здравейте. Имам проблем с двигателя на пасата или по точно с педала за газта. Независимо на коя скорост карам примерно 3та карам с 50 и както си натискам педала и като го пусна рязко то присецва като дизелов камион. Правих го на друг пасат тоя номер, няма абсолютно никва грешка пускаш си педала и си укротява уборотите без да присецва. Двигател 1.8 Моно инжекция 90 конски сили бензин. Казаха ми, че може да е нещо от инжекциона. Дали е така ? Благодаря ви :)zz');

-- --------------------------------------------------------

--
-- Table structure for table `speditionrequest`
--

CREATE TABLE IF NOT EXISTS `speditionrequest` (
  `request_id` int(11) NOT NULL AUTO_INCREMENT,
  `date` int(11) NOT NULL,
  `z1` varchar(500) NOT NULL,
  `z2` varchar(500) NOT NULL,
  `a1` varchar(500) NOT NULL,
  `a2` varchar(500) NOT NULL,
  `a3` varchar(500) NOT NULL,
  `a4` varchar(500) NOT NULL,
  `a5` varchar(500) NOT NULL,
  `a6` varchar(500) NOT NULL,
  `b1` varchar(500) NOT NULL,
  `b2` varchar(500) NOT NULL,
  `b3` varchar(500) NOT NULL,
  `b4` varchar(500) NOT NULL,
  `c1` varchar(500) NOT NULL,
  `c2` varchar(500) NOT NULL,
  `c3` varchar(500) NOT NULL,
  `c4` varchar(500) NOT NULL,
  `c5h` varchar(500) NOT NULL,
  `c5l` varchar(500) NOT NULL,
  `c5w` varchar(500) NOT NULL,
  `c61` varchar(500) NOT NULL,
  `c62` varchar(500) NOT NULL,
  `c7` varchar(500) NOT NULL,
  `c8` varchar(500) NOT NULL,
  `c9` varchar(500) NOT NULL,
  `c10` varchar(500) NOT NULL,
  `c11` varchar(500) NOT NULL,
  `c12` varchar(500) NOT NULL,
  `c13` varchar(500) NOT NULL,
  `c14` varchar(500) NOT NULL,
  `c15` varchar(500) NOT NULL,
  `d1` varchar(500) NOT NULL,
  `d2` varchar(500) NOT NULL,
  `d3` varchar(500) NOT NULL,
  `d4` varchar(500) NOT NULL,
  `d5` varchar(500) NOT NULL,
  `d6` varchar(500) NOT NULL,
  `d7` varchar(500) NOT NULL,
  `d8` varchar(500) NOT NULL,
  `e1` varchar(500) NOT NULL,
  `e2` varchar(500) NOT NULL,
  `e3` varchar(500) NOT NULL,
  `placeholder` varchar(500) NOT NULL,
  PRIMARY KEY (`request_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `speditionrequest`
--

INSERT INTO `speditionrequest` (`request_id`, `date`, `z1`, `z2`, `a1`, `a2`, `a3`, `a4`, `a5`, `a6`, `b1`, `b2`, `b3`, `b4`, `c1`, `c2`, `c3`, `c4`, `c5h`, `c5l`, `c5w`, `c61`, `c62`, `c7`, `c8`, `c9`, `c10`, `c11`, `c12`, `c13`, `c14`, `c15`, `d1`, `d2`, `d3`, `d4`, `d5`, `d6`, `d7`, `d8`, `e1`, `e2`, `e3`, `placeholder`) VALUES
(9, 1394119936, 'yes', 'yes', 'Фирмата ООД', 'Роман 10а 2 3344 1', 'Адрес за корестопоо', 'БГ2333-44-55-55-', '33-3-3-3-222-5-6-67-7', 'Добримир Иванов 2', 'Гоsho ivanov', 'goshkata', '22.22222.222', 'neznam kakvo e tova', 'Knigi и други', 'no', '23', 'Кашон', '55', '33', '44', '45', '56', 'Особеност някаква', '56', 'и те тека', 'и те тека', 'no', 'no', 'и те тека', 'проценит', '245 лв.', 'гошо петров', 'роман дъге', '444234', '5553423', '234234', '234234', 'уеиуеи', 'уеиуеи', 'допълн условия', '23343', '3434', 'placeholder'),
(11, 1394195181, 'yes', 'no', 'попълнено поле', 'ПОПЪЛНЕНО ПОЛЕ', 'ПОПЪЛНЕНО ПОЛЕ', 'ПОПЪЛНЕНО ПОЛЕ', 'ПОПЪЛНЕНО ПОЛЕ', 'ПОПЪЛНЕНО ПОЛЕ', 'ПОПЪЛНЕНО ПОЛЕ', 'ПОПЪЛНЕНО ПОЛЕ', '', '', 'ПОПЪЛНЕНО ПОЛЕ', 'yes', 'ПОПЪЛНЕНО ПОЛЕ', '', '', '', '', '/ куб.м. /', '/ тов.м. /', '', 'ПОПЪЛНЕНО ПОЛЕ', '', '', 'unknown', 'unknown', '', '', '', 'ПОПЪЛНЕНО ПОЛЕ', 'ПОПЪЛНЕНО ПОЛЕ', '', '', '', '', '', '', '', '', '', 'placeholder'),
(12, 1394197527, 'yes', 'yes', 'Гошо ООД', 'София Г.м Димитров 57', 'СОФИЯ Г.М ДИМИТРОВ 57', '22--33-44-54-5-й-11-фф', 'ййй-22-bggg-334', 'Добромир Петров Петров', 'Гошо гошев Георгиев', 'Бусманци 25а', '22:30', '18:30', 'Компютри', 'yes', '3', 'кашони', '45', '26', '3', '5', '1', 'чупливо!', '10', 'ййй-й-й-444-4о-оо', 'ж5-ж5-ж-5-', 'no', 'yes', 'о-о-о-и-ои-о-', 'о-о-о-е-е-е-е-', 'у-у-у-у-у--у', 'Иван петров', 'Варна улица \\&quot;Цар иван\\&quot; 25', '22:30', '1:20', '-4-4-44-43-', '323 лева.', 'гощо петров', 'наложен платеж', 'някакви измислени допълнителни условия', '6 дена', '200 лева', 'placeholder');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(500) NOT NULL,
  `password` varchar(500) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`) VALUES
(1, 'kiril', '0f359740bd1cda994f8b55330c86d845'),
(2, 'nzhul', '82a3f212c95c1516907f27e1220c6f13');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
