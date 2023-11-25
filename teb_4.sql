-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 25, 2023 at 04:58 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `teb_4`
--

-- --------------------------------------------------------

--
-- Table structure for table `access_level`
--

CREATE TABLE `access_level` (
  `ID_ACCESS_LEVEL` int(11) NOT NULL,
  `DESCRIPTION` mediumtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `access_level`
--

INSERT INTO `access_level` (`ID_ACCESS_LEVEL`, `DESCRIPTION`) VALUES
(1, 'admin'),
(2, 'user');

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `ID_BOOK` int(11) NOT NULL,
  `TITLE` text DEFAULT NULL,
  `AUTHOR` text DEFAULT NULL,
  `ISBN` decimal(10,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`ID_BOOK`, `TITLE`, `AUTHOR`, `ISBN`) VALUES
(12, 'Lalka', 'Bolesław Prus', 111111),
(20, 'Potop', 'Henryk Sienkiewicz', 222222),
(21, 'Oda do młodości', 'Adam Mickiewicz', 333333),
(23, 'Konrad Wallenrod', 'Adam Mickiewicz', 444444),
(24, 'Kordian', 'Juliusz Słowacki', 555555),
(25, 'Zbrodnia i kara', 'Fiodor Dostojewski', 666666),
(26, 'Wesele', 'Stanisław Wyspiański', 777777),
(27, 'Rok 1984', 'George Orwell', 888888),
(28, 'Romeo i Julia', 'William Szekspir', 999999),
(29, 'Odyseja', 'Hommer', 101010),
(30, 'test', 'test', 123456);

-- --------------------------------------------------------

--
-- Table structure for table `borrow`
--

CREATE TABLE `borrow` (
  `ID_BORROW` int(11) NOT NULL,
  `DATE_START` datetime DEFAULT NULL,
  `DATE_BACK` datetime DEFAULT NULL,
  `BOOK_ID` int(11) NOT NULL,
  `USER_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `borrow`
--

INSERT INTO `borrow` (`ID_BORROW`, `DATE_START`, `DATE_BACK`, `BOOK_ID`, `USER_ID`) VALUES
(32, '2023-11-25 04:13:50', '2023-12-02 04:13:50', 12, 8),
(34, '2023-11-25 16:43:55', '2023-12-02 16:43:55', 12, 8),
(35, '2023-11-25 16:43:56', '2023-12-02 16:43:56', 24, 8),
(36, '2023-11-25 16:44:08', '2023-12-02 16:44:08', 27, 87),
(37, '2023-11-25 16:44:09', '2023-12-02 16:44:09', 28, 87),
(38, '2023-11-25 16:44:17', '2023-12-02 16:44:17', 29, 85),
(39, '2023-11-25 16:44:20', '2023-12-02 16:44:20', 26, 85),
(40, '2023-11-25 16:44:32', '2023-12-02 16:44:32', 12, 24),
(41, '2023-11-25 16:44:32', '2023-12-02 16:44:32', 20, 24),
(42, '2023-11-25 16:44:35', '2023-12-02 16:44:35', 25, 24),
(43, '2023-11-25 16:44:49', '2023-12-02 16:44:49', 21, 86);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `ID_USER` int(11) NOT NULL,
  `LOGIN` mediumtext DEFAULT NULL,
  `PASSWORD` longtext DEFAULT NULL,
  `ACCESS_LEVEL_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`ID_USER`, `LOGIN`, `PASSWORD`, `ACCESS_LEVEL_ID`) VALUES
(8, 'admin', 'admin', 1),
(24, 'user', 'user', 2),
(84, 'collew', 'collew', 2),
(85, 'dele', 'dele', 2),
(86, 'nocker29', 'nocker29', 2),
(87, 'test', 'test', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `access_level`
--
ALTER TABLE `access_level`
  ADD PRIMARY KEY (`ID_ACCESS_LEVEL`);

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`ID_BOOK`);

--
-- Indexes for table `borrow`
--
ALTER TABLE `borrow`
  ADD PRIMARY KEY (`ID_BORROW`,`BOOK_ID`,`USER_ID`),
  ADD KEY `fk_BORROW_BOOK1_idx` (`BOOK_ID`),
  ADD KEY `fk_borrow_user1_idx` (`USER_ID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID_USER`,`ACCESS_LEVEL_ID`),
  ADD KEY `fk_USER_ACCESS_LEVEL_idx` (`ACCESS_LEVEL_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `access_level`
--
ALTER TABLE `access_level`
  MODIFY `ID_ACCESS_LEVEL` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  MODIFY `ID_BOOK` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `borrow`
--
ALTER TABLE `borrow`
  MODIFY `ID_BORROW` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `ID_USER` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `borrow`
--
ALTER TABLE `borrow`
  ADD CONSTRAINT `fk_BORROW_BOOK1` FOREIGN KEY (`BOOK_ID`) REFERENCES `book` (`ID_BOOK`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_borrow_user1` FOREIGN KEY (`USER_ID`) REFERENCES `user` (`ID_USER`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_USER_ACCESS_LEVEL` FOREIGN KEY (`ACCESS_LEVEL_ID`) REFERENCES `access_level` (`ID_ACCESS_LEVEL`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
