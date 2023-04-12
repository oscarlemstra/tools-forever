-- This is the creation script for the database.

CREATE DATABASE `tools_forever` CHARACTER SET utf8;

USE `tools_forever`;

CREATE TABLE `roles` (
   `id` INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
   `role` VARCHAR(45) NOT NULL
) ENGINE=INNODB;

CREATE TABLE `locations` (
   `id` INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
   `place_name` VARCHAR(45) NOT NULL
) ENGINE=INNODB;

CREATE TABLE `product_names` (
   `id` INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
   `name` VARCHAR(45) NOT NULL
) ENGINE=INNODB;

CREATE TABLE `manufacturers` (
   `id` INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
   `name` VARCHAR(45) NOT NULL
) ENGINE=INNODB;

CREATE TABLE `staff` (
   `id` INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
   `location_id` INT NOT NULL,
   `role_id` INT NOT NULL,
   `first_name` VARCHAR(45) NOT NULL,
   `last_name` VARCHAR(45) NOT NULL,
   `password` CHAR(128) NOT NULL, -- sha512
   FOREIGN KEY (`location_id`) REFERENCES `locations`(`id`)
      ON UPDATE CASCADE
      ON DELETE RESTRICT,
   FOREIGN KEY (`role_id`) REFERENCES `roles`(`id`)
      ON UPDATE CASCADE
      ON DELETE RESTRICT
) ENGINE=INNODB;

CREATE TABLE `products` (
   `id` INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
   `product_name_id` INT NOT NULL,
   `manufacturer_id` INT NOT NULL,
   `type` VARCHAR(45) NOT NULL,
   `purchase_price` DECIMAL(12, 2) NOT NULL,
   `sell_price` DECIMAL(12, 2) NOT NULL,
   FOREIGN KEY (`product_name_id`) REFERENCES `product_names`(`id`)
      ON UPDATE CASCADE
      ON DELETE RESTRICT,
   FOREIGN KEY (`manufacturer_id`) REFERENCES `manufacturers`(`id`)
      ON UPDATE CASCADE
      ON DELETE RESTRICT
) ENGINE=INNODB;

CREATE TABLE `location_has_products` (
   `location_id` INT NOT NULL,
   `product_id` INT NOT NULL,
   `in_stock` INT NOT NULL,
   `min_stock` INT NOT NULL,
   PRIMARY KEY (`location_id`, `product_id`),
   FOREIGN KEY (`location_id`) REFERENCES `locations`(`id`)
      ON UPDATE CASCADE
      ON DELETE RESTRICT,
   FOREIGN KEY (`product_id`) REFERENCES `products`(`id`)
      ON UPDATE CASCADE
      ON DELETE RESTRICT
) ENGINE=INNODB;
