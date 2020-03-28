CREATE TABLE IF NOT EXISTS `document_types` ( `id` int(11) NOT NULL AUTO_INCREMENT, `document_type_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL, `created_at` timestamp NOT NULL, `updated_at` timestamp NOT NULL, PRIMARY KEY (`id`) ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

ALTER TABLE `documents` DROP `document_type`;

ALTER TABLE `documents` ADD `document_type_id` INT NULL DEFAULT NULL AFTER `user_id`, ADD `expiry_date` DATE NULL DEFAULT NULL AFTER `document_type_id`, ADD INDEX (`document_type_id`) ;

ALTER TABLE `notice` ADD INDEX(`username`);

ALTER TABLE `notice` ADD CONSTRAINT `notice_username_foreign` FOREIGN KEY (`username`) REFERENCES `users`(`username`) ON DELETE CASCADE ON UPDATE CASCADE;

INSERT INTO `permissions` (`category`, `name`, `display_name`) VALUES
('employee', 'manage_all_employee', 'Manage All Employee'),
('employee', 'manage_subordinate', 'Manage Subordinate'),
('attendance', 'manage_subordinate_attendance', 'Manage Subordinate Attendance'),
('payroll', 'manage_subordinate_payroll', 'Manage Subordinate Payroll'),
('leave', 'manage_subordinate_leave', 'Manage Subordinate Leave'),
('ticket', 'manage_subordinate_ticket', 'Manage Subordinate Ticket'),
('notice', 'manage_subordinate_notice', 'Manage Notice to Subordinate'),
('notice', 'manage_all_notice', 'Manage All Notice'),
('task', 'manage_subordinate_task', 'Manage Subordinate Task');

UPDATE permissions set name = 'manage_everyone_attendance' where name = 'check_everyone_attendance';
UPDATE permissions set name = 'manage_everyone_leave' where name = 'check_everyone_leave';
UPDATE permissions set name = 'manage_everyone_payroll' where name = 'check_everyone_payroll';
UPDATE permissions set name = 'manage_everyone_ticket' where name = 'check_everyone_ticket';
UPDATE permissions set name = 'manage_everyone_task' where name = 'check_everyone_task';

ALTER TABLE  `designations` ADD  `top_designation_id` INT NULL DEFAULT NULL AFTER  `department_id` ,
ADD INDEX (  `top_designation_id` ) ;

ALTER TABLE `designations`
  ADD CONSTRAINT `designations_top_designation_id_foreign` FOREIGN KEY (`top_designation_id`) REFERENCES `designations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

