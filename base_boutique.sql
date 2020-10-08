-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  Dim 09 fév. 2020 à 22:16
-- Version du serveur :  5.7.26
-- Version de PHP :  7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `base_boutique`
--

-- --------------------------------------------------------

--
-- Structure de la table `carts`
--

DROP TABLE IF EXISTS `carts`;
CREATE TABLE IF NOT EXISTS `carts` (
  `id_cart` int(11) NOT NULL AUTO_INCREMENT,
  `id_product` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_payment` int(11) DEFAULT '0',
  `price` float NOT NULL,
  `quantity_cart` int(11) NOT NULL,
  `validation` int(11) NOT NULL DEFAULT '0',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `date_cart` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_cart`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `carts`
--

INSERT INTO `carts` (`id_cart`, `id_product`, `id_user`, `id_payment`, `price`, `quantity_cart`, `validation`, `active`, `date_cart`) VALUES
(22, 3, 4, 0, 15, 9, 0, 0, '2020-01-31 15:53:28'),
(23, 1, 4, 0, 15, 4, 0, 0, '2020-01-31 15:53:28'),
(24, 2, 8, 0, 15, 8, 1, 0, '2020-02-05 20:51:07'),
(25, 5, 8, 0, 15, 1, 1, 0, '2020-02-04 20:16:24'),
(26, 1, 8, 0, 15, 9, 1, 0, '2020-02-05 20:50:34'),
(27, 3, 8, 0, 15, 5, 1, 1, '2020-02-07 21:14:08'),
(28, 4, 8, 0, 15, 14, 1, 1, '2020-01-31 14:13:05'),
(29, 5, 8, 0, 15, 1, 1, 0, '2020-02-04 20:33:39'),
(30, 1, 4, 0, 15, 4, 0, 0, '2020-01-31 15:53:28'),
(31, 0, 4, 0, 15, 4, 0, 1, '2020-01-31 15:22:10'),
(32, 0, 4, 0, 15, 3, 0, 1, '2020-01-31 15:23:50'),
(33, 0, 4, 0, 15, 4, 0, 1, '2020-01-31 15:25:37'),
(34, 0, 4, 0, 15, 4, 0, 1, '2020-01-31 15:25:59'),
(35, 0, 4, 0, 15, 4, 0, 1, '2020-01-31 15:26:06'),
(36, 3, 4, 0, 15, 9, 0, 1, '2020-01-31 15:52:02'),
(37, 1, 4, 0, 15, 4, 0, 0, '2020-01-31 15:48:57'),
(38, 2, 8, 0, 15, 5, 0, 1, '2020-02-05 20:51:07'),
(40, 0, 8, 0, 0, 0, 0, 1, '2020-02-04 20:34:59'),
(41, 0, 8, 0, 0, 0, 0, 1, '2020-02-04 20:43:49'),
(42, 0, 8, 0, 0, 0, 0, 1, '2020-02-04 20:43:59'),
(43, 1, 8, 0, 15, 9, 0, 1, '2020-02-05 20:50:34'),
(44, 0, 8, 0, 0, 0, 0, 1, '2020-02-04 20:48:15'),
(45, 0, 8, 0, 0, 0, 0, 1, '2020-02-04 20:55:46'),
(46, 0, 8, 0, 0, 0, 0, 1, '2020-02-04 20:56:42'),
(47, 0, 8, 0, 0, 0, 0, 1, '2020-02-04 21:08:21'),
(48, 0, 8, 0, 0, 0, 0, 1, '2020-02-04 21:08:38'),
(49, 0, 8, 0, 0, 0, 0, 1, '2020-02-04 21:10:07');

-- --------------------------------------------------------

--
-- Structure de la table `categorys`
--

DROP TABLE IF EXISTS `categorys`;
CREATE TABLE IF NOT EXISTS `categorys` (
  `id_category` int(11) NOT NULL AUTO_INCREMENT,
  `title_category` varchar(100) NOT NULL,
  `category_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `img` varchar(255) NOT NULL,
  PRIMARY KEY (`id_category`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `categorys`
--

INSERT INTO `categorys` (`id_category`, `title_category`, `category_create`, `img`) VALUES
(1, 'Pommier', '2020-02-07 20:44:36', 'Pommier-1.png'),
(2, 'Poirier', '2020-02-07 20:45:09', 'Poirier_2.png'),
(3, 'Prunier', '2020-02-07 20:47:32', 'prunier2.png'),
(4, 'Cerisier', '2020-02-07 20:46:09', 'cerisier-1.png');

-- --------------------------------------------------------

--
-- Structure de la table `payment`
--

DROP TABLE IF EXISTS `payment`;
CREATE TABLE IF NOT EXISTS `payment` (
  `id_payment` int(11) NOT NULL AUTO_INCREMENT,
  `number_ordered` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `date_payment` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_payment`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `payment`
--

INSERT INTO `payment` (`id_payment`, `number_ordered`, `id_user`, `date_payment`) VALUES
(1, 101, 4, '2020-01-31 15:53:28');

-- --------------------------------------------------------

--
-- Structure de la table `pictures`
--

DROP TABLE IF EXISTS `pictures`;
CREATE TABLE IF NOT EXISTS `pictures` (
  `id_picture` int(11) NOT NULL AUTO_INCREMENT,
  `title_picture` varchar(300) NOT NULL,
  `id_product` int(11) NOT NULL,
  `date_img` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_picture`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `pictures`
--

INSERT INTO `pictures` (`id_picture`, `title_picture`, `id_product`, `date_img`) VALUES
(15, 'Astrakan_rouge1.png', 3, '2020-02-07 21:10:24'),
(16, 'Astrakan_rouge3.png', 3, '2020-02-07 21:10:24'),
(17, 'Belle_de_boskoop_rouge1.png', 4, '2020-02-07 21:10:53'),
(18, 'Belle_de_boskoop_rouge2.png', 4, '2020-02-07 21:10:53'),
(19, 'poire-beurre-danjou.png', 2, '2020-02-07 21:11:57'),
(20, 'poirier-beurre-danjou.png', 2, '2020-02-07 21:11:57'),
(21, 'poire duc de nemour_-_7.djvu.png', 1, '2020-02-07 21:12:27'),
(22, 'poire-DucNemours.png', 1, '2020-02-07 21:12:27'),
(23, 'prune-des-bejonnières.png', 5, '2020-02-07 21:12:56'),
(24, 'prune-des-béjonnières.png', 5, '2020-02-07 21:12:56'),
(34, 'Calville_blanc_hiver1.png', 6, '2020-02-09 20:43:20'),
(35, 'Calville_blanc_hiver2.png', 6, '2020-02-09 20:43:20'),
(36, 'Calville_blanc_hiver3.png', 6, '2020-02-09 20:43:20'),
(39, 'Jonagold1.png', 7, '2020-02-09 20:48:53'),
(40, 'Jonagold3.png', 7, '2020-02-09 20:48:53'),
(45, 'Reinnette_clochard1.png', 8, '2020-02-09 21:08:53'),
(46, 'Reinnette_clochard2.png', 8, '2020-02-09 21:08:53'),
(49, 'cerises-Napoleon-ass.png', 10, '2020-02-09 21:22:54'),
(50, 'cerisier-Napoleon.png', 10, '2020-02-09 21:22:54'),
(51, 'prunes-quetche.png', 9, '2020-02-09 21:25:45'),
(52, 'quetche-alsace.png', 9, '2020-02-09 21:25:45');

-- --------------------------------------------------------

--
-- Structure de la table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id_product` int(11) NOT NULL AUTO_INCREMENT,
  `title_product` varchar(50) NOT NULL,
  `price` float NOT NULL,
  `short_desc` varchar(200) NOT NULL,
  `long_desc` varchar(300) NOT NULL,
  `stock` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT '1',
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `id_category` int(11) NOT NULL,
  `id_tva` int(11) NOT NULL,
  `create_product` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_product`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `products`
--

INSERT INTO `products` (`id_product`, `title_product`, `price`, `short_desc`, `long_desc`, `stock`, `quantity`, `active`, `id_category`, `id_tva`, `create_product`) VALUES
(1, 'Poire duc de nemours', 15, 'L’arbre est vigoureux et fertile ; il se forme bien en pyramide, sur franc et sur coignassier.', '<p>Maturité: fin octobre à mi-novembre</p><p>Calibre: gros</p><p>Qualité: chair fondante et fine</p>', 50, 1, 1, 2, 1, '2020-02-07 21:18:11'),
(2, 'Poire beurré d\'Anjou', 15, 'Le Poirier Beurré Superfin, arbre vigoureux, rustique, bois très fort, nombreux rameux.', '<p>Maturité: mi-octobre à mi-novembre</p><p>Calibre: moyen</p><p>Qualité: juteux, fondant</p>', 50, 1, 1, 2, 1, '2020-02-07 21:18:15'),
(3, 'Astrakan rouge', 15, 'L\'arbre au port érigé est peu vigoureux mais très fertile. L\'idéal est de le greffer sur franc.\r\nSes rameaux sont bruns, duveteux et érigés de couleur vert-grisâtre à brun.', '<p>Maturité: Août</p><p>Utilisation: à couteau</p><p>Description: fruit moyen, jaune strié de rouge, chair blanche fine sucrée et acidulée, vigueur moyenne mais productif, la première bonne pomme de l’année</p>', 50, 1, 1, 1, 1, '2020-02-07 21:18:20'),
(4, 'Belle de Boskoop rouge', 15, 'Le pommier est vigoureux, très résistant au froid et d´une grande fertilité.', 'Maturité: décembre à févrierUtilisation: à couteau et à cuireDescription: rouge foncé, sucrée et acidulée comme les reinettes, bonne pour la patisserie', 50, 1, 1, 1, 1, '2020-02-07 21:18:24'),
(5, 'Prunes des Béjonnières', 15, 'Variété ancienne de l\'Anjou, resistante aux vers.', '<p>Maturité: août</p><p>Couleur: jaune avec points rouges</p><p>Calibre: moyen</p><p>Qualité: sucré, juteux, parfumé</p><p>Remarques: fruit peu infecté par les vers</p>', 50, 1, 1, 3, 1, '2020-02-07 21:18:28'),
(6, 'Calville blanc d\\\'hiver', 15, 'De forte vigueur, le pommier Calville Blanc est généralement cultivé en haute tige à l\\\'abri des vents d\\\'hiver, pour éviter la chute prématurée des pommes. C\\\'est un bel arbre très productif.', '<p style=\\\"text-align: left;\\\">Maturité: Décembre à mai</p><p style=\\\"text-align: left;\\\">Utilisation: à couteau</p><p style=\\\"text-align: left;\\\">Description: chair fine, sucrée, considéré comme un fruit de luxe dans les années cinquante, variété très fertile, peu sensible à la tavelure</p>', 50, 1, 1, 1, 1, '2020-02-09 20:43:57'),
(7, 'Jonagold', 15, 'Le pommier Jonagold a un port érigé, puis étalé lorsque les premiers fruits apparaissent. De forte vigueur, il offre une récolte abondante. La floraison a lieu mi-avril.', '<p style=\\\"text-align: left;\\\">Maturité: novembre à janvier</p><p style=\\\"text-align: left;\\\">Utilisation: à couteau et à cuire</p><p style=\\\"text-align: left;\\\">Description: grosse pomme, jaune-orangé strié de rose-rouge, chair croquante, juteuse, sucré</p>', 50, 1, 1, 1, 1, '2020-02-09 20:55:59'),
(8, 'Reinette clochard', 15, 'Le pommier est d´une assez grande vigueur et bénéficie d´une bonne fertilité. Les fruits tiennent dans le pommier de novembre à janvier et se consomment jusqu\'en mars. ', '<p style=\"text-align: left;\">Maturité: décembre à mai</p><p style=\"text-align: left;\">Utilisation: à couteau</p><p style=\"text-align: left;\">Description: excellente pomme, peau jaune avec tache de rouille, sa chair est fine, juteuse et sucrée, douce sans acidité</p>', 50, 1, 1, 1, 1, '2020-02-09 21:09:31'),
(9, 'Quetsche d\'Alsace', 15, 'Le prunier a le don de s’adapter à tous les climats et à tous les sols : un atout qui en fait un excellent choix d’arbre fruitier à planter dans le jardin.', '<p style=\"text-align: left;\">Maturité: septembre</p><p style=\"text-align: left;\">Couleur: violet</p><p style=\"text-align: left;\">Calibre: moyen</p><p style=\"text-align: left;\">Qualité: sucré, acidulé</p><p style=\"text-align: left;\">Remarques: autofertile</p>', 50, 50, 1, 3, 1, '2020-02-09 21:25:45'),
(10, 'Cerises Napoléons', 15, 'De bonne vigueur, le cerisier Napoléon a un port demi-érigé et une floraison d\\\'époque moyenne, il peut être associé à Burlat pour une pollinisation croisée.', '<p style=\\\"text-align: left;\\\">Type: bigarreau</p><p style=\\\"text-align: left;\\\">Maturité: fin juin</p><p style=\\\"text-align: left;\\\">Couleur: jaune rose</p><p style=\\\"text-align: left;\\\">Remarques: excellent pollinisateur</p>', 50, 1, 1, 4, 1, '2020-02-09 21:23:36');

-- --------------------------------------------------------

--
-- Structure de la table `tva`
--

DROP TABLE IF EXISTS `tva`;
CREATE TABLE IF NOT EXISTS `tva` (
  `id_tva` int(11) NOT NULL AUTO_INCREMENT,
  `tva` float NOT NULL,
  PRIMARY KEY (`id_tva`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `tva`
--

INSERT INTO `tva` (`id_tva`, `tva`) VALUES
(1, 20),
(4, 40);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `last_name` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `adress` varchar(300) NOT NULL,
  `login` varchar(100) NOT NULL,
  `password` varchar(300) NOT NULL,
  `role` tinyint(1) NOT NULL DEFAULT '1',
  `user_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id_user`, `last_name`, `name`, `adress`, `login`, `password`, `role`, `user_create`) VALUES
(1, 'Postel', 'Simon', '6 avenue de l\'armorial 44300 Nantes', 'simon@gmail.com', 'simon', 1, '2020-01-13 09:54:21'),
(2, 'Elgueta', 'Anaïs', '6 avenue de l\'armorial 44300 Nantes', 'anais@gmail.com', 'anais', 5, '2020-01-13 11:02:50'),
(3, 'Postel', 'Allan', '6 avenue de l\'armorial 44300 Nantes', 'allan@gmail.com', 'allan', 1, '2020-01-13 12:36:18'),
(4, 'Postel', 'André', '1 rue de fontaine 14930 Maltot', 'andre@gmail.com', '$2y$10$XxcfbggRnUnBP.gIzke5Y.su.sf2WAu0eDm4Wfk.Kb9pyYuxMjLcu', 1, '2020-01-24 13:13:27'),
(5, 'Postel', 'Marie', '1 rue de fontaine 14930 Maltot', 'marie@gmail.com', '$2y$10$YqSWKD5/jwUivP0At965SOMtsZ0F3/hEuXWt8ZCM99lxV78jQAvve', 1, '2020-01-13 14:36:41'),
(6, 'Postel', 'Nattan', '6 avenue de l\'armorial 44300 Nantes', 'nattan@gmail.com', '$2y$10$unPhGJTrkEqAXGwZ70gshe6LGMrp.KO0pNt0OiHakeZoySultELh2', 1, '2020-01-24 10:42:23'),
(8, 'achille', 'lucie', 'arinfo', 'lucie@gmail.com', '$2y$10$eq.tWCOh0uh1g7dqEbxH7.0cSdBhxWSHdEWis1MykwPqATK9JRFNe', 5, '2020-01-14 16:07:48'),
(9, 'niobey', 'alexandre', 'arinfo', 'alex@gmail.com', '$2y$10$cXlGY9Kcw9MiPQ8g08Zd.O6snneLEvKDPq.e9JESdefbyN2FV/O4m', 1, '2020-01-24 10:42:40');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
