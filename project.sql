-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 06, 2023 at 04:39 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project`
--
CREATE DATABASE IF NOT EXISTS `project` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `project`;

-- --------------------------------------------------------

--
-- Table structure for table `Accident`
--
-- Creation: Jun 03, 2023 at 05:31 AM
--

DROP TABLE IF EXISTS `Accident`;
CREATE TABLE `Accident` (
  `ACDNO` int(11) NOT NULL,
  `VECHICLENO` varchar(50) NOT NULL,
  `PLACE` varchar(50) NOT NULL,
  `DATE` date NOT NULL,
  `PROOF` blob DEFAULT NULL,
  `NAME` varchar(50) NOT NULL,
  `MOB` varchar(50) NOT NULL,
  `VERIFIED` varchar(50) NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- MEDIA TYPES FOR TABLE `Accident`:
--   `PROOF`
--       `Image_PNG`
--

--
-- RELATIONSHIPS FOR TABLE `Accident`:
--   `VECHICLENO`
--       `vechiclereg` -> `VECHICLENO`
--

--
-- Dumping data for table `Accident`
--

INSERT INTO `Accident` (`ACDNO`, `VECHICLENO`, `PLACE`, `DATE`, `PROOF`, `NAME`, `MOB`, `VERIFIED`) VALUES
(25, 'KL63D2019', 'MKM', '2023-06-14', 0x3130206d61726b206c6973742e706466, 'officer', 'XXX', 'YES'),
(26, 'KL63D2019', 'fff', '2023-06-01', 0x7265756d652e706466, 'officer', 'XXX', 'YES'),
(27, 'KL63D2019', 'MKM', '2023-06-20', NULL, 'hhhhh', '78787878787', 'YES'),
(28, 'KL63D2022', 'MKM', '2023-06-14', NULL, 'joyal', '78787878787', 'YES'),
(29, 'KL63D2022', 'ffff', '2023-06-14', NULL, 'hhhhh', 'dddd', 'YES'),
(30, 'KL63D2019', 'ww', '2023-06-22', 0x66616365626f6f6b2e706e67, 'tt', '8921581287', 'YES'),
(31, 'KL63D2019', 'ffff', '2023-06-02', 0x6368616c6c616e706f6c6963652e68746d6c, 'officer', 'XXX', 'YES');

-- --------------------------------------------------------

--
-- Table structure for table `CHALLAN`
--
-- Creation: Jun 05, 2023 at 03:18 PM
--

DROP TABLE IF EXISTS `CHALLAN`;
CREATE TABLE `CHALLAN` (
  `CMNO` int(11) DEFAULT NULL,
  `CHNO` int(11) NOT NULL,
  `VECHICLENO` varchar(50) NOT NULL,
  `DRIVERNAME` varchar(50) NOT NULL,
  `CRIME` varchar(50) NOT NULL,
  `FINE` int(11) NOT NULL,
  `DATE` date NOT NULL DEFAULT current_timestamp(),
  `PLACE` varchar(50) NOT NULL,
  `PAID` varchar(50) NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELATIONSHIPS FOR TABLE `CHALLAN`:
--   `CMNO`
--       `CRIME` -> `CMNO`
--   `VECHICLENO`
--       `vechiclereg` -> `VECHICLENO`
--

-- --------------------------------------------------------

--
-- Table structure for table `CRIME`
--
-- Creation: Jun 03, 2023 at 05:30 AM
--

DROP TABLE IF EXISTS `CRIME`;
CREATE TABLE `CRIME` (
  `CMNO` int(11) NOT NULL,
  `VECHICLENO` varchar(11) NOT NULL,
  `CRIMEDONE` varchar(50) NOT NULL,
  `PLACE` varchar(50) NOT NULL,
  `DATE` date NOT NULL,
  `PROOF` blob DEFAULT NULL,
  `NAME` varchar(11) NOT NULL,
  `MOB` varchar(11) NOT NULL,
  `VERIFIED` varchar(50) NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- MEDIA TYPES FOR TABLE `CRIME`:
--   `PROOF`
--       `Image_JPEG`
--

--
-- RELATIONSHIPS FOR TABLE `CRIME`:
--   `VECHICLENO`
--       `vechiclereg` -> `VECHICLENO`
--

--
-- Dumping data for table `CRIME`
--

INSERT INTO `CRIME` (`CMNO`, `VECHICLENO`, `CRIMEDONE`, `PLACE`, `DATE`, `PROOF`, `NAME`, `MOB`, `VERIFIED`) VALUES
(15, 'KL63D2019', 'no mirror', 'MKM', '2023-06-13', NULL, 'joyal', '78787878787', 'N'),
(16, 'KL63D2019', ' No seatbelt', 'fggg', '2023-06-27', 0x66616365626f6f6b2e706e67, 'gg', '8921581287', 'N'),
(17, 'KL63D2019', ' No seatbelt', 'fggg', '2023-06-26', 0x706169646368616c6c616e2e706870, 'gg', '8921581287', 'N'),
(18, 'KL63D2019', ' No seatbelt', 'dd', '2023-06-28', 0x766965776163636964656e742e706870, 'tt', '8921581287', 'N');

-- --------------------------------------------------------

--
-- Table structure for table `Feedback`
--
-- Creation: Jun 03, 2023 at 05:33 AM
--

DROP TABLE IF EXISTS `Feedback`;
CREATE TABLE `Feedback` (
  `FID` int(11) NOT NULL,
  `NAME` varchar(50) NOT NULL,
  `EMAIL` varchar(50) NOT NULL,
  `MOB` varchar(50) NOT NULL,
  `SUBJECT` varchar(100) NOT NULL,
  `MESSAGE` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELATIONSHIPS FOR TABLE `Feedback`:
--

--
-- Dumping data for table `Feedback`
--

INSERT INTO `Feedback` (`FID`, `NAME`, `EMAIL`, `MOB`, `SUBJECT`, `MESSAGE`) VALUES
(7, 'joyal', 'joyalddevassy14@gmail.com', '78787878787', 'bfksx dj x\r\nc dc \r\nmrnsj', 'f ewjnclw\r\ncekc\r\nfmksc;m\r\nm;smcwx'),
(8, 'hhhhh', 'rgrg', 'dddd', 'feljwnl\r\n', 'ebhkdknw;o\r\nd\r\n\r\ndkowedjpiw\'\r\n\r\ndwd'),
(9, 'r', 'fff', '56', '56565', '498');

-- --------------------------------------------------------

--
-- Table structure for table `USER`
--
-- Creation: Jun 03, 2023 at 08:33 AM
--

DROP TABLE IF EXISTS `USER`;
CREATE TABLE `USER` (
  `EMPID` varchar(50) NOT NULL,
  `NAME` varchar(50) NOT NULL,
  `USERNAME` varchar(50) NOT NULL,
  `PASSWORD` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELATIONSHIPS FOR TABLE `USER`:
--

--
-- Dumping data for table `USER`
--

INSERT INTO `USER` (`EMPID`, `NAME`, `USERNAME`, `PASSWORD`) VALUES
('jjjjjj', 'hhhh', 'joyal', 'joyal'),
('jjjjjj', 'hhhh', 'joyal123', '123');

-- --------------------------------------------------------

--
-- Table structure for table `vechiclereg`
--
-- Creation: Jun 01, 2023 at 04:20 PM
--

DROP TABLE IF EXISTS `vechiclereg`;
CREATE TABLE `vechiclereg` (
  `VECHICLENO` varchar(50) NOT NULL,
  `OWNERNAME` varchar(50) NOT NULL,
  `ADRESS` text NOT NULL,
  `TYPE` varchar(50) NOT NULL,
  `MOB` varchar(50) NOT NULL,
  `EMAIL` varchar(50) NOT NULL,
  `MODEL` varchar(50) NOT NULL,
  `DATE` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELATIONSHIPS FOR TABLE `vechiclereg`:
--

--
-- Dumping data for table `vechiclereg`
--

INSERT INTO `vechiclereg` (`VECHICLENO`, `OWNERNAME`, `ADRESS`, `TYPE`, `MOB`, `EMAIL`, `MODEL`, `DATE`) VALUES
('KL63D2019', 'JOYAL DEVASSY', 'ded', 'ded', '78787878787', 'joyalddevassy87@gmail.com', 'rgrrgh', '2023-06-05'),
('KL63D2022', 'ggg', 'sss', 'HMV', '789', 'dddddd@dd', 'swift', '2023-06-05'),
('KL63E4017', 'JOYAL DEVASSY', 'dcdc', 'LMV', 'dddd', 'joyalddevassy14@gmail.com', 'rgrrgh', '2023-06-05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Accident`
--
ALTER TABLE `Accident`
  ADD PRIMARY KEY (`ACDNO`),
  ADD KEY `VECHICLENO` (`VECHICLENO`);

