-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 23, 2024 at 10:35 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `prescripsmart`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_ID` int(11) NOT NULL,
  `first_Name` varchar(20) NOT NULL,
  `last_Name` varchar(40) NOT NULL,
  `email` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_ID`, `first_Name`, `last_Name`, `email`) VALUES
(1, 'mohammed', 'mushahid', 'abd@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `appointment_ID` int(11) NOT NULL,
  `patient_ID` int(11) NOT NULL,
  `doctor_ID` int(11) NOT NULL,
  `session_ID` int(11) NOT NULL,
  `time` time NOT NULL,
  `date` date NOT NULL,
  `status` varchar(256) NOT NULL,
  `token_No` int(5) NOT NULL,
  `amount` int(11) NOT NULL,
  `payment_status` text NOT NULL,
  `payment_ID` int(11) NOT NULL,
  `method` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`appointment_ID`, `patient_ID`, `doctor_ID`, `session_ID`, `time`, `date`, `status`, `token_No`, `amount`, `payment_status`, `payment_ID`, `method`) VALUES
(4, 12368, 12356, 58, '00:00:12', '2024-01-23', 'completed', 0, 0, 'PAID', 0, ''),
(5, 12355, 12358, 58, '00:00:12', '2023-12-08', 'completed', 0, 0, '', 0, ''),
(6, 12355, 12356, 58, '00:00:12', '2023-12-08', 'completed', 0, 0, '', 0, ''),
(111, 12368, 12356, 58, '19:00:00', '2024-04-19', 'completed', 0, 4000, 'UNPAID', 0, ''),
(112, 12368, 12356, 58, '19:00:00', '2024-04-19', 'cancelled', 2, 4000, 'UNPAID', 0, ''),
(113, 12368, 12356, 58, '19:20:00', '2024-04-19', 'active', 3, 4000, 'UNPAID', 0, ''),
(114, 12368, 12356, 58, '19:30:00', '2024-04-21', 'active', 4, 4000, 'PAID', 0, ''),
(115, 12368, 12356, 58, '19:40:00', '2024-04-21', 'active', 5, 4000, 'PAID', 0, ''),
(116, 12368, 12356, 58, '19:50:00', '2024-04-21', 'active', 6, 4000, 'UNPAID', 0, ''),
(117, 12368, 12356, 58, '20:00:00', '2024-04-23', 'active', 7, 4000, 'UNPAID', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `doctor_ID` int(11) NOT NULL,
  `first_Name` varchar(256) NOT NULL,
  `last_Name` varchar(256) NOT NULL,
  `display_Name` varchar(40) NOT NULL,
  `email` varchar(40) DEFAULT NULL,
  `contact_Number` int(10) DEFAULT NULL,
  `signIn_Method` varchar(10) NOT NULL,
  `home_Address` varchar(128) NOT NULL,
  `NIC` varchar(20) DEFAULT NULL,
  `specialization` varchar(256) NOT NULL,
  `gender` text NOT NULL,
  `registration_No` varchar(20) DEFAULT NULL,
  `qualifications` varchar(256) NOT NULL,
  `department` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`doctor_ID`, `first_Name`, `last_Name`, `display_Name`, `email`, `contact_Number`, `signIn_Method`, `home_Address`, `NIC`, `specialization`, `gender`, `registration_No`, `qualifications`, `department`) VALUES
