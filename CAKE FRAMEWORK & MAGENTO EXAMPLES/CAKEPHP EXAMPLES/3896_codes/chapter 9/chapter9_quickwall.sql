CREATE DATABASE quickwall;

USE quickwall;

CREATE TABLE questions (
  id int(10) unsigned NOT NULL auto_increment,
  question varchar(255) NOT NULL,
  questioner varchar(64) NOT NULL,
  created datetime NOT NULL,
  modified datetime NOT NULL,
  PRIMARY KEY  (id)
);

CREATE TABLE answers (
  id int(10) unsigned NOT NULL auto_increment,
  question_id int(10) unsigned NOT NULL,
  answer varchar(255) NOT NULL,
  answerer varchar(64) NOT NULL,
  created datetime NOT NULL,
  modified datetime NOT NULL,
  PRIMARY KEY  (id)
);

INSERT INTO questions (id, question, questioner, created, modified) VALUES 
(1, 'Why do you use CakePHP', 'Ahsan', '2008-02-11 22:19:04', '2008-02-11 22:19:04'),
(2, 'Why won''t you use CakePHP', 'Ahsan', '2008-02-11 22:22:06', '2008-02-11 22:22:06');

INSERT INTO answers (id, question_id, answer, answerer, created, modified) VALUES 
(1, 1, 'Its addictive', 'Anupom', '2008-02-11 22:22:45', '2008-02-11 22:22:45'),
(2, 1, 'I like it.', 'Manzil', '2008-02-11 22:23:06', '2008-02-11 22:23:06'),
(3, 1, 'Coz im lazy and I hate repeating myself', 'AB', '2008-02-11 22:23:57', '2008-02-11 22:23:57'),
(4, 2, 'Coz I am stupid', 'Stupid', '2008-02-11 22:24:24', '2008-02-11 22:24:24'),
(5, 2, 'I hate to learn', 'Wanna Be', '2008-02-11 22:25:02', '2008-02-11 22:25:02');