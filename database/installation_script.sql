DROP DATABASE IF EXISTS newspepa;

CREATE DATABASE IF NOT EXISTS newspepa;

USE newspepa;

CREATE TABLE IF NOT EXISTS `status`(
  `id` INT(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `status_name` VARCHAR(50) NOT NULL,
  `active_fg` INT(2) NOT NULL DEFAULT 1,
  `created_date` DATETIME NOT NULL,
  `modified_date` DATETIME NOT NULL
);

INSERT INTO status (status_name, created_date, modified_date) VALUE ("ACTIVE", now(), now());
INSERT INTO status (status_name, created_date, modified_date) VALUE ("INACTIVE", now(), now());


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


CREATE TABLE IF NOT EXISTS `publishers`(
  `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(50) NOT NULL,
  `url` VARCHAR(100) NOT NULL,
  `status_id` INT NOT NULL DEFAULT 1,
  `created_date` DATETIME NOT NULL,
  `modified_date` DATETIME NOT NULL
);

INSERT INTO publishers (name, pub_id, url, created_date, modified_date) VALUES ("Tribune Nigeria", 1, "http://tribuneonlineng.com", now(), now()), ("Punch Nigeria", 2, "http://www.punchng.com", now(), now()),
  ("Leadership", 3, "http://leadership.ng", now(), now()), ("KokoFeed", 4, "http://kokofeed.com", now(), now()), ("Nigerian Monitor", 5, "http://www.nigerianmonitor.com", now(), now()),
  ("Vanguard Nigeria", 6, "http://www.vanguardngr.com", now(), now()), ("The Cable", "http://www.thecable.ng", now(), now()), ("Nigeria Guardian", "http://www.ngrguardiannews.com", now(), now()),
  ("Channels Television", 9, "http://www.channelstv.com", now(), now()), ("Star Gist", "http://stargist.com", now(), now()), ("BellaNaija", "http://www.bellanaija.com", now(), now()),
  ("Linda Ikeji", 12, "http://lindaikeji.blogspot.com", now(), now()), ("Goal.com", "http://goal.com", now(), now()), ("Futaa", "http://www.futaa.com", now(), now()), ("Complete Sport", "http://completesportsnigeria.com", now(), now()),
  ("Stargist Entertainment", 10, "http://stargist.com/feed/", now(), 15, 1, 3, now(), now()),
  ("Bella Naija Entertainment", 11, "http://www.bellanaija.com/feed/", now(), 15, 1, 3, now(), now()),
  ("Linda Ikeji Entertainment News", 12, "http://lindaikejimagazine.com/feed", now(), 15, 1, 3, now(), now()),
  ("Vanguard Entertainment News", 6, "http://www.vanguardngr.com/category/entertainment/feed", now(), 15, 1, 3, now(), now()),
  ("Nigerian Monitor Entertainment News", 5, "http://www.nigerianmonitor.com/category/1entertainment/feed", now(), 15, 1, 3, now(), now()),
  ("Goal.com", 13, "http://www.goal.com/en-ng/feeds/news?fmt=rss&ICID=HP", now(), 15, 1, 4, now(), now()),
  ("Punch Sport news", 2, "http://www.punchng.com/sports/feed", now(), 15, 1, 4, now(), now()),
  ("vanguard Nigeria Sport News", 6, "http://www.vanguardngr.com/category/sports/feed/", now(), 15, 1, 4, now(), now()),
  ("Futaa Sport News", 14, "http://www.futaa.com/rss/ng", now(), 15, 1, 4, now(), now()),
  ("Complete Sport News", 15, "http://www.completesportsnigeria.com/feed/", now(), 15, 1, 4, now(), now()),
  ("Channels Television Sport News", 9, "http://www.channelstv.com/category/sports/feed/", now(), 15, 1, 4, now(), now()),
  ("Punch Politics News", 2, "http://www.punchng.com/sports/feed", now(), 15, 1, 4, now(), now()),
  ("Vanguard Nigeria Politics News", 6, "http://www.vanguardngr.com/category/sports/feed/", now(), 15, 1, 4, now(), now()),
  ("Nigeria Guardian politics News", 8, "http://www.futaa.com/rss/ng", now(), 15, 1, 4, now(), now()),
  ("Channels Television Politics News", 9, "http://www.channelstv.com/category/sports/feed/", now(), 15, 1, 4, now(), now()),
  ("Punch Metro News", 2, "http://www.punchng.com/sports/feed", now(), 15, 1, 5, now(), now()),
  ("Nigeria Guardian Sport News", 8, "http://www.ngrguardiannews.com/news/metro/feed/", now(), 15, 1, 5, now(), now());


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
  CONSTRAINT fk_feed_category_id FOREIGN KEY (category_id) REFERENCES categories(id),
  CONSTRAINT fk_feed_status FOREIGN KEY (status_id) REFERENCES status(id),
  CONSTRAINT fk_feed_publisher FOREIGN KEY (pub_id) REFERENCES publishers(id)
);

# Set Up data
INSERT INTO feeds (title, pub_id, url, last_access, refresh_period, status_id, category_id, created_date, modified_date) VALUES
  ("Tribune News", 1, "http://tribuneonlineng.com/taxonomy/term/16/all/feed", now(), 15, 1, 1, now(), now()),
  ("Punch News", 2, "http://www.punchng.com/news/feed", now(), 15, 1, 1, now(), now()),
  ("Leadership News", 3, "http://leadership.ng/feed", now(), 15, 1, 1, now(), now()),
  ("KokoFeed News", 4, "http://kokofeed.com/category/news/feed", now(), 15, 1, 1, now(), now()),
  ("Nigerian Monitor News", 5, "http://www.nigerianmonitor.com/category/3nigeriannews/feed", now(), 15, 1, 1, now(), now()),
  ("Vanguard National News", 6, "http://www.vanguardngr.com/category/national-news/feed", now(), 15, 1, 1, now(), now()),
  ("The Cable, The Nation", 7, "http://www.thecable.ng/category/thenation/feed", now(), 15, 1, 1, now(), now()),
  ("Nigeria Guardian National News", 8, "http://www.ngrguardiannews.com/news/national/feed", now(), 15, 1, 1, now(), now()),
  ("Channels Television Headline News", 9, "http://www.channelstv.com/category/headlines/feed", now(), 15, 1, 1, now(), now());

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
  CONSTRAINT fk_story_status_id FOREIGN KEY (status_id) REFERENCES status(id),
  CONSTRAINT fk_story_category FOREIGN KEY (category_id) REFERENCES categories(id),
  CONSTRAINT fk_story_feed FOREIGN KEY (feed_id) REFERENCES feeds(id),
  CONSTRAINT fk_story_publisher FOREIGN KEY (pub_id) REFERENCES publishers(id)
);

CREATE TABLE IF NOT EXISTS `clusters` (
  `id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `category_id` INT NOT NULL,
  `cluster_pivot` INT NOT NULL,
  `matches` TEXT(255) NOT NULL,
  `status_id` INT NOT NULL,
  `created_date` DATETIME NOT NULL,
  `modified_date` DATETIME NOT NULL,
  CONSTRAINT fk_category_id FOREIGN KEY (category_id) REFERENCES categories(id),
  CONSTRAINT fk_cluster_status FOREIGN KEY (status_id) REFERENCES status(id),
  CONSTRAINT fk_story_pivot FOREIGN KEY (cluster_pivot) REFERENCES stories (id)
);


CREATE TABLE IF NOT EXISTS `timeline_stories`(
  `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `story_id` INT NOT NULL,
  `title` VARCHAR(255) NOT NULL ,
  `image_url` TEXT NOT NULL,
  `video_url` TEXT,
  `description` TEXT NOT NULL,
  `content` TEXT NOT NULL,
  `url` TEXT NOT NULL,
  `pub_id` INT NOT NULL,
  `category_id` INT(5) NOT NULL,
  `status_id` INT(5) NOT NULL DEFAULT 1,
  `pub_date` DATETIME NOT NULL,
  `insert_date` DATETIME NOT NULL ,
  `has_cluster` INT NOT NULL DEFAULT 0,
  `reads` INT,
  `link_outs` INT,
  `shares` INT,
  `created_date` DATETIME NOT NULL,
  `modified_date` DATETIME NOT NULL,
  CONSTRAINT fk_timeline_story_category FOREIGN KEY (category_id) REFERENCES categories(id),
  CONSTRAINT fk_timeline_story_status FOREIGN KEY (status_id) REFERENCES status(id),
  CONSTRAINT fk_timeline_story FOREIGN KEY (story_id) REFERENCES stories (id)
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
  CONSTRAINT fk_user_type FOREIGN KEY (user_type) REFERENCES user_types(id)
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
  CONSTRAINT fk_tracking_user FOREIGN KEY (user_id) REFERENCES users(id),
  CONSTRAINT fk_tracking_story FOREIGN KEY (story_id) REFERENCES stories(id)
);

