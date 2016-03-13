-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2016-03-13 18:38:01
-- 服务器版本： 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `fx_trading`
--

-- --------------------------------------------------------

--
-- 表的结构 `positions`
--

CREATE TABLE IF NOT EXISTS `positions` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `price` decimal(15,2) NOT NULL DEFAULT '0.00' COMMENT '价格',
  `position` float(4,2) NOT NULL DEFAULT '0.00' COMMENT '仓位',
  `leverage` int(10) NOT NULL DEFAULT '0' COMMENT '杠杆',
  `deposits_occupied` decimal(15,2) NOT NULL DEFAULT '0.00' COMMENT '占用保证金',
  `earnings` decimal(15,2) NOT NULL DEFAULT '0.00' COMMENT '盈利',
  `round_lot` int(10) NOT NULL DEFAULT '0' COMMENT '手数量',
  `stops` decimal(15,2) NOT NULL DEFAULT '0.00' COMMENT '止损',
  `uid` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_3` (`id`),
  KEY `id` (`id`),
  KEY `id_2` (`id`),
  KEY `uid` (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `deposit` int(10) DEFAULT '0' COMMENT '本金',
  `position` float(4,2) DEFAULT '0.00' COMMENT '总仓位',
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `deposit`, `position`) VALUES
(1, 'zhang', 'zhangshansheng', 200, 0.40),
(2, 'aaaa', 'aaaaa', 4, 0.00),
(3, 'aaaa', 'aaaaa', 1, 1.00),
(4, 'aaaa', 'aaaaa', 0, 0.00),
(5, 'bbb', '111', 0, 0.00);
