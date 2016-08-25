-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 25, 2016 at 05:50 PM
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
(20160825212600);

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
(1, 'Lớp chuẩn', '10-15 học sinh/lớp', 'upload/avatar/67a49517d23f407c1e1d2e46a4c503db.jpg', 'Lớp này là rẻ nhất', '100.000đ/buổi', '2016-08-09 15:39:38'),
(2, 'Lớp đảm bảo', '6 học sinh/lớp', 'upload/avatar/0c90026b54cdda4dca364d3d72c7c4bf.jpg', 'Lớp này thì ngon hơn', '150.000đ/buổi', '2016-08-09 15:40:13'),
(3, 'Lớp chuyên sâu', '3 học sinh/lớp', 'upload/avatar/a5b6b6a71757cf2102a9e4a176808ec9.jpg', 'Lớp này toàn pro thôi', '250.000đ/buổi', '2016-08-09 15:40:50'),
(4, 'Lớp 1-1', '1 giáo viên kèm 1 học sinh', 'upload/avatar/be8fa8fa165ab8f7110a037f64f6683a.jpg', 'Lớp này thì khỏi bàn', '500.00đ/buổi', '2016-08-09 15:41:26');

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
(1, 'Ảnh bìa giới thiệu đầu tiên', 'Đây là cái ảnh đầu tiên trên cùng của trang', 'upload/image/eca8366027e88601b7c4c441ddb8646d.jpg', 'test phát 1', '2016-08-03 14:53:07'),
(2, 'Ảnh đại diện phương pháp học 1', 'Đây là cái ảnh đại diện cho phương pháp học đầu tiên.', 'upload/image/41d3678f475963532f31b54908701b7c.jpg', 'đến chịu', '2016-08-03 14:56:19'),
(3, 'Ảnh đại diện phương pháp học 2', 'Đây là cái ảnh đại diện cho phương pháp học thứ 2.', 'upload/image/05549a47375a7438e7d9eec85e751320.jpg', 'test tiếp', '2016-08-03 14:58:04'),
(4, 'Ảnh đại diện phương pháp học 3', 'Đây là cái ảnh đại diện cho phương pháp học thứ 3.', 'upload/image/fddd4bfe77063a2637b1ac12b27f684a.jpg', '', '2016-08-03 14:58:42'),
(5, 'Ảnh đại diện phương pháp học 4', 'Đây là cái ảnh đại diện cho phương pháp học thứ 4.', 'upload/image/70f7d62ac9373f9c66715313912903bb.jpg', '', '2016-08-03 14:59:04'),
(6, 'Ảnh nền phương pháp học', 'Đây là cái ảnh nền thứ 2 trong trang', 'upload/image/c3cc724631e7927a0b01353c9f150596.jpg', '', '2016-08-09 16:04:46'),
(7, 'Ảnh nền thư viện', 'Đây là cái ảnh nền thứ 3 trong trang', 'upload/image/db45507bec51ae1337ae94519e58e8f2.jpg', '', '2016-08-09 16:05:09'),
(8, 'Ảnh nền trang Beedu-detail', 'Đây là cái ảnh ở giữa của trang chi tiết', 'upload/image/5b4138548f976cdb1a6a685867d94b0c.jpg', '', '2016-08-11 03:03:26'),
(9, 'Ảnh ở giữa trang giới thiệu', 'Ảnh ở giữa trang giới thiệu, nằm ở giữa 2 đoạn văn', 'upload/image/9a4cc6b1fdbb87ae76e73209d7c8f6dd.jpg', '', '2016-08-25 15:00:41');

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
-- Table structure for table `learning_method`
--

