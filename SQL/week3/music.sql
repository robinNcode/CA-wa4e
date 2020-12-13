-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 15, 2020 at 12:50 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `music`
--

-- --------------------------------------------------------

--
-- Table structure for table `albums`
--

CREATE TABLE `albums` (
  `album_id` int(10) NOT NULL,
  `artist_id` int(10) NOT NULL,
  `title` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `albums`
--

INSERT INTO `albums` (`album_id`, `artist_id`, `title`) VALUES
(1, 3, 'SEI TUMI'),
(2, 2, 'Best Of Arijit Shingh'),
(3, 3, 'Best Of Tahsin Ahmed'),
(4, 1, 'Best Of Atif Aslam part-1'),
(5, 1, 'Best Of Atif Aslam part-2');

-- --------------------------------------------------------

--
-- Table structure for table `artists`
--

CREATE TABLE `artists` (
  `id` int(10) NOT NULL,
  `artist_id` int(10) NOT NULL,
  `artist_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `artists`
--

INSERT INTO `artists` (`id`, `artist_id`, `artist_name`) VALUES
(1, 1, 'Atif Aslam'),
(2, 2, 'Arijit Shingh'),
(3, 3, 'Tahsin Ahmed');

-- --------------------------------------------------------

--
-- Table structure for table `genres`
--

CREATE TABLE `genres` (
  `genre_id` int(10) NOT NULL,
  `name` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `genres`
--

INSERT INTO `genres` (`genre_id`, `name`) VALUES
(1, 'POP'),
(2, 'Classical'),
(3, 'HIP HOP'),
(4, 'RAP'),
(5, 'Sufi'),
(6, 'Gazal'),
(7, 'Vajan'),
(8, 'Flok'),
(9, 'Mordern Classic'),
(10, 'ROCK'),
(11, 'BASS'),
(12, 'SOFT Rock'),
(13, 'Jazz'),
(14, 'DANCE'),
(15, 'Heavy Metal'),
(16, 'Flat'),
(17, 'FX Booster'),
(18, 'Medium Rock'),
(19, 'Deep FLat'),
(20, 'Masups');

-- --------------------------------------------------------

--
-- Table structure for table `tracks`
--

CREATE TABLE `tracks` (
  `track_id` int(10) NOT NULL,
  `title` varchar(100) NOT NULL,
  `length` int(15) NOT NULL,
  `rating` int(5) NOT NULL,
  `count` int(5) NOT NULL,
  `album_id` int(10) NOT NULL,
  `genre_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tracks`
--

INSERT INTO `tracks` (`track_id`, `title`, `length`, `rating`, `count`, `album_id`, `genre_id`) VALUES
(1, 'Tere sang yaara', 240, 4, 0, 1, 3),
(2, 'Kher mangda', 345, 5, 0, 5, 18),
(3, 'Aj ei bristir kanna', 240, 4, 0, 1, 14),
(4, 'Shukriya', 240, 3, 0, 2, 7),
(5, 'Dil chahte ho', 212, 4, 0, 1, 19),
(6, 'Sei Tumi', 345, 4, 0, 1, 20),
(7, 'Bheegi Bheegi', 240, 5, 0, 3, 5),
(8, 'Shayad', 243, 5, 0, 3, 8),
(9, 'Shudho tomar jonno ekhon', 312, 5, 0, 1, 2),
(10, 'Ami tumar bikele', 173, 4, 0, 2, 6),
(11, 'Choto choto asha', 173, 3, 0, 3, 11),
(12, 'Jei deshe chena jana manush', 173, 4, 0, 2, 9),
(13, 'Tumi dure dure', 212, 5, 0, 1, 12),
(14, 'Ami taray taray rotiye dibo', 212, 4, 0, 4, 13),
(15, 'Onibarjo karone', 300, 5, 0, 5, 1),
(16, 'Dube Dube Valobashi', 305, 3, 0, 1, 17),
(17, 'Tu hi re', 240, 3, 0, 4, 4),
(18, 'Ae dil hain mushkil', 312, 3, 0, 1, 10),
(19, 'Channa meraya', 312, 5, 0, 5, 15),
(20, 'Chandro Grahon', 300, 4, 0, 3, 16);

--
-- Indexes for dumped tables
--



--
--Coursera Assignment query 
--

SELECT tracks.title, artists.artist_name, albums.title, genres.name FROM tracks JOIN albums
JOIN genres JOIN artists ON tracks.genre_id = genres.genre_id AND tracks.album_id = albums.album_id
AND albums.artist_id = artists.artist_id ORDER BY albums.title ASC;


--
-- Indexes for table `albums`
--
ALTER TABLE `albums`
  ADD PRIMARY KEY (`album_id`);

--
-- Indexes for table `artists`
--
ALTER TABLE `artists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`genre_id`);

--
-- Indexes for table `tracks`
--
ALTER TABLE `tracks`
  ADD PRIMARY KEY (`track_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `albums`
--
ALTER TABLE `albums`
  MODIFY `album_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `artists`
--
ALTER TABLE `artists`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `genres`
--
ALTER TABLE `genres`
  MODIFY `genre_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tracks`
--
ALTER TABLE `tracks`
  MODIFY `track_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
