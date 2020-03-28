ALTER TABLE `clock` ADD CONSTRAINT `clock_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `ez5`.`users`(`id`) ON DELETE CASCADE ON UPDATE CASCADE;
