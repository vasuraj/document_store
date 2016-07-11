
USE `gw_data_store`;

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
(8, 50000, '2016-05-27 05:29:57', 'amount received', 10, 'user', '2016-05-28 12:06:48'),
(12, 20000, '2016-05-08 18:30:00', 'received on 9th', 9, 'user', '2016-05-27 12:25:29'),
(13, 1000000, '2016-05-31 18:30:00', 'sdfdsfsdf', 9, 'user', '2016-06-01 16:03:22'),
(16, 5000, '2016-06-11 18:30:00', 'some amount received', 12, 'user', '2016-06-13 16:38:16'),
(17, 250000, '2016-06-08 18:30:00', 'received 250000', 9, 'user', '2016-06-17 06:17:41');

-- --------------------------------------------------------

--
-- Table structure for table `audit_reports`
--

CREATE TABLE `audit_reports` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `description` text NOT NULL,
  `from_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `to_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `uploaded_by` int(11) NOT NULL,
  `upload_user_type` varchar(70) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `audit_reports`
--

INSERT INTO `audit_reports` (`id`, `name`, `description`, `from_date`, `to_date`, `uploaded_by`, `upload_user_type`, `created_at`) VALUES
(3, 'sample.xlsx_-_17_06_2016_11_52_07_AM-9.xlsx', 'description of audit report', '2016-06-06 18:30:00', '2016-06-21 18:30:00', 9, 'user', '2016-06-17 06:22:07');

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `abbreviation` varchar(4) NOT NULL,
  `description` text NOT NULL,
  `deadline` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `uploaded_by` int(11) NOT NULL,
  `upload_user_type` varchar(70) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`id`, `name`, `abbreviation`, `description`, `deadline`, `uploaded_by`, `upload_user_type`, `created_at`) VALUES
(46, 'low_poly.lxs_-_27_05_2016_05_28_01_PM-1.lxs', 'A3', 'asdsad', '2016-06-03 17:37:46', 1, 'admin', '2016-06-04 11:13:34'),
(55, 'final.json_-_03_06_2016_11_13_03_PM-1.json', 'XX', 'sadasdasd', '2016-06-22 18:30:00', 1, 'admin', '2016-06-03 17:43:03'),
(58, 'frozen_by_dresew-d8iyij4.jpg_-_08_06_2016_03_29_19_PM-11.jpg', 'XX', 'asdadasdasd asdasd', '2016-06-08 09:59:19', 11, 'user', '2016-06-08 09:59:19'),
(60, 'low_poly.lxs_-_14_06_2016_02_12_18_PM-9.lxs', 'A1', 'lowpoly', '2016-06-14 08:42:18', 9, 'user', '2016-06-14 08:42:18'),
(61, 'untitled.mtl_-_14_06_2016_01_50_47_PM-1.mtl', 'ASD5', 'dasdasdas', '2016-06-16 18:30:00', 1, 'admin', '2016-06-14 08:20:47'),
(63, 'sample.xlsx_-_17_06_2016_11_15_36_AM-1.xlsx', '17ts', 'sample test', '2016-06-16 18:30:00', 1, 'admin', '2016-06-17 05:45:36'),
(65, 'sample.xlsx_-_17_06_2016_11_45_47_AM-9.xlsx', '17ts', '17ts sample document', '2016-06-17 06:15:47', 9, 'user', '2016-06-17 06:15:47');

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
(12, 3),
(13, 4),
(14, 4);

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
(3, 'user', 'User', '', 1, '2016-05-23 13:39:05', '2016-05-24 00:37:08'),
(4, 'Guest', 'Guest', 'Guest view -read only mode', 9, '2016-06-16 16:05:23', '2016-06-16 16:05:23');

-- --------------------------------------------------------

--
-- Table structure for table `uc_uploads`
--

