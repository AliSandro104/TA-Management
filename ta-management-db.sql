-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 03, 2022 at 02:19 AM
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
-- Table structure for table `all_students`
--

CREATE TABLE `all_students` (
  `email` varchar(100) NOT NULL,
  `studentID` varchar(100) NOT NULL,
  `courseNumber` varchar(100) NOT NULL,
  `term` varchar(100) NOT NULL,
  `year` varchar(100) NOT NULL,
  `firstName` varchar(100) DEFAULT NULL,
  `lastName` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `all_students`
--

INSERT INTO `all_students` (`email`, `studentID`, `courseNumber`, `term`, `year`, `firstName`, `lastName`) VALUES
('t1@test.com', '111111111', '0', '0', '2022', NULL, NULL),
('t1@test.com', '111111111', '0', '0', '2023', NULL, NULL),
('t1@test.com', '111111111', '0', '0', '2023', NULL, NULL),
('t2@test.com', '222222222', '0', '0', '2022', NULL, NULL),
('t2@test.com', '222222222', '0', '0', '2023', NULL, NULL),
('t2@test.com', '222222222', '0', '0', '2023', NULL, NULL),
('t4@test.com', '444444444', 'COMP 250', 'Fall', '2022', NULL, NULL),
('t4@test.com', '444444444', 'COMP 307', 'Winter', '2023', NULL, NULL),
('t4@test.com', '444444444', 'COMP 402', 'Winter', '2023', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `all_ta`
--

CREATE TABLE `all_ta` (
  `email` varchar(100) NOT NULL,
  `courseNumber` varchar(100) NOT NULL,
  `term` varchar(100) NOT NULL,
  `year` varchar(100) NOT NULL,
  `firstName` varchar(100) DEFAULT NULL,
  `lastName` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `all_ta`
--

INSERT INTO `all_ta` (`email`, `courseNumber`, `term`, `year`, `firstName`, `lastName`) VALUES
('t8@test.com', 'COMP 250', 'Fall', '2022', NULL, NULL),
('t8@test.com', 'COMP 307', 'Winter', '2023', NULL, NULL),
('t1@test.com', 'COMP 250', 'Fall', '2022', NULL, NULL),
('t1@test.com', 'COMP 307', 'Winter', '2023', NULL, NULL),
('t4@test.com', 'COMP 250', 'Fall', '2022', NULL, NULL),
('t4@test.com', 'COMP 307', 'Winter', '2023', NULL, NULL);

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
('test', 'test', 'Winter', '2023', 'COMP 307', 'joseph@comp307.com'),
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
  `TAQuota` int(11) NOT NULL,
  `PositionsToAssign` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `courses_quota`
--

INSERT INTO `courses_quota` (`TermYear`, `CourseNumber`, `CourseName`, `CourseType`, `InstructorName`, `EnrollmentNumber`, `TAQuota`, `PositionsToAssign`) VALUES
('Fall 2022', 'COMP 250', 'Intro to Computer Science', 'Regular', 'Giulia Alberini', 80, 2, 2),
('Winter 2023', 'COMP 250', 'Intro to Computer Science', 'Regular', 'Giulia Alberini', 100, 3, 3),
('Winter 2023', 'COMP 421', 'Database Systems', 'Regular', 'Bettina Kemme', 200, 6, 6),
('Fall 2022', 'COMP 307', 'Principles of Web Development', 'Regular', 'Joseph Vybihal', 100, 3, 2),
('Winter 2023', 'COMP 402', 'Honours Project in Computer Science and Biology', 'Regular', 'Mathieu Blanchette', 40, 1, 0);

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
('avi@comp307.com', 'Science', 'Computer Science', 'COMP 250'),
('joseph@comp307.com', 'Science', 'Computer Science', 'COMP 250'),
('mathieu@comp307.com', 'Science', 'Computer Science', 'COMP 402');

-- --------------------------------------------------------

--
-- Table structure for table `ta_assigned`
--

CREATE TABLE `ta_assigned` (
  `AssignID` int(11) NOT NULL,
  `TermYear` varchar(100) NOT NULL,
  `CourseNum` varchar(100) NOT NULL,
  `TAName` varchar(100) NOT NULL,
  `StudentID` varchar(100) NOT NULL,
  `TAEmail` varchar(100) NOT NULL,
  `AssignedHours` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ta_assigned`
--

INSERT INTO `ta_assigned` (`AssignID`, `TermYear`, `CourseNum`, `TAName`, `StudentID`, `TAEmail`, `AssignedHours`) VALUES
(5, 'Fall 2022', 'COMP 307', 'Ali Hazime', '111222333', 'ali.hazime@mail.mcgill.ca', 90),
(6, 'Winter 2023', 'COMP 402', 'Moustapha Moumneh', '444555666', 'moustapha.moumneh@mail.mcgill.ca', 180);

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
('Winter 2023', 'Ali Hazime', '111222333', 'Ali Hazime', 'ali.hazime@mail.mcgill.ca', 'ugrad', 'Joseph Vybihal', 'no', 90, '2022-11-29', 'trottier', '5141234567', 'Computer Science', 'COMP 250; COMP 421', 'yes', 'Dont choose me'),
('Winter 2023', 'Moustapha Moumneh', '444555666', 'Moustapha Moumneh', 'moustapha.moumneh@mail.mcgill.ca', 'grad', 'Mathieu Blanchette', 'yes', 180, '2022-10-29', 'adams', '5149876543', 'Computer Science', 'COMP 402; COMP 421', 'no', ''),
('Fall 2022', 'Ali Hazime', '111222333', 'Ali Hazime', 'ali.hazime@mail.mcgill.ca', 'ugrad', 'Joseph Vybihal', 'no', 90, '2022-11-10', 'trottier', '5141234567', 'Computer Science', 'COMP 250', 'yes', ''),
('Winter 2023', 'Hai Thien Doan Nguyen', '777888999', 'Hai Thien Doan Nguyen', 'hai.thien@mail.mcgill.ca', 'grad', 'Giulia Alberini', 'yes', 180, '2022-04-15', 'McIntyre', '5145145145', 'Computer Science', 'COMP 250; COMP 421', 'yes', 'Hello'),
('Fall 2022', 'Hai Thien Doan Nguyen', '777888999', 'Hai Thien Doan Nguyen', 'hai.thien@mail.mcgill.ca', 'grad', 'Giulia Alberini', 'yes', 180, '2022-09-13', 'McIntyre', '5145145145', 'Computer Science', 'COMP 307; COMP 250', 'yes', 'Bye');

-- --------------------------------------------------------

--
-- Table structure for table `ta_history`
--

CREATE TABLE `ta_history` (
  `TermYear` varchar(100) NOT NULL,
  `TAName` varchar(100) NOT NULL,
  `TAEmail` varchar(100) NOT NULL,
  `CourseNumber` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ta_history`
--

INSERT INTO `ta_history` (`TermYear`, `TAName`, `TAEmail`, `CourseNumber`) VALUES
('Fall 2020', 'Ali Hazime', 'ali.hazime@mail.mcgill.ca', 'COMP 202'),
('Winter 2021', 'Hai Thien Doan Nguyen', 'hai.thien@mail.mcgill.ca', 'COMP 206'),
('Winter 2021', 'Ali Hazime', 'ali.hazime@mail.mcgill.ca', 'COMP 202'),
('Fall 2021', 'Moustapha Moumneh', 'moustapha.moumneh@mail.mcgill.ca', 'COMP 251'),
('Fall 2022', 'Ali Hazime', 'ali.hazime@mail.mcgill.ca', 'COMP 307'),
('Winter 2023', 'Moustapha Moumneh', 'moustapha.moumneh@mail.mcgill.ca', 'COMP 402');

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
('Jane', 'Doe', 'jane@comp307.com', '$2y$10$Jq/Ab6L6yPpGbPmyt5tC1e5uO81fP4YBLAow4LHPRgVtLjU8rcK7C', '2022-10-13 18:09:22', '2022-10-13 18:09:22'),
('John', 'Doe', 'john@comp307.com', '$2y$10$jAGY.QSoQwIoTH13LWUaKu3LdCoYOG2zey0pz4qJNtTdaF3G4Elqy', '2022-10-09 16:46:43', '2022-10-09 16:46:43'),
('Joseph', 'Vybihal', 'joseph@comp307.com', '$2y$10$MwaR9.9RqkKnjGsj6ELtAugh4EwRjh84esjwp6tf52XOTZpy6xxGu', '2022-10-13 14:36:07', '2022-10-13 14:36:07'),
('Mathieu', 'Blanchette', 'mathieu@comp307.com', '$2y$10$5HxIGFEmYO6OyG7IOgjlmuCRofwLTG2Ah9DtiEdGetHD.rZZN0Xbq', '2022-10-13 18:09:22', '2022-10-13 18:09:22'),
('t1', 't1', 't1@test.com', '111', '2022-12-02 09:35:43', '2022-12-02 09:35:43'),
('t2', 't2', 't2@test.com', '222', '2022-12-02 09:41:41', '2022-12-02 09:41:41'),
('t4', 't4', 't4@test.com', '444', '2022-12-02 09:43:43', '2022-12-02 09:43:43');

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
('t1@test.com', 1),
('t1@test.com', 2),
('t1@test.com', 3),
('t1@test.com', 4),
('t2@test.com', 1),
('t4@test.com', 1),
('t4@test.com', 2),
('t4@test.com', 3),
('t4@test.com', 4);

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
-- Indexes for table `ta_assigned`
--
ALTER TABLE `ta_assigned`
  ADD PRIMARY KEY (`AssignID`);

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ta_assigned`
--
ALTER TABLE `ta_assigned`
  MODIFY `AssignID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
