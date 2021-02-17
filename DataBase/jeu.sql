-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 17 fév. 2021 à 14:47
-- Version du serveur :  5.7.31
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `jeu`
--

-- --------------------------------------------------------

--
-- Structure de la table `matches`
--

DROP TABLE IF EXISTS `matches`;
CREATE TABLE IF NOT EXISTS `matches` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user1_name` text NOT NULL,
  `user1_B2` int(11) NOT NULL,
  `user1_B3` int(11) NOT NULL,
  `user1_B4` int(11) NOT NULL,
  `user1_B5` int(11) NOT NULL,
  `user1_LastShut` int(11) DEFAULT NULL,
  `user1_score` int(11) NOT NULL,
  `user2_name` text NOT NULL,
  `user2_B2` int(11) DEFAULT NULL,
  `user2_B3` int(11) DEFAULT NULL,
  `user2_B4` int(11) DEFAULT NULL,
  `user2_B5` int(11) DEFAULT NULL,
  `user2_LastShut` int(11) DEFAULT NULL,
  `user2_score` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `matches`
--

INSERT INTO `matches` (`id`, `user1_name`, `user1_B2`, `user1_B3`, `user1_B4`, `user1_B5`, `user1_LastShut`, `user1_score`, `user2_name`, `user2_B2`, `user2_B3`, `user2_B4`, `user2_B5`, `user2_LastShut`, `user2_score`) VALUES
(29, 'Joueur1', 18, 0, 36, 57, NULL, 0, 'Joueur2', 1, 11, 35, 57, NULL, 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
