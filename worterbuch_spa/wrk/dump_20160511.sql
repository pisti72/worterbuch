-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Hoszt: 127.0.0.1
-- Létrehozás ideje: 2016. máj. 11. 14:07
-- Szerver verzió: 5.0.45
-- PHP verzió: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Adatbázis: `rgxghx`
--

--
-- A tábla adatainak kiíratása `dict_pairs`
--

INSERT INTO `dict_pairs` (`id`, `word1_id`, `word2_id`, `user_id`, `created_at`) VALUES
(9, 10, 13, 1, '2016-04-26 11:52:09'),
(8, 12, 11, 1, '2016-04-26 11:49:23'),
(7, 5, 6, 1, '2016-04-26 11:46:40'),
(10, 4, 14, 1, '2016-04-27 12:01:18'),
(11, 7, 9, 1, '2016-04-27 12:04:06'),
(12, 7, 8, 1, '2016-04-27 12:04:16'),
(13, 9, 8, 1, '2016-04-27 12:06:06'),
(14, 15, 16, 1, '2016-04-27 12:22:04'),
(15, 17, 18, 1, '2016-04-27 12:52:08'),
(17, 20, 19, 1, '2016-05-04 10:39:28'),
(18, 21, 22, 1, '2016-05-04 10:41:24'),
(19, 24, 23, 1, '2016-05-05 03:14:36'),
(20, 26, 25, 1, '2016-05-05 03:17:24'),
(21, 28, 27, 1, '2016-05-05 03:20:17'),
(22, 30, 29, 1, '2016-05-05 03:32:41'),
(23, 31, 14, 1, '2016-05-07 08:41:33'),
(24, 4, 31, 1, '2016-05-07 08:42:09'),
(25, 33, 32, 1, '2016-05-07 09:59:48'),
(28, 35, 34, 1, '2016-05-09 07:19:25'),
(29, 37, 36, 1, '2016-05-09 07:23:28'),
(30, 39, 38, 1, '2016-05-09 07:26:04'),
(31, 41, 40, 1, '2016-05-09 07:30:37'),
(32, 43, 42, 1, '2016-05-09 07:34:56'),
(33, 44, 45, 1, '2016-05-10 06:21:40'),
(34, 46, 47, 1, '2016-05-11 08:55:05'),
(35, 48, 49, 1, '2016-05-11 08:59:40'),
(36, 50, 51, 1, '2016-05-11 09:00:58'),
(37, 52, 53, 1, '2016-05-11 09:03:03'),
(38, 55, 54, 1, '2016-05-11 09:05:06'),
(39, 57, 56, 1, '2016-05-11 09:07:19'),
(40, 58, 59, 1, '2016-05-11 09:08:49'),
(41, 61, 60, 1, '2016-05-11 09:10:19'),
(42, 63, 62, 1, '2016-05-11 09:12:14'),
(43, 65, 64, 1, '2016-05-11 10:58:18'),
(44, 67, 66, 1, '2016-05-11 11:01:11'),
(45, 69, 68, 1, '2016-05-11 12:33:25'),
(46, 70, 71, 1, '2016-05-11 12:35:56'),
(47, 73, 72, 1, '2016-05-11 12:38:47');

--
-- A tábla adatainak kiíratása `dict_statistic`
--

