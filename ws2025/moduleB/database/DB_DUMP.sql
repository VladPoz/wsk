-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Хост: MySQL-8.0:3306
-- Время создания: Апр 30 2026 г., 12:02
-- Версия сервера: 8.0.43
-- Версия PHP: 8.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `moduleB_02`
--

-- --------------------------------------------------------

--
-- Структура таблицы `adverts`
--

CREATE TABLE `adverts` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('published','moderation','declined') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'published',
  `price` int NOT NULL,
  `views_count` int NOT NULL DEFAULT '0',
  `category_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `photos` json NOT NULL,
  `paid_services` json DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `adverts`
--

INSERT INTO `adverts` (`id`, `title`, `text`, `status`, `price`, `views_count`, `category_id`, `user_id`, `photos`, `paid_services`) VALUES
(1, 'Modern Apartment in City Center', 'Spacious 2-bedroom apartment with great view.', 'published', 1200, 256, 1, 1, '[\"advert-1.jpg\", \"advert-2.jpg\"]', '[\"top\", \"vip\"]'),
(2, 'Cozy Suburban House', 'Quiet area, 3 bedrooms, renovated kitchen.', 'declined', 980, 143, 5, 2, '[\"advert-1.jpg\", \"advert-2.jpg\", \"advert-3.jpg\"]', '[]'),
(3, '8', 'Quiet area, 3 bedrooms, renovated kitchen.', 'published', 912, 142, 5, 2, '[\"advert-1.jpg\", \"advert-2.jpg\", \"advert-3.jpg\"]', '[]'),
(4, '7', 'Quiet area, 3 bedrooms, renovated kitchen.', 'published', 901, 141, 5, 2, '[\"advert-1.jpg\", \"advert-2.jpg\", \"advert-3.jpg\"]', '[]'),
(5, '6', 'Quiet area, 3 bedrooms, renovated kitchen.', 'published', 900, 140, 5, 2, '[\"advert-1.jpg\", \"advert-2.jpg\", \"advert-3.jpg\"]', '[]'),
(6, '5', 'Quiet area, 3 bedrooms, renovated kitchen.', 'published', 870, 139, 5, 2, '[\"advert-1.jpg\", \"advert-2.jpg\", \"advert-3.jpg\"]', '[]'),
(7, '4', 'Quiet area, 3 bedrooms, renovated kitchen.', 'published', 850, 138, 5, 2, '[\"advert-1.jpg\", \"advert-2.jpg\", \"advert-3.jpg\"]', '[]'),
(8, '3', 'Quiet area, 3 bedrooms, renovated kitchen.', 'published', 830, 137, 5, 2, '[\"advert-1.jpg\", \"advert-2.jpg\", \"advert-3.jpg\"]', '[]'),
(9, '2', 'Quiet area, 3 bedrooms, renovated kitchen.', 'published', 800, 136, 5, 2, '[\"advert-1.jpg\", \"advert-2.jpg\", \"advert-3.jpg\"]', '[]'),
(10, '1', 'Quiet area, 3 bedrooms, renovated kitchen.', 'published', 790, 135, 5, 2, '[\"advert-1.jpg\", \"advert-2.jpg\", \"advert-3.jpg\"]', '[]'),
(11, '0', 'Quiet area, 3 bedrooms, renovated kitchen.', 'published', 750, 134, 5, 2, '[\"advert-1.jpg\", \"advert-2.jpg\", \"advert-3.jpg\"]', '[]'),
(12, '-1', 'Quiet area, 3 bedrooms, renovated kitchen.', 'published', 730, 133, 5, 2, '[\"advert-1.jpg\", \"advert-2.jpg\", \"advert-3.jpg\"]', '[]'),
(13, '-2', 'Quiet area, 3 bedrooms, renovated kitchen.', 'published', 710, 132, 5, 2, '[\"advert-1.jpg\", \"advert-2.jpg\", \"advert-3.jpg\"]', '[]'),
(14, '-3', 'Quiet area, 3 bedrooms, renovated kitchen.', 'published', 700, 131, 5, 2, '[\"advert-1.jpg\", \"advert-2.jpg\", \"advert-3.jpg\"]', '[]');

-- --------------------------------------------------------

--
-- Структура таблицы `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE `categories` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Real Estate'),
(2, 'Vehicles'),
(3, 'Jobs'),
(4, 'Services'),
(5, 'Electronics'),
(6, 'Personal Items'),
(7, 'Hobbies & Leisure'),
(8, 'Animals & Pets'),
(9, 'Home & Garden'),
(13, 'test');

-- --------------------------------------------------------

--
-- Структура таблицы `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_04_30_041126_create_categories_table', 1),
(5, '2026_04_30_041139_create_adverts_table', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('BXOFCyrmPhdhIb6otOUpKoWwleCsablkIwWUwkfn', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiM2VxN2pHZ251RXhBbWdzWjRVeXhsbkw4c1QyM2dRY0RveERiUlpxZyI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozNzoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2FkbWluL2Rhc2hib2FyZCI7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjMyOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYWRtaW4vdXNlciI7czo1OiJyb3V0ZSI7czo1OiJ1c2VycyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjI7fQ==', 1777532473);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('moderator','user') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `phone`, `email`, `password`, `role`, `created_at`, `updated_at`) VALUES
(1, 'Ethan Brooks', '+1 202 555 0143', 'ethan@example.com', '$2y$12$za59Bu0ZbdxMHi2nGzihTu/lGoPr4go7..JYg8.dxVNpJ5.VLrIBu', 'user', '2026-04-30 00:53:42', '2026-04-30 00:53:42'),
(2, 'Olivia Carter', '+44 7700 900321', 'olivia@example.com', '$2y$12$l4HdjVBBEgsdymm9aAZHLOb8lSNpFASddlywC5wVr6I6M.yFxWFWq', 'moderator', '2026-04-30 00:53:42', '2026-04-30 00:53:42');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `adverts`
--
ALTER TABLE `adverts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `adverts_category_id_foreign` (`category_id`),
  ADD KEY `adverts_user_id_foreign` (`user_id`);

--
-- Индексы таблицы `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Индексы таблицы `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Индексы таблицы `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Индексы таблицы `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Индексы таблицы `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Индексы таблицы `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_phone_unique` (`phone`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `adverts`
--
ALTER TABLE `adverts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT для таблицы `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `adverts`
--
ALTER TABLE `adverts`
  ADD CONSTRAINT `adverts_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `adverts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
