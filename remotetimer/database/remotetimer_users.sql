-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 02, 2020 at 07:34 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: remotetimer
--

-- --------------------------------------------------------

--
-- Table structure for table remotetimer_users
--

CREATE TABLE remotetimer_users (
  id int(11) NOT NULL,
  name varchar(64) NOT NULL,
  password varchar(64) NOT NULL,
  email varchar(64) NOT NULL,
  token varchar(64) NOT NULL,
  created_at datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table remotetimer_users
--

INSERT INTO remotetimer_users VALUES(1, 'Teszt Elek', '81dc9bdb52d04dc20036dbd8313ed055', 'istvan.szalontai12@gmail.com', 'd109220c50de4888', '2019-11-12 13:19:58');
INSERT INTO remotetimer_users VALUES(2, 'Mystique', '81dc9bdb52d04dc20036dbd8313ed055', 'szalontaymark@gmail.com', '0dd19440af641744', '2019-11-13 14:47:15');
INSERT INTO remotetimer_users VALUES(3, 'Muzeum', '81dc9bdb52d04dc20036dbd8313ed055', 'istvan.szalontai12@gmail.com', '744d8e9cf47ecb4c', '2020-08-01 11:17:28');

--
-- Indexes for dumped tables
--

--
-- Indexes for table remotetimer_users
--
ALTER TABLE remotetimer_users
  ADD PRIMARY KEY (id);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table remotetimer_users
--
ALTER TABLE remotetimer_users
  MODIFY id int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
