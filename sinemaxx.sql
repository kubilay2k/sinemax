-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 13 Haz 2022, 00:34:23
-- Sunucu sürümü: 10.4.17-MariaDB
-- PHP Sürümü: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `sinemaxx`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(55) DEFAULT NULL,
  `min_age_limit` varchar(55) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `min_age_limit`) VALUES
(1, 'Korku', '12'),
(2, 'Komedi', '8'),
(3, 'Bilim Kurgu', '13');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1653837097),
('m130524_201442_init', 1653837098),
('m140506_102106_rbac_init', 1655047943),
('m140602_111327_create_menu_table', 1655047648),
('m160312_050000_create_user', 1655047648),
('m170907_052038_rbac_add_index_on_auth_assignment_user_id', 1655047943),
('m180523_151638_rbac_updates_indexes_without_prefix', 1655047943),
('m190124_110200_add_verification_token_column_to_user_table', 1653837099),
('m200409_110543_rbac_update_mssql_trigger', 1655047943),
('m220523_184453_create_theater_table', 1653837099),
('m220523_184539_create_category_table', 1653837099),
('m220523_193728_create_movie_table', 1653837099),
('m220523_195105_create_session_table', 1653837099),
('m220523_201705_create_ticket_table', 1653837099);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `movie`
--

