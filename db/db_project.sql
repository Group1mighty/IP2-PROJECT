-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 24, 2025 at 02:58 PM
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

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
