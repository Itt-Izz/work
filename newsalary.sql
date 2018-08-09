-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 09, 2018 at 04:05 PM
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
(142, '2018-07-25', 39, 'yes', 5, 'no', 1, 1, 1),
(143, '2018-08-01', 39, 'yes', 4, 'no', 1, 1, 1),
(144, '2018-08-02', 34, 'yes', 1, 'no', 1, 1, 1),
(145, '2018-08-05', 26, 'yes', 1, 'no', 1, 0, 1),
(147, '2018-08-05', 38, 'yes', 0, '', 1, 1, 1),
(148, '2018-08-06', 33, 'yes', 0, '', 1, 1, 1),
(149, '2018-08-06', 21, 'yes', 0, '', 1, 1, 1),
(150, '2018-08-06', 37, 'yes', 2, 'no', 1, 1, 1),
(151, '2018-08-07', 20, 'yes', 1, 'no', 1, 1, 31),
(152, '2018-08-07', 21, 'yes', 0, '', 1, 0, 31),
(153, '2018-08-07', 33, 'yes', 0, '', 1, 0, 31),
(154, '2018-08-07', 35, 'yes', 4, 'no', 1, 0, 31),
(155, '2018-08-08', 39, 'yes', 5, 'no', 1, 0, 31),
(156, '2018-08-07', 39, 'yes', 0, '', 1, 0, 31),
(157, '2018-08-03', 39, 'yes', 0, '', 1, 0, 31),
(158, '2018-08-08', 21, 'yes', 1, 'no', 1, 0, 31),
(159, '2018-08-08', 18, 'yes', 1, 'no', 1, 0, 31),
(160, '2018-08-08', 20, 'yes', 1, 'no', 1, 0, 31),
(162, '2018-08-09', 26, 'yes', 1, 'yes', 1, 0, 31),
(163, '2018-08-09', 35, 'yes', 5, 'yes', 1, 0, 31),
(164, '2018-08-09', 37, 'yes', 4, 'no', 1, 1, 31),
(165, '2018-08-09', 18, 'yes', 4, 'no', 1, 0, 31),
(166, '2018-08-09', 36, 'yes', 0, '', 1, 0, 31);

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
(84, '2018-08-03', 60, 10, 39, 0, 31),
(85, '2018-08-08', 20, 10, 20, 0, 31),
(86, '2018-08-08', 20, 10, 26, 0, 31),
(87, '2018-08-08', 40, 10, 34, 0, 31),
(88, '2018-08-08', 50, 10, 37, 0, 31),
(89, '2018-08-07', 20, 10, 26, 0, 31),
(90, '2018-08-07', 50, 10, 20, 0, 31),
(91, '2018-08-07', 70, 10, 35, 0, 31),
(92, '2018-08-08', 345, 10, 18, 0, 31),
(93, '2018-08-08', 33, 10, 36, 0, 31),
(94, '2018-08-09', 30, 10, 18, 0, 31),
(95, '2018-08-09', 20, 10, 33, 0, 31);

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
(1, 12, '2018-08-09');

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
(2, 'nnn', 'rdeftgyhuijokp', '2018-06-07 11:28:59', 21, 1, 1),
(3, 'k', 'Tuone sasa', '2018-06-14 13:06:49', 31, 1, 1),
(4, 'Scrr', 'Thing gooes Sckrrr!!!!!!!!!!!', '2018-06-14 14:56:22', 20, 18, 0),
(12, 'Do not Mind', 'Its been a long journey but do not mind', '2018-06-21 07:32:00', 1, 20, 0),
(13, 'Mind', 'Please mind. Its been a long journey but do not mind', '2018-06-21 07:33:00', 1, 21, 0),
(14, 'Ok', 'IT is ok', '2018-06-25 08:30:00', 1, 37, 0),
(15, 'Working', 'The project is okay to say', '2018-06-26 07:02:00', 1, 20, 0),
(16, 'Thanks', 'I sincerely thank you for that', '2018-06-26 07:04:00', 21, 37, 0),
(17, 'Thanks', 'I sincerely thank you for that', '2018-06-26 07:04:00', 21, 1, 1),
(18, 'Aje', 'Thanks Josi', '2018-06-27 09:13:00', 1, 34, 0),
(19, 'Welcome', 'Welcome so much', '2018-07-02 08:01:00', 1, 37, 0),
(24, 'How', 'Hi bro, Ile stuff uliimplement aje?', '2018-07-31 09:15:00', 1, 31, 1),
(25, 'ok', 'oooh yah', '2018-08-03 09:55:00', 1, 32, 0),
(26, 'ok', 'oooh yah', '2018-08-03 09:56:00', 1, 32, 0),
(27, 'ok', 'oooh yah', '2018-08-03 09:56:00', 1, 1, 1),
(28, 'ok', 'oooh yah', '2018-08-03 09:56:00', 1, 0, 0),
(29, 'Ati?', 'Sikuget vile ulisema bro', '2018-08-03 04:51:00', 1, 31, 0),
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
(55, 'Welcome', 'Nimeona', '2018-08-05 02:11:00', 1, 32, 0),
(56, 'Welcome', 'nmeget', '2018-08-05 02:18:00', 18, 32, 0),
(57, 'Feedback', 'Na system iko fiti', '2018-08-04 21:00:00', 18, 1, 1),
(58, '', '', '2018-08-05 09:52:00', 1, 0, 0),
(59, 'Feedback', 'How is all?', '2018-08-06 21:00:00', 31, 1, 1),
(60, 'Feedback', 'lets see', '2018-08-06 21:00:00', 31, 1, 1),
(61, 'Feedback', 'uliona', '2018-08-06 21:00:00', 31, 1, 1),
(62, 'Feedback', 'we are', '2018-08-06 21:00:00', 21, 1, 1),
(63, 'Feedback', 'rtyui', '2018-08-06 21:00:00', 21, 1, 1),
(64, 'Feedback', 'fghj', '2018-08-06 21:00:00', 31, 1, 1),
(65, 'Feedback', 'dcfghj', '2018-08-06 21:00:00', 31, 1, 1),
(66, 'Feedback', 'oijgdfsfghjkl;', '2018-08-06 21:00:00', 31, 1, 1),
(67, 'Feedback', 'dhjbhjfvhjfffjuhj', '2018-08-06 21:00:00', 31, 1, 1),
(68, 'bnhj', 'cvfgbhjk', '2018-08-07 04:04:00', 31, 31, 1),
(69, 'bnhj', 'cvfgbhjk', '2018-08-07 04:04:00', 31, 31, 1),
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
(93, 'Feedback', 'kjhgfe', '2018-08-07 21:00:00', 31, 1, 0);

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
(24, '2018-08-03', 600, 0, 0),
(25, '2018-08-04', 300, 0, 0),
(26, '2018-08-04', 50, 250, 0),
(27, '2018-08-04', 50, 250, 0),
(28, '2018-08-04', 100, 0, 0),
(29, '2018-08-06', 50, 250, 0),
(30, '2018-08-06', 600, 0, 0),
(31, '2018-08-06', 450, 0, 0),
(32, '2018-08-06', 890, 0, 0),
(33, '2018-08-07', 1000, 500, 0),
(34, '2018-08-07', 900, 0, 0),
(35, '2018-08-07', 750, 150, 0),
(36, '2018-08-07', 2030, 0, 0),
(37, '2018-08-07', 10, 0, 0),
(38, '2018-08-07', 50, 250, 0),
(39, '2018-08-07', 600, 0, 0),
(40, '2018-08-07', 1200, 0, 0),
(41, '2018-08-07', -200, 500, 0),
(42, '2018-08-07', 600, 0, 0),
(43, '2018-08-07', 500, 100, 0),
(44, '2018-08-07', 1390, 0, 0),
(45, '2018-08-07', 420, 0, 0),
(46, '2018-08-07', 100, 0, 0),
(47, '2018-08-07', 1490, 0, 0),
(48, '2018-08-07', 900, 0, 0),
(49, '2018-08-07', 100, 0, 0),
(50, '2018-08-07', 450, 0, 0),
(51, '2018-08-07', 20, 0, 0),
(52, '2018-08-07', 3200, 0, 0),
(53, '2018-08-07', 660, 0, 0),
(54, '2018-08-07', 700, 0, 0),
(55, '2018-08-07', 1180, 0, 0),
(56, '2018-08-07', 200, 0, 0),
(57, '2018-08-09', 450, 150, 0);

