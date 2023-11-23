-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 26, 2023 at 12:58 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `clinic_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(250) NOT NULL,
  `password` varchar(100) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lname` varchar(500) NOT NULL,
  `gender` varchar(500) NOT NULL,
  `dob` text NOT NULL,
  `contact` text NOT NULL,
  `addr` varchar(500) NOT NULL,
  `notes` varchar(200) NOT NULL,
  `image` varchar(2000) NOT NULL,
  `created_on` date NOT NULL,
  `updated_on` date NOT NULL,
  `role_id` int(11) NOT NULL,
  `last_login` date NOT NULL,
  `delete_status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `firstname`, `lname`, `gender`, `dob`, `contact`, `addr`, `notes`, `image`, `created_on`, `updated_on`, `role_id`, `last_login`, `delete_status`) VALUES
(2, 'jniel@cct.com', 'aa7f019c326413d5b8bcad4314228bcd33ef557f5d81c7cc977f7728156f4357', 'Niel', 'admin', 'Male', '01-24-2001', '09922138761', 'Tagaytay City', '', 'user1.jpg', '2023-05-28', '0000-00-00', 0, '0000-00-00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `manage_website`
--

CREATE TABLE `manage_website` (
  `id` int(11) NOT NULL,
  `logo` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `manage_website`
--

INSERT INTO `manage_website` (`id`, `logo`) VALUES
(1, 'shslogo.png');

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `patientid` int(10) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `guardian_name` varchar(50) NOT NULL,
  `admissiondate` date NOT NULL,
  `admissiontime` time NOT NULL,
  `remarks` varchar(50) NOT NULL,
  `address` varchar(250) NOT NULL,
  `contact` varchar(15) NOT NULL,
  `studentid` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `reasons` varchar(50) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `dob` date NOT NULL,
  `status` varchar(10) NOT NULL,
  `delete_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`patientid`, `fname`, `lname`, `guardian_name`, `admissiondate`, `admissiontime`, `remarks`, `address`, `contact`, `studentid`, `password`, `reasons`, `gender`, `dob`, `status`, `delete_status`) VALUES
