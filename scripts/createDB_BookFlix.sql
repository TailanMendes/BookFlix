SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `bookflix` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;

USE `bookflix`;

CREATE  TABLE IF NOT EXISTS `bookflix`.`usuario` (
  `usucodigo` INT(11) NOT NULL AUTO_INCREMENT ,
  `usunome` VARCHAR(100) NOT NULL ,
  `usuemail` VARCHAR(60) NOT NULL ,
  `ususenha` VARCHAR(45) NOT NULL ,
  `usutelefone` INT(11) NULL DEFAULT NULL ,
  PRIMARY KEY (`usucodigo`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;

CREATE  TABLE IF NOT EXISTS `bookflix`.`autor` (
  `autcodigo` INT(11) NOT NULL AUTO_INCREMENT ,
  `autnome` VARCHAR(100) NOT NULL ,
  PRIMARY KEY (`autcodigo`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;

CREATE  TABLE IF NOT EXISTS `bookflix`.`livro` (
  `livcodigo` INT(11) NOT NULL AUTO_INCREMENT ,
  `livautcodigo` INT(11) NOT NULL ,
  `livgencodigo` INT(11) NOT NULL ,
  `livnome` VARCHAR(100) NOT NULL ,
  `livanopublicacao` VARCHAR(45) NOT NULL ,
  `livrlocalsalvo` VARCHAR(500) NOT NULL ,
  `livthumb` VARCHAR(500) NOT NULL ,
  PRIMARY KEY (`livcodigo`) ,
  INDEX `fk_livro_autor_idx` (`livautcodigo` ASC) ,
  INDEX `fk_livro_genero1_idx` (`livgencodigo` ASC) ,
  CONSTRAINT `fk_livro_autor`
    FOREIGN KEY (`livautcodigo` )
    REFERENCES `bookflix`.`autor` (`autcodigo` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_livro_genero1`
    FOREIGN KEY (`livgencodigo` )
    REFERENCES `bookflix`.`genero` (`gencodigo` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;

CREATE  TABLE IF NOT EXISTS `bookflix`.`booklido` (
  `boolidusucodigo` INT(11) NOT NULL ,
  `boolidlivcodigo` INT(11) NOT NULL ,
  PRIMARY KEY (`boolidusucodigo`, `boolidlivcodigo`) ,
  INDEX `fk_usuario_has_autor_usuario1_idx` (`boolidusucodigo` ASC) ,
  INDEX `fk_booklido_livro1_idx` (`boolidlivcodigo` ASC) ,
  CONSTRAINT `fk_usuario_has_autor_usuario1`
    FOREIGN KEY (`boolidusucodigo` )
    REFERENCES `bookflix`.`usuario` (`usucodigo` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_booklido_livro1`
    FOREIGN KEY (`boolidlivcodigo` )
    REFERENCES `bookflix`.`livro` (`livcodigo` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;

CREATE  TABLE IF NOT EXISTS `bookflix`.`genero` (
  `gencodigo` INT(11) NOT NULL AUTO_INCREMENT ,
  `gennome` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`gencodigo`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
