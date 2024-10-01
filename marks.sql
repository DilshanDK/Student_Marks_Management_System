-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 01, 2024 at 07:42 PM
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
  `attempt_1` varchar(2) NOT NULL DEFAULT 'AB',
  `attempt_2` varchar(2) NOT NULL DEFAULT 'AB',
  `attempt_3` varchar(2) NOT NULL DEFAULT 'AB'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attempt_marks`
--

INSERT INTO `attempt_marks` (`st_id`, `sub_id`, `attempt_1`, `attempt_2`, `attempt_3`) VALUES
('KAN/IT/2022/F/001', 1032, '45', '84', 'AB'),
('KAN/IT/2022/F/002', 1032, '89', 'AB', 'AB'),
('KAN/IT/2022/F/003', 1032, '89', 'AB', 'AB'),
('KAN/IT/2022/F/004', 1032, '45', 'AB', '68'),
('KAN/IT/2022/F/005', 1032, '87', 'AB', 'AB'),
('KAN/IT/2022/F/006', 1032, '96', 'AB', 'AB'),
('KAN/IT/2022/F/007', 1032, '41', '52', '80'),
('KAN/IT/2022/F/008', 1032, '78', 'AB', 'AB'),
('KAN/IT/2022/F/009', 1032, '45', 'AB', '87'),
('KAN/IT/2022/F/010', 1032, 'AB', '68', '78'),
('KAN/IT/2022/F/011', 1032, '54', '72', 'AB'),
('KAN/IT/2022/F/012', 1032, '25', '72', 'AB'),
('KAN/IT/2022/F/013', 1032, '54', '84', 'AB'),
('KAN/IT/2022/F/014', 1032, '45', '64', '56'),
('KAN/IT/2022/F/015', 1032, '48', 'AB', '78'),
('KAN/IT/2022/F/016', 1032, '89', 'AB', 'AB'),
('KAN/IT/2022/F/017', 1032, 'AB', '72', '90'),
('KAN/IT/2022/F/018', 1032, '23', '72', '89'),
('KAN/IT/2022/F/019', 1032, '74', '50', 'AB'),
('KAN/IT/2022/F/020', 1032, '46', 'AB', '78');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `dep_id` int(11) NOT NULL,
  `dep_name` varchar(20) NOT NULL,
  `dep_dec` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`dep_id`, `dep_name`, `dep_dec`) VALUES
(30, 'hndit', 'High National Diploma in Information Technology'),
(31, 'hnda', 'High National Diploma in Accounting '),
(32, 'hndm', 'High National Diploma in Management'),
(33, 'hndthm', 'High National Diploma in Tourism and Hospitality Management'),
(34, 'hndeng', 'High National Diploma in English'),
(35, 'hndba', 'High National Diploma in Business Administration');

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
-- Table structure for table `result`
--

CREATE TABLE `result` (
  `st_id` varchar(100) NOT NULL,
  `sub_id` int(11) NOT NULL,
  `acd_year` year(4) DEFAULT NULL,
  `attempt_1` varchar(5) NOT NULL,
  `attempt_2` varchar(5) DEFAULT NULL,
  `attempt_3` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `result`
--

INSERT INTO `result` (`st_id`, `sub_id`, `acd_year`, `attempt_1`, `attempt_2`, `attempt_3`) VALUES
('kan-it-2022-f-0001', 1012, 2022, '35', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `st_id` varchar(30) NOT NULL,
  `st_name` varchar(100) NOT NULL,
  `st_pass` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`st_id`, `st_name`, `st_pass`) VALUES
('KAN/IT/2022/F/001', 'B.G.W.T.H. Bandara', '123'),
('KAN/IT/2022/F/002', 'V.W.P.C. Hulangamuwa', '123'),
('KAN/IT/2022/F/003', 'G.G.I.U. dangolla', '123'),
('KAN/IT/2022/F/004', 'H.P.G.S. Amarasinghe', '123'),
('KAN/IT/2022/F/005', 'B.W.L.G.L.C. WELIANGA', '123'),
('KAN/IT/2022/F/006', 'N.G.O.K. SILVA', '123'),
('KAN/IT/2022/F/007', 'B.G.R.D. Perera', '123'),
('KAN/IT/2022/F/008', 'F. NajlaHamza', '123'),
('KAN/IT/2022/F/009', 'T.M.Y.C. Bandara', '123'),
('KAN/IT/2022/F/010', 'A.N.L. NUHA', '123'),
('KAN/IT/2022/F/011', 'V. Vishalini', '123'),
('KAN/IT/2022/F/012', 'M.N.F. Nafla', '123'),
('KAN/IT/2022/F/013', 'S.M.N.F. Hathika', '123'),
('KAN/IT/2022/F/014', 'M.F.F. Farha', '123'),
('KAN/IT/2022/F/015', 'E.W.B.W.M.R.C.D.B. WIJERATHNA', '123'),
('KAN/IT/2022/F/016', 'A.F. Ashrifa', '123'),
('KAN/IT/2022/F/017', 'V.S. Rajapaksha', '123'),
('KAN/IT/2022/F/018', 'R.M.G.S.I. BANDARA', '123'),
('KAN/IT/2022/F/019', 'E.M.H.N.M. EKANAYAKE', '123'),
('KAN/IT/2022/F/020', 'M.P.F. Farjana', '123'),
('KAN/IT/2022/F/021', 'H.M.H. Shereen', '123'),
('KAN/IT/2022/F/022', 'K.A. Shara', '123'),
('KAN/IT/2022/F/023', 'S.S. POLWATHTHA', '123'),
('KAN/IT/2022/F/024', 'M.N.F. NUHA', '123'),
('KAN/IT/2022/F/025', 'M.A.T.D. Mapalagama', '123'),
('KAN/IT/2022/F/026', 'M.I.A. Samah', '123'),
('KAN/IT/2022/F/027', 'R.F. Nisma', '123'),
('KAN/IT/2022/F/028', 'V.T. SAMARAKOON', '123'),
('KAN/IT/2022/F/029', 'K.G.M.M. NAVANJANA', '123'),
('KAN/IT/2022/F/030', 'I. Imroos', '123'),
('KAN/IT/2022/F/031', 'M.I.F. RIFKA', '123'),
('KAN/IT/2022/F/032', 'H. Husna', '123'),
('KAN/IT/2022/F/033', 'C.H.B. FERNANDO', '123'),
('KAN/IT/2022/F/034', 'M.R.F. ILMA', '123'),
('KAN/IT/2022/F/035', 'M.P. Lakshini', '123'),
('KAN/IT/2022/F/036', 'M.M. SAFEEYA', '123'),
('KAN/IT/2022/F/037', 'M.Z.F. RIFKA', '123'),
('KAN/IT/2022/F/040', 'M.I.I. AHAMED', '123'),
('KAN/IT/2022/F/041', 'S.M.M.D. SAMARAKOON', '123'),
('KAN/IT/2022/F/043', 'R.K.D.V. Rajapaksha', '123'),
('KAN/IT/2022/F/044', 'E.M.K.P. Rathnayaka.', '123'),
('KAN/IT/2022/F/045', 'H.K. Manamperi', '123'),
('KAN/IT/2022/F/046', 'K. Thiluckshini', '123'),
('KAN/IT/2022/F/047', 'J. Priyadharshani', '123'),
('KAN/IT/2022/F/048', 'M. KRISHNANATH', '123'),
('KAN/IT/2022/F/049', 'M.I.F. Hidhaya', '123'),
('KAN/IT/2022/F/052', 'H.R.M.D.M. RATHNAYAKA', '123'),
('KAN/IT/2022/F/053', 'A.G.D.D. Wijerathne', '123'),
('KAN/IT/2022/F/054', 'A.G.T.M. ROOPASINGHA', '123'),
('KAN/IT/2022/F/055', 'K.G.D.M.E. JAYARATHNA', '123'),
('KAN/IT/2022/F/057', 'D. SADHURKA', '123'),
('KAN/IT/2022/F/058', 'G.L. Manodya', '123'),
('KAN/IT/2022/F/059', 'M.F.F. Samha', '123'),
('KAN/IT/2022/F/060', 'W.I.U. JAYARATHNA', '123'),
('KAN/IT/2022/F/062', 'K.M.D.D. BANDARA', '123'),
('KAN/IT/2022/F/063', 'B.M.D. BASNAYAKA', '123'),
('KAN/IT/2022/F/064', 'G. Dharshika', '123'),
('KAN/IT/2022/F/065', 'M.G.I.D. samarasinghe', '123'),
('KAN/IT/2022/F/067', 'D.G.I. Ransika', '123'),
('KAN/IT/2022/F/068', 'M.R. Hafsa', '123'),
('KAN/IT/2022/F/070', 'P.W.G.D.K. Chandrarathna', '123'),
('KAN/IT/2022/F/072', 'T.T.D. Thumpalage', '123'),
('KAN/IT/2022/F/073', 'W.G.K. Ariyawansha', '123'),
('KAN/IT/2022/F/074', 'E.M.A.K.B. Ekanayake', '123'),
('KAN/IT/2022/F/075', 'H.S.N. HORAGOLLA', '123'),
('KAN/IT/2022/F/076', 'A.D.Y.A. Hewawasam', '123'),
('KAN/IT/2022/F/077', 'I.M.A.D. JAYASINGHE', '123'),
('KAN/IT/2022/F/079', 'G.G.C.W. GALANGA', '123'),
('KAN/IT/2022/F/080', 'P. kavinpriya', '123'),
('KAN/IT/2022/F/081', 'M.P. SUHADHA', '123'),
('KAN/IT/2022/F/082', 'W.K. Ariyawansha', '123'),
('KAN/IT/2022/F/083', 'M.F. Hikma', '123'),
('KAN/IT/2022/F/084', 'M.T.F. Ifna', '123'),
('KAN/IT/2022/F/086', 'K.R.C.P. Kodagoda', '123'),
('KAN/IT/2022/F/087', 'B.G.A.I. Bathalawaththa', '123'),
('KAN/IT/2022/F/088', 'K.A.S.S. Nadeesharika', '123'),
('KAN/IT/2022/F/090', 'M.N.R. KUBRA', '123'),
('KAN/IT/2022/F/091', 'H.G. Hasantha', '123'),
('KAN/IT/2022/F/092', 'J.M. IHSHAN', '123'),
('KAN/IT/2022/F/093', 'M.S.M. Zagib', '123'),
('KAN/IT/2022/F/094', 'M.M.F. Shabeeha', '123'),
('KAN/IT/2022/F/096', 'B.G.N.T. Devindi', '123'),
('KAN/IT/2022/F/097', 'P.A.D.P. Perumbuliarachchi', '123'),
('KAN/IT/2022/F/098', 'W.M.S.L. Wijesooriya', '123'),
('KAN/IT/2022/F/100', 'M.N. Zainab', '123'),
('KAN/IT/2022/F/101', 'M.R.F. Hafsa', '123'),
('KAN/IT/2022/F/102', 'M.R.S. Izzath', '123'),
('KAN/IT/2022/F/103', 'G.G.J.S.P.K. Guwarathenna', '123'),
('KAN/IT/2022/F/104', 'M.D.G.D.A. Sandaruwan', '123'),
('KAN/IT/2022/F/105', 'D.M.A.M. Dissanayake', '123'),
('KAN/IT/2022/F/106', 'M.G.G.S. Samuditha', '123'),
('KAN/IT/2022/F/107', 'M. Dushanthani', '123'),
('KAN/IT/2022/F/108', 'T. Yathurshini', '123'),
('KAN/IT/2022/F/109', 'A.P. Vimansika', '123'),
('KAN/IT/2022/F/110', 'H.M.S.H. Herath', '123'),
('KAN/IT/2022/F/112', 'A.G.M. Arshad', '123'),
('KAN/IT/2023/F/001', 'B.G.W.T.H. Bandara', '123'),
('KAN/IT/2023/F/002', 'V.W.P.C. Hulangamuwa', '123'),
('KAN/IT/2023/F/003', 'G.G.I.U. dangolla', '123'),
('KAN/IT/2023/F/004', 'H.P.G.S. Amarasinghe', '123'),
('KAN/IT/2023/F/005', 'B.W.L.G.L.C. WELIANGA', '123'),
('KAN/IT/2023/F/006', 'N.G.O.K. SILVA', '123'),
('KAN/IT/2023/F/007', 'B.G.R.D. Perera', '123'),
('KAN/IT/2023/F/008', 'F. NajlaHamza', '123'),
('KAN/IT/2023/F/009', 'T.M.Y.C. Bandara', '123'),
('KAN/IT/2023/F/010', 'A.N.L. NUHA', '123'),
('KAN/IT/2023/F/011', 'V. Vishalini', '123'),
('KAN/IT/2023/F/012', 'M.N.F. Nafla', '123'),
('KAN/IT/2023/F/013', 'S.M.N.F. Hathika', '123'),
('KAN/IT/2023/F/014', 'M.F.F. Farha', '123'),
('KAN/IT/2023/F/015', 'E.W.B.W.M.R.C.D.B. WIJERATHNA', '123'),
('KAN/IT/2023/F/016', 'A.F. Ashrifa', '123'),
('KAN/IT/2023/F/017', 'V.S. Rajapaksha', '123'),
('KAN/IT/2023/F/018', 'R.M.G.S.I. BANDARA', '123'),
('KAN/IT/2023/F/019', 'E.M.H.N.M. EKANAYAKE', '123'),
('KAN/IT/2023/F/020', 'M.P.F. Farjana', '123'),
('KAN/IT/2023/F/021', 'H.M.H. Shereen', '123'),
('KAN/IT/2023/F/022', 'K.A. Shara', '123'),
('KAN/IT/2023/F/023', 'S.S. POLWATHTHA', '123'),
('KAN/IT/2023/F/024', 'M.N.F. NUHA', '123'),
('KAN/IT/2023/F/025', 'M.A.T.D. Mapalagama', '123'),
('KAN/IT/2023/F/026', 'M.I.A. Samah', '123'),
('KAN/IT/2023/F/027', 'R.F. Nisma', '123'),
('KAN/IT/2023/F/028', 'V.T. SAMARAKOON', '123'),
('KAN/IT/2023/F/029', 'K.G.M.M. NAVANJANA', '123'),
('KAN/IT/2023/F/030', 'I. Imroos', '123'),
('KAN/IT/2023/F/031', 'M.I.F. RIFKA', '123'),
('KAN/IT/2023/F/032', 'H. Husna', '123'),
('KAN/IT/2023/F/033', 'C.H.B. FERNANDO', '123'),
('KAN/IT/2023/F/034', 'M.R.F. ILMA', '123'),
('KAN/IT/2023/F/035', 'M.P. Lakshini', '123'),
('KAN/IT/2023/F/036', 'M.M. SAFEEYA', '123'),
('KAN/IT/2023/F/037', 'M.Z.F. RIFKA', '123'),
('KAN/IT/2023/F/038', 'M.I.I. AHAMED', '123'),
('KAN/IT/2023/F/039', 'S.M.M.D. SAMARAKOON', '123'),
('KAN/IT/2023/F/040', 'R.K.D.V. Rajapaksha', '123'),
('KAN/IT/2023/F/041', 'E.M.K.P. Rathnayaka.', '123'),
('KAN/IT/2023/F/042', 'H.K. Manamperi', '123'),
('KAN/IT/2023/F/043', 'K. Thiluckshini', '123'),
('KAN/IT/2023/F/044', 'J. Priyadharshani', '123'),
('KAN/IT/2023/F/045', 'M. KRISHNANATH', '123'),
('KAN/IT/2023/F/046', 'M.I.F. Hidhaya', '123'),
('KAN/IT/2023/F/047', 'H.R.M.D.M. RATHNAYAKA', '123'),
('KAN/IT/2023/F/048', 'A.G.D.D. Wijerathne', '123'),
('KAN/IT/2023/F/049', 'A.G.T.M. ROOPASINGHA', '123'),
('KAN/IT/2023/F/050', 'K.G.D.M.E. JAYARATHNA', '123'),
('KAN/IT/2023/F/051', 'D. SADHURKA', '123'),
('KAN/IT/2023/F/052', 'G.L. Manodya', '123'),
('KAN/IT/2023/F/053', 'M.F.F. Samha', '123'),
('KAN/IT/2023/F/054', 'W.I.U. JAYARATHNA', '123'),
('KAN/IT/2023/F/055', 'K.M.D.D. BANDARA', '123'),
('KAN/IT/2023/F/056', 'B.M.D. BASNAYAKA', '123'),
('KAN/IT/2023/F/057', 'G. Dharshika', '123'),
('KAN/IT/2023/F/058', 'M.G.I.D. samarasinghe', '123'),
('KAN/IT/2023/F/059', 'D.G.I. Ransika', '123'),
('KAN/IT/2023/F/060', 'M.R. Hafsa', '123'),
('KAN/IT/2023/F/061', 'P.W.G.D.K. Chandrarathna', '123'),
('KAN/IT/2023/F/062', 'T.T.D. Thumpalage', '123'),
('KAN/IT/2023/F/063', 'W.G.K. Ariyawansha', '123'),
('KAN/IT/2023/F/064', 'E.M.A.K.B. Ekanayake', '123'),
('KAN/IT/2023/F/065', 'H.S.N. HORAGOLLA', '123'),
('KAN/IT/2023/F/066', 'A.D.Y.A. Hewawasam', '123'),
('KAN/IT/2023/F/067', 'I.M.A.D. JAYASINGHE', '123'),
('KAN/IT/2023/F/068', 'G.G.C.W. GALANGA', '123'),
('KAN/IT/2023/F/069', 'P. kavinpriya', '123'),
('KAN/IT/2023/F/070', 'M.P. SUHADHA', '123'),
('KAN/IT/2023/F/071', 'W.K. Ariyawansha', '123'),
('KAN/IT/2023/F/072', 'M.F. Hikma', '123'),
('KAN/IT/2023/F/073', 'M.T.F. Ifna', '123'),
('KAN/IT/2023/F/074', 'K.R.C.P. Kodagoda', '123'),
('KAN/IT/2023/F/075', 'B.G.A.I. Bathalawaththa', '123'),
('KAN/IT/2023/F/076', 'K.A.S.S. Nadeesharika', '123'),
('KAN/IT/2023/F/077', 'M.N.R. KUBRA', '123'),
('KAN/IT/2023/F/078', 'H.G. Hasantha', '123'),
('KAN/IT/2023/F/079', 'J.M. IHSHAN', '123'),
('KAN/IT/2023/F/080', 'M.S.M. Zagib', '123'),
('KAN/IT/2023/F/081', 'M.M.F. Shabeeha', '123'),
('KAN/IT/2023/F/082', 'B.G.N.T. Devindi', '123'),
('KAN/IT/2023/F/083', 'P.A.D.P. Perumbuliarachchi', '123'),
('KAN/IT/2023/F/084', 'W.M.S.L. Wijesooriya', '123'),
('KAN/IT/2023/F/085', 'M.N. Zainab', '123'),
('KAN/IT/2023/F/086', 'M.R.F. Hafsa', '123'),
('KAN/IT/2023/F/087', 'M.R.S. Izzath', '123'),
('KAN/IT/2023/F/088', 'G.G.J.S.P.K. Guwarathenna', '123'),
('KAN/IT/2023/F/089', 'M.D.G.D.A. Sandaruwan', '123'),
('KAN/IT/2023/F/090', 'D.M.A.M. Dissanayake', '123'),
('KAN/IT/2023/F/091', 'M.G.G.S. Samuditha', '123'),
('KAN/IT/2023/F/092', 'M. Dushanthani', '123'),
('KAN/IT/2023/F/093', 'T. Yathurshini', '123'),
('KAN/IT/2023/F/094', 'A.P. Vimansika', '123'),
('KAN/IT/2023/F/095', 'H.M.S.H. Herath', '123'),
('KAN/IT/2023/F/096', 'A.G.M. Arshad', '123');

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `sub_id` int(11) NOT NULL,
  `sub_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`sub_id`, `sub_name`) VALUES
