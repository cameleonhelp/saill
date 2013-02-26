-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Mar 26 Février 2013 à 07:05
-- Version du serveur: 5.5.16-log
-- Version de PHP: 5.3.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `osact_cake230`
--

-- --------------------------------------------------------

--
-- Structure de la table `achats`
--

CREATE TABLE IF NOT EXISTS `achats` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `activite_id` int(15) NOT NULL,
  `LIBELLEACHAT` varchar(255) CHARACTER SET latin1 NOT NULL,
  `DATE` date NOT NULL,
  `MONTANT` decimal(25,2) NOT NULL,
  `DESCRIPTION` text CHARACTER SET latin1,
  `created` date NOT NULL,
  `modified` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_achats_activites1_idx` (`activite_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `actions`
--

CREATE TABLE IF NOT EXISTS `actions` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `domaine_id` int(15) NOT NULL,
  `activite_id` int(15) NOT NULL,
  `utilisateur_id` int(15) NOT NULL COMMENT 'Créateur\n',
  `destinataire` int(15) NOT NULL COMMENT 'Destinataire',
  `livrable_id` int(15) DEFAULT NULL,
  `FACTURATION` int(15) DEFAULT NULL COMMENT 'id de l''activité sur laquelle sera facturée l''action',
  `OBJET` varchar(255) CHARACTER SET latin1 NOT NULL,
  `DESCRIPTION` longtext CHARACTER SET latin1,
  `AVANCEMENT` int(11) DEFAULT '0',
  `COMMENTAIRE` text CHARACTER SET latin1 NOT NULL,
  `DEBUT` date NOT NULL,
  `ECHEANCE` date NOT NULL,
  `DEBUTREELLE` date DEFAULT NULL,
  `PERIODE` int(11) DEFAULT NULL,
  `STATUT` enum('à faire','en cours','terminiée','livré','annulée') CHARACTER SET latin1 DEFAULT NULL,
  `HIERARCHIQUE` int(15) DEFAULT NULL COMMENT 'id de l''utilisateur',
  `DUREEPREVUE` int(15) DEFAULT NULL,
  `DUREEREELLE` int(15) DEFAULT NULL,
  `PRIORITE` enum('normale','moyenne','haute') CHARACTER SET latin1 DEFAULT NULL,
  `TYPE` enum('action','indisponibilité','standard') CHARACTER SET latin1 DEFAULT NULL,
  `created` date NOT NULL,
  `modified` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_actions_domaines1_idx` (`domaine_id`),
  KEY `fk_actions_activites1_idx` (`activite_id`),
  KEY `fk_actions_utilisateurs1_idx` (`utilisateur_id`),
  KEY `fk_actions_utilisateurs2_idx` (`destinataire`),
  KEY `fk_actions_livrables1_idx` (`livrable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `activites`
--

CREATE TABLE IF NOT EXISTS `activites` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `projet_id` int(15) NOT NULL,
  `NOM` varchar(255) CHARACTER SET latin1 NOT NULL,
  `DATEDEBUT` date DEFAULT NULL,
  `DATEFIN` date DEFAULT NULL,
  `NUMEROGALLILIE` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `NOMGALLILIE` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `DESCRIPTION` longtext CHARACTER SET latin1,
  `BUDJETRA` decimal(25,2) DEFAULT NULL,
  `BUDGETREVU` decimal(25,2) DEFAULT NULL,
  `ACTIVE` tinyint(1) DEFAULT '0',
  `created` date NOT NULL,
  `modified` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_activites_projets1_idx` (`projet_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `affectations`
--

CREATE TABLE IF NOT EXISTS `affectations` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `utilisateur_id` int(15) NOT NULL,
  `activite_id` int(15) NOT NULL,
  `created` date NOT NULL,
  `modified` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_affectations_activites1_idx` (`activite_id`),
  KEY `fk_affectations_utilisateurs1_idx` (`utilisateur_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `assistances`
--