(2, 'Charles ', 'Manzano', 'Cherry Manzano', '2023-05-16', '09:43:00', 'Admitted', 'Kaybagal North Tagaytay City', '0993733774', '20230002', '86abb32d72a6612a716382b3c999a68b2664a31b1304cca6f22d5e8ff9420824', 'Headache', 'Male', '2001-02-02', 'Active', 0),
(11, 'Vince', 'Padilla', 'Kim', '2023-09-14', '14:41:00', 'Admitted', 'Alfonso, Cavite', '09887625918', '20231', '86abb32d72a6612a716382b3c999a68b2664a31b1304cca6f22d5e8ff9420824', 'Asthma', 'Male', '2005-03-18', 'Active', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id` int(11) NOT NULL,
  `username` varchar(250) NOT NULL,
  `password` varchar(100) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lname` varchar(500) NOT NULL,
  `gender` varchar(500) NOT NULL,
  `dob` text NOT NULL,
  `contact` text NOT NULL,
  `addr` varchar(500) NOT NULL,
  `notes` varchar(200) NOT NULL,
  `image` varchar(2000) NOT NULL,
  `created_on` date NOT NULL,
  `updated_on` date NOT NULL,
  `role_id` int(11) NOT NULL,
  `last_login` date NOT NULL,
  `delete_status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `username`, `password`, `firstname`, `lname`, `gender`, `dob`, `contact`, `addr`, `notes`, `image`, `created_on`, `updated_on`, `role_id`, `last_login`, `delete_status`) VALUES
(2, 'jniel@cct.com', 'aa7f019c326413d5b8bcad4314228bcd33ef557f5d81c7cc977f7728156f4357', 'Niel', 'admin', 'Male', '01-24-2001', '09922138761', 'Tagaytay City', '', 'user1.jpg', '2023-05-28', '0000-00-00', 0, '0000-00-00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin_user`
--

CREATE TABLE `tbl_admin_user` (
  `userid` int(10) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `contact` text NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` text NOT NULL,
  `gender` varchar(100) NOT NULL,
  `status` varchar(25) NOT NULL,
  `address` varchar(250) NOT NULL,
  `delete_status` int(11) NOT NULL,
  `image` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_admin_user`
--

INSERT INTO `tbl_admin_user` (`userid`, `firstname`, `lastname`, `contact`, `username`, `password`, `gender`, `status`, `address`, `delete_status`, `image`) VALUES
(4, 'Ivan', 'Mojica', '09667892651', 'ivan@cct.com', 'aa7f019c326413d5b8bcad4314228bcd33ef557f5d81c7cc977f7728156f4357', 'Male', 'Active', 'Kaybagal South Tagaytay City', 0, 'user1.jpg'),
(5, 'Rose', 'Ferma', '09847351794', 'rose@gmail.com', 'aa7f019c326413d5b8bcad4314228bcd33ef557f5d81c7cc977f7728156f4357', 'Female', 'Active', 'Tagaytay City', 1, ''),
(6, 'jonel', 'malakad', '123456', 'jonelmalakad@gmail.com', 'aa7f019c326413d5b8bcad4314228bcd33ef557f5d81c7cc977f7728156f4357', 'Male', 'Active', 'Nasugbu', 1, 'user1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_assessment`
--

CREATE TABLE `tbl_assessment` (
  `ExamID` int(50) NOT NULL,
  `ExamName` varchar(50) NOT NULL,
  `Q1` varchar(10000) NOT NULL,
  `Q2` varchar(10000) NOT NULL,
  `Q3` varchar(10000) NOT NULL,
  `Q4` varchar(10000) NOT NULL,
  `Q5` varchar(10000) NOT NULL,
  `delete_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_assessment`
--

INSERT INTO `tbl_assessment` (`ExamID`, `ExamName`, `Q1`, `Q2`, `Q3`, `Q4`, `Q5`, `delete_status`) VALUES
(1, ' Health Assessment', 'Do you engage in regular physical exercise?', 'Have you had a medical check-up within the past year?', 'Do you use any medication regularly?', 'Have you had an allergic reaction or received treatment for it?', 'Do you get at least 7-8 hours of sleep on most nights?', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_assessment_result`
--

CREATE TABLE `tbl_assessment_result` (
  `EAnsID` int(50) NOT NULL,
  `ExamID` int(10) NOT NULL,
  `Senrl` varchar(50) NOT NULL,
  `Sname` varchar(50) NOT NULL,
  `Ans1` mediumtext NOT NULL,
  `Ans2` mediumtext NOT NULL,
  `Ans3` mediumtext NOT NULL,
  `Ans4` mediumtext NOT NULL,
  `Ans5` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_assessment_result`
--

INSERT INTO `tbl_assessment_result` (`EAnsID`, `ExamID`, `Senrl`, `Sname`, `Ans1`, `Ans2`, `Ans3`, `Ans4`, `Ans5`) VALUES
(16, 30, '', '', 'Yes', 'Yes', 'Yes', 'No', 'No'),
(17, 29, '', '', 'Yes', 'Yes', 'No', 'Yes', 'No');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_email_config`
--

CREATE TABLE `tbl_email_config` (
  `e_id` int(21) NOT NULL,
  `name` varchar(500) NOT NULL,
  `mail_driver_host` varchar(5000) NOT NULL,
  `mail_port` int(50) NOT NULL,
  `mail_username` varchar(50) NOT NULL,
  `mail_password` varchar(30) NOT NULL,
  `mail_encrypt` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_health`
--

CREATE TABLE `tbl_health` (
  `ExamID` int(50) NOT NULL,
  `ExamName` varchar(50) NOT NULL,
  `Q1` varchar(10000) NOT NULL,
  `Q2` varchar(10000) NOT NULL,
  `Q3` varchar(10000) NOT NULL,
  `Q4` varchar(10000) NOT NULL,
  `Q5` varchar(10000) NOT NULL,
  `delete_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_health`
--

INSERT INTO `tbl_health` (`ExamID`, `ExamName`, `Q1`, `Q2`, `Q3`, `Q4`, `Q5`, `delete_status`) VALUES
(1, ' Health Assessment', 'Do you engage in regular physical exercise?', 'Have you had a medical check-up within the past year?', 'Do you use any medication regularly?', 'Have you had an allergic reaction or received treatment for it?', 'Do you get at least 7-8 hours of sleep on most nights?', 1),
(27, 'Psychological', 'asas12', 'dsd2323', 'qww44', '12125656', '3366', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_psychological`
--

CREATE TABLE `tbl_psychological` (
  `ExamID` int(50) NOT NULL,
  `ExamName` varchar(50) NOT NULL,
  `Q1` varchar(10000) NOT NULL,
  `Q2` varchar(10000) NOT NULL,
  `Q3` varchar(10000) NOT NULL,
  `Q4` varchar(10000) NOT NULL,
  `Q5` varchar(10000) NOT NULL,
  `delete_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_psychological`
--

INSERT INTO `tbl_psychological` (`ExamID`, `ExamName`, `Q1`, `Q2`, `Q3`, `Q4`, `Q5`, `delete_status`) VALUES
(1, ' Health Assessment', 'Do you engage in regular physical exercise?', 'Have you had a medical check-up within the past year?', 'Do you use any medication regularly?', 'Have you had an allergic reaction or received treatment for it?', 'Do you get at least 7-8 hours of sleep on most nights?', 1),
(27, 'Psychological', 'asas12', 'dsd2323', 'qww44', '12125656', '3366', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sms_config`
--

CREATE TABLE `tbl_sms_config` (
  `id` int(11) NOT NULL,
  `sms_username` varchar(200) NOT NULL,
  `sms_password` varchar(200) NOT NULL,
  `sms_senderid` varchar(200) NOT NULL,
  `created_at` date NOT NULL,
  `delete_status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userid` int(11) NOT NULL,
  `loginname` varchar(50) NOT NULL,
  `password` varchar(10) NOT NULL,
  `patientname` varchar(50) NOT NULL,
  `mobileno` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `createddateandtime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userid` int(10) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `contact` text NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` text NOT NULL,
  `gender` varchar(100) NOT NULL,
  `status` varchar(25) NOT NULL,
  `address` varchar(250) NOT NULL,
  `delete_status` int(11) NOT NULL,
  `image` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userid`, `firstname`, `lastname`, `contact`, `username`, `password`, `gender`, `status`, `address`, `delete_status`, `image`) VALUES
(4, 'Ivan', 'Mojica', '09667892651', 'ivan@cct.com', 'aa7f019c326413d5b8bcad4314228bcd33ef557f5d81c7cc977f7728156f4357', 'Male', 'Active', 'Kaybagal South Tagaytay City', 0, 'user1.jpg'),
(5, 'Rose', 'Ferma', '09847351794', 'rose@gmail.com', 'aa7f019c326413d5b8bcad4314228bcd33ef557f5d81c7cc977f7728156f4357', 'Female', 'Active', 'Tagaytay City', 1, ''),
(6, 'jonel', 'malakad', '123456', 'jonelmalakad@gmail.com', 'aa7f019c326413d5b8bcad4314228bcd33ef557f5d81c7cc977f7728156f4357', 'Male', 'Active', 'Nasugbu', 1, 'user1.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `manage_website`
--
ALTER TABLE `manage_website`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`patientid`),
  ADD KEY `loginid` (`studentid`);

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_admin_user`
--
ALTER TABLE `tbl_admin_user`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `tbl_assessment`
--
ALTER TABLE `tbl_assessment`
  ADD PRIMARY KEY (`ExamID`),
  ADD UNIQUE KEY `ExamName` (`ExamName`);

--
-- Indexes for table `tbl_assessment_result`
--
ALTER TABLE `tbl_assessment_result`
  ADD PRIMARY KEY (`EAnsID`);

--
-- Indexes for table `tbl_email_config`
--
ALTER TABLE `tbl_email_config`
  ADD PRIMARY KEY (`e_id`);

--
-- Indexes for table `tbl_health`
--
ALTER TABLE `tbl_health`
  ADD PRIMARY KEY (`ExamID`),
  ADD UNIQUE KEY `ExamName` (`ExamName`);

--
-- Indexes for table `tbl_psychological`
--
ALTER TABLE `tbl_psychological`
  ADD PRIMARY KEY (`ExamID`),
  ADD UNIQUE KEY `ExamName` (`ExamName`);

--
-- Indexes for table `tbl_sms_config`
--
ALTER TABLE `tbl_sms_config`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `manage_website`
--
ALTER TABLE `manage_website`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `patientid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_admin_user`
--
ALTER TABLE `tbl_admin_user`
  MODIFY `userid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tbl_assessment`
--
ALTER TABLE `tbl_assessment`
  MODIFY `ExamID` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `tbl_assessment_result`
--
ALTER TABLE `tbl_assessment_result`
  MODIFY `EAnsID` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `tbl_email_config`
--
ALTER TABLE `tbl_email_config`
  MODIFY `e_id` int(21) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_health`
--
ALTER TABLE `tbl_health`
  MODIFY `ExamID` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `tbl_psychological`
--
ALTER TABLE `tbl_psychological`
  MODIFY `ExamID` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `tbl_sms_config`
--
ALTER TABLE `tbl_sms_config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
