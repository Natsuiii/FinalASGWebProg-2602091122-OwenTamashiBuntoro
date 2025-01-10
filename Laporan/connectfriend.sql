-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 10, 2025 at 04:47 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `connectfriend`
--

-- --------------------------------------------------------

--
-- Table structure for table `avatars`
--

CREATE TABLE `avatars` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `path` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `avatars`
--

INSERT INTO `avatars` (`id`, `name`, `path`, `price`, `created_at`, `updated_at`) VALUES
(1, 'Rem dolorem cupiditate.', 'avatars/avatar-1.jpeg', 500, '2025-01-10 07:52:02', '2025-01-10 07:52:02'),
(2, 'Distinctio dolorum enim.', 'avatars/avatar-2.jpeg', 100000, '2025-01-10 07:52:02', '2025-01-10 07:52:02'),
(3, 'Excepturi corrupti alias.', 'avatars/avatar-3.jpeg', 50, '2025-01-10 07:52:03', '2025-01-10 07:52:03'),
(4, 'Qui aperiam totam.', 'avatars/avatar-4.jpeg', 100000, '2025-01-10 07:52:03', '2025-01-10 07:52:03'),
(5, 'Impedit et similique.', 'avatars/avatar-5.jpeg', 100000, '2025-01-10 07:52:03', '2025-01-10 07:52:03'),
(6, 'Labore voluptatem repellendus voluptatum.', 'avatars/avatar-6.jpeg', 5000, '2025-01-10 07:52:03', '2025-01-10 07:52:03'),
(7, 'Laboriosam occaecati.', 'avatars/avatar-7.jpeg', 300, '2025-01-10 07:52:03', '2025-01-10 07:52:03'),
(8, 'Optio consequatur laboriosam.', 'avatars/avatar-8.jpeg', 10000, '2025-01-10 07:52:03', '2025-01-10 07:52:03'),
(9, 'Et magnam.', 'avatars/avatar-9.jpeg', 50, '2025-01-10 07:52:03', '2025-01-10 07:52:03'),
(10, 'Exercitationem est corporis.', 'avatars/avatar-10.jpeg', 100000, '2025-01-10 07:52:03', '2025-01-10 07:52:03'),
(11, 'Maiores magnam animi officia.', 'avatars/avatar-11.jpeg', 100000, '2025-01-10 07:52:03', '2025-01-10 07:52:03'),
(12, 'Quae inventore.', 'avatars/avatar-12.jpeg', 500, '2025-01-10 07:52:03', '2025-01-10 07:52:03'),
(13, 'Natus sed atque sit nemo.', 'avatars/avatar-13.jpeg', 100000, '2025-01-10 07:52:03', '2025-01-10 07:52:03'),
(14, 'Fugiat quibusdam ut illum.', 'avatars/avatar-14.jpeg', 500, '2025-01-10 07:52:03', '2025-01-10 07:52:03'),
(15, 'Omnis quisquam omnis aut.', 'avatars/avatar-15.jpeg', 1000, '2025-01-10 07:52:03', '2025-01-10 07:52:03'),
(16, 'Veniam et eos.', 'avatars/avatar-16.jpeg', 50000, '2025-01-10 07:52:03', '2025-01-10 07:52:03'),
(17, 'Dicta velit.', 'avatars/avatar-17.jpeg', 500, '2025-01-10 07:52:03', '2025-01-10 07:52:03'),
(18, 'Iure hic et.', 'avatars/avatar-18.jpeg', 50, '2025-01-10 07:52:04', '2025-01-10 07:52:04'),
(19, 'Ut et.', 'avatars/avatar-19.jpeg', 1000, '2025-01-10 07:52:04', '2025-01-10 07:52:04'),
(20, 'Consequatur non dolore.', 'avatars/avatar-20.jpeg', 10000, '2025-01-10 07:52:04', '2025-01-10 07:52:04');

-- --------------------------------------------------------

--
-- Table structure for table `avatar_user`
--

CREATE TABLE `avatar_user` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `avatar_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `avatar_user`
--

INSERT INTO `avatar_user` (`user_id`, `avatar_id`, `created_at`, `updated_at`) VALUES
(11, 1, NULL, NULL),
(11, 2, NULL, NULL),
(11, 6, NULL, NULL),
(11, 7, NULL, NULL),
(11, 20, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `friend_user`
--

CREATE TABLE `friend_user` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `friend_id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `friend_user`
--

