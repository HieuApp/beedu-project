-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 09, 2016 at 06:57 PM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 7.0.3

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

CREATE TABLE `categories` (
  `id` int(9) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `note` varchar(255) NOT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `note`, `created_on`) VALUES
(1, 'Toán 12', 'Nơi đây quy tụ tất cả tài liệu đỉnh cao của môn Toán 12', 'test', '2016-07-19 16:39:02'),
(2, 'Đề thi đại học', 'Chỗ này tuyển tập các đề thi đại học qua các năm', 'test ', '2016-07-19 16:39:22'),
(3, 'Đề thi học sinh giỏi', 'Chứa đựng tất cả các đề thi học sinh giỏi của các tỉnh thành trong cả nước', '', '2016-08-03 15:07:23'),
(4, 'Đề cương ôn tập', 'Tổng hợp đề cương ôn thi tốt nghiệp tất cả các môn qua tất cả các năm.', '', '2016-08-03 15:07:51'),
(5, 'Đề thi Toeic', 'Chỗ này dành cho thánh nào muốn lên trình tiếng anh quốc tế nhanh nhất', '', '2016-08-03 15:08:24');

-- --------------------------------------------------------

--
-- Table structure for table `ci_migrations`
--

CREATE TABLE `ci_migrations` (
  `version` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ci_migrations`
--

INSERT INTO `ci_migrations` (`version`) VALUES
(20160809223200);

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `id` int(9) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `detail` varchar(2550) NOT NULL,
  `price` varchar(255) NOT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`id`, `name`, `description`, `avatar`, `detail`, `price`, `created_on`) VALUES
(1, 'Lớp chuẩn', '10-15 học sinh/lớp', 'upload/avatar/ac3fd8b9e8dfc39f0fc782b802d786fa.jpg', 'Lớp này là rẻ nhất', '100.000đ/buổi', '2016-08-09 15:39:38'),
(2, 'Lớp đảm bảo', '6 học sinh/lớp', 'upload/avatar/50c09cbb508c44332c8c348f5db73f2f.jpg', 'Lớp này thì ngon hơn', '150.000đ/buổi', '2016-08-09 15:40:13'),
(3, 'Lớp chuyên sâu', '3 học sinh/lớp', 'upload/avatar/73e45b52088a9483b139e99253eff9cb.jpg', 'Lớp này toàn pro thôi', '250.000đ/buổi', '2016-08-09 15:40:50'),
(4, 'Lớp 1-1', '1 giáo viên kèm 1 học sinh', 'upload/avatar/2778c94d77bb9c6f9524073356554044.jpg', 'Lớp này thì khỏi bàn', '500.00đ/buổi', '2016-08-09 15:41:26');

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `id` int(9) NOT NULL,
  `name` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `description` varchar(2550) DEFAULT NULL,
  `file` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `count_downloaded` int(11) DEFAULT NULL,
  `note` varchar(255) NOT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`id`, `name`, `category_id`, `avatar`, `description`, `file`, `author`, `count_downloaded`, `note`, `created_on`) VALUES
(2, 'đề thi tốt nghiệp 2014', 2, 'upload/avatar/b8ad207845b57f7d17f110e19d661244.jpg', 'Cùng thử sức với bộ đề thi Đại học khối A môn Toán cực hay. Hãy thử sức mình bằng cách bắt tay làm thử những bài tập toán trong bộ đề thi đại học hay và bổ ích sau.', 'upload/file/63c38400a3b075f3a3e8ff098f13321b.docx', 'miunh', 222, '', '2016-08-01 14:43:02'),
(3, 'Tuyển tập đại số', 1, 'upload/avatar/c7d99d863e584553ab49c10f42e5caf2.jpg', 'Cùng thử sức với bộ đề thi Đại học khối A môn Toán cực hay. Hãy thử sức mình bằng cách bắt tay làm thử những bài tập toán trong bộ đề thi đại học hay và bổ ích sau.', 'upload/file/dfff3465aa9442c15dcecb444c181a1c.docx', 'HieuTT', 1234, '', '2016-08-03 15:05:41'),
(4, 'Tuyển tập đề thi Toán khối B', 2, 'upload/avatar/3b7b0c84916e568283221915f88b4e22.jpg', 'Cùng thử sức với bộ đề thi Đại học khối A môn Toán cực hay. Hãy thử sức mình bằng cách bắt tay làm thử những bài tập toán trong bộ đề thi đại học hay và bổ ích sau.', 'upload/file/180ac1e9a5ccf7fc1f0dbe68e14ae381.docx', 'miunh', 123, '', '2016-08-03 15:06:11'),
(5, 'Đề thi học sinh giỏi lớp 9 THPT chuyên HN', 3, 'upload/avatar/ec416699c02566963e49f6c871b12ce3.jpg', 'Tuyển tập các đề thi chọn đội tuyển của trường chuyên Hà Nam', 'upload/file/e11c24ea18a9f5aabe9660342f84aba0.docx', 'Mun', 134, '', '2016-08-06 09:25:50'),
(6, 'Đề thi giữa kì đại số', 1, 'upload/avatar/5637b9b41f2124e836076479e2153773.jpg', 'Đây là tài liệu thứ 2 của phần đề thi toán 12 môn đại số', 'upload/file/b93dd3d2ebe281834f75e4c10297cdf9.docx', 'HieuTT', 111, '', '2016-08-06 09:59:07');

-- --------------------------------------------------------

--
-- Table structure for table `feedback_manages`
--

CREATE TABLE `feedback_manages` (
  `id` int(9) NOT NULL,
  `email_reader` varchar(255) NOT NULL,
  `feedback_content` varchar(255) NOT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `feedback_manages`
--

INSERT INTO `feedback_manages` (`id`, `email_reader`, `feedback_content`, `created_on`) VALUES
(1, 'minh@hieu', 'đây là câu hỏi đầu tiên cảu em', '2016-08-03 16:01:19'),
(2, 'minh@hieu', 'đây là câu hỏi thứ 2 xem sao?', '2016-08-03 16:01:45'),
(3, 'mni@naa', 'test show alert', '2016-08-03 16:06:44'),
(4, 'q@q', 'thông báo 1 cái nào', '2016-08-03 16:07:26'),
(5, 'v@a', 'a', '2016-08-03 16:08:25'),
(6, 'q@q', 'lên thông báo đi mà', '2016-08-03 16:09:54'),
(7, 'q@q', 'lên thông báo đi mà', '2016-08-03 16:11:46'),
(8, 'm@n', 'cái dcm chứ', '2016-08-03 16:13:29'),
(9, 'm@n', 'cái dcm chứ', '2016-08-03 16:13:56'),
(10, 'm@n', 'cái dcm chứ', '2016-08-03 16:13:59'),
(11, 'm@n', 'cái dcm chứ aaaaaaaaaaaa', '2016-08-03 16:15:03');

-- --------------------------------------------------------

--
-- Table structure for table `image_homes`
--

CREATE TABLE `image_homes` (
  `id` int(9) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `file` varchar(255) NOT NULL,
  `note` varchar(255) NOT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `image_homes`
--

INSERT INTO `image_homes` (`id`, `title`, `description`, `file`, `note`, `created_on`) VALUES
(1, 'Ảnh bìa giới thiệu đầu tiên', 'Đây là cái ảnh đầu tiên trên cùng của trang', 'upload/image/5dfd39988e18ab48e165e7d2bbdc2739.jpg', 'test phát 1', '2016-08-03 14:53:07'),
(2, 'Ảnh đại diện phương pháp học 1', 'Đây là cái ảnh đại diện cho phương pháp học đầu tiên.', 'upload/image/41d3678f475963532f31b54908701b7c.jpg', 'đến chịu', '2016-08-03 14:56:19'),
(3, 'Ảnh đại diện phương pháp học 2', 'Đây là cái ảnh đại diện cho phương pháp học thứ 2.', 'upload/image/05549a47375a7438e7d9eec85e751320.jpg', 'test tiếp', '2016-08-03 14:58:04'),
(4, 'Ảnh đại diện phương pháp học 3', 'Đây là cái ảnh đại diện cho phương pháp học thứ 3.', 'upload/image/fddd4bfe77063a2637b1ac12b27f684a.jpg', '', '2016-08-03 14:58:42'),
(5, 'Ảnh đại diện phương pháp học 4', 'Đây là cái ảnh đại diện cho phương pháp học thứ 4.', 'upload/image/70f7d62ac9373f9c66715313912903bb.jpg', '', '2016-08-03 14:59:04'),
(6, 'Ảnh nền phương pháp học', 'Đây là cái ảnh nền thứ 2 trong trang', 'upload/image/cfe1d0621282ddd919abdb345433f68e.jpg', '', '2016-08-09 16:04:46'),
(7, 'Ảnh nền thư viện', 'Đây là cái ảnh nền thứ 3 trong trang', 'upload/image/7ad63846b14216a54a9b991f274ecbcb.jpg', '', '2016-08-09 16:05:09');

-- --------------------------------------------------------

--
-- Table structure for table `ion_groups`
--

CREATE TABLE `ion_groups` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  `deleted` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

CREATE TABLE `ion_login_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(15) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) UNSIGNED DEFAULT NULL,
  `deleted` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ion_users_groups`
--

CREATE TABLE `ion_users_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL,
  `deleted` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

