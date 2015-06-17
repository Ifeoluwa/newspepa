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
INSERT INTO categories(category_name, created_date, modified_date) VALUE ("News", now(), now());
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


CREATE TABLE IF NOT EXISTS `feeds`(
  `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `title` VARCHAR(255) NOT NULL,
  `pub_id` INT NOT NULL,
  `url` INT NOT NULL,
  `last_access` DATETIME NOT NULL,
  `refresh_period` INT(5) NOT NULL,
  `status_id` INT NOT NULL DEFAULT 1,
  `category_id` INT(5) NOT NULL,
  `created_date` DATETIME NOT NULL,
  `modified_date` DATETIME NOT NULL,
   CONSTRAINT fk_feed_category_id FOREIGN KEY (category_id) REFERENCES categories(id),
   CONSTRAINT fk_feed_status FOREIGN KEY (status_id) REFERENCES status(id),
   CONSTRAINT fk_feed_publisher FOREIGN KEY (pub_id) REFERENCES publishers(id)
)

CREATE  TABLE IF NOT EXISTS `stories` (
  `id` INT(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `title` VARCHAR(255) NOT NULL ,
  `image_url` TEXT NOT NULL,
  `video_url` TEXT,
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
)


CREATE TABLE IF NOT EXISTS `users`(
  `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `username` INT NOT NULL,
  `email_address` INT NOT NULL,
  `facebook_id` VARCHAR(255),
  `date_of_birth` DATETIME,
  `user_type` INT NOT NULL,
  `status_id` INT NOT NULL DEFAULT 1,
  `created_date` DATETIME NOT NULL,
  `modified_date` DATETIME NOT NULL
,
   CONSTRAINT fk_user_type FOREIGN KEY (user_type) REFERENCES user_types(id)
  )

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
 )



