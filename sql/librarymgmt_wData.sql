-- phpMyAdmin SQL Dump
-- version 4.5.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 12, 2017 at 12:18 AM
-- Server version: 5.7.11
-- PHP Version: 7.0.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `librarymgmt`
--

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `book_id` int(11) NOT NULL,
  `book_name` varchar(100) NOT NULL,
  `book_description` varchar(100) NOT NULL,
  `book_author` varchar(50) NOT NULL,
  `tags` varchar(100) NOT NULL,
  `shelf_id` int(11) NOT NULL,
  `borrowed` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`book_id`, `book_name`, `book_description`, `book_author`, `tags`, `shelf_id`, `borrowed`) VALUES
(1, 'Java for Dummy', 'How to code Java like a dummy', 'YL', 'programming,java,dummy', 1, 0),
(2, 'How to Draw Workflow Diagram like a Mama', 'Drawing Workflow 101', 'Hong Ngoh', 'drawing,workflow,wfd,pmsb,', 1, 0),
(3, 'Cooking with Auntie Lucy', 'cook', 'Lucy', 'cooking,auntie,lucy,cookbook,recipe', 2, 0),
(4, 'Algorithms with Ruby', 'Computation thinking and algorithms', 'Mok, Hady', 'programming,ruby,algorithm,computational thinking', 1, 0),
(5, 'Introduction to PHP', 'Fundamentals of PHP', 'David Lo', 'PHP,programming,web development', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `borrowed_book`
--

CREATE TABLE `borrowed_book` (
  `borrowed_date` timestamp NOT NULL,
  `book_id` int(11) NOT NULL,
  `user_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `shelf`
--

CREATE TABLE `shelf` (
  `shelf_id` int(11) NOT NULL,
  `shelf_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shelf`
--

INSERT INTO `shelf` (`shelf_id`, `shelf_name`) VALUES
(1, 'LV1SHELF1'),
(2, 'LV1SHELF2'),
(3, 'LV1SHELF3'),
(4, 'LV1SHELF4'),
(5, 'LV1SHELF5'),
(6, 'LV2SHELF1'),
(7, 'LV2SHELF2');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_name` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `staff` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_name`, `password`, `staff`) VALUES
('lib1', 'liblibpassword1', 1),
('lib2', 'libpassword2', 1),
('user1', 'flyfly11', 0),
('user2', 'password2', 0),
('user5', 'password5', 0),
('user7', 'password7', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`book_id`),
  ADD KEY `shelf_id` (`shelf_id`);

--
-- Indexes for table `borrowed_book`
--
ALTER TABLE `borrowed_book`
  ADD PRIMARY KEY (`borrowed_date`,`book_id`),
  ADD KEY `book_id` (`book_id`),
  ADD KEY `user_id` (`user_name`);

--
-- Indexes for table `shelf`
--
ALTER TABLE `shelf`
  ADD PRIMARY KEY (`shelf_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `shelf`
--
ALTER TABLE `shelf`
  MODIFY `shelf_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `book`
--
ALTER TABLE `book`
  ADD CONSTRAINT `book_ibfk_1` FOREIGN KEY (`shelf_id`) REFERENCES `shelf` (`shelf_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `borrowed_book`
--
ALTER TABLE `borrowed_book`
  ADD CONSTRAINT `book_id` FOREIGN KEY (`book_id`) REFERENCES `book` (`book_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `user_name` FOREIGN KEY (`user_name`) REFERENCES `user` (`user_name`) ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
