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
  `ACTIVE` TINYINT(1) NULL DEFAULT '0' ,
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
  `WORKCAPACITY` DECIMAL(1,1) NULL DEFAULT NULL ,
  `CONGE` INT(15) NULL DEFAULT 0 ,
  `RQ` INT(15) NULL DEFAULT 0 ,
  `VT` INT(15) NULL DEFAULT 0 ,
  `HIERARCHIQUE` TINYINT(1) NOT NULL DEFAULT 0 ,
  `GESTIONABSENCES` TINYINT(1) NOT NULL DEFAULT 0 ,
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
  `livrables_id` INT(15) NOT NULL ,
  `actions_id` INT(15) NOT NULL ,
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
  `activite_id` INT(15) NOT NULL ,
  `DATE` DATE NOT NULL ,
  `LU` DECIMAL(1,1) NULL DEFAULT NULL ,
  `LU_TYPE` TINYINT NULL DEFAULT NULL COMMENT '0=>matin\n1=>après midi' ,
  `MA` DECIMAL(1,1) NULL DEFAULT NULL ,
  `MA_TYPE` TINYINT NULL DEFAULT NULL COMMENT '0=>matin\n1=>après midi' ,
  `ME` DECIMAL(1,1) NULL DEFAULT NULL ,
  `ME_TYPE` TINYINT NULL DEFAULT NULL COMMENT '0=>matin\n1=>après midi' ,
  `JE` DECIMAL(1,1) NULL DEFAULT NULL ,
  `JE_TYPE` TINYINT NULL DEFAULT NULL COMMENT '0=>matin\n1=>après midi' ,
  `VE` DECIMAL(1,1) NULL DEFAULT NULL ,
  `VE_TYPE` TINYINT NULL DEFAULT NULL COMMENT '0=>matin\n1=>après midi' ,
  `SA` DECIMAL(1,1) NULL DEFAULT NULL ,
  `SA_TYPE` TINYINT NULL DEFAULT NULL COMMENT '0=>matin\n1=>après midi' ,
  `DI` DECIMAL(1,1) NULL DEFAULT NULL ,
  `DI_TYPE` TINYINT NULL DEFAULT NULL COMMENT '0=>matin\n1=>après midi' ,
  `VEROUILLE` TINYINT NOT NULL DEFAULT 1 COMMENT '0=>verrouille\n1=>actif' ,
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
  `affectation_id` INT(15) NOT NULL ,
  `CHARGE` INT NOT NULL ,
  `DATE` DATE NOT NULL ,
  `created` DATE NOT NULL ,
  `modeified` DATE NOT NULL ,
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
  `DATE` DATE NOT NULL ,
  `LU` DECIMAL(1,1) NULL DEFAULT NULL ,
  `LU_TYPE` TINYINT NULL DEFAULT NULL COMMENT '0=>matin\n1=>après midi' ,
  `MA` DECIMAL(1,1) NULL DEFAULT NULL ,
  `MA_TYPE` TINYINT NULL DEFAULT NULL COMMENT '0=>matin\n1=>après midi' ,
  `ME` DECIMAL(1,1) NULL DEFAULT NULL ,
  `ME_TYPE` TINYINT NULL DEFAULT NULL COMMENT '0=>matin\n1=>après midi' ,
  `JE` DECIMAL(1,1) NULL DEFAULT NULL ,
  `JE_TYPE` TINYINT NULL DEFAULT NULL COMMENT '0=>matin\n1=>après midi' ,
  `VE` DECIMAL(1,1) NULL DEFAULT NULL ,
  `VE_TYPE` TINYINT NULL DEFAULT NULL COMMENT '0=>matin\n1=>après midi' ,
  `SA` DECIMAL(1,1) NULL DEFAULT NULL ,
  `SA_TYPE` TINYINT NULL DEFAULT NULL COMMENT '0=>matin\n1=>après midi' ,
  `DI` DECIMAL(1,1) NULL DEFAULT NULL ,
  `DI_TYPE` TINYINT NULL DEFAULT NULL COMMENT '0=>matin\n1=>après midi' ,
  `created` DATE NOT NULL ,
  `modified` DATE NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;

