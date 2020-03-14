-- Добавляем колонку user_name в files --
ALTER TABLE `files`
ADD COLUMN `user_name`  varchar(255) NOT NULL AFTER `user_id`;

-- ----------------------------
-- Records of files
-- ----------------------------
UPDATE `files` SET user_name = (SELECT name FROM users WHERE id = user_id);