-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 25, 2024 at 01:42 PM
-- Server version: 5.5.25
-- PHP Version: 5.2.12

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `eeee`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `ID_P` int(3) NOT NULL AUTO_INCREMENT,
  `Name_P` varchar(30) NOT NULL,
  `Description` varchar(250) DEFAULT NULL,
  `Number` int(5) NOT NULL,
  `price` double NOT NULL,
  `img` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`ID_P`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`ID_P`, `Name_P`, `Description`, `Number`, `price`, `img`) VALUES
(1, 'Латте з молоком', 'Ква', 1, 35, '11.jpg'),
(2, 'Десерт', 'Випічка', 1, 25, '22.jpg'),
(3, 'Чай', 'Зелений', 1, 15, '23.jpg'),
(17, 'Наполеон', 'Тістечко', 1, 35, '24.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `realization`
--

CREATE TABLE IF NOT EXISTS `realization` (
  `ID` int(3) NOT NULL AUTO_INCREMENT,
  `ID_U` int(3) NOT NULL,
  `ID_P` int(3) NOT NULL,
  `DateZ` date NOT NULL,
  `Number_Z` int(20) NOT NULL,
  `cost` double NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `ID_U` (`ID_U`),
  KEY `ID_P` (`ID_P`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `realization`
--

INSERT INTO `realization` (`ID`, `ID_U`, `ID_P`, `DateZ`, `Number_Z`, `cost`) VALUES
(1, 2, 1, '0000-00-00', 2024, 3000000),
(2, 2, 2, '0000-00-00', 2024, 60000),
(3, 3, 3, '0000-00-00', 2024, 25000),
(4, 3, 1, '0000-00-00', 2024, 3000000),
(5, 3, 2, '0000-00-00', 2024, 50000),
(6, 3, 3, '0000-00-00', 2024, 25000),
(7, 0, 2, '0000-00-00', 2024, 25),
(8, 0, 2, '0000-00-00', 2024, 25),
(9, 2, 2, '0000-00-00', 2024, 25),
(10, 2, 1, '0000-00-00', 2024, 35),
(11, 2, 2, '0000-00-00', 2024, 25);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `ID_U` int(3) NOT NULL AUTO_INCREMENT,
  `Name` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `login` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  PRIMARY KEY (`ID_U`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`ID_U`, `Name`, `email`, `login`, `password`) VALUES
(1, 'Ігор', 'Ogrigor@gmail.com', 'admin', '123'),
(2, 'Даша', 'rybaikadaria@gmail.com', 'Dasha', '321'),
(6, 'kosta', 'kklpok@gmail.com', 'kklpok', '234');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
