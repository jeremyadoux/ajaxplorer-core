ALTER TABLE `ajxp_feed` ADD COLUMN `index_path` MEDIUMTEXT NULL;

ALTER TABLE `ajxp_simple_store` ADD COLUMN `insertion_date` DATETIME DEFAULT CURRENT_TIMESTAMP;