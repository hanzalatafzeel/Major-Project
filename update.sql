ALTER TABLE `item` DROP `category`;
ALTER TABLE `item` ADD `category` TINYTEXT NOT NULL AFTER `image`;