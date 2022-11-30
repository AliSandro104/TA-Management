-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 01, 2022 at 12:13 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ta-management`
--

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `courseName` varchar(256) NOT NULL,
  `courseDesc` text NOT NULL,
  `term` varchar(8) NOT NULL,
  `year` varchar(4) NOT NULL,
  `courseNumber` varchar(8) NOT NULL,
  `courseInstructor` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`courseName`, `courseDesc`, `term`, `year`, `courseNumber`, `courseInstructor`) VALUES
('Principles of Web Development', 'The course discusses the major principles, algorithms, languages and technologies that underlie web development. Students receive practical hands-on experience through a project.', 'Fall', '2022', 'COMP 250', 'joseph@comp307.com'),
('Honours Project in Computer Science and Biology', 'One-semester research project applying computational approaches to a biological problem. The project is (co)-supervised by a professor in Computer Science and/or Biology or related fields.', 'Winter', '2023', 'COMP 402', 'mathieu@comp307.com');

-- --------------------------------------------------------

--
-- Table structure for table `courses_quota`
--

CREATE TABLE `courses_quota` (
  `TermYear` varchar(100) NOT NULL,
  `CourseNumber` varchar(100) NOT NULL,
  `CourseName` varchar(100) NOT NULL,
  `CourseType` varchar(100) NOT NULL,
  `InstructorName` varchar(100) NOT NULL,
  `EnrollmentNumber` int(11) NOT NULL,
  `TAQuota` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `courses_quota`
--

INSERT INTO `courses_quota` (`TermYear`, `CourseNumber`, `CourseName`, `CourseType`, `InstructorName`, `EnrollmentNumber`, `TAQuota`) VALUES
('Winter 2023', 'COMP 250', 'Regular', 'Intro to Computer Science', 'Giulia Alberini', 100, 3),
('Winter 2023', 'COMP 421', 'Regular', 'Database Systems', 'Bettina Kemme', 90, 4);

-- --------------------------------------------------------

--
-- Table structure for table `professor`
--

CREATE TABLE `professor` (
  `professor` varchar(40) NOT NULL,
  `faculty` varchar(30) NOT NULL,
  `department` varchar(30) NOT NULL,
  `course` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `professor`
--

INSERT INTO `professor` (`professor`, `faculty`, `department`, `course`) VALUES
('joseph@comp307.com', 'Science', 'Computer Science', 'COMP 250'),
('mathieu@comp307.com', 'Science', 'Computer Science', 'COMP 402');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `email` varchar(1000) NOT NULL,
  `studentID` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`email`, `studentID`) VALUES
('jj2@test.com', '1111'),
('bb@test.com', '0'),
('cc@test.com', '0'),
('dd@test.com', '0'),
('test1@test.com', '181818188'),
('test2@test.com', '181818188'),
('test3@test.com', '181818188'),
('test4@test.com', '181818188'),
('test5@test.com', '555555555');

-- --------------------------------------------------------

--
-- Table structure for table `ta_assigned`
--

CREATE TABLE `ta_assigned` (
  `TAName` varchar(100) NOT NULL,
  `TAEmail` varchar(100) NOT NULL,
  `CourseAssigned` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `ta_cohort`
--

CREATE TABLE `ta_cohort` (
  `TermYear` varchar(100) NOT NULL,
  `TAName` varchar(100) NOT NULL,
  `StudentID` varchar(100) NOT NULL,
  `LegalName` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `GradUgrad` varchar(100) NOT NULL,
  `SupervisorName` varchar(100) NOT NULL,
  `Priority` varchar(100) NOT NULL,
  `NumberHours` int(11) NOT NULL,
  `DateApplied` varchar(100) NOT NULL,
  `TheLocation` varchar(100) NOT NULL,
  `Phone` varchar(100) NOT NULL,
  `Degree` varchar(100) NOT NULL,
  `CoursesApplied` varchar(100) NOT NULL,
  `OpenToOtherCourses` varchar(100) NOT NULL,
  `Notes` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ta_cohort`
--

