-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 20, 2021 at 07:48 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gis`
--

-- --------------------------------------------------------

--
-- Table structure for table `gis_contact_inbox`
--

CREATE TABLE `gis_contact_inbox` (
  `contact_inbox_id` bigint(20) NOT NULL,
  `contact_inbox_from_email` varchar(255) NOT NULL,
  `contact_inbox_message` text NOT NULL,
  `contact_inbox_from_name` varchar(255) NOT NULL,
  `contact_inbox_created_date` datetime NOT NULL,
  `contact_inbox_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `gis_contact_outbox`
--

CREATE TABLE `gis_contact_outbox` (
  `contact_outbox_id` bigint(20) NOT NULL,
  `user_id` int(11) NOT NULL,
  `contact_outbox_message` text NOT NULL,
  `contact_outbox_created_date` datetime NOT NULL,
  `contact_outbox_created_by` int(11) NOT NULL,
  `contact_outbox_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `gis_contact_reply`
--

CREATE TABLE `gis_contact_reply` (
  `contact_reply_id` bigint(20) NOT NULL,
  `contact_outbox_id` bigint(20) NOT NULL,
  `contact_inbox_id` bigint(20) NOT NULL,
  `contact_reply_created_date` datetime DEFAULT NULL,
  `contact_reply_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `gis_developer_detail`
--

CREATE TABLE `gis_developer_detail` (
  `developer_id` bigint(20) NOT NULL,
  `register_id` bigint(20) NOT NULL,
  `user_id` int(11) NOT NULL,
  `kecamatan_id` int(11) NOT NULL,
  `developer_name` varchar(255) NOT NULL,
  `developer_email` varchar(255) NOT NULL,
  `developer_phone` varchar(255) NOT NULL,
  `developer_address` varchar(255) NOT NULL,
  `developer_lat` varchar(255) NOT NULL,
  `developer_lng` varchar(255) NOT NULL,
  `developer_join_date` date NOT NULL,
  `developer_since` date DEFAULT NULL,
  `developer_badan_hukum` varchar(255) DEFAULT NULL,
  `developer_resource` int(2) DEFAULT NULL,
  `developer_status` int(11) NOT NULL,
  `developer_created_date` datetime DEFAULT NULL,
  `developer_created_by` bigint(20) DEFAULT NULL,
  `developer_last_update` datetime DEFAULT NULL,
  `developer_last_update_by` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gis_developer_detail`
--

INSERT INTO `gis_developer_detail` (`developer_id`, `register_id`, `user_id`, `kecamatan_id`, `developer_name`, `developer_email`, `developer_phone`, `developer_address`, `developer_lat`, `developer_lng`, `developer_join_date`, `developer_since`, `developer_badan_hukum`, `developer_resource`, `developer_status`, `developer_created_date`, `developer_created_by`, `developer_last_update`, `developer_last_update_by`) VALUES
(1, 1, 4, 1, 'fachrul', 'kudatrojan102@gmail.com', '089630467896', 'Jl. Kayu Manis III\r\nPondok Cabe Udik', '-6.311416722862261', '106.82029851602512', '2020-09-07', '0000-00-00', NULL, NULL, 1, NULL, NULL, NULL, NULL),
(3, 3, 6, 3, 'test2', 'test2@mail.com', '0896304678961', 'Jl. Underpass SCBD No.5, RT.5/RW.1, Senayan, Kec. Kby. Baru, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12190, Indonesia', '-6.2258545', '106.8111289', '2021-06-26', '0000-00-00', NULL, NULL, 1, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `gis_developer_portofolio`
--

CREATE TABLE `gis_developer_portofolio` (
  `developer_portofolio_id` bigint(20) NOT NULL,
  `developer_id` bigint(20) NOT NULL,
  `developer_portofolio_name` varchar(255) NOT NULL,
  `developer_portofolio_address` varchar(255) NOT NULL,
  `developer_portofolio_phone` varchar(255) DEFAULT NULL,
  `developer_portofolio_email` varchar(255) DEFAULT NULL,
  `developer_portofolio_build_date_start` date DEFAULT NULL,
  `developer_portofolio_build_date_end` date DEFAULT NULL,
  `developer_portofolio_created_date` datetime DEFAULT NULL,
  `developer_portofolio_created_by` bigint(20) DEFAULT NULL,
  `developer_portofolio_last_update` datetime DEFAULT NULL,
  `developer_portofolio_last_update_by` bigint(20) DEFAULT NULL,
  `developer_portofolio_lat` varchar(255) DEFAULT NULL,
  `developer_portofolio_lng` varchar(255) DEFAULT NULL,
  `developer_portofolio_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `gis_developer_sbu`
--

CREATE TABLE `gis_developer_sbu` (
  `developer_sbu_id` bigint(20) NOT NULL,
  `developer_id` bigint(20) NOT NULL,
  `developer_sbu_created_date` date NOT NULL,
  `developer_sbu_exp_date` date NOT NULL,
  `developer_sbu_attachment_name` varchar(255) NOT NULL,
  `developer_sbu_attachment_url` varchar(255) NOT NULL,
  `developer_sbu_attachment_dir` varchar(255) NOT NULL,
  `developer_sbu_timestamp` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `gis_kecamatan`
--

CREATE TABLE `gis_kecamatan` (
  `kecamatan_id` int(11) NOT NULL,
  `kota_id` int(11) NOT NULL,
  `kecamatan_code` varchar(255) DEFAULT NULL,
  `kecamatan_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gis_kecamatan`
--

INSERT INTO `gis_kecamatan` (`kecamatan_id`, `kota_id`, `kecamatan_code`, `kecamatan_name`) VALUES
(1, 1, 'pcrn', 'pancoran'),
(3, 1, 'tbt', 'tebet');

-- --------------------------------------------------------

--
-- Table structure for table `gis_kota`
--

CREATE TABLE `gis_kota` (
  `kota_id` int(11) NOT NULL,
  `kota_name` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gis_kota`
--

INSERT INTO `gis_kota` (`kota_id`, `kota_name`) VALUES
(1, 'Jakarta Selatan'),
(2, 'Jakarta Barat'),
(4, 'jakarta utara'),
(5, 'jakarta timur');

-- --------------------------------------------------------

--
-- Table structure for table `gis_menu`
--

CREATE TABLE `gis_menu` (
  `menu_id` int(11) NOT NULL,
  `menu_url` varchar(255) NOT NULL,
  `menu_name` varchar(255) NOT NULL,
  `menu_nama` varchar(255) NOT NULL,
  `menu_parent` int(11) NOT NULL,
  `menu_child` int(11) NOT NULL,
  `menu_sort` int(11) NOT NULL,
  `menu_icon` varchar(255) DEFAULT NULL,
  `menu_status` int(11) NOT NULL,
  `menu_access` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gis_menu`
--

INSERT INTO `gis_menu` (`menu_id`, `menu_url`, `menu_name`, `menu_nama`, `menu_parent`, `menu_child`, `menu_sort`, `menu_icon`, `menu_status`, `menu_access`) VALUES
(1, 'home', 'Home', 'Home', 0, 0, 1, 'fa fa-home', 1, NULL),
(2, '#', 'Settings', 'Settings', 0, 1, 99, 'fa fa-cogs', 1, NULL),
(3, 'user_role', 'User Role', 'User Role', 2, 0, 3, 'fa fa-users', 1, 'create,read,update,delete'),
(4, 'users', 'Users', 'Users', 2, 0, 2, 'fa fa-users', 1, 'create,read,update,delete'),
(5, 'profile', 'Profile', 'Profile', 2, 0, 1, 'fa fa-user', 1, NULL),
(6, 'settings', 'System Settings', 'System Settings', 2, 0, 999, 'fa fa-cogs', 1, NULL),
(7, 'data_kecamatan', 'Data Kecamatan', 'Data Kecamatan', 2, 0, 1, NULL, 1, 'create,read,update,delete'),
(8, 'data_kota', 'Data Kota', 'Data Kota', 2, 0, 1, NULL, 1, 'create,read,update,delete'),
(9, '#', 'Pendaftaran', 'Pendaftaran', 0, 1, 88, NULL, 1, NULL),
(10, 'members_registration', 'Pendaftaran Anggota Baru', 'Pendaftaran Anggota Baru', 9, 0, 1, NULL, 1, 'read,approval'),
(11, '#', 'Manage', 'Manage', 0, 1, 77, NULL, 1, NULL),
(12, 'news', 'News', 'News', 11, 0, 1, NULL, 1, 'create,read,update,delete'),
(13, 'anggota', 'Anggota', 'Anggota', 11, 0, 1, 'fa fa-users', 1, 'create,read,update,delete');

-- --------------------------------------------------------

--
-- Table structure for table `gis_news`
--

CREATE TABLE `gis_news` (
  `news_id` bigint(20) NOT NULL,
  `user_id` int(11) NOT NULL,
  `news_slug` varchar(255) NOT NULL,
  `news_title` varchar(255) NOT NULL,
  `news_body` text NOT NULL,
  `news_tags` varchar(255) DEFAULT NULL,
  `news_created_date` datetime DEFAULT NULL,
  `news_created_by` bigint(20) DEFAULT NULL,
  `news_last_update` date DEFAULT NULL,
  `news_last_update_by` bigint(20) DEFAULT NULL,
  `news_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gis_news`
--

INSERT INTO `gis_news` (`news_id`, `user_id`, `news_slug`, `news_title`, `news_body`, `news_tags`, `news_created_date`, `news_created_by`, `news_last_update`, `news_last_update_by`, `news_status`) VALUES
(6, 1, 'asdasd', 'asdasd', '<p>adsadsasdad</p>\r\n', 'das,a sad,asdad', '2020-09-04 09:19:27', 1, NULL, NULL, 1),
(7, 1, 'asdasdasdasdasd', 'asdasdasdasdasd', '<p>asdasdasdasdasdasd</p>\r\n', 'sadasdasd', '2020-09-04 09:19:36', 1, NULL, NULL, 1),
(8, 1, 'vcdxvfdv', 'vcdxvfdv', '<p>adsasdasdasd</p>\r\n', 'asvcasvcav', '2020-09-04 09:19:42', 1, NULL, NULL, 1),
(9, 1, 'test-news-asas', 'test news asas', '<p>asdasdasdasd</p>\r\n\r\n<p><img alt=\"\" src=\"http://localhost/gis/assets/uploads/usersFiles/1/images/100050334_595772001045804_4617454493297295588_n.jpg\" style=\"height:500px; width:500px\" /></p>\r\n', 'asas,232dsd', '2020-09-07 11:24:53', 1, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `gis_register`
--

CREATE TABLE `gis_register` (
  `register_id` bigint(20) NOT NULL,
  `kecamatan_id` int(11) NOT NULL,
  `register_name` varchar(255) NOT NULL,
  `register_address` varchar(255) NOT NULL,
  `register_phone` varchar(255) NOT NULL,
  `register_email` varchar(255) NOT NULL,
  `register_username` varchar(255) NOT NULL,
  `register_password` varchar(255) NOT NULL,
  `register_uniq_code` varchar(255) NOT NULL,
  `register_recomended_by` varchar(255) NOT NULL,
  `register_lat` varchar(255) NOT NULL,
  `register_lng` varchar(255) NOT NULL,
  `register_badan_hukum` varchar(255) NOT NULL,
  `register_since` date NOT NULL,
  `register_resource` int(11) NOT NULL,
  `register_created_date` datetime NOT NULL,
  `register_last_update` datetime DEFAULT NULL,
  `register_last_update_by` int(11) DEFAULT NULL,
  `register_status` int(11) NOT NULL,
  `register_email_verify_status` int(11) DEFAULT NULL,
  `register_email_verify_date` datetime DEFAULT NULL,
  `register_mandatory_approve` int(11) DEFAULT NULL,
  `register_accept_agrement` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gis_register`
--

INSERT INTO `gis_register` (`register_id`, `kecamatan_id`, `register_name`, `register_address`, `register_phone`, `register_email`, `register_username`, `register_password`, `register_uniq_code`, `register_recomended_by`, `register_lat`, `register_lng`, `register_badan_hukum`, `register_since`, `register_resource`, `register_created_date`, `register_last_update`, `register_last_update_by`, `register_status`, `register_email_verify_status`, `register_email_verify_date`, `register_mandatory_approve`, `register_accept_agrement`) VALUES
(1, 1, 'fachrul', 'Jl. Kayu Manis III\r\nPondok Cabe Udik', '089630467896', 'kudatrojan102@gmail.com', 'fachrul', '8e1dae3b3c3ddea6d5cba3064a82f51d', 'gis_5f55f9e5b58f33.17328326', 'nurul', '', '', '', '0000-00-00', 0, '2020-09-07 11:14:14', '2020-09-07 11:15:55', 1, 1, 1, '2020-09-07 11:15:19', 1, 1),
(3, 3, 'test2', 'Jl. Underpass SCBD No.5, RT.5/RW.1, Senayan, Kec. Kby. Baru, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12190, Indonesia', '0896304678961', 'test2@mail.com', 'test2', 'ad0234829205b9033196ba818f7a872b', 'gis_60d7467c7f5844.73865438', 'test2', '-6.2258545', '106.8111289', '', '0000-00-00', 0, '2021-06-26 17:23:40', NULL, NULL, 1, 1, '2021-06-26 17:23:40', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `gis_register_attachment`
--

CREATE TABLE `gis_register_attachment` (
  `register_attachment_id` bigint(20) NOT NULL,
  `register_id` bigint(20) NOT NULL,
  `register_attachment_name` varchar(255) NOT NULL,
  `register_attachment_url` varchar(255) NOT NULL,
  `register_attachment_dir` varchar(255) NOT NULL,
  `register_attachment_type` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gis_register_attachment`
--

INSERT INTO `gis_register_attachment` (`register_attachment_id`, `register_id`, `register_attachment_name`, `register_attachment_url`, `register_attachment_dir`, `register_attachment_type`) VALUES
(1, 1, 'fpasphoto.jpg', 'http://localhost/gis/assets/uploads/register/089630467896/fpasphoto.jpg', './assets/uploads/register/089630467896/fpasphoto.jpg', 'File Pas Photo'),
(2, 1, 'fktp.jpg', 'http://localhost/gis/assets/uploads/register/089630467896/fktp.jpg', './assets/uploads/register/089630467896/fktp.jpg', 'File KTP Direktur'),
(3, 1, 'fakte.jpg', 'http://localhost/gis/assets/uploads/register/089630467896/fakte.jpg', './assets/uploads/register/089630467896/fakte.jpg', 'File Akte Pendirian'),
(4, 1, 'fketerangan.jpg', 'http://localhost/gis/assets/uploads/register/089630467896/fketerangan.jpg', './assets/uploads/register/089630467896/fketerangan.jpg', 'File Keterangan Domisili'),
(5, 1, 'fnpwp.jpg', 'http://localhost/gis/assets/uploads/register/089630467896/fnpwp.jpg', './assets/uploads/register/089630467896/fnpwp.jpg', 'File NPWP'),
(6, 1, 'fsiup.jpg', 'http://localhost/gis/assets/uploads/register/089630467896/fsiup.jpg', './assets/uploads/register/089630467896/fsiup.jpg', 'File SIUP'),
(7, 1, 'ftdp.jpg', 'http://localhost/gis/assets/uploads/register/089630467896/ftdp.jpg', './assets/uploads/register/089630467896/ftdp.jpg', 'File TDP'),
(8, 1, 'fsusunandewan.jpg', 'http://localhost/gis/assets/uploads/register/089630467896/fsusunandewan.jpg', './assets/uploads/register/089630467896/fsusunandewan.jpg', 'File Susunan Dewan'),
(9, 1, 'fpernyataan.jpg', 'http://localhost/gis/assets/uploads/register/089630467896/fpernyataan.jpg', './assets/uploads/register/089630467896/fpernyataan.jpg', 'File Pernyataan'),
(19, 3, 'fpasphoto.pdf', 'http://localhost/gis/assets/uploads/register/0896304678961/fpasphoto.pdf', './assets/uploads/register/0896304678961/fpasphoto.pdf', 'File Pas Photo'),
(20, 3, 'fktp.pdf', 'http://localhost/gis/assets/uploads/register/0896304678961/fktp.pdf', './assets/uploads/register/0896304678961/fktp.pdf', 'File KTP Direktur'),
(21, 3, 'fakte.pdf', 'http://localhost/gis/assets/uploads/register/0896304678961/fakte.pdf', './assets/uploads/register/0896304678961/fakte.pdf', 'File Akte Pendirian'),
(22, 3, 'fketerangan.pdf', 'http://localhost/gis/assets/uploads/register/0896304678961/fketerangan.pdf', './assets/uploads/register/0896304678961/fketerangan.pdf', 'File Keterangan Domisili'),
(23, 3, 'fnpwp.pdf', 'http://localhost/gis/assets/uploads/register/0896304678961/fnpwp.pdf', './assets/uploads/register/0896304678961/fnpwp.pdf', 'File NPWP'),
(24, 3, 'fsiup.pdf', 'http://localhost/gis/assets/uploads/register/0896304678961/fsiup.pdf', './assets/uploads/register/0896304678961/fsiup.pdf', 'File SIUP'),
(25, 3, 'ftdp.pdf', 'http://localhost/gis/assets/uploads/register/0896304678961/ftdp.pdf', './assets/uploads/register/0896304678961/ftdp.pdf', 'File TDP'),
(26, 3, 'fsusunandewan.pdf', 'http://localhost/gis/assets/uploads/register/0896304678961/fsusunandewan.pdf', './assets/uploads/register/0896304678961/fsusunandewan.pdf', 'File Susunan Dewan'),
(27, 3, 'fpernyataan.pdf', 'http://localhost/gis/assets/uploads/register/0896304678961/fpernyataan.pdf', './assets/uploads/register/0896304678961/fpernyataan.pdf', 'File Pernyataan');

-- --------------------------------------------------------

--
-- Table structure for table `gis_sessions`
--

CREATE TABLE `gis_sessions` (
  `id` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gis_sessions`
--

INSERT INTO `gis_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES
('004ojktkss33kt9ttnpljh7evemujl5n', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539393230323333323b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('05ucboqb2vi2c5lc5r85r8k4804r2g97', '127.0.0.1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313630303334323934393b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('0brsegptinfcpuho71i8drivt1avrv5s', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539383531393631323b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('0c31242gb38o0uic60qg9rtrre9ovjop', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539383432363136313b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('0fcuc8epjp4k3a3c3plrvqf18jbp5gip', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539383434363933363b),
('0hu1pse57oa0915mqmrkt6gu70ank8kj', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539383433313934373b),
('13gko17hdlko63nofh4e18anfssfps27', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539383432343537363b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('16qn3hnapcutqmqc3v9fgqtcsdlsbejm', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539383531363738333b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('17ffmvrhu83ol3q869l4j301p0eve3ea', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313632343638343934333b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('18a6fg3nnqrm4k5d9hc57mj2p03700ui', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313632343434373039363b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('1977v6rs7nrq30896aoamn58vu9ovfpu', '::1', '0000-00-00 00:00:00', ''),
('1i01hjj27p5bah75k0tf1mepkvle696v', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539383434313333393b),
('1i30a8vbto7j4numkdbkk3nr6lb0ep6r', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539383532333231343b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('1o2s6kcq9j6qhoh0ptj7m8qut4dg0mfg', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313631393631363338383b),
('1umfqtoppbmc48p52nf8587v7fc7odsm', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539393134313439303b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('20fb3cmmqc3is07qmjdiropq6nkph8qv', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539393134333230313b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('2372b6dofo3aeqcc7c0mp460o705m4gf', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313632303437383938383b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('23qocqpv0deeaklok6kakv9ecgcdf39r', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539383434313839353b),
('245j0j4kkvuo239qajqoj1ecp7kbuk6c', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313631393334343336393b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('27f22okc8c7j860mlmliimnb27caso37', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539383335383733363b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('2du0ttmqmssq7au0piqtje5v3t7bkqou', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539383335363230313b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('2hkfbvtrnfv633jer1fc288lv7tl8jjf', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539383532303933323b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('2l5e5v6e1hbb77p7la4o6c5njmquka0l', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313632343730323638393b),
('2pgiict8hk45g1cvv1po74s9f53ges8f', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313630343536323933373b),
('2r2nt7ioeesrsbivm088bmkh6e1v78ii', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539393230343436373b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('2skh9qjlgtmntpfrg2gn1vvog3ilq8pk', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539383434393232373b),
('2ukujdb5tva8mrb85398eta4krr8k4b4', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539393437303937353b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('31usvr0ja8odo2un3o91260532emun2c', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539383531383336363b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('34be35lieq6uh4gug5u27ss52t4sid1t', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539383432313235383b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('36085ohq8lipm2rpbflmrk58rc4r0qun', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313630343536323132353b),
('36ccggr8p2etsgbtc3qbuhq58gbkg8bc', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539383335363535353b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('387m6hkvg8u773g1gvp205mpmnjtucbv', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313632343732333135313b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('38rjhei1l0017ijlnmv83msn9ugolhts', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539393134353437353b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('3mda3ccm4a5h5ih8pp3eip6787aherrg', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313630343536353130353b),
('3oa24s6j8rtl00efrkljag5j9rdc70rn', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313630343536323532373b),
('3vqnmmi2t2g4q36nn792hf44j4rnf7tg', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539383532303631353b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('46mpaueicd4gs7ug4e97mpt4iregdv4l', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539393133363333383b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('4bkjb8mm19d9bsg5at3p8j8lu94oij32', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313631393234383037303b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('4cu2hqqkohtu1ihvasmrjek0vdu5cjs9', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539383435363531393b),
('4h4mbic27uhlde9c91qd99ju7msdvi1t', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539383435363835383b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('4l2oofs1r9rj7n3prp91suvbvj3pgbru', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313631393334333731353b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('4r2mg2kvnibo5m4b8g577fcm2kn5q3s6', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313631393334353732313b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('4rm9siht45k56fa6od9jtk4o02au3gtb', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539383434323631313b),
('4upc5aj5pjshc86iljobsqnikgrtmhk8', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539393134303532313b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('50vdelftguch1gmg98hc20orkbfl9lss', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313632343732323834363b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('5fqr9u6vojuovd8s5qpgtmnck997k4hl', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539393230333132343b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('5j3ni50ls3i702bct5btia0mnlg7rjs0', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539383335373334303b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('5m9na56npoq5m951jl8oh1aunnrpgu2f', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539393230323031323b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('5n5s8ccq6vtksigkdk6g61frv7skr47r', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539393134303838353b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('5smfm696brjl51capr4v65pg9qnaj0s9', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313630343536353639373b),
('647crcjkjlj3pqet3gt5345s0un630ea', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539393230353436383b),
('64k6u2gfpjr42mu9u5uktar190qtvo4s', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539383435393535333b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('665cm7hlm2stde85ra2iddr6bb0barq6', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539383432363939303b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('67scl9tbs1vd8s4jk7ch2f0781bj470k', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539383432323234303b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('6ee3java4s22od54oeqfd65fb33gjbcu', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539383434333130373b),
('6oafcvm295kim6sod1u0vstfpmmh28en', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539393134323131313b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('6oshtboe9mmr3l5tkuus3lp2ri5qb9j5', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539393230343136363b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('6qf2plojr8v745qgukcfin335f5rl114', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313631393333393533393b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('6suduvrf33962pl02tla0rraad1g3i33', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539393230313636313b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('6t4gsh8ek0v0f02os6ic8fr1018hm8n5', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539383335383431383b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('70okj5spkpqtcuvv213mnc3co3rtd14n', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313632343732313032323b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('7322e1rhtgockn9nrj8a5444kp4n2u3l', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313632343137303132373b),
('74504nbkncd9m25iv59u84n4m6j19bkt', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539383433323731353b),
('74ueevd0g517p7gb1l28638cp4kv3avq', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313631393333363432363b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('7bn5orodn9n2svo96gih97od9c05h9ap', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313631393334363234323b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('7ch77fdfeghdv45fl81hibrl4hefd1cp', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539393134343739383b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('7cottscokkiju0qngnu2skgjkfodsspf', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539383532313332333b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('7dqfb66vn7h4gdnk8h1g4idgs82lnirh', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539393230313033383b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('7q6h1nij9sh2vt4qu8mduqgsldh14dpb', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539393134333935373b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('7qc3vm5fuve1m5gdvo2npr7tl4f37sti', '127.0.0.1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313630303334303136343b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('824p8ne73uqov5mvfimd3tjgugi5sjkd', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313632343732343731373b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('87soh62hd0e7ic6a3a4bn9mjcuva1akd', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313630363938393939313b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('8jrno6tqdarbv82pk8kguor15mllbgcv', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539393437303131393b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2234223b733a383a22757365726e616d65223b733a373a226661636872756c223b733a373a22726f6c655f6964223b733a313a2233223b7d),
('8l4ilo28u50pqe2b8t8uegq3t7sgnlve', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539383432323537303b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('93mvi3jtei5bmep52g46270jtk5db7db', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539393230303433343b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('96ch6620tu76lrs337sbs4vhc3qeesqj', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313632343137333837383b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('98628qor7p0um5dgfua55d3kfsjp3d69', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539383436303731303b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('994e8qc442d643g6snl95rnp3m0m0f2t', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313631393334353337373b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('99rv0kovpqrn73jt4k801jm265g52srn', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539383435363038363b),
('9aks8u6gmta7bncl8q3iasm6roam9v4r', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539383434353433313b),
('9ibs5k2qac365t473ihf5uopdfva5q3e', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539393436383332383b),
('9ifedc60qojk5ruoaj3f3a2ggrb8lta7', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539383531393932343b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('9intih561itn2184f8di4lunkviqh59i', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539383434343638373b),
('9orqefn515qgf4vr2b65ho9vdfk880ch', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539393437303937353b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('agrmr4bunat2e574n4433guhg1fem514', '127.0.0.1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313630303334323336373b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('aicrrravv8p67uv8k8u4uets8vhvsp2f', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313631393335333232313b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('ajuo28196j3p9lr5m8k1q19t6gtenpap', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313632343639333739323b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('al24ivb85tn1hqt5jdoqj9rf105lg33r', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539383432353835333b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('at65mijm7v6aejp98k9jvff001p45jic', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539383435393230393b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('b03ro0ecvt0sh2fqj4tlt34b9j7lp78v', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313631393334343637383b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('b0b2hqf8s0m7hhm84nga9cic21a5mc3i', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539393134353437353b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('b3rhsgcaj2gfan83v6or60vdtdleshj2', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539383432363439313b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('bgcm8d801hdc2bbr1pnh7jkli7cqdqs6', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539383335393035333b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('bgksukp5pv49mgda9gqrs31q05l36n3u', '127.0.0.1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313630303333383638393b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('bi7936afgd6d1sj3crd88ojonqu7qefo', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539393230363039323b),
('bnfnsco4bbpo0l7dtae6pkvqgoobjaeh', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539383435393531383b),
('c1a8j4uvml37bmned4a9m7e7vngikkg1', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539383432353534323b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('c2u6jr6oc93tkhnes09qdbs6gl2qb9vs', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313631393333353034313b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('c5gs1b0fftdbnt8i0p3ejiatlv1c2q3l', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539393134313830373b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('cbbpgv14mj1oou8a65lr4kb7tfk8g81u', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313631393334363937343b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('cc3h2cniq3cl9folmv8jm9gepabne7k4', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539393230353131333b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('cfvl6plfcj8dk02jf4m2kebb4c3a8mn9', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539383532333833313b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('chgctd0q638m6ni3bvsgvrhm69fb86qb', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539383432333533383b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('chhl5bdrhpnr74khqgd95i3mm69pvb8n', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539393230333531333b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('cuhsue6fn37b10iv8u18pr9buevdajgc', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313631393935353134353b),
('d3jas6bv411kcdh2mnij0d82n469vmkt', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539383432383339343b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('d48l75f6885mpqiujbau9cnqjmoui76p', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539383434373234363b),
('ddcjuqcnh4drkvjd663jqquvcso02age', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313631393836383232383b),
('di13i861i8bq28e8k09hl3nicp93hcm6', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313632323336393536393b),
('dps4l3834vuhao2al015qrihgdvmvijr', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539383435393531383b),
('e3ehcahjbaacqaqcvmf72iusulp6rkdi', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313631393836383639343b),
('ecg50p5p7j1jj2qgpgpatqq61b4agh7i', '127.0.0.1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313630303333393032303b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('eg75tjpirlq69rnlkd7dsops1bojt44v', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539383335383030373b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('ev57irefucgu5o4aepujqnaj3lrhlurd', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539383434323231343b),
('evn0rlbicbjgj6v38pssgsko06qc6i56', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313632343137333837383b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('f7evlb5d1241vd1vac5qnrg81rn2t7bt', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539383432393335323b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('f9vv45hm6eban6bbrea07s7apvut2bdb', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313631393334303837313b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('fefvi902alo4fdagmg3g4nj2j9inckd6', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313631393333373234313b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('fjqn11bif42ol861une6f5oqgkvtkk6r', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539383335373033363b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('fju8lcp30m9tghspnhjtcdhmjtdbj3j5', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313632343137303630343b),
('ftko46pp3nr13uf5r7kp9sg7t33sa873', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313631393333373736363b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('g79vf31rducojm9b7dn1n56hs7m7dd29', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313631393935353134353b),
('gf971j3gefd9e88dkftuqno9ivb0jn5f', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539383531373132343b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('ghr52mfugf7k9tqt72iq9mv5jt0f4162', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539393636333931363b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('ghs8gaknm55sbk1kr34ggig3127raf70', '127.0.0.1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313630303333383332363b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('grpj8blorp4ncdt9g4k7v3ln57kbmfs4', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539383434373536343b),
('h1ftbblu92pd0sccgmhcentefd4cj474', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539383432313630353b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('h60icu9qf6sfo5uec5dnssdgf0m2hv8e', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539383435343335373b),
('h6t6kl59vv7m4itja84hnfodk3ogjge2', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313630303334343031303b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('hjf5brmdqgvk08ulh9e3s8lc7fq1571n', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313632343732303731343b),
('hn8ol8v7mf38ucdumuheioa3i2cqe6o7', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539393133363032343b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('hna6tlri668mra0f7ofm27ca7tb66jrm', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539383434383833333b),
('ho2mjbqacfrm7bgln63h9rljjsehjf0b', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539393537303530393b),
('hpvkg7l0kptfaa4i91sf1ggte6q9i8od', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539393436373139353b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('hrrkd261kgqrt56aul8lpqubdqjkg6de', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539383433323235303b),
('hs7dqi9ihl2krl15col2j1fqqram5bp2', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539383335353434343b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('i2atujqkh47u1b1bikhc9qqcuiag4b1d', '127.0.0.1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313630303333393830313b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('i4uar4m4us14ok1hdtl8ah554qvv914k', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539393134343236373b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('icogrn5f8k4kgbqk2sgcnffhln2sk17u', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313631393333393231343b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('iiqd5pgfcfjbgs54mmhdjtqlsghgiij4', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539393437303637303b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('is0sv9fnn6m72f0ubssi3mkubfvdev23', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539383434393633313b),
('iuei4pji7v12nbjcvsk6b5rpumrt3mvk', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313631393836363136373b),
('ivbsnbgespkegji9dur4bfmjm3gvh1kn', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539383432343930303b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('j1v1k7maa0jj8elp81pdgb8drt09qrqu', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539383435303033353b),
('j61h95aaqo8k8ifo4bmvtvjuac7egpes', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539393133363938363b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('j6aeo93u7ldehlj993dje306buu2r90u', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539383336313134323b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('j93aiu182ulunt7einq2lsqgrh6d68df', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539383434373934393b),
('j95b3kebq74nkahnrt36dst5l6ahjgun', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313631393334313434323b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('jbr397d5p8p1j3fokha3lq5nfj1gfunv', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539393134303230313b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('jdpi3l887v2pb3cieav37mco0ape5s1g', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313631393631363338383b),
('jfsp49rahsheqjfsmj1mo5nl25sc4jnt', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539383335353834313b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('jgsl4khcus50damib39pddtk7cl0chqe', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539383434353836383b),
('jqeqbn7tlp2546g5vhgl62ntl7k5cvgd', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539383335373730343b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('jrebp7gbas0t857b8kaivqcjrqqvmkrf', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313631393334323433323b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('jse8ai9f8gcrgefg6a42ba4oppg8jp4b', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313631393333343732353b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('k6gu00hvs3d176v5bf38ft1n04amgv3t', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539393230353738343b),
('kise9k9imhoh5u3fl483bk9l3gbcoujg', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539383435373332373b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('kkhs469j0coao5uq9mi8f2rkne8q27mn', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539393134323836323b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('kn3l73l37i5rkv020vk067bglfmst1sa', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313630343536363731363b),
('kvqv3vaskord1erbuq0jpak5vlncrodd', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539383532303331323b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('lalofr2kir65sigihfhbq3e6q1r521n6', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539383532333532343b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('lb8kqkrbo2q5r8s4v905e2b12pkcd5go', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313631393334363630343b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('lh9vtiprb672vtp9fud9tg09r3a6f15e', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539383532343137333b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('lvpt2er6casic48dhltdb74s1aj35985', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313631393836383639343b),
('m12t9lqthgfejsl85cmg3egh9emsg4q9', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539383434333932333b),
('m1377fc4mgt2k5r3iukibvubcc9e952d', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539383531363131393b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('m1vfvkkqiionm5hhescm5252729mj3ad', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313631393333383836373b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('m3fhrcqc9g8o13ctqlgn62v8b85rnsjj', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313631393333383531373b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('m4iqsldab3mrbldsi2tspetdn7hhipuu', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539383336303732393b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('m70tlm5ptb5ev05ogcqsc6avhfr8fcdp', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539383432393335323b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('m7evftp9fu8bu84memch1r8llugtsdob', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313631393334323037333b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('maaeijs1lmv6nhgeifmk7p30pga4jplq', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539383432333133303b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('mbqrenjb1k6bffut3he681niou90snb5', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539383433323731353b),
('mc7o1vmci1ikk2jelj12rsh7rrac4ui4', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313631393335333232313b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('mha19ekjvg0hdlsbq0vsi5e8ac1i1gg3', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539383435313833363b),
('mjshhrrgkik3dqk4qidk3amcf0snfh8c', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539393230343830373b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('mk2eiun0n1mjdt3jvfrjc8dtr4ond7kh', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313632343732333439313b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('n4gi80m0mlb84dt4l0qierr9v4tt8l8j', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539383335353133373b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('n8gsj6bb3tvldsvvmtrhk3pild9gatch', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313632343137323633353b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('n96ls87j7cdisg9vv0ts49iv7153vei5', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539383432383039323b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('n9rsugsq4fum9skjrqdfcttldgcnjfas', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539383432373734363b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('naboohumft18vih5o4nv3mhucfgqsfef', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313632343732353836383b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('ng3u6rpvbuh17joob8b4l84s3lgs9c0e', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313630343536343131353b),
('nj4qgcuqqlrlfv5lmu7h1917fl8uscug', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539383436303338393b),
('np6ebn204ssrm6l9amfbfrr9dr7rf017', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313630343536333739303b),
('oerufgus5m7lgknf7hglm50v33rks9gj', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539383336303337303b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('ofmjdh796qs9b4phmjd6p9a2a7qatem7', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313631393333333538373b),
('oh1rfn4neotg3va2bl1ppi9bm4ge4jul', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539383434353036313b),
('ojub32dooehpc7as0d25bephqaaoch5u', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539383531393132343b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('olltr92jnfipa59lp0a4bu6e6uk9stu9', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539393437303036333b),
('op2e1r9ag0f7s51lpsj91g3lai93s1ec', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313632343732323233353b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('op8iiav5v1lskde6p46qsridvlon4d2e', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313632343639333739323b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d);
INSERT INTO `gis_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES
('oq5tlm2s59ljqlt6362r3n733t5mv693', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313632343732353531353b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('oqnp74436d39k0irbm2v37fc39l3e386', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539383434363234343b),
('otp6el92s8ibh4j08cc5dqvhtdo4st4m', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539383432333834363b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('p03o7dvtgat0cpbr8pe232iicp8nmrls', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313630343536343738353b),
('p17o5pcdek07gafrb57u0nnucc06p6rt', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539383435393231373b),
('p1em322f4h8b24u61hu021g0mssed4cm', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313631393333363130383b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('p5e52hr40ui06ddg3jqkmiggkgsd76ma', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313631393333383136303b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('peoso1jfkolok6e75kfs1ej89353o7ke', '::1', '0000-00-00 00:00:00', ''),
('pk76so8gmj3rt2di3viuv6620alcs6oe', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539383335343831353b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('pr5csfttlessnfjietb4sakqn2bnt2t6', '127.0.0.1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313630303334343031303b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('q07laip3e13v8i29ja32g82f0hfuonmd', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313632343138343338323b),
('q7954taba994c1b6uh9dlj80ts4i0474', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313631393334303532313b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('q8cf0bmt6k2npuk20a8gciiajjuu40jl', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313632343732363231323b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('q9jcndd9uslocv302egefo6fvvpbc4uh', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539393133383735333b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('qc591viibk7hug1csqh2lt2rdfh4uou0', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313632343732363630343b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('qcnhodmin53ptig1irg0uhm6g2n03i67', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313631393333363838373b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('qfsr4qgg5mhc50so8dt8095oj2g3493j', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313631393234383037303b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('qg06pd8curea5t0aht7tlqbj46516mhg', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539383336313134323b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('qib8hshbge0dqmm11bnc9pu9eidq6gf3', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539393134333535313b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('qip6g8jha121td6dvam4i1ed6a40esh0', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313632303437383938363b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('qksfrrjqh00p616ms4it6esubl1m64re', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313632323337313535383b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('qmcieh4bqisoe9263pg0eo70g10jkcts', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539383436303731303b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('qrd2g0n2p4c387rmhrk5kuut65g7dn5l', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313632323337313535383b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('r1qdl0svbu9kig7u00h5qhgj9j4c89uq', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539393230363236373b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('r938b2ftume7sel4l59q822uiqpdgu2c', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539383531383032333b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('rb43e0iomnfm9a42pibsctutinl2jecd', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539383435373632383b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('rddeouttoinkriv7m6p5crqiun0iv94u', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539393230323637343b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('rdefc64ebjbpk2on1g7ats2u63080cr1', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539383435383230323b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('re1dc91tt9v7b2b09tho0mdfb5p0bp09', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313630343536343433343b),
('rieiddlo3dn4he78niofjifesv3griui', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539383432353233303b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('rokcfc40asnl1rp2ttp9bulptjajdb49', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539383435323932303b),
('rp69r8ter63528r2r447u1pd0f3c1vok', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313630353934333232333b),
('rq878t1v3svttde5kabd6ki0q4d0rd1b', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539383532323831323b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('ru0v1nf8smq13qfbtdhkoud7u3luasdq', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539393436353535393b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('s4ekgbqca7mirub6o0v0fv7vmo4ku8ks', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313631393234333232343b),
('s6pd8kckdpqcftf7bnb17dr9vm56l7j9', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539383432313930373b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('sqquvm90u0k5q81i7knavgjof92ugo5h', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539383434363535353b),
('t099kk7unsc8umqupuh8hc2ajukbk1uf', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313632343732333838353b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('t3ojf37dvm2c45622jqkj610qmurmhn3', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313632343137333430393b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('t7id4770vo65u128h6p61hlg17ogjqmi', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313631393334353035303b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('ta1ap447g864hp74ql0qr47fpevbaftk', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539383531373534323b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('tgrc4cd6icssfnn39fjn8ii67o881qf1', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313632343732323534303b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('tjij06lstmkee84ida8cn9tdjs0sjs6h', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313632343732343333383b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('tkqrdd7en0on12hkmf0hccnu5clori3t', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313631393836373931383b),
('trcf8c4v2st91u23bmlmadtdu6d111rv', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313631393334343032313b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('tvdqudsgm6ci3g271moeigbfllrabho1', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539393230313334383b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('u3t3j87enime0mms2jvjaij7p472fmuf', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313631393334333138323b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('u6sqhbs9tv4oejob8nto0fi20n9ft5ru', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539393133393235323b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('u9dk4vmqq648fq54oivocra0ib7vsgc7', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539383532343137333b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('ufl58ic8h7h7enh85fi9lfn4l9e7sef0', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539383532323439353b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('ug8dnkajqntft3pl0s0k0kpn9kucjb61', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539383432373332363b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('uh25js2k0u6fdpqcjsq65bc6h08uh1jv', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539383531383738313b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('uh2g9m6v6rsuq2uf7278pe6g5b5a14s5', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313630343536363731363b),
('ui5c3mi2bgaregjg7g24kjb27nujftup', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313632343732363630343b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('uk80otoqnob8v1o3qciu88od3jbffppa', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313630343536363034303b),
('ulasmu9sk6b4uhtfm9859emoncak6817', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539383436303035383b),
('um8i9ir6o0s51qj54118d08j86relum0', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539383531353531323b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('uphc15q6ie05nuvuh9u16m7qn3t4362a', '127.0.0.1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313630303333393438383b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('ut0jkis0c5mk79he84kg3prp7b8uu5fl', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539383434343335373b),
('uu11cck3dpur3do5th83jqmuchcjs78p', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313631393333333930333b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('v0b5hjjtcpnth7ti7abdfclpjv8qpktj', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313632343732353139303b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('v4fg2h22ap8s14oce33nccduil59sg2j', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313631393333343333383b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('vgmnvaqj2q8ha71e6hbjoab9ls8mc2gc', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539383434383334313b),
('vla6rgnpmcaaba8ja0l10197eghr09ie', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313630343536363338313b),
('vq6fvnigqf4r60lmb3ifdirubdqp65a7', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539393230333834313b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d);

-- --------------------------------------------------------

--
-- Table structure for table `gis_system_settings`
--

CREATE TABLE `gis_system_settings` (
  `system_settings_id` int(11) NOT NULL,
  `system_settings_app_name` varchar(255) NOT NULL,
  `system_settings_app_header_text` varchar(255) NOT NULL,
  `system_settings_app_footer_text` varchar(255) NOT NULL,
  `system_settings_app_footer_year` int(11) NOT NULL,
  `system_settings_app_about` text DEFAULT NULL,
  `system_settings_app_logo_header` varchar(255) DEFAULT NULL,
  `system_settings_app_logo_icon` varchar(255) DEFAULT NULL,
  `system_settings_smtp_host` varchar(255) DEFAULT NULL,
  `system_settings_smtp_user` varchar(255) DEFAULT NULL,
  `system_settings_smtp_password` varchar(255) DEFAULT NULL,
  `system_settings_smtp_crypto` varchar(255) DEFAULT NULL,
  `system_settings_smtp_port` int(11) DEFAULT NULL,
  `system_settings_smtp_from` varchar(255) DEFAULT NULL,
  `system_settings_smtp_alias` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gis_system_settings`
--

INSERT INTO `gis_system_settings` (`system_settings_id`, `system_settings_app_name`, `system_settings_app_header_text`, `system_settings_app_footer_text`, `system_settings_app_footer_year`, `system_settings_app_about`, `system_settings_app_logo_header`, `system_settings_app_logo_icon`, `system_settings_smtp_host`, `system_settings_smtp_user`, `system_settings_smtp_password`, `system_settings_smtp_crypto`, `system_settings_smtp_port`, `system_settings_smtp_from`, `system_settings_smtp_alias`) VALUES
(1, 'GIS REI JAKARTA', 'sadasdasd', 'sadasdasd', 32432, 'asdasdasd', 'logo.png', 'icon.png', 'smtp.gmail.com', 'helmyfikrih@gmail.com', '20mei1996', 'ssl', 465, 'helmyfikrih@gmail.com', 'GIS REI JAKARTA');

-- --------------------------------------------------------

--
-- Table structure for table `gis_user`
--

CREATE TABLE `gis_user` (
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `user_username` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_created_date` datetime DEFAULT NULL,
  `user_created_by` int(11) DEFAULT NULL,
  `user_last_update` datetime DEFAULT NULL,
  `user_last_update_by` int(11) DEFAULT NULL,
  `user_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gis_user`
--

INSERT INTO `gis_user` (`user_id`, `role_id`, `user_username`, `user_email`, `user_password`, `user_created_date`, `user_created_by`, `user_last_update`, `user_last_update_by`, `user_status`) VALUES
(1, 1, 'admin', 'helmy.efha@gmail.com', '21232f297a57a5a743894a0e4a801fc3', NULL, NULL, '2020-09-07 10:01:15', 1, 1),
(4, 3, 'fachrul', 'kudatrojan102@gmail.com', '8e1dae3b3c3ddea6d5cba3064a82f51d', '2020-09-07 11:14:14', NULL, NULL, NULL, 1),
(6, 3, 'test2', 'test2@mail.com', 'ad0234829205b9033196ba818f7a872b', '2021-06-26 17:23:40', NULL, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `gis_user_detail`
--

CREATE TABLE `gis_user_detail` (
  `ud_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `ud_full_name` varchar(255) DEFAULT NULL,
  `ud_gender` varchar(1) DEFAULT NULL,
  `ud_address` varchar(255) DEFAULT NULL,
  `ud_birth_place` varchar(255) DEFAULT NULL,
  `ud_birth_date` date DEFAULT NULL,
  `ud_phone` varchar(255) DEFAULT NULL,
  `ud_img_name` varchar(255) DEFAULT NULL,
  `ud_img_url` varchar(255) DEFAULT NULL,
  `ud_last_update` datetime DEFAULT NULL,
  `ud_last_update_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gis_user_detail`
--

INSERT INTO `gis_user_detail` (`ud_id`, `user_id`, `ud_full_name`, `ud_gender`, `ud_address`, `ud_birth_place`, `ud_birth_date`, `ud_phone`, `ud_img_name`, `ud_img_url`, `ud_last_update`, `ud_last_update_by`) VALUES
(1, 1, 'Helmi Fikri ', 'L', 'asdasd      ', 'asdasd', '1996-08-07', '089630467896', '1_admin.png', 'http://localhost/gis/assets/uploads/images/avatar/1_admin.png', '2020-08-23 18:01:12', 1);

-- --------------------------------------------------------

--
-- Table structure for table `gis_user_role`
--

CREATE TABLE `gis_user_role` (
  `role_id` int(11) NOT NULL,
  `role_code` varchar(255) DEFAULT NULL,
  `role_name` varchar(255) NOT NULL,
  `role_allow_menu` text DEFAULT NULL,
  `role_status` int(11) DEFAULT NULL,
  `role_created_date` datetime DEFAULT NULL,
  `role_created_by` int(11) DEFAULT NULL,
  `role_last_update` datetime DEFAULT NULL,
  `role_last_update_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gis_user_role`
--

INSERT INTO `gis_user_role` (`role_id`, `role_code`, `role_name`, `role_allow_menu`, `role_status`, `role_created_date`, `role_created_by`, `role_last_update`, `role_last_update_by`) VALUES
(1, 'spadm', 'Super Admin', '1,11,12,level_12_create,level_12_read,level_12_update,level_12_delete,13,level_13_create,level_13_read,level_13_update,level_13_delete,9,10,level_10_read,level_10_approval,2,5,7,level_7_create,level_7_read,level_7_update,level_7_delete,8,level_8_create,level_8_read,level_8_update,level_8_delete,4,level_4_create,level_4_read,level_4_update,level_4_delete,3,level_3_create,level_3_read,level_3_update,level_3_delete,6', 1, '2020-09-17 12:23:10', 1, NULL, NULL),
(2, 'validator', 'validator', '1,2,5,7,level_7_create,level_7_read,level_7_update,level_7_delete,8,level_8_create,level_8_read,level_8_update,level_8_delete,4,level_4_create,level_4_read,level_4_update,level_4_delete,3,level_3_create,level_3_read,level_3_update,level_3_delete,6', 1, '2020-08-26 18:11:02', 1, NULL, NULL),
(3, 'Developer', 'Developer', '1', 1, '2020-08-26 18:10:50', 1, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `gis_contact_inbox`
--
ALTER TABLE `gis_contact_inbox`
  ADD PRIMARY KEY (`contact_inbox_id`);

--
-- Indexes for table `gis_contact_outbox`
--
ALTER TABLE `gis_contact_outbox`
  ADD PRIMARY KEY (`contact_outbox_id`),
  ADD KEY `relationship_5` (`user_id`);

--
-- Indexes for table `gis_contact_reply`
--
ALTER TABLE `gis_contact_reply`
  ADD PRIMARY KEY (`contact_reply_id`),
  ADD KEY `relationship_3` (`contact_inbox_id`),
  ADD KEY `relationship_4` (`contact_outbox_id`);

--
-- Indexes for table `gis_developer_detail`
--
ALTER TABLE `gis_developer_detail`
  ADD PRIMARY KEY (`developer_id`),
  ADD KEY `relationship_11` (`user_id`),
  ADD KEY `relationship_8` (`register_id`);

--
-- Indexes for table `gis_developer_portofolio`
--
ALTER TABLE `gis_developer_portofolio`
  ADD PRIMARY KEY (`developer_portofolio_id`),
  ADD KEY `relationship_9` (`developer_id`);

--
-- Indexes for table `gis_developer_sbu`
--
ALTER TABLE `gis_developer_sbu`
  ADD PRIMARY KEY (`developer_sbu_id`),
  ADD KEY `relationship_10` (`developer_id`);

--
-- Indexes for table `gis_kecamatan`
--
ALTER TABLE `gis_kecamatan`
  ADD PRIMARY KEY (`kecamatan_id`);

--
-- Indexes for table `gis_kota`
--
ALTER TABLE `gis_kota`
  ADD PRIMARY KEY (`kota_id`);

--
-- Indexes for table `gis_menu`
--
ALTER TABLE `gis_menu`
  ADD PRIMARY KEY (`menu_id`);

--
-- Indexes for table `gis_news`
--
ALTER TABLE `gis_news`
  ADD PRIMARY KEY (`news_id`),
  ADD KEY `relationship_6` (`user_id`);

--
-- Indexes for table `gis_register`
--
ALTER TABLE `gis_register`
  ADD PRIMARY KEY (`register_id`);

--
-- Indexes for table `gis_register_attachment`
--
ALTER TABLE `gis_register_attachment`
  ADD PRIMARY KEY (`register_attachment_id`),
  ADD KEY `relationship_7` (`register_id`);

--
-- Indexes for table `gis_sessions`
--
ALTER TABLE `gis_sessions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gis_system_settings`
--
ALTER TABLE `gis_system_settings`
  ADD PRIMARY KEY (`system_settings_id`);

--
-- Indexes for table `gis_user`
--
ALTER TABLE `gis_user`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `relationship_2` (`role_id`);

--
-- Indexes for table `gis_user_detail`
--
ALTER TABLE `gis_user_detail`
  ADD PRIMARY KEY (`ud_id`),
  ADD KEY `relationship_1` (`user_id`);

--
-- Indexes for table `gis_user_role`
--
ALTER TABLE `gis_user_role`
  ADD PRIMARY KEY (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `gis_contact_inbox`
--
ALTER TABLE `gis_contact_inbox`
  MODIFY `contact_inbox_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gis_contact_outbox`
--
ALTER TABLE `gis_contact_outbox`
  MODIFY `contact_outbox_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gis_contact_reply`
--
ALTER TABLE `gis_contact_reply`
  MODIFY `contact_reply_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gis_developer_detail`
--
ALTER TABLE `gis_developer_detail`
  MODIFY `developer_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `gis_developer_portofolio`
--
ALTER TABLE `gis_developer_portofolio`
  MODIFY `developer_portofolio_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gis_developer_sbu`
--
ALTER TABLE `gis_developer_sbu`
  MODIFY `developer_sbu_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gis_kecamatan`
--
ALTER TABLE `gis_kecamatan`
  MODIFY `kecamatan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `gis_kota`
--
ALTER TABLE `gis_kota`
  MODIFY `kota_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `gis_menu`
--
ALTER TABLE `gis_menu`
  MODIFY `menu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `gis_news`
--
ALTER TABLE `gis_news`
  MODIFY `news_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `gis_register`
--
ALTER TABLE `gis_register`
  MODIFY `register_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `gis_register_attachment`
--
ALTER TABLE `gis_register_attachment`
  MODIFY `register_attachment_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `gis_system_settings`
--
ALTER TABLE `gis_system_settings`
  MODIFY `system_settings_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `gis_user`
--
ALTER TABLE `gis_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `gis_user_detail`
--
ALTER TABLE `gis_user_detail`
  MODIFY `ud_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `gis_user_role`
--
ALTER TABLE `gis_user_role`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `gis_contact_outbox`
--
ALTER TABLE `gis_contact_outbox`
  ADD CONSTRAINT `relationship_5` FOREIGN KEY (`user_id`) REFERENCES `gis_user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `gis_contact_reply`
--
ALTER TABLE `gis_contact_reply`
  ADD CONSTRAINT `relationship_3` FOREIGN KEY (`contact_inbox_id`) REFERENCES `gis_contact_inbox` (`contact_inbox_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `relationship_4` FOREIGN KEY (`contact_outbox_id`) REFERENCES `gis_contact_outbox` (`contact_outbox_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `gis_developer_detail`
--
ALTER TABLE `gis_developer_detail`
  ADD CONSTRAINT `relationship_11` FOREIGN KEY (`user_id`) REFERENCES `gis_user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `relationship_8` FOREIGN KEY (`register_id`) REFERENCES `gis_register` (`register_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `gis_developer_portofolio`
--
ALTER TABLE `gis_developer_portofolio`
  ADD CONSTRAINT `relationship_9` FOREIGN KEY (`developer_id`) REFERENCES `gis_developer_detail` (`developer_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `gis_developer_sbu`
--
ALTER TABLE `gis_developer_sbu`
  ADD CONSTRAINT `relationship_10` FOREIGN KEY (`developer_id`) REFERENCES `gis_developer_detail` (`developer_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `gis_news`
--
ALTER TABLE `gis_news`
  ADD CONSTRAINT `relationship_6` FOREIGN KEY (`user_id`) REFERENCES `gis_user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `gis_register_attachment`
--
ALTER TABLE `gis_register_attachment`
  ADD CONSTRAINT `relationship_7` FOREIGN KEY (`register_id`) REFERENCES `gis_register` (`register_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `gis_user`
--
ALTER TABLE `gis_user`
  ADD CONSTRAINT `relationship_2` FOREIGN KEY (`role_id`) REFERENCES `gis_user_role` (`role_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `gis_user_detail`
--
ALTER TABLE `gis_user_detail`
  ADD CONSTRAINT `relationship_1` FOREIGN KEY (`user_id`) REFERENCES `gis_user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
