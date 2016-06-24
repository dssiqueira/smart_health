-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema smart_health
-- -----------------------------------------------------
-- DROP SCHEMA IF EXISTS `smart_health` ;

-- -----------------------------------------------------
-- Schema smart_health
-- -----------------------------------------------------
-- CREATE SCHEMA IF NOT EXISTS `smart_health` DEFAULT CHARACTER SET utf8 ;
USE `comovejoomundo07` ;

-- -----------------------------------------------------
-- Table `smart_health`.`apps`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `comovejoomundo07`.`apps` ;

CREATE TABLE IF NOT EXISTS `comovejoomundo07`.`apps` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `deleted` INT NOT NULL DEFAULT 0,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  `name` VARCHAR(50) CHARACTER SET 'utf8' NOT NULL,
  `client_id` VARCHAR(50) CHARACTER SET 'utf8' NULL DEFAULT NULL,
  `client_secret` VARCHAR(50) CHARACTER SET 'utf8' NULL DEFAULT NULL,
  `url` VARCHAR(255) NOT NULL,
  `image_path` VARCHAR(50) NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `appid_UNIQUE` (`id` ASC),
  UNIQUE INDEX `name_UNIQUE` (`name` ASC))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `smart_health`.`users`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `comovejoomundo07`.`users` ;

CREATE TABLE IF NOT EXISTS `comovejoomundo07`.`users` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `deleted` INT NOT NULL DEFAULT 0,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  `email` VARCHAR(50) CHARACTER SET 'utf8' NULL DEFAULT NULL,
  `name` VARCHAR(50) CHARACTER SET 'utf8' NULL DEFAULT NULL,
  `image_path` VARCHAR(200) CHARACTER SET 'utf8' NULL DEFAULT NULL,
  `password` VARCHAR(255) NULL DEFAULT NULL,
  `role` VARCHAR(10) NOT NULL DEFAULT 'user',  
  `remember_token` VARCHAR(255) NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `UID_UNIQUE` (`id` ASC),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `smart_health`.`integrations`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `comovejoomundo07`.`integrations` ;

