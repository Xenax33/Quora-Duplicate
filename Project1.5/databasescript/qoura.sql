-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 29, 2023 at 05:48 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `qoura`
--

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE `answers` (
  `answerId` int(11) NOT NULL,
  `questionId` int(11) NOT NULL,
  `UserId` int(11) NOT NULL,
  `body` varchar(255) NOT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `UpVotes` int(11) DEFAULT 0,
  `DownVotes` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`answerId`, `questionId`, `UserId`, `body`, `CreatedAt`, `UpVotes`, `DownVotes`) VALUES
(8, 28, 4, 'Earth is not round it is slightly oval and tilted, there were theories that earth is flat but they were proven wrong.', '2023-11-21 17:54:09', 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `followers`
--

CREATE TABLE `followers` (
  `id` int(11) NOT NULL,
  `Followedby` int(11) NOT NULL,
  `Following` int(11) NOT NULL,
  `FollowedAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `followers`
--

INSERT INTO `followers` (`id`, `Followedby`, `Following`, `FollowedAt`) VALUES
(1, 4, 8, '2023-11-28 09:14:24'),
(4, 4, 9, '2023-11-28 09:14:39'),
(5, 4, 7, '2023-11-28 09:18:41'),
(6, 10, 9, '2023-11-29 04:22:01'),
(7, 10, 4, '2023-11-29 04:22:08');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `LoginID` int(11) NOT NULL,
  `UserId` int(11) NOT NULL,
  `LoginTime` timestamp NOT NULL DEFAULT current_timestamp(),
  `LogoutTime` datetime NOT NULL,
  `Active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`LoginID`, `UserId`, `LoginTime`, `LogoutTime`, `Active`) VALUES
(2, 3, '2023-11-17 19:31:40', '0000-00-00 00:00:00', 1),
(3, 4, '2023-11-17 19:34:29', '0000-00-00 00:00:00', 1),
(4, 3, '2023-11-17 14:54:29', '0000-00-00 00:00:00', 1),
(5, 3, '2023-11-17 14:54:39', '0000-00-00 00:00:00', 1),
(6, 4, '2023-11-17 15:05:17', '0000-00-00 00:00:00', 1),
(7, 4, '2023-11-17 15:09:13', '0000-00-00 00:00:00', 1),
(8, 4, '2023-11-17 15:11:33', '0000-00-00 00:00:00', 1),
(9, 4, '2023-11-17 15:16:12', '0000-00-00 00:00:00', 1),
(10, 4, '2023-11-18 08:08:06', '0000-00-00 00:00:00', 1),
(11, 4, '2023-11-18 09:08:47', '0000-00-00 00:00:00', 1),
(12, 4, '2023-11-18 17:53:04', '0000-00-00 00:00:00', 1),
(13, 8, '2023-11-19 10:18:06', '0000-00-00 00:00:00', 1),
(14, 8, '2023-11-20 12:31:52', '0000-00-00 00:00:00', 1),
(15, 4, '2023-11-20 18:38:29', '0000-00-00 00:00:00', 1),
(16, 4, '2023-11-21 03:58:55', '0000-00-00 00:00:00', 1),
(17, 4, '2023-11-21 04:08:45', '0000-00-00 00:00:00', 1),
(18, 4, '2023-11-21 04:09:55', '0000-00-00 00:00:00', 1),
(19, 4, '2023-11-21 04:14:23', '0000-00-00 00:00:00', 1),
(20, 4, '2023-11-21 04:15:13', '0000-00-00 00:00:00', 1),
(21, 4, '2023-11-21 04:16:52', '0000-00-00 00:00:00', 1),
(22, 4, '2023-11-21 04:19:47', '0000-00-00 00:00:00', 1),
(23, 4, '2023-11-21 15:49:45', '0000-00-00 00:00:00', 1),
(24, 3, '2023-11-21 17:56:01', '0000-00-00 00:00:00', 1),
(25, 3, '2023-11-22 04:14:31', '0000-00-00 00:00:00', 1),
(26, 3, '2023-11-22 04:20:35', '0000-00-00 00:00:00', 1),
(27, 7, '2023-11-22 05:01:22', '0000-00-00 00:00:00', 1),
(28, 4, '2023-11-22 17:50:31', '0000-00-00 00:00:00', 1),
(29, 10, '2023-11-22 19:05:28', '0000-00-00 00:00:00', 1),
(30, 4, '2023-11-23 08:11:51', '0000-00-00 00:00:00', 1),
(31, 8, '2023-11-24 06:55:39', '0000-00-00 00:00:00', 1),
(32, 10, '2023-11-25 06:11:53', '0000-00-00 00:00:00', 1),
(33, 4, '2023-11-28 06:20:47', '0000-00-00 00:00:00', 1),
(34, 4, '2023-11-28 15:43:38', '0000-00-00 00:00:00', 1),
(35, 10, '2023-11-29 04:21:44', '0000-00-00 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `questionId` int(11) NOT NULL,
  `UserId` int(11) NOT NULL,
  `body` varchar(255) NOT NULL,
  `questioncreatedAt` datetime NOT NULL,
  `views` int(255) NOT NULL,
  `tags` varchar(255) NOT NULL,
  `image` text DEFAULT '../assets/images/userdata/'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`questionId`, `UserId`, `body`, `questioncreatedAt`, `views`, `tags`, `image`) VALUES
(5, 8, 'what is maths?', '2023-11-19 00:00:00', 0, 'General Knowlegde', '../assets/images/userdata/5.png'),
(28, 8, 'Is earth actually Round?', '2023-11-20 00:00:00', 0, 'science', ''),
(29, 8, 'what should a person Do if a snakes bites him?', '2023-11-20 00:00:00', 0, 'General Knowlegde', ''),
(30, 4, 'when did pakistan became independent?', '2023-11-21 00:00:00', 0, 'General Knowlegde', ''),
(31, 3, 'why do men have more bones then women?', '2023-11-21 00:00:00', 0, 'science,General Knowlegde', ''),
(32, 7, 'what is Unknown?', '2023-11-22 00:00:00', 0, 'General Knowlegde', ''),
(49, 4, 'what is volcano Eruption? and How does it occurs?', '2023-11-28 00:00:00', 0, 'science,General Knowlegde', '../assets/images/userdata/1012_nasa.jpg'),
(51, 10, 'How did Palestine become Israel?', '2023-11-29 00:00:00', 0, 'General Knowlegde', '../assets/images/userdata/map-palestine-israel.gif');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `tagId` int(11) NOT NULL,
  `Tagname` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`tagId`, `Tagname`) VALUES
