-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 2018-06-13 10:04:13
-- 服务器版本： 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel`
--

-- --------------------------------------------------------

--
-- 表的结构 `albums`
--

CREATE TABLE `albums` (
  `id` int(10) UNSIGNED NOT NULL,
  `artist_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cover` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `albums`
--

INSERT INTO `albums` (`id`, `artist_id`, `name`, `cover`, `created_at`, `updated_at`) VALUES
(1, 1, 'Unknown Album', 'unknown-album.png', '2017-06-17 01:07:35', '2017-06-17 01:07:35');

-- --------------------------------------------------------

--
-- 表的结构 `artists`
--

CREATE TABLE `artists` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `artists`
--

INSERT INTO `artists` (`id`, `name`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Unknown Artist', NULL, '2017-06-17 01:07:35', '2017-06-17 01:07:35'),
(2, 'Various Artists', NULL, '2017-06-17 01:01:32', '2017-06-17 01:01:32');

-- --------------------------------------------------------

--
-- 表的结构 `countries`
--

CREATE TABLE `countries` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `countries`
--

INSERT INTO `countries` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, '中国', NULL, NULL),
(2, '韩国', NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `devices`
--

CREATE TABLE `devices` (
  `id` int(10) UNSIGNED NOT NULL,
  `openid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `brand` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `devices`
--

