-- phpMyAdmin SQL Dump
-- version 3.3.5
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Temps de generació: 07-02-2017 a les 15:44:38
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
  `codi` varchar(32) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `dni` (`dni`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Bolcant dades de la taula `alumne`
--

INSERT INTO `alumne` (`id`, `dni`, `nom`, `mail`, `pass`, `codi`) VALUES
(1, '12345678Z', 'Nom cognom', 'jofe93@gmail.com', '12345678Z', '831c4baa8a44083a6434b892d573846b'),
(2, '11111111H', 'Nom Final', 'jofe93@gmail.com', '11111111H', '831c4baa8a44083a6434b892d573846b'),
(4, '11111112H', 'Nom2 cognom2', 'w2.jferre@infomila.info', '11111112H', '831c4baa8a44083a6434b892d573846b'),
(5, '11111113H', 'Nom3 cognom3', 'jofe93@gmail.com', '11111113H', '831c4baa8a44083a6434b892d573846b'),
(6, '11111114H', 'Nom4 cognom4', 'jofe93@gmail.com', '11111114H', '831c4baa8a44083a6434b892d573846b'),
(7, '11111115H', 'Nom5 cognom5', 'jofe93@gmail.com', '11111115H', '831c4baa8a44083a6434b892d573846b'),
(8, '11111116H', 'Nom6 cognom6', 'jofe93@gmail.com', '11111116H', '831c4baa8a44083a6434b892d573846b'),
(9, '11111117H', 'Nom7 cognom7', 'jofe93@gmail.com', '11111117H', '831c4baa8a44083a6434b892d573846b'),
(10, '11111118H', 'Nom8 cognom8', 'jofe93@gmail.com', '11111118H', '831c4baa8a44083a6434b892d573846b'),
(11, '11111119H', 'Nom9 cognom9', 'jofe93@gmail.com', '11111119H', '831c4baa8a44083a6434b892d573846b');

-- --------------------------------------------------------

--
-- Estructura de la taula `festa`
--

CREATE TABLE IF NOT EXISTS `festa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `data` datetime NOT NULL,
  `lloc` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Bolcant dades de la taula `festa`
--

INSERT INTO `festa` (`id`, `data`, `lloc`) VALUES
(1, '2017-02-28 17:46:10', NULL),
(2, '2017-02-03 12:00:00', NULL),
(3, '2017-02-03 12:00:00', NULL),
(4, '2017-02-06 12:00:00', NULL),
(5, '2017-02-24 12:00:00', NULL),
(6, '2017-02-15 12:00:00', NULL),
(7, '2017-02-08 12:00:00', 'adasdsadasdas');

-- --------------------------------------------------------

--
-- Estructura de la taula `organitzador`
--

CREATE TABLE IF NOT EXISTS `organitzador` (
  `festa_id` int(11) NOT NULL,
  `alumne_id` int(11) NOT NULL,
  `data_naix` date NOT NULL,
  PRIMARY KEY (`festa_id`,`alumne_id`),
  KEY `alumne_id` (`alumne_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Bolcant dades de la taula `organitzador`
--

INSERT INTO `organitzador` (`festa_id`, `alumne_id`, `data_naix`) VALUES
(1, 1, '2000-02-01'),
(2, 1, '2017-02-23'),
(2, 2, '2017-02-12'),
(3, 1, '2017-02-23'),
(3, 2, '2017-02-12'),
(4, 1, '2017-02-08'),
(5, 1, '2017-02-07'),
(6, 1, '2017-02-10'),
(7, 1, '2017-02-10');

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

INSERT INTO `participant` (`festa_id`, `alumne_id`) VALUES
(1, 2),
(1, 7),
(3, 7);

--
-- Restriccions per taules bolcades
--

--
-- Restriccions per la taula `organitzador`
--
ALTER TABLE `organitzador`
  ADD CONSTRAINT `organitzador_ibfk_1` FOREIGN KEY (`festa_id`) REFERENCES `festa` (`id`),
  ADD CONSTRAINT `organitzador_ibfk_2` FOREIGN KEY (`alumne_id`) REFERENCES `alumne` (`id`);

--
-- Restriccions per la taula `participant`
--
ALTER TABLE `participant`
  ADD CONSTRAINT `participant_ibfk_1` FOREIGN KEY (`festa_id`) REFERENCES `festa` (`id`),
  ADD CONSTRAINT `participant_ibfk_2` FOREIGN KEY (`alumne_id`) REFERENCES `alumne` (`id`);
