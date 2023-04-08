-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 08, 2023 at 02:33 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `prompthub`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `topic_id` int(11) NOT NULL,
  `u_id` int(11) NOT NULL,
  `body` text NOT NULL,
  `creation_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `post_id`, `topic_id`, `u_id`, `body`, `creation_time`) VALUES
(1, 0, 0, 0, 'test', '2023-03-26 20:57:32'),
(2, 0, 0, 0, '123', '2023-03-26 21:10:27'),
(3, 0, 0, 3, 'test', '2023-03-26 21:29:31'),
(4, 3, 0, 4, '', '2023-03-27 02:58:49'),
(5, 3, 0, 4, 'dfdf', '2023-03-27 02:58:51'),
(6, 5, 0, 4, 'tesst', '2023-03-27 03:45:39'),
(7, 6, 0, 4, 'adsfasd', '2023-03-27 03:51:51'),
(8, 6, 0, 4, 'rererer', '2023-03-27 03:51:54'),
(9, 8, 0, 4, 'hello', '2023-04-04 22:40:54');

-- --------------------------------------------------------

--
-- Table structure for table `my_topics`
--

CREATE TABLE `my_topics` (
  `topic_id` int(11) NOT NULL,
  `u_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `my_topics`
--

INSERT INTO `my_topics` (`topic_id`, `u_id`) VALUES
(1, 4),
(1, 4),
(1, 4),
(2, 4),
(3, 4),
(4, 4);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(11) NOT NULL,
  `u_id` int(11) NOT NULL,
  `topic_id` int(11) NOT NULL,
  `title` varchar(40) NOT NULL,
  `body` text NOT NULL,
  `images` varchar(200) NOT NULL,
  `creation_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `u_id`, `topic_id`, `title`, `body`, `images`, `creation_time`) VALUES
(7, 0, 1, 'test', 'test', '', '2023-03-27 04:33:46'),
(8, 0, 4, 'test1', 'test', '', '2023-04-04 22:40:31'),
(9, 0, 1, 'etst', 'etst', '', '2023-04-04 22:58:01'),
(10, 4, 4, 'test1', 'test1', '', '2023-04-04 23:49:37'),
(11, 4, 1, 'test', 'test', '', '2023-04-04 23:59:21'),
(12, 4, 10, 'test', 'test', '', '2023-04-07 22:56:16'),
(13, 4, 3, 'poset', 't', '', '2023-04-07 23:00:56'),
(14, 4, 4, 'test', 'testst', '', '2023-04-07 23:03:25');

-- --------------------------------------------------------

--
-- Table structure for table `topics`
--

CREATE TABLE `topics` (
  `topic_id` int(11) NOT NULL,
  `topic_title` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `topics`
--

INSERT INTO `topics` (`topic_id`, `topic_title`) VALUES
(1, 'Test Topic'),
(2, 'test2'),
(3, 'test3'),
(4, 'topic4'),
(5, ''),
(6, ''),
(7, 'testing'),
(8, 'testing1'),
(9, 'testttttt'),
(10, 'tetet');

-- --------------------------------------------------------

--
-- Table structure for table `userimages`
--

CREATE TABLE `userimages` (
  `userID` int(11) NOT NULL,
  `contentType` varchar(255) NOT NULL,
  `image` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `u_id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `email` varchar(200) NOT NULL,
  `email_confirmed` int(1) NOT NULL DEFAULT 0,
  `passw` varchar(60) NOT NULL,
  `profile_pic` varchar(100) NOT NULL,
  `profile_bio` varchar(1000) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `admin_status` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`u_id`, `username`, `email`, `email_confirmed`, `passw`, `profile_pic`, `profile_bio`, `created_at`, `admin_status`) VALUES
(2, 'static1', 'isaacjoseph2001@gmail.com', 0, '$2y$10$CVLWwIPdgGlnEOMtVTqu/OoXyXw65tqoQdYvq7pXnvvF8VpygjGNa', '', '', '2023-03-26 21:11:44', 0),
(4, 'bobby', 'dfd@dfdf', 0, '$2y$10$E3Yc9hPE0b6fpWHMoH3FZ.RUjzjEallPRhl8AswjmIoHBAt8OfvS2', '', 'dfd', '2023-03-26 22:02:38', 1),
(5, 'bobby', 'wilfred.meyer@ubc.ca', 0, '$2y$10$kdChWQskDstxzFiTE9xQnui8KKDEkS5CWJA7U6ccSBpSlVc5V4Rqi', '', '', '2023-03-26 22:02:55', 1),
(6, 'bobby', 'asdf4e@dafs', 0, '$2y$10$NYtAjeUfzvsG6.tyooPVQe95blVhTFClov9F6BIDLQIWhoA.JjzuC', '', '', '2023-03-26 22:04:52', 0),
(7, 'bobbyd', 'wilfredd.meyer@ubc.ca', 0, '$2y$10$9BtmAs5qhvWcaxI8ZslvUOn2d9MOm6BE9MsyfFdYECk5eGL6CyaSG', '', '', '2023-03-26 22:25:52', 0),
(8, 'bobb yd', 'dsdf@dfdf', 0, '$2y$10$J6C.P15aIWiTBUS0FO5ET.PSMLNkWwjFKV3rRfY3Tk8Ugd8Zkmy/e', '', '', '2023-03-27 00:41:14', 0),
(9, 'bobbydasf', 'wilfredmeyer1@gddmail.com', 0, '$2y$10$GbzRysYPkZDwghlvj37zM.irTzD2yxlcMLfiRduTw9cdybiay9S8i', './uploads/profile_pics/profile-picture-placeholder.png', '', '2023-03-27 03:41:33', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `topics`
--
ALTER TABLE `topics`
  ADD PRIMARY KEY (`topic_id`);

--
-- Indexes for table `userimages`
--
ALTER TABLE `userimages`
  ADD PRIMARY KEY (`userID`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`u_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `topics`
--
ALTER TABLE `topics`
  MODIFY `topic_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
