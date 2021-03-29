-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 29, 2021 at 10:30 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `records`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_username` varchar(100) NOT NULL,
  `admin_password` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_username`, `admin_password`) VALUES
('adminadmin', '$2y$10$XzqXwMXv/a03OdvpjXqmheBzkeLZD1SsOeuZJXft5fBjf4Xu71wDS');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `course_id` int(11) NOT NULL,
  `course_code` varchar(20) DEFAULT NULL,
  `course_title` varchar(100) DEFAULT NULL,
  `course_units` float(4,2) DEFAULT NULL,
  `course_max_students` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`course_id`, `course_code`, `course_title`, `course_units`, `course_max_students`) VALUES
(27, 'CMSC 11', 'Introduction to Computer Science', 3.00, 47),
(28, 'CMSC 21', 'Fundamentals of Programming', 3.00, 67),
(29, 'CMSC 22', 'Object Oriented Programming', 3.00, 37),
(30, 'CMSC 56', 'Discrete Mathematical Structures in Computer Science I', 3.00, 22),
(31, 'CMSC 57', 'Discrete Mathematical Structures in Computer Science II', 3.00, 42),
(32, 'CMSC 100', 'Web Programming', 3.00, 52);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `student_id` int(11) NOT NULL,
  `student_username` varchar(50) DEFAULT NULL,
  `student_password` varchar(200) DEFAULT NULL,
  `student_fname` varchar(50) DEFAULT NULL,
  `student_mname` varchar(50) DEFAULT NULL,
  `student_lname` varchar(50) DEFAULT NULL,
  `student_no` varchar(10) DEFAULT NULL,
  `student_degree_program` varchar(20) DEFAULT NULL,
  `student_college` varchar(50) DEFAULT NULL,
  `student_max_units` float(4,2) DEFAULT NULL,
  `student_status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`student_id`, `student_username`, `student_password`, `student_fname`, `student_mname`, `student_lname`, `student_no`, `student_degree_program`, `student_college`, `student_max_units`, `student_status`) VALUES
(1, 'atmatawaran', '$2y$10$xjVwY0lb1K6H2tUHpFwbF.R3R2y3APlHZaUXb/vPUG3ZNeK/xLQRe', 'Ana Marion', 'Tambongco', 'Matawaran', '2015-09393', 'BS Computer Science', 'CAS', 18.00, 'not_enrolled'),
(2, 'bsluna', '$2y$10$ZtADTb/4NRlmJWCREXP2gOUXGCNk6JUTSkVuN8gA6heVwkXG3LTdW', 'Byron John', 'Santos', 'Luna', '2014-53693', 'BS Computer Science', 'CAS', 18.00, 'not_enrolled'),
(17, 'mariuskun', '$2y$10$X.9nuHsY31g47SSywp5v0u2w5p.gQWVmbdQ1poCru0GqEg5NBIqzm', 'Richard Marius ', 'Tambongco', 'Matawaran', '2015-09999', 'BS Applied Math', 'CAS', 18.00, 'not_enrolled'),
(18, 'celineceline', '$2y$10$t3fSpAkRt/2mSFHbAwicq.x08O7PRjbA/XEQk2xisCm1KWY/KvymC', 'Celine', 'Tambongco', 'Matawaran', '2015-09333', 'BS Statistics', 'CAS', 18.00, 'not_enrolled'),
(19, 'aldog', '$2y$10$TSzRS6D.yJBy4uUwCDJH1OQBRZVxB1dhfl4Zo/N7Zwn1PTtWvJJj.', 'Aldous Xavier', 'Aguila', 'Palcon', '2014-09172', 'BS Forestry', 'CFNR', 18.00, 'not_enrolled'),
(20, 'jonahariola', '$2y$10$iuprYezu7SOsqMbzSNrJT.ksOyCrla5fQTAeD05UsLp8HtjHBUWtS', 'Jonah Praise', 'Moreno', 'Ariola', '2014-53685', 'BS Computer Science', 'CAS', 18.00, 'not_enrolled');

-- --------------------------------------------------------

--
-- Table structure for table `student_course_cart`
--

CREATE TABLE `student_course_cart` (
  `s_c_id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `course_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `student_course_enrolled`
--

CREATE TABLE `student_course_enrolled` (
  `s_c_e_id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `course_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_username`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`student_id`);

--
-- Indexes for table `student_course_cart`
--
ALTER TABLE `student_course_cart`
  ADD PRIMARY KEY (`s_c_id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `student_course_enrolled`
--
ALTER TABLE `student_course_enrolled`
  ADD PRIMARY KEY (`s_c_e_id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `course_id` (`course_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `student_course_cart`
--
ALTER TABLE `student_course_cart`
  MODIFY `s_c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=160;

--
-- AUTO_INCREMENT for table `student_course_enrolled`
--
ALTER TABLE `student_course_enrolled`
  MODIFY `s_c_e_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `student_course_cart`
--
ALTER TABLE `student_course_cart`
  ADD CONSTRAINT `student_course_cart_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `student_course_cart_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `courses` (`course_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `student_course_enrolled`
--
ALTER TABLE `student_course_enrolled`
  ADD CONSTRAINT `student_course_enrolled_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `student_course_enrolled_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `courses` (`course_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
