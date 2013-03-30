SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

DROP SCHEMA IF EXISTS `osact_cake230` ;
CREATE SCHEMA IF NOT EXISTS `osact_cake230` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `osact_cake230` ;

-- -----------------------------------------------------
-- Table `osact_cake230`.`tjmcontrats`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `osact_cake230`.`tjmcontrats` ;

CREATE  TABLE IF NOT EXISTS `osact_cake230`.`tjmcontrats` (
  `id` INT(15) NOT NULL AUTO_INCREMENT ,
  `TJM` DECIMAL(25,2) NOT NULL ,
  `ANNEE` YEAR NOT NULL ,
  `created` DATE NOT NULL ,
  `modified` DATE NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
AUTO_INCREMENT = 11
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `osact_cake230`.`contrats`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `osact_cake230`.`contrats` ;

CREATE  TABLE IF NOT EXISTS `osact_cake230`.`contrats` (
  `id` INT(15) NOT NULL AUTO_INCREMENT ,
  `tjmcontrat_id` INT(15) NULL DEFAULT NULL ,
  `NOM` VARCHAR(255) CHARACTER SET 'latin1' NOT NULL ,
  `ANNEEDEBUT` YEAR NOT NULL ,
  `ANNEEFIN` YEAR NULL DEFAULT NULL ,
  `MONTANT` DECIMAL(25,2) NULL DEFAULT NULL ,
  `ACTIF` TINYINT(1) NOT NULL DEFAULT 0 ,
  `DESCRIPTION` TEXT CHARACTER SET 'latin1' NULL DEFAULT NULL ,
  `created` DATE NOT NULL ,
  `modified` DATE NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `osact_cake230`.`projets`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `osact_cake230`.`projets` ;

CREATE  TABLE IF NOT EXISTS `osact_cake230`.`projets` (
  `id` INT(15) NOT NULL AUTO_INCREMENT ,
  `contrat_id` INT(15) NOT NULL ,
  `NOM` VARCHAR(255) CHARACTER SET 'latin1' NOT NULL ,
  `NUMEROGALLILIE` VARCHAR(255) CHARACTER SET 'latin1' NULL DEFAULT NULL ,
  `DEBUT` DATE NULL DEFAULT NULL ,
  `FIN` DATE NULL DEFAULT NULL ,
  `COMMENTAIRE` LONGTEXT CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL ,
  `ACTIF` TINYINT(1) NOT NULL DEFAULT 0 ,
  `TYPE` ENUM('Projet','MCO','Indisponibilité','Evolution','Intégration','Exploitation') CHARACTER SET 'latin1' NULL DEFAULT 'Projet' ,
  `FACTURATION` ENUM('régie','forfait','autre') CHARACTER SET 'latin1' NULL DEFAULT NULL ,
  `created` DATE NOT NULL ,
  `modified` DATE NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `osact_cake230`.`activites`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `osact_cake230`.`activites` ;

CREATE  TABLE IF NOT EXISTS `osact_cake230`.`activites` (
  `id` INT(15) NOT NULL AUTO_INCREMENT ,
  `projet_id` INT(15) NOT NULL ,
  `NOM` VARCHAR(255) CHARACTER SET 'latin1' NOT NULL ,
  `DATEDEBUT` DATE NULL DEFAULT NULL ,
  `DATEFIN` DATE NULL DEFAULT NULL ,
  `NUMEROGALLILIE` VARCHAR(255) CHARACTER SET 'latin1' NULL DEFAULT NULL ,
  `DESCRIPTION` LONGTEXT CHARACTER SET 'latin1' NULL DEFAULT NULL ,
  `BUDJETRA` DECIMAL(25,2) NULL DEFAULT NULL ,
  `BUDGETREVU` DECIMAL(25,2) NULL DEFAULT NULL ,
  `ACTIVE` TINYINT(1) NOT NULL DEFAULT 0 ,
  `DELETABLE` TINYINT(1) NOT NULL DEFAULT 1 ,
  `created` DATE NOT NULL ,
  `modified` DATE NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `osact_cake230`.`achats`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `osact_cake230`.`achats` ;

CREATE  TABLE IF NOT EXISTS `osact_cake230`.`achats` (
  `id` INT(15) NOT NULL AUTO_INCREMENT ,
  `activite_id` INT(15) NOT NULL ,
  `LIBELLEACHAT` VARCHAR(255) CHARACTER SET 'latin1' NOT NULL ,
  `DATE` DATE NOT NULL ,
  `MONTANT` DECIMAL(25,2) NOT NULL ,
  `DESCRIPTION` TEXT CHARACTER SET 'latin1' NULL DEFAULT NULL ,
  `created` DATE NOT NULL ,
  `modified` DATE NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `osact_cake230`.`domaines`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `osact_cake230`.`domaines` ;

CREATE  TABLE IF NOT EXISTS `osact_cake230`.`domaines` (
  `id` INT(15) NOT NULL AUTO_INCREMENT ,
  `NOM` VARCHAR(255) CHARACTER SET 'latin1' NOT NULL ,
  `DESCRIPTION` LONGTEXT CHARACTER SET 'latin1' NULL DEFAULT NULL ,
  `created` DATE NOT NULL ,
  `modified` DATE NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `osact_cake230`.`societes`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `osact_cake230`.`societes` ;

CREATE  TABLE IF NOT EXISTS `osact_cake230`.`societes` (
  `id` INT(15) NOT NULL AUTO_INCREMENT ,
  `NOM` VARCHAR(255) CHARACTER SET 'latin1' NOT NULL ,
  `NOMCONTACT` VARCHAR(255) NULL DEFAULT NULL ,
  `TELEPHONE` VARCHAR(255) CHARACTER SET 'latin1' NULL DEFAULT NULL ,
  `MAIL` VARCHAR(255) CHARACTER SET 'latin1' NULL DEFAULT NULL ,
  `created` DATE NOT NULL ,
  `modified` DATE NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `osact_cake230`.`profils`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `osact_cake230`.`profils` ;

CREATE  TABLE IF NOT EXISTS `osact_cake230`.`profils` (
  `id` INT(15) NOT NULL AUTO_INCREMENT ,
  `NOM` VARCHAR(255) CHARACTER SET 'latin1' NOT NULL ,
  `COMMENTAIRE` TEXT CHARACTER SET 'latin1' NULL DEFAULT NULL ,
  `created` DATE NOT NULL ,
  `modified` DATE NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `osact_cake230`.`assistances`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `osact_cake230`.`assistances` ;

CREATE  TABLE IF NOT EXISTS `osact_cake230`.`assistances` (
  `ID` INT(15) NOT NULL AUTO_INCREMENT ,
  `NOM` VARCHAR(255) CHARACTER SET 'latin1' NOT NULL ,
  `DESCRIPTION` LONGTEXT CHARACTER SET 'latin1' NULL DEFAULT NULL ,
  `created` DATE NOT NULL ,
  `modified` DATE NOT NULL ,
  PRIMARY KEY (`ID`) )
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `osact_cake230`.`sites`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `osact_cake230`.`sites` ;

CREATE  TABLE IF NOT EXISTS `osact_cake230`.`sites` (
  `id` INT(15) NOT NULL AUTO_INCREMENT ,
  `NOM` VARCHAR(35) CHARACTER SET 'latin1' NOT NULL ,
  `DESCRIPTION` TEXT CHARACTER SET 'latin1' NULL DEFAULT NULL ,
  `created` DATE NOT NULL ,
  `modified` DATE NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
AUTO_INCREMENT = 4
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `osact_cake230`.`sections`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `osact_cake230`.`sections` ;

CREATE  TABLE IF NOT EXISTS `osact_cake230`.`sections` (
  `id` INT(15) NOT NULL AUTO_INCREMENT ,
  `utilisateur_id` INT(15) NULL DEFAULT NULL ,
  `NOM` VARCHAR(255) CHARACTER SET 'latin1' NOT NULL ,
  `DESCRIPTION` TEXT CHARACTER SET 'latin1' NULL DEFAULT NULL ,
  `created` DATE NOT NULL ,
  `modified` DATE NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `osact_cake230`.`tjmagents`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `osact_cake230`.`tjmagents` ;

CREATE  TABLE IF NOT EXISTS `osact_cake230`.`tjmagents` (
  `id` INT(15) NOT NULL AUTO_INCREMENT ,
  `NOM` VARCHAR(255) CHARACTER SET 'latin1' NOT NULL ,
  `TARIFHT` DECIMAL(25,2) NULL DEFAULT NULL ,
  `TARIFTTC` DECIMAL(25,2) NULL DEFAULT NULL ,
  `ANNEE` YEAR NOT NULL ,
  `created` DATE NOT NULL ,
  `modified` DATE NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `osact_cake230`.`typemateriels`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `osact_cake230`.`typemateriels` ;

CREATE  TABLE IF NOT EXISTS `osact_cake230`.`typemateriels` (
  `id` INT(15) NOT NULL AUTO_INCREMENT ,
  `NOM` VARCHAR(30) CHARACTER SET 'latin1' NOT NULL ,
  `DESCRIPTION` TEXT CHARACTER SET 'latin1' NULL DEFAULT NULL ,
  `created` DATE NOT NULL ,
  `modified` DATE NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `osact_cake230`.`materielinformatiques`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `osact_cake230`.`materielinformatiques` ;

CREATE  TABLE IF NOT EXISTS `osact_cake230`.`materielinformatiques` (
  `id` INT(15) NOT NULL AUTO_INCREMENT ,
  `typemateriel_id` INT(15) NOT NULL ,
  `section_id` INT(15) NOT NULL ,
  `assistance_id` INT(15) NOT NULL ,
  `NOM` VARCHAR(35) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL COMMENT 'identifiant du poste ou du matériel' ,
  `ETAT` ENUM('En stock','En dotation','En réparation','Au rebut','Non localisé') CHARACTER SET 'utf8' COLLATE 'utf8_general_ci' NULL DEFAULT NULL ,
  `WIFI` TINYINT(1) NULL DEFAULT 0 ,
  `VPN` TINYINT(1) NULL DEFAULT 0 ,
  `COMMENTAIRE` TEXT CHARACTER SET 'latin1' NULL DEFAULT NULL ,
  `created` DATE NOT NULL ,
  `modified` DATE NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `osact_cake230`.`dotations`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `osact_cake230`.`dotations` ;

CREATE  TABLE IF NOT EXISTS `osact_cake230`.`dotations` (
  `id` INT(15) NOT NULL AUTO_INCREMENT ,
  `materielinformatiques_id` INT(15) NULL ,
  `typemateriel_id` INT(15) NULL ,
  `utilisateur_id` INT(15) NOT NULL ,
  `DATERECEPTION` DATE NULL DEFAULT NULL ,
  `DATEREMISE` DATE NULL DEFAULT NULL ,
  `created` DATE NOT NULL ,
  `modified` DATE NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `osact_cake230`.`utilisateurs`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `osact_cake230`.`utilisateurs` ;

CREATE  TABLE IF NOT EXISTS `osact_cake230`.`utilisateurs` (
  `id` INT(15) NOT NULL AUTO_INCREMENT ,
  `profil_id` INT(15) NULL DEFAULT NULL ,
  `societe_id` INT(15) NOT NULL ,
  `assistance_id` INT(15) NULL DEFAULT NULL ,
  `section_id` INT(15) NULL DEFAULT NULL ,
  `utilisateur_id` INT(15) NULL DEFAULT NULL COMMENT 'Hiérarchique' ,
  `domaine_id` INT(15) NULL DEFAULT NULL ,
  `site_id` INT(15) NULL DEFAULT NULL ,
  `tjmagent_id` INT(15) NULL DEFAULT NULL ,
  `dotation_id` INT(15) NULL DEFAULT NULL ,
  `password` VARCHAR(35) CHARACTER SET 'utf8' COLLATE 'utf8_general_ci' NOT NULL DEFAULT 'OSACT' ,
  `username` VARCHAR(35) CHARACTER SET 'latin1' NULL DEFAULT NULL COMMENT 'login déclaré dans AD' ,
  `ACTIF` TINYINT(1) NOT NULL DEFAULT 1 ,
  `DATEDEBUTACTIF` DATE NULL DEFAULT NULL ,
  `NAISSANCE` DATE NOT NULL ,
  `NOM` VARCHAR(35) CHARACTER SET 'latin1' NOT NULL ,
  `PRENOM` VARCHAR(35) CHARACTER SET 'latin1' NOT NULL ,
  `COMMENTAIRE` LONGTEXT CHARACTER SET 'latin1' NULL DEFAULT NULL ,
  `FINMISSION` DATE NULL DEFAULT NULL ,
  `MAIL` VARCHAR(255) CHARACTER SET 'latin1' NULL DEFAULT NULL ,
  `TELEPHONE` VARCHAR(15) CHARACTER SET 'latin1' NULL DEFAULT NULL ,
  `WORKCAPACITY` INT(3) NULL DEFAULT 100 ,
  `CONGE` INT(15) NULL DEFAULT 0 ,
  `RQ` INT(15) NULL DEFAULT 0 ,
  `VT` INT(15) NULL DEFAULT 0 ,
  `HIERARCHIQUE` TINYINT(1) NOT NULL DEFAULT 0 ,
  `GESTIONABSENCES` TINYINT(1) NOT NULL DEFAULT 0 ,
  `WIDEAREA` TINYINT(1) NOT NULL DEFAULT 0 ,
  `created` DATE NOT NULL ,
  `modified` DATE NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `osact_cake230`.`actions`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `osact_cake230`.`actions` ;

CREATE  TABLE IF NOT EXISTS `osact_cake230`.`actions` (
  `id` INT(15) NOT NULL AUTO_INCREMENT ,
  `utilisateur_id` INT(15) NOT NULL COMMENT 'Créateur\n' ,
  `destinataire` INT(15) NOT NULL COMMENT 'Destinataire' ,
  `domaine_id` INT(15) NOT NULL ,
  `activite_id` INT(15) NOT NULL ,
  `OBJET` TEXT CHARACTER SET 'latin1' NOT NULL ,
  `AVANCEMENT` INT(11) NULL DEFAULT '0' ,
  `COMMENTAIRE` TEXT CHARACTER SET 'latin1' NULL DEFAULT NULL ,
  `ECHEANCE` DATE NOT NULL ,
  `DEBUT` DATE NOT NULL ,
  `STATUT` ENUM('à faire','en cours','terminée','livré','annulée') CHARACTER SET 'latin1' NULL DEFAULT NULL ,
  `DUREEPREVUE` INT(15) NULL DEFAULT NULL ,
  `PRIORITE` ENUM('normale','moyenne','haute') CHARACTER SET 'latin1' NULL DEFAULT NULL ,
  `created` DATE NOT NULL ,
  `modified` DATE NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `osact_cake230`.`affectations`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `osact_cake230`.`affectations` ;

CREATE  TABLE IF NOT EXISTS `osact_cake230`.`affectations` (
  `id` INT(15) NOT NULL AUTO_INCREMENT ,
  `utilisateur_id` INT(15) NOT NULL ,
  `activite_id` INT(15) NOT NULL ,
  `REPARTITION` INT NULL DEFAULT NULL ,
  `created` DATE NOT NULL ,
  `modified` DATE NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `osact_cake230`.`autorisations`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `osact_cake230`.`autorisations` ;

CREATE  TABLE IF NOT EXISTS `osact_cake230`.`autorisations` (
  `id` INT(15) NOT NULL AUTO_INCREMENT ,
  `profil_id` INT(15) NOT NULL ,
  `MODEL` VARCHAR(255) NOT NULL ,
  `INDEX` TINYINT(1) NOT NULL DEFAULT 0 ,
  `ADD` TINYINT(1) NOT NULL DEFAULT 0 ,
  `EDIT` TINYINT(1) NOT NULL DEFAULT 0 ,
  `VIEW` TINYINT(1) NOT NULL DEFAULT 0 ,
  `DELETE` TINYINT(1) NOT NULL DEFAULT 0 ,
  `DUPLICATE` TINYINT(1) NOT NULL DEFAULT 0 ,
  `INITPASSWORD` TINYINT(1) NOT NULL DEFAULT 0 ,
  `ABSENCES` TINYINT(1) NOT NULL DEFAULT 0 ,
  `RAPPORTS` TINYINT(1) NOT NULL DEFAULT 0 ,
  `UPDATE` TINYINT(1) NOT NULL DEFAULT 0 ,
  `created` DATE NOT NULL ,
  `modified` DATE NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `osact_cake230`.`dossierpartages`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `osact_cake230`.`dossierpartages` ;

CREATE  TABLE IF NOT EXISTS `osact_cake230`.`dossierpartages` (
  `id` INT(10) NOT NULL AUTO_INCREMENT ,
  `NOM` VARCHAR(50) CHARACTER SET 'latin1' NOT NULL ,
  `GROUPEAD` VARCHAR(255) CHARACTER SET 'latin1' NULL DEFAULT NULL ,
  `DESCRIPTION` VARCHAR(255) CHARACTER SET 'latin1' NULL DEFAULT NULL ,
  `created` DATE NOT NULL ,
  `modified` DATE NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `osact_cake230`.`historyactions`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `osact_cake230`.`historyactions` ;

CREATE  TABLE IF NOT EXISTS `osact_cake230`.`historyactions` (
  `id` INT(15) NOT NULL AUTO_INCREMENT ,
  `action_id` INT(15) NOT NULL ,
  `AVANCEMENT` INT NULL DEFAULT NULL ,
  `DEBUT` DATE NOT NULL ,
  `ECHEANCE` DATE NOT NULL ,
  `CHARGEPREVUE` INT NOT NULL ,
  `PRIORITE` ENUM('normale','moyenne','haute') CHARACTER SET 'latin1' NOT NULL ,
  `STATUT` ENUM('à faire','en cours','terminée','livré','annulée') NOT NULL ,
  `COMMENTAIRE` TEXT CHARACTER SET 'latin1' NULL DEFAULT NULL ,
  `created` DATE NOT NULL ,
  `modified` DATE NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `osact_cake230`.`historyutilisateurs`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `osact_cake230`.`historyutilisateurs` ;

CREATE  TABLE IF NOT EXISTS `osact_cake230`.`historyutilisateurs` (
  `id` INT(15) NOT NULL AUTO_INCREMENT ,
  `utilisateur_id` INT(15) NOT NULL ,
  `HISTORIQUE` LONGTEXT NULL DEFAULT NULL ,
  `created` DATE NOT NULL ,
  `modified` DATE NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `osact_cake230`.`linkshareds`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `osact_cake230`.`linkshareds` ;

CREATE  TABLE IF NOT EXISTS `osact_cake230`.`linkshareds` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `utilisateur_id` INT(15) NOT NULL ,
  `NOM` VARCHAR(255) CHARACTER SET 'latin1' NOT NULL ,
  `LINK` TEXT CHARACTER SET 'latin1' NULL DEFAULT NULL ,
  `created` DATE NOT NULL ,
  `modified` DATE NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `osact_cake230`.`listediffusions`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `osact_cake230`.`listediffusions` ;

CREATE  TABLE IF NOT EXISTS `osact_cake230`.`listediffusions` (
  `id` INT(15) NOT NULL AUTO_INCREMENT ,
  `utilisateur_id` INT(15) NULL DEFAULT NULL ,
  `NOM` VARCHAR(255) CHARACTER SET 'latin1' NOT NULL ,
  `DESCRIPTION` LONGTEXT CHARACTER SET 'latin1' NULL DEFAULT NULL ,
  `created` DATE NOT NULL ,
  `modified` DATE NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `osact_cake230`.`livrables`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `osact_cake230`.`livrables` ;

CREATE  TABLE IF NOT EXISTS `osact_cake230`.`livrables` (
  `id` INT(15) NOT NULL AUTO_INCREMENT ,
  `utilisateur_id` INT(15) NULL DEFAULT NULL ,
  `NOM` VARCHAR(255) CHARACTER SET 'latin1' NOT NULL ,
  `REFERENCE` VARCHAR(45) NULL ,
  `ECHEANCE` DATE NOT NULL ,
  `DATELIVRAISON` DATE NOT NULL ,
  `DATEVALIDATION` DATE NOT NULL ,
  `ETAT` ENUM('à faire','en cours','validé','livré','refusé','annulé') NOT NULL ,
  `COMMENTAIRE` TEXT NULL DEFAULT NULL ,
  `VERSION` VARCHAR(5) NULL DEFAULT NULL ,
  `created` DATE NOT NULL ,
  `modified` DATE NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `osact_cake230`.`messages`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `osact_cake230`.`messages` ;

CREATE  TABLE IF NOT EXISTS `osact_cake230`.`messages` (
  `id` INT(15) NOT NULL AUTO_INCREMENT ,
  `LIBELLE` MEDIUMTEXT NOT NULL ,
  `DATELIMITE` DATE NULL DEFAULT NULL ,
  `created` DATE NOT NULL ,
  `modified` DATE NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `osact_cake230`.`outils`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `osact_cake230`.`outils` ;

CREATE  TABLE IF NOT EXISTS `osact_cake230`.`outils` (
  `id` INT(15) NOT NULL AUTO_INCREMENT ,
  `utilisateur_id` INT(15) NOT NULL ,
  `NOM` VARCHAR(255) CHARACTER SET 'latin1' NOT NULL ,
  `DESCRIPTION` TEXT CHARACTER SET 'latin1' NULL DEFAULT NULL ,
  `VALIDATION` TINYINT(1) NOT NULL DEFAULT '0' ,
  `created` DATE NOT NULL ,
  `modified` DATE NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `osact_cake230`.`suivilivrables`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `osact_cake230`.`suivilivrables` ;

CREATE  TABLE IF NOT EXISTS `osact_cake230`.`suivilivrables` (
  `id` INT(15) NOT NULL AUTO_INCREMENT ,
  `livrable_id` INT(15) NOT NULL ,
  `ECHEANCE` DATE NOT NULL ,
  `DATELIVRAISON` DATE NOT NULL ,
  `DATEVALIDATION` DATE NOT NULL ,
  `ETAT` VARCHAR(50) NOT NULL ,
  `created` DATE NOT NULL ,
  `modified` DATE NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `osact_cake230`.`utiliseoutils`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `osact_cake230`.`utiliseoutils` ;

CREATE  TABLE IF NOT EXISTS `osact_cake230`.`utiliseoutils` (
  `id` INT(15) NOT NULL AUTO_INCREMENT ,
  `utilisateur_id` INT(15) NOT NULL ,
  `outil_id` INT(15) NULL DEFAULT NULL ,
  `listediffusion_id` INT(15) NULL DEFAULT NULL ,
  `dossierpartage_id` INT(10) NULL ,
  `STATUT` ENUM('Demandé','Pris en compte','En validation','Validé','Demande transférée','Demande traitée','Retour utilisateur','A supprimer','Supprimée') CHARACTER SET 'utf8' COLLATE 'utf8_general_ci' NULL DEFAULT NULL ,
  `TYPE` ENUM('Outil','Liste Diffusion','Partage Réseaux','') CHARACTER SET 'latin1' NULL DEFAULT NULL ,
  `created` DATE NOT NULL ,
  `modified` DATE NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `osact_cake230`.`actionslivrables`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `osact_cake230`.`actionslivrables` ;

CREATE  TABLE IF NOT EXISTS `osact_cake230`.`actionslivrables` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `action_id` INT(15) NOT NULL ,
  `livrable_id` INT(15) NOT NULL ,
  `created` DATE NOT NULL ,
  `modified` DATE NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `osact_cake230`.`facturations`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `osact_cake230`.`facturations` ;

CREATE  TABLE IF NOT EXISTS `osact_cake230`.`facturations` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `utilisateur_id` INT(15) NOT NULL ,
  `activite_id` INT(15) NOT NULL ,
  `activitesreelle_id` INT NOT NULL ,
  `DATE` DATE NOT NULL ,
  `VERSION` INT(2) NULL DEFAULT 0 ,
  `LU` DECIMAL(1,1) NULL DEFAULT NULL ,
  `MA` DECIMAL(1,1) NULL DEFAULT NULL ,
  `ME` DECIMAL(1,1) NULL DEFAULT NULL ,
  `JE` DECIMAL(1,1) NULL DEFAULT NULL ,
  `VE` DECIMAL(1,1) NULL DEFAULT NULL ,
  `SA` DECIMAL(1,1) NULL DEFAULT NULL ,
  `DI` DECIMAL(1,1) NULL DEFAULT NULL ,
  `NUMEROFTGALILEI` VARCHAR(15) NULL ,
  `VERSION` INT(5) NULL DEFAULT NULL ,
  `created` DATE NOT NULL ,
  `modified` DATE NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `osact_cake230`.`activitesreelles`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `osact_cake230`.`activitesreelles` ;

CREATE  TABLE IF NOT EXISTS `osact_cake230`.`activitesreelles` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `utilisateur_id` INT(15) NOT NULL ,
  `action_id` INT(15) NULL DEFAULT NULL ,
  `facturation_id` INT NULL DEFAULT NULL ,
  `activite_id` INT(15) NOT NULL ,
  `DATE` DATE NOT NULL ,
  `LU` DECIMAL(2,1) NOT NULL DEFAULT 0.0 ,
  `LU_TYPE` TINYINT(1) NOT NULL DEFAULT 1 COMMENT '1=>matin\n0=>après midi' ,
  `MA` DECIMAL(2,1) NOT NULL DEFAULT 0.0 ,
  `MA_TYPE` TINYINT(1) NOT NULL DEFAULT 1 COMMENT '1=>matin\n0=>après midi' ,
  `ME` DECIMAL(2,1) NOT NULL DEFAULT 0.0 ,
  `ME_TYPE` TINYINT(1) NOT NULL DEFAULT 1 COMMENT '1=>matin\n0=>après midi' ,
  `JE` DECIMAL(2,1) NOT NULL DEFAULT 0.0 ,
  `JE_TYPE` TINYINT(1) NOT NULL DEFAULT 1 COMMENT '1=>matin\n0=>après midi' ,
  `VE` DECIMAL(2,1) NOT NULL DEFAULT 0.0 ,
  `VE_TYPE` TINYINT(1) NOT NULL DEFAULT 1 COMMENT '1=>matin\n0=>après midi' ,
  `SA` DECIMAL(2,1) NOT NULL DEFAULT 0.0 ,
  `SA_TYPE` TINYINT(1) NOT NULL DEFAULT 1 COMMENT '1=>matin\n0=>après midi' ,
  `DI` DECIMAL(2,1) NOT NULL DEFAULT 0.0 ,
  `DI_TYPE` TINYINT(1) NOT NULL DEFAULT 1 COMMENT '1=>matin\n0=>après midi' ,
  `TOTAL` DECIMAL(2,1) NOT NULL DEFAULT 0.0 ,
  `VEROUILLE` TINYINT(1) NOT NULL DEFAULT 1 COMMENT '0=>verrouille\n1=>actif' ,
  `created` DATE NOT NULL ,
  `modified` DATE NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `osact_cake230`.`plandecharges`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `osact_cake230`.`plandecharges` ;

CREATE  TABLE IF NOT EXISTS `osact_cake230`.`plandecharges` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `utilisateur_id` INT(15) NOT NULL ,
  `domaine_id` INT(15) NOT NULL ,
  `activite_id` INT(15) NOT NULL ,
  `CHARGEPREVUE` INT NOT NULL ,
  `PERIODE` DATE NOT NULL COMMENT 'mois/année' ,
  `created` DATE NOT NULL ,
  `modified` DATE NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;

USE `osact_cake230` ;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `osact_cake230`.`tjmcontrats`
-- -----------------------------------------------------
START TRANSACTION;
USE `osact_cake230`;
INSERT INTO `osact_cake230`.`tjmcontrats` (`id`, `TJM`, `ANNEE`, `created`, `modified`) VALUES (1, 640, 2013, '2013-02-01', '2013-02-01');

COMMIT;

-- -----------------------------------------------------
-- Data for table `osact_cake230`.`contrats`
-- -----------------------------------------------------
START TRANSACTION;
USE `osact_cake230`;
INSERT INTO `osact_cake230`.`contrats` (`id`, `tjmcontrat_id`, `NOM`, `ANNEEDEBUT`, `ANNEEFIN`, `MONTANT`, `ACTIF`, `DESCRIPTION`, `created`, `modified`) VALUES (1, NULL, 'absences', 2012, NULL, NULL, 1, NULL, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`contrats` (`id`, `tjmcontrat_id`, `NOM`, `ANNEEDEBUT`, `ANNEEFIN`, `MONTANT`, `ACTIF`, `DESCRIPTION`, `created`, `modified`) VALUES (2, NULL, 'OSMOSE', 2008, NULL, NULL, 1, NULL, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`contrats` (`id`, `tjmcontrat_id`, `NOM`, `ANNEEDEBUT`, `ANNEEFIN`, `MONTANT`, `ACTIF`, `DESCRIPTION`, `created`, `modified`) VALUES (3, NULL, 'COHERENCE', 2009, NULL, NULL, 1, NULL, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`contrats` (`id`, `tjmcontrat_id`, `NOM`, `ANNEEDEBUT`, `ANNEEFIN`, `MONTANT`, `ACTIF`, `DESCRIPTION`, `created`, `modified`) VALUES (4, NULL, 'ORCHESTRAL', 2009, NULL, NULL, 1, NULL, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`contrats` (`id`, `tjmcontrat_id`, `NOM`, `ANNEEDEBUT`, `ANNEEFIN`, `MONTANT`, `ACTIF`, `DESCRIPTION`, `created`, `modified`) VALUES (5, NULL, 'SGRM', 2010, NULL, NULL, 1, NULL, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`contrats` (`id`, `tjmcontrat_id`, `NOM`, `ANNEEDEBUT`, `ANNEEFIN`, `MONTANT`, `ACTIF`, `DESCRIPTION`, `created`, `modified`) VALUES (6, NULL, 'PANAM', 2010, NULL, NULL, 1, NULL, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`contrats` (`id`, `tjmcontrat_id`, `NOM`, `ANNEEDEBUT`, `ANNEEFIN`, `MONTANT`, `ACTIF`, `DESCRIPTION`, `created`, `modified`) VALUES (7, NULL, 'BAUME', 2010, NULL, NULL, 1, NULL, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`contrats` (`id`, `tjmcontrat_id`, `NOM`, `ANNEEDEBUT`, `ANNEEFIN`, `MONTANT`, `ACTIF`, `DESCRIPTION`, `created`, `modified`) VALUES (8, NULL, 'EMC²', 2010, NULL, NULL, 1, NULL, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`contrats` (`id`, `tjmcontrat_id`, `NOM`, `ANNEEDEBUT`, `ANNEEFIN`, `MONTANT`, `ACTIF`, `DESCRIPTION`, `created`, `modified`) VALUES (9, NULL, 'ITAC', 2010, NULL, NULL, 1, NULL, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`contrats` (`id`, `tjmcontrat_id`, `NOM`, `ANNEEDEBUT`, `ANNEEFIN`, `MONTANT`, `ACTIF`, `DESCRIPTION`, `created`, `modified`) VALUES (10, NULL, 'URBANISME', 2010, NULL, NULL, 1, NULL, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`contrats` (`id`, `tjmcontrat_id`, `NOM`, `ANNEEDEBUT`, `ANNEEFIN`, `MONTANT`, `ACTIF`, `DESCRIPTION`, `created`, `modified`) VALUES (11, NULL, 'FORMATION', 2010, NULL, NULL, 1, NULL, '2013-02-01', '2013-02-01');

COMMIT;

-- -----------------------------------------------------
-- Data for table `osact_cake230`.`projets`
-- -----------------------------------------------------
START TRANSACTION;
USE `osact_cake230`;
INSERT INTO `osact_cake230`.`projets` (`id`, `contrat_id`, `NOM`, `NUMEROGALLILIE`, `DEBUT`, `FIN`, `COMMENTAIRE`, `ACTIF`, `TYPE`, `FACTURATION`, `created`, `modified`) VALUES (1, 1, 'indisponibilité', NULL, '2013-01-01', NULL, NULL, 1, 'indisponibilité', 'autre', '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`projets` (`id`, `contrat_id`, `NOM`, `NUMEROGALLILIE`, `DEBUT`, `FIN`, `COMMENTAIRE`, `ACTIF`, `TYPE`, `FACTURATION`, `created`, `modified`) VALUES (2, 2, 'DEV M OSMOSE', '01328-0000064359', '2008-01-02', NULL, NULL, 1, 'projet', 'régie', '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`projets` (`id`, `contrat_id`, `NOM`, `NUMEROGALLILIE`, `DEBUT`, `FIN`, `COMMENTAIRE`, `ACTIF`, `TYPE`, `FACTURATION`, `created`, `modified`) VALUES (3, 6, 'DEV M PANAM', '01328-0000068794', '2010-01-02', NULL, NULL, 1, 'projet', 'régie', '2013-02-01', '2013-01-02');
INSERT INTO `osact_cake230`.`projets` (`id`, `contrat_id`, `NOM`, `NUMEROGALLILIE`, `DEBUT`, `FIN`, `COMMENTAIRE`, `ACTIF`, `TYPE`, `FACTURATION`, `created`, `modified`) VALUES (4, 2, 'MCO M EMM OSMOSE', '01328-0000068414', '2010-01-02', NULL, NULL, 1, 'MCO', 'forfait', '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`projets` (`id`, `contrat_id`, `NOM`, `NUMEROGALLILIE`, `DEBUT`, `FIN`, `COMMENTAIRE`, `ACTIF`, `TYPE`, `FACTURATION`, `created`, `modified`) VALUES (5, 6, 'MCO PANAM', '01328-0000070662', '2010-01-02', NULL, NULL, 1, 'MCO', 'forfait', '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`projets` (`id`, `contrat_id`, `NOM`, `NUMEROGALLILIE`, `DEBUT`, `FIN`, `COMMENTAIRE`, `ACTIF`, `TYPE`, `FACTURATION`, `created`, `modified`) VALUES (6, 3, 'DEV M EMM COHERENCE', '01328-0000061462', '2009-01-02', '2013-01-02', NULL, 0, 'projet', 'régie', '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`projets` (`id`, `contrat_id`, `NOM`, `NUMEROGALLILIE`, `DEBUT`, `FIN`, `COMMENTAIRE`, `ACTIF`, `TYPE`, `FACTURATION`, `created`, `modified`) VALUES (7, 3, 'MCO M COHERENCE', '01328-0000068637', '2010-01-02', NULL, NULL, 1, 'MCO', 'forfait', '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`projets` (`id`, `contrat_id`, `NOM`, `NUMEROGALLILIE`, `DEBUT`, `FIN`, `COMMENTAIRE`, `ACTIF`, `TYPE`, `FACTURATION`, `created`, `modified`) VALUES (8, 4, 'DEV M ORCHESTRAL', '01328-0000064997', '2009-01-02', '2013-01-02', NULL, 0, 'projet', 'régie', '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`projets` (`id`, `contrat_id`, `NOM`, `NUMEROGALLILIE`, `DEBUT`, `FIN`, `COMMENTAIRE`, `ACTIF`, `TYPE`, `FACTURATION`, `created`, `modified`) VALUES (9, 4, 'MCO M ORCHESTRAL', '01328-0000068638', '2010-01-02', NULL, NULL, 1, 'MCO', 'forfait', '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`projets` (`id`, `contrat_id`, `NOM`, `NUMEROGALLILIE`, `DEBUT`, `FIN`, `COMMENTAIRE`, `ACTIF`, `TYPE`, `FACTURATION`, `created`, `modified`) VALUES (10, 2, 'Contrat DSIT-X ==> MAT OSMOSE', '01328-0000064309', '2008-01-02', NULL, NULL, 1, 'projet', 'régie', '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`projets` (`id`, `contrat_id`, `NOM`, `NUMEROGALLILIE`, `DEBUT`, `FIN`, `COMMENTAIRE`, `ACTIF`, `TYPE`, `FACTURATION`, `created`, `modified`) VALUES (11, 6, 'Contrat DSIT-X ==> MAT PANAM', '01328-0000000000', '2010-01-02', NULL, NULL, 1, 'projet', 'régie', '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`projets` (`id`, `contrat_id`, `NOM`, `NUMEROGALLILIE`, `DEBUT`, `FIN`, `COMMENTAIRE`, `ACTIF`, `TYPE`, `FACTURATION`, `created`, `modified`) VALUES (12, 3, 'Contrat DSIT-X ==> MAT COHERENCE', '01328-0000064367', '2010-01-02', NULL, NULL, 1, 'projet', 'régie', '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`projets` (`id`, `contrat_id`, `NOM`, `NUMEROGALLILIE`, `DEBUT`, `FIN`, `COMMENTAIRE`, `ACTIF`, `TYPE`, `FACTURATION`, `created`, `modified`) VALUES (13, 4, 'Contrat DSIT-X ==> MAT ORCHESTRAL', '01328-0000064641', '2010-01-02', NULL, NULL, 1, 'projet', 'régie', '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`projets` (`id`, `contrat_id`, `NOM`, `NUMEROGALLILIE`, `DEBUT`, `FIN`, `COMMENTAIRE`, `ACTIF`, `TYPE`, `FACTURATION`, `created`, `modified`) VALUES (14, 5, 'DEV M OSMOSE SGRM', '01328-0000071134', '2010-01-02', NULL, NULL, 1, 'projet', 'régie', '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`projets` (`id`, `contrat_id`, `NOM`, `NUMEROGALLILIE`, `DEBUT`, `FIN`, `COMMENTAIRE`, `ACTIF`, `TYPE`, `FACTURATION`, `created`, `modified`) VALUES (15, 5, 'MCO M OSMOSE SGRM', '01328-0000071712', '2010-01-02', NULL, NULL, 1, 'MCO', 'forfait', '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`projets` (`id`, `contrat_id`, `NOM`, `NUMEROGALLILIE`, `DEBUT`, `FIN`, `COMMENTAIRE`, `ACTIF`, `TYPE`, `FACTURATION`, `created`, `modified`) VALUES (16, 3, 'EVO M EMM COHERENCE', '01328-0000072207', '2013-01-02', NULL, NULL, 1, 'Evolution', 'régie', '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`projets` (`id`, `contrat_id`, `NOM`, `NUMEROGALLILIE`, `DEBUT`, `FIN`, `COMMENTAIRE`, `ACTIF`, `TYPE`, `FACTURATION`, `created`, `modified`) VALUES (17, 4, 'EVO M ORCHESTRAL', '01328-0000072209', '2013-01-02', NULL, NULL, 1, 'Evolution', 'régie', '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`projets` (`id`, `contrat_id`, `NOM`, `NUMEROGALLILIE`, `DEBUT`, `FIN`, `COMMENTAIRE`, `ACTIF`, `TYPE`, `FACTURATION`, `created`, `modified`) VALUES (18, 7, 'PEV M BAUME DBC ', '01328-0000071232', '2010-01-02', NULL, NULL, 1, 'projet', 'régie', '2013-02-01', '2013-01-02');
INSERT INTO `osact_cake230`.`projets` (`id`, `contrat_id`, `NOM`, `NUMEROGALLILIE`, `DEBUT`, `FIN`, `COMMENTAIRE`, `ACTIF`, `TYPE`, `FACTURATION`, `created`, `modified`) VALUES (19, 7, 'BAUME DBC - MCO', '01328-0000071231', '2010-01-02', NULL, NULL, 1, 'MCO', 'forfait', '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`projets` (`id`, `contrat_id`, `NOM`, `NUMEROGALLILIE`, `DEBUT`, `FIN`, `COMMENTAIRE`, `ACTIF`, `TYPE`, `FACTURATION`, `created`, `modified`) VALUES (20, 8, 'MCO M APPLICATION EMC2', '01328-0000061454', '2010-01-02', NULL, NULL, 1, 'MCO', 'forfait', '2013-02-01', '2013-01-02');
INSERT INTO `osact_cake230`.`projets` (`id`, `contrat_id`, `NOM`, `NUMEROGALLILIE`, `DEBUT`, `FIN`, `COMMENTAIRE`, `ACTIF`, `TYPE`, `FACTURATION`, `created`, `modified`) VALUES (21, 10, 'ASS M URBANISME ', '01328-0000064373', '2010-01-02', NULL, NULL, 1, 'projet', 'régie', '2013-02-01', '2013-01-02');
INSERT INTO `osact_cake230`.`projets` (`id`, `contrat_id`, `NOM`, `NUMEROGALLILIE`, `DEBUT`, `FIN`, `COMMENTAIRE`, `ACTIF`, `TYPE`, `FACTURATION`, `created`, `modified`) VALUES (22, 9, 'DEV M ITACT ', '01328-0000070794', '2010-01-02', NULL, NULL, 1, 'projet', 'régie', '2013-02-01', '2013-01-02');

COMMIT;

-- -----------------------------------------------------
-- Data for table `osact_cake230`.`activites`
-- -----------------------------------------------------
START TRANSACTION;
USE `osact_cake230`;
INSERT INTO `osact_cake230`.`activites` (`id`, `projet_id`, `NOM`, `DATEDEBUT`, `DATEFIN`, `NUMEROGALLILIE`, `DESCRIPTION`, `BUDJETRA`, `BUDGETREVU`, `ACTIVE`, `DELETABLE`, `created`, `modified`) VALUES (1, 1, 'C', NULL, NULL, NULL, 'Congés protocolaires', NULL, NULL, 1, 0, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`activites` (`id`, `projet_id`, `NOM`, `DATEDEBUT`, `DATEFIN`, `NUMEROGALLILIE`, `DESCRIPTION`, `BUDJETRA`, `BUDGETREVU`, `ACTIVE`, `DELETABLE`, `created`, `modified`) VALUES (2, 1, 'RQ', NULL, NULL, NULL, 'Journée 35h', NULL, NULL, 1, 0, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`activites` (`id`, `projet_id`, `NOM`, `DATEDEBUT`, `DATEFIN`, `NUMEROGALLILIE`, `DESCRIPTION`, `BUDJETRA`, `BUDGETREVU`, `ACTIVE`, `DELETABLE`, `created`, `modified`) VALUES (3, 1, 'VT', NULL, NULL, NULL, 'Temps partiel', NULL, NULL, 1, 0, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`activites` (`id`, `projet_id`, `NOM`, `DATEDEBUT`, `DATEFIN`, `NUMEROGALLILIE`, `DESCRIPTION`, `BUDJETRA`, `BUDGETREVU`, `ACTIVE`, `DELETABLE`, `created`, `modified`) VALUES (4, 1, 'SE', NULL, NULL, NULL, 'Soin enfant ou conjoint', NULL, NULL, 1, 0, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`activites` (`id`, `projet_id`, `NOM`, `DATEDEBUT`, `DATEFIN`, `NUMEROGALLILIE`, `DESCRIPTION`, `BUDJETRA`, `BUDGETREVU`, `ACTIVE`, `DELETABLE`, `created`, `modified`) VALUES (5, 1, 'Mal', NULL, NULL, NULL, 'Maladie', NULL, NULL, 1, 0, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`activites` (`id`, `projet_id`, `NOM`, `DATEDEBUT`, `DATEFIN`, `NUMEROGALLILIE`, `DESCRIPTION`, `BUDJETRA`, `BUDGETREVU`, `ACTIVE`, `DELETABLE`, `created`, `modified`) VALUES (6, 1, 'CS', NULL, NULL, NULL, 'Congés supplémentaire', NULL, NULL, 1, 0, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`activites` (`id`, `projet_id`, `NOM`, `DATEDEBUT`, `DATEFIN`, `NUMEROGALLILIE`, `DESCRIPTION`, `BUDJETRA`, `BUDGETREVU`, `ACTIVE`, `DELETABLE`, `created`, `modified`) VALUES (7, 1, 'DA', NULL, NULL, NULL, '1h de grève', NULL, NULL, 1, 0, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`activites` (`id`, `projet_id`, `NOM`, `DATEDEBUT`, `DATEFIN`, `NUMEROGALLILIE`, `DESCRIPTION`, `BUDJETRA`, `BUDGETREVU`, `ACTIVE`, `DELETABLE`, `created`, `modified`) VALUES (8, 1, 'DB', NULL, NULL, NULL, '4h de grève', NULL, NULL, 1, 0, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`activites` (`id`, `projet_id`, `NOM`, `DATEDEBUT`, `DATEFIN`, `NUMEROGALLILIE`, `DESCRIPTION`, `BUDJETRA`, `BUDGETREVU`, `ACTIVE`, `DELETABLE`, `created`, `modified`) VALUES (9, 1, 'DC', NULL, NULL, NULL, '8h de grève', NULL, NULL, 1, 0, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`activites` (`id`, `projet_id`, `NOM`, `DATEDEBUT`, `DATEFIN`, `NUMEROGALLILIE`, `DESCRIPTION`, `BUDJETRA`, `BUDGETREVU`, `ACTIVE`, `DELETABLE`, `created`, `modified`) VALUES (10, 1, 'DD', NULL, NULL, NULL, 'Journée de délégation', NULL, NULL, 1, 0, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`activites` (`id`, `projet_id`, `NOM`, `DATEDEBUT`, `DATEFIN`, `NUMEROGALLILIE`, `DESCRIPTION`, `BUDJETRA`, `BUDGETREVU`, `ACTIVE`, `DELETABLE`, `created`, `modified`) VALUES (11, 1, 'DR', NULL, NULL, NULL, 'Journée de délégation', NULL, NULL, 1, 0, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`activites` (`id`, `projet_id`, `NOM`, `DATEDEBUT`, `DATEFIN`, `NUMEROGALLILIE`, `DESCRIPTION`, `BUDJETRA`, `BUDGETREVU`, `ACTIVE`, `DELETABLE`, `created`, `modified`) VALUES (13, 16, 'EVO COHERENCE', '2013-01-01', '2016-12-31', '000001', NULL, NULL, NULL, 1, 1, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`activites` (`id`, `projet_id`, `NOM`, `DATEDEBUT`, `DATEFIN`, `NUMEROGALLILIE`, `DESCRIPTION`, `BUDJETRA`, `BUDGETREVU`, `ACTIVE`, `DELETABLE`, `created`, `modified`) VALUES (14, 17, 'EVO ORCHESTRAL', '2013-01-01', '2016-12-31', '000001', NULL, NULL, NULL, 1, 1, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`activites` (`id`, `projet_id`, `NOM`, `DATEDEBUT`, `DATEFIN`, `NUMEROGALLILIE`, `DESCRIPTION`, `BUDJETRA`, `BUDGETREVU`, `ACTIVE`, `DELETABLE`, `created`, `modified`) VALUES (16, 4, 'OSMOSE MCO', '2010-01-01', '2016-12-31', NULL, NULL, NULL, NULL, 1, 1, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`activites` (`id`, `projet_id`, `NOM`, `DATEDEBUT`, `DATEFIN`, `NUMEROGALLILIE`, `DESCRIPTION`, `BUDJETRA`, `BUDGETREVU`, `ACTIVE`, `DELETABLE`, `created`, `modified`) VALUES (12, 1, 'ILD', NULL, NULL, NULL, 'Longue maladie', NULL, NULL, 1, 0, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`activites` (`id`, `projet_id`, `NOM`, `DATEDEBUT`, `DATEFIN`, `NUMEROGALLILIE`, `DESCRIPTION`, `BUDJETRA`, `BUDGETREVU`, `ACTIVE`, `DELETABLE`, `created`, `modified`) VALUES (36, 2, 'Déformation SI', '2011-01-01', '2016-12-31', '000014', NULL, NULL, NULL, 1, 1, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`activites` (`id`, `projet_id`, `NOM`, `DATEDEBUT`, `DATEFIN`, `NUMEROGALLILIE`, `DESCRIPTION`, `BUDJETRA`, `BUDGETREVU`, `ACTIVE`, `DELETABLE`, `created`, `modified`) VALUES (15, 2, 'Développement PUMA', '2011-01-01', '2016-12-31', '000015', NULL, NULL, NULL, 1, 1, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`activites` (`id`, `projet_id`, `NOM`, `DATEDEBUT`, `DATEFIN`, `NUMEROGALLILIE`, `DESCRIPTION`, `BUDJETRA`, `BUDGETREVU`, `ACTIVE`, `DELETABLE`, `created`, `modified`) VALUES (17, 2, 'Pilotage Projet', '2011-01-01', '2016-12-31', '000000000000006', NULL, NULL, NULL, 1, 1, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`activites` (`id`, `projet_id`, `NOM`, `DATEDEBUT`, `DATEFIN`, `NUMEROGALLILIE`, `DESCRIPTION`, `BUDJETRA`, `BUDGETREVU`, `ACTIVE`, `DELETABLE`, `created`, `modified`) VALUES (18, 2, 'Ingénierie formation', '2011-01-01', '2016-12-31', '000013', NULL, NULL, NULL, 1, 1, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`activites` (`id`, `projet_id`, `NOM`, `DATEDEBUT`, `DATEFIN`, `NUMEROGALLILIE`, `DESCRIPTION`, `BUDJETRA`, `BUDGETREVU`, `ACTIVE`, `DELETABLE`, `created`, `modified`) VALUES (19, 2, 'Pilotage PROGRAMME', '2011-01-01', '2016-12-31', '000012', NULL, NULL, NULL, 1, 1, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`activites` (`id`, `projet_id`, `NOM`, `DATEDEBUT`, `DATEFIN`, `NUMEROGALLILIE`, `DESCRIPTION`, `BUDJETRA`, `BUDGETREVU`, `ACTIVE`, `DELETABLE`, `created`, `modified`) VALUES (20, 2, 'Si essieux', '2011-01-01', '2016-12-31', '000016', NULL, NULL, NULL, 1, 1, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`activites` (`id`, `projet_id`, `NOM`, `DATEDEBUT`, `DATEFIN`, `NUMEROGALLILIE`, `DESCRIPTION`, `BUDJETRA`, `BUDGETREVU`, `ACTIVE`, `DELETABLE`, `created`, `modified`) VALUES (21, 2, 'OSMOSE 310 MR', '2011-01-01', '2016-12-31', '000017', NULL, NULL, NULL, 1, 1, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`activites` (`id`, `projet_id`, `NOM`, `DATEDEBUT`, `DATEFIN`, `NUMEROGALLILIE`, `DESCRIPTION`, `BUDJETRA`, `BUDGETREVU`, `ACTIVE`, `DELETABLE`, `created`, `modified`) VALUES (22, 2, 'ORGANES 310', '2011-01-01', '2016-12-31', '000018', NULL, NULL, NULL, 1, 1, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`activites` (`id`, `projet_id`, `NOM`, `DATEDEBUT`, `DATEFIN`, `NUMEROGALLILIE`, `DESCRIPTION`, `BUDJETRA`, `BUDGETREVU`, `ACTIVE`, `DELETABLE`, `created`, `modified`) VALUES (23, 9, 'MCO ORCHESTRAL', '2011-01-01', '2016-12-31', '000001', NULL, NULL, NULL, 1, 1, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`activites` (`id`, `projet_id`, `NOM`, `DATEDEBUT`, `DATEFIN`, `NUMEROGALLILIE`, `DESCRIPTION`, `BUDJETRA`, `BUDGETREVU`, `ACTIVE`, `DELETABLE`, `created`, `modified`) VALUES (24, 3, 'Réalisation Lot 2', '2011-01-01', '2014-12-31', '000005', NULL, NULL, NULL, 1, 1, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`activites` (`id`, `projet_id`, `NOM`, `DATEDEBUT`, `DATEFIN`, `NUMEROGALLILIE`, `DESCRIPTION`, `BUDJETRA`, `BUDGETREVU`, `ACTIVE`, `DELETABLE`, `created`, `modified`) VALUES (25, 3, 'Pilotage programme', '2011-01-01', '2014-12-31', '000006', NULL, NULL, NULL, 1, 1, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`activites` (`id`, `projet_id`, `NOM`, `DATEDEBUT`, `DATEFIN`, `NUMEROGALLILIE`, `DESCRIPTION`, `BUDJETRA`, `BUDGETREVU`, `ACTIVE`, `DELETABLE`, `created`, `modified`) VALUES (26, 3, 'Architecture Lot 1', '2011-01-01', '2014-12-31', '000007', NULL, NULL, NULL, 1, 1, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`activites` (`id`, `projet_id`, `NOM`, `DATEDEBUT`, `DATEFIN`, `NUMEROGALLILIE`, `DESCRIPTION`, `BUDJETRA`, `BUDGETREVU`, `ACTIVE`, `DELETABLE`, `created`, `modified`) VALUES (27, 5, 'Maintenance courante', '2011-01-01', '2014-12-31', '000001', NULL, NULL, NULL, 1, 1, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`activites` (`id`, `projet_id`, `NOM`, `DATEDEBUT`, `DATEFIN`, `NUMEROGALLILIE`, `DESCRIPTION`, `BUDJETRA`, `BUDGETREVU`, `ACTIVE`, `DELETABLE`, `created`, `modified`) VALUES (28, 14, 'Réalisation', '2011-01-01', '2016-12-31', '000001', NULL, NULL, NULL, 1, 1, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`activites` (`id`, `projet_id`, `NOM`, `DATEDEBUT`, `DATEFIN`, `NUMEROGALLILIE`, `DESCRIPTION`, `BUDJETRA`, `BUDGETREVU`, `ACTIVE`, `DELETABLE`, `created`, `modified`) VALUES (29, 14, 'Pilotage de projet', '2011-01-01', '2016-12-31', '000002', NULL, NULL, NULL, 1, 1, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`activites` (`id`, `projet_id`, `NOM`, `DATEDEBUT`, `DATEFIN`, `NUMEROGALLILIE`, `DESCRIPTION`, `BUDJETRA`, `BUDGETREVU`, `ACTIVE`, `DELETABLE`, `created`, `modified`) VALUES (30, 15, 'MCO OSMOSE SGRM', '2011-01-01', '2016-12-31', '000001', NULL, NULL, NULL, 1, 1, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`activites` (`id`, `projet_id`, `NOM`, `DATEDEBUT`, `DATEFIN`, `NUMEROGALLILIE`, `DESCRIPTION`, `BUDJETRA`, `BUDGETREVU`, `ACTIVE`, `DELETABLE`, `created`, `modified`) VALUES (31, 18, 'Pilotage de projet', '2011-01-01', '2016-12-31', '000001', NULL, NULL, NULL, 1, 1, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`activites` (`id`, `projet_id`, `NOM`, `DATEDEBUT`, `DATEFIN`, `NUMEROGALLILIE`, `DESCRIPTION`, `BUDJETRA`, `BUDGETREVU`, `ACTIVE`, `DELETABLE`, `created`, `modified`) VALUES (32, 19, 'Maintenance courante', '2011-01-01', '2016-12-31', '000001', NULL, NULL, NULL, 1, 1, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`activites` (`id`, `projet_id`, `NOM`, `DATEDEBUT`, `DATEFIN`, `NUMEROGALLILIE`, `DESCRIPTION`, `BUDJETRA`, `BUDGETREVU`, `ACTIVE`, `DELETABLE`, `created`, `modified`) VALUES (33, 20, 'Maintenance courante', '2011-01-01', '2016-12-31', '000000000000001', NULL, NULL, NULL, 1, 1, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`activites` (`id`, `projet_id`, `NOM`, `DATEDEBUT`, `DATEFIN`, `NUMEROGALLILIE`, `DESCRIPTION`, `BUDJETRA`, `BUDGETREVU`, `ACTIVE`, `DELETABLE`, `created`, `modified`) VALUES (34, 22, 'Réalisation', '2011-01-01', '2016-12-31', '000001', NULL, NULL, NULL, 1, 1, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`activites` (`id`, `projet_id`, `NOM`, `DATEDEBUT`, `DATEFIN`, `NUMEROGALLILIE`, `DESCRIPTION`, `BUDJETRA`, `BUDGETREVU`, `ACTIVE`, `DELETABLE`, `created`, `modified`) VALUES (35, 21, 'Support Client', '2011-01-01', '2016-12-31', '000000000000001', NULL, NULL, NULL, 1, 1, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`activites` (`id`, `projet_id`, `NOM`, `DATEDEBUT`, `DATEFIN`, `NUMEROGALLILIE`, `DESCRIPTION`, `BUDJETRA`, `BUDGETREVU`, `ACTIVE`, `DELETABLE`, `created`, `modified`) VALUES (37, 1, 'Stages/Formations', NULL, NULL, NULL, 'Formation ou stages suivis', NULL, NULL, 1, 0, '2013-02-01', '2013-02-01');

COMMIT;

-- -----------------------------------------------------
-- Data for table `osact_cake230`.`domaines`
-- -----------------------------------------------------
START TRANSACTION;
USE `osact_cake230`;
INSERT INTO `osact_cake230`.`domaines` (`id`, `NOM`, `DESCRIPTION`, `created`, `modified`) VALUES (1, 'PILOTAGE', 'Tous les hiérarchiques', '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`domaines` (`id`, `NOM`, `DESCRIPTION`, `created`, `modified`) VALUES (2, 'EXPERTISE TECHNIQUE', 'Domaine spécialisé dans l\'urbanisme', '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`domaines` (`id`, `NOM`, `DESCRIPTION`, `created`, `modified`) VALUES (3, 'PLANIFICATION', 'Domaine lié à  la planification', '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`domaines` (`id`, `NOM`, `DESCRIPTION`, `created`, `modified`) VALUES (4, 'LOGISTIQUE', 'Domaine lié à  la logistique pour tous les utilisateurs', '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`domaines` (`id`, `NOM`, `DESCRIPTION`, `created`, `modified`) VALUES (5, 'EXIGENCES', 'Domaines lié aux exigence du projet', '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`domaines` (`id`, `NOM`, `DESCRIPTION`, `created`, `modified`) VALUES (6, 'DOCUMENTATION', 'Domaine lié à  la gestion documentaire', '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`domaines` (`id`, `NOM`, `DESCRIPTION`, `created`, `modified`) VALUES (7, 'GMAO MR', 'Domaine lié à  MAXIMO', '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`domaines` (`id`, `NOM`, `DESCRIPTION`, `created`, `modified`) VALUES (8, 'COHERENCE', 'Domaine lié au projet COHERENCE', '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`domaines` (`id`, `NOM`, `DESCRIPTION`, `created`, `modified`) VALUES (9, 'ORCHESTRAL', 'Domaine lié au projet ORCHESTRAL', '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`domaines` (`id`, `NOM`, `DESCRIPTION`, `created`, `modified`) VALUES (10, 'PANAM', 'Domaine lié au projet PANAM', '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`domaines` (`id`, `NOM`, `DESCRIPTION`, `created`, `modified`) VALUES (11, 'INTEGRATION', 'Domaine lié à  l\'intégration des projets', '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`domaines` (`id`, `NOM`, `DESCRIPTION`, `created`, `modified`) VALUES (12, 'QUALIFICATION', 'Domaine lié à  la qualification des projets', '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`domaines` (`id`, `NOM`, `DESCRIPTION`, `created`, `modified`) VALUES (13, 'ARCHITECTURE', 'Domaine lié à  l\'architecture, cela comprend les tests de performance et technique', '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`domaines` (`id`, `NOM`, `DESCRIPTION`, `created`, `modified`) VALUES (14, 'ENVIRONNEMENT', 'Domaine lié à  la gestion des environnements', '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`domaines` (`id`, `NOM`, `DESCRIPTION`, `created`, `modified`) VALUES (15, 'MISE EN PRODUCTION', 'Domaine lié à  la mise en production des projets', '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`domaines` (`id`, `NOM`, `DESCRIPTION`, `created`, `modified`) VALUES (16, 'REPRISE DE DONNEES', 'Domaine lié à  la reprise de donnée, cela concerne également les bascules ...', '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`domaines` (`id`, `NOM`, `DESCRIPTION`, `created`, `modified`) VALUES (17, 'FORMATION', 'Domaine lié aux formations sur les projets', '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`domaines` (`id`, `NOM`, `DESCRIPTION`, `created`, `modified`) VALUES (18, 'ASSISTANCE PC', 'Domaine lié à  l\'aide et aux retours du PC ASSISTANCE pour les utilisateurs', '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`domaines` (`id`, `NOM`, `DESCRIPTION`, `created`, `modified`) VALUES (19, 'MCO', 'Domaine lié à  la maintenance en condition opérationnelle', '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`domaines` (`id`, `NOM`, `DESCRIPTION`, `created`, `modified`) VALUES (20, 'PO', 'Domaine lié au projet PO remplaçant de PANAM', '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`domaines` (`id`, `NOM`, `DESCRIPTION`, `created`, `modified`) VALUES (21, 'GMAO ORGANES', 'Domaine lié à la GMAO Organes', '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`domaines` (`id`, `NOM`, `DESCRIPTION`, `created`, `modified`) VALUES (22, 'PUMA OSMOSE', 'Domaine lié à PUMA en relation avec le programme OSMOSE', '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`domaines` (`id`, `NOM`, `DESCRIPTION`, `created`, `modified`) VALUES (23, 'SGRM', 'Domaine lié au projet SGRM', '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`domaines` (`id`, `NOM`, `DESCRIPTION`, `created`, `modified`) VALUES (24, 'SI EXISTANTS', 'Domaine lié aux différents SI existant ayant un impact sur le progamme OSMOSE', '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`domaines` (`id`, `NOM`, `DESCRIPTION`, `created`, `modified`) VALUES (25, 'TRANSVERSE', 'Domaine transverse au programme OSMOSE', '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`domaines` (`id`, `NOM`, `DESCRIPTION`, `created`, `modified`) VALUES (26, 'INTEFRACES', 'Domaine lié aux insterfaces du programme OSMOSE avec les autres outils du SI', '2013-02-01', '2013-02-01');

COMMIT;

-- -----------------------------------------------------
-- Data for table `osact_cake230`.`societes`
-- -----------------------------------------------------
START TRANSACTION;
USE `osact_cake230`;
INSERT INTO `osact_cake230`.`societes` (`id`, `NOM`, `NOMCONTACT`, `TELEPHONE`, `MAIL`, `created`, `modified`) VALUES (1, 'SNCF', NULL, NULL, NULL, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`societes` (`id`, `NOM`, `NOMCONTACT`, `TELEPHONE`, `MAIL`, `created`, `modified`) VALUES (2, 'SQLI', NULL, NULL, NULL, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`societes` (`id`, `NOM`, `NOMCONTACT`, `TELEPHONE`, `MAIL`, `created`, `modified`) VALUES (3, 'STERIA', NULL, NULL, NULL, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`societes` (`id`, `NOM`, `NOMCONTACT`, `TELEPHONE`, `MAIL`, `created`, `modified`) VALUES (4, 'ESR GROUP', NULL, NULL, NULL, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`societes` (`id`, `NOM`, `NOMCONTACT`, `TELEPHONE`, `MAIL`, `created`, `modified`) VALUES (5, 'ASTEK', NULL, NULL, NULL, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`societes` (`id`, `NOM`, `NOMCONTACT`, `TELEPHONE`, `MAIL`, `created`, `modified`) VALUES (6, 'SOGETI', NULL, NULL, NULL, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`societes` (`id`, `NOM`, `NOMCONTACT`, `TELEPHONE`, `MAIL`, `created`, `modified`) VALUES (7, 'CAPGEMINI', NULL, NULL, NULL, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`societes` (`id`, `NOM`, `NOMCONTACT`, `TELEPHONE`, `MAIL`, `created`, `modified`) VALUES (8, 'IBM', NULL, NULL, NULL, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`societes` (`id`, `NOM`, `NOMCONTACT`, `TELEPHONE`, `MAIL`, `created`, `modified`) VALUES (9, 'EURIWARE', NULL, NULL, NULL, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`societes` (`id`, `NOM`, `NOMCONTACT`, `TELEPHONE`, `MAIL`, `created`, `modified`) VALUES (10, 'EXL GROUP', NULL, NULL, NULL, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`societes` (`id`, `NOM`, `NOMCONTACT`, `TELEPHONE`, `MAIL`, `created`, `modified`) VALUES (11, 'MDT VISION', NULL, NULL, NULL, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`societes` (`id`, `NOM`, `NOMCONTACT`, `TELEPHONE`, `MAIL`, `created`, `modified`) VALUES (12, 'LOGICA', NULL, NULL, NULL, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`societes` (`id`, `NOM`, `NOMCONTACT`, `TELEPHONE`, `MAIL`, `created`, `modified`) VALUES (13, 'FASTCONNECT', NULL, NULL, NULL, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`societes` (`id`, `NOM`, `NOMCONTACT`, `TELEPHONE`, `MAIL`, `created`, `modified`) VALUES (14, 'GFI', NULL, NULL, NULL, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`societes` (`id`, `NOM`, `NOMCONTACT`, `TELEPHONE`, `MAIL`, `created`, `modified`) VALUES (15, 'OSIATIS', NULL, NULL, NULL, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`societes` (`id`, `NOM`, `NOMCONTACT`, `TELEPHONE`, `MAIL`, `created`, `modified`) VALUES (16, 'AKKA', NULL, NULL, NULL, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`societes` (`id`, `NOM`, `NOMCONTACT`, `TELEPHONE`, `MAIL`, `created`, `modified`) VALUES (17, 'ATOS', NULL, NULL, NULL, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`societes` (`id`, `NOM`, `NOMCONTACT`, `TELEPHONE`, `MAIL`, `created`, `modified`) VALUES (18, 'AXIALOG', NULL, NULL, NULL, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`societes` (`id`, `NOM`, `NOMCONTACT`, `TELEPHONE`, `MAIL`, `created`, `modified`) VALUES (19, 'QUATERNAIRE', NULL, NULL, NULL, '2013-02-01', '2013-02-01');

COMMIT;

-- -----------------------------------------------------
-- Data for table `osact_cake230`.`profils`
-- -----------------------------------------------------
START TRANSACTION;
USE `osact_cake230`;
INSERT INTO `osact_cake230`.`profils` (`id`, `NOM`, `COMMENTAIRE`, `created`, `modified`) VALUES (1, 'ADMINISTRATEUR', 'Profil donnant les droits complet au site', '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`profils` (`id`, `NOM`, `COMMENTAIRE`, `created`, `modified`) VALUES (2, 'Visiteur', 'Autorisé à consulter la liste des liens partagés, pages accueil, contacter nous, aucun droit supplémentaire possible pas la peine de donner des autorisations', '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`profils` (`id`, `NOM`, `COMMENTAIRE`, `created`, `modified`) VALUES (3, 'Pilote', 'Autorisations standards avec en plus accès au budget et aux rapports', '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`profils` (`id`, `NOM`, `COMMENTAIRE`, `created`, `modified`) VALUES (4, 'Resp. équipe', 'Autorisations standards avec en plus accès plus large et non limité à son périmètre', '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`profils` (`id`, `NOM`, `COMMENTAIRE`, `created`, `modified`) VALUES (5, 'Resp. outils', 'Autorisations standards avec en plus des droit pour les ouverture de droits et un accès plus large et non limité à son périmètre', '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`profils` (`id`, `NOM`, `COMMENTAIRE`, `created`, `modified`) VALUES (6, 'Agents DSI-T SO', 'Autorisations standards avec un accès limité à son périmètre', '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`profils` (`id`, `NOM`, `COMMENTAIRE`, `created`, `modified`) VALUES (7, 'Agents GROUPEMENT', 'Autorisations réduites avec un accès limité à son périmètre', '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`profils` (`id`, `NOM`, `COMMENTAIRE`, `created`, `modified`) VALUES (8, 'Admin délégué', 'Autorisations d\'administration réduites', '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`profils` (`id`, `NOM`, `COMMENTAIRE`, `created`, `modified`) VALUES (9, 'Agents MOA', 'Autorisations réduites avec un accès limité à son périmètre', '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`profils` (`id`, `NOM`, `COMMENTAIRE`, `created`, `modified`) VALUES (10, 'Agent DSI-T SO gest. Outils', 'Autorisations standards avec un accès limité à son périmètre et pouvant mettre à jour les ouverture de droits', '2013-02-01', '2013-02-01');

COMMIT;

-- -----------------------------------------------------
-- Data for table `osact_cake230`.`assistances`
-- -----------------------------------------------------
START TRANSACTION;
USE `osact_cake230`;
INSERT INTO `osact_cake230`.`assistances` (`ID`, `NOM`, `DESCRIPTION`, `created`, `modified`) VALUES (1, 'SAMBA', 'Assistance utilisé par DSIT', '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`assistances` (`ID`, `NOM`, `DESCRIPTION`, `created`, `modified`) VALUES (2, 'SAMU', 'Assistance localisée au 15T à PARIS en charge de la logistique pour le MATERIEL', '2013-02-01', '2013-02-01');

COMMIT;

-- -----------------------------------------------------
-- Data for table `osact_cake230`.`sites`
-- -----------------------------------------------------
START TRANSACTION;
USE `osact_cake230`;
INSERT INTO `osact_cake230`.`sites` (`id`, `NOM`, `DESCRIPTION`, `created`, `modified`) VALUES (1, 'OXYGENE', 'SIte lyonnais de DSI-T', '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`sites` (`id`, `NOM`, `DESCRIPTION`, `created`, `modified`) VALUES (2, 'INNOVIA', 'Site parision de DSI-T', '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`sites` (`id`, `NOM`, `DESCRIPTION`, `created`, `modified`) VALUES (3, 'LUMIERE', 'Site parisien du client MATERIEL', '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`sites` (`id`, `NOM`, `DESCRIPTION`, `created`, `modified`) VALUES (4, 'CAPGEMINI NANTES', 'Site de CAPGEMINI à NANTES pour le développement de PANAM ', '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`sites` (`id`, `NOM`, `DESCRIPTION`, `created`, `modified`) VALUES (5, 'SOGETIT VILLEURBANNE', 'Site de SOGETI à VILLEURBANNE pour le développement de COHERENCE et ORCHESTRAL ', '2013-02-01', '2013-02-01');

COMMIT;

-- -----------------------------------------------------
-- Data for table `osact_cake230`.`sections`
-- -----------------------------------------------------
START TRANSACTION;
USE `osact_cake230`;
INSERT INTO `osact_cake230`.`sections` (`id`, `utilisateur_id`, `NOM`, `DESCRIPTION`, `created`, `modified`) VALUES (1, NULL, 'DSI-T/SO MAT GMAO-PANAM', 'Section gérant la GMAO ainsi que tous les autres projets sattelites et tout ce qui est transverse à tous ces projets.', '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`sections` (`id`, `utilisateur_id`, `NOM`, `DESCRIPTION`, `created`, `modified`) VALUES (2, NULL, 'DSI-T/SO MAT INTEGRATION', 'Section gérant l\'intégration des applications du Matériel.', '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`sections` (`id`, `utilisateur_id`, `NOM`, `DESCRIPTION`, `created`, `modified`) VALUES (3, NULL, 'DSI-T/SO MAT OSMOSE REF', 'Section gérant les applications référentielles du Matériel.', '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`sections` (`id`, `utilisateur_id`, `NOM`, `DESCRIPTION`, `created`, `modified`) VALUES (4, NULL, 'GROUPEMENT', 'Section fictive pour les personnes du groupement', '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`sections` (`id`, `utilisateur_id`, `NOM`, `DESCRIPTION`, `created`, `modified`) VALUES (5, NULL, 'MOA', 'Section fictive pour les personnes de la MOA', '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`sections` (`id`, `utilisateur_id`, `NOM`, `DESCRIPTION`, `created`, `modified`) VALUES (6, NULL, 'DSI-T/SO A&E CAMPUS SI', 'Section du CAMPUS SI pour la formation', '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`sections` (`id`, `utilisateur_id`, `NOM`, `DESCRIPTION`, `created`, `modified`) VALUES (7, NULL, 'DSI-T/SO DELIVERY DDSP', 'Section du DELIVERY', '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`sections` (`id`, `utilisateur_id`, `NOM`, `DESCRIPTION`, `created`, `modified`) VALUES (8, NULL, 'DSI-T/SO DECISION MATERIEL', 'Section du décisionnel matériel', '2013-02-01', '2013-02-01');

COMMIT;

-- -----------------------------------------------------
-- Data for table `osact_cake230`.`tjmagents`
-- -----------------------------------------------------
START TRANSACTION;
USE `osact_cake230`;
INSERT INTO `osact_cake230`.`tjmagents` (`id`, `NOM`, `TARIFHT`, `TARIFTTC`, `ANNEE`, `created`, `modified`) VALUES (1, '2012 - QUALIF G', NULL, 544, 2012, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`tjmagents` (`id`, `NOM`, `TARIFHT`, `TARIFTTC`, `ANNEE`, `created`, `modified`) VALUES (2, '2012 - ATOS AST PANAM', NULL, 645, 2012, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`tjmagents` (`id`, `NOM`, `TARIFHT`, `TARIFTTC`, `ANNEE`, `created`, `modified`) VALUES (3, '2012 - EURIWARE Tech. MAXIMO', NULL, 839, 2012, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`tjmagents` (`id`, `NOM`, `TARIFHT`, `TARIFTTC`, `ANNEE`, `created`, `modified`) VALUES (4, '2012 - EURIWARE EXPERT MAXIMO', NULL, 1271, 2012, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`tjmagents` (`id`, `NOM`, `TARIFHT`, `TARIFTTC`, `ANNEE`, `created`, `modified`) VALUES (5, '2012 - EURIWARE Gest. Exigences', NULL, 713, 2012, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`tjmagents` (`id`, `NOM`, `TARIFHT`, `TARIFTTC`, `ANNEE`, `created`, `modified`) VALUES (6, '2012 - STERIA 105', NULL, 713, 2012, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`tjmagents` (`id`, `NOM`, `TARIFHT`, `TARIFTTC`, `ANNEE`, `created`, `modified`) VALUES (7, '2012 - STERIA 101', NULL, 529, 2012, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`tjmagents` (`id`, `NOM`, `TARIFHT`, `TARIFTTC`, `ANNEE`, `created`, `modified`) VALUES (8, '2012 - STERIA 103', NULL, 632, 2012, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`tjmagents` (`id`, `NOM`, `TARIFHT`, `TARIFTTC`, `ANNEE`, `created`, `modified`) VALUES (9, '2012 - QUALIF CS', NULL, 878, 2012, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`tjmagents` (`id`, `NOM`, `TARIFHT`, `TARIFTTC`, `ANNEE`, `created`, `modified`) VALUES (10, '2012 - QUALIF H', NULL, 626, 2012, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`tjmagents` (`id`, `NOM`, `TARIFHT`, `TARIFTTC`, `ANNEE`, `created`, `modified`) VALUES (11, '2012 - QUALIF F', NULL, 477, 2012, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`tjmagents` (`id`, `NOM`, `TARIFHT`, `TARIFTTC`, `ANNEE`, `created`, `modified`) VALUES (12, '2012 - ESR GROUP Architecte', NULL, 709, 2012, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`tjmagents` (`id`, `NOM`, `TARIFHT`, `TARIFTTC`, `ANNEE`, `created`, `modified`) VALUES (13, '2013 - XLGROUP SMY', 603.20, NULL, 2013, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`tjmagents` (`id`, `NOM`, `TARIFHT`, `TARIFTTC`, `ANNEE`, `created`, `modified`) VALUES (14, '2013 - STERIA 107', 579, NULL, 2013, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`tjmagents` (`id`, `NOM`, `TARIFHT`, `TARIFTTC`, `ANNEE`, `created`, `modified`) VALUES (15, '2013 - STERIA 105', 604, NULL, 2013, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`tjmagents` (`id`, `NOM`, `TARIFHT`, `TARIFTTC`, `ANNEE`, `created`, `modified`) VALUES (16, '2013 - STERIA 101', 459, NULL, 2013, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`tjmagents` (`id`, `NOM`, `TARIFHT`, `TARIFTTC`, `ANNEE`, `created`, `modified`) VALUES (17, '2013 - STERIA 103', 547, NULL, 2013, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`tjmagents` (`id`, `NOM`, `TARIFHT`, `TARIFTTC`, `ANNEE`, `created`, `modified`) VALUES (18, '2013 - EURIWARE EXPERT MAXIMO', 1055.60, NULL, 2013, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`tjmagents` (`id`, `NOM`, `TARIFHT`, `TARIFTTC`, `ANNEE`, `created`, `modified`) VALUES (19, '2013 - STERIA 302', 399, NULL, 2013, '2013-02-01', '2013-02-01');

COMMIT;

-- -----------------------------------------------------
-- Data for table `osact_cake230`.`typemateriels`
-- -----------------------------------------------------
START TRANSACTION;
USE `osact_cake230`;
INSERT INTO `osact_cake230`.`typemateriels` (`id`, `NOM`, `DESCRIPTION`, `created`, `modified`) VALUES (1, 'Ordinateur de bureau', 'Ordinateur de bureau à l\'accord cadre', '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`typemateriels` (`id`, `NOM`, `DESCRIPTION`, `created`, `modified`) VALUES (2, 'Portable', 'Portable à l\'accord cadre', '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`typemateriels` (`id`, `NOM`, `DESCRIPTION`, `created`, `modified`) VALUES (3, 'ECRAN 19 pouces', NULL, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`typemateriels` (`id`, `NOM`, `DESCRIPTION`, `created`, `modified`) VALUES (4, 'ECRAN 22 pouces', NULL, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`typemateriels` (`id`, `NOM`, `DESCRIPTION`, `created`, `modified`) VALUES (5, 'ECRAN 24 pouces', NULL, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`typemateriels` (`id`, `NOM`, `DESCRIPTION`, `created`, `modified`) VALUES (6, 'SOURIS', NULL, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`typemateriels` (`id`, `NOM`, `DESCRIPTION`, `created`, `modified`) VALUES (7, 'SOURIS pour portable', NULL, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`typemateriels` (`id`, `NOM`, `DESCRIPTION`, `created`, `modified`) VALUES (8, 'BASE PORTABLE', NULL, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`typemateriels` (`id`, `NOM`, `DESCRIPTION`, `created`, `modified`) VALUES (9, 'CLAVIER', NULL, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`typemateriels` (`id`, `NOM`, `DESCRIPTION`, `created`, `modified`) VALUES (10, 'BATTERIE LONGUE DUREE', NULL, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`typemateriels` (`id`, `NOM`, `DESCRIPTION`, `created`, `modified`) VALUES (11, 'GRAVEUR DVD EXTERNE', NULL, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`typemateriels` (`id`, `NOM`, `DESCRIPTION`, `created`, `modified`) VALUES (12, 'DISQUE DUR EXTERNE 320GO', NULL, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`typemateriels` (`id`, `NOM`, `DESCRIPTION`, `created`, `modified`) VALUES (13, 'SACOCHE', NULL, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`typemateriels` (`id`, `NOM`, `DESCRIPTION`, `created`, `modified`) VALUES (14, 'HOUSSE PROTECTION', NULL, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`typemateriels` (`id`, `NOM`, `DESCRIPTION`, `created`, `modified`) VALUES (15, 'CLE USB 8GO', NULL, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`typemateriels` (`id`, `NOM`, `DESCRIPTION`, `created`, `modified`) VALUES (16, 'CASQUE TELEPHONE', NULL, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`typemateriels` (`id`, `NOM`, `DESCRIPTION`, `created`, `modified`) VALUES (17, 'CABLE RJ45', NULL, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`typemateriels` (`id`, `NOM`, `DESCRIPTION`, `created`, `modified`) VALUES (18, 'ANTIVOL PORTABLE', NULL, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`typemateriels` (`id`, `NOM`, `DESCRIPTION`, `created`, `modified`) VALUES (19, 'BADGE ACCES TO²', NULL, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`typemateriels` (`id`, `NOM`, `DESCRIPTION`, `created`, `modified`) VALUES (20, 'BADGE IMPRESSION', NULL, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`typemateriels` (`id`, `NOM`, `DESCRIPTION`, `created`, `modified`) VALUES (21, 'CLE CAFE', NULL, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`typemateriels` (`id`, `NOM`, `DESCRIPTION`, `created`, `modified`) VALUES (22, 'TELEPHONE ASTREINTE', NULL, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`typemateriels` (`id`, `NOM`, `DESCRIPTION`, `created`, `modified`) VALUES (23, 'CLE VPN', NULL, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`typemateriels` (`id`, `NOM`, `DESCRIPTION`, `created`, `modified`) VALUES (24, 'MS OFFICE 2007', NULL, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`typemateriels` (`id`, `NOM`, `DESCRIPTION`, `created`, `modified`) VALUES (25, 'BADGE PALIER', NULL, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`typemateriels` (`id`, `NOM`, `DESCRIPTION`, `created`, `modified`) VALUES (26, 'MS VISIO 2010', 'Commander la licence', '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`typemateriels` (`id`, `NOM`, `DESCRIPTION`, `created`, `modified`) VALUES (27, 'MS PROJECT 2010', 'Commander la licence', '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`typemateriels` (`id`, `NOM`, `DESCRIPTION`, `created`, `modified`) VALUES (28, 'UC BUREAU station graphique', 'Station graphique Z210 CIV<br />Intel Core i3 - 2120 &agrave; 3.3Ghz - 8 Go de RAM - DD 300 Go<br />OS : Windows 7 x64', '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`typemateriels` (`id`, `NOM`, `DESCRIPTION`, `created`, `modified`) VALUES (29, 'SAC A DOS PORT', 'Marque PORT', '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`typemateriels` (`id`, `NOM`, `DESCRIPTION`, `created`, `modified`) VALUES (30, 'SAC A DOS', '', '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`typemateriels` (`id`, `NOM`, `DESCRIPTION`, `created`, `modified`) VALUES (31, 'ALIMENTATION PORTABLE', NULL, '2013-02-01', '2013-02-01');

COMMIT;

-- -----------------------------------------------------
-- Data for table `osact_cake230`.`utilisateurs`
-- -----------------------------------------------------
START TRANSACTION;
USE `osact_cake230`;
INSERT INTO `osact_cake230`.`utilisateurs` (`id`, `profil_id`, `societe_id`, `assistance_id`, `section_id`, `utilisateur_id`, `domaine_id`, `site_id`, `tjmagent_id`, `dotation_id`, `password`, `username`, `ACTIF`, `DATEDEBUTACTIF`, `NAISSANCE`, `NOM`, `PRENOM`, `COMMENTAIRE`, `FINMISSION`, `MAIL`, `TELEPHONE`, `WORKCAPACITY`, `CONGE`, `RQ`, `VT`, `HIERARCHIQUE`, `GESTIONABSENCES`, `WIDEAREA`, `created`, `modified`) VALUES (1, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, '30d799da0074745df45edf52713e1378', '0000000A', 1, '2013-02-01', '2013-02-01', 'ADMINISTRATEUR', 'Administrateur', 'Mot de passe @DMIN', NULL, NULL, NULL, 100, 0, 0, 0, 0, 0, 1, '2013-02-01', '2013-02-01');

COMMIT;

-- -----------------------------------------------------
-- Data for table `osact_cake230`.`autorisations`
-- -----------------------------------------------------
START TRANSACTION;
USE `osact_cake230`;
INSERT INTO `osact_cake230`.`autorisations` (`id`, `profil_id`, `MODEL`, `INDEX`, `ADD`, `EDIT`, `VIEW`, `DELETE`, `DUPLICATE`, `INITPASSWORD`, `ABSENCES`, `RAPPORTS`, `UPDATE`, `created`, `modified`) VALUES (1, 1, 'achats', 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`autorisations` (`id`, `profil_id`, `MODEL`, `INDEX`, `ADD`, `EDIT`, `VIEW`, `DELETE`, `DUPLICATE`, `INITPASSWORD`, `ABSENCES`, `RAPPORTS`, `UPDATE`, `created`, `modified`) VALUES (2, 1, 'actions', 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`autorisations` (`id`, `profil_id`, `MODEL`, `INDEX`, `ADD`, `EDIT`, `VIEW`, `DELETE`, `DUPLICATE`, `INITPASSWORD`, `ABSENCES`, `RAPPORTS`, `UPDATE`, `created`, `modified`) VALUES (3, 1, 'activites', 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`autorisations` (`id`, `profil_id`, `MODEL`, `INDEX`, `ADD`, `EDIT`, `VIEW`, `DELETE`, `DUPLICATE`, `INITPASSWORD`, `ABSENCES`, `RAPPORTS`, `UPDATE`, `created`, `modified`) VALUES (4, 1, 'affectations', 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`autorisations` (`id`, `profil_id`, `MODEL`, `INDEX`, `ADD`, `EDIT`, `VIEW`, `DELETE`, `DUPLICATE`, `INITPASSWORD`, `ABSENCES`, `RAPPORTS`, `UPDATE`, `created`, `modified`) VALUES (5, 1, 'assistances', 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`autorisations` (`id`, `profil_id`, `MODEL`, `INDEX`, `ADD`, `EDIT`, `VIEW`, `DELETE`, `DUPLICATE`, `INITPASSWORD`, `ABSENCES`, `RAPPORTS`, `UPDATE`, `created`, `modified`) VALUES (6, 1, 'autorisations', 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`autorisations` (`id`, `profil_id`, `MODEL`, `INDEX`, `ADD`, `EDIT`, `VIEW`, `DELETE`, `DUPLICATE`, `INITPASSWORD`, `ABSENCES`, `RAPPORTS`, `UPDATE`, `created`, `modified`) VALUES (7, 1, 'contrats', 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`autorisations` (`id`, `profil_id`, `MODEL`, `INDEX`, `ADD`, `EDIT`, `VIEW`, `DELETE`, `DUPLICATE`, `INITPASSWORD`, `ABSENCES`, `RAPPORTS`, `UPDATE`, `created`, `modified`) VALUES (8, 1, 'domaines', 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`autorisations` (`id`, `profil_id`, `MODEL`, `INDEX`, `ADD`, `EDIT`, `VIEW`, `DELETE`, `DUPLICATE`, `INITPASSWORD`, `ABSENCES`, `RAPPORTS`, `UPDATE`, `created`, `modified`) VALUES (9, 1, 'dossierpartages', 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`autorisations` (`id`, `profil_id`, `MODEL`, `INDEX`, `ADD`, `EDIT`, `VIEW`, `DELETE`, `DUPLICATE`, `INITPASSWORD`, `ABSENCES`, `RAPPORTS`, `UPDATE`, `created`, `modified`) VALUES (10, 1, 'dotations', 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`autorisations` (`id`, `profil_id`, `MODEL`, `INDEX`, `ADD`, `EDIT`, `VIEW`, `DELETE`, `DUPLICATE`, `INITPASSWORD`, `ABSENCES`, `RAPPORTS`, `UPDATE`, `created`, `modified`) VALUES (11, 1, 'hitoryactions', 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`autorisations` (`id`, `profil_id`, `MODEL`, `INDEX`, `ADD`, `EDIT`, `VIEW`, `DELETE`, `DUPLICATE`, `INITPASSWORD`, `ABSENCES`, `RAPPORTS`, `UPDATE`, `created`, `modified`) VALUES (12, 1, 'hitoryutilisateurs', 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`autorisations` (`id`, `profil_id`, `MODEL`, `INDEX`, `ADD`, `EDIT`, `VIEW`, `DELETE`, `DUPLICATE`, `INITPASSWORD`, `ABSENCES`, `RAPPORTS`, `UPDATE`, `created`, `modified`) VALUES (13, 1, 'linkshareds', 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`autorisations` (`id`, `profil_id`, `MODEL`, `INDEX`, `ADD`, `EDIT`, `VIEW`, `DELETE`, `DUPLICATE`, `INITPASSWORD`, `ABSENCES`, `RAPPORTS`, `UPDATE`, `created`, `modified`) VALUES (14, 1, 'listediffusions', 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`autorisations` (`id`, `profil_id`, `MODEL`, `INDEX`, `ADD`, `EDIT`, `VIEW`, `DELETE`, `DUPLICATE`, `INITPASSWORD`, `ABSENCES`, `RAPPORTS`, `UPDATE`, `created`, `modified`) VALUES (15, 1, 'livrables', 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`autorisations` (`id`, `profil_id`, `MODEL`, `INDEX`, `ADD`, `EDIT`, `VIEW`, `DELETE`, `DUPLICATE`, `INITPASSWORD`, `ABSENCES`, `RAPPORTS`, `UPDATE`, `created`, `modified`) VALUES (16, 1, 'materielinformatiques', 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`autorisations` (`id`, `profil_id`, `MODEL`, `INDEX`, `ADD`, `EDIT`, `VIEW`, `DELETE`, `DUPLICATE`, `INITPASSWORD`, `ABSENCES`, `RAPPORTS`, `UPDATE`, `created`, `modified`) VALUES (17, 1, 'messages', 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`autorisations` (`id`, `profil_id`, `MODEL`, `INDEX`, `ADD`, `EDIT`, `VIEW`, `DELETE`, `DUPLICATE`, `INITPASSWORD`, `ABSENCES`, `RAPPORTS`, `UPDATE`, `created`, `modified`) VALUES (18, 1, 'outils', 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`autorisations` (`id`, `profil_id`, `MODEL`, `INDEX`, `ADD`, `EDIT`, `VIEW`, `DELETE`, `DUPLICATE`, `INITPASSWORD`, `ABSENCES`, `RAPPORTS`, `UPDATE`, `created`, `modified`) VALUES (19, 1, 'profils', 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`autorisations` (`id`, `profil_id`, `MODEL`, `INDEX`, `ADD`, `EDIT`, `VIEW`, `DELETE`, `DUPLICATE`, `INITPASSWORD`, `ABSENCES`, `RAPPORTS`, `UPDATE`, `created`, `modified`) VALUES (20, 1, 'projets', 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`autorisations` (`id`, `profil_id`, `MODEL`, `INDEX`, `ADD`, `EDIT`, `VIEW`, `DELETE`, `DUPLICATE`, `INITPASSWORD`, `ABSENCES`, `RAPPORTS`, `UPDATE`, `created`, `modified`) VALUES (21, 1, 'sections', 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`autorisations` (`id`, `profil_id`, `MODEL`, `INDEX`, `ADD`, `EDIT`, `VIEW`, `DELETE`, `DUPLICATE`, `INITPASSWORD`, `ABSENCES`, `RAPPORTS`, `UPDATE`, `created`, `modified`) VALUES (22, 1, 'sites', 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`autorisations` (`id`, `profil_id`, `MODEL`, `INDEX`, `ADD`, `EDIT`, `VIEW`, `DELETE`, `DUPLICATE`, `INITPASSWORD`, `ABSENCES`, `RAPPORTS`, `UPDATE`, `created`, `modified`) VALUES (23, 1, 'societes', 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`autorisations` (`id`, `profil_id`, `MODEL`, `INDEX`, `ADD`, `EDIT`, `VIEW`, `DELETE`, `DUPLICATE`, `INITPASSWORD`, `ABSENCES`, `RAPPORTS`, `UPDATE`, `created`, `modified`) VALUES (24, 1, 'suivilivrables', 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`autorisations` (`id`, `profil_id`, `MODEL`, `INDEX`, `ADD`, `EDIT`, `VIEW`, `DELETE`, `DUPLICATE`, `INITPASSWORD`, `ABSENCES`, `RAPPORTS`, `UPDATE`, `created`, `modified`) VALUES (25, 1, 'tjmagents', 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`autorisations` (`id`, `profil_id`, `MODEL`, `INDEX`, `ADD`, `EDIT`, `VIEW`, `DELETE`, `DUPLICATE`, `INITPASSWORD`, `ABSENCES`, `RAPPORTS`, `UPDATE`, `created`, `modified`) VALUES (26, 1, 'tjmcontrats', 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`autorisations` (`id`, `profil_id`, `MODEL`, `INDEX`, `ADD`, `EDIT`, `VIEW`, `DELETE`, `DUPLICATE`, `INITPASSWORD`, `ABSENCES`, `RAPPORTS`, `UPDATE`, `created`, `modified`) VALUES (27, 1, 'typemateriels', 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`autorisations` (`id`, `profil_id`, `MODEL`, `INDEX`, `ADD`, `EDIT`, `VIEW`, `DELETE`, `DUPLICATE`, `INITPASSWORD`, `ABSENCES`, `RAPPORTS`, `UPDATE`, `created`, `modified`) VALUES (28, 1, 'utilisateurs', 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`autorisations` (`id`, `profil_id`, `MODEL`, `INDEX`, `ADD`, `EDIT`, `VIEW`, `DELETE`, `DUPLICATE`, `INITPASSWORD`, `ABSENCES`, `RAPPORTS`, `UPDATE`, `created`, `modified`) VALUES (29, 1, 'utiliseoutils', 1, 1, 1, 1, 1, 0, 0, 0, 0, 1, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`autorisations` (`id`, `profil_id`, `MODEL`, `INDEX`, `ADD`, `EDIT`, `VIEW`, `DELETE`, `DUPLICATE`, `INITPASSWORD`, `ABSENCES`, `RAPPORTS`, `UPDATE`, `created`, `modified`) VALUES (30, 1, 'actionslivrables', 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`autorisations` (`id`, `profil_id`, `MODEL`, `INDEX`, `ADD`, `EDIT`, `VIEW`, `DELETE`, `DUPLICATE`, `INITPASSWORD`, `ABSENCES`, `RAPPORTS`, `UPDATE`, `created`, `modified`) VALUES (31, 1, 'activitesreelles', 1, 1, 1, 1, 1, 1, 0, 1, 1, 1, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`autorisations` (`id`, `profil_id`, `MODEL`, `INDEX`, `ADD`, `EDIT`, `VIEW`, `DELETE`, `DUPLICATE`, `INITPASSWORD`, `ABSENCES`, `RAPPORTS`, `UPDATE`, `created`, `modified`) VALUES (32, 1, 'facturations', 1, 1, 1, 1, 1, 0, 0, 0, 1, 0, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`autorisations` (`id`, `profil_id`, `MODEL`, `INDEX`, `ADD`, `EDIT`, `VIEW`, `DELETE`, `DUPLICATE`, `INITPASSWORD`, `ABSENCES`, `RAPPORTS`, `UPDATE`, `created`, `modified`) VALUES (33, 1, 'plandecharges', 1, 1, 1, 1, 1, 0, 0, 0, 1, 0, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`autorisations` (`id`, `profil_id`, `MODEL`, `INDEX`, `ADD`, `EDIT`, `VIEW`, `DELETE`, `DUPLICATE`, `INITPASSWORD`, `ABSENCES`, `RAPPORTS`, `UPDATE`, `created`, `modified`) VALUES (34, 1, 'rapports', 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`autorisations` (`id`, `profil_id`, `MODEL`, `INDEX`, `ADD`, `EDIT`, `VIEW`, `DELETE`, `DUPLICATE`, `INITPASSWORD`, `ABSENCES`, `RAPPORTS`, `UPDATE`, `created`, `modified`) VALUES (35, 3, 'actions', 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`autorisations` (`id`, `profil_id`, `MODEL`, `INDEX`, `ADD`, `EDIT`, `VIEW`, `DELETE`, `DUPLICATE`, `INITPASSWORD`, `ABSENCES`, `RAPPORTS`, `UPDATE`, `created`, `modified`) VALUES (36, 3, 'activitesreelles', 1, 1, 1, 1, 1, 1, 0, 1, 1, 0, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`autorisations` (`id`, `profil_id`, `MODEL`, `INDEX`, `ADD`, `EDIT`, `VIEW`, `DELETE`, `DUPLICATE`, `INITPASSWORD`, `ABSENCES`, `RAPPORTS`, `UPDATE`, `created`, `modified`) VALUES (37, 3, 'livrables', 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`autorisations` (`id`, `profil_id`, `MODEL`, `INDEX`, `ADD`, `EDIT`, `VIEW`, `DELETE`, `DUPLICATE`, `INITPASSWORD`, `ABSENCES`, `RAPPORTS`, `UPDATE`, `created`, `modified`) VALUES (38, 3, 'materielinformatiques', 1, 0, 0, 1, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`autorisations` (`id`, `profil_id`, `MODEL`, `INDEX`, `ADD`, `EDIT`, `VIEW`, `DELETE`, `DUPLICATE`, `INITPASSWORD`, `ABSENCES`, `RAPPORTS`, `UPDATE`, `created`, `modified`) VALUES (39, 3, 'utilisateurs', 1, 0, 0, 1, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`autorisations` (`id`, `profil_id`, `MODEL`, `INDEX`, `ADD`, `EDIT`, `VIEW`, `DELETE`, `DUPLICATE`, `INITPASSWORD`, `ABSENCES`, `RAPPORTS`, `UPDATE`, `created`, `modified`) VALUES (40, 3, 'achats', 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`autorisations` (`id`, `profil_id`, `MODEL`, `INDEX`, `ADD`, `EDIT`, `VIEW`, `DELETE`, `DUPLICATE`, `INITPASSWORD`, `ABSENCES`, `RAPPORTS`, `UPDATE`, `created`, `modified`) VALUES (41, 3, 'activites', 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`autorisations` (`id`, `profil_id`, `MODEL`, `INDEX`, `ADD`, `EDIT`, `VIEW`, `DELETE`, `DUPLICATE`, `INITPASSWORD`, `ABSENCES`, `RAPPORTS`, `UPDATE`, `created`, `modified`) VALUES (42, 3, 'affectations', 1, 0, 0, 1, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`autorisations` (`id`, `profil_id`, `MODEL`, `INDEX`, `ADD`, `EDIT`, `VIEW`, `DELETE`, `DUPLICATE`, `INITPASSWORD`, `ABSENCES`, `RAPPORTS`, `UPDATE`, `created`, `modified`) VALUES (43, 3, 'contrats', 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`autorisations` (`id`, `profil_id`, `MODEL`, `INDEX`, `ADD`, `EDIT`, `VIEW`, `DELETE`, `DUPLICATE`, `INITPASSWORD`, `ABSENCES`, `RAPPORTS`, `UPDATE`, `created`, `modified`) VALUES (44, 3, 'domaines', 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`autorisations` (`id`, `profil_id`, `MODEL`, `INDEX`, `ADD`, `EDIT`, `VIEW`, `DELETE`, `DUPLICATE`, `INITPASSWORD`, `ABSENCES`, `RAPPORTS`, `UPDATE`, `created`, `modified`) VALUES (45, 3, 'listediffusions', 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`autorisations` (`id`, `profil_id`, `MODEL`, `INDEX`, `ADD`, `EDIT`, `VIEW`, `DELETE`, `DUPLICATE`, `INITPASSWORD`, `ABSENCES`, `RAPPORTS`, `UPDATE`, `created`, `modified`) VALUES (46, 3, 'messages', 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`autorisations` (`id`, `profil_id`, `MODEL`, `INDEX`, `ADD`, `EDIT`, `VIEW`, `DELETE`, `DUPLICATE`, `INITPASSWORD`, `ABSENCES`, `RAPPORTS`, `UPDATE`, `created`, `modified`) VALUES (47, 3, 'projets', 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`autorisations` (`id`, `profil_id`, `MODEL`, `INDEX`, `ADD`, `EDIT`, `VIEW`, `DELETE`, `DUPLICATE`, `INITPASSWORD`, `ABSENCES`, `RAPPORTS`, `UPDATE`, `created`, `modified`) VALUES (48, 3, 'societes', 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`autorisations` (`id`, `profil_id`, `MODEL`, `INDEX`, `ADD`, `EDIT`, `VIEW`, `DELETE`, `DUPLICATE`, `INITPASSWORD`, `ABSENCES`, `RAPPORTS`, `UPDATE`, `created`, `modified`) VALUES (49, 3, 'suivilivrables', 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`autorisations` (`id`, `profil_id`, `MODEL`, `INDEX`, `ADD`, `EDIT`, `VIEW`, `DELETE`, `DUPLICATE`, `INITPASSWORD`, `ABSENCES`, `RAPPORTS`, `UPDATE`, `created`, `modified`) VALUES (50, 3, 'tjmagents', 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`autorisations` (`id`, `profil_id`, `MODEL`, `INDEX`, `ADD`, `EDIT`, `VIEW`, `DELETE`, `DUPLICATE`, `INITPASSWORD`, `ABSENCES`, `RAPPORTS`, `UPDATE`, `created`, `modified`) VALUES (51, 3, 'tjmcontrats', 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`autorisations` (`id`, `profil_id`, `MODEL`, `INDEX`, `ADD`, `EDIT`, `VIEW`, `DELETE`, `DUPLICATE`, `INITPASSWORD`, `ABSENCES`, `RAPPORTS`, `UPDATE`, `created`, `modified`) VALUES (52, 4, 'actions', 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`autorisations` (`id`, `profil_id`, `MODEL`, `INDEX`, `ADD`, `EDIT`, `VIEW`, `DELETE`, `DUPLICATE`, `INITPASSWORD`, `ABSENCES`, `RAPPORTS`, `UPDATE`, `created`, `modified`) VALUES (53, 4, 'activitesreelles', 1, 1, 1, 1, 1, 1, 0, 1, 0, 0, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`autorisations` (`id`, `profil_id`, `MODEL`, `INDEX`, `ADD`, `EDIT`, `VIEW`, `DELETE`, `DUPLICATE`, `INITPASSWORD`, `ABSENCES`, `RAPPORTS`, `UPDATE`, `created`, `modified`) VALUES (54, 4, 'livrables', 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`autorisations` (`id`, `profil_id`, `MODEL`, `INDEX`, `ADD`, `EDIT`, `VIEW`, `DELETE`, `DUPLICATE`, `INITPASSWORD`, `ABSENCES`, `RAPPORTS`, `UPDATE`, `created`, `modified`) VALUES (55, 4, 'utilisateurs', 1, 0, 0, 1, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`autorisations` (`id`, `profil_id`, `MODEL`, `INDEX`, `ADD`, `EDIT`, `VIEW`, `DELETE`, `DUPLICATE`, `INITPASSWORD`, `ABSENCES`, `RAPPORTS`, `UPDATE`, `created`, `modified`) VALUES (56, 4, 'affectations', 1, 0, 0, 1, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`autorisations` (`id`, `profil_id`, `MODEL`, `INDEX`, `ADD`, `EDIT`, `VIEW`, `DELETE`, `DUPLICATE`, `INITPASSWORD`, `ABSENCES`, `RAPPORTS`, `UPDATE`, `created`, `modified`) VALUES (57, 4, 'listediffusions', 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`autorisations` (`id`, `profil_id`, `MODEL`, `INDEX`, `ADD`, `EDIT`, `VIEW`, `DELETE`, `DUPLICATE`, `INITPASSWORD`, `ABSENCES`, `RAPPORTS`, `UPDATE`, `created`, `modified`) VALUES (58, 4, 'messages', 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`autorisations` (`id`, `profil_id`, `MODEL`, `INDEX`, `ADD`, `EDIT`, `VIEW`, `DELETE`, `DUPLICATE`, `INITPASSWORD`, `ABSENCES`, `RAPPORTS`, `UPDATE`, `created`, `modified`) VALUES (59, 4, 'societes', 1, 0, 0, 1, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`autorisations` (`id`, `profil_id`, `MODEL`, `INDEX`, `ADD`, `EDIT`, `VIEW`, `DELETE`, `DUPLICATE`, `INITPASSWORD`, `ABSENCES`, `RAPPORTS`, `UPDATE`, `created`, `modified`) VALUES (60, 4, 'suivilivrables', 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`autorisations` (`id`, `profil_id`, `MODEL`, `INDEX`, `ADD`, `EDIT`, `VIEW`, `DELETE`, `DUPLICATE`, `INITPASSWORD`, `ABSENCES`, `RAPPORTS`, `UPDATE`, `created`, `modified`) VALUES (61, 4, 'materielinformatiques', 1, 0, 0, 1, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`autorisations` (`id`, `profil_id`, `MODEL`, `INDEX`, `ADD`, `EDIT`, `VIEW`, `DELETE`, `DUPLICATE`, `INITPASSWORD`, `ABSENCES`, `RAPPORTS`, `UPDATE`, `created`, `modified`) VALUES (62, 5, 'actions', 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`autorisations` (`id`, `profil_id`, `MODEL`, `INDEX`, `ADD`, `EDIT`, `VIEW`, `DELETE`, `DUPLICATE`, `INITPASSWORD`, `ABSENCES`, `RAPPORTS`, `UPDATE`, `created`, `modified`) VALUES (63, 5, 'activitesreelles', 1, 1, 1, 1, 1, 1, 0, 1, 0, 1, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`autorisations` (`id`, `profil_id`, `MODEL`, `INDEX`, `ADD`, `EDIT`, `VIEW`, `DELETE`, `DUPLICATE`, `INITPASSWORD`, `ABSENCES`, `RAPPORTS`, `UPDATE`, `created`, `modified`) VALUES (64, 5, 'livrables', 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`autorisations` (`id`, `profil_id`, `MODEL`, `INDEX`, `ADD`, `EDIT`, `VIEW`, `DELETE`, `DUPLICATE`, `INITPASSWORD`, `ABSENCES`, `RAPPORTS`, `UPDATE`, `created`, `modified`) VALUES (65, 5, 'utilisateurs', 1, 0, 0, 1, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`autorisations` (`id`, `profil_id`, `MODEL`, `INDEX`, `ADD`, `EDIT`, `VIEW`, `DELETE`, `DUPLICATE`, `INITPASSWORD`, `ABSENCES`, `RAPPORTS`, `UPDATE`, `created`, `modified`) VALUES (66, 5, 'affectations', 1, 0, 0, 1, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`autorisations` (`id`, `profil_id`, `MODEL`, `INDEX`, `ADD`, `EDIT`, `VIEW`, `DELETE`, `DUPLICATE`, `INITPASSWORD`, `ABSENCES`, `RAPPORTS`, `UPDATE`, `created`, `modified`) VALUES (67, 5, 'listediffusions', 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`autorisations` (`id`, `profil_id`, `MODEL`, `INDEX`, `ADD`, `EDIT`, `VIEW`, `DELETE`, `DUPLICATE`, `INITPASSWORD`, `ABSENCES`, `RAPPORTS`, `UPDATE`, `created`, `modified`) VALUES (68, 5, 'messages', 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`autorisations` (`id`, `profil_id`, `MODEL`, `INDEX`, `ADD`, `EDIT`, `VIEW`, `DELETE`, `DUPLICATE`, `INITPASSWORD`, `ABSENCES`, `RAPPORTS`, `UPDATE`, `created`, `modified`) VALUES (69, 5, 'societes', 1, 0, 0, 1, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`autorisations` (`id`, `profil_id`, `MODEL`, `INDEX`, `ADD`, `EDIT`, `VIEW`, `DELETE`, `DUPLICATE`, `INITPASSWORD`, `ABSENCES`, `RAPPORTS`, `UPDATE`, `created`, `modified`) VALUES (70, 5, 'suivilivrables', 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`autorisations` (`id`, `profil_id`, `MODEL`, `INDEX`, `ADD`, `EDIT`, `VIEW`, `DELETE`, `DUPLICATE`, `INITPASSWORD`, `ABSENCES`, `RAPPORTS`, `UPDATE`, `created`, `modified`) VALUES (71, 5, 'materielinformatiques', 1, 0, 0, 1, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`autorisations` (`id`, `profil_id`, `MODEL`, `INDEX`, `ADD`, `EDIT`, `VIEW`, `DELETE`, `DUPLICATE`, `INITPASSWORD`, `ABSENCES`, `RAPPORTS`, `UPDATE`, `created`, `modified`) VALUES (72, 5, 'utiliseoutils', 1, 0, 1, 1, 0, 0, 0, 0, 0, 1, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`autorisations` (`id`, `profil_id`, `MODEL`, `INDEX`, `ADD`, `EDIT`, `VIEW`, `DELETE`, `DUPLICATE`, `INITPASSWORD`, `ABSENCES`, `RAPPORTS`, `UPDATE`, `created`, `modified`) VALUES (73, 6, 'actions', 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`autorisations` (`id`, `profil_id`, `MODEL`, `INDEX`, `ADD`, `EDIT`, `VIEW`, `DELETE`, `DUPLICATE`, `INITPASSWORD`, `ABSENCES`, `RAPPORTS`, `UPDATE`, `created`, `modified`) VALUES (74, 6, 'activitesreelles', 1, 1, 1, 1, 1, 1, 0, 1, 0, 0, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`autorisations` (`id`, `profil_id`, `MODEL`, `INDEX`, `ADD`, `EDIT`, `VIEW`, `DELETE`, `DUPLICATE`, `INITPASSWORD`, `ABSENCES`, `RAPPORTS`, `UPDATE`, `created`, `modified`) VALUES (75, 6, 'livrables', 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`autorisations` (`id`, `profil_id`, `MODEL`, `INDEX`, `ADD`, `EDIT`, `VIEW`, `DELETE`, `DUPLICATE`, `INITPASSWORD`, `ABSENCES`, `RAPPORTS`, `UPDATE`, `created`, `modified`) VALUES (76, 9, 'activitesreelles', 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`autorisations` (`id`, `profil_id`, `MODEL`, `INDEX`, `ADD`, `EDIT`, `VIEW`, `DELETE`, `DUPLICATE`, `INITPASSWORD`, `ABSENCES`, `RAPPORTS`, `UPDATE`, `created`, `modified`) VALUES (77, 10, 'actions', 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`autorisations` (`id`, `profil_id`, `MODEL`, `INDEX`, `ADD`, `EDIT`, `VIEW`, `DELETE`, `DUPLICATE`, `INITPASSWORD`, `ABSENCES`, `RAPPORTS`, `UPDATE`, `created`, `modified`) VALUES (78, 10, 'activitesreelles', 1, 1, 1, 1, 1, 1, 0, 1, 0, 0, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`autorisations` (`id`, `profil_id`, `MODEL`, `INDEX`, `ADD`, `EDIT`, `VIEW`, `DELETE`, `DUPLICATE`, `INITPASSWORD`, `ABSENCES`, `RAPPORTS`, `UPDATE`, `created`, `modified`) VALUES (79, 10, 'livrables', 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`autorisations` (`id`, `profil_id`, `MODEL`, `INDEX`, `ADD`, `EDIT`, `VIEW`, `DELETE`, `DUPLICATE`, `INITPASSWORD`, `ABSENCES`, `RAPPORTS`, `UPDATE`, `created`, `modified`) VALUES (80, 10, 'utiliseoutils', 1, 0, 1, 1, 0, 0, 0, 0, 0, 1, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`autorisations` (`id`, `profil_id`, `MODEL`, `INDEX`, `ADD`, `EDIT`, `VIEW`, `DELETE`, `DUPLICATE`, `INITPASSWORD`, `ABSENCES`, `RAPPORTS`, `UPDATE`, `created`, `modified`) VALUES (81, 8, 'materielinformatiques', 1, 0, 0, 1, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`autorisations` (`id`, `profil_id`, `MODEL`, `INDEX`, `ADD`, `EDIT`, `VIEW`, `DELETE`, `DUPLICATE`, `INITPASSWORD`, `ABSENCES`, `RAPPORTS`, `UPDATE`, `created`, `modified`) VALUES (82, 8, 'utilisateurs', 1, 1, 0, 1, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01');

COMMIT;

-- -----------------------------------------------------
-- Data for table `osact_cake230`.`dossierpartages`
-- -----------------------------------------------------
START TRANSACTION;
USE `osact_cake230`;
INSERT INTO `osact_cake230`.`dossierpartages` (`id`, `NOM`, `GROUPEAD`, `DESCRIPTION`, `created`, `modified`) VALUES (1, 'OSMOSE-MOA-MOE', 'DSIT_EM-OSMOSE-MDTV_GG', '\\commun\\dsit_buro\\Partages\\EM\\OSMOSE-MOA-MOE', '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`dossierpartages` (`id`, `NOM`, `GROUPEAD`, `DESCRIPTION`, `created`, `modified`) VALUES (2, 'GMAO', 'DSIT_P-GMAO-M_GG', '\\commun\\dsit_buro\\Partages\\GMAO', '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`dossierpartages` (`id`, `NOM`, `GROUPEAD`, `DESCRIPTION`, `created`, `modified`) VALUES (3, 'OSMOSE', 'DSIT_C-EMM-OSMOSE-M_GG', '\\commun\\dsit_buro\\Communs\\DSIT\\EMM\\OSMOSE', '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`dossierpartages` (`id`, `NOM`, `GROUPEAD`, `DESCRIPTION`, `created`, `modified`) VALUES (4, 'OSMOSECSNROP', 'DSIT_C-EMM-OSMOSECSNROP-M_GG', '\\commun\\dsit_buro\\Communs\\DSIT\\EMM\\OSMOSECSNROP', '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`dossierpartages` (`id`, `NOM`, `GROUPEAD`, `DESCRIPTION`, `created`, `modified`) VALUES (5, 'PANAM', 'DSIT_P-EM-PANAM-M_GG', '\\commun\\dsit_buro÷Partages\\EM\\PANAM', '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`dossierpartages` (`id`, `NOM`, `GROUPEAD`, `DESCRIPTION`, `created`, `modified`) VALUES (6, 'MOA', 'Partage MOA', 'Géré par la MOA-SI contact : Eric COURRIER envoyer une demande par mail', '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`dossierpartages` (`id`, `NOM`, `GROUPEAD`, `DESCRIPTION`, `created`, `modified`) VALUES (7, 'TRAVAIL E-X', 'DSIT_EMM-OA-USR_GG', '\\commun\\dsit_buro\\Partages\\DSIT-E-X-Travail\\M\\OSMOSE\\Environnements', '2013-02-01', '2013-02-01');

COMMIT;

-- -----------------------------------------------------
-- Data for table `osact_cake230`.`linkshareds`
-- -----------------------------------------------------
START TRANSACTION;
USE `osact_cake230`;
INSERT INTO `osact_cake230`.`linkshareds` (`id`, `utilisateur_id`, `NOM`, `LINK`, `created`, `modified`) VALUES (1, 1, 'MINIDOC OSMOSE', 'http://dsite.minidoc.sncf.fr/defaultOSMOSE.asp', '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`linkshareds` (`id`, `utilisateur_id`, `NOM`, `LINK`, `created`, `modified`) VALUES (2, 1, 'Quality Center', 'http://quality-center.dsit.sncf.fr/qcbin/', '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`linkshareds` (`id`, `utilisateur_id`, `NOM`, `LINK`, `created`, `modified`) VALUES (3, 1, 'Outils congés agents SNCF', 'https://conges.rh.sncf.fr/auth.php?etat=nocookie', '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`linkshareds` (`id`, `utilisateur_id`, `NOM`, `LINK`, `created`, `modified`) VALUES (4, 1, 'Service général', 'https://services.ddet.sncf.fr', '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`linkshareds` (`id`, `utilisateur_id`, `NOM`, `LINK`, `created`, `modified`) VALUES (5, 1, 'Gare en mouvement Part-Dieu', 'http://www.gares-en-mouvement.com/fr/frlpd/horaires-temps-reel/dep/', '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`linkshareds` (`id`, `utilisateur_id`, `NOM`, `LINK`, `created`, `modified`) VALUES (6, 1, 'DSIPEDIA', 'http://dsipedia.sncf.fr/index.php?title=Accueil', '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`linkshareds` (`id`, `utilisateur_id`, `NOM`, `LINK`, `created`, `modified`) VALUES (7, 1, 'OSMOSE Flash actu', 'http://www9.mt.sncf.fr/osmose/index.php', '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`linkshareds` (`id`, `utilisateur_id`, `NOM`, `LINK`, `created`, `modified`) VALUES (8, 1, 'Achats accord cadre', 'http://rcc.achats.sncf.fr/AppCmd/MnuApp.asp', '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`linkshareds` (`id`, `utilisateur_id`, `NOM`, `LINK`, `created`, `modified`) VALUES (9, 1, 'ERP achats/GALILEI', 'https://www.erp.sncf.fr/psp/FPROD/?cmd=login&languageCd=FRA&', '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`linkshareds` (`id`, `utilisateur_id`, `NOM`, `LINK`, `created`, `modified`) VALUES (11, 1, 'ORIC', 'http://oric.sg.sncf.fr/Default.aspx', '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`linkshareds` (`id`, `utilisateur_id`, `NOM`, `LINK`, `created`, `modified`) VALUES (12, 1, 'OWA', 'https://webmail.sncf.fr/owa/auth/logon.aspx?replaceCurrent=1&url=https%3a%2f%2fwebmail.sncf.fr%2fowa%2f', '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`linkshareds` (`id`, `utilisateur_id`, `NOM`, `LINK`, `created`, `modified`) VALUES (13, 1, 'Password reset manager', 'https://consolearw.ad.sncf.fr/PRMSelfService/main.asp?LCID=fr', '2013-02-01', '2013-02-01');

COMMIT;

-- -----------------------------------------------------
-- Data for table `osact_cake230`.`listediffusions`
-- -----------------------------------------------------
START TRANSACTION;
USE `osact_cake230`;
INSERT INTO `osact_cake230`.`listediffusions` (`id`, `utilisateur_id`, `NOM`, `DESCRIPTION`, `created`, `modified`) VALUES (1, NULL, '*OSMOSE DSI-T', 'Ajouter tous les agents SNCF de DSIT qui sont sur le projet', '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`listediffusions` (`id`, `utilisateur_id`, `NOM`, `DESCRIPTION`, `created`, `modified`) VALUES (2, NULL, '*OSMOSE DSI-T Architecture', 'Ajouter les personnes du domaine ARCHITECTURE', '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`listediffusions` (`id`, `utilisateur_id`, `NOM`, `DESCRIPTION`, `created`, `modified`) VALUES (3, NULL, '*OSMOSE DSI-T COHERENCE', 'Ajouter les personnes travaillant sur COHERENCE', '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`listediffusions` (`id`, `utilisateur_id`, `NOM`, `DESCRIPTION`, `created`, `modified`) VALUES (4, NULL, '*OSMOSE DSI-T Elargie', 'Ajouter tous les agents SNCF et prestataires de DSIT', '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`listediffusions` (`id`, `utilisateur_id`, `NOM`, `DESCRIPTION`, `created`, `modified`) VALUES (5, NULL, '*OSMOSE DSI-T Gestion Environnement', 'Géré par la liste *OCO Intégration', '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`listediffusions` (`id`, `utilisateur_id`, `NOM`, `DESCRIPTION`, `created`, `modified`) VALUES (6, NULL, '*OSMOSE DSI-T Gestion Exigences', 'Ajouter les personnes travaillant sur le domaine EXIGENCES', '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`listediffusions` (`id`, `utilisateur_id`, `NOM`, `DESCRIPTION`, `created`, `modified`) VALUES (7, NULL, '*OSMOSE DSI-T GMAO', 'Ajouter les personnes du domaine GMAO', '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`listediffusions` (`id`, `utilisateur_id`, `NOM`, `DESCRIPTION`, `created`, `modified`) VALUES (8, NULL, '*OSMOSE DSI-T Intégration', 'Géré par la liste *OCO Intégration', '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`listediffusions` (`id`, `utilisateur_id`, `NOM`, `DESCRIPTION`, `created`, `modified`) VALUES (9, NULL, '*OSMOSE DSI-T Interfaces', 'Ajouter les personnes du domaine INTERFACES', '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`listediffusions` (`id`, `utilisateur_id`, `NOM`, `DESCRIPTION`, `created`, `modified`) VALUES (10, NULL, '*OSMOSE DSI-T Logistique', 'Ajouter les personnes en gestion de la logistique', '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`listediffusions` (`id`, `utilisateur_id`, `NOM`, `DESCRIPTION`, `created`, `modified`) VALUES (11, NULL, '*OSMOSE DSI-T MCO', 'Ajouter les personnes en charge du domaine MCO', '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`listediffusions` (`id`, `utilisateur_id`, `NOM`, `DESCRIPTION`, `created`, `modified`) VALUES (12, NULL, '*OSMOSE DSI-T ORCHESTRAL', 'Ajouter les personnes qui ont la charge du domaine ORCHESTRAL', '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`listediffusions` (`id`, `utilisateur_id`, `NOM`, `DESCRIPTION`, `created`, `modified`) VALUES (13, NULL, '*OSMOSE DSI-T OSMOVISION', 'Ajouter les personnes qui ont la charge de OSMOVISION', '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`listediffusions` (`id`, `utilisateur_id`, `NOM`, `DESCRIPTION`, `created`, `modified`) VALUES (14, NULL, '*OSMOSE DSI-T PANAM', 'Ajouter les personne du projet PANAM', '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`listediffusions` (`id`, `utilisateur_id`, `NOM`, `DESCRIPTION`, `created`, `modified`) VALUES (15, NULL, '*OSMOSE DSI-T PANAM MC', 'Ajouter les personne du projet PANAM de DSIT-EC', '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`listediffusions` (`id`, `utilisateur_id`, `NOM`, `DESCRIPTION`, `created`, `modified`) VALUES (16, NULL, '*OSMOSE DSI-T Pilotage', 'Ajouter les pilotes du projet', '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`listediffusions` (`id`, `utilisateur_id`, `NOM`, `DESCRIPTION`, `created`, `modified`) VALUES (17, NULL, '*OSMOSE DSI-T PMO', 'Ajouter les pilotes et ceux qui s\'occupe de la planification du projet', '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`listediffusions` (`id`, `utilisateur_id`, `NOM`, `DESCRIPTION`, `created`, `modified`) VALUES (18, NULL, '*OSMOSE DSI-T Production', 'Géré par la liste *OSMOSE Production', '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`listediffusions` (`id`, `utilisateur_id`, `NOM`, `DESCRIPTION`, `created`, `modified`) VALUES (19, NULL, '*OSMOSE DSI-T PUMA', 'Ajouter les personnes en relation avec PUMA', '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`listediffusions` (`id`, `utilisateur_id`, `NOM`, `DESCRIPTION`, `created`, `modified`) VALUES (20, NULL, '*OSMOSE DSI-T Reprise de Données', 'Ajouter les personne en charge du domaine REPRISE DE DONNEES', '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`listediffusions` (`id`, `utilisateur_id`, `NOM`, `DESCRIPTION`, `created`, `modified`) VALUES (21, NULL, '*OSMOSE DSI-T T-RESEAU', 'Ajouter les personnes en charge du réseau', '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`listediffusions` (`id`, `utilisateur_id`, `NOM`, `DESCRIPTION`, `created`, `modified`) VALUES (22, NULL, '*OSMOSE Fiabilisation', 'Ajouter les personnes en charge de la fiabilisation', '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`listediffusions` (`id`, `utilisateur_id`, `NOM`, `DESCRIPTION`, `created`, `modified`) VALUES (23, NULL, '*OSMOSE Infos Opérationnelles', 'Ajouter les personnes en charge des infos opérationnelles', '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`listediffusions` (`id`, `utilisateur_id`, `NOM`, `DESCRIPTION`, `created`, `modified`) VALUES (24, NULL, '*OSMOSE Intégrateur Chefs de Projet', 'Liste de diffusion à disposition de l\'intégrateur', '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`listediffusions` (`id`, `utilisateur_id`, `NOM`, `DESCRIPTION`, `created`, `modified`) VALUES (25, NULL, '*OSMOSE Intégrateur Direction Programme', 'Liste de diffusion à disposition de l\'intégrateur', '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`listediffusions` (`id`, `utilisateur_id`, `NOM`, `DESCRIPTION`, `created`, `modified`) VALUES (26, NULL, '*OSMOSE Intégrateur GMAO', 'Liste de diffusion à disposition de l\'intégrateur', '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`listediffusions` (`id`, `utilisateur_id`, `NOM`, `DESCRIPTION`, `created`, `modified`) VALUES (27, NULL, '*OSMOSE Intégrateur GMAO Fonc', 'Liste de diffusion à disposition de l\'intégrateur', '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`listediffusions` (`id`, `utilisateur_id`, `NOM`, `DESCRIPTION`, `created`, `modified`) VALUES (28, NULL, '*OSMOSE Intégrateur GMAO Tech', 'Liste de diffusion à disposition de l\'intégrateur', '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`listediffusions` (`id`, `utilisateur_id`, `NOM`, `DESCRIPTION`, `created`, `modified`) VALUES (29, NULL, '*OSMOSE Intégrateur PANAM', 'Liste de diffusion à disposition de l\'intégrateur', '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`listediffusions` (`id`, `utilisateur_id`, `NOM`, `DESCRIPTION`, `created`, `modified`) VALUES (30, NULL, '*OSMOSE Intégrateur PMO', 'Liste de diffusion à disposition de l\'intégrateur', '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`listediffusions` (`id`, `utilisateur_id`, `NOM`, `DESCRIPTION`, `created`, `modified`) VALUES (31, NULL, '*OSMOSE Intégrateur Sogeti', 'Liste de diffusion à disposition de l\'intégrateur', '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`listediffusions` (`id`, `utilisateur_id`, `NOM`, `DESCRIPTION`, `created`, `modified`) VALUES (32, NULL, '*OSMOSE Intégrateur Technique', 'Liste de diffusion à disposition de l\'intégrateur', '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`listediffusions` (`id`, `utilisateur_id`, `NOM`, `DESCRIPTION`, `created`, `modified`) VALUES (33, NULL, '*OSMOSE Intégrateur Tous', 'Liste de diffusion à disposition de l\'intégrateur', '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`listediffusions` (`id`, `utilisateur_id`, `NOM`, `DESCRIPTION`, `created`, `modified`) VALUES (34, NULL, '*OSMOSE DSI-T Ordonnancement', 'Ajouter les personnes gérant l\'ordonnancement du programme OSMOSE', '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`listediffusions` (`id`, `utilisateur_id`, `NOM`, `DESCRIPTION`, `created`, `modified`) VALUES (35, NULL, '*DSI-T/SO OSMOSE Intégrateur GMAO MCO ', 'Liste de diffusion à disposition de l\'intégrateur', '2013-02-01', '2013-02-01');

COMMIT;

-- -----------------------------------------------------
-- Data for table `osact_cake230`.`messages`
-- -----------------------------------------------------
START TRANSACTION;
USE `osact_cake230`;
INSERT INTO `osact_cake230`.`messages` (`id`, `LIBELLE`, `DATELIMITE`, `created`, `modified`) VALUES (1, 'Bienvenue sur le site de saisie de l\'activité, du suivi des livrables et de la logistique.', NULL, '2013-02-01', '2013-02-01');

COMMIT;

-- -----------------------------------------------------
-- Data for table `osact_cake230`.`outils`
-- -----------------------------------------------------
START TRANSACTION;
USE `osact_cake230`;
INSERT INTO `osact_cake230`.`outils` (`id`, `utilisateur_id`, `NOM`, `DESCRIPTION`, `VALIDATION`, `created`, `modified`) VALUES (1, 1, 'CALIBER', 'Outils de gestion des exigences\rLogin = LOGIN WINDOWS (en majsucule)\rMot de passe = LOGIN WINDOWS (en majsucule) à  changer à  la première connexion\"', 0, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`outils` (`id`, `utilisateur_id`, `NOM`, `DESCRIPTION`, `VALIDATION`, `created`, `modified`) VALUES (2, 1, 'MINIDOC', 'Outils de gestion documentaire\rReconnu si l\'utilisateur fait partie de DSIT-E\rAutres cas se rapprocher du gestionnaire\"', 0, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`outils` (`id`, `utilisateur_id`, `NOM`, `DESCRIPTION`, `VALIDATION`, `created`, `modified`) VALUES (3, 1, 'QUALITY CENTER', 'Outil de suivi des tests et anomalies\rEn cas d\'absence du gestionnaire il est possible de contacter JB DOUVALIAN\"', 0, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`outils` (`id`, `utilisateur_id`, `NOM`, `DESCRIPTION`, `VALIDATION`, `created`, `modified`) VALUES (4, 1, 'SVN', 'Outils de gestion des sources\rNon disponible pour PANAM\"', 0, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`outils` (`id`, `utilisateur_id`, `NOM`, `DESCRIPTION`, `VALIDATION`, `created`, `modified`) VALUES (5, 1, 'ARIANE', 'Outils de gestion des actions\rUtiliser également par le groupement comme outil de stockage de la documentation de travail.\rEn cas d\'absence du gestionnaire contacter #ARIANE-ADMIN\"', 0, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`outils` (`id`, `utilisateur_id`, `NOM`, `DESCRIPTION`, `VALIDATION`, `created`, `modified`) VALUES (6, 1, 'SAMETIME', 'Outil de chat en réseau local SNCF soumis à  validation du chef de division', 1, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`outils` (`id`, `utilisateur_id`, `NOM`, `DESCRIPTION`, `VALIDATION`, `created`, `modified`) VALUES (7, 1, 'INTERNET MULTIMEDIA', 'Demande d\'accès internet dérogatif soumis à  validation du chef de division<br>L\'accès à Internet est autorisé à tout agent avec un compte SNCF.', 1, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`outils` (`id`, `utilisateur_id`, `NOM`, `DESCRIPTION`, `VALIDATION`, `created`, `modified`) VALUES (8, 1, 'PORTAIL ENV.', 'Outils de gestion des environnements', 0, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`outils` (`id`, `utilisateur_id`, `NOM`, `DESCRIPTION`, `VALIDATION`, `created`, `modified`) VALUES (9, 1, 'VPN', 'Demande d\'accès au VPN soumis à  validation du chef de division', 1, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`outils` (`id`, `utilisateur_id`, `NOM`, `DESCRIPTION`, `VALIDATION`, `created`, `modified`) VALUES (10, 1, 'WIFI', 'Demande d\'accès au WIFI soumis à  validation du chef de division', 1, '2013-02-01', '2013-02-01');

COMMIT;
