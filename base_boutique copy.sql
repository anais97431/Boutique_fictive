-- phpMyAdmin SQL Dump
    -- version 4.5.4.1
    -- http://www.phpmyadmin.net
    --

    -- Client :  localhost
    -- Généré le :  Mer 15 Janvier 2020 à 11:46
    -- Version du serveur :  5.7.11
    -- Version de PHP :  7.2.7
SET
    SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET
    time_zone = "+00:00";
    /*!40101
SET
    @OLD_CHARACTER_SET_CLIENT = @@CHARACTER_SET_CLIENT */;
    /*!40101
SET
    @OLD_CHARACTER_SET_RESULTS = @@CHARACTER_SET_RESULTS */;
    /*!40101
SET
    @OLD_COLLATION_CONNECTION = @@COLLATION_CONNECTION */;
    /*!40101
SET NAMES
    utf8mb4 */;
    --

    -- Base de données :  `base_boutique`
    --

    -- --------------------------------------------------------
    --

    -- Structure de la table `carts`
    --

CREATE TABLE `carts`(
    `id_cart` INT(11) NOT NULL,
    `id_product` INT(11) NOT NULL,
    `id_user` INT(11) NOT NULL,
    `id_payment` INT(11) NOT NULL,
    `price` FLOAT NOT NULL,
    `quantity` INT(11) NOT NULL,
    `validation` INT(11) NOT NULL DEFAULT '0',
    `date_cart` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE = InnoDB DEFAULT CHARSET = latin1;
-- --------------------------------------------------------
--

-- Structure de la table `categorys`
--

CREATE TABLE `categorys`(
    `id_category` INT(11) NOT NULL,
    `title_category` VARCHAR(100) NOT NULL,
    `category_create` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE = InnoDB DEFAULT CHARSET = latin1;
-- --------------------------------------------------------
--

-- Structure de la table `payment`
--

CREATE TABLE `payment`(
    `id_payment` INT(11) NOT NULL,
    `number_ordered` INT(11) NOT NULL,
    `id_user` INT(11) NOT NULL,
    `date_payment` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE = InnoDB DEFAULT CHARSET = latin1;
-- --------------------------------------------------------
--

-- Structure de la table `pictures`
--

CREATE TABLE `pictures`(
    `id_picture` INT(11) NOT NULL,
    `title_picture` VARCHAR(300) NOT NULL,
    `id_product` INT(11) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = latin1;
-- --------------------------------------------------------
--

-- Structure de la table `products`
--

CREATE TABLE `products`(
    `id_product` INT(11) NOT NULL,
    `title_product` VARCHAR(50) NOT NULL,
    `price` FLOAT NOT NULL,
    `short_desc` VARCHAR(100) NOT NULL,
    `long_desc` VARCHAR(300) NOT NULL,
    `stock` INT(11) NOT NULL,
    `quantity` INT(11) NOT NULL DEFAULT '1',
    `active` TINYINT(1) NOT NULL DEFAULT '0',
    `id_category` INT(11) NOT NULL,
    `id_tva` INT(11) NOT NULL,
    `create_product` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE = InnoDB DEFAULT CHARSET = latin1;
-- --------------------------------------------------------
--

-- Structure de la table `tva`
--

CREATE TABLE `tva`(
    `id_tva` INT(11) NOT NULL,
    `tva` FLOAT NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = latin1;
-- --------------------------------------------------------
--

-- Structure de la table `users`
--

CREATE TABLE `users`(
    `id_user` INT(11) NOT NULL,
    `last_name` VARCHAR(50) NOT NULL,
    `name` VARCHAR(50) NOT NULL,
    `adress` VARCHAR(300) NOT NULL,
    `login` VARCHAR(100) NOT NULL,
    `password` VARCHAR(300) NOT NULL,
    `role` TINYINT(1) NOT NULL DEFAULT '1',
    `user_create` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE = InnoDB DEFAULT CHARSET = latin1;
--

-- Contenu de la table `users`
--

INSERT INTO `users`(
    `id_user`,
    `last_name`,
    `name`,
    `adress`,
    `login`,
    `password`,
    `role`,
    `user_create`
)
VALUES(
    1,
    'Postel',
    'Simon',
    '6 avenue de l\'armorial 44300 Nantes',
    'simon@gmail.com',
    'simon',
    1,
    '2020-01-13 09:54:21'
),(
    2,
    'Elgueta',
    'Anaïs',
    '6 avenue de l\'armorial 44300 Nantes',
    'anais@gmail.com',
    'anais',
    5,
    '2020-01-13 11:02:50'
),(
    3,
    'Postel',
    'Allan',
    '6 avenue de l\'armorial 44300 Nantes',
    'allan@gmail.com',
    'allan',
    1,
    '2020-01-13 12:36:18'
),(
    4,
    'Postel',
    'André',
    '1 rue de fontaine 14930 Maltot',
    'andre@gmail.com',
    '$2y$10$i7h..Fjqie8qgqoAGgm/q.i/mur57HhvQxOPp8E6.gX7/JmTkckNK',
    1,
    '2020-01-13 12:57:07'
),(
    5,
    'Postel',
    'Marie',
    '1 rue de fontaine 14930 Maltot',
    'marie@gmail.com',
    '$2y$10$YqSWKD5/jwUivP0At965SOMtsZ0F3/hEuXWt8ZCM99lxV78jQAvve',
    1,
    '2020-01-13 14:36:41'
),(
    6,
    'Elgueta',
    'mattias',
    '11 rue des lilas 21120 marcilly',
    'mattias@gmail.com',
    '$2y$10$unPhGJTrkEqAXGwZ70gshe6LGMrp.KO0pNt0OiHakeZoySultELh2',
    1,
    '2020-01-13 14:38:39'
),(
    8,
    'achille',
    'lucie',
    'arinfo',
    'lucie@gmail.com',
    '$2y$10$eq.tWCOh0uh1g7dqEbxH7.0cSdBhxWSHdEWis1MykwPqATK9JRFNe',
    5,
    '2020-01-14 16:07:48'
),(
    9,
    'niobey',
    'alexandre',
    'arinfo',
    '',
    '$2y$10$cXlGY9Kcw9MiPQ8g08Zd.O6snneLEvKDPq.e9JESdefbyN2FV/O4m',
    1,
    '2020-01-15 09:52:00'
),(
    10,
    'niobey',
    'alexandre',
    'arinfo',
    '',
    '$2y$10$vYuKNmaQoImHKFjQ8TZA7.JTcFyqFBq.t.VhXpaEkU7HrYwWApwRO',
    1,
    '2020-01-15 09:52:00'
);
--

-- Index pour les tables exportées
--

--

-- Index pour la table `carts`
--

ALTER TABLE
    `carts` ADD PRIMARY KEY(`id_cart`);
    --

    -- Index pour la table `categorys`
    --

ALTER TABLE
    `categorys` ADD PRIMARY KEY(`id_category`);
    --

    -- Index pour la table `payment`
    --

ALTER TABLE
    `payment` ADD PRIMARY KEY(`id_payment`);
    --

    -- Index pour la table `pictures`
    --

ALTER TABLE
    `pictures` ADD PRIMARY KEY(`id_picture`);
    --

    -- Index pour la table `products`
    --

ALTER TABLE
    `products` ADD PRIMARY KEY(`id_product`);
    --

    -- Index pour la table `tva`
    --

ALTER TABLE
    `tva` ADD PRIMARY KEY(`id_tva`);
    --

    -- Index pour la table `users`
    --

ALTER TABLE
    `users` ADD PRIMARY KEY(`id_user`);
    --

    -- AUTO_INCREMENT pour les tables exportées
    --

    --

    -- AUTO_INCREMENT pour la table `carts`
    --

ALTER TABLE
    `carts` MODIFY `id_cart` INT(11) NOT NULL AUTO_INCREMENT;
    --

    -- AUTO_INCREMENT pour la table `categorys`
    --

ALTER TABLE
    `categorys` MODIFY `id_category` INT(11) NOT NULL AUTO_INCREMENT;
    --

    -- AUTO_INCREMENT pour la table `payment`
    --

ALTER TABLE
    `payment` MODIFY `id_payment` INT(11) NOT NULL AUTO_INCREMENT;
    --

    -- AUTO_INCREMENT pour la table `pictures`
    --

ALTER TABLE
    `pictures` MODIFY `id_picture` INT(11) NOT NULL AUTO_INCREMENT;
    --

    -- AUTO_INCREMENT pour la table `products`
    --

ALTER TABLE
    `products` MODIFY `id_product` INT(11) NOT NULL AUTO_INCREMENT;
    --

    -- AUTO_INCREMENT pour la table `tva`
    --

ALTER TABLE
    `tva` MODIFY `id_tva` INT(11) NOT NULL AUTO_INCREMENT;
    --

    -- AUTO_INCREMENT pour la table `users`
    --

ALTER TABLE
    `users` MODIFY `id_user` INT(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 11;
    /*!40101
SET
    CHARACTER_SET_CLIENT = @OLD_CHARACTER_SET_CLIENT */;
    /*!40101
SET
    CHARACTER_SET_RESULTS = @OLD_CHARACTER_SET_RESULTS */;
    /*!40101
SET
    COLLATION_CONNECTION = @OLD_COLLATION_CONNECTION */;