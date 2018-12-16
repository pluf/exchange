
CREATE TABLE `exchange_offers` (
  `id` mediumint(9) unsigned NOT NULL AUTO_INCREMENT,
  `amount` decimal(32,8) NOT NULL DEFAULT 0.00000000,
  `unit_price` decimal(32,8) NOT NULL DEFAULT 0.00000000,
  `description` varchar(512) DEFAULT '',
  `creation_dtime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modif_dtime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `offerer_id` mediumint(9) unsigned NOT NULL DEFAULT 0,
  `trade_id` mediumint(9) unsigned NOT NULL DEFAULT 0,
  `tenant` mediumint(9) unsigned NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `offerer_id_foreignkey_idx` (`offerer_id`),
  KEY `trade_id_foreignkey_idx` (`trade_id`),
  KEY `tenant_foreignkey_idx` (`tenant`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `exchange_posts` (
  `id` mediumint(9) unsigned NOT NULL AUTO_INCREMENT,
  `message` varchar(1024) DEFAULT '',
  `creation_dtime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modif_dtime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `sender_id` mediumint(9) unsigned NOT NULL DEFAULT 0,
  `receiver_id` mediumint(9) unsigned NOT NULL DEFAULT 0,
  `trade_id` mediumint(9) unsigned NOT NULL DEFAULT 0,
  `tenant` mediumint(9) unsigned NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `sender_id_foreignkey_idx` (`sender_id`),
  KEY `receiver_id_foreignkey_idx` (`receiver_id`),
  KEY `trade_id_foreignkey_idx` (`trade_id`),
  KEY `tenant_foreignkey_idx` (`tenant`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `exchange_trades` (
  `id` mediumint(9) unsigned NOT NULL AUTO_INCREMENT,
  `lower_limit` decimal(32,8) NOT NULL DEFAULT 0.00000000,
  `upper_limit` decimal(32,8) DEFAULT 0.00000000,
  `source_currency` varchar(64) NOT NULL DEFAULT '',
  `dest_currency` varchar(64) NOT NULL DEFAULT '',
  `unit_price` decimal(32,8) NOT NULL DEFAULT 0.00000000,
  `type` varchar(64) NOT NULL DEFAULT 'sell',
  `status` varchar(128) NOT NULL DEFAULT '',
  `description` varchar(512) DEFAULT '',
  `creation_dtime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modif_dtime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `trader_id` mediumint(9) unsigned NOT NULL DEFAULT 0,
  `tenant` mediumint(9) unsigned NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `trader_id_foreignkey_idx` (`trader_id`),
  KEY `tenant_foreignkey_idx` (`tenant`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
