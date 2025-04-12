-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 29, 2025 at 01:48 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `comment_text` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `photo_url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `username`, `comment_text`, `created_at`, `photo_url`) VALUES
(1, 'Sofia Martinez', 'I did Java Fundamental course with Rishab Sir. It was a great experience. The brain teasers and assignments, actually the whole lot of content was really good. Some problems were challenging yet interesting. Was explained very well wherever I stuck.', '2025-03-24 12:36:11', '../pictures/Personal Branding Photography _ Dallas, Fort Worth, Austin, Denver.jpg'),
(2, 'Liam Bennett', 'When I was watching Dear Zindagi, I could relate Sharukh Khan to Arnav Bhaiya. The way Sharukh Khan was giving life lessons to Alia Bhatt, in the same way Arnav Bhaiya will give coding life lessons which will guide you throughout your code life...', '2025-03-24 12:36:11', '../pictures/bewerbung und social-media - Portraits - kleineBILDKUNST.jpg'),
(3, 'Grace Thompson', 'LearnEd was an amazing experience for me. I belong to the electronics department and had little experience in coding, but I think it has helped me think things through in a much more analytical manner. Coding is important no matter which branch you are in.', '2025-03-24 12:36:11', '../pictures/download.jpg'),
(4, 'Ethan Collins', 'This was my first complete course at coding blocks. I attended the Python course in Winter 2020 and loved it which made me join the full course. Shubham bhaiya and Ayush Bhaiya(TA) have good knowledge about the field and were very helpful in making us understand the concepts.', '2025-03-24 12:36:11', '../pictures/GPCC UNISEX FULL ZIP - 2XL _ LILAC.jpg'),
(5, 'Ava Patel', 'The course was very well structured and easy to follow. I gained a strong foundation in JavaScript.', '2025-03-24 12:36:11', '../pictures/person.jpeg'),
(6, 'Daniel Kim', 'I had no prior programming experience, but this course made me feel confident in my skills.', '2025-03-24 12:36:11', '../pictures/person.jpeg'),
(7, 'Emma Williams', 'A great platform for learning new coding concepts. The real-world examples were very helpful!', '2025-03-24 12:36:11', '../pictures/person.jpeg'),
(8, 'Noah Johnson', 'The instructors were great, and the assignments were challenging yet fun.', '2025-03-24 12:36:11', '../pictures/person.jpeg'),
(9, 'Isabella Rodriguez', 'I loved the interactive exercises. They helped me apply what I learned immediately.', '2025-03-24 12:36:11', '../pictures/person.jpeg'),
(10, 'Mason Wright', 'I recommend this platform to anyone looking to improve their coding skills.', '2025-03-24 12:36:11', '../pictures/person.jpeg'),
(11, 'Sophia Lee', 'The course taught me how to think like a programmer. Debugging became easier after taking this course.', '2025-03-24 12:36:11', '../pictures/person.jpeg'),
(12, 'Elijah Scott', 'Amazing learning experience! I feel ready to start my first coding job now.', '2025-03-24 12:36:11', '../pictures/person.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `email`, `password`, `created_at`) VALUES
(1, 'abel teferi', 'abelteferi4007@gmail.com', '$2y$10$L4QyvIZfoGY6MOYC11KlZOQcMlDjhN5/ym75yPhnSuvt1ckJ2rvR2', '2025-03-29 12:21:51'),
(2, 'basliel ', 'basliel@gmail.com', '$2y$10$u2/jP8dgygKlSJGD5oExwuWT1Uw2r1MlROLFhF2PUtucbFi1BjFh6', '2025-03-29 13:55:02'),
(4, 'samuel', 'samuel@gmail.com', '$2y$10$Q2A6CgiVR0bFDYYkCg3.belBBgUXez8ZC/HHJDR6KO1W0ZnRtkc5S', '2025-03-29 15:44:50');
(5, 'Abdrehim0013', 'abdrehimmisbah@gmail.com', '$2y$10$cClhZJBBhxYy4IzeP3cNP.09nFSVbZsFANLm3T0LbQJ...', '2025-04-09 14:14:36');
(6, 'abdulhakimkedir', 'abdulhakimkedir@gmail.com', '$2y$10$1234567890abcdefg', NOW()),
(7, 'abdulkerim adem', 'abdulkerimadem@gmail.com', '$2y$10$1234567890abcdefg', NOW()),
(8, 'abeltsegaye', 'abeltsegaye@gmail.com', '$2y$10$1234567890abcdefg', NOW());


--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_name` (`user_name`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `Users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
