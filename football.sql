-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 05 mars 2024 à 13:50
-- Version du serveur : 8.0.31
-- Version de PHP : 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `football`
--

-- --------------------------------------------------------

--
-- Structure de la table `competitions`
--

DROP TABLE IF EXISTS `competitions`;
CREATE TABLE IF NOT EXISTS `competitions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `number` int NOT NULL,
  `league_id` int NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `league_id` (`league_id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `competitions`
--

INSERT INTO `competitions` (`id`, `name`, `number`, `league_id`, `created_at`, `updated_at`) VALUES
(1, 'Liga', 302, 1, '2024-01-02 00:30:24', '2024-01-02 00:30:24'),
(5, 'Premier League', 152, 2, '2024-01-02 00:30:24', '2024-01-02 00:30:24'),
(9, '1ere division', 123, 11, '2024-01-02 00:30:24', '2024-01-02 00:30:24'),
(11, 'Botola Pro', 239, 12, '2024-01-02 00:36:03', '2024-01-02 00:36:03'),
(12, 'Serie A', 207, 3, '2024-01-02 00:36:03', '2024-01-02 00:36:03'),
(15, 'Ligue 1', 168, 4, '2024-01-02 00:36:03', '2024-01-02 00:36:03'),
(18, 'Primiera Liga', 266, 6, '2024-01-02 00:36:03', '2024-01-02 00:36:03'),
(22, '1ere Division A', 63, 7, '2024-01-02 00:46:23', '2024-01-02 00:46:23'),
(25, '1ere Division', 344, 9, '2024-01-02 00:46:23', '2024-01-02 00:46:23'),
(28, 'Saudi League', 278, 13, '2024-01-02 00:46:23', '2024-01-02 00:46:23'),
(31, 'Super Lig', 322, 5, '2024-01-02 00:46:23', '2024-01-02 00:46:23'),
(35, 'Super League 1', 178, 15, '2024-01-02 00:46:23', '2024-01-02 00:46:23'),
(37, 'Eredivisie', 244, 14, '2024-01-02 00:48:01', '2024-01-02 00:48:01'),
(40, 'Bundesliga ', 175, 8, '2024-01-02 05:39:40', '2024-01-02 05:39:40'),
(41, 'CAN', 29, 11, '2024-01-13 22:03:22', '2024-01-13 22:03:22'),
(42, 'UEFA Champions League', 3, 16, '2024-02-13 19:52:49', '2024-02-13 19:52:49'),
(43, 'UEFA Europa League', 4, 16, '2024-02-13 19:52:49', '2024-02-13 19:52:49'),
(44, 'UEFA Conference League', 683, 16, '2024-02-13 19:52:49', '2024-02-13 19:52:49');

-- --------------------------------------------------------

--
-- Structure de la table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `favorites`
--

DROP TABLE IF EXISTS `favorites`;
CREATE TABLE IF NOT EXISTS `favorites` (
  `id` int NOT NULL AUTO_INCREMENT,
  `match_key` int NOT NULL,
  `match_date` datetime NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `favorites`
--

INSERT INTO `favorites` (`id`, `match_key`, `match_date`, `created_at`, `updated_at`) VALUES
(48, 1270116, '2024-02-12 00:00:00', '2024-02-12 14:26:52', '2024-02-12 14:26:52'),
(58, 1253910, '2024-02-13 00:00:00', '2024-02-13 11:15:20', '2024-02-13 11:15:20');

-- --------------------------------------------------------

--
-- Structure de la table `favorite_user`
--

DROP TABLE IF EXISTS `favorite_user`;
CREATE TABLE IF NOT EXISTS `favorite_user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `favorite_id` int NOT NULL,
  `user_id` int NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `favorite_id` (`favorite_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `leagues`
--

DROP TABLE IF EXISTS `leagues`;
CREATE TABLE IF NOT EXISTS `leagues` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `number` int NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `leagues`
--

INSERT INTO `leagues` (`id`, `name`, `number`, `created_at`, `updated_at`) VALUES
(1, 'Espagne', 6, '2024-01-01 23:55:48', '2024-01-16 01:29:28'),
(2, 'Angleterre', 44, '2024-01-01 23:55:48', '2024-01-16 01:29:29'),
(3, 'Italie', 5, '2024-01-01 23:58:55', '2024-01-16 01:29:29'),
(4, 'France', 3, '2024-01-01 23:58:55', '2024-01-16 01:29:29'),
(5, 'Turquie', 111, '2024-01-01 23:58:55', '2024-01-16 01:29:29'),
(6, 'Portugal', 92, '2024-01-01 23:58:55', '2024-01-16 01:29:29'),
(7, 'Belgique', 23, '2024-01-01 23:58:55', '2024-01-16 01:29:29'),
(8, 'Allemagne', 4, '2024-01-02 00:00:44', '2024-01-16 01:29:29'),
(9, 'Russie', 95, '2024-01-02 00:00:44', '2024-01-16 01:29:29'),
(11, 'Afrique', 2, '2024-01-02 00:00:44', '2024-01-16 01:36:53'),
(12, 'Maroc', 80, '2024-01-02 00:00:44', '2024-01-16 01:29:30'),
(13, 'Arabie Saoudite', 97, '2024-01-02 00:01:45', '2024-01-16 01:29:30'),
(14, 'Pays Bas', 82, '2024-01-02 00:01:45', '2024-01-16 01:29:30'),
(15, 'Grece', 51, '2024-01-02 00:02:12', '2024-01-16 01:29:30'),
(16, 'eurocups', 1, '2024-02-13 19:46:54', '2024-02-13 19:46:54');

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1);