INSERT INTO `ta_cohort` (`TermYear`, `TAName`, `StudentID`, `LegalName`, `Email`, `GradUgrad`, `SupervisorName`, `Priority`, `NumberHours`, `DateApplied`, `TheLocation`, `Phone`, `Degree`, `CoursesApplied`, `OpenToOtherCourses`, `Notes`) VALUES
('Winter 2023', 'Ali Hazime', '111222333', 'Ali Hazime', 'ali.hazime@mail.mcgill.ca', 'ugrad', 'Giulia Alberini', 'no', 90, '2022-11-29', 'trottier', '5141234567', 'Computer Science', 'COMP 250', 'yes', ''),
('Winter 2023', 'Moustapha Moumneh', '444555666', 'Moustapha Moumneh', 'moustapha.moumneh@mail.mcgill.ca', 'grad', 'Mathieu Blanchette', 'yes', 180, '2022-10-29', 'trottier', '5149876543', 'Computer Science', 'COMP 250', 'no', '');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `firstName` varchar(40) NOT NULL,
  `lastName` varchar(40) NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` varchar(100) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`firstName`, `lastName`, `email`, `password`, `createdAt`, `updatedAt`) VALUES
('Avinash', 'Bhat', 'avi@comp307.com', '$2y$10$iqQA5ffMBUaBn0weeSM8.eKbEwhyGPOqV.DxKL.Ox2A1cq.0QfpuW', '2022-10-11 04:42:50', '2022-10-11 04:42:50'),
('d', 'd', 'dd@test.com', '4444', '2030-11-22 10:27:21', '2030-11-22 10:27:21'),
('Jane', 'Doe', 'jane@comp307.com', '$2y$10$Jq/Ab6L6yPpGbPmyt5tC1e5uO81fP4YBLAow4LHPRgVtLjU8rcK7C', '2022-10-13 18:09:22', '2022-10-13 18:09:22'),
('John', 'Doe', 'john@comp307.com', '$2y$10$jAGY.QSoQwIoTH13LWUaKu3LdCoYOG2zey0pz4qJNtTdaF3G4Elqy', '2022-10-09 16:46:43', '2022-10-09 16:46:43'),
('Joseph', 'Vybihal', 'joseph@comp307.com', '$2y$10$MwaR9.9RqkKnjGsj6ELtAugh4EwRjh84esjwp6tf52XOTZpy6xxGu', '2022-10-13 14:36:07', '2022-10-13 14:36:07'),
('Mathieu', 'Blanchette', 'mathieu@comp307.com', '$2y$10$5HxIGFEmYO6OyG7IOgjlmuCRofwLTG2Ah9DtiEdGetHD.rZZN0Xbq', '2022-10-13 18:09:22', '2022-10-13 18:09:22'),
('test1', 't1', 'test1@test.com', '9999', '2022-11-30 12:07:45', '2022-11-30 12:07:45'),
('test2', 't1', 'test2@test.com', '9999', '2022-11-30 12:09:23', '2022-11-30 12:09:23'),
('test3', 't3', 'test3@test.com', '9999', '2022-11-30 12:09:59', '2022-11-30 12:09:59'),
('test4', 't4', 'test4@test.com', '9999', '2022-11-30 12:10:57', '2022-11-30 12:10:57'),
('test5', 't5', 'test5@test.com', '5555', '2022-11-30 06:16:23', '2022-11-30 06:16:23'),
('time', 'time', 'time@test.com', '1111', '2022-11-30 12:06:45', '2022-11-30 12:06:45');

-- --------------------------------------------------------

--
-- Table structure for table `usertype`
--

CREATE TABLE `usertype` (
  `idx` int(11) NOT NULL,
  `userType` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `usertype`
--

INSERT INTO `usertype` (`idx`, `userType`) VALUES
(1, 'student'),
(2, 'professor'),
(3, 'ta'),
(4, 'admin'),
(5, 'sysop');

-- --------------------------------------------------------

--
-- Table structure for table `user_courses`
--

CREATE TABLE `user_courses` (
  `email` varchar(1000) NOT NULL,
  `courses` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_courses`
--

INSERT INTO `user_courses` (`email`, `courses`) VALUES
('test4@test.com', 'COMP 250'),
('test4@test.com', 'COMP 402'),
('test5@test.com', 'COMP 250'),
('test5@test.com', 'COMP 402');

-- --------------------------------------------------------

--
-- Table structure for table `user_usertype`
--

CREATE TABLE `user_usertype` (
  `userId` varchar(40) NOT NULL,
  `userTypeId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_usertype`
--

INSERT INTO `user_usertype` (`userId`, `userTypeId`) VALUES
('john@comp307.com', 5),
('avi@comp307.com', 5),
('joseph@comp307.com', 2),
('jane@comp307.com', 3),
('jane@comp307.com', 1),
('mathieu@comp307.com', 2),
('mathieu@comp307.com', 5),
('mathieu@comp307.com', 4),
('dd@test.com', 1),
('dd@test.com', 2),
('dd@test.com', 3),
('time@test.com', 2),
('time@test.com', 3),
('test1@test.com', 1),
('test1@test.com', 3),
('test2@test.com', 1),
('test2@test.com', 3),
('test3@test.com', 1),
('test3@test.com', 3),
('test4@test.com', 1),
('test4@test.com', 3),
('test5@test.com', 1),
('test5@test.com', 2),
('test5@test.com', 3),
('test5@test.com', 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`courseNumber`),
  ADD KEY `CourseInstructor_ForeignKey` (`courseInstructor`);

--
-- Indexes for table `professor`
--
ALTER TABLE `professor`
  ADD PRIMARY KEY (`professor`),
  ADD KEY `CourseNumber_ForeignKey` (`course`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`email`),
  ADD KEY `email` (`email`);

--
-- Indexes for table `usertype`
--
ALTER TABLE `usertype`
  ADD PRIMARY KEY (`idx`),
  ADD KEY `idx` (`idx`);

--
-- Indexes for table `user_usertype`
--
ALTER TABLE `user_usertype`
  ADD KEY `User_ForeignKey` (`userId`),
  ADD KEY `UserType_ForeignKey` (`userTypeId`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `course`
--
ALTER TABLE `course`
  ADD CONSTRAINT `CourseInstructor_ForeignKey` FOREIGN KEY (`courseInstructor`) REFERENCES `user` (`email`) ON UPDATE CASCADE;

--
-- Constraints for table `professor`
--
ALTER TABLE `professor`
  ADD CONSTRAINT `CourseNumber_ForeignKey` FOREIGN KEY (`course`) REFERENCES `course` (`courseNumber`) ON UPDATE CASCADE,
  ADD CONSTRAINT `ProfName_ForeignKey` FOREIGN KEY (`professor`) REFERENCES `user` (`email`) ON UPDATE CASCADE;

--
-- Constraints for table `user_usertype`
--
ALTER TABLE `user_usertype`
  ADD CONSTRAINT `UserType_ForeignKey` FOREIGN KEY (`userTypeId`) REFERENCES `usertype` (`idx`) ON UPDATE CASCADE,
  ADD CONSTRAINT `User_ForeignKey` FOREIGN KEY (`userId`) REFERENCES `user` (`email`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
