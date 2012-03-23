SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

CREATE SCHEMA IF NOT EXISTS `ComicReader` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci ;
USE `ComicReader` ;


-- --------------------------------------------------------


-- -----------------------------------------------------
-- Table `ComicReader`.`Right`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ComicReader`.`Right` ;

CREATE TABLE IF NOT EXISTS `Right` (
  `idRight` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(16) NOT NULL,
  `Read` tinyint(1) NOT NULL,
  `Upload` tinyint(1) NOT NULL,
  `Validate` tinyint(1) NOT NULL,
  `Delete` tinyint(1) NOT NULL,
  PRIMARY KEY (`idRight`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

INSERT INTO `Right` (`idRight`, `Name`, `Read`, `Upload`, `Validate`, `Delete`) VALUES
(1, 'Basic', 1, 0, 0, 0),
(2, 'Advanced', 1, 1, 0, 0),
(3, 'Moderator', 1, 1, 1, 0),
(4, 'Admin', 1, 1, 1, 1);


-- -----------------------------------------------------
-- Table `ComicReader`.`User`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ComicReader`.`User` ;

CREATE  TABLE IF NOT EXISTS `ComicReader`.`User` (
  `idUser` INT NOT NULL AUTO_INCREMENT,
  `RegistrationDate` DATE NOT NULL ,
  `Login` VARCHAR(16) NOT NULL ,
  `Password` VARCHAR(45) NOT NULL ,
  `FK_idRight` INT NULL ,
  PRIMARY KEY (`idUser`) ,
  UNIQUE INDEX `Login_UNIQUE` (`Login` ASC) ,
  INDEX `idRightUser` (`FK_idRight` ASC) ,
  CONSTRAINT `idRightUser`
    FOREIGN KEY (`FK_idRight` )
    REFERENCES `ComicReader`.`Right` (`idRight` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ComicReader`.`Author`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ComicReader`.`Author` ;

CREATE  TABLE IF NOT EXISTS `ComicReader`.`Author` (
  `idAuthor` INT NOT NULL AUTO_INCREMENT ,
  `Name` VARCHAR(16) NOT NULL ,
  `FK_idUser` INT NULL ,
  PRIMARY KEY (`idAuthor`),
  UNIQUE INDEX `AuthorName_UNIQUE` (`Name` ASC) , 
  INDEX `idUserAuthor` (`FK_idUser` ASC) ,
  CONSTRAINT `idUserAuthor`
    FOREIGN KEY (`FK_idUser` )
    REFERENCES `ComicReader`.`User` (`idUser` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ComicReader`.`Category`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ComicReader`.`Category` ;

CREATE  TABLE IF NOT EXISTS `ComicReader`.`Category` (
  `idCategory` INT NOT NULL AUTO_INCREMENT ,
  `Name` VARCHAR(24) NOT NULL ,
  `Description` TEXT NULL ,
  PRIMARY KEY (`idCategory`) ,
  UNIQUE INDEX `Name_UNIQUE` (`Name` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ComicReader`.`Book`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ComicReader`.`Book` ;

CREATE  TABLE IF NOT EXISTS `ComicReader`.`Book` (
  `idBook` INT NOT NULL AUTO_INCREMENT ,
  `Date` DATE NULL ,
  `ServerPath` VARCHAR(45) NOT NULL ,
  `Has_Been_Validated` TINYINT(1) NOT NULL DEFAULT False ,
  `FK_idUser` INT NULL ,
  `FK_idAuthor` INT NULL ,
  `FK_idCategory` INT NULL ,
  PRIMARY KEY (`idBook`) ,
  INDEX `idUserBook` (`FK_idUser` ASC) ,
  INDEX `idAuthorBook` (`FK_idAuthor` ASC) ,
  INDEX `idCategoryBook` (`FK_idCategory` ASC) ,
  UNIQUE INDEX `ServerPath_UNIQUE` (`ServerPath` ASC) ,
  CONSTRAINT `idUserBook`
    FOREIGN KEY (`FK_idUser` )
    REFERENCES `ComicReader`.`User` (`idUser` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `idAuthorBook`
    FOREIGN KEY (`FK_idAuthor` )
    REFERENCES `ComicReader`.`Author` (`idAuthor` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `idCategoryBook`
    FOREIGN KEY (`FK_idCategory` )
    REFERENCES `ComicReader`.`Category` (`idCategory` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ComicReader`.`Mark`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ComicReader`.`Mark` ;

CREATE  TABLE IF NOT EXISTS `ComicReader`.`Mark` (
  `idMark` INT NOT NULL AUTO_INCREMENT ,
  `Date` DATE NULL ,
  `Mark` INT NOT NULL ,
  `Comment` TEXT NULL ,
  `FK_idUser` INT NULL ,
  `FK_idBook` INT NULL ,
  PRIMARY KEY (`idMark`) ,
  INDEX `idUserMark` (`FK_idUser` ASC) ,
  INDEX `idBookMark` (`FK_idBook` ASC) ,
  CONSTRAINT `idUserMark`
    FOREIGN KEY (`FK_idUser` )
    REFERENCES `ComicReader`.`User` (`idUser` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `idBookMark`
    FOREIGN KEY (`FK_idBook` )
    REFERENCES `ComicReader`.`Book` (`idBook` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ComicReader`.`Session`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ComicReader`.`Session` ;

CREATE TABLE IF NOT EXISTS `ComicReader`.`Session` (
  `idSession` INT NULL AUTO_INCREMENT ,
  `Date` DATE NOT NULL ,
  `Token` VARCHAR( 64 ) NOT NULL ,
  `FK_idUser` INT NOT NULL ,
  PRIMARY KEY (`idSession`) ,
  UNIQUE INDEX `Token_UNIQUE` (`Token` ASC) ,
  INDEX `idUserSession` (`FK_idUser` ASC) ,
  CONSTRAINT `idUserSession`
    FOREIGN KEY (`FK_idUser` )
    REFERENCES `ComicReader`.`User` (`idUser` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
) ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
