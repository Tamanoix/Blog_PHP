-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : lun. 10 oct. 2022 à 10:25
-- Version du serveur : 5.7.33
-- Version de PHP : 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `bdd_blog`
--

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

CREATE TABLE `article` (
  `Id_Article` int(11) NOT NULL,
  `Titre` text NOT NULL,
  `Auteur` text NOT NULL,
  `Contenu_texte` text NOT NULL,
  `Contenu_image` text NOT NULL,
  `Date_creation` date NOT NULL,
  `Id_Categorie` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`Id_Article`, `Titre`, `Auteur`, `Contenu_texte`, `Contenu_image`, `Date_creation`, `Id_Categorie`) VALUES
(1, 'MIG-31 BM — Russie', 'Dimitriy Pichugin', 'Développé en Russie, le Mikoyan-Gourevitch MIG-31 est dérivé du fameux MIG-25. Il se distingue surtout par son radar pouvant détecter des cibles volantes et tirer à une altitude plus basse.', 'https://droitdunet.fr/wp-content/uploads/2016/06/mig31.jpg', '2021-09-22', 2),
(2, 'F-16 Fighting Falcon — États-Unis', 'Lukasz Golowanow', 'Signé par les États-Unis, le F-16 E/F Falcon date des années 1970. Il s’agit de l’avion de combat le plus utilisé dans le monde en 2013, avec 2 309 appareils actifs.', 'https://aerosoft-shop.com/shop-rd/bilder/screenshots/fsx/f16/f16-8.jpg', '2021-09-20', 3),
(4, 'Eurofighter Typhoon — Consortium européen', 'Markus Zinner', 'L’avion de combat Eurofighter Typhoon a été développé par le consortium Eurofighter GmbH qui regroupe le Royaume-Uni, l’Espagne, l’Italie et l’Allemagne. Il s’agit d’un avion multi-rôles et bi-réacteur, dont la première série a été sortie en 2004. A l’origine Dassault Aviation devait être de la partie au côté d’EADS, mais l’avionneur français a jugé le projet peu ambitieux pour se tourner vers sa propre solution. Aujourd’hui l’Eurofighter ressemble plus à un Rafale du pauvre. Multi-rôle mais pas omnirôle. L’EuroFighter reste malgré tout un excellent avion.', 'https://media.lesechos.com/api/v1/images/view/5c2621508fe56f78b35ce204/1280x720/021323572687-web.jpg', '2021-09-21', 3),
(5, 'F-22 Raptor — États-Unis', 'McDonnell Douglas', 'Fabriqué aux États-Unis à la fin des années 1980, le Lockheed Martin F-22 Raptor est l’avion de chasse le plus performant du monde. Il s’agit d’un avion de combat furtif avec des vitesses supersoniques et une superbe capacité de manœuvre. Alors pourquoi n’est-il pas premier ? Et bien c’est simple, un programme qui a largement dépassé ses coûts. Le F22 est un avion d’interception, bon pour le air/air ou alors le dog fight, mais le seul problème c’est qu’il n’existe quasiment plus de combat aérien de nos jours. Un bijou cher pour pas grand chose. De plus l’avion ne cesse de subir des problèmes techniques.', 'https://droitdunet.fr/wp-content/uploads/2016/06/f-22-raptor.jpg', '2021-09-22', 1),
(6, 'Rafale — France', 'Dylan Agbagni', 'Le Dassault Rafale a été développé par l’avionneur français Dassault Aviation pour remplacer les aéronefs des forces armées françaises vers le milieu des années 80. Le programme fait aussi un pied de nez au projet Eurofighter que Dassault jugea peu pertinent pour la défense française. Le Rafale est un avion omnirôle qui peut faire plusieurs missions air/air, air/sol sur un seul vol. Longtemps considéré comme trop cher et boudé des contrats d’armements, son efficacité sur le terrain à balayer le travail de sape des américains, qui ont pour objectif de faire disparaître l’avionneur Français, est redoutable.', 'https://images.dassault-aviation.com/f_auto,q_auto,g_center,dpr_auto/wp-auto-upload/1/files/2015/02/W1I0345-1.jpg', '2021-09-21', 2);

-- --------------------------------------------------------

--
-- Structure de la table `article_keywords`
--

CREATE TABLE `article_keywords` (
  `Id_Article_Keywords` int(11) NOT NULL,
  `Id_Article` int(11) NOT NULL,
  `Id_Keyword` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `article_keywords`
--

INSERT INTO `article_keywords` (`Id_Article_Keywords`, `Id_Article`, `Id_Keyword`) VALUES
(3, 6, 7),
(4, 6, 12),
(5, 6, 3),
(6, 6, 5);

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `Id_Categorie` int(11) NOT NULL,
  `Nom` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`Id_Categorie`, `Nom`) VALUES
(1, 'Furtif'),
(2, 'Intercepteur'),
(3, 'Attaque');

-- --------------------------------------------------------

--
-- Structure de la table `keywords`
--

CREATE TABLE `keywords` (
  `Id_Keyword` int(11) NOT NULL,
  `Nom` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `keywords`
--

INSERT INTO `keywords` (`Id_Keyword`, `Nom`) VALUES
(1, 'Avion'),
(2, 'Combat'),
(3, 'Furtif'),
(4, 'Attaque'),
(5, 'Intercepteur'),
(6, 'Bombardier'),
(7, 'Français'),
(8, 'USA'),
(9, 'Russie'),
(10, 'rôle'),
(11, 'Etats-Unis'),
(12, 'France'),
(13, 'Omnirôle'),
(14, 'Multirôle');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`Id_Article`),
  ADD KEY `Titre` (`Titre`(333)),
  ADD KEY `IndAuteur` (`Auteur`(333)),
  ADD KEY `Id_Categorie` (`Id_Categorie`);

--
-- Index pour la table `article_keywords`
--
ALTER TABLE `article_keywords`
  ADD PRIMARY KEY (`Id_Article_Keywords`),
  ADD KEY `keywords_article` (`Id_Keyword`),
  ADD KEY `article_keywords` (`Id_Article`);

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`Id_Categorie`),
  ADD KEY `Nom` (`Nom`(1024));

--
-- Index pour la table `keywords`
--
ALTER TABLE `keywords`
  ADD PRIMARY KEY (`Id_Keyword`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `article`
--
ALTER TABLE `article`
  MODIFY `Id_Article` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `article_keywords`
--
ALTER TABLE `article_keywords`
  MODIFY `Id_Article_Keywords` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `Id_Categorie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `keywords`
--
ALTER TABLE `keywords`
  MODIFY `Id_Keyword` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `article_categorie` FOREIGN KEY (`Id_Categorie`) REFERENCES `categorie` (`Id_Categorie`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Contraintes pour la table `article_keywords`
--
ALTER TABLE `article_keywords`
  ADD CONSTRAINT `article_keywords` FOREIGN KEY (`Id_Article`) REFERENCES `article` (`Id_Article`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `keywords_article` FOREIGN KEY (`Id_Keyword`) REFERENCES `keywords` (`Id_Keyword`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
