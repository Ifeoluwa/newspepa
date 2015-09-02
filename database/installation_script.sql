DROP DATABASE IF EXISTS newspepa;

CREATE DATABASE IF NOT EXISTS newspepa;

USE newspepa;

# Status table structure
CREATE TABLE IF NOT EXISTS `status`(
  `id` INT(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `status_name` VARCHAR(50) NOT NULL,
  `active_fg` INT(2) NOT NULL DEFAULT 1,
  `created_date` DATETIME NOT NULL,
  `modified_date` DATETIME NOT NULL
);


# Set up data for the status table
INSERT INTO `status` (`id`, `status_name`, `active_fg`, `created_date`, `modified_date`) VALUES
  (1, 'ACTIVE', 1, '2015-06-18 10:30:23', '2015-06-18 10:30:23'),
  (2, 'INACTIVE', 1, '2015-06-18 10:30:23', '2015-06-18 10:30:23'),
  (3, 'MATCHED', 1, '2015-06-18 10:30:23', '2015-06-18 10:30:23'),
  (4, 'SCHEDULED', 1, '2015-06-26 12:37:26', '2015-06-26 12:37:26');

# Status table structure
CREATE TABLE IF NOT EXISTS `categories` (
  `id` INT(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `category_name` VARCHAR(50) NOT NULL,
  `status` INT(2) NOT NULL DEFAULT 1,
  `created_date` DATETIME NOT NULL,
  `modified_date` DATETIME NOT NULL
);

INSERT INTO categories(category_name, created_date, modified_date) VALUE ("Nigeria", now(), now());
INSERT INTO categories(category_name, created_date, modified_date) VALUE ("Politics", now(), now());
INSERT INTO categories(category_name, created_date, modified_date) VALUE ("Entertainment", now(), now());
INSERT INTO categories(category_name, created_date, modified_date) VALUE ("Sports", now(), now());
INSERT INTO categories(category_name, created_date, modified_date) VALUE ("Metro", now(), now());


--
-- Table structure for table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS `publishers`(
  `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(50) NOT NULL,
  `url` VARCHAR(100) NOT NULL,
  `status_id` INT NOT NULL DEFAULT 1,
  `created_date` DATETIME NOT NULL,
  `modified_date` DATETIME NOT NULL
);

INSERT INTO `publishers` (`id`, `name`, `url`, `status_id`, `created_date`, `modified_date`) VALUES
  (1, 'Tribune Nigeria', 'http://tribuneonlineng.com', 1, '2015-06-18 11:04:11', '2015-06-18 11:04:11'),
  (2, 'Punch Nigeria', 'http://www.punchng.com', 1, '2015-06-18 11:04:11', '2015-06-18 11:04:11'),
  (3, 'Leadership', 'http://leadership.ng', 1, '2015-06-18 11:04:11', '2015-06-18 11:04:11'),
  (4, 'KokoFeed', 'http://kokofeed.com', 1, '2015-06-18 11:04:11', '2015-06-18 11:04:11'),
  (5, 'Nigerian Monitor', 'http://www.nigerianmonitor.com', 1, '2015-06-18 11:04:11', '2015-06-18 11:04:11'),
  (6, 'Vanguard Nigeria', 'http://www.vanguardngr.com', 1, '2015-06-18 11:04:11', '2015-06-18 11:04:11'),
  (7, 'The Cable', 'http://www.thecable.ng', 1, '2015-06-18 11:04:11', '2015-06-18 11:04:11'),
  (8, 'Nigeria Guardian', 'http://www.ngrguardiannews.com', 1, '2015-06-18 11:04:11', '2015-06-18 11:04:11'),
  (9, 'Channels Television', 'http://www.channelstv.com', 1, '2015-06-18 11:04:11', '2015-06-18 11:04:11'),
  (10, 'Star Gist', 'http://stargist.com', 1, '2015-06-18 11:04:11', '2015-06-18 11:04:11'),
  (11, 'BellaNaija', 'http://www.bellanaija.com', 1, '2015-06-18 11:04:11', '2015-06-18 11:04:11'),
  (12, 'Linda Ikeji', 'http://lindaikejimagazine.com/', 1, '2015-06-18 11:04:11', '2015-06-18 11:04:11'),
  (13, 'Goal.com', 'http://goal.com', 1, '2015-06-18 11:04:11', '2015-06-18 11:04:11'),
  (14, 'Futaa', 'http://www.futaa.com', 0, '2015-06-18 11:04:11', '2015-06-18 11:04:11'),
  (15, 'Complete Sport', 'http://completesportsnigeria.com', 1, '2015-06-18 11:04:11', '2015-06-18 11:04:11'),
  (16, 'Squawka', 'http://www.squawka.com', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
  (17, 'Daily Post', 'http://dailypost.ng', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
  (18, 'The Cable', 'https://www.thecable.ng', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
  (19, 'The Net', 'http://thenet.ng/', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
  (20, 'Premium Times Ng', 'http://www.premiumtimesng.com/', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

CREATE TABLE IF NOT EXISTS `feeds`(
  `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `title` VARCHAR(255) NOT NULL,
  `pub_id` INT NOT NULL,
  `url` VARCHAR(255) NOT NULL,
  `last_access` DATETIME NOT NULL,
  `refresh_period` INT(5) NOT NULL,
  `status_id` INT NOT NULL DEFAULT 1,
  `category_id` INT(5) NOT NULL,
  `created_date` DATETIME NOT NULL,
  `modified_date` DATETIME NOT NULL,
  CONSTRAINT fk_feed_category_id FOREIGN KEY (category_id) REFERENCES categories(id) ON UPDATE CASCADE ON DELETE CASCADE,
  CONSTRAINT fk_feed_status FOREIGN KEY (status_id) REFERENCES status(id) ON UPDATE CASCADE ON DELETE CASCADE,
  CONSTRAINT fk_feed_publisher FOREIGN KEY (pub_id) REFERENCES publishers(id) ON UPDATE CASCADE ON DELETE CASCADE
);

# Set Up data for feeds
INSERT INTO `feeds` (`id`, `title`, `pub_id`, `url`, `last_access`, `refresh_period`, `status_id`, `category_id`, `created_date`, `modified_date`) VALUES
  (1, 'Tribune News', 1, 'http://tribuneonlineng.com/taxonomy/term/16/all/feed', '2015-07-22 07:35:07', 15, 1, 1, '2015-06-18 13:52:56', '2015-06-18 13:52:56'),
  (2, 'Punch News', 2, 'http://www.punchng.com/news/feed', '2015-07-22 07:35:22', 15, 1, 1, '2015-06-18 13:52:56', '2015-06-18 13:52:56'),
  (3, 'Leadership News', 3, 'http://leadership.ng/feed', '2015-07-22 07:35:25', 15, 1, 1, '2015-06-18 13:52:56', '2015-06-18 13:52:56'),
  (4, 'KokoFeed News', 4, 'http://kokofeed.com/category/news/feed', '2015-07-22 07:35:26', 15, 1, 1, '2015-06-18 13:52:56', '2015-06-18 13:52:56'),
  (5, 'Nigerian Monitor News', 5, 'http://www.nigerianmonitor.com/feed/', '2015-07-22 07:35:27', 15, 1, 1, '2015-06-18 13:52:56', '2015-06-18 13:52:56'),
  (6, 'Vanguard National News', 6, 'http://www.vanguardngr.com/category/national-news/feed', '2015-07-22 07:35:34', 15, 1, 1, '2015-06-18 13:52:56', '2015-06-18 13:52:56'),
  (8, 'Nigeria Guardian National News', 8, 'http://www.ngrguardiannews.com/news/national/feed', '2015-07-22 07:35:42', 15, 1, 1, '2015-06-18 13:52:56', '2015-06-18 13:52:56'),
  (9, 'Channels Television Headline News', 9, 'http://www.channelstv.com/category/headlines/feed', '2015-07-22 07:35:48', 15, 1, 1, '2015-06-18 13:52:56', '2015-06-18 13:52:56'),
  (10, 'Stargist Entertainment', 10, 'http://stargist.com/feed/', '2015-07-22 07:35:49', 15, 1, 3, '2015-06-18 14:01:57', '2015-06-18 14:01:57'),
  (11, 'Bella Naija Entertainment', 11, 'http://www.bellanaija.com/feed/', '2015-07-22 07:36:05', 15, 1, 3, '2015-06-18 14:01:57', '2015-06-18 14:01:57'),
  (12, 'Linda Ikeji Entertainment News', 12, 'http://lindaikejimagazine.com/feed', '2015-07-14 08:10:34', 15, 2, 3, '2015-06-18 14:01:57', '2015-06-18 14:01:57'),
  (13, 'Vanguard Entertainment News', 6, 'http://www.vanguardngr.com/category/entertainment/feed', '2015-07-22 07:36:12', 15, 1, 3, '2015-06-18 14:01:57', '2015-06-18 14:01:57'),
  (14, 'Nigerian Monitor Entertainment News', 5, 'http://www.nigerianmonitor.com/category/1entertainment/feed', '2015-07-13 21:57:12', 15, 1, 3, '2015-06-18 14:01:57', '2015-06-18 14:01:57'),
  (15, 'Goal.com', 13, 'http://www.goal.com/en-ng/feeds/news?fmt=rss&ICID=HP', '2015-07-22 07:36:14', 15, 1, 4, '2015-06-18 14:38:10', '2015-06-18 14:38:10'),
  (16, 'Punch Sport news', 2, 'http://www.punchng.com/sports/feed', '2015-07-22 07:36:27', 15, 1, 4, '2015-06-18 14:38:10', '2015-06-18 14:38:10'),
  (17, 'Vanguard Nigeria Sport News', 6, 'http://www.vanguardngr.com/category/sports/feed/', '2015-07-22 07:36:34', 15, 1, 4, '2015-06-18 14:38:10', '2015-06-18 14:38:10'),
  (18, 'Futaa Sport News', 14, 'http://www.futaa.com/rss/ng', '2015-07-09 09:19:46', 15, 2, 4, '2015-06-18 14:38:10', '2015-06-18 14:38:10'),
  (19, 'Complete Sport News', 15, 'http://www.completesportsnigeria.com/feed/', '2015-07-22 07:36:39', 15, 1, 4, '2015-06-18 14:38:10', '2015-06-18 14:38:10'),
  (20, 'Channels Television Sport News', 9, 'http://www.channelstv.com/category/sports/feed/', '2015-07-22 07:36:47', 15, 1, 4, '2015-06-18 14:38:10', '2015-06-18 14:38:10'),
  (21, 'Punch Politics News', 2, 'http://www.punchng.com/politics/feed', '2015-07-22 07:31:56', 15, 1, 2, '2015-06-18 15:04:35', '2015-06-18 15:04:35'),
  (22, 'Vanguard Nigeria Politics News', 6, 'http://www.vanguardngr.com/category/politics/feed', '2015-07-22 07:32:04', 15, 1, 2, '2015-06-18 15:04:35', '2015-06-18 15:04:35'),
  (23, 'Nigerian Guardian Politics News', 8, 'http://www.ngrguardiannews.com/features/policy-a-politics/feed', '2015-07-22 07:32:11', 15, 1, 2, '2015-06-18 15:04:35', '2015-06-18 15:04:35'),
  (24, 'Channels Television Politics News', 9, 'http://www.channelstv.com/category/politics/feed', '2015-07-22 07:32:18', 15, 1, 2, '2015-06-18 15:04:35', '2015-06-18 15:04:35'),
  (25, 'Punch Metro News', 2, 'http://www.punchng.com/metro-plus/feed', '2015-07-22 07:32:31', 15, 1, 5, '2015-06-18 15:08:45', '2015-06-18 15:08:45'),
  (26, 'Nigeria Guardian Metro News', 8, 'http://www.ngrguardiannews.com/news/metro/feed/', '2015-07-22 07:32:38', 15, 1, 5, '2015-06-18 15:08:45', '2015-06-18 15:08:45'),
  (27, 'Squakwa Sport News', 16, 'http://www.squawka.com/news/feed', '2015-07-14 08:11:24', 10, 2, 4, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
  (28, 'Daily Post Politics News', 17, 'http://dailypost.ng/politics/feed', '2015-07-22 07:32:41', 10, 1, 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
  (29, 'The Cable National/Nigeria News', 18, 'https://www.thecable.ng/category/top-stories/feed', '2015-07-20 09:24:33', 0, 2, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
  (30, 'Daily Post Nigeria News', 17, 'http://dailypost.ng/hot-news/feed', '2015-07-22 07:32:45', 0, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
  (31, 'The Net Entertainment News', 19, 'http://thenet.ng/news/feed/', '2015-07-22 07:33:01', 10, 1, 3, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
  (32, 'Premium Times news', 20, 'http://www.premiumtimesng.com/category/news/feed', '2015-07-22 07:33:09', 0, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

CREATE  TABLE IF NOT EXISTS `stories` (
  `id` INT(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `title` VARCHAR(255) NOT NULL ,
  `image_url` TEXT NOT NULL,
  `video_url` TEXT,
  `description` TEXT NOT NULL,
  `content` TEXT NOT NULL,
  `url` VARCHAR(255) NOT NULL,
  `pub_id` INT NOT NULL,
  `feed_id` INT NOT NULL,
  `category_id` INT(5) NOT NULL,
  `status_id` INT(5) NOT NULL DEFAULT 1,
  `pub_date` DATETIME NOT NULL,
  `insert_date` DATETIME NOT NULL ,
  `has_cluster` INT NOT NULL DEFAULT 0,
  `created_date` DATETIME NOT NULL,
  `modified_date` DATETIME NOT NULL,
  CONSTRAINT fk_story_status_id FOREIGN KEY (status_id) REFERENCES status(id) ON UPDATE CASCADE ON DELETE CASCADE,
  CONSTRAINT fk_story_category FOREIGN KEY (category_id) REFERENCES categories(id) ON UPDATE CASCADE ON DELETE CASCADE,
  CONSTRAINT fk_story_feed FOREIGN KEY (feed_id) REFERENCES feeds(id) ON UPDATE CASCADE ON DELETE CASCADE,
  CONSTRAINT fk_story_publisher FOREIGN KEY (pub_id) REFERENCES publishers(id) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS `clusters` (
  `id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `cluster_pivot` INT NOT NULL,
  `cluster_match` INT NOT NULL,
  `status_id` INT NOT NULL,
  `created_date` DATETIME NOT NULL,
  `modified_date` DATETIME NOT NULL,
  CONSTRAINT fk_cluster_status FOREIGN KEY (status_id) REFERENCES status(id) ON UPDATE CASCADE ON DELETE CASCADE,
  CONSTRAINT fk_story_pivot FOREIGN KEY (cluster_pivot) REFERENCES stories (id) ON UPDATE CASCADE ON DELETE CASCADE,
  CONSTRAINT fk_story_match FOREIGN KEY (cluster_match) REFERENCES stories (id) ON UPDATE CASCADE ON DELETE CASCADE
);


CREATE TABLE IF NOT EXISTS `timeline_stories`(
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `story_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `image_url` text NOT NULL,
  `video_url` text,
  `description` text NOT NULL,
  `content` text NOT NULL,
  `url` text NOT NULL,
  `story_url` varchar(255) NOT NULL,
  `pub_id` int(11) NOT NULL,
  `feed_id` int(255) NOT NULL,
  `category_id` int(5) NOT NULL,
  `status_id` int(5) NOT NULL DEFAULT '1',
  `pub_date` datetime NOT NULL,
  `insert_date` datetime NOT NULL,
  `has_cluster` int(11) NOT NULL DEFAULT '0',
  `is_pivot` int(5) NOT NULL DEFAULT '0',
  `is_top` int(10) NOT NULL DEFAULT '0',
  `no_of_views` int(11) NOT NULL DEFAULT '0',
  `last_view_time` datetime NOT NULL,
  `link_outs` int(11) NOT NULL DEFAULT '0',
  `last_linkout_time` datetime NOT NULL,
  `shares` int(11) NOT NULL DEFAULT '0',
  `created_date` datetime NOT NULL,
  `modified_date` datetime NOT NULL,
  `facebook_pubstatus` int(11) NOT NULL DEFAULT '0',
  `twitter_pubstatus` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `timeline_story_unique` (`title`),
  CONSTRAINT fk_timeline_story_category FOREIGN KEY (category_id) REFERENCES categories(id) ON UPDATE CASCADE ON DELETE CASCADE,
  CONSTRAINT fk_timeline_story_status FOREIGN KEY (status_id) REFERENCES status(id) ON UPDATE CASCADE ON DELETE CASCADE,
  CONSTRAINT fk_timeline_story FOREIGN KEY (story_id) REFERENCES stories (id) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS `user_types`(
  `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` INT NOT NULL,
  `created_date` DATETIME NOT NULL,
  `modified_date` DATETIME NOT NULL
);


CREATE TABLE IF NOT EXISTS `users`(
  `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `username` INT NOT NULL,
  `email_address` INT NOT NULL,
  `facebook_id` VARCHAR(255),
  `date_of_birth` DATETIME,
  `user_type` INT NOT NULL,
  `status_id` INT NOT NULL DEFAULT 1,
  `created_date` DATETIME NOT NULL,
  `modified_date` DATETIME NOT NULL,
  CONSTRAINT fk_user_type FOREIGN KEY (user_type) REFERENCES user_types(id) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS `trackings`(
  `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `user_id` INT NOT NULL,
  `story_id` INT NOT NULL,
  `read_count` INT NOT NULL DEFAULT 0,
  `link_out_count` INT NOT NULL DEFAULT 0,
  `category_id` INT NOT NULL,
  `created_date` DATETIME NOT NULL,
  `modified_date` DATETIME NOT NULL,
  CONSTRAINT fk_tracking_user FOREIGN KEY (user_id) REFERENCES users(id) ON UPDATE CASCADE ON DELETE CASCADE,
  CONSTRAINT fk_tracking_story FOREIGN KEY (story_id) REFERENCES stories(id) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS `linkouts` (
  `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `session_key` VARCHAR(255) NOT NULL,
  `no_of_linkouts` INT NOT NULL,
  `created_date` DATETIME NOT NULL,
  `modified_date` DATETIME NOT NULL
);

CREATE TABLE IF NOT EXISTS `views` (
  `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `session_key` VARCHAR(255) NOT NULL,
  `no_of_views` INT NOT NULL,
  `created_date` DATETIME NOT NULL,
  `modified_date` DATETIME NOT NULL
);

CREATE TABLE IF NOT EXISTS `comments` (
  `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `story_id`  INT NOT NULL,
  `session_key` VARCHAR(255) NOT NULL,
  `user_name` VARCHAR(50) NOT NULL,
  `comment` TEXT NOT NULL,
  `status_id` INT(10) NOT NULL DEFAULT 1,
  `created_date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` DATETIME NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  CONSTRAINT fk_comment_story FOREIGN KEY (story_id) REFERENCES stories(id) ON UPDATE CASCADE ON DELETE CASCADE,
  CONSTRAINT fk_comment_status FOREIGN KEY (status_id) REFERENCES status(id) ON UPDATE CASCADE ON DELETE CASCADE
);

# add sex column to the users table
ALTER TABLE users
ADD COLUMN `sex` VARCHAR(10) NOT NULL;

# Stores users preferences for stories by categories
CREATE TABLE IF NOT EXISTS `preferences` (
  `id` INT(255) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `user_id` INT(255) NOT NULL,
  `category_id` INT(255) NOT NULL,
  `status` INT(255) NOT NULL DEFAULT 1,
  `created_date` DATETIME NOT NULL,
  `modified_date` DATETIME NOT NULL,
  CONSTRAINT fk_preference_category FOREIGN KEY (category_id) REFERENCES categories(id) ON UPDATE CASCADE ON DELETE CASCADE,
  CONSTRAINT fk_preference_user FOREIGN KEY (user_id) REFERENCES users(id) ON UPDATE CASCADE ON DELETE CASCADE
);


CREATE TABLE IF NOT EXISTS `daily_stats` (
  `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `no_of_views` INT NOT NULL,
  `no_of_linkouts` INT NOT NULL,
  `created_date` DATETIME NOT NULL,
  `modified_date` DATETIME NOT NULL
);


INSERT INTO `feeds` (`title`, `pub_id`, `url`, `last_access`, `refresh_period`, `status_id`, `category_id`, `created_date`, `modified_date`) VALUES
  ('BBC Hausa News', 1, 'http://www.bbc.com/hausa/index.xml', '2015-07-22 07:35:07', 15, 2, 7, '2015-06-18 13:52:56', '2015-06-18 13:52:56'),
  ('The Nation Politics News', 1, 'http://thenationonlineng.net/category/politics/feed', '2015-07-22 07:35:22', 15, 2, 2, '2015-06-18 13:52:56', '2015-06-18 13:52:56'),
  ('Kokofeed News', 1, 'http://kokofeed.com/category/news/feed ', '2015-07-22 07:35:25', 15, 2, 1, '2015-06-18 13:52:56', '2015-06-18 13:52:56'),
  ('Kokofeed Best of Web', 3, 'http://kokofeed.com/category/best-of-the-web/feed', '2015-07-22 07:35:25', 15, 2, 1, '2015-06-18 13:52:56', '2015-06-18 13:52:56'),
  ('Kokofeed Lists News', 3, 'http://kokofeed.com/category/lists/feed', '2015-07-22 07:35:25', 15, 2, 1, '2015-06-18 13:52:56', '2015-06-18 13:52:56'),
  ('Kokofeed Trending News', 3, 'http://kokofeed.com/category/trending/feed', '2015-07-22 07:35:25', 15, 2, 1, '2015-06-18 13:52:56', '2015-06-18 13:52:56'),
  ('Kokofeed Video News', 3, 'http://kokofeed.com/category/video/feed', '2015-07-22 07:35:25', 15, 2, 1, '2015-06-18 13:52:56', '2015-06-18 13:52:56'),
  ('Daily Post Sport News', 4, 'http://dailypost.ng/sport-news/feed', '2015-07-22 07:35:25', 15, 2, 1, '2015-06-18 13:52:56', '2015-06-18 13:52:56');



CREATE TABLE IF NOT EXISTS `feedbacks` (
  `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(100) NOT NULL,
  `feedback` TEXT NOT NUll,
  `status_id` INT(255) NOT NULL,
  `created_date` DATETIME NOT NULL,
  `modified_date` DATETIME NOT NULL,
  CONSTRAINT fk_feedback_status FOREIGN KEY (status_id) REFERENCES status(id) ON UPDATE CASCADE ON DELETE CASCADE
);