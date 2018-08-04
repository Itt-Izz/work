-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 03, 2018 at 11:17 AM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 5.6.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `newsalary`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(20) NOT NULL,
  `date` date NOT NULL,
  `staff_id` int(20) NOT NULL,
  `present` varchar(10) NOT NULL,
  `t_id` int(20) NOT NULL,
  `returned_tool` varchar(10) NOT NULL,
  `w_id` int(20) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `ur_clerk` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `date`, `staff_id`, `present`, `t_id`, `returned_tool`, `w_id`, `status`, `ur_clerk`) VALUES
(115, '2018-08-02', 47, 'yes', 3, 'yes', 1, 1, 1),
(117, '2018-08-02', 18, 'yes', 0, '', 1, 1, 1),
(118, '2018-08-03', 20, 'yes', 3, 'yes', 1, 0, 1),
(119, '2018-08-03', 21, 'yes', 0, '', 1, 0, 1),
(120, '2018-08-03', 26, 'yes', 0, '', 1, 0, 1),
(121, '2018-08-03', 33, 'yes', 4, 'no', 1, 0, 1),
(122, '2018-08-03', 34, 'yes', 0, '', 1, 0, 1),
(123, '2018-08-03', 35, 'yes', 2, 'yes', 1, 0, 1),
(124, '2018-08-03', 18, 'yes', 0, '', 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `collection`
--

CREATE TABLE `collection` (
  `id` int(20) NOT NULL,
  `col_date` date NOT NULL,
  `weight` float NOT NULL,
  `rate` float NOT NULL,
  `staff_id` int(20) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `ur_clerk` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `collection`
--

INSERT INTO `collection` (`id`, `col_date`, `weight`, `rate`, `staff_id`, `status`, `ur_clerk`) VALUES
(1, '2018-06-24', 30, 10, 18, 1, 0),
(2, '2018-06-23', 20, 10, 21, 0, 0),
(3, '2018-06-28', 20, 10, 18, 1, 1),
(10, '2018-06-29', 31, 10, 18, 1, 1),
(11, '2018-06-29', 31, 10, 20, 1, 1),
(12, '2018-06-29', 10, 10, 33, 0, 1),
(13, '2018-06-30', 31, 10, 18, 1, 1),
(14, '2018-06-30', 31, 10, 37, 0, 1),
(15, '2018-06-30', 17, 10, 21, 0, 1),
(16, '2018-07-01', 31, 10, 18, 1, 1),
(17, '2018-07-01', 76, 10, 35, 0, 1),
(18, '2018-07-02', 900.5, 10, 18, 1, 1),
(19, '2018-07-03', 5.7, 10, 18, 1, 1),
(20, '2018-07-05', 20, 10, 18, 1, 1),
(22, '2018-07-05', 0, 10, 21, 0, 1),
(23, '2018-07-05', 10, 10, 20, 1, 1),
(24, '2018-07-05', 20, 10, 26, 0, 1),
(25, '2018-07-05', 20, 10, 37, 0, 1),
(26, '2018-07-06', 20, 10, 18, 1, 1),
(27, '2018-07-19', 20, 10, 18, 1, 1),
(28, '2018-07-19', 10, 10, 20, 1, 1),
(32, '2018-07-20', 56, 10, 21, 0, 1),
(33, '2018-07-20', 20, 10, 34, 0, 1),
(37, '2018-07-20', 44, 10, 37, 0, 1),
(38, '2018-07-22', 455, 10, 18, 1, 1),
(39, '2018-07-23', 1, 10, 18, 1, 1),
(40, '2018-07-25', 20, 10, 18, 1, 1),
(41, '2018-07-25', 30, 10, 20, 1, 1),
(42, '2018-07-26', 200, 10, 18, 1, 1),
(43, '2018-07-27', 90, 10, 18, 1, 31),
(44, '2018-07-29', 90, 10, 18, 1, 1),
(45, '2018-07-30', 7, 10, 18, 1, 1),
(46, '2018-07-30', 34, 10, 20, 1, 1),
(47, '2018-07-30', 20, 10, 34, 0, 1),
(48, '2018-07-31', 10, 10, 34, 0, 1),
(49, '2018-08-02', 30, 10, 18, 0, 1),
(50, '2018-08-02', 200, 10, 20, 1, 1),
(51, '2018-08-03', 5678, 10, 18, 0, 1),
(52, '2018-08-03', 33, 10, 21, 0, 1),
(53, '2018-08-03', 20, 10, 20, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `collectionrate`
--

CREATE TABLE `collectionrate` (
  `id` int(20) NOT NULL,
  `rate` float NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `collectionrate`
--

INSERT INTO `collectionrate` (`id`, `rate`, `date`) VALUES
(1, 10, '2018-06-06');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `m_id` int(20) NOT NULL,
  `subject` varchar(20) NOT NULL,
  `msg` text NOT NULL,
  `sent_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `staff_id` int(20) NOT NULL,
  `dest_id` int(20) NOT NULL,
  `Msg_read` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`m_id`, `subject`, `msg`, `sent_date`, `staff_id`, `dest_id`, `Msg_read`) VALUES
(1, 'sasa', 'Hope all is well to you bro', '2018-06-07 10:07:28', 1, 31, 1),
(2, 'nnn', 'rdeftgyhuijokp', '2018-06-07 11:28:59', 21, 1, 0),
(3, 'k', 'Tuone sasa', '2018-06-14 13:06:49', 31, 1, 1),
(4, 'Scrr', 'Thing gooes Sckrrr!!!!!!!!!!!', '2018-06-14 14:56:22', 20, 18, 0),
(12, 'Do not Mind', 'Its been a long journey but do not mind', '2018-06-21 07:32:00', 1, 20, 0),
(13, 'Mind', 'Please mind. Its been a long journey but do not mind', '2018-06-21 07:33:00', 1, 21, 0),
(14, 'Ok', 'IT is ok', '2018-06-25 08:30:00', 1, 37, 0),
(15, 'Working', 'The project is okay to say', '2018-06-26 07:02:00', 1, 20, 0),
(16, 'Thanks', 'I sincerely thank you for that', '2018-06-26 07:04:00', 21, 37, 0),
(17, 'Thanks', 'I sincerely thank you for that', '2018-06-26 07:04:00', 21, 1, 0),
(18, 'Aje', 'Thanks Josi', '2018-06-27 09:13:00', 1, 34, 0),
(19, 'Welcome', 'Welcome so much', '2018-07-02 08:01:00', 1, 37, 0),
(24, 'How', 'Hi bro, Ile stuff uliimplement aje?', '2018-07-31 09:15:00', 1, 31, 0),
(25, 'ok', 'oooh yah', '2018-08-03 09:55:00', 1, 32, 0),
(26, 'ok', 'oooh yah', '2018-08-03 09:56:00', 1, 32, 0),
(27, 'ok', 'oooh yah', '2018-08-03 09:56:00', 1, 0, 0),
(28, 'ok', 'oooh yah', '2018-08-03 09:56:00', 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `pay`
--

CREATE TABLE `pay` (
  `p_id` int(20) NOT NULL,
  `pay_date` date NOT NULL,
  `amt` float NOT NULL,
  `deduction` float NOT NULL,
  `staff_id` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pay`
--

INSERT INTO `pay` (`p_id`, `pay_date`, `amt`, `deduction`, `staff_id`) VALUES
(1, '2018-06-23', 2500, 200, 0),
(2, '2018-06-23', 2000, 0, 0),
(3, '2018-06-23', 3000, 1000, 0),
(4, '2018-06-20', 2500, 0, 0),
(5, '2018-06-15', 1000, 0, 0),
(18, '2018-07-31', 388, 112, 0),
(19, '2018-07-31', 70, 0, 0),
(20, '2018-08-02', 2900, 100, 0),
(21, '2018-08-02', 2900, 100, 0),
(22, '2018-08-03', -500, 500, 0),
(23, '2018-08-03', 3150, 0, 0),
(24, '2018-08-03', 600, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `pay_staff`
--

CREATE TABLE `pay_staff` (
  `id` int(11) NOT NULL,
  `staff_id` int(20) NOT NULL,
  `p_id` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pay_staff`
--

INSERT INTO `pay_staff` (`id`, `staff_id`, `p_id`) VALUES
(1, 18, 1),
(2, 21, 2),
(3, 18, 3),
(4, 18, 4),
(5, 26, 5);

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `staff_id` int(20) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `sex` varchar(50) NOT NULL,
  `birthday` date NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `date_registered` date NOT NULL,
  `id_number` varchar(8) NOT NULL,
  `phone_number` varchar(10) NOT NULL,
  `level` varchar(20) NOT NULL,
  `location` varchar(20) NOT NULL,
  `image` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staff_id`, `fname`, `lname`, `sex`, `birthday`, `username`, `password`, `date_registered`, `id_number`, `phone_number`, `level`, `location`, `image`) VALUES
(1, 'Isaac Thuo', 'Jarib', 'Male', '1983-06-13', 'Izzo', 'izzo', '2016-03-28', '29953268', '0706015021', 'admin', '', 'itt.jpg'),
(18, 'peter muchiri', 'Jarib', 'Male', '1993-06-13', 'peter', 'peter', '2016-02-25', '58958529', '0723589654', 'staff', '', ''),
(20, 'kuria jamii', 'Jarib', 'Male', '2000-06-13', 'kuria', 'kush', '2016-02-25', '12547896', '0796542125', 'staff', '', ''),
(21, 'kuria muthoni', 'Jarib', 'Male', '1983-06-13', 'kuria', 'kuria', '2016-02-25', '56689888', '0723568985', 'staff', '', ''),
(26, 'peter monicah', 'Jarib', 'Male', '1983-06-13', 'peeter', 'peeter', '2016-03-12', '25478965', '0758698525', 'staff', '', ''),
(31, 'Joy Kituku', 'Jarib', 'Female', '1983-06-13', 'Joy', 'joy', '2018-05-30', '47858338', '0739857464', 'clerk', '', ''),
(32, 'Isaac Thuo', 'Jarib', 'Male', '1980-06-13', 'Izz', 'izz', '2018-05-31', '30225698', '0710662656', 'clerk', '', ''),
(33, 'Mattin', 'Jarib', 'male', '1983-06-13', 'mat', 'mat', '2018-06-13', '567', '0745678', 'staff', '', ''),
(34, 'Josphat', 'Jarib', 'male', '1983-06-13', 'jos', 'jos', '2018-06-14', '567', '0745678', 'staff', '', ''),
(35, 'Mose', 'Jarib', 'Male', '1983-06-13', 'mos', 'mos', '2018-06-15', '678', '07282898', 'staff', '', ''),
(36, 'Kennedy', 'Jarib', 'Female', '1983-07-13', 'Ken', 'ken', '2018-06-24', '302', '0710662656', 'staff', '', ''),
(37, 'Nelson K.', 'Jarib', 'male', '1990-06-01', 'nel', 'nel', '2018-06-25', '543847', '074566778', 'staff', '', 'pie_chart.png'),
(38, 'Moses', 'Jarib', 'male', '2020-07-18', 'mose2', 'moses123', '2018-07-20', '30225698', '0745678767', 'staff', '', ''),
(39, 'King', 'Jarib', 'Female', '2025-07-18', 'king', 'king123', '2018-07-22', '4567809', '0753575656', 'staff', '', ''),
(40, 'JJ', 'Jarib', 'male', '0000-00-00', 'jj', 'jos123', '2018-07-22', '4567', '0734567890', 'staff', '', ''),
(41, 'Mos', 'Jarib', 'Female', '0000-00-00', 'mossi', 'mossi123', '2018-07-22', '8765', '0719992656', 'staff', '', 'Jellyfish.jpg'),
(42, 'Dj', 'Jarib', 'male', '2014-09-16', 'Ottii', 'mooo123', '2018-07-26', '25758689', '0710662656', 'staff', '', ''),
(43, 'Monjore', 'Jarib', 'male', '2024-05-16', 'Izzzzzzzzzz', 'monte12', '2018-07-26', '98765', '0710662656', 'staff', '', ''),
(44, 'Kant', 'Jarib', 'male', '2021-09-16', 'kkp', 'izzo12', '2018-07-26', '0987', '0710662656', 'staff', '', 'Hydrangeas.jpg'),
(45, 'Mot', 'Jarib', 'male', '2025-07-18', 'tot', 'toto12', '2018-07-27', '8765', '0710662656', 'staff', '', 'Desert.jpg'),
(46, 'Mot', 'Jarib', 'male', '2027-07-18', 'toty', 'toto12', '2018-07-27', '8765', '0710662656', 'staff', '', 'Chrysanthemum.jpg'),
(47, 'Yellow', 'Tommy', 'Female', '2030-07-18', 'yellow', 'yellow1', '2018-07-30', '765', '0710662656', 'staff', '', 'Koalaa.jpg'),
(48, 'mtoo', 'k', 'Female', '2015-08-17', 'mtoot', 'mtot12', '2018-07-30', '567', '0720887878', 'staff', '', ''),
(49, 'Marige', 'Kimuntu', 'male', '2004-04-17', 'kimuntu', 'kimu12', '2018-07-31', '3456', '0734234234', 'staff', '', 'Tulipss.jpg'),
(50, 'Olop', 'Kyenge', 'male', '2021-05-18', 'olope', 'olop12', '2018-07-31', '432', '0721000999', 'staff', '', 'Hydrangeass.jpg'),
(51, 'Olop', 'Kyenge', 'male', '2031-07-18', 'olope2', 'olop12', '2018-07-31', '432', '0721000999', 'staff', '', 'Chrysanthemumy.jpg'),
(56, 'yu', 'ghj', 'male', '2011-12-17', 'qwe1', 'qwe123', '2018-08-02', '987', '0710662656', 'staff', '', 'Capture.PNG'),
(57, 'Yellow', 'Tommy', 'female', '2029-07-18', 'Izzo123', 'qwe123', '2018-08-02', '567', '0710662656', 'staff', '', 'Koalaa.jpg'),
(58, 'Yellow', 'Tommy', 'female', '2025-03-18', 'yee123', 'qwe123', '2018-08-02', '567', '0710662656', 'staff', '', 'Penguinss.jpg'),
(59, 'm', 'isaa', 'female', '2004-12-17', 'Izzo1234', 'mmu123', '2018-08-02', '567', '0710662656', 'staff', '', 'imei.PNG'),
(61, 'Yellow', 'isaa', 'female', '2004-06-18', 'qwe123', 'qwe123', '2018-08-02', '6543', '0710662656', 'staff', '', 'Capture.PNG'),
(62, 'm', 'isaa', 'female', '2014-05-18', 'ytrewq', 'qwe123', '2018-08-02', '54', '0710662656', 'staff', '', 'Capture.PNG'),
(63, 'd', 'g', 'female', '2003-08-18', 'sa2', 'qwe123', '2018-08-02', '567', '0710662656', 'staff', '', 'Capture.PNG'),
(64, 'm', 'isaa', 'female', '2013-03-18', 'gfdsa', 'qwe123', '2018-08-02', '567', '0710662656', 'staff', '', 'Capture.PNG'),
(65, 'Me', 'n', 'female', '2011-06-18', 'rewq', 'qwe123', '2018-08-03', '98', '0710662656', 'staff', '', 'Capture.PNG'),
(66, 'm', 'isaa', 'female', '2023-04-18', 'mmm123', 'mmm123', '2018-08-03', '567', '0710662656', 'staff', '', 'Capture.PNG');

-- --------------------------------------------------------

--
-- Table structure for table `tools`
--

CREATE TABLE `tools` (
  `t_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `cost` float NOT NULL,
  `namba` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tools`
--

INSERT INTO `tools` (`t_id`, `name`, `cost`, `namba`) VALUES
(1, 'spade', 112, 50),
(2, 'jembe', 250, 100),
(3, 'mattock', 500, 10),
(4, 'slasher', 150, 20),
(5, 'panga', 100, 100),
(7, 'sickle', 100, 30);

-- --------------------------------------------------------

--
-- Table structure for table `wage`
--

CREATE TABLE `wage` (
  `w_id` int(20) NOT NULL,
  `employee` int(20) NOT NULL,
  `clerk` int(20) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wage`
--

INSERT INTO `wage` (`w_id`, `employee`, `clerk`, `date`) VALUES
(1, 300, 700, '2018-07-10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `collection`
--
ALTER TABLE `collection`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `collectionrate`
--
ALTER TABLE `collectionrate`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`m_id`),
  ADD KEY `staff_id` (`staff_id`),
  ADD KEY `message_ibfk_1` (`dest_id`);

--
-- Indexes for table `pay`
--
ALTER TABLE `pay`
  ADD PRIMARY KEY (`p_id`);

--
-- Indexes for table `pay_staff`
--
ALTER TABLE `pay_staff`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staff_id`);

--
-- Indexes for table `tools`
--
ALTER TABLE `tools`
  ADD PRIMARY KEY (`t_id`);

--
-- Indexes for table `wage`
--
ALTER TABLE `wage`
  ADD PRIMARY KEY (`w_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=125;

--
-- AUTO_INCREMENT for table `collection`
--
ALTER TABLE `collection`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `collectionrate`
--
ALTER TABLE `collectionrate`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `m_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `pay`
--
ALTER TABLE `pay`
  MODIFY `p_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `pay_staff`
--
ALTER TABLE `pay_staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `staff_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `tools`
--
ALTER TABLE `tools`
  MODIFY `t_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `wage`
--
ALTER TABLE `wage`
  MODIFY `w_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
