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
  `TYPE` ENUM('Projet','MCO','Indisponibilité') CHARACTER SET 'latin1' NULL DEFAULT 'Projet' ,
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
  `WORKCAPACITY` INT(1) NOT NULL DEFAULT 1 ,
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
-- Table `osact_cake230`.`livrables`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `osact_cake230`.`livrables` ;

CREATE  TABLE IF NOT EXISTS `osact_cake230`.`livrables` (
  `id` INT(15) NOT NULL AUTO_INCREMENT ,
  `utilisateur_id` INT(15) NULL DEFAULT NULL ,
  `NOM` VARCHAR(255) CHARACTER SET 'latin1' NOT NULL ,
  `REFERENCE` VARCHAR(45) NULL ,
  `created` DATE NOT NULL ,
  `modified` DATE NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `osact_cake230`.`actions`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `osact_cake230`.`actions` ;

CREATE  TABLE IF NOT EXISTS `osact_cake230`.`actions` (
  `id` INT(15) NOT NULL AUTO_INCREMENT ,
  `domaine_id` INT(15) NOT NULL ,
  `activite_id` INT(15) NOT NULL ,
  `utilisateur_id` INT(15) NOT NULL COMMENT 'Créateur\n' ,
  `destinataire` INT(15) NOT NULL COMMENT 'Destinataire' ,
  `livrable_id` INT(15) NULL DEFAULT NULL ,
  `FACTURATION` INT(15) NULL DEFAULT NULL COMMENT 'id de l\'activité sur laquelle sera facturée l\'action' ,
  `OBJET` VARCHAR(255) CHARACTER SET 'latin1' NOT NULL ,
  `DESCRIPTION` LONGTEXT CHARACTER SET 'latin1' NULL DEFAULT NULL ,
  `AVANCEMENT` INT(11) NULL DEFAULT '0' ,
  `COMMENTAIRE` TEXT CHARACTER SET 'latin1' NOT NULL ,
  `DEBUT` DATE NOT NULL ,
  `ECHEANCE` DATE NOT NULL ,
  `DEBUTREELLE` DATE NULL DEFAULT NULL ,
  `PERIODE` INT(11) NULL DEFAULT NULL ,
  `STATUT` ENUM('à faire','en cours','terminiée','livré','annulée') CHARACTER SET 'latin1' NULL DEFAULT NULL ,
  `HIERARCHIQUE` INT(15) NULL DEFAULT NULL COMMENT 'id de l\'utilisateur' ,
  `DUREEPREVUE` INT(15) NULL DEFAULT NULL ,
  `DUREEREELLE` INT(15) NULL DEFAULT NULL ,
  `PRIORITE` ENUM('normale','moyenne','haute') CHARACTER SET 'latin1' NULL DEFAULT NULL ,
  `TYPE` ENUM('action','indisponibilité','standard') CHARACTER SET 'latin1' NULL DEFAULT NULL ,
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
  `utilisateur_id` INT(15) NOT NULL ,
  `HISTORIQUE` LONGTEXT NOT NULL ,
  `STATUT` ENUM('à faire','en cours','terminiée','livré','annulée') NULL DEFAULT NULL ,
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
  `ECHEANCE` DATE NULL DEFAULT NULL ,
  `DATELIVRAISON` DATE NULL DEFAULT NULL ,
  `DATEVALIDATION` DATE NULL DEFAULT NULL ,
  `ETAT` ENUM('à faire','en cours','validé','livré','refusé','annulé') NULL DEFAULT NULL ,
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

COMMIT;

-- -----------------------------------------------------
-- Data for table `osact_cake230`.`projets`
-- -----------------------------------------------------
START TRANSACTION;
USE `osact_cake230`;
INSERT INTO `osact_cake230`.`projets` (`id`, `contrat_id`, `NOM`, `NUMEROGALLILIE`, `DEBUT`, `FIN`, `COMMENTAIRE`, `ACTIF`, `TYPE`, `FACTURATION`, `created`, `modified`) VALUES (1, 1, 'indisponibilité', NULL, '2013-01-01', NULL, NULL, 1, 'indisponibilité', 'autre', '2013-02-01', '2013-02-01');

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

COMMIT;

-- -----------------------------------------------------
-- Data for table `osact_cake230`.`societes`
-- -----------------------------------------------------
START TRANSACTION;
USE `osact_cake230`;
INSERT INTO `osact_cake230`.`societes` (`id`, `NOM`, `NOMCONTACT`, `TELEPHONE`, `MAIL`, `created`, `modified`) VALUES (1, 'SNCF', NULL, NULL, NULL, '2013-02-01', '2013-02-01');

COMMIT;

-- -----------------------------------------------------
-- Data for table `osact_cake230`.`profils`
-- -----------------------------------------------------
START TRANSACTION;
USE `osact_cake230`;
INSERT INTO `osact_cake230`.`profils` (`id`, `NOM`, `COMMENTAIRE`, `created`, `modified`) VALUES (1, 'ADMINISTRATEUR', 'Profil donnant les droits complet au site', '2013-02-01', '2013-02-01');

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
-- Data for table `osact_cake230`.`typemateriels`
-- -----------------------------------------------------
START TRANSACTION;
USE `osact_cake230`;
INSERT INTO `osact_cake230`.`typemateriels` (`id`, `NOM`, `DESCRIPTION`, `created`, `modified`) VALUES (1, 'Ordinateur de bureau', 'Ordinateur de bureau à l\'accord cadre', '2013-02-01', '2013-02-01');
INSERT INTO `osact_cake230`.`typemateriels` (`id`, `NOM`, `DESCRIPTION`, `created`, `modified`) VALUES (2, 'Portable', 'Portable à l\'accord cadre', '2013-02-01', '2013-02-01');

COMMIT;

-- -----------------------------------------------------
-- Data for table `osact_cake230`.`utilisateurs`
-- -----------------------------------------------------
START TRANSACTION;
USE `osact_cake230`;
INSERT INTO `osact_cake230`.`utilisateurs` (`id`, `profil_id`, `societe_id`, `assistance_id`, `section_id`, `utilisateur_id`, `domaine_id`, `site_id`, `tjmagent_id`, `dotation_id`, `password`, `username`, `ACTIF`, `DATEDEBUTACTIF`, `NAISSANCE`, `NOM`, `PRENOM`, `COMMENTAIRE`, `FINMISSION`, `MAIL`, `TELEPHONE`, `WORKCAPACITY`, `CONGE`, `RQ`, `VT`, `HIERARCHIQUE`, `GESTIONABSENCES`, `created`, `modified`) VALUES (1, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'OSACTADM', '12345ADM', 1, '2013-02-01', '0000-00-00', 'Administrateur', 'ADM', NULL, NULL, NULL, NULL, 1, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01');

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

COMMIT;
