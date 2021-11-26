-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 26, 2021 at 09:10 AM
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
-- Database: `library`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `bookID` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `author` varchar(255) DEFAULT NULL,
  `bookPlot` longtext DEFAULT NULL,
  `published` int(11) DEFAULT NULL,
  `ranking` float DEFAULT NULL,
  `copies` int(11) DEFAULT NULL,
  `added` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp(),
  `editedBy` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`bookID`, `title`, `author`, `bookPlot`, `published`, `ranking`, `copies`, `added`, `updated`, `editedBy`) VALUES
(6, 'Mr!O', 'Chris', '1feagewhw', 1995, 1.5, 111, '2021-11-25 08:42:12', '0000-00-00 00:00:00', NULL),
(9, 'esgesg', 'Thomas Keneally', 'gsrhdrj', 1995, 1.5, 222, '2021-11-25 08:45:05', '0000-00-00 00:00:00', NULL),
(10, 'eawfwf', 'Jeff Kinney', 'fawgagw', 1995, 4.5, 111, '2021-11-25 08:46:14', '2021-11-25 09:01:32', 'Jane'),
(12, 'Chr', 'Jeff Kinney', 'segesg', 2021, 1.5, 111, '2021-11-25 08:48:04', '0000-00-00 00:00:00', NULL),
(14, 'wfaawawfawgwa', 'Jeff Kinney', 'awfaw', 1995, 4.2, 111, '2021-11-25 08:50:12', '2021-11-25 09:29:48', 'Jane'),
(18, 'bbnf', 'Jeff Kinney', 'sGEH', 2021, 2.3, 111, '2021-11-25 08:59:18', '0000-00-00 00:00:00', NULL),
(19, 'Mr.Me', 'Hannah Kent', 'eges', 1111, 4.5, 3333, '2021-11-25 09:03:37', '0000-00-00 00:00:00', NULL),
(21, 'Minime', 'Hello', 'wafawg', 2021, 1.5, 3333, '2021-11-25 09:05:17', '0000-00-00 00:00:00', NULL),
(24, 'Mrt', 'Thomas Keneally', 'esges', 1995, 4.5, 3333, '2021-11-25 09:07:06', '0000-00-00 00:00:00', NULL),
(25, 'Mrt', 'Jeff Kinney', 'esgesg', 1995, 3.5, 3333, '2021-11-25 09:07:22', '0000-00-00 00:00:00', NULL),
(26, 'RHdd', 'Jeff Kinney', 'esgseg', 1995, 4.5, 111, '2021-11-25 09:13:21', '0000-00-00 00:00:00', NULL),
(27, 'RHdd', 'Jeff Kinney', 'esgseg', 1995, 4.5, 111, '2021-11-25 09:14:47', '0000-00-00 00:00:00', NULL),
(28, 'RHdd', 'Jeff Kinney', 'esgseg', 1995, 4.5, 111, '2021-11-25 09:15:03', '0000-00-00 00:00:00', NULL),
(29, 'RHdd', 'Jeff Kinney', 'esgseg', 1995, 4.5, 111, '2021-11-25 09:15:04', '0000-00-00 00:00:00', NULL),
(30, 'RHdd', 'Jeff Kinney', 'esgseg', 1995, 4.5, 111, '2021-11-25 09:15:59', '0000-00-00 00:00:00', NULL),
(32, 'RHdd', 'Jeff Kinney', 'esgseg', 1995, 4.5, 111, '2021-11-25 09:16:11', '0000-00-00 00:00:00', NULL),
(33, 'RHdd', 'Jeff Kinney', 'esgseg', 1995, 4.5, 111, '2021-11-25 09:16:13', '0000-00-00 00:00:00', NULL),
(34, 'RHdd', 'Jeff Kinney', 'esgseg', 1995, 4.5, 111, '2021-11-25 09:16:15', '0000-00-00 00:00:00', NULL),
(35, 'RHdd', 'Jeff Kinney', 'esgseg', 1995, 4.5, 111, '2021-11-25 09:16:17', '0000-00-00 00:00:00', NULL),
(36, 'RHdd', 'Jeff Kinney', 'esgseg', 1995, 4.5, 111, '2021-11-25 09:16:29', '0000-00-00 00:00:00', NULL),
(38, 'RHdd', 'Jeff Kinney', 'esgseg', 1995, 4.5, 111, '2021-11-25 09:17:11', '0000-00-00 00:00:00', NULL),
(39, 'RHdd', 'Jeff Kinney', 'esgseg', 1995, 4.5, 111, '2021-11-25 09:17:30', '0000-00-00 00:00:00', NULL),
(42, 'RHdd', 'Jeff Kinney', 'esgseg', 1995, 4.5, 111, '2021-11-25 09:18:36', '0000-00-00 00:00:00', NULL),
(43, 'RHdd', 'Jeff Kinney', 'esgseg', 1995, 4.5, 111, '2021-11-25 09:18:36', '0000-00-00 00:00:00', NULL),
(44, 'RHdd', 'Jeff Kinney', 'esgseg', 1995, 4.5, 111, '2021-11-25 09:18:37', '0000-00-00 00:00:00', NULL),
(45, 'RHdd', 'Jeff Kinney', 'esgseg', 1995, 4.5, 111, '2021-11-25 09:18:42', '0000-00-00 00:00:00', NULL),
(46, 'RHdd', 'Jeff Kinney', 'esgseg', 1995, 4.5, 111, '2021-11-25 09:18:49', '0000-00-00 00:00:00', NULL),
(47, 'RHdd', 'Jeff Kinney', 'esgseg', 1995, 4.5, 111, '2021-11-25 09:19:17', '0000-00-00 00:00:00', NULL),
(48, 'RHdd', 'Jeff Kinney', 'esgseg', 1995, 4.5, 111, '2021-11-25 09:19:34', '0000-00-00 00:00:00', NULL),
(49, 'RHdd', 'Jeff Kinney', 'esgseg', 1995, 4.5, 111, '2021-11-25 09:22:30', '0000-00-00 00:00:00', NULL),
(50, 'RHdd', 'Jeff Kinney', 'esgseg', 1995, 4.5, 111, '2021-11-25 09:22:51', '0000-00-00 00:00:00', NULL),
(51, 'RHdd', 'Jeff Kinney', 'esgseg', 1995, 4.5, 111, '2021-11-25 09:23:27', '0000-00-00 00:00:00', NULL),
(52, 'RHdd', 'Jeff Kinney', 'esgseg', 1995, 4.5, 111, '2021-11-25 09:24:14', '0000-00-00 00:00:00', NULL),
(53, 'RHdd', 'Jeff Kinney', 'esgseg', 1995, 4.5, 111, '2021-11-25 09:24:19', '0000-00-00 00:00:00', NULL),
(54, 'RHdd', 'Jeff Kinney', 'esgseg', 1995, 4.5, 111, '2021-11-25 09:24:39', '0000-00-00 00:00:00', NULL),
(55, 'Mr me', 'Hannah Kent', 'egsgh', 1995, 4.5, 111, '2021-11-25 09:25:20', '0000-00-00 00:00:00', NULL),
(56, 'REGegse', 'Thomas Keneally', 'segesg', 1995, 1.5, 3333, '2021-11-25 09:26:14', '0000-00-00 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `covers`
--

CREATE TABLE `covers` (
  `bookID` int(11) NOT NULL,
  `cover` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `covers`
--

INSERT INTO `covers` (`bookID`, `cover`) VALUES
(9, '65203b2b8207829f3e36f3d78c41c5e8.png'),
(10, 'e810020f9da630997187cb8fe935ae80.jpg'),
(12, 'fcdd008ef0273822d25e9484c5b5f86e.jpg'),
(14, '6188601279964cb64f0786802a7557e1.jpg'),
(18, 'ad3f164f2b030d5de04c0e8bb976ef54.jpg'),
(19, '43ec648c57953693b23cacddb5bb5385.jpg'),
(21, '66025dc32675851ed8d15b69ead68722.jpg'),
(24, 'b5485d425d35de207fab02b0a778dec3.jpg'),
(25, 'af154c21908889971b893f69fa992437.jpg'),
(26, 'a3d63b9f6f631dac787978140be60326.png'),
(27, '9b5d8ca5508aabdeffb8769eef8a035e.png'),
(28, '6def196049bee236e9ea89c9b748ee90.png'),
(29, '6ab14fff4861954144bec67ab37a981a.png'),
(30, '71418bb0103c22354fc3d448654cd133.png'),
(32, '826714012076ff670be2e0ef22dc5ba5.png'),
(33, '1b5d6db54e4dbadb7d8c5ef9d4b8f59a.png'),
(34, '15476a35be8319bbc6af6095efb5ad13.png'),
(35, 'f17416c14bab6692b7c3a7211a34894b.png'),
(36, '0d714221d15b42ae153d2f6067d1dbe5.png'),
(38, 'd0d9743da5aa3f10e858460f9b8fda75.png'),
(39, '3f8cf9fe571b25d9562a3e41d8f6337a.png'),
(42, '0cfb6039bdcd54aa1de846b97d42ac86.png'),
(43, '0cfb6039bdcd54aa1de846b97d42ac86.png'),
(44, 'c4224fed7c944d729e004b782461fb7c.png'),
(45, '621d69f8f42fa24cb83a27ca05377594.png'),
(46, '384600be7a275dae405b9eb00b992db9.png'),
(47, 'ff2841ed776a774d6d26f7d5ae602d2d.png'),
(48, '7263ac4e02b1f3261e9ec319640f779b.png'),
(49, 'a8c6b9cb4d40758bab3ed89cf5809155.png'),
(50, '5bf7f41e349e22ab891660af0396393b.png'),
(51, 'fb2283e3c0a1c4a803109bd57a059f69.png'),
(52, 'f2a4b38739bdcdfd486494c07ae257e5.png'),
(53, '09350ae31821bf2da3cbb5b7c2241e8b.png'),
(54, 'bb61c58fb6cace2c490070ebe4601b32.png'),
(55, '45666c269af3b59e43c0c2b04aa72e4f.jpg'),
(56, '52eaae7bdf0be20cb4126b15df37bd03.png');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userID` int(11) NOT NULL,
  `permission` int(11) DEFAULT NULL,
  `firstName` varchar(255) DEFAULT NULL,
  `lastName` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `permission`, `firstName`, `lastName`, `username`, `email`, `password`) VALUES
(1, 1, 'John', 'Doe', 'John', 'John@example.com', '$2y$12$RSy9zywha1Qlg0ml2fYD4OfnZrESDu2v5h8jOXwNr4dO/HURLF6nO'),
(2, 1, 'Jane', 'Doe', 'Jane', 'Jane@example.com', '$2y$12$RSy9zywha1Qlg0ml2fYD4OfnZrESDu2v5h8jOXwNr4dO/HURLF6nO'),
(3, 11, 'Cristovao', 'Cristovao', 'admin', 'galamboscristovao@gmail.com', '$2y$12$VvhAx7JrhwGMLgShJzCXLeY5MozWQNzs6c4qcuS3FmoUM5RMcw3LO'),
(4, 0, 'Cristovao', 'Cristovao', 'breeder', 'galamboscristovao@gmail.com', '$2y$12$.GSccJ690BQzUpLhqs2G.OWOSQ6aHB8uyET2UNkETUQ7ppgu33IdK'),
(5, 0, 'Cristovao', 'Cristovao', 'chrilo', 'galamboscristovao@gmail.com', '$2y$12$RD7MsD8GbDjGkC/4MDuyzeOyzupiO8S6My3/zT6v0hxVecmOnuizq'),
(6, 1, 'Cristovao', 'Cristovao', 'Janeefsg', 'galamboscristovao@gmail.com', '$2y$12$Vh59ENv.uZ7P.LEyIw5nu.E.jbzK18Dt2N1J.xspxqgR6ldoYQmZO');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`bookID`);

--
-- Indexes for table `covers`
--
ALTER TABLE `covers`
  ADD PRIMARY KEY (`bookID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `bookID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `covers`
--
ALTER TABLE `covers`
  ADD CONSTRAINT `FK_BooCov_Cascade_Delete` FOREIGN KEY (`bookID`) REFERENCES `books` (`bookID`) ON DELETE CASCADE,
  ADD CONSTRAINT `covers_ibfk_1` FOREIGN KEY (`bookID`) REFERENCES `books` (`bookID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
