-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 01, 2020 at 02:42 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `khodroyab`
--

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

CREATE TABLE `cars` (
  `id` int(11) NOT NULL,
  `dealerid` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) DEFAULT NULL,
  `color` varchar(255) DEFAULT NULL,
  `cartype` int(11) NOT NULL DEFAULT '1',
  `image` varchar(255) NOT NULL DEFAULT '',
  `price` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`id`, `dealerid`, `name`, `color`, `cartype`, `image`, `price`, `status`) VALUES
(1, 23, 'پیکان', ' سفید', 1, '1606356077_7875902.jpg', 15000, 1),
(2, 23, 'پراید222', 'مشکی', 2, '1606356064_367843.jpg', 500, 1),
(3, 23, 'پژو 206', 'نقره ای', 1, '', 300000, 1),
(5, 23, 'دوج', 'قرمز', 1, '1606353879_7250082.jpg', 10002, 0),
(6, 23, 'بنز', 'سفید', 2, '', 5000000, 1),
(7, 24, 'سمند', 'وانیلی', 2, '1606368450_7176582.jpg', 15000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(15) NOT NULL,
  `authorname` tinytext CHARACTER SET utf8 COLLATE utf8_persian_ci,
  `authoremail` tinytext CHARACTER SET utf8 COLLATE utf8_persian_ci,
  `authortell` tinytext CHARACTER SET utf8 COLLATE utf8_persian_ci,
  `subject` tinytext CHARACTER SET utf8 COLLATE utf8_persian_ci,
  `content` text CHARACTER SET utf8 COLLATE utf8_persian_ci,
  `read` int(2) NOT NULL DEFAULT '0' COMMENT '0:unread/1:read',
  `reply` int(2) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `authorname`, `authoremail`, `authortell`, `subject`, `content`, `read`, `reply`) VALUES
(5, 'Mohammadreza Goudarzi', 'test@test.com', '', 'for test', 'testi', 1, 0),
(7, 'sss', 'neghab6@gmail.com', '09398189268', 'ss', 'sss', 1, 0),
(9, 'محمد محمدی', 'eee@dsf.dddddddddd', '09999999', 'تست ارتباط', 'dfsdsf', 0, 0),
(10, '09999999999', 'eee@dsf.dddddddddd', '09999999', 'تست تیکت', 'dsfsdaf', 0, 0),
(11, 'سامان استقلالی', 'test@test.com', '09999999', 'dfg', 'fdgx', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `carid` int(11) NOT NULL DEFAULT '0',
  `userid` int(11) NOT NULL DEFAULT '0',
  `dealerid` int(11) NOT NULL DEFAULT '0',
  `days` int(11) NOT NULL DEFAULT '0',
  `delivery` int(11) NOT NULL DEFAULT '1',
  `lat` varchar(255) DEFAULT NULL,
  `lng` varchar(255) DEFAULT NULL,
  `time_start` int(11) NOT NULL DEFAULT '0',
  `time_expire` int(11) NOT NULL DEFAULT '0',
  `payment_price` int(11) NOT NULL DEFAULT '0',
  `payment_details` varchar(255) DEFAULT NULL,
  `payment_status` int(11) NOT NULL DEFAULT '0',
  `settlement` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `carid`, `userid`, `dealerid`, `days`, `delivery`, `lat`, `lng`, `time_start`, `time_expire`, `payment_price`, `payment_details`, `payment_status`, `settlement`) VALUES
