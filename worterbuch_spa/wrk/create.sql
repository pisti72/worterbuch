CREATE TABLE  `rgxghx`.`dict_users` (
`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`name` VARCHAR( 64 ) NOT NULL ,
`email` VARCHAR( 64 ) NOT NULL ,
`password` VARCHAR( 32 ) NOT NULL ,
`token` VARCHAR( 32 ) NOT NULL ,
`created_at` DATETIME NOT NULL
) ENGINE = MYISAM CHARACTER SET utf8 COLLATE utf8_general_ci;
  
--

CREATE TABLE `rgxghx`.`dict_words` (
  `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
  `word` varchar(96) NOT NULL,
  `example` varchar(1024) NOT NULL,
  `readonly` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=MyISAM CHARACTER SET utf8 COLLATE utf8_general_ci;


--

CREATE TABLE `rgxghx`.`dict_languages` (
  `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
  `name` varchar(32) NOT NULL,
  `small` varchar(3) NOT NULL
) ENGINE=MyISAM CHARACTER SET utf8 COLLATE utf8_general_ci;

--
--
--
--




  
INSERT INTO `dict_languages` (`id`, `name`, `small`) VALUES 
  (1, 'magyar', 'hu'), 
  (2, 'Deutsch', 'de'), 
  (3, 'English', 'en'), 
  (4, 'français', 'fr'),
  (5, 'español', 'es'), 
  (6, 'polski', 'pl');
  
--

CREATE TABLE `rgxghx`.`dict_pairs` (
  `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
  `word1_id` int(11) NOT NULL,
  `word2_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=MyISAM CHARACTER SET utf8 COLLATE utf8_general_ci;

--

CREATE TABLE `rgxghx`.`dict_statistic` (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
    `user_id` INT NOT NULL ,
    `word_id` INT NOT NULL ,
    `slot1` INT NULL ,
    `slot2` INT NULL ,
    `slot3` INT NULL ,
    `slot4` INT NULL
) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci;
  
--
--
--
--
-- www.worterbuch.tk
--

CREATE TABLE  `991349`.`dict_users` (
`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`name` VARCHAR( 64 ) NOT NULL ,
`email` VARCHAR( 64 ) NOT NULL ,
`password` VARCHAR( 32 ) NOT NULL ,
`token` VARCHAR( 32 ) NOT NULL ,
`created_at` DATETIME NOT NULL
) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci;

CREATE TABLE `991349`.`dict_words` (
  `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
  `word` varchar(96) NOT NULL,
  `example` varchar(1024) NOT NULL,
  `readonly` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci;

CREATE TABLE `991349`.`dict_pairs` (
  `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
  `word1_id` int(11) NOT NULL,
  `word2_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci;

CREATE TABLE `991349`.`dict_statistic` (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
    `user_id` INT NOT NULL ,
    `word_id` INT NOT NULL ,
    `slot1` INT NULL ,
    `slot2` INT NULL ,
    `slot3` INT NULL ,
    `slot4` INT NULL
) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci;

