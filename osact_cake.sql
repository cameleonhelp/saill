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
  PRIMARY KEY (`id`) ,
  INDEX `fk_contrats_tjmcontrats1_idx` (`tjmcontrat_id` ASC) ,
  CONSTRAINT `fk_contrats_tjmcontrats1`
    FOREIGN KEY (`tjmcontrat_id` )
    REFERENCES `osact_cake230`.`tjmcontrats` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 11
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
  `DEBUT` DATE NULL DEFAULT NULL ,
  `FIN` DATE NULL DEFAULT NULL ,
  `COMMENTAIRE` LONGTEXT CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL ,
  `ACTIF` TINYINT(1) NOT NULL DEFAULT 0 ,
  `TYPE` ENUM('Projet','MCO','Indisponibilité') CHARACTER SET 'latin1' NULL DEFAULT 'Projet' ,
  `FACTURATION` ENUM('régie','forfait','autre') CHARACTER SET 'latin1' NULL DEFAULT NULL ,
  `created` DATE NOT NULL ,
  `modified` DATE NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_projets_contrats1_idx` (`contrat_id` ASC) ,
  CONSTRAINT `fk_projets_contrats1`
    FOREIGN KEY (`contrat_id` )
    REFERENCES `osact_cake230`.`contrats` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 57
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
  `NOMGALLILIE` VARCHAR(255) CHARACTER SET 'latin1' NULL DEFAULT NULL ,
  `DESCRIPTION` LONGTEXT CHARACTER SET 'latin1' NULL DEFAULT NULL ,
  `BUDJETRA` DECIMAL(25,2) NULL DEFAULT NULL ,
  `BUDGETREVU` DECIMAL(25,2) NULL DEFAULT NULL ,
  `ACTIVE` TINYINT(1) NULL DEFAULT '0' ,
  `created` DATE NOT NULL ,
  `modified` DATE NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_activites_projets1_idx` (`projet_id` ASC) ,
  CONSTRAINT `fk_activites_projets1`
    FOREIGN KEY (`projet_id` )
    REFERENCES `osact_cake230`.`projets` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 106
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
  PRIMARY KEY (`id`) ,
  INDEX `fk_achats_activites1_idx` (`activite_id` ASC) ,
  CONSTRAINT `fk_achats_activites1`
    FOREIGN KEY (`activite_id` )
    REFERENCES `osact_cake230`.`activites` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 3
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
AUTO_INCREMENT = 39
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
AUTO_INCREMENT = 25
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
AUTO_INCREMENT = 39
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
AUTO_INCREMENT = 12
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
AUTO_INCREMENT = 10
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
  PRIMARY KEY (`id`) ,
  INDEX `fk_sections_utilisateurs1_idx` (`utilisateur_id` ASC) ,
  CONSTRAINT `fk_sections_utilisateurs1`
    FOREIGN KEY (`utilisateur_id` )
    REFERENCES `osact_cake230`.`utilisateurs` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 70
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
AUTO_INCREMENT = 17
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
AUTO_INCREMENT = 39
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
  PRIMARY KEY (`id`) ,
  INDEX `fk_materielinformatiques_typemateriels1_idx` (`typemateriel_id` ASC) ,
  INDEX `fk_materielinformatiques_sections1_idx` (`section_id` ASC) ,
  INDEX `fk_materielinformatiques_assistances1_idx` (`assistance_id` ASC) ,
  CONSTRAINT `fk_materielinformatiques_typemateriels1`
    FOREIGN KEY (`typemateriel_id` )
    REFERENCES `osact_cake230`.`typemateriels` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_materielinformatiques_sections1`
    FOREIGN KEY (`section_id` )
    REFERENCES `osact_cake230`.`sections` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_materielinformatiques_assistances1`
    FOREIGN KEY (`assistance_id` )
    REFERENCES `osact_cake230`.`assistances` (`ID` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 348
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `osact_cake230`.`dotations`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `osact_cake230`.`dotations` ;

CREATE  TABLE IF NOT EXISTS `osact_cake230`.`dotations` (
  `id` INT(15) NOT NULL AUTO_INCREMENT ,
  `materielinformatique_id` INT(15) NULL DEFAULT NULL ,
  `typemateriels_id` INT(15) NULL DEFAULT NULL ,
  `utilisateur_id` INT(15) NOT NULL ,
  `DATERECEPTION` DATE NULL DEFAULT NULL ,
  `DATEREMISE` DATE NULL DEFAULT NULL ,
  `created` DATE NOT NULL ,
  `modified` DATE NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_dotations_materielinformatiques1_idx` (`materielinformatique_id` ASC) ,
  INDEX `fk_dotations_utilisateurs1_idx` (`utilisateur_id` ASC) ,
  INDEX `fk_dotations_typemateriels1_idx` (`typemateriels_id` ASC) ,
  CONSTRAINT `fk_dotations_materielinformatiques1`
    FOREIGN KEY (`materielinformatique_id` )
    REFERENCES `osact_cake230`.`materielinformatiques` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_dotations_utilisateurs1`
    FOREIGN KEY (`utilisateur_id` )
    REFERENCES `osact_cake230`.`utilisateurs` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_dotations_typemateriels1`
    FOREIGN KEY (`typemateriels_id` )
    REFERENCES `osact_cake230`.`typemateriels` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
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
  `CONGE` INT(15) NOT NULL DEFAULT 0 ,
  `RQ` INT(15) NOT NULL DEFAULT 0 ,
  `VT` INT(15) NOT NULL DEFAULT 0 ,
  `HIERARCHIQUE` TINYINT(1) NOT NULL DEFAULT 0 ,
  `GESTIONABSENCES` TINYINT(1) NOT NULL DEFAULT 0 ,
  `created` DATE NOT NULL ,
  `modified` DATE NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_utilisateurs_societes_idx` (`societe_id` ASC) ,
  INDEX `fk_utilisateurs_profils1_idx` (`profil_id` ASC) ,
  INDEX `fk_utilisateurs_assistances1_idx` (`assistance_id` ASC) ,
  INDEX `fk_utilisateurs_domaines1_idx` (`domaine_id` ASC) ,
  INDEX `fk_utilisateurs_sites1_idx` (`site_id` ASC) ,
  INDEX `fk_utilisateurs_sections1_idx` (`section_id` ASC) ,
  INDEX `fk_utilisateurs_tjmagents1_idx` (`tjmagent_id` ASC) ,
  INDEX `fk_utilisateurs_utilisateurs1_idx` (`utilisateur_id` ASC) ,
  INDEX `fk_utilisateurs_dotations1_idx` (`dotation_id` ASC) ,
  CONSTRAINT `fk_utilisateurs_societes`
    FOREIGN KEY (`societe_id` )
    REFERENCES `osact_cake230`.`societes` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_utilisateurs_profils1`
    FOREIGN KEY (`profil_id` )
    REFERENCES `osact_cake230`.`profils` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_utilisateurs_assistances1`
    FOREIGN KEY (`assistance_id` )
    REFERENCES `osact_cake230`.`assistances` (`ID` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_utilisateurs_domaines1`
    FOREIGN KEY (`domaine_id` )
    REFERENCES `osact_cake230`.`domaines` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_utilisateurs_sites1`
    FOREIGN KEY (`site_id` )
    REFERENCES `osact_cake230`.`sites` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_utilisateurs_sections1`
    FOREIGN KEY (`section_id` )
    REFERENCES `osact_cake230`.`sections` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_utilisateurs_tjmagents1`
    FOREIGN KEY (`tjmagent_id` )
    REFERENCES `osact_cake230`.`tjmagents` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_utilisateurs_utilisateurs1`
    FOREIGN KEY (`utilisateur_id` )
    REFERENCES `osact_cake230`.`utilisateurs` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_utilisateurs_dotations1`
    FOREIGN KEY (`dotation_id` )
    REFERENCES `osact_cake230`.`dotations` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 1444
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
  PRIMARY KEY (`id`) ,
  INDEX `fk_livrables_utilisateurs1_idx` (`utilisateur_id` ASC) ,
  CONSTRAINT `fk_livrables_utilisateurs1`
    FOREIGN KEY (`utilisateur_id` )
    REFERENCES `osact_cake230`.`utilisateurs` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 3
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
  PRIMARY KEY (`id`) ,
  INDEX `fk_actions_domaines1_idx` (`domaine_id` ASC) ,
  INDEX `fk_actions_activites1_idx` (`activite_id` ASC) ,
  INDEX `fk_actions_utilisateurs1_idx` (`utilisateur_id` ASC) ,
  INDEX `fk_actions_utilisateurs2_idx` (`destinataire` ASC) ,
  INDEX `fk_actions_livrables1_idx` (`livrable_id` ASC) ,
  CONSTRAINT `fk_actions_domaines1`
    FOREIGN KEY (`domaine_id` )
    REFERENCES `osact_cake230`.`domaines` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_actions_activites1`
    FOREIGN KEY (`activite_id` )
    REFERENCES `osact_cake230`.`activites` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_actions_utilisateurs1`
    FOREIGN KEY (`utilisateur_id` )
    REFERENCES `osact_cake230`.`utilisateurs` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_actions_utilisateurs2`
    FOREIGN KEY (`destinataire` )
    REFERENCES `osact_cake230`.`utilisateurs` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_actions_livrables1`
    FOREIGN KEY (`livrable_id` )
    REFERENCES `osact_cake230`.`livrables` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 15
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
  PRIMARY KEY (`id`) ,
  INDEX `fk_affectations_activites1_idx` (`activite_id` ASC) ,
  INDEX `fk_affectations_utilisateurs1_idx` (`utilisateur_id` ASC) ,
  CONSTRAINT `fk_affectations_activites1`
    FOREIGN KEY (`activite_id` )
    REFERENCES `osact_cake230`.`activites` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_affectations_utilisateurs1`
    FOREIGN KEY (`utilisateur_id` )
    REFERENCES `osact_cake230`.`utilisateurs` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 276
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
  PRIMARY KEY (`id`) ,
  INDEX `fk_autorisations_profils1_idx` (`profil_id` ASC) ,
  CONSTRAINT `fk_autorisations_profils1`
    FOREIGN KEY (`profil_id` )
    REFERENCES `osact_cake230`.`profils` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 29
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
AUTO_INCREMENT = 11
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
  PRIMARY KEY (`id`) ,
  INDEX `fk_historyactions_actions1_idx` (`action_id` ASC) ,
  INDEX `fk_historyactions_utilisateurs1_idx` (`utilisateur_id` ASC) ,
  CONSTRAINT `fk_historyactions_actions1`
    FOREIGN KEY (`action_id` )
    REFERENCES `osact_cake230`.`actions` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_historyactions_utilisateurs1`
    FOREIGN KEY (`utilisateur_id` )
    REFERENCES `osact_cake230`.`utilisateurs` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `osact_cake230`.`historydotations`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `osact_cake230`.`historydotations` ;

CREATE  TABLE IF NOT EXISTS `osact_cake230`.`historydotations` (
  `id` INT(15) NOT NULL AUTO_INCREMENT ,
  `dotation_id` INT(15) NOT NULL ,
  `HISTORIQUE` LONGTEXT NULL DEFAULT NULL ,
  `created` DATE NOT NULL ,
  `modified` DATE NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_historydotation_dotations1_idx` (`dotation_id` ASC) ,
  CONSTRAINT `fk_historydotation_dotations1`
    FOREIGN KEY (`dotation_id` )
    REFERENCES `osact_cake230`.`dotations` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
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
  PRIMARY KEY (`id`) ,
  INDEX `fk_historyutilisateur_utilisateurs1_idx` (`utilisateur_id` ASC) ,
  CONSTRAINT `fk_historyutilisateur_utilisateurs1`
    FOREIGN KEY (`utilisateur_id` )
    REFERENCES `osact_cake230`.`utilisateurs` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
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
  PRIMARY KEY (`id`) ,
  INDEX `fk_linkshareds_utilisateurs1_idx` (`utilisateur_id` ASC) ,
  CONSTRAINT `fk_linkshareds_utilisateurs1`
    FOREIGN KEY (`utilisateur_id` )
    REFERENCES `osact_cake230`.`utilisateurs` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 14
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
  PRIMARY KEY (`id`) ,
  INDEX `fk_listediffusions_utilisateurs1_idx` (`utilisateur_id` ASC) ,
  CONSTRAINT `fk_listediffusions_utilisateurs1`
    FOREIGN KEY (`utilisateur_id` )
    REFERENCES `osact_cake230`.`utilisateurs` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 40
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
AUTO_INCREMENT = 5
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
  PRIMARY KEY (`id`) ,
  INDEX `fk_outils_utilisateurs1_idx` (`utilisateur_id` ASC) ,
  CONSTRAINT `fk_outils_utilisateurs1`
    FOREIGN KEY (`utilisateur_id` )
    REFERENCES `osact_cake230`.`utilisateurs` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 26
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
  PRIMARY KEY (`id`) ,
  INDEX `fk_suivilivrables_livrables1_idx` (`livrable_id` ASC) ,
  CONSTRAINT `fk_suivilivrables_livrables1`
    FOREIGN KEY (`livrable_id` )
    REFERENCES `osact_cake230`.`livrables` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
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
  PRIMARY KEY (`id`) ,
  INDEX `fk_utiliseoutils_outils1_idx` (`outil_id` ASC) ,
  INDEX `fk_utiliseoutils_utilisateurs1_idx` (`utilisateur_id` ASC) ,
  INDEX `fk_utiliseoutils_listediffusions1_idx` (`listediffusion_id` ASC) ,
  INDEX `fk_utiliseoutils_dossierpartages1_idx` (`dossierpartage_id` ASC) ,
  CONSTRAINT `fk_utiliseoutils_outils1`
    FOREIGN KEY (`outil_id` )
    REFERENCES `osact_cake230`.`outils` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_utiliseoutils_utilisateurs1`
    FOREIGN KEY (`utilisateur_id` )
    REFERENCES `osact_cake230`.`utilisateurs` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_utiliseoutils_listediffusions1`
    FOREIGN KEY (`listediffusion_id` )
    REFERENCES `osact_cake230`.`listediffusions` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_utiliseoutils_dossierpartages1`
    FOREIGN KEY (`dossierpartage_id` )
    REFERENCES `osact_cake230`.`dossierpartages` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 63
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;

USE `osact_cake230` ;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
