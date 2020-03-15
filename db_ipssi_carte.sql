-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : Dim 15 mars 2020 à 23:49
-- Version du serveur :  10.4.11-MariaDB
-- Version de PHP : 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `db_ipssi_carte`
--

-- --------------------------------------------------------

--
-- Structure de la table `carte`
--

CREATE TABLE `carte` (
  `id` int(11) NOT NULL,
  `createur_id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `faction_id` int(11) NOT NULL,
  `titre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pv` int(11) DEFAULT NULL,
  `armure` int(11) DEFAULT NULL,
  `attaque` int(11) DEFAULT NULL,
  `cout` int(11) NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `carte`
--

INSERT INTO `carte` (`id`, `createur_id`, `type_id`, `faction_id`, `titre`, `description`, `pv`, `armure`, `attaque`, `cout`, `image`) VALUES
(5, 6, 1, 4, 'La faille', 'Une faille dans le mur et dans l\'espace temps', 6, 6, 6, 6, 'carte_2020-03-06-16-03-05.jpeg'),
(6, 6, 2, 2, 'le docteur', 'le docteur', 12, 0, 1, 7, 'carte_2020-03-06-16-24-35.jpeg'),
(9, 7, 1, 2, 'ui', 'ui', 1, 1, 1, 1, 'carte_2020-03-15-23-37-56.jpeg');

-- --------------------------------------------------------

--
-- Structure de la table `deck`
--

CREATE TABLE `deck` (
  `id` int(11) NOT NULL,
  `createur_id` int(11) NOT NULL,
  `titre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `deck`
--

INSERT INTO `deck` (`id`, `createur_id`, `titre`) VALUES
(1, 6, 'deck de test'),
(4, 5, 'deck de quelqu\'un d\'autre'),
(5, 6, 'Mon deck');

-- --------------------------------------------------------

--
-- Structure de la table `deck_carte`
--

CREATE TABLE `deck_carte` (
  `id` int(11) NOT NULL,
  `deck_id` int(11) NOT NULL,
  `carte_id` int(11) NOT NULL,
  `nombre` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `deck_carte`
--

INSERT INTO `deck_carte` (`id`, `deck_id`, `carte_id`, `nombre`) VALUES
(1, 5, 5, 0),
(2, 5, 6, 1);

-- --------------------------------------------------------

--
-- Structure de la table `faction`
--

CREATE TABLE `faction` (
  `id` int(11) NOT NULL,
  `titre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `faction`
--

INSERT INTO `faction` (`id`, `titre`, `description`) VALUES
(2, 'Humain', 'Ce sont des humains oui'),
(3, 'Monstres', 'Ce sont des monstres, plus puissant mais moins intelligent'),
(4, 'Créatures magiques', 'Ceux qui font partie de cette faction ont moins d\'attaque mais plus de magie');

-- --------------------------------------------------------

--
-- Structure de la table `migration_versions`
--

CREATE TABLE `migration_versions` (
  `version` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `executed_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migration_versions`
--

INSERT INTO `migration_versions` (`version`, `executed_at`) VALUES
('20200305111536', '2020-03-05 11:17:08'),
('20200305143135', '2020-03-05 14:32:12'),
('20200306083922', '2020-03-06 08:39:30'),
('20200306135958', '2020-03-06 14:00:13');

-- --------------------------------------------------------

--
-- Structure de la table `type`
--

CREATE TABLE `type` (
  `id` int(11) NOT NULL,
  `titre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `type`
--

INSERT INTO `type` (`id`, `titre`, `description`) VALUES
(1, 'Cartes Magique', 'Ces cartes n\'ont pas de points de vie ni d\'attaque, elles ont un effets qui s\'active lorsqu\'elle sont joué.'),
(2, 'Cartes Combat', 'Ces cartes sont des cartes de combattants, elles ont des points de vie et des points d\'attaques.'),
(3, 'poiuygf', 'mlkjhgf');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id` int(11) NOT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:json)',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pseudo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `email`, `roles`, `password`, `pseudo`) VALUES
(4, 'dfgh@uyf', '[\"ROLE_USER\"]', '$argon2id$v=19$m=65536,t=4,p=1$ZWtQL2dUWkNGWUZBSE16Sw$Pxdc4otTRbTKHUWodtkePRyHKO5lQeDOpVRmEziJLxo', 'sdgj'),
(5, 'dfgh@uyfk', '[\"ROLE_USER\"]', '$argon2id$v=19$m=65536,t=4,p=1$N1BSaTlYajJ5OGEuRkg5UQ$QeXGRON9dVJik3SoID8vl6dBKoymY14ukUjts2kP+gs', 'sdgj'),
(6, 'a@a', '[\"ROLE_USER\"]', '$argon2id$v=19$m=65536,t=4,p=1$dXc0cXNZM1BabHBreXZCYg$ST5mVwdLiO77gsv9UvCZBN8n4tgH3Sew9z1u/xYVvjo', 'a'),
(7, 'ui@ui', '[\"ROLE_USER\"]', '$argon2id$v=19$m=65536,t=4,p=1$cVBXdzN5WlRFUG9RcWpWMQ$/iNX+mgNxWp4yz124SAPQXXiPPBrkuWfg5OZpf1z/9Q', 'ui');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `carte`
--
ALTER TABLE `carte`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_BAD4FFFD73A201E5` (`createur_id`),
  ADD KEY `IDX_BAD4FFFDC54C8C93` (`type_id`),
  ADD KEY `IDX_BAD4FFFD4448F8DA` (`faction_id`);

--
-- Index pour la table `deck`
--
ALTER TABLE `deck`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_4FAC363773A201E5` (`createur_id`);

--
-- Index pour la table `deck_carte`
--
ALTER TABLE `deck_carte`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_7B890512111948DC` (`deck_id`),
  ADD KEY `IDX_7B890512C9C7CEB6` (`carte_id`);

--
-- Index pour la table `faction`
--
ALTER TABLE `faction`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `migration_versions`
--
ALTER TABLE `migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_1D1C63B3E7927C74` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `carte`
--
ALTER TABLE `carte`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `deck`
--
ALTER TABLE `deck`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `deck_carte`
--
ALTER TABLE `deck_carte`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `faction`
--
ALTER TABLE `faction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `type`
--
ALTER TABLE `type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `carte`
--
ALTER TABLE `carte`
  ADD CONSTRAINT `FK_BAD4FFFD4448F8DA` FOREIGN KEY (`faction_id`) REFERENCES `faction` (`id`),
  ADD CONSTRAINT `FK_BAD4FFFD73A201E5` FOREIGN KEY (`createur_id`) REFERENCES `utilisateur` (`id`),
  ADD CONSTRAINT `FK_BAD4FFFDC54C8C93` FOREIGN KEY (`type_id`) REFERENCES `type` (`id`);

--
-- Contraintes pour la table `deck`
--
ALTER TABLE `deck`
  ADD CONSTRAINT `FK_4FAC363773A201E5` FOREIGN KEY (`createur_id`) REFERENCES `utilisateur` (`id`);

--
-- Contraintes pour la table `deck_carte`
--
ALTER TABLE `deck_carte`
  ADD CONSTRAINT `FK_7B890512111948DC` FOREIGN KEY (`deck_id`) REFERENCES `deck` (`id`),
  ADD CONSTRAINT `FK_7B890512C9C7CEB6` FOREIGN KEY (`carte_id`) REFERENCES `carte` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
