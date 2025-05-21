-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: May 21, 2025 at 04:50 PM
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
(5, 'Ava Patel', 'The course was very well structured and easy to follow. I gained a strong foundation in JavaScript.', '2025-03-24 12:36:11', '../pictures/person.png'),
(6, 'Daniel Kim', 'I had no prior programming experience, but this course made me feel confident in my skills.', '2025-03-24 12:36:11', '../pictures/person.png'),
(7, 'Emma Williams', 'A great platform for learning new coding concepts. The real-world examples were very helpful!', '2025-03-24 12:36:11', '../pictures/person.png'),
(8, 'Noah Johnson', 'The instructors were great, and the assignments were challenging yet fun.', '2025-03-24 12:36:11', '../pictures/person.png'),
(9, 'Isabella Rodriguez', 'I loved the interactive exercises. They helped me apply what I learned immediately.', '2025-03-24 12:36:11', '../pictures/person.png'),
(10, 'Mason Wright', 'I recommend this platform to anyone looking to improve their coding skills.', '2025-03-24 12:36:11', '../pictures/person.png'),
(11, 'Sophia Lee', 'The course taught me how to think like a programmer. Debugging became easier after taking this course.', '2025-03-24 12:36:11', '../pictures/person.png'),
(12, 'Elijah Scott', 'Amazing learning experience! I feel ready to start my first coding job now.', '2025-03-24 12:36:11', '../pictures/person.png'),
(13, 'abdu', 'it has great UI design that makes it simpler to the learning environment, i recommend eduSphere for every one that\'s wants to learn and acquire real knowledge.', '2025-05-17 14:55:18', '../pictures/person.png'),
(14, 'abel teferi', 'i love eduSphere', '2025-05-21 12:54:12', '../pictures/person.png');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(6) UNSIGNED NOT NULL,
  `title` text NOT NULL,
  `discription` text NOT NULL,
  `picture` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `title`, `discription`, `picture`) VALUES
(1, 'GIT AND GIT HUB', 'Master the essentials of version control using Git and GitHub. Learn how to track changes in your code, collaborate effectively with teams, and manage repositories like a pro. This course is ideal for developers looking to improve workflow efficiency and streamline project collaboration.', '../pictures/github.jpg'),
(2, 'HTML', 'Learn the building blocks of web development with HTML (HyperText Markup Language). This course will teach you how to create structured web pages, add text, images, and links, and build a strong foundation for creating engaging and accessible websites. Perfect for beginners to start their journey.', '../pictures/HTML.jpg'),
(3, 'CSS', 'Dive into the world of design with CSS (Cascading Style Sheets). This course will guide you through styling web pages, including layout techniques, typography, colors, and responsive design principles. By the end, you\'ll be able to create visually stunning and mobile-friendly websites.', '../pictures/css.png');

-- --------------------------------------------------------

--
-- Table structure for table `enrollment`
--

