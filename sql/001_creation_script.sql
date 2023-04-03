-- This is the creation script for the database.

CREATE DATABASE `tools_forever` CHARACTER SET utf8;

USE `tools_forever`;

CREATE TABLE `roles` (
   `id` INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
   `role` VARCHAR(45) NOT NULL,
) ENGINE=INNODB;

CREATE TABLE `locations` (
   `id` INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
   `place_name` VARCHAR(45) NOT NULL,
) ENGINE=INNODB;

CREATE TABLE `product_name` (
   `id` INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
   `name` VARCHAR(45) NOT NULL,
) ENGINE=INNODB;

CREATE TABLE `manufacturers` (
   `id` INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
   `name` VARCHAR(45) NOT NULL,
) ENGINE=INNODB;

CREATE TABLE `staff` (
   `id` INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
   `location_id` INT NOT NULL,
   `role_id` int NOT NULL,
   `first_name` VARCHAR(45) NOT NULL,
   `last_name` VARCHAR(45) NOT NULL,
   `password` VARCHAR(200) NOT NULL,
   
) ENGINE=INNODB;
