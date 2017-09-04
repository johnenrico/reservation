-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 04, 2017 at 03:52 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `field_reservation`
--

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `location` text NOT NULL,
  `phone` text NOT NULL,
  `contact_person` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`id`, `name`, `address`, `location`, `phone`, `contact_person`) VALUES
(2, 'Makati', 'test', 'sadasdasd', '1111', 'John'),
(7, 'Taguig', 'Taguig', '', '56623', 'john Doe');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `passport_id` varchar(50) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `activation` varchar(255) DEFAULT NULL,
  `token` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `email`, `phone`, `passport_id`, `username`, `password`, `activation`, `token`, `created_at`, `updated_at`) VALUES
(1, 'test', 'johnenricocomia@yahoo.com', '3213123213', '123', '21321312321', 'WVhOa1lYTms=', NULL, '', '2017-08-28 17:14:29', '2017-08-28 18:25:23');

-- --------------------------------------------------------

--
-- Table structure for table `fields`
--

CREATE TABLE `fields` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fields`
--

INSERT INTO `fields` (`id`, `name`, `branch_id`, `status`) VALUES
(4, 'C1', 2, 1),
(5, 'C2', 2, 1),
(6, 'C3', 2, 1),
(7, 'C1', 7, 1),
(8, 'C2', 7, 1),
(9, 'C3', 7, 1);

-- --------------------------------------------------------

--
-- Table structure for table `module`
--

CREATE TABLE `module` (
  `modid` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT '0',
  `mod_name` varchar(255) DEFAULT NULL,
  `mod_alias` varchar(255) DEFAULT NULL,
  `icon` varchar(50) DEFAULT NULL,
  `permalink` varchar(255) DEFAULT NULL,
  `mod_order` int(11) DEFAULT '0',
  `published` enum('y','n') DEFAULT 'y',
  `created` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `module`
--

INSERT INTO `module` (`modid`, `parent_id`, `mod_name`, `mod_alias`, `icon`, `permalink`, `mod_order`, `published`, `created`) VALUES
(1, 0, 'Branches', 'branch', 'ion-levels', 'branch', 6, 'y', NULL),
(2, 0, 'Users', 'users', 'ion-ios7-people', 'users', 5, 'y', NULL),
(3, 0, 'User Group', 'user_group', 'ion-ios7-locked', 'usergroup', 7, 'y', NULL),
(4, 0, 'Time Slots', 'time_slot', 'ion-clock', 'time_slot', 3, 'y', NULL),
(6, 0, 'Customers', 'customers', 'ion-android-social', 'customers', 2, 'y', NULL),
(7, 0, 'Soccer Fields', 'fields', 'ion-ios7-football', 'fields', 3, 'y', NULL),
(8, 0, 'Reservation', 'reservation', 'ion-clipboard', 'reservation', 1, 'y', NULL),
(9, 0, 'Settings', 'settings', 'md-settings', 'settings', 8, 'y', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `id` int(11) UNSIGNED ZEROFILL NOT NULL,
  `field_id` int(11) NOT NULL,
  `time_slot` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `date_reserved` date NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`id`, `field_id`, `time_slot`, `customer_id`, `status`, `date_reserved`, `updated_at`) VALUES
(00000000005, 6, 4, 1, 1, '0000-00-00', '2017-08-28 22:02:53'),
(00000000006, 4, 5, 1, 1, '2017-08-02', '2017-08-28 22:04:27'),
(00000000007, 4, 6, 1, 1, '2017-08-02', '2017-08-28 22:05:11'),
(00000000008, 4, 7, 1, 1, '2017-08-02', '2017-08-28 22:05:28'),
(00000000009, 4, 8, 1, 1, '2017-08-02', '2017-08-28 22:05:44'),
(00000000011, 5, 4, 1, 1, '2017-08-02', '2017-08-28 22:09:19'),
(00000000012, 5, 5, 1, 1, '2017-08-02', '2017-08-28 22:09:51'),
(00000000013, 5, 6, 1, 1, '2017-08-02', '2017-08-28 22:10:30'),
(00000000014, 5, 7, 1, 1, '2017-08-02', '2017-08-28 22:11:24'),
(00000000015, 5, 8, 1, 1, '2017-08-02', '2017-08-28 22:11:50'),
(00000000017, 6, 4, 1, 1, '2017-08-02', '2017-08-28 22:15:19'),
(00000000018, 6, 5, 1, 1, '2017-08-02', '2017-08-28 22:21:34'),
(00000000019, 6, 6, 1, 1, '2017-08-02', '2017-08-28 22:22:24'),
(00000000022, 6, 7, 1, 1, '2017-08-02', '2017-08-29 10:43:06'),
(00000000023, 4, 3, 1, 1, '2017-09-02', '2017-09-03 19:17:19');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `data_keys` varchar(11) NOT NULL,
  `data` text
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `name`, `data_keys`, `data`) VALUES
(1, 'incremental', 'monday', '0'),
(6, 'incremental', 'tuesday', '0'),
(7, 'incremental', 'wednesday', '0'),
(8, 'incremental', 'thursday', '0'),
(9, 'incremental', 'friday', '0'),
(10, 'incremental', 'saturday', '0'),
(11, 'incremental', 'sunday', '0');

-- --------------------------------------------------------

--
-- Table structure for table `time_slots`
--

CREATE TABLE `time_slots` (
  `id` int(11) NOT NULL,
  `start` time NOT NULL,
  `end` time NOT NULL,
  `branch_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `time_slots`