CREATE TABLE `enrollment` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `course_id` int(10) UNSIGNED NOT NULL,
  `enrolled_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `enrollment`
--

INSERT INTO `enrollment` (`id`, `user_id`, `course_id`, `enrolled_at`) VALUES
(1, 1, 1, '2025-05-15 15:19:25'),
(2, 1, 2, '2025-05-15 15:37:06'),
(3, 2, 1, '2025-05-15 15:46:16'),
(4, 2, 2, '2025-05-15 15:47:05'),
(5, 3, 1, '2025-05-15 15:49:56'),
(6, 4, 3, '2025-05-16 10:13:59'),
(7, 4, 1, '2025-05-16 10:39:19'),
(8, 7, 1, '2025-05-17 15:49:37'),
(9, 8, 3, '2025-05-17 15:55:48'),
(10, 9, 2, '2025-05-17 17:04:08'),
(11, 9, 1, '2025-05-17 17:12:15'),
(12, 10, 1, '2025-05-17 17:18:37'),
(13, 9, 3, '2025-05-17 18:05:29'),
(14, 11, 1, '2025-05-21 15:34:15'),
(15, 11, 3, '2025-05-21 15:53:16');

-- --------------------------------------------------------

--
-- Table structure for table `lessons`
--

CREATE TABLE `lessons` (
  `id` int(11) NOT NULL,
  `course_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text DEFAULT NULL,
  `link` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lessons`
--

INSERT INTO `lessons` (`id`, `course_id`, `title`, `content`, `link`) VALUES
(1, 1, 'Lesson 1: Introduction to Version Control', 'This lesson introduces the concept of version control, explaining its importance in tracking changes and collaborating on projects.', './Lesson One/LessonOne.html'),
(2, 1, 'Lesson 2: Core Git Commands and Workflow', 'Master the essential Git commands and understand the Git workflow.', './Lesson Two/lessonTwo.html'),
(3, 1, 'Lesson 3: Branching and Merging', 'Explore how to work with different versions of code and combine changes.', './Lesson Three/lessonThree.html'),
(4, 1, 'Lesson 4: Introduction to GitHub', 'Understand how to store and share your code using GitHub.', './Lesson Four/lessonFour.html'),
(5, 1, 'Lesson 5: Collaboration with GitHub', 'Learn to collaborate with others on GitHub using pull requests and forks.', './Lesson Five/lessonfive.html'),
(6, 1, 'Final Test', 'Take the test to evaluate your understanding of the course material.', './Test/GitTest.html'),
(8, 2, 'Lesson 1: Introduction to HTML', 'In this lesson, you will learn the basics of HTML, including the structure of a web page, elements, and attributes.', './Lesson One/LessonOne.html'),
(9, 2, 'Lesson 2: Structuring a Web Page', 'This lesson covers how to create a well-organized HTML document using semantic elements such as headers, footers, sections, and more.', './Lesson Two/lessonTwo.html'),
(10, 2, 'Lesson 3: Adding Text and Formatting', 'Learn how to add and format text in HTML, including paragraphs, headings, bold and italic text, and lists for better presentation.', './Lesson Three/lessonThree.html'),
(11, 2, 'Lesson 4: Working with Images', 'Discover how to embed images into your web page, adjust their size, and add alternative text for accessibility.', './Lesson Four/lessonfour.html'),
(12, 2, 'Lesson 5: Creating Links', 'Understand how to create hyperlinks, link to external websites, internal pages, or specific sections within a page.', './Lesson Five/lessonfive.html'),
(13, 2, 'Final Test', 'Take the test to evaluate your understanding of the course material.', './Test/htmlTest.html'),
(15, 3, 'Lesson 1: Introduction to CSS', 'Learn the basics of CSS, including its purpose, how it works with HTML, and the different ways to apply styles to a webpage.', './Lesson One/LessonOne.html'),
(16, 3, 'Lesson 2: Selectors and Properties', 'Understand how to use CSS selectors to target HTML elements and apply various properties to style them effectively.', './Lesson Two/lessonTwo.html'),
(17, 3, 'Lesson 3: Working with Colors', 'Explore how to add colors to your designs using color names, HEX codes, RGB values, and HSL for vibrant web pages.', './Lesson Three/lessonThree.html'),
(18, 3, 'Lesson 4: Typography and Fonts', 'Learn how to style text with fonts, adjust sizes, and control spacing for visually appealing and readable content.', './Lesson Four/lessonfour.html'),
(19, 3, 'Lesson 5: Responsive Design Basics', 'Discover the foundations of responsive web design, including flexible layouts, media queries, and mobile-first approaches.', './Lesson Five/lessonfive.html'),
(20, 3, 'Final Test', 'Take the test to evaluate your understanding of the course material.', './Test/cssTest.html');

-- --------------------------------------------------------

--
-- Table structure for table `lesson_video`
--

CREATE TABLE `lesson_video` (
  `id` int(11) NOT NULL,
  `course_id` int(10) UNSIGNED DEFAULT NULL,
  `lesson_id` int(11) DEFAULT NULL,
  `video_URL` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lesson_video`
--

INSERT INTO `lesson_video` (`id`, `course_id`, `lesson_id`, `video_URL`) VALUES
(1, 1, 1, 'https://www.youtube.com/embed/2ReR1YJrNOM'),
(2, 1, 2, 'https://www.youtube.com/embed/PSJ63LULKHA'),
(3, 1, 3, 'https://www.youtube.com/embed/XX-Kct0PfFc'),
(4, 1, 4, 'https://www.youtube.com/embed/w3jLJU7DT5E'),
(5, 1, 5, 'https://www.youtube.com/embed/8lGpZkjnkt4'),
(6, 3, 15, 'https://www.youtube.com/embed/qKoajPPWpmo'),
(7, 3, 16, 'https://www.youtube.com/embed/QgxkYbGr2II?si=QxsmSYTOrVh6i6eO'),
(8, 3, 17, 'https://www.youtube.com/embed/Ddc-IIrIot0'),
(9, 3, 18, 'https://www.youtube.com/embed/klXyJWlIzuY'),
(10, 3, 19, 'https://www.youtube.com/embed/K24lUqcT0Ms'),
(16, 2, 8, 'https://www.youtube.com/embed/5w10hFm33_E'),
(17, 2, 9, 'https://www.youtube.com/embed/KHjGMpADnx0'),
(18, 2, 10, 'https://www.youtube.com/embed/PBYO5JbJsYc'),
(19, 2, 11, 'https://www.youtube.com/embed/oxQsK3dxkvM'),
(20, 2, 12, 'https://www.youtube.com/embed/wnWxroZkRvg');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `lesson_id` int(11) DEFAULT NULL,
  `question` text DEFAULT NULL,
  `option_a` text DEFAULT NULL,
  `option_b` text DEFAULT NULL,
  `option_c` text DEFAULT NULL,
  `option_d` text DEFAULT NULL,
  `correct_option` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `lesson_id`, `question`, `option_a`, `option_b`, `option_c`, `option_d`, `correct_option`) VALUES
