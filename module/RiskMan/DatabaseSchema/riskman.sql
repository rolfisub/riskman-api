-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 28, 2017 at 06:59 PM
-- Server version: 5.7.16-0ubuntu0.16.04.1
-- PHP Version: 7.0.8-0ubuntu0.16.04.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `riskman`
--
CREATE DATABASE IF NOT EXISTS `riskman` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `riskman`;

-- --------------------------------------------------------

--
-- Table structure for table `apilog`
--

CREATE TABLE `apilog` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `ip_address` varchar(32) NOT NULL,
  `service_name` text NOT NULL,
  `url` varchar(255) NOT NULL,
  `http_method` varchar(32) NOT NULL,
  `http_code` int(11) NOT NULL,
  `http_header` text NOT NULL,
  `http_message` text NOT NULL,
  `received_data` text NOT NULL,
  `sent_data` text NOT NULL,
  `datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `id` int(11) NOT NULL,
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `id` int(11) NOT NULL,
  `event_id` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `datetime` datetime DEFAULT NULL,
  `sport_id` int(11) DEFAULT NULL,
  `league_id` int(11) DEFAULT NULL,
  `region_id` int(11) DEFAULT NULL,
  `book_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `league`
--

CREATE TABLE `league` (
  `id` int(11) NOT NULL,
  `league_id` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `book_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `multiple`
--

CREATE TABLE `multiple` (
  `id` int(11) NOT NULL,
  `multiple_id` varchar(32) NOT NULL,
  `risk` float NOT NULL,
  `win` float NOT NULL,
  `book_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `multipleselection`
--

CREATE TABLE `multipleselection` (
  `id` int(11) NOT NULL,
  `multiple_selection_id` varchar(32) NOT NULL,
  `event_id` int(11) NOT NULL,
  `odd_id` int(11) NOT NULL,
  `odd_selection_id` int(11) NOT NULL,
  `odd` float NOT NULL,
  `points` float NOT NULL,
  `book_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `odd`
--

CREATE TABLE `odd` (
  `id` int(11) NOT NULL,
  `odd_id` varchar(32) NOT NULL,
  `name` varchar(128) DEFAULT NULL,
  `event_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `oddselection`
--

CREATE TABLE `oddselection` (
  `id` int(11) NOT NULL,
  `odd_selection_id` varchar(32) NOT NULL,
  `name` varchar(128) DEFAULT NULL,
  `odd_id` int(11) NOT NULL,
  `odd` double NOT NULL,
  `points` double DEFAULT NULL,
  `book_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `region`
--

CREATE TABLE `region` (
  `id` int(11) NOT NULL,
  `region_id` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `book_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `single`
--

CREATE TABLE `single` (
  `id` int(11) NOT NULL,
  `single_id` varchar(32) NOT NULL,
  `event_id` int(11) NOT NULL,
  `odd_id` int(11) NOT NULL,
  `odd_selection_id` int(11) NOT NULL,
  `risk` float NOT NULL,
  `win` float DEFAULT NULL,
  `odd` float NOT NULL,
  `points` float NOT NULL,
  `book_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sport`
--

CREATE TABLE `sport` (
  `id` int(11) NOT NULL,
  `sport_id` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `book_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `apilog`
--
ALTER TABLE `apilog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `league`
--
ALTER TABLE `league`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `multiple`
--
ALTER TABLE `multiple`
  ADD PRIMARY KEY (`id`),
  ADD KEY `multiple_id` (`multiple_id`),
  ADD KEY `book_id` (`book_id`);

--
-- Indexes for table `multipleselection`
--
ALTER TABLE `multipleselection`
  ADD PRIMARY KEY (`id`),
  ADD KEY `odd_id` (`odd_id`),
  ADD KEY `multiple_selection_id` (`multiple_selection_id`),
  ADD KEY `odd_selection_id` (`odd_selection_id`),
  ADD KEY `book_id` (`book_id`),
  ADD KEY `event_id` (`event_id`);

--
-- Indexes for table `odd`
--
ALTER TABLE `odd`
  ADD PRIMARY KEY (`id`),
  ADD KEY `odd_id` (`odd_id`),
  ADD KEY `event_id` (`event_id`),
  ADD KEY `book_id` (`book_id`);

--
-- Indexes for table `oddselection`
--
ALTER TABLE `oddselection`
  ADD PRIMARY KEY (`id`),
  ADD KEY `odd_selection_id` (`odd_selection_id`),
  ADD KEY `odd_id` (`odd_id`),
  ADD KEY `book_id` (`book_id`);

--
-- Indexes for table `region`
--
ALTER TABLE `region`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `single`
--
ALTER TABLE `single`
  ADD PRIMARY KEY (`id`),
  ADD KEY `single_id` (`single_id`),
  ADD KEY `odd_id` (`odd_id`),
  ADD KEY `odd_selection_id` (`odd_selection_id`),
  ADD KEY `book_id` (`book_id`),
  ADD KEY `event_id` (`event_id`);

--
-- Indexes for table `sport`
--
ALTER TABLE `sport`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `apilog`
--
ALTER TABLE `apilog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `league`
--
ALTER TABLE `league`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `multiple`
--
ALTER TABLE `multiple`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `multipleselection`
--
ALTER TABLE `multipleselection`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `odd`
--
ALTER TABLE `odd`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `oddselection`
--
ALTER TABLE `oddselection`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `region`
--
ALTER TABLE `region`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `single`
--
ALTER TABLE `single`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `sport`
--
ALTER TABLE `sport`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;