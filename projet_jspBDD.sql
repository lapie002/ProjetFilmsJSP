-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 04, 2016 at 10:14 PM
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
  `MDPABONNE` varchar(128) NOT NULL,
  PRIMARY KEY (`IDABONNE`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `abonne`
--

INSERT INTO `abonne` (`IDABONNE`, `NOMABONNE`, `PRENOMABONNE`, `ABONNEEMAIL`, `ABONNECHECK`, `MDPABONNE`) VALUES
(2, 'Calviere', 'Paul', 'Paul@Calviere.fr', 'checked', '123'),
(3, 'Cadene', 'Thomas', 'Thomas.Cadene@rtai.fr', 'checked', '123'),
(4, 'Champeau', 'Luc ', 'Luc.Champeau@rtai.fr', 'unchecked', '123'),
(5, 'Kriouche', 'Johan ', 'Johan.Kriouche@rtai.fr', 'unchecked', '123'),
(6, 'Bason', 'Guillaume ', 'Guillaume.Bason@rtai.fr', 'unchecked', '123'),
(7, 'Debals', 'Jeremy', 'Jeremy.Debals@rtai.fr', 'checked', '123'),
(8, 'Castagnette', 'Gerard', 'Gerard.Castagnette@rtai.fr', 'checked', '123');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=36 ;

--
-- Dumping data for table `acteur`
--

INSERT INTO `acteur` (`IDACTEUR`, `NOMACTEUR`, `PRENOMACTEUR`, `IMAGEACTEUR`) VALUES
(5, 'Dicaprio', 'Leonardo', 'DiCaprio.jpg'),
(9, 'Winslet', 'Kate', 'kate Winslet.jpg'),
(10, 'Bates', 'Kathy', 'Kathy Bates.jpg'),
(11, 'Reeves', 'Keanu', 'Keanu Reeves.jpg'),
(12, 'Connelly', 'Jennifer', 'Jennifer Connelly.jpg'),
(13, 'Weaving', 'Hugo', 'Hugo Weaving.jpg'),
(14, 'Moss', 'Carrie-Anne', 'Carrie-Anne Moss.jpg'),
(15, 'Worthington', 'Sam', 'Sam Worthington.jpg'),
(16, 'Saldana', 'Zoe', 'Zoe Saldana.jpg'),
(17, 'Weaver', 'Sigourney', 'Sigourney Weaver.jpg'),
(18, 'Pratt', 'Chris', 'Chris Pratt.jpg'),
(19, 'Bautista', 'Dave', 'Dave Bautista.jpg'),
(20, 'Pitt', 'Brad', 'Brad Pitt.jpg'),
(21, 'Seymour-Hoffman', 'Philip', 'Philip Seymour Hoffman.jpg'),
(22, 'Clooney', 'George', 'George Clooney.jpg'),
(23, 'Roberts', 'Julia', 'Julia Roberts.jpg'),
(24, 'Mc Dormand', 'Frances', 'Frances McDormand.jpg'),
(25, 'Bridges', 'Jeff', 'Jeff Bridges.jpg'),
(26, 'Steinfeld', 'Hailee', 'Hailee Steinfeld.jpg'),
(27, 'Brolin', 'Josh', 'Josh Brolin.jpg'),
(28, 'Cotillard', 'Marion', 'Marion Cotillard.jpg'),
(29, 'Page', 'Ellen', 'Ellen Page.jpg'),
(30, 'Knightley', 'Keira', 'Keira Knightley.jpg'),
(31, 'Ruffalo', 'Marc', 'Mark Ruffalo.jpg'),
(32, 'Corden', 'James', 'James Corden.jpg'),
(33, 'Gosling', 'Ryan', 'Ryan Gosling.jpg'),
(34, 'Crowe', 'Russell', 'Russell Crowe.jpg'),
(35, 'Basinger', 'Kim', 'Kim Basinger.jpg');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `administrateur`
--

INSERT INTO `administrateur` (`IDADMIN`, `NOMADMIN`, `EMAIL`, `MOTDEPASSE`, `IMAGEPROFIL`) VALUES
(11, 'antoine', 'antoine@rtai.fr', '123', 'antoine.JPG'),
(12, 'arnold', 'arnold@rtai.fr', '123', 'arnold.JPG'),
(13, 'maxime', 'maxime@rtai.fr', '123', 'max.JPG'),
(14, 'bruno', 'lapierre.bruno@gmail.com', '123', 'IMG_1327.JPG');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=37 ;

--
-- Dumping data for table `film`
--

INSERT INTO `film` (`IDFILM`, `IDREALISATEUR`, `IDGENRE`, `TITREFILM`, `PRIXFILMLOCATION`, `NBEXPDISPFILM`, `RESUMELONGFILM`, `RESUMECOURTFILM`, `IMAGEFILM`) VALUES
(23, 22, 14, 'The Revenant', '20.00', 50, 'Dans une AmÃ©rique profondÃ©ment sauvage, Hugh Glass, un trappeur, est attaquÃ© par un ours et griÃ¨vement blessÃ©. AbandonnÃ© par ses Ã©quipiers, il est laissÃ© pour mort. Mais Glass refuse de mourir. Seul, armÃ© de sa volontÃ© et portÃ© par lâ€™amour qu', 'Hugh Glass, un trappeur, est attaquÃ© par un ours et griÃ¨vement blessÃ©.', 'therevenant.jpg'),
(24, 23, 33, 'Titanic', '22.00', 17, 'Southampton, 10 avril 1912. Le paquebot le plus grand et le plus moderne du monde, rÃ©putÃ© pour son insubmersibilitÃ©, le "Titanic", appareille pour son premier voyage. Quatre jours plus tard, il heurte un iceberg. A son bord, un artiste pauvre et une gr', 'Le paquebot le plus grand et le plus moderne du monde.', 'titanic.jpg'),
(25, 24, 30, 'The Day the Earth Stood Still', '5.00', 5, 'L''arrivÃ©e sur Terre de Klaatu, un extraterrestre d''apparence humaine, provoque de spectaculaires bouleversements. Tandis que les gouvernements et les scientifiques tentent dÃ©sespÃ©rÃ©ment de percer son mystÃ¨re, une femme, le docteur Helen Benson, parvi', 'L''arrivÃ©e sur Terre de Klaatu, un extraterrestre d''apparence humaine, provoque de spectaculaires bouleversements.', 'The Day the Earth Stood Still.jpg'),
(26, 25, 25, 'The Matrix', '7.00', 24, 'Programmeur anonyme dans un service administratif le jour, Thomas Anderson devient Neo la nuit venue. Sous ce pseudonyme, il est l''un des pirates les plus recherchÃ©s du cyber-espace. A cheval entre deux mondes, Neo est assailli par d''Ã©tranges songes et ', 'Programmeur anonyme dans un service administratif le jour, Thomas Anderson devient Neo la nuit', 'matrix.jpg'),
(27, 23, 25, 'Avatar', '16.00', 2, 'MalgrÃ© sa paralysie, Jake Sully, un ancien marine immobilisÃ© dans un fauteuil roulant, est restÃ© un combattant au plus profond de son Ãªtre. Il est recrutÃ© pour se rendre Ã  des annÃ©es-lumiÃ¨re de la Terre, sur Pandora, oÃ¹ de puissants groupes indus', 'MalgrÃ© sa paralysie, Jake Sully, un ancien marine immobilisÃ© dans un fauteuil roulant, est restÃ© un combattant au plus profon', 'avatar.jpg'),
(28, 26, 25, 'Guardians Of The Galaxy', '15.00', 21, 'Peter Quill est un aventurier traquÃ© par tous les chasseurs de primes pour avoir volÃ© un mystÃ©rieux globe convoitÃ© par le puissant Ronan, dont les agissements menacent lâ€™univers tout entier. Lorsquâ€™il dÃ©couvre le vÃ©ritable pouvoir de ce globe et', 'Peter Quill est un aventurier traquÃ© par tous les chasseurs de primes pour avoir volÃ© un mystÃ©rieux globe convoitÃ©.', 'Guardians Of The Galaxy.jpg'),
(29, 27, 33, 'Moneyball', '11.00', 3, 'Voici lâ€™histoire vraie de Billy Beane, un ancien joueur de baseball prometteur qui, Ã  dÃ©faut dâ€™avoir rÃ©ussi sur le terrain, dÃ©cida de tenter sa chance en dirigeant une Ã©quipe comme personne ne lâ€™avait fait auparavantâ€¦Alors que la saison 2002 ', 'Voici lâ€™histoire vraie de Billy Beane, un ancien joueur de baseball prometteur.', 'moneyball.jpg'),
(30, 28, 30, 'Ocean''s Eleven', '6.00', 9, 'AprÃ¨s deux ans passÃ©s dans la prison du New Jersey, Danny Ocean retrouve la libertÃ© et s''apprÃªte Ã  monter un coup qui semble impossible Ã  rÃ©aliser : cambrioler dans le mÃªme temps les casinos Bellagio, Mirage et MGM Grand, avec une jolie somme de 1', 'AprÃ¨s deux ans passÃ©s dans la prison du New Jersey, Danny Ocean retrouve la libertÃ© et s''apprÃªte Ã  monter un coup qui sembl', 'oceanseleven.jpg'),
(31, 29, 32, 'Burn After Reading', '9.00', 10, 'Osbourne Cox, analyste Ã  la CIA, est convoquÃ© Ã  une rÃ©union ultrasecrÃ¨te au quartier gÃ©nÃ©ral de l''Agence Ã  Arlington, en Virginie. Malheureusement pour lui, il dÃ©couvre rapidement l''objectif de cette rÃ©union : il est renvoyÃ©. Cox ne prend pas t', 'Osbourne Cox, analyste Ã  la CIA, est convoquÃ© Ã  une rÃ©union ultrasecrÃ¨te au quartier gÃ©nÃ©ral de l''Agence Ã  Arlington, en', 'burnafterreading.jpg'),
(32, 29, 31, 'True Grit', '4.00', 50, '1870, juste aprÃ¨s la guerre de SÃ©cession, sur l''ultime frontiÃ¨re de l''Ouest amÃ©ricain. Seul au monde, Mattie Ross, 14 ans, rÃ©clame justice pour la mort de son pÃ¨re, abattu de sang-froid pour deux piÃ¨ces d''or par le lÃ¢che Tom Chaney. L''assassin s''e', '1870, juste aprÃ¨s la guerre de SÃ©cession, sur l''ultime frontiÃ¨re de l''Ouest amÃ©ricain. Seul au monde, Mattie Ross, 14 ans, r', 'truegrit.jpg'),
(33, 30, 30, 'Inception', '17.00', 25, 'Dom Cobb est un voleur expÃ©rimentÃ© â€“ le meilleur qui soit dans lâ€™art pÃ©rilleux de lâ€™extraction : sa spÃ©cialitÃ© consiste Ã  sâ€™approprier les secrets les plus prÃ©cieux dâ€™un individu, enfouis au plus profond de son subconscient, pendant quâ€™', 'Dom Cobb est un voleur expÃ©rimentÃ© â€“ le meilleur qui soit dans lâ€™art pÃ©rilleux de lâ€™extraction : sa spÃ©cialitÃ© consis', 'inception.jpg'),
(34, 31, 33, 'New York Melody', '4.00', 27, 'Gretta et son petit ami viennent de dÃ©barquer Ã  NYC. La ville est d''autant plus magique pour les deux anglais qu''on leur propose de venir y vivre pleinement leur passion : la musique. Le rÃªve va se briser et l''idylle voler en Ã©clat quand, aveuglÃ© par', 'Gretta et son petit ami viennent de dÃ©barquer Ã  NYC. La ville est d''autant plus magique pour les deux anglais.', 'newyorkmelody.jpg'),
(35, 32, 32, 'The Nice Guys', '30.00', 100, 'Los Angeles. AnnÃ©es 70. Deux dÃ©tectives privÃ©s enquÃªtent sur le prÃ©tendu suicide dâ€™une starlette. MalgrÃ© des mÃ©thodes pour le moins Â« originales Â», leurs investigations vont mettre Ã  jour une conspiration impliquant des personnalitÃ©s trÃ¨s ha', 'Los Angeles. AnnÃ©es 70. Deux dÃ©tectives privÃ©s enquÃªtent sur le prÃ©tendu suicide dâ€™une starlette.', 'theniceguys.jpg'),
(36, 23, 25, 'Aliens', '3.00', 10, 'AprÃ¨s 57 ans de dÃ©rive dans l''espace, Ellen Ripley est secourue par la corporation Weyland-Yutani. MalgrÃ© son rapport concernant lâ€™incident survenu sur le Nostromo, elle nâ€™est pas prise au sÃ©rieux par les militaires quant Ã  la prÃ©sence de xÃ©nom', 'Ellen Ripley est secourue par la corporation Weyland-Yutani.', 'Aliens.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `genre`
--

CREATE TABLE IF NOT EXISTS `genre` (
  `IDGENRE` int(11) NOT NULL AUTO_INCREMENT,
  `NOMGENRE` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`IDGENRE`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=34 ;

--
-- Dumping data for table `genre`
--

INSERT INTO `genre` (`IDGENRE`, `NOMGENRE`) VALUES
(7, 'Espionnage '),
(9, 'Fantastique '),
(13, 'Guerre '),
(14, 'Historique '),
(15, 'Horreur '),
(20, 'PÃ©plum '),
(21, 'Policier'),
(22, 'Politique '),
(23, 'Programme '),
(24, 'Romance '),
(25, 'Science Fiction '),
(30, 'Thriller '),
(31, 'Western '),
(32, 'Comedie'),
(33, 'Drame');

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

--
-- Dumping data for table `jouer`
--

INSERT INTO `jouer` (`IDFILM`, `IDACTEUR`) VALUES
(23, 5),
(24, 5),
(24, 9),
(24, 10),
(25, 10),
(25, 11),
(25, 12),
(26, 11),
(26, 13),
(26, 14),
(27, 15),
(27, 16),
(27, 17),
(28, 16),
(28, 18),
(28, 19),
(29, 18),
(29, 20),
(29, 21),
(30, 20),
(30, 22),
(30, 23),
(31, 20),
(31, 22),
(31, 24),
(32, 25),
(32, 26),
(32, 27),
(33, 5),
(33, 28),
(33, 29),
(34, 30),
(34, 31),
(34, 32),
(35, 33),
(35, 34),
(35, 35),
(36, 17);

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

--
-- Dumping data for table `louer`
--

INSERT INTO `louer` (`IDABONNE`, `IDFILM`) VALUES
(2, 23),
(2, 24),
(2, 33),
(3, 25),
(3, 26),
(3, 27),
(7, 33),
(8, 31);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=33 ;

--
-- Dumping data for table `realisateur`
--

INSERT INTO `realisateur` (`IDREALISATEUR`, `NOMREALISATEUR`, `PRENOMREALISATEUR`, `IMAGEREALISATEUR`) VALUES
(22, 'GonzÃ¡lez IÃ±Ã¡rritu', 'Alejandro', 'GonzÃ¡lez.jpg'),
(23, 'Cameron', 'James', 'James Cameron.jpg'),
(24, 'Derrickson', 'Scott', 'Scott Derrickson.jpg'),
(25, 'Wachowski', 'Andrew Paul', 'Andrew Paul Wachowski.jpg'),
(26, 'Gunn', 'James', 'James Gunn.jpg'),
(27, 'Miller', 'Bennett', 'Bennett Miller.jpg'),
(28, 'Soderbergh', 'Steven', 'Steven Soderbergh.jpg'),
(29, 'Coen', 'Ethan', 'Ethan Coen.jpg'),
(30, 'Nolan', 'Christopher', 'Christopher Nolan.jpg'),
(31, 'Carney', 'John', 'John Carney.jpg'),
(32, 'Black', 'Shane', 'Shane Black.jpg');

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
