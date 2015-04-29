-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Mer 29 Avril 2015 à 00:12
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Contenu de la table `article`
--

INSERT INTO `article` (`idArticle`, `titre`, `texte`, `image`, `idPersonne`) VALUES
(1, 'Mouton', 'Je suis l''image d''un mouton', '../img/mouton.jpg', 'jeremy'),
(4, 'Chat invisible', 'Un chat invisible', '', 'test'),
(6, 'Chat', 'Le chat domestique (Felis silvestris catus) est un mammifère carnivore de la famille des félidés. Il est l’un des principaux animaux de compagnie et compte aujourd’hui une cinquantaine de races différentes reconnues par les instances de certification. Dans de nombreux pays, le chat entre dans le cadre de la législation sur les carnivores domestiques à l’instar du chien et du furet.', '../img/chat.png', 'test'),
(7, 'Insecte', 'Un insecte', '../img/bete.jpg', 'test'),
(9, 'test', 'test', '', 'zaire');

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

CREATE TABLE IF NOT EXISTS `commentaire` (
`idCommentaire` int(100) NOT NULL,
  `auteur` char(30) NOT NULL,
  `texte` varchar(500) NOT NULL,
  `idArticle` char(100) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

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
MODIFY `idArticle` int(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT pour la table `commentaire`
--
ALTER TABLE `commentaire`
MODIFY `idCommentaire` int(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
