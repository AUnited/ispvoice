-- phpMyAdmin SQL Dump
-- version 3.3.9.2
-- http://www.phpmyadmin.net
-- Vygenerované:: 01.Mar, 2011 - 21:13
-- Verzia serveru: 5.0.77
-- Verzia PHP: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databáza: `test01`
--

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `reseller` int(3) NOT NULL,
  `ispcpid` int(10) unsigned NOT NULL,
  `variable` int(10) unsigned NOT NULL,
  `key` varchar(200) character set utf8 NOT NULL,
  `price` varchar(10) character set utf8 NOT NULL,
  `fname` varchar(255) character set utf8 NOT NULL,
  `lname` varchar(255) character set utf8 NOT NULL,
  `gender` varchar(1) character set utf8 NOT NULL,
  `email` varchar(255) character set utf8 NOT NULL,
  `phone` varchar(30) character set utf8 NOT NULL,
  `address` varchar(255) character set utf8 NOT NULL,
  `zip` int(8) NOT NULL,
  `city` varchar(100) character set utf8 NOT NULL,
  `country` varchar(100) character set utf8 NOT NULL,
  `state` varchar(100) character set utf8 NOT NULL,
  `firm` varchar(100) character set utf8 NOT NULL,
  `ico` varchar(20) character set utf8 NOT NULL,
  `dic` varchar(20) character set utf8 NOT NULL,
  `icdph` varchar(20) character set utf8 NOT NULL,
  `dphpayer` int(2) NOT NULL,
  `payment` varchar(20) character set utf8 NOT NULL,
  `invoice` int(2) NOT NULL,
  `description` varchar(255) character set utf8 NOT NULL,
  `domain_name` varchar(200) character set utf8 NOT NULL,
  `domain_duration` int(3) unsigned NOT NULL,
  `domain_price` varchar(10) character set utf8 NOT NULL,
  `hosting_id` int(3) unsigned NOT NULL,
  `hosting_name` varchar(100) character set utf8 NOT NULL,
  `hosting_duration` int(2) unsigned NOT NULL,
  `hosting_price1` varchar(10) character set utf8 NOT NULL,
  `hosting_price2` varchar(8) character set utf8 NOT NULL,
  `nic` varchar(30) character set utf8 NOT NULL,
  `timestamp` int(10) NOT NULL,
  `activation` int(10) NOT NULL,
  `ip` varchar(20) character set utf8 NOT NULL,
  `status` varchar(10) character set utf8 NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Sťahujem dáta pre tabuľku `orders`
--


-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(3) NOT NULL,
  `name` varchar(20) character set utf8 NOT NULL,
  `value` varchar(250) character set utf8 NOT NULL,
  `enabled` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Sťahujem dáta pre tabuľku `settings`
--

INSERT INTO `settings` (`id`, `name`, `value`, `enabled`) VALUES
(1, 'domain', 'sk;50;12', 1),
(2, 'domain', 'com;38;31', 1),
(1, 'subdomain', 'test.sk;50;12', 0),
(2, 'subdomain', 'type.com;96;24', 0),
(1, 'invoice', 'e-mail yearly;12;0;1', 1),
(2, 'invoice', 'post-yearly;12;5;0', 1),
(1, 'payment', 'bank;0;bank;1', 1),
(2, 'payment', 'cash;10;cash;0', 1),
(1, 'domain_period', '1 year;1', 1),
(2, 'domain_period', '2 years;2', 1),
(3, 'payment', 'paypal;5;paypal;0', 1),
(1, 'payment_period', '3;quarterly;0', 1),
(2, 'payment_period', '6;half-year;0', 1),
(3, 'payment_period', '12;yearly;1', 1);

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `variable`
--

CREATE TABLE IF NOT EXISTS `variable` (
  `id` int(1) NOT NULL default '1',
  `year` int(2) NOT NULL,
  `count` int(6) unsigned NOT NULL auto_increment,
  PRIMARY KEY  (`count`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Sťahujem dáta pre tabuľku `variable`
--

INSERT INTO `variable` (`id`, `year`, `count`) VALUES
(1, 11, 1);
