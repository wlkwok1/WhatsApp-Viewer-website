-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2021-04-28 13:26:12
-- 伺服器版本： 10.4.18-MariaDB
-- PHP 版本： 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `server`
--

-- --------------------------------------------------------

--
-- 資料表結構 `admin`
--

CREATE TABLE `admin` (
  `admin_id` varchar(8) NOT NULL,
  `admin_name` varchar(16) NOT NULL,
  `password` varchar(16) NOT NULL,
  `phone_number` int(8) NOT NULL,
  `address` text NOT NULL,
  `department` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 資料表結構 `permission`
--

CREATE TABLE `permission` (
  `permission_id` int(255) NOT NULL,
  `groupchat_id` int(8) NOT NULL,
  `user_id` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 資料表結構 `user`
--

CREATE TABLE `user` (
  `user_id` varchar(8) NOT NULL,
  `user_name` varchar(16) NOT NULL,
  `password` varchar(16) NOT NULL,
  `phone_number` int(8) NOT NULL,
  `address` text NOT NULL,
  `department` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 資料表結構 `whatsapp_groupchat`
--

CREATE TABLE `whatsapp_groupchat` (
  `groupchat_id` int(8) NOT NULL,
  `chatroom_name` varchar(255) NOT NULL,
  `Description` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL,
  `admin_id` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 資料表結構 `whatsapp_message_data`
--

CREATE TABLE `whatsapp_message_data` (
  `data_id` int(255) NOT NULL,
  `groupchat_id` int(8) NOT NULL,
  `sender` text NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `message` mediumtext NOT NULL,
  `file` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- 資料表索引 `permission`
--
ALTER TABLE `permission`
  ADD PRIMARY KEY (`permission_id`),
  ADD KEY `group_permission` (`groupchat_id`),
  ADD KEY `user_permission` (`user_id`);

--
-- 資料表索引 `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- 資料表索引 `whatsapp_groupchat`
--
ALTER TABLE `whatsapp_groupchat`
  ADD PRIMARY KEY (`groupchat_id`),
  ADD KEY `FK_group_chat_creat_by_admin` (`admin_id`);

--
-- 資料表索引 `whatsapp_message_data`
--
ALTER TABLE `whatsapp_message_data`
  ADD PRIMARY KEY (`data_id`),
  ADD KEY `FK_Message_Belong_to_GroupChat` (`groupchat_id`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `permission`
--
ALTER TABLE `permission`
  MODIFY `permission_id` int(255) NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `whatsapp_groupchat`
--
ALTER TABLE `whatsapp_groupchat`
  MODIFY `groupchat_id` int(8) NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `whatsapp_message_data`
--
ALTER TABLE `whatsapp_message_data`
  MODIFY `data_id` int(255) NOT NULL AUTO_INCREMENT;

--
-- 已傾印資料表的限制式
--

--
-- 資料表的限制式 `permission`
--
ALTER TABLE `permission`
  ADD CONSTRAINT `group_permission` FOREIGN KEY (`groupchat_id`) REFERENCES `whatsapp_groupchat` (`groupchat_id`),
  ADD CONSTRAINT `user_permission` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- 資料表的限制式 `whatsapp_groupchat`
--
ALTER TABLE `whatsapp_groupchat`
  ADD CONSTRAINT `FK_group_chat_creat_by_admin` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`admin_id`);

--
-- 資料表的限制式 `whatsapp_message_data`
--
ALTER TABLE `whatsapp_message_data`
  ADD CONSTRAINT `FK_Message_Belong_to_GroupChat` FOREIGN KEY (`groupchat_id`) REFERENCES `whatsapp_groupchat` (`groupchat_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