(12356, 'Asanka', 'Rathanayake', 'Asanka Rathanayake', NULL, NULL, '', '', NULL, 'Cardiologist', 'Male', NULL, '', ''),
(12358, 'Saumya', 'Sewwandi', '', NULL, NULL, '', '', NULL, 'Physician', 'Female', NULL, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `healthsupervisors`
--

CREATE TABLE `healthsupervisors` (
  `supervisor_ID` int(11) NOT NULL,
  `first_Name` varchar(20) NOT NULL,
  `last_Name` varchar(50) NOT NULL,
  `display_Name` varchar(64) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `contact_Number` int(10) NOT NULL,
  `signIn_Method` varchar(10) NOT NULL,
  `home_Address` varchar(128) NOT NULL,
  `NIC` int(20) NOT NULL,
  `specialization` varchar(255) DEFAULT NULL,
  `gender` varchar(10) NOT NULL,
  `registration_No` varchar(20) NOT NULL,
  `qualifications` varchar(255) NOT NULL,
  `department` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `healthsupervisors`
--

INSERT INTO `healthsupervisors` (`supervisor_ID`, `first_Name`, `last_Name`, `display_Name`, `email`, `contact_Number`, `signIn_Method`, `home_Address`, `NIC`, `specialization`, `gender`, `registration_No`, `qualifications`, `department`) VALUES
(4, 'ahmed', 'samhan', NULL, 'ahmedsamhan@gmail.com', 762233456, '', '', 0, '', '', '', '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `inquiries`
--

CREATE TABLE `inquiries` (
  `inquiry_ID` int(11) NOT NULL,
  `patient_ID` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `message` varchar(512) NOT NULL,
  `reply` varchar(512) NOT NULL,
  `supervisor_ID` int(11) NOT NULL,
  `status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inquiries`
--

INSERT INTO `inquiries` (`inquiry_ID`, `patient_ID`, `email`, `name`, `message`, `reply`, `supervisor_ID`, `status`) VALUES
(1, 12368, 'mashawickramasinghe04@gmail.com', 'Masha Wickramasinghe', 'Hi. This is a test message', '', 0, 'awaiting reply'),
(2, 12368, 'senali123@gmail.com', 'Saumya Sewwandi', 'HI', '', 0, 'awaiting reply'),
(3, 12368, 'mashawickramasinghe04@gmail.com', 'Masha Wickramasinghe', 'HI test', '', 0, 'awaiting reply'),
(4, 12368, 'saumyasewwandi05@gmail.com', 'Saumya Sewwandi', 'hhhhh', '', 0, 'awaiting reply'),
(5, 12368, 'saumyasewwandi05@gmail.com', 'Saumya Sewwandi', 'hhhhhhhhhhhh', '', 0, 'awaiting reply'),
(6, 12368, 'senali123@gmail.com', 'Saumya Sewwandi', 'tttt', '', 0, 'awaiting reply'),
(7, 12368, 'ggg@gmail.com', 'hiii', 'ff', '', 0, 'awaiting reply'),
(8, 12368, 'mashawickramasinghe04@gmail.com', 'Masha Wickramasinghe', 'final', '', 0, 'awaiting reply'),
(9, 12368, 'mashawickramasinghe04@gmail.com', 'Masha Wickramasinghe', 'fff', '', 0, 'awaiting reply'),
(10, 12368, 'mashawickramasinghe04@gmail.com', 'senuri', 'This is a test message. Thank You!', '', 0, 'awaiting reply'),
(11, 12368, 'mashawickramasinghe04@gmail.com', 'senuri', 'T=EST', '', 0, 'awaiting reply'),
(12, 12368, 'mashawickramasinghe04@gmail.com', 'Senuri', 'Over the past week, I\'ve noticed persistent headaches accompanied by nausea and dizziness. \r\nWhile I initially attributed these symptoms to stress, they have persisted despite my efforts to \r\nmanage stress levels and maintain a healthy lifestyle.\r\n\r\nI am reaching out to inquire whether these symptoms may indicate an underlying health issue \r\nthat requires further investigation. I would greatly appreciate your insights on potential causes \r\nand recommended next steps.', '', 0, 'awaiting reply'),
(13, 12368, 'mashawickramasinghe04@gmail.com', 'Senuri', 'Test....', '', 0, 'awaiting reply');

-- --------------------------------------------------------

--
-- Table structure for table `labtechnicians`
--

CREATE TABLE `labtechnicians` (
  `labtech_ID` int(10) NOT NULL,
  `first_Name` varchar(20) NOT NULL,
  `last_Name` varchar(40) NOT NULL,
  `display_Name` varchar(64) DEFAULT NULL,
  `email` varchar(128) NOT NULL,
  `contact_Number` int(10) NOT NULL,
  `signIn_Method` varchar(10) NOT NULL,
  `home_Address` varchar(128) NOT NULL,
  `NIC` varchar(20) NOT NULL,
  `specialization` varchar(64) DEFAULT NULL,
  `gender` varchar(10) NOT NULL,
  `registration_No` varchar(20) NOT NULL,
  `qualifications` varchar(255) NOT NULL,
  `department` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `labtechnicians`
--

INSERT INTO `labtechnicians` (`labtech_ID`, `first_Name`, `last_Name`, `display_Name`, `email`, `contact_Number`, `signIn_Method`, `home_Address`, `NIC`, `specialization`, `gender`, `registration_No`, `qualifications`, `department`) VALUES
(5, 'sadhadh', 'naseem', NULL, 'ahmed@gmail.com', 0, '', '', '', NULL, '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `lab_reports`
--

CREATE TABLE `lab_reports` (
  `report_ID` int(11) NOT NULL,
  `test_ID` int(11) NOT NULL,
  `patient_ID` int(11) NOT NULL,
  `doctor_ID` int(11) NOT NULL,
  `prescription_ID` int(11) NOT NULL,
  `date_of_conduct` datetime DEFAULT NULL,
  `remarks` varchar(128) NOT NULL,
  `date_of_report` datetime DEFAULT NULL,
  `report` varchar(510) NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'Pending',
  `size` float NOT NULL,
  `downloads` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lab_reports`
--

INSERT INTO `lab_reports` (`report_ID`, `test_ID`, `patient_ID`, `doctor_ID`, `prescription_ID`, `date_of_conduct`, `remarks`, `date_of_report`, `report`, `status`, `size`, `downloads`) VALUES
(18, 2, 12368, 12356, 1251, NULL, '', '2024-01-17 19:00:00', '18.pdf', 'Ready', 1.69, 6),
(20, 3, 12368, 12356, 1252, NULL, '', '2024-01-18 08:00:00', '20.pdf', 'Pending', 356, 5);

-- --------------------------------------------------------

--
-- Table structure for table `medication`
--

CREATE TABLE `medication` (
  `id` int(11) NOT NULL,
  `name` varchar(40) DEFAULT NULL,
  `Generic Name` varchar(40) DEFAULT NULL,
  `dosage` varchar(8) DEFAULT NULL,
  `expiry_date` date DEFAULT NULL,
  `batch_number` varchar(10) NOT NULL,
  `status` varchar(10) NOT NULL,
  `quantity` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `medication`
--

INSERT INTO `medication` (`id`, `name`, `Generic Name`, `dosage`, `expiry_date`, `batch_number`, `status`, `quantity`) VALUES
(1, 'Neurovan 50 Caps 50mg 5 x 6s', 'Pregabalin', '50mg', NULL, '', '', 0),
(2, 'Neurovan 75 Caps 75mg 3 x10s', 'Pregabalin', '75mg', NULL, '', '', 0),
(3, 'Neurovan 150 Caps 150mg 3 x10s', 'Pregabalin', '150mg', NULL, '', '', 0),
(4, 'Rabe 20 Tabs 20mg 10 X 10s', 'Rabeprazole', '20mg', NULL, '', '', 0),
(5, 'Afix Caps 200mg 3x4s', 'Cefixime', '200mg', NULL, '', '', 0),
(6, 'Prompin-40 Tabs 40mg 5x10s', 'Pantoprazole', '40mg', NULL, '', '', 0),
(7, 'Prompin-20 Tabs 20mg 5x10s', 'Pantoprazole', '20mg', NULL, '', '', 0),
(8, 'AZ-500 Tabs 500mg 10x3s', 'Azithromycin', '500mg', NULL, '', '', 0),
(9, 'AZ-250 Tabs 250mg 10x3s', 'Azithromycin', '250mg', NULL, '', '', 0),
(10, 'Crestor 10MG Tabs 2 x 14s', 'Rosuvastatin', '10mg', NULL, '', '', 0),
(11, 'Nexium 20Mg Tabs 14s', 'Esomeprazole', '20mg', NULL, '', '', 0),
(12, 'Nexium 40MG Tabs 2 x 7s', 'Esomeprazole', '40mg', NULL, '', '', 0),
(13, 'Crestor 5mg Tabs  2 x 14s', 'Rosuvastatin', '5mg', NULL, '', '', 0),
(14, 'Eprazole 20mg Caps 14X7s', 'Esomeprazole', '20mg', NULL, '', '', 0),
(15, 'Eprazole 40mg Caps 14X7s', 'Esomeprazole', '40mg', NULL, '', '', 0),
(16, 'Arnil 50mg Tabs 10X10s', 'Gastro Resistant Diclofenac', '50mg', NULL, '', '', 0),
(17, 'Amlopres Tab 5mg 100s', 'Amlodipine Besilate', '5mg', NULL, '', '', 0),
(18, 'Aspin Tab 100mg 300s', 'Aspirin', '100mg', NULL, '', '', 0),
(19, 'Asthalin DP Caps 200mcg 100s', 'Salbutamol', '200mg', NULL, '', '', 0),
(20, 'Asthalin DP Caps 400mcg 100s', 'Salbutamol', '400mg', NULL, '', '', 0),
(21, 'Atorlip Tab 10mg 30s', 'Atorvastatin', '10mg', NULL, '', '', 0),
(22, 'Atorlip Tab 20mg 30s', 'Atorvastatin', '20mg', NULL, '', '', 0),
(23, 'Azee Tab 250mg 6s', 'Azithromycin', '250mg', NULL, '', '', 0),
(24, 'Azee Tab 500mg 30s', 'Azithromycin', '100mcg', NULL, '', '', 0),
(25, 'Beclate Inhaler 100mcg 200D', 'Beclomethosone', '200mcg', NULL, '', '', 0),
(26, 'Beclate DP Caps 200mcg 100s', 'Beclomethosone', '200mcg', NULL, '', '', 0),
(27, 'Beclate Inhaler 250mcg 200D', 'Beclomethosone', '250mcg', NULL, '', '', 0),
(28, 'Beclate DP Caps 400mcg 100s', 'Beclomethosone', '400mcg', NULL, '', '', 0),
(29, 'Cefasyn Tab 250mg 10s', 'Cefuroxime Axetil', '250mg', NULL, '', '', 0),
(30, 'Cefasyn Tab 500mg 10s', 'Cefuroxime Axetil', '500mg', NULL, '', '', 0),
(31, 'Cephadex Caps 250mg 100s', 'Cephalexine', '250mg', NULL, '', '', 0),
(32, 'Cephadex Caps 500mg 100s', 'Cephalexine', '500mg', NULL, '', '', 0),
(33, 'Cephadex Dry Syrup 125mg/5ml 100ml', 'Cephalexine', '125mg', NULL, '', '', 0),
(34, 'Ciplox Tab 250mg 100s', 'Cephalexin', '250mg', NULL, '', '', 0),
(35, 'Ciplox Tab 500mg 100s', 'Cefalexin', '500mg', NULL, '', '', 0),
(36, 'Clopivas Tab 75mg 100s', 'Clopidogrel', '75mg', NULL, '', '', 0),
(37, 'Cresar Tab 20mg 30s', 'Telmisartan', '20mg', NULL, '', '', 0),
(38, 'Cresar Tab 40mg 30s', 'Telmisartan', '40mg', NULL, '', '', 0),
(39, 'Esomac Tab 20mg 30s', 'Esomeprazole', '20mg', NULL, '', '', 0),
(40, 'Esomac Tab 40mg 30s', 'Esomeprazole', '40mg', NULL, '', '', 0),
(41, 'Urimax Caps 0.4mg 30s', 'Tamsulosin HCL', '0.4mg', NULL, '', '', 0),
(42, 'Zaart Tab 25mg 100s', 'Losartan Potassium', '25mg', NULL, '', '', 0),
(43, 'Zaart Tab 50mg 100s', 'Losartan Potassium', '50mg', NULL, '', '', 0),
(44, 'Zaart H Tab 100s', 'Losartan + Hcl', '', NULL, '', '', 0),
(45, 'Lomac Caps 20mg 100`S', 'Omeprazole', '20mg', NULL, '', '', 0),
(46, 'Montair Tab 10mg 100s', 'Montelukast Sodium', '10mg', NULL, '', '', 0),
(47, 'Montair Tab 4mg 100s', 'Montelukast', '4mg', NULL, '', '', 0),
(48, 'Montair Tab 5mg 100s', 'Montelukast', '5mg', NULL, '', '', 0),
(49, 'Novaclav Tab 375mg 6s', 'Amoxicillin & Clavulanate', '375mg', NULL, '', '', 0),
(50, 'Novaclav Tab 625mg 6s', 'Amoxicillin & Clavulanate', '625mg', NULL, '', '', 0),
(51, 'Risnia Tab 1mg 100s', 'Risperidone', '1mg', NULL, '', '', 0),
(52, 'Risnia Tab 2mg 100s', 'Risperidone', '2mg', NULL, '', '', 0),
(53, 'Rosulip Tab 10mg 10s', 'Rosuvastatin', '10mg', NULL, '', '', 0),
(54, 'Rosulip Tab 5mg 30s', 'Rosuvastatin', '5mg', NULL, '', '', 0),
(55, 'Asthalin Inhaler DC 100mcg 200D', 'Salbutamol', '100mg', NULL, '', '', 0),
(56, 'Atorlip Tab 5mg 100s', 'Atorvastatin', '5mg', NULL, '', '', 0),
(57, 'Atorlip Tab 40mg 30s', 'Atorvastatin', '40mg', NULL, '', '', 0),
(58, 'Atorlip Tab 5mg 30s', 'Atorvastatin', '5mg', NULL, '', '', 0),
(59, 'Ciplox Tab 250mg 700s', 'Cephalexin', '250mg', NULL, '', '', 0),
(60, 'Humulin - N 100iu/ml Inj 10ml Vial', 'Insulin Human Isophane', '', NULL, '', '', 0),
(61, 'Humulin - R 100iu/ml Inj 10ml Vial', 'Insulin Human Soluble', '', NULL, '', '', 0),
(62, 'Humulin  100iu/ml 70/30 Inj - 10ml Vial', 'Premixed Human Insulin (Soluble 30%)', '', NULL, '', '', 0),
(63, 'Humulin 70/30 100iu/ml   5 X 3ml Cart', 'Premixed Human Insulin (Soluble 30%)', '', NULL, '', '', 0),
(64, 'Humulin R 100iu/ml 5 X 3ml Cart', 'Insulin Human Soluble', '', NULL, '', '', 0),
(65, 'Humulin N Inj 100iu/ml  5X3ml Cart', 'Insulin Human Isophane', '', NULL, '', '', 0),
(66, 'Humalog 100iu/ml 5 X 3ml Cart', 'Insulin Lispro', '', NULL, '', '', 0),
(67, 'Humalog Mix 25 100U/ml  3ml  cart X 5\'s', 'Insulin Lispro', '', NULL, '', '', 0),
(68, 'Humalog Mix 50 100U/ml  3ml cart X 5\'s.', 'Insulin Lispro', '', NULL, '', '', 0),
(69, 'Humalog pen 100iu/ml  5x 3ml', 'Insulin Lispro', '', NULL, '', '', 0),
(70, 'Humalog Mix 25 pen 100iu/ml  5 x 3ml', 'Insulin Lispro', '', NULL, '', '', 0),
(71, 'Humalog Mix 50 pen 100iu/ml  5 x 3ml', 'Insulin Lispro', '', NULL, '', '', 0),
(72, 'Humalog Kwik pen 5 x 3ml', 'Insulin Lispro', '', NULL, '', '', 0),
(73, 'Humalog Mix 25 Kwik pen 5 x 3ml', 'Insulin Lispro', '', NULL, '', '', 0),
(74, 'Humalog Mix 50 Kwik pen 5 x 3ml', 'Insulin Lispro', '', NULL, '', '', 0),
(75, 'Getryl 1mg Tabs 2 X 10\'S', 'Glimepiride', '1mg', NULL, '', '', 0),
(76, 'Getryl 2mg Tabs 2 X 10\'S', 'Glimepiride', '2mg', NULL, '', '', 0),
(77, 'Getryl 3mg Tabs 2 X 10\'S', 'Glimepiride', '3mg', NULL, '', '', 0),
(78, 'Getryl 4mg Tabs 2 X 10\'S', 'Glimepiride', '4mg', NULL, '', '', 0),
(79, 'Claritek 250mg Tabs 10\'S', 'Clarithromycin', '250mg', NULL, '', '', 0),
(80, 'Claritek 500mg Tablets 10\'S', 'Clarithromycin', '500mg', NULL, '', '', 0),
(81, 'Claritek Granules 125mg/5ml 1 x 50ml', 'Clarithromycin', '125mg', NULL, '', '', 0),
(82, 'Leflox 250mg Tabs 10\'S', 'Levofloxacin', '250mg', NULL, '', '', 0),
(83, 'Leflox 500mg Tabs 10\'S', 'Levofloxacin', '500mg', NULL, '', '', 0),
(84, 'Lipiget Tabs 10MG 10\'S', 'Atorvastatin', '10mg', NULL, '', '', 0),
(85, 'Lipiget Tabs 20MG 10\'S', 'Atorvastatin', '20mg', NULL, '', '', 0),
(86, 'Reventa Tabs 70mg 4\'s', 'Alendronate Sodium', '70mg', NULL, '', '', 0),
(87, 'Montiget 10mg Tabs 2 x 7\'s', 'Montelukast Sodium', '10mg', NULL, '', '', 0),
(88, 'Montiget 4mg Tabs 2 x 7\'s', 'Montelukast Sodium', '4mg', NULL, '', '', 0),
(89, 'Montiget 5mg Tabs 2 x 7\'s', 'Montelukast Sodium', '5mg', NULL, '', '', 0),
(90, 'Esome 40mg Caps 2 x 7\'s', 'Esomeprazole', '40mg', NULL, '', '', 0),
(91, 'Esome 20mg Caps 2 x 7\'s', 'Esomeprazole', '20mg', NULL, '', '', 0),
(92, 'Gabix 100mg Caps 10\'s', 'Gabapentin', '100mg', NULL, '', '', 0),
(93, 'Gabix 300mg Caps 10\'s', 'Gabapentin', '300mg', NULL, '', '', 0),
(94, 'Zetro 200mg/5ml Oral Susp. 15ml', 'Azithromycin', '200mg', NULL, '', '', 0),
(95, 'ZETRO 250MG CAPS 2x5\'S', 'Azithromycin', '250mg', NULL, '', '', 0),
(96, 'Tasmi 80mg Tabs 14\'s', 'Telmisartan', '80mg', NULL, '', '', 0),
(97, 'Tasmi 20mg Tabs 14\'s', 'Telmisartan', '20mg', NULL, '', '', 0),
(98, 'Tasmi 40mg Tabs 14\'s', 'Telmisartan', '40mg', NULL, '', '', 0),
(99, 'Tamsolin 0.4mg Caps 10\'s', 'Tamsulosin HCL', '0.4mg', NULL, '', '', 0),
(100, 'Zetro 500mg Tabs 3\'s', 'Azithromycin', '500mg', NULL, '', '', 0),
(101, 'Trevia 100mg Tabs 35s', 'Sitagliptin', '100mg', NULL, '', '', 0),
(102, 'Gabica 50mg caps 35\'s', 'Pregabalin', '50mg', NULL, '', '', 0),
(103, 'Gabica 75mg caps 35\'s', 'Pregabalin', '75mg', NULL, '', '', 0),
(104, 'Gabica 100mg caps 35\'s', 'Pregabalin', '100mg', NULL, '', '', 0),
(105, 'Gabica 150mg caps 35\'s', 'Pregabalin', '150mg', NULL, '', '', 0),
(106, 'Rovista 10mg Tabs 3x10s', 'Rosuvastatin', '50mg', NULL, '', '', 0),
(107, 'Trevia 50mg Tabs 5x7s', 'Sitagliptin', '50mg', NULL, '', '', 0),
(108, 'Rovista 5mg Tabs 3x10s', 'Rosuvastatin', '5mg', NULL, '', '', 0),
(109, 'Glemont CT-4 Tabs 4mg 10x10s', 'Montelukast', '4mg', NULL, '', '', 0),
(110, 'Glemont CT-5 Tabs 5mg 10x10s', 'Montelukast', '5mg', NULL, '', '', 0),
(111, 'Ibicar-250 Inh 250mcg/Met Dose 200D', 'Beclometasone', '250mcg', NULL, '', '', 0),
(112, 'Ibicar-200 Inh 200mcg/Act 200D', 'Beclometasone', '200mcg', NULL, '', '', 0),
(113, 'Ibicar-100 Inh 100mcg/Act 200D', 'Beclometasone', '100mcg', NULL, '', '', 0),
(114, 'Ibicar-50 Inh 50mcg/Act Met Dose 200D', 'Beclometasone', '50mcg', NULL, '', '', 0),
(115, 'Glemont IR- 10 Tabs 10mg 10x10s', 'Montelukast', '10mg', NULL, '', '', 0),
(116, 'Tuspel Plus Syrup 100ml', 'Salbutamol 1mg+Bromhexine 4mg, Ammonium', '', NULL, '', '', 0),
(117, 'Abz Tabs 400Mg 1s', 'Albendazole', '400mg', NULL, '', '', 0),
(118, 'Atm 200 Mango Flavoured 15ml', 'Azithromycin', '', NULL, '', '', 0),
(119, 'Atm 200 Mango Flavoured 30ml', 'Azithromycin', '', NULL, '', '', 0),
(120, 'Atm 250 Tabs 250mg 1X6s', 'Azithromycin', '250mg', NULL, '', '', 0),
(121, 'Atm 500 Tabs 500mg 1X3s', 'Azithromycin', '500mg', NULL, '', '', 0),
(122, 'Cloben Skin Cream 5g', 'Clotrimazole+Beclomethazone  cream', '5g', NULL, '', '', 0),
(123, 'Febrex Tabs 500mg 10x10s', 'Paracetamol', '500mg', NULL, '', '', 0),
(124, 'Glychek 40 Tabs 40mg 10X10s', 'Gliclazide', '40mg', NULL, '', '', 0),
(125, 'Glychek 80 Tabs 80mg 10X10s', 'Gliclazide', '80mg', NULL, '', '', 0),
(126, 'Metchek 500 Tabs 500mg 10X10s', 'Metformin', '500mg', NULL, '', '', 0),
(127, 'Metchek 850 Tabs 850mg 10X10s', 'Metformin', '850mg', NULL, '', '', 0),
(128, 'Prichek 1mg Tabs 3X10s', 'Glimepiride', '1mg', NULL, '', '', 0),
(129, 'Prichek 2mg Tabs 3X10s', 'Glimepiride', '2mg', NULL, '', '', 0),
(130, 'Tuspel Plus Syrup 60ml', 'Salbutamol 1mg+Bromhexine 4mg, Ammonium', '', NULL, '', '', 0),
(131, 'Powergesic 1%  Gel 30g Tube', 'Diclofenac', '', NULL, '', '', 0),
(132, 'Nervege 75 75mg Caps 10s', 'Pregabalin', '75mg', NULL, '', '', 0),
(133, 'Broadced 1Gm Inj., 1\'S', 'Ceftriaxone', '', NULL, '', '', 0),
(134, 'Clavamox 250 Tabs 375mg 15\'S', 'Co-amoxiclav', '375mg', NULL, '', '', 0),
(135, 'Clavamox Inj 1000', 'Co-amoxiclav', '', NULL, '', '', 0),
(136, 'CLAVAMOX 125 SYRUP 60ML', 'Co-amoxiclav', '', NULL, '', '', 0),
(137, 'Clavamox 500 Tabs 625Mg 3 X 10\'S', 'Co-amoxiclav', '625mg', NULL, '', '', 0),
(138, 'KALFOXIM 1G -1\'S', 'Cefotaximefor', '1g', NULL, '', '', 0),
(139, 'Klarid 250Mg 3 X 10\'S', 'Clarithromycin', '250mg', NULL, '', '', 0),
(140, 'Glidabet 80Mg , 10 X 10\'S', 'Gliclazide', '80mg', NULL, '', '', 0),
(141, 'Divoltar Tabs 50Mg , 5 X 10\'S', 'Diclofenac Sodium', '50mg', NULL, '', '', 0),
(142, 'Diaflam Tabs 50Mg 5 X10\'S', 'Diclofenac Potassium', '50mg', NULL, '', '', 0),
(143, 'Dometic 10Mg Tabs  , 5 X 10\'S', 'Domperidone', '10mg', NULL, '', '', 0),
(144, 'Kalxetin 20Mg Caps , 3 X 10\'S', 'Fluoxetine', '20mg', NULL, '', '', 0),
(145, 'Dometic Syrup 5mg/5ml, 60 ml   Bottle', 'Domperidone', '', NULL, '', '', 0),
(146, 'Zypraz  0.5mg Tabs,5x10\'s', 'Alprazolam', '0.5mg', NULL, '', '', 0),
(147, 'Clavamox 250 Tabs 375MG  3x10\'s', 'Co-amoxiclav', '375mg', NULL, '', '', 0),
(148, 'Hexilon 16mg Tabs, 3x10\'s', 'Methylprednisolone', '16mg', NULL, '', '', 0),
(149, 'Hexilon 4mg Tabs, 5x10\'s', 'Methylprednisolone', '4mg', NULL, '', '', 0),
(150, 'Nevox XR ,500mg Tabs,3x10\'s', 'Metformin', '500mg', NULL, '', '', 0),
(151, 'Trifix 200mg Tabs 3x10s', 'Cefixime', '200mg', NULL, '', '', 0),
(152, 'Trifix 100mg/5ml Pow-OralSusp 30ml', 'Cefixime', '100mg', NULL, '', '', 0),
(153, 'Metrix 2mg Tabs 2x15s', 'Glimepiride', '2mg', NULL, '', '', 0),
(154, 'Clavamox Inj 1.2gm 1s', 'Co-amoxiclav', '1.2mg', NULL, '', '', 0),
(155, 'Clavamox Inj 600mg 1s', 'Co-amoxiclav', '600mg', NULL, '', '', 0),
(156, 'Cefakind 250mg Tabs 3 x10\'s', 'Cefuroxime Axetil', '250mg', NULL, '', '', 0),
(157, 'Cefakind 500mg Tabs 2 x 6\'s', 'Cefuroxime Axetil', '500mg', NULL, '', '', 0),
(158, 'Nuforce 150mg Tabs 1\'s', 'Fluconazole', '150mg', NULL, '', '', 0),
(159, 'Amlokind 5mg Tabs 6 x 10\'s', 'Amlodipine Besilate', '5mg', NULL, '', '', 0),
(160, 'Glykind 80mg Tabs 6 x 10\'s', 'Gliclazide', '80mg', NULL, '', '', 0),
(161, 'Oskar 20mg Caps 10 x 10\'s', 'Omeprazole Delayed', '20mg', NULL, '', '', 0),
(162, 'Moxikind CV 375 Tabs 2 x 6\'s', 'Amoxicillin + Clavulanic Acid', '', NULL, '', '', 0),
(163, 'Moxikind CV 625 Tabs 4 x 6\'s', 'Amoxicillin + Clavulanic Acid', '', NULL, '', '', 0),
(164, 'Metatime 500mg Tabs 10 x 10\'s', 'Metformin Hydrochloride', '500mg', NULL, '', '', 0),
(165, 'Losakind 25mg Tabs 6 x 10\'s', 'Losartan Potassium', '25mg', NULL, '', '', 0),
(166, 'Losakind 50mg Tabs 6 x 10\'s', 'Losartan Potassium', '50mg', NULL, '', '', 0),
(167, 'Mahacef-200 Tabs 200mg 6x10s', 'Cefixime', '200mg', NULL, '', '', 0),
(168, 'Mahacef-100 Tabs 100mg 6x10s', 'Cefixime', '100mg', NULL, '', '', 0),
(169, 'Moxikind CV 156.25mg/5ml OralSusp 100ml', 'Amoxicillin+Clavulanate Potassium', '156.25mg', NULL, '', '', 0),
(170, 'Pantakind -40  40mg Tabs 6x10\'s', 'Pantoprazole Sodium', '40mg', NULL, '', '', 0),
(171, 'Clopikind-75 Tabs 75mg 6X10s', 'Clopidogrel', '70mg', NULL, '', '', 0),
(172, 'Lipikind-10 Tabs 10mg 6X10s', 'Atorvastatin', '10mg', NULL, '', '', 0),
(173, 'Lipikind-20 Tabs 20mg 6X10s', 'Atorvastatin', '20mg', NULL, '', '', 0),
(174, 'Cefastar 500mg Capsules 6X10s', 'Cephalexin', '500mg', NULL, '', '', 0),
(175, 'Moxikind CV 625 Tabs 2 x 7s', 'Amoxicillin + Clavulanic Acid', '', NULL, '', '', 0),
(176, 'Moxikind CV 375 Tabs 2 x 7s', 'Amoxicillin + Clavulanic Acid', '', NULL, '', '', 0),
(177, 'Cefakind 250mg Tabs 10s', 'Cefuroxime Axetil', '250mg', NULL, '', '', 0),
(178, 'Cefakind 500mg Tabs 10s', 'Cefuroxime Axetil', '500mg', NULL, '', '', 0),
(179, 'Medrol 16mg Tabs ,14\'s', 'Methylprednisolone', '16mg', NULL, '', '', 0),
(180, 'Medrol 4mg Tabs 10x10\'s', 'Methylprednisolone', '4mg', NULL, '', '', 0),
(181, 'Medrol 16mg Tabs 3x10s', 'Methylprednisolone', '16mg', NULL, '', '', 0),
(182, 'Diamicron Tabs 80mg 20\'S', 'Gliclazide', '80mg', NULL, '', '', 0),
(183, 'Amlosun 5 Tabs 5mg 10x10s', 'Amlodipine', '5mg', NULL, '', '', 0),
(184, 'Amlosun 10 Tabs 10mg 10x10s', 'Amlodipine', '10mg', NULL, '', '', 0),
(185, 'Angizem 30 Tabs 30mg 10x10s', 'Diltiazem', '30mg', NULL, '', '', 0),
(186, 'Angizem 60 Tabs 60mg 10x10s', 'Diltiazem', '60mg', NULL, '', '', 0),
(187, 'Angizem CD 90 Caps 90mg 10x10s', 'Diltiazem Hydrochloride', '60mg', NULL, '', '', 0),
(188, 'Aztor 10 Tabs 10mg 5x10s', 'Atorvastatin', '10mg', NULL, '', '', 0),
(189, 'Aztor 20 Tabs 20mg 5x10s', 'Atorvastatin', '20mg', NULL, '', '', 0),
(190, 'Clopilet 75mg Tabs 3x10s', 'Clopidogrel', '75mg', NULL, '', '', 0),
(191, 'Pantocid 20 Tabs 20mg 5x10s', 'Pantoprazole Sodium', '20mg', NULL, '', '', 0),
(192, 'Pantocid 40mg Tabs 5x10s', 'Pantoprazole Sodium', '40mg', NULL, '', '', 0),
(193, 'Pantocid I.V 40mg Inj Vial 1s', 'Pantoprazole for Injection', '40mg', NULL, '', '', 0),
(194, 'Repace 25 Tabs 25mg 10x10s', 'Losartan Potassium', '25mg', NULL, '', '', 0),
(195, 'Repace 50 Tabs 50mg 10x10s', 'Losartan Potassium', '50mg', NULL, '', '', 0),
(196, 'Repace H 50mg+12.5mg Tabs 10x10s', 'Losartan Potas. 50mg+Hydrochl. 12.5mg', '', NULL, '', '', 0),
(197, 'Rozavel 5 Tabs 5mg 3x10s', 'Rosuvastatin', '5mg', NULL, '', '', 0),
(198, 'Rozavel 10 Tabs 10mg 3x10s', 'Rosuvastatin', '10mg', NULL, '', '', 0),
(199, 'Sompraz 20 Tabs 20mg 3x10s', 'Esomeprazole', '20mg', NULL, '', '', 0),
(200, 'Sompraz 40 Tabs 40mg 3x10s', 'Esomeprazole', '40mg', NULL, '', '', 0),
(201, 'Sompraz IV 40mg Inj Vial+5ml Vial 1s', 'Esomeprazole', '40mg', NULL, '', '', 0),
(202, 'Ceroxim 250mg Tabs 10\'S', 'Cefuroxime Axetil', '250mg', NULL, '', '', 0),
(203, 'Ceroxim 500mg Tabs 10\'S', 'Cefuroxime Axetil', '500mg', NULL, '', '', 0),
(204, 'Ceruvin 75mg Tabs 10x10s', 'Clopidogrel', '75mg', NULL, '', '', 0),
(205, 'Cifran Infusion 200mg/100ml', 'Ciprofloxacin', '200mg', NULL, '', '', 0),
(206, 'Cifran Tabs 250mg 2x10\'S', 'Ciprofloxacin', '500mg', NULL, '', '', 0),
(207, 'Cifran Tabs 500mg 2x10\'S', 'Ciprofloxacin', '500mg', NULL, '', '', 0),
(208, 'Enhancin Suspension 100ml', 'Amoxicillin+Clavulanate Potassium', '', NULL, '', '', 0),
(209, 'Enhancin  Tabs 375 ,20\'s', 'Amoxicillin+Clavulanate Potassium', '', NULL, '', '', 0),
(210, 'Enhancin Tabs 625mg 10\'S', 'Amoxicillin+Clavulanate Potassium', '625mg', NULL, '', '', 0),
(211, 'Ranoxyl Caps 250mg 24X10\'S', 'Amoxicillin', '250mg', NULL, '', '', 0),
(212, 'Ranoxyl 500mg Caps 24X2X10\'s', 'Amoxicillin', '500mg', NULL, '', '', 0),
(213, 'Ranoxyl Syrup 125mg 100ml', 'Amoxicillin', '125mg', NULL, '', '', 0),
(214, 'Sporidex Caps 250mg 24 X 10\'S', 'Cephalexin', '250mg', NULL, '', '', 0),
(215, 'Sporidex Caps 500mg 24 X 10\'S', 'Cephalexin', '500mg', NULL, '', '', 0),
(216, 'Sporidex Distab 125mg Tabs 10X10\'s', 'Cephalexin', '125mg', NULL, '', '', 0),
(217, 'Sporidex Syrup 125mg/5ml 100ml', 'Cephalexin', '125mg', NULL, '', '', 0),
(218, 'Volini Gel 30g Tube', 'Diclofenac Diethylamine', '', NULL, '', '', 0),
(219, 'Enhancin  Tabs 625mg  ,20\'s', 'Amoxicillin+Clavulanate Potassium', '625mg', NULL, '', '', 0),
(220, 'Riomet-850 Tabs 850mg 10x10s', 'Metformin', '850mg', NULL, '', '', 0),
(221, 'Riomet-500 Tabs 500mg 10x10s', 'Metformin', '500mg', NULL, '', '', 0),
(222, 'Deplatt 75mg Tabs 10x10s', 'Clopidogrel', '75mg', NULL, '', '', 0),
(223, 'Dilzem -60 60mg Tabs 10x10s', 'Diltiazem Hydrochloride', '60mg', NULL, '', '', 0),
(224, 'Domstal 10mg Tabs 5x2x10s', 'Domperidone', '10mg', NULL, '', '', 0),
(225, 'Epimate -25 25mg Tabs 10x10s', 'Topiramate', '25mg', NULL, '', '', 0),
(226, 'Lamitor -25 25mg Tabs 5x10s', 'Lamotrigine', '25mg', NULL, '', '', 0),
(227, 'Modlip -10 10mg Tabs 10x10s', 'Atorvastatin', '10mg', NULL, '', '', 0),
(228, 'Modlip -20 20mg Tabs 10x10s', 'Atorvastatin', '20mg', NULL, '', '', 0),
(229, 'Nexpro -20 20mg Tabs 10x10s', 'Esomeprazole', '20mg', NULL, '', '', 0),
(230, 'Nexpro -40 40mg Tabs 10x10s', 'Esomeprazole', '40mg', NULL, '', '', 0),
(231, 'Pantor -20 20mg Tabs 10x10s', 'Pantoprazole Sodium', '20mg', NULL, '', '', 0),
(232, 'Pantor -40 40mg Tabs 10x10s', 'Pantoprazole Sodium', '40mg', NULL, '', '', 0),
(233, 'Valparin  Chrono 300mg Tabs 10x10s', 'Sodium Valproate and Valproic Acid', '300mg', NULL, '', '', 0),
(234, 'Valparin 200 Alkalets 200mg Tabs 10x10s', 'Sodium Valproate', '200mg', NULL, '', '', 0),
(235, 'Valparin Chrono 500 333+145mg Tab 10x10s', 'Sodium Valproate and Valproic Acid', '', NULL, '', '', 0),
(236, 'Dilzem -30 30mg Tabs 2x5x10s', 'Diltiazem Hydrochloride', '30mg', NULL, '', '', 0),
(237, 'Carbatol CR 200mg Tabs 10x10s', 'Carbamazepine ER Tablets', '200mg', NULL, '', '', 0),
(238, 'Epimate 50mg Tabs 10x10s', 'Topiramate Tablets', '50mg', NULL, '', '', 0),
(239, 'Omizac 20mg Caps 10x10s', 'Omeprazole', '20mg', NULL, '', '', 0),
(240, 'Dilzem SR 90mg Tabs 2x5x10s', 'Diltiazem Hydrochloride', '90mg', NULL, '', '', 0),
(241, 'Valparin 200mg/5ml OralSol 100ml', 'Sodium Valproate Oral Solution 200mg/5ml', '200mg', NULL, '', '', 0),
(242, 'Tozaar 25mg Tabs 15x7s', 'Losartan Potassium', '25mg', NULL, '', '', 0),
(243, 'Veloz 10, Tabs 5X10\'S', 'Rabeprazole', '', NULL, '', '', 0),
(244, 'Veloz 20, Tabs 5X10\'S', 'Rabeprazole', '', NULL, '', '', 0),
(245, 'Domstal DT 10 Tabs 10x10\'S', 'Domperidone', '', NULL, '', '', 0),
(246, 'Lamitor 100 DT tabs 5 x 10\'s', 'Lamotrigine', '', NULL, '', '', 0),
(247, 'Lamitor 50 DT tabs 5 x 10\'s', 'Lamotrigine', '', NULL, '', '', 0),
(248, 'Topcef 200 Tabs 10X10\'s', 'Cefixime', '', NULL, '', '', 0),
(249, 'Azulix 1mg Tabs 10x10\'S', 'Glimepiride', '1mg', NULL, '', '', 0),
(250, 'Azulix 2mg Tabs 10x10\'S', 'Glimepiride', '2mg', NULL, '', '', 0),
(251, 'Veloz 10 Tabs 10X10\'S', 'Rabeprazole', '', NULL, '', '', 0),
(252, 'Veloz 20 Tabs 15x7\'s', 'Rabeprazole', '', NULL, '', '', 0),
(253, 'Azulix 4mg Tabs 10x10\'S', 'Glimepiride', '4mg', NULL, '', '', 0),
(254, 'Dibeta SR 500mg Tabs 3x10\'s', 'Metformin', '500mg', NULL, '', '', 0),
(255, 'Fluoxetor 20mg Caps 5x2x10\'s', 'Fluoxetine', '20mg', NULL, '', '', 0),
(256, 'Telday 40mg Tabs 10x10\'s', 'Telmisartan', '40mg', NULL, '', '', 0),
(257, 'Telday 80mg Tabs 10x10\'s', 'Telmisartan', '80mg', NULL, '', '', 0),
(258, 'Telday 20mg Tabs 10x10\'s', 'Telmisartan', '20mg', NULL, '', '', 0),
(259, 'Asthator- 10 Tabs 3 X 10\'s', 'Montelukast', '', NULL, '', '', 0),
(260, 'Asthator- 5 Tabs 3 X 10\'s', 'Montelukast', '', NULL, '', '', 0),
(261, 'Telday H Tabs 10 X 10\'s', 'Telmisartan', '', NULL, '', '', 0),
(262, 'Azukon MR Tabs 30mg 10X10s', 'Gliclazide', '30mg', NULL, '', '', 0),
(263, 'Rosucor 20 Tabs 10 x 10s', 'Rosuvastatin', '', NULL, '', '', 0),
(264, 'Rosucor 10 Tabs 10 x 10s', 'Rosuvastatin', '', NULL, '', '', 0),
(265, 'Tolanz - 5 5mg Tabs 3x10s', 'Olanzapine', '5mg', NULL, '', '', 0),
(266, 'Tolanz - 10 10mg Tabs 3x10s', 'Olanzapine', '10mg', NULL, '', '', 0),
(267, 'Lipitor 10mg Tabs ,30\'s', 'Atorvastatin', '10mg', NULL, '', '', 0),
(268, 'Lipitor 20mg Tabs ,30\'s', 'Atorvastatin', '20mg', NULL, '', '', 0),
(269, 'Lyrica 75mg caps 4x14s', 'Pregabalin', '75mg', NULL, '', '', 0),
(270, 'Lyrica 150mg caps 4x14s', 'Pregabalin', '150mg', NULL, '', '', 0),
(271, 'Glycomet 500mg Tabs 5X2X10\'S', 'Metformin', '500mg', NULL, '', '', 0),
(272, 'Puril Tabs 75mg 4 X 7\'S', 'Clopidogrel', '75mg', NULL, '', '', 0),
(273, 'Ecorin Tabs 75mg 10 X 10\'S', 'Aspirin', '75mg', NULL, '', '', 0),
(274, 'Ecorin Tabs 150mg 10 X 10\'S', 'Aspirin', '150mg', NULL, '', '', 0),
(275, 'Glyboral Tabs 5mg 10x10\'S', 'Glibenclamide', '5mg', NULL, '', '', 0),
(276, 'Glynase Tabs 5mg 10 x 10\'S', 'Glipizide', '5mg', NULL, '', '', 0),
(277, 'Glizide 80mg 10x10\'S', 'Gliclazide', '80mg', NULL, '', '', 0),
(278, 'Glycomet 850mg 5X2X10\'S', 'Metformin', '850mg', NULL, '', '', 0),
(279, 'GP 2 Tabs 10 x 10\'s', 'Glimepiride', '', NULL, '', '', 0),
(280, 'GP 1 Tabs 10 x 10\'s', 'Glimepiride', '', NULL, '', '', 0),
(281, 'Glycomet 500 SR tabs 10 x 10\'s', 'Metformin', '', NULL, '', '', 0),
(282, 'Tazloc 20mg Tabs 3x10\'s', 'Telmisartan', '20mg', NULL, '', '', 0),
(283, 'Tazloc 40mg Tabs 3x10\'s', 'Telmisartan', '40mg', NULL, '', '', 0),
(284, 'Tazloc 80mg Tabs 3x10s', 'Telmisartan', '80mg', NULL, '', '', 0),
(285, 'Tazloc - H 40mg + 12.5mg Tabs 3x10s', 'Telmisartan', '', NULL, '', '', 0),
(286, 'Roseday - 10 Tabs 10mg 3x10s', 'Rosuvastatin', '10mg', NULL, '', '', 0),
(287, 'Roseday - 5 Tabs 5mg 3x10s', 'Rosuvastatin', '5mg', NULL, '', '', 0),
(288, 'Paragan 500mg Tabs 10 X 10\'S', 'Paracetamol', '500mg', NULL, '', '', 0),
(289, 'Happi-20Mg Tabs 10X10\'S', 'Rabeprazole', '20mg', NULL, '', '', 0),
(290, 'Amlodac 10Mg Tabs 10X10\'S', 'Amlodipine', '10mg', NULL, '', '', 0),
(291, 'Amlodac 5Mg Tabs 10X10\'S', 'Amlodipine', '5mg', NULL, '', '', 0),
(292, 'Aldren 70 - 70mg Tabs 4\' s', 'Alendronate Sodium', '70mg', NULL, '', '', 0),
(293, 'TOPIRAM 25, Tabs 60\'s', 'Topiramate', '', NULL, '', '', 0),
(294, 'Zydzith-250 250mg Tabs 10x6s', 'Azithromycin', '250mg', NULL, '', '', 0),
(295, 'Montenuzyd 10mg Tabs 3x10s', 'Montelukast', '10mg', NULL, '', '', 0),
(296, 'GABACAP - 300 Caps 300mg 10x10s', 'Gabapentin', '300mg', NULL, '', '', 0),
(297, 'GABACAP - 400 Caps 400mg 10x10s', 'Gabapentin', '400mg', NULL, '', '', 0),
(298, 'Montezyd - 4    4mg Tabs 3x10s', 'Montelukast', '4mg', NULL, '', '', 0),
(299, 'Montezyd - 5   ?5mg Tabs 3x10s', 'Montelukast', '5mg', NULL, '', '', 0),
(300, 'ALFATAM - 0.4mg Caps 3x10s', 'Tamsulosin HCL', '0.4mg', NULL, '', '', 0),
(301, 'Montezyd - 10    10mg Tabs 3x10s', 'Montelukast', '10mg', NULL, '', '', 0),
(302, 'Chira-20,20mg Tabs 10x10s', 'Esomeprazole', '20mg', NULL, '', '', 0),
(303, 'Chira-40,40mg Tabs 2x10s', 'Esomeprazole', '40mg', NULL, '', '', 0),
(304, 'Zypra- 20 Caps 20mg  10x10s', 'Esomeprazole', '20mg', NULL, '', '', 0),
(305, 'Zypra- 40 Caps 40mg  10x10s', 'Esomeprazole', '40mg', NULL, '', '', 0),
(306, 'Zydzith-500  500mg Tabs 10x10s', 'Azithromycin', '500mg', NULL, '', '', 0),
(307, 'Olandus - 5   5mg Tabs 10x10s', 'Olanzapine', '5mg', NULL, '', '', 0),
(308, 'Topiram 50,Tabs 60s', 'Topiramate', '', NULL, '', '', 0),
(309, 'Lamidus DT 50 ,50mg tabs 5x10s', 'Lamotrigine', '50mg', NULL, '', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `medicine_data`
--

CREATE TABLE `medicine_data` (
  `medicine_ID` int(10) NOT NULL,
  `material_Description` varchar(40) NOT NULL,
  `generic_Name` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `medicine_data`
--

INSERT INTO `medicine_data` (`medicine_ID`, `material_Description`, `generic_Name`) VALUES
(1, 'Neurovan 50 Caps 50mg 5 x 6s', 'Pregabalin'),
(2, 'Neurovan 75 Caps 75mg 3 x10s', 'Pregabalin'),
(3, 'Neurovan 150 Caps 150mg 3 x10s', 'Pregabalin'),
(4, 'Rabe 20 Tabs 20mg 10 X 10s', 'Rabeprazole'),
(5, 'Afix Caps 200mg 3x4s', 'Cefixime'),
(6, 'Prompin-40 Tabs 40mg 5x10s', 'Pantoprazole'),
(7, 'Prompin-20 Tabs 20mg 5x10s', 'Pantoprazole'),
(8, 'AZ-500 Tabs 500mg 10x3s', 'Azithromycin'),
(9, 'AZ-250 Tabs 250mg 10x3s', 'Azithromycin'),
(10, 'Crestor 10MG Tabs 2 x 14s', 'Rosuvastatin'),
(11, 'Nexium 20Mg Tabs 14s', 'Esomeprazole'),
(12, 'Nexium 40MG Tabs 2 x 7s', 'Esomeprazole'),
(13, 'Crestor 5mg Tabs  2 x 14s', 'Rosuvastatin'),
(14, 'Eprazole 20mg Caps 14X7s', 'Esomeprazole'),
(15, 'Eprazole 40mg Caps 14X7s', 'Esomeprazole'),
(16, 'Arnil 50mg Tabs 10X10s', 'Gastro Resistant Diclofenac'),
(17, 'Amlopres Tab 5mg 100s', 'Amlodipine Besilate'),
(18, 'Aspin Tab 100mg 300s', 'Aspirin'),
(19, 'Asthalin DP Caps 200mcg 100s', 'Salbutamol'),
(20, 'Asthalin DP Caps 400mcg 100s', 'Salbutamol'),
(21, 'Atorlip Tab 10mg 30s', 'Atorvastatin'),
(22, 'Atorlip Tab 20mg 30s', 'Atorvastatin'),
(23, 'Azee Tab 250mg 6s', 'Azithromycin'),
(24, 'Azee Tab 500mg 30s', 'Azithromycin'),
(25, 'Beclate Inhaler 100mcg 200D', 'Beclomethosone'),
(26, 'Beclate DP Caps 200mcg 100s', 'Beclomethosone'),
(27, 'Beclate Inhaler 250mcg 200D', 'Beclomethosone'),
(28, 'Beclate DP Caps 400mcg 100s', 'Beclomethosone'),
(29, 'Cefasyn Tab 250mg 10s', 'Cefuroxime Axetil'),
(30, 'Cefasyn Tab 500mg 10s', 'Cefuroxime Axetil'),
(31, 'Cephadex Caps 250mg 100s', 'Cephalexine'),
(32, 'Cephadex Caps 500mg 100s', 'Cephalexine'),
(33, 'Cephadex Dry Syrup 125mg/5ml 100ml', 'Cephalexine'),
(34, 'Ciplox Tab 250mg 100s', 'Cephalexin'),
(35, 'Ciplox Tab 500mg 100s', 'Cefalexin'),
(36, 'Clopivas Tab 75mg 100s', 'Clopidogrel'),
(37, 'Cresar Tab 20mg 30s', 'Telmisartan'),
(38, 'Cresar Tab 40mg 30s', 'Telmisartan'),
(39, 'Esomac Tab 20mg 30s', 'Esomeprazole'),
(40, 'Esomac Tab 40mg 30s', 'Esomeprazole'),
(41, 'Urimax Caps 0.4mg 30s', 'Tamsulosin HCL'),
(42, 'Zaart Tab 25mg 100s', 'Losartan Potassium'),
(43, 'Zaart Tab 50mg 100s', 'Losartan Potassium'),
(44, 'Zaart H Tab 100s', 'Losartan + Hcl'),
(45, 'Lomac Caps 20mg 100`S', 'Omeprazole'),
(46, 'Montair Tab 10mg 100s', 'Montelukast Sodium'),
(47, 'Montair Tab 4mg 100s', 'Montelukast'),
(48, 'Montair Tab 5mg 100s', 'Montelukast'),
(49, 'Novaclav Tab 375mg 6s', 'Amoxicillin & Clavulanate'),
(50, 'Novaclav Tab 625mg 6s', 'Amoxicillin & Clavulanate'),
(51, 'Risnia Tab 1mg 100s', 'Risperidone'),
(52, 'Risnia Tab 2mg 100s', 'Risperidone'),
(53, 'Rosulip Tab 10mg 10s', 'Rosuvastatin'),
(54, 'Rosulip Tab 5mg 30s', 'Rosuvastatin'),
(55, 'Asthalin Inhaler DC 100mcg 200D', 'Salbutamol'),
(56, 'Atorlip Tab 5mg 100s', 'Atorvastatin'),
(57, 'Atorlip Tab 40mg 30s', 'Atorvastatin'),
(58, 'Atorlip Tab 5mg 30s', 'Atorvastatin'),
(59, 'Ciplox Tab 250mg 700s', 'Cephalexin'),
(60, 'Humulin - N 100iu/ml Inj 10ml Vial', 'Insulin Human Isophane'),
(61, 'Humulin - R 100iu/ml Inj 10ml Vial', 'Insulin Human Soluble'),
(62, 'Humulin  100iu/ml 70/30 Inj - 10ml Vial', 'Premixed Human Insulin (Soluble 30%)'),
(63, 'Humulin 70/30 100iu/ml   5 X 3ml Cart', 'Premixed Human Insulin (Soluble 30%)'),
(64, 'Humulin R 100iu/ml 5 X 3ml Cart', 'Insulin Human Soluble'),
(65, 'Humulin N Inj 100iu/ml  5X3ml Cart', 'Insulin Human Isophane'),
(66, 'Humalog 100iu/ml 5 X 3ml Cart', 'Insulin Lispro'),
(67, 'Humalog Mix 25 100U/ml  3ml  cart X 5\'s', 'Insulin Lispro'),
(68, 'Humalog Mix 50 100U/ml  3ml cart X 5\'s.', 'Insulin Lispro'),
(69, 'Humalog pen 100iu/ml  5x 3ml', 'Insulin Lispro'),
(70, 'Humalog Mix 25 pen 100iu/ml  5 x 3ml', 'Insulin Lispro'),
(71, 'Humalog Mix 50 pen 100iu/ml  5 x 3ml', 'Insulin Lispro'),
(72, 'Humalog Kwik pen 5 x 3ml', 'Insulin Lispro'),
(73, 'Humalog Mix 25 Kwik pen 5 x 3ml', 'Insulin Lispro'),
(74, 'Humalog Mix 50 Kwik pen 5 x 3ml', 'Insulin Lispro'),
(75, 'Getryl 1mg Tabs 2 X 10\'S', 'Glimepiride'),
(76, 'Getryl 2mg Tabs 2 X 10\'S', 'Glimepiride'),
(77, 'Getryl 3mg Tabs 2 X 10\'S', 'Glimepiride'),
(78, 'Getryl 4mg Tabs 2 X 10\'S', 'Glimepiride'),
(79, 'Claritek 250mg Tabs 10\'S', 'Clarithromycin'),
(80, 'Claritek 500mg Tablets 10\'S', 'Clarithromycin'),
(81, 'Claritek Granules 125mg/5ml 1 x 50ml', 'Clarithromycin'),
(82, 'Leflox 250mg Tabs 10\'S', 'Levofloxacin'),
(83, 'Leflox 500mg Tabs 10\'S', 'Levofloxacin'),
(84, 'Lipiget Tabs 10MG 10\'S', 'Atorvastatin'),
(85, 'Lipiget Tabs 20MG 10\'S', 'Atorvastatin'),
(86, 'Reventa Tabs 70mg 4\'s', 'Alendronate Sodium'),
(87, 'Montiget 10mg Tabs 2 x 7\'s', 'Montelukast Sodium'),
(88, 'Montiget 4mg Tabs 2 x 7\'s', 'Montelukast Sodium'),
(89, 'Montiget 5mg Tabs 2 x 7\'s', 'Montelukast Sodium'),
(90, 'Esome 40mg Caps 2 x 7\'s', 'Esomeprazole'),
(91, 'Esome 20mg Caps 2 x 7\'s', 'Esomeprazole'),
(92, 'Gabix 100mg Caps 10\'s', 'Gabapentin'),
(93, 'Gabix 300mg Caps 10\'s', 'Gabapentin'),
(94, 'Zetro 200mg/5ml Oral Susp. 15ml', 'Azithromycin'),
(95, 'ZETRO 250MG CAPS 2x5\'S', 'Azithromycin'),
(96, 'Tasmi 80mg Tabs 14\'s', 'Telmisartan'),
(97, 'Tasmi 20mg Tabs 14\'s', 'Telmisartan'),
(98, 'Tasmi 40mg Tabs 14\'s', 'Telmisartan'),
(99, 'Tamsolin 0.4mg Caps 10\'s', 'Tamsulosin HCL'),
(100, 'Zetro 500mg Tabs 3\'s', 'Azithromycin'),
(101, 'Trevia 100mg Tabs 35s', 'Sitagliptin'),
(102, 'Gabica 50mg caps 35\'s', 'Pregabalin'),
(103, 'Gabica 75mg caps 35\'s', 'Pregabalin'),
(104, 'Gabica 100mg caps 35\'s', 'Pregabalin'),
(105, 'Gabica 150mg caps 35\'s', 'Pregabalin'),
(106, 'Rovista 10mg Tabs 3x10s', 'Rosuvastatin'),
(107, 'Trevia 50mg Tabs 5x7s', 'Sitagliptin'),
(108, 'Rovista 5mg Tabs 3x10s', 'Rosuvastatin'),
(109, 'Glemont CT-4 Tabs 4mg 10x10s', 'Montelukast'),
(110, 'Glemont CT-5 Tabs 5mg 10x10s', 'Montelukast'),
(111, 'Ibicar-250 Inh 250mcg/Met Dose 200D', 'Beclometasone'),
(112, 'Ibicar-200 Inh 200mcg/Act 200D', 'Beclometasone'),
(113, 'Ibicar-100 Inh 100mcg/Act 200D', 'Beclometasone'),
(114, 'Ibicar-50 Inh 50mcg/Act Met Dose 200D', 'Beclometasone'),
(115, 'Glemont IR- 10 Tabs 10mg 10x10s', 'Montelukast'),
(116, 'Tuspel Plus Syrup 100ml', 'Salbutamol 1mg+Bromhexine 4mg, Ammonium'),
(117, 'Abz Tabs 400Mg 1s', 'Albendazole'),
(118, 'Atm 200 Mango Flavoured 15ml', 'Azithromycin'),
(119, 'Atm 200 Mango Flavoured 30ml', 'Azithromycin'),
(120, 'Atm 250 Tabs 250mg 1X6s', 'Azithromycin'),
(121, 'Atm 500 Tabs 500mg 1X3s', 'Azithromycin'),
(122, 'Cloben Skin Cream 5g', 'Clotrimazole+Beclomethazone  cream'),
(123, 'Febrex Tabs 500mg 10x10s', 'Paracetamol'),
(124, 'Glychek 40 Tabs 40mg 10X10s', 'Gliclazide'),
(125, 'Glychek 80 Tabs 80mg 10X10s', 'Gliclazide'),
(126, 'Metchek 500 Tabs 500mg 10X10s', 'Metformin'),
(127, 'Metchek 850 Tabs 850mg 10X10s', 'Metformin'),
(128, 'Prichek 1mg Tabs 3X10s', 'Glimepiride'),
(129, 'Prichek 2mg Tabs 3X10s', 'Glimepiride'),
(130, 'Tuspel Plus Syrup 60ml', 'Salbutamol 1mg+Bromhexine 4mg, Ammonium'),
(131, 'Powergesic 1%  Gel 30g Tube', 'Diclofenac'),
(132, 'Nervege 75 75mg Caps 10s', 'Pregabalin'),
(133, 'Broadced 1Gm Inj., 1\'S', 'Ceftriaxone'),
(134, 'Clavamox 250 Tabs 375mg 15\'S', 'Co-amoxiclav'),
(135, 'Clavamox Inj 1000', 'Co-amoxiclav'),
(136, 'CLAVAMOX 125 SYRUP 60ML', 'Co-amoxiclav'),
(137, 'Clavamox 500 Tabs 625Mg 3 X 10\'S', 'Co-amoxiclav'),
(138, 'KALFOXIM 1G -1\'S', 'Cefotaximefor'),
(139, 'Klarid 250Mg 3 X 10\'S', 'Clarithromycin'),
(140, 'Glidabet 80Mg , 10 X 10\'S', 'Gliclazide'),
(141, 'Divoltar Tabs 50Mg , 5 X 10\'S', 'Diclofenac Sodium'),
(142, 'Diaflam Tabs 50Mg 5 X10\'S', 'Diclofenac Potassium'),
(143, 'Dometic 10Mg Tabs  , 5 X 10\'S', 'Domperidone'),
(144, 'Kalxetin 20Mg Caps , 3 X 10\'S', 'Fluoxetine'),
(145, 'Dometic Syrup 5mg/5ml, 60 ml   Bottle', 'Domperidone'),
(146, 'Zypraz  0.5mg Tabs,5x10\'s', 'Alprazolam'),
(147, 'Clavamox 250 Tabs 375MG  3x10\'s', 'Co-amoxiclav'),
(148, 'Hexilon 16mg Tabs, 3x10\'s', 'Methylprednisolone'),
(149, 'Hexilon 4mg Tabs, 5x10\'s', 'Methylprednisolone'),
(150, 'Nevox XR ,500mg Tabs,3x10\'s', 'Metformin'),
(151, 'Trifix 200mg Tabs 3x10s', 'Cefixime'),
(152, 'Trifix 100mg/5ml Pow-OralSusp 30ml', 'Cefixime'),
(153, 'Metrix 2mg Tabs 2x15s', 'Glimepiride'),
(154, 'Clavamox Inj 1.2gm 1s', 'Co-amoxiclav'),
(155, 'Clavamox Inj 600mg 1s', 'Co-amoxiclav'),
(156, 'Cefakind 250mg Tabs 3 x10\'s', 'Cefuroxime Axetil'),
(157, 'Cefakind 500mg Tabs 2 x 6\'s', 'Cefuroxime Axetil'),
(158, 'Nuforce 150mg Tabs 1\'s', 'Fluconazole'),
(159, 'Amlokind 5mg Tabs 6 x 10\'s', 'Amlodipine Besilate'),
(160, 'Glykind 80mg Tabs 6 x 10\'s', 'Gliclazide'),
(161, 'Oskar 20mg Caps 10 x 10\'s', 'Omeprazole Delayed'),
(162, 'Moxikind CV 375 Tabs 2 x 6\'s', 'Amoxicillin + Clavulanic Acid'),
(163, 'Moxikind CV 625 Tabs 4 x 6\'s', 'Amoxicillin + Clavulanic Acid'),
(164, 'Metatime 500mg Tabs 10 x 10\'s', 'Metformin Hydrochloride'),
(165, 'Losakind 25mg Tabs 6 x 10\'s', 'Losartan Potassium'),
(166, 'Losakind 50mg Tabs 6 x 10\'s', 'Losartan Potassium'),
(167, 'Mahacef-200 Tabs 200mg 6x10s', 'Cefixime'),
(168, 'Mahacef-100 Tabs 100mg 6x10s', 'Cefixime'),
(169, 'Moxikind CV 156.25mg/5ml OralSusp 100ml', 'Amoxicillin+Clavulanate Potassium'),
(170, 'Pantakind -40  40mg Tabs 6x10\'s', 'Pantoprazole Sodium'),
(171, 'Clopikind-75 Tabs 75mg 6X10s', 'Clopidogrel'),
(172, 'Lipikind-10 Tabs 10mg 6X10s', 'Atorvastatin'),
(173, 'Lipikind-20 Tabs 20mg 6X10s', 'Atorvastatin'),
(174, 'Cefastar 500mg Capsules 6X10s', 'Cephalexin'),
(175, 'Moxikind CV 625 Tabs 2 x 7s', 'Amoxicillin + Clavulanic Acid'),
(176, 'Moxikind CV 375 Tabs 2 x 7s', 'Amoxicillin + Clavulanic Acid'),
(177, 'Cefakind 250mg Tabs 10s', 'Cefuroxime Axetil'),
(178, 'Cefakind 500mg Tabs 10s', 'Cefuroxime Axetil'),
(179, 'Medrol 16mg Tabs ,14\'s', 'Methylprednisolone'),
(180, 'Medrol 4mg Tabs 10x10\'s', 'Methylprednisolone'),
(181, 'Medrol 16mg Tabs 3x10s', 'Methylprednisolone'),
(182, 'Diamicron Tabs 80mg 20\'S', 'Gliclazide'),
(183, 'Amlosun 5 Tabs 5mg 10x10s', 'Amlodipine'),
(184, 'Amlosun 10 Tabs 10mg 10x10s', 'Amlodipine'),
(185, 'Angizem 30 Tabs 30mg 10x10s', 'Diltiazem'),
(186, 'Angizem 60 Tabs 60mg 10x10s', 'Diltiazem'),
(187, 'Angizem CD 90 Caps 90mg 10x10s', 'Diltiazem Hydrochloride'),
(188, 'Aztor 10 Tabs 10mg 5x10s', 'Atorvastatin'),
(189, 'Aztor 20 Tabs 20mg 5x10s', 'Atorvastatin'),
(190, 'Clopilet 75mg Tabs 3x10s', 'Clopidogrel'),
(191, 'Pantocid 20 Tabs 20mg 5x10s', 'Pantoprazole Sodium'),
(192, 'Pantocid 40mg Tabs 5x10s', 'Pantoprazole Sodium'),
(193, 'Pantocid I.V 40mg Inj Vial 1s', 'Pantoprazole for Injection'),
(194, 'Repace 25 Tabs 25mg 10x10s', 'Losartan Potassium'),
(195, 'Repace 50 Tabs 50mg 10x10s', 'Losartan Potassium'),
(196, 'Repace H 50mg+12.5mg Tabs 10x10s', 'Losartan Potas. 50mg+Hydrochl. 12.5mg'),
(197, 'Rozavel 5 Tabs 5mg 3x10s', 'Rosuvastatin'),
(198, 'Rozavel 10 Tabs 10mg 3x10s', 'Rosuvastatin'),
(199, 'Sompraz 20 Tabs 20mg 3x10s', 'Esomeprazole'),
(200, 'Sompraz 40 Tabs 40mg 3x10s', 'Esomeprazole'),
(201, 'Sompraz IV 40mg Inj Vial+5ml Vial 1s', 'Esomeprazole'),
(202, 'Ceroxim 250mg Tabs 10\'S', 'Cefuroxime Axetil'),
(203, 'Ceroxim 500mg Tabs 10\'S', 'Cefuroxime Axetil'),
(204, 'Ceruvin 75mg Tabs 10x10s', 'Clopidogrel'),
(205, 'Cifran Infusion 200mg/100ml', 'Ciprofloxacin'),
(206, 'Cifran Tabs 250mg 2x10\'S', 'Ciprofloxacin'),
(207, 'Cifran Tabs 500mg 2x10\'S', 'Ciprofloxacin'),
(208, 'Enhancin Suspension 100ml', 'Amoxicillin+Clavulanate Potassium'),
(209, 'Enhancin  Tabs 375 ,20\'s', 'Amoxicillin+Clavulanate Potassium'),
(210, 'Enhancin Tabs 625mg 10\'S', 'Amoxicillin+Clavulanate Potassium'),
(211, 'Ranoxyl Caps 250mg 24X10\'S', 'Amoxicillin'),
(212, 'Ranoxyl 500mg Caps 24X2X10\'s', 'Amoxicillin'),
(213, 'Ranoxyl Syrup 125mg 100ml', 'Amoxicillin'),
(214, 'Sporidex Caps 250mg 24 X 10\'S', 'Cephalexin'),
(215, 'Sporidex Caps 500mg 24 X 10\'S', 'Cephalexin'),
(216, 'Sporidex Distab 125mg Tabs 10X10\'s', 'Cephalexin'),
(217, 'Sporidex Syrup 125mg/5ml 100ml', 'Cephalexin'),
(218, 'Volini Gel 30g Tube', 'Diclofenac Diethylamine'),
(219, 'Enhancin  Tabs 625mg  ,20\'s', 'Amoxicillin+Clavulanate Potassium'),
(220, 'Riomet-850 Tabs 850mg 10x10s', 'Metformin'),
(221, 'Riomet-500 Tabs 500mg 10x10s', 'Metformin'),
(222, 'Deplatt 75mg Tabs 10x10s', 'Clopidogrel'),
(223, 'Dilzem -60 60mg Tabs 10x10s', 'Diltiazem Hydrochloride'),
(224, 'Domstal 10mg Tabs 5x2x10s', 'Domperidone'),
(225, 'Epimate -25 25mg Tabs 10x10s', 'Topiramate'),
(226, 'Lamitor -25 25mg Tabs 5x10s', 'Lamotrigine'),
(227, 'Modlip -10 10mg Tabs 10x10s', 'Atorvastatin'),
(228, 'Modlip -20 20mg Tabs 10x10s', 'Atorvastatin'),
(229, 'Nexpro -20 20mg Tabs 10x10s', 'Esomeprazole'),
(230, 'Nexpro -40 40mg Tabs 10x10s', 'Esomeprazole'),
(231, 'Pantor -20 20mg Tabs 10x10s', 'Pantoprazole Sodium'),
(232, 'Pantor -40 40mg Tabs 10x10s', 'Pantoprazole Sodium'),
(233, 'Valparin  Chrono 300mg Tabs 10x10s', 'Sodium Valproate and Valproic Acid'),
(234, 'Valparin 200 Alkalets 200mg Tabs 10x10s', 'Sodium Valproate'),
(235, 'Valparin Chrono 500 333+145mg Tab 10x10s', 'Sodium Valproate and Valproic Acid'),
(236, 'Dilzem -30 30mg Tabs 2x5x10s', 'Diltiazem Hydrochloride'),
(237, 'Carbatol CR 200mg Tabs 10x10s', 'Carbamazepine ER Tablets'),
(238, 'Epimate 50mg Tabs 10x10s', 'Topiramate Tablets'),
(239, 'Omizac 20mg Caps 10x10s', 'Omeprazole'),
(240, 'Dilzem SR 90mg Tabs 2x5x10s', 'Diltiazem Hydrochloride'),
(241, 'Valparin 200mg/5ml OralSol 100ml', 'Sodium Valproate Oral Solution 200mg/5ml'),
(242, 'Tozaar 25mg Tabs 15x7s', 'Losartan Potassium'),
(243, 'Veloz 10, Tabs 5X10\'S', 'Rabeprazole'),
(244, 'Veloz 20, Tabs 5X10\'S', 'Rabeprazole'),
(245, 'Domstal DT 10 Tabs 10x10\'S', 'Domperidone'),
(246, 'Lamitor 100 DT tabs 5 x 10\'s', 'Lamotrigine'),
(247, 'Lamitor 50 DT tabs 5 x 10\'s', 'Lamotrigine'),
(248, 'Topcef 200 Tabs 10X10\'s', 'Cefixime'),
(249, 'Azulix 1mg Tabs 10x10\'S', 'Glimepiride'),
(250, 'Azulix 2mg Tabs 10x10\'S', 'Glimepiride'),
(251, 'Veloz 10 Tabs 10X10\'S', 'Rabeprazole'),
(252, 'Veloz 20 Tabs 15x7\'s', 'Rabeprazole'),
(253, 'Azulix 4mg Tabs 10x10\'S', 'Glimepiride'),
(254, 'Dibeta SR 500mg Tabs 3x10\'s', 'Metformin'),
(255, 'Fluoxetor 20mg Caps 5x2x10\'s', 'Fluoxetine'),
(256, 'Telday 40mg Tabs 10x10\'s', 'Telmisartan'),
(257, 'Telday 80mg Tabs 10x10\'s', 'Telmisartan'),
(258, 'Telday 20mg Tabs 10x10\'s', 'Telmisartan'),
(259, 'Asthator- 10 Tabs 3 X 10\'s', 'Montelukast'),
(260, 'Asthator- 5 Tabs 3 X 10\'s', 'Montelukast'),
(261, 'Telday H Tabs 10 X 10\'s', 'Telmisartan'),
(262, 'Azukon MR Tabs 30mg 10X10s', 'Gliclazide'),
(263, 'Rosucor 20 Tabs 10 x 10s', 'Rosuvastatin'),
(264, 'Rosucor 10 Tabs 10 x 10s', 'Rosuvastatin'),
(265, 'Tolanz - 5 5mg Tabs 3x10s', 'Olanzapine'),
(266, 'Tolanz - 10 10mg Tabs 3x10s', 'Olanzapine'),
(267, 'Lipitor 10mg Tabs ,30\'s', 'Atorvastatin'),
(268, 'Lipitor 20mg Tabs ,30\'s', 'Atorvastatin'),
(269, 'Lyrica 75mg caps 4x14s', 'Pregabalin'),
(270, 'Lyrica 150mg caps 4x14s', 'Pregabalin'),
(271, 'Glycomet 500mg Tabs 5X2X10\'S', 'Metformin'),
(272, 'Puril Tabs 75mg 4 X 7\'S', 'Clopidogrel'),
(273, 'Ecorin Tabs 75mg 10 X 10\'S', 'Aspirin'),
(274, 'Ecorin Tabs 150mg 10 X 10\'S', 'Aspirin'),
(275, 'Glyboral Tabs 5mg 10x10\'S', 'Glibenclamide'),
(276, 'Glynase Tabs 5mg 10 x 10\'S', 'Glipizide'),
(277, 'Glizide 80mg 10x10\'S', 'Gliclazide'),
(278, 'Glycomet 850mg 5X2X10\'S', 'Metformin'),
(279, 'GP 2 Tabs 10 x 10\'s', 'Glimepiride'),
(280, 'GP 1 Tabs 10 x 10\'s', 'Glimepiride'),
(281, 'Glycomet 500 SR tabs 10 x 10\'s', 'Metformin'),
(282, 'Tazloc 20mg Tabs 3x10\'s', 'Telmisartan'),
(283, 'Tazloc 40mg Tabs 3x10\'s', 'Telmisartan'),
(284, 'Tazloc 80mg Tabs 3x10s', 'Telmisartan'),
(285, 'Tazloc - H 40mg + 12.5mg Tabs 3x10s', 'Telmisartan'),
(286, 'Roseday - 10 Tabs 10mg 3x10s', 'Rosuvastatin'),
(287, 'Roseday - 5 Tabs 5mg 3x10s', 'Rosuvastatin'),
(288, 'Paragan 500mg Tabs 10 X 10\'S', 'Paracetamol'),
(289, 'Happi-20Mg Tabs 10X10\'S', 'Rabeprazole'),
(290, 'Amlodac 10Mg Tabs 10X10\'S', 'Amlodipine'),
(291, 'Amlodac 5Mg Tabs 10X10\'S', 'Amlodipine'),
(292, 'Aldren 70 - 70mg Tabs 4\' s', 'Alendronate Sodium'),
(293, 'TOPIRAM 25, Tabs 60\'s', 'Topiramate'),
(294, 'Zydzith-250 250mg Tabs 10x6s', 'Azithromycin'),
(295, 'Montenuzyd 10mg Tabs 3x10s', 'Montelukast'),
(296, 'GABACAP - 300 Caps 300mg 10x10s', 'Gabapentin'),
(297, 'GABACAP - 400 Caps 400mg 10x10s', 'Gabapentin'),
(298, 'Montezyd - 4    4mg Tabs 3x10s', 'Montelukast'),
(299, 'Montezyd - 5   ?5mg Tabs 3x10s', 'Montelukast'),
(300, 'ALFATAM - 0.4mg Caps 3x10s', 'Tamsulosin HCL'),
(301, 'Montezyd - 10    10mg Tabs 3x10s', 'Montelukast'),
(302, 'Chira-20,20mg Tabs 10x10s', 'Esomeprazole'),
(303, 'Chira-40,40mg Tabs 2x10s', 'Esomeprazole'),
(304, 'Zypra- 20 Caps 20mg  10x10s', 'Esomeprazole'),
(305, 'Zypra- 40 Caps 40mg  10x10s', 'Esomeprazole'),
(306, 'Zydzith-500  500mg Tabs 10x10s', 'Azithromycin'),
(307, 'Olandus - 5   5mg Tabs 10x10s', 'Olanzapine'),
(308, 'Topiram 50,Tabs 60s', 'Topiramate'),
(309, 'Lamidus DT 50 ,50mg tabs 5x10s', 'Lamotrigine');

-- --------------------------------------------------------

--
-- Table structure for table `nurses`
--

CREATE TABLE `nurses` (
  `nurse_ID` int(11) NOT NULL,
  `first_Name` varchar(64) NOT NULL,
  `last_Name` varchar(128) NOT NULL,
  `display_Name` varchar(40) NOT NULL,
  `signIn_Method` varchar(10) NOT NULL,
  `email` varchar(40) NOT NULL,
  `contact_Number` int(10) NOT NULL,
  `home_Address` varchar(100) NOT NULL,
  `NIC` int(11) NOT NULL,
  `registration_No` varchar(25) NOT NULL,
  `qualifications` varchar(100) NOT NULL,
  `department` varchar(20) NOT NULL,
  `specialization` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nurses`
--

INSERT INTO `nurses` (`nurse_ID`, `first_Name`, `last_Name`, `display_Name`, `signIn_Method`, `email`, `contact_Number`, `home_Address`, `NIC`, `registration_No`, `qualifications`, `department`, `specialization`) VALUES
(1254638, 'Senali', 'De Silva', 'Senali De Silva', 'Email', 'senali123@gmail.com', 774936420, 'Reid Avenue, Colombo 07', 21002185, 'N353962H1', '', '0', '');

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `patient_ID` int(11) NOT NULL,
  `first_Name` varchar(128) NOT NULL,
  `last_Name` varchar(256) NOT NULL,
  `display_Name` varchar(256) NOT NULL,
  `home_Address` varchar(512) NOT NULL,
  `NIC` varchar(512) DEFAULT NULL,
  `contact_Number` varchar(10) NOT NULL,
  `DOB` date NOT NULL,
  `age` int(11) NOT NULL,
  `gender` varchar(128) NOT NULL,
  `height` float NOT NULL,
  `weight` float NOT NULL,
  `emergency_Contact_Person` varchar(512) NOT NULL,
  `emergency_Contact_Number` varchar(10) NOT NULL,
  `relationship` varchar(128) NOT NULL,
  `email_address` varchar(128) DEFAULT NULL,
  `signIn_Method` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`patient_ID`, `first_Name`, `last_Name`, `display_Name`, `home_Address`, `NIC`, `contact_Number`, `DOB`, `age`, `gender`, `height`, `weight`, `emergency_Contact_Person`, `emergency_Contact_Number`, `relationship`, `email_address`, `signIn_Method`) VALUES
(12355, 'Annabeth', 'Walker', 'Annabeth Walker', 'No.07, Reid Avenue, Colombo 07', '200160601256', '0766072001', '1998-04-04', 26, 'Female', 172, 43, 'Brian Henricus', '0741654770', 'Husband', 'annabethwalker22@gmail.com', 'email'),
(12368, 'Masha', 'Wickramasinghe', 'Masha Wickramasinghe', '365/13, 2nd lane, Shanthi Mw, Makumbura-Pannipitiya', '200168601630', '0774936420', '2001-07-04', 23, 'Female', 156, 50, 'Chandi Wickramasinghe', '0741654770', 'Mother', 'mashawickramasinghe04@gmail.com', 'email'),
(1254659, 'Rusara', 'Wimalasena', 'Rusara Wimalasena', 'Katubedda, Moratuwa', '200129604078', '+947749364', '2001-10-22', 23, 'male', 180, 62, 'Asitha Wimalasena', '0741654770', '', 'rusara.wimalasena123@gmail.com', 'phone'),
(1254660, 'Chandrika', 'Wickramasinghe', 'Chandrika Wickramasinghe', '365/13, kottawa', '41354100230', '0774936420', '1970-12-18', 53, 'female', 160, 52, 'Thusitha Wickramasinghe', '0741654770', '', 'chandiwickramasinghe1970@gmail.com', 'email'),
(1254661, 'ghbfhfg', 'gfhf', 'Sarinaa', 'sfsfs', '125455', '', '0000-00-00', 0, '', 0, 0, '', '', '', 'tgdggt', ''),
(1254662, 'rfsfs', 'es', 'who are u', 'sfsfs', '125583513', '', '0000-00-00', 0, '', 0, 0, '', '', '', 'tdgeeergt', ''),
(1254663, 'sffss', 'sfsfs', 'lasitttth', 'sdfsdfs', '1525466', '', '0000-00-00', 0, '', 0, 0, '', '', '', 'hhfhfhrtr', ''),
(1254664, 'sfsds', 'sdfsf', 'bimsaraaa', 'sdfsd', '564653', '', '0000-00-00', 0, '', 0, 0, '', '', '', 'rrytrgrth', ''),
(1254665, 'sfsd', 'sdfdsd', 'ravijaaaa', 'sfsds', '13565843', '', '0000-00-00', 0, '', 0, 0, '', '', '', 'rytrgtrrr', ''),
(1254666, 'sdffs', 'sdfsd', 'saumyaaa', 'fsfssf', '135353', '', '0000-00-00', 0, '', 0, 0, '', '', '', 'rtryrgtg', ''),
(1254667, 'dsfsdds', 'sdfsfds', 'dilkiii', 'kottaa', '313565843', '', '0000-00-00', 0, '', 0, 0, '', '', '', 'trgtrgrtrg', ''),
(1254668, 'sdfsds', 'sdfssdd', 'gaaal', 'sdfsdfsd', '12355135', '', '0000-00-00', 0, '', 0, 0, '', '', '', 'rtgrgrgety4r', ''),
(1254669, 'sdffs', 'dsdf', 'kavihsaa', 'sdfsfsd', '32134653', '', '0000-00-00', 0, '', 0, 0, '', '', '', 'etgegt', ''),
(1254670, 'sfsfsd', 'sdfs', 'sfs', 'sdfsd', '3213658635', '', '0000-00-00', 0, '', 0, 0, '', '', '', 'getgge', '');

-- --------------------------------------------------------

--
-- Table structure for table `patients_medications`
--

CREATE TABLE `patients_medications` (
  `id` int(11) NOT NULL,
  `patient_ID` int(10) NOT NULL,
  `prescription_ID` int(10) NOT NULL,
  `medication_ID` int(10) NOT NULL,
  `medication` varchar(255) NOT NULL,
  `remark` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patients_medications`
--

INSERT INTO `patients_medications` (`id`, `patient_ID`, `prescription_ID`, `medication_ID`, `medication`, `remark`) VALUES
(9, 12355, 1251, 6, 'Prompin-40 Tabs 40mg 5x10s', '52/1'),
(10, 12355, 1251, 6, 'Prompin-40 Tabs 40mg 5x10s', '52/1'),
(11, 12355, 1251, 4, 'Rabe 20 Tabs 20mg 10 X 10s', '42/1');

-- --------------------------------------------------------

--
-- Table structure for table `pharmacists`
--

CREATE TABLE `pharmacists` (
  `pharmacist_ID` int(11) NOT NULL,
  `first_Name` varchar(20) NOT NULL,
  `last_Name` varchar(40) NOT NULL,
  `email` varchar(64) NOT NULL,
  `contact_Number` int(10) NOT NULL,
  `method_of_signin` varchar(10) NOT NULL,
  `home_Address` varchar(255) NOT NULL,
  `NIC` varchar(20) NOT NULL,
  `specialization` varchar(64) DEFAULT NULL,
  `gender` varchar(10) NOT NULL,
  `registration_No` varchar(20) NOT NULL,
  `qualifications` varchar(255) NOT NULL,
  `department` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pharmacists`
--

INSERT INTO `pharmacists` (`pharmacist_ID`, `first_Name`, `last_Name`, `email`, `contact_Number`, `method_of_signin`, `home_Address`, `NIC`, `specialization`, `gender`, `registration_No`, `qualifications`, `department`) VALUES
(6, 'ihsan', 'riyal', 'ihsanahmed@gmail.com', 773453453, '', '', '', NULL, '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `prescriptions`
--

CREATE TABLE `prescriptions` (
  `prescription_ID` int(11) NOT NULL,
  `doctor_ID` int(11) NOT NULL,
  `prescription_Date` date NOT NULL,
  `diagnosis` varchar(512) NOT NULL,
  `patient_ID` int(11) NOT NULL,
  `appointment_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `prescriptions`
--

INSERT INTO `prescriptions` (`prescription_ID`, `doctor_ID`, `prescription_Date`, `diagnosis`, `patient_ID`, `appointment_ID`) VALUES
(1251, 12356, '2024-01-03', 'Hypertension (High Blood Pressure)', 12368, 4),
(1252, 12358, '2024-01-31', 'Type 2 Diabetes Mellitus', 12368, 5);

-- --------------------------------------------------------

--
-- Table structure for table `receptionists`
--

CREATE TABLE `receptionists` (
  `receptionist_ID` int(11) NOT NULL,
  `first_Name` varchar(20) NOT NULL,
  `last_Name` varchar(40) NOT NULL,
  `email` varchar(128) NOT NULL,
  `contact_Number` int(10) NOT NULL,
  `signIn_Method` varchar(10) NOT NULL,
  `home_Address` varchar(255) NOT NULL,
  `NIC` varchar(20) NOT NULL,
  `specialization` varchar(32) DEFAULT NULL,
  `gender` varchar(10) NOT NULL,
  `registration_No` varchar(20) DEFAULT NULL,
  `qualifications` varchar(255) DEFAULT NULL,
  `department` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `receptionists`
--

INSERT INTO `receptionists` (`receptionist_ID`, `first_Name`, `last_Name`, `email`, `contact_Number`, `signIn_Method`, `home_Address`, `NIC`, `specialization`, `gender`, `registration_No`, `qualifications`, `department`) VALUES
(8, 'akmal', 'sanuj', 'akmal@gmail.com', 0, '', '', '', '', '', NULL, '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `session_ID` int(11) NOT NULL,
  `doctor_ID` int(11) NOT NULL,
  `doctorName` varchar(512) NOT NULL,
  `sessionDate` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `total_appointments` int(11) NOT NULL,
  `current_appointment` int(11) NOT NULL,
  `current_appointment_time` time NOT NULL,
  `sessionCharge` int(11) NOT NULL,
  `nurse_ID` int(100) NOT NULL,
  `room_no` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`session_ID`, `doctor_ID`, `doctorName`, `sessionDate`, `start_time`, `end_time`, `total_appointments`, `current_appointment`, `current_appointment_time`, `sessionCharge`, `nurse_ID`, `room_no`) VALUES
(58, 12356, 'Asanka Rathanayake', '2024-04-23', '11:00:00', '23:00:00', 20, 8, '20:10:00', 4000, 1254638, 10),
(59, 12358, 'Saumya Sewwandi', '2024-04-24', '00:00:00', '00:00:00', 10, 2, '00:00:00', 2500, 1254638, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tests`
--

CREATE TABLE `tests` (
  `test_ID` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `reference_range` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tests`
--

INSERT INTO `tests` (`test_ID`, `name`, `reference_range`) VALUES
(1, 'Alanine Transaminase (ALT/SGPT)', '7-56 U/L'),
(2, 'Aspartate Transaminase (AST/SGOT)', '5-40 U/L'),
(3, 'Bilirubin - Total', '0.3-1.2 mg/dL'),
(4, 'Bleeding Time/Clotting Time', 'Bleeding Time: < 9 minutes\r\nClotting Time: 6-15 minutes'),
(5, 'Blood Picture', ''),
(6, 'Cholesterol - Total', '< 200 mg/dL'),
(7, 'C - Reactive Protein (CRP)', '< 10 mg/L'),
(8, 'Creatinine - Serum', 'M - 0.6-1.3 mg/dL, \r\nF - 0.5-1.1 mg/dL'),
(9, 'Electrolytes', 'Sodium: 135-145 mmol/L\r\nPotassium: 3.5-5.0 mmol/L\r\nChloride: 98-'),
(10, 'ESR - Erythrocyte Sedimentation Rate', 'M: 0-22 mm/hr\r\nF: 0-29 mm/hr'),
(11, 'Filaria Antibody Test (FAT)', ''),
(12, 'Free Thyroxine (FT4)', '0.8-1.8 ng/dL'),
(13, 'Free Triiodothyronine (FT3)', '2.3-4.2 pg/mL'),
(14, 'Full Blood Count', ''),
(15, 'Glucose Fasting - Blood', '70-100 mg/dL'),
(16, 'Glucose Postprandial (PPBS)', '< 140 mg/dL'),
(17, 'C Grouping Blood', ''),
(18, 'Haemoglobin (HB)', 'M: 13.8-17.2 g/dL\r\nF: 12.1-15.1 g/dL'),
(19, 'HBA1C (Glycosylated Haemoglobin)', '< 5.7%'),
(20, 'Lipid Profile', ''),
(21, 'Liver Profile', ''),
(22, 'Pregnancy Test - Urine', ''),
(23, 'Prothrombin Time (PT INR)', '0.8-1.2 INR'),
(24, 'Renal Profile', '0.8-1.2 INR'),
(25, 'Speciman for AFB', ''),
(26, 'Stool Culture & ABST', ''),
(27, 'Stool Full Report', ''),
(28, 'Thyroid Profile', ''),
(29, 'Urea - Blood', '7-20 mg/dL'),
(30, 'Uric Acid - Serum', 'M: 3.4-7.0 mg/dL\r\nF: 2.4-6.0 mg/dL'),
(31, 'Urine Culture & ABST', ''),
(32, 'Urine Full Report', ''),
(33, 'Urine Full Report ref Laboratory VDRL', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_ID` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email_phone` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `first_Name` varchar(255) NOT NULL,
  `last_Name` varchar(255) NOT NULL,
  `role` varchar(25) NOT NULL,
  `active` tinyint(1) DEFAULT 0,
  `activation_code` varchar(255) NOT NULL,
  `activation_expiry` datetime NOT NULL,
  `activated_at` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `method_of_signin` varchar(10) NOT NULL,
  `two_factor_auth` varchar(5) NOT NULL DEFAULT 'off',
  `otp_code` varchar(128) DEFAULT NULL,
  `profile_photo` varchar(1024) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_ID`, `username`, `email_phone`, `password`, `first_Name`, `last_Name`, `role`, `active`, `activation_code`, `activation_expiry`, `activated_at`, `created_at`, `updated_at`, `method_of_signin`, `two_factor_auth`, `otp_code`, `profile_photo`) VALUES
(1, '', '', '', '', '', 'admin', 0, '', '2024-04-23 10:31:31', NULL, '2024-04-23 08:31:38', '2024-04-23 14:02:26', '', 'off', NULL, ''),
(4, '', '', '', '', '', 'health supervisor', 0, '', '2024-04-23 10:32:01', NULL, '2024-04-23 08:32:14', '2024-04-23 14:02:14', '', 'off', NULL, ''),
(5, '', '', '', '', '', 'lab technician', 0, '', '2024-04-23 10:32:59', NULL, '2024-04-23 08:33:05', '2024-04-23 14:03:05', '', 'off', NULL, ''),
(6, '', '', '', '', '', 'pharmacist', 0, '', '2024-04-23 10:33:48', NULL, '2024-04-23 08:33:56', '2024-04-23 14:03:56', '', 'off', NULL, ''),
(8, '', '', '', '', '', 'receptionist', 0, '', '2024-04-23 10:34:21', NULL, '2024-04-23 08:34:34', '2024-04-23 14:04:34', '', 'off', NULL, ''),
(12355, 'Annabeth_Walker', 'annabethwalker22@gmail.com', '$2y$10$GCjpsrbYaqYkC7ZKe3zhkuxIc3TshBCfQTNytw3Xn87/L6B6B61MW', 'Annabeth', 'Walker', 'Patient', 1, '316204', '2024-01-31 08:29:17', '2024-01-30 13:00:09', '2024-01-30 07:29:17', '2024-02-23 09:55:32', '', '', '', ''),
(12356, 'Asanka Rathnayake', 'asankarathnayake@gmail.com', '$2y$10$HEvicb4tA/14Y2L0KFDYWuzGeXlyUEMxo5xVuz/yMAzBButbKqRq2', 'Asanka', 'Rathnayake', 'Doctor', 0, '316204', '2024-01-31 08:31:34', NULL, '2024-01-30 07:31:34', '2024-04-19 13:20:27', '', '', '', '21001227.jpg'),
(12358, 'Saumya_Sewwandi', 'saumyasewwandi05@gmail.com', '$2y$10$5M2tdcJx3s6dMjOBqrPwj.UuLX5oksHhVcqFIz5pIFR6GEB3pQyc2', 'Saumya', 'Sewwandi', 'Doctor', 0, '316204', '2024-01-31 12:53:29', NULL, '2024-01-30 11:53:29', '2024-04-19 18:38:05', '', '', '', '21000166.jpg'),
(12368, 'Masha_wickramasinghe', 'mashawickramasinghe04@gmail.com', '$2y$10$rMTX3NF50WEABRQvfPTk1OTarnsq5NIiaV9XMR.7HZbjlSzNBjzlS', 'Masha', 'Wickramasinghe', 'Patient', 1, '316204', '2024-01-31 17:22:48', '2024-01-30 21:54:20', '2024-01-30 16:22:48', '2024-04-22 09:01:57', 'Email', 'off', '$2y$10$V9lLbbrr4blgiOM2zAmSBOR8AV./tcUjYtiQu1y.EafzEm0KzUTkK', '21002185.jpg'),
(1254638, 'Senali_De_Silva', 'senali123@gmail.com', '$2y$10$5M2tdcJx3s6dMjOBqrPwj.UuLX5oksHhVcqFIz5pIFR6GEB3pQyc2', 'Senali', 'De Silva', 'Nurse', 1, '316204', '2024-02-17 16:09:54', '2024-02-17 20:39:55', '2024-02-17 15:10:55', '2024-04-22 10:42:43', 'Email', '', '', '21000166.jpg'),
(1254659, 'Rusara_Wimalasena', '+94774936420', '$2y$10$T1TMljhn8mc1y2eD10kX3uiATtLt6DWjzsC2ay2y1DZAvHKomYQVK', 'Rusara', 'Wimalasena', 'Patient', 1, '$2y$10$LCHHL5J5I6sJ/TJlURdQJObS22jhypfH.15sCElP01NZFuH0QLvpu', '2024-02-24 05:45:29', '2024-02-23 10:19:48', '2024-02-23 04:45:29', '2024-04-08 11:58:52', 'Phone', 'on', '$2y$10$n6QWLvPYfzyPnneXJq1LDum5RAvrugO936VYeSNdZJ6tB1JRRbFnO', ''),
(1254660, 'Chandrika_Wickramasinghe', 'chandiwickramasinghe1970@gmail.com', '$2y$10$xaDk6ncxcMhvG7JXOZyKi.oX209TVFoOgtyPQs5yknczsvH0grfDC', 'Chandrika', 'Wickramasinghe', 'Patient', 1, '$2y$10$CintCdcAs62V8OMMyQuwve8MlwqkoClwNQMrJkStEb/VQXCiZMNv6', '2024-04-22 08:24:09', '2024-04-21 11:55:08', '2024-04-21 06:24:09', '2024-04-21 11:55:08', 'Email', 'off', NULL, ''),
(1254661, '', 'test123@gmail.com', '', 'Ravija', 'Sdkka', 'Patient', 1, '', '2024-04-22 08:11:18', NULL, '2024-04-22 06:13:53', '2024-04-22 11:43:53', '', 'off', NULL, ''),
(1254662, '', 'test1234@gmail.com', '', 'dhaddgia', 'ajksdiaoaj', '', 1, '', '2024-04-22 08:11:18', NULL, '2024-04-22 06:13:53', '2024-04-22 11:43:53', '', 'off', NULL, ''),
(1254663, '', 'test1235@gmail.com', '', 'ffisdfowf', 'sdnouahdoeadl', '', 1, '', '2024-04-22 08:11:18', NULL, '2024-04-22 06:13:53', '2024-04-22 11:43:53', '', 'off', NULL, ''),
(1254664, '', 'test1236@gmail.com', '', 'sdkasdla', 'ajshsj', '', 0, '', '2024-04-22 08:11:18', NULL, '2024-04-22 06:13:53', '2024-04-22 11:43:53', '', 'off', NULL, ''),
(1254665, '', 'test1237@gmail.com', '', 'ndakdlas', 'sajkdjsndl', '', 0, '', '2024-04-22 08:11:18', NULL, '2024-04-22 06:13:53', '2024-04-22 11:43:53', '', 'off', NULL, ''),
(1254666, '', 'test12377@gmail.com', '', 'janadal', 'anlaskdlauhs', '', 0, '', '2024-04-22 08:11:18', NULL, '2024-04-22 06:13:53', '2024-04-22 11:43:53', '', 'off', NULL, ''),
(1254667, '', 'test12883@gmail.com', '', 'slfsfjk', 'adhdoasuhas', '', 0, '', '2024-04-22 08:11:18', NULL, '2024-04-22 06:13:53', '2024-04-22 11:43:53', '', 'off', NULL, ''),
(1254668, '', 'test123000@gmail.com', '', 'jhdkahhdau', 'ajkdkahaha', '', 0, '', '2024-04-22 08:11:18', NULL, '2024-04-22 06:13:53', '2024-04-22 11:43:53', '', 'off', NULL, ''),
(1254669, '', 'test12300000@gmail.com', '', 'jkdlakjdask', 'adnasndlak', '', 0, '', '2024-04-22 08:11:18', NULL, '2024-04-22 06:13:53', '2024-04-22 11:43:53', '', 'off', NULL, ''),
(1254670, '', 'test123665666666@gmail.com', '', 'jduhdakdl', 'jkanak;ks', '', 0, '', '2024-04-22 08:11:18', NULL, '2024-04-22 06:13:53', '2024-04-22 11:43:53', '', 'off', NULL, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_ID`);

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`appointment_ID`),
  ADD KEY `fk_AppointmentsPatients` (`patient_ID`),
  ADD KEY `doctor_ID` (`doctor_ID`),
  ADD KEY `session_ID` (`session_ID`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`doctor_ID`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `contact_Number` (`contact_Number`),
  ADD UNIQUE KEY `NIC` (`NIC`),
  ADD UNIQUE KEY `registration_No` (`registration_No`);

--
-- Indexes for table `healthsupervisors`
--
ALTER TABLE `healthsupervisors`
  ADD PRIMARY KEY (`supervisor_ID`);

--
-- Indexes for table `inquiries`
--
ALTER TABLE `inquiries`
  ADD PRIMARY KEY (`inquiry_ID`),
  ADD KEY `patient_ID` (`patient_ID`);

--
-- Indexes for table `labtechnicians`
--
ALTER TABLE `labtechnicians`
  ADD PRIMARY KEY (`labtech_ID`);

--
-- Indexes for table `lab_reports`
--
ALTER TABLE `lab_reports`
  ADD PRIMARY KEY (`report_ID`),
  ADD KEY `doctor_ID` (`doctor_ID`),
  ADD KEY `patient_ID` (`patient_ID`),
  ADD KEY `test_ID` (`test_ID`),
  ADD KEY `prescription_ID` (`prescription_ID`);

--
-- Indexes for table `medication`
--
ALTER TABLE `medication`
  ADD PRIMARY KEY (`id`),
  ADD KEY `name` (`name`);

--
-- Indexes for table `medicine_data`
--
ALTER TABLE `medicine_data`
  ADD PRIMARY KEY (`medicine_ID`),
  ADD UNIQUE KEY `material_Description` (`material_Description`);

--
-- Indexes for table `nurses`
--
ALTER TABLE `nurses`
  ADD PRIMARY KEY (`nurse_ID`),
  ADD UNIQUE KEY `NIC` (`NIC`),
  ADD UNIQUE KEY `registration_No` (`registration_No`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`patient_ID`),
  ADD UNIQUE KEY `NIC` (`NIC`),
  ADD UNIQUE KEY `email_address` (`email_address`);

--
-- Indexes for table `patients_medications`
--
ALTER TABLE `patients_medications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patient_ID` (`patient_ID`),
  ADD KEY `prescription_ID` (`prescription_ID`),
  ADD KEY `medication_ID` (`medication_ID`);

--
-- Indexes for table `pharmacists`
--
ALTER TABLE `pharmacists`
  ADD PRIMARY KEY (`pharmacist_ID`);

--
-- Indexes for table `prescriptions`
--
ALTER TABLE `prescriptions`
  ADD PRIMARY KEY (`prescription_ID`),
  ADD KEY `patient_ID` (`patient_ID`),
  ADD KEY `doctor_ID` (`doctor_ID`),
  ADD KEY `appointment_ID` (`appointment_ID`);

--
-- Indexes for table `receptionists`
--
ALTER TABLE `receptionists`
  ADD PRIMARY KEY (`receptionist_ID`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`session_ID`),
  ADD KEY `doctor_ID` (`doctor_ID`),
  ADD KEY `nurse_ID` (`nurse_ID`);

--
-- Indexes for table `tests`
--
ALTER TABLE `tests`
  ADD PRIMARY KEY (`test_ID`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `appointment_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `doctor_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12359;

--
-- AUTO_INCREMENT for table `healthsupervisors`
--
ALTER TABLE `healthsupervisors`
  MODIFY `supervisor_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `inquiries`
--
ALTER TABLE `inquiries`
  MODIFY `inquiry_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `lab_reports`
--
ALTER TABLE `lab_reports`
  MODIFY `report_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;

--
-- AUTO_INCREMENT for table `medication`
--
ALTER TABLE `medication`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=310;

--
-- AUTO_INCREMENT for table `medicine_data`
--
ALTER TABLE `medicine_data`
  MODIFY `medicine_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=310;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `patient_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1254671;

--
-- AUTO_INCREMENT for table `patients_medications`
--
ALTER TABLE `patients_medications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `prescriptions`
--
ALTER TABLE `prescriptions`
  MODIFY `prescription_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1253;

--
-- AUTO_INCREMENT for table `sessions`
--
ALTER TABLE `sessions`
  MODIFY `session_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124595;

--
-- AUTO_INCREMENT for table `tests`
--
ALTER TABLE `tests`
  MODIFY `test_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1254671;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admins`
--
ALTER TABLE `admins`
  ADD CONSTRAINT `admins_ibfk_1` FOREIGN KEY (`admin_ID`) REFERENCES `users` (`user_ID`),
  ADD CONSTRAINT `admins_ibfk_2` FOREIGN KEY (`admin_ID`) REFERENCES `users` (`user_ID`),
  ADD CONSTRAINT `admins_ibfk_3` FOREIGN KEY (`admin_ID`) REFERENCES `users` (`user_ID`);

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_ibfk_1` FOREIGN KEY (`patient_ID`) REFERENCES `patients` (`patient_ID`),
  ADD CONSTRAINT `appointments_ibfk_2` FOREIGN KEY (`patient_ID`) REFERENCES `patients` (`patient_ID`),
  ADD CONSTRAINT `appointments_ibfk_3` FOREIGN KEY (`doctor_ID`) REFERENCES `doctors` (`doctor_ID`),
  ADD CONSTRAINT `appointments_ibfk_4` FOREIGN KEY (`session_ID`) REFERENCES `sessions` (`session_ID`),
  ADD CONSTRAINT `fk_AppointmentsPatients` FOREIGN KEY (`patient_ID`) REFERENCES `patients` (`patient_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `doctors`
--
ALTER TABLE `doctors`
  ADD CONSTRAINT `doctors_ibfk_1` FOREIGN KEY (`doctor_ID`) REFERENCES `users` (`user_ID`);

--
-- Constraints for table `healthsupervisors`
--
ALTER TABLE `healthsupervisors`
  ADD CONSTRAINT `healthsupervisors_ibfk_1` FOREIGN KEY (`supervisor_ID`) REFERENCES `users` (`user_ID`);

--
-- Constraints for table `inquiries`
--
ALTER TABLE `inquiries`
  ADD CONSTRAINT `inquiries_ibfk_1` FOREIGN KEY (`patient_ID`) REFERENCES `patients` (`patient_ID`);

--
-- Constraints for table `labtechnicians`
--
ALTER TABLE `labtechnicians`
  ADD CONSTRAINT `labtechnicians_ibfk_1` FOREIGN KEY (`labtech_ID`) REFERENCES `users` (`user_ID`);

--
-- Constraints for table `lab_reports`
--
ALTER TABLE `lab_reports`
  ADD CONSTRAINT `lab_reports_ibfk_1` FOREIGN KEY (`patient_ID`) REFERENCES `patients` (`patient_ID`),
  ADD CONSTRAINT `lab_reports_ibfk_2` FOREIGN KEY (`prescription_ID`) REFERENCES `prescriptions` (`prescription_ID`);

--
-- Constraints for table `medication`
--
ALTER TABLE `medication`
  ADD CONSTRAINT `medication_ibfk_1` FOREIGN KEY (`id`) REFERENCES `medicine_data` (`medicine_ID`),
  ADD CONSTRAINT `medication_ibfk_2` FOREIGN KEY (`name`) REFERENCES `medicine_data` (`material_Description`);

--
-- Constraints for table `nurses`
--
ALTER TABLE `nurses`
  ADD CONSTRAINT `nurses_ibfk_1` FOREIGN KEY (`nurse_ID`) REFERENCES `users` (`user_ID`);

--
-- Constraints for table `patients`
--
ALTER TABLE `patients`
  ADD CONSTRAINT `patients_ibfk_1` FOREIGN KEY (`patient_ID`) REFERENCES `users` (`user_ID`);

--
-- Constraints for table `patients_medications`
--
ALTER TABLE `patients_medications`
  ADD CONSTRAINT `patients_medications_ibfk_1` FOREIGN KEY (`patient_ID`) REFERENCES `patients` (`patient_ID`),
  ADD CONSTRAINT `patients_medications_ibfk_2` FOREIGN KEY (`medication_ID`) REFERENCES `medication` (`id`),
  ADD CONSTRAINT `patients_medications_ibfk_3` FOREIGN KEY (`prescription_ID`) REFERENCES `prescriptions` (`prescription_ID`),
  ADD CONSTRAINT `patients_medications_ibfk_4` FOREIGN KEY (`medication_ID`) REFERENCES `medicine_data` (`medicine_ID`);

--
-- Constraints for table `pharmacists`
--
ALTER TABLE `pharmacists`
  ADD CONSTRAINT `pharmacists_ibfk_1` FOREIGN KEY (`pharmacist_ID`) REFERENCES `users` (`user_ID`);

--
-- Constraints for table `prescriptions`
--
ALTER TABLE `prescriptions`
  ADD CONSTRAINT `prescriptions_ibfk_1` FOREIGN KEY (`patient_ID`) REFERENCES `patients` (`patient_ID`),
  ADD CONSTRAINT `prescriptions_ibfk_2` FOREIGN KEY (`doctor_ID`) REFERENCES `doctors` (`doctor_ID`),
  ADD CONSTRAINT `prescriptions_ibfk_3` FOREIGN KEY (`appointment_ID`) REFERENCES `appointments` (`appointment_ID`);

--
-- Constraints for table `receptionists`
--
ALTER TABLE `receptionists`
  ADD CONSTRAINT `receptionists_ibfk_1` FOREIGN KEY (`receptionist_ID`) REFERENCES `users` (`user_ID`);

--
-- Constraints for table `sessions`
--
ALTER TABLE `sessions`
  ADD CONSTRAINT `sessions_ibfk_1` FOREIGN KEY (`doctor_ID`) REFERENCES `doctors` (`doctor_ID`),
  ADD CONSTRAINT `sessions_ibfk_2` FOREIGN KEY (`nurse_ID`) REFERENCES `nurses` (`nurse_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