CREATE TABLE `notifications` (
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

CREATE TABLE `questions` (
  `id` int(9) NOT NULL,
  `question` varchar(255) NOT NULL,
  `answer` mediumtext NOT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `question`, `answer`, `created_on`) VALUES
(1, 'Beedu cần thiết và dành cho những ai?', 'Beedu cần thiết và dành cho những ai?', '2016-07-29 14:04:22'),
(2, 'Beedu dạy học sinh học như thế nào?', 'Beedu là chương trình học dành cho học sinh ở mọi độ tuổi, mọi trình độ. Ngày càng có nhiều Phụ huynh cho trẻ theo học Beedu ngay từ lứa tuổi mầm non, với hy vọng xây dựng cho các em thói quen học tập hữu ích qua từng ngày học và giúp các em tự tin bước vào Lớp 1.', '2016-07-29 14:06:01'),
(3, 'Beedu dạy ở đâu?', 'Beedu là chương trình học dành cho học sinh ở mọi độ tuổi, mọi trình độ. Ngày càng có nhiều Phụ huynh cho trẻ theo học Beedu ngay từ lứa tuổi mầm non, với hy vọng xây dựng cho các em thói quen học tập hữu ích qua từng ngày học và giúp các em tự tin bước vào Lớp 1.', '2016-08-03 14:42:54'),
(4, 'Beedu có từ bao giờ?', 'Beedu là chương trình học dành cho học sinh ở mọi độ tuổi, mọi trình độ. Ngày càng có nhiều Phụ huynh cho trẻ theo học Beedu ngay từ lứa tuổi mầm non, với hy vọng xây dựng cho các em thói quen học tập hữu ích qua từng ngày học và giúp các em tự tin bước vào Lớp 1.', '2016-08-03 14:43:12');

-- --------------------------------------------------------

--
-- Table structure for table `system_configs`
--

CREATE TABLE `system_configs` (
  `id` int(9) NOT NULL,
  `name` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
(7, 'Câu giới thiệu', 'Thay đổi tư duy giáo dục của người Việt.', '2016-07-29 14:11:57'),
(8, 'Phương pháp học 1', 'Thói quen tự học', '2016-07-29 14:15:11'),
(9, 'Phương pháp học 2', 'Giáo dục từng cá nhân', '2016-07-29 14:17:27'),
(10, 'Phương pháp học 3', 'Giáo trình phù hợp', '2016-07-29 14:17:44'),
(11, 'Phương pháp học 4', 'Giáo viên nhiệt huyết', '2016-07-29 14:17:59'),
(12, 'Nội dung phương pháp học 1', 'Beedu nêu bật tầm quan trọng của việc tự học và việc khuyến khích học sinh tự tìm tòi cách giải cho các bài tập đó', '2016-07-29 14:19:01'),
(13, 'Nội dung phương pháp học 2', 'Phương pháp giáo dục hướng cá nhân của Beedu giúp mỗi học sinh được học ở một trình độ phù hợp nhất với khả năng của từng em.', '2016-07-29 14:19:15'),
(14, 'Nội dung phương pháp học 3', 'Giáo trình BEEDU cho phép học sinh tiến bộ bằng chính khả năng của mình.', '2016-07-29 14:19:27'),
(15, 'Nội dung phương pháp học 4', 'Vai trò của Giáo viên BEEDU là phát triển tối đa tiềm năng của từng học sinh.', '2016-07-29 14:19:41'),
(16, 'giới thiệu về Beedu', 'Beedu trung tâm đào tạo từ xa vào bậc nhất của VN. Môi trường năng động sáng tạo sẽ giúp các bạn phát triển và trau dồi kiến thức. Tại Beedu, các bạn học tập được các kỹ năng tự học, kiểm tra kiến thức một cách chủ động nhất, hãy tự học thay vì chờ đợi hướng từ giáo viên một cách thụ động. Thông qua các kiến thức theo từng bước nhỏ, các bạn sẽ tự tin hơn khi đối mặt với những vấn đề khiến các bạn trước đây phải bối rối. Khi các bạn đăng ký học tại Beedu, bản thân các bạn sẽ được rèn luyện tự thay đổi bản thân, không theo những lối mòn trước kia đã kéo lùi khả năng tư duy của bạn.', '2016-08-01 14:46:28'),
(17, 'Địa chỉ liên hệ', 'Tầng 8, Tòa nhà Sông Hồng Land, 165 Thái Hà, Đống Đa, Hà Nội', '2016-08-06 09:34:55'),
(18, 'Số điện thoại liên hệ', '01674 077049', '2016-08-06 09:35:27'),
(19, 'Email liên hệ', 'support_miu@beedu.vn', '2016-08-06 09:35:45');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `ip_address` varchar(16) NOT NULL,
  `username` varchar(100) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `password` varchar(80) NOT NULL,
  `salt` varchar(40) NOT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) UNSIGNED DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) UNSIGNED NOT NULL,
  `last_login` int(11) UNSIGNED DEFAULT NULL,
  `active` tinyint(1) UNSIGNED DEFAULT NULL,
  `deleted` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `name`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `deleted`) VALUES
(1, '127.0.0.1', 'administrator', 'Administrator', '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36', '', 'admin@admin.com', '', NULL, NULL, NULL, 1268889823, 1470756721, 1, 0),
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
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback_manages`
--
ALTER TABLE `feedback_manages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `image_homes`
--
ALTER TABLE `image_homes`
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
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `feedback_manages`
--
ALTER TABLE `feedback_manages`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `image_homes`
--
ALTER TABLE `image_homes`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `ion_groups`
--
ALTER TABLE `ion_groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `ion_login_attempts`
--
ALTER TABLE `ion_login_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ion_users_groups`
--
ALTER TABLE `ion_users_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `system_configs`
--
ALTER TABLE `system_configs`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
