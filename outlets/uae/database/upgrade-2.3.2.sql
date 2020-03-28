ALTER TABLE `awards` ADD `user_id` INT UNSIGNED NULL DEFAULT NULL AFTER `id`, ADD INDEX (`user_id`) ;

ALTER TABLE `awards` ADD CONSTRAINT `awards_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `jobs` ADD `user_id` INT UNSIGNED NULL DEFAULT NULL AFTER `id`, ADD INDEX (`user_id`) ;

ALTER TABLE `jobs` ADD CONSTRAINT `jobs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE ON UPDATE CASCADE;

INSERT INTO `permissions` (`category`, `name`, `display_name`, `created_at`, `updated_at`) VALUES
('job', 'manage_subordinate_job', 'Manage Subordinate Job', '2015-11-18 17:15:59', NULL),
('job', 'manage_all_job', 'Manage All Job', '2015-11-25 06:07:55', NULL),
('award', 'manage_all_award', 'Manage All Award', '2015-11-25 08:16:58', NULL),
('award', 'manage_subordinate_award', 'Manage Subordinate Award', '2015-11-25 08:16:58', NULL);