--

INSERT INTO `time_slots` (`id`, `start`, `end`, `branch_id`, `amount`) VALUES
(3, '06:00:00', '07:00:00', 2, 500),
(4, '07:00:00', '08:00:00', 2, 100),
(5, '08:00:00', '09:00:00', 2, 1000),
(6, '09:00:00', '10:00:00', 2, 500),
(7, '10:00:00', '11:00:00', 2, 100),
(8, '12:00:00', '13:00:00', 2, 100),
(9, '06:00:00', '07:00:00', 7, 500),
(10, '07:00:00', '08:00:00', 7, 100);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `guid` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `remember_token` text,
  `token` text NOT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `created_at` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `guid`, `name`, `email`, `phone`, `remember_token`, `token`, `branch_id`, `created_at`) VALUES
(1, 'supersu', 'YzNWd1pYSnpkVEV5TXpRPQ==', 1, 'John Michael Doe', 'cuevas.badillio@evalapp.com', '', 'TVRBMU9HSXdaVGd5TWpkbE1qWXg=', '', NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `user_group`
--

CREATE TABLE `user_group` (
  `guid` int(11) NOT NULL,
  `gname` varchar(255) DEFAULT NULL,
  `role` text
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_group`
--

INSERT INTO `user_group` (`guid`, `gname`, `role`) VALUES
(1, 'Super Admin', '{"view":"8,6,4,7,2,1,3,9","create":"8,6,4,7,2,1,3,9","alter":"8,6,4,7,2,1,3,9","drop":"8,6,4,7,2,1,3,9"}'),
(2, 'Evaluator', '{"view":"1","create":"","alter":"","drop":""}');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fields`
--
ALTER TABLE `fields`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `module`
--
ALTER TABLE `module`
  ADD PRIMARY KEY (`modid`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `time_slots`
--
ALTER TABLE `time_slots`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `guid` (`guid`);

--
-- Indexes for table `user_group`
--
ALTER TABLE `user_group`
  ADD PRIMARY KEY (`guid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `fields`
--
ALTER TABLE `fields`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `module`
--
ALTER TABLE `module`
  MODIFY `modid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id` int(11) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `time_slots`
--
ALTER TABLE `time_slots`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `user_group`
--
ALTER TABLE `user_group`
  MODIFY `guid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
