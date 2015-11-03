CREATE DATABASE source_it_project;
USE progect;

CREATE TABLE role (
  `id`   INT(5) PRIMARY KEY AUTO_INCREMENT,
  `role` VARCHAR(20)
);

CREATE TABLE user (
  `id`         INT PRIMARY KEY AUTO_INCREMENT,
  `firstname`  VARCHAR(50)  NOT NULL,
  `lastname`   VARCHAR(50)  NOT NULL,
  `email`      VARCHAR(50)  NOT NULL,
  `password`   VARCHAR(100) NOT NULL,
  `phone`      VARCHAR(30),
  `created_at` DATETIME
);