(1, 'science'),
(2, 'maths'),
(3, 'English'),
(4, 'General Knowlegde'),
(5, 'Astronomy'),
(6, 'Agriculture'),
(7, 'Health'),
(8, 'Physics'),
(9, 'Computer Science'),
(10, 'Chemistry'),
(11, 'Biology'),
(12, 'Law');

-- --------------------------------------------------------

--
-- Table structure for table `userprofile`
--

CREATE TABLE `userprofile` (
  `UserId` int(11) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `Bio` text NOT NULL,
  `createdAt` datetime NOT NULL DEFAULT current_timestamp(),
  `updatedAt` datetime NOT NULL,
  `Active` tinyint(1) NOT NULL,
  `ProfilePic` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `userprofile`
--

INSERT INTO `userprofile` (`UserId`, `Username`, `email`, `password`, `Bio`, `createdAt`, `updatedAt`, `Active`, `ProfilePic`) VALUES
(3, 'laiba', 'laiba_100@gamil.com', '$2y$10$CYEaXzLAcRrRO/7LVBJ8P.pRgRtM7Z8SW46gHnChbElMIHBcpDDhq', 'i am not a very nice person', '2023-11-16 14:53:55', '2023-11-16 14:53:55', 1, ''),
(4, 'Kanzul', 'kanzulzoha2003@gmail.com', '$2y$10$0dYQ5thETOXYlOafnLBgZuElC491iM7YQTkC/lc.IQs.9iit8XYKi', 'i am wifey material', '2023-11-17 11:33:11', '0000-00-00 00:00:00', 1, '../assest/images/userdata/95fc524a10000902c803d6365abf5e8f.jpg'),
(5, 'laiba', 'zoha@gamil.com', '$2y$10$07p.XQhBFSAdHbBkWBt5r./ypO8/o17FVgBS1ueVmdsv9kMbO7Pym', 'i am not a very nice person', '2023-11-19 14:53:09', '0000-00-00 00:00:00', 1, 'C:xampphtdocsProject1.0pages/../assests/images/userdata/WhatsApp Image 2023-11-09 at 21.54.49_2e3ecf4b.jpg'),
(7, 'Taehyung', 'taehyung@gmail.com', '$2y$10$K9e6uWtgKIrK0izVXoA6keNqhnhU/x.8wLgGIuHlS6BRPh5sienQi', 'worlds handsome man', '2023-11-19 14:58:46', '0000-00-00 00:00:00', 1, 'C:xampphtdocsProject1.0pages/../assests/images/userdata/dp1.jpeg'),
(8, 'Esha Eman', 'eshaeman2003@gmail.com', '$2y$10$ZlcSWczjZYwuVLi1PMfLvO/jcr3JHrXVNxOpoK/wNtNXjjFiY4PNC', 'i am elite', '2023-11-19 15:01:18', '0000-00-00 00:00:00', 1, 'C:xampphtdocsProject1.0pages/../assests/images/userdata/Snapchat-1469353889.jpg'),
(9, 'muqaddas', 'muqaddasnazir@gmail.com', '$2y$10$YCjzazdschUxSHk32CIVaOqxWzGT72URHBjrhVe4yWaxtIYIaY9mG', 'incredibly innocent', '2023-11-19 15:03:48', '0000-00-00 00:00:00', 1, 'C:xampphtdocsProject1.0pages/../assests/images/userdata/Snapchat-15488420.jpg'),
(10, 'Mr.', 'scrycrystals2003@gmail.com', '$2y$10$Fcos9u2DrA.nEJI4jbjMEeSzhWq2RRMitmBdWOVz8/8/CJ03ocyOK', 'Not so Bad', '2023-11-23 00:05:13', '0000-00-00 00:00:00', 1, '/../assests/images/userdata/95fc524a10000902c803d6365abf5e8f.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `votes`
--

CREATE TABLE `votes` (
  `id` int(11) NOT NULL,
  `UserId` int(11) NOT NULL,
  `answerId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `votes`
--

INSERT INTO `votes` (`id`, `UserId`, `answerId`) VALUES
(6, 4, 3),
(7, 4, 8),
(8, 3, 6),
(9, 3, 8),
(10, 3, 3),
(11, 3, 4),
(12, 7, 8),
(13, 10, 8),
(14, 8, 8),
(15, 8, 6);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`answerId`),
  ADD KEY `FK_answers_UserId` (`UserId`),
  ADD KEY `FK_answers_questionId` (`questionId`);

--
-- Indexes for table `followers`
--
ALTER TABLE `followers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_Followers_Followedby` (`Followedby`),
  ADD KEY `FK_Followers_Followeding` (`Following`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`LoginID`),
  ADD KEY `UserId` (`UserId`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`questionId`),
  ADD KEY `FK_questions_UserID` (`UserId`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`tagId`);

--
-- Indexes for table `userprofile`
--
ALTER TABLE `userprofile`
  ADD PRIMARY KEY (`UserId`);

--
-- Indexes for table `votes`
--
ALTER TABLE `votes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_votes_UserId` (`UserId`),
  ADD KEY `FK_votes_anwserId` (`answerId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `answers`
--
ALTER TABLE `answers`
  MODIFY `answerId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `followers`
--
ALTER TABLE `followers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `LoginID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `questionId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `tagId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `userprofile`
--
ALTER TABLE `userprofile`
  MODIFY `UserId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `votes`
--
ALTER TABLE `votes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `answers`
--
ALTER TABLE `answers`
  ADD CONSTRAINT `FK_answers_UserId` FOREIGN KEY (`UserId`) REFERENCES `userprofile` (`UserId`),
  ADD CONSTRAINT `FK_answers_questionId` FOREIGN KEY (`questionId`) REFERENCES `questions` (`questionId`);

--
-- Constraints for table `followers`
--
ALTER TABLE `followers`
  ADD CONSTRAINT `FK_Followers_Followedby` FOREIGN KEY (`Followedby`) REFERENCES `userprofile` (`UserId`),
  ADD CONSTRAINT `FK_Followers_Followeding` FOREIGN KEY (`Following`) REFERENCES `userprofile` (`UserId`);

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `FK_questions_UserID` FOREIGN KEY (`UserId`) REFERENCES `userprofile` (`UserId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
