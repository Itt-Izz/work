-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 13, 2018 at 04:08 PM
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
(1, '2018-06-06', 1, 'yes', 1, '0', 1, 0, 1),
(172, '2018-08-13', 81, 'yes', 3, 'no', 1, 0, 31),
(173, '2018-08-13', 83, 'yes', 2, 'no', 1, 0, 31),
(174, '2018-08-13', 85, 'yes', 0, '', 1, 0, 31),
(175, '2018-08-13', 86, 'yes', 2, 'yes', 1, 0, 31);

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
(102, '2018-08-13', 31, 10, 81, 0, 31);

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
(1, 15, '2018-08-13');

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
(38, 'Feedback', 'Imework?', '2018-08-03 21:00:00', 1, 1, 1),
(39, 'Feedback', 'Imework?', '2018-08-03 21:00:00', 1, 1, 1),
(40, 'Feedback', 'Imework?', '2018-08-03 21:00:00', 1, 1, 1),
(41, 'Feedback', 'Imework?', '2018-08-03 21:00:00', 1, 1, 1),
(42, 'Feedback', 'ok', '2018-08-03 21:00:00', 1, 1, 1),
(43, 'Feedback', 'done', '2018-08-03 21:00:00', 1, 1, 1),
(44, 'Feedback', 'It done ata ukikataa........', '2018-08-03 21:00:00', 1, 1, 1),
(45, 'Feedback', 'iiiiiiiiiiii tttttttttttttt', '2018-08-03 21:00:00', 1, 1, 1),
(46, 'Feedback', 'ya mwisho', '2018-08-03 21:00:00', 1, 1, 1),
(47, 'Feedback', 'ni a riuheg', '2018-08-03 21:00:00', 1, 1, 1),
(48, 'Feedback', 'ni a riuheg', '2018-08-03 21:00:00', 1, 1, 1),
(49, 'Feedback', 'ni a riuheg', '2018-08-03 21:00:00', 1, 1, 1),
(50, 'Feedback', 'swdefrtyuio', '2018-08-03 21:00:00', 1, 1, 1),
(51, 'Feedback', 'fghjk', '2018-08-03 21:00:00', 1, 1, 1),
(52, 'Feedback', 'zxcvgmj,k.s dudiuhd dfudhisd yuiu dfghjjushdidhusdv dudh yyidcv pysdydyudhyuhuidhduid duyidhd dyydi dyuuiuicf uyduiud uiuhi8dduyd yudidiud uyusd uddudud ddyd dudu7', '2018-08-04 21:00:00', 1, 1, 1),
(53, 'Feedback', 'okay', '2018-08-04 21:00:00', 1, 1, 1),
(54, 'Welcome', 'Nimeona', '2018-08-05 02:11:00', 1, 32, 0),
(70, 'bnhj', 'cvfgbhjk', '2018-08-07 04:04:00', 31, 31, 1),
(71, 'fgthy', 'sdfghj', '2018-08-07 04:10:00', 31, 1, 0),
(72, 'fgthy', 'sdfghj', '2018-08-07 04:10:00', 31, 1, 0),
(73, 'fgthy', 'sdfghj', '2018-08-07 04:10:00', 31, 1, 0),
(74, 'fgthy', 'sdfghj', '2018-08-07 04:10:00', 31, 1, 0),
(76, 'Feedback', 'xcvbnm,', '2018-08-06 21:00:00', 31, 1, 1),
(77, 'Feedback', 'zxcvbhjkl;\r\n\r\n', '2018-08-06 21:00:00', 31, 1, 1),
(78, 'Feedback', 'dfghyjukil', '2018-08-06 21:00:00', 31, 1, 1),
(79, 'fgthy', 'dfghyjuki', '2018-08-07 05:12:00', 31, 1, 0),
(80, 'Feedback', 'sdvfghjulo;p', '2018-08-07 21:00:00', 31, 1, 1),
(84, 'Welcome', 'To me', '2018-08-08 09:45:00', 31, 0, 0),
(85, 'Welcome', 'To me', '2018-08-08 09:45:00', 31, 0, 0),
(86, 'Welcome', 'ok', '2018-08-08 09:47:00', 31, 1, 0),
(87, 'Welcome', 'xvb', '2018-08-08 09:50:00', 31, 0, 0),
(88, 'ok', 'tiititi', '2018-08-08 09:54:00', 31, 0, 0),
(89, 'Welcome', 'ghjk', '2018-08-08 09:55:00', 31, 0, 0),
(90, 'Welcome', 'ghjk', '2018-08-07 22:04:00', 31, 0, 0),
(91, 'Welcome', 'bnm', '2018-08-07 22:20:00', 31, 32, 0),
(92, 'Feedback', ' nnm', '2018-08-07 21:00:00', 31, 1, 1),
(94, 'Feedback', 'all is well\r\n', '2018-08-09 21:00:00', 31, 1, 1),
(95, 'Feedback', 'I am lucky', '2018-08-09 21:00:00', 31, 1, 1),
(96, 'Feedback', 'Check all the employ', '2018-08-09 21:00:00', 31, 1, 1),
(97, 'Feedback', 'See all the employee', '2018-08-09 21:00:00', 31, 1, 1),
(98, 'Feedback', 'Its okay men', '2018-08-09 21:00:00', 31, 1, 0),
(99, 'Feedback', 'do more ', '2018-08-09 21:00:00', 31, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `pay`
--

CREATE TABLE `pay` (
  `p_id` int(20) NOT NULL,
  `pay_date` date NOT NULL,
  `amt` float NOT NULL,
  `deduction` float NOT NULL,
  `staff_id` int(20) NOT NULL,
  `att_col` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pay`
--

INSERT INTO `pay` (`p_id`, `pay_date`, `amt`, `deduction`, `staff_id`, `att_col`) VALUES
(1, '2018-08-06', 2500, 100, 31, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sms`
--

CREATE TABLE `sms` (
  `s_id` int(20) NOT NULL,
  `msg` text NOT NULL,
  `s_date` date NOT NULL,
  `m_to` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sms`
--

INSERT INTO `sms` (`s_id`, `msg`, `s_date`, `m_to`) VALUES
(1, 'It is done', '2018-08-07', 0),
(2, 'it ok now', '2018-08-09', 0),
(3, 'Okay done', '2018-08-09', 0),
(4, 'Try again', '2018-08-09', 0),
(7, 'Hi Hope uko poa,\nNi Izzo na ninatest system fulani apa.\nSo usimind ukiget message kutoka kwaa ii namba.\nJust ignore it.', '2018-08-13', 0),
(8, 'Hi Hope uko poa,\nNi Izzo na ninatest system fulani apa.\nSo usimind ukiget message kutoka kwaa ii namba.\nJust ignore it.', '2018-08-13', 0),
(9, 'Sasa, ni Izzo.\nUsijali hizi message. Natest project yangu n so utaziget kadhaa before nipresent kesho', '2018-08-13', 0);

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
  `email` varchar(20) NOT NULL,
  `image` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staff_id`, `fname`, `lname`, `sex`, `birthday`, `username`, `password`, `date_registered`, `id_number`, `phone_number`, `level`, `location`, `email`, `image`) VALUES
(1, 'Isaac', 'Thuo', 'Male', '1983-06-13', 'Izzo', 'izzo', '2016-03-28', '29953268', '0710662656', 'admin', 'Rongai', 'issa@gmail.com', 'itt.jpg'),
(31, 'Joy Kituku', 'Jarib', 'Female', '1983-06-13', 'Joy', 'joy123', '2018-05-30', '47858338', '0739857464', 'clerk', 'Nairobi', 'try@trymail.com', ''),
(81, 'Daniel', 'T', 'Male', '2001-10-03', 'danthuo', 'dan123', '2018-08-13', '30225698', '0720976484', 'staff', 'Nakuru', 'danthu|@gmail.com', 'ent.PNG'),
(82, 'Joel', 'K', 'Male', '1998-12-09', 'joe', 'joe123', '2018-08-13', '30225698', '0719416774', 'staff', 'Olekasasi', 'joe@gmail.com', 'pay.PNG'),
(83, 'Esther', 'T', 'Female', '1998-12-09', 'essy', 'essy12', '2018-08-13', '3425698', '0701168196', 'staff', 'Karen', 'essy@gmail.com', 'emp.PNG'),
(84, 'Toidy', 'Mokaya', 'Female', '2000-11-15', 'toidi', 'toi123', '2018-08-13', '5678989', '0739953294', 'staff', 'MasaiLodge', 'toi@gmail.com', 'jquery.PNG'),
(85, 'George', 'K', 'Male', '2001-06-05', 'geogy', 'geo123', '2018-08-13', '09876098', '0704817065', 'staff', 'Kobil', 'geogy@gmail.com', 'registecode.PNG'),
(86, 'Ibuu', 'W', 'Male', '2000-10-10', 'ibu', 'ibu123', '2018-08-13', '7876545', '0729034336', 'staff', 'Limpa', '', 'report.PNG'),
(87, 'Peter', 'Mwas', 'Male', '1999-12-01', 'mwas', 'mwa123', '2018-08-13', '5678765', '0729255969', 'staff', 'Poster', 'pt@ymail.com', 'emp.PNG'),
(88, 'Josi', 'Karis', 'Male', '1999-11-10', 'josi', 'josi12', '2018-08-13', '765435', '0724503797', 'staff', 'Mbagathi', 'josi@gmail.com', 'att.PNG');

-- --------------------------------------------------------

--
-- Table structure for table `tools`
--

CREATE TABLE `tools` (
  `t_id` int(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `cost` float NOT NULL,
  `namba` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tools`
--

INSERT INTO `tools` (`t_id`, `name`, `cost`, `namba`) VALUES
(1, 'spade', 100, 50),
(2, 'jembe', 250, 100),
(3, 'mattock', 500, 10),
(4, 'slasher', 150, 20),
(5, 'panga', 100, 100),
(7, 'sickle', 100, 30),
(8, 'hummer', 100, 2),
(9, 'Hoe', 400, 2),
(10, 'Saw', 200, 5),
(11, 'Pliers', 200, 3);

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
(1, 400, 900, '2018-08-13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `staff_id` (`staff_id`);

--
-- Indexes for table `collection`
--
ALTER TABLE `collection`
  ADD PRIMARY KEY (`id`),
  ADD KEY `staff_id` (`staff_id`);

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
  ADD KEY `message_ibfk_1` (`dest_id`),
  ADD KEY `staff_id` (`staff_id`);

--
-- Indexes for table `pay`
--
ALTER TABLE `pay`
  ADD PRIMARY KEY (`p_id`),
  ADD KEY `staff_id` (`staff_id`);

--
-- Indexes for table `sms`
--
ALTER TABLE `sms`
  ADD PRIMARY KEY (`s_id`);

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
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=176;

--
-- AUTO_INCREMENT for table `collection`
--
ALTER TABLE `collection`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `collectionrate`
--
ALTER TABLE `collectionrate`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `m_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `pay`
--
ALTER TABLE `pay`
  MODIFY `p_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `sms`
--
ALTER TABLE `sms`
  MODIFY `s_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `staff_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT for table `tools`
--
ALTER TABLE `tools`
  MODIFY `t_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `wage`
--
ALTER TABLE `wage`
  MODIFY `w_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `attendance_ibfk_1` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`staff_id`);

--
-- Constraints for table `collection`
--
ALTER TABLE `collection`
  ADD CONSTRAINT `collection_ibfk_1` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`staff_id`);

--
-- Constraints for table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_ibfk_1` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`staff_id`);

--
-- Constraints for table `pay`
--
ALTER TABLE `pay`
  ADD CONSTRAINT `pay_ibfk_1` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`staff_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
