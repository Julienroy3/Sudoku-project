-- phpMyAdmin SQL Dump
-- version 4.7.2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le :  mar. 17 oct. 2017 à 11:47
-- Version du serveur :  5.6.35
-- Version de PHP :  7.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données :  `sudoku`
--
CREATE DATABASE IF NOT EXISTS sudoku;
USE sudoku;
-- --------------------------------------------------------

--
-- Structure de la table `Concours`
--

CREATE TABLE `Concours` (
  `IdConcours` int(11) NOT NULL,
  `GrilleConcours` varchar(200) DEFAULT NULL,
  `DateConcours` date DEFAULT NULL,
  `HeureDebut` time DEFAULT NULL,
  `HeureFin` time DEFAULT NULL,
  `GrilleSolution` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `Participe`
--

CREATE TABLE `Participe` (
  `Temps` time NOT NULL,
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
  `DateResolu` date NOT NULL,
  `TempsResolu` varchar(15) NOT NULL,
  `Niveau` varchar(25) NOT NULL,
  `IdUser` int(11) DEFAULT NULL
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
  `icon` varchar(200) NOT NULL,
  `date_sign` date NOT NULL,
  `admin` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  ADD PRIMARY KEY (`IdGrille`),
  ADD KEY `FK_Performances_IdUser` (`IdUser`);

--
-- Index pour la table `Utilisateur`
--
ALTER TABLE `Utilisateur`
  ADD PRIMARY KEY (`IdUser`),
  ADD UNIQUE KEY `username` (`username`);

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
  MODIFY `IdUser` int(11) NOT NULL AUTO_INCREMENT;
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
-- Contraintes pour la table `Performances`
--
ALTER TABLE `Performances`
  ADD CONSTRAINT `FK_Performances_IdUser` FOREIGN KEY (`IdUser`) REFERENCES `Utilisateur` (`IdUser`);