(3, 5, 23, 23, 15, 1, NULL, NULL, 1606363219, 1607659219, 150030, NULL, 0, 0),
(4, 1, 23, 23, 10, 1, NULL, NULL, 1606363934, 1607227934, 150000, 'bank melli 154154', 1, 0),
(5, 7, 23, 24, 10, 1, NULL, NULL, 1606371656, 1607235656, 150000, NULL, 0, 0),
(6, 3, 23, 23, 30, 1, NULL, NULL, 1606373395, 1608965395, 9000000, NULL, 0, 0),
(7, 7, 23, 24, 3, 1, NULL, NULL, 1606373427, 1606632627, 45000, 'زرین پال 54154154', 1, 0),
(8, 5, 23, 23, 2, 2, NULL, NULL, 1606442273, 1606615073, 20004, NULL, 0, 0),
(9, 3, 24, 23, 15, 2, NULL, NULL, 1606796346, 1608092346, 4525000, NULL, 0, 0),
(14, 3, 24, 23, 10, 2, '35.64530023951242', '51.43352508544922', 1606797448, 1607661448, 3025000, NULL, 0, 0),
(15, 3, 24, 23, 15, 2, '29.5830116903775', '52.53662109375', 1606797883, 1608093883, 4525000, NULL, 0, 0),
(16, 3, 24, 23, 12, 2, '0', '0', 1606797896, 1607834696, 3625000, NULL, 1, 1),
(22, 2, 24, 23, 2, 1, '0', '0', 1606829624, 1607002424, 26000, NULL, 0, 0),
(23, 2, 24, 23, 2, 1, '0', '0', 1606829772, 1607002572, 1000, NULL, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL DEFAULT '1',
  `setting_title` varchar(255) DEFAULT NULL,
  `setting_hometitle` varchar(255) DEFAULT NULL,
  `site_description` varchar(255) DEFAULT NULL,
  `site_keywords` varchar(255) DEFAULT NULL,
  `metatags` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `whatsapp` varchar(255) DEFAULT NULL,
  `admin_email` varchar(255) DEFAULT NULL,
  `free_send` int(11) DEFAULT '0',
  `sms_user` varchar(255) DEFAULT NULL,
  `sms_pass` varchar(255) DEFAULT NULL,
  `ipg_merchant` varchar(255) DEFAULT NULL,
  `static_about` text,
  `static_help` text,
  `static_contact` text,
  `help_pardakht` text,
  `help_pardakht_course` text,
  `text_dashboard` text,
  `text_dashboard2` text,
  `enamad` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `setting_title`, `setting_hometitle`, `site_description`, `site_keywords`, `metatags`, `address`, `phone`, `whatsapp`, `admin_email`, `free_send`, `sms_user`, `sms_pass`, `ipg_merchant`, `static_about`, `static_help`, `static_contact`, `help_pardakht`, `help_pardakht_course`, `text_dashboard`, `text_dashboard2`, `enamad`) VALUES
(1, 'خودرویاب', 'اجاره خودرو', 'دیسکریپشن', 'کیوووردها', '', 'آدرس آدرس آدرس آدرس آدرس آدرس آدرس آدردرس آدرس آدرس', '021-55665566', '', 'info@folan.com', 500000, 'fhg', 'hfhfh', 'ggggggggggggggggggggx', '<p class=\"ql-align-right\">دربارههههههههه ما دربارههههههههه ما دربارههههههههه ما دربارههههههههه ما دربارههههههههه ما دربارههههههههه ما دربارههههههههه ما دربارههههههههه ما دربارههههههههه ما دربارههههههههه ما دربارههههههههه ما دربارههههههههه ما دربارههههههههه ما دربارههههههههه ما دربارههههههههه ما دربارههههههههه ما دربارههههههههه ما دربارههههههههه ما دربارههههههههه ما دربارههههههههه ما دربارههههههههه ما دربارههههههههه ما دربارههههههههه ما دربارههههههههه ما دربارههههههههه ما دربارههههههههه ما دربارههههههههه ما دربارههههههههه ما دربارههههههههه ما دربارههههههههه ما دربارههههههههه ما دربارههههههههه ما </p>', '<p>قوانین قوانین قوانین</p>', '<p>تماس با ما تماس با ما تماس با ما تماس با ما تماس با ما تماس با ما تماس با ما تماس با ما تماس با ما تماس با ما تماسما تماس با ما تماس با ما تماس با ما تماس با ما تماس با ما تماس با ما تماس با ما تماس با ما تماس با ما تماس با ما تماس با</p><p>ما تماس با ما تماس با ما تماس با ما تماس با ما تماس با ما تماس با ما تماس با ما تماس با ما تماس با ما تماس با ما تماس با ما ت</p><p>ماس با ما تماس با ما تماس با ما تماس با ما تماس با ما تماس با ما تماس با ما تماس با ما تماس با ما تماس با ما تماس با مای</p><p><br></p>', 'محلی برای اجاره خودرو', '<p>راهنمای پرداخت دستی</p><p>راهنمای پرداخت دستیراهنمای پرداخت دستی</p><p>راهنمای پرداخت دستیراهنمای پرداخت دستیراهنمای پرداخت دستی</p><p>راهنمای پرداخت دستیراهنمای پرداخت دستی</p><p>راهنمای پرداخت دستی</p>', '<p>متن راهنما</p><p>ی پنل اجاره کننده د</p><p>ر اینجا نوشته می شود</p>', '<p>متن</p><p>راهنمای</p><p>نمایشگاه</p>', '');

