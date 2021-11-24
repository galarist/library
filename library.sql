-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 02, 2021 at 01:46 PM
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
  `copies` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`bookID`, `title`, `author`, `bookPlot`, `published`, `ranking`, `copies`) VALUES
(1, 'Big Shot: Diary of a Wimpy Kid (Book 16)', 'Jeff Kinney', 'In Big Shot, book 16 of the Diary of a Wimpy Kid series from #1 international bestsetlling author Jeff Kinney, Greg Heffley and sports just don&rsquo;t mix.\r\n\r\nAfter a disastrous field day competition at school, Greg decides that when it comes to his athletic career, he&rsquo;s officially retired. But after his mom urges him to give sports one more chance, he reluctantly agrees to sign up for basketball.\r\n\r\nTryouts are a mess, and Greg is sure he won&rsquo;t make the cut. But he unexpectedly lands a spot on the worst team.\r\n\r\nAs Greg and his new teammates start the season, their chances of winning even a single game look slim. But in sports, anything can happen. When everything is on the line and the ball is in Greg&rsquo;s hands, will he rise to the occasion? Or will he blow his big shot?\r\n\r\nSee the Wimpy Kid World in a whole new way with the help of Greg Heffley&rsquo;s best friend in the instant #1 bestsellers Diary of an Awesome Friendly Kid: Rowley Jefferson&rsquo;s Journal, Rowley Jefferson&rsquo;s Awesome Friendly Adventure and Rowley Jefferson&rsquo;s Awesome Friendly Spooky Stories!', 1995, 4.5, 123),
(2, 'Shrek!', 'William Steig', 'Before Shrek made it big on the solver screen, there was William Steig&#039;s &quot;SHREK ,&quot; a book about an ordinary ogre who leaves his swampy childhood home to go out and see the world. Ordinary, that is, if a foul and hideous being who ends up marrying the most stunningly ugly princess on the planet is what you consider ordinary.', 2008, 4.2, 2323);

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
(1, 'b69b32195ba5ad0d2f2093fdd8cfc6a6.jpg'),
(2, '2bc1e5442f2da787f204f3c1a136f313.jpg');

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
(2, 1, 'Jane', 'Doe', 'Jane', 'Jane@example.com', '$2y$12$RSy9zywha1Qlg0ml2fYD4OfnZrESDu2v5h8jOXwNr4dO/HURLF6nO');

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
  MODIFY `bookID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
