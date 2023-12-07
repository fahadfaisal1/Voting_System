-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 25, 2023 at 11:26 PM
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
-- Database: `damilare`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` int(11) NOT NULL,
  `aid` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `password`, `aid`, `status`) VALUES
(1, 'Moiz', 'moiz123@gmail.com', 123, 1122, 1),
(2, 'fahad', 'fahad123@gmail.com', 123, 1123, 0),
(3, 'sajjad', 'sajjad123@gmail.com', 123, 1124, 0);

-- --------------------------------------------------------

--
-- Table structure for table `candidates`
--

CREATE TABLE `candidates` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `votes` int(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` varchar(255) NOT NULL,
  `modified_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `candidates`
--

INSERT INTO `candidates` (`id`, `name`, `image`, `category`, `votes`, `status`, `created_at`, `modified_at`) VALUES
(5, 'Shahebaz', 'Terry-Sejnowski.jpg', 'S.U.G President', 0, '0', '19-February-2023', '2023-04-25 21:25:58'),
(6, 'Hemant Rokade', 'This_is_the_photo_of_Arthur_Samuel.jpg', 'S.U.G V. President ', 0, '0', '19-February-2023', '2023-04-25 21:25:58'),
(7, 'Damilare', '47097_45202_500_775_jpg.jpg', 'Class Representatives', 0, '0', '20-February-2023', '2023-04-25 21:25:58'),
(8, 'Shoaib', 'bd0b14c591e5d3ca0f67593cd801a2af28fca078.png', 'College Ambassadors', 0, '0', '20-February-2023', '2023-04-25 21:25:58');

-- --------------------------------------------------------

--
-- Table structure for table `info`
--

CREATE TABLE `info` (
  `id` int(11) NOT NULL,
  `text` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `info`
--

INSERT INTO `info` (`id`, `text`, `logo`) VALUES
(1, 'Just like we do vote physically, here you can do same activity virtually. This platform is made to make the task easy and save time. Here everything is done exactly like it is done in a traditional method but online.\r\n\r\n', 'actu-100112-elections-presidentielles-.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

CREATE TABLE `register` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `faculty` varchar(300) NOT NULL,
  `department` varchar(300) NOT NULL,
  `email` varchar(300) NOT NULL,
  `sid` varchar(100) NOT NULL,
  `password` varchar(300) NOT NULL,
  `sec_q_id` int(11) NOT NULL,
  `sec_ans` varchar(255) NOT NULL,
  `status` int(1) NOT NULL,
  `created_at` varchar(255) NOT NULL,
  `modified_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`id`, `name`, `faculty`, `department`, `email`, `sid`, `password`, `sec_q_id`, `sec_ans`, `status`, `created_at`, `modified_at`) VALUES
(1, 'moiz', 'abc', 'abc', 'abdulmoiz8236@gmail.com', '1122', '$2y$10$2i4Q.egmuUoNvS/nsS5UZu9COeYVA6h9STytg4JQRpUfNuEyAqYAi', 1, 'Lahore', 0, '', '2023-04-25 21:23:34'),
(14, 'Hajji', 'a', 'a', 'sajjad@gmail.com', '90', '$2y$10$78D3DbeIwyQdBAbBud0Ta.D8o7YfOcv2dOrMbtEaXGTPHY4.4cJR6', 3, 'hell', 0, '04-04-2023', '2023-04-25 12:25:02'),
(15, 'sajjad', 'a', 'a', 'sajjad@gmail.com', '112233', '$2y$10$aeZg/H44U0unAUTxJuvXW./mSeBHJHjIozYOkQ2S2fsV6dRxSPttW', 1, 'Lahore', 0, '25-04-2023', '2023-04-25 21:23:34');

-- --------------------------------------------------------

--
-- Table structure for table `result`
--

CREATE TABLE `result` (
  `id` int(11) NOT NULL,
  `c_id` int(11) NOT NULL,
  `r1` int(11) NOT NULL,
  `r2` int(11) NOT NULL,
  `r3` int(11) NOT NULL,
  `r4` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sec_q`
--

CREATE TABLE `sec_q` (
  `Id` int(11) NOT NULL,
  `question` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sec_q`
--

INSERT INTO `sec_q` (`Id`, `question`) VALUES
(1, 'In what city were you born?'),
(2, 'What is the name of your favorite pet?'),
(3, 'What high school did you attend?'),
(4, 'What was the name of your elementary school?'),
(5, 'What was the make of your first car?'),
(6, 'What was your favorite food as a child?');

-- --------------------------------------------------------

--
-- Table structure for table `verify`
--

CREATE TABLE `verify` (
  `id` int(11) NOT NULL,
  `code` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `verify`
--

INSERT INTO `verify` (`id`, `code`) VALUES
(1, 129894),
(2, 667101),
(3, 237514),
(4, 625546),
(5, 578396),
(6, 655869),
(7, 796288),
(8, 720414),
(9, 530688),
(10, 690752),
(11, 224850);

-- --------------------------------------------------------

--
-- Table structure for table `voting`
--

CREATE TABLE `voting` (
  `id` int(11) NOT NULL,
  `v_id` int(10) NOT NULL,
  `c_id` int(10) NOT NULL,
  `rank` int(1) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `candidates`
--
ALTER TABLE `candidates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `info`
--
ALTER TABLE `info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `register`
--
ALTER TABLE `register`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sec_q_id` (`sec_q_id`);

--
-- Indexes for table `result`
--
ALTER TABLE `result`
  ADD PRIMARY KEY (`id`),
  ADD KEY `c_id` (`c_id`);

--
-- Indexes for table `sec_q`
--
ALTER TABLE `sec_q`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `verify`
--
ALTER TABLE `verify`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `voting`
--
ALTER TABLE `voting`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `candidates`
--
ALTER TABLE `candidates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `info`
--
ALTER TABLE `info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `register`
--
ALTER TABLE `register`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `result`
--
ALTER TABLE `result`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sec_q`
--
ALTER TABLE `sec_q`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `verify`
--
ALTER TABLE `verify`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `voting`
--
ALTER TABLE `voting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `register`
--
ALTER TABLE `register`
  ADD CONSTRAINT `register_ibfk_1` FOREIGN KEY (`sec_q_id`) REFERENCES `sec_q` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `result`
--
ALTER TABLE `result`
  ADD CONSTRAINT `result_ibfk_1` FOREIGN KEY (`c_id`) REFERENCES `candidates` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
