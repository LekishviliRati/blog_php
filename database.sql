-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le :  jeu. 27 déc. 2018 à 20:43
-- Version du serveur :  5.6.38
-- Version de PHP :  7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données :  `blogphp`
--

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

CREATE TABLE `comment` (
                         `id` int(11) NOT NULL,
                         `author` varchar(15) NOT NULL,
                         `post_id` int(11) NOT NULL,
                         `content` longtext NOT NULL,
                         `creation_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `comment`
--

INSERT INTO `comment` (`id`, `author`, `post_id`, `content`, `creation_date`) VALUES
(3, 'Jean', 1, 'Article intéressant\r\n\r\n', '2018-12-05 04:16:15'),
(4, 'rati ', 2, 'Je ne suis pas d\'accord', '0000-00-00 00:00:00'),
(5, 'Benoit', 1, 'Très bon article', '0000-00-00 00:00:00'),
(6, 'JL', 2, 'J\'ai bien aimé cet article ....', '0000-00-00 00:00:00'),
(7, 'JM', 0, 'C\'est pas mal', '0000-00-00 00:00:00'),
(8, 'Hugues', 0, 'J\'aime pas l\'artcile', '0000-00-00 00:00:00'),
(9, 'mich ', 0, '10/10', '0000-00-00 00:00:00'),
(10, 'rati ', 2, 'Bonjour', '0000-00-00 00:00:00'),
(11, 'Rati', 1, 'Bonjour Bonjour', '0000-00-00 00:00:00'),
(12, 'Jack', 2, 'Hello', '0000-00-00 00:00:00'),
(13, 'rati ', 2, 'Bonjour Bonjour Bonjour', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `post`
--

CREATE TABLE `post` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `standfirst` text NOT NULL,
  `creation_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `post`
--

INSERT INTO `post` (`id`, `title`, `content`, `standfirst`, `creation_date`) VALUES
(1, 'Post 1', 'content : bla bla bla ', 'stanfirst = chapô ', '2018-11-08 23:02:39'),
(2, 'post 2 ', 'content = bla bla ', 'standfirst = chapô', '2018-11-08 23:03:37');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `first_name` text NOT NULL,
  `name` text NOT NULL,
  `pseudonym` varchar(15) NOT NULL,
  `e-mail` varchar(200) NOT NULL,
  `password` varchar(30) NOT NULL,
  `phone_number` int(15) NOT NULL,
  `postal_adress` text NOT NULL,
  `zip_code` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
