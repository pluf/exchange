
ALTER TABLE `exchange_offers` DROP INDEX `trade_id_foreignkey_idx`;
ALTER TABLE `exchange_offers` CHANGE `trade_id` `advertisement_id` mediumint(9) unsigned NOT NULL DEFAULT 0;
CREATE INDEX `advertisement_id_foreignkey_idx` ON `exchange_offers`(`advertisement_id`);


RENAME TABLE `exchange_posts` TO `exchange_comments`;
ALTER TABLE `exchange_comments` CHANGE `sender_id` `author_id` mediumint(9) unsigned NOT NULL DEFAULT 0;
ALTER TABLE `exchange_comments`
  ADD COLUMN `offer_id` mediumint(9) unsigned NOT NULL DEFAULT 0 AFTER `author_id`,
  ADD COLUMN `parent_id` mediumint(9) unsigned DEFAULT 0 AFTER `author_id`,
  ADD COLUMN `file_size` int(11) NOT NULL DEFAULT 0 AFTER `author_id`,
  ADD COLUMN `file_name` varchar(250) NOT NULL DEFAULT 'unknown' AFTER `author_id`,
  ADD COLUMN `file_path` varchar(250) NOT NULL DEFAULT '' AFTER `author_id`,
  ADD COLUMN `media_type` varchar(64) NOT NULL DEFAULT 'application/octet-stream' AFTER `author_id`,
  ADD COLUMN `mime_type` varchar(64) NOT NULL DEFAULT 'application/octet-stream' AFTER `author_id`;
ALTER TABLE `exchange_comments`
  DROP COLUMN `receiver_id`,
  DROP COLUMN `trade_id`;
ALTER TABLE `exchange_comments` DROP INDEX `sender_id_foreignkey_idx`;
CREATE INDEX `parent_id_foreignkey_idx` ON `exchange_comments`(`parent_id`);
CREATE INDEX `author_id_foreignkey_idx` ON `exchange_comments`(`author_id`);
CREATE INDEX `offer_id_foreignkey_idx` ON `exchange_comments`(`offer_id`);


ALTER TABLE `exchange_trades` DROP INDEX `trader_id_foreignkey_idx`;
ALTER TABLE `exchange_trades` CHANGE `trader_id` `advertiser_id` mediumint(9) unsigned NOT NULL DEFAULT 0;
CREATE INDEX `advertiser_id_foreignkey_idx` ON `exchange_trades`(`advertiser_id`);
RENAME TABLE `exchange_trades` TO `exchange_advertisements`;