INSERT INTO `friend_user` (`user_id`, `friend_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 7, 'accepted', NULL, NULL),
(1, 10, 'accepted', NULL, NULL),
(6, 11, 'pending', NULL, NULL),
(10, 11, 'pending', NULL, NULL),
(11, 1, 'accepted', '2025-01-10 08:15:28', '2025-01-10 08:15:28'),
(11, 2, 'accepted', '2025-01-10 08:15:29', '2025-01-10 08:15:29');

-- --------------------------------------------------------

--
-- Table structure for table `hobbies`
--

CREATE TABLE `hobbies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hobbies`
--

INSERT INTO `hobbies` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Reading', '2025-01-10 07:51:59', '2025-01-10 07:51:59'),
(2, 'Traveling', '2025-01-10 07:51:59', '2025-01-10 07:51:59'),
(3, 'Cooking', '2025-01-10 07:51:59', '2025-01-10 07:51:59'),
(4, 'Gaming', '2025-01-10 07:51:59', '2025-01-10 07:51:59'),
(5, 'Hiking', '2025-01-10 07:51:59', '2025-01-10 07:51:59'),
(6, 'Singing', '2025-01-10 07:51:59', '2025-01-10 07:51:59'),
(7, 'Dancing', '2025-01-10 07:51:59', '2025-01-10 07:51:59'),
(8, 'Painting', '2025-01-10 07:51:59', '2025-01-10 07:51:59'),
(9, 'Writing', '2025-01-10 07:51:59', '2025-01-10 07:51:59'),
(10, 'Photography', '2025-01-10 07:51:59', '2025-01-10 07:51:59'),
(11, 'Sports', '2025-01-10 07:51:59', '2025-01-10 07:51:59');

-- --------------------------------------------------------

--
-- Table structure for table `hobby_user`
--

CREATE TABLE `hobby_user` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `hobby_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hobby_user`
--

INSERT INTO `hobby_user` (`user_id`, `hobby_id`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, NULL),
(1, 9, NULL, NULL),
(1, 10, NULL, NULL),
(2, 1, NULL, NULL),
(2, 2, NULL, NULL),
(2, 5, NULL, NULL),
(3, 4, NULL, NULL),
(3, 7, NULL, NULL),
(3, 11, NULL, NULL),
(4, 7, NULL, NULL),
(4, 8, NULL, NULL),
(4, 10, NULL, NULL),
(5, 2, NULL, NULL),
(5, 3, NULL, NULL),
(5, 6, NULL, NULL),
(6, 8, NULL, NULL),
(6, 9, NULL, NULL),
(6, 11, NULL, NULL),
(7, 3, NULL, NULL),
(7, 6, NULL, NULL),
(7, 8, NULL, NULL),
(8, 2, NULL, NULL),
(8, 6, NULL, NULL),
(8, 8, NULL, NULL),
(9, 2, NULL, NULL),
(9, 4, NULL, NULL),
(9, 9, NULL, NULL),
(10, 5, NULL, NULL),
(10, 8, NULL, NULL),
(10, 9, NULL, NULL),
(11, 3, NULL, NULL),
(11, 6, NULL, NULL),
(11, 9, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_01_03_062640_create_hobbies_table', 1),
(5, '2025_01_10_091602_create_avatars_table', 1),
(6, '2025_01_10_094109_create_pivot_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('Rj73bAIckN45IH7KweHMua6fco1Zw37IjKcBjZHX', 11, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiRVNVU0l0bG12YnN0aVp4SU9sTjhZaVpybUZuSkZwRlVRdVRlUUpQZyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czoyMToiaHR0cDovLzEyNy4wLjAuMTo4MDAwIjt9czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kZXRhaWwvNiI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjExO30=', 1736523958);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `instagram` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `coins` double NOT NULL DEFAULT 100,
  `profile_image` text DEFAULT NULL,
  `bear_image` text DEFAULT NULL,
  `account_visible` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone_number`, `gender`, `instagram`, `description`, `password`, `coins`, `profile_image`, `bear_image`, `account_visible`, `created_at`, `updated_at`) VALUES
