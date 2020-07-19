-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- 主機： mysql
-- 產生時間： 2020 年 06 月 24 日 11:15
-- 伺服器版本： 8.0.19
-- PHP 版本： 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `webcart`
--

-- --------------------------------------------------------

--
-- 資料表結構 `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `id` bigint UNSIGNED NOT NULL COMMENT 'PK',
  `ip_address` varchar(45) NOT NULL COMMENT 'IP位置',
  `timestamp` int UNSIGNED NOT NULL DEFAULT '0' COMMENT '時間',
  `data` blob NOT NULL COMMENT '資料'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='SESSION Table';

-- --------------------------------------------------------

--
-- 資料表結構 `members`
--

CREATE TABLE `members` (
  `id` bigint UNSIGNED NOT NULL COMMENT 'PK',
  `username` varchar(255) NOT NULL DEFAULT '' COMMENT '會員帳號',
  `password` varchar(255) NOT NULL DEFAULT '' COMMENT '密碼',
  `first_name` varchar(255) DEFAULT NULL COMMENT '名字',
  `last_name` varchar(255) DEFAULT NULL COMMENT '姓名',
  `email` varchar(255) NOT NULL DEFAULT '' COMMENT 'EMAIL',
  `role_id` int NOT NULL DEFAULT '0' COMMENT '角色id',
  `status` enum('unactive','active','suspension') NOT NULL DEFAULT 'unactive' COMMENT '狀態：unactive 未啟用, active 啟用, suspension 停權',
  `lang` varchar(5) NOT NULL DEFAULT 'zh-CN' COMMENT '語言',
  `currency` varchar(3) DEFAULT 'CNY' COMMENT '幣別',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT '新增時間',
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '最後更新時間',
  `deleted_at` timestamp NULL DEFAULT NULL COMMENT '軟刪除時間'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='會員帳號';

--
-- 傾印資料表的資料 `members`
--

INSERT INTO `members` (`id`, `username`, `password`, `first_name`, `last_name`, `email`, `role_id`, `status`, `lang`, `currency`, `created_at`, `deleted_at`) VALUES
(12, '0234567891', '$2y$10$zszFa8l1wIlC08TzK5cB5.yKxmRDAKwDeXkUrP.QB55xasI0xPrJO', '佳霖', '吳', 'jailin1124@gmail.com', 2, 'unactive', 'zh-CN', 'CNY', '2020-06-16 21:55:21', '2020-06-16 21:55:24');

-- --------------------------------------------------------

--
-- 資料表結構 `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` text NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int NOT NULL,
  `batch` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 傾印資料表的資料 `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(32, '2020-05-25-095444', 'App\\Database\\Migrations\\AddMember', 'default', 'App', 1592031277, 1),
(33, '2020-05-25-131751', 'App\\Database\\Migrations\\AddSystem', 'default', 'App', 1592031277, 1),
(34, '2020-05-25-143843', 'App\\Database\\Migrations\\AddCiSessions', 'default', 'App', 1592031277, 1),
(35, '2020-05-28-125928', 'App\\Database\\Migrations\\AddRole', 'default', 'App', 1592031277, 1),
(36, '2020-06-09-132035', 'App\\Database\\Migrations\\AddResetPass', 'default', 'App', 1592031277, 1);

-- --------------------------------------------------------

--
-- 資料表結構 `reset_pass`
--