-- --------------------------------------------------------

--
-- Table structure for table `sms`
--

CREATE TABLE `sms` (
  `s_id` int(20) NOT NULL,
  `msg` text NOT NULL,
  `s_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sms`
--

INSERT INTO `sms` (`s_id`, `msg`, `s_date`) VALUES
(1, 'It is done', '2018-08-07'),
(2, 'it ok now', '2018-08-09'),
(3, 'Okay done', '2018-08-09'),
(4, 'Try again', '2018-08-09');

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
(1, 'Isaac Thuo', 'Jarib', 'Male', '1983-06-13', 'Izzo', 'izzo', '2016-03-28', '29953268', '0706015021', 'admin', 'Some_Place', 'try@trymail.com', 'itt.jpg'),
(18, 'peter muchiri', 'Jarib', 'Male', '1993-06-13', 'peter', 'peter', '2016-02-25', '58958529', '0723589654', 'staff', 'Some_Place', 'try@trymail.com', ''),
(20, 'kuria jamii', 'Jarib', 'Male', '2000-06-13', 'kuria', 'kush', '2016-02-25', '12547896', '0796542125', 'staff', 'Some_Place', 'try@trymail.com', ''),
(21, 'kuria muthoni', 'Jarib', 'Male', '1983-06-13', 'kuria', 'kuria', '2016-02-25', '56689888', '0723568985', 'staff', 'Some_Place', 'try@trymail.com', ''),
(26, 'peter monicah', 'Jarib', 'Male', '1983-06-13', 'peeter', 'peeter', '2016-03-12', '25478965', '0758698525', 'staff', 'Some_Place', 'try@trymail.com', ''),
(31, 'Joy Kituku', 'Jarib', 'Female', '1983-06-13', 'Joy', 'joy123', '2018-05-30', '47858338', '0739857464', 'clerk', 'Some_Place', 'try@trymail.com', ''),
(32, 'Isaac Thuo', 'Jarib', 'Male', '1980-06-13', 'Izz', 'izz', '2018-05-31', '30225698', '0710662656', 'clerk', 'Some_Place', 'try@trymail.com', ''),
(33, 'Mattin', 'Jarib', 'male', '1983-06-13', 'mat', 'mat', '2018-06-13', '567', '0745678', 'staff', 'Some_Place', 'try@trymail.com', ''),
(34, 'Josphat', 'Jarib', 'male', '1983-06-13', 'jos', 'jos', '2018-06-14', '567', '0745678', 'staff', 'Some_Place', 'try@trymail.com', ''),
(35, 'Mose', 'Jarib', 'Male', '1983-06-13', 'mos', 'mos', '2018-06-15', '678', '07282898', 'staff', 'Some_Place', 'try@trymail.com', ''),
(36, 'Kennedy', 'Jarib', 'Female', '1983-07-13', 'Ken', 'ken', '2018-06-24', '302', '0710662656', 'staff', 'Some_Place', 'try@trymail.com', ''),
(37, 'Nelson K.', 'Jarib', 'male', '1990-06-01', 'nel', 'nel', '2018-06-25', '543847', '074566778', 'staff', 'Some_Place', 'try@trymail.com', 'pie_chart.png'),
(38, 'Moses', 'Jarib', 'male', '2020-07-18', 'mose2', 'moses123', '2018-07-20', '30225698', '0745678767', 'staff', 'Some_Place', 'try@trymail.com', ''),
(39, 'King', 'Jarib', 'Female', '2025-07-18', 'king', 'king123', '2018-07-22', '4567809', '0753575656', 'staff', 'Some_Place', 'try@trymail.com', ''),
(40, 'JJ', 'Jarib', 'male', '0000-00-00', 'jj', 'jos123', '2018-07-22', '4567', '0734567890', 'staff', 'Some_Place', 'try@trymail.com', ''),
(41, 'Mos', 'Jarib', 'Female', '0000-00-00', 'mossi', 'mossi123', '2018-07-22', '8765', '0719992656', 'staff', 'Some_Place', 'try@trymail.com', 'Jellyfish.jpg'),
(42, 'Dj', 'Jarib', 'male', '2014-09-16', 'Ottii', 'mooo123', '2018-07-26', '25758689', '0710662656', 'staff', 'Some_Place', 'try@trymail.com', ''),
(43, 'Monjore', 'Jarib', 'male', '2024-05-16', 'Izzzzzzzzzz', 'monte12', '2018-07-26', '98765', '0710662656', 'staff', 'Some_Place', 'try@trymail.com', ''),
(44, 'Kant', 'Jarib', 'male', '2021-09-16', 'kkp', 'izzo12', '2018-07-26', '0987', '0710662656', 'staff', 'Some_Place', 'try@trymail.com', 'Hydrangeas.jpg'),
(45, 'Mot', 'Jarib', 'male', '2025-07-18', 'tot', 'toto12', '2018-07-27', '8765', '0710662656', 'staff', 'Some_Place', 'try@trymail.com', 'Desert.jpg'),
(46, 'Mot', 'Jarib', 'male', '2027-07-18', 'toty', 'toto12', '2018-07-27', '8765', '0710662656', 'staff', 'Some_Place', 'try@trymail.com', 'Chrysanthemum.jpg'),
(47, 'Yellow', 'Tommy', 'Female', '2030-07-18', 'yellow', 'yellow1', '2018-07-30', '765', '0710662656', 'staff', 'Some_Place', 'try@trymail.com', 'Koalaa.jpg'),
(48, 'mtoo', 'k', 'Female', '2015-08-17', 'mtoot', 'mtot12', '2018-07-30', '567', '0720887878', 'staff', 'Some_Place', 'try@trymail.com', ''),
(49, 'Marige', 'Kimuntu', 'male', '2004-04-17', 'kimuntu', 'kimu12', '2018-07-31', '3456', '0734234234', 'staff', 'Some_Place', 'try@trymail.com', 'Tulipss.jpg'),
(50, 'Olop', 'Kyenge', 'male', '2021-05-18', 'olope', 'olop12', '2018-07-31', '432', '0721000999', 'staff', 'Some_Place', 'try@trymail.com', 'Hydrangeass.jpg'),
(51, 'Olop', 'Kyenge', 'male', '2031-07-18', 'olope2', 'olop12', '2018-07-31', '432', '0721000999', 'staff', 'Some_Place', 'try@trymail.com', 'Chrysanthemumy.jpg'),
(56, 'yu', 'ghj', 'male', '2011-12-17', 'qwe1', 'qwe123', '2018-08-02', '987', '0710662656', 'staff', 'Some_Place', 'try@trymail.com', 'Capture.PNG'),
(57, 'Yellow', 'Tommy', 'female', '2029-07-18', 'Izzo123', 'qwe123', '2018-08-02', '567', '0710662656', 'staff', 'Some_Place', 'try@trymail.com', 'Koalaa.jpg'),
(58, 'Yellow', 'Tommy', 'female', '2025-03-18', 'yee123', 'qwe123', '2018-08-02', '567', '0710662656', 'staff', 'Some_Place', 'try@trymail.com', 'Penguinss.jpg'),
(59, 'm', 'isaa', 'female', '2004-12-17', 'Izzo1234', 'mmu123', '2018-08-02', '567', '0710662656', 'staff', 'Some_Place', 'try@trymail.com', 'imei.PNG'),
(61, 'Yellow', 'isaa', 'female', '2004-06-18', 'qwe123', 'qwe123', '2018-08-02', '6543', '0710662656', 'staff', 'Some_Place', 'try@trymail.com', 'Capture.PNG'),
(62, 'm', 'isaa', 'female', '2014-05-18', 'ytrewq', 'qwe123', '2018-08-02', '54', '0710662656', 'staff', 'Some_Place', 'try@trymail.com', 'Capture.PNG'),
(63, 'd', 'g', 'female', '2003-08-18', 'sa2', 'qwe123', '2018-08-02', '567', '0710662656', 'staff', 'Some_Place', 'try@trymail.com', 'Capture.PNG'),
(64, 'm', 'isaa', 'female', '2013-03-18', 'gfdsa', 'qwe123', '2018-08-02', '567', '0710662656', 'staff', 'Some_Place', 'try@trymail.com', 'Capture.PNG'),
(65, 'Me', 'n', 'female', '2011-06-18', 'rewq', 'qwe123', '2018-08-03', '98', '0710662656', 'staff', 'Some_Place', 'try@trymail.com', 'Capture.PNG'),
(66, 'm', 'isaa', 'female', '2023-04-18', 'mmm123', 'mmm123', '2018-08-03', '567', '0710662656', 'staff', 'Some_Place', 'try@trymail.com', 'Capture.PNG'),
(67, 'M', 'N', 'female', '2015-01-07', 'N', 'MMM123', '2018-08-04', '24524567', '0710662656', 'staff', 'NAKS', 'itt.thuot@gmail.com', 'Penguinss.jpg'),
(68, 'ggg', 'kkjk', 'Female', '1994-02-02', 'tyu', 'qwe123', '2018-08-04', '678900', '0710662656', 'staff', 'NAKS', 'itt.thuot@gmail.com', 'Koalaa.jpg'),
(69, 'Yellow', 'isaa', 'Male', '2018-08-06', 'ddenno', 'qwe123', '2018-08-06', '567456', '0710662656', 'staff', 'NAKS', 'itt.thuot@gmail.com', 'EXAM TT.PNG'),
(71, 'Yellow', 'isaa', 'Female', '2018-08-08', 'Izzo12', 'qwe123', '2018-08-07', '567677', '0710662656', 'staff', 'NAKS', 'itt.thuot@gmail.com', 'Koalaa.png'),
(72, 'Yellow', 'isaa', 'Male', '2018-08-06', 'Izz12', 'qwe123', '2018-08-07', '30225698', '0710662656', 'staff', 'NAKS', 'itt.thuot@gmail.com', 'php.PNG'),
(73, 'm', 'n', 'Female', '2018-07-30', '6ytfc', 'qwe123', '2018-08-07', '30225698', '0710662656', 'staff', 'NAKS', 'itt.thuot@gmail.com', 'imei.PNG'),
(75, 'p', 'k', 'Male', '0000-00-00', 'k', 'mmm123', '2018-08-08', '30225698', '0722451745', 'staff', 'MMU', 'pk@yahoo.com', 'imei.PNG'),
(76, 'o', 'o', 'Female', '2018-08-07', 'kuria2', 'qwe123', '2018-08-08', '30225698', '0710662656', 'staff', 'MMU', 'itt.thuot@gmail.com', 'php.PNG'),
(77, 'John', 'Mwangi', 'Male', '2001-12-04', 'jon12', 'jon123', '2018-08-09', '30225698', '0710662656', 'staff', 'NAKS', 'itt.thuot@gmail.com', 'Capture.PNG'),
(78, 'Moses', 'Mwas', 'Male', '2001-11-27', 'mwa', 'mwa123', '2018-08-09', '30225698', '0710662656', 'staff', 'NAKS', 'itt.thuot@gmail.com', 'imei.PNG');

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
(1, 'spade', 100, 50),
(2, 'jembe', 250, 100),
(3, 'mattock', 500, 10),
(4, 'slasher', 150, 20),
(5, 'panga', 100, 100),
(7, 'sickle', 100, 30),
(8, 'hummer', 100, 2),
(9, 'Hoe', 20, 2);

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
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=167;

--
-- AUTO_INCREMENT for table `collection`
--
ALTER TABLE `collection`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT for table `collectionrate`
--
ALTER TABLE `collectionrate`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `m_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT for table `pay`
--
ALTER TABLE `pay`
  MODIFY `p_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `sms`
--
ALTER TABLE `sms`
  MODIFY `s_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `staff_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `tools`
--
ALTER TABLE `tools`
  MODIFY `t_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `wage`
--
ALTER TABLE `wage`
  MODIFY `w_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
