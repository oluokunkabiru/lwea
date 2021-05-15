-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 15, 2021 at 06:47 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lwea`
--

-- --------------------------------------------------------

--
-- Table structure for table `addadmin`
--

CREATE TABLE `addadmin` (
  `id` int(11) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `phonenumber` varchar(50) NOT NULL,
  `admintype` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  `status` varchar(100) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `addadmin`
--

INSERT INTO `addadmin` (`id`, `firstname`, `lastname`, `username`, `phonenumber`, `admintype`, `password`, `status`, `date`) VALUES
(1, 'ifeoluwa', 'adio', 'ifeadmin', '08130966818', 'overall', '9e00186a5f401a388295f9bff77c97af', 'enable', '2021-04-17 12:05:05'),
(3, 'fabiyi opeyemi odunola', '', '', '08130966810', 'normal', '813f8ce580f276558ce9e5093468b1ab', 'enabled', '2021-05-15 15:11:10'),
(4, 'oluokun adesina', NULL, NULL, '123456', 'normal', 'dbd72ee0eb135f0eca4f9ecc969c2360', 'enabled', '2021-05-15 15:10:41');

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

CREATE TABLE `blog` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `user` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `blog_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `blog`
--

INSERT INTO `blog` (`id`, `title`, `image`, `user`, `content`, `blog_date`) VALUES
(1, 'Halleluyah', 'blogs/1619612078gallery-11.jpg', 'ife oluwa', '&lt;p&gt;Agbara olorun po&lt;/p&gt;', '2021-04-28 12:14:38'),
(2, 'Glory glory man united', 'pictures/children.jpg', 'Picture', '&lt;p&gt;ffu alkadakldjla &lt;br&gt;&lt;/p&gt;', '2021-05-15 15:03:39');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `catgories` varchar(100) NOT NULL,
  `reg_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `catgories`, `reg_date`) VALUES
(8, 'identity', '2021-03-25 17:38:17'),
(14, 'prophecy', '2021-04-17 12:17:19'),
(15, 'ooo', '2021-05-10 23:40:30');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `comment` text NOT NULL,
  `status` varchar(50) NOT NULL,
  `blog_id` int(11) NOT NULL,
  `comment_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id`, `name`, `email`, `comment`, `status`, `blog_id`, `comment_date`) VALUES
(4, 'Ifeoluwa Adio', 'adioifeoluwa@gmail.com', '&lt;p&gt;erer&lt;/p&gt;', 'disabled', 2, '2021-05-13 12:37:07'),
(5, 'ifeoluwa', 'ife@vb.coom', '&lt;p&gt;sffsafa&lt;/p&gt;', 'enabled', 2, '2021-05-15 15:20:21'),
(6, 'Ifeoluwa Adio', 'adten4u@hotmail.com', '&lt;p&gt;yuiuy&lt;/p&gt;', 'enabled', 2, '2021-05-15 15:20:19'),
(7, 'Ifeoluwa', 'ytytry', '&lt;p&gt;ewertet&lt;/p&gt;', 'enabled', 2, '2021-05-15 15:20:17'),
(10, 'Peace of God', 'ok@vb.com', '&lt;p&gt;Al-amidullilah&lt;br&gt;&lt;/p&gt;', 'enabled', 1, '2021-05-15 15:37:12'),
(11, 'yes i dey', 'ok@vb.com', '&lt;p&gt;good daye&lt;br&gt;&lt;/p&gt;', 'disabled', 1, '2021-05-15 15:48:55'),
(12, 'yes i dey', 'ok@vb.com', '&lt;p&gt;good daye&lt;br&gt;&lt;/p&gt;', 'disabled', 1, '2021-05-15 15:58:49'),
(13, 'yes i dey', 'ok@vb.com', '&lt;p&gt;good daye&lt;br&gt;&lt;/p&gt;', 'disabled', 1, '2021-05-15 15:59:57');

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `id` int(11) NOT NULL,
  `Title` varchar(100) NOT NULL,
  `Date` varchar(100) NOT NULL,
  `Venue` text NOT NULL,
  `About` text NOT NULL,
  `Pictures` varchar(100) NOT NULL,
  `reg_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`id`, `Title`, `Date`, `Venue`, `About`, `Pictures`, `reg_date`) VALUES
