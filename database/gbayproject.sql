-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th4 26, 2021 lúc 03:30 PM
-- Phiên bản máy phục vụ: 10.4.13-MariaDB
-- Phiên bản PHP: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `gbayproject`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `pages`
--

CREATE TABLE `pages` (
  `id` int(5) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `body` longtext COLLATE utf8_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `created_by_id` int(11) NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `updated_by_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `seo_main_info`
--

CREATE TABLE `seo_main_info` (
  `id` int(11) NOT NULL,
  `permalink` text COLLATE utf8_unicode_ci NOT NULL,
  `object_type` char(20) COLLATE utf8_unicode_ci NOT NULL,
  `object_id` int(11) NOT NULL,
  `meta_title` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `meta_description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `meta_keywords` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `breadcrumb_title` text COLLATE utf8_unicode_ci NOT NULL,
  `meta_robots` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `canonical_url` text COLLATE utf8_unicode_ci NOT NULL,
  `schema_code` text COLLATE utf8_unicode_ci NOT NULL,
  `type` char(20) COLLATE utf8_unicode_ci NOT NULL,
  `facebook_preview` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `twitter_preview` text COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sliders`
--

CREATE TABLE `sliders` (
  `id` int(11) NOT NULL,
  `title` varchar(165) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `link` varchar(200) DEFAULT NULL,
  `link_title` varchar(255) DEFAULT NULL,
  `thumb` varchar(255) NOT NULL,
  `thumb_alt` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `modified_by` varchar(255) DEFAULT NULL,
  `show_content` char(5) NOT NULL DEFAULT 'yes',
  `status` char(10) NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Đang đổ dữ liệu cho bảng `sliders`
--

INSERT INTO `sliders` (`id`, `title`, `description`, `link`, `link_title`, `thumb`, `thumb_alt`, `created`, `created_by`, `modified`, `modified_by`, `show_content`, `status`) VALUES
(1, 'Big choice of<br>Plumbing products', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.<br>Etiam pharetra laoreet dui quis molestie.', 'http://gbayproject.com/admin/slider', 'Big choice of Plumbing products', 'slide-1.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam pharetra laoreet dui quis molestie.', '2021-03-26 08:05:48', 'vuducthao', '2021-03-26 08:05:55', 'vuducthao', 'yes', 'active'),
(2, 'Screwdrivers<br>Professional Tools', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam pharetra laoreet dui quis molestie.', 'https://stroyka.html.themeforest.scompiler.ru/themes/red-ltr/index.html', 'Screwdrivers Professional Tools', 'slide-2.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.<br>Etiam pharetra laoreet dui quis molestie.', '2021-03-22 04:13:37', 'vuducthao', '2021-03-22 04:13:37', 'vuducthao', 'yes', 'active'),
(3, 'One more<br>Unique header', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam pharetra laoreet dui quis molestie.', 'https://bootstrapdash.com/demo/plus/jquery/template/demo_1/pages/icons/font-awesome.html', 'One more Unique header', 'slide-3.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.<br>Etiam pharetra laoreet dui quis molestie.', '2021-03-22 04:13:37', 'vuducthao', '2021-04-07 03:00:47', 'vuducthao', 'yes', 'inactive');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `uploads`
--

CREATE TABLE `uploads` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `name_not_extension` varchar(255) NOT NULL,
  `extension` char(30) NOT NULL,
  `size` char(30) NOT NULL,
  `alt` varchar(255) DEFAULT NULL,
  `caption` varchar(255) DEFAULT NULL,
  `content` varchar(255) DEFAULT NULL,
  `mime_type` char(30) NOT NULL,
  `dir_date` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `created_by_id` int(11) NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `updated_by_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `seo_main_info`
--
ALTER TABLE `seo_main_info`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Chỉ mục cho bảng `uploads`
--
ALTER TABLE `uploads`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT cho bảng `seo_main_info`
--
ALTER TABLE `seo_main_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT cho bảng `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `uploads`
--
ALTER TABLE `uploads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
