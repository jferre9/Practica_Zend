-- phpMyAdmin SQL Dump
-- version 3.3.5
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Temps de generació: 30-01-2017 a les 19:24:02
-- Versió del servidor: 5.1.49
-- Versió de PHP : 5.3.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de dades: `practica_zend`
--

-- --------------------------------------------------------

--
-- Estructura de la taula `alumne`
--

CREATE TABLE IF NOT EXISTS `alumne` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dni` varchar(10) NOT NULL,
  `nom` varchar(64) NOT NULL,
  `mail` varchar(64) NOT NULL,
  `pass` varchar(32) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `dni` (`dni`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Bolcant dades de la taula `alumne`
--

INSERT INTO `alumne` (`id`, `dni`, `nom`, `mail`, `pass`) VALUES
(1, '12345678Z', 'Nom cognom', 'jofe93@gmail.com', '12345678Z'),
(2, '11111111H', 'Nom Final', 'jofe93@gmail.com', '11111111H');

-- --------------------------------------------------------

--
-- Estructura de la taula `festa`
--

CREATE TABLE IF NOT EXISTS `festa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `data` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Bolcant dades de la taula `festa`
--


-- --------------------------------------------------------

--
-- Estructura de la taula `participant`
--

CREATE TABLE IF NOT EXISTS `participant` (
  `festa_id` int(11) NOT NULL,
  `alumne_id` int(11) NOT NULL,
  PRIMARY KEY (`festa_id`,`alumne_id`),
  KEY `alumne_id` (`alumne_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Bolcant dades de la taula `participant`
--


--
-- Restriccions per taules bolcades
--

--
-- Restriccions per la taula `participant`
--
ALTER TABLE `participant`
  ADD CONSTRAINT `participant_ibfk_2` FOREIGN KEY (`alumne_id`) REFERENCES `alumne` (`id`),
  ADD CONSTRAINT `participant_ibfk_1` FOREIGN KEY (`festa_id`) REFERENCES `festa` (`id`);
