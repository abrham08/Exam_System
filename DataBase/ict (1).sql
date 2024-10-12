-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 11, 2024 at 05:51 PM
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
-- Database: `ict`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `Department` varchar(100) DEFAULT NULL,
  `user_id` varchar(21) NOT NULL,
  `user_type` varchar(21) NOT NULL,
  `title` varchar(20) DEFAULT NULL,
  `fname` varchar(24) NOT NULL,
  `lname` varchar(23) NOT NULL,
  `gname` varchar(24) NOT NULL,
  `phone` int(25) NOT NULL,
  `email` varchar(27) NOT NULL,
  `email_stat` int(5) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `user_name` varchar(24) NOT NULL,
  `password` varchar(100) NOT NULL,
  `status` int(5) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`Department`, `user_id`, `user_type`, `title`, `fname`, `lname`, `gname`, `phone`, `email`, `email_stat`, `photo`, `user_name`, `password`, `status`) VALUES
('compsci456211', 'ABE3391366', 'Head', 'Mr.', 'Abebaw', 'Agegn', 'Agegne', 928576893, 'abebawagegndtu@gmail.com', 1, '', 'admin1', '$2y$10$7Of7gNHaqQKAp/J/o8zvD.35luhCRIhXfvbwVLvDcTbvzuw5FEkOG', 1),
('plan6587231', 'ABR4594932', 'Head', 'Mr.', 'Abrham', 'Nigussie', 'Abuhay', 930112123, 'abrhamgelawu@gmail.com', 1, '', 'test2', '$2y$10$7Of7gNHaqQKAp/J/o8zvD.35luhCRIhXfvbwVLvDcTbvzuw5FEkOG', 1),
('plan6587231', 'ABR7285737', 'Teacher', 'Mr.', 'Abrham', 'Gelawu', 'Yetsub', 930112123, 'abrhamgelawu@gmail.com', 1, '', 'test', '$2y$10$7Of7gNHaqQKAp/J/o8zvD.35luhCRIhXfvbwVLvDcTbvzuw5FEkOG', 1),
('compsci456211', 'GIZ9954331', 'Teacher', 'Mr.', 'Gizachew', 'Mulu', 'Setegn', 931163288, 'gizachewmulucs@gmail.com', 1, '', 'admin2', '$2y$10$7Of7gNHaqQKAp/J/o8zvD.35luhCRIhXfvbwVLvDcTbvzuw5FEkOG', 1),
('HR', 'HEN6117151', 'HR', 'Mr.', 'Henok', 'Alemu', 'Erkei', 930112123, 'projectge777@gmail.com', 1, 'HEN6117151.jpg', 'hadmin', '$2y$10$7Of7gNHaqQKAp/J/o8zvD.35luhCRIhXfvbwVLvDcTbvzuw5FEkOG', 1),
('Registrar', 'HEN9675137', 'Registrar', 'Mr.', 'Alemu', 'Kindalem', 'Erkei', 930112123, 'projectge777@gmail.com', 1, 'HEN9675137.jpg', 'admin3', '$2y$10$7Of7gNHaqQKAp/J/o8zvD.35luhCRIhXfvbwVLvDcTbvzuw5FEkOG', 1),
('Super', 'super75521134', 'Super', 'Mr.', 'Musie', 'Tibebu', 'Kelemewerk', 930497288, 'abrhamgelawu@gmail.com', 1, NULL, 'suadmin', '$2y$10$7Of7gNHaqQKAp/J/o8zvD.35luhCRIhXfvbwVLvDcTbvzuw5FEkOG', 1);

-- --------------------------------------------------------

--
-- Table structure for table `asscategory`
--

CREATE TABLE `asscategory` (
  `cat_no` int(100) NOT NULL,
  `Department` varchar(57) NOT NULL,
  `cat_id` varchar(50) NOT NULL,
  `date` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `asscategory`
--

INSERT INTO `asscategory` (`cat_no`, `Department`, `cat_id`, `date`) VALUES
(52, 'compsci456211', 'MOD2571656', '14-06-23 20:43:06'),
(54, 'compsci456211', 'PLA6232654', '20-06-23 14:02:22'),
(55, 'compsci456211', 'DTE3498718', '23-06-23 05:17:36');

-- --------------------------------------------------------

--
-- Table structure for table `assexam`
--

CREATE TABLE `assexam` (
  `id` int(255) NOT NULL,
  `exam_category` varchar(15) DEFAULT NULL,
  `exam_id` varchar(65) DEFAULT NULL,
  `assigned_by` varchar(55) DEFAULT NULL,
  `assigned_Department` varchar(65) DEFAULT NULL,
  `assigned_group` varchar(65) DEFAULT NULL,
  `assigned_year` varchar(65) DEFAULT NULL,
  `examiner` varchar(40) DEFAULT NULL,
  `exam_date` date DEFAULT NULL,
  `start_time` varchar(5) DEFAULT NULL,
  `estatus` int(6) DEFAULT 0,
  `im_status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `assexam`
--

INSERT INTO `assexam` (`id`, `exam_category`, `exam_id`, `assigned_by`, `assigned_Department`, `assigned_group`, `assigned_year`, `examiner`, `exam_date`, `start_time`, `estatus`, `im_status`) VALUES
(131, 'Regular', 'TES87463923977824639', 'plan6587231', 'compsci456211', 'Regular', '4', 'ABR4594932', '2023-06-20', '03:45', 1, 1),
(132, 'Regular', 'TES87463923977824639', 'plan6587231', 'compsci456211', 'Extension', '5', 'ABR7285737', '2023-06-26', '23:00', 1, 1),
(137, 'Regular', 'DEM96149566852544873', 'compsci456211', 'compsci456211', 'Regular', '4', 'GIZ9954331', '2024-10-11', '12:26', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `cat_id` varchar(60) NOT NULL,
  `cat_code` varchar(55) DEFAULT NULL,
  `college` varchar(55) NOT NULL,
  `stream` varchar(55) NOT NULL,
  `cat_type` varchar(23) NOT NULL,
  `cat_name` varchar(100) NOT NULL,
  `exam_date` varchar(15) DEFAULT NULL,
  `start_time` varchar(5) DEFAULT NULL,
  `apply_limit` int(11) DEFAULT NULL,
  `required_limit` int(11) DEFAULT NULL,
  `stat` int(3) NOT NULL DEFAULT 0,
  `dep_stat` int(3) NOT NULL DEFAULT 0,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cat_id`, `cat_code`, `college`, `stream`, `cat_type`, `cat_name`, `exam_date`, `start_time`, `apply_limit`, `required_limit`, `stat`, `dep_stat`, `date`) VALUES
('DTE3498718', 'D1033', 'plan6587231', 'Degree', 'COC', 'Dtest', NULL, NULL, NULL, NULL, 0, 0, '2023-06-23'),
('MOD2571656', 'CoSc2084', 'compsci456211', 'Degree', 'COC', 'Demo Exam ', NULL, NULL, NULL, NULL, 0, 0, '2014-06-23');

-- --------------------------------------------------------

--
-- Table structure for table `college`
--

CREATE TABLE `college` (
  `col_id` varchar(55) NOT NULL,
  `stream` varchar(25) NOT NULL,
  `col_name` varchar(101) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `college`
--

INSERT INTO `college` (`col_id`, `stream`, `col_name`) VALUES
('agri21907hh', 'NS', 'College of Agriculture and Plant'),
('colnancomsc2456', 'NS', 'College of Natural and Computational Science'),
('colsosci3217', 'SC', 'College of Social Science'),
('law5541', 'SS', 'School of Law');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `id` int(100) NOT NULL,
  `catDepartment` varchar(55) NOT NULL,
  `Department` varchar(55) NOT NULL,
  `cat_id` varchar(23) NOT NULL,
  `assigned_teacher` varchar(50) DEFAULT 'empty',
  `assigned_group` varchar(25) DEFAULT NULL,
  `assigned_year` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`id`, `catDepartment`, `Department`, `cat_id`, `assigned_teacher`, `assigned_group`, `assigned_year`) VALUES
(134, 'compsci456211', 'compsci456211', 'MOD2571656', 'GIZ9954331', 'Regular', '4'),
(135, 'compsci456211', 'compsci456211', 'MOD2571656', 'GIZ9954331', 'Extension', '5'),
(140, 'plan6587231', 'compsci456211', 'DTE3498718', 'ABR7285737', 'Regular', '4'),
(141, 'plan6587231', 'compsci456211', 'DTE3498718', 'ABR7285737', 'Extension', '5');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `dep_id` varchar(55) NOT NULL,
  `dep_name` varchar(55) NOT NULL,
  `stream` varchar(55) DEFAULT NULL,
  `col_id` varchar(55) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`dep_id`, `dep_name`, `stream`, `col_id`) VALUES
('ani6588231', 'Animal Science', 'NS', 'agri21907hh'),
('compsci456211', 'Computer Science', 'NS', 'colnancomsc2456'),
('ic7784123', 'ICT', 'NS', 'colnancomsc2456'),
('plan6587231', 'Plant Science', 'NS', 'agri21907hh'),
('sta78923446', 'Statitstics', 'NS', 'colnancomsc2456');

-- --------------------------------------------------------

--
-- Table structure for table `displine`
--

CREATE TABLE `displine` (
  `dis_code` int(20) NOT NULL,
  `wtype` int(5) DEFAULT NULL,
  `uid` varchar(40) DEFAULT NULL,
  `cat_id` varchar(100) NOT NULL,
  `exam_id` varchar(100) NOT NULL,
  `reason` longtext DEFAULT NULL,
  `rread` int(5) DEFAULT 1,
  `blocker` varchar(23) NOT NULL,
  `date` varchar(23) DEFAULT NULL,
  `time` varchar(24) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `exam`
--

CREATE TABLE `exam` (
  `cat_id` varchar(34) DEFAULT NULL,
  `exam_id` varchar(24) NOT NULL,
  `creator_dep` varchar(55) DEFAULT NULL,
  `exam_category` varchar(15) DEFAULT NULL,
  `exam_type` varchar(25) DEFAULT NULL,
  `exam_creator` varchar(55) DEFAULT NULL,
  `exam_name` varchar(200) DEFAULT NULL,
  `exam_value` double DEFAULT NULL,
  `exam_nq` int(50) DEFAULT NULL,
  `exam_time` float DEFAULT NULL,
  `exam_date` date DEFAULT NULL,
  `start_time` varchar(6) DEFAULT NULL,
  `sttatus` int(5) DEFAULT 0,
  `estatus` tinyint(3) NOT NULL DEFAULT 0,
  `examiner` varchar(24) DEFAULT NULL,
  `num_student` int(55) DEFAULT NULL,
  `download` int(2) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `HR` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `exam`
--

INSERT INTO `exam` (`cat_id`, `exam_id`, `creator_dep`, `exam_category`, `exam_type`, `exam_creator`, `exam_name`, `exam_value`, `exam_nq`, `exam_time`, `exam_date`, `start_time`, `sttatus`, `estatus`, `examiner`, `num_student`, `download`, `date`, `HR`) VALUES
('MOD2571656', 'DEM96149566852544873', 'compsci456211', 'Regular', 'Practise', 'GIZ9954331', 'Demo_Exam_1', 5, 5, 5, '2024-10-11', '12:26', 1, 0, NULL, NULL, 1, '2011-10-24', NULL),
('MOD2571656', 'MOD26924555698929252', 'compsci456211', 'Special', 'Real', 'GIZ9954331', 'Model One 2016', 10, 109, 100, '2024-10-11', '11:08', 1, 1, NULL, NULL, 1, '2017-06-23', NULL),
('MOC2132939', 'MOD65383726273746144', 'compsci456211', 'Regular', 'Real', 'TES2273212', 'Model Test', 50, 35, 55, '2023-06-14', '04:48', 3, 0, NULL, NULL, 1, '2014-06-23', NULL),
('MOD2571656', 'MOD84981219413119185', 'compsci456211', 'Regular', 'Real', 'BIR1147316', 'Model Exam', 100, 100, 100, '2023-06-24', '03:40', 3, 0, NULL, NULL, 1, '2017-06-23', NULL),
('DTE3498718', 'TES87463923977824639', 'plan6587231', 'Regular', 'Real', 'ABR7285737', 'Test_One', 120, 110, 100, '2023-06-25', '01:00', 1, 0, NULL, NULL, 1, '2023-06-23', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `examinee`
--

CREATE TABLE `examinee` (
  `uiid` varchar(30) NOT NULL,
  `examinee_type` varchar(55) NOT NULL,
  `stream` varchar(24) DEFAULT NULL,
  `college` varchar(55) DEFAULT NULL,
  `Department` varchar(55) DEFAULT NULL,
  `program` varchar(55) DEFAULT NULL,
  `ex_group` varchar(100) DEFAULT NULL,
  `ex_year` int(5) DEFAULT NULL,
  `fname` varchar(20) DEFAULT NULL,
  `lname` varchar(20) DEFAULT NULL,
  `gname` varchar(24) DEFAULT NULL,
  `gender` varchar(25) DEFAULT NULL,
  `phone` int(15) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `email_stat` int(11) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `user_name` varchar(24) NOT NULL,
  `password` varchar(100) DEFAULT NULL,
  `rpass` varchar(55) DEFAULT NULL,
  `displin` varchar(255) DEFAULT '0',
  `sttatus` int(1) NOT NULL DEFAULT 1,
  `date` varchar(20) DEFAULT NULL,
  `job_cat` varchar(55) DEFAULT NULL,
  `o_phone` varchar(15) DEFAULT NULL,
  `p_location` varchar(255) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `birth_date` varchar(20) DEFAULT NULL,
  `nationality` varchar(44) DEFAULT NULL,
  `e_back` varchar(88) DEFAULT NULL,
  `field_study` varchar(88) DEFAULT NULL,
  `n_id` varchar(65) DEFAULT NULL,
  `doc` varchar(255) DEFAULT NULL,
  `eight_doc` varchar(55) DEFAULT NULL,
  `ten_doc` varchar(55) DEFAULT NULL,
  `twelve_doc` varchar(55) DEFAULT NULL,
  `diploma_doc` varchar(55) DEFAULT NULL,
  `degree_doc` varchar(55) DEFAULT NULL,
  `masters_doc` varchar(55) DEFAULT NULL,
  `doctor_doc` varchar(55) DEFAULT NULL,
  `cv` varchar(65) DEFAULT NULL,
  `app_letter` varchar(255) DEFAULT NULL,
  `vstatus` int(11) DEFAULT 0,
  `ex_status` int(11) DEFAULT NULL,
  `final_status` int(11) DEFAULT NULL,
  `reg_by` varchar(55) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `examinee`
--

INSERT INTO `examinee` (`uiid`, `examinee_type`, `stream`, `college`, `Department`, `program`, `ex_group`, `ex_year`, `fname`, `lname`, `gname`, `gender`, `phone`, `email`, `email_stat`, `photo`, `user_name`, `password`, `rpass`, `displin`, `sttatus`, `date`, `job_cat`, `o_phone`, `p_location`, `age`, `birth_date`, `nationality`, `e_back`, `field_study`, `n_id`, `doc`, `eight_doc`, `ten_doc`, `twelve_doc`, `diploma_doc`, `degree_doc`, `masters_doc`, `doctor_doc`, `cv`, `app_letter`, `vstatus`, `ex_status`, `final_status`, `reg_by`) VALUES
('ABR9341', 'Student', 'NS', 'colnancomsc2456', 'compsci456211', 'Degree', 'Regular', 4, 'Abrham', 'Gelaw', 'Yetsub', 'Male', 0, '', 0, 'ABR9341.jpg', 'DKU1200467', '$2y$10$Ak.xuZR6osLfoYWh9R.EA.FIYW9ZBD06HrzggICo7G7otlEUDfwmy', 'GELAW1391', '0', 1, '12-06-23 07:20:16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'HEN9675137'),
('BEM6951', 'Student', 'NS', 'colnancomsc2456', 'compsci456211', 'Degree', 'Regular', 4, 'Bemnet', 'Belete', 'Gebeyehu', 'Female', 0, '', 1, 'BEM6951.jpg', 'DKU1200794', '$2y$10$8AwRxZ.iOdtBPvBhaPTlE.FLP4AbP7urbDhhCYM21sdv.D2Hqg9Yy', 'Belete2336', '0', 1, '12-06-23 07:20:16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'HEN9675137'),
('BIR4215', 'Student', 'NS', 'colnancomsc2456', 'compsci456211', 'Degree', 'Regular', 4, 'Biruk', 'Taye', 'Asfaw', 'Male', 0, '', 1, 'BIR4215.jpg', 'DKU1200908', '$2y$10$qGB5ZsIi6ikF2AvF580CIudQY67MOy7EdFkPuphSZakwq.lrTvzt.', 'Taye4224', '0', 1, '12-06-23 07:20:16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'HEN9675137'),
('DEM9175', 'Student', 'NS', 'colnancomsc2456', 'compsci456211', 'Degree', 'Regular', 4, 'Demo', 'Demo', 'Ag', 'Male', 0, '', 0, 'DEM9175.jpeg', 'Demo', '$2y$10$5wDpTomXgC1xvxH0FExDvuV8oBHKadmP16o5VA.Qp/KKtNFCRt0IC', 'Demo3853', '0', 1, '11-10-24 11:22:08', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'HEN9675137');

-- --------------------------------------------------------

--
-- Table structure for table `ex_group`
--

CREATE TABLE `ex_group` (
  `group_id` varchar(24) NOT NULL,
  `group_name` varchar(23) NOT NULL,
  `stream` varchar(21) DEFAULT NULL,
  `status` int(5) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ex_group`
--

INSERT INTO `ex_group` (`group_id`, `group_name`, `stream`, `status`) VALUES
('Extention', 'Extension', 'Extension', 1),
('Regular', 'Regular', 'Regular', 1),
('Summer', 'Summer', 'Summer', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ex_year`
--

CREATE TABLE `ex_year` (
  `ex_group` varchar(24) NOT NULL,
  `year_id` varchar(23) NOT NULL,
  `year_no` int(7) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ex_year`
--

INSERT INTO `ex_year` (`ex_group`, `year_id`, `year_no`, `status`) VALUES
('regular', '1', 1, 1),
('regular', '2', 2, 1),
('regular', '3', 3, 1),
('regular', '4', 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `final_result`
--

CREATE TABLE `final_result` (
  `id` int(11) NOT NULL,
  `uid` varchar(55) NOT NULL,
  `exam_id` varchar(255) DEFAULT NULL,
  `cat_id` varchar(55) NOT NULL,
  `etype` varchar(24) DEFAULT NULL,
  `correct` int(30) DEFAULT NULL,
  `wrong` int(25) DEFAULT NULL,
  `attempt` int(25) DEFAULT NULL,
  `stat` tinyint(3) DEFAULT NULL,
  `total` float DEFAULT NULL,
  `result` float DEFAULT NULL,
  `date` varchar(26) NOT NULL,
  `finish_reason` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `id` int(24) NOT NULL,
  `uid` varchar(55) NOT NULL,
  `cat_id` varchar(55) NOT NULL,
  `exam_id` varchar(55) NOT NULL,
  `exam_type` varchar(55) DEFAULT NULL,
  `qid` varchar(55) NOT NULL,
  `quest_type` varchar(55) NOT NULL,
  `uans` longtext DEFAULT NULL,
  `cans` longtext DEFAULT NULL,
  `total` varchar(10) DEFAULT NULL,
  `stat` int(3) DEFAULT NULL,
  `ts` varchar(24) DEFAULT NULL,
  `result` varchar(24) DEFAULT NULL,
  `date` varchar(15) DEFAULT NULL,
  `op` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`id`, `uid`, `cat_id`, `exam_id`, `exam_type`, `qid`, `quest_type`, `uans`, `cans`, `total`, `stat`, `ts`, `result`, `date`, `op`) VALUES
(10369, 'DEM9175', 'MOD2571656', 'DEM96149566852544873', 'Real', 'DEMBX9TOX9NUGX5X9L', 'choose', '1', '3', '0', 0, '', NULL, '11-10-24 11:26:', NULL),
(10370, 'DEM9175', 'MOD2571656', 'DEM96149566852544873', 'Real', 'DEMCIX34TG3991G73F', 'choose', '2', '2', '1', 1, '', NULL, '11-10-24 11:26:', NULL),
(10371, 'DEM9175', 'MOD2571656', 'DEM96149566852544873', 'Real', 'DEM3693XY47J7AUCRB', 'choose', '3', '2', '0', 0, '', NULL, '11-10-24 11:26:', NULL),
(10372, 'DEM9175', 'MOD2571656', 'DEM96149566852544873', 'Real', 'DEM9HE1M14J4MH216K', 'choose', '4', '4', '1', 1, '', NULL, '11-10-24 11:26:', NULL),
(10373, 'DEM9175', 'MOD2571656', 'DEM96149566852544873', 'Real', 'DEM3IJTBHNF74J3147', 'choose', '1', '1', '1', 1, '', NULL, '11-10-24 11:26:', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `notice`
--

CREATE TABLE `notice` (
  `nid` varchar(24) NOT NULL,
  `type` varchar(24) DEFAULT NULL,
  `cat` int(10) DEFAULT 1,
  `cstat` int(5) DEFAULT NULL,
  `no` varchar(24) DEFAULT NULL,
  `notice` longtext DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `stat` int(5) DEFAULT NULL,
  `date` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notice`
--

INSERT INTO `notice` (`nid`, `type`, `cat`, `cstat`, `no`, `notice`, `title`, `description`, `stat`, `date`) VALUES
('2iiz0#', '1', 1, 1, 'qass', 'img/notice/img/e2.jpg', 'DKU', '', 0, '12-06-23 1'),
('aMT6u#', '1', 1, 1, 'qwerrryy', 'img/notice/img/e3.jpg', 'DKU', '', 1, '12-06-23 1'),
('AosfJ#', '2', 1, 1, '556644dd', 'img/notice/video/20221210_235608.mp4', 'ddd', 'dd', 0, '01-06-23 1'),
('ASo5B#', '1', 1, 1, 'dfgds54554', 'img/notice/img/347553771_167633499564610_2147894597765035232_n (1).jpg', 'DKUOES', '', 0, '12-06-23 1'),
('CXTKQ#', '1', 1, 1, 'N6633', 'img/notice/img/IMG_20210124_191641_0.png', 'DKU at Night', '', 0, '11-06-23 1'),
('euPBF#', '1', 1, 1, 'N6633', 'img/notice/img/IMG_20210124_191641_0.png', 'DKU at Night', '', 0, '11-06-23 1'),
('eXH6D#', '1', 1, 1, '557722120', 'img/notice/img/347402771_249364394441624_8103778201009474558_n.jpg', 'DKU OES', '', 1, '12-06-23 1'),
('IIEdM#', '1', 1, 1, 'N6633', 'img/notice/img/IMG_20210124_191641_0.png', 'DKU at Night', '', 0, '11-06-23 1'),
('IzVPq#', '1', 1, 1, 'N6633', 'img/notice/img/IMG_20210124_191641_0.png', 'DKU at Night', '', 0, '11-06-23 1'),
('jZ6G6', '1', 1, 1, '3', 'notice/img/5 (2).jpg', 'bb', '', 0, '09-11-22 0'),
('kDgu2#', '2', 1, 1, '556644dd', 'img/notice/video/20221210_235608.mp4', 'ddd', 'dd', 0, '01-06-23 1'),
('n9O6g', '2', 1, NULL, '777', 'notice/video/Journey Through Ethiopia - Africa Travel Documentary 00_00_07-00_00_36.mp4', 'ET', 'MY', 0, '02-11-22 2'),
('nDkmd#', '1', 1, 1, 'qwerrryy', 'img/notice/img/e3.jpg', 'DKU', '', 0, '12-06-23 1'),
('oZsqt#', '1', 1, 1, 'qwerrryy', 'img/notice/img/e3.jpg', 'DKU', '', 0, '12-06-23 1'),
('Pct24#', '1', 1, 1, 'N6633', 'img/notice/img/IMG_20210124_191641_0.png', 'DKU at Night', '', 0, '11-06-23 1'),
('XKK30#', '1', 1, 1, 'dfgds54554', 'img/notice/img/347553771_167633499564610_2147894597765035232_n (1).jpg', 'DKUOES', '', 0, '12-06-23 1'),
('xz6Gs#', '1', 1, 1, 'N6633', 'img/notice/img/IMG_20210124_191641_0.png', 'DKU at Night', '', 0, '11-06-23 1'),
('YANIV#', '1', 1, 1, 'dfgds54554', 'img/notice/img/347553771_167633499564610_2147894597765035232_n (1).jpg', 'DKUOES', '', 1, '12-06-23 1');

-- --------------------------------------------------------

--
-- Table structure for table `option_list`
--

CREATE TABLE `option_list` (
  `id` int(5) NOT NULL,
  `cat_id` varchar(30) NOT NULL,
  `exam_id` varchar(50) NOT NULL,
  `quest_type` varchar(24) NOT NULL,
  `quest_id` varchar(58) NOT NULL,
  `opt_no` int(58) DEFAULT NULL,
  `ot` longtext NOT NULL,
  `option_image` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `option_list`
--

INSERT INTO `option_list` (`id`, `cat_id`, `exam_id`, `quest_type`, `quest_id`, `opt_no`, `ot`, `option_image`) VALUES
(929, 'MOC2132939', 'MOD65383726273746144', 'choose', 'MODX2JKHZTU373392E', 1, 'N', ''),
(930, 'MOC2132939', 'MOD65383726273746144', 'choose', 'MODX2JKHZTU373392E', 2, 'N-1', ''),
(931, 'MOC2132939', 'MOD65383726273746144', 'choose', 'MODX2JKHZTU373392E', 3, 'N+1', ''),
(932, 'MOC2132939', 'MOD65383726273746144', 'choose', 'MODX2JKHZTU373392E', 4, 'N2', ''),
(933, 'MOC2132939', 'MOD65383726273746144', 'choose', 'MOD4ZJ1OOHW873NLUJ', 1, ' interface between the hardware and application programs', ''),
(934, 'MOC2132939', 'MOD65383726273746144', 'choose', 'MOD4ZJ1OOHW873NLUJ', 2, 'collection of programs that manages hardware resources', ''),
(935, 'MOC2132939', 'MOD65383726273746144', 'choose', 'MOD4ZJ1OOHW873NLUJ', 3, 'system service provider to the application programs', ''),
(936, 'MOC2132939', 'MOD65383726273746144', 'choose', 'MOD4ZJ1OOHW873NLUJ', 4, 'all of the mentioned', ''),
(937, 'MOC2132939', 'MOD65383726273746144', 'choose', 'MODMNKGTAY4E1L99JC', 1, 'Binary heap', ''),
(938, 'MOC2132939', 'MOD65383726273746144', 'choose', 'MODMNKGTAY4E1L99JC', 2, 'Quick sort', ''),
(939, 'MOC2132939', 'MOD65383726273746144', 'choose', 'MODMNKGTAY4E1L99JC', 3, 'Merge sort', ''),
(940, 'MOC2132939', 'MOD65383726273746144', 'choose', 'MODMNKGTAY4E1L99JC', 4, 'Radix sort', ''),
(941, 'MOC2132939', 'MOD65383726273746144', 'choose', 'MOD4N2RTG8YAJXE2HX', 1, 'O(N)', ''),
(942, 'MOC2132939', 'MOD65383726273746144', 'choose', 'MOD4N2RTG8YAJXE2HX', 2, 'O(N log N)', ''),
(943, 'MOC2132939', 'MOD65383726273746144', 'choose', 'MOD4N2RTG8YAJXE2HX', 3, 'O(log N)', ''),
(944, 'MOC2132939', 'MOD65383726273746144', 'choose', 'MOD4N2RTG8YAJXE2HX', 4, 'O(N2)', ''),
(945, 'MOC2132939', 'MOD65383726273746144', 'choose', 'MODH4J9F3AOJE2NML7', 1, 'to provide the interface between the API and application program', ''),
(946, 'MOC2132939', 'MOD65383726273746144', 'choose', 'MODH4J9F3AOJE2NML7', 2, ' to handle the files in the operating system', ''),
(947, 'MOC2132939', 'MOD65383726273746144', 'choose', 'MODH4J9F3AOJE2NML7', 3, ' to get and execute the next user-specified command', ''),
(948, 'MOC2132939', 'MOD65383726273746144', 'choose', 'MODH4J9F3AOJE2NML7', 4, 'none of the mentioned', ''),
(949, 'MOC2132939', 'MOD65383726273746144', 'choose', 'MOD4672429MHHE194I', 1, 'True', ''),
(950, 'MOC2132939', 'MOD65383726273746144', 'choose', 'MOD4672429MHHE194I', 2, 'False', ''),
(951, 'MOC2132939', 'MOD65383726273746144', 'choose', 'MODG3OZ8UGLB2Y9CEE', 1, '6', ''),
(952, 'MOC2132939', 'MOD65383726273746144', 'choose', 'MODG3OZ8UGLB2Y9CEE', 2, ' 5', ''),
(953, 'MOC2132939', 'MOD65383726273746144', 'choose', 'MODG3OZ8UGLB2Y9CEE', 3, '7', ''),
(954, 'MOC2132939', 'MOD65383726273746144', 'choose', 'MODG3OZ8UGLB2Y9CEE', 4, '1', ''),
(955, 'MOC2132939', 'MOD65383726273746144', 'choose', 'MODO9ROA3E823A8E24', 1, 'Priority', ''),
(956, 'MOC2132939', 'MOD65383726273746144', 'choose', 'MODO9ROA3E823A8E24', 2, 'Round Robin', ''),
(957, 'MOC2132939', 'MOD65383726273746144', 'choose', 'MODO9ROA3E823A8E24', 3, 'Shortest Job First', ''),
(958, 'MOC2132939', 'MOD65383726273746144', 'choose', 'MODO9ROA3E823A8E24', 4, 'All of the mentioned', ''),
(959, 'MOC2132939', 'MOD65383726273746144', 'choose', 'MODZX7A2JRZ347X2HB', 1, 'arranging a pack of playing cards', ''),
(960, 'MOC2132939', 'MOD65383726273746144', 'choose', 'MODZX7A2JRZ347X2HB', 2, 'database scenarios and distributes scenarios', ''),
(961, 'MOC2132939', 'MOD65383726273746144', 'choose', 'MODZX7A2JRZ347X2HB', 3, 'arranging books on a library shelf', ''),
(962, 'MOC2132939', 'MOD65383726273746144', 'choose', 'MODZX7A2JRZ347X2HB', 4, 'real-time systems', ''),
(963, 'MOC2132939', 'MOD65383726273746144', 'choose', 'MOD77B2G9FJA42CZE8', 1, 'set of categories and methods that specify the functioning, organisation, and implementation of computer systems', ''),
(964, 'MOC2132939', 'MOD65383726273746144', 'choose', 'MOD77B2G9FJA42CZE8', 2, 'set of principles and methods that specify the functioning, organisation, and implementation of computer systems', ''),
(965, 'MOC2132939', 'MOD65383726273746144', 'choose', 'MOD77B2G9FJA42CZE8', 3, ' set of functions and methods that specify the functioning, organisation, and implementation of computer systems', ''),
(966, 'MOC2132939', 'MOD65383726273746144', 'choose', 'MOD77B2G9FJA42CZE8', 4, 'None of the mentioned', ''),
(967, 'MOC2132939', 'MOD65383726273746144', 'choose', 'MODN4EB473EJBFLT7E', 1, 'Library', ''),
(968, 'MOC2132939', 'MOD65383726273746144', 'choose', 'MODN4EB473EJBFLT7E', 2, ' System calls', ''),
(969, 'MOC2132939', 'MOD65383726273746144', 'choose', 'MODN4EB473EJBFLT7E', 3, 'Assembly instructions', ''),
(970, 'MOC2132939', 'MOD65383726273746144', 'choose', 'MODN4EB473EJBFLT7E', 4, 'API', ''),
(971, 'MOC2132939', 'MOD65383726273746144', 'choose', 'MOD4OMI54CEB2XX8H9', 1, 'Microarchitecture', ''),
(972, 'MOC2132939', 'MOD65383726273746144', 'choose', 'MOD4OMI54CEB2XX8H9', 2, 'Harvard Architecture', ''),
(973, 'MOC2132939', 'MOD65383726273746144', 'choose', 'MOD4OMI54CEB2XX8H9', 3, 'Von-Neumann Architecture', ''),
(974, 'MOC2132939', 'MOD65383726273746144', 'choose', 'MOD4OMI54CEB2XX8H9', 4, 'All of the mentioned', ''),
(975, 'MOC2132939', 'MOD65383726273746144', 'choose', 'MOD7XK6CWJA442LO6G', 1, ' Microarchitecture', ''),
(976, 'MOC2132939', 'MOD65383726273746144', 'choose', 'MOD7XK6CWJA442LO6G', 2, 'Harvard Architecture', ''),
(977, 'MOC2132939', 'MOD65383726273746144', 'choose', 'MOD7XK6CWJA442LO6G', 3, 'Von-Neumann Architecture', ''),
(978, 'MOC2132939', 'MOD65383726273746144', 'choose', 'MOD7XK6CWJA442LO6G', 4, 'System Design', ''),
(979, 'MOC2132939', 'MOD65383726273746144', 'choose', 'MODGRNMM5T8J5464LU', 1, ' multiprogramming operating systems', ''),
(980, 'MOC2132939', 'MOD65383726273746144', 'choose', 'MODGRNMM5T8J5464LU', 2, ' larger memory sized systems', ''),
(981, 'MOC2132939', 'MOD65383726273746144', 'choose', 'MODGRNMM5T8J5464LU', 3, 'multiprocessor systems', ''),
(982, 'MOC2132939', 'MOD65383726273746144', 'choose', 'MODGRNMM5T8J5464LU', 4, ' none of the mentioned', ''),
(983, 'MOC2132939', 'MOD65383726273746144', 'choose', 'MODEUNU7XELRC2LTG7', 1, 'RISC', ''),
(984, 'MOC2132939', 'MOD65383726273746144', 'choose', 'MODEUNU7XELRC2LTG7', 2, 'ISA', ''),
(985, 'MOC2132939', 'MOD65383726273746144', 'choose', 'MODEUNU7XELRC2LTG7', 3, 'IANA', ''),
(986, 'MOC2132939', 'MOD65383726273746144', 'choose', 'MODEUNU7XELRC2LTG7', 4, 'CISC', ''),
(987, 'MOC2132939', 'MOD65383726273746144', 'choose', 'MODXWRJO2BXH4A8434', 1, 'Data of Binary Management System', ''),
(988, 'MOC2132939', 'MOD65383726273746144', 'choose', 'MODXWRJO2BXH4A8434', 2, 'Database Management System', ''),
(989, 'MOC2132939', 'MOD65383726273746144', 'choose', 'MODXWRJO2BXH4A8434', 3, 'Database Management Service', ''),
(990, 'MOC2132939', 'MOD65383726273746144', 'choose', 'MODXWRJO2BXH4A8434', 4, ' Data Backup Management System', ''),
(991, 'MOC2132939', 'MOD65383726273746144', 'choose', 'MODGG4MJZA62G6X153', 1, 'SDRAMâ€™s', ''),
(992, 'MOC2132939', 'MOD65383726273746144', 'choose', 'MODGG4MJZA62G6X153', 2, 'Heaps', ''),
(993, 'MOC2132939', 'MOD65383726273746144', 'choose', 'MODGG4MJZA62G6X153', 3, 'Cacheâ€™s', ''),
(994, 'MOC2132939', 'MOD65383726273746144', 'choose', 'MODGG4MJZA62G6X153', 4, 'Higher capacity RAMâ€™s', ''),
(995, 'MOC2132939', 'MOD65383726273746144', 'choose', 'MOD2EGH2UJKAUXZ3X7', 1, 'Program Counter', ''),
(996, 'MOC2132939', 'MOD65383726273746144', 'choose', 'MOD2EGH2UJKAUXZ3X7', 2, 'Flag', ''),
(997, 'MOC2132939', 'MOD65383726273746144', 'choose', 'MOD2EGH2UJKAUXZ3X7', 3, 'Main Memory', ''),
(998, 'MOC2132939', 'MOD65383726273746144', 'choose', 'MOD2EGH2UJKAUXZ3X7', 4, 'Secondary Memory', ''),
(999, 'MOC2132939', 'MOD65383726273746144', 'choose', 'MOD1KX9G749R65R567', 1, 'NMOS', ''),
(1000, 'MOC2132939', 'MOD65383726273746144', 'choose', 'MOD1KX9G749R65R567', 2, 'HMOS', ''),
(1001, 'MOC2132939', 'MOD65383726273746144', 'choose', 'MOD1KX9G749R65R567', 3, 'PMOS', ''),
(1002, 'MOC2132939', 'MOD65383726273746144', 'choose', 'MOD1KX9G749R65R567', 4, 'TTL', ''),
(1003, 'MOC2132939', 'MOD65383726273746144', 'choose', 'MODJ2YGCZGMJRAW736', 1, ' Organized collection of information that cannot be accessed, updated, and managed', ''),
(1004, 'MOC2132939', 'MOD65383726273746144', 'choose', 'MODJ2YGCZGMJRAW736', 2, 'Collection of data or information without organizing', ''),
(1005, 'MOC2132939', 'MOD65383726273746144', 'choose', 'MODJ2YGCZGMJRAW736', 3, 'Organized collection of data or information that can be accessed, updated, and managed', ''),
(1006, 'MOC2132939', 'MOD65383726273746144', 'choose', 'MODJ2YGCZGMJRAW736', 4, ' Organized collection of data that cannot be updated', ''),
(1007, 'MOC2132939', 'MOD65383726273746144', 'choose', 'MODO634292LYK6EY97', 1, '8-bits â€“ 64 bits', ''),
(1008, 'MOC2132939', 'MOD65383726273746144', 'choose', 'MODO634292LYK6EY97', 2, '4-bits â€“ 32 bits', ''),
(1009, 'MOC2132939', 'MOD65383726273746144', 'choose', 'MODO634292LYK6EY97', 3, '8-bits â€“ 16 bits', ''),
(1010, 'MOC2132939', 'MOD65383726273746144', 'choose', 'MODO634292LYK6EY97', 4, '8-bits â€“ 32 bits', ''),
(1011, 'MOC2132939', 'MOD65383726273746144', 'choose', 'MODHC37N79E12HJAEY', 1, 'DBMS is a collection of queries', ''),
(1012, 'MOC2132939', 'MOD65383726273746144', 'choose', 'MODHC37N79E12HJAEY', 2, ' DBMS is a high-level language', ''),
(1013, 'MOC2132939', 'MOD65383726273746144', 'choose', 'MODHC37N79E12HJAEY', 3, ' DBMS is a programming language', ''),
(1014, 'MOC2132939', 'MOD65383726273746144', 'choose', 'MODHC37N79E12HJAEY', 4, 'DBMS stores, modifies and retrieves data', ''),
(1015, 'MOC2132939', 'MOD65383726273746144', 'choose', 'MOD7JG53CGM2THXRUE', 1, '01,0011,010101', ''),
(1016, 'MOC2132939', 'MOD65383726273746144', 'choose', 'MOD7JG53CGM2THXRUE', 2, '0011,11001100', ''),
(1017, 'MOC2132939', 'MOD65383726273746144', 'choose', 'MOD7JG53CGM2THXRUE', 3, 'Îµ,0011,11001100', ''),
(1018, 'MOC2132939', 'MOD65383726273746144', 'choose', 'MOD7JG53CGM2THXRUE', 4, 'Îµ,0011,11001100', ''),
(1019, 'MOC2132939', 'MOD65383726273746144', 'choose', 'MODRZ313HHYL911OIH', 1, ' Image oriented data', ''),
(1020, 'MOC2132939', 'MOD65383726273746144', 'choose', 'MODRZ313HHYL911OIH', 2, 'Text, files containing data', ''),
(1021, 'MOC2132939', 'MOD65383726273746144', 'choose', 'MODRZ313HHYL911OIH', 3, 'Data in the form of audio or video', ''),
(1022, 'MOC2132939', 'MOD65383726273746144', 'choose', 'MODRZ313HHYL911OIH', 4, 'All of the above', ''),
(1023, 'MOC2132939', 'MOD65383726273746144', 'choose', 'MODI42WZN33NWWOFT8', 1, 'Input alphabet', ''),
(1024, 'MOC2132939', 'MOD65383726273746144', 'choose', 'MODI42WZN33NWWOFT8', 2, 'Transition function', ''),
(1025, 'MOC2132939', 'MOD65383726273746144', 'choose', 'MODI42WZN33NWWOFT8', 3, ' Initial State', ''),
(1026, 'MOC2132939', 'MOD65383726273746144', 'choose', 'MODI42WZN33NWWOFT8', 4, 'Output Alphabet', ''),
(1027, 'MOC2132939', 'MOD65383726273746144', 'choose', 'MODHOGF38492973H3G', 1, '7', ''),
(1028, 'MOC2132939', 'MOD65383726273746144', 'choose', 'MODHOGF38492973H3G', 2, '6', ''),
(1029, 'MOC2132939', 'MOD65383726273746144', 'choose', 'MODHOGF38492973H3G', 3, '8', ''),
(1030, 'MOC2132939', 'MOD65383726273746144', 'choose', 'MODHOGF38492973H3G', 4, '5', ''),
(1031, 'MOC2132939', 'MOD65383726273746144', 'choose', 'MODK92J8ZZEEJA4X29', 1, 'Hierarchical', ''),
(1032, 'MOC2132939', 'MOD65383726273746144', 'choose', 'MODK92J8ZZEEJA4X29', 2, ' Network', ''),
(1033, 'MOC2132939', 'MOD65383726273746144', 'choose', 'MODK92J8ZZEEJA4X29', 3, 'Distributed', ''),
(1034, 'MOC2132939', 'MOD65383726273746144', 'choose', 'MODK92J8ZZEEJA4X29', 4, 'Decentralized', ''),
(1035, 'MOC2132939', 'MOD65383726273746144', 'choose', 'MOD4AEMJ9EKRIJ7U3X', 1, 'fact = fact + i', ''),
(1036, 'MOC2132939', 'MOD65383726273746144', 'choose', 'MOD4AEMJ9EKRIJ7U3X', 2, 'fact = fact * i', ''),
(1037, 'MOC2132939', 'MOD65383726273746144', 'choose', 'MOD4AEMJ9EKRIJ7U3X', 3, 'i = i * fact', ''),
(1038, 'MOC2132939', 'MOD65383726273746144', 'choose', 'MOD4AEMJ9EKRIJ7U3X', 4, ' i = i + fact', ''),
(1039, 'MOC2132939', 'MOD65383726273746144', 'choose', 'MODWI959M73OT3721O', 1, 'return 1', ''),
(1040, 'MOC2132939', 'MOD65383726273746144', 'choose', 'MODWI959M73OT3721O', 2, 'return n * fact(n-1)', ''),
(1041, 'MOC2132939', 'MOD65383726273746144', 'choose', 'MODWI959M73OT3721O', 3, 'if(n == 0)', ''),
(1042, 'MOC2132939', 'MOD65383726273746144', 'choose', 'MODWI959M73OT3721O', 4, 'if(n == 1)', ''),
(1043, 'MOC2132939', 'MOD65383726273746144', 'choose', 'MOD6CGOAHEWTJ13T9M', 1, ' system program that converts instructions to machine language', ''),
(1044, 'MOC2132939', 'MOD65383726273746144', 'choose', 'MOD6CGOAHEWTJ13T9M', 2, 'system program that converts machine language to high-level language', ''),
(1045, 'MOC2132939', 'MOD65383726273746144', 'choose', 'MOD6CGOAHEWTJ13T9M', 3, ' system program that writes instructions to perform', ''),
(1046, 'MOC2132939', 'MOD65383726273746144', 'choose', 'MOD6CGOAHEWTJ13T9M', 4, 'None of the mentioned', ''),
(1047, 'MOC2132939', 'MOD65383726273746144', 'choose', 'MODG379XG52UOEK2H3', 1, 'Semantic analysis', ''),
(1048, 'MOC2132939', 'MOD65383726273746144', 'choose', 'MODG379XG52UOEK2H3', 2, 'Intermediate code generator', ''),
(1049, 'MOC2132939', 'MOD65383726273746144', 'choose', 'MODG379XG52UOEK2H3', 3, 'Code generator', ''),
(1050, 'MOC2132939', 'MOD65383726273746144', 'choose', 'MODG379XG52UOEK2H3', 4, 'All of the mentioned', ''),
(1051, 'MOC2132939', 'MOD65383726273746144', 'choose', 'MOD97EXHE8T89BY992', 1, 'Finding nameâ€™s scope', ''),
(1052, 'MOC2132939', 'MOD65383726273746144', 'choose', 'MOD97EXHE8T89BY992', 2, 'Type checking', ''),
(1053, 'MOC2132939', 'MOD65383726273746144', 'choose', 'MOD97EXHE8T89BY992', 3, 'Keeping all of the names of all entities in one place', ''),
(1054, 'MOC2132939', 'MOD65383726273746144', 'choose', 'MOD97EXHE8T89BY992', 4, 'All of the mentioned', ''),
(1055, 'MOC2132939', 'MOD65383726273746144', 'choose', 'MODG38LBJGH27JEHUO', 1, 'Syntax Error', ''),
(1056, 'MOC2132939', 'MOD65383726273746144', 'choose', 'MODG38LBJGH27JEHUO', 2, 'Logical Error', ''),
(1057, 'MOC2132939', 'MOD65383726273746144', 'choose', 'MODG38LBJGH27JEHUO', 3, ' Both Logical and Syntax Error', ''),
(1058, 'MOC2132939', 'MOD65383726273746144', 'choose', 'MODG38LBJGH27JEHUO', 4, ' Compiler cannot check errors', ''),
(1059, 'MOC2132939', 'MOD65383726273746144', 'choose', 'MODNC5M9EE71J446YW', 1, 'A', ''),
(1060, 'MOC2132939', 'MOD65383726273746144', 'choose', 'MODNC5M9EE71J446YW', 2, 'C', ''),
(1061, 'MOC2132939', 'MOD65383726273746144', 'choose', 'MODNC5M9EE71J446YW', 3, 'G', ''),
(1062, 'MOC2132939', 'MOD65383726273746144', 'choose', 'MODNC5M9EE71J446YW', 4, 'H', ''),
(1063, 'MOC2132939', 'MOD65383726273746144', 'choose', 'MODE9L7U51GXCK8X2M', 1, 'Compiler or interpreter', ''),
(1064, 'MOC2132939', 'MOD65383726273746144', 'choose', 'MODE9L7U51GXCK8X2M', 2, 'Compiler only', ''),
(1065, 'MOC2132939', 'MOD65383726273746144', 'choose', 'MODE9L7U51GXCK8X2M', 3, 'Interpreter only', ''),
(1066, 'MOC2132939', 'MOD65383726273746144', 'choose', 'MODE9L7U51GXCK8X2M', 4, 'None of the mentioned', ''),
(1075, 'MOD2571656', 'MOD84981219413119185', 'choose', 'MODRCA16B2X2A5IH37', 1, 'sad sfa sfd', ''),
(1076, 'MOD2571656', 'MOD84981219413119185', 'choose', 'MODRCA16B2X2A5IH37', 2, 'fsdfdsvd', ''),
(1077, 'MOD2571656', 'MOD84981219413119185', 'choose', 'MODRCA16B2X2A5IH37', 3, 'sfdfgdfgd', ''),
(1078, 'MOD2571656', 'MOD84981219413119185', 'choose', 'MODRCA16B2X2A5IH37', 4, 'sfgdfgdfghfgh', ''),
(1079, 'MOD2571656', 'MOD84981219413119185', 'choose', 'MOD66KAEHR5E1L4L2I', 1, 'fdsfdsfd ', ''),
(1080, 'MOD2571656', 'MOD84981219413119185', 'choose', 'MOD66KAEHR5E1L4L2I', 2, 'sfdfgd fgd', ''),
(1081, 'MOD2571656', 'MOD84981219413119185', 'choose', 'MOD66KAEHR5E1L4L2I', 3, 'sfd fgd fgd', ''),
(1082, 'MOD2571656', 'MOD84981219413119185', 'choose', 'MOD66KAEHR5E1L4L2I', 4, 'fgd fgd fgd', ''),
(1083, 'MOD2571656', 'MOD84981219413119185', 'choose', 'MOD66KAEHR5E1L4L2I', 5, ' fgd fgd fghd', ''),
(1084, 'MOD2571656', 'MOD84981219413119185', 'choose', 'MOD66KAEHR5E1L4L2I', 6, 'fgdfgdfgd ', ''),
(1085, 'MOD2571656', 'MOD84981219413119185', 'choose', 'MOD1JZ3XH439K736IC', 1, '<p>bhbtyyyyyyyyyyyyyyyyyyyy</p>', ''),
(1086, 'MOD2571656', 'MOD84981219413119185', 'choose', 'MOD1JZ3XH439K736IC', 2, '<p>yyyyyyyyyyyyyyyyyyyyyyyyyyyyyyy</p>', ''),
(1087, 'MOD2571656', 'MOD84981219413119185', 'choose', 'MODCTHT3CO41XMJX9G', 1, '<p>bad</p>', ''),
(1088, 'MOD2571656', 'MOD84981219413119185', 'choose', 'MODCTHT3CO41XMJX9G', 2, '<p>verey foood</p>', ''),
(1089, 'MOD2571656', 'MOD84981219413119185', 'choose', 'MODCTHT3CO41XMJX9G', 3, '<p>all</p>', ''),
(1090, 'PLA6232654', 'PLA81832573287651994', 'choose', 'PLA4KL4W3412M41WIX', 1, 'Gametophytes are the dominant phase in this life cycle', ''),
(1091, 'PLA6232654', 'PLA81832573287651994', 'choose', 'PLA4KL4W3412M41WIX', 2, ' Sporophytes are free-living', ''),
(1092, 'PLA6232654', 'PLA81832573287651994', 'choose', 'PLA4KL4W3412M41WIX', 3, ' Spores are haploid in nature and form gametophyte by mitotic division', ''),
(1093, 'PLA6232654', 'PLA81832573287651994', 'choose', 'PLA4KL4W3412M41WIX', 4, 'Zygote acts as sporophyte', ''),
(1094, 'PLA6232654', 'PLA81832573287651994', 'choose', 'PLAUKIN29YR59HZ9IJ', 1, 'Sporophyte is the dominant phase', ''),
(1095, 'PLA6232654', 'PLA81832573287651994', 'choose', 'PLAUKIN29YR59HZ9IJ', 2, 'All spermatophytes exhibit diplontic life cycle', ''),
(1096, 'PLA6232654', 'PLA81832573287651994', 'choose', 'PLAUKIN29YR59HZ9IJ', 3, 'Gametophyte depends on the sporophyte', ''),
(1097, 'PLA6232654', 'PLA81832573287651994', 'choose', 'PLAUKIN29YR59HZ9IJ', 4, 'Sporophyte depends on Gametophyte for their food', ''),
(1098, 'PLA6232654', 'PLA81832573287651994', 'choose', 'PLA3Z3Z1Z4F7IEE88C', 1, 'Haplontic', ''),
(1099, 'PLA6232654', 'PLA81832573287651994', 'choose', 'PLA3Z3Z1Z4F7IEE88C', 2, 'Diplontic', ''),
(1100, 'PLA6232654', 'PLA81832573287651994', 'choose', 'PLA3Z3Z1Z4F7IEE88C', 3, 'Triplontic', ''),
(1101, 'PLA6232654', 'PLA81832573287651994', 'choose', 'PLA3Z3Z1Z4F7IEE88C', 4, 'Haplo-diplontic', ''),
(1106, 'PLA6232654', 'PLA81832573287651994', 'choose', 'PLA19HA59Z42T33IZY', 1, 'Cornea', ''),
(1107, 'PLA6232654', 'PLA81832573287651994', 'choose', 'PLA19HA59Z42T33IZY', 2, 'Optic nerve', ''),
(1108, 'PLA6232654', 'PLA81832573287651994', 'choose', 'PLA19HA59Z42T33IZY', 3, 'Blind spot', ''),
(1109, 'PLA6232654', 'PLA81832573287651994', 'choose', 'PLA19HA59Z42T33IZY', 4, 'Fovea', ''),
(1110, 'PLA6232654', 'PLA81832573287651994', 'choose', 'PLAZ21LLKUOIX7HX8C', 1, '<p>1 2 3</p>', ''),
(1111, 'PLA6232654', 'PLA81832573287651994', 'choose', 'PLAZ21LLKUOIX7HX8C', 2, '<p>error</p>', ''),
(1112, 'PLA6232654', 'PLA81832573287651994', 'choose', 'PLAZ21LLKUOIX7HX8C', 3, '<p>1 2</p>', ''),
(1113, 'PLA6232654', 'PLA81832573287651994', 'choose', 'PLAZ21LLKUOIX7HX8C', 4, '<p>&nbsp;none of the mentioned</p>', ''),
(1114, 'PLA6232654', 'PLA81832573287651994', 'choose', 'PLA33JF8JY8J9JNE4G', 1, 'Â Ciliary bodies', ''),
(1115, 'PLA6232654', 'PLA81832573287651994', 'choose', 'PLA33JF8JY8J9JNE4G', 2, 'Cornea', ''),
(1116, 'PLA6232654', 'PLA81832573287651994', 'choose', 'PLA33JF8JY8J9JNE4G', 3, 'Iris', ''),
(1117, 'PLA6232654', 'PLA81832573287651994', 'choose', 'PLA33JF8JY8J9JNE4G', 4, 'Lens', ''),
(1126, 'PLA6232654', 'PLA81832573287651994', 'choose', 'PLAX35NT1O88OR3MRB', 1, '<p>any number of</p>', ''),
(1127, 'PLA6232654', 'PLA81832573287651994', 'choose', 'PLAX35NT1O88OR3MRB', 2, '<p>0</p>', ''),
(1128, 'PLA6232654', 'PLA81832573287651994', 'choose', 'PLAX35NT1O88OR3MRB', 3, '<p>1</p>', ''),
(1129, 'PLA6232654', 'PLA81832573287651994', 'choose', 'PLAX35NT1O88OR3MRB', 4, '<p>2</p>', ''),
(1150, 'PLA6232654', 'PLA81832573287651994', 'choose', 'PLA42Z12EHAJ7C54NE', 1, '<p>2<sup>22222</sup></p>', NULL),
(1151, 'PLA6232654', 'PLA81832573287651994', 'choose', 'PLA42Z12EHAJ7C54NE', 2, '<p>wwefrgthyjgukhiljkl</p>', NULL),
(1152, 'PLA6232654', 'PLA81832573287651994', 'choose', 'PLA42Z12EHAJ7C54NE', 3, '<p style=\"margin-left:120px\">2<sub>22222222</sub></p>', NULL),
(1153, 'PLA6232654', 'PLA81832573287651994', 'choose', 'PLA42Z12EHAJ7C54NE', 4, '<p style=\"margin-left:40px\"><span style=\"color:#3498db\"><strong>2eeee2e2</strong></span></p>', NULL),
(1154, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODH5C28H2YFY3G4UX', 1, 'IP address	              ', NULL),
(1155, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODH5C28H2YFY3G4UX', 2, '        Device address		            ', NULL),
(1156, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODH5C28H2YFY3G4UX', 3, '       Port number             ', NULL),
(1157, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODH5C28H2YFY3G4UX', 4, ' MAC address  ', NULL),
(1158, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODL2JAXXF918KHZT3', 1, 'Switches ', NULL),
(1159, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODL2JAXXF918KHZT3', 2, 'Routers ', NULL),
(1160, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODL2JAXXF918KHZT3', 3, 'NIC ', NULL),
(1161, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODL2JAXXF918KHZT3', 4, 'Firewall ', NULL),
(1162, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODYZ1HK25O142H3C3', 1, 'Internet                               ', NULL),
(1163, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODYZ1HK25O142H3C3', 2, '  bandwidth', NULL),
(1164, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODYZ1HK25O142H3C3', 3, ' IP addressing                       ', NULL),
(1165, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODYZ1HK25O142H3C3', 4, 'Network    ', NULL),
(1166, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD824AJCMFEJAJ3A7', 1, 'Network address          ', NULL),
(1167, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD824AJCMFEJAJ3A7', 2, '     Host address  ', NULL),
(1168, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD824AJCMFEJAJ3A7', 3, 'Broadcast address          ', NULL),
(1169, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD824AJCMFEJAJ3A7', 4, 'MAC address', NULL),
(1170, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD597X5ZJ8X43GZLA', 1, '23              ', NULL),
(1171, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD597X5ZJ8X43GZLA', 2, ' 80     ', NULL),
(1172, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD597X5ZJ8X43GZLA', 3, '  53      ', NULL),
(1173, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD597X5ZJ8X43GZLA', 4, '           25', NULL),
(1174, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODEAJ31W8E347UCM2', 1, 'Addressing ', NULL),
(1175, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODEAJ31W8E347UCM2', 2, 'Routing 	', NULL),
(1176, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODEAJ31W8E347UCM2', 3, 'Path Selection ', NULL),
(1177, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODEAJ31W8E347UCM2', 4, 'Flow control  ', NULL),
(1178, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD742Y1NMU2N82OZ8', 1, '2           ', NULL),
(1179, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD742Y1NMU2N82OZ8', 2, '       16', NULL),
(1180, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD742Y1NMU2N82OZ8', 3, ' 4           ', NULL),
(1181, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD742Y1NMU2N82OZ8', 4, '        128', NULL),
(1182, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD89GY7G2H7G4BK12', 1, 'MAC address ', NULL),
(1183, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD89GY7G2H7G4BK12', 2, 'Device address ', NULL),
(1184, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD89GY7G2H7G4BK12', 3, 'IP address ', NULL),
(1185, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD89GY7G2H7G4BK12', 4, 'Network address', NULL),
(1186, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODIGR6UZUM562W1OH', 1, 'access token for authentication ', NULL),
(1187, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODIGR6UZUM562W1OH', 2, 'access to network resources ', NULL),
(1188, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODIGR6UZUM562W1OH', 3, 'created as a domain controller in active directory ', NULL),
(1189, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODIGR6UZUM562W1OH', 4, 'created in local security database', NULL),
(1190, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODT1417X4XM2HHG91', 1, 'backup operator ', NULL),
(1191, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODT1417X4XM2HHG91', 2, 'administrator ', NULL),
(1192, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODT1417X4XM2HHG91', 3, 'account operator ', NULL),
(1193, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODT1417X4XM2HHG91', 4, 'guest ', NULL),
(1194, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD4L243ET1J2FJE7F', 1, 'local user profile', NULL),
(1195, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD4L243ET1J2FJE7F', 2, ' roaming user profile ', NULL),
(1196, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD4L243ET1J2FJE7F', 3, 'mandatory user profile ', NULL),
(1197, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD4L243ET1J2FJE7F', 4, 'temporary user profile', NULL),
(1198, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODNFNH9OJLNEAE2J2', 1, 'forest     ', NULL),
(1199, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODNFNH9OJLNEAE2J2', 2, 'organization unit  ', NULL),
(1200, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODNFNH9OJLNEAE2J2', 3, 'computer ', NULL),
(1201, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODNFNH9OJLNEAE2J2', 4, 'printer', NULL),
(1202, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODA94NWEC7I27LMI5', 1, 'Any organization that operates in multiple location  ', NULL),
(1203, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODA94NWEC7I27LMI5', 2, 'Any organization where information is vital ', NULL),
(1204, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODA94NWEC7I27LMI5', 3, 'Any organization where the numbers of users and resource will keep changing ', NULL),
(1205, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODA94NWEC7I27LMI5', 4, 'All', NULL),
(1206, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODT82XE5H7W9UEYXJ', 1, 'User account managing  ', NULL),
(1207, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODT82XE5H7W9UEYXJ', 2, ' Secure the policy of the company ', NULL),
(1208, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODT82XE5H7W9UEYXJ', 3, ' Network design of the company  ', NULL),
(1209, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODT82XE5H7W9UEYXJ', 4, 'Scripting', NULL),
(1210, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD2MHK2NFK9N9HOR1', 1, 'Agentâ€™s behavior is described by the agent function ', NULL),
(1211, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD2MHK2NFK9N9HOR1', 2, 'Agent program can run on the physical architecture ', NULL),
(1212, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD2MHK2NFK9N9HOR1', 3, 'Agent is the combination of architecture and program ', NULL),
(1213, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD2MHK2NFK9N9HOR1', 4, 'Agent is anything that cannot be viewed as perceiving its environment', NULL),
(1214, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD7R25HG21OH2X4UG', 1, 'Stochastic environment               ', NULL),
(1215, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD7R25HG21OH2X4UG', 2, 'Sequential environment             ', NULL),
(1216, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD7R25HG21OH2X4UG', 3, '       Partial environment                     ', NULL),
(1217, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD7R25HG21OH2X4UG', 4, 'Dynamic environment     ', NULL),
(1218, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD7R25HG21OH2X4UG', 5, 'all ', NULL),
(1219, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD1XF94U37JW83T2L', 1, 'Reduces the time taken to solve the problem ', NULL),
(1220, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD1XF94U37JW83T2L', 2, 'Helps in providing security', NULL),
(1221, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD1XF94U37JW83T2L', 3, ' Have the ability to think hence makes the work easier ', NULL),
(1222, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD1XF94U37JW83T2L', 4, 'All of the above', NULL),
(1223, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD1MOE7XF3Y21TTTI', 1, 'hill climbing search ', NULL),
(1224, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD1MOE7XF3Y21TTTI', 2, 'heuristic search ', NULL),
(1225, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD1MOE7XF3Y21TTTI', 3, 'linear search', NULL),
(1226, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD1MOE7XF3Y21TTTI', 4, 'hidden Markov model ', NULL),
(1227, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODET3M39JHC3X77U9', 1, 'Utility  of maximization by firms in a perfect competitive market', NULL),
(1228, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODET3M39JHC3X77U9', 2, ' The choice of an optimal strategy in conflict situation  ', NULL),
(1229, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODET3M39JHC3X77U9', 3, 'Predict the results of best placed on the game  ', NULL),
(1230, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODET3M39JHC3X77U9', 4, 'The migration pattern away from the game during conflict', NULL),
(1231, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD5M8FN2T2THH3EL2', 1, 'Unsupervised learning', NULL),
(1232, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD5M8FN2T2THH3EL2', 2, ' supervised learning ', NULL),
(1233, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD5M8FN2T2THH3EL2', 3, ' Enforcement learning  ', NULL),
(1234, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD5M8FN2T2THH3EL2', 4, 'Neural network ', NULL),
(1235, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODE88OG1Y733UJ9G2', 1, 'Software control  ', NULL),
(1236, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODE88OG1Y733UJ9G2', 2, 'Hardware control  ', NULL),
(1237, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODE88OG1Y733UJ9G2', 3, 'Physical control ', NULL),
(1238, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODE88OG1Y733UJ9G2', 4, 'Policies and encryption ', NULL),
(1239, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD72N2FHGL7437X6M', 1, 'Interruption ', NULL),
(1240, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD72N2FHGL7437X6M', 2, 'Interception ', NULL),
(1241, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD72N2FHGL7437X6M', 3, 'Modification ', NULL),
(1242, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD72N2FHGL7437X6M', 4, 'Fabrication', NULL),
(1243, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODG444FFG4L2EI17Z', 1, 'Integrity is concerned with ensuring authorized  information share ', NULL),
(1244, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODG444FFG4L2EI17Z', 2, ' Confidentiality is concerned with  ensuring authorized  information access ', NULL),
(1245, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODG444FFG4L2EI17Z', 3, 'availability is concerned with ensuring authorized  information update', NULL),
(1246, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODG444FFG4L2EI17Z', 4, ' vulnerability is a strength of system against security threats', NULL),
(1247, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD4N4H27X28H7T95O', 1, 'public key ', NULL),
(1248, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD4N4H27X28H7T95O', 2, 'private key	', NULL),
(1249, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD4N4H27X28H7T95O', 3, 'password ', NULL),
(1250, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODUGI4LE2E14E2B8X', 1, ' MAC ', NULL),
(1251, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODUGI4LE2E14E2B8X', 2, 'KDC ', NULL),
(1252, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODUGI4LE2E14E2B8X', 3, 'Kerberos ', NULL),
(1253, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODUGI4LE2E14E2B8X', 4, 'IP address', NULL),
(1254, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODJXO593XAU792ZE3', 1, 'Fingerprint ', NULL),
(1255, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODJXO593XAU792ZE3', 2, 'Password', NULL),
(1256, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODJXO593XAU792ZE3', 3, 'Smart card ', NULL),
(1257, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODJXO593XAU792ZE3', 4, 'Facial scan', NULL),
(1258, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD4TEMG14IE9815J1', 1, 'Object Model ', NULL),
(1259, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD4TEMG14IE9815J1', 2, 'Context Model ', NULL),
(1260, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD4TEMG14IE9815J1', 3, 'Behavioral Model ', NULL),
(1261, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD4TEMG14IE9815J1', 4, 'Data Model', NULL),
(1262, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODJK7J312JIEL39ZR', 1, 'Designing a software ', NULL),
(1263, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODJK7J312JIEL39ZR', 2, 'Testing a software', NULL),
(1264, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODJK7J312JIEL39ZR', 3, ' Application of engineering principles to the design a software', NULL),
(1265, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODJK7J312JIEL39ZR', 4, ' None of the above', NULL),
(1266, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD8HF975Y2NA2ZZHG', 1, 'Validation ', NULL),
(1267, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD8HF975Y2NA2ZZHG', 2, 'Specification ', NULL),
(1268, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD8HF975Y2NA2ZZHG', 3, 'Development ', NULL),
(1269, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD8HF975Y2NA2ZZHG', 4, 'Dependence', NULL),
(1270, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD3XGJK4FRAGU745E', 1, ' Project scheduling ', NULL),
(1271, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD3XGJK4FRAGU745E', 2, 'Detailed schedule ', NULL),
(1272, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD3XGJK4FRAGU745E', 3, 'Macroscopic schedule ', NULL),
(1273, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD3XGJK4FRAGU745E', 4, 'None of the mentioned', NULL),
(1274, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD3LKXFH3NM3X1191', 1, 'Cost           ', NULL),
(1275, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD3LKXFH3NM3X1191', 2, ' Effort Applied         ', NULL),
(1276, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD3LKXFH3NM3X1191', 3, '  Efficiency              ', NULL),
(1277, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD3LKXFH3NM3X1191', 4, 'All ', NULL),
(1278, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODFTXUXUUYU2EO14I', 1, 'Accuracy ', NULL),
(1279, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODFTXUXUUYU2EO14I', 2, ' Complexity ', NULL),
(1280, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODFTXUXUUYU2EO14I', 3, 'Efficiency ', NULL),
(1281, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODFTXUXUUYU2EO14I', 4, 'Quality ', NULL),
(1282, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD8W9J82X32H242ZE', 1, 'A reasonable approach when requirements are well defined. ', NULL),
(1283, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD8W9J82X32H242ZE', 2, 'A good approach when a working core product is required quickly. ', NULL),
(1284, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD8W9J82X32H242ZE', 3, 'The best approach to use for projects with large development teams', NULL),
(1285, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD8W9J82X32H242ZE', 4, '.A revolutionary model that is not used for commercial product', NULL),
(1286, 'PLA6232654', 'PLA81832573287651994', 'choose', 'PLAR3I62M21HF479HN', 1, '<p>qwergtfyugihjohgvbfxzs\\asdzfgchvjbknhbgbcv</p>', NULL),
(1287, 'PLA6232654', 'PLA81832573287651994', 'choose', 'PLAR3I62M21HF479HN', 2, '<p>sadwefrdfygjuhjikdfxgchvjbmnbgvxszgcfhvjb</p>', NULL),
(1288, 'PLA6232654', 'PLA81832573287651994', 'choose', 'PLAR3I62M21HF479HN', 3, '<p>kjjhjugvfcdsasdzfxgchjbknlhgfdsxgchvjbkbhvgcfd</p>', NULL),
(1289, 'PLA6232654', 'PLA81832573287651994', 'choose', 'PLAR3I62M21HF479HN', 4, '<p>swearsdtfjuhkiuhygtfrdszzfrxgth</p>', NULL),
(1290, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD4H5K42ZU2OYIF1F', 1, 'Insertion sort ', NULL),
(1291, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD4H5K42ZU2OYIF1F', 2, ' Bubble sort ', NULL),
(1292, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD4H5K42ZU2OYIF1F', 3, 'Merge sort', NULL),
(1293, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD4H5K42ZU2OYIF1F', 4, 'Quick sort', NULL),
(1294, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODT2OXR23912E38UG', 1, 'To provide a general method for analyzing the running time of greedy algorithms', NULL),
(1295, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODT2OXR23912E38UG', 2, 'To provide a general method for analyzing the running time of dynamic programming algorithms ', NULL),
(1296, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODT2OXR23912E38UG', 3, 'To provide a general method for analyzing the running time of randomized algorithms', NULL),
(1297, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODT2OXR23912E38UG', 4, 'To provide a general method for analyzing the running time of divide-and-conquer', NULL),
(1298, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODNBJLG787BE7U12R', 1, ' Hash tables have a high worst-case time complexity for certain operations ', NULL),
(1299, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODNBJLG787BE7U12R', 2, 'Hash tables require a lot of memory ', NULL),
(1300, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODNBJLG787BE7U12R', 3, ' Hash tables do not support ordered iteration over the data ', NULL),
(1301, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODNBJLG787BE7U12R', 4, 'Hash tables cannot handle collisions', NULL),
(1302, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODH13J2352N74N82I', 1, 'Time complexity ', NULL),
(1303, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODH13J2352N74N82I', 2, 'Space complexity ', NULL),
(1304, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODH13J2352N74N82I', 3, ' Input complexity ', NULL),
(1305, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODH13J2352N74N82I', 4, 'Output complexity', NULL),
(1306, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODIEK43M84UU74A3W', 1, 'The amount of memory used by the algorithm', NULL),
(1307, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODIEK43M84UU74A3W', 2, 'The amount of time it takes for the algorithm to execute ', NULL),
(1308, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODIEK43M84UU74A3W', 3, 'The size of the input data that the algorithm can handle ', NULL),
(1309, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODIEK43M84UU74A3W', 4, 'The number of operations performed by the algorithm', NULL),
(1310, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODN1G8X6M3YH34J51', 1, 'Computing the factorial of a number', NULL),
(1311, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODN1G8X6M3YH34J51', 2, 'Finding the maximum value in an array ', NULL),
(1312, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODN1G8X6M3YH34J51', 3, 'Sorting an array using bubble sort ', NULL),
(1313, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODN1G8X6M3YH34J51', 4, 'Calculating the Fibonacci sequence', NULL),
(1314, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODEHY62YXUG5Y3E17', 1, 'Linear search', NULL),
(1315, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODEHY62YXUG5Y3E17', 2, ' Binary search ', NULL),
(1316, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODEHY62YXUG5Y3E17', 3, 'Insertion sort ', NULL),
(1317, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODEHY62YXUG5Y3E17', 4, 'Selection sort', NULL),
(1318, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODJ1I9ZNMXEECE9L3', 1, 'private ', NULL),
(1319, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODJ1I9ZNMXEECE9L3', 2, 'protected ', NULL),
(1320, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODJ1I9ZNMXEECE9L3', 3, 'public ', NULL),
(1321, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODJ1I9ZNMXEECE9L3', 4, 'static', NULL),
(1322, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD34O8ZGX24F29257', 1, 'It refers to the current instance of the class. ', NULL),
(1323, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD34O8ZGX24F29257', 2, 'It creates a new instance of the class. ', NULL),
(1324, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD34O8ZGX24F29257', 3, 'It allows access to private class members. ', NULL),
(1325, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD34O8ZGX24F29257', 4, 'It specifies the return type of a method', NULL),
(1326, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODN9Z6OK32O3HUM38', 1, 'A method that is declared with the \"static\" keyword and can be called without creating an instance of the class. ', NULL),
(1327, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODN9Z6OK32O3HUM38', 2, 'A method that is declared with the \"final\" keyword and cannot be overridden. ', NULL),
(1328, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODN9Z6OK32O3HUM38', 3, 'A method that is declared with the \"abstract\" keyword and does not have an implementation. ', NULL),
(1329, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODN9Z6OK32O3HUM38', 4, 'A method that is declared with the \"private\" keyword and can only be accessed within the class', NULL),
(1330, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODEJY9C9BX5LH344W', 1, 'A class that cannot be inherited. ', NULL),
(1331, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODEJY9C9BX5LH344W', 2, ' A class that cannot be instantiated. ', NULL),
(1332, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODEJY9C9BX5LH344W', 3, 'A class that can only have one instance.', NULL),
(1333, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODEJY9C9BX5LH344W', 4, 'A class that is declared with the \"final\" keyword.', NULL),
(1334, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODNKAGGTJT1J32G78', 1, 'RuntimeException ', NULL),
(1335, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODNKAGGTJT1J32G78', 2, 'Exception', NULL),
(1336, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODNKAGGTJT1J32G78', 3, ' Error ', NULL),
(1337, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODNKAGGTJT1J32G78', 4, 'Throwable', NULL),
(1338, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODEXZJXJ353TCC7GF', 1, 'set ', NULL),
(1339, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODEXZJXJ353TCC7GF', 2, 'list ', NULL),
(1340, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODEXZJXJ353TCC7GF', 3, 'queue ', NULL),
(1341, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODEXZJXJ353TCC7GF', 4, 'all', NULL),
(1342, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODFK3X6R2NI8H7N14', 1, 'While loop ', NULL),
(1343, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODFK3X6R2NI8H7N14', 2, ' doâ€¦while loop', NULL),
(1344, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODFK3X6R2NI8H7N14', 3, ' for loop ', NULL),
(1345, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD31X3KJ1E7REYX8A', 1, 'int x; char *c_pointer; c_pointer = &x; ', NULL),
(1346, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD31X3KJ1E7REYX8A', 2, 'float y; float *y_pointer; y_pointer=&y; ', NULL),
(1347, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD31X3KJ1E7REYX8A', 3, 'int x; int x_pointer; x_pointer=&x; ', NULL),
(1348, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD31X3KJ1E7REYX8A', 4, 'int x; int *x_pointer; x_pointer=x;', NULL),
(1349, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODZE2ACW11LA9G6L3', 1, 'ios::in ', NULL),
(1350, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODZE2ACW11LA9G6L3', 2, 'ios::out ', NULL),
(1351, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODZE2ACW11LA9G6L3', 3, 'ios::app ', NULL),
(1352, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODZE2ACW11LA9G6L3', 4, 'ios::binary', NULL),
(1353, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD7YYO4314YCXT2L3', 1, 'fopen() ', NULL),
(1354, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD7YYO4314YCXT2L3', 2, 'open()', NULL),
(1355, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD7YYO4314YCXT2L3', 3, 'ifstream() ', NULL),
(1356, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD7YYO4314YCXT2L3', 4, 'ofstream()', NULL),
(1357, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD79E9MMA698XFXW8', 1, 'fopen()', NULL),
(1358, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD79E9MMA698XFXW8', 2, 'open()', NULL),
(1359, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD79E9MMA698XFXW8', 3, 'ifstream() ', NULL),
(1360, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD79E9MMA698XFXW8', 4, 'ofstream()', NULL),
(1361, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD4G8OBELHH4U5218', 1, 'it is always passed by value ', NULL),
(1362, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD4G8OBELHH4U5218', 2, 'it is always passed by reference ', NULL),
(1363, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD4G8OBELHH4U5218', 3, 'it can be passed by value or by reference ', NULL),
(1364, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD4G8OBELHH4U5218', 4, 'it can be passed by pointer', NULL),
(1365, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD34RL21RC217H28Y', 1, 'by using comparison operators ', NULL),
(1366, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD34RL21RC217H28Y', 2, 'by grater than and Less than key word', NULL),
(1367, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD34RL21RC217H28Y', 3, 'by strcat() functions ', NULL),
(1368, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD34RL21RC217H28Y', 4, 'by strcmp() functions', NULL),
(1369, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODHWFE9J3Y1KF74L3', 1, 'By using the \"call\" keyword followed by the function name', NULL),
(1370, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODHWFE9J3Y1KF74L3', 2, ' By assigning its return value to a variable ', NULL),
(1371, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODHWFE9J3Y1KF74L3', 3, 'By using the function name followed by parentheses and arguments (if any) ', NULL),
(1372, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODHWFE9J3Y1KF74L3', 4, 'By declaring it as a member of a class', NULL),
(1373, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD9YCH8R2ZLX79HT4', 1, 'Data modeling', NULL),
(1374, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD9YCH8R2ZLX79HT4', 2, ' Indexing ', NULL),
(1375, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD9YCH8R2ZLX79HT4', 3, 'Data encryption ', NULL),
(1376, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD9YCH8R2ZLX79HT4', 4, 'Query optimization', NULL),
(1377, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODI9347ZK1OKCG31O', 1, 'First normal form (1NF) ', NULL),
(1378, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODI9347ZK1OKCG31O', 2, 'Second normal form (2NF) ', NULL),
(1379, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODI9347ZK1OKCG31O', 3, 'Third normal form (3NF)', NULL),
(1380, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODI9347ZK1OKCG31O', 4, 'Boyce-Codd normal form (BCNF)', NULL),
(1381, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODRT95ILEN84O49GG', 1, 'Entity-Relationship (ER) diagram ', NULL),
(1382, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODRT95ILEN84O49GG', 2, 'Data flow diagram (DFD) ', NULL),
(1383, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODRT95ILEN84O49GG', 3, 'Class diagram ', NULL),
(1384, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODRT95ILEN84O49GG', 4, 'Structure chart', NULL),
(1385, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODT87O8W7HOHG3G3E', 1, 'Entity-Relationship (ER) diagram ', NULL),
(1386, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODT87O8W7HOHG3G3E', 2, 'Data flow diagram (DFD) ', NULL),
(1387, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODT87O8W7HOHG3G3E', 3, 'Class diagram ', NULL),
(1388, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODT87O8W7HOHG3G3E', 4, 'Structure chart', NULL),
(1389, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD3ZMIXW9U4I2BH3H', 1, 'To improve the efficiency and performance of the query ', NULL),
(1390, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD3ZMIXW9U4I2BH3H', 2, 'To ensure data consistency during query execution', NULL),
(1391, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD3ZMIXW9U4I2BH3H', 3, ' To enforce referential integrity in the query results ', NULL),
(1392, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD3ZMIXW9U4I2BH3H', 4, 'To encrypt the query to protect it from unauthorized access', NULL),
(1393, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD7ZBH9JF896781EG', 1, 'To improve the efficiency and performance of the query ', NULL),
(1394, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD7ZBH9JF896781EG', 2, 'To ensure data consistency during query execution', NULL),
(1395, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD7ZBH9JF896781EG', 3, ' To enforce referential integrity in the query results ', NULL),
(1396, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD7ZBH9JF896781EG', 4, 'To encrypt the query to protect it from unauthorized access', NULL),
(1397, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODYI13MY3EUZ6N55N', 1, 'To improve the efficiency and performance of the query ', NULL),
(1398, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODYI13MY3EUZ6N55N', 2, 'To ensure data consistency during query execution', NULL),
(1399, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODYI13MY3EUZ6N55N', 3, ' To enforce referential integrity in the query results ', NULL),
(1400, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODYI13MY3EUZ6N55N', 4, 'To encrypt the query to protect it from unauthorized access', NULL),
(1401, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODF9H9UFG9IY2JHFG', 1, 'Product name ', NULL),
(1402, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODF9H9UFG9IY2JHFG', 2, 'Product price ', NULL),
(1403, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODF9H9UFG9IY2JHFG', 3, 'Product description ', NULL),
(1404, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODF9H9UFG9IY2JHFG', 4, 'Product reviews', NULL),
(1405, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODE3G218ZWE51CK7T', 1, 'A unique identifier assigned to each object in the database.', NULL),
(1406, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODE3G218ZWE51CK7T', 2, ' A method that defines the behavior of an object. ', NULL),
(1407, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODE3G218ZWE51CK7T', 3, 'A special type of attribute that holds the current state of an object. ', NULL);
INSERT INTO `option_list` (`id`, `cat_id`, `exam_id`, `quest_type`, `quest_id`, `opt_no`, `ot`, `option_image`) VALUES
(1408, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODE3G218ZWE51CK7T', 4, 'A mechanism for combining multiple objects into a single object.', NULL),
(1409, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD9R23I9Y248W7ZJH', 1, 'The process of converting objects into classes.', NULL),
(1410, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD9R23I9Y248W7ZJH', 2, 'The process of storing objects in a database to maintain their state beyond program execution.', NULL),
(1411, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD9R23I9Y248W7ZJH', 3, ' The process of combining multiple objects into a single object.', NULL),
(1412, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD9R23I9Y248W7ZJH', 4, 'The process of defining the behavior of an object.', NULL),
(1413, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODZ3H2A4EXGC847EG', 1, 'The process of converting objects into classes.', NULL),
(1414, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODZ3H2A4EXGC847EG', 2, 'The process of storing objects in a database to maintain their state beyond program execution.', NULL),
(1415, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODZ3H2A4EXGC847EG', 3, ' The process of combining multiple objects into a single object.', NULL),
(1416, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODZ3H2A4EXGC847EG', 4, 'The process of defining the behavior of an object.', NULL),
(1417, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODH195HO2HR336NHG', 1, 'A record of all transactions performed on the database, used for auditing purposes. ', NULL),
(1418, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODH195HO2HR336NHG', 2, 'A mechanism to synchronize concurrent access to the database. ', NULL),
(1419, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODH195HO2HR336NHG', 3, 'A data structure that stores information about database changes to facilitate recovery. ', NULL),
(1420, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODH195HO2HR336NHG', 4, 'A backup copy of the database stored separately for disaster recovery', NULL),
(1421, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODA8EE2Z2OHT23HRA', 1, 'Crash recovery ', NULL),
(1422, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODA8EE2Z2OHT23HRA', 2, 'Media recovery ', NULL),
(1423, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODA8EE2Z2OHT23HRA', 3, 'Point-in-time recovery ', NULL),
(1424, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODA8EE2Z2OHT23HRA', 4, 'Rollback recovery', NULL),
(1425, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODM1724I53CBFJ492', 1, 'A copy of the entire database stored separately for disaster recovery purposes. ', NULL),
(1426, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODM1724I53CBFJ492', 2, 'A snapshot of the database taken at a specific point in time. ', NULL),
(1427, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODM1724I53CBFJ492', 3, 'A mechanism to synchronize concurrent access to the database. ', NULL),
(1428, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODM1724I53CBFJ492', 4, 'A log file that records all changes made to the database.', NULL),
(1429, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD4TALCH7823J4W27', 1, 'In a homogeneous environment, all nodes have the same hardware and software, while in a heterogeneous environment, nodes have different hardware and software. ', NULL),
(1430, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD4TALCH7823J4W27', 2, 'In a homogeneous environment, all nodes are geographically close to each other, while in a heterogeneous environment, nodes are located in different geographical regions.', NULL),
(1431, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD4TALCH7823J4W27', 3, ' In a homogeneous environment, data is partitioned across nodes, while in a heterogeneous environment, data is replicated across nodes.', NULL),
(1432, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD4TALCH7823J4W27', 4, ' In a homogeneous environment, nodes communicate using a standardized protocol, while in a heterogeneous environment, nodes use different communication protocols.', NULL),
(1433, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODRT8KBZWM7W8WEKG', 1, 'The process of ensuring that data is accurately and uniformly replicated across all nodes. ', NULL),
(1434, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODRT8KBZWM7W8WEKG', 2, 'The process of encrypting data for secure transmission across a distributed network. ', NULL),
(1435, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODRT8KBZWM7W8WEKG', 3, 'The process of compressing data to reduce storage requirements in a distributed environment. ', NULL),
(1436, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODRT8KBZWM7W8WEKG', 4, 'The process of maintaining the correctness and integrity of data across multiple nodes.', NULL),
(1437, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD2XZN5W2BAH1677L', 1, 'The process of ensuring that data is accurately and uniformly replicated across all nodes. ', NULL),
(1438, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD2XZN5W2BAH1677L', 2, 'The process of encrypting data for secure transmission across a distributed network. ', NULL),
(1439, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD2XZN5W2BAH1677L', 3, 'The process of compressing data to reduce storage requirements in a distributed environment. ', NULL),
(1440, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD2XZN5W2BAH1677L', 4, 'The process of maintaining the correctness and integrity of data across multiple nodes.', NULL),
(1441, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODF83OCW4XG2YOCUG', 1, 'The process of designing the database schema. ', NULL),
(1442, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODF83OCW4XG2YOCUG', 2, 'The process of translating SQL queries into executable query plans. ', NULL),
(1443, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODF83OCW4XG2YOCUG', 3, 'The process of creating indexes on database tables. ', NULL),
(1444, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODF83OCW4XG2YOCUG', 4, 'The process of inserting data into the database.', NULL),
(1445, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODR93654MKKAG9REX', 1, 'The process of compressing query results to reduce storage requirements. ', NULL),
(1446, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODR93654MKKAG9REX', 2, 'The process of encrypting query results for secure transmission. ', NULL),
(1447, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODR93654MKKAG9REX', 3, 'The process of selecting the most suitable query processing strategy based on cost estimation. ', NULL),
(1448, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODR93654MKKAG9REX', 4, 'The process of parallelizing query execution across multiple processors.', NULL),
(1449, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODUO5I24775G33HT9', 1, 'To add interactivity and dynamic behavior to web pages', NULL),
(1450, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODUO5I24775G33HT9', 2, 'To structure and present the visual layout of a web page', NULL),
(1451, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODUO5I24775G33HT9', 3, ' To handle server-side logic and data processing ', NULL),
(1452, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODUO5I24775G33HT9', 4, 'To create and manipulate databases for web applications', NULL),
(1453, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD9842L9JX42448WA', 1, '200 OK ', NULL),
(1454, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD9842L9JX42448WA', 2, '404 Not Found ', NULL),
(1455, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD9842L9JX42448WA', 3, '503 Service Unavailable ', NULL),
(1456, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD9842L9JX42448WA', 4, '300 Redirect', NULL),
(1457, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD3YJUMI4U29GT8J8', 1, 'HTML ', NULL),
(1458, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD3YJUMI4U29GT8J8', 2, 'CSS ', NULL),
(1459, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD3YJUMI4U29GT8J8', 3, 'JavaScript ', NULL),
(1460, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD3YJUMI4U29GT8J8', 4, 'PHP', NULL),
(1461, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD31HIUR7XA8JZA8I', 1, 'To enable server-side scripting', NULL),
(1462, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD31HIUR7XA8JZA8I', 2, 'To handle server-side logic and data processing', NULL),
(1463, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD31HIUR7XA8JZA8I', 3, 'To send and receive data from the server asynchronously without refreshing the entire web page ', NULL),
(1464, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD31HIUR7XA8JZA8I', 4, 'To create visually appealing web designs', NULL),
(1465, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODLN1CR8WJXJ4XHW1', 1, 'It executes code on the server before sending it to the client\'s browser. ', NULL),
(1466, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODLN1CR8WJXJ4XHW1', 2, 'It runs code directly in the client\'s browser. ', NULL),
(1467, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODLN1CR8WJXJ4XHW1', 3, 'It processes and handles data on the server-side. ', NULL),
(1468, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODLN1CR8WJXJ4XHW1', 4, 'It is primarily used for server administration tasks.', NULL),
(1469, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD2B4257O8NJYMBL2', 1, 'To define the visual style and layout of a web page ', NULL),
(1470, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD2B4257O8NJYMBL2', 2, 'To add interactivity and dynamic behavior to web pages ', NULL),
(1471, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD2B4257O8NJYMBL2', 3, 'To provide a way for users to input and submit data to the server ', NULL),
(1472, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD2B4257O8NJYMBL2', 4, 'To manage server-side logic and data processing', NULL),
(1473, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD8EMX21U9FX48WXJ', 1, 'By using HTML tags', NULL),
(1474, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD8EMX21U9FX48WXJ', 2, 'By setting properties like width, height, and positioning ', NULL),
(1475, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD8EMX21U9FX48WXJ', 3, 'By defining JavaScript functions ', NULL),
(1476, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD8EMX21U9FX48WXJ', 4, 'By embedding images and videos', NULL),
(1477, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD8BRGW8LIMOT39HH', 1, 'By using secure network protocols ', NULL),
(1478, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD8BRGW8LIMOT39HH', 2, 'By implementing efficient data compression techniques ', NULL),
(1479, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD8BRGW8LIMOT39HH', 3, 'By employing load balancing and synchronization mechanisms ', NULL),
(1480, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD8BRGW8LIMOT39HH', 4, 'By optimizing client-side scripting for better performance', NULL),
(1481, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD8XM41G22BEWC3RO', 1, 'HTTP', NULL),
(1482, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD8XM41G22BEWC3RO', 2, ' FTP ', NULL),
(1483, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD8XM41G22BEWC3RO', 3, 'SMTP ', NULL),
(1484, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD8XM41G22BEWC3RO', 4, 'HTML', NULL),
(1485, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD5N283JE46BXG4HF', 1, 'Lexical analyzer generates an exception ', NULL),
(1486, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD5N283JE46BXG4HF', 2, 'Lexical analyzer generates an error ', NULL),
(1487, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD5N283JE46BXG4HF', 3, 'Lexical analyzer reads the whole program ', NULL),
(1488, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD5N283JE46BXG4HF', 4, 'Lexical analyzer generates an warning', NULL),
(1489, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD3JBC22WHJA7W9ZF', 1, 'One set one instruction at a time (Line by Line) ', NULL),
(1490, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD3JBC22WHJA7W9ZF', 2, 'One word at a time (Word by Word)', NULL),
(1491, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD3JBC22WHJA7W9ZF', 3, 'Single character at  a time (Letter by Letter) ', NULL),
(1492, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD3JBC22WHJA7W9ZF', 4, 'Reads the whole program once', NULL),
(1493, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODG713R376E4J513J', 1, 'Appears to execute a source program as if it were machine language ', NULL),
(1494, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODG713R376E4J513J', 2, 'Accepts a program written in a high level language and produces an object program ', NULL),
(1495, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODG713R376E4J513J', 3, 'Places programs into memory and prepares them for execution ', NULL),
(1496, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODG713R376E4J513J', 4, 'Automates the translation of assembly language into machine language', NULL),
(1497, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODUE9T3GC84E38RON', 1, 'Correctness', NULL),
(1498, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODUE9T3GC84E38RON', 2, 'Efficiency ', NULL),
(1499, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODUE9T3GC84E38RON', 3, 'Interactivity ', NULL),
(1500, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODUE9T3GC84E38RON', 4, 'Portability', NULL),
(1501, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD1H9G12194CH7ENJ', 1, 'Constant propagation ', NULL),
(1502, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD1H9G12194CH7ENJ', 2, 'Live variable analysis s ', NULL),
(1503, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD1H9G12194CH7ENJ', 3, 'Type checking ', NULL),
(1504, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD1H9G12194CH7ENJ', 4, 'Available expressions analysis', NULL),
(1505, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODERZEJF86TX98WRG', 1, 'Scanner ', NULL),
(1506, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODERZEJF86TX98WRG', 2, 'Code optimizer', NULL),
(1507, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODERZEJF86TX98WRG', 3, 'Code generator ', NULL),
(1508, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODERZEJF86TX98WRG', 4, 'Parser', NULL),
(1509, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD392JY6WXK1ZU4ZZ', 1, 'It is much helpful in the initial stages of program development   ', NULL),
(1510, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD392JY6WXK1ZU4ZZ', 2, 'Debugging can be faster and easier ', NULL),
(1511, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD392JY6WXK1ZU4ZZ', 3, 'It can generate stand-alone programs that often take less time for execution ', NULL),
(1512, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD392JY6WXK1ZU4ZZ', 4, 'If one changes a statement, only that statement needs re-compilation', NULL),
(1513, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD71HHX1UI8L2FL84', 1, '  Performance monitor ', NULL),
(1514, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD71HHX1UI8L2FL84', 2, 'Input/output control program ', NULL),
(1515, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD71HHX1UI8L2FL84', 3, 'Supervisor ', NULL),
(1516, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD71HHX1UI8L2FL84', 4, 'Job control program', NULL),
(1517, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODEO1BKX31IFHBTXR', 1, 'Operating system.  ', NULL),
(1518, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODEO1BKX31IFHBTXR', 2, 'Swapping', NULL),
(1519, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODEO1BKX31IFHBTXR', 3, 'CPU scheduler ', NULL),
(1520, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODEO1BKX31IFHBTXR', 4, 'dispatcher', NULL),
(1521, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODBF7T23679434C76', 1, 'Only (iii)', NULL),
(1522, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODBF7T23679434C76', 2, ' Only (i)', NULL),
(1523, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODBF7T23679434C76', 3, ' Both (i) and (iii) ', NULL),
(1524, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODBF7T23679434C76', 4, 'Both (ii) and (iv)', NULL),
(1525, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODH2LMWK1N3327R51', 1, 'Process scheduling', NULL),
(1526, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODH2LMWK1N3327R51', 2, ' Process rescheduling ', NULL),
(1527, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODH2LMWK1N3327R51', 3, 'Memory management ', NULL),
(1528, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODH2LMWK1N3327R51', 4, 'Processor Management', NULL),
(1529, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD34K2R139X593ETM', 1, 'They have a protection algorithm ', NULL),
(1530, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD34K2R139X593ETM', 2, 'They are in different logical addresses ', NULL),
(1531, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD34K2R139X593ETM', 3, 'Every address generated by the CPU is being checked against the relocation and limit registers ', NULL),
(1532, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD34K2R139X593ETM', 4, 'They are in different memory spaces', NULL),
(1533, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODRGRKE22I2O9BJ33', 1, ' Preemptive scheduling ', NULL),
(1534, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODRGRKE22I2O9BJ33', 2, 'Non-preemptive scheduling ', NULL),
(1535, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODRGRKE22I2O9BJ33', 3, 'FIFO', NULL),
(1536, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODRGRKE22I2O9BJ33', 4, ' FCFS', NULL),
(1537, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD2E6I3G7491EZFM2', 1, 'List ', NULL),
(1538, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD2E6I3G7491EZFM2', 2, 'Linked list ', NULL),
(1539, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD2E6I3G7491EZFM2', 3, 'Stack ', NULL),
(1540, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD2E6I3G7491EZFM2', 4, 'Queue ', NULL),
(1541, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODA5YT1HB8JZ2X2XX', 1, ' Effectiveness  ', NULL),
(1542, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODA5YT1HB8JZ2X2XX', 2, 'Generality  ', NULL),
(1543, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODA5YT1HB8JZ2X2XX', 3, 'Definiteness ', NULL),
(1544, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODA5YT1HB8JZ2X2XX', 4, 'Completeness', NULL),
(1545, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD48XHGW1ATJ4U838', 1, ' Pop()', NULL),
(1546, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD48XHGW1ATJ4U838', 2, ' peek ()  ', NULL),
(1547, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD48XHGW1ATJ4U838', 3, 'isFull ()', NULL),
(1548, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD48XHGW1ATJ4U838', 4, 'isEmpty() ', NULL),
(1549, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD4W3Z8BZ71XE9399', 1, 'There is no beginning and no end. ', NULL),
(1550, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD4W3Z8BZ71XE9399', 2, 'Components are all linked together in some sequential manner. ', NULL),
(1551, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD4W3Z8BZ71XE9399', 3, 'Forward and backward traversal within the list is impossible. ', NULL),
(1552, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD4W3Z8BZ71XE9399', 4, 'Components are arranged hierarchically.', NULL),
(1553, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODXIHTK8L715H33C4', 1, 'DCBA ', NULL),
(1554, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODXIHTK8L715H33C4', 2, 'DCAB ', NULL),
(1555, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODXIHTK8L715H33C4', 3, 'ABCD ', NULL),
(1556, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODXIHTK8L715H33C4', 4, 'ABCD', NULL),
(1557, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODRG185YKO76X5897', 1, 'Main address register ', NULL),
(1558, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODRG185YKO76X5897', 2, 'Memory address register ', NULL),
(1559, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODRG185YKO76X5897', 3, 'Memory data register', NULL),
(1560, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODRG185YKO76X5897', 4, 'Primary data register', NULL),
(1561, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODGZ9ZMEX2XEXXL95', 1, 'Programmed I/O modes of data transfer ', NULL),
(1562, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODGZ9ZMEX2XEXXL95', 2, 'Interrupted Initiated I/O modes of data transfer ', NULL),
(1563, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODGZ9ZMEX2XEXXL95', 3, 'Direct Memory Access(DMA) modes of data transfer', NULL),
(1564, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD92TI92M6X3I83A3', 1, 'To decode program instruction', NULL),
(1565, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD92TI92M6X3I83A3', 2, 'To perform logic operations ', NULL),
(1566, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD92TI92M6X3I83A3', 3, 'To store program instruction ', NULL),
(1567, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD92TI92M6X3I83A3', 4, 'To transfer data to primary storage', NULL),
(1568, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODR7JA1LJ4C2MKFXB', 1, '  CPU ', NULL),
(1569, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODR7JA1LJ4C2MKFXB', 2, 'Registers ', NULL),
(1570, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODR7JA1LJ4C2MKFXB', 3, 'BIOS ', NULL),
(1571, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODR7JA1LJ4C2MKFXB', 4, 'RAM', NULL),
(1572, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD42BJ7M1B4U3H5HL', 1, 'Ensure fast booting ', NULL),
(1573, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD42BJ7M1B4U3H5HL', 2, 'Speed up memory access', NULL),
(1574, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD42BJ7M1B4U3H5HL', 3, 'Reduced load on CPU registers ', NULL),
(1575, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD42BJ7M1B4U3H5HL', 4, 'Replace static memory', NULL),
(1576, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODE44H2ZZOFH8WEMN', 1, 'L1 L2  ', NULL),
(1577, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODE44H2ZZOFH8WEMN', 2, 'L1  âˆ© L2 ', NULL),
(1578, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODE44H2ZZOFH8WEMN', 3, 'L1 âˆ© R  ', NULL),
(1579, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODE44H2ZZOFH8WEMN', 4, 'L1 âˆª L2', NULL),
(1580, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODOL34E64I24UH41W', 1, 'Chomsky type 3  ', NULL),
(1581, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODOL34E64I24UH41W', 2, 'Chomsky type 1', NULL),
(1582, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODOL34E64I24UH41W', 3, '  Chomsky type 0 ', NULL),
(1583, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODOL34E64I24UH41W', 4, 'Chomsky type 2', NULL),
(1584, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODLIJE2E9273J8822', 1, 'Type 2', NULL),
(1585, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODLIJE2E9273J8822', 2, 'Type 1  ', NULL),
(1586, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODLIJE2E9273J8822', 3, 'Type 3  ', NULL),
(1587, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MODLIJE2E9273J8822', 4, 'Type 0 ', NULL),
(1588, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD4FAZYKBL8MB3J5J', 1, ' a.	Hard ', NULL),
(1589, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD4FAZYKBL8MB3J5J', 2, 'Complete ', NULL),
(1590, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD4FAZYKBL8MB3J5J', 3, 'NP ', NULL),
(1591, 'MOD2571656', 'MOD26924555698929252', 'choose', 'MOD4FAZYKBL8MB3J5J', 4, 'P', NULL),
(1592, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES7MG1XZF9ZO3Z3Z3', 1, 'Queue', NULL),
(1593, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES7MG1XZF9ZO3Z3Z3', 2, 'Stack', NULL),
(1594, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES7MG1XZF9ZO3Z3Z3', 3, 'Tree', NULL),
(1595, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES7MG1XZF9ZO3Z3Z3', 4, ' Linked list', NULL),
(1596, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESHWX2KO8O6GME764', 1, 'ABCD', NULL),
(1597, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESHWX2KO8O6GME764', 2, 'DCBA', NULL),
(1598, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESHWX2KO8O6GME764', 3, 'DCAB', NULL),
(1599, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESHWX2KO8O6GME764', 4, 'ABDC', NULL),
(1600, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES27TGIWXZ2MXC7T7', 1, 'O(1)', NULL),
(1601, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES27TGIWXZ2MXC7T7', 2, 'O(n)', NULL),
(1602, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES27TGIWXZ2MXC7T7', 3, ' θ(n)', NULL),
(1603, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES27TGIWXZ2MXC7T7', 4, 'θ(1)', NULL),
(1604, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESX2M3MG2GH34JZ24', 1, 'O(1)', NULL),
(1605, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESX2M3MG2GH34JZ24', 2, 'O(n)', NULL),
(1606, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESX2M3MG2GH34JZ24', 3, 'O(n2)', NULL),
(1607, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESX2M3MG2GH34JZ24', 4, 'O(n3)', NULL),
(1608, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESX7MY2BX189LJ8J7', 1, 'Semantic analysis', NULL),
(1609, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESX7MY2BX189LJ8J7', 2, ' Intermediate code generator', NULL),
(1610, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESX7MY2BX189LJ8J7', 3, 'Code generator', NULL),
(1611, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESX7MY2BX189LJ8J7', 4, 'All of the mentioned', NULL),
(1612, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESZ3LN3BHEABU1JGY', 1, ' Syntax Error', NULL),
(1613, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESZ3LN3BHEABU1JGY', 2, ' Logical Error', NULL),
(1614, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESZ3LN3BHEABU1JGY', 3, 'Both Logical and Syntax Error', NULL),
(1615, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESZ3LN3BHEABU1JGY', 4, 'Compiler cannot check errors', NULL),
(1616, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESG3EG921AHJE443W', 1, 'Interpreter', NULL),
(1617, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESG3EG921AHJE443W', 2, 'Assembler', NULL),
(1618, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESG3EG921AHJE443W', 3, 'Compiler', NULL),
(1619, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESG3EG921AHJE443W', 4, 'Linking Loader', NULL),
(1620, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESGL9C7GN3RB23LE4', 1, 'Opcode fetch, memory read, memory write, I/O read, I/O write', NULL),
(1621, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESGL9C7GN3RB23LE4', 2, ' Opcode fetch, memory write, memory read, I/O read, I/O write', NULL),
(1622, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESGL9C7GN3RB23LE4', 3, ' I/O read, opcode fetch, memory read, memory write, I/O write', NULL),
(1623, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESGL9C7GN3RB23LE4', 4, 'I/O read, opcode fetch, memory write, memory read, I/O write', NULL),
(1624, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESJ3K2W482EIALT5I', 1, 'It is a non-maskable interrupt', NULL),
(1625, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESJ3K2W482EIALT5I', 2, 'It is of highest priority', NULL),
(1626, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESJ3K2W482EIALT5I', 3, ' It uses edge-triggered signal', NULL),
(1627, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESJ3K2W482EIALT5I', 4, 'It is a vectored interrupt', NULL),
(1628, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES7T3RE239GYXG88X', 1, 'Program counter', NULL),
(1629, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES7T3RE239GYXG88X', 2, ' Instruction register', NULL),
(1630, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES7T3RE239GYXG88X', 3, 'Accumulator', NULL),
(1631, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES7T3RE239GYXG88X', 4, ' Temporary register', NULL),
(1632, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES7AX4IA45779J833', 1, '16', NULL),
(1633, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES7AX4IA45779J833', 2, '20', NULL),
(1634, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES7AX4IA45779J833', 3, '32', NULL),
(1635, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES7AX4IA45779J833', 4, '40', NULL),
(1636, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESULBGLGH33KX4J6F', 1, '<p>A</p>', NULL),
(1637, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESULBGLGH33KX4J6F', 2, '<p>E</p>', NULL),
(1638, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESULBGLGH33KX4J6F', 3, '<p>F</p>', NULL),
(1639, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESULBGLGH33KX4J6F', 4, '<p>Both E and F</p>', NULL),
(1640, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES4G1T6H31Y97HTE3', 1, 'SGMT', NULL),
(1641, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES4G1T6H31Y97HTE3', 2, 'SGML', NULL),
(1642, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES4G1T6H31Y97HTE3', 3, 'SGME', NULL),
(1643, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES4G1T6H31Y97HTE3', 4, 'XHTML', NULL),
(1644, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES798T34KNXG13B9R', 1, ' src=”_blank”', NULL),
(1645, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES798T34KNXG13B9R', 2, 'alt=”_blank”', NULL),
(1646, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES798T34KNXG13B9R', 3, 'target=”_self”', NULL),
(1647, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES798T34KNXG13B9R', 4, 'target=”_blank”', NULL),
(1648, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES1TIJTLG94144E1C', 1, '<p>no output</p>', NULL),
(1649, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES1TIJTLG94144E1C', 2, '<p>Welcome to Debark</p>', NULL),
(1650, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES1TIJTLG94144E1C', 3, '<p>Model Two</p>', NULL),
(1651, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES1TIJTLG94144E1C', 4, '<p>error</p>', NULL),
(1652, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES4LN3XR723RL9KEL', 1, 'Overflow', NULL),
(1653, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES4LN3XR723RL9KEL', 2, 'Underflow', NULL),
(1654, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES4LN3XR723RL9KEL', 3, 'Syntax Error', NULL),
(1655, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES4LN3XR723RL9KEL', 4, 'Garbage Value', NULL),
(1656, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESX4GIXEWFHO9H7U2', 1, 'set of categories and methods that specify the functioning, organisation, and implementation of computer systems', NULL),
(1657, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESX4GIXEWFHO9H7U2', 2, ' set of principles and methods that specify the functioning, organisation, and implementation of computer systems', NULL),
(1658, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESX4GIXEWFHO9H7U2', 3, ' set of functions and methods that specify the functioning, organisation, and implementation of computer systems', NULL),
(1659, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESX4GIXEWFHO9H7U2', 4, ' set of functions and methods that specify the functioning, organisation, and implementation of computer systems', NULL),
(1660, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESZBENEF2E2R6OGIK', 1, ' structure and behaviour of a computer system as observed by the user', NULL),
(1661, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESZBENEF2E2R6OGIK', 2, 'structure of a computer system as observed by the developer', NULL),
(1662, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESZBENEF2E2R6OGIK', 3, 'structure and behaviour of a computer system as observed by the developer', NULL),
(1663, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESZBENEF2E2R6OGIK', 4, 'All of the mentioned', NULL),
(1664, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESGLE342Y521W43EI', 1, 'Microarchitecture', NULL),
(1665, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESGLE342Y521W43EI', 2, ' Harvard Architecture', NULL),
(1666, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESGLE342Y521W43EI', 3, ' Von-Neumann Architecture', NULL),
(1667, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESGLE342Y521W43EI', 4, ' All of the mentioned', NULL),
(1668, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESOFRIK5223XH8ZJ1', 1, ' O(n) ', NULL),
(1669, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESOFRIK5223XH8ZJ1', 2, ' O(n^2) ', NULL),
(1670, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESOFRIK5223XH8ZJ1', 3, ' O(1) ', NULL),
(1671, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESOFRIK5223XH8ZJ1', 4, ' O(log n)', NULL),
(1672, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES4OH7318J63XIL62', 1, ' Hyper data', NULL),
(1673, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES4OH7318J63XIL62', 2, 'Tera data', NULL),
(1674, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES4OH7318J63XIL62', 3, 'Meta data', NULL),
(1675, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES4OH7318J63XIL62', 4, ' d)', NULL),
(1676, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESB47AGCMO547UMT7', 1, 'Microarchitecture', NULL),
(1677, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESB47AGCMO547UMT7', 2, 'Harvard Architecture', NULL),
(1678, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESB47AGCMO547UMT7', 3, 'Von-Neumann Architecture', NULL),
(1679, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESB47AGCMO547UMT7', 4, 'System Design', NULL),
(1680, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES61JNJ12J1HX1O3M', 1, 'Stack', NULL),
(1681, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES61JNJ12J1HX1O3M', 2, 'Arrays', NULL),
(1682, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES61JNJ12J1HX1O3M', 3, ' Linked List', NULL),
(1683, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES61JNJ12J1HX1O3M', 4, ' All of the above', NULL),
(1684, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES65HG71HY87884KI', 1, 'Microarchitecture', NULL),
(1685, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES65HG71HY87884KI', 2, ' Instruction set architecture', NULL),
(1686, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES65HG71HY87884KI', 3, 'Systems design', NULL),
(1687, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES65HG71HY87884KI', 4, ' All of the mentioned', NULL),
(1688, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES44438LTR3YHII1O', 1, ' Primary Key', NULL),
(1689, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES44438LTR3YHII1O', 2, ' Foreign key', NULL),
(1690, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES44438LTR3YHII1O', 3, 'Super key', NULL),
(1691, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES44438LTR3YHII1O', 4, ' Candidate key', NULL),
(1692, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESM4U2I3G28GRKRNB', 1, 'RISC', NULL),
(1693, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESM4U2I3G28GRKRNB', 2, 'ISA', NULL),
(1694, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESM4U2I3G28GRKRNB', 3, 'IANA', NULL),
(1695, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESM4U2I3G28GRKRNB', 4, 'CISC', NULL),
(1696, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES7UJWW822WCNN1JW', 1, ' Computer Service Architecture', NULL),
(1697, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES7UJWW822WCNN1JW', 2, ' Computer Speed Addition', NULL),
(1698, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES7UJWW822WCNN1JW', 3, 'Carry Save Addition', NULL),
(1699, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES7UJWW822WCNN1JW', 4, 'None of the mentioned', NULL),
(1700, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESOHXIZYEJBZHN33H', 1, 'Parser', NULL),
(1701, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESOHXIZYEJBZHN33H', 2, 'Code optimizer', NULL),
(1702, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESOHXIZYEJBZHN33H', 3, 'Code generator', NULL),
(1703, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESOHXIZYEJBZHN33H', 4, 'Scanner', NULL),
(1704, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESWK711OYGX4U1EUZ', 1, 'Bottom-up parsing', NULL),
(1705, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESWK711OYGX4U1EUZ', 2, 'Top-down parsing', NULL),
(1706, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESWK711OYGX4U1EUZ', 3, 'None of the above', NULL),
(1707, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESWK711OYGX4U1EUZ', 4, 'Both a and b', NULL),
(1708, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES8889HRG92UKH64A', 1, ' Generation word', NULL),
(1709, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES8889HRG92UKH64A', 2, 'Exception handling', NULL),
(1710, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES8889HRG92UKH64A', 3, 'Imprecise exceptions', NULL),
(1711, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES8889HRG92UKH64A', 4, 'None of the mentioned', NULL),
(1712, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES7WM8A9WXTU2B43C', 1, 'Interpreter', NULL),
(1713, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES7WM8A9WXTU2B43C', 2, 'Assembler', NULL),
(1714, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES7WM8A9WXTU2B43C', 3, 'Compiler', NULL),
(1715, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES7WM8A9WXTU2B43C', 4, ' Linking Loader', NULL),
(1716, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES7FM94XIF3N2E32E', 1, 'Right-most derivation in reverse', NULL),
(1717, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES7FM94XIF3N2E32E', 2, 'Left-most derivation in reverse', NULL),
(1718, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES7FM94XIF3N2E32E', 3, 'Right-most derivation', NULL),
(1719, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES7FM94XIF3N2E32E', 4, 'Left-most derivation', NULL),
(1720, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESLI2B83HGE79OFH4', 1, 'To reduce the memory access time we generally make use of ______', NULL),
(1721, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESLI2B83HGE79OFH4', 2, 'SDRAM’s', NULL),
(1722, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESLI2B83HGE79OFH4', 3, 'Heaps', NULL),
(1723, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESLI2B83HGE79OFH4', 4, 'Cache’s', NULL),
(1724, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESLI2B83HGE79OFH4', 5, 'Higher capacity RAM’s', NULL),
(1725, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESBK2G2CGHE7G46H9', 1, '7abcd', NULL),
(1726, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESBK2G2CGHE7G46H9', 2, '_abc', NULL),
(1727, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESBK2G2CGHE7G46H9', 3, 'for', NULL),
(1728, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESBK2G2CGHE7G46H9', 4, 'none', NULL),
(1729, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESN46JX2CW3F9H1WY', 1, 'Right-most derivation in reverse', NULL),
(1730, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESN46JX2CW3F9H1WY', 2, 'Left-most derivation in reverse', NULL),
(1731, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESN46JX2CW3F9H1WY', 3, 'Right-most derivation', NULL),
(1732, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESN46JX2CW3F9H1WY', 4, 'Left-most derivation', NULL),
(1733, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESER8TJ3UJMJJ5EE4', 1, 'Simplicity', NULL),
(1734, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESER8TJ3UJMJJ5EE4', 2, 'Accessibility', NULL),
(1735, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESER8TJ3UJMJJ5EE4', 3, 'Modularity', NULL),
(1736, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESER8TJ3UJMJJ5EE4', 4, 'All of the above', NULL),
(1737, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES2O8F672X2XYEC4T', 1, 'TF', NULL),
(1738, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES2O8F672X2XYEC4T', 2, 'IOPL', NULL),
(1739, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES2O8F672X2XYEC4T', 3, 'IF', NULL),
(1740, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES2O8F672X2XYEC4T', 4, 'All of the mentioned', NULL),
(1741, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES1XNGL8X413G7E5H', 1, 'Binary', NULL),
(1742, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES1XNGL8X413G7E5H', 2, 'VTC', NULL),
(1743, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES1XNGL8X413G7E5H', 3, 'Text', NULL),
(1744, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES1XNGL8X413G7E5H', 4, 'Hex', NULL),
(1745, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES25AC3Z35343X243', 1, 'Stack', NULL),
(1746, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES25AC3Z35343X243', 2, 'Deque', NULL),
(1747, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES25AC3Z35343X243', 3, 'Queue', NULL),
(1748, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES25AC3Z35343X243', 4, 'String', NULL),
(1749, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESMK8YB6BLY7Z4LW6', 1, 'string character', NULL),
(1750, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESMK8YB6BLY7Z4LW6', 2, 'a syntax tree', NULL),
(1751, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESMK8YB6BLY7Z4LW6', 3, 'a set of RE', NULL),
(1752, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESMK8YB6BLY7Z4LW6', 4, 'a set of tokens', NULL),
(1753, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESJHOUGEE3INOI1XJ', 1, 'int array[10];', NULL),
(1754, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESJHOUGEE3INOI1XJ', 2, 'array a[];', NULL),
(1755, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESJHOUGEE3INOI1XJ', 3, 'array a[10];', NULL),
(1756, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESJHOUGEE3INOI1XJ', 4, 'array-declare[10];', NULL),
(1757, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESEW73EKAG2B3BZL6', 1, 'set of programs, documentation & configuration of data', NULL),
(1758, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESEW73EKAG2B3BZL6', 2, ' set of programs', NULL),
(1759, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESEW73EKAG2B3BZL6', 3, 'documentation and configuration of data', NULL),
(1760, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESEW73EKAG2B3BZL6', 4, 'documentation and configuration of data', NULL),
(1761, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESZ8NX4B8GRB9UA8C', 1, ' n – 1', NULL),
(1762, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESZ8NX4B8GRB9UA8C', 2, 'n', NULL),
(1763, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESZ8NX4B8GRB9UA8C', 3, '1', NULL),
(1764, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESZ8NX4B8GRB9UA8C', 4, ' n – 2', NULL),
(1765, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES8LYB344FBGFR1Z6', 1, 'Lexical Grammar', NULL),
(1766, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES8LYB344FBGFR1Z6', 2, 'Context-free Grammar', NULL),
(1767, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES8LYB344FBGFR1Z6', 3, 'Context-free Grammar', NULL),
(1768, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES8LYB344FBGFR1Z6', 4, 'Regular Grammar', NULL),
(1769, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES3723N524WHXA4KF', 1, '# and $', NULL),
(1770, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES3723N524WHXA4KF', 2, '#', NULL),
(1771, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES3723N524WHXA4KF', 3, '$', NULL),
(1772, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES3723N524WHXA4KF', 4, ';', NULL),
(1773, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES8UU1W914188E9R3', 1, ' Designing a software', NULL),
(1774, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES8UU1W914188E9R3', 2, 'Testing a software', NULL),
(1775, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES8UU1W914188E9R3', 3, 'Application of engineering principles to the design a software', NULL),
(1776, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES8UU1W914188E9R3', 4, 'None of the above', NULL),
(1777, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES326TJZ3NIH4F1JC', 1, 'Intel’s first x86 processor', NULL),
(1778, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES326TJZ3NIH4F1JC', 2, 'Motrola’s first x86 processor', NULL),
(1779, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES326TJZ3NIH4F1JC', 3, ' STMICROELECTRONICS’s first x86 processor', NULL),
(1780, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES326TJZ3NIH4F1JC', 4, 'NanoXplore x86 processor', NULL),
(1781, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES19Y848XG6J4O82W', 1, 'Data', NULL),
(1782, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES19Y848XG6J4O82W', 2, 'Modules', NULL),
(1783, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES19Y848XG6J4O82W', 3, 'Programs', NULL),
(1784, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES19Y848XG6J4O82W', 4, 'None of the above', NULL),
(1785, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESEHNJ7W1AO1Y2CT7', 1, 'removing comments', NULL),
(1786, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESEHNJ7W1AO1Y2CT7', 2, 'removing whitespace', NULL),
(1787, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESEHNJ7W1AO1Y2CT7', 3, 'breaking the syntaxes in the set of tokens', NULL),
(1788, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESEHNJ7W1AO1Y2CT7', 4, 'All of the mentioned', NULL),
(1789, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESX758H3JKKUKG124', 1, ' Left -> Right -> Root', NULL),
(1790, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESX758H3JKKUKG124', 2, ' Left -> Root -> Right', NULL),
(1791, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESX758H3JKKUKG124', 3, ' Right -> Left -> Root', NULL),
(1792, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESX758H3JKKUKG124', 4, 'Right -> Root -> Left', NULL),
(1793, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESE2A2NTY626J5T26', 1, 'Margaret Hamilton', NULL),
(1794, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESE2A2NTY626J5T26', 2, 'Watts S. Humphrey', NULL),
(1795, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESE2A2NTY626J5T26', 3, 'Alan Turing', NULL),
(1796, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESE2A2NTY626J5T26', 4, 'Boris Beizer', NULL),
(1797, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES8XXFF98W2YIUJM3', 1, 'class having one form', NULL),
(1798, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES8XXFF98W2YIUJM3', 2, 'class having two form', NULL),
(1799, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES8XXFF98W2YIUJM3', 3, 'class having many form', NULL),
(1800, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES8XXFF98W2YIUJM3', 4, 'none', NULL),
(1801, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESWKHI8BJX56AK5B4', 1, 'Validation', NULL),
(1802, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESWKHI8BJX56AK5B4', 2, 'Specification', NULL),
(1803, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESWKHI8BJX56AK5B4', 3, 'Development', NULL),
(1804, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESWKHI8BJX56AK5B4', 4, ' Dependence', NULL),
(1805, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESIJ7UNXOYKJJ2GX6', 1, 'CISC', NULL),
(1806, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESIJ7UNXOYKJJ2GX6', 2, 'RISC', NULL),
(1807, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESIJ7UNXOYKJJ2GX6', 3, 'EPIC', NULL),
(1808, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESIJ7UNXOYKJJ2GX6', 4, 'All of the mentioned', NULL),
(1809, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES9AT38LC78GUH571', 1, 'Code optimization', NULL),
(1810, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES9AT38LC78GUH571', 2, 'Code generation', NULL),
(1811, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES9AT38LC78GUH571', 3, 'Parser', NULL),
(1812, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES9AT38LC78GUH571', 4, 'Lexical Analysis', NULL),
(1813, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES4LJEJI12I2XFZNJ', 1, 'depends on the operating system   ', NULL),
(1814, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES4LJEJI12I2XFZNJ', 2, ' change', NULL),
(1815, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES4LJEJI12I2XFZNJ', 3, ' remain unchanged', NULL),
(1816, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES4LJEJI12I2XFZNJ', 4, ' none of the mentioned', NULL),
(1817, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESUJ74J18E95GJXK8', 1, 'project management that emphasizes incremental progress', NULL),
(1818, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESUJ74J18E95GJXK8', 2, 'project management that emphasizes decremental progress', NULL),
(1819, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESUJ74J18E95GJXK8', 3, 'project management that emphasizes neutral progress', NULL),
(1820, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESUJ74J18E95GJXK8', 4, ' project management that emphasizes no progress', NULL),
(1821, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES8XOEF23M881N4LY', 1, 'Program Counter', NULL),
(1822, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES8XOEF23M881N4LY', 2, 'Flag', NULL),
(1823, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES8XOEF23M881N4LY', 3, 'Main Memory', NULL),
(1824, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES8XOEF23M881N4LY', 4, ' Secondary Memory', NULL),
(1825, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESH7I4C8G97K8U211', 1, 'Users', NULL),
(1826, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESH7I4C8G97K8U211', 2, 'Clients', NULL),
(1827, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESH7I4C8G97K8U211', 3, 'End Users', NULL),
(1828, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESH7I4C8G97K8U211', 4, 'Stake Holders', NULL),
(1829, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESZ4NY6463G5G43FH', 1, 'Code Optimization', NULL),
(1830, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESZ4NY6463G5G43FH', 2, 'Semantic Analysis', NULL),
(1831, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESZ4NY6463G5G43FH', 3, 'Code Generation', NULL),
(1832, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESZ4NY6463G5G43FH', 4, 'Syntax Analysis', NULL),
(1833, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES4X1HG327JM4642G', 1, 'run time error', NULL),
(1834, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES4X1HG327JM4642G', 2, 'compile time error', NULL),
(1835, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES4X1HG327JM4642G', 3, 'truefalse', NULL),
(1836, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES4X1HG327JM4642G', 4, '1', NULL),
(1837, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESX4HHJ7UO231JM44', 1, ' Computer-Aided Software Engineering', NULL),
(1838, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESX4HHJ7UO231JM44', 2, ' Control Aided Science and Engineering', NULL),
(1839, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESX4HHJ7UO231JM44', 3, 'Cost Aided System Experiments', NULL),
(1840, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESX4HHJ7UO231JM44', 4, 'None of the mentioned', NULL);
INSERT INTO `option_list` (`id`, `cat_id`, `exam_id`, `quest_type`, `quest_id`, `opt_no`, `ot`, `option_image`) VALUES
(1841, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESC2TU226X5Z7N4RJ', 1, 'Re-engineering', NULL),
(1842, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESC2TU226X5Z7N4RJ', 2, 'Reverse engineering', NULL),
(1843, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESC2TU226X5Z7N4RJ', 3, 'Software re-engineering', NULL),
(1844, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESC2TU226X5Z7N4RJ', 4, ' Science and engineering', NULL),
(1845, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES6JIJ79139T4RM15', 1, 'equal', NULL),
(1846, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES6JIJ79139T4RM15', 2, 'more', NULL),
(1847, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES6JIJ79139T4RM15', 3, 'less', NULL),
(1848, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES6JIJ79139T4RM15', 4, ' none of the mentioned', NULL),
(1849, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESOYH7ZCX2J2X4W8J', 1, 'Syntax Analysis', NULL),
(1850, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESOYH7ZCX2J2X4W8J', 2, 'Lexical Analysis', NULL),
(1851, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESOYH7ZCX2J2X4W8J', 3, 'Semantic Analysis', NULL),
(1852, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESOYH7ZCX2J2X4W8J', 4, 'Code generation', NULL),
(1853, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES9E4HC2RHFHCHT7N', 1, 'NMOS', NULL),
(1854, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES9E4HC2RHFHCHT7N', 2, 'HMOS', NULL),
(1855, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES9E4HC2RHFHCHT7N', 3, 'PMOS', NULL),
(1856, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES9E4HC2RHFHCHT7N', 4, 'TTL', NULL),
(1857, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESH48T4R3213BA8O2', 1, 'Project scheduling', NULL),
(1858, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESH48T4R3213BA8O2', 2, 'Detailed schedule', NULL),
(1859, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESH48T4R3213BA8O2', 3, ' Macroscopic schedule', NULL),
(1860, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESH48T4R3213BA8O2', 4, ' None of the mentioned', NULL),
(1861, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESYXYUOGX9BN5EFH1', 1, '\\r', NULL),
(1862, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESYXYUOGX9BN5EFH1', 2, '\\n', NULL),
(1863, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESYXYUOGX9BN5EFH1', 3, '\\k', NULL),
(1864, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESYXYUOGX9BN5EFH1', 4, 'All', NULL),
(1865, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESX9N4C4IJ7EKHOM3', 1, ' Device drivers', NULL),
(1866, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESX9N4C4IJ7EKHOM3', 2, 'I/O systems', NULL),
(1867, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESX9N4C4IJ7EKHOM3', 3, 'Devices', NULL),
(1868, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESX9N4C4IJ7EKHOM3', 4, 'Buses', NULL),
(1869, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESGEEGJJ94ME43ZHE', 1, 'Simple attribute', NULL),
(1870, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESGEEGJJ94ME43ZHE', 2, 'Composite attribute', NULL),
(1871, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESGEEGJJ94ME43ZHE', 3, '	Multivalued attribute', NULL),
(1872, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESGEEGJJ94ME43ZHE', 4, 'Derived attribute', NULL),
(1873, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES7988R34WGYEXKER', 1, 'Code Optimization', NULL),
(1874, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES7988R34WGYEXKER', 2, 'Semantic Analysis', NULL),
(1875, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES7988R34WGYEXKER', 3, 'Syntax Analysis', NULL),
(1876, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES7988R34WGYEXKER', 4, 'Lexical Analysis', NULL),
(1877, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESR2X9GFR1TGTBZ1E', 1, 'Because of Developers', NULL),
(1878, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESR2X9GFR1TGTBZ1E', 2, 'Because of companies', NULL),
(1879, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESR2X9GFR1TGTBZ1E', 3, 'Because of both companies and Developers', NULL),
(1880, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESR2X9GFR1TGTBZ1E', 4, 'None of the mentioned', NULL),
(1881, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESBKJX8ZEHJ73HN2X', 1, '\\n', NULL),
(1882, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESBKJX8ZEHJ73HN2X', 2, '\\t', NULL),
(1883, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESBKJX8ZEHJ73HN2X', 3, '\\tb', NULL),
(1884, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESBKJX8ZEHJ73HN2X', 4, '\\tab', NULL),
(1885, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESI294I1881348X8G', 1, 'maintains', NULL),
(1886, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESI294I1881348X8G', 2, 'changes', NULL),
(1887, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESI294I1881348X8G', 3, 'increases', NULL),
(1888, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESI294I1881348X8G', 4, 'decreases', NULL),
(1889, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES432YCY3JERKFXG4', 1, 'An LALR parser', NULL),
(1890, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES432YCY3JERKFXG4', 2, 'A LR parser', NULL),
(1891, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES432YCY3JERKFXG4', 3, 'Operator precedence parser', NULL),
(1892, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES432YCY3JERKFXG4', 4, 'Recursive descent parser', NULL),
(1893, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESX13G6JBI782G35Z', 1, 'Development', NULL),
(1894, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESX13G6JBI782G35Z', 2, 'Maintainability & functionality', NULL),
(1895, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESX13G6JBI782G35Z', 3, 'Functionality', NULL),
(1896, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESX13G6JBI782G35Z', 4, 'Maintainability', NULL),
(1897, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESGGJ2J6L9ORGGTML', 1, ' register indirect addressing mode', NULL),
(1898, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESGGJ2J6L9ORGGTML', 2, 'direct addressing mode', NULL),
(1899, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESGGJ2J6L9ORGGTML', 3, 'register addressing mode', NULL),
(1900, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESGGJ2J6L9ORGGTML', 4, 'register relative addressing mode', NULL),
(1901, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES2ZU43TWA9UGH3I8', 1, ' Exactly 1', NULL),
(1902, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES2ZU43TWA9UGH3I8', 2, ' At most 1', NULL),
(1903, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES2ZU43TWA9UGH3I8', 3, ' At most 2', NULL),
(1904, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES2ZU43TWA9UGH3I8', 4, 'Depends on the graph', NULL),
(1905, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESO69JJCBLCJJJFZ9', 1, 'the code generation', NULL),
(1906, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESO69JJCBLCJJJFZ9', 2, 'the data flow analysis', NULL),
(1907, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESO69JJCBLCJJJFZ9', 3, 'the lexical analysis of the program', NULL),
(1908, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESO69JJCBLCJJJFZ9', 4, 'the program parsing', NULL),
(1909, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES49OG3WJFZLEZ4NI', 1, 'Linger', NULL),
(1910, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES49OG3WJFZLEZ4NI', 2, ' Mills', NULL),
(1911, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES49OG3WJFZLEZ4NI', 3, 'Dyer', NULL),
(1912, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES49OG3WJFZLEZ4NI', 4, 'All of the Mentioned', NULL),
(1913, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES36HAH9CCL38J964', 1, 'bad-block recovery', NULL),
(1914, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES36HAH9CCL38J964', 2, ' booting from disk', NULL),
(1915, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES36HAH9CCL38J964', 3, 'disk initialization', NULL),
(1916, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES36HAH9CCL38J964', 4, 'all of the mentioned', NULL),
(1917, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESK85CE7O31LJ433F', 1, 'Relational Model', NULL),
(1918, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESK85CE7O31LJ433F', 2, 'Hierarchical Model', NULL),
(1919, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESK85CE7O31LJ433F', 3, 'Network Model', NULL),
(1920, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESK85CE7O31LJ433F', 4, 'Entity Relationship Model', NULL),
(1921, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES2E4N5OW3XKZ1HEJ', 1, ' System Design Life Cycle', NULL),
(1922, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES2E4N5OW3XKZ1HEJ', 2, 'Software Design Life Cycle', NULL),
(1923, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES2E4N5OW3XKZ1HEJ', 3, 'Software Development Life Cycle', NULL),
(1924, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES2E4N5OW3XKZ1HEJ', 4, ' System Development Life cycle', NULL),
(1925, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESKGYYFNLB4HL21ZZ', 1, 'Elements of the array', NULL),
(1926, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESKGYYFNLB4HL21ZZ', 2, 'Index of the array', NULL),
(1927, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESKGYYFNLB4HL21ZZ', 3, 'Function of the array', NULL),
(1928, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESKGYYFNLB4HL21ZZ', 4, 'None', NULL),
(1929, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES8BO83GOXLG1TIXG', 1, '8-bits – 64 bits', NULL),
(1930, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES8BO83GOXLG1TIXG', 2, ' 4-bits – 32 bits', NULL),
(1931, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES8BO83GOXLG1TIXG', 3, '8-bits – 16 bits', NULL),
(1932, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES8BO83GOXLG1TIXG', 4, ' 8-bits – 32 bits', NULL),
(1933, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESLI1JHGJ2CU8129L', 1, ' Delay time', NULL),
(1934, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESLI1JHGJ2CU8129L', 2, ' CPU cycle', NULL),
(1935, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESLI1JHGJ2CU8129L', 3, 'Real time', NULL),
(1936, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESLI1JHGJ2CU8129L', 4, ' Seek time', NULL),
(1937, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES9J4Y7J1JGJWNJ7W', 1, ' operating system', NULL),
(1938, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES9J4Y7J1JGJWNJ7W', 2, ' resources', NULL),
(1939, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES9J4Y7J1JGJWNJ7W', 3, 'system storage state', NULL),
(1940, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES9J4Y7J1JGJWNJ7W', 4, 'resource allocation state', NULL),
(1941, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES26JM2411KLOW26C', 1, ' Barry Boehm ', NULL),
(1942, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES26JM2411KLOW26C', 2, ' Pressman', NULL),
(1943, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES26JM2411KLOW26C', 3, ' Royce', NULL),
(1944, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES26JM2411KLOW26C', 4, ' IBM', NULL),
(1945, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESI2M3K8IBYNNEJU2', 1, 'Multipass compiler', NULL),
(1946, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESI2M3K8IBYNNEJU2', 2, 'Cross compiler', NULL),
(1947, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESI2M3K8IBYNNEJU2', 3, 'Optimizing compiler', NULL),
(1948, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESI2M3K8IBYNNEJU2', 4, 'Onepass compiler', NULL),
(1949, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES39Y2CA8FFOJR3HB', 1, '246', NULL),
(1950, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES39Y2CA8FFOJR3HB', 2, ' 278', NULL),
(1951, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES39Y2CA8FFOJR3HB', 3, '250', NULL),
(1952, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES39Y2CA8FFOJR3HB', 4, ' 256', NULL),
(1953, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESJEB4C42G2MHTH99', 1, 'PRODUCT', NULL),
(1954, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESJEB4C42G2MHTH99', 2, ' ENVIRONMENT', NULL),
(1955, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESJEB4C42G2MHTH99', 3, ' PUBLIC', NULL),
(1956, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESJEB4C42G2MHTH99', 4, ' PROFESSION', NULL),
(1957, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESA2TM8I44XHJGROJ', 1, 'One to many', NULL),
(1958, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESA2TM8I44XHJGROJ', 2, 'One to one', NULL),
(1959, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESA2TM8I44XHJGROJ', 3, 'Many to many', NULL),
(1960, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESA2TM8I44XHJGROJ', 4, 'Many to one', NULL),
(1961, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESG9UU1RR2T673E7U', 1, 'every time a resource request is made at fixed time intervals', NULL),
(1962, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESG9UU1RR2T673E7U', 2, 'at fixed time intervals', NULL),
(1963, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESG9UU1RR2T673E7U', 3, 'every time a resource request is made', NULL),
(1964, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESG9UU1RR2T673E7U', 4, 'none of the mentioned', NULL),
(1965, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESHKJBJX18HEG994J', 1, 'More execution time', NULL),
(1966, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESHKJBJX18HEG994J', 2, 'Debugging process is slow', NULL),
(1967, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESHKJBJX18HEG994J', 3, 'The execution takes place after the removal of all syntax errors', NULL),
(1968, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESHKJBJX18HEG994J', 4, 'Firstly scans the entire program and then transforms it into machine-understandable code', NULL),
(1969, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES5X2EHAG7OOBR3J3', 1, 'It consists of control PIN 21 to 28', NULL),
(1970, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES5X2EHAG7OOBR3J3', 2, ' It is a bidirectional bus', NULL),
(1971, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES5X2EHAG7OOBR3J3', 3, 'It is 16 bits in length', NULL),
(1972, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES5X2EHAG7OOBR3J3', 4, ' Lower address bus lines (AD0 – AD7) are called “Line number”', NULL),
(1973, 'DTE3498718', 'TES87463923977824639', 'choose', 'TEST9127X5YNHKTXIA', 1, 'Central Repository', NULL),
(1974, 'DTE3498718', 'TES87463923977824639', 'choose', 'TEST9127X5YNHKTXIA', 2, 'Integrated Case Tools', NULL),
(1975, 'DTE3498718', 'TES87463923977824639', 'choose', 'TEST9127X5YNHKTXIA', 3, 'Upper Case Tools', NULL),
(1976, 'DTE3498718', 'TES87463923977824639', 'choose', 'TEST9127X5YNHKTXIA', 4, 'All of the mentioned', NULL),
(1977, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES8L7E14N8YG1WTU5', 1, 'Internal memory', NULL),
(1978, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES8L7E14N8YG1WTU5', 2, ' Secondary memory', NULL),
(1979, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES8L7E14N8YG1WTU5', 3, 'Microprocessor', NULL),
(1980, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES8L7E14N8YG1WTU5', 4, ' Magnetic tapes', NULL),
(1981, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESZW5JYGJK2GW7GHJ', 1, 'X->Y;X->Z', NULL),
(1982, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESZW5JYGJK2GW7GHJ', 2, 'X->Y->Z', NULL),
(1983, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESZW5JYGJK2GW7GHJ', 3, 'X,Y->Z', NULL),
(1984, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESZW5JYGJK2GW7GHJ', 4, 'None', NULL),
(1985, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES42EUOXJZ64OREA3', 1, ' Customer collaboration', NULL),
(1986, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES42EUOXJZ64OREA3', 2, 'Individuals and interactions', NULL),
(1987, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES42EUOXJZ64OREA3', 3, ' Working software', NULL),
(1988, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES42EUOXJZ64OREA3', 4, 'All of the mentioned', NULL),
(1989, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESYBCM7B2HKZ41G9T', 1, ' It has an internal memory', NULL),
(1990, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESYBCM7B2HKZ41G9T', 2, ' It has interfacing circuits', NULL),
(1991, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESYBCM7B2HKZ41G9T', 3, 'It contains ALU, CU, and registers', NULL),
(1992, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESYBCM7B2HKZ41G9T', 4, 'It uses Harvard architecture', NULL),
(1993, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESX4HUE372UEHG87E', 1, 'create', NULL),
(1994, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESX4HUE372UEHG87E', 2, 'fork', NULL),
(1995, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESX4HUE372UEHG87E', 3, 'new', NULL),
(1996, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESX4HUE372UEHG87E', 4, 'none of the mentioned', NULL),
(1997, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES5Z1OYU26742JH5W', 1, 'neither logical nor grammatical error', NULL),
(1998, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES5Z1OYU26742JH5W', 2, 'logical errors only', NULL),
(1999, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES5Z1OYU26742JH5W', 3, 'grammatical errors only', NULL),
(2000, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES5Z1OYU26742JH5W', 4, 'both grammatical and logical errors', NULL),
(2001, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES17GHHFHZT4XUK91', 1, 'X,Y->Z', NULL),
(2002, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES17GHHFHZT4XUK91', 2, 'X->Y->Z', NULL),
(2003, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES17GHHFHZT4XUK91', 3, 'X->Y;X->Z', NULL),
(2004, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES39I5ZU99L4CREYX', 1, 'CPU', NULL),
(2005, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES39I5ZU99L4CREYX', 2, ' Control Unit', NULL),
(2006, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES39I5ZU99L4CREYX', 3, ' I/O unit', NULL),
(2007, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES39I5ZU99L4CREYX', 4, ' Peripheral unit', NULL),
(2008, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES9CO4ZC61N7B73M5', 1, 'Relation', NULL),
(2009, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES9CO4ZC61N7B73M5', 2, 'Entity', NULL),
(2010, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES9CO4ZC61N7B73M5', 3, 'Instance', NULL),
(2011, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES9CO4ZC61N7B73M5', 4, 'Attribute', NULL),
(2012, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESH5J9H4GB7ACNMTY', 1, 'Daily or routine Fix', NULL),
(2013, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESH5J9H4GB7ACNMTY', 2, ' Required or Critical Fix', NULL),
(2014, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESH5J9H4GB7ACNMTY', 3, 'Emergency Fix', NULL),
(2015, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESH5J9H4GB7ACNMTY', 4, 'None of the mentioned', NULL),
(2016, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESUEEH1EG834H4N77', 1, 'Bottom-up parser', NULL),
(2017, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESUEEH1EG834H4N77', 2, 'Top-down parser', NULL),
(2018, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESUEEH1EG834H4N77', 3, 'Both Top-down and bottom-up', NULL),
(2019, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESUEEH1EG834H4N77', 4, 'None of the Above', NULL),
(2020, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESCZ4GNCYX2ZKK149', 1, 'Opcode fetch, memory read, memory write, I/O read, I/O write', NULL),
(2021, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESCZ4GNCYX2ZKK149', 2, 'Opcode fetch, memory write, memory read, I/O read, I/O write', NULL),
(2022, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESCZ4GNCYX2ZKK149', 3, ' I/O read, opcode fetch, memory read, memory write, I/O write', NULL),
(2023, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESCZ4GNCYX2ZKK149', 4, 'I/O read, opcode fetch, memory write, memory read, I/O writ', NULL),
(2024, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESJ8XGO7C5J4EGK55', 1, ' Controlled Centralized (CC)', NULL),
(2025, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESJ8XGO7C5J4EGK55', 2, 'Controlled decentralized (CD)', NULL),
(2026, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESJ8XGO7C5J4EGK55', 3, 'Democratic decentralized (DD)', NULL),
(2027, 'DTE3498718', 'TES87463923977824639', 'choose', 'TESJ8XGO7C5J4EGK55', 4, 'None of the mentioned', NULL),
(2028, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES883XX2L2EETGBHN', 1, 'int func(int);   int func(int);  ', NULL),
(2029, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES883XX2L2EETGBHN', 2, 'int func(float);   float func(int, int, char);', NULL),
(2030, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES883XX2L2EETGBHN', 3, 'int func(int, int);   float func1(float, float);  ', NULL),
(2031, 'DTE3498718', 'TES87463923977824639', 'choose', 'TES883XX2L2EETGBHN', 4, 'All', NULL),
(2036, 'MOD2571656', 'DEM96149566852544873', 'choose', 'DEMCIX34TG3991G73F', 1, '<p>O(n)</p>', NULL),
(2037, 'MOD2571656', 'DEM96149566852544873', 'choose', 'DEMCIX34TG3991G73F', 2, '<p>O(n log n)</p>', NULL),
(2038, 'MOD2571656', 'DEM96149566852544873', 'choose', 'DEMCIX34TG3991G73F', 3, '<p>O(n^2)</p>', NULL),
(2039, 'MOD2571656', 'DEM96149566852544873', 'choose', 'DEMCIX34TG3991G73F', 4, '<p>O(n^2Logn)</p>', NULL),
(2044, 'MOD2571656', 'DEM96149566852544873', 'choose', 'DEM3693XY47J7AUCRB', 1, 'X will always be a better choice for small inputs', NULL),
(2045, 'MOD2571656', 'DEM96149566852544873', 'choose', 'DEM3693XY47J7AUCRB', 2, 'X will always be a better choice for large inputs', NULL),
(2046, 'MOD2571656', 'DEM96149566852544873', 'choose', 'DEM3693XY47J7AUCRB', 3, 'Y will always be a better choice for small inputs', NULL),
(2047, 'MOD2571656', 'DEM96149566852544873', 'choose', 'DEM3693XY47J7AUCRB', 4, 'X will always be a better choice for all inputs', NULL),
(2050, 'MOD2571656', 'DEM96149566852544873', 'choose', 'DEM9HE1M14J4MH216K', 1, 'Pascal', NULL),
(2051, 'MOD2571656', 'DEM96149566852544873', 'choose', 'DEM9HE1M14J4MH216K', 2, 'C', NULL),
(2052, 'MOD2571656', 'DEM96149566852544873', 'choose', 'DEM9HE1M14J4MH216K', 3, 'C#', NULL),
(2053, 'MOD2571656', 'DEM96149566852544873', 'choose', 'DEM9HE1M14J4MH216K', 4, 'Machine language', NULL),
(2054, 'MOD2571656', 'DEM96149566852544873', 'choose', 'DEMBX9TOX9NUGX5X9L', 1, 'A', 'DEM96149566852544873DEMBX9TOX9NUGX5X9L1.jpeg'),
(2055, 'MOD2571656', 'DEM96149566852544873', 'choose', 'DEMBX9TOX9NUGX5X9L', 2, 'B', 'DEM96149566852544873DEMBX9TOX9NUGX5X9L2.jpeg'),
(2056, 'MOD2571656', 'DEM96149566852544873', 'choose', 'DEMBX9TOX9NUGX5X9L', 3, 'C', 'DEM96149566852544873DEMBX9TOX9NUGX5X9L3.jpeg'),
(2057, 'MOD2571656', 'DEM96149566852544873', 'choose', 'DEMBX9TOX9NUGX5X9L', 4, 'D', 'DEM96149566852544873DEMBX9TOX9NUGX5X9L4.jpeg'),
(2058, 'MOD2571656', 'DEM96149566852544873', 'choose', 'DEM3IJTBHNF74J3147', 1, 'True', NULL),
(2059, 'MOD2571656', 'DEM96149566852544873', 'choose', 'DEM3IJTBHNF74J3147', 2, 'False', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE `question` (
  `cat_id` varchar(23) NOT NULL,
  `exam_id` varchar(23) NOT NULL,
  `quest_type` varchar(55) NOT NULL,
  `quest_id` varchar(55) NOT NULL,
  `question_image` longtext DEFAULT NULL,
  `question` longtext NOT NULL,
  `quest_ans` longtext DEFAULT NULL,
  `right_ans` float NOT NULL,
  `hint` varchar(255) DEFAULT NULL,
  `explanation` varchar(255) DEFAULT NULL,
  `stat` int(5) DEFAULT 1,
  `qcreator` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`cat_id`, `exam_id`, `quest_type`, `quest_id`, `question_image`, `question`, `quest_ans`, `right_ans`, `hint`, `explanation`, `stat`, `qcreator`) VALUES
('MOD2571656', 'DEM96149566852544873', 'choose', 'DEM3693XY47J7AUCRB', '', '0aQfLXghzghY22lEOMM+TnJyY0JPdWMyNS9BNjlUa291OWtqd0dKTFpYcTRlSCtOeTJkUEZaUWZpb0tIdEw2L0VtVVhWN3hZVVJSSzFzWHZZMTRRaFFCNjllYjF4U29GVkxoMkRRSnhXdDY5YVMvaFZhREt1SUQzRDA4Nmk5b0l0TnhjTzhnY3pabnJNWmdo', '$2y$10$.ItKcaB4dIpqS0sIXNQNhez7tx4744PeztF8Z/kfzis4ON0MDaQIa', 1, NULL, NULL, 1, 'GIZ9954331'),
('MOD2571656', 'DEM96149566852544873', 'choose', 'DEM3IJTBHNF74J3147', '', 'nyJ/XWBFSsJtW2+EvC4SCUM5SjFkSnlRMGMraWFnNlZNaERNWTBkRkZOMG82SDFnTTRPYTAyeTg1VHpWdlFUYTkyTUE2VHo0M29QVFRJeDFtTldwaXpYRWdkRloxZlBrTGxDNWt5a0pXTXVTeWJKUzhDWWxkOTRjQWt3PQ==', '$2y$10$/1B1kT5yUS2lw9jValkgoudRnzQ8IJBR7Q2hbcS7eqVl4VqcB901C', 1, NULL, NULL, 1, 'GIZ9954331'),
('MOD2571656', 'DEM96149566852544873', 'choose', 'DEM9HE1M14J4MH216K', '', 'Ae9WruZnr44kf1S1qm6YkExHQVd3NXFrSFpTNTlYUHZCQzBIVFduNFRINmZXTjRuYmlCYVU2TlRPakZOaDFPNWxBbklXWkhOc1lnREY5SVdINWZxV2tKVVpiMGxYeUtJTkZVWllCbmJKN0poMlZvRXpRMC9JNVNobEl3PQ==', '$2y$10$/w4JeBa.pYINPZNC9e7PoOxT8Jym61x.M555ZY/mjpQFkCfF4nAFq', 1, NULL, NULL, 1, 'GIZ9954331'),
('MOD2571656', 'DEM96149566852544873', 'choose', 'DEMBX9TOX9NUGX5X9L', '', 'BqqL4TDn4IYNFOBafwfCEHlnaW11R1l0RE1acDE4bE56aXBWbW9aUitoY0hPVUtOcVRKczJPODBWRWMzV2dwbmZsbzhxLzd6QUI3WlRIS25CdFBFZnMwTFl2K2RhZVhoRmdhNkpBPT0=', '$2y$10$bzXk0A1fP/T7SyCyt6YIduKc5e9t1R6nd7guFG7wN54zxexBnurxe', 1, NULL, NULL, 1, 'GIZ9954331'),
('MOD2571656', 'DEM96149566852544873', 'choose', 'DEMCIX34TG3991G73F', '', 'ReAU6e1Qe2e0DeEEAKyK5G1aVFJ2RHVEWlk2QUhnVmlNWFBFYytXb0ZCSms2b0d1TnVEMnJHczdEUENLZDlEalNXM3FVbWNQMUZlVGZ0RXRjQnk1cGhmbmhXcUJxUFNlRS9uK3VYVXhrcGZZSlRxbDNOR0NMSTkzenhjUXFweDJONnp4T2hwUWUvMFdUUzJwZW1ZNUJkWWNNNWx2Y1dvcC9tanpCUno1Wk8yaFArbHBoZWFSUUVEa29IbU0rSENGUm8yR0J4STkyQlU5d2dNckMzUVIyd0hpbWVxVmIwUEdURmE4L1d4TExEbjFXU1plcldMV2xOK0dJL29yN2hJaDBHTkdqajVvNVQvY25oVkJCM2ZrUE1ISWsrNUZZN0JtcUJVdXdzOERwZkVLM1FCYm9PRWwwMWJ5U3M0Yy9sMTJ4b1VwZVE3R2NxOHlabmtqUHJKZEpnYzdVMmxNRWFJVUxoemhYQ0FvN3pZc3VNVFdpZERxejJRSFgzQ20rMDl0OVUvajVrSXljcEFmZHl5Q3k2a1BnRTl6amd4Qi9FL2pGVmRvQVQrajJ2NTZYY1dsMnBHUjB0R2RlQ2FpcXc3OHlQWGQzbHZFS0lRYkJ6bjQ=', '$2y$10$fxJKT2iUjT5iyTrtOO5hP.XRwWdt5trItbXVkc1cgo1e236TPwKOO', 1, NULL, NULL, 1, 'GIZ9954331'),
('MOD2571656', 'MOD26924555698929252', 'choose', 'MOD1H9G12194CH7ENJ', '', 'u3UtbZ9+0jhRHuiusZInW2QwVHBHRFJFZTh1Y2VQNlVYalBPT2NvUmdrWElFaGJtMFFzSWFBNkttS1hsaThPZDIyaG40VXR1eEhFZkpGT09iclZKTklzSkRYTS9EWFd5L3IyRW5lb0FLdkw0ZkM2M05FRmh0RmpEaE9NTXRXQ0REZ0hsYlkxQUxNdWJTVC9D', '$2y$10$QPV3Kh9hW2k9C8qGs4LXcuyUrjShaV6oehaNRG1w5fnd35xyQ310i', 1, NULL, NULL, 1, 'GIZ9954331'),
('MOD2571656', 'MOD84981219413119185', 'choose', 'MOD1JZ3XH439K736IC', '', 'HJjB0fF/EGfGDN6Z2NHXQm5BSUJOekJHaERnYkQxekZhV0ROZk44eVRJMGpMN0VJeFFzTVB6RUxUUEFNL1VuZ21yWVppMWpDbWU1RktoUFF4RGtmTEFaUHBxbUh6b0xBWXFhdmV0MEdvRHlUcndVa2VGSFQ1V013cTE0PQ==', '$2y$10$Z46OaPaw7.ExosOrWieIceQTbyf0QqoZ2P08iZsoHrWM6gE7yDsne', 1, NULL, NULL, 1, ''),
('MOC2132939', 'MOD65383726273746144', 'choose', 'MOD1KX9G749R65R567', '', 'mFpWiDdXtO8iS3x7WCaUGHkzcHVPcUREdERVTlB4em11WWFKeXBuOTZndXBBeGljc0s4cTllWGQzQ1FadWIvdXNUdFFKM1RNMkp3WmNQY0ZHY3NHTlpZaUdVSUd3RzMzZEZIVG4xZThkUmdWT0dIY2w1TjUrZTdBMWdVL1lzc1JGMXNuVUNSbXc0VGM2eTVn', '$2y$10$16azVK7BBeUM0QOsePCojeLVQd6rQtAaXIZvl.Xk9rd2gYzyEtdhi', 1, NULL, NULL, 1, ''),
('MOD2571656', 'MOD26924555698929252', 'choose', 'MOD1MOE7XF3Y21TTTI', '', 'egXqDA2Vn0iYvfWtEItMsjBjUUlMNHNGSVY2Tit0TC9WRTJmWFFCT1VYTEZSSk9tOGVjZVAwZXBnS1lmYUVFODlZeS93Y2hRSVhqUVcxVGdCbGplem5GM1o5djdpUzhvdDMvQ3lxSGpxdW5BRDJYaG82UGk4S1hueVR3PQ==', '$2y$10$f5RqiVPnkgeCFJRXzuiate0GXkBLAFDjd9Y2S66wc2PFZx1e98qe2', 1, NULL, NULL, 1, 'GIZ9954331'),
('MOD2571656', 'MOD26924555698929252', 'choose', 'MOD1XF94U37JW83T2L', '', 'qOiuLKw1PzepbShXwmBXxzg2dXVVM3JlellvRkkvOUhBS016Tnc0MFVqc3BDd04zTEdUSGVSbHBsNnhvUXdUTHdRUytraDZUN29vSit6MUtHSnduTGlNZUwyNCtveWJYY0txVy9rdUlyUXZjOTBhNnN5Mm9xT3VoZ1hvPQ==', '$2y$10$ZCY3yq6uRk40BanEiz7ZDuwFD4w1U.VaZBU58DIrsK2TByI3rI7Vy', 1, NULL, NULL, 1, 'GIZ9954331'),
('MOD2571656', 'MOD26924555698929252', 'choose', 'MOD2B4257O8NJYMBL2', '', 'qbuXmGhIHj1fpGnJehPvzHJXYStLV1JQVmR5dVVMTXF0SjNieUwydmh1QUpUakRjakFvY2JpYThPNC9pTW10SFQxMkpvd09FdDQycVYreSsyaktRRVVTUCt1VldIVlVVaWQyRGJ3PT0=', '$2y$10$xe3FNCUgEl4tiVG.aXBwx.0OIP0P8/A8Ecw9QgDmdzjOCV7l35hwu', 1, NULL, NULL, 1, 'GIZ9954331'),
('MOD2571656', 'MOD26924555698929252', 'choose', 'MOD2E6I3G7491EZFM2', '', 'yiJ4Vtzngi20DIn3En+PPWVWRGFBRGlWYm92ckhTeXN2WFJEOG1YRWM2WEhTVnhMWU9KTXNCTHY5YmJnQUdVRHN3aEtKQTZCY1RBdHNPaXNPMHR2MTNJZUd5K1dvTHFGS1NucWpoRytqQjBKblVNT1R5cGo2eENldnk3ZW1SRmVybWNEV2JpZDRaNmR1WmxSY2JHcHdvQTdiYzR5UlFKVVV2dTNMQT09', '$2y$10$vIvOgsB5DWm693chiKcL2.RODjl9SZ8BaFGquT2Bvb8/IOlOR1ln2', 1, NULL, NULL, 1, 'GIZ9954331'),
('MOC2132939', 'MOD65383726273746144', 'choose', 'MOD2EGH2UJKAUXZ3X7', '', 'ZjZ21M19klr3glbqFr5Np1VFUklTTE9rSU8yaFRNWlMvb1p1aUwwK3JTRHRjZ29jb3NsbURZcFNjQ3l6Ty96bVJYOFAyUjJoanRxcXpZU0JzbnNodUdIaktsSGxZNkpVSW92RVU0RCsyR01OZkpyMEY4NDVLWTNNNnM2SWx2N0hDY2FiQURLWXhGWmVESVp2NUQzQzNLN1VNM292eW1JNE1NTmNuUT09', '$2y$10$GA.AG2ED/SihrIFpGa7qUue887uXa3l.4PchXZuL1d.XJfx/HhDb2', 1, NULL, NULL, 1, ''),
('MOD2571656', 'MOD26924555698929252', 'choose', 'MOD2MHK2NFK9N9HOR1', '', 'S+w3KwK2QH+x1ZU2xB0L6XlDTGdxV0grVjRweG8vTEFWeElOVkk2aS9HdVJHam9vRlN0OFBwNDJldnlVWWY5QnlqQkdvVjU5b2NJaEJIZmVCN05SbVFkVGVnaGdqYWZHa1JOZW5BPT0=', '$2y$10$AE8TOvRkL0k5biN31inrH.M.sp5j/hH.rkpxv8DbqzzEQK2e1.uie', 1, NULL, NULL, 1, 'GIZ9954331'),
('MOD2571656', 'MOD26924555698929252', 'choose', 'MOD2XZN5W2BAH1677L', '', 'OPcu3CDpzgc4Pn6DfrRuZjFqR29Cb1lTancrWThnTWVlNFptWitoNXlMMndhTktpblJBclN1bUJZZ2ZVcnNYUkNqZlhkZjRRazhjNUVYVWY2N1lnT2o1bFJIRjVyZE5CTndrK1VnPT0=', '$2y$10$nKB.84/3G0vaXajJaSFl1uAmJeAJhcMHwkgQ9X03lwckXdIRiqZeK', 1, NULL, NULL, 1, 'GIZ9954331'),
('MOD2571656', 'MOD26924555698929252', 'choose', 'MOD31HIUR7XA8JZA8I', '', 'XlQgRJFB8VPM3/N1XExp62hqVElQaGMwb2xiYks5ZlpheDVORU52V3BUZmZCOWg2cldkRkZRQm5EWVBSNmp1aUlCVkUwNmx0VStITFFjVW5tS01EWTlMR1NjN3NKTkozZWxCRzlkYVFWWmJCaEJmZ3pIMVZ3elN0eE15cEZpTFg0ZHliOWZ5YWZocWM3Snl6', '$2y$10$8a7Qi96h2du7suX.3hGJs.IiG4zgy1qzM7r33OpwoViJYo6BBjWR6', 1, NULL, NULL, 1, 'GIZ9954331'),
('MOD2571656', 'MOD26924555698929252', 'choose', 'MOD31X3KJ1E7REYX8A', '', 'QlmrZ8U3cbUbXbLtcu05SmM1am0ybUo2NWVxQWhSSmhVQlFKd0FoYzVVOVVzUW9kREg2VGlNT0ZTWEhCSjZ4aXNWMXcxcmF2cXZSMDVxL1hSZ2x2SmZ1a200cUNraWpCeEs2M2JRPT0=', '$2y$10$qKox.uGCGOKqSXmNrm3/kO2NOEHpsYQG5tsXz1M6qYMHNx/AUyq4a', 1, NULL, NULL, 1, 'GIZ9954331'),
('MOD2571656', 'MOD26924555698929252', 'choose', 'MOD34K2R139X593ETM', '', 'I0W1LqdLloeSX9epCxaVZFdraEFqVitadVJITXh2bXdGK3NJdjJlQ0t2aWlJWmhhVHBCVXpQT3VWSEthdEp1NlhTODVGZW0wL0ZXeUtNN0cvTlRMWWhYSmNoTkdqRWhXZFQ3VG8rU1JCaklMWkhQQWRKWVJTTlFhQ0JIODF0ZDMrODdXemNOaFFDb3RqK25ia0xNeWlMTTBsTmhzRWVCRS9SZEN3Q1ZjL3czUlpVNTRCVmRhSFptZGROekVEYkluNVNBQU1RM1B4Qmk2MWVxOA==', '$2y$10$bypiWL0LG4Ysm5N0Ce0NOu37E7cclNwXLETAkFQB7wRgkhKfQsT/G', 1, NULL, NULL, 1, 'GIZ9954331'),
('MOD2571656', 'MOD26924555698929252', 'choose', 'MOD34O8ZGX24F29257', '', 'sMi2ziENO+Fx/ocu/ZRkeDR0TlJ4UVBUVTlJQ29zOXZLaGRIOVFFWXJyL1N3MStlQngxWjl5eHNYREZNRjRCT3RHdVhMY2Yvd2Q3K1JEelZ3V1BDUmMzVUtONWNVM1FjaC9wRm93PT0=', '$2y$10$5fpfC7zPZcmbzDxzrw/Ay.yhlb840FNaUjy8Yiz4BIRcW6HpZwR7W', 1, NULL, NULL, 1, 'GIZ9954331'),
('MOD2571656', 'MOD26924555698929252', 'choose', 'MOD34RL21RC217H28Y', '', 'XlUVD2KCk4+c8oixD1CohE05OTAxUmhEbmUrK1g2R04rQXhkeG1GcTRmQTVOL3F6ajdqbTdVK2tXL3M9', '$2y$10$VVK3WH0rXmbt99Dt7H.S/O.S6guSQNqrAMASz8Nezh7fcppwjY2Ru', 1, NULL, NULL, 1, 'GIZ9954331'),
('MOD2571656', 'MOD26924555698929252', 'choose', 'MOD392JY6WXK1ZU4ZZ', '', '8pL0R1qE/ow6f8nJyhO7QUF1bmNsNDdsOXAxU3IvWDhoVVN3QmNPVkNZdi93OWZUZkZnczBsNkJsTGs2N2JjNzkxMHJZN1pWSk5WTWR6TUxKMUIzeThDL1IvVlBQNUtKTWphSVZBPT0=', '$2y$10$EZufiDZWgNrfnQMbIg4hf.XTBhwQj2Td4NcDgjf1kE8GwoqgBwPDC', 1, NULL, NULL, 1, 'GIZ9954331'),
('MOD2571656', 'MOD26924555698929252', 'choose', 'MOD3JBC22WHJA7W9ZF', '', 'TryBZ7uzW/Cw9kiu0t5akFlNN09nR0JFdHJrU3R1UC9Jd1lnU3J5blJmYU9qWEpTeUxFZE41bnZEWWNwQWdpcXJ1V2tFcitSOXRpMktDK1VBNFVuQ2MzSmdqaE1DRDRwSXpOT2RRekY5bzRoaHlsK2ovS1plOU5UaTFwQ0pzVGVKUzk0dkdENyt2V0Q5b0trVnBNOGFWR0djSUgybmI4bDdpUVRtMlQ4V1pUN2lCdGZWcjBITWtLWUl2Yz0=', '$2y$10$ayW7TyXEh9ATbjAQsFx1Ce2ttYkcLEDeK5nluir4mnUIXc57gNwrS', 1, NULL, NULL, 1, 'GIZ9954331'),
('MOD2571656', 'MOD26924555698929252', 'choose', 'MOD3LKXFH3NM3X1191', '', 'jomnAF821JjZFpTs1RIhJ2I1TnpjUG9yVmVIbDBZRW5UaS9qWEl0ZmxxcktHYXQ3Y1ZVTVczREc0U0NZOUlSY1ZXTXVveXBBYUNMUk9SODlXVVJORlgyNW1uWnpCMFQvMWlPNytwaExvemo2bWNHUUcxL1l3RFV1c3Mwak9CcU8xaTVBckE0MGR5VjlvL2tQ', '$2y$10$BLfhc.73jr7XZM49v/6PeusU86CETD1eM.bnPXa.gmBFR9Ks5RgJW', 1, NULL, NULL, 1, 'GIZ9954331'),
('MOD2571656', 'MOD26924555698929252', 'choose', 'MOD3XGJK4FRAGU745E', '', 'HVsq2ILAJkXiP25obXxZiklUMnMyMTZKeGN2TkVFdDIyeVJRN3dmMXhOQktVYXdFZlVuUDVGdDA2UXEvY3lkSlhMbGprckJXZ1J1c0orbHVMT0EweTJnY1lnQXdBcUl4Q1A3aHJLVmpGZkU2cHBRczdYa0V4bmtTVGVQNWg1UmZDMityOW83RnNENG9TMkFOUURKTGt4QjNKOWswUWRRQndzUy9VMUxIRzE4REJyQ2dpbDlEdWU5YS9BbGswZ1pJVlVBUWpRMmhFT1g0NDBucG5Nd3FSY0o1amwwTEh3Ly95TUJFdzFETXduZk1CbUExMjFtd1ZSYTZSSzg9', '$2y$10$RwI8mqqSDp549zFC.Ux4GuAzCMFeKn14hCKZkFjEBrZFEQQAy.2EG', 1, NULL, NULL, 1, 'GIZ9954331'),
('MOD2571656', 'MOD26924555698929252', 'choose', 'MOD3YJUMI4U29GT8J8', '', 'gGH+M6/8c67cJTR9V73ssmhMZVcxZ2ZodUxqWWZENDNGeldmTkxxRGFBVVFVaW9XRUYrNm5McnR2OEVjd3NXTWR6RDMyZ3ltekxrWitFREdrQ3M3cUtBaGNLdUNjK3VkSkdZSjFMRCtNM1krNy8xTU9VTWduNmptT1M5UTkxbW1wT0wwSkZ4UjJ0Q0pzeWlxTGNIOS85NENHQ1Ivc1YweDVrVU4wdjZyNnBhZ0RtanRBNXN2TXkrV1BzeW5yWFgra0FzRlNEUEdmcHdrcDNKdg==', '$2y$10$bt.i1sf36jvKk6zPxhmAwu8wI3RCPAZ55Szq.g1.oqbUokH7KRNp.', 1, NULL, NULL, 1, 'GIZ9954331'),
('MOD2571656', 'MOD26924555698929252', 'choose', 'MOD3ZMIXW9U4I2BH3H', '', 'jZ8aOt6ZpC5d5QdjdYiWrUJDRFpmWk9CSUJENkozdGhJMTFnc2FoWWdWY0M1S3VMdysreTZPaFMvNTlzWG1WSEVRVy9LRDNib2dVZ1JCUU1HSHJ0VSs0b2RxMjk4M0tTRFJuSTlDc3lNYTBpczg3anlOaXJ3RWl3aUF3PQ==', '$2y$10$OtQsVISa4Zv1jyFx8d.zCOjgteq5AqSbp8DzM8hjWZEpoT/qfIayq', 1, NULL, NULL, 1, 'GIZ9954331'),
('MOD2571656', 'MOD26924555698929252', 'choose', 'MOD42BJ7M1B4U3H5HL', '', 'BIND1ywVJKTgxdPQzxN3zXo0NFBFS0VuTGdoSVdPN2RNMkF1RlFoWWg0dmduSlV6aHd0WGs4UkxiTURhTlNwZk9pMFo1TjJxZFYrYzhuVzRKTU9GVXk4S1VtTjh3WGU3NEE4ajRySzZ5em1OSWI0VzF0OXlWb2lLODB5NzExZ0lveDhqWEMrblg0Yjl1VFRP', '$2y$10$e9BL.lCfUyT7nsGM53wZYO4E.dPld3hMCHRrHP86BgPgknMlkMK36', 1, NULL, NULL, 1, 'GIZ9954331'),
('MOC2132939', 'MOD65383726273746144', 'choose', 'MOD4672429MHHE194I', '', '8VAi8NWgVOK+1lPdv4XUF3hJM05GWWZUTURGK1RYUXJpYXF3Y0NOU0g3U1Z3WEVyOXRVZVB5OTZhVWRVT1N2WHlESURNRFpkcGZSYUNpTU1FS2ZhZHhNZi9SSkM0V0NhSk9Hclp2a0dqRzNhNHd3QUlYbmFmMDNYM3NMMFBsdzZLcHVtc3h5blQ4TytWS202', '$2y$10$7Te31EahhYY76QJyI1tuveR7cYNAKqgAIa216cK9Z8gc50O6DbwMK', 1, NULL, NULL, 1, ''),
('MOD2571656', 'MOD26924555698929252', 'choose', 'MOD48XHGW1ATJ4U838', '', '/uK/8EmXTTUQHyb+nXxDk0FYaHZLUGpVNzZPOG5RTWVJdU9NczdnY1JveGVkcGxIVDlRYmg1VWhndlJrTFROeGdBSmEvQU5BSW1mV0tZcU93KzE1RVBMMldreVBEMW45RUplOURETFQ0dEQ2N045S0d3d2Mzd3ZsQlRKM1ZEd0p0aHhQaml4Rmt1dDMxSDM0aDVRNThZbFlIQm5FQS9SMHJ4cGxHdGQxSHhhQlN3cUdzQmpxRTZqNUV6MjliNjBHU3lqTHZIdXlyYnBKVEkvQjJPL3ByU2J5cXBOK2NieTdrTGZOa2tpMGJiUnA5bU9JNi8rbmhKNDZ1NHc9', '$2y$10$2.IQWgz7cJf0zaoQjQNBWeP2W5LgWn/wX7TXnOFjiWDFU4Cw9scKC', 1, NULL, NULL, 1, 'GIZ9954331'),
('MOC2132939', 'MOD65383726273746144', 'choose', 'MOD4AEMJ9EKRIJ7U3X', '', 'YlH9WI4s7PjT5cpSOoyYMS9zc0gwL0lYRG9kTTF5RXFOOE5UZWwzRkF3RTllVXEydDQ5aS80MjNuUWY1RFhDYmIzK1RpSHJhakJtczNCd1Q5MlhoSHl3YVBORC9nTFJsbnIvZkpPWm1JY0hwRCtRNlM4QlJYSEwybHB3QWsyczZXMGxrcmtJdTh2WFRPUlNVRTlKOTJlMmhyR2FLdUs3ZVZjUUJPcnhTc2s4UkFrVzRqeUJZaW5BcE8zVT0=', '$2y$10$QHJPtkAxaPsEcPms79IP9OZzFPoM5h9wOeGYavwIw1LaeK1li8BFe', 1, NULL, NULL, 1, ''),
('MOD2571656', 'MOD26924555698929252', 'choose', 'MOD4FAZYKBL8MB3J5J', '', '6P5Fkp4NoBNmm5ar5KzWtGI3VTcrYTNQZUg4Q3ZxcndqSklVUzBhNnAydVZlcjhFQ2REeDU3WjJicFBIYStRZjNUYUk3UWZpRmdJZnF2M3kzbWt3Y2lZUVRvUS9kYjBra3ljaUFNbDZnZkxXdXYyZ2FHakdSZHpMUkJ3dy9IeWkvd09Na0Y3aUFib2YybmEvdW1kOFZEa0VYL3RGOXdHMVJqK0YyWUxBY3dMdE5BSjl4SHhoWlhzNXZrMD0=', '$2y$10$cwH1B.HHuKcNAg3UePIg2u7FN4kSM5otgDcTpp/fZENOUoy/ZB98.', 1, NULL, NULL, 1, 'GIZ9954331'),
('MOD2571656', 'MOD26924555698929252', 'choose', 'MOD4G8OBELHH4U5218', '', 'BBXlU5gFVNsWyvG+lS4QDlJOdWF4ZmVjSjR1SlZ0RWR5ejZoenladFJPTWdQbDZpVWM1U0EvcXc1WDI0Rk5tTE9NYkp3ZEZiRWNIbXpmd0Rib0xmaU5tRjU1SUdmVnZpT3ZaUzBvdVk0UElPVDhNcnVGWmNuam9FVTlnaFI3cVZhSXBSK29GQnRuWEVHbVZ2', '$2y$10$HQlwi28xG2BFQR1vY5aKUOdMPs9J0WXqr64udoShNeXvB0ZdysN4a', 1, NULL, NULL, 1, 'GIZ9954331'),
('MOD2571656', 'MOD26924555698929252', 'choose', 'MOD4H5K42ZU2OYIF1F', '', '0cHAaJFOw1Ki+tXnVIqolXo3eXlacGFsQWY1RnBDRmZSazF6dkNpeElubHA5QnR1bVlqdmlRVjlUcEsrYVcwUW5URTMzNUM3ZzRzVGpsK1dnRWZJTzZOSkR6UUQ4RzhyNG5uUkw1c3Mvd1A4RzVqenlUU1o0ZTgzd3RrPQ==', '$2y$10$wb7iIxr6vQjG76d3d4J53esv0PZ3vUrsjTLifkv1nYouSg5muzcgu', 1, NULL, NULL, 1, 'GIZ9954331'),
('MOD2571656', 'MOD26924555698929252', 'choose', 'MOD4L243ET1J2FJE7F', '', 'clLpWUvtHvpWX4BYQL3Od3B4elh4NXRKcjdvQVZWV2ZDdzJLQkJmSkVhOEM2eDRnYU5RZW5iUkROWG9nRkxxUmppSXFuakxUS2cralY3aXZqUXJyM0ptYjhVYUJ3K2trNEQ3Q2s3ZjJDbCt4elpjdkpOYnRhdll2bndmdDYxakpJYmlqb2pqU3BlSzZ3bVBW', '$2y$10$4mejsCWuaUTnhZbqTqw6D.oncfWMzjJ2tlcnhuASu5WyNpsjQ2Xta', 1, NULL, NULL, 1, 'GIZ9954331'),
('MOC2132939', 'MOD65383726273746144', 'choose', 'MOD4N2RTG8YAJXE2HX', '', 'lQMkRdKpdfrm75hZxNL/q1N4Qkdldjk3MlU2MFVsRHFLYVBzcExCWms3SVljZFpIOCtFVXRBTzVrTzRnWjJqQURTbWlBN3JST2U3ZkhYNmMraHBqSjVYeklpeHdienNLMWRramRLakFYY2ltcWI0dHR5SXpPQ3VjY0pnPQ==', '$2y$10$Jw2Jo9C78zldHCr7aZ98MuQTyjADye0OZOV09RcxPfkFHZeGOvlUa', 1, NULL, NULL, 1, ''),
('MOD2571656', 'MOD26924555698929252', 'choose', 'MOD4N4H27X28H7T95O', '', '41GFZHNDpo2T2UYwIn1kpEZtMHY3UjQreU5Fb2k2MU8xNHVzV3lhL2pOUGxlOG5iWHlGYnZwTXdEeTY5Ymc3ZSt2TEQxWnVWNEEzM2xDajlGWjF1MExzVTVuNUlnV2hud2dxbmdnPT0=', '$2y$10$N64lE6Ht/uYvTYmOizTRqu1Itn5sRGtlBva5i11VUoSaYDpqKFiDS', 1, NULL, NULL, 1, 'GIZ9954331'),
('MOC2132939', 'MOD65383726273746144', 'choose', 'MOD4OMI54CEB2XX8H9', '', 'Yzfy71CQ4me4TSupQkCP2nhMRG5JR3FReHF1Wlhha0Rqd2NZNkVIVHRubVluZWpRQjhiM0hRY0tUekVWcVhnNXZjVWlyOGZTeisxNnpjenFPQWFFMkJmeTZJeFRsZVBueEZmOXpRPT0=', '$2y$10$CDzsM8Y.ai3hV8ZZcWKAredCDcwcMoA96wV9y3K7LBktvL2n/NonW', 1, NULL, NULL, 1, ''),
('MOD2571656', 'MOD26924555698929252', 'choose', 'MOD4TALCH7823J4W27', '', 'F0vPO6ptY1eDvByC2HO2snBXTWgwTnRkUHVzTGkrZ04zWWhWNVJFZ0VrNk9ycWpyTjdvNFdobUgwZ3laMi9jWUpNU1c4WkpuV09OY3Q0K1VsRjg3VVpXMHduYW1KSDI0VEZQMFVETVU5bnNjVlNIM2ZnRlRrYUVlVDREbDVvN2hIODgxUTlYekNTNEUweHcwUU5PcGNjekN3aTVKWDFjeW00NDByQT09', '$2y$10$EBjwdnpA4yK7AhZVzfl54ejb.Knq8eOFgrpiH3hfNiYpIVaR5AZOC', 1, NULL, NULL, 1, 'GIZ9954331'),
('MOD2571656', 'MOD26924555698929252', 'choose', 'MOD4TEMG14IE9815J1', '', 'KzcsWeH1zkMEgMKTt9BOJXZNK3ZWUWw0L0dTdld1Mm9yaFNuQ1QwbGdlUEtCbndnZXhiZFlUcjVySE5adytHNDZxY25VbUtPdnhBajBkYXRCUU1RWnErN2ZjZXlEYlh1Zk9wbGwwd2JFTUpGZXR3Z0JESGNVQTJqcGlZPQ==', '$2y$10$1EzikMKNhwmi9f7Y9PdDdOAVX/5/o0lYSqAE1uPII2fk7Qc5NCC0W', 1, NULL, NULL, 1, 'GIZ9954331'),
('MOD2571656', 'MOD26924555698929252', 'choose', 'MOD4W3Z8BZ71XE9399', '', 'BLDa9pEQUYS06jhGKqTYQlN0a2VHeTVrRGRzNXVzbGtBa1E1cEVHckt5aDFrOE5DV2FNbXcwU3RIaVE9', '$2y$10$ZaSZHBd4NjbpCCapeWmAeur4Di1rWFSmxluBN7Y/wrqMddwNU1MYS', 1, NULL, NULL, 1, 'GIZ9954331'),
('MOC2132939', 'MOD65383726273746144', 'choose', 'MOD4ZJ1OOHW873NLUJ', '', 'ZA98skQ/4gviTvb9p/uuvFE5cWcyc2toT29aVUpUN0F4TWR2MFNXdEhvQWkvNTVvRmFEYmdYRTl0Ulk9', '$2y$10$nT5WkcrSpkleKDXLo2iEtOGYMKS9FyYsGQg2YLkZ0sLS9ht.F8qPu', 1, NULL, NULL, 1, ''),
('MOD2571656', 'MOD26924555698929252', 'choose', 'MOD597X5ZJ8X43GZLA', '', 'kNWFhIf7TogQR2BV5U1oeDJlREp2U2RwRlk4aDEzdldINnVMbmo5eVZNZTFBTFhWYlRQaWliNlpCOC91NjJZVkJhVmhHSEZGd1NtS1FhZ1Y=', '$2y$10$1yG9Go16sR1d8d7wVImMm.OvTuf3YwhcekRIDxVUcFmmCnGgxsab.', 1, NULL, NULL, 1, 'GIZ9954331'),
('MOD2571656', 'MOD26924555698929252', 'choose', 'MOD5M8FN2T2THH3EL2', '', 'zLIX9Z+7FTQqSx+1kQbVim04NHdhZlJKM0NqNWVvNy9zdGg4WjB0RXk1WEppSGZlZjJJdU55eEpDS0NuVjUrQlpUR20yc0htQVZVRnp1SkQ4OXpaaDNwREVTMTVjMEJoUUFCcE5XTWFoVTRhRlBMUEJPTHNwNDQzTGtjVHkrQktuZlNKY2E0NGRCdWNGb3k0UUZ0eWcvWExYMCtDY0hCQXd0dUl3Zz09', '$2y$10$g3zdC/FL278DVDcCPtQv3u/BOEjtkHsw7UrVbWbADn0yB5KM10VGC', 1, NULL, NULL, 1, 'GIZ9954331'),
('MOD2571656', 'MOD26924555698929252', 'choose', 'MOD5N283JE46BXG4HF', '', '2a7f2+U9K0BqAL8TvtpoH2t3TXRYOUFuRGZRUktxWllkbnJVTzRGd2pZdWJzMVF6cjBGckpmaU13V05RZFJVd1E5R3dlWHR3emtnSDEzMEZMOWtYZ3JldklPcll2SGxPZlRZOWw4QW9GSkhHSDIyQTVVa0FuUXFsSkp1aHpGcmxVc050cDh2Z2t2Y1BqRFlr', '$2y$10$tz8R0MNdBqQrX8ecQgy7lefDw4iWJDU7C0P55DCN0AgCI7UMcyOzC', 1, NULL, NULL, 1, 'GIZ9954331'),
('MOD2571656', 'MOD84981219413119185', 'choose', 'MOD66KAEHR5E1L4L2I', '', 'pUI/UXgsMX7BGA5KaqmSRVZlVGZHNHFVbGVtdDV6MXZnRldMbmc9PQ==', '$2y$10$QbBlIJwudtOAyVZVUw.2GepGlWUmp/iI72tM42N5nBRLJ52eEJez2', 1, NULL, NULL, 1, ''),
('MOC2132939', 'MOD65383726273746144', 'choose', 'MOD6CGOAHEWTJ13T9M', '', 'BlF8h0C8kcvli7I36C+djVFtK20vV2RHQ0hRR2VTQUZEWktjblR3cWNQaUpMKzROOVUyN05zYlZRR1U9', '$2y$10$us5w3iEl1ZzRlrktjnQ43uGu6NsgzOnGWjIZ9hpkqqAv0QHPAa3eW', 1, NULL, NULL, 1, ''),
('MOD2571656', 'MOD26924555698929252', 'choose', 'MOD71HHX1UI8L2FL84', '', '47Bk7OkcuxjaXxmA8Ez9VndyaE5ZczZmT1JkTXZmVUp2UTZoMjh5MVNYMzBBWGNEZW5kUEhGeTlhV2UvS1B5dzhDMkx0dktlamtrakJ4eEpJZHZFemx1SlZyaE5TQ3djVHlwLzRBPT0=', '$2y$10$A7NqOEvBZT8gHuQ2PO89auOHITqhcMUKSD81B2IZbG1YEAHKCIhJG', 1, NULL, NULL, 1, 'GIZ9954331'),
('MOD2571656', 'MOD26924555698929252', 'choose', 'MOD72N2FHGL7437X6M', '', 'KsDRpjgE1NLM6xSjwETVJ3MzL050T2tMUG5GRlR0MW00a0JYT1hhTnRqbkY0elhFWWRBR0N1WjBCZWhWbDMxSTh2U3pWR0RwMmo4am9id3pQaStsRklvb0dQQzkrNkY5bWRTY2FnPT0=', '$2y$10$mMr.V/fREoKXX/qCwp75WeOYVHHic51q6FWRSibEURGkFtXOpjTN.', 1, NULL, NULL, 1, 'GIZ9954331'),
('MOD2571656', 'MOD26924555698929252', 'choose', 'MOD742Y1NMU2N82OZ8', '', 'ibMj7NkZtR4E6792QzvwZEpiN3h4ZFJkaTY2SjBaT0dDRXo1R3dhbWJuUWpiM2hRc01uaHU3MktKdElENWlIdTZBWEV2b2FjODZtS0FMVmZqUWVORnFTcUhVUW9SU29xUEdnY2lXeDI4TVBma2l5NkJJQ1RzMU1KMEg1QWRBbndEUFZhWlhxL3YwVStDVXNCYXI5Z3YwSGxCSWhDZlZoQ3BkQ3VsWm9nU2xSZGxYdzhURmNtbW4zMkxJQS9QYjlnVWhjY2Z6bXV6TDAzN1o5Wg==', '$2y$10$L3XPsUgxZ93pp4csolbaFe3/CdtgM/7mG2E3TM59QKp9g2rWphU1a', 1, NULL, NULL, 1, 'GIZ9954331'),
('MOC2132939', 'MOD65383726273746144', 'choose', 'MOD77B2G9FJA42CZE8', '', 'v9UYsO5t5oHWsXaG2OZqmW13b2l6WWN4elpCQzlHRU0zVUJvZlZpUThUTTlFWU9ZL0ZWTXBJdkNnSjA9', '$2y$10$wrJ50IPvCC8I418oPQBk/.UiSLERTrkcjIRATaFXbWrShpucHUBPG', 1, NULL, NULL, 1, ''),
('MOD2571656', 'MOD26924555698929252', 'choose', 'MOD79E9MMA698XFXW8', '', 'W0KWQeObmh3ovJy7DbyOIXVvMEtTSkFXSGdhbWxGbkhLcDY3cEhwTlB1eUQ1bVZhZHRobHhCZUF3aTdhcVBLTHM5Q0Y0bXZIQ0N0VWhrd2VyNGFkQmd2Z3c3aTFzSVovSnlhK09nPT0=', '$2y$10$VziQ.fvzcD2WMUFY4DpnQOWBB9nhwZLyogqiC64oMaBnJgSMlHeQ.', 1, NULL, NULL, 1, 'GIZ9954331'),
('MOC2132939', 'MOD65383726273746144', 'choose', 'MOD7JG53CGM2THXRUE', '', 'uh6Q9LBEkFEC8Uh4wcSnl3Q5cldUQnlBbkZOdU56b1hVakZXZWtZKzliWm5uRk1yL2NzeTNJanMzOFZrL2VoNHdnQzBzUnRGZUt0K2p6UlFPR3liS2xBcml2SUkrRnY0bENsajk5WE1HblhrQTh1bTV6SG5LOE1hWlRMdHREdGgxUEcveUdBTWQ1Q0Y2aGxwNVByRzNtOHVwN3R5S0x3dXJRVVNBdk53OStwWUNnZWNPYlEwSG5TZTJHQmdId3BlOXR6OGtFU25TQ3ZpdkJVbXp3Rkt4b0NQM1pYQXNkMG1zRmxzeHc9PQ==', '$2y$10$yPQySCJFWj628gwpgsaKgeyd.gqkYgvSkv8awS2Rr0tL4x3p7c2ZS', 1, NULL, NULL, 1, ''),
('MOD2571656', 'MOD26924555698929252', 'choose', 'MOD7R25HG21OH2X4UG', '', 'jIwrrTv/GsxN8RZpl3QKYlh2NkFibGNocjYxa2ZRUi8wODB2aWVHQ1pEbjljSnNJVkpDeVN0ZUhiZjQ4RC9EMnd4c0laeHpqWDQxM29mMngwZlA1R0FvUTFQdnpnRDdEYW96M0NOTDF3YjEyYmZCeXlISnYwREsybjlvPQ==', '$2y$10$Gt6VS2KzVapLcb2BxhXUpu6MZr7s643vhODfLE3EnZZrdNZRNrv.e', 1, NULL, NULL, 1, 'GIZ9954331'),
('MOC2132939', 'MOD65383726273746144', 'choose', 'MOD7XK6CWJA442LO6G', '', '/H9J7fbDtbfkQh0VoBY3M2tXenRRNzJneEd5cmxWSEt4Rm1aNlZCR0pZbDFobk9BczdPbEgycnJUYkY0R2sxeGhwd2pnVFA1eXI0cTBUREtBcWlpOHVrNjZjdVlvdkhwZWJoTEJTSE4wb2xHVURPdjErN1pOaHFGMG15WkpESjB4S1RCZm10YnM3SnAzeUcv', '$2y$10$HR3palcX9Jo96MiZOXQoau14uWwZj2EnHlkuno9wWr5ZRiGH2XdZq', 1, NULL, NULL, 1, ''),
('MOD2571656', 'MOD26924555698929252', 'choose', 'MOD7YYO4314YCXT2L3', '', '7LjgFtU1uVO+AyS4w1twPFdvTnFncDRLaWhZWHdpZWV5M3U1MzFWbVdUOWdja1pza0NRSHpwRWlYNk5LK0htWlRLVWZTL2o3TUxseDdHbEZoSHkwb1dLOFdCOEdJVUo1dVhMeGxRPT0=', '$2y$10$XS36zG9GeyFVXV2W/tGeb..16uBpz215HabpCk.f3.PoG63YNMiya', 1, NULL, NULL, 1, 'GIZ9954331'),
('MOD2571656', 'MOD26924555698929252', 'choose', 'MOD7ZBH9JF896781EG', '', '1muaakUHBO3zpUE4aZwMBlROMDdzb1pzeVFJM1lFZHZWeHhPY2twOWYwOElGSFdEQ0NaYlpXNTh0dXVsZ0Z0TUppTWY2S3c1ZVhzcWl0aHRDQzdQSEpDOGY1WnlYQ0tHMG1SYnhaR3ptZVZKWS81eGdiS1ZEOXMwanJnPQ==', '$2y$10$PrFIhM9xKQYR4v8gWE33t.nlvusmmPCWOL8j84n5vagpeWvs4F6zW', 1, NULL, NULL, 1, 'GIZ9954331'),
('MOD2571656', 'MOD26924555698929252', 'choose', 'MOD824AJCMFEJAJ3A7', '', 'f03zy7FHh0ROmL6Xp8l5xUZ4YStKY2pRZ0JsaXE2dzh1WGRyU3krYVlYZ2JkRmdyc1B4Z3lmOXRWb1N5SVlZRFNUc2JXcUFKcVJwaDArK0JhdUZTL0g2ZmdTU3BEYis3d1BzQm9xRDZzenRJUjJmbU5zanR3c0N5Uzd1S1FGKzNYckV0K2VyWGpDcjZIMmFK', '$2y$10$Fdckijta4TpGSVpY49d1DOE7fBrgxGSqj085Z/m8DgGVKcd3HdiUK', 1, NULL, NULL, 1, 'GIZ9954331'),
('MOD2571656', 'MOD26924555698929252', 'choose', 'MOD89GY7G2H7G4BK12', '', '/sg27BjoJTLFzQ7/nvDfFGRhS0JwcmhtR3dLUjRrbzR1V0hScnlqYWJqT1EvSktzdU5rMVNsN0d6UFNOUkFidDdEM3J2R09jQnVFWjJOTGZLZ3kvenhHRXp1ZmZnc1REVE41Y0FmcURkRm9MYkdOVm5BNXk4NllqYzhRPQ==', '$2y$10$hb866mhX2S.KmGQxaEwSXeFN7k95lFJ5GGyO2KkRlHJPZTR6ed8me', 1, NULL, NULL, 1, 'GIZ9954331'),
('MOD2571656', 'MOD26924555698929252', 'choose', 'MOD8BRGW8LIMOT39HH', '', 'BQEkYDHwsxRyTv+buPjOI0FyaXhLV1lXQS8ySThBb1pFb2FDSWEvTGFUTU5DL0ZHc01vNFRYbmhHTHRHSmxUT0lXenJmTXM4bEhKUDNHWHNGalFZaVhXNkloUDUyL1Y2ZGdiVnhNNGcrL0FRTWtlU3Irb3BTMm5lOG53PQ==', '$2y$10$lc8YR3bxHC2nJ7WLnWBr1.XzfEh2w9wGBq8an/zKL6DgjoqEd.2nO', 1, NULL, NULL, 1, 'GIZ9954331'),
('MOD2571656', 'MOD26924555698929252', 'choose', 'MOD8EMX21U9FX48WXJ', '', 'qSfBRS2uto4Vwz9LD8U2rTZIcnJOVEU0dDlHWGR4bGZJbGNjOFlJK3hzYjhiRlo3ekppQlhGSi8yTWpkWkorbC8waGRkVElhcHc4dUQ4ekRqcjFjMkFSaDJXbWRYRXhmTTJTZG0wR0Q4U0xFMnByUnF5aU5hWGNzYUlFPQ==', '$2y$10$mXdJYYCCWhkun/zrR0kHUu0qOts1Bjnl44Tgj5gspJHqt0PoyWoMu', 1, NULL, NULL, 1, 'GIZ9954331'),
('MOD2571656', 'MOD26924555698929252', 'choose', 'MOD8HF975Y2NA2ZZHG', '', 'xb1jP0PdW1SrYRv+NuZjWnZ6dmpjNXdpdVZkZzdPaWE0dTdMVTNSMjZoODdsRG90T3N4SFpINUJrTFdoZ1ZOQ0xyZFo2d3dkVktGNjkraU8zTW14L1lFTGFEWlRSTWQ1OGZ1QjdZbFlxZnRqRmN0Z3QyUEE5cFlQaFUySnBMc3pDN05aLzdmQkZmb2czTmsr', '$2y$10$CCLyVnIQnBGu.pQeYmHlROuq8iTFHfxyEJf5r.5wSBay1wIUnwxU.', 1, NULL, NULL, 1, 'GIZ9954331'),
('MOD2571656', 'MOD26924555698929252', 'choose', 'MOD8W9J82X32H242ZE', '', 'yszalihPBRJKYnQrU9gqSmx6bzBKelpPRGFuUExYRE1RSEgyVzJTRHIwT0xqTzhTSUtycXdpcmxCeFhrdGR3Y3loMXhuRGpFbjdzUXd5RnRUQXcxSkwrRkhSOVJ5Z1dnNEJpcWhBPT0=', '$2y$10$9gh5x05hvGjngXGVjtAiue82wMwfWkkRYwe31vSm7xABYLhUf5FhO', 1, NULL, NULL, 1, 'GIZ9954331'),
('MOD2571656', 'MOD26924555698929252', 'choose', 'MOD8XM41G22BEWC3RO', '', 'Ai4HBz840Uy6dxNAmP2oW1BjZUw4MU4xNVRtR0ZjbVBISVdtajVDSnprdWdoai94RjRkYkVSd29POFZUbjk0bmVJbkJ3c1k2UVRxQW8waXpVeHN1NlA3cWpOZDZ4dzdOK0lTOGE0TDZNNEFDa0JkVDh2b2tuZnB6V1hOdUhOZGw0Z0NhQTloS3RXWkNoY3piYlhuVW1JUWFxMk5Hd2JPckNRbnY5Zz09', '$2y$10$92XiyRlYdNncRJA5JTrdK.xNOafa.txT28BxLheRSK.fgzr.HdZLq', 1, NULL, NULL, 1, 'GIZ9954331'),
('MOD2571656', 'MOD26924555698929252', 'choose', 'MOD92TI92M6X3I83A3', '', 'as3Bstd9Yr0lytVg9RRO92RVcU1NNDBlTFBEY3ZPNFBoOTBoTitUdkpoTDFTSnBvcU1SWFR3aW14bmZLVWh0K3hIZ3hNYXpOYTJCVW9CelN4Y0ozQ3ovRzJ3clpCc1FLMkZicVRBPT0=', '$2y$10$wRtdxM2ePuQ4r33ZPblgau.XDZt50wcWA4hi8W61U2ILJIF653MjG', 1, NULL, NULL, 1, 'GIZ9954331'),
('MOC2132939', 'MOD65383726273746144', 'choose', 'MOD97EXHE8T89BY992', '', 'VIumu9yi0EALrxiZE3IllDUxbmQ3REF6bnZZYzdIRHRWVW0xbzUxeUMxcmxyQjFmSWxWT3Jhc0I5a2h1UCs5VDVSdUdNTXNMOWJMcjQ1OWg0YkRyQ01aQVUvc0FqdkJwVTVia3JRPT0=', '$2y$10$SM8AYVTItqhesig4Veu5aOD2c4kHM/bbR/HDgaZTx.9EFPFF91rfe', 1, NULL, NULL, 1, ''),
('MOD2571656', 'MOD26924555698929252', 'choose', 'MOD9842L9JX42448WA', '', '5ughE+pWoyi35RZZrISbcTFNcm0zazNBbGtabCttM1VpK2pXd3B4VlM0Y1BJdG1hV2VPRTZhMFlSblZMK0plRUwwakkyRU8vZFNEUVFHWnN3NURLanVkWnBnNDhlVzR2ZWxrYTB3PT0=', '$2y$10$GeqNWP79z6R7hccfhMr8N.EG4L6MKvqci2d8uChvNlG6AHXWDmnhe', 1, NULL, NULL, 1, 'GIZ9954331'),
('MOD2571656', 'MOD26924555698929252', 'choose', 'MOD9R23I9Y248W7ZJH', '', 'lOleCruPwraOs0a9R4m/iXorMTNzS2FleWdKRDNIWHJKekllU0JCSi80eWpzYi9PVyt5N2EwV0dya0YyWjIvbVVidWtRd2JRd3pscFNJTHhsWXVrMUdqdDhHZFZWSnQxdzhQQjlBPT0=', '$2y$10$ga1TmSilIoEDPkDMNmVNV.aqDvNWb.5gAwHNavd2Fx86Or6o/yJ0W', 1, NULL, NULL, 1, 'GIZ9954331'),
('MOD2571656', 'MOD26924555698929252', 'choose', 'MOD9YCH8R2ZLX79HT4', '', 'lo/fNH2LajbwrKov5dm39zUwZ0Ryb3daOUN6SmJNUlNhbHNGTXdQUkpsTFgvRFBUcHJUOTVQTU94N3pJVWRkcG1RZ0duV3BQa2thVTVmbGxNL2hQQ25RQTEvODJ2RUFFQUVvSnh3PT0=', '$2y$10$bFIw1wCSRnUXtEBj3s3yRuYwwWP/jA6ZP4HcKD0w9u/oVLjjjpptS', 1, NULL, NULL, 1, 'GIZ9954331'),
('MOD2571656', 'MOD26924555698929252', 'choose', 'MODA5YT1HB8JZ2X2XX', '', '76XRYbBZ9I/VYa+cDGd/FUR1dmEvejZTaE81QWJQU2EvQmtVWEQwWWc3eTRaRVBrT2RTZXpTZHJSOFYwZVJxUGRKbTcrU2JTVktEbEtjQVFsZVZPTXNUU1lQcGxCN2dyWEtTbksxdWR6WDNJZDdIaG9WUWhaYVgrS1dZbnVMY1N5eGRueDUzWDhKS3RWR1pOdkFxeE9oZU93RmxLbVJTanZrTmJIVUNVNWM2L1B2b3U1Tm5MYmFGSEV6d1pJb2pQZEUxSThDZVdFWEpPZHJ1TQ==', '$2y$10$otEZiij6ru4eNCMD0VNOzejHw3Yq17egZc1PyDh9Ek4TcX1dqNVY2', 1, NULL, NULL, 1, 'GIZ9954331'),
('MOD2571656', 'MOD26924555698929252', 'choose', 'MODA8EE2Z2OHT23HRA', '', 'cNSCeOxIsOLA7GoZF42LkzdlU2QwSjZxRzBZcVBDcVpKNUg1b1YxSHBDbVZFRmpJY20zS3ZFY0loK3hYMEQ4MkZkKzltalZEb2R1ZGg1OTJ3MFZDSWNLbHZVMVMySU5mT0hEWEtJYU1KT3RaaHE3RDZKZUlkUDFpdG9XQUdJM215aWFkWDFGRzNaNzh3QzNvNDZ3eldQenU4czhxMUl2Q2lJWThZeE5OMlZ2a0tjUmFyeVFBbTdza213WT0=', '$2y$10$CoE9IlxWXXS2PrkSPUIFFeKba8EZ3qhdx/cEKfldfio7np1phhfW6', 1, NULL, NULL, 1, 'GIZ9954331'),
('MOD2571656', 'MOD26924555698929252', 'choose', 'MODA94NWEC7I27LMI5', '', '+CrhFCF0tvbD19l5bE4aAzVCb0Z0YnVQQitEUVk3dUhrWTVYcVlNRVcrZlhucmpkdDJrbEtYOEQ4MUMyMEcxcFFhK0JJYlI2R05hOGVub1FIRFJvRzZ1NzNvU1RMQ3hEWWhPZEl3PT0=', '$2y$10$SQJL3bsGwo08BpAPJBqsO.R.2jQU.73hrcfpsIMPCvuzQyJaC75Uq', 1, NULL, NULL, 1, 'GIZ9954331'),
('MOD2571656', 'MOD26924555698929252', 'choose', 'MODBF7T23679434C76', '', 'bMkJOPOUHjXhM/oN3FkEwEYxaWI5ZFVqMHdpamxybTVWNVN5Tnd3UkV6cVYzaDRISGZzM096bjdHbjFJZVdKcUNQVUFKRGVmcG1vSG9TOVRqZ1JmaWNIZ2NYYkdNVlFURnJBYUZhZkp5YzhBVWdwOGxoRGhvMVdvTGtuRDkybTZzY21NVmt5Qmt2Z080bjBvK1hiVHhFZHZ2eEZSNFczQVdBclZ1cXdtYVROS2pYSm5SQldwa1kyRmEwL2VHeHlsR2ViOVlMN2UzZDdRVEp4SDNXWTZjQURRcDRBZTY3d3p2N01IczZuaW1OV1ZVL1dtQ09GeWRnWTRKWHQydlNqTDMwdGJuekFYNjVkL3RkUnJnKzZNRjlrK0psdjFoODlGTVFRUURQS2RJdDFRa29ZUHdEK1VsbEZVUTJkMzEwMS9LcXdZNW40V1JpMFZDMFQzY3NYZWRZMzB3NUtTY2t2QnlTZGVXREdLaWphbVU5RW9ScHQxTjZXbFU4Vi9FZXRaWFZoWW4zWWlLT0IzbmpsSFM2UVVVcHR4ZzdwR2hTMXdRRjU1UDFIbXkyZ1dNVzd5Z2wrT3RoL1N2U3kyTVBsbmxpanRDSGxjK0lrVVpiNEJ0VmpONFdYVDllYmh2QUI3ZkR4a0dKUWt0b1ZQR1VKb0R2WkFITEZVOEg4PQ==', '$2y$10$q2j/yIdJVCHuURihqbVt9.ZUN5JBnK/HazoqF4xRp.aOcLjL5J3AC', 1, NULL, NULL, 1, 'GIZ9954331'),
('MOD2571656', 'MOD84981219413119185', 'choose', 'MODCTHT3CO41XMJX9G', 'MOD84981219413119185MODCTHT3CO41XMJX9G.PNG', '/jaG3UkTyqwrx9ghS49hWW00aW15UjRVQU5NRG15OFVFdzFGOWNBL0VkbExsY1FlR3ZvdmxvUDI2S2s9', '$2y$10$tr/kOJxgc9bXwnq.mtaPKu3foWI3RsX9amcetCkYsemklAGZ6fiDe', 1, NULL, NULL, 1, ''),
('MOD2571656', 'MOD26924555698929252', 'choose', 'MODE3G218ZWE51CK7T', '', '+ka9XxXrF5QPxSbjeOJPp1ExLy9mYU9HbGVNdzBLOVVyQTRleGhrcUg1R3BVMVNJOHF2SjYvTUVWQU5sYjlRWVFCbW1aK1N2Ukg3TlZFUlgwZUZvMzR4Z0pwSkZPdnJ4N0FKSWRaakJNMkVkTXVYSmNFa3E3cTJSdEc0PQ==', '$2y$10$zRyOC1WPpBNg4WSCo9gLz.p3KBZd/dKmaIErdgYAYk5PYzs8fTAaS', 1, NULL, NULL, 1, 'GIZ9954331'),
('MOD2571656', 'MOD26924555698929252', 'choose', 'MODE44H2ZZOFH8WEMN', '', 'WWmZZbR2oTW6FOPaAMPv13ErSCtyK2xhQTljaDIrbmo4b2Y1b0xWL1VvazVEanVzV2lMZFlNeUZJL0RRUjNpbzVnZVl4MXZlcHlHWUE2VmNDRHVqWmpqVk5jVnhiNUlXTzc4Y0NacHZ2NnhlU0VsQzZteWY3N1VaV29CVThBaXhYSTZZTVR4cm5wVWR1WVdHdzlxYzZTdkw5M2V0L3ZNcVl5YXRBNHUwcGt4aVo4VFIycThHb3dGa045dDlPNHl3WEY0ODRzQk9jVjNIV0k1MnpuMVNrNHJ0Zy94TnVTNHhKMlRVYXc9PQ==', '$2y$10$gJaDI7.ZLLGYY9VXSosLjOlCaIeQ4y0TSgvVGcJ4hbISb2JkrScmK', 1, NULL, NULL, 1, 'GIZ9954331'),
('MOD2571656', 'MOD26924555698929252', 'choose', 'MODE88OG1Y733UJ9G2', '', 'k1f9v7v3VBVKjbNV/8U27XlmUWZVSlI4VHd1YkdzZk9pWTlaWXI0cFIvOWZuRW1FdFVQcWE4NG92R3VNcEdQUGZNY3NkT0UxZnY5eUNDQzgwMVVidzV2NkdDS0NvbGVIUGxSb2tEYmNlSVhqUWFqRmxXWlpsZXhPdCt3PQ==', '$2y$10$EWjy.Ehg7aO63O6GJC4hvujjnpmnGup3RCTnGp.0r/vDo.Q4HUYOC', 1, NULL, NULL, 1, 'GIZ9954331'),
('MOC2132939', 'MOD65383726273746144', 'choose', 'MODE9L7U51GXCK8X2M', '', 'e3PJ0YV5kzUJG47zGywMTGs4RWN0VmJtNFEvOEovQWNEZloyTEljcmk5L0oxWFI4U2JNQXhqNWZPdlhQOFN4ZjhMV3Z0R1BIYVZlT1BHNDE1czcxYTNtUWxzZUtDYmVmeXBwV2x6eDRWS0JmbFI0b2I2RUJ6d05mMUFEdW5PYk9ib0tiVDN5bTJRck94VjE2MjRQOWMzNjhDeTBFbjRQNEFjVlZjTVJnV1NJTnVOcXJBMWdQeWhnb25EVT0=', '$2y$10$B3eqyi8KvOvThvIjHKZgN.GsVX0FbKu0.xDD.dWStZx3X/gj8jGau', 1, NULL, NULL, 1, ''),
('MOD2571656', 'MOD26924555698929252', 'choose', 'MODEAJ31W8E347UCM2', '', 'CoHpdwdsu8O14ZO9cXftOEsyZ3hPWHBhSVZ4WE5pYnk4RkVhYXBLUDNHTlpVSnVZQWdGYVZya3Z2TXRwSUM1aUMzc2UwS3l3S3BEMm5DcE8rTFRUMVAwUDFUVVdVUkhiaVJlMW4yeXZ0Y3g3UGsvRmJCQ3FwNjRxOE44PQ==', '$2y$10$/sOTZbV8FoS7uEjxDyWeP.ZXPWRNwBynDTzajKvOw70X699IEiAYy', 1, NULL, NULL, 1, 'GIZ9954331'),
('MOD2571656', 'MOD26924555698929252', 'choose', 'MODEHY62YXUG5Y3E17', '', '8GNKCUhBzRZMhA5pDoPp8VpwbW9MLzIvOGFSQ1JBbHR3ZG9panNaNEFsaDBQbzNVc0R5d2dTUTkrUWtnbnFZeW1zSWdJMHBqQTBWd210d00ydkdZRjZqWWxaZVFCV1ovVWM3bDBhVXpldm9abEJOalBiREMxcjIwVEw4PQ==', '$2y$10$4rldyBHDfcOMjS6K0..d4.J.auHfNURFFfbDHKuktMQdSeeG5.KHi', 1, NULL, NULL, 1, 'GIZ9954331'),
('MOD2571656', 'MOD26924555698929252', 'choose', 'MODEJY9C9BX5LH344W', '', 'sN0SzHvnY5L04E1uyWq5aTYrMEVrRUdKeHpqaEJhRmdqcjZXcnJDVzNqYmg2d3JpaG5mVXFhVmhyKzRYWGFNaVJubWNUTTJnRDBSVTBZQndpVWdqaTh1eUYvRkxGSm91OEpmZEhNU2g1dWd3b0Y1TXR6aUtaNngrY2tBPQ==', '$2y$10$LGt8sAWCeebm8rl6ZcN8xu0TL13LymHZLnxVey/9ZNlYsccaXNky6', 1, NULL, NULL, 1, 'GIZ9954331'),
('MOD2571656', 'MOD26924555698929252', 'choose', 'MODEO1BKX31IFHBTXR', '', 'DY0kSVVm8yuEe/NElwI92VIrTlZqdnRzM0FVeFZoaER2R3paZjBTalBrQ21wZzNaajhLbXZGemhHUHNoS0dBS3JWd20wYWdZcUk1b3lOK29YRzVwV1BuRk5kTTB3aXpOZU1RcEFVK1UyQUZ0VThsd2xvSmwzeUt0ejBBPQ==', '$2y$10$zU9yWw8sfHD9J.vI5UfAI.JW9bhuvipRVvoJ6fYkV1Z5bfeR.VPg2', 1, NULL, NULL, 1, 'GIZ9954331'),
('MOD2571656', 'MOD26924555698929252', 'choose', 'MODERZEJF86TX98WRG', '', '3dT+XYlgWmxVIAd3v/aBMUNOQUhmaGx6RDh5aXZjSWJyNlliRnFFZjFWcWhyU1Z3QTNNcXF0NGxPME1SYlZxT0ZoM3ZrbU9JNmFDZGJtRUFPa3FmWlVENU5PN0thUktETmFyRzRUbkRGaXZ6K096dHRvYW54NDFqMDhFPQ==', '$2y$10$wfJPardvrbflYCeU/2naTekPk3PCs5ENqdtHLfWmRX/z4dpO9UxuG', 1, NULL, NULL, 1, 'GIZ9954331'),
('MOD2571656', 'MOD26924555698929252', 'choose', 'MODET3M39JHC3X77U9', '', '0c1e3k3ianBtza1ebo3DXSs1NTJQdzRmMm4wcWZNSWJiYjlhdFA2VHh6NjBzTWduN0NDREVYZjF2YVQ1aUZEVXM4UUNhUW5MTThTNzZ6TmU=', '$2y$10$xQ2uEqO2gGvw8EewMSd74.4aNOBbWzaDVls.kgHtWzyQDGJdH1eli', 1, NULL, NULL, 1, 'GIZ9954331'),
('MOC2132939', 'MOD65383726273746144', 'choose', 'MODEUNU7XELRC2LTG7', '', 'Wa8I6chq8Cexq980gg/7sU52cnBwUDdnTU95MUwvRnJIMlBRTUFGSFZLY09UcFlUQmVGRlUxMld0MjlhUXBrb3N4TWlkYWMrRTFBSmJGTDk=', '$2y$10$fPJjjqiFBhVQ702VH69SMuQBgMHziL0TMuGbD/jGb5Bk1YH/Nhs/.', 1, NULL, NULL, 1, ''),
('MOD2571656', 'MOD26924555698929252', 'choose', 'MODEXZJXJ353TCC7GF', '', 'f/vNPX+PNXqLS9L4OQgjoWxPeG8raDJIUmVaWllzUlNLZ1JocHlpTThRbDkydW9oMzZDMkxyLzVJeE9OSnExUVc0cnVOWkhtZ29SZXRrKzVYbjV3bUFJVnRhdVhPdE5xVU9CRjFmZ0lKUmRmVG9yTks2RFdzaFVqSy95Vm5rQjloMkZtVWVmSUVYRzBIclJn', '$2y$10$Uaf1KypIq5a/Z2ejhGU4PedDd7O9.J9qgnY73ySBPU3pVdo1GMPQq', 1, NULL, NULL, 1, 'GIZ9954331'),
('MOD2571656', 'MOD26924555698929252', 'choose', 'MODF83OCW4XG2YOCUG', '', 'DUByIjsrHF+9HGGwQqi85EJiK3UyZFgvWStIM0QyYkM1akxERWViaDQzdDVWM0hFK1ZlOGF1anNmUDFwUXFTb3VoTDhoYUlib0pnamJzd1E=', '$2y$10$wUrlzRXyMofVHlikPf/XK.1h0IokKAVbWFbI8qSZsyGnLHYfY4h/q', 1, NULL, NULL, 1, 'GIZ9954331'),
('MOD2571656', 'MOD26924555698929252', 'choose', 'MODF9H9UFG9IY2JHFG', '', 'kngcvnClv7zOT9dbGDpQEHZiYWoxZk9TOURJbXJROVkxL0xaekJKY2M1V2N3akkrY1FJQm1JUmxIVTdiaVAwbkdIUytOb2FJNXhKUUtZWStSQ3ZOcEpqWTBQdFdPb0tVK25lUHVpUVpSa0JTenRYdmk0bWsydUtwTGcrVSsvWitFVEw0ckpjYlo2OEF5WGZUT0dMajRqNUczaFVrakZpZDRJY044dVQrR0U3UFNvdmswREZMbFMrOUxYenA2OGwwWCt2dXNuaEpJMDIyblZFS2lENHpMRldITXp5N0c1dk9MbmdPYXY4UnBZNFVvR2dkK2Q1N1YzY2F3VUk9', '$2y$10$zy2cQdn3nj4oMhUKjmWjPOEsk2W3S.ggvZTfaVJk6WEuynx603K0i', 1, NULL, NULL, 1, 'GIZ9954331'),
('MOD2571656', 'MOD26924555698929252', 'choose', 'MODFK3X6R2NI8H7N14', '', 'ERalnJTa7QiCi4lAp8LLZWZ1U0lrMUptZjFtVHd5dkFrTjVDLzBnai9qd285eXdPdXQrZW55TEdZdTBkVXhGbjVDL0RadTJ1ck96NCtGN1RJSjBWNlZPUytOQSs1Z05PdElMUGhaa01RRnYyR1R4VEFjNEw3Q2NXNDRva3hSNUEvYlBEdGc1QVNGUVRkaVpu', '$2y$10$tDuSYunND7sXWstplG./Me7v5MdRXMs6I6l9GGv9xoOb6m8h8KB.y', 1, NULL, NULL, 1, 'GIZ9954331'),
('MOD2571656', 'MOD26924555698929252', 'choose', 'MODFTXUXUUYU2EO14I', '', 'SzIEFkkIGUM88jweodXumGQyUGtFcXVpRi9LVEMxZ0tMMkE0MHc0Z25HQ29vUUkwU21CSnl4cG15WXVLVFNZM1ZoWFl1ME8zcTNsYmZ6MVNybEpmL2lWL3dib29ZZStWaS9EMmIyRXZvcENzR3lPNmdNMVJaMGhXL0xRPQ==', '$2y$10$7KrWIisgOz0l/SbDgu0J1.CwWdrkDW3qHlKJR5UWAp7Rb43K.wB7.', 1, NULL, NULL, 1, 'GIZ9954331'),
('MOC2132939', 'MOD65383726273746144', 'choose', 'MODG379XG52UOEK2H3', '', '2ClpXOrrVyYT4No89YI9wFRqRXJCbm55aHEzZm9GcmtLdEQ2WklzbTB5OENTQ1ZNVk0wdmVzYnFKNi9NVUc4UWpSU2dmNVowdXNUbU9BN1laNkRjTkZvb0RZYzNYYzh0b3ZITStBPT0=', '$2y$10$QOzPTiF5owgeUMSi1HTfauqF7sg27LRFUdJts3yPcE4bZgUsaFk46', 1, NULL, NULL, 1, ''),
('MOC2132939', 'MOD65383726273746144', 'choose', 'MODG38LBJGH27JEHUO', '', 'wogVpxi/3DYunNWqtJSDX21LYzg5ZHRwSVJhUlRwQ3hzMXlwSG5pWjRSWDlXaFBpSnFHOXA5eVN1QnhOeDg1RHNJNFRQMGhKNjc3K05UNkw4NitTWTN4Y1Q0YlZMQmhidnEzZFNBPT0=', '$2y$10$luACdsxpyFV0pEPlb2E.3eKG3u1TRHy3ocdb8rFM4q17./bqMSUau', 1, NULL, NULL, 1, ''),
('MOC2132939', 'MOD65383726273746144', 'choose', 'MODG3OZ8UGLB2Y9CEE', '', '2p4FBMP/JEIkHNFEODAdLEJWZmdaSXRpK0l4aGxNT0JDMUIybjRJR0F0Q2M1R1Y1UStkYXF3bDk1eEdjbVpiQldZcVorTEhXQUVSWlFKTVl2T0tVd2U4eFk2dGxlOUs4aGM5MUZnSXhFRUFlTXBHdHVGOFdGWnkxdmlaVk5lY3kvSEtuOS9GNkZsSUlFNld2TUNEYlVTelhFNnNOTkFFMzI3NjZxUT09', '$2y$10$4y4Gfhg0mSbrX0mdXhK18uyEPYmcy5hecs5YNFJqbVUs8gMUTytRK', 1, NULL, NULL, 1, ''),
('MOD2571656', 'MOD26924555698929252', 'choose', 'MODG444FFG4L2EI17Z', '', '1vSvqh/PkfxXI9OR+wcAWkpSWjBMYmw4Zzl5OWxyeXdKRlF3b09vV0JTQ21tTXk4M24wR2IwcmpsS1NCbDJxZmdKUTlNT0xZT1VGQ2oxYWg=', '$2y$10$IWKDzJ/.0/iPzunPxCMmtOQbicnOT6inHHItvzwOrmwSfivkkuUjG', 1, NULL, NULL, 1, 'GIZ9954331'),
('MOD2571656', 'MOD26924555698929252', 'choose', 'MODG713R376E4J513J', '', 'uIBmzwd5j4KYaoKhmkbaqWlEOXVjM3owZWp2anBmTHpCc1I1SmxtOUl5Y0dXSW8yRmFoUVJ2T28velk9', '$2y$10$/Na1mpAqOwR8eTVLUoQo0evTkZa8aH8jWkYim9JhGafwJ3MV9Pa2m', 1, NULL, NULL, 1, 'GIZ9954331'),
('MOC2132939', 'MOD65383726273746144', 'choose', 'MODGG4MJZA62G6X153', '', 'cXrcAzSCc6rnEULlW1BrGW1OV2hObmUxa1FrcXk2ZUVOdE1QanpWUlJzL25QWTd2T2JCQzRmaTM4TTBuQzhQRUtMRFJjUEs2dC9pZ0YzTnRHd1ZyYTlwcVJiSFVySDhHUWVqbEN1Ynk2YjFxNmphZklmTG5ub2RUcDJnPQ==', '$2y$10$eSeXEL0sjk0gGHGxWqyJLeyxZ8/pjyTkuBoS1e/FIVUVyM2d.oCP2', 1, NULL, NULL, 1, ''),
('MOC2132939', 'MOD65383726273746144', 'choose', 'MODGRNMM5T8J5464LU', '', '8tCItUj0jgBOxLIN54q35nNLQWRpRXN4SjBKVGhTTUNPYnl1SnkySFBpVHpLaVh5SHAyV05hcElKWjFYb3lnaHcwbVRta0oxak8wOFJyZTk=', '$2y$10$M4BmBPgSKz6PdQ.7ZPBhhuvGqxr3xTpG2UAzxcrDGPvyo74mZpR8.', 1, NULL, NULL, 1, ''),
('MOD2571656', 'MOD26924555698929252', 'choose', 'MODGZ9ZMEX2XEXXL95', '', 'Oe+40+o0B/63sZG07HZQNlhBN2wyN0dwaUhRSDdsSkw1VWYxRmt4N1k5ZGdpeXdYQzFFNFZXVVNIWk0va3NET21oQWZiNVdsVHdkdko4NUdpd2ZzbFBYeFJIK0dWOHlVTCs1N0sraEI2c0Z5aU5sRlFDSGdUZ0MwNVQvRWpqVnlMeUdSWnYwRHBGdS9uN2MwaFFTSFIwYk9kTExmU2RRTVo3TDZqU0FLanQ3OXk2UmNKeUUzSVBhREFOVT0=', '$2y$10$ZRdgSWyf/DjcgK9NSBOraOiuZYMH3JVsJVXb2Rl4rIImUrYXyRi76', 1, NULL, NULL, 1, 'GIZ9954331'),
('MOD2571656', 'MOD26924555698929252', 'choose', 'MODH13J2352N74N82I', '', '1goj5ld+UxeJfhO6xyoRSHVab045V3RzZzYvSlpCQUVOZWEzN08vU24zSUhZOHFDeG8rbTh0WEF1dGNzbXpyNUNRMWNRNm9UeFJqYVVqdGtmbjI0T09oNG5KeDFNUEZBOTZub3lpa1hQYjI5end4TGdtL3VreVo2QUtzPQ==', '$2y$10$ZoUNNGdrZGf7UmrZMVYY0uHO1X6.SnRfWqRGy2akWThmbKmoE6myy', 1, NULL, NULL, 1, 'GIZ9954331'),
('MOD2571656', 'MOD26924555698929252', 'choose', 'MODH195HO2HR336NHG', '', 'DKNw9z9yYKvsJwb2LbX5WVJyQzJZb3JrT2RkVXVVR29TRzkwWmJINUlOa2NIS2E4TlRWRys5L1Zaa0xzZERINFhYOEdIUVRMcy9DZzBCaDVUdWtmbjVjaGd0dVhsTU5oRmtaR1BRPT0=', '$2y$10$D9//V8nC7THGGLaRbGaAL./dipdba5HhlKaBtO9kS8513KMlA6gAS', 1, NULL, NULL, 1, 'GIZ9954331'),
('MOD2571656', 'MOD26924555698929252', 'choose', 'MODH2LMWK1N3327R51', '', 'CXDGUeRrIt69DhkoNAszhW5raVBTQ1FLOXU3eUpLY3JCSGNEZUVhbXNMbzI0ZWdzSDludlpqcVZ2cml3MmxWYTBkalBDc01xZjZhRDZzU01pV0xWZU9za2VWL0JFZUhhY09KejJCdk9oZldtcEdDclNmRXNlVUgrQ1JLTy9YTEFrT2ZrNUxuNFJRMi9MREI3WFo1cGZLNVBMUnVMQmdBSU9pVlJ2dy9IcUJsSWFNTy81V3pxeGpkMUFOeG5yTmF4RlFhR1d0bVdvemllck0wQTdkSWR1dGJkODFaczlJc1RiakE4aWc9PQ==', '$2y$10$wBxvb//PRS8W7nGva/imfe7Qs01Fpk098EV4TYDLtMjsdOCEYH6/e', 1, NULL, NULL, 1, 'GIZ9954331'),
('MOC2132939', 'MOD65383726273746144', 'choose', 'MODH4J9F3AOJE2NML7', '', 'Ujp3HVLxp2K57M2W4haN/UxaNDhrdFhNR0cyZDNUVDhoQ0JRQk5xMUY2V21MdXNsekVzZ2pNY0xlcHk0MWh2QUQ0QU9UV0JrbGovUU9pU3UycnI2VzhOWDkreTdHcUlEdVM0Qmd3PT0=', '$2y$10$9hnyWdJWUXM1gTA5.ptS8OqNNRnsb8RKCIsYNAHqhDPFFe3ebcofO', 1, NULL, NULL, 1, ''),
('MOD2571656', 'MOD26924555698929252', 'choose', 'MODH5C28H2YFY3G4UX', '', '8kPzUVfFojvH2k6rf6oCom5wTGRZSTNESThxbHdlZEVDcjlGVllaVmMvS0pmMm9VZFd3R1lIeEhyakdXNnhEM3FSMEhZY2ZRUDcrbEZjNVl2a0tJK3BpYytWaWVkbWlyOCtsQ0ljeHZvZk55ZTZ4Rk00bXl0YytMOHZMQWZMTnJVMmYxZGw4UDFQWTdVWko2', '$2y$10$8kBNqcx24hNRrfy5Z529A.RgHqKRdA2fQIQhBcDaMvBSdtvNyC6Vm', 1, NULL, NULL, 1, 'GIZ9954331'),
('MOC2132939', 'MOD65383726273746144', 'choose', 'MODHC37N79E12HJAEY', '', 'gOUSKGtqGUBEtVAuI6Yh1mE2bG9iSVFaL3ZKcGJ4cVFOeFV0Y2c9PQ==', '$2y$10$AsjoJp0uLRVqPh1tYKHQMekkSzH2QD0PXIOtBGfmH7svnflbi92iS', 1, NULL, NULL, 1, ''),
('MOC2132939', 'MOD65383726273746144', 'choose', 'MODHOGF38492973H3G', '', 'h1cu5A8wbOaAvzzace95LFBSNE5oTVBSbmw2MEJPa3ZBc2xIVHU0MXlKTTU3TElYYnVRZHcydXpCYkthdERmM3RzUlBxb0Q5aWdZZ2M4WVRvQVZ1eTI0M2VzVlJJTXJXWXEyWmU0cnNUME16S3lrMXBzOUQvSWV0Z2lCd3BqamMrOENFQVI5Sll1SkpFUHpwb1hKTFM2cTdNQ1hMeUhoNi9xeU5WKzErekRmcWF1SjNaeDhIWWFhRVhyOD0=', '$2y$10$t90GL/uUgtiAMj7J8SbcHe28EeThajLVbTpU1nh/EeJxyIJcz9eOa', 1, NULL, NULL, 1, ''),
('MOD2571656', 'MOD26924555698929252', 'choose', 'MODHWFE9J3Y1KF74L3', '', 'pojgiP8SnSCiyIddKoyOIWJnRTM5QUpUM2t0VTlWRXNOY2szK1l2REpCSm5uL3kyVzhTU2MzMXVkSWtGNnpuY05kSXA5VUtrVjJaQUZPM2g=', '$2y$10$slH3QeMkkFk0rkX9yUJLEukG512uYIE6JCXOsT77K4LvpXQPsuM5K', 1, NULL, NULL, 1, 'GIZ9954331'),
('MOC2132939', 'MOD65383726273746144', 'choose', 'MODI42WZN33NWWOFT8', '', 'jN5lAgBjweBXasTjZmy0GkQwZnRzbHlzT2dkSzNlTFJlek05eEhmVC9obTh1NFJMREFkTjVkUTZjMjkvQk1iZjE2SDhaSU9jVi9XbTYyY2lQVi9iSG9hL3FYVit0Q284cW9Hd1lRV24veWk3UFhYbHdIbXpmM0ZnUjFRPQ==', '$2y$10$Np/PQLdrT3X4P37kXc0NDuIOfqlSwRqDAwcLSBPOmiNyKAmyEyCd.', 1, NULL, NULL, 1, ''),
('MOD2571656', 'MOD26924555698929252', 'choose', 'MODI9347ZK1OKCG31O', '', 'XH2qa7E9bJlo0Qd7Of8Mi2JTRkVQblJKQURhV0dZQjIwWm9CQVIxL1hjNXJsWW5rVFprQWR4YTk4aVZ2eU1NNXptZFZ5R01oZ0lQN2xReGl1MHN0UXhkY29jU0t2cWxtVGFzcm5SQzExUi9jL0Y1UStHd0dkSjFGNko4PQ==', '$2y$10$4K/oCvKE/bl1a.X7bpYhWeI9KE9hvaVEgA19ccOFWiPV5qek/wnXa', 1, NULL, NULL, 1, 'GIZ9954331'),
('MOD2571656', 'MOD26924555698929252', 'choose', 'MODIEK43M84UU74A3W', '', 'Bj7xy7kU07L29qiovmkRqFdibml6eWtMdjg2U1kydEllNDVNVUhmOWRMeXdTcHZIRk1RUmpkYjRVNnRUd0IySWNLOVF2SUxWaDczSVl5dmZnZTZiTkVSUmpRSkExZ3lyTTAreEcrTWNtRzZ2UDNVeXErbDlpcVZsa0djPQ==', '$2y$10$PHyhk5hbiQdtOqQFRIHZUe7tCYTHM2epPv6mBtwj.FCQGZPCnyatK', 1, NULL, NULL, 1, 'GIZ9954331'),
('MOD2571656', 'MOD26924555698929252', 'choose', 'MODIGR6UZUM562W1OH', '', 'ubgIjdjS0Np5UlMSXJbH2UlRSHRRYXB0TTFGMXZlVnVaeUVKSnpETWNSbmFodEVLK1JEZVZaRzh1NzhUK1FXQS92cDA4YlR5ZXlZQkkwZXRJQzEyT2RqdUJwL1RZMjlPQ0FWZmd3PT0=', '$2y$10$0shb2E1oPS6KUALc5l/r9.PRJ3Optzg/DsnsFKOzxBeAIwAWP8gkG', 1, NULL, NULL, 1, 'GIZ9954331'),
('MOD2571656', 'MOD26924555698929252', 'choose', 'MODJ1I9ZNMXEECE9L3', '', 'VI6wN8krcbdve0caoj0jATg2N0h0cDF0QXpHU1BoQ1pTalJWVmlHSm1mY2NNS0lQVGRENXc0VkIyQUxES3VnT1JxZmpWVjJ1aWkva0hld0hETGdPVzJPZXNScm5qUkgxTXFXT2RnPT0=', '$2y$10$rNzZUMIFO1tiLF9mbWLhauVC.OQ4O2BEAcrcEhwKJKoQdt7Dg05G.', 1, NULL, NULL, 1, 'GIZ9954331'),
('MOC2132939', 'MOD65383726273746144', 'choose', 'MODJ2YGCZGMJRAW736', '', 'FW9HVsoQKWK7Z/+Oe0GPrm1jNTJlMnl3V0tVbzN2ZlJnUE40MGtTZFhlRUtmdXZzQTlTeTlvbWgrMGM9', '$2y$10$35wGmLr436Wp1jjTcv41ROpj52CGQDgpExsLe1cf3eIYfA7QrdUHq', 1, NULL, NULL, 1, ''),
('MOD2571656', 'MOD26924555698929252', 'choose', 'MODJK7J312JIEL39ZR', '', 'Dc5SYg/NqqJQ1dEWG266pllQOGZFbEFrWmRCRlVPai9NbjZ6a0VCelZEOTIycHpFZHFnV2YvNjFPRDg9', '$2y$10$xQkkSBCYwkXussu.j/EzLOPvSKfFrHP2PnzykhEjFT0ghjMgePUre', 1, NULL, NULL, 1, 'GIZ9954331'),
('MOD2571656', 'MOD26924555698929252', 'choose', 'MODJXO593XAU792ZE3', '', 'fWN6lOSTZ8vyGDBUxGEJhEpRTkZzVitzVFdWRVF6dEVDMVZOUDZNQWJHZ1Nxcm1XaHZ6TGtVTy9RTFIzYnJzWFhkRzQwVk1Cc0xRcElNSDI3a2JhRUtyK1dmcVNIN2J3eDh3Ukw2b05WTTZhTG1DU2RoYjNDeE1XZmdFb0dvQ3hFd1RQY0ZodmVCdHUxcDJU', '$2y$10$mRLjOvzOXyRuv.yWK/xf6O3xX062HmOdeZrWC3tMEgeH6DZfR8amW', 1, NULL, NULL, 1, 'GIZ9954331'),
('MOC2132939', 'MOD65383726273746144', 'choose', 'MODK92J8ZZEEJA4X29', '', '5I9ZfXSNnpUX6naMYtS6HlZHUlZMbjZMRk9KejJHUVp0SlpXSlhYNlVHS1k1L0Vzai9NRHZEcmJsNUNmbk0zR3BqRFRuMHRVb2dCMHFWV21zbjBOK0RxYlkxNWpFZ0t1NjNkVG1nPT0=', '$2y$10$dfAZ.TatNMQDg1kvvM84dOHCjlJf/NcNO06aPqR9Igipen7bSEhsO', 1, NULL, NULL, 1, ''),
('MOD2571656', 'MOD26924555698929252', 'choose', 'MODL2JAXXF918KHZT3', '', 'fABhlGz6Mm2xFAgeynw54U1QWmYzRFF1MlFrSEJvSzlOVkQ3MUhzaGhvNzNiZXBWTXMvSUVZY2hYN3Y0anVBdHpWS0gwL3MxN0p5TzVKbFRSMzM4bkRTNEZtb3pnWW9tcVYrdFN1YVlJblBmQ245M25nOWZySXMrWkoxdkR1TDhzZ2FyYzVwcXltTEhpVzRN', '$2y$10$LQnRR6vCAzKhI1TRYdhRWOU46nz8jW/9obHZciI7jgrcUm5irD3C2', 1, NULL, NULL, 1, 'GIZ9954331'),
('MOD2571656', 'MOD26924555698929252', 'choose', 'MODLIJE2E9273J8822', '', 'c8IR6lgjsShF4a2HPlQd9kdaM2d5ak1xME1ZcmQ3bzVrUGhybTJJWlR0ZG1JamhJZ1BRdHZzM3owMkdPOVdReGZEUE0rK0lDU3k3RUVaQ3NmL0dEQVZSUVI1UW9OVlNiS2ljNEtQM2x0UDFjRXZuMXQ4V09kcWJ3cDUzTUNBYzJSOHhwWTVWK0d4eVNJK0ZFUXlKVEdBNFUvcnlVMW1pcDE5MEY5UEdQYTYrRVcxQnQyc3QveWZZY204ND0=', '$2y$10$uGFGOjt/CeAzdJW8FqVQJuWCuxIHlu9ToE3hsKIxJ997Y.m.sKD8a', 1, NULL, NULL, 1, 'GIZ9954331'),
('MOD2571656', 'MOD26924555698929252', 'choose', 'MODLN1CR8WJXJ4XHW1', '', 'ru8U62677ETxfzquEsKWoFVaY3h6NlUwMk5Jc0k1S2VQNGNuNnZhU0NPd2VmM1FzUUdTNWw3dVRBZFY2b1ArU25GcjFlRHJUQXJPVEk3akZtTlhxUzljQlFsOFIvL2h3UU5tZUF3d0hDODlKaVZVSXJaM3lSZ3Z3RjJJPQ==', '$2y$10$CxQ.IybxQ1K9gq/kij1Tg.LiqVCWTxpVLR3b5mlnpqI/qb23hF7Kq', 1, NULL, NULL, 1, 'GIZ9954331'),
('MOD2571656', 'MOD26924555698929252', 'choose', 'MODM1724I53CBFJ492', '', 'MsqlTSJfwg119GLD15znRnZEZHhpVElXd2pYSkxyUmhibGMrNlZvMTdJTlRSY3IvOFJrQlFjcGtmQW9GOTluQ2FMb2k2Y210YVpaQnFjY1JtQ2FqazhudFZlNUtNT2RVRXdGQ05nPT0=', '$2y$10$PA4lS0SQcuqVN/J0uHXv.ejVxDjqfmArL6.bkOuV7zHUvMKGxD3/a', 1, NULL, NULL, 1, 'GIZ9954331'),
('MOC2132939', 'MOD65383726273746144', 'choose', 'MODMNKGTAY4E1L99JC', '', 'q2ebCiY4ZKo7p/D77sxAEjQyOHIvY1FjR1BQSGdudnJGazUxcnNIdTIxSUp6V2c5NDJPR0crMzJiSlZNczBwdlZhV1ZFTVE1RVJkNEdzS2x5RlZXWmtibFd6ekljWTBCYkdGWVV6SlBUVDhmYWtCOHhjQmlzYjlwanVBdFNycnVRUjExUzI1bllzQ1FWUVh1', '$2y$10$VQMs/YE.n0AhsqNroAyMMOlQjxBS5aTgqPSVD0b5zxz7MSs4x5HGC', 1, NULL, NULL, 1, ''),
('MOD2571656', 'MOD26924555698929252', 'choose', 'MODN1G8X6M3YH34J51', '', '6q8S9v6w5XrX215pAdgDpXBFSmYveFEyanF2bjgvMGxOSGhCdHVuRDEzaHNCOExtVnlaY2l1bXY3NSt0ak1yeWlCOWpIVGNDUkhlSWhLdkNrcXVTOEZWZTBybDFIVWZoZmlGZDRUbmVjdlVUMlRkSjIwOEN4cnMwalFnPQ==', '$2y$10$7ACGC9/uNY6.ykv4y897/.FH4FiDwA52gtaqzDBVvYPUcD2PI06na', 1, NULL, NULL, 1, 'GIZ9954331'),
('MOC2132939', 'MOD65383726273746144', 'choose', 'MODN4EB473EJBFLT7E', '', 'CTWUEqFnX4zIxf9Nso4tGlpSUmVXZkVRREN4MnNmc2FKV1lpS1pNaHpmUHc3dFZVdlZFMnArdkRabDJZcU9FaU5oS210cm5STlE1YWdaSE1RYnVJS1k5TVZXVzNIRXVGcFlEcTNXOERwRHR3TGFMRDE0NHN1eiswSDdTcSswYWI0cVlqaVJnS0xwejFBajI0', '$2y$10$qcNzyfyouKSIQpcG15lTJ.PoM/kk9.6CxeMPnN9lDSprzdzpkxZhm', 1, NULL, NULL, 1, ''),
('MOD2571656', 'MOD26924555698929252', 'choose', 'MODN9Z6OK32O3HUM38', '', 'pU9BtDtk122UDGuMoMAxzXBVdXhMdVg2bWVzelVLRnhWeHpkaTV5MWZ0bWVSYTBGbjkxblZxblY1dnJxV0xJakxYVTRSYzc5MWhFZUhHb1h5RmY0Y3RnSnhVNHVEM2FSRVlCY2d0dlBLNURwOEsyT1UyWURKbmR6enk0PQ==', '$2y$10$L53ntpHCKdj9YNCBGq3GluE2TsZz4zYW1z0LyIRNVsda6QnTkMDpe', 1, NULL, NULL, 1, 'GIZ9954331'),
('MOD2571656', 'MOD26924555698929252', 'choose', 'MODNBJLG787BE7U12R', '', 'ZW4yHPvJkVPl6+EbuKiLOCs1Y2VNc05OZWFrbGFTVWdtRkdPcVJ1eUNIRVBvZjd0Uzk3bHdkRThJR0hQdG90VXRWQWRIb0hxUXBsRVNjM3psZTNtc2hkcG9mZVFLVlZwakRBYnZCdWdKNVRKUFJrNlI3Ymh4dVo5SS9FPQ==', '$2y$10$FdlCU10IgaCSF7Iqy77R4u3MJS5DquOT6cXclt73dfWo4mkOx8JWq', 1, NULL, NULL, 1, 'GIZ9954331'),
('MOC2132939', 'MOD65383726273746144', 'choose', 'MODNC5M9EE71J446YW', 'MOD65383726273746144MODNC5M9EE71J446YW.png', 'jNsHBMXrzFU/8GhI78XXT2ZlQ2VqQlNrOHVBWTRzVzVvazJWVW1wd05FQWplY1o0ZkgycWw5NFNVc0I0TmY2azJ4SkVkL09ZMWwycUJXTU9STm41Y0lxTWwzNFdjQTMzazRHR0NMR2hkZ3ZtV0dETExUbzg5ajEyVWRZPQ==', '$2y$10$PRbaxk5HF1L4rnqyb2mjHuoEo3dIlHDfsQS1z6PDTjhwOTmtK1CoO', 1, NULL, NULL, 1, ''),
('MOD2571656', 'MOD26924555698929252', 'choose', 'MODNFNH9OJLNEAE2J2', '', 'B3nBMUvAtp+n4h2ovv+MGm9rdTMrWE1UaXJDSllFWkRIUUlQdkJQQ3huVWdiNmpQTFREL3UrcFh0RU5VbU0rVEFRSTV6TXMyRXhpUVc3Mnc2ZGxVbFNGdGNkR3B4aTBRR3RxeHZnPT0=', '$2y$10$QQt4q2fLOvIkMjaDGQ0iVupwo4WCPQOxuYJlsKmzhv1/ZXvc3ohfC', 1, NULL, NULL, 1, 'GIZ9954331'),
('MOD2571656', 'MOD26924555698929252', 'choose', 'MODNKAGGTJT1J32G78', '', '7bM2QHPYbAeapazSgke3P2RvNUtLc1JsNXpUV20vQUx6dFF1VERpOHQxVzh3TW5iSUFOYVlEZlcybEtybGhPSHpsVGpTMzJJWXpob0RyOHhnYy9oNEc4S3Rya3pmdUZXS3l3M0FXZmk4Z1JkQ2h2K0VvcDA5a1IyVms0PQ==', '$2y$10$JFOqgyFRwbTS7pBLqxhSX.re499RnZsd87kzhF8qDzUZk0p4u8srG', 1, NULL, NULL, 1, 'GIZ9954331'),
('MOC2132939', 'MOD65383726273746144', 'choose', 'MODO634292LYK6EY97', '', 'p6E/TyyHdtDZfZ/CiuTZ80VBL2orNENnUkVoTEFWT0VXcWVWZjJNR2FaWW9va3YraVVqQmZSbzRrNjJDMTNEcEtHZ3FGNUxWODBRQ0xxTHRCeUMxYWRJU3NVeThITkd3Vm9rdHR3PT0=', '$2y$10$5AEt3P9FtsbIKVkAidEX9e5kivwALKONe8ziJy9f3HwOA/a.mtny6', 1, NULL, NULL, 1, ''),
('MOC2132939', 'MOD65383726273746144', 'choose', 'MODO9ROA3E823A8E24', '', 'TqjzFx4CsBD27YdU95MCbmhPVWwvTmR0Vk96M2VnOG1OYVhDdXV3VjhUZWlDUFAyRWtPMkNmaVk1b3A1N3dITFM1RjkvS0FGa3VyMmJ4aGJFQ2NUTDVlTlZTWFl2QUx4NVU4VW9LbTdpeE5NUWFBV3lMTmNpQkJvRmYwPQ==', '$2y$10$RX8qw3wdxwYc2UZJ3Xmf8.MeMMgdro.D1Vz.B3r596UvzbHSOynoC', 1, NULL, NULL, 1, ''),
('MOD2571656', 'MOD26924555698929252', 'choose', 'MODOL34E64I24UH41W', '', '+dxRYGNuFl82dOUVoqKdWmJwQXVkYld1TzhEQ250OEdVcjBFYm9hT0pIZnRNMUgwYkVjcXpNZkJ1bE1aQlBsdUlQNldDd2tXT0R0amJSbnVMRGZXN2lBUXVWUG5FV3c5KzA0MGNTdXM4b3FaanZoRUFUS25KQkpIR3Q1di9TWXhkTmhoYXBzQkxJWEJKSEVLL3J0MWpYVFlRSDVHSjJSTHZ3NmdlZHNObDhIR2x0ZWhkY3BDOHRFb1JUNXJWQkkxS3JjbDducEswWHQ1Qnd5ZXRaM1FHWk9LclpGWDIzK2xsSEQvamxnT2Q1enZlYzl2Y0dJY2VqYmYwbXBZT29lN3liMklEZUF2YU9HT1BKK0J6TURXNnd0T2I2Uko4d1VwSkV6YTk2R1hNRXpGUGFUamxBTkFxbzBiVDlvRVIwWFFjUTIrcnN4MFJpWXd3eWhL', '$2y$10$P1.RvM1wdXVRHLQDCaSlneACT3GP96dWjYdpYVzo9lYezWojoxzZC', 1, NULL, NULL, 1, 'GIZ9954331'),
('MOD2571656', 'MOD26924555698929252', 'choose', 'MODR7JA1LJ4C2MKFXB', '', 'EL5UdMy06rrBCgF36pz1szJ1L05saFhWVmcxcE5KTGdzN2VWMCtmbXBteXAxQzR2NXpvanJmU1Y4Q01VSmJIS1UxZ1Jad01BeVF3L2MvTnl2L1pwYW1SUm5LY2pWOWRvdW4wZTkzU21XUDQzOEVQRnlaczlsaDdVbXB5V1h0S080TDlHRXFiN0M3dkR6TW9hYW54RkpRS1c4d3psZ3hqT1pocE5IMkRuWW5JYmpLOUM4clhBQU9HTFRVLytFc251ampER0t4TmJzaEVNcGtBc29Rd3RqemcvMkVHU1Zmb2dCZGFSTmc9PQ==', '$2y$10$z7rfSqXYllrZFsAYn0dLqOJ7BEromVz2jM.8LcY9be0iXcjtgpbtm', 1, NULL, NULL, 1, 'GIZ9954331'),
('MOD2571656', 'MOD26924555698929252', 'choose', 'MODR93654MKKAG9REX', '', 'zVbHn6++/lTbmbk6xMvLA3RLMnRFeGJra1FvakVLTStMOW80OElSUFloYm9MbTl5UHBNY05ZQmZEV2RNS0h1VzBtUzVFTHdkZWsrTjMveUVkSy9VMUNMNXU1UXduNHBXeWFsZm5BPT0=', '$2y$10$8miUM7IhrdAKLDyLkTV3CeXZg8TejOdNzdU4n.GXj3i9yApklu35S', 1, NULL, NULL, 1, 'GIZ9954331'),
('MOD2571656', 'MOD84981219413119185', 'choose', 'MODRCA16B2X2A5IH37', '', 'cgeQO/ocs7FTF6WAXw81jmZBMVNKSmFnVW9PRFU5dTh4NXB2aGpSVjdoV2JyRTd6SldtRm1MeldYYUE9', '$2y$10$N42.xbyZltTuz0sqZe4DB.dLZFpkgDilNhNDhhBTD74UXTP60OD..', 1, NULL, NULL, 1, ''),
('MOD2571656', 'MOD26924555698929252', 'choose', 'MODRG185YKO76X5897', '', '4Cza05F98BDxMhbWa/k5lTdtcGNaS2ZsalVablErSzdsTFhWRHFlODVkTGZXTWNJdmtCbkFRQVZoVmorRFV5dEw2bURLL1lMT0h3MXVjb2xmMGZydlhEd2xlRk0wYmJ4ZkhnMVFSM2VDd0duckQ5dEgrcWY3MjVoWkZkQnlka0M2R2czNktrM1duekl3NTlXWVN4Z2Q5ei9zR3pIYlhxVVF4QjFZZVBLY0RWQXpiTE0xaVZFTllscnNLWT0=', '$2y$10$DI5tChdau1T2tg8K8eTGxulNyOIIpeBtpZ59WUpzD6Xpoxa2YvDfa', 1, NULL, NULL, 1, 'GIZ9954331'),
('MOD2571656', 'MOD26924555698929252', 'choose', 'MODRGRKE22I2O9BJ33', '', 't/ZK9bLKeheYXn+7II+yX3lrZWdPTjUyU1E3cVBReDFuRXJLdllqYnExc3c2YTV1c0NYclNjTHBZZGRxZXZrNHpBMjdsMXc4ZlBCWHJMREpDNFM2YzJocmMxR3V2NHJBS0JyQVhHdGQ1NkdHY1hYMU81bHVwRnJNVUlkazMwdy9sL3JnUnptcDZoYjVtWjVCa1dtaTVLWHZ5dHpobDNrUHBIM3I1QT09', '$2y$10$NX3Wl07tzdUBPzeFxGiB1e.anagv9Kj3FNnSU5T0Ku1uBW39Xp5wm', 1, NULL, NULL, 1, 'GIZ9954331'),
('MOD2571656', 'MOD26924555698929252', 'choose', 'MODRT8KBZWM7W8WEKG', '', 'r3Nxon1qvHtgIrcY+rLXZUdtSWdHVDMzNFROamhSVy9taFZ0T0ZtWDdPcnFzWUtsY01Xd2xCc3dRMTZrT0MwMU13b0dWUzlRcWRYcUtYR091NWw3ajZuWEQ3WmNBc1JzSjQ4NnZBPT0=', '$2y$10$vXGTt2KIgsE2DWTSC21tFuMMT/MnlWbHRkEKYps0n4yBtNVG1lOKq', 1, NULL, NULL, 1, 'GIZ9954331'),
('MOD2571656', 'MOD26924555698929252', 'choose', 'MODRT95ILEN84O49GG', '', 'MSpF9szXm3CObwIWzahONWQ5bWVGWDNGTzl0RG16eFljaVROcDFaWkJrQkJrVnk0TW9pWkRub0RFQ2l2S0RVTExSSE5JMkFvRzVBb09Uc0xCc0QycDgrYXdBa1NkN3hkOUJudHpkZWJrUkFaV2daelhKNHMwc2RxR2lpb3JnTDM0Ym8xRU5sT0hkNDVPS1I2L2J4RlJIanhpenNLVkRWSm1DeS92Yzk2UXB2Y1NIdEw1YnhKK2g0bnYxYlNRMlVZZTNTWHdkSloyVE1lUElnYg==', '$2y$10$NJnhNETb7kdOqMU.ZFUYzOGhZizxEnPIIF.GWMk9s.C7KMW96ihjW', 1, NULL, NULL, 1, 'GIZ9954331'),
('MOC2132939', 'MOD65383726273746144', 'choose', 'MODRZ313HHYL911OIH', '', 'sfrHV5U+3VvFqM5zYialR3NBSkVXc2hIZmJZN3EyNnU0TzgvNCtTR01rVmFQaW5LcFVITDdibXZRM2ZMRml5Q2ZNM0FodVRTU05GdVkwMEFXSTNJTzBVa1p1M1NiR1dkTWRpdG53PT0=', '$2y$10$SaP2i2WgyqjyBqRlne4q7.w3CRH6pgrd4gRe8NiokG1n82JQmpmT2', 1, NULL, NULL, 1, ''),
('MOD2571656', 'MOD26924555698929252', 'choose', 'MODT1417X4XM2HHG91', '', 'O3/9vrQ/iqRIpt48t8TH1TU3SHhaOGJNcWR5dU13Y2EyeEpTQXRuOWEwQjFUOWk1djBrTzBiWHhJeCtQbXdFNmYremxKSFE4VjUyOTRnK1NjNEsvVzlGRlBGbWtGcnAwTzZFUHNBPT0=', '$2y$10$IT2Zp6GhlRuGhTvQDI1KM.ZbbkJbsvsHBORM7np1R9qKdg3ruRbb6', 1, NULL, NULL, 1, 'GIZ9954331'),
('MOD2571656', 'MOD26924555698929252', 'choose', 'MODT2OXR23912E38UG', '', '3Xi/QEU7EqOmpx2f5WOV6lVBS0NEaEdIaFgxVyt1Mk04YjBsRDUrcUZiMUlybGVYY2hGb0N4aEx1M2Q2Y3FVVk93b0VjcHp6ZG5NVEJhYUhqK0dRR1pBTFBjWERxUmZLM1BmZ3BRPT0=', '$2y$10$utILzbUtVkvZ7HtKSAXQv.5U/mOjVAVdspBbPjvm1XnTY0uyHO/gC', 1, NULL, NULL, 1, 'GIZ9954331'),
('MOD2571656', 'MOD26924555698929252', 'choose', 'MODT82XE5H7W9UEYXJ', '', 'SBz63rqCbvwrXrFNuwCxEUI1TnU3UTNnQUw5azdSaVo1L3AwSWN0NkpQV2ZySXR0NUhzdjc0UFhTby9yQk1xZDllUFVvbG01Vk8wdG1pem5GNG1OTFZJNDBnTW9rbEZ5Rk5IMk96QTN4U1lIN1FKWEFWR0xpK0trZjVFPQ==', '$2y$10$qonbWgLxKX3245EfnnIjW.4X7RZWBKc9LZsjZ2QehWoqGlAPY4Bi.', 1, NULL, NULL, 1, 'GIZ9954331');
INSERT INTO `question` (`cat_id`, `exam_id`, `quest_type`, `quest_id`, `question_image`, `question`, `quest_ans`, `right_ans`, `hint`, `explanation`, `stat`, `qcreator`) VALUES
('MOD2571656', 'MOD26924555698929252', 'choose', 'MODT87O8W7HOHG3G3E', '', '6ZlY/RoVk6fb9/jQUxZvYFJVTWNHT0JROExyZVdmVy9KQWgwT2hmN3M4Y0NRZllXSGlBeWNhdjhFQUtacGpNRVZUT3lkaDFjd3dOdUs4WHBKSXJIdWg5SmxmYURQcEJ5cmM0RU8wL0xCdFdYd1lBaTVqSzU3U0t3V1R6ZXhBMU9pNFZrdGsyOGFwYm1VUWc4dGhZdWQ2NHFIb1ZoaVJ4QTdHNGpYTytQeG5VMS9NSjkyN0J5SUhQNDRudXJENFMvKzF2WnhZc1hBcTJ2ZU9lbQ==', '$2y$10$F.TQIaFpLTiGRX.xSeXT2efQRPBysvvUzEv5iTOOb8L/HY6TehVNm', 1, NULL, NULL, 1, 'GIZ9954331'),
('MOD2571656', 'MOD26924555698929252', 'choose', 'MODUE9T3GC84E38RON', '', '7MKf1wVbnDH5DX7CKJ0zbkg2alp5K2xKR3VIUHc1N0J2WGpoVVhNeTMvdmZhUTRXRENwVEVrYUpqQWM1eFBod0dvZ3JOK0VTSUErMzdYMHltK2FiN0x1aTRLZ1JtcnkxYW51T3UvQk1KR1VMNnV5QmJ3b05JdS9lYUE4PQ==', '$2y$10$FVND0ATXGYVxh5sLUrm1gO1d5mJKdjwXRTX7H5Mzz5SL.Sb1doCMe', 1, NULL, NULL, 1, 'GIZ9954331'),
('MOD2571656', 'MOD26924555698929252', 'choose', 'MODUGI4LE2E14E2B8X', '', 'Q+RDWEDQ1JjLGVH/4zKX2mNyNHBRc1Y0WFkrS3RSWjJidG1IOG5BQWowb0t2ZGsrLzVCT1E2TTRvZEVmeHZWRVpCTy9zSVdpeUsrQm15UXdoeUlJUjZjNWNZK3lkRWo5dk4rVGp0dG1qUUt6M3piWnRtYmlqTnVKNGVCV1RCUytVUW05WDY4N1ZveEdENlo5MVoyQ3krQVh0enZrT0psZnh2M29kTENmNlBpejJqWU5xVDZOUmpubTA3YXpXOUs3d01XUEFyMGhxU3hMdXV6WA==', '$2y$10$0cFpElPvb3UTvvfOocnvyu53LOur9SCXWcQe4hx/Qh11iZnRYlK82', 1, NULL, NULL, 1, 'GIZ9954331'),
('MOD2571656', 'MOD26924555698929252', 'choose', 'MODUO5I24775G33HT9', '', 'vYgW6EdSu7l9eXAePHpJUXRBc0d5TnY3UHNRUHYwMFhUQ2MvYnpHdzNtQTVvZzRvdDdKTEdBNGFrSlBMb0xJNUE5ME04UE1QYi84Y3cxQkc=', '$2y$10$PqOlIU3GfbYMsPMh8t9NxeU242fu8Yui3pFPbYFBSLca15oNLw2GC', 1, NULL, NULL, 1, 'GIZ9954331'),
('MOC2132939', 'MOD65383726273746144', 'choose', 'MODWI959M73OT3721O', '', 'sM79fHnj6uWEIVX9dy0ARjRYVm9vSGRERk42WmxVaE1GbGpzdzdJaHlpemR6TGtTMGlYRUhYQVpYNTduekFjc3A3NW9TVFBzTHVmV3YvdTlUOE1JMnRVbCtiQkpmTERLY2ZyaGt1Qkh4dFRCMThKNHdOQUNaU3BLZ2lXbWp3czRsWmVuREZTUlFKQUZ6UGRNNk9EVzhiVUZ6U0x3L0xBdzFXSUtDWUFRWUlZeXJWOWJIbWlHR1h2d2Rqb3p5SEprWmFMZFowajR4bkRmdy8yM1lvQnFybzFMZFZ3OFhSb09tZ1NYNFlldFpjdFlLQndVOHBjZUcxeHhuOUZQeWI5eGZjbk5JSjNPYkYyUjc5YkE=', '$2y$10$8Ctb7R1jVwUXRMgO4JMJbejspAvbQRvEcYuGDLhpwWe61iVl6UIw6', 1, NULL, NULL, 1, ''),
('MOC2132939', 'MOD65383726273746144', 'choose', 'MODX2JKHZTU373392E', '', 'oRzoIs0gZ7gJAo4/84TiD05EcythM3l0K015amxGREtxSzdTUGF3amFzK0tCWmFseHlTWlQvWnQwbFdNNjdPZzRlSXFPRGRBdS9MUlVFWlBmUGNzbmFQVmF2UVl0RnRjaFUzWkh3PT0=', '$2y$10$abVcReAat6KZGirhz7YEkO/PLBTIvlQW6FYP.1f//7T9qfS5Uhir2', 1, NULL, NULL, 1, ''),
('MOD2571656', 'MOD26924555698929252', 'choose', 'MODXIHTK8L715H33C4', '', 'm3jxW/KTZLdRWeYeWOKRrno0YW5xWnFUdnE1Sjl0U0ZXTGxZanBBc0kxZittc01SRENzOGN3Nm5nclEvSXRyODBsTzJ0eVNlWjAvK0dhaHRsV2pOWVZRcCtpSWtxcGdxaWVDQVlPK1M5RGlwY0J5WU15NkEwQzRpc1IzNEhQQWUxMnVxaEc4Y0N5MXZVcTFKY1JMVVZxYUI2cUJORmt4dUtWK2g1a1VMM1JvWWx1VVB5V0V2WmtRZzhKTGZxVVdieTZlOFZXSVNadHloZWNWZQ==', '$2y$10$OpCbS.HI.T93ZsnhXMz0C..Exqylf6tQeRkPkH9xXeWiL4jrIrHBa', 1, NULL, NULL, 1, 'GIZ9954331'),
('MOC2132939', 'MOD65383726273746144', 'choose', 'MODXWRJO2BXH4A8434', '', 'jutZqPuJHWCBTJSwHcBKBFc5dU93dFl0aWwrU3A4dUVUalMrZEtpNXc4bk1paksreGpJNWhvVHpWSFU9', '$2y$10$558ddKBeCAqfKePXs3FFoO3aKJ5MaFmTHYFw77/qWp.ayXViXU0hK', 1, NULL, NULL, 1, ''),
('MOD2571656', 'MOD26924555698929252', 'choose', 'MODYI13MY3EUZ6N55N', '', 'QXxRha7qNCvmIu6/0BoTZHl3YzZpSWNCazlsNVgvR3YvWU9ncU04V1JWbUU2MDY3ZU5xemRiUnBJV1hmTjBCcXNzUkJTS3N3ZU0zekl4blJ6Y3hJSEhiaXNTSDBZU0VPS0Q5ZGF2ZmVzSDlxSDFnUUlDVGg1Y2Y0Mk1VPQ==', '$2y$10$O13AXC/AKpicWLyjEhbWYOa.SnAFT.txhe5VirH30GzWJZTd5ioR6', 1, NULL, NULL, 1, 'GIZ9954331'),
('MOD2571656', 'MOD26924555698929252', 'choose', 'MODYZ1HK25O142H3C3', '', 'tU2TTv8F6qSvH4e1MZbVBlRUeDNsT05oNWVHcnVLbkZ4ZW9qVEUzMVBZRU1kZDAxdzNxSkZXNytmU1kvdXNFTFZ4S1FzaGFCTXQ2cmw4TVFrZmJMLzZWNHQyZGRoUnV2Q0IwMFFYNmNTVkxwZDlxNjlUOUZYTitGcjJzPQ==', '$2y$10$eqrRAZiR2fAiCxOShb1uDuQtvaFA6n9hwrsEGuaxrO3MvfWUnHciy', 1, NULL, NULL, 1, 'GIZ9954331'),
('MOD2571656', 'MOD26924555698929252', 'choose', 'MODZ3H2A4EXGC847EG', '', 'sh5LQfSP1tu21ET9EaHv/U9ZTVltdmJ2a1BLeEVhM2ptV2Fiby9iRndNSmNVb0VSQVRSTEg3Q1JLYlhIRk51b0doVFBVOWh4SitlUVYwS0FHWGN4V1NwZVEwVlE4L0xoMUVWMExnPT0=', '$2y$10$SvqRyDQNPk9yZKWPkw.8sODPlhuPYns41569W5Zm6K9blLoQIMqtq', 1, NULL, NULL, 1, 'GIZ9954331'),
('MOD2571656', 'MOD26924555698929252', 'choose', 'MODZE2ACW11LA9G6L3', '', 'gFCFudCHnEZK4+trcPPW1k5DS0tMOXgzRU91SFBQRE81STJZUUhMc1ErZjVaZ2Y5Mlh2M2VDemJEV0tvbXd4dEdyWWIrc1hoU2RrS2RkR3VUOS9walQrcHNwWEpUWlJKTnZqNktFT2RMVjA0RXFlWjFBZnBvYVpJeTRZPQ==', '$2y$10$yyi7LoGImGLe9eqJQdXmkuhtWnuqzAfGmb2sUPimILwJZKad3iLlu', 1, NULL, NULL, 1, 'GIZ9954331'),
('MOC2132939', 'MOD65383726273746144', 'choose', 'MODZX7A2JRZ347X2HB', '', 'QfkziNrWh+2dBKP4JNwSqlNNdXFNMUJXSVhjUWt5c1pTcjhSOTJpM0lzekdyVDdjVzdhVGljT0Z5eWxLaXZldmF6SEFKa3VMOXlkVFVVcm1EaUhUQ3JoSmlqQXFNQ1crZGZQTXd0bXMxbVZmUHJkUS9NMUQ4R2YySmFJPQ==', '$2y$10$VoIiEuQl31wUfM0mWELZcOsmUqj8rTCeAjcSx0TZdVOk20XoEWQjG', 1, NULL, NULL, 1, ''),
('PLA6232654', 'PLA81832573287651994', 'choose', 'PLA19HA59Z42T33IZY', 'PLA81832573287651994PLA19HA59Z42T33IZY.png', 'CM7MshxpPRMXYBUpsrAmrDNJbWhDWFZIc0dDTnJHWXN4SW1Yd0xWNzNqUTRveFdKT3FvTEx2a0lRUW89', '$2y$10$55RA06nIJiojVGVKv1MAjuaxZig8dfUQxeT0hn0EKbgOB6Km98RZm', 1, NULL, NULL, 1, 'ABR7285737'),
('PLA6232654', 'PLA81832573287651994', 'choose', 'PLA33JF8JY8J9JNE4G', '', 'SRpBrpGOCY4ODOofzODI9kNJRWVmNlBxazhjVXJlTE5LUUNubld0ZlQyRDFsbTF6bDIwMksxUmxjdFU9', '$2y$10$N8wI9x81IExn90n77yuo/upQ989yKTGxAM9lWdQj2jCUC/FKdwIS2', 1, NULL, NULL, 1, 'ABR7285737'),
('PLA6232654', 'PLA81832573287651994', 'choose', 'PLA3Z3Z1Z4F7IEE88C', '', 'FIHjOAoRN9f+dfs64WsQx0xPWi82UnJxMGN3aG5ld2drQ00wVlRtMVZGcGp1SmdKZlpQUWFLTnlaUGFNSHFtLzhHRE80SUpZYjZpS2YvUm9HamdmdDkyRnV5aTZBMVhTUGh6VlJhQTIxcmFqeTBKNGd2djQ0Nk1yZWZBPQ==', '$2y$10$mz4wz0i7MjJzSqU99b.H1O.gDISjJLudL9.gQc/iZAbWNnnp3XHaG', 1, NULL, NULL, 1, 'ABR7285737'),
('PLA6232654', 'PLA81832573287651994', 'choose', 'PLA42Z12EHAJ7C54NE', '', 'heFfUYIIw1Wfn6BNCfaAjXZXNThEcjNnVzNQdGUxV2RaOW9FcXZGUGZvN3B1c01HUnJaM3NrTy9wUGc9', '$2y$10$Vlu6GARoQwexl3PvhPmwwuckMT38FVqwyteNaXFjvOQtCDilng.Ae', 1, NULL, NULL, 1, 'ABR7285737'),
('PLA6232654', 'PLA81832573287651994', 'choose', 'PLA4KL4W3412M41WIX', '', 'aCTAa1/XbV09gI+plMmezUJIa0VYTEs4bWhic1lxb1pwSWN6aFlCZjFPdTFTM1lQaTQxVURuc29pTFk3RmJwTWVVNm5jWE9ZWFpiRGFtL2J5UXF3R2t4MWVUTXJBbFRYVlRVb2xnPT0=', '$2y$10$SgHGHnbvGnLKmXxqgoVnZusKIiUp7jaCdJifZhZi8EyOqyl7I7EVq', 1, NULL, NULL, 1, 'ABR7285737'),
('PLA6232654', 'PLA81832573287651994', 'choose', 'PLAR3I62M21HF479HN', 'PLA81832573287651994PLAR3I62M21HF479HN.jpg', 'rni97EqFg2WZ5XK98IXsaGM1OEt3MWpqWFJlbXBwcXJaRzVqKytCZFZ0SWhaUDMwMW5YSTN4dnQ2NlB3ZUVrb2c1U0hMSE5CSEExaUdXUU55OUxubFFVWDMzZ3R4dE5DRTFMNVYreDdqcUFISFBFSVFESVVpRjV4OWM1VVdZN0FHMFZLdXNVYTNJb1hNcFZCN2NZbUdjT0JLcGk1ci9YYndpMG5jN3hNLzdhb0NtQWdQYzJMV3NWSVFVN2g1c3ZjL01HN0gwYUlhZzB3eW50MA==', '$2y$10$B789/BUqL2u5KujDHKhcHOSpdttJyD4zgpxxbsrlj0M6pas9hVVMy', 1, NULL, NULL, 1, 'ABR7285737'),
('PLA6232654', 'PLA81832573287651994', 'choose', 'PLAUKIN29YR59HZ9IJ', '', 'PVoWUx/z9jPqGrL21MCoInduUWFiM0NubnFOSmpiak9DQXgyckk1UDNOK0Q1dE5iQVYrUDFEZi9HV1VtZTQ0aGdEd0hLZ1BiLzIrOXRkSGlsMy9VaCtWVUN6M0l2eFRBZENTTTFvUDMrbXp0Ny9LNFd6K2RHNFQ3RVdnPQ==', '$2y$10$pqDWiQmymil1FnOgNtescuZFMtxKrUK2l3pP1/vf7WJpzNyRi0KZ6', 1, NULL, NULL, 1, 'ABR7285737'),
('PLA6232654', 'PLA81832573287651994', 'choose', 'PLAX35NT1O88OR3MRB', '', '1lOR6IQD2gNjFKbClg9EHW0vSmZRSWtEUm5XOThmQmQ4MmVSZGFrWlkwei8wSjdUaUhCYVllZjFHVi9tV2pYbzlvZFF3M1FLektUWXpsZmlOeGpTZmw3MzFWZWJQWUFnZ0lOcjVpOElFd0ZZU3lpTW0vTEF3V29HYXFQM3ZaWklRUHBVV2tIK0l2T0VuTWlMT0N5Q0YrSHdLYTYzRUpCam5VN2FXK0VBUkdqeWl1V25ROUZZTUdiNVVOZzF3NGZjVnM4U1JCRnlwc2xlNTZTbFk4THArOTFoaFhiMGFHYm9ySmZOYVVJUzJmTE5Rb0VBYUZiWldTVXJxMS9iakxMV3hKcWNHdFlQWkRZbzQ3QURFRFJ1VHI5d003WktmZ1l4eXZrdHN3aStnSCthR3l1b1YvZUptZXNGQzFRPQ==', '$2y$10$0Em3fxKNXUdiuxlIZjm2l.PqpOBkXqGfxDnpqFnYszIWVhdQP72uK', 1, NULL, NULL, 1, 'ABR7285737'),
('PLA6232654', 'PLA81832573287651994', 'choose', 'PLAZ21LLKUOIX7HX8C', '', 'BbMQvpVaLeng4TcJDeTo1k9RSW4xa0lGWnJOYnRMenduNkF6WXRxekJIT1Z0Nmo2QSt3UzVVNFB0RTJLK0E5NkYzQ09jeHJOTWxFRmVmbGxlUjYrNFBFdmpOYXBnOG1hN2pDZmNIVGphNnBqejIyMnN1T29xMFNqWmowSnUzUS9lZnRjL2d0eUVoQkYxczJBMG5hNmFzczA4YUlsdmJBRHhtcERZTmFHOFFad3pmZEtwTE1tK0tmU20xamgvaVhPb3RmYWhveVY1ZklaZEFoeXl0UjN0MVVjSDBMejF6aXBwTUgreUxzL3M0VEJzWEpwbVNKemFZNnFsVjlUTHl6YTd3ZzZ2Vm1CL1gwRmNIUUR0d3FYMzY3QkRBZjdmTmtudk8veVRnPT0=', '$2y$10$3p8XpwoOOQrol6k3TOtzAe3GzRzVfT0052xiuqZ6vuDkPG/1J47.i', 1, NULL, NULL, 1, 'ABR7285737'),
('DTE3498718', 'TES87463923977824639', 'choose', 'TES17GHHFHZT4XUK91', '', 'QuBDgcmbYVpdZyVhI1XB1XVraUwzN3ZQMThockhKNTdzbTdCVlFiUSsrWGJvUm5vTE9iZlNROVF3M3B3ejRmUkk2Ni9oLzFLTlo4SExzNFNyaDBPSjVuVUlrR3BsRFNNMU5HbE5BPT0=', '$2y$10$XQn/lHAsAo47.fAa2rl6c.JZNCH9qTjKFbjsXv2Lh0r1flpqzWD0K', 1, NULL, NULL, 1, 'ABR7285737'),
('DTE3498718', 'TES87463923977824639', 'choose', 'TES19Y848XG6J4O82W', '', 'IT1DvsmxhCC+SX6JMIsFaDEreEY3Ylo3emFmNm5Ba01LSVR6UGNaQ1krSGk0VTcxN01oUkVHelVOZkRsOGtQT09sUU56RG5qZVVyZmJoK1U=', '$2y$10$86lMqSMi3xRcP2qfQmMHrut28F0NzADp3mhV3w/Qh5AfKf0zfYkXO', 1, NULL, NULL, 1, 'ABR7285737'),
('DTE3498718', 'TES87463923977824639', 'choose', 'TES1TIJTLG94144E1C', '', 'lXXYVof04krjQqoFZfdAeHRlS1U4ZVg3d0RFNXZrOWNjVnhzUHB5RUdMYUVFMU9ER2hzaW8zNkEyV1pLU2MrSjQ0T0lhenk4OFZ0b1BmNmxOa2Z5cW9sQU5VUTM0eXNxN29vK0I0NHd2RktmYWFKa0ZyS2xxTXJkdFI5di9VT2N6Wi9BY3JzcXYwV2h4RSttQVY3ZkVaeVRYS21qSjJjVnFmZWxYZU1hNlR1OUw0RXp4TWIvbnBZVWhReFVxeGFOa3NsU0VROEs3K3JWOEZRTmRZT3BRUkNDWDlLSGRNd3lWMW5raEdZd2prQks1VzNNQnROeVNsRVJGYWhlKzV3bGF0N0FJZW5IdmpDNVV1Unk=', '$2y$10$Z8g1o03IwHA148DDwXV1yeV2vqorKxZCe7.9AGKcc5btrpZu6m/N2', 1, NULL, NULL, 1, 'ABR7285737'),
('DTE3498718', 'TES87463923977824639', 'choose', 'TES1XNGL8X413G7E5H', '', 'JyzoXtQ/COdDZXddUfEouWt0OWRHQktxWHA2N3YrcWFDdHF4dEdyeVdTRGxIL2xmMDNCOVE4dUVLZTJuSmY3dm9WSDkzZjJORXNHMUlRZzlLczhPWTNCdjMzVytxc2tJNCtCck53PT0=', '$2y$10$9D96gTWeH7r5fycbphIQwOwb.NLc0ip6kHEmACGaYcbVWzH6AF806', 1, NULL, NULL, 1, 'ABR7285737'),
('DTE3498718', 'TES87463923977824639', 'choose', 'TES25AC3Z35343X243', '', 'X7X+Qffb+D9SresWw2+qXXR1SkM0ZGN4RVpRQVBEdVZlZUttc24wUTY1NlZPdUxRNXZLaDBIV1g1RUZKNExZV0srSHd2OFJiSEE5MDJFSmJaN0Y5dkt5NlpFZWs0ZGtjYjc2cUlWcmhHSHJWWTlvQVFNVnh0azExMlU4RGozenVEQlBmYlc4TitWd3pKZW9n', '$2y$10$6ORwsq4K0KTWctN3du8UxuRE0AY8YXd3IZyA.BBZMsFbz9lv0LGY2', 1, NULL, NULL, 1, 'ABR7285737'),
('DTE3498718', 'TES87463923977824639', 'choose', 'TES26JM2411KLOW26C', '', 'SoAac5FV4MCromt8Rc1pVk5heWdTbFdvWnFYZzBZanRFSGlNWGRKR3NTckpYMDVtSlM3Zndwb0d5bHM9', '$2y$10$zioQbwunk25y.LcCLi1jq.ZV7ctTnUvNVBp/Uojzn.g89M.udWDwS', 1, NULL, NULL, 1, 'ABR7285737'),
('DTE3498718', 'TES87463923977824639', 'choose', 'TES27TGIWXZ2MXC7T7', '', 'MLB53uD/J1OshJdU0Weaenk3VElqSS93bytuWGU4anZPWitPUHArTy9jN2ZHS1Q4a2szNEY2S0FzcDN3LytwWUdsc0E2a1ZVN0cvREdydjg5NFZaSnpyZmU1eGZyYmJwRkl5aXlndXlCSkhrRXdPdkNtWEtxdWQyOVhESU1GWGlaR1RnaE03Qnh2SS9ldnRrMmhYRFlObXVlc0JEVW5oaEU0d3k3WmhsVzhheVZJK3RpdXhPVkhDaDRFbWQ2eC92eVZBY0YvVnRaRk1HSzJYM0gzWTFNSXoxWnYvS1E3N0VFcWcwS0E9PQ==', '$2y$10$Ljw.71ROLrTIDOy8DOOZTebDH3I6LeTK8k/ND9qwnDBdiyjh1Mn2K', 1, NULL, NULL, 1, 'ABR7285737'),
('DTE3498718', 'TES87463923977824639', 'choose', 'TES2E4N5OW3XKZ1HEJ', '', 'TLKdejZnsZo7xAgeW9v4Zyt0c09xOEtybmFUMjlsNU1HVW53YmRyS2MvZm5nOTdKYzNYZElsYzUzTWc9', '$2y$10$KqopO/wTPKEq7Mla8coFYOF3WWHoyOywRyRjp3qeVAvvJqkVeWKiC', 1, NULL, NULL, 1, 'ABR7285737'),
('DTE3498718', 'TES87463923977824639', 'choose', 'TES2O8F672X2XYEC4T', '', '4g8a5e94dwS90sY719BzsGdOSjZWTUg4bndrMFlCVEcvaFFBY0RMQkZaUzR2S3EvQi9LWmlHWUk0bFJqRlZDK0t1dGdQNktCQ3l4K3g5WFFWS3BxYyszbzRFcFhYR2k2QUE3bG11S2I4eGJsM01zRzBpY1NUMEIzQzVHVnJUcU5sZ3FxSERNdjhobmFLczV1SHNCcjN6YXhvS0labWN2NVkwalhhQT09', '$2y$10$qhhgdvlqBtc2n5YJAr7cSOBAlrrjjU3HAORY8/WktnK1EIwk.YIvC', 1, NULL, NULL, 1, 'ABR7285737'),
('DTE3498718', 'TES87463923977824639', 'choose', 'TES2ZU43TWA9UGH3I8', '', '5xwQbNjQ5NBXN1QqIeIublJIdldOVGxxRDZTQmE2ZUN5NHd1RWM3Qkt4QTZRN0c2Z3NDVVdvc2RMa09vVFNSQXlOYjNoeTVmdHJLMkhHOEU3SHJkRHhhUER1N0kwSE93TVdoQWpYYXp2c0JPK044UldyUG9lYkMvTTcwPQ==', '$2y$10$eVuFQfUcU8GtkwKQz/Qgee8PBm4MhNUd6shR1kLVday4oUdM4CjFa', 1, NULL, NULL, 1, 'ABR7285737'),
('DTE3498718', 'TES87463923977824639', 'choose', 'TES326TJZ3NIH4F1JC', '', 'xxilTs9CVrRRN9WbCRRrOVFCNFhOQkhjclROSHdqN2NEemhyVzBVaEYxaitUNG1GYjdlV0JCdzRFMUxpbkphQ1pOUUp3QnR4UzVZZ21KMTB2T2ZwZXl0b3hYVmVlYS9rVk5MTm5nPT0=', '$2y$10$YZdbOXDuUkmrZIqdsQDMBuu.LyArNcQVMjSG8TbHP0Az40u/pzvv.', 1, NULL, NULL, 1, 'ABR7285737'),
('DTE3498718', 'TES87463923977824639', 'choose', 'TES36HAH9CCL38J964', '', 'URW21RO4+tx/LPl/KhC1Q1IyRlF0QzJYdlp0VzhqY0RZNzhROGNJMXVCTEhIOTVSY1dkMk1zNmFLS2VscVRSWFpiLzJMWWwzWkZOY2ZvYk0=', '$2y$10$0gGPiKfSChRq9EQQ.jUGqeAhEjNxKOu8.CGYIoV3f3MkvhvrsQBD.', 1, NULL, NULL, 1, 'ABR7285737'),
('DTE3498718', 'TES87463923977824639', 'choose', 'TES3723N524WHXA4KF', '', 'd5A6mDmEnMZlDEYj9HZ180YvbklYamlvNGJkVUp2UFVjbEYxdkxEOHd1eGdNeXN1Q081Ym0vcUl4QVl2dFRzUWdIVUVsV1Z6QldSMTJvY1JibGp3UFYxNyt6VmxKU2FwYWs4UHpaZHVNSk9RT3p6emZlcXZvRWhOU05qdE11ZkRoYTFSQVRPM1hvZGR2bUdp', '$2y$10$Sd8EX0TXHeWw0aE5envCGum7dEXPVAp5ODYM/xdq6aJl8X5rCb3Ly', 1, NULL, NULL, 1, 'ABR7285737'),
('DTE3498718', 'TES87463923977824639', 'choose', 'TES39I5ZU99L4CREYX', '', 'c2lASYR9L/4HfY0ftjewXEVUeng0SlhCVHltOGpJNkphTWVuaUVHNXU2LzBSR0k0N0thbW40OGFndWExamdXbTlISmQyVkNnb2p2dDdvWGN1dGYxQXhoV2JjdUlrSEI4Yk1KK0FHL2NLZ0pzQWlva2tScndoT281VkptOUl4NGpERVo3VGdwKzB2d3huY0h1dFowekladElBOHZDUG9wY3N2L1N5TGFNWWJyeWpIYVZ2RDFnZVBSbGc3UTRnQktab0Yvb1EwOWcwdy9haXEvUnp6SEdaWiswdDlScjlXVCtXMXVNSnc9PQ==', '$2y$10$kxuWrrLoaXXvUEVjepdNj.FkM8wfMEAV3a7fVYWT6jsRabXOwBwbu', 1, NULL, NULL, 1, 'ABR7285737'),
('DTE3498718', 'TES87463923977824639', 'choose', 'TES39Y2CA8FFOJR3HB', '', 'QrxMPfZlAn4aB4tK3HxwIEc3c1VQTW9VTmNBeXBvQXp5L1BxeEMxTzFNdXpWeUR2bGd5YyttV2FyalJRQllYYjhDcDhWRE5tUStaR1hGQzVkRndMQ3VhRVJZakhQNjVYVStiVGNRPT0=', '$2y$10$5aqt11dV0kLlJAhG2Na0OOPztTdHjZqpht4i1DyENxCUPBdPXO99i', 1, NULL, NULL, 1, 'ABR7285737'),
('DTE3498718', 'TES87463923977824639', 'choose', 'TES42EUOXJZ64OREA3', '', 'fMuuUEgywIPFbK12gfwOz2hDWW0rREpnQk93TEViSVJMQ0E4SjNPQVBVY0gyaHp2bHVrTDNWQ1hsWTJUNXY0TnBOTndlVDNvUUVweWNoWlZTZm9lMWEremFqdFpPZVZFNWREeCtlYTkzNCthbjlTYUplU1JnQ01oNE1JPQ==', '$2y$10$TT1STooy./3dOxt32ErzNuhXEh0U.KQ8Kkmy34SR/3aq1IoI5iz6u', 1, NULL, NULL, 1, 'ABR7285737'),
('DTE3498718', 'TES87463923977824639', 'choose', 'TES432YCY3JERKFXG4', '', '1xlwKist0C59gOSgzEWrZ21jQnY2YXN0SmJSTmR3dFNpUVJEeXlJc1haSDlaMDM0OWpWYVVvK2ppZEFEU0JUS2t2dDNnTnArb3RaQjVWMmhNV0V1R3hnWHhzdTg4MUtabFczVUVRPT0=', '$2y$10$rqgxODJQrLeFHXx7.bzVYefCMMv5pXzcaqGaEqzwUI49YGXR5h3jq', 1, NULL, NULL, 1, 'ABR7285737'),
('DTE3498718', 'TES87463923977824639', 'choose', 'TES44438LTR3YHII1O', '', 'tb5px36jBk2J9uFjWydU8Wo0ZDNYT3p6bDhrMDNIbEhwaU1mV2JHRE1Qbjk0aWJCWExwdmVVR25pOG1WL05heWJQNmVzZW5ZWHFTZEhJcytaQStCRURmNkRyRzU0ampyUGtTRk0ybDFaa1FpUEMybTdoR2V5UmlRdCtWZ0kvcDBlZmsweVNDcDI0RDNyZ3NJQkZXYjFTNWJkUE83YmtvMDQ4dUh2dz09', '$2y$10$9FvCUIE/H0Pm97tZmig99uErFVgAZsmgGUItZ5AQC92a80rkbNwJe', 1, NULL, NULL, 1, 'ABR7285737'),
('DTE3498718', 'TES87463923977824639', 'choose', 'TES49OG3WJFZLEZ4NI', '', 'PVDMmiqslOl56BCYa15Sp0Y4dXcwYkZMUWJtSVVwSmw2c0ZXenFzS2d5aHpKMjZYVW9YM0ZkbS9OalJ0ZmE2bG80OVg0QXMyU2tYTmhhNndzNDlKaGh6elVYcVRvVXI4Ly9FRFZRPT0=', '$2y$10$23U6f24l37tR3KYGxJLYTOOPUEEk/.UYqbIKLfyOBl5941nOa6bkG', 1, NULL, NULL, 1, 'ABR7285737'),
('DTE3498718', 'TES87463923977824639', 'choose', 'TES4G1T6H31Y97HTE3', '', 'dHpXQVApCQvAda1oU2uA5Cs2eDU5TnB5MHVBSC9LYzdSSXJPakNlTVpwTWhkMDJDK1BQSHJRbEpqclE9', '$2y$10$g8mkntzRkG4kip/fS/CYiO9HucZ8LVAkssVVwjVGqeNHVVLf9i5Qq', 1, NULL, NULL, 1, 'ABR7285737'),
('DTE3498718', 'TES87463923977824639', 'choose', 'TES4LJEJI12I2XFZNJ', '', '4Ng1FvZdj+GBG+o6rIaPEjFLbXBFVUV5czZuakp5dVBMM0xBeHB6Wkk3bm16Rm9uSmppSDNWbklKYWV4SDMyMDcvMk1YSlhrazdpVUUwL2V2K2RpYUZjMUphL1c2Q3NSYWpDOFEvbVBNTVBMQ2dBdW56d0IvbUdPUm1GTTJlSW9VZ3BIR1NzdnNORXJyK1FW', '$2y$10$EayV41.u8OYzHXM1NKKEZOhyGH2T6IBR0gOtivJIfrQH0E6uTBcRa', 1, NULL, NULL, 1, 'ABR7285737'),
('DTE3498718', 'TES87463923977824639', 'choose', 'TES4LN3XR723RL9KEL', '', 'Rh8Aa08QRUgdSob6irmZRFA3U2graERFSmJtUDgycG9rRFh6VjJpUWFteFpxZjBVRUNxMGhyN0YwM0dyRHAvQkJsc1dKbmF1YXk1RWpuQ3BoZE95YXFCMm1CQmFqR0dRaHlka3B3WjhGd2s2UEZvTEJiMkZudFdHdmxtdDk3S01FOVN6QndUeXZLWTB3dWh2', '$2y$10$osBY.oGduy/quupUVCTMq.tDE6BnZXE5niWhFc58elAE13p1XLjE6', 1, NULL, NULL, 1, 'ABR7285737'),
('DTE3498718', 'TES87463923977824639', 'choose', 'TES4OH7318J63XIL62', '', 'R0Jx/mOldGZXHsiR/aycTy8xQ3VMWTJGc3hnNENLVEw3SEttZE9uYzJKRGJiNGkxQkFnbDdpeVRvbXcvSHpXaExMQkwvamsreW1YcXJ5dFE=', '$2y$10$6ZoLZaW81kVUKDWkoKzEV.sMlLP08OUOzKTbM23Rj17CduGWfp1Ou', 1, NULL, NULL, 1, 'ABR7285737'),
('DTE3498718', 'TES87463923977824639', 'choose', 'TES4X1HG327JM4642G', '', 'HR88gHYzdUSWF35GRy3ammFKaUlHWVh6ZWZxU0luSnJVT3Z1QUJTdW05M3ZyMjV3dDhCMHozdHlyQVc5YytFVmE1OW9Zd1JVMFNBU3o5U2xZektuMlB0WXkwaG5aZ0llVEdLZ3B6TEFPRWlWcTFIZDJsNWgydnJ5UkFtRWlmUnczMUFKTmY0cTQvd3JrVGtMTDBzWTMvckw1WXYrSUlxanVGSnRlaXcvVlJSOVVGUjlFMlQ1b3VEZkc2WT0=', '$2y$10$8yrVePt5a/03sGN4qGsvt.3FNyw86Qihycs/ES3IJ6eAXvxhEnLW2', 1, NULL, NULL, 1, 'ABR7285737'),
('DTE3498718', 'TES87463923977824639', 'choose', 'TES5X2EHAG7OOBR3J3', '', 'qdCdcV1NMOm5lkUG4CVR/3FxOUZiSEJyL21uRFBodlYzL1VGdnRlS01SZ1FmOTZyZ0gvL0laMCsrcnA0TGY4cnZsZlRPS2RMY1FFekwrYkYyZTNWY0RMalhzRk1iQVBMMi96WGFnPT0=', '$2y$10$geLs5mMVojgcSEpiX1jrqu6PQHgQrLZTPuh8vyzQ5fQOgDxilZaUW', 2, NULL, NULL, 1, 'ABR7285737'),
('DTE3498718', 'TES87463923977824639', 'choose', 'TES5Z1OYU26742JH5W', '', 'nmWuuZmK6af6L6ZBrASIFjFncWtGREZ1K1p0b1pSMjdIckN5TjJyTkZubWdXOWZVVExXdVBOWStFaERBTjJCcnNGbXNiWnZpN2NhbDRVbFc=', '$2y$10$d0oKSjAlLVIi99HmIhCjkeGKrie5lUHVTUwVYldAZOE7SwtwEYRRq', 1, NULL, NULL, 1, 'ABR7285737'),
('DTE3498718', 'TES87463923977824639', 'choose', 'TES61JNJ12J1HX1O3M', '', 'leH6FnvOhtTmc01XnZsctFhmcGJTS1JEVkRlM2taKy92cVJ6SjVYOWFNbTA5US90MVVkWkh0YjJjYWJlZ1dNNzQ2RVdqblU1Ykd5U2I3R1dZMkFUS0tvNXRtc1lwY1YvZDVkYXM5R1VGRDVuQmw5UEtxc2dYQnNYc2hjPQ==', '$2y$10$.DS2zBDvwEwmco2VwboISOC6la4C8NMn.F3AYCHqQUAI7Nb4eZrWW', 1, NULL, NULL, 1, 'ABR7285737'),
('DTE3498718', 'TES87463923977824639', 'choose', 'TES65HG71HY87884KI', '', 'SeUTH7vwnc4Hohg4VTRMnFBsMDF6SjB4WjN5em52dmJwYmhRUXljTHo1QmgrZnI0SEJjWE1SUmRCWWFrUXZGdWxEem9wSURwaEFKMGV6aG83L200QkYrdVp0YVpSWUZ3Qk8vK2tLTDNUYjRiM04wNFNXSGhrampCWlpFPQ==', '$2y$10$HM1ZAsmvwdbBjAZG3q0nWO6D0JYK8nuSKXwt5mV9LSA/Nx5hGqlXO', 1, NULL, NULL, 1, 'ABR7285737'),
('DTE3498718', 'TES87463923977824639', 'choose', 'TES6JIJ79139T4RM15', '', '+3PeZmFraxWukrxnpE61MHdhMG05YVN4cWFheUxQVEFpcFJ5b3pJMUhCTzNtR2wzZ0ZkdTUwaE8zU29qNXlSVktCVTloaVYybUR5MWRXVkhQM0w5SW44Y0NERm45R1FrY3pkZFpNcC9jeTZydzJmZDhvM2VseHY0OEh2YUdKWmJqQ1lPeVdMR3ROUEZkMjBEQ0hhSVlIajJCU1g1em5RUXlmQ1BJQT09', '$2y$10$jACxXYKm4DdC5O5zjrLYO.dnd2wyCHOB4JydA/O.W7GxZ7k2e7VLu', 1, NULL, NULL, 1, 'ABR7285737'),
('DTE3498718', 'TES87463923977824639', 'choose', 'TES7988R34WGYEXKER', '', 'Xv9yrzv3eEiaxo7M/P7+q0xwS2R5WmpMNGNtbVoxMGRKUFVoanRUdDVNTDdjMUljajl0Z2x1Z1pGcWYwQVozQWk4MjNYWVhyQUlQNkNUZkVIYnBqYVhVc1FKRTBxSmVPdXFhcS9RPT0=', '$2y$10$RkJnEhSBX563LdhtLdGz1uizFxcSwW4uR2C.vozv5Ii6pwgU3HeWC', 1, NULL, NULL, 1, 'ABR7285737'),
('DTE3498718', 'TES87463923977824639', 'choose', 'TES798T34KNXG13B9R', '', 'szRtxFDXhzw+12e8JVWNv0Y0L3lBT3JFOGNkQVY4WUVab2FyUEpyVjBzbVc2ZmxmbFE5Qkl3NnJZclZtQkk2TkxQV05EWG1BQmJuZ0lpdGtzWG1xZ3RUU3JuL3pjdmlsb3luZ1RHemMzeFhxaVBJbnF1Y0ViY1hIMWVVSDI4cnBma3BZZlQ5dWtVaHB1L0pM', '$2y$10$AUQ8l8VUdHA9FsJHuBflf.TuHvMEAMo12nSgnhVm1e0UVAafnRDde', 1, NULL, NULL, 1, 'ABR7285737'),
('DTE3498718', 'TES87463923977824639', 'choose', 'TES7AX4IA45779J833', '', 'kFkfcubRGeLOx1IobQgLonhaTzNRV1dqSmU1WUxDVXA0Rzd5T0pHWjlzSzhMVkJWMzNUeDV6WXAwazVDNitUdXM4aXVYdDlidzFTdEpDZFdwenBFaWN5L21iV01OMi9SRGh2ZS9nPT0=', '$2y$10$iLzk/evq.711f7jFxQVPXuA.kXJNEH70jkWPMLrXEZ0ylGAvkGDyS', 1, NULL, NULL, 1, 'ABR7285737'),
('DTE3498718', 'TES87463923977824639', 'choose', 'TES7FM94XIF3N2E32E', '', 'dPuCvXoWfSa9wVJ82imw5EsreGZyUWxKZTVNaFhkSUhnZjkrdkxvb2ZOdDJNS2hPSjNCK1hZODJoWGJCVkdkbVVQL2xLMmU5bmZ4TUxaRlNvTDhOT3doK1RzdURMSWxGZ2V0cytnPT0=', '$2y$10$MlfTQ5YwbEg/6klziGAp9O.BO0L8UMT1LIrcXyI4ce3P0WpVQkLyS', 1, NULL, NULL, 1, 'ABR7285737'),
('DTE3498718', 'TES87463923977824639', 'choose', 'TES7MG1XZF9ZO3Z3Z3', '', 'S0OrOg7xp2dGrMkOURjzvWxYN2REZGd1LzMyajdDaHZSYnZUMXJOcmRCOXNLNFFtcThVMHNFYnBDZUc4bzFTdGRtYm9YZ1YzeFFvVVI5Q09sMmZrS0ZxWXM4VTBuVmE3ZlB5Y01TNFRhSThFTXNQekNEOTFNV3pwdzRudERORy9ZT29XT3c5N2dhdEd4OEphZHVJSktKcnh4YjZhcElOaWxZUXVNZndSZy9rakwyL3N2NVNnZS9CS3l0ZXdFaG9IK0RKZ0hTYkVvcFA3ODVYTzc3UXh6ZW1nbloyUGNTNzllSjhDNzVvQ3VIRUVQcVE1VTJLVHhIZ0tIRzA9', '$2y$10$dpUcVLQauVlQ9AVH..vuEeisjfh45uU5Y/xe0LecuSEeMH0z9wX7S', 1, NULL, NULL, 1, 'ABR7285737'),
('DTE3498718', 'TES87463923977824639', 'choose', 'TES7T3RE239GYXG88X', '', 'CaIyrNjpzDiiS99y2XnAPXRud1ZHeFp1VTFaQU9FWFVzRXRVVU9wd29LaEZxZ2t1eThnQWp5T205MHpZckYxQXVheStiaWV5bWpYRTZuNDN6Unc5dVQ5amlzQmZUQXpiSUs3cHpPY2VhUDN5ZGxmWEdZYU43aXNCRXdnPQ==', '$2y$10$yOxDn3ZeVJcR7RZbonWl0OSRoeeMeYGi5Di3WpwThrvWqv3/ysIqO', 1, NULL, NULL, 1, 'ABR7285737'),
('DTE3498718', 'TES87463923977824639', 'choose', 'TES7UJWW822WCNN1JW', '', 'rYES42O+In23gnY+v5f0ZzJVcC9aUHNmVmR2eEQzZS9vMXdNVUZuUnBCRlZRU1lCRVJVd25hVkQxcVE9', '$2y$10$BSg0/mQpy.LDHTEPg7qAJeB1UHK1JS.6NloxA5X887ap4BNxB4.OG', 1, NULL, NULL, 1, 'ABR7285737'),
('DTE3498718', 'TES87463923977824639', 'choose', 'TES7WM8A9WXTU2B43C', '', 'MK8lVHecGXkZC/z8b+QeL0kvT3BvbnhTY1VaT1E3L1VSUElQdWpjYlg5NXgzTTIyMTVUSmxCZ1RrTXlycWZJWnZ0d3JwcHZ3U2JwMkhaWTRRREJpSldRNzlud01MenUwM1c5YjQvQS94Um5oTTI0SXNHajZTVmkyQmNtQUxuOTg5Tjg2aGZ4WUVkLzFxVTROYzIvK0xHMnFaSkxWNitINGVpbWVVOHdlWGQrWWs0a3MrZ0ZFUVFyRmlNQ1FGT1l2QXNDd2ErZVhwZGJ0ZEJQLw==', '$2y$10$qjGgVkiB2uNVfOqers0wB.eXkNfDq9VkeRR05YV1RwBwu8Oq3LYP2', 1, NULL, NULL, 1, 'ABR7285737'),
('DTE3498718', 'TES87463923977824639', 'choose', 'TES883XX2L2EETGBHN', '', 'kcpa9Q36QV5lkJaospUl23lPRlljd0xuU3Z2TW1Gc3dYV2k4dGRQbmIxM2MzUEEwM2VyeDMzWlZXVWhRUmtOMUMxU2g2T3h2ZEd2S0pmcHoyWlcyNjF2am9HU2wzcFprY2NJeVB1OG5DaWcwOFh3TEd3YVZ1dnpZUFY4PQ==', '$2y$10$T79eVR3pedSvilS.zEJSS.uKwKzsrYs40RZrGBe4LQvdYj3OdQE8W', 1, NULL, NULL, 1, 'ABR7285737'),
('DTE3498718', 'TES87463923977824639', 'choose', 'TES8889HRG92UKH64A', '', '8YdkYZPE6XUo4YMSPIdQdzVReUVLRXYxa2VQT1U0QU1TbnBNOWZvVjZnb3Fzd3ZDQXYyZDg4RnV0UmtUdkJJSlBpL1U1cURnNHphL3E4RjJIWW94VUxNRTAvbnBJakoxT3VjNENVcDZ5M0hpOEx6aXV5WkhCVWN5NW5tYVRaR1d6R1NKMWtic1E4Zi81MGMwdlJYcXVXSVA3eVdEWFZtR1hPVko1QXZLZnkwam5DU25ET2djWFdhRkNtRT0=', '$2y$10$apqwd2a4EUL1ssfSyhlj/eJxQXiP5j6kQxKh0rWtxHDzyq9oX6kj.', 1, NULL, NULL, 1, 'ABR7285737'),
('DTE3498718', 'TES87463923977824639', 'choose', 'TES8BO83GOXLG1TIXG', '', 'ZR5NHZTfQ2HzjBSNTTw0yXEzRHk1dmc5cjhKSEhaSXp5dEpkVmoyWFdiOW9BWXk4K0psUllGUVNyRmV0N00yaFIzS2x0NXJJdDRjY041K1R0VzlYaDJiS05HaVpmNVhMb3JRZ1V3PT0=', '$2y$10$ac12J3kyda7ZGXZGi8/WsuyA2UK0kfJBAaOGW76hkLy9dPsDWXu7K', 1, NULL, NULL, 1, 'ABR7285737'),
('DTE3498718', 'TES87463923977824639', 'choose', 'TES8L7E14N8YG1WTU5', '', '2NaevB/6rJh+gqRJbh2GbTZmN2RwbzEwZm1RSnRRVUhZSTZMeFdPWkNIbHFpZDIvY0Q3bmZnMCtHWDE5cU5mcHhJREppOUZ1U2J3b1RNV0J4NjR4N2tySUpHYmlUY2dzTmNncGMvVUNzRlZvR2xIcE83SHRLZk1BdCtWN0hPSUZ3QURrTmJhdE5GbWlpaVJ3a2tBeUZOMzFPaGsrNk9UWWZhODlEdjNudkJFWVVRMmg1Q3hsUStmeWs4VT0=', '$2y$10$kTMaTlvuyu3.JeCUsiV.D.JXs6aTaQJVw5zUe9xBlhoz1HXBGRLCW', 1, NULL, NULL, 1, 'ABR7285737'),
('DTE3498718', 'TES87463923977824639', 'choose', 'TES8LYB344FBGFR1Z6', '', 'QeYkGkBnnhSVY088W4zpx3hnQURJc1BWTmxoMFdVckpITUk4cEZUY2ZXc094aG5SRTBXV25vdWlaaDJsU1VOa2lSRnBrdDFrbzVvdkFFZHpZUk90UWtjcm8ydnJkMWlyMTh2aFNRPT0=', '$2y$10$mXeC8C.dZfoGpsugvVHrNODvPxjchqimNsBVCsebpX2YfChhM3OR.', 1, NULL, NULL, 1, 'ABR7285737'),
('DTE3498718', 'TES87463923977824639', 'choose', 'TES8UU1W914188E9R3', '', '3ud2LMsAM68z1Y0aZa1yCHJrL0U1Zzl5bUJkdjF0MUJiZlQyZ1RDcFJuTkQ0MGhlYnV2aE9pNFZzZGc9', '$2y$10$IkcqiD.fggAztTd3DJymse.CLsPZ706izZ1WDwpnroCK8E5zrcylG', 1, NULL, NULL, 1, 'ABR7285737'),
('DTE3498718', 'TES87463923977824639', 'choose', 'TES8XOEF23M881N4LY', '', 'XcyVBtYQ8wway73CxddX0UJCdTg3d0VkaXVjWEZZNm83bXhQbncxU0YyNTlFcW56czl0bjRNN2lxZlc5aS9KN3FmekxtLzJXQ1VvMXV2ZnB6NUZodTVVb1VndC9FUTVPOWJLZVp4cUg0RlVlckdyMGFDcFNRTC9za05xV3I2Z1BENitzTDFGSzV0TG1nWmhyR251dHNhQ2xPanpqVlF6ck1ZTTdsUT09', '$2y$10$xfMKAaiG5W0ntgn7yVn5Fub1s82GWw8VrhpkrCvEtHhrfs7kHu4Ga', 3, NULL, NULL, 1, 'ABR7285737'),
('DTE3498718', 'TES87463923977824639', 'choose', 'TES8XXFF98W2YIUJM3', '', '7MpRqSnAvjRhgIQkjbd7tkcwUk9SZ21tTnBTaW50aGNjRkxjcnB6REEyOXp1bnJKYmdtS2ZjKzNvdWVIRmt2WUVvd0dyL1dzSmtWU2dpU0I=', '$2y$10$sbD1Dmx/rNudT6y1/zYWuujX0aprs3TiFxTAJ6Yk2wa1SeGTq7crC', 1, NULL, NULL, 1, 'ABR7285737'),
('DTE3498718', 'TES87463923977824639', 'choose', 'TES9AT38LC78GUH571', '', 'IfJGhdXzjE0TvVd2ijhDcFY4SlE5OFJoZFFsek1BNnVFMDIrcE1TeXJCbklNR3I3OUY3TC9FazBNR3o4d3J1cWJqNlYrcVJkN0RjMHJRdlhTM0NsYWJlRnRsVzd2bERLMzBBY2hnPT0=', '$2y$10$01t104FhX2Da85HUmel0KuBrhRiQQevlQrKzmiyO0JJYqfwHS8GyC', 1, NULL, NULL, 1, 'ABR7285737'),
('DTE3498718', 'TES87463923977824639', 'choose', 'TES9CO4ZC61N7B73M5', '', 'lEHojI4027KIZUlyAcMxIlBEL3Z3dGMzMi9Gd2l3cG9IbkN2U0JaWm9lbTZYTlBEeHBXSnN3c1VwaVA0V2prMUJmTHVMdGQ2eXlXbmVTTXVibi85VTdPRUcxMDRWdkJEYnZjY05yL2FVNTlMVUEyVWdOZXc0MXJNaGpLY0phQmZ5ZWdhd1YyZHIwVjdHV250Nk5ZRDliK3UwbWlwMXIzUFEreUtUWTdNamVtN3dzcU5DQXIyRkFqU2pLbz0=', '$2y$10$SNXMJBrbYWWycq5hjibVJuuPMoXg5gGqs12BrXOOKkII9YxKidy5q', 1, NULL, NULL, 1, 'ABR7285737'),
('DTE3498718', 'TES87463923977824639', 'choose', 'TES9E4HC2RHFHCHT7N', '', 'eyRY6VyOFd1zMP9pfZ4CCFpHWWRDVFRnaitCRFhrYlpyMjFiN25TSmxkWkdlUHh3ZzhzN0JpdTROcDNpS2I2QTdXc2JzK2h0dERRUDJFTno5OGt3REZKR1dtT2FRcHZOUVY4RXRMcmVhWjFOL0J2QU5UcklpcUpmc09oZXF0c0RVQy9hNS84MEs0MW92NE0v', '$2y$10$MmAp4zzDOmXXg0QKjbnf9eDw5XGt1WnChX4cYPb7LRU0zhyubLL8.', 3, NULL, NULL, 1, 'ABR7285737'),
('DTE3498718', 'TES87463923977824639', 'choose', 'TES9J4Y7J1JGJWNJ7W', '', 'c7/WuY4MD3soei02lW4G9HpuQ0FXa3EwbFQ4Q0ZYa2FpczUwREFxRG9mbVJWVjdaTDlZT3NGcE1ONXdDVVlvM0JpUDQreUhGUFVqWDNIRVh0SDUxL3M5cmJkU3V2QkRRdk4xR3VzUWh4cVEzUmtEZndtNWltNHp3L2M5YVJNMU9XcFBiNWNjRjdmNXptQzA3ZWw0QzdjZ0VxSHVGWXZYWUxhQUpTR01pYm1OYWpxbDgwak40b29sY3lxdz0=', '$2y$10$C4W2lxTrIyQHoExXjEKkxO.EB2qVH9c/pX7SVY/esiQqmTkt9WRNW', 1, NULL, NULL, 1, 'ABR7285737'),
('DTE3498718', 'TES87463923977824639', 'choose', 'TESA2TM8I44XHJGROJ', '', 'z+Nspmrgs1MkTcQAdNbcmFppdVlyTG11allwblBPNngxU3g3V0k3a2o1bUNRUWNJTWF6SXlzM3hMUEhYR0JPd3JLRmdoNTREb2w2TkU0OEN3cGtobjAwdWpQb0tUYTZkUktSN0RBQzlFMVJWU0lRVXZNYTM4UjFTTlVZN3FveEdUeDJaSTFQYWtvMUtxUXIwWHFWNm1FeHJxVHRabGxKa2gyak5TUEkwelBQVG9oS3AvVkMyQW5yQXZJKzlJck5WQUdUVStHVG94TmgzeDhIdHVMY3JYMkw5RFZYUW1PQ3ZSd1VjaFE9PQ==', '$2y$10$Phmcngd6Yn3ApMNFwP2GR.eZfeacTRRE2/1MSnVHe9Bk21Ya3MbmG', 1, NULL, NULL, 1, 'ABR7285737'),
('DTE3498718', 'TES87463923977824639', 'choose', 'TESB47AGCMO547UMT7', '', '9oT9FRKz5ebzozEAuxkO0nV0eU1vSjhVNkFvMEErNDRrWTNoTUxINURTWHkwSC8rK25sdkF1c1NsS0g3a2U2dm1SNG1JRWhtWFp1blEwUnlqM2ppbElqOTJYUnlWYVJZcDhkRmFYVzBwbnBpb1RLbHJnZ1JGakpWYmdsaWlFTnZHS3NySExGaEN0MTNtMzIw', '$2y$10$Ed7vvfEIOQcAvblLzTA8B.6QCbT7DAJKQw2qAPX3E4sdeqKjrNaR2', 1, NULL, NULL, 1, 'ABR7285737'),
('DTE3498718', 'TES87463923977824639', 'choose', 'TESBK2G2CGHE7G46H9', '', 'Bv86k5etugAb4epF0ic5ZE0wZmFoa2NUdHNSMis0U1BkS3EySkQzL2EyM1lieVliclQydzRrbzA3c0ZGejNsVUVwTWd3aTlIc1RKSkYvOTE1VGFoMnpRa0VVZi8weGJGZDl4KzlnPT0=', '$2y$10$ieSN4sQuBUj5PVvkKobdmO2otiVTmLhOQwBbNdlezN1SOV1Y5pin6', 1, NULL, NULL, 1, 'ABR7285737'),
('DTE3498718', 'TES87463923977824639', 'choose', 'TESBKJX8ZEHJ73HN2X', '', 'vG9dEjX71T21ZFZ/VSq7MFVmQWthSkZKQlIzMkJHSnU2L0Y0c2ZsdmZjbXNHZFlGcGdNdnFmUzduMnB6RHplbytmckZKa085ODZFY0EvWlBiQnkvTGJBek5sZ0V4Wm1rZ3RkanRnPT0=', '$2y$10$wF4d3J4MuLtvv9O8lbK10OS9GvZ8vFcCHCzqmCNNKHEHujTANzPu.', 1, NULL, NULL, 1, 'ABR7285737'),
('DTE3498718', 'TES87463923977824639', 'choose', 'TESC2TU226X5Z7N4RJ', '', 'fbJIo9EtFoSL5NgL5BRUQ1ZKSlJ3dy9Bb1R2WTJHc2tFM2k5T0xRQm1oT0JmNEd2eDU3cUNUV055Q0VlUzBqUWt4ZU9uNzBuN2VNMUl4WVZITng5V2pEUW1hdlNqMVB3V0t3U2x0TkxtMU0reVRRekw0bEFaS29vaFRZbTNLNDFNbHkwSmVKQm1ZSWFKcFFr', '$2y$10$Tj6mPqz2XTxK5zypcsruwep4Rh5v1M6vxA5mdZcFiOuum/XkUXlle', 1, NULL, NULL, 1, 'ABR7285737'),
('DTE3498718', 'TES87463923977824639', 'choose', 'TESCZ4GNCYX2ZKK149', '', 'zNXWBKIWsSxxdKB7lPbwjGIrVVA3cHNWbjNDSUxvdURzYXM4bWFyVFV1T3BzS1ZMT1dQUTFBcnN1a0VqdDNLYUVQQTBQOGtZYWdONG9LazJCZjJqQUFDa2RrQ1NORUs1TExqWG44M1E0aVF1WDBicGV5eU9MTTV0NXlIdzZqWDAxQld3elFNNmFUdDVtQmlD', '$2y$10$G3wRyoavLn2Wy2nwUyR5t.nbf9zJhk0kHKJTAvEVj42Ir5.uQ5JIO', 1, NULL, NULL, 1, 'ABR7285737'),
('DTE3498718', 'TES87463923977824639', 'choose', 'TESE2A2NTY626J5T26', '', 'SLZZlI6/7TsFx569WQSKE3ZNTXpaUCtLMnYweVkxQUIxYm12OUNNWTRzUy9EYUprWGJIb1A3QS9NdTBvSXdIYWNqb1dwYkNpdUI0eVJBcmg=', '$2y$10$Ufk15rD3v8X1jNf1I9Y8NOGN8O9zolu6NByGJAH7JGsIc/W2Sjweq', 1, NULL, NULL, 1, 'ABR7285737'),
('DTE3498718', 'TES87463923977824639', 'choose', 'TESEHNJ7W1AO1Y2CT7', '', 'lyPW70zUsA8IXSrw8gNJsytRazA4aTBTOVJjNVRxUGg2UVhYODhzcDEvUk90VEkxT2o4bGwyS1hCdzZ1U2VIVFlRcVhYcklRYVZpVVIxL3Q=', '$2y$10$Kyrft5zWye1wy025P0fqJOGv5q0gTGKN3FtvYADe7poaPrggYHyvK', 1, NULL, NULL, 1, 'ABR7285737'),
('DTE3498718', 'TES87463923977824639', 'choose', 'TESER8TJ3UJMJJ5EE4', '', '/SH1PNlT2vzshdS+lV77ZVRyWG1McDdDMlQzTTdObEREMzR2Zlo5QUN5UExydmtnWWw3MzNBYU11VTArcjRWQVI2ajFMVVlvbExXcFY2WHk=', '$2y$10$iRsoawxL7dA8r00frZrcqeFe6C/7aTuUT7xspVVV8AuW.CDWfgGxa', 1, NULL, NULL, 1, 'ABR7285737'),
('DTE3498718', 'TES87463923977824639', 'choose', 'TESEW73EKAG2B3BZL6', '', 'vyDkeX/1BvtiHhpvpiAdi2hZcVZCcmhTdFdKaVFkSkd3RTNHQVZ5UHh1R2RCYUEraGhGOGhndXRpdVB5emR3Y3dWQnd3Q1pmNzNxUVlHQmc=', '$2y$10$VSupnxXuQLeQ8NzhJEiDNexGSASyDSVlEBh42qFJTX2/vBSARyIJy', 1, NULL, NULL, 1, 'ABR7285737'),
('DTE3498718', 'TES87463923977824639', 'choose', 'TESG3EG921AHJE443W', '', '76lSJFpRlxq9pwG8uDGVa2xJUmhhZE5TM1o2ekYwVy84SlIvNjNkcW1FY3JkcXd0NDd2b1Bnc2FnMU9sRWhqdzdNeFJhbDd0Z0VyMHl5WGN3N201eFd5emI1WCtmeU1WS0FJL0FWL2VSL3NTYlFvS2FJL2c2VnJ1Zmc2TmxVbzVvbXdIN3BNVmhTVThVRGdkY2swM2czWXZLcVFpQml3aWRwQWRPU1dVUVdnd01WekZjL0QrSlYzT0Qxb1VtbWh3bkpSNUszdjlWdkMwOVh6cQ==', '$2y$10$eO01847Ph4Tbc.xFPheMs.P8NlGkASgV01bcU7Zx.q0Ie6Xw0L6r.', 1, NULL, NULL, 1, 'ABR7285737'),
('DTE3498718', 'TES87463923977824639', 'choose', 'TESG9UU1RR2T673E7U', '', 'VyIQajZCMfw5WG9p4UBmbGROYnNqT29KVXlQczZrdFVCbVNzTzhDNy9sSDFJekpoTVVNQitKQUNNaEwxYmZTZUpPQWlMN1JJQ1l5TG1ZcXRHNE0raUFBL3lQamM0YnJKbEtQNnlRPT0=', '$2y$10$SD1ZmN.pCHZPo7KNBddbwu33o78UZ36vbE9EMDjQAL4QgPUtHoBB2', 1, NULL, NULL, 1, 'ABR7285737'),
('DTE3498718', 'TES87463923977824639', 'choose', 'TESGEEGJJ94ME43ZHE', '', 'Fns4H0gYfcnZOWoaiCNjcElRQ1Nya1orcUlvTHRRL3YyRHRzbWdrQ3libEQvSXBVVXQ0TVBHSlRXUFlPUFlKNHh6TlBBa0lFVVZoeFlwOFhjREhIcUNCbUJTMDhBemduNzVLd2pMcWM3RHZUdXlwbUJ2L29LLzRxZHRmaG1NRnlOclRyQ0drcTk2UVdLZHlzTlFpUjhFUHJhWXY0eDJQdng1RzhRTmczUzVOSk80RFZpQU1IT1RWS1dGTklDSE5LR1dVRFUvZko0Z1JobmpzdkN5YnJHcFhWVDNTQXVMTmdDQUlHeEE9PQ==', '$2y$10$wU0/5/MBbjT7NUe5Wd4fzeXg9aiLIZUx3bkZ2oPE7Qhjm8O4dZgvS', 1, NULL, NULL, 1, 'ABR7285737'),
('DTE3498718', 'TES87463923977824639', 'choose', 'TESGGJ2J6L9ORGGTML', '', '0fHN7vt9Dw1nWakiiDI7mkFnNEJ2RFpOUTRib1dXVi9oNGpCaGxqUnkxMjlUMjI4aUtFUlBzK1kxWlc3RUp5b2x5dWlwWUtEV2YzaTZCeUFpL2NmWm5Xd0Y5RW5uMzAyM1BFbXUyYS93RGVzWTNkNzFoaDZtL0VoN3IvVWNVbmppYmRoUFhpcUVXNG9ZK3B2', '$2y$10$clNDq9v7A247tVii5hHT5eoGfXOG/QDtPnDklDMOD5JZWVUxmT6Ni', 1, NULL, NULL, 1, 'ABR7285737'),
('DTE3498718', 'TES87463923977824639', 'choose', 'TESGL9C7GN3RB23LE4', '', 'mQFCJOvDVlFmNxsvftF9pVRlaFlNVXoxY3RPRmh4cE92L0NjcEpQNnpaektqNmlac0kwSGtGazlRbitySHJnd1VDSjNTYm51UFgyUkIvTnFkL1ROT2hnWmdGWFM0aTRzV3NISEdzM1U2V3lWeVJRNW14VHFTK2Z2bE5pRXRrZGs4NUJvdXVKSWd5ZHA4MEpN', '$2y$10$PhNPeswVEtwgZTj6XCZ.E.fRM1qcS/CNDaBMvJQpWeFl4tOkSy6SK', 1, NULL, NULL, 1, 'ABR7285737'),
('DTE3498718', 'TES87463923977824639', 'choose', 'TESGLE342Y521W43EI', '', 'o2YD2Ygz7UnC65vTQtvQzk9mcmVQZjRiSzl6TzVmOGh4MFRVSkRSdWlyZEs4WHVTYStGT1pHdytrSUh5cG1vSWNpZmlVQWRYYmVrWDMzTFNhUW1uUTdQc2FxekVBNVAzdW0xRTlBPT0=', '$2y$10$LbKpKTF.5OOzFoIkmRqtOekGhu/C8tq5Lugja.ACz4RnVxdrwHMy2', 1, NULL, NULL, 1, 'ABR7285737'),
('DTE3498718', 'TES87463923977824639', 'choose', 'TESH48T4R3213BA8O2', '', 'QaVHZqGEbL4tbdTf1q7i/FlpeXU3bXBCK0xDNEx2SmQzWGNncVdjMG5JSTVlMi9iSmNkZ2c0SVpZS0NJVkNWcUhZT0tMdDZ5eU1oY1hiUm80cloxUy8rQ3MrNEpvZmx4NS9FL2hUTVhJd0pNZVZuRlJxVGVTeERtL1FicEdkM3UvbjE5ZHJkVVlMWFF0N0NieVU2MVJscEFQaGpJMWZERE9xNmcxQmhNRlpGb09wOVdQcjZaYVJaT2RCV214WnM1elVCbEl3aHVtT014a0lzTVZjMExLUUtNb1hpcDlvODNvTCtOQWJZNUNSV2xKTTJWS0NTSlVUQUNxZFk9', '$2y$10$T2WX0wc6YbMkrQUq08.rp.DfCBfHw.US6bXu8iXOjqWoy3E.qMa1.', 1, NULL, NULL, 1, 'ABR7285737'),
('DTE3498718', 'TES87463923977824639', 'choose', 'TESH5J9H4GB7ACNMTY', '', 'iEo45JjqWIkhG1eugVXdq2d6cTJJTzAyT0U4bzVXTU8vaHRhSjN4cmlReXI2V0s2Z0p3SG1vQlhHc3pSL1hpSXBwNU5md1AzTGlQcTVjVWk=', '$2y$10$AxSwKPvn7ZV0UiTu12eHlOFV.NgnqV5WwG4cw7AYJde66.7.7Gy0.', 1, NULL, NULL, 1, 'ABR7285737'),
('DTE3498718', 'TES87463923977824639', 'choose', 'TESH7I4C8G97K8U211', '', 'tdUdgiqdH5vb40xCE67ZTmNOVjh2bDJXTzhEeDg3cXl2SlZ1VmlGcjBOc1pjYzIyS3k3RVdCQUkxVXRXQzB4TVBjeC9VZ2UxSHFQait6ZFZBQmVHbzB4bUMzczF2TlFKTFNDUTR3PT0=', '$2y$10$Sp7HW1cNSjmlyyqLB7hwO.xZSqMqf/IaXhi98Kpg8nT2Z5.hqMdba', 1, NULL, NULL, 1, 'ABR7285737'),
('DTE3498718', 'TES87463923977824639', 'choose', 'TESHKJBJX18HEG994J', '', 'EZLgvFrsVRhz1fbtv71ahURWRCsyTEphTHAybXVRYzVPcnpmeUNULzdMMWFienQ4ZW1FeGhsdTJUR1ZIclhwTS9RdEk0ME1EMjF1MzlZR2RGMGtXL09IWEhnVjFNK3lHOU1aUGlnPT0=', '$2y$10$sMNoDS/wIYukwPDhtM3Anu73jXZ019c6VnGesytKrdV8zjNx1.t2i', 1, NULL, NULL, 1, 'ABR7285737'),
('DTE3498718', 'TES87463923977824639', 'choose', 'TESHWX2KO8O6GME764', '', 'uHoFKcKEOCroHdq8ZeHdWFB4K1M4ZjdmSG81bGtSZHlWbXRibXpDOVpJV2gxc0dJR2k0ZXFuYmRYSktqeW9vSmp5ZktvOHZ6K2NGVUZDczAvU0VBczMzNjdqbVBOT1FBcjZmZmpDbVlQakpaa1RVRUV4Tm9YUVU2bS9TK2RzRHZxbnVBdnlaQTkyR2VQSjd2KzUzQ05jUC9MYkZBdDV3bUFFalJBZjNnakMyeUYrOVE2a09aaHpLdkZPSHZwblFSV1RKTnFHMldPeWZhZ0NtMQ==', '$2y$10$CVlmmB4R9vpG.QANzIB4J.gcjp6P355haVnRlTV.f4/VAJPGbtNTy', 1, NULL, NULL, 1, 'ABR7285737'),
('DTE3498718', 'TES87463923977824639', 'choose', 'TESI294I1881348X8G', '', 'EGDdfsLoRYR5DROQSvkn7HpUdU1lQWNNbWJLV28vWG5FWGtBK2J5R3d3NEk0ZjJ2bU9tVzUvTTFKQnhHM0NCczJnVmFhWEd4L2x3NHl3ZEl1R1RmZkE0UWUvb1VPeTd5YUdPNnA1VjRJNmZlQVJoWFdrMG5SelU0aFhaNkd5S1ZMYXlGaUNzYWhCcWVoRFMw', '$2y$10$p.pJ0a9rwWxiUF1bCURu4.sGIq2eofA/f50dT2oKhf3yZOKibddFK', 1, NULL, NULL, 1, 'ABR7285737'),
('DTE3498718', 'TES87463923977824639', 'choose', 'TESI2M3K8IBYNNEJU2', '', 'qLUZRYXB+8/+uwH9j90mlit3Q2E3cTg0Z09CMVpnL2FUME5OSEhOcmNUY3Vrdmp5dXZrdVFDajFYUzdvNTBSN1F6Ykp6aTArRk05UXZyUUZmWG94SSszWStTWUltcEc3Q08wSjVGaFF3VnIzbkZGWi9ZK0VLTTMrNTk0PQ==', '$2y$10$2Cw6a0GaSL.ABztlOeaWY.vvR.uVhNqHjKvuDOfRjUHrGUk8jWA5e', 1, NULL, NULL, 1, 'ABR7285737'),
('DTE3498718', 'TES87463923977824639', 'choose', 'TESIJ7UNXOYKJJ2GX6', '', 'xaC4i8gGOW5OxndZBWAAOU4wbDBEU3haSzIyYUloanpHbkFHVlpRRUFFajkyUzhuK2dtTFh5NVRmaVFKQlNieUd0aG9rM2VoRWEvNHJKUnJkUEN0T3VUSDJvQXA5b0RBSGxPTWRnPT0=', '$2y$10$SsweNTsWPhTRJFCE2vy26egcuEhvSj7EvD8RS8mmqflVUE.mqQFwC', 4, NULL, NULL, 1, 'ABR7285737'),
('DTE3498718', 'TES87463923977824639', 'choose', 'TESJ3K2W482EIALT5I', '', 'WSVfbdd4i63PIbzjHVB6lHVaN2g1TFd0Zm16MUdma05EZjF3bExiK1JSZGdCcWJkUU02OVZmZEJ4Q1JBbzMzbGdQbFVLMGkwbDFDREVqMTZRY1VabFl0WjNVVmUrUkQ1WVlNY2swaHhVejhZN3FPMGtuVDNzSFZkTGx3PQ==', '$2y$10$RRLmSIGo1PzMVwcnD2/NLO.mMvXD3AZu4jqIB8G2DOfzVmd/Yy.3O', 1, NULL, NULL, 1, 'ABR7285737'),
('DTE3498718', 'TES87463923977824639', 'choose', 'TESJ8XGO7C5J4EGK55', '', '/zN83YgxwHL9VknoZKR3AFBOa2wyK2llYzkyL2JiWGNodUFDc1RoVTNHNkhjdXpPMmRYMS9McVlnR2lQRS93RC81TFJRTXN0ZWxNODFsZXNjclJUOVI4VkJ5L0w0SlBpT2Uwa0lnPT0=', '$2y$10$ss0oRJfBUEzjWlBCA1V0j.Df7pmuYxWQEmV7YzDhBKaS9fjNtubGS', 1, NULL, NULL, 1, 'ABR7285737'),
('DTE3498718', 'TES87463923977824639', 'choose', 'TESJEB4C42G2MHTH99', '', 'N8EyDImpGHDWNfJNJs6Ydnh0ZWxwM1NTb3V5NEk2M0ZpbitoVlB6MUpVRFNKeGlwNGhmWGFFRUs0dTU3WVk3b0FEOG1KbkFYSGF2QUUxYWFKNGd2MnhMNjBYSUl5L3dsTWtBbjJYaTdVR3h2SmhTZk9JVXVoRlBmODZNWDdoWEJsZUJieWRIZElxdGNrSGNVN3NVZDN0OWdITXhteGhBcWxONnNzSUw5aEh2b3JNVHFyZlF2YndYTFJ6az0=', '$2y$10$Avk1OILMb9tUDZ0AjE8Y7.Rxho5ksu4hLsgQIct6JsK4OWa1H9YHi', 1, NULL, NULL, 1, 'ABR7285737'),
('DTE3498718', 'TES87463923977824639', 'choose', 'TESJHOUGEE3INOI1XJ', '', 'd4Hot+L5MAIZXPETye07pkpuMDU4SUFnRzVYSENGYTFHaHpYdkwzR3N0VVlKRlpmWW5YczZUVk0vTmdaRzdOcG1iU04xeXJ3N1JSZko0djZXbGR2bm45bDByVUs5MXlCTTR1Zkd3PT0=', '$2y$10$m7tX9QESIFiYWTQJDJpt5.BvNo78coBMRP9fKO.Q32wFrTvZw91nS', 1, NULL, NULL, 1, 'ABR7285737'),
('DTE3498718', 'TES87463923977824639', 'choose', 'TESK85CE7O31LJ433F', '', '5CecJTY9UzAf1ViR/RnpL0cwMzRiT0tJN3o1WFRIR3QxL0M4cFk0aklZYnA3aVF0ZVcwZ0NNL3FFbjY0bFVGb3o0NEdLVjhDMHBaTWtKTTl3Nnl3Zk5KRHNkSDU0OXlQeE9ISXVqZ3lRYkNZYkE5TkZqWDgwL1RCVVZRPQ==', '$2y$10$17C2CMQMoE940Opfyzqvp.tOOQHP3cXOW8jjCy7U0uBZRgXxHAU6G', 1, NULL, NULL, 1, 'ABR7285737'),
('DTE3498718', 'TES87463923977824639', 'choose', 'TESKGYYFNLB4HL21ZZ', '', 'meJqZWtNInUWqD1rx0nL2kVjMm0zdnBBeHIwc2xsbmd3MlducmsySE9PYmo2QTFCc1crVGFvZlIxamVKWWZFSFh6SVlkQ2tKMnZxMXJUL0hWZG9PMG4vd2JvSWRjOThJMWVoS2dhWGx1T1htcU52TVVQaEJoT0VKbmYwPQ==', '$2y$10$r8NmTPyxe2JqkoBelIOg0uTQgErib1jVKv/NlQZodfT5vF1VvTDC.', 1, NULL, NULL, 1, 'ABR7285737'),
('DTE3498718', 'TES87463923977824639', 'choose', 'TESLI1JHGJ2CU8129L', '', 'ilrf2k/uSonYVBUhkTcwI21sWTRXNUpKcFRlWXBuM1g4TFNRTnhyTXlsTnd2YlNZanpvWVRXYWt1YmlwN0ZPYVppVGFaNmtxTzVmUys5ZW1GaW1GZFNBdU1ZM3Y1US90aFd3V3c2UGxnL0NkemNOdjZCc1ZjZUNMUXhlekk1VEhkVnVJWXpDMlRpQXNSR3hv', '$2y$10$dEVVmC6d51BobL8AmBBMtu/x3H21XMGe.sVtap.hNd4TWVuAxjLOy', 1, NULL, NULL, 1, 'ABR7285737'),
('DTE3498718', 'TES87463923977824639', 'choose', 'TESLI2B83HGE79OFH4', '', '6W/N41V/rdjSxXYwN8SISTJYanpHWGI1RnVDcG50cnUwOGJia2c9PQ==', '$2y$10$d3yDuXE9jpaoWWwnG/b56ezTp7LYqGOQPY4ulCB/ekwzA5BYKu.Mm', 1, NULL, NULL, 1, 'ABR7285737'),
('DTE3498718', 'TES87463923977824639', 'choose', 'TESM4U2I3G28GRKRNB', '', 'vP6pBYNt7lvUZABXI7dAJnZsL0xxUWZ6T1VCckpYblhkMGgvZHM3alg5WllMaEl2cGhJR0YyT0Y5Ymczcm42bmx5elVPNnNNL21OaUtSZTM=', '$2y$10$mtm.vP0rt6Wdr0QtiBj41.2IZKB3JmOn.lyvhQTZFlNPhCugxMyHC', 1, NULL, NULL, 1, 'ABR7285737'),
('DTE3498718', 'TES87463923977824639', 'choose', 'TESMK8YB6BLY7Z4LW6', '', '85GxQ2FbObO1uvWnJIiBokc1T3liV25ZczNuRTF6OVJ4QjQyb2U2UWZzakF0bzNGajg3eGpuU3JtdERZVEpSYUNiRERQY1pXQVJFN3R2SFU=', '$2y$10$SpAC4dqPw5E8CdXoJJwg4ureylrVFZcJfwRHErrXdqXwjyCjzswTq', 1, NULL, NULL, 1, 'ABR7285737'),
('DTE3498718', 'TES87463923977824639', 'choose', 'TESN46JX2CW3F9H1WY', '', '48PxKiejnWzK98BH81EzP0MwMVFlRXB1cm5JUzRnNmpIV05yNG9od1V5SnZ1ZWoyUytCaGxwYUZDa1EzQ0UvODAxZVJRV1lRdkJZaHFaQ2t5SmZxWXdTUXRwc0p6Y01JNE5TQmJBPT0=', '$2y$10$uQxxqB8NPgSFbuUyUpeg4OjDIS5TcbMb1F7SDvUVs0UEp1u6UdaNa', 1, NULL, NULL, 1, 'ABR7285737'),
('DTE3498718', 'TES87463923977824639', 'choose', 'TESO69JJCBLCJJJFZ9', '', '/TBt0b6f83ePRjmW+Yfj40J4ZGh3THFqVjZRcmxiRkp5SlRtY3FsdXQ5Uy9LQXV2QmFydkJYWEtXQWlyNXh0Z1o1Tm8zdjBlWGFER1E2T1Y=', '$2y$10$HQAVXgGXpjbAC79yxhmMJOvpF0Q42hsr0FVIGID6WacCZ9bN2jh5O', 1, NULL, NULL, 1, 'ABR7285737'),
('DTE3498718', 'TES87463923977824639', 'choose', 'TESOFRIK5223XH8ZJ1', '', '+Aea5nYNbfHgm2sG5EKvGmRrV05WL1J0RldnUU80ZEttU1dvSEFCRklqbU5POXdWNzNxUHhlN2hub1ppOWxnNHlHcDNQV3lBNk53dzlONitvMHAwc0ZVbWxadmdTMGFTUlc1UFpmN3I0R0pRTUpUSUh5SFBzeFV1N2FGNFo4dE4zRWFmb05jOWhTVmVlY3RmSmdpL1oxZEhiQk1iUmMxYkMzRWV0Y1FaZHhnZ1UydjRYWTFFaUh4M1VGZWRINEZON2QxYVhvbEZFa2x0ejVKYnZ2RGNTdmZVRU94VEtTekxkM1Fqdi85YW52dVJHcEVjb1k4REFVT0NGWC82cHhYa2IyV3N4VW03R1NJTmJLckI=', '$2y$10$Sm0XNAjklKFQrUKdj3WF8OSc.pVd311qO5X97H4r0UjB62L.HfOmi', 1, NULL, NULL, 1, 'ABR7285737'),
('DTE3498718', 'TES87463923977824639', 'choose', 'TESOHXIZYEJBZHN33H', '', '1xPuvo5E9X0wqmJ6CRzOXk9OMzlOOVJvdnhzN2E2VEJLTzNHNnVIMVFNV3BXRnd1bjljOGxUSmhaVXpkWXdtRWJLdlByOXZ4QXJkemt6K2hnVW9JYVNLbTBHQUdUeGJUTzBVaEtnR0puTG9CTnc4Z2tjYUJLVGFhdUpRPQ==', '$2y$10$jYHkV6J39yI8e7TeupVJMuumqs9Gt3QoA.OxQMi6KCMzu/xiVgFHW', 1, NULL, NULL, 1, 'ABR7285737'),
('DTE3498718', 'TES87463923977824639', 'choose', 'TESOYH7ZCX2J2X4W8J', '', 'Sc74clvWEHNflVLftgfjU1FSSmhFUzV3Vmt4a25xWlZ0UXFOdkw1T2UrcWFaSVVtYVBBaW9ZS0tZUE1Kc0RYRUVKY1dKRkg4L2JPYVNpSEFFOTE2RUZML0doTzdmZWVEbXhzSjRRPT0=', '$2y$10$qJUP93sjqc0gpVdmZLQUo.GumOEunxDvsWjPyp5Q5KJNRcilRUjCe', 1, NULL, NULL, 1, 'ABR7285737'),
('DTE3498718', 'TES87463923977824639', 'choose', 'TESR2X9GFR1TGTBZ1E', '', 'WVYQZ4Rp3Pp78O3IQ+ohpXFhYzNaQ1VNcGlTL2Z6NC9CTkcwQlpxR1g2Z0ZHWHZ2NFlMWktaVnh5NDV2V3JkTThsMlVCK1lHNDRFWUdBNEY=', '$2y$10$TCMEPhHoKznh.6W9hbm9XusV.g94q7vUTa.pSZn/Kz3Bc1gFRyk.W', 1, NULL, NULL, 1, 'ABR7285737'),
('DTE3498718', 'TES87463923977824639', 'choose', 'TEST9127X5YNHKTXIA', '', 'LdIp+KYYZdjDLYk5IEe5J1l2M0lCY1FXUHNhM05TQlhuVFphSEpwTXhtWC9RSmE3ODRubWFMZFNJWDNoOUJXM2d1R2xHc2FpckpFb2JJcU4=', '$2y$10$jYjfeeqFfK4m3VwMU4zL8.5Vi0LBeIYkFoLJSlYBi/7PmXXRRfiGe', 1, NULL, NULL, 1, 'ABR7285737'),
('DTE3498718', 'TES87463923977824639', 'choose', 'TESUEEH1EG834H4N77', '', '/rAuSM7i4mS3AZDGhEYG0ThCOVRqREo3MlFudE9lSGhPQmc1c2hYTkgwNDFTNE9oZDlaaEl5MkdPcDlwV2VwWUZEdUh3N2l3cmUzMktSYVkxOVhKYjZBOEdjN1pvTmtUZ1MxeG9BPT0=', '$2y$10$lqLV5k3f3pQFwKkT0gyidu1eAStdUSWDQrbKbbnVv7zHE15WUmTku', 1, NULL, NULL, 1, 'ABR7285737'),
('DTE3498718', 'TES87463923977824639', 'choose', 'TESUJ74J18E95GJXK8', '', 'ToHxgrGlqalMMLDFiKCBFkVuV2ZjSXNrdW1lZWF0dnBBVm1iQXMrc0ZoMHUwTlpBWE05aXNqVVdMWXM9', '$2y$10$ok8KGsKcz8dILqFZFpDq7.AuzXpdlyO7j.Cq2Q/9lVCIE9nfmY91K', 1, NULL, NULL, 1, 'ABR7285737'),
('DTE3498718', 'TES87463923977824639', 'choose', 'TESULBGLGH33KX4J6F', 'TES87463923977824639TESULBGLGH33KX4J6F.png', '8xi/WFuwFcUpIpYRC148L01DYktwVG9xdEljQmtsaTZzcmVJY0ZPbmJhdlFYOVNqRENaWm9GNHlXWWtEK3NDNUY0cG84WVRKb3FDOWtBdGw=', '$2y$10$mCaXoladHO6MWcDJxjTT5.eqnszguT/3mgwrnLXEkzblT2LxeeTz2', 1, NULL, NULL, 1, 'ABR7285737'),
('DTE3498718', 'TES87463923977824639', 'choose', 'TESWK711OYGX4U1EUZ', '', 'g2pHkNu04BWS0TDjyF0xNmFJbWQ4bmZWQTRoQUtTaDl4Kzlqam9qM2g5aFhTQ2w4RFRFRXBiZmhYRTVuakxlYlRJUzcySGtjNHFTY1NKNm40eDFQYjQ5Tmx2T1pOVUpXU1U3S29yb012U2ZpT3VhdXZvWU0zTXlseWpteUtEa3NUajFEbGtYWWlISXFObGN6UXlMTHJlZVZvQzJRUXVHZVphZVhYZXBIY2dPSWVoQ2RpTGZCN0dTY2VCUT0=', '$2y$10$yD71Aos5HK1A8JgP1Dl/yeLIFUniYzu4Opp2fhSQee.ud3konZ0re', 1, NULL, NULL, 1, 'ABR7285737'),
('DTE3498718', 'TES87463923977824639', 'choose', 'TESWKHI8BJX56AK5B4', '', 'z6C0/TnCLC7RRYg5M+xvAlJDLzRSelJsVVJFMlgyT3VMc1RWUWJxeFQ1Z0JNTHB1Z2J4NGNTNjNoak56UURacUhHbk93c2gzQVRRN2FIcmh2WEhXOHJlSUZDUnR1a3BLc3lBbmM3L1hpWWNUbit6MmM3Z1p0SlppQU42NHJSampEbFdYdElnbFBNbVNEVWli', '$2y$10$EUUAoPYt2yfsQ2i2asNTZukJ4SOlZ7zSL.j964y27EOISSoqI7gXq', 1, NULL, NULL, 1, 'ABR7285737'),
('DTE3498718', 'TES87463923977824639', 'choose', 'TESX13G6JBI782G35Z', '', 'kUClaejZLwl/YvQveVlp8Go1RFZnbkNyTTlEM2tqaDh1dGFodTR2bFdlSW4zcUgxdzNiaEhNcjZiTDZINlphOEtsVVlPNUx0ZmpTQVNRU1A=', '$2y$10$.l/yr1VdFmxM6rQsvAuXMOYzAQEFjHcr1Lacu94FAI6GevoT4UZsW', 1, NULL, NULL, 1, 'ABR7285737'),
('DTE3498718', 'TES87463923977824639', 'choose', 'TESX2M3MG2GH34JZ24', '', '94qKAioB7rj83+0xbZR/D0ovbWNHV09nUExwUUVMZFhXcUd0Y3J6UGFhdXU1ZHVpdk51MTNiZUY2YmFnWlhyS2lIZmNHbHZZc0tGaU9sZmVWb29meEF2R01QbjVkK0IxSGZ2RU1KYmpqZW1HNFVJeU51T0RUeXVNbGltaWZZMGx2eDVxK3owdS9sUGNHdkZGTFZzWkJuSi90MzU4MkhJYjBrVnpOdEs5TXgyZ3JzUW0ra2c1dHQ5YnJ5UT0=', '$2y$10$.ezxZr0I3Oq4gDZNwlVXreArjvryLETE3/EMJ503Wyfa56/UjoyVS', 1, NULL, NULL, 1, 'ABR7285737'),
('DTE3498718', 'TES87463923977824639', 'choose', 'TESX4GIXEWFHO9H7U2', '', 'd9bYipqNryMP16YABE1o6HZtajRCZ3dudnBWbDlweE1mNENJQzRaQUlIbWgzaElBOGV4VXJndTcyQVE9', '$2y$10$/DcuRYQm5nRJhtS1egXIluj0uouBG3RCSJsLnw/ctdO8QVvDgf466', 1, NULL, NULL, 1, 'ABR7285737'),
('DTE3498718', 'TES87463923977824639', 'choose', 'TESX4HHJ7UO231JM44', '', 'CNuO3TVat7fLIAD7+0ypvkp6MGdpRE44TUxlMUZXNUp3MlZqRkE9PQ==', '$2y$10$XqoizK3SKXZVPc5OonM2ueG1a2ALMZI5kaTJ7.M/FGb.Fp/o8dWK2', 1, NULL, NULL, 1, 'ABR7285737'),
('DTE3498718', 'TES87463923977824639', 'choose', 'TESX4HUE372UEHG87E', '', 'INO1Et4KJamznGfGr5gAj3dTR2Z4YlUzVWMvdFkzeG1hYWRWSlRaOUgrREllSGp1M0VrSFkyc0twRXozRHl0bzZiMVg1WUVtOE0zN1phWlhPTE5rUlh2YVFZcUQwR09PTXhBdVh3PT0=', '$2y$10$C3eWZRYQuLAaIrb9xvqWo.DMQ4Gn65SqBkB3UbF/QeIzIDE1AW2Gm', 1, NULL, NULL, 1, 'ABR7285737'),
('DTE3498718', 'TES87463923977824639', 'choose', 'TESX758H3JKKUKG124', '', 'gbXu5XiQqip9jYTXVP5BZXkrbEdvamFpWkpwVlBzZjZ2OFk3RmQ0M3hEbEl3NGpKUHhZZml5eEpqNGtPbFZzSFZ0b3dnS3BOOGJrWUhMK2JzRzI4RG8zRTludmJLUk5WaG9RdlFQNUhYWGxLK1hGbXVoem5ZNXpQV2tNPQ==', '$2y$10$UwtMKrqC9WW8FRcsBLUIGu8yCa3p615OgkB1xpsFy2nZM8qoidG8O', 1, NULL, NULL, 1, 'ABR7285737'),
('DTE3498718', 'TES87463923977824639', 'choose', 'TESX7MY2BX189LJ8J7', '', 'bDyGLX/2PS4a3UTI/yy+pm1vaTZ0enBtRllrV1RmOEMyUklYeDkyT1Vja2FWM0NFZk5RV1ZDdFQ1KzJSKytrYUJ1VTNGcnYwNEdmK3JCSjgwYUFxMlpiUzlBVCsyZDlVMXR1azNnPT0=', '$2y$10$aj/PUiRkUE1Y6Id9KlWBz..rXC9YWqcGg/QDyCFrwGvbgv1bb1qY6', 1, NULL, NULL, 1, 'ABR7285737'),
('DTE3498718', 'TES87463923977824639', 'choose', 'TESX9N4C4IJ7EKHOM3', '', 'J0XMiwwK12gNIHrItdTTllFIMHVsRUdKVzJuQVpUYTlkaURkcE5nTkd4bDRkZXJvSHkyVlo2K1ZXUlgzY2dMOWVCNnBuSXJiY0ZkczJuYmNBdDY4SFl6c1p1SExoZUVXempocFhoclhYUmhDNm1QQUVLSkNRNjZ4a28vakh3aGdhajhHR1Zrd2h6ZVA1S21YLzRXdHBHTlh4U2V5WmhzcHRUdjhTTitxdW10WEpZVU9yeXZNeHFpb1Zia0xKWXV0dE9IWlZleGJMem1WZXJSNWRSTzM4ZEpHRTREQ25iWnhuL1BJZkZvREt6bDRVU0JQRDRKdTl5QU4zRHdGYVFOR3BvODJGQ3Fqei83VExweUU=', '$2y$10$/1RXj/ete.qYXMyswgnWQuX5J2Xw4u/7Tm4l5u9aGRylr260egG7i', 1, NULL, NULL, 1, 'ABR7285737'),
('DTE3498718', 'TES87463923977824639', 'choose', 'TESYBCM7B2HKZ41G9T', '', '3zasaQn9n+Kqw3n9rcalAHJhd2FsQ1lESFF0U09hb0g1aDVJQnBLcXlSMUVNSnVjTE9iWmwweTA5V0d2UFV4ZXdxQjRlbEQ4ZW1JTHRqM1lyUTZrR3NvL1prY09maEllQ0xKbkxnPT0=', '$2y$10$AXJkrrddUHi4bG.fplPpnO0gJhHi.o/wHPtRWv15CFJwvdKlp.vZK', 3, NULL, NULL, 1, 'ABR7285737'),
('DTE3498718', 'TES87463923977824639', 'choose', 'TESYXYUOGX9BN5EFH1', '', 'wyxUhYBPpY6KIpqKw7slpW5VM3dHL0dTczFNNmg5ZzRkeE85bmdzNnpDUFhCWE5meXc2ZlpyeFZrZEd0QmpPazh1TTM0aVI4VEVnd1VyQm4zVmxRTDM4aGV2bFhNejJoa3RBWU5Pd1lGZGlLNGdBT3JEZVJMUVNRdzIzcHlRbm52aUxzY0NvVnRYRzlvamYy', '$2y$10$yALynoMETamfD35pX/JLu.aFZUkLMphCGW3g541i6J5ZskCvgflz.', 1, NULL, NULL, 1, 'ABR7285737'),
('DTE3498718', 'TES87463923977824639', 'choose', 'TESZ3LN3BHEABU1JGY', '', '90MI2dlTzYjemAtAiF7sIEN4R0tBUndkb0kyZkJPNDNDalVYbTVVMHljTHJjMVZ2aUx5Uk02akUzaXl5bU5WN2Z4SU5odWxRUHVDQmxWU3pGajhWNFpQWFlRd0NOVTdvbnJTQUhRPT0=', '$2y$10$YX577M9x2CxdSAMnzoVpVOzc4CUXXl7TLmK4trEJ3/RfjhJyCMh9O', 1, NULL, NULL, 1, 'ABR7285737'),
('DTE3498718', 'TES87463923977824639', 'choose', 'TESZ4NY6463G5G43FH', '', 'EmGS3I0GDEBFHbk59MDGrmhMVjFFdkxCSWtnMUtNS0tualJTaFRmS3kydXlSSndrYjRqZUpHcmtPcFdxYzRVOUF6UmtrTndnVFhmUXFHdXBVMkQzS0xadmQ2TjhKdEtMU3d0TUZlRVQ0eWxjTXJrVjF4OElkUkxMMXNzPQ==', '$2y$10$SySgcMMdK8sH5Ni.oWJfZ.IT6mBwYWItllh/zh34noSPOmuvJxC6O', 1, NULL, NULL, 1, 'ABR7285737'),
('DTE3498718', 'TES87463923977824639', 'choose', 'TESZ8NX4B8GRB9UA8C', '', 'Y+NZsM/W5AESCnyLyAXIVkdCT0V6WmZvWGpFNE4xbVpUTEdjZ3pZWE5GSEVsU1loTE1aekg3amYrd0swK01DWHFrWDQxbDdxWlhUTklpT3FmWjhhb0V6QzVHSjNPSHVrTllFUnFtWHlVa2dTZlhOY1VpTk9LOHZqWno1NFAyRXAvNFZ3dklHM0pXcDZRT1U2', '$2y$10$ACyFKDj.lj/ZtD3tYEdqyunBX5w0GeJGZvbZQAeWyRAYWbQrdPwzS', 1, NULL, NULL, 1, 'ABR7285737'),
('DTE3498718', 'TES87463923977824639', 'choose', 'TESZBENEF2E2R6OGIK', '', 'Cf0y7HyB+rsm7YR0kSgtw0VwZW51TzkwZ2cxZFNZa0ZscXBCUlRYOG9KeDVhSGkySXJ6QmdBWHZiNlE9', '$2y$10$QIiP.Uz9n8mDt9b2qQAJTOZgccORoOzrbr4F.DmyljrpCu88jRIAq', 1, NULL, NULL, 1, 'ABR7285737'),
('DTE3498718', 'TES87463923977824639', 'choose', 'TESZW5JYGJK2GW7GHJ', '', '5TLyZLv11aAOsCd+0651jkNwWkZyZTdFc1BHOUZHQTc0ekQ0TkFSZ3EwdENWQUV0VE1Hc2JBYnN1eitCTW55ZWRDRk55NXdCVDN1V3RrUE9udEk4akFLaEtLQ3l5WlpoUGRWdm93PT0=', '$2y$10$DWE1OrO8l1Sm6Oui0BaPh.MFPdo8ChmpiBj4MF2NoD/p6jxPUtk9q', 1, NULL, NULL, 1, 'ABR7285737');

-- --------------------------------------------------------

--
-- Table structure for table `simultquestion`
--

CREATE TABLE `simultquestion` (
  `cat_id` varchar(23) NOT NULL,
  `exam_id` varchar(23) NOT NULL,
  `quest_type` varchar(55) NOT NULL,
  `quest_id` varchar(21) NOT NULL,
  `question` varchar(255) NOT NULL,
  `quest_ans` varchar(255) DEFAULT NULL,
  `right_ans` float NOT NULL,
  `hint` varchar(255) DEFAULT NULL,
  `explanation` varchar(255) DEFAULT NULL,
  `stat` int(5) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `temporary`
--

CREATE TABLE `temporary` (
  `id` int(24) NOT NULL,
  `uid` varchar(24) NOT NULL,
  `cat_id` varchar(24) NOT NULL,
  `exam_id` varchar(24) NOT NULL,
  `exam_type` varchar(24) DEFAULT NULL,
  `qid` varchar(55) NOT NULL,
  `quest_type` varchar(55) NOT NULL,
  `uans` longtext DEFAULT NULL,
  `cans` longtext DEFAULT NULL,
  `total` varchar(10) DEFAULT NULL,
  `stat` int(3) DEFAULT NULL,
  `ts` varchar(24) DEFAULT NULL,
  `result` varchar(24) DEFAULT NULL,
  `date` varchar(15) DEFAULT NULL,
  `op` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_sessions`
--

CREATE TABLE `user_sessions` (
  `user_id` varchar(55) NOT NULL,
  `exam_id` varchar(55) DEFAULT NULL,
  `session_id` varchar(100) NOT NULL,
  `login_time` time(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `asscategory`
--
ALTER TABLE `asscategory`
  ADD PRIMARY KEY (`cat_no`);

--
-- Indexes for table `assexam`
--
ALTER TABLE `assexam`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `college`
--
ALTER TABLE `college`
  ADD PRIMARY KEY (`col_id`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`dep_id`);

--
-- Indexes for table `displine`
--
ALTER TABLE `displine`
  ADD PRIMARY KEY (`dis_code`);

--
-- Indexes for table `exam`
--
ALTER TABLE `exam`
  ADD PRIMARY KEY (`exam_id`);

--
-- Indexes for table `examinee`
--
ALTER TABLE `examinee`
  ADD PRIMARY KEY (`uiid`),
  ADD UNIQUE KEY `uiid` (`uiid`,`examinee_type`,`stream`);

--
-- Indexes for table `ex_group`
--
ALTER TABLE `ex_group`
  ADD PRIMARY KEY (`group_id`);

--
-- Indexes for table `ex_year`
--
ALTER TABLE `ex_year`
  ADD PRIMARY KEY (`year_id`);

--
-- Indexes for table `final_result`
--
ALTER TABLE `final_result`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notice`
--
ALTER TABLE `notice`
  ADD PRIMARY KEY (`nid`);

--
-- Indexes for table `option_list`
--
ALTER TABLE `option_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`quest_id`);

--
-- Indexes for table `temporary`
--
ALTER TABLE `temporary`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_sessions`
--
ALTER TABLE `user_sessions`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `asscategory`
--
ALTER TABLE `asscategory`
  MODIFY `cat_no` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `assexam`
--
ALTER TABLE `assexam`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=139;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=142;

--
-- AUTO_INCREMENT for table `displine`
--
ALTER TABLE `displine`
  MODIFY `dis_code` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `final_result`
--
ALTER TABLE `final_result`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `id` int(24) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10374;

--
-- AUTO_INCREMENT for table `option_list`
--
ALTER TABLE `option_list`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2060;

--
-- AUTO_INCREMENT for table `temporary`
--
ALTER TABLE `temporary`
  MODIFY `id` int(24) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10379;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
