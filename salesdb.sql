-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 16, 2021 at 02:33 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `salesdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admintable`
--

CREATE TABLE `admintable` (
  `adminID` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admintable`
--

INSERT INTO `admintable` (`adminID`, `firstname`, `lastname`, `email`, `username`, `password`) VALUES
(1, 'Jeremiah', 'Limpin', 'it.jeremiahmlimpin@gmail.com', 'Jeyml', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `cashiertable`
--

CREATE TABLE `cashiertable` (
  `cashierID` int(11) NOT NULL,
  `cashierEmail` varchar(50) NOT NULL,
  `cashierUsername` varchar(50) NOT NULL,
  `cashierPassword` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cashiertable`
--

INSERT INTO `cashiertable` (`cashierID`, `cashierEmail`, `cashierUsername`, `cashierPassword`) VALUES
(1, 'cashier1@gmail.com', 'cashier1', 'cashier'),
(2, 'cashier2@gmail.com', 'cashier2', 'cashier');

-- --------------------------------------------------------

--
-- Table structure for table `managertable`
--

CREATE TABLE `managertable` (
  `managerID` int(11) NOT NULL,
  `managerEmail` varchar(50) NOT NULL,
  `managerUsername` varchar(50) NOT NULL,
  `managerPassword` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `managertable`
--

INSERT INTO `managertable` (`managerID`, `managerEmail`, `managerUsername`, `managerPassword`) VALUES
(1, 'manager1@gmail.com', 'manager1', 'manager'),
(2, 'manager2@gmail.com', 'manager2', 'manager');

-- --------------------------------------------------------

--
-- Table structure for table `producttable`
--

CREATE TABLE `producttable` (
  `productID` int(11) NOT NULL,
  `productName` varchar(50) NOT NULL,
  `productType` varchar(50) NOT NULL,
  `productPrice` float NOT NULL,
  `productQuantity` int(11) NOT NULL,
  `productTotal` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `producttable`
--

INSERT INTO `producttable` (`productID`, `productName`, `productType`, `productPrice`, `productQuantity`, `productTotal`) VALUES
(1, 'Razer Huntsman Mini', 'Keyboard', 2500, 2, 5000),
(2, 'Logitech G Pro Wireless', 'Mouse', 2899, 3, 8697);

-- --------------------------------------------------------

--
-- Table structure for table `transactiontable`
--

CREATE TABLE `transactiontable` (
  `transactionID` int(11) NOT NULL,
  `transactionDate` date NOT NULL,
  `managerID` int(11) NOT NULL,
  `cashierID` int(11) NOT NULL,
  `productID` int(11) NOT NULL,
  `customerCash` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transactiontable`
--

INSERT INTO `transactiontable` (`transactionID`, `transactionDate`, `managerID`, `cashierID`, `productID`, `customerCash`) VALUES
(1, '2021-02-15', 1, 1, 1, 9999),
(2, '2021-02-01', 2, 2, 2, 9000),
(4, '2021-02-16', 2, 1, 1, 9999),
(5, '2021-02-16', 2, 2, 2, 10999);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admintable`
--
ALTER TABLE `admintable`
  ADD PRIMARY KEY (`adminID`);

--
-- Indexes for table `cashiertable`
--
ALTER TABLE `cashiertable`
  ADD PRIMARY KEY (`cashierID`);

--
-- Indexes for table `managertable`
--
ALTER TABLE `managertable`
  ADD PRIMARY KEY (`managerID`);

--
-- Indexes for table `producttable`
--
ALTER TABLE `producttable`
  ADD PRIMARY KEY (`productID`);

--
-- Indexes for table `transactiontable`
--
ALTER TABLE `transactiontable`
  ADD PRIMARY KEY (`transactionID`),
  ADD KEY `managerID` (`managerID`,`cashierID`,`productID`,`customerCash`),
  ADD KEY `productID` (`productID`),
  ADD KEY `cashierID` (`cashierID`),
  ADD KEY `customerCash` (`customerCash`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admintable`
--
ALTER TABLE `admintable`
  MODIFY `adminID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cashiertable`
--
ALTER TABLE `cashiertable`
  MODIFY `cashierID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1239;

--
-- AUTO_INCREMENT for table `managertable`
--
ALTER TABLE `managertable`
  MODIFY `managerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;

--
-- AUTO_INCREMENT for table `producttable`
--
ALTER TABLE `producttable`
  MODIFY `productID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12353;

--
-- AUTO_INCREMENT for table `transactiontable`
--
ALTER TABLE `transactiontable`
  MODIFY `transactionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `transactiontable`
--
ALTER TABLE `transactiontable`
  ADD CONSTRAINT `transactiontable_ibfk_1` FOREIGN KEY (`managerID`) REFERENCES `managertable` (`managerID`),
  ADD CONSTRAINT `transactiontable_ibfk_2` FOREIGN KEY (`productID`) REFERENCES `producttable` (`productID`),
  ADD CONSTRAINT `transactiontable_ibfk_3` FOREIGN KEY (`cashierID`) REFERENCES `cashiertable` (`cashierID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
