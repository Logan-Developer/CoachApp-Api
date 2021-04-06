-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : sam. 03 avr. 2021 à 08:49
-- Version du serveur :  10.4.14-MariaDB
-- Version de PHP : 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `muscu`
--

-- --------------------------------------------------------

--
-- Structure de la table `activitesequencetheorique`
--

CREATE TABLE `activitesequencetheorique` (
                                             `id` int(11) NOT NULL,
                                             `idsequencetheorique_id` int(11) NOT NULL,
                                             `idatelier_id` int(11) NOT NULL,
                                             `perfObjectif` double NOT NULL,
                                             `ordre` int(11) NOT NULL,
                                             `intensiteObjectif` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `activitesequencetheorique`
--

INSERT INTO `activitesequencetheorique` (`id`, `idsequencetheorique_id`, `idatelier_id`, `perfObjectif`, `ordre`, `intensiteObjectif`) VALUES
(55, 2, 1, 6, 0, 600),
(56, 2, 5, 60, 1, 0),
(57, 2, 1, 7, 2, 600),
(58, 2, 5, 60, 3, 0),
(59, 2, 1, 8, 4, 600),
(60, 2, 5, 60, 5, 0),
(63, 2, 1, 6, 6, 600),
(64, 2, 6, 1000, 7, 0),
(65, 3, 1, 10, 0, 1200),
(66, 3, 6, 500, 1, 0),
(67, 3, 1, 10, 2, 1200),
(68, 3, 6, 500, 3, 0),
(69, 3, 3, 15, 4, 1200),
(70, 4, 2, 50, 0, 50),
(71, 4, 4, 50, 1, 100),
(72, 4, 3, 25, 2, 60),
(73, 4, 6, 250, 3, 0),
(74, 4, 3, 25, 4, 60),
(75, 4, 4, 50, 5, 100),
(76, 4, 2, 50, 6, 50);

-- --------------------------------------------------------

--
-- Structure de la table `atelier`
--

CREATE TABLE `atelier` (
                           `id` int(11) NOT NULL,
                           `titre` text NOT NULL,
                           `image` text NOT NULL,
                           `uniteDePerformance` text NOT NULL,
                           `uniteDIntensite` text NOT NULL,
                           `description` text NOT NULL,
                           `resume` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `atelier`
--

INSERT INTO `atelier` (`id`, `titre`, `image`, `uniteDePerformance`, `uniteDIntensite`, `description`, `resume`) VALUES
(1, 'Tapis de course', 'Tapis-de-course-606254941ec6b.png', 'Km/H', 's', 'Le tapis de cours permet de travailler votre endurance fondamentale', 'Le tapis de course vous permet de courir en salle par tous les temps !'),
(2, 'Soulevé de poids', 'Poids-6062558ea6fbd.png', 'Kg (Poids)', 'répétition', 'Pour avoir des gros muscles, pas besoin de ramer !', 'Le soulevé de poids permet de faire travailler tout le haut du torse mais également les jambes'),
(3, 'Vélo', 'Velo-6062557bf1ee6.png', 'Km/h (vitesse)', 's (durée)', 'Le vélo de salle', 'Permet de faire du vélo en salle par tous les temps'),
(4, 'Fit ball', 'Fitball-6062555d6a8d8.png', 'Kg (Poids)', 'Répétition', 'Une boulle de fitness à manipuler lors d\'exercices au sol', 'La fit ball permet de travailler de manière équilibrée tous les muscles'),
(5, 'Pause', 'pause-606255f71cf4e.png', 's (durée)', 'Néant !', 'Faire une pause', 'La pause s\'impose !'),
(6, 'Boire', 'hidratation-60625648c1b3a.png', 'ml (volume d\'eau)', 'néant', 'Boire de l\'eau', 'L\'eau permet à l\'organisme de se regénérer.');

-- --------------------------------------------------------

--
-- Structure de la table `boisson`
--

CREATE TABLE `boisson` (
                           `id` int(11) NOT NULL,
                           `titre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                           `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                           `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `boisson`
--

INSERT INTO `boisson` (`id`, `titre`, `description`, `image`) VALUES
(2, 'Power 2000', 'Pour plus d\'énergie', 'BoissonEnergie-60679b95cd0ca.png'),
(3, 'Hydra 400', 'Pour s\'hydrater et récupérer plus vite', 'BopissonHydra-60679bd948fcb.png');

-- --------------------------------------------------------

--
-- Structure de la table `categoriesequence`
--

CREATE TABLE `categoriesequence` (
                                     `id` int(11) NOT NULL,
                                     `titre` text COLLATE utf8mb4_unicode_ci NOT NULL,
                                     `image` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `categoriesequence`
--

INSERT INTO `categoriesequence` (`id`, `titre`, `image`) VALUES
(9, 'Cardio', 'cardio-60625403f06b1.png'),
(10, 'Fitness', 'Box-606254367709e.png');

-- --------------------------------------------------------

--
-- Structure de la table `commentaire_atelier`
--

CREATE TABLE `commentaire_atelier` (
                                       `id` int(11) NOT NULL,
                                       `proprietaire_id` int(11) DEFAULT NULL,
                                       `titre` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
                                       `message` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
                                       `date` datetime NOT NULL,
                                       `atelier_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `commentaire_atelier`
--

INSERT INTO `commentaire_atelier` (`id`, `proprietaire_id`, `titre`, `message`, `date`, `atelier_id`) VALUES
(1, 2, 'azef', 'zef', '2021-03-22 22:23:59', 2),
(2, 2, 'azef', 'zef', '2021-03-22 22:25:17', 2),
(3, 2, 'azef', 'zef', '2021-03-22 22:25:43', 2),
(4, 2, 'azef', 'zef', '2021-03-22 22:26:23', 2),
(5, 2, 'azef', 'zef', '2021-03-22 22:27:43', 2),
(14, NULL, 'test', 'test', '2021-03-26 17:43:38', 2),
(15, NULL, 'test2', 'test2', '2021-03-26 17:46:36', 2),
(16, NULL, 'test3', 'test3', '2021-03-26 17:46:50', 2),
(17, NULL, 'test5', 'test5', '2021-03-26 17:57:31', 2),
(18, NULL, 'test', 'test', '2021-03-26 19:30:03', 2),
(19, 4, 'see', 'see', '2021-03-26 19:31:46', 2),
(20, 4, 'see', 'see', '2021-03-26 19:33:20', 2),
(21, 4, 'see', 'see', '2021-03-26 19:36:13', 2),
(22, 4, 'see', 'see', '2021-03-26 19:58:04', 2),
(23, 4, 'egerg', 'erge', '2021-03-26 19:58:27', 2),
(24, 4, 'egerg', 'erge', '2021-03-26 19:59:16', 2),
(25, 4, 'egerg', 'erge', '2021-03-26 19:59:19', 2),
(26, 4, 'azretart', 'aertaert', '2021-03-26 20:00:34', 2),
(27, 4, 'azretart', 'aertaert', '2021-03-26 20:03:07', 2),
(28, 4, 'etg', 'aerg', '2021-03-26 20:03:13', 2),
(30, 5, '4', '4', '2021-03-27 00:25:43', 2),
(40, NULL, 'aergaerg', 'raegaergaergaetg', '2021-03-27 16:01:24', 2),
(41, NULL, 'gaergaer', 'gaergaerg', '2021-03-27 16:03:31', 2),
(46, 3, 'test', 'testet\ntaetaert\n\naert', '2021-03-28 14:46:47', 1);

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
                                               `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
                                               `executed_at` datetime DEFAULT NULL,
                                               `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20210216195435', '2021-02-16 20:58:22', 287),
('DoctrineMigrations\\Version20210302193226', '2021-03-02 20:32:35', 334),
('DoctrineMigrations\\Version20210319210947', '2021-03-19 22:09:54', 51),
('DoctrineMigrations\\Version20210322190654', '2021-03-22 20:07:36', 328),
('DoctrineMigrations\\Version20210322195327', '2021-03-22 20:53:35', 896),
('DoctrineMigrations\\Version20210328125541', '2021-03-28 14:55:59', 463);

-- --------------------------------------------------------

--
-- Structure de la table `refresh_tokens`
--

CREATE TABLE `refresh_tokens` (
                                  `id` int(11) NOT NULL,
                                  `refresh_token` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
                                  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                                  `valid` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `refresh_tokens`
--

INSERT INTO `refresh_tokens` (`id`, `refresh_token`, `username`, `valid`) VALUES
(1, '5369e359ce6b7a852020a8826d1bdb10d9bcdaecc9b818739e60abdf09c4efb838000d26c1706047a7b4b2b8ebb36227d5291b82f1a2c2055621d30166184df9', 'jbaubry5', '2021-03-29 20:15:03'),
(2, '4433c5915aecbc0bcfead0866abb55efd2d91b43c9939381f3620ffef8884189da1fa5f56657e6e3d6d6db64bbdc652ea906d3ca6ab56ee05f1d8ff79b6f92f0', 'jbaubry', '2021-03-29 20:20:04'),
(3, 'c98d5a92709aa44a4c6c9b46e3c8e82929fd4c6f85f637d92d7bcb548db99ecf8e77df35645916859653194532db69e1d22c737db3cc5ea6db9e01531976ee04', 'jbaubry2', '2021-03-29 20:25:28'),
(4, '745a0b68f17c5a1b9f5d7a296961dccd111b2e6a237d6401dd9785f2985d6e663da8961f9a243278baafd159f5e9af0ae80064357a61b0c079864a4b20c00209', 'jbaubry2', '2021-03-29 20:25:44'),
(5, 'd58cd32236758efcd8129986299f3e9bad34a67f53ff4a491080ff9e28bb214b81cf83acb66bf80ff82e8471d82878e9caff6f0dc054cf17756369505bb559c3', 'jbaubry5', '2021-03-29 22:00:32'),
(6, '81c368bf0af029153125c56e2c9539898cba417a057a13bb8b516285a8ac458ab686447780415e381850ee6218bf100c33e2442526feec8b20dcceccdabfd131', 'jbaubry5', '2021-03-29 22:00:43'),
(7, '40f86ee2562ccbcc02db1210bcccc2ae323f105e461b8f6e9f51f8ce27367f190c3f9525769e2c50c1fe0808538cc46c6dae663fcdcdc010b52b46ffa417436c', 'jbaubry', '2021-03-29 22:06:37'),
(8, '81f5723462e705f883813d68efe61a9112eb26923b2f1e2bfbc235e4511739571f9c63ee50070c295969eab15e81f9fc6b3e493c26987be759170b82d18c6040', 'jbaubry', '2021-03-29 22:07:38'),
(9, '94cae16f1dae922af705f449653e57df9e4f04ca8e6e44c9d432120d1aa28e29f63369c9cc2e1b8434e2efccf0711e626c3ff747bf4956a31c0e6f43d3f31702', 'jbaubry', '2021-03-29 22:08:13'),
(10, '9e6b24a0cd0a24684ae74118c561c239336a8e761c51769a8c2cddbb43f0d699ab346e946b90a4ab44771f3815ee376866c7c1231f0317da734d8ecb0bba6231', 'jbaubry', '2021-03-29 22:17:23'),
(11, '1cd8197bd62410eb8a6c9eb0c143821de339d2ee60f8898d578859f4ea0efdddec02dcb7e4db5ab883b2dad14d1f806014eeec9fd22554d396f737abea1c6fb7', 'jbaubry', '2021-03-29 23:47:57'),
(12, '6fce8705229b9903565b321d5d3a1d31ab57263eda2d9e8b4944bb464064d8ec3474d42efff4d8aa9958b65dd029a23548f9ff406a6b81ee01da81da730d69f3', 'jbaubry', '2021-03-29 23:54:42'),
(13, '15edb626bf7bc3d19a14280789e3a9093220d5a902afa07a10509a3cd53bdccfab9b9bafcfcf2e28a9cee2677716f613230de3037c2ef22be9edca68405b6639', 'jbaubry', '2021-03-30 00:50:30'),
(14, 'f6681a1cd328184dc53056e6b9ac4ca46efa8b2fb9361a991115587292ab46af5bb4f53ccc92ee12e0dc6f3811ded2233e4fcc4a1f0555e5cd81f1666f33016f', 'jbaubry', '2021-03-30 00:51:29');

-- --------------------------------------------------------

--
-- Structure de la table `sequencetheorique`
--

CREATE TABLE `sequencetheorique` (
                                     `id` int(11) NOT NULL,
                                     `idcategoriesequence_id` int(11) NOT NULL,
                                     `titre` text COLLATE utf8mb4_unicode_ci NOT NULL,
                                     `niveau` int(11) NOT NULL,
                                     `proprietaire_id` int(11) DEFAULT NULL,
                                     `partage` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `sequencetheorique`
--

INSERT INTO `sequencetheorique` (`id`, `idcategoriesequence_id`, `titre`, `niveau`, `proprietaire_id`, `partage`) VALUES
(2, 9, 'Course à pied', 1, NULL, NULL),
(3, 9, 'Course à pied et vélo', 2, NULL, NULL),
(4, 10, 'Musculation', 3, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
                               `id` int(11) NOT NULL,
                               `login` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                               `nom_utilisateur` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                               `prenom_utilisateur` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                               `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                               `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                               `roles` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:json)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `login`, `nom_utilisateur`, `prenom_utilisateur`, `email`, `password`, `roles`) VALUES
(1, 'aergaerg', 'aergaerg', 'aergaerg', 'aregaer@erg.aerg', '$argon2id$v=19$m=65536,t=4,p=1$WGN4eGJ2UmUzbXh4OGQxVQ$5MSPZJT0yccbiF4GsdRA7IP4CPZBGD+GYUGvxU/lKQk', '[\"ROLE_USER\"]'),
(2, 'jbaubry2', 'Aubry', 'Jean-Baptiste', 'jbaubry25@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$M29mdnI3Yllndy9SUnJtUA$z/NNWjaaZP1JU6ll0aRKbJe3r4ISUdNFJO35SF5rqGs', '[\"ROLE_USER\"]'),
(3, 'jbaubry', 'Aubry', 'Jean-Baptiste', 'jbaubry26@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$M29mdnI3Yllndy9SUnJtUA$z/NNWjaaZP1JU6ll0aRKbJe3r4ISUdNFJO35SF5rqGs', '[\"ROLE_USER\"]'),
(4, 'jbaubry3', 'Aubry', 'Jean-Baptiste', 'jbaubry27@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$M29mdnI3Yllndy9SUnJtUA$z/NNWjaaZP1JU6ll0aRKbJe3r4ISUdNFJO35SF5rqGs', '[\"ROLE_USER\"]'),
(5, 'jbaubry4', 'jbaubry4', 'Jean-Baptiste', 'jbaubry254@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$M29mdnI3Yllndy9SUnJtUA$z/NNWjaaZP1JU6ll0aRKbJe3r4ISUdNFJO35SF5rqGs', '[\"ROLE_USER\"]'),
(6, 'jbaubry5', 'jbaubry5', 'Jean-Baptiste', 'jbaubry255@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$M29mdnI3Yllndy9SUnJtUA$z/NNWjaaZP1JU6ll0aRKbJe3r4ISUdNFJO35SF5rqGs', '[\"ROLE_USER\"]'),
(7, 'jbaubry256', 'jbaubry2', 'Jean-Baptiste', 'jbaubry256@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$M29mdnI3Yllndy9SUnJtUA$z/NNWjaaZP1JU6ll0aRKbJe3r4ISUdNFJO35SF5rqGs', '[\"ROLE_USER\"]');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `activitesequencetheorique`
--
ALTER TABLE `activitesequencetheorique`
    ADD PRIMARY KEY (`id`),
    ADD KEY `IDX_4EDF561A549B9888` (`idsequencetheorique_id`),
    ADD KEY `IDX_4EDF561A4F4BD20F` (`idatelier_id`);

--
-- Index pour la table `atelier`
--
ALTER TABLE `atelier`
    ADD PRIMARY KEY (`id`);

--
-- Index pour la table `boisson`
--
ALTER TABLE `boisson`
    ADD PRIMARY KEY (`id`);

--
-- Index pour la table `categoriesequence`
--
ALTER TABLE `categoriesequence`
    ADD PRIMARY KEY (`id`);

--
-- Index pour la table `commentaire_atelier`
--
ALTER TABLE `commentaire_atelier`
    ADD PRIMARY KEY (`id`),
    ADD KEY `IDX_92738A7076C50E4A` (`proprietaire_id`),
    ADD KEY `IDX_92738A7082E2CF35` (`atelier_id`);

--
-- Index pour la table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
    ADD PRIMARY KEY (`version`);

--
-- Index pour la table `refresh_tokens`
--
ALTER TABLE `refresh_tokens`
    ADD PRIMARY KEY (`id`),
    ADD UNIQUE KEY `UNIQ_9BACE7E1C74F2195` (`refresh_token`);

--
-- Index pour la table `sequencetheorique`
--
ALTER TABLE `sequencetheorique`
    ADD PRIMARY KEY (`id`),
    ADD KEY `IDX_3107E7DE5FEF9641` (`idcategoriesequence_id`),
    ADD KEY `IDX_3107E7DE76C50E4A` (`proprietaire_id`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
    ADD PRIMARY KEY (`id`),
    ADD UNIQUE KEY `UNIQ_9B80EC64AA08CB10` (`login`),
    ADD UNIQUE KEY `UNIQ_9B80EC64E7927C74` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `activitesequencetheorique`
--
ALTER TABLE `activitesequencetheorique`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT pour la table `atelier`
--
ALTER TABLE `atelier`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `boisson`
--
ALTER TABLE `boisson`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `categoriesequence`
--
ALTER TABLE `categoriesequence`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `commentaire_atelier`
--
ALTER TABLE `commentaire_atelier`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT pour la table `refresh_tokens`
--
ALTER TABLE `refresh_tokens`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `sequencetheorique`
--
ALTER TABLE `sequencetheorique`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `activitesequencetheorique`
--
ALTER TABLE `activitesequencetheorique`
    ADD CONSTRAINT `FK_4EDF561A4F4BD20F` FOREIGN KEY (`idatelier_id`) REFERENCES `atelier` (`id`),
    ADD CONSTRAINT `FK_4EDF561A549B9888` FOREIGN KEY (`idsequencetheorique_id`) REFERENCES `sequencetheorique` (`id`);

--
-- Contraintes pour la table `commentaire_atelier`
--
ALTER TABLE `commentaire_atelier`
    ADD CONSTRAINT `FK_92738A7076C50E4A` FOREIGN KEY (`proprietaire_id`) REFERENCES `utilisateur` (`id`),
    ADD CONSTRAINT `FK_92738A7082E2CF35` FOREIGN KEY (`atelier_id`) REFERENCES `atelier` (`id`);

--
-- Contraintes pour la table `sequencetheorique`
--
ALTER TABLE `sequencetheorique`
    ADD CONSTRAINT `FK_3107E7DE5FEF9641` FOREIGN KEY (`idcategoriesequence_id`) REFERENCES `categoriesequence` (`id`),
    ADD CONSTRAINT `FK_3107E7DE76C50E4A` FOREIGN KEY (`proprietaire_id`) REFERENCES `utilisateur` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;