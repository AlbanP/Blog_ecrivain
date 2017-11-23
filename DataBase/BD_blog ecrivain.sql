CREATE TABLE post (
  id smallint(6) NOT NULL AUTO_INCREMENT,
  title varchar(100) NOT NULL,  
  content text NOT NULL,
  dateUpdate datetime NOT NULL,
  orderPosted smallint(6),
  PRIMARY KEY (id)
) DEFAULT CHARSET=utf8 ;

CREATE TABLE comment (
  id mediumint(9) NOT NULL AUTO_INCREMENT,
  postId smallint(6) NOT NULL,
  parentId mediumint(9),  
  author varchar(50) NOT NULL,
  content text NOT NULL,
  date datetime NOT NULL,
  report tinyint(1) NOT NULL,
  moderate tinyint(1), 
  PRIMARY KEY (id)
) DEFAULT CHARSET=utf8 ;

CREATE TABLE user (
  id smallint(6) NOT NULL AUTO_INCREMENT, 
  name varchar(15) NOT NULL,
  pass varchar(255) NOT NULL,
  email varchar(63),
  date datetime NOT NULL,
  role varchar(31) NOT NULL,
  PRIMARY KEY (id)
) DEFAULT CHARSET=utf8 ;

ALTER TABLE comment 
ADD CONSTRAINT fk_post_id FOREIGN KEY (postId) REFERENCES post(id) ON DELETE CASCADE;

ALTER TABLE comment 
ADD CONSTRAINT fk_parent_id FOREIGN KEY (parentId) REFERENCES comment(id) ON DELETE CASCADE;
