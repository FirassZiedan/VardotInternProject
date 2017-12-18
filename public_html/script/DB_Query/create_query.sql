-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema internproject
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema internproject
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `internproject` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `internproject` ;

-- -----------------------------------------------------
-- Table `internproject`.`levels`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `internproject`.`levels` ;

CREATE TABLE IF NOT EXISTS `internproject`.`levels` (
  `l_id` INT(2) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(16) NOT NULL,
  PRIMARY KEY (`l_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `internproject`.`users`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `internproject`.`users` ;

CREATE TABLE IF NOT EXISTS `internproject`.`users` (
  `u_id` SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_name` VARCHAR(32) NOT NULL,
  `display_name` VARCHAR(64) NULL,
  `Password` VARCHAR(32) NOT NULL,
  `email` VARCHAR(45) NULL,
  `level` INT(2) NOT NULL DEFAULT 1,
  `last_login` DATETIME NULL,
  PRIMARY KEY (`u_id`),
  INDEX `fk_users_l_id_idx` (`level` ASC),
  CONSTRAINT `fk_users_l_id`
    FOREIGN KEY (`level`)
    REFERENCES `internproject`.`levels` (`l_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `internproject`.`types`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `internproject`.`types` ;

CREATE TABLE IF NOT EXISTS `internproject`.`types` (
  `t_id` INT NOT NULL,
  `title` VARCHAR(64) NOT NULL,
  PRIMARY KEY (`t_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `internproject`.`files`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `internproject`.`files` ;

CREATE TABLE IF NOT EXISTS `internproject`.`files` (
  `f_id` SMALLINT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `path` VARCHAR(64) NOT NULL,
  `caption` VARCHAR(45) NULL,
  `type_id` INT NULL,
  PRIMARY KEY (`f_id`),
  INDEX `fk_files_typeid_idx` (`type_id` ASC),
  CONSTRAINT `fk_files_typeid`
    FOREIGN KEY (`type_id`)
    REFERENCES `internproject`.`types` (`t_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `internproject`.`places`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `internproject`.`places` ;

CREATE TABLE IF NOT EXISTS `internproject`.`places` (
  `p_id` SMALLINT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(64) NOT NULL,
  PRIMARY KEY (`p_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `internproject`.`node`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `internproject`.`node` ;

CREATE TABLE IF NOT EXISTS `internproject`.`node` (
  `n_id` SMALLINT NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(256) NOT NULL,
  `description` BLOB NOT NULL,
  `date` DATE NOT NULL,
  `u_id` SMALLINT NULL,
  `type` SMALLINT NULL,
  PRIMARY KEY (`n_id`),
  INDEX `fk_Node_UID_idx` (`u_id` ASC),
  INDEX `fk_Node_Type_idx` (`type` ASC),
  CONSTRAINT `fk_Node_UID`
    FOREIGN KEY (`u_id`)
    REFERENCES `internproject`.`users` (`u_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Node_Type`
    FOREIGN KEY (`type`)
    REFERENCES `internproject`.`types` (`t_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `internproject`.`event_filed`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `internproject`.`event_filed` ;

CREATE TABLE IF NOT EXISTS `internproject`.`event_filed` (
  `e_id` SMALLINT NOT NULL AUTO_INCREMENT,
  `time_start` TIME NOT NULL,
  `time_end` TIME NOT NULL,
  `f_id` SMALLINT NOT NULL,
  `place` SMALLINT NOT NULL,
  `n_id` SMALLINT NOT NULL,
  PRIMARY KEY (`e_id`),
  INDEX `fk_Event_pic_idx` (`f_id` ASC),
  INDEX `fk_Event_Place_idx` (`place` ASC),
  INDEX `fk_Event_NID_idx` (`n_id` ASC),
  CONSTRAINT `fk_Event_pic`
    FOREIGN KEY (`f_id`)
    REFERENCES `internproject`.`files` (`f_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Event_Place`
    FOREIGN KEY (`place`)
    REFERENCES `internproject`.`places` (`p_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Event_NID`
    FOREIGN KEY (`n_id`)
    REFERENCES `internproject`.`node` (`n_id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `internproject`.`submitions`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `internproject`.`submitions` ;

CREATE TABLE IF NOT EXISTS `internproject`.`submitions` (
  `s_id` INT NOT NULL,
  `name` VARCHAR(45) NOT NULL,
  `phone` DECIMAL(15) NULL,
  `email` VARCHAR(45) NULL,
  `message` TEXT NOT NULL,
  `date` DATETIME NULL,
  `status` INT(2) NULL,
  PRIMARY KEY (`s_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `internproject`.`features`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `internproject`.`features` ;

CREATE TABLE IF NOT EXISTS `internproject`.`features` (
  `fe_id` SMALLINT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `url` VARCHAR(45) NULL,
  `f_id` SMALLINT NOT NULL,
  PRIMARY KEY (`fe_id`),
  INDEX `fk_Features_FID_idx` (`f_id` ASC),
  CONSTRAINT `fk_Features_FID`
    FOREIGN KEY (`f_id`)
    REFERENCES `internproject`.`files` (`f_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
