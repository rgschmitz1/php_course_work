CREATE DATABASE IF NOT EXISTS project_3;

USE project_3;

CREATE TABLE IF NOT EXISTS `blog` (
	`id` INT AUTO_INCREMENT,
	`title` VARCHAR(120),
	`date` DATETIME,
	`post` TEXT,
	PRIMARY KEY(`id`)
); 

CREATE TABLE IF NOT EXISTS `users` (
	`username` VARCHAR(32),
	`password` CHAR(40)
); 
