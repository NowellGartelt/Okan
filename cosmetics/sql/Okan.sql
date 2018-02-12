# ************************************************************
# Sequel Pro SQL dump
# バージョン 4529
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# ホスト: 127.0.0.1 (MySQL 5.6.38)
# データベース: Okan
# 作成時刻: 2018-02-12 12:01:16 +0000
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
  `personalID` int(11) NOT NULL,
  `categoryName` char(15) DEFAULT NULL,
  `loginID` char(10) DEFAULT NULL,
  `userID` int(11) NOT NULL,
  `registDate` datetime DEFAULT NULL,
  `updateDate` datetime DEFAULT NULL,
  PRIMARY KEY (`categoryID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# テーブルのダンプ incKogoto
# ------------------------------------------------------------

DROP TABLE IF EXISTS `incKogoto`;

CREATE TABLE `incKogoto` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `message` text,
  `lower_income` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `incKogoto` WRITE;
/*!40000 ALTER TABLE `incKogoto` DISABLE KEYS */;

INSERT INTO `incKogoto` (`id`, `message`, `lower_income`)
VALUES
	(1,'ちょっと、もっと稼いで来なさいよ',0),
	(2,'まぁまぁ稼いできたじゃない',10000),
	(3,'その調子でもっと稼いできなさい',200000),
	(4,'すごいじゃないの',1000000);

/*!40000 ALTER TABLE `incKogoto` ENABLE KEYS */;
UNLOCK TABLES;


# テーブルのダンプ incomeTable
# ------------------------------------------------------------

DROP TABLE IF EXISTS `incomeTable`;

CREATE TABLE `incomeTable` (
  `incomeID` int(11) NOT NULL AUTO_INCREMENT,
  `incName` char(20) NOT NULL DEFAULT '',
  `income` int(11) NOT NULL,
  `incCategoryName` text,
  `incCategory` int(11) DEFAULT NULL,
  `incState` text,
  `incDate` date NOT NULL,
  `registDate` datetime NOT NULL,
  `updateDate` datetime DEFAULT NULL,
  `loginID` char(11) DEFAULT '',
  `userID` int(11) NOT NULL,
  PRIMARY KEY (`incomeID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



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
  `personalID` int(11) NOT NULL,
  `categoryName` char(15) DEFAULT NULL,
  `loginID` char(10) DEFAULT NULL,
  `userID` int(11) NOT NULL,
  `registDate` datetime DEFAULT NULL,
  `updateDate` datetime DEFAULT NULL,
  PRIMARY KEY (`categoryID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# テーブルのダンプ payKogoto
# ------------------------------------------------------------

DROP TABLE IF EXISTS `payKogoto`;

CREATE TABLE `payKogoto` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `message` text,
  `lower_payment` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `payKogoto` WRITE;
/*!40000 ALTER TABLE `payKogoto` DISABLE KEYS */;

INSERT INTO `payKogoto` (`id`, `message`, `lower_payment`)
VALUES
	(1,'しょうがないわね、今日だけよ',0),
	(2,'ヤバいもの買ったんじゃじゃないでしょうね？',3000),
	(3,'高っか！バカじゃないのアンタ！',30000);

/*!40000 ALTER TABLE `payKogoto` ENABLE KEYS */;
UNLOCK TABLES;


# テーブルのダンプ paymentTable
# ------------------------------------------------------------

DROP TABLE IF EXISTS `paymentTable`;

CREATE TABLE `paymentTable` (
  `paymentID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `payName` char(20) NOT NULL DEFAULT '',
  `payment` int(11) NOT NULL,
  `payCategoryName` text,
  `payCategory` int(11) DEFAULT NULL,
  `payState` text,
  `payDate` date NOT NULL,
  `registDate` datetime NOT NULL,
  `updateDate` datetime DEFAULT NULL,
  `loginID` char(11) DEFAULT '',
  `userID` int(11) NOT NULL,
  `taxFlg` tinyint(1) DEFAULT NULL,
  `tax` tinyint(3) DEFAULT '0',
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
  `addDate` datetime NOT NULL,
  `name` varchar(10) NOT NULL DEFAULT '',
  `updateDate` datetime DEFAULT NULL,
  `isAdmin` tinyint(1) NOT NULL DEFAULT '0',
  `question` text NOT NULL,
  `answer` text NOT NULL,
  `deleteFlag` tinyint(1) NOT NULL DEFAULT '0',
  `defTax` tinyint(3) NOT NULL DEFAULT '0',
  `payNameFlg` tinyint(1) NOT NULL,
  `payCateFlg` tinyint(1) NOT NULL,
  `paymentFlg` tinyint(1) NOT NULL,
  `payMemoFlg` tinyint(1) NOT NULL,
  `taxCalcFlg` tinyint(1) NOT NULL,
  `incNameFlg` tinyint(1) NOT NULL,
  `incCateFlg` tinyint(1) NOT NULL,
  `incMemoFlg` tinyint(1) NOT NULL,
  PRIMARY KEY (`userID`),
  UNIQUE KEY `loginID` (`loginID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
