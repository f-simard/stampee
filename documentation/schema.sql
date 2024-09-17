-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema stampee
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema stampee
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `stampee` DEFAULT CHARACTER SET utf8 ;
USE `stampee` ;

-- -----------------------------------------------------
-- Table `stampee`.`Devise`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `stampee`.`Devise` ;

CREATE TABLE IF NOT EXISTS `stampee`.`Devise` (
  `idDevise` VARCHAR(3) NOT NULL,
  `nom` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idDevise`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `stampee`.`Enchere`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `stampee`.`Enchere` ;

CREATE TABLE IF NOT EXISTS `stampee`.`Enchere` (
  `idEnchere` INT NOT NULL AUTO_INCREMENT,
  `dateDebut` TIMESTAMP NOT NULL,
  `dateFin` TIMESTAMP NOT NULL,
  `prixPlancher` FLOAT NOT NULL,
  `estimation` FLOAT NOT NULL,
  `idDevise` VARCHAR(3) NOT NULL,
    `statut` VARCHAR(6) NOT NULL,
  PRIMARY KEY (`idEnchere`),
  INDEX `fk_Enchere_Devise1_idx` (`idDevise` ASC) VISIBLE,
  CONSTRAINT `fk_Enchere_Devise1`
    FOREIGN KEY (`idDevise`)
    REFERENCES `stampee`.`Devise` (`idDevise`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `stampee`.`Pays`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `stampee`.`Pays` ;

CREATE TABLE IF NOT EXISTS `stampee`.`Pays` (
  `idPays` VARCHAR(3) NOT NULL,
  `nom` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idPays`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `stampee`.`Langue`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `stampee`.`Langue` ;

CREATE TABLE IF NOT EXISTS `stampee`.`Langue` (
  `idLangue` VARCHAR(2) NOT NULL,
  `nom` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idLangue`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `stampee`.`Membre`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `stampee`.`Membre` ;

CREATE TABLE IF NOT EXISTS `stampee`.`Membre` (
  `idMembre` INT NOT NULL AUTO_INCREMENT,
  `nom` VARCHAR(45) NOT NULL,
  `prenom` VARCHAR(45) NOT NULL,
  `adresseCivique` VARCHAR(45) NULL,
  `ville` VARCHAR(45) NULL,
  `nomUtilisateur` VARCHAR(45) NOT NULL,
  `motDePasse` VARCHAR(255) NOT NULL,
  `codePostal` VARCHAR(7) NULL,
  `courriel` VARCHAR(100) NULL,
  `estAdmin` TINYINT(4) NULL DEFAULT '0',
  `avatar` VARCHAR(255) NULL DEFAULT NULL,
  `idDevise` VARCHAR(3) NOT NULL,
  `idPays` VARCHAR(3) NOT NULL,
  `idLangue` VARCHAR(2) NOT NULL,
  PRIMARY KEY (`idMembre`),
  UNIQUE INDEX `courriel_UNIQUE` (`courriel` ASC) VISIBLE,
  UNIQUE INDEX `nomUtilisateur_UNIQUE` (`nomUtilisateur` ASC) VISIBLE,
  INDEX `fk_Membre_Devise1_idx` (`idDevise` ASC) VISIBLE,
  INDEX `fk_Membre_Pays1_idx` (`idPays` ASC) VISIBLE,
  INDEX `fk_Membre_Langue1_idx` (`idLangue` ASC) VISIBLE,
  CONSTRAINT `fk_Membre_Devise1`
    FOREIGN KEY (`idDevise`)
    REFERENCES `stampee`.`Devise` (`idDevise`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Membre_Pays1`
    FOREIGN KEY (`idPays`)
    REFERENCES `stampee`.`Pays` (`idPays`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Membre_Langue1`
    FOREIGN KEY (`idLangue`)
    REFERENCES `stampee`.`Langue` (`idLangue`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb3;


-- -----------------------------------------------------
-- Table `stampee`.`Timbre`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `stampee`.`Timbre` ;

CREATE TABLE IF NOT EXISTS `stampee`.`Timbre` (
  `idTimbre` INT NOT NULL AUTO_INCREMENT,
  `titre` VARCHAR(100) NOT NULL,
  `description` VARCHAR(120) NULL,
  `anneeProd` INT NOT NULL,
  `tirage` INT NULL,
  `hauteur` DOUBLE NOT NULL,
  `largeur` DOUBLE NOT NULL,
  `certifie` TINYINT NOT NULL,
  `lord` TINYINT NULL,
  `datePublication` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `idMembre` INT NOT NULL,
  PRIMARY KEY (`idTimbre`),
  INDEX `fk_Timbre_Membre1_idx` (`idMembre` ASC) VISIBLE,
  CONSTRAINT `fk_Timbre_Membre1`
    FOREIGN KEY (`idMembre`)
    REFERENCES `stampee`.`Membre` (`idMembre`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `stampee`.`Image`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `stampee`.`Image` ;

CREATE TABLE IF NOT EXISTS `stampee`.`Image` (
  `idImage` INT NOT NULL AUTO_INCREMENT,
  `chemin` VARCHAR(255) NOT NULL,
  `idTimbre` INT NOT NULL,
  `principale` TINYINT NULL DEFAULT 0,
  PRIMARY KEY (`idImage`, `idTimbre`),
  INDEX `fk_Image_Timbre1_idx` (`idTimbre` ASC) VISIBLE,
  CONSTRAINT `fk_Image_Timbre1`
    FOREIGN KEY (`idTimbre`)
    REFERENCES `stampee`.`Timbre` (`idTimbre`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `stampee`.`Enchere_has_Timbre`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `stampee`.`Enchere_has_Timbre` ;

CREATE TABLE IF NOT EXISTS `stampee`.`Enchere_has_Timbre` (
  `idTimbre` INT NOT NULL,
  `idEnchere` INT NOT NULL,
  PRIMARY KEY (`idTimbre`, `idEnchere`),
  INDEX `fk_Timbre_has_Enchere_Enchere1_idx` (`idEnchere` ASC) VISIBLE,
  UNIQUE INDEX `idTimbre_UNIQUE` (`idTimbre` ASC) VISIBLE,
  CONSTRAINT `fk_Timbre_has_Enchere_Timbre1`
    FOREIGN KEY (`idTimbre`)
    REFERENCES `stampee`.`Timbre` (`idTimbre`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Timbre_has_Enchere_Enchere1`
    FOREIGN KEY (`idEnchere`)
    REFERENCES `stampee`.`Enchere` (`idEnchere`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `stampee`.`Mise`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `stampee`.`Mise` ;

CREATE TABLE IF NOT EXISTS `stampee`.`Mise` (
  `idMembre` INT NOT NULL,
  `idTimbre` INT NOT NULL,
  `idEnchere` INT NOT NULL,
  `montant` FLOAT NOT NULL,
  `dateCreation` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idMembre`, `idTimbre`, `idEnchere`, `montant`),
  INDEX `fk_Membre_has_Timbre_has_Enchere_Timbre_has_Enchere1_idx` (`idTimbre` ASC, `idEnchere` ASC) VISIBLE,
  INDEX `fk_Membre_has_Timbre_has_Enchere_Membre1_idx` (`idMembre` ASC) VISIBLE,
  CONSTRAINT `fk_Membre_has_Timbre_has_Enchere_Membre1`
    FOREIGN KEY (`idMembre`)
    REFERENCES `stampee`.`Membre` (`idMembre`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Membre_has_Timbre_has_Enchere_Timbre_has_Enchere1`
    FOREIGN KEY (`idTimbre` , `idEnchere`)
    REFERENCES `stampee`.`Enchere_has_Timbre` (`idTimbre` , `idEnchere`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `stampee`.`Favori`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `stampee`.`Favori` ;

CREATE TABLE IF NOT EXISTS `stampee`.`Favori` (
  `idMembre` INT NOT NULL,
  `idEnchere` INT NOT NULL,
  PRIMARY KEY (`idMembre`, `idEnchere`),
  INDEX `fk_Membre_has_Enchere_Enchere1_idx` (`idEnchere` ASC) VISIBLE,
  INDEX `fk_Membre_has_Enchere_Membre1_idx` (`idMembre` ASC) VISIBLE,
  CONSTRAINT `fk_Membre_has_Enchere_Membre1`
    FOREIGN KEY (`idMembre`)
    REFERENCES `stampee`.`Membre` (`idMembre`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Membre_has_Enchere_Enchere1`
    FOREIGN KEY (`idEnchere`)
    REFERENCES `stampee`.`Enchere` (`idEnchere`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
