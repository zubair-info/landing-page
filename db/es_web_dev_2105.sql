-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 27, 2021 at 08:17 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `es_web_dev_2105`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `number` varchar(255) NOT NULL,
  `date_of_birth` date DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `post_code` varchar(255) DEFAULT NULL,
  `region` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `job` date DEFAULT NULL,
  `designation` varchar(255) DEFAULT NULL,
  `skills` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `confirm_password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `number`, `date_of_birth`, `country`, `city`, `state`, `post_code`, `region`, `address`, `gender`, `job`, `designation`, `skills`, `email`, `password`, `confirm_password`) VALUES
(1, 'jakir', 'hossain', '01921797988', '2021-12-26', 'Bangladesh', 'Dhaka', 'dhanmondi', '1207', 'islam', 'dhanmondi,dhaka,bangladesh', NULL, NULL, NULL, NULL, 'jakir@gmail.com', '70b4269b412a8af42b1f7b0d26eceff2', '70b4269b412a8af42b1f7b0d26eceff2'),
(2, 'sakil', 'ahmed', '01721658925', '2021-12-28', 'India', 'kolkata', 'shiliguri', '1900', 'islam', 'kolkata,india', NULL, NULL, NULL, NULL, 'sakil@gmail.com', '70b4269b412a8af42b1f7b0d26eceff2', '70b4269b412a8af42b1f7b0d26eceff2'),
(3, 'juwel', 'khan', '01850504435', '2021-12-28', 'Bangladesh', 'mirpur', 'mirpur-1', '1215', 'islam', 'muirpur,dhaka,bangladesh', NULL, NULL, NULL, NULL, 'juwel@gmail.com', '70b4269b412a8af42b1f7b0d26eceff2', '70b4269b412a8af42b1f7b0d26eceff2'),
(4, 'farhan', 'hossain', '01714350207', '2021-11-10', 'Bangladesh', 'dhaka', 'mirpur', '1207', 'islam', ' Dhaka,Bangladesh', NULL, NULL, NULL, NULL, 'farhan@gmail.com', '70b4269b412a8af42b1f7b0d26eceff2', '70b4269b412a8af42b1f7b0d26eceff2'),
(5, 'jakir', 'hossain', '01921797988', '2021-12-26', 'Bangladesh', 'Dhaka', 'dhanmondi', '1207', 'islam', 'dhanmondi,dhaka,bangladesh', NULL, NULL, NULL, NULL, 'jakir@gmail.com', '70b4269b412a8af42b1f7b0d26eceff2', '70b4269b412a8af42b1f7b0d26eceff2'),
(6, 'sakil', 'ahmed', '01721658925', '2021-12-28', 'India', 'kolkata', 'shiliguri', '1900', 'islam', 'kolkata,india', NULL, NULL, NULL, NULL, 'sakil@gmail.com', '70b4269b412a8af42b1f7b0d26eceff2', '70b4269b412a8af42b1f7b0d26eceff2'),
(7, 'juwel', 'khan', '01850504435', '2021-12-28', 'Bangladesh', 'mirpur', 'mirpur-1', '1215', 'islam', 'muirpur,dhaka,bangladesh', NULL, NULL, NULL, NULL, 'juwel@gmail.com', '70b4269b412a8af42b1f7b0d26eceff2', '70b4269b412a8af42b1f7b0d26eceff2'),
(8, 'farhan', 'hossain', '01714350207', '2021-11-10', 'Bangladesh', 'dhaka', 'mirpur', '1207', 'islam', ' Dhaka,Bangladesh', NULL, NULL, NULL, NULL, 'farhan@gmail.com', '70b4269b412a8af42b1f7b0d26eceff2', '70b4269b412a8af42b1f7b0d26eceff2'),
(9, 'abdullah', 'king', '01921797988', '2021-12-27', 'Bangladesh', 'Dhaka', 'dhanmondi', '1207', 'islam', 'dhaka,bd', NULL, NULL, NULL, NULL, 'abdullah@gmail.com', '70b4269b412a8af42b1f7b0d26eceff2', '70b4269b412a8af42b1f7b0d26eceff2'),
(10, 'zubair', 'ahmed', '01921797988', '2021-12-27', 'Bangladesh', 'mirpur', 'mirpur-1', '1215', 'islam', 'dhkaka', NULL, NULL, NULL, NULL, 'zr@gmail.com', '10b8e822d03fb4fd946188e852a4c3e2', '10b8e822d03fb4fd946188e852a4c3e2'),
(11, 'jewel', 'khan', '012345012', '2021-12-31', 'Bangladesh', 'Dhaka', 'dhanmondi', '1207', 'islam', 'sirajgong,dhaka', NULL, NULL, NULL, NULL, 'zubair1050uap@gmail.com', '10b8e822d03fb4fd946188e852a4c3e2', '10b8e822d03fb4fd946188e852a4c3e2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
