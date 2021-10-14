-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: busrvdovjzql8nhy3fez-mysql.services.clever-cloud.com:3306
-- Generation Time: Oct 13, 2021 at 09:42 AM
-- Server version: 8.0.22-13
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `busrvdovjzql8nhy3fez`
--

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `Name` varchar(25) NOT NULL,
  `TIN` bigint NOT NULL,
  `SSS` bigint NOT NULL,
  `PAGIBIG` bigint NOT NULL,
  `PHILHEALTH` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`Name`, `TIN`, `SSS`, `PAGIBIG`, `PHILHEALTH`) VALUES
('Juan Samuel B. Leano', 123123123, 456456456, 789789789, 765432112),
('Miko Francis B. Leano', 111222333, 333222111, 1236783423, 123456789);

-- --------------------------------------------------------

--
-- Table structure for table `installation`
--

CREATE TABLE `installation` (
  `Order_Number` int NOT NULL,
  `Name` varchar(25) NOT NULL,
  `Date` varchar(25) NOT NULL,
  `Address` varchar(100) NOT NULL,
  `Number` bigint NOT NULL,
  `Brand_Name` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Model_Name` varchar(25) NOT NULL,
  `Model_Number` int DEFAULT NULL,
  `Serial_Number` int DEFAULT NULL,
  `Labor` int DEFAULT NULL,
  `Total` int DEFAULT NULL,
  `Status` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `installation`
--

INSERT INTO `installation` (`Order_Number`, `Name`, `Date`, `Address`, `Number`, `Brand_Name`, `Model_Name`, `Model_Number`, `Serial_Number`, `Labor`, `Total`, `Status`) VALUES
(56, 'Mart Anthony Salazar', '10-24-21', 'Daet', 88888, 'Panasonic', 'LG-ABC', 123, 3345, 1000, 2000, NULL),
(58, 'Anthony S', '2021-10-45', 'Magang', 78657, 'LG-s', 'LG-275', 30, 100, 200, 400, NULL),
(65, 'Ron Dela Cruz', '2021-10-11', 'Brgy. Magang, DCN', 92103654787, 'LG', 'LG-94', 3246, 654065, 32406, 646, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `Product_Number` int NOT NULL,
  `Name` varchar(25) NOT NULL,
  `Price` int NOT NULL,
  `Quantity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`Product_Number`, `Name`, `Price`, `Quantity`) VALUES
(1, 'Bolt', 12, 30),
(2, 'Wire', 5, 10),
(3, 'Steel Frame', 750, 96),
(4, 'Screen (15.6in 60hz)', 2500, 119);

-- --------------------------------------------------------

--
-- Table structure for table `inventory_logs`
--

