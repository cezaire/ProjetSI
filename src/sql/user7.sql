-- phpMyAdmin SQL Dump
-- version 2.11.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 29, 2015 at 12:23 PM
-- Server version: 5.1.57
-- PHP Version: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `a4724695_projet`
--

-- --------------------------------------------------------

--
-- Table structure for table `article`
--

CREATE TABLE `article` (
  `idArticle` int(100) NOT NULL AUTO_INCREMENT,
  `titre` char(50) NOT NULL,
  `texte` varchar(500) NOT NULL,
  `image` char(50) NOT NULL,
  `idPersonne` char(100) NOT NULL,
  PRIMARY KEY (`idArticle`),
  KEY `idPersonne` (`idPersonne`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `article`
--

INSERT INTO `article` VALUES(1, 'Mouton', 'Je suis l''image d''un mouton', '../img/mouton.jpg', 'jeremy');
INSERT INTO `article` VALUES(4, 'Chat invisible', 'Un chat invisible', '', 'test');
INSERT INTO `article` VALUES(6, 'Chat', 'Le chat domestique (Felis silvestris catus) est un mammifère carnivore de la famille des félidés. Il est l’un des principaux animaux de compagnie et compte aujourd’hui une cinquantaine de races différentes reconnues par les instances de certification. Dans de nombreux pays, le chat entre dans le cadre de la législation sur les carnivores domestiques à l’instar du chien et du furet.', '../img/chat.png', 'test');
INSERT INTO `article` VALUES(7, 'Insecte', 'Un insecte', '../img/bete.jpg', 'test');
INSERT INTO `article` VALUES(9, 'test', 'test', '', 'zaire');

-- --------------------------------------------------------

--
-- Table structure for table `commentaire`
--

CREATE TABLE `commentaire` (
  `idCommentaire` int(100) NOT NULL AUTO_INCREMENT,
  `auteur` char(30) NOT NULL,
  `texte` varchar(500) NOT NULL,
  `idArticle` char(100) NOT NULL,
  PRIMARY KEY (`idCommentaire`),
  KEY `idArticle` (`idArticle`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=40 ;

--
-- Dumping data for table `commentaire`
--

INSERT INTO `commentaire` VALUES(2, 'jeremy', 'hello world !', '9');
INSERT INTO `commentaire` VALUES(3, 'jeremy', 'Voici un commentaire constructif', '9');
INSERT INTO `commentaire` VALUES(4, 'jeremy', 'C''est quoi ce blog de merde ?', '9');
INSERT INTO `commentaire` VALUES(5, 'jeremy', '4eme', '9');
INSERT INTO `commentaire` VALUES(34, 'jeremy', 'GROS COMMENTAIRE ! GROS COMMENTAIRE ! GROS COMMENTAIRE ! GROS COMMENTAIRE ! GROS COMMENTAIRE ! GROS COMMENTAIRE ! GROS COMMENTAIRE ! GROS COMMENTAIRE ! GROS COMMENTAIRE ! GROS COMMENTAIRE ! GROS COMMENTAIRE ! GROS COMMENTAIRE ! GROS COMMENTAIRE ! GROS COMMENTAIRE ! GROS COMMENTAIRE ! GROS COMMENTAIRE ! ', '9');
INSERT INTO `commentaire` VALUES(33, 'jeremy', 'Salut !', '9');
INSERT INTO `commentaire` VALUES(35, 'jeremy', '1', '9');
INSERT INTO `commentaire` VALUES(36, 'jeremy', '2', '9');
INSERT INTO `commentaire` VALUES(37, 'jeremy', '3', '9');
INSERT INTO `commentaire` VALUES(38, 'jeremy', 'Nous irons aux bois !', '9');
INSERT INTO `commentaire` VALUES(39, 'jeremy', 'Création de 2 pages de commentaires !', '9');

-- --------------------------------------------------------

--
-- Table structure for table `personne`
--

CREATE TABLE `personne` (
  `id` char(100) NOT NULL,
  `email` char(100) NOT NULL,
  `mdp` char(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `personne`
--

INSERT INTO `personne` VALUES('jeremy', 'jeremy@gmail.com', '123');
INSERT INTO `personne` VALUES('paul14', 'paul.14@gmail.com', '654543');
INSERT INTO `personne` VALUES('paul12', 'paul.12@gmail.com', '56455');
INSERT INTO `personne` VALUES('paul11', 'paul11@gmail.com', '56468435');
INSERT INTO `personne` VALUES('test', 'test', 'test');
INSERT INTO `personne` VALUES('zaire', 'zaire', 'zaire');
