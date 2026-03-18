-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 02, 2023 at 06:42 PM
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
-- Database: `id21293118_byumba_hospital`
--

-- --------------------------------------------------------

--
-- Table structure for table `announcements`
--

CREATE TABLE `announcements` (
  `ID` int(11) NOT NULL,
  `announces` varchar(255) NOT NULL,
  `dates` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `announcements`
--

INSERT INTO `announcements` (`ID`, `announces`, `dates`) VALUES
(9, 'i will be with you tommorrow', '2023-09-15 10:32:38.040169');

-- --------------------------------------------------------

--
-- Table structure for table `bcg`
--

CREATE TABLE `bcg` (
  `Batchno` int(11) NOT NULL,
  `Bcg_status` varchar(11) NOT NULL,
  `Bcg_height` float NOT NULL,
  `Bcg_weight` float NOT NULL,
  `Bcg_age` int(4) NOT NULL,
  `Bcg_schedule` varchar(25) NOT NULL,
  `Bcg_date` date NOT NULL,
  `Bcg_impact` varchar(11) NOT NULL,
  `Bcg_hepatitis_case` varchar(5) NOT NULL,
  `Bcg_sms` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bcg`
--

INSERT INTO `bcg` (`Batchno`, `Bcg_status`, `Bcg_height`, `Bcg_weight`, `Bcg_age`, `Bcg_schedule`, `Bcg_date`, `Bcg_impact`, `Bcg_hepatitis_case`, `Bcg_sms`) VALUES
(1405864239, 'Yes', 2, 3, 0, 'At Birth', '2023-10-01', 'No', 'No', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `ID` varchar(10) NOT NULL,
  `NAMES` varchar(50) NOT NULL,
  `AGE` int(3) NOT NULL,
  `QUALIFIATION` text NOT NULL,
  `Martial_Status` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`ID`, `NAMES`, `AGE`, `QUALIFIATION`, `Martial_Status`) VALUES
('BH001', 'MUKAMANA Esther', 48, 'A0 in Pediatric Cardiology', 'Married'),
('BH002', 'NSENGIMANA Lambert', 25, 'Masters in Pathology', 'Single'),
('BH008', 'Mukamana Selaphine', 35, 'A0 in Pediology', 'Married'),
('BH020', 'Uwase Germaine', 45, 'A0 in Pediology', 'Married'),
('BHP001', 'MUGABO Malthus', 35, 'A0 in ICT', 'Married'),
('BHP002', 'ISHIMWE Noela', 29, 'A0 in ICT', 'single');

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `id` int(11) NOT NULL,
  `filename` varchar(20) NOT NULL,
  `filesize` int(11) NOT NULL,
  `filetype` varchar(100) NOT NULL,
  `upload_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`id`, `filename`, `filesize`, `filetype`, `upload_date`) VALUES
(4, 'Admission Letter.pdf', 1314496, 'application/pdf', '2023-09-21 17:26:20'),
(7, 'INTEGRATED-POLYTECHN', 16332, 'image/webp', '2023-09-21 18:12:47');

-- --------------------------------------------------------

--
-- Table structure for table `polio`
--

CREATE TABLE `polio` (
  `Batchno` int(11) NOT NULL DEFAULT 0,
  `Schedule` varchar(25) NOT NULL DEFAULT '',
  `Status` varchar(5) NOT NULL DEFAULT '0',
  `Height` float DEFAULT 0,
  `Weight` float DEFAULT 0,
  `Dates` date DEFAULT NULL,
  `Sign` varchar(5) DEFAULT '0',
  `Schedule2` varchar(25) DEFAULT NULL,
  `Status2` varchar(5) DEFAULT NULL,
  `Height2` float DEFAULT NULL,
  `Weight2` float DEFAULT 0,
  `Date2` date DEFAULT NULL,
  `Sign2` varchar(5) NOT NULL DEFAULT '0',
  `Schedule3` varchar(25) NOT NULL DEFAULT '',
  `Status3` varchar(11) NOT NULL DEFAULT '0',
  `Height3` float DEFAULT 0,
  `Weight3` float DEFAULT 0,
  `Date3` date NOT NULL,
  `Sign3` varchar(11) NOT NULL DEFAULT '0',
  `Schedule4` varchar(25) NOT NULL DEFAULT '',
  `Status4` varchar(11) NOT NULL DEFAULT '0',
  `Height4` float DEFAULT 0,
  `Weight4` float DEFAULT 0,
  `Date4` date NOT NULL,
  `Sign4` varchar(11) NOT NULL DEFAULT '0',
  `Sms` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `polio`
--

INSERT INTO `polio` (`Batchno`, `Schedule`, `Status`, `Height`, `Weight`, `Dates`, `Sign`, `Schedule2`, `Status2`, `Height2`, `Weight2`, `Date2`, `Sign2`, `Schedule3`, `Status3`, `Height3`, `Weight3`, `Date3`, `Sign3`, `Schedule4`, `Status4`, `Height4`, `Weight4`, `Date4`, `Sign4`, `Sms`) VALUES
(1405864239, 'At Birth', 'Yes', 2, 3, '2023-10-01', 'No', '', '', 0, 0, '0000-00-00', '', '', '', 0, 0, '0000-00-00', '', '', '', 0, 0, '0000-00-00', 'Yes', '2023-12-30');

-- --------------------------------------------------------

--
-- Table structure for table `trash`
--

CREATE TABLE `trash` (
  `Batchno` int(11) NOT NULL,
  `Bcg_status` varchar(25) DEFAULT NULL,
  `Bcg_date` date NOT NULL DEFAULT '0000-00-00',
  `Polio1_status` varchar(25) DEFAULT NULL,
  `Polio1_date` date DEFAULT '0000-00-00',
  `Polio2_status` varchar(25) DEFAULT NULL,
  `Polio2_date` date NOT NULL DEFAULT '0000-00-00',
  `Polio3_status` varchar(25) DEFAULT NULL,
  `Polio3_date` date NOT NULL DEFAULT '0000-00-00',
  `Polio4_status` varchar(25) DEFAULT NULL,
  `Polio4_date` date NOT NULL DEFAULT '0000-00-00',
  `Status` varchar(25) DEFAULT NULL,
  `deletion_date` varchar(10) DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `trash`
--

INSERT INTO `trash` (`Batchno`, `Bcg_status`, `Bcg_date`, `Polio1_status`, `Polio1_date`, `Polio2_status`, `Polio2_date`, `Polio3_status`, `Polio3_date`, `Polio4_status`, `Polio4_date`, `Status`, `deletion_date`) VALUES
(1405864239, 'Yes', '2023-09-28', 'Yes', '2023-09-28', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', ''),
(1405864239, 'Yes', '2023-09-28', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', 'Deleted', ''),
(1405864239, 'Yes', '2023-09-28', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', 'Deleted', '2023-09-28'),
(1405864239, 'Yes', '2023-09-30', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', 'Deleted', 'null');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` varchar(10) NOT NULL,
  `Username` text NOT NULL,
  `Password` text NOT NULL,
  `Role` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `Username`, `Password`, `Role`) VALUES
('BHP001', 'Malthus', '$2y$10$WI6oiG5gix15p4N5B4p3be1E5k5bPqFfjeA.XYYzYxWbz4QNPTww.', 'Admin'),
('BH001', 'Lambert', '$2y$10$vjKIL0J7ekqrvIRWAodJluSgXdiT5AGq9Vwbyg.PhL36OJrxZ.C1a', 'Pediatrician'),
('BH020', 'Mutware', '$2y$10$sA1SmaKibbAjme6zznM7NenUI6TRqzKHhYWGixo8IbLaXGcbbkqy.', 'Pediatrician'),
('BHP002', 'Noella', '$2y$10$JMphwEWS13938eyEsmByLObl5FhqguCvYa3L3apA9sJxYjKtFYDcO', 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `vaccination_data`
--

CREATE TABLE `vaccination_data` (
  `Child_names` varchar(25) NOT NULL,
  `Dob` varchar(25) NOT NULL,
  `Sex` varchar(10) NOT NULL,
  `Father_name` varchar(25) NOT NULL,
  `Father_id` int(11) NOT NULL,
  `Father_phone` varchar(25) NOT NULL,
  `Mother_name` varchar(25) NOT NULL,
  `Mother_id` int(11) NOT NULL,
  `Mother_phone` varchar(25) NOT NULL,
  `Province` varchar(25) NOT NULL,
  `District` varchar(25) NOT NULL,
  `Sector` varchar(25) NOT NULL,
  `Cell` varchar(25) NOT NULL,
  `Village` varchar(25) NOT NULL,
  `Care_taker` varchar(5) NOT NULL,
  `Pregnancy_number` int(11) NOT NULL,
  `Twins_or_more` varchar(5) NOT NULL,
  `Weight_at_birth` int(11) NOT NULL,
  `Height_at_birth` int(11) NOT NULL,
  `Batchno` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vaccination_data`
--

INSERT INTO `vaccination_data` (`Child_names`, `Dob`, `Sex`, `Father_name`, `Father_id`, `Father_phone`, `Mother_name`, `Mother_id`, `Mother_phone`, `Province`, `District`, `Sector`, `Cell`, `Village`, `Care_taker`, `Pregnancy_number`, `Twins_or_more`, `Weight_at_birth`, `Height_at_birth`, `Batchno`) VALUES
('Ishimwe David', '12/12/2001', 'Male', 'Ruboneka chales', 12345678, '781481685', 'Mukantabana Odette', 12463654, '783040365', 'Nothern', 'Gicumbi', 'Kageyo', 'Gihembe', 'Nyamabuye', 'Yes', 1, 'No', 12, 12, 649820924),
('Ishimwe David', '12/12/2001', 'Male', 'Ruboneka chales', 12345678, '781481685', 'Mukantabana Odette', 12463654, '783040365', 'Nothern', 'Gicumbi', 'Kageyo', 'Gihembe', 'Nyamabuye', 'No', 11093, 'No', 2, 13, 899797511),
('Ishimwe David', '12/12/2001', 'Femaie', 'Ruboneka chales', 12345678, '781481685', 'Mukantabana Odette', 12463654, '783040365', 'Nothern', 'Gicumbi', 'Kageyo', 'Gihembe', 'Nyamabuye', 'Yes', 13, 'No', 1, 70, 1405864239);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `announcements`
--
ALTER TABLE `announcements`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `bcg`
--
ALTER TABLE `bcg`
  ADD KEY `bcg` (`Batchno`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `polio`
--
ALTER TABLE `polio`
  ADD KEY `polio` (`Batchno`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD KEY `users` (`ID`);

--
-- Indexes for table `vaccination_data`
--
ALTER TABLE `vaccination_data`
  ADD PRIMARY KEY (`Batchno`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `announcements`
--
ALTER TABLE `announcements`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bcg`
--
ALTER TABLE `bcg`
  ADD CONSTRAINT `bcg` FOREIGN KEY (`Batchno`) REFERENCES `vaccination_data` (`Batchno`);

--
-- Constraints for table `polio`
--
ALTER TABLE `polio`
  ADD CONSTRAINT `polio` FOREIGN KEY (`Batchno`) REFERENCES `vaccination_data` (`Batchno`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users` FOREIGN KEY (`ID`) REFERENCES `employees` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
