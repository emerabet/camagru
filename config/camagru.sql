-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 08, 2018 at 04:16 PM
-- Server version: 5.7.23-0ubuntu0.18.04.1
-- PHP Version: 7.2.7-0ubuntu0.18.04.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `camagru`
--
CREATE DATABASE IF NOT EXISTS `camagru` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `camagru`;

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `content` text NOT NULL,
  `date_com` datetime NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_photo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id`, `content`, `date_com`, `id_user`, `id_photo`) VALUES
(30, 'gfhgf', '2018-07-12 16:46:59', 41, 35),
(31, 'q<sdfghjkl\n', '2018-08-02 16:33:02', 41, 45);

-- --------------------------------------------------------

--
-- Table structure for table `photo`
--

CREATE TABLE `photo` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `name` varchar(70) NOT NULL,
  `created` datetime NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `photo`
--

INSERT INTO `photo` (`id`, `title`, `name`, `created`, `id_user`) VALUES
(24, 'test d\'un autre titre', '00950c6b40f1d0848ced890e2329b3a7.png', '2018-05-19 17:09:58', 41),
(25, 'test d\'un autre titre', '6aba96ba4bb015f280f5f2542d1ee19d.png', '2018-05-19 17:10:14', 41),
(26, 'edrftgyhuj', '7a379ac2514dfb70f6f9a9895b410fbb.png', '2018-05-19 17:10:51', 41),
(27, 'edrftgyhuj', 'f3689448abd961b7a427a6732f029320.png', '2018-05-19 17:10:54', 41),
(28, 'edrftgyhuj', 'a105dfb954a3de3110b6c895084b1a42.png', '2018-05-19 17:10:58', 41),
(35, 'gbgbvbvggv', 'dfea8f588285a95abdec8948d6f435b2.png', '2018-07-12 16:19:26', 41),
(36, 'wsds fdsf', '9ed32663a1190c5a242332fb01a9e722.png', '2018-07-24 16:31:49', 41),
(37, 'nghh dgfdfd', '176afe2b4478e2b63522f015c02779b2.png', '2018-07-24 16:32:30', 41),
(38, 'nghh dgfdfdqqqqqqqqqqqqqqqqqq', 'd7f9e95ecda6ba38269819abebcc4967.png', '2018-07-24 16:33:06', 41),
(39, 'nghh dgfdfdqqqqqqqqqqqqqqqqqq', 'af7f987d9fe65d37a42e9b121fde6541.png', '2018-07-24 16:33:35', 41),
(40, 'bfdh kh', '9124aab1e71073955bfffb7484e766c3.png', '2018-07-24 16:35:19', 41),
(42, 'refhgffd', '6fb78a413a79ef72aaa26bb4906d3d9c.png', '2018-07-24 17:20:16', 41),
(43, 'uiguighuik', '6f2fcaeff33076ca8d2a41c674687121.png', '2018-08-02 16:32:25', 41),
(44, 'uiguighuik', '8e679e290f2474ff41555fa851f9b033.png', '2018-08-02 16:32:43', 41),
(45, 'uiguighuik', '6f7756fd70d1fddac1698fc966a42b7e.png', '2018-08-02 16:32:50', 41),
(47, 'hihuuu', '8e3fcf86cabf8fe676eae8a3cf0487b5.png', '2018-08-02 18:42:23', 41);

-- --------------------------------------------------------

--
-- Table structure for table `upvote`
--

CREATE TABLE `upvote` (
  `id_user` int(11) NOT NULL,
  `id_photo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `upvote`
--

INSERT INTO `upvote` (`id_user`, `id_photo`) VALUES
(41, 45);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `verified` varchar(255) NOT NULL,
  `role` tinyint(4) NOT NULL,
  `notif` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`, `verified`, `role`, `notif`) VALUES
(1, 'unadmin', 'eric', '$2y$10$H9KFCEiCnJgFahAz1aXoHeaG/Y4Uv9La4/HF9t64eMQimlzDxAST.', '1fce34eaa761e14eg2c60f12fad32e9ce', 1, 0),
(35, 'melissa', 'melissa@gmail.com', '$2y$10$mNxA/2iRujr5TDCS.36xDu5uM7.QnrKPvEoeCnw8Qus3mJc5nlj02', '1fce34eaa761e14e2c60f12fad32e9cefsdf', -1, 0),
(36, '<script>alert(\'lol\')</script>', 'lol@gmail.com', '$2y$10$t7OKHgvfOEQ5RnZn54F2p.AFYMif/K4KL1ti4b.i2IZJgDeRP3Vue', '1fcse34eaa761e14e2c60f12fad32e9cessdf', -1, 0),
(37, 'admin', 'admin@gmail.com', '$2y$10$RZKF7lum1lNHhHJJIJYIFuToamJvTkNsmR6NXcokqLSV4M9M2wm8S', '1fce34eaa761e14sde2c60f12fad32e9ce', -1, 0),
(38, 'hello', 'hello@gmail.com', '$2y$10$D2r9SZZkQD/NIyjh7TLFkeOJ7/OHjZunZv9xNOR4IwCwGAW1/vrWO', '1fce34eaa761e14e2dc60f12fad32e9cexv', -1, 0),
(39, 'eric', 'ericmerabet@gmail.com', '$2y$10$JLVnlvy7QQK.t5QpF4FVQ.GL5TBsLJzaUZf6uzUOzwev5XgbcjPqW', '1sdffce34eaa761e14e2c60f12fad32e9ce', 1, 0),
(40, 'lllll', 'lollol@gmail.com', '$2y$10$HqUY3c0I9F7lkIqNfkkxnuST4cbE/VfpthA8pMwStCTd9VZzPvGBe', 'sffsdfdsfdgerb87485f4dv', -1, 0),
(41, 'moi', 'moi@gmail.com', '$2y$10$khTp0AzVJWJfRYOkcQ4K2.ij9PtNhu/0uIGiRR1aaLl6xMGZUSzLm', '1560ec3fe7a95c96e71f2d48e0088969', 1, 0),
(42, 'pseudo', 'eric.merabet@gmail.com', '$2y$10$mvHPI63Eft8Xegg4wDH/nu79eLEKW3.VIVEHdpvgXarX6KvCfacrC', 'e6704a77f7daee6a794fe93578aaa0c7', 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_photo` (`id_photo`),
  ADD KEY `fk_user` (`id_user`);

--
-- Indexes for table `photo`
--
ALTER TABLE `photo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_photo_user` (`id_user`);

--
-- Indexes for table `upvote`
--
ALTER TABLE `upvote`
  ADD PRIMARY KEY (`id_user`,`id_photo`),
  ADD KEY `fk_l_photo` (`id_photo`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_email` (`email`),
  ADD UNIQUE KEY `unique_name` (`name`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `photo`
--
ALTER TABLE `photo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `fk_photo` FOREIGN KEY (`id_photo`) REFERENCES `photo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `photo`
--
ALTER TABLE `photo`
  ADD CONSTRAINT `fk_photo_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `upvote`
--
ALTER TABLE `upvote`
  ADD CONSTRAINT `fk_l_photo` FOREIGN KEY (`id_photo`) REFERENCES `photo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_l_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