(1, 1, 'What is Git?', 'A programming language', 'A version control system', 'A web development tool', 'An operating system', 'A version control system'),
(2, 1, 'What is a key feature of Git?', 'It automatically writes code for you', 'It tracks changes and manages code versions', 'It provides free hosting for websites', 'It compiles programming code', 'It tracks changes and manages code versions'),
(3, 2, 'What command initializes a Git repository?', 'git start', 'git init', 'git new', 'git create', 'git init'),
(4, 2, 'What does the \'git add .\' command do?', 'Adds all files to staging', 'Commits files directly', 'Pushes files to remote', 'Deletes files', 'Adds all files to staging'),
(5, 3, 'Which command creates a new branch?', 'git branch new-branch', 'git merge new-branch', 'git checkout new-branch', 'git commit -b new-branch', 'git branch new-branch'),
(6, 3, 'What does the git merge command do?', 'Switches branches', 'Deletes a branch', 'Combines branches', 'Creates a pull request', 'Combines branches'),
(7, 4, 'What is the main purpose of GitHub?', 'To compile programming code', 'To store and collaborate on Git repositories', 'To create new programming languages', 'To delete old code projects', 'To store and collaborate on Git repositories'),
(8, 4, 'What does linking your local repository to GitHub allow you to do?', 'Upload changes to GitHub', 'Share your repository link with collaborators', 'Both of the above', 'None of the above', 'Both of the above'),
(9, 5, 'What is the purpose of the git pull command?', 'Fetch and merge changes from GitHub', 'Delete a Git repository', 'Push changes to GitHub', 'Fork another person\'s project', 'Fetch and merge changes from GitHub'),
(10, 5, 'How can you contribute to another person\'s GitHub project?', 'By forking their repository and submitting a pull request', 'By deleting their repository', 'By cloning and deleting their files', 'By creating a new GitHub account for them', 'By forking their repository and submitting a pull request'),
(11, 8, 'What is HTML?', 'A programming language', 'A style sheet language', 'A markup language for creating web pages', 'An image editing software', 'A markup language for creating web pages'),
(12, 8, 'What is an attribute in HTML?', 'A programming function', 'A style applied to HTML elements', 'A property that provides additional information about an element', 'A tool for debugging websites', 'A property that provides additional information about an element'),
(13, 9, 'Which element represents the main navigation area of a page?', '&lt;header&gt;', '&lt;nav&gt;', '&lt;main&gt;', '&lt;footer&gt;', '&lt;nav&gt;'),
(14, 9, 'What is the purpose of the &lt;section&gt; element?', 'Styles content', 'Groups related content', 'Defines main navigation', 'Displays footer information', 'Groups related content'),
(15, 10, 'Which tag is used to create a paragraph?', '&lt;h1&gt;', '&lt;p&gt;', '&lt;div&gt;', '&lt;span&gt;', '&lt;p&gt;'),
(16, 10, 'Which of the following tags creates a list with bullet points?', '&lt;ol&gt;', '&lt;ul&gt;', '&lt;li&gt;', '&lt;table&gt;', '&lt;ul&gt;'),
(17, 11, 'Which attribute specifies the source of the image file?', 'src', 'alt', 'path', 'file', 'src'),
(18, 11, 'What is the purpose of the alt attribute?', 'To display a tooltip', 'To provide alternative text for the image', 'To specify the source of the image', 'To resize the image', 'To provide alternative text for the image'),
(19, 12, 'What is the purpose of the href attribute in a link?', 'Specifies the destination URL', 'Defines the size of the text', 'Adds color to the link', 'Opens a file dialog box', 'src'),
(20, 12, 'How can you create a link that opens in a new tab?', 'Add target attribute with value _blank to the link tag', 'Use an ID in the href attribute', 'Specify a section within the page', 'Set the font size to large', 'Add target attribute with value _blank to the link tag'),
(21, 15, 'What does CSS stand for?', 'Cascading Style Sheets', 'Computer Style Sheets', 'Creative Style Sheets', 'Cascading Styling System', 'Cascading Style Sheets'),
(22, 15, 'Which of the following is a method of applying CSS to an HTML page?', 'Using JavaScript', 'Using CSS files', 'Using an HTML tag', 'Using SQL queries', 'Using CSS files'),
(23, 16, 'Which CSS selector targets all elements of a specific type?', 'Class Selector', 'Element Selector', 'ID Selector', 'Universal Selector', 'Element Selector'),
(24, 16, 'Which CSS property controls the space inside an element?', 'Margin', 'Padding', 'Border', 'Font-size', 'Padding'),
(25, 17, 'Which CSS property is used to change the background color of an element?', 'background-color: blue;', 'color: blue;', 'border-color: blue;', 'set-color:blue;', 'background-color: blue;'),
(26, 17, 'What does the rgb(255, 0, 0) value represent?', 'A shade of green', 'A shade of red', 'A shade of blue', 'A shade of purple', 'A shade of red'),
(27, 18, 'What property is used to change the font of a webpage in CSS?', 'font-size', 'font-family', 'font-weight', 'line-height', 'font-size'),
(28, 18, 'Which of the following is a common web font service?', 'Google Fonts', 'Typekit', 'Font Squirrel', 'All of the above', 'All of the above'),
(29, 19, 'What is the purpose of media queries in responsive design?', 'Apply styles based on screen size', 'Fix the layout of the page', 'Make the page look the same on all devices', 'Remove unnecessary styles', 'Apply styles based on screen size'),
(30, 19, 'Which of the following is the primary benefit of mobile-first design?', 'It ensures a better experience on mobile devices', 'It allows for complex layouts on large screens only', 'It simplifies the design process by avoiding large screens', 'It removes the need for media queries', 'It ensures a better experience on mobile devices');

