-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Jeu 21 Mai 2015 à 23:23
-- Version du serveur :  5.6.20-log
-- Version de PHP :  5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `projetsi`
--

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

CREATE TABLE IF NOT EXISTS `article` (
`idArticle` int(100) NOT NULL,
  `titre` char(50) NOT NULL,
  `texte` varchar(500) NOT NULL,
  `image` char(50) NOT NULL,
  `idPersonne` char(100) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Contenu de la table `article`
--

INSERT INTO `article` (`idArticle`, `titre`, `texte`, `image`, `idPersonne`) VALUES
(1, 'Mouton', 'Je suis l''image d''un mouton', '../img/mouton.jpg', 'jeremy'),
(4, 'Chat invisible', 'Un chat invisible', '', 'test'),
(6, 'Chat', 'Le chat domestique (Felis silvestris catus) est un mammifère carnivore de la famille des félidés. Il est l’un des principaux animaux de compagnie et compte aujourd’hui une cinquantaine de races différentes reconnues par les instances de certification. Dans de nombreux pays, le chat entre dans le cadre de la législation sur les carnivores domestiques à l’instar du chien et du furet.', '../img/chat.png', 'test'),
(7, 'Insecte', 'Un insecte', '../img/bete.jpg', 'test'),
(9, 'test', 'test', '', 'zaire'),
(14, 'zaa', 'aa', '../img/gabay-3530-2.jpeg', 'zaire');

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

CREATE TABLE IF NOT EXISTS `commentaire` (
`idCommentaire` int(100) NOT NULL,
  `auteur` char(30) NOT NULL,
  `texte` varchar(500) NOT NULL,
  `valide` varchar(5) NOT NULL,
  `idArticle` char(100) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=49 ;

--
-- Contenu de la table `commentaire`
--

INSERT INTO `commentaire` (`idCommentaire`, `auteur`, `texte`, `valide`, `idArticle`) VALUES
(2, 'jeremy', 'hello world !', 'oui', '9'),
(3, 'jeremy', 'Voici un commentaire constructif', 'oui', '9'),
(4, 'jeremy', 'C''est quoi ce blog de merde ?', 'oui', '9'),
(34, 'jeremy', 'GROS COMMENTAIRE ! GROS COMMENTAIRE ! GROS COMMENTAIRE ! GROS COMMENTAIRE ! GROS COMMENTAIRE ! GROS COMMENTAIRE ! GROS COMMENTAIRE ! GROS COMMENTAIRE ! GROS COMMENTAIRE ! GROS COMMENTAIRE ! GROS COMMENTAIRE ! GROS COMMENTAIRE ! GROS COMMENTAIRE ! GROS COMMENTAIRE ! GROS COMMENTAIRE ! GROS COMMENTAIRE ! ', 'non', '9'),
(33, 'jeremy', 'Salut !', 'oui', '9'),
(35, 'jeremy', '1', 'non', '9'),
(36, 'jeremy', '2', 'non', '9'),
(45, 'ggg', 'bb', 'non', '9'),
(38, 'jeremy', 'Nous irons aux bois !', 'non', '9'),
(39, 'jeremy', 'Création de 2 pages de commentaires !', 'non', '9'),
(40, 'test', 'test', 'non', '9'),
(41, 'test', 'test', 'non', '9'),
(44, 'ddd', 'ddd', 'non', '9'),
(46, 'frof', 'kjfka', 'non', '9'),
(47, 'ee', 'eee', 'non', '9');

-- --------------------------------------------------------

--
-- Structure de la table `personne`
--

CREATE TABLE IF NOT EXISTS `personne` (
  `id` char(100) NOT NULL,
  `email` char(100) NOT NULL,
  `mdp` char(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `personne`
--

INSERT INTO `personne` (`id`, `email`, `mdp`) VALUES
('jeremy', 'jeremy@gmail.com', '123'),
('paul14', 'paul.14@gmail.com', '654543'),
('paul12', 'paul.12@gmail.com', '56455'),
('paul11', 'paul11@gmail.com', '56468435'),
('test', 'test', 'test'),
('zaire', 'zaire', 'zaire');

-- --------------------------------------------------------

--
-- Structure de la table `personne_connecte`
--

CREATE TABLE IF NOT EXISTS `personne_connecte` (
  `ip` varchar(255) COLLATE latin1_german2_ci NOT NULL,
  `timestamp` varchar(255) COLLATE latin1_german2_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_german2_ci;

--
-- Contenu de la table `personne_connecte`
--

INSERT INTO `personne_connecte` (`ip`, `timestamp`) VALUES
('127.0.0.1', '1432242365');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `article`
--
ALTER TABLE `article`
 ADD PRIMARY KEY (`idArticle`), ADD KEY `idPersonne` (`idPersonne`);

--
-- Index pour la table `commentaire`
--
ALTER TABLE `commentaire`
 ADD PRIMARY KEY (`idCommentaire`), ADD KEY `idArticle` (`idArticle`);

--
-- Index pour la table `personne`
--
ALTER TABLE `personne`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `article`
--
ALTER TABLE `article`
MODIFY `idArticle` int(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT pour la table `commentaire`
--
ALTER TABLE `commentaire`
MODIFY `idCommentaire` int(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=49;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