(1012, 'C#'),
(1022, 'web'),
(1032, 'network'),
(1042, 'mis'),
(1052, 'eng');

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
-- Indexes for table `result`
--
ALTER TABLE `result`
  ADD PRIMARY KEY (`st_id`,`sub_id`),
  ADD KEY `sub_id` (`sub_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`st_id`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`sub_id`);

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
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `dep_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

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
  ADD CONSTRAINT `attempt_marks_ibfk_2` FOREIGN KEY (`sub_Id`) REFERENCES `subject` (`sub_id`);

--
-- Constraints for table `result`
--
ALTER TABLE `result`
  ADD CONSTRAINT `result_ibfk_1` FOREIGN KEY (`st_id`) REFERENCES `student` (`st_id`),
  ADD CONSTRAINT `result_ibfk_2` FOREIGN KEY (`sub_id`) REFERENCES `subject` (`sub_id`);

--
-- Constraints for table `subject_lecture`
--
ALTER TABLE `subject_lecture`
  ADD CONSTRAINT `subject_lecture_ibfk_1` FOREIGN KEY (`sub_id`) REFERENCES `subject` (`sub_id`),
  ADD CONSTRAINT `subject_lecture_ibfk_2` FOREIGN KEY (`lec_id`) REFERENCES `lecture` (`lec_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