INSERT INTO `dict_statistic` (`id`, `user_id`, `word_id`, `slot1`, `slot2`, `slot3`, `slot4`) VALUES
(1, 1, 4, 31, NULL, NULL, NULL),
(2, 1, 14, 16, NULL, NULL, NULL),
(3, 1, 31, 4, NULL, NULL, NULL),
(4, 1, 32, 6, NULL, NULL, NULL),
(5, 1, 33, 6, NULL, NULL, NULL),
(6, 1, 26, 1, NULL, NULL, NULL),
(7, 1, 27, 3, NULL, NULL, NULL),
(8, 1, 35, 5, NULL, NULL, NULL),
(9, 1, 37, 4, NULL, NULL, NULL),
(10, 1, 36, 2, NULL, NULL, NULL),
(11, 1, 38, 3, NULL, NULL, NULL),
(12, 1, 39, 5, NULL, NULL, NULL),
(13, 1, 41, 5, NULL, NULL, NULL),
(14, 1, 43, 5, NULL, NULL, NULL),
(15, 1, 40, 2, NULL, NULL, NULL),
(16, 1, 42, 4, NULL, NULL, NULL),
(17, 1, 17, 1, NULL, NULL, NULL),
(18, 1, 18, 2, NULL, NULL, NULL),
(19, 1, 44, 3, NULL, NULL, NULL),
(20, 1, 45, 6, NULL, NULL, NULL),
(21, 1, 46, 2, NULL, NULL, NULL),
(22, 1, 47, 1, NULL, NULL, NULL),
(23, 1, 48, 11, NULL, NULL, NULL),
(24, 1, 50, 3, NULL, NULL, NULL),
(25, 1, 52, 6, NULL, NULL, NULL),
(26, 1, 13, 2, NULL, NULL, NULL),
(27, 1, 55, 4, NULL, NULL, NULL),
(28, 1, 57, 4, NULL, NULL, NULL),
(29, 1, 56, 2, NULL, NULL, NULL),
(30, 1, 58, 2, NULL, NULL, NULL),
(31, 1, 61, 4, NULL, NULL, NULL),
(32, 1, 60, 1, NULL, NULL, NULL),
(33, 1, 15, 3, NULL, NULL, NULL),
(34, 1, 63, 6, NULL, NULL, NULL),
(35, 1, 53, 1, NULL, NULL, NULL),
(36, 1, 65, 2, NULL, NULL, NULL),
(37, 1, 64, 2, NULL, NULL, NULL),
(38, 1, 67, 3, NULL, NULL, NULL),
(39, 1, 66, 4, NULL, NULL, NULL),
(40, 1, 69, 24, NULL, NULL, NULL),
(41, 1, 68, 1, NULL, NULL, NULL),
(42, 1, 49, 1, NULL, NULL, NULL),
(43, 1, 6, 1, NULL, NULL, NULL),
(44, 1, 70, 3, NULL, NULL, NULL),
(45, 1, 28, 1, NULL, NULL, NULL),
(46, 1, 73, 20, NULL, NULL, NULL),
(47, 1, 7, 1, NULL, NULL, NULL),
(48, 1, 54, 1, NULL, NULL, NULL),
(49, 1, 12, 1, NULL, NULL, NULL),
(50, 1, 8, 1, NULL, NULL, NULL);

--
-- A tábla adatainak kiíratása `dict_users`
--

INSERT INTO `dict_users` (`id`, `name`, `email`, `password`, `token`, `created_at`) VALUES
(1, 'Szalontai Istvan', 'istvan.szalontai12@gmail.com', '83a571921264a65cf07b8c92c432ee69', '06bfed1c0c81d22525eaea7e17c0aec5', '2016-04-21 01:35:56');

--
-- A tábla adatainak kiíratása `dict_words`
--

