-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema BDUSUARIOS
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema BDUSUARIOS
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `BDUSUARIOS` DEFAULT CHARACTER SET utf8 ;
USE `BDUSUARIOS` ;

-- -----------------------------------------------------
-- Table `BDUSUARIOS`.`estado`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `BDUSUARIOS`.`estado` (
  `idEstado` INT NOT NULL,
  `descripcion` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idEstado`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `BDUSUARIOS`.`usuarios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `BDUSUARIOS`.`usuarios` (
  `idusuarios` INT NOT NULL AUTO_INCREMENT,
  `mail` VARCHAR(55) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `estado_idEstado` INT NOT NULL,
  PRIMARY KEY (`idusuarios`),
  INDEX `fk_usuarios_estado1_idx` (`estado_idEstado` ASC) ,
  UNIQUE INDEX `mail_UNIQUE` (`mail` ASC) ,
  CONSTRAINT `fk_usuarios_estado1`
    FOREIGN KEY (`estado_idEstado`)
    REFERENCES `BDUSUARIOS`.`estado` (`idEstado`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `BDUSUARIOS`.`seguimientoproducto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `BDUSUARIOS`.`seguimientoproducto` (
  `idhistorial` INT NOT NULL AUTO_INCREMENT,
  `detalle_del_historial` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`idhistorial`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `BDUSUARIOS`.`usuarios_has_seguimientoproducto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `BDUSUARIOS`.`usuarios_has_seguimientoproducto` (
  `usuarios_idusuarios` INT NOT NULL,
  `seguimientoproducto_idhistorial` INT NOT NULL,
  `fecha` DATE NOT NULL,
  PRIMARY KEY (`usuarios_idusuarios`, `seguimientoproducto_idhistorial`),
  INDEX `fk_usuarios_has_seguimientoproducto_seguimientoproducto1_idx` (`seguimientoproducto_idhistorial` ASC) ,
  INDEX `fk_usuarios_has_seguimientoproducto_usuarios_idx` (`usuarios_idusuarios` ASC) ,
  CONSTRAINT `fk_usuarios_has_seguimientoproducto_usuarios`
    FOREIGN KEY (`usuarios_idusuarios`)
    REFERENCES `BDUSUARIOS`.`usuarios` (`idusuarios`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuarios_has_seguimientoproducto_seguimientoproducto1`
    FOREIGN KEY (`seguimientoproducto_idhistorial`)
    REFERENCES `BDUSUARIOS`.`seguimientoproducto` (`idhistorial`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