CREATE TABLE `learning_method` (
  `id` int(9) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(2550) NOT NULL,
  `note` varchar(255) NOT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `learning_method`
--

INSERT INTO `learning_method` (`id`, `avatar`, `title`, `description`, `note`, `created_on`) VALUES
(1, 'upload/avatar/400e869eda2865b9d39ea483d8f586d8.jpg', 'Nội dung chi tiết cho phương pháp học 1', 'miunh đại ka', 'có gì đâu mà note', '2016-08-25 14:46:01'),
(2, 'upload/avatar/37709de9e2ef24be4283c3190fd99b90.jpg', 'Nội dung chi tiết cho phương pháp học 2', 'miunh đại ka phats 2', 'có gì đâu mà note', '2016-08-25 14:46:41'),
(3, 'upload/avatar/88c24fb1ade78d6c5bf9f974cb1596ae.jpg', 'Nội dung chi tiết cho phương pháp học 3', 'miunh đại ka phats 3', 'có gì đâu mà note', '2016-08-25 14:46:47'),
(4, 'upload/avatar/de3dea0f6b2136d5558cd1a86e1b7341.jpg', 'Nội dung chi tiết cho phương pháp học 4', 'miunh đại ka phats 4', 'có gì đâu mà note', '2016-08-25 14:46:54');

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
  `module` int(11) DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `system_configs`
--

INSERT INTO `system_configs` (`id`, `name`, `value`, `module`, `created_on`) VALUES
(1, 'Màu nền', 'red', NULL, '2016-07-29 14:07:00'),
(2, 'Menu 1', 'Giá trị', 0, '2016-07-29 14:10:01'),
(3, 'Menu 2', 'Chương trình học', 0, '2016-07-29 14:10:29'),
(4, 'Menu 3', 'Thư viện', 0, '2016-07-29 14:10:42'),
(5, 'Menu 4', 'Hỏi đáp', 0, '2016-07-29 14:10:51'),
(6, 'Menu 5', 'Giới thiệu', 0, '2016-07-29 14:11:07'),
(7, 'Câu giới thiệu', 'Phát minh lại Dạy học', 4, '2016-07-29 14:11:57'),
(8, 'Phương pháp học 1', 'Thói quen tự học', 2, '2016-07-29 14:15:11'),
(9, 'Phương pháp học 2', 'Giáo dục từng cá nhân', 2, '2016-07-29 14:17:27'),
(10, 'Phương pháp học 3', 'Giáo trình phù hợp', 2, '2016-07-29 14:17:44'),
(11, 'Phương pháp học 4', 'Giáo viên nhiệt huyết', 2, '2016-07-29 14:17:59'),
(12, 'Nội dung phương pháp học 1', 'Beedu nêu bật tầm quan trọng của việc tự học và việc khuyến khích học sinh tự tìm tòi cách giải cho các bài tập đó', 2, '2016-07-29 14:19:01'),
(13, 'Nội dung phương pháp học 2', 'Phương pháp giáo dục hướng cá nhân của Beedu giúp mỗi học sinh được học ở một trình độ phù hợp nhất với khả năng của từng em.', 2, '2016-07-29 14:19:15'),
(14, 'Nội dung phương pháp học 3', 'Giáo trình BEEDU cho phép học sinh tiến bộ bằng chính khả năng của mình.', 2, '2016-07-29 14:19:27'),
(15, 'Nội dung phương pháp học 4', 'Vai trò của Giáo viên BEEDU là phát triển tối đa tiềm năng của từng học sinh.', 2, '2016-07-29 14:19:41'),
(16, 'giới thiệu về Beedu', 'Beedu trung tâm đào tạo từ xa vào bậc nhất của VN. Môi trường năng động sáng tạo sẽ giúp các bạn phát triển và trau dồi kiến thức. Tại Beedu, các bạn học tập được các kỹ năng tự học, kiểm tra kiến thức một cách chủ động nhất, hãy tự học thay vì chờ đợi hướng từ giáo viên một cách thụ động. Thông qua các kiến thức theo từng bước nhỏ, các bạn sẽ tự tin hơn khi đối mặt với những vấn đề khiến các bạn trước đây phải bối rối. Khi các bạn đăng ký học tại Beedu, bản thân các bạn sẽ được rèn luyện tự thay đổi bản thân, không theo những lối mòn trước kia đã kéo lùi khả năng tư duy của bạn.', 1, '2016-08-01 14:46:28'),
(17, 'Địa chỉ liên hệ', 'Tầng 8, Tòa nhà Sông Hồng Land, 165 Thái Hà, Đống Đa, Hà Nội', 1, '2016-08-06 09:34:55'),
(18, 'Số điện thoại liên hệ', '01674 077049', 1, '2016-08-06 09:35:27'),
(19, 'Email liên hệ', 'support_miu@beedu.vn', 1, '2016-08-06 09:35:45'),
(20, 'Link facebook ở dưới cuối trang', 'https://www.facebook.com/miu.hac.3', 1, '2016-08-11 02:27:37'),
(21, 'Link youtube của fanpage', 'https://www.youtube.com/channel/UCwppdrjsBPAZg5_cUwQjfMQ', 1, '2016-08-11 02:28:14'),
(22, 'Link google +', 'https://plus.google.com/u/0/102468796914763030485/about/p/pub', 1, '2016-08-11 02:29:19'),
(37, 'Tiêu đề', 'Thư ngỏ', 3, '2016-08-25 15:02:29'),
(38, 'Đoạn văn 1', 'Có 1 thứ gắn bó với cuộc sống của mỗi chúng ta còn nhiều hơn cả "gia đình" và "bạn đời", đó chính là "công việc". Còn điều gì kinh khủng hơn khi phải dành 8h-10h mỗi ngày để làm 1 công việc mà mình không yêu thích hoặc không thực sự phù hợp với sở trường của mình? "Công việc nào là phù hợp nhất với mình?" luôn là câu hỏi lớn với nhiều bạn trẻ. Và anh tin đó cũng là câu hỏi của em.  Ở tại Akira, anh đã chứng kiến: - Giám đốc vận hành từng nghĩ rằng mình chỉ có thể làm Salesman. - Giám đốc sản phẩm từng muốn vào làm chuyên viên nhân sự. - Trưởng phòng marketing từng xin làm chăm sóc học viên. - Phụ trách kinh doanh thì từng định làm phi công lái máy bay khi ra trường theo sự sắp xếp của gia đình. ... Đều là những người xuất sắc, nhưng trước đây các anh chị chưa từng nhận ra điều đó.', 3, '2016-08-25 15:02:43'),
(39, 'Đoạn văn 2', 'Có quá nhiều tài năng đang bị lãng phí ở khắp nơi, khi một người sinh ra để làm việc A nhưng lại cứ đâm đầu vào việc B. Tệ hơn là chính các bạn cũng không biết điều gì là tốt nhất với mình. Nhiều khi lờ mờ cảm nhận được nhưng cũng không biết liệu nếu mình thay đổi thì có thật sự tốt hơn ko, hay là sẽ lại rơi vào 1 cái C, D, E... còn tệ hơn cái B?  Albert Einstein từng nói: Nếu bạn đánh giá một con cá bằng khả năng leo cây thì cả đời (con cá đó) sẽ nghĩ rằng mình ngu ngốc.  Điều anh tự hào nhất ở Akira, đó là xây dựng được môi trường ở đó mọi người được làm đúng việc các bạn yêu thích và có năng khiếu. Chính vì vậy các nhân sự ở Akira tuy trẻ tuổi nhưng lại có thể làm được nhiều việc phi thường. Vice Director trẻ nhất khi nhận chức mới có 22 tuổi, Project Manager trẻ nhất mới 20 tuổi... Đơn giản là vì các bạn được làm đúng việc các bạn sinh ra để làm! Anh tin rằng ai cũng có tố chất để làm 1 việc gì đó phi thường hơn những người khác.  Vì vậy Akira đã xây dựng một chương trình Akira Manager Trainee (AMT), dành riêng cho những Leader tương lai của Akira. Trong chương trình huấn luyện đặc biệt này, các bạn sẽ được tìm hiểu xem bản thân mình phù hợp với công việc gì và được trực tiếp tham gia các nhiệm vụ thực tế để xem mình có thực sự phù hợp với công việc đó không. Chỉ có trải nghiệm thực tế trên một môi trường làm việc thực mới giúp em biết được mình thật sự phù hợp với công việc đó hay không. Anh và đội ngũ Leader sẽ trực tiếp làm việc, định hướng và hướng dẫn em qua từng công việc cụ thể.  Chính nhờ phương pháp này, những Leader của Akira đều tìm được công việc phù hợp với sở thích và thế mạnh của bản thân. Từ đó có sự phát triển vượt bậc về năng lực, thăng tiến ầm ầm về sự nghiệp. Và những con người xuất sắc góp phần làm nên một tổ chức phát triển mạnh mẽ. Và anh tin rằng em cũng có thể làm được điều như vậy! ', 3, '2016-08-25 15:02:57'),
(40, 'Link youtube giới thiệu', 'https://www.youtube.com/embed/1mHjMNZZvFo', 4, '2016-08-25 15:09:09');

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
(1, '127.0.0.1', 'administrator', 'Administrator', '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36', '', 'admin@admin.com', '', NULL, NULL, NULL, 1268889823, 1472135975, 1, 0),
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
-- Indexes for table `learning_method`
--
ALTER TABLE `learning_method`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `feedback_manages`
--
ALTER TABLE `feedback_manages`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `image_homes`
--
ALTER TABLE `image_homes`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
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
-- AUTO_INCREMENT for table `learning_method`
--
ALTER TABLE `learning_method`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
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
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
