-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 08, 2021 at 10:19 AM
-- Server version: 5.6.26
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `survey`
--

-- --------------------------------------------------------

--
-- Table structure for table `survey_experiment`
--

CREATE TABLE IF NOT EXISTS `survey_experiment` (
  `experiment_id` int(11) NOT NULL,
  `IP` varchar(30) DEFAULT NULL,
  `StartDate` varchar(30) DEFAULT NULL,
  `EndDate` varchar(30) DEFAULT NULL,
  `Consent` varchar(30) DEFAULT NULL,
  `Video_Game` varchar(30) DEFAULT NULL,
  `ExperimentChoice` varchar(30) DEFAULT NULL,
  `ExperimentToken` varchar(30) DEFAULT NULL,
  `Timer_First_Click` varchar(30) DEFAULT NULL,
  `Timer_Last_Click` varchar(30) DEFAULT NULL,
  `WHO` varchar(30) DEFAULT NULL,
  `Gender` varchar(30) DEFAULT NULL,
  `Age` varchar(30) DEFAULT NULL,
  `Education` varchar(30) DEFAULT NULL,
  `Confirmation` varchar(30) DEFAULT NULL,
  `ExperimentReceived` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `survey_questions_limit`
--

CREATE TABLE IF NOT EXISTS `survey_questions_limit` (
  `questions_limit_id` int(11) NOT NULL,
  `questions_limit` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `survey_questions_limit`
--

INSERT INTO `survey_questions_limit` (`questions_limit_id`, `questions_limit`) VALUES
(1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `survey_experiment`
--
ALTER TABLE `survey_experiment`
  ADD PRIMARY KEY (`experiment_id`);

--
-- Indexes for table `survey_questions_limit`
--
ALTER TABLE `survey_questions_limit`
  ADD PRIMARY KEY (`questions_limit_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `survey_experiment`
--
ALTER TABLE `survey_experiment`
  MODIFY `experiment_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `survey_questions_limit`
--
ALTER TABLE `survey_questions_limit`
  MODIFY `questions_limit_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
