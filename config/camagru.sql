-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 15, 2018 at 10:43 AM
-- Server version: 5.7.21
-- PHP Version: 7.1.15

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
(1, 'Le premier commentaire', '2018-05-15 00:00:00', 1, 11),
(2, 'sddsdgd  th b', '2018-05-16 00:00:00', 38, 11),
(3, 'dsfdsfdsf', '2018-05-15 18:46:24', 41, 11),
(4, 'ddddddd', '2018-05-15 18:46:43', 41, 11),
(5, 'dsfdsfdsf qqq', '2018-05-15 18:48:54', 41, 11),
(6, '<script>alert(\'lol\');</script>', '2018-05-15 18:49:13', 41, 11),
(7, '<h1>tets</h1>', '2018-05-15 18:49:29', 41, 11),
(8, 'dsfdsf', '2018-05-15 18:51:22', 41, 11),
(9, 'sdfd', '2018-05-15 18:51:40', 41, 11),
(10, 'dsfdsf', '2018-05-15 18:52:24', 41, 11),
(11, 'dsfdsf', '2018-05-15 18:52:35', 41, 11),
(12, 'sdfdfs', '2018-05-15 18:53:30', 41, 11),
(13, 'sdfdfsssss', '2018-05-15 18:53:38', 41, 11),
(14, 'sdfdfsssscxdsfs', '2018-05-15 18:54:01', 41, 11),
(15, 'sdfdsfq', '2018-05-15 18:54:08', 41, 11),
(16, 'dddd', '2018-05-15 18:54:40', 41, 11),
(17, 'dsfdsf', '2018-05-15 19:11:21', 41, 11),
(18, 'dddd', '2018-05-15 19:13:20', 41, 11),
(19, 'ssss', '2018-05-15 19:13:33', 41, 11),
(20, 'lol', '2018-05-15 19:13:50', 41, 11),
(21, '<script>alert(\'lol\');</script>', '2018-05-15 19:14:25', 41, 11),
(22, 'fsfds', '2018-05-15 19:23:17', 41, 11);

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
(1, 'le matin', '5ae22f5f3ee5fa481fde8155e1cd867c.png', '2018-05-15 09:55:07', 41),
(2, 'lol', '44c47fd1e0175d7bb3c812ed8e2e1e35.png', '2018-05-15 09:56:16', 41),
(3, 'lol', 'd440c93186ec8132b264dda5cf0014c3.png', '2018-05-15 09:56:33', 41),
(4, 'qqqqqqqq', '3cf52dabe9fb916f21ef1f5b089ed191.png', '2018-05-15 09:58:18', 41),
(5, 'qqqqqqqq', '543d42cb089e624bb445fcfa16436e6e.png', '2018-05-15 09:58:29', 41),
(6, 'dh hfgj  k g gjgfkyg', '3dbbb837213a5b3986daab717f47b5bf.png', '2018-05-15 09:59:43', 41),
(7, 'dh hfgj  k g gjgfkyg', '0884c0015dd848b395ed74d236aad59c.png', '2018-05-15 09:59:52', 41),
(8, 'ftyhfgfghhfg', 'b0d6953f88302cf2f3070d85a30dd358.png', '2018-05-15 10:21:33', 41),
(9, 'ftyhfgfghhfg', '9c1a52d4d58c54c961ad893214254151.png', '2018-05-15 10:21:46', 41),
(10, 'nggfg', 'a02d182fee04ddeaaa817da6c9129ed0.png', '2018-05-15 13:31:38', 41),
(11, 'dsfd', '2085423290a7fe9aa24eabd38f2e64bb.png', '2018-05-15 13:34:16', 41),
(12, 'vcxvcxvcx', '4bb1128907f1e24aee3a5895d053d2c0.png', '2018-05-15 13:35:13', 41),
(13, 'vcxvcxvcx', '7ca99895e73db7fd3a5599bc3be1c6fa.png', '2018-05-15 13:35:30', 41),
(14, 'plitvice', '265bec7ad612e01529ab5e25d396443e.png', '2018-05-15 13:40:33', 41),
(15, 'cdsds', '2d442e0638e697471c071a2dde5fece4.png', '2018-05-15 13:41:00', 41),
(16, 'fgffghgf', 'dc0849f5a873d9bc0b7590c25429a811.png', '2018-05-15 19:28:29', 41),
(17, 'fgffghgf', '178bc0ee45e24cdaf52c895a1f1c8c82.png', '2018-05-15 19:29:39', 41),
(18, 'Test d\'une photo avec un titre a rallonge !', '85266730dda20ba6f0787a62c660cd50.png', '2018-05-15 19:33:28', 41),
(19, 'Les photos ont l\'air ok', 'b11e4b799ee67973f78889b16cb18880.png', '2018-05-15 19:36:10', 41),
(20, 'ijdsijod . hidshdsh dvh <h1>ojpdsvojpd</h1>', '5a48bde66bf07d4717d74e07f33202bf.png', '2018-05-15 19:40:54', 41);

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
(35, 2);

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
  `role` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`, `verified`, `role`) VALUES
(1, 'unadmin', 'eric', '$2y$10$H9KFCEiCnJgFahAz1aXoHeaG/Y4Uv9La4/HF9t64eMQimlzDxAST.', '1fce34eaa761e14eg2c60f12fad32e9ce', 1),
(35, 'melissa', 'melissa@gmail.com', '$2y$10$mNxA/2iRujr5TDCS.36xDu5uM7.QnrKPvEoeCnw8Qus3mJc5nlj02', '1fce34eaa761e14e2c60f12fad32e9cefsdf', -1),
(36, '<script>alert(\'lol\')</script>', 'lol@gmail.com', '$2y$10$t7OKHgvfOEQ5RnZn54F2p.AFYMif/K4KL1ti4b.i2IZJgDeRP3Vue', '1fcse34eaa761e14e2c60f12fad32e9cessdf', -1),
(37, 'admin', 'admin@gmail.com', '$2y$10$RZKF7lum1lNHhHJJIJYIFuToamJvTkNsmR6NXcokqLSV4M9M2wm8S', '1fce34eaa761e14sde2c60f12fad32e9ce', -1),
(38, 'hello', 'hello@gmail.com', '$2y$10$D2r9SZZkQD/NIyjh7TLFkeOJ7/OHjZunZv9xNOR4IwCwGAW1/vrWO', '1fce34eaa761e14e2dc60f12fad32e9cexv', -1),
(39, 'eric', 'ericmerabet@gmail.com', '$2y$10$JLVnlvy7QQK.t5QpF4FVQ.GL5TBsLJzaUZf6uzUOzwev5XgbcjPqW', '1sdffce34eaa761e14e2c60f12fad32e9ce', 1),
(40, 'lllll', 'lollol@gmail.com', '$2y$10$HqUY3c0I9F7lkIqNfkkxnuST4cbE/VfpthA8pMwStCTd9VZzPvGBe', 'sffsdfdsfdgerb87485f4dv', -1),
(41, 'moi', 'moi@gmail.com', '$2y$10$khTp0AzVJWJfRYOkcQ4K2.ij9PtNhu/0uIGiRR1aaLl6xMGZUSzLm', '1560ec3fe7a95c96e71f2d48e0088969', 1),
(42, 'pseudo', 'eric.merabet@gmail.com', '$2y$10$mvHPI63Eft8Xegg4wDH/nu79eLEKW3.VIVEHdpvgXarX6KvCfacrC', 'e6704a77f7daee6a794fe93578aaa0c7', 1);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `photo`
--
ALTER TABLE `photo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

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
  ADD CONSTRAINT `fk_l_photo` FOREIGN KEY (`id_photo`) REFERENCES `photo` (`id`),
  ADD CONSTRAINT `fk_l_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
