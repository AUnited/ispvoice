-- phpMyAdmin SQL Dump
-- version 3.4.2
-- http://www.phpmyadmin.net
--
-- Hostiteľ: DELETED
-- Vygenerované:: 18.Jún, 2011 - 15:07
-- Verzia serveru: 5.0.77
-- Verzia PHP: 5.3.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databáza: `wordpress`
--

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `ispvoice_settings`
--

CREATE TABLE IF NOT EXISTS `ispvoice_settings` (
  `id` int(3) NOT NULL,
  `name` varchar(20) character set utf8 NOT NULL,
  `value` varchar(250) character set utf8 NOT NULL,
  `enabled` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Sťahujem dáta pre tabuľku `ispvoice_settings`
--

INSERT INTO `ispvoice_settings` (`id`, `name`, `value`, `enabled`) VALUES
(1, 'domain', 'sk;23.99;12', 1),
(2, 'domain', 'cz;23.99;12', 1),
(2, 'invoice', 'e-mail;12;1;0', 1),
(3, 'invoice', 'post;12;5;0', 1),
(1, 'domain_period', '1 year;1', 1),
(2, 'domain_period', '2 years;2', 1),
(3, 'domain', 'eu;23.99;12', 1),
(1, 'payment_period', '3;quarterly;0', 1),
(2, 'payment_period', '6;half-year;0', 1),
(3, 'payment_period', '12;yearly;select', 1),
(4, 'domain', 'com;23.99;12', 1),
(5, 'domain', 'com;23.99;12', 1),
(6, 'domain', 'net;23.99;12', 1),
(7, 'domain', 'org;23.99;12', 1),
(8, 'domain', 'biz;23.99;12', 1),
(9, 'domain', 'info;23.99;12', 1),
(10, 'domain', 'name;23.99;12', 1),
(1, 'invoice', 'download;12;0;select', 1),
(1, 'identifier', '11', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