INSERT INTO `devices` (`id`, `openid`, `brand`, `model`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '123456', 'hello', '', NULL, NULL, NULL),
(2, '654321', 'world', '', NULL, NULL, NULL),
(3, '654321', 'world', '', NULL, NULL, NULL),
(4, '654321', 'world', '', NULL, NULL, NULL),
(5, '654321', 'world', '', NULL, NULL, NULL),
(6, '654321', 'world', '', NULL, NULL, NULL),
(7, '123456', 'hello', '', NULL, NULL, NULL),
(8, '123456', 'hello', '', NULL, NULL, NULL),
(9, '123456', 'hello', '', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `documents`
--

CREATE TABLE `documents` (
  `id` int(10) UNSIGNED NOT NULL,
  `label` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `path` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `time` int(11) NOT NULL COMMENT '时长，只有录音有，单位秒',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `documents`
--

INSERT INTO `documents` (`id`, `label`, `type`, `path`, `time`, `created_at`, `updated_at`) VALUES
(6, 'mobai', 'img', '/uploads/20171209/1JSaDInmPobzmwQYwfJNmR5XTWoyufH1gbFOR7GX.png', 0, '2017-12-09 03:08:50', '2017-12-09 03:08:50'),
(7, 'voc', 'img', '/uploads/20171209/BDXpwKzvrP6Q10IZQrnZarj2j7QSxDfwtVif0Xoe.png', 0, '2017-12-09 03:22:25', '2017-12-09 03:22:25'),
(8, '88', 'img', '/uploads/20171209/LC0RC8Gy9TpDCH2qxQ5CjJPsnMwZNspbaZX224hS.png', 0, '2017-12-09 03:24:39', '2017-12-09 03:24:39'),
(9, '889', 'img', '/uploads/20171209/FQiIhpRcHJzScOAnXkU1TXo88c4HqsEUMoV6lLWp.png', 0, '2017-12-09 03:26:12', '2017-12-09 03:26:12'),
(10, '99', 'img', '/uploads/20171209/WTv2Fn9nvAzp5J38otX77EZxnwgZXLDYrERoCqIZ.png', 0, '2017-12-09 03:27:33', '2017-12-09 03:27:33'),
(11, 'sao', 'img', '/uploads/20171209/wzFxOwS8W4B5QWhMopsTscTwskMAHMCM2Mo5o9eB.png', 0, '2017-12-09 05:17:50', '2017-12-09 05:17:50'),
(12, 'hhh', 'img', '/uploads/20171209/M1bZOXyCnH4Yop1qKel54RAfZ1u5UYK8GopI8cAZ.png', 0, '2017-12-09 05:22:06', '2017-12-09 05:22:06'),
(13, '99', 'img', '/uploads/20171209/T1AlY4ZDa9yXwL8w9IDiNaDYPGYJQs2TxZdxk60W.png', 0, '2017-12-09 05:27:36', '2017-12-09 05:27:36'),
(14, '咳嗽', 'audio', '/uploads/20171209/zXDcM8aDXsW30qVk2NpsPKF8lUsKr0aVVkDSt56w.mp4a', 2, NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `groups`
--

CREATE TABLE `groups` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `groups`
--

INSERT INTO `groups` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'cat', NULL, NULL),
(2, 'dog', NULL, NULL),
(3, 'elephant', NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `group_user`
--

CREATE TABLE `group_user` (
  `user_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `group_user`
--

INSERT INTO `group_user` (`user_id`, `group_id`) VALUES
(1, 1),
(1, 2),
(2, 2),
(3, 1),
(3, 2),
(3, 3);

-- --------------------------------------------------------

--
-- 表的结构 `interactions`
--

CREATE TABLE `interactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `song_id` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `liked` tinyint(1) NOT NULL DEFAULT '0',
  `play_count` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `interactions`
--

INSERT INTO `interactions` (`id`, `user_id`, `song_id`, `liked`, `play_count`, `created_at`, `updated_at`) VALUES
(1, 1, '4e6ae0278f07aa62a30bc45a5e958b27', 0, 4, '2017-06-18 23:01:21', '2017-06-24 00:37:04');

-- --------------------------------------------------------

--
-- 表的结构 `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `jobs`
--

INSERT INTO `jobs` (`id`, `queue`, `payload`, `attempts`, `reserved_at`, `available_at`, `created_at`) VALUES
(1, 'default', '{\"displayName\":\"miaosha\",\"job\":\"miaosha\",\"maxTries\":null,\"timeout\":null,\"data\":14899}', 0, NULL, 1500626053, 1500626053),
(2, 'default', '{\"displayName\":\"miaosha\",\"job\":\"miaosha\",\"maxTries\":null,\"timeout\":null,\"data\":49245}', 0, NULL, 1500626054, 1500626054),
(3, 'default', '{\"displayName\":\"miaosha\",\"job\":\"miaosha\",\"maxTries\":null,\"timeout\":null,\"data\":34054}', 0, NULL, 1500626055, 1500626055),
(4, 'default', '{\"displayName\":\"miaosha\",\"job\":\"miaosha\",\"maxTries\":null,\"timeout\":null,\"data\":47416}', 0, NULL, 1500626056, 1500626056),
(5, 'default', '{\"displayName\":\"miaosha\",\"job\":\"miaosha\",\"maxTries\":null,\"timeout\":null,\"data\":14836}', 0, NULL, 1500626109, 1500626109);

-- --------------------------------------------------------

--
-- 表的结构 `member`
--

CREATE TABLE `member` (
  `id` int(11) NOT NULL,
  `name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `age` tinyint(4) NOT NULL,
  `sex` tinyint(4) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `member`
--

INSERT INTO `member` (`id`, `name`, `age`, `sex`, `created_at`, `updated_at`) VALUES
(2, 'hello', 14, 0, '2017-06-15 05:37:00', NULL),
(3, 'cat', 99, 0, '2017-06-15 05:40:53', '2017-06-15 06:53:45'),
(4, 'tiger', 21, 0, '2017-06-15 05:42:38', NULL),
(5, 'rabbit', 88, 1, '2017-06-15 05:46:40', NULL),
(6, 'dog', 66, 0, '2017-06-15 05:46:40', NULL),
(7, 'world', 50, 1, '2017-06-14 22:37:36', '2017-06-15 06:37:36'),
(8, 'Kitty', 15, 0, '2017-06-14 22:46:37', '2017-06-15 06:46:37');

-- --------------------------------------------------------

--
-- 表的结构 `miaosha_queue`
--

CREATE TABLE `miaosha_queue` (
  `id` int(10) UNSIGNED NOT NULL,
  `uid` int(11) NOT NULL,
  `timestamp` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `miaosha_queue`
--

INSERT INTO `miaosha_queue` (`id`, `uid`, `timestamp`) VALUES
(1, 18992, '0.55600000 1500627528'),
(2, 42505, '0.55700000 1500627528'),
(3, 72819, '0.55800000 1500627528'),
(4, 17517, '0.55800000 1500627528'),
(5, 40646, '0.55900000 1500627528'),
(6, 90922, '0.55900000 1500627528'),
(7, 45870, '0.56000000 1500627528'),
(8, 33150, '0.56000000 1500627528'),
(9, 85327, '0.56100000 1500627528'),
(10, 39319, '0.56100000 1500627528'),
(11, 25281, '0.40941300 1506739809'),
(12, 50267, '0.42541300 1506739809'),
(13, 27297, '0.42541300 1506739809'),
(14, 25323, '0.43041300 1506739809'),
(15, 67414, '0.43041300 1506739809'),
(16, 35842, '0.43141300 1506739809'),
(17, 35592, '0.43141300 1506739809'),
(18, 57568, '0.43241300 1506739809'),
(19, 77730, '0.43441300 1506739809'),
(20, 63429, '0.43441300 1506739809');

-- --------------------------------------------------------

--
-- 表的结构 `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2015_11_23_074600_create_artists_table', 1),
(4, '2015_11_23_074709_create_albums_table', 1),
(5, '2015_11_23_074713_create_songs_table', 1),
(6, '2015_11_23_074723_create_playlists_table', 1),
(7, '2015_11_23_074733_create_interactions_table', 1),
(8, '2015_11_23_082854_create_playlist_song_table', 1),
(9, '2015_11_25_033351_create_settings_table', 1),
(10, '2015_12_18_072523_add_preferences_to_users_table', 1),
(11, '2015_12_22_092542_add_image_to_artists_table', 1),
(12, '2016_03_20_134512_add_track_into_songs', 1),
(13, '2016_04_15_121215_add_is_complilation_into_albums', 1),
(14, '2016_04_15_125237_add_contributing_artist_id_into_songs', 1),
(15, '2016_04_16_082627_create_various_artists', 1),
(16, '2016_06_16_134516_cascade_delete_user', 1),
(17, '2016_07_09_054503_fix_artist_autoindex_value', 1),
(18, '2017_04_21_092159_copy_artist_to_contributing_artist', 1),
(19, '2017_04_22_161504_drop_is_complication_from_albums', 1),
(20, '2017_04_29_025836_rename_contributing_artist_id', 1),
(22, '2017_07_12_005308_create_groups_table', 3),
(23, '2017_07_12_005321_create_posts_table', 3),
(24, '2017_07_12_005451_create_countries_table', 3),
(25, '2017_07_12_005712_create_table_group_user', 3),
(28, '2017_07_12_005242_create_userinfos_table', 4),
(29, '2017_07_12_062828_create_jobs_table', 5),
(30, '2017_07_12_065844_create_failed_jobs_table', 5),
(31, '2017_07_14_033437_create_orders_table', 5),
(32, '2017_07_14_063041_create_notifications_table', 6),
(33, '2017_07_21_151025_create_miaosha_table', 7),
(34, '2017_10_05_111131_create_news_table', 8),
(35, '2017_11_17_110031_create_permission_and_roles', 9),
(36, '2017_12_08_163029_create_document_table', 10),
(39, '2018_01_03_111930_create_devices_table', 11),
(40, '2018_03_19_154057_create_msg_table', 12);

-- --------------------------------------------------------

--
-- 表的结构 `msg`
--

CREATE TABLE `msg` (
  `id` int(10) UNSIGNED NOT NULL,
  `from_uid` int(11) NOT NULL,
  `to_uid` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `news`
--

CREATE TABLE `news` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` int(10) UNSIGNED NOT NULL,
  `notifiable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `orders`
--

CREATE TABLE `orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `order_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `orders`
--

INSERT INTO `orders` (`id`, `order_id`, `status`, `created_at`, `updated_at`) VALUES
(1, '201707145141', 1, '2017-07-13 21:22:11', '2017-07-13 21:22:11');

-- --------------------------------------------------------

--
-- 表的结构 `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `desc`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '常见问题', 'admin/question', '2018-02-26 06:20:16', '2018-02-26 06:20:16', NULL),
(2, '下载中心', 'admin/download', '2018-02-26 08:05:15', '2018-02-26 08:05:15', NULL),
(4, '人才招聘', 'admin/zhaopin', '2018-02-26 08:08:22', '2018-02-26 08:08:22', NULL),
(5, '代理商管理', 'admin/agent', '2018-02-26 08:10:10', '2018-02-26 08:10:10', NULL),
(7, '条码查询', 'admin/tiaoma', '2018-02-26 08:16:02', '2018-02-26 08:16:02', NULL),
(8, '展厅导航', 'admin/navigate', '2018-02-26 08:18:56', '2018-02-26 08:18:56', NULL),
(9, '日志管理', 'admin/log', '2018-02-26 08:20:21', '2018-02-26 08:20:21', NULL),
(10, '管理员管理', 'admin/manager', '2018-02-26 08:20:48', '2018-02-26 08:20:48', NULL),
(11, '部门管理', 'admin/department', '2018-02-26 08:21:12', '2018-02-26 08:21:12', NULL),
(12, '财务管理', 'admin/money', '2018-02-26 08:21:44', '2018-02-26 08:21:44', NULL),
(13, '订单管理', 'admin/order', '2018-02-26 08:22:25', '2018-02-26 08:22:25', NULL),
(14, '用户管理', 'admin/user', '2018-03-08 02:38:00', '2018-03-08 02:38:00', NULL),
(15, '角色管理', 'admin/role', '2018-03-08 02:38:17', '2018-03-08 02:38:17', NULL),
(16, '权限管理', 'admin/privilege', '2018-03-08 02:38:34', '2018-03-08 02:38:34', NULL),
(17, '个人信息', 'admin/info', '2018-03-09 02:47:38', '2018-03-09 02:47:38', NULL),
(18, '修改密码', 'admin/chgpwd', '2018-03-09 02:48:37', '2018-03-09 05:26:19', NULL),
(19, '会员列表', 'admin/viplist', '2018-06-08 02:05:38', '2018-06-08 02:05:38', NULL),
(20, '会员权限', 'admin/vippermission', '2018-06-08 02:29:00', '2018-06-08 02:29:00', NULL),
(21, '栏目列表', 'columnlist', '2018-06-08 02:32:14', '2018-06-08 02:32:14', NULL);

-- --------------------------------------------------------

--
-- 表的结构 `permission_role`
--

CREATE TABLE `permission_role` (
  `id` int(10) UNSIGNED NOT NULL,
  `permission_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `add_permission` int(11) NOT NULL DEFAULT '0',
  `delete_permission` int(11) NOT NULL DEFAULT '0',
  `update_permission` int(11) NOT NULL DEFAULT '0',
  `read_permission` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `permission_role`
--

INSERT INTO `permission_role` (`id`, `permission_id`, `role_id`, `add_permission`, `delete_permission`, `update_permission`, `read_permission`, `created_at`, `updated_at`) VALUES
(3, 1, 3, 1, 0, 0, 1, NULL, NULL),
(4, 2, 3, 0, 1, 0, 1, NULL, NULL),
(5, 4, 3, 0, 0, 1, 1, NULL, NULL),
(6, 2, 2, 0, 0, 1, 1, NULL, NULL),
(7, 7, 2, 1, 0, 0, 1, NULL, NULL),
(8, 10, 2, 0, 1, 0, 1, NULL, NULL),
(9, 13, 2, 0, 0, 0, 1, NULL, NULL),
(10, 4, 1, 1, 1, 1, 1, NULL, NULL),
(11, 7, 1, 1, 1, 1, 1, NULL, NULL),
(12, 9, 1, 1, 1, 1, 1, NULL, NULL),
(13, 13, 1, 1, 1, 1, 1, NULL, NULL),
(14, 1, 1, 1, 1, 1, 1, NULL, NULL),
(15, 2, 1, 1, 1, 1, 1, NULL, NULL),
(16, 5, 1, 1, 1, 1, 1, NULL, NULL),
(17, 8, 1, 1, 1, 1, 1, NULL, NULL),
(18, 10, 1, 1, 1, 1, 1, NULL, NULL),
(19, 11, 1, 1, 1, 1, 1, NULL, NULL),
(20, 12, 1, 1, 1, 1, 1, NULL, NULL),
(21, 14, 1, 1, 1, 1, 1, NULL, NULL),
(22, 15, 1, 1, 1, 1, 1, NULL, NULL),
(23, 16, 1, 1, 1, 1, 1, NULL, NULL),
(24, 12, 3, 1, 1, 1, 1, NULL, NULL),
(25, 1, 2, 1, 1, 1, 1, NULL, NULL),
(26, 4, 2, 1, 1, 1, 1, NULL, NULL),
(27, 17, 1, 1, 1, 1, 1, NULL, NULL),
(28, 18, 1, 1, 1, 1, 1, NULL, NULL),
(29, 19, 1, 1, 1, 1, 1, NULL, NULL),
(30, 20, 1, 1, 1, 1, 1, NULL, NULL),
(31, 21, 1, 1, 1, 1, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `playlists`
--

CREATE TABLE `playlists` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `playlist_song`
--

CREATE TABLE `playlist_song` (
  `id` int(10) UNSIGNED NOT NULL,
  `playlist_id` int(10) UNSIGNED NOT NULL,
  `song_id` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `posts`
--

CREATE TABLE `posts` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `posts`
--

INSERT INTO `posts` (`id`, `title`, `content`, `user_id`, `created_at`, `updated_at`) VALUES
(1, '中国赢了', '2008，中国赢了', 1, NULL, NULL),
(2, '世博会', '世博会开幕了', 1, NULL, NULL),
(3, 'hello', 'kitty', 1, '2017-07-11 18:08:21', '2017-07-11 18:08:21');

-- --------------------------------------------------------

--
-- 表的结构 `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `roles`
--

INSERT INTO `roles` (`id`, `name`, `desc`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '管理员', '管理员', '2018-02-28 03:10:30', '2018-02-28 03:10:30', NULL),
(2, '客服', '客服', '2018-02-28 03:58:50', '2018-02-28 03:58:50', NULL),
(3, '财务', '财务', '2018-02-28 03:59:11', '2018-02-28 03:59:11', NULL);

-- --------------------------------------------------------

--
-- 表的结构 `role_user`
--

CREATE TABLE `role_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `role_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `role_user`
--

INSERT INTO `role_user` (`id`, `role_id`, `user_id`, `created_at`, `updated_at`) VALUES
(2, 2, 3, NULL, NULL),
(6, 3, 1, NULL, NULL),
(8, 1, 2, NULL, NULL),
(9, 1, 4, NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `settings`
--

CREATE TABLE `settings` (
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `settings`
--

INSERT INTO `settings` (`key`, `value`) VALUES
('media_path', 's:34:\"C:\\Users\\Administrator\\Desktop\\mp3\";');

-- --------------------------------------------------------

--
-- 表的结构 `songs`
--

CREATE TABLE `songs` (
  `id` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `album_id` int(10) UNSIGNED NOT NULL,
  `artist_id` int(10) UNSIGNED DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `length` double(8,2) NOT NULL,
  `track` int(11) DEFAULT NULL,
  `lyrics` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `path` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `mtime` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `songs`
--

INSERT INTO `songs` (`id`, `album_id`, `artist_id`, `title`, `length`, `track`, `lyrics`, `path`, `mtime`, `created_at`, `updated_at`) VALUES
('4e6ae0278f07aa62a30bc45a5e958b27', 1, 1, '', 105.19, 0, '', 'C:\\Users\\Administrator\\Desktop\\mp3\\valentina - bum bum - r and b.mp3', 1304433540, '2017-06-18 23:01:10', '2017-06-18 23:01:10');

-- --------------------------------------------------------

--
-- 表的结构 `userinfos`
--

CREATE TABLE `userinfos` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `qq` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `xingzuo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `xuexing` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_id` int(11) NOT NULL DEFAULT '1',
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  `preferences` text COLLATE utf8mb4_unicode_ci,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=COMPACT;

--
-- 转存表中的数据 `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `desc`, `password`, `country_id`, `is_admin`, `preferences`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'cat', '2574522520@qq.com', 'icat', '$2y$10$OhnDwZhz/C6VBqhem55CAe6aavbGP4.jUQxCa1sXaaXb9GOoaEJKC', 1, 1, NULL, NULL, '2017-06-17 01:07:35', '2018-06-12 06:41:08', NULL),
(2, 'lucky', '9527@qq.com', 'good', '$2y$10$zxJT4sPQ6k1uBjVa91ddoO29sCu.ZqCcLTnL7XYCes6iilCq7Ngoi', 1, 0, NULL, 'O6BacEwUz3PIBGxkBlabnhr3OZovvolFzG8UdH6lYL4n04jOgWjYyPBcN7RD', '2017-07-06 23:50:24', '2018-03-09 07:44:42', NULL),
(3, 'hanmeimei', '9528@qq.com', 'lilei', '$2y$10$9OGjBS4cSSzZfA5QqhRaD.sQgW.yTU5oeaKFhIPBAdd2pJbHe3Tg6', 2, 0, NULL, 'updGlhRZRc16InkZydEY70F1gHzKtL9YUfNP9bxL8kJC4DoYUBuLFsePlWsc', '2017-07-07 00:19:08', '2018-03-09 05:57:16', NULL),
(4, 'fish', '9529@qq.com', 'ifish', '$2y$10$Op5Jq/ieTcq16VKj9KhTs.9U.VadCXKmQDj7BXxWEktdh.2hROYvO', 1, 0, NULL, 'olhGO1K9ImjBBbI32WErP95HRSfzGtn2g6mxQEDnJzK4vNUaDn7Dcg7wANTn', '2017-07-20 06:40:28', '2018-03-09 06:41:36', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `albums`
--
ALTER TABLE `albums`
  ADD PRIMARY KEY (`id`),
  ADD KEY `albums_artist_id_foreign` (`artist_id`);

--
-- Indexes for table `artists`
--
ALTER TABLE `artists`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `artists_name_unique` (`name`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `devices`
--
ALTER TABLE `devices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `interactions`
--
ALTER TABLE `interactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `interactions_user_id_foreign` (`user_id`),
  ADD KEY `interactions_song_id_foreign` (`song_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_reserved_at_index` (`queue`,`reserved_at`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `miaosha_queue`
--
ALTER TABLE `miaosha_queue`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `msg`
--
ALTER TABLE `msg`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_id_notifiable_type_index` (`notifiable_id`,`notifiable_type`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `playlists`
--
ALTER TABLE `playlists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `playlists_user_id_foreign` (`user_id`);

--
-- Indexes for table `playlist_song`
--
ALTER TABLE `playlist_song`
  ADD PRIMARY KEY (`id`),
  ADD KEY `playlist_song_playlist_id_foreign` (`playlist_id`),
  ADD KEY `playlist_song_song_id_foreign` (`song_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `songs`
--
ALTER TABLE `songs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `songs_album_id_foreign` (`album_id`),
  ADD KEY `songs_contributing_artist_id_foreign` (`artist_id`);

--
-- Indexes for table `userinfos`
--
ALTER TABLE `userinfos`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `albums`
--
ALTER TABLE `albums`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- 使用表AUTO_INCREMENT `artists`
--
ALTER TABLE `artists`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- 使用表AUTO_INCREMENT `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- 使用表AUTO_INCREMENT `devices`
--
ALTER TABLE `devices`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- 使用表AUTO_INCREMENT `documents`
--
ALTER TABLE `documents`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- 使用表AUTO_INCREMENT `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- 使用表AUTO_INCREMENT `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- 使用表AUTO_INCREMENT `interactions`
--
ALTER TABLE `interactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- 使用表AUTO_INCREMENT `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- 使用表AUTO_INCREMENT `member`
--
ALTER TABLE `member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- 使用表AUTO_INCREMENT `miaosha_queue`
--
ALTER TABLE `miaosha_queue`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- 使用表AUTO_INCREMENT `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
--
-- 使用表AUTO_INCREMENT `msg`
--
ALTER TABLE `msg`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- 使用表AUTO_INCREMENT `news`
--
ALTER TABLE `news`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- 使用表AUTO_INCREMENT `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- 使用表AUTO_INCREMENT `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- 使用表AUTO_INCREMENT `permission_role`
--
ALTER TABLE `permission_role`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- 使用表AUTO_INCREMENT `playlists`
--
ALTER TABLE `playlists`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- 使用表AUTO_INCREMENT `playlist_song`
--
ALTER TABLE `playlist_song`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- 使用表AUTO_INCREMENT `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- 使用表AUTO_INCREMENT `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- 使用表AUTO_INCREMENT `role_user`
--
ALTER TABLE `role_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- 使用表AUTO_INCREMENT `userinfos`
--
ALTER TABLE `userinfos`
  MODIFY `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- 使用表AUTO_INCREMENT `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- 限制导出的表
--

--
-- 限制表 `albums`
--
ALTER TABLE `albums`
  ADD CONSTRAINT `albums_artist_id_foreign` FOREIGN KEY (`artist_id`) REFERENCES `artists` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `interactions`
--
ALTER TABLE `interactions`
  ADD CONSTRAINT `interactions_song_id_foreign` FOREIGN KEY (`song_id`) REFERENCES `songs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `interactions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- 限制表 `playlists`
--
ALTER TABLE `playlists`
  ADD CONSTRAINT `playlists_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `playlist_song`
--
ALTER TABLE `playlist_song`
  ADD CONSTRAINT `playlist_song_playlist_id_foreign` FOREIGN KEY (`playlist_id`) REFERENCES `playlists` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `playlist_song_song_id_foreign` FOREIGN KEY (`song_id`) REFERENCES `songs` (`id`) ON DELETE CASCADE;

--
-- 限制表 `songs`
--
ALTER TABLE `songs`
  ADD CONSTRAINT `songs_album_id_foreign` FOREIGN KEY (`album_id`) REFERENCES `albums` (`id`),
  ADD CONSTRAINT `songs_contributing_artist_id_foreign` FOREIGN KEY (`artist_id`) REFERENCES `artists` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
