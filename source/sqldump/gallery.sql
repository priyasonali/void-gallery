SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

CREATE DATABASE `gallery` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `gallery`;

CREATE TABLE IF NOT EXISTS `assign` (
  `aid` int(5) NOT NULL AUTO_INCREMENT,
  `cid` int(5) NOT NULL,
  `pid` int(5) NOT NULL,
  `vid` int(5) NOT NULL,
  PRIMARY KEY (`aid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `collection` (
  `cid` int(5) NOT NULL AUTO_INCREMENT,
  `cname` varchar(20) NOT NULL,
  `cdesc` varchar(420) NOT NULL,
  `cdate` varchar(20) NOT NULL,
  `cstatus` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`cid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `photo` (
  `pid` int(5) NOT NULL AUTO_INCREMENT,
  `pname` varchar(20) NOT NULL,
  `pdesc` varchar(140) NOT NULL,
  `pdate` varchar(20) NOT NULL,
  `pstatus` int(1) NOT NULL DEFAULT '1',
  `pview` int(5) NOT NULL,
  `pcode` varchar(100) NOT NULL,
  PRIMARY KEY (`pid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `video` (
  `vid` int(11) NOT NULL AUTO_INCREMENT,
  `vname` varchar(20) NOT NULL,
  `vdesc` varchar(140) NOT NULL,
  `vdate` varchar(20) NOT NULL,
  `vstatus` int(1) NOT NULL DEFAULT '1',
  `vview` int(5) NOT NULL,
  `vcode` varchar(100) NOT NULL,
  PRIMARY KEY (`vid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;