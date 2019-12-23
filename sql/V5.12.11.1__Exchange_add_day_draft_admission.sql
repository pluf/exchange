CREATE TABLE `exchange_days` (
  `id` mediumint(9) unsigned NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `tenant` mediumint(9) unsigned NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `date_unique_idx` (`tenant`,`date`),
  KEY `tenant_foreignkey_idx` (`tenant`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `exchange_admissions` (
  `id` mediumint(9) unsigned NOT NULL AUTO_INCREMENT,
  `amount` decimal(32,8) NOT NULL DEFAULT 0.00000000,
  `currency` varchar(16) NOT NULL DEFAULT '',
  `description` varchar(512) DEFAULT '',
  `day_id` mediumint(9) unsigned NOT NULL DEFAULT 0,
  `tenant` mediumint(9) unsigned NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `day_id_foreignkey_idx` (`day_id`),
  KEY `tenant_foreignkey_idx` (`tenant`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
   
CREATE TABLE `exchange_drafts` (
  `id` mediumint(9) unsigned NOT NULL AUTO_INCREMENT,
  `reference_id` varchar(64) NOT NULL DEFAULT '',
  `amount` decimal(32,8) NOT NULL DEFAULT 0.00000000,
  `currency` varchar(16) NOT NULL DEFAULT '',
  `rate` decimal(32,8) DEFAULT 1.00000000,
  `description` varchar(512) DEFAULT '',
  `day_id` mediumint(9) unsigned NOT NULL DEFAULT 0,
  `tenant` mediumint(9) unsigned NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `day_id_foreignkey_idx` (`day_id`),
  KEY `tenant_foreignkey_idx` (`tenant`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8; 
   
CREATE TABLE `exchange_currency_rates` (
  `id` mediumint(9) unsigned NOT NULL AUTO_INCREMENT,
  `source_currency` varchar(64) NOT NULL DEFAULT '',
  `dest_currency` varchar(64) NOT NULL DEFAULT '',
  `rate` decimal(32,8) NOT NULL DEFAULT 1.00000000,
  `modif_dtime` datetime NOT NULL,
  `tenant` mediumint(9) unsigned NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `tenant_foreignkey_idx` (`tenant`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
