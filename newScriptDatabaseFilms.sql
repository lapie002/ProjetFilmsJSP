-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 13, 2016 at 11:02 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `projet_jsp`
--

-- --------------------------------------------------------

--
-- Table structure for table `abonne`
--

CREATE TABLE IF NOT EXISTS `abonne` (
  `IDABONNE` int(11) NOT NULL AUTO_INCREMENT,
  `NOMABONNE` varchar(128) DEFAULT NULL,
  `PRENOMABONNE` varchar(128) DEFAULT NULL,
  `ABONNEEMAIL` varchar(255) NOT NULL,
  `ABONNECHECK` varchar(255) NOT NULL,
  `MDPABONN` varchar(128) NOT NULL,
  PRIMARY KEY (`IDABONNE`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `abonne`
--

INSERT INTO `abonne` (`IDABONNE`, `NOMABONNE`, `PRENOMABONNE`, `ABONNEEMAIL`, `ABONNECHECK`, `MDPABONN`) VALUES
(2, 'Paul', 'Paul', 'Paul@picard.fr', 'checked', '123'),
(3, 'micheal', 'micheal', 'micheal.micheal@cnn.in', '', '123');

-- --------------------------------------------------------

--
-- Table structure for table `acteur`
--

CREATE TABLE IF NOT EXISTS `acteur` (
  `IDACTEUR` int(11) NOT NULL AUTO_INCREMENT,
  `NOMACTEUR` varchar(128) DEFAULT NULL,
  `PRENOMACTEUR` char(32) DEFAULT NULL,
  `IMAGEACTEUR` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`IDACTEUR`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `acteur`
--

INSERT INTO `acteur` (`IDACTEUR`, `NOMACTEUR`, `PRENOMACTEUR`, `IMAGEACTEUR`) VALUES
(1, 'Rogers', 'Paul', 'bigImageTest.jpg'),
(3, 'Henry', 'James', 'bigImageTest.jpg'),
(4, 'Henry', 'Paul', 'bigImageTest.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `administrateur`
--

CREATE TABLE IF NOT EXISTS `administrateur` (
  `IDADMIN` int(11) NOT NULL AUTO_INCREMENT,
  `NOMADMIN` varchar(128) DEFAULT NULL,
  `EMAIL` varchar(128) DEFAULT NULL,
  `MOTDEPASSE` varchar(128) DEFAULT NULL,
  `IMAGEPROFIL` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`IDADMIN`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `administrateur`
--

INSERT INTO `administrateur` (`IDADMIN`, `NOMADMIN`, `EMAIL`, `MOTDEPASSE`, `IMAGEPROFIL`) VALUES
(1, 'lapierre', 'lapierre.bruno@gmail.com', '123', 'bigImageTest.jpg'),
(2, 'doe', 'john.doe@gmail.com', '123', 'bigImageTest.jpg'),
(8, 'paul', 'paul@aorange.fr', '123', 'bigImageTest.jpg'),
(9, 'teeee', 'lapie002', '123', 'bigImageTest.jpg'),
(10, 'teeee', 'lapie002', '123', 'Penguins.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `aimer`
--

CREATE TABLE IF NOT EXISTS `aimer` (
  `IDABONNE` int(11) NOT NULL,
  `IDFILM` int(11) NOT NULL,
  PRIMARY KEY (`IDABONNE`,`IDFILM`),
  KEY `I_FK_AIMER_ABONNE` (`IDABONNE`),
  KEY `I_FK_AIMER_FILM` (`IDFILM`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `commentaire`
--

CREATE TABLE IF NOT EXISTS `commentaire` (
  `IDCOMMENTAIRE` int(11) NOT NULL AUTO_INCREMENT,
  `IDCOMMENTAIRE_REPONDRE` int(11) DEFAULT NULL,
  `TEXTCOMMENTAIRE` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`IDCOMMENTAIRE`),
  KEY `I_FK_COMMENTAIRE_COMMENTAIRE` (`IDCOMMENTAIRE_REPONDRE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `film`
--

CREATE TABLE IF NOT EXISTS `film` (
  `IDFILM` int(11) NOT NULL AUTO_INCREMENT,
  `IDREALISATEUR` int(11) NOT NULL,
  `IDGENRE` int(11) NOT NULL,
  `TITREFILM` varchar(128) DEFAULT NULL,
  `PRIXFILMLOCATION` decimal(13,2) DEFAULT NULL,
  `NBEXPDISPFILM` int(2) DEFAULT NULL,
  `RESUMELONGFILM` varchar(255) DEFAULT NULL,
  `RESUMECOURTFILM` varchar(128) DEFAULT NULL,
  `IMAGEFILM` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`IDFILM`),
  KEY `I_FK_FILM_REALISATEUR` (`IDREALISATEUR`),
  KEY `I_FK_FILM_THEME` (`IDGENRE`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `film`
--

INSERT INTO `film` (`IDFILM`, `IDREALISATEUR`, `IDGENRE`, `TITREFILM`, `PRIXFILMLOCATION`, `NBEXPDISPFILM`, `RESUMELONGFILM`, `RESUMECOURTFILM`, `IMAGEFILM`) VALUES
(2, 1, 1, 'Titanic', '20.00', 10, 'resume lg', 'resume sm', 'bigImageTest.jpg'),
(3, 1, 2, 'The best', '1000.00', 4, 'resume lg', 'resume sm', 'bigImageTest.jpg'),
(7, 2, 1, 'poop and boobs', '14.00', 14, 'xxx', 'xxx', 'bigImageTest.jpg'),
(9, 1, 6, 'big buts 4', '12.00', 6, 'xxx', 'xxx', 'bigImageTest.jpg'),
(10, 2, 7, 'pirates', '1.00', 1, 'mmm', 'mmm', 'bigImageTest.jpg'),
(11, 1, 6, 'Big big mama', '25.00', 6, 'xxx', 'xxx', 'bigImageTest.jpg'),
(12, 2, 6, 'sex toys', '125.00', 100, 'xxx', 'xxx', 'bigImageTest.jpg'),
(13, 1, 6, 'private primate ', '120.00', 65, 'xxx', 'xxx', 'bigImageTest.jpg'),
(14, 1, 6, 'big buts 7', '14.00', 18, 'xxx', 'xxx', 'bigImageTest.jpg'),
(15, 1, 6, 'poop and boobs 2', '15.00', 15, 'xxx', 'xxx', 'bigImageTest.jpg'),
(16, 1, 2, 'sex toys stroy 3', '1.00', 1, 'xxx', 'xxx', 'bigImageTest.jpg'),
(17, 1, 1, 'poop and boobs', '18.00', 18, 'xxx', 'xxx', 'bigImageTest.jpg'),
(18, 1, 2, 'private primate pooop', '17.00', 17, 'xxx', 'xxx', 'bigImageTest.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `genre`
--

CREATE TABLE IF NOT EXISTS `genre` (
  `IDGENRE` int(11) NOT NULL AUTO_INCREMENT,
  `NOMGENRE` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`IDGENRE`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=32 ;

--
-- Dumping data for table `genre`
--

INSERT INTO `genre` (`IDGENRE`, `NOMGENRE`) VALUES
(1, 'horreur'),
(2, 'romantique'),
(6, 'Erotique X'),
(7, 'Espionnage '),
(8, 'Essai '),
(9, 'Fantastique '),
(10, 'Film Ã  Sketches '),
(11, 'Film Musical '),
(12, 'Grand Spectacle '),
(13, 'Guerre '),
(14, 'Historique '),
(15, 'Horreur '),
(16, 'KaratÃ© '),
(17, 'Manga '),
(18, 'MÃ©lodrame '),
(19, 'Muet '),
(20, 'PÃ©plum '),
(21, 'Policier'),
(22, 'Politique '),
(23, 'Programme '),
(24, 'Romance '),
(25, 'Science Fiction '),
(26, 'SÃ©rial '),
(27, 'Spectacle '),
(28, 'TÃ©lÃ©film '),
(29, 'ThÃ©Ã¢tre '),
(30, 'Thriller '),
(31, 'Western ');

-- --------------------------------------------------------

--
-- Table structure for table `jouer`
--

CREATE TABLE IF NOT EXISTS `jouer` (
  `IDFILM` int(11) NOT NULL,
  `IDACTEUR` int(11) NOT NULL,
  PRIMARY KEY (`IDFILM`,`IDACTEUR`),
  KEY `I_FK_JOUER_FILM` (`IDFILM`),
  KEY `I_FK_JOUER_ACTEUR` (`IDACTEUR`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `louer`
--

CREATE TABLE IF NOT EXISTS `louer` (
  `IDABONNE` int(11) NOT NULL,
  `IDFILM` int(11) NOT NULL,
  PRIMARY KEY (`IDABONNE`,`IDFILM`),
  KEY `I_FK_LOUER_ABONNE` (`IDABONNE`),
  KEY `I_FK_LOUER_FILM` (`IDFILM`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `realisateur`
--

CREATE TABLE IF NOT EXISTS `realisateur` (
  `IDREALISATEUR` int(11) NOT NULL AUTO_INCREMENT,
  `NOMREALISATEUR` varchar(128) DEFAULT NULL,
  `PRENOMREALISATEUR` char(32) DEFAULT NULL,
  `IMAGEREALISATEUR` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`IDREALISATEUR`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `realisateur`
--

INSERT INTO `realisateur` (`IDREALISATEUR`, `NOMREALISATEUR`, `PRENOMREALISATEUR`, `IMAGEREALISATEUR`) VALUES
(1, 'Doe', 'John', 'bigImageTest.jpg'),
(2, 'rogers', 'paul', 'bigImageTest.jpg'),
(21, 'yfrysdfsdf', 'sdfsdfsdfsd', 'Penguins.jpg'),
(22, 'rogers', 'paul', 'bigImageTest.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `recommander`
--

CREATE TABLE IF NOT EXISTS `recommander` (
  `IDABONNE` int(11) NOT NULL AUTO_INCREMENT,
  `IDFILM` int(11) NOT NULL,
  `IDABONNE_1` int(11) NOT NULL,
  PRIMARY KEY (`IDABONNE`,`IDFILM`,`IDABONNE_1`),
  KEY `I_FK_RECOMMANDER_ABONNE` (`IDABONNE`),
  KEY `I_FK_RECOMMANDER_FILM` (`IDFILM`),
  KEY `I_FK_RECOMMANDER_ABONNE1` (`IDABONNE_1`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `rediger`
--

CREATE TABLE IF NOT EXISTS `rediger` (
  `IDABONNE` int(11) NOT NULL,
  `IDCOMMENTAIRE` int(11) NOT NULL,
  `IDFILM` int(11) NOT NULL,
  PRIMARY KEY (`IDABONNE`,`IDCOMMENTAIRE`,`IDFILM`),
  KEY `I_FK_REDIGER_ABONNE` (`IDABONNE`),
  KEY `I_FK_REDIGER_COMMENTAIRE` (`IDCOMMENTAIRE`),
  KEY `I_FK_REDIGER_FILM` (`IDFILM`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `suivre`
--

CREATE TABLE IF NOT EXISTS `suivre` (
  `IDABONNE` int(11) NOT NULL,
  `IDABONNE_1` int(11) NOT NULL,
  PRIMARY KEY (`IDABONNE`,`IDABONNE_1`),
  KEY `I_FK_SUIVRE_ABONNE` (`IDABONNE`),
  KEY `I_FK_SUIVRE_ABONNE1` (`IDABONNE_1`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `aimer`
--
ALTER TABLE `aimer`
  ADD CONSTRAINT `aimer_ibfk_1` FOREIGN KEY (`IDABONNE`) REFERENCES `abonne` (`IDABONNE`),
  ADD CONSTRAINT `aimer_ibfk_2` FOREIGN KEY (`IDFILM`) REFERENCES `film` (`IDFILM`);

--
-- Constraints for table `commentaire`
--
ALTER TABLE `commentaire`
  ADD CONSTRAINT `commentaire_ibfk_1` FOREIGN KEY (`IDCOMMENTAIRE_REPONDRE`) REFERENCES `commentaire` (`IDCOMMENTAIRE`);

--
-- Constraints for table `film`
--
ALTER TABLE `film`
  ADD CONSTRAINT `film_ibfk_1` FOREIGN KEY (`IDREALISATEUR`) REFERENCES `realisateur` (`IDREALISATEUR`),
  ADD CONSTRAINT `film_ibfk_2` FOREIGN KEY (`IDGENRE`) REFERENCES `genre` (`IDGENRE`);

--
-- Constraints for table `jouer`
--
ALTER TABLE `jouer`
  ADD CONSTRAINT `jouer_ibfk_1` FOREIGN KEY (`IDFILM`) REFERENCES `film` (`IDFILM`),
  ADD CONSTRAINT `jouer_ibfk_2` FOREIGN KEY (`IDACTEUR`) REFERENCES `acteur` (`IDACTEUR`);

--
-- Constraints for table `louer`
--
ALTER TABLE `louer`
  ADD CONSTRAINT `louer_ibfk_1` FOREIGN KEY (`IDABONNE`) REFERENCES `abonne` (`IDABONNE`),
  ADD CONSTRAINT `louer_ibfk_2` FOREIGN KEY (`IDFILM`) REFERENCES `film` (`IDFILM`);

--
-- Constraints for table `recommander`
--
ALTER TABLE `recommander`
  ADD CONSTRAINT `recommander_ibfk_1` FOREIGN KEY (`IDABONNE`) REFERENCES `abonne` (`IDABONNE`),
  ADD CONSTRAINT `recommander_ibfk_2` FOREIGN KEY (`IDFILM`) REFERENCES `film` (`IDFILM`),
  ADD CONSTRAINT `recommander_ibfk_3` FOREIGN KEY (`IDABONNE_1`) REFERENCES `abonne` (`IDABONNE`);

--
-- Constraints for table `rediger`
--
ALTER TABLE `rediger`
  ADD CONSTRAINT `rediger_ibfk_1` FOREIGN KEY (`IDABONNE`) REFERENCES `abonne` (`IDABONNE`),
  ADD CONSTRAINT `rediger_ibfk_2` FOREIGN KEY (`IDCOMMENTAIRE`) REFERENCES `commentaire` (`IDCOMMENTAIRE`),
  ADD CONSTRAINT `rediger_ibfk_3` FOREIGN KEY (`IDFILM`) REFERENCES `film` (`IDFILM`);

--
-- Constraints for table `suivre`
--
ALTER TABLE `suivre`
  ADD CONSTRAINT `suivre_ibfk_1` FOREIGN KEY (`IDABONNE`) REFERENCES `abonne` (`IDABONNE`),
  ADD CONSTRAINT `suivre_ibfk_2` FOREIGN KEY (`IDABONNE_1`) REFERENCES `abonne` (`IDABONNE`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
