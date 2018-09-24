-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 22, 2018 at 04:14 AM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `thesis`
--

-- --------------------------------------------------------

--
-- Table structure for table `1_mahogani`
--

CREATE TABLE `1_mahogani` (
  `attendance_id` int(10) UNSIGNED NOT NULL,
  `grade` int(11) DEFAULT NULL,
  `student_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `attendance` int(11) NOT NULL,
  `total_attendance` int(11) NOT NULL,
  `absent_dates` varchar(555) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `1_mahogani`
--

INSERT INTO `1_mahogani` (`attendance_id`, `grade`, `student_id`, `subject_id`, `attendance`, `total_attendance`, `absent_dates`) VALUES
(1, NULL, 34, 18, 1, 1, '[]');

-- --------------------------------------------------------

--
-- Table structure for table `2_narra`
--

CREATE TABLE `2_narra` (
  `attendance_id` int(10) UNSIGNED NOT NULL,
  `grade` int(11) DEFAULT NULL,
  `student_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `attendance` int(11) NOT NULL,
  `total_attendance` int(11) NOT NULL,
  `updated_at` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `absent_dates` varchar(555) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `2_narra`
--

INSERT INTO `2_narra` (`attendance_id`, `grade`, `student_id`, `subject_id`, `attendance`, `total_attendance`, `updated_at`, `absent_dates`) VALUES
(2, NULL, 36, 20, 1, 1, '', ''),
(3, NULL, 36, 23, 1, 1, '', '|2018-09-21|2018-09-21'),
(4, NULL, 34, 20, 0, 1, '2018-09-21', ''),
(5, NULL, 34, 23, 0, 1, '2018-09-21', '');

-- --------------------------------------------------------

--
-- Table structure for table `3_buko`
--

CREATE TABLE `3_buko` (
  `attendance_id` int(10) UNSIGNED NOT NULL,
  `grade` int(11) DEFAULT NULL,
  `student_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `attendance` int(11) NOT NULL,
  `total_attendance` int(11) NOT NULL,
  `updated_at` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `absent_dates` varchar(555) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `4_santol`
--

CREATE TABLE `4_santol` (
  `attendance_id` int(10) UNSIGNED NOT NULL,
  `grade` int(11) DEFAULT NULL,
  `student_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `attendance` int(11) NOT NULL,
  `total_attendance` int(11) NOT NULL,
  `absent_dates` varchar(555) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `first_year_grades`
--

CREATE TABLE `first_year_grades` (
  `grade_id` int(11) NOT NULL,
  `score` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `quarter` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `first_year_grades`
--

INSERT INTO `first_year_grades` (`grade_id`, `score`, `student_id`, `subject_id`, `quarter`) VALUES
(13, 123, 34, 19, 1),
(14, 12, 34, 19, 2),
(15, 124, 34, 19, 3),
(16, 12, 34, 19, 4);

-- --------------------------------------------------------

--
-- Table structure for table `fourth_year_grade`
--

CREATE TABLE `fourth_year_grade` (
  `grade_id` int(11) NOT NULL,
  `score` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `quarter` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `grade`
--

CREATE TABLE `grade` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `first_quarter` decimal(6,2) NOT NULL,
  `second_quarter` decimal(6,2) NOT NULL,
  `third_quarter` decimal(6,2) NOT NULL,
  `fourth_quarter` decimal(6,2) NOT NULL,
  `average` decimal(6,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 2),
(4, '2018_09_02_135600_create_teacher_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `parent`
--

CREATE TABLE `parent` (
  `parent_id` int(11) NOT NULL,
  `parent_name` varchar(255) NOT NULL,
  `parent_relation` varchar(255) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `contact_number` int(20) DEFAULT NULL,
  `occupation` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `parent`
--

INSERT INTO `parent` (`parent_id`, `parent_name`, `parent_relation`, `student_id`, `contact_number`, `occupation`) VALUES
(25, 'asd', 'Mother', 34, 123, 'asd'),
(26, 'asd', 'Father', 34, 123, 'asd'),
(27, 'qweqwe', 'Mother', 35, 123123123, 'qweqwe'),
(28, 'asd', 'Father', 35, 123123, 'qweqwe'),
(29, 'Kulas', 'Mother', 36, 123242, 'Pigo'),
(30, 'Kulas', 'Father', 36, 12323, 'Pigo');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` int(11) NOT NULL,
  `full_amount` int(10) NOT NULL,
  `down_payment` int(10) NOT NULL,
  `monthly_payment` int(10) NOT NULL,
  `tuition_fee` int(10) NOT NULL,
  `energy_fee` int(10) NOT NULL,
  `internet_lab` int(10) NOT NULL,
  `speech_lab` int(10) NOT NULL,
  `book` varchar(55) NOT NULL DEFAULT '[]',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id`, `full_amount`, `down_payment`, `monthly_payment`, `tuition_fee`, `energy_fee`, `internet_lab`, `speech_lab`, `book`, `created_at`, `updated_at`) VALUES
(1, 25000, 10000, 1000, 5000, 1000, 1000, 1000, '[\'1100\',\'1200\',\'1300\',\'1400\']', '2018-09-20 06:14:26', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `schedule_id` int(11) NOT NULL,
  `teacher_id` int(11) UNSIGNED DEFAULT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `section_id` int(11) DEFAULT NULL,
  `schedule_name` varchar(55) NOT NULL,
  `schedule_time_id` int(11) NOT NULL,
  `schedule_type` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`schedule_id`, `teacher_id`, `subject_id`, `section_id`, `schedule_name`, `schedule_time_id`, `schedule_type`, `created_at`, `updated_at`) VALUES
(19, 9, 19, 32, '8:00am - 9:00am', 1, 1, '2018-09-21 02:17:56', NULL),
(20, 10, 20, 34, '8:00am - 9:00am', 1, 1, '2018-09-21 02:18:09', NULL),
(21, 11, 21, 35, '8:00am - 9:00am', 1, 1, '2018-09-21 02:18:18', NULL),
(23, 10, 23, 34, '9:00am - 10:00am', 2, 1, '2018-09-21 04:26:07', NULL),
(24, 11, NULL, 33, '10:00am - 11:00am', 3, 1, '2018-09-21 15:54:04', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `second_year_grades`
--

CREATE TABLE `second_year_grades` (
  `grade_id` int(11) NOT NULL,
  `score` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `quarter` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `second_year_grades`
--

INSERT INTO `second_year_grades` (`grade_id`, `score`, `subject_id`, `student_id`, `quarter`) VALUES
(1, 50, 23, 36, 1),
(2, 12, 20, 36, 1);

-- --------------------------------------------------------

--
-- Table structure for table `section`
--

CREATE TABLE `section` (
  `id` int(11) NOT NULL,
  `year` varchar(255) NOT NULL,
  `capacity` int(11) NOT NULL,
  `section_name` varchar(255) NOT NULL,
  `teacher_id` int(11) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `section`
--

INSERT INTO `section` (`id`, `year`, `capacity`, `section_name`, `teacher_id`, `created_at`, `updated_at`) VALUES
(32, '1', 30, 'Mahogani', 9, '2018-09-21 02:16:13', '2018-09-20 18:16:13'),
(33, '4', 50, 'Santol', 12, '2018-09-21 02:16:30', '2018-09-20 18:16:30'),
(34, '2', 50, 'Narra', 10, '2018-09-21 02:16:20', '2018-09-20 18:16:20'),
(35, '3', 50, 'Buko', 11, '2018-09-21 02:16:25', '2018-09-20 18:16:25');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `section_id` int(11) DEFAULT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `religion` varchar(255) DEFAULT NULL,
  `gender` int(11) NOT NULL,
  `birthdate` date NOT NULL,
  `guardian_email` varchar(255) NOT NULL,
  `guardian_number` int(20) NOT NULL,
  `guardian_name` varchar(255) NOT NULL,
  `guardian_occupation` varchar(255) NOT NULL,
  `guardian_relation` varchar(255) NOT NULL,
  `old_school_name` varchar(255) NOT NULL,
  `old_school_address` varchar(255) NOT NULL,
  `old_year_level` int(3) NOT NULL,
  `old_school_year` varchar(255) NOT NULL,
  `payment_id` int(11) NOT NULL,
  `qr_code` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `pin` int(4) NOT NULL DEFAULT '1234',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `section_id`, `first_name`, `middle_name`, `last_name`, `address`, `religion`, `gender`, `birthdate`, `guardian_email`, `guardian_number`, `guardian_name`, `guardian_occupation`, `guardian_relation`, `old_school_name`, `old_school_address`, `old_year_level`, `old_school_year`, `payment_id`, `qr_code`, `status`, `pin`, `created_at`, `updated_at`) VALUES
(34, 34, 'qwe', 'qwe', 'qwe', 'asd', 'qweqwe', 1, '2018-09-10', 'kkyle.malitig@gmail.com', 123123, 'asd', 'asd', 'asd', 'qwe', 'qwe', 1, '2312312', 1, '8d3498ad9f7381a0e83b0b99c4c5e6d5', 1, 1234, '2018-09-21 15:46:14', '2018-09-21 15:46:14'),
(35, 33, 'qweqwe', 'qweqwe', 'qweqwe', 'qweqwe', 'qweqwe', 2, '2018-09-09', 'joshuakyle.malitig@gmail.com', 123123, 'asdasdasd', 'asd', 'asd', 'qweqwe', 'qweqweqwe', 3, '2018', 1, '8f33b326a4b25bc209819202ed578b75', 1, 1234, '2018-09-21 04:05:24', '2018-09-21 04:05:24'),
(36, 34, 'Pigo', 'Kulas', 'Kulas', 'qweqwe', NULL, 1, '2018-09-10', 'joshuakyle.malitig@gmail.com', 23123123, 'Kulas Pigo', 'Test', 'Test', 'Kulas', 'qweqwe', 1, '123456', 1, '46194e896cb45f90d8b166c64190ae5b', 1, 1234, '2018-09-21 04:21:28', '2018-09-21 04:21:28');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int(11) NOT NULL,
  `subject_name` varchar(255) NOT NULL,
  `year` int(11) DEFAULT NULL,
  `schedule_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `subject_name`, `year`, `schedule_id`, `created_at`, `updated_at`) VALUES
(19, 'Science', 1, 19, '2018-09-21 02:17:56', '2018-09-20 18:17:56'),
(20, 'Biology', 2, 20, '2018-09-21 02:18:09', '2018-09-20 18:18:09'),
(21, 'Chemistry', 3, 21, '2018-09-21 02:18:18', '2018-09-20 18:18:18'),
(23, 'English-2', 2, 23, '2018-09-21 04:26:07', '2018-09-20 20:26:07'),
(24, 'English 4', 4, NULL, '2018-09-21 07:50:49', '2018-09-21 15:50:49'),
(25, 'Math 4', 4, NULL, '2018-09-21 07:51:12', '2018-09-21 15:51:12');

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` int(11) NOT NULL,
  `birth_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`id`, `user_id`, `first_name`, `last_name`, `contact_number`, `gender`, `type`, `birth_date`, `created_at`, `updated_at`) VALUES
(9, 24, 'teacher1', 'teacher1', '123123123', 'Male', 1, '2018-09-28', '2018-09-20 18:14:47', NULL),
(10, 25, 'teacher2', 'teacher2', '123123123', 'Femal', 1, '2018-09-27', '2018-09-20 18:15:06', NULL),
(11, 26, 'teacher3', 'teacher3', '123123123', 'Male', 1, '2018-09-27', '2018-09-20 18:15:40', NULL),
(12, 27, 'teacher4', 'teacher4', '123123123', 'Femal', 1, '2018-09-27', '2018-09-20 18:16:05', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `thrid_year_grades`
--

CREATE TABLE `thrid_year_grades` (
  `grade_id` int(11) NOT NULL,
  `score` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `quarter` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_role` int(5) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `remember_token`, `user_role`, `created_at`, `updated_at`) VALUES
(1, 'kyle', 'test@email.com', '$2y$10$h7yfcxfYTWamLzqxo0WBFOVokuRSyY5Iy8NxLIpsL2Qc/yPZn8cFm', 'vd04QD7f4cle0OmrA4FkJ8aRaQAOII9jkqWCuhIrM8Oqk2E2bK6fQs7vj6l9', 0, '2018-09-02 04:17:36', '2018-09-02 04:17:36'),
(2, 'test', 'mjiem1221@gmail.com', '$2y$10$df/9o1qYtEK718ny9FFBP.ffwuFyis/ogvZ3jjaOSBtpIXDwN0dY2', 'qcesTsKWyRXzpSkwK0T9ZTKFJw7NvE3UBjKys3KEubIvQ3GgyVa5yxhX0Sm5', 0, '2018-09-02 04:35:04', '2018-09-02 04:35:04'),
(10, 'qweqweqwe', 'asdasd', '$2y$10$vHiXJcqg90Xhu4rfDXmQCOMcm7XRO2uDruwX2NodrnzQHCDRaggki', NULL, 0, NULL, NULL),
(13, 'agent', 'qwe@kyle.com', '$2y$10$BZd9F4Fxr6hsNSmgubvk4OG7AKvQR3ziGCy8osMSuH53Iu1znILxi', NULL, 1, NULL, '2018-09-05 05:38:22'),
(14, 'felix', 'arde@email.com', '$2y$10$8X8IBnBBuVQq.0W/2DK91eF8Zhz566Noiz2PQtaJMB9He2vaEwnAe', NULL, 1, NULL, '2018-09-05 07:25:16'),
(19, 'cswhitelabel', 'jompol1234@gmai.com', '$2y$10$dzQTWkxx8bywzO5HKm.xn.0v.jCMtwSWHDLeX1S1UAbNq4IDG33Aq', NULL, 1, NULL, NULL),
(24, 'teacher1', 'teacher1@email.com', '$2y$10$D8LQHlfT9zAiV9Pq3AlmA.oziVPdIuTQmlQ5U0zLt3hd2gh6AILxG', '4K8uCoOIpecN1M4G5tSpKvljtLKk5e5ixnTm4lTkCRkLWSjYRo6zcHcEIrRA', 1, '2018-09-20 18:14:47', NULL),
(25, 'teacher2', 'teacher2@email.com', '$2y$10$AcPKXfbDYLuzITm4583KNePnBIVbNR1gWzXacwqBY6Y7sIkXNPWEm', 'JFVLDn5wOiEtQPjW1EVgwuVgtXgXWfuC1AfxGIMhELKvPkMLmDk1bA5Yh60t', 1, '2018-09-20 18:15:06', NULL),
(26, 'teacher3', 'teacher3@email.com', '$2y$10$c6MpxzQJs1RTJwS5Gv9Dh.axLZpB2f8HMyePPdyrhRz2YpSPTR5zq', NULL, 1, '2018-09-20 18:15:40', NULL),
(27, 'teacher4', 'teacher4@gmail.com', '$2y$10$h2R77Y1uXAmU8H9atSZhke2mhhXxEg08VyQxjhVIF9NF093HCLl/q', NULL, 1, '2018-09-20 18:16:05', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `1_mahogani`
--
ALTER TABLE `1_mahogani`
  ADD PRIMARY KEY (`attendance_id`);

--
-- Indexes for table `2_narra`
--
ALTER TABLE `2_narra`
  ADD PRIMARY KEY (`attendance_id`);

--
-- Indexes for table `3_buko`
--
ALTER TABLE `3_buko`
  ADD PRIMARY KEY (`attendance_id`);

--
-- Indexes for table `4_santol`
--
ALTER TABLE `4_santol`
  ADD PRIMARY KEY (`attendance_id`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subject_id` (`subject_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `first_year_grades`
--
ALTER TABLE `first_year_grades`
  ADD PRIMARY KEY (`grade_id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `subject_id` (`subject_id`);

--
-- Indexes for table `fourth_year_grade`
--
ALTER TABLE `fourth_year_grade`
  ADD PRIMARY KEY (`grade_id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `subject_id` (`subject_id`);

--
-- Indexes for table `grade`
--
ALTER TABLE `grade`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subject_id` (`subject_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `parent`
--
ALTER TABLE `parent`
  ADD PRIMARY KEY (`parent_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`schedule_id`),
  ADD KEY `teacher_id` (`teacher_id`),
  ADD KEY `subject_id` (`subject_id`),
  ADD KEY `section_id` (`section_id`);

--
-- Indexes for table `second_year_grades`
--
ALTER TABLE `second_year_grades`
  ADD PRIMARY KEY (`grade_id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `subject_id` (`subject_id`);

--
-- Indexes for table `section`
--
ALTER TABLE `section`
  ADD PRIMARY KEY (`id`),
  ADD KEY `section_ibfk_1` (`teacher_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD KEY `section_id` (`section_id`),
  ADD KEY `payment_id` (`payment_id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `schedule_id` (`schedule_id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `teachers_user_id_foreign` (`user_id`);

--
-- Indexes for table `thrid_year_grades`
--
ALTER TABLE `thrid_year_grades`
  ADD PRIMARY KEY (`grade_id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `subject_id` (`subject_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `1_mahogani`
--
ALTER TABLE `1_mahogani`
  MODIFY `attendance_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `2_narra`
--
ALTER TABLE `2_narra`
  MODIFY `attendance_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `3_buko`
--
ALTER TABLE `3_buko`
  MODIFY `attendance_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `4_santol`
--
ALTER TABLE `4_santol`
  MODIFY `attendance_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `first_year_grades`
--
ALTER TABLE `first_year_grades`
  MODIFY `grade_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `fourth_year_grade`
--
ALTER TABLE `fourth_year_grade`
  MODIFY `grade_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `grade`
--
ALTER TABLE `grade`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `parent`
--
ALTER TABLE `parent`
  MODIFY `parent_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `schedule_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `second_year_grades`
--
ALTER TABLE `second_year_grades`
  MODIFY `grade_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `section`
--
ALTER TABLE `section`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `thrid_year_grades`
--
ALTER TABLE `thrid_year_grades`
  MODIFY `grade_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `attendance_ibfk_1` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`),
  ADD CONSTRAINT `attendance_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`);

--
-- Constraints for table `first_year_grades`
--
ALTER TABLE `first_year_grades`
  ADD CONSTRAINT `first_year_grades_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `first_year_grades_ibfk_2` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `fourth_year_grade`
--
ALTER TABLE `fourth_year_grade`
  ADD CONSTRAINT `fourth_year_grade_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fourth_year_grade_ibfk_2` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `grade`
--
ALTER TABLE `grade`
  ADD CONSTRAINT `grade_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`),
  ADD CONSTRAINT `grade_ibfk_2` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`);

--
-- Constraints for table `parent`
--
ALTER TABLE `parent`
  ADD CONSTRAINT `parent_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`);

--
-- Constraints for table `schedule`
--
ALTER TABLE `schedule`
  ADD CONSTRAINT `schedule_ibfk_1` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `schedule_ibfk_2` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `schedule_ibfk_3` FOREIGN KEY (`section_id`) REFERENCES `section` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `second_year_grades`
--
ALTER TABLE `second_year_grades`
  ADD CONSTRAINT `second_year_grades_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `second_year_grades_ibfk_2` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `section`
--
ALTER TABLE `section`
  ADD CONSTRAINT `section_ibfk_1` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`section_id`) REFERENCES `section` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `subjects`
--
ALTER TABLE `subjects`
  ADD CONSTRAINT `subjects_ibfk_2` FOREIGN KEY (`schedule_id`) REFERENCES `schedule` (`schedule_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `teachers`
--
ALTER TABLE `teachers`
  ADD CONSTRAINT `teachers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `thrid_year_grades`
--
ALTER TABLE `thrid_year_grades`
  ADD CONSTRAINT `thrid_year_grades_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `thrid_year_grades_ibfk_2` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
