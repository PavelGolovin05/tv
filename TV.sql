-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:3306
-- Время создания: Июн 13 2020 г., 20:22
-- Версия сервера: 5.7.28-0ubuntu0.18.04.4
-- Версия PHP: 7.2.24-0ubuntu0.18.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `TV`
--

-- --------------------------------------------------------

--
-- Структура таблицы `age_rating`
--

CREATE TABLE `age_rating` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `age_rating`
--

INSERT INTO `age_rating` (`id`, `name`) VALUES
(1, '12+'),
(2, '16+'),
(3, '18+'),
(4, '21+'),
(5, '6+'),
(6, 'Без ограничений');

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_channel_type` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id`, `name`, `is_channel_type`) VALUES
(1, 'Новостной канал', 1),
(2, 'Развлекательный канал', 1),
(3, 'Новости', 0),
(4, 'Кулинарное шоу', 0),
(5, 'Политика', 0),
(6, 'Приключения', 0),
(7, 'Документальный фильм', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `countries`
--

CREATE TABLE `countries` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `countries`
--

INSERT INTO `countries` (`id`, `name`) VALUES
(3, 'Великобритания'),
(1, 'ДНР'),
(2, 'Россия'),
(4, 'США');

-- --------------------------------------------------------

--
-- Структура таблицы `failed_jobs`
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
-- Структура таблицы `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2020_02_06_132337_create_countries_table', 1),
(5, '2020_02_06_132417_create_categories_table', 1),
(6, '2020_02_06_132515_create_age_rating_table', 1),
(7, '2020_02_06_132544_create_tv_channels_table', 1),
(8, '2020_02_06_132609_create_user_favourite_channel_table', 1),
(9, '2020_02_06_144817_create_telecasts_table', 1),
(10, '2020_02_06_144832_create_telecast_show_table', 1),
(11, '2020_02_20_123132_create_positions_table', 2),
(12, '2020_02_20_123803_create_staff_table', 2),
(13, '2020_02_20_123816_create_telecast_staff_table', 2);

-- --------------------------------------------------------

--
-- Структура таблицы `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `positions`
--

CREATE TABLE `positions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `positions`
--

INSERT INTO `positions` (`id`, `name`) VALUES
(2, 'Ведущий'),
(1, 'Продюсер');

-- --------------------------------------------------------

--
-- Структура таблицы `staff`
--

CREATE TABLE `staff` (
  `id` int(10) UNSIGNED NOT NULL,
  `FIO` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `position_id` int(10) UNSIGNED DEFAULT NULL,
  `channel_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `staff`
--

INSERT INTO `staff` (`id`, `FIO`, `position_id`, `channel_id`) VALUES
(1, 'Абдула', 2, 1),
(2, 'Ахмет', 1, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `telecasts`
--

CREATE TABLE `telecasts` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `age_rating_id` int(10) UNSIGNED DEFAULT NULL,
  `channel_id` int(10) UNSIGNED DEFAULT NULL,
  `category_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `telecasts`
--

INSERT INTO `telecasts` (`id`, `name`, `age_rating_id`, `channel_id`, `category_id`) VALUES
(1, 'Новости', 6, 1, 3),
(2, 'Политические разборки', 2, 1, 5),
(3, 'Александр Захарченко', 1, 1, 7),
(4, 'На ножах', 1, 2, 4),
(5, 'Орел и Решка', 1, 2, 6),
(6, 'Новости недели', 6, 4, 3),
(7, 'Новости Донецка', 6, 4, 3),
(8, 'Политика ДНР', 1, 1, 5),
(14, 'Готовим в ДНР', 5, 1, 4);

-- --------------------------------------------------------

--
-- Структура таблицы `telecast_show`
--

CREATE TABLE `telecast_show` (
  `id` int(10) UNSIGNED NOT NULL,
  `show_start` datetime NOT NULL,
  `show_end` datetime NOT NULL,
  `telecast_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `telecast_show`
--

INSERT INTO `telecast_show` (`id`, `show_start`, `show_end`, `telecast_id`) VALUES
(1, '2020-02-07 16:00:00', '2020-02-07 16:30:00', 1),
(2, '2020-02-07 16:30:00', '2020-02-07 17:30:00', 2),
(3, '2020-02-08 14:00:00', '2020-02-08 15:00:00', 3),
(4, '2020-02-07 17:00:00', '2020-02-07 18:00:00', 4),
(5, '2020-02-08 13:00:00', '2020-02-08 14:00:00', 5),
(6, '2020-02-08 16:00:00', '2020-02-08 16:30:00', 1),
(7, '2020-02-08 16:30:00', '2020-02-08 17:30:00', 2),
(8, '2020-02-08 17:00:00', '2020-02-08 18:00:00', 4),
(9, '2020-02-09 18:00:00', '2020-02-09 18:30:00', 6),
(10, '2020-02-20 19:00:00', '2020-02-20 20:00:00', 1),
(11, '2020-02-20 18:00:00', '2020-02-20 19:00:00', 2);

-- --------------------------------------------------------

--
-- Структура таблицы `telecast_staff`
--

CREATE TABLE `telecast_staff` (
  `id` int(10) UNSIGNED NOT NULL,
  `telecast_id` int(10) UNSIGNED DEFAULT NULL,
  `staff_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `telecast_staff`
--

INSERT INTO `telecast_staff` (`id`, `telecast_id`, `staff_id`) VALUES
(2, 1, 1),
(3, 2, 2),
(4, 1, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `tv_channels`
--

CREATE TABLE `tv_channels` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_id` int(10) UNSIGNED DEFAULT NULL,
  `category_id` int(10) UNSIGNED DEFAULT NULL,
  `photo_link` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `tv_channels`
--

INSERT INTO `tv_channels` (`id`, `name`, `country_id`, `category_id`, `photo_link`, `description`) VALUES
(1, 'Первый Республиканский', 1, 1, 'https://maxpark.com/static/u/article_image/16/03/03/tmpYNoe6i.jpeg', ''),
(2, 'Пятница', 2, 2, 'https://lh3.googleusercontent.com/proxy/ZQfFthknVdQy2fsfw6VLXt8OYO4qYvEYo1fuuZkOmMfiSjmdTwiG82Lq-qP596YjT9eMuVpyb8Bly3E8xzzU3xRwcVicHuePY2P4fAiHT1Uh6svGTiWJIC711o8', ''),
(4, 'Оплот ТВ', 1, 1, 'https://yt3.ggpht.com/a/AGF-l78c5wf1WJbGN1pgvgC9NkE3Sz355i4MjZGo7w=s900-c-k-c0xffffffff-no-rj-mo', 'Лучший новостной канал');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_admin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `is_admin`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'pasha-golovin1997@yandex.ru', NULL, '$2y$10$GP36ZQ66rQRKyRn6j5nHI.UhSWqgnsEZNPk8gHEPvoqgG0FRrDmxm', '1', 'w8lCMlTqB1t2TXkeL6gQXp3iIeZ9b1Hv5yXTbd2pR3q0uE6rNRinbhXY75JU', '2020-02-06 15:15:17', '2020-02-06 15:15:17');

-- --------------------------------------------------------

--
-- Структура таблицы `user_favourite_channel`
--

CREATE TABLE `user_favourite_channel` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `channel_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `age_rating`
--
ALTER TABLE `age_rating`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `age_rating_name_unique` (`name`);

--
-- Индексы таблицы `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_name_unique` (`name`);

--
-- Индексы таблицы `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `countries_name_unique` (`name`);

--
-- Индексы таблицы `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Индексы таблицы `positions`
--
ALTER TABLE `positions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `positions_name_unique` (`name`);

--
-- Индексы таблицы `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`),
  ADD KEY `staff_channel_id_foreign` (`channel_id`),
  ADD KEY `staff_position_id_foreign` (`position_id`);

--
-- Индексы таблицы `telecasts`
--
ALTER TABLE `telecasts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `telecasts_age_rating_id_foreign` (`age_rating_id`),
  ADD KEY `telecasts_channel_id_foreign` (`channel_id`),
  ADD KEY `telecasts_category_id_foreign` (`category_id`);

--
-- Индексы таблицы `telecast_show`
--
ALTER TABLE `telecast_show`
  ADD PRIMARY KEY (`id`),
  ADD KEY `telecast_show_telecast_id_foreign` (`telecast_id`);

--
-- Индексы таблицы `telecast_staff`
--
ALTER TABLE `telecast_staff`
  ADD PRIMARY KEY (`id`),
  ADD KEY `telecast_staff_telecast_id_foreign` (`telecast_id`),
  ADD KEY `telecast_staff_staff_id_foreign` (`staff_id`);

--
-- Индексы таблицы `tv_channels`
--
ALTER TABLE `tv_channels`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tv_channels_country_id_foreign` (`country_id`),
  ADD KEY `tv_channels_category_id_foreign` (`category_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Индексы таблицы `user_favourite_channel`
--
ALTER TABLE `user_favourite_channel`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_favourite_channel_user_id_foreign` (`user_id`),
  ADD KEY `user_favourite_channel_channel_id_foreign` (`channel_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `age_rating`
--
ALTER TABLE `age_rating`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT для таблицы `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT для таблицы `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT для таблицы `positions`
--
ALTER TABLE `positions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `telecasts`
--
ALTER TABLE `telecasts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT для таблицы `telecast_show`
--
ALTER TABLE `telecast_show`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT для таблицы `telecast_staff`
--
ALTER TABLE `telecast_staff`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT для таблицы `tv_channels`
--
ALTER TABLE `tv_channels`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблицы `user_favourite_channel`
--
ALTER TABLE `user_favourite_channel`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `staff`
--
ALTER TABLE `staff`
  ADD CONSTRAINT `staff_channel_id_foreign` FOREIGN KEY (`channel_id`) REFERENCES `tv_channels` (`id`),
  ADD CONSTRAINT `staff_position_id_foreign` FOREIGN KEY (`position_id`) REFERENCES `positions` (`id`);

--
-- Ограничения внешнего ключа таблицы `telecasts`
--
ALTER TABLE `telecasts`
  ADD CONSTRAINT `telecasts_age_rating_id_foreign` FOREIGN KEY (`age_rating_id`) REFERENCES `age_rating` (`id`),
  ADD CONSTRAINT `telecasts_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `telecasts_channel_id_foreign` FOREIGN KEY (`channel_id`) REFERENCES `tv_channels` (`id`);

--
-- Ограничения внешнего ключа таблицы `telecast_show`
--
ALTER TABLE `telecast_show`
  ADD CONSTRAINT `telecast_show_telecast_id_foreign` FOREIGN KEY (`telecast_id`) REFERENCES `telecasts` (`id`);

--
-- Ограничения внешнего ключа таблицы `telecast_staff`
--
ALTER TABLE `telecast_staff`
  ADD CONSTRAINT `telecast_staff_staff_id_foreign` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`id`),
  ADD CONSTRAINT `telecast_staff_telecast_id_foreign` FOREIGN KEY (`telecast_id`) REFERENCES `telecasts` (`id`);

--
-- Ограничения внешнего ключа таблицы `tv_channels`
--
ALTER TABLE `tv_channels`
  ADD CONSTRAINT `tv_channels_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `tv_channels_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`);

--
-- Ограничения внешнего ключа таблицы `user_favourite_channel`
--
ALTER TABLE `user_favourite_channel`
  ADD CONSTRAINT `user_favourite_channel_channel_id_foreign` FOREIGN KEY (`channel_id`) REFERENCES `tv_channels` (`id`),
  ADD CONSTRAINT `user_favourite_channel_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
