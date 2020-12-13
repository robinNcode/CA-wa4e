-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 14, 2020 at 04:12 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `coursera_sql`
--

-- --------------------------------------------------------

--
-- Table structure for table `Ages`
--

DROP TABLE Ages;

CREATE TABLE `Ages` (
  name VARCHAR(128),
  age INTEGER
)

--
--Inserting data into table `Ages`
--

DELETE FROM Ages;
INSERT INTO Ages (name, age) VALUES ('Alleisha', 31);
INSERT INTO Ages (name, age) VALUES ('Zella', 40);
INSERT INTO Ages (name, age) VALUES ('Capri', 29);
INSERT INTO Ages (name, age) VALUES ('Nabeel', 32);
INSERT INTO Ages (name, age) VALUES ('Skye', 28);
INSERT INTO Ages (name, age) VALUES ('Shwetika', 34);


SELECT sha1(CONCAT(name,age)) AS X FROM Ages ORDER BY X