--
-- Indexes for table `CHALLAN`
--
ALTER TABLE `CHALLAN`
  ADD PRIMARY KEY (`CHNO`),
  ADD KEY `CMNO` (`CMNO`),
  ADD KEY `VECHICLENO` (`VECHICLENO`);

--
-- Indexes for table `CRIME`
--
ALTER TABLE `CRIME`
  ADD PRIMARY KEY (`CMNO`),
  ADD KEY `VECHICLENO` (`VECHICLENO`);

--
-- Indexes for table `Feedback`
--
ALTER TABLE `Feedback`
  ADD PRIMARY KEY (`FID`);

--
-- Indexes for table `vechiclereg`
--
ALTER TABLE `vechiclereg`
  ADD PRIMARY KEY (`VECHICLENO`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Accident`
--
ALTER TABLE `Accident`
  MODIFY `ACDNO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `CHALLAN`
--
ALTER TABLE `CHALLAN`
  MODIFY `CHNO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2138;

--
-- AUTO_INCREMENT for table `CRIME`
--
ALTER TABLE `CRIME`
  MODIFY `CMNO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `Feedback`
--
ALTER TABLE `Feedback`
  MODIFY `FID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Accident`
--
ALTER TABLE `Accident`
  ADD CONSTRAINT `accident_ibfk_1` FOREIGN KEY (`VECHICLENO`) REFERENCES `vechiclereg` (`VECHICLENO`);

--
-- Constraints for table `CHALLAN`
--
ALTER TABLE `CHALLAN`
  ADD CONSTRAINT `challan_ibfk_1` FOREIGN KEY (`CMNO`) REFERENCES `CRIME` (`CMNO`),
  ADD CONSTRAINT `challan_ibfk_2` FOREIGN KEY (`VECHICLENO`) REFERENCES `vechiclereg` (`VECHICLENO`);

--
-- Constraints for table `CRIME`
--
ALTER TABLE `CRIME`
  ADD CONSTRAINT `crime_ibfk_1` FOREIGN KEY (`VECHICLENO`) REFERENCES `vechiclereg` (`VECHICLENO`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
