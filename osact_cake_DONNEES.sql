-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Mar 26 Février 2013 à 09:01
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

--
-- Contenu de la table `assistances`
--

INSERT INTO `assistances` (`ID`, `NOM`, `DESCRIPTION`, `created`, `modified`) VALUES
(1, 'SAMBA', 'Service d''assistance qui est utilisé par DSIT', '2013-02-26', '2013-02-26');

--
-- Contenu de la table `autorisations`
--

INSERT INTO `autorisations` (`id`, `profil_id`, `MODEL`, `INDEX`, `ADD`, `EDIT`, `VIEW`, `DELETE`, `DUPLICATE`, `INITPASSWORD`, `created`, `modified`) VALUES
(1, 1, 'achats', 1, 1, 1, 1, 1, 0, 0, '2013-02-26', '2013-02-26'),
(2, 1, 'actions', 1, 1, 1, 1, 1, 0, 0, '2013-02-26', '2013-02-26'),
(3, 1, 'activites', 1, 1, 1, 1, 1, 0, 0, '2013-02-26', '2013-02-26'),
(4, 1, 'affectations', 1, 1, 1, 1, 1, 0, 0, '2013-02-26', '2013-02-26'),
(5, 1, 'assistances', 1, 1, 1, 1, 1, 0, 0, '2013-02-26', '2013-02-26'),
(6, 1, 'autorisations', 1, 1, 1, 1, 1, 0, 0, '2013-02-26', '2013-02-26'),
(7, 1, 'contrats', 1, 1, 1, 1, 1, 0, 0, '2013-02-26', '2013-02-26'),
(8, 1, 'domaines', 1, 1, 1, 1, 1, 0, 0, '2013-02-26', '2013-02-26'),
(9, 1, 'dossierpartages', 1, 1, 1, 1, 1, 0, 0, '2013-02-26', '2013-02-26'),
(10, 1, 'dotations', 1, 1, 1, 1, 1, 0, 0, '2013-02-26', '2013-02-26'),
(11, 1, 'historyactions', 1, 1, 1, 1, 1, 0, 0, '2013-02-26', '2013-02-26'),
(12, 1, 'historydotations', 1, 1, 1, 1, 1, 0, 0, '2013-02-26', '2013-02-26'),
(13, 1, 'historyutilisateurs', 1, 1, 1, 1, 1, 1, 1, '2013-02-26', '2013-02-26'),
(14, 1, 'linkshareds', 1, 1, 1, 1, 1, 0, 0, '2013-02-26', '2013-02-26'),
(15, 1, 'listediffusions', 1, 1, 1, 1, 1, 0, 0, '2013-02-26', '2013-02-26'),
(16, 1, 'livrables', 1, 1, 1, 1, 1, 0, 0, '2013-02-26', '2013-02-26'),
(17, 1, 'materielinformatiques', 1, 1, 1, 1, 1, 0, 0, '2013-02-26', '2013-02-26'),
(18, 1, 'messages', 1, 1, 1, 1, 1, 0, 0, '2013-02-26', '2013-02-26'),
(19, 1, 'outils', 1, 1, 1, 1, 1, 0, 0, '2013-02-26', '2013-02-26'),
(20, 1, 'profils', 1, 1, 1, 1, 1, 0, 0, '2013-02-26', '2013-02-26'),
(21, 1, 'projets', 1, 1, 1, 1, 1, 0, 0, '2013-02-26', '2013-02-26'),
(22, 1, 'sections', 1, 1, 1, 1, 1, 0, 0, '2013-02-26', '2013-02-26'),
(23, 1, 'sites', 1, 1, 1, 1, 1, 0, 0, '2013-02-26', '2013-02-26'),
(24, 1, 'societes', 1, 1, 1, 1, 1, 0, 0, '2013-02-26', '2013-02-26'),
(25, 1, 'suivilivrables', 1, 1, 1, 1, 1, 0, 0, '2013-02-26', '2013-02-26'),
(26, 1, 'tjmagents', 1, 1, 1, 1, 1, 0, 0, '2013-02-26', '2013-02-26'),
(27, 1, 'tjmcontrats', 1, 1, 1, 1, 1, 0, 0, '2013-02-26', '2013-02-26'),
(28, 1, 'typemateriels', 1, 1, 1, 1, 1, 0, 0, '2013-02-26', '2013-02-26'),
(29, 1, 'utilisateurs', 1, 1, 1, 1, 1, 1, 1, '2013-02-26', '2013-02-26'),
(30, 1, 'utiliseoutils', 1, 1, 1, 1, 1, 0, 0, '2013-02-26', '2013-02-26');

--
-- Contenu de la table `messages`
--

INSERT INTO `messages` (`id`, `LIBELLE`, `DATELIMITE`, `created`, `modified`) VALUES
(1, 'Bienvenue sur OSACT le site pour le suivi de l''activité et de la logistique.', NULL, '2013-02-26', '2013-02-26');

--
-- Contenu de la table `profils`
--

INSERT INTO `profils` (`id`, `NOM`, `COMMENTAIRE`, `created`, `modified`) VALUES
(1, 'administrateur', 'Profil donnant un accès illimité au compte', '2013-02-26', '2013-02-26');

--
-- Contenu de la table `sites`
--

INSERT INTO `sites` (`id`, `NOM`, `DESCRIPTION`, `created`, `modified`) VALUES
(1, 'OXYGENE', 'Site lyonnais de DSIT', '2013-02-26', '2013-02-26'),
(2, 'INNOVIA', 'Site parisien de DSIT', '2013-02-26', '2013-02-26'),
(3, 'LUMIERE', 'Site parisien du client MATERIEL', '2013-02-26', '2013-02-26');

--
-- Contenu de la table `societes`
--

INSERT INTO `societes` (`id`, `NOM`, `NOMCONTACT`, `TELEPHONE`, `MAIL`, `created`, `modified`) VALUES
(1, 'SNCF', NULL, NULL, NULL, '2013-02-26', '2013-02-26');

--
-- Contenu de la table `typemateriels`
--

INSERT INTO `typemateriels` (`id`, `NOM`, `DESCRIPTION`, `created`, `modified`) VALUES
(1, 'ordinateur de bureau', 'Ordinateur de bureau prévu au contrat cadre, le type , modèle de l’ordinateur seront repris sur la fiche du poste informatique', '2013-02-26', '2013-02-26'),
(2, 'portable', 'Ordinateur portable prévu au contrat cadre, le type , modèle du portable seront repris sur la fiche du poste informatique', '2013-02-26', '2013-02-26');

--
-- Contenu de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `profil_id`, `societe_id`, `assistance_id`, `section_id`, `utilisateur_id`, `domaine_id`, `site_id`, `tjmagent_id`, `dotation_id`, `password`, `username`, `ACTIF`, `DATEDEBUTACTIF`, `NAISSANCE`, `NOM`, `PRENOM`, `COMMENTAIRE`, `FINMISSION`, `MAIL`, `TELEPHONE`, `WORKCAPACITY`, `CONGE`, `RQ`, `VT`, `HIERARCHIQUE`, `GESTIONABSENCES`, `created`, `modified`) VALUES
(1, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'MD5(OSACTADM)', '12345ADM', 1, NULL, '0000-00-00', 'Administrateur', 'Admin', 'Compte ne devant pas être supprimé et ne devant pas apparaitre dans les listes.', NULL, NULL, NULL, 1, 0, 0, 0, 0, 0, '2013-02-26', '2013-02-26');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
