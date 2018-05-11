-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 11, 2018 at 10:59 AM
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
-- Table structure for table `photo`
--

CREATE TABLE `photo` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `name` varchar(70) NOT NULL,
  `created` datetime NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
-- Indexes for table `photo`
--
ALTER TABLE `photo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_photo_user` (`id_user`);

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
-- AUTO_INCREMENT for table `photo`
--
ALTER TABLE `photo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `photo`
--
ALTER TABLE `photo`
  ADD CONSTRAINT `fk_photo_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
