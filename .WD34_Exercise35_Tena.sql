CREATE DATABASE IF NOT EXISTS `kodego_db` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `kodego_db`;

CREATE TABLE IF NOT EXISTS `kodego_db`.`teacher_tbl` (
	`teacher_id` INT NOT NULL AUTO_INCREMENT
	,`teacher_firstname` VARCHAR(50) NOT NULL
	,`teacher_lastname` VARCHAR(50) NOT NULL
	,`teacher_position` VARCHAR(50) NOT NULL
	,`teacher_batch` INT NOT NULL
	,PRIMARY KEY (`teacher_id`)
);

CREATE TABLE IF NOT EXISTS `kodego_db`.`student_tbl` (
	`student_id` INT NOT NULL AUTO_INCREMENT
	,`student_firstname` VARCHAR(50) NOT NULL
	,`student_lastname` VARCHAR(50) NOT NULL
	,`student_batch` INT NOT NULL
	,PRIMARY KEY (`student_id`)
);

CREATE TABLE IF NOT EXISTS `kodego_db`.`batch_tbl` (
	`batch_id` INT NOT NULL AUTO_INCREMENT
	,`batch_name` VARCHAR(50) NOT NULL
	,`batch_size` INT NOT NULL
	,`batch_teacher` INT NOT NULL
	,PRIMARY KEY (`batch_id`)
);
