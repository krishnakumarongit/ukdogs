-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 19, 2020 at 04:39 AM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.2.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dogscart`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`id`, `name`) VALUES
(1, 'Aberdare'),
(2, ' Aberdeen'),
(3, ' Angus'),
(4, ' Antrim'),
(5, ' Argyll and Bute'),
(6, ' Armagh'),
(7, ' Ashford'),
(8, ' Avon'),
(9, ' Aylesbury'),
(10, ' Ayr'),
(11, ' Bangor'),
(12, ' Barnsley'),
(13, ' Barry'),
(14, ' Bath'),
(15, ' Bedford'),
(16, ' Belfast'),
(17, ' Bexhill-on-Sea'),
(18, ' Birmingham'),
(19, ' Blackburn'),
(20, ' Blackpool'),
(21, ' Blackwood'),
(22, ' Bognor Regis'),
(23, ' Bolton'),
(24, ' Borders'),
(25, ' Bournemouth'),
(26, ' Bradford'),
(27, ' Bridgend'),
(28, ' Brighton'),
(29, ' Bristol'),
(30, ' Bromley'),
(31, ' Buckingham'),
(32, ' Caerphilly'),
(33, ' Cambridge'),
(34, ' Canterbury'),
(35, ' Cardiff'),
(36, ' Carlisle'),
(37, ' Ceredigion'),
(38, ' Chelmsford'),
(39, ' Cheltenham'),
(40, ' Chester'),
(41, ' Clackmannan'),
(42, ' Cleveland'),
(43, ' Chichester'),
(44, ' Colchester'),
(45, ' Colwyn Bay'),
(46, ' Conwy'),
(47, ' Cornwall'),
(48, ' Coventry'),
(49, ' Crawley'),
(50, ' Crewe'),
(51, ' Croydon'),
(52, ' Cumbernauld'),
(53, ' Cumbria'),
(54, ' Cwmbran'),
(55, ' Darlington'),
(56, ' Dartford'),
(57, ' Derby'),
(58, ' Devon'),
(59, ' Doncaster'),
(60, ' Dorchester'),
(61, ' Dorset'),
(62, ' Dudley'),
(63, ' Dumfries'),
(64, ' Dundee'),
(65, ' Durham'),
(66, ' East Riding'),
(67, ' East Sussex'),
(68, ' Eastbourne'),
(69, ' Edinburgh'),
(70, ' Essex'),
(71, ' Exeter'),
(72, ' Falkirk'),
(73, ' Fife'),
(74, ' Galashiels'),
(75, ' Glasgow'),
(76, ' Gloucester'),
(77, ' Guildford'),
(78, ' Gwynedd'),
(79, ' Halifax'),
(80, ' Hamilton'),
(81, ' Hampshire'),
(82, ' Harrogate'),
(83, ' Harrow'),
(84, ' Hastings'),
(85, ' Haywards Heath'),
(86, ' Hemel Hempstead'),
(87, ' Hereford'),
(88, ' Hertfordshire'),
(89, ' Highland'),
(90, ' Horsham'),
(91, ' Hove'),
(92, ' Huddersfield'),
(93, ' Hull'),
(94, ' Humberside'),
(95, ' Ilford'),
(96, ' Inverness'),
(97, ' Ipswich'),
(98, ' Isle of Anglesey'),
(99, ' Isle of Wight'),
(100, ' Isle of Scilly'),
(101, ' Kent'),
(102, ' '),
(103, ' Kingston upon Hull'),
(104, ' Kingston upon Thames'),
(105, ' Kirkcaldy'),
(106, ' Kirkwall'),
(107, ' Lancaster'),
(108, ' Leeds'),
(109, ' Lerwick'),
(110, ' Leicester'),
(111, ' Lincoln'),
(112, ' Littlehampton'),
(113, ' Liverpool'),
(114, ' Livingston'),
(115, ' Llandrindod Wells'),
(116, ' Llandudno'),
(117, ' Llanelli'),
(118, ' London'),
(119, ' Luton'),
(120, ' Maesteg'),
(121, ' Maidstone'),
(122, ' Manchester'),
(123, ' Mansfield'),
(124, ' Medway'),
(125, ' Merthyr Tydfil'),
(126, ' Middlesbrough'),
(127, ' Middlesex'),
(128, ' Midlothian'),
(129, ' Milton Keynes'),
(130, ' Moray'),
(131, ' Motherwell'),
(132, ' Neath'),
(133, ' Newcastle'),
(134, ' Newport'),
(135, ' Northampton'),
(136, ' Norwich'),
(137, ' Nottingham'),
(138, ' Oldham'),
(139, ' Orkney'),
(140, ' Oxford'),
(141, ' Paisley'),
(142, ' Penarth'),
(143, ' Perth'),
(144, ' Peterborough'),
(145, ' Plymouth'),
(146, ' Poole'),
(147, ' Portsmouth'),
(148, ' Preston'),
(149, ' Reading'),
(150, ' Redhill'),
(151, ' Richmond'),
(152, ' Ripon'),
(153, ' Romford'),
(154, ' Rotherham'),
(155, ' Rutland'),
(156, ' Salisbury'),
(157, ' Seaford'),
(158, ' Sheffield'),
(159, ' Shrewsbury'),
(160, ' Slough'),
(161, ' Solihull'),
(162, ' Southall'),
(163, ' Southampton'),
(164, ' Southall'),
(165, ' Southend'),
(166, ' St Albans'),
(167, ' Sheffield'),
(168, ' St Leonards on Sea'),
(169, ' Stevenage'),
(170, ' Stirling'),
(171, ' Stockport'),
(172, ' Stoke on Trent'),
(173, ' Suffolk'),
(174, ' Sunderland'),
(175, ' Surrey'),
(176, ' Swansea'),
(177, ' Sutton'),
(178, ' Swindon'),
(179, ' Taunton'),
(180, ' Telford'),
(181, ' Torquay'),
(182, ' Truro'),
(183, ' Tunbridge Wells'),
(184, ' Uckfield'),
(185, ' Wakefield'),
(186, ' Walsall'),
(187, ' Warrington'),
(188, ' Watford'),
(189, ' Weston Super Mare'),
(190, ' Wigan'),
(191, ' Wolverhampton'),
(192, ' Worcester'),
(193, ' Worthing'),
(194, ' York');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('mekrishnakumarkk@gmail.com', '$2y$10$pnUDrNyYjqoLS05LIOuxg.SNJdS1ym6toId3ovZa8lNf2hnkPLQgG', '2019-12-29 06:20:54');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `email_verified` int(11) NOT NULL DEFAULT 0,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `regtype` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `about_me` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `main_telephone_number` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `secondary_telephone_number` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `email_verified`, `token`, `password_token`, `regtype`, `website_address`, `about_me`, `location`, `main_telephone_number`, `secondary_telephone_number`, `photo`) VALUES
(6, 'krishna kumar', 'mekrishnakumarkk1@gmail.com', '2020-01-05 00:41:39', '$2y$10$xSgIDfWLwMJzRRmNx05yX.OMmvOw6jLMixPxQNzw9RQcRAjhTCuoa', NULL, '2020-01-04 22:46:48', '2020-01-05 00:41:39', 1, '', NULL, 'website', NULL, NULL, NULL, NULL, NULL, NULL),
(7, 'krishna kumar', 'mekrishnakujmarkk@gmail.com', NULL, '$2y$10$hwgZGcRkavZAFU.TgNqEaOd3Hp.UC0kTU2Ve.uN3VvHCh.WxjrLXa', NULL, '2020-01-05 01:07:31', '2020-01-05 01:07:31', 0, 'ab46f04b-7a93-42e3-9289-2cb4c6e34630', NULL, 'website', NULL, NULL, NULL, NULL, NULL, NULL),
(8, 'dsgsfjgfjgf', 'mekrishnakumarkk@gmail.com', '2020-01-12 10:17:57', '$2y$10$Lsza5Wxu2lio4ePsJNiFceROVBII.YwnbB4h8X8omGLmHxMLK3YEm', 'PFqwyjUYA1hCA5OHmtGbSGCsABXz96KW3bXYcKHgqjPVKUBOxqc2u1DsF6Qi', '2020-01-18 07:20:43', '2020-01-18 22:07:17', 0, '', '2099156e-9baf-4f89-beaf-75e3c3b29806', 'website', 'http://localhost.com', 'sxfsdgfgs dsgtytru tutyityitu yityiuyoy yiyuouyoy rtutyituouy tyruytuityit', 'Aberdare', '1234567898', '21234567891', '20-01-19-1579405037.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `user_attempts`
--

CREATE TABLE `user_attempts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `type` varchar(255) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_attempts`
--

INSERT INTO `user_attempts` (`id`, `user_id`, `date`, `type`, `updated_at`, `created_at`, `email`) VALUES
(1, 8, '2020-01-12', 'email_change', '2020-01-12 04:46:39', '2020-01-12 04:46:39', NULL),
(2, 8, '2020-01-12', 'resend_emalil_link', '2020-01-12 10:09:48', '2020-01-12 10:09:48', NULL),
(3, 8, '2020-01-18', 'forgot_password', '2020-01-18 07:20:44', '2020-01-18 07:20:44', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_attempts`
--
ALTER TABLE `user_attempts`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=195;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user_attempts`
--
ALTER TABLE `user_attempts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
