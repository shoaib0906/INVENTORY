
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

--
-- Constraints for table `custom_field_values`
--
ALTER TABLE `custom_field_values`
  ADD CONSTRAINT `custom_field_values_field_id_foreign` FOREIGN KEY (`field_id`) REFERENCES `custom_fields` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE  `messages` ADD  `delete_sender` INT NOT NULL DEFAULT  '0' AFTER  `read` ,
ADD  `delete_receiver` INT NOT NULL DEFAULT  '0' AFTER  `delete_sender` ;

ALTER TABLE  `payroll_slip` ADD  `date_of_contribution` DATE NULL DEFAULT NULL AFTER  `year` ,
ADD  `employee_contribution` DECIMAL( 10, 2 ) NOT NULL DEFAULT  '0' AFTER  `date_of_contribution` ,
ADD  `employer_contribution` DECIMAL( 10, 2 ) NOT NULL DEFAULT  '0' AFTER  `employee_contribution` ;


INSERT INTO `permissions` (`id`, `name`, `display_name`, `created_at`, `updated_at`) VALUES
(70, 'manage_custom_field', 'Manage Custom Field', '2015-09-26 04:09:04', NULL),
(71, 'manage_sms_template', 'Manage SMS Template', '2015-09-29 07:02:54', NULL);