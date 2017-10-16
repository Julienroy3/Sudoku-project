-- phpMyAdmin SQL Dump
-- version 4.7.2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le :  lun. 16 oct. 2017 à 17:07
-- Version du serveur :  5.6.35
-- Version de PHP :  7.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données :  `sudoku`
--

-- --------------------------------------------------------

--
-- Structure de la table `Concours`
--

CREATE TABLE `Concours` (
  `IdConcours` int(11) NOT NULL,
  `IdGrille` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `Participe`
--

CREATE TABLE `Participe` (
  `Temps` time DEFAULT NULL,
  `Classement` int(11) DEFAULT NULL,
  `IdUser` int(11) NOT NULL,
  `IdConcours` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `Performances`
--

CREATE TABLE `Performances` (
  `IdGrille` int(11) NOT NULL,
  `DateResolution` date DEFAULT NULL,
  `TempsResolu` int(11) DEFAULT NULL,
  `Niveau` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `Utilisateur`
--

CREATE TABLE `Utilisateur` (
  `IdUser` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` text NOT NULL,
  `email` varchar(25) NOT NULL,
  `icon` varchar(200) NOT NULL DEFAULT 'default.png',
  `date_sign` date NOT NULL,
  `admin` int(11) NOT NULL DEFAULT '0',
  `IdGrille` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `Utilisateur`
--

INSERT INTO `Utilisateur` (`IdUser`, `username`, `password`, `email`, `icon`, `date_sign`, `admin`, `IdGrille`) VALUES
(4, 'za', '959848ca10cc8a60da818ac11523dc63', 'myriszadip@gmail.com', 'default.png', '2017-10-16', 0, NULL),
(5, 'tif', '423c3fba9840072ab5db43ced5d96f83', 'tif@tif.fr', 'default.png', '2017-10-16', 0, NULL),
(6, 'sq', '4bc92a7aeb9478e6bf3f989025232b22', 'myriszadip@gmail.com', 'default.png', '2017-10-16', 0, NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `Concours`
--
ALTER TABLE `Concours`
  ADD PRIMARY KEY (`IdConcours`);

--
-- Index pour la table `Participe`
--
ALTER TABLE `Participe`
  ADD PRIMARY KEY (`IdUser`,`IdConcours`),
  ADD KEY `FK_Participe_IdConcours` (`IdConcours`);

--
-- Index pour la table `Performances`
--
ALTER TABLE `Performances`
  ADD PRIMARY KEY (`IdGrille`);

--
-- Index pour la table `Utilisateur`
--
ALTER TABLE `Utilisateur`
  ADD PRIMARY KEY (`IdUser`),
  ADD UNIQUE KEY `Username` (`username`),
  ADD KEY `FK_Utilisateur_IdGrille` (`IdGrille`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `Concours`
--
ALTER TABLE `Concours`
  MODIFY `IdConcours` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `Performances`
--
ALTER TABLE `Performances`
  MODIFY `IdGrille` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `Utilisateur`
--
ALTER TABLE `Utilisateur`
  MODIFY `IdUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `Participe`
--
ALTER TABLE `Participe`
  ADD CONSTRAINT `FK_Participe_IdConcours` FOREIGN KEY (`IdConcours`) REFERENCES `Concours` (`IdConcours`),
  ADD CONSTRAINT `FK_Participe_IdUser` FOREIGN KEY (`IdUser`) REFERENCES `Utilisateur` (`IdUser`);

--
-- Contraintes pour la table `Utilisateur`
--
ALTER TABLE `Utilisateur`
  ADD CONSTRAINT `FK_Utilisateur_IdGrille` FOREIGN KEY (`IdGrille`) REFERENCES `Performances` (`IdGrille`);
