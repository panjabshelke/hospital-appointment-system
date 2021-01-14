
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";
--
-- Database: `hospital-appiontment-system`
--

-- --------------------------------------------------------

--
-- Table structure for table `auth_assignment`
--

CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('sysadmin', '1', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `auth_item`
--

CREATE TABLE `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('/*', 2, NULL, NULL, NULL, 1585660538, 1585660538),
('/admin', 2, NULL, NULL, NULL, 1581918135, 1581918135),
('/admin/*', 2, NULL, NULL, NULL, 1581918163, 1581918163),
('/admin/assignment/*', 2, NULL, NULL, NULL, 1581918163, 1581918163),
('/admin/assignment/assign', 2, NULL, NULL, NULL, 1585660533, 1585660533),
('/admin/assignment/index', 2, NULL, NULL, NULL, 1585660533, 1585660533),
('/admin/assignment/revoke', 2, NULL, NULL, NULL, 1585660533, 1585660533),
('/admin/assignment/view', 2, NULL, NULL, NULL, 1585660533, 1585660533),
('/admin/default/*', 2, NULL, NULL, NULL, 1581918163, 1581918163),
('/admin/default/index', 2, NULL, NULL, NULL, 1585660533, 1585660533),
('/admin/menu/*', 2, NULL, NULL, NULL, 1581918163, 1581918163),
('/admin/menu/create', 2, NULL, NULL, NULL, 1585660533, 1585660533),
('/admin/menu/delete', 2, NULL, NULL, NULL, 1585660533, 1585660533),
('/admin/menu/index', 2, NULL, NULL, NULL, 1585660533, 1585660533),
('/admin/menu/update', 2, NULL, NULL, NULL, 1585660533, 1585660533),
('/admin/menu/view', 2, NULL, NULL, NULL, 1585660533, 1585660533),
('/admin/permission/*', 2, NULL, NULL, NULL, 1581918163, 1581918163),
('/admin/permission/assign', 2, NULL, NULL, NULL, 1585660534, 1585660534),
('/admin/permission/create', 2, NULL, NULL, NULL, 1585660534, 1585660534),
('/admin/permission/delete', 2, NULL, NULL, NULL, 1585660534, 1585660534),
('/admin/permission/index', 2, NULL, NULL, NULL, 1585660534, 1585660534),
('/admin/permission/remove', 2, NULL, NULL, NULL, 1585660534, 1585660534),
('/admin/permission/update', 2, NULL, NULL, NULL, 1585660534, 1585660534),
('/admin/permission/view', 2, NULL, NULL, NULL, 1585660534, 1585660534),
('/admin/role/*', 2, NULL, NULL, NULL, 1581918163, 1581918163),
('/admin/role/assign', 2, NULL, NULL, NULL, 1585660534, 1585660534),
('/admin/role/create', 2, NULL, NULL, NULL, 1585660534, 1585660534),
('/admin/role/delete', 2, NULL, NULL, NULL, 1585660534, 1585660534),
('/admin/role/index', 2, NULL, NULL, NULL, 1585660534, 1585660534),
('/admin/role/remove', 2, NULL, NULL, NULL, 1585660534, 1585660534),
('/admin/role/update', 2, NULL, NULL, NULL, 1585660534, 1585660534),
('/admin/role/view', 2, NULL, NULL, NULL, 1585660534, 1585660534),
('/admin/route/*', 2, NULL, NULL, NULL, 1581918163, 1581918163),
('/admin/route/assign', 2, NULL, NULL, NULL, 1585660534, 1585660534),
('/admin/route/create', 2, NULL, NULL, NULL, 1585660534, 1585660534),
('/admin/route/index', 2, NULL, NULL, NULL, 1585660534, 1585660534),
('/admin/route/refresh', 2, NULL, NULL, NULL, 1585660535, 1585660535),
('/admin/route/remove', 2, NULL, NULL, NULL, 1585660534, 1585660534),
('/admin/rule/*', 2, NULL, NULL, NULL, 1581918163, 1581918163),
('/admin/rule/create', 2, NULL, NULL, NULL, 1585660535, 1585660535),
('/admin/rule/delete', 2, NULL, NULL, NULL, 1585660535, 1585660535),
('/admin/rule/index', 2, NULL, NULL, NULL, 1585660535, 1585660535),
('/admin/rule/update', 2, NULL, NULL, NULL, 1585660535, 1585660535),
('/admin/rule/view', 2, NULL, NULL, NULL, 1585660535, 1585660535),
('/admin/user/*', 2, NULL, NULL, NULL, 1581918163, 1581918163),
('/admin/user/activate', 2, NULL, NULL, NULL, 1585660536, 1585660536),
('/admin/user/change-password', 2, NULL, NULL, NULL, 1585660535, 1585660535),
('/admin/user/create', 2, NULL, NULL, NULL, 1585660536, 1585660536),
('/admin/user/delete', 2, NULL, NULL, NULL, 1585660535, 1585660535),
('/admin/user/index', 2, NULL, NULL, NULL, 1585660535, 1585660535),
('/admin/user/login', 2, NULL, NULL, NULL, 1585660535, 1585660535),
('/admin/user/logout', 2, NULL, NULL, NULL, 1584596952, 1584596952),
('/admin/user/request-password-reset', 2, NULL, NULL, NULL, 1585660535, 1585660535),
('/admin/user/reset-password', 2, NULL, NULL, NULL, 1585660535, 1585660535),
('/admin/user/signup', 2, NULL, NULL, NULL, 1585660535, 1585660535),
('/admin/user/update', 2, NULL, NULL, NULL, 1585660536, 1585660536),
('/admin/user/update-my-profile', 2, NULL, NULL, NULL, 1585664222, 1585664222),
('/admin/user/view', 2, NULL, NULL, NULL, 1585660535, 1585660535),
('/admin/user/view-my-profile', 2, NULL, NULL, NULL, 1585664222, 1585664222),
('sysadmin', 1, 'System Administrator Role', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `auth_item_child`
--

CREATE TABLE `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_item_child`
--

INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
('sysadmin', '/*');

-- --------------------------------------------------------

--
-- Table structure for table `auth_rule`
--

CREATE TABLE `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1606733061),
('m130524_201442_init', 1606733138),
('m140506_102106_rbac_init', 1606733063),
('m170907_052038_rbac_add_index_on_auth_assignment_user_id', 1606733063),
('m180523_151638_rbac_updates_indexes_without_prefix', 1606733065),
('m190124_110200_add_verification_token_column_to_user_table', 1606733139),
('m200215_081912_create_category_master_table', 1606733240),
('m200422_081912_tbl_banner', 1606733241),
('m200422_081912_tbl_pages_detail', 1606733241),
('m200423_081912_tbl_teams', 1606733242),
('m200423_081912_tbl_testimonials', 1606733242);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_banner`
--

CREATE TABLE `tbl_banner` (
  `id` int(11) NOT NULL,
  `title` varchar(500) DEFAULT NULL,
  `image` text,
  `status` enum('active','inactive','deleted') DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category_master`