-- --------------------------------------------------------

--
-- Table structure for table `remember_tokens`
--

CREATE TABLE `remember_tokens` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `token` varchar(64) NOT NULL,
  `expires_at` datetime NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `remember_tokens`
--

INSERT INTO `remember_tokens` (`id`, `user_id`, `token`, `expires_at`, `created_at`) VALUES
(4, 11, '3cd5d0a25d994ab36011056b0bf1a623452923fa886a2b467e7a009dab97f179', '2025-06-20 14:31:05', '2025-05-21 12:31:05');

-- --------------------------------------------------------

--
-- Table structure for table `test_question`
--

CREATE TABLE `test_question` (
  `id` int(11) NOT NULL,
  `course_id` int(10) UNSIGNED DEFAULT NULL,
  `question` text DEFAULT NULL,
  `option_a` text DEFAULT NULL,
  `option_b` text DEFAULT NULL,
  `option_c` text DEFAULT NULL,
  `option_d` text DEFAULT NULL,
  `correct_option` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `test_question`
--

INSERT INTO `test_question` (`id`, `course_id`, `question`, `option_a`, `option_b`, `option_c`, `option_d`, `correct_option`) VALUES
(1, 1, 'What is Git?', 'A) A programming language', 'B) A version control system', 'C) A database management system', 'D) A file-sharing tool', 'B'),
(2, 1, 'What is the purpose of a version control system like Git?', 'A) To compile programs', 'B) To design user interfaces', 'C) To track changes in files and collaborate effectively', 'D) To run server applications', 'C'),
(3, 1, 'What is GitHub?', 'A) A cloud-based platform for hosting Git repositories', 'B) A database management tool', 'C) A programming framework', 'D) A text editor', 'A'),
(4, 1, 'What is the difference between Git and GitHub?', 'A) Git is for UI design; GitHub is for web hosting', 'B) Git is a version control system; GitHub is a hosting service for Git repositories', 'C) Git is used for compiling code; GitHub is a database tool', 'D) There is no difference between Git and GitHub', 'B'),
(5, 1, 'What is a repository in Git?', 'A) A remote server used for hosting websites', 'B) A command for pushing changes', 'C) A programming language syntax', 'D) A folder that contains project files and their version history', 'D'),
(6, 1, 'What is a branch in Git?', 'A) A feature for adding contributors', 'B) A command to delete files', 'C) A separate line of development within a repository', 'D) A tool for creating pull requests', 'C'),
(7, 1, 'Which Git command is used to view the history of commits?', 'A) git history', 'B) git log', 'C) git status', 'D) git changes', 'B'),
(8, 1, 'What does the `git push` command do?', 'A) Downloads changes from a remote repository', 'B) Sends local changes to a remote repository', 'C) Clones a remote repository to your local machine', 'D) Creates a new repository', 'B'),
(9, 1, 'In a collaborative open-source project on GitHub, why is it important to fork a repository before making changes?', 'A) To ensure your changes are automatically added to the original project', 'B) To make the repository public for everyone to access', 'C) To create your own copy of the repository, allowing you to make changes without affecting the original project', 'D) To track all changes made by other contributors in the repository', 'C'),
(10, 1, 'What is the `git merge` command used for?', 'A) Combines two branches into one', 'B) Creates a new branch', 'C) Pushes changes to a remote repository', 'D) Clones a repository', 'A'),
(11, 1, 'What is the purpose of the `.gitignore` file?', 'A) To make files public', 'B) To ignore the repository itself', 'C) To ignore specific files and directories in the repository', 'D) To track changes in binary files', 'C'),
(12, 1, 'What does the `git clone` command do?', 'A) Pushes changes to a remote repository', 'B) Creates a new repository', 'C) Deletes a remote repository', 'D) Copies a repository to your local machine', 'D'),
(13, 1, 'What is the purpose of the `git fetch` command?', 'A) Merges branches', 'B) Commits changes to the repository', 'C) Fetches updates from the remote repository without merging', 'D) Deletes a branch', 'C'),
(14, 1, 'What is a pull request in GitHub?', 'A) An issue reporting tool', 'B) A request to pull changes from one branch to another', 'C) A process to clone a repository', 'D) A command to create a backup', 'B'),
(15, 1, 'Which command is used to delete a Git branch?', 'A) git branch -d', 'B) git remove branch', 'C) git branch delete', 'D) git delete', 'A'),
(16, 1, 'What does the `git rebase` command do?', 'A) Reapplies commits on top of another base tip', 'B) Merges two branches', 'C) Deletes a branch', 'D) Fetches changes from a remote repository', 'A'),
(17, 1, 'Which command is used to initialize a new Git repository?', 'A) git init', 'B) git start', 'C) git create', 'D) git repository', 'A'),
(18, 1, 'What does the `git diff` command show?', 'A) The differences between two commits', 'B) The log of changes', 'C) The current branch name', 'D) The history of branches', 'A'),
(19, 1, 'What does the `git stash` command do?', 'A) Temporarily saves changes without committing them', 'B) Deletes all changes', 'C) Pushes changes to a remote repository', 'D) Fetches changes from a remote repository', 'A'),
(20, 1, 'What is the difference between `git pull` and `git fetch`?', 'A) git pull merges changes, git fetch only downloads them', 'B) git fetch merges changes, git pull only downloads them', 'C) Both commands do the same thing', 'D) Neither command downloads changes', 'A'),
(21, 3, 'What is CSS?', 'A) A style sheet language used for describing the look of a document', 'B) A database management system', 'C) A server-side programming language', 'D) A cloud-based web hosting platform', 'A'),
(22, 3, 'Which of the following is a CSS selector?', 'A) A feature of JavaScript', 'B) A name used to identify and target HTML elements', 'C) A function in Python', 'D) A command for compiling code', 'B'),
(23, 3, 'What is the purpose of using HEX codes in CSS?', 'A) To structure HTML elements', 'B) To declare font sizes', 'C) To create animations', 'D) To specify colors in a web-friendly format', 'D'),
(24, 3, 'Which CSS property is used to set the font size?', 'A) font-size', 'B) color', 'C) border-radius', 'D) flex-wrap', 'A'),
(25, 3, 'What is the main purpose of media queries in CSS?', 'A) To apply different styles based on screen size and resolution', 'B) To style forms', 'C) To define colors for text', 'D) To create animations', 'A'),
(26, 3, 'Which CSS unit is relative to the width of the viewport?', 'A) em', 'B) px', 'C) vw', 'D) rem', 'C'),
(27, 3, 'How can you change the font size in CSS?', 'A) Using the text-font property', 'B) Using the text-size property', 'C) Using the font-size property', 'D) Using the font-weight property', 'C'),
(28, 3, 'What CSS property is used to adjust the spacing between characters in text?', 'A) letter-spacing', 'B) line-height', 'C) text-indent', 'D) text-align', 'A'),
(29, 3, 'What does responsive web design mean?', 'A) Designing websites that work well on all devices and screen sizes', 'B) Designing websites for desktop only', 'C) Designing websites for mobile only', 'D) Designing websites that look the same on all devices', 'A'),
(30, 3, 'Which CSS technique helps create layouts that adapt to different screen sizes?', 'A) Static positioning', 'B) Flexbox', 'C) Grid system', 'D) Media queries', 'D'),
(31, 3, 'What is the purpose of the CSS \"z-index\" property?', 'A) Sets the margin of an element', 'B) Controls the stacking order of elements', 'C) Adjusts the font size', 'D) Sets the background color of an element', 'B'),
(32, 3, 'Which CSS property is used to hide an element but still occupy space in the layout?', 'A) opacity', 'B) display', 'C) visibility', 'D) position', 'C'),
(33, 3, 'What does the CSS \"float\" property do?', 'A) Prevents elements from overlapping', 'B) Aligns elements to the center of the page', 'C) Allows elements to float next to each other', 'D) Stacks elements on top of each other', 'C'),
(34, 3, 'Which of the following properties is used to create a grid layout in CSS?', 'A) display: flex', 'B) display: grid', 'C) position: absolute', 'D) float: left', 'B'),
(35, 3, 'What is the default value of the \"position\" property in CSS?', 'A) relative', 'B) static', 'C) absolute', 'D) fixed', 'B'),
(36, 3, 'Which property is used to create a shadow effect around text in CSS?', 'A) box-shadow', 'B) text-shadow', 'C) shadow-effect', 'D) shadow', 'B'),
(37, 3, 'Which CSS property is used to align items horizontally in a flex container?', 'A) align-items', 'B) justify-content', 'C) flex-direction', 'D) gap', 'B'),
(38, 3, 'What does the \"overflow\" property in CSS control?', 'A) Controls how content is handled when it overflows the container', 'B) Controls text size', 'C) Controls element position', 'D) Controls background color', 'A'),
(39, 3, 'Which CSS property is used to create a smooth transition effect between two states?', 'A) animation', 'B) transition', 'C) transform', 'D) transition-duration', 'B'),
(40, 3, 'Which property is used to create a responsive container with flexible content?', 'A) grid', 'B) flexbox', 'C) position', 'D) visibility', 'B'),
(41, 2, 'What is the purpose of the <head> element in an HTML document?', 'A) Displays the main content of the page', 'B) Holds the page\'s footer information', 'C) Defines the structure of the layout', 'D) Contains metadata and links to external resources', 'D'),
(42, 2, 'Which element is used to create a link to another webpage?', 'A) &lt;link&gt;', 'B) &lt;href&gt;', 'C) &lt;a&gt;', 'D) &lt;url&gt;', 'C'),
(43, 2, 'What is the function of the <alt> attribute for images in HTML?', 'A) Sets the image\'s background color', 'B) Provides an alternative description of the image', 'C) Links the image to another page', 'D) Changes the image\'s size', 'B'),
(44, 2, 'Which of the following is the correct syntax to create an ordered list in HTML?', 'A) &lt;ul&gt;&lt;ol&gt;&lt;li&gt;Item 1&lt;/li&gt;&lt;/ol&gt;&lt;/ul&gt;', 'B) &lt;ol&gt;&lt;li&gt;Item 1&lt;/li&gt;&lt;/ol&gt;', 'C) &lt;ol&gt;&lt;ol&gt;&lt;li&gt;Item 1&lt;/li&gt;&lt;/ol&gt;&lt;/ol&gt;', 'D) &lt;list&gt;&lt;li&gt;Item 1&lt;/li&gt;&lt;/list&gt;', 'B'),
(45, 2, 'What does the <section> element define in an HTML document?', 'A) A generic container for content', 'B) A part of the document representing a specific area or topic', 'C) A navigation bar', 'D) A header section of the page', 'B'),
(46, 2, 'Which HTML element is used to create a clickable button?', 'A) &lt;button&gt;', 'B) &lt;input&gt;', 'C) &lt;a&gt;', 'D) &lt;div&gt;', 'A'),
(47, 2, 'What does the &lt;footer&gt; tag represent in HTML?', 'A) The bottom section of the page', 'B) The header section of the page', 'C) A side navigation menu', 'D) A content section for main articles', 'A'),
(48, 2, 'Which tag is used to define the largest heading in HTML?', 'A) &lt;h4&gt;', 'B) &lt;h2&gt;', 'C) &lt;h3&gt;', 'D) &lt;h1&gt;', 'D'),
(49, 2, 'Which of the following attributes is used to link an external CSS file to an HTML document?', 'A) link', 'B) src', 'C) href', 'D) rel', 'C'),
(50, 2, 'Which tag is used to define a paragraph in HTML?', 'A) &lt;p&gt;', 'B) &lt;div&gt;', 'C) &lt;section&gt;', 'D) &lt;article&gt;', 'A'),
(51, 2, 'Which of the following is the correct syntax to link an external JavaScript file in an HTML document?', 'A) &lt;javascript src=&quot;file.js&quot;&gt;&lt;/javascript&gt;', 'B) &lt;script src=&quot;file.js&quot;&gt;&lt;/script&gt;', 'C) &lt;link href=&quot;file.js&quot;&gt;', 'D) &lt;script href=&quot;file.js&quot;&gt;', 'B'),
(52, 2, 'What is the purpose of the &lt;div&gt; element in HTML?', 'A) Defines the main content', 'B) Defines a paragraph', 'C) Used to group content for styling or scripting', 'D) Creates a hyperlink', 'C'),
(53, 2, 'Which tag is used to define an image in HTML?', 'A) &lt;img&gt;', 'B) &lt;image&gt;', 'C) &lt;pic&gt;', 'D) &lt;src&gt;', 'A'),
(54, 2, 'Which of the following attributes is used to specify the source of an image?', 'A) src', 'B) alt', 'C) href', 'D) link', 'A'),
(55, 2, 'Which of the following is the correct syntax for a line break in HTML?', 'A) &lt;hr&gt;', 'B) &lt;break&gt;', 'C) &lt;linebreak&gt;', 'D) &lt;br&gt;', 'D'),
(56, 2, 'What does the &lt;form&gt; element define in an HTML document?', 'A) A footer section', 'B) A section for navigation links', 'C) A container for images', 'D) A container for user input elements', 'D'),
(57, 2, 'Which tag is used to create a list of items with bullet points in HTML?', 'A) &lt;list&gt;', 'B) &lt;ol&gt;', 'C) &lt;li&gt;', 'D) &lt;ul&gt;', 'D'),
(58, 2, 'What is the correct way to add a comment in an HTML document?', 'A) &lt;!-- This is a comment --&gt;', 'B) &lt;comment&gt;This is a comment&lt;/comment&gt;', 'C) &lt;//-- comment --&gt;', 'D) &lt;# This is a comment &gt;', 'A'),
(59, 2, 'Which HTML element is used to define a table row?', 'A) &lt;th&gt;', 'B) &lt;td&gt;', 'C) &lt;tr&gt;', 'D) &lt;table&gt;', 'C'),
(60, 2, 'Which HTML element is used to create a form input field?', 'A) &lt;form&gt;', 'B) &lt;input&gt;', 'C) &lt;button&gt;', 'D) &lt;select&gt;', 'B');

-- --------------------------------------------------------

--
-- Table structure for table `test_result`
--

CREATE TABLE `test_result` (
  `id` int(10) UNSIGNED NOT NULL,
  `course_id` int(10) UNSIGNED NOT NULL,
  `score` int(10) UNSIGNED NOT NULL,
  `passed` tinyint(1) NOT NULL,
  `completed_at` date NOT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `test_result`
--

INSERT INTO `test_result` (`id`, `course_id`, `score`, `passed`, `completed_at`, `user_id`) VALUES
(1, 1, 11, 1, '2025-05-15', 2),
(2, 3, 12, 1, '2025-05-16', 4),
(3, 1, 10, 1, '2025-05-21', 11);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile_pic` varchar(256) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `email`, `password`, `profile_pic`, `created_at`) VALUES
(1, 'abel teferi', 'abelteferi4007@gmail.com', '$2y$10$XtjMjjr3lWK7sYGtbnX6uejODxjXKlz4e/0pq8lpORElbspLSnYrO', NULL, '2025-05-15 15:17:38'),
(2, 'takood', 'lakood@gmail.com', '$2y$10$hJ4xHtSVUTvfFr5uv7LAw.F28.5jqrZuBrg2mR3B3xYEbFmDuszUG', NULL, '2025-05-15 15:46:08'),
(3, 'abel teferi', 'ibfginang@gmail.com', '$2y$10$HOsZNM3VNvrauWAPWAT.7.RmkpYB5N5rBYeCpGdA.4WHH5oVi.IqW', NULL, '2025-05-15 15:49:53'),
(4, 'abdu misbah', 'abdu@gmail.com', '$2y$10$a4ZXhelK7ESsRU4g.dMaG.M8m85fxBMHBpK/LsqHFqIS4S9uVmLta', '../upload/merge_ex1.jpg', '2025-05-16 09:39:04'),
(5, 'abel T', 'abelteferi@gmail.com', '$2y$10$1NT6SQlD56/vhf2Yo7yL3OpjC5TLbL50slP/mE4sm8r.DeEFdwUQ2', NULL, '2025-05-17 15:37:41'),
(6, 'abel Te', 'abelteferi2@gmail.com', '$2y$10$i.3/08i90j2eLLIGzhCE3eVraPALsEhwf/YmeZEC6afLDYS345drK', NULL, '2025-05-17 15:43:42'),
(7, 'abel tef', 'abelteferi3@gmail.com', '$2y$10$7g92q/Nw68Xm40OvZFdEt.FBlOKo62mcmoYKknN4zhw3J4iy56WHK', NULL, '2025-05-17 15:49:37'),
(8, 'abel tef', 'ABELTEFERI4@gmail.com', '$2y$10$VEvdgXc/bNtPyielJ7gjNO.S3RyJqhSocstTmimwP.uSmdbMY8A2K', NULL, '2025-05-17 15:55:48'),
(9, 'abdu', 'abdu2@gmail.com', '$2y$10$Ql9h6UJLqN3vVMC0mUHIAuS7pjvKkOGnv4lsTY5Y4iMpW.fd4RJaq', '../upload/Screenshot 2024-05-16 221042.png', '2025-05-17 17:04:08'),
(10, 'abdu', 'abdu3@gmail.com', '$2y$10$mIO3KEzOuJwjh7MPD60lB.CAPeeafpBDTTbFFwJ/4ioALr1A7Fplq', NULL, '2025-05-17 17:17:53'),
(11, 'abel teshome', 'abel85@gmail.com', '$2y$10$T4VkVLMjNznk/XYLOhA.t.s6viey9abkQd5cfK/swp71Dg5pNLryq', '../upload/Screenshot 2024-06-23 143615.png', '2025-05-21 15:25:40');

-- --------------------------------------------------------

--
-- Table structure for table `user_course_completion`
--

CREATE TABLE `user_course_completion` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `course_id` int(10) UNSIGNED NOT NULL,
  `completed_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_course_completion`
--

INSERT INTO `user_course_completion` (`id`, `user_id`, `course_id`, `completed_at`) VALUES
(1, 2, 1, '2025-05-15 15:59:45'),
(2, 4, 3, '2025-05-16 11:39:40'),
(3, 11, 1, '2025-05-21 16:09:58');

-- --------------------------------------------------------

--
-- Table structure for table `user_lesson_views`
--

CREATE TABLE `user_lesson_views` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `lesson_id` int(11) NOT NULL,
  `viewed_at` datetime DEFAULT current_timestamp(),
  `course_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_lesson_views`
--

INSERT INTO `user_lesson_views` (`id`, `user_id`, `lesson_id`, `viewed_at`, `course_id`) VALUES
(6, 1, 8, '2025-05-15 15:40:30', 2),
(7, 1, 1, '2025-05-15 15:40:57', 1),
(8, 1, 9, '2025-05-15 15:42:23', 2),
(9, 2, 1, '2025-05-15 15:57:53', 1),
(10, 4, 15, '2025-05-16 10:54:45', 3),
(11, 4, 16, '2025-05-16 11:28:24', 3),
(12, 4, 19, '2025-05-16 11:30:44', 3),
(13, 9, 8, '2025-05-17 18:32:26', 2),
(14, 9, 9, '2025-05-17 18:47:36', 2),
(15, 9, 15, '2025-05-17 19:08:57', 3),
(16, 11, 1, '2025-05-21 16:01:59', 1),
(17, 11, 5, '2025-05-21 16:06:50', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_question_attempts`
--

CREATE TABLE `user_question_attempts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `attempted_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_question_attempts`
--

INSERT INTO `user_question_attempts` (`id`, `user_id`, `question_id`, `attempted_at`) VALUES
(3, 1, 12, '2025-05-15 15:43:45'),
(4, 1, 11, '2025-05-15 15:44:00'),
(5, 2, 1, '2025-05-15 15:57:56'),
(6, 4, 21, '2025-05-16 10:54:50'),
(7, 4, 23, '2025-05-16 11:28:31'),
(8, 11, 1, '2025-05-21 16:04:10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `enrollment`
--
ALTER TABLE `enrollment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `lessons`
--
ALTER TABLE `lessons`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `lesson_video`
--
ALTER TABLE `lesson_video`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_course_id` (`course_id`),
  ADD KEY `fk_lesson_id` (`lesson_id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_lesson` (`lesson_id`);

--
-- Indexes for table `remember_tokens`
--
ALTER TABLE `remember_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `test_question`
--
ALTER TABLE `test_question`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_fk` (`course_id`);

--
-- Indexes for table `test_result`
--
ALTER TABLE `test_result`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_test_result_course` (`course_id`),
  ADD KEY `fk_test_result_user` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_course_completion`
--
ALTER TABLE `user_course_completion`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`,`course_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `user_lesson_views`
--
ALTER TABLE `user_lesson_views`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`,`lesson_id`),
  ADD KEY `lesson_id` (`lesson_id`);

--
-- Indexes for table `user_question_attempts`
--
ALTER TABLE `user_question_attempts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `question_id` (`question_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `enrollment`
--
ALTER TABLE `enrollment`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `lessons`
--
ALTER TABLE `lessons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `lesson_video`
--
ALTER TABLE `lesson_video`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `remember_tokens`
--
ALTER TABLE `remember_tokens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `test_question`
--
ALTER TABLE `test_question`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `test_result`
--
ALTER TABLE `test_result`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `user_course_completion`
--
ALTER TABLE `user_course_completion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_lesson_views`
--
ALTER TABLE `user_lesson_views`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `user_question_attempts`
--
ALTER TABLE `user_question_attempts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `enrollment`
--
ALTER TABLE `enrollment`
  ADD CONSTRAINT `enrollment_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `enrollment_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `lessons`
--
ALTER TABLE `lessons`
  ADD CONSTRAINT `lessons_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`);

--
-- Constraints for table `lesson_video`
--
ALTER TABLE `lesson_video`
  ADD CONSTRAINT `fk_course_id` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_lesson_id` FOREIGN KEY (`lesson_id`) REFERENCES `lessons` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `fk_lesson` FOREIGN KEY (`lesson_id`) REFERENCES `lessons` (`id`);

--
-- Constraints for table `remember_tokens`
--
ALTER TABLE `remember_tokens`
  ADD CONSTRAINT `remember_tokens_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `test_question`
--
ALTER TABLE `test_question`
  ADD CONSTRAINT `course_fk` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `test_result`
--
ALTER TABLE `test_result`
  ADD CONSTRAINT `fk_test_result_course` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`),
  ADD CONSTRAINT `fk_test_result_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `user_course_completion`
--
ALTER TABLE `user_course_completion`
  ADD CONSTRAINT `user_course_completion_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_course_completion_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_lesson_views`
--
ALTER TABLE `user_lesson_views`
  ADD CONSTRAINT `user_lesson_views_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_lesson_views_ibfk_2` FOREIGN KEY (`lesson_id`) REFERENCES `lessons` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_question_attempts`
--
ALTER TABLE `user_question_attempts`
  ADD CONSTRAINT `user_question_attempts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_question_attempts_ibfk_2` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
