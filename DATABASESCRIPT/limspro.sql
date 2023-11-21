-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1

-- Generation Time: Nov 21, 2023 at 06:06 PM


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
(34, 'Ray Radbury'),
(35, 'Frank Herbert'),
(36, 'Harper Lee'),
(37, 'J.D Salinger'),
(38, 'Nathaniel Hawthorne'),
(39, 'Nathaniel Hawthorne'),
(40, 'Nathaniel Hawthorne'),
(41, 'Nathaniel Hawthorne');

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

(3, 'Emma', 1, 1, b'0'),
(4, 'Harry Potter and the Sorcerer\'s Stone', 3, 5, b'1'),
(18, 'The Great Gatsby', 32, 12, b'0'),
(19, 'The Beautiful and the Dammed', 33, 13, b'1'),
(20, 'Fahrenheit 451 ', 34, 14, b'1'),
(35, 'Dune', 35, 15, b'1'),
(36, 'To Kill a Mockingbird', 36, 16, b'1'),
(37, 'The Catcher in the Rye', 37, 17, b'1'),
(40, 'The Scarlet Letter', 40, 20, b'1');


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

(30, 5, 4, '2023-12-02', '2023-11-18'),
(31, 1, 3, '2023-12-03', '2023-11-19'),
(32, 4, 36, '2023-12-05', '2023-11-21'),
(33, 1, 4, '2023-12-05', '2023-11-21'),
(34, 7, 4, '2023-12-05', '2023-11-21'),
(35, 4, 4, '2023-10-25', '2023-10-11'),
(36, 7, 18, '2023-12-05', '2023-11-21');




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
(14, 'Fiction'),
(15, 'Science Fiction'),
(16, 'Fiction'),
(17, 'Fiction'),
(18, 'Fiction'),
(19, 'Fiction'),
(20, 'Fiction'),
(21, 'Fiction');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `ID` int(11) NOT NULL,
  `FirstName` varchar(100) DEFAULT NULL,
  `LastName` varchar(100) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `HomeAddress` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`ID`, `FirstName`, `LastName`, `Email`, `HomeAddress`) VALUES
(1, 'John', 'Doe', 'john.doe@example.com', '123 Main St'),
(2, 'Jane', 'Smith', 'jane.smith@example.com', '456 Elm St'),
(3, 'Bob', 'Johnson', 'bob.johnson@example.com', '789 Oak St'),
(4, 'Mariah', 'Stoakley', 'mariahstoakley@gmail.com', '321 Gingerbread Ln'),
(5, 'Lisa', 'Simpson', 'ls@yahoo.com', '123 Springfield Dr'),
(6, 'Tom', 'Cat', 'tcat@gmail.com', '123 Rasberry Ln'),
(7, 'Eren', 'Yeager', 'eyeagar@aotyeagorist.org', '123 Paridis Island');

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

-- Dumping data for table `returns`
--

INSERT INTO `returns` (`ID`, `CheckoutID`, `ReturnDate`, `FineAmount`) VALUES
(29, 30, '2023-11-18', 0.00),
(30, 30, '2023-11-18', 0.00),
(35, 30, '2023-11-21', 0.00),
(36, 30, '2023-11-21', 0.00),
(37, 35, '2023-11-21', 67.50);

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
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `checkouts`
--
ALTER TABLE `checkouts`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
=======


--
-- AUTO_INCREMENT for table `genre`
--
ALTER TABLE `genre`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `returns`
--
ALTER TABLE `returns`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;


--
-- Constraints for dumped tables
--

--
-- Constraints for table `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `books_ibfk_1` FOREIGN KEY (`GenreId`) REFERENCES `genre` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `books_ibfk_2` FOREIGN KEY (`AuthorId`) REFERENCES `author` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;



--
-- Constraints for table `checkouts`
--
ALTER TABLE `checkouts`
  ADD CONSTRAINT `checkouts_ibfk_1` FOREIGN KEY (`MemberId`) REFERENCES `members` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `checkouts_ibfk_2` FOREIGN KEY (`BookId`) REFERENCES `books` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `returns`
--
ALTER TABLE `returns`
  ADD CONSTRAINT `returns_ibfk_1` FOREIGN KEY (`CheckoutID`) REFERENCES `checkouts` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