INSERT INTO `dict_words` (`id`, `word`, `example`, `readonly`, `language_id`, `user_id`, `created_at`) VALUES
(15, 'lenni', 'Jónak %% jó.', 0, 1, 1, '2016-05-11 01:55:11'),
(4, 'gehe', 'Ich %% nach Hause.', 1, 2, 1, '2016-04-27 12:01:08'),
(5, 'majom', 'A %% eszi a banánt', 1, 1, 1, '2016-04-22 10:12:45'),
(6, 'monkey', 'The %% eats banana.', 0, 3, 1, '2016-04-26 11:39:07'),
(7, 'ház', 'A %% nagy.', 0, 1, 1, '2016-05-11 01:43:27'),
(8, 'Haus', 'Das %% ist groß.', 0, 2, 1, '2016-05-11 01:56:05'),
(9, 'House', 'The %% is big.', 0, 3, 1, '2016-04-27 12:03:42'),
(10, 'Maus', 'Das %% ist ein Tier.', 0, 2, 1, '2016-04-26 11:53:39'),
(11, 'Mäuse', 'Die %% sind grau.', 0, 2, 1, '2016-04-26 11:51:48'),
(12, 'egerek', 'Az %% szürkék.', 0, 1, 1, '2016-05-11 01:47:46'),
(13, 'egér', 'Az %% az egy állat.', 0, 1, 1, '2016-05-11 01:44:08'),
(14, 'megyek', 'Én haza %%.', 0, 1, 1, '2016-05-11 01:56:35'),
(16, 'sein', 'Gut, gut zu %%.', 0, 2, 1, '2016-04-27 12:21:50'),
(17, 'autó', 'Az %% piros.', 1, 1, 1, '2016-04-27 12:50:02'),
(18, 'Auto', 'Das %% ist rot.', 1, 2, 1, '2016-04-27 12:50:46'),
(19, 'komme', 'Ich %%.', 0, 2, 1, '2016-05-04 10:38:30'),
(20, 'jövök', 'Én %%.', 0, 1, 1, '2016-05-04 10:39:13'),
(21, 'kommst', 'Wann %% du zurÃ¼ck?', 0, 2, 1, '2016-05-04 10:40:44'),
(22, 'jössz', 'Mikor %% vissza?', 0, 1, 1, '2016-05-04 10:41:09'),
(23, 'wohne', 'Ich %% in Budapest.', 0, 2, 1, '2016-05-05 03:13:43'),
(24, 'lakom', 'Én Budapesten %%.', 0, 1, 1, '2016-05-05 03:14:23'),
(25, 'wohnst', 'Du %% in Köln.', 0, 2, 1, '2016-05-05 03:16:16'),
(26, 'laksz', 'Te Kölnben %%.', 0, 1, 1, '2016-05-05 03:16:39'),
(27, 'war', 'Gestern %% Donnerstag.', 0, 2, 1, '2016-05-05 03:18:58'),
(28, 'volt', 'Tegnap csütörtök %%.', 0, 1, 1, '2016-05-05 03:19:37'),
(29, 'rufe', 'Ich %% dich an.', 0, 2, 1, '2016-05-05 03:31:44'),
(30, 'felhívlak', 'Én %% téged,', 0, 1, 1, '2016-05-05 03:32:29'),
(31, 'go', 'I %% to home.', 0, 3, 1, '2016-05-07 08:41:04'),
(32, 'kaufe', 'Ich %% ein Buch.', 0, 2, 1, '2016-05-07 09:59:01'),
(33, 'veszek', 'Én %% egy könyvet.', 0, 1, 1, '2016-05-07 09:59:31'),
(34, 'Wartezimmer', 'Bitte gehen Sie noch einen Moment in das %%!', 0, 2, 1, '2016-05-09 07:17:26'),
(35, 'váróterem', 'Kérem, menjen be egy pillanatra a %%be!', 0, 1, 1, '2016-05-09 07:19:04'),
(36, 'Tag', 'Guten %%!', 0, 2, 1, '2016-05-09 07:22:31'),
(37, 'napot', 'Jó %%!', 0, 1, 1, '2016-05-09 07:23:03'),
(38, 'Abend', 'Guten %%!', 0, 2, 1, '2016-05-09 07:24:40'),
(39, 'estét', 'Jó %%!', 0, 1, 1, '2016-05-09 07:25:38'),
(40, 'Getränke', 'Wo finde ich die %%?', 1, 2, 1, '2016-05-09 07:29:17'),
(41, 'italokat', 'Hol találom az %%?', 0, 1, 1, '2016-05-09 07:30:20'),
(42, 'beantwortet', 'Ich habe alle Fragen %%.', 0, 2, 1, '2016-05-09 07:33:12'),
(43, 'megválaszoltam', 'Az összes kérdést %%.', 1, 1, 1, '2016-05-09 07:34:28'),
(44, 'liebt', 'Jeder %% zu spielen.', 0, 2, 1, '2016-05-10 06:20:16'),
(45, 'szeret', 'Mindenki %% jÃ¡tszani.', 0, 1, 1, '2016-05-10 06:21:03'),
(46, 'Vater', 'Der gute %% spielt mit ihrem Sohn.', 0, 2, 1, '2016-05-11 08:54:17'),
(47, 'apa', 'A jÃ³ %% jÃ¡tszik a gyerekÃ©vel.', 0, 1, 1, '2016-05-11 08:54:50'),
(48, 'gut', 'Es ist %% hier.', 0, 2, 1, '2016-05-11 08:59:07'),
(49, 'Jó', '%% itt.', 0, 1, 1, '2016-05-11 08:59:29'),
(50, 'fontos', 'Ez most nagyon %%.', 0, 1, 1, '2016-05-11 09:00:12'),
(51, 'wichtig', 'Das ist sehr %% jetzt.', 0, 2, 1, '2016-05-11 09:00:43'),
(52, 'immer', 'Das ist %% hier.', 0, 2, 1, '2016-05-11 09:01:48'),
(53, 'mindig', 'Ez %% itt van.', 0, 1, 1, '2016-05-11 09:02:29'),
(54, 'egészen', 'Már %% közel van.', 0, 1, 1, '2016-05-11 01:47:33'),
(55, 'ganz', 'Das ist schon %% nah.', 0, 2, 1, '2016-05-11 09:04:38'),
(56, 'még', 'Tegnap %% itt volt.', 0, 1, 1, '2016-05-11 01:48:49'),
(57, 'noch', 'Das war %% hier gestern.', 0, 2, 1, '2016-05-11 09:06:59'),
(58, 'talán', 'Ez volt %% a legjobb.', 0, 1, 1, '2016-05-11 09:07:56'),
(59, 'vielleicht', 'Das war %% das beste.', 0, 2, 1, '2016-05-11 09:08:38'),
(60, 'jobb', 'Ez %%.', 0, 1, 1, '2016-05-11 09:09:50'),
(61, 'besser', 'Das ist %%.', 0, 2, 1, '2016-05-11 09:10:10'),
(62, 'lehetséges', 'Minden %%.', 0, 1, 1, '2016-05-11 09:11:44'),
(63, 'möglich', 'Alles ist %%.', 0, 2, 1, '2016-05-11 09:12:02'),
(64, 'verliebt', 'Ich bin so %%.', 0, 2, 1, '2016-05-11 10:58:44'),
(65, 'szerelmes', 'Annyira %% vagyok.', 0, 1, 1, '2016-05-11 10:58:08'),
(66, 'otthon', 'Pál már %% van.', 1, 1, 1, '2016-05-11 11:00:09'),
(67, 'zu Hause', 'Paul ist schon %%.', 1, 2, 1, '2016-05-11 11:00:59'),
(68, 'eben', 'Sie war %% allein.', 0, 2, 1, '2016-05-11 12:31:52'),
(69, 'Éppen', '%% egyedül volt.', 0, 1, 1, '2016-05-11 01:54:26'),
(70, 'reggelt', 'Jó %%!', 0, 1, 1, '2016-05-11 12:35:22'),
(71, 'Morgen', 'Guten %%!', 0, 2, 1, '2016-05-11 12:35:43'),
(72, 'Vorhang', 'Es ist einer hellere %%.', 0, 2, 1, '2016-05-11 12:38:11'),
(73, 'függöny', 'Ez egy világosabb %%.', 0, 1, 1, '2016-05-11 12:38:33');
