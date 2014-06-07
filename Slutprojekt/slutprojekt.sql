-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Värd: localhost
-- Skapad: 07 jun 2014 kl 18:49
-- Serverversion: 5.5.16
-- PHP-version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databas: `slutprojekt`
--

-- --------------------------------------------------------

--
-- Tabellstruktur `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `summary_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `comment` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`),
  UNIQUE KEY `summary_id` (`summary_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellstruktur `courses`
--

CREATE TABLE IF NOT EXISTS `courses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `field_id` int(11) NOT NULL,
  `course` varchar(32) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `field_id` (`field_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=37 ;

--
-- Dumpning av Data i tabell `courses`
--

INSERT INTO `courses` (`id`, `field_id`, `course`) VALUES
(3, 1, 'Matte 1'),
(4, 1, 'Matte 2'),
(5, 1, 'Matte 3'),
(6, 1, 'Matte 4'),
(7, 1, 'Matte 5'),
(8, 2, 'Svenska 1'),
(9, 2, 'Svenska 2'),
(10, 2, 'Svenska 3'),
(11, 3, 'Engelska 5'),
(12, 3, 'Engelska 6'),
(13, 3, 'Engelska 7'),
(14, 4, 'Idrott 1'),
(15, 4, 'Idrott 2'),
(16, 5, 'Fysik 1a'),
(17, 5, 'Fysik 2'),
(18, 6, 'Teknik 1'),
(19, 6, 'Teknik 2'),
(20, 7, 'Programmering 1'),
(21, 7, 'Programmering 2'),
(22, 8, 'Webbutveckling 1'),
(23, 8, 'Webbutveckling 2'),
(24, 8, 'Webbutveckling 3'),
(25, 9, 'Gränssnitt 0'),
(26, 10, 'Webbserverprogrammering 1'),
(27, 10, 'Webbserverprogrammering 2'),
(28, 11, 'Datorteknik 1a'),
(29, 11, 'Datorteknik support'),
(30, 12, 'Historia 1a1'),
(31, 13, 'Religion 1'),
(32, 13, 'Religion 2'),
(33, 14, 'Samhällskunskap 1b'),
(34, 14, 'Samhällskunskap 2'),
(35, 15, 'Kemi 1'),
(36, 15, 'Kemi 2');

-- --------------------------------------------------------

--
-- Tabellstruktur `fields`
--

CREATE TABLE IF NOT EXISTS `fields` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `field` varchar(32) CHARACTER SET utf8mb4 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumpning av Data i tabell `fields`
--

INSERT INTO `fields` (`id`, `field`) VALUES
(1, 'Matte'),
(2, 'Svenska'),
(3, 'Engelska'),
(4, 'Idrott'),
(5, 'Fysik'),
(6, 'Teknik'),
(7, 'Programmering'),
(8, 'Webbutveckling'),
(9, 'Gränssnitt'),
(10, 'Webbserverprogrammering'),
(11, 'Datorteknik'),
(12, 'Historia'),
(13, 'Religion'),
(14, 'Samhäll'),
(15, 'Kemi');

-- --------------------------------------------------------

--
-- Tabellstruktur `requests`
--

CREATE TABLE IF NOT EXISTS `requests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `request` text NOT NULL,
  `title` varchar(32) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `course_id` (`course_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumpning av Data i tabell `requests`
--

INSERT INTO `requests` (`id`, `user_id`, `course_id`, `request`, `title`) VALUES
(1, 2, 28, 'swag', 'swag'),
(2, 2, 14, 'Hej jag skulle vilja ha lite tips på hur man står i 90 grader längre :)', 'Jympa');

-- --------------------------------------------------------

--
-- Tabellstruktur `summaries`
--

CREATE TABLE IF NOT EXISTS `summaries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `title` varchar(32) NOT NULL,
  `content` text NOT NULL,
  `course_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `course_id` (`course_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumpning av Data i tabell `summaries`
--

INSERT INTO `summaries` (`id`, `user_id`, `date`, `title`, `content`, `course_id`) VALUES
(1, 1, '2014-05-20 13:00:31', 'guguu', 'egugg', 1),
(2, 2, '2014-05-20 13:03:37', 'swag', 'swag', 0),
(3, 1, '2014-05-20 13:13:26', 'owaow', 'hej på dig', 0),
(4, 2, '2014-05-20 13:15:55', 'vad man ska göra', 'Search, statistik med urval, olika sätt att komma åt allt, säkerhet på allt som har men input av användar att göra', 0),
(5, 2, '2014-05-27 14:20:17', 'swga', 'swag', 28),
(6, 2, '2014-05-27 14:20:40', 'swag', 'swagaaaa', 28),
(7, 2, '2014-05-27 15:40:14', 'godis', 'godis', 28),
(8, 2, '2014-05-27 20:00:47', 'hejsan', 'nemen hej, jag undrar om jag skulle kunna få en sammanfattning på matte 3c kursen, kapitel 4 gäller det.TACK', 28),
(9, 2, '2014-05-27 20:01:53', 'hejsan', 'nemen hej, jag undrar om jag skulle kunna få en sammanfattning på matte 3c kursen, kapitel 4 gäller det.TACK', 28);

-- --------------------------------------------------------

--
-- Tabellstruktur `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumpning av Data i tabell `users`
--

INSERT INTO `users` (`id`, `name`) VALUES
(1, 'Gugge'),
(2, 'Emil'),
(3, 'Kalle');

--
-- Restriktioner för dumpade tabeller
--

--
-- Restriktioner för tabell `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`summary_id`) REFERENCES `summaries` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
