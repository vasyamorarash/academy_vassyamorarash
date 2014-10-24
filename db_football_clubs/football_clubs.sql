-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Окт 24 2014 г., 21:37
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
-- Структура таблицы `club`
--

CREATE TABLE IF NOT EXISTS `club` (
  `id` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(50) NOT NULL,
  `town` char(40) NOT NULL,
  `country` char(30) NOT NULL,
  `year` int(11) NOT NULL,
  `annual_budget` bigint(20) NOT NULL,
  `president_name` char(30) NOT NULL,
  `home_stadion_id` int(4) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `id_2` (`id`),
  UNIQUE KEY `id_3` (`id`),
  UNIQUE KEY `id_4` (`id`),
  KEY `home_stadion_id` (`home_stadion_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `club`
--

INSERT INTO `club` (`id`, `name`, `town`, `country`, `year`, `annual_budget`, `president_name`, `home_stadion_id`) VALUES
(1, 'Манчестер Юнайтед', 'Манчестер', 'Англія', 1878, 200000000, 'Эд Вудворд', 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `clubs_leagues`
--

INSERT INTO `clubs_leagues` (`id`, `club_id`, `league_id`) VALUES
(1, 1, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `clubs_trophys`
--

CREATE TABLE IF NOT EXISTS `clubs_trophys` (
  `id` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `club_id` int(4) unsigned NOT NULL,
  `trophy_id` int(4) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `id_2` (`id`),
  KEY `club_id` (`club_id`,`trophy_id`),
  KEY `trophy_id` (`trophy_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `clubs_trophys`
--

INSERT INTO `clubs_trophys` (`id`, `club_id`, `trophy_id`) VALUES
(1, 1, 1),
(2, 1, 4);

-- --------------------------------------------------------

--
-- Структура таблицы `league`
--

CREATE TABLE IF NOT EXISTS `league` (
  `id` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(40) NOT NULL,
  `country` char(30) NOT NULL,
  `rating_uefa` int(11) NOT NULL,
  `president_name` char(40) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `id_2` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `league`
--

INSERT INTO `league` (`id`, `name`, `country`, `rating_uefa`, `president_name`) VALUES
(2, 'Премьер-лига', 'Англия', 2, 'Дэвид Ричардс'),
(3, 'Ла Лига', 'Испания', 1, 'Хосе Луис Астиасаран');

-- --------------------------------------------------------

--
-- Структура таблицы `stadium`
--

CREATE TABLE IF NOT EXISTS `stadium` (
  `id` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(40) NOT NULL,
  `year` int(11) NOT NULL,
  `capacity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `id_2` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `stadium`
--

INSERT INTO `stadium` (`id`, `name`, `year`, `capacity`) VALUES
(1, 'Олд Траффорд', 1910, 75765),
(2, 'Камп Ноу', 1957, 99354);

-- --------------------------------------------------------

--
-- Структура таблицы `trophy`
--

CREATE TABLE IF NOT EXISTS `trophy` (
  `id` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(40) NOT NULL,
  `year` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `id_2` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `trophy`
--

INSERT INTO `trophy` (`id`, `name`, `year`) VALUES
(1, 'Кубок Англии', 1871),
(2, 'Кубок Футбольной лиги', 1960),
(3, 'Ла Лига', 1929),
(4, 'Премьер-лига', 1992);

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `club`
--
ALTER TABLE `club`
  ADD CONSTRAINT `club_ibfk_2` FOREIGN KEY (`home_stadion_id`) REFERENCES `stadium` (`id`);

--
-- Ограничения внешнего ключа таблицы `clubs_leagues`
--
ALTER TABLE `clubs_leagues`
  ADD CONSTRAINT `clubs_leagues_ibfk_2` FOREIGN KEY (`league_id`) REFERENCES `league` (`id`),
  ADD CONSTRAINT `clubs_leagues_ibfk_1` FOREIGN KEY (`club_id`) REFERENCES `club` (`id`);

--
-- Ограничения внешнего ключа таблицы `clubs_trophys`
--
ALTER TABLE `clubs_trophys`
  ADD CONSTRAINT `clubs_trophys_ibfk_2` FOREIGN KEY (`trophy_id`) REFERENCES `trophy` (`id`),
  ADD CONSTRAINT `clubs_trophys_ibfk_1` FOREIGN KEY (`club_id`) REFERENCES `club` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
