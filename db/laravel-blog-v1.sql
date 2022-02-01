-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 31, 2022 at 10:29 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel-blog-v1`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo_original_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo_size` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo_extention` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_super` tinyint(1) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`, `photo_name`, `photo_original_name`, `photo_size`, `photo_extention`, `is_super`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', '$2y$10$St1qE3MtYFXsv3SkA8JIe.a32fn4GBEtuAtlLn3bfW.60Sg0eT5E2', '0_1640625167.jpeg', 'person_4.jpg', '86756', 'jpeg', 1, NULL, '2020-10-14 11:38:27', '2021-12-27 11:12:48');

-- --------------------------------------------------------

--
-- Table structure for table `edu_answers`
--

CREATE TABLE `edu_answers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `question_id` int(11) NOT NULL COMMENT 'pk = edu_archive_questions.id',
  `answer` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `true_answer` tinyint(4) NOT NULL COMMENT '1=True, 0=False',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `edu_answers`
--

INSERT INTO `edu_answers` (`id`, `question_id`, `answer`, `true_answer`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'h text', 0, '2022-01-31 01:29:13', '2022-01-31 01:29:13', NULL),
(2, 1, 'b text', 0, '2022-01-31 01:29:13', '2022-01-31 01:29:13', NULL),
(3, 1, 'hyper text', 1, '2022-01-31 01:29:13', '2022-01-31 01:29:13', NULL),
(4, 1, 'dddd', 0, '2022-01-31 01:29:13', '2022-01-31 01:29:13', NULL),
(5, 2, 'hpyer text', 0, '2022-01-31 01:29:54', '2022-01-31 01:29:54', NULL),
(6, 2, 'a text', 0, '2022-01-31 01:29:54', '2022-01-31 01:29:54', NULL),
(7, 2, 'aas', 0, '2022-01-31 01:29:54', '2022-01-31 01:29:54', NULL),
(8, 2, 'hyper text markup', 1, '2022-01-31 01:29:54', '2022-01-31 01:29:54', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `edu_answer_types`
--

CREATE TABLE `edu_answer_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `answer_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `edu_answer_types`
--

INSERT INTO `edu_answer_types` (`id`, `answer_type`) VALUES
(1, 'True/False'),
(2, 'MCQ [Single Correct Answer]'),
(3, 'MCQ [Multiple Correct Answer]');

-- --------------------------------------------------------

--
-- Table structure for table `edu_archive_questions`
--

CREATE TABLE `edu_archive_questions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `question` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer_type` tinyint(4) NOT NULL COMMENT 'pk=edu_answer_type.id',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `edu_archive_questions`
--

INSERT INTO `edu_archive_questions` (`id`, `question`, `answer_type`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'what is http ?<br>', 2, '2022-01-31 01:29:13', '2022-01-31 01:29:13', NULL),
(2, 'what is html ?<br>', 2, '2022-01-31 01:29:54', '2022-01-31 01:29:54', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `edu_exam_configs`
--

CREATE TABLE `edu_exam_configs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `exam_overview` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `exam_duration` int(11) NOT NULL,
  `questions` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_question` int(11) NOT NULL,
  `per_question_mark` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `edu_exam_configs`
--

INSERT INTO `edu_exam_configs` (`id`, `exam_overview`, `exam_duration`, `questions`, `total_question`, `per_question_mark`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'pleasse read carefully<br>', 10, '[\"1\",\"2\"]', 2, 2, '2022-01-31 01:43:41', '2022-01-31 01:43:41', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `edu_student_exams`
--

CREATE TABLE `edu_student_exams` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `exam_config_id` int(11) NOT NULL COMMENT 'pk= edu_exam_configs.id',
  `student_id` int(11) NOT NULL COMMENT 'pk= users.id',
  `exam_duration` int(11) NOT NULL COMMENT 'in minute',
  `taken_duration` int(11) NOT NULL COMMENT 'in strtoTime',
  `total_questions` int(11) NOT NULL,
  `total_answer` int(11) NOT NULL,
  `total_correct_answer` int(11) NOT NULL,
  `per_question_mark` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `edu_student_exams`
--

INSERT INTO `edu_student_exams` (`id`, `exam_config_id`, `student_id`, `exam_duration`, `taken_duration`, `total_questions`, `total_answer`, `total_correct_answer`, `per_question_mark`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 2, 10, 9, 2, 2, 1, 2, '2022-01-31 02:57:39', '2022-01-31 02:57:39', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `edu_student_exam_questions`
--

CREATE TABLE `edu_student_exam_questions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_exam_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL COMMENT 'pk = users.id',
  `answer` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'serialized array, pk = edu_answers.id',
  `answered` int(11) NOT NULL COMMENT '1=yes,0=no',
  `corrected` int(11) NOT NULL COMMENT '1=yes,0=no',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `edu_student_exam_questions`
--

INSERT INTO `edu_student_exam_questions` (`id`, `student_exam_id`, `question_id`, `student_id`, `answer`, `answered`, `corrected`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 2, 'a:1:{i:0;s:1:\"2\";}', 1, 0, '2022-01-31 02:57:39', '2022-01-31 02:57:39', NULL),
(2, 1, 2, 2, 'a:1:{i:0;s:1:\"8\";}', 1, 1, '2022-01-31 02:57:39', '2022-01-31 02:57:39', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(7, '2014_10_12_000000_create_users_table', 1),
(8, '2014_10_12_100000_create_password_resets_table', 1),
(9, '2019_08_19_000000_create_failed_jobs_table', 1),
(10, '2020_04_18_064342_create_admins_table', 1),
(11, '2020_04_18_064407_create_moderators_table', 1),
(12, '2021_12_25_122916_create_user_blogs_table', 1),
(13, '2021_12_26_170603_create_user_comments_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `moderators`
--

CREATE TABLE `moderators` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo_original_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo_size` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo_extention` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_editor` tinyint(1) NOT NULL DEFAULT 1,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `moderators`
--

INSERT INTO `moderators` (`id`, `name`, `email`, `password`, `photo_name`, `photo_original_name`, `photo_size`, `photo_extention`, `is_editor`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'moderator up', 'moderator@gmail.com', '$2y$10$sZvlTNeeMY/OJi8HYQL5uOOWf/NnnUDatIDZJREEPC9Zyodbgt5MS', '0_1640626988.jpeg', 'hero_1.jpg', '474253', 'jpeg', 1, NULL, '2021-12-27 15:34:41', '2021-12-27 11:43:08');

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
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `userName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo_original_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo_size` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo_extention` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `userName`, `email`, `email_verified_at`, `password`, `photo_name`, `photo_original_name`, `photo_size`, `photo_extention`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Rafikul Islam', 'rafikul', 'rafikul@gmail.com', NULL, '$2y$10$n.GNlLGTPBYAqHBIdzBfLOty82tqU4SpA9BTvvoLE1JDkD.KtI3eK', '0_1640609367.jpeg', 'person_5.jpg', '86756', 'jpeg', NULL, '2021-12-26 11:10:09', '2021-12-27 06:50:30'),
(2, 'anas', 'anas', 'anasfpi@gmail.com', NULL, '$2y$10$zjuFO1wbT1dzfx2J3g1dGO9qahSR5PHRxs9jCUZ7IXwNF8fK1YVKO', '0_1640538643.jpeg', 'person_3.jpg', '61697', 'jpeg', NULL, '2021-12-26 11:10:43', '2021-12-26 11:10:43');

-- --------------------------------------------------------

--
-- Table structure for table `user_blogs`
--

CREATE TABLE `user_blogs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `gen_user_id` int(11) NOT NULL,
  `blog_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `blog_description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo_original_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo_size` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo_extention` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `valid` tinyint(4) NOT NULL COMMENT '1=Yes, 0=No'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_blogs`
--

INSERT INTO `user_blogs` (`id`, `gen_user_id`, `blog_title`, `blog_description`, `photo_name`, `photo_original_name`, `photo_size`, `photo_extention`, `created_by`, `created_at`, `updated_at`, `deleted_at`, `valid`) VALUES
(1, 2, 'the update', '<p style=\"text-align: center;\"><font color=\"#808080\"><span style=\"font-size: 15px;\">the update desc</span></font></p>', '2_1640702580.jpeg', 'person_5.jpg', '86756', 'jpeg', 2, '2021-12-26 11:11:28', '2021-12-28 08:43:10', '2021-12-28 08:43:10', 0),
(2, 2, 'The AI magically up', '<p style=\"text-align: center; \"><font color=\"#808080\"><span style=\"font-size: 15px;\">the all magical up desc</span></font></p>', '0_1640705912.jpeg', 'img_4.jpg', '46842', 'jpeg', 2, '2021-12-26 11:11:44', '2021-12-28 09:39:03', '2021-12-28 09:39:03', 0),
(3, 2, 'The AI magically removes moving objects from videos.', '<p><span style=\"color: rgb(128, 128, 128); font-size: 15px; text-align: center;\">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Exercitationem facilis sunt repellendus excepturi beatae porro debitis voluptate nulla quo veniam fuga sit molestias minus.&nbsp;</span><span style=\"color: rgb(128, 128, 128); font-size: 15px; text-align: center;\">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Exercitationem facilis sunt repellendus excepturi beatae porro debitis voluptate nulla quo veniam.&nbsp;</span><span style=\"color: rgb(128, 128, 128); font-size: 15px; text-align: center;\">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Exercitationem facilis sunt repellendus excepturi beatae porro debitis voluptate nulla quo veniam fuga sit molestias minus.&nbsp;</span><span style=\"color: rgb(128, 128, 128); font-size: 15px; text-align: center;\">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Exercitationem facilis sunt repellendus excepturi beatae porro debitis voluptate nulla quo veniam</span><br></p>', '0_1640538727.jpeg', 'img_v_1.jpg', '157422', 'jpeg', 2, '2021-12-26 11:12:08', '2021-12-26 11:12:08', NULL, 1),
(4, 1, 'The AI magically removes moving objects from videos.', '<p><span style=\"color: rgb(128, 128, 128); font-size: 15px; text-align: center;\">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Exercitationem facilis sunt repellendus excepturi beatae porro debitis voluptate nulla quo veniam fuga sit molestias minus.&nbsp;</span><span style=\"color: rgb(128, 128, 128); font-size: 15px; text-align: center;\">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Exercitationem facilis sunt repellendus excepturi beatae porro debitis voluptate nulla quo veniam&nbsp;</span><span style=\"color: rgb(128, 128, 128); font-size: 15px; text-align: center;\">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Exercitationem facilis sunt repellendus excepturi beatae porro debitis voluptate nulla quo veniam fuga sit molestias minus.&nbsp;</span><span style=\"color: rgb(128, 128, 128); font-size: 15px; text-align: center;\">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Exercitationem facilis sunt repellendus excepturi beatae porro debitis voluptate nulla quo veniam</span><br></p>', '0_1640538765.jpeg', 'img_3.jpg', '58809', 'jpeg', 1, '2021-12-26 11:12:45', '2021-12-26 11:12:45', NULL, 1),
(5, 1, 'The AI magically removes moving objects from videos.', '<p><span style=\"color: rgb(128, 128, 128); font-size: 15px; text-align: center;\">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Exercitationem facilis sunt repellendus excepturi beatae porro debitis voluptate nulla quo veniam fuga sit molestias minus.&nbsp;</span><span style=\"color: rgb(128, 128, 128); font-size: 15px; text-align: center;\">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Exercitationem facilis sunt repellendus excepturi beatae porro debitis voluptate nulla quo veniam&nbsp;</span><span style=\"color: rgb(128, 128, 128); font-size: 15px; text-align: center;\">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Exercitationem facilis sunt repellendus excepturi beatae porro debitis voluptate nulla quo veniam fuga sit molestias minus.&nbsp;</span><span style=\"color: rgb(128, 128, 128); font-size: 15px; text-align: center;\">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Exercitationem facilis sunt repellendus excepturi beatae porro debitis voluptate nulla quo veniam</span><br></p>', '0_1640538782.jpeg', 'img_4.jpg', '46842', 'jpeg', 1, '2021-12-26 11:13:02', '2021-12-26 11:13:02', NULL, 1),
(6, 2, 'The AI magically removes moving objects from videos.', '<p><span style=\"font-size: 1rem;\">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Exercitationem facilis sunt repellendus excepturi beatae porro debitis&nbsp;</span><br></p><p>voluptate nulla quo veniam fuga sit molestias minus. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Exercitationem facilis&nbsp;</p><p>sunt repellendus excepturi beatae porro debitis voluptate nulla quo veniam. Lorem ipsum dolor sit amet, consectetur adipisicing elit.&nbsp;</p><p>Exercitationem facilis sunt repellendus excepturi beatae porro debitis voluptate nulla quo veniam fuga sit molestias minus. Lorem ipsum dolor sit amet,&nbsp;</p><p>consectetur adipisicing elit. Exercitationem facilis sunt repellendus excepturi beatae porro debitis voluptate nulla quo veniam</p>', '0_1640699388.jpeg', 'hero_1.jpg', '474253', 'jpeg', 2, '2021-12-28 07:49:49', '2021-12-28 07:49:59', NULL, 1),
(7, 2, 'The AI magically removes moving objects from videos.', '<p><span style=\"font-size: 1rem;\">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Exercitationem facilis sunt repellendus excepturi beatae porro debitis&nbsp;</span><span style=\"font-size: 1rem;\">vouptate nulla quo veniam fuga sit molestias minus. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Exercitationem facilis&nbsp;</span><span style=\"font-size: 1rem;\">sunt repellendus excepturi beatae porro debitis voluptate nulla quo veniam. Lorem ipsum dolor sit amet, consectetur adipisicing elit.&nbsp;</span><span style=\"font-size: 1rem;\">Exercitationem facilis sunt repellendus excepturi beatae porro debitis voluptate nulla quo veniam fuga sit molestias minus. Lorem ipsum dolor sit amet,&nbsp;</span></p><p>consectetur adipisicing elit. Exercitationem facilis sunt repellendus excepturi beatae porro debitis voluptate nulla quo veniam</p>', '0_1640699427.jpeg', 'img_4.jpg', '46842', 'jpeg', 2, '2021-12-28 07:50:27', '2021-12-28 07:50:27', NULL, 1),
(8, 2, 'The AI magically removes moving objects from videos.', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Exercitationem facilis sunt repellendus excepturi beatae porro debitis&nbsp;</p><p>voluptate nulla quo veniam fuga sit molestias minus. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Exercitationem facilis&nbsp;</p><p>sunt repellendus excepturi beatae porro debitis voluptate nulla quo veniam. Lorem ipsum dolor sit amet, consectetur adipisicing elit.&nbsp;</p><p>Exercitationem facilis sunt repellendus excepturi beatae porro debitis voluptate nulla quo veniam fuga sit molestias minus. Lorem ipsum dolor sit amet,&nbsp;</p><p>consectetur adipisicing elit. Exercitationem facilis sunt repellendus excepturi beatae porro debitis voluptate nulla quo veniam</p>', '0_1640699446.jpeg', 'img_v_2.jpg', '155975', 'jpeg', 2, '2021-12-28 07:50:47', '2021-12-28 07:50:47', NULL, 1),
(9, 2, 'The AI magically removes moving objects from videos.', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Exercitationem facilis sunt repellendus excepturi beatae porro debitis&nbsp;</p><p>voluptate nulla quo veniam fuga sit molestias minus. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Exercitationem facilis&nbsp;</p><p>sunt repellendus excepturi beatae porro debitis voluptate nulla quo veniam. Lorem ipsum dolor sit amet, consectetur adipisicing elit.&nbsp;</p><p>Exercitationem facilis sunt repellendus excepturi beatae porro debitis voluptate nulla quo veniam fuga sit molestias minus. Lorem ipsum dolor sit amet,&nbsp;</p><p>consectetur adipisicing elit. Exercitationem facilis sunt repellendus excepturi beatae porro debitis voluptate nulla quo veniam</p>', '0_1640699463.jpeg', 'img_1.jpg', '37856', 'jpeg', 2, '2021-12-28 07:51:03', '2021-12-28 07:51:03', NULL, 1),
(10, 2, 'The AI magically removes moving objects from videos.', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Exercitationem facilis sunt repellendus excepturi beatae porro debitis&nbsp;</p><p>voluptate nulla quo veniam fuga sit molestias minus. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Exercitationem facilis&nbsp;</p><p>sunt repellendus excepturi beatae porro debitis voluptate nulla quo veniam. Lorem ipsum dolor sit amet, consectetur adipisicing elit.&nbsp;</p><p>Exercitationem facilis sunt repellendus excepturi beatae porro debitis voluptate nulla quo veniam fuga sit molestias minus. Lorem ipsum dolor sit amet,&nbsp;</p><p>consectetur adipisicing elit. Exercitationem facilis sunt repellendus excepturi beatae porro debitis voluptate nulla quo veniam</p>', '0_1640699479.jpeg', 'person_5.jpg', '86756', 'jpeg', 2, '2021-12-28 07:51:19', '2021-12-28 07:51:19', NULL, 1),
(11, 2, 'The AI magically removes moving objects from videos.', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Exercitationem facilis sunt repellendus excepturi beatae porro debitis&nbsp;</p><p>voluptate nulla quo veniam fuga sit molestias minus. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Exercitationem facilis&nbsp;</p><p>sunt repellendus excepturi beatae porro debitis voluptate nulla quo veniam. Lorem ipsum dolor sit amet, consectetur adipisicing elit.&nbsp;</p><p>Exercitationem facilis sunt repellendus excepturi beatae porro debitis voluptate nulla quo veniam fuga sit molestias minus. Lorem ipsum dolor sit amet,&nbsp;</p><p>consectetur adipisicing elit. Exercitationem facilis sunt repellendus excepturi beatae porro debitis voluptate nulla quo veniam</p>', '0_1640699491.jpeg', 'person_4.jpg', '86756', 'jpeg', 2, '2021-12-28 07:51:32', '2021-12-28 07:51:32', NULL, 1),
(12, 2, 'The AI magically removes moving objects from videos.', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Exercitationem facilis sunt repellendus excepturi beatae porro debitis&nbsp;</p><p>voluptate nulla quo veniam fuga sit molestias minus. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Exercitationem facilis&nbsp;</p><p>sunt repellendus excepturi beatae porro debitis voluptate nulla quo veniam. Lorem ipsum dolor sit amet, consectetur adipisicing elit</p>', '0_1640699508.jpeg', 'person_1.jpg', '76764', 'jpeg', 2, '2021-12-28 07:51:48', '2021-12-28 07:51:48', NULL, 1),
(13, 2, 'The AI magically removes moving objects from videos.', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Exercitationem facilis sunt repellendus excepturi beatae porro debitis&nbsp;</p><p>voluptate nulla quo veniam fuga sit molestias minus. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Exercitationem facilis&nbsp;</p><p>sunt repellendus excepturi beatae porro debitis voluptate nulla quo veniam. Lorem ipsum dolor sit amet, consectetur adipisicing elit</p>', '0_1640699527.jpeg', 'person_3.jpg', '61697', 'jpeg', 2, '2021-12-28 07:52:08', '2021-12-28 07:52:08', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_comments`
--

CREATE TABLE `user_comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `blog_id` int(11) NOT NULL,
  `gen_user_id` int(11) NOT NULL,
  `comment` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `valid` tinyint(4) NOT NULL COMMENT '1=Yes, 0=No'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_comments`
--

INSERT INTO `user_comments` (`id`, `blog_id`, `gen_user_id`, `comment`, `status`, `created_by`, `created_at`, `updated_at`, `deleted_at`, `valid`) VALUES
(1, 5, 1, 'ss mod update', 1, 1, '2021-12-26 11:51:40', '2021-12-28 09:45:37', '2021-12-28 09:45:37', 0),
(2, 5, 2, 'ok it\'s fine', 1, 2, '2021-12-26 11:52:53', '2021-12-26 11:52:53', NULL, 1),
(3, 3, 2, 'hello all up', 1, 2, '2021-12-27 06:56:40', '2021-12-28 09:21:29', NULL, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `edu_answers`
--
ALTER TABLE `edu_answers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `edu_answer_types`
--
ALTER TABLE `edu_answer_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `edu_archive_questions`
--
ALTER TABLE `edu_archive_questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `edu_exam_configs`
--
ALTER TABLE `edu_exam_configs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `edu_student_exams`
--
ALTER TABLE `edu_student_exams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `edu_student_exam_questions`
--
ALTER TABLE `edu_student_exam_questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `moderators`
--
ALTER TABLE `moderators`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `moderators_email_unique` (`email`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_blogs`
--
ALTER TABLE `user_blogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_comments`
--
ALTER TABLE `user_comments`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `edu_answers`
--
ALTER TABLE `edu_answers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `edu_answer_types`
--
ALTER TABLE `edu_answer_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `edu_archive_questions`
--
ALTER TABLE `edu_archive_questions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `edu_exam_configs`
--
ALTER TABLE `edu_exam_configs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `edu_student_exams`
--
ALTER TABLE `edu_student_exams`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `edu_student_exam_questions`
--
ALTER TABLE `edu_student_exam_questions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `moderators`
--
ALTER TABLE `moderators`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_blogs`
--
ALTER TABLE `user_blogs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `user_comments`
--
ALTER TABLE `user_comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