CREATE TABLE `inventory_logs` (
  `Date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Product_Name` varchar(25) NOT NULL,
  `Product_Number` int DEFAULT NULL,
  `Debit` int DEFAULT NULL,
  `Credit` int DEFAULT NULL,
  `Price` int NOT NULL,
  `Quantity` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `inventory_logs`
--

INSERT INTO `inventory_logs` (`Product_Name`, `Product_Number`, `Debit`, `Credit`, `Price`, `Quantity`) VALUES
('Steel Frame', 3, NULL, 1, 750, 100),
('Bolt', 1, NULL, 12, 144, 75),
('Wire', 2, NULL, 20, 100, 60),
('Bolt', 1, NULL, 10, 120, 63),
('', 1, NULL, 0, 0, 53),
('', 1, NULL, 0, 0, 53),
('Bolt', 1, NULL, 1, 12, 53),
('', 1, NULL, 0, 0, 52),
('Bolt', 1, NULL, 2, 24, 52),
('', 1, NULL, 0, 0, 50),
('', 1, NULL, 0, 0, 50),
('', 1, NULL, 0, 0, 50),
('', 1, NULL, 0, 0, 50),
('', 1, NULL, 0, 0, 50),
('', 1, NULL, 0, 0, 50),
('', 1, NULL, 0, 0, 50),
('', 1, NULL, 0, 0, 50),
('', 1, NULL, 0, 0, 50),
('', 1, NULL, 0, 0, 50),
('', 1, NULL, 0, 0, 50),
('', 1, NULL, 0, 0, 50),
('Bolt', 0, NULL, 1, 12, 2),
('Steel Frame', 0, NULL, 1, 750, 10),
('Steel Frame', 0, NULL, 1, 750, 10),
('Wire', 2, NULL, 10, 50, 20),
('sad', 52, 0, 2, 24, 0);

-- --------------------------------------------------------

--
-- Table structure for table `joborder`
--

CREATE TABLE `joborder` (
  `JON` int NOT NULL,
  `Name` varchar(25) NOT NULL,
  `Date` varchar(25) NOT NULL,
  `Address` varchar(100) NOT NULL,
  `Number` bigint NOT NULL,
  `Device_Type` varchar(25) NOT NULL,
  `Accessories` varchar(100) DEFAULT NULL,
  `Model_Number` int DEFAULT NULL,
  `Brand_Name` varchar(25) DEFAULT NULL,
  `Serial_Number` int DEFAULT NULL,
  `Complain` varchar(100) NOT NULL,
  `Warranty` varchar(4) NOT NULL,
  `Type_of_Repair` varchar(6) NOT NULL,
  `Findings` text,
  `Materials` longtext,
  `Check_up` int DEFAULT NULL,
  `Labor` int DEFAULT NULL,
  `Total` int DEFAULT NULL,
  `Technician` varchar(25) DEFAULT NULL,
  `Warranty_exp` varchar(25) NOT NULL,
  `Status` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `joborder`
--

INSERT INTO `joborder` (`JON`, `Name`, `Date`, `Address`, `Number`, `Device_Type`, `Accessories`, `Model_Number`, `Brand_Name`, `Serial_Number`, `Complain`, `Warranty`, `Type_of_Repair`, `Findings`, `Materials`, `Check_up`, `Labor`, `Total`, `Technician`, `Warranty_exp`, `Status`) VALUES
(16, 'Grace Emington', '2021-08-23', 'Manila, PH', 9678345628, 'PC', 'none', 123321123, 'Aorus ', 800988907, 'not booting up', 'Shop', 'Shop', 'Loose bolts and damaged wires, needs replacement', '12---Bolt---144---', 100, 400, 744, 'Roll Electronics', '', 'Finished'),
(17, 'Micheal Williams', '2021-08-24', 'Daet, CN', 9123456789, 'Split Type', 'none', 123543342, 'TCL', 123567890, 'Not working properly', 'Out', 'Dealer', 'Broken Steel Frame, needs replacement', '1---Steel Frame---750---', 100, 400, 1250, 'Roll Electroncis', '', 'Finished'),
(18, 'Juan asdfas', '2021-08-27', 'Daet, CN', 9123456789, 'Split Type', 'none', 123123123, 'Samsung', 123312311, 'Not working', 'Out', 'Field', 'damaged bolts and frames', '12---Bolt---144---', 100, 400, 644, 'Roll Electronics', '', 'Finished'),
(19, 'Rowel Roll', '2021-08-27', 'Daet, CN', 9123454789, 'LED TV', 'none', 1234563421, 'Samsung', 1123456345, 'not working', 'In', 'Shop', 'damaged bolts and wires', '20---Wire---100---', 100, 400, 720, 'Roll Electronics', '', 'Finished'),
(20, 'Marc Ferdinand B. Leaño', '2021-10-03', 'Parang, CN', 9123456789, 'Freezer', 'Samsung', 1122334455, 'adsfasdf', 12312312, 'not working', 'In', 'Dealer', 'Damaged bolts and Frames', '1---Steel Frame---750---10---Bolt---120---', 123, 345, 1338, 'Roll Electronics', '2022-01-03', 'Finished'),
(21, 'asdfasdf', '2021-10-04', 'asdf123sdf', 12312312, 'LED TV', 'asdfsdf', 1231231, 'sfasdf', 123123, 'asdfasdf', 'In', 'Shop', 'damaged bolts', '8---Bolt---96---', 123, 345, 564, 'Roll Electronics', '2021-10-10', 'Finished'),
(22, 'Miko Francis B. Leaño', '2021-10-03', 'Parang, CN', 9234978567, 'Refrigerator', 'none', 123123, 'ace', 123123, 'not freezing', 'In', 'Dealer', 'damaged wires', '10---Wire---50---', 123, 345, 518, 'Roll Electronics', '2022-01-03', 'Finished');

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

CREATE TABLE `schedules` (
  `JON` int NOT NULL,
  `Name` varchar(25) NOT NULL,
  `Type` varchar(25) NOT NULL,
  `Date` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `schedules`
--

INSERT INTO `schedules` (`JON`, `Name`, `Type`, `Date`) VALUES
(22, 'Miko Francis B. Leaño', 'Repair', '2022-01-03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`Name`);

--
-- Indexes for table `installation`
--
ALTER TABLE `installation`
  ADD PRIMARY KEY (`Order_Number`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`Product_Number`);

--
-- Indexes for table `joborder`
--
ALTER TABLE `joborder`
  ADD PRIMARY KEY (`JON`);

--
-- Indexes for table `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`JON`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `installation`
--
ALTER TABLE `installation`
  MODIFY `Order_Number` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `joborder`
--
ALTER TABLE `joborder`
  MODIFY `JON` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
