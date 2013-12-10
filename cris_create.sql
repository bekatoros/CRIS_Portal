-- phpMyAdmin SQL Dump
-- version 3.5.8.1
-- http://www.phpmyadmin.net
--
-- Φιλοξενητής: localhost
-- Χρόνος δημιουργίας: 20 Νοε 2013 στις 10:56:24
-- Έκδοση διακομιστή: 5.5.29-MariaDB-log
-- Έκδοση PHP: 5.3.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Βάση: `cris`
--

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `cfFund`
--

DROP TABLE IF EXISTS `cfFund`;
CREATE TABLE IF NOT EXISTS `cfFund` (
  `cfFundId` int(11) NOT NULL AUTO_INCREMENT,
  `cfStartDate` varchar(8) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `cfEndDate` varchar(8) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `cfAmount` int(11) DEFAULT NULL,
  `cfName` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `cuName_el` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `cuOwnerId` int(11) DEFAULT NULL,
  PRIMARY KEY (`cfFundId`),
  KEY `cuOwnerId` (`cuOwnerId`)
) ENGINE=InnoDB  DEFAULT CHARSET=koi8r AUTO_INCREMENT=28 ;

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `cfOrgUnit_ResPubl`
--

DROP TABLE IF EXISTS `cfOrgUnit_ResPubl`;
CREATE TABLE IF NOT EXISTS `cfOrgUnit_ResPubl` (
  `cfOrg_UnitId` int(11) NOT NULL,
  `cfResPublid` int(11) NOT NULL,
  KEY `fk_cfOrgUnit_ResPubl_1_idx` (`cfOrg_UnitId`),
  KEY `fk_cfOrgUnit_ResPubl_2_idx` (`cfResPublid`),
  KEY `fk_cfOrgUnit_ResPubl_2` (`cfResPublid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `cfOrg_Unit`
--

DROP TABLE IF EXISTS `cfOrg_Unit`;
CREATE TABLE IF NOT EXISTS `cfOrg_Unit` (
  `cfOrg_UnitId` int(11) NOT NULL AUTO_INCREMENT,
  `cfCurrCode` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cfName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cuName_el` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `irCollectionId` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`cfOrg_UnitId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='θα έχει πολυγλωσσικό περιεχόμενο;' AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `cfPers`
--

DROP TABLE IF EXISTS `cfPers`;
CREATE TABLE IF NOT EXISTS `cfPers` (
  `cfPersId` int(11) NOT NULL AUTO_INCREMENT,
  `cfBirthdate` date DEFAULT NULL,
  `cfGender` char(1) COLLATE utf8_bin DEFAULT NULL,
  `cfFamilyNames` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `cfOtherNames` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `cfFirstNames` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `cuEmail` varchar(45) COLLATE utf8_bin NOT NULL,
  `cuWebsite` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `cuCrisEnabled` tinyint(1) DEFAULT NULL,
  `cuRoleID` tinyint(4) DEFAULT NULL,
  `cuFamilyNames_el` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `cuFirstNames_el` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `cuTeaching` text COLLATE utf8_bin,
  `cuTelephone` varchar(15) COLLATE utf8_bin DEFAULT NULL,
  `cuContact` text COLLATE utf8_bin,
  `cuCurrentPosId` int(11) DEFAULT NULL,
  `cuPhoto` varchar(50) COLLATE utf8_bin NOT NULL DEFAULT 'default-avatar.svg',
  PRIMARY KEY (`cfPersId`),
  UNIQUE KEY `cuEmail` (`cuEmail`),
  KEY `cuCurrentPosId` (`cuCurrentPosId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Θα έχει πολυγλωσσικα τα στοιχεία;\n\nΑν το OrgUnit αναφέρεται ' AUTO_INCREMENT=34 ;

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `cfPers_CV`
--

DROP TABLE IF EXISTS `cfPers_CV`;
CREATE TABLE IF NOT EXISTS `cfPers_CV` (
  `cfPersId` int(11) NOT NULL,
  `cfCVDoc` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cfCVDoc_el` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  KEY `fk_cfPers_CV_1_idx` (`cfPersId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `cfPers_OrgUnit`
--

DROP TABLE IF EXISTS `cfPers_OrgUnit`;
CREATE TABLE IF NOT EXISTS `cfPers_OrgUnit` (
  `cfPersId` int(11) NOT NULL,
  `cfOrg_UnitId` int(11) NOT NULL,
  KEY `fk_cfPers_OrgUnit_1_idx` (`cfPersId`),
  KEY `fk_cfPers_OrgUnit_2_idx` (`cfOrg_UnitId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `cfPers_ResPubl`
--

DROP TABLE IF EXISTS `cfPers_ResPubl`;
CREATE TABLE IF NOT EXISTS `cfPers_ResPubl` (
  `cfResPublid` int(11) NOT NULL,
  `cfPersId` int(11) NOT NULL,
  `cfStartDate` date DEFAULT NULL,
  `cfEndDate` date DEFAULT NULL,
  `cuOrderNum` int(11) DEFAULT NULL,
  KEY `fk_cfPers_ResPubl_1_idx` (`cfPersId`),
  KEY `fk_cfPers_ResPubl_2_idx` (`cfResPublid`),
  KEY `fk_cfPers_ResPubl_2` (`cfResPublid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `cfProj`
--

DROP TABLE IF EXISTS `cfProj`;
CREATE TABLE IF NOT EXISTS `cfProj` (
  `cfProjId` int(11) NOT NULL AUTO_INCREMENT,
  `cfStartDate` varchar(8) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cfEndDate` varchar(8) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cfTitle` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cuTitle_el` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cuProjCode` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cuManagerId` int(11) DEFAULT NULL,
  PRIMARY KEY (`cfProjId`),
  KEY `cuManagerId` (`cuManagerId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `cfProj_Fund`
--

DROP TABLE IF EXISTS `cfProj_Fund`;
CREATE TABLE IF NOT EXISTS `cfProj_Fund` (
  `cfFundId` int(11) NOT NULL,
  `cfProjId` int(11) NOT NULL,
  `cfStartDate` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cfEndDate` date DEFAULT NULL,
  KEY `fk_cfProj_Fund_1_idx` (`cfProjId`),
  KEY `fk_cfProj_Fund_2_idx` (`cfFundId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `cfProj_OrgUnit`
--

DROP TABLE IF EXISTS `cfProj_OrgUnit`;
CREATE TABLE IF NOT EXISTS `cfProj_OrgUnit` (
  `cfProjId` int(11) NOT NULL,
  `cfOrg_UnitId` int(11) NOT NULL,
  `cfStartDate` date DEFAULT NULL,
  `cfEndDate` date DEFAULT NULL,
  KEY `fk_cfProj_OrgUnit_1_idx` (`cfProjId`),
  KEY `fk_cfProj_OrgUnit_2_idx` (`cfOrg_UnitId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `cfProj_Pers`
--

DROP TABLE IF EXISTS `cfProj_Pers`;
CREATE TABLE IF NOT EXISTS `cfProj_Pers` (
  `cfProjId` int(11) NOT NULL,
  `cfPersId` int(11) NOT NULL,
  `cfStartDate` date DEFAULT NULL,
  `cfEndDate` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`cfProjId`,`cfPersId`),
  KEY `fk_cfProj_Pers_1_idx` (`cfPersId`),
  KEY `fk_cfProj_Pers_2_idx` (`cfProjId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `cfProj_ResPubl`
--

DROP TABLE IF EXISTS `cfProj_ResPubl`;
CREATE TABLE IF NOT EXISTS `cfProj_ResPubl` (
  `cfProjId` int(11) NOT NULL,
  `cfResPublid` int(11) NOT NULL,
  KEY `fk_cfProj_ResPubl_1_idx` (`cfProjId`),
  KEY `fk_cfProj_ResPubl_2_idx` (`cfResPublid`),
  KEY `fk_cfProj_ResPubl_2` (`cfResPublid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `cfResPubl`
--

DROP TABLE IF EXISTS `cfResPubl`;
CREATE TABLE IF NOT EXISTS `cfResPubl` (
  `cfResPublid` int(11) NOT NULL AUTO_INCREMENT,
  `cfURI` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cfTitle` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cfResPubDate` varchar(8) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cuTitle_sec` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cuPubType` int(11) DEFAULT NULL,
  PRIMARY KEY (`cfResPublid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='θα έχει πολυγλωσσικό περιεχόμενο.  abstact kai keyword?\n' AUTO_INCREMENT=91 ;

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `cuPosition`
--

DROP TABLE IF EXISTS `cuPosition`;
CREATE TABLE IF NOT EXISTS `cuPosition` (
  `cfPersId` int(11) NOT NULL,
  `cuPositionType` int(11) DEFAULT NULL,
  `cuStartDate` varchar(8) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cuEndDate` varchar(8) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cuPositionId` int(11) NOT NULL AUTO_INCREMENT,
  `cuExtra` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`cuPositionId`),
  KEY `fk_cuPosition_1_idx` (`cfPersId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=44 ;

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `cuResearch`
--

DROP TABLE IF EXISTS `cuResearch`;
CREATE TABLE IF NOT EXISTS `cuResearch` (
  `cfPersId` int(11) DEFAULT NULL,
  `cuName` varchar(50) NOT NULL,
  `cuResearchId` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`cuResearchId`),
  KEY `cfPersId` (`cfPersId`),
  KEY `cuResearchId` (`cuResearchId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=380 ;

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `cuTeaching`
--

DROP TABLE IF EXISTS `cuTeaching`;
CREATE TABLE IF NOT EXISTS `cuTeaching` (
  `cfPersId` int(11) NOT NULL,
  `cuName` varchar(100) NOT NULL,
  `cuLessonId` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`cuLessonId`),
  KEY `cfPersId` (`cfPersId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `irCowriter`
--

DROP TABLE IF EXISTS `irCowriter`;
CREATE TABLE IF NOT EXISTS `irCowriter` (
  `cfPersId` int(11) NOT NULL,
  `cfCoPersId` int(11) NOT NULL,
  UNIQUE KEY `cfPersId` (`cfPersId`,`cfCoPersId`),
  KEY `fk_ir_Cowriter_1_idx` (`cfPersId`),
  KEY `fk_ir_Cowriter_2_idx` (`cfCoPersId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `irResPubl`
--

DROP TABLE IF EXISTS `irResPubl`;
CREATE TABLE IF NOT EXISTS `irResPubl` (
  `cfResPublid` int(11) NOT NULL,
  `irItemId` int(11) DEFAULT NULL,
  `irCollectionId` int(11) DEFAULT NULL,
  `irBitId` int(11) DEFAULT NULL,
  `irStatus` int(11) DEFAULT NULL,
  `irCitation` text COLLATE utf8_unicode_ci,
  UNIQUE KEY `irItemId_UNIQUE` (`irItemId`),
  KEY `fk_irResPubl_1_idx` (`cfResPublid`),
  KEY `fk_irResPubl_1` (`cfResPublid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='prepei na mpei kai to cv toy person';

--
-- Περιορισμοί για άχρηστους πίνακες
--

--
-- Περιορισμοί για πίνακα `cfOrgUnit_ResPubl`
--
ALTER TABLE `cfOrgUnit_ResPubl`
  ADD CONSTRAINT `cfOrgUnit_ResPubl_ibfk_2` FOREIGN KEY (`cfResPublid`) REFERENCES `cfResPubl` (`cfResPublid`),
  ADD CONSTRAINT `cfOrgUnit_ResPubl_ibfk_1` FOREIGN KEY (`cfOrg_UnitId`) REFERENCES `cfOrg_Unit` (`cfOrg_UnitId`);

--
-- Περιορισμοί για πίνακα `cfPers`
--
ALTER TABLE `cfPers`
  ADD CONSTRAINT `cfPers_ibfk_1` FOREIGN KEY (`cuCurrentPosId`) REFERENCES `cuPosition` (`cuPositionId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Περιορισμοί για πίνακα `cfPers_CV`
--
ALTER TABLE `cfPers_CV`
  ADD CONSTRAINT `cfPers_CV_ibfk_1` FOREIGN KEY (`cfPersId`) REFERENCES `cfPers` (`cfPersId`);

--
-- Περιορισμοί για πίνακα `cfPers_OrgUnit`
--
ALTER TABLE `cfPers_OrgUnit`
  ADD CONSTRAINT `cfPers_OrgUnit_ibfk_2` FOREIGN KEY (`cfOrg_UnitId`) REFERENCES `cfOrg_Unit` (`cfOrg_UnitId`),
  ADD CONSTRAINT `cfPers_OrgUnit_ibfk_1` FOREIGN KEY (`cfPersId`) REFERENCES `cfPers` (`cfPersId`);

--
-- Περιορισμοί για πίνακα `cfPers_ResPubl`
--
ALTER TABLE `cfPers_ResPubl`
  ADD CONSTRAINT `cfPers_ResPubl_ibfk_2` FOREIGN KEY (`cfPersId`) REFERENCES `cfPers` (`cfPersId`),
  ADD CONSTRAINT `cfPers_ResPubl_ibfk_1` FOREIGN KEY (`cfResPublid`) REFERENCES `cfResPubl` (`cfResPublid`);

--
-- Περιορισμοί για πίνακα `cfProj_Fund`
--
ALTER TABLE `cfProj_Fund`
  ADD CONSTRAINT `cfProj_Fund_ibfk_2` FOREIGN KEY (`cfProjId`) REFERENCES `cfProj` (`cfProjId`),
  ADD CONSTRAINT `cfProj_Fund_ibfk_1` FOREIGN KEY (`cfFundId`) REFERENCES `cfFund` (`cfFundId`);

--
-- Περιορισμοί για πίνακα `cfProj_OrgUnit`
--
ALTER TABLE `cfProj_OrgUnit`
  ADD CONSTRAINT `cfProj_OrgUnit_ibfk_2` FOREIGN KEY (`cfOrg_UnitId`) REFERENCES `cfOrg_Unit` (`cfOrg_UnitId`),
  ADD CONSTRAINT `cfProj_OrgUnit_ibfk_1` FOREIGN KEY (`cfProjId`) REFERENCES `cfProj` (`cfProjId`);

--
-- Περιορισμοί για πίνακα `cfProj_Pers`
--
ALTER TABLE `cfProj_Pers`
  ADD CONSTRAINT `cfProj_Pers_ibfk_2` FOREIGN KEY (`cfPersId`) REFERENCES `cfPers` (`cfPersId`),
  ADD CONSTRAINT `cfProj_Pers_ibfk_1` FOREIGN KEY (`cfProjId`) REFERENCES `cfProj` (`cfProjId`);

--
-- Περιορισμοί για πίνακα `cfProj_ResPubl`
--
ALTER TABLE `cfProj_ResPubl`
  ADD CONSTRAINT `cfProj_ResPubl_ibfk_2` FOREIGN KEY (`cfResPublid`) REFERENCES `cfResPubl` (`cfResPublid`),
  ADD CONSTRAINT `cfProj_ResPubl_ibfk_1` FOREIGN KEY (`cfProjId`) REFERENCES `cfProj` (`cfProjId`);

--
-- Περιορισμοί για πίνακα `cuPosition`
--
ALTER TABLE `cuPosition`
  ADD CONSTRAINT `cuPosition_ibfk_1` FOREIGN KEY (`cfPersId`) REFERENCES `cfPers` (`cfPersId`);

--
-- Περιορισμοί για πίνακα `cuResearch`
--
ALTER TABLE `cuResearch`
  ADD CONSTRAINT `cuResearch_ibfk_1` FOREIGN KEY (`cfPersId`) REFERENCES `cfPers` (`cfPersId`);

--
-- Περιορισμοί για πίνακα `cuTeaching`
--
ALTER TABLE `cuTeaching`
  ADD CONSTRAINT `cuTeaching_ibfk_1` FOREIGN KEY (`cfPersId`) REFERENCES `cfPers` (`cfPersId`);

--
-- Περιορισμοί για πίνακα `irResPubl`
--
ALTER TABLE `irResPubl`
  ADD CONSTRAINT `irResPubl_ibfk_1` FOREIGN KEY (`cfResPublid`) REFERENCES `cfResPubl` (`cfResPublid`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
