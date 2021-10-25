-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 26, 2021 at 01:05 AM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `my_crudpro`
--

-- --------------------------------------------------------

--
-- Table structure for table `crud`
--

CREATE TABLE `crud` (
  `id` int(10) NOT NULL,
  `mymail` varchar(50) NOT NULL,
  `mytoken` varchar(50) NOT NULL,
  `name` varchar(20) NOT NULL,
  `email` text NOT NULL,
  `phone` varchar(10) NOT NULL,
  `photo` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `crud`
--

INSERT INTO `crud` (`id`, `mymail`, `mytoken`, `name`, `email`, `phone`, `photo`) VALUES
(1, 'mjjoe@newmail.com', '1616381ef1647a', 'input01', 'input01@gmail.com', '0799066377', 'MyRecords/images.png'),
(2, 'mjjoe@newmail.com', '1616381ef1647a', 'input02', 'input02@newmail.com', '0709060337', 'MyRecords/ice cube.jpg'),
(3, 'mjjoe@newmail.com', '1616381ef1647a', 'input03', 'input03@gmail.com', '0770366379', 'MyRecords/img_454245.png'),
(4, 'mjjoe@newmail.com', '1616381ef1647a', 'input04', 'input04@gmail.com', '0707066339', 'MyRecords/156_3710.jpg'),
(5, 'mjjoe@newmail.com', '1616381ef1647a', 'input05', 'input05@gmail.com', '0790066377', 'MyRecords/graphicstock-joe-word-on-red-keyboard-button_rP-Ya2Bdub_thumb.jpg'),
(6, 'mjjoe@newmail.com', '1616381ef1647a', 'input06', 'input06@newmail.com', '0729066370', 'MyRecords/nfs-poster-plo442-medium-original-imadzrfs3xzaggzc.jpeg'),

-- --------------------------------------------------------

--
-- Table structure for table `pwd_request`
--

CREATE TABLE `pwd_request` (
  `id` int(10) NOT NULL,
  `user_token` varchar(100) NOT NULL,
  `user_email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users_records`
--

CREATE TABLE `users_records` (
  `user_id` int(11) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `profile` text NOT NULL,
  `token` varchar(50) NOT NULL,
  `status` varchar(10) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_records`
--

INSERT INTO `users_records` (`user_id`, `fullname`, `username`, `email`, `password`, `profile`, `token`, `status`, `date_created`) VALUES
(1, 'Joeson Misiani', 'MJ Joe', 'mjjoe@newmail.com', '$2y$10$lyfBnl.zO1zEsP3kYrO4NeL7VlRpkkQaSv.R0ZDVVErbLie4snYkW', 'MyProfiles/616388a03c5924.76337341.jpg', '1616381ef1647a', 'Offline', '2021-10-11 00:14:39'),
(3, 'Keren Ruth', 'Deski', 'deski@newmail.com', '$2y$10$81ELksbtlfhKq05DEZxaT.Ihxe4LkD.2tBFgJLq.uS9JSGl1hCFU.', 'MyProfiles/61773045ace3f4.51654022.jpg', '161772fbe3c531', 'Offline', '2021-10-25 22:29:18');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `crud`
--
ALTER TABLE `crud`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pwd_request`
--
ALTER TABLE `pwd_request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_records`
--
ALTER TABLE `users_records`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `crud`
--
ALTER TABLE `crud`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `pwd_request`
--
ALTER TABLE `pwd_request`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users_records`
--
ALTER TABLE `users_records`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