CREATE TABLE IF NOT EXISTS `assistances` (
  `ID` int(15) NOT NULL AUTO_INCREMENT,
  `NOM` varchar(255) CHARACTER SET latin1 NOT NULL,
  `DESCRIPTION` longtext CHARACTER SET latin1,
  `created` date NOT NULL,
  `modified` date NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Structure de la table `autorisations`
--

CREATE TABLE IF NOT EXISTS `autorisations` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `profil_id` int(15) NOT NULL,
  `MODEL` varchar(255) NOT NULL,
  `INDEX` tinyint(1) NOT NULL DEFAULT '0',
  `ADD` tinyint(1) NOT NULL DEFAULT '0',
  `EDIT` tinyint(1) NOT NULL DEFAULT '0',
  `VIEW` tinyint(1) NOT NULL DEFAULT '0',
  `DELETE` tinyint(1) NOT NULL DEFAULT '0',
  `DUPLICATE` tinyint(1) NOT NULL DEFAULT '0',
  `INITPASSWORD` tinyint(1) NOT NULL DEFAULT '0',
  `created` date NOT NULL,
  `modified` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_autorisations_profils1_idx` (`profil_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `contrats`
--

CREATE TABLE IF NOT EXISTS `contrats` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `tjmcontrat_id` int(15) DEFAULT NULL,
  `NOM` varchar(255) CHARACTER SET latin1 NOT NULL,
  `ANNEEDEBUT` year(4) NOT NULL,
  `ANNEEFIN` year(4) DEFAULT NULL,
  `MONTANT` decimal(25,2) DEFAULT NULL,
  `ACTIF` tinyint(1) NOT NULL DEFAULT '0',
  `DESCRIPTION` text CHARACTER SET latin1,
  `created` date NOT NULL,
  `modified` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_contrats_tjmcontrats1_idx` (`tjmcontrat_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `domaines`
--

CREATE TABLE IF NOT EXISTS `domaines` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `NOM` varchar(255) CHARACTER SET latin1 NOT NULL,
  `DESCRIPTION` longtext CHARACTER SET latin1,
  `created` date NOT NULL,
  `modified` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `dossierpartages`
--

CREATE TABLE IF NOT EXISTS `dossierpartages` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `NOM` varchar(50) CHARACTER SET latin1 NOT NULL,
  `GROUPEAD` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `DESCRIPTION` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `created` date NOT NULL,
  `modified` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `dotations`
--

CREATE TABLE IF NOT EXISTS `dotations` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `materielinformatique_id` int(15) DEFAULT NULL,
  `typemateriel_id` int(15) DEFAULT NULL,
  `utilisateur_id` int(15) NOT NULL,
  `DATERECEPTION` date DEFAULT NULL,
  `DATEREMISE` date DEFAULT NULL,
  `created` date NOT NULL,
  `modified` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_dotations_materielinformatiques1_idx` (`materielinformatique_id`),
  KEY `fk_dotations_utilisateurs1_idx` (`utilisateur_id`),
  KEY `fk_dotations_typemateriel1_idx` (`typemateriel_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `historyactions`
--

CREATE TABLE IF NOT EXISTS `historyactions` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `action_id` int(15) NOT NULL,
  `utilisateur_id` int(15) NOT NULL,
  `HISTORIQUE` longtext NOT NULL,
  `STATUT` enum('à faire','en cours','terminiée','livré','annulée') DEFAULT NULL,
  `created` date NOT NULL,
  `modified` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_historyactions_actions1_idx` (`action_id`),
  KEY `fk_historyactions_utilisateurs1_idx` (`utilisateur_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `historydotations`
--

CREATE TABLE IF NOT EXISTS `historydotations` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `dotation_id` int(15) NOT NULL,
  `HISTORIQUE` longtext,
  `created` date NOT NULL,
  `modified` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_historydotation_dotations1_idx` (`dotation_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `historyutilisateurs`
--

CREATE TABLE IF NOT EXISTS `historyutilisateurs` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `utilisateur_id` int(15) NOT NULL,
  `HISTORIQUE` longtext,
  `created` date NOT NULL,
  `modified` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_historyutilisateur_utilisateurs1_idx` (`utilisateur_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `linkshareds`
--

CREATE TABLE IF NOT EXISTS `linkshareds` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `utilisateur_id` int(15) NOT NULL,
  `NOM` varchar(255) CHARACTER SET latin1 NOT NULL,
  `LINK` text CHARACTER SET latin1,
  `created` date NOT NULL,
  `modified` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_linkshareds_utilisateurs1_idx` (`utilisateur_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `listediffusions`
--

CREATE TABLE IF NOT EXISTS `listediffusions` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `utilisateur_id` int(15) DEFAULT NULL,
  `NOM` varchar(255) CHARACTER SET latin1 NOT NULL,
  `DESCRIPTION` longtext CHARACTER SET latin1,
  `created` date NOT NULL,
  `modified` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_listediffusions_utilisateurs1_idx` (`utilisateur_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `livrables`
--

CREATE TABLE IF NOT EXISTS `livrables` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `utilisateur_id` int(15) DEFAULT NULL,
  `NOM` varchar(255) CHARACTER SET latin1 NOT NULL,
  `REFERENCE` varchar(45) DEFAULT NULL,
  `created` date NOT NULL,
  `modified` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_livrables_utilisateurs1_idx` (`utilisateur_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `materielinformatiques`
--

CREATE TABLE IF NOT EXISTS `materielinformatiques` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `typemateriel_id` int(15) NOT NULL,
  `section_id` int(15) NOT NULL,
  `assistance_id` int(15) NOT NULL,
  `NOM` varchar(35) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'identifiant du poste ou du matériel',
  `ETAT` enum('En stock','En dotation','En réparation','Au rebut','Non localisé') DEFAULT NULL,
  `WIFI` tinyint(1) DEFAULT '0',
  `VPN` tinyint(1) DEFAULT '0',
  `COMMENTAIRE` text CHARACTER SET latin1,
  `created` date NOT NULL,
  `modified` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_materielinformatiques_typemateriel1_idx` (`typemateriel_id`),
  KEY `fk_materielinformatiques_sections1_idx` (`section_id`),
  KEY `fk_materielinformatiques_assistances1_idx` (`assistance_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `LIBELLE` mediumtext NOT NULL,
  `DATELIMITE` date DEFAULT NULL,
  `created` date NOT NULL,
  `modified` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Structure de la table `outils`
--

CREATE TABLE IF NOT EXISTS `outils` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `utilisateur_id` int(15) NOT NULL,
  `NOM` varchar(255) CHARACTER SET latin1 NOT NULL,
  `DESCRIPTION` text CHARACTER SET latin1,
  `VALIDATION` tinyint(1) NOT NULL DEFAULT '0',
  `created` date NOT NULL,
  `modified` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_outils_utilisateurs1_idx` (`utilisateur_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `profils`
--

CREATE TABLE IF NOT EXISTS `profils` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `NOM` varchar(255) CHARACTER SET latin1 NOT NULL,
  `COMMENTAIRE` text CHARACTER SET latin1,
  `created` date NOT NULL,
  `modified` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Structure de la table `projets`
--

CREATE TABLE IF NOT EXISTS `projets` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `contrat_id` int(15) NOT NULL,
  `NOM` varchar(255) CHARACTER SET latin1 NOT NULL,
  `DEBUT` date DEFAULT NULL,
  `FIN` date DEFAULT NULL,
  `COMMENTAIRE` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `ACTIF` tinyint(1) NOT NULL DEFAULT '0',
  `TYPE` enum('Projet','MCO','Indisponibilité') CHARACTER SET latin1 DEFAULT 'Projet',
  `FACTURATION` enum('régie','forfait','autre') CHARACTER SET latin1 DEFAULT NULL,
  `created` date NOT NULL,
  `modified` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_projets_contrats1_idx` (`contrat_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `sections`
--

CREATE TABLE IF NOT EXISTS `sections` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `utilisateur_id` int(15) DEFAULT NULL,
  `NOM` varchar(255) CHARACTER SET latin1 NOT NULL,
  `DESCRIPTION` text CHARACTER SET latin1,
  `created` date NOT NULL,
  `modified` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_sections_utilisateurs1_idx` (`utilisateur_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `sites`
--

CREATE TABLE IF NOT EXISTS `sites` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `NOM` varchar(35) CHARACTER SET latin1 NOT NULL,
  `DESCRIPTION` text CHARACTER SET latin1,
  `created` date NOT NULL,
  `modified` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Structure de la table `societes`
--

CREATE TABLE IF NOT EXISTS `societes` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `NOM` varchar(255) CHARACTER SET latin1 NOT NULL,
  `NOMCONTACT` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `TELEPHONE` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `MAIL` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `created` date NOT NULL,
  `modified` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Structure de la table `suivilivrables`
--

CREATE TABLE IF NOT EXISTS `suivilivrables` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `livrable_id` int(15) NOT NULL,
  `ECHEANCE` date DEFAULT NULL,
  `DATELIVRAISON` date DEFAULT NULL,
  `DATEVALIDATION` date DEFAULT NULL,
  `ETAT` enum('à faire','en cours','validé','livré','refusé','annulé') DEFAULT NULL,
  `created` date NOT NULL,
  `modified` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_suivilivrables_livrables1_idx` (`livrable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `tjmagents`
--

CREATE TABLE IF NOT EXISTS `tjmagents` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `NOM` varchar(255) CHARACTER SET latin1 NOT NULL,
  `TARIFHT` decimal(25,2) DEFAULT NULL,
  `TARIFTTC` decimal(25,2) DEFAULT NULL,
  `ANNEE` year(4) NOT NULL,
  `created` date NOT NULL,
  `modified` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `tjmcontrats`
--

CREATE TABLE IF NOT EXISTS `tjmcontrats` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `TJM` decimal(25,2) NOT NULL,
  `ANNEE` year(4) NOT NULL,
  `created` date NOT NULL,
  `modified` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `typemateriels`
--

CREATE TABLE IF NOT EXISTS `typemateriels` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `NOM` varchar(30) CHARACTER SET latin1 NOT NULL,
  `DESCRIPTION` text CHARACTER SET latin1,
  `created` date NOT NULL,
  `modified` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `profil_id` int(15) DEFAULT NULL,
  `societe_id` int(15) NOT NULL,
  `assistance_id` int(15) DEFAULT NULL,
  `section_id` int(15) DEFAULT NULL,
  `utilisateur_id` int(15) DEFAULT NULL COMMENT 'Hiérarchique',
  `domaine_id` int(15) DEFAULT NULL,
  `site_id` int(15) DEFAULT NULL,
  `tjmagent_id` int(15) DEFAULT NULL,
  `dotation_id` int(15) DEFAULT NULL,
  `password` varchar(35) NOT NULL DEFAULT 'OSACT',
  `username` varchar(35) CHARACTER SET latin1 DEFAULT NULL COMMENT 'login déclaré dans AD',
  `ACTIF` tinyint(1) NOT NULL DEFAULT '1',
  `DATEDEBUTACTIF` date DEFAULT NULL,
  `NAISSANCE` date NOT NULL,
  `NOM` varchar(35) CHARACTER SET latin1 NOT NULL,
  `PRENOM` varchar(35) CHARACTER SET latin1 NOT NULL,
  `COMMENTAIRE` longtext CHARACTER SET latin1,
  `FINMISSION` date DEFAULT NULL,
  `MAIL` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `TELEPHONE` varchar(15) CHARACTER SET latin1 DEFAULT NULL,
  `WORKCAPACITY` int(1) NOT NULL DEFAULT '1',
  `CONGE` int(15) NOT NULL DEFAULT '0',
  `RQ` int(15) NOT NULL DEFAULT '0',
  `VT` int(15) NOT NULL DEFAULT '0',
  `HIERARCHIQUE` tinyint(1) NOT NULL DEFAULT '0',
  `GESTIONABSENCES` tinyint(1) NOT NULL DEFAULT '0',
  `created` date NOT NULL,
  `modified` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_utilisateurs_societes_idx` (`societe_id`),
  KEY `fk_utilisateurs_profils1_idx` (`profil_id`),
  KEY `fk_utilisateurs_assistances1_idx` (`assistance_id`),
  KEY `fk_utilisateurs_domaines1_idx` (`domaine_id`),
  KEY `fk_utilisateurs_sites1_idx` (`site_id`),
  KEY `fk_utilisateurs_sections1_idx` (`section_id`),
  KEY `fk_utilisateurs_tjmagents1_idx` (`tjmagent_id`),
  KEY `fk_utilisateurs_utilisateurs1_idx` (`utilisateur_id`),
  KEY `fk_utilisateurs_dotations1_idx` (`dotation_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Structure de la table `utiliseoutils`
--

CREATE TABLE IF NOT EXISTS `utiliseoutils` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `utilisateur_id` int(15) NOT NULL,
  `outil_id` int(15) DEFAULT NULL,
  `listediffusion_id` int(15) DEFAULT NULL,
  `dossierpartage_id` int(10) DEFAULT NULL,
  `STATUT` enum('Demandé','Pris en compte','En validation','Validé','Demande transférée','Demande traitée','Retour utilisateur','A supprimer','Supprimée') DEFAULT NULL,
  `TYPE` enum('Outil','Liste Diffusion','Partage Réseaux','') CHARACTER SET latin1 DEFAULT NULL,
  `created` date NOT NULL,
  `modified` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_utiliseoutils_outils1_idx` (`outil_id`),
  KEY `fk_utiliseoutils_utilisateurs1_idx` (`utilisateur_id`),
  KEY `fk_utiliseoutils_listediffusions1_idx` (`listediffusion_id`),
  KEY `fk_utiliseoutils_dossierpartages1_idx` (`dossierpartage_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `achats`
--
ALTER TABLE `achats`
  ADD CONSTRAINT `fk_achats_activites1` FOREIGN KEY (`activite_id`) REFERENCES `activites` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `activites`
--
ALTER TABLE `activites`
  ADD CONSTRAINT `fk_activites_projets1` FOREIGN KEY (`projet_id`) REFERENCES `projets` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `affectations`
--
ALTER TABLE `affectations`
  ADD CONSTRAINT `fk_affectations_activites1` FOREIGN KEY (`activite_id`) REFERENCES `activites` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_affectations_utilisateurs1` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateurs` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `autorisations`
--
ALTER TABLE `autorisations`
  ADD CONSTRAINT `fk_autorisations_profils1` FOREIGN KEY (`profil_id`) REFERENCES `profils` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `contrats`
--
ALTER TABLE `contrats`
  ADD CONSTRAINT `fk_contrats_tjmcontrats1` FOREIGN KEY (`tjmcontrat_id`) REFERENCES `tjmcontrats` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `dotations`
--
ALTER TABLE `dotations`
  ADD CONSTRAINT `fk_dotations_materielinformatiques1` FOREIGN KEY (`materielinformatique_id`) REFERENCES `materielinformatiques` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_dotations_utilisateurs1` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateurs` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_dotations_typemateriels1` FOREIGN KEY (`typemateriel_id`) REFERENCES `typemateriels` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `historyactions`
--
ALTER TABLE `historyactions`
  ADD CONSTRAINT `fk_historyactions_actions1` FOREIGN KEY (`action_id`) REFERENCES `actions` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_historyactions_utilisateurs1` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateurs` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `historydotations`
--
ALTER TABLE `historydotations`
  ADD CONSTRAINT `fk_historydotation_dotations1` FOREIGN KEY (`dotation_id`) REFERENCES `dotations` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `historyutilisateurs`
--
ALTER TABLE `historyutilisateurs`
  ADD CONSTRAINT `fk_historyutilisateur_utilisateurs1` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateurs` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `linkshareds`
--
ALTER TABLE `linkshareds`
  ADD CONSTRAINT `fk_linkshareds_utilisateurs1` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateurs` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `listediffusions`
--
ALTER TABLE `listediffusions`
  ADD CONSTRAINT `fk_listediffusions_utilisateurs1` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateurs` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `livrables`
--
ALTER TABLE `livrables`
  ADD CONSTRAINT `fk_livrables_utilisateurs1` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateurs` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `materielinformatiques`
--
ALTER TABLE `materielinformatiques`
  ADD CONSTRAINT `fk_materielinformatiques_assistances1` FOREIGN KEY (`assistance_id`) REFERENCES `assistances` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_materielinformatiques_sections1` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_materielinformatiques_typemateriels1` FOREIGN KEY (`typemateriel_id`) REFERENCES `typemateriels` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `outils`
--
ALTER TABLE `outils`
  ADD CONSTRAINT `fk_outils_utilisateurs1` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateurs` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `projets`
--
ALTER TABLE `projets`
  ADD CONSTRAINT `fk_projets_contrats1` FOREIGN KEY (`contrat_id`) REFERENCES `contrats` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `sections`
--
ALTER TABLE `sections`
  ADD CONSTRAINT `fk_sections_utilisateurs1` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateurs` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `suivilivrables`
--
ALTER TABLE `suivilivrables`
  ADD CONSTRAINT `fk_suivilivrables_livrables1` FOREIGN KEY (`livrable_id`) REFERENCES `livrables` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD CONSTRAINT `fk_utilisateurs_assistances1` FOREIGN KEY (`assistance_id`) REFERENCES `assistances` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_utilisateurs_domaines1` FOREIGN KEY (`domaine_id`) REFERENCES `domaines` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_utilisateurs_dotations1` FOREIGN KEY (`dotation_id`) REFERENCES `dotations` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_utilisateurs_profils1` FOREIGN KEY (`profil_id`) REFERENCES `profils` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_utilisateurs_sections1` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_utilisateurs_sites1` FOREIGN KEY (`site_id`) REFERENCES `sites` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_utilisateurs_societes` FOREIGN KEY (`societe_id`) REFERENCES `societes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_utilisateurs_tjmagents1` FOREIGN KEY (`tjmagent_id`) REFERENCES `tjmagents` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_utilisateurs_utilisateurs1` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateurs` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `utiliseoutils`
--
ALTER TABLE `utiliseoutils`
  ADD CONSTRAINT `fk_utiliseoutils_dossierpartages1` FOREIGN KEY (`dossierpartage_id`) REFERENCES `dossierpartages` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_utiliseoutils_listediffusions1` FOREIGN KEY (`listediffusion_id`) REFERENCES `listediffusions` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_utiliseoutils_outils1` FOREIGN KEY (`outil_id`) REFERENCES `outils` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_utiliseoutils_utilisateurs1` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateurs` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
