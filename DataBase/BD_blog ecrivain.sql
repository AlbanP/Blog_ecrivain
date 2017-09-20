CREATE TABLE `post` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,  
  `content` text NOT NULL,
  `date_post` datetime,
  `date_update` datetime NOT NULL,
  `posted` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) DEFAULT CHARSET=utf8 ;

CREATE TABLE `comment` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `post_id` smallint(6) NOT NULL,
  `parent_comment_id` smallint(6),  
  `author` varchar(50) NOT NULL,
  `content` text NOT NULL,
  `date` datetime NOT NULL,
  `self_author` tinyint(1) NOT NULL,
  `report` tinyint(1) NOT NULL,
  `reported` tinyint(1) NOT NULL, 
  PRIMARY KEY (`id`)
) DEFAULT CHARSET=utf8 ;
