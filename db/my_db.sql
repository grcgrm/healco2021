-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 01, 2021 at 12:57 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `my_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointment_list`
--

CREATE TABLE `appointment_list` (
  `id` int(30) NOT NULL,
  `clinic` varchar(255) NOT NULL,
  `doctor_id` varchar(255) NOT NULL,
  `doctor_name` varchar(255) NOT NULL,
  `name_pref` varchar(255) NOT NULL,
  `patient_name` varchar(255) NOT NULL,
  `patient_id` varchar(255) NOT NULL,
  `schedule` datetime NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0= for verification, 1=confirmed, 2=completed',
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `appointment_list`
--

INSERT INTO `appointment_list` (`id`, `clinic`, `doctor_id`, `doctor_name`, `name_pref`, `patient_name`, `patient_id`, `schedule`, `status`, `date_created`) VALUES
(14, 'Optical Works', '124', 'Louielyn Salas', 'M.D.', 'Grace Grumo', '148', '2021-12-02 20:34:00', 2, '2021-12-01 19:34:33');

-- --------------------------------------------------------

--
-- Table structure for table `cbc`
--

CREATE TABLE `cbc` (
  `id` int(11) NOT NULL,
  `clinic_id` varchar(255) NOT NULL,
  `patient_id` varchar(255) NOT NULL,
  `patient` varchar(255) NOT NULL,
  `clinic` varchar(255) NOT NULL,
  `parameter` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  `range` varchar(255) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cbc`
--

INSERT INTO `cbc` (`id`, `clinic_id`, `patient_id`, `patient`, `clinic`, `parameter`, `value`, `range`, `date_created`) VALUES
(0, '142', '148', 'Grace Grumo', 'Optical Works', '412', '21424', '2144', '2021-12-01 00:42:21');

-- --------------------------------------------------------

--
-- Table structure for table `cholesterol`
--

CREATE TABLE `cholesterol` (
  `id` int(11) NOT NULL,
  `clinic_id` varchar(255) NOT NULL,
  `clinic` varchar(255) NOT NULL,
  `patient_id` varchar(255) NOT NULL,
  `patient` varchar(255) NOT NULL,
  `test_name` varchar(255) NOT NULL,
  `result_cho` varchar(100) NOT NULL,
  `units_cho` varchar(100) NOT NULL,
  `normal_values` varchar(100) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cholesterol`
--

INSERT INTO `cholesterol` (`id`, `clinic_id`, `clinic`, `patient_id`, `patient`, `test_name`, `result_cho`, `units_cho`, `normal_values`, `date_created`) VALUES
(0, '153', 'Optical Works', '148', 'Grace Grumo', 'sdvs', 'acac', 'qdqd', 'sbsdbs', '2021-12-01 17:25:43');

-- --------------------------------------------------------

--
-- Table structure for table `doctors_list`
--

CREATE TABLE `doctors_list` (
  `id` int(30) NOT NULL,
  `name` text NOT NULL,
  `name_pref` varchar(100) NOT NULL,
  `contact` text NOT NULL,
  `email` text NOT NULL,
  `specialty_ids` text NOT NULL,
  `cname` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `doctors_list`
--

INSERT INTO `doctors_list` (`id`, `name`, `name_pref`, `contact`, `email`, `specialty_ids`, `cname`, `address`, `city`, `image`, `date_created`) VALUES
(124, 'Louielyn Salas', 'M.D.', '09551405749', 'salas@gmail.com', 'Dentist', 'Optical Works', 'SM City Lipa', 'Lipa City', 'doc f.jpg', '2021-12-01 13:43:04'),
(126, 'Allister Dio', 'M.D.', '+639211245567', 'atdio@gmail.com', 'General Physician', 'A.T DIO Optical Clinic', 'Rosario, Batangas', 'Rosario', 'opto.jpg', '2021-12-01 15:03:38'),
(127, 'Louielyn B. Salas', 'M.D.', '+639211245567', 'opticalworks@gmail.com', 'Obstetrician/Gynecologist', 'A.T DIO Optical Clinic', 'Rosario, Batangas', 'Rosario', 'doc f.jpg', '2021-12-01 15:03:51');

-- --------------------------------------------------------

--
-- Table structure for table `doctors_schedule`
--

CREATE TABLE `doctors_schedule` (
  `id` int(30) NOT NULL,
  `doctor_id` int(30) NOT NULL,
  `day` varchar(20) NOT NULL,
  `time_from` time NOT NULL,
  `time_to` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `doctors_schedule`
--

INSERT INTO `doctors_schedule` (`id`, `doctor_id`, `day`, `time_from`, `time_to`) VALUES
(382, 124, 'Monday', '22:54:00', '14:54:00'),
(386, 124, 'Tuesday', '22:04:00', '23:04:00');

-- --------------------------------------------------------

--
-- Table structure for table `fecalysis`
--

CREATE TABLE `fecalysis` (
  `id` int(11) NOT NULL,
  `clinic` varchar(255) NOT NULL,
  `clinic_id` varchar(255) NOT NULL,
  `patient` varchar(255) NOT NULL,
  `patient_id` varchar(255) NOT NULL,
  `Test` int(100) NOT NULL,
  `Result_fec` int(100) NOT NULL,
  `Units_fec` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `id` int(11) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'Patient',
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `age` varchar(15) NOT NULL,
  `birth` varchar(255) NOT NULL,
  `sex` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) NOT NULL,
  `c_illness` text CHARACTER SET utf8mb4 NOT NULL,
  `m_problems` text CHARACTER SET utf8mb4 NOT NULL,
  `father` text NOT NULL,
  `f_age` varchar(255) NOT NULL,
  `f_cause` varchar(255) NOT NULL,
  `mother` text NOT NULL,
  `m_age` varchar(255) NOT NULL,
  `m_cause` varchar(255) NOT NULL,
  `other` text CHARACTER SET utf8mb4 NOT NULL,
  `disease` text CHARACTER SET utf8mb4 NOT NULL,
  `drug` text CHARACTER SET utf8mb4 NOT NULL,
  `reaction` text CHARACTER SET utf8mb4 NOT NULL,
  `clinic` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `medication` text NOT NULL,
  `reason` text NOT NULL,
  `card_num` varchar(255) NOT NULL,
  `card_name` varchar(255) NOT NULL,
  `card_expi` varchar(255) NOT NULL,
  `card_cvv` varchar(255) NOT NULL,
  `plan` tinyint(1) NOT NULL DEFAULT 0 COMMENT '1=premium, 0=basic'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`id`, `role`, `username`, `password`, `name`, `age`, `birth`, `sex`, `status`, `email`, `phone`, `address`, `c_illness`, `m_problems`, `father`, `f_age`, `f_cause`, `mother`, `m_age`, `m_cause`, `other`, `disease`, `drug`, `reaction`, `clinic`, `image`, `date_created`, `medication`, `reason`, `card_num`, `card_name`, `card_expi`, `card_cvv`, `plan`) VALUES
(148, 'Patient', 'gingrumo', '3ade3fd6e8eef84f2ea91f6474be10d9', 'Grace Jimenez Grumo', '22', '', '', '', 'grumo.014262@lipa.sti.edu.ph', '+639551405749', '198 Sala, Balete, Batangas', '', '', '', '', '', '', '', '', '', '', '', '', '', 'ging.jpg', '2021-12-01 06:43:03', '', '', '4343 1413 4141 4114', 'Grace Grumo', '2022-06', '141', 1);

-- --------------------------------------------------------

--
-- Table structure for table `temp`
--

CREATE TABLE `temp` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `age` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `address` varchar(255) NOT NULL,
  `cname` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `otp` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `urinalysis`
--

CREATE TABLE `urinalysis` (
  `Laboratory Test` text NOT NULL,
  `Patient Value` varchar(100) NOT NULL,
  `Normal Range` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'Clinic',
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `cname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `card_num` varchar(255) NOT NULL,
  `card_name` varchar(255) NOT NULL,
  `card_expi` varchar(255) NOT NULL,
  `card_cvv` varchar(255) NOT NULL,
  `bir` varchar(255) NOT NULL,
  `mayor` varchar(255) NOT NULL,
  `license` varchar(255) NOT NULL,
  `build` varchar(255) NOT NULL,
  `doh` varchar(255) NOT NULL,
  `operate` varchar(255) NOT NULL,
  `bfp` varchar(255) NOT NULL,
  `valid` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0= for verification, 1=confirmed'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role`, `username`, `password`, `cname`, `email`, `phone`, `address`, `city`, `image`, `card_num`, `card_name`, `card_expi`, `card_cvv`, `bir`, `mayor`, `license`, `build`, `doh`, `operate`, `bfp`, `valid`, `status`) VALUES
(153, 'Clinic', 'opticalworks', '3ade3fd6e8eef84f2ea91f6474be10d9', 'Optical Works', 'opticalworks@gmail.com', '+639551405749', 'SM City Lipa', 'Lipa City', 'doc f.jpg', '1414 1341 3414 1343', ' Louielyn B. Salas', '2022-11', '3134', 'IMG_20211201_123407_288.jpg', 'samplejpg.jpg', 'IMG_20211201_123407_288.jpg', 'IMG_20211201_123407_288.jpg', 'IMG_20211201_123407_288.jpg', 'samplejpg.jpg', 'samplejpg.jpg', 'samplejpg.jpg', 1),
(154, 'Clinic', 'atdiooptical', '3ade3fd6e8eef84f2ea91f6474be10d9', 'A.T DIO Optical Clinic', 'atdioclinic@gmail.com', '+639551405749', 'Rosario, Batangas', 'Rosario', '', '1514 5154 1515 1515', 'Allister Dio', '2022-11', '2442', 'IMG_20211201_123407_288.jpg', 'samplejpg.jpg', 'IMG_20211201_123407_288.jpg', 'IMG_20211201_123407_288.jpg', 'IMG_20211201_123407_288.jpg', 'samplejpg.jpg', 'samplejpg.jpg', 'samplejpg.jpg', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointment_list`
--
ALTER TABLE `appointment_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cbc`
--
ALTER TABLE `cbc`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cholesterol`
--
ALTER TABLE `cholesterol`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctors_list`
--
ALTER TABLE `doctors_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctors_schedule`
--
ALTER TABLE `doctors_schedule`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fecalysis`
--
ALTER TABLE `fecalysis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `temp`
--
ALTER TABLE `temp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointment_list`
--
ALTER TABLE `appointment_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `doctors_list`
--
ALTER TABLE `doctors_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;

--
-- AUTO_INCREMENT for table `doctors_schedule`
--
ALTER TABLE `doctors_schedule`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=387;

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=149;

--
-- AUTO_INCREMENT for table `temp`
--
ALTER TABLE `temp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=155;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