CREATE TABLE `movie` (
  `id` int(11) NOT NULL,
  `movie_name` varchar(255) DEFAULT NULL,
  `movie_description` varchar(255) DEFAULT NULL,
  `time` varchar(55) DEFAULT NULL,
  `image` varchar(55) DEFAULT NULL,
  `director` varchar(55) DEFAULT NULL,
  `actors` varchar(255) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `movie`
--

INSERT INTO `movie` (`id`, `movie_name`, `movie_description`, `time`, `image`, `director`, `actors`, `category_id`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(2, 'Top Gun: Maverick', '1986 yapımı Top Gun\'ın devam hikâyesi olan Top Gun: Maverick, usta pilot Maverick\'in bu kez eğitmen olarak hava kuvvetlerine geri dönüşü sonrası gelişen olayları anlatıyor. Donanmanın en iyi pilotlarından biri olan Pete “Maverick” Mitchell, 30 yıllık hizm', '131', '', 'Joseph Kosinski', 'Jennifer Connelly, Tom Cruise,Miles Teller', 2, 1653919195, 1653995251, 1, 1),
(28, 'Doktor Strange 2', ' Marvel Studios\'tan \"Doktor Strange Çoklu Evren Çılgınlığında\" filmi ile Marvel Sinematik Evreni, Çoklu Evrenin kapılarını açıyor ve sınırları her zamankinden daha ileri zorluyor. Hem eski hem de yeni mistik yol arkadaşlarının yardımıyla, gizemli yeni bir', '126', NULL, 'Sam Raimi', 'Elizabeth Olsen, Benedict Cumberbatch, Rachel McAdams', 3, 1653940868, 1653940965, 1, 1),
(29, 'Seans Yoksa Uyarı Verdir', 'ads', '12', NULL, 'as', 'asd', 2, 1653995104, 1655044789, 1, 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `session`
--

CREATE TABLE `session` (
  `id` int(11) NOT NULL,
  `movie_id` int(11) DEFAULT NULL,
  `theater_id` int(11) DEFAULT NULL,
  `day` date DEFAULT NULL,
  `time` varchar(55) DEFAULT NULL,
  `cost` varchar(11) DEFAULT NULL,
  `fulltime` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `session`
--

INSERT INTO `session` (`id`, `movie_id`, `theater_id`, `day`, `time`, `cost`, `fulltime`) VALUES
(28, 28, 5, '2022-06-05', '10:10', '50', '2022-06-05 10:10'),
(29, 28, 11, '2022-06-12', '20:50', '50', '	 2022-06-12 14:50'),
(30, 28, 5, '2022-06-13', '10:00', '50', '2022-06-13 10:00'),
(31, 28, 10, '2022-06-15', '18:00', '50', '2022-06-15 18:00'),
(32, 28, 1, '2022-06-15', '12:00', '50', '2022-06-15 12:00'),
(33, 28, 4, '2022-06-13', '19:00', '50', '2022-06-12 16:00'),
(35, 28, 11, '2022-06-19', '20:00', '50', '2022-06-19 20:00');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `theater`
--

CREATE TABLE `theater` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `theater`
--

INSERT INTO `theater` (`id`, `name`) VALUES
(1, 'Optimum Outlet Sinemax'),
(4, 'Palladium Sinemax'),
(5, 'Brandium Sinemax'),
(10, 'Akasya Sinemax'),
(11, 'Metropol Avm Sinemax');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ticket`
--

CREATE TABLE `ticket` (
  `id` int(11) NOT NULL,
  `session_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `seat_no` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `rezno` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `ticket`
--

INSERT INTO `ticket` (`id`, `session_id`, `user_id`, `seat_no`, `created_at`, `rezno`) VALUES
(1, 30, 1, 15, 1655048000, ''),
(2, 33, 1, 13, 1655054217, ''),
(3, 32, 1, 12, 1655054850, ''),
(4, 32, 1, 7, 1655054914, '#qWdi7Xc4'),
(5, 32, 1, 15, 1655071878, '#j2xERQGM');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT 10,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `verification_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Tablo döküm verisi `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`, `verification_token`) VALUES
(1, 'Kubilay', 'OTcs55yBWGKkgdY4bv2YyrSH019R33vR', '$2y$13$5xF3UWFVpzjO/YkMej7xHeIkMka1yz9sRTWWiTU0FxGBij05jtb5G', NULL, 'kubilaykoglu@gmail.com', 10, 1653837133, 1653837133, 'zS84-OCtC7q7L7f-TZZBo2wLOCRPuhsg_1653837133'),
(3, 'Admin', 'aw-_o2WVqdVB1lBivlY59AAxnAtn_DBI', '$2y$13$DyeI/.TcabGR5/1mfQt0L.xhZY/hUHlQBPylGYQkuzczQC0J2NEoG', NULL, 'admin@gmail.com', 10, 1655049396, 1655049396, 'EIYef55A34qpawd4-qe8ZXS0cy5Fsbei_1655049396');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Tablo için indeksler `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Tablo için indeksler `movie`
--
ALTER TABLE `movie`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx-movie-category_id` (`category_id`);

--
-- Tablo için indeksler `session`
--
ALTER TABLE `session`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx-session-movie_id` (`movie_id`),
  ADD KEY `idx-session-theater_id` (`theater_id`);

--
-- Tablo için indeksler `theater`
--
ALTER TABLE `theater`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx-ticket-session_id` (`session_id`),
  ADD KEY `idx-ticket-user_id` (`user_id`);

--
-- Tablo için indeksler `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Tablo için AUTO_INCREMENT değeri `movie`
--
ALTER TABLE `movie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Tablo için AUTO_INCREMENT değeri `session`
--
ALTER TABLE `session`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- Tablo için AUTO_INCREMENT değeri `theater`
--
ALTER TABLE `theater`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Tablo için AUTO_INCREMENT değeri `ticket`
--
ALTER TABLE `ticket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Tablo için AUTO_INCREMENT değeri `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `movie`
--
ALTER TABLE `movie`
  ADD CONSTRAINT `fk-movie-category_id` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`) ON DELETE CASCADE;

--
-- Tablo kısıtlamaları `session`
--
ALTER TABLE `session`
  ADD CONSTRAINT `fk-session-movie_id` FOREIGN KEY (`movie_id`) REFERENCES `movie` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk-session-theater_id` FOREIGN KEY (`theater_id`) REFERENCES `theater` (`id`) ON DELETE CASCADE;

--
-- Tablo kısıtlamaları `ticket`
--
ALTER TABLE `ticket`
  ADD CONSTRAINT `fk-ticket-session_id` FOREIGN KEY (`session_id`) REFERENCES `session` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk-ticket-user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
