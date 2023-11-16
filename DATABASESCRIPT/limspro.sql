-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 15, 2023 at 04:39 AM
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
-- Database: `limspro`
--

-- --------------------------------------------------------

--
-- Table structure for table `author`
--

CREATE TABLE `author` (
  `ID` int(11) NOT NULL,
  `AuthorName` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `author`
--

INSERT INTO `author` (`ID`, `AuthorName`) VALUES
(1, 'Jane Austen'),
(2, 'George Orwell'),
(3, 'J.K Rowling'),
(29, 'F Scott Fitzgerald'),
(30, 'Ray Radbury'),
(32, 'F Scott Fitzgerald'),
(33, 'F Scott Fitzgerald'),
(34, 'Ray Radbury');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `ID` int(11) NOT NULL,
  `Title` varchar(100) DEFAULT NULL,
  `AuthorId` int(10) DEFAULT NULL,
  `GenreId` int(10) DEFAULT NULL,
  `Availability` bit(1) DEFAULT b'1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`ID`, `Title`, `AuthorId`, `GenreId`, `Availability`) VALUES
(1, 'Pride and Predjudice', 1, 1, b'0'),
(2, '1984', 2, 2, b'0'),
(3, 'Emma', 1, 1, b'0'),
(4, 'Harry Potter and the Sorcerer\'s Stone', 3, 5, b'0'),
(18, 'The Great Gatsby', 32, 12, b'0'),
(19, 'The Beautiful and the Dammed', 33, 13, b'0'),
(20, 'Fahrenheit 451 ', 34, 14, b'1');

-- --------------------------------------------------------

--
-- Table structure for table `checkouts`
--

CREATE TABLE `checkouts` (
  `ID` int(11) NOT NULL,
  `MemberId` int(10) DEFAULT NULL,
  `BookId` int(10) DEFAULT NULL,
  `DueDate` date DEFAULT NULL,
  `CheckOutDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `checkouts`
--

INSERT INTO `checkouts` (`ID`, `MemberId`, `BookId`, `DueDate`, `CheckOutDate`) VALUES
(1, 1, 1, '2023-10-15', '2023-10-01'),
(2, 2, 2, '2023-10-16', '2023-10-02'),
(3, 1, 3, '2023-10-17', '2023-10-03'),
(4, 3, 4, '2023-10-18', '2023-10-04'),
(6, 3, 18, '2023-10-20', '2023-10-06'),
(7, 2, 19, '2023-10-21', '2023-10-07');

-- --------------------------------------------------------

--
-- Table structure for table `genre`
--

CREATE TABLE `genre` (
  `ID` int(11) NOT NULL,
  `GenreName` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `genre`
--

INSERT INTO `genre` (`ID`, `GenreName`) VALUES
(1, 'Fiction'),
(2, 'Non-Fiction'),
(3, 'Mystery'),
(5, 'Science Fiction'),
(12, 'Fiction'),
(13, 'Fiction'),
(14, 'Fiction');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `ID` int(11) NOT NULL,
  `FirstName` varchar(100) DEFAULT NULL,
  `LastName` varchar(100) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `Address` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`ID`, `FirstName`, `LastName`, `Email`, `Address`) VALUES
(1, 'John', 'Doe', 'john.doe@example.com', '123 Main St'),
(2, 'Jane', 'Smith', 'jane.smith@example.com', '456 Elm St'),
(3, 'Bob', 'Johnson', 'bob.johnson@example.com', '789 Oak St');

-- --------------------------------------------------------

--
-- Table structure for table `returns`
--

CREATE TABLE `returns` (
  `ID` int(11) NOT NULL,
  `CheckoutID` int(11) DEFAULT NULL,
  `ReturnDate` date DEFAULT NULL,
  `FineAmount` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `book indicies` (`AuthorId`,`GenreId`),
  ADD KEY `GenreId` (`GenreId`);

--
-- Indexes for table `checkouts`
--
ALTER TABLE `checkouts`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `MemberId` (`MemberId`,`BookId`),
  ADD KEY `BookId` (`BookId`);

--
-- Indexes for table `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `email index` (`Email`) USING BTREE;

--
-- Indexes for table `returns`
--
ALTER TABLE `returns`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `CheckoutID` (`CheckoutID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `author`
--
ALTER TABLE `author`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `checkouts`
--
ALTER TABLE `checkouts`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `genre`
--
ALTER TABLE `genre`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `returns`
--
ALTER TABLE `returns`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `books_ibfk_1` FOREIGN KEY (`AuthorId`) REFERENCES `author` (`ID`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `books_ibfk_2` FOREIGN KEY (`GenreId`) REFERENCES `genre` (`ID`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `books_ibfk_3` FOREIGN KEY (`TransID`) REFERENCES `checkouts` (`ID`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `checkouts`
--
ALTER TABLE `checkouts`
  ADD CONSTRAINT `checkouts_ibfk_1` FOREIGN KEY (`MemberId`) REFERENCES `members` (`ID`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `checkouts_ibfk_2` FOREIGN KEY (`BookId`) REFERENCES `books` (`ID`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `returns`
--
ALTER TABLE `returns`
  ADD CONSTRAINT `returns_ibfk_1` FOREIGN KEY (`CheckoutID`) REFERENCES `checkouts` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
