-- MySQL Workbench Synchronization
-- Generated: 2020-04-01 12:49
-- Model: New Model
-- Version: 1.0
-- Project: Name of the project
-- Author: hondu

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

CREATE SCHEMA IF NOT EXISTS `psjb_db` DEFAULT CHARACTER SET utf8 ;

CREATE TABLE IF NOT EXISTS `psjb_db`.`user` (
  `userCod` BIGINT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `userEmail` VARCHAR(80) NOT NULL,
  `userName` VARCHAR(80) NULL DEFAULT NULL,
  `userPswd` VARCHAR(128) NOT NULL,
  `userRgstrd` DATETIME NULL DEFAULT NULL,
  `userPswdState` CHAR(3) NULL DEFAULT NULL,
  `userPswdExp` DATETIME NULL DEFAULT NULL,
  `userState` CHAR(3) NULL DEFAULT NULL,
  `userVrfd` VARCHAR(128) NULL DEFAULT NULL,
  `userPswdChg` VARCHAR(128) NULL DEFAULT NULL,
  `userCell` VARCHAR(40) NULL DEFAULT NULL,
  `userLL` DATETIME NULL DEFAULT NULL,
  `userLM` DATETIME NULL DEFAULT NULL,
  `userMaxOrder` TINYINT(3) UNSIGNED NULL DEFAULT NULL,
  PRIMARY KEY (`userCod`),
  UNIQUE INDEX `userMail_UNIQUE` (`userEmail` ASC) ,
  INDEX `userState_idx` (`userState` ASC),
  INDEX `userPswdStateF_idx` (`userPswdState` ASC)  ,
  CONSTRAINT `userStateF`
    FOREIGN KEY (`userState`)
    REFERENCES `psjb_db`.`state` (`stateCod`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `userPswdStateF`
    FOREIGN KEY (`userPswdState`)
    REFERENCES `psjb_db`.`state` (`stateCod`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `psjb_db`.`state` (
  `stateCod` CHAR(3) NOT NULL,
  `stateDsc` VARCHAR(80) NULL DEFAULT NULL,
  PRIMARY KEY (`stateCod`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `psjb_db`.`direction` (
  `directCod` BIGINT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `userCodD` BIGINT(10) UNSIGNED NOT NULL,
  `hoodCodFK` INT(10) UNSIGNED NOT NULL,
  `directStreet` VARCHAR(254) NULL DEFAULT NULL,
  PRIMARY KEY (`directCod`, `userCodD`, `hoodCodFK`),
  INDEX `hoodCod_idx` (`hoodCodFK` ASC),
  INDEX `userCodDf_idx` (`userCodD` ASC),
  CONSTRAINT `hoodCod`
    FOREIGN KEY (`hoodCodFK`)
    REFERENCES `psjb_db`.`neighborhood` (`hoodCod`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `userCodDf`
    FOREIGN KEY (`userCodD`)
    REFERENCES `psjb_db`.`user` (`userCod`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `psjb_db`.`product` (
  `prdCod` BIGINT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `prdImageURL` VARCHAR(255) NULL DEFAULT NULL,
  `prdDscES` VARCHAR(80) NULL DEFAULT NULL,
  `prdDscEN` VARCHAR(80) NULL DEFAULT NULL,
  `prdPrice` DECIMAL(16,2) NULL DEFAULT NULL,
  `prdIsv` DECIMAL(9,4) NULL DEFAULT NULL,
  `prdQuantity` INT(10) UNSIGNED NULL DEFAULT NULL,
  `prdCategory` BIGINT(10) UNSIGNED NULL DEFAULT NULL,
  `prdStock` INT(10) UNSIGNED NULL DEFAULT NULL,
  `prdState` CHAR(3) NULL DEFAULT NULL,
  `productcol` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`prdCod`),
  INDEX `prdState_idx` (`prdState` ASC)  ,
  INDEX `prdCategoryF_idx` (`prdCategory` ASC)  ,
  CONSTRAINT `prdStateF`
    FOREIGN KEY (`prdState`)
    REFERENCES `psjb_db`.`state` (`stateCod`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `prdCategoryF`
    FOREIGN KEY (`prdCategory`)
    REFERENCES `psjb_db`.`category` (`catCod`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `psjb_db`.`category` (
  `catCod` BIGINT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `catDscES` VARCHAR(80) NULL DEFAULT NULL,
  `catDscEN` VARCHAR(80) NULL DEFAULT NULL,
  `catState` CHAR(3) NULL DEFAULT NULL,
  PRIMARY KEY (`catCod`),
  INDEX `CatEstF_idx` (`catState` ASC)  ,
  CONSTRAINT `CatStateF`
    FOREIGN KEY (`catState`)
    REFERENCES `psjb_db`.`state` (`stateCod`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `psjb_db`.`bitacora` (
  `bitacoracod` INT(11) NOT NULL AUTO_INCREMENT,
  `bitacorafch` DATETIME NULL DEFAULT NULL,
  `bitprograma` VARCHAR(15) NULL DEFAULT NULL,
  `bitdescripcion` VARCHAR(255) NULL DEFAULT NULL,
  `bitTipo` CHAR(3) NULL DEFAULT NULL,
  `bitusuario` BIGINT(10) UNSIGNED NULL DEFAULT NULL,
  PRIMARY KEY (`bitacoracod`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `psjb_db`.`type` (
  `typeCod` CHAR(3) NOT NULL,
  `typeDsc` VARCHAR(45) NULL DEFAULT NULL,
  `typeState` CHAR(3) NULL DEFAULT NULL,
  `typeExp` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`typeCod`),
  INDEX `typeStateF_idx` (`typeState` ASC)  ,
  CONSTRAINT `typeStateF`
    FOREIGN KEY (`typeState`)
    REFERENCES `psjb_db`.`state` (`stateCod`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `psjb_db`.`type_module` (
  `typeCod` CHAR(3) NOT NULL,
  `mdlCod` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`typeCod`, `mdlCod`),
  INDEX `mdlCodF_idx` (`mdlCod` ASC)  ,
  CONSTRAINT `typeCodF`
    FOREIGN KEY (`typeCod`)
    REFERENCES `psjb_db`.`type` (`typeCod`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `mdlCodF`
    FOREIGN KEY (`mdlCod`)
    REFERENCES `psjb_db`.`module` (`mdlCod`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `psjb_db`.`module` (
  `mdlCod` VARCHAR(25) NOT NULL,
  `mdlDscES` VARCHAR(80) NULL DEFAULT NULL,
  `mdlDscEN` VARCHAR(80) NULL DEFAULT NULL,
  `mdlState` CHAR(3) NULL DEFAULT NULL,
  `mdlClass` CHAR(3) NULL DEFAULT NULL,
  PRIMARY KEY (`mdlCod`),
  INDEX `mdlStateF_idx` (`mdlState` ASC)  ,
  CONSTRAINT `mdlStateF`
    FOREIGN KEY (`mdlState`)
    REFERENCES `psjb_db`.`state` (`stateCod`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `psjb_db`.`orders` (
  `orderCod` BIGINT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `userCod` BIGINT(10) UNSIGNED NOT NULL,
  `orderStatus` CHAR(3) NULL DEFAULT NULL,
  `orderDate` DATETIME NULL DEFAULT NULL,
  `orderDeliverTime` DATETIME NULL DEFAULT NULL,
  `orderPayment` CHAR(3) NULL DEFAULT NULL,
  `orderCell` VARCHAR(40) NULL DEFAULT NULL,
  `orderDirection` VARCHAR(254) NULL DEFAULT NULL,
  `orderShippingFee` DECIMAL(7,2) NULL DEFAULT NULL,
  `orderIsv` DECIMAL(15,2) NULL DEFAULT NULL,
  `orderTotal` DECIMAL(15,2) NULL DEFAULT NULL,
  PRIMARY KEY (`orderCod`, `userCod`),
  INDEX `userCodF_idx` (`userCod` ASC)  ,
  INDEX `orderPaymentF_idx` (`orderPayment` ASC)  ,
  INDEX `orderStatusF_idx` (`orderStatus` ASC)  ,
  CONSTRAINT `userCod`
    FOREIGN KEY (`userCod`)
    REFERENCES `psjb_db`.`user` (`userCod`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `orderPaymentF`
    FOREIGN KEY (`orderPayment`)
    REFERENCES `psjb_db`.`payment` (`paymentCod`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `orderStatusF`
    FOREIGN KEY (`orderStatus`)
    REFERENCES `psjb_db`.`status` (`statusCod`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `psjb_db`.`order_product` (
  `orderPrdCod` BIGINT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `orderCod` BIGINT(10) UNSIGNED NOT NULL,
  `prdCod` BIGINT(10) UNSIGNED NOT NULL,
  `prdPrice` DECIMAL(16,2) NULL DEFAULT NULL,
  `cartQuantity` INT(11) NULL DEFAULT NULL,
  `prdQuantity` INT(11) NULL DEFAULT NULL,
  `prdDiscount` DECIMAL(3,2) NULL DEFAULT NULL,
  `prdIsv` DECIMAL(9,4) NULL DEFAULT NULL,
  PRIMARY KEY (`orderPrdCod`, `orderCod`, `prdCod`),
  INDEX `orderCodF_idx` (`orderCod` ASC)  ,
  INDEX `prdCodF_idx` (`prdCod` ASC)  ,
  CONSTRAINT `orderCodF`
    FOREIGN KEY (`orderCod`)
    REFERENCES `psjb_db`.`orders` (`orderCod`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `prdCodF`
    FOREIGN KEY (`prdCod`)
    REFERENCES `psjb_db`.`product` (`prdCod`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `psjb_db`.`payment` (
  `paymentCod` CHAR(3) NOT NULL,
  `paymentDscES` VARCHAR(45) NULL DEFAULT NULL,
  `paymentDscEN` VARCHAR(45) NULL DEFAULT NULL,
  `paymentLib` VARCHAR(30) NULL DEFAULT NULL,
  `paymentState` CHAR(3) NULL DEFAULT NULL,
  PRIMARY KEY (`paymentCod`),
  INDEX `paymentStateF_idx` (`paymentState` ASC)  ,
  CONSTRAINT `paymentStateF`
    FOREIGN KEY (`paymentState`)
    REFERENCES `psjb_db`.`state` (`stateCod`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `psjb_db`.`status` (
  `statusCod` CHAR(3) NOT NULL,
  `statusDscES` VARCHAR(45) NULL DEFAULT NULL,
  `statusDscEN` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`statusCod`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `psjb_db`.`variation` (
  `variationCod` BIGINT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `prdCod` BIGINT(10) UNSIGNED NULL DEFAULT NULL,
  `variationPrice` DECIMAL(16,2) NULL DEFAULT NULL,
  `variationQuantity` INT(10) UNSIGNED NULL DEFAULT NULL,
  `variationState` CHAR(3) NULL DEFAULT NULL,
  PRIMARY KEY (`variationCod`),
  INDEX `prdCodF_idx` (`prdCod` ASC)  ,
  INDEX `variationState_idx` (`variationState` ASC)  ,
  CONSTRAINT `prdCodFF`
    FOREIGN KEY (`prdCod`)
    REFERENCES `psjb_db`.`product` (`prdCod`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `variationState`
    FOREIGN KEY (`variationState`)
    REFERENCES `psjb_db`.`state` (`stateCod`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `psjb_db`.`Management` (
  `codManagement` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `hourManagement` VARCHAR(45) NULL DEFAULT NULL,
  `daysManagement` VARCHAR(45) NULL DEFAULT NULL,
  `maxOrderManagement` VARCHAR(45) NULL DEFAULT NULL,
  `stateManagement` CHAR(3) NULL DEFAULT NULL,
  PRIMARY KEY (`codManagement`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `psjb_db`.`user_type` (
  `typeCodUT` CHAR(3) NOT NULL,
  `userCodUT` BIGINT(10) UNSIGNED NOT NULL,
  `userTypeState` CHAR(3) NULL DEFAULT NULL,
  `userTypeExp` DATETIME NULL DEFAULT NULL,
  `userTypeRgstrd` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`typeCodUT`, `userCodUT`),
  INDEX `userCod_idx` (`userCodUT` ASC)  ,
  INDEX `userTypeState_idx` (`userTypeState` ASC)  ,
  CONSTRAINT `typeCodUTF`
    FOREIGN KEY (`typeCodUT`)
    REFERENCES `psjb_db`.`type` (`typeCod`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `userCodUTF`
    FOREIGN KEY (`userCodUT`)
    REFERENCES `psjb_db`.`user` (`userCod`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `userTypeStateF`
    FOREIGN KEY (`userTypeState`)
    REFERENCES `psjb_db`.`state` (`stateCod`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `psjb_db`.`neighborhood` (
  `hoodCod` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `hoodState` CHAR(3) NOT NULL,
  `hoodDsc` VARCHAR(130) NULL DEFAULT NULL,
  `hoodShippingFee` DECIMAL(8,3) NULL DEFAULT NULL,
  PRIMARY KEY (`hoodCod`),
  INDEX `hoodState_idx` (`hoodState` ASC)  ,
  CONSTRAINT `hoodState`
    FOREIGN KEY (`hoodState`)
    REFERENCES `psjb_db`.`state` (`stateCod`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
