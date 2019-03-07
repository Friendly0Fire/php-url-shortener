# Why you should use `utf8mb4` instead of `utf8`: http://mathiasbynens.be/notes/mysql-utf8mb4
CREATE TABLE `redirect` (
	`slug` varchar(250) collate utf8mb4_unicode_ci NOT NULL,
	`url` varchar(620) collate utf8mb4_unicode_ci NOT NULL,
	`date` datetime NOT NULL,
	`hits` bigint(20) NOT NULL default '0',
	PRIMARY KEY (`slug`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Used for the URL shortener';

CREATE TABLE `auth` (
	`token` varchar(32) collate utf8mb4_unicode_ci NOT NULL,
	PRIMARY KEY (`token`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Used for authentication';