-- --------------------------------------------------------

--
-- Structure de la table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `teams`
--

DROP TABLE IF EXISTS `teams`;
CREATE TABLE IF NOT EXISTS `teams` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `competition_id` int NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `competition_id` (`competition_id`)
) ENGINE=InnoDB AUTO_INCREMENT=273 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `teams`
--

INSERT INTO `teams` (`id`, `name`, `competition_id`, `created_at`, `updated_at`) VALUES
(1, 'Atletico Madrid', 1, '2024-01-11 18:40:43', '2024-01-11 18:40:43'),
(2, 'Real Madrid', 1, '2024-01-11 18:40:43', '2024-01-11 18:40:43'),
(3, 'Sevilla', 1, '2024-01-11 18:40:44', '2024-01-11 18:40:44'),
(4, 'Barcelona', 1, '2024-01-11 18:40:44', '2024-01-11 18:40:44'),
(5, 'Granada', 1, '2024-01-11 18:40:44', '2024-01-11 18:40:44'),
(6, 'Real Sociedad', 1, '2024-01-11 18:40:45', '2024-01-11 18:40:45'),
(7, 'Villarreal', 1, '2024-01-11 18:40:45', '2024-01-11 18:40:45'),
(8, 'Athletic Bilbao', 1, '2024-01-11 18:40:45', '2024-01-11 18:40:45'),
(9, 'Almeria', 1, '2024-01-11 18:40:45', '2024-01-11 18:40:45'),
(10, 'Real Betis', 1, '2024-01-11 18:40:45', '2024-01-11 18:40:45'),
(11, 'Girona', 1, '2024-01-11 18:40:45', '2024-01-11 18:40:45'),
(12, 'Rayo Vallecano', 1, '2024-01-11 18:40:46', '2024-01-11 18:40:46'),
(13, 'Osasuna', 1, '2024-01-11 18:40:46', '2024-01-11 18:40:46'),
(14, 'Valencia', 1, '2024-01-11 18:40:46', '2024-01-11 18:40:46'),
(15, 'Alaves', 1, '2024-01-11 18:40:46', '2024-01-11 18:40:46'),
(16, 'Cadiz', 1, '2024-01-11 18:40:46', '2024-01-11 18:40:46'),
(17, 'Mallorca', 1, '2024-01-11 18:40:46', '2024-01-11 18:40:46'),
(18, 'Getafe', 1, '2024-01-11 18:40:46', '2024-01-11 18:40:46'),
(19, 'Las Palmas', 1, '2024-01-11 18:40:46', '2024-01-11 18:40:46'),
(20, 'Celta Vigo', 1, '2024-01-11 18:40:47', '2024-01-11 18:40:47'),
(21, 'Manchester City', 5, '2024-01-11 18:40:51', '2024-01-11 18:40:51'),
(22, 'Liverpool', 5, '2024-01-11 18:40:52', '2024-01-11 18:40:52'),
(23, 'Chelsea', 5, '2024-01-11 18:40:53', '2024-01-11 18:40:53'),
(24, 'Manchester United', 5, '2024-01-11 18:40:53', '2024-01-11 18:40:53'),
(25, 'Arsenal', 5, '2024-01-11 18:40:54', '2024-01-11 18:40:54'),
(26, 'Tottenham Hotspur', 5, '2024-01-11 18:40:54', '2024-01-11 18:40:54'),
(27, 'AFC Bournemouth', 5, '2024-01-11 18:40:55', '2024-01-11 18:40:55'),
(28, 'Everton', 5, '2024-01-11 18:40:55', '2024-01-11 18:40:55'),
(29, 'Sheffield United', 5, '2024-01-11 18:40:55', '2024-01-11 18:40:55'),
(30, 'Burnley', 5, '2024-01-11 18:40:56', '2024-01-11 18:40:56'),
(31, 'Wolverhampton Wanderers', 5, '2024-01-11 18:40:56', '2024-01-11 18:40:56'),
(32, 'Brighton & Hove Albion', 5, '2024-01-11 18:40:56', '2024-01-11 18:40:56'),
(33, 'West Ham United', 5, '2024-01-11 18:40:56', '2024-01-11 18:40:56'),
(34, 'Fulham', 5, '2024-01-11 18:40:57', '2024-01-11 18:40:57'),
(35, 'Brentford', 5, '2024-01-11 18:40:57', '2024-01-11 18:40:57'),
(36, 'Aston Villa', 5, '2024-01-11 18:40:57', '2024-01-11 18:40:57'),
(37, 'Nottingham Forest', 5, '2024-01-11 18:40:57', '2024-01-11 18:40:57'),
(38, 'Luton Town', 5, '2024-01-11 18:40:58', '2024-01-11 18:40:58'),
(39, 'Newcastle United', 5, '2024-01-11 18:40:58', '2024-01-11 18:40:58'),
(40, 'Crystal Palace', 5, '2024-01-11 18:40:58', '2024-01-11 18:40:58'),
(41, 'Racing d\'Abidjan', 9, '2024-01-11 18:41:01', '2024-01-11 18:41:01'),
(42, 'San-Pédro', 9, '2024-01-11 18:41:02', '2024-01-11 18:41:02'),
(43, 'ASEC Mimosas', 9, '2024-01-11 18:41:02', '2024-01-11 18:41:02'),
(44, 'SOA', 9, '2024-01-11 18:41:03', '2024-01-11 18:41:03'),
(45, 'AFAD', 9, '2024-01-11 18:41:03', '2024-01-11 18:41:03'),
(46, 'Indenié Abengourou', 9, '2024-01-11 18:41:03', '2024-01-11 18:41:03'),
(47, 'SOL', 9, '2024-01-11 18:41:04', '2024-01-11 18:41:04'),
(48, 'Sporting Gagnoa', 9, '2024-01-11 18:41:04', '2024-01-11 18:41:04'),
(49, 'Bouaké', 9, '2024-01-11 18:41:04', '2024-01-11 18:41:04'),
(50, 'Stella', 9, '2024-01-11 18:41:04', '2024-01-11 18:41:04'),
(51, 'Lys Sassandra', 9, '2024-01-11 18:41:04', '2024-01-11 18:41:04'),
(52, 'Korhogo', 9, '2024-01-11 18:41:05', '2024-01-11 18:41:05'),
(53, 'Stade d\'Abidjan', 9, '2024-01-11 18:41:05', '2024-01-11 18:41:05'),
(54, 'Denguélé', 9, '2024-01-11 18:41:05', '2024-01-11 18:41:05'),
(55, 'Mouna', 9, '2024-01-11 18:41:06', '2024-01-11 18:41:06'),
(56, 'Zoman', 9, '2024-01-11 18:41:06', '2024-01-11 18:41:06'),
(57, 'RSB Berkane', 11, '2024-01-11 18:41:09', '2024-01-11 18:41:09'),
(58, 'Wydad Casablanca', 11, '2024-01-11 18:41:10', '2024-01-11 18:41:10'),
(59, 'Raja Casablanca', 11, '2024-01-11 18:41:10', '2024-01-11 18:41:10'),
(60, 'Olympic Safi', 11, '2024-01-11 18:41:10', '2024-01-11 18:41:10'),
(61, 'FAR Rabat', 11, '2024-01-11 18:41:10', '2024-01-11 18:41:10'),
(62, 'Ittihad Tanger', 11, '2024-01-11 18:41:10', '2024-01-11 18:41:10'),
(63, 'Maghreb Fès', 11, '2024-01-11 18:41:11', '2024-01-11 18:41:11'),
(64, 'Youssoufia Berrechid', 11, '2024-01-11 18:41:11', '2024-01-11 18:41:11'),
(65, 'Hassania Agadir', 11, '2024-01-11 18:41:11', '2024-01-11 18:41:11'),
(66, 'Chabab Mohammédia', 11, '2024-01-11 18:41:11', '2024-01-11 18:41:11'),
(67, 'Mouloudia Oujda', 11, '2024-01-11 18:41:11', '2024-01-11 18:41:11'),
(68, 'FUS Rabat', 11, '2024-01-11 18:41:11', '2024-01-11 18:41:11'),
(69, 'Moghreb Tétouan', 11, '2024-01-11 18:41:12', '2024-01-11 18:41:12'),
(70, 'Renaissance Zemamra', 11, '2024-01-11 18:41:12', '2024-01-11 18:41:12'),
(71, 'JS Soualem', 11, '2024-01-11 18:41:12', '2024-01-11 18:41:12'),
(72, 'UTS Rabat', 11, '2024-01-11 18:41:12', '2024-01-11 18:41:12'),
(73, 'Inter Milan', 12, '2024-01-11 18:41:16', '2024-01-11 18:41:16'),
(74, 'Atalanta', 12, '2024-01-11 18:41:16', '2024-01-11 18:41:16'),
(75, 'Lazio', 12, '2024-01-11 18:41:16', '2024-01-11 18:41:16'),
(76, 'Juventus', 12, '2024-01-11 18:41:16', '2024-01-11 18:41:16'),
(77, 'Roma', 12, '2024-01-11 18:41:17', '2024-01-11 18:41:17'),
(78, 'Napoli', 12, '2024-01-11 18:41:17', '2024-01-11 18:41:17'),
(79, 'AC Milan', 12, '2024-01-11 18:41:17', '2024-01-11 18:41:17'),
(80, 'Torino', 12, '2024-01-11 18:41:17', '2024-01-11 18:41:17'),
(81, 'Fiorentina', 12, '2024-01-11 18:41:17', '2024-01-11 18:41:17'),
(82, 'Sassuolo', 12, '2024-01-11 18:41:17', '2024-01-11 18:41:17'),
(83, 'Empoli', 12, '2024-01-11 18:41:17', '2024-01-11 18:41:17'),
(84, 'Cagliari', 12, '2024-01-11 18:41:18', '2024-01-11 18:41:18'),
(85, 'Verona', 12, '2024-01-11 18:41:18', '2024-01-11 18:41:18'),
(86, 'Bologna', 12, '2024-01-11 18:41:18', '2024-01-11 18:41:18'),
(87, 'Udinese', 12, '2024-01-11 18:41:18', '2024-01-11 18:41:18'),
(88, 'Genoa', 12, '2024-01-11 18:41:18', '2024-01-11 18:41:18'),
(89, 'Monza', 12, '2024-01-11 18:41:18', '2024-01-11 18:41:18'),
(90, 'Frosinone', 12, '2024-01-11 18:41:18', '2024-01-11 18:41:18'),
(91, 'Lecce', 12, '2024-01-11 18:41:19', '2024-01-11 18:41:19'),
(92, 'Salernitana', 12, '2024-01-11 18:41:19', '2024-01-11 18:41:19'),
(93, 'Marseille', 15, '2024-01-11 18:41:22', '2024-01-11 18:41:22'),
(94, 'Rennes', 15, '2024-01-11 18:41:22', '2024-01-11 18:41:22'),
(95, 'PSG', 15, '2024-01-11 18:41:22', '2024-01-11 18:41:22'),
(96, 'Nice', 15, '2024-01-11 18:41:22', '2024-01-11 18:41:22'),
(97, 'Lille', 15, '2024-01-11 18:41:22', '2024-01-11 18:41:22'),
(98, 'Reims', 15, '2024-01-11 18:41:23', '2024-01-11 18:41:23'),
(99, 'Clermont', 15, '2024-01-11 18:41:23', '2024-01-11 18:41:23'),
(100, 'Toulouse', 15, '2024-01-11 18:41:23', '2024-01-11 18:41:23'),
(101, 'Le Havre', 15, '2024-01-11 18:41:23', '2024-01-11 18:41:23'),
(102, 'Lorient', 15, '2024-01-11 18:41:23', '2024-01-11 18:41:23'),
(103, 'Lyon', 15, '2024-01-11 18:41:23', '2024-01-11 18:41:23'),
(104, 'Monaco', 15, '2024-01-11 18:41:23', '2024-01-11 18:41:23'),
(105, 'Strasbourg', 15, '2024-01-11 18:41:23', '2024-01-11 18:41:23'),
(106, 'Montpellier', 15, '2024-01-11 18:41:24', '2024-01-11 18:41:24'),
(107, 'Nantes', 15, '2024-01-11 18:41:24', '2024-01-11 18:41:24'),
(108, 'Lens', 15, '2024-01-11 18:41:24', '2024-01-11 18:41:24'),
(109, 'Metz', 15, '2024-01-11 18:41:24', '2024-01-11 18:41:24'),
(110, 'Brest', 15, '2024-01-11 18:41:24', '2024-01-11 18:41:24'),
(111, 'Porto', 18, '2024-01-11 18:41:28', '2024-01-11 18:41:28'),
(112, 'Benfica', 18, '2024-01-11 18:41:28', '2024-01-11 18:41:28'),
(113, 'Sporting Braga', 18, '2024-01-11 18:41:28', '2024-01-11 18:41:28'),
(114, 'Sporting Lisbon', 18, '2024-01-11 18:41:28', '2024-01-11 18:41:28'),
(115, 'Rio Ave', 18, '2024-01-11 18:41:28', '2024-01-11 18:41:28'),
(116, 'Estrela', 18, '2024-01-11 18:41:28', '2024-01-11 18:41:28'),
(117, 'Estoril', 18, '2024-01-11 18:41:28', '2024-01-11 18:41:28'),
(118, 'Gil Vicente', 18, '2024-01-11 18:41:28', '2024-01-11 18:41:28'),
(119, 'Moreirense', 18, '2024-01-11 18:41:29', '2024-01-11 18:41:29'),
(120, 'Vitoria Guimaraes', 18, '2024-01-11 18:41:29', '2024-01-11 18:41:29'),
(121, 'Famalicão', 18, '2024-01-11 18:41:29', '2024-01-11 18:41:29'),
(122, 'Arouca', 18, '2024-01-11 18:41:29', '2024-01-11 18:41:29'),
(123, 'Vizela', 18, '2024-01-11 18:41:29', '2024-01-11 18:41:29'),
(124, 'Boavista', 18, '2024-01-11 18:41:29', '2024-01-11 18:41:29'),
(125, 'Casa Pia', 18, '2024-01-11 18:41:29', '2024-01-11 18:41:29'),
(126, 'Portimonense', 18, '2024-01-11 18:41:29', '2024-01-11 18:41:29'),
(127, 'Farense', 18, '2024-01-11 18:41:30', '2024-01-11 18:41:30'),
(128, 'Chaves', 18, '2024-01-11 18:41:30', '2024-01-11 18:41:30'),
(129, 'Club Brugge', 22, '2024-01-11 18:41:35', '2024-01-11 18:41:35'),
(130, 'Gent', 22, '2024-01-11 18:41:35', '2024-01-11 18:41:35'),
(131, 'Standard Liège', 22, '2024-01-11 18:41:35', '2024-01-11 18:41:35'),
(132, 'Antwerp', 22, '2024-01-11 18:41:35', '2024-01-11 18:41:35'),
(133, 'Sporting Charleroi', 22, '2024-01-11 18:41:35', '2024-01-11 18:41:35'),
(134, 'Genk', 22, '2024-01-11 18:41:35', '2024-01-11 18:41:35'),
(135, 'Anderlecht', 22, '2024-01-11 18:41:35', '2024-01-11 18:41:35'),
(136, 'OH Leuven', 22, '2024-01-11 18:41:36', '2024-01-11 18:41:36'),
(137, 'Mechelen', 22, '2024-01-11 18:41:36', '2024-01-11 18:41:36'),
(138, 'AS Eupen', 22, '2024-01-11 18:41:36', '2024-01-11 18:41:36'),
(139, 'Kortrijk', 22, '2024-01-11 18:41:36', '2024-01-11 18:41:36'),
(140, 'Sint-Truiden', 22, '2024-01-11 18:41:36', '2024-01-11 18:41:36'),
(141, 'Cercle Brugge', 22, '2024-01-11 18:41:36', '2024-01-11 18:41:36'),
(142, 'Union Saint-Gilloise', 22, '2024-01-11 18:41:37', '2024-01-11 18:41:37'),
(143, 'RWDM', 22, '2024-01-11 18:41:37', '2024-01-11 18:41:37'),
(144, 'Westerlo', 22, '2024-01-11 18:41:37', '2024-01-11 18:41:37'),
(145, 'Lokomotiv Moscow', 25, '2024-01-11 18:41:40', '2024-01-11 18:41:40'),
(146, 'Krasnodar', 25, '2024-01-11 18:41:41', '2024-01-11 18:41:41'),
(147, 'Zenit', 25, '2024-01-11 18:41:41', '2024-01-11 18:41:41'),
(148, 'CSKA Moscow', 25, '2024-01-11 18:41:41', '2024-01-11 18:41:41'),
(149, 'Rostov', 25, '2024-01-11 18:41:41', '2024-01-11 18:41:41'),
(150, 'Dinamo Moscow', 25, '2024-01-11 18:41:41', '2024-01-11 18:41:41'),
(151, 'Krylya Sovetov', 25, '2024-01-11 18:41:41', '2024-01-11 18:41:41'),
(152, 'Orenburg', 25, '2024-01-11 18:41:41', '2024-01-11 18:41:41'),
(153, 'Nizhny Novgorod', 25, '2024-01-11 18:41:41', '2024-01-11 18:41:41'),
(154, 'Baltika', 25, '2024-01-11 18:41:41', '2024-01-11 18:41:41'),
(155, 'Fakel', 25, '2024-01-11 18:41:42', '2024-01-11 18:41:42'),
(156, 'Spartak Moscow', 25, '2024-01-11 18:41:42', '2024-01-11 18:41:42'),
(157, 'Sochi', 25, '2024-01-11 18:41:42', '2024-01-11 18:41:42'),
(158, 'Akhmat Grozny', 25, '2024-01-11 18:41:42', '2024-01-11 18:41:42'),
(159, 'Ural', 25, '2024-01-11 18:41:42', '2024-01-11 18:41:42'),
(160, 'Rubin Kazan', 25, '2024-01-11 18:41:42', '2024-01-11 18:41:42'),
(161, 'Al Ahli', 28, '2024-01-11 18:41:46', '2024-01-11 18:41:46'),
(162, 'Al Wehda', 28, '2024-01-11 18:41:46', '2024-01-11 18:41:46'),
(163, 'Al Hilal', 28, '2024-01-11 18:41:46', '2024-01-11 18:41:46'),
(164, 'Al Taawon', 28, '2024-01-11 18:41:46', '2024-01-11 18:41:46'),
(165, 'Al Nassr', 28, '2024-01-11 18:41:46', '2024-01-11 18:41:46'),
(166, 'Al Hazm', 28, '2024-01-11 18:41:46', '2024-01-11 18:41:46'),
(167, 'Al Fayha', 28, '2024-01-11 18:41:46', '2024-01-11 18:41:46'),
(168, 'Al Tai', 28, '2024-01-11 18:41:46', '2024-01-11 18:41:46'),
(169, 'Al Khaleej', 28, '2024-01-11 18:41:46', '2024-01-11 18:41:46'),
(170, 'Al Shabab', 28, '2024-01-11 18:41:47', '2024-01-11 18:41:47'),
(171, 'Al Ittihad', 28, '2024-01-11 18:41:47', '2024-01-11 18:41:47'),
(172, 'Al Ittifaq', 28, '2024-01-11 18:41:47', '2024-01-11 18:41:47'),
(173, 'Al Fateh', 28, '2024-01-11 18:41:47', '2024-01-11 18:41:47'),
(174, 'Abha', 28, '2024-01-11 18:41:47', '2024-01-11 18:41:47'),
(175, 'Al Raed', 28, '2024-01-11 18:41:47', '2024-01-11 18:41:47'),
(176, 'Damak', 28, '2024-01-11 18:41:48', '2024-01-11 18:41:48'),
(177, 'Al Riyadh', 28, '2024-01-11 18:41:48', '2024-01-11 18:41:48'),
(178, 'Al Akhdoud', 28, '2024-01-11 18:41:48', '2024-01-11 18:41:48'),
(179, 'Istanbul Basaksehir', 31, '2024-01-11 18:41:51', '2024-01-11 18:41:51'),
(180, 'Sivasspor', 31, '2024-01-11 18:41:51', '2024-01-11 18:41:51'),
(181, 'Besiktas', 31, '2024-01-11 18:41:52', '2024-01-11 18:41:52'),
(182, 'Galatasaray', 31, '2024-01-11 18:41:52', '2024-01-11 18:41:52'),
(183, 'Pendikspor', 31, '2024-01-11 18:41:52', '2024-01-11 18:41:52'),
(184, 'Samsunspor', 31, '2024-01-11 18:41:52', '2024-01-11 18:41:52'),
(185, 'Adana Demirspor', 31, '2024-01-11 18:41:52', '2024-01-11 18:41:52'),
(186, 'İstanbulspor', 31, '2024-01-11 18:41:52', '2024-01-11 18:41:52'),
(187, 'Rizespor', 31, '2024-01-11 18:41:52', '2024-01-11 18:41:52'),
(188, 'Trabzonspor', 31, '2024-01-11 18:41:52', '2024-01-11 18:41:52'),
(189, 'Konyaspor', 31, '2024-01-11 18:41:53', '2024-01-11 18:41:53'),
(190, 'Kayserispor', 31, '2024-01-11 18:41:53', '2024-01-11 18:41:53'),
(191, 'Fenerbahce', 31, '2024-01-11 18:41:53', '2024-01-11 18:41:53'),
(192, 'Antalyaspor', 31, '2024-01-11 18:41:53', '2024-01-11 18:41:53'),
(193, 'Alanyaspor', 31, '2024-01-11 18:41:53', '2024-01-11 18:41:53'),
(194, 'Kasımpaşa', 31, '2024-01-11 18:41:53', '2024-01-11 18:41:53'),
(195, 'Gaziantep FK', 31, '2024-01-11 18:41:53', '2024-01-11 18:41:53'),
(196, 'Fatih Karagümrük', 31, '2024-01-11 18:41:54', '2024-01-11 18:41:54'),
(197, 'Hatayspor', 31, '2024-01-11 18:41:54', '2024-01-11 18:41:54'),
(198, 'Ankaragücü', 31, '2024-01-11 18:41:54', '2024-01-11 18:41:54'),
(199, 'Olympiakos', 35, '2024-01-11 18:41:57', '2024-01-11 18:41:57'),
(200, 'PAOK', 35, '2024-01-11 18:41:57', '2024-01-11 18:41:57'),
(201, 'AEK Athens', 35, '2024-01-11 18:41:57', '2024-01-11 18:41:57'),
(202, 'OFI', 35, '2024-01-11 18:41:57', '2024-01-11 18:41:57'),
(203, 'Aris', 35, '2024-01-11 18:41:57', '2024-01-11 18:41:57'),
(204, 'Panathinaikos', 35, '2024-01-11 18:41:57', '2024-01-11 18:41:57'),
(205, 'Asteras Tripolis', 35, '2024-01-11 18:41:58', '2024-01-11 18:41:58'),
(206, 'PAS Giannina', 35, '2024-01-11 18:41:58', '2024-01-11 18:41:58'),
(207, 'Volos NFC', 35, '2024-01-11 18:41:58', '2024-01-11 18:41:58'),
(208, 'Atromitos', 35, '2024-01-11 18:41:58', '2024-01-11 18:41:58'),
(209, 'Lamia', 35, '2024-01-11 18:41:58', '2024-01-11 18:41:58'),
(210, 'Panaitolikos', 35, '2024-01-11 18:41:58', '2024-01-11 18:41:58'),
(211, 'Kifisia', 35, '2024-01-11 18:41:59', '2024-01-11 18:41:59'),
(212, 'Panserraikos', 35, '2024-01-11 18:41:59', '2024-01-11 18:41:59'),
(213, 'Ajax', 37, '2024-01-11 18:42:02', '2024-01-11 18:42:02'),
(214, 'AZ', 37, '2024-01-11 18:42:02', '2024-01-11 18:42:02'),
(215, 'PSV', 37, '2024-01-11 18:42:02', '2024-01-11 18:42:02'),
(216, 'Feyenoord', 37, '2024-01-11 18:42:02', '2024-01-11 18:42:02'),
(217, 'Excelsior', 37, '2024-01-11 18:42:02', '2024-01-11 18:42:02'),
(218, 'Vitesse', 37, '2024-01-11 18:42:02', '2024-01-11 18:42:02'),
(219, 'Volendam', 37, '2024-01-11 18:42:03', '2024-01-11 18:42:03'),
(220, 'Heerenveen', 37, '2024-01-11 18:42:03', '2024-01-11 18:42:03'),
(221, 'Heracles', 37, '2024-01-11 18:42:04', '2024-01-11 18:42:04'),
(222, 'NEC', 37, '2024-01-11 18:42:05', '2024-01-11 18:42:05'),
(223, 'Fortuna Sittard', 37, '2024-01-11 18:42:05', '2024-01-11 18:42:05'),
(224, 'Go Ahead Eagles', 37, '2024-01-11 18:42:06', '2024-01-11 18:42:06'),
(225, 'Almere City', 37, '2024-01-11 18:42:06', '2024-01-11 18:42:06'),
(226, 'Twente', 37, '2024-01-11 18:42:07', '2024-01-11 18:42:07'),
(227, 'Utrecht', 37, '2024-01-11 18:42:07', '2024-01-11 18:42:07'),
(228, 'RKC Waalwijk', 37, '2024-01-11 18:42:07', '2024-01-11 18:42:07'),
(229, 'PEC Zwolle', 37, '2024-01-11 18:42:07', '2024-01-11 18:42:07'),
(230, 'Sparta Rotterdam', 37, '2024-01-11 18:42:07', '2024-01-11 18:42:07'),
(231, 'Bayern Munich', 40, '2024-01-11 18:42:11', '2024-01-11 18:42:11'),
(232, 'Borussia M\'gladbach', 40, '2024-01-11 18:42:11', '2024-01-11 18:42:11'),
(233, 'Borussia Dortmund', 40, '2024-01-11 18:42:11', '2024-01-11 18:42:11'),
(234, 'RB Leipzig', 40, '2024-01-11 18:42:11', '2024-01-11 18:42:11'),
(235, 'Bayer Leverkusen', 40, '2024-01-11 18:42:11', '2024-01-11 18:42:11'),
(236, 'Hoffenheim', 40, '2024-01-11 18:42:11', '2024-01-11 18:42:11'),
(237, 'Wolfsburg', 40, '2024-01-11 18:42:11', '2024-01-11 18:42:11'),
(238, 'Bochum', 40, '2024-01-11 18:42:12', '2024-01-11 18:42:12'),
(239, 'Heidenheim', 40, '2024-01-11 18:42:12', '2024-01-11 18:42:12'),
(240, 'Darmstadt', 40, '2024-01-11 18:42:12', '2024-01-11 18:42:12'),
(241, 'Werder Bremen', 40, '2024-01-11 18:42:12', '2024-01-11 18:42:12'),
(242, 'FC Cologne', 40, '2024-01-11 18:42:12', '2024-01-11 18:42:12'),
(243, 'Stuttgart', 40, '2024-01-11 18:42:12', '2024-01-11 18:42:12'),
(244, 'Augsburg', 40, '2024-01-11 18:42:12', '2024-01-11 18:42:12'),
(245, 'Union Berlin', 40, '2024-01-11 18:42:12', '2024-01-11 18:42:12'),
(246, 'Mainz', 40, '2024-01-11 18:42:13', '2024-01-11 18:42:13'),
(247, 'Eintracht Frankfurt', 40, '2024-01-11 18:42:13', '2024-01-11 18:42:13'),
(248, 'Freiburg', 40, '2024-01-11 18:42:13', '2024-01-11 18:42:13'),
(249, 'Cameroon', 41, '2024-01-16 22:26:25', '2024-01-16 22:26:25'),
(250, 'Tanzania', 41, '2024-01-16 22:26:26', '2024-01-16 22:26:26'),
(251, 'Namibia', 41, '2024-01-16 22:26:27', '2024-01-16 22:26:27'),
(252, 'Equatorial Guinea', 41, '2024-01-16 22:26:27', '2024-01-16 22:26:27'),
(253, 'Mozambique', 41, '2024-01-16 22:26:27', '2024-01-16 22:26:27'),
(254, 'Guinea-Bissau', 41, '2024-01-16 22:26:27', '2024-01-16 22:26:27'),
(255, 'Gambia', 41, '2024-01-16 22:26:27', '2024-01-16 22:26:27'),
(256, 'Egypt', 41, '2024-01-16 22:26:28', '2024-01-16 22:26:28'),
(257, 'Morocco', 41, '2024-01-16 22:26:28', '2024-01-16 22:26:28'),
(258, 'Nigeria', 41, '2024-01-16 22:26:28', '2024-01-16 22:26:28'),
(259, 'Tunisia', 41, '2024-01-16 22:26:28', '2024-01-16 22:26:28'),
(260, 'Senegal', 41, '2024-01-16 22:26:28', '2024-01-16 22:26:28'),
(261, 'Mali', 41, '2024-01-16 22:26:28', '2024-01-16 22:26:28'),
(262, 'Guinea', 41, '2024-01-16 22:26:28', '2024-01-16 22:26:28'),
(263, 'Burkina Faso', 41, '2024-01-16 22:26:28', '2024-01-16 22:26:28'),
(264, 'Ghana', 41, '2024-01-16 22:26:29', '2024-01-16 22:26:29'),
(265, 'South Africa', 41, '2024-01-16 22:26:29', '2024-01-16 22:26:29'),
(266, 'Congo DR', 41, '2024-01-16 22:26:29', '2024-01-16 22:26:29'),
(267, 'Angola', 41, '2024-01-16 22:26:29', '2024-01-16 22:26:29'),
(268, 'Mauritania', 41, '2024-01-16 22:26:29', '2024-01-16 22:26:29'),
(269, 'Cabo Verde', 41, '2024-01-16 22:26:29', '2024-01-16 22:26:29'),
(270, 'Algeria', 41, '2024-01-16 22:26:29', '2024-01-16 22:26:29'),
(271, 'Zambia', 41, '2024-01-16 22:26:29', '2024-01-16 22:26:29'),
(272, 'Côte d\'Ivoire', 41, '2024-01-16 22:26:29', '2024-01-16 22:26:29');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `competitions`
--
ALTER TABLE `competitions`
  ADD CONSTRAINT `competitions_ibfk_1` FOREIGN KEY (`league_id`) REFERENCES `leagues` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Contraintes pour la table `favorite_user`
--
ALTER TABLE `favorite_user`
  ADD CONSTRAINT `favorite_user_ibfk_1` FOREIGN KEY (`favorite_id`) REFERENCES `favorites` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `favorite_user_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `teams`
--
ALTER TABLE `teams`
  ADD CONSTRAINT `teams_ibfk_1` FOREIGN KEY (`competition_id`) REFERENCES `competitions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