CREATE TABLE IF NOT EXISTS `comovejoomundo07`.`integrations` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `deleted` INT NOT NULL DEFAULT 0,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  `app_id` INT(11) NOT NULL,
  `user_id` INT(11) NOT NULL,
  `token` VARCHAR(50) CHARACTER SET 'utf8' NULL DEFAULT NULL,
  PRIMARY KEY (`id`, `app_id`, `user_id`),
  UNIQUE INDEX `iid_UNIQUE` (`id` ASC),
  INDEX `fk_appid_idx` (`app_id` ASC),
  INDEX `fk_uid_idx` (`user_id` ASC),
  CONSTRAINT `fk_appid`
    FOREIGN KEY (`app_id`)
    REFERENCES `comovejoomundo07`.`apps` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_uid`
    FOREIGN KEY (`user_id`)
    REFERENCES `comovejoomundo07`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `smart_health`.`activities`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `comovejoomundo07`.`activities` ;

CREATE TABLE IF NOT EXISTS `comovejoomundo07`.`activities` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `deleted` INT NOT NULL DEFAULT 0,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  `integration_id` INT(11) NULL DEFAULT NULL,
  `type` VARCHAR(50) CHARACTER SET 'utf8' NULL DEFAULT NULL,
  `start_date` INT NOT NULL,
  `distance` DECIMAL(12,8) NOT NULL DEFAULT 0,
  `calories` DECIMAL(10,2) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `aid_UNIQUE` (`id` ASC),
  INDEX `fk_iid_idx` (`integration_id` ASC),
  CONSTRAINT `fk_iid`
    FOREIGN KEY (`integration_id`)
    REFERENCES `comovejoomundo07`.`integrations` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `smart_health`.`votes`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `comovejoomundo07`.`polls` ;

CREATE TABLE IF NOT EXISTS `comovejoomundo07`.`polls` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `deleted` INT NOT NULL DEFAULT 0,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  `user_id` INT NULL DEFAULT NULL,
  `poll` VARCHAR(20) NULL DEFAULT NULL,
  `vote` VARCHAR(20) NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `vid_UNIQUE` (`id` ASC),
  INDEX `fk_user_idx` (`user_id` ASC),
  CONSTRAINT `fk_user`
    FOREIGN KEY (`user_id`)
    REFERENCES `comovejoomundo07`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;




-- -----------------------------------------------------
-- Data `apps`
-- -----------------------------------------------------
INSERT INTO `apps` (`created_at`,`updated_at`,`name`,`url`) VALUES
(NOW(),NOW(),'Runkeeper','https://runkeeper.com'),
(NOW(),NOW(),'Strava','https://www.strava.com'),
(NOW(),NOW(),'Google Fit','https://www.google.com/fit'),
(NOW(),NOW(),'Nike+ Running','http://www.nikeplus.com.br'),
(NOW(),NOW(),'Adidas Run','http://www.global.adidas.com/running'),
(NOW(),NOW(),'S Health','http://shealth.samsung.com'),
(NOW(),NOW(),'MapMyRun','http://www.mapmyrun.com'),
(NOW(),NOW(),'Endomondo','https://www.endomondo.com'),
(NOW(),NOW(),'Runtastic','https://www.runtastic.com');


-- -----------------------------------------------------
-- Data `user`
-- -----------------------------------------------------
INSERT INTO `users` (`created_at`,`updated_at`,`email`, `name`, `image_path`, `role`, `remember_token`) VALUES

(NOW(),NOW(), 'hguidi@ciandt.com', 'Henrique Guidi', 'https://lh3.googleusercontent.com/-onzFk19sFpQ/AAAAAAAAAAI/AAAAAAAABvY/Y3UhVdy3blo/s96-c/photo.jpg','admin','token_00000001'),
(NOW(),NOW(), 'douglass@ciandt.com', 'Douglas de Siqueira Silva', 'https://lh4.googleusercontent.com/-7VQwiIQW9tc/AAAAAAAAAAI/AAAAAAAAABE/05PlkhseRBk/s96-c/photo.jpg','admin','token_00000002'),
(NOW(),NOW(), 'joaopauloc@ciandt.com', 'João Paulo Constantino', 'https://lh3.googleusercontent.com/-FA8BCqUSB3M/AAAAAAAAAAI/AAAAAAAAABI/e3edhagZQfU/s96-c/photo.jpg','user','token_00000003'),
(NOW(),NOW(), 'veugenio@ciandt.com', 'Vicente Eugenio', 'https://lh3.googleusercontent.com/-DX0zi2VGv8w/AAAAAAAAAAI/AAAAAAAAABI/JvxlIQa_N_g/s96-c/photo.jpg','user','token_00000004'),
(NOW(),NOW(), 'psouza@ciandt.com', 'Paula Rosa', 'https://lh6.googleusercontent.com/-1Z6DG-En-Xg/AAAAAAAAAAI/AAAAAAAAABk/MixZvcvk-qs/s96-c/photo.jpg','user','token_00000005'),
(NOW(),NOW(), 'gdutra@ciandt.com', 'Gabriel Dutra', 'https://lh5.googleusercontent.com/-4vNRz3rr10k/AAAAAAAAAAI/AAAAAAAAAA8/b75p1Z97mOk/s96-c/photo.jpg','user','token_00000006'),
(NOW(),NOW(), 'helio@ciandt.com', 'Helio Baptista Martins', 'https://lh4.googleusercontent.com/-h1tvLbjQpbI/AAAAAAAAAAI/AAAAAAAACNY/4AexD1vRsUo/s96-c/photo.jpg','user','token_00000007'),
(NOW(),NOW(), 'fborgato@ciandt.com', 'Felipe Dourado Borgato', 'https://lh4.googleusercontent.com/-fWGugi2JGfQ/AAAAAAAAAAI/AAAAAAAABJw/5NU8kfWI2zw/s96-c/photo.jpg','user','token_00000008'),
(NOW(),NOW(), 'isabela@ciandt.com', 'Isabela Nogueira', 'https://lh6.googleusercontent.com/-R3VHSElVR0A/AAAAAAAAAAI/AAAAAAAAAXc/qstCC3DGK38/s96-c/photo.jpg','user','token_00000009'),
(NOW(),NOW(), 'vcampos@ciandt.com', 'Victor Campos Silva', 'https://lh4.googleusercontent.com/-nD6z1B2d1_k/AAAAAAAAAAI/AAAAAAAAABc/3rNeXNobcrI/s96-c/photo.jpg','user','token_00000010'),
(NOW(),NOW(), 'cyrillo@ciandt.com', 'Mars Cyrillo', 'https://lh4.googleusercontent.com/-e2ihE1RW1yg/AAAAAAAAAAI/AAAAAAABXY8/Aj-x_4KND6o/s96-c/photo.jpg','user','token_00000011'),
(NOW(),NOW(), 'gon@ciandt.com', 'Cesar Gon', 'https://lh4.googleusercontent.com/-uYPQ6E3p04g/AAAAAAAAAAI/AAAAAAAACJk/bvv_YCTtkx8/s96-c/photo.jpg','user','token_00000012');


-- -----------------------------------------------------
-- Data `integrations`
-- -----------------------------------------------------
INSERT INTO `integrations` (`created_at`,`updated_at`,`app_id`, `user_id`, `token`) VALUES

(NOW(),NOW(), 2, 1, '4038c629fa2040b6bc262100fce26598'),
(NOW(),NOW(), 2, 2, '40ddb9d8a9fe4c4799e0459cbab8d9e8'),
(NOW(),NOW(), 1, 1, '13e41c2000090936c62ebb4d70dc6c15495b133b'),
(NOW(),NOW(), 1, 2, '319fbc49228dbe35a5e52d1c0e16c07d2a21295f'),
(NOW(),NOW(), 1, 5, 'e4e863805d09773c700bd6b02ba39a5697a8daaf');


-- -----------------------------------------------------
-- Data `activities`
-- -----------------------------------------------------
INSERT INTO `activities` (`created_at`,`updated_at`,`integration_id`, `type`, `start_date`, `distance`, `calories`) VALUES
(NOW(),NOW(), 1, 'Running', 1453847538, '5323.79073217', '417'),
(NOW(),NOW(), 2, 'Run', 1465513534, '49.1', '0'),
(NOW(),NOW(), 3, 'Running', 1464472620, '3410.82323356', '325');


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
