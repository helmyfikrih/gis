-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 23, 2021 at 07:21 PM
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
-- Table structure for table `gis_developer_detail`
--

CREATE TABLE `gis_developer_detail` (
  `developer_id` bigint(20) NOT NULL,
  `register_id` bigint(20) NOT NULL,
  `user_id` int(11) NOT NULL,
  `kecamatan_id` int(11) NOT NULL,
  `kategori_develoepr_id` int(11) DEFAULT NULL,
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
-- Table structure for table `gis_kategori_developer`
--

CREATE TABLE `gis_kategori_developer` (
  `kategori_developer_id` int(11) NOT NULL,
  `kategori_developer_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gis_kategori_developer`
--

INSERT INTO `gis_kategori_developer` (`kategori_developer_id`, `kategori_developer_name`) VALUES
(1, 'kecil'),
(2, 'sedang'),
(3, 'besar'),
(4, 'sangat besar');

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
(1, 1, 'kec01', 'Cilandak '),
(2, 1, 'kec02', 'Jagakarsa'),
(3, 1, 'kec03', 'Kebayoran Baru'),
(4, 1, 'kec04', 'Kebayoran Lama'),
(5, 1, 'kec05', 'Mampang Prapatan'),
(6, 1, 'kec06', 'Pancoran '),
(7, 1, 'kec07', 'Tebet'),
(8, 1, 'kec08', 'Setiabudi'),
(9, 1, 'kec09', 'Pesanggrahan'),
(10, 1, 'kec10', 'Pasar Minggu'),
(11, 2, 'kec11', 'Cakung'),
(12, 2, 'kec12', 'Cipayung'),
(13, 2, 'kec13', 'Ciracas'),
(14, 2, 'kec14', 'Duren Sawit'),
(15, 2, 'kec15', 'Jatinegara'),
(16, 2, 'kec16', 'Kramat Jati'),
(17, 2, 'kec17', 'Makasar'),
(18, 2, 'kec18', 'Matraman'),
(19, 2, 'kec19', 'Pasar Rebo'),
(20, 2, 'kec20', 'Menteng'),
(21, 2, 'kec21', 'Pulo Gadung'),
(22, 3, 'kec22', 'Cengkareng'),
(23, 3, 'kec23', 'Grogol Petamburan'),
(24, 3, 'kec24', 'Kalideres'),
(25, 3, 'kec25', 'Kebon Jeruk'),
(26, 3, 'kec26', 'Kembangan'),
(27, 3, 'kec27', 'Palmerah'),
(28, 3, 'kec28', 'Taman Sari'),
(29, 3, 'kec29', 'Tambora'),
(30, 4, 'kec30', 'Cilincing'),
(31, 4, 'kec31', 'Kelapa Gading'),
(32, 4, 'kec32', 'Koja'),
(33, 4, 'kec33', 'Pademangan'),
(34, 4, 'kec34', 'Penjaringan'),
(35, 4, 'kec35', 'Tanjung Priok'),
(36, 5, 'kec36', 'Cempaka Putih'),
(37, 5, 'kec37', 'Gambir'),
(38, 5, 'kec38', 'Johar Baru'),
(39, 5, 'kec39', 'Kemayoran'),
(40, 5, 'kec40', 'Menteng'),
(41, 5, 'kec41', 'Sawah Besar'),
(42, 5, 'kec42', 'Senen'),
(43, 5, 'kec43', 'Tanah Abang');

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
(2, 'Jakarta Timur'),
(3, 'Jakarta Barat'),
(4, 'Jakarta Utara'),
(5, 'Jakarta Pusat'),
(6, 'pulau seribu');

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
(4, 'users', 'Users', 'Users', 11, 0, 2, 'fa fa-users', 1, 'create,read,update,delete'),
(5, 'profile', 'Profile', 'Profile', 2, 0, 1, 'fa fa-user', 1, NULL),
(6, 'settings', 'System Settings', 'System Settings', 2, 0, 999, 'fa fa-cogs', 1, NULL),
(7, 'data_kecamatan', 'Data Kecamatan', 'Data Kecamatan', 2, 0, 1, NULL, 1, 'create,read,update,delete'),
(8, 'data_kota', 'Data Kota', 'Data Kota', 2, 0, 1, NULL, 1, 'create,read,update,delete'),
(9, '#', 'Pendaftaran', 'Pendaftaran', 0, 1, 88, NULL, 1, NULL),
(10, 'members_registration', 'Pendaftaran Anggota Baru', 'Pendaftaran Anggota Baru', 9, 0, 1, NULL, 1, 'read,approval'),
(11, '#', 'Kelola', 'Kelola', 0, 1, 77, 'fa fa-tasks', 1, NULL),
(12, 'news', 'Berita', 'Berita', 11, 0, 1, 'fa fa-newspaper', 1, 'create,read,update,delete'),
(13, 'anggota', 'Anggota', 'Anggota', 11, 0, 1, 'fa fa-users', 1, 'create,read,update,delete'),
(14, 'galeri', 'Galeri', 'Galeri', 11, 0, 2, 'fas fa-images', 1, 'create,read,update,delete'),
(15, 'kategori_developer', 'Kategori Developer', 'Kategori Developer', 11, 0, 3, NULL, 1, 'create,read,update,delete');

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
  `news_status` int(11) NOT NULL,
  `news_is_gallery` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
('0da419amoiedu3bpa9f5b2kf747o1e8g', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313632373035393538393b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('0g6ohens77brole3l5gga7dq201muodj', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313632373035373739303b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('8urnag70226v38o0n172n2bscva2kmk2', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313632373035393931363b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('bus9rtjf9imm6j0ed4kbr5hflvjau7m1', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313632373035383336343b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('d2qnvtqlj8rlv7hq656b5trji8g7qkfu', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313632373035373832313b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('kj1dtr7al81jvmbp1ih4grb35rcst1uv', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313632373035373530343b),
('ln7slod704fvu0fbhqrupmjmgt160mot', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313632373036303331353b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('nab6bg7psqthfeic5ujugi80em5ru6hq', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313632373035383931333b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('nhmovo15q5shpudmvi3jtl7sesrknjmi', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313632373035393238353b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('r8hse6ri6t20rbjavrbj7ija4gmkpack', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313632373036303631363b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d),
('s4ucvs8icha6j91jo18qc3kvufgfghe0', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313632373036303631363b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a373a22726f6c655f6964223b733a313a2231223b7d);

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
(1, 'GIS REI JAKARTA', 'sadasdasd', 'sadasdasd', 32432, 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', 'logo.png', 'icon.png', 'smtp.gmail.com', 'helmyfikrih@gmail.com', 'khcxgrrefulghzky', 'ssl', 465, 'helmyfikrih@gmail.com', 'GIS REI JAKARTA');

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
(1, 1, 'admin', 'admin@mail.com', '21232f297a57a5a743894a0e4a801fc3', NULL, NULL, NULL, NULL, 1);

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
(1, 'adm', 'Admin', '1,11,12,level_12_create,level_12_read,level_12_update,level_12_delete,13,level_13_create,level_13_read,level_13_update,level_13_delete,4,level_4_create,level_4_read,level_4_update,level_4_delete,14,level_14_create,level_14_read,level_14_update,level_14_delete,15,level_15_create,level_15_read,level_15_update,level_15_delete,9,10,level_10_read,level_10_approval,2,5,7,level_7_create,level_7_read,level_7_update,level_7_delete,8,level_8_create,level_8_read,level_8_update,level_8_delete,3,level_3_create,level_3_read,level_3_update,level_3_delete,6', 1, '2021-07-23 18:43:00', 1, '2021-07-23 23:12:35', NULL),
(2, 'staff', 'Staff Keanggotaan', NULL, 1, '2021-07-23 23:12:35', NULL, '2021-07-23 23:12:35', NULL),
(3, 'Kabit', 'Kabit Keanggotaan', NULL, 1, '2021-07-23 23:12:35', NULL, '2021-07-23 23:12:35', NULL),
(4, 'Rkn', 'Rekanan', NULL, 1, '2021-07-23 23:12:35', NULL, '2021-07-23 23:12:35', NULL);

--
-- Indexes for dumped tables
--

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
-- Indexes for table `gis_kategori_developer`
--
ALTER TABLE `gis_kategori_developer`
  ADD PRIMARY KEY (`kategori_developer_id`);

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
-- AUTO_INCREMENT for table `gis_developer_detail`
--
ALTER TABLE `gis_developer_detail`
  MODIFY `developer_id` bigint(20) NOT NULL AUTO_INCREMENT;

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
-- AUTO_INCREMENT for table `gis_kategori_developer`
--
ALTER TABLE `gis_kategori_developer`
  MODIFY `kategori_developer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `gis_kecamatan`
--
ALTER TABLE `gis_kecamatan`
  MODIFY `kecamatan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `gis_kota`
--
ALTER TABLE `gis_kota`
  MODIFY `kota_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `gis_menu`
--
ALTER TABLE `gis_menu`
  MODIFY `menu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `gis_news`
--
ALTER TABLE `gis_news`
  MODIFY `news_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gis_register`
--
ALTER TABLE `gis_register`
  MODIFY `register_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gis_register_attachment`
--
ALTER TABLE `gis_register_attachment`
  MODIFY `register_attachment_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gis_system_settings`
--
ALTER TABLE `gis_system_settings`
  MODIFY `system_settings_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `gis_user`
--
ALTER TABLE `gis_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `gis_user_detail`
--
ALTER TABLE `gis_user_detail`
  MODIFY `ud_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gis_user_role`
--
ALTER TABLE `gis_user_role`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

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
