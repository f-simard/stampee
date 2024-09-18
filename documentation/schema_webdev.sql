SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Table `stampee`.`Devise`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `e2396414`.`Devise` ;

CREATE TABLE IF NOT EXISTS `e2396414`.`Devise` (
  `idDevise` VARCHAR(3) NOT NULL,
  `nom` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idDevise`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `stampee`.`Enchere`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `e2396414`.`Enchere` ;

CREATE TABLE IF NOT EXISTS `e2396414`.`Enchere` (
  `idEnchere` INT NOT NULL AUTO_INCREMENT,
  `dateDebut` TIMESTAMP NOT NULL,
  `dateFin` TIMESTAMP NOT NULL,
  `prixPlancher` FLOAT NOT NULL,
  `estimation` FLOAT NOT NULL,
  `idDevise` VARCHAR(3) NOT NULL,
  `statut` VARCHAR(6) NOT NULL DEFAULT 'CREE',
  `lord` TINYINT NULL,
  PRIMARY KEY (`idEnchere`),
  INDEX `fk_Enchere_Devise1_idx` (`idDevise` ASC) VISIBLE,
  CONSTRAINT `fk_Enchere_Devise1`
    FOREIGN KEY (`idDevise`)
    REFERENCES `e2396414`.`Devise` (`idDevise`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `stampee`.`Pays`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `e2396414`.`Pays` ;

CREATE TABLE IF NOT EXISTS `e2396414`.`Pays` (
  `idPays` VARCHAR(3) NOT NULL,
  `nom` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idPays`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `stampee`.`Langue`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `e2396414`.`Langue` ;

CREATE TABLE IF NOT EXISTS `e2396414`.`Langue` (
  `idLangue` VARCHAR(2) NOT NULL,
  `nom` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idLangue`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `stampee`.`Membre`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `e2396414`.`Membre` ;

CREATE TABLE IF NOT EXISTS `e2396414`.`Membre` (
  `idMembre` INT NOT NULL AUTO_INCREMENT,
  `nom` VARCHAR(45) NOT NULL,
  `prenom` VARCHAR(45) NOT NULL,
  `adresseCivique` VARCHAR(255) NULL,
  `ville` VARCHAR(100) NULL,
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
    REFERENCES `e2396414`.`Devise` (`idDevise`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Membre_Pays1`
    FOREIGN KEY (`idPays`)
    REFERENCES `e2396414`.`Pays` (`idPays`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Membre_Langue1`
    FOREIGN KEY (`idLangue`)
    REFERENCES `e2396414`.`Langue` (`idLangue`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `stampee`.`Timbre`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `e2396414`.`Timbre` ;

CREATE TABLE IF NOT EXISTS `e2396414`.`Timbre` (
  `idTimbre` INT NOT NULL AUTO_INCREMENT,
  `titre` VARCHAR(100) NOT NULL,
  `description` VARCHAR(120) NULL,
  `anneeProd` INT NOT NULL,
  `tirage` INT NULL,
  `hauteur` DOUBLE NOT NULL,
  `largeur` DOUBLE NOT NULL,
  `certifie` TINYINT NOT NULL,
  `datePublication` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `idMembre` INT NOT NULL,
  PRIMARY KEY (`idTimbre`),
  INDEX `fk_Timbre_Membre1_idx` (`idMembre` ASC) VISIBLE,
  CONSTRAINT `fk_Timbre_Membre1`
    FOREIGN KEY (`idMembre`)
    REFERENCES `e2396414`.`Membre` (`idMembre`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `stampee`.`Image`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `e2396414`.`Image` ;

CREATE TABLE IF NOT EXISTS `e2396414`.`Image` (
  `idImage` INT NOT NULL AUTO_INCREMENT,
  `chemin` VARCHAR(255) NOT NULL,
  `idTimbre` INT NOT NULL,
  `principale` TINYINT NULL DEFAULT 0,
  PRIMARY KEY (`idImage`, `idTimbre`),
  INDEX `fk_Image_Timbre1_idx` (`idTimbre` ASC) VISIBLE,
  CONSTRAINT `fk_Image_Timbre1`
    FOREIGN KEY (`idTimbre`)
    REFERENCES `e2396414`.`Timbre` (`idTimbre`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `stampee`.`Enchere_has_Timbre`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `e2396414`.`Enchere_has_Timbre` ;

CREATE TABLE IF NOT EXISTS `e2396414`.`Enchere_has_Timbre` (
  `idTimbre` INT NOT NULL,
  `idEnchere` INT NOT NULL,
  PRIMARY KEY (`idTimbre`, `idEnchere`),
  INDEX `fk_Timbre_has_Enchere_Enchere1_idx` (`idEnchere` ASC) VISIBLE,
  UNIQUE INDEX `idTimbre_UNIQUE` (`idTimbre` ASC) VISIBLE,
  CONSTRAINT `fk_Timbre_has_Enchere_Timbre1`
    FOREIGN KEY (`idTimbre`)
    REFERENCES `e2396414`.`Timbre` (`idTimbre`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Timbre_has_Enchere_Enchere1`
    FOREIGN KEY (`idEnchere`)
    REFERENCES `e2396414`.`Enchere` (`idEnchere`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `stampee`.`Favori`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `e2396414`.`Favori` ;

CREATE TABLE IF NOT EXISTS `e2396414`.`Favori` (
  `idMembre` INT NOT NULL,
  `idEnchere` INT NOT NULL,
  PRIMARY KEY (`idMembre`, `idEnchere`),
  INDEX `fk_Membre_has_Enchere_Enchere1_idx` (`idEnchere` ASC) VISIBLE,
  INDEX `fk_Membre_has_Enchere_Membre1_idx` (`idMembre` ASC) VISIBLE,
  CONSTRAINT `fk_Membre_has_Enchere_Membre1`
    FOREIGN KEY (`idMembre`)
    REFERENCES `e2396414`.`Membre` (`idMembre`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Membre_has_Enchere_Enchere1`
    FOREIGN KEY (`idEnchere`)
    REFERENCES `e2396414`.`Enchere` (`idEnchere`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `stampee`.`Mise`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `e2396414`.`Mise` ;

CREATE TABLE IF NOT EXISTS `e2396414`.`Mise` (
  `Membre_idMembre` INT NOT NULL,
  `Enchere_idEnchere` INT NOT NULL,
  `montant` FLOAT NOT NULL,
  `dateCreation` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`Membre_idMembre`, `Enchere_idEnchere`),
  INDEX `fk_Membre_has_Enchere_Enchere2_idx` (`Enchere_idEnchere` ASC) VISIBLE,
  INDEX `fk_Membre_has_Enchere_Membre2_idx` (`Membre_idMembre` ASC) VISIBLE,
  CONSTRAINT `fk_Membre_has_Enchere_Membre2`
    FOREIGN KEY (`Membre_idMembre`)
    REFERENCES `e2396414`.`Membre` (`idMembre`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Membre_has_Enchere_Enchere2`
    FOREIGN KEY (`Enchere_idEnchere`)
    REFERENCES `e2396414`.`Enchere` (`idEnchere`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
