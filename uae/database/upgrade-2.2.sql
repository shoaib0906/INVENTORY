
CREATE TABLE IF NOT EXISTS `todos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `visibility` enum('public','private') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'private',
  `todo_title` text COLLATE utf8_unicode_ci NOT NULL,
  `todo_description` text COLLATE utf8_unicode_ci,
  `date` date NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `todos`
--
ALTER TABLE `todos`
  ADD CONSTRAINT `todos_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

DROP TABLE `permission_role` ;
DROP TABLE `permissions` ;


--
-- Table structure for table `permissions`
--

CREATE TABLE IF NOT EXISTS `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_unique` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE IF NOT EXISTS `permission_role` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `permission_role_permission_id_foreign` (`permission_id`),
  KEY `permission_role_role_id_foreign` (`role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`),
  ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);
  
--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `category`, `name`, `display_name`, `created_at`, `updated_at`) VALUES
(1, 'department', 'manage_department', 'Manage Department', '2015-08-27 22:08:03', '2015-08-27 22:08:03'),
(2, 'department', 'create_department', 'Create Department', '2015-08-27 22:08:51', '2015-08-27 22:08:51'),
(3, 'department', 'edit_department', 'Edit Department', '2015-08-27 22:08:57', '2015-08-27 22:08:57'),
(4, 'department', 'delete_department', 'Delete Department', '2015-08-28 07:26:54', '2015-08-28 07:26:54'),
(5, 'designation', 'manage_designation', 'Manage Designation', '2015-08-28 07:19:51', NULL),
(6, 'designation', 'create_designation', 'Create Designation', '2015-08-28 07:19:51', NULL),
(7, 'designation', 'edit_designation', 'Edit Designation', '2015-08-28 07:21:20', NULL),
(8, 'designation', 'delete_designation', 'Delete Designation', '2015-08-28 07:21:20', NULL),
(9, 'employee', 'manage_employee', 'Manage Employee', '2015-08-28 08:08:41', NULL),
(10, 'employee', 'create_employee', 'Create Employee', '2015-08-28 08:08:41', NULL),
(11, 'employee', 'edit_employee', 'Edit Employee', '2015-08-28 08:09:00', NULL),
(12, 'employee', 'delete_employee', 'Delete Employee', '2015-08-28 08:09:00', NULL),
(13, 'employee', 'profile_update_employee', 'Profile Update Employee', '2015-08-28 08:11:16', NULL),
(14, 'employee', 'view_employee', 'View Employee', '2015-08-28 08:11:16', NULL),
(15, 'job', 'manage_job', 'Manage Job', '2015-08-28 08:12:18', NULL),
(16, 'job', 'create_job', 'Create Job', '2015-08-28 08:12:18', NULL),
(17, 'job', 'edit_job', 'Edit Job', '2015-08-28 08:12:36', NULL),
(18, 'job', 'delete_job', 'Delete Job', '2015-08-28 08:12:36', NULL),
(19, 'job', 'view_job', 'View Job', '2015-08-28 08:16:14', NULL),
(20, 'job', 'view_job_application', 'View Job Application', '2015-08-28 08:16:14', NULL),
(21, 'job', 'edit_job_application', 'Edit Job Application', '2015-08-28 08:16:41', NULL),
(22, 'job', 'apply_job', 'Apply Job', '2015-08-28 08:16:41', NULL),
(23, 'job', 'delete_job_application', 'Delete Job Application', '2015-08-28 08:17:21', NULL),
(24, 'expense', 'manage_expense', 'Manage Expense', '2015-08-28 08:26:49', NULL),
(25, 'expense', 'create_expense', 'Create Expense', '2015-08-28 08:26:49', NULL),
(26, 'expense', 'edit_expense', 'Edit Expense', '2015-08-28 08:27:05', NULL),
(27, 'expense', 'delete_expense', 'Delete Expense', '2015-08-28 08:27:05', NULL),
(28, 'holiday', 'manage_holiday', 'Manage Holiday', '2015-08-28 08:42:59', NULL),
(29, 'holiday', 'create_holiday', 'Create Holiday', '2015-08-28 08:42:59', NULL),
(30, 'holiday', 'edit_holiday', 'Edit Holiday', '2015-08-28 08:43:15', NULL),
(31, 'holiday', 'delete_holiday', 'Delete Holiday', '2015-08-28 08:43:15', NULL),
(32, 'attendance', 'update_attendance', 'Update Attendance', '2015-08-28 09:10:18', NULL),
(33, 'attendance', 'daily_attendance', 'Daily Attendance', '2015-08-28 09:10:18', NULL),
(34, 'attendance', 'upload_attendance', 'Upload Attendance', '2015-08-28 09:14:07', NULL),
(35, 'leave', 'manage_leave', 'Manage leave', '2015-08-28 09:21:12', NULL),
(36, 'leave', 'view_leave', 'View Leave', '2015-08-28 09:21:12', NULL),
(37, 'leave', 'create_leave', 'Create Leave', '2015-08-28 09:21:45', NULL),
(38, 'leave', 'edit_leave', 'Edit Leave', '2015-08-28 09:21:45', NULL),
(39, 'leave', 'edit_leave_status', 'Edit Leave Status', '2015-08-28 09:22:08', NULL),
(40, 'leave', 'delete_leave', 'Delete Leave', '2015-08-28 09:22:08', NULL),
(41, 'payroll', 'manage_payroll', 'Manage Payroll', '2015-08-28 09:24:03', NULL),
(42, 'payroll', 'create_payroll', 'Create Payroll', '2015-08-28 09:24:03', NULL),
(43, 'payroll', 'generate_payroll', 'Generate Payroll', '2015-08-28 09:24:13', NULL),
(44, 'ticket', 'manage_ticket', 'Manage Ticket', '2015-08-28 09:26:18', NULL),
(45, 'ticket', 'view_ticket', 'View Ticket', '2015-08-28 09:26:18', NULL),
(46, 'ticket', 'update_status_ticket', 'Update Status Ticket', '2015-08-28 09:26:39', NULL),
(47, 'ticket', 'create_ticket', 'Create Ticket', '2015-08-28 09:26:39', NULL),
(48, 'ticket', 'edit_ticket', 'Edit Ticket', '2015-08-28 09:26:57', NULL),
(49, 'ticket', 'delete_ticket', 'Delete Ticket', '2015-08-28 09:26:57', NULL),
(50, 'task', 'manage_task', 'Manage Task', '2015-08-28 09:29:27', NULL),
(51, 'task', 'update_progress_task', 'Update Progress Task', '2015-08-28 09:29:27', NULL),
(52, 'task', 'view_task', 'View Task', '2015-08-28 09:29:45', NULL),
(53, 'task', 'create_task', 'Create Task', '2015-08-28 09:29:45', NULL),
(54, 'task', 'edit_task', 'Edit Task', '2015-08-28 09:29:59', NULL),
(55, 'task', 'delete_task', 'Delete Task', '2015-08-28 09:29:59', NULL),
(56, 'message', 'manage_message', 'Manage Message', '2015-08-28 09:30:41', NULL),
(57, 'sms', 'manage_sms', 'Manage SMS', '2015-08-28 09:33:18', NULL),
(58, 'template', 'manage_template', 'Manage Template', '2015-08-28 09:33:18', NULL),
(59, '', 'send_template', 'Send Template', '2015-08-28 09:35:05', NULL),
(60, 'language', 'manage_language', 'Manage Language', '2015-08-28 09:36:52', NULL),
(61, 'language', 'set_language', 'Set Language', '2015-08-28 09:36:52', NULL),
(62, 'award', 'manage_award', 'Manage Award', '2015-09-12 15:31:06', NULL),
(63, 'award', 'create_award', 'Create Award', '2015-09-12 15:31:06', NULL),
(64, 'award', 'edit_award', 'Edit Award', '2015-09-12 15:31:27', NULL),
(65, 'award', 'delete_award', 'Delete Award', '2015-09-12 15:31:27', NULL),
(66, 'notice', 'manage_notice', 'Manage Notice', '2015-09-12 17:41:49', NULL),
(67, 'notice', 'create_notice', 'Create Notice', '2015-09-12 17:41:49', NULL),
(68, 'notice', 'edit_notice', 'Edit Notice', '2015-09-12 17:42:06', NULL),
(69, 'notice', 'delete_notice', 'Delete Notice', '2015-09-12 17:42:06', NULL),
(70, 'custom_field', 'manage_custom_field', 'Manage Custom Field', '2015-09-26 04:09:04', NULL),
(71, 'sms_template', 'manage_sms_template', 'Manage SMS Template', '2015-09-29 07:02:54', NULL),
(72, 'attendance', 'check_everyone_attendance', 'Check Everyone''s Attendance', '2015-10-11 12:14:18', NULL),
(73, 'leave', 'check_everyone_leave', 'Check Everyone''s Leave', '2015-10-11 12:16:35', NULL),
(74, 'payroll', 'check_everyone_payroll', 'Check Everyone''s Payroll', '2015-10-11 12:24:20', NULL),
(75, 'ticket', 'check_everyone_ticket', 'Check Everyone''s Ticket', '2015-10-11 12:29:12', NULL),
(76, 'task', 'check_everyone_task', 'Check Everyone''s Task', '2015-10-11 12:36:10', NULL),
(77, 'employee', 'reset_employee_password', 'Reset Employee Password', '2015-10-11 14:03:23', NULL);