(3, 'God is Good', '2021-05-16', '58 Asiwaju Omidiran street, Osogbo Osun State.', '&lt;p&gt;hjghjghmkg&lt;/p&gt;', 'pictures/image_6.jpg', '2021-05-13 15:44:55');

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `id` int(11) NOT NULL,
  `pictures` varchar(150) NOT NULL,
  `category_id` int(11) NOT NULL,
  `reg_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`id`, `pictures`, `category_id`, `reg_date`) VALUES
(21, 'gallery/daddy_g.o.jpg', 7, '2021-05-13 16:06:32'),
(22, 'gallery/IMG-20210304-WA0030.jpg', 7, '2021-05-13 16:06:32'),
(23, 'gallery/IMG-20210308-WA0027.jpg', 7, '2021-05-13 16:06:32');

-- --------------------------------------------------------

--
-- Table structure for table `gallery_category`
--

CREATE TABLE `gallery_category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gallery_category`
--

INSERT INTO `gallery_category` (`id`, `name`, `date`) VALUES
(7, 'Church', '2021-05-13 16:06:02');

-- --------------------------------------------------------

--
-- Table structure for table `sermon`
--

CREATE TABLE `sermon` (
  `id` int(11) NOT NULL,
  `Topic` varchar(100) NOT NULL,
  `Categories` int(11) NOT NULL,
  `Link` text NOT NULL,
  `Comment` text NOT NULL,
  `Pictures` varchar(100) NOT NULL,
  `minister` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `sermonid` varchar(255) NOT NULL,
  `reg_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sermon`
--

INSERT INTO `sermon` (`id`, `Topic`, `Categories`, `Link`, `Comment`, `Pictures`, `minister`, `date`, `sermonid`, `reg_date`) VALUES
(12, 'Sermon 1', 8, 'Https://github.com', '&lt;p&gt;In God I trust and is messenger&lt;br&gt;&lt;/p&gt;', 'pictures/community-1.jpg', 'VB', '2021-05-15', '0', '2021-05-15 12:20:08'),
(14, 'good afternoon', 14, 'https://github.com', '&lt;p&gt;good afternoon bro ife&lt;br&gt;&lt;/p&gt;', 'pictures/1621081548community-1.jpg', 'good day', '2021-05-15', '12', '2021-05-15 12:25:48');

-- --------------------------------------------------------

--
-- Table structure for table `testimony`
--

CREATE TABLE `testimony` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `testimony` text NOT NULL,
  `picture` varchar(255) NOT NULL,
  `status` varchar(50) NOT NULL,
  `testimony_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `testimony`
--

INSERT INTO `testimony` (`id`, `name`, `testimony`, `picture`, `status`, `testimony_date`) VALUES
(17, 'adesina kabir oluokun', '&lt;p&gt;Im very appreciate God Almighty&lt;br&gt;&lt;/p&gt;', '', 'enabled', '2021-05-15 16:32:46'),
(18, 'Adesina kabir', '&lt;p&gt;I&apos;m very appreciate God Almighty and his messenger&lt;br&gt;&lt;/p&gt;', '', 'enabled', '2021-05-15 16:32:51');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addadmin`
--
ALTER TABLE `addadmin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `phonenumber` (`phonenumber`);

--
-- Indexes for table `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gallery_category`
--
ALTER TABLE `gallery_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sermon`
--
ALTER TABLE `sermon`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Categories` (`Categories`);

--
-- Indexes for table `testimony`
--
ALTER TABLE `testimony`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addadmin`
--
ALTER TABLE `addadmin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `blog`
--
ALTER TABLE `blog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `gallery_category`
--
ALTER TABLE `gallery_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `sermon`
--
ALTER TABLE `sermon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `testimony`
--
ALTER TABLE `testimony`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `sermon`
--
ALTER TABLE `sermon`
  ADD CONSTRAINT `sermon_ibfk_1` FOREIGN KEY (`Categories`) REFERENCES `categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
