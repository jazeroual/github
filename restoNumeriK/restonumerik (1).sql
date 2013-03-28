-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Client: 127.0.0.1
-- Généré le: Lun 07 Janvier 2013 à 16:57
-- Version du serveur: 5.5.27-log
-- Version de PHP: 5.4.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `restonumerik`
--

-- --------------------------------------------------------

--
-- Structure de la table `tblshopaddresses`
--

CREATE TABLE IF NOT EXISTS `tblshopaddresses` (
  `idAddressShop` bigint(20) NOT NULL AUTO_INCREMENT,
  `shopName` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  `zipCode` varchar(30) NOT NULL,
  `tel` varchar(30) NOT NULL,
  `lattitude` varchar(13) NOT NULL,
  `longitude` varchar(13) NOT NULL,
  `idShopExt` bigint(20) NOT NULL,
  `preparationTime` int(11) NOT NULL DEFAULT '20',
  `isOpen` varchar(1) NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`idAddressShop`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Contenu de la table `tblshopaddresses`
--

INSERT INTO `tblshopaddresses` (`idAddressShop`, `shopName`, `address`, `zipCode`, `tel`, `lattitude`, `longitude`, `idShopExt`, `preparationTime`, `isOpen`) VALUES
(1, 'Nina Sushi 16ème', '81 rue de Longchamp', '75016', '0144051098', '48.865290', '2.2846374', 2, 20, 'Y'),
(2, 'Nina Sushi  Neuilly sur Seine', '4 avenue de Madrid', '92200 ', '0146400400', '48.88426', '2.2601649', 2, 20, 'Y'),
(3, 'Nina Sushi 17ème', '30 rue Laugier', '75017', '0143800400', '48.8815432', '2.2953092', 2, 20, 'Y'),
(4, 'Nina Sushi Levallois Perret', '36 avenue de l''Europe', '92230', '0147590590', '48.8983828', '2.2821856', 2, 20, 'Y'),
(5, 'Nina Sushi 11ème', '213 boulvard Voltaire', '75011', '0142390438', '48.8520992', '2.3899432', 2, 20, 'Y'),
(6, 'Nina Sushi Saint-Mandé', '60 avenue du Général de Gaulle', '94160', '0148081612', '48.840912', '2.4176612', 2, 20, 'Y'),
(7, 'Nina Sushi Boulogne-Billancourt', '36 avenue du Général Leclerc', '92100', '0826622222', '48.8326938', '2.2401531', 2, 20, 'Y'),
(8, 'Nina Sushi 19ème', '31 avenue Simon Bolivar', '75019', '0142063130', '48.8753703', '2.3820427', 2, 20, 'Y');

-- --------------------------------------------------------

--
-- Structure de la table `tblshopzipcode`
--

CREATE TABLE IF NOT EXISTS `tblshopzipcode` (
  `idShopZipCode` bigint(20) NOT NULL AUTO_INCREMENT,
  `shopZipCode` varchar(30) NOT NULL,
  `idShopExt` bigint(20) NOT NULL,
  `idAddressShopExt` bigint(20) NOT NULL,
  `chargesDelivery` double NOT NULL DEFAULT '0',
  `ipShop` varchar(26) NOT NULL,
  `isOpen` varchar(1) NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`idShopZipCode`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Contenu de la table `tblshopzipcode`
--

INSERT INTO `tblshopzipcode` (`idShopZipCode`, `shopZipCode`, `idShopExt`, `idAddressShopExt`, `chargesDelivery`, `ipShop`, `isOpen`) VALUES
(1, '75016', 2, 1, 3, '', 'Y'),
(2, '92200', 2, 2, 0, '', 'Y'),
(3, '75017', 2, 3, 0, '', 'Y'),
(4, '92230', 2, 4, 0, '', 'Y'),
(5, '75011', 2, 5, 0, '', 'Y'),
(6, '94160', 2, 6, 0, '', 'Y'),
(7, '92100', 2, 7, 0, '', 'Y'),
(8, '75019', 2, 8, 0, '', 'Y');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
