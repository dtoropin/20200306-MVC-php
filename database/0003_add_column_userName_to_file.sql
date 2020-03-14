-- Добавляем колонку user_name в files --
ALTER TABLE `files`
ADD COLUMN `user_name`  varchar(255) NOT NULL AFTER `user_id`;
