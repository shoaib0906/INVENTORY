-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 10, 2015 at 06:35 PM
-- Server version: 5.6.17
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `ez5`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_log`
--

CREATE TABLE IF NOT EXISTS `activity_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `text` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ip_address` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_agent` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `applications`
--

CREATE TABLE IF NOT EXISTS `applications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `job_id` int(11) NOT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `contact_number` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `address` text COLLATE utf8_unicode_ci,
  `app_description` text COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('save_for_later','reject','select','unread') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'unread',
  `resume` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`),
  KEY `job_id` (`job_id`),
  KEY `username` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `assigned_awards`
--

CREATE TABLE IF NOT EXISTS `assigned_awards` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `award_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`,`award_id`),
  KEY `award_id` (`award_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `assigned_tasks`
--

CREATE TABLE IF NOT EXISTS `assigned_tasks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `task_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`,`task_id`),
  KEY `task_id` (`task_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `attachments`
--

CREATE TABLE IF NOT EXISTS `attachments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `attachment_title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `attachment_description` text COLLATE utf8_unicode_ci NOT NULL,
  `task_id` int(11) NOT NULL,
  `attachment_username` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `file` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`),
  KEY `attachment_username` (`attachment_username`),
  KEY `task_id` (`task_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `awards`
--

CREATE TABLE IF NOT EXISTS `awards` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned DEFAULT NULL,
  `award_type_id` int(11) NOT NULL,
  `gift` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cash` int(10) DEFAULT NULL,
  `month` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `year` year(4) NOT NULL,
  `award_description` text COLLATE utf8_unicode_ci NOT NULL,
  `award_date` date NOT NULL,
  `created_at` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`),
  KEY `award_type_id` (`award_type_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `award_types`
--

CREATE TABLE IF NOT EXISTS `award_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `award_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bank_accounts`
--

CREATE TABLE IF NOT EXISTS `bank_accounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `bank_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `account_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `account_number` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `ifsc_code` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `bank_branch` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `clock`
--

CREATE TABLE IF NOT EXISTS `clock` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `date` date NOT NULL,
  `clock_in` datetime NOT NULL,
  `clock_out` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `task_id` int(11) NOT NULL,
  `comment` text COLLATE utf8_unicode_ci NOT NULL,
  `comment_username` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`),
  KEY `task_id` (`task_id`),
  KEY `comment_username` (`comment_username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `custom_fields`
--

CREATE TABLE IF NOT EXISTS `custom_fields` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `form` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `field_name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `field_title` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `field_type` enum('text','number','email','url','textarea','select','radio','checkbox') COLLATE utf8_unicode_ci NOT NULL,
  `field_values` text COLLATE utf8_unicode_ci,
  `field_required` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `custom_field_values`
--

CREATE TABLE IF NOT EXISTS `custom_field_values` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `unique_id` int(11) DEFAULT NULL,
  `field_id` int(11) NOT NULL,
  `value` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`),
  KEY `field_id` (`field_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE IF NOT EXISTS `departments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `department_name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `department_description` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `designations`
--

CREATE TABLE IF NOT EXISTS `designations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `department_id` int(11) NOT NULL,
  `top_designation_id` int(11) DEFAULT NULL,
  `designation` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`),
  KEY `department_id` (`department_id`),
  KEY `top_designation_id` (`top_designation_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE IF NOT EXISTS `documents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `document_type_id` int(11) DEFAULT NULL,
  `expiry_date` date DEFAULT NULL,
  `document_title` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `document_description` text COLLATE utf8_unicode_ci NOT NULL,
  `document` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `document_type_id` (`document_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `document_types`
--

CREATE TABLE IF NOT EXISTS `document_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `document_type_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE IF NOT EXISTS `expenses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `expense_head_id` int(11) NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `amount` int(11) NOT NULL,
  `expense_date` date NOT NULL,
  `remarks` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`),
  KEY `expense_head_id` (`expense_head_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `expense_heads`
--

CREATE TABLE IF NOT EXISTS `expense_heads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `expense_head` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `holidays`
--

CREATE TABLE IF NOT EXISTS `holidays` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `holiday_description` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `date` (`date`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE IF NOT EXISTS `jobs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `job_title` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `designation_id` int(11) NOT NULL,
  `numbers` int(11) NOT NULL,
  `job_description` text COLLATE utf8_unicode_ci,
  `status` enum('open','closed') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'open',
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `designation_id` (`designation_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `leaves`
--

CREATE TABLE IF NOT EXISTS `leaves` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `leave_type_id` int(11) NOT NULL,
  `from_date` date NOT NULL,
  `to_date` date NOT NULL,
  `leave_description` text COLLATE utf8_unicode_ci NOT NULL,
  `leave_status` enum('pending','approved','rejected') COLLATE utf8_unicode_ci NOT NULL,
  `leave_comment` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`,`leave_type_id`),
  KEY `leaves_leave_type_id_foreign` (`leave_type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `leave_types`
--

CREATE TABLE IF NOT EXISTS `leave_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `leave_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `from_user_id` int(10) unsigned NOT NULL,
  `to_user_id` int(10) unsigned NOT NULL,
  `subject` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `read` int(11) NOT NULL,
  `delete_sender` int(11) NOT NULL DEFAULT '0',
  `delete_receiver` int(11) NOT NULL DEFAULT '0',
  `attachment` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`),
  KEY `from_user_id` (`from_user_id`,`to_user_id`),
  KEY `to_user_id` (`to_user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE IF NOT EXISTS `notes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `task_id` int(11) NOT NULL,
  `note_content` text COLLATE utf8_unicode_ci NOT NULL,
  `note_username` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`),
  KEY `unique_id` (`task_id`),
  KEY `username` (`note_username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notice`
--

CREATE TABLE IF NOT EXISTS `notice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `from_date` date NOT NULL,
  `to_date` date NOT NULL,
  `username` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`),
  KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notice_designation`
--

CREATE TABLE IF NOT EXISTS `notice_designation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `notice_id` int(11) NOT NULL,
  `designation_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `notice_id` (`notice_id`),
  KEY `designation_id` (`designation_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payroll`
--

CREATE TABLE IF NOT EXISTS `payroll` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `payroll_slip_id` int(11) NOT NULL,
  `salary_type_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`salary_type_id`),
  KEY `salary_type_id` (`salary_type_id`),
  KEY `payroll_slip_id` (`payroll_slip_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payroll_slip`
--

CREATE TABLE IF NOT EXISTS `payroll_slip` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `month` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `year` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  `date_of_contribution` date DEFAULT NULL,
  `employee_contribution` decimal(10,2) NOT NULL DEFAULT '0.00',
  `employer_contribution` decimal(10,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

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

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE IF NOT EXISTS `profile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `employee_code` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `date_of_birth` date DEFAULT NULL,
  `father_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `mother_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `date_of_joining` date DEFAULT NULL,
  `date_of_leaving` date DEFAULT NULL,
  `date_of_retirement` date DEFAULT NULL,
  `contact_number` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `alternate_contact_number` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `alternate_email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `present_address` text COLLATE utf8_unicode_ci NOT NULL,
  `permanent_address` text COLLATE utf8_unicode_ci NOT NULL,
  `photo` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `facebook_link` text COLLATE utf8_unicode_ci NOT NULL,
  `twitter_link` text COLLATE utf8_unicode_ci NOT NULL,
  `blogger_link` text COLLATE utf8_unicode_ci NOT NULL,
  `linkedin_link` text COLLATE utf8_unicode_ci NOT NULL,
  `googleplus_link` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_unique` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE IF NOT EXISTS `role_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `assigned_roles_user_id_foreign` (`user_id`),
  KEY `assigned_roles_role_id_foreign` (`role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `salary`
--

CREATE TABLE IF NOT EXISTS `salary` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `salary_type_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `salary_type_id` (`salary_type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `salary_types`
--

CREATE TABLE IF NOT EXISTS `salary_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `salary_head` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `salary_type` enum('earning','deduction') COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `salary_head` (`salary_head`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE IF NOT EXISTS `tasks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `task_title` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `task_description` text COLLATE utf8_unicode_ci NOT NULL,
  `start_date` date NOT NULL,
  `due_date` date NOT NULL,
  `hours` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `task_progress` int(11) NOT NULL,
  `task_username` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`),
  KEY `task_username` (`task_username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE IF NOT EXISTS `tickets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `ticket_subject` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `ticket_description` text COLLATE utf8_unicode_ci,
  `ticket_priority` enum('low','medium','high','critical') COLLATE utf8_unicode_ci NOT NULL,
  `ticket_status` enum('open','closed') COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ticket_attachments`
--

CREATE TABLE IF NOT EXISTS `ticket_attachments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `attachment_title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `attachment_description` text COLLATE utf8_unicode_ci NOT NULL,
  `ticket_id` int(11) NOT NULL,
  `attachment_username` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `file` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`),
  KEY `attachment_username` (`attachment_username`),
  KEY `ticket_id` (`ticket_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ticket_comments`
--

CREATE TABLE IF NOT EXISTS `ticket_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ticket_id` int(11) NOT NULL,
  `comment` text COLLATE utf8_unicode_ci NOT NULL,
  `comment_username` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ticket_id` (`ticket_id`),
  KEY `comment_username` (`comment_username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ticket_notes`
--

CREATE TABLE IF NOT EXISTS `ticket_notes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ticket_id` int(11) NOT NULL,
  `note_content` text COLLATE utf8_unicode_ci NOT NULL,
  `note_username` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ticket_id` (`ticket_id`),
  KEY `username` (`note_username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `todos`
--

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

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `designation_id` int(11) NOT NULL,
  `username` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `last_login` timestamp NULL DEFAULT NULL,
  `last_login_ip` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_login_now` timestamp NULL DEFAULT NULL,
  `last_login_ip_now` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `username` (`username`),
  KEY `designation_id` (`designation_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `applications`
--
ALTER TABLE `applications`
  ADD CONSTRAINT `applications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `job_applications_job_id_foreign` FOREIGN KEY (`job_id`) REFERENCES `jobs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `assigned_awards`
--
ALTER TABLE `assigned_awards`
  ADD CONSTRAINT `assigned_awards_award_id_foreign` FOREIGN KEY (`award_id`) REFERENCES `awards` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `assigned_awards_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `assigned_tasks`
--
ALTER TABLE `assigned_tasks`
  ADD CONSTRAINT `assigned_tasks_task_id_foreign` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `assigned_tasks_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `attachments`
--
ALTER TABLE `attachments`
  ADD CONSTRAINT `attachments_attachment_username_foreign` FOREIGN KEY (`attachment_username`) REFERENCES `users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `attachments_task_id_foreign` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `awards`
--
ALTER TABLE `awards`
  ADD CONSTRAINT `awards_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `award_types_award_type_id_foreign` FOREIGN KEY (`award_type_id`) REFERENCES `award_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `bank_accounts`
--
ALTER TABLE `bank_accounts`
  ADD CONSTRAINT `bank_accounts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `clock`
--
ALTER TABLE `clock`
  ADD CONSTRAINT `clock_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comment_comment_username_foreign` FOREIGN KEY (`comment_username`) REFERENCES `users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comment_task_id_foreign` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `custom_field_values`
--
ALTER TABLE `custom_field_values`
  ADD CONSTRAINT `custom_field_values_field_id_foreign` FOREIGN KEY (`field_id`) REFERENCES `custom_fields` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `designations`
--
ALTER TABLE `designations`
  ADD CONSTRAINT `designations_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `designations_top_designation_id_foreign` FOREIGN KEY (`top_designation_id`) REFERENCES `designations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `documents`
--
ALTER TABLE `documents`
  ADD CONSTRAINT `documents_document_type_id_foreign` FOREIGN KEY (`document_type_id`) REFERENCES `document_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `documents_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `expenses`
--
ALTER TABLE `expenses`
  ADD CONSTRAINT `expenses_expense_head_id_foreign` FOREIGN KEY (`expense_head_id`) REFERENCES `expense_heads` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `expenses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `jobs`
--
ALTER TABLE `jobs`
  ADD CONSTRAINT `jobs_designation_id_foreign` FOREIGN KEY (`designation_id`) REFERENCES `designations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `jobs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `leaves`
--
ALTER TABLE `leaves`
  ADD CONSTRAINT `leaves_leave_type_id_foreign` FOREIGN KEY (`leave_type_id`) REFERENCES `leave_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `leaves_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_from_user_id_foreign` FOREIGN KEY (`from_user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `messages_to_user_id_foreign` FOREIGN KEY (`to_user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `notes`
--
ALTER TABLE `notes`
  ADD CONSTRAINT `notes_note_username_foreign` FOREIGN KEY (`note_username`) REFERENCES `users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `notes_task_id_foreign` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `notice`
--
ALTER TABLE `notice`
  ADD CONSTRAINT `notice_username_foreign` FOREIGN KEY (`username`) REFERENCES `users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `notice_designation`
--
ALTER TABLE `notice_designation`
  ADD CONSTRAINT `notice_designation_designation_id_foreign` FOREIGN KEY (`designation_id`) REFERENCES `designations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `notice_designation_notice_id_foreign` FOREIGN KEY (`notice_id`) REFERENCES `notice` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payroll`
--
ALTER TABLE `payroll`
  ADD CONSTRAINT `payroll_payroll_slip_id_foreign` FOREIGN KEY (`payroll_slip_id`) REFERENCES `payroll_slip` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `payroll_salary_type_id_foreign` FOREIGN KEY (`salary_type_id`) REFERENCES `salary_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payroll_slip`
--
ALTER TABLE `payroll_slip`
  ADD CONSTRAINT `payroll_slip_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`),
  ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);

--
-- Constraints for table `profile`
--
ALTER TABLE `profile`
  ADD CONSTRAINT `profile_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `assigned_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`),
  ADD CONSTRAINT `assigned_roles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `salary`
--
ALTER TABLE `salary`
  ADD CONSTRAINT `salary_salary_type_id_foreign` FOREIGN KEY (`salary_type_id`) REFERENCES `salary_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `salary_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_task_username_foreign` FOREIGN KEY (`task_username`) REFERENCES `users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `tickets_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ticket_attachments`
--
ALTER TABLE `ticket_attachments`
  ADD CONSTRAINT `ticket_attachments_attachment_username_foreign` FOREIGN KEY (`attachment_username`) REFERENCES `users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ticket_attachments_ticket_id_foreign` FOREIGN KEY (`ticket_id`) REFERENCES `tickets` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ticket_comments`
--
ALTER TABLE `ticket_comments`
  ADD CONSTRAINT `ticket_comments_comment_username_foreign` FOREIGN KEY (`comment_username`) REFERENCES `users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ticket_comments_ticket_id_foreign` FOREIGN KEY (`ticket_id`) REFERENCES `tickets` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ticket_notes`
--
ALTER TABLE `ticket_notes`
  ADD CONSTRAINT `ticket_notes_note_username_foreign` FOREIGN KEY (`note_username`) REFERENCES `users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ticket_notes_ticket_id_foreign` FOREIGN KEY (`ticket_id`) REFERENCES `tickets` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `todos`
--
ALTER TABLE `todos`
  ADD CONSTRAINT `todos_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_designation_id_foreign` FOREIGN KEY (`designation_id`) REFERENCES `designations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`category`, `name`, `display_name`, `created_at`, `updated_at`) VALUES
('department', 'manage_department', 'Manage Department', '2015-08-27 22:08:03', '2015-08-27 22:08:03'),
('department', 'create_department', 'Create Department', '2015-08-27 22:08:51', '2015-08-27 22:08:51'),
('department', 'edit_department', 'Edit Department', '2015-08-27 22:08:57', '2015-08-27 22:08:57'),
('department', 'delete_department', 'Delete Department', '2015-08-28 07:26:54', '2015-08-28 07:26:54'),
('designation', 'manage_designation', 'Manage Designation', '2015-08-28 07:19:51', NULL),
('designation', 'create_designation', 'Create Designation', '2015-08-28 07:19:51', NULL),
('designation', 'edit_designation', 'Edit Designation', '2015-08-28 07:21:20', NULL),
('designation', 'delete_designation', 'Delete Designation', '2015-08-28 07:21:20', NULL),
('employee', 'manage_employee', 'Manage Employee', '2015-08-28 08:08:41', NULL),
('employee', 'create_employee', 'Create Employee', '2015-08-28 08:08:41', NULL),
('employee', 'edit_employee', 'Edit Employee', '2015-08-28 08:09:00', NULL),
('employee', 'delete_employee', 'Delete Employee', '2015-08-28 08:09:00', NULL),
('employee', 'profile_update_employee', 'Profile Update Employee', '2015-08-28 08:11:16', NULL),
('employee', 'view_employee', 'View Employee', '2015-08-28 08:11:16', NULL),
('job', 'manage_job', 'Manage Job', '2015-08-28 08:12:18', NULL),
('job', 'create_job', 'Create Job', '2015-08-28 08:12:18', NULL),
('job', 'edit_job', 'Edit Job', '2015-08-28 08:12:36', NULL),
('job', 'delete_job', 'Delete Job', '2015-08-28 08:12:36', NULL),
('job', 'view_job', 'View Job', '2015-08-28 08:16:14', NULL),
('job', 'view_job_application', 'View Job Application', '2015-08-28 08:16:14', NULL),
('job', 'edit_job_application', 'Edit Job Application', '2015-08-28 08:16:41', NULL),
('job', 'apply_job', 'Apply Job', '2015-08-28 08:16:41', NULL),
('job', 'delete_job_application', 'Delete Job Application', '2015-08-28 08:17:21', NULL),
('expense', 'manage_expense', 'Manage Expense', '2015-08-28 08:26:49', NULL),
('expense', 'create_expense', 'Create Expense', '2015-08-28 08:26:49', NULL),
('expense', 'edit_expense', 'Edit Expense', '2015-08-28 08:27:05', NULL),
('expense', 'delete_expense', 'Delete Expense', '2015-08-28 08:27:05', NULL),
('holiday', 'manage_holiday', 'Manage Holiday', '2015-08-28 08:42:59', NULL),
('holiday', 'create_holiday', 'Create Holiday', '2015-08-28 08:42:59', NULL),
('holiday', 'edit_holiday', 'Edit Holiday', '2015-08-28 08:43:15', NULL),
('holiday', 'delete_holiday', 'Delete Holiday', '2015-08-28 08:43:15', NULL),
('attendance', 'update_attendance', 'Update Attendance', '2015-08-28 09:10:18', NULL),
('attendance', 'daily_attendance', 'Daily Attendance', '2015-08-28 09:10:18', NULL),
('attendance', 'upload_attendance', 'Upload Attendance', '2015-08-28 09:14:07', NULL),
('leave', 'manage_leave', 'Manage leave', '2015-08-28 09:21:12', NULL),
('leave', 'view_leave', 'View Leave', '2015-08-28 09:21:12', NULL),
('leave', 'create_leave', 'Create Leave', '2015-08-28 09:21:45', NULL),
('leave', 'edit_leave', 'Edit Leave', '2015-08-28 09:21:45', NULL),
('leave', 'edit_leave_status', 'Edit Leave Status', '2015-08-28 09:22:08', NULL),
('leave', 'delete_leave', 'Delete Leave', '2015-08-28 09:22:08', NULL),
('payroll', 'manage_payroll', 'Manage Payroll', '2015-08-28 09:24:03', NULL),
('payroll', 'create_payroll', 'Create Payroll', '2015-08-28 09:24:03', NULL),
('payroll', 'generate_payroll', 'Generate Payroll', '2015-08-28 09:24:13', NULL),
('ticket', 'manage_ticket', 'Manage Ticket', '2015-08-28 09:26:18', NULL),
('ticket', 'view_ticket', 'View Ticket', '2015-08-28 09:26:18', NULL),
('ticket', 'update_status_ticket', 'Update Status Ticket', '2015-08-28 09:26:39', NULL),
('ticket', 'create_ticket', 'Create Ticket', '2015-08-28 09:26:39', NULL),
('ticket', 'edit_ticket', 'Edit Ticket', '2015-08-28 09:26:57', NULL),
('ticket', 'delete_ticket', 'Delete Ticket', '2015-08-28 09:26:57', NULL),
('task', 'manage_task', 'Manage Task', '2015-08-28 09:29:27', NULL),
('task', 'update_progress_task', 'Update Progress Task', '2015-08-28 09:29:27', NULL),
('task', 'view_task', 'View Task', '2015-08-28 09:29:45', NULL),
('task', 'create_task', 'Create Task', '2015-08-28 09:29:45', NULL),
('task', 'edit_task', 'Edit Task', '2015-08-28 09:29:59', NULL),
('task', 'delete_task', 'Delete Task', '2015-08-28 09:29:59', NULL),
('message', 'manage_message', 'Manage Message', '2015-08-28 09:30:41', NULL),
('sms', 'manage_sms', 'Manage SMS', '2015-08-28 09:33:18', NULL),
('template', 'manage_template', 'Manage Template', '2015-08-28 09:33:18', NULL),
('', 'send_template', 'Send Template', '2015-08-28 09:35:05', NULL),
('language', 'manage_language', 'Manage Language', '2015-08-28 09:36:52', NULL),
('language', 'set_language', 'Set Language', '2015-08-28 09:36:52', NULL),
('award', 'manage_award', 'Manage Award', '2015-09-12 15:31:06', NULL),
('award', 'create_award', 'Create Award', '2015-09-12 15:31:06', NULL),
('award', 'edit_award', 'Edit Award', '2015-09-12 15:31:27', NULL),
('award', 'delete_award', 'Delete Award', '2015-09-12 15:31:27', NULL),
('notice', 'manage_notice', 'Manage Notice', '2015-09-12 17:41:49', NULL),
('notice', 'create_notice', 'Create Notice', '2015-09-12 17:41:49', NULL),
('notice', 'edit_notice', 'Edit Notice', '2015-09-12 17:42:06', NULL),
('notice', 'delete_notice', 'Delete Notice', '2015-09-12 17:42:06', NULL),
('custom_field', 'manage_custom_field', 'Manage Custom Field', '2015-09-26 04:09:04', NULL),
('sms_template', 'manage_sms_template', 'Manage SMS Template', '2015-09-29 07:02:54', NULL),
('attendance', 'manage_everyone_attendance', 'Manage Everyone''s Attendance', '2015-10-11 12:14:18', NULL),
('leave', 'manage_everyone_leave', 'Manage Everyone''s Leave', '2015-10-11 12:16:35', NULL),
('payroll', 'manage_everyone_payroll', 'Manage Everyone''s Payroll', '2015-10-11 12:24:20', NULL),
('ticket', 'manage_everyone_ticket', 'Manage Everyone''s Ticket', '2015-10-11 12:29:12', NULL),
('task', 'manage_everyone_task', 'Manage Everyone''s Task', '2015-10-11 12:36:10', NULL),
('employee', 'reset_employee_password', 'Reset Employee Password', '2015-10-11 14:03:23', NULL),
('employee', 'manage_all_employee', 'Manage All Employee', '2015-10-25 07:04:51', NULL),
('employee', 'manage_subordinate', 'Manage Subordinate', '2015-10-25 07:04:51', NULL),
('attendance', 'manage_subordinate_attendance', 'Manage Subordinate Attendance', '2015-10-25 08:55:16', NULL),
('payroll', 'manage_subordinate_payroll', 'Manage Subordinate Payroll', '2015-10-25 09:40:39', NULL),
('leave', 'manage_subordinate_leave', 'Manage Subordinate Leave', '2015-10-25 10:55:55', NULL),
('ticket', 'manage_subordinate_ticket', 'Manage Subordinate Ticket', '2015-10-25 11:51:19', NULL),
('notice', 'manage_subordinate_notice', 'Manage Notice to Subordinate', '2015-10-25 12:19:08', NULL),
('notice', 'manage_all_notice', 'Manage All Notice', '2015-10-25 12:22:41', NULL),
('task', 'manage_subordinate_task', 'Manage Subordinate Task', '2015-10-25 12:54:58', NULL),
('job', 'manage_subordinate_job', 'Manage Subordinate Job', '2015-11-18 17:15:59', NULL),
('job', 'manage_all_job', 'Manage All Job', '2015-11-25 06:07:55', NULL),
('award', 'manage_all_award', 'Manage All Award', '2015-11-25 08:16:58', NULL),
('award', 'manage_subordinate_award', 'Manage Subordinate Award', '2015-11-25 08:16:58', NULL);
