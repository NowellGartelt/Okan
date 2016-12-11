# ************************************************************
# Sequel Pro SQL dump
# バージョン 4529
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# ホスト: 127.0.0.1 (MySQL 5.5.42)
# データベース: Okan
# 作成時刻: 2016-12-10 07:07:51 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# テーブルのダンプ paymentTable
# ------------------------------------------------------------

DROP TABLE IF EXISTS `paymentTable`;

CREATE TABLE `paymentTable` (
  `paymentID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `payName` text NOT NULL,
  `payment` int(11) NOT NULL,
  `payCategory` text NOT NULL,
  `payState` text,
  `payDate` date NOT NULL,
  `registDate` date NOT NULL,
  `updateDate` date DEFAULT NULL,
  PRIMARY KEY (`paymentID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# テーブルのダンプ usertable
# ------------------------------------------------------------

DROP TABLE IF EXISTS `usertable`;

CREATE TABLE `usertable` (
  `userid` int(11) NOT NULL AUTO_INCREMENT,
  `loginId` varchar(10) NOT NULL,
  `loginPassword` varchar(64) NOT NULL DEFAULT '',
  `name` varchar(20) NOT NULL DEFAULT '',
  `adddate` datetime NOT NULL,
  `updatedate` datetime DEFAULT NULL,
  `isAdmin` int(1) NOT NULL,
  PRIMARY KEY (`userid`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
