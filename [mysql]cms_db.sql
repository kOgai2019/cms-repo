-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: 2019 年 7 月 02 日 13:12
-- サーバのバージョン： 5.7.25
-- PHP Version: 7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cms_db`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `articles`
--

CREATE TABLE `articles` (
  `id` int(11) UNSIGNED NOT NULL COMMENT 'ID',
  `user_id` int(11) UNSIGNED NOT NULL COMMENT 'ユーザーID',
  `title` varchar(255) NOT NULL COMMENT 'タイトル',
  `sentense` text NOT NULL COMMENT '文章',
  `filename` varchar(255) CHARACTER SET utf8 DEFAULT NULL COMMENT 'ファイル名',
  `delete_flg` tinyint(1) UNSIGNED NOT NULL DEFAULT '0' COMMENT '削除フラグ',
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '作成日時',
  `modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新日時'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='記事管理テーブル';

-- --------------------------------------------------------

--
-- テーブルの構造 `articles_categories`
--

CREATE TABLE `articles_categories` (
  `id` int(11) NOT NULL COMMENT 'ID',
  `article_id` int(11) NOT NULL COMMENT '記事ID',
  `category_id` int(11) NOT NULL COMMENT 'カテゴリーID'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='記事_カテゴリー_中間テーブル';

-- --------------------------------------------------------

--
-- テーブルの構造 `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL COMMENT 'ID',
  `name` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT '名前'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='カテゴリー管理テーブル';

-- --------------------------------------------------------

--
-- テーブルの構造 `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL COMMENT 'ID',
  `article_id` int(11) NOT NULL COMMENT '記事ID',
  `name` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT '名前',
  `sentense` text CHARACTER SET utf8 NOT NULL COMMENT '文章'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='コメント管理テーブル';

-- --------------------------------------------------------

--
-- テーブルの構造 `mail_cues`
--

CREATE TABLE `mail_cues` (
  `id` int(11) NOT NULL COMMENT 'ID',
  `secret` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT 'キー',
  `email` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT 'メールアドレス',
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '作成日時'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='メールキュー管理テーブル';

-- --------------------------------------------------------

--
-- テーブルの構造 `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL COMMENT 'ID',
  `name` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT '名前',
  `email` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT 'メールアドレス',
  `password` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT 'パスワード',
  `user_auth_type_id` int(11) NOT NULL DEFAULT '2' COMMENT 'ユーザー権限ID',
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '作成日時',
  `modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '更新日時'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='ユーザー管理テーブル';

-- --------------------------------------------------------

--
-- テーブルの構造 `user_auth_types`
--

CREATE TABLE `user_auth_types` (
  `id` int(11) NOT NULL COMMENT 'ID',
  `name` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT '名前'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='ユーザー権限管理テーブル';

--
-- テーブルのデータのダンプ `user_auth_types`
--

INSERT INTO `user_auth_types` (`id`, `name`) VALUES
(1, '管理者'),
(2, 'ライター');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `articles_categories`
--
ALTER TABLE `articles_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mail_cues`
--
ALTER TABLE `mail_cues`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_auth_types`
--
ALTER TABLE `user_auth_types`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID';

--
-- AUTO_INCREMENT for table `articles_categories`
--
ALTER TABLE `articles_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID';

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID';

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID';

--
-- AUTO_INCREMENT for table `mail_cues`
--
ALTER TABLE `mail_cues`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID';

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID';

--
-- AUTO_INCREMENT for table `user_auth_types`
--
ALTER TABLE `user_auth_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID', AUTO_INCREMENT=3;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
