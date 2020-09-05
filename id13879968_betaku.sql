-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 05, 2020 at 10:12 AM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id13879968_betaku`
--

-- --------------------------------------------------------

--
-- Table structure for table `AdoraBot_device`
--

CREATE TABLE `AdoraBot_device` (
  `id_dev` int(6) NOT NULL,
  `dev_token` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `dev_name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(30) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `AdoraBot_device`
--

INSERT INTO `AdoraBot_device` (`id_dev`, `dev_token`, `dev_name`, `password`) VALUES
(1, 'AO-5ed1453dd3598', 'adnan_house', 'bijikorma'),
(3, 'AO-5ed18a6426a8c', 'rumahku', 'inipassnya'),
(4, 'AO-5edc444a1640c', 'tes', 'tes'),
(5, 'AO-5edc65f4b2c33', 'halo', 'beb'),
(6, 'AO-5edc671201413', 'rumah', 'inipassword');

-- --------------------------------------------------------

--
-- Table structure for table `AdoraBot_message`
--

CREATE TABLE `AdoraBot_message` (
  `id_msg` int(15) NOT NULL,
  `acc_id` int(6) NOT NULL,
  `message` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `AdoraBot_message`
--

INSERT INTO `AdoraBot_message` (`id_msg`, `acc_id`, `message`, `time`) VALUES
(1, 108488036, 'hai beb', '2020-05-30 04:10:27'),
(2, 227229578, '/start', '2020-05-30 04:13:11'),
(3, 227229578, 'hai', '2020-05-30 04:13:15'),
(4, 227229578, '/subscribe AO-5ed1453dd3598 bijikorma', '2020-05-30 04:14:35'),
(5, 108488036, '/create rumahku inipassnya', '2020-05-30 06:19:16'),
(6, 1224965694, 'Tes', '2020-06-02 01:29:07'),
(7, 1224965694, 'Tes', '2020-06-02 01:30:27'),
(8, 108488036, 'Oi', '2020-06-02 01:31:01'),
(9, 108488036, 'Ted', '2020-06-02 01:31:53'),
(10, 1224965694, 'Cek', '2020-06-02 01:33:13'),
(11, 1224965694, '/admin 108488036 haha', '2020-06-02 01:34:01'),
(12, 108488036, '/admin 1224965694 biji', '2020-06-02 01:34:28'),
(13, 108488036, '/admin 1224965694 mantap mantap', '2020-06-02 01:38:03'),
(14, 108488036, '/admin 1224965694 mantap mantap', '2020-06-02 01:51:25'),
(15, 108488036, '/admin 1224965694#mantap mantap', '2020-06-02 01:51:49'),
(16, 108488036, '/admin 227229578#siapa ini', '2020-06-02 02:23:21'),
(17, 227229578, 'ocang', '2020-06-02 02:23:31'),
(18, 108488036, 'Hei', '2020-06-02 06:06:33'),
(19, 1224965694, 'Hai', '2020-06-02 06:06:44'),
(20, 644768950, 'Halo', '2020-06-02 07:48:55'),
(21, 644768950, '/help', '2020-06-02 07:49:10'),
(22, 644768950, '/start', '2020-06-02 07:55:26'),
(23, 108488036, '/admin 644768950#langsung Dari akun telegram ku ini, ss kan ka kalo masuk ki', '2020-06-02 07:55:28'),
(24, 108488036, '/admin 644767950#bacot sekali anda', '2020-06-02 07:55:28'),
(25, 644768950, '/help', '2020-06-02 07:55:28'),
(26, 644768950, 'Bantu', '2020-06-02 07:56:28'),
(27, 108488036, '/admin 644768950#bacot sekali anda', '2020-06-02 07:56:29'),
(28, 644768950, '/subscribe', '2020-06-02 07:56:42'),
(29, 644768950, 'Ok halo123', '2020-06-02 07:58:50'),
(30, 108488036, '/delete AO-5ed18a6426a8c', '2020-06-07 09:27:54'),
(31, 108488036, '/delete AO-5ed18a6426a8c', '2020-06-07 09:32:31'),
(32, 108488036, '/delete AO-5ed18a6426a8c', '2020-06-07 09:33:57'),
(33, 108488036, '/create tes tes', '2020-06-07 09:35:05'),
(34, 108488036, '/delete AO-5ed18a6426a8c', '2020-06-07 09:36:01'),
(35, 108488036, '/delete AO-5ed18a6426a8c', '2020-06-07 09:36:55'),
(36, 108488036, '/delete AO-5ed18a6426a8c', '2020-06-07 09:57:05'),
(37, 108488036, '/delete AO-5edc444a1640c tes', '2020-06-07 10:06:02'),
(38, 108488036, '/delete AO-5edc444a1640c tes', '2020-06-07 10:09:38'),
(39, 108488036, '/delete AO-5edc444a1640c tes', '2020-06-07 10:12:04'),
(40, 108488036, '/delete AO-5edc444a1640c tes', '2020-06-07 10:14:03'),
(41, 108488036, '/delete AO-5edc444a1640d tes', '2020-06-07 10:14:48'),
(42, 108488036, '/delete AO-5edc444a1640d tes', '2020-06-07 10:16:10'),
(43, 108488036, '/delete AO-5edc444a1640d tes', '2020-06-07 10:16:26'),
(44, 108488036, '/delete AO-5edc444a1640d tes', '2020-06-07 10:19:23'),
(45, 108488036, '/delete AO-5edc444a1640d tes', '2020-06-07 10:20:38'),
(46, 108488036, '/delete AO-5edc444a1640d tes', '2020-06-07 10:21:34'),
(47, 108488036, '/delete AO-5edc444a1640d tes', '2020-06-07 10:28:13'),
(48, 108488036, '/delete AO-5edc444a1640c tes', '2020-06-07 10:28:25'),
(49, 108488036, '/delete AO-5edc444a1640d tes', '2020-06-07 10:29:21'),
(50, 108488036, '/delete AO-5edc444a1640c tes', '2020-06-07 10:29:59'),
(51, 108488036, '/delete AO-5edc444a1640c tes', '2020-06-07 10:30:46'),
(52, 108488036, '/delete AO-5edc444a1640c tes', '2020-06-07 10:31:36'),
(53, 108488036, '/delete AO-5edc444a1640c tes', '2020-06-07 10:39:47'),
(54, 108488036, '/delete AO-5edc444a1640c tes', '2020-06-07 10:39:52'),
(55, 108488036, '/delete AO-5edc444a1640c tes', '2020-06-07 10:42:05'),
(56, 108488036, '/delete AO-5edc444a1640c tes', '2020-06-07 10:42:47'),
(57, 108488036, '/delete AO-5edc444a1640c tes', '2020-06-07 11:49:36'),
(58, 108488036, '/delete AO-5ed1453dd359 bijikorma', '2020-06-07 11:50:36'),
(59, 108488036, '/delete AO-5ed1453dd3598 bijikorma', '2020-06-07 11:50:56'),
(60, 1224965694, '/create halo beb', '2020-06-07 11:58:44'),
(61, 1224965694, '/delete AO-5edc65f4b2c33 beb', '2020-06-07 12:02:34'),
(62, 1224965694, '/create rumah inipassword', '2020-06-07 12:03:29'),
(63, 108488036, '/unsubs AO-5edc671201413 inipassword', '2020-06-08 21:57:48'),
(64, 1224965694, '/subscribe AO-5edc671201413 inipassword', '2020-06-08 21:58:57'),
(65, 955866881, '/start', '2020-07-02 22:23:31');

-- --------------------------------------------------------

--
-- Table structure for table `AdoraBot_register`
--

CREATE TABLE `AdoraBot_register` (
  `id_reg` int(10) NOT NULL,
  `acc_id` int(6) NOT NULL,
  `id_dev` int(6) NOT NULL,
  `roles` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `AdoraBot_register`
--

INSERT INTO `AdoraBot_register` (`id_reg`, `acc_id`, `id_dev`, `roles`, `time`) VALUES
(2, 1224965694, 6, 'OWNER', '2020-06-07 12:03:29'),
(3, 1224965694, 6, 'SUBSCRIBER', '2020-06-08 21:58:57');

-- --------------------------------------------------------

--
-- Table structure for table `AdoraBot_report`
--

CREATE TABLE `AdoraBot_report` (
  `id_report` int(20) NOT NULL,
  `id_dev` int(6) NOT NULL,
  `img` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `AdoraBot_report`
--

INSERT INTO `AdoraBot_report` (`id_report`, `id_dev`, `img`, `time`) VALUES
(1, 3, 'AO-5ed18a6426a8c-1591038138.jpg', '2020-05-30 01:24:13'),
(2, 3, 'AO-5ed18a6426a8c-1591038799.jpg', '2020-05-30 01:24:13'),
(3, 3, 'AO-5ed18a6426a8c-1591038848.jpg', '2020-05-30 01:24:13'),
(4, 3, 'AO-5ed18a6426a8c-1591059363.jpg', '2020-05-30 01:24:13'),
(5, 3, 'AO-5ed18a6426a8c-1591059488.jpg', '2020-05-30 01:24:13'),
(6, 3, 'AO-5ed18a6426a8c-1591059661.jpg', '2020-05-30 01:24:13'),
(7, 3, 'AO-5ed18a6426a8c-1591078193.jpg', '2020-06-02 14:09:49'),
(8, 3, 'AO-5ed18a6426a8c-1591078384.jpg', '2020-06-02 14:12:58'),
(9, 3, 'AO-5ed18a6426a8c-1591078739.jpg', '2020-06-02 14:18:55'),
(10, 3, 'AO-5ed18a6426a8c-1591078856.jpg', '2020-06-02 14:20:52'),
(11, 3, 'AO-5ed18a6426a8c-1591078901.jpg', '2020-06-02 14:21:37'),
(12, 3, 'AO-5ed18a6426a8c-1591078998.jpg', '2020-06-02 14:23:14'),
(13, 3, 'AO-5ed18a6426a8c-1591079008.jpg', '2020-06-02 14:23:24'),
(14, 3, 'AO-5ed18a6426a8c-1591079025.jpg', '2020-06-02 14:23:41'),
(15, 3, 'AO-5ed18a6426a8c-1591079049.jpg', '2020-06-02 14:24:05'),
(16, 3, 'AO-5ed18a6426a8c-1591492670.jpg', '2020-06-07 09:17:27'),
(17, 3, 'AO-5ed18a6426a8c-1591492703.jpg', '2020-06-07 09:18:01'),
(18, 3, 'AO-5ed18a6426a8c-1591493131.jpg', '2020-06-07 09:25:13'),
(19, 3, 'AO-5ed18a6426a8c-1591494999.jpg', '2020-06-07 09:56:27'),
(20, 3, 'AO-5ed18a6426a8c-1591495023.jpg', '2020-06-07 09:56:49'),
(21, 3, 'AO-5ed18a6426a8c-1591495045.jpg', '2020-06-07 09:57:13'),
(22, 6, 'AO-5edc671201413-1591624976.jpg', '2020-06-08 22:02:47'),
(23, 6, 'AO-5edc671201413-1591624997.jpg', '2020-06-08 22:03:07'),
(24, 6, 'AO-5edc671201413-1591626759.jpg', '2020-06-08 22:32:30'),
(25, 6, 'AO-5edc671201413-1591626775.jpg', '2020-06-08 22:32:49'),
(26, 6, 'AO-5edc671201413-1591626803.jpg', '2020-06-08 22:33:16'),
(27, 6, 'AO-5edc671201413-1591626818.jpg', '2020-06-08 22:33:32'),
(28, 6, 'AO-5edc671201413-1591626845.jpg', '2020-06-08 22:33:52'),
(29, 6, 'AO-5edc671201413-1591626859.jpg', '2020-06-08 22:34:13'),
(30, 6, 'AO-5edc671201413-1591626875.jpg', '2020-06-08 22:34:29'),
(31, 6, 'AO-5edc671201413-1591626892.jpg', '2020-06-08 22:34:45'),
(32, 6, 'AO-5edc671201413-1591626908.jpg', '2020-06-08 22:35:02'),
(33, 6, 'AO-5edc671201413-1591626924.jpg', '2020-06-08 22:35:18'),
(34, 6, 'AO-5edc671201413-1591626952.jpg', '2020-06-08 22:35:46'),
(35, 6, 'AO-5edc671201413-1591626969.jpg', '2020-06-08 22:36:02'),
(36, 6, 'AO-5edc671201413-1591626988.jpg', '2020-06-08 22:36:22'),
(37, 6, 'AO-5edc671201413-1591627016.jpg', '2020-06-08 22:36:38'),
(38, 6, 'AO-5edc671201413-1591627592.jpg', '2020-06-08 22:46:27'),
(39, 6, 'AO-5edc671201413-1591627620.jpg', '2020-06-08 22:46:52'),
(40, 6, 'AO-5edc671201413-1591627643.jpg', '2020-06-08 22:47:17'),
(41, 6, 'AO-5edc671201413-1591627664.jpg', '2020-06-08 22:47:38'),
(42, 6, 'AO-5edc671201413-1591627681.jpg', '2020-06-08 22:47:56'),
(43, 6, 'AO-5edc671201413-1591627712.jpg', '2020-06-08 22:48:26'),
(44, 6, 'AO-5edc671201413-1591627757.jpg', '2020-06-08 22:49:11'),
(45, 6, 'AO-5edc671201413-1591627772.jpg', '2020-06-08 22:49:27'),
(46, 6, 'AO-5edc671201413-1591627793.jpg', '2020-06-08 22:49:42'),
(47, 6, 'AO-5edc671201413-1591628559.jpg', '2020-06-08 23:02:32'),
(48, 6, 'AO-5edc671201413-1591628576.jpg', '2020-06-08 23:02:49'),
(49, 6, 'AO-5edc671201413-1591628591.jpg', '2020-06-08 23:03:05');

-- --------------------------------------------------------

--
-- Table structure for table `AdoraBot_user`
--

CREATE TABLE `AdoraBot_user` (
  `id_user` int(6) NOT NULL,
  `acc_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `acc_username` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `acc_firstname` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `acc_lastname` varchar(30) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `AdoraBot_user`
--

INSERT INTO `AdoraBot_user` (`id_user`, `acc_id`, `acc_username`, `acc_firstname`, `acc_lastname`) VALUES
(1, '108488036', 'adnansurya', 'Muhammad Adnan', 'Surya'),
(2, '644768950', 'laodefit02', 'Laode', 'Fitrah'),
(3, '227229578', 'akusiapaaa2912', 'Haha', 'Hoho'),
(4, '1224965694', '', 'MIKRO', 'chan'),
(5, '955866881', 'todayis_you', 'D', '');

-- --------------------------------------------------------

--
-- Table structure for table `hologramBot_hadir`
--

CREATE TABLE `hologramBot_hadir` (
  `id_card` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `waktu` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hologramBot_log`
--

CREATE TABLE `hologramBot_log` (
  `id_log` int(10) NOT NULL,
  `id_card` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `waktu` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `hologramBot_log`
--

INSERT INTO `hologramBot_log` (`id_log`, `id_card`, `status`, `waktu`) VALUES
(1, '19-F8-16-78', 'daftar', '2020-07-13 19:30:56'),
(2, '19-F8-16-78', 'hadir', '2020-07-13 19:51:48'),
(3, '19-F8-16-78', 'keluar', '2020-07-13 19:52:14'),
(4, '19-F8-16-78', 'hadir', '2020-07-13 19:56:45'),
(5, '19-F8-16-78', 'keluar', '2020-07-13 19:57:01'),
(6, '19-F8-16-78', 'hadir', '2020-07-13 19:57:45'),
(7, '19-F8-16-78', 'keluar', '2020-07-13 20:02:44'),
(8, '19-F8-16-78', 'hadir', '2020-07-13 20:08:42'),
(9, '19-F8-16-78', 'keluar', '2020-07-13 20:11:00'),
(10, '19-F8-16-78', 'hadir', '2020-07-13 20:11:13'),
(11, '19-F8-16-78', 'keluar', '2020-07-13 21:43:20'),
(12, '19-F8-16-78', 'hadir', '2020-07-13 21:43:57'),
(13, '19-F8-16-78', 'keluar', '2020-07-13 21:44:07'),
(14, '00-59-3E-A7', 'daftar', '2020-07-13 21:46:51'),
(15, '00-59-3E-A7', 'hadir', '2020-07-13 21:47:05'),
(16, '00-59-3E-A7', 'keluar', '2020-07-13 21:50:38'),
(17, '19-F8-16-78', 'hadir', '2020-07-13 21:52:15'),
(18, '04-22-86-FA-96-2C-80', 'daftar', '2020-07-13 22:00:52'),
(19, '04-22-86-FA-96-2C-80', 'hadir', '2020-07-13 22:01:36'),
(20, '04-22-86-FA-96-2C-80', 'keluar', '2020-07-13 22:01:47'),
(21, '04-22-86-FA-96-2C-80', 'hadir', '2020-07-13 22:01:56'),
(22, '04-34-1F-CA-1B-29-80', 'daftar', '2020-07-13 22:07:26'),
(23, '04-34-1F-CA-1B-29-80', 'hadir', '2020-07-13 22:07:41'),
(24, '19-F8-16-78', 'keluar', '2020-07-13 22:08:07'),
(25, '19-F8-16-78', 'hadir', '2020-07-13 22:15:59'),
(26, '04-34-1F-CA-1B-29-80', 'keluar', '2020-07-13 22:16:29'),
(27, '19-F8-16-78', 'keluar', '2020-07-13 22:19:52'),
(28, '04-22-86-FA-96-2C-80', 'keluar', '2020-07-13 22:20:05'),
(29, '19-F8-16-78', 'hadir', '2020-07-13 23:31:55'),
(30, '19-F8-16-78', 'keluar', '2020-07-13 23:38:38'),
(31, '19-F8-16-78', 'hadir', '2020-07-13 23:39:13'),
(32, '19-F8-16-78', 'keluar', '2020-07-13 23:42:12'),
(33, '19-F8-16-78', 'hadir', '2020-07-13 23:44:59'),
(34, '19-F8-16-78', 'keluar', '2020-07-13 23:46:33'),
(35, '19-F8-16-78', 'hadir', '2020-07-13 23:49:54'),
(36, '19-F8-16-78', 'keluar', '2020-07-13 23:52:16'),
(37, '19-F8-16-78', 'hadir', '2020-07-13 23:55:40'),
(38, '19-F8-16-78', 'keluar', '2020-07-13 23:56:11'),
(39, '19-F8-16-78', 'hadir', '2020-07-13 23:56:33'),
(40, '19-F8-16-78', 'keluar', '2020-07-14 00:00:24'),
(41, '19-F8-16-78', 'hadir', '2020-07-14 00:02:25'),
(42, '19-F8-16-78', 'keluar', '2020-07-14 00:02:54'),
(43, '19-F8-16-78', 'hadir', '2020-07-14 00:05:45'),
(44, '19-F8-16-78', 'keluar', '2020-07-14 00:07:01'),
(45, '19-F8-16-78', 'hadir', '2020-07-14 14:34:52'),
(46, '19-F8-16-78', 'keluar', '2020-07-14 14:36:32'),
(47, '19-F8-16-78', 'hadir', '2020-07-14 19:15:09'),
(48, '19-F8-16-78', 'keluar', '2020-07-14 21:30:49'),
(49, '19-F8-16-78', 'hadir', '2020-07-14 21:31:01'),
(50, '19-F8-16-78', 'keluar', '2020-07-14 22:20:57'),
(51, '19-F8-16-78', 'hadir', '2020-07-14 22:21:09'),
(52, '19-F8-16-78', 'keluar', '2020-07-14 22:22:46'),
(53, '19-F8-16-78', 'hadir', '2020-07-14 22:23:16'),
(54, '19-F8-16-78', 'keluar', '2020-07-14 22:23:25'),
(55, '19-F8-16-78', 'hadir', '2020-07-14 22:26:46'),
(56, '19-F8-16-78', 'keluar', '2020-07-14 22:36:28'),
(57, '19-F8-16-78', 'hadir', '2020-07-14 22:36:43'),
(58, '19-F8-16-78', 'keluar', '2020-07-14 22:48:25'),
(59, '19-F8-16-78', 'hadir', '2020-07-14 22:49:13'),
(60, '19-F8-16-78', 'keluar', '2020-07-14 22:51:55'),
(61, '19-F8-16-78', 'hadir', '2020-07-14 22:56:22'),
(62, '19-F8-16-78', 'keluar', '2020-07-14 22:58:37'),
(63, '19-F8-16-78', 'hadir', '2020-07-15 19:04:19'),
(64, '04-22-86-FA-96-2C-80', 'hadir', '2020-07-15 20:01:46'),
(65, '00-59-3E-A7', 'hadir', '2020-07-15 20:11:56'),
(66, '00-59-3E-A7', 'keluar', '2020-07-15 22:26:31'),
(67, '19-F8-16-78', 'keluar', '2020-07-15 23:34:45'),
(68, '04-22-86-FA-96-2C-80', 'keluar', '2020-07-15 23:35:23'),
(69, '04-34-1F-CA-1B-29-80', 'hadir', '2020-07-16 20:30:33'),
(70, '00-59-3E-A7', 'hadir', '2020-07-16 20:31:21'),
(71, '04-22-86-FA-96-2C-80', 'hadir', '2020-07-16 20:32:14'),
(72, '04-34-1F-CA-1B-29-80', 'keluar', '2020-07-16 23:36:19'),
(73, '04-22-86-FA-96-2C-80', 'keluar', '2020-07-16 23:39:04'),
(74, '19-F8-16-78', 'hadir', '2020-07-17 16:47:49'),
(75, '00-59-3E-A7', 'keluar', '2020-07-17 20:00:40'),
(76, '00-59-3E-A7', 'hadir', '2020-07-17 20:00:49'),
(77, '04-22-86-FA-96-2C-80', 'hadir', '2020-07-17 20:33:26'),
(78, '00-59-3E-A7', 'keluar', '2020-07-17 22:14:49'),
(79, '04-22-86-FA-96-2C-80', 'keluar', '2020-07-17 23:41:24'),
(80, '19-F8-16-78', 'keluar', '2020-07-17 23:45:11'),
(81, '04-34-1F-CA-1B-29-80', 'hadir', '2020-07-18 14:30:59'),
(82, '04-88-57-32-D5-28-80', 'daftar', '2020-07-18 14:33:10'),
(83, '04-88-57-32-D5-28-80', 'hadir', '2020-07-18 14:34:27'),
(84, '04-88-57-32-D5-28-80', 'keluar', '2020-07-18 15:44:58'),
(85, '19-F8-16-78', 'hadir', '2020-07-18 16:36:02'),
(86, '19-F8-16-78', 'keluar', '2020-07-18 16:36:29'),
(87, '19-F8-16-78', 'hadir', '2020-07-18 16:36:49'),
(88, '19-F8-16-78', 'keluar', '2020-07-18 16:37:06'),
(89, '19-F8-16-78', 'hadir', '2020-07-18 17:01:41'),
(90, '19-F8-16-78', 'keluar', '2020-07-18 17:03:13'),
(91, '19-F8-16-78', 'hadir', '2020-07-18 17:27:38'),
(92, '19-F8-16-78', 'keluar', '2020-07-18 17:28:36'),
(93, '04-63-76-CA-E5-5B-80', 'daftar', '2020-07-18 17:42:14'),
(94, '04-63-76-CA-E5-5B-80', 'hadir', '2020-07-18 17:42:20'),
(95, '00-59-3E-A7', 'hadir', '2020-07-18 20:13:25'),
(96, '04-22-86-FA-96-2C-80', 'hadir', '2020-07-18 20:39:21'),
(97, '04-34-1F-CA-1B-29-80', 'keluar', '2020-07-18 20:39:57'),
(98, '04-63-76-CA-E5-5B-80', 'keluar', '2020-07-18 21:32:29'),
(99, '04-22-86-FA-96-2C-80', 'keluar', '2020-07-19 00:25:18'),
(100, '00-59-3E-A7', 'keluar', '2020-07-19 00:26:23'),
(101, '00-59-3E-A7', 'hadir', '2020-07-19 20:14:10'),
(102, '19-F8-16-78', 'hadir', '2020-07-19 20:14:50'),
(103, '00-59-3E-A7', 'keluar', '2020-07-19 22:15:11'),
(104, '19-F8-16-78', 'keluar', '2020-07-20 00:26:54'),
(105, '19-F8-16-78', 'hadir', '2020-07-20 17:18:21'),
(106, '19-F8-16-78', 'keluar', '2020-07-20 18:56:50'),
(107, '19-F8-16-78', 'hadir', '2020-07-20 19:07:47'),
(108, '19-F8-16-78', 'keluar', '2020-07-20 22:44:13'),
(109, '19-F8-16-78', 'hadir', '2020-07-21 19:59:17'),
(110, '04-22-86-FA-96-2C-80', 'hadir', '2020-07-21 20:26:42'),
(111, '19-F8-16-78', 'keluar', '2020-07-21 23:52:42'),
(112, '04-22-86-FA-96-2C-80', 'keluar', '2020-07-21 23:53:11'),
(113, '19-F8-16-78', 'hadir', '2020-07-22 19:16:51'),
(114, '00-59-3E-A7', 'hadir', '2020-07-22 19:34:49'),
(115, '04-22-86-FA-96-2C-80', 'hadir', '2020-07-22 20:13:28'),
(116, '00-59-3E-A7', 'keluar', '2020-07-22 22:22:54'),
(117, '19-F8-16-78', 'keluar', '2020-07-22 23:58:08'),
(118, '04-22-86-FA-96-2C-80', 'keluar', '2020-07-22 23:59:04'),
(119, '19-F8-16-78', 'hadir', '2020-07-24 11:50:12'),
(120, '19-F8-16-78', 'keluar', '2020-07-24 15:04:27'),
(121, '04-34-1F-CA-1B-29-80', 'hadir', '2020-07-24 15:04:52'),
(122, '04-34-1F-CA-1B-29-80', 'keluar', '2020-07-24 16:14:06'),
(123, '00-59-3E-A7', 'hadir', '2020-07-24 21:06:55'),
(124, '19-F8-16-78', 'hadir', '2020-07-24 21:48:19'),
(125, '00-59-3E-A7', 'keluar', '2020-07-24 23:03:01'),
(126, '19-F8-16-78', 'keluar', '2020-07-24 23:55:01'),
(127, '19-F8-16-78', 'hadir', '2020-07-25 18:58:57'),
(128, '04-63-76-CA-E5-5B-80', 'hadir', '2020-07-25 19:30:14'),
(129, '04-63-76-CA-E5-5B-80', 'keluar', '2020-07-25 20:35:19'),
(130, '04-22-86-FA-96-2C-80', 'hadir', '2020-07-25 20:36:26'),
(131, '70-96-8E-A6', 'daftar', '2020-07-25 21:35:25'),
(132, '70-96-8E-A6', 'hadir', '2020-07-25 21:35:34'),
(133, '04-22-86-FA-96-2C-80', 'keluar', '2020-07-25 23:57:06'),
(134, '19-F8-16-78', 'keluar', '2020-07-26 00:04:09'),
(135, '70-96-8E-A6', 'keluar', '2020-07-26 00:04:49'),
(136, '19-F8-16-78', 'hadir', '2020-07-26 17:50:32'),
(137, '19-F8-16-78', 'keluar', '2020-07-26 22:19:58'),
(138, '19-F8-16-78', 'hadir', '2020-07-27 13:57:52'),
(139, '19-F8-16-78', 'keluar', '2020-07-27 16:33:49'),
(140, '19-F8-16-78', 'hadir', '2020-07-27 19:02:36'),
(141, '19-F8-16-78', 'keluar', '2020-07-27 19:29:56'),
(142, '19-F8-16-78', 'hadir', '2020-07-29 17:37:03'),
(143, '04-63-76-CA-E5-5B-80', 'hadir', '2020-07-29 17:37:13'),
(144, '04-63-76-CA-E5-5B-80', 'keluar', '2020-07-29 19:12:04'),
(145, '00-59-3E-A7', 'hadir', '2020-07-29 20:31:50'),
(146, '00-59-3E-A7', 'keluar', '2020-07-29 23:11:58'),
(147, '19-F8-16-78', 'keluar', '2020-07-29 23:25:44'),
(148, '19-F8-16-78', 'hadir', '2020-07-30 18:09:32'),
(149, '00-59-3E-A7', 'hadir', '2020-07-30 20:41:44'),
(150, '00-59-3E-A7', 'keluar', '2020-07-30 22:58:11'),
(151, '19-F8-16-78', 'keluar', '2020-07-30 23:32:33'),
(152, '19-F8-16-78', 'hadir', '2020-08-05 20:12:23'),
(153, '19-F8-16-78', 'keluar', '2020-08-05 23:30:16'),
(154, '19-F8-16-78', 'hadir', '2020-08-06 20:50:24'),
(155, '19-F8-16-78', 'keluar', '2020-08-07 00:04:52'),
(156, '00-59-3E-A7', 'hadir', '2020-08-07 19:23:24'),
(157, '19-F8-16-78', 'hadir', '2020-08-07 20:36:07'),
(158, '00-59-3E-A7', 'keluar', '2020-08-07 22:11:32'),
(159, '19-F8-16-78', 'keluar', '2020-08-07 22:45:53'),
(160, '19-F8-16-78', 'hadir', '2020-08-08 19:42:39'),
(161, '04-63-76-CA-E5-5B-80', 'hadir', '2020-08-08 19:42:53'),
(162, '00-59-3E-A7', 'hadir', '2020-08-08 20:39:16'),
(163, '04-63-76-CA-E5-5B-80', 'keluar', '2020-08-08 21:37:50'),
(164, '00-59-3E-A7', 'keluar', '2020-08-08 22:29:38'),
(165, '19-F8-16-78', 'keluar', '2020-08-08 23:58:22'),
(166, '19-F8-16-78', 'hadir', '2020-08-10 19:01:43'),
(167, '04-61 0D-3A-1B-2B-80', 'daftar', '2020-08-10 19:19:27'),
(168, '04-61 0D-3A-1B-2B-80', 'hadir', '2020-08-10 19:19:40'),
(169, '04-61 0D-3A-1B-2B-80', 'keluar', '2020-08-10 23:54:38'),
(170, '19-F8-16-78', 'keluar', '2020-08-10 23:55:06'),
(171, '19-F8-16-78', 'hadir', '2020-08-11 20:00:19'),
(172, '19-F8-16-78', 'keluar', '2020-08-11 23:21:18'),
(173, '19-F8-16-78', 'hadir', '2020-08-12 14:14:44'),
(174, '04-63-76-CA-E5-5B-80', 'hadir', '2020-08-12 17:20:48'),
(175, '00-59-3E-A7', 'hadir', '2020-08-12 19:52:35'),
(176, '04-63-76-CA-E5-5B-80', 'keluar', '2020-08-12 20:18:20'),
(177, '00-59-3E-A7', 'keluar', '2020-08-12 21:55:49'),
(178, '19-F8-16-78', 'keluar', '2020-08-12 22:31:41'),
(179, '19-F8-16-78', 'hadir', '2020-08-14 16:48:13'),
(180, '19-F8-16-78', 'keluar', '2020-08-14 19:22:46'),
(181, '19-F8-16-78', 'hadir', '2020-08-16 16:33:31'),
(182, '19-F8-16-78', 'keluar', '2020-08-16 16:34:11'),
(183, '19-F8-16-78', 'hadir', '2020-08-16 16:36:06'),
(184, '04-63-76-CA-E5-5B-80', 'hadir', '2020-08-16 20:16:26'),
(185, '04-63-76-CA-E5-5B-80', 'keluar', '2020-08-16 22:16:24'),
(186, '19-F8-16-78', 'keluar', '2020-08-16 23:48:01'),
(187, '19-F8-16-78', 'hadir', '2020-08-17 18:08:53'),
(188, '19-F8-16-78', 'keluar', '2020-08-17 22:19:42'),
(189, '19-F8-16-78', 'hadir', '2020-08-18 16:56:28'),
(190, '04-22-86-FA-96-2C-80', 'hadir', '2020-08-18 19:58:17'),
(191, '19-F8-16-78', 'keluar', '2020-08-18 23:42:51'),
(192, '04-22-86-FA-96-2C-80', 'keluar', '2020-08-18 23:43:52'),
(193, '19-F8-16-78', 'hadir', '2020-08-19 13:37:22'),
(194, '19-F8-16-78', 'keluar', '2020-08-19 17:49:48'),
(195, '19-F8-16-78', 'hadir', '2020-08-20 17:31:31'),
(196, '00-59-3E-A7', 'hadir', '2020-08-20 17:56:14'),
(197, '04-61 0D-3A-1B-2B-80', 'hadir', '2020-08-20 18:55:46'),
(198, '04-61 0D-3A-1B-2B-80', 'keluar', '2020-08-20 20:34:53'),
(199, '19-F8-16-78', 'keluar', '2020-08-20 21:54:26'),
(200, '00-59-3E-A7', 'keluar', '2020-08-20 21:56:25'),
(201, '19-F8-16-78', 'hadir', '2020-08-22 17:15:53'),
(202, '19-F8-16-78', 'keluar', '2020-08-22 23:47:48'),
(203, '19-F8-16-78', 'hadir', '2020-08-23 19:12:31'),
(204, '04-63-76-CA-E5-5B-80', 'hadir', '2020-08-23 19:24:42'),
(205, '04-63-76-CA-E5-5B-80', 'keluar', '2020-08-23 20:51:57'),
(206, '19-F8-16-78', 'keluar', '2020-08-23 23:22:39'),
(207, '19-F8-16-78', 'hadir', '2020-08-24 20:19:56'),
(208, '04-22-86-FA-96-2C-80', 'hadir', '2020-08-24 20:27:40'),
(209, '04-22-86-FA-96-2C-80', 'keluar', '2020-08-24 22:44:41'),
(210, '19-F8-16-78', 'keluar', '2020-08-24 22:59:45'),
(211, '19-F8-16-78', 'hadir', '2020-08-25 19:47:11'),
(212, '19-F8-16-78', 'keluar', '2020-08-25 23:26:36'),
(213, '19-F8-16-78', 'hadir', '2020-08-28 15:59:31'),
(214, '04-63-76-CA-E5-5B-80', 'hadir', '2020-08-28 19:02:38'),
(215, '19-F8-16-78', 'keluar', '2020-08-28 21:59:57'),
(216, '04-63-76-CA-E5-5B-80', 'keluar', '2020-08-28 22:00:36'),
(217, '19-F8-16-78', 'hadir', '2020-08-29 21:42:53'),
(218, '19-F8-16-78', 'keluar', '2020-08-30 00:06:08'),
(219, '19-F8-16-78', 'hadir', '2020-08-30 21:05:52'),
(220, '19-F8-16-78', 'keluar', '2020-08-30 23:07:46'),
(221, '19-F8-16-78', 'hadir', '2020-09-01 13:46:24'),
(222, '00-59-3E-A7', 'hadir', '2020-09-01 15:47:33'),
(223, '00-59-3E-A7', 'keluar', '2020-09-01 18:37:08'),
(224, '19-F8-16-78', 'keluar', '2020-09-01 20:07:37'),
(225, '19-F8-16-78', 'hadir', '2020-09-03 12:45:06'),
(226, '19-F8-16-78', 'keluar', '2020-09-03 18:27:54'),
(227, 'C5-D4-6E-DA', 'daftar', '2020-09-04 11:54:41'),
(228, 'C5-D4-6E-DA', 'hadir', '2020-09-04 11:55:01'),
(229, 'C5-D4-6E-DA', 'keluar', '2020-09-04 11:56:00'),
(230, '19-F8-16-78', 'hadir', '2020-09-04 17:37:46'),
(231, '04-63-76-CA-E5-5B-80', 'hadir', '2020-09-04 17:59:07'),
(232, '04-63-76-CA-E5-5B-80', 'keluar', '2020-09-04 21:29:41'),
(233, '19-F8-16-78', 'keluar', '2020-09-04 22:43:25');

-- --------------------------------------------------------

--
-- Table structure for table `hologramBot_user`
--

CREATE TABLE `hologramBot_user` (
  `id_acc` int(10) NOT NULL,
  `id_user` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `id_card` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `first_name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `timestamp` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `hologramBot_user`
--

INSERT INTO `hologramBot_user` (`id_acc`, `id_user`, `id_card`, `first_name`, `last_name`, `username`, `timestamp`) VALUES
(1, '108488036', '19-F8-16-78', 'Muhammad Adnan', 'Surya', 'adnansurya', '1594639856'),
(2, '644768950', '00-59-3E-A7', 'Laode', 'Fitrah', 'laodefit02', '1594648011'),
(3, '955866881', '04-22-86-FA-96-2C-80', 'D', '', 'todayis_you', '1594648852'),
(4, '108488036', '04-34-1F-CA-1B-29-80', 'Muhammad Adnan', 'Surya', 'adnansurya', '1594649246'),
(5, '916027884', '04-88-57-32-D5-28-80', 'Nrhikma', 'Kadja', 'Nrhikma08', '1595053990'),
(6, '956827994', '04-63-76-CA-E5-5B-80', 'Lock', 'Heed', 'LockHeed141', '1595065334'),
(7, '541142383', '70-96-8E-A6', 'Abel', 'Dimas', 'Abeldimas36', '1595684125'),
(8, '640002329', '04-61 0D-3A-1B-2B-80', 'Michael', '', 'michael_am', '1597058367'),
(9, '108488036', 'C5-D4-6E-DA', 'Muhammad Adnan', 'Surya', 'adnansurya', '1599191681');

-- --------------------------------------------------------

--
-- Table structure for table `MR_user`
--

CREATE TABLE `MR_user` (
  `id_user` int(6) NOT NULL,
  `username` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `nickname` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `roles` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `MR_user`
--

INSERT INTO `MR_user` (`id_user`, `username`, `password`, `nickname`, `roles`) VALUES
(1, 'adnansurya', 'makassar', 'Adnan', 'Owner');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `AdoraBot_device`
--
ALTER TABLE `AdoraBot_device`
  ADD PRIMARY KEY (`id_dev`);

--
-- Indexes for table `AdoraBot_message`
--
ALTER TABLE `AdoraBot_message`
  ADD PRIMARY KEY (`id_msg`);

--
-- Indexes for table `AdoraBot_register`
--
ALTER TABLE `AdoraBot_register`
  ADD PRIMARY KEY (`id_reg`);

--
-- Indexes for table `AdoraBot_report`
--
ALTER TABLE `AdoraBot_report`
  ADD PRIMARY KEY (`id_report`);

--
-- Indexes for table `AdoraBot_user`
--
ALTER TABLE `AdoraBot_user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `acc_id` (`acc_id`);

--
-- Indexes for table `hologramBot_log`
--
ALTER TABLE `hologramBot_log`
  ADD PRIMARY KEY (`id_log`);

--
-- Indexes for table `hologramBot_user`
--
ALTER TABLE `hologramBot_user`
  ADD PRIMARY KEY (`id_acc`);

--
-- Indexes for table `MR_user`
--
ALTER TABLE `MR_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `AdoraBot_device`
--
ALTER TABLE `AdoraBot_device`
  MODIFY `id_dev` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `AdoraBot_message`
--
ALTER TABLE `AdoraBot_message`
  MODIFY `id_msg` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `AdoraBot_register`
--
ALTER TABLE `AdoraBot_register`
  MODIFY `id_reg` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `AdoraBot_report`
--
ALTER TABLE `AdoraBot_report`
  MODIFY `id_report` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `AdoraBot_user`
--
ALTER TABLE `AdoraBot_user`
  MODIFY `id_user` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `hologramBot_log`
--
ALTER TABLE `hologramBot_log`
  MODIFY `id_log` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=234;

--
-- AUTO_INCREMENT for table `hologramBot_user`
--
ALTER TABLE `hologramBot_user`
  MODIFY `id_acc` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `MR_user`
--
ALTER TABLE `MR_user`
  MODIFY `id_user` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