(1, 'Mulya Hidayanto', 'maryati.zalindra@lailasari.ac.id', '(+62) 254 7992 6307', 'female', 'keisha75', NULL, '$2y$12$hb9xGeX0Txm7h/RFycK3Aui6ZyTEM84h3iW4hkaUAQEk1Y6odITK2', 100, NULL, 'bear/bear-2.jpeg', 0, '2025-01-10 07:52:00', '2025-01-10 07:52:00'),
(2, 'Koko Ega Gunawan M.Pd', 'julia49@gmail.com', '(+62) 726 4246 948', 'male', 'omustofa', NULL, '$2y$12$fsl0kF1lZur3LK0mpQ8ptega.clLFfehEfkUITbCk1hEAWAvG3QRm', 100, NULL, NULL, 1, '2025-01-10 07:52:00', '2025-01-10 07:52:00'),
(3, 'Tomi Permadi', 'jasmin22@prayoga.co.id', '0649 9931 542', 'female', 'kusuma.rahayu', NULL, '$2y$12$eSF4R0O76xJ.j30W2T54te/cMwuzeOmpQVdOPdvXhUazcc47aIqPW', 100, NULL, NULL, 1, '2025-01-10 07:52:00', '2025-01-10 07:52:00'),
(4, 'Harimurti Tampubolon', 'jumari25@fujiati.mil.id', '0548 0040 832', 'female', 'chelsea64', NULL, '$2y$12$he4Mg28NfIRJAtQLjXl31e1LEdC8glPcV3vVCvb534oIAftyxshM2', 100, NULL, NULL, 1, '2025-01-10 07:52:00', '2025-01-10 07:52:00'),
(5, 'Galih Prabowo M.M.', 'nuraini.laila@pudjiastuti.tv', '0626 9907 672', 'male', 'yolanda.budi', NULL, '$2y$12$QC0SdAl6ZlxjsRBDJLR6Ou2jtNKo0N.PYn1BGDbriRPBayV89UG3O', 100, NULL, NULL, 1, '2025-01-10 07:52:01', '2025-01-10 07:52:01'),
(6, 'Legawa Ramadan', 'latika.wacana@gmail.co.id', '(+62) 863 533 510', 'female', 'hutapea.indah', NULL, '$2y$12$vr0ZMhZxp0.PVWLg1x8gZOD7eYXudbQ3AxaxIsXFtrfx5mNFdAcLe', 100, NULL, 'bear/bear-3.jpeg', 0, '2025-01-10 07:52:01', '2025-01-10 07:52:01'),
(7, 'Eli Nasyiah', 'rwijayanti@purnawati.net', '(+62) 236 4881 8195', 'male', 'vmayasari', NULL, '$2y$12$82QIjojCFOVPSjrzkHk/weSkH3fROxrt8mURlWt6UG4kNEbn9NxOO', 100, NULL, NULL, 1, '2025-01-10 07:52:01', '2025-01-10 07:52:01'),
(8, 'Prabu Haryanto', 'sudiati.dagel@gmail.com', '0848 2671 9973', 'female', 'naradi29', NULL, '$2y$12$P/3oy0H9RVWAyXnP.hKuJ.7ebNli7gRLiyoEOhdQvE1AyDbNFwDUu', 100, NULL, NULL, 1, '2025-01-10 07:52:02', '2025-01-10 07:52:02'),
(9, 'Bakianto Suwarno', 'nainggolan.estiono@gmail.co.id', '(+62) 813 3923 129', 'female', 'elvin46', NULL, '$2y$12$Hla3VdVRCDGlTuq4u2agX.fjV45tv50GmmWsGiIV4j6.pxVQXReU6', 100, NULL, NULL, 1, '2025-01-10 07:52:02', '2025-01-10 07:52:02'),
(10, 'Anastasia Prastuti', 'lazuardi.endra@simanjuntak.biz.id', '0257 6871 0255', 'male', 'karya79', NULL, '$2y$12$J7.jRgG8D4OuLaKUkTcGi.kqWUpPH156WSThtROg6Mc9XRuS7Y/ea', 100, NULL, NULL, 1, '2025-01-10 07:52:02', '2025-01-10 07:52:02'),
(11, 'Owen', 'owentb125@gmail.com', '123', 'male', 'owenn.tb', NULL, '$2y$12$uF/s7lW3u6ydBjCPy8YzoOVGKgWXoPOrJzEzbmiXTu4c6tAqHrTfS', 884090, 'http://127.0.0.1:8000/avatars/avatar-2.jpeg', 'bear/bear-1.jpeg', 1, '2025-01-10 07:52:02', '2025-01-10 08:41:04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `avatars`
--
ALTER TABLE `avatars`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `avatar_user`
--
ALTER TABLE `avatar_user`
  ADD PRIMARY KEY (`user_id`,`avatar_id`),
  ADD KEY `avatar_user_avatar_id_foreign` (`avatar_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `friend_user`
--
ALTER TABLE `friend_user`
  ADD PRIMARY KEY (`user_id`,`friend_id`),
  ADD KEY `friend_user_friend_id_foreign` (`friend_id`);

--
-- Indexes for table `hobbies`
--
ALTER TABLE `hobbies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hobby_user`
--
ALTER TABLE `hobby_user`
  ADD PRIMARY KEY (`user_id`,`hobby_id`),
  ADD KEY `hobby_user_hobby_id_foreign` (`hobby_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `avatars`
--
ALTER TABLE `avatars`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hobbies`
--
ALTER TABLE `hobbies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `avatar_user`
--
ALTER TABLE `avatar_user`
  ADD CONSTRAINT `avatar_user_avatar_id_foreign` FOREIGN KEY (`avatar_id`) REFERENCES `avatars` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `avatar_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `friend_user`
--
ALTER TABLE `friend_user`
  ADD CONSTRAINT `friend_user_friend_id_foreign` FOREIGN KEY (`friend_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `friend_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `hobby_user`
--
ALTER TABLE `hobby_user`
  ADD CONSTRAINT `hobby_user_hobby_id_foreign` FOREIGN KEY (`hobby_id`) REFERENCES `hobbies` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `hobby_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