-- --------------------------------------------------------

--
-- Table structure for table `users_admins`
--

CREATE TABLE `users_admins` (
  `id` int(11) NOT NULL,
  `flname` varchar(255) DEFAULT NULL,
  `username` varchar(150) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `fgcode` varchar(255) DEFAULT NULL,
  `permission` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_admins`
--

INSERT INTO `users_admins` (`id`, `flname`, `username`, `password`, `fgcode`, `permission`, `status`) VALUES
(1, 'Admin', 'siteadmin', '$2y$12$fyBnzP3jyuMpVqjLst3nMOAGYa4mVAu5oeEKJY4feI0nHdDaDrW3O', NULL, NULL, 1),
(9, 'محمدمحمدی', 'mohammad', '$2y$12$d0KiAnyD1EZwnYYrDLbPv.7DUHET8fPIpD0lWHl88SFDaC9ZEnOeK', NULL, '^settings_general^', 1),
(10, 'مدیر مقاله', 'maghaleh', '$2y$12$BAJOkbKIkjsQtGiX5c3.3OdZUvnHaPVgOSNj72eQzcnAjHDIsrb0.', NULL, '^contacts^', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users_dealers`
--

CREATE TABLE `users_dealers` (
  `id` int(11) NOT NULL,
  `flname` varchar(255) DEFAULT NULL,
  `address` varchar(500) DEFAULT NULL,
  `username` varchar(150) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `pass_created` int(10) NOT NULL DEFAULT '0',
  `utm` varchar(255) DEFAULT NULL,
  `lat` varchar(255) DEFAULT NULL,
  `lng` varchar(255) DEFAULT NULL,
  `birthday` varchar(255) DEFAULT NULL,
  `image_melli` varchar(255) DEFAULT NULL,
  `image_certificate` varchar(255) DEFAULT NULL,
  `image_profile` varchar(255) DEFAULT NULL,
  `dealer_name` varchar(255) DEFAULT NULL,
  `dealer_address` varchar(255) DEFAULT NULL,
  `dealer_tell` varchar(255) DEFAULT NULL,
  `delivery_cost` int(11) NOT NULL DEFAULT '50000',
  `bank_number` varchar(255) DEFAULT NULL,
  `frg` varchar(255) DEFAULT NULL,
  `approvecode` varchar(255) DEFAULT NULL,
  `vip` tinyint(1) NOT NULL DEFAULT '0',
  `points` int(11) NOT NULL DEFAULT '0',
  `tokid` int(11) NOT NULL DEFAULT '0',
  `activeuser` varchar(70) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_dealers`
--

INSERT INTO `users_dealers` (`id`, `flname`, `address`, `username`, `password`, `pass_created`, `utm`, `lat`, `lng`, `birthday`, `image_melli`, `image_certificate`, `image_profile`, `dealer_name`, `dealer_address`, `dealer_tell`, `delivery_cost`, `bank_number`, `frg`, `approvecode`, `vip`, `points`, `tokid`, `activeuser`, `status`) VALUES
(23, 'سامان استقلالی', 'test@test.com', '09356888888', '$2y$12$AcTIU4A/bwrGtVXk1Bza1es0SevU7liICWVfnLw6aM5d8K9yVp.9e', 0, NULL, '35.60902228231369', '51.3885498046875', '', '1606274302_8044736.jpg', '1606274314_6013534.jpg', '1606273796_2955247.jpg', 'نمایشگاه آذرخش', 'تهران - صالح آباد - خیابان 1 - کوچه 1', '02111111111', 25000, '11545454', NULL, '$2y$12$WsbqYVjovkr7/MDhYLNFoONzSMHy6ZEe5syXwltAv74bdqBjelNaK', 0, 0, 0, '11b5e4b6027f2c8442a75059adb945844636302d', 1),
(24, 'حسین خلیلی', '', '09999999999', '$2y$12$v9zlJPdTcVZpZNlMyRYpteUU2Itqnr26OWVBa6mPMveIa/4CRsP7K', 0, NULL, '36.336285223382895', '59.50435638427734', '', '1606368375_516324.jpg', '1606368376_2372857.jpg', '', 'خلیل خودرو', 'مشهد خیام نبش خیام 15', '05123456789', 50000, '00000000000', NULL, '$2y$12$6W68IImyw98h9v0rowzb6.KABp0TnK8FMBPMUZ31hfBYMTEAEz4BC', 0, 0, 0, '82c5eb002c05c88d96b9ab8571cc59112721e56e', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users_sites`
--

CREATE TABLE `users_sites` (
  `id` int(11) NOT NULL,
  `flname` varchar(255) DEFAULT NULL,
  `address` varchar(500) DEFAULT NULL,
  `username` varchar(150) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `pass_created` int(10) NOT NULL DEFAULT '0',
  `frg` varchar(255) DEFAULT NULL,
  `approvecode` varchar(255) DEFAULT NULL,
  `vip` tinyint(1) NOT NULL DEFAULT '0',
  `points` int(11) NOT NULL DEFAULT '0',
  `image_certificate` varchar(255) DEFAULT NULL,
  `image_melli` varchar(255) DEFAULT NULL,
  `image_profile` varchar(255) DEFAULT NULL,
  `birthday` varchar(255) DEFAULT NULL,
  `tokid` int(11) NOT NULL DEFAULT '0',
  `activeuser` varchar(70) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_sites`
--

INSERT INTO `users_sites` (`id`, `flname`, `address`, `username`, `password`, `pass_created`, `frg`, `approvecode`, `vip`, `points`, `image_certificate`, `image_melli`, `image_profile`, `birthday`, `tokid`, `activeuser`, `status`) VALUES
(1, 'محمد حسین', NULL, '09333333333', 'ssssssssssssssssssss', 0, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, '1', 1),
(5, 'حسین محمدی', 'ds@sdf.dsf', '09999999999', '$2y$12$CMIDcftt6h2Nzr8Rcqv7oeeAiVDnBhHuj/AdJ78K7mQWS6MczDXhm', 1590889683, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 496496, 'c27933180fe821032d39109955bcde9cbd7b8e56', 1),
(6, 'حسین', NULL, 'hossein2', '$2y$12$CzxwAFvB85oHm/jTYbmkV.IALI0S9WEe1GeAPZvAdcnciYtVu7uqm', 0, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, '9', 0),
(8, 'محمدرضا2', NULL, 'mohammadreza2', '$2y$12$rUkHqTQ8EqN2RqRcL.VVO..QIzbGJ.U1ZXr5MfSSUOpYMFjBOb422', 0, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, '8', 1),
(10, 'محمدرضا گودرزی', 'سشبسشبیس سیب ', '09357190370', '$2y$12$5.35hWnlh4FSkbyj.4QfC.B.tWcfwWjHGJncabf3gfx.A3vXi6d1i', 1593785246, NULL, '6b59e08c6f67078ad8b19819916393b6', 1, 0, NULL, NULL, NULL, NULL, 0, '7', 1),
(12, 'ghfbvc', NULL, '09666666666', '$2y$12$dsY1wEIDX.809GNXZwPH/ewGk0tbkkQVbGsNnBszImxDVWZYJbceO', 1590889540, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, '6', 1),
(15, '09999999997', '', '09999999997', '$2y$12$7dD4MjwZFCpIpSBDZmIy.uuKvnp7EBZtpF.7yCKwVd8Eym8fAGGgW', 0, NULL, '$2y$12$mqiSd4aZkSxC83hx6bqvBuh7x7paOjEHTWuTGzTLnvW3qzocQGsbG', 0, 0, NULL, NULL, NULL, NULL, 0, '5', 0),
(17, '09999999993', '', 'saman', '$2y$12$YooguBQjdBj3nH9DSK8K0e.saEg0EEFBL711U5locZerY/UggaIeO', 0, NULL, '$2y$12$79M1ZVPxX.XmoPvTgLiAlu4BNuwutGGHcTVUvrJNhY4PXDeERgjoG', 0, 0, NULL, NULL, NULL, NULL, 0, '4', 0),
(18, '09999999995', '', '09999999995', '$2y$12$cW0BL/bMpTLkwomkccf18uH3U3iUMCapkKFQjygIsNnawUJ4TP1j2', 0, NULL, '$2y$12$mr7TzeB4HYnXFXStQDdIIeMqtU5NXSEQpIOYjMNGOuhzpeLyU2qku', 0, 0, NULL, NULL, NULL, NULL, 0, '3', 0),
(19, '09999999991', '', '09999999991', '$2y$12$g6.yNEfnvT3FP78EQt4vNu8DgtStyuIF9qlFezn0ptU4lRvXsKLJC', 0, NULL, '$2y$12$D521q55KKBqGXSda9wzJJ.dZcPDp7EdpFTw3W2C1YHsREp/yhFgju', 0, 0, NULL, NULL, NULL, NULL, 0, '2', 0),
(20, 'محمد', '', '09999999666', '$2y$12$yr9Y/Lamjc4dI7NDC6miR.leXGCLGPqzYcdB.8z/IEJ3Fg/IK1yZu', 0, NULL, '$2y$12$58soGbpa5wiLBNvfG/UdUOCCE5HI16J270q4B8zsJDO2I8YfO1EMC', 0, 0, NULL, NULL, NULL, NULL, 8050, '1', 0),
(21, '0999999911111', '', '09999999111', '$2y$12$wDC1uPjpfOsoSYfzGkPQMuj1G7Znl1OggCGAxeLgdDMLsqKMlzvgO', 0, NULL, '$2y$12$jllnp6RBDxK45/2Ha0Ol4uimjg9nR9b13UWCDt3JBrwhOtG2kSA5.', 0, 0, NULL, NULL, NULL, NULL, 0, '25cd6943bac951b96bbc0b47055c403efdc0ea53', 1),
(22, 'ممد', '09999999113', '09999999113', '$2y$12$NwA.xNPFd3ehNBZckdHlVOH93bqk.NUqAuSIBPzVef66vJ9qq3NIm', 0, NULL, '$2y$12$K2DjR0HunzXbSX.NENCJ1.00mgiKaArCBTs24JH6z0HpAfIHNyA.u', 0, 0, NULL, NULL, NULL, NULL, 0, 'cd21c7393000d0c44f8e24a37b3ed7939de6c97e', 1),
(23, 'محمممممد', '2', '09356888888', '$2y$12$8BnIvCMOBrCmrIc58XzBwutlgf5rOY5OytgWAroBuqPz6WKK2WF8.', 0, NULL, '$2y$12$.13.aFK9YOMx4ynnD8Nu7OnlcY0ThkSDCIbNqvJtT1HEhZMeRTMum', 0, 0, '1606351784_7303363.jpg', '1606351784_6355352.jpg', '1606351784_829397.jpg', '3', 0, '3d47161a9ddf21598ff281520c29108802a0188b', 1),
(24, 'سامان سامانی', '', '09555555555', '$2y$12$KnmNysKJGbluTkBVyaP71eKRRYItTE.ANi/0Op2aGB.OahvxTuuL.', 0, NULL, '$2y$12$peBNPj9fP8Yfzz6CV9iPdO43NVvFpw4qk9j6iy/AJPOX4dfP/PIjK', 0, 0, '1606791859_4370471.jpg', '1606791859_5372078.jpg', '1606791859_1770657.jpg', '', 0, '3dd5b3c96c5a6890205154ba7d6b409bba5034c0', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `users_admins`
--
ALTER TABLE `users_admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `users_dealers`
--
ALTER TABLE `users_dealers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `users_sites`
--
ALTER TABLE `users_sites`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cars`
--
ALTER TABLE `cars`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `users_admins`
--
ALTER TABLE `users_admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users_dealers`
--
ALTER TABLE `users_dealers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `users_sites`
--
ALTER TABLE `users_sites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
