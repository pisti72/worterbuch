INSERT INTO `dict_languages` (`id`, `name`, `small`) VALUES
(1, 'magyar', 'hu'),
(2, 'Deutsch', 'de'),
(3, 'English', 'en'),
(4, 'français', 'fr'),
(5, 'español', 'es'),
(6, 'polski', 'pl');

--

INSERT INTO `dict_users` (`id`, `name`, `email`, `password`, `token`, `created_at`) VALUES
(1, 'Szalontai Istvan', 'istvan.szalontai12@gmail.com', '83a571921264a65cf07b8c92c432ee69', '06bfed1c0c81d22525eaea7e17c0aec5', '2016-04-21 01:35:56');

--

INSERT INTO `dict_words` (`id`, `word`, `example`, `readonly`, `language_id`, `user_id`, `created_at`) VALUES
(15, 'lenni', 'JÃ³nak %% jÃ³.', 0, 1, 1, '2016-04-27 12:20:19'),
(4, 'gehe', 'Ich %% nach Hause.', 0, 2, 1, '2016-04-27 12:01:08'),
(5, 'majom', 'A %% eszi a banÃ¡nt', 1, 1, 1, '2016-04-22 10:12:45'),
(6, 'monkey', 'The %% eats banana.', 0, 3, 1, '2016-04-26 11:39:07'),
(7, 'hÃ¡z', 'A %% nagy.', 0, 1, 1, '2016-04-27 12:03:35'),
(8, 'Haus', 'Das %% ist groÃŸ.', 0, 2, 1, '2016-04-27 12:03:50'),
(9, 'House', 'The %% is big.', 0, 3, 1, '2016-04-27 12:03:42'),
(10, 'Maus', 'Das %% ist ein Tier.', 0, 2, 1, '2016-04-26 11:53:39'),
(11, 'MÃ¤use', 'Die %% sind grau.', 0, 2, 1, '2016-04-26 11:51:48'),
(12, 'egerek', 'Az %% szÃ¼rkÃ©k.', 0, 1, 1, '2016-04-26 11:50:10'),
(13, 'egÃ©r', 'Az %% az egy Ã¡llat.', 0, 1, 1, '2016-04-26 11:53:09'),
(14, 'megyek', 'Ã‰n haza %%.', 0, 1, 1, '2016-04-27 12:00:57'),
(16, 'sein', 'Gut, gut zu %%.', 0, 2, 1, '2016-04-27 12:21:50'),
(17, 'autÃ³', 'Az %% piros.', 0, 1, 1, '2016-04-27 12:50:02'),
(18, 'Auto', 'Das %% ist rot.', 0, 2, 1, '2016-04-27 12:50:46'),
(19, 'komme', 'Ich %%.', 0, 2, 1, '2016-05-04 10:38:30'),
(20, 'jÃ¶vÃ¶k', 'Ã‰n %%.', 0, 1, 1, '2016-05-04 10:39:13'),
(21, 'kommst', 'Wann %% du zurÃ¼ck?', 0, 2, 1, '2016-05-04 10:40:44'),
(22, 'jÃ¶ssz', 'Mikor %% vissza?', 0, 1, 1, '2016-05-04 10:41:09'),
(23, 'wohne', 'Ich %% in Budapest.', 0, 2, 1, '2016-05-05 03:13:43'),
(24, 'lakom', 'Ã‰n Budapesten %%.', 0, 1, 1, '2016-05-05 03:14:23'),
(25, 'wohnst', 'Du %% in KÅ‘ln.', 0, 2, 1, '2016-05-05 03:16:16'),
(26, 'laksz', 'Te KÃ¶lnben %%.', 0, 1, 1, '2016-05-05 03:16:39'),
(27, 'war', 'Gestern %% Donnerstag.', 0, 2, 1, '2016-05-05 03:18:58'),
(28, 'volt', 'Tegnap csÃ¼tÃ¶rtÃ¶k %%.', 0, 1, 1, '2016-05-05 03:19:37'),
(29, 'rufe', 'Ich %% dich an.', 0, 2, 1, '2016-05-05 03:31:44'),
(30, 'felhÃ­vlak', 'Ã‰n %% tÃ©ged,', 0, 1, 1, '2016-05-05 03:32:29');

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
(22, 30, 29, 1, '2016-05-05 03:32:41');