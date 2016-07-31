-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 30, 2016 at 08:34 PM
-- Server version: 5.6.26
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `beedu`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(9) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `note` varchar(255) NOT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `note`, `created_on`) VALUES
(1, 'toán 12', 'aaaa', 'test', '2016-07-19 16:39:02'),
(2, 'Tiếng anh', 'tiếng anh 12', 'test ', '2016-07-19 16:39:22');

-- --------------------------------------------------------

--
-- Table structure for table `ci_migrations`
--

CREATE TABLE IF NOT EXISTS `ci_migrations` (
  `version` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ci_migrations`
--

INSERT INTO `ci_migrations` (`version`) VALUES
(20160719234900);

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE IF NOT EXISTS `documents` (
  `id` int(9) NOT NULL,
  `name` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `file` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `note` varchar(255) NOT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`id`, `name`, `category_id`, `file`, `author`, `note`, `created_on`) VALUES
(1, 'test', 1, 'upload/demo/avatars/b4e5b813a2ce48abc95e05520293c489.pdf', 'miunh', 'test ', '2016-07-19 16:44:29');

-- --------------------------------------------------------

--
-- Table structure for table `ion_groups`
--

CREATE TABLE IF NOT EXISTS `ion_groups` (
  `id` mediumint(8) unsigned NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  `deleted` int(11) DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ion_groups`
--

INSERT INTO `ion_groups` (`id`, `name`, `description`, `deleted`) VALUES
(1, 'admin', 'Administrator', 0),
(2, 'corporation', 'Công ty', 0),
(3, 'ppc', 'PPC', 0),
(4, 'warehouse_manager', 'Quản lý kho', 0),
(5, 'quality_manager', 'Quản lý chất lượng', 0),
(6, 'producer', 'Sản xuất', 0);

-- --------------------------------------------------------

--
-- Table structure for table `ion_login_attempts`
--

CREATE TABLE IF NOT EXISTS `ion_login_attempts` (
  `id` int(11) unsigned NOT NULL,
  `ip_address` varchar(15) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) unsigned DEFAULT NULL,
  `deleted` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ion_users_groups`
--

CREATE TABLE IF NOT EXISTS `ion_users_groups` (
  `id` int(11) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  `deleted` int(11) DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ion_users_groups`
--

INSERT INTO `ion_users_groups` (`id`, `user_id`, `group_id`, `deleted`) VALUES
(1, 1, 1, 0),
(2, 2, 1, 0),
(3, 3, 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE IF NOT EXISTS `notifications` (
  `id` int(9) NOT NULL,
  `link_to_warning` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `content` varchar(255) NOT NULL,
  `count` int(11) NOT NULL,
  `user_receive_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE IF NOT EXISTS `questions` (
  `id` int(9) NOT NULL,
  `question` varchar(255) NOT NULL,
  `answer` varchar(255) NOT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `question`, `answer`, `created_on`) VALUES
(1, 'đây là cái gì', 'qưer', '2016-07-29 14:04:22'),
(2, 'minh hỏi đểu', 'thế thì kệ mịa mày', '2016-07-29 14:06:01');

-- --------------------------------------------------------

--
-- Table structure for table `system_configs`
--

CREATE TABLE IF NOT EXISTS `system_configs` (
  `id` int(9) NOT NULL,
  `name` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `system_configs`
--

INSERT INTO `system_configs` (`id`, `name`, `value`, `created_on`) VALUES
(1, 'Màu nền', 'red', '2016-07-29 14:07:00'),
(2, 'Menu 1', 'Phương pháp học Beedu', '2016-07-29 14:10:01'),
(3, 'Menu 2', 'Chương trình học', '2016-07-29 14:10:29'),
(4, 'Menu 3', 'Thư viện', '2016-07-29 14:10:42'),
(5, 'Menu 4', 'Hỏi đáp', '2016-07-29 14:10:51'),
(6, 'Menu 5', 'Giới thiệu', '2016-07-29 14:11:07'),
(7, 'Câu giới thiệu', 'Đây là trang web của Đại ka Miunh', '2016-07-29 14:11:57'),
(8, 'Phương pháp học 1', 'Thói quen tự học', '2016-07-29 14:15:11'),
(9, 'Phương pháp học 2', 'Giáo dục từng cá nhân', '2016-07-29 14:17:27'),
(10, 'Phương pháp học 3', 'Giáo trình phù hợp', '2016-07-29 14:17:44'),
(11, 'Phương pháp học 4', 'Giáo viên nhiệt huyết', '2016-07-29 14:17:59'),
(12, 'Nội dung phương pháp học 1', 'Beedu nêu bật tầm quan trọng của việc tự học và việc khuyến khích học sinh tự tìm tòi cách giải cho các bài tập đó', '2016-07-29 14:19:01'),
(13, 'Nội dung phương pháp học 2', 'Phương pháp giáo dục hướng cá nhân của Beedu giúp mỗi học sinh được học ở một trình độ phù hợp nhất với khả năng của từng em.', '2016-07-29 14:19:15'),
(14, 'Nội dung phương pháp học 3', 'Giáo trình BEEDU cho phép học sinh tiến bộ bằng chính khả năng của mình.', '2016-07-29 14:19:27'),
(15, 'Nội dung phương pháp học 4', 'Vai trò của Giáo viên BEEDU là phát triển tối đa tiềm năng của từng học sinh.', '2016-07-29 14:19:41');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` mediumint(8) unsigned NOT NULL,
  `ip_address` varchar(16) NOT NULL,
  `username` varchar(100) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `password` varchar(80) NOT NULL,
  `salt` varchar(40) NOT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) unsigned DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) unsigned NOT NULL,
  `last_login` int(11) unsigned DEFAULT NULL,
  `active` tinyint(1) unsigned DEFAULT NULL,
  `deleted` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `name`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `deleted`) VALUES
(1, '127.0.0.1', 'administrator', 'Administrator', '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36', '', 'admin@admin.com', '', NULL, NULL, NULL, 1268889823, 1469901533, 1, 0),
(2, '::1', '', 'hieuApp', '$2y$08$TFqMessWz.wP4gJ4YWwHxOFQib1RK6S0Mq2mHrjd0qrZl5qcDlr7W', '', 'hieuapp@gmail.com', NULL, NULL, NULL, NULL, 1468556677, NULL, 1, 0),
(3, '::1', '', 'a', '$2y$08$fP8Ko4wz9FAMDPSDfdzcnu2oMGRuQ9MOphrlt5YP2e5Vxvcuz5HCq', '', 'a@gmail.com', NULL, NULL, NULL, NULL, 1468556804, NULL, 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ion_groups`
--
ALTER TABLE `ion_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ion_login_attempts`
--
ALTER TABLE `ion_login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ion_users_groups`
--
ALTER TABLE `ion_users_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  ADD KEY `fk_users_groups_users1_idx` (`user_id`),
  ADD KEY `fk_users_groups_groups1_idx` (`group_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system_configs`
--
ALTER TABLE `system_configs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `ion_groups`
--
ALTER TABLE `ion_groups`
  MODIFY `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `ion_login_attempts`
--
ALTER TABLE `ion_login_attempts`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ion_users_groups`
--
ALTER TABLE `ion_users_groups`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `system_configs`
--
ALTER TABLE `system_configs`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
