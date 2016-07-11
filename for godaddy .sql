
USE `wassan_data_store`;

-- --------------------------------------------------------

--
-- Table structure for table `amount_received`
--

CREATE TABLE `amount_received` (
  `id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `amount_received_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `remark` text NOT NULL,
  `data_entered_by` int(11) NOT NULL,
  `user_type` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `amount_received`
--

INSERT INTO `amount_received` (`id`, `amount`, `amount_received_on`, `remark`, `data_entered_by`, `user_type`, `created_at`) VALUES
(6, 50000, '2016-05-10 18:30:00', 'received', 9, 'user', '2016-05-27 06:13:49'),
(8, 50000, '2016-05-09 18:30:00', 'amount received', 10, 'user', '2016-05-27 12:06:48'),
(12, 20000, '2016-05-08 18:30:00', 'received on 9th', 9, 'user', '2016-05-27 12:25:29'),
(13, 1000000, '2016-05-31 18:30:00', 'sdfdsfsdf', 9, 'user', '2016-06-01 16:03:22'),
(14, 33333, '2016-06-01 18:30:00', 'received', 9, 'user', '2016-06-08 06:24:52');

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `abbreviation` varchar(2) NOT NULL,
  `description` text NOT NULL,
  `deadline` timestamp NULL,
  `uploaded_by` int(11) NOT NULL,
  `upload_user_type` varchar(70) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`id`, `name`, `abbreviation`, `description`, `deadline`, `uploaded_by`, `upload_user_type`, `created_at`) VALUES
