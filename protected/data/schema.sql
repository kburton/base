SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;


CREATE TABLE `History` (
  `Type` enum('INSERT','UPDATE','DELETE') COLLATE utf8_unicode_ci NOT NULL,
  `TableName` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `PrimaryKey` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `FieldName` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `InitialValue` text COLLATE utf8_unicode_ci,
  `NewValue` text COLLATE utf8_unicode_ci,
  `UserId` int(11) NOT NULL,
  `IpAddress` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `ChangeTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=ARCHIVE DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `User` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Title` enum('Mr.','Mrs.','Miss','Ms.') COLLATE utf8_unicode_ci NOT NULL,
  `FirstName` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `LastName` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Email` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `Password` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `Status` enum('active','inactive') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'active',
  `RegistrationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `LastSuccessfulLogin` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `FailedLoginAttempts` int(11) NOT NULL DEFAULT '0',
  `IsAdmin` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`Id`),
  UNIQUE KEY `Email` (`Email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `VerificationCode` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `ForeignTableId` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `Type` enum('account_activation','password_reset') COLLATE utf8_unicode_ci NOT NULL,
  `UserId` int(11) NOT NULL,
  `VerificationCode` varchar(20) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `Created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Expires` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`Id`),
  KEY `ForeignTableId` (`ForeignTableId`,`Type`,`UserId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `YiiSession` (
  `id` char(32) COLLATE utf8_unicode_ci NOT NULL,
  `expire` int(11) DEFAULT NULL,
  `data` blob,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
