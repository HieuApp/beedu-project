-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 11, 2016 at 05:18 AM
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
(7, 'Ảnh nền thư viện', 'Đây là cái ảnh nền thứ 3 trong trang', 'upload/image/7ad63846b14216a54a9b991f274ecbcb.jpg', '', '2016-08-09 16:05:09'),
(8, 'Ảnh nền trang Beedu-detail', 'Đây là cái ảnh ở giữa của trang chi tiết', 'upload/image/5b4138548f976cdb1a6a685867d94b0c.jpg', '', '2016-08-11 03:03:26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `image_homes`
--
ALTER TABLE `image_homes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `image_homes`
--
ALTER TABLE `image_homes`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