--

CREATE TABLE `tbl_category_master` (
  `id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT '0',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` enum('active','inactive','deleted') DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pages_detail`
--

CREATE TABLE `tbl_pages_detail` (
  `id` int(11) NOT NULL,
  `title` varchar(500) NOT NULL,
  `slug` text NOT NULL,
  `description` text NOT NULL,
  `page_image` text,
  `created_by` int(11) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) NOT NULL,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` enum('active','inactive','deleted') DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_teams`
--

CREATE TABLE `tbl_teams` (
  `id` int(11) NOT NULL,
  `name` varchar(500) DEFAULT NULL,
  `description` text NOT NULL,
  `image` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_testimonials`
--

CREATE TABLE `tbl_testimonials` (
  `id` int(11) NOT NULL,
  `name` varchar(500) DEFAULT NULL,
  `description` text NOT NULL,
  `image` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `verification_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`, `verification_token`) VALUES
(1, 'admin', 'rJ-zbMpr5Rku_3hbzUXVbL3u2mVzYmEs', '$2y$13$1/xvIpmRUVv0k6vCo9ZTj.XrgR4juiu2PLiyClqwL.YyTdtJWUxP6', NULL, 'admin@admin.com', 10, 1606733272, 1606733272, 'bxWxlRNSU3u4dehjAC0Dy3tJDavqbfY__1606733272');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD PRIMARY KEY (`item_name`,`user_id`),
  ADD KEY `idx-auth_assignment-user_id` (`user_id`);

--
-- Indexes for table `auth_item`
--
ALTER TABLE `auth_item`
  ADD PRIMARY KEY (`name`),
  ADD KEY `rule_name` (`rule_name`),
  ADD KEY `idx-auth_item-type` (`type`);

--
-- Indexes for table `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD PRIMARY KEY (`parent`,`child`),
  ADD KEY `child` (`child`);

--
-- Indexes for table `auth_rule`
--
ALTER TABLE `auth_rule`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `tbl_banner`
--
ALTER TABLE `tbl_banner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_category_master`
--
ALTER TABLE `tbl_category_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_pages_detail`
--
ALTER TABLE `tbl_pages_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_teams`
--
ALTER TABLE `tbl_teams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_testimonials`
--
ALTER TABLE `tbl_testimonials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_banner`
--
ALTER TABLE `tbl_banner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_category_master`
--
ALTER TABLE `tbl_category_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_pages_detail`
--
ALTER TABLE `tbl_pages_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_teams`
--
ALTER TABLE `tbl_teams`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_testimonials`
--
ALTER TABLE `tbl_testimonials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `auth_item`
--
ALTER TABLE `auth_item`
  ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