CREATE TABLE `reset_pass` (
  `id` bigint UNSIGNED NOT NULL COMMENT 'PK',
  `role_type` varchar(6) NOT NULL DEFAULT 'member' COMMENT '角色類型:member會員角色, admin 管理者角色',
  `active_id` bigint UNSIGNED NOT NULL COMMENT '關聯帳號id',
  `active_code` varchar(36) NOT NULL DEFAULT '' COMMENT '啟用碼',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT '新增時間',
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '最後更新時間'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='帳號啟用及重設密碼';

--
-- 傾印資料表的資料 `reset_pass`
--

INSERT INTO `reset_pass` (`id`, `role_type`, `active_id`, `active_code`, `created_at`) VALUES
(7, 'member', 7, '15e9c0e0-762c-42ec-a3dc-75edd0875ede', '2020-06-16 21:43:29'),
(8, 'member', 8, '4eadaa87-d7d0-47ea-ad1a-2ae2d3985712', '2020-06-16 21:46:27'),
(9, 'member', 9, 'ebbd098f-3380-4f13-b88a-6ffa9539d345', '2020-06-16 21:47:58'),
(10, 'member', 10, 'a504ae80-981a-4f26-bc92-70a66791c12c', '2020-06-16 21:52:04'),
(11, 'member', 11, '05bff6c6-02e5-4599-93a1-9677cc70826c', '2020-06-16 21:54:44'),
(12, 'member', 12, '451588e8-27af-4654-bff6-41362f46676e', '2020-06-16 21:55:21');

-- --------------------------------------------------------

--
-- 資料表結構 `roles`
--

CREATE TABLE `roles` (
  `id` int UNSIGNED NOT NULL COMMENT 'PK',
  `role_type` varchar(6) NOT NULL DEFAULT 'member' COMMENT '角色類型:member會員角色, admin 管理者角色',
  `role_code` varchar(100) DEFAULT NULL COMMENT '角色代碼',
  `role_name` text COMMENT '角色名稱',
  `remark` text COMMENT '角色說明',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT '新增時間',
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '最後更新時間'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='角色';

--
-- 傾印資料表的資料 `roles`
--

INSERT INTO `roles` (`id`, `role_type`, `role_code`, `role_name`, `remark`, `created_at`) VALUES
(1, 'admin', 'admin', '{\"en\":\"admin\",\"zh-CN\":\"\\u7ba1\\u7406\\u8005\",\"zh-TW\":\"\\u7ba1\\u7406\\u8005\"}', '管理者', '2020-06-13 07:27:10'),
(2, 'member', 'member', '{\"en\":\"member\",\"zh-CN\":\"\\u4f1a\\u5458\",\"zh-TW\":\"\\u6703\\u54e1\"}', '一般會員', '2020-06-13 07:27:10'),
(3, 'member', 'wholesaler', '{\"en\":\"wholesaler\",\"zh-CN\":\"\\u6279\\u767c\\u5546\",\"zh-TW\":\"\\u6279\\u53d1\\u5546\"}', '批發商', '2020-06-13 07:27:10');

-- --------------------------------------------------------

--
-- 資料表結構 `system`
--

CREATE TABLE `system` (
  `id` bigint UNSIGNED NOT NULL COMMENT 'PK',
  `setting_key` varchar(255) NOT NULL DEFAULT '' COMMENT '系統設定欄位',
  `setting_value` text COMMENT '系統設定值',
  `remark` text COMMENT '設定值說明',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT '新增時間',
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '最後更新時間'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='系統設定';

--
-- 傾印資料表的資料 `system`
--

INSERT INTO `system` (`id`, `setting_key`, `setting_value`, `remark`, `created_at`) VALUES
(1, 'site_name', '{\"zh-CN\":\"\\u7f51\\u7ad9\\u540d\\u79f0\",\"zh-TW\":\"\\u7db2\\u7ad9\\u540d\\u7a31\",\"en\":\"Website name\"}', '網站名稱', '2020-06-13 07:27:00'),
(2, 'keywords', '[]', '網站關鍵字', '2020-06-13 07:27:00'),
(3, 'description', '[]', '網站描述', '2020-06-13 07:27:00'),
(4, 'lang', '{\"zh-CN\":\"\\u7b80\\u4f53\\u4e2d\\u6587\",\"zh-TW\":\"\\u7e41\\u9ad4\\u4e2d\\u6587\",\"en\":\"English\"}', '語言', '2020-06-13 07:27:00'),
(5, 'currency', '{\"HKD\":{\"zh-CN\":\"\\u6e2f\\u5143\",\"zh-TW\":\"\\u6e2f\\u5143\",\"en\":\"Hong Kong dollar\"},\"CNY\":{\"zh-CN\":\"\\u4eba\\u6c11\\u5e01\",\"zh-TW\":\"\\u4eba\\u6c11\\u5e63\",\"en\":\"Renminbi\"},\"TWD\":{\"zh-CN\":\"\\u65b0\\u53f0\\u5e01\",\"zh-TW\":\"\\u65b0\\u53f0\\u5e63\",\"en\":\"New Taiwan Dollar\"},\"SGD\":{\"zh-CN\":\"\\u65b0\\u52a0\\u5761\\u5e01\",\"zh-TW\":\"\\u65b0\\u52a0\\u5761\\u5143\",\"en\":\"Singapore Dollar\"},\"USD\":{\"zh-CN\":\"\\u7f8e\\u5143\",\"zh-TW\":\"\\u7f8e\\u5143\",\"en\":\"US dollar\"}}', '幣別', '2020-06-13 07:27:00');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `ci_sessions`
--
ALTER TABLE `ci_sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `timestamp` (`timestamp`);

--
-- 資料表索引 `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `username_email_status_role_id` (`username`,`email`,`status`,`role_id`);

--
-- 資料表索引 `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `reset_pass`
--
ALTER TABLE `reset_pass`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `active_code` (`active_code`),
  ADD KEY `role_type_active_id` (`role_type`,`active_id`);

--
-- 資料表索引 `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `role_code` (`role_code`),
  ADD KEY `role_type_role_code` (`role_type`,`role_code`);

--
-- 資料表索引 `system`
--
ALTER TABLE `system`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `setting_key` (`setting_key`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `ci_sessions`
--
ALTER TABLE `ci_sessions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'PK';

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `members`
--
ALTER TABLE `members`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'PK', AUTO_INCREMENT=13;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `reset_pass`
--
ALTER TABLE `reset_pass`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'PK', AUTO_INCREMENT=13;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'PK', AUTO_INCREMENT=4;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `system`
--
ALTER TABLE `system`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'PK', AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