USE `osact_cake230` ;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `osact_cake230`.`contrats`
-- -----------------------------------------------------
START TRANSACTION;
USE `osact_cake230`;
INSERT INTO `osact_cake230`.`contrats` (`id`, `tjmcontrat_id`, `NOM`, `ANNEEDEBUT`, `ANNEEFIN`, `MONTANT`, `ACTIF`, `DESCRIPTION`, `created`, `modified`) VALUES (1, NULL, 'absences', 2012, NULL, NULL, 1, NULL, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`contrats` (`id`, `tjmcontrat_id`, `NOM`, `ANNEEDEBUT`, `ANNEEFIN`, `MONTANT`, `ACTIF`, `DESCRIPTION`, `created`, `modified`) VALUES (2, NULL, 'OSMOSE', 2008, NULL, NULL, 1, NULL, '2013-02-01', '2013-02-01');

COMMIT;

-- -----------------------------------------------------
-- Data for table `osact_cake230`.`projets`
-- -----------------------------------------------------
START TRANSACTION;
USE `osact_cake230`;
INSERT INTO `osact_cake230`.`projets` (`id`, `contrat_id`, `NOM`, `NUMEROGALLILIE`, `DEBUT`, `FIN`, `COMMENTAIRE`, `ACTIF`, `TYPE`, `FACTURATION`, `created`, `modified`) VALUES (1, 1, 'indisponibilité', NULL, '2013-01-01', NULL, NULL, 1, 'indisponibilité', 'autre', '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`projets` (`id`, `contrat_id`, `NOM`, `NUMEROGALLILIE`, `DEBUT`, `FIN`, `COMMENTAIRE`, `ACTIF`, `TYPE`, `FACTURATION`, `created`, `modified`) VALUES (2, 2, 'DEV M OSMOSE', '01328-0000064359', '2008-01-02', NULL, NULL, 1, 'projet', 'régie', '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`projets` (`id`, `contrat_id`, `NOM`, `NUMEROGALLILIE`, `DEBUT`, `FIN`, `COMMENTAIRE`, `ACTIF`, `TYPE`, `FACTURATION`, `created`, `modified`) VALUES (3, 2, 'DEV DSIT-X OSMOSE', NULL, '2008-01-02', NULL, NULL, 1, 'projet', 'forfait', '2013-02-01', '2013-01-02');
INSERT INTO `osact_cake230`.`projets` (`id`, `contrat_id`, `NOM`, `NUMEROGALLILIE`, `DEBUT`, `FIN`, `COMMENTAIRE`, `ACTIF`, `TYPE`, `FACTURATION`, `created`, `modified`) VALUES (4, 2, 'MCO M EMM OSMOSE', '01328-0000068414', '2010-01-02', NULL, NULL, 1, 'MCO', 'forfait', '2013-02-01', '2013-02-01');

COMMIT;

-- -----------------------------------------------------
-- Data for table `osact_cake230`.`activites`
-- -----------------------------------------------------
START TRANSACTION;
USE `osact_cake230`;
INSERT INTO `osact_cake230`.`activites` (`id`, `projet_id`, `NOM`, `DATEDEBUT`, `DATEFIN`, `NUMEROGALLILIE`, `DESCRIPTION`, `BUDJETRA`, `BUDGETREVU`, `ACTIVE`, `created`, `modified`) VALUES (1, 1, 'C', NULL, NULL, NULL, 'Congés protocolaires', NULL, NULL, 1, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`activites` (`id`, `projet_id`, `NOM`, `DATEDEBUT`, `DATEFIN`, `NUMEROGALLILIE`, `DESCRIPTION`, `BUDJETRA`, `BUDGETREVU`, `ACTIVE`, `created`, `modified`) VALUES (2, 1, 'RQ', NULL, NULL, NULL, 'Journée 35h', NULL, NULL, 1, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`activites` (`id`, `projet_id`, `NOM`, `DATEDEBUT`, `DATEFIN`, `NUMEROGALLILIE`, `DESCRIPTION`, `BUDJETRA`, `BUDGETREVU`, `ACTIVE`, `created`, `modified`) VALUES (3, 1, 'VT', NULL, NULL, NULL, 'Temps partiel', NULL, NULL, 1, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`activites` (`id`, `projet_id`, `NOM`, `DATEDEBUT`, `DATEFIN`, `NUMEROGALLILIE`, `DESCRIPTION`, `BUDJETRA`, `BUDGETREVU`, `ACTIVE`, `created`, `modified`) VALUES (4, 1, 'SE', NULL, NULL, NULL, 'Soin enfant ou conjoint', NULL, NULL, 1, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`activites` (`id`, `projet_id`, `NOM`, `DATEDEBUT`, `DATEFIN`, `NUMEROGALLILIE`, `DESCRIPTION`, `BUDJETRA`, `BUDGETREVU`, `ACTIVE`, `created`, `modified`) VALUES (5, 1, 'Mal', NULL, NULL, NULL, 'Maladie', NULL, NULL, 1, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`activites` (`id`, `projet_id`, `NOM`, `DATEDEBUT`, `DATEFIN`, `NUMEROGALLILIE`, `DESCRIPTION`, `BUDJETRA`, `BUDGETREVU`, `ACTIVE`, `created`, `modified`) VALUES (6, 1, 'CS', NULL, NULL, NULL, 'Congés supplémentaire', NULL, NULL, 1, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`activites` (`id`, `projet_id`, `NOM`, `DATEDEBUT`, `DATEFIN`, `NUMEROGALLILIE`, `DESCRIPTION`, `BUDJETRA`, `BUDGETREVU`, `ACTIVE`, `created`, `modified`) VALUES (7, 1, 'DA', NULL, NULL, NULL, '1h de grève', NULL, NULL, 1, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`activites` (`id`, `projet_id`, `NOM`, `DATEDEBUT`, `DATEFIN`, `NUMEROGALLILIE`, `DESCRIPTION`, `BUDJETRA`, `BUDGETREVU`, `ACTIVE`, `created`, `modified`) VALUES (8, 1, 'DB', NULL, NULL, NULL, '4h de grève', NULL, NULL, 1, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`activites` (`id`, `projet_id`, `NOM`, `DATEDEBUT`, `DATEFIN`, `NUMEROGALLILIE`, `DESCRIPTION`, `BUDJETRA`, `BUDGETREVU`, `ACTIVE`, `created`, `modified`) VALUES (9, 1, 'DC', NULL, NULL, NULL, '8h de grève', NULL, NULL, 1, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`activites` (`id`, `projet_id`, `NOM`, `DATEDEBUT`, `DATEFIN`, `NUMEROGALLILIE`, `DESCRIPTION`, `BUDJETRA`, `BUDGETREVU`, `ACTIVE`, `created`, `modified`) VALUES (10, 1, 'DD', NULL, NULL, NULL, 'Journée de délégation', NULL, NULL, 1, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`activites` (`id`, `projet_id`, `NOM`, `DATEDEBUT`, `DATEFIN`, `NUMEROGALLILIE`, `DESCRIPTION`, `BUDJETRA`, `BUDGETREVU`, `ACTIVE`, `created`, `modified`) VALUES (11, 1, 'DR', NULL, NULL, NULL, 'Journée de délégation', NULL, NULL, 1, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`activites` (`id`, `projet_id`, `NOM`, `DATEDEBUT`, `DATEFIN`, `NUMEROGALLILIE`, `DESCRIPTION`, `BUDJETRA`, `BUDGETREVU`, `ACTIVE`, `created`, `modified`) VALUES (13, 2, 'Conception OSMOSE MR Lot 310', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`activites` (`id`, `projet_id`, `NOM`, `DATEDEBUT`, `DATEFIN`, `NUMEROGALLILIE`, `DESCRIPTION`, `BUDJETRA`, `BUDGETREVU`, `ACTIVE`, `created`, `modified`) VALUES (14, 2, 'Conception OSMOSE ORGANE Lot 310', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`activites` (`id`, `projet_id`, `NOM`, `DATEDEBUT`, `DATEFIN`, `NUMEROGALLILIE`, `DESCRIPTION`, `BUDJETRA`, `BUDGETREVU`, `ACTIVE`, `created`, `modified`) VALUES (15, 3, 'OSMOSE MCO', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`activites` (`id`, `projet_id`, `NOM`, `DATEDEBUT`, `DATEFIN`, `NUMEROGALLILIE`, `DESCRIPTION`, `BUDJETRA`, `BUDGETREVU`, `ACTIVE`, `created`, `modified`) VALUES (12, 1, 'ILD', NULL, NULL, NULL, 'Longue maladie', NULL, NULL, 1, '2013-02-01', '2013-02-01');

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
INSERT INTO `osact_cake230`.`domaines` (`id`, `NOM`, `DESCRIPTION`, `created`, `modified`) VALUES (7, 'OSMOSE GMAO', 'Domaine lié à  MAXIMO', '2013-02-01', '2013-02-01');
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
INSERT INTO `osact_cake230`.`domaines` (`id`, `NOM`, `DESCRIPTION`, `created`, `modified`) VALUES (20, 'PPO', 'Domaine lié au projet PPO remplaçant de PANAM', '2013-02-01', '2013-02-01');

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
INSERT INTO `osact_cake230`.`profils` (`id`, `NOM`, `COMMENTAIRE`, `created`, `modified`) VALUES (2, 'Visiteur', 'Autorisé à consulter la liste des liens partagés', '2013-02-01', '2013-02-01');

COMMIT;

-- -----------------------------------------------------
-- Data for table `osact_cake230`.`assistances`
-- -----------------------------------------------------
START TRANSACTION;
USE `osact_cake230`;
INSERT INTO `osact_cake230`.`assistances` (`ID`, `NOM`, `DESCRIPTION`, `created`, `modified`) VALUES (1, 'SAMBA', 'Assistance utilisé par DSIT', '2013-02-01', '2013-02-01');

COMMIT;

-- -----------------------------------------------------
-- Data for table `osact_cake230`.`sites`
-- -----------------------------------------------------
START TRANSACTION;
USE `osact_cake230`;
INSERT INTO `osact_cake230`.`sites` (`id`, `NOM`, `DESCRIPTION`, `created`, `modified`) VALUES (1, 'OXYGENE', 'SIte lyonnais de DSI-T', '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`sites` (`id`, `NOM`, `DESCRIPTION`, `created`, `modified`) VALUES (2, 'INNOVIA', 'Site parision de DSI-T', '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`sites` (`id`, `NOM`, `DESCRIPTION`, `created`, `modified`) VALUES (3, 'LUMIERE', 'Site parisien du client MATERIEL', '2013-02-01', '2013-02-01');

COMMIT;

-- -----------------------------------------------------
-- Data for table `osact_cake230`.`sections`
-- -----------------------------------------------------
START TRANSACTION;
USE `osact_cake230`;
INSERT INTO `osact_cake230`.`sections` (`id`, `utilisateur_id`, `NOM`, `DESCRIPTION`, `created`, `modified`) VALUES (1, NULL, 'DSI-T/SO MAT GMAO-PANAM', 'Section gérant la GMAO ainsi que tous les autres projets sattelites et tout ce qui est transverse à tous ces projets.', '2013-02-01', '2013-02-01');

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
INSERT INTO `osact_cake230`.`utilisateurs` (`id`, `profil_id`, `societe_id`, `assistance_id`, `section_id`, `utilisateur_id`, `domaine_id`, `site_id`, `tjmagent_id`, `dotation_id`, `password`, `username`, `ACTIF`, `DATEDEBUTACTIF`, `NAISSANCE`, `NOM`, `PRENOM`, `COMMENTAIRE`, `FINMISSION`, `MAIL`, `TELEPHONE`, `WORKCAPACITY`, `CONGE`, `RQ`, `VT`, `HIERARCHIQUE`, `GESTIONABSENCES`, `created`, `modified`) VALUES (1, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, '6fb4f22992a0d164b77267fde5477248', '0000000A', 1, '2013-02-01', '2013-02-01', 'ADMINISTRATEUR', 'Administrateur', 'Mot de passe ADM', NULL, NULL, NULL, 1, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01');

COMMIT;

-- -----------------------------------------------------
-- Data for table `osact_cake230`.`autorisations`
-- -----------------------------------------------------
START TRANSACTION;
USE `osact_cake230`;
INSERT INTO `osact_cake230`.`autorisations` (`id`, `profil_id`, `MODEL`, `INDEX`, `ADD`, `EDIT`, `VIEW`, `DELETE`, `DUPLICATE`, `INITPASSWORD`, `created`, `modified`) VALUES (1, 1, 'achats', 1, 1, 1, 1, 1, 0, 0, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`autorisations` (`id`, `profil_id`, `MODEL`, `INDEX`, `ADD`, `EDIT`, `VIEW`, `DELETE`, `DUPLICATE`, `INITPASSWORD`, `created`, `modified`) VALUES (2, 1, 'actions', 1, 1, 1, 1, 1, 0, 0, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`autorisations` (`id`, `profil_id`, `MODEL`, `INDEX`, `ADD`, `EDIT`, `VIEW`, `DELETE`, `DUPLICATE`, `INITPASSWORD`, `created`, `modified`) VALUES (3, 1, 'activites', 1, 1, 1, 1, 1, 0, 0, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`autorisations` (`id`, `profil_id`, `MODEL`, `INDEX`, `ADD`, `EDIT`, `VIEW`, `DELETE`, `DUPLICATE`, `INITPASSWORD`, `created`, `modified`) VALUES (4, 1, 'affectations', 1, 1, 1, 1, 1, 0, 0, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`autorisations` (`id`, `profil_id`, `MODEL`, `INDEX`, `ADD`, `EDIT`, `VIEW`, `DELETE`, `DUPLICATE`, `INITPASSWORD`, `created`, `modified`) VALUES (5, 1, 'assistances', 1, 1, 1, 1, 1, 0, 0, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`autorisations` (`id`, `profil_id`, `MODEL`, `INDEX`, `ADD`, `EDIT`, `VIEW`, `DELETE`, `DUPLICATE`, `INITPASSWORD`, `created`, `modified`) VALUES (6, 1, 'autorisations', 1, 1, 1, 1, 1, 0, 0, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`autorisations` (`id`, `profil_id`, `MODEL`, `INDEX`, `ADD`, `EDIT`, `VIEW`, `DELETE`, `DUPLICATE`, `INITPASSWORD`, `created`, `modified`) VALUES (7, 1, 'contrats', 1, 1, 1, 1, 1, 0, 0, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`autorisations` (`id`, `profil_id`, `MODEL`, `INDEX`, `ADD`, `EDIT`, `VIEW`, `DELETE`, `DUPLICATE`, `INITPASSWORD`, `created`, `modified`) VALUES (8, 1, 'domaines', 1, 1, 1, 1, 1, 0, 0, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`autorisations` (`id`, `profil_id`, `MODEL`, `INDEX`, `ADD`, `EDIT`, `VIEW`, `DELETE`, `DUPLICATE`, `INITPASSWORD`, `created`, `modified`) VALUES (9, 1, 'dossierpartages', 1, 1, 1, 1, 1, 0, 0, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`autorisations` (`id`, `profil_id`, `MODEL`, `INDEX`, `ADD`, `EDIT`, `VIEW`, `DELETE`, `DUPLICATE`, `INITPASSWORD`, `created`, `modified`) VALUES (10, 1, 'dotations', 1, 1, 1, 1, 1, 0, 0, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`autorisations` (`id`, `profil_id`, `MODEL`, `INDEX`, `ADD`, `EDIT`, `VIEW`, `DELETE`, `DUPLICATE`, `INITPASSWORD`, `created`, `modified`) VALUES (11, 1, 'hitoryactions', 1, 1, 1, 1, 1, 0, 0, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`autorisations` (`id`, `profil_id`, `MODEL`, `INDEX`, `ADD`, `EDIT`, `VIEW`, `DELETE`, `DUPLICATE`, `INITPASSWORD`, `created`, `modified`) VALUES (12, 1, 'hitoryutilisateurs', 1, 1, 1, 1, 1, 1, 1, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`autorisations` (`id`, `profil_id`, `MODEL`, `INDEX`, `ADD`, `EDIT`, `VIEW`, `DELETE`, `DUPLICATE`, `INITPASSWORD`, `created`, `modified`) VALUES (13, 1, 'linkshareds', 1, 1, 1, 1, 1, 0, 0, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`autorisations` (`id`, `profil_id`, `MODEL`, `INDEX`, `ADD`, `EDIT`, `VIEW`, `DELETE`, `DUPLICATE`, `INITPASSWORD`, `created`, `modified`) VALUES (14, 1, 'listediffusions', 1, 1, 1, 1, 1, 0, 0, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`autorisations` (`id`, `profil_id`, `MODEL`, `INDEX`, `ADD`, `EDIT`, `VIEW`, `DELETE`, `DUPLICATE`, `INITPASSWORD`, `created`, `modified`) VALUES (15, 1, 'livrables', 1, 1, 1, 1, 1, 0, 0, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`autorisations` (`id`, `profil_id`, `MODEL`, `INDEX`, `ADD`, `EDIT`, `VIEW`, `DELETE`, `DUPLICATE`, `INITPASSWORD`, `created`, `modified`) VALUES (16, 1, 'materielinformatiques', 1, 1, 1, 1, 1, 0, 0, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`autorisations` (`id`, `profil_id`, `MODEL`, `INDEX`, `ADD`, `EDIT`, `VIEW`, `DELETE`, `DUPLICATE`, `INITPASSWORD`, `created`, `modified`) VALUES (17, 1, 'messages', 1, 1, 1, 1, 1, 0, 0, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`autorisations` (`id`, `profil_id`, `MODEL`, `INDEX`, `ADD`, `EDIT`, `VIEW`, `DELETE`, `DUPLICATE`, `INITPASSWORD`, `created`, `modified`) VALUES (18, 1, 'outils', 1, 1, 1, 1, 1, 0, 0, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`autorisations` (`id`, `profil_id`, `MODEL`, `INDEX`, `ADD`, `EDIT`, `VIEW`, `DELETE`, `DUPLICATE`, `INITPASSWORD`, `created`, `modified`) VALUES (19, 1, 'profils', 1, 1, 1, 1, 1, 0, 0, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`autorisations` (`id`, `profil_id`, `MODEL`, `INDEX`, `ADD`, `EDIT`, `VIEW`, `DELETE`, `DUPLICATE`, `INITPASSWORD`, `created`, `modified`) VALUES (20, 1, 'projets', 1, 1, 1, 1, 1, 0, 0, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`autorisations` (`id`, `profil_id`, `MODEL`, `INDEX`, `ADD`, `EDIT`, `VIEW`, `DELETE`, `DUPLICATE`, `INITPASSWORD`, `created`, `modified`) VALUES (21, 1, 'sections', 1, 1, 1, 1, 1, 0, 0, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`autorisations` (`id`, `profil_id`, `MODEL`, `INDEX`, `ADD`, `EDIT`, `VIEW`, `DELETE`, `DUPLICATE`, `INITPASSWORD`, `created`, `modified`) VALUES (22, 1, 'sites', 1, 1, 1, 1, 1, 0, 0, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`autorisations` (`id`, `profil_id`, `MODEL`, `INDEX`, `ADD`, `EDIT`, `VIEW`, `DELETE`, `DUPLICATE`, `INITPASSWORD`, `created`, `modified`) VALUES (23, 1, 'societes', 1, 1, 1, 1, 1, 0, 0, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`autorisations` (`id`, `profil_id`, `MODEL`, `INDEX`, `ADD`, `EDIT`, `VIEW`, `DELETE`, `DUPLICATE`, `INITPASSWORD`, `created`, `modified`) VALUES (24, 1, 'suivilivrables', 1, 1, 1, 1, 1, 0, 0, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`autorisations` (`id`, `profil_id`, `MODEL`, `INDEX`, `ADD`, `EDIT`, `VIEW`, `DELETE`, `DUPLICATE`, `INITPASSWORD`, `created`, `modified`) VALUES (25, 1, 'tjmagents', 1, 1, 1, 1, 1, 0, 0, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`autorisations` (`id`, `profil_id`, `MODEL`, `INDEX`, `ADD`, `EDIT`, `VIEW`, `DELETE`, `DUPLICATE`, `INITPASSWORD`, `created`, `modified`) VALUES (26, 1, 'tjmcontrats', 1, 1, 1, 1, 1, 0, 0, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`autorisations` (`id`, `profil_id`, `MODEL`, `INDEX`, `ADD`, `EDIT`, `VIEW`, `DELETE`, `DUPLICATE`, `INITPASSWORD`, `created`, `modified`) VALUES (27, 1, 'typemateriels', 1, 1, 1, 1, 1, 1, 0, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`autorisations` (`id`, `profil_id`, `MODEL`, `INDEX`, `ADD`, `EDIT`, `VIEW`, `DELETE`, `DUPLICATE`, `INITPASSWORD`, `created`, `modified`) VALUES (28, 1, 'utilisateurs', 1, 1, 1, 1, 1, 1, 1, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`autorisations` (`id`, `profil_id`, `MODEL`, `INDEX`, `ADD`, `EDIT`, `VIEW`, `DELETE`, `DUPLICATE`, `INITPASSWORD`, `created`, `modified`) VALUES (29, 1, 'utiliseoutils', 1, 1, 1, 1, 1, 0, 0, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`autorisations` (`id`, `profil_id`, `MODEL`, `INDEX`, `ADD`, `EDIT`, `VIEW`, `DELETE`, `DUPLICATE`, `INITPASSWORD`, `created`, `modified`) VALUES (30, 1, 'actionslivrables', 1, 1, 1, 1, 1, 0, 0, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`autorisations` (`id`, `profil_id`, `MODEL`, `INDEX`, `ADD`, `EDIT`, `VIEW`, `DELETE`, `DUPLICATE`, `INITPASSWORD`, `created`, `modified`) VALUES (31, 1, 'activitereelles', 1, 1, 1, 1, 1, 0, 0, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`autorisations` (`id`, `profil_id`, `MODEL`, `INDEX`, `ADD`, `EDIT`, `VIEW`, `DELETE`, `DUPLICATE`, `INITPASSWORD`, `created`, `modified`) VALUES (32, 1, 'facturations', 1, 1, 1, 1, 1, 0, 0, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`autorisations` (`id`, `profil_id`, `MODEL`, `INDEX`, `ADD`, `EDIT`, `VIEW`, `DELETE`, `DUPLICATE`, `INITPASSWORD`, `created`, `modified`) VALUES (33, 1, 'plandecharges', 1, 1, 1, 1, 1, 0, 0, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`autorisations` (`id`, `profil_id`, `MODEL`, `INDEX`, `ADD`, `EDIT`, `VIEW`, `DELETE`, `DUPLICATE`, `INITPASSWORD`, `created`, `modified`) VALUES (34, 2, 'linkshareds', 1, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01');

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
INSERT INTO `osact_cake230`.`linkshareds` (`id`, `utilisateur_id`, `NOM`, `LINK`, `created`, `modified`) VALUES (4, 1, 'Service général', 'https://services.sg.sncf.fr/iporta/index.jsp', '2013-02-01', '2013-02-01');
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
INSERT INTO `osact_cake230`.`outils` (`id`, `utilisateur_id`, `NOM`, `DESCRIPTION`, `VALIDATION`, `created`, `modified`) VALUES (6, 1, 'SAMETIME', 'Outil de chat en réseau local SNCF', 1, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`outils` (`id`, `utilisateur_id`, `NOM`, `DESCRIPTION`, `VALIDATION`, `created`, `modified`) VALUES (7, 1, 'INTERNET', 'Demande d\'accès internet soumis à  validation du chef de division', 1, '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`outils` (`id`, `utilisateur_id`, `NOM`, `DESCRIPTION`, `VALIDATION`, `created`, `modified`) VALUES (8, 1, 'PORTAIL ENV.', 'Outils de gestion des environnements', 0, '2013-02-01', '2013-02-01');

COMMIT;