(46, 'low_poly.lxs_-_27_05_2016_05_28_01_PM-1.lxs', 'A3', 'asdsad', '2016-06-03 17:37:46', 1, 'admin', '2016-06-04 11:13:34'),
(49, 'install.res.1041.dll_-_27_05_2016_05_57_05_PM-10.dll', 'A3', 'Dll file\r\n', '2016-06-04 11:33:01', 10, 'user', '2016-06-01 06:10:41'),
(51, 'untitled.mtl_-_01_06_2016_08_43_49_PM-1.mtl', 'A1', 'sadasdasdasda', '2016-06-03 17:37:46', 1, 'admin', '2016-06-01 15:13:49'),
(53, 'final.json_-_03_06_2016_10_59_38_PM-9.json', 'J8', 'sadasdasd', '2016-06-03 17:37:46', 9, 'user', '2016-06-03 17:29:38'),
(54, 'final.json_-_03_06_2016_11_11_25_PM-1.json', 'zc', 'zxczxczxc', '0000-00-00 00:00:00', 1, 'admin', '2016-06-03 17:41:25'),
(55, 'final.json_-_03_06_2016_11_13_03_PM-1.json', 'XX', 'sadasdasd', '2016-06-22 18:30:00', 1, 'admin', '2016-06-03 17:43:03'),
(56, 'grain.png_-_04_06_2016_01_46_20_PM-9.png', 'XX', 'asdadasdasd', '2016-06-04 08:18:06', 9, 'user', '2016-07-28 08:16:20'),
(57, 'grain.png_-_04_06_2016_02_23_00_PM-10.png', 'XX', 'asdadsad', '2016-06-04 08:53:00', 10, 'user', '2016-06-04 08:53:00'),
(58, 'frozen_by_dresew-d8iyij4.jpg_-_08_06_2016_03_29_19_PM-11.jpg', 'XX', 'asdadasdasd asdasd', '2016-06-08 09:59:19', 11, 'user', '2016-06-08 09:59:19');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1),
('2015_03_30_121557_entrust_setup_tables', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE `permission_role` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `permission_role`
--

INSERT INTO `permission_role` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(9, 2),
(10, 1),
(10, 2),
(11, 1),
(11, 2),
(12, 1),
(12, 2),
(13, 1),
(14, 1),
(14, 3);

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `route` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `display_name`, `description`, `route`, `created_at`, `updated_at`) VALUES
(1, 'manage_roles', 'Manage roles', '', 'roles', '2016-05-23 13:39:05', '2016-05-23 13:39:05'),
(2, 'create_roles', 'Create roles', '', 'roles/create', '2016-05-23 13:39:05', '2016-05-23 13:39:05'),
(3, 'update_roles', 'Update roles', '', 'roles/{roles}/edit', '2016-05-23 13:39:05', '2016-05-23 13:39:05'),
(4, 'delete_roles', 'Delete roles', '', 'roles/{roles}', '2016-05-23 13:39:05', '2016-05-23 13:39:05'),
(5, 'manage_users', 'Manager users', '', 'users', '2016-05-23 13:39:05', '2016-05-23 13:39:05'),
(6, 'create_users', 'Create users', '', 'users/create', '2016-05-23 13:39:05', '2016-05-23 13:39:05'),
(7, 'update_users', 'Update users', '', 'users/{users}/edit', '2016-05-23 13:39:05', '2016-05-23 13:39:05'),
(8, 'delete_users', 'Delete users', '', 'users/{users}', '2016-05-23 13:39:05', '2016-05-23 13:39:05'),
(9, 'manage_permissions', 'Manage permissions', '', 'permissions', '2016-05-23 13:39:05', '2016-05-23 13:39:05'),
(10, 'create_permissions', 'Create permissions', '', 'permissions/create', '2016-05-23 13:39:05', '2016-05-23 13:39:05'),
(11, 'update_permissions', 'Update permissions', '', 'permissions/{permissions}/edit', '2016-05-23 13:39:05', '2016-05-23 13:39:05'),
(12, 'delete_permissions', 'Delete permissions', '', 'permissions/{permissions}', '2016-05-23 13:39:05', '2016-05-23 13:39:05'),
(13, 'admin_file_upload', 'Admin file_upload', '', NULL, '2016-05-23 23:09:45', '2016-05-23 23:09:45'),
(14, 'user file upload', 'user file upload', '', NULL, '2016-05-24 00:36:51', '2016-05-24 00:36:51');

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`user_id`, `role_id`) VALUES
(1, 1),
(2, 2),
(9, 3),
(10, 3),
(11, 3),
(12, 3),
(13, 1);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `level` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `display_name`, `description`, `level`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'Administrator', NULL, 10, '2016-05-23 13:39:05', '2016-05-23 13:39:05'),
(2, 'editor', 'Editor', NULL, 5, '2016-05-23 13:39:05', '2016-05-23 13:39:05'),
(3, 'user', 'User', '', 1, '2016-05-23 13:39:05', '2016-05-24 00:37:08');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@admin.com', '$2y$10$Y4.JmlLRvS6cFCXCj1qzi.doIeVRNhM0l/wV3Hyf9G86Ea4m9WTU6', 'VhpwvWzcdH7yXtmoUYwWt4HB2w3mqQSo8hbgOIk9tEj0X18juxNwuaZDI5j1', '2016-05-23 13:39:05', '2016-06-08 09:00:10'),
(2, 'editor', 'editor@editor.com', '$2y$10$Xp2ueiIjKxM/BVrf93KZN.ZV4.U60tFwTF/5cvPEJyZCUSmZxcj3u', NULL, '2016-05-23 13:39:05', '2016-05-23 13:39:05'),
(9, 'vishnu', 'vishnu27990@gmail.com', '$2y$10$qv883qpz/Uyj9TxrcB9lwemWhhfM6m14WsTXOhSDlr7puSxTW0TcW', 'Rp22M2zZHb3q7j1dc7y8dK47NDH0m0TmiiirLtZTm3urelVaEyu3g1jJOr7Z', '2016-05-27 06:11:49', '2016-06-08 06:38:33'),
(10, 'ramesh', 'ramesh@gmail.com', '$2y$10$Yl0sAIxhKDjKT0zh81oNJuhjxfbwHgBEQR7wM/KUFOoK3Sv2LJtYO', 'mvXZsX1M3MAg6N471U5zVacEwngQuIM1gkjKchrj2zcJdQhAX2R7r9kir8Sc', '2016-05-27 12:03:38', '2016-05-27 12:24:29'),
(11, 'user3', 'user3@gmail.com', '$2y$10$PTpqYCv2qgmMMUp0YeQHguv2tHtzLbsMl7v5indQFcZpWIXB5iW8G', NULL, '2016-06-04 14:36:15', '2016-06-04 14:36:15'),
(12, 'ravi', 'raviwn1@gmail.com', '$2y$10$0IprT2tPQaZiskQ8UmW1E.mXp48dg9thPVh6l0RZlAFFKGJ.N1zZy', 'TWp9u27Yf58qUMmfnj2Q8QjyWZYhXHXfQX1BZoZBbD8OhItKTLuwQ18ySFm0', '2016-05-28 09:06:56', '2016-06-08 06:14:28'),
(13, 'secondadmin', 'secondadmin@gmail.com', '$2y$10$4fq.UwSPdBT9ESx9lkoXk.2ICs6sXcJXXP219ybA.EE97RWdsONCq', 'zq8vVBADlySI84rylt7ozFBtJe504NpEDUDJwgUyoa4HqwAFYToCzjH0iWXz', '2016-06-08 09:00:04', '2016-06-08 09:58:25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `amount_received`
--
ALTER TABLE `amount_received`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `permission_role_role_id_foreign` (`role_id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_unique` (`name`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`user_id`,`role_id`),
  ADD KEY `role_user_role_id_foreign` (`role_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

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
-- AUTO_INCREMENT for table `amount_received`
--
ALTER TABLE `amount_received`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;
--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
