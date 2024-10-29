-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 29, 2024 at 07:51 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `marks`
--

-- --------------------------------------------------------

--
-- Table structure for table `attempt_marks`
--

CREATE TABLE `attempt_marks` (
  `st_id` varchar(100) NOT NULL,
  `sub_id` int(11) NOT NULL,
  `fir_year` year(4) NOT NULL,
  `attempt_1` varchar(2) NOT NULL DEFAULT 'AB',
  `sec_year` year(4) NOT NULL,
  `attempt_2` varchar(2) NOT NULL DEFAULT 'AB',
  `thir_year` year(4) NOT NULL,
  `attempt_3` varchar(2) NOT NULL DEFAULT 'AB'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attempt_marks`
--

INSERT INTO `attempt_marks` (`st_id`, `sub_id`, `fir_year`, `attempt_1`, `sec_year`, `attempt_2`, `thir_year`, `attempt_3`) VALUES
('KAN/IT/2022/F/001', 1032, 2022, '78', 2023, '78', 2024, '45'),
('KAN/IT/2022/F/002', 1032, 2022, '45', 2023, '45', 2025, 'AB'),
('KAN/IT/2022/F/003', 1032, 2022, '98', 2023, 'AB', 2024, '45'),
('KAN/IT/2022/F/004', 1032, 2022, '23', 2023, 'AB', 2024, '68'),
('KAN/IT/2022/F/005', 1032, 2022, '45', 2023, 'AB', 2026, 'AB'),
('KAN/IT/2022/F/006', 1032, 2022, '96', 2023, 'AB', 2024, 'AB'),
('KAN/IT/2022/F/007', 1032, 2022, '41', 2023, '52', 2024, '80'),
('KAN/IT/2022/F/008', 1032, 2022, '78', 2023, 'AB', 2026, 'AB'),
('KAN/IT/2022/F/009', 1032, 2022, '45', 2023, 'AB', 2025, '87'),
('KAN/IT/2022/F/010', 1032, 2022, 'AB', 2023, '68', 2024, '78'),
('KAN/IT/2022/F/011', 1032, 2022, '54', 2023, '72', 2025, 'AB'),
('KAN/IT/2022/F/012', 1032, 2022, '25', 2023, '72', 2024, 'AB'),
('KAN/IT/2022/F/013', 1032, 2022, '54', 2023, '84', 2025, 'AB'),
('KAN/IT/2022/F/014', 1032, 2022, '45', 2023, '64', 2026, '56'),
('KAN/IT/2022/F/015', 1032, 2022, '48', 2023, '50', 2025, '78'),
('KAN/IT/2022/F/016', 1032, 2022, '89', 2023, 'AB', 2026, 'AB'),
('KAN/IT/2022/F/017', 1032, 2022, 'AB', 2023, '72', 2024, '90'),
('KAN/IT/2022/F/018', 1032, 2022, '23', 2023, '72', 2024, '89'),
('KAN/IT/2022/F/019', 1032, 2022, '74', 2023, '50', 2024, 'AB'),
('KAN/IT/2022/F/020', 1032, 2022, '46', 2023, 'AB', 2026, '78'),
('KAN/IT/2023/F/002', 1032, 2023, 'AB', 2025, '56', 2027, 'AB'),
('KAN/IT/2023/F/011', 1032, 2023, '45', 2024, '89', 2029, 'AB'),
('KAN/IT/2022/F/001', 1012, 2022, '45', 2024, '78', 2025, '89'),
('KAN/IT/2022/F/001', 1022, 2023, 'AB', 2025, 'AB', 2027, 'AB'),
('KAN/IT/2022/F/001', 1042, 2023, 'AB', 2024, 'AB', 2029, 'AB'),
('KAN/IT/2022/F/001', 1052, 2023, 'AB', 2025, 'AB', 2027, 'AB');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `dep_id` varchar(20) NOT NULL,
  `dep_dec` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`dep_id`, `dep_dec`) VALUES
('ac', 'High National Diploma in Accounting '),
('ba', 'High National Diploma in Business Administration'),
('en', 'High National Diploma in English'),
('it', 'High National Diploma in Information Technology'),
('mg', 'High National Diploma in Management'),
('th', 'High National Diploma in Tourism and Hospitality Management');

-- --------------------------------------------------------

--
-- Table structure for table `lecture`
--

CREATE TABLE `lecture` (
  `lec_id` int(11) NOT NULL,
  `lec_name` varchar(100) NOT NULL,
  `lec_email` varchar(100) NOT NULL,
  `lec_pass` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lecture`
--

INSERT INTO `lecture` (`lec_id`, `lec_name`, `lec_email`, `lec_pass`) VALUES
(100, 'amara', 'amara@email.com', '456'),
(101, 'kamal', 'kama@email.com', '456'),
(102, 'nimal', 'nimal@email.com', '456'),
(103, 'perera', 'perera@email.com', '456'),
(104, 'sunil', 'sunil@email.com', '456');

-- --------------------------------------------------------

--
-- Table structure for table `period`
--

CREATE TABLE `period` (
  `period_id` int(11) NOT NULL,
  `period_sem` int(1) NOT NULL,
  `period_year` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `period`
--

INSERT INTO `period` (`period_id`, `period_sem`, `period_year`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 1),
(4, 2, 2),
(5, 3, 1),
(6, 3, 2),
(7, 4, 1),
(8, 4, 2);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `st_id` varchar(30) NOT NULL,
  `st_name` varchar(100) NOT NULL,
  `st_loc` varchar(3) NOT NULL,
  `st_dep` varchar(20) NOT NULL,
  `st_reg_year` year(4) NOT NULL,
  `st_pass` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`st_id`, `st_name`, `st_loc`, `st_dep`, `st_reg_year`, `st_pass`) VALUES
('KAN/IT/2022/F/001', 'B.G.W.T.H. Bandara', 'kan', 'it', 2022, '123'),
('KAN/IT/2022/F/002', 'V.W.P.C. Hulangamuwa', 'kan', 'it', 2022, '123'),
('KAN/IT/2022/F/003', 'G.G.I.U. dangolla', 'kan', 'it', 2022, '123'),
('KAN/IT/2022/F/004', 'H.P.G.S. Amarasinghe', 'kan', 'it', 2022, '123'),
('KAN/IT/2022/F/005', 'B.W.L.G.L.C. WELIANGA', 'kan', 'it', 2022, '123'),
('KAN/IT/2022/F/006', 'N.G.O.K. SILVA', 'kan', 'it', 2022, '123'),
('KAN/IT/2022/F/007', 'B.G.R.D. Perera', 'kan', 'it', 2022, '123'),
('KAN/IT/2022/F/008', 'F. NajlaHamza', 'kan', 'it', 2022, '123'),
('KAN/IT/2022/F/009', 'T.M.Y.C. Bandara', 'kan', 'it', 2022, '123'),
('KAN/IT/2022/F/010', 'A.N.L. NUHA', 'kan', 'it', 2022, '123'),
('KAN/IT/2022/F/011', 'V. Vishalini', 'kan', 'it', 2022, '123'),
('KAN/IT/2022/F/012', 'M.N.F. Nafla', 'kan', 'it', 2022, '123'),
('KAN/IT/2022/F/013', 'S.M.N.F. Hathika', 'kan', 'it', 2022, '123'),
('KAN/IT/2022/F/014', 'M.F.F. Farha', 'kan', 'it', 2022, '123'),
('KAN/IT/2022/F/015', 'E.W.B.W.M.R.C.D.B. WIJERATHNA', 'kan', 'it', 2022, '123'),
('KAN/IT/2022/F/016', 'A.F. Ashrifa', 'kan', 'it', 2022, '123'),
('KAN/IT/2022/F/017', 'V.S. Rajapaksha', 'kan', 'it', 2022, '123'),
('KAN/IT/2022/F/018', 'R.M.G.S.I. BANDARA', 'kan', 'it', 2022, '123'),
('KAN/IT/2022/F/019', 'E.M.H.N.M. EKANAYAKE', 'kan', 'it', 2022, '123'),
('KAN/IT/2022/F/020', 'M.P.F. Farjana', 'kan', 'it', 2022, '123'),
('KAN/IT/2023/F/001', 'B.G.W.T.H. Bandara', 'kan', 'it', 2023, '123'),
('KAN/IT/2023/F/002', 'V.W.P.C. Hulangamuwa', 'kan', 'it', 2023, '123'),
('KAN/IT/2023/F/003', 'G.G.I.U. dangolla', 'kan', 'it', 2023, '123'),
('KAN/IT/2023/F/004', 'H.P.G.S. Amarasinghe', 'kan', 'it', 2023, '123'),
('KAN/IT/2023/F/005', 'B.W.L.G.L.C. WELIANGA', 'kan', 'it', 2023, '123'),
('KAN/IT/2023/F/006', 'N.G.O.K. SILVA', 'kan', 'it', 2023, '123'),
('KAN/IT/2023/F/007', 'B.G.R.D. Perera', 'kan', 'it', 2023, '123'),
('KAN/IT/2023/F/008', 'F. NajlaHamza', 'kan', 'it', 2023, '123'),
('KAN/IT/2023/F/009', 'T.M.Y.C. Bandara', 'kan', 'it', 2023, '123'),
('KAN/IT/2023/F/010', 'A.N.L. NUHA', 'kan', 'it', 2023, '123'),
('KAN/IT/2023/F/011', 'V. Vishalini', 'kan', 'it', 2023, '123'),
('KAN/IT/2023/F/012', 'M.N.F. Nafla', 'kan', 'it', 2023, '123'),
('KAN/IT/2023/F/013', 'S.M.N.F. Hathika', 'kan', 'it', 2023, '123'),
('KAN/IT/2023/F/014', 'M.F.F. Farha', 'kan', 'it', 2023, '123'),
('KAN/IT/2023/F/015', 'E.W.B.W.M.R.C.D.B. WIJERATHNA', 'kan', 'it', 2023, '123'),
('KAN/IT/2023/F/016', 'A.F. Ashrifa', 'kan', 'it', 2023, '123'),
('KAN/IT/2023/F/017', 'V.S. Rajapaksha', 'kan', 'it', 2023, '123'),
('KAN/IT/2023/F/018', 'R.M.G.S.I. BANDARA', 'kan', 'it', 2023, '123'),
('KAN/IT/2023/F/019', 'E.M.H.N.M. EKANAYAKE', 'kan', 'it', 2023, '123'),
('KAN/IT/2023/F/020', 'M.P.F. Farjana', 'kan', 'it', 2023, '123');

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `sub_id` int(11) NOT NULL,
  `sub_name` varchar(100) DEFAULT NULL,
  `dep_id` varchar(20) NOT NULL,
  `per_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`sub_id`, `sub_name`, `dep_id`, `per_id`) VALUES
(1012, 'C#', 'it', 2),
(1022, 'web', 'it', 1),
(1032, 'network', 'it', 4),
(1042, 'mis', 'it', 1),
(1052, 'eng', 'it', 8);

-- --------------------------------------------------------

--
-- Table structure for table `subject_lecture`
--

CREATE TABLE `subject_lecture` (
  `sub_id` int(11) NOT NULL,
  `lec_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subject_lecture`
--

INSERT INTO `subject_lecture` (`sub_id`, `lec_id`) VALUES
(1012, 100),
(1022, 101),
(1032, 102),
(1042, 103),
(1052, 104);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attempt_marks`
--
ALTER TABLE `attempt_marks`
  ADD KEY `st_id` (`st_id`),
  ADD KEY `sub_Id` (`sub_id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`dep_id`);

--
-- Indexes for table `lecture`
--
ALTER TABLE `lecture`
  ADD PRIMARY KEY (`lec_id`);

--
-- Indexes for table `period`
--
ALTER TABLE `period`
  ADD PRIMARY KEY (`period_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`st_id`),
  ADD KEY `st_dep` (`st_dep`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`sub_id`),
  ADD KEY `dep_id` (`dep_id`),
  ADD KEY `per_id` (`per_id`);

--
-- Indexes for table `subject_lecture`
--
ALTER TABLE `subject_lecture`
  ADD PRIMARY KEY (`sub_id`,`lec_id`),
  ADD KEY `lec_id` (`lec_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `lecture`
--
ALTER TABLE `lecture`
  MODIFY `lec_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT for table `period`
--
ALTER TABLE `period`
  MODIFY `period_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attempt_marks`
--
ALTER TABLE `attempt_marks`
  ADD CONSTRAINT `attempt_marks_ibfk_1` FOREIGN KEY (`st_id`) REFERENCES `student` (`st_id`),
  ADD CONSTRAINT `attempt_marks_ibfk_2` FOREIGN KEY (`sub_id`) REFERENCES `subject` (`sub_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
