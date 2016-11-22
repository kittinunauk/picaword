-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 22, 2016 at 08:12 AM
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
  `CIPath` longtext NOT NULL,
  `CCategory` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Card`
--

INSERT INTO `Card` (`CID`, `CDID`, `CWord`, `CDescription`, `CIPath`, `CCategory`) VALUES
(1, 1, 'chocolate toast', 'Bread with ice cream and chocolate', 'img/1/1.png', 'Human'),
(2, 1, 'french fries', 'Long, thin pieces of potato that are fried and eaten hot', 'img/1/2.png', 'Human'),
(3, 1, 'hot chocolate', 'A hot drink made from milk and/or water, powdered chocolate, and sugar\n', 'img/1/3.png', 'Animal'),
(4, 1, 'crepe cake', 'A type of cake made of crepe', 'img/1/4.png', 'Human'),
(5, 1, 'ice cream cake', 'A type of cake made of ice cream', 'img/1/5.png', 'Human'),
(6, 1, 'Bingsu', 'A Korean shaved ice dessert with sweet toppings such as chopped fruit, condensed milk, fruit syrup, and chocolate', 'img/1/6.png', 'Foods and Drinks'),
(7, 1, 'yogurt', 'A slightly sour, thick liquid made from milk with bacteria added to it, sometimes eaten plain and sometimes with sugar, fruit, etc. added', 'img/1/7.png', 'Foods and Drinks'),
(8, 1, 'ice cream', 'A very cold, sweet food made from frozen milk or cream, sugar, and a flavor', 'img/1/8.png', 'Foods and Drinks'),
(9, 1, 'fish and chips', 'Fish covered with batter (= a mixture of flour, eggs, and milk) and then fried and served with pieces of fried potato', 'img/1/9.png', 'Foods and Drinks'),
(10, 1, 'pancakes', 'Thin, flat, round cakes made from a mixture of flour, milk, and egg, fried on both sides', 'img/1/10.png', 'Foods and Drinks'),
(11, 2, 'jellyfish', 'A sea creature with a soft, oval, almost transparent body', 'img/2/1.png', 'Animals'),
(12, 2, 'fish', 'An animal that lives in water, is covered with scales, and breathes by taking water in through its mouth', 'img/2/2.png', 'Animals'),
(13, 2, 'beatle', 'An insect with a hard-shell-like back', 'img/2/3.png', 'Animals'),
(14, 2, 'dog', 'A common animal with four legs, especially kept by people as a pet or to hunt or guard things', 'img/2/4.png', 'Animals'),
(15, 2, 'duck', 'A bird that lives by water and has webbed feet (= feet with skin between the toes), a short neck, and a large beak', 'img/2/5.png', 'Animals'),
(16, 2, 'butterfly', 'A type of insect with large, often brightly colored wings', 'img/2/6.png', 'Animals'),
(17, 2, 'dragonfly', 'A large insect with a long, thin, brightly colored body and two pairs of transparent wings', 'img/2/7.png', 'Animals'),
(18, 2, 'squirrel', 'A small animal covered in fur with a long tail, climbs trees and feed on nuts and seeds.', 'img/2/8.png', 'Animals'),
(19, 2, 'bird', 'A creature with feathers and wings, usually able to fly', 'img/2/9.png', 'Animals'),
(20, 2, 'cat', 'A small animal with fur, four legs, a tail, and claws, usually kept as a pet or for catching mice', 'img/2/10.png', 'Animals');

-- --------------------------------------------------------

--
-- Table structure for table `Deck`
--

CREATE TABLE `Deck` (
  `DID` int(11) NOT NULL,
  `DName` text NOT NULL,
  `DDescription` text NOT NULL,
  `DCreator` text NOT NULL,
  `DCover` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Deck`
--

INSERT INTO `Deck` (`DID`, `DName`, `DDescription`, `DCreator`, `DCover`) VALUES
(1, 'Foods and Drinks', 'This is first deck.', 'Admin', 'img/1/1.png'),
(2, 'Animals', 'This is second deck.', 'Admin', 'img/2/2.png');

-- --------------------------------------------------------

--
-- Table structure for table `progress`
--

CREATE TABLE `progress` (
  `UID` int(11) NOT NULL,
  `DID` int(11) NOT NULL,
  `UProgress` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(1, 'admin', 'admin', 'admin@picaword.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Card`
--
ALTER TABLE `Card`
  ADD PRIMARY KEY (`CID`);

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
-- AUTO_INCREMENT for table `Card`
--
ALTER TABLE `Card`
  MODIFY `CID` int(64) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
--
-- AUTO_INCREMENT for table `Deck`
--
ALTER TABLE `Deck`
  MODIFY `DID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `Users`
--
ALTER TABLE `Users`
  MODIFY `UID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
