create database IF NOT EXISTS lab_9_madlibs;

use lab_9_madlibs

CREATE TABLE IF NOT EXISTS `Madlibs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Story` text,
  `Noun` varchar(255) DEFAULT NULL,
  `Verb` varchar(255) DEFAULT NULL,
  `Adjective` varchar(255) DEFAULT NULL,
  `Adverb` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
);
