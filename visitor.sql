SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+05:30";

CREATE TABLE `visitors` (
  `id` int(11) NOT NULL,
  `user_id` text COLLATE utf8_unicode_ci NOT NULL,
  `user_token` text COLLATE utf8_unicode_ci NOT NULL,
  `user_ip` text COLLATE utf8_unicode_ci NOT NULL,
  `user_agent` text COLLATE utf8_unicode_ci NOT NULL,
  `url` text COLLATE utf8_unicode_ci NOT NULL,
  `visitor_from` text COLLATE utf8_unicode_ci,
  `city` text COLLATE utf8_unicode_ci NOT NULL,
  `region` text COLLATE utf8_unicode_ci NOT NULL,
  `country` text COLLATE utf8_unicode_ci NOT NULL,
  `loc` text COLLATE utf8_unicode_ci NOT NULL,
  `isp` text COLLATE utf8_unicode_ci NOT NULL,
  `timezone` text COLLATE utf8_unicode_ci NOT NULL,
  `visited_on` text COLLATE utf8_unicode_ci NOT NULL,
  `last_seen` text COLLATE utf8_unicode_ci NOT NULL,
  `added_on` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
ALTER TABLE `visitors`
  ADD PRIMARY KEY (`id`);

COMMIT;
