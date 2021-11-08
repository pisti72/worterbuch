-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 02, 2020 at 07:35 AM
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
-- Table structure for table remotetimer_timers
--

CREATE TABLE remotetimer_timers (
  id int(11) NOT NULL,
  name varchar(100) NOT NULL,
  command varchar(20) NOT NULL,
  timestring varchar(30) NOT NULL,
  style varchar(512) NOT NULL,
  client varchar(100) NOT NULL,
  user_id int(11) NOT NULL,
  token varchar(20) NOT NULL,
  created_at datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table remotetimer_timers
--

INSERT INTO remotetimer_timers VALUES(1, 'Kocka', 'SETONEHOUR', '00:00:00', 'none;30%;1%;90%;rgba(0,0,0,0);digital2;22vw;#F00;11%', '', 2, 'P3LSCD9R4MWGACHC', '2019-10-14 12:52:02');
INSERT INTO remotetimer_timers VALUES(2, 'Alice', 'NOPE', '00:00:00', 'alice_rabbit_clock_600x480.jpg;30%;3%;90%;rgba(0,0,0,0.7);proclamate;16vw;#FFF;11%', '', 2, 'ALIZ4TSH9CK31LDF56', '2019-10-14 12:58:50');
INSERT INTO remotetimer_timers VALUES(3, 'Teszt p&aacute;lya', 'NOPE', '57:14:03', 'alice_rabbit_clock_600x480.jpg;30%;3%;90%;rgba(0,0,0,0.7);proclamate;16vw;#FFF;11%', '', 1, 'TESZT', '2019-10-14 12:58:50');
INSERT INTO remotetimer_timers VALUES(4, 'Balaton', 'NOPE', '00:00:00', 'books_600x400.jpg;30%;10%;80%;rgba(0,0,0,.5);proclamate;16vw;#eee;11%', '', 3, 'BOOK', '2019-10-14 12:58:50');
INSERT INTO remotetimer_timers VALUES(5, 'Kocka', 'NOPE', '55:41:50', 'none;30%;1%;90%;rgba(0,0,0,0);digital2;22vw;#F00;11%', '127.0.0.1', 1, 'KOCKA', '2019-10-14 12:58:50');
INSERT INTO remotetimer_timers VALUES(6, 'Alice', 'NOPE', '00:00:00', 'alice_rabbit_clock_600x480.jpg;30%;3%;90%;rgba(0,0,0,0.7);proclamate;16vw;#FFF;11%', '', 1, 'ALIZ', '2020-08-01 12:58:50');

--
-- Indexes for dumped tables
--

--
-- Indexes for table remotetimer_timers
--
ALTER TABLE remotetimer_timers
  ADD PRIMARY KEY (id);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table remotetimer_timers
--
ALTER TABLE remotetimer_timers
  MODIFY id int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
