-- phpMyAdmin SQL Dump
-- version 2.11.4
-- http://www.phpmyadmin.net
--
-- Serveur: localhost
-- Généré le : Mar 28 Avril 2015 à 08:29
-- Version du serveur: 5.1.57
-- Version de PHP: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Base de données: `a4724695_projet`
--

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

CREATE TABLE `article` (
  `idArticle` int(100) NOT NULL AUTO_INCREMENT,
  `titre` char(50) NOT NULL,
  `texte` char(100) NOT NULL,
  `image` char(50) NOT NULL,
  `idPersonne` char(100) NOT NULL,
  PRIMARY KEY (`idArticle`),
  KEY `idPersonne` (`idPersonne`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Contenu de la table `article`
--

INSERT INTO `article` VALUES(1, '', 'Je suis l''image d''un mouton', '../img/mouton.jpg', 'jeremy');
INSERT INTO `article` VALUES(4, 'chat', 'chat', '', 'test');
INSERT INTO `article` VALUES(6, 'chat le retour', 'chat', '../img/chat.png', 'test');
INSERT INTO `article` VALUES(7, 'bete le retour', 'bete', '../img/bete.jpg', 'test');

-- --------------------------------------------------------

--
-- Structure de la table `personne`
--

CREATE TABLE `personne` (
  `id` char(100) NOT NULL,
  `email` char(100) NOT NULL,
  `mdp` char(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `personne`
--

INSERT INTO `personne` VALUES('jeremy', 'jeremy@gmail.com', '123');
INSERT INTO `personne` VALUES('paul14', 'paul.14@gmail.com', '654543');
INSERT INTO `personne` VALUES('paul12', 'paul.12@gmail.com', '56455');
INSERT INTO `personne` VALUES('paul11', 'paul11@gmail.com', '56468435');
INSERT INTO `personne` VALUES('test', 'test', 'test');