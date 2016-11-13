-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 13, 2016 at 10:49 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `picaword`
--

-- --------------------------------------------------------

--
-- Table structure for table `Card`
--

CREATE TABLE `Card` (
  `CID` int(64) NOT NULL,
  `CDID` int(64) NOT NULL,
  `CWord` text NOT NULL,
  `CDescription` text NOT NULL,
  `CIPath` text NOT NULL,
  `CCategory` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Card`
--

INSERT INTO `Card` (`CID`, `CDID`, `CWord`, `CDescription`, `CIPath`, `CCategory`) VALUES
(1, 1, 'Sunny', 'This is just test', 'img/1/1.jpg', 'Human'),
(2, 1, 'Mitjung', 'Just another person.', 'img/1/2.jpg', 'Human'),
(3, 1, 'GreenCat', 'Just another cat.', 'img/1/3.jpg', 'Animal'),
(4, 2, 'Suppy', 'Mind You', 'img/2/1.jpg', 'Human'),
(5, 2, 'Jimmy', 'ICT!!', 'img/2/2.jpg', 'Human');

-- --------------------------------------------------------

--
-- Table structure for table `Deck`
--

CREATE TABLE `Deck` (
  `DID` int(11) NOT NULL,
  `DName` text NOT NULL,
  `DDescription` text NOT NULL,
  `DMax` int(11) NOT NULL,
  `DCreator` text NOT NULL,
  `DRating` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Deck`
--

INSERT INTO `Deck` (`DID`, `DName`, `DDescription`, `DMax`, `DCreator`, `DRating`) VALUES
(1, 'MooMoo', 'This is first deck.', 3, 'Admin', 5),
(2, 'Jot Down', '', 20, 'Admin', 5);

-- --------------------------------------------------------

--
-- Table structure for table `progress`
--

CREATE TABLE `progress` (
  `UID` int(11) NOT NULL,
  `DID` int(11) NOT NULL,
  `UProgress` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `progress`
--

INSERT INTO `progress` (`UID`, `DID`, `UProgress`) VALUES
(2, 2, 100),
(2, 1, 66.66666666666666),
(1, 1, 66.66666666666666);

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE `Users` (
  `UID` int(11) NOT NULL,
  `UUser` text NOT NULL,
  `UPass` text NOT NULL,
  `UEmail` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`UID`, `UUser`, `UPass`, `UEmail`) VALUES
(1, 'a', 'a', 'aa@aa.com'),
(2, 'test', 'test', 'test@test.com'),
(3, 'ss', 'ss', 'ss@ss'),
(4, 'zz', 'zz', 'zz@zz.com'),
(5, 'tt', 'tt', 'admin@ff'),
(6, 'pp', 'pp', 'pp@pp.com'),
(7, 'x', 's', 'supy@ddds');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Deck`
--
ALTER TABLE `Deck`
  ADD PRIMARY KEY (`DID`);

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`UID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Users`
--
ALTER TABLE `Users`
  MODIFY `UID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
