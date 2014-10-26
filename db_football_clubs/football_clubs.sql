-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Окт 26 2014 г., 14:24
-- Версия сервера: 5.5.25
-- Версия PHP: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `football_clubs`
--

-- --------------------------------------------------------

--
-- Структура таблицы `clubs`
--

CREATE TABLE IF NOT EXISTS `clubs` (
  `id` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(50) NOT NULL,
  `town_id` int(4) unsigned NOT NULL,
  `year` year(4) NOT NULL,
  `annual_budget` bigint(20) NOT NULL,
  `president_id` int(4) unsigned NOT NULL,
  `stadium_id` int(4) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `id_2` (`id`),
  UNIQUE KEY `id_3` (`id`),
  UNIQUE KEY `id_4` (`id`),
  KEY `home_stadion_id` (`stadium_id`),
  KEY `town_id` (`town_id`),
  KEY `president_id` (`president_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `clubs_leagues`
--

CREATE TABLE IF NOT EXISTS `clubs_leagues` (
  `id` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `club_id` int(4) unsigned NOT NULL,
  `league_id` int(4) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `club_id` (`club_id`),
  KEY `league_id` (`league_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `clubs_trophys`
--

CREATE TABLE IF NOT EXISTS `clubs_trophys` (
  `id` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `club_id` int(4) unsigned NOT NULL,
  `trophy_id` int(4) unsigned NOT NULL,
  `count` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `id_2` (`id`),
  KEY `club_id` (`club_id`,`trophy_id`),
  KEY `trophy_id` (`trophy_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `countries`
--

CREATE TABLE IF NOT EXISTS `countries` (
  `id` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(30) NOT NULL,
  `population` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `leagues`
--

CREATE TABLE IF NOT EXISTS `leagues` (
  `id` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(40) NOT NULL,
  `country_id` int(4) unsigned NOT NULL,
  `uefa_rating` int(11) NOT NULL,
  `president_id` int(4) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `id_2` (`id`),
  KEY `country_id` (`country_id`),
  KEY `president_id` (`president_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `presidents`
--

CREATE TABLE IF NOT EXISTS `presidents` (
  `id` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(30) NOT NULL,
  `birthday` date NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `stadiums`
--

CREATE TABLE IF NOT EXISTS `stadiums` (
  `id` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(40) NOT NULL,
  `year` year(4) NOT NULL,
  `capacity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `id_2` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `towns`
--

CREATE TABLE IF NOT EXISTS `towns` (
  `id` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(30) NOT NULL,
  `country_id` int(4) unsigned NOT NULL,
  `population` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `country_id` (`country_id`),
  KEY `country_id_2` (`country_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `trophys`
--

CREATE TABLE IF NOT EXISTS `trophys` (
  `id` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(40) NOT NULL,
  `year` year(4) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `id_2` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `clubs`
--
ALTER TABLE `clubs`
  ADD CONSTRAINT `clubs_ibfk_4` FOREIGN KEY (`stadium_id`) REFERENCES `stadiums` (`id`),
  ADD CONSTRAINT `clubs_ibfk_1` FOREIGN KEY (`town_id`) REFERENCES `towns` (`id`),
  ADD CONSTRAINT `clubs_ibfk_3` FOREIGN KEY (`president_id`) REFERENCES `presidents` (`id`);

--
-- Ограничения внешнего ключа таблицы `clubs_leagues`
--
ALTER TABLE `clubs_leagues`
  ADD CONSTRAINT `clubs_leagues_ibfk_2` FOREIGN KEY (`league_id`) REFERENCES `leagues` (`id`),
  ADD CONSTRAINT `clubs_leagues_ibfk_3` FOREIGN KEY (`club_id`) REFERENCES `clubs` (`id`);

--
-- Ограничения внешнего ключа таблицы `clubs_trophys`
--
ALTER TABLE `clubs_trophys`
  ADD CONSTRAINT `clubs_trophys_ibfk_2` FOREIGN KEY (`trophy_id`) REFERENCES `trophys` (`id`),
  ADD CONSTRAINT `clubs_trophys_ibfk_3` FOREIGN KEY (`club_id`) REFERENCES `clubs` (`id`);

--
-- Ограничения внешнего ключа таблицы `leagues`
--
ALTER TABLE `leagues`
  ADD CONSTRAINT `leagues_ibfk_2` FOREIGN KEY (`president_id`) REFERENCES `presidents` (`id`),
  ADD CONSTRAINT `leagues_ibfk_1` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`);

--
-- Ограничения внешнего ключа таблицы `towns`
--
ALTER TABLE `towns`
  ADD CONSTRAINT `towns_ibfk_1` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
