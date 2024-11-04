-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 31, 2024 at 07:14 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_ecozen`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(60) NOT NULL,
  `admin_email` varchar(60) NOT NULL,
  `admin_password` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`admin_id`, `admin_name`, `admin_email`, `admin_password`) VALUES
(11, 'Abhirami Santhosh', 'abhi@gmail.com', 'Abhi#123');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_booking`
--

CREATE TABLE `tbl_booking` (
  `booking_id` int(11) NOT NULL,
  `booking_status` int(11) NOT NULL DEFAULT 0,
  `booking_date` varchar(60) NOT NULL,
  `user_id` int(11) NOT NULL,
  `booking_amount` varchar(60) NOT NULL,
  `del_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_booking`
--

INSERT INTO `tbl_booking` (`booking_id`, `booking_status`, `booking_date`, `user_id`, `booking_amount`, `del_id`) VALUES
(23, 2, '2024-09-21', 2, '350', 1),
(24, 2, '2024-09-21', 2, '350', 0),
(25, 2, '2024-09-22', 2, '50', 0),
(26, 2, '2024-10-07', 12, '100', 0),
(27, 2, '2024-10-07', 12, '100', 0),
(28, 2, '2024-10-07', 2, '50', 0),
(29, 2, '2024-10-07', 2, '550', 1),
(30, 2, '2024-10-15', 5, '800', 3),
(31, 2, '2024-10-15', 5, '300', 0),
(32, 2, '2024-10-15', 2, '1050', 3),
(33, 2, '2024-10-15', 2, '150', 0),
(34, 2, '2024-10-17', 6, '500', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cart`
--

CREATE TABLE `tbl_cart` (
  `cart_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `cart_qty` int(11) NOT NULL DEFAULT 1,
  `cart_status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_cart`
--

INSERT INTO `tbl_cart` (`cart_id`, `product_id`, `booking_id`, `cart_qty`, `cart_status`) VALUES
(70, 47, 26, 1, 2),
(71, 47, 27, 1, 2),
(73, 56, 29, 1, 4),
(74, 55, 29, 1, 4),
(75, 52, 29, 1, 4),
(76, 58, 29, 2, 4),
(77, 46, 30, 3, 5),
(78, 48, 30, 1, 5),
(79, 51, 30, 3, 5),
(80, 57, 31, 1, 2),
(81, 47, 31, 1, 2),
(82, 55, 32, 5, 4),
(83, 58, 32, 1, 4),
(84, 52, 32, 7, 4),
(85, 52, 33, 1, 1),
(86, 51, 33, 1, 1),
(87, 59, 34, 1, 4),
(88, 56, 34, 1, 4),
(89, 47, 34, 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `category_id` int(60) NOT NULL,
  `category_name` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`category_id`, `category_name`) VALUES
(18, 'Vegetables'),
(19, 'Fruits'),
(20, 'Pulses');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_complaint`
--

CREATE TABLE `tbl_complaint` (
  `complaint_id` int(11) NOT NULL,
  `complaint_title` varchar(60) NOT NULL,
  `complaint_des` varchar(60) NOT NULL,
  `complaint_file` varchar(60) NOT NULL,
  `complaint_date` varchar(60) NOT NULL,
  `complaint_reply` varchar(60) NOT NULL,
  `complaint_rdate` varchar(60) NOT NULL,
  `complaint_status` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_complaint`
--

INSERT INTO `tbl_complaint` (`complaint_id`, `complaint_title`, `complaint_des`, `complaint_file`, `complaint_date`, `complaint_reply`, `complaint_rdate`, `complaint_status`, `product_id`, `user_id`) VALUES
(3, 'Not fresh fruits', 'not good', 'spinach.jpg', '2024-08-16', '', '', 0, 27, 2),
(4, 'Not fresh fruits', 'not good', 'im.gif', '2024-09-06', '', '', 0, 0, 2),
(5, 'Not fresh fruits', 'mnjh', 'Avacado.jpg', '2024-09-21', '', '', 0, 0, 2),
(6, '', '', '', '2024-09-21', '', '', 0, 0, 2),
(7, 'Not fresh fruitsaahhj', 'ajghhj', '', '2024-09-21', '', '', 0, 0, 2),
(8, '', '', '', '2024-09-21', '', '', 0, 0, 2),
(9, 'Not fresh fruits', 'shjghj', 'spinach.jpg', '2024-09-21', '', '', 0, 47, 2),
(10, 'Not fresh fruits', 'vghhjj', 'spinach.jpg', '2024-09-21', '', '', 0, 47, 2),
(11, 'Not fresh fruits', 'zbhhj', '', '2024-10-07', '', '', 0, 55, 2),
(12, 'Beetroot is damaged', 'the vegetable is not delivered as fresh', 'beetroot.jpg', '2024-10-17', '', '', 0, 59, 6);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_daily`
--

CREATE TABLE `tbl_daily` (
  `daily_id` int(11) NOT NULL,
  `daily_name` varchar(60) NOT NULL,
  `daily_type` varchar(60) NOT NULL,
  `daily_amt` varchar(60) NOT NULL,
  `daily_datetime` varchar(60) NOT NULL,
  `seller_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_daily`
--

INSERT INTO `tbl_daily` (`daily_id`, `daily_name`, `daily_type`, `daily_amt`, `daily_datetime`, `seller_id`) VALUES
(8, 'Pineapple', 'EXPENSE', '6000', '2024-07-20', 2),
(9, 'Spinach', 'EXPENSE', '3000', '2024-07-26', 2),
(10, 'Cauliflower', 'INCOME', '180', '2024-07-26 14:11:08', 2),
(11, 'Cauliflower', 'INCOME', '180', '2024-07-26 14:13:17', 2),
(12, 'Spinach', 'INCOME', '90', '2024-07-26 14:27:23', 3),
(13, 'Spinach', 'INCOME', '90', '2024-07-26 14:34:22', 3),
(14, 'Spinach', 'INCOME', '90', '2024-08-16 10:49:53', 3),
(15, 'Spinach', 'INCOME', '90', '2024-08-16 10:57:52', 3),
(16, 'Spinach', 'INCOME', '90', '2024-08-16 11:00:31', 3),
(17, 'Cauliflower', 'INCOME', '180', '2024-08-16 11:07:16', 2),
(18, 'Pineapple', 'INCOME', '90', '2024-08-16 11:09:02', 4),
(19, 'Spinach', 'INCOME', '45', '2024-09-17 11:29:16', 3),
(20, 'Spinach', 'INCOME', '45', '2024-09-17 11:33:44', 3),
(21, 'Spinach', 'INCOME', '45', '2024-09-21 10:24:43', 3),
(22, 'Spinach', 'INCOME', '90', '2024-09-21 11:40:40', 3),
(23, 'Spinach', 'INCOME', '90', '2024-09-21 13:03:30', 3),
(24, 'Spinach', 'INCOME', '90', '2024-09-22 11:21:54', 3),
(25, 'Spinach', 'INCOME', '90', '2024-10-07', 3),
(26, 'Spinach', 'INCOME', '90', '2024-10-07', 3),
(27, 'Spinach', 'INCOME', '90', '2024-10-07', 3),
(28, 'Spinach', 'INCOME', '90', '2024-10-07', 3),
(29, 'Spinach', 'INCOME', '90', '2024-10-07', 3),
(30, 'Potato', 'INCOME', '45', '2024-10-07', 0),
(31, 'Spinach', 'INCOME', '90', '2024-10-07', 3),
(32, 'Spinach', 'INCOME', '90', '2024-10-07', 3),
(33, 'Potato', 'INCOME', '45', '2024-10-07', 0),
(34, 'Sweet potato', 'INCOME', '180', '2024-10-07', 0),
(35, 'Potato', 'INCOME', '45', '2024-10-07', 0),
(36, 'Cabbage', 'INCOME', '90', '2024-10-07', 0),
(37, 'Carrot', 'INCOME', '180', '2024-10-07', 0),
(38, 'Spinach', 'INCOME', '90', '2024-10-15', 3),
(39, 'Spinach', 'INCOME', '90', '2024-10-15', 3),
(40, 'Sweet potato', 'INCOME', '180', '2024-10-15', 3),
(41, 'Potato', 'INCOME', '45', '2024-10-15', 3),
(42, 'Cabbage', 'INCOME', '90', '2024-10-15', 3),
(43, 'Carrot', 'INCOME', '180', '2024-10-15', 3),
(44, 'Strawberry', 'INCOME', '540', '2024-10-15', 3),
(45, 'Pineapple', 'INCOME', '45', '2024-10-15', 3),
(46, 'Spring onion', 'INCOME', '135', '2024-10-15', 3),
(47, 'Spinach', 'INCOME', '90', '2024-10-15', 3),
(48, 'Spinach', 'INCOME', '90', '2024-10-15', 3),
(49, 'Sweet potato', 'INCOME', '180', '2024-10-15', 3),
(50, 'Potato', 'INCOME', '45', '2024-10-15', 3),
(51, 'Cabbage', 'INCOME', '90', '2024-10-15', 3),
(52, 'Carrot', 'INCOME', '180', '2024-10-15', 3),
(53, 'Strawberry', 'INCOME', '540', '2024-10-15', 3),
(54, 'Pineapple', 'INCOME', '45', '2024-10-15', 3),
(55, 'Spring onion', 'INCOME', '135', '2024-10-15', 3),
(56, 'Ginger', 'INCOME', '180', '2024-10-15', 3),
(57, 'Spinach', 'INCOME', '90', '2024-10-15', 3),
(58, 'Spinach', 'INCOME', '90', '2024-10-15', 3),
(59, 'Spinach', 'INCOME', '90', '2024-10-15', 3),
(60, 'Sweet potato', 'INCOME', '180', '2024-10-15', 3),
(61, 'Potato', 'INCOME', '45', '2024-10-15', 3),
(62, 'Cabbage', 'INCOME', '90', '2024-10-15', 3),
(63, 'Carrot', 'INCOME', '180', '2024-10-15', 3),
(64, 'Strawberry', 'INCOME', '540', '2024-10-15', 3),
(65, 'Pineapple', 'INCOME', '45', '2024-10-15', 3),
(66, 'Spring onion', 'INCOME', '135', '2024-10-15', 3),
(67, 'Ginger', 'INCOME', '180', '2024-10-15', 3),
(68, 'Spinach', 'INCOME', '90', '2024-10-15', 3),
(69, 'Potato', 'INCOME', '225', '2024-10-15', 3),
(70, 'Carrot', 'INCOME', '90', '2024-10-15', 3),
(71, 'Cabbage', 'INCOME', '630', '2024-10-15', 3),
(72, 'Spinach', 'INCOME', '90', '2024-10-15', 3),
(73, 'Spinach', 'INCOME', '90', '2024-10-15', 3),
(74, 'Sweet potato', 'INCOME', '180', '2024-10-15', 3),
(75, 'Potato', 'INCOME', '45', '2024-10-15', 3),
(76, 'Cabbage', 'INCOME', '90', '2024-10-15', 3),
(77, 'Carrot', 'INCOME', '180', '2024-10-15', 3),
(78, 'Strawberry', 'INCOME', '540', '2024-10-15', 3),
(79, 'Pineapple', 'INCOME', '45', '2024-10-15', 3),
(80, 'Spring onion', 'INCOME', '135', '2024-10-15', 3),
(81, 'Ginger', 'INCOME', '180', '2024-10-15', 3),
(82, 'Spinach', 'INCOME', '90', '2024-10-15', 3),
(83, 'Potato', 'INCOME', '225', '2024-10-15', 3),
(84, 'Carrot', 'INCOME', '90', '2024-10-15', 3),
(85, 'Cabbage', 'INCOME', '630', '2024-10-15', 3),
(86, 'Cabbage', 'INCOME', '90', '2024-10-15', 3),
(87, 'Spring onion', 'INCOME', '45', '2024-10-15', 3),
(88, 'Spinach', 'INCOME', '90', '2024-10-15', 3),
(89, 'Spinach', 'INCOME', '90', '2024-10-15', 3),
(90, 'Sweet potato', 'INCOME', '180', '2024-10-15', 3),
(91, 'Potato', 'INCOME', '45', '2024-10-15', 3),
(92, 'Cabbage', 'INCOME', '90', '2024-10-15', 3),
(93, 'Carrot', 'INCOME', '180', '2024-10-15', 3),
(94, 'Strawberry', 'INCOME', '540', '2024-10-15', 3),
(95, 'Pineapple', 'INCOME', '45', '2024-10-15', 3),
(96, 'Spring onion', 'INCOME', '135', '2024-10-15', 3),
(97, 'Ginger', 'INCOME', '180', '2024-10-15', 3),
(98, 'Spinach', 'INCOME', '90', '2024-10-15', 3),
(99, 'Potato', 'INCOME', '225', '2024-10-15', 3),
(100, 'Carrot', 'INCOME', '90', '2024-10-15', 3),
(101, 'Cabbage', 'INCOME', '630', '2024-10-15', 3),
(102, 'Cabbage', 'INCOME', '90', '2024-10-15', 3),
(103, 'Spring onion', 'INCOME', '45', '2024-10-15', 3),
(104, 'Spinach', 'INCOME', '90', '2024-10-15', 3),
(105, 'Spinach', 'INCOME', '90', '2024-10-15', 3),
(106, 'Sweet potato', 'INCOME', '180', '2024-10-15', 3),
(107, 'Potato', 'INCOME', '45', '2024-10-15', 3),
(108, 'Cabbage', 'INCOME', '90', '2024-10-15', 3),
(109, 'Carrot', 'INCOME', '180', '2024-10-15', 3),
(110, 'Strawberry', 'INCOME', '540', '2024-10-15', 3),
(111, 'Pineapple', 'INCOME', '45', '2024-10-15', 3),
(112, 'Spring onion', 'INCOME', '135', '2024-10-15', 3),
(113, 'Ginger', 'INCOME', '180', '2024-10-15', 3),
(114, 'Spinach', 'INCOME', '90', '2024-10-15', 3),
(115, 'Potato', 'INCOME', '225', '2024-10-15', 3),
(116, 'Carrot', 'INCOME', '90', '2024-10-15', 3),
(117, 'Cabbage', 'INCOME', '630', '2024-10-15', 3),
(118, 'Cabbage', 'INCOME', '90', '2024-10-15', 3),
(119, 'Spring onion', 'INCOME', '45', '2024-10-15', 3),
(120, 'Spinach', 'INCOME', '90', '2024-10-15', 3),
(121, 'Spinach', 'INCOME', '90', '2024-10-15', 3),
(122, 'Sweet potato', 'INCOME', '180', '2024-10-15', 3),
(123, 'Potato', 'INCOME', '45', '2024-10-15', 3),
(124, 'Cabbage', 'INCOME', '90', '2024-10-15', 3),
(125, 'Carrot', 'INCOME', '180', '2024-10-15', 3),
(126, 'Strawberry', 'INCOME', '540', '2024-10-15', 3),
(127, 'Pineapple', 'INCOME', '45', '2024-10-15', 3),
(128, 'Spring onion', 'INCOME', '135', '2024-10-15', 3),
(129, 'Ginger', 'INCOME', '180', '2024-10-15', 3),
(130, 'Spinach', 'INCOME', '90', '2024-10-15', 3),
(131, 'Potato', 'INCOME', '225', '2024-10-15', 3),
(132, 'Carrot', 'INCOME', '90', '2024-10-15', 3),
(133, 'Cabbage', 'INCOME', '630', '2024-10-15', 3),
(134, 'Cabbage', 'INCOME', '90', '2024-10-15', 3),
(135, 'Spring onion', 'INCOME', '45', '2024-10-15', 3),
(136, 'Spinach', 'INCOME', '90', '2024-10-15', 3),
(137, 'Spinach', 'INCOME', '90', '2024-10-15', 3),
(138, 'Sweet potato', 'INCOME', '180', '2024-10-15', 3),
(139, 'Potato', 'INCOME', '45', '2024-10-15', 3),
(140, 'Cabbage', 'INCOME', '90', '2024-10-15', 3),
(141, 'Carrot', 'INCOME', '180', '2024-10-15', 3),
(142, 'Strawberry', 'INCOME', '540', '2024-10-15', 3),
(143, 'Pineapple', 'INCOME', '45', '2024-10-15', 3),
(144, 'Spring onion', 'INCOME', '135', '2024-10-15', 3),
(145, 'Ginger', 'INCOME', '180', '2024-10-15', 3),
(146, 'Spinach', 'INCOME', '90', '2024-10-15', 3),
(147, 'Potato', 'INCOME', '225', '2024-10-15', 3),
(148, 'Carrot', 'INCOME', '90', '2024-10-15', 3),
(149, 'Cabbage', 'INCOME', '630', '2024-10-15', 3),
(150, 'Cabbage', 'INCOME', '90', '2024-10-15', 3),
(151, 'Spring onion', 'INCOME', '45', '2024-10-15', 3),
(152, 'Spinach', 'INCOME', '90', '2024-10-17', 3),
(153, 'Spinach', 'INCOME', '90', '2024-10-17', 3),
(154, 'Sweet potato', 'INCOME', '180', '2024-10-17', 3),
(155, 'Potato', 'INCOME', '45', '2024-10-17', 3),
(156, 'Cabbage', 'INCOME', '90', '2024-10-17', 3),
(157, 'Carrot', 'INCOME', '180', '2024-10-17', 3),
(158, 'Strawberry', 'INCOME', '540', '2024-10-17', 3),
(159, 'Pineapple', 'INCOME', '45', '2024-10-17', 3),
(160, 'Spring onion', 'INCOME', '135', '2024-10-17', 3),
(161, 'Ginger', 'INCOME', '180', '2024-10-17', 3),
(162, 'Spinach', 'INCOME', '90', '2024-10-17', 3),
(163, 'Potato', 'INCOME', '225', '2024-10-17', 3),
(164, 'Carrot', 'INCOME', '90', '2024-10-17', 3),
(165, 'Cabbage', 'INCOME', '630', '2024-10-17', 3),
(166, 'Cabbage', 'INCOME', '90', '2024-10-17', 3),
(167, 'Spring onion', 'INCOME', '45', '2024-10-17', 3),
(168, 'Beetroot', 'INCOME', '180', '2024-10-17', 3),
(169, 'Sweet potato', 'INCOME', '180', '2024-10-17', 3),
(170, 'Spinach', 'INCOME', '90', '2024-10-17', 3),
(171, 'Spinach', 'INCOME', '90', '2024-10-17', 3),
(172, 'Spinach', 'INCOME', '90', '2024-10-17', 3),
(173, 'Sweet potato', 'INCOME', '180', '2024-10-17', 3),
(174, 'Potato', 'INCOME', '45', '2024-10-17', 3),
(175, 'Cabbage', 'INCOME', '90', '2024-10-17', 3),
(176, 'Carrot', 'INCOME', '180', '2024-10-17', 3),
(177, 'Strawberry', 'INCOME', '540', '2024-10-17', 3),
(178, 'Pineapple', 'INCOME', '45', '2024-10-17', 3),
(179, 'Spring onion', 'INCOME', '135', '2024-10-17', 3),
(180, 'Ginger', 'INCOME', '180', '2024-10-17', 3),
(181, 'Spinach', 'INCOME', '90', '2024-10-17', 3),
(182, 'Potato', 'INCOME', '225', '2024-10-17', 3),
(183, 'Carrot', 'INCOME', '90', '2024-10-17', 3),
(184, 'Cabbage', 'INCOME', '630', '2024-10-17', 3),
(185, 'Cabbage', 'INCOME', '90', '2024-10-17', 3),
(186, 'Spring onion', 'INCOME', '45', '2024-10-17', 3),
(187, 'Beetroot', 'INCOME', '180', '2024-10-17', 3),
(188, 'Sweet potato', 'INCOME', '180', '2024-10-17', 3),
(189, 'Spinach', 'INCOME', '90', '2024-10-17', 3);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_del_agent`
--

CREATE TABLE `tbl_del_agent` (
  `del_id` int(11) NOT NULL,
  `del_name` varchar(60) NOT NULL,
  `del_contact` varchar(60) NOT NULL,
  `del_email` varchar(100) NOT NULL,
  `del_proof` varchar(60) NOT NULL,
  `del_status` int(11) NOT NULL,
  `place_id` int(11) NOT NULL,
  `del_gender` varchar(60) NOT NULL,
  `del_image` varchar(60) NOT NULL,
  `del_password` varchar(60) NOT NULL,
  `del_availability` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_del_agent`
--

INSERT INTO `tbl_del_agent` (`del_id`, `del_name`, `del_contact`, `del_email`, `del_proof`, `del_status`, `place_id`, `del_gender`, `del_image`, `del_password`, `del_availability`) VALUES
(1, 'Agnivesh', '9646567686', 'agnivesh@gmail.com', 'person.jpg', 1, 17, 'Male', 'person.jpg', 'agniv', 0),
(2, 'Akash', '8590501136', 'ashokmenon@gmail.com', 'cities.jpg', 0, 14, 'Male', 'cities.jpg', 'A@m5', 1),
(3, 'Dhyan', '9293450068', 'dhyan@gmail.com', 'cities.jpg', 0, 17, 'Male', 'cities.jpg', 'd@%nn', 0),
(4, 'Ajo Joseph', '9293450068', 'ajo237@gmail.com', 'Screenshot (1).png', 0, 17, 'Male', 'Screenshot (1).png', 'Ajo237', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_district`
--

CREATE TABLE `tbl_district` (
  `district_id` int(11) NOT NULL,
  `district_name` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_district`
--

INSERT INTO `tbl_district` (`district_id`, `district_name`) VALUES
(25, 'Palakkad'),
(27, 'Trivandram'),
(29, 'Ernakulam'),
(31, 'Kollam');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_location`
--

CREATE TABLE `tbl_location` (
  `location_id` int(11) NOT NULL,
  `location_name` varchar(60) NOT NULL,
  `place_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_location`
--

INSERT INTO `tbl_location` (`location_id`, `location_name`, `place_id`) VALUES
(10, 'Keecheripady', 17),
(12, 'Kadathy', 17),
(13, 'Puthenkurizz', 17),
(14, 'Marady', 17);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_place`
--

CREATE TABLE `tbl_place` (
  `place_id` int(60) NOT NULL,
  `place_name` varchar(60) NOT NULL,
  `place_pincode` varchar(60) NOT NULL,
  `district_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_place`
--

INSERT INTO `tbl_place` (`place_id`, `place_name`, `place_pincode`, `district_id`) VALUES
(13, 'Kanyakumari', '687780', 27),
(14, 'chittur', '667800', 25),
(15, 'East Port', '687780', 27),
(16, 'Manarkkad', '667800', 25),
(17, 'Muvattupuzha', '686665', 29),
(18, 'Kakkanad', '677709', 29);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE `tbl_product` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(60) NOT NULL,
  `product_price` int(11) NOT NULL,
  `product_details` varchar(60) NOT NULL,
  `subcategory_id` int(11) NOT NULL,
  `product_image` varchar(100) NOT NULL,
  `seller_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`product_id`, `product_name`, `product_price`, `product_details`, `subcategory_id`, `product_image`, `seller_id`) VALUES
(43, '', 0, '', 0, '', 3),
(44, '', 0, '', 0, '', 3),
(45, '', 0, '', 0, '', 3),
(46, 'Strawberry', 200, '1 kg', 21, 'Strawberry.jpg', 3),
(47, 'Spinach', 100, '2 kg', 19, 'spinach.jpg', 3),
(48, 'Pineapple', 50, '2 kg', 14, 'q6hvGbMQgw34LnEvebYQd8.jpg', 3),
(49, '', 0, '', 0, '', 3),
(50, 'Argula', 200, '1 kg', 19, 'argula.jpg', 3),
(51, 'Spring onion', 50, '2 kg', 19, 'spring_onion.jpg', 3),
(52, 'Cabbage', 100, '2 kg', 19, 'cabbage.jpg', 3),
(53, 'Coriander leaves', 200, '1 kg', 19, 'coriander_leaves.jpg', 3),
(54, 'Mustard greens', 300, '1 kg', 19, 'mustard_greens.jpg', 3),
(55, 'Potato', 50, '1 kg', 12, 'potato.jpg', 3),
(56, 'Sweet potato', 200, '2 kg', 12, 'sweet_potato.jpg', 3),
(57, 'Ginger', 200, '1 kg', 12, 'ginger.jpg', 3),
(58, 'Carrot', 100, '1 kg', 12, 'carrot.jpg', 3),
(59, 'Beetroot', 200, '1 kg', 12, 'beetroot.jpg', 3),
(60, 'Strawberry', 100, '1kg', 21, 'Strawberry.jpg', 3),
(61, 'Potato', 200, '2kg', 12, 'potato.jpg', 4);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_rating`
--

CREATE TABLE `tbl_rating` (
  `rating_id` int(11) NOT NULL,
  `rating_value` varchar(60) NOT NULL,
  `user_id` int(11) NOT NULL,
  `seller_id` int(11) NOT NULL,
  `rating_content` varchar(60) NOT NULL,
  `rating_datetime` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_rating`
--

INSERT INTO `tbl_rating` (`rating_id`, `rating_value`, `user_id`, `seller_id`, `rating_content`, `rating_datetime`) VALUES
(1, '1', 2, 3, 'good\n', '2024-10-17 13:53:28'),
(2, '3', 5, 3, 'good\n', '2024-10-15 14:28:07');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_seller`
--

CREATE TABLE `tbl_seller` (
  `seller_id` int(11) NOT NULL,
  `seller_name` varchar(60) NOT NULL,
  `seller_contact` varchar(60) NOT NULL,
  `seller_email` varchar(100) NOT NULL,
  `seller_proof` varchar(60) NOT NULL,
  `seller_status` int(11) NOT NULL DEFAULT 0,
  `place_id` int(11) NOT NULL,
  `seller_gender` varchar(60) NOT NULL,
  `seller_image` varchar(60) NOT NULL,
  `seller_password` varchar(60) NOT NULL,
  `seller_address` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_seller`
--

INSERT INTO `tbl_seller` (`seller_id`, `seller_name`, `seller_contact`, `seller_email`, `seller_proof`, `seller_status`, `place_id`, `seller_gender`, `seller_image`, `seller_password`, `seller_address`) VALUES
(2, 'Anagha Suresh', '9646567686', 'naturennnnn076@gmail.com', 'cities.jpg', 2, 14, 'Female', 'flower.jpg', 'anagha', ''),
(3, 'Anirudh M.J', '987090567', 'abhiramisanthosh51@gmail.com', 'images.gif', 1, 15, 'Female', 'im.gif', 'abhirami', ''),
(4, 'Sahya A.S', '8899007760', 'dairyproduct638@gmail.com', 'city.jpg', 1, 14, 'Female', 'city.jpg', 'sahya', ''),
(9, 'Tom', 'aswe', '9870905671', 'person.jpg', 1, 13, 'Male', 'person.jpg', 'tom#123$', 'tom@gmail.com'),
(10, 'Tom', 'aswq', '9646567686', 'person.jpg', 1, 13, 'Male', 'person.jpg', 'tom#123@', 'tom@gmail.com'),
(11, 'Swagath Kumar', 'Swagathalay (h)', '8590501136', 'person.jpg', 1, 17, 'Male', 'person.jpg', 'Swa#123', 'swagatht638@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_stock`
--

CREATE TABLE `tbl_stock` (
  `stock_id` int(11) NOT NULL,
  `stock_date` date NOT NULL,
  `stock_qty` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_stock`
--

INSERT INTO `tbl_stock` (`stock_id`, `stock_date`, `stock_qty`, `product_id`) VALUES
(16, '2024-09-17', 10, 35),
(17, '2024-09-17', 10, 34),
(18, '2024-09-17', 10, 36),
(19, '2024-09-21', 20, 47),
(20, '2024-09-21', 20, 46),
(21, '2024-09-21', 20, 48),
(22, '2024-10-02', 20, 59),
(23, '2024-10-02', 20, 58),
(24, '2024-10-02', 20, 57),
(25, '2024-10-02', 20, 56),
(26, '2024-10-02', 20, 55),
(27, '2024-10-02', 20, 54),
(29, '2024-10-02', 20, 0),
(30, '2024-10-02', 20, 52),
(31, '2024-10-02', 20, 51);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_subcategory`
--

CREATE TABLE `tbl_subcategory` (
  `subcategory_id` int(11) NOT NULL,
  `subcategory_name` varchar(60) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_subcategory`
--

INSERT INTO `tbl_subcategory` (`subcategory_id`, `subcategory_name`, `category_id`) VALUES
(6, 'kollam', 3),
(7, 'Ernakulam', 3),
(8, 'SmartPhone', 11),
(9, 'Bluetooth Headset', 12),
(10, 'Laptop', 14),
(11, 'Smartwatch', 17),
(12, 'Tubers', 18),
(14, 'Seedless fruits', 19),
(15, 'Seeded Fruits', 19),
(16, 'marrow', 18),
(17, 'allium', 18),
(18, 'Cruciferous', 18),
(19, 'Leafy Green', 18),
(20, 'Edible plant stem', 18),
(21, 'Berries', 19),
(22, 'Dry Fruits', 19),
(23, 'Beans', 20),
(24, 'Peas', 20);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(150) NOT NULL,
  `user_gender` varchar(60) NOT NULL,
  `user_contact` varchar(60) NOT NULL,
  `user_email` varchar(60) NOT NULL,
  `user_password` varchar(60) NOT NULL,
  `user_image` varchar(60) NOT NULL,
  `user_proof` varchar(60) NOT NULL,
  `place_id` int(11) NOT NULL,
  `user_address` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `user_name`, `user_gender`, `user_contact`, `user_email`, `user_password`, `user_image`, `user_proof`, `place_id`, `user_address`) VALUES
(2, 'Ram Govind', 'Male', '9646567686', 'ram@gmail.com', 'ram', 'cities.jpg', 'cities.jpg', 14, ''),
(3, 'Avinash  S Kumar', 'Male', '888907890', 'avinash@gmail.com', 'avinash', 'cities.jpg', 'cities.jpg', 14, ''),
(4, 'Arun Menon', 'Male', '9646567686', 'sirsociallogin@gmail.com', 'social', 'cities.jpg', 'cities.jpg', 15, ''),
(5, 'Ashok Sreevastha', 'Male', '8899007760', 'ashok@gmail.com', 'ashok', 'cities.jpg', 'person.jpg', 13, ''),
(6, 'Aravind Kumar', 'Male', '9293450068', 'dairyproduct638@gmail.com', 'dairy', 'flower.jpg', 'person.jpg', 15, ''),
(7, 'Anena', 'female', '8590501136', 'anenabenny11@gmail.com', 'Rose12rs', 'cities.jpg', 'cities.jpg', 17, ''),
(10, 'Tom', 'Male', '9646567686', 'tom@gmail.com', 'Arun#123', 'pic.jpg', 'person.jpg', 17, ''),
(11, 'Arun', 'Male', '9870905601', 'arun21@gmail.com', 'Arun#123', 'pic.jpg', 'person.jpg', 17, ''),
(12, 'JohnAbraham', 'Male', '9293450068', 'John123@gmail.com', 'John#123', 'pic.jpg', 'person.jpg', 17, ''),
(13, 'Sahin A.S', 'Male', '8590501136', 'sahin@gmail.com', 'Sahin@23', 'person.jpg', 'cities.jpg', 17, ''),
(14, 'Arun S', 'Male', '8590501136', 'arun@gmail.com', 'Arun@123', 'person.jpg', 'person.jpg', 17, ''),
(17, 'Abhirami Santhosh', 'Female', '9646567686', 'navendunandu@gmail.com', 'Abhi#123', 'person.jpg', '', 17, 'dfgh');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `tbl_booking`
--
ALTER TABLE `tbl_booking`
  ADD PRIMARY KEY (`booking_id`);

--
-- Indexes for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `tbl_complaint`
--
ALTER TABLE `tbl_complaint`
  ADD PRIMARY KEY (`complaint_id`);

--
-- Indexes for table `tbl_daily`
--
ALTER TABLE `tbl_daily`
  ADD PRIMARY KEY (`daily_id`);

--
-- Indexes for table `tbl_del_agent`
--
ALTER TABLE `tbl_del_agent`
  ADD PRIMARY KEY (`del_id`);

--
-- Indexes for table `tbl_district`
--
ALTER TABLE `tbl_district`
  ADD PRIMARY KEY (`district_id`);

--
-- Indexes for table `tbl_location`
--
ALTER TABLE `tbl_location`
  ADD PRIMARY KEY (`location_id`);

--
-- Indexes for table `tbl_place`
--
ALTER TABLE `tbl_place`
  ADD PRIMARY KEY (`place_id`);

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `tbl_rating`
--
ALTER TABLE `tbl_rating`
  ADD PRIMARY KEY (`rating_id`);

--
-- Indexes for table `tbl_seller`
--
ALTER TABLE `tbl_seller`
  ADD PRIMARY KEY (`seller_id`);

--
-- Indexes for table `tbl_stock`
--
ALTER TABLE `tbl_stock`
  ADD PRIMARY KEY (`stock_id`);

--
-- Indexes for table `tbl_subcategory`
--
ALTER TABLE `tbl_subcategory`
  ADD PRIMARY KEY (`subcategory_id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_booking`
--
ALTER TABLE `tbl_booking`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `category_id` int(60) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tbl_complaint`
--
ALTER TABLE `tbl_complaint`
  MODIFY `complaint_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_daily`
--
ALTER TABLE `tbl_daily`
  MODIFY `daily_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=190;

--
-- AUTO_INCREMENT for table `tbl_del_agent`
--
ALTER TABLE `tbl_del_agent`
  MODIFY `del_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_district`
--
ALTER TABLE `tbl_district`
  MODIFY `district_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `tbl_location`
--
ALTER TABLE `tbl_location`
  MODIFY `location_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_place`
--
ALTER TABLE `tbl_place`
  MODIFY `place_id` int(60) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `tbl_rating`
--
ALTER TABLE `tbl_rating`
  MODIFY `rating_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_seller`
--
ALTER TABLE `tbl_seller`
  MODIFY `seller_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_stock`
--
ALTER TABLE `tbl_stock`
  MODIFY `stock_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `tbl_subcategory`
--
ALTER TABLE `tbl_subcategory`
  MODIFY `subcategory_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