CREATE TABLE `uc_uploads` (
  `id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `submit_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `from_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `to_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `data_entered_by` int(11) NOT NULL,
  `user_type` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `uc_uploads`
--

INSERT INTO `uc_uploads` (`id`, `amount`, `submit_date`, `from_date`, `to_date`, `data_entered_by`, `user_type`, `created_at`) VALUES
(3, 2000, '2016-06-08 18:30:00', '2016-06-08 18:30:00', '2016-06-23 18:30:00', 9, 'user', '2016-06-17 06:18:15'),
(4, 5000, '2016-06-21 18:30:00', '2016-06-05 18:30:00', '2016-06-28 18:30:00', 9, 'user', '2016-06-17 06:19:43');

-- --------------------------------------------------------

--
-- Table structure for table `user_extra_info`
--

CREATE TABLE `user_extra_info` (
  `id` int(11) NOT NULL,
  `orgname` varchar(150) NOT NULL,
  `orgemail` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `whatsapp_number` varchar(10) NOT NULL,
  `skype_id` varchar(50) NOT NULL,
  `landline_number` varchar(12) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_extra_info`
--

INSERT INTO `user_extra_info` (`id`, `orgname`, `orgemail`, `address`, `mobile`, `whatsapp_number`, `skype_id`, `landline_number`, `password`) VALUES
(1, 'WASSAN', 'support@wassan.org', 'street no. 1', '7032055966', '1234567890', 'skey_id1234', '7032055966', 'admin'),
(9, 'org name updated', 'org@email.comupdated', 'address here updated', '5555555555', '6666666666', '777777777777', '8888888888', '123');

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
(1, 'Admin', 'admin@admin.com', '$2y$10$5O7TiM9Xs0RUXWMMf7l21uJU4fWR4swU4Emrb8hqXEowhbR2qJ0rG', 'FMCbkun4uwfRR2sSL66IwcdAUKGQqAyn6dEl8ymR4NR04oiqA1g1LJYJKV6e', '2016-05-23 13:39:05', '2016-06-17 06:13:03'),
(2, 'editor', 'editor@editor.com', '$2y$10$Xp2ueiIjKxM/BVrf93KZN.ZV4.U60tFwTF/5cvPEJyZCUSmZxcj3u', NULL, '2016-05-23 13:39:05', '2016-05-23 13:39:05'),
(9, 'vishnu', 'vishnu27990@gmail.com', '$2y$10$gsLAp6DqLKBIG1qnSj8eYOqM2SLo.aBv5114OJI0KOKtFZCoG3xem', 'q8AhX5AzX4Dn0EeGAhNG3lVy8qGWLsubbRgzYMmh3L1mIfnVXoQsgOSdMD0i', '2016-05-27 06:11:49', '2016-06-17 06:28:37'),
(10, 'ramesh', 'ramesh@gmail.com', '$2y$10$Yl0sAIxhKDjKT0zh81oNJuhjxfbwHgBEQR7wM/KUFOoK3Sv2LJtYO', 'mvXZsX1M3MAg6N471U5zVacEwngQuIM1gkjKchrj2zcJdQhAX2R7r9kir8Sc', '2016-05-27 12:03:38', '2016-05-27 12:24:29'),
(12, 'ravi', 'raviwn1@gmail.com', '$2y$10$0IprT2tPQaZiskQ8UmW1E.mXp48dg9thPVh6l0RZlAFFKGJ.N1zZy', 'TWp9u27Yf58qUMmfnj2Q8QjyWZYhXHXfQX1BZoZBbD8OhItKTLuwQ18ySFm0', '2016-05-28 09:06:56', '2016-06-08 06:14:28'),
(13, 'guest', 'guest@guest.com', '$2y$10$H914mee0DqiXO2r8jmSxAuDyaFqeRsdEJTM3mDftTeLiPlwafUOnS', 'mnblarxcycm4KwZBu1qaNJfssGH89HJMf8bG4VzkRZqGXWnWK74vm0aYXBNz', '2016-06-16 16:13:56', '2016-06-17 06:11:50'),
(14, 'ratan', 'ratan@gmail.com', '$2y$10$zAeiEPOMNnhY9tJRZHigvOkiwQzpTPIE1Gku775Fpkkza7yNprf8K', 'RiG6JVroR6zn3uYk0F0Dn108XUIsKm97Wm2ECFZ1TFWSCLJVaZbPtEgajw2T', '2016-06-17 06:12:52', '2016-06-17 06:14:17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `amount_received`
--
ALTER TABLE `amount_received`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `audit_reports`
--
ALTER TABLE `audit_reports`
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
-- Indexes for table `uc_uploads`
--
ALTER TABLE `uc_uploads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_extra_info`
--
ALTER TABLE `user_extra_info`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `audit_reports`
--
ALTER TABLE `audit_reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;
--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `uc_uploads`
--
ALTER TABLE `uc_uploads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
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
