-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema colombes2
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `colombes2` ;

-- -----------------------------------------------------
-- Schema colombes2
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `colombes2` DEFAULT CHARACTER SET utf8mb4 ;
USE `colombes2` ;

-- -----------------------------------------------------
-- Table `colombes2`.`students`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `colombes2`.`students` (
  `idstu` INT NOT NULL AUTO_INCREMENT,
  `fname` VARCHAR(45) NOT NULL,
  `dob` DATETIME NULL,
  `sex` ENUM('F', 'M') NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `region` VARCHAR(100) NULL,
  `zip` VARCHAR(5) NULL,
  PRIMARY KEY (`idstu`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `colombes2`.`teachers`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `colombes2`.`teachers` (
  `idteach` INT NOT NULL AUTO_INCREMENT,
  `fname` VARCHAR(45) NOT NULL,
  `grade` TINYINT NOT NULL,
  `picture` MEDIUMBLOB NULL,
  PRIMARY KEY (`idteach`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `colombes2`.`courses`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `colombes2`.`courses` (
  `idcur` CHAR(5) NOT NULL,
  `title` VARCHAR(100) NOT NULL,
  `duration` TINYINT NOT NULL,
  `idteach` INT NOT NULL,
  PRIMARY KEY (`idcur`),
  INDEX `fk_courses_teachers_idx` (`idteach` ASC),
  CONSTRAINT `fk_courses_teachers`
    FOREIGN KEY (`idteach`)
    REFERENCES `colombes2`.`teachers` (`idteach`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `colombes2`.`follows`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `colombes2`.`follows` (
  `idstu` INT NOT NULL,
  `idcur` CHAR(5) NOT NULL,
  `notation` FLOAT NULL,
  PRIMARY KEY (`idstu`, `idcur`),
  INDEX `fk_students_has_courses_courses1_idx` (`idcur` ASC),
  INDEX `fk_students_has_courses_students1_idx` (`idstu` ASC),
  CONSTRAINT `fk_students_has_courses_students1`
    FOREIGN KEY (`idstu`)
    REFERENCES `colombes2`.`students` (`idstu`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_students_has_courses_courses1`
    FOREIGN KEY (`idcur`)
    REFERENCES `colombes2`.`courses` (`idcur`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
