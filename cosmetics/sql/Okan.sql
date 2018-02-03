# ************************************************************
# Sequel Pro SQL dump
# バージョン 4529
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# ホスト: 127.0.0.1 (MySQL 5.6.38)
# データベース: Okan
# 作成時刻: 2018-02-03 12:16:25 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# テーブルのダンプ incCategoryTable
# ------------------------------------------------------------

DROP TABLE IF EXISTS `incCategoryTable`;

CREATE TABLE `incCategoryTable` (
  `categoryID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `personalID` int(11) DEFAULT NULL,
  `categoryName` char(15) DEFAULT NULL,
  `loginID` char(10) DEFAULT NULL,
  `registDate` date DEFAULT NULL,
  `updateDate` date DEFAULT NULL,
  PRIMARY KEY (`categoryID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# テーブルのダンプ incomeTable
# ------------------------------------------------------------

DROP TABLE IF EXISTS `incomeTable`;

CREATE TABLE `incomeTable` (
  `incomeID` int(11) NOT NULL AUTO_INCREMENT,
  `incName` char(20) NOT NULL DEFAULT '',
  `income` int(11) NOT NULL,
  `incCategory` text NOT NULL,
  `incState` text,
  `incDate` date NOT NULL,
  `registDate` datetime NOT NULL,
  `updateDate` datetime DEFAULT NULL,
  `loginID` char(11) NOT NULL DEFAULT '',
  PRIMARY KEY (`incomeID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# テーブルのダンプ kogoto
# ------------------------------------------------------------

DROP TABLE IF EXISTS `kogoto`;

CREATE TABLE `kogoto` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `message` text,
  `lower_payment` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `kogoto` WRITE;
/*!40000 ALTER TABLE `kogoto` DISABLE KEYS */;

INSERT INTO `kogoto` (`id`, `message`, `lower_payment`)
VALUES
	(1,'しょうがないわね、今日だけよ',0),
	(2,'ヤバいもの買ったんじゃじゃないでしょうね？',3000),
	(3,'高っか！　バカじゃないのアンタ！',30000);

/*!40000 ALTER TABLE `kogoto` ENABLE KEYS */;
UNLOCK TABLES;


# テーブルのダンプ methodOfPayment
# ------------------------------------------------------------

DROP TABLE IF EXISTS `methodOfPayment`;

CREATE TABLE `methodOfPayment` (
  `mopID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `paymentName` varchar(11) NOT NULL DEFAULT '',
  PRIMARY KEY (`mopID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `methodOfPayment` WRITE;
/*!40000 ALTER TABLE `methodOfPayment` DISABLE KEYS */;

INSERT INTO `methodOfPayment` (`mopID`, `paymentName`)
VALUES
	(1,'現金'),
	(2,'クレジットカード'),
	(3,'電子マネー'),
	(4,'ギフト券'),
	(5,'ポイントカード');

/*!40000 ALTER TABLE `methodOfPayment` ENABLE KEYS */;
UNLOCK TABLES;


# テーブルのダンプ payCategoryTable
# ------------------------------------------------------------

DROP TABLE IF EXISTS `payCategoryTable`;

CREATE TABLE `payCategoryTable` (
  `categoryID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `personalID` int(11) DEFAULT NULL,
  `categoryName` char(15) DEFAULT NULL,
  `loginID` char(10) DEFAULT NULL,
  `registDate` date DEFAULT NULL,
  `updateDate` date DEFAULT NULL,
  PRIMARY KEY (`categoryID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# テーブルのダンプ paymentTable
# ------------------------------------------------------------

DROP TABLE IF EXISTS `paymentTable`;

CREATE TABLE `paymentTable` (
  `paymentID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `payName` char(20) NOT NULL DEFAULT '',
  `payment` int(11) NOT NULL,
  `payCategory` text NOT NULL,
  `payState` text,
  `payDate` date NOT NULL,
  `registDate` datetime NOT NULL,
  `updateDate` datetime DEFAULT NULL,
  `loginID` char(11) NOT NULL DEFAULT '',
  `taxFlg` tinyint(1) NOT NULL,
  `tax` tinyint(3) NOT NULL DEFAULT '0',
  `mopID` int(11) DEFAULT NULL,
  PRIMARY KEY (`paymentID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# テーブルのダンプ usertable
# ------------------------------------------------------------

DROP TABLE IF EXISTS `usertable`;

CREATE TABLE `usertable` (
  `userID` int(11) NOT NULL AUTO_INCREMENT,
  `loginID` varchar(10) NOT NULL DEFAULT '',
  `loginPassword` varchar(64) NOT NULL DEFAULT '',
  `name` varchar(20) NOT NULL DEFAULT '',
  `addDate` datetime NOT NULL,
  `updateDate` datetime DEFAULT NULL,
  `isAdmin` tinyint(1) NOT NULL DEFAULT '0',
  `question` text NOT NULL,
  `answer` text NOT NULL,
  `deleteFlag` tinyint(1) NOT NULL DEFAULT '0',
  `defTax` tinyint(3) NOT NULL DEFAULT '0',
  PRIMARY KEY (`userID`),
  UNIQUE KEY `name` (`name`),
  UNIQUE KEY `loginID` (`loginID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
