# WordPress : buffernow.com MySQL database backup
#
# Generated: Thursday 23. May 2013 19:38 CEST
# Hostname: localhost
# Database: `saill_200`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `achats`
# --------------------------------------------------------


#
# Delete any existing table `achats`
#

DROP TABLE IF EXISTS `achats`;


#
# Table structure of table `achats`
#

CREATE TABLE `achats` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `activite_id` int(15) NOT NULL,
  `LIBELLEACHAT` varchar(255) CHARACTER SET latin1 NOT NULL,
  `DATE` date NOT NULL,
  `MONTANT` decimal(25,2) NOT NULL,
  `DESCRIPTION` text CHARACTER SET latin1,
  `created` date NOT NULL,
  `modified` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ;

#
# Data contents of table achats (2 records)
#
 
INSERT INTO `achats` VALUES (1, 40, 'Casque téléphonie', '2013-02-11', '224.60', 'Sur le contrat : CTR00035630 ITANCIA<br />2 Micro casque téléphonique - Binaural réf. GAM09', '2013-03-27', '2013-03-27') ; 
INSERT INTO `achats` VALUES (2, 40, 'Ordinateur portable - Ecran - Accessoires', '2013-03-21', '3413.50', '<table style="width: 671px; height: 234px;" border="0" cellspacing="0" cellpadding="0"><colgroup><col width="100" /> <col width="373" /> <col width="78" /> <col width="70" /> <col width="76" /> </colgroup>
<tbody>
<tr>
<td width="100" height="21">Réf</td>
<td width="373">Type de matériel</td>
<td width="78">Quantité</td>
<td width="70">Prix unitaire</td>
<td width="76">Prix Total</td>
</tr>
<tr>
<td class="xl67" height="22">2325QZ5 </td>
<td class="xl67">Portable ultra léger LENOVO X230 - 12,5\'\'</td>
<td class="xl67" align="right">4</td>
<td class="xl66">    551,18 €</td>
<td class="xl66">   2 204,72 €</td>
</tr>
<tr>
<td class="xl67" height="21">910-001246</td>
<td class="xl67">Souris optique filaire 3 boutons (Logitech B110) - Port USB </td>
<td class="xl67" align="right">6</td>
<td class="xl66">         4,00 €</td>
<td class="xl66">        24,00 €</td>
</tr>
<tr>
<td class="xl67" height="21">0A36307</td>
<td class="xl67">Batterie longue durée pour LENOVO X220 ou X230 </td>
<td class="xl67" align="right">4</td>
<td class="xl66">      47,71 €</td>
<td class="xl66">      190,84 €</td>
</tr>
<tr>
<td class="xl67" height="21">ELS-113</td>
<td class="xl67">Housse protection pour ordi. portable (Ecran 13\'\') </td>
<td class="xl67" align="right">4</td>
<td class="xl66">         4,70 €</td>
<td class="xl66">        18,80 €</td>
</tr>
<tr>
<td class="xl67" height="21">CMP-SAFE3</td>
<td class="xl67">Câble antivol avec système de verrouillage par clé </td>
<td class="xl67" align="right">4</td>
<td class="xl66">         1,51 €</td>
<td class="xl66">           6,04 €</td>
</tr>
<tr>
<td class="xl67" height="21">0A33988</td>
<td class="xl67">Lecteur Graveur DVD externe USB - Portable LENOVO </td>
<td class="xl67" align="right">4</td>
<td class="xl66">      38,09 €</td>
<td class="xl66">      152,36 €</td>
</tr>
<tr>
<td class="xl67" height="21">220S4LCB</td>
<td class="xl67">Ecran plat bureautique - LED - 22 pouces - Wide 16/10 </td>
<td class="xl67" align="right">4</td>
<td class="xl66">    115,30 €</td>
<td class="xl66">      461,20 €</td>
</tr>
<tr>
<td class="xl68" height="21">100080</td>
<td class="xl67">Sac à dos pour ordinateur portable (Ecran 15,4\'\'\'\') </td>
<td class="xl67" align="right">7</td>
<td class="xl66">         7,97 €</td>
<td class="xl66">        55,79 €</td>
</tr>
<tr>
<td class="xl68" height="21">0A65683 </td>
<td class="xl67">Station d accueil pour portable LENOVO </td>
<td class="xl67" align="right">0</td>
<td class="xl66">      77,33 €</td>
<td class="xl66">               -   €</td>
</tr>
<tr>
<td class="xl68" height="21">DD-EXT-25-320</td>
<td class="xl67">Disque dur ext. 2,5\'\' - 320 Go - USB 2.0 - Auto alimenté </td>
<td class="xl67" align="right">5</td>
<td class="xl66">      59,95 €</td>
<td class="xl66">      299,75 €</td>
</tr>
</tbody>
</table>', '2013-03-27', '2013-03-27') ;
#
# End of data contents of table achats
# --------------------------------------------------------

# WordPress : buffernow.com MySQL database backup
#
# Generated: Thursday 23. May 2013 19:38 CEST
# Hostname: localhost
# Database: `saill_200`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `achats`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `actions`
# --------------------------------------------------------


#
# Delete any existing table `actions`
#

DROP TABLE IF EXISTS `actions`;


#
# Table structure of table `actions`
#

CREATE TABLE `actions` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `utilisateur_id` int(15) NOT NULL COMMENT 'Créateur\n',
  `destinataire` int(15) NOT NULL COMMENT 'Destinataire',
  `domaine_id` int(15) NOT NULL,
  `activite_id` int(15) NOT NULL,
  `OBJET` text CHARACTER SET latin1 NOT NULL,
  `AVANCEMENT` int(11) DEFAULT '0',
  `COMMENTAIRE` text CHARACTER SET latin1,
  `ECHEANCE` date DEFAULT NULL,
  `DEBUT` date DEFAULT NULL,
  `STATUT` enum('à faire','en cours','terminée','livré','annulée') CHARACTER SET latin1 DEFAULT 'en cours',
  `DUREEPREVUE` int(15) DEFAULT '0',
  `PRIORITE` enum('normale','moyenne','haute') CHARACTER SET latin1 DEFAULT 'normale',
  `CRA` tinyint(1) DEFAULT '0',
  `created` date NOT NULL,
  `modified` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=79 DEFAULT CHARSET=utf8 ;

#
# Data contents of table actions (75 records)
#
 
INSERT INTO `actions` VALUES (1, 5, 5, 25, 21, 'CRA 1er semestre 2013', 70, 'Janvier :<br />
<ul>
<li>Incorporation de l\'activité</li>
</ul>
<p>Février :</p>
<ul>
<li>Incorporation de l\'activité</li>
<li>Consolidation consommé et insertion</li>
<li>Envois pour validation</li>
</ul>
<p>Mars :</p>
<ul>
<li>Incorporation du budget contratcualisé</li>
<li>Consolidation du consommé (02/04/2013 pas de retour pour charge de LMN et E7)</li>
<li>Incorporation de l\'activité réalisée en mars dans le CRA</li>
<li>Envoyé pour validation à AAE et JBJ</li>
<li><span style="color: #ff0000;">Correction sur l\'emplacement des coûts DSIT-X mis en MCO explication sur montant de 2805k€ (2309k€ + 455 k€), changement année pour prestation formation</span></li>
<li>Attente de la prise de décision concernant le budget - CRA non validé</li>
</ul>
<p>Avril :</p>
<ul>
<li>Non consolidé pour le CRA en attente du budget</li>
</ul>
<p>Mai :</p>
<ul>
<li>A faire au retour des vacances.</li>
<li>Consolider l\'activité d\'avril et mettre en place dans le CRA, idem activités.</li>
</ul>
<p> </p>', '2013-06-06', '2013-01-07', 'en cours', 192, 'normale', 1, '2013-03-27', '2013-05-13') ; 
INSERT INTO `actions` VALUES (2, 5, 5, 25, 21, 'Indicateurs département', 100, 'Envois des indicateurs département au format demandé.<br />Entretien avec Irène BONNASSIEUX, pour expliquer le focntionnement d\'OSMOSE et de la remonté d\'indicateur, vu avec elle pour lui transmettre tous les mois un tableau d\'indicateur du consommé avec un petit argumentaire.<br />27/03/2013 envois du tableau d\'indicateurs du consommé pour OSMOSE', '2013-03-28', '2013-03-25', 'terminée', 8, 'normale', 0, '2013-03-27', '2013-03-27') ; 
INSERT INTO `actions` VALUES (3, 5, 5, 25, 21, 'Logistique', 100, 'Activité récurrente<br />DSI-T/SO <br />
<ul>
<li>arrivé de Sébastien PAGNARD, Stéphane BEYDON</li>
<li>Préparation de l\'arrivée de Amsata NGOM</li>
</ul>
Groupement<br />
<ul>
<li>Création de compte</li>
<li>incident de connexion ...</li>
</ul>', '2013-03-29', '2013-03-01', 'terminée', 64, 'normale', 1, '2013-03-27', '2013-04-02') ; 
INSERT INTO `actions` VALUES (4, 5, 5, 25, 21, 'Réalisation d\'un outil de suivi "OSACT"', 100, 'Conception 12 jours<br />Réalisation 40 jours<br /><br />Bascule sur le serveur de production le 28/03/2013, mis à jour le 23/04/2013 avec la build 0041<br /><br />Evolutions en cours :<br />
<ul>
<li>Facturations =&gt; fait</li>
<li>Plan de charge =&gt; fait</li>
<li>Prise en compte des évolutions prévues =&gt; en cours</li>
<li>Mise en place d\'une nouvelle navigation</li>
<li>Rapports (actions, consommation réelles, facturé, plan de charge)</li>
</ul>', '2013-05-30', '2013-02-04', 'terminée', 416, 'normale', 0, '2013-03-27', '2013-05-13') ; 
INSERT INTO `actions` VALUES (5, 5, 5, 25, 21, 'Retour suppression comptes désactivés', 100, 'Retour à Irène BONNASSIEUX des comptes à supprimer pour le compte d\'OMSOSE suite à non utilisation.', '2013-03-27', '2013-03-27', 'terminée', 2, 'normale', 0, '2013-03-27', '2013-03-27') ; 
INSERT INTO `actions` VALUES (6, 5, 5, 4, 21, 'Demande de création de compte SVN pour Gokhan OZTURK ', 100, 'Compte déjà existant demande pour rien', '2013-03-28', '2013-03-28', 'terminée', 2, 'normale', 0, '2013-03-28', '2013-03-28') ; 
INSERT INTO `actions` VALUES (7, 5, 5, 25, 21, 'Logistique Avril 2013', 100, 'Le 02/04/2013 :<br /><ol>
<li>Arrivée à Lyon de Renaud BORG</li>
<li>Préparation poste de dépannage P64L03BIXXX pour Renaud BORG</li>
<li>Traitemement des demandes de fin de semaine précédente</li>
<li>Demande d\'ouverture de droits pour Renaud BORG et BELHOUT Mabrouk</li>
<li>Deux nouveaux arrivant sur VILLEURBANNE pour ORCHESTRAL.</li>
<li>demande de créations de compte pour deux nouveaux arrivants à SOGETI</li>
<li>Demande de création de dossier personnel pour BORG Renaud</li>
</ol>
<p>Le 03/04/2013 :</p>
<ol>
<li>Demande d\'ajout dans des groupes existant pour LUC et RUIZ</li>
<li>Demande ouverture de droits pour LUC et RUIZ</li>
</ol>Le 04/04/2013 :<br /><ol>
<li>Mise à jour de listes de diffusion pour le groupement</li>
<li>Suivi des ouverture de droits</li>
<li>Demande accès SAMETIME pour S BEYDON</li>
<li>Relance D LECLERC sur mise à jour de la commande de matériel à confirmer en COCOR</li>
</ol>Le 08/04/2013 :<br /><ol>
<li>Mise à jour de liste de diffusion groupement</li>
</ol>Le 09/04/2013 :<br /><ol>
<li>Mise à jour liste de diffusion groupement</li>
</ol>Le 10/04/2013 :<br /><ol>
<li>Activation du compte de LANAILLE Sébastien et demande d\'ouverture de droit</li>
</ol>Le 11/04/2013<br /><ol>
<li>Création de compte pour FLORE PELE</li>
</ol>Le 15/04/2013<br /><ol>
<li>Suivi d\'avancement logistique</li>
<li>Ouverture de droits pour FLORE PELE</li>
<li>Création de deux comptes pour Groupement</li>
<li>Ouverture des droits à F. RABATEL sur OSMOSECSNROP</li>
<li>Accés Minidoc pour MONTROIG Thomas (DM/M S&amp;F)</li>
<li>Accueil de NGOM Amsata, présentation équipe, locaux et utilisation fichier absences</li>
</ol>Le 16/04/2013 :<br /><ol>
<li>Suivi des ouverture de droits</li>
<li>Mis à jour liste de diffusion</li>
<li>Mise à jour du suivi pour ARIANE et autres ouvertures de droits</li>
</ol>le 17/04/2013 :<br /><ol>
<li>Demande ouverture d edroits pour C. Bril</li>
<li>Information réception commande portable. Attente contact samba logistique.</li>
<li>Envois des dossier pour installations des 4 portables, demande pour récupérer les accessoires faites</li>
</ol>Le 18/04/2013<br /><ol>
<li>Suivi logistique</li>
</ol>Le 22/04/2013 :<br /><ol>
<li>Activation du compte de MANDINA-NZEZA Guy-Serge</li>
<li>Initilaisation du mot de passe de MANDINA-NZEZA Guy-Serge</li>
</ol>le 23/04/2013 :<br /><ol>
<li>Suivi logistique suite aux retours de SAMBA</li>
</ol>le 24/04/2013:<br /><ol>
<li>Incident connexion à QC réponse par mail et redirection vers dsit-exil</li>
<li>Droits administrateur sur un poste + explications</li>
</ol>', '2013-04-25', '2013-04-02', 'terminée', 64, 'normale', 1, '2013-04-02', '2013-04-25') ; 
INSERT INTO `actions` VALUES (8, 5, 5, 25, 21, 'Audit OSMOSE', 100, 'Consolidation des charges consommées sur le lot 303 en 2012 et janvier 2013.<br />Remplir le fichier Excel envoyé par Jean-Pierre NEFF et le renvoyer à AAE, JBJ et JPN avec les explications<br /><br />Transmis les information à AAE, JBJ et JPN suite aux derniers élément de Jean-Baptiste', '2013-04-04', '2013-04-03', 'terminée', 8, 'normale', 0, '2013-04-03', '2013-04-04') ; 
INSERT INTO `actions` VALUES (9, 5, 5, 25, 21, 'Démonstration OSACT', 100, 'Présentation de l\'outil à AAE et JBJ pour validation avant mise en service à un périmétre réduit de l\'équipe.<br />Périmétre à définir lors de cette présentation.<br />Je pense à : <br />
<ul>
<li>Sabine GEOFFROY</li>
<li>Magali BURIAND</li>
<li>Benoit TRENTO</li>
<li>Jacques LEVAVASSEUR</li>
<li>Patricia RIFFIOD</li>
</ul>
Ne faut-il pas qu\'ils assistent à la présentation ? <br />Echéance repoussée à mi mai<br />Rendez-vous envoyé<br />Préparation de la base et de l\'outil dans sa dernière version.<br />Présentation faite au format PPT', '2005-06-04', '2013-04-24', 'terminée', 2, 'normale', 0, '2013-04-03', '2013-05-15') ; 
INSERT INTO `actions` VALUES (10, 5, 5, 25, 21, 'Saisie d\'activté de S. PAGNARD', 100, 'Voir avec Sébastien si délégation de saisie faite<br />Saisir activité de Sébastien sur PANAM DEV à parit du 04/03/2013<br />Facturation faite', '2013-04-11', '2013-04-10', 'terminée', 1, 'normale', 0, '2013-04-08', '2013-04-09') ; 
INSERT INTO `actions` VALUES (11, 5, 5, 25, 21, 'Suivi activité SS2I', 100, 'Consolidation des charges d\'avril<br />Contacts avec Charlotte DUVERGER pour :<br />
<ul>
<li>consolidation commune GMAO et PANAM</li>
<li>Ecart facturation pour Aurélie CARRET et Julien DELEFOSSE</li>
</ul>
Envois de la consolidation pour validation SS2I<br /><br />Confrontation des chiffres avec SQLi/STERIA mercredi 16/04/2013<br /><br />Exl group : écart d\'un jour sur le mois de mars rattrappage en avril (-1)<br /><br />Fichier Excel renseigné et sauvegardé.<br />Attente des retours STERIA - EURIWARE et EXLGROUP pour finaliser<br />Vu avec EXLGROUP<br />Vu avec STERIA dans l\'après midi<br />Envois à Euriware de la prévision de facturation pour Avril', '2013-04-22', '2013-04-11', 'terminée', 8, 'moyenne', 0, '2013-04-15', '2013-04-18') ; 
INSERT INTO `actions` VALUES (12, 5, 5, 25, 21, 'DA - CDA prestations STERIA', 100, 'Recherche d\'information sur comment faire<br />Prise de contact avec VALLI Sébastien<br />Fichier Excel rempli , envoyé au chef de section.<br />Retour CV et proposition STERIA pour Stéphane BEYDON.<br />En attente du CV et de la proposition pour Renaud BORG<br /><br />Envoyé le 15/04/2013', '2013-04-18', '2013-04-09', 'terminée', 8, 'normale', 0, '2013-04-15', '2013-04-16') ; 
INSERT INTO `actions` VALUES (13, 5, 5, 25, 21, 'Saisie GALILEI pour les agents SNCF', 100, 'Reste l\'activité de Benoit TRENTO avec la répartition sur les diférentes activités.<br />Toutes les autres saisies sont faites.<br />Rattrappage de 2 jours mis en Congé pour N. THARSIS en mars non pris, mis travaillé à la place en Avril', '2013-04-23', '2013-04-11', 'terminée', 12, 'moyenne', 0, '2013-04-16', '2013-04-17') ; 
INSERT INTO `actions` VALUES (14, 5, 5, 25, 21, 'Logistique Mai 2013', 70, 'le 13/05/2013:<br />
<ul>
<li>mise à jour de SAILL pour la création du compte de AGUILAR</li>
<li>Demande ouverture de droits</li>
<li>Activation du compte de LEBLANC Bastien</li>
<li>Demande ouverture de droits</li>
<li>Demande information budget SGRM</li>
</ul>
le 14/05/2013<br />
<ul>
<li>mise à jour avancement ouverture de droit</li>
<li>demande droit admin sur poste P71</li>
<li>changement liste diffusion pour LEBLANC</li>
</ul>
le 16/05/2013<br />
<ul>
<li>renseignement pour fournir un PC à Vincent BERNIER</li>
<li>Attente info pour le compte et surtout le mot de passe</li>
<li>Anticipation de la demande d\'activation du compte de Vincent BERNIER -compte supprimé sera créé par SAMBA formulaire envoyé attente retour.</li>
</ul>
Le 21/05/2013<br />
<ul>
<li>Dépannage Visio</li>
<li>Création de compte</li>
</ul>', '2013-05-30', '2013-04-24', 'en cours', 48, 'normale', 1, '2013-04-24', '2013-05-22') ; 
INSERT INTO `actions` VALUES (15, 5, 5, 4, 21, 'Création d\'un nouvel utilisateur', 100, '<a href="../../utilisateurs/edit/276">Lien vers le nouvel utilisateur<br /></a>Reste les demandes d\'ouverture de droits à faire<a href="../../utilisateurs/edit/276"><br /></a>', '2013-05-18', '2013-05-13', 'terminée', 2, 'haute', 0, '2013-05-13', '2013-05-13') ; 
INSERT INTO `actions` VALUES (16, 5, 5, 25, 21, 'Logistique Juin 2013', -20, '', '2013-06-27', '2013-06-01', 'à faire', 48, 'normale', 1, '2013-05-13', '2013-05-15') ; 
INSERT INTO `actions` VALUES (17, 5, 5, 4, 21, 'Création d\'une nouvelle demande d\'ouverture de droit', 100, '<a href="../../utiliseoutils/edit/104">Lien vers la nouvelle demande d\'ouverture de droit<br /></a>En attente de précision sur la liste de diffusion<a href="../../utiliseoutils/edit/104"><br /></a>
<p>Concernant M. Aguilar Gustavo, il faudrait l\'ajouter à la liste de diffusion *OSMOSE Intégrateur GMAO FONC</p>', '2013-05-18', '2013-05-13', 'terminée', 2, 'haute', 0, '2013-05-13', '2013-05-13') ; 
INSERT INTO `actions` VALUES (18, 5, 5, 4, 21, 'Création d\'une nouvelle demande d\'ouverture de droit', 100, '<a href="../../utiliseoutils/edit/105">Lien vers la nouvelle demande d\'ouverture de droit</a>', '2013-05-18', '2013-05-13', 'terminée', 2, 'haute', 0, '2013-05-13', '2013-05-13') ; 
INSERT INTO `actions` VALUES (19, 5, 5, 4, 21, 'Création d\'une nouvelle demande d\'ouverture de droit', 100, '<a href="../../utiliseoutils/edit/106">Lien vers la nouvelle demande d\'ouverture de droit</a>', '2013-05-18', '2013-05-13', 'terminée', 2, 'haute', 0, '2013-05-13', '2013-05-13') ; 
INSERT INTO `actions` VALUES (20, 5, 5, 4, 21, 'Création d\'une nouvelle demande d\'ouverture de droit', 100, '<a href="../../utiliseoutils/edit/107">Lien vers la nouvelle demande d\'ouverture de droit</a>', '2013-05-18', '2013-05-13', 'terminée', 2, 'haute', 0, '2013-05-13', '2013-05-13') ; 
INSERT INTO `actions` VALUES (21, 5, 5, 4, 21, 'Création d\'une nouvelle demande d\'ouverture de droit', 100, '<a href="../../utiliseoutils/edit/108">Lien vers la nouvelle demande d\'ouverture de droit</a>', '2013-05-18', '2013-05-13', 'terminée', 2, 'haute', 0, '2013-05-13', '2013-05-13') ; 
INSERT INTO `actions` VALUES (22, 5, 5, 4, 21, 'Création d\'une nouvelle demande d\'ouverture de droit', 100, '<a href="../../utiliseoutils/edit/109">Lien vers la nouvelle demande d\'ouverture de droit</a>', '2013-05-18', '2013-05-13', 'terminée', 2, 'haute', 0, '2013-05-13', '2013-05-13') ; 
INSERT INTO `actions` VALUES (23, 5, 5, 4, 21, 'Création d\'une nouvelle demande d\'ouverture de droit', 100, '<a href="../../utiliseoutils/edit/110">Lien vers la nouvelle demande d\'ouverture de droit</a>', '2013-05-18', '2013-05-13', 'terminée', 2, 'haute', 0, '2013-05-13', '2013-05-13') ; 
INSERT INTO `actions` VALUES (24, 5, 5, 25, 21, 'Evolution SAILL 2.0.1', 40, '<div class="edit-comment-hide">
<div class="js-comment-body comment-body markdown-body markdown-format">
<ul>
<li>Gestions des fichiers des dossiers admin, all avec add, delete</li>
<li>Ajout d\'un lien pour la référence MINIDOC <em><strong>En cours</strong></em></li>
<li>Paramètrage du site (mot de passe admin, Url outil MINDOC, Email contact admin du site, sauvegarde et restauration BDD, ...) <em><strong>En cours</strong></em></li>
<li>Template d\'email avec envois si demandé (choix laissé à l\'utilisateur ou action de notification, envois automatique sur certaines actions)</li>
<li><span style="text-decoration: line-through;">sur la page d\'accueil mes statistiques</span> : <strong>FAIT</strong>
<ul>
<li><span style="text-decoration: line-through;">nombre d\'action à faire, en cours, proche échéance</span></li>
<li><span style="text-decoration: line-through;">Saisie d\'activité</span></li>
<li><span style="text-decoration: line-through;">Mes livrables à venir</span></li>
<li><span style="text-decoration: line-through;">etc.</span></li>
</ul>
</li>
<li>Créer une action automatiquement lors de la création d\'un livrable avec le livrable associé rediriger vers cette action pour la compléter</li>
<li>Sur la création d\'action en automatique des ouvertures de droits ajouter le sujet de la demande dans l\'objet</li>
<li><span style="text-decoration: line-through;">Mise à jour de l\'état des actions en cliquant sur l\'état, avancement à partir de la liste</span> <strong>FAIT</strong></li>
<li>Importation des fichier ics</li>
<li>validation ou avertissement d\'un valideur d\'indisponibilité (spécifique aux prestataires, concerne un petite population)</li>
<li>
<div>Rapport plan de charge calculer le cout à partir du TJM agent attribué à chaque agent, calculer le TJM moyen.</div>
</li>
<li><span style="text-decoration: line-through;">Ajout des domaines dans les feuilles de temps</span> <strong>FAIT</strong></li>
<li><span style="text-decoration: line-through;">Action groupées dans les feuilles de temps</span> <strong>FAIT</strong></li>
<li><span style="text-decoration: line-through;">Réduction des champs obligatoires dans les actions</span> <strong>FAIT</strong></li>
<li><span style="text-decoration: line-through;">Mise à jour des rapports</span> <strong>FAIT</strong></li>
<li><span style="text-decoration: line-through;">Création de compte utilisateur générique</span><strong> <strong>FAIT</strong><em><br /></em></strong></li>
<li>Revoir la navigation<strong><strong><em> En cours</em></strong></strong></li>
<li><span style="text-decoration: line-through;">Quelques évolutions faites à la volée sur les feuilles de temps, les rapports et autre</span> <strong>FAIT</strong></li>
</ul>
</div>
</div>', '2013-08-29', '2013-05-13', 'en cours', 192, 'normale', 0, '2013-05-13', '2013-05-22') ; 
INSERT INTO `actions` VALUES (25, 5, 5, 25, 21, 'Corrections bloquantes SAILL', 0, 'En attente des retours utilisateurs demande traités au fur et à mesure', '2013-06-27', '2013-05-13', 'en cours', 0, 'haute', 0, '2013-05-13', '2013-05-13') ; 
INSERT INTO `actions` VALUES (26, 5, 5, 4, 21, 'Création d\'un nouvel utilisateur', 100, '<a href="../../utilisateurs/edit/277">Lien vers le nouvel utilisateur</a>', '2013-05-18', '2013-05-13', 'terminée', 2, 'haute', 0, '2013-05-13', '2013-05-13') ; 
INSERT INTO `actions` VALUES (27, 5, 5, 4, 21, 'Création d\'une nouvelle demande d\'ouverture de droit', 100, '<a href="../../utiliseoutils/edit/111">Lien vers la nouvelle demande d\'ouverture de droit</a>', '2013-05-18', '2013-05-13', 'terminée', 2, 'haute', 0, '2013-05-13', '2013-05-13') ; 
INSERT INTO `actions` VALUES (28, 5, 5, 4, 21, 'Création d\'une nouvelle demande d\'ouverture de droit', 100, '<a href="../../utiliseoutils/edit/112">Lien vers la nouvelle demande d\'ouverture de droit</a>', '2013-05-18', '2013-05-13', 'terminée', 2, 'haute', 0, '2013-05-13', '2013-05-13') ; 
INSERT INTO `actions` VALUES (29, 5, 5, 4, 21, 'Création d\'une nouvelle demande d\'ouverture de droit', 100, '<a href="../../utiliseoutils/edit/113">Lien vers la nouvelle demande d\'ouverture de droit</a>', '2013-05-18', '2013-05-13', 'terminée', 2, 'haute', 0, '2013-05-13', '2013-05-13') ; 
INSERT INTO `actions` VALUES (30, 5, 5, 4, 21, 'Création d\'une nouvelle demande d\'ouverture de droit', 100, '<a href="../../utiliseoutils/edit/114">Lien vers la nouvelle demande d\'ouverture de droit</a>', '2013-05-18', '2013-05-13', 'terminée', 2, 'haute', 0, '2013-05-13', '2013-05-13') ; 
INSERT INTO `actions` VALUES (31, 5, 5, 4, 21, 'Création d\'une nouvelle demande d\'ouverture de droit', 100, '<a href="../../utiliseoutils/edit/115">Lien vers la nouvelle demande d\'ouverture de droit</a>', '2013-05-18', '2013-05-13', 'terminée', 2, 'haute', 0, '2013-05-13', '2013-05-13') ; 
INSERT INTO `actions` VALUES (32, 5, 5, 4, 21, 'Création d\'une nouvelle demande d\'ouverture de droit', 100, '<a href="../../utiliseoutils/edit/116">Lien vers la nouvelle demande d\'ouverture de droit</a>', '2013-05-18', '2013-05-13', 'terminée', 2, 'haute', 0, '2013-05-13', '2013-05-13') ; 
INSERT INTO `actions` VALUES (33, 5, 5, 25, 21, 'Correction SAILL', 30, '<ul>
<li>Erreur de paramétrgae pour le profil Responsable équipe, ajouter autoupdate pour valider les feuille de temps</li>
</ul>', '2013-06-27', '2013-05-13', 'en cours', 2, 'moyenne', 0, '2013-05-13', '2013-05-22') ; 
INSERT INTO `actions` VALUES (34, 5, 5, 4, 21, 'Création d\'une nouvelle demande d\'ouverture de droit', 100, '<a href="../../utiliseoutils/edit/117">Lien vers la nouvelle demande d\'ouverture de droit</a>', '2013-05-19', '2013-05-14', 'terminée', 2, 'haute', 0, '2013-05-14', '2013-05-14') ; 
INSERT INTO `actions` VALUES (35, 5, 5, 4, 21, 'Création d\'une nouvelle demande d\'ouverture de droit', 100, '<a href="../../utiliseoutils/edit/118">Lien vers la nouvelle demande d\'ouverture de droit</a>', '2013-05-19', '2013-05-14', 'terminée', 2, 'haute', 0, '2013-05-14', '2013-05-14') ; 
INSERT INTO `actions` VALUES (36, 14, 14, 23, 28, 'DAT SGRM', 50, 'Mise à jour du DAT', '2013-05-31', '2013-05-13', 'en cours', 56, 'haute', 1, '2013-05-14', '2013-05-15') ; 
INSERT INTO `actions` VALUES (39, 5, 5, 25, 21, 'Evolution SAILL', 100, 'Ajouter un rapport : activité réelle par domaine, pour chaque agent (idem facturation)<br />Actions : mettre la durée en jour', '2005-06-04', '2013-05-14', 'terminée', 0, 'normale', 0, '2013-05-14', '2013-05-15') ; 
INSERT INTO `actions` VALUES (41, 5, 5, 25, 21, 'Evolution SAILL - ActivitéRéelle', 100, 'Ajouter le domaine dans la feuille de temps<br />Dans la rapport faire une répartition de l\'activité par Projet et domaine', '2005-06-04', '2013-05-15', 'terminée', 2, 'moyenne', 0, '2013-05-15', '2013-05-15') ; 
INSERT INTO `actions` VALUES (42, 14, 14, 19, 23, 'Assistance MCO ORCHESTRAL', 100, '', '2005-06-04', '2013-05-15', 'terminée', 4, 'normale', 1, '2013-05-15', '2013-05-15') ; 
INSERT INTO `actions` VALUES (43, 14, 14, 13, 14, 'Atelier ITACT', 100, 'Communication COHERENCE - ITACT à moindre coût', '2005-06-04', '2013-05-15', 'terminée', 2, 'normale', 1, '2013-05-15', '2013-05-15') ; 
INSERT INTO `actions` VALUES (44, 14, 14, 13, 14, 'Atelier architecture ferme WTX', 100, '', '2005-06-04', '2013-05-15', 'terminée', 2, 'normale', 1, '2013-05-15', '2013-05-15') ; 
INSERT INTO `actions` VALUES (45, 14, 14, 13, 14, 'DAT ORCHESTRAL', 30, 'Premières remarques transmises au GRPT le 15/05', '2013-05-31', '2013-05-15', 'en cours', 64, 'normale', 1, '2013-05-15', '2013-05-15') ; 
INSERT INTO `actions` VALUES (46, 14, 14, 13, 13, 'DAT COHERENCE', 30, '', '2013-05-31', '2013-05-15', 'en cours', 16, 'normale', 1, '2013-05-15', '2013-05-16') ; 
INSERT INTO `actions` VALUES (47, 5, 5, 25, 21, 'Saisie activité CRA Prestataires pour MAI', 100, 'Prendre en compte le fichier Excel des absences et le fichier du plan de charge<br />Consolidation envoyée à STERIA pour validation en attente du retour pour mercredi<br />Retour presque complet en attente complément information de la part de STERIA', '2013-05-22', '2013-05-20', 'terminée', 8, 'moyenne', 0, '2013-05-16', '2013-05-22') ; 
INSERT INTO `actions` VALUES (48, 5, 5, 25, 21, 'Saisie activité GALILEI agent SNCF pour MAI', 100, 'Reste Julien BRANCATA', '2013-05-22', '2013-05-20', 'terminée', 8, 'moyenne', 0, '2013-05-16', '2013-05-22') ; 
INSERT INTO `actions` VALUES (49, 14, 14, 9, 14, 'SFD socle ORCHESTRAL : pattern synchrone', 90, '', '2013-05-16', '2013-05-16', 'en cours', 8, 'haute', 1, '2013-05-16', '2013-05-16') ; 
INSERT INTO `actions` VALUES (50, 14, 14, 9, 14, 'SFD socle ORCHESTRAL : WS transco et enrichissement', 90, '', '2013-05-16', '2013-05-16', 'en cours', 8, 'haute', 1, '2013-05-16', '2013-05-16') ; 
INSERT INTO `actions` VALUES (51, 13, 13, 1, 34, '[ITACT] Définition du planning du lot 1.0', 100, '', '2013-05-17', '2013-05-17', 'livré', 4, 'haute', 0, '2013-05-17', '2013-05-17') ; 
INSERT INTO `actions` VALUES (52, 13, 13, 1, 34, '[ITACT] Revue de sprint 1.9', 0, '', '2013-05-27', '2013-05-27', 'à faire', 8, 'normale', 0, '2013-05-17', '2013-05-17') ; 
INSERT INTO `actions` VALUES (53, 13, 13, 1, 34, '[ITACT] COPROJ', 100, '', '2013-05-28', '2013-05-07', 'terminée', 4, 'normale', 0, '2013-05-17', '2013-05-17') ; 
INSERT INTO `actions` VALUES (54, 13, 13, 16, 13, '[Cohérence] Relecture SFD de RDD MR', 100, '', '2013-05-06', '2013-05-06', 'terminée', 8, 'normale', 0, '2013-05-17', '2013-05-17') ; 
INSERT INTO `actions` VALUES (55, 13, 13, 1, 34, '[ITACT] Coordination Charlevilles', 100, '', '2013-05-17', '2013-05-17', 'terminée', 0, 'normale', 0, '2013-05-17', '2013-05-17') ; 
INSERT INTO `actions` VALUES (56, 13, 13, 12, 38, '[Cohérence] recette J19.1', 100, '', '2013-05-17', '2013-05-17', 'terminée', 0, 'normale', 0, '2013-05-17', '2013-05-17') ; 
INSERT INTO `actions` VALUES (57, 13, 13, 8, 13, '[Cohérence] TF 310 - Atelier MOA/MOEG/SOGETI', 100, '', '2013-05-17', '2013-05-17', 'terminée', 0, 'normale', 0, '2013-05-17', '2013-05-17') ; 
INSERT INTO `actions` VALUES (58, 13, 13, 8, 13, '[Cohérence] Point de visibilité Réalisation 310', 0, '', '2013-05-28', '2013-05-17', 'à faire', 8, 'normale', 0, '2013-05-17', '2013-05-17') ; 
INSERT INTO `actions` VALUES (59, 6, 6, 17, 18, 'Suivi conception formation PANAM Programmeur', 0, '', '2013-05-17', '2013-05-17', 'en cours', 0, 'normale', 0, '2013-05-17', '2013-05-17') ; 
INSERT INTO `actions` VALUES (60, 6, 6, 17, 18, 'Suivi formation PANAM PLANIFICATEUR lot 303', 0, '', '2013-05-17', '2013-04-01', 'en cours', 0, 'normale', 0, '2013-05-17', '2013-05-17') ; 
INSERT INTO `actions` VALUES (61, 14, 14, 28, 14, 'DAT T-RES', 50, '', '2013-05-31', '2013-05-21', 'en cours', 16, 'moyenne', 1, '2013-05-21', '2013-05-21') ; 
INSERT INTO `actions` VALUES (62, 5, 5, 4, 21, 'Création d\'un nouvel utilisateur', 100, '<a href="../../utilisateurs/edit/278">Lien vers le nouvel utilisateur<br />D</a>emande envoyée  le 21/05/2013', '2013-05-22', '2013-05-21', 'terminée', 2, 'haute', 0, '2013-05-21', '2013-05-22') ; 
INSERT INTO `actions` VALUES (63, 5, 5, 4, 21, 'Création d\'une nouvelle demande d\'ouverture de droit : CALIBER', 100, '<a href="http://p64l03bib6q/SAILL/200/utiliseoutils/edit/119">Lien vers la nouvelle demande d\'ouverture de droit</a>', '2013-05-22', '2013-05-21', 'terminée', 2, 'haute', 0, '2013-05-21', '2013-05-22') ; 
INSERT INTO `actions` VALUES (64, 5, 5, 4, 21, 'Création d\'une nouvelle demande d\'ouverture de droit : QUALITY CENTER', 100, '<a href="http://p64l03bib6q/SAILL/200/utiliseoutils/edit/120">Lien vers la nouvelle demande d\'ouverture de droit</a>', '2013-05-22', '2013-05-21', 'terminée', 2, 'haute', 0, '2013-05-21', '2013-05-22') ; 
INSERT INTO `actions` VALUES (65, 5, 5, 4, 21, 'Création d\'une nouvelle demande d\'ouverture de droit : SVN', 100, '<a href="http://p64l03bib6q/SAILL/200/utiliseoutils/edit/121">Lien vers la nouvelle demande d\'ouverture de droit</a>', '2013-05-22', '2013-05-21', 'terminée', 2, 'haute', 0, '2013-05-21', '2013-05-22') ; 
INSERT INTO `actions` VALUES (66, 5, 5, 4, 21, 'Création d\'une nouvelle demande d\'ouverture de droit : ARIANE', 100, '<a href="http://p64l03bib6q/SAILL/200/utiliseoutils/edit/122">Lien vers la nouvelle demande d\'ouverture de droit</a>', '2013-05-22', '2013-05-21', 'terminée', 2, 'haute', 0, '2013-05-21', '2013-05-22') ; 
INSERT INTO `actions` VALUES (67, 5, 5, 4, 21, 'Création d\'une nouvelle demande d\'ouverture de droit : PORTAIL ENV.', 100, '<a href="http://p64l03bib6q/SAILL/200/utiliseoutils/edit/123">Lien vers la nouvelle demande d\'ouverture de droit</a>', '2013-05-22', '2013-05-21', 'terminée', 2, 'haute', 0, '2013-05-21', '2013-05-22') ; 
INSERT INTO `actions` VALUES (68, 5, 5, 4, 21, 'Création d\'une nouvelle demande d\'ouverture de droit : *OSMOSE Intégrateur Chefs de Projet', 100, '<a href="http://p64l03bib6q/SAILL/200/utiliseoutils/edit/124">Lien vers la nouvelle demande d\'ouverture de droit</a>', '2013-05-22', '2013-05-21', 'terminée', 2, 'haute', 0, '2013-05-21', '2013-05-22') ; 
INSERT INTO `actions` VALUES (69, 5, 5, 4, 21, 'Création d\'une nouvelle demande d\'ouverture de droit : OSMOSE-MOA-MOE', 100, '<a href="http://p64l03bib6q/SAILL/200/utiliseoutils/edit/125">Lien vers la nouvelle demande d\'ouverture de droit</a>', '2013-05-22', '2013-05-21', 'terminée', 2, 'haute', 0, '2013-05-21', '2013-05-22') ; 
INSERT INTO `actions` VALUES (70, 5, 5, 4, 21, 'Création d\'une nouvelle demande d\'ouverture de droit : MOA', 100, '<a href="http://p64l03bib6q/SAILL/200/utiliseoutils/edit/126">Lien vers la nouvelle demande d\'ouverture de droit</a>', '2013-05-22', '2013-05-21', 'terminée', 2, 'haute', 0, '2013-05-21', '2013-05-22') ; 
INSERT INTO `actions` VALUES (71, 5, 5, 4, 21, 'Création d\'un nouvel utilisateur', 100, '<a href="http://p64l03bib6q/SAILL/200/utilisateurs/edit/279">Lien vers le nouvel utilisateur</a>', '2013-05-22', '2013-05-21', 'terminée', 2, 'haute', 0, '2013-05-21', '2013-05-22') ; 
INSERT INTO `actions` VALUES (72, 5, 5, 4, 21, 'Création d\'une nouvelle demande d\'ouverture de droit : CALIBER', 100, '<a href="http://p64l03bib6q/SAILL/200/utiliseoutils/edit/127">Lien vers la nouvelle demande d\'ouverture de droit</a>', '2013-05-22', '2013-05-21', 'terminée', 2, 'haute', 0, '2013-05-21', '2013-05-22') ; 
INSERT INTO `actions` VALUES (73, 5, 5, 4, 21, 'Création d\'une nouvelle demande d\'ouverture de droit : QUALITY CENTER', 100, '<a href="http://p64l03bib6q/SAILL/200/utiliseoutils/edit/128">Lien vers la nouvelle demande d\'ouverture de droit</a>', '2013-05-22', '2013-05-21', 'terminée', 2, 'haute', 0, '2013-05-21', '2013-05-22') ; 
INSERT INTO `actions` VALUES (74, 5, 5, 4, 21, 'Création d\'une nouvelle demande d\'ouverture de droit : ARIANE', 100, '<a href="http://p64l03bib6q/SAILL/200/utiliseoutils/edit/129">Lien vers la nouvelle demande d\'ouverture de droit</a>', '2013-05-22', '2013-05-21', 'terminée', 2, 'haute', 0, '2013-05-21', '2013-05-22') ; 
INSERT INTO `actions` VALUES (75, 5, 5, 4, 21, 'Création d\'une nouvelle demande d\'ouverture de droit : PORTAIL ENV.', 100, '<a href="http://p64l03bib6q/SAILL/200/utiliseoutils/edit/130">Lien vers la nouvelle demande d\'ouverture de droit</a>', '2013-05-22', '2013-05-21', 'terminée', 2, 'haute', 0, '2013-05-21', '2013-05-22') ; 
INSERT INTO `actions` VALUES (76, 5, 5, 4, 21, 'Création d\'une nouvelle demande d\'ouverture de droit : *OSMOSE Intégrateur PMO', 100, '<a href="http://p64l03bib6q/SAILL/200/utiliseoutils/edit/131">Lien vers la nouvelle demande d\'ouverture de droit</a>', '2013-05-22', '2013-05-21', 'terminée', 2, 'haute', 0, '2013-05-21', '2013-05-22') ; 
INSERT INTO `actions` VALUES (77, 5, 5, 4, 21, 'Création d\'une nouvelle demande d\'ouverture de droit : OSMOSE-MOA-MOE', 100, '<a href="http://p64l03bib6q/SAILL/200/utiliseoutils/edit/132">Lien vers la nouvelle demande d\'ouverture de droit</a>', '2013-05-22', '2013-05-21', 'terminée', 2, 'haute', 0, '2013-05-21', '2013-05-22') ; 
INSERT INTO `actions` VALUES (78, 5, 5, 4, 21, 'Création d\'une nouvelle demande d\'ouverture de droit : MOA', 100, '<a href="http://p64l03bib6q/SAILL/200/utiliseoutils/edit/133">Lien vers la nouvelle demande d\'ouverture de droit</a>', '2013-05-22', '2013-05-21', 'terminée', 2, 'haute', 0, '2013-05-21', '2013-05-22') ;
#
# End of data contents of table actions
# --------------------------------------------------------

# WordPress : buffernow.com MySQL database backup
#
# Generated: Thursday 23. May 2013 19:38 CEST
# Hostname: localhost
# Database: `saill_200`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `achats`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `actions`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `actionslivrables`
# --------------------------------------------------------


#
# Delete any existing table `actionslivrables`
#

DROP TABLE IF EXISTS `actionslivrables`;


#
# Table structure of table `actionslivrables`
#

CREATE TABLE `actionslivrables` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `action_id` int(15) NOT NULL,
  `livrable_id` int(15) NOT NULL,
  `created` date NOT NULL,
  `modified` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ;

#
# Data contents of table actionslivrables (0 records)
#

#
# End of data contents of table actionslivrables
# --------------------------------------------------------

# WordPress : buffernow.com MySQL database backup
#
# Generated: Thursday 23. May 2013 19:38 CEST
# Hostname: localhost
# Database: `saill_200`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `achats`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `actions`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `actionslivrables`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `activites`
# --------------------------------------------------------


#
# Delete any existing table `activites`
#

DROP TABLE IF EXISTS `activites`;


#
# Table structure of table `activites`
#

CREATE TABLE `activites` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `projet_id` int(15) NOT NULL,
  `NOM` varchar(255) CHARACTER SET latin1 NOT NULL,
  `DATEDEBUT` date DEFAULT NULL,
  `DATEFIN` date DEFAULT NULL,
  `NUMEROGALLILIE` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `DESCRIPTION` longtext CHARACTER SET latin1,
  `BUDJETRA` decimal(25,2) DEFAULT NULL,
  `BUDGETREVU` decimal(25,2) DEFAULT NULL,
  `ACTIVE` tinyint(1) NOT NULL DEFAULT '0',
  `DELETABLE` tinyint(1) NOT NULL DEFAULT '1',
  `created` date NOT NULL,
  `modified` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8 ;

#
# Data contents of table activites (40 records)
#
 
INSERT INTO `activites` VALUES (1, 1, 'C', NULL, NULL, NULL, 'Congés protocolaires', NULL, NULL, 1, 0, '2013-02-01', '2013-02-01') ; 
INSERT INTO `activites` VALUES (2, 1, 'RQ', NULL, NULL, NULL, 'Journée 35h', NULL, NULL, 1, 0, '2013-02-01', '2013-02-01') ; 
INSERT INTO `activites` VALUES (3, 1, 'VT', NULL, NULL, NULL, 'Temps partiel', NULL, NULL, 1, 0, '2013-02-01', '2013-02-01') ; 
INSERT INTO `activites` VALUES (4, 1, 'SE', NULL, NULL, NULL, 'Soin enfant ou conjoint', NULL, NULL, 1, 0, '2013-02-01', '2013-02-01') ; 
INSERT INTO `activites` VALUES (5, 1, 'Mal', NULL, NULL, NULL, 'Maladie', NULL, NULL, 1, 0, '2013-02-01', '2013-02-01') ; 
INSERT INTO `activites` VALUES (6, 1, 'CS', NULL, NULL, NULL, 'Congés supplémentaire', NULL, NULL, 1, 0, '2013-02-01', '2013-02-01') ; 
INSERT INTO `activites` VALUES (7, 1, 'DA', NULL, NULL, NULL, '1h de grève', NULL, NULL, 1, 0, '2013-02-01', '2013-02-01') ; 
INSERT INTO `activites` VALUES (8, 1, 'DB', NULL, NULL, NULL, '4h de grève', NULL, NULL, 1, 0, '2013-02-01', '2013-02-01') ; 
INSERT INTO `activites` VALUES (9, 1, 'DC', NULL, NULL, NULL, '8h de grève', NULL, NULL, 1, 0, '2013-02-01', '2013-02-01') ; 
INSERT INTO `activites` VALUES (10, 1, 'DD', NULL, NULL, NULL, 'Journée de délégation', NULL, NULL, 1, 0, '2013-02-01', '2013-02-01') ; 
INSERT INTO `activites` VALUES (11, 1, 'DR', NULL, NULL, NULL, 'Journée de délégation', NULL, NULL, 1, 0, '2013-02-01', '2013-02-01') ; 
INSERT INTO `activites` VALUES (12, 1, 'ILD', NULL, NULL, NULL, 'Longue maladie', NULL, NULL, 1, 0, '2013-02-01', '2013-02-01') ; 
INSERT INTO `activites` VALUES (13, 16, 'EVO COHERENCE', '2013-01-01', '2016-12-31', '000001', 'Projet EVO M EMM COHERENCE', '27.00', '27.00', 1, 1, '2013-02-01', '2013-05-13') ; 
INSERT INTO `activites` VALUES (14, 17, 'EVO ORCHESTRAL', '2013-01-01', '2016-12-31', '000001', 'Projet EVO M EMM ORCHESTRAL', '222.00', '222.00', 1, 1, '2013-02-01', '2013-05-13') ; 
INSERT INTO `activites` VALUES (15, 2, 'Développement PUMA', '2011-01-01', '2016-12-31', '000015', 'Projet DEV M OSMOSE', '612.00', '612.00', 1, 1, '2013-02-01', '2013-05-13') ; 
INSERT INTO `activites` VALUES (16, 4, 'OSMOSE MCO', '2010-01-01', '2016-12-31', '000001', 'Projet M EMM OMM OSMOSE', '664.00', '664.00', 1, 1, '2013-02-01', '2013-05-13') ; 
INSERT INTO `activites` VALUES (17, 2, 'Pilotage Projet', '2011-01-01', '2016-12-31', '000000000000006', 'Projet DEV M OSMOSE', '181.00', '181.00', 1, 1, '2013-02-01', '2013-05-13') ; 
INSERT INTO `activites` VALUES (18, 2, 'Ingénierie formation', '2011-01-01', '2016-12-31', '000013', 'Projet DEV M OSMOSE', NULL, NULL, 1, 1, '2013-02-01', '2013-03-27') ; 
INSERT INTO `activites` VALUES (19, 2, 'Pilotage PROGRAMME', '2011-01-01', '2016-12-31', '000012', 'Projet DEV M OSMOSE', '97.00', '97.00', 1, 1, '2013-02-01', '2013-05-13') ; 
INSERT INTO `activites` VALUES (20, 2, 'Si essieux', '2011-01-01', '2016-12-31', '000016', 'Projet DEV M OSMOSE', NULL, NULL, 1, 1, '2013-02-01', '2013-03-27') ; 
INSERT INTO `activites` VALUES (21, 2, 'OSMOSE 310 MR', '2011-01-01', '2016-12-31', '000017', NULL, '957.00', '957.00', 1, 1, '2013-02-01', '2013-05-13') ; 
INSERT INTO `activites` VALUES (22, 2, 'ORGANES 310', '2011-01-01', '2016-12-31', '000018', 'Projet DEV M OSMOSE', '961.00', '961.00', 1, 1, '2013-02-01', '2013-05-13') ; 
INSERT INTO `activites` VALUES (23, 9, 'MCO ORCHESTRAL', '2011-01-01', '2016-12-31', '000001', 'Projet MCO M ORCHESTRAL', '289.00', '289.00', 1, 1, '2013-02-01', '2013-05-13') ; 
INSERT INTO `activites` VALUES (24, 3, 'Réalisation Lot 2', '2011-01-01', '2014-12-31', '000005', 'Projet DEV M PANAM', '557.00', '557.00', 1, 1, '2013-02-01', '2013-05-13') ; 
INSERT INTO `activites` VALUES (25, 3, 'Pilotage programme', '2011-01-01', '2014-12-31', '000006', 'Projet DEV M PANAM', NULL, NULL, 1, 1, '2013-02-01', '2013-03-27') ; 
INSERT INTO `activites` VALUES (26, 3, 'Architecture Lot 1', '2011-01-01', '2014-12-31', '000007', 'Projet DEV M PANAM', NULL, NULL, 1, 1, '2013-02-01', '2013-03-27') ; 
INSERT INTO `activites` VALUES (27, 5, 'Maintenance courante', '2011-01-01', '2014-12-31', '000001', 'Projet MCO PANAM', '249.00', '249.00', 1, 1, '2013-02-01', '2013-05-13') ; 
INSERT INTO `activites` VALUES (28, 14, 'Réalisation', '2011-01-01', '2016-12-31', '000001', 'Projet DEV M OSMOSE SGRM', '121.00', '121.00', 1, 1, '2013-02-01', '2013-05-13') ; 
INSERT INTO `activites` VALUES (29, 14, 'Pilotage de projet', '2011-01-01', '2016-12-31', '000002', 'Projet DEV M OSMOSE SGRM', NULL, NULL, 1, 1, '2013-02-01', '2013-03-27') ; 
INSERT INTO `activites` VALUES (30, 15, 'MCO OSMOSE SGRM', '2011-01-01', '2016-12-31', '000001', 'Projet MCO M OSMOSE SGRM', '35.00', '35.00', 1, 1, '2013-02-01', '2013-05-13') ; 
INSERT INTO `activites` VALUES (31, 18, 'Pilotage de projet', '2011-01-01', '2016-12-31', '000001', 'Projet PEV M BAUME DBC', NULL, NULL, 1, 1, '2013-02-01', '2013-03-27') ; 
INSERT INTO `activites` VALUES (32, 19, 'Maintenance courante', '2011-01-01', '2016-12-31', '000001', 'Projet BAUME DBC - MCO', NULL, NULL, 1, 1, '2013-02-01', '2013-03-27') ; 
INSERT INTO `activites` VALUES (33, 20, 'Maintenance courante', '2011-01-01', '2016-12-31', '000000000000001', 'Projet MCO M APPLICATION EMC2', NULL, NULL, 1, 1, '2013-02-01', '2013-03-27') ; 
INSERT INTO `activites` VALUES (34, 22, 'Réalisation', '2011-01-01', '2016-12-31', '000001', 'Projet DEV M ITAC', NULL, NULL, 1, 1, '2013-02-01', '2013-03-27') ; 
INSERT INTO `activites` VALUES (35, 21, 'Support Client', '2011-01-01', '2016-12-31', '000000000000001', 'Projet ASS M URBANISME', NULL, NULL, 1, 1, '2013-02-01', '2013-03-26') ; 
INSERT INTO `activites` VALUES (36, 2, 'Déformation SI', '2011-01-01', '2016-12-31', '000014', 'Projet DEV M OSMOSE', '138.00', '138.00', 1, 1, '2013-02-01', '2013-05-13') ; 
INSERT INTO `activites` VALUES (37, 1, 'Stages/Formations', NULL, NULL, NULL, 'Formation ou stages suivis', NULL, NULL, 1, 0, '2013-02-01', '2013-02-01') ; 
INSERT INTO `activites` VALUES (38, 7, 'Maintenance courante', NULL, NULL, '000001', 'Projet MCO M COHERENCE', '168.00', '168.00', 1, 1, '2013-03-26', '2013-05-13') ; 
INSERT INTO `activites` VALUES (39, 23, 'Stage entreprise', NULL, NULL, '', 'Projet pour stage en entreprise', '0.00', '0.00', 1, 0, '2013-03-26', '2013-03-27') ; 
INSERT INTO `activites` VALUES (40, 24, 'Frais DSI-T/SO', '2011-01-01', NULL, '', 'Frais pour le compte de DSI-T/SO', NULL, NULL, 1, 0, '2013-03-27', '2013-03-27') ;
#
# End of data contents of table activites
# --------------------------------------------------------

# WordPress : buffernow.com MySQL database backup
#
# Generated: Thursday 23. May 2013 19:38 CEST
# Hostname: localhost
# Database: `saill_200`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `achats`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `actions`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `actionslivrables`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `activites`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `activitesreelles`
# --------------------------------------------------------


#
# Delete any existing table `activitesreelles`
#

DROP TABLE IF EXISTS `activitesreelles`;


#
# Table structure of table `activitesreelles`
#

CREATE TABLE `activitesreelles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `utilisateur_id` int(15) NOT NULL,
  `action_id` int(15) DEFAULT NULL,
  `facturation_id` int(11) DEFAULT NULL,
  `activite_id` int(15) NOT NULL,
  `domaine_id` int(15) DEFAULT NULL,
  `DATE` date NOT NULL,
  `LU` decimal(2,1) NOT NULL DEFAULT '0.0',
  `LU_TYPE` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=>matin\n0=>après midi',
  `MA` decimal(2,1) NOT NULL DEFAULT '0.0',
  `MA_TYPE` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=>matin\n0=>après midi',
  `ME` decimal(2,1) NOT NULL DEFAULT '0.0',
  `ME_TYPE` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=>matin\n0=>après midi',
  `JE` decimal(2,1) NOT NULL DEFAULT '0.0',
  `JE_TYPE` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=>matin\n0=>après midi',
  `VE` decimal(2,1) NOT NULL DEFAULT '0.0',
  `VE_TYPE` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=>matin\n0=>après midi',
  `SA` decimal(2,1) NOT NULL DEFAULT '0.0',
  `SA_TYPE` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=>matin\n0=>après midi',
  `DI` decimal(2,1) NOT NULL DEFAULT '0.0',
  `DI_TYPE` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=>matin\n0=>après midi',
  `TOTAL` decimal(2,1) NOT NULL DEFAULT '0.0',
  `VEROUILLE` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0=>verrouille\n1=>actif',
  `created` date NOT NULL,
  `modified` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=541 DEFAULT CHARSET=utf8 ;

#
# Data contents of table activitesreelles (523 records)
#
 
INSERT INTO `activitesreelles` VALUES (1, 5, NULL, 1, 3, NULL, '2013-03-25', '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '1.0', 0, '2013-03-25', '2013-04-08') ; 
INSERT INTO `activitesreelles` VALUES (2, 5, NULL, NULL, 3, NULL, '2013-02-25', '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '2013-03-25', '2013-03-25') ; 
INSERT INTO `activitesreelles` VALUES (3, 5, NULL, 7, 3, NULL, '2013-03-04', '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '1.0', 0, '2013-03-25', '2013-04-08') ; 
INSERT INTO `activitesreelles` VALUES (4, 5, NULL, 5, 3, NULL, '2013-03-11', '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '1.0', 0, '2013-03-25', '2013-04-08') ; 
INSERT INTO `activitesreelles` VALUES (5, 5, NULL, 3, 3, NULL, '2013-03-18', '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '1.0', 0, '2013-03-25', '2013-04-08') ; 
INSERT INTO `activitesreelles` VALUES (6, 5, NULL, 13, 3, NULL, '2013-04-01', '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '1.0', 0, '2013-03-25', '2013-04-11') ; 
INSERT INTO `activitesreelles` VALUES (7, 5, NULL, 15, 3, NULL, '2013-04-08', '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '1.0', 0, '2013-03-25', '2013-04-11') ; 
INSERT INTO `activitesreelles` VALUES (8, 5, NULL, 17, 3, NULL, '2013-04-15', '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '1.0', 0, '2013-03-25', '2013-04-11') ; 
INSERT INTO `activitesreelles` VALUES (9, 5, NULL, 19, 3, NULL, '2013-04-22', '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '1.0', 0, '2013-03-25', '2013-04-11') ; 
INSERT INTO `activitesreelles` VALUES (10, 5, NULL, 21, 3, NULL, '2013-04-29', '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '1.0', 0, '2013-03-25', '2013-04-11') ; 
INSERT INTO `activitesreelles` VALUES (11, 5, NULL, 22, 1, NULL, '2013-04-29', '1.0', 1, '1.0', 1, '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '3.0', 0, '2013-03-25', '2013-04-11') ; 
INSERT INTO `activitesreelles` VALUES (12, 5, NULL, 302, 1, NULL, '2013-05-06', '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '2.0', 0, '2013-03-25', '2013-05-13') ; 
INSERT INTO `activitesreelles` VALUES (13, 5, NULL, 304, 3, NULL, '2013-05-06', '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '1.0', 0, '2013-03-25', '2013-05-13') ; 
INSERT INTO `activitesreelles` VALUES (15, 5, NULL, 314, 3, NULL, '2013-05-13', '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '1.0', 0, '2013-03-25', '2013-05-16') ; 
INSERT INTO `activitesreelles` VALUES (16, 5, NULL, 318, 3, NULL, '2013-05-20', '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '1.0', 0, '2013-03-25', '2013-05-16') ; 
INSERT INTO `activitesreelles` VALUES (17, 5, NULL, 322, 3, NULL, '2013-05-27', '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '1.0', 0, '2013-03-25', '2013-05-16') ; 
INSERT INTO `activitesreelles` VALUES (18, 5, NULL, 2, 21, NULL, '2013-03-25', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '4.0', 0, '2013-03-26', '2013-04-08') ; 
INSERT INTO `activitesreelles` VALUES (19, 5, NULL, 8, 21, NULL, '2013-03-04', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '4.0', 0, '2013-03-27', '2013-04-08') ; 
INSERT INTO `activitesreelles` VALUES (20, 5, NULL, 6, 21, NULL, '2013-03-11', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '4.0', 0, '2013-03-27', '2013-04-08') ; 
INSERT INTO `activitesreelles` VALUES (21, 5, NULL, 4, 21, NULL, '2013-03-18', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '4.0', 0, '2013-03-27', '2013-04-08') ; 
INSERT INTO `activitesreelles` VALUES (22, 265, NULL, 126, 1, NULL, '2013-04-01', '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '1.0', 0, '2013-03-27', '2013-04-15') ; 
INSERT INTO `activitesreelles` VALUES (23, 265, NULL, 123, 1, NULL, '2013-04-08', '0.0', 1, '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 0, '2013-03-27', '2013-04-15') ; 
INSERT INTO `activitesreelles` VALUES (24, 5, NULL, 14, 21, NULL, '2013-04-01', '0.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '3.0', 0, '2013-03-27', '2013-04-11') ; 
INSERT INTO `activitesreelles` VALUES (25, 265, NULL, 122, 1, NULL, '2013-04-15', '0.0', 1, '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 0, '2013-03-27', '2013-04-15') ; 
INSERT INTO `activitesreelles` VALUES (26, 4, NULL, 225, 1, NULL, '2013-03-25', '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '2.0', 0, '2013-03-28', '2013-04-22') ; 
INSERT INTO `activitesreelles` VALUES (27, 4, NULL, 224, 1, NULL, '2013-04-01', '0.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '2.0', 0, '2013-03-28', '2013-04-22') ; 
INSERT INTO `activitesreelles` VALUES (28, 9, NULL, 47, 2, NULL, '2013-04-01', '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 0, '2013-04-02', '2013-04-11') ; 
INSERT INTO `activitesreelles` VALUES (29, 9, NULL, 52, 1, NULL, '2013-04-22', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '5.0', 0, '2013-04-02', '2013-04-11') ; 
INSERT INTO `activitesreelles` VALUES (30, 6, NULL, 39, 3, NULL, '2013-04-29', '1.0', 1, '1.0', 1, '0.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '4.0', 0, '2013-04-02', '2013-04-11') ; 
INSERT INTO `activitesreelles` VALUES (31, 10, NULL, 59, 1, NULL, '2013-04-22', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '5.0', 0, '2013-04-02', '2013-04-11') ; 
INSERT INTO `activitesreelles` VALUES (32, 10, NULL, 60, 1, NULL, '2013-04-29', '1.0', 1, '1.0', 1, '0.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '4.0', 0, '2013-04-02', '2013-04-11') ; 
INSERT INTO `activitesreelles` VALUES (33, 3, NULL, NULL, 1, NULL, '2013-04-22', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '5.0', 1, '2013-04-02', '2013-04-02') ; 
INSERT INTO `activitesreelles` VALUES (34, 11, NULL, 435, 1, NULL, '2013-04-29', '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '2.0', 0, '2013-04-02', '2013-05-21') ; 
INSERT INTO `activitesreelles` VALUES (35, 13, NULL, 158, 3, NULL, '2013-04-01', '0.0', 1, '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 0, '2013-04-02', '2013-04-16') ; 
INSERT INTO `activitesreelles` VALUES (36, 13, NULL, 160, 3, NULL, '2013-04-08', '0.0', 1, '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 0, '2013-04-02', '2013-04-16') ; 
INSERT INTO `activitesreelles` VALUES (37, 13, NULL, 163, 3, NULL, '2013-04-15', '0.0', 1, '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 0, '2013-04-02', '2013-04-16') ; 
INSERT INTO `activitesreelles` VALUES (38, 13, NULL, 166, 3, NULL, '2013-04-22', '0.0', 1, '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 0, '2013-04-02', '2013-04-16') ; 
INSERT INTO `activitesreelles` VALUES (39, 13, NULL, 168, 3, NULL, '2013-04-29', '1.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 0, '2013-04-02', '2013-04-16') ; 
INSERT INTO `activitesreelles` VALUES (40, 13, NULL, 167, 1, NULL, '2013-04-22', '1.0', 1, '1.0', 1, '0.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '4.0', 0, '2013-04-02', '2013-04-16') ; 
INSERT INTO `activitesreelles` VALUES (41, 16, NULL, 156, 1, NULL, '2013-04-22', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '5.0', 0, '2013-04-02', '2013-04-16') ; 
INSERT INTO `activitesreelles` VALUES (43, 22, NULL, 491, 1, NULL, '2013-04-29', '1.0', 1, '1.0', 1, '0.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '4.0', 0, '2013-04-02', '2013-05-21') ; 
INSERT INTO `activitesreelles` VALUES (44, 8, NULL, 23, 2, NULL, '2013-04-01', '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 0, '2013-04-02', '2013-04-11') ; 
INSERT INTO `activitesreelles` VALUES (45, 8, NULL, 24, 3, NULL, '2013-04-01', '0.0', 1, '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 0, '2013-04-02', '2013-04-11') ; 
INSERT INTO `activitesreelles` VALUES (46, 7, NULL, 190, 3, NULL, '2013-04-01', '0.0', 1, '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 0, '2013-04-02', '2013-04-16') ; 
INSERT INTO `activitesreelles` VALUES (47, 7, NULL, 192, 3, NULL, '2013-04-08', '0.0', 1, '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 0, '2013-04-02', '2013-04-16') ; 
INSERT INTO `activitesreelles` VALUES (48, 7, NULL, 195, 3, NULL, '2013-04-15', '0.0', 1, '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 0, '2013-04-02', '2013-04-16') ; 
INSERT INTO `activitesreelles` VALUES (49, 40, NULL, 89, 1, NULL, '2013-04-01', '0.0', 1, '0.5', 0, '0.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '2.5', 0, '2013-04-02', '2013-04-15') ; 
INSERT INTO `activitesreelles` VALUES (50, 18, NULL, 67, 1, NULL, '2013-04-22', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '5.0', 0, '2013-04-02', '2013-04-15') ; 
INSERT INTO `activitesreelles` VALUES (51, 18, NULL, 66, 1, NULL, '2013-04-29', '1.0', 1, '1.0', 1, '0.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '4.0', 0, '2013-04-02', '2013-04-15') ; 
INSERT INTO `activitesreelles` VALUES (52, 38, NULL, 77, 1, NULL, '2013-04-22', '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '2.0', 0, '2013-04-02', '2013-04-15') ; 
INSERT INTO `activitesreelles` VALUES (53, 172, NULL, 104, 1, NULL, '2013-04-01', '0.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '4.0', 0, '2013-04-02', '2013-04-15') ; 
INSERT INTO `activitesreelles` VALUES (54, 172, NULL, 103, 1, NULL, '2013-04-08', '1.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 0, '2013-04-02', '2013-04-15') ; 
INSERT INTO `activitesreelles` VALUES (55, 172, NULL, 100, 1, NULL, '2013-04-15', '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '2.0', 0, '2013-04-02', '2013-04-15') ; 
INSERT INTO `activitesreelles` VALUES (56, 172, NULL, 98, 1, NULL, '2013-04-22', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '4.0', 0, '2013-04-02', '2013-04-15') ; 
INSERT INTO `activitesreelles` VALUES (57, 171, NULL, 91, 1, NULL, '2013-04-29', '1.0', 1, '1.0', 1, '0.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '4.0', 0, '2013-04-02', '2013-04-15') ; 
INSERT INTO `activitesreelles` VALUES (58, 176, NULL, 106, 1, NULL, '2013-04-29', '1.0', 1, '1.0', 1, '0.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '4.0', 0, '2013-04-02', '2013-04-15') ; 
INSERT INTO `activitesreelles` VALUES (59, 176, NULL, 301, 1, NULL, '2013-05-06', '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '3.0', 0, '2013-04-02', '2013-05-16') ; 
INSERT INTO `activitesreelles` VALUES (60, 33, NULL, 138, 1, NULL, '2013-04-08', '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 0, '2013-04-02', '2013-04-15') ; 
INSERT INTO `activitesreelles` VALUES (61, 230, NULL, 43, 2, NULL, '2013-04-22', '1.0', 1, '1.0', 1, '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '3.0', 0, '2013-04-02', '2013-04-11') ; 
INSERT INTO `activitesreelles` VALUES (62, 230, NULL, 44, 1, NULL, '2013-04-22', '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '1.0', 0, '2013-04-02', '2013-04-11') ; 
INSERT INTO `activitesreelles` VALUES (63, 9, NULL, NULL, 37, NULL, '2013-05-27', '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '2.0', 0, '2013-04-03', '2013-05-21') ; 
INSERT INTO `activitesreelles` VALUES (64, 6, NULL, 331, 3, NULL, '2013-05-06', '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '3.0', 0, '2013-04-03', '2013-05-21') ; 
INSERT INTO `activitesreelles` VALUES (65, 3, NULL, 512, 1, NULL, '2013-04-29', '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '2.0', 0, '2013-04-03', '2013-05-21') ; 
INSERT INTO `activitesreelles` VALUES (66, 3, NULL, 511, 2, NULL, '2013-05-06', '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '2.0', 0, '2013-04-03', '2013-05-21') ; 
INSERT INTO `activitesreelles` VALUES (67, 255, NULL, 425, 2, NULL, '2013-05-06', '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '1.0', 0, '2013-04-03', '2013-05-21') ; 
INSERT INTO `activitesreelles` VALUES (68, 13, NULL, 372, 3, NULL, '2013-05-06', '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '1.0', 0, '2013-04-03', '2013-05-21') ; 
INSERT INTO `activitesreelles` VALUES (69, 13, NULL, 378, 34, 1, '2013-05-13', '1.0', 1, '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '2.0', 0, '2013-04-03', '2013-05-21') ; 
INSERT INTO `activitesreelles` VALUES (70, 13, NULL, 384, 3, NULL, '2013-05-20', '0.0', 1, '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 0, '2013-04-03', '2013-05-21') ; 
INSERT INTO `activitesreelles` VALUES (71, 13, NULL, 390, 3, NULL, '2013-05-27', '0.0', 1, '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 0, '2013-04-03', '2013-05-21') ; 
INSERT INTO `activitesreelles` VALUES (72, 7, NULL, 200, 3, NULL, '2013-04-29', '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '1.0', 0, '2013-04-03', '2013-04-16') ; 
INSERT INTO `activitesreelles` VALUES (73, 7, NULL, 348, 3, NULL, '2013-05-06', '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '1.0', 0, '2013-04-03', '2013-05-21') ; 
INSERT INTO `activitesreelles` VALUES (74, 7, NULL, 352, 3, NULL, '2013-05-13', '0.0', 1, '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 0, '2013-04-03', '2013-05-21') ; 
INSERT INTO `activitesreelles` VALUES (75, 7, NULL, 360, 3, NULL, '2013-05-20', '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '1.0', 0, '2013-04-03', '2013-05-21') ; 
INSERT INTO `activitesreelles` VALUES (76, 7, NULL, 364, 3, NULL, '2013-05-27', '0.0', 1, '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 0, '2013-04-03', '2013-05-21') ; 
INSERT INTO `activitesreelles` VALUES (77, 40, NULL, 296, 1, NULL, '2013-05-06', '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '3.0', 0, '2013-04-03', '2013-05-16') ; 
INSERT INTO `activitesreelles` VALUES (78, 17, NULL, 230, 1, NULL, '2013-05-13', '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '1.0', 0, '2013-04-03', '2013-05-16') ; 
INSERT INTO `activitesreelles` VALUES (79, 38, NULL, 285, 1, NULL, '2013-05-06', '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '1.0', 0, '2013-04-03', '2013-05-16') ; 
INSERT INTO `activitesreelles` VALUES (80, 140, NULL, 140, 1, NULL, '2013-04-29', '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '2.0', 0, '2013-04-03', '2013-04-15') ; 
INSERT INTO `activitesreelles` VALUES (81, 140, NULL, 246, 1, NULL, '2013-05-06', '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '3.0', 0, '2013-04-03', '2013-05-16') ; 
INSERT INTO `activitesreelles` VALUES (82, 172, NULL, 269, 1, NULL, '2013-05-06', '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '1.0', 0, '2013-04-03', '2013-05-16') ; 
INSERT INTO `activitesreelles` VALUES (83, 33, NULL, 133, 1, NULL, '2013-04-29', '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '2.0', 0, '2013-04-03', '2013-04-15') ; 
INSERT INTO `activitesreelles` VALUES (84, 33, NULL, 279, 1, NULL, '2013-05-06', '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '1.0', 0, '2013-04-03', '2013-05-16') ; 
INSERT INTO `activitesreelles` VALUES (85, 237, NULL, 114, 1, NULL, '2013-04-29', '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '2.0', 0, '2013-04-03', '2013-04-15') ; 
INSERT INTO `activitesreelles` VALUES (86, 230, NULL, 324, 1, NULL, '2013-05-06', '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '1.0', 0, '2013-04-03', '2013-05-17') ; 
INSERT INTO `activitesreelles` VALUES (87, 265, NULL, 236, 1, NULL, '2013-05-06', '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '1.0', 0, '2013-04-03', '2013-05-16') ; 
INSERT INTO `activitesreelles` VALUES (88, 5, NULL, NULL, 3, NULL, '2013-06-03', '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '2013-04-03', '2013-04-03') ; 
INSERT INTO `activitesreelles` VALUES (89, 5, NULL, NULL, 3, NULL, '2013-06-10', '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '2013-04-03', '2013-04-03') ; 
INSERT INTO `activitesreelles` VALUES (90, 5, NULL, NULL, 3, NULL, '2013-06-17', '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '2013-04-03', '2013-04-03') ; 
INSERT INTO `activitesreelles` VALUES (91, 5, NULL, NULL, 3, NULL, '2013-06-24', '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '2013-04-03', '2013-04-03') ; 
INSERT INTO `activitesreelles` VALUES (92, 5, NULL, NULL, 3, NULL, '2013-07-01', '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '2013-04-03', '2013-04-03') ; 
INSERT INTO `activitesreelles` VALUES (93, 5, NULL, NULL, 3, NULL, '2013-07-08', '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '2013-04-03', '2013-04-03') ; 
INSERT INTO `activitesreelles` VALUES (94, 5, NULL, NULL, 3, NULL, '2013-07-15', '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '2013-04-03', '2013-04-03') ; 
INSERT INTO `activitesreelles` VALUES (95, 5, NULL, NULL, 3, NULL, '2013-07-22', '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '2013-04-03', '2013-04-03') ; 
INSERT INTO `activitesreelles` VALUES (96, 5, NULL, NULL, 3, NULL, '2013-07-29', '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '2013-04-03', '2013-04-03') ; 
INSERT INTO `activitesreelles` VALUES (97, 255, NULL, NULL, 6, NULL, '2013-06-03', '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '2.0', 1, '2013-04-03', '2013-04-03') ; 
INSERT INTO `activitesreelles` VALUES (98, 255, NULL, NULL, 6, NULL, '2013-06-10', '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '2.0', 1, '2013-04-03', '2013-04-03') ; 
INSERT INTO `activitesreelles` VALUES (99, 11, NULL, NULL, 1, NULL, '2013-06-17', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '5.0', 1, '2013-04-03', '2013-04-03') ; 
INSERT INTO `activitesreelles` VALUES (100, 7, NULL, NULL, 3, NULL, '2013-06-03', '0.0', 1, '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '2013-04-03', '2013-04-03') ; 
INSERT INTO `activitesreelles` VALUES (101, 7, NULL, NULL, 3, NULL, '2013-06-10', '0.0', 1, '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '2013-04-03', '2013-04-03') ; 
INSERT INTO `activitesreelles` VALUES (102, 7, NULL, NULL, 3, NULL, '2013-06-17', '0.0', 1, '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '2013-04-03', '2013-04-03') ; 
INSERT INTO `activitesreelles` VALUES (103, 7, NULL, NULL, 3, NULL, '2013-06-24', '0.0', 1, '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '2013-04-03', '2013-04-03') ; 
INSERT INTO `activitesreelles` VALUES (104, 17, NULL, NULL, 1, NULL, '2013-06-03', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '5.0', 1, '2013-04-03', '2013-04-03') ; 
INSERT INTO `activitesreelles` VALUES (105, 17, NULL, NULL, 1, NULL, '2013-06-10', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '5.0', 1, '2013-04-03', '2013-04-03') ; 
INSERT INTO `activitesreelles` VALUES (106, 17, NULL, NULL, 1, NULL, '2013-06-17', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '5.0', 1, '2013-04-03', '2013-04-03') ; 
INSERT INTO `activitesreelles` VALUES (107, 38, NULL, NULL, 1, NULL, '2013-06-24', '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '2013-04-03', '2013-04-03') ; 
INSERT INTO `activitesreelles` VALUES (108, 140, NULL, NULL, 1, NULL, '2013-06-24', '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '2.0', 1, '2013-04-03', '2013-04-03') ; 
INSERT INTO `activitesreelles` VALUES (109, 5, NULL, NULL, 1, NULL, '2013-07-01', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '4.0', 1, '2013-04-04', '2013-04-04') ; 
INSERT INTO `activitesreelles` VALUES (110, 5, NULL, NULL, 1, NULL, '2013-07-08', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '4.0', 1, '2013-04-04', '2013-04-04') ; 
INSERT INTO `activitesreelles` VALUES (111, 5, NULL, NULL, 1, NULL, '2013-07-15', '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '3.0', 1, '2013-04-04', '2013-04-04') ; 
INSERT INTO `activitesreelles` VALUES (113, 255, NULL, 9, 24, NULL, '2013-03-04', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '0.0', 0, '2013-04-09', '2013-04-09') ; 
INSERT INTO `activitesreelles` VALUES (114, 255, NULL, 10, 24, NULL, '2013-03-11', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '0.0', 0, '2013-04-09', '2013-04-09') ; 
INSERT INTO `activitesreelles` VALUES (115, 255, NULL, 11, 24, NULL, '2013-03-18', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '0.0', 0, '2013-04-09', '2013-04-09') ; 
INSERT INTO `activitesreelles` VALUES (116, 255, NULL, 12, 24, NULL, '2013-03-25', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '0.0', 0, '2013-04-09', '2013-04-09') ; 
INSERT INTO `activitesreelles` VALUES (117, 5, NULL, 16, 21, NULL, '2013-04-08', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '4.0', 0, '2013-04-09', '2013-04-11') ; 
INSERT INTO `activitesreelles` VALUES (118, 5, NULL, 18, 21, NULL, '2013-04-15', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '4.0', 0, '2013-04-09', '2013-04-11') ; 
INSERT INTO `activitesreelles` VALUES (119, 5, NULL, 20, 21, NULL, '2013-04-22', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '4.0', 0, '2013-04-09', '2013-04-11') ; 
INSERT INTO `activitesreelles` VALUES (120, 8, NULL, 25, 12, NULL, '2013-04-01', '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '2.0', 0, '2013-04-11', '2013-04-11') ; 
INSERT INTO `activitesreelles` VALUES (121, 8, NULL, 26, 12, NULL, '2013-04-08', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '5.0', 0, '2013-04-11', '2013-04-11') ; 
INSERT INTO `activitesreelles` VALUES (122, 8, NULL, 27, 12, NULL, '2013-04-15', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '5.0', 0, '2013-04-11', '2013-04-11') ; 
INSERT INTO `activitesreelles` VALUES (123, 8, NULL, 28, 12, NULL, '2013-04-22', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '5.0', 0, '2013-04-11', '2013-04-11') ; 
INSERT INTO `activitesreelles` VALUES (124, 8, NULL, 223, 12, NULL, '2013-04-29', '1.0', 1, '1.0', 1, '0.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '4.0', 0, '2013-04-11', '2013-04-22') ; 
INSERT INTO `activitesreelles` VALUES (125, 12, NULL, 30, 5, NULL, '2013-04-01', '0.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '4.0', 0, '2013-04-11', '2013-04-11') ; 
INSERT INTO `activitesreelles` VALUES (126, 12, NULL, 31, 5, NULL, '2013-04-08', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '5.0', 0, '2013-04-11', '2013-04-11') ; 
INSERT INTO `activitesreelles` VALUES (127, 12, NULL, 32, 5, NULL, '2013-04-15', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '5.0', 0, '2013-04-11', '2013-04-11') ; 
INSERT INTO `activitesreelles` VALUES (128, 12, NULL, 33, 5, NULL, '2013-04-22', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '5.0', 0, '2013-04-11', '2013-04-11') ; 
INSERT INTO `activitesreelles` VALUES (129, 12, NULL, 34, 5, NULL, '2013-04-29', '1.0', 1, '1.0', 1, '0.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '4.0', 0, '2013-04-11', '2013-04-11') ; 
INSERT INTO `activitesreelles` VALUES (130, 6, NULL, 35, 22, NULL, '2013-04-01', '0.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '4.0', 0, '2013-04-11', '2013-04-11') ; 
INSERT INTO `activitesreelles` VALUES (131, 6, NULL, 36, 22, NULL, '2013-04-08', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '5.0', 0, '2013-04-11', '2013-04-11') ; 
INSERT INTO `activitesreelles` VALUES (132, 6, NULL, 37, 22, NULL, '2013-04-15', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '5.0', 0, '2013-04-11', '2013-04-11') ; 
INSERT INTO `activitesreelles` VALUES (133, 6, NULL, 38, 22, NULL, '2013-04-22', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '5.0', 0, '2013-04-11', '2013-04-11') ; 
INSERT INTO `activitesreelles` VALUES (134, 230, NULL, 40, 24, NULL, '2013-04-01', '0.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '4.0', 0, '2013-04-11', '2013-04-11') ; 
INSERT INTO `activitesreelles` VALUES (135, 230, NULL, 41, 21, NULL, '2013-04-08', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '5.0', 0, '2013-04-11', '2013-04-11') ; 
INSERT INTO `activitesreelles` VALUES (136, 230, NULL, 42, 21, NULL, '2013-04-15', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '5.0', 0, '2013-04-11', '2013-04-11') ; 
INSERT INTO `activitesreelles` VALUES (137, 230, NULL, 45, 21, NULL, '2013-04-22', '0.0', 1, '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 0, '2013-04-11', '2013-04-11') ; 
INSERT INTO `activitesreelles` VALUES (138, 230, NULL, 46, 21, NULL, '2013-04-29', '1.0', 1, '1.0', 1, '0.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '4.0', 0, '2013-04-11', '2013-04-11') ; 
INSERT INTO `activitesreelles` VALUES (139, 9, NULL, 48, 21, NULL, '2013-04-01', '0.0', 1, '0.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '3.0', 0, '2013-04-11', '2013-04-11') ; 
INSERT INTO `activitesreelles` VALUES (140, 9, NULL, 49, 21, NULL, '2013-04-08', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '4.0', 0, '2013-04-11', '2013-04-11') ; 
INSERT INTO `activitesreelles` VALUES (141, 9, NULL, 50, 22, NULL, '2013-04-08', '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '1.0', 0, '2013-04-11', '2013-04-11') ; 
INSERT INTO `activitesreelles` VALUES (142, 9, NULL, 51, 22, NULL, '2013-04-15', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '5.0', 0, '2013-04-11', '2013-04-11') ; 
INSERT INTO `activitesreelles` VALUES (143, 9, NULL, 53, 22, NULL, '2013-04-29', '1.0', 1, '1.0', 1, '0.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '4.0', 0, '2013-04-11', '2013-04-11') ; 
INSERT INTO `activitesreelles` VALUES (144, 10, NULL, 56, 16, NULL, '2013-04-01', '0.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '4.0', 0, '2013-04-11', '2013-04-11') ; 
INSERT INTO `activitesreelles` VALUES (145, 10, NULL, 57, 16, NULL, '2013-04-08', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '5.0', 0, '2013-04-11', '2013-04-11') ; 
INSERT INTO `activitesreelles` VALUES (146, 10, NULL, 58, 16, NULL, '2013-04-15', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '5.0', 0, '2013-04-11', '2013-04-11') ; 
INSERT INTO `activitesreelles` VALUES (147, 40, NULL, 86, 1, NULL, '2013-04-15', '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '1.0', 0, '2013-04-11', '2013-04-15') ; 
INSERT INTO `activitesreelles` VALUES (148, 40, NULL, 226, 1, NULL, '2013-04-29', '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 0, '2013-04-11', '2013-04-24') ; 
INSERT INTO `activitesreelles` VALUES (149, 40, NULL, 90, 16, NULL, '2013-04-01', '0.0', 1, '0.5', 1, '1.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '1.5', 0, '2013-04-11', '2013-04-15') ; 
INSERT INTO `activitesreelles` VALUES (150, 40, NULL, 87, 16, NULL, '2013-04-08', '1.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 0, '2013-04-11', '2013-04-15') ; 
INSERT INTO `activitesreelles` VALUES (151, 40, NULL, 88, 21, NULL, '2013-04-08', '0.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '4.0', 0, '2013-04-11', '2013-04-15') ; 
INSERT INTO `activitesreelles` VALUES (152, 40, NULL, 85, 21, NULL, '2013-04-15', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '4.0', 0, '2013-04-11', '2013-04-15') ; 
INSERT INTO `activitesreelles` VALUES (153, 40, NULL, 84, 21, NULL, '2013-04-22', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '5.0', 0, '2013-04-11', '2013-04-15') ; 
INSERT INTO `activitesreelles` VALUES (154, 40, NULL, 227, 21, NULL, '2013-04-29', '1.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '3.0', 0, '2013-04-11', '2013-04-24') ; 
INSERT INTO `activitesreelles` VALUES (155, 17, NULL, 65, 16, NULL, '2013-04-01', '0.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '4.0', 0, '2013-04-11', '2013-04-15') ; 
INSERT INTO `activitesreelles` VALUES (156, 17, NULL, 64, 16, NULL, '2013-04-08', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '5.0', 0, '2013-04-11', '2013-04-15') ; 
INSERT INTO `activitesreelles` VALUES (157, 17, NULL, 63, 16, NULL, '2013-04-15', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '5.0', 0, '2013-04-11', '2013-04-15') ; 
INSERT INTO `activitesreelles` VALUES (158, 17, NULL, 62, 16, NULL, '2013-04-22', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '5.0', 0, '2013-04-11', '2013-04-15') ; 
INSERT INTO `activitesreelles` VALUES (159, 17, NULL, 61, 16, NULL, '2013-04-29', '1.0', 1, '1.0', 1, '0.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '4.0', 0, '2013-04-11', '2013-04-15') ; 
INSERT INTO `activitesreelles` VALUES (160, 36, NULL, 75, 22, NULL, '2013-04-01', '0.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '4.0', 0, '2013-04-11', '2013-04-15') ; 
INSERT INTO `activitesreelles` VALUES (161, 36, NULL, 74, 22, NULL, '2013-04-08', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '5.0', 0, '2013-04-11', '2013-04-15') ; 
INSERT INTO `activitesreelles` VALUES (162, 36, NULL, 73, 22, NULL, '2013-04-15', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '5.0', 0, '2013-04-11', '2013-04-15') ; 
INSERT INTO `activitesreelles` VALUES (163, 36, NULL, 72, 22, NULL, '2013-04-22', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '5.0', 0, '2013-04-11', '2013-04-15') ; 
INSERT INTO `activitesreelles` VALUES (164, 36, NULL, 71, 22, NULL, '2013-04-29', '1.0', 1, '1.0', 1, '0.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '4.0', 0, '2013-04-11', '2013-04-15') ; 
INSERT INTO `activitesreelles` VALUES (165, 18, NULL, 70, 21, NULL, '2013-04-01', '0.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '4.0', 0, '2013-04-11', '2013-04-15') ; 
INSERT INTO `activitesreelles` VALUES (166, 18, NULL, 69, 21, NULL, '2013-04-08', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '5.0', 0, '2013-04-11', '2013-04-15') ; 
INSERT INTO `activitesreelles` VALUES (167, 18, NULL, 68, 21, NULL, '2013-04-15', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '5.0', 0, '2013-04-11', '2013-04-15') ; 
INSERT INTO `activitesreelles` VALUES (168, 172, NULL, 105, 24, NULL, '2013-04-01', '0.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '4.0', 0, '2013-04-11', '2013-04-15') ; 
INSERT INTO `activitesreelles` VALUES (169, 172, NULL, 102, 24, NULL, '2013-04-08', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '5.0', 0, '2013-04-11', '2013-04-15') ; 
INSERT INTO `activitesreelles` VALUES (171, 172, NULL, 99, 24, NULL, '2013-04-22', '0.5', 1, '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '1.5', 0, '2013-04-11', '2013-04-15') ; 
INSERT INTO `activitesreelles` VALUES (172, 172, NULL, 97, 24, NULL, '2013-04-29', '1.0', 1, '1.0', 1, '0.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '4.0', 0, '2013-04-11', '2013-04-15') ; 
INSERT INTO `activitesreelles` VALUES (173, 172, NULL, 101, 27, NULL, '2013-04-15', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '5.0', 0, '2013-04-11', '2013-04-15') ; 
INSERT INTO `activitesreelles` VALUES (174, 171, NULL, 96, 28, NULL, '2013-04-01', '0.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '4.0', 0, '2013-04-11', '2013-04-15') ; 
INSERT INTO `activitesreelles` VALUES (175, 171, NULL, 95, 30, NULL, '2013-04-08', '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '3.0', 0, '2013-04-11', '2013-04-15') ; 
INSERT INTO `activitesreelles` VALUES (176, 171, NULL, 94, 23, NULL, '2013-04-08', '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '2.0', 0, '2013-04-11', '2013-04-15') ; 
INSERT INTO `activitesreelles` VALUES (177, 171, NULL, 93, 23, NULL, '2013-04-15', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '5.0', 0, '2013-04-11', '2013-04-15') ; 
INSERT INTO `activitesreelles` VALUES (178, 171, NULL, 92, 23, NULL, '2013-04-22', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '5.0', 0, '2013-04-11', '2013-04-15') ; 
INSERT INTO `activitesreelles` VALUES (179, 176, NULL, 112, 27, NULL, '2013-04-01', '0.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '4.0', 0, '2013-04-11', '2013-04-15') ; 
INSERT INTO `activitesreelles` VALUES (180, 176, NULL, 111, 27, NULL, '2013-04-08', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '4.0', 0, '2013-04-11', '2013-04-15') ; 
INSERT INTO `activitesreelles` VALUES (181, 176, NULL, 109, 24, NULL, '2013-04-15', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '5.0', 0, '2013-04-11', '2013-04-15') ; 
INSERT INTO `activitesreelles` VALUES (182, 176, NULL, 108, 24, NULL, '2013-04-22', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '4.0', 0, '2013-04-11', '2013-04-15') ; 
INSERT INTO `activitesreelles` VALUES (183, 176, NULL, 110, 1, NULL, '2013-04-08', '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '1.0', 0, '2013-04-11', '2013-04-15') ; 
INSERT INTO `activitesreelles` VALUES (184, 176, NULL, 107, 27, NULL, '2013-04-22', '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '1.0', 0, '2013-04-11', '2013-04-15') ; 
INSERT INTO `activitesreelles` VALUES (185, 237, NULL, 118, 23, NULL, '2013-04-01', '0.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '4.0', 0, '2013-04-11', '2013-04-15') ; 
INSERT INTO `activitesreelles` VALUES (186, 237, NULL, 117, 23, NULL, '2013-04-08', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '5.0', 0, '2013-04-11', '2013-04-15') ; 
INSERT INTO `activitesreelles` VALUES (187, 237, NULL, 116, 14, NULL, '2013-04-15', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '5.0', 0, '2013-04-11', '2013-04-15') ; 
INSERT INTO `activitesreelles` VALUES (188, 237, NULL, 115, 14, NULL, '2013-04-22', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '5.0', 0, '2013-04-11', '2013-04-15') ; 
INSERT INTO `activitesreelles` VALUES (189, 237, NULL, 113, 14, NULL, '2013-04-29', '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '2.0', 0, '2013-04-11', '2013-04-15') ; 
INSERT INTO `activitesreelles` VALUES (190, 268, NULL, 146, 21, NULL, '2013-04-01', '0.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '4.0', 0, '2013-04-11', '2013-04-15') ; 
INSERT INTO `activitesreelles` VALUES (191, 268, NULL, 130, 21, NULL, '2013-04-08', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '5.0', 0, '2013-04-11', '2013-04-15') ; 
INSERT INTO `activitesreelles` VALUES (192, 268, NULL, 129, 21, NULL, '2013-04-15', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '5.0', 0, '2013-04-11', '2013-04-15') ; 
INSERT INTO `activitesreelles` VALUES (193, 268, NULL, 128, 21, NULL, '2013-04-22', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '5.0', 0, '2013-04-11', '2013-04-15') ; 
INSERT INTO `activitesreelles` VALUES (194, 268, NULL, 127, 21, NULL, '2013-04-29', '1.0', 1, '1.0', 1, '0.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '4.0', 0, '2013-04-11', '2013-04-15') ; 
INSERT INTO `activitesreelles` VALUES (195, 38, NULL, 81, 22, NULL, '2013-04-01', '0.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '4.0', 0, '2013-04-11', '2013-04-15') ; 
INSERT INTO `activitesreelles` VALUES (196, 38, NULL, 80, 22, NULL, '2013-04-08', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '5.0', 0, '2013-04-11', '2013-04-15') ; 
INSERT INTO `activitesreelles` VALUES (197, 38, NULL, 79, 22, NULL, '2013-04-15', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '5.0', 0, '2013-04-11', '2013-04-15') ; 
INSERT INTO `activitesreelles` VALUES (198, 38, NULL, 78, 22, NULL, '2013-04-22', '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '3.0', 0, '2013-04-11', '2013-04-15') ; 
INSERT INTO `activitesreelles` VALUES (199, 38, NULL, 76, 22, NULL, '2013-04-29', '1.0', 1, '1.0', 1, '0.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '4.0', 0, '2013-04-11', '2013-04-15') ; 
INSERT INTO `activitesreelles` VALUES (200, 265, NULL, 125, 27, NULL, '2013-04-01', '0.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '3.0', 0, '2013-04-11', '2013-04-15') ; 
INSERT INTO `activitesreelles` VALUES (201, 265, NULL, 124, 27, NULL, '2013-04-08', '1.0', 1, '1.0', 1, '0.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '4.0', 0, '2013-04-11', '2013-04-15') ; 
INSERT INTO `activitesreelles` VALUES (202, 265, NULL, 121, 24, NULL, '2013-04-15', '1.0', 1, '1.0', 1, '0.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '4.0', 0, '2013-04-11', '2013-04-15') ; 
INSERT INTO `activitesreelles` VALUES (203, 265, NULL, 120, 24, NULL, '2013-04-22', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '5.0', 0, '2013-04-11', '2013-04-15') ; 
INSERT INTO `activitesreelles` VALUES (204, 265, NULL, 119, 24, NULL, '2013-04-29', '1.0', 1, '1.0', 1, '0.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '4.0', 0, '2013-04-11', '2013-04-15') ; 
INSERT INTO `activitesreelles` VALUES (205, 272, NULL, 132, 21, NULL, '2013-04-01', '0.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '2.0', 0, '2013-04-11', '2013-04-15') ; 
INSERT INTO `activitesreelles` VALUES (206, 11, NULL, 178, 1, NULL, '2013-04-08', '0.0', 1, '0.0', 1, '0.5', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.5', 0, '2013-04-15', '2013-04-16') ; 
INSERT INTO `activitesreelles` VALUES (207, 11, NULL, 177, 14, NULL, '2013-04-01', '0.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '4.0', 0, '2013-04-15', '2013-04-16') ; 
INSERT INTO `activitesreelles` VALUES (208, 11, NULL, 179, 14, NULL, '2013-04-08', '1.0', 1, '1.0', 1, '0.5', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '4.5', 0, '2013-04-15', '2013-04-16') ; 
INSERT INTO `activitesreelles` VALUES (209, 11, NULL, 180, 14, NULL, '2013-04-15', '1.0', 1, '1.0', 1, '0.5', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '2.5', 0, '2013-04-15', '2013-04-16') ; 
INSERT INTO `activitesreelles` VALUES (211, 11, NULL, 181, 23, NULL, '2013-04-15', '0.0', 1, '0.0', 1, '0.5', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '2.5', 0, '2013-04-15', '2013-04-16') ; 
INSERT INTO `activitesreelles` VALUES (212, 11, NULL, 182, 23, NULL, '2013-04-22', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '5.0', 0, '2013-04-15', '2013-04-16') ; 
INSERT INTO `activitesreelles` VALUES (213, 11, NULL, 436, 23, NULL, '2013-04-29', '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '2.0', 0, '2013-04-15', '2013-05-21') ; 
INSERT INTO `activitesreelles` VALUES (214, 255, NULL, 185, 24, NULL, '2013-04-01', '0.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '4.0', 0, '2013-04-15', '2013-04-16') ; 
INSERT INTO `activitesreelles` VALUES (215, 255, NULL, 186, 24, NULL, '2013-04-08', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '5.0', 0, '2013-04-15', '2013-04-16') ; 
INSERT INTO `activitesreelles` VALUES (216, 255, NULL, 187, 24, NULL, '2013-04-15', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '5.0', 0, '2013-04-15', '2013-04-16') ; 
INSERT INTO `activitesreelles` VALUES (217, 255, NULL, 188, 24, NULL, '2013-04-22', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '5.0', 0, '2013-04-15', '2013-04-16') ; 
INSERT INTO `activitesreelles` VALUES (218, 255, NULL, 424, 24, NULL, '2013-04-29', '1.0', 1, '1.0', 1, '0.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '4.0', 0, '2013-04-15', '2013-05-21') ; 
INSERT INTO `activitesreelles` VALUES (219, 14, NULL, 152, 3, NULL, '2013-04-22', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '5.0', 0, '2013-04-15', '2013-04-16') ; 
INSERT INTO `activitesreelles` VALUES (220, 14, NULL, 468, 3, NULL, '2013-04-29', '1.0', 1, '1.0', 1, '0.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '4.0', 0, '2013-04-15', '2013-05-21') ; 
INSERT INTO `activitesreelles` VALUES (221, 14, NULL, 148, 14, NULL, '2013-04-01', '0.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '4.0', 0, '2013-04-15', '2013-04-16') ; 
INSERT INTO `activitesreelles` VALUES (222, 14, NULL, 149, 14, NULL, '2013-04-08', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '5.0', 0, '2013-04-15', '2013-04-16') ; 
INSERT INTO `activitesreelles` VALUES (223, 14, NULL, 150, 14, NULL, '2013-04-15', '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '2.0', 0, '2013-04-15', '2013-04-16') ; 
INSERT INTO `activitesreelles` VALUES (224, 14, NULL, 151, 28, NULL, '2013-04-15', '0.0', 1, '0.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '3.0', 0, '2013-04-15', '2013-04-16') ; 
INSERT INTO `activitesreelles` VALUES (225, 231, NULL, 170, 21, NULL, '2013-04-01', '0.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '4.0', 0, '2013-04-15', '2013-04-16') ; 
INSERT INTO `activitesreelles` VALUES (226, 231, NULL, 171, 21, NULL, '2013-04-08', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '4.0', 0, '2013-04-15', '2013-04-16') ; 
INSERT INTO `activitesreelles` VALUES (227, 231, NULL, 172, 22, NULL, '2013-04-08', '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '1.0', 0, '2013-04-15', '2013-04-16') ; 
INSERT INTO `activitesreelles` VALUES (228, 231, NULL, 174, 16, NULL, '2013-04-22', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '5.0', 0, '2013-04-15', '2013-04-16') ; 
INSERT INTO `activitesreelles` VALUES (229, 231, NULL, 173, 22, NULL, '2013-04-15', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '5.0', 0, '2013-04-15', '2013-04-16') ; 
INSERT INTO `activitesreelles` VALUES (230, 231, NULL, 447, 22, NULL, '2013-04-29', '1.0', 1, '1.0', 1, '0.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '4.0', 0, '2013-04-15', '2013-05-21') ; 
INSERT INTO `activitesreelles` VALUES (231, 16, NULL, 154, 22, NULL, '2013-04-01', '0.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '4.0', 0, '2013-04-15', '2013-04-16') ; 
INSERT INTO `activitesreelles` VALUES (232, 16, NULL, 155, 22, NULL, '2013-04-08', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '5.0', 0, '2013-04-15', '2013-04-16') ; 
INSERT INTO `activitesreelles` VALUES (234, 16, NULL, 457, 22, NULL, '2013-04-29', '1.0', 1, '1.0', 1, '0.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '4.0', 0, '2013-04-15', '2013-05-21') ; 
INSERT INTO `activitesreelles` VALUES (235, 7, NULL, 199, 37, NULL, '2013-04-22', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '5.0', 0, '2013-04-15', '2013-04-16') ; 
INSERT INTO `activitesreelles` VALUES (236, 7, NULL, 191, 28, NULL, '2013-04-01', '0.0', 1, '1.0', 1, '0.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '3.0', 0, '2013-04-15', '2013-04-16') ; 
INSERT INTO `activitesreelles` VALUES (237, 7, NULL, 193, 28, NULL, '2013-04-08', '0.0', 1, '1.0', 1, '0.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '3.0', 0, '2013-04-15', '2013-04-16') ; 
INSERT INTO `activitesreelles` VALUES (238, 7, NULL, 194, 30, NULL, '2013-04-08', '1.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 0, '2013-04-15', '2013-04-16') ; 
INSERT INTO `activitesreelles` VALUES (239, 7, NULL, 196, 30, NULL, '2013-04-15', '1.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 0, '2013-04-15', '2013-04-16') ; 
INSERT INTO `activitesreelles` VALUES (241, 7, NULL, 201, 31, NULL, '2013-04-29', '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '2.0', 0, '2013-04-15', '2013-04-16') ; 
INSERT INTO `activitesreelles` VALUES (242, 7, NULL, 197, 31, NULL, '2013-04-15', '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 0, '2013-04-15', '2013-04-16') ; 
INSERT INTO `activitesreelles` VALUES (243, 7, NULL, 198, 32, NULL, '2013-04-15', '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '2.0', 0, '2013-04-15', '2013-04-16') ; 
INSERT INTO `activitesreelles` VALUES (244, 7, NULL, 202, 28, NULL, '2013-04-29', '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 0, '2013-04-15', '2013-04-16') ; 
INSERT INTO `activitesreelles` VALUES (245, 13, NULL, 161, 37, NULL, '2013-04-08', '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 0, '2013-04-15', '2013-04-16') ; 
INSERT INTO `activitesreelles` VALUES (246, 13, NULL, 164, 37, NULL, '2013-04-15', '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '2.0', 0, '2013-04-15', '2013-04-16') ; 
INSERT INTO `activitesreelles` VALUES (247, 13, NULL, 159, 38, NULL, '2013-04-01', '0.0', 1, '1.0', 1, '0.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '3.0', 0, '2013-04-15', '2013-04-16') ; 
INSERT INTO `activitesreelles` VALUES (248, 13, NULL, 169, 38, NULL, '2013-04-29', '0.0', 1, '1.0', 1, '0.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '3.0', 0, '2013-04-15', '2013-04-16') ; 
INSERT INTO `activitesreelles` VALUES (249, 13, NULL, 162, 34, NULL, '2013-04-08', '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '3.0', 0, '2013-04-15', '2013-04-16') ; 
INSERT INTO `activitesreelles` VALUES (250, 13, NULL, 165, 34, NULL, '2013-04-15', '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '2.0', 0, '2013-04-15', '2013-04-16') ; 
INSERT INTO `activitesreelles` VALUES (251, 140, NULL, 145, 16, NULL, '2013-04-01', '0.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '4.0', 0, '2013-04-15', '2013-04-15') ; 
INSERT INTO `activitesreelles` VALUES (252, 140, NULL, 144, 16, NULL, '2013-04-08', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '5.0', 0, '2013-04-15', '2013-04-15') ; 
INSERT INTO `activitesreelles` VALUES (253, 140, NULL, 143, 16, NULL, '2013-04-15', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '5.0', 0, '2013-04-15', '2013-04-15') ; 
INSERT INTO `activitesreelles` VALUES (254, 140, NULL, 142, 16, NULL, '2013-04-22', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '5.0', 0, '2013-04-15', '2013-04-15') ; 
INSERT INTO `activitesreelles` VALUES (255, 140, NULL, 141, 16, NULL, '2013-04-29', '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '2.0', 0, '2013-04-15', '2013-04-15') ; 
INSERT INTO `activitesreelles` VALUES (256, 33, NULL, 139, 21, NULL, '2013-04-01', '0.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '4.0', 0, '2013-04-15', '2013-04-15') ; 
INSERT INTO `activitesreelles` VALUES (257, 33, NULL, 137, 21, NULL, '2013-04-08', '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '4.0', 0, '2013-04-15', '2013-04-15') ; 
INSERT INTO `activitesreelles` VALUES (258, 33, NULL, 136, 21, NULL, '2013-04-15', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '5.0', 0, '2013-04-15', '2013-04-15') ; 
INSERT INTO `activitesreelles` VALUES (259, 33, NULL, 135, 21, NULL, '2013-04-22', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '5.0', 0, '2013-04-15', '2013-04-15') ; 
INSERT INTO `activitesreelles` VALUES (260, 33, NULL, 134, 21, NULL, '2013-04-29', '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '2.0', 0, '2013-04-15', '2013-04-15') ; 
INSERT INTO `activitesreelles` VALUES (261, 268, NULL, 147, 1, NULL, '2013-04-01', '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '2.0', 0, '2013-04-15', '2013-04-15') ; 
INSERT INTO `activitesreelles` VALUES (262, 231, NULL, 448, 1, NULL, '2013-05-06', '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '3.0', 0, '2013-04-16', '2013-05-21') ; 
INSERT INTO `activitesreelles` VALUES (263, 34, NULL, 211, 1, NULL, '2013-04-01', '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 0, '2013-04-16', '2013-04-16') ; 
INSERT INTO `activitesreelles` VALUES (264, 34, NULL, 214, 1, NULL, '2013-04-15', '1.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 0, '2013-04-16', '2013-04-16') ; 
INSERT INTO `activitesreelles` VALUES (265, 34, NULL, 218, 6, NULL, '2013-04-22', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '5.0', 0, '2013-04-16', '2013-04-16') ; 
INSERT INTO `activitesreelles` VALUES (266, 34, NULL, 400, 6, NULL, '2013-04-29', '1.0', 1, '1.0', 1, '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '3.0', 0, '2013-04-16', '2013-05-21') ; 
INSERT INTO `activitesreelles` VALUES (267, 34, NULL, 401, 1, NULL, '2013-04-29', '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '1.0', 0, '2013-04-16', '2013-05-21') ; 
INSERT INTO `activitesreelles` VALUES (268, 34, NULL, 212, 14, NULL, '2013-04-01', '0.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '3.0', 0, '2013-04-16', '2013-04-16') ; 
INSERT INTO `activitesreelles` VALUES (269, 34, NULL, 213, 38, NULL, '2013-04-08', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '5.0', 0, '2013-04-16', '2013-04-16') ; 
INSERT INTO `activitesreelles` VALUES (270, 34, NULL, 215, 38, NULL, '2013-04-15', '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '1.0', 0, '2013-04-16', '2013-04-16') ; 
INSERT INTO `activitesreelles` VALUES (271, 34, NULL, 216, 13, NULL, '2013-04-15', '0.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '2.0', 0, '2013-04-16', '2013-04-16') ; 
INSERT INTO `activitesreelles` VALUES (272, 34, NULL, 217, 23, NULL, '2013-04-15', '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 0, '2013-04-16', '2013-04-16') ; 
INSERT INTO `activitesreelles` VALUES (273, 4, NULL, 516, 1, NULL, '2013-05-06', '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '1.0', 0, '2013-04-24', '2013-05-21') ; 
INSERT INTO `activitesreelles` VALUES (274, 22, NULL, 493, 2, NULL, '2013-05-06', '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '1.0', 0, '2013-04-24', '2013-05-21') ; 
INSERT INTO `activitesreelles` VALUES (276, 7, NULL, 362, 37, NULL, '2013-05-20', '0.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '3.0', 0, '2013-04-24', '2013-05-21') ; 
INSERT INTO `activitesreelles` VALUES (277, 172, NULL, 265, 1, NULL, '2013-05-20', '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.5', 0, '0.0', 1, '0.0', 1, '0.5', 0, '2013-04-24', '2013-05-16') ; 
INSERT INTO `activitesreelles` VALUES (278, 172, NULL, 263, 1, NULL, '2013-05-27', '1.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 0, '2013-04-24', '2013-05-16') ; 
INSERT INTO `activitesreelles` VALUES (279, 171, NULL, 257, 1, NULL, '2013-05-06', '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '1.0', 0, '2013-04-24', '2013-05-16') ; 
INSERT INTO `activitesreelles` VALUES (280, 261, NULL, 518, 1, NULL, '2013-04-29', '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '2.0', 0, '2013-04-24', '2013-05-21') ; 
INSERT INTO `activitesreelles` VALUES (281, 261, NULL, 290, 1, NULL, '2013-05-06', '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '3.0', 0, '2013-04-24', '2013-05-16') ; 
INSERT INTO `activitesreelles` VALUES (282, 4, NULL, NULL, 1, NULL, '2013-07-08', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '5.0', 1, '2013-04-24', '2013-04-24') ; 
INSERT INTO `activitesreelles` VALUES (283, 6, NULL, NULL, 3, NULL, '2013-07-01', '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '2013-04-24', '2013-04-24') ; 
INSERT INTO `activitesreelles` VALUES (284, 6, NULL, NULL, 3, NULL, '2013-07-08', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '5.0', 1, '2013-04-24', '2013-04-24') ; 
INSERT INTO `activitesreelles` VALUES (285, 6, NULL, NULL, 3, NULL, '2013-07-15', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '5.0', 1, '2013-04-24', '2013-04-24') ; 
INSERT INTO `activitesreelles` VALUES (286, 6, NULL, NULL, 3, NULL, '2013-07-22', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '5.0', 1, '2013-04-24', '2013-04-24') ; 
INSERT INTO `activitesreelles` VALUES (287, 3, NULL, NULL, 1, NULL, '2013-07-15', '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '2013-04-24', '2013-04-24') ; 
INSERT INTO `activitesreelles` VALUES (288, 3, NULL, NULL, 1, NULL, '2013-07-22', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '5.0', 1, '2013-04-24', '2013-04-24') ; 
INSERT INTO `activitesreelles` VALUES (289, 255, NULL, NULL, 1, NULL, '2013-07-01', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '5.0', 1, '2013-04-25', '2013-04-25') ; 
INSERT INTO `activitesreelles` VALUES (290, 255, NULL, NULL, 1, NULL, '2013-07-08', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '5.0', 1, '2013-04-25', '2013-04-25') ; 
INSERT INTO `activitesreelles` VALUES (291, 255, NULL, NULL, 1, NULL, '2013-07-15', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '5.0', 1, '2013-04-25', '2013-04-25') ; 
INSERT INTO `activitesreelles` VALUES (292, 255, NULL, NULL, 1, NULL, '2013-07-22', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '5.0', 1, '2013-04-25', '2013-04-25') ; 
INSERT INTO `activitesreelles` VALUES (293, 22, NULL, NULL, 1, NULL, '2013-07-29', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '5.0', 1, '2013-04-25', '2013-04-25') ; 
INSERT INTO `activitesreelles` VALUES (294, 22, NULL, NULL, 1, NULL, '2013-08-05', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '5.0', 1, '2013-04-25', '2013-04-25') ; 
INSERT INTO `activitesreelles` VALUES (295, 22, NULL, NULL, 1, NULL, '2013-08-12', '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '4.0', 1, '2013-04-25', '2013-04-25') ; 
INSERT INTO `activitesreelles` VALUES (296, 22, NULL, NULL, 1, NULL, '2013-08-19', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '5.0', 1, '2013-04-25', '2013-04-25') ; 
INSERT INTO `activitesreelles` VALUES (297, 7, NULL, NULL, 3, NULL, '2013-07-01', '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '2013-04-25', '2013-04-25') ; 
INSERT INTO `activitesreelles` VALUES (298, 7, NULL, NULL, 3, NULL, '2013-07-08', '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '2013-04-25', '2013-04-25') ; 
INSERT INTO `activitesreelles` VALUES (299, 7, NULL, NULL, 3, NULL, '2013-07-15', '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '2013-04-25', '2013-04-25') ; 
INSERT INTO `activitesreelles` VALUES (300, 7, NULL, NULL, 3, NULL, '2013-07-22', '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '2013-04-25', '2013-04-25') ; 
INSERT INTO `activitesreelles` VALUES (301, 7, NULL, NULL, 3, NULL, '2013-07-29', '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '2013-04-25', '2013-04-25') ; 
INSERT INTO `activitesreelles` VALUES (302, 7, NULL, NULL, 1, NULL, '2013-07-22', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '4.0', 1, '2013-04-25', '2013-04-25') ; 
INSERT INTO `activitesreelles` VALUES (303, 7, NULL, NULL, 1, NULL, '2013-07-29', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '4.0', 1, '2013-04-25', '2013-04-25') ; 
INSERT INTO `activitesreelles` VALUES (304, 265, NULL, NULL, 1, NULL, '2013-07-08', '0.0', 1, '0.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '3.0', 1, '2013-04-25', '2013-04-25') ; 
INSERT INTO `activitesreelles` VALUES (305, 265, NULL, NULL, 1, NULL, '2013-07-15', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '5.0', 1, '2013-04-25', '2013-04-25') ; 
INSERT INTO `activitesreelles` VALUES (306, 265, NULL, NULL, 1, NULL, '2013-07-22', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '5.0', 1, '2013-04-25', '2013-04-25') ; 
INSERT INTO `activitesreelles` VALUES (307, 265, NULL, NULL, 1, NULL, '2013-07-29', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '5.0', 1, '2013-04-25', '2013-04-25') ; 
INSERT INTO `activitesreelles` VALUES (308, 265, NULL, NULL, 1, NULL, '2013-08-05', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '4.0', 1, '2013-04-25', '2013-04-25') ; 
INSERT INTO `activitesreelles` VALUES (309, 4, NULL, NULL, 1, NULL, '2013-08-12', '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '4.0', 1, '2013-04-25', '2013-04-25') ; 
INSERT INTO `activitesreelles` VALUES (310, 4, NULL, NULL, 1, NULL, '2013-08-19', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '5.0', 1, '2013-04-25', '2013-04-25') ; 
INSERT INTO `activitesreelles` VALUES (311, 4, NULL, NULL, 1, NULL, '2013-08-26', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '5.0', 1, '2013-04-25', '2013-04-25') ; 
INSERT INTO `activitesreelles` VALUES (312, 9, NULL, NULL, 1, NULL, '2013-08-12', '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '4.0', 1, '2013-04-25', '2013-04-25') ; 
INSERT INTO `activitesreelles` VALUES (313, 9, NULL, NULL, 1, NULL, '2013-08-19', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '5.0', 1, '2013-04-25', '2013-04-25') ; 
INSERT INTO `activitesreelles` VALUES (314, 9, NULL, NULL, 1, NULL, '2013-08-26', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '5.0', 1, '2013-04-25', '2013-04-25') ; 
INSERT INTO `activitesreelles` VALUES (315, 3, NULL, NULL, 1, NULL, '2013-08-05', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '5.0', 1, '2013-04-25', '2013-04-25') ; 
INSERT INTO `activitesreelles` VALUES (316, 3, NULL, NULL, 1, NULL, '2013-08-12', '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '4.0', 1, '2013-04-25', '2013-04-25') ; 
INSERT INTO `activitesreelles` VALUES (317, 3, NULL, NULL, 2, NULL, '2013-08-19', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '5.0', 1, '2013-04-25', '2013-04-25') ; 
INSERT INTO `activitesreelles` VALUES (318, 5, NULL, NULL, 3, NULL, '2013-08-05', '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '2013-04-25', '2013-04-25') ; 
INSERT INTO `activitesreelles` VALUES (319, 5, NULL, NULL, 3, NULL, '2013-08-12', '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '2013-04-25', '2013-04-25') ; 
INSERT INTO `activitesreelles` VALUES (320, 5, NULL, NULL, 3, NULL, '2013-08-19', '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '2013-04-25', '2013-04-25') ; 
INSERT INTO `activitesreelles` VALUES (321, 5, NULL, NULL, 3, NULL, '2013-08-26', '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '2013-04-25', '2013-04-25') ; 
INSERT INTO `activitesreelles` VALUES (322, 5, NULL, NULL, 3, NULL, '2013-09-02', '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '2013-04-25', '2013-04-25') ; 
INSERT INTO `activitesreelles` VALUES (323, 36, NULL, NULL, 1, NULL, '2013-08-19', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '5.0', 1, '2013-04-25', '2013-04-25') ; 
INSERT INTO `activitesreelles` VALUES (324, 36, NULL, NULL, 1, NULL, '2013-08-26', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '5.0', 1, '2013-04-25', '2013-04-25') ; 
INSERT INTO `activitesreelles` VALUES (325, 36, NULL, NULL, 1, NULL, '2013-09-02', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '5.0', 1, '2013-04-25', '2013-04-25') ; 
INSERT INTO `activitesreelles` VALUES (326, 38, NULL, NULL, 1, NULL, '2013-07-29', '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '2013-04-25', '2013-04-25') ; 
INSERT INTO `activitesreelles` VALUES (327, 38, NULL, NULL, 1, NULL, '2013-08-05', '1.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '2013-04-25', '2013-04-25') ; 
INSERT INTO `activitesreelles` VALUES (328, 38, NULL, NULL, 1, NULL, '2013-08-12', '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '2013-04-25', '2013-04-25') ; 
INSERT INTO `activitesreelles` VALUES (329, 172, NULL, NULL, 1, NULL, '2013-08-05', '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.5', 0, '0.0', 1, '0.0', 1, '0.5', 1, '2013-04-25', '2013-04-25') ; 
INSERT INTO `activitesreelles` VALUES (330, 172, NULL, NULL, 1, NULL, '2013-08-12', '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '1.0', 0, '0.0', 1, '0.0', 1, '4.0', 1, '2013-04-25', '2013-04-25') ; 
INSERT INTO `activitesreelles` VALUES (331, 172, NULL, NULL, 1, NULL, '2013-08-19', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 0, '0.0', 1, '0.0', 1, '5.0', 1, '2013-04-25', '2013-04-25') ; 
INSERT INTO `activitesreelles` VALUES (332, 172, NULL, NULL, 1, NULL, '2013-08-26', '1.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 0, '0.0', 1, '0.0', 1, '1.0', 1, '2013-04-25', '2013-04-25') ; 
INSERT INTO `activitesreelles` VALUES (333, 171, NULL, NULL, 1, NULL, '2013-08-19', '0.0', 1, '0.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '3.0', 1, '2013-04-25', '2013-04-25') ; 
INSERT INTO `activitesreelles` VALUES (334, 171, NULL, NULL, 1, NULL, '2013-08-26', '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '2.0', 1, '2013-04-25', '2013-04-25') ; 
INSERT INTO `activitesreelles` VALUES (335, 176, NULL, NULL, 1, NULL, '2013-08-05', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '5.0', 1, '2013-04-25', '2013-04-25') ; 
INSERT INTO `activitesreelles` VALUES (336, 176, NULL, NULL, 1, NULL, '2013-08-12', '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '4.0', 1, '2013-04-25', '2013-04-25') ; 
INSERT INTO `activitesreelles` VALUES (337, 176, NULL, NULL, 1, NULL, '2013-08-19', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '5.0', 1, '2013-04-25', '2013-04-25') ; 
INSERT INTO `activitesreelles` VALUES (338, 33, NULL, NULL, 1, NULL, '2013-08-12', '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '4.0', 1, '2013-04-25', '2013-04-25') ; 
INSERT INTO `activitesreelles` VALUES (339, 33, NULL, NULL, 1, NULL, '2013-08-19', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '5.0', 1, '2013-04-25', '2013-04-25') ; 
INSERT INTO `activitesreelles` VALUES (340, 33, NULL, NULL, 1, NULL, '2013-08-26', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '5.0', 1, '2013-04-25', '2013-04-25') ; 
INSERT INTO `activitesreelles` VALUES (341, 33, NULL, NULL, 1, NULL, '2013-09-02', '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '2.0', 1, '2013-04-25', '2013-04-25') ; 
INSERT INTO `activitesreelles` VALUES (342, 5, NULL, NULL, 3, NULL, '2013-09-09', '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '2013-04-25', '2013-04-25') ; 
INSERT INTO `activitesreelles` VALUES (343, 5, NULL, NULL, 3, NULL, '2013-09-16', '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '2013-04-25', '2013-04-25') ; 
INSERT INTO `activitesreelles` VALUES (344, 5, NULL, NULL, 3, NULL, '2013-09-23', '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '2013-04-25', '2013-04-25') ; 
INSERT INTO `activitesreelles` VALUES (345, 5, NULL, NULL, 3, NULL, '2013-09-30', '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '2013-04-25', '2013-04-25') ; 
INSERT INTO `activitesreelles` VALUES (346, 5, NULL, NULL, 3, NULL, '2013-10-07', '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '2013-04-25', '2013-04-25') ; 
INSERT INTO `activitesreelles` VALUES (347, 5, NULL, NULL, 3, NULL, '2013-10-14', '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '2013-04-25', '2013-04-25') ; 
INSERT INTO `activitesreelles` VALUES (348, 5, NULL, NULL, 3, NULL, '2013-10-21', '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '2013-04-25', '2013-04-25') ; 
INSERT INTO `activitesreelles` VALUES (349, 5, NULL, NULL, 3, NULL, '2013-10-28', '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '2013-04-25', '2013-04-25') ; 
INSERT INTO `activitesreelles` VALUES (350, 5, NULL, NULL, 3, NULL, '2013-11-04', '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '2013-04-25', '2013-04-25') ; 
INSERT INTO `activitesreelles` VALUES (351, 5, NULL, NULL, 3, NULL, '2013-11-11', '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '2013-04-25', '2013-04-25') ; 
INSERT INTO `activitesreelles` VALUES (352, 5, NULL, NULL, 3, NULL, '2013-11-18', '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '2013-04-25', '2013-04-25') ; 
INSERT INTO `activitesreelles` VALUES (353, 5, NULL, NULL, 3, NULL, '2013-11-25', '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '2013-04-25', '2013-04-25') ; 
INSERT INTO `activitesreelles` VALUES (354, 5, NULL, NULL, 3, NULL, '2013-12-02', '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '2013-04-25', '2013-04-25') ; 
INSERT INTO `activitesreelles` VALUES (355, 5, NULL, NULL, 3, NULL, '2013-12-09', '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '2013-04-25', '2013-04-25') ; 
INSERT INTO `activitesreelles` VALUES (356, 5, NULL, NULL, 3, NULL, '2013-12-16', '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '2013-04-25', '2013-04-25') ; 
INSERT INTO `activitesreelles` VALUES (357, 5, NULL, NULL, 3, NULL, '2013-12-23', '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '2013-04-25', '2013-04-25') ; 
INSERT INTO `activitesreelles` VALUES (358, 5, NULL, NULL, 3, NULL, '2013-12-30', '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '2013-04-25', '2013-04-25') ; 
INSERT INTO `activitesreelles` VALUES (359, 5, NULL, NULL, 1, NULL, '2013-12-23', '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '2013-04-25', '2013-04-25') ; 
INSERT INTO `activitesreelles` VALUES (360, 5, NULL, NULL, 1, NULL, '2013-12-30', '1.0', 1, '1.0', 1, '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '3.0', 1, '2013-04-25', '2013-04-25') ; 
INSERT INTO `activitesreelles` VALUES (361, 5, NULL, 316, 21, 25, '2013-05-13', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '4.0', 0, '2013-05-13', '2013-05-16') ; 
INSERT INTO `activitesreelles` VALUES (362, 14, NULL, 475, 14, 13, '2013-05-13', '0.5', 1, '0.0', 1, '0.0', 1, '0.5', 1, '1.0', 1, '0.0', 1, '0.0', 1, '2.0', 0, '2013-05-14', '2013-05-21') ; 
INSERT INTO `activitesreelles` VALUES (363, 14, NULL, 477, 28, 13, '2013-05-13', '0.5', 1, '1.0', 1, '0.5', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '2.0', 0, '2013-05-14', '2013-05-21') ; 
INSERT INTO `activitesreelles` VALUES (365, 14, NULL, 469, 13, NULL, '2013-05-06', '0.5', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.5', 0, '2013-05-14', '2013-05-21') ; 
INSERT INTO `activitesreelles` VALUES (366, 14, NULL, 471, 14, NULL, '2013-05-06', '0.5', 1, '0.5', 1, '0.0', 1, '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '2.0', 0, '2013-05-14', '2013-05-21') ; 
INSERT INTO `activitesreelles` VALUES (367, 14, NULL, 473, 28, NULL, '2013-05-06', '0.0', 1, '0.5', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.5', 0, '2013-05-14', '2013-05-21') ; 
INSERT INTO `activitesreelles` VALUES (368, 5, NULL, 320, 21, 25, '2013-05-20', '0.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '3.0', 0, '2013-05-15', '2013-05-16') ; 
INSERT INTO `activitesreelles` VALUES (369, 14, NULL, 479, 23, 19, '2013-05-13', '0.0', 1, '0.0', 1, '0.5', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.5', 0, '2013-05-15', '2013-05-21') ; 
INSERT INTO `activitesreelles` VALUES (370, 5, NULL, 323, 21, 25, '2013-05-27', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '4.0', 0, '2013-05-16', '2013-05-16') ; 
INSERT INTO `activitesreelles` VALUES (371, 14, NULL, 481, 13, 13, '2013-05-13', '0.0', 1, '0.0', 1, '0.0', 1, '0.5', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.5', 0, '2013-05-16', '2013-05-21') ; 
INSERT INTO `activitesreelles` VALUES (372, 8, NULL, 342, 12, NULL, '2013-05-06', '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '3.0', 0, '2013-05-16', '2013-05-21') ; 
INSERT INTO `activitesreelles` VALUES (373, 8, NULL, 343, 12, NULL, '2013-05-13', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '5.0', 0, '2013-05-16', '2013-05-21') ; 
INSERT INTO `activitesreelles` VALUES (374, 8, NULL, 344, 12, NULL, '2013-05-20', '0.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '4.0', 0, '2013-05-16', '2013-05-21') ; 
INSERT INTO `activitesreelles` VALUES (375, 8, NULL, 345, 12, NULL, '2013-05-27', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '5.0', 0, '2013-05-16', '2013-05-21') ; 
INSERT INTO `activitesreelles` VALUES (376, 12, NULL, 338, 5, NULL, '2013-05-06', '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '3.0', 0, '2013-05-16', '2013-05-21') ; 
INSERT INTO `activitesreelles` VALUES (377, 12, NULL, 339, 5, NULL, '2013-05-13', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '5.0', 0, '2013-05-16', '2013-05-21') ; 
INSERT INTO `activitesreelles` VALUES (378, 12, NULL, 340, 24, NULL, '2013-05-20', '0.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '4.0', 0, '2013-05-16', '2013-05-21') ; 
INSERT INTO `activitesreelles` VALUES (379, 12, NULL, 341, 24, NULL, '2013-05-27', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '5.0', 0, '2013-05-16', '2013-05-21') ; 
INSERT INTO `activitesreelles` VALUES (380, 4, NULL, 517, 17, 1, '2013-05-06', '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '2.0', 0, '2013-05-16', '2013-05-21') ; 
INSERT INTO `activitesreelles` VALUES (381, 4, NULL, 515, 17, 1, '2013-05-13', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '5.0', 0, '2013-05-16', '2013-05-21') ; 
INSERT INTO `activitesreelles` VALUES (382, 4, NULL, 514, 16, 1, '2013-05-20', '0.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '4.0', 0, '2013-05-16', '2013-05-21') ; 
INSERT INTO `activitesreelles` VALUES (383, 4, NULL, 513, 16, 1, '2013-05-27', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '5.0', 0, '2013-05-16', '2013-05-21') ; 
INSERT INTO `activitesreelles` VALUES (384, 17, NULL, 232, 16, 16, '2013-05-06', '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '3.0', 0, '2013-05-16', '2013-05-16') ; 
INSERT INTO `activitesreelles` VALUES (385, 17, NULL, 231, 16, 16, '2013-05-13', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '4.0', 0, '2013-05-16', '2013-05-16') ; 
INSERT INTO `activitesreelles` VALUES (386, 17, NULL, 229, 16, 16, '2013-05-20', '0.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '4.0', 0, '2013-05-16', '2013-05-16') ; 
INSERT INTO `activitesreelles` VALUES (387, 17, NULL, 228, 16, 16, '2013-05-27', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '5.0', 0, '2013-05-16', '2013-05-16') ; 
INSERT INTO `activitesreelles` VALUES (388, 265, NULL, 237, 24, 10, '2013-05-06', '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '2.0', 0, '2013-05-16', '2013-05-16') ; 
INSERT INTO `activitesreelles` VALUES (389, 265, NULL, 235, 24, 10, '2013-05-13', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '5.0', 0, '2013-05-16', '2013-05-16') ; 
INSERT INTO `activitesreelles` VALUES (390, 265, NULL, 234, 24, 10, '2013-05-20', '0.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '4.0', 0, '2013-05-16', '2013-05-16') ; 
INSERT INTO `activitesreelles` VALUES (391, 265, NULL, 233, 27, 10, '2013-05-27', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '5.0', 0, '2013-05-16', '2013-05-16') ; 
INSERT INTO `activitesreelles` VALUES (392, 268, NULL, 241, 1, NULL, '2013-05-06', '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '1.0', 0, '2013-05-16', '2013-05-16') ; 
INSERT INTO `activitesreelles` VALUES (393, 268, NULL, 242, 21, 16, '2013-05-06', '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '2.0', 0, '2013-05-16', '2013-05-16') ; 
INSERT INTO `activitesreelles` VALUES (394, 268, NULL, 240, 21, 16, '2013-05-13', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '5.0', 0, '2013-05-16', '2013-05-16') ; 
INSERT INTO `activitesreelles` VALUES (395, 268, NULL, 239, 21, 16, '2013-05-20', '0.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '4.0', 0, '2013-05-16', '2013-05-16') ; 
INSERT INTO `activitesreelles` VALUES (396, 268, NULL, 238, 21, 16, '2013-05-27', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '5.0', 0, '2013-05-16', '2013-05-16') ; 
INSERT INTO `activitesreelles` VALUES (397, 140, NULL, 245, 21, 16, '2013-05-13', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '5.0', 0, '2013-05-16', '2013-05-16') ; 
INSERT INTO `activitesreelles` VALUES (398, 140, NULL, 244, 21, 16, '2013-05-20', '0.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '4.0', 0, '2013-05-16', '2013-05-16') ; 
INSERT INTO `activitesreelles` VALUES (399, 140, NULL, 243, 21, 16, '2013-05-27', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '5.0', 0, '2013-05-16', '2013-05-16') ; 
INSERT INTO `activitesreelles` VALUES (400, 272, NULL, 247, 21, 25, '2013-05-06', '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '2.0', 0, '2013-05-16', '2013-05-16') ; 
INSERT INTO `activitesreelles` VALUES (401, 36, NULL, 252, 1, NULL, '2013-05-06', '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '1.0', 0, '2013-05-16', '2013-05-16') ; 
INSERT INTO `activitesreelles` VALUES (402, 36, NULL, 253, 22, 13, '2013-05-06', '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '2.0', 0, '2013-05-16', '2013-05-16') ; 
INSERT INTO `activitesreelles` VALUES (403, 36, NULL, 250, 22, 13, '2013-05-13', '1.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 0, '2013-05-16', '2013-05-16') ; 
INSERT INTO `activitesreelles` VALUES (404, 36, NULL, 251, 16, 13, '2013-05-13', '0.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '4.0', 0, '2013-05-16', '2013-05-16') ; 
INSERT INTO `activitesreelles` VALUES (405, 36, NULL, 249, 22, 13, '2013-05-20', '0.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '4.0', 0, '2013-05-16', '2013-05-16') ; 
INSERT INTO `activitesreelles` VALUES (406, 36, NULL, 248, 22, 13, '2013-05-27', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '5.0', 0, '2013-05-16', '2013-05-16') ; 
INSERT INTO `activitesreelles` VALUES (407, 171, NULL, 258, 28, 13, '2013-05-06', '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '2.0', 0, '2013-05-16', '2013-05-16') ; 
INSERT INTO `activitesreelles` VALUES (408, 171, NULL, 256, 23, 13, '2013-05-13', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '5.0', 0, '2013-05-16', '2013-05-16') ; 
INSERT INTO `activitesreelles` VALUES (409, 171, NULL, 255, 23, 13, '2013-05-20', '0.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '4.0', 0, '2013-05-16', '2013-05-16') ; 
INSERT INTO `activitesreelles` VALUES (410, 171, NULL, 254, 23, 13, '2013-05-27', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '5.0', 0, '2013-05-16', '2013-05-16') ; 
INSERT INTO `activitesreelles` VALUES (411, 18, NULL, 262, 21, 16, '2013-05-06', '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '3.0', 0, '2013-05-16', '2013-05-16') ; 
INSERT INTO `activitesreelles` VALUES (412, 18, NULL, 261, 21, 16, '2013-05-13', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '5.0', 0, '2013-05-16', '2013-05-16') ; 
INSERT INTO `activitesreelles` VALUES (413, 18, NULL, 260, 21, 16, '2013-05-20', '0.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '4.0', 0, '2013-05-16', '2013-05-16') ; 
INSERT INTO `activitesreelles` VALUES (414, 18, NULL, 259, 21, 16, '2013-05-27', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '5.0', 0, '2013-05-16', '2013-05-16') ; 
INSERT INTO `activitesreelles` VALUES (415, 172, NULL, 270, 27, 10, '2013-05-06', '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '2.0', 0, '2013-05-16', '2013-05-16') ; 
INSERT INTO `activitesreelles` VALUES (416, 172, NULL, 267, 27, 10, '2013-05-13', '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '2.0', 0, '2013-05-16', '2013-05-16') ; 
INSERT INTO `activitesreelles` VALUES (417, 172, NULL, 268, 24, 10, '2013-05-13', '0.0', 1, '0.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '3.0', 0, '2013-05-16', '2013-05-16') ; 
INSERT INTO `activitesreelles` VALUES (418, 172, NULL, 266, 24, 10, '2013-05-20', '0.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.5', 1, '0.0', 1, '0.0', 1, '3.5', 0, '2013-05-16', '2013-05-16') ; 
INSERT INTO `activitesreelles` VALUES (419, 172, NULL, 264, 24, 10, '2013-05-27', '0.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '4.0', 0, '2013-05-16', '2013-05-16') ; 
INSERT INTO `activitesreelles` VALUES (420, 237, NULL, 275, 23, 13, '2013-05-06', '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '3.0', 0, '2013-05-16', '2013-05-16') ; 
INSERT INTO `activitesreelles` VALUES (421, 237, NULL, 273, 23, 13, '2013-05-13', '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '3.0', 0, '2013-05-16', '2013-05-16') ; 
INSERT INTO `activitesreelles` VALUES (422, 237, NULL, 274, 14, 13, '2013-05-13', '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '2.0', 0, '2013-05-16', '2013-05-16') ; 
INSERT INTO `activitesreelles` VALUES (423, 237, NULL, 272, 14, 13, '2013-05-20', '0.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '4.0', 0, '2013-05-16', '2013-05-16') ; 
INSERT INTO `activitesreelles` VALUES (424, 237, NULL, 271, 14, 13, '2013-05-27', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '5.0', 0, '2013-05-16', '2013-05-16') ; 
INSERT INTO `activitesreelles` VALUES (425, 33, NULL, 280, 21, 16, '2013-05-06', '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '2.0', 0, '2013-05-16', '2013-05-16') ; 
INSERT INTO `activitesreelles` VALUES (426, 33, NULL, 278, 21, 16, '2013-05-13', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '5.0', 0, '2013-05-16', '2013-05-16') ; 
INSERT INTO `activitesreelles` VALUES (427, 33, NULL, 277, 21, 16, '2013-05-20', '0.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '4.0', 0, '2013-05-16', '2013-05-16') ; 
INSERT INTO `activitesreelles` VALUES (428, 33, NULL, 276, 21, 16, '2013-05-27', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '5.0', 0, '2013-05-16', '2013-05-16') ; 
INSERT INTO `activitesreelles` VALUES (429, 38, NULL, 283, 1, NULL, '2013-05-13', '0.0', 1, '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 0, '2013-05-16', '2013-05-16') ; 
INSERT INTO `activitesreelles` VALUES (430, 38, NULL, 286, 22, 13, '2013-05-06', '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '2.0', 0, '2013-05-16', '2013-05-16') ; 
INSERT INTO `activitesreelles` VALUES (431, 38, NULL, 284, 22, 13, '2013-05-13', '1.0', 1, '1.0', 1, '0.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '4.0', 0, '2013-05-16', '2013-05-16') ; 
INSERT INTO `activitesreelles` VALUES (432, 38, NULL, 282, 22, 13, '2013-05-20', '0.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '4.0', 0, '2013-05-16', '2013-05-16') ; 
INSERT INTO `activitesreelles` VALUES (433, 38, NULL, 281, 22, 13, '2013-05-27', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '5.0', 0, '2013-05-16', '2013-05-16') ; 
INSERT INTO `activitesreelles` VALUES (434, 261, NULL, 289, 16, 16, '2013-05-13', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '5.0', 0, '2013-05-16', '2013-05-16') ; 
INSERT INTO `activitesreelles` VALUES (435, 261, NULL, 288, 16, 16, '2013-05-20', '0.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '4.0', 0, '2013-05-16', '2013-05-16') ; 
INSERT INTO `activitesreelles` VALUES (436, 261, NULL, 287, 16, 16, '2013-05-27', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '5.0', 0, '2013-05-16', '2013-05-16') ; 
INSERT INTO `activitesreelles` VALUES (437, 40, NULL, 293, 1, NULL, '2013-05-20', '0.0', 1, '0.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '2.0', 0, '2013-05-16', '2013-05-16') ; 
INSERT INTO `activitesreelles` VALUES (438, 40, NULL, 291, 1, NULL, '2013-05-27', '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '1.0', 0, '2013-05-16', '2013-05-16') ; 
INSERT INTO `activitesreelles` VALUES (439, 40, NULL, 295, 21, 7, '2013-05-13', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '5.0', 0, '2013-05-16', '2013-05-16') ; 
INSERT INTO `activitesreelles` VALUES (440, 40, NULL, 294, 21, 7, '2013-05-20', '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '2.0', 0, '2013-05-16', '2013-05-16') ; 
INSERT INTO `activitesreelles` VALUES (441, 40, NULL, 292, 16, 7, '2013-05-27', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '4.0', 0, '2013-05-16', '2013-05-16') ; 
INSERT INTO `activitesreelles` VALUES (442, 176, NULL, 298, 1, NULL, '2013-05-20', '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '2.0', 0, '2013-05-16', '2013-05-16') ; 
INSERT INTO `activitesreelles` VALUES (443, 176, NULL, 300, 24, 13, '2013-05-13', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '5.0', 0, '2013-05-16', '2013-05-16') ; 
INSERT INTO `activitesreelles` VALUES (444, 176, NULL, 299, 24, 13, '2013-05-20', '0.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '2.0', 0, '2013-05-16', '2013-05-16') ; 
INSERT INTO `activitesreelles` VALUES (445, 176, NULL, 297, 27, 13, '2013-05-27', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '5.0', 0, '2013-05-16', '2013-05-16') ; 
INSERT INTO `activitesreelles` VALUES (446, 7, NULL, 350, 33, 27, '2013-05-06', '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '2.0', 0, '2013-05-16', '2013-05-21') ; 
INSERT INTO `activitesreelles` VALUES (447, 7, NULL, 354, 31, 1, '2013-05-13', '1.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '2.0', 0, '2013-05-16', '2013-05-21') ; 
INSERT INTO `activitesreelles` VALUES (448, 7, NULL, 356, 28, 14, '2013-05-13', '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 0, '2013-05-16', '2013-05-21') ; 
INSERT INTO `activitesreelles` VALUES (449, 7, NULL, 358, 28, 12, '2013-05-13', '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 0, '2013-05-16', '2013-05-21') ; 
INSERT INTO `activitesreelles` VALUES (450, 7, NULL, 366, 28, 3, '2013-05-27', '1.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 0, '2013-05-16', '2013-05-21') ; 
INSERT INTO `activitesreelles` VALUES (451, 7, NULL, 368, 29, 1, '2013-05-27', '0.0', 1, '1.0', 1, '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '2.0', 0, '2013-05-16', '2013-05-21') ; 
INSERT INTO `activitesreelles` VALUES (452, 7, NULL, 370, 30, NULL, '2013-05-27', '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '1.0', 0, '2013-05-16', '2013-05-21') ; 
INSERT INTO `activitesreelles` VALUES (453, 14, NULL, NULL, 1, NULL, '2013-06-03', '0.0', 1, '0.0', 1, '0.5', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.5', 1, '2013-05-16', '2013-05-16') ; 
INSERT INTO `activitesreelles` VALUES (454, 14, NULL, NULL, 3, NULL, '2013-07-15', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '5.0', 1, '2013-05-16', '2013-05-16') ; 
INSERT INTO `activitesreelles` VALUES (455, 14, NULL, NULL, 3, NULL, '2013-07-22', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '5.0', 1, '2013-05-16', '2013-05-16') ; 
INSERT INTO `activitesreelles` VALUES (456, 14, NULL, NULL, 3, NULL, '2013-07-29', '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '2.0', 1, '2013-05-16', '2013-05-16') ; 
INSERT INTO `activitesreelles` VALUES (457, 14, NULL, NULL, 2, NULL, '2013-07-29', '0.0', 1, '0.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '3.0', 1, '2013-05-16', '2013-05-16') ; 
INSERT INTO `activitesreelles` VALUES (458, 14, NULL, NULL, 2, NULL, '2013-08-12', '1.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '2013-05-16', '2013-05-16') ; 
INSERT INTO `activitesreelles` VALUES (459, 14, NULL, NULL, 1, NULL, '2013-08-12', '0.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '3.0', 1, '2013-05-16', '2013-05-16') ; 
INSERT INTO `activitesreelles` VALUES (460, 14, NULL, NULL, 1, NULL, '2013-08-19', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '5.0', 1, '2013-05-16', '2013-05-16') ; 
INSERT INTO `activitesreelles` VALUES (461, 230, NULL, 326, 21, 13, '2013-05-13', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '5.0', 0, '2013-05-17', '2013-05-21') ; 
INSERT INTO `activitesreelles` VALUES (462, 230, NULL, 327, 25, 13, '2013-05-20', '0.0', 1, '0.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '3.0', 0, '2013-05-17', '2013-05-21') ; 
INSERT INTO `activitesreelles` VALUES (463, 230, NULL, 328, 1, NULL, '2013-05-20', '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 0, '2013-05-17', '2013-05-21') ; 
INSERT INTO `activitesreelles` VALUES (464, 230, NULL, 325, 15, 13, '2013-05-06', '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '2.0', 0, '2013-05-17', '2013-05-21') ; 
INSERT INTO `activitesreelles` VALUES (465, 230, NULL, 329, 26, 13, '2013-05-27', '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '2.0', 0, '2013-05-17', '2013-05-21') ; 
INSERT INTO `activitesreelles` VALUES (466, 230, NULL, 330, 21, 13, '2013-05-27', '0.0', 1, '0.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '3.0', 0, '2013-05-17', '2013-05-21') ; 
INSERT INTO `activitesreelles` VALUES (467, 13, NULL, 392, 34, 1, '2013-05-27', '1.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.5', 1, '0.0', 1, '0.0', 1, '1.5', 0, '2013-05-17', '2013-05-21') ; 
INSERT INTO `activitesreelles` VALUES (468, 13, NULL, 394, 13, 8, '2013-05-27', '0.0', 1, '1.0', 1, '0.0', 1, '1.0', 1, '0.5', 1, '0.0', 1, '0.0', 1, '2.5', 0, '2013-05-17', '2013-05-21') ; 
INSERT INTO `activitesreelles` VALUES (469, 13, NULL, 374, 38, 8, '2013-05-06', '1.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 0, '2013-05-17', '2013-05-21') ; 
INSERT INTO `activitesreelles` VALUES (470, 13, NULL, 376, 34, 1, '2013-05-06', '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 0, '2013-05-17', '2013-05-21') ; 
INSERT INTO `activitesreelles` VALUES (471, 13, NULL, 386, 13, 8, '2013-05-20', '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '2.0', 0, '2013-05-17', '2013-05-21') ; 
INSERT INTO `activitesreelles` VALUES (472, 13, NULL, 388, 34, 1, '2013-05-20', '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 0, '2013-05-17', '2013-05-21') ; 
INSERT INTO `activitesreelles` VALUES (473, 13, NULL, 380, 13, 8, '2013-05-13', '0.0', 1, '0.5', 1, '0.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '2.5', 0, '2013-05-17', '2013-05-21') ; 
INSERT INTO `activitesreelles` VALUES (474, 13, NULL, 382, 38, 8, '2013-05-13', '0.0', 1, '0.5', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.5', 0, '2013-05-17', '2013-05-21') ; 
INSERT INTO `activitesreelles` VALUES (475, 6, NULL, 332, 18, 17, '2013-05-13', '0.0', 1, '1.0', 1, '0.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '3.0', 0, '2013-05-17', '2013-05-21') ; 
INSERT INTO `activitesreelles` VALUES (476, 6, NULL, 335, 21, 5, '2013-05-13', '1.0', 1, '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '2.0', 0, '2013-05-17', '2013-05-21') ; 
INSERT INTO `activitesreelles` VALUES (477, 6, NULL, 333, 18, 17, '2013-05-20', '0.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '2.0', 0, '2013-05-17', '2013-05-21') ; 
INSERT INTO `activitesreelles` VALUES (478, 6, NULL, 334, 21, 5, '2013-05-20', '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '2.0', 0, '2013-05-17', '2013-05-21') ; 
INSERT INTO `activitesreelles` VALUES (479, 6, NULL, 336, 16, 6, '2013-05-27', '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '3.0', 0, '2013-05-17', '2013-05-21') ; 
INSERT INTO `activitesreelles` VALUES (480, 6, NULL, 337, 21, 5, '2013-05-27', '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '2.0', 0, '2013-05-17', '2013-05-21') ; 
INSERT INTO `activitesreelles` VALUES (489, 14, NULL, 483, 14, 28, '2013-05-20', '0.0', 1, '0.5', 1, '0.0', 1, '0.5', 1, '1.0', 1, '0.0', 1, '0.0', 1, '2.0', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `activitesreelles` VALUES (490, 0, NULL, 346, 0, NULL, '0000-00-00', '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '2013-05-21', '2013-05-21') ; 
INSERT INTO `activitesreelles` VALUES (491, 0, NULL, 347, 0, NULL, '0000-00-00', '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '2013-05-21', '2013-05-21') ; 
INSERT INTO `activitesreelles` VALUES (492, 9, NULL, NULL, 21, 7, '2013-05-06', '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '3.0', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `activitesreelles` VALUES (493, 9, NULL, NULL, 21, 7, '2013-05-13', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '5.0', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `activitesreelles` VALUES (494, 9, NULL, NULL, 21, 21, '2013-05-20', '0.0', 1, '0.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '3.0', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `activitesreelles` VALUES (495, 9, NULL, NULL, 21, 21, '2013-05-27', '0.0', 1, '0.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '3.0', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `activitesreelles` VALUES (496, 9, NULL, NULL, 1, NULL, '2013-05-20', '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `activitesreelles` VALUES (497, 34, NULL, 402, 1, NULL, '2013-05-13', '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '2.0', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `activitesreelles` VALUES (498, 34, NULL, 406, 1, NULL, '2013-05-20', '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `activitesreelles` VALUES (499, 34, NULL, 412, 1, NULL, '2013-05-27', '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '1.0', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `activitesreelles` VALUES (500, 34, NULL, 396, 23, 14, '2013-05-06', '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '2.0', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `activitesreelles` VALUES (501, 34, NULL, 398, 13, 14, '2013-05-06', '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '1.0', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `activitesreelles` VALUES (502, 34, NULL, 404, 13, 14, '2013-05-13', '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '3.0', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `activitesreelles` VALUES (503, 34, NULL, 408, 13, 14, '2013-05-20', '0.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '2.0', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `activitesreelles` VALUES (504, 34, NULL, 410, 14, 14, '2013-05-20', '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '1.0', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `activitesreelles` VALUES (505, 34, NULL, 414, 14, 14, '2013-05-27', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '4.0', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `activitesreelles` VALUES (506, 10, NULL, 416, 16, 25, '2013-05-06', '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '3.0', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `activitesreelles` VALUES (507, 10, NULL, 418, 16, 25, '2013-05-13', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '5.0', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `activitesreelles` VALUES (508, 10, NULL, 420, 16, 25, '2013-05-20', '0.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '4.0', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `activitesreelles` VALUES (509, 10, NULL, 422, 16, 25, '2013-05-27', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '5.0', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `activitesreelles` VALUES (510, 255, NULL, 427, 24, 20, '2013-05-06', '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '2.0', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `activitesreelles` VALUES (511, 255, NULL, 429, 24, 20, '2013-05-13', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '5.0', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `activitesreelles` VALUES (512, 255, NULL, 431, 24, 20, '2013-05-20', '0.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '4.0', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `activitesreelles` VALUES (513, 255, NULL, 433, 24, 20, '2013-05-27', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '5.0', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `activitesreelles` VALUES (514, 11, NULL, 437, 1, NULL, '2013-05-06', '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '3.0', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `activitesreelles` VALUES (515, 11, NULL, 439, 14, 9, '2013-05-13', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '5.0', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `activitesreelles` VALUES (516, 11, NULL, 441, 14, 9, '2013-05-20', '0.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '2.0', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `activitesreelles` VALUES (517, 11, NULL, 443, 23, 9, '2013-05-20', '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '2.0', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `activitesreelles` VALUES (518, 11, NULL, 445, 23, 9, '2013-05-27', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '5.0', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `activitesreelles` VALUES (519, 231, NULL, 449, 16, 14, '2013-05-13', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '5.0', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `activitesreelles` VALUES (520, 231, NULL, 451, 16, 14, '2013-05-20', '0.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '4.0', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `activitesreelles` VALUES (521, 231, NULL, 453, 16, 14, '2013-05-27', '1.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `activitesreelles` VALUES (522, 231, NULL, 455, 22, 14, '2013-05-27', '0.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '4.0', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `activitesreelles` VALUES (523, 231, NULL, NULL, 22, 14, '2013-06-03', '0.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '4.0', 1, '2013-05-21', '2013-05-21') ; 
INSERT INTO `activitesreelles` VALUES (524, 16, NULL, 458, 22, 16, '2013-05-06', '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '3.0', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `activitesreelles` VALUES (525, 16, NULL, 460, 22, 16, '2013-05-13', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '5.0', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `activitesreelles` VALUES (526, 16, NULL, 462, 22, 16, '2013-05-20', '0.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '4.0', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `activitesreelles` VALUES (527, 16, NULL, 464, 22, 16, '2013-05-27', '0.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '4.0', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `activitesreelles` VALUES (528, 16, NULL, NULL, 22, 16, '2013-06-03', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '5.0', 1, '2013-05-21', '2013-05-21') ; 
INSERT INTO `activitesreelles` VALUES (529, 16, NULL, 466, 1, NULL, '2013-05-27', '1.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `activitesreelles` VALUES (530, 14, NULL, 485, 13, 13, '2013-05-20', '0.0', 1, '0.5', 1, '1.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '1.5', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `activitesreelles` VALUES (531, 14, NULL, 487, 28, 13, '2013-05-20', '0.0', 1, '0.0', 1, '0.0', 1, '0.5', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.5', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `activitesreelles` VALUES (532, 14, NULL, 489, 14, 9, '2013-05-27', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '5.0', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `activitesreelles` VALUES (533, 22, NULL, 497, 21, NULL, '2013-05-13', '1.0', 1, '0.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '3.0', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `activitesreelles` VALUES (534, 22, NULL, 499, 35, NULL, '2013-05-13', '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `activitesreelles` VALUES (535, 22, NULL, 501, 26, NULL, '2013-05-13', '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '1.0', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `activitesreelles` VALUES (536, 22, NULL, 503, 21, 13, '2013-05-20', '0.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '3.0', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `activitesreelles` VALUES (537, 22, NULL, 505, 26, 10, '2013-05-20', '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '1.0', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `activitesreelles` VALUES (538, 22, NULL, 507, 21, 13, '2013-05-27', '1.0', 1, '1.0', 1, '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '4.0', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `activitesreelles` VALUES (539, 22, NULL, 509, 26, 10, '2013-05-27', '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '1.0', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `activitesreelles` VALUES (540, 22, NULL, 495, 21, 13, '2013-05-06', '1.0', 1, '1.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '0.0', 1, '2.0', 0, '2013-05-21', '2013-05-21') ;
#
# End of data contents of table activitesreelles
# --------------------------------------------------------

# WordPress : buffernow.com MySQL database backup
#
# Generated: Thursday 23. May 2013 19:38 CEST
# Hostname: localhost
# Database: `saill_200`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `achats`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `actions`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `actionslivrables`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `activites`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `activitesreelles`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `affectations`
# --------------------------------------------------------


#
# Delete any existing table `affectations`
#

DROP TABLE IF EXISTS `affectations`;


#
# Table structure of table `affectations`
#

CREATE TABLE `affectations` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `utilisateur_id` int(15) NOT NULL,
  `activite_id` int(15) NOT NULL,
  `REPARTITION` int(11) DEFAULT NULL,
  `created` date NOT NULL,
  `modified` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=277 DEFAULT CHARSET=utf8 ;

#
# Data contents of table affectations (271 records)
#
 
INSERT INTO `affectations` VALUES (1, 4, 1, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (2, 4, 2, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (3, 4, 5, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (4, 4, 6, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (5, 4, 7, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (6, 4, 8, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (7, 4, 4, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (8, 4, 9, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (9, 4, 12, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (10, 9, 1, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (11, 9, 2, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (12, 9, 5, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (13, 9, 6, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (14, 9, 7, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (15, 9, 8, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (16, 9, 4, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (17, 9, 9, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (18, 9, 12, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (19, 6, 1, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (20, 6, 2, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (21, 6, 5, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (22, 6, 6, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (23, 6, 7, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (24, 6, 8, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (25, 6, 4, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (26, 6, 9, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (27, 6, 12, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (28, 10, 1, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (29, 10, 2, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (30, 10, 5, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (31, 10, 6, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (32, 10, 7, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (33, 10, 8, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (34, 10, 4, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (35, 10, 9, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (36, 10, 12, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (37, 7, 1, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (38, 7, 2, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (39, 7, 5, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (40, 7, 6, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (41, 7, 7, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (42, 7, 8, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (43, 7, 4, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (44, 7, 9, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (45, 7, 12, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (46, 12, 1, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (47, 12, 2, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (48, 12, 5, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (49, 12, 6, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (50, 12, 7, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (51, 12, 8, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (52, 12, 4, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (53, 12, 9, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (54, 12, 12, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (55, 5, 1, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (56, 5, 2, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (57, 5, 5, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (58, 5, 6, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (59, 5, 7, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (60, 5, 8, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (61, 5, 4, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (62, 5, 9, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (63, 5, 12, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (64, 255, 1, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (65, 255, 2, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (66, 255, 5, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (67, 255, 6, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (68, 255, 7, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (69, 255, 8, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (70, 255, 4, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (71, 255, 9, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (72, 255, 12, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (73, 11, 1, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (74, 11, 2, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (75, 11, 5, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (76, 11, 6, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (77, 11, 7, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (78, 11, 8, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (79, 11, 4, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (80, 11, 9, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (81, 11, 12, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (82, 8, 1, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (83, 8, 2, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (84, 8, 5, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (85, 8, 6, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (86, 8, 7, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (87, 8, 8, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (88, 8, 4, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (89, 8, 9, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (90, 8, 12, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (91, 230, 1, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (92, 230, 2, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (93, 230, 5, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (94, 230, 6, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (95, 230, 7, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (96, 230, 8, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (97, 230, 4, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (98, 230, 9, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (99, 230, 12, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (100, 34, 1, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (101, 34, 2, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (102, 34, 5, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (103, 34, 6, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (104, 34, 7, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (105, 34, 8, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (106, 34, 4, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (107, 34, 9, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (108, 34, 12, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (109, 3, 1, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (110, 3, 2, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (111, 3, 5, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (112, 3, 6, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (113, 3, 7, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (114, 3, 8, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (115, 3, 4, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (116, 3, 9, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (117, 3, 12, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (118, 35, 1, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (119, 35, 2, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (120, 35, 5, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (121, 35, 6, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (122, 35, 7, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (123, 35, 8, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (124, 35, 4, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (125, 35, 9, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (126, 35, 12, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (127, 231, 1, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (128, 231, 2, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (129, 231, 5, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (130, 231, 6, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (131, 231, 7, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (132, 231, 8, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (133, 231, 4, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (134, 231, 9, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (135, 231, 12, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (136, 13, 1, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (137, 13, 2, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (138, 13, 5, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (139, 13, 6, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (140, 13, 7, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (141, 13, 8, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (142, 13, 4, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (143, 13, 9, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (144, 13, 12, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (145, 39, 1, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (146, 39, 2, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (147, 39, 5, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (148, 39, 6, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (149, 39, 7, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (150, 39, 8, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (151, 39, 4, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (152, 39, 9, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (153, 39, 12, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (154, 16, 1, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (155, 16, 2, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (156, 16, 6, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (157, 16, 7, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (158, 16, 8, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (159, 16, 4, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (160, 16, 9, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (161, 16, 12, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (162, 14, 1, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (163, 14, 2, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (164, 14, 5, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (165, 14, 6, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (166, 14, 7, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (167, 14, 8, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (168, 14, 4, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (169, 14, 9, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (170, 14, 12, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (171, 22, 1, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (172, 22, 2, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (173, 22, 6, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (174, 22, 7, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (175, 22, 8, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (176, 22, 4, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (177, 22, 9, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (178, 22, 12, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (179, 172, 1, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (180, 40, 1, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (181, 17, 1, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (182, 140, 1, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (183, 36, 1, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (184, 171, 1, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (185, 18, 1, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (186, 237, 1, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (187, 33, 1, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (188, 38, 1, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (189, 261, 1, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (190, 176, 1, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (191, 4, 17, 50, '2013-03-26', '2013-03-26') ; 
INSERT INTO `affectations` VALUES (192, 4, 16, 50, '2013-03-26', '2013-03-26') ; 
INSERT INTO `affectations` VALUES (193, 9, 21, 50, '2013-03-26', '2013-03-26') ; 
INSERT INTO `affectations` VALUES (194, 9, 22, 50, '2013-03-26', '2013-03-26') ; 
INSERT INTO `affectations` VALUES (195, 6, 22, 100, '2013-03-26', '2013-03-26') ; 
INSERT INTO `affectations` VALUES (196, 10, 16, 100, '2013-03-26', '2013-03-26') ; 
INSERT INTO `affectations` VALUES (197, 7, 28, 30, '2013-03-26', '2013-03-26') ; 
INSERT INTO `affectations` VALUES (198, 7, 30, 15, '2013-03-26', '2013-03-26') ; 
INSERT INTO `affectations` VALUES (199, 7, 33, 15, '2013-03-26', '2013-03-26') ; 
INSERT INTO `affectations` VALUES (200, 7, 32, 10, '2013-03-26', '2013-03-26') ; 
INSERT INTO `affectations` VALUES (201, 7, 31, 10, '2013-03-26', '2013-03-26') ; 
INSERT INTO `affectations` VALUES (202, 172, 24, 70, '2013-03-26', '2013-03-26') ; 
INSERT INTO `affectations` VALUES (203, 172, 27, 30, '2013-03-26', '2013-03-26') ; 
INSERT INTO `affectations` VALUES (204, 12, 27, 20, '2013-03-26', '2013-03-26') ; 
INSERT INTO `affectations` VALUES (205, 12, 24, 60, '2013-03-26', '2013-03-26') ; 
INSERT INTO `affectations` VALUES (206, 5, 21, 80, '2013-03-26', '2013-03-26') ; 
INSERT INTO `affectations` VALUES (207, 255, 24, 100, '2013-03-26', '2013-03-26') ; 
INSERT INTO `affectations` VALUES (208, 40, 21, 50, '2013-03-26', '2013-03-26') ; 
INSERT INTO `affectations` VALUES (209, 40, 16, 50, '2013-03-26', '2013-03-26') ; 
INSERT INTO `affectations` VALUES (210, 11, 14, 50, '2013-03-26', '2013-03-26') ; 
INSERT INTO `affectations` VALUES (211, 11, 23, 50, '2013-03-26', '2013-03-26') ; 
INSERT INTO `affectations` VALUES (212, 8, 24, 50, '2013-03-26', '2013-03-26') ; 
INSERT INTO `affectations` VALUES (213, 8, 27, 30, '2013-03-26', '2013-03-26') ; 
INSERT INTO `affectations` VALUES (214, 17, 22, 100, '2013-03-26', '2013-03-26') ; 
INSERT INTO `affectations` VALUES (215, 230, 22, 80, '2013-03-26', '2013-03-26') ; 
INSERT INTO `affectations` VALUES (216, 230, 24, 20, '2013-03-26', '2013-03-26') ; 
INSERT INTO `affectations` VALUES (217, 140, 16, 100, '2013-03-26', '2013-03-26') ; 
INSERT INTO `affectations` VALUES (218, 36, 16, 20, '2013-03-26', '2013-03-26') ; 
INSERT INTO `affectations` VALUES (219, 36, 22, 80, '2013-03-26', '2013-03-26') ; 
INSERT INTO `affectations` VALUES (220, 34, 13, 20, '2013-03-26', '2013-03-26') ; 
INSERT INTO `affectations` VALUES (221, 34, 38, 50, '2013-03-26', '2013-03-26') ; 
INSERT INTO `affectations` VALUES (222, 34, 14, 25, '2013-03-26', '2013-03-26') ; 
INSERT INTO `affectations` VALUES (223, 34, 23, 5, '2013-03-26', '2013-03-26') ; 
INSERT INTO `affectations` VALUES (224, 171, 23, 70, '2013-03-26', '2013-03-26') ; 
INSERT INTO `affectations` VALUES (225, 171, 30, 10, '2013-03-26', '2013-03-26') ; 
INSERT INTO `affectations` VALUES (226, 171, 28, 20, '2013-03-26', '2013-03-26') ; 
INSERT INTO `affectations` VALUES (227, 18, 21, 100, '2013-03-26', '2013-03-26') ; 
INSERT INTO `affectations` VALUES (228, 3, 16, 20, '2013-03-26', '2013-03-26') ; 
INSERT INTO `affectations` VALUES (229, 3, 17, 80, '2013-03-26', '2013-03-26') ; 
INSERT INTO `affectations` VALUES (230, 237, 14, 55, '2013-03-26', '2013-03-26') ; 
INSERT INTO `affectations` VALUES (231, 237, 23, 45, '2013-03-26', '2013-03-26') ; 
INSERT INTO `affectations` VALUES (232, 35, 16, 30, '2013-03-26', '2013-03-26') ; 
INSERT INTO `affectations` VALUES (233, 35, 19, 70, '2013-03-26', '2013-03-26') ; 
INSERT INTO `affectations` VALUES (234, 33, 21, 100, '2013-03-26', '2013-03-26') ; 
INSERT INTO `affectations` VALUES (235, 38, 22, 100, '2013-03-26', '2013-03-26') ; 
INSERT INTO `affectations` VALUES (236, 261, 16, 100, '2013-03-26', '2013-03-26') ; 
INSERT INTO `affectations` VALUES (237, 231, 16, 50, '2013-03-26', '2013-03-26') ; 
INSERT INTO `affectations` VALUES (238, 231, 21, 25, '2013-03-26', '2013-03-26') ; 
INSERT INTO `affectations` VALUES (239, 231, 22, 25, '2013-03-26', '2013-03-26') ; 
INSERT INTO `affectations` VALUES (240, 176, 24, 50, '2013-03-26', '2013-03-26') ; 
INSERT INTO `affectations` VALUES (241, 176, 27, 50, '2013-03-26', '2013-03-26') ; 
INSERT INTO `affectations` VALUES (242, 13, 13, 20, '2013-03-26', '2013-03-26') ; 
INSERT INTO `affectations` VALUES (243, 13, 38, 40, '2013-03-26', '2013-03-26') ; 
INSERT INTO `affectations` VALUES (244, 13, 34, 20, '2013-03-26', '2013-03-26') ; 
INSERT INTO `affectations` VALUES (245, 39, 39, 100, '2013-03-26', '2013-03-26') ; 
INSERT INTO `affectations` VALUES (246, 16, 22, 100, '2013-03-26', '2013-03-26') ; 
INSERT INTO `affectations` VALUES (247, 14, 14, 60, '2013-03-26', '2013-03-26') ; 
INSERT INTO `affectations` VALUES (248, 14, 28, 20, '2013-03-26', '2013-03-26') ; 
INSERT INTO `affectations` VALUES (249, 22, 35, 40, '2013-03-26', '2013-03-26') ; 
INSERT INTO `affectations` VALUES (250, 22, 16, 20, '2013-03-26', '2013-03-26') ; 
INSERT INTO `affectations` VALUES (251, 22, 22, 20, '2013-03-26', '2013-03-26') ; 
INSERT INTO `affectations` VALUES (252, 22, 21, 20, '2013-03-26', '2013-03-26') ; 
INSERT INTO `affectations` VALUES (253, 263, 21, 20, '2013-03-26', '2013-03-26') ; 
INSERT INTO `affectations` VALUES (254, 264, 16, 70, '2013-03-26', '2013-03-26') ; 
INSERT INTO `affectations` VALUES (255, 264, 21, 30, '2013-03-26', '2013-03-26') ; 
INSERT INTO `affectations` VALUES (256, 264, 1, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (257, 264, 2, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (258, 264, 5, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (259, 264, 6, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (260, 264, 7, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (261, 264, 8, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (262, 264, 4, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (263, 264, 9, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (264, 264, 12, NULL, '2013-03-25', '2013-03-25') ; 
INSERT INTO `affectations` VALUES (265, 265, 1, NULL, '2013-03-26', '2013-03-26') ; 
INSERT INTO `affectations` VALUES (271, 265, 24, 50, '2013-03-26', '2013-03-26') ; 
INSERT INTO `affectations` VALUES (272, 265, 27, 50, '2013-03-26', '2013-03-26') ; 
INSERT INTO `affectations` VALUES (273, 268, 22, 100, '2013-03-28', '2013-03-28') ; 
INSERT INTO `affectations` VALUES (274, 268, 1, NULL, '2013-04-03', '2013-04-03') ; 
INSERT INTO `affectations` VALUES (275, 268, 5, NULL, '2013-04-03', '2013-04-03') ; 
INSERT INTO `affectations` VALUES (276, 272, 21, 10, '2013-04-11', '2013-04-11') ;
#
# End of data contents of table affectations
# --------------------------------------------------------

# WordPress : buffernow.com MySQL database backup
#
# Generated: Thursday 23. May 2013 19:38 CEST
# Hostname: localhost
# Database: `saill_200`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `achats`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `actions`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `actionslivrables`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `activites`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `activitesreelles`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `affectations`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `assistances`
# --------------------------------------------------------


#
# Delete any existing table `assistances`
#

DROP TABLE IF EXISTS `assistances`;


#
# Table structure of table `assistances`
#

CREATE TABLE `assistances` (
  `ID` int(15) NOT NULL AUTO_INCREMENT,
  `NOM` varchar(255) CHARACTER SET latin1 NOT NULL,
  `DESCRIPTION` longtext CHARACTER SET latin1,
  `created` date NOT NULL,
  `modified` date NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ;

#
# Data contents of table assistances (2 records)
#
 
INSERT INTO `assistances` VALUES (1, 'SAMBA', 'Assistance utilisé par DSIT', '2013-02-01', '2013-02-01') ; 
INSERT INTO `assistances` VALUES (2, 'SAMU', 'Assistance localisée au 15T à PARIS en charge de la logistique pour le MATERIEL', '2013-02-01', '2013-02-01') ;
#
# End of data contents of table assistances
# --------------------------------------------------------

# WordPress : buffernow.com MySQL database backup
#
# Generated: Thursday 23. May 2013 19:38 CEST
# Hostname: localhost
# Database: `saill_200`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `achats`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `actions`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `actionslivrables`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `activites`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `activitesreelles`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `affectations`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `assistances`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `autorisations`
# --------------------------------------------------------


#
# Delete any existing table `autorisations`
#

DROP TABLE IF EXISTS `autorisations`;


#
# Table structure of table `autorisations`
#

CREATE TABLE `autorisations` (
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
  `ABSENCES` tinyint(1) NOT NULL DEFAULT '0',
  `RAPPORTS` tinyint(1) NOT NULL DEFAULT '0',
  `UPDATE` tinyint(1) NOT NULL DEFAULT '0',
  `MYPROFIL` varchar(45) NOT NULL DEFAULT '0',
  `created` date NOT NULL,
  `modified` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=99 DEFAULT CHARSET=utf8 ;

#
# Data contents of table autorisations (97 records)
#
 
INSERT INTO `autorisations` VALUES (1, 1, 'achats', 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, '0', '2013-02-01', '2013-02-01') ; 
INSERT INTO `autorisations` VALUES (2, 1, 'actions', 1, 1, 1, 1, 1, 1, 0, 0, 1, 0, '0', '2013-02-01', '2013-04-24') ; 
INSERT INTO `autorisations` VALUES (3, 1, 'activites', 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, '0', '2013-02-01', '2013-02-01') ; 
INSERT INTO `autorisations` VALUES (4, 1, 'affectations', 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, '0', '2013-02-01', '2013-02-01') ; 
INSERT INTO `autorisations` VALUES (5, 1, 'assistances', 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, '0', '2013-02-01', '2013-02-01') ; 
INSERT INTO `autorisations` VALUES (6, 1, 'autorisations', 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, '0', '2013-02-01', '2013-02-01') ; 
INSERT INTO `autorisations` VALUES (7, 1, 'contrats', 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, '0', '2013-02-01', '2013-02-01') ; 
INSERT INTO `autorisations` VALUES (8, 1, 'domaines', 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, '0', '2013-02-01', '2013-02-01') ; 
INSERT INTO `autorisations` VALUES (9, 1, 'dossierpartages', 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, '0', '2013-02-01', '2013-02-01') ; 
INSERT INTO `autorisations` VALUES (10, 1, 'dotations', 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, '1', '2013-02-01', '2013-05-21') ; 
INSERT INTO `autorisations` VALUES (11, 1, 'hitoryactions', 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, '0', '2013-02-01', '2013-02-01') ; 
INSERT INTO `autorisations` VALUES (12, 1, 'hitoryutilisateurs', 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, '0', '2013-02-01', '2013-02-01') ; 
INSERT INTO `autorisations` VALUES (13, 1, 'linkshareds', 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, '0', '2013-02-01', '2013-02-01') ; 
INSERT INTO `autorisations` VALUES (14, 1, 'listediffusions', 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, '0', '2013-02-01', '2013-02-01') ; 
INSERT INTO `autorisations` VALUES (15, 1, 'livrables', 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, '0', '2013-02-01', '2013-04-24') ; 
INSERT INTO `autorisations` VALUES (16, 1, 'materielinformatiques', 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, '0', '2013-02-01', '2013-04-24') ; 
INSERT INTO `autorisations` VALUES (17, 1, 'messages', 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, '0', '2013-02-01', '2013-02-01') ; 
INSERT INTO `autorisations` VALUES (18, 1, 'outils', 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, '0', '2013-02-01', '2013-02-01') ; 
INSERT INTO `autorisations` VALUES (19, 1, 'profils', 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, '0', '2013-02-01', '2013-04-24') ; 
INSERT INTO `autorisations` VALUES (20, 1, 'projets', 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, '0', '2013-02-01', '2013-02-01') ; 
INSERT INTO `autorisations` VALUES (21, 1, 'sections', 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, '0', '2013-02-01', '2013-02-01') ; 
INSERT INTO `autorisations` VALUES (22, 1, 'sites', 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, '0', '2013-02-01', '2013-02-01') ; 
INSERT INTO `autorisations` VALUES (23, 1, 'societes', 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, '0', '2013-02-01', '2013-02-01') ; 
INSERT INTO `autorisations` VALUES (24, 1, 'suivilivrables', 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, '0', '2013-02-01', '2013-02-01') ; 
INSERT INTO `autorisations` VALUES (25, 1, 'tjmagents', 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, '0', '2013-02-01', '2013-02-01') ; 
INSERT INTO `autorisations` VALUES (26, 1, 'tjmcontrats', 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, '0', '2013-02-01', '2013-02-01') ; 
INSERT INTO `autorisations` VALUES (27, 1, 'typemateriels', 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, '0', '2013-02-01', '2013-02-01') ; 
INSERT INTO `autorisations` VALUES (28, 1, 'utilisateurs', 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, '0', '2013-02-01', '2013-02-01') ; 
INSERT INTO `autorisations` VALUES (29, 1, 'utiliseoutils', 1, 1, 1, 1, 1, 0, 0, 0, 0, 1, '0', '2013-02-01', '2013-02-01') ; 
INSERT INTO `autorisations` VALUES (30, 1, 'actionslivrables', 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, '0', '2013-02-01', '2013-02-01') ; 
INSERT INTO `autorisations` VALUES (31, 1, 'activitesreelles', 1, 1, 1, 1, 1, 1, 0, 1, 1, 1, '0', '2013-02-01', '2013-02-01') ; 
INSERT INTO `autorisations` VALUES (32, 1, 'facturations', 1, 1, 1, 1, 1, 0, 0, 0, 1, 0, '0', '2013-02-01', '2013-02-01') ; 
INSERT INTO `autorisations` VALUES (33, 1, 'plancharges', 1, 1, 1, 1, 1, 0, 0, 0, 1, 0, '0', '2013-02-01', '2013-02-01') ; 
INSERT INTO `autorisations` VALUES (34, 1, 'rapports', 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, '0', '2013-02-01', '2013-02-01') ; 
INSERT INTO `autorisations` VALUES (35, 3, 'actions', 1, 1, 1, 1, 1, 1, 0, 0, 1, 0, '0', '2013-02-01', '2013-04-24') ; 
INSERT INTO `autorisations` VALUES (36, 3, 'activitesreelles', 1, 1, 1, 1, 1, 1, 0, 1, 1, 1, '0', '2013-02-01', '2013-05-21') ; 
INSERT INTO `autorisations` VALUES (37, 3, 'livrables', 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, '0', '2013-02-01', '2013-04-24') ; 
INSERT INTO `autorisations` VALUES (38, 3, 'materielinformatiques', 1, 0, 0, 1, 0, 0, 0, 0, 0, 0, '0', '2013-02-01', '2013-02-01') ; 
INSERT INTO `autorisations` VALUES (39, 3, 'utilisateurs', 1, 0, 0, 1, 0, 0, 0, 0, 0, 0, '0', '2013-02-01', '2013-02-01') ; 
INSERT INTO `autorisations` VALUES (40, 3, 'achats', 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, '0', '2013-02-01', '2013-02-01') ; 
INSERT INTO `autorisations` VALUES (41, 3, 'activites', 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, '0', '2013-02-01', '2013-02-01') ; 
INSERT INTO `autorisations` VALUES (42, 3, 'affectations', 1, 0, 0, 1, 0, 0, 0, 0, 0, 0, '0', '2013-02-01', '2013-02-01') ; 
INSERT INTO `autorisations` VALUES (43, 3, 'contrats', 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, '0', '2013-02-01', '2013-02-01') ; 
INSERT INTO `autorisations` VALUES (44, 3, 'domaines', 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, '0', '2013-02-01', '2013-02-01') ; 
INSERT INTO `autorisations` VALUES (45, 3, 'listediffusions', 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, '0', '2013-02-01', '2013-02-01') ; 
INSERT INTO `autorisations` VALUES (46, 3, 'messages', 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, '0', '2013-02-01', '2013-02-01') ; 
INSERT INTO `autorisations` VALUES (47, 3, 'projets', 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, '0', '2013-02-01', '2013-02-01') ; 
INSERT INTO `autorisations` VALUES (48, 3, 'societes', 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, '0', '2013-02-01', '2013-02-01') ; 
INSERT INTO `autorisations` VALUES (49, 3, 'suivilivrables', 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, '0', '2013-02-01', '2013-02-01') ; 
INSERT INTO `autorisations` VALUES (50, 3, 'tjmagents', 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, '0', '2013-02-01', '2013-02-01') ; 
INSERT INTO `autorisations` VALUES (51, 3, 'tjmcontrats', 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, '0', '2013-02-01', '2013-02-01') ; 
INSERT INTO `autorisations` VALUES (52, 4, 'actions', 1, 1, 1, 1, 1, 1, 0, 0, 1, 0, '0', '2013-02-01', '2013-05-14') ; 
INSERT INTO `autorisations` VALUES (53, 4, 'activitesreelles', 1, 1, 1, 1, 1, 1, 0, 1, 1, 1, '0', '2013-02-01', '2013-05-15') ; 
INSERT INTO `autorisations` VALUES (54, 4, 'livrables', 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, '0', '2013-02-01', '2013-04-24') ; 
INSERT INTO `autorisations` VALUES (55, 4, 'utilisateurs', 1, 0, 0, 1, 0, 0, 0, 0, 0, 0, '0', '2013-02-01', '2013-02-01') ; 
INSERT INTO `autorisations` VALUES (56, 4, 'affectations', 1, 0, 0, 1, 0, 0, 0, 0, 0, 0, '0', '2013-02-01', '2013-02-01') ; 
INSERT INTO `autorisations` VALUES (57, 4, 'listediffusions', 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, '0', '2013-02-01', '2013-02-01') ; 
INSERT INTO `autorisations` VALUES (58, 4, 'messages', 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, '0', '2013-02-01', '2013-02-01') ; 
INSERT INTO `autorisations` VALUES (59, 4, 'societes', 1, 0, 0, 1, 0, 0, 0, 0, 0, 0, '0', '2013-02-01', '2013-02-01') ; 
INSERT INTO `autorisations` VALUES (60, 4, 'suivilivrables', 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, '0', '2013-02-01', '2013-02-01') ; 
INSERT INTO `autorisations` VALUES (61, 4, 'materielinformatiques', 1, 0, 0, 1, 0, 0, 0, 0, 0, 0, '0', '2013-02-01', '2013-02-01') ; 
INSERT INTO `autorisations` VALUES (62, 5, 'actions', 1, 1, 1, 1, 1, 1, 0, 0, 1, 0, '0', '2013-02-01', '2013-05-14') ; 
INSERT INTO `autorisations` VALUES (63, 5, 'activitesreelles', 1, 1, 1, 1, 1, 1, 0, 1, 1, 1, '0', '2013-02-01', '2013-05-14') ; 
INSERT INTO `autorisations` VALUES (64, 5, 'livrables', 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, '0', '2013-02-01', '2013-04-24') ; 
INSERT INTO `autorisations` VALUES (65, 5, 'utilisateurs', 1, 0, 0, 1, 0, 0, 0, 0, 0, 0, '0', '2013-02-01', '2013-02-01') ; 
INSERT INTO `autorisations` VALUES (66, 5, 'affectations', 1, 0, 0, 1, 0, 0, 0, 0, 0, 0, '0', '2013-02-01', '2013-02-01') ; 
INSERT INTO `autorisations` VALUES (67, 5, 'listediffusions', 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, '0', '2013-02-01', '2013-02-01') ; 
INSERT INTO `autorisations` VALUES (68, 5, 'messages', 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, '0', '2013-02-01', '2013-02-01') ; 
INSERT INTO `autorisations` VALUES (69, 5, 'societes', 1, 0, 0, 1, 0, 0, 0, 0, 0, 0, '0', '2013-02-01', '2013-02-01') ; 
INSERT INTO `autorisations` VALUES (70, 5, 'suivilivrables', 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, '0', '2013-02-01', '2013-02-01') ; 
INSERT INTO `autorisations` VALUES (71, 5, 'materielinformatiques', 1, 0, 0, 1, 0, 0, 0, 0, 0, 0, '0', '2013-02-01', '2013-02-01') ; 
INSERT INTO `autorisations` VALUES (72, 5, 'utiliseoutils', 1, 0, 1, 1, 0, 0, 0, 0, 0, 1, '0', '2013-02-01', '2013-02-01') ; 
INSERT INTO `autorisations` VALUES (73, 6, 'actions', 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, '0', '2013-02-01', '2013-04-24') ; 
INSERT INTO `autorisations` VALUES (74, 6, 'activitesreelles', 1, 1, 1, 1, 1, 1, 0, 1, 0, 0, '0', '2013-02-01', '2013-02-01') ; 
INSERT INTO `autorisations` VALUES (75, 6, 'livrables', 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, '0', '2013-02-01', '2013-04-24') ; 
INSERT INTO `autorisations` VALUES (76, 9, 'activitesreelles', 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, '0', '2013-02-01', '2013-02-01') ; 
INSERT INTO `autorisations` VALUES (77, 10, 'actions', 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, '0', '2013-02-01', '2013-04-24') ; 
INSERT INTO `autorisations` VALUES (78, 10, 'activitesreelles', 1, 1, 1, 1, 1, 1, 0, 1, 0, 0, '0', '2013-02-01', '2013-02-01') ; 
INSERT INTO `autorisations` VALUES (79, 10, 'livrables', 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, '0', '2013-02-01', '2013-04-24') ; 
INSERT INTO `autorisations` VALUES (80, 10, 'utiliseoutils', 1, 0, 1, 1, 0, 0, 0, 0, 0, 1, '0', '2013-02-01', '2013-02-01') ; 
INSERT INTO `autorisations` VALUES (81, 8, 'materielinformatiques', 1, 0, 0, 1, 0, 0, 0, 0, 0, 0, '0', '2013-02-01', '2013-02-01') ; 
INSERT INTO `autorisations` VALUES (82, 8, 'utilisateurs', 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, '0', '2013-02-01', '2013-04-24') ; 
INSERT INTO `autorisations` VALUES (83, 8, 'dotations', 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, '0', '2013-04-15', '2013-04-15') ; 
INSERT INTO `autorisations` VALUES (84, 8, 'utiliseoutils', 1, 1, 0, 1, 0, 0, 0, 0, 0, 0, '0', '2013-04-15', '2013-04-24') ; 
INSERT INTO `autorisations` VALUES (85, 3, 'facturations', 1, 1, 1, 1, 0, 0, 0, 0, 1, 0, '0', '2013-04-15', '2013-04-15') ; 
INSERT INTO `autorisations` VALUES (86, 4, 'facturations', 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, '0', '2013-05-14', '2013-05-14') ; 
INSERT INTO `autorisations` VALUES (87, 4, 'plancharges', 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, '0', '2013-05-14', '2013-05-14') ; 
INSERT INTO `autorisations` VALUES (88, 5, 'facturations', 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, '0', '2013-05-14', '2013-05-14') ; 
INSERT INTO `autorisations` VALUES (90, 5, 'plancharges', 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, '0', '2013-05-14', '2013-05-14') ; 
INSERT INTO `autorisations` VALUES (91, 4, 'domaines', 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, '0', '2013-05-16', '2013-05-16') ; 
INSERT INTO `autorisations` VALUES (92, 5, 'domaines', 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, '0', '2013-05-16', '2013-05-16') ; 
INSERT INTO `autorisations` VALUES (93, 1, 'params', 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, '0', '2013-05-21', '2013-05-21') ; 
INSERT INTO `autorisations` VALUES (94, 6, 'dotations', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '1', '2013-05-21', '2013-05-21') ; 
INSERT INTO `autorisations` VALUES (95, 10, 'dotations', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '1', '2013-05-21', '2013-05-21') ; 
INSERT INTO `autorisations` VALUES (96, 3, 'dotations', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '1', '2013-05-21', '2013-05-21') ; 
INSERT INTO `autorisations` VALUES (97, 4, 'dotations', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '1', '2013-05-21', '2013-05-21') ; 
INSERT INTO `autorisations` VALUES (98, 5, 'dotations', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '1', '2013-05-21', '2013-05-21') ;
#
# End of data contents of table autorisations
# --------------------------------------------------------

# WordPress : buffernow.com MySQL database backup
#
# Generated: Thursday 23. May 2013 19:38 CEST
# Hostname: localhost
# Database: `saill_200`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `achats`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `actions`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `actionslivrables`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `activites`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `activitesreelles`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `affectations`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `assistances`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `autorisations`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `contrats`
# --------------------------------------------------------


#
# Delete any existing table `contrats`
#

DROP TABLE IF EXISTS `contrats`;


#
# Table structure of table `contrats`
#

CREATE TABLE `contrats` (
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 ;

#
# Data contents of table contrats (13 records)
#
 
INSERT INTO `contrats` VALUES (1, NULL, 'absences', '2012', NULL, NULL, 1, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `contrats` VALUES (2, 1, 'OSMOSE', '2008', '0000', NULL, 1, '', '2013-02-01', '2013-05-13') ; 
INSERT INTO `contrats` VALUES (3, 1, 'COHERENCE', '2009', '0000', NULL, 1, '', '2013-02-01', '2013-05-13') ; 
INSERT INTO `contrats` VALUES (4, 1, 'ORCHESTRAL', '2009', '0000', NULL, 1, '', '2013-02-01', '2013-05-13') ; 
INSERT INTO `contrats` VALUES (5, 1, 'SGRM', '2010', '0000', NULL, 1, '', '2013-02-01', '2013-05-13') ; 
INSERT INTO `contrats` VALUES (6, 1, 'PANAM', '2010', '0000', NULL, 1, '', '2013-02-01', '2013-05-13') ; 
INSERT INTO `contrats` VALUES (7, NULL, 'BAUME', '2010', NULL, NULL, 1, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `contrats` VALUES (8, NULL, 'EMC²', '2010', NULL, NULL, 1, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `contrats` VALUES (9, NULL, 'ITAC', '2010', NULL, NULL, 1, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `contrats` VALUES (10, NULL, 'URBANISME', '2010', NULL, NULL, 1, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `contrats` VALUES (11, NULL, 'FORMATION', '2010', NULL, NULL, 1, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `contrats` VALUES (12, NULL, 'STAGIAIRE', '2013', '0000', '0.00', 1, '', '2013-03-26', '2013-03-26') ; 
INSERT INTO `contrats` VALUES (13, NULL, 'Frais DSI-T/SO', '2012', '0000', NULL, 1, 'Pour tous les achats de matériels informatique pour le compte du Département DSI-T/SO', '2013-03-27', '2013-03-27') ;
#
# End of data contents of table contrats
# --------------------------------------------------------

# WordPress : buffernow.com MySQL database backup
#
# Generated: Thursday 23. May 2013 19:38 CEST
# Hostname: localhost
# Database: `saill_200`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `achats`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `actions`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `actionslivrables`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `activites`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `activitesreelles`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `affectations`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `assistances`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `autorisations`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `contrats`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `detailplancharges`
# --------------------------------------------------------


#
# Delete any existing table `detailplancharges`
#

DROP TABLE IF EXISTS `detailplancharges`;


#
# Table structure of table `detailplancharges`
#

CREATE TABLE `detailplancharges` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `plancharge_id` int(11) NOT NULL,
  `utilisateur_id` int(15) NOT NULL,
  `ETP` decimal(2,1) DEFAULT '1.0',
  `domaine_id` int(15) NOT NULL,
  `activite_id` int(15) NOT NULL,
  `JANVIER` int(2) DEFAULT NULL,
  `FEVRIER` int(2) DEFAULT NULL COMMENT 'mois/année',
  `MARS` int(2) DEFAULT NULL COMMENT 'mois/année',
  `AVRIL` int(2) DEFAULT NULL,
  `MAI` int(2) DEFAULT NULL COMMENT 'mois/année',
  `JUIN` int(2) DEFAULT NULL,
  `JUILLET` int(2) DEFAULT NULL COMMENT 'mois/année',
  `AOUT` int(2) DEFAULT NULL,
  `SEPTEMBRE` int(2) DEFAULT NULL COMMENT 'mois/année',
  `OCTOBRE` int(2) DEFAULT NULL,
  `NOVEMBRE` int(2) DEFAULT NULL COMMENT 'mois/année',
  `DECEMBRE` int(2) DEFAULT NULL,
  `TOTAL` int(2) DEFAULT NULL,
  `created` date NOT NULL,
  `modified` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=113 DEFAULT CHARSET=utf8 ;

#
# Data contents of table detailplancharges (106 records)
#
 
INSERT INTO `detailplancharges` VALUES (1, 1, 34, '0.2', 8, 13, 4, 3, 4, 3, 3, 4, 3, 2, 4, 4, 3, 3, 40, '2013-04-23', '2013-04-23') ; 
INSERT INTO `detailplancharges` VALUES (2, 1, 34, '0.5', 8, 38, 11, 7, 10, 8, 9, 10, 9, 5, 10, 11, 9, 8, 107, '2013-04-23', '2013-04-23') ; 
INSERT INTO `detailplancharges` VALUES (3, 1, 13, '0.2', 8, 13, 4, 3, 4, 3, 3, 4, 3, 2, 4, 4, 3, 3, 40, '2013-04-23', '2013-04-23') ; 
INSERT INTO `detailplancharges` VALUES (4, 1, 13, '0.4', 8, 38, 8, 6, 8, 6, 7, 8, 7, 4, 8, 9, 7, 6, 84, '2013-04-23', '2013-04-23') ; 
INSERT INTO `detailplancharges` VALUES (5, 2, 4, '0.5', 1, 17, 11, 7, 10, 8, 9, 10, 9, 5, 10, 11, 9, 8, 107, '2013-04-23', '2013-04-23') ; 
INSERT INTO `detailplancharges` VALUES (6, 2, 4, '0.5', 1, 16, 11, 7, 10, 8, 9, 10, 9, 5, 10, 11, 9, 8, 107, '2013-04-23', '2013-04-23') ; 
INSERT INTO `detailplancharges` VALUES (7, 2, 230, '0.8', 13, 22, 17, 12, 16, 12, 15, 16, 14, 8, 16, 18, 15, 12, 171, '2013-04-23', '2013-04-23') ; 
INSERT INTO `detailplancharges` VALUES (8, 2, 9, '0.5', 7, 21, 11, 7, 10, 8, 9, 10, 9, 5, 10, 11, 9, 8, 107, '2013-04-23', '2013-04-23') ; 
INSERT INTO `detailplancharges` VALUES (9, 2, 9, '0.5', 21, 21, 11, 7, 10, 8, 9, 10, 9, 5, 10, 11, 9, 8, 107, '2013-04-23', '2013-04-23') ; 
INSERT INTO `detailplancharges` VALUES (10, 2, 6, '1.0', 21, 21, 22, 15, 21, 16, 19, 20, 18, 11, 21, 23, 19, 16, 221, '2013-04-23', '2013-04-23') ; 
INSERT INTO `detailplancharges` VALUES (11, 2, 264, '0.3', 7, 21, 6, 4, 6, 4, 5, 6, 5, 3, 6, 6, 5, 4, 60, '2013-04-23', '2013-04-23') ; 
INSERT INTO `detailplancharges` VALUES (12, 2, 264, '0.7', 7, 16, 15, 10, 14, 11, 13, 14, 12, 7, 14, 16, 13, 11, 150, '2013-04-23', '2013-04-23') ; 
INSERT INTO `detailplancharges` VALUES (13, 2, 10, '1.0', 25, 16, 22, 15, 21, 16, 19, 20, 18, 11, 21, 23, 19, 16, 221, '2013-04-23', '2013-04-23') ; 
INSERT INTO `detailplancharges` VALUES (14, 2, -2, '0.5', 7, 16, 11, 12, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 23, '2013-04-23', '2013-04-23') ; 
INSERT INTO `detailplancharges` VALUES (15, 2, 3, '0.2', 1, 16, 4, 3, 4, 3, 3, 4, 3, 2, 4, 4, 3, 3, 40, '2013-04-23', '2013-04-23') ; 
INSERT INTO `detailplancharges` VALUES (16, 2, 3, '0.8', 1, 17, 17, 12, 16, 12, 15, 16, 14, 8, 16, 18, 15, 12, 171, '2013-04-23', '2013-04-23') ; 
INSERT INTO `detailplancharges` VALUES (17, 2, 5, '0.8', 25, 21, 17, 12, 16, 12, 15, 16, 14, 8, 16, 18, 15, 12, 171, '2013-04-23', '2013-04-23') ; 
INSERT INTO `detailplancharges` VALUES (18, 2, 231, '0.3', 14, 21, 5, 3, 5, 4, 4, 5, 4, 2, 5, 5, 4, 4, 50, '2013-04-23', '2013-04-23') ; 
INSERT INTO `detailplancharges` VALUES (19, 2, 231, '0.5', 14, 16, 11, 7, 10, 8, 9, 10, 9, 5, 10, 11, 9, 8, 107, '2013-04-23', '2013-04-23') ; 
INSERT INTO `detailplancharges` VALUES (20, 2, 231, '0.3', 14, 22, 5, 3, 5, 4, 4, 5, 4, 2, 5, 5, 4, 4, 50, '2013-04-23', '2013-04-23') ; 
INSERT INTO `detailplancharges` VALUES (21, 2, 16, '1.0', 16, 22, 22, 15, 21, 16, 19, 20, 18, 11, 21, 23, 19, 16, 221, '2013-04-23', '2013-04-23') ; 
INSERT INTO `detailplancharges` VALUES (22, 2, 22, '0.2', 13, 21, 4, 3, 4, 3, 3, 4, 3, 2, 4, 4, 3, 3, 40, '2013-04-23', '2013-04-23') ; 
INSERT INTO `detailplancharges` VALUES (23, 2, 22, '0.2', 13, 16, 4, 3, 4, 3, 3, 4, 3, 2, 4, 4, 3, 3, 40, '2013-04-23', '2013-04-23') ; 
INSERT INTO `detailplancharges` VALUES (24, 2, 22, '0.2', 13, 22, 4, 3, 4, 3, 3, 4, 3, 2, 4, 4, 3, 3, 40, '2013-04-23', '2013-04-23') ; 
INSERT INTO `detailplancharges` VALUES (25, 2, 35, '0.7', 1, 19, 15, 10, 14, 11, 13, 14, 12, 7, 14, 16, 13, 11, 150, '2013-04-23', '2013-04-23') ; 
INSERT INTO `detailplancharges` VALUES (26, 2, 35, '0.3', 1, 16, 6, 4, 6, 4, 5, 6, 5, 3, 6, 6, 5, 4, 60, '2013-04-23', '2013-04-23') ; 
INSERT INTO `detailplancharges` VALUES (27, 2, 40, '0.5', 7, 16, 11, 7, 10, 8, 9, 10, 9, 5, 10, 11, 9, 8, 107, '2013-04-23', '2013-04-23') ; 
INSERT INTO `detailplancharges` VALUES (28, 2, 40, '0.5', 7, 21, 11, 7, 10, 8, 9, 10, 9, 5, 10, 11, 9, 8, 107, '2013-04-23', '2013-04-23') ; 
INSERT INTO `detailplancharges` VALUES (31, 2, 17, '1.0', 16, 16, 22, 15, 21, 16, 19, 20, 18, 11, 21, 23, 19, 16, 221, '2013-04-23', '2013-04-23') ; 
INSERT INTO `detailplancharges` VALUES (32, 2, 36, '0.2', 13, 16, 4, 3, 4, 3, 3, 4, 3, 2, 4, 4, 3, 3, 40, '2013-04-23', '2013-04-23') ; 
INSERT INTO `detailplancharges` VALUES (33, 2, 36, '0.8', 13, 22, 17, 12, 16, 12, 15, 16, 14, 8, 16, 18, 15, 12, 171, '2013-04-23', '2013-04-23') ; 
INSERT INTO `detailplancharges` VALUES (34, 2, 18, '1.0', 16, 21, 22, 15, 21, 16, 19, 20, 18, 11, 21, 23, 19, 16, 221, '2013-04-23', '2013-04-23') ; 
INSERT INTO `detailplancharges` VALUES (35, 2, 38, '1.0', 13, 22, 22, 15, 21, 16, 19, 20, 18, 11, 21, 23, 19, 16, 221, '2013-04-23', '2013-04-23') ; 
INSERT INTO `detailplancharges` VALUES (36, 2, 140, '1.0', 16, 16, 22, 15, 21, 16, 19, 20, 0, 0, 0, 0, 0, 0, 113, '2013-04-23', '2013-04-23') ; 
INSERT INTO `detailplancharges` VALUES (37, 2, 261, '1.0', 16, 16, 0, 0, 0, 0, 19, 20, 18, 11, 21, 23, 19, 16, 147, '2013-04-23', '2013-04-23') ; 
INSERT INTO `detailplancharges` VALUES (38, 2, 33, '1.0', 16, 22, 22, 15, 21, 16, 19, 20, 18, 11, 21, 23, 19, 16, 221, '2013-04-23', '2013-04-23') ; 
INSERT INTO `detailplancharges` VALUES (39, 2, 268, '1.0', 16, 21, 0, 0, 0, 16, 19, 20, 18, 11, 21, 23, 19, 16, 163, '2013-04-23', '2013-04-23') ; 
INSERT INTO `detailplancharges` VALUES (40, 2, -2, '1.0', 16, 21, 0, 0, 0, 0, 0, 0, 0, 0, 21, 23, 19, 16, 79, '2013-04-23', '2013-04-23') ; 
INSERT INTO `detailplancharges` VALUES (41, 2, -2, '0.3', 7, 21, 6, 4, 6, 4, 5, 6, 5, 3, 6, 6, 5, 4, 60, '2013-04-23', '2013-04-23') ; 
INSERT INTO `detailplancharges` VALUES (42, 2, -1, '0.3', 7, 21, 6, 4, 6, 4, 5, 6, 5, 3, 6, 6, 5, 4, 60, '2013-04-23', '2013-04-23') ; 
INSERT INTO `detailplancharges` VALUES (43, 2, 272, '0.2', 7, 21, 3, 2, 3, 2, 2, 3, 2, 1, 3, 3, 2, 2, 28, '2013-04-23', '2013-04-23') ; 
INSERT INTO `detailplancharges` VALUES (44, 3, 34, '0.3', 14, 14, 5, 3, 5, 4, 4, 5, 4, 2, 5, 5, 4, 4, 50, '2013-04-23', '2013-04-23') ; 
INSERT INTO `detailplancharges` VALUES (45, 3, 34, '0.1', 14, 23, 2, 1, 2, 1, 1, 2, 1, 1, 2, 2, 1, 1, 17, '2013-04-23', '2013-04-23') ; 
INSERT INTO `detailplancharges` VALUES (46, 3, 11, '0.5', 9, 14, 11, 7, 10, 8, 9, 10, 9, 5, 10, 11, 9, 8, 107, '2013-04-23', '2013-04-23') ; 
INSERT INTO `detailplancharges` VALUES (47, 3, 11, '0.5', 9, 23, 11, 7, 10, 8, 9, 10, 9, 5, 10, 11, 9, 8, 107, '2013-04-23', '2013-04-23') ; 
INSERT INTO `detailplancharges` VALUES (48, 3, 14, '0.6', 13, 14, 13, 9, 12, 9, 11, 12, 10, 6, 12, 13, 11, 9, 127, '2013-04-23', '2013-04-23') ; 
INSERT INTO `detailplancharges` VALUES (49, 3, 171, '0.7', 13, 23, 15, 10, 14, 11, 13, 14, 12, 7, 14, 16, 13, 11, 150, '2013-04-23', '2013-04-23') ; 
INSERT INTO `detailplancharges` VALUES (50, 3, 237, '0.6', 13, 14, 12, 8, 11, 8, 10, 11, 9, 6, 11, 12, 10, 8, 116, '2013-04-23', '2013-04-23') ; 
INSERT INTO `detailplancharges` VALUES (51, 3, 237, '0.5', 13, 23, 9, 6, 9, 7, 8, 9, 8, 4, 9, 10, 8, 7, 94, '2013-04-23', '2013-04-23') ; 
INSERT INTO `detailplancharges` VALUES (52, 3, -1, '0.2', 25, 23, 4, 3, 4, 3, 3, 4, 3, 2, 4, 4, 3, 3, 40, '2013-04-23', '2013-04-23') ; 
INSERT INTO `detailplancharges` VALUES (53, 4, 230, '0.2', 10, 24, 4, 3, 4, 3, 3, 4, 3, 2, 4, 4, 3, 3, 40, '2013-04-23', '2013-04-23') ; 
INSERT INTO `detailplancharges` VALUES (54, 4, 12, '0.5', 10, 24, 11, 7, 10, 8, 9, 10, 9, 5, 10, 11, 9, 8, 107, '2013-04-23', '2013-04-23') ; 
INSERT INTO `detailplancharges` VALUES (55, 4, 12, '0.2', 10, 27, 4, 3, 4, 3, 3, 4, 3, 2, 4, 4, 3, 3, 40, '2013-04-23', '2013-04-23') ; 
INSERT INTO `detailplancharges` VALUES (56, 4, 12, '0.1', 20, 24, 2, 1, 2, 1, 1, 2, 1, 1, 2, 2, 1, 1, 17, '2013-04-23', '2013-04-23') ; 
INSERT INTO `detailplancharges` VALUES (57, 4, 255, '1.0', 20, 24, 0, 0, 21, 16, 19, 20, 18, 11, 21, 23, 19, 16, 221, '2013-04-23', '2013-04-23') ; 
INSERT INTO `detailplancharges` VALUES (58, 4, 8, '0.3', 10, 27, 6, 4, 6, 4, 5, 6, 5, 3, 6, 6, 5, 4, 60, '2013-04-23', '2013-04-23') ; 
INSERT INTO `detailplancharges` VALUES (59, 4, 8, '0.5', 10, 24, 11, 7, 10, 8, 9, 10, 9, 5, 10, 11, 9, 8, 107, '2013-04-23', '2013-04-23') ; 
INSERT INTO `detailplancharges` VALUES (60, 4, 172, '0.3', 10, 27, 6, 4, 6, 4, 5, 6, 5, 3, 6, 6, 5, 4, 60, '2013-04-23', '2013-04-23') ; 
INSERT INTO `detailplancharges` VALUES (61, 4, 172, '0.7', 10, 24, 15, 10, 14, 11, 13, 14, 12, 7, 14, 16, 13, 11, 150, '2013-04-23', '2013-04-23') ; 
INSERT INTO `detailplancharges` VALUES (62, 4, 176, '0.5', 13, 27, 11, 7, 10, 8, 9, 10, 9, 5, 10, 11, 9, 8, 107, '2013-04-23', '2013-04-23') ; 
INSERT INTO `detailplancharges` VALUES (63, 4, 176, '0.5', 13, 24, 11, 7, 10, 8, 9, 10, 9, 5, 10, 11, 9, 8, 107, '2013-04-23', '2013-04-23') ; 
INSERT INTO `detailplancharges` VALUES (64, 4, 265, '0.7', 10, 24, 0, 0, 0, 11, 13, 14, 12, 7, 14, 16, 13, 11, 111, '2013-04-23', '2013-04-23') ; 
INSERT INTO `detailplancharges` VALUES (65, 4, 265, '0.3', 10, 27, 0, 0, 0, 4, 5, 6, 5, 3, 6, 6, 5, 4, 44, '2013-04-23', '2013-04-23') ; 
INSERT INTO `detailplancharges` VALUES (66, 4, -1, '0.5', 10, 24, 11, 7, 10, 8, 9, 10, 9, 5, 10, 11, 9, 8, 107, '2013-04-23', '2013-04-23') ; 
INSERT INTO `detailplancharges` VALUES (67, 4, -1, '0.5', 10, 27, 11, 7, 10, 8, 9, 10, 9, 5, 10, 11, 9, 8, 107, '2013-04-23', '2013-04-23') ; 
INSERT INTO `detailplancharges` VALUES (68, 4, -1, '0.2', 10, 24, 4, 3, 4, 3, 3, 4, 3, 2, 4, 4, 3, 3, 40, '2013-04-23', '2013-04-23') ; 
INSERT INTO `detailplancharges` VALUES (69, 5, 14, '0.2', 13, 28, 4, 3, 4, 3, 3, 4, 3, 2, 4, 4, 3, 3, 40, '2013-04-23', '2013-04-23') ; 
INSERT INTO `detailplancharges` VALUES (70, 5, 7, '0.3', 23, 28, 6, 4, 6, 4, 5, 6, 5, 3, 6, 6, 5, 4, 60, '2013-04-23', '2013-04-23') ; 
INSERT INTO `detailplancharges` VALUES (71, 5, 7, '0.2', 23, 30, 3, 2, 3, 2, 2, 3, 2, 1, 3, 3, 2, 2, 28, '2013-04-23', '2013-04-23') ; 
INSERT INTO `detailplancharges` VALUES (72, 5, 171, '0.2', 13, 28, 4, 3, 4, 3, 3, 4, 3, 2, 4, 4, 3, 3, 40, '2013-04-23', '2013-04-23') ; 
INSERT INTO `detailplancharges` VALUES (73, 5, 171, '0.1', 13, 30, 2, 1, 2, 1, 1, 2, 1, 1, 2, 2, 1, 1, 17, '2013-04-23', '2013-04-23') ; 
INSERT INTO `detailplancharges` VALUES (74, 5, -1, '0.2', 25, 28, 4, 3, 4, 3, 3, 4, 3, 2, 4, 4, 3, 3, 40, '2013-04-23', '2013-04-23') ; 
INSERT INTO `detailplancharges` VALUES (75, 6, 4, '0.5', 1, 17, 11, 7, 10, 8, 9, 10, 9, 5, 10, 11, 9, 8, 107, '2013-04-23', '2013-04-23') ; 
INSERT INTO `detailplancharges` VALUES (76, 6, 4, '0.5', 1, 16, 11, 7, 10, 8, 9, 10, 9, 5, 10, 11, 9, 8, 107, '2013-04-23', '2013-04-23') ; 
INSERT INTO `detailplancharges` VALUES (77, 6, 230, '0.8', 13, 22, 17, 12, 16, 12, 15, 16, 14, 8, 16, 18, 15, 12, 171, '2013-04-23', '2013-04-23') ; 
INSERT INTO `detailplancharges` VALUES (78, 6, 9, '0.5', 7, 21, 11, 7, 10, 8, 9, 10, 9, 5, 10, 11, 9, 8, 107, '2013-04-23', '2013-04-23') ; 
INSERT INTO `detailplancharges` VALUES (79, 6, 9, '0.5', 21, 21, 11, 7, 10, 8, 9, 10, 9, 5, 10, 11, 9, 8, 107, '2013-04-23', '2013-04-23') ; 
INSERT INTO `detailplancharges` VALUES (80, 6, 6, '1.0', 21, 21, 22, 15, 21, 16, 19, 20, 18, 11, 21, 23, 19, 16, 221, '2013-04-23', '2013-04-23') ; 
INSERT INTO `detailplancharges` VALUES (81, 6, 264, '0.3', 7, 21, 6, 4, 6, 4, 5, 6, 5, 3, 6, 6, 5, 4, 60, '2013-04-23', '2013-04-23') ; 
INSERT INTO `detailplancharges` VALUES (82, 6, 264, '0.7', 7, 16, 15, 10, 14, 11, 13, 14, 12, 7, 14, 16, 13, 11, 150, '2013-04-23', '2013-04-23') ; 
INSERT INTO `detailplancharges` VALUES (83, 6, 10, '1.0', 25, 16, 22, 15, 21, 16, 19, 20, 18, 11, 21, 23, 19, 16, 221, '2013-04-23', '2013-04-23') ; 
INSERT INTO `detailplancharges` VALUES (85, 6, 3, '0.2', 1, 16, 4, 3, 4, 3, 3, 4, 3, 2, 4, 4, 3, 3, 40, '2013-04-23', '2013-04-23') ; 
INSERT INTO `detailplancharges` VALUES (86, 6, 3, '0.8', 1, 17, 17, 12, 16, 12, 15, 16, 14, 8, 16, 18, 15, 12, 171, '2013-04-23', '2013-04-23') ; 
INSERT INTO `detailplancharges` VALUES (87, 6, 5, '0.8', 25, 21, 17, 12, 16, 12, 15, 16, 14, 8, 16, 18, 15, 12, 171, '2013-04-23', '2013-04-23') ; 
INSERT INTO `detailplancharges` VALUES (88, 6, 231, '0.3', 14, 21, 5, 3, 5, 4, 4, 5, 4, 2, 5, 5, 4, 4, 50, '2013-04-23', '2013-04-23') ; 
INSERT INTO `detailplancharges` VALUES (89, 6, 231, '0.5', 14, 16, 11, 7, 10, 8, 9, 10, 9, 5, 10, 11, 9, 8, 107, '2013-04-23', '2013-04-23') ; 
INSERT INTO `detailplancharges` VALUES (90, 6, 231, '0.3', 14, 22, 5, 3, 5, 4, 4, 5, 4, 2, 5, 5, 4, 4, 50, '2013-04-23', '2013-04-23') ; 
INSERT INTO `detailplancharges` VALUES (91, 6, 16, '1.0', 16, 22, 22, 15, 21, 16, 19, 20, 18, 11, 21, 23, 19, 16, 221, '2013-04-23', '2013-04-23') ; 
INSERT INTO `detailplancharges` VALUES (92, 6, 22, '0.2', 13, 21, 4, 3, 4, 3, 3, 4, 3, 2, 4, 4, 3, 3, 40, '2013-04-23', '2013-04-23') ; 
INSERT INTO `detailplancharges` VALUES (93, 6, 22, '0.2', 13, 16, 4, 3, 4, 3, 3, 4, 3, 2, 4, 4, 3, 3, 40, '2013-04-23', '2013-04-23') ; 
INSERT INTO `detailplancharges` VALUES (94, 6, 22, '0.2', 13, 22, 4, 3, 4, 3, 3, 4, 3, 2, 4, 4, 3, 3, 40, '2013-04-23', '2013-04-23') ; 
INSERT INTO `detailplancharges` VALUES (95, 6, 35, '0.7', 1, 19, 15, 10, 14, 11, 13, 14, 12, 7, 14, 16, 13, 11, 150, '2013-04-23', '2013-04-23') ; 
INSERT INTO `detailplancharges` VALUES (96, 6, 35, '0.3', 1, 16, 6, 4, 6, 4, 5, 6, 5, 3, 6, 6, 5, 4, 60, '2013-04-23', '2013-04-23') ; 
INSERT INTO `detailplancharges` VALUES (97, 6, 40, '0.5', 7, 16, 11, 7, 10, 8, 9, 10, 9, 5, 10, 11, 9, 8, 107, '2013-04-23', '2013-04-23') ; 
INSERT INTO `detailplancharges` VALUES (98, 6, 40, '0.5', 7, 21, 11, 7, 10, 8, 9, 10, 9, 5, 10, 11, 9, 8, 107, '2013-04-23', '2013-04-23') ; 
INSERT INTO `detailplancharges` VALUES (99, 6, 17, '1.0', 16, 16, 22, 15, 21, 16, 19, 20, 18, 11, 21, 23, 19, 16, 221, '2013-04-23', '2013-04-23') ; 
INSERT INTO `detailplancharges` VALUES (100, 6, 36, '0.2', 13, 16, 4, 3, 4, 3, 3, 4, 3, 2, 4, 4, 3, 3, 40, '2013-04-23', '2013-04-23') ; 
INSERT INTO `detailplancharges` VALUES (101, 6, 36, '0.8', 13, 22, 17, 12, 16, 12, 15, 16, 14, 8, 16, 18, 15, 12, 171, '2013-04-23', '2013-04-23') ; 
INSERT INTO `detailplancharges` VALUES (102, 6, 18, '1.0', 16, 21, 22, 15, 21, 16, 19, 20, 18, 11, 21, 23, 19, 16, 221, '2013-04-23', '2013-04-23') ; 
INSERT INTO `detailplancharges` VALUES (103, 6, 38, '1.0', 13, 22, 22, 15, 21, 16, 19, 20, 18, 11, 21, 23, 19, 16, 221, '2013-04-23', '2013-04-23') ; 
INSERT INTO `detailplancharges` VALUES (105, 6, 261, '1.0', 16, 16, 22, 15, 21, 16, 19, 20, 17, 10, 22, 23, 19, 17, 221, '2013-04-23', '2013-04-23') ; 
INSERT INTO `detailplancharges` VALUES (106, 6, 33, '1.0', 16, 22, 22, 15, 21, 16, 19, 20, 18, 11, 21, 23, 19, 16, 221, '2013-04-23', '2013-04-23') ; 
INSERT INTO `detailplancharges` VALUES (107, 6, 268, '1.0', 16, 21, 0, 0, 0, 16, 19, 20, 18, 11, 21, 23, 19, 16, 163, '2013-04-23', '2013-04-23') ; 
INSERT INTO `detailplancharges` VALUES (110, 6, -1, '0.3', 7, 21, 6, 4, 6, 4, 5, 6, 5, 3, 6, 6, 5, 4, 60, '2013-04-23', '2013-04-23') ; 
INSERT INTO `detailplancharges` VALUES (111, 6, 272, '0.2', 7, 21, 3, 2, 3, 2, 2, 3, 2, 1, 3, 3, 2, 2, 28, '2013-04-23', '2013-04-23') ; 
INSERT INTO `detailplancharges` VALUES (112, 7, 22, '0.4', 13, 35, 8, 6, 8, 6, 7, 8, 7, 4, 8, 9, 7, 6, 84, '2013-05-14', '2013-05-14') ;
#
# End of data contents of table detailplancharges
# --------------------------------------------------------

# WordPress : buffernow.com MySQL database backup
#
# Generated: Thursday 23. May 2013 19:38 CEST
# Hostname: localhost
# Database: `saill_200`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `achats`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `actions`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `actionslivrables`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `activites`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `activitesreelles`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `affectations`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `assistances`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `autorisations`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `contrats`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `detailplancharges`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `domaines`
# --------------------------------------------------------


#
# Delete any existing table `domaines`
#

DROP TABLE IF EXISTS `domaines`;


#
# Table structure of table `domaines`
#

CREATE TABLE `domaines` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `NOM` varchar(255) CHARACTER SET latin1 NOT NULL,
  `DESCRIPTION` longtext CHARACTER SET latin1,
  `created` date NOT NULL,
  `modified` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8 ;

#
# Data contents of table domaines (30 records)
#
 
INSERT INTO `domaines` VALUES (1, 'PILOTAGE', 'Tous les hiérarchiques', '2013-02-01', '2013-02-01') ; 
INSERT INTO `domaines` VALUES (2, 'EXPERTISE TECHNIQUE', 'Domaine spécialisé dans l\'urbanisme', '2013-02-01', '2013-02-01') ; 
INSERT INTO `domaines` VALUES (3, 'PLANIFICATION', 'Domaine lié à  la planification', '2013-02-01', '2013-02-01') ; 
INSERT INTO `domaines` VALUES (4, 'LOGISTIQUE', 'Domaine lié à  la logistique pour tous les utilisateurs', '2013-02-01', '2013-02-01') ; 
INSERT INTO `domaines` VALUES (5, 'EXIGENCES', 'Domaines lié aux exigence du projet', '2013-02-01', '2013-02-01') ; 
INSERT INTO `domaines` VALUES (6, 'DOCUMENTATION', 'Domaine lié à  la gestion documentaire', '2013-02-01', '2013-02-01') ; 
INSERT INTO `domaines` VALUES (7, 'GMAO MR', 'Domaine lié à  MAXIMO', '2013-02-01', '2013-02-01') ; 
INSERT INTO `domaines` VALUES (8, 'COHERENCE', 'Domaine lié au projet COHERENCE', '2013-02-01', '2013-02-01') ; 
INSERT INTO `domaines` VALUES (9, 'ORCHESTRAL', 'Domaine lié au projet ORCHESTRAL', '2013-02-01', '2013-02-01') ; 
INSERT INTO `domaines` VALUES (10, 'PANAM', 'Domaine lié au projet PANAM', '2013-02-01', '2013-02-01') ; 
INSERT INTO `domaines` VALUES (11, 'INTEGRATION', 'Domaine lié à  l\'intégration des projets', '2013-02-01', '2013-02-01') ; 
INSERT INTO `domaines` VALUES (12, 'QUALIFICATION', 'Domaine lié à  la qualification des projets', '2013-02-01', '2013-02-01') ; 
INSERT INTO `domaines` VALUES (13, 'ARCHITECTURE', 'Domaine lié à  l\'architecture, cela comprend les tests de performance et technique', '2013-02-01', '2013-02-01') ; 
INSERT INTO `domaines` VALUES (14, 'ENVIRONNEMENT', 'Domaine lié à  la gestion des environnements', '2013-02-01', '2013-02-01') ; 
INSERT INTO `domaines` VALUES (15, 'MISE EN PRODUCTION', 'Domaine lié à  la mise en production des projets', '2013-02-01', '2013-02-01') ; 
INSERT INTO `domaines` VALUES (16, 'REPRISE DE DONNEES', 'Domaine lié à  la reprise de donnée, cela concerne également les bascules ...', '2013-02-01', '2013-02-01') ; 
INSERT INTO `domaines` VALUES (17, 'FORMATION', 'Domaine lié aux formations sur les projets', '2013-02-01', '2013-02-01') ; 
INSERT INTO `domaines` VALUES (18, 'ASSISTANCE PC', 'Domaine lié à  l\'aide et aux retours du PC ASSISTANCE pour les utilisateurs', '2013-02-01', '2013-02-01') ; 
INSERT INTO `domaines` VALUES (19, 'MCO', 'Domaine lié à  la maintenance en condition opérationnelle', '2013-02-01', '2013-02-01') ; 
INSERT INTO `domaines` VALUES (20, 'PO', 'Domaine lié au projet PO remplaçant de PANAM', '2013-02-01', '2013-02-01') ; 
INSERT INTO `domaines` VALUES (21, 'GMAO ORGANES', 'Domaine lié à la GMAO Organes', '2013-02-01', '2013-02-01') ; 
INSERT INTO `domaines` VALUES (22, 'PUMA OSMOSE', 'Domaine lié à PUMA en relation avec le programme OSMOSE', '2013-02-01', '2013-02-01') ; 
INSERT INTO `domaines` VALUES (23, 'SGRM', 'Domaine lié au projet SGRM', '2013-02-01', '2013-02-01') ; 
INSERT INTO `domaines` VALUES (24, 'SI EXISTANTS', 'Domaine lié aux différents SI existant ayant un impact sur le progamme OSMOSE', '2013-02-01', '2013-02-01') ; 
INSERT INTO `domaines` VALUES (25, 'TRANSVERSE', 'Domaine transverse au programme OSMOSE', '2013-02-01', '2013-02-01') ; 
INSERT INTO `domaines` VALUES (26, 'INTEFRACES', 'Domaine lié aux insterfaces du programme OSMOSE avec les autres outils du SI', '2013-02-01', '2013-02-01') ; 
INSERT INTO `domaines` VALUES (27, 'SUIVI DE PRODUCTION', '', '2013-05-16', '2013-05-16') ; 
INSERT INTO `domaines` VALUES (28, 'OSMOVISION', '', '2013-05-21', '2013-05-21') ; 
INSERT INTO `domaines` VALUES (29, 'ITACT', '', '2013-05-21', '2013-05-21') ; 
INSERT INTO `domaines` VALUES (30, 'URBANISME', '', '2013-05-21', '2013-05-21') ;
#
# End of data contents of table domaines
# --------------------------------------------------------

# WordPress : buffernow.com MySQL database backup
#
# Generated: Thursday 23. May 2013 19:38 CEST
# Hostname: localhost
# Database: `saill_200`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `achats`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `actions`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `actionslivrables`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `activites`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `activitesreelles`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `affectations`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `assistances`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `autorisations`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `contrats`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `detailplancharges`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `domaines`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `dossierpartages`
# --------------------------------------------------------


#
# Delete any existing table `dossierpartages`
#

DROP TABLE IF EXISTS `dossierpartages`;


#
# Table structure of table `dossierpartages`
#

CREATE TABLE `dossierpartages` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `NOM` varchar(50) CHARACTER SET latin1 NOT NULL,
  `GROUPEAD` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `DESCRIPTION` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `created` date NOT NULL,
  `modified` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 ;

#
# Data contents of table dossierpartages (7 records)
#
 
INSERT INTO `dossierpartages` VALUES (1, 'OSMOSE-MOA-MOE', 'DSIT_EM-OSMOSE-MDTV_GG', '\\commun\\dsit_buro\\Partages\\EM\\OSMOSE-MOA-MOE', '2013-02-01', '2013-02-01') ; 
INSERT INTO `dossierpartages` VALUES (2, 'GMAO', 'DSIT_P-GMAO-M_GG', '\\commun\\dsit_buro\\Partages\\GMAO', '2013-02-01', '2013-02-01') ; 
INSERT INTO `dossierpartages` VALUES (3, 'OSMOSE', 'DSIT_C-EMM-OSMOSE-M_GG', '\\commun\\dsit_buro\\Communs\\DSIT\\EMM\\OSMOSE', '2013-02-01', '2013-02-01') ; 
INSERT INTO `dossierpartages` VALUES (4, 'OSMOSECSNROP', 'DSIT_C-EMM-OSMOSECSNROP-M_GG', '\\commun\\dsit_buro\\Communs\\DSIT\\EMM\\OSMOSECSNROP', '2013-02-01', '2013-02-01') ; 
INSERT INTO `dossierpartages` VALUES (5, 'PANAM', 'DSIT_P-EM-PANAM-M_GG', '\\commun\\dsit_buro÷Partages\\EM\\PANAM', '2013-02-01', '2013-02-01') ; 
INSERT INTO `dossierpartages` VALUES (6, 'MOA', 'Partage MOA', 'Géré par la MOA-SI contact : Eric COURRIER envoyer une demande par mail', '2013-02-01', '2013-02-01') ; 
INSERT INTO `dossierpartages` VALUES (7, 'TRAVAIL E-X', 'DSIT_EMM-OA-USR_GG', '\\commun\\dsit_buro\\Partages\\DSIT-E-X-Travail\\M\\OSMOSE\\Environnements', '2013-02-01', '2013-02-01') ;
#
# End of data contents of table dossierpartages
# --------------------------------------------------------

# WordPress : buffernow.com MySQL database backup
#
# Generated: Thursday 23. May 2013 19:38 CEST
# Hostname: localhost
# Database: `saill_200`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `achats`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `actions`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `actionslivrables`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `activites`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `activitesreelles`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `affectations`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `assistances`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `autorisations`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `contrats`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `detailplancharges`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `domaines`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `dossierpartages`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `dotations`
# --------------------------------------------------------


#
# Delete any existing table `dotations`
#

DROP TABLE IF EXISTS `dotations`;


#
# Table structure of table `dotations`
#

CREATE TABLE `dotations` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `materielinformatiques_id` int(15) DEFAULT NULL,
  `typemateriel_id` int(15) DEFAULT NULL,
  `utilisateur_id` int(15) NOT NULL,
  `DATERECEPTION` date DEFAULT NULL,
  `DATEREMISE` date DEFAULT NULL,
  `created` date NOT NULL,
  `modified` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=72 DEFAULT CHARSET=utf8 ;

#
# Data contents of table dotations (68 records)
#
 
INSERT INTO `dotations` VALUES (1, 101, NULL, 261, '2013-04-15', NULL, '2013-03-28', '2013-03-28') ; 
INSERT INTO `dotations` VALUES (2, NULL, 17, 261, '2013-04-15', NULL, '2013-03-28', '2013-03-28') ; 
INSERT INTO `dotations` VALUES (3, NULL, 9, 261, '2013-04-15', NULL, '2013-03-28', '2013-03-28') ; 
INSERT INTO `dotations` VALUES (4, NULL, 6, 261, '2013-04-15', NULL, '2013-03-28', '2013-03-28') ; 
INSERT INTO `dotations` VALUES (5, NULL, 24, 261, '2013-04-15', NULL, '2013-03-28', '2013-03-28') ; 
INSERT INTO `dotations` VALUES (7, 136, NULL, 268, '2013-04-02', NULL, '2013-04-03', '2013-04-03') ; 
INSERT INTO `dotations` VALUES (8, NULL, 31, 268, '2013-04-02', NULL, '2013-04-03', '2013-04-03') ; 
INSERT INTO `dotations` VALUES (9, NULL, 18, 268, '2013-04-02', NULL, '2013-04-03', '2013-04-03') ; 
INSERT INTO `dotations` VALUES (10, NULL, 8, 268, '2013-04-02', NULL, '2013-04-03', '2013-04-03') ; 
INSERT INTO `dotations` VALUES (11, NULL, 17, 268, '2013-04-02', NULL, '2013-04-03', '2013-04-03') ; 
INSERT INTO `dotations` VALUES (12, NULL, 13, 268, '2013-04-02', NULL, '2013-04-03', '2013-04-03') ; 
INSERT INTO `dotations` VALUES (13, NULL, 6, 268, '2013-04-02', NULL, '2013-04-03', '2013-04-03') ; 
INSERT INTO `dotations` VALUES (14, 23, NULL, 265, '2013-03-27', NULL, '2013-04-04', '2013-04-04') ; 
INSERT INTO `dotations` VALUES (15, NULL, 18, 268, '2013-04-17', NULL, '2013-04-17', '2013-04-17') ; 
INSERT INTO `dotations` VALUES (16, NULL, 10, 268, '2013-04-17', NULL, '2013-04-17', '2013-04-17') ; 
INSERT INTO `dotations` VALUES (17, NULL, 12, 268, '2013-04-17', NULL, '2013-04-17', '2013-04-17') ; 
INSERT INTO `dotations` VALUES (18, NULL, 11, 268, '2013-04-17', NULL, '2013-04-17', '2013-04-17') ; 
INSERT INTO `dotations` VALUES (19, NULL, 6, 268, '2013-04-17', NULL, '2013-04-17', '2013-04-17') ; 
INSERT INTO `dotations` VALUES (20, NULL, 31, 261, '2013-04-17', NULL, '2013-04-17', '2013-04-17') ; 
INSERT INTO `dotations` VALUES (21, NULL, 18, 261, '2013-04-17', NULL, '2013-04-17', '2013-04-17') ; 
INSERT INTO `dotations` VALUES (22, NULL, 8, 261, '2013-04-17', NULL, '2013-04-17', '2013-04-17') ; 
INSERT INTO `dotations` VALUES (23, NULL, 10, 261, '2013-04-17', NULL, '2013-04-17', '2013-04-17') ; 
INSERT INTO `dotations` VALUES (24, NULL, 9, 261, '2013-04-17', NULL, '2013-04-17', '2013-04-17') ; 
INSERT INTO `dotations` VALUES (25, NULL, 12, 261, '2013-04-17', NULL, '2013-04-17', '2013-04-17') ; 
INSERT INTO `dotations` VALUES (26, NULL, 11, 261, '2013-04-17', NULL, '2013-04-17', '2013-04-17') ; 
INSERT INTO `dotations` VALUES (27, NULL, 14, 261, '2013-04-17', NULL, '2013-04-17', '2013-04-17') ; 
INSERT INTO `dotations` VALUES (29, NULL, 29, 261, '2013-04-17', NULL, '2013-04-17', '2013-04-17') ; 
INSERT INTO `dotations` VALUES (30, NULL, 6, 261, '2013-04-17', NULL, '2013-04-17', '2013-04-17') ; 
INSERT INTO `dotations` VALUES (32, NULL, 4, 172, '2013-04-17', NULL, '2013-04-18', '2013-04-18') ; 
INSERT INTO `dotations` VALUES (33, NULL, 31, 172, NULL, NULL, '2013-04-18', '2013-04-18') ; 
INSERT INTO `dotations` VALUES (34, NULL, 18, 172, '2013-04-17', NULL, '2013-04-18', '2013-04-18') ; 
INSERT INTO `dotations` VALUES (35, NULL, 8, 172, NULL, NULL, '2013-04-18', '2013-04-18') ; 
INSERT INTO `dotations` VALUES (36, NULL, 10, 172, NULL, NULL, '2013-04-18', '2013-04-18') ; 
INSERT INTO `dotations` VALUES (37, NULL, 12, 172, NULL, NULL, '2013-04-18', '2013-04-18') ; 
INSERT INTO `dotations` VALUES (38, NULL, 11, 172, NULL, NULL, '2013-04-18', '2013-04-18') ; 
INSERT INTO `dotations` VALUES (39, NULL, 14, 172, NULL, NULL, '2013-04-18', '2013-04-18') ; 
INSERT INTO `dotations` VALUES (40, NULL, 24, 172, NULL, NULL, '2013-04-18', '2013-04-18') ; 
INSERT INTO `dotations` VALUES (41, NULL, 29, 172, NULL, NULL, '2013-04-18', '2013-04-18') ; 
INSERT INTO `dotations` VALUES (42, NULL, 9, 172, '2013-04-17', NULL, '2013-04-18', '2013-04-18') ; 
INSERT INTO `dotations` VALUES (43, NULL, 6, 172, '2013-04-17', NULL, '2013-04-18', '2013-04-18') ; 
INSERT INTO `dotations` VALUES (44, NULL, 31, 172, NULL, NULL, '2013-04-18', '2013-04-18') ; 
INSERT INTO `dotations` VALUES (45, 163, NULL, 265, NULL, NULL, '2013-04-18', '2013-04-18') ; 
INSERT INTO `dotations` VALUES (46, NULL, 31, 265, NULL, NULL, '2013-04-18', '2013-04-18') ; 
INSERT INTO `dotations` VALUES (47, NULL, 31, 265, NULL, NULL, '2013-04-18', '2013-04-18') ; 
INSERT INTO `dotations` VALUES (48, NULL, 18, 265, NULL, NULL, '2013-04-18', '2013-04-18') ; 
INSERT INTO `dotations` VALUES (49, NULL, 8, 265, NULL, NULL, '2013-04-18', '2013-04-18') ; 
INSERT INTO `dotations` VALUES (50, NULL, 10, 265, NULL, NULL, '2013-04-18', '2013-04-18') ; 
INSERT INTO `dotations` VALUES (51, NULL, 9, 265, NULL, NULL, '2013-04-18', '2013-04-18') ; 
INSERT INTO `dotations` VALUES (52, NULL, 12, 265, NULL, NULL, '2013-04-18', '2013-04-18') ; 
INSERT INTO `dotations` VALUES (53, NULL, 4, 265, NULL, NULL, '2013-04-18', '2013-04-18') ; 
INSERT INTO `dotations` VALUES (54, NULL, 11, 265, NULL, NULL, '2013-04-18', '2013-04-18') ; 
INSERT INTO `dotations` VALUES (55, NULL, 14, 265, NULL, NULL, '2013-04-18', '2013-04-18') ; 
INSERT INTO `dotations` VALUES (56, NULL, 24, 265, NULL, NULL, '2013-04-18', '2013-04-18') ; 
INSERT INTO `dotations` VALUES (57, NULL, 29, 265, NULL, NULL, '2013-04-18', '2013-04-18') ; 
INSERT INTO `dotations` VALUES (58, NULL, 6, 265, NULL, NULL, '2013-04-18', '2013-04-18') ; 
INSERT INTO `dotations` VALUES (59, NULL, 31, 268, NULL, NULL, '2013-04-18', '2013-04-18') ; 
INSERT INTO `dotations` VALUES (60, NULL, 31, 268, NULL, NULL, '2013-04-18', '2013-04-18') ; 
INSERT INTO `dotations` VALUES (61, NULL, 8, 268, NULL, NULL, '2013-04-18', '2013-04-18') ; 
INSERT INTO `dotations` VALUES (62, NULL, 9, 268, NULL, NULL, '2013-04-18', '2013-04-18') ; 
INSERT INTO `dotations` VALUES (63, NULL, 14, 268, NULL, NULL, '2013-04-18', '2013-04-18') ; 
INSERT INTO `dotations` VALUES (64, NULL, 24, 268, NULL, NULL, '2013-04-18', '2013-04-18') ; 
INSERT INTO `dotations` VALUES (65, NULL, 29, 268, NULL, NULL, '2013-04-18', '2013-04-18') ; 
INSERT INTO `dotations` VALUES (66, 164, NULL, 172, NULL, NULL, '2013-04-18', '2013-04-18') ; 
INSERT INTO `dotations` VALUES (67, NULL, 31, 261, NULL, NULL, '2013-04-18', '2013-04-18') ; 
INSERT INTO `dotations` VALUES (68, 165, NULL, 261, NULL, NULL, '2013-04-18', '2013-04-18') ; 
INSERT INTO `dotations` VALUES (69, NULL, 4, 261, NULL, NULL, '2013-04-18', '2013-04-18') ; 
INSERT INTO `dotations` VALUES (70, 166, NULL, 268, NULL, NULL, '2013-04-18', '2013-04-18') ; 
INSERT INTO `dotations` VALUES (71, 141, NULL, 14, NULL, NULL, '2013-05-21', '2013-05-21') ;
#
# End of data contents of table dotations
# --------------------------------------------------------

# WordPress : buffernow.com MySQL database backup
#
# Generated: Thursday 23. May 2013 19:38 CEST
# Hostname: localhost
# Database: `saill_200`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `achats`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `actions`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `actionslivrables`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `activites`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `activitesreelles`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `affectations`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `assistances`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `autorisations`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `contrats`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `detailplancharges`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `domaines`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `dossierpartages`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `dotations`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `facturations`
# --------------------------------------------------------


#
# Delete any existing table `facturations`
#

DROP TABLE IF EXISTS `facturations`;


#
# Table structure of table `facturations`
#

CREATE TABLE `facturations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `utilisateur_id` int(15) NOT NULL,
  `activite_id` int(15) NOT NULL,
  `activitesreelle_id` int(11) DEFAULT NULL,
  `DATE` date NOT NULL,
  `VERSION` int(2) DEFAULT '0',
  `LU` decimal(2,1) DEFAULT NULL,
  `MA` decimal(2,1) DEFAULT NULL,
  `ME` decimal(2,1) DEFAULT NULL,
  `JE` decimal(2,1) DEFAULT NULL,
  `VE` decimal(2,1) DEFAULT NULL,
  `SA` decimal(2,1) DEFAULT NULL,
  `DI` decimal(2,1) DEFAULT NULL,
  `TOTAL` decimal(2,1) DEFAULT NULL,
  `NUMEROFTGALILEI` varchar(15) DEFAULT NULL,
  `VISIBLE` tinyint(1) NOT NULL DEFAULT '0',
  `created` date NOT NULL,
  `modified` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=519 DEFAULT CHARSET=utf8 ;

#
# Data contents of table facturations (503 records)
#
 
INSERT INTO `facturations` VALUES (1, 5, 3, 1, '2013-03-25', 0, '0.0', '0.0', '0.0', '0.0', '1.0', '0.0', '0.0', '1.0', '604474', 0, '2013-04-08', '2013-04-08') ; 
INSERT INTO `facturations` VALUES (2, 5, 21, 18, '2013-03-25', 0, '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '0.0', '4.0', '604474', 0, '2013-04-08', '2013-04-08') ; 
INSERT INTO `facturations` VALUES (3, 5, 3, 5, '2013-03-18', 0, '0.0', '0.0', '0.0', '0.0', '1.0', '0.0', '0.0', '1.0', '604473', 0, '2013-04-08', '2013-04-08') ; 
INSERT INTO `facturations` VALUES (4, 5, 21, 21, '2013-03-18', 0, '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '0.0', '4.0', '604473', 0, '2013-04-08', '2013-04-08') ; 
INSERT INTO `facturations` VALUES (5, 5, 3, 4, '2013-03-11', 0, '0.0', '0.0', '0.0', '0.0', '1.0', '0.0', '0.0', '1.0', '604472', 0, '2013-04-08', '2013-04-08') ; 
INSERT INTO `facturations` VALUES (6, 5, 21, 20, '2013-03-11', 0, '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '0.0', '4.0', '604472', 0, '2013-04-08', '2013-04-08') ; 
INSERT INTO `facturations` VALUES (7, 5, 3, 3, '2013-03-04', 0, '0.0', '0.0', '0.0', '0.0', '1.0', '0.0', '0.0', '1.0', '604465', 0, '2013-04-08', '2013-04-08') ; 
INSERT INTO `facturations` VALUES (8, 5, 21, 19, '2013-03-04', 0, '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '0.0', '4.0', '604465', 0, '2013-04-08', '2013-04-08') ; 
INSERT INTO `facturations` VALUES (9, 255, 24, 113, '2013-03-04', 0, '1.0', '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '5.0', '0000623541', 0, '2013-04-09', '2013-04-09') ; 
INSERT INTO `facturations` VALUES (10, 255, 24, 114, '2013-03-11', 0, '1.0', '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '5.0', '0000623542', 0, '2013-04-09', '2013-04-09') ; 
INSERT INTO `facturations` VALUES (11, 255, 24, 115, '2013-03-18', 0, '1.0', '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '5.0', '0000623543', 0, '2013-04-09', '2013-04-09') ; 
INSERT INTO `facturations` VALUES (12, 255, 24, 116, '2013-03-25', 0, '1.0', '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '5.0', '0000623544', 0, '2013-04-09', '2013-04-09') ; 
INSERT INTO `facturations` VALUES (13, 5, 3, 6, '2013-04-01', 0, '0.0', '0.0', '0.0', '0.0', '1.0', '0.0', '0.0', '1.0', '0000623867', 0, '2013-04-11', '2013-04-11') ; 
INSERT INTO `facturations` VALUES (14, 5, 21, 24, '2013-04-01', 0, '0.0', '1.0', '1.0', '1.0', '0.0', '0.0', '0.0', '3.0', '0000623867', 0, '2013-04-11', '2013-04-11') ; 
INSERT INTO `facturations` VALUES (15, 5, 3, 7, '2013-04-08', 0, '0.0', '0.0', '0.0', '0.0', '1.0', '0.0', '0.0', '1.0', '0000623868', 0, '2013-04-11', '2013-04-11') ; 
INSERT INTO `facturations` VALUES (16, 5, 21, 117, '2013-04-08', 0, '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '0.0', '4.0', '0000623868', 0, '2013-04-11', '2013-04-11') ; 
INSERT INTO `facturations` VALUES (17, 5, 3, 8, '2013-04-15', 0, '0.0', '0.0', '0.0', '0.0', '1.0', '0.0', '0.0', '1.0', '0000623869', 0, '2013-04-11', '2013-04-11') ; 
INSERT INTO `facturations` VALUES (18, 5, 21, 118, '2013-04-15', 0, '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '0.0', '4.0', '0000623869', 0, '2013-04-11', '2013-04-11') ; 
INSERT INTO `facturations` VALUES (19, 5, 3, 9, '2013-04-22', 0, '0.0', '0.0', '0.0', '0.0', '1.0', '0.0', '0.0', '1.0', '0000623870', 0, '2013-04-11', '2013-04-11') ; 
INSERT INTO `facturations` VALUES (20, 5, 21, 119, '2013-04-22', 0, '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '0.0', '4.0', '0000623870', 0, '2013-04-11', '2013-04-11') ; 
INSERT INTO `facturations` VALUES (21, 5, 3, 10, '2013-04-29', 0, '0.0', '0.0', '0.0', '0.0', '1.0', '0.0', '0.0', '1.0', '0000623871', 0, '2013-04-11', '2013-04-11') ; 
INSERT INTO `facturations` VALUES (22, 5, 1, 11, '2013-04-29', 0, '1.0', '1.0', '0.0', '1.0', '0.0', '0.0', '0.0', '3.0', '0000623871', 0, '2013-04-11', '2013-04-11') ; 
INSERT INTO `facturations` VALUES (23, 8, 2, 44, '2013-04-01', 0, '0.0', '1.0', '0.0', '0.0', '0.0', '0.0', '0.0', '1.0', '0000623873', 0, '2013-04-11', '2013-04-11') ; 
INSERT INTO `facturations` VALUES (24, 8, 3, 45, '2013-04-01', 0, '0.0', '0.0', '1.0', '0.0', '0.0', '0.0', '0.0', '1.0', '0000623873', 0, '2013-04-11', '2013-04-11') ; 
INSERT INTO `facturations` VALUES (25, 8, 12, 120, '2013-04-01', 0, '0.0', '0.0', '0.0', '1.0', '1.0', '0.0', '0.0', '2.0', '0000623873', 0, '2013-04-11', '2013-04-11') ; 
INSERT INTO `facturations` VALUES (26, 8, 12, 121, '2013-04-08', 0, '1.0', '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '5.0', '0000623874', 0, '2013-04-11', '2013-04-11') ; 
INSERT INTO `facturations` VALUES (27, 8, 12, 122, '2013-04-15', 0, '1.0', '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '5.0', '0000623875', 0, '2013-04-11', '2013-04-11') ; 
INSERT INTO `facturations` VALUES (28, 8, 12, 123, '2013-04-22', 0, '1.0', '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '5.0', '0000623876', 0, '2013-04-11', '2013-04-11') ; 
INSERT INTO `facturations` VALUES (29, 8, 12, 124, '2013-04-29', 0, '1.0', '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '5.0', '0000623878', 1, '2013-04-11', '2013-04-22') ; 
INSERT INTO `facturations` VALUES (30, 12, 5, 125, '2013-04-01', 0, '0.0', '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '4.0', '0000623886', 0, '2013-04-11', '2013-04-11') ; 
INSERT INTO `facturations` VALUES (31, 12, 5, 126, '2013-04-08', 0, '1.0', '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '5.0', '0000623888', 0, '2013-04-11', '2013-04-11') ; 
INSERT INTO `facturations` VALUES (32, 12, 5, 127, '2013-04-15', 0, '1.0', '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '5.0', '0000623891', 0, '2013-04-11', '2013-04-11') ; 
INSERT INTO `facturations` VALUES (33, 12, 5, 128, '2013-04-22', 0, '1.0', '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '5.0', '0000623895', 0, '2013-04-11', '2013-04-11') ; 
INSERT INTO `facturations` VALUES (34, 12, 5, 129, '2013-04-29', 0, '1.0', '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '5.0', '0000623897', 1, '2013-04-11', '2013-04-11') ; 
INSERT INTO `facturations` VALUES (35, 6, 22, 130, '2013-04-01', 0, '0.0', '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '4.0', '0000623898', 0, '2013-04-11', '2013-04-11') ; 
INSERT INTO `facturations` VALUES (36, 6, 22, 131, '2013-04-08', 0, '1.0', '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '5.0', '0000623899', 0, '2013-04-11', '2013-04-11') ; 
INSERT INTO `facturations` VALUES (37, 6, 22, 132, '2013-04-15', 0, '1.0', '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '5.0', '0000623901', 0, '2013-04-11', '2013-04-11') ; 
INSERT INTO `facturations` VALUES (38, 6, 22, 133, '2013-04-22', 0, '1.0', '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '5.0', '0000623902', 0, '2013-04-11', '2013-04-11') ; 
INSERT INTO `facturations` VALUES (39, 6, 3, 30, '2013-04-29', 0, '1.0', '1.0', '0.0', '1.0', '1.0', '0.0', '0.0', '4.0', '0000623903', 0, '2013-04-11', '2013-04-11') ; 
INSERT INTO `facturations` VALUES (40, 230, 24, 134, '2013-04-01', 0, '0.0', '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '4.0', '0000623915', 0, '2013-04-11', '2013-04-11') ; 
INSERT INTO `facturations` VALUES (41, 230, 22, 135, '2013-04-08', 0, '1.0', '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '5.0', '0000623917', 0, '2013-04-11', '2013-04-11') ; 
INSERT INTO `facturations` VALUES (42, 230, 22, 136, '2013-04-15', 0, '1.0', '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '5.0', '0000623918', 0, '2013-04-11', '2013-04-11') ; 
INSERT INTO `facturations` VALUES (43, 230, 2, 61, '2013-04-22', 0, '1.0', '1.0', '0.0', '1.0', '0.0', '0.0', '0.0', '3.0', '0000623920', 0, '2013-04-11', '2013-04-11') ; 
INSERT INTO `facturations` VALUES (44, 230, 1, 62, '2013-04-22', 0, '0.0', '0.0', '0.0', '0.0', '1.0', '0.0', '0.0', '1.0', '0000623920', 0, '2013-04-11', '2013-04-11') ; 
INSERT INTO `facturations` VALUES (45, 230, 22, 137, '2013-04-22', 0, '0.0', '0.0', '1.0', '0.0', '0.0', '0.0', '0.0', '1.0', '0000623920', 0, '2013-04-11', '2013-04-11') ; 
INSERT INTO `facturations` VALUES (46, 230, 22, 138, '2013-04-29', 0, '1.0', '1.0', '0.0', '1.0', '1.0', '0.0', '0.0', '4.0', '0000623922', 0, '2013-04-11', '2013-04-11') ; 
INSERT INTO `facturations` VALUES (47, 9, 2, 28, '2013-04-01', 0, '0.0', '1.0', '0.0', '0.0', '0.0', '0.0', '0.0', '1.0', '0000623923', 0, '2013-04-11', '2013-04-11') ; 
INSERT INTO `facturations` VALUES (48, 9, 21, 139, '2013-04-01', 0, '0.0', '0.0', '1.0', '1.0', '1.0', '0.0', '0.0', '3.0', '0000623923', 0, '2013-04-11', '2013-04-11') ; 
INSERT INTO `facturations` VALUES (49, 9, 21, 140, '2013-04-08', 0, '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '0.0', '4.0', '0000623924', 0, '2013-04-11', '2013-04-11') ; 
INSERT INTO `facturations` VALUES (50, 9, 22, 141, '2013-04-08', 0, '0.0', '0.0', '0.0', '0.0', '1.0', '0.0', '0.0', '1.0', '0000623924', 0, '2013-04-11', '2013-04-11') ; 
INSERT INTO `facturations` VALUES (51, 9, 22, 142, '2013-04-15', 0, '1.0', '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '5.0', '0000623925', 0, '2013-04-11', '2013-04-11') ; 
INSERT INTO `facturations` VALUES (52, 9, 1, 29, '2013-04-22', 0, '1.0', '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '5.0', '0000623926', 0, '2013-04-11', '2013-04-11') ; 
INSERT INTO `facturations` VALUES (53, 9, 22, 143, '2013-04-29', 0, '1.0', '1.0', '0.0', '1.0', '1.0', '0.0', '0.0', '4.0', '0000623928', 0, '2013-04-11', '2013-04-11') ; 
INSERT INTO `facturations` VALUES (54, 12, 5, NULL, '2013-04-29', 1, '1.0', '1.0', '0.0', '1.0', '1.0', '0.0', '0.0', '4.0', '0000623897', 0, '2013-04-11', '2013-04-11') ; 
INSERT INTO `facturations` VALUES (56, 10, 16, 144, '2013-04-01', 0, '0.0', '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '4.0', '0000623931', 0, '2013-04-11', '2013-04-11') ; 
INSERT INTO `facturations` VALUES (57, 10, 16, 145, '2013-04-08', 0, '1.0', '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '5.0', '0000623932', 0, '2013-04-11', '2013-04-11') ; 
INSERT INTO `facturations` VALUES (58, 10, 16, 146, '2013-04-15', 0, '1.0', '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '5.0', '0000623933', 0, '2013-04-11', '2013-04-11') ; 
INSERT INTO `facturations` VALUES (59, 10, 1, 31, '2013-04-22', 0, '1.0', '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '5.0', '0000623934', 0, '2013-04-11', '2013-04-11') ; 
INSERT INTO `facturations` VALUES (60, 10, 1, 32, '2013-04-29', 0, '1.0', '1.0', '0.0', '1.0', '1.0', '0.0', '0.0', '4.0', '0000623935', 0, '2013-04-11', '2013-04-11') ; 
INSERT INTO `facturations` VALUES (61, 17, 16, 159, '2013-04-29', 0, '1.0', '1.0', '0.0', '1.0', '1.0', '0.0', '0.0', '4.0', '0000000000', 0, '2013-04-15', '2013-04-15') ; 
INSERT INTO `facturations` VALUES (62, 17, 16, 158, '2013-04-22', 0, '1.0', '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '5.0', '0000000000', 0, '2013-04-15', '2013-04-15') ; 
INSERT INTO `facturations` VALUES (63, 17, 16, 157, '2013-04-15', 0, '1.0', '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '5.0', '0000000000', 0, '2013-04-15', '2013-04-15') ; 
INSERT INTO `facturations` VALUES (64, 17, 16, 156, '2013-04-08', 0, '1.0', '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '5.0', '0000000000', 0, '2013-04-15', '2013-04-15') ; 
INSERT INTO `facturations` VALUES (65, 17, 16, 155, '2013-04-01', 0, '0.0', '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '4.0', '0000000000', 0, '2013-04-15', '2013-04-15') ; 
INSERT INTO `facturations` VALUES (66, 18, 1, 51, '2013-04-29', 0, '1.0', '1.0', '0.0', '1.0', '1.0', '0.0', '0.0', '4.0', '0000000000', 0, '2013-04-15', '2013-04-15') ; 
INSERT INTO `facturations` VALUES (67, 18, 1, 50, '2013-04-22', 0, '1.0', '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '5.0', '0000000000', 0, '2013-04-15', '2013-04-15') ; 
INSERT INTO `facturations` VALUES (68, 18, 21, 167, '2013-04-15', 0, '1.0', '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '5.0', '0000000000', 0, '2013-04-15', '2013-04-15') ; 
INSERT INTO `facturations` VALUES (69, 18, 21, 166, '2013-04-08', 0, '1.0', '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '5.0', '0000000000', 0, '2013-04-15', '2013-04-15') ; 
INSERT INTO `facturations` VALUES (70, 18, 21, 165, '2013-04-01', 0, '0.0', '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '4.0', '0000000000', 0, '2013-04-15', '2013-04-15') ; 
INSERT INTO `facturations` VALUES (71, 36, 22, 164, '2013-04-29', 0, '1.0', '1.0', '0.0', '1.0', '1.0', '0.0', '0.0', '4.0', '0000000000', 0, '2013-04-15', '2013-04-15') ; 
INSERT INTO `facturations` VALUES (72, 36, 22, 163, '2013-04-22', 0, '1.0', '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '5.0', '0000000000', 0, '2013-04-15', '2013-04-15') ; 
INSERT INTO `facturations` VALUES (73, 36, 22, 162, '2013-04-15', 0, '1.0', '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '5.0', '0000000000', 1, '2013-04-15', '2013-04-18') ; 
INSERT INTO `facturations` VALUES (74, 36, 22, 161, '2013-04-08', 0, '1.0', '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '5.0', '0000000000', 0, '2013-04-15', '2013-04-15') ; 
INSERT INTO `facturations` VALUES (75, 36, 22, 160, '2013-04-01', 0, '0.0', '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '4.0', '0000000000', 0, '2013-04-15', '2013-04-15') ; 
INSERT INTO `facturations` VALUES (76, 38, 22, 199, '2013-04-29', 0, '1.0', '1.0', '0.0', '1.0', '1.0', '0.0', '0.0', '4.0', '0000000000', 0, '2013-04-15', '2013-04-15') ; 
INSERT INTO `facturations` VALUES (77, 38, 1, 52, '2013-04-22', 0, '0.0', '0.0', '0.0', '1.0', '1.0', '0.0', '0.0', '2.0', '0000000000', 0, '2013-04-15', '2013-04-15') ; 
INSERT INTO `facturations` VALUES (78, 38, 22, 198, '2013-04-22', 0, '1.0', '1.0', '1.0', '0.0', '0.0', '0.0', '0.0', '3.0', '0000000000', 0, '2013-04-15', '2013-04-15') ; 
INSERT INTO `facturations` VALUES (79, 38, 22, 197, '2013-04-15', 0, '1.0', '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '5.0', '0000000000', 0, '2013-04-15', '2013-04-15') ; 
INSERT INTO `facturations` VALUES (80, 38, 22, 196, '2013-04-08', 0, '1.0', '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '5.0', '0000000000', 0, '2013-04-15', '2013-04-15') ; 
INSERT INTO `facturations` VALUES (81, 38, 22, 195, '2013-04-01', 0, '0.0', '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '4.0', '0000000000', 0, '2013-04-15', '2013-04-15') ; 
INSERT INTO `facturations` VALUES (82, 40, 21, 154, '2013-04-29', 0, '0.0', '0.0', '0.0', '1.0', '1.0', '0.0', '0.0', '2.0', '0000000000', 1, '2013-04-15', '2013-04-15') ; 
INSERT INTO `facturations` VALUES (83, 40, 1, 148, '2013-04-29', 0, '1.0', '1.0', '0.0', '0.0', '0.0', '0.0', '0.0', '2.0', '0000000000', 1, '2013-04-15', '2013-04-15') ; 
INSERT INTO `facturations` VALUES (84, 40, 21, 153, '2013-04-22', 0, '1.0', '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '5.0', '0000000000', 0, '2013-04-15', '2013-04-15') ; 
INSERT INTO `facturations` VALUES (85, 40, 21, 152, '2013-04-15', 0, '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '0.0', '4.0', '0000000000', 0, '2013-04-15', '2013-04-15') ; 
INSERT INTO `facturations` VALUES (86, 40, 1, 147, '2013-04-15', 0, '0.0', '0.0', '0.0', '0.0', '1.0', '0.0', '0.0', '1.0', '0000000000', 0, '2013-04-15', '2013-04-15') ; 
INSERT INTO `facturations` VALUES (87, 40, 16, 150, '2013-04-08', 0, '1.0', '0.0', '0.0', '0.0', '0.0', '0.0', '0.0', '1.0', '0000000000', 0, '2013-04-15', '2013-04-15') ; 
INSERT INTO `facturations` VALUES (88, 40, 21, 151, '2013-04-08', 0, '0.0', '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '4.0', '0000000000', 0, '2013-04-15', '2013-04-15') ; 
INSERT INTO `facturations` VALUES (89, 40, 1, 49, '2013-04-01', 0, '0.0', '0.5', '0.0', '1.0', '1.0', '0.0', '0.0', '2.5', '0000000000', 0, '2013-04-15', '2013-04-15') ; 
INSERT INTO `facturations` VALUES (90, 40, 16, 149, '2013-04-01', 0, '0.0', '0.5', '1.0', '0.0', '0.0', '0.0', '0.0', '1.5', '0000000000', 0, '2013-04-15', '2013-04-15') ; 
INSERT INTO `facturations` VALUES (91, 171, 1, 57, '2013-04-29', 0, '1.0', '1.0', '0.0', '1.0', '1.0', '0.0', '0.0', '4.0', '0000000000', 0, '2013-04-15', '2013-04-15') ; 
INSERT INTO `facturations` VALUES (92, 171, 23, 178, '2013-04-22', 0, '1.0', '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '5.0', '0000000000', 0, '2013-04-15', '2013-04-15') ; 
INSERT INTO `facturations` VALUES (93, 171, 23, 177, '2013-04-15', 0, '1.0', '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '5.0', '0000000000', 0, '2013-04-15', '2013-04-15') ; 
INSERT INTO `facturations` VALUES (94, 171, 23, 176, '2013-04-08', 0, '0.0', '0.0', '0.0', '1.0', '1.0', '0.0', '0.0', '2.0', '0000000000', 0, '2013-04-15', '2013-04-15') ; 
INSERT INTO `facturations` VALUES (95, 171, 30, 175, '2013-04-08', 0, '1.0', '1.0', '1.0', '0.0', '0.0', '0.0', '0.0', '3.0', '0000000000', 0, '2013-04-15', '2013-04-15') ; 
INSERT INTO `facturations` VALUES (96, 171, 28, 174, '2013-04-01', 0, '0.0', '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '4.0', '0000000000', 0, '2013-04-15', '2013-04-15') ; 
INSERT INTO `facturations` VALUES (97, 172, 24, 172, '2013-04-29', 0, '1.0', '1.0', '0.0', '1.0', '1.0', '0.0', '0.0', '4.0', '0000000000', 0, '2013-04-15', '2013-04-15') ; 
INSERT INTO `facturations` VALUES (98, 172, 1, 56, '2013-04-22', 0, '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '0.0', '4.0', '0000000000', 0, '2013-04-15', '2013-04-15') ; 
INSERT INTO `facturations` VALUES (99, 172, 24, 171, '2013-04-22', 0, '0.5', '0.0', '0.0', '0.0', '1.0', '0.0', '0.0', '1.5', '0000000000', 0, '2013-04-15', '2013-04-15') ; 
INSERT INTO `facturations` VALUES (100, 172, 1, 55, '2013-04-15', 0, '0.0', '0.0', '0.0', '1.0', '1.0', '0.0', '0.0', '2.0', '0000000000', 0, '2013-04-15', '2013-04-15') ; 
INSERT INTO `facturations` VALUES (101, 172, 27, 173, '2013-04-15', 0, '1.0', '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '5.0', '0000000000', 0, '2013-04-15', '2013-04-15') ; 
INSERT INTO `facturations` VALUES (102, 172, 24, 169, '2013-04-08', 0, '1.0', '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '5.0', '0000000000', 0, '2013-04-15', '2013-04-15') ; 
INSERT INTO `facturations` VALUES (103, 172, 1, 54, '2013-04-08', 0, '1.0', '0.0', '0.0', '0.0', '0.0', '0.0', '0.0', '1.0', '0000000000', 0, '2013-04-15', '2013-04-15') ; 
INSERT INTO `facturations` VALUES (104, 172, 1, 53, '2013-04-01', 0, '0.0', '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '4.0', '0000000000', 0, '2013-04-15', '2013-04-15') ; 
INSERT INTO `facturations` VALUES (105, 172, 24, 168, '2013-04-01', 0, '0.0', '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '4.0', '0000000000', 0, '2013-04-15', '2013-04-15') ; 
INSERT INTO `facturations` VALUES (106, 176, 1, 58, '2013-04-29', 0, '1.0', '1.0', '0.0', '1.0', '1.0', '0.0', '0.0', '4.0', '0000000000', 0, '2013-04-15', '2013-04-15') ; 
INSERT INTO `facturations` VALUES (107, 176, 27, 184, '2013-04-22', 0, '0.0', '0.0', '0.0', '0.0', '1.0', '0.0', '0.0', '1.0', '0000000000', 0, '2013-04-15', '2013-04-15') ; 
INSERT INTO `facturations` VALUES (108, 176, 24, 182, '2013-04-22', 0, '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '0.0', '4.0', '0000000000', 1, '2013-04-15', '2013-04-18') ; 
INSERT INTO `facturations` VALUES (109, 176, 24, 181, '2013-04-15', 0, '1.0', '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '5.0', '0000000000', 0, '2013-04-15', '2013-04-15') ; 
INSERT INTO `facturations` VALUES (110, 176, 1, 183, '2013-04-08', 0, '0.0', '0.0', '0.0', '0.0', '1.0', '0.0', '0.0', '1.0', '0000000000', 0, '2013-04-15', '2013-04-15') ; 
INSERT INTO `facturations` VALUES (111, 176, 27, 180, '2013-04-08', 0, '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '0.0', '4.0', '0000000000', 0, '2013-04-15', '2013-04-15') ; 
INSERT INTO `facturations` VALUES (112, 176, 27, 179, '2013-04-01', 0, '0.0', '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '4.0', '0000000000', 0, '2013-04-15', '2013-04-15') ; 
INSERT INTO `facturations` VALUES (113, 237, 14, 189, '2013-04-29', 0, '1.0', '1.0', '0.0', '0.0', '0.0', '0.0', '0.0', '2.0', '0000000000', 0, '2013-04-15', '2013-04-15') ; 
INSERT INTO `facturations` VALUES (114, 237, 1, 85, '2013-04-29', 0, '0.0', '0.0', '0.0', '1.0', '1.0', '0.0', '0.0', '2.0', '0000000000', 0, '2013-04-15', '2013-04-15') ; 
INSERT INTO `facturations` VALUES (115, 237, 14, 188, '2013-04-22', 0, '1.0', '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '5.0', '0000000000', 0, '2013-04-15', '2013-04-15') ; 
INSERT INTO `facturations` VALUES (116, 237, 14, 187, '2013-04-15', 0, '1.0', '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '5.0', '0000000000', 0, '2013-04-15', '2013-04-15') ; 
INSERT INTO `facturations` VALUES (117, 237, 23, 186, '2013-04-08', 0, '1.0', '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '5.0', '0000000000', 0, '2013-04-15', '2013-04-15') ; 
INSERT INTO `facturations` VALUES (118, 237, 23, 185, '2013-04-01', 0, '0.0', '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '4.0', '0000000000', 0, '2013-04-15', '2013-04-15') ; 
INSERT INTO `facturations` VALUES (119, 265, 24, 204, '2013-04-29', 0, '1.0', '1.0', '0.0', '1.0', '1.0', '0.0', '0.0', '4.0', '0000000000', 0, '2013-04-15', '2013-04-15') ; 
INSERT INTO `facturations` VALUES (120, 265, 24, 203, '2013-04-22', 0, '1.0', '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '5.0', '0000000000', 0, '2013-04-15', '2013-04-15') ; 
INSERT INTO `facturations` VALUES (121, 265, 24, 202, '2013-04-15', 0, '1.0', '1.0', '0.0', '1.0', '1.0', '0.0', '0.0', '4.0', '0000000000', 0, '2013-04-15', '2013-04-15') ; 
INSERT INTO `facturations` VALUES (122, 265, 1, 25, '2013-04-15', 0, '0.0', '0.0', '1.0', '0.0', '0.0', '0.0', '0.0', '1.0', '0000000000', 0, '2013-04-15', '2013-04-15') ; 
INSERT INTO `facturations` VALUES (123, 265, 1, 23, '2013-04-08', 0, '0.0', '0.0', '1.0', '0.0', '0.0', '0.0', '0.0', '1.0', '0000000000', 0, '2013-04-15', '2013-04-15') ; 
INSERT INTO `facturations` VALUES (124, 265, 27, 201, '2013-04-08', 0, '1.0', '1.0', '0.0', '1.0', '1.0', '0.0', '0.0', '4.0', '0000000000', 0, '2013-04-15', '2013-04-15') ; 
INSERT INTO `facturations` VALUES (125, 265, 27, 200, '2013-04-01', 0, '0.0', '1.0', '1.0', '1.0', '0.0', '0.0', '0.0', '3.0', '0000000000', 0, '2013-04-15', '2013-04-15') ; 
INSERT INTO `facturations` VALUES (126, 265, 1, 22, '2013-04-01', 0, '0.0', '0.0', '0.0', '0.0', '1.0', '0.0', '0.0', '1.0', '0000000000', 0, '2013-04-15', '2013-04-15') ; 
INSERT INTO `facturations` VALUES (127, 268, 21, 194, '2013-04-29', 0, '1.0', '1.0', '0.0', '1.0', '1.0', '0.0', '0.0', '4.0', '0000000000', 0, '2013-04-15', '2013-04-15') ; 
INSERT INTO `facturations` VALUES (128, 268, 21, 193, '2013-04-22', 0, '1.0', '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '5.0', '0000000000', 0, '2013-04-15', '2013-04-15') ; 
INSERT INTO `facturations` VALUES (129, 268, 21, 192, '2013-04-15', 0, '1.0', '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '5.0', '0000000000', 0, '2013-04-15', '2013-04-15') ; 
INSERT INTO `facturations` VALUES (130, 268, 21, 191, '2013-04-08', 0, '1.0', '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '5.0', '0000000000', 0, '2013-04-15', '2013-04-15') ; 
INSERT INTO `facturations` VALUES (131, 268, 21, 190, '2013-04-01', 0, '0.0', '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '4.0', '0000000000', 0, '2013-04-15', '2013-04-15') ; 
INSERT INTO `facturations` VALUES (132, 272, 21, 205, '2013-04-01', 0, '0.0', '1.0', '1.0', '0.0', '0.0', '0.0', '0.0', '2.0', '0000000000', 0, '2013-04-15', '2013-04-15') ; 
INSERT INTO `facturations` VALUES (133, 33, 1, 83, '2013-04-29', 0, '0.0', '0.0', '0.0', '1.0', '1.0', '0.0', '0.0', '2.0', '0000000000', 0, '2013-04-15', '2013-04-15') ; 
INSERT INTO `facturations` VALUES (134, 33, 21, 260, '2013-04-29', 0, '1.0', '1.0', '0.0', '0.0', '0.0', '0.0', '0.0', '2.0', '0000000000', 0, '2013-04-15', '2013-04-15') ; 
INSERT INTO `facturations` VALUES (135, 33, 21, 259, '2013-04-22', 0, '1.0', '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '5.0', '0000000000', 0, '2013-04-15', '2013-04-15') ; 
INSERT INTO `facturations` VALUES (136, 33, 21, 258, '2013-04-15', 0, '1.0', '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '5.0', '0000000000', 0, '2013-04-15', '2013-04-15') ; 
INSERT INTO `facturations` VALUES (137, 33, 21, 257, '2013-04-08', 0, '1.0', '1.0', '1.0', '0.0', '1.0', '0.0', '0.0', '4.0', '0000000000', 0, '2013-04-15', '2013-04-15') ; 
INSERT INTO `facturations` VALUES (138, 33, 1, 60, '2013-04-08', 0, '0.0', '0.0', '0.0', '1.0', '0.0', '0.0', '0.0', '1.0', '0000000000', 0, '2013-04-15', '2013-04-15') ; 
INSERT INTO `facturations` VALUES (139, 33, 21, 256, '2013-04-01', 0, '0.0', '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '4.0', '0000000000', 0, '2013-04-15', '2013-04-15') ; 
INSERT INTO `facturations` VALUES (140, 140, 1, 80, '2013-04-29', 0, '0.0', '0.0', '0.0', '1.0', '1.0', '0.0', '0.0', '2.0', '0000000000', 0, '2013-04-15', '2013-04-15') ; 
INSERT INTO `facturations` VALUES (141, 140, 16, 255, '2013-04-29', 0, '1.0', '1.0', '0.0', '0.0', '0.0', '0.0', '0.0', '2.0', '0000000000', 0, '2013-04-15', '2013-04-15') ; 
INSERT INTO `facturations` VALUES (142, 140, 16, 254, '2013-04-22', 0, '1.0', '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '5.0', '0000000000', 0, '2013-04-15', '2013-04-15') ; 
INSERT INTO `facturations` VALUES (143, 140, 16, 253, '2013-04-15', 0, '1.0', '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '5.0', '0000000000', 0, '2013-04-15', '2013-04-15') ; 
INSERT INTO `facturations` VALUES (144, 140, 16, 252, '2013-04-08', 0, '1.0', '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '5.0', '0000000000', 0, '2013-04-15', '2013-04-15') ; 
INSERT INTO `facturations` VALUES (145, 140, 16, 251, '2013-04-01', 0, '0.0', '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '4.0', '0000000000', 0, '2013-04-15', '2013-04-15') ; 
INSERT INTO `facturations` VALUES (146, 268, 21, 190, '2013-04-01', 0, '0.0', '1.0', '1.0', '0.0', '0.0', '0.0', '0.0', '2.0', '', 0, '2013-04-15', '2013-04-15') ; 
INSERT INTO `facturations` VALUES (147, 268, 1, 261, '2013-04-01', 0, '0.0', '0.0', '0.0', '1.0', '1.0', '0.0', '0.0', '2.0', '', 0, '2013-04-15', '2013-04-15') ; 
INSERT INTO `facturations` VALUES (148, 14, 14, 221, '2013-04-01', 0, '0.0', '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '4.0', '0000625256', 0, '2013-04-16', '2013-04-16') ; 
INSERT INTO `facturations` VALUES (149, 14, 14, 222, '2013-04-08', 0, '1.0', '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '5.0', '0000625257', 0, '2013-04-16', '2013-04-16') ; 
INSERT INTO `facturations` VALUES (150, 14, 14, 223, '2013-04-15', 0, '1.0', '1.0', '0.0', '0.0', '0.0', '0.0', '0.0', '2.0', '0000625258', 0, '2013-04-16', '2013-04-16') ; 
INSERT INTO `facturations` VALUES (151, 14, 28, 224, '2013-04-15', 0, '0.0', '0.0', '1.0', '1.0', '1.0', '0.0', '0.0', '3.0', '0000625258', 0, '2013-04-16', '2013-04-16') ; 
INSERT INTO `facturations` VALUES (152, 14, 3, 219, '2013-04-22', 0, '1.0', '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '5.0', '0000625259', 0, '2013-04-16', '2013-04-16') ; 
INSERT INTO `facturations` VALUES (153, 14, 3, 220, '2013-04-29', 0, '1.0', '1.0', '0.0', '1.0', '1.0', '0.0', '0.0', '4.0', '0000625260', 1, '2013-04-16', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (154, 16, 22, 231, '2013-04-01', 0, '0.0', '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '4.0', '0000625262', 0, '2013-04-16', '2013-04-16') ; 
INSERT INTO `facturations` VALUES (155, 16, 22, 232, '2013-04-08', 0, '1.0', '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '5.0', '0000625263', 0, '2013-04-16', '2013-04-16') ; 
INSERT INTO `facturations` VALUES (156, 16, 1, 41, '2013-04-22', 0, '1.0', '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '5.0', '0000625265', 0, '2013-04-16', '2013-04-16') ; 
INSERT INTO `facturations` VALUES (157, 16, 22, 234, '2013-04-29', 0, '1.0', '1.0', '0.0', '1.0', '1.0', '0.0', '0.0', '4.0', '0000625266', 1, '2013-04-16', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (158, 13, 3, 35, '2013-04-01', 0, '0.0', '0.0', '1.0', '0.0', '0.0', '0.0', '0.0', '1.0', '0000625269', 0, '2013-04-16', '2013-04-16') ; 
INSERT INTO `facturations` VALUES (159, 13, 38, 247, '2013-04-01', 0, '0.0', '1.0', '0.0', '1.0', '1.0', '0.0', '0.0', '3.0', '0000625269', 0, '2013-04-16', '2013-04-16') ; 
INSERT INTO `facturations` VALUES (160, 13, 3, 36, '2013-04-08', 0, '0.0', '0.0', '1.0', '0.0', '0.0', '0.0', '0.0', '1.0', '0000625271', 0, '2013-04-16', '2013-04-16') ; 
INSERT INTO `facturations` VALUES (161, 13, 37, 245, '2013-04-08', 0, '0.0', '0.0', '0.0', '1.0', '0.0', '0.0', '0.0', '1.0', '0000625271', 0, '2013-04-16', '2013-04-16') ; 
INSERT INTO `facturations` VALUES (162, 13, 34, 249, '2013-04-08', 0, '1.0', '1.0', '0.0', '0.0', '1.0', '0.0', '0.0', '3.0', '0000625271', 0, '2013-04-16', '2013-04-16') ; 
INSERT INTO `facturations` VALUES (163, 13, 3, 37, '2013-04-15', 0, '0.0', '0.0', '1.0', '0.0', '0.0', '0.0', '0.0', '1.0', '0000625273', 0, '2013-04-16', '2013-04-16') ; 
INSERT INTO `facturations` VALUES (164, 13, 37, 246, '2013-04-15', 0, '1.0', '1.0', '0.0', '0.0', '0.0', '0.0', '0.0', '2.0', '0000625273', 0, '2013-04-16', '2013-04-16') ; 
INSERT INTO `facturations` VALUES (165, 13, 34, 250, '2013-04-15', 0, '0.0', '0.0', '0.0', '1.0', '1.0', '0.0', '0.0', '2.0', '0000625273', 0, '2013-04-16', '2013-04-16') ; 
INSERT INTO `facturations` VALUES (166, 13, 3, 38, '2013-04-22', 0, '0.0', '0.0', '1.0', '0.0', '0.0', '0.0', '0.0', '1.0', '0000625274', 0, '2013-04-16', '2013-04-16') ; 
INSERT INTO `facturations` VALUES (167, 13, 1, 40, '2013-04-22', 0, '1.0', '1.0', '0.0', '1.0', '1.0', '0.0', '0.0', '4.0', '0000625274', 0, '2013-04-16', '2013-04-16') ; 
INSERT INTO `facturations` VALUES (168, 13, 3, 39, '2013-04-29', 0, '1.0', '0.0', '0.0', '0.0', '0.0', '0.0', '0.0', '1.0', '0000625276', 0, '2013-04-16', '2013-04-16') ; 
INSERT INTO `facturations` VALUES (169, 13, 38, 248, '2013-04-29', 0, '0.0', '1.0', '0.0', '1.0', '1.0', '0.0', '0.0', '3.0', '0000625276', 0, '2013-04-16', '2013-04-16') ; 
INSERT INTO `facturations` VALUES (170, 231, 21, 225, '2013-04-01', 0, '0.0', '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '4.0', '0000625277', 0, '2013-04-16', '2013-04-16') ; 
INSERT INTO `facturations` VALUES (171, 231, 21, 226, '2013-04-08', 0, '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '0.0', '4.0', '0000625278', 0, '2013-04-16', '2013-04-16') ; 
INSERT INTO `facturations` VALUES (172, 231, 22, 227, '2013-04-08', 0, '0.0', '0.0', '0.0', '0.0', '1.0', '0.0', '0.0', '1.0', '0000625278', 0, '2013-04-16', '2013-04-16') ; 
INSERT INTO `facturations` VALUES (173, 231, 22, 229, '2013-04-15', 0, '1.0', '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '5.0', '0000625279', 0, '2013-04-16', '2013-04-16') ; 
INSERT INTO `facturations` VALUES (174, 231, 16, 228, '2013-04-22', 0, '1.0', '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '5.0', '0000625280', 0, '2013-04-16', '2013-04-16') ; 
INSERT INTO `facturations` VALUES (175, 231, 22, 230, '2013-04-29', 0, '1.0', '1.0', '0.0', '1.0', '1.0', '0.0', '0.0', '4.0', '0000625281', 1, '2013-04-16', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (176, 231, 1, 262, '2013-05-06', 0, '1.0', '1.0', '0.0', '0.0', '1.0', '0.0', '0.0', '3.0', '0000625284', 1, '2013-04-16', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (177, 11, 14, 207, '2013-04-01', 0, '0.0', '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '4.0', '0000625286', 0, '2013-04-16', '2013-04-16') ; 
INSERT INTO `facturations` VALUES (178, 11, 1, 206, '2013-04-08', 0, '0.0', '0.0', '0.5', '0.0', '0.0', '0.0', '0.0', '0.5', '0000625289', 0, '2013-04-16', '2013-04-16') ; 
INSERT INTO `facturations` VALUES (179, 11, 14, 208, '2013-04-08', 0, '1.0', '1.0', '0.5', '1.0', '1.0', '0.0', '0.0', '4.5', '0000625289', 0, '2013-04-16', '2013-04-16') ; 
INSERT INTO `facturations` VALUES (180, 11, 14, 209, '2013-04-15', 0, '1.0', '1.0', '0.5', '0.0', '0.0', '0.0', '0.0', '2.5', '0000625291', 0, '2013-04-16', '2013-04-16') ; 
INSERT INTO `facturations` VALUES (181, 11, 23, 211, '2013-04-15', 0, '0.0', '0.0', '0.5', '1.0', '1.0', '0.0', '0.0', '2.5', '0000625291', 0, '2013-04-16', '2013-04-16') ; 
INSERT INTO `facturations` VALUES (182, 11, 23, 212, '2013-04-22', 0, '1.0', '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '5.0', '0000625293', 0, '2013-04-16', '2013-04-16') ; 
INSERT INTO `facturations` VALUES (183, 11, 1, 34, '2013-04-29', 0, '0.0', '0.0', '0.0', '1.0', '1.0', '0.0', '0.0', '2.0', '0000625294', 1, '2013-04-16', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (184, 11, 23, 213, '2013-04-29', 0, '1.0', '1.0', '0.0', '0.0', '0.0', '0.0', '0.0', '2.0', '0000625294', 1, '2013-04-16', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (185, 255, 24, 214, '2013-04-01', 0, '0.0', '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '4.0', '0000625297', 0, '2013-04-16', '2013-04-16') ; 
INSERT INTO `facturations` VALUES (186, 255, 24, 215, '2013-04-08', 0, '1.0', '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '5.0', '0000625299', 0, '2013-04-16', '2013-04-16') ; 
INSERT INTO `facturations` VALUES (187, 255, 24, 216, '2013-04-15', 0, '1.0', '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '5.0', '0000625300', 0, '2013-04-16', '2013-04-16') ; 
INSERT INTO `facturations` VALUES (188, 255, 24, 217, '2013-04-22', 0, '1.0', '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '5.0', '0000625301', 0, '2013-04-16', '2013-04-16') ; 
INSERT INTO `facturations` VALUES (189, 255, 24, 218, '2013-04-29', 0, '1.0', '1.0', '0.0', '1.0', '1.0', '0.0', '0.0', '4.0', '0000625303', 1, '2013-04-16', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (190, 7, 3, 46, '2013-04-01', 0, '0.0', '0.0', '1.0', '0.0', '0.0', '0.0', '0.0', '1.0', '0000625304', 0, '2013-04-16', '2013-04-16') ; 
INSERT INTO `facturations` VALUES (191, 7, 28, 236, '2013-04-01', 0, '0.0', '1.0', '0.0', '1.0', '1.0', '0.0', '0.0', '3.0', '0000625304', 0, '2013-04-16', '2013-04-16') ; 
INSERT INTO `facturations` VALUES (192, 7, 3, 47, '2013-04-08', 0, '0.0', '0.0', '1.0', '0.0', '0.0', '0.0', '0.0', '1.0', '0000625305', 0, '2013-04-16', '2013-04-16') ; 
INSERT INTO `facturations` VALUES (193, 7, 28, 237, '2013-04-08', 0, '0.0', '1.0', '0.0', '1.0', '1.0', '0.0', '0.0', '3.0', '0000625305', 0, '2013-04-16', '2013-04-16') ; 
INSERT INTO `facturations` VALUES (194, 7, 30, 238, '2013-04-08', 0, '1.0', '0.0', '0.0', '0.0', '0.0', '0.0', '0.0', '1.0', '0000625305', 0, '2013-04-16', '2013-04-16') ; 
INSERT INTO `facturations` VALUES (195, 7, 3, 48, '2013-04-15', 0, '0.0', '0.0', '1.0', '0.0', '0.0', '0.0', '0.0', '1.0', '0000625306', 1, '2013-04-16', '2013-04-16') ; 
INSERT INTO `facturations` VALUES (196, 7, 30, 239, '2013-04-15', 0, '1.0', '0.0', '0.0', '0.0', '0.0', '0.0', '0.0', '1.0', '0000625306', 1, '2013-04-16', '2013-04-16') ; 
INSERT INTO `facturations` VALUES (197, 7, 31, 242, '2013-04-15', 0, '0.0', '1.0', '0.0', '0.0', '0.0', '0.0', '0.0', '1.0', '0000625306', 1, '2013-04-16', '2013-04-16') ; 
INSERT INTO `facturations` VALUES (198, 7, 32, 243, '2013-04-15', 0, '0.0', '0.0', '0.0', '1.0', '1.0', '0.0', '0.0', '2.0', '0000625306', 1, '2013-04-16', '2013-04-16') ; 
INSERT INTO `facturations` VALUES (199, 7, 37, 235, '2013-04-22', 0, '1.0', '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '5.0', '0000625307', 0, '2013-04-16', '2013-04-16') ; 
INSERT INTO `facturations` VALUES (200, 7, 3, 72, '2013-04-29', 0, '0.0', '0.0', '0.0', '0.0', '1.0', '0.0', '0.0', '1.0', '0000625310', 0, '2013-04-16', '2013-04-16') ; 
INSERT INTO `facturations` VALUES (201, 7, 32, 241, '2013-04-29', 0, '1.0', '1.0', '0.0', '0.0', '0.0', '0.0', '0.0', '2.0', '0000625310', 0, '2013-04-16', '2013-04-16') ; 
INSERT INTO `facturations` VALUES (202, 7, 28, 244, '2013-04-29', 0, '0.0', '0.0', '0.0', '1.0', '0.0', '0.0', '0.0', '1.0', '0000625310', 0, '2013-04-16', '2013-04-16') ; 
INSERT INTO `facturations` VALUES (203, 7, 3, NULL, '2013-04-15', 1, '0.0', '0.0', '1.0', '0.0', '0.0', '0.0', '0.0', '1.0', '0000625306', 1, '2013-04-16', '2013-04-16') ; 
INSERT INTO `facturations` VALUES (204, 7, 30, NULL, '2013-04-15', 1, '1.0', '0.0', '0.0', '0.0', '0.0', '0.0', '0.0', '1.0', '0000625306', 1, '2013-04-16', '2013-04-16') ; 
INSERT INTO `facturations` VALUES (205, 7, 32, NULL, '2013-04-15', 1, '0.0', '1.0', '0.0', '0.0', '0.0', '0.0', '0.0', '1.0', '0000625306', 1, '2013-04-16', '2013-04-16') ; 
INSERT INTO `facturations` VALUES (206, 7, 32, NULL, '2013-04-15', 1, '0.0', '0.0', '0.0', '1.0', '1.0', '0.0', '0.0', '2.0', '0000625306', 1, '2013-04-16', '2013-04-16') ; 
INSERT INTO `facturations` VALUES (207, 7, 3, NULL, '2013-04-15', 2, '0.0', '0.0', '1.0', '0.0', '0.0', '0.0', '0.0', '1.0', '0000625306', 0, '2013-04-16', '2013-04-16') ; 
INSERT INTO `facturations` VALUES (208, 7, 30, NULL, '2013-04-15', 2, '1.0', '0.0', '0.0', '0.0', '0.0', '0.0', '0.0', '1.0', '0000625306', 0, '2013-04-16', '2013-04-16') ; 
INSERT INTO `facturations` VALUES (209, 7, 32, NULL, '2013-04-15', 2, '0.0', '1.0', '0.0', '0.0', '0.0', '0.0', '0.0', '1.0', '0000625306', 0, '2013-04-16', '2013-04-16') ; 
INSERT INTO `facturations` VALUES (210, 7, 33, NULL, '2013-04-15', 2, '0.0', '0.0', '0.0', '1.0', '1.0', '0.0', '0.0', '2.0', '0000625306', 0, '2013-04-16', '2013-04-16') ; 
INSERT INTO `facturations` VALUES (211, 34, 1, 263, '2013-04-01', 0, '0.0', '0.0', '0.0', '1.0', '0.0', '0.0', '0.0', '1.0', '0000625419', 0, '2013-04-16', '2013-04-16') ; 
INSERT INTO `facturations` VALUES (212, 34, 14, 268, '2013-04-01', 0, '0.0', '1.0', '1.0', '0.0', '1.0', '0.0', '0.0', '3.0', '0000625419', 0, '2013-04-16', '2013-04-16') ; 
INSERT INTO `facturations` VALUES (213, 34, 38, 269, '2013-04-08', 0, '1.0', '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '5.0', '0000625420', 0, '2013-04-16', '2013-04-16') ; 
INSERT INTO `facturations` VALUES (214, 34, 1, 264, '2013-04-15', 0, '1.0', '0.0', '0.0', '0.0', '0.0', '0.0', '0.0', '1.0', '0000625421', 0, '2013-04-16', '2013-04-16') ; 
INSERT INTO `facturations` VALUES (215, 34, 38, 270, '2013-04-15', 0, '0.0', '0.0', '0.0', '0.0', '1.0', '0.0', '0.0', '1.0', '0000625421', 0, '2013-04-16', '2013-04-16') ; 
INSERT INTO `facturations` VALUES (216, 34, 13, 271, '2013-04-15', 0, '0.0', '1.0', '1.0', '0.0', '0.0', '0.0', '0.0', '2.0', '0000625421', 0, '2013-04-16', '2013-04-16') ; 
INSERT INTO `facturations` VALUES (217, 34, 23, 272, '2013-04-15', 0, '0.0', '0.0', '0.0', '1.0', '0.0', '0.0', '0.0', '1.0', '0000625421', 0, '2013-04-16', '2013-04-16') ; 
INSERT INTO `facturations` VALUES (218, 34, 6, 265, '2013-04-22', 0, '1.0', '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '5.0', '0000625423', 0, '2013-04-16', '2013-04-16') ; 
INSERT INTO `facturations` VALUES (219, 34, 6, 266, '2013-04-29', 0, '1.0', '1.0', '0.0', '1.0', '0.0', '0.0', '0.0', '3.0', '0000625425', 1, '2013-04-16', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (220, 34, 1, 267, '2013-04-29', 0, '0.0', '0.0', '0.0', '0.0', '1.0', '0.0', '0.0', '1.0', '0000625425', 1, '2013-04-16', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (221, 36, 22, NULL, '2013-04-15', 1, '0.0', '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '4.0', '0000000000', 0, '2013-04-18', '2013-04-18') ; 
INSERT INTO `facturations` VALUES (222, 176, 24, NULL, '2013-04-22', 1, '1.0', '1.0', '1.0', '0.0', '0.0', '0.0', '0.0', '3.0', '0000000000', 0, '2013-04-18', '2013-04-18') ; 
INSERT INTO `facturations` VALUES (223, 8, 12, 124, '2013-04-29', 1, '1.0', '1.0', '0.0', '1.0', '1.0', '0.0', '0.0', '4.0', '0000623878', 0, '2013-04-22', '2013-04-22') ; 
INSERT INTO `facturations` VALUES (224, 4, 1, 27, '2013-04-01', 0, '0.0', '1.0', '1.0', '0.0', '0.0', '0.0', '0.0', '2.0', '0000000000', 0, '2013-04-22', '2013-04-22') ; 
INSERT INTO `facturations` VALUES (225, 4, 1, 26, '2013-03-25', 0, '0.0', '0.0', '0.0', '1.0', '1.0', '0.0', '0.0', '2.0', '0000000000', 0, '2013-04-22', '2013-04-22') ; 
INSERT INTO `facturations` VALUES (226, 40, 1, 148, '2013-04-29', 0, '0.0', '1.0', '0.0', '0.0', '0.0', '0.0', '0.0', '1.0', '0000000000', 0, '2013-04-24', '2013-04-24') ; 
INSERT INTO `facturations` VALUES (227, 40, 21, 154, '2013-04-29', 0, '1.0', '0.0', '0.0', '1.0', '1.0', '0.0', '0.0', '3.0', '0000000000', 0, '2013-04-24', '2013-04-24') ; 
INSERT INTO `facturations` VALUES (228, 17, 16, 387, '2013-05-27', 0, '1.0', '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '5.0', '0000000000', 0, '2013-05-16', '2013-05-16') ; 
INSERT INTO `facturations` VALUES (229, 17, 16, 386, '2013-05-20', 0, '0.0', '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '4.0', '0000000000', 0, '2013-05-16', '2013-05-16') ; 
INSERT INTO `facturations` VALUES (230, 17, 1, 78, '2013-05-13', 0, '0.0', '0.0', '0.0', '0.0', '1.0', '0.0', '0.0', '1.0', '0000000000', 0, '2013-05-16', '2013-05-16') ; 
INSERT INTO `facturations` VALUES (231, 17, 16, 385, '2013-05-13', 0, '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '0.0', '4.0', '0000000000', 0, '2013-05-16', '2013-05-16') ; 
INSERT INTO `facturations` VALUES (232, 17, 16, 384, '2013-05-06', 0, '1.0', '1.0', '0.0', '0.0', '1.0', '0.0', '0.0', '3.0', '0000000000', 0, '2013-05-16', '2013-05-16') ; 
INSERT INTO `facturations` VALUES (233, 265, 27, 391, '2013-05-27', 0, '1.0', '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '5.0', '0000000000', 0, '2013-05-16', '2013-05-16') ; 
INSERT INTO `facturations` VALUES (234, 265, 24, 390, '2013-05-20', 0, '0.0', '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '4.0', '0000000000', 1, '2013-05-16', '2013-05-16') ; 
INSERT INTO `facturations` VALUES (235, 265, 24, 389, '2013-05-13', 0, '1.0', '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '5.0', '0000000000', 0, '2013-05-16', '2013-05-16') ; 
INSERT INTO `facturations` VALUES (236, 265, 1, 87, '2013-05-06', 0, '0.0', '0.0', '0.0', '0.0', '1.0', '0.0', '0.0', '1.0', '0000000000', 0, '2013-05-16', '2013-05-16') ; 
INSERT INTO `facturations` VALUES (237, 265, 24, 388, '2013-05-06', 0, '1.0', '1.0', '0.0', '0.0', '0.0', '0.0', '0.0', '2.0', '0000000000', 0, '2013-05-16', '2013-05-16') ; 
INSERT INTO `facturations` VALUES (238, 268, 21, 396, '2013-05-27', 0, '1.0', '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '5.0', '0000000000', 0, '2013-05-16', '2013-05-16') ; 
INSERT INTO `facturations` VALUES (239, 268, 21, 395, '2013-05-20', 0, '0.0', '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '4.0', '0000000000', 0, '2013-05-16', '2013-05-16') ; 
INSERT INTO `facturations` VALUES (240, 268, 21, 394, '2013-05-13', 0, '1.0', '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '5.0', '0000000000', 0, '2013-05-16', '2013-05-16') ; 
INSERT INTO `facturations` VALUES (241, 268, 1, 392, '2013-05-06', 0, '0.0', '0.0', '0.0', '0.0', '1.0', '0.0', '0.0', '1.0', '0000000000', 0, '2013-05-16', '2013-05-16') ; 
INSERT INTO `facturations` VALUES (242, 268, 21, 393, '2013-05-06', 0, '1.0', '1.0', '0.0', '0.0', '0.0', '0.0', '0.0', '2.0', '0000000000', 0, '2013-05-16', '2013-05-16') ; 
INSERT INTO `facturations` VALUES (243, 140, 21, 399, '2013-05-27', 0, '1.0', '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '5.0', '0000000000', 0, '2013-05-16', '2013-05-16') ; 
INSERT INTO `facturations` VALUES (244, 140, 21, 398, '2013-05-20', 0, '0.0', '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '4.0', '0000000000', 0, '2013-05-16', '2013-05-16') ; 
INSERT INTO `facturations` VALUES (245, 140, 21, 397, '2013-05-13', 0, '1.0', '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '5.0', '0000000000', 0, '2013-05-16', '2013-05-16') ; 
INSERT INTO `facturations` VALUES (246, 140, 1, 81, '2013-05-06', 0, '1.0', '1.0', '0.0', '0.0', '1.0', '0.0', '0.0', '3.0', '0000000000', 0, '2013-05-16', '2013-05-16') ; 
INSERT INTO `facturations` VALUES (247, 272, 21, 400, '2013-05-06', 0, '1.0', '1.0', '0.0', '0.0', '0.0', '0.0', '0.0', '2.0', '0000000000', 0, '2013-05-16', '2013-05-16') ; 
INSERT INTO `facturations` VALUES (248, 36, 22, 406, '2013-05-27', 0, '1.0', '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '5.0', '0000000000', 0, '2013-05-16', '2013-05-16') ; 
INSERT INTO `facturations` VALUES (249, 36, 22, 405, '2013-05-20', 0, '0.0', '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '4.0', '0000000000', 0, '2013-05-16', '2013-05-16') ; 
INSERT INTO `facturations` VALUES (250, 36, 22, 403, '2013-05-13', 0, '1.0', '0.0', '0.0', '0.0', '0.0', '0.0', '0.0', '1.0', '0000000000', 0, '2013-05-16', '2013-05-16') ; 
INSERT INTO `facturations` VALUES (251, 36, 16, 404, '2013-05-13', 0, '0.0', '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '4.0', '0000000000', 0, '2013-05-16', '2013-05-16') ; 
INSERT INTO `facturations` VALUES (252, 36, 1, 401, '2013-05-06', 0, '0.0', '0.0', '0.0', '0.0', '1.0', '0.0', '0.0', '1.0', '0000000000', 0, '2013-05-16', '2013-05-16') ; 
INSERT INTO `facturations` VALUES (253, 36, 22, 402, '2013-05-06', 0, '1.0', '1.0', '0.0', '0.0', '0.0', '0.0', '0.0', '2.0', '0000000000', 0, '2013-05-16', '2013-05-16') ; 
INSERT INTO `facturations` VALUES (254, 171, 23, 410, '2013-05-27', 0, '1.0', '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '5.0', '0000000000', 0, '2013-05-16', '2013-05-16') ; 
INSERT INTO `facturations` VALUES (255, 171, 23, 409, '2013-05-20', 0, '0.0', '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '4.0', '0000000000', 0, '2013-05-16', '2013-05-16') ; 
INSERT INTO `facturations` VALUES (256, 171, 23, 408, '2013-05-13', 0, '1.0', '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '5.0', '0000000000', 0, '2013-05-16', '2013-05-16') ; 
INSERT INTO `facturations` VALUES (257, 171, 1, 279, '2013-05-06', 0, '0.0', '0.0', '0.0', '0.0', '1.0', '0.0', '0.0', '1.0', '0000000000', 0, '2013-05-16', '2013-05-16') ; 
INSERT INTO `facturations` VALUES (258, 171, 28, 407, '2013-05-06', 0, '1.0', '1.0', '0.0', '0.0', '0.0', '0.0', '0.0', '2.0', '0000000000', 0, '2013-05-16', '2013-05-16') ; 
INSERT INTO `facturations` VALUES (259, 18, 21, 414, '2013-05-27', 0, '1.0', '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '5.0', '0000000000', 0, '2013-05-16', '2013-05-16') ; 
INSERT INTO `facturations` VALUES (260, 18, 21, 413, '2013-05-20', 0, '0.0', '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '4.0', '0000000000', 0, '2013-05-16', '2013-05-16') ; 
INSERT INTO `facturations` VALUES (261, 18, 21, 412, '2013-05-13', 0, '1.0', '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '5.0', '0000000000', 0, '2013-05-16', '2013-05-16') ; 
INSERT INTO `facturations` VALUES (262, 18, 21, 411, '2013-05-06', 0, '1.0', '1.0', '0.0', '0.0', '1.0', '0.0', '0.0', '3.0', '0000000000', 0, '2013-05-16', '2013-05-16') ; 
INSERT INTO `facturations` VALUES (263, 172, 1, 278, '2013-05-27', 0, '1.0', '0.0', '0.0', '0.0', '0.0', '0.0', '0.0', '1.0', '0000000000', 0, '2013-05-16', '2013-05-16') ; 
INSERT INTO `facturations` VALUES (264, 172, 24, 419, '2013-05-27', 0, '0.0', '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '4.0', '0000000000', 0, '2013-05-16', '2013-05-16') ; 
INSERT INTO `facturations` VALUES (265, 172, 1, 277, '2013-05-20', 0, '0.0', '0.0', '0.0', '0.0', '0.5', '0.0', '0.0', '0.5', '0000000000', 0, '2013-05-16', '2013-05-16') ; 
INSERT INTO `facturations` VALUES (266, 172, 24, 418, '2013-05-20', 0, '0.0', '1.0', '1.0', '1.0', '0.5', '0.0', '0.0', '3.5', '0000000000', 0, '2013-05-16', '2013-05-16') ; 
INSERT INTO `facturations` VALUES (267, 172, 27, 416, '2013-05-13', 0, '1.0', '1.0', '0.0', '0.0', '0.0', '0.0', '0.0', '2.0', '0000000000', 0, '2013-05-16', '2013-05-16') ; 
INSERT INTO `facturations` VALUES (268, 172, 24, 417, '2013-05-13', 0, '0.0', '0.0', '1.0', '1.0', '1.0', '0.0', '0.0', '3.0', '0000000000', 0, '2013-05-16', '2013-05-16') ; 
INSERT INTO `facturations` VALUES (269, 172, 1, 82, '2013-05-06', 0, '0.0', '0.0', '0.0', '0.0', '1.0', '0.0', '0.0', '1.0', '0000000000', 0, '2013-05-16', '2013-05-16') ; 
INSERT INTO `facturations` VALUES (270, 172, 27, 415, '2013-05-06', 0, '1.0', '1.0', '0.0', '0.0', '0.0', '0.0', '0.0', '2.0', '0000000000', 0, '2013-05-16', '2013-05-16') ; 
INSERT INTO `facturations` VALUES (271, 237, 14, 424, '2013-05-27', 0, '1.0', '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '5.0', '0000000000', 0, '2013-05-16', '2013-05-16') ; 
INSERT INTO `facturations` VALUES (272, 237, 14, 423, '2013-05-20', 0, '0.0', '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '4.0', '0000000000', 0, '2013-05-16', '2013-05-16') ; 
INSERT INTO `facturations` VALUES (273, 237, 23, 421, '2013-05-13', 0, '1.0', '1.0', '1.0', '0.0', '0.0', '0.0', '0.0', '3.0', '0000000000', 0, '2013-05-16', '2013-05-16') ; 
INSERT INTO `facturations` VALUES (274, 237, 14, 422, '2013-05-13', 0, '0.0', '0.0', '0.0', '1.0', '1.0', '0.0', '0.0', '2.0', '0000000000', 0, '2013-05-16', '2013-05-16') ; 
INSERT INTO `facturations` VALUES (275, 237, 23, 420, '2013-05-06', 0, '1.0', '1.0', '0.0', '0.0', '1.0', '0.0', '0.0', '3.0', '0000000000', 0, '2013-05-16', '2013-05-16') ; 
INSERT INTO `facturations` VALUES (276, 33, 21, 428, '2013-05-27', 0, '1.0', '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '5.0', '0000000000', 0, '2013-05-16', '2013-05-16') ; 
INSERT INTO `facturations` VALUES (277, 33, 21, 427, '2013-05-20', 0, '0.0', '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '4.0', '0000000000', 0, '2013-05-16', '2013-05-16') ; 
INSERT INTO `facturations` VALUES (278, 33, 21, 426, '2013-05-13', 0, '1.0', '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '5.0', '0000000000', 0, '2013-05-16', '2013-05-16') ; 
INSERT INTO `facturations` VALUES (279, 33, 1, 84, '2013-05-06', 0, '0.0', '0.0', '0.0', '0.0', '1.0', '0.0', '0.0', '1.0', '0000000000', 0, '2013-05-16', '2013-05-16') ; 
INSERT INTO `facturations` VALUES (280, 33, 21, 425, '2013-05-06', 0, '1.0', '1.0', '0.0', '0.0', '0.0', '0.0', '0.0', '2.0', '0000000000', 0, '2013-05-16', '2013-05-16') ; 
INSERT INTO `facturations` VALUES (281, 38, 22, 433, '2013-05-27', 0, '1.0', '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '5.0', '0000000000', 0, '2013-05-16', '2013-05-16') ; 
INSERT INTO `facturations` VALUES (282, 38, 22, 432, '2013-05-20', 0, '0.0', '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '4.0', '0000000000', 0, '2013-05-16', '2013-05-16') ; 
INSERT INTO `facturations` VALUES (283, 38, 1, 429, '2013-05-13', 0, '0.0', '0.0', '1.0', '0.0', '0.0', '0.0', '0.0', '1.0', '0000000000', 0, '2013-05-16', '2013-05-16') ; 
INSERT INTO `facturations` VALUES (284, 38, 22, 431, '2013-05-13', 0, '1.0', '1.0', '0.0', '1.0', '1.0', '0.0', '0.0', '4.0', '0000000000', 0, '2013-05-16', '2013-05-16') ; 
INSERT INTO `facturations` VALUES (285, 38, 1, 79, '2013-05-06', 0, '0.0', '0.0', '0.0', '0.0', '1.0', '0.0', '0.0', '1.0', '0000000000', 0, '2013-05-16', '2013-05-16') ; 
INSERT INTO `facturations` VALUES (286, 38, 22, 430, '2013-05-06', 0, '1.0', '1.0', '0.0', '0.0', '0.0', '0.0', '0.0', '2.0', '0000000000', 0, '2013-05-16', '2013-05-16') ; 
INSERT INTO `facturations` VALUES (287, 261, 16, 436, '2013-05-27', 0, '1.0', '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '5.0', '0000000000', 0, '2013-05-16', '2013-05-16') ; 
INSERT INTO `facturations` VALUES (288, 261, 16, 435, '2013-05-20', 0, '0.0', '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '4.0', '0000000000', 0, '2013-05-16', '2013-05-16') ; 
INSERT INTO `facturations` VALUES (289, 261, 16, 434, '2013-05-13', 0, '1.0', '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '5.0', '0000000000', 0, '2013-05-16', '2013-05-16') ; 
INSERT INTO `facturations` VALUES (290, 261, 1, 281, '2013-05-06', 0, '1.0', '1.0', '0.0', '0.0', '1.0', '0.0', '0.0', '3.0', '0000000000', 0, '2013-05-16', '2013-05-16') ; 
INSERT INTO `facturations` VALUES (291, 40, 1, 438, '2013-05-27', 0, '0.0', '0.0', '0.0', '0.0', '1.0', '0.0', '0.0', '1.0', '0000000000', 0, '2013-05-16', '2013-05-16') ; 
INSERT INTO `facturations` VALUES (292, 40, 16, 441, '2013-05-27', 0, '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '0.0', '4.0', '0000000000', 0, '2013-05-16', '2013-05-16') ; 
INSERT INTO `facturations` VALUES (293, 40, 1, 437, '2013-05-20', 0, '0.0', '0.0', '1.0', '1.0', '0.0', '0.0', '0.0', '2.0', '0000000000', 0, '2013-05-16', '2013-05-16') ; 
INSERT INTO `facturations` VALUES (294, 40, 21, 440, '2013-05-20', 0, '0.0', '1.0', '0.0', '0.0', '1.0', '0.0', '0.0', '2.0', '0000000000', 0, '2013-05-16', '2013-05-16') ; 
INSERT INTO `facturations` VALUES (295, 40, 21, 439, '2013-05-13', 0, '1.0', '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '5.0', '0000000000', 0, '2013-05-16', '2013-05-16') ; 
INSERT INTO `facturations` VALUES (296, 40, 1, 77, '2013-05-06', 0, '1.0', '1.0', '0.0', '0.0', '1.0', '0.0', '0.0', '3.0', '0000000000', 0, '2013-05-16', '2013-05-16') ; 
INSERT INTO `facturations` VALUES (297, 176, 27, 445, '2013-05-27', 0, '1.0', '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '5.0', '0000000000', 0, '2013-05-16', '2013-05-16') ; 
INSERT INTO `facturations` VALUES (298, 176, 1, 442, '2013-05-20', 0, '0.0', '0.0', '0.0', '1.0', '1.0', '0.0', '0.0', '2.0', '0000000000', 0, '2013-05-16', '2013-05-16') ; 
INSERT INTO `facturations` VALUES (299, 176, 24, 444, '2013-05-20', 0, '0.0', '1.0', '1.0', '0.0', '0.0', '0.0', '0.0', '2.0', '0000000000', 0, '2013-05-16', '2013-05-16') ; 
INSERT INTO `facturations` VALUES (300, 176, 24, 443, '2013-05-13', 0, '1.0', '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '5.0', '0000000000', 0, '2013-05-16', '2013-05-16') ; 
INSERT INTO `facturations` VALUES (301, 176, 1, 59, '2013-05-06', 0, '1.0', '1.0', '0.0', '0.0', '1.0', '0.0', '0.0', '3.0', '0000000000', 0, '2013-05-16', '2013-05-16') ; 
INSERT INTO `facturations` VALUES (302, 5, 1, 12, '2013-05-06', 1, '1.0', '1.0', '0.0', '0.0', '0.0', '0.0', '0.0', '2.0', '0000650094', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (304, 5, 3, 13, '2013-05-06', 1, '0.0', '0.0', '0.0', '0.0', '1.0', '0.0', '0.0', '1.0', '0000650094', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (314, 5, 3, 15, '2013-05-13', 1, '0.0', '0.0', '0.0', '0.0', '1.0', '0.0', '0.0', '1.0', '0000650114', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (316, 5, 21, 361, '2013-05-13', 1, '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '0.0', '4.0', '0000650114', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (318, 5, 3, 16, '2013-05-20', 1, '0.0', '0.0', '0.0', '0.0', '1.0', '0.0', '0.0', '1.0', '0000650157', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (320, 5, 21, 368, '2013-05-20', 1, '0.0', '1.0', '1.0', '1.0', '0.0', '0.0', '0.0', '3.0', '0000650157', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (322, 5, 3, 17, '2013-05-27', 1, '0.0', '0.0', '0.0', '0.0', '1.0', '0.0', '0.0', '1.0', '0000650165', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (323, 5, 21, 370, '2013-05-27', 1, '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '0.0', '4.0', '0000650165', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (324, 230, 1, 86, '2013-05-06', 1, '0.0', '0.0', '0.0', '0.0', '1.0', '0.0', '0.0', '1.0', '0000650328', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (325, 230, 22, 464, '2013-05-06', 1, '1.0', '1.0', '0.0', '0.0', '0.0', '0.0', '0.0', '2.0', '0000650328', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (326, 230, 22, 461, '2013-05-13', 1, '1.0', '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '5.0', '0000650339', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (327, 230, 24, 462, '2013-05-20', 1, '0.0', '0.0', '1.0', '1.0', '1.0', '0.0', '0.0', '3.0', '0000650356', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (328, 230, 1, 463, '2013-05-20', 1, '0.0', '1.0', '0.0', '0.0', '0.0', '0.0', '0.0', '1.0', '0000650356', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (329, 230, 24, 465, '2013-05-27', 1, '1.0', '1.0', '0.0', '0.0', '0.0', '0.0', '0.0', '2.0', '0000650363', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (330, 230, 22, 466, '2013-05-27', 1, '0.0', '0.0', '1.0', '1.0', '1.0', '0.0', '0.0', '3.0', '0000650363', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (331, 6, 3, 64, '2013-05-06', 1, '1.0', '1.0', '0.0', '0.0', '1.0', '0.0', '0.0', '3.0', '0000650367', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (332, 6, 22, 475, '2013-05-13', 1, '1.0', '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '5.0', '0000650370', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (333, 6, 22, 477, '2013-05-20', 1, '0.0', '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '4.0', '0000650379', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (334, 6, 21, 478, '2013-05-20', 1, '0.0', '0.0', '0.0', '0.0', '0.0', '0.0', '0.0', '0.0', '0000650379', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (335, 6, 21, 476, '2013-05-13', 1, '0.0', '0.0', '0.0', '0.0', '0.0', '0.0', '0.0', '0.0', '0000650370', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (336, 6, 22, 479, '2013-05-27', 1, '1.0', '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '5.0', '0000650383', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (337, 6, 21, 480, '2013-05-27', 1, '0.0', '0.0', '0.0', '0.0', '0.0', '0.0', '0.0', '0.0', '0000650383', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (338, 12, 5, 376, '2013-05-06', 1, '1.0', '1.0', '0.0', '0.0', '1.0', '0.0', '0.0', '3.0', '0000650407', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (339, 12, 5, 377, '2013-05-13', 1, '1.0', '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '5.0', '0000650415', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (340, 12, 24, 378, '2013-05-20', 1, '0.0', '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '4.0', '0000650500', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (341, 12, 24, 379, '2013-05-27', 1, '1.0', '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '5.0', '0000650507', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (342, 8, 12, 372, '2013-05-06', 1, '1.0', '1.0', '0.0', '0.0', '1.0', '0.0', '0.0', '3.0', '0000650521', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (343, 8, 12, 373, '2013-05-13', 1, '1.0', '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '5.0', '0000650525', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (344, 8, 12, 374, '2013-05-20', 1, '0.0', '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '4.0', '0000650542', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (345, 8, 12, 375, '2013-05-27', 1, '1.0', '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '5.0', '0000650546', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (346, 265, 24, NULL, '2013-05-20', 1, '0.0', '0.0', '1.0', '1.0', '1.0', '0.0', '0.0', '3.0', '0000000000', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (347, 265, 1, NULL, '2013-05-20', 1, '0.0', '1.0', '0.0', '0.0', '0.0', '0.0', '0.0', '1.0', '0000000000', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (348, 7, 3, 73, '2013-05-06', 1, '0.0', '0.0', '0.0', '0.0', '1.0', '0.0', '0.0', '1.0', '0000650673', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (349, 0, 0, NULL, '0000-00-00', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (350, 7, 33, 446, '2013-05-06', 1, '1.0', '1.0', '0.0', '0.0', '0.0', '0.0', '0.0', '2.0', '0000650673', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (351, 0, 0, NULL, '0000-00-00', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (352, 7, 3, 74, '2013-05-13', 1, '0.0', '0.0', '1.0', '0.0', '0.0', '0.0', '0.0', '1.0', '0000650692', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (353, 0, 0, NULL, '0000-00-00', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (354, 7, 31, 447, '2013-05-13', 1, '1.0', '0.0', '0.0', '0.0', '1.0', '0.0', '0.0', '2.0', '0000650692', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (355, 0, 0, NULL, '0000-00-00', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (356, 7, 28, 448, '2013-05-13', 1, '0.0', '1.0', '0.0', '0.0', '0.0', '0.0', '0.0', '1.0', '0000650692', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (357, 0, 0, NULL, '0000-00-00', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (358, 7, 28, 449, '2013-05-13', 1, '0.0', '0.0', '0.0', '1.0', '0.0', '0.0', '0.0', '1.0', '0000650692', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (359, 0, 0, NULL, '0000-00-00', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (360, 7, 3, 75, '2013-05-20', 1, '0.0', '0.0', '0.0', '0.0', '1.0', '0.0', '0.0', '1.0', '0000650700', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (361, 0, 0, NULL, '0000-00-00', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (362, 7, 37, 276, '2013-05-20', 1, '0.0', '1.0', '1.0', '1.0', '0.0', '0.0', '0.0', '3.0', '0000650700', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (363, 0, 0, NULL, '0000-00-00', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (364, 7, 3, 76, '2013-05-27', 1, '0.0', '0.0', '1.0', '0.0', '0.0', '0.0', '0.0', '1.0', '0000650712', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (365, 0, 0, NULL, '0000-00-00', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (366, 7, 28, 450, '2013-05-27', 1, '1.0', '0.0', '0.0', '0.0', '0.0', '0.0', '0.0', '1.0', '0000650712', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (367, 0, 0, NULL, '0000-00-00', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (368, 7, 29, 451, '2013-05-27', 1, '0.0', '1.0', '0.0', '1.0', '0.0', '0.0', '0.0', '2.0', '0000650712', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (369, 0, 0, NULL, '0000-00-00', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (370, 7, 30, 452, '2013-05-27', 1, '0.0', '0.0', '0.0', '0.0', '1.0', '0.0', '0.0', '1.0', '0000650712', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (371, 0, 0, NULL, '0000-00-00', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (372, 13, 3, 68, '2013-05-06', 1, '0.0', '0.0', '0.0', '0.0', '1.0', '0.0', '0.0', '1.0', '0000650784', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (373, 0, 0, NULL, '0000-00-00', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (374, 13, 38, 469, '2013-05-06', 1, '1.0', '0.0', '0.0', '0.0', '0.0', '0.0', '0.0', '1.0', '0000650784', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (375, 0, 0, NULL, '0000-00-00', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (376, 13, 34, 470, '2013-05-06', 1, '0.0', '1.0', '0.0', '0.0', '0.0', '0.0', '0.0', '1.0', '0000650784', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (377, 0, 0, NULL, '0000-00-00', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (378, 13, 34, 69, '2013-05-13', 1, '1.0', '0.0', '1.0', '0.0', '0.0', '0.0', '0.0', '2.0', '0000650789', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (379, 0, 0, NULL, '0000-00-00', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (380, 13, 13, 473, '2013-05-13', 1, '0.0', '1.0', '0.0', '1.0', '1.0', '0.0', '0.0', '3.0', '0000650789', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (381, 0, 0, NULL, '0000-00-00', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (382, 13, 38, 474, '2013-05-13', 1, '0.0', '0.0', '0.0', '0.0', '0.0', '0.0', '0.0', '0.0', '0000650789', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (383, 0, 0, NULL, '0000-00-00', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (384, 13, 3, 70, '2013-05-20', 1, '0.0', '0.0', '1.0', '0.0', '0.0', '0.0', '0.0', '1.0', '0000650791', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (385, 0, 0, NULL, '0000-00-00', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (386, 13, 13, 471, '2013-05-20', 1, '0.0', '0.0', '0.0', '1.0', '1.0', '0.0', '0.0', '2.0', '0000650791', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (387, 0, 0, NULL, '0000-00-00', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (388, 13, 34, 472, '2013-05-20', 1, '0.0', '1.0', '0.0', '0.0', '0.0', '0.0', '0.0', '1.0', '0000650791', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (389, 0, 0, NULL, '0000-00-00', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (390, 13, 3, 71, '2013-05-27', 1, '0.0', '0.0', '1.0', '0.0', '0.0', '0.0', '0.0', '1.0', '0000650793', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (391, 0, 0, NULL, '0000-00-00', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (392, 13, 34, 467, '2013-05-27', 1, '1.0', '0.0', '0.0', '0.0', '0.5', '0.0', '0.0', '1.5', '0000650793', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (393, 0, 0, NULL, '0000-00-00', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (394, 13, 13, 468, '2013-05-27', 1, '0.0', '1.0', '0.0', '1.0', '0.5', '0.0', '0.0', '2.5', '0000650793', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (395, 0, 0, NULL, '0000-00-00', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (396, 34, 23, 500, '2013-05-06', 1, '1.0', '1.0', '0.0', '0.0', '0.0', '0.0', '0.0', '2.0', '0000650846', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (397, 0, 0, NULL, '0000-00-00', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (398, 34, 13, 501, '2013-05-06', 1, '0.0', '0.0', '0.0', '0.0', '1.0', '0.0', '0.0', '1.0', '0000650846', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (399, 0, 0, NULL, '0000-00-00', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (400, 34, 6, 266, '2013-04-29', 1, '1.0', '1.0', '0.0', '1.0', '0.0', '0.0', '0.0', '3.0', '0000625425', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (401, 34, 1, 267, '2013-04-29', 1, '0.0', '0.0', '0.0', '0.0', '1.0', '0.0', '0.0', '1.0', '0000625425', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (402, 34, 1, 497, '2013-05-13', 1, '0.0', '0.0', '0.0', '1.0', '1.0', '0.0', '0.0', '2.0', '0000650852', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (403, 0, 0, NULL, '0000-00-00', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (404, 34, 13, 502, '2013-05-13', 1, '1.0', '1.0', '1.0', '0.0', '0.0', '0.0', '0.0', '3.0', '0000650852', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (405, 0, 0, NULL, '0000-00-00', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (406, 34, 1, 498, '2013-05-20', 1, '0.0', '0.0', '0.0', '1.0', '0.0', '0.0', '0.0', '1.0', '0000650853', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (407, 0, 0, NULL, '0000-00-00', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (408, 34, 13, 503, '2013-05-20', 1, '0.0', '1.0', '1.0', '0.0', '0.0', '0.0', '0.0', '2.0', '0000650853', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (409, 0, 0, NULL, '0000-00-00', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (410, 34, 14, 504, '2013-05-20', 1, '0.0', '0.0', '0.0', '0.0', '1.0', '0.0', '0.0', '1.0', '0000650853', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (411, 0, 0, NULL, '0000-00-00', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (412, 34, 1, 499, '2013-05-27', 1, '0.0', '0.0', '0.0', '0.0', '1.0', '0.0', '0.0', '1.0', '0000650869', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (413, 0, 0, NULL, '0000-00-00', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (414, 34, 14, 505, '2013-05-27', 1, '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '0.0', '4.0', '0000650869', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (415, 0, 0, NULL, '0000-00-00', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (416, 10, 16, 506, '2013-05-06', 1, '1.0', '1.0', '0.0', '0.0', '1.0', '0.0', '0.0', '3.0', '0000650885', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (417, 0, 0, NULL, '0000-00-00', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (418, 10, 16, 507, '2013-05-13', 1, '1.0', '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '5.0', '0000650887', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (419, 0, 0, NULL, '0000-00-00', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (420, 10, 16, 508, '2013-05-20', 1, '0.0', '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '4.0', '0000650889', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (421, 0, 0, NULL, '0000-00-00', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (422, 10, 16, 509, '2013-05-27', 1, '1.0', '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '5.0', '0000650891', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (423, 0, 0, NULL, '0000-00-00', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (424, 255, 24, 218, '2013-04-29', 1, '1.0', '1.0', '0.0', '1.0', '1.0', '0.0', '0.0', '4.0', '0000625303', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (425, 255, 2, 67, '2013-05-06', 1, '0.0', '0.0', '0.0', '0.0', '1.0', '0.0', '0.0', '1.0', '0000650893', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (426, 0, 0, NULL, '0000-00-00', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (427, 255, 24, 510, '2013-05-06', 1, '1.0', '1.0', '0.0', '0.0', '0.0', '0.0', '0.0', '2.0', '0000650893', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (428, 0, 0, NULL, '0000-00-00', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (429, 255, 24, 511, '2013-05-13', 1, '1.0', '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '5.0', '0000650894', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (430, 0, 0, NULL, '0000-00-00', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (431, 255, 24, 512, '2013-05-20', 1, '0.0', '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '4.0', '0000650900', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (432, 0, 0, NULL, '0000-00-00', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (433, 255, 24, 513, '2013-05-27', 1, '1.0', '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '5.0', '0000650907', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (434, 0, 0, NULL, '0000-00-00', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (435, 11, 1, 34, '2013-04-29', 1, '0.0', '0.0', '0.0', '1.0', '1.0', '0.0', '0.0', '2.0', '0000625294', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (436, 11, 23, 213, '2013-04-29', 1, '1.0', '1.0', '0.0', '0.0', '0.0', '0.0', '0.0', '2.0', '0000625294', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (437, 11, 1, 514, '2013-05-06', 1, '1.0', '1.0', '0.0', '0.0', '1.0', '0.0', '0.0', '3.0', '0000650924', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (438, 0, 0, NULL, '0000-00-00', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (439, 11, 14, 515, '2013-05-13', 1, '1.0', '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '5.0', '0000650927', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (440, 0, 0, NULL, '0000-00-00', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (441, 11, 14, 516, '2013-05-20', 1, '0.0', '1.0', '1.0', '0.0', '0.0', '0.0', '0.0', '2.0', '0000650928', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (442, 0, 0, NULL, '0000-00-00', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (443, 11, 23, 517, '2013-05-20', 1, '0.0', '0.0', '0.0', '1.0', '1.0', '0.0', '0.0', '2.0', '0000650928', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (444, 0, 0, NULL, '0000-00-00', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (445, 11, 23, 518, '2013-05-27', 1, '1.0', '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '5.0', '0000650931', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (446, 0, 0, NULL, '0000-00-00', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (447, 231, 22, 230, '2013-04-29', 1, '1.0', '1.0', '0.0', '1.0', '1.0', '0.0', '0.0', '4.0', '0000625281', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (448, 231, 1, 262, '2013-05-06', 1, '1.0', '1.0', '0.0', '0.0', '1.0', '0.0', '0.0', '3.0', '0000625284', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (449, 231, 16, 519, '2013-05-13', 1, '1.0', '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '5.0', '0000650941', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (450, 0, 0, NULL, '0000-00-00', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (451, 231, 16, 520, '2013-05-20', 1, '0.0', '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '4.0', '0000650942', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (452, 0, 0, NULL, '0000-00-00', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (453, 231, 16, 521, '2013-05-27', 1, '1.0', '0.0', '0.0', '0.0', '0.0', '0.0', '0.0', '1.0', '0000650946', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (454, 0, 0, NULL, '0000-00-00', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (455, 231, 22, 522, '2013-05-27', 1, '0.0', '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '4.0', '0000650946', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (456, 0, 0, NULL, '0000-00-00', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (457, 16, 22, 234, '2013-04-29', 1, '1.0', '1.0', '0.0', '1.0', '1.0', '0.0', '0.0', '4.0', '0000625266', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (458, 16, 22, 524, '2013-05-06', 1, '1.0', '1.0', '0.0', '0.0', '1.0', '0.0', '0.0', '3.0', '0000650950', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (459, 0, 0, NULL, '0000-00-00', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (460, 16, 22, 525, '2013-05-13', 1, '1.0', '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '5.0', '0000650955', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (461, 0, 0, NULL, '0000-00-00', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (462, 16, 22, 526, '2013-05-20', 1, '0.0', '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '4.0', '0000650957', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (463, 0, 0, NULL, '0000-00-00', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (464, 16, 22, 527, '2013-05-27', 1, '0.0', '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '4.0', '0000650960', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (465, 0, 0, NULL, '0000-00-00', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (466, 16, 1, 529, '2013-05-27', 1, '1.0', '0.0', '0.0', '0.0', '0.0', '0.0', '0.0', '1.0', '0000650960', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (467, 0, 0, NULL, '0000-00-00', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (468, 14, 3, 220, '2013-04-29', 1, '1.0', '1.0', '0.0', '1.0', '1.0', '0.0', '0.0', '4.0', '0000625260', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (469, 14, 13, 365, '2013-05-06', 1, '0.0', '0.0', '0.0', '0.0', '0.0', '0.0', '0.0', '0.0', '0000650968', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (470, 0, 0, NULL, '0000-00-00', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (471, 14, 14, 366, '2013-05-06', 1, '1.0', '0.5', '0.0', '0.0', '1.0', '0.0', '0.0', '2.5', '0000650968', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (472, 0, 0, NULL, '0000-00-00', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (473, 14, 28, 367, '2013-05-06', 1, '0.0', '0.5', '0.0', '0.0', '0.0', '0.0', '0.0', '0.5', '0000650968', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (474, 0, 0, NULL, '0000-00-00', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (475, 14, 14, 362, '2013-05-13', 1, '0.5', '0.0', '0.0', '1.0', '1.0', '0.0', '0.0', '2.5', '0000650973', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (476, 0, 0, NULL, '0000-00-00', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (477, 14, 28, 363, '2013-05-13', 1, '0.5', '1.0', '0.5', '0.0', '0.0', '0.0', '0.0', '2.0', '0000650973', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (478, 0, 0, NULL, '0000-00-00', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (479, 14, 23, 369, '2013-05-13', 1, '0.0', '0.0', '0.5', '0.0', '0.0', '0.0', '0.0', '0.5', '0000650973', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (480, 0, 0, NULL, '0000-00-00', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (481, 14, 13, 371, '2013-05-13', 1, '0.0', '0.0', '0.0', '0.0', '0.0', '0.0', '0.0', '0.0', '0000650973', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (482, 0, 0, NULL, '0000-00-00', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (483, 14, 14, 489, '2013-05-20', 1, '0.0', '1.0', '1.0', '0.5', '1.0', '0.0', '0.0', '3.5', '0000650975', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (484, 0, 0, NULL, '0000-00-00', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (485, 14, 13, 530, '2013-05-20', 1, '0.0', '0.0', '0.0', '0.0', '0.0', '0.0', '0.0', '0.0', '0000650975', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (486, 0, 0, NULL, '0000-00-00', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (487, 14, 28, 531, '2013-05-20', 1, '0.0', '0.0', '0.0', '0.5', '0.0', '0.0', '0.0', '0.5', '0000650975', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (488, 0, 0, NULL, '0000-00-00', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (489, 14, 14, 532, '2013-05-27', 1, '1.0', '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '5.0', '0000650978', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (490, 0, 0, NULL, '0000-00-00', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (491, 22, 1, 43, '2013-04-29', 1, '1.0', '1.0', '0.0', '1.0', '1.0', '0.0', '0.0', '4.0', '0000625800', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (492, 0, 0, NULL, '0000-00-00', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (493, 22, 2, 274, '2013-05-06', 1, '0.0', '0.0', '0.0', '0.0', '1.0', '0.0', '0.0', '1.0', '0000650984', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (494, 0, 0, NULL, '0000-00-00', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (495, 22, 21, 540, '2013-05-06', 1, '1.0', '1.0', '0.0', '0.0', '0.0', '0.0', '0.0', '2.0', '0000650984', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (496, 0, 0, NULL, '0000-00-00', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (497, 22, 21, 533, '2013-05-13', 1, '0.0', '0.0', '0.0', '0.0', '0.0', '0.0', '0.0', '0.0', '0000650986', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (498, 0, 0, NULL, '0000-00-00', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (499, 22, 35, 534, '2013-05-13', 1, '1.0', '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '5.0', '0000650986', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (500, 0, 0, NULL, '0000-00-00', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (501, 22, 26, 535, '2013-05-13', 1, '0.0', '0.0', '0.0', '0.0', '0.0', '0.0', '0.0', '0.0', '0000650986', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (502, 0, 0, NULL, '0000-00-00', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (503, 22, 35, 536, '2013-05-20', 1, '0.0', '1.0', '1.0', '1.0', '0.0', '0.0', '0.0', '3.0', '0000650991', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (504, 0, 0, NULL, '0000-00-00', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (505, 22, 21, 537, '2013-05-20', 1, '0.0', '0.0', '0.0', '0.0', '1.0', '0.0', '0.0', '1.0', '0000650991', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (506, 0, 0, NULL, '0000-00-00', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (507, 22, 21, 538, '2013-05-27', 1, '1.0', '0.0', '0.0', '0.0', '0.0', '0.0', '0.0', '1.0', '0000650995', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (508, 0, 0, NULL, '0000-00-00', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (509, 22, 16, 539, '2013-05-27', 1, '0.0', '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '4.0', '0000650995', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (510, 0, 0, NULL, '0000-00-00', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (511, 3, 2, 66, '2013-05-06', 0, '1.0', '1.0', '0.0', '0.0', '0.0', '0.0', '0.0', '2.0', '0000000000', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (512, 3, 1, 65, '2013-04-29', 0, '0.0', '0.0', '0.0', '1.0', '1.0', '0.0', '0.0', '2.0', '0000000000', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (513, 4, 16, 383, '2013-05-27', 0, '1.0', '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '5.0', '0000000000', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (514, 4, 16, 382, '2013-05-20', 0, '0.0', '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '4.0', '0000000000', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (515, 4, 17, 381, '2013-05-13', 0, '1.0', '1.0', '1.0', '1.0', '1.0', '0.0', '0.0', '5.0', '0000000000', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (516, 4, 1, 273, '2013-05-06', 0, '0.0', '0.0', '0.0', '0.0', '1.0', '0.0', '0.0', '1.0', '0000000000', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (517, 4, 17, 380, '2013-05-06', 0, '1.0', '1.0', '0.0', '0.0', '0.0', '0.0', '0.0', '2.0', '0000000000', 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `facturations` VALUES (518, 261, 1, 280, '2013-04-29', 0, '0.0', '0.0', '0.0', '1.0', '1.0', '0.0', '0.0', '2.0', '0000000000', 0, '2013-05-21', '2013-05-21') ;
#
# End of data contents of table facturations
# --------------------------------------------------------

# WordPress : buffernow.com MySQL database backup
#
# Generated: Thursday 23. May 2013 19:38 CEST
# Hostname: localhost
# Database: `saill_200`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `achats`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `actions`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `actionslivrables`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `activites`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `activitesreelles`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `affectations`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `assistances`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `autorisations`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `contrats`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `detailplancharges`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `domaines`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `dossierpartages`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `dotations`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `facturations`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `historyactions`
# --------------------------------------------------------


#
# Delete any existing table `historyactions`
#

DROP TABLE IF EXISTS `historyactions`;


#
# Table structure of table `historyactions`
#

CREATE TABLE `historyactions` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `action_id` int(15) NOT NULL,
  `AVANCEMENT` int(11) DEFAULT NULL,
  `DEBUT` date NOT NULL,
  `ECHEANCE` date NOT NULL,
  `CHARGEPREVUE` int(11) NOT NULL,
  `PRIORITE` enum('normale','moyenne','haute') CHARACTER SET latin1 NOT NULL,
  `STATUT` enum('à faire','en cours','terminée','livré','annulée') NOT NULL,
  `COMMENTAIRE` text CHARACTER SET latin1,
  `created` date NOT NULL,
  `modified` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=327 DEFAULT CHARSET=utf8 ;

#
# Data contents of table historyactions (305 records)
#
 
INSERT INTO `historyactions` VALUES (1, 1, 70, '2013-01-07', '2013-03-28', 96, 'normale', 'en cours', 'Le 27/03/2013 par LEVAVASSEUR Jacques<br>Janvier :<br />
<ul>
<li>Incorporation de l\'activité</li>
</ul>
<p>Février :</p>
<ul>
<li>Incorporation de l\'activité</li>
<li>Consolidation consommé et insertion</li>
<li>Envois pour validation</li>
</ul>
<p>Mars :</p>
<ul>
<li>Incorporation du budget contratcualisé</li>
<li>Consolidation du consommé</li>
</ul>', '2013-03-27', '2013-03-27') ; 
INSERT INTO `historyactions` VALUES (2, 2, 100, '2013-03-25', '2013-03-28', 8, 'normale', 'terminée', 'Le 27/03/2013 par LEVAVASSEUR Jacques<br>Envois des indicateurs département au format demandé.<br />Entretien avec Irène BONNASSIEUX, pour expliquer le focntionnement d\'OSMOSE et de la remonté d\'indicateur, vu avec elle pour lui transmettre tous les mois un tableau d\'indicateur du consommé avec un petit argumentaire.<br />27/03/2013 envois du tableau d\'indicateurs du consommé pour OSMOSE', '2013-03-27', '2013-03-27') ; 
INSERT INTO `historyactions` VALUES (3, 3, 80, '2013-03-01', '2013-03-29', 64, 'normale', 'en cours', 'Le 27/03/2013 par LEVAVASSEUR Jacques<br>Activité récurrente<br />DSI-T/SO <br />
<ul>
<li>arrivé de Sébastien PAGNARD, Stéphane BEYDON</li>
<li>Préparation de l\'arrivée de Amsata NGOM</li>
</ul>
Groupement<br />
<ul>
<li>Création de compte</li>
<li>incident de connexion ...</li>
</ul>', '2013-03-27', '2013-03-27') ; 
INSERT INTO `historyactions` VALUES (4, 4, 90, '2013-02-04', '2013-04-11', 272, 'normale', 'en cours', 'Le 27/03/2013 par LEVAVASSEUR Jacques<br>Conception 12 jours<br />Réalisation 22 jours', '2013-03-27', '2013-03-27') ; 
INSERT INTO `historyactions` VALUES (5, 5, 100, '2013-03-27', '2013-03-27', 2, 'normale', 'terminée', 'Le 27/03/2013 par LEVAVASSEUR Jacques<br>Retour à Irène BONNASSIEUX des comptes à supprimer pour le compte d\'OMSOSE suite à non utilisation.', '2013-03-27', '2013-03-27') ; 
INSERT INTO `historyactions` VALUES (6, 6, 100, '2013-03-28', '2013-03-28', 2, 'normale', 'terminée', 'Le 28/03/2013 par LEVAVASSEUR Jacques<br>Compte déjà existant demande pour rien', '2013-03-28', '2013-03-28') ; 
INSERT INTO `historyactions` VALUES (7, 4, 90, '2013-02-04', '2013-04-11', 272, 'normale', 'en cours', 'Le 28/03/2013 par LEVAVASSEUR Jacques<br>Conception 12 jours<br />Réalisation 22 jours<br /><br />Bascule sur le serveur de production le 28/03/2013', '2013-03-28', '2013-03-28') ; 
INSERT INTO `historyactions` VALUES (8, 3, 100, '2013-03-01', '2013-03-29', 64, 'normale', 'terminée', 'Le 02/04/2013 par LEVAVASSEUR Jacques<br>Activité récurrente<br />DSI-T/SO <br />
<ul>
<li>arrivé de Sébastien PAGNARD, Stéphane BEYDON</li>
<li>Préparation de l\'arrivée de Amsata NGOM</li>
</ul>
Groupement<br />
<ul>
<li>Création de compte</li>
<li>incident de connexion ...</li>
</ul>', '2013-04-02', '2013-04-02') ; 
INSERT INTO `historyactions` VALUES (9, 7, 10, '2013-04-02', '2013-04-25', 64, 'normale', 'en cours', 'Le 02/04/2013 par LEVAVASSEUR Jacques<br>Le 02/04/2013 :<br /><ol>
<li>Arrivée à Lyon de Renaud BORG</li>
<li>Préparation poste de dépannage P64L03BIXXX pour Renaud BORG</li>
<li>Traitemement des demandes de fin de semaine précédente</li>
<li>Demande d\'ouverture de droits pour Renaud BORG et BELHOUT Mabrouk</li>
<li></li>
</ol>', '2013-04-02', '2013-04-02') ; 
INSERT INTO `historyactions` VALUES (10, 7, 10, '2013-04-02', '2013-04-25', 64, 'normale', 'en cours', 'Le 02/04/2013 par LEVAVASSEUR Jacques<br>Le 02/04/2013 :<br /><ol>
<li>Arrivée à Lyon de Renaud BORG</li>
<li>Préparation poste de dépannage P64L03BIXXX pour Renaud BORG</li>
<li>Traitemement des demandes de fin de semaine précédente</li>
<li>Demande d\'ouverture de droits pour Renaud BORG et BELHOUT Mabrouk</li>
<li>Deux nouveaux arrivant sur VILLEURBANNE pour ORCHESTRAL.</li>
</ol>', '2013-04-02', '2013-04-02') ; 
INSERT INTO `historyactions` VALUES (11, 7, 10, '2013-04-02', '2013-04-25', 64, 'normale', 'en cours', 'Le 02/04/2013 par LEVAVASSEUR Jacques<br>Le 02/04/2013 :<br /><ol>
<li>Arrivée à Lyon de Renaud BORG</li>
<li>Préparation poste de dépannage P64L03BIXXX pour Renaud BORG</li>
<li>Traitemement des demandes de fin de semaine précédente</li>
<li>Demande d\'ouverture de droits pour Renaud BORG et BELHOUT Mabrouk</li>
<li>Deux nouveaux arrivant sur VILLEURBANNE pour ORCHESTRAL.</li>
<li>demande de créations de compte pour deux nouveaux arrivants à SOGETI</li>
</ol>', '2013-04-02', '2013-04-02') ; 
INSERT INTO `historyactions` VALUES (12, 1, 70, '2013-01-07', '2013-03-28', 96, 'normale', 'en cours', 'Le 02/04/2013 par LEVAVASSEUR Jacques<br>Janvier :<br />
<ul>
<li>Incorporation de l\'activité</li>
</ul>
<p>Février :</p>
<ul>
<li>Incorporation de l\'activité</li>
<li>Consolidation consommé et insertion</li>
<li>Envois pour validation</li>
</ul>
<p>Mars :</p>
<ul>
<li>Incorporation du budget contratcualisé</li>
<li>Consolidation du consommé (02/04/2013 pas de retour pour charge de LMN et E7)</li>
<li>Incorporation de l\'activité réalisée en mars dans le CRA</li>
</ul>', '2013-04-02', '2013-04-02') ; 
INSERT INTO `historyactions` VALUES (13, 1, 90, '2013-01-07', '2013-03-28', 96, 'normale', 'en cours', 'Le 02/04/2013 par LEVAVASSEUR Jacques<br>Janvier :<br />
<ul>
<li>Incorporation de l\'activité</li>
</ul>
<p>Février :</p>
<ul>
<li>Incorporation de l\'activité</li>
<li>Consolidation consommé et insertion</li>
<li>Envois pour validation</li>
</ul>
<p>Mars :</p>
<ul>
<li>Incorporation du budget contratcualisé</li>
<li>Consolidation du consommé (02/04/2013 pas de retour pour charge de LMN et E7)</li>
<li>Incorporation de l\'activité réalisée en mars dans le CRA</li>
</ul>', '2013-04-02', '2013-04-02') ; 
INSERT INTO `historyactions` VALUES (14, 7, 20, '2013-04-02', '2013-04-25', 64, 'normale', 'en cours', 'Le 03/04/2013 par LEVAVASSEUR Jacques<br>Le 02/04/2013 :<br /><ol>
<li>Arrivée à Lyon de Renaud BORG</li>
<li>Préparation poste de dépannage P64L03BIXXX pour Renaud BORG</li>
<li>Traitemement des demandes de fin de semaine précédente</li>
<li>Demande d\'ouverture de droits pour Renaud BORG et BELHOUT Mabrouk</li>
<li>Deux nouveaux arrivant sur VILLEURBANNE pour ORCHESTRAL.</li>
<li>demande de créations de compte pour deux nouveaux arrivants à SOGETI</li>
</ol>
<p>Le 03/04/2013 : </p>
<ol>
<li>Demande d\'ajout dans des groupes existant pour LUC et RUIZ</li>
<li>Demande ouverture de droits pour LUC et RUIZ</li>
</ol>', '2013-04-03', '2013-04-03') ; 
INSERT INTO `historyactions` VALUES (15, 8, 70, '2013-04-03', '2013-04-04', 8, 'normale', 'en cours', 'Le 03/04/2013 par LEVAVASSEUR Jacques<br>Consolidation des charges consommées sur le lot 303 en 2012 et janvier 2013.<br />Remplir le fichier Excel envoyé par Jean-Pierre NEFF et le renvoyer à AAE, JBJ et JPN avec les explications', '2013-04-03', '2013-04-03') ; 
INSERT INTO `historyactions` VALUES (16, 1, 90, '2013-01-07', '2013-03-28', 96, 'normale', 'en cours', 'Le 03/04/2013 par LEVAVASSEUR Jacques<br>Janvier :<br />
<ul>
<li>Incorporation de l\'activité</li>
</ul>
<p>Février :</p>
<ul>
<li>Incorporation de l\'activité</li>
<li>Consolidation consommé et insertion</li>
<li>Envois pour validation</li>
</ul>
<p>Mars :</p>
<ul>
<li>Incorporation du budget contratcualisé</li>
<li>Consolidation du consommé (02/04/2013 pas de retour pour charge de LMN et E7)</li>
<li>Incorporation de l\'activité réalisée en mars dans le CRA</li>
<li>Envoyé pour validation à AAE et JBJ</li>
</ul>', '2013-04-03', '2013-04-03') ; 
INSERT INTO `historyactions` VALUES (17, 9, 0, '2013-04-24', '2013-04-24', 2, 'normale', 'à faire', 'Le 03/04/2013 par LEVAVASSEUR Jacques<br>Présentation de l\'outil à AAE et JBJ pour validation avant mise en service à un périmétre réduit de l\'équipe.<br />Périmétre à définir lors de cette présentation.<br />Je pense à : <br />
<ul>
<li>Sabine GEOFFROY</li>
<li>Magali BURIAND</li>
<li>Benoit TRENTO</li>
<li>Jacques LEVAVASSEUR</li>
<li>Patricia RIFFIOD</li>
</ul>
<br />Ne faut-il pas qu\'ils assistent à la présentation ?', '2013-04-03', '2013-04-03') ; 
INSERT INTO `historyactions` VALUES (18, 7, 20, '2013-04-02', '2013-04-25', 64, 'normale', 'en cours', 'Le 03/04/2013 par LEVAVASSEUR Jacques<br>Le 02/04/2013 :<br /><ol>
<li>Arrivée à Lyon de Renaud BORG</li>
<li>Préparation poste de dépannage P64L03BIXXX pour Renaud BORG</li>
<li>Traitemement des demandes de fin de semaine précédente</li>
<li>Demande d\'ouverture de droits pour Renaud BORG et BELHOUT Mabrouk</li>
<li>Deux nouveaux arrivant sur VILLEURBANNE pour ORCHESTRAL.</li>
<li>demande de créations de compte pour deux nouveaux arrivants à SOGETI</li>
<li>Demande de création de dossier personnel pour BORG Renaud</li>
</ol>
<p>Le 03/04/2013 :</p>
<ol>
<li>Demande d\'ajout dans des groupes existant pour LUC et RUIZ</li>
<li>Demande ouverture de droits pour LUC et RUIZ</li>
</ol><br />Le 04/04/2013 :', '2013-04-03', '2013-04-03') ; 
INSERT INTO `historyactions` VALUES (19, 7, 20, '2013-04-02', '2013-04-25', 64, 'normale', 'en cours', 'Le 04/04/2013 par LEVAVASSEUR Jacques<br>Le 02/04/2013 :<br /><ol>
<li>Arrivée à Lyon de Renaud BORG</li>
<li>Préparation poste de dépannage P64L03BIXXX pour Renaud BORG</li>
<li>Traitemement des demandes de fin de semaine précédente</li>
<li>Demande d\'ouverture de droits pour Renaud BORG et BELHOUT Mabrouk</li>
<li>Deux nouveaux arrivant sur VILLEURBANNE pour ORCHESTRAL.</li>
<li>demande de créations de compte pour deux nouveaux arrivants à SOGETI</li>
<li>Demande de création de dossier personnel pour BORG Renaud</li>
</ol>
<p>Le 03/04/2013 :</p>
<ol>
<li>Demande d\'ajout dans des groupes existant pour LUC et RUIZ</li>
<li>Demande ouverture de droits pour LUC et RUIZ</li>
</ol><br />Le 04/04/2013 :<br /><ol>
<li>Mise à jour de listes de diffusion pour le groupement</li>
<li>Suivi des ouverture de droits</li>
<li>Demande accès SAMETIME pour S BEYDON</li>
<li>Relance D LECLERC sur mise à jour de la commande de matériel à confirmer en COCOR</li>
</ol>', '2013-04-04', '2013-04-04') ; 
INSERT INTO `historyactions` VALUES (20, 8, 100, '2013-04-03', '2013-04-04', 8, 'normale', 'terminée', 'Le 04/04/2013 par LEVAVASSEUR Jacques<br>Consolidation des charges consommées sur le lot 303 en 2012 et janvier 2013.<br />Remplir le fichier Excel envoyé par Jean-Pierre NEFF et le renvoyer à AAE, JBJ et JPN avec les explications<br /><br />Transmis les information à AAE, JBJ et JPN suite aux derniers élément de Jean-Baptiste', '2013-04-04', '2013-04-04') ; 
INSERT INTO `historyactions` VALUES (21, 7, 30, '2013-04-02', '2013-04-25', 64, 'normale', 'en cours', 'Le 08/04/2013 par LEVAVASSEUR Jacques<br>Le 02/04/2013 :<br /><ol>
<li>Arrivée à Lyon de Renaud BORG</li>
<li>Préparation poste de dépannage P64L03BIXXX pour Renaud BORG</li>
<li>Traitemement des demandes de fin de semaine précédente</li>
<li>Demande d\'ouverture de droits pour Renaud BORG et BELHOUT Mabrouk</li>
<li>Deux nouveaux arrivant sur VILLEURBANNE pour ORCHESTRAL.</li>
<li>demande de créations de compte pour deux nouveaux arrivants à SOGETI</li>
<li>Demande de création de dossier personnel pour BORG Renaud</li>
</ol>
<p>Le 03/04/2013 :</p>
<ol>
<li>Demande d\'ajout dans des groupes existant pour LUC et RUIZ</li>
<li>Demande ouverture de droits pour LUC et RUIZ</li>
</ol><br />Le 04/04/2013 :<br /><ol>
<li>Mise à jour de listes de diffusion pour le groupement</li>
<li>Suivi des ouverture de droits</li>
<li>Demande accès SAMETIME pour S BEYDON</li>
<li>Relance D LECLERC sur mise à jour de la commande de matériel à confirmer en COCOR</li>
</ol><br />Le 08/04/2013 :<br /><ol>
<li>Mise à jour de liste de diffusion groupement</li>
</ol>', '2013-04-08', '2013-04-08') ; 
INSERT INTO `historyactions` VALUES (22, 10, 0, '2013-04-10', '2013-04-11', 1, 'normale', 'à faire', 'Le 08/04/2013 par LEVAVASSEUR Jacques<br>Voir avec Sébastien si délégation de saisie faite<br />Saisir activité de Sébastien sur PANAM DEV à parit du 04/03/2013', '2013-04-08', '2013-04-08') ; 
INSERT INTO `historyactions` VALUES (23, 1, 90, '2013-01-07', '2013-03-28', 96, 'normale', 'en cours', 'Le 09/04/2013 par LEVAVASSEUR Jacques<br>Janvier :<br />
<ul>
<li>Incorporation de l\'activité</li>
</ul>
<p>Février :</p>
<ul>
<li>Incorporation de l\'activité</li>
<li>Consolidation consommé et insertion</li>
<li>Envois pour validation</li>
</ul>
<p>Mars :</p>
<ul>
<li>Incorporation du budget contratcualisé</li>
<li>Consolidation du consommé (02/04/2013 pas de retour pour charge de LMN et E7)</li>
<li>Incorporation de l\'activité réalisée en mars dans le CRA</li>
<li>Envoyé pour validation à AAE et JBJ</li>
<li><span style="color: #ff0000;">Correction sur l\'emplacement des coûts DSIT-X mis en MCO explication sur montant de 2805k€ (2309k€ + 455 k€), changement année pour prestation formation</span></li>
</ul>', '2013-04-09', '2013-04-09') ; 
INSERT INTO `historyactions` VALUES (24, 10, 100, '2013-04-10', '2013-04-11', 1, 'normale', 'terminée', 'Le 09/04/2013 par LEVAVASSEUR Jacques<br>Voir avec Sébastien si délégation de saisie faite<br />Saisir activité de Sébastien sur PANAM DEV à parit du 04/03/2013<br />Facturation faite', '2013-04-09', '2013-04-09') ; 
INSERT INTO `historyactions` VALUES (25, 7, 30, '2013-04-02', '2013-04-25', 64, 'normale', 'en cours', 'Le 09/04/2013 par LEVAVASSEUR Jacques<br>Le 02/04/2013 :<br /><ol>
<li>Arrivée à Lyon de Renaud BORG</li>
<li>Préparation poste de dépannage P64L03BIXXX pour Renaud BORG</li>
<li>Traitemement des demandes de fin de semaine précédente</li>
<li>Demande d\'ouverture de droits pour Renaud BORG et BELHOUT Mabrouk</li>
<li>Deux nouveaux arrivant sur VILLEURBANNE pour ORCHESTRAL.</li>
<li>demande de créations de compte pour deux nouveaux arrivants à SOGETI</li>
<li>Demande de création de dossier personnel pour BORG Renaud</li>
</ol>
<p>Le 03/04/2013 :</p>
<ol>
<li>Demande d\'ajout dans des groupes existant pour LUC et RUIZ</li>
<li>Demande ouverture de droits pour LUC et RUIZ</li>
</ol><br />Le 04/04/2013 :<br /><ol>
<li>Mise à jour de listes de diffusion pour le groupement</li>
<li>Suivi des ouverture de droits</li>
<li>Demande accès SAMETIME pour S BEYDON</li>
<li>Relance D LECLERC sur mise à jour de la commande de matériel à confirmer en COCOR</li>
</ol><br />Le 08/04/2013 :<br /><ol>
<li>Mise à jour de liste de diffusion groupement</li>
</ol><br />Le 09/04/2013 :<br /><ol>
<li>Mise à jour liste de diffusion groupement</li>
</ol>', '2013-04-09', '2013-04-09') ; 
INSERT INTO `historyactions` VALUES (26, 7, 40, '2013-04-02', '2013-04-25', 64, 'normale', 'en cours', 'Le 09/04/2013 par LEVAVASSEUR Jacques<br>Le 02/04/2013 :<br /><ol>
<li>Arrivée à Lyon de Renaud BORG</li>
<li>Préparation poste de dépannage P64L03BIXXX pour Renaud BORG</li>
<li>Traitemement des demandes de fin de semaine précédente</li>
<li>Demande d\'ouverture de droits pour Renaud BORG et BELHOUT Mabrouk</li>
<li>Deux nouveaux arrivant sur VILLEURBANNE pour ORCHESTRAL.</li>
<li>demande de créations de compte pour deux nouveaux arrivants à SOGETI</li>
<li>Demande de création de dossier personnel pour BORG Renaud</li>
</ol>
<p>Le 03/04/2013 :</p>
<ol>
<li>Demande d\'ajout dans des groupes existant pour LUC et RUIZ</li>
<li>Demande ouverture de droits pour LUC et RUIZ</li>
</ol><br />Le 04/04/2013 :<br /><ol>
<li>Mise à jour de listes de diffusion pour le groupement</li>
<li>Suivi des ouverture de droits</li>
<li>Demande accès SAMETIME pour S BEYDON</li>
<li>Relance D LECLERC sur mise à jour de la commande de matériel à confirmer en COCOR</li>
</ol><br />Le 08/04/2013 :<br /><ol>
<li>Mise à jour de liste de diffusion groupement</li>
</ol><br />Le 09/04/2013 :<br /><ol>
<li>Mise à jour liste de diffusion groupement</li>
</ol>', '2013-04-09', '2013-04-09') ; 
INSERT INTO `historyactions` VALUES (27, 9, 0, '2013-04-24', '2013-05-14', 2, 'normale', 'à faire', 'Le 09/04/2013 par LEVAVASSEUR Jacques<br>Présentation de l\'outil à AAE et JBJ pour validation avant mise en service à un périmétre réduit de l\'équipe.<br />Périmétre à définir lors de cette présentation.<br />Je pense à : <br />
<ul>
<li>Sabine GEOFFROY</li>
<li>Magali BURIAND</li>
<li>Benoit TRENTO</li>
<li>Jacques LEVAVASSEUR</li>
<li>Patricia RIFFIOD</li>
</ul>
<br />Ne faut-il pas qu\'ils assistent à la présentation ? <br />Echéance repoussée à mi mai', '2013-04-09', '2013-04-09') ; 
INSERT INTO `historyactions` VALUES (28, 9, 0, '2013-04-24', '2013-05-14', 2, 'normale', 'à faire', 'Le 09/04/2013 par LEVAVASSEUR Jacques<br>Présentation de l\'outil à AAE et JBJ pour validation avant mise en service à un périmétre réduit de l\'équipe.<br />Périmétre à définir lors de cette présentation.<br />Je pense à : <br />
<ul>
<li>Sabine GEOFFROY</li>
<li>Magali BURIAND</li>
<li>Benoit TRENTO</li>
<li>Jacques LEVAVASSEUR</li>
<li>Patricia RIFFIOD</li>
</ul>
Ne faut-il pas qu\'ils assistent à la présentation ? <br />Echéance repoussée à mi mai', '2013-04-09', '2013-04-09') ; 
INSERT INTO `historyactions` VALUES (29, 4, 90, '2013-02-04', '2013-05-14', 336, 'normale', 'en cours', 'Le 09/04/2013 par LEVAVASSEUR Jacques<br>Conception 12 jours<br />Réalisation 30 jours<br /><br />Bascule sur le serveur de production le 28/03/2013<br /><br />Evolutions en cours :<br />
<ul>
<li>Facturations</li>
<li>Plan de charge</li>
<li>Rapports (actions, consommation réelles, facturé)</li>
</ul>', '2013-04-09', '2013-04-09') ; 
INSERT INTO `historyactions` VALUES (30, 7, 50, '2013-04-02', '2013-04-25', 64, 'normale', 'en cours', 'Le 10/04/2013 par LEVAVASSEUR Jacques<br>Le 02/04/2013 :<br /><ol>
<li>Arrivée à Lyon de Renaud BORG</li>
<li>Préparation poste de dépannage P64L03BIXXX pour Renaud BORG</li>
<li>Traitemement des demandes de fin de semaine précédente</li>
<li>Demande d\'ouverture de droits pour Renaud BORG et BELHOUT Mabrouk</li>
<li>Deux nouveaux arrivant sur VILLEURBANNE pour ORCHESTRAL.</li>
<li>demande de créations de compte pour deux nouveaux arrivants à SOGETI</li>
<li>Demande de création de dossier personnel pour BORG Renaud</li>
</ol>
<p>Le 03/04/2013 :</p>
<ol>
<li>Demande d\'ajout dans des groupes existant pour LUC et RUIZ</li>
<li>Demande ouverture de droits pour LUC et RUIZ</li>
</ol><br />Le 04/04/2013 :<br /><ol>
<li>Mise à jour de listes de diffusion pour le groupement</li>
<li>Suivi des ouverture de droits</li>
<li>Demande accès SAMETIME pour S BEYDON</li>
<li>Relance D LECLERC sur mise à jour de la commande de matériel à confirmer en COCOR</li>
</ol><br />Le 08/04/2013 :<br /><ol>
<li>Mise à jour de liste de diffusion groupement</li>
</ol><br />Le 09/04/2013 :<br /><ol>
<li>Mise à jour liste de diffusion groupement</li>
</ol><br />Le 10/04/2013 :<br /><ol>
<li>Activation du compte de LANAILLE Sébastien et demande d\'ouverture de droit</li>
</ol>', '2013-04-10', '2013-04-10') ; 
INSERT INTO `historyactions` VALUES (31, 7, 60, '2013-04-02', '2013-04-25', 64, 'normale', 'en cours', 'Le 15/04/2013 par LEVAVASSEUR Jacques<br>Le 02/04/2013 :<br /><ol>
<li>Arrivée à Lyon de Renaud BORG</li>
<li>Préparation poste de dépannage P64L03BIXXX pour Renaud BORG</li>
<li>Traitemement des demandes de fin de semaine précédente</li>
<li>Demande d\'ouverture de droits pour Renaud BORG et BELHOUT Mabrouk</li>
<li>Deux nouveaux arrivant sur VILLEURBANNE pour ORCHESTRAL.</li>
<li>demande de créations de compte pour deux nouveaux arrivants à SOGETI</li>
<li>Demande de création de dossier personnel pour BORG Renaud</li>
</ol>
<p>Le 03/04/2013 :</p>
<ol>
<li>Demande d\'ajout dans des groupes existant pour LUC et RUIZ</li>
<li>Demande ouverture de droits pour LUC et RUIZ</li>
</ol>Le 04/04/2013 :<br /><ol>
<li>Mise à jour de listes de diffusion pour le groupement</li>
<li>Suivi des ouverture de droits</li>
<li>Demande accès SAMETIME pour S BEYDON</li>
<li>Relance D LECLERC sur mise à jour de la commande de matériel à confirmer en COCOR</li>
</ol>Le 08/04/2013 :<br /><ol>
<li>Mise à jour de liste de diffusion groupement</li>
</ol>Le 09/04/2013 :<br /><ol>
<li>Mise à jour liste de diffusion groupement</li>
</ol>Le 10/04/2013 :<br /><ol>
<li>Activation du compte de LANAILLE Sébastien et demande d\'ouverture de droit</li>
</ol>Le 11/04/2013<br /><ol>
<li>Création de compte pour FLORE PELE</li>
</ol>Le 15/04/2013<br /><ol>
<li>Suivi d\'avancement logistique</li>
<li>Ouverture de droits pour FLORE PELE</li>
<li>Création de deux comptes pour Groupement</li>
</ol>', '2013-04-15', '2013-04-15') ; 
INSERT INTO `historyactions` VALUES (32, 11, 40, '2013-04-11', '2013-04-22', 8, 'moyenne', 'en cours', 'Le 15/04/2013 par LEVAVASSEUR Jacques<br>', '2013-04-15', '2013-04-15') ; 
INSERT INTO `historyactions` VALUES (33, 11, 40, '2013-04-11', '2013-04-22', 8, 'moyenne', 'en cours', 'Le 15/04/2013 par LEVAVASSEUR Jacques<br>Consolidation des charges d\'avril<br />Contacts avec Charlotte DUVERGER pour :<br />
<ul>
<li>consolidation commune GMAO et PANAM</li>
<li>Ecart facturation pour Aurélie CARRET et Julien DELEFOSSE</li>
</ul>
Envois de la consolidation pour validation SS2I', '2013-04-15', '2013-04-15') ; 
INSERT INTO `historyactions` VALUES (34, 12, 70, '2013-04-09', '2013-04-18', 8, 'normale', 'en cours', 'Le 15/04/2013 par LEVAVASSEUR Jacques<br>Recherche d\'information sur comment faire<br />Prise de contact avec VALLI Sébastien<br />Fichier Excel rempli , envoyé au chef de section.<br />Retour CV et proposition STERIA pour Stéphane BEYDON.<br />En attente du CV et de la proposition pour Renaud BORG', '2013-04-15', '2013-04-15') ; 
INSERT INTO `historyactions` VALUES (35, 7, 60, '2013-04-02', '2013-04-25', 64, 'normale', 'en cours', 'Le 15/04/2013 par LEVAVASSEUR Jacques<br>Le 02/04/2013 :<br /><ol>
<li>Arrivée à Lyon de Renaud BORG</li>
<li>Préparation poste de dépannage P64L03BIXXX pour Renaud BORG</li>
<li>Traitemement des demandes de fin de semaine précédente</li>
<li>Demande d\'ouverture de droits pour Renaud BORG et BELHOUT Mabrouk</li>
<li>Deux nouveaux arrivant sur VILLEURBANNE pour ORCHESTRAL.</li>
<li>demande de créations de compte pour deux nouveaux arrivants à SOGETI</li>
<li>Demande de création de dossier personnel pour BORG Renaud</li>
</ol>
<p>Le 03/04/2013 :</p>
<ol>
<li>Demande d\'ajout dans des groupes existant pour LUC et RUIZ</li>
<li>Demande ouverture de droits pour LUC et RUIZ</li>
</ol>Le 04/04/2013 :<br /><ol>
<li>Mise à jour de listes de diffusion pour le groupement</li>
<li>Suivi des ouverture de droits</li>
<li>Demande accès SAMETIME pour S BEYDON</li>
<li>Relance D LECLERC sur mise à jour de la commande de matériel à confirmer en COCOR</li>
</ol>Le 08/04/2013 :<br /><ol>
<li>Mise à jour de liste de diffusion groupement</li>
</ol>Le 09/04/2013 :<br /><ol>
<li>Mise à jour liste de diffusion groupement</li>
</ol>Le 10/04/2013 :<br /><ol>
<li>Activation du compte de LANAILLE Sébastien et demande d\'ouverture de droit</li>
</ol>Le 11/04/2013<br /><ol>
<li>Création de compte pour FLORE PELE</li>
</ol>Le 15/04/2013<br /><ol>
<li>Suivi d\'avancement logistique</li>
<li>Ouverture de droits pour FLORE PELE</li>
<li>Création de deux comptes pour Groupement</li>
<li>Ouverture des droits à F. RABATEL sur OSMOSECSNROP</li>
</ol>', '2013-04-15', '2013-04-15') ; 
INSERT INTO `historyactions` VALUES (36, 7, 60, '2013-04-02', '2013-04-25', 64, 'normale', 'en cours', 'Le 15/04/2013 par LEVAVASSEUR Jacques<br>Le 02/04/2013 :<br /><ol>
<li>Arrivée à Lyon de Renaud BORG</li>
<li>Préparation poste de dépannage P64L03BIXXX pour Renaud BORG</li>
<li>Traitemement des demandes de fin de semaine précédente</li>
<li>Demande d\'ouverture de droits pour Renaud BORG et BELHOUT Mabrouk</li>
<li>Deux nouveaux arrivant sur VILLEURBANNE pour ORCHESTRAL.</li>
<li>demande de créations de compte pour deux nouveaux arrivants à SOGETI</li>
<li>Demande de création de dossier personnel pour BORG Renaud</li>
</ol>
<p>Le 03/04/2013 :</p>
<ol>
<li>Demande d\'ajout dans des groupes existant pour LUC et RUIZ</li>
<li>Demande ouverture de droits pour LUC et RUIZ</li>
</ol>Le 04/04/2013 :<br /><ol>
<li>Mise à jour de listes de diffusion pour le groupement</li>
<li>Suivi des ouverture de droits</li>
<li>Demande accès SAMETIME pour S BEYDON</li>
<li>Relance D LECLERC sur mise à jour de la commande de matériel à confirmer en COCOR</li>
</ol>Le 08/04/2013 :<br /><ol>
<li>Mise à jour de liste de diffusion groupement</li>
</ol>Le 09/04/2013 :<br /><ol>
<li>Mise à jour liste de diffusion groupement</li>
</ol>Le 10/04/2013 :<br /><ol>
<li>Activation du compte de LANAILLE Sébastien et demande d\'ouverture de droit</li>
</ol>Le 11/04/2013<br /><ol>
<li>Création de compte pour FLORE PELE</li>
</ol>Le 15/04/2013<br /><ol>
<li>Suivi d\'avancement logistique</li>
<li>Ouverture de droits pour FLORE PELE</li>
<li>Création de deux comptes pour Groupement</li>
<li>Ouverture des droits à F. RABATEL sur OSMOSECSNROP</li>
<li>Accés Minidoc pour MONTROIG Thomas (DM/M S&amp;F)</li>
</ol>', '2013-04-15', '2013-04-15') ; 
INSERT INTO `historyactions` VALUES (37, 7, 60, '2013-04-02', '2013-04-25', 64, 'normale', 'en cours', 'Le 15/04/2013 par LEVAVASSEUR Jacques<br>Le 02/04/2013 :<br /><ol>
<li>Arrivée à Lyon de Renaud BORG</li>
<li>Préparation poste de dépannage P64L03BIXXX pour Renaud BORG</li>
<li>Traitemement des demandes de fin de semaine précédente</li>
<li>Demande d\'ouverture de droits pour Renaud BORG et BELHOUT Mabrouk</li>
<li>Deux nouveaux arrivant sur VILLEURBANNE pour ORCHESTRAL.</li>
<li>demande de créations de compte pour deux nouveaux arrivants à SOGETI</li>
<li>Demande de création de dossier personnel pour BORG Renaud</li>
</ol>
<p>Le 03/04/2013 :</p>
<ol>
<li>Demande d\'ajout dans des groupes existant pour LUC et RUIZ</li>
<li>Demande ouverture de droits pour LUC et RUIZ</li>
</ol>Le 04/04/2013 :<br /><ol>
<li>Mise à jour de listes de diffusion pour le groupement</li>
<li>Suivi des ouverture de droits</li>
<li>Demande accès SAMETIME pour S BEYDON</li>
<li>Relance D LECLERC sur mise à jour de la commande de matériel à confirmer en COCOR</li>
</ol>Le 08/04/2013 :<br /><ol>
<li>Mise à jour de liste de diffusion groupement</li>
</ol>Le 09/04/2013 :<br /><ol>
<li>Mise à jour liste de diffusion groupement</li>
</ol>Le 10/04/2013 :<br /><ol>
<li>Activation du compte de LANAILLE Sébastien et demande d\'ouverture de droit</li>
</ol>Le 11/04/2013<br /><ol>
<li>Création de compte pour FLORE PELE</li>
</ol>Le 15/04/2013<br /><ol>
<li>Suivi d\'avancement logistique</li>
<li>Ouverture de droits pour FLORE PELE</li>
<li>Création de deux comptes pour Groupement</li>
<li>Ouverture des droits à F. RABATEL sur OSMOSECSNROP</li>
<li>Accés Minidoc pour MONTROIG Thomas (DM/M S&amp;F)</li>
<li>Accueil de NGOM Amsata, présentation équipe, locaux et utilisation fichier absences</li>
</ol>', '2013-04-15', '2013-04-15') ; 
INSERT INTO `historyactions` VALUES (38, 7, 60, '2013-04-02', '2013-04-25', 64, 'normale', 'en cours', 'Le 16/04/2013 par LEVAVASSEUR Jacques<br>Le 02/04/2013 :<br /><ol>
<li>Arrivée à Lyon de Renaud BORG</li>
<li>Préparation poste de dépannage P64L03BIXXX pour Renaud BORG</li>
<li>Traitemement des demandes de fin de semaine précédente</li>
<li>Demande d\'ouverture de droits pour Renaud BORG et BELHOUT Mabrouk</li>
<li>Deux nouveaux arrivant sur VILLEURBANNE pour ORCHESTRAL.</li>
<li>demande de créations de compte pour deux nouveaux arrivants à SOGETI</li>
<li>Demande de création de dossier personnel pour BORG Renaud</li>
</ol>
<p>Le 03/04/2013 :</p>
<ol>
<li>Demande d\'ajout dans des groupes existant pour LUC et RUIZ</li>
<li>Demande ouverture de droits pour LUC et RUIZ</li>
</ol>Le 04/04/2013 :<br /><ol>
<li>Mise à jour de listes de diffusion pour le groupement</li>
<li>Suivi des ouverture de droits</li>
<li>Demande accès SAMETIME pour S BEYDON</li>
<li>Relance D LECLERC sur mise à jour de la commande de matériel à confirmer en COCOR</li>
</ol>Le 08/04/2013 :<br /><ol>
<li>Mise à jour de liste de diffusion groupement</li>
</ol>Le 09/04/2013 :<br /><ol>
<li>Mise à jour liste de diffusion groupement</li>
</ol>Le 10/04/2013 :<br /><ol>
<li>Activation du compte de LANAILLE Sébastien et demande d\'ouverture de droit</li>
</ol>Le 11/04/2013<br /><ol>
<li>Création de compte pour FLORE PELE</li>
</ol>Le 15/04/2013<br /><ol>
<li>Suivi d\'avancement logistique</li>
<li>Ouverture de droits pour FLORE PELE</li>
<li>Création de deux comptes pour Groupement</li>
<li>Ouverture des droits à F. RABATEL sur OSMOSECSNROP</li>
<li>Accés Minidoc pour MONTROIG Thomas (DM/M S&amp;F)</li>
<li>Accueil de NGOM Amsata, présentation équipe, locaux et utilisation fichier absences</li>
</ol>Le 16/04/2013 :<br /><ol>
<li>Suivi des ouverture de droits</li>
<li>Mis à jour liste de diffusion</li>
</ol>', '2013-04-16', '2013-04-16') ; 
INSERT INTO `historyactions` VALUES (39, 13, 90, '2013-04-11', '2013-04-23', 12, 'moyenne', 'en cours', 'Le 16/04/2013 par LEVAVASSEUR Jacques<br>Reste l\'activité de Benoit TRENTO avec la répartition sur les diférentes activités.<br />Toutes les autres saisies sont faites.<br />Rattrappage de 2 jours mis en Congé pour N. THARSIS en mars non pris, mis travaillé à la place en Avril', '2013-04-16', '2013-04-16') ; 
INSERT INTO `historyactions` VALUES (40, 12, 100, '2013-04-09', '2013-04-18', 8, 'normale', 'terminée', 'Le 16/04/2013 par LEVAVASSEUR Jacques<br>Recherche d\'information sur comment faire<br />Prise de contact avec VALLI Sébastien<br />Fichier Excel rempli , envoyé au chef de section.<br />Retour CV et proposition STERIA pour Stéphane BEYDON.<br />En attente du CV et de la proposition pour Renaud BORG<br /><br />Envoyé le 15/04/2013', '2013-04-16', '2013-04-16') ; 
INSERT INTO `historyactions` VALUES (41, 11, 60, '2013-04-11', '2013-04-22', 8, 'moyenne', 'en cours', 'Le 16/04/2013 par LEVAVASSEUR Jacques<br>Consolidation des charges d\'avril<br />Contacts avec Charlotte DUVERGER pour :<br />
<ul>
<li>consolidation commune GMAO et PANAM</li>
<li>Ecart facturation pour Aurélie CARRET et Julien DELEFOSSE</li>
</ul>
Envois de la consolidation pour validation SS2I<br /><br />Confrontation des chiffres avec SQLi/STERIA mercredi 16/04/2013', '2013-04-16', '2013-04-16') ; 
INSERT INTO `historyactions` VALUES (42, 7, 60, '2013-04-02', '2013-04-25', 64, 'normale', 'en cours', 'Le 16/04/2013 par LEVAVASSEUR Jacques<br>Le 02/04/2013 :<br /><ol>
<li>Arrivée à Lyon de Renaud BORG</li>
<li>Préparation poste de dépannage P64L03BIXXX pour Renaud BORG</li>
<li>Traitemement des demandes de fin de semaine précédente</li>
<li>Demande d\'ouverture de droits pour Renaud BORG et BELHOUT Mabrouk</li>
<li>Deux nouveaux arrivant sur VILLEURBANNE pour ORCHESTRAL.</li>
<li>demande de créations de compte pour deux nouveaux arrivants à SOGETI</li>
<li>Demande de création de dossier personnel pour BORG Renaud</li>
</ol>
<p>Le 03/04/2013 :</p>
<ol>
<li>Demande d\'ajout dans des groupes existant pour LUC et RUIZ</li>
<li>Demande ouverture de droits pour LUC et RUIZ</li>
</ol>Le 04/04/2013 :<br /><ol>
<li>Mise à jour de listes de diffusion pour le groupement</li>
<li>Suivi des ouverture de droits</li>
<li>Demande accès SAMETIME pour S BEYDON</li>
<li>Relance D LECLERC sur mise à jour de la commande de matériel à confirmer en COCOR</li>
</ol>Le 08/04/2013 :<br /><ol>
<li>Mise à jour de liste de diffusion groupement</li>
</ol>Le 09/04/2013 :<br /><ol>
<li>Mise à jour liste de diffusion groupement</li>
</ol>Le 10/04/2013 :<br /><ol>
<li>Activation du compte de LANAILLE Sébastien et demande d\'ouverture de droit</li>
</ol>Le 11/04/2013<br /><ol>
<li>Création de compte pour FLORE PELE</li>
</ol>Le 15/04/2013<br /><ol>
<li>Suivi d\'avancement logistique</li>
<li>Ouverture de droits pour FLORE PELE</li>
<li>Création de deux comptes pour Groupement</li>
<li>Ouverture des droits à F. RABATEL sur OSMOSECSNROP</li>
<li>Accés Minidoc pour MONTROIG Thomas (DM/M S&amp;F)</li>
<li>Accueil de NGOM Amsata, présentation équipe, locaux et utilisation fichier absences</li>
</ol>Le 16/04/2013 :<br /><ol>
<li>Suivi des ouverture de droits</li>
<li>Mis à jour liste de diffusion</li>
<li>Mise à jour du suivi pour ARIANE et autres ouvertures de droits</li>
</ol>', '2013-04-16', '2013-04-16') ; 
INSERT INTO `historyactions` VALUES (43, 7, 60, '2013-04-02', '2013-04-25', 64, 'normale', 'en cours', 'Le 17/04/2013 par LEVAVASSEUR Jacques<br>Le 02/04/2013 :<br /><ol>
<li>Arrivée à Lyon de Renaud BORG</li>
<li>Préparation poste de dépannage P64L03BIXXX pour Renaud BORG</li>
<li>Traitemement des demandes de fin de semaine précédente</li>
<li>Demande d\'ouverture de droits pour Renaud BORG et BELHOUT Mabrouk</li>
<li>Deux nouveaux arrivant sur VILLEURBANNE pour ORCHESTRAL.</li>
<li>demande de créations de compte pour deux nouveaux arrivants à SOGETI</li>
<li>Demande de création de dossier personnel pour BORG Renaud</li>
</ol>
<p>Le 03/04/2013 :</p>
<ol>
<li>Demande d\'ajout dans des groupes existant pour LUC et RUIZ</li>
<li>Demande ouverture de droits pour LUC et RUIZ</li>
</ol>Le 04/04/2013 :<br /><ol>
<li>Mise à jour de listes de diffusion pour le groupement</li>
<li>Suivi des ouverture de droits</li>
<li>Demande accès SAMETIME pour S BEYDON</li>
<li>Relance D LECLERC sur mise à jour de la commande de matériel à confirmer en COCOR</li>
</ol>Le 08/04/2013 :<br /><ol>
<li>Mise à jour de liste de diffusion groupement</li>
</ol>Le 09/04/2013 :<br /><ol>
<li>Mise à jour liste de diffusion groupement</li>
</ol>Le 10/04/2013 :<br /><ol>
<li>Activation du compte de LANAILLE Sébastien et demande d\'ouverture de droit</li>
</ol>Le 11/04/2013<br /><ol>
<li>Création de compte pour FLORE PELE</li>
</ol>Le 15/04/2013<br /><ol>
<li>Suivi d\'avancement logistique</li>
<li>Ouverture de droits pour FLORE PELE</li>
<li>Création de deux comptes pour Groupement</li>
<li>Ouverture des droits à F. RABATEL sur OSMOSECSNROP</li>
<li>Accés Minidoc pour MONTROIG Thomas (DM/M S&amp;F)</li>
<li>Accueil de NGOM Amsata, présentation équipe, locaux et utilisation fichier absences</li>
</ol>Le 16/04/2013 :<br /><ol>
<li>Suivi des ouverture de droits</li>
<li>Mis à jour liste de diffusion</li>
<li>Mise à jour du suivi pour ARIANE et autres ouvertures de droits</li>
</ol>le 17/04/2013 :<br /><ol>
<li>Demande ouverture d edroits pour C. Bril</li>
<li>Information réception commande portable. Attente contact samba logistique.</li>
</ol>', '2013-04-17', '2013-04-17') ; 
INSERT INTO `historyactions` VALUES (44, 11, 80, '2013-04-11', '2013-04-22', 8, 'moyenne', 'en cours', 'Le 17/04/2013 par LEVAVASSEUR Jacques<br>Consolidation des charges d\'avril<br />Contacts avec Charlotte DUVERGER pour :<br />
<ul>
<li>consolidation commune GMAO et PANAM</li>
<li>Ecart facturation pour Aurélie CARRET et Julien DELEFOSSE</li>
</ul>
Envois de la consolidation pour validation SS2I<br /><br />Confrontation des chiffres avec SQLi/STERIA mercredi 16/04/2013<br /><br />Exl group : écart d\'un jour sur le mois de mars rattrappage en avril (-1)<br /><br />Fichier Excel renseigné et sauvegardé.<br />Attente des retours STERIA - EURIWARE et EXLGROUP pour finaliser<br />Vu avec EXLGROUP<br />Vu avec STERIA dans l\'après midi<br />Envois à Euriware de la prévision de facturation pour Avril', '2013-04-17', '2013-04-17') ; 
INSERT INTO `historyactions` VALUES (45, 13, 100, '2013-04-11', '2013-04-23', 12, 'moyenne', 'terminée', 'Le 17/04/2013 par LEVAVASSEUR Jacques<br>Reste l\'activité de Benoit TRENTO avec la répartition sur les diférentes activités.<br />Toutes les autres saisies sont faites.<br />Rattrappage de 2 jours mis en Congé pour N. THARSIS en mars non pris, mis travaillé à la place en Avril', '2013-04-17', '2013-04-17') ; 
INSERT INTO `historyactions` VALUES (46, 7, 60, '2013-04-02', '2013-04-25', 64, 'normale', 'en cours', 'Le 17/04/2013 par LEVAVASSEUR Jacques<br>Le 02/04/2013 :<br /><ol>
<li>Arrivée à Lyon de Renaud BORG</li>
<li>Préparation poste de dépannage P64L03BIXXX pour Renaud BORG</li>
<li>Traitemement des demandes de fin de semaine précédente</li>
<li>Demande d\'ouverture de droits pour Renaud BORG et BELHOUT Mabrouk</li>
<li>Deux nouveaux arrivant sur VILLEURBANNE pour ORCHESTRAL.</li>
<li>demande de créations de compte pour deux nouveaux arrivants à SOGETI</li>
<li>Demande de création de dossier personnel pour BORG Renaud</li>
</ol>
<p>Le 03/04/2013 :</p>
<ol>
<li>Demande d\'ajout dans des groupes existant pour LUC et RUIZ</li>
<li>Demande ouverture de droits pour LUC et RUIZ</li>
</ol>Le 04/04/2013 :<br /><ol>
<li>Mise à jour de listes de diffusion pour le groupement</li>
<li>Suivi des ouverture de droits</li>
<li>Demande accès SAMETIME pour S BEYDON</li>
<li>Relance D LECLERC sur mise à jour de la commande de matériel à confirmer en COCOR</li>
</ol>Le 08/04/2013 :<br /><ol>
<li>Mise à jour de liste de diffusion groupement</li>
</ol>Le 09/04/2013 :<br /><ol>
<li>Mise à jour liste de diffusion groupement</li>
</ol>Le 10/04/2013 :<br /><ol>
<li>Activation du compte de LANAILLE Sébastien et demande d\'ouverture de droit</li>
</ol>Le 11/04/2013<br /><ol>
<li>Création de compte pour FLORE PELE</li>
</ol>Le 15/04/2013<br /><ol>
<li>Suivi d\'avancement logistique</li>
<li>Ouverture de droits pour FLORE PELE</li>
<li>Création de deux comptes pour Groupement</li>
<li>Ouverture des droits à F. RABATEL sur OSMOSECSNROP</li>
<li>Accés Minidoc pour MONTROIG Thomas (DM/M S&amp;F)</li>
<li>Accueil de NGOM Amsata, présentation équipe, locaux et utilisation fichier absences</li>
</ol>Le 16/04/2013 :<br /><ol>
<li>Suivi des ouverture de droits</li>
<li>Mis à jour liste de diffusion</li>
<li>Mise à jour du suivi pour ARIANE et autres ouvertures de droits</li>
</ol>le 17/04/2013 :<br /><ol>
<li>Demande ouverture d edroits pour C. Bril</li>
<li>Information réception commande portable. Attente contact samba logistique.</li>
<li>Envois des dossier pour installations des 4 portables, demande pour récupérer les accessoires faites</li>
</ol>', '2013-04-17', '2013-04-17') ; 
INSERT INTO `historyactions` VALUES (47, 11, 100, '2013-04-11', '2013-04-22', 8, 'moyenne', 'terminée', 'Le 18/04/2013 par LEVAVASSEUR Jacques<br>Consolidation des charges d\'avril<br />Contacts avec Charlotte DUVERGER pour :<br />
<ul>
<li>consolidation commune GMAO et PANAM</li>
<li>Ecart facturation pour Aurélie CARRET et Julien DELEFOSSE</li>
</ul>
Envois de la consolidation pour validation SS2I<br /><br />Confrontation des chiffres avec SQLi/STERIA mercredi 16/04/2013<br /><br />Exl group : écart d\'un jour sur le mois de mars rattrappage en avril (-1)<br /><br />Fichier Excel renseigné et sauvegardé.<br />Attente des retours STERIA - EURIWARE et EXLGROUP pour finaliser<br />Vu avec EXLGROUP<br />Vu avec STERIA dans l\'après midi<br />Envois à Euriware de la prévision de facturation pour Avril', '2013-04-18', '2013-04-18') ; 
INSERT INTO `historyactions` VALUES (48, 7, 70, '2013-04-02', '2013-04-25', 64, 'normale', 'en cours', 'Le 18/04/2013 par LEVAVASSEUR Jacques<br>Le 02/04/2013 :<br /><ol>
<li>Arrivée à Lyon de Renaud BORG</li>
<li>Préparation poste de dépannage P64L03BIXXX pour Renaud BORG</li>
<li>Traitemement des demandes de fin de semaine précédente</li>
<li>Demande d\'ouverture de droits pour Renaud BORG et BELHOUT Mabrouk</li>
<li>Deux nouveaux arrivant sur VILLEURBANNE pour ORCHESTRAL.</li>
<li>demande de créations de compte pour deux nouveaux arrivants à SOGETI</li>
<li>Demande de création de dossier personnel pour BORG Renaud</li>
</ol>
<p>Le 03/04/2013 :</p>
<ol>
<li>Demande d\'ajout dans des groupes existant pour LUC et RUIZ</li>
<li>Demande ouverture de droits pour LUC et RUIZ</li>
</ol>Le 04/04/2013 :<br /><ol>
<li>Mise à jour de listes de diffusion pour le groupement</li>
<li>Suivi des ouverture de droits</li>
<li>Demande accès SAMETIME pour S BEYDON</li>
<li>Relance D LECLERC sur mise à jour de la commande de matériel à confirmer en COCOR</li>
</ol>Le 08/04/2013 :<br /><ol>
<li>Mise à jour de liste de diffusion groupement</li>
</ol>Le 09/04/2013 :<br /><ol>
<li>Mise à jour liste de diffusion groupement</li>
</ol>Le 10/04/2013 :<br /><ol>
<li>Activation du compte de LANAILLE Sébastien et demande d\'ouverture de droit</li>
</ol>Le 11/04/2013<br /><ol>
<li>Création de compte pour FLORE PELE</li>
</ol>Le 15/04/2013<br /><ol>
<li>Suivi d\'avancement logistique</li>
<li>Ouverture de droits pour FLORE PELE</li>
<li>Création de deux comptes pour Groupement</li>
<li>Ouverture des droits à F. RABATEL sur OSMOSECSNROP</li>
<li>Accés Minidoc pour MONTROIG Thomas (DM/M S&amp;F)</li>
<li>Accueil de NGOM Amsata, présentation équipe, locaux et utilisation fichier absences</li>
</ol>Le 16/04/2013 :<br /><ol>
<li>Suivi des ouverture de droits</li>
<li>Mis à jour liste de diffusion</li>
<li>Mise à jour du suivi pour ARIANE et autres ouvertures de droits</li>
</ol>le 17/04/2013 :<br /><ol>
<li>Demande ouverture d edroits pour C. Bril</li>
<li>Information réception commande portable. Attente contact samba logistique.</li>
<li>Envois des dossier pour installations des 4 portables, demande pour récupérer les accessoires faites</li>
</ol>Le 18/04/2013<br /><ol>
<li>Suivi logistique</li>
</ol>', '2013-04-18', '2013-04-18') ; 
INSERT INTO `historyactions` VALUES (49, 7, 80, '2013-04-02', '2013-04-25', 64, 'normale', 'en cours', 'Le 22/04/2013 par LEVAVASSEUR Jacques<br>Le 02/04/2013 :<br /><ol>
<li>Arrivée à Lyon de Renaud BORG</li>
<li>Préparation poste de dépannage P64L03BIXXX pour Renaud BORG</li>
<li>Traitemement des demandes de fin de semaine précédente</li>
<li>Demande d\'ouverture de droits pour Renaud BORG et BELHOUT Mabrouk</li>
<li>Deux nouveaux arrivant sur VILLEURBANNE pour ORCHESTRAL.</li>
<li>demande de créations de compte pour deux nouveaux arrivants à SOGETI</li>
<li>Demande de création de dossier personnel pour BORG Renaud</li>
</ol>
<p>Le 03/04/2013 :</p>
<ol>
<li>Demande d\'ajout dans des groupes existant pour LUC et RUIZ</li>
<li>Demande ouverture de droits pour LUC et RUIZ</li>
</ol>Le 04/04/2013 :<br /><ol>
<li>Mise à jour de listes de diffusion pour le groupement</li>
<li>Suivi des ouverture de droits</li>
<li>Demande accès SAMETIME pour S BEYDON</li>
<li>Relance D LECLERC sur mise à jour de la commande de matériel à confirmer en COCOR</li>
</ol>Le 08/04/2013 :<br /><ol>
<li>Mise à jour de liste de diffusion groupement</li>
</ol>Le 09/04/2013 :<br /><ol>
<li>Mise à jour liste de diffusion groupement</li>
</ol>Le 10/04/2013 :<br /><ol>
<li>Activation du compte de LANAILLE Sébastien et demande d\'ouverture de droit</li>
</ol>Le 11/04/2013<br /><ol>
<li>Création de compte pour FLORE PELE</li>
</ol>Le 15/04/2013<br /><ol>
<li>Suivi d\'avancement logistique</li>
<li>Ouverture de droits pour FLORE PELE</li>
<li>Création de deux comptes pour Groupement</li>
<li>Ouverture des droits à F. RABATEL sur OSMOSECSNROP</li>
<li>Accés Minidoc pour MONTROIG Thomas (DM/M S&amp;F)</li>
<li>Accueil de NGOM Amsata, présentation équipe, locaux et utilisation fichier absences</li>
</ol>Le 16/04/2013 :<br /><ol>
<li>Suivi des ouverture de droits</li>
<li>Mis à jour liste de diffusion</li>
<li>Mise à jour du suivi pour ARIANE et autres ouvertures de droits</li>
</ol>le 17/04/2013 :<br /><ol>
<li>Demande ouverture d edroits pour C. Bril</li>
<li>Information réception commande portable. Attente contact samba logistique.</li>
<li>Envois des dossier pour installations des 4 portables, demande pour récupérer les accessoires faites</li>
</ol>Le 18/04/2013<br /><ol>
<li>Suivi logistique</li>
</ol>Le 22/04/2013 :<br /><ol>
<li>Activation du compte de MANDINA-NZEZA Guy-Serge</li>
<li>Initilaisation du mot de passe de MANDINA-NZEZA Guy-Serge</li>
</ol>', '2013-04-22', '2013-04-22') ; 
INSERT INTO `historyactions` VALUES (50, 7, 80, '2013-04-02', '2013-04-25', 64, 'normale', 'en cours', 'Le 23/04/2013 par LEVAVASSEUR Jacques<br>Le 02/04/2013 :<br /><ol>
<li>Arrivée à Lyon de Renaud BORG</li>
<li>Préparation poste de dépannage P64L03BIXXX pour Renaud BORG</li>
<li>Traitemement des demandes de fin de semaine précédente</li>
<li>Demande d\'ouverture de droits pour Renaud BORG et BELHOUT Mabrouk</li>
<li>Deux nouveaux arrivant sur VILLEURBANNE pour ORCHESTRAL.</li>
<li>demande de créations de compte pour deux nouveaux arrivants à SOGETI</li>
<li>Demande de création de dossier personnel pour BORG Renaud</li>
</ol>
<p>Le 03/04/2013 :</p>
<ol>
<li>Demande d\'ajout dans des groupes existant pour LUC et RUIZ</li>
<li>Demande ouverture de droits pour LUC et RUIZ</li>
</ol>Le 04/04/2013 :<br /><ol>
<li>Mise à jour de listes de diffusion pour le groupement</li>
<li>Suivi des ouverture de droits</li>
<li>Demande accès SAMETIME pour S BEYDON</li>
<li>Relance D LECLERC sur mise à jour de la commande de matériel à confirmer en COCOR</li>
</ol>Le 08/04/2013 :<br /><ol>
<li>Mise à jour de liste de diffusion groupement</li>
</ol>Le 09/04/2013 :<br /><ol>
<li>Mise à jour liste de diffusion groupement</li>
</ol>Le 10/04/2013 :<br /><ol>
<li>Activation du compte de LANAILLE Sébastien et demande d\'ouverture de droit</li>
</ol>Le 11/04/2013<br /><ol>
<li>Création de compte pour FLORE PELE</li>
</ol>Le 15/04/2013<br /><ol>
<li>Suivi d\'avancement logistique</li>
<li>Ouverture de droits pour FLORE PELE</li>
<li>Création de deux comptes pour Groupement</li>
<li>Ouverture des droits à F. RABATEL sur OSMOSECSNROP</li>
<li>Accés Minidoc pour MONTROIG Thomas (DM/M S&amp;F)</li>
<li>Accueil de NGOM Amsata, présentation équipe, locaux et utilisation fichier absences</li>
</ol>Le 16/04/2013 :<br /><ol>
<li>Suivi des ouverture de droits</li>
<li>Mis à jour liste de diffusion</li>
<li>Mise à jour du suivi pour ARIANE et autres ouvertures de droits</li>
</ol>le 17/04/2013 :<br /><ol>
<li>Demande ouverture d edroits pour C. Bril</li>
<li>Information réception commande portable. Attente contact samba logistique.</li>
<li>Envois des dossier pour installations des 4 portables, demande pour récupérer les accessoires faites</li>
</ol>Le 18/04/2013<br /><ol>
<li>Suivi logistique</li>
</ol>Le 22/04/2013 :<br /><ol>
<li>Activation du compte de MANDINA-NZEZA Guy-Serge</li>
<li>Initilaisation du mot de passe de MANDINA-NZEZA Guy-Serge</li>
</ol>le 23/04/2013 :<br /><ol>
<li>Suivi logistique suite aux retours de SAMBA</li>
</ol>', '2013-04-23', '2013-04-23') ; 
INSERT INTO `historyactions` VALUES (51, 4, 90, '2013-02-04', '2013-05-30', 416, 'normale', 'en cours', 'Le 23/04/2013 par LEVAVASSEUR Jacques<br>Conception 12 jours<br />Réalisation 40 jours<br /><br />Bascule sur le serveur de production le 28/03/2013, mis à jour le 23/04/2013 avec la build 0041<br /><br />Evolutions en cours :<br />
<ul>
<li>Facturations =&gt; fait</li>
<li>Plan de charge =&gt; fait</li>
<li>Prise en compte des évolutions prévues =&gt; en cours</li>
<li>Mise en place d\'une nouvelle navigation</li>
<li>Rapports (actions, consommation réelles, facturé, plan de charge)</li>
</ul>', '2013-04-23', '2013-04-23') ; 
INSERT INTO `historyactions` VALUES (52, 7, 80, '2013-04-02', '2013-04-25', 64, 'normale', 'en cours', 'Le 24/04/2013 par LEVAVASSEUR Jacques<br>Le 02/04/2013 :<br /><ol>
<li>Arrivée à Lyon de Renaud BORG</li>
<li>Préparation poste de dépannage P64L03BIXXX pour Renaud BORG</li>
<li>Traitemement des demandes de fin de semaine précédente</li>
<li>Demande d\'ouverture de droits pour Renaud BORG et BELHOUT Mabrouk</li>
<li>Deux nouveaux arrivant sur VILLEURBANNE pour ORCHESTRAL.</li>
<li>demande de créations de compte pour deux nouveaux arrivants à SOGETI</li>
<li>Demande de création de dossier personnel pour BORG Renaud</li>
</ol>
<p>Le 03/04/2013 :</p>
<ol>
<li>Demande d\'ajout dans des groupes existant pour LUC et RUIZ</li>
<li>Demande ouverture de droits pour LUC et RUIZ</li>
</ol>Le 04/04/2013 :<br /><ol>
<li>Mise à jour de listes de diffusion pour le groupement</li>
<li>Suivi des ouverture de droits</li>
<li>Demande accès SAMETIME pour S BEYDON</li>
<li>Relance D LECLERC sur mise à jour de la commande de matériel à confirmer en COCOR</li>
</ol>Le 08/04/2013 :<br /><ol>
<li>Mise à jour de liste de diffusion groupement</li>
</ol>Le 09/04/2013 :<br /><ol>
<li>Mise à jour liste de diffusion groupement</li>
</ol>Le 10/04/2013 :<br /><ol>
<li>Activation du compte de LANAILLE Sébastien et demande d\'ouverture de droit</li>
</ol>Le 11/04/2013<br /><ol>
<li>Création de compte pour FLORE PELE</li>
</ol>Le 15/04/2013<br /><ol>
<li>Suivi d\'avancement logistique</li>
<li>Ouverture de droits pour FLORE PELE</li>
<li>Création de deux comptes pour Groupement</li>
<li>Ouverture des droits à F. RABATEL sur OSMOSECSNROP</li>
<li>Accés Minidoc pour MONTROIG Thomas (DM/M S&amp;F)</li>
<li>Accueil de NGOM Amsata, présentation équipe, locaux et utilisation fichier absences</li>
</ol>Le 16/04/2013 :<br /><ol>
<li>Suivi des ouverture de droits</li>
<li>Mis à jour liste de diffusion</li>
<li>Mise à jour du suivi pour ARIANE et autres ouvertures de droits</li>
</ol>le 17/04/2013 :<br /><ol>
<li>Demande ouverture d edroits pour C. Bril</li>
<li>Information réception commande portable. Attente contact samba logistique.</li>
<li>Envois des dossier pour installations des 4 portables, demande pour récupérer les accessoires faites</li>
</ol>Le 18/04/2013<br /><ol>
<li>Suivi logistique</li>
</ol>Le 22/04/2013 :<br /><ol>
<li>Activation du compte de MANDINA-NZEZA Guy-Serge</li>
<li>Initilaisation du mot de passe de MANDINA-NZEZA Guy-Serge</li>
</ol>le 23/04/2013 :<br /><ol>
<li>Suivi logistique suite aux retours de SAMBA</li>
</ol>le 24/04/2013:<br /><ol>
<li>Incident connexion à QC réponse par mail et redirection vers dsit-exil</li>
</ol>', '2013-04-24', '2013-04-24') ; 
INSERT INTO `historyactions` VALUES (53, 14, 0, '2013-04-24', '2013-05-30', 48, 'normale', 'à faire', 'Le 24/04/2013 par LEVAVASSEUR Jacques<br>', '2013-04-24', '2013-04-24') ; 
INSERT INTO `historyactions` VALUES (54, 7, 80, '2013-04-02', '2013-04-25', 64, 'normale', 'en cours', 'Le 24/04/2013 par LEVAVASSEUR Jacques<br>Le 02/04/2013 :<br /><ol>
<li>Arrivée à Lyon de Renaud BORG</li>
<li>Préparation poste de dépannage P64L03BIXXX pour Renaud BORG</li>
<li>Traitemement des demandes de fin de semaine précédente</li>
<li>Demande d\'ouverture de droits pour Renaud BORG et BELHOUT Mabrouk</li>
<li>Deux nouveaux arrivant sur VILLEURBANNE pour ORCHESTRAL.</li>
<li>demande de créations de compte pour deux nouveaux arrivants à SOGETI</li>
<li>Demande de création de dossier personnel pour BORG Renaud</li>
</ol>
<p>Le 03/04/2013 :</p>
<ol>
<li>Demande d\'ajout dans des groupes existant pour LUC et RUIZ</li>
<li>Demande ouverture de droits pour LUC et RUIZ</li>
</ol>Le 04/04/2013 :<br /><ol>
<li>Mise à jour de listes de diffusion pour le groupement</li>
<li>Suivi des ouverture de droits</li>
<li>Demande accès SAMETIME pour S BEYDON</li>
<li>Relance D LECLERC sur mise à jour de la commande de matériel à confirmer en COCOR</li>
</ol>Le 08/04/2013 :<br /><ol>
<li>Mise à jour de liste de diffusion groupement</li>
</ol>Le 09/04/2013 :<br /><ol>
<li>Mise à jour liste de diffusion groupement</li>
</ol>Le 10/04/2013 :<br /><ol>
<li>Activation du compte de LANAILLE Sébastien et demande d\'ouverture de droit</li>
</ol>Le 11/04/2013<br /><ol>
<li>Création de compte pour FLORE PELE</li>
</ol>Le 15/04/2013<br /><ol>
<li>Suivi d\'avancement logistique</li>
<li>Ouverture de droits pour FLORE PELE</li>
<li>Création de deux comptes pour Groupement</li>
<li>Ouverture des droits à F. RABATEL sur OSMOSECSNROP</li>
<li>Accés Minidoc pour MONTROIG Thomas (DM/M S&amp;F)</li>
<li>Accueil de NGOM Amsata, présentation équipe, locaux et utilisation fichier absences</li>
</ol>Le 16/04/2013 :<br /><ol>
<li>Suivi des ouverture de droits</li>
<li>Mis à jour liste de diffusion</li>
<li>Mise à jour du suivi pour ARIANE et autres ouvertures de droits</li>
</ol>le 17/04/2013 :<br /><ol>
<li>Demande ouverture d edroits pour C. Bril</li>
<li>Information réception commande portable. Attente contact samba logistique.</li>
<li>Envois des dossier pour installations des 4 portables, demande pour récupérer les accessoires faites</li>
</ol>Le 18/04/2013<br /><ol>
<li>Suivi logistique</li>
</ol>Le 22/04/2013 :<br /><ol>
<li>Activation du compte de MANDINA-NZEZA Guy-Serge</li>
<li>Initilaisation du mot de passe de MANDINA-NZEZA Guy-Serge</li>
</ol>le 23/04/2013 :<br /><ol>
<li>Suivi logistique suite aux retours de SAMBA</li>
</ol>le 24/04/2013:<br /><ol>
<li>Incident connexion à QC réponse par mail et redirection vers dsit-exil</li>
<li>Droits administrateur sur un poste</li>
</ol>', '2013-04-24', '2013-04-24') ; 
INSERT INTO `historyactions` VALUES (55, 7, 80, '2013-04-02', '2013-04-25', 64, 'normale', 'en cours', 'Le 24/04/2013 par LEVAVASSEUR Jacques<br>Le 02/04/2013 :<br /><ol>
<li>Arrivée à Lyon de Renaud BORG</li>
<li>Préparation poste de dépannage P64L03BIXXX pour Renaud BORG</li>
<li>Traitemement des demandes de fin de semaine précédente</li>
<li>Demande d\'ouverture de droits pour Renaud BORG et BELHOUT Mabrouk</li>
<li>Deux nouveaux arrivant sur VILLEURBANNE pour ORCHESTRAL.</li>
<li>demande de créations de compte pour deux nouveaux arrivants à SOGETI</li>
<li>Demande de création de dossier personnel pour BORG Renaud</li>
</ol>
<p>Le 03/04/2013 :</p>
<ol>
<li>Demande d\'ajout dans des groupes existant pour LUC et RUIZ</li>
<li>Demande ouverture de droits pour LUC et RUIZ</li>
</ol>Le 04/04/2013 :<br /><ol>
<li>Mise à jour de listes de diffusion pour le groupement</li>
<li>Suivi des ouverture de droits</li>
<li>Demande accès SAMETIME pour S BEYDON</li>
<li>Relance D LECLERC sur mise à jour de la commande de matériel à confirmer en COCOR</li>
</ol>Le 08/04/2013 :<br /><ol>
<li>Mise à jour de liste de diffusion groupement</li>
</ol>Le 09/04/2013 :<br /><ol>
<li>Mise à jour liste de diffusion groupement</li>
</ol>Le 10/04/2013 :<br /><ol>
<li>Activation du compte de LANAILLE Sébastien et demande d\'ouverture de droit</li>
</ol>Le 11/04/2013<br /><ol>
<li>Création de compte pour FLORE PELE</li>
</ol>Le 15/04/2013<br /><ol>
<li>Suivi d\'avancement logistique</li>
<li>Ouverture de droits pour FLORE PELE</li>
<li>Création de deux comptes pour Groupement</li>
<li>Ouverture des droits à F. RABATEL sur OSMOSECSNROP</li>
<li>Accés Minidoc pour MONTROIG Thomas (DM/M S&amp;F)</li>
<li>Accueil de NGOM Amsata, présentation équipe, locaux et utilisation fichier absences</li>
</ol>Le 16/04/2013 :<br /><ol>
<li>Suivi des ouverture de droits</li>
<li>Mis à jour liste de diffusion</li>
<li>Mise à jour du suivi pour ARIANE et autres ouvertures de droits</li>
</ol>le 17/04/2013 :<br /><ol>
<li>Demande ouverture d edroits pour C. Bril</li>
<li>Information réception commande portable. Attente contact samba logistique.</li>
<li>Envois des dossier pour installations des 4 portables, demande pour récupérer les accessoires faites</li>
</ol>Le 18/04/2013<br /><ol>
<li>Suivi logistique</li>
</ol>Le 22/04/2013 :<br /><ol>
<li>Activation du compte de MANDINA-NZEZA Guy-Serge</li>
<li>Initilaisation du mot de passe de MANDINA-NZEZA Guy-Serge</li>
</ol>le 23/04/2013 :<br /><ol>
<li>Suivi logistique suite aux retours de SAMBA</li>
</ol>le 24/04/2013:<br /><ol>
<li>Incident connexion à QC réponse par mail et redirection vers dsit-exil</li>
<li>Droits administrateur sur un poste + explications</li>
</ol>', '2013-04-24', '2013-04-24') ; 
INSERT INTO `historyactions` VALUES (56, 7, 100, '2013-04-02', '2013-04-25', 64, 'normale', 'terminée', 'Le 25/04/2013 par LEVAVASSEUR Jacques<br>Le 02/04/2013 :<br /><ol>
<li>Arrivée à Lyon de Renaud BORG</li>
<li>Préparation poste de dépannage P64L03BIXXX pour Renaud BORG</li>
<li>Traitemement des demandes de fin de semaine précédente</li>
<li>Demande d\'ouverture de droits pour Renaud BORG et BELHOUT Mabrouk</li>
<li>Deux nouveaux arrivant sur VILLEURBANNE pour ORCHESTRAL.</li>
<li>demande de créations de compte pour deux nouveaux arrivants à SOGETI</li>
<li>Demande de création de dossier personnel pour BORG Renaud</li>
</ol>
<p>Le 03/04/2013 :</p>
<ol>
<li>Demande d\'ajout dans des groupes existant pour LUC et RUIZ</li>
<li>Demande ouverture de droits pour LUC et RUIZ</li>
</ol>Le 04/04/2013 :<br /><ol>
<li>Mise à jour de listes de diffusion pour le groupement</li>
<li>Suivi des ouverture de droits</li>
<li>Demande accès SAMETIME pour S BEYDON</li>
<li>Relance D LECLERC sur mise à jour de la commande de matériel à confirmer en COCOR</li>
</ol>Le 08/04/2013 :<br /><ol>
<li>Mise à jour de liste de diffusion groupement</li>
</ol>Le 09/04/2013 :<br /><ol>
<li>Mise à jour liste de diffusion groupement</li>
</ol>Le 10/04/2013 :<br /><ol>
<li>Activation du compte de LANAILLE Sébastien et demande d\'ouverture de droit</li>
</ol>Le 11/04/2013<br /><ol>
<li>Création de compte pour FLORE PELE</li>
</ol>Le 15/04/2013<br /><ol>
<li>Suivi d\'avancement logistique</li>
<li>Ouverture de droits pour FLORE PELE</li>
<li>Création de deux comptes pour Groupement</li>
<li>Ouverture des droits à F. RABATEL sur OSMOSECSNROP</li>
<li>Accés Minidoc pour MONTROIG Thomas (DM/M S&amp;F)</li>
<li>Accueil de NGOM Amsata, présentation équipe, locaux et utilisation fichier absences</li>
</ol>Le 16/04/2013 :<br /><ol>
<li>Suivi des ouverture de droits</li>
<li>Mis à jour liste de diffusion</li>
<li>Mise à jour du suivi pour ARIANE et autres ouvertures de droits</li>
</ol>le 17/04/2013 :<br /><ol>
<li>Demande ouverture d edroits pour C. Bril</li>
<li>Information réception commande portable. Attente contact samba logistique.</li>
<li>Envois des dossier pour installations des 4 portables, demande pour récupérer les accessoires faites</li>
</ol>Le 18/04/2013<br /><ol>
<li>Suivi logistique</li>
</ol>Le 22/04/2013 :<br /><ol>
<li>Activation du compte de MANDINA-NZEZA Guy-Serge</li>
<li>Initilaisation du mot de passe de MANDINA-NZEZA Guy-Serge</li>
</ol>le 23/04/2013 :<br /><ol>
<li>Suivi logistique suite aux retours de SAMBA</li>
</ol>le 24/04/2013:<br /><ol>
<li>Incident connexion à QC réponse par mail et redirection vers dsit-exil</li>
<li>Droits administrateur sur un poste + explications</li>
</ol>', '2013-04-25', '2013-04-25') ; 
INSERT INTO `historyactions` VALUES (57, 1, 90, '2013-01-07', '2013-06-06', 96, 'normale', 'en cours', 'Le 25/04/2013 par LEVAVASSEUR Jacques<br>Janvier :<br />
<ul>
<li>Incorporation de l\'activité</li>
</ul>
<p>Février :</p>
<ul>
<li>Incorporation de l\'activité</li>
<li>Consolidation consommé et insertion</li>
<li>Envois pour validation</li>
</ul>
<p>Mars :</p>
<ul>
<li>Incorporation du budget contratcualisé</li>
<li>Consolidation du consommé (02/04/2013 pas de retour pour charge de LMN et E7)</li>
<li>Incorporation de l\'activité réalisée en mars dans le CRA</li>
<li>Envoyé pour validation à AAE et JBJ</li>
<li><span style="color: #ff0000;">Correction sur l\'emplacement des coûts DSIT-X mis en MCO explication sur montant de 2805k€ (2309k€ + 455 k€), changement année pour prestation formation</span></li>
<li>Attente de la prise de décision concernant le budget - CRA non validé</li>
</ul>
<p>Avril :</p>
<ul>
<li>Non consolidé pour le CRA en attente du budget</li>
</ul>
<p>Mai :</p>
<ul>
<li>A faire au retour des vacances.</li>
</ul>
<p></p>', '2013-04-25', '2013-04-25') ; 
INSERT INTO `historyactions` VALUES (58, 1, 70, '2013-01-07', '2013-06-06', 192, 'normale', 'en cours', 'Le 25/04/2013 par LEVAVASSEUR Jacques<br>Janvier :<br />
<ul>
<li>Incorporation de l\'activité</li>
</ul>
<p>Février :</p>
<ul>
<li>Incorporation de l\'activité</li>
<li>Consolidation consommé et insertion</li>
<li>Envois pour validation</li>
</ul>
<p>Mars :</p>
<ul>
<li>Incorporation du budget contratcualisé</li>
<li>Consolidation du consommé (02/04/2013 pas de retour pour charge de LMN et E7)</li>
<li>Incorporation de l\'activité réalisée en mars dans le CRA</li>
<li>Envoyé pour validation à AAE et JBJ</li>
<li><span style="color: #ff0000;">Correction sur l\'emplacement des coûts DSIT-X mis en MCO explication sur montant de 2805k€ (2309k€ + 455 k€), changement année pour prestation formation</span></li>
<li>Attente de la prise de décision concernant le budget - CRA non validé</li>
</ul>
<p>Avril :</p>
<ul>
<li>Non consolidé pour le CRA en attente du budget</li>
</ul>
<p>Mai :</p>
<ul>
<li>A faire au retour des vacances.</li>
</ul>
<p> </p>', '2013-04-25', '2013-04-25') ; 
INSERT INTO `historyactions` VALUES (59, 9, 10, '2013-04-24', '2013-05-14', 2, 'normale', 'en cours', 'Le 25/04/2013 par LEVAVASSEUR Jacques<br>Présentation de l\'outil à AAE et JBJ pour validation avant mise en service à un périmétre réduit de l\'équipe.<br />Périmétre à définir lors de cette présentation.<br />Je pense à : <br />
<ul>
<li>Sabine GEOFFROY</li>
<li>Magali BURIAND</li>
<li>Benoit TRENTO</li>
<li>Jacques LEVAVASSEUR</li>
<li>Patricia RIFFIOD</li>
</ul>
Ne faut-il pas qu\'ils assistent à la présentation ? <br />Echéance repoussée à mi mai<br />Rendez-vous envoyé', '2013-04-25', '2013-04-25') ; 
INSERT INTO `historyactions` VALUES (60, 16, 0, '2013-05-13', '2013-05-30', 48, 'normale', 'à faire', 'Le 13/05/2013 par LEVAVASSEUR Jacques<br>', '2013-05-13', '2013-05-13') ; 
INSERT INTO `historyactions` VALUES (61, 15, 50, '2013-05-13', '2013-05-18', 2, 'haute', 'en cours', 'Le 13/05/2013 par LEVAVASSEUR Jacques<br><a href="../../utilisateurs/edit/276">Lien vers le nouvel utilisateur<br /></a>Reste les demandes d\'ouverture de droits à faire<a href="../../utilisateurs/edit/276"><br /></a>', '2013-05-13', '2013-05-13') ; 
INSERT INTO `historyactions` VALUES (62, 15, 100, '2013-05-13', '2013-05-18', 2, 'haute', 'terminée', 'Le 13/05/2013 par LEVAVASSEUR Jacques<br><a href="../../utilisateurs/edit/276">Lien vers le nouvel utilisateur<br /></a>Reste les demandes d\'ouverture de droits à faire<a href="../../utilisateurs/edit/276"><br /></a>', '2013-05-13', '2013-05-13') ; 
INSERT INTO `historyactions` VALUES (63, 23, 100, '2013-05-13', '2013-05-18', 2, 'haute', 'terminée', 'Le 13/05/2013 par LEVAVASSEUR Jacques<br><a href="../../utiliseoutils/edit/110">Lien vers la nouvelle demande d\'ouverture de droit</a>', '2013-05-13', '2013-05-13') ; 
INSERT INTO `historyactions` VALUES (64, 22, 100, '2013-05-13', '2013-05-18', 2, 'haute', 'terminée', 'Le 13/05/2013 par LEVAVASSEUR Jacques<br><a href="../../utiliseoutils/edit/109">Lien vers la nouvelle demande d\'ouverture de droit</a>', '2013-05-13', '2013-05-13') ; 
INSERT INTO `historyactions` VALUES (65, 21, 100, '2013-05-13', '2013-05-18', 2, 'haute', 'terminée', 'Le 13/05/2013 par LEVAVASSEUR Jacques<br><a href="../../utiliseoutils/edit/108">Lien vers la nouvelle demande d\'ouverture de droit</a>', '2013-05-13', '2013-05-13') ; 
INSERT INTO `historyactions` VALUES (66, 20, 100, '2013-05-13', '2013-05-18', 2, 'haute', 'terminée', 'Le 13/05/2013 par LEVAVASSEUR Jacques<br><a href="../../utiliseoutils/edit/107">Lien vers la nouvelle demande d\'ouverture de droit</a>', '2013-05-13', '2013-05-13') ; 
INSERT INTO `historyactions` VALUES (67, 19, 100, '2013-05-13', '2013-05-18', 2, 'haute', 'terminée', 'Le 13/05/2013 par LEVAVASSEUR Jacques<br><a href="../../utiliseoutils/edit/106">Lien vers la nouvelle demande d\'ouverture de droit</a>', '2013-05-13', '2013-05-13') ; 
INSERT INTO `historyactions` VALUES (68, 18, 100, '2013-05-13', '2013-05-18', 2, 'haute', 'terminée', 'Le 13/05/2013 par LEVAVASSEUR Jacques<br><a href="../../utiliseoutils/edit/105">Lien vers la nouvelle demande d\'ouverture de droit</a>', '2013-05-13', '2013-05-13') ; 
INSERT INTO `historyactions` VALUES (69, 17, 0, '2013-05-13', '2013-05-18', 2, 'haute', 'en cours', 'Le 13/05/2013 par LEVAVASSEUR Jacques<br><a href="../../utiliseoutils/edit/104">Lien vers la nouvelle demande d\'ouverture de droit<br /></a>En attente de précision sur la liste de diffusion<a href="../../utiliseoutils/edit/104"><br /></a>', '2013-05-13', '2013-05-13') ; 
INSERT INTO `historyactions` VALUES (70, 14, 0, '2013-04-24', '2013-05-30', 48, 'normale', 'à faire', 'Le 13/05/2013 par LEVAVASSEUR Jacques<br>le 13/05/2013:<br />
<ul>
<li>mise à jour de SAILL pour la création du compte de AGUILAR</li>
<li>Demande ouverture de droit</li>
</ul>', '2013-05-13', '2013-05-13') ; 
INSERT INTO `historyactions` VALUES (71, 14, 10, '2013-04-24', '2013-05-30', 48, 'normale', 'en cours', 'Le 13/05/2013 par LEVAVASSEUR Jacques<br>le 13/05/2013:<br />
<ul>
<li>mise à jour de SAILL pour la création du compte de AGUILAR</li>
<li>Demande ouverture de droit</li>
</ul>', '2013-05-13', '2013-05-13') ; 
INSERT INTO `historyactions` VALUES (72, 4, 100, '2013-02-04', '2013-05-30', 416, 'normale', 'terminée', 'Le 13/05/2013 par LEVAVASSEUR Jacques<br>Conception 12 jours<br />Réalisation 40 jours<br /><br />Bascule sur le serveur de production le 28/03/2013, mis à jour le 23/04/2013 avec la build 0041<br /><br />Evolutions en cours :<br />
<ul>
<li>Facturations =&gt; fait</li>
<li>Plan de charge =&gt; fait</li>
<li>Prise en compte des évolutions prévues =&gt; en cours</li>
<li>Mise en place d\'une nouvelle navigation</li>
<li>Rapports (actions, consommation réelles, facturé, plan de charge)</li>
</ul>', '2013-05-13', '2013-05-13') ; 
INSERT INTO `historyactions` VALUES (73, 24, 0, '2013-05-13', '2013-08-29', 192, 'normale', 'en cours', 'Le 13/05/2013 par LEVAVASSEUR Jacques<br><div class="edit-comment-hide">
<div class="js-comment-body comment-body markdown-body markdown-format">
<ul>
<li>Gestions des fichiers des dossiers admin, all avec add, delete</li>
<li>Ajout d\'un lien pour la référence MINIDOC</li>
<li>Paramètrage du site (mot de passe admin, Url outil MINDOC, Email contact admin du site, sauvegarde et restauration BDD, ...)</li>
<li>Template d\'email avec envois si demandé (choix laissé à l\'utilisateur ou action de notification, envois automatique sur certaines actions)</li>
<li>sur la page d\'accueil mes statistiques : <strong>Fait</strong>
<ul>
<li>nombre d\'action à faire, en cours, proche échéance</li>
<li>Saisie d\'activité</li>
<li>Mes livrables à venir</li>
<li>etc.</li>
</ul>
</li>
<li>Créer une action automatiquement lors de la création d\'un livrable avec le livrable associé rediriger vers cette action pour la compléter</li>
<li>Sur la création d\'action en automatique des ouvertures de droits ajouter le sujet de la demande dans l\'objet</li>
</ul>
</div>
</div>', '2013-05-13', '2013-05-13') ; 
INSERT INTO `historyactions` VALUES (74, 25, 0, '2013-05-13', '2013-06-27', 0, 'moyenne', 'en cours', 'Le 13/05/2013 par LEVAVASSEUR Jacques<br>En attente des retours utilisateurs demande traités au fur et à mesure', '2013-05-13', '2013-05-13') ; 
INSERT INTO `historyactions` VALUES (75, 17, 0, '2013-05-13', '2013-05-18', 2, 'haute', 'en cours', 'Le 13/05/2013 par LEVAVASSEUR Jacques<br><a href="../../utiliseoutils/edit/104">Lien vers la nouvelle demande d\'ouverture de droit<br /></a>En attente de précision sur la liste de diffusion<a href="../../utiliseoutils/edit/104"><br /></a>
<p>Concernant M. Aguilar Gustavo, il faudrait l\'ajouter à la liste de diffusion *OSMOSE Intégrateur GMAO FONC</p>', '2013-05-13', '2013-05-13') ; 
INSERT INTO `historyactions` VALUES (76, 17, 100, '2013-05-13', '2013-05-18', 2, 'haute', 'terminée', 'Le 13/05/2013 par LEVAVASSEUR Jacques<br><a href="../../utiliseoutils/edit/104">Lien vers la nouvelle demande d\'ouverture de droit<br /></a>En attente de précision sur la liste de diffusion<a href="../../utiliseoutils/edit/104"><br /></a>
<p>Concernant M. Aguilar Gustavo, il faudrait l\'ajouter à la liste de diffusion *OSMOSE Intégrateur GMAO FONC</p>', '2013-05-13', '2013-05-13') ; 
INSERT INTO `historyactions` VALUES (77, 26, 100, '2013-05-13', '2013-05-18', 2, 'haute', 'terminée', 'Le 13/05/2013 par LEVAVASSEUR Jacques<br><a href="../../utilisateurs/edit/277">Lien vers le nouvel utilisateur</a>', '2013-05-13', '2013-05-13') ; 
INSERT INTO `historyactions` VALUES (78, 27, 100, '2013-05-13', '2013-05-18', 2, 'haute', 'terminée', 'Le 13/05/2013 par LEVAVASSEUR Jacques<br><a href="../../utiliseoutils/edit/111">Lien vers la nouvelle demande d\'ouverture de droit</a>', '2013-05-13', '2013-05-13') ; 
INSERT INTO `historyactions` VALUES (79, 28, 100, '2013-05-13', '2013-05-18', 2, 'haute', 'terminée', 'Le 13/05/2013 par LEVAVASSEUR Jacques<br><a href="../../utiliseoutils/edit/112">Lien vers la nouvelle demande d\'ouverture de droit</a>', '2013-05-13', '2013-05-13') ; 
INSERT INTO `historyactions` VALUES (80, 29, 100, '2013-05-13', '2013-05-18', 2, 'haute', 'terminée', 'Le 13/05/2013 par LEVAVASSEUR Jacques<br><a href="../../utiliseoutils/edit/113">Lien vers la nouvelle demande d\'ouverture de droit</a>', '2013-05-13', '2013-05-13') ; 
INSERT INTO `historyactions` VALUES (81, 30, 100, '2013-05-13', '2013-05-18', 2, 'haute', 'terminée', 'Le 13/05/2013 par LEVAVASSEUR Jacques<br><a href="../../utiliseoutils/edit/114">Lien vers la nouvelle demande d\'ouverture de droit</a>', '2013-05-13', '2013-05-13') ; 
INSERT INTO `historyactions` VALUES (82, 31, 100, '2013-05-13', '2013-05-18', 2, 'haute', 'terminée', 'Le 13/05/2013 par LEVAVASSEUR Jacques<br><a href="../../utiliseoutils/edit/115">Lien vers la nouvelle demande d\'ouverture de droit</a>', '2013-05-13', '2013-05-13') ; 
INSERT INTO `historyactions` VALUES (83, 32, 100, '2013-05-13', '2013-05-18', 2, 'haute', 'terminée', 'Le 13/05/2013 par LEVAVASSEUR Jacques<br><a href="../../utiliseoutils/edit/116">Lien vers la nouvelle demande d\'ouverture de droit</a>', '2013-05-13', '2013-05-13') ; 
INSERT INTO `historyactions` VALUES (84, 14, 20, '2013-04-24', '2013-05-30', 48, 'normale', 'en cours', 'Le 13/05/2013 par LEVAVASSEUR Jacques<br>le 13/05/2013:<br />
<ul>
<li>mise à jour de SAILL pour la création du compte de AGUILAR</li>
<li>Demande ouverture de droits</li>
<li>Activation du compte de LEBLANC Bastien</li>
<li>Demande ouverture de droits</li>
<li>Demande information budget SGRM</li>
</ul>', '2013-05-13', '2013-05-13') ; 
INSERT INTO `historyactions` VALUES (85, 24, 0, '2013-05-13', '2013-08-29', 192, 'normale', 'en cours', 'Le 13/05/2013 par LEVAVASSEUR Jacques<br><div class="edit-comment-hide">
<div class="js-comment-body comment-body markdown-body markdown-format">
<ul>
<li>Gestions des fichiers des dossiers admin, all avec add, delete</li>
<li>Ajout d\'un lien pour la référence MINIDOC</li>
<li>Paramètrage du site (mot de passe admin, Url outil MINDOC, Email contact admin du site, sauvegarde et restauration BDD, ...)</li>
<li>Template d\'email avec envois si demandé (choix laissé à l\'utilisateur ou action de notification, envois automatique sur certaines actions)</li>
<li>sur la page d\'accueil mes statistiques : <strong>Fait</strong>
<ul>
<li>nombre d\'action à faire, en cours, proche échéance</li>
<li>Saisie d\'activité</li>
<li>Mes livrables à venir</li>
<li>etc.</li>
</ul>
</li>
<li>Créer une action automatiquement lors de la création d\'un livrable avec le livrable associé rediriger vers cette action pour la compléter</li>
<li>Sur la création d\'action en automatique des ouvertures de droits ajouter le sujet de la demande dans l\'objet</li>
<li>Mise à jour de l\'état des action en cliquant sur l\'état, avancement à partir de la liste</li>
</ul>
</div>
</div>', '2013-05-13', '2013-05-13') ; 
INSERT INTO `historyactions` VALUES (86, 9, 70, '2013-04-24', '2013-05-14', 2, 'normale', 'en cours', 'Le 13/05/2013 par LEVAVASSEUR Jacques<br>Présentation de l\'outil à AAE et JBJ pour validation avant mise en service à un périmétre réduit de l\'équipe.<br />Périmétre à définir lors de cette présentation.<br />Je pense à : <br />
<ul>
<li>Sabine GEOFFROY</li>
<li>Magali BURIAND</li>
<li>Benoit TRENTO</li>
<li>Jacques LEVAVASSEUR</li>
<li>Patricia RIFFIOD</li>
</ul>
Ne faut-il pas qu\'ils assistent à la présentation ? <br />Echéance repoussée à mi mai<br />Rendez-vous envoyé<br />Préparation de la base et de l\'outil dans sa dernière version.<br />Présentation faite au format PPT', '2013-05-13', '2013-05-13') ; 
INSERT INTO `historyactions` VALUES (87, 24, 0, '2013-05-13', '2013-08-29', 192, 'normale', 'en cours', 'Le 13/05/2013 par LEVAVASSEUR Jacques<br><div class="edit-comment-hide">
<div class="js-comment-body comment-body markdown-body markdown-format">
<ul>
<li>Gestions des fichiers des dossiers admin, all avec add, delete</li>
<li>Ajout d\'un lien pour la référence MINIDOC <em><strong>En cours</strong></em></li>
<li>Paramètrage du site (mot de passe admin, Url outil MINDOC, Email contact admin du site, sauvegarde et restauration BDD, ...) <em><strong>En cours</strong></em></li>
<li>Template d\'email avec envois si demandé (choix laissé à l\'utilisateur ou action de notification, envois automatique sur certaines actions)</li>
<li>sur la page d\'accueil mes statistiques : <strong>Fait</strong>
<ul>
<li>nombre d\'action à faire, en cours, proche échéance</li>
<li>Saisie d\'activité</li>
<li>Mes livrables à venir</li>
<li>etc.</li>
</ul>
</li>
<li>Créer une action automatiquement lors de la création d\'un livrable avec le livrable associé rediriger vers cette action pour la compléter</li>
<li>Sur la création d\'action en automatique des ouvertures de droits ajouter le sujet de la demande dans l\'objet</li>
<li>Mise à jour de l\'état des action en cliquant sur l\'état, avancement à partir de la liste</li>
</ul>
</div>
</div>', '2013-05-13', '2013-05-13') ; 
INSERT INTO `historyactions` VALUES (88, 24, 0, '2013-05-13', '2013-08-29', 192, 'normale', 'en cours', 'Le 13/05/2013 par LEVAVASSEUR Jacques<br><div class="edit-comment-hide">
<div class="js-comment-body comment-body markdown-body markdown-format">
<ul>
<li>Gestions des fichiers des dossiers admin, all avec add, delete</li>
<li>Ajout d\'un lien pour la référence MINIDOC <em><strong>En cours</strong></em></li>
<li>Paramètrage du site (mot de passe admin, Url outil MINDOC, Email contact admin du site, sauvegarde et restauration BDD, ...) <em><strong>En cours</strong></em></li>
<li>Template d\'email avec envois si demandé (choix laissé à l\'utilisateur ou action de notification, envois automatique sur certaines actions)</li>
<li>sur la page d\'accueil mes statistiques : <strong>Fait</strong>
<ul>
<li>nombre d\'action à faire, en cours, proche échéance</li>
<li>Saisie d\'activité</li>
<li>Mes livrables à venir</li>
<li>etc.</li>
</ul>
</li>
<li>Créer une action automatiquement lors de la création d\'un livrable avec le livrable associé rediriger vers cette action pour la compléter</li>
<li>Sur la création d\'action en automatique des ouvertures de droits ajouter le sujet de la demande dans l\'objet</li>
<li>Mise à jour de l\'état des action en cliquant sur l\'état, avancement à partir de la liste</li>
<li>Importation des fichier ics</li>
</ul>
</div>
</div>', '2013-05-13', '2013-05-13') ; 
INSERT INTO `historyactions` VALUES (89, 24, 10, '2013-05-13', '2013-08-29', 192, 'normale', 'en cours', 'Le 13/05/2013 par LEVAVASSEUR Jacques<br><div class="edit-comment-hide">
<div class="js-comment-body comment-body markdown-body markdown-format">
<ul>
<li>Gestions des fichiers des dossiers admin, all avec add, delete</li>
<li>Ajout d\'un lien pour la référence MINIDOC <em><strong>En cours</strong></em></li>
<li>Paramètrage du site (mot de passe admin, Url outil MINDOC, Email contact admin du site, sauvegarde et restauration BDD, ...) <em><strong>En cours</strong></em></li>
<li>Template d\'email avec envois si demandé (choix laissé à l\'utilisateur ou action de notification, envois automatique sur certaines actions)</li>
<li>sur la page d\'accueil mes statistiques : <strong>Fait</strong>
<ul>
<li>nombre d\'action à faire, en cours, proche échéance</li>
<li>Saisie d\'activité</li>
<li>Mes livrables à venir</li>
<li>etc.</li>
</ul>
</li>
<li>Créer une action automatiquement lors de la création d\'un livrable avec le livrable associé rediriger vers cette action pour la compléter</li>
<li>Sur la création d\'action en automatique des ouvertures de droits ajouter le sujet de la demande dans l\'objet</li>
<li>Mise à jour de l\'état des action en cliquant sur l\'état, avancement à partir de la liste</li>
<li>Importation des fichier ics</li>
<li>validation ou avertissement d\'un valideur d\'indisponibilité (spécifique aux prestataires, concerne un petite population)</li>
</ul>
</div>
</div>', '2013-05-13', '2013-05-13') ; 
INSERT INTO `historyactions` VALUES (90, 25, 0, '2013-05-13', '2013-06-27', 0, 'haute', 'en cours', 'Le 13/05/2013 par LEVAVASSEUR Jacques<br>En attente des retours utilisateurs demande traités au fur et à mesure', '2013-05-13', '2013-05-13') ; 
INSERT INTO `historyactions` VALUES (91, 33, 0, '2013-05-13', '2013-06-27', 0, 'moyenne', 'en cours', 'Le 13/05/2013 par LEVAVASSEUR Jacques<br>', '2013-05-13', '2013-05-13') ; 
INSERT INTO `historyactions` VALUES (92, 16, 0, '2013-06-01', '2013-06-27', 48, 'normale', 'à faire', 'Le 13/05/2013 par LEVAVASSEUR Jacques<br>', '2013-05-13', '2013-05-13') ; 
INSERT INTO `historyactions` VALUES (93, 1, 70, '2013-01-07', '2013-06-06', 192, 'normale', 'en cours', 'Le 13/05/2013 par LEVAVASSEUR Jacques<br>Janvier :<br />
<ul>
<li>Incorporation de l\'activité</li>
</ul>
<p>Février :</p>
<ul>
<li>Incorporation de l\'activité</li>
<li>Consolidation consommé et insertion</li>
<li>Envois pour validation</li>
</ul>
<p>Mars :</p>
<ul>
<li>Incorporation du budget contratcualisé</li>
<li>Consolidation du consommé (02/04/2013 pas de retour pour charge de LMN et E7)</li>
<li>Incorporation de l\'activité réalisée en mars dans le CRA</li>
<li>Envoyé pour validation à AAE et JBJ</li>
<li><span style="color: #ff0000;">Correction sur l\'emplacement des coûts DSIT-X mis en MCO explication sur montant de 2805k€ (2309k€ + 455 k€), changement année pour prestation formation</span></li>
<li>Attente de la prise de décision concernant le budget - CRA non validé</li>
</ul>
<p>Avril :</p>
<ul>
<li>Non consolidé pour le CRA en attente du budget</li>
</ul>
<p>Mai :</p>
<ul>
<li>A faire au retour des vacances.</li>
<li>Consolider l\'activité d\'avril et mettre en place dans le CRA, idem activités.</li>
</ul>
<p> </p>', '2013-05-13', '2013-05-13') ; 
INSERT INTO `historyactions` VALUES (94, 24, 10, '2013-05-13', '2013-08-29', 192, 'normale', 'en cours', 'Le 14/05/2013 par LEVAVASSEUR Jacques<br><div class="edit-comment-hide">
<div class="js-comment-body comment-body markdown-body markdown-format">
<ul>
<li>Gestions des fichiers des dossiers admin, all avec add, delete</li>
<li>Ajout d\'un lien pour la référence MINIDOC <em><strong>En cours</strong></em></li>
<li>Paramètrage du site (mot de passe admin, Url outil MINDOC, Email contact admin du site, sauvegarde et restauration BDD, ...) <em><strong>En cours</strong></em></li>
<li>Template d\'email avec envois si demandé (choix laissé à l\'utilisateur ou action de notification, envois automatique sur certaines actions)</li>
<li>sur la page d\'accueil mes statistiques : <strong>Fait</strong>
<ul>
<li>nombre d\'action à faire, en cours, proche échéance</li>
<li>Saisie d\'activité</li>
<li>Mes livrables à venir</li>
<li>etc.</li>
</ul>
</li>
<li>Créer une action automatiquement lors de la création d\'un livrable avec le livrable associé rediriger vers cette action pour la compléter</li>
<li>Sur la création d\'action en automatique des ouvertures de droits ajouter le sujet de la demande dans l\'objet</li>
<li>Mise à jour de l\'état des action en cliquant sur l\'état, avancement à partir de la liste</li>
<li>Importation des fichier ics</li>
<li>validation ou avertissement d\'un valideur d\'indisponibilité (spécifique aux prestataires, concerne un petite population)</li>
<li>
<div>Rapport plan de charge calculer le cout à partir du TJM agent attribué à chaque agent, calculer le TJM moyen.</div>
</li>
</ul>
</div>
</div>', '2013-05-14', '2013-05-14') ; 
INSERT INTO `historyactions` VALUES (95, 34, 100, '2013-05-14', '2013-05-19', 2, 'haute', 'terminée', 'Le 14/05/2013 par LEVAVASSEUR Jacques<br><a href="../../utiliseoutils/edit/117">Lien vers la nouvelle demande d\'ouverture de droit</a>', '2013-05-14', '2013-05-14') ; 
INSERT INTO `historyactions` VALUES (96, 14, 30, '2013-04-24', '2013-05-30', 48, 'normale', 'en cours', 'Le 14/05/2013 par LEVAVASSEUR Jacques<br>le 13/05/2013:<br />
<ul>
<li>mise à jour de SAILL pour la création du compte de AGUILAR</li>
<li>Demande ouverture de droits</li>
<li>Activation du compte de LEBLANC Bastien</li>
<li>Demande ouverture de droits</li>
<li>Demande information budget SGRM</li>
</ul>
<br />le 14/05/2013<br />
<ul>
<li>mise à jour avancement ouverture de droit</li>
<li>demande droit admin sur poste P71</li>
<li>changement liste diffusion pour LEBLANC</li>
</ul>', '2013-05-14', '2013-05-14') ; 
INSERT INTO `historyactions` VALUES (97, 14, 30, '2013-04-24', '2013-05-30', 48, 'normale', 'en cours', 'Le 14/05/2013 par LEVAVASSEUR Jacques<br>le 13/05/2013:<br />
<ul>
<li>mise à jour de SAILL pour la création du compte de AGUILAR</li>
<li>Demande ouverture de droits</li>
<li>Activation du compte de LEBLANC Bastien</li>
<li>Demande ouverture de droits</li>
<li>Demande information budget SGRM</li>
</ul>
<br />le 14/05/2013<br />
<ul>
<li>mise à jour avancement ouverture de droit</li>
<li>demande droit admin sur poste P71</li>
<li>changement liste diffusion pour LEBLANC</li>
</ul>', '2013-05-14', '2013-05-14') ; 
INSERT INTO `historyactions` VALUES (98, 9, 70, '2013-04-24', '2013-05-14', 2, 'normale', 'en cours', 'Le 14/05/2013 par LEVAVASSEUR Jacques<br>Présentation de l\'outil à AAE et JBJ pour validation avant mise en service à un périmétre réduit de l\'équipe.<br />Périmétre à définir lors de cette présentation.<br />Je pense à : <br />
<ul>
<li>Sabine GEOFFROY</li>
<li>Magali BURIAND</li>
<li>Benoit TRENTO</li>
<li>Jacques LEVAVASSEUR</li>
<li>Patricia RIFFIOD</li>
</ul>
Ne faut-il pas qu\'ils assistent à la présentation ? <br />Echéance repoussée à mi mai<br />Rendez-vous envoyé<br />Préparation de la base et de l\'outil dans sa dernière version.<br />Présentation faite au format PPT', '2013-05-14', '2013-05-14') ; 
INSERT INTO `historyactions` VALUES (99, 35, 100, '2013-05-14', '2013-05-19', 2, 'haute', 'terminée', 'Le 14/05/2013 par LEVAVASSEUR Jacques<br><a href="../../utiliseoutils/edit/118">Lien vers la nouvelle demande d\'ouverture de droit</a>', '2013-05-14', '2013-05-14') ; 
INSERT INTO `historyactions` VALUES (100, 36, 50, '2013-05-13', '2013-05-31', 64, 'haute', 'en cours', 'Le 14/05/2013 par THIAULT Hugues<br>Mise à jour du DAT', '2013-05-14', '2013-05-14') ; 
INSERT INTO `historyactions` VALUES (101, 37, 50, '2013-05-13', '2013-05-31', 64, 'haute', 'en cours', 'Le 14/05/2013 par THIAULT Hugues<br>Mise à jour du DAT', '2013-05-14', '2013-05-14') ; 
INSERT INTO `historyactions` VALUES (102, 38, 0, '2013-05-15', '2013-05-23', 0, 'normale', 'à faire', 'Le 14/05/2013 par TRENTO Benoit<br>', '2013-05-14', '2013-05-14') ; 
INSERT INTO `historyactions` VALUES (103, 36, 50, '2013-05-13', '2013-05-31', 8, 'haute', 'en cours', 'Le 14/05/2013 par THIAULT Hugues<br>Mise à jour du DAT', '2013-05-14', '2013-05-14') ; 
INSERT INTO `historyactions` VALUES (104, 36, 50, '2013-05-13', '2013-05-31', 64, 'haute', 'en cours', 'Le 14/05/2013 par THIAULT Hugues<br>Mise à jour du DAT', '2013-05-14', '2013-05-14') ; 
INSERT INTO `historyactions` VALUES (105, 39, 0, '2013-05-14', '2013-05-31', 0, 'normale', 'à faire', 'Le 14/05/2013 par THIAULT Hugues<br>Ajouter un rapport : activité réelle par domaine, pour chaque agent (idem facturation)', '2013-05-14', '2013-05-14') ; 
INSERT INTO `historyactions` VALUES (106, 39, 0, '2013-05-14', '2013-05-31', 0, 'normale', 'à faire', 'Le 14/05/2013 par LEVAVASSEUR Jacques<br>Ajouter un rapport : activité réelle par domaine, pour chaque agent (idem facturation)<br />Actions : mettre la durée en jour', '2013-05-14', '2013-05-14') ; 
INSERT INTO `historyactions` VALUES (107, 9, 100, '2013-04-24', '2005-06-04', 2, 'normale', 'terminée', 'Le 15/05/2013 par LEVAVASSEUR Jacques<br>Présentation de l\'outil à AAE et JBJ pour validation avant mise en service à un périmétre réduit de l\'équipe.<br />Périmétre à définir lors de cette présentation.<br />Je pense à : <br />
<ul>
<li>Sabine GEOFFROY</li>
<li>Magali BURIAND</li>
<li>Benoit TRENTO</li>
<li>Jacques LEVAVASSEUR</li>
<li>Patricia RIFFIOD</li>
</ul>
Ne faut-il pas qu\'ils assistent à la présentation ? <br />Echéance repoussée à mi mai<br />Rendez-vous envoyé<br />Préparation de la base et de l\'outil dans sa dernière version.<br />Présentation faite au format PPT', '2013-05-15', '2013-05-15') ; 
INSERT INTO `historyactions` VALUES (108, 39, 10, '2013-05-14', '2013-05-31', 0, 'normale', 'en cours', 'Le 15/05/2013 par LEVAVASSEUR Jacques<br>Ajouter un rapport : activité réelle par domaine, pour chaque agent (idem facturation)<br />Actions : mettre la durée en jour', '2013-05-15', '2013-05-15') ; 
INSERT INTO `historyactions` VALUES (109, 39, 100, '2013-05-14', '2005-06-04', 0, 'normale', 'terminée', 'Le 15/05/2013 par LEVAVASSEUR Jacques<br>Ajouter un rapport : activité réelle par domaine, pour chaque agent (idem facturation)<br />Actions : mettre la durée en jour', '2013-05-15', '2013-05-15') ; 
INSERT INTO `historyactions` VALUES (110, 40, 0, '2013-05-15', '2013-05-30', 0, 'moyenne', 'à faire', 'Le 15/05/2013 par LEVAVASSEUR Jacques<br>Ajouter le domaine dans la feuille de temps<br />Dans la rapport faire une répartition de l\'activité par Projet et domaine', '2013-05-15', '2013-05-15') ; 
INSERT INTO `historyactions` VALUES (111, 41, 0, '2013-05-15', '2013-05-30', 0, 'moyenne', 'à faire', 'Le 15/05/2013 par LEVAVASSEUR Jacques<br>Ajouter le domaine dans la feuille de temps<br />Dans la rapport faire une répartition de l\'activité par Projet et domaine', '2013-05-15', '2013-05-15') ; 
INSERT INTO `historyactions` VALUES (112, 41, 10, '2013-05-15', '2013-05-30', 0, 'moyenne', 'en cours', 'Le 15/05/2013 par LEVAVASSEUR Jacques<br>Ajouter le domaine dans la feuille de temps<br />Dans la rapport faire une répartition de l\'activité par Projet et domaine', '2013-05-15', '2013-05-15') ; 
INSERT INTO `historyactions` VALUES (113, 41, 10, '2013-05-15', '2013-05-30', 0, 'moyenne', 'en cours', 'Le 15/05/2013 par LEVAVASSEUR Jacques<br>Ajouter le domaine dans la feuille de temps<br />Dans la rapport faire une répartition de l\'activité par Projet et domaine', '2013-05-15', '2013-05-15') ; 
INSERT INTO `historyactions` VALUES (114, 41, 100, '2013-05-15', '2005-06-04', 2, 'moyenne', 'terminée', 'Le 15/05/2013 par LEVAVASSEUR Jacques<br>Ajouter le domaine dans la feuille de temps<br />Dans la rapport faire une répartition de l\'activité par Projet et domaine', '2013-05-15', '2013-05-15') ; 
INSERT INTO `historyactions` VALUES (115, 33, 0, '2013-05-13', '2013-06-27', 0, 'moyenne', 'en cours', 'Le 15/05/2013 par LEVAVASSEUR Jacques<br>', '2013-05-15', '2013-05-15') ; 
INSERT INTO `historyactions` VALUES (116, 33, 0, '2013-05-13', '2013-06-27', 2, 'moyenne', 'en cours', 'Le 15/05/2013 par LEVAVASSEUR Jacques<br><ul>
<li>Erreur de paramétrgae pour le profil Responsable équipe, ajouter autoupdate pour valider les feuille de temps</li>
</ul>', '2013-05-15', '2013-05-15') ; 
INSERT INTO `historyactions` VALUES (117, 33, 0, '2013-05-13', '2013-06-27', 2, 'moyenne', 'en cours', 'Le 15/05/2013 par LEVAVASSEUR Jacques<br><ul>
<li>Erreur de paramétrgae pour le profil Responsable équipe, ajouter autoupdate pour valider les feuille de temps</li>
</ul>', '2013-05-15', '2013-05-15') ; 
INSERT INTO `historyactions` VALUES (118, 16, 0, '2013-06-01', '2013-06-27', 48, 'normale', 'à faire', 'Le 15/05/2013 par LEVAVASSEUR Jacques<br>', '2013-05-15', '2013-05-15') ; 
INSERT INTO `historyactions` VALUES (119, 16, -10, '2013-06-01', '2013-06-27', 48, 'normale', 'à faire', 'Le 15/05/2013 par LEVAVASSEUR Jacques<br>', '2013-05-15', '2013-05-15') ; 
INSERT INTO `historyactions` VALUES (120, 36, 50, '2013-05-13', '2013-05-31', 64, 'haute', 'en cours', 'Le 15/05/2013 par THIAULT Hugues<br>Mise à jour du DAT', '2013-05-15', '2013-05-15') ; 
INSERT INTO `historyactions` VALUES (121, 36, 50, '2013-05-13', '2013-05-31', 62, 'haute', 'en cours', 'Le 15/05/2013 par THIAULT Hugues<br>Mise à jour du DAT', '2013-05-15', '2013-05-15') ; 
INSERT INTO `historyactions` VALUES (122, 36, 50, '2013-05-13', '2013-05-31', 60, 'haute', 'en cours', 'Le 15/05/2013 par THIAULT Hugues<br>Mise à jour du DAT', '2013-05-15', '2013-05-15') ; 
INSERT INTO `historyactions` VALUES (123, 36, 50, '2013-05-13', '2013-05-31', 58, 'haute', 'en cours', 'Le 15/05/2013 par THIAULT Hugues<br>Mise à jour du DAT', '2013-05-15', '2013-05-15') ; 
INSERT INTO `historyactions` VALUES (124, 42, 0, '2013-05-15', '2013-05-15', 4, 'normale', 'en cours', 'Le 15/05/2013 par THIAULT Hugues<br>', '2013-05-15', '2013-05-15') ; 
INSERT INTO `historyactions` VALUES (125, 42, 0, '2013-05-15', '2013-05-15', 4, 'normale', 'en cours', 'Le 15/05/2013 par THIAULT Hugues<br>', '2013-05-15', '2013-05-15') ; 
INSERT INTO `historyactions` VALUES (126, 42, 10, '2013-05-15', '2013-05-15', 4, 'normale', 'en cours', 'Le 15/05/2013 par THIAULT Hugues<br>', '2013-05-15', '2013-05-15') ; 
INSERT INTO `historyactions` VALUES (127, 42, 20, '2013-05-15', '2013-05-15', 4, 'normale', 'en cours', 'Le 15/05/2013 par THIAULT Hugues<br>', '2013-05-15', '2013-05-15') ; 
INSERT INTO `historyactions` VALUES (128, 42, 20, '2013-05-15', '2013-05-15', 4, 'normale', 'en cours', 'Le 15/05/2013 par THIAULT Hugues<br>', '2013-05-15', '2013-05-15') ; 
INSERT INTO `historyactions` VALUES (129, 42, 30, '2013-05-15', '2013-05-15', 4, 'normale', 'en cours', 'Le 15/05/2013 par THIAULT Hugues<br>', '2013-05-15', '2013-05-15') ; 
INSERT INTO `historyactions` VALUES (130, 42, 40, '2013-05-15', '2013-05-15', 4, 'normale', 'en cours', 'Le 15/05/2013 par THIAULT Hugues<br>', '2013-05-15', '2013-05-15') ; 
INSERT INTO `historyactions` VALUES (131, 42, 50, '2013-05-15', '2013-05-15', 4, 'normale', 'en cours', 'Le 15/05/2013 par THIAULT Hugues<br>', '2013-05-15', '2013-05-15') ; 
INSERT INTO `historyactions` VALUES (132, 42, 60, '2013-05-15', '2013-05-15', 4, 'normale', 'en cours', 'Le 15/05/2013 par THIAULT Hugues<br>', '2013-05-15', '2013-05-15') ; 
INSERT INTO `historyactions` VALUES (133, 42, 70, '2013-05-15', '2013-05-15', 4, 'normale', 'en cours', 'Le 15/05/2013 par THIAULT Hugues<br>', '2013-05-15', '2013-05-15') ; 
INSERT INTO `historyactions` VALUES (134, 42, 80, '2013-05-15', '2013-05-15', 4, 'normale', 'en cours', 'Le 15/05/2013 par THIAULT Hugues<br>', '2013-05-15', '2013-05-15') ; 
INSERT INTO `historyactions` VALUES (135, 42, 90, '2013-05-15', '2013-05-15', 4, 'normale', 'en cours', 'Le 15/05/2013 par THIAULT Hugues<br>', '2013-05-15', '2013-05-15') ; 
INSERT INTO `historyactions` VALUES (136, 43, 100, '2013-05-15', '2013-05-15', 2, 'normale', 'en cours', 'Le 15/05/2013 par THIAULT Hugues<br>Communication COHERENCE - ITACT à moindre coût', '2013-05-15', '2013-05-15') ; 
INSERT INTO `historyactions` VALUES (137, 44, 100, '2013-05-15', '2013-05-15', 2, 'normale', 'en cours', 'Le 15/05/2013 par THIAULT Hugues<br>', '2013-05-15', '2013-05-15') ; 
INSERT INTO `historyactions` VALUES (138, 42, 10, '2013-05-15', '2005-06-04', 4, 'normale', 'en cours', 'Le 15/05/2013 par THIAULT Hugues<br>', '2013-05-15', '2013-05-15') ; 
INSERT INTO `historyactions` VALUES (139, 42, 100, '2013-05-15', '2005-06-04', 4, 'normale', 'terminée', 'Le 15/05/2013 par THIAULT Hugues<br>', '2013-05-15', '2013-05-15') ; 
INSERT INTO `historyactions` VALUES (140, 43, 100, '2013-05-15', '2005-06-04', 2, 'normale', 'terminée', 'Le 15/05/2013 par THIAULT Hugues<br>Communication COHERENCE - ITACT à moindre coût', '2013-05-15', '2013-05-15') ; 
INSERT INTO `historyactions` VALUES (141, 44, 100, '2013-05-15', '2005-06-04', 2, 'normale', 'terminée', 'Le 15/05/2013 par THIAULT Hugues<br>', '2013-05-15', '2013-05-15') ; 
INSERT INTO `historyactions` VALUES (142, 45, 30, '2013-05-15', '2013-05-15', 64, 'normale', 'en cours', 'Le 15/05/2013 par THIAULT Hugues<br>Premières remarques transmises au GRPT le 15/05', '2013-05-15', '2013-05-15') ; 
INSERT INTO `historyactions` VALUES (143, 46, 0, '2013-05-15', '2013-05-15', 0, 'normale', 'en cours', 'Le 15/05/2013 par THIAULT Hugues<br>', '2013-05-15', '2013-05-15') ; 
INSERT INTO `historyactions` VALUES (144, 45, 30, '2013-05-15', '2013-05-31', 64, 'normale', 'en cours', 'Le 15/05/2013 par THIAULT Hugues<br>Premières remarques transmises au GRPT le 15/05', '2013-05-15', '2013-05-15') ; 
INSERT INTO `historyactions` VALUES (145, 46, 0, '2013-05-15', '2013-05-31', 0, 'normale', 'en cours', 'Le 15/05/2013 par THIAULT Hugues<br>', '2013-05-15', '2013-05-15') ; 
INSERT INTO `historyactions` VALUES (146, 24, 10, '2013-05-13', '2013-08-29', 192, 'normale', 'en cours', 'Le 16/05/2013 par LEVAVASSEUR Jacques<br><div class="edit-comment-hide">
<div class="js-comment-body comment-body markdown-body markdown-format">
<ul>
<li>Gestions des fichiers des dossiers admin, all avec add, delete</li>
<li>Ajout d\'un lien pour la référence MINIDOC <em><strong>En cours</strong></em></li>
<li>Paramètrage du site (mot de passe admin, Url outil MINDOC, Email contact admin du site, sauvegarde et restauration BDD, ...) <em><strong>En cours</strong></em></li>
<li>Template d\'email avec envois si demandé (choix laissé à l\'utilisateur ou action de notification, envois automatique sur certaines actions)</li>
<li>sur la page d\'accueil mes statistiques : <strong>FAIT</strong>
<ul>
<li>nombre d\'action à faire, en cours, proche échéance</li>
<li>Saisie d\'activité</li>
<li>Mes livrables à venir</li>
<li>etc.</li>
</ul>
</li>
<li>Créer une action automatiquement lors de la création d\'un livrable avec le livrable associé rediriger vers cette action pour la compléter</li>
<li>Sur la création d\'action en automatique des ouvertures de droits ajouter le sujet de la demande dans l\'objet</li>
<li>Mise à jour de l\'état des action en cliquant sur l\'état, avancement à partir de la liste <strong>FAIT</strong></li>
<li>Importation des fichier ics</li>
<li>validation ou avertissement d\'un valideur d\'indisponibilité (spécifique aux prestataires, concerne un petite population)</li>
<li>
<div>Rapport plan de charge calculer le cout à partir du TJM agent attribué à chaque agent, calculer le TJM moyen.</div>
</li>
<li>Ajout des domaines dans les feuilles de temps <strong>FAIT</strong></li>
<li>Action groupées dans les feuilles de temps <strong>FAIT</strong></li>
<li>Réduction des champs obligatoires dans les actions <strong>FAIT</strong></li>
<li>Mise à jour des rapports <strong>FAIT</strong></li>
<li>Création de compte utilisateur générique <em><strong>En cours</strong></em></li>
</ul>
</div>
</div>', '2013-05-16', '2013-05-16') ; 
INSERT INTO `historyactions` VALUES (147, 24, 10, '2013-05-13', '2013-08-29', 192, 'normale', 'en cours', 'Le 16/05/2013 par LEVAVASSEUR Jacques<br><div class="edit-comment-hide">
<div class="js-comment-body comment-body markdown-body markdown-format">
<ul>
<li>Gestions des fichiers des dossiers admin, all avec add, delete</li>
<li>Ajout d\'un lien pour la référence MINIDOC <em><strong>En cours</strong></em></li>
<li>Paramètrage du site (mot de passe admin, Url outil MINDOC, Email contact admin du site, sauvegarde et restauration BDD, ...) <em><strong>En cours</strong></em></li>
<li>Template d\'email avec envois si demandé (choix laissé à l\'utilisateur ou action de notification, envois automatique sur certaines actions)</li>
<li>sur la page d\'accueil mes statistiques : <strong>FAIT</strong>
<ul>
<li>nombre d\'action à faire, en cours, proche échéance</li>
<li>Saisie d\'activité</li>
<li>Mes livrables à venir</li>
<li>etc.</li>
</ul>
</li>
<li>Créer une action automatiquement lors de la création d\'un livrable avec le livrable associé rediriger vers cette action pour la compléter</li>
<li>Sur la création d\'action en automatique des ouvertures de droits ajouter le sujet de la demande dans l\'objet</li>
<li>Mise à jour de l\'état des action en cliquant sur l\'état, avancement à partir de la liste <strong>FAIT</strong></li>
<li>Importation des fichier ics</li>
<li>validation ou avertissement d\'un valideur d\'indisponibilité (spécifique aux prestataires, concerne un petite population)</li>
<li>
<div>Rapport plan de charge calculer le cout à partir du TJM agent attribué à chaque agent, calculer le TJM moyen.</div>
</li>
<li>Ajout des domaines dans les feuilles de temps <strong>FAIT</strong></li>
<li>Action groupées dans les feuilles de temps <strong>FAIT</strong></li>
<li>Réduction des champs obligatoires dans les actions <strong>FAIT</strong></li>
<li>Mise à jour des rapports <strong>FAIT</strong></li>
<li>Création de compte utilisateur générique <em><strong>En cours</strong></em></li>
</ul>
</div>
</div>', '2013-05-16', '2013-05-16') ; 
INSERT INTO `historyactions` VALUES (148, 24, 30, '2013-05-13', '2013-08-29', 192, 'normale', 'en cours', 'Le 16/05/2013 par LEVAVASSEUR Jacques<br><div class="edit-comment-hide">
<div class="js-comment-body comment-body markdown-body markdown-format">
<ul>
<li>Gestions des fichiers des dossiers admin, all avec add, delete</li>
<li>Ajout d\'un lien pour la référence MINIDOC <em><strong>En cours</strong></em></li>
<li>Paramètrage du site (mot de passe admin, Url outil MINDOC, Email contact admin du site, sauvegarde et restauration BDD, ...) <em><strong>En cours</strong></em></li>
<li>Template d\'email avec envois si demandé (choix laissé à l\'utilisateur ou action de notification, envois automatique sur certaines actions)</li>
<li>sur la page d\'accueil mes statistiques : <strong>FAIT</strong>
<ul>
<li>nombre d\'action à faire, en cours, proche échéance</li>
<li>Saisie d\'activité</li>
<li>Mes livrables à venir</li>
<li>etc.</li>
</ul>
</li>
<li>Créer une action automatiquement lors de la création d\'un livrable avec le livrable associé rediriger vers cette action pour la compléter</li>
<li>Sur la création d\'action en automatique des ouvertures de droits ajouter le sujet de la demande dans l\'objet</li>
<li>Mise à jour de l\'état des action en cliquant sur l\'état, avancement à partir de la liste <strong>FAIT</strong></li>
<li>Importation des fichier ics</li>
<li>validation ou avertissement d\'un valideur d\'indisponibilité (spécifique aux prestataires, concerne un petite population)</li>
<li>
<div>Rapport plan de charge calculer le cout à partir du TJM agent attribué à chaque agent, calculer le TJM moyen.</div>
</li>
<li>Ajout des domaines dans les feuilles de temps <strong>FAIT</strong></li>
<li>Action groupées dans les feuilles de temps <strong>FAIT</strong></li>
<li>Réduction des champs obligatoires dans les actions <strong>FAIT</strong></li>
<li>Mise à jour des rapports <strong>FAIT</strong></li>
<li>Création de compte utilisateur générique<strong> <strong>FAIT</strong><em><br /></em></strong></li>
<li>Revoir la navigation<strong><strong><em> En cours</em></strong></strong></li>
</ul>
</div>
</div>', '2013-05-16', '2013-05-16') ; 
INSERT INTO `historyactions` VALUES (149, 47, 0, '2013-05-20', '2013-05-23', 0, 'moyenne', 'à faire', 'Le 16/05/2013 par LEVAVASSEUR Jacques<br>Prendre en compte le fichier Excel des absences,SAILL, et le fichier du plan de charge', '2013-05-16', '2013-05-16') ; 
INSERT INTO `historyactions` VALUES (150, 47, 0, '2013-05-20', '2013-05-23', 0, 'moyenne', 'à faire', 'Le 16/05/2013 par LEVAVASSEUR Jacques<br>Prendre en compte le fichier Excel des absences et le fichier du plan de charge', '2013-05-16', '2013-05-16') ; 
INSERT INTO `historyactions` VALUES (151, 48, 0, '2013-05-16', '2013-05-23', 8, 'moyenne', 'à faire', 'Le 16/05/2013 par LEVAVASSEUR Jacques<br>', '2013-05-16', '2013-05-16') ; 
INSERT INTO `historyactions` VALUES (152, 47, 0, '2013-05-20', '2013-05-23', 8, 'moyenne', 'à faire', 'Le 16/05/2013 par LEVAVASSEUR Jacques<br>Prendre en compte le fichier Excel des absences et le fichier du plan de charge', '2013-05-16', '2013-05-16') ; 
INSERT INTO `historyactions` VALUES (153, 48, 0, '2013-05-20', '2013-05-23', 8, 'moyenne', 'à faire', 'Le 16/05/2013 par LEVAVASSEUR Jacques<br>', '2013-05-16', '2013-05-16') ; 
INSERT INTO `historyactions` VALUES (154, 46, 30, '2013-05-15', '2013-05-31', 0, 'normale', 'en cours', 'Le 16/05/2013 par THIAULT Hugues<br>', '2013-05-16', '2013-05-16') ; 
INSERT INTO `historyactions` VALUES (155, 49, 100, '2013-05-16', '2013-05-16', 0, 'haute', 'en cours', 'Le 16/05/2013 par THIAULT Hugues<br>', '2013-05-16', '2013-05-16') ; 
INSERT INTO `historyactions` VALUES (156, 49, 100, '2013-05-16', '2013-05-16', 0, 'haute', 'en cours', 'Le 16/05/2013 par THIAULT Hugues<br>', '2013-05-16', '2013-05-16') ; 
INSERT INTO `historyactions` VALUES (157, 49, 90, '2013-05-16', '2013-05-16', 0, 'haute', 'en cours', 'Le 16/05/2013 par THIAULT Hugues<br>', '2013-05-16', '2013-05-16') ; 
INSERT INTO `historyactions` VALUES (158, 50, 90, '2013-05-16', '2013-05-16', 0, 'haute', 'en cours', 'Le 16/05/2013 par THIAULT Hugues<br>', '2013-05-16', '2013-05-16') ; 
INSERT INTO `historyactions` VALUES (159, 49, 80, '2013-05-16', '2013-05-16', 0, 'haute', 'en cours', 'Le 16/05/2013 par THIAULT Hugues<br>', '2013-05-16', '2013-05-16') ; 
INSERT INTO `historyactions` VALUES (160, 14, 30, '2013-04-24', '2013-05-30', 48, 'normale', 'en cours', 'Le 16/05/2013 par LEVAVASSEUR Jacques<br>le 13/05/2013:<br />
<ul>
<li>mise à jour de SAILL pour la création du compte de AGUILAR</li>
<li>Demande ouverture de droits</li>
<li>Activation du compte de LEBLANC Bastien</li>
<li>Demande ouverture de droits</li>
<li>Demande information budget SGRM</li>
</ul>
<br />le 14/05/2013<br />
<ul>
<li>mise à jour avancement ouverture de droit</li>
<li>demande droit admin sur poste P71</li>
<li>changement liste diffusion pour LEBLANC</li>
</ul>
<br />le 16/05/2013<br />
<ul>
<li>renseignement pour fournir un PC à Vincent BERNIER</li>
<li>Attente info pour le compte et surtout le mot de passe</li>
<li>Anticipation de la demande d\'activation du compte de Vincent BERNIER</li>
</ul>', '2013-05-16', '2013-05-16') ; 
INSERT INTO `historyactions` VALUES (161, 47, 10, '2013-05-20', '2013-05-23', 8, 'moyenne', 'en cours', 'Le 16/05/2013 par LEVAVASSEUR Jacques<br>Prendre en compte le fichier Excel des absences et le fichier du plan de charge', '2013-05-16', '2013-05-16') ; 
INSERT INTO `historyactions` VALUES (162, 47, 10, '2013-05-20', '2013-05-23', 8, 'moyenne', 'en cours', 'Le 16/05/2013 par LEVAVASSEUR Jacques<br>Prendre en compte le fichier Excel des absences et le fichier du plan de charge', '2013-05-16', '2013-05-16') ; 
INSERT INTO `historyactions` VALUES (163, 47, 20, '2013-05-20', '2013-05-23', 8, 'moyenne', 'en cours', 'Le 16/05/2013 par LEVAVASSEUR Jacques<br>Prendre en compte le fichier Excel des absences et le fichier du plan de charge', '2013-05-16', '2013-05-16') ; 
INSERT INTO `historyactions` VALUES (164, 47, 30, '2013-05-20', '2013-05-23', 8, 'moyenne', 'en cours', 'Le 16/05/2013 par LEVAVASSEUR Jacques<br>Prendre en compte le fichier Excel des absences et le fichier du plan de charge', '2013-05-16', '2013-05-16') ; 
INSERT INTO `historyactions` VALUES (165, 47, 40, '2013-05-20', '2013-05-23', 8, 'moyenne', 'en cours', 'Le 16/05/2013 par LEVAVASSEUR Jacques<br>Prendre en compte le fichier Excel des absences et le fichier du plan de charge<br />Consolidation envoyée à STERIA pour validation en attente du retour pour mercredi', '2013-05-16', '2013-05-16') ; 
INSERT INTO `historyactions` VALUES (166, 24, 30, '2013-05-13', '2013-08-29', 192, 'normale', 'en cours', 'Le 16/05/2013 par LEVAVASSEUR Jacques<br><div class="edit-comment-hide">
<div class="js-comment-body comment-body markdown-body markdown-format">
<ul>
<li>Gestions des fichiers des dossiers admin, all avec add, delete</li>
<li>Ajout d\'un lien pour la référence MINIDOC <em><strong>En cours</strong></em></li>
<li>Paramètrage du site (mot de passe admin, Url outil MINDOC, Email contact admin du site, sauvegarde et restauration BDD, ...) <em><strong>En cours</strong></em></li>
<li>Template d\'email avec envois si demandé (choix laissé à l\'utilisateur ou action de notification, envois automatique sur certaines actions)</li>
<li><span style="text-decoration: line-through;">sur la page d\'accueil mes statistiques</span> : <strong>FAIT</strong>
<ul>
<li><span style="text-decoration: line-through;">nombre d\'action à faire, en cours, proche échéance</span></li>
<li><span style="text-decoration: line-through;">Saisie d\'activité</span></li>
<li><span style="text-decoration: line-through;">Mes livrables à venir</span></li>
<li><span style="text-decoration: line-through;">etc.</span></li>
</ul>
</li>
<li>Créer une action automatiquement lors de la création d\'un livrable avec le livrable associé rediriger vers cette action pour la compléter</li>
<li>Sur la création d\'action en automatique des ouvertures de droits ajouter le sujet de la demande dans l\'objet</li>
<li><span style="text-decoration: line-through;">Mise à jour de l\'état des actions en cliquant sur l\'état, avancement à partir de la liste</span> <strong>FAIT</strong></li>
<li>Importation des fichier ics</li>
<li>validation ou avertissement d\'un valideur d\'indisponibilité (spécifique aux prestataires, concerne un petite population)</li>
<li>
<div>Rapport plan de charge calculer le cout à partir du TJM agent attribué à chaque agent, calculer le TJM moyen.</div>
</li>
<li><span style="text-decoration: line-through;">Ajout des domaines dans les feuilles de temps</span> <strong>FAIT</strong></li>
<li><span style="text-decoration: line-through;">Action groupées dans les feuilles de temps</span> <strong>FAIT</strong></li>
<li><span style="text-decoration: line-through;">Réduction des champs obligatoires dans les actions</span> <strong>FAIT</strong></li>
<li><span style="text-decoration: line-through;">Mise à jour des rapports</span> <strong>FAIT</strong></li>
<li><span style="text-decoration: line-through;">Création de compte utilisateur générique</span><strong> <strong>FAIT</strong><em><br /></em></strong></li>
<li>Revoir la navigation<strong><strong><em> En cours</em></strong></strong></li>
<li><span style="text-decoration: line-through;">Quelques évolutions faites à la volée sur les feuilles de temps, les rapports et autre</span> <strong>FAIT</strong></li>
</ul>
</div>
</div>', '2013-05-16', '2013-05-16') ; 
INSERT INTO `historyactions` VALUES (167, 14, 30, '2013-04-24', '2013-05-30', 48, 'normale', 'en cours', 'Le 16/05/2013 par LEVAVASSEUR Jacques<br>le 13/05/2013:<br />
<ul>
<li>mise à jour de SAILL pour la création du compte de AGUILAR</li>
<li>Demande ouverture de droits</li>
<li>Activation du compte de LEBLANC Bastien</li>
<li>Demande ouverture de droits</li>
<li>Demande information budget SGRM</li>
</ul>
le 14/05/2013<br />
<ul>
<li>mise à jour avancement ouverture de droit</li>
<li>demande droit admin sur poste P71</li>
<li>changement liste diffusion pour LEBLANC</li>
</ul>
le 16/05/2013<br />
<ul>
<li>renseignement pour fournir un PC à Vincent BERNIER</li>
<li>Attente info pour le compte et surtout le mot de passe</li>
<li>Anticipation de la demande d\'activation du compte de Vincent BERNIER -compte supprimé sera créé par SAMBA formulaire envoyé attente retour.</li>
</ul>
Le 21/05/2013', '2013-05-16', '2013-05-16') ; 
INSERT INTO `historyactions` VALUES (168, 49, 90, '2013-05-16', '2013-05-16', 0, 'haute', 'en cours', 'Le 16/05/2013 par THIAULT Hugues<br>', '2013-05-16', '2013-05-16') ; 
INSERT INTO `historyactions` VALUES (169, 49, 90, '2013-05-16', '2013-05-16', 2, 'haute', 'en cours', 'Le 16/05/2013 par THIAULT Hugues<br>', '2013-05-16', '2013-05-16') ; 
INSERT INTO `historyactions` VALUES (170, 49, 90, '2013-05-16', '2013-05-16', 4, 'haute', 'en cours', 'Le 16/05/2013 par THIAULT Hugues<br>', '2013-05-16', '2013-05-16') ; 
INSERT INTO `historyactions` VALUES (171, 49, 90, '2013-05-16', '2013-05-16', 6, 'haute', 'en cours', 'Le 16/05/2013 par THIAULT Hugues<br>', '2013-05-16', '2013-05-16') ; 
INSERT INTO `historyactions` VALUES (172, 49, 90, '2013-05-16', '2013-05-16', 8, 'haute', 'en cours', 'Le 16/05/2013 par THIAULT Hugues<br>', '2013-05-16', '2013-05-16') ; 
INSERT INTO `historyactions` VALUES (173, 49, 90, '2013-05-16', '2013-05-16', 8, 'haute', 'en cours', 'Le 16/05/2013 par THIAULT Hugues<br>', '2013-05-16', '2013-05-16') ; 
INSERT INTO `historyactions` VALUES (174, 50, 90, '2013-05-16', '2013-05-16', 8, 'haute', 'en cours', 'Le 16/05/2013 par THIAULT Hugues<br>', '2013-05-16', '2013-05-16') ; 
INSERT INTO `historyactions` VALUES (175, 46, 30, '2013-05-15', '2013-05-31', 16, 'normale', 'en cours', 'Le 16/05/2013 par THIAULT Hugues<br>', '2013-05-16', '2013-05-16') ; 
INSERT INTO `historyactions` VALUES (176, 51, 100, '2013-05-17', '2013-05-17', 0, 'haute', 'livré', 'Le 17/05/2013 par RIFFIOD Patricia<br>', '2013-05-17', '2013-05-17') ; 
INSERT INTO `historyactions` VALUES (177, 52, 0, '2013-05-27', '2013-05-27', 8, 'normale', 'en cours', 'Le 17/05/2013 par RIFFIOD Patricia<br>', '2013-05-17', '2013-05-17') ; 
INSERT INTO `historyactions` VALUES (178, 53, 100, '2013-05-28', '2013-05-07', 4, 'normale', 'terminée', 'Le 17/05/2013 par RIFFIOD Patricia<br>', '2013-05-17', '2013-05-17') ; 
INSERT INTO `historyactions` VALUES (179, 51, 100, '2013-05-17', '2013-05-17', 4, 'haute', 'livré', 'Le 17/05/2013 par RIFFIOD Patricia<br>', '2013-05-17', '2013-05-17') ; 
INSERT INTO `historyactions` VALUES (180, 54, 100, '2013-05-17', '2013-05-17', 0, 'normale', 'en cours', 'Le 17/05/2013 par RIFFIOD Patricia<br>', '2013-05-17', '2013-05-17') ; 
INSERT INTO `historyactions` VALUES (181, 55, 100, '2013-05-17', '2013-05-17', 0, 'normale', 'en cours', 'Le 17/05/2013 par RIFFIOD Patricia<br>', '2013-05-17', '2013-05-17') ; 
INSERT INTO `historyactions` VALUES (182, 54, 100, '2013-05-06', '2013-05-06', 0, 'normale', 'en cours', 'Le 17/05/2013 par RIFFIOD Patricia<br>', '2013-05-17', '2013-05-17') ; 
INSERT INTO `historyactions` VALUES (183, 54, 100, '2013-05-06', '2013-05-06', 8, 'normale', 'terminée', 'Le 17/05/2013 par RIFFIOD Patricia<br>', '2013-05-17', '2013-05-17') ; 
INSERT INTO `historyactions` VALUES (184, 55, 100, '2013-05-17', '2013-05-17', 0, 'normale', 'terminée', 'Le 17/05/2013 par RIFFIOD Patricia<br>', '2013-05-17', '2013-05-17') ; 
INSERT INTO `historyactions` VALUES (185, 56, 100, '2013-05-17', '2013-05-17', 0, 'normale', 'terminée', 'Le 17/05/2013 par RIFFIOD Patricia<br>', '2013-05-17', '2013-05-17') ; 
INSERT INTO `historyactions` VALUES (186, 57, 100, '2013-05-17', '2013-05-17', 0, 'normale', 'terminée', 'Le 17/05/2013 par RIFFIOD Patricia<br>', '2013-05-17', '2013-05-17') ; 
INSERT INTO `historyactions` VALUES (187, 58, 0, '2013-05-17', '2013-05-28', 8, 'normale', 'à faire', 'Le 17/05/2013 par RIFFIOD Patricia<br>', '2013-05-17', '2013-05-17') ; 
INSERT INTO `historyactions` VALUES (188, 53, 100, '2013-05-07', '2013-05-28', 4, 'normale', 'terminée', 'Le 17/05/2013 par RIFFIOD Patricia<br>', '2013-05-17', '2013-05-17') ; 
INSERT INTO `historyactions` VALUES (189, 52, 0, '2013-05-27', '2013-05-27', 8, 'normale', 'à faire', 'Le 17/05/2013 par RIFFIOD Patricia<br>', '2013-05-17', '2013-05-17') ; 
INSERT INTO `historyactions` VALUES (190, 59, 0, '2013-05-17', '2013-05-17', 0, 'normale', 'en cours', 'Le 17/05/2013 par BURIAND Magali<br>', '2013-05-17', '2013-05-17') ; 
INSERT INTO `historyactions` VALUES (191, 60, 0, '2013-04-01', '2013-05-17', 0, 'normale', 'en cours', 'Le 17/05/2013 par BURIAND Magali<br>', '2013-05-17', '2013-05-17') ; 
INSERT INTO `historyactions` VALUES (192, 61, 30, '2013-05-21', '2013-05-31', 16, 'moyenne', 'en cours', 'Le 21/05/2013 par THIAULT Hugues<br>', '2013-05-21', '2013-05-21') ; 
INSERT INTO `historyactions` VALUES (193, 61, 30, '2013-05-21', '2013-05-31', 16, 'moyenne', 'en cours', 'Le 21/05/2013 par THIAULT Hugues<br>', '2013-05-21', '2013-05-21') ; 
INSERT INTO `historyactions` VALUES (194, 61, 40, '2013-05-21', '2013-05-31', 16, 'moyenne', 'en cours', 'Le 21/05/2013 par THIAULT Hugues<br>', '2013-05-21', '2013-05-21') ; 
INSERT INTO `historyactions` VALUES (195, 62, 50, '2013-05-21', '2013-05-26', 2, 'haute', 'en cours', 'Le 21/05/2013 par LEVAVASSEUR Jacques<br><a href="../../utilisateurs/edit/278">Lien vers le nouvel utilisateur<br />D</a>emande envoyée  le 21/05/2013', '2013-05-21', '2013-05-21') ; 
INSERT INTO `historyactions` VALUES (196, 48, 80, '2013-05-20', '2013-05-23', 8, 'moyenne', 'à faire', 'Le 21/05/2013 par LEVAVASSEUR Jacques<br>Reste Julien BRANCATA', '2013-05-21', '2013-05-21') ; 
INSERT INTO `historyactions` VALUES (197, 47, 80, '2013-05-20', '2013-05-23', 8, 'moyenne', 'en cours', 'Le 21/05/2013 par LEVAVASSEUR Jacques<br>Prendre en compte le fichier Excel des absences et le fichier du plan de charge<br />Consolidation envoyée à STERIA pour validation en attente du retour pour mercredi<br />Retour presque complet en attente complément information de la part de STERIA', '2013-05-21', '2013-05-21') ; 
INSERT INTO `historyactions` VALUES (198, 14, 50, '2013-04-24', '2013-05-30', 48, 'normale', 'en cours', 'Le 21/05/2013 par LEVAVASSEUR Jacques<br>le 13/05/2013:<br />
<ul>
<li>mise à jour de SAILL pour la création du compte de AGUILAR</li>
<li>Demande ouverture de droits</li>
<li>Activation du compte de LEBLANC Bastien</li>
<li>Demande ouverture de droits</li>
<li>Demande information budget SGRM</li>
</ul>
le 14/05/2013<br />
<ul>
<li>mise à jour avancement ouverture de droit</li>
<li>demande droit admin sur poste P71</li>
<li>changement liste diffusion pour LEBLANC</li>
</ul>
le 16/05/2013<br />
<ul>
<li>renseignement pour fournir un PC à Vincent BERNIER</li>
<li>Attente info pour le compte et surtout le mot de passe</li>
<li>Anticipation de la demande d\'activation du compte de Vincent BERNIER -compte supprimé sera créé par SAMBA formulaire envoyé attente retour.</li>
</ul>
Le 21/05/2013<br />
<ul>
<li>Dépannage Visio</li>
<li>Création de compte</li>
</ul>', '2013-05-21', '2013-05-21') ; 
INSERT INTO `historyactions` VALUES (199, 33, 10, '2013-05-13', '2013-06-27', 2, 'moyenne', 'en cours', 'Le 21/05/2013 par LEVAVASSEUR Jacques<br><ul>
<li>Erreur de paramétrgae pour le profil Responsable équipe, ajouter autoupdate pour valider les feuille de temps</li>
</ul>', '2013-05-21', '2013-05-21') ; 
INSERT INTO `historyactions` VALUES (221, 48, 80, '2013-05-20', '2005-06-04', 8, 'moyenne', 'en cours', 'Le 21/05/2013 par LEVAVASSEUR Jacques<br>Reste Julien BRANCATA', '2013-05-21', '2013-05-21') ; 
INSERT INTO `historyactions` VALUES (222, 48, 80, '2013-05-20', '2013-05-24', 8, 'moyenne', 'en cours', 'Le 21/05/2013 par LEVAVASSEUR Jacques<br>Reste Julien BRANCATA', '2013-05-21', '2013-05-21') ; 
INSERT INTO `historyactions` VALUES (223, 62, 100, '2013-05-21', '2005-06-04', 2, 'haute', 'terminée', 'Le 22/05/2013 par LEVAVASSEUR Jacques<br><a href="../../utilisateurs/edit/278">Lien vers le nouvel utilisateur<br />D</a>emande envoyée  le 21/05/2013', '2013-05-22', '2013-05-22') ; 
INSERT INTO `historyactions` VALUES (224, 62, 100, '2013-05-21', '2013-05-22', 2, 'haute', 'livré', 'Le 22/05/2013 par LEVAVASSEUR Jacques<br><a href="../../utilisateurs/edit/278">Lien vers le nouvel utilisateur<br />D</a>emande envoyée  le 21/05/2013', '2013-05-22', '2013-05-22') ; 
INSERT INTO `historyactions` VALUES (225, 62, 0, '2013-05-21', '2013-05-22', 2, 'haute', 'annulée', 'Le 22/05/2013 par LEVAVASSEUR Jacques<br><a href="../../utilisateurs/edit/278">Lien vers le nouvel utilisateur<br />D</a>emande envoyée  le 21/05/2013', '2013-05-22', '2013-05-22') ; 
INSERT INTO `historyactions` VALUES (226, 62, 0, '2013-05-21', '2013-05-22', 2, 'haute', 'à faire', 'Le 22/05/2013 par LEVAVASSEUR Jacques<br><a href="../../utilisateurs/edit/278">Lien vers le nouvel utilisateur<br />D</a>emande envoyée  le 21/05/2013', '2013-05-22', '2013-05-22') ; 
INSERT INTO `historyactions` VALUES (227, 62, 10, '2013-05-21', '2013-05-22', 2, 'haute', 'en cours', 'Le 22/05/2013 par LEVAVASSEUR Jacques<br><a href="../../utilisateurs/edit/278">Lien vers le nouvel utilisateur<br />D</a>emande envoyée  le 21/05/2013', '2013-05-22', '2013-05-22') ; 
INSERT INTO `historyactions` VALUES (228, 62, 100, '2013-05-21', '2013-05-22', 2, 'haute', 'terminée', 'Le 22/05/2013 par LEVAVASSEUR Jacques<br><a href="../../utilisateurs/edit/278">Lien vers le nouvel utilisateur<br />D</a>emande envoyée  le 21/05/2013', '2013-05-22', '2013-05-22') ; 
INSERT INTO `historyactions` VALUES (229, 62, 100, '2013-05-21', '2013-05-22', 2, 'haute', 'livré', 'Le 22/05/2013 par LEVAVASSEUR Jacques<br><a href="../../utilisateurs/edit/278">Lien vers le nouvel utilisateur<br />D</a>emande envoyée  le 21/05/2013', '2013-05-22', '2013-05-22') ; 
INSERT INTO `historyactions` VALUES (230, 63, 10, '2013-05-21', '2013-05-26', 2, 'haute', 'en cours', 'Le 22/05/2013 par LEVAVASSEUR Jacques<br><a href="http://p64l03bib6q/SAILL/200/utiliseoutils/edit/119">Lien vers la nouvelle demande d\'ouverture de droit</a>', '2013-05-22', '2013-05-22') ; 
INSERT INTO `historyactions` VALUES (231, 63, 100, '2013-05-21', '2013-05-22', 2, 'haute', 'terminée', 'Le 22/05/2013 par LEVAVASSEUR Jacques<br><a href="http://p64l03bib6q/SAILL/200/utiliseoutils/edit/119">Lien vers la nouvelle demande d\'ouverture de droit</a>', '2013-05-22', '2013-05-22') ; 
INSERT INTO `historyactions` VALUES (232, 63, 100, '2013-05-21', '2013-05-22', 2, 'haute', 'livré', 'Le 22/05/2013 par LEVAVASSEUR Jacques<br><a href="http://p64l03bib6q/SAILL/200/utiliseoutils/edit/119">Lien vers la nouvelle demande d\'ouverture de droit</a>', '2013-05-22', '2013-05-22') ; 
INSERT INTO `historyactions` VALUES (233, 63, 0, '2013-05-21', '2013-05-22', 2, 'haute', 'annulée', 'Le 22/05/2013 par LEVAVASSEUR Jacques<br><a href="http://p64l03bib6q/SAILL/200/utiliseoutils/edit/119">Lien vers la nouvelle demande d\'ouverture de droit</a>', '2013-05-22', '2013-05-22') ; 
INSERT INTO `historyactions` VALUES (234, 63, 0, '2013-05-21', '2013-05-22', 2, 'haute', 'à faire', 'Le 22/05/2013 par LEVAVASSEUR Jacques<br><a href="http://p64l03bib6q/SAILL/200/utiliseoutils/edit/119">Lien vers la nouvelle demande d\'ouverture de droit</a>', '2013-05-22', '2013-05-22') ; 
INSERT INTO `historyactions` VALUES (235, 63, 10, '2013-05-21', '2013-05-22', 2, 'haute', 'en cours', 'Le 22/05/2013 par LEVAVASSEUR Jacques<br><a href="http://p64l03bib6q/SAILL/200/utiliseoutils/edit/119">Lien vers la nouvelle demande d\'ouverture de droit</a>', '2013-05-22', '2013-05-22') ; 
INSERT INTO `historyactions` VALUES (236, 63, 100, '2013-05-21', '2013-05-22', 2, 'haute', 'terminée', 'Le 22/05/2013 par LEVAVASSEUR Jacques<br><a href="http://p64l03bib6q/SAILL/200/utiliseoutils/edit/119">Lien vers la nouvelle demande d\'ouverture de droit</a>', '2013-05-22', '2013-05-22') ; 
INSERT INTO `historyactions` VALUES (237, 63, 100, '2013-05-21', '2013-05-22', 2, 'haute', 'livré', 'Le 22/05/2013 par LEVAVASSEUR Jacques<br><a href="http://p64l03bib6q/SAILL/200/utiliseoutils/edit/119">Lien vers la nouvelle demande d\'ouverture de droit</a>', '2013-05-22', '2013-05-22') ; 
INSERT INTO `historyactions` VALUES (238, 63, 0, '2013-05-21', '2013-05-22', 2, 'haute', 'annulée', 'Le 22/05/2013 par LEVAVASSEUR Jacques<br><a href="http://p64l03bib6q/SAILL/200/utiliseoutils/edit/119">Lien vers la nouvelle demande d\'ouverture de droit</a>', '2013-05-22', '2013-05-22') ; 
INSERT INTO `historyactions` VALUES (239, 63, 0, '2013-05-21', '2013-05-22', 2, 'haute', 'à faire', 'Le 22/05/2013 par LEVAVASSEUR Jacques<br><a href="http://p64l03bib6q/SAILL/200/utiliseoutils/edit/119">Lien vers la nouvelle demande d\'ouverture de droit</a>', '2013-05-22', '2013-05-22') ; 
INSERT INTO `historyactions` VALUES (240, 63, 10, '2013-05-21', '2013-05-22', 2, 'haute', 'en cours', 'Le 22/05/2013 par LEVAVASSEUR Jacques<br><a href="http://p64l03bib6q/SAILL/200/utiliseoutils/edit/119">Lien vers la nouvelle demande d\'ouverture de droit</a>', '2013-05-22', '2013-05-22') ; 
INSERT INTO `historyactions` VALUES (241, 63, 100, '2013-05-21', '2013-05-22', 2, 'haute', 'terminée', 'Le 22/05/2013 par LEVAVASSEUR Jacques<br><a href="http://p64l03bib6q/SAILL/200/utiliseoutils/edit/119">Lien vers la nouvelle demande d\'ouverture de droit</a>', '2013-05-22', '2013-05-22') ; 
INSERT INTO `historyactions` VALUES (242, 63, 100, '2013-05-21', '2013-05-22', 2, 'haute', 'livré', 'Le 22/05/2013 par LEVAVASSEUR Jacques<br><a href="http://p64l03bib6q/SAILL/200/utiliseoutils/edit/119">Lien vers la nouvelle demande d\'ouverture de droit</a>', '2013-05-22', '2013-05-22') ; 
INSERT INTO `historyactions` VALUES (243, 63, 0, '2013-05-21', '2013-05-22', 2, 'haute', 'annulée', 'Le 22/05/2013 par LEVAVASSEUR Jacques<br><a href="http://p64l03bib6q/SAILL/200/utiliseoutils/edit/119">Lien vers la nouvelle demande d\'ouverture de droit</a>', '2013-05-22', '2013-05-22') ; 
INSERT INTO `historyactions` VALUES (244, 63, 0, '2013-05-21', '2013-05-22', 2, 'haute', 'à faire', 'Le 22/05/2013 par LEVAVASSEUR Jacques<br><a href="http://p64l03bib6q/SAILL/200/utiliseoutils/edit/119">Lien vers la nouvelle demande d\'ouverture de droit</a>', '2013-05-22', '2013-05-22') ; 
INSERT INTO `historyactions` VALUES (245, 63, 10, '2013-05-21', '2013-05-22', 2, 'haute', 'en cours', 'Le 22/05/2013 par LEVAVASSEUR Jacques<br><a href="http://p64l03bib6q/SAILL/200/utiliseoutils/edit/119">Lien vers la nouvelle demande d\'ouverture de droit</a>', '2013-05-22', '2013-05-22') ; 
INSERT INTO `historyactions` VALUES (246, 63, 100, '2013-05-21', '2013-05-22', 2, 'haute', 'terminée', 'Le 22/05/2013 par LEVAVASSEUR Jacques<br><a href="http://p64l03bib6q/SAILL/200/utiliseoutils/edit/119">Lien vers la nouvelle demande d\'ouverture de droit</a>', '2013-05-22', '2013-05-22') ; 
INSERT INTO `historyactions` VALUES (247, 63, 100, '2013-05-21', '2013-05-22', 2, 'haute', 'livré', 'Le 22/05/2013 par LEVAVASSEUR Jacques<br><a href="http://p64l03bib6q/SAILL/200/utiliseoutils/edit/119">Lien vers la nouvelle demande d\'ouverture de droit</a>', '2013-05-22', '2013-05-22') ; 
INSERT INTO `historyactions` VALUES (248, 63, 0, '2013-05-21', '2013-05-22', 2, 'haute', 'annulée', 'Le 22/05/2013 par LEVAVASSEUR Jacques<br><a href="http://p64l03bib6q/SAILL/200/utiliseoutils/edit/119">Lien vers la nouvelle demande d\'ouverture de droit</a>', '2013-05-22', '2013-05-22') ; 
INSERT INTO `historyactions` VALUES (249, 63, 0, '2013-05-21', '2013-05-22', 2, 'haute', 'à faire', 'Le 22/05/2013 par LEVAVASSEUR Jacques<br><a href="http://p64l03bib6q/SAILL/200/utiliseoutils/edit/119">Lien vers la nouvelle demande d\'ouverture de droit</a>', '2013-05-22', '2013-05-22') ; 
INSERT INTO `historyactions` VALUES (250, 63, 10, '2013-05-21', '2013-05-22', 2, 'haute', 'en cours', 'Le 22/05/2013 par LEVAVASSEUR Jacques<br><a href="http://p64l03bib6q/SAILL/200/utiliseoutils/edit/119">Lien vers la nouvelle demande d\'ouverture de droit</a>', '2013-05-22', '2013-05-22') ; 
INSERT INTO `historyactions` VALUES (251, 63, 100, '2013-05-21', '2013-05-22', 2, 'haute', 'terminée', 'Le 22/05/2013 par LEVAVASSEUR Jacques<br><a href="http://p64l03bib6q/SAILL/200/utiliseoutils/edit/119">Lien vers la nouvelle demande d\'ouverture de droit</a>', '2013-05-22', '2013-05-22') ; 
INSERT INTO `historyactions` VALUES (252, 63, 100, '2013-05-21', '2013-05-22', 2, 'haute', 'livré', 'Le 22/05/2013 par LEVAVASSEUR Jacques<br><a href="http://p64l03bib6q/SAILL/200/utiliseoutils/edit/119">Lien vers la nouvelle demande d\'ouverture de droit</a>', '2013-05-22', '2013-05-22') ; 
INSERT INTO `historyactions` VALUES (253, 63, 0, '2013-05-21', '2013-05-22', 2, 'haute', 'annulée', 'Le 22/05/2013 par LEVAVASSEUR Jacques<br><a href="http://p64l03bib6q/SAILL/200/utiliseoutils/edit/119">Lien vers la nouvelle demande d\'ouverture de droit</a>', '2013-05-22', '2013-05-22') ; 
INSERT INTO `historyactions` VALUES (254, 63, 0, '2013-05-21', '2013-05-22', 2, 'haute', 'à faire', 'Le 22/05/2013 par LEVAVASSEUR Jacques<br><a href="http://p64l03bib6q/SAILL/200/utiliseoutils/edit/119">Lien vers la nouvelle demande d\'ouverture de droit</a>', '2013-05-22', '2013-05-22') ; 
INSERT INTO `historyactions` VALUES (255, 63, 10, '2013-05-21', '2013-05-22', 2, 'haute', 'en cours', 'Le 22/05/2013 par LEVAVASSEUR Jacques<br><a href="http://p64l03bib6q/SAILL/200/utiliseoutils/edit/119">Lien vers la nouvelle demande d\'ouverture de droit</a>', '2013-05-22', '2013-05-22') ; 
INSERT INTO `historyactions` VALUES (256, 63, 100, '2013-05-21', '2013-05-22', 2, 'haute', 'terminée', 'Le 22/05/2013 par LEVAVASSEUR Jacques<br><a href="http://p64l03bib6q/SAILL/200/utiliseoutils/edit/119">Lien vers la nouvelle demande d\'ouverture de droit</a>', '2013-05-22', '2013-05-22') ; 
INSERT INTO `historyactions` VALUES (257, 63, 100, '2013-05-21', '2013-05-22', 2, 'haute', 'livré', 'Le 22/05/2013 par LEVAVASSEUR Jacques<br><a href="http://p64l03bib6q/SAILL/200/utiliseoutils/edit/119">Lien vers la nouvelle demande d\'ouverture de droit</a>', '2013-05-22', '2013-05-22') ; 
INSERT INTO `historyactions` VALUES (258, 63, 0, '2013-05-21', '2013-05-22', 2, 'haute', 'annulée', 'Le 22/05/2013 par LEVAVASSEUR Jacques<br><a href="http://p64l03bib6q/SAILL/200/utiliseoutils/edit/119">Lien vers la nouvelle demande d\'ouverture de droit</a>', '2013-05-22', '2013-05-22') ; 
INSERT INTO `historyactions` VALUES (259, 63, 0, '2013-05-21', '2013-05-22', 2, 'haute', 'à faire', 'Le 22/05/2013 par LEVAVASSEUR Jacques<br><a href="http://p64l03bib6q/SAILL/200/utiliseoutils/edit/119">Lien vers la nouvelle demande d\'ouverture de droit</a>', '2013-05-22', '2013-05-22') ; 
INSERT INTO `historyactions` VALUES (260, 63, 10, '2013-05-21', '2013-05-22', 2, 'haute', 'en cours', 'Le 22/05/2013 par LEVAVASSEUR Jacques<br><a href="http://p64l03bib6q/SAILL/200/utiliseoutils/edit/119">Lien vers la nouvelle demande d\'ouverture de droit</a>', '2013-05-22', '2013-05-22') ; 
INSERT INTO `historyactions` VALUES (261, 63, 100, '2013-05-21', '2013-05-22', 2, 'haute', 'terminée', 'Le 22/05/2013 par LEVAVASSEUR Jacques<br><a href="http://p64l03bib6q/SAILL/200/utiliseoutils/edit/119">Lien vers la nouvelle demande d\'ouverture de droit</a>', '2013-05-22', '2013-05-22') ; 
INSERT INTO `historyactions` VALUES (262, 63, 100, '2013-05-21', '2013-05-22', 2, 'haute', 'livré', 'Le 22/05/2013 par LEVAVASSEUR Jacques<br><a href="http://p64l03bib6q/SAILL/200/utiliseoutils/edit/119">Lien vers la nouvelle demande d\'ouverture de droit</a>', '2013-05-22', '2013-05-22') ; 
INSERT INTO `historyactions` VALUES (263, 63, 0, '2013-05-21', '2013-05-22', 2, 'haute', 'annulée', 'Le 22/05/2013 par LEVAVASSEUR Jacques<br><a href="http://p64l03bib6q/SAILL/200/utiliseoutils/edit/119">Lien vers la nouvelle demande d\'ouverture de droit</a>', '2013-05-22', '2013-05-22') ; 
INSERT INTO `historyactions` VALUES (264, 63, 0, '2013-05-21', '2013-05-22', 2, 'haute', 'à faire', 'Le 22/05/2013 par LEVAVASSEUR Jacques<br><a href="http://p64l03bib6q/SAILL/200/utiliseoutils/edit/119">Lien vers la nouvelle demande d\'ouverture de droit</a>', '2013-05-22', '2013-05-22') ; 
INSERT INTO `historyactions` VALUES (265, 63, 10, '2013-05-21', '2013-05-22', 2, 'haute', 'en cours', 'Le 22/05/2013 par LEVAVASSEUR Jacques<br><a href="http://p64l03bib6q/SAILL/200/utiliseoutils/edit/119">Lien vers la nouvelle demande d\'ouverture de droit</a>', '2013-05-22', '2013-05-22') ; 
INSERT INTO `historyactions` VALUES (266, 63, 100, '2013-05-21', '2013-05-22', 2, 'haute', 'terminée', 'Le 22/05/2013 par LEVAVASSEUR Jacques<br><a href="http://p64l03bib6q/SAILL/200/utiliseoutils/edit/119">Lien vers la nouvelle demande d\'ouverture de droit</a>', '2013-05-22', '2013-05-22') ; 
INSERT INTO `historyactions` VALUES (267, 63, 100, '2013-05-21', '2013-05-22', 2, 'haute', 'livré', 'Le 22/05/2013 par LEVAVASSEUR Jacques<br><a href="http://p64l03bib6q/SAILL/200/utiliseoutils/edit/119">Lien vers la nouvelle demande d\'ouverture de droit</a>', '2013-05-22', '2013-05-22') ; 
INSERT INTO `historyactions` VALUES (268, 63, 0, '2013-05-21', '2013-05-22', 2, 'haute', 'annulée', 'Le 22/05/2013 par LEVAVASSEUR Jacques<br><a href="http://p64l03bib6q/SAILL/200/utiliseoutils/edit/119">Lien vers la nouvelle demande d\'ouverture de droit</a>', '2013-05-22', '2013-05-22') ; 
INSERT INTO `historyactions` VALUES (269, 63, 0, '2013-05-21', '2013-05-22', 2, 'haute', 'à faire', 'Le 22/05/2013 par LEVAVASSEUR Jacques<br><a href="http://p64l03bib6q/SAILL/200/utiliseoutils/edit/119">Lien vers la nouvelle demande d\'ouverture de droit</a>', '2013-05-22', '2013-05-22') ; 
INSERT INTO `historyactions` VALUES (270, 63, 10, '2013-05-21', '2013-05-22', 2, 'haute', 'en cours', 'Le 22/05/2013 par LEVAVASSEUR Jacques<br><a href="http://p64l03bib6q/SAILL/200/utiliseoutils/edit/119">Lien vers la nouvelle demande d\'ouverture de droit</a>', '2013-05-22', '2013-05-22') ; 
INSERT INTO `historyactions` VALUES (271, 63, 100, '2013-05-21', '2013-05-22', 2, 'haute', 'terminée', 'Le 22/05/2013 par LEVAVASSEUR Jacques<br><a href="http://p64l03bib6q/SAILL/200/utiliseoutils/edit/119">Lien vers la nouvelle demande d\'ouverture de droit</a>', '2013-05-22', '2013-05-22') ; 
INSERT INTO `historyactions` VALUES (272, 63, 100, '2013-05-21', '2013-05-22', 2, 'haute', 'livré', 'Le 22/05/2013 par LEVAVASSEUR Jacques<br><a href="http://p64l03bib6q/SAILL/200/utiliseoutils/edit/119">Lien vers la nouvelle demande d\'ouverture de droit</a>', '2013-05-22', '2013-05-22') ; 
INSERT INTO `historyactions` VALUES (273, 63, 0, '2013-05-21', '2013-05-22', 2, 'haute', 'annulée', 'Le 22/05/2013 par LEVAVASSEUR Jacques<br><a href="http://p64l03bib6q/SAILL/200/utiliseoutils/edit/119">Lien vers la nouvelle demande d\'ouverture de droit</a>', '2013-05-22', '2013-05-22') ; 
INSERT INTO `historyactions` VALUES (274, 63, 0, '2013-05-21', '2013-05-22', 2, 'haute', 'à faire', 'Le 22/05/2013 par LEVAVASSEUR Jacques<br><a href="http://p64l03bib6q/SAILL/200/utiliseoutils/edit/119">Lien vers la nouvelle demande d\'ouverture de droit</a>', '2013-05-22', '2013-05-22') ; 
INSERT INTO `historyactions` VALUES (275, 63, 10, '2013-05-21', '2013-05-22', 2, 'haute', 'en cours', 'Le 22/05/2013 par LEVAVASSEUR Jacques<br><a href="http://p64l03bib6q/SAILL/200/utiliseoutils/edit/119">Lien vers la nouvelle demande d\'ouverture de droit</a>', '2013-05-22', '2013-05-22') ; 
INSERT INTO `historyactions` VALUES (276, 63, 100, '2013-05-21', '2013-05-22', 2, 'haute', 'terminée', 'Le 22/05/2013 par LEVAVASSEUR Jacques<br><a href="http://p64l03bib6q/SAILL/200/utiliseoutils/edit/119">Lien vers la nouvelle demande d\'ouverture de droit</a>', '2013-05-22', '2013-05-22') ; 
INSERT INTO `historyactions` VALUES (277, 63, 100, '2013-05-21', '2013-05-22', 2, 'haute', 'livré', 'Le 22/05/2013 par LEVAVASSEUR Jacques<br><a href="http://p64l03bib6q/SAILL/200/utiliseoutils/edit/119">Lien vers la nouvelle demande d\'ouverture de droit</a>', '2013-05-22', '2013-05-22') ; 
INSERT INTO `historyactions` VALUES (278, 63, 0, '2013-05-21', '2013-05-22', 2, 'haute', 'annulée', 'Le 22/05/2013 par LEVAVASSEUR Jacques<br><a href="http://p64l03bib6q/SAILL/200/utiliseoutils/edit/119">Lien vers la nouvelle demande d\'ouverture de droit</a>', '2013-05-22', '2013-05-22') ; 
INSERT INTO `historyactions` VALUES (279, 63, 0, '2013-05-21', '2013-05-22', 2, 'haute', 'à faire', 'Le 22/05/2013 par LEVAVASSEUR Jacques<br><a href="http://p64l03bib6q/SAILL/200/utiliseoutils/edit/119">Lien vers la nouvelle demande d\'ouverture de droit</a>', '2013-05-22', '2013-05-22') ; 
INSERT INTO `historyactions` VALUES (280, 63, 10, '2013-05-21', '2013-05-22', 2, 'haute', 'en cours', 'Le 22/05/2013 par LEVAVASSEUR Jacques<br><a href="http://p64l03bib6q/SAILL/200/utiliseoutils/edit/119">Lien vers la nouvelle demande d\'ouverture de droit</a>', '2013-05-22', '2013-05-22') ; 
INSERT INTO `historyactions` VALUES (281, 63, 100, '2013-05-21', '2013-05-22', 2, 'haute', 'terminée', 'Le 22/05/2013 par LEVAVASSEUR Jacques<br><a href="http://p64l03bib6q/SAILL/200/utiliseoutils/edit/119">Lien vers la nouvelle demande d\'ouverture de droit</a>', '2013-05-22', '2013-05-22') ; 
INSERT INTO `historyactions` VALUES (282, 64, 10, '2013-05-21', '2013-05-26', 2, 'haute', 'en cours', 'Le 22/05/2013 par LEVAVASSEUR Jacques<br><a href="http://p64l03bib6q/SAILL/200/utiliseoutils/edit/120">Lien vers la nouvelle demande d\'ouverture de droit</a>', '2013-05-22', '2013-05-22') ; 
INSERT INTO `historyactions` VALUES (283, 64, 100, '2013-05-21', '2013-05-22', 2, 'haute', 'terminée', 'Le 22/05/2013 par LEVAVASSEUR Jacques<br><a href="http://p64l03bib6q/SAILL/200/utiliseoutils/edit/120">Lien vers la nouvelle demande d\'ouverture de droit</a>', '2013-05-22', '2013-05-22') ; 
INSERT INTO `historyactions` VALUES (284, 65, 10, '2013-05-21', '2013-05-26', 2, 'haute', 'en cours', 'Le 22/05/2013 par LEVAVASSEUR Jacques<br><a href="http://p64l03bib6q/SAILL/200/utiliseoutils/edit/121">Lien vers la nouvelle demande d\'ouverture de droit</a>', '2013-05-22', '2013-05-22') ; 
INSERT INTO `historyactions` VALUES (285, 65, 100, '2013-05-21', '2013-05-22', 2, 'haute', 'terminée', 'Le 22/05/2013 par LEVAVASSEUR Jacques<br><a href="http://p64l03bib6q/SAILL/200/utiliseoutils/edit/121">Lien vers la nouvelle demande d\'ouverture de droit</a>', '2013-05-22', '2013-05-22') ; 
INSERT INTO `historyactions` VALUES (286, 66, 10, '2013-05-21', '2013-05-26', 2, 'haute', 'en cours', 'Le 22/05/2013 par LEVAVASSEUR Jacques<br><a href="http://p64l03bib6q/SAILL/200/utiliseoutils/edit/122">Lien vers la nouvelle demande d\'ouverture de droit</a>', '2013-05-22', '2013-05-22') ; 
INSERT INTO `historyactions` VALUES (287, 66, 100, '2013-05-21', '2013-05-22', 2, 'haute', 'terminée', 'Le 22/05/2013 par LEVAVASSEUR Jacques<br><a href="http://p64l03bib6q/SAILL/200/utiliseoutils/edit/122">Lien vers la nouvelle demande d\'ouverture de droit</a>', '2013-05-22', '2013-05-22') ; 
INSERT INTO `historyactions` VALUES (288, 67, 10, '2013-05-21', '2013-05-26', 2, 'haute', 'en cours', 'Le 22/05/2013 par LEVAVASSEUR Jacques<br><a href="http://p64l03bib6q/SAILL/200/utiliseoutils/edit/123">Lien vers la nouvelle demande d\'ouverture de droit</a>', '2013-05-22', '2013-05-22') ; 
INSERT INTO `historyactions` VALUES (289, 67, 100, '2013-05-21', '2013-05-22', 2, 'haute', 'terminée', 'Le 22/05/2013 par LEVAVASSEUR Jacques<br><a href="http://p64l03bib6q/SAILL/200/utiliseoutils/edit/123">Lien vers la nouvelle demande d\'ouverture de droit</a>', '2013-05-22', '2013-05-22') ; 
INSERT INTO `historyactions` VALUES (290, 68, 10, '2013-05-21', '2013-05-26', 2, 'haute', 'en cours', 'Le 22/05/2013 par LEVAVASSEUR Jacques<br><a href="http://p64l03bib6q/SAILL/200/utiliseoutils/edit/124">Lien vers la nouvelle demande d\'ouverture de droit</a>', '2013-05-22', '2013-05-22') ; 
INSERT INTO `historyactions` VALUES (291, 68, 100, '2013-05-21', '2013-05-22', 2, 'haute', 'terminée', 'Le 22/05/2013 par LEVAVASSEUR Jacques<br><a href="http://p64l03bib6q/SAILL/200/utiliseoutils/edit/124">Lien vers la nouvelle demande d\'ouverture de droit</a>', '2013-05-22', '2013-05-22') ; 
INSERT INTO `historyactions` VALUES (292, 69, 10, '2013-05-21', '2013-05-26', 2, 'haute', 'en cours', 'Le 22/05/2013 par LEVAVASSEUR Jacques<br><a href="http://p64l03bib6q/SAILL/200/utiliseoutils/edit/125">Lien vers la nouvelle demande d\'ouverture de droit</a>', '2013-05-22', '2013-05-22') ; 
INSERT INTO `historyactions` VALUES (293, 69, 100, '2013-05-21', '2013-05-22', 2, 'haute', 'terminée', 'Le 22/05/2013 par LEVAVASSEUR Jacques<br><a href="http://p64l03bib6q/SAILL/200/utiliseoutils/edit/125">Lien vers la nouvelle demande d\'ouverture de droit</a>', '2013-05-22', '2013-05-22') ; 
INSERT INTO `historyactions` VALUES (294, 69, 100, '2013-05-21', '2013-05-22', 2, 'haute', 'livré', 'Le 22/05/2013 par LEVAVASSEUR Jacques<br><a href="http://p64l03bib6q/SAILL/200/utiliseoutils/edit/125">Lien vers la nouvelle demande d\'ouverture de droit</a>', '2013-05-22', '2013-05-22') ; 
INSERT INTO `historyactions` VALUES (295, 70, 10, '2013-05-21', '2013-05-26', 2, 'haute', 'en cours', 'Le 22/05/2013 par LEVAVASSEUR Jacques<br><a href="http://p64l03bib6q/SAILL/200/utiliseoutils/edit/126">Lien vers la nouvelle demande d\'ouverture de droit</a>', '2013-05-22', '2013-05-22') ; 
INSERT INTO `historyactions` VALUES (296, 70, 100, '2013-05-21', '2013-05-22', 2, 'haute', 'terminée', 'Le 22/05/2013 par LEVAVASSEUR Jacques<br><a href="http://p64l03bib6q/SAILL/200/utiliseoutils/edit/126">Lien vers la nouvelle demande d\'ouverture de droit</a>', '2013-05-22', '2013-05-22') ; 
INSERT INTO `historyactions` VALUES (297, 71, 10, '2013-05-21', '2013-05-26', 2, 'haute', 'en cours', 'Le 22/05/2013 par LEVAVASSEUR Jacques<br><a href="http://p64l03bib6q/SAILL/200/utilisateurs/edit/279">Lien vers le nouvel utilisateur</a>', '2013-05-22', '2013-05-22') ; 
INSERT INTO `historyactions` VALUES (298, 71, 100, '2013-05-21', '2013-05-22', 2, 'haute', 'terminée', 'Le 22/05/2013 par LEVAVASSEUR Jacques<br><a href="http://p64l03bib6q/SAILL/200/utilisateurs/edit/279">Lien vers le nouvel utilisateur</a>', '2013-05-22', '2013-05-22') ; 
INSERT INTO `historyactions` VALUES (299, 72, 10, '2013-05-21', '2013-05-26', 2, 'haute', 'en cours', 'Le 22/05/2013 par LEVAVASSEUR Jacques<br><a href="http://p64l03bib6q/SAILL/200/utiliseoutils/edit/127">Lien vers la nouvelle demande d\'ouverture de droit</a>', '2013-05-22', '2013-05-22') ; 
INSERT INTO `historyactions` VALUES (300, 72, 100, '2013-05-21', '2013-05-22', 2, 'haute', 'terminée', 'Le 22/05/2013 par LEVAVASSEUR Jacques<br><a href="http://p64l03bib6q/SAILL/200/utiliseoutils/edit/127">Lien vers la nouvelle demande d\'ouverture de droit</a>', '2013-05-22', '2013-05-22') ; 
INSERT INTO `historyactions` VALUES (301, 73, 10, '2013-05-21', '2013-05-26', 2, 'haute', 'en cours', 'Le 22/05/2013 par LEVAVASSEUR Jacques<br><a href="http://p64l03bib6q/SAILL/200/utiliseoutils/edit/128">Lien vers la nouvelle demande d\'ouverture de droit</a>', '2013-05-22', '2013-05-22') ; 
INSERT INTO `historyactions` VALUES (302, 73, 100, '2013-05-21', '2013-05-22', 2, 'haute', 'terminée', 'Le 22/05/2013 par LEVAVASSEUR Jacques<br><a href="http://p64l03bib6q/SAILL/200/utiliseoutils/edit/128">Lien vers la nouvelle demande d\'ouverture de droit</a>', '2013-05-22', '2013-05-22') ; 
INSERT INTO `historyactions` VALUES (303, 74, 10, '2013-05-21', '2013-05-26', 2, 'haute', 'en cours', 'Le 22/05/2013 par LEVAVASSEUR Jacques<br><a href="http://p64l03bib6q/SAILL/200/utiliseoutils/edit/129">Lien vers la nouvelle demande d\'ouverture de droit</a>', '2013-05-22', '2013-05-22') ; 
INSERT INTO `historyactions` VALUES (304, 74, 100, '2013-05-21', '2013-05-22', 2, 'haute', 'terminée', 'Le 22/05/2013 par LEVAVASSEUR Jacques<br><a href="http://p64l03bib6q/SAILL/200/utiliseoutils/edit/129">Lien vers la nouvelle demande d\'ouverture de droit</a>', '2013-05-22', '2013-05-22') ; 
INSERT INTO `historyactions` VALUES (305, 75, 10, '2013-05-21', '2013-05-26', 2, 'haute', 'en cours', 'Le 22/05/2013 par LEVAVASSEUR Jacques<br><a href="http://p64l03bib6q/SAILL/200/utiliseoutils/edit/130">Lien vers la nouvelle demande d\'ouverture de droit</a>', '2013-05-22', '2013-05-22') ; 
INSERT INTO `historyactions` VALUES (306, 75, 100, '2013-05-21', '2013-05-22', 2, 'haute', 'terminée', 'Le 22/05/2013 par LEVAVASSEUR Jacques<br><a href="http://p64l03bib6q/SAILL/200/utiliseoutils/edit/130">Lien vers la nouvelle demande d\'ouverture de droit</a>', '2013-05-22', '2013-05-22') ; 
INSERT INTO `historyactions` VALUES (307, 76, 10, '2013-05-21', '2013-05-26', 2, 'haute', 'en cours', 'Le 22/05/2013 par LEVAVASSEUR Jacques<br><a href="http://p64l03bib6q/SAILL/200/utiliseoutils/edit/131">Lien vers la nouvelle demande d\'ouverture de droit</a>', '2013-05-22', '2013-05-22') ; 
INSERT INTO `historyactions` VALUES (308, 76, 100, '2013-05-21', '2013-05-22', 2, 'haute', 'terminée', 'Le 22/05/2013 par LEVAVASSEUR Jacques<br><a href="http://p64l03bib6q/SAILL/200/utiliseoutils/edit/131">Lien vers la nouvelle demande d\'ouverture de droit</a>', '2013-05-22', '2013-05-22') ; 
INSERT INTO `historyactions` VALUES (309, 77, 10, '2013-05-21', '2013-05-26', 2, 'haute', 'en cours', 'Le 22/05/2013 par LEVAVASSEUR Jacques<br><a href="http://p64l03bib6q/SAILL/200/utiliseoutils/edit/132">Lien vers la nouvelle demande d\'ouverture de droit</a>', '2013-05-22', '2013-05-22') ; 
INSERT INTO `historyactions` VALUES (310, 77, 100, '2013-05-21', '2013-05-22', 2, 'haute', 'terminée', 'Le 22/05/2013 par LEVAVASSEUR Jacques<br><a href="http://p64l03bib6q/SAILL/200/utiliseoutils/edit/132">Lien vers la nouvelle demande d\'ouverture de droit</a>', '2013-05-22', '2013-05-22') ; 
INSERT INTO `historyactions` VALUES (311, 78, 10, '2013-05-21', '2013-05-26', 2, 'haute', 'en cours', 'Le 22/05/2013 par LEVAVASSEUR Jacques<br><a href="http://p64l03bib6q/SAILL/200/utiliseoutils/edit/133">Lien vers la nouvelle demande d\'ouverture de droit</a>', '2013-05-22', '2013-05-22') ; 
INSERT INTO `historyactions` VALUES (312, 78, 100, '2013-05-21', '2013-05-22', 2, 'haute', 'terminée', 'Le 22/05/2013 par LEVAVASSEUR Jacques<br><a href="http://p64l03bib6q/SAILL/200/utiliseoutils/edit/133">Lien vers la nouvelle demande d\'ouverture de droit</a>', '2013-05-22', '2013-05-22') ; 
INSERT INTO `historyactions` VALUES (313, 47, 100, '2013-05-20', '2013-05-22', 8, 'moyenne', 'terminée', 'Le 22/05/2013 par LEVAVASSEUR Jacques<br>Prendre en compte le fichier Excel des absences et le fichier du plan de charge<br />Consolidation envoyée à STERIA pour validation en attente du retour pour mercredi<br />Retour presque complet en attente complément information de la part de STERIA', '2013-05-22', '2013-05-22') ; 
INSERT INTO `historyactions` VALUES (314, 48, 100, '2013-05-20', '2013-05-22', 8, 'moyenne', 'terminée', 'Le 22/05/2013 par LEVAVASSEUR Jacques<br>Reste Julien BRANCATA', '2013-05-22', '2013-05-22') ; 
INSERT INTO `historyactions` VALUES (315, 14, 50, '2013-04-24', '2013-05-30', 48, 'normale', 'en cours', 'Le 22/05/2013 par LEVAVASSEUR Jacques<br>le 13/05/2013:<br />
<ul>
<li>mise à jour de SAILL pour la création du compte de AGUILAR</li>
<li>Demande ouverture de droits</li>
<li>Activation du compte de LEBLANC Bastien</li>
<li>Demande ouverture de droits</li>
<li>Demande information budget SGRM</li>
</ul>
le 14/05/2013<br />
<ul>
<li>mise à jour avancement ouverture de droit</li>
<li>demande droit admin sur poste P71</li>
<li>changement liste diffusion pour LEBLANC</li>
</ul>
le 16/05/2013<br />
<ul>
<li>renseignement pour fournir un PC à Vincent BERNIER</li>
<li>Attente info pour le compte et surtout le mot de passe</li>
<li>Anticipation de la demande d\'activation du compte de Vincent BERNIER -compte supprimé sera créé par SAMBA formulaire envoyé attente retour.</li>
</ul>
Le 21/05/2013<br />
<ul>
<li>Dépannage Visio</li>
<li>Création de compte</li>
</ul>', '2013-05-22', '2013-05-22') ; 
INSERT INTO `historyactions` VALUES (316, 14, 60, '2013-04-24', '2013-05-30', 48, 'normale', 'en cours', 'Le 22/05/2013 par LEVAVASSEUR Jacques<br>le 13/05/2013:<br />
<ul>
<li>mise à jour de SAILL pour la création du compte de AGUILAR</li>
<li>Demande ouverture de droits</li>
<li>Activation du compte de LEBLANC Bastien</li>
<li>Demande ouverture de droits</li>
<li>Demande information budget SGRM</li>
</ul>
le 14/05/2013<br />
<ul>
<li>mise à jour avancement ouverture de droit</li>
<li>demande droit admin sur poste P71</li>
<li>changement liste diffusion pour LEBLANC</li>
</ul>
le 16/05/2013<br />
<ul>
<li>renseignement pour fournir un PC à Vincent BERNIER</li>
<li>Attente info pour le compte et surtout le mot de passe</li>
<li>Anticipation de la demande d\'activation du compte de Vincent BERNIER -compte supprimé sera créé par SAMBA formulaire envoyé attente retour.</li>
</ul>
Le 21/05/2013<br />
<ul>
<li>Dépannage Visio</li>
<li>Création de compte</li>
</ul>', '2013-05-22', '2013-05-22') ; 
INSERT INTO `historyactions` VALUES (317, 24, 30, '2013-05-13', '2013-08-29', 192, 'normale', 'en cours', 'Le 22/05/2013 par LEVAVASSEUR Jacques<br><div class="edit-comment-hide">
<div class="js-comment-body comment-body markdown-body markdown-format">
<ul>
<li>Gestions des fichiers des dossiers admin, all avec add, delete</li>
<li>Ajout d\'un lien pour la référence MINIDOC <em><strong>En cours</strong></em></li>
<li>Paramètrage du site (mot de passe admin, Url outil MINDOC, Email contact admin du site, sauvegarde et restauration BDD, ...) <em><strong>En cours</strong></em></li>
<li>Template d\'email avec envois si demandé (choix laissé à l\'utilisateur ou action de notification, envois automatique sur certaines actions)</li>
<li><span style="text-decoration: line-through;">sur la page d\'accueil mes statistiques</span> : <strong>FAIT</strong>
<ul>
<li><span style="text-decoration: line-through;">nombre d\'action à faire, en cours, proche échéance</span></li>
<li><span style="text-decoration: line-through;">Saisie d\'activité</span></li>
<li><span style="text-decoration: line-through;">Mes livrables à venir</span></li>
<li><span style="text-decoration: line-through;">etc.</span></li>
</ul>
</li>
<li>Créer une action automatiquement lors de la création d\'un livrable avec le livrable associé rediriger vers cette action pour la compléter</li>
<li>Sur la création d\'action en automatique des ouvertures de droits ajouter le sujet de la demande dans l\'objet</li>
<li><span style="text-decoration: line-through;">Mise à jour de l\'état des actions en cliquant sur l\'état, avancement à partir de la liste</span> <strong>FAIT</strong></li>
<li>Importation des fichier ics</li>
<li>validation ou avertissement d\'un valideur d\'indisponibilité (spécifique aux prestataires, concerne un petite population)</li>
<li>
<div>Rapport plan de charge calculer le cout à partir du TJM agent attribué à chaque agent, calculer le TJM moyen.</div>
</li>
<li><span style="text-decoration: line-through;">Ajout des domaines dans les feuilles de temps</span> <strong>FAIT</strong></li>
<li><span style="text-decoration: line-through;">Action groupées dans les feuilles de temps</span> <strong>FAIT</strong></li>
<li><span style="text-decoration: line-through;">Réduction des champs obligatoires dans les actions</span> <strong>FAIT</strong></li>
<li><span style="text-decoration: line-through;">Mise à jour des rapports</span> <strong>FAIT</strong></li>
<li><span style="text-decoration: line-through;">Création de compte utilisateur générique</span><strong> <strong>FAIT</strong><em><br /></em></strong></li>
<li>Revoir la navigation<strong><strong><em> En cours</em></strong></strong></li>
<li><span style="text-decoration: line-through;">Quelques évolutions faites à la volée sur les feuilles de temps, les rapports et autre</span> <strong>FAIT</strong></li>
</ul>
</div>
</div>', '2013-05-22', '2013-05-22') ; 
INSERT INTO `historyactions` VALUES (318, 33, 20, '2013-05-13', '2013-06-27', 2, 'moyenne', 'en cours', 'Le 22/05/2013 par LEVAVASSEUR Jacques<br><ul>
<li>Erreur de paramétrgae pour le profil Responsable équipe, ajouter autoupdate pour valider les feuille de temps</li>
</ul>', '2013-05-22', '2013-05-22') ; 
INSERT INTO `historyactions` VALUES (319, 62, 0, '2013-05-21', '2013-05-22', 2, 'haute', 'annulée', 'Le 22/05/2013 par LEVAVASSEUR Jacques<br><a href="../../utilisateurs/edit/278">Lien vers le nouvel utilisateur<br />D</a>emande envoyée  le 21/05/2013', '2013-05-22', '2013-05-22') ; 
INSERT INTO `historyactions` VALUES (320, 69, 0, '2013-05-21', '2013-05-22', 2, 'haute', 'annulée', 'Le 22/05/2013 par LEVAVASSEUR Jacques<br><a href="http://p64l03bib6q/SAILL/200/utiliseoutils/edit/125">Lien vers la nouvelle demande d\'ouverture de droit</a>', '2013-05-22', '2013-05-22') ; 
INSERT INTO `historyactions` VALUES (321, 62, 0, '2013-05-21', '2013-05-22', 2, 'haute', 'à faire', 'Le 22/05/2013 par LEVAVASSEUR Jacques<br><a href="../../utilisateurs/edit/278">Lien vers le nouvel utilisateur<br />D</a>emande envoyée  le 21/05/2013', '2013-05-22', '2013-05-22') ; 
INSERT INTO `historyactions` VALUES (322, 69, 0, '2013-05-21', '2013-05-22', 2, 'haute', 'à faire', 'Le 22/05/2013 par LEVAVASSEUR Jacques<br><a href="http://p64l03bib6q/SAILL/200/utiliseoutils/edit/125">Lien vers la nouvelle demande d\'ouverture de droit</a>', '2013-05-22', '2013-05-22') ; 
INSERT INTO `historyactions` VALUES (323, 62, 10, '2013-05-21', '2013-05-22', 2, 'haute', 'en cours', 'Le 22/05/2013 par LEVAVASSEUR Jacques<br><a href="../../utilisateurs/edit/278">Lien vers le nouvel utilisateur<br />D</a>emande envoyée  le 21/05/2013', '2013-05-22', '2013-05-22') ; 
INSERT INTO `historyactions` VALUES (324, 69, 10, '2013-05-21', '2013-05-22', 2, 'haute', 'en cours', 'Le 22/05/2013 par LEVAVASSEUR Jacques<br><a href="http://p64l03bib6q/SAILL/200/utiliseoutils/edit/125">Lien vers la nouvelle demande d\'ouverture de droit</a>', '2013-05-22', '2013-05-22') ; 
INSERT INTO `historyactions` VALUES (325, 62, 100, '2013-05-21', '2013-05-22', 2, 'haute', 'terminée', 'Le 22/05/2013 par LEVAVASSEUR Jacques<br><a href="../../utilisateurs/edit/278">Lien vers le nouvel utilisateur<br />D</a>emande envoyée  le 21/05/2013', '2013-05-22', '2013-05-22') ; 
INSERT INTO `historyactions` VALUES (326, 69, 100, '2013-05-21', '2013-05-22', 2, 'haute', 'terminée', 'Le 22/05/2013 par LEVAVASSEUR Jacques<br><a href="http://p64l03bib6q/SAILL/200/utiliseoutils/edit/125">Lien vers la nouvelle demande d\'ouverture de droit</a>', '2013-05-22', '2013-05-22') ;
#
# End of data contents of table historyactions
# --------------------------------------------------------

# WordPress : buffernow.com MySQL database backup
#
# Generated: Thursday 23. May 2013 19:38 CEST
# Hostname: localhost
# Database: `saill_200`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `achats`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `actions`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `actionslivrables`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `activites`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `activitesreelles`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `affectations`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `assistances`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `autorisations`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `contrats`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `detailplancharges`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `domaines`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `dossierpartages`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `dotations`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `facturations`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `historyactions`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `historybudgets`
# --------------------------------------------------------


#
# Delete any existing table `historybudgets`
#

DROP TABLE IF EXISTS `historybudgets`;


#
# Table structure of table `historybudgets`
#

CREATE TABLE `historybudgets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `activite_id` int(15) NOT NULL,
  `ANNEE` year(4) NOT NULL,
  `PREVU` decimal(25,2) NOT NULL,
  `REVU` decimal(25,2) DEFAULT NULL,
  `ACTIF` tinyint(1) DEFAULT '0',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 ;

#
# Data contents of table historybudgets (15 records)
#
 
INSERT INTO `historybudgets` VALUES (1, 22, '2013', '961.00', '961.00', 1, '2013-05-13 12:35:36', '2013-05-13 12:42:25') ; 
INSERT INTO `historybudgets` VALUES (2, 21, '2013', '957.00', '957.00', 1, '2013-05-13 12:37:03', '2013-05-13 12:42:45') ; 
INSERT INTO `historybudgets` VALUES (3, 19, '2013', '97.00', '97.00', 1, '2013-05-13 12:37:39', '2013-05-13 12:43:10') ; 
INSERT INTO `historybudgets` VALUES (4, 17, '2013', '181.00', '181.00', 1, '2013-05-13 12:38:16', '2013-05-13 12:42:05') ; 
INSERT INTO `historybudgets` VALUES (5, 28, '2013', '121.00', '121.00', 1, '2013-05-13 12:43:55', '2013-05-13 12:46:34') ; 
INSERT INTO `historybudgets` VALUES (6, 24, '2013', '557.00', '557.00', 1, '2013-05-13 12:44:34', '2013-05-13 12:44:34') ; 
INSERT INTO `historybudgets` VALUES (7, 15, '2013', '612.00', '612.00', 1, '2013-05-13 12:45:09', '2013-05-13 12:45:42') ; 
INSERT INTO `historybudgets` VALUES (8, 36, '2013', '138.00', '138.00', 1, '2013-05-13 12:46:02', '2013-05-13 12:46:02') ; 
INSERT INTO `historybudgets` VALUES (9, 13, '2013', '27.00', '27.00', 1, '2013-05-13 12:47:16', '2013-05-13 12:47:16') ; 
INSERT INTO `historybudgets` VALUES (10, 14, '2013', '222.00', '222.00', 1, '2013-05-13 12:47:41', '2013-05-13 12:47:41') ; 
INSERT INTO `historybudgets` VALUES (11, 38, '2013', '168.00', '168.00', 1, '2013-05-13 12:48:15', '2013-05-13 12:48:15') ; 
INSERT INTO `historybudgets` VALUES (12, 16, '2013', '664.00', '664.00', 1, '2013-05-13 12:48:45', '2013-05-13 12:48:45') ; 
INSERT INTO `historybudgets` VALUES (13, 23, '2013', '289.00', '289.00', 1, '2013-05-13 12:49:15', '2013-05-13 12:49:15') ; 
INSERT INTO `historybudgets` VALUES (14, 27, '2013', '249.00', '249.00', 1, '2013-05-13 12:49:38', '2013-05-13 12:49:38') ; 
INSERT INTO `historybudgets` VALUES (15, 30, '2013', '35.00', '35.00', 1, '2013-05-13 12:50:34', '2013-05-13 12:50:34') ;
#
# End of data contents of table historybudgets
# --------------------------------------------------------

# WordPress : buffernow.com MySQL database backup
#
# Generated: Thursday 23. May 2013 19:38 CEST
# Hostname: localhost
# Database: `saill_200`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `achats`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `actions`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `actionslivrables`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `activites`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `activitesreelles`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `affectations`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `assistances`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `autorisations`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `contrats`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `detailplancharges`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `domaines`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `dossierpartages`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `dotations`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `facturations`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `historyactions`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `historybudgets`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `historyutilisateurs`
# --------------------------------------------------------


#
# Delete any existing table `historyutilisateurs`
#

DROP TABLE IF EXISTS `historyutilisateurs`;


#
# Table structure of table `historyutilisateurs`
#

CREATE TABLE `historyutilisateurs` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `utilisateur_id` int(15) NOT NULL,
  `HISTORIQUE` longtext,
  `created` date NOT NULL,
  `modified` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=669 DEFAULT CHARSET=utf8 ;

#
# Data contents of table historyutilisateurs (668 records)
#
 
INSERT INTO `historyutilisateurs` VALUES (1, 264, '12:51:18 - Utilisateur mis à jour par LEVAVASSEUR Jacques', '2013-03-27', '2013-03-27') ; 
INSERT INTO `historyutilisateurs` VALUES (2, 261, '06:26:20 - ajout d\'une dotation', '2013-03-28', '2013-03-28') ; 
INSERT INTO `historyutilisateurs` VALUES (3, 261, '06:26:53 - ajout d\'une dotation', '2013-03-28', '2013-03-28') ; 
INSERT INTO `historyutilisateurs` VALUES (4, 261, '06:27:18 - ajout d\'une dotation', '2013-03-28', '2013-03-28') ; 
INSERT INTO `historyutilisateurs` VALUES (5, 261, '06:27:44 - ajout d\'une dotation', '2013-03-28', '2013-03-28') ; 
INSERT INTO `historyutilisateurs` VALUES (6, 261, '06:28:07 - ajout d\'une dotation', '2013-03-28', '2013-03-28') ; 
INSERT INTO `historyutilisateurs` VALUES (7, 265, '06:51:18 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-03-28', '2013-03-28') ; 
INSERT INTO `historyutilisateurs` VALUES (8, 265, '06:51:25 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-03-28', '2013-03-28') ; 
INSERT INTO `historyutilisateurs` VALUES (9, 265, '06:51:32 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-03-28', '2013-03-28') ; 
INSERT INTO `historyutilisateurs` VALUES (10, 265, '06:51:36 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-03-28', '2013-03-28') ; 
INSERT INTO `historyutilisateurs` VALUES (11, 265, '06:51:40 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-03-28', '2013-03-28') ; 
INSERT INTO `historyutilisateurs` VALUES (12, 265, '06:51:44 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-03-28', '2013-03-28') ; 
INSERT INTO `historyutilisateurs` VALUES (13, 265, '06:52:02 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-03-28', '2013-03-28') ; 
INSERT INTO `historyutilisateurs` VALUES (14, 265, '06:52:29 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-03-28', '2013-03-28') ; 
INSERT INTO `historyutilisateurs` VALUES (15, 265, '06:52:34 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-03-28', '2013-03-28') ; 
INSERT INTO `historyutilisateurs` VALUES (16, 265, '06:52:56 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-03-28', '2013-03-28') ; 
INSERT INTO `historyutilisateurs` VALUES (17, 265, '06:53:01 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-03-28', '2013-03-28') ; 
INSERT INTO `historyutilisateurs` VALUES (18, 265, '06:53:26 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-03-28', '2013-03-28') ; 
INSERT INTO `historyutilisateurs` VALUES (19, 265, '06:53:30 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-03-28', '2013-03-28') ; 
INSERT INTO `historyutilisateurs` VALUES (20, 265, '06:57:27 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-03-28', '2013-03-28') ; 
INSERT INTO `historyutilisateurs` VALUES (21, 265, '06:57:37 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-03-28', '2013-03-28') ; 
INSERT INTO `historyutilisateurs` VALUES (22, 265, '06:57:59 - mise à jour d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-03-28', '2013-03-28') ; 
INSERT INTO `historyutilisateurs` VALUES (23, 265, '06:58:24 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-03-28', '2013-03-28') ; 
INSERT INTO `historyutilisateurs` VALUES (24, 265, '06:58:29 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-03-28', '2013-03-28') ; 
INSERT INTO `historyutilisateurs` VALUES (25, 265, '06:58:35 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-03-28', '2013-03-28') ; 
INSERT INTO `historyutilisateurs` VALUES (26, 265, '06:58:40 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-03-28', '2013-03-28') ; 
INSERT INTO `historyutilisateurs` VALUES (27, 265, '06:58:44 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-03-28', '2013-03-28') ; 
INSERT INTO `historyutilisateurs` VALUES (28, 265, '06:58:48 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-03-28', '2013-03-28') ; 
INSERT INTO `historyutilisateurs` VALUES (29, 265, '06:58:54 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-03-28', '2013-03-28') ; 
INSERT INTO `historyutilisateurs` VALUES (30, 265, '06:58:59 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-03-28', '2013-03-28') ; 
INSERT INTO `historyutilisateurs` VALUES (31, 265, '06:59:03 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-03-28', '2013-03-28') ; 
INSERT INTO `historyutilisateurs` VALUES (32, 266, '07:15:55 - Utilisateur créé par LEVAVASSEUR Jacques', '2013-03-28', '2013-03-28') ; 
INSERT INTO `historyutilisateurs` VALUES (33, 266, '07:16:43 - Utilisateur mis à jour par LEVAVASSEUR Jacques', '2013-03-28', '2013-03-28') ; 
INSERT INTO `historyutilisateurs` VALUES (34, 265, '09:57:11 - ajout d\'une dotation', '2013-03-28', '2013-03-28') ; 
INSERT INTO `historyutilisateurs` VALUES (35, 265, '10:48:03 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-03-28', '2013-03-28') ; 
INSERT INTO `historyutilisateurs` VALUES (36, 267, '10:50:56 - Utilisateur créé par LEVAVASSEUR Jacques', '2013-03-28', '2013-03-28') ; 
INSERT INTO `historyutilisateurs` VALUES (37, 70, '10:51:45 - Utilisateur mis à jour par LEVAVASSEUR Jacques', '2013-03-28', '2013-03-28') ; 
INSERT INTO `historyutilisateurs` VALUES (38, 262, '10:52:37 - Utilisateur mis à jour par LEVAVASSEUR Jacques', '2013-03-28', '2013-03-28') ; 
INSERT INTO `historyutilisateurs` VALUES (39, 87, '10:53:17 - Utilisateur mis à jour par LEVAVASSEUR Jacques', '2013-03-28', '2013-03-28') ; 
INSERT INTO `historyutilisateurs` VALUES (40, 267, '10:53:52 - Utilisateur mis à jour par LEVAVASSEUR Jacques', '2013-03-28', '2013-03-28') ; 
INSERT INTO `historyutilisateurs` VALUES (41, 267, '10:58:23 - Utilisateur mis à jour par LEVAVASSEUR Jacques', '2013-03-28', '2013-03-28') ; 
INSERT INTO `historyutilisateurs` VALUES (42, 268, '10:59:36 - Utilisateur dupliqué à partir de NGOM  Amsata par LEVAVASSEUR Jacques', '2013-03-28', '2013-03-28') ; 
INSERT INTO `historyutilisateurs` VALUES (43, 268, '11:00:32 - Utilisateur mis à jour par LEVAVASSEUR Jacques', '2013-03-28', '2013-03-28') ; 
INSERT INTO `historyutilisateurs` VALUES (44, 268, '11:03:24 - ajout d\'une affectation par LEVAVASSEUR Jacques', '2013-03-28', '2013-03-28') ; 
INSERT INTO `historyutilisateurs` VALUES (45, 265, '12:52:09 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-03-28', '2013-03-28') ; 
INSERT INTO `historyutilisateurs` VALUES (46, 265, '13:30:36 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-03-28', '2013-03-28') ; 
INSERT INTO `historyutilisateurs` VALUES (47, 262, '13:30:41 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-03-28', '2013-03-28') ; 
INSERT INTO `historyutilisateurs` VALUES (48, 261, '13:30:56 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-03-28', '2013-03-28') ; 
INSERT INTO `historyutilisateurs` VALUES (49, 257, '13:31:48 - ajout d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-03-28', '2013-03-28') ; 
INSERT INTO `historyutilisateurs` VALUES (50, 258, '13:33:10 - ajout d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-03-28', '2013-03-28') ; 
INSERT INTO `historyutilisateurs` VALUES (51, 258, '13:33:16 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-03-28', '2013-03-28') ; 
INSERT INTO `historyutilisateurs` VALUES (52, 257, '13:33:22 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-03-28', '2013-03-28') ; 
INSERT INTO `historyutilisateurs` VALUES (53, 262, '13:33:29 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-03-28', '2013-03-28') ; 
INSERT INTO `historyutilisateurs` VALUES (54, 265, '13:33:33 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-03-28', '2013-03-28') ; 
INSERT INTO `historyutilisateurs` VALUES (55, 261, '13:33:37 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-03-28', '2013-03-28') ; 
INSERT INTO `historyutilisateurs` VALUES (56, 261, '05:48:34 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-02', '2013-04-02') ; 
INSERT INTO `historyutilisateurs` VALUES (57, 261, '05:48:46 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-02', '2013-04-02') ; 
INSERT INTO `historyutilisateurs` VALUES (58, 268, '05:50:18 - Utilisateur mis à jour par LEVAVASSEUR Jacques', '2013-04-02', '2013-04-02') ; 
INSERT INTO `historyutilisateurs` VALUES (59, 268, '05:50:46 - ajout d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-02', '2013-04-02') ; 
INSERT INTO `historyutilisateurs` VALUES (60, 268, '05:51:11 - ajout d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-02', '2013-04-02') ; 
INSERT INTO `historyutilisateurs` VALUES (61, 268, '05:51:43 - ajout d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-02', '2013-04-02') ; 
INSERT INTO `historyutilisateurs` VALUES (62, 268, '05:51:56 - ajout d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-02', '2013-04-02') ; 
INSERT INTO `historyutilisateurs` VALUES (63, 268, '05:52:10 - ajout d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-02', '2013-04-02') ; 
INSERT INTO `historyutilisateurs` VALUES (64, 268, '05:52:23 - ajout d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-02', '2013-04-02') ; 
INSERT INTO `historyutilisateurs` VALUES (65, 268, '05:52:38 - ajout d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-02', '2013-04-02') ; 
INSERT INTO `historyutilisateurs` VALUES (66, 268, '05:52:50 - ajout d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-02', '2013-04-02') ; 
INSERT INTO `historyutilisateurs` VALUES (67, 268, '05:53:01 - ajout d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-02', '2013-04-02') ; 
INSERT INTO `historyutilisateurs` VALUES (68, 268, '05:53:15 - ajout d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-02', '2013-04-02') ; 
INSERT INTO `historyutilisateurs` VALUES (69, 268, '05:53:29 - ajout d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-02', '2013-04-02') ; 
INSERT INTO `historyutilisateurs` VALUES (70, 268, '05:53:42 - ajout d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-02', '2013-04-02') ; 
INSERT INTO `historyutilisateurs` VALUES (71, 267, '06:02:37 - Utilisateur mis à jour par LEVAVASSEUR Jacques', '2013-04-02', '2013-04-02') ; 
INSERT INTO `historyutilisateurs` VALUES (72, 267, '06:02:58 - ajout d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-02', '2013-04-02') ; 
INSERT INTO `historyutilisateurs` VALUES (73, 267, '06:03:15 - ajout d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-02', '2013-04-02') ; 
INSERT INTO `historyutilisateurs` VALUES (74, 267, '06:03:29 - ajout d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-02', '2013-04-02') ; 
INSERT INTO `historyutilisateurs` VALUES (75, 267, '06:03:43 - ajout d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-02', '2013-04-02') ; 
INSERT INTO `historyutilisateurs` VALUES (76, 267, '06:03:57 - ajout d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-02', '2013-04-02') ; 
INSERT INTO `historyutilisateurs` VALUES (77, 267, '06:04:12 - ajout d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-02', '2013-04-02') ; 
INSERT INTO `historyutilisateurs` VALUES (78, 267, '06:04:29 - ajout d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-02', '2013-04-02') ; 
INSERT INTO `historyutilisateurs` VALUES (79, 267, '06:04:44 - ajout d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-02', '2013-04-02') ; 
INSERT INTO `historyutilisateurs` VALUES (80, 267, '06:07:21 - ajout d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-02', '2013-04-02') ; 
INSERT INTO `historyutilisateurs` VALUES (81, 268, '06:14:04 - ajout d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-02', '2013-04-02') ; 
INSERT INTO `historyutilisateurs` VALUES (82, 267, '06:25:36 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-02', '2013-04-02') ; 
INSERT INTO `historyutilisateurs` VALUES (83, 267, '06:25:41 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-02', '2013-04-02') ; 
INSERT INTO `historyutilisateurs` VALUES (84, 267, '06:25:46 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-02', '2013-04-02') ; 
INSERT INTO `historyutilisateurs` VALUES (85, 267, '06:25:49 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-02', '2013-04-02') ; 
INSERT INTO `historyutilisateurs` VALUES (86, 267, '06:25:53 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-02', '2013-04-02') ; 
INSERT INTO `historyutilisateurs` VALUES (87, 267, '06:25:57 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-02', '2013-04-02') ; 
INSERT INTO `historyutilisateurs` VALUES (88, 267, '06:26:04 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-02', '2013-04-02') ; 
INSERT INTO `historyutilisateurs` VALUES (89, 267, '06:26:09 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-02', '2013-04-02') ; 
INSERT INTO `historyutilisateurs` VALUES (90, 267, '06:26:14 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-02', '2013-04-02') ; 
INSERT INTO `historyutilisateurs` VALUES (91, 267, '06:26:18 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-02', '2013-04-02') ; 
INSERT INTO `historyutilisateurs` VALUES (92, 267, '06:26:22 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-02', '2013-04-02') ; 
INSERT INTO `historyutilisateurs` VALUES (93, 267, '06:26:26 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-02', '2013-04-02') ; 
INSERT INTO `historyutilisateurs` VALUES (94, 267, '06:26:29 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-02', '2013-04-02') ; 
INSERT INTO `historyutilisateurs` VALUES (95, 267, '06:26:33 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-02', '2013-04-02') ; 
INSERT INTO `historyutilisateurs` VALUES (96, 268, '06:26:49 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-02', '2013-04-02') ; 
INSERT INTO `historyutilisateurs` VALUES (97, 268, '06:26:57 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-02', '2013-04-02') ; 
INSERT INTO `historyutilisateurs` VALUES (98, 268, '06:27:03 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-02', '2013-04-02') ; 
INSERT INTO `historyutilisateurs` VALUES (99, 268, '06:27:08 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-02', '2013-04-02') ; 
INSERT INTO `historyutilisateurs` VALUES (100, 268, '06:27:12 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-02', '2013-04-02') ; 
INSERT INTO `historyutilisateurs` VALUES (101, 268, '06:27:16 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-02', '2013-04-02') ; 
INSERT INTO `historyutilisateurs` VALUES (102, 268, '06:27:21 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-02', '2013-04-02') ; 
INSERT INTO `historyutilisateurs` VALUES (103, 268, '06:27:27 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-02', '2013-04-02') ; 
INSERT INTO `historyutilisateurs` VALUES (104, 268, '06:27:31 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-02', '2013-04-02') ; 
INSERT INTO `historyutilisateurs` VALUES (105, 268, '06:27:35 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-02', '2013-04-02') ; 
INSERT INTO `historyutilisateurs` VALUES (106, 268, '06:29:50 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-02', '2013-04-02') ; 
INSERT INTO `historyutilisateurs` VALUES (107, 268, '06:29:54 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-02', '2013-04-02') ; 
INSERT INTO `historyutilisateurs` VALUES (108, 268, '06:29:59 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-02', '2013-04-02') ; 
INSERT INTO `historyutilisateurs` VALUES (109, 268, '06:30:03 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-02', '2013-04-02') ; 
INSERT INTO `historyutilisateurs` VALUES (110, 268, '06:30:06 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-02', '2013-04-02') ; 
INSERT INTO `historyutilisateurs` VALUES (111, 268, '06:30:11 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-02', '2013-04-02') ; 
INSERT INTO `historyutilisateurs` VALUES (112, 268, '06:30:17 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-02', '2013-04-02') ; 
INSERT INTO `historyutilisateurs` VALUES (113, 268, '06:30:21 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-02', '2013-04-02') ; 
INSERT INTO `historyutilisateurs` VALUES (114, 268, '06:30:25 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-02', '2013-04-02') ; 
INSERT INTO `historyutilisateurs` VALUES (115, 268, '06:30:29 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-02', '2013-04-02') ; 
INSERT INTO `historyutilisateurs` VALUES (116, 268, '07:03:22 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-02', '2013-04-02') ; 
INSERT INTO `historyutilisateurs` VALUES (117, 267, '07:03:47 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-02', '2013-04-02') ; 
INSERT INTO `historyutilisateurs` VALUES (118, 267, '07:10:21 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-02', '2013-04-02') ; 
INSERT INTO `historyutilisateurs` VALUES (119, 267, '07:10:25 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-02', '2013-04-02') ; 
INSERT INTO `historyutilisateurs` VALUES (120, 267, '07:10:29 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-02', '2013-04-02') ; 
INSERT INTO `historyutilisateurs` VALUES (121, 268, '07:11:06 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-02', '2013-04-02') ; 
INSERT INTO `historyutilisateurs` VALUES (122, 268, '07:11:11 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-02', '2013-04-02') ; 
INSERT INTO `historyutilisateurs` VALUES (123, 268, '07:11:19 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-02', '2013-04-02') ; 
INSERT INTO `historyutilisateurs` VALUES (124, 268, '07:12:29 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-02', '2013-04-02') ; 
INSERT INTO `historyutilisateurs` VALUES (125, 268, '07:12:34 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-02', '2013-04-02') ; 
INSERT INTO `historyutilisateurs` VALUES (126, 268, '07:12:39 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-02', '2013-04-02') ; 
INSERT INTO `historyutilisateurs` VALUES (127, 268, '07:53:16 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-02', '2013-04-02') ; 
INSERT INTO `historyutilisateurs` VALUES (128, 267, '07:53:37 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-02', '2013-04-02') ; 
INSERT INTO `historyutilisateurs` VALUES (129, 268, '08:45:40 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-02', '2013-04-02') ; 
INSERT INTO `historyutilisateurs` VALUES (130, 267, '08:45:50 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-02', '2013-04-02') ; 
INSERT INTO `historyutilisateurs` VALUES (131, 267, '08:46:16 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-02', '2013-04-02') ; 
INSERT INTO `historyutilisateurs` VALUES (132, 268, '08:46:25 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-02', '2013-04-02') ; 
INSERT INTO `historyutilisateurs` VALUES (133, 267, '08:46:31 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-02', '2013-04-02') ; 
INSERT INTO `historyutilisateurs` VALUES (134, 267, '08:46:38 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-02', '2013-04-02') ; 
INSERT INTO `historyutilisateurs` VALUES (135, 268, '08:46:50 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-02', '2013-04-02') ; 
INSERT INTO `historyutilisateurs` VALUES (136, 268, '08:46:55 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-02', '2013-04-02') ; 
INSERT INTO `historyutilisateurs` VALUES (137, 268, '08:46:59 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-02', '2013-04-02') ; 
INSERT INTO `historyutilisateurs` VALUES (138, 261, '08:47:20 - suppression d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-02', '2013-04-02') ; 
INSERT INTO `historyutilisateurs` VALUES (139, 269, '09:23:48 - Utilisateur créé par LEVAVASSEUR Jacques', '2013-04-02', '2013-04-02') ; 
INSERT INTO `historyutilisateurs` VALUES (140, 270, '09:25:13 - Utilisateur créé par LEVAVASSEUR Jacques', '2013-04-02', '2013-04-02') ; 
INSERT INTO `historyutilisateurs` VALUES (141, 268, '09:27:05 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-02', '2013-04-02') ; 
INSERT INTO `historyutilisateurs` VALUES (142, 267, '09:27:16 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-02', '2013-04-02') ; 
INSERT INTO `historyutilisateurs` VALUES (143, 267, '09:27:33 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-02', '2013-04-02') ; 
INSERT INTO `historyutilisateurs` VALUES (144, 268, '09:27:37 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-02', '2013-04-02') ; 
INSERT INTO `historyutilisateurs` VALUES (145, 269, '09:37:24 - Utilisateur mis à jour par LEVAVASSEUR Jacques', '2013-04-02', '2013-04-02') ; 
INSERT INTO `historyutilisateurs` VALUES (146, 270, '09:38:13 - Utilisateur mis à jour par LEVAVASSEUR Jacques', '2013-04-02', '2013-04-02') ; 
INSERT INTO `historyutilisateurs` VALUES (147, 269, '11:02:43 - ajout d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-02', '2013-04-02') ; 
INSERT INTO `historyutilisateurs` VALUES (148, 269, '11:03:03 - ajout d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-02', '2013-04-02') ; 
INSERT INTO `historyutilisateurs` VALUES (149, 269, '11:03:23 - ajout d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-02', '2013-04-02') ; 
INSERT INTO `historyutilisateurs` VALUES (150, 269, '11:04:18 - ajout d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-02', '2013-04-02') ; 
INSERT INTO `historyutilisateurs` VALUES (151, 269, '11:04:41 - ajout d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-02', '2013-04-02') ; 
INSERT INTO `historyutilisateurs` VALUES (152, 269, '11:05:05 - ajout d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-02', '2013-04-02') ; 
INSERT INTO `historyutilisateurs` VALUES (153, 269, '11:05:23 - ajout d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-02', '2013-04-02') ; 
INSERT INTO `historyutilisateurs` VALUES (154, 269, '11:05:47 - ajout d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-02', '2013-04-02') ; 
INSERT INTO `historyutilisateurs` VALUES (155, 270, '11:06:20 - ajout d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-02', '2013-04-02') ; 
INSERT INTO `historyutilisateurs` VALUES (156, 270, '11:06:41 - ajout d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-02', '2013-04-02') ; 
INSERT INTO `historyutilisateurs` VALUES (157, 270, '11:06:56 - ajout d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-02', '2013-04-02') ; 
INSERT INTO `historyutilisateurs` VALUES (158, 270, '11:07:13 - ajout d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-02', '2013-04-02') ; 
INSERT INTO `historyutilisateurs` VALUES (159, 270, '11:07:32 - ajout d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-02', '2013-04-02') ; 
INSERT INTO `historyutilisateurs` VALUES (160, 270, '11:07:56 - ajout d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-02', '2013-04-02') ; 
INSERT INTO `historyutilisateurs` VALUES (161, 270, '11:08:10 - ajout d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-02', '2013-04-02') ; 
INSERT INTO `historyutilisateurs` VALUES (162, 270, '11:08:25 - ajout d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-02', '2013-04-02') ; 
INSERT INTO `historyutilisateurs` VALUES (163, 268, '12:13:13 - Utilisateur mis à jour par LEVAVASSEUR Jacques', '2013-04-02', '2013-04-02') ; 
INSERT INTO `historyutilisateurs` VALUES (164, 268, '05:40:43 - ajout d\'une dotation', '2013-04-03', '2013-04-03') ; 
INSERT INTO `historyutilisateurs` VALUES (165, 268, '05:41:02 - ajout d\'une dotation', '2013-04-03', '2013-04-03') ; 
INSERT INTO `historyutilisateurs` VALUES (166, 268, '05:41:18 - ajout d\'une dotation', '2013-04-03', '2013-04-03') ; 
INSERT INTO `historyutilisateurs` VALUES (167, 268, '05:41:40 - ajout d\'une dotation', '2013-04-03', '2013-04-03') ; 
INSERT INTO `historyutilisateurs` VALUES (168, 268, '05:41:59 - ajout d\'une dotation', '2013-04-03', '2013-04-03') ; 
INSERT INTO `historyutilisateurs` VALUES (169, 268, '05:42:28 - ajout d\'une dotation', '2013-04-03', '2013-04-03') ; 
INSERT INTO `historyutilisateurs` VALUES (170, 268, '05:42:53 - ajout d\'une dotation', '2013-04-03', '2013-04-03') ; 
INSERT INTO `historyutilisateurs` VALUES (171, 268, '05:43:32 - Utilisateur mis à jour par LEVAVASSEUR Jacques', '2013-04-03', '2013-04-03') ; 
INSERT INTO `historyutilisateurs` VALUES (172, 268, '05:47:38 - ajout d\'une affectation par LEVAVASSEUR Jacques', '2013-04-03', '2013-04-03') ; 
INSERT INTO `historyutilisateurs` VALUES (173, 268, '05:49:07 - suppression d\'une affectation par LEVAVASSEUR Jacques', '2013-04-03', '2013-04-03') ; 
INSERT INTO `historyutilisateurs` VALUES (174, 268, '05:49:13 - suppression d\'une affectation par LEVAVASSEUR Jacques', '2013-04-03', '2013-04-03') ; 
INSERT INTO `historyutilisateurs` VALUES (175, 268, '05:49:19 - suppression d\'une affectation par LEVAVASSEUR Jacques', '2013-04-03', '2013-04-03') ; 
INSERT INTO `historyutilisateurs` VALUES (176, 268, '05:49:25 - suppression d\'une affectation par LEVAVASSEUR Jacques', '2013-04-03', '2013-04-03') ; 
INSERT INTO `historyutilisateurs` VALUES (177, 268, '05:49:30 - suppression d\'une affectation par LEVAVASSEUR Jacques', '2013-04-03', '2013-04-03') ; 
INSERT INTO `historyutilisateurs` VALUES (178, 268, '05:49:36 - suppression d\'une affectation par LEVAVASSEUR Jacques', '2013-04-03', '2013-04-03') ; 
INSERT INTO `historyutilisateurs` VALUES (179, 268, '05:49:42 - suppression d\'une affectation par LEVAVASSEUR Jacques', '2013-04-03', '2013-04-03') ; 
INSERT INTO `historyutilisateurs` VALUES (180, 268, '05:49:48 - suppression d\'une affectation par LEVAVASSEUR Jacques', '2013-04-03', '2013-04-03') ; 
INSERT INTO `historyutilisateurs` VALUES (181, 268, '05:49:53 - suppression d\'une affectation par LEVAVASSEUR Jacques', '2013-04-03', '2013-04-03') ; 
INSERT INTO `historyutilisateurs` VALUES (182, 268, '05:49:59 - suppression d\'une affectation par LEVAVASSEUR Jacques', '2013-04-03', '2013-04-03') ; 
INSERT INTO `historyutilisateurs` VALUES (183, 268, '05:50:04 - suppression d\'une affectation par LEVAVASSEUR Jacques', '2013-04-03', '2013-04-03') ; 
INSERT INTO `historyutilisateurs` VALUES (184, 268, '05:50:09 - suppression d\'une affectation par LEVAVASSEUR Jacques', '2013-04-03', '2013-04-03') ; 
INSERT INTO `historyutilisateurs` VALUES (185, 268, '05:50:14 - suppression d\'une affectation par LEVAVASSEUR Jacques', '2013-04-03', '2013-04-03') ; 
INSERT INTO `historyutilisateurs` VALUES (186, 268, '06:00:14 - ajout d\'une affectation par LEVAVASSEUR Jacques', '2013-04-03', '2013-04-03') ; 
INSERT INTO `historyutilisateurs` VALUES (187, 268, '06:00:14 - ajout d\'une affectation par LEVAVASSEUR Jacques', '2013-04-03', '2013-04-03') ; 
INSERT INTO `historyutilisateurs` VALUES (188, 268, '06:00:15 - ajout d\'une affectation par LEVAVASSEUR Jacques', '2013-04-03', '2013-04-03') ; 
INSERT INTO `historyutilisateurs` VALUES (189, 268, '06:00:16 - ajout d\'une affectation par LEVAVASSEUR Jacques', '2013-04-03', '2013-04-03') ; 
INSERT INTO `historyutilisateurs` VALUES (190, 268, '06:00:16 - ajout d\'une affectation par LEVAVASSEUR Jacques', '2013-04-03', '2013-04-03') ; 
INSERT INTO `historyutilisateurs` VALUES (191, 268, '06:00:17 - ajout d\'une affectation par LEVAVASSEUR Jacques', '2013-04-03', '2013-04-03') ; 
INSERT INTO `historyutilisateurs` VALUES (192, 268, '06:00:18 - ajout d\'une affectation par LEVAVASSEUR Jacques', '2013-04-03', '2013-04-03') ; 
INSERT INTO `historyutilisateurs` VALUES (193, 268, '06:00:18 - ajout d\'une affectation par LEVAVASSEUR Jacques', '2013-04-03', '2013-04-03') ; 
INSERT INTO `historyutilisateurs` VALUES (194, 268, '06:00:19 - ajout d\'une affectation par LEVAVASSEUR Jacques', '2013-04-03', '2013-04-03') ; 
INSERT INTO `historyutilisateurs` VALUES (195, 268, '06:00:19 - ajout d\'une affectation par LEVAVASSEUR Jacques', '2013-04-03', '2013-04-03') ; 
INSERT INTO `historyutilisateurs` VALUES (196, 268, '06:00:20 - ajout d\'une affectation par LEVAVASSEUR Jacques', '2013-04-03', '2013-04-03') ; 
INSERT INTO `historyutilisateurs` VALUES (197, 268, '06:00:21 - ajout d\'une affectation par LEVAVASSEUR Jacques', '2013-04-03', '2013-04-03') ; 
INSERT INTO `historyutilisateurs` VALUES (198, 268, '06:00:21 - ajout d\'une affectation par LEVAVASSEUR Jacques', '2013-04-03', '2013-04-03') ; 
INSERT INTO `historyutilisateurs` VALUES (199, 268, '06:00:22 - ajout d\'une affectation par LEVAVASSEUR Jacques', '2013-04-03', '2013-04-03') ; 
INSERT INTO `historyutilisateurs` VALUES (200, 268, '06:00:23 - ajout d\'une affectation par LEVAVASSEUR Jacques', '2013-04-03', '2013-04-03') ; 
INSERT INTO `historyutilisateurs` VALUES (201, 268, '06:00:23 - ajout d\'une affectation par LEVAVASSEUR Jacques', '2013-04-03', '2013-04-03') ; 
INSERT INTO `historyutilisateurs` VALUES (202, 268, '06:00:24 - ajout d\'une affectation par LEVAVASSEUR Jacques', '2013-04-03', '2013-04-03') ; 
INSERT INTO `historyutilisateurs` VALUES (203, 268, '06:00:25 - ajout d\'une affectation par LEVAVASSEUR Jacques', '2013-04-03', '2013-04-03') ; 
INSERT INTO `historyutilisateurs` VALUES (204, 268, '06:00:25 - ajout d\'une affectation par LEVAVASSEUR Jacques', '2013-04-03', '2013-04-03') ; 
INSERT INTO `historyutilisateurs` VALUES (205, 268, '06:00:26 - ajout d\'une affectation par LEVAVASSEUR Jacques', '2013-04-03', '2013-04-03') ; 
INSERT INTO `historyutilisateurs` VALUES (206, 268, '06:00:27 - ajout d\'une affectation par LEVAVASSEUR Jacques', '2013-04-03', '2013-04-03') ; 
INSERT INTO `historyutilisateurs` VALUES (207, 268, '06:00:31 - ajout d\'une affectation par LEVAVASSEUR Jacques', '2013-04-03', '2013-04-03') ; 
INSERT INTO `historyutilisateurs` VALUES (208, 268, '06:00:31 - ajout d\'une affectation par LEVAVASSEUR Jacques', '2013-04-03', '2013-04-03') ; 
INSERT INTO `historyutilisateurs` VALUES (209, 268, '06:00:32 - ajout d\'une affectation par LEVAVASSEUR Jacques', '2013-04-03', '2013-04-03') ; 
INSERT INTO `historyutilisateurs` VALUES (210, 268, '06:00:33 - ajout d\'une affectation par LEVAVASSEUR Jacques', '2013-04-03', '2013-04-03') ; 
INSERT INTO `historyutilisateurs` VALUES (211, 268, '06:00:33 - ajout d\'une affectation par LEVAVASSEUR Jacques', '2013-04-03', '2013-04-03') ; 
INSERT INTO `historyutilisateurs` VALUES (212, 268, '06:00:34 - ajout d\'une affectation par LEVAVASSEUR Jacques', '2013-04-03', '2013-04-03') ; 
INSERT INTO `historyutilisateurs` VALUES (213, 268, '06:00:35 - ajout d\'une affectation par LEVAVASSEUR Jacques', '2013-04-03', '2013-04-03') ; 
INSERT INTO `historyutilisateurs` VALUES (214, 268, '06:00:36 - ajout d\'une affectation par LEVAVASSEUR Jacques', '2013-04-03', '2013-04-03') ; 
INSERT INTO `historyutilisateurs` VALUES (215, 268, '06:00:36 - ajout d\'une affectation par LEVAVASSEUR Jacques', '2013-04-03', '2013-04-03') ; 
INSERT INTO `historyutilisateurs` VALUES (216, 268, '06:00:37 - ajout d\'une affectation par LEVAVASSEUR Jacques', '2013-04-03', '2013-04-03') ; 
INSERT INTO `historyutilisateurs` VALUES (217, 268, '06:00:38 - ajout d\'une affectation par LEVAVASSEUR Jacques', '2013-04-03', '2013-04-03') ; 
INSERT INTO `historyutilisateurs` VALUES (218, 268, '06:00:38 - ajout d\'une affectation par LEVAVASSEUR Jacques', '2013-04-03', '2013-04-03') ; 
INSERT INTO `historyutilisateurs` VALUES (219, 268, '06:00:39 - ajout d\'une affectation par LEVAVASSEUR Jacques', '2013-04-03', '2013-04-03') ; 
INSERT INTO `historyutilisateurs` VALUES (220, 268, '06:00:40 - ajout d\'une affectation par LEVAVASSEUR Jacques', '2013-04-03', '2013-04-03') ; 
INSERT INTO `historyutilisateurs` VALUES (221, 268, '06:00:40 - ajout d\'une affectation par LEVAVASSEUR Jacques', '2013-04-03', '2013-04-03') ; 
INSERT INTO `historyutilisateurs` VALUES (222, 268, '06:00:41 - ajout d\'une affectation par LEVAVASSEUR Jacques', '2013-04-03', '2013-04-03') ; 
INSERT INTO `historyutilisateurs` VALUES (223, 268, '06:00:42 - ajout d\'une affectation par LEVAVASSEUR Jacques', '2013-04-03', '2013-04-03') ; 
INSERT INTO `historyutilisateurs` VALUES (224, 268, '06:00:42 - ajout d\'une affectation par LEVAVASSEUR Jacques', '2013-04-03', '2013-04-03') ; 
INSERT INTO `historyutilisateurs` VALUES (225, 268, '06:00:43 - ajout d\'une affectation par LEVAVASSEUR Jacques', '2013-04-03', '2013-04-03') ; 
INSERT INTO `historyutilisateurs` VALUES (226, 268, '06:00:43 - ajout d\'une affectation par LEVAVASSEUR Jacques', '2013-04-03', '2013-04-03') ; 
INSERT INTO `historyutilisateurs` VALUES (227, 268, '06:00:44 - ajout d\'une affectation par LEVAVASSEUR Jacques', '2013-04-03', '2013-04-03') ; 
INSERT INTO `historyutilisateurs` VALUES (228, 268, '06:01:43 - ajout d\'une affectation par LEVAVASSEUR Jacques', '2013-04-03', '2013-04-03') ; 
INSERT INTO `historyutilisateurs` VALUES (229, 268, '06:01:43 - ajout d\'une affectation par LEVAVASSEUR Jacques', '2013-04-03', '2013-04-03') ; 
INSERT INTO `historyutilisateurs` VALUES (230, 268, '06:01:44 - ajout d\'une affectation par LEVAVASSEUR Jacques', '2013-04-03', '2013-04-03') ; 
INSERT INTO `historyutilisateurs` VALUES (231, 268, '06:01:44 - ajout d\'une affectation par LEVAVASSEUR Jacques', '2013-04-03', '2013-04-03') ; 
INSERT INTO `historyutilisateurs` VALUES (232, 268, '06:01:45 - ajout d\'une affectation par LEVAVASSEUR Jacques', '2013-04-03', '2013-04-03') ; 
INSERT INTO `historyutilisateurs` VALUES (233, 268, '06:01:46 - ajout d\'une affectation par LEVAVASSEUR Jacques', '2013-04-03', '2013-04-03') ; 
INSERT INTO `historyutilisateurs` VALUES (234, 268, '06:01:46 - ajout d\'une affectation par LEVAVASSEUR Jacques', '2013-04-03', '2013-04-03') ; 
INSERT INTO `historyutilisateurs` VALUES (235, 268, '06:01:47 - ajout d\'une affectation par LEVAVASSEUR Jacques', '2013-04-03', '2013-04-03') ; 
INSERT INTO `historyutilisateurs` VALUES (236, 268, '06:01:48 - ajout d\'une affectation par LEVAVASSEUR Jacques', '2013-04-03', '2013-04-03') ; 
INSERT INTO `historyutilisateurs` VALUES (237, 268, '06:01:48 - ajout d\'une affectation par LEVAVASSEUR Jacques', '2013-04-03', '2013-04-03') ; 
INSERT INTO `historyutilisateurs` VALUES (238, 268, '06:01:49 - ajout d\'une affectation par LEVAVASSEUR Jacques', '2013-04-03', '2013-04-03') ; 
INSERT INTO `historyutilisateurs` VALUES (239, 268, '06:01:50 - ajout d\'une affectation par LEVAVASSEUR Jacques', '2013-04-03', '2013-04-03') ; 
INSERT INTO `historyutilisateurs` VALUES (240, 268, '06:01:50 - ajout d\'une affectation par LEVAVASSEUR Jacques', '2013-04-03', '2013-04-03') ; 
INSERT INTO `historyutilisateurs` VALUES (241, 268, '06:01:51 - ajout d\'une affectation par LEVAVASSEUR Jacques', '2013-04-03', '2013-04-03') ; 
INSERT INTO `historyutilisateurs` VALUES (242, 268, '06:01:51 - ajout d\'une affectation par LEVAVASSEUR Jacques', '2013-04-03', '2013-04-03') ; 
INSERT INTO `historyutilisateurs` VALUES (243, 268, '06:01:52 - ajout d\'une affectation par LEVAVASSEUR Jacques', '2013-04-03', '2013-04-03') ; 
INSERT INTO `historyutilisateurs` VALUES (244, 268, '06:01:53 - ajout d\'une affectation par LEVAVASSEUR Jacques', '2013-04-03', '2013-04-03') ; 
INSERT INTO `historyutilisateurs` VALUES (245, 268, '06:01:54 - ajout d\'une affectation par LEVAVASSEUR Jacques', '2013-04-03', '2013-04-03') ; 
INSERT INTO `historyutilisateurs` VALUES (246, 268, '06:01:54 - ajout d\'une affectation par LEVAVASSEUR Jacques', '2013-04-03', '2013-04-03') ; 
INSERT INTO `historyutilisateurs` VALUES (247, 268, '06:01:55 - ajout d\'une affectation par LEVAVASSEUR Jacques', '2013-04-03', '2013-04-03') ; 
INSERT INTO `historyutilisateurs` VALUES (248, 268, '06:01:56 - ajout d\'une affectation par LEVAVASSEUR Jacques', '2013-04-03', '2013-04-03') ; 
INSERT INTO `historyutilisateurs` VALUES (249, 268, '06:05:01 - ajout d\'une affectation par LEVAVASSEUR Jacques', '2013-04-03', '2013-04-03') ; 
INSERT INTO `historyutilisateurs` VALUES (250, 269, '06:19:15 - suppression d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-03', '2013-04-03') ; 
INSERT INTO `historyutilisateurs` VALUES (251, 269, '06:22:35 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-03', '2013-04-03') ; 
INSERT INTO `historyutilisateurs` VALUES (252, 270, '06:22:40 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-03', '2013-04-03') ; 
INSERT INTO `historyutilisateurs` VALUES (253, 270, '06:22:48 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-03', '2013-04-03') ; 
INSERT INTO `historyutilisateurs` VALUES (254, 269, '06:22:52 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-03', '2013-04-03') ; 
INSERT INTO `historyutilisateurs` VALUES (255, 270, '06:22:57 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-03', '2013-04-03') ; 
INSERT INTO `historyutilisateurs` VALUES (256, 270, '06:23:01 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-03', '2013-04-03') ; 
INSERT INTO `historyutilisateurs` VALUES (257, 269, '06:23:05 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-03', '2013-04-03') ; 
INSERT INTO `historyutilisateurs` VALUES (258, 270, '06:23:09 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-03', '2013-04-03') ; 
INSERT INTO `historyutilisateurs` VALUES (259, 269, '06:23:13 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-03', '2013-04-03') ; 
INSERT INTO `historyutilisateurs` VALUES (260, 269, '06:23:19 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-03', '2013-04-03') ; 
INSERT INTO `historyutilisateurs` VALUES (261, 270, '06:23:23 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-03', '2013-04-03') ; 
INSERT INTO `historyutilisateurs` VALUES (262, 270, '06:24:44 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-03', '2013-04-03') ; 
INSERT INTO `historyutilisateurs` VALUES (263, 269, '06:24:48 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-03', '2013-04-03') ; 
INSERT INTO `historyutilisateurs` VALUES (264, 269, '06:25:01 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-03', '2013-04-03') ; 
INSERT INTO `historyutilisateurs` VALUES (265, 269, '06:25:07 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-03', '2013-04-03') ; 
INSERT INTO `historyutilisateurs` VALUES (266, 269, '06:25:13 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-03', '2013-04-03') ; 
INSERT INTO `historyutilisateurs` VALUES (267, 269, '06:25:17 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-03', '2013-04-03') ; 
INSERT INTO `historyutilisateurs` VALUES (268, 269, '06:25:20 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-03', '2013-04-03') ; 
INSERT INTO `historyutilisateurs` VALUES (269, 269, '06:25:24 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-03', '2013-04-03') ; 
INSERT INTO `historyutilisateurs` VALUES (270, 270, '06:25:27 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-03', '2013-04-03') ; 
INSERT INTO `historyutilisateurs` VALUES (271, 270, '06:25:30 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-03', '2013-04-03') ; 
INSERT INTO `historyutilisateurs` VALUES (272, 270, '06:25:34 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-03', '2013-04-03') ; 
INSERT INTO `historyutilisateurs` VALUES (273, 270, '06:25:37 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-03', '2013-04-03') ; 
INSERT INTO `historyutilisateurs` VALUES (274, 270, '06:25:40 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-03', '2013-04-03') ; 
INSERT INTO `historyutilisateurs` VALUES (275, 270, '06:25:44 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-03', '2013-04-03') ; 
INSERT INTO `historyutilisateurs` VALUES (276, 270, '06:25:47 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-03', '2013-04-03') ; 
INSERT INTO `historyutilisateurs` VALUES (277, 269, '06:26:09 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-03', '2013-04-03') ; 
INSERT INTO `historyutilisateurs` VALUES (278, 270, '06:26:13 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-03', '2013-04-03') ; 
INSERT INTO `historyutilisateurs` VALUES (279, 269, '06:26:57 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-03', '2013-04-03') ; 
INSERT INTO `historyutilisateurs` VALUES (280, 270, '06:27:01 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-03', '2013-04-03') ; 
INSERT INTO `historyutilisateurs` VALUES (281, 269, '06:27:12 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-03', '2013-04-03') ; 
INSERT INTO `historyutilisateurs` VALUES (282, 270, '06:27:18 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-03', '2013-04-03') ; 
INSERT INTO `historyutilisateurs` VALUES (283, 269, '06:28:22 - Utilisateur mis à jour par LEVAVASSEUR Jacques', '2013-04-03', '2013-04-03') ; 
INSERT INTO `historyutilisateurs` VALUES (284, 270, '06:28:48 - Utilisateur mis à jour par LEVAVASSEUR Jacques', '2013-04-03', '2013-04-03') ; 
INSERT INTO `historyutilisateurs` VALUES (285, 270, '06:29:11 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-03', '2013-04-03') ; 
INSERT INTO `historyutilisateurs` VALUES (286, 269, '06:29:17 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-03', '2013-04-03') ; 
INSERT INTO `historyutilisateurs` VALUES (287, 270, '06:30:48 - suppression d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-03', '2013-04-03') ; 
INSERT INTO `historyutilisateurs` VALUES (288, 270, '06:32:11 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-03', '2013-04-03') ; 
INSERT INTO `historyutilisateurs` VALUES (289, 270, '06:32:15 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-03', '2013-04-03') ; 
INSERT INTO `historyutilisateurs` VALUES (290, 269, '06:32:32 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-03', '2013-04-03') ; 
INSERT INTO `historyutilisateurs` VALUES (291, 269, '06:32:36 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-03', '2013-04-03') ; 
INSERT INTO `historyutilisateurs` VALUES (292, 267, '12:32:24 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-03', '2013-04-03') ; 
INSERT INTO `historyutilisateurs` VALUES (293, 269, '12:32:44 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-03', '2013-04-03') ; 
INSERT INTO `historyutilisateurs` VALUES (294, 270, '12:32:49 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-03', '2013-04-03') ; 
INSERT INTO `historyutilisateurs` VALUES (295, 268, '12:32:54 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-03', '2013-04-03') ; 
INSERT INTO `historyutilisateurs` VALUES (296, 269, '12:33:06 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-03', '2013-04-03') ; 
INSERT INTO `historyutilisateurs` VALUES (297, 270, '12:33:12 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-03', '2013-04-03') ; 
INSERT INTO `historyutilisateurs` VALUES (298, 268, '12:35:05 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-03', '2013-04-03') ; 
INSERT INTO `historyutilisateurs` VALUES (299, 269, '12:35:10 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-03', '2013-04-03') ; 
INSERT INTO `historyutilisateurs` VALUES (300, 270, '12:35:13 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-03', '2013-04-03') ; 
INSERT INTO `historyutilisateurs` VALUES (301, 267, '12:35:17 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-03', '2013-04-03') ; 
INSERT INTO `historyutilisateurs` VALUES (302, 269, '12:35:27 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-03', '2013-04-03') ; 
INSERT INTO `historyutilisateurs` VALUES (303, 270, '12:35:31 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-03', '2013-04-03') ; 
INSERT INTO `historyutilisateurs` VALUES (304, 269, '06:46:50 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-04', '2013-04-04') ; 
INSERT INTO `historyutilisateurs` VALUES (305, 270, '06:46:55 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-04', '2013-04-04') ; 
INSERT INTO `historyutilisateurs` VALUES (306, 269, '06:47:26 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-04', '2013-04-04') ; 
INSERT INTO `historyutilisateurs` VALUES (307, 270, '06:47:29 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-04', '2013-04-04') ; 
INSERT INTO `historyutilisateurs` VALUES (308, 267, '09:34:33 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-04', '2013-04-04') ; 
INSERT INTO `historyutilisateurs` VALUES (309, 265, '10:30:52 - suppression d\'une dotation', '2013-04-04', '2013-04-04') ; 
INSERT INTO `historyutilisateurs` VALUES (310, 265, '10:31:17 - ajout d\'une dotation', '2013-04-04', '2013-04-04') ; 
INSERT INTO `historyutilisateurs` VALUES (311, 268, '10:38:38 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-04', '2013-04-04') ; 
INSERT INTO `historyutilisateurs` VALUES (312, 268, '10:38:41 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-04', '2013-04-04') ; 
INSERT INTO `historyutilisateurs` VALUES (313, 268, '10:38:45 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-04', '2013-04-04') ; 
INSERT INTO `historyutilisateurs` VALUES (314, 268, '10:38:48 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-04', '2013-04-04') ; 
INSERT INTO `historyutilisateurs` VALUES (315, 268, '10:39:33 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-04', '2013-04-04') ; 
INSERT INTO `historyutilisateurs` VALUES (316, 268, '10:39:37 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-04', '2013-04-04') ; 
INSERT INTO `historyutilisateurs` VALUES (317, 268, '10:39:40 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-04', '2013-04-04') ; 
INSERT INTO `historyutilisateurs` VALUES (318, 268, '10:39:43 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-04', '2013-04-04') ; 
INSERT INTO `historyutilisateurs` VALUES (319, 270, '07:51:18 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-08', '2013-04-08') ; 
INSERT INTO `historyutilisateurs` VALUES (320, 269, '07:51:23 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-08', '2013-04-08') ; 
INSERT INTO `historyutilisateurs` VALUES (321, 270, '07:51:53 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-08', '2013-04-08') ; 
INSERT INTO `historyutilisateurs` VALUES (322, 269, '07:52:09 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-08', '2013-04-08') ; 
INSERT INTO `historyutilisateurs` VALUES (323, 267, '07:52:12 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-08', '2013-04-08') ; 
INSERT INTO `historyutilisateurs` VALUES (324, 5, '09:29:41 - Utilisateur mis à jour par LEVAVASSEUR Jacques', '2013-04-09', '2013-04-09') ; 
INSERT INTO `historyutilisateurs` VALUES (325, 5, '09:31:45 - Utilisateur mis à jour par LEVAVASSEUR Jacques', '2013-04-09', '2013-04-09') ; 
INSERT INTO `historyutilisateurs` VALUES (326, 271, '08:06:11 - Utilisateur créé par LEVAVASSEUR Jacques', '2013-04-10', '2013-04-10') ; 
INSERT INTO `historyutilisateurs` VALUES (327, 271, '08:09:39 - Utilisateur mis à jour par LEVAVASSEUR Jacques', '2013-04-10', '2013-04-10') ; 
INSERT INTO `historyutilisateurs` VALUES (328, 271, '08:10:13 - ajout d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-10', '2013-04-10') ; 
INSERT INTO `historyutilisateurs` VALUES (329, 271, '08:10:37 - ajout d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-10', '2013-04-10') ; 
INSERT INTO `historyutilisateurs` VALUES (330, 271, '08:11:02 - ajout d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-10', '2013-04-10') ; 
INSERT INTO `historyutilisateurs` VALUES (331, 271, '08:11:29 - ajout d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-10', '2013-04-10') ; 
INSERT INTO `historyutilisateurs` VALUES (332, 271, '08:11:44 - ajout d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-10', '2013-04-10') ; 
INSERT INTO `historyutilisateurs` VALUES (333, 271, '08:12:48 - ajout d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-10', '2013-04-10') ; 
INSERT INTO `historyutilisateurs` VALUES (334, 271, '08:16:04 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-10', '2013-04-10') ; 
INSERT INTO `historyutilisateurs` VALUES (335, 271, '08:16:09 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-10', '2013-04-10') ; 
INSERT INTO `historyutilisateurs` VALUES (336, 271, '08:16:12 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-10', '2013-04-10') ; 
INSERT INTO `historyutilisateurs` VALUES (337, 271, '08:16:15 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-10', '2013-04-10') ; 
INSERT INTO `historyutilisateurs` VALUES (338, 271, '08:16:22 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-10', '2013-04-10') ; 
INSERT INTO `historyutilisateurs` VALUES (339, 271, '08:16:26 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-10', '2013-04-10') ; 
INSERT INTO `historyutilisateurs` VALUES (340, 271, '08:16:30 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-10', '2013-04-10') ; 
INSERT INTO `historyutilisateurs` VALUES (341, 271, '08:16:33 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-10', '2013-04-10') ; 
INSERT INTO `historyutilisateurs` VALUES (342, 271, '08:16:36 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-10', '2013-04-10') ; 
INSERT INTO `historyutilisateurs` VALUES (343, 271, '08:16:39 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-10', '2013-04-10') ; 
INSERT INTO `historyutilisateurs` VALUES (344, 271, '08:23:56 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-10', '2013-04-10') ; 
INSERT INTO `historyutilisateurs` VALUES (345, 271, '08:27:01 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-10', '2013-04-10') ; 
INSERT INTO `historyutilisateurs` VALUES (346, 271, '08:35:08 - Utilisateur mis à jour par LEVAVASSEUR Jacques', '2013-04-10', '2013-04-10') ; 
INSERT INTO `historyutilisateurs` VALUES (347, 271, '10:15:19 - ajout d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-10', '2013-04-10') ; 
INSERT INTO `historyutilisateurs` VALUES (348, 271, '10:18:18 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-10', '2013-04-10') ; 
INSERT INTO `historyutilisateurs` VALUES (349, 271, '11:20:03 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-10', '2013-04-10') ; 
INSERT INTO `historyutilisateurs` VALUES (350, 271, '11:20:22 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-10', '2013-04-10') ; 
INSERT INTO `historyutilisateurs` VALUES (351, 272, '09:31:26 - Utilisateur créé par LEVAVASSEUR Jacques', '2013-04-11', '2013-04-11') ; 
INSERT INTO `historyutilisateurs` VALUES (352, 272, '09:32:53 - Utilisateur mis à jour par LEVAVASSEUR Jacques', '2013-04-11', '2013-04-11') ; 
INSERT INTO `historyutilisateurs` VALUES (353, 272, '09:34:54 - ajout d\'une affectation par LEVAVASSEUR Jacques', '2013-04-11', '2013-04-11') ; 
INSERT INTO `historyutilisateurs` VALUES (354, 272, '09:35:46 - Utilisateur mis à jour par LEVAVASSEUR Jacques', '2013-04-11', '2013-04-11') ; 
INSERT INTO `historyutilisateurs` VALUES (355, 273, '12:00:33 - Utilisateur créé par LEVAVASSEUR Jacques', '2013-04-11', '2013-04-11') ; 
INSERT INTO `historyutilisateurs` VALUES (356, 273, '12:01:29 - Utilisateur mis à jour par LEVAVASSEUR Jacques', '2013-04-11', '2013-04-11') ; 
INSERT INTO `historyutilisateurs` VALUES (357, 273, '12:06:10 - ajout d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-11', '2013-04-11') ; 
INSERT INTO `historyutilisateurs` VALUES (358, 273, '12:06:27 - ajout d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-11', '2013-04-11') ; 
INSERT INTO `historyutilisateurs` VALUES (359, 273, '12:06:48 - ajout d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-11', '2013-04-11') ; 
INSERT INTO `historyutilisateurs` VALUES (360, 273, '12:07:05 - ajout d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-11', '2013-04-11') ; 
INSERT INTO `historyutilisateurs` VALUES (361, 273, '12:07:49 - ajout d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-11', '2013-04-11') ; 
INSERT INTO `historyutilisateurs` VALUES (362, 273, '12:08:13 - ajout d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-11', '2013-04-11') ; 
INSERT INTO `historyutilisateurs` VALUES (363, 273, '05:45:52 - Utilisateur mis à jour par LEVAVASSEUR Jacques', '2013-04-15', '2013-04-15') ; 
INSERT INTO `historyutilisateurs` VALUES (364, 273, '05:47:02 - mise à jour d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-15', '2013-04-15') ; 
INSERT INTO `historyutilisateurs` VALUES (365, 273, '05:49:16 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-15', '2013-04-15') ; 
INSERT INTO `historyutilisateurs` VALUES (366, 273, '05:49:19 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-15', '2013-04-15') ; 
INSERT INTO `historyutilisateurs` VALUES (367, 273, '05:49:22 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-15', '2013-04-15') ; 
INSERT INTO `historyutilisateurs` VALUES (368, 273, '05:49:24 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-15', '2013-04-15') ; 
INSERT INTO `historyutilisateurs` VALUES (369, 273, '05:49:48 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-15', '2013-04-15') ; 
INSERT INTO `historyutilisateurs` VALUES (370, 273, '05:49:52 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-15', '2013-04-15') ; 
INSERT INTO `historyutilisateurs` VALUES (371, 273, '05:49:54 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-15', '2013-04-15') ; 
INSERT INTO `historyutilisateurs` VALUES (372, 273, '05:49:57 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-15', '2013-04-15') ; 
INSERT INTO `historyutilisateurs` VALUES (373, 273, '05:50:25 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-15', '2013-04-15') ; 
INSERT INTO `historyutilisateurs` VALUES (374, 273, '05:50:29 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-15', '2013-04-15') ; 
INSERT INTO `historyutilisateurs` VALUES (375, 273, '05:53:19 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-15', '2013-04-15') ; 
INSERT INTO `historyutilisateurs` VALUES (376, 273, '08:07:27 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-15', '2013-04-15') ; 
INSERT INTO `historyutilisateurs` VALUES (377, 271, '08:07:46 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-15', '2013-04-15') ; 
INSERT INTO `historyutilisateurs` VALUES (378, 274, '08:27:11 - Utilisateur créé par LEVAVASSEUR Jacques', '2013-04-15', '2013-04-15') ; 
INSERT INTO `historyutilisateurs` VALUES (379, 275, '08:28:49 - Utilisateur créé par LEVAVASSEUR Jacques', '2013-04-15', '2013-04-15') ; 
INSERT INTO `historyutilisateurs` VALUES (380, 274, '08:33:42 - Utilisateur mis à jour par LEVAVASSEUR Jacques', '2013-04-15', '2013-04-15') ; 
INSERT INTO `historyutilisateurs` VALUES (381, 275, '08:34:52 - Utilisateur mis à jour par LEVAVASSEUR Jacques', '2013-04-15', '2013-04-15') ; 
INSERT INTO `historyutilisateurs` VALUES (382, 274, '08:37:49 - ajout d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-15', '2013-04-15') ; 
INSERT INTO `historyutilisateurs` VALUES (383, 274, '08:38:03 - ajout d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-15', '2013-04-15') ; 
INSERT INTO `historyutilisateurs` VALUES (384, 274, '08:39:35 - ajout d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-15', '2013-04-15') ; 
INSERT INTO `historyutilisateurs` VALUES (385, 274, '08:39:48 - ajout d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-15', '2013-04-15') ; 
INSERT INTO `historyutilisateurs` VALUES (386, 274, '08:39:59 - ajout d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-15', '2013-04-15') ; 
INSERT INTO `historyutilisateurs` VALUES (387, 274, '08:40:15 - ajout d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-15', '2013-04-15') ; 
INSERT INTO `historyutilisateurs` VALUES (388, 275, '08:40:51 - ajout d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-15', '2013-04-15') ; 
INSERT INTO `historyutilisateurs` VALUES (389, 275, '08:41:05 - ajout d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-15', '2013-04-15') ; 
INSERT INTO `historyutilisateurs` VALUES (390, 275, '08:41:19 - ajout d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-15', '2013-04-15') ; 
INSERT INTO `historyutilisateurs` VALUES (391, 275, '08:41:42 - ajout d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-15', '2013-04-15') ; 
INSERT INTO `historyutilisateurs` VALUES (392, 275, '08:41:54 - ajout d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-15', '2013-04-15') ; 
INSERT INTO `historyutilisateurs` VALUES (393, 275, '08:42:09 - ajout d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-15', '2013-04-15') ; 
INSERT INTO `historyutilisateurs` VALUES (394, 14, '08:51:35 - Utilisateur mis à jour par LEVAVASSEUR Jacques', '2013-04-15', '2013-04-15') ; 
INSERT INTO `historyutilisateurs` VALUES (395, 274, '09:55:12 - Utilisateur mis à jour par LEVAVASSEUR Jacques', '2013-04-15', '2013-04-15') ; 
INSERT INTO `historyutilisateurs` VALUES (396, 274, '09:55:50 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-15', '2013-04-15') ; 
INSERT INTO `historyutilisateurs` VALUES (397, 274, '09:55:54 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-15', '2013-04-15') ; 
INSERT INTO `historyutilisateurs` VALUES (398, 274, '09:55:57 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-15', '2013-04-15') ; 
INSERT INTO `historyutilisateurs` VALUES (399, 274, '09:56:00 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-15', '2013-04-15') ; 
INSERT INTO `historyutilisateurs` VALUES (400, 274, '09:56:03 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-15', '2013-04-15') ; 
INSERT INTO `historyutilisateurs` VALUES (401, 274, '09:56:06 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-15', '2013-04-15') ; 
INSERT INTO `historyutilisateurs` VALUES (402, 275, '11:46:32 - Utilisateur mis à jour par LEVAVASSEUR Jacques', '2013-04-15', '2013-04-15') ; 
INSERT INTO `historyutilisateurs` VALUES (403, 275, '11:46:44 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-15', '2013-04-15') ; 
INSERT INTO `historyutilisateurs` VALUES (404, 275, '11:46:47 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-15', '2013-04-15') ; 
INSERT INTO `historyutilisateurs` VALUES (405, 275, '11:46:50 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-15', '2013-04-15') ; 
INSERT INTO `historyutilisateurs` VALUES (406, 275, '11:46:53 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-15', '2013-04-15') ; 
INSERT INTO `historyutilisateurs` VALUES (407, 275, '11:46:56 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-15', '2013-04-15') ; 
INSERT INTO `historyutilisateurs` VALUES (408, 275, '11:46:58 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-15', '2013-04-15') ; 
INSERT INTO `historyutilisateurs` VALUES (409, 275, '11:49:29 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-15', '2013-04-15') ; 
INSERT INTO `historyutilisateurs` VALUES (410, 274, '11:49:32 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-15', '2013-04-15') ; 
INSERT INTO `historyutilisateurs` VALUES (411, 274, '11:49:35 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-15', '2013-04-15') ; 
INSERT INTO `historyutilisateurs` VALUES (412, 274, '11:49:38 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-15', '2013-04-15') ; 
INSERT INTO `historyutilisateurs` VALUES (413, 274, '11:49:41 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-15', '2013-04-15') ; 
INSERT INTO `historyutilisateurs` VALUES (414, 275, '11:49:44 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-15', '2013-04-15') ; 
INSERT INTO `historyutilisateurs` VALUES (415, 275, '11:49:46 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-15', '2013-04-15') ; 
INSERT INTO `historyutilisateurs` VALUES (416, 275, '11:49:49 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-15', '2013-04-15') ; 
INSERT INTO `historyutilisateurs` VALUES (417, 275, '11:51:10 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-15', '2013-04-15') ; 
INSERT INTO `historyutilisateurs` VALUES (418, 274, '11:51:16 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-15', '2013-04-15') ; 
INSERT INTO `historyutilisateurs` VALUES (419, 273, '11:54:52 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-15', '2013-04-15') ; 
INSERT INTO `historyutilisateurs` VALUES (420, 275, '12:56:43 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-15', '2013-04-15') ; 
INSERT INTO `historyutilisateurs` VALUES (421, 274, '12:56:48 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-15', '2013-04-15') ; 
INSERT INTO `historyutilisateurs` VALUES (422, 273, '12:57:00 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-15', '2013-04-15') ; 
INSERT INTO `historyutilisateurs` VALUES (423, 274, '12:58:44 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-15', '2013-04-15') ; 
INSERT INTO `historyutilisateurs` VALUES (424, 275, '12:58:47 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-15', '2013-04-15') ; 
INSERT INTO `historyutilisateurs` VALUES (425, 273, '12:58:50 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-15', '2013-04-15') ; 
INSERT INTO `historyutilisateurs` VALUES (426, 271, '12:58:53 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-15', '2013-04-15') ; 
INSERT INTO `historyutilisateurs` VALUES (427, 274, '13:26:05 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-15', '2013-04-15') ; 
INSERT INTO `historyutilisateurs` VALUES (428, 275, '13:26:11 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-15', '2013-04-15') ; 
INSERT INTO `historyutilisateurs` VALUES (429, 273, '13:26:16 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-15', '2013-04-15') ; 
INSERT INTO `historyutilisateurs` VALUES (430, 274, '13:27:20 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-15', '2013-04-15') ; 
INSERT INTO `historyutilisateurs` VALUES (431, 275, '13:27:23 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-15', '2013-04-15') ; 
INSERT INTO `historyutilisateurs` VALUES (432, 273, '13:27:27 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-15', '2013-04-15') ; 
INSERT INTO `historyutilisateurs` VALUES (433, 271, '08:20:53 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-16', '2013-04-16') ; 
INSERT INTO `historyutilisateurs` VALUES (434, 275, '09:20:50 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-16', '2013-04-16') ; 
INSERT INTO `historyutilisateurs` VALUES (435, 274, '09:20:57 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-16', '2013-04-16') ; 
INSERT INTO `historyutilisateurs` VALUES (436, 273, '09:21:05 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-16', '2013-04-16') ; 
INSERT INTO `historyutilisateurs` VALUES (437, 271, '09:21:09 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-16', '2013-04-16') ; 
INSERT INTO `historyutilisateurs` VALUES (438, 268, '09:21:24 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-16', '2013-04-16') ; 
INSERT INTO `historyutilisateurs` VALUES (439, 267, '09:21:29 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-16', '2013-04-16') ; 
INSERT INTO `historyutilisateurs` VALUES (440, 269, '09:21:33 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-16', '2013-04-16') ; 
INSERT INTO `historyutilisateurs` VALUES (441, 270, '09:21:39 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-16', '2013-04-16') ; 
INSERT INTO `historyutilisateurs` VALUES (442, 265, '09:21:44 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-16', '2013-04-16') ; 
INSERT INTO `historyutilisateurs` VALUES (443, 262, '09:21:50 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-16', '2013-04-16') ; 
INSERT INTO `historyutilisateurs` VALUES (444, 261, '09:21:54 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-16', '2013-04-16') ; 
INSERT INTO `historyutilisateurs` VALUES (445, 275, '09:25:19 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-16', '2013-04-16') ; 
INSERT INTO `historyutilisateurs` VALUES (446, 274, '09:25:23 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-16', '2013-04-16') ; 
INSERT INTO `historyutilisateurs` VALUES (447, 273, '09:25:26 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-16', '2013-04-16') ; 
INSERT INTO `historyutilisateurs` VALUES (448, 271, '09:25:28 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-16', '2013-04-16') ; 
INSERT INTO `historyutilisateurs` VALUES (449, 271, '09:25:31 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-16', '2013-04-16') ; 
INSERT INTO `historyutilisateurs` VALUES (450, 268, '09:25:34 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-16', '2013-04-16') ; 
INSERT INTO `historyutilisateurs` VALUES (451, 267, '09:25:36 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-16', '2013-04-16') ; 
INSERT INTO `historyutilisateurs` VALUES (452, 269, '09:25:38 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-16', '2013-04-16') ; 
INSERT INTO `historyutilisateurs` VALUES (453, 270, '09:25:41 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-16', '2013-04-16') ; 
INSERT INTO `historyutilisateurs` VALUES (454, 261, '09:25:43 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-16', '2013-04-16') ; 
INSERT INTO `historyutilisateurs` VALUES (455, 262, '09:25:45 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-16', '2013-04-16') ; 
INSERT INTO `historyutilisateurs` VALUES (456, 265, '09:25:48 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-16', '2013-04-16') ; 
INSERT INTO `historyutilisateurs` VALUES (457, 274, '09:32:50 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-16', '2013-04-16') ; 
INSERT INTO `historyutilisateurs` VALUES (458, 275, '09:32:53 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-16', '2013-04-16') ; 
INSERT INTO `historyutilisateurs` VALUES (459, 275, '09:32:56 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-16', '2013-04-16') ; 
INSERT INTO `historyutilisateurs` VALUES (460, 274, '09:32:59 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-16', '2013-04-16') ; 
INSERT INTO `historyutilisateurs` VALUES (461, 274, '09:34:30 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-16', '2013-04-16') ; 
INSERT INTO `historyutilisateurs` VALUES (462, 275, '09:34:33 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-16', '2013-04-16') ; 
INSERT INTO `historyutilisateurs` VALUES (463, 263, '13:06:50 - Utilisateur mis à jour par LEVAVASSEUR Jacques', '2013-04-16', '2013-04-16') ; 
INSERT INTO `historyutilisateurs` VALUES (464, 274, '11:46:57 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-17', '2013-04-17') ; 
INSERT INTO `historyutilisateurs` VALUES (465, 274, '11:47:03 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-17', '2013-04-17') ; 
INSERT INTO `historyutilisateurs` VALUES (466, 275, '11:47:14 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-17', '2013-04-17') ; 
INSERT INTO `historyutilisateurs` VALUES (467, 274, '11:47:45 - mise à jour d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-17', '2013-04-17') ; 
INSERT INTO `historyutilisateurs` VALUES (468, 274, '11:54:51 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-17', '2013-04-17') ; 
INSERT INTO `historyutilisateurs` VALUES (469, 275, '11:54:54 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-17', '2013-04-17') ; 
INSERT INTO `historyutilisateurs` VALUES (470, 271, '11:55:52 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-17', '2013-04-17') ; 
INSERT INTO `historyutilisateurs` VALUES (471, 271, '11:56:06 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-17', '2013-04-17') ; 
INSERT INTO `historyutilisateurs` VALUES (472, 271, '11:56:11 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-17', '2013-04-17') ; 
INSERT INTO `historyutilisateurs` VALUES (473, 268, '12:19:42 - ajout d\'une dotation', '2013-04-17', '2013-04-17') ; 
INSERT INTO `historyutilisateurs` VALUES (474, 268, '12:20:04 - ajout d\'une dotation', '2013-04-17', '2013-04-17') ; 
INSERT INTO `historyutilisateurs` VALUES (475, 268, '12:20:23 - ajout d\'une dotation', '2013-04-17', '2013-04-17') ; 
INSERT INTO `historyutilisateurs` VALUES (476, 268, '12:20:36 - ajout d\'une dotation', '2013-04-17', '2013-04-17') ; 
INSERT INTO `historyutilisateurs` VALUES (477, 268, '12:20:53 - ajout d\'une dotation', '2013-04-17', '2013-04-17') ; 
INSERT INTO `historyutilisateurs` VALUES (478, 261, '13:27:27 - ajout d\'une dotation', '2013-04-17', '2013-04-17') ; 
INSERT INTO `historyutilisateurs` VALUES (479, 261, '13:27:40 - ajout d\'une dotation', '2013-04-17', '2013-04-17') ; 
INSERT INTO `historyutilisateurs` VALUES (480, 261, '13:27:55 - ajout d\'une dotation', '2013-04-17', '2013-04-17') ; 
INSERT INTO `historyutilisateurs` VALUES (481, 261, '13:28:08 - ajout d\'une dotation', '2013-04-17', '2013-04-17') ; 
INSERT INTO `historyutilisateurs` VALUES (482, 261, '13:28:23 - ajout d\'une dotation', '2013-04-17', '2013-04-17') ; 
INSERT INTO `historyutilisateurs` VALUES (483, 261, '13:28:37 - ajout d\'une dotation', '2013-04-17', '2013-04-17') ; 
INSERT INTO `historyutilisateurs` VALUES (484, 261, '13:28:55 - ajout d\'une dotation', '2013-04-17', '2013-04-17') ; 
INSERT INTO `historyutilisateurs` VALUES (485, 261, '13:29:09 - ajout d\'une dotation', '2013-04-17', '2013-04-17') ; 
INSERT INTO `historyutilisateurs` VALUES (486, 261, '13:29:24 - ajout d\'une dotation', '2013-04-17', '2013-04-17') ; 
INSERT INTO `historyutilisateurs` VALUES (487, 261, '13:29:41 - ajout d\'une dotation', '2013-04-17', '2013-04-17') ; 
INSERT INTO `historyutilisateurs` VALUES (488, 261, '13:29:58 - ajout d\'une dotation', '2013-04-17', '2013-04-17') ; 
INSERT INTO `historyutilisateurs` VALUES (489, 261, '13:30:33 - suppression d\'une dotation', '2013-04-17', '2013-04-17') ; 
INSERT INTO `historyutilisateurs` VALUES (490, 273, '05:22:18 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-18', '2013-04-18') ; 
INSERT INTO `historyutilisateurs` VALUES (491, 172, '05:49:23 - ajout d\'une dotation', '2013-04-18', '2013-04-18') ; 
INSERT INTO `historyutilisateurs` VALUES (492, 172, '05:50:14 - ajout d\'une dotation', '2013-04-18', '2013-04-18') ; 
INSERT INTO `historyutilisateurs` VALUES (493, 172, '05:50:24 - ajout d\'une dotation', '2013-04-18', '2013-04-18') ; 
INSERT INTO `historyutilisateurs` VALUES (494, 172, '05:50:35 - ajout d\'une dotation', '2013-04-18', '2013-04-18') ; 
INSERT INTO `historyutilisateurs` VALUES (495, 172, '05:50:47 - ajout d\'une dotation', '2013-04-18', '2013-04-18') ; 
INSERT INTO `historyutilisateurs` VALUES (496, 172, '05:50:58 - ajout d\'une dotation', '2013-04-18', '2013-04-18') ; 
INSERT INTO `historyutilisateurs` VALUES (497, 172, '05:51:25 - ajout d\'une dotation', '2013-04-18', '2013-04-18') ; 
INSERT INTO `historyutilisateurs` VALUES (498, 172, '05:51:36 - ajout d\'une dotation', '2013-04-18', '2013-04-18') ; 
INSERT INTO `historyutilisateurs` VALUES (499, 172, '05:51:47 - ajout d\'une dotation', '2013-04-18', '2013-04-18') ; 
INSERT INTO `historyutilisateurs` VALUES (500, 172, '05:51:59 - ajout d\'une dotation', '2013-04-18', '2013-04-18') ; 
INSERT INTO `historyutilisateurs` VALUES (501, 172, '05:52:10 - ajout d\'une dotation', '2013-04-18', '2013-04-18') ; 
INSERT INTO `historyutilisateurs` VALUES (502, 172, '06:07:19 - ajout d\'une dotation', '2013-04-18', '2013-04-18') ; 
INSERT INTO `historyutilisateurs` VALUES (503, 172, '06:07:27 - ajout d\'une dotation', '2013-04-18', '2013-04-18') ; 
INSERT INTO `historyutilisateurs` VALUES (504, 172, '06:08:09 - mise à jour de la dotation dotation', '2013-04-18', '2013-04-18') ; 
INSERT INTO `historyutilisateurs` VALUES (505, 172, '06:08:40 - ajout d\'une dotation', '2013-04-18', '2013-04-18') ; 
INSERT INTO `historyutilisateurs` VALUES (506, 172, '06:10:03 - suppression d\'une dotation', '2013-04-18', '2013-04-18') ; 
INSERT INTO `historyutilisateurs` VALUES (507, 265, '06:14:10 - ajout d\'une dotation', '2013-04-18', '2013-04-18') ; 
INSERT INTO `historyutilisateurs` VALUES (508, 265, '06:14:23 - ajout d\'une dotation', '2013-04-18', '2013-04-18') ; 
INSERT INTO `historyutilisateurs` VALUES (509, 265, '06:14:36 - ajout d\'une dotation', '2013-04-18', '2013-04-18') ; 
INSERT INTO `historyutilisateurs` VALUES (510, 265, '06:15:04 - ajout d\'une dotation', '2013-04-18', '2013-04-18') ; 
INSERT INTO `historyutilisateurs` VALUES (511, 265, '06:15:17 - ajout d\'une dotation', '2013-04-18', '2013-04-18') ; 
INSERT INTO `historyutilisateurs` VALUES (512, 265, '06:15:38 - ajout d\'une dotation', '2013-04-18', '2013-04-18') ; 
INSERT INTO `historyutilisateurs` VALUES (513, 265, '06:15:52 - ajout d\'une dotation', '2013-04-18', '2013-04-18') ; 
INSERT INTO `historyutilisateurs` VALUES (514, 265, '06:16:12 - ajout d\'une dotation', '2013-04-18', '2013-04-18') ; 
INSERT INTO `historyutilisateurs` VALUES (515, 265, '06:16:31 - ajout d\'une dotation', '2013-04-18', '2013-04-18') ; 
INSERT INTO `historyutilisateurs` VALUES (516, 265, '06:16:54 - ajout d\'une dotation', '2013-04-18', '2013-04-18') ; 
INSERT INTO `historyutilisateurs` VALUES (517, 265, '06:17:12 - ajout d\'une dotation', '2013-04-18', '2013-04-18') ; 
INSERT INTO `historyutilisateurs` VALUES (518, 265, '06:17:36 - ajout d\'une dotation', '2013-04-18', '2013-04-18') ; 
INSERT INTO `historyutilisateurs` VALUES (519, 265, '06:17:57 - ajout d\'une dotation', '2013-04-18', '2013-04-18') ; 
INSERT INTO `historyutilisateurs` VALUES (520, 265, '06:18:15 - ajout d\'une dotation', '2013-04-18', '2013-04-18') ; 
INSERT INTO `historyutilisateurs` VALUES (521, 268, '06:20:24 - ajout d\'une dotation', '2013-04-18', '2013-04-18') ; 
INSERT INTO `historyutilisateurs` VALUES (522, 268, '06:20:33 - ajout d\'une dotation', '2013-04-18', '2013-04-18') ; 
INSERT INTO `historyutilisateurs` VALUES (523, 268, '06:20:44 - ajout d\'une dotation', '2013-04-18', '2013-04-18') ; 
INSERT INTO `historyutilisateurs` VALUES (524, 268, '06:20:58 - ajout d\'une dotation', '2013-04-18', '2013-04-18') ; 
INSERT INTO `historyutilisateurs` VALUES (525, 268, '06:21:16 - ajout d\'une dotation', '2013-04-18', '2013-04-18') ; 
INSERT INTO `historyutilisateurs` VALUES (526, 268, '06:21:31 - ajout d\'une dotation', '2013-04-18', '2013-04-18') ; 
INSERT INTO `historyutilisateurs` VALUES (527, 268, '06:21:50 - ajout d\'une dotation', '2013-04-18', '2013-04-18') ; 
INSERT INTO `historyutilisateurs` VALUES (528, 172, '06:22:58 - ajout d\'une dotation', '2013-04-18', '2013-04-18') ; 
INSERT INTO `historyutilisateurs` VALUES (529, 261, '06:27:18 - ajout d\'une dotation', '2013-04-18', '2013-04-18') ; 
INSERT INTO `historyutilisateurs` VALUES (530, 261, '06:27:39 - ajout d\'une dotation', '2013-04-18', '2013-04-18') ; 
INSERT INTO `historyutilisateurs` VALUES (531, 261, '06:28:07 - ajout d\'une dotation', '2013-04-18', '2013-04-18') ; 
INSERT INTO `historyutilisateurs` VALUES (532, 268, '06:29:39 - ajout d\'une dotation', '2013-04-18', '2013-04-18') ; 
INSERT INTO `historyutilisateurs` VALUES (533, 202, '05:45:52 - Utilisateur mis à jour par LEVAVASSEUR Jacques', '2013-04-22', '2013-04-22') ; 
INSERT INTO `historyutilisateurs` VALUES (534, 202, '05:46:25 - Utilisateur mis à jour par LEVAVASSEUR Jacques', '2013-04-22', '2013-04-22') ; 
INSERT INTO `historyutilisateurs` VALUES (535, 271, '12:42:11 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-22', '2013-04-22') ; 
INSERT INTO `historyutilisateurs` VALUES (536, 273, '12:42:52 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-22', '2013-04-22') ; 
INSERT INTO `historyutilisateurs` VALUES (537, 271, '12:42:56 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-22', '2013-04-22') ; 
INSERT INTO `historyutilisateurs` VALUES (538, 202, '13:10:03 - Utilisateur mis à jour par LEVAVASSEUR Jacques', '2013-04-22', '2013-04-22') ; 
INSERT INTO `historyutilisateurs` VALUES (539, 202, '13:14:28 - Utilisateur mis à jour par LEVAVASSEUR Jacques', '2013-04-22', '2013-04-22') ; 
INSERT INTO `historyutilisateurs` VALUES (540, 274, '07:01:32 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-23', '2013-04-23') ; 
INSERT INTO `historyutilisateurs` VALUES (541, 275, '07:01:35 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-23', '2013-04-23') ; 
INSERT INTO `historyutilisateurs` VALUES (542, 275, '07:01:38 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-23', '2013-04-23') ; 
INSERT INTO `historyutilisateurs` VALUES (543, 274, '07:01:44 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-04-23', '2013-04-23') ; 
INSERT INTO `historyutilisateurs` VALUES (544, 140, '10:16:01 - Utilisateur mis à jour par LEVAVASSEUR Jacques', '2013-04-25', '2013-04-25') ; 
INSERT INTO `historyutilisateurs` VALUES (545, 276, '07:56:46 - Utilisateur créé par LEVAVASSEUR Jacques', '2013-05-13', '2013-05-13') ; 
INSERT INTO `historyutilisateurs` VALUES (546, 276, '08:19:18 - Utilisateur mis à jour par LEVAVASSEUR Jacques', '2013-05-13', '2013-05-13') ; 
INSERT INTO `historyutilisateurs` VALUES (547, 276, '08:25:54 - ajout d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-05-13', '2013-05-13') ; 
INSERT INTO `historyutilisateurs` VALUES (548, 276, '08:26:13 - ajout d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-05-13', '2013-05-13') ; 
INSERT INTO `historyutilisateurs` VALUES (549, 276, '08:26:32 - ajout d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-05-13', '2013-05-13') ; 
INSERT INTO `historyutilisateurs` VALUES (550, 276, '08:26:42 - ajout d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-05-13', '2013-05-13') ; 
INSERT INTO `historyutilisateurs` VALUES (551, 276, '08:27:04 - ajout d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-05-13', '2013-05-13') ; 
INSERT INTO `historyutilisateurs` VALUES (552, 276, '08:27:17 - ajout d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-05-13', '2013-05-13') ; 
INSERT INTO `historyutilisateurs` VALUES (553, 276, '08:27:41 - ajout d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-05-13', '2013-05-13') ; 
INSERT INTO `historyutilisateurs` VALUES (554, 276, '08:33:22 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-05-13', '2013-05-13') ; 
INSERT INTO `historyutilisateurs` VALUES (555, 276, '08:33:28 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-05-13', '2013-05-13') ; 
INSERT INTO `historyutilisateurs` VALUES (556, 276, '08:33:33 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-05-13', '2013-05-13') ; 
INSERT INTO `historyutilisateurs` VALUES (557, 276, '08:33:36 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-05-13', '2013-05-13') ; 
INSERT INTO `historyutilisateurs` VALUES (558, 276, '08:33:41 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-05-13', '2013-05-13') ; 
INSERT INTO `historyutilisateurs` VALUES (559, 276, '08:33:47 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-05-13', '2013-05-13') ; 
INSERT INTO `historyutilisateurs` VALUES (560, 276, '08:34:56 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-05-13', '2013-05-13') ; 
INSERT INTO `historyutilisateurs` VALUES (561, 277, '09:15:54 - Utilisateur créé par LEVAVASSEUR Jacques', '2013-05-13', '2013-05-13') ; 
INSERT INTO `historyutilisateurs` VALUES (562, 277, '09:16:57 - Utilisateur mis à jour par LEVAVASSEUR Jacques', '2013-05-13', '2013-05-13') ; 
INSERT INTO `historyutilisateurs` VALUES (563, 277, '09:39:46 - ajout d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-05-13', '2013-05-13') ; 
INSERT INTO `historyutilisateurs` VALUES (564, 276, '09:55:30 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-05-13', '2013-05-13') ; 
INSERT INTO `historyutilisateurs` VALUES (565, 277, '09:56:19 - ajout d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-05-13', '2013-05-13') ; 
INSERT INTO `historyutilisateurs` VALUES (566, 277, '09:56:33 - ajout d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-05-13', '2013-05-13') ; 
INSERT INTO `historyutilisateurs` VALUES (567, 277, '09:56:53 - ajout d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-05-13', '2013-05-13') ; 
INSERT INTO `historyutilisateurs` VALUES (568, 277, '09:57:04 - ajout d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-05-13', '2013-05-13') ; 
INSERT INTO `historyutilisateurs` VALUES (569, 277, '09:57:24 - ajout d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-05-13', '2013-05-13') ; 
INSERT INTO `historyutilisateurs` VALUES (570, 277, '10:05:18 - Utilisateur mis à jour par LEVAVASSEUR Jacques', '2013-05-13', '2013-05-13') ; 
INSERT INTO `historyutilisateurs` VALUES (571, 277, '10:05:24 - Utilisateur mis à jour par LEVAVASSEUR Jacques', '2013-05-13', '2013-05-13') ; 
INSERT INTO `historyutilisateurs` VALUES (572, 277, '10:05:38 - Utilisateur mis à jour par LEVAVASSEUR Jacques', '2013-05-13', '2013-05-13') ; 
INSERT INTO `historyutilisateurs` VALUES (573, 276, '10:50:38 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-05-13', '2013-05-13') ; 
INSERT INTO `historyutilisateurs` VALUES (574, 277, '11:06:48 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-05-13', '2013-05-13') ; 
INSERT INTO `historyutilisateurs` VALUES (575, 277, '11:07:05 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-05-13', '2013-05-13') ; 
INSERT INTO `historyutilisateurs` VALUES (576, 276, '11:54:50 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-05-13', '2013-05-13') ; 
INSERT INTO `historyutilisateurs` VALUES (577, 276, '11:54:56 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-05-13', '2013-05-13') ; 
INSERT INTO `historyutilisateurs` VALUES (578, 277, '11:55:01 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-05-13', '2013-05-13') ; 
INSERT INTO `historyutilisateurs` VALUES (579, 277, '11:55:37 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-05-13', '2013-05-13') ; 
INSERT INTO `historyutilisateurs` VALUES (580, 277, '11:55:41 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-05-13', '2013-05-13') ; 
INSERT INTO `historyutilisateurs` VALUES (581, 277, '11:57:00 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-05-13', '2013-05-13') ; 
INSERT INTO `historyutilisateurs` VALUES (582, 277, '11:57:04 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-05-13', '2013-05-13') ; 
INSERT INTO `historyutilisateurs` VALUES (583, 277, '12:05:30 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-05-13', '2013-05-13') ; 
INSERT INTO `historyutilisateurs` VALUES (584, 277, '13:47:58 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-05-13', '2013-05-13') ; 
INSERT INTO `historyutilisateurs` VALUES (585, 230, '14:04:13 - Utilisateur mis à jour par BLANCHET Frédéric', '2013-05-13', '2013-05-13') ; 
INSERT INTO `historyutilisateurs` VALUES (586, 22, '15:32:46 - Utilisateur mis à jour par TRENTO Benoit', '2013-05-13', '2013-05-13') ; 
INSERT INTO `historyutilisateurs` VALUES (587, 5, '07:19:43 - Utilisateur mis à jour par LEVAVASSEUR Jacques', '2013-05-14', '2013-05-14') ; 
INSERT INTO `historyutilisateurs` VALUES (588, 22, '07:21:08 - Utilisateur mis à jour par LEVAVASSEUR Jacques', '2013-05-14', '2013-05-14') ; 
INSERT INTO `historyutilisateurs` VALUES (589, 277, '09:21:15 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-05-14', '2013-05-14') ; 
INSERT INTO `historyutilisateurs` VALUES (590, 276, '11:50:57 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-05-14', '2013-05-14') ; 
INSERT INTO `historyutilisateurs` VALUES (591, 276, '11:50:58 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-05-14', '2013-05-14') ; 
INSERT INTO `historyutilisateurs` VALUES (592, 276, '11:50:58 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-05-14', '2013-05-14') ; 
INSERT INTO `historyutilisateurs` VALUES (593, 276, '11:50:58 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-05-14', '2013-05-14') ; 
INSERT INTO `historyutilisateurs` VALUES (594, 276, '11:50:58 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-05-14', '2013-05-14') ; 
INSERT INTO `historyutilisateurs` VALUES (595, 276, '11:50:59 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-05-14', '2013-05-14') ; 
INSERT INTO `historyutilisateurs` VALUES (596, 276, '11:50:59 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-05-14', '2013-05-14') ; 
INSERT INTO `historyutilisateurs` VALUES (597, 276, '11:50:59 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-05-14', '2013-05-14') ; 
INSERT INTO `historyutilisateurs` VALUES (598, 276, '11:50:59 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-05-14', '2013-05-14') ; 
INSERT INTO `historyutilisateurs` VALUES (599, 276, '11:51:00 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-05-14', '2013-05-14') ; 
INSERT INTO `historyutilisateurs` VALUES (600, 276, '11:51:00 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-05-14', '2013-05-14') ; 
INSERT INTO `historyutilisateurs` VALUES (601, 276, '11:51:00 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-05-14', '2013-05-14') ; 
INSERT INTO `historyutilisateurs` VALUES (602, 276, '11:51:00 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-05-14', '2013-05-14') ; 
INSERT INTO `historyutilisateurs` VALUES (603, 276, '11:51:01 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-05-14', '2013-05-14') ; 
INSERT INTO `historyutilisateurs` VALUES (604, 276, '11:51:01 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-05-14', '2013-05-14') ; 
INSERT INTO `historyutilisateurs` VALUES (605, 276, '11:51:01 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-05-14', '2013-05-14') ; 
INSERT INTO `historyutilisateurs` VALUES (606, 276, '11:51:01 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-05-14', '2013-05-14') ; 
INSERT INTO `historyutilisateurs` VALUES (607, 276, '11:51:02 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-05-14', '2013-05-14') ; 
INSERT INTO `historyutilisateurs` VALUES (608, 276, '11:51:02 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-05-14', '2013-05-14') ; 
INSERT INTO `historyutilisateurs` VALUES (609, 276, '11:51:04 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-05-14', '2013-05-14') ; 
INSERT INTO `historyutilisateurs` VALUES (610, 276, '11:51:04 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-05-14', '2013-05-14') ; 
INSERT INTO `historyutilisateurs` VALUES (611, 276, '11:51:04 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-05-14', '2013-05-14') ; 
INSERT INTO `historyutilisateurs` VALUES (612, 276, '11:51:05 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-05-14', '2013-05-14') ; 
INSERT INTO `historyutilisateurs` VALUES (613, 276, '11:51:05 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-05-14', '2013-05-14') ; 
INSERT INTO `historyutilisateurs` VALUES (614, 276, '11:51:05 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-05-14', '2013-05-14') ; 
INSERT INTO `historyutilisateurs` VALUES (615, 276, '11:51:05 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-05-14', '2013-05-14') ; 
INSERT INTO `historyutilisateurs` VALUES (616, 276, '11:51:06 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-05-14', '2013-05-14') ; 
INSERT INTO `historyutilisateurs` VALUES (617, 276, '11:51:06 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-05-14', '2013-05-14') ; 
INSERT INTO `historyutilisateurs` VALUES (618, 276, '11:51:06 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-05-14', '2013-05-14') ; 
INSERT INTO `historyutilisateurs` VALUES (619, 276, '11:51:06 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-05-14', '2013-05-14') ; 
INSERT INTO `historyutilisateurs` VALUES (620, 276, '11:51:07 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-05-14', '2013-05-14') ; 
INSERT INTO `historyutilisateurs` VALUES (621, 276, '11:51:07 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-05-14', '2013-05-14') ; 
INSERT INTO `historyutilisateurs` VALUES (622, 276, '11:51:07 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-05-14', '2013-05-14') ; 
INSERT INTO `historyutilisateurs` VALUES (623, 276, '11:51:08 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-05-14', '2013-05-14') ; 
INSERT INTO `historyutilisateurs` VALUES (624, 276, '11:51:08 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-05-14', '2013-05-14') ; 
INSERT INTO `historyutilisateurs` VALUES (625, 276, '11:51:08 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-05-14', '2013-05-14') ; 
INSERT INTO `historyutilisateurs` VALUES (626, 276, '11:51:08 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-05-14', '2013-05-14') ; 
INSERT INTO `historyutilisateurs` VALUES (627, 276, '11:51:09 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-05-14', '2013-05-14') ; 
INSERT INTO `historyutilisateurs` VALUES (628, 276, '11:51:09 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-05-14', '2013-05-14') ; 
INSERT INTO `historyutilisateurs` VALUES (629, 276, '11:51:09 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-05-14', '2013-05-14') ; 
INSERT INTO `historyutilisateurs` VALUES (630, 276, '11:51:25 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-05-14', '2013-05-14') ; 
INSERT INTO `historyutilisateurs` VALUES (631, 276, '11:51:28 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-05-14', '2013-05-14') ; 
INSERT INTO `historyutilisateurs` VALUES (632, 276, '11:51:32 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-05-14', '2013-05-14') ; 
INSERT INTO `historyutilisateurs` VALUES (633, 276, '12:36:39 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-05-14', '2013-05-14') ; 
INSERT INTO `historyutilisateurs` VALUES (634, 277, '12:39:22 - ajout d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-05-14', '2013-05-14') ; 
INSERT INTO `historyutilisateurs` VALUES (635, 277, '12:58:09 - suppression d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-05-14', '2013-05-14') ; 
INSERT INTO `historyutilisateurs` VALUES (636, 277, '12:58:28 - ajout d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-05-14', '2013-05-14') ; 
INSERT INTO `historyutilisateurs` VALUES (637, 14, '14:04:54 - Utilisateur mis à jour par THIAULT Hugues', '2013-05-14', '2013-05-14') ; 
INSERT INTO `historyutilisateurs` VALUES (638, 22, '14:05:37 - Utilisateur mis à jour par TRENTO Benoit', '2013-05-14', '2013-05-14') ; 
INSERT INTO `historyutilisateurs` VALUES (639, 277, '07:44:29 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-05-15', '2013-05-15') ; 
INSERT INTO `historyutilisateurs` VALUES (640, 277, '07:44:43 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-05-15', '2013-05-15') ; 
INSERT INTO `historyutilisateurs` VALUES (641, 6, '12:22:47 - Utilisateur mis à jour par BURIAND Magali', '2013-05-15', '2013-05-15') ; 
INSERT INTO `historyutilisateurs` VALUES (642, 202, '08:40:52 - Utilisateur mis à jour par LEVAVASSEUR Jacques', '2013-05-16', '2013-05-16') ; 
INSERT INTO `historyutilisateurs` VALUES (643, 276, '08:56:53 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-05-16', '2013-05-16') ; 
INSERT INTO `historyutilisateurs` VALUES (644, 277, '09:14:12 - changement d\'état d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-05-16', '2013-05-16') ; 
INSERT INTO `historyutilisateurs` VALUES (645, 7, '09:32:46 - Utilisateur mis à jour par GEOFFROY Sabine', '2013-05-16', '2013-05-16') ; 
INSERT INTO `historyutilisateurs` VALUES (646, 63, '13:47:24 - Utilisateur mis à jour par LEVAVASSEUR Jacques', '2013-05-16', '2013-05-16') ; 
INSERT INTO `historyutilisateurs` VALUES (647, 230, '09:33:27 - Utilisateur mis à jour par BLANCHET Frédéric', '2013-05-17', '2013-05-17') ; 
INSERT INTO `historyutilisateurs` VALUES (648, 14, '10:47:06 - ajout d\'une dotation', '2013-05-21', '2013-05-21') ; 
INSERT INTO `historyutilisateurs` VALUES (649, 278, '14:55:38 - Utilisateur créé par LEVAVASSEUR Jacques', '2013-05-21', '2013-05-21') ; 
INSERT INTO `historyutilisateurs` VALUES (650, 278, '14:58:03 - Utilisateur mis à jour par LEVAVASSEUR Jacques', '2013-05-21', '2013-05-21') ; 
INSERT INTO `historyutilisateurs` VALUES (651, 278, '15:16:30 - Utilisateur mis à jour par LEVAVASSEUR Jacques', '2013-05-21', '2013-05-21') ; 
INSERT INTO `historyutilisateurs` VALUES (652, 278, '15:16:50 - ajout d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-05-21', '2013-05-21') ; 
INSERT INTO `historyutilisateurs` VALUES (653, 278, '15:17:01 - ajout d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-05-21', '2013-05-21') ; 
INSERT INTO `historyutilisateurs` VALUES (654, 278, '15:17:13 - ajout d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-05-21', '2013-05-21') ; 
INSERT INTO `historyutilisateurs` VALUES (655, 278, '15:17:24 - ajout d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-05-21', '2013-05-21') ; 
INSERT INTO `historyutilisateurs` VALUES (656, 278, '15:17:42 - ajout d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-05-21', '2013-05-21') ; 
INSERT INTO `historyutilisateurs` VALUES (657, 278, '15:18:01 - ajout d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-05-21', '2013-05-21') ; 
INSERT INTO `historyutilisateurs` VALUES (658, 278, '15:18:13 - ajout d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-05-21', '2013-05-21') ; 
INSERT INTO `historyutilisateurs` VALUES (659, 278, '15:18:26 - ajout d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-05-21', '2013-05-21') ; 
INSERT INTO `historyutilisateurs` VALUES (660, 279, '15:20:10 - Utilisateur créé par LEVAVASSEUR Jacques', '2013-05-21', '2013-05-21') ; 
INSERT INTO `historyutilisateurs` VALUES (661, 279, '15:21:50 - Utilisateur mis à jour par LEVAVASSEUR Jacques', '2013-05-21', '2013-05-21') ; 
INSERT INTO `historyutilisateurs` VALUES (662, 279, '15:22:20 - ajout d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-05-21', '2013-05-21') ; 
INSERT INTO `historyutilisateurs` VALUES (663, 279, '15:22:31 - ajout d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-05-21', '2013-05-21') ; 
INSERT INTO `historyutilisateurs` VALUES (664, 279, '15:22:44 - ajout d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-05-21', '2013-05-21') ; 
INSERT INTO `historyutilisateurs` VALUES (665, 279, '15:22:54 - ajout d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-05-21', '2013-05-21') ; 
INSERT INTO `historyutilisateurs` VALUES (666, 279, '15:23:13 - ajout d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-05-21', '2013-05-21') ; 
INSERT INTO `historyutilisateurs` VALUES (667, 279, '15:23:24 - ajout d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-05-21', '2013-05-21') ; 
INSERT INTO `historyutilisateurs` VALUES (668, 279, '15:23:39 - ajout d\'une ouverture de droit par LEVAVASSEUR Jacques', '2013-05-21', '2013-05-21') ;
#
# End of data contents of table historyutilisateurs
# --------------------------------------------------------

# WordPress : buffernow.com MySQL database backup
#
# Generated: Thursday 23. May 2013 19:38 CEST
# Hostname: localhost
# Database: `saill_200`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `achats`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `actions`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `actionslivrables`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `activites`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `activitesreelles`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `affectations`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `assistances`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `autorisations`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `contrats`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `detailplancharges`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `domaines`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `dossierpartages`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `dotations`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `facturations`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `historyactions`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `historybudgets`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `historyutilisateurs`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `linkshareds`
# --------------------------------------------------------


#
# Delete any existing table `linkshareds`
#

DROP TABLE IF EXISTS `linkshareds`;


#
# Table structure of table `linkshareds`
#

CREATE TABLE `linkshareds` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `utilisateur_id` int(15) NOT NULL,
  `NOM` varchar(255) CHARACTER SET latin1 NOT NULL,
  `LINK` text CHARACTER SET latin1,
  `created` date NOT NULL,
  `modified` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 ;

#
# Data contents of table linkshareds (14 records)
#
 
INSERT INTO `linkshareds` VALUES (1, 1, 'MINIDOC OSMOSE', 'http://dsite.minidoc.sncf.fr/defaultOSMOSE.asp', '2013-02-01', '2013-02-01') ; 
INSERT INTO `linkshareds` VALUES (2, 1, 'Quality Center', 'http://quality-center.dsit.sncf.fr/qcbin/', '2013-02-01', '2013-02-01') ; 
INSERT INTO `linkshareds` VALUES (3, 1, 'Outils congés agents SNCF', 'https://conges.rh.sncf.fr/auth.php?etat=nocookie', '2013-02-01', '2013-02-01') ; 
INSERT INTO `linkshareds` VALUES (4, 1, 'Service général', 'https://services.ddet.sncf.fr', '2013-02-01', '2013-02-01') ; 
INSERT INTO `linkshareds` VALUES (5, 1, 'Gare en mouvement Part-Dieu', 'http://www.gares-en-mouvement.com/fr/frlpd/horaires-temps-reel/dep/', '2013-02-01', '2013-02-01') ; 
INSERT INTO `linkshareds` VALUES (6, 1, 'DSIPEDIA', 'http://dsipedia.sncf.fr/index.php?title=Accueil', '2013-02-01', '2013-02-01') ; 
INSERT INTO `linkshareds` VALUES (7, 1, 'OSMOSE Flash actu', 'http://www9.mt.sncf.fr/osmose/index.php', '2013-02-01', '2013-02-01') ; 
INSERT INTO `linkshareds` VALUES (8, 1, 'Achats accord cadre', 'http://rcc.achats.sncf.fr/AppCmd/MnuApp.asp', '2013-02-01', '2013-02-01') ; 
INSERT INTO `linkshareds` VALUES (9, 1, 'ERP achats/GALILEI', 'https://www.erp.sncf.fr/psp/FPROD/?cmd=login&languageCd=FRA&', '2013-02-01', '2013-02-01') ; 
INSERT INTO `linkshareds` VALUES (11, 1, 'ORIC', 'http://oric.sg.sncf.fr/Default.aspx', '2013-02-01', '2013-02-01') ; 
INSERT INTO `linkshareds` VALUES (12, 1, 'OWA', 'https://webmail.sncf.fr/owa/auth/logon.aspx?replaceCurrent=1&url=https%3a%2f%2fwebmail.sncf.fr%2fowa%2f', '2013-02-01', '2013-02-01') ; 
INSERT INTO `linkshareds` VALUES (13, 1, 'Password reset manager', 'https://consolearw.ad.sncf.fr/PRMSelfService/main.asp?LCID=fr', '2013-02-01', '2013-02-01') ; 
INSERT INTO `linkshareds` VALUES (14, 1, 'Intranet SNCF', 'http://www.int.sncf.fr/', '2013-04-25', '2013-04-25') ; 
INSERT INTO `linkshareds` VALUES (15, 5, 'Portail des environnements', 'http://env-architecture.osmose.dsit.sncf.fr/OsmosePortail/index.gsp', '2013-05-13', '2013-05-13') ;
#
# End of data contents of table linkshareds
# --------------------------------------------------------

# WordPress : buffernow.com MySQL database backup
#
# Generated: Thursday 23. May 2013 19:38 CEST
# Hostname: localhost
# Database: `saill_200`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `achats`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `actions`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `actionslivrables`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `activites`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `activitesreelles`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `affectations`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `assistances`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `autorisations`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `contrats`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `detailplancharges`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `domaines`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `dossierpartages`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `dotations`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `facturations`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `historyactions`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `historybudgets`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `historyutilisateurs`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `linkshareds`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `listediffusions`
# --------------------------------------------------------


#
# Delete any existing table `listediffusions`
#

DROP TABLE IF EXISTS `listediffusions`;


#
# Table structure of table `listediffusions`
#

CREATE TABLE `listediffusions` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `utilisateur_id` int(15) DEFAULT NULL,
  `NOM` varchar(255) CHARACTER SET latin1 NOT NULL,
  `DESCRIPTION` longtext CHARACTER SET latin1,
  `created` date NOT NULL,
  `modified` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8 ;

#
# Data contents of table listediffusions (35 records)
#
 
INSERT INTO `listediffusions` VALUES (1, NULL, '*OSMOSE DSI-T', 'Ajouter tous les agents SNCF de DSIT qui sont sur le projet', '2013-02-01', '2013-02-01') ; 
INSERT INTO `listediffusions` VALUES (2, NULL, '*OSMOSE DSI-T Architecture', 'Ajouter les personnes du domaine ARCHITECTURE', '2013-02-01', '2013-02-01') ; 
INSERT INTO `listediffusions` VALUES (3, NULL, '*OSMOSE DSI-T COHERENCE', 'Ajouter les personnes travaillant sur COHERENCE', '2013-02-01', '2013-02-01') ; 
INSERT INTO `listediffusions` VALUES (4, NULL, '*OSMOSE DSI-T Elargie', 'Ajouter tous les agents SNCF et prestataires de DSIT', '2013-02-01', '2013-02-01') ; 
INSERT INTO `listediffusions` VALUES (5, NULL, '*OSMOSE DSI-T Gestion Environnement', 'Géré par la liste *OCO Intégration', '2013-02-01', '2013-02-01') ; 
INSERT INTO `listediffusions` VALUES (6, NULL, '*OSMOSE DSI-T Gestion Exigences', 'Ajouter les personnes travaillant sur le domaine EXIGENCES', '2013-02-01', '2013-02-01') ; 
INSERT INTO `listediffusions` VALUES (7, NULL, '*OSMOSE DSI-T GMAO', 'Ajouter les personnes du domaine GMAO', '2013-02-01', '2013-02-01') ; 
INSERT INTO `listediffusions` VALUES (8, NULL, '*OSMOSE DSI-T Intégration', 'Géré par la liste *OCO Intégration', '2013-02-01', '2013-02-01') ; 
INSERT INTO `listediffusions` VALUES (9, NULL, '*OSMOSE DSI-T Interfaces', 'Ajouter les personnes du domaine INTERFACES', '2013-02-01', '2013-02-01') ; 
INSERT INTO `listediffusions` VALUES (10, NULL, '*OSMOSE DSI-T Logistique', 'Ajouter les personnes en gestion de la logistique', '2013-02-01', '2013-02-01') ; 
INSERT INTO `listediffusions` VALUES (11, NULL, '*OSMOSE DSI-T MCO', 'Ajouter les personnes en charge du domaine MCO', '2013-02-01', '2013-02-01') ; 
INSERT INTO `listediffusions` VALUES (12, NULL, '*OSMOSE DSI-T ORCHESTRAL', 'Ajouter les personnes qui ont la charge du domaine ORCHESTRAL', '2013-02-01', '2013-02-01') ; 
INSERT INTO `listediffusions` VALUES (13, NULL, '*OSMOSE DSI-T OSMOVISION', 'Ajouter les personnes qui ont la charge de OSMOVISION', '2013-02-01', '2013-02-01') ; 
INSERT INTO `listediffusions` VALUES (14, NULL, '*OSMOSE DSI-T PANAM', 'Ajouter les personne du projet PANAM', '2013-02-01', '2013-02-01') ; 
INSERT INTO `listediffusions` VALUES (15, NULL, '*OSMOSE DSI-T PANAM MC', 'Ajouter les personne du projet PANAM de DSIT-EC', '2013-02-01', '2013-02-01') ; 
INSERT INTO `listediffusions` VALUES (16, NULL, '*OSMOSE DSI-T Pilotage', 'Ajouter les pilotes du projet', '2013-02-01', '2013-02-01') ; 
INSERT INTO `listediffusions` VALUES (17, NULL, '*OSMOSE DSI-T PMO', 'Ajouter les pilotes et ceux qui s\'occupe de la planification du projet', '2013-02-01', '2013-02-01') ; 
INSERT INTO `listediffusions` VALUES (18, NULL, '*OSMOSE DSI-T Production', 'Géré par la liste *OSMOSE Production', '2013-02-01', '2013-02-01') ; 
INSERT INTO `listediffusions` VALUES (19, NULL, '*OSMOSE DSI-T PUMA', 'Ajouter les personnes en relation avec PUMA', '2013-02-01', '2013-02-01') ; 
INSERT INTO `listediffusions` VALUES (20, NULL, '*OSMOSE DSI-T Reprise de Données', 'Ajouter les personne en charge du domaine REPRISE DE DONNEES', '2013-02-01', '2013-02-01') ; 
INSERT INTO `listediffusions` VALUES (21, NULL, '*OSMOSE DSI-T T-RESEAU', 'Ajouter les personnes en charge du réseau', '2013-02-01', '2013-02-01') ; 
INSERT INTO `listediffusions` VALUES (22, NULL, '*OSMOSE Fiabilisation', 'Ajouter les personnes en charge de la fiabilisation', '2013-02-01', '2013-02-01') ; 
INSERT INTO `listediffusions` VALUES (23, NULL, '*OSMOSE Infos Opérationnelles', 'Ajouter les personnes en charge des infos opérationnelles', '2013-02-01', '2013-02-01') ; 
INSERT INTO `listediffusions` VALUES (24, NULL, '*OSMOSE Intégrateur Chefs de Projet', 'Liste de diffusion à disposition de l\'intégrateur', '2013-02-01', '2013-02-01') ; 
INSERT INTO `listediffusions` VALUES (25, NULL, '*OSMOSE Intégrateur Direction Programme', 'Liste de diffusion à disposition de l\'intégrateur', '2013-02-01', '2013-02-01') ; 
INSERT INTO `listediffusions` VALUES (26, NULL, '*OSMOSE Intégrateur GMAO', 'Liste de diffusion à disposition de l\'intégrateur', '2013-02-01', '2013-02-01') ; 
INSERT INTO `listediffusions` VALUES (27, NULL, '*OSMOSE Intégrateur GMAO Fonc', 'Liste de diffusion à disposition de l\'intégrateur', '2013-02-01', '2013-02-01') ; 
INSERT INTO `listediffusions` VALUES (28, NULL, '*OSMOSE Intégrateur GMAO Tech', 'Liste de diffusion à disposition de l\'intégrateur', '2013-02-01', '2013-02-01') ; 
INSERT INTO `listediffusions` VALUES (29, NULL, '*OSMOSE Intégrateur PANAM', 'Liste de diffusion à disposition de l\'intégrateur', '2013-02-01', '2013-02-01') ; 
INSERT INTO `listediffusions` VALUES (30, NULL, '*OSMOSE Intégrateur PMO', 'Liste de diffusion à disposition de l\'intégrateur', '2013-02-01', '2013-02-01') ; 
INSERT INTO `listediffusions` VALUES (31, NULL, '*OSMOSE Intégrateur Sogeti', 'Liste de diffusion à disposition de l\'intégrateur', '2013-02-01', '2013-02-01') ; 
INSERT INTO `listediffusions` VALUES (32, NULL, '*OSMOSE Intégrateur Technique', 'Liste de diffusion à disposition de l\'intégrateur', '2013-02-01', '2013-02-01') ; 
INSERT INTO `listediffusions` VALUES (33, NULL, '*OSMOSE Intégrateur Tous', 'Liste de diffusion à disposition de l\'intégrateur', '2013-02-01', '2013-02-01') ; 
INSERT INTO `listediffusions` VALUES (34, NULL, '*OSMOSE DSI-T Ordonnancement', 'Ajouter les personnes gérant l\'ordonnancement du programme OSMOSE', '2013-02-01', '2013-02-01') ; 
INSERT INTO `listediffusions` VALUES (35, NULL, '*DSI-T/SO OSMOSE Intégrateur GMAO MCO ', 'Liste de diffusion à disposition de l\'intégrateur', '2013-02-01', '2013-02-01') ;
#
# End of data contents of table listediffusions
# --------------------------------------------------------

# WordPress : buffernow.com MySQL database backup
#
# Generated: Thursday 23. May 2013 19:38 CEST
# Hostname: localhost
# Database: `saill_200`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `achats`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `actions`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `actionslivrables`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `activites`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `activitesreelles`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `affectations`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `assistances`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `autorisations`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `contrats`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `detailplancharges`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `domaines`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `dossierpartages`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `dotations`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `facturations`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `historyactions`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `historybudgets`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `historyutilisateurs`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `linkshareds`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `listediffusions`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `livrables`
# --------------------------------------------------------


#
# Delete any existing table `livrables`
#

DROP TABLE IF EXISTS `livrables`;


#
# Table structure of table `livrables`
#

CREATE TABLE `livrables` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `utilisateur_id` int(15) DEFAULT NULL,
  `NOM` varchar(255) CHARACTER SET latin1 NOT NULL,
  `REFERENCE` varchar(45) DEFAULT NULL,
  `ECHEANCE` date NOT NULL,
  `DATELIVRAISON` date DEFAULT NULL,
  `DATEVALIDATION` date DEFAULT NULL,
  `ETAT` enum('à faire','en cours','validé','livré','refusé','annulé') NOT NULL,
  `COMMENTAIRE` text,
  `VERSION` varchar(5) DEFAULT NULL,
  `created` date NOT NULL,
  `modified` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ;

#
# Data contents of table livrables (2 records)
#
 
INSERT INTO `livrables` VALUES (1, 5, 'Outil OSACT V2', '', '2013-05-13', '2013-05-15', '2013-05-15', 'validé', 'Application opérationnelle le 27/03/2013<br />Attente de faire la démonstration aux chefs de sections pour validation<br />Mise en service sur un périmètre réduit avant une mise en service à tout le projet<br />Réunion de présentation et de lancement le 14/05/2013 à l\'issue de la réunion quelques personnes pourront utiliser l\'outil en test avant un déploiement à tout le projet.', '', '2013-03-27', '2013-05-21') ; 
INSERT INTO `livrables` VALUES (2, 5, 'Outil OSACT V2.1', '', '2013-09-05', '2013-09-05', '2013-08-29', 'en cours', 'Dans cette version ajouter un module pour :<br />
<ul>
<li>Génération de rapports au format PDF</li>
<li>Apporter quelques améliorations remontées par les utilisateurs (<span style="background-color: #ffff00;">sur cette version ou une autre version pour un peu plus tard</span>) pour la rentrée par exemple</li>
</ul>', '', '2013-03-27', '2013-05-22') ;
#
# End of data contents of table livrables
# --------------------------------------------------------

# WordPress : buffernow.com MySQL database backup
#
# Generated: Thursday 23. May 2013 19:38 CEST
# Hostname: localhost
# Database: `saill_200`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `achats`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `actions`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `actionslivrables`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `activites`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `activitesreelles`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `affectations`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `assistances`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `autorisations`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `contrats`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `detailplancharges`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `domaines`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `dossierpartages`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `dotations`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `facturations`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `historyactions`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `historybudgets`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `historyutilisateurs`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `linkshareds`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `listediffusions`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `livrables`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `mailtemplates`
# --------------------------------------------------------


#
# Delete any existing table `mailtemplates`
#

DROP TABLE IF EXISTS `mailtemplates`;


#
# Table structure of table `mailtemplates`
#

CREATE TABLE `mailtemplates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `NOM` varchar(255) NOT NULL,
  `OBJET` varchar(255) NOT NULL,
  `CORPS` text NOT NULL,
  `DESTINATAIRE` text,
  `CORRESPONDANCE` text NOT NULL,
  `ENVOISAUTO` tinyint(1) DEFAULT '0',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ;

#
# Data contents of table mailtemplates (0 records)
#

#
# End of data contents of table mailtemplates
# --------------------------------------------------------

# WordPress : buffernow.com MySQL database backup
#
# Generated: Thursday 23. May 2013 19:38 CEST
# Hostname: localhost
# Database: `saill_200`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `achats`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `actions`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `actionslivrables`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `activites`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `activitesreelles`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `affectations`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `assistances`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `autorisations`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `contrats`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `detailplancharges`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `domaines`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `dossierpartages`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `dotations`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `facturations`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `historyactions`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `historybudgets`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `historyutilisateurs`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `linkshareds`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `listediffusions`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `livrables`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `mailtemplates`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `materielinformatiques`
# --------------------------------------------------------


#
# Delete any existing table `materielinformatiques`
#

DROP TABLE IF EXISTS `materielinformatiques`;


#
# Table structure of table `materielinformatiques`
#

CREATE TABLE `materielinformatiques` (
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=167 DEFAULT CHARSET=utf8 ;

#
# Data contents of table materielinformatiques (165 records)
#
 
INSERT INTO `materielinformatiques` VALUES (1, 2, 2, 1, 'P64L03BIBBU', 'En dotation', 0, 1, 'Attribué à Jacques LEVAVASSEUR le 01/01/2010', '2013-02-01', '2013-03-27') ; 
INSERT INTO `materielinformatiques` VALUES (2, 2, 1, 1, 'P64L03BIB72', 'En dotation', 1, 0, '', '2013-02-01', '2013-03-27') ; 
INSERT INTO `materielinformatiques` VALUES (3, 2, 1, 1, 'P64L03BIBTE', 'En dotation', 1, 0, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `materielinformatiques` VALUES (4, 2, 1, 1, 'P64L03BIBV7', 'En dotation', 1, 0, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `materielinformatiques` VALUES (5, 2, 1, 1, 'P64L03BIBYK', 'En dotation', 0, 0, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `materielinformatiques` VALUES (6, 2, 1, 1, 'P64CLLBIASB', 'En dotation', 1, 0, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `materielinformatiques` VALUES (7, 2, 1, 1, 'P64L03BIBRQ', 'En dotation', 1, 1, '', '2013-02-01', '2013-03-27') ; 
INSERT INTO `materielinformatiques` VALUES (8, 2, 1, 1, 'P64L03BIBUJ', 'En stock', 0, 1, '', '2013-02-01', '2013-03-27') ; 
INSERT INTO `materielinformatiques` VALUES (9, 2, 1, 1, 'P64L03BIB3O', 'En dotation', 0, 0, '', '2013-02-01', '2013-03-27') ; 
INSERT INTO `materielinformatiques` VALUES (10, 1, 1, 1, 'P64L03BIB5V', 'En dotation', 0, 0, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `materielinformatiques` VALUES (11, 2, 1, 1, 'P64L03BIBYZ', 'En dotation', 1, 1, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `materielinformatiques` VALUES (12, 2, 2, 1, 'P64L03BIB??', 'En dotation', 1, 1, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `materielinformatiques` VALUES (13, 2, 1, 1, 'P64L03BIB7Y', 'En dotation', 0, 0, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `materielinformatiques` VALUES (14, 2, 4, 1, 'P64CLLBIAUL', 'En dotation', 0, 0, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `materielinformatiques` VALUES (15, 2, 1, 1, 'P64CLLBIAZB', 'En dotation', 1, 0, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `materielinformatiques` VALUES (16, 2, 4, 1, 'P64CLLBIAZC', 'En dotation', 1, 1, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `materielinformatiques` VALUES (17, 2, 4, 1, 'P64CLLBIAZD', 'En dotation', 0, 0, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `materielinformatiques` VALUES (18, 2, 4, 1, 'P64CLLBIB1W', 'En dotation', 0, 0, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `materielinformatiques` VALUES (19, 2, 4, 1, 'P64L03BIBOS', 'En dotation', 0, 0, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `materielinformatiques` VALUES (20, 2, 4, 1, 'P64CLLMV408', 'En stock', 0, 0, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `materielinformatiques` VALUES (21, 1, 4, 2, 'P71P12DMBV0', 'Non localisé', 0, 0, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `materielinformatiques` VALUES (22, 1, 4, 2, 'P71P12DMBVN', 'En stock', 0, 0, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `materielinformatiques` VALUES (23, 1, 1, 1, 'P64L03BIB4L', 'En dotation', 0, 0, 'Attribué à BEYDON Stéphane le 27/03/2013', '0000-00-00', '2013-04-04') ; 
INSERT INTO `materielinformatiques` VALUES (24, 1, 4, 2, 'P71P12DMBW5', 'En stock', 0, 0, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `materielinformatiques` VALUES (25, 1, 4, 2, 'P71P12DMBW7', 'Non localisé', 0, 0, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `materielinformatiques` VALUES (26, 1, 4, 2, 'P71P12DMBXN', 'En dotation', 0, 0, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `materielinformatiques` VALUES (27, 1, 4, 2, 'P71P12DMBXO', 'En stock', 0, 0, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `materielinformatiques` VALUES (28, 2, 1, 2, 'P71P12DMC5X', 'En dotation', 1, 1, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `materielinformatiques` VALUES (29, 2, 4, 2, 'P71P12DMC5Y', 'En dotation', 1, 0, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `materielinformatiques` VALUES (30, 2, 4, 2, 'P71P12DMC5Z', 'En dotation', 1, 0, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `materielinformatiques` VALUES (31, 1, 4, 2, 'P71P12DMC84', 'En stock', 0, 0, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `materielinformatiques` VALUES (32, 1, 4, 2, 'P71P12DMC86', 'Non localisé', 0, 0, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `materielinformatiques` VALUES (33, 1, 4, 2, 'P71P12DMC87', 'En stock', 0, 0, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `materielinformatiques` VALUES (34, 1, 4, 2, 'P71P12DMC88', 'En dotation', 0, 0, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `materielinformatiques` VALUES (35, 1, 4, 2, 'P71P12DMC89', 'En dotation', 0, 0, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `materielinformatiques` VALUES (36, 1, 4, 2, 'P71P12DMC8A', 'En dotation', 0, 0, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `materielinformatiques` VALUES (37, 2, 4, 2, 'P71P12DMC8D', 'En dotation', 1, 0, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `materielinformatiques` VALUES (38, 2, 4, 2, 'P71P12DMC8F', 'En dotation', 0, 0, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `materielinformatiques` VALUES (39, 2, 4, 1, 'P64VBIBIA4Y', 'Au rebut', 0, 0, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `materielinformatiques` VALUES (40, 2, 4, 2, 'P71P12DMC8J', 'En dotation', 1, 0, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `materielinformatiques` VALUES (41, 1, 4, 2, 'P71P12DMCCB', 'En stock', 0, 0, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `materielinformatiques` VALUES (42, 1, 4, 2, 'P71P12DMCCD', 'En dotation', 0, 0, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `materielinformatiques` VALUES (43, 1, 4, 2, 'P71P12DMCCE', 'En dotation', 0, 0, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `materielinformatiques` VALUES (44, 1, 4, 2, 'P71P12DMCCF', 'En dotation', 0, 0, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `materielinformatiques` VALUES (45, 1, 4, 2, 'P71P12DMCCG', 'En dotation', 0, 0, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `materielinformatiques` VALUES (46, 1, 4, 2, 'P71P12DMCCI', 'En dotation', 0, 0, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `materielinformatiques` VALUES (47, 1, 4, 2, 'P71P12DMCCC', 'En stock', 0, 0, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `materielinformatiques` VALUES (48, 1, 4, 2, 'P71P12DMCCH', 'En dotation', 0, 0, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `materielinformatiques` VALUES (49, 1, 4, 2, 'P71P12DMCDM', 'En dotation', 0, 0, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `materielinformatiques` VALUES (50, 1, 4, 2, 'P71P12DMCDO', 'En stock', 0, 0, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `materielinformatiques` VALUES (51, 1, 4, 2, 'P71P12DMCDS', 'En dotation', 0, 0, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `materielinformatiques` VALUES (52, 1, 4, 2, 'P71P12DMCDL', 'En dotation', 0, 0, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `materielinformatiques` VALUES (53, 1, 4, 2, 'P71P12DMCDT', 'En dotation', 0, 0, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `materielinformatiques` VALUES (54, 1, 4, 2, 'P71P12DMCDQ', 'En stock', 0, 0, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `materielinformatiques` VALUES (55, 1, 4, 2, 'P71P12DMCDK', 'En dotation', 0, 0, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `materielinformatiques` VALUES (56, 1, 4, 2, 'P71P12DMCDR', 'En stock', 0, 0, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `materielinformatiques` VALUES (57, 2, 2, 1, 'P64L03BIBV5', 'En dotation', 0, 1, '', '2013-02-01', '2013-03-27') ; 
INSERT INTO `materielinformatiques` VALUES (58, 1, 4, 1, 'P64L03BIB6W', 'En dotation', 0, 0, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `materielinformatiques` VALUES (59, 1, 4, 1, 'P64L03BIB4J', 'En dotation', 0, 0, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `materielinformatiques` VALUES (60, 1, 4, 2, 'P71P12DMCM0', 'En stock', 0, 0, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `materielinformatiques` VALUES (61, 1, 4, 2, 'P71P12DMCMM', 'En dotation', 0, 0, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `materielinformatiques` VALUES (62, 1, 4, 2, 'P71P12DMCMN', 'En stock', 0, 0, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `materielinformatiques` VALUES (63, 1, 4, 2, 'P71P12DMCMP', 'En dotation', 0, 0, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `materielinformatiques` VALUES (64, 1, 4, 2, 'P71P12DMCMQ', 'En stock', 0, 0, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `materielinformatiques` VALUES (65, 1, 4, 2, 'P71P12DMCMR', 'En stock', 0, 0, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `materielinformatiques` VALUES (66, 1, 4, 2, 'P71P12DMCMS', 'En dotation', 0, 0, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `materielinformatiques` VALUES (67, 1, 4, 2, 'P71P12DMCMT', 'En dotation', 0, 0, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `materielinformatiques` VALUES (68, 1, 4, 2, 'P71P12DMCMU', 'En dotation', 0, 0, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `materielinformatiques` VALUES (69, 1, 4, 2, 'P71P12DMCMV', 'En stock', 0, 0, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `materielinformatiques` VALUES (70, 2, 1, 1, 'P64L03BID3L', 'En dotation', 0, 0, '', '2013-02-01', '2013-03-27') ; 
INSERT INTO `materielinformatiques` VALUES (71, 2, 2, 1, 'P64L03BIC4B', 'En dotation', 0, 1, '', '2013-02-01', '2013-03-27') ; 
INSERT INTO `materielinformatiques` VALUES (72, 2, 4, 1, 'P64L03BIB77', 'En dotation', 1, 0, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `materielinformatiques` VALUES (73, 2, 4, 1, 'P64L03BIB3Q', 'En dotation', 0, 0, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `materielinformatiques` VALUES (74, 1, 4, 2, 'P71P12DMCQO', 'En dotation', 0, 0, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `materielinformatiques` VALUES (75, 1, 4, 2, 'P71P12DMCQP', 'En stock', 0, 0, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `materielinformatiques` VALUES (76, 1, 4, 2, 'P71P12DMCQR', 'En dotation', 0, 0, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `materielinformatiques` VALUES (77, 1, 4, 2, 'P71P12DMCQT', 'En dotation', 0, 0, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `materielinformatiques` VALUES (78, 1, 4, 2, 'P71P12DMCQV', 'En stock', 0, 0, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `materielinformatiques` VALUES (79, 1, 4, 2, 'P71P12DMCQW', 'En dotation', 0, 0, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `materielinformatiques` VALUES (80, 1, 4, 2, 'P71P12DMCQX', 'En dotation', 0, 0, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `materielinformatiques` VALUES (81, 1, 4, 2, 'P71P12DMCQY', 'En dotation', 0, 0, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `materielinformatiques` VALUES (82, 1, 4, 2, 'P71P12DMCQZ', 'En dotation', 0, 0, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `materielinformatiques` VALUES (83, 1, 4, 2, 'P71P12DMCR0', 'En dotation', 0, 0, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `materielinformatiques` VALUES (84, 1, 4, 2, 'P71P12DMCR1', 'En dotation', 0, 0, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `materielinformatiques` VALUES (85, 1, 4, 2, 'P71P12DMCR2', 'En stock', 0, 0, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `materielinformatiques` VALUES (86, 1, 4, 1, 'P64L03BIB42', 'En dotation', 0, 0, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `materielinformatiques` VALUES (87, 1, 4, 1, 'P64L03BIBQL', 'En dotation', 0, 0, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `materielinformatiques` VALUES (88, 1, 4, 2, 'P71P12DMCV9', 'En dotation', 0, 0, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `materielinformatiques` VALUES (89, 1, 4, 2, 'P71P12DMCVA', 'En dotation', 0, 0, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `materielinformatiques` VALUES (90, 1, 4, 2, 'P71P12DMCVB', 'En stock', 0, 0, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `materielinformatiques` VALUES (91, 1, 4, 2, 'P71P12DMCVC', 'En stock', 0, 0, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `materielinformatiques` VALUES (92, 1, 4, 2, 'P71P12DMCVD', 'En stock', 0, 0, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `materielinformatiques` VALUES (93, 1, 4, 2, 'P71P12DMCVE', 'En dotation', 0, 0, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `materielinformatiques` VALUES (94, 1, 4, 2, 'P71P12DMCVF', 'En dotation', 0, 0, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `materielinformatiques` VALUES (95, 1, 4, 2, 'P71P12DMCVH', 'En dotation', 0, 0, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `materielinformatiques` VALUES (96, 1, 4, 2, 'P71P12DMCVI', 'En dotation', 0, 0, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `materielinformatiques` VALUES (97, 1, 4, 2, 'P71P12DMCVJ', 'En dotation', 0, 0, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `materielinformatiques` VALUES (98, 1, 4, 2, 'P71P12DMCVG', 'En dotation', 0, 0, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `materielinformatiques` VALUES (99, 1, 4, 2, 'P71P12DMCVK', 'En stock', 0, 0, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `materielinformatiques` VALUES (100, 1, 2, 1, 'P64L03BIB4K', 'En stock', 0, 0, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `materielinformatiques` VALUES (101, 1, 1, 1, 'P64L03BICM5', 'En dotation', 0, 0, '', '0000-00-00', '2013-03-28') ; 
INSERT INTO `materielinformatiques` VALUES (102, 1, 2, 1, 'P64L03BIB5H', 'En dotation', 0, 0, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `materielinformatiques` VALUES (103, 2, 1, 1, 'P64L03BICNO', 'En dotation', 1, 1, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `materielinformatiques` VALUES (104, 2, 2, 1, 'P64L03BICLX', 'En dotation', 0, 1, '', '2013-02-01', '2013-03-27') ; 
INSERT INTO `materielinformatiques` VALUES (105, 2, 2, 1, 'P64L06BICM6', 'En dotation', 0, 1, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `materielinformatiques` VALUES (106, 2, 4, 1, 'P64L03BIBX1', 'En dotation', 0, 0, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `materielinformatiques` VALUES (107, 2, 2, 1, 'P64L03BICN6', 'En dotation', 0, 1, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `materielinformatiques` VALUES (108, 2, 2, 1, 'P64L03BICN2', 'En dotation', 0, 1, '', '2013-02-01', '2013-03-27') ; 
INSERT INTO `materielinformatiques` VALUES (109, 1, 1, 1, 'P64L03BICM9', 'En dotation', 0, 0, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `materielinformatiques` VALUES (110, 1, 2, 1, 'P64L03BIB3T', 'En dotation', 0, 0, 'Prêté pour stagiaire au DELIVERY N. MERCURIO', '2013-02-01', '2013-04-10') ; 
INSERT INTO `materielinformatiques` VALUES (111, 2, 2, 1, 'P64L03BIBTF', 'En dotation', 1, 1, '', '2013-02-01', '2013-03-27') ; 
INSERT INTO `materielinformatiques` VALUES (112, 2, 4, 1, 'P64L03BICO6', 'En dotation', 1, 0, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `materielinformatiques` VALUES (113, 1, 2, 1, 'P64L03BIB6Q', 'En dotation', 0, 0, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `materielinformatiques` VALUES (114, 2, 4, 1, 'P64L03BICOA', 'En dotation', 1, 0, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `materielinformatiques` VALUES (115, 2, 4, 1, 'P64L03BICO7', 'En dotation', 1, 0, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `materielinformatiques` VALUES (116, 2, 4, 1, 'P64L03BICOD', 'En dotation', 1, 0, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `materielinformatiques` VALUES (117, 2, 4, 1, 'P64L03BICO4', 'En dotation', 1, 0, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `materielinformatiques` VALUES (118, 2, 1, 1, 'P64L03BICOE', 'En dotation', 0, 1, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `materielinformatiques` VALUES (119, 2, 2, 1, 'P64L03BICO9', 'En dotation', 0, 1, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `materielinformatiques` VALUES (120, 2, 2, 1, 'P64L03BICQY', 'En dotation', 1, 0, '', '2013-02-01', '2013-03-27') ; 
INSERT INTO `materielinformatiques` VALUES (121, 2, 4, 1, 'P64L03BICR4', 'En dotation', 0, 0, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `materielinformatiques` VALUES (122, 1, 4, 1, 'P64L03BICNX', 'En dotation', 0, 0, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `materielinformatiques` VALUES (123, 2, 4, 1, 'P64L03BIB3R', 'En dotation', 1, 0, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `materielinformatiques` VALUES (124, 1, 4, 2, 'P71P12DMCBA', 'En stock', 0, 0, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `materielinformatiques` VALUES (125, 1, 1, 1, 'P64L03BIB6C', 'En dotation', 0, 0, '', '2013-02-01', '2013-03-27') ; 
INSERT INTO `materielinformatiques` VALUES (127, 2, 2, 1, 'P64L03BIBTG', 'En dotation', 1, 1, '', '2013-02-01', '2013-03-27') ; 
INSERT INTO `materielinformatiques` VALUES (128, 2, 2, 1, 'P64L03BIBTH', 'En dotation', 1, 1, '', '2013-02-01', '2013-03-27') ; 
INSERT INTO `materielinformatiques` VALUES (129, 2, 2, 1, 'P64L03BIB5Y', 'En dotation', 1, 0, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `materielinformatiques` VALUES (130, 2, 2, 1, 'P64L03BIB5X', 'Au rebut', 0, 0, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `materielinformatiques` VALUES (131, 1, 4, 1, 'P64L03BIB3S', 'En dotation', 0, 0, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `materielinformatiques` VALUES (132, 1, 2, 1, 'P64L03BIB4M', 'En dotation', 0, 0, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `materielinformatiques` VALUES (133, 1, 2, 1, 'P64L03BIB42', 'Non localisé', 0, 0, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `materielinformatiques` VALUES (134, 1, 2, 1, 'P64L03BIB3M', 'En dotation', 0, 0, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `materielinformatiques` VALUES (135, 1, 2, 1, 'P64L03BIB5L', 'En stock', 0, 0, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `materielinformatiques` VALUES (136, 2, 2, 1, 'P64L03BICHD', 'En dotation', 0, 0, '', '0000-00-00', '2013-04-03') ; 
INSERT INTO `materielinformatiques` VALUES (137, 1, 4, 2, 'P71P12DMBW4', 'En stock', 0, 0, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `materielinformatiques` VALUES (138, 2, 4, 1, 'P64L03BICQD', 'En dotation', 1, 1, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `materielinformatiques` VALUES (139, 2, 4, 1, 'P64L03BICQE', 'En dotation', 1, 1, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `materielinformatiques` VALUES (140, 1, 1, 1, 'P64L03BIBLV', 'En dotation', 0, 0, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `materielinformatiques` VALUES (141, 2, 2, 1, 'P64L03BICSM', 'En dotation', 0, 0, '', '0000-00-00', '2013-05-21') ; 
INSERT INTO `materielinformatiques` VALUES (142, 2, 4, 1, 'P64L03BICSL', 'En stock', 0, 0, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `materielinformatiques` VALUES (143, 2, 2, 1, 'P64L03BICSK', 'En dotation', 0, 0, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `materielinformatiques` VALUES (144, 2, 4, 2, 'P64L03BICWF', 'En dotation', 0, 0, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `materielinformatiques` VALUES (145, 1, 4, 2, 'P71P12DMD49', 'En dotation', 0, 0, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `materielinformatiques` VALUES (146, 1, 4, 2, 'P71P12DMD4Z', 'En dotation', 0, 0, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `materielinformatiques` VALUES (147, 1, 4, 2, 'P71P12DMD50 ', 'En dotation', 0, 0, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `materielinformatiques` VALUES (148, 1, 4, 2, 'P71P12DMD51', 'En dotation', 0, 0, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `materielinformatiques` VALUES (149, 1, 4, 2, 'P71P12DMD52', 'En dotation', 0, 0, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `materielinformatiques` VALUES (150, 1, 4, 2, 'P71P12DMD53', 'En dotation', 0, 0, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `materielinformatiques` VALUES (151, 1, 4, 2, 'P71P12DMD54', 'En dotation', 0, 0, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `materielinformatiques` VALUES (152, 1, 4, 2, 'P71P12DMD55', 'En dotation', 0, 0, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `materielinformatiques` VALUES (153, 1, 4, 2, 'P71P12DMD56', 'En dotation', 0, 0, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `materielinformatiques` VALUES (154, 1, 4, 2, 'P71P12DMD57', 'En dotation', 0, 0, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `materielinformatiques` VALUES (155, 1, 4, 2, 'P71P12DMD58', 'En dotation', 0, 0, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `materielinformatiques` VALUES (156, 1, 4, 2, 'P71P12DMD59', 'En dotation', 0, 0, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `materielinformatiques` VALUES (157, 1, 4, 2, 'P71P12DMD5A', 'En dotation', 0, 0, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `materielinformatiques` VALUES (158, 1, 4, 2, 'P71P12DMD5B', 'En dotation', 0, 0, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `materielinformatiques` VALUES (159, 1, 4, 2, 'P71P12DMD5C', 'En dotation', 0, 0, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `materielinformatiques` VALUES (160, 1, 4, 2, 'P71P12DMD5D', 'En dotation', 0, 0, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `materielinformatiques` VALUES (161, 1, 4, 2, 'P71P12DMD5E', 'En dotation', 0, 0, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `materielinformatiques` VALUES (162, 1, 4, 2, 'P71P12DMCRO', 'En stock', 0, 0, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `materielinformatiques` VALUES (163, 2, 1, 1, 'P64L03BID5L', 'En dotation', 0, 0, 'Windows 7 et Office 2007', '2013-04-18', '2013-04-18') ; 
INSERT INTO `materielinformatiques` VALUES (164, 2, 1, 1, 'P64L03BID5K', 'En dotation', 0, 0, 'Windows 7 + Office 2007', '2013-04-18', '2013-04-18') ; 
INSERT INTO `materielinformatiques` VALUES (165, 2, 1, 1, 'P64L03BID5M', 'En dotation', 0, 0, 'Windows 7 + Office 2007', '2013-04-18', '2013-04-18') ; 
INSERT INTO `materielinformatiques` VALUES (166, 2, 1, 1, 'P64L03BID5J', 'En dotation', 0, 0, 'Windows 7 + Office 2007', '2013-04-18', '2013-04-18') ;
#
# End of data contents of table materielinformatiques
# --------------------------------------------------------

# WordPress : buffernow.com MySQL database backup
#
# Generated: Thursday 23. May 2013 19:38 CEST
# Hostname: localhost
# Database: `saill_200`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `achats`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `actions`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `actionslivrables`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `activites`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `activitesreelles`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `affectations`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `assistances`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `autorisations`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `contrats`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `detailplancharges`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `domaines`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `dossierpartages`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `dotations`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `facturations`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `historyactions`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `historybudgets`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `historyutilisateurs`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `linkshareds`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `listediffusions`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `livrables`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `mailtemplates`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `materielinformatiques`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `messages`
# --------------------------------------------------------


#
# Delete any existing table `messages`
#

DROP TABLE IF EXISTS `messages`;


#
# Table structure of table `messages`
#

CREATE TABLE `messages` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `LIBELLE` mediumtext NOT NULL,
  `DATELIMITE` date DEFAULT NULL,
  `created` date NOT NULL,
  `modified` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ;

#
# Data contents of table messages (2 records)
#
 
INSERT INTO `messages` VALUES (1, 'Bienvenue sur le site de saisie de l\'activité, du suivi des livrables et de la logistique.', NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `messages` VALUES (2, 'Clôture de la saisie d\'activité pour le vendredi <span style="color: #ff0000;"><strong>17/05/2013</strong></span> au soir. Merci de valider votre saisie en cliquant sur l\'icone en forme de <span style="color: #00ff00;"><em>main avec le pouce en bas</em></span>', '2013-05-24', '2013-03-27', '2013-04-25') ;
#
# End of data contents of table messages
# --------------------------------------------------------

# WordPress : buffernow.com MySQL database backup
#
# Generated: Thursday 23. May 2013 19:38 CEST
# Hostname: localhost
# Database: `saill_200`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `achats`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `actions`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `actionslivrables`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `activites`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `activitesreelles`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `affectations`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `assistances`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `autorisations`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `contrats`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `detailplancharges`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `domaines`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `dossierpartages`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `dotations`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `facturations`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `historyactions`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `historybudgets`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `historyutilisateurs`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `linkshareds`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `listediffusions`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `livrables`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `mailtemplates`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `materielinformatiques`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `messages`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `outils`
# --------------------------------------------------------


#
# Delete any existing table `outils`
#

DROP TABLE IF EXISTS `outils`;


#
# Table structure of table `outils`
#

CREATE TABLE `outils` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `utilisateur_id` int(15) NOT NULL,
  `NOM` varchar(255) CHARACTER SET latin1 NOT NULL,
  `DESCRIPTION` text CHARACTER SET latin1,
  `VALIDATION` tinyint(1) NOT NULL DEFAULT '0',
  `created` date NOT NULL,
  `modified` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 ;

#
# Data contents of table outils (10 records)
#
 
INSERT INTO `outils` VALUES (1, 6, 'CALIBER', 'Outils de gestion des exigences Login = LOGIN WINDOWS (en majsucule) Mot de passe = LOGIN WINDOWS (en majsucule) à  changer à  la première connexion"', 0, '2013-02-01', '2013-03-28') ; 
INSERT INTO `outils` VALUES (2, 6, 'MINIDOC', 'Outils de gestion documentaire Reconnu si l\'utilisateur fait partie de DSIT-E Autres cas se rapprocher du gestionnaire"', 0, '2013-02-01', '2013-03-28') ; 
INSERT INTO `outils` VALUES (3, 10, 'QUALITY CENTER', 'Outil de suivi des tests et anomalies En cas d\'absence du gestionnaire il est possible de contacter JB DOUVALIAN"', 0, '2013-02-01', '2013-03-28') ; 
INSERT INTO `outils` VALUES (4, 34, 'SVN', 'Outils de gestion des sources Non disponible pour PANAM"', 0, '2013-02-01', '2013-03-28') ; 
INSERT INTO `outils` VALUES (5, 266, 'ARIANE', 'Outils de gestion des actions Utiliser également par le groupement comme outil de stockage de la documentation de travail. En cas d\'absence du gestionnaire contacter #ARIANE-ADMIN"', 0, '2013-02-01', '2013-03-28') ; 
INSERT INTO `outils` VALUES (6, 5, 'SAMETIME', 'Outil de chat en réseau local SNCF soumis à  validation du chef de division', 1, '2013-02-01', '2013-03-28') ; 
INSERT INTO `outils` VALUES (7, 5, 'INTERNET MULTIMEDIA', 'Demande d\'accès internet dérogatif soumis à  validation du chef de division<br />L\'accès à Internet est autorisé à tout agent avec un compte SNCF.', 1, '2013-02-01', '2013-03-28') ; 
INSERT INTO `outils` VALUES (8, 39, 'PORTAIL ENV.', 'Outils de gestion des environnements', 0, '2013-02-01', '2013-03-28') ; 
INSERT INTO `outils` VALUES (9, 5, 'VPN', 'Demande d\'accès au VPN soumis à  validation du chef de division', 1, '2013-02-01', '2013-03-28') ; 
INSERT INTO `outils` VALUES (10, 5, 'WIFI', 'Demande d\'accès au WIFI soumis à  validation du chef de division', 1, '2013-02-01', '2013-03-28') ;
#
# End of data contents of table outils
# --------------------------------------------------------

# WordPress : buffernow.com MySQL database backup
#
# Generated: Thursday 23. May 2013 19:38 CEST
# Hostname: localhost
# Database: `saill_200`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `achats`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `actions`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `actionslivrables`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `activites`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `activitesreelles`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `affectations`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `assistances`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `autorisations`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `contrats`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `detailplancharges`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `domaines`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `dossierpartages`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `dotations`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `facturations`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `historyactions`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `historybudgets`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `historyutilisateurs`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `linkshareds`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `listediffusions`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `livrables`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `mailtemplates`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `materielinformatiques`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `messages`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `outils`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `params`
# --------------------------------------------------------


#
# Delete any existing table `params`
#

DROP TABLE IF EXISTS `params`;


#
# Table structure of table `params`
#

CREATE TABLE `params` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `param` text,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 ;

#
# Data contents of table params (3 records)
#
 
INSERT INTO `params` VALUES (1, 'urlminidoc', NULL, '2013-05-15 00:00:00', '2013-05-15 00:00:00') ; 
INSERT INTO `params` VALUES (2, 'contact', NULL, '2013-05-15 00:00:00', '2013-05-15 00:00:00') ; 
INSERT INTO `params` VALUES (3, 'version', '2.0.1b002', '2013-05-15 00:00:00', '2013-05-15 00:00:00') ;
#
# End of data contents of table params
# --------------------------------------------------------

# WordPress : buffernow.com MySQL database backup
#
# Generated: Thursday 23. May 2013 19:38 CEST
# Hostname: localhost
# Database: `saill_200`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `achats`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `actions`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `actionslivrables`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `activites`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `activitesreelles`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `affectations`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `assistances`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `autorisations`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `contrats`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `detailplancharges`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `domaines`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `dossierpartages`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `dotations`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `facturations`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `historyactions`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `historybudgets`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `historyutilisateurs`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `linkshareds`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `listediffusions`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `livrables`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `mailtemplates`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `materielinformatiques`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `messages`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `outils`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `params`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `plancharges`
# --------------------------------------------------------


#
# Delete any existing table `plancharges`
#

DROP TABLE IF EXISTS `plancharges`;


#
# Table structure of table `plancharges`
#

CREATE TABLE `plancharges` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contrat_id` int(15) NOT NULL,
  `NOM` varchar(255) NOT NULL,
  `ANNEE` year(4) NOT NULL,
  `ETP` decimal(3,1) DEFAULT '1.0',
  `CHARGES` int(15) DEFAULT NULL,
  `TJM` int(11) NOT NULL,
  `VERSION` int(11) NOT NULL DEFAULT '0',
  `created` date NOT NULL,
  `modified` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 ;

#
# Data contents of table plancharges (7 records)
#
 
INSERT INTO `plancharges` VALUES (1, 3, '2013-COHERENCE', '2013', '1.3', 271, 640, 0, '2013-04-23', '2013-04-23') ; 
INSERT INTO `plancharges` VALUES (2, 2, '2013-OSMOSE-GMAO', '2013', '22.6', 4373, 640, 0, '2013-04-23', '2013-04-23') ; 
INSERT INTO `plancharges` VALUES (3, 4, '2013-ORCHESTRAL', '2013', '4.0', 808, 640, 0, '2013-04-23', '2013-04-23') ; 
INSERT INTO `plancharges` VALUES (4, 6, '2013-PANAM', '2013', '7.0', 1425, 640, 0, '2013-04-23', '2013-04-23') ; 
INSERT INTO `plancharges` VALUES (5, 5, '2013-SGRM', '2013', '1.2', 225, 640, 0, '2013-04-23', '2013-04-23') ; 
INSERT INTO `plancharges` VALUES (6, 2, '2014-OSMOSE', '2014', '19.8', 4172, 640, 1, '2013-04-23', '2013-04-23') ; 
INSERT INTO `plancharges` VALUES (7, 10, '2013-URBANISME', '2013', '0.4', 84, 630, 0, '2013-05-14', '2013-05-14') ;
#
# End of data contents of table plancharges
# --------------------------------------------------------

# WordPress : buffernow.com MySQL database backup
#
# Generated: Thursday 23. May 2013 19:38 CEST
# Hostname: localhost
# Database: `saill_200`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `achats`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `actions`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `actionslivrables`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `activites`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `activitesreelles`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `affectations`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `assistances`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `autorisations`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `contrats`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `detailplancharges`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `domaines`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `dossierpartages`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `dotations`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `facturations`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `historyactions`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `historybudgets`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `historyutilisateurs`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `linkshareds`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `listediffusions`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `livrables`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `mailtemplates`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `materielinformatiques`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `messages`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `outils`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `params`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `plancharges`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `profils`
# --------------------------------------------------------


#
# Delete any existing table `profils`
#

DROP TABLE IF EXISTS `profils`;


#
# Table structure of table `profils`
#

CREATE TABLE `profils` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `NOM` varchar(255) CHARACTER SET latin1 NOT NULL,
  `COMMENTAIRE` text CHARACTER SET latin1,
  `created` date NOT NULL,
  `modified` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 ;

#
# Data contents of table profils (11 records)
#
 
INSERT INTO `profils` VALUES (-1, 'Ressource générique', 'Profil permettant de créer une ressource pour les plans de charges et la facturation uniquement.', '2013-05-16', '2013-05-16') ; 
INSERT INTO `profils` VALUES (1, 'ADMINISTRATEUR', 'Profil donnant les droits complet au site', '2013-02-01', '2013-02-01') ; 
INSERT INTO `profils` VALUES (2, 'Visiteur', 'Autorisé à consulter la liste des liens partagés, pages accueil, contacter nous, aucun droit supplémentaire possible pas la peine de donner des autorisations', '2013-02-01', '2013-02-01') ; 
INSERT INTO `profils` VALUES (3, 'Pilote', 'Autorisations standards avec en plus accès au budget et aux rapports', '2013-02-01', '2013-02-01') ; 
INSERT INTO `profils` VALUES (4, 'Resp. équipe', 'Autorisations standards avec en plus accès plus large et non limité à son périmètre', '2013-02-01', '2013-02-01') ; 
INSERT INTO `profils` VALUES (5, 'Resp. outils', 'Autorisations standards avec en plus des droit pour les ouverture de droits et un accès plus large et non limité à son périmètre', '2013-02-01', '2013-02-01') ; 
INSERT INTO `profils` VALUES (6, 'Agents DSI-T SO', 'Autorisations standards avec un accès limité à son périmètre', '2013-02-01', '2013-02-01') ; 
INSERT INTO `profils` VALUES (7, 'Agents GROUPEMENT', 'Autorisations réduites avec un accès limité à son périmètre', '2013-02-01', '2013-02-01') ; 
INSERT INTO `profils` VALUES (8, 'Admin délégué', 'Autorisations d\'administration réduites', '2013-02-01', '2013-02-01') ; 
INSERT INTO `profils` VALUES (9, 'Agents MOA', 'Autorisations réduites avec un accès limité à son périmètre', '2013-02-01', '2013-02-01') ; 
INSERT INTO `profils` VALUES (10, 'Agent DSI-T SO gest. Outils', 'Autorisations standards avec un accès limité à son périmètre et pouvant mettre à jour les ouverture de droits', '2013-02-01', '2013-02-01') ;
#
# End of data contents of table profils
# --------------------------------------------------------

# WordPress : buffernow.com MySQL database backup
#
# Generated: Thursday 23. May 2013 19:38 CEST
# Hostname: localhost
# Database: `saill_200`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `achats`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `actions`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `actionslivrables`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `activites`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `activitesreelles`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `affectations`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `assistances`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `autorisations`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `contrats`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `detailplancharges`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `domaines`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `dossierpartages`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `dotations`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `facturations`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `historyactions`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `historybudgets`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `historyutilisateurs`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `linkshareds`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `listediffusions`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `livrables`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `mailtemplates`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `materielinformatiques`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `messages`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `outils`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `params`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `plancharges`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `profils`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `projets`
# --------------------------------------------------------


#
# Delete any existing table `projets`
#

DROP TABLE IF EXISTS `projets`;


#
# Table structure of table `projets`
#

CREATE TABLE `projets` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `contrat_id` int(15) NOT NULL,
  `NOM` varchar(255) CHARACTER SET latin1 NOT NULL,
  `NUMEROGALLILIE` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `DEBUT` date DEFAULT NULL,
  `FIN` date DEFAULT NULL,
  `COMMENTAIRE` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `ACTIF` tinyint(1) NOT NULL DEFAULT '0',
  `TYPE` enum('Projet','MCO','Indisponibilité','Evolution','Intégration','Exploitation') CHARACTER SET latin1 DEFAULT 'Projet',
  `FACTURATION` enum('régie','forfait','autre') CHARACTER SET latin1 DEFAULT NULL,
  `created` date NOT NULL,
  `modified` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 ;

#
# Data contents of table projets (24 records)
#
 
INSERT INTO `projets` VALUES (1, 1, 'indisponibilité', NULL, '2013-01-01', NULL, NULL, 1, 'Indisponibilité', 'autre', '2013-02-01', '2013-02-01') ; 
INSERT INTO `projets` VALUES (2, 2, 'DEV M OSMOSE', '01328-0000064359', '2008-01-02', NULL, NULL, 1, 'Projet', 'régie', '2013-02-01', '2013-02-01') ; 
INSERT INTO `projets` VALUES (3, 6, 'DEV M PANAM', '01328-0000068794', '2010-01-02', NULL, NULL, 1, 'Projet', 'régie', '2013-02-01', '2013-01-02') ; 
INSERT INTO `projets` VALUES (4, 2, 'MCO M EMM OSMOSE', '01328-0000068414', '2010-01-02', NULL, NULL, 1, 'MCO', 'forfait', '2013-02-01', '2013-02-01') ; 
INSERT INTO `projets` VALUES (5, 6, 'MCO PANAM', '01328-0000070662', '2010-01-02', NULL, NULL, 1, 'MCO', 'forfait', '2013-02-01', '2013-02-01') ; 
INSERT INTO `projets` VALUES (6, 3, 'DEV M EMM COHERENCE', '01328-0000061462', '2009-01-02', '2013-01-02', NULL, 0, 'Projet', 'régie', '2013-02-01', '2013-02-01') ; 
INSERT INTO `projets` VALUES (7, 3, 'MCO M COHERENCE', '01328-0000068637', '2010-01-02', NULL, NULL, 1, 'MCO', 'forfait', '2013-02-01', '2013-02-01') ; 
INSERT INTO `projets` VALUES (8, 4, 'DEV M ORCHESTRAL', '01328-0000064997', '2009-01-02', '2013-01-02', NULL, 0, 'Projet', 'régie', '2013-02-01', '2013-02-01') ; 
INSERT INTO `projets` VALUES (9, 4, 'MCO M ORCHESTRAL', '01328-0000068638', '2010-01-02', NULL, NULL, 1, 'MCO', 'forfait', '2013-02-01', '2013-02-01') ; 
INSERT INTO `projets` VALUES (10, 2, 'Contrat DSIT-X ==> MAT OSMOSE', '01328-0000064309', '2008-01-02', NULL, NULL, 1, 'Projet', 'régie', '2013-02-01', '2013-02-01') ; 
INSERT INTO `projets` VALUES (11, 6, 'Contrat DSIT-X ==> MAT PANAM', '01328-0000000000', '2010-01-02', NULL, NULL, 1, 'Projet', 'régie', '2013-02-01', '2013-02-01') ; 
INSERT INTO `projets` VALUES (12, 3, 'Contrat DSIT-X ==> MAT COHERENCE', '01328-0000064367', '2010-01-02', NULL, NULL, 1, 'Projet', 'régie', '2013-02-01', '2013-02-01') ; 
INSERT INTO `projets` VALUES (13, 4, 'Contrat DSIT-X ==> MAT ORCHESTRAL', '01328-0000064641', '2010-01-02', NULL, NULL, 1, 'Projet', 'régie', '2013-02-01', '2013-02-01') ; 
INSERT INTO `projets` VALUES (14, 5, 'DEV M OSMOSE SGRM', '01328-0000071134', '2010-01-02', NULL, NULL, 1, 'Projet', 'régie', '2013-02-01', '2013-02-01') ; 
INSERT INTO `projets` VALUES (15, 5, 'MCO M OSMOSE SGRM', '01328-0000071712', '2010-01-02', NULL, NULL, 1, 'MCO', 'forfait', '2013-02-01', '2013-02-01') ; 
INSERT INTO `projets` VALUES (16, 3, 'EVO M EMM COHERENCE', '01328-0000072207', '2013-01-02', NULL, NULL, 1, 'Evolution', 'régie', '2013-02-01', '2013-02-01') ; 
INSERT INTO `projets` VALUES (17, 4, 'EVO M ORCHESTRAL', '01328-0000072209', '2013-01-02', NULL, NULL, 1, 'Evolution', 'régie', '2013-02-01', '2013-02-01') ; 
INSERT INTO `projets` VALUES (18, 7, 'PEV M BAUME DBC ', '01328-0000071232', '2010-01-02', NULL, NULL, 1, 'Projet', 'régie', '2013-02-01', '2013-01-02') ; 
INSERT INTO `projets` VALUES (19, 7, 'BAUME DBC - MCO', '01328-0000071231', '2010-01-02', NULL, NULL, 1, 'MCO', 'forfait', '2013-02-01', '2013-02-01') ; 
INSERT INTO `projets` VALUES (20, 8, 'MCO M APPLICATION EMC2', '01328-0000061454', '2010-01-02', NULL, NULL, 1, 'MCO', 'forfait', '2013-02-01', '2013-01-02') ; 
INSERT INTO `projets` VALUES (21, 10, 'ASS M URBANISME ', '01328-0000064373', '2010-01-02', NULL, NULL, 1, 'Projet', 'régie', '2013-02-01', '2013-01-02') ; 
INSERT INTO `projets` VALUES (22, 9, 'DEV M ITACT ', '01328-0000070794', '2010-01-02', NULL, NULL, 1, 'Projet', 'régie', '2013-02-01', '2013-01-02') ; 
INSERT INTO `projets` VALUES (23, 12, 'Stagiaire', '', NULL, NULL, '', 1, NULL, NULL, '2013-03-26', '2013-03-26') ; 
INSERT INTO `projets` VALUES (24, 13, 'Frais DSI-T/SO', '', '2011-01-01', NULL, 'Permet de facturer les achats divers pour le compte du Département', 1, 'Projet', 'régie', '2013-03-27', '2013-03-27') ;
#
# End of data contents of table projets
# --------------------------------------------------------

# WordPress : buffernow.com MySQL database backup
#
# Generated: Thursday 23. May 2013 19:38 CEST
# Hostname: localhost
# Database: `saill_200`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `achats`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `actions`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `actionslivrables`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `activites`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `activitesreelles`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `affectations`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `assistances`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `autorisations`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `contrats`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `detailplancharges`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `domaines`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `dossierpartages`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `dotations`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `facturations`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `historyactions`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `historybudgets`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `historyutilisateurs`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `linkshareds`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `listediffusions`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `livrables`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `mailtemplates`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `materielinformatiques`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `messages`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `outils`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `params`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `plancharges`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `profils`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `projets`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `replacestrings`
# --------------------------------------------------------


#
# Delete any existing table `replacestrings`
#

DROP TABLE IF EXISTS `replacestrings`;


#
# Table structure of table `replacestrings`
#

CREATE TABLE `replacestrings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mailtemplate_id` int(11) NOT NULL,
  `VARIABLE` varchar(45) NOT NULL,
  `REPLACEBY` text,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ;

#
# Data contents of table replacestrings (0 records)
#

#
# End of data contents of table replacestrings
# --------------------------------------------------------

# WordPress : buffernow.com MySQL database backup
#
# Generated: Thursday 23. May 2013 19:38 CEST
# Hostname: localhost
# Database: `saill_200`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `achats`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `actions`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `actionslivrables`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `activites`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `activitesreelles`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `affectations`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `assistances`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `autorisations`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `contrats`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `detailplancharges`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `domaines`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `dossierpartages`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `dotations`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `facturations`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `historyactions`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `historybudgets`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `historyutilisateurs`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `linkshareds`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `listediffusions`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `livrables`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `mailtemplates`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `materielinformatiques`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `messages`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `outils`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `params`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `plancharges`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `profils`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `projets`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `replacestrings`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `sections`
# --------------------------------------------------------


#
# Delete any existing table `sections`
#

DROP TABLE IF EXISTS `sections`;


#
# Table structure of table `sections`
#

CREATE TABLE `sections` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `utilisateur_id` int(15) DEFAULT NULL,
  `NOM` varchar(255) CHARACTER SET latin1 NOT NULL,
  `DESCRIPTION` text CHARACTER SET latin1,
  `created` date NOT NULL,
  `modified` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 ;

#
# Data contents of table sections (8 records)
#
 
INSERT INTO `sections` VALUES (1, 4, 'DSI-T/SO MAT GMAO-PANAM', 'Section gérant la GMAO ainsi que tous les autres projets sattelites et tout ce qui est transverse à tous ces projets.', '2013-02-01', '2013-03-28') ; 
INSERT INTO `sections` VALUES (2, 3, 'DSI-T/SO MAT INTEGRATION', 'Section gérant l\'intégration des applications du Matériel.', '2013-02-01', '2013-03-28') ; 
INSERT INTO `sections` VALUES (3, NULL, 'DSI-T/SO MAT OSMOSE REF', 'Section gérant les applications référentielles du Matériel.', '2013-02-01', '2013-02-01') ; 
INSERT INTO `sections` VALUES (4, NULL, 'GROUPEMENT', 'Section fictive pour les personnes du groupement', '2013-02-01', '2013-02-01') ; 
INSERT INTO `sections` VALUES (5, NULL, 'MOA', 'Section fictive pour les personnes de la MOA', '2013-02-01', '2013-02-01') ; 
INSERT INTO `sections` VALUES (6, NULL, 'DSI-T/SO A&E CAMPUS SI', 'Section du CAMPUS SI pour la formation', '2013-02-01', '2013-02-01') ; 
INSERT INTO `sections` VALUES (7, NULL, 'DSI-T/SO DELIVERY DDSP', 'Section du DELIVERY', '2013-02-01', '2013-02-01') ; 
INSERT INTO `sections` VALUES (8, NULL, 'DSI-T/SO DECISION MATERIEL', 'Section du décisionnel matériel', '2013-02-01', '2013-02-01') ;
#
# End of data contents of table sections
# --------------------------------------------------------

# WordPress : buffernow.com MySQL database backup
#
# Generated: Thursday 23. May 2013 19:38 CEST
# Hostname: localhost
# Database: `saill_200`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `achats`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `actions`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `actionslivrables`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `activites`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `activitesreelles`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `affectations`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `assistances`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `autorisations`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `contrats`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `detailplancharges`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `domaines`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `dossierpartages`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `dotations`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `facturations`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `historyactions`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `historybudgets`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `historyutilisateurs`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `linkshareds`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `listediffusions`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `livrables`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `mailtemplates`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `materielinformatiques`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `messages`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `outils`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `params`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `plancharges`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `profils`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `projets`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `replacestrings`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `sections`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `sites`
# --------------------------------------------------------


#
# Delete any existing table `sites`
#

DROP TABLE IF EXISTS `sites`;


#
# Table structure of table `sites`
#

CREATE TABLE `sites` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `NOM` varchar(35) CHARACTER SET latin1 NOT NULL,
  `DESCRIPTION` text CHARACTER SET latin1,
  `created` date NOT NULL,
  `modified` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 ;

#
# Data contents of table sites (5 records)
#
 
INSERT INTO `sites` VALUES (1, 'OXYGENE', 'SIte lyonnais de DSI-T', '2013-02-01', '2013-02-01') ; 
INSERT INTO `sites` VALUES (2, 'INNOVIA', 'Site parision de DSI-T', '2013-02-01', '2013-02-01') ; 
INSERT INTO `sites` VALUES (3, 'LUMIERE', 'Site parisien du client MATERIEL', '2013-02-01', '2013-02-01') ; 
INSERT INTO `sites` VALUES (4, 'CAPGEMINI NANTES', 'Site de CAPGEMINI à NANTES pour le développement de PANAM ', '2013-02-01', '2013-02-01') ; 
INSERT INTO `sites` VALUES (5, 'SOGETI VILLEURBANNE', 'Site de SOGETI à VILLEURBANNE pour le développement de COHERENCE et ORCHESTRAL', '2013-02-01', '2013-04-02') ;
#
# End of data contents of table sites
# --------------------------------------------------------

# WordPress : buffernow.com MySQL database backup
#
# Generated: Thursday 23. May 2013 19:38 CEST
# Hostname: localhost
# Database: `saill_200`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `achats`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `actions`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `actionslivrables`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `activites`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `activitesreelles`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `affectations`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `assistances`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `autorisations`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `contrats`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `detailplancharges`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `domaines`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `dossierpartages`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `dotations`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `facturations`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `historyactions`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `historybudgets`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `historyutilisateurs`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `linkshareds`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `listediffusions`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `livrables`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `mailtemplates`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `materielinformatiques`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `messages`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `outils`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `params`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `plancharges`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `profils`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `projets`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `replacestrings`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `sections`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `sites`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `societes`
# --------------------------------------------------------


#
# Delete any existing table `societes`
#

DROP TABLE IF EXISTS `societes`;


#
# Table structure of table `societes`
#

CREATE TABLE `societes` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `NOM` varchar(255) CHARACTER SET latin1 NOT NULL,
  `NOMCONTACT` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `TELEPHONE` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `MAIL` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `created` date NOT NULL,
  `modified` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ;

#
# Data contents of table societes (19 records)
#
 
INSERT INTO `societes` VALUES (1, 'SNCF', NULL, NULL, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `societes` VALUES (2, 'SQLI', 'CARLAN Philippe', '04 72 40 53 13 - 06 17 65 89 47', 'pcarlan@sqli.com', '2013-02-01', '2013-03-28') ; 
INSERT INTO `societes` VALUES (3, 'STERIA', 'DUVERGER Charlotte', '04 72 13 37 17 - 06 40 29 80 63', 'charlotte.duverger@steria.com', '2013-02-01', '2013-03-28') ; 
INSERT INTO `societes` VALUES (4, 'ESR GROUP', NULL, NULL, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `societes` VALUES (5, 'ASTEK', NULL, NULL, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `societes` VALUES (6, 'SOGETI', NULL, NULL, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `societes` VALUES (7, 'CAPGEMINI', NULL, NULL, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `societes` VALUES (8, 'IBM', NULL, NULL, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `societes` VALUES (9, 'EURIWARE', 'TACLET Jean Marc ', '01 39 48 44 57  - 06 83 83 64 05', 'jean-marc.taclet@euriware.fr', '2013-02-01', '2013-03-28') ; 
INSERT INTO `societes` VALUES (10, 'EXL GROUP', 'PERRET Emmanuel', '06 35 42 71 15', 'emmanuel.perret@exl-group.com', '2013-02-01', '2013-03-28') ; 
INSERT INTO `societes` VALUES (11, 'MDT VISION', NULL, NULL, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `societes` VALUES (12, 'LOGICA', NULL, NULL, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `societes` VALUES (13, 'FASTCONNECT', NULL, NULL, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `societes` VALUES (14, 'GFI', NULL, NULL, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `societes` VALUES (15, 'OSIATIS', NULL, NULL, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `societes` VALUES (16, 'AKKA', NULL, NULL, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `societes` VALUES (17, 'ATOS', NULL, NULL, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `societes` VALUES (18, 'AXIALOG', NULL, NULL, NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `societes` VALUES (19, 'QUATERNAIRE', NULL, NULL, NULL, '2013-02-01', '2013-02-01') ;
#
# End of data contents of table societes
# --------------------------------------------------------

# WordPress : buffernow.com MySQL database backup
#
# Generated: Thursday 23. May 2013 19:38 CEST
# Hostname: localhost
# Database: `saill_200`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `achats`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `actions`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `actionslivrables`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `activites`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `activitesreelles`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `affectations`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `assistances`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `autorisations`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `contrats`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `detailplancharges`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `domaines`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `dossierpartages`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `dotations`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `facturations`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `historyactions`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `historybudgets`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `historyutilisateurs`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `linkshareds`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `listediffusions`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `livrables`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `mailtemplates`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `materielinformatiques`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `messages`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `outils`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `params`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `plancharges`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `profils`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `projets`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `replacestrings`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `sections`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `sites`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `societes`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `suivilivrables`
# --------------------------------------------------------


#
# Delete any existing table `suivilivrables`
#

DROP TABLE IF EXISTS `suivilivrables`;


#
# Table structure of table `suivilivrables`
#

CREATE TABLE `suivilivrables` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `livrable_id` int(15) NOT NULL,
  `ECHEANCE` date NOT NULL,
  `DATELIVRAISON` date DEFAULT NULL,
  `DATEVALIDATION` date DEFAULT NULL,
  `ETAT` varchar(50) NOT NULL,
  `created` date NOT NULL,
  `modified` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 ;

#
# Data contents of table suivilivrables (7 records)
#
 
INSERT INTO `suivilivrables` VALUES (1, 1, '2013-04-11', '2013-04-11', '2013-04-11', 'en cours', '2013-03-27', '2013-03-27') ; 
INSERT INTO `suivilivrables` VALUES (2, 2, '2013-06-28', '2013-06-28', '2013-06-28', 'à faire', '2013-03-27', '2013-03-27') ; 
INSERT INTO `suivilivrables` VALUES (3, 1, '2013-05-13', '2013-05-13', '2013-05-14', 'en cours', '2013-04-25', '2013-04-25') ; 
INSERT INTO `suivilivrables` VALUES (4, 2, '2013-09-05', '2013-09-05', '2013-08-29', 'à faire', '2013-04-25', '2013-04-25') ; 
INSERT INTO `suivilivrables` VALUES (5, 1, '2013-05-13', '2013-05-15', '2013-05-15', 'livré', '2013-05-21', '2013-05-21') ; 
INSERT INTO `suivilivrables` VALUES (6, 1, '2013-05-13', '2013-05-15', '2013-05-15', 'validé', '2013-05-21', '2013-05-21') ; 
INSERT INTO `suivilivrables` VALUES (7, 2, '2013-09-05', '2013-09-05', '2013-08-29', 'en cours', '2013-05-22', '2013-05-22') ;
#
# End of data contents of table suivilivrables
# --------------------------------------------------------

# WordPress : buffernow.com MySQL database backup
#
# Generated: Thursday 23. May 2013 19:38 CEST
# Hostname: localhost
# Database: `saill_200`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `achats`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `actions`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `actionslivrables`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `activites`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `activitesreelles`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `affectations`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `assistances`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `autorisations`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `contrats`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `detailplancharges`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `domaines`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `dossierpartages`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `dotations`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `facturations`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `historyactions`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `historybudgets`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `historyutilisateurs`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `linkshareds`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `listediffusions`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `livrables`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `mailtemplates`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `materielinformatiques`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `messages`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `outils`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `params`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `plancharges`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `profils`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `projets`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `replacestrings`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `sections`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `sites`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `societes`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `suivilivrables`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `tjmagents`
# --------------------------------------------------------


#
# Delete any existing table `tjmagents`
#

DROP TABLE IF EXISTS `tjmagents`;


#
# Table structure of table `tjmagents`
#

CREATE TABLE `tjmagents` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `NOM` varchar(255) CHARACTER SET latin1 NOT NULL,
  `TARIFHT` decimal(25,2) DEFAULT NULL,
  `TARIFTTC` decimal(25,2) DEFAULT NULL,
  `ANNEE` year(4) NOT NULL,
  `created` date NOT NULL,
  `modified` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 ;

#
# Data contents of table tjmagents (19 records)
#
 
INSERT INTO `tjmagents` VALUES (1, '2012 - QUALIF G', NULL, '544.00', '2012', '2013-02-01', '2013-02-01') ; 
INSERT INTO `tjmagents` VALUES (2, '2012 - ATOS AST PANAM', NULL, '645.00', '2012', '2013-02-01', '2013-02-01') ; 
INSERT INTO `tjmagents` VALUES (3, '2012 - EURIWARE Tech. MAXIMO', NULL, '839.00', '2012', '2013-02-01', '2013-02-01') ; 
INSERT INTO `tjmagents` VALUES (4, '2012 - EURIWARE EXPERT MAXIMO', NULL, '1271.00', '2012', '2013-02-01', '2013-02-01') ; 
INSERT INTO `tjmagents` VALUES (5, '2012 - EURIWARE Gest. Exigences', NULL, '713.00', '2012', '2013-02-01', '2013-02-01') ; 
INSERT INTO `tjmagents` VALUES (6, '2012 - STERIA 105', NULL, '713.00', '2012', '2013-02-01', '2013-02-01') ; 
INSERT INTO `tjmagents` VALUES (7, '2012 - STERIA 101', NULL, '529.00', '2012', '2013-02-01', '2013-02-01') ; 
INSERT INTO `tjmagents` VALUES (8, '2012 - STERIA 103', NULL, '632.00', '2012', '2013-02-01', '2013-02-01') ; 
INSERT INTO `tjmagents` VALUES (9, '2012 - QUALIF CS', NULL, '878.00', '2012', '2013-02-01', '2013-02-01') ; 
INSERT INTO `tjmagents` VALUES (10, '2012 - QUALIF H', NULL, '626.00', '2012', '2013-02-01', '2013-02-01') ; 
INSERT INTO `tjmagents` VALUES (11, '2012 - QUALIF F', NULL, '477.00', '2012', '2013-02-01', '2013-02-01') ; 
INSERT INTO `tjmagents` VALUES (12, '2012 - ESR GROUP Architecte', NULL, '709.00', '2012', '2013-02-01', '2013-02-01') ; 
INSERT INTO `tjmagents` VALUES (13, '2013 - XLGROUP SMY', '603.20', NULL, '2013', '2013-02-01', '2013-02-01') ; 
INSERT INTO `tjmagents` VALUES (14, '2013 - STERIA 107', '579.00', NULL, '2013', '2013-02-01', '2013-02-01') ; 
INSERT INTO `tjmagents` VALUES (15, '2013 - STERIA 105', '604.00', NULL, '2013', '2013-02-01', '2013-02-01') ; 
INSERT INTO `tjmagents` VALUES (16, '2013 - STERIA 101', '459.00', NULL, '2013', '2013-02-01', '2013-02-01') ; 
INSERT INTO `tjmagents` VALUES (17, '2013 - STERIA 103', '547.00', NULL, '2013', '2013-02-01', '2013-02-01') ; 
INSERT INTO `tjmagents` VALUES (18, '2013 - EURIWARE EXPERT MAXIMO', '1055.60', NULL, '2013', '2013-02-01', '2013-02-01') ; 
INSERT INTO `tjmagents` VALUES (19, '2013 - STERIA 302', '399.00', NULL, '2013', '2013-02-01', '2013-02-01') ;
#
# End of data contents of table tjmagents
# --------------------------------------------------------

# WordPress : buffernow.com MySQL database backup
#
# Generated: Thursday 23. May 2013 19:38 CEST
# Hostname: localhost
# Database: `saill_200`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `achats`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `actions`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `actionslivrables`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `activites`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `activitesreelles`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `affectations`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `assistances`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `autorisations`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `contrats`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `detailplancharges`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `domaines`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `dossierpartages`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `dotations`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `facturations`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `historyactions`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `historybudgets`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `historyutilisateurs`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `linkshareds`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `listediffusions`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `livrables`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `mailtemplates`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `materielinformatiques`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `messages`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `outils`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `params`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `plancharges`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `profils`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `projets`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `replacestrings`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `sections`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `sites`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `societes`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `suivilivrables`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `tjmagents`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `tjmcontrats`
# --------------------------------------------------------


#
# Delete any existing table `tjmcontrats`
#

DROP TABLE IF EXISTS `tjmcontrats`;


#
# Table structure of table `tjmcontrats`
#

CREATE TABLE `tjmcontrats` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `TJM` decimal(25,2) NOT NULL,
  `ANNEE` year(4) NOT NULL,
  `created` date NOT NULL,
  `modified` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ;

#
# Data contents of table tjmcontrats (1 records)
#
 
INSERT INTO `tjmcontrats` VALUES (1, '640.00', '2013', '2013-02-01', '2013-02-01') ;
#
# End of data contents of table tjmcontrats
# --------------------------------------------------------

# WordPress : buffernow.com MySQL database backup
#
# Generated: Thursday 23. May 2013 19:38 CEST
# Hostname: localhost
# Database: `saill_200`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `achats`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `actions`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `actionslivrables`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `activites`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `activitesreelles`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `affectations`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `assistances`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `autorisations`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `contrats`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `detailplancharges`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `domaines`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `dossierpartages`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `dotations`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `facturations`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `historyactions`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `historybudgets`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `historyutilisateurs`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `linkshareds`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `listediffusions`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `livrables`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `mailtemplates`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `materielinformatiques`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `messages`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `outils`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `params`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `plancharges`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `profils`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `projets`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `replacestrings`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `sections`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `sites`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `societes`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `suivilivrables`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `tjmagents`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `tjmcontrats`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `typemateriels`
# --------------------------------------------------------


#
# Delete any existing table `typemateriels`
#

DROP TABLE IF EXISTS `typemateriels`;


#
# Table structure of table `typemateriels`
#

CREATE TABLE `typemateriels` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `NOM` varchar(30) CHARACTER SET latin1 NOT NULL,
  `DESCRIPTION` text CHARACTER SET latin1,
  `created` date NOT NULL,
  `modified` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8 ;

#
# Data contents of table typemateriels (31 records)
#
 
INSERT INTO `typemateriels` VALUES (1, 'Ordinateur de bureau', 'Ordinateur de bureau à l\'accord cadre', '2013-02-01', '2013-02-01') ; 
INSERT INTO `typemateriels` VALUES (2, 'Portable', 'Portable à l\'accord cadre', '2013-02-01', '2013-02-01') ; 
INSERT INTO `typemateriels` VALUES (3, 'ECRAN 19 pouces', NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `typemateriels` VALUES (4, 'ECRAN 22 pouces', NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `typemateriels` VALUES (5, 'ECRAN 24 pouces', NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `typemateriels` VALUES (6, 'SOURIS', NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `typemateriels` VALUES (7, 'SOURIS pour portable', NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `typemateriels` VALUES (8, 'BASE PORTABLE', NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `typemateriels` VALUES (9, 'CLAVIER', NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `typemateriels` VALUES (10, 'BATTERIE LONGUE DUREE', NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `typemateriels` VALUES (11, 'GRAVEUR DVD EXTERNE', NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `typemateriels` VALUES (12, 'DISQUE DUR EXTERNE 320GO', NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `typemateriels` VALUES (13, 'SACOCHE', NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `typemateriels` VALUES (14, 'HOUSSE PROTECTION', NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `typemateriels` VALUES (15, 'CLE USB 8GO', NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `typemateriels` VALUES (16, 'CASQUE TELEPHONE', NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `typemateriels` VALUES (17, 'CABLE RJ45', NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `typemateriels` VALUES (18, 'ANTIVOL PORTABLE', NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `typemateriels` VALUES (19, 'BADGE ACCES TO²', NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `typemateriels` VALUES (20, 'BADGE IMPRESSION', NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `typemateriels` VALUES (21, 'CLE CAFE', NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `typemateriels` VALUES (22, 'TELEPHONE ASTREINTE', NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `typemateriels` VALUES (23, 'CLE VPN', NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `typemateriels` VALUES (24, 'MS OFFICE 2007', NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `typemateriels` VALUES (25, 'BADGE PALIER', NULL, '2013-02-01', '2013-02-01') ; 
INSERT INTO `typemateriels` VALUES (26, 'MS VISIO 2010', 'Commander la licence', '2013-02-01', '2013-02-01') ; 
INSERT INTO `typemateriels` VALUES (27, 'MS PROJECT 2010', 'Commander la licence', '2013-02-01', '2013-02-01') ; 
INSERT INTO `typemateriels` VALUES (28, 'UC BUREAU station graphique', 'Station graphique Z210 CIV<br />Intel Core i3 - 2120 &agrave; 3.3Ghz - 8 Go de RAM - DD 300 Go<br />OS : Windows 7 x64', '2013-02-01', '2013-02-01') ; 
INSERT INTO `typemateriels` VALUES (29, 'SAC A DOS PORT', 'Marque PORT', '2013-02-01', '2013-02-01') ; 
INSERT INTO `typemateriels` VALUES (30, 'SAC A DOS', '', '2013-02-01', '2013-02-01') ; 
INSERT INTO `typemateriels` VALUES (31, 'ALIMENTATION PORTABLE', NULL, '2013-02-01', '2013-02-01') ;
#
# End of data contents of table typemateriels
# --------------------------------------------------------

# WordPress : buffernow.com MySQL database backup
#
# Generated: Thursday 23. May 2013 19:38 CEST
# Hostname: localhost
# Database: `saill_200`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `achats`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `actions`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `actionslivrables`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `activites`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `activitesreelles`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `affectations`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `assistances`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `autorisations`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `contrats`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `detailplancharges`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `domaines`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `dossierpartages`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `dotations`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `facturations`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `historyactions`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `historybudgets`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `historyutilisateurs`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `linkshareds`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `listediffusions`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `livrables`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `mailtemplates`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `materielinformatiques`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `messages`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `outils`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `params`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `plancharges`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `profils`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `projets`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `replacestrings`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `sections`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `sites`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `societes`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `suivilivrables`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `tjmagents`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `tjmcontrats`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `typemateriels`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `utilisateurs`
# --------------------------------------------------------


#
# Delete any existing table `utilisateurs`
#

DROP TABLE IF EXISTS `utilisateurs`;


#
# Table structure of table `utilisateurs`
#

CREATE TABLE `utilisateurs` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `profil_id` int(15) DEFAULT NULL,
  `societe_id` int(15) NOT NULL,
  `assistance_id` int(15) DEFAULT NULL,
  `section_id` int(15) DEFAULT NULL,
  `utilisateur_id` int(15) DEFAULT NULL COMMENT 'Hiérarchique',
  `valideur_id` int(15) DEFAULT NULL,
  `domaine_id` int(15) DEFAULT NULL,
  `site_id` int(15) DEFAULT NULL,
  `tjmagent_id` int(15) DEFAULT NULL,
  `dotation_id` int(15) DEFAULT NULL,
  `password` varchar(35) NOT NULL DEFAULT 'SAILL',
  `username` varchar(35) DEFAULT NULL COMMENT 'login déclaré dans AD',
  `ACTIF` tinyint(1) NOT NULL DEFAULT '1',
  `DATEDEBUTACTIF` date DEFAULT NULL,
  `NAISSANCE` date NOT NULL,
  `NOM` varchar(35) NOT NULL,
  `PRENOM` varchar(35) NOT NULL,
  `COMMENTAIRE` longtext,
  `FINMISSION` date DEFAULT NULL,
  `MAIL` varchar(512) DEFAULT NULL,
  `TELEPHONE` varchar(15) DEFAULT NULL,
  `WORKCAPACITY` int(3) DEFAULT '100',
  `CONGE` int(15) DEFAULT '0',
  `RQ` int(15) DEFAULT '0',
  `VT` int(15) DEFAULT '0',
  `HIERARCHIQUE` tinyint(1) NOT NULL DEFAULT '0',
  `GESTIONABSENCES` tinyint(1) NOT NULL DEFAULT '0',
  `WIDEAREA` tinyint(1) NOT NULL DEFAULT '0',
  `created` date NOT NULL,
  `modified` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=280 DEFAULT CHARSET=utf8 ;

#
# Data contents of table utilisateurs (279 records)
#
 
INSERT INTO `utilisateurs` VALUES (1, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '30d799da0074745df45edf52713e1378', '0000000A', 1, '2013-02-01', '2013-02-01', 'ADMINISTRATEUR', 'Administrateur', 'Mot de passe @DMIN', NULL, NULL, NULL, 100, 0, 0, 0, 0, 0, 1, '2013-02-01', '2013-02-01') ; 
INSERT INTO `utilisateurs` VALUES (2, 4, 1, 1, 1, 4, NULL, NULL, 1, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', '7109567R', 0, NULL, '1971-01-01', 'GRIVET', 'Pierre', '', '2013-03-31', 'pierre.grivet@sncf.fr', '50 47 90', 100, 0, 0, 0, 0, 0, 1, '2013-02-01', '2013-03-25') ; 
INSERT INTO `utilisateurs` VALUES (3, 3, 1, 1, 2, NULL, NULL, 1, 1, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', '6511008H', 1, NULL, '1965-01-01', 'JERCZYNSKI', 'Jean-Bruno', '', NULL, 'jean-bruno.jerczynski@sncf.fr', '50 47 07', 100, 0, 0, 0, 1, 1, 1, '2013-02-01', '2013-03-25') ; 
INSERT INTO `utilisateurs` VALUES (4, 3, 5, 1, 1, NULL, NULL, 1, 1, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', '6809291D', 1, NULL, '1968-01-01', 'ANDRE', 'Antoine', '', NULL, 'antoine.andre@sncf.fr', '50 47 06', 100, 0, 0, 0, 1, 1, 1, '2013-02-01', '2013-03-25') ; 
INSERT INTO `utilisateurs` VALUES (5, 1, 1, 1, 1, 4, NULL, 25, 1, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', '6404901Z', 1, NULL, '1964-06-21', 'LEVAVASSEUR', 'Jacques', '', NULL, 'jacques.levavasseur@sncf.fr', '50 47 10', 80, 8, 0, 29, 0, 1, 1, '2013-02-01', '2013-05-14') ; 
INSERT INTO `utilisateurs` VALUES (6, 5, 1, 1, 1, 4, NULL, 25, 1, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', '6509676K', 1, NULL, '1965-01-01', 'BURIAND', 'Magali', '', NULL, 'magali.buriand@sncf.fr', '50 49 88', 100, 10, 23, 25, 0, 1, 1, '2013-02-01', '2013-05-15') ; 
INSERT INTO `utilisateurs` VALUES (7, 4, 1, 1, 1, 4, NULL, 23, 1, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', '6505456Y', 1, NULL, '1965-04-19', 'GEOFFROY', 'Sabine', '', NULL, 'sabine.geoffroy@sncf.fr', '50 45 56', 80, 0, 0, 0, 0, 1, 1, '2013-02-01', '2013-05-16') ; 
INSERT INTO `utilisateurs` VALUES (8, 4, 1, 1, 1, 4, NULL, 10, 1, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', '6705112R', 1, NULL, '1967-01-01', 'VIDAL', 'Mireille', '', NULL, 'mireille.vidal@sncf.fr', '50 47 80', 80, 0, 0, 0, 0, 1, 1, '2013-02-01', '2013-03-25') ; 
INSERT INTO `utilisateurs` VALUES (9, 4, 1, 1, 1, 4, NULL, 7, 3, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', '7606954D', 1, NULL, '1976-01-01', 'BRANCATA', 'Julien', '', NULL, 'julien.brancata@sncf.fr', '59 67 38', 100, 0, 0, 0, 0, 1, 1, '2013-02-01', '2013-03-25') ; 
INSERT INTO `utilisateurs` VALUES (10, 5, 1, 1, 1, 4, NULL, 25, 3, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', '5912416P', 1, NULL, '1959-01-01', 'DOUVALIAN', 'Jean-Baptiste', '', NULL, 'jean-baptiste.douvalian@sncf.f', '59 69 83', 100, 0, 0, 0, 0, 1, 1, '2013-02-01', '2013-03-25') ; 
INSERT INTO `utilisateurs` VALUES (11, 4, 1, 1, 1, 4, NULL, 7, 1, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', '6711380D', 1, NULL, '1967-01-01', 'PONCIN', 'Laurent', '', NULL, 'laurent.poncin@sncf.fr', '59 67 46', 100, 0, 0, 0, 0, 1, 1, '2013-02-01', '2013-03-25') ; 
INSERT INTO `utilisateurs` VALUES (12, 3, 1, 1, 1, NULL, NULL, 10, 1, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', '6803936H', 1, NULL, '1968-01-01', 'JEANSON', 'Frédéric', '', NULL, 'frederic.jeanson@sncf.fr', '50 47 09', 100, 0, 0, 0, 0, 1, 1, '2013-02-01', '2013-03-25') ; 
INSERT INTO `utilisateurs` VALUES (13, 4, 1, 1, 2, 3, NULL, 8, 1, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', '6411268V', 1, NULL, '1964-01-01', 'RIFFIOD', 'Patricia', '', NULL, 'patricia.riffiod@sncf.fr', '50 47 12', 80, 0, 0, 0, 0, 1, 1, '2013-02-01', '2013-03-25') ; 
INSERT INTO `utilisateurs` VALUES (14, 4, 1, 1, 2, 3, NULL, 9, 1, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', '7308835L', 1, NULL, '1973-01-01', 'THIAULT', 'Hugues', '', NULL, 'hugues.thiault@sncf.fr', '50 47 16', 80, 0, 0, -9, 0, 1, 1, '2013-02-01', '2013-05-14') ; 
INSERT INTO `utilisateurs` VALUES (15, 6, 1, 1, 7, NULL, NULL, NULL, 1, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', '7009667D', 1, NULL, '1970-01-01', 'MERCURIO', 'Nicolas', '', NULL, 'nicolas.mercurio@sncf.fr', '50 47 08', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-03-25') ; 
INSERT INTO `utilisateurs` VALUES (16, 4, 1, 1, 2, 3, NULL, 16, 1, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', '7310752V', 1, NULL, '1973-01-01', 'THARSIS', 'Nathalie', '', NULL, 'nathalie.tharsis@sncf.fr', '50 47 33', 100, 0, 0, 0, 0, 1, 1, '2013-02-01', '2013-03-25') ; 
INSERT INTO `utilisateurs` VALUES (17, 6, 2, 1, 2, 3, NULL, 16, 1, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PSBS01701', 1, NULL, '1970-01-01', 'BELLACHES', 'Stephen', '', '2014-01-05', 'ext.sqli.stephen.bellaches@sncf.fr', '50 47 23', 100, 0, 0, 0, 0, 1, 0, '2013-02-01', '2013-03-25') ; 
INSERT INTO `utilisateurs` VALUES (18, 6, 3, 1, 2, 3, NULL, NULL, 1, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PRHI09631', 1, NULL, '1963-09-01', 'HASSANI', 'Rachid', '', '2014-01-05', 'ext.steria.rachid.hassani@sncf.fr', '50 47 22', 100, 0, 0, 0, 0, 1, 0, '2013-02-01', '2013-03-25') ; 
INSERT INTO `utilisateurs` VALUES (19, 33, 0, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PCHT06681', 0, NULL, '0000-00-00', 'HUBERT', 'Cécile', NULL, '2013-01-05', '', '', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01') ; 
INSERT INTO `utilisateurs` VALUES (20, 33, 22, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PAGR12761', 0, NULL, '0000-00-00', 'GARNIER', 'Aude', NULL, '2012-09-24', 'ext.atos.aude.garnier@sncf.fr', '', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01') ; 
INSERT INTO `utilisateurs` VALUES (21, 33, 11, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PACD08741', 0, NULL, '0000-00-00', 'DUPONT', 'Annie-Claude', NULL, '2013-01-05', '', '', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01') ; 
INSERT INTO `utilisateurs` VALUES (22, 3, 1, 1, 2, 3, NULL, 13, 1, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', '7710618G', 1, NULL, '1977-01-01', 'TRENTO', 'Benoit', '', NULL, 'benoit.trento@sncf.fr', '50 45 89', 100, 0, 0, 0, 0, 1, 1, '2013-02-01', '2013-05-14') ; 
INSERT INTO `utilisateurs` VALUES (23, 7, 7, 1, 4, NULL, NULL, NULL, 3, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PBLT12611', 1, NULL, '1961-12-01', 'LEFORT', 'Bruno', '', '2014-01-05', 'ext.capgemini.bruno.lefort@sncf.fr', '59 67 64', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-03-25') ; 
INSERT INTO `utilisateurs` VALUES (24, 33, 11, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PJSI08881', 0, NULL, '1988-08-01', 'SARFATI', 'Jonathan', NULL, '2012-11-13', 'ext.capgemini.jonathan.sarfati@sncf.fr', '59 67 69', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01') ; 
INSERT INTO `utilisateurs` VALUES (25, 33, 11, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PHAH03851', 0, NULL, '0000-00-00', 'ANOULIRH', 'Hassan', NULL, '2013-01-05', 'ext.capgemini.hassan.anoulirh@sncf.fr', '59 69 15', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01') ; 
INSERT INTO `utilisateurs` VALUES (26, 33, 11, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PPGN06901', 0, NULL, '1990-06-01', 'GRANCHON', 'PASCAL', NULL, '2013-03-19', 'ext.capgemini.pascal.granchon@sncf.fr', '02 28 20 40 04', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01') ; 
INSERT INTO `utilisateurs` VALUES (27, 7, 7, 1, 4, NULL, NULL, NULL, 3, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PDFA08671', 1, NULL, '1967-08-11', 'FLOREA', 'DONI', '', '2014-01-05', 'ext.capgemini.doni.florea@sncf.fr', '59 69 14', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-03-25') ; 
INSERT INTO `utilisateurs` VALUES (28, 7, 7, 1, 4, NULL, NULL, NULL, 3, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PPDC12891', 1, NULL, '1989-12-01', 'DE-CHANTERAC', 'Paul-Just', '', '2014-01-05', 'ext.capgemini.paul-just.de-chanterac@sncf.fr', '59 51 92', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-03-25') ; 
INSERT INTO `utilisateurs` VALUES (29, 7, 7, 1, 4, NULL, NULL, NULL, 4, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PABT07801', 1, NULL, '1980-07-01', 'BOUGAULT', 'Alexandre', '', '2014-01-05', 'ext.capgemini.alexandre.bougault@sncf.fr', '02 28 20 09 07', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-03-25') ; 
INSERT INTO `utilisateurs` VALUES (30, 33, 11, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PLAM08821', 0, NULL, '1982-08-01', 'ABDMEZIEM', 'Leila', NULL, '2013-03-19', 'ext.capgemini.leila.abdmeziem@sncf.fr', '02 28 20 13 45', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01') ; 
INSERT INTO `utilisateurs` VALUES (31, 33, 11, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PJAR08591', 0, NULL, '1959-09-01', 'ASTIER', 'Jocelyne', NULL, '2012-11-13', 'ext.capgemini.jocelyne.astier@sncf.fr', '', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01') ; 
INSERT INTO `utilisateurs` VALUES (32, 33, 0, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', '', 0, NULL, '0000-00-00', 'CAPPA', 'Fabien', NULL, '2013-01-05', '', '', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01') ; 
INSERT INTO `utilisateurs` VALUES (33, 6, 5, 1, 2, 3, NULL, 16, 1, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PIMR04741', 1, NULL, '1974-04-01', 'MEZABER', 'Idris', '', '2014-01-05', 'ext.astek.Idris.MEZABER@sncf.fr', '50 46 78', 100, 0, 0, 0, 0, 1, 0, '2013-02-01', '2013-03-25') ; 
INSERT INTO `utilisateurs` VALUES (34, 5, 1, 1, 2, 3, NULL, 14, 3, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', '7507337Z', 1, NULL, '1975-01-01', 'DELAVERNHE', 'Julien', '', NULL, 'julien.delavernhe@sncf.fr', '50 47 34', 100, 0, 0, 0, 0, 1, 1, '2013-02-01', '2013-03-25') ; 
INSERT INTO `utilisateurs` VALUES (35, 3, 1, 1, 2, NULL, NULL, 1, 3, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', '5817131U', 1, NULL, '1958-01-01', 'MARCKMANN', 'Laurence', '', NULL, 'laurence.marckmann@sncf.fr', '59 69 25', 100, 0, 0, 0, 0, 1, 1, '2013-02-01', '2013-03-25') ; 
INSERT INTO `utilisateurs` VALUES (36, 6, 3, 1, 2, 3, NULL, 13, 1, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PACN01711', 1, NULL, '1971-01-01', 'COHEN', 'Aaron', '', '2014-01-05', 'ext.steria.aaron.cohen@sncf.fr', '50 51 36', 100, 0, 0, 0, 0, 1, 0, '2013-02-01', '2013-03-25') ; 
INSERT INTO `utilisateurs` VALUES (37, 33, 7, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PEMR03761', 0, NULL, '0000-00-00', 'MEALLIER', 'Eric', NULL, '2013-01-05', '', '50 48 63', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01') ; 
INSERT INTO `utilisateurs` VALUES (38, 6, 10, 1, 2, 3, NULL, 13, 1, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PSMY07731', 1, NULL, '1973-07-01', 'MIDY', 'Stéphane', '', '2014-01-05', 'ext.steria.stephane.midy@sncf.fr', '50 51 36', 100, 0, 0, 0, 0, 1, 0, '2013-02-01', '2013-03-25') ; 
INSERT INTO `utilisateurs` VALUES (39, 10, 1, 1, 2, 3, NULL, 25, 1, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', '8905707S', 1, NULL, '1989-01-01', 'SIMONET', 'Pierre', '', NULL, 'ext.stagiaire.pierre.simonet@sncf.fr', '', 100, 0, 0, 0, 0, 1, 1, '2013-02-01', '2013-03-25') ; 
INSERT INTO `utilisateurs` VALUES (40, 6, 9, 1, 1, 4, NULL, 7, 3, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PGPE11651', 1, NULL, '1965-11-01', 'PESCE', 'Gilles', '', '2014-01-05', 'gilles.pesce@euriware.fr', '59 69 53', 100, 0, 0, 0, 0, 1, 0, '2013-02-01', '2013-03-25') ; 
INSERT INTO `utilisateurs` VALUES (41, 9, 9, 1, 5, NULL, NULL, NULL, 3, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PPFT01801', 1, NULL, '1980-01-01', 'FIQUET', 'Pascal', '', '2014-01-05', 'ext.euriware.pascal.fiquet@sncf.fr', '', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-03-25') ; 
INSERT INTO `utilisateurs` VALUES (42, 33, 11, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PASI08811', 0, NULL, '1981-08-01', 'SAIDI', 'Ahmed', NULL, '0000-00-00', '', '', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01') ; 
INSERT INTO `utilisateurs` VALUES (43, 33, 11, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PESD03601', 0, NULL, '1960-03-01', 'SIBEUD', 'Eric', NULL, '0000-00-00', '', '', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01') ; 
INSERT INTO `utilisateurs` VALUES (44, 7, 8, 2, 4, NULL, NULL, NULL, 3, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PTGR04601', 1, NULL, '1960-04-01', 'GARNIER', 'Thierry', '', '2014-01-05', 'ext.ibm.thierry.garnier@sncf.fr', '59 69 36', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-03-25') ; 
INSERT INTO `utilisateurs` VALUES (45, 33, 11, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PPPE11821', 0, NULL, '1982-11-01', 'PRUDHOMME', 'Pierre', NULL, '0000-00-00', '', '', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01') ; 
INSERT INTO `utilisateurs` VALUES (46, 7, 7, 2, 4, NULL, NULL, NULL, 3, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PJDE07781', 1, NULL, '1978-07-27', 'DELALANDE', 'Julien', '', '2014-01-05', 'ext.capgemini.julien.delalande@sncf.fr', '59 69 12', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-03-25') ; 
INSERT INTO `utilisateurs` VALUES (47, 7, 7, 2, 4, NULL, NULL, NULL, 3, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PCBD02811', 1, NULL, '1981-02-10', 'BRIARD', 'Clément', '', '2014-01-05', 'ext.capgemini.briard@sncf.fr', '59 68 39', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-03-25') ; 
INSERT INTO `utilisateurs` VALUES (48, 7, 7, 1, 4, NULL, NULL, NULL, 3, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PFRB03801', 1, NULL, '1980-03-10', 'BOUE', 'François-Régis', '', '2014-01-05', 'ext.capgemini.francois-regis.boue@sncf.fr', '59 68 39', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-03-25') ; 
INSERT INTO `utilisateurs` VALUES (49, 33, 11, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PABG04831', 0, NULL, '1983-04-24', 'BEN GHACHEM ', 'Aziz', NULL, '2013-01-05', 'ext.capgemini.aziz.ben_ghachem@sncf.fr', '', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01') ; 
INSERT INTO `utilisateurs` VALUES (50, 7, 7, 1, 4, NULL, NULL, NULL, 3, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PSJS09661', 1, NULL, '1966-09-10', 'JABBES', 'Sélim', '', '2014-01-05', 'ext.capgemini.selim.jabbes@sncf.fr', '59 68 40', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-03-25') ; 
INSERT INTO `utilisateurs` VALUES (51, 7, 7, 2, 4, NULL, NULL, NULL, 3, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PKDH04811', 1, NULL, '1981-04-01', 'DEBBAGH', 'Kinda', '', '2014-01-05', 'ext.capgemini.kinda.debbagh@sncf.fr', '59 68 64', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-03-25') ; 
INSERT INTO `utilisateurs` VALUES (52, 33, 11, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PADS05761', 0, NULL, '1976-05-26', 'DUBOIS', 'Alexandre', NULL, '2013-01-05', '', '', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01') ; 
INSERT INTO `utilisateurs` VALUES (53, 7, 7, 1, 4, NULL, NULL, NULL, 3, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PVPR11801', 1, NULL, '1980-11-05', 'PAUMIER', 'Vincent', '', '2014-01-05', 'ext.capgemini.vincent.paumier@sncf.fr', '59 67 74', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-03-25') ; 
INSERT INTO `utilisateurs` VALUES (54, 7, 7, 1, 4, NULL, NULL, NULL, 3, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PJGE07851', 1, NULL, '1985-07-01', 'GENEVIEVE', 'Julien', '', '2014-01-05', 'ext.capgemini.julien.genevieve@sncf.fr', '59 69 15', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-03-25') ; 
INSERT INTO `utilisateurs` VALUES (55, 7, 7, 2, 4, NULL, NULL, NULL, 3, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PYGN11811', 1, NULL, '1981-11-01', 'GORIN', 'Yannick', '', '2014-01-05', 'ext.capgemini.yannick.gorin@sncf.fr', '59 67 81', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-03-25') ; 
INSERT INTO `utilisateurs` VALUES (56, 7, 6, 1, 4, NULL, NULL, NULL, 5, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PPTS04711', 0, NULL, '1971-04-29', 'THOMAS', 'Pascal', '', '2014-01-05', 'ext.sogeti.pascal.thomas@sncf.fr', '59 69 70', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-03-25') ; 
INSERT INTO `utilisateurs` VALUES (57, 7, 7, 1, 4, NULL, NULL, NULL, 3, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PDLC06591', 1, NULL, '1959-06-01', 'LECLERC', 'Dominique', '', '2014-01-05', 'ext.cap-gemini.dominique.leclerc@sncf.fr', '59 67 61', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-03-25') ; 
INSERT INTO `utilisateurs` VALUES (58, 7, 7, 1, 4, NULL, NULL, NULL, 3, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PCBR07541', 1, NULL, '1954-07-24', 'BOSRAMIER', 'Christian', '', '2014-01-05', 'ext.cap-gemini.christian.bosramier@sncf.fr', '59 67 60', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-03-25') ; 
INSERT INTO `utilisateurs` VALUES (59, 33, 11, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PJSE01621', 0, NULL, '1962-01-02', 'SALETTE', 'Jean-Etienne', NULL, '2013-02-27', 'ext.cap-gemini.jean-etienne.salette@sncf.fr', '59 67 60', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01') ; 
INSERT INTO `utilisateurs` VALUES (60, 7, 7, 1, 4, NULL, NULL, NULL, 3, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PBRN02611', 1, NULL, '1961-02-01', 'RANCHIN', 'Bruno', '', '2014-01-05', 'ext.capgemini.bruno.ranchin@sncf.fr', '59 67 64', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-03-25') ; 
INSERT INTO `utilisateurs` VALUES (61, 7, 7, 1, 4, NULL, NULL, NULL, 3, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PGPZ07611', 1, NULL, '1961-07-08', 'PITZ', 'Grazziella', '', '2014-01-05', 'ext.cap-gemini.grazziella.pitz@sncf.fr', '59 51 92', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-03-25') ; 
INSERT INTO `utilisateurs` VALUES (62, 7, 11, 2, 4, NULL, NULL, NULL, 3, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PCPL01712', 1, NULL, '1971-01-22', 'PORTAL', 'Christian', '', '2014-01-05', 'ext.mdtvision.christian.portal@sncf.fr', '59 69 14', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-03-25') ; 
INSERT INTO `utilisateurs` VALUES (63, 7, 8, 1, 4, NULL, NULL, NULL, 3, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PVBR08561', 0, NULL, '1956-08-19', 'BERNIER', 'Vincent', '', '2013-01-05', '', '', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-05-16') ; 
INSERT INTO `utilisateurs` VALUES (64, 7, 8, 2, 4, NULL, NULL, NULL, 3, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PSDN11721', 1, NULL, '2013-01-05', 'DERRIEN', 'Stephane', '', '2014-01-05', 'ext.ibm.stephane.derrien@sncf.fr', '59 69 14', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-03-25') ; 
INSERT INTO `utilisateurs` VALUES (65, 7, 6, 1, 4, NULL, NULL, NULL, 5, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PASL04821', 1, NULL, '1982-04-01', 'SIMON-COLL', 'Arnaud', '', '2014-01-05', 'ext.sogeti.arnaud.simon-coll@sncf.fr', '59 69 70', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-03-25') ; 
INSERT INTO `utilisateurs` VALUES (66, 7, 6, 1, 4, NULL, NULL, NULL, 5, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PNMN12791', 1, NULL, '1979-12-01', 'MARTIN', 'Nicolas', '', '2014-01-05', 'ext.sogeti.nicolas.martin@sncf.fr', '04 72 44 40 66', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-03-25') ; 
INSERT INTO `utilisateurs` VALUES (67, 7, 6, 1, 4, NULL, NULL, NULL, 5, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PCTN07661', 1, NULL, '1966-07-01', 'TURPIN', 'Corinne', '', '2014-01-05', 'ext.sogeti.corinne.turpin@sncf.fr', '59 69 70', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-03-25') ; 
INSERT INTO `utilisateurs` VALUES (68, 33, 10, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PFGR04651', 0, NULL, '1965-04-01', 'GOELLNER', 'François', NULL, '2013-03-19', 'ext.sogeti.francois.goellner@sncf.fr', '59 69 70', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01') ; 
INSERT INTO `utilisateurs` VALUES (69, 7, 6, 1, 4, NULL, NULL, NULL, 5, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PNMN07811', 1, NULL, '1981-07-01', 'MANIN', 'Nicolas', '', '2014-01-05', 'ext.sogeti.nicolas.manin@sncf.fr', '04 72 44 40 79', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-03-25') ; 
INSERT INTO `utilisateurs` VALUES (70, 7, 8, 1, 4, NULL, NULL, NULL, 3, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PXDX02591', 1, NULL, '1959-02-01', 'DEVAUX', 'Xavier', '', '2014-01-05', '70677297@fr.ibm.com', '59 69 70', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-03-28') ; 
INSERT INTO `utilisateurs` VALUES (71, 33, 11, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PMTS09781', 0, NULL, '1978-09-15', 'THOMAS', 'Mylène', NULL, '2013-01-05', '', '', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01') ; 
INSERT INTO `utilisateurs` VALUES (72, 9, 1, 2, 5, NULL, NULL, NULL, 3, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', '5908401A', 1, NULL, '1959-01-01', 'GANDOIS', 'Jean-claude', '', NULL, 'jean-claude.gandois@sncf.fr', '', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-03-25') ; 
INSERT INTO `utilisateurs` VALUES (73, 33, 0, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PCDN08701', 0, NULL, '1970-08-01', 'DAHAN', 'Cyrille', NULL, '0000-00-00', '', '', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01') ; 
INSERT INTO `utilisateurs` VALUES (74, 9, 1, 2, 5, NULL, NULL, NULL, 3, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', '8110607C', 1, NULL, '1981-01-01', 'MONTROIG', 'Thomas', '', NULL, 'thomas.montroig@sncf.fr', '', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-03-25') ; 
INSERT INTO `utilisateurs` VALUES (75, 7, 7, 1, 4, NULL, NULL, NULL, 3, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PABX06621', 1, NULL, '1962-06-30', 'BARDOUX', 'Antoine', '', '2014-01-05', 'ext.capgemini.antoine.bardoux@sncf.fr', '59 67 64', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-03-25') ; 
INSERT INTO `utilisateurs` VALUES (76, 7, 7, 2, 4, NULL, NULL, NULL, 3, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PSBE10841', 1, NULL, '1984-10-28', 'BABOUCHE', 'Saïd', '', '2014-01-05', 'ext.cap-gemini.said.babouche@sncf.f', '', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-03-25') ; 
INSERT INTO `utilisateurs` VALUES (77, 33, 11, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PCAA04831', 0, NULL, '1983-04-01', 'AIXALA', 'Clément', NULL, '2013-01-05', '', '', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01') ; 
INSERT INTO `utilisateurs` VALUES (78, 33, 11, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PGAN01801', 0, NULL, '1980-01-02', 'ANGAMAN', 'Gillepsie', NULL, '2012-11-13', 'ext.capgemini.gillepsie.angaman@sncf.fr', '59 67 92', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01') ; 
INSERT INTO `utilisateurs` VALUES (79, 33, 11, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PCAN12851', 0, NULL, '1985-12-05', 'AUBURTIN', 'Céline', NULL, '2013-01-05', '', '59 67 93', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01') ; 
INSERT INTO `utilisateurs` VALUES (80, 7, 7, 1, 4, NULL, NULL, NULL, 3, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PCCT03751', 1, NULL, '1975-03-04', 'CHABAULT', 'Christophe', '', '2014-01-05', 'ext.capgemini.christophe.chabault@sncf.fr', '59 69 41', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-03-25') ; 
INSERT INTO `utilisateurs` VALUES (81, 33, 11, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PRPT02821', 0, NULL, '1982-02-15', 'PETIT', 'Raphael', NULL, '2012-11-13', 'ext.capgemini.raphael.petit@sncf.fr', '59 69 15', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01') ; 
INSERT INTO `utilisateurs` VALUES (82, 33, 11, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PBSE10781', 0, NULL, '0000-00-00', 'ST-PIERRE', 'Benoit', NULL, '2012-08-23', '', '', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01') ; 
INSERT INTO `utilisateurs` VALUES (83, 7, 6, 1, 4, NULL, NULL, NULL, 5, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PAGL10791', 1, NULL, '1979-10-17', 'GANCEL', 'Antoine', '', '2014-01-05', 'ext.sogeti.antoine.gancel@sncf.fr', '04 72 44 40 76', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-03-25') ; 
INSERT INTO `utilisateurs` VALUES (84, 7, 6, 1, 4, NULL, NULL, NULL, 5, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PMSA01871', 1, NULL, '1987-01-07', 'SPICA', 'Marc', '', '2014-01-05', 'ext.sogeti.marc.spica@sncf.fr', '04 72 44 40 76', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-03-25') ; 
INSERT INTO `utilisateurs` VALUES (85, 33, 10, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PJSZ02601', 0, NULL, '1960-02-18', 'SMYCZ', 'Janusz', NULL, '2012-08-23', '', '', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01') ; 
INSERT INTO `utilisateurs` VALUES (86, 33, 11, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PJPR03821', 0, NULL, '1982-03-22', 'PASQUIER', 'Jonathan', NULL, '2013-01-05', '', '59 69 16', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01') ; 
INSERT INTO `utilisateurs` VALUES (87, 7, 7, 2, 4, NULL, NULL, NULL, 3, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PVME06771', 1, NULL, '1977-06-15', 'MARQUILLIE', 'Vincent', '', '2014-01-05', 'ext.capgemini.vincent.marquillie@sncf.fr', '59 69 16', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-03-28') ; 
INSERT INTO `utilisateurs` VALUES (88, 33, 24, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PPVN08631', 0, NULL, '1963-08-08', 'VALENTIN', 'Philippe', NULL, '2012-11-13', 'ext.quaternaire.philippe.valentin@sncf.fr', '', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01') ; 
INSERT INTO `utilisateurs` VALUES (89, 33, 11, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PEBS10691', 0, NULL, '1969-10-26', 'BLANCHAIS', 'Eric', NULL, '2013-01-05', 'ext.capgemini.eric.blanchais@sncf.fr', '50 51 23', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01') ; 
INSERT INTO `utilisateurs` VALUES (90, 33, 11, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PJGE11751', 0, NULL, '1975-11-07', 'GARGUELLE', 'Jean-Michel', NULL, '2013-01-05', '', '', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01') ; 
INSERT INTO `utilisateurs` VALUES (91, 33, 11, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PAEA06831', 0, NULL, '1983-06-11', 'ESPINDOLA', 'Armando', NULL, '2013-01-05', '', '', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01') ; 
INSERT INTO `utilisateurs` VALUES (92, 33, 11, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PRSD11851', 0, NULL, '1985-11-10', 'SICARD', 'Raphael', NULL, '2013-01-05', '', '', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01') ; 
INSERT INTO `utilisateurs` VALUES (93, 33, 10, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PDGE11811', 0, NULL, '1981-11-25', 'GAYTE', 'David', NULL, '2013-03-19', 'ext.sogeti.david.gayte@sncf.fr', '', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01') ; 
INSERT INTO `utilisateurs` VALUES (94, 7, 6, 1, 4, NULL, NULL, NULL, 5, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'POMB03841', 1, NULL, '1984-03-01', 'MAHJOUB', 'Ouséma', '', '2014-01-05', 'ext.sogeti.ousema.mahjoub@sncf.fr', '', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-03-25') ; 
INSERT INTO `utilisateurs` VALUES (95, 33, 11, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PSCU07841', 0, NULL, '1984-07-02', 'CHEVEAU', 'Sébastien', NULL, '2013-01-05', '', 'Incconu', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01') ; 
INSERT INTO `utilisateurs` VALUES (96, 7, 7, 1, 4, NULL, NULL, NULL, 3, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PNDV11671', 1, NULL, '1967-11-01', 'DJINGAROV', 'Nicolas', '', '2014-01-05', 'ext.capgemini.nicolas.djingarov@sncf.fr', '59 67 69', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-03-25') ; 
INSERT INTO `utilisateurs` VALUES (97, 33, 11, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PJPT06711', 0, NULL, '1971-06-16', 'TIREL', 'Jean-Paul', NULL, '2013-01-05', '', '', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01') ; 
INSERT INTO `utilisateurs` VALUES (98, 7, 6, 1, 4, NULL, NULL, NULL, 5, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PCTE11761', 1, NULL, '1976-11-23', 'TUMELAIRE', 'Cedric', '', '2014-01-05', 'ext.sogeti.cedric.tumelaire@sncf.fr', '', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-03-25') ; 
INSERT INTO `utilisateurs` VALUES (99, 33, 11, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'POBN09871', 0, NULL, '1987-09-07', 'BENJAMIN', 'Olivier', NULL, '2013-02-27', 'ext.capgemini.olivier.benjamin@sncf.fr', '59 69 11', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01') ; 
INSERT INTO `utilisateurs` VALUES (100, 33, 11, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PABN09841', 0, NULL, '1984-09-20', 'BENCHEKROUN', 'Amine', NULL, '2013-01-05', '', '', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01') ; 
INSERT INTO `utilisateurs` VALUES (101, 7, 7, 1, 4, NULL, NULL, NULL, 3, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PBDI07741', 1, NULL, '1974-07-04', 'DJEDAI', 'Boulanouar', '', '2014-01-05', 'ext.cap-gemini.boulanouar.djedai@sncf.fr', '59 69 11', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-03-25') ; 
INSERT INTO `utilisateurs` VALUES (102, 7, 7, 1, 4, NULL, NULL, NULL, 3, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PRHD06881', 1, NULL, '1988-06-29', 'HAMAD', 'Ragheb', '', '2014-01-05', 'ext.capgemini.ragheb.hamad@sncf.fr', '59 69 00', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-03-25') ; 
INSERT INTO `utilisateurs` VALUES (103, 33, 11, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PSHG05851', 0, NULL, '1983-11-16', 'HUANG', 'SiWei', NULL, '2013-01-05', '', '', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01') ; 
INSERT INTO `utilisateurs` VALUES (104, 33, 11, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PAOI02881', 0, NULL, '1988-02-22', 'OLIVI', 'Alan', NULL, '2013-01-05', '', '', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01') ; 
INSERT INTO `utilisateurs` VALUES (105, 7, 6, 1, 4, NULL, NULL, NULL, 5, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PAFN03891', 1, NULL, '1989-03-03', 'FRASLIN', 'Aurélie', '', '2014-01-05', 'ext.sogeti.aurelie.fraslin@sncf.fr', '', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-03-25') ; 
INSERT INTO `utilisateurs` VALUES (106, 7, 6, 1, 4, NULL, NULL, NULL, 5, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PLMT04781', 1, NULL, '1978-04-04', 'MALLET', 'Laurent', '', '2014-01-05', 'ext.sogeti.laurent.mallet@sncf.fr', '', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-03-25') ; 
INSERT INTO `utilisateurs` VALUES (107, 7, 6, 1, 4, NULL, NULL, NULL, 5, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PMLA03611', 1, NULL, '1961-03-01', 'LONCA', 'Michèle', '', '2014-01-05', 'ext.sogeti.michele.lonca@sncf.fr', '', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-03-25') ; 
INSERT INTO `utilisateurs` VALUES (108, 7, 7, 1, 4, NULL, NULL, NULL, 3, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PRBL12811', 1, NULL, '1981-12-23', 'BOUHLAL', 'Rida', '', '2014-01-05', 'ext.capgemini.rida.bouhlal@sncf.fr', '59 69 11', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-03-25') ; 
INSERT INTO `utilisateurs` VALUES (109, 33, 11, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PYBD04841', 0, NULL, '1984-04-24', 'BENDAOUD', 'Youssef', NULL, '2013-01-05', '', '', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01') ; 
INSERT INTO `utilisateurs` VALUES (110, 7, 7, 1, 4, NULL, NULL, NULL, 3, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PFYB05821', 1, NULL, '1982-05-06', 'YAKOUB', 'Frédérique', '', '2014-01-05', 'ext.capgemini.frederique.yakoub@sncf.fr', '59 69 41', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-03-25') ; 
INSERT INTO `utilisateurs` VALUES (111, 33, 11, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PNBR12871', 0, NULL, '1987-12-01', 'BEN-OMAR', 'Najim', NULL, '2012-11-13', 'ext.capgemini.najim.ben-omar@sncf.fr', '59 69 80', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01') ; 
INSERT INTO `utilisateurs` VALUES (112, 33, 11, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PRAR05611', 0, NULL, '1961-05-21', 'ANEZAR', 'Rachid', NULL, '2012-07-16', '', '59 69 15', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01') ; 
INSERT INTO `utilisateurs` VALUES (113, 33, 11, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PFPT08831', 0, NULL, '1983-08-01', 'PITIOT', 'Franck', NULL, '2013-01-05', '', '', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01') ; 
INSERT INTO `utilisateurs` VALUES (114, 33, 11, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', '', 0, NULL, '0000-00-00', 'PELOTTE', 'Jean-Philippe', NULL, '0000-00-00', '', '', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01') ; 
INSERT INTO `utilisateurs` VALUES (115, 33, 11, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', '', 0, NULL, '0000-00-00', 'MILAZZO', 'Ilaria', NULL, '0000-00-00', '', '', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01') ; 
INSERT INTO `utilisateurs` VALUES (116, 33, 11, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', '', 0, NULL, '0000-00-00', 'BARTHEZ', 'Cécile', NULL, '0000-00-00', '', '', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01') ; 
INSERT INTO `utilisateurs` VALUES (117, 33, 11, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PSMR12681', 0, NULL, '0000-00-00', 'MONNIER', 'Stéphanie', NULL, '2012-08-23', '', '', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01') ; 
INSERT INTO `utilisateurs` VALUES (118, 33, 11, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PGTT01751', 0, NULL, '1975-01-19', 'THOMMERET', 'Gilles', NULL, '2013-01-05', '', '', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01') ; 
INSERT INTO `utilisateurs` VALUES (119, 33, 11, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PMFI06691', 0, NULL, '1969-06-16', 'FONTI', 'Martial', NULL, '2013-01-05', '', '50 51 23', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01') ; 
INSERT INTO `utilisateurs` VALUES (120, 33, 7, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PJGE05751', 0, NULL, '1975-05-26', 'GRANSAGNE', 'Julien', NULL, '2013-01-05', '', '', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01') ; 
INSERT INTO `utilisateurs` VALUES (121, 33, 13, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PPSN02811', 0, NULL, '1981-02-18', 'SITEMBOUN', 'Pierre', NULL, '2012-10-30', 'ext.euriware.pierre.sitemboun@sncf.fr', '59 68 38', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01') ; 
INSERT INTO `utilisateurs` VALUES (122, 9, 9, 2, 5, NULL, NULL, NULL, 3, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PEOI06851', 0, NULL, '1985-06-01', 'OUERTANI', 'Emina', '', '2014-01-05', 'ext.euriware.emina.ouertani@sn', '', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-03-25') ; 
INSERT INTO `utilisateurs` VALUES (123, 33, 11, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PNVE04681', 0, NULL, '0000-00-00', 'VETTESE', 'Nicolas', NULL, '2012-08-23', '', '', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01') ; 
INSERT INTO `utilisateurs` VALUES (124, 33, 10, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PBLN03851', 0, NULL, '1985-03-19', 'LOMBARDIN', 'Bertrand', NULL, '2013-03-19', 'ext.sogeti.bertrand.lombardin@sncf.fr', '', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01') ; 
INSERT INTO `utilisateurs` VALUES (125, 33, 11, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PXLD07701', 0, NULL, '0000-00-00', 'DAO', 'Xuan-Loc', NULL, '2013-01-05', '', '', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01') ; 
INSERT INTO `utilisateurs` VALUES (126, 33, 13, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', '9103529R', 0, NULL, '0000-00-00', 'FOULET', 'Thomas', NULL, '0000-00-00', '', '', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01') ; 
INSERT INTO `utilisateurs` VALUES (127, 9, 9, 2, 5, NULL, NULL, NULL, 3, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PBPT02691', 1, NULL, '1969-02-01', 'PENET', 'Benoit', '', '2014-01-05', 'ext.euriware.benoit.penet@sncf.fr', '', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-03-25') ; 
INSERT INTO `utilisateurs` VALUES (128, 33, 11, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PGSE10681', 0, NULL, '0000-00-00', 'SIEWE', 'Guy', NULL, '2012-08-23', '', '', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01') ; 
INSERT INTO `utilisateurs` VALUES (129, 33, 0, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PBCN02861', 0, NULL, '1986-02-19', 'CHAPOTON', 'Benjamin', NULL, '0000-00-00', '', '', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01') ; 
INSERT INTO `utilisateurs` VALUES (130, 33, 11, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PHBL05871', 0, NULL, '1987-05-14', 'BENJELLOUL', 'Hajar', NULL, '2013-02-27', 'ext.capgemini.hajar.benjelloul@sncf.fr', '59 69 77', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01') ; 
INSERT INTO `utilisateurs` VALUES (131, 7, 7, 1, 4, NULL, NULL, NULL, 3, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PGCN11801', 1, NULL, '1980-11-15', 'CHERON', 'Guillaume', '', '2014-01-05', 'ext.capgemini.guillaume.cheron@sncf.fr', '59 69 77', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-03-25') ; 
INSERT INTO `utilisateurs` VALUES (132, 7, 7, 1, 4, NULL, NULL, NULL, 3, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PLSO02701', 1, NULL, '1970-02-06', 'SCHIOPPETTO', 'Laurent', '', '2014-01-05', 'ext.capgemini.laurent.schioppetto@sncf.fr', '59 67 81', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-03-25') ; 
INSERT INTO `utilisateurs` VALUES (133, 7, 8, 1, 4, NULL, NULL, NULL, 3, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PWHG11831', 1, NULL, '1983-11-16', 'HUANG', 'Wei', '', '2014-01-05', 'ext.ibm.wei.huang@sncf.fr', '59 69 16', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-03-25') ; 
INSERT INTO `utilisateurs` VALUES (134, 33, 7, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PXDI08611', 0, NULL, '1961-08-27', 'DROZDZYNSKI', 'Xavier', NULL, '0000-00-00', '', '', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01') ; 
INSERT INTO `utilisateurs` VALUES (135, 33, 11, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PFGR10781', 0, NULL, '1978-10-06', 'GILIER', 'Frédéric', NULL, '0000-00-00', '', '', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01') ; 
INSERT INTO `utilisateurs` VALUES (136, 33, 10, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PBLQ05751', 0, NULL, '0000-00-00', 'LE JACQ', 'Bruno', NULL, '2013-03-19', 'ext.sogeti.bruno.le-jacq@sncf.fr', '', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01') ; 
INSERT INTO `utilisateurs` VALUES (137, 9, 1, 2, 5, NULL, NULL, NULL, 3, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', '8207861N', 1, NULL, '1982-01-01', 'GONZALEZ', 'Sophie', '', NULL, 'sophie.gonzalez@sncf.fr', '', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-03-25') ; 
INSERT INTO `utilisateurs` VALUES (138, 33, 7, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PGMS07811', 0, NULL, '1981-07-01', 'MONTEILS', 'Guillaume', NULL, '2013-01-05', '', '50 49 89', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01') ; 
INSERT INTO `utilisateurs` VALUES (139, 33, 7, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PRNL07811', 0, NULL, '1981-07-19', 'NEVRTAL', 'Radek', NULL, '2013-01-05', '', '', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01') ; 
INSERT INTO `utilisateurs` VALUES (140, 6, 3, 1, 2, 3, NULL, 16, 1, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PACT02811', 1, NULL, '1981-02-09', 'CARRET', 'Aurélie', '', '2013-07-01', 'ext.steria.aurelie.carret@sncf.fr', '50 47 25', 100, 0, 0, 0, 0, 1, 0, '2013-02-01', '2013-04-25') ; 
INSERT INTO `utilisateurs` VALUES (141, 33, 11, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PNME04861', 0, NULL, '1986-04-01', 'MANCONE', 'Nicolas', NULL, '2012-11-13', 'ext.sogeti.nicolas.mancone@sncf.fr', '', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01') ; 
INSERT INTO `utilisateurs` VALUES (142, 33, 11, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PYDI07841', 0, NULL, '1984-07-12', 'DJEMAI', 'Yacine', NULL, '2013-01-05', '', '', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01') ; 
INSERT INTO `utilisateurs` VALUES (143, 33, 11, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PLKI05711', 0, NULL, '1971-05-15', 'KILANI', 'Leila', NULL, '2013-01-05', '', '', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01') ; 
INSERT INTO `utilisateurs` VALUES (144, 7, 7, 1, 4, NULL, NULL, NULL, 3, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PCGT04811', 1, NULL, '1981-04-24', 'GEERAERT', 'Céline', '', '2014-01-05', 'ext.capgemini.celine.geeraert@sncf.fr', '59 61 50', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-03-25') ; 
INSERT INTO `utilisateurs` VALUES (145, 33, 11, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PBHQ08701', 0, NULL, '1970-08-01', 'HANNEBICQ', 'Benoit', NULL, '2013-01-05', '', '', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01') ; 
INSERT INTO `utilisateurs` VALUES (146, 33, 11, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PABU08771', 0, NULL, '1977-08-13', 'BEAU', 'Adrien', NULL, '2013-03-19', 'ext.capgemini.adrien.beau@sncf.fr', '02 28 20 12 85', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01') ; 
INSERT INTO `utilisateurs` VALUES (147, 7, 7, 1, 4, NULL, NULL, NULL, 4, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PLCN07731', 1, NULL, '1973-07-13', 'COYDON', 'Laurent', '', '2014-01-05', 'ext.capgemini.laurent.coydon@sncf.fr', '59 60 13', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-03-25') ; 
INSERT INTO `utilisateurs` VALUES (148, 7, 7, 1, 4, NULL, NULL, NULL, 3, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PSDT10841', 1, NULL, '1984-10-17', 'DUMONT', 'Stéphanie', '', '2014-01-05', 'ext.capgemini.stephanie.dumont@sncf.fr', '', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-03-25') ; 
INSERT INTO `utilisateurs` VALUES (149, 7, 7, 1, 4, NULL, NULL, NULL, 3, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PDHH12631', 1, NULL, '1963-12-01', 'HADDOUCH', 'Driss', '', '2014-01-05', 'ext.capgemini.driss.haddouch@sncf.fr', '', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-03-25') ; 
INSERT INTO `utilisateurs` VALUES (150, 33, 11, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PJJO05811', 0, NULL, '1981-05-14', 'JEGO', 'Julien', NULL, '2012-11-13', 'ext.capgemini.julien.jego@sncf.fr', '', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01') ; 
INSERT INTO `utilisateurs` VALUES (151, 7, 6, 1, 4, NULL, NULL, NULL, 5, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PLRE04711', 1, NULL, '1971-04-01', 'ROBLETTE', 'Ludovic', '', '2014-01-05', 'ext.sogeti.ludovic.roblette@sncf.fr', '', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-03-25') ; 
INSERT INTO `utilisateurs` VALUES (152, 7, 6, 1, 4, NULL, NULL, NULL, 5, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PCBZ01841', 1, NULL, '1984-01-01', 'BRESTAZ', 'Christophe', '', '2014-01-05', 'ext.sogeti.christophe.brestaz@sncf.fr', '', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-03-25') ; 
INSERT INTO `utilisateurs` VALUES (153, 33, 11, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PZHG07791', 0, NULL, '1979-07-01', 'HUANG', 'Zhenxing', NULL, '2013-01-05', '', '', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01') ; 
INSERT INTO `utilisateurs` VALUES (154, 33, 11, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PCPS06531', 0, NULL, '1953-06-01', 'PALACIOS', 'Carolina', NULL, '2012-11-26', 'ext.capgemini.carolina.palacios@sncf.fr', '', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01') ; 
INSERT INTO `utilisateurs` VALUES (155, 7, 7, 1, 4, NULL, NULL, NULL, 4, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PMTT06831', 1, NULL, '1983-06-01', 'THIBAULT', 'Mikael', '', '2014-01-05', 'ext.capgemini.mikael.thibault@sncf.fr', '02 99 27 93 73', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-03-25') ; 
INSERT INTO `utilisateurs` VALUES (156, 33, 11, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PVMR04861', 0, NULL, '1986-04-01', 'MULLER', 'Valentin', NULL, '2013-03-19', 'ext.capgemini.valentin.muller@sncf.fr', '02.28.20.16.82', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01') ; 
INSERT INTO `utilisateurs` VALUES (157, 7, 7, 1, 4, NULL, NULL, NULL, 3, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PMRZ06711', 1, NULL, '1971-06-01', 'RODRIGUEZ', 'Myriam', '', '2014-01-05', 'ext.capgemini.rodriguez@sncf.fr', '', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-03-25') ; 
INSERT INTO `utilisateurs` VALUES (158, 33, 11, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PHZE01781', 0, NULL, '1978-01-01', 'ZERKOUNE', 'Hassane', NULL, '2012-11-13', 'ext.capgemini.hassane.zerkoune@sncf.fr', '', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01') ; 
INSERT INTO `utilisateurs` VALUES (159, 33, 11, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PMDU12821', 0, NULL, '1982-12-01', 'DOITEAU', 'Matthieu', NULL, '2013-01-05', '', '', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01') ; 
INSERT INTO `utilisateurs` VALUES (160, 7, 7, 1, 4, NULL, NULL, NULL, 3, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PZBD02891', 1, NULL, '1989-02-01', 'BOUZID', 'Zakaria', '', '2014-01-05', 'ext.capgemini.zakaria.bouzid@sncf.fr', '59 68 39', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-03-25') ; 
INSERT INTO `utilisateurs` VALUES (161, 7, 7, 1, 4, NULL, NULL, NULL, 3, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PZZZ05861', 1, NULL, '1986-05-01', 'ZIZ', 'Zakaria', '', '2014-01-05', 'ext.capgemini.zakaria.ziz@sncf.fr', '59 69 11', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-03-25') ; 
INSERT INTO `utilisateurs` VALUES (162, 7, 7, 2, 4, NULL, NULL, NULL, 3, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PCCN07681', 1, NULL, '1968-07-01', 'CAPILLON', 'Christophe', '', '2014-01-05', 'ext.ibm.christophe.capillon@sncf.fr', '', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-03-25') ; 
INSERT INTO `utilisateurs` VALUES (163, 2, 16, 1, 6, NULL, NULL, NULL, 1, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PDDN10761', 0, NULL, '1976-10-01', 'DRUCKMAN', 'David', '', '2014-01-05', 'ext.coframi.david.druckman@sncf.fr', '', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-03-25') ; 
INSERT INTO `utilisateurs` VALUES (164, 33, 20, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PSKR02701', 0, NULL, '0000-00-00', 'KHODER', 'Samir', NULL, '2012-08-23', 'ext.akka.samir.khoder@sncf.fr', '', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01') ; 
INSERT INTO `utilisateurs` VALUES (165, 33, 10, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PHXN01771', 0, NULL, '1977-01-27', 'XIAOJUN', 'HE', NULL, '2013-03-19', 'ext.sogeti.he.xiaojun@sncf.fr', '', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01') ; 
INSERT INTO `utilisateurs` VALUES (166, 7, 7, 1, 4, NULL, NULL, NULL, 3, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PGCO11851', 1, NULL, '1985-11-01', 'CESARO', 'Gaétan', '', '2014-01-05', 'ext.cap-gemini.gaetan.cesaro@sncf.fr', '', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-03-25') ; 
INSERT INTO `utilisateurs` VALUES (167, 9, 10, 2, 5, NULL, NULL, NULL, 3, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PCLN05661', 1, NULL, '1966-05-01', 'LINDEN', 'Catherine', '', '2014-01-05', 'ext.exl-group.catherine.linden@sncf.fr', '', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-03-25') ; 
INSERT INTO `utilisateurs` VALUES (168, 33, 11, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PYAK08841', 0, NULL, '1984-08-01', 'ABOURIZK', 'Younes', NULL, '2013-01-05', '', '', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01') ; 
INSERT INTO `utilisateurs` VALUES (169, 7, 7, 1, 4, NULL, NULL, NULL, 4, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PLHT10711', 1, NULL, '1971-10-01', 'HOUGUET', 'Ludovic', '', '2014-01-05', 'ext.capgemini.ludovic.houguet@sncf.fr', '02 28 20 13 46', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-03-25') ; 
INSERT INTO `utilisateurs` VALUES (170, 7, 6, 1, 4, NULL, NULL, NULL, 5, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PAVE08881', 1, NULL, '1988-08-01', 'VIENNE', 'Alexis', '', '2014-01-05', 'ext.sogeti.alexis.vienne@sncf.fr', '', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-03-25') ; 
INSERT INTO `utilisateurs` VALUES (171, 6, 2, 1, 2, 3, NULL, 13, 1, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PSGT05731', 1, NULL, '1973-05-01', 'GUIOT', 'Stéphane', '', '2014-01-05', 'ext.sqli.stephane.guiot@sncf.fr', '', 100, 0, 0, 0, 0, 1, 0, '2013-02-01', '2013-03-25') ; 
INSERT INTO `utilisateurs` VALUES (172, 6, 3, 1, 1, 4, NULL, 10, 1, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PMJT08861', 1, NULL, '1986-08-01', 'JEANNOT', 'Mickael', '', '2014-01-05', 'ext.steria.mickael.jeannot@sncf.fr', '50 41 59', 100, 0, 0, 0, 0, 1, 0, '2013-02-01', '2013-03-25') ; 
INSERT INTO `utilisateurs` VALUES (173, 33, 11, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PHSF01891', 0, NULL, '1989-01-01', 'SKAF', 'Hugues', NULL, '2013-01-05', '', '', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01') ; 
INSERT INTO `utilisateurs` VALUES (174, 7, 7, 1, 4, NULL, NULL, NULL, 3, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PAAD09891', 1, NULL, '1989-09-01', 'AYED', 'Ahmed Charafeddine', '', '2014-01-05', 'ext.capgemini.ahmed-charafeddine.ayed@sncf.fr', '59 69 16', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-03-25') ; 
INSERT INTO `utilisateurs` VALUES (175, 33, 11, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PEDB02891', 0, NULL, '1989-02-01', 'DIB', 'Elias', NULL, '2013-01-05', 'ext.capgemini.elias.dib@sncf.fr', '', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01') ; 
INSERT INTO `utilisateurs` VALUES (176, 6, 2, 1, 2, 3, NULL, 13, 1, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PJRN01771', 1, NULL, '1977-01-01', 'RAHON', 'Jacques-Etienne', '', '2014-01-05', 'ext.sqli.jacques-etienne.rahon@sncf.fr', '50 48 63', 100, 0, 0, 0, 0, 1, 0, '2013-02-01', '2013-03-25') ; 
INSERT INTO `utilisateurs` VALUES (177, 7, 7, 2, 4, NULL, NULL, NULL, 3, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PMDU03861', 1, NULL, '1986-03-01', 'DUVEAU', 'Mélanie', '', '2014-01-05', 'ext.capgemini.melanie.duveau@sncf.fr', '59 67 74', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-03-25') ; 
INSERT INTO `utilisateurs` VALUES (178, 33, 10, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PAFA05741', 0, NULL, '1974-05-01', 'FERREIRA', 'Augusto', NULL, '2013-03-19', 'ext.sogeti.augusto.ferreira@sncf.fr', '', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01') ; 
INSERT INTO `utilisateurs` VALUES (179, 33, 10, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PYRT02741', 0, NULL, '1974-02-01', 'RIBOUST', 'Yann', NULL, '2012-11-13', 'ext.sogeti.yann.riboust@sncf.fr', '', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01') ; 
INSERT INTO `utilisateurs` VALUES (180, 9, 12, 2, 5, NULL, NULL, NULL, 3, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PJBD08861', 1, NULL, '1986-01-01', 'BERNARD', 'Jérémie', '', '2014-01-05', 'ext.logica.jeremie.bernard@sncf.fr', '', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-03-25') ; 
INSERT INTO `utilisateurs` VALUES (181, 9, 12, 2, 5, NULL, NULL, NULL, 3, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PLBD06791', 1, NULL, '1991-01-01', 'BLANCHARD', 'Léopoldine', '', '2014-01-05', 'ext.logica.leopoldine.blanchard@sncf.fr', '', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-03-25') ; 
INSERT INTO `utilisateurs` VALUES (182, 9, 12, 2, 5, NULL, NULL, NULL, 3, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PCDS09881', 1, NULL, '1988-09-01', 'DESBOIS', 'Colleen', '', '2014-01-05', 'ext.logica.colleen.desbois@sncf.fr', '', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-03-25') ; 
INSERT INTO `utilisateurs` VALUES (183, 9, 12, 2, 5, NULL, NULL, NULL, 3, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PHEI01851', 1, NULL, '1985-01-01', 'ELGADI', 'Habiba', '', '2014-01-05', 'ext.logica.habiba.el_gadi@sncf.fr', '', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-03-25') ; 
INSERT INTO `utilisateurs` VALUES (184, 9, 12, 2, 5, NULL, NULL, NULL, 3, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PBTY01871', 1, NULL, '1987-01-01', 'TARDY', 'Bruno', '', '2014-01-05', 'ext.logica.bruno.tardy@sncf.fr', '', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-03-25') ; 
INSERT INTO `utilisateurs` VALUES (185, 33, 7, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PSET03721', 0, NULL, '0000-00-00', 'ESCOFET', 'Sylvain', NULL, '0000-00-00', '', '', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01') ; 
INSERT INTO `utilisateurs` VALUES (186, 33, 11, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PBKD12791', 0, NULL, '0000-00-00', 'KRID', 'Bilel', NULL, '2012-08-23', '', '', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01') ; 
INSERT INTO `utilisateurs` VALUES (187, 7, 7, 2, 4, NULL, NULL, NULL, 3, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PGOK04841', 1, NULL, '1989-03-08', 'OZTURK', 'Gokhan', '', '2014-01-05', 'ext.capgemini.gokhan.ozturk@sncf.fr', '59 67 92', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-03-25') ; 
INSERT INTO `utilisateurs` VALUES (188, 33, 11, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PAET07861', 0, NULL, '1988-03-01', 'ESNAULT', 'Antoine', NULL, '2013-03-19', 'ext.capgemini.antoine.esnault@sncf.', '02 99 27 93 73', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01') ; 
INSERT INTO `utilisateurs` VALUES (189, 7, 7, 1, 4, NULL, NULL, NULL, 4, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PAMT07711', 1, NULL, '1971-07-01', 'MAUGET', 'Anthony', '', '2014-01-05', 'ext.capgemini.anthony.mauget@sncf.f', '02 28 20 12 85', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-03-25') ; 
INSERT INTO `utilisateurs` VALUES (190, 33, 11, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PFSE07861', 0, NULL, '1986-07-01', 'SAMAKE', 'Fousseyni', NULL, '2013-03-19', 'ext.capgemini.fousseyni.samake@sncf', '02 28 20 13 45', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01') ; 
INSERT INTO `utilisateurs` VALUES (191, 7, 7, 1, 4, NULL, NULL, NULL, 4, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PACE08811', 1, NULL, '1981-09-01', 'COURONNE', 'Ana', '', '2014-01-05', 'ext.capgemini.anael.couronne@sncf.f', '', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-03-25') ; 
INSERT INTO `utilisateurs` VALUES (192, 7, 7, 1, 4, NULL, NULL, NULL, 4, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PJMD03891', 1, NULL, '1989-03-01', 'MENARD', 'Jérôme', '', '2014-01-05', 'ext.capgemini.jerome.menard@sncf.fr', '', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-03-25') ; 
INSERT INTO `utilisateurs` VALUES (193, 33, 11, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PFQY12841', 0, NULL, '1984-12-27', 'QUESNAY', 'François', NULL, '2012-11-13', 'ext.capgemini.francois.quesnay@sncf', '', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01') ; 
INSERT INTO `utilisateurs` VALUES (194, 33, 5, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', '7911306W', 0, NULL, '1979-07-15', 'SIDI-OTSMANE', 'Morsli', NULL, '2012-09-24', 'ext.stagiaire.morsli.sidi-otsmane@sncf.fr', '', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01') ; 
INSERT INTO `utilisateurs` VALUES (195, 6, 14, 1, 7, NULL, NULL, NULL, 1, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PSLE04821', 1, NULL, '1982-04-01', 'LEPEE', 'Sang-Gilles', '', '2014-01-05', 'ext.gfi.sang-gilles.lepee@sncf.fr', '', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-03-25') ; 
INSERT INTO `utilisateurs` VALUES (196, 33, 11, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PJLP10601', 0, NULL, '1960-10-01', 'PUIG', 'Jean-Luc', NULL, '2013-01-05', '', '', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01') ; 
INSERT INTO `utilisateurs` VALUES (197, 7, 7, 1, 4, NULL, NULL, NULL, 3, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PRSZ12811', 1, NULL, '1981-12-01', 'SCHWARTZ', 'Romain', '', '2014-01-05', 'ext.capgemini.romain.schwartz@sncf.', '', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-03-25') ; 
INSERT INTO `utilisateurs` VALUES (198, 33, 11, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PMBD06861', 0, NULL, '1986-06-01', 'BOUHDOUD', 'Mohammed', NULL, '2013-01-05', '', '', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01') ; 
INSERT INTO `utilisateurs` VALUES (199, 33, 11, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PJLR04601', 0, NULL, '1960-04-10', 'LASNIER', 'Jean-Paul', NULL, '2013-01-05', 'ext.capgemini.jean-paul.lasnier@snc', '', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01') ; 
INSERT INTO `utilisateurs` VALUES (200, 7, 7, 1, 4, NULL, NULL, NULL, 3, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PJAA06791', 1, NULL, '1979-06-01', 'ANDRIAMANANTENA', 'Jean-Fleury', '', '2014-01-05', 'ext.capgemini.jean-fleury.andriamamantena@sncf.fr', '', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-03-25') ; 
INSERT INTO `utilisateurs` VALUES (201, 7, 7, 1, 4, NULL, NULL, NULL, 3, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PAGE02661', 1, NULL, '1966-02-16', 'GHEBACHE', 'Anne', '', '2014-01-05', 'ext.capgemini.anne.ghebache@sncf.fr', '', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-03-25') ; 
INSERT INTO `utilisateurs` VALUES (202, 7, 7, 1, 4, NULL, NULL, NULL, 3, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PGMA10831', 1, NULL, '1983-10-01', 'MANDINA-NZEZA', 'Guy-Serge', 'Activation du compte le 22/04/2013<br />initialisation du mot de passe session windows le 22/04/2013', '2014-01-05', 'ext.capgemini.mandina-nzeza.guy-serge@sncf.fr', '', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-05-16') ; 
INSERT INTO `utilisateurs` VALUES (203, 2, 14, 1, 7, NULL, NULL, NULL, 1, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PSBI06841', 0, NULL, '1984-01-01', 'BERTINETTI', 'Stefano', '', '2014-01-05', 'ext.gfi.stefano.bertinetti@sncf.fr', '', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-03-25') ; 
INSERT INTO `utilisateurs` VALUES (204, 6, 15, 1, 7, NULL, NULL, NULL, 1, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PODE04701', 0, NULL, '1970-04-01', 'DEBRE', 'Olivier', '', '2014-01-05', 'ext.osiatis.olivier.debre@sncf.fr', '', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-03-25') ; 
INSERT INTO `utilisateurs` VALUES (205, 6, 14, 1, 7, NULL, NULL, NULL, 1, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PCDT06831', 1, NULL, '1983-06-01', 'DIDELOT', 'Christian', '', '2014-01-05', 'ext.gfi.christian.didelot@sncf.fr', '', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-03-25') ; 
INSERT INTO `utilisateurs` VALUES (206, 2, 14, 1, 7, NULL, NULL, NULL, 1, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PPFE01811', 0, NULL, '1981-01-01', 'FEVRE', 'Pierre', '', '2014-01-05', 'ext.gfi.pierre.fevre@sncf.fr', '', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-03-25') ; 
INSERT INTO `utilisateurs` VALUES (207, 2, 14, 1, 7, NULL, NULL, NULL, 1, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PFMD05681', 1, NULL, '1968-05-01', 'MOUTHAUD', 'Francis', '', '2014-01-05', 'ext.gfi.francis.mouthaud@sncf.fr', '', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-03-25') ; 
INSERT INTO `utilisateurs` VALUES (208, 6, 13, 1, 1, 4, NULL, 23, 3, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PLBT10831', 1, NULL, '1983-10-14', 'BLANCHET', 'Lydie', '', '2014-01-05', 'ext.fastconnectconsulting.lydie.blanchet@sncf.fr', '', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-03-25') ; 
INSERT INTO `utilisateurs` VALUES (209, 6, 13, 1, 1, 4, NULL, NULL, 3, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PRSI03841', 1, NULL, '1984-03-06', 'SNOUSSI', 'Rachid', '', '2014-01-05', 'ext.fastconnect.rachid.snoussi@sncf.fr', '', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-03-25') ; 
INSERT INTO `utilisateurs` VALUES (210, 6, 13, 1, 1, 4, NULL, NULL, 3, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PMRA03761', 1, NULL, '1976-03-06', 'RICCA', 'Muriel', '', '2014-01-05', 'ext.fastconnect.muriel.ricca@sncf.f', '', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-03-25') ; 
INSERT INTO `utilisateurs` VALUES (211, 33, 10, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PDPR03901', 0, NULL, '1990-03-01', 'POTHIER', 'Damien', NULL, '2013-03-19', 'ext.sogeti.damien.pothier@sncf.fr', '', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01') ; 
INSERT INTO `utilisateurs` VALUES (212, 7, 7, 1, 4, NULL, NULL, NULL, 3, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PDAS09641', 1, NULL, '1964-09-08', 'ATTIAS', 'Daniel', '', '2014-01-05', 'ext.capgemini.daniel.attias@sncf.fr', '', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-03-25') ; 
INSERT INTO `utilisateurs` VALUES (213, 9, 1, 2, 5, NULL, NULL, NULL, 3, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', '7701605K', 1, NULL, '1977-01-01', 'GIDON', 'Fabrice', '', NULL, 'fabrice.gidon@sncf.fr', '', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-03-25') ; 
INSERT INTO `utilisateurs` VALUES (214, 33, 11, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PNRI06641', 0, NULL, '1964-06-01', 'ROSSATTI', 'Nathalie', NULL, '2013-01-05', 'ext.capgemini.nathalie.rossatti@snc', '', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01') ; 
INSERT INTO `utilisateurs` VALUES (215, 33, 11, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PMBE06821', 0, NULL, '1982-06-06', 'BEYE', 'Mansour', NULL, '2013-03-19', 'ext.sogeti.mansour.beye@sncf.fr', '', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01') ; 
INSERT INTO `utilisateurs` VALUES (216, 33, 11, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PNKI07791', 0, NULL, '1979-07-01', 'KRZYZANOWSKI', 'Nicolas', NULL, '2013-03-19', 'ext.capgemini.nicolas.krzyzanowski', '', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01') ; 
INSERT INTO `utilisateurs` VALUES (217, 33, 11, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PMFT03861', 0, NULL, '1986-03-08', 'FOUQUER', 'Morgan', NULL, '2013-03-19', 'ext.capgemini.morgan.fouquet@sncf.fr', '', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01') ; 
INSERT INTO `utilisateurs` VALUES (218, 7, 7, 1, 4, NULL, NULL, NULL, 4, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'POTM11861', 1, NULL, '1986-11-01', 'TARAM', 'Ousmane', '', '2014-01-05', 'ext.capgemini.ousmane.taram', '', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-03-25') ; 
INSERT INTO `utilisateurs` VALUES (219, 33, 11, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PFFI04831', 0, NULL, '1983-04-13', 'FEKI', 'Firas', NULL, '2013-03-19', 'ext.capgemini.firas.feki', '', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01') ; 
INSERT INTO `utilisateurs` VALUES (220, 33, 11, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PJCR09811', 0, NULL, '1981-09-17', 'RENE', 'Jean-Charles', NULL, '2013-03-19', 'ext.capgemini.jean-charles.rene@snc', '', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01') ; 
INSERT INTO `utilisateurs` VALUES (221, 8, 7, 1, 4, NULL, NULL, NULL, 3, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PNSB07871', 1, NULL, '1987-07-20', 'SAMB', 'Ndeye-Rokhaya', '', '2014-01-05', 'ext.capgemini.ndeye-rokhaya.samb', '', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-03-25') ; 
INSERT INTO `utilisateurs` VALUES (222, 33, 11, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PATH10771', 0, NULL, '1977-10-13', 'TOUH', 'Azedine', NULL, '2013-03-19', 'ext.capgemini.azedine.touh@sncf.fr', '', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01') ; 
INSERT INTO `utilisateurs` VALUES (223, 5, 10, 1, 7, NULL, NULL, NULL, 1, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PCGA03711', 0, NULL, '1971-03-07', 'GRIVA', 'Christophe', '', '2014-01-05', 'ext.esr.christophe.griva@sncf.fr', '', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-03-25') ; 
INSERT INTO `utilisateurs` VALUES (224, 33, 11, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PBDA06851', 0, NULL, '1985-06-14', 'DESOUZA', 'Ben-Tony', NULL, '2013-03-19', 'ext.capgemini.ben-tony.desouza@sncf', '', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01') ; 
INSERT INTO `utilisateurs` VALUES (225, 7, 7, 1, 4, NULL, NULL, NULL, 4, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PCCT10561', 1, NULL, '1956-10-17', 'CORMORANT', 'Clara', '', '2014-01-05', 'ext.capgemini.clara.cormorant@sncf.fr', '', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-03-25') ; 
INSERT INTO `utilisateurs` VALUES (226, 33, 11, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PAMI01871', 0, NULL, '1987-01-19', 'MAJLOUBI', 'Amine', NULL, '2013-03-19', 'ext.capgemini.amine.majloubi@sncf.f', '', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01') ; 
INSERT INTO `utilisateurs` VALUES (227, 33, 11, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PABN09801', 0, NULL, '1980-09-22', 'BABIN', 'Audrey', NULL, '2013-03-19', 'ext.capgemini.audrey.babin@sncf.fr', '', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01') ; 
INSERT INTO `utilisateurs` VALUES (228, 3, 1, 1, 7, NULL, NULL, NULL, 1, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', '6111729J', 1, NULL, '1961-01-01', 'FAVIER', 'Thierry', '', NULL, 'thierry.favier@sncf.fr', '50 50 28', 100, 0, 0, 0, 0, 0, 1, '2013-02-01', '2013-03-25') ; 
INSERT INTO `utilisateurs` VALUES (229, 4, 1, 1, 7, NULL, NULL, NULL, 1, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', '7112048M', 1, NULL, '1971-01-01', 'SEIVE', 'Laurent', '', NULL, 'laurent.seive@sncf.fr', '50 56 27', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-03-25') ; 
INSERT INTO `utilisateurs` VALUES (230, 4, 1, 1, 2, 3, NULL, 13, 1, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', '7011089Z', 1, NULL, '1970-01-01', 'BLANCHET', 'Frédéric', '', NULL, 'frederic.blanchet@sncf.fr', '50 46 94', 100, 0, 0, 0, 0, 1, 1, '2013-02-01', '2013-05-17') ; 
INSERT INTO `utilisateurs` VALUES (231, 4, 1, 1, 2, 3, NULL, 11, 1, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', '7112047L', 1, NULL, '1971-01-01', 'RABATEL', 'Franck', '', NULL, 'franck.rabatel@sncf.fr', '50 45 35', 100, 0, 0, 0, 0, 1, 1, '2013-02-01', '2013-03-25') ; 
INSERT INTO `utilisateurs` VALUES (232, 6, 1, 1, 7, NULL, NULL, NULL, 1, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', '5916320H', 1, NULL, '1959-01-01', 'CRACCO', 'Jean-François', '', NULL, 'jean-francois.cracco@sncf.fr', '50 47 24', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-03-25') ; 
INSERT INTO `utilisateurs` VALUES (233, 2, 14, 1, 7, NULL, NULL, NULL, 1, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PDMO11751', 1, NULL, '1975-11-01', 'MUSSO', 'Dorian', '', '2014-01-05', 'ext.gfi.dorian.musso@sncf.fr', '', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-03-25') ; 
INSERT INTO `utilisateurs` VALUES (234, 2, 18, 1, 7, NULL, NULL, NULL, 1, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PEBY02711', 1, NULL, '1971-01-01', 'BALY', 'Emmanuel', '', '2014-01-05', 'ext.axialog.emmanuel.baly@sncf.fr', '50 56 22', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-03-25') ; 
INSERT INTO `utilisateurs` VALUES (235, 7, 6, 1, 4, NULL, NULL, NULL, 5, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PPBN01561', 1, NULL, '1956-01-15', 'BLANDIN', 'Patrick', '', '2014-01-05', 'ext.sogeti.patrick.blandin2@sncf.fr', '', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-03-25') ; 
INSERT INTO `utilisateurs` VALUES (236, 6, 13, 1, 1, 4, NULL, NULL, 3, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PTDR10871', 0, NULL, '1987-10-07', 'DE KERVILER', 'Tugdual', '', '2014-01-05', 'ext.fast-connect-consulting.tugdual.de-kerviler@sncf.fr', '', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-03-25') ; 
INSERT INTO `utilisateurs` VALUES (237, 6, 3, 1, 2, 3, NULL, 13, 1, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PBLR10761', 1, NULL, '1976-10-14', 'LUTTRINGER', 'Benoit', '', '2014-01-05', 'ext.steria.benoit.luttringer@sncf.fr', '', 100, 0, 0, 0, 0, 1, 0, '2013-02-01', '2013-03-25') ; 
INSERT INTO `utilisateurs` VALUES (238, 7, 8, 1, 4, NULL, NULL, NULL, 3, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PPDS01621', 1, NULL, '1962-01-17', 'DAGAIS', 'Pascale', '', '2014-01-05', ' ext.ibm.pascale.dagais@sncf.fr', '', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-03-25') ; 
INSERT INTO `utilisateurs` VALUES (239, 6, 13, 1, 1, 4, NULL, NULL, 3, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PLGN03861', 1, NULL, '1986-03-26', 'GOLBERIN', 'Lisa', '', '2014-01-05', 'ext.fastconnect.lisa.golberin@sncf.fr', '', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-03-25') ; 
INSERT INTO `utilisateurs` VALUES (240, 7, 7, 1, 4, NULL, NULL, NULL, 3, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PACO08791', 1, NULL, '1979-08-04', 'CONDOLEO', 'Alessandra', '', '2014-01-05', 'ext.capgemini.alessandra.condoleo@sncf.fr', '', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-03-25') ; 
INSERT INTO `utilisateurs` VALUES (241, 7, 7, 1, 4, NULL, NULL, NULL, 4, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PMDF12841', 1, NULL, '1984-12-19', 'DIOUF', 'Mamour', '', '2014-01-05', 'ext.capgemini.mamour.diouf@sncf.fr', '', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-03-25') ; 
INSERT INTO `utilisateurs` VALUES (242, 7, 7, 1, 4, NULL, NULL, NULL, 3, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PVMO05761', 1, NULL, '1976-05-01', 'MORO', 'Valérie', '', '2014-01-05', 'ext.capgemini.valerie.moro@sncf.fr', '', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-03-25') ; 
INSERT INTO `utilisateurs` VALUES (243, 7, 7, 1, 4, NULL, NULL, NULL, 3, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PAST05851', 1, NULL, '1985-05-31', 'SMAT', 'Ali', '', '2014-01-05', 'ext.capgemini.ali.smat@sncf.fr', '', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-03-25') ; 
INSERT INTO `utilisateurs` VALUES (244, 7, 7, 1, 4, NULL, NULL, NULL, 4, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PBFT07761', 1, NULL, '1976-07-09', 'FLORAT', 'Bertrand', '', '2014-01-05', 'ext.capgemini.bertrand.florat@sncf.fr', '', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-03-25') ; 
INSERT INTO `utilisateurs` VALUES (245, 7, 7, 1, 4, NULL, NULL, NULL, 4, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PRTC05761', 1, NULL, '1976-05-14', 'TROADEC', 'Ronan', '', '2014-01-05', 'ext.capgemini.ronan.troadec@sncf.fr', '', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-03-25') ; 
INSERT INTO `utilisateurs` VALUES (246, 7, 7, 1, 4, NULL, NULL, NULL, 3, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PMSR01891', 1, NULL, '1989-01-12', 'SAGHIR', 'Mohamed', '', '2014-01-05', 'ext.capgemini.mohamed.saghir@sncf.fr', '', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-03-25') ; 
INSERT INTO `utilisateurs` VALUES (247, 7, 7, 1, 4, NULL, NULL, NULL, 5, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PMGI01851', 1, NULL, '1985-01-01', 'GHILARDINI', 'Mickaël', '', '2014-01-05', 'ext.capgemini.mickael.ghilardini@sncf.fr', '', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-03-25') ; 
INSERT INTO `utilisateurs` VALUES (248, 7, 7, 1, 4, NULL, NULL, NULL, 3, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PNSH06851', 1, NULL, '1985-06-04', 'SAIGNASITH', 'Nidda', '', '2014-01-05', 'ext.capgemini.nidda.saignasith@sncf.fr', '', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-03-25') ; 
INSERT INTO `utilisateurs` VALUES (249, 7, 7, 1, 4, NULL, NULL, NULL, 3, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PSAI04891', 1, NULL, '1989-04-13', 'ALOUI', 'Slim', '', '2014-01-05', 'ext.capgemini.slim.aloui@sncf.fr', '', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-03-25') ; 
INSERT INTO `utilisateurs` VALUES (250, 7, 7, 1, 4, NULL, NULL, NULL, 3, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PGGS10881', 1, NULL, '1988-10-07', 'GONZALES', 'Guillaume', '', '2014-01-05', 'ext.capgemini.guillaume.gonzales@sncf.fr', '', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-03-25') ; 
INSERT INTO `utilisateurs` VALUES (251, 33, 11, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PBDL09601', 0, NULL, '1960-09-23', 'DUBREUIL', 'Bertrand', NULL, '2013-02-27', 'ext.capgemini.bertrand.dubreuil@sncf.fr', '', 0, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-02-01') ; 
INSERT INTO `utilisateurs` VALUES (252, 6, 13, 1, 1, 4, NULL, NULL, 3, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PFCE01871', 1, NULL, '1987-01-25', 'CAPPE', 'Fabrice', '', '2014-01-05', 'ext.fastconnect.fabrice.cappe@sncf.fr', '', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-03-25') ; 
INSERT INTO `utilisateurs` VALUES (253, 7, 7, 1, 4, NULL, NULL, NULL, 3, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PMER11891', 1, NULL, '1989-11-10', 'EL FILALI EL MOUNTACIR', 'Meryem', '', '2014-01-05', 'ext.capgemini.meryem.el-filali-el-mountacir@sncf.fr', '', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-03-25') ; 
INSERT INTO `utilisateurs` VALUES (254, 7, 7, 2, 4, NULL, NULL, NULL, 3, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PPRR09871', 1, NULL, '1987-09-01', 'RAJKUMAR', 'Pharath', '', '2013-12-31', 'ext.capgemini.pharath.rajkumar@sncf.fr', '', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-03-25') ; 
INSERT INTO `utilisateurs` VALUES (255, 4, 1, 1, 1, 4, NULL, 20, 1, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', '8410150T', 1, NULL, '1984-01-01', 'PAGNARD', 'Sébastien', '', NULL, 'sebastien.pagnard@sncf.fr', '', 100, 0, 0, 0, 0, 1, 1, '2013-02-01', '2013-03-25') ; 
INSERT INTO `utilisateurs` VALUES (256, 7, 7, 1, 4, NULL, NULL, NULL, 3, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PSFR10541', 1, NULL, '1954-10-01', 'FERRER', 'Salvador', '', '2014-01-05', 'ext.capgemini.salvador.ferrer@sncf.fr', '', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-03-25') ; 
INSERT INTO `utilisateurs` VALUES (257, 7, 7, 1, 4, NULL, NULL, NULL, 3, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PJGU12791', 1, NULL, '1979-12-01', 'GLAZIOU', 'Julien', '', '2014-01-05', 'ext.capgemini.julien.glaziou@sncf.fr', '', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-03-25') ; 
INSERT INTO `utilisateurs` VALUES (258, 7, 7, 1, 4, NULL, NULL, NULL, 3, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'pcdy07691', 1, NULL, '1969-07-01', 'DANOY ', 'Clément', '', '2013-12-31', 'ext.capgemini.clement.danoy@sncf.fr', '', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-03-25') ; 
INSERT INTO `utilisateurs` VALUES (259, 7, 7, 1, 4, NULL, NULL, NULL, 4, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PXLU02831', 1, NULL, '1983-02-02', 'LIU', 'Xinlei', '', '2014-01-05', 'ext.capgemini.xinlei.liu@sncf.fr', '', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-03-25') ; 
INSERT INTO `utilisateurs` VALUES (260, 7, 8, 1, 4, NULL, NULL, NULL, 3, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PVBT11761', 1, NULL, '1976-11-08', 'BERTHELOT', 'Vincent', '', '2014-01-05', 'ext.ibm.vincent.berthelot@sncf.fr', '', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-03-25') ; 
INSERT INTO `utilisateurs` VALUES (261, 6, 3, 1, 2, 3, NULL, 16, 1, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PANM11811', 1, NULL, '1981-11-02', 'NGOM ', 'Amsata', '', '2014-01-05', 'ext.steria.amsata.ngom@sncf.fr', '', 100, 0, 0, 0, 0, 1, 0, '2013-02-01', '2013-03-25') ; 
INSERT INTO `utilisateurs` VALUES (262, 7, 7, 1, 4, NULL, NULL, NULL, 3, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PSBE12852', 1, NULL, '1985-12-12', 'BOUGRINE', 'Salim', '25/03/2012 demande ouverture de compte', '2014-01-05', 'ext.capgemini.salim.bougrine@sncf.fr', '', 100, 0, 0, 0, 0, 0, 0, '2013-02-01', '2013-03-28') ; 
INSERT INTO `utilisateurs` VALUES (263, 6, 1, 1, 2, 3, NULL, 14, 1, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', '6316250P', 1, NULL, '1963-01-01', 'RAHIOUI', 'Ahmed', '', NULL, 'Ahmed.RAHIOUI@sncf.fr', '', 100, 0, 0, 0, 0, 0, 1, '2013-03-26', '2013-04-16') ; 
INSERT INTO `utilisateurs` VALUES (264, 3, 1, 1, 1, 4, NULL, 7, 3, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', '6907950S', 1, '2013-05-01', '1969-01-01', 'CHOUTEAU', 'Marie-Hélène', '', NULL, 'marie-helene.CHOUTEAU@sncf.fr', '', 100, 0, 0, 0, 0, 1, 1, '2013-03-26', '2013-03-27') ; 
INSERT INTO `utilisateurs` VALUES (265, 6, 3, 1, 1, 4, NULL, 10, 1, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PSBN05671', 1, NULL, '1967-05-06', 'BEYDON', 'Stéphane', '', '2014-01-05', 'ext.steria.stephane.beydon@sncf.fr', '', 100, 0, 0, 0, 0, 1, 0, '2013-03-26', '2013-03-27') ; 
INSERT INTO `utilisateurs` VALUES (266, 9, 1, 2, 5, NULL, NULL, NULL, 3, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', '7010108H', 1, NULL, '1970-01-01', 'GOUT', 'Céline', '', NULL, 'celine.gout@sncf.fr', '', 100, 0, 0, 0, 0, 0, 0, '2013-03-28', '2013-03-28') ; 
INSERT INTO `utilisateurs` VALUES (267, 7, 7, 1, 4, NULL, NULL, NULL, 4, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PMBT09741', 1, NULL, '1974-09-27', 'BELHOUT', 'Mabrouk', '- Liste de diffusion : *OSMOSE Intégrateur PANAM<br />- Ouverture Partage MOE<br />- Ouverture Partage MOA<br />- Compte pour MINIDOC<br />- Compte pour Caliber RM<br />- Compte pour QC sur le projet : PANAM<br />- Compte pour ARIANE<br /><br />Demande création de compte faite le 28/03/2013', '2014-01-05', 'ext.capgemini.mabrouk.belhout@sncf.fr', '', 100, 0, 0, 0, 0, 0, 0, '2013-03-28', '2013-04-02') ; 
INSERT INTO `utilisateurs` VALUES (268, 6, 2, 1, 2, 3, NULL, 16, 3, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PRBG11791', 1, '2013-04-02', '1979-11-22', 'BORG', 'Renaud', '02/04/2013 : Demande de création d\'un répertoire personnel sur la ressource bureautique', '2014-01-05', 'ext.sqli.renaud.borg@sncf.fr', '', 100, 0, 0, 0, 0, 1, 0, '2013-03-28', '2013-04-03') ; 
INSERT INTO `utilisateurs` VALUES (269, 7, 6, 1, 4, NULL, NULL, NULL, 5, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PALC12901', 1, '2013-04-02', '1990-12-01', 'LUC', 'Antoine', '- Ouverture Partage MOE<br />- Ouverture Partage MOA<br />- Compte pour MINIDOC<br />- Compte pour Caliber RM<br />- Compte pour QC sur le projet : GMAO<br />- Compte pour ARIANE<br />- Liste de diffusion : *OSMOSE Intégrateur Sogeti', '2014-01-05', 'ext.sogeti.antoine.luc@sncf.fr', '', 100, 0, 0, 0, 0, 0, 0, '2013-04-02', '2013-04-03') ; 
INSERT INTO `utilisateurs` VALUES (270, 7, 6, 1, 4, NULL, NULL, NULL, 5, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PARZ03881', 1, '2013-04-02', '1988-03-01', 'RUIZ', 'Alexandre', '- Ouverture Partage MOE<br />- Ouverture Partage MOA<br />- Compte pour MINIDOC<br />- Compte pour Caliber RM<br />- Compte pour QC sur le projet : GMAO<br />- Compte pour ARIANE<br />- Liste de diffusion : *OSMOSE Intégrateur Sogeti', '2014-01-05', 'ext.sogeti.alexandre.ruiz@sncf.fr', '', 100, 0, 0, 0, 0, 0, 0, '2013-04-02', '2013-04-03') ; 
INSERT INTO `utilisateurs` VALUES (271, 7, 6, 1, 4, NULL, NULL, NULL, 5, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PSLE04711', 1, '2013-04-10', '1971-04-01', 'LANAILLE', 'Sébastien', '- Ouverture Partage MOE<br />- Ouverture Partage MOA<br />- Compte pour MINIDOC<br />- Compte pour Caliber RM<br />- Compte pour QC sur le projet<br />- Compte pour ARIANE', '2014-01-05', 'ext.sogeti.sebastien.lanaille@sncf.fr', '', 100, 0, 0, 0, 0, 0, 0, '2013-04-10', '2013-04-10') ; 
INSERT INTO `utilisateurs` VALUES (272, 2, 3, 1, 1, NULL, NULL, NULL, 1, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PCDP000001', 1, NULL, '2013-04-11', 'Chef projet', 'STERIA/SQLi', 'Juste pour la facturation', '2014-01-05', 'chef.projet@sncf.fr', '', 20, 0, 0, 0, 0, 1, 0, '2013-04-11', '2013-04-11') ; 
INSERT INTO `utilisateurs` VALUES (273, 8, 7, 1, 4, NULL, NULL, NULL, 3, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PFPE11901', 1, NULL, '1990-11-26', 'PELE', 'Flore', '- Ouverture Partage MOE<br />- Ouverture Partage MOA<br />- Compte pour MINIDOC<br />- Compte pour Caliber RM<br />- Compte pour QC sur le projet : GMAO<br />- Compte pour ARIANE<br />- Liste de diffusion : *OSMOSE Intégrateur PMO', '2014-01-05', 'ext.capgemini.flore.pele@sncf.fr', '', 100, 0, 0, 0, 0, 0, 0, '2013-04-11', '2013-04-15') ; 
INSERT INTO `utilisateurs` VALUES (274, 7, 7, 1, 4, NULL, NULL, NULL, 3, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PHBN10861', 1, NULL, '1986-10-06', 'BENJELLOUN', 'HOUDA', '- Ouverture Partage MOE<br />- Ouverture Partage MOA<br />- Compte pour MINIDOC<br />- Compte pour Caliber RM<br />- Compte pour QC sur le projet : GMAO<br />- Compte pour ARIANE<br />- Liste de diffusion : *OSMOSE Intégrateur GMAO', '2014-01-05', 'ext.capgemini.houda.benjelloun@sncf.fr', '', 100, 0, 0, 0, 0, 0, 0, '2013-04-15', '2013-04-15') ; 
INSERT INTO `utilisateurs` VALUES (275, 7, 7, 1, 4, NULL, NULL, NULL, 3, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PSLI08901', 1, NULL, '1990-08-03', 'LAAMARTI', 'Samya', '- Ouverture Partage MOE<br />- Ouverture Partage MOA<br />- Compte pour MINIDOC<br />- Compte pour Caliber RM<br />- Compte pour QC sur le projet : GMAO<br />- Compte pour ARIANE<br />- Liste de diffusion : *OSMOSE Intégrateur GMAO', '2014-01-05', 'ext.capgemini.samya.laamarti@sncf.fr', '', 100, 0, 0, 0, 0, 0, 0, '2013-04-15', '2013-04-15') ; 
INSERT INTO `utilisateurs` VALUES (276, 7, 7, 1, 4, NULL, NULL, NULL, 3, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PGAR03771', 1, '2013-04-29', '1977-03-02', 'AGUILAR', 'Gustavo', 'Liste de diffusion : *OSMOSE DSIT- GMAO<br />- Ouverture Partage MOE<br />- Ouverture Partage MOA<br />- Compte pour MINIDOC<br />- Compte pour Caliber RM<br />- Compte pour QC sur le projet : GMAO<br />- Compte pour ARIANE', '2014-01-05', 'ext.capgemini.gustavo.aguilar@sncf.fr', '', 100, 0, 0, 0, 0, 0, 0, '2013-05-13', '2013-05-13') ; 
INSERT INTO `utilisateurs` VALUES (277, 7, 7, 1, 4, NULL, NULL, NULL, 3, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', 'PBLC04821', 1, '2013-05-13', '1982-04-01', 'LEBLANC', 'Bastien', '*OSMOSE Intégrateur GMAO TECH.', '2014-01-05', 'ext.cap-gemini.leblanc@sncf.fr', '', 100, 0, 0, 0, 0, 0, 0, '2013-05-13', '2013-05-13') ; 
INSERT INTO `utilisateurs` VALUES (278, 7, 7, 1, 4, NULL, NULL, NULL, 3, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', '', 1, '2013-05-21', '1959-04-10', 'BANHARES', 'Régis', '<p>- Liste de diffusion : *OSMOSE Intégrateur Chefs de Projets<br />- Ouverture Partage MOE<br />- Ouverture Partage MOA<br />- Compte pour MINIDOC<br />- Compte pour Caliber RM<br />- Compte pour QC sur le projet : GMAO<br />- Compte pour ARIANE<br />- Ouverture Internet</p>', '2014-01-05', '', '', 100, 0, 0, 0, 0, 0, 0, '2013-05-21', '2013-05-21') ; 
INSERT INTO `utilisateurs` VALUES (279, 7, 7, 1, 4, NULL, NULL, NULL, 3, NULL, NULL, '91d5c3f24f85249a5cb5dfe9ad92d915', '', 1, '2013-05-21', '1985-10-15', 'DUBART', 'Florent', '<p>- liste de diffusion : *OSMOSE Intégrateur PMO.<br />- Ouverture Partage MOE<br />- Ouverture Partage MOA<br />- Compte pour MINIDOC<br />- Compte pour Caliber RM<br />- Compte pour QC sur le projet : GMAO<br />- Compte pour ARIANE</p>', '2014-01-05', '', '', 100, 0, 0, 0, 0, 0, 0, '2013-05-21', '2013-05-21') ;
#
# End of data contents of table utilisateurs
# --------------------------------------------------------

# WordPress : buffernow.com MySQL database backup
#
# Generated: Thursday 23. May 2013 19:38 CEST
# Hostname: localhost
# Database: `saill_200`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `achats`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `actions`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `actionslivrables`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `activites`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `activitesreelles`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `affectations`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `assistances`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `autorisations`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `contrats`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `detailplancharges`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `domaines`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `dossierpartages`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `dotations`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `facturations`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `historyactions`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `historybudgets`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `historyutilisateurs`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `linkshareds`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `listediffusions`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `livrables`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `mailtemplates`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `materielinformatiques`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `messages`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `outils`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `params`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `plancharges`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `profils`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `projets`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `replacestrings`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `sections`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `sites`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `societes`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `suivilivrables`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `tjmagents`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `tjmcontrats`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `typemateriels`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `utilisateurs`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `utiliseoutils`
# --------------------------------------------------------


#
# Delete any existing table `utiliseoutils`
#

DROP TABLE IF EXISTS `utiliseoutils`;


#
# Table structure of table `utiliseoutils`
#

CREATE TABLE `utiliseoutils` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `utilisateur_id` int(15) NOT NULL,
  `outil_id` int(15) DEFAULT NULL,
  `listediffusion_id` int(15) DEFAULT NULL,
  `dossierpartage_id` int(10) DEFAULT NULL,
  `STATUT` enum('Demandé','Pris en compte','En validation','Validé','Demande transférée','Demande traitée','Retour utilisateur','A supprimer','Supprimée') DEFAULT NULL,
  `TYPE` enum('Outil','Liste Diffusion','Partage Réseaux','') CHARACTER SET latin1 DEFAULT NULL,
  `created` date NOT NULL,
  `modified` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=134 DEFAULT CHARSET=utf8 ;

#
# Data contents of table utiliseoutils (129 records)
#
 
INSERT INTO `utiliseoutils` VALUES (1, 261, 8, NULL, NULL, 'Retour utilisateur', NULL, '2013-03-26', '2013-03-26') ; 
INSERT INTO `utiliseoutils` VALUES (2, 262, 8, NULL, NULL, 'Retour utilisateur', NULL, '2013-03-26', '2013-03-26') ; 
INSERT INTO `utiliseoutils` VALUES (3, 261, 3, NULL, NULL, 'Retour utilisateur', NULL, '2013-03-26', '2013-03-26') ; 
INSERT INTO `utiliseoutils` VALUES (4, 261, 2, NULL, NULL, 'Retour utilisateur', NULL, '2013-03-26', '2013-03-26') ; 
INSERT INTO `utiliseoutils` VALUES (5, 261, 4, NULL, NULL, 'Demande transférée', NULL, '2013-03-26', '2013-03-26') ; 
INSERT INTO `utiliseoutils` VALUES (6, 261, 5, NULL, NULL, 'Retour utilisateur', NULL, '2013-03-26', '2013-04-16') ; 
INSERT INTO `utiliseoutils` VALUES (8, 261, NULL, 4, NULL, 'Retour utilisateur', NULL, '2013-03-26', '2013-03-26') ; 
INSERT INTO `utiliseoutils` VALUES (9, 261, NULL, 20, NULL, 'Retour utilisateur', NULL, '2013-03-26', '2013-03-26') ; 
INSERT INTO `utiliseoutils` VALUES (10, 261, NULL, NULL, 1, 'Retour utilisateur', NULL, '2013-03-26', '2013-03-26') ; 
INSERT INTO `utiliseoutils` VALUES (11, 261, NULL, NULL, 2, 'Retour utilisateur', NULL, '2013-03-26', '2013-03-26') ; 
INSERT INTO `utiliseoutils` VALUES (12, 261, NULL, NULL, 3, 'Retour utilisateur', NULL, '2013-03-26', '2013-03-26') ; 
INSERT INTO `utiliseoutils` VALUES (13, 261, NULL, NULL, 7, 'Retour utilisateur', NULL, '2013-03-26', '2013-03-26') ; 
INSERT INTO `utiliseoutils` VALUES (14, 262, 1, NULL, NULL, 'Retour utilisateur', NULL, '2013-03-26', '2013-03-28') ; 
INSERT INTO `utiliseoutils` VALUES (15, 261, NULL, NULL, 6, 'Retour utilisateur', NULL, '2013-03-26', '2013-03-26') ; 
INSERT INTO `utiliseoutils` VALUES (16, 262, 2, NULL, NULL, 'Retour utilisateur', NULL, '2013-03-26', '2013-03-26') ; 
INSERT INTO `utiliseoutils` VALUES (17, 262, 4, NULL, NULL, 'Demande transférée', NULL, '2013-03-26', '2013-03-26') ; 
INSERT INTO `utiliseoutils` VALUES (18, 262, 3, NULL, NULL, 'Retour utilisateur', NULL, '2013-03-26', '2013-03-27') ; 
INSERT INTO `utiliseoutils` VALUES (19, 262, 5, NULL, NULL, 'Retour utilisateur', NULL, '2013-03-26', '2013-04-16') ; 
INSERT INTO `utiliseoutils` VALUES (20, 262, NULL, 28, NULL, 'Retour utilisateur', NULL, '2013-03-26', '2013-03-27') ; 
INSERT INTO `utiliseoutils` VALUES (21, 262, NULL, NULL, 1, 'Retour utilisateur', NULL, '2013-03-26', '2013-03-27') ; 
INSERT INTO `utiliseoutils` VALUES (22, 262, NULL, NULL, 6, 'Retour utilisateur', NULL, '2013-03-26', '2013-03-26') ; 
INSERT INTO `utiliseoutils` VALUES (23, 261, 1, NULL, NULL, 'Retour utilisateur', NULL, '2013-03-26', '2013-03-28') ; 
INSERT INTO `utiliseoutils` VALUES (24, 265, 1, NULL, NULL, 'Retour utilisateur', NULL, '2013-03-26', '2013-03-28') ; 
INSERT INTO `utiliseoutils` VALUES (25, 265, 2, NULL, NULL, 'Retour utilisateur', NULL, '2013-03-26', '2013-03-28') ; 
INSERT INTO `utiliseoutils` VALUES (26, 265, 3, NULL, NULL, 'Retour utilisateur', NULL, '2013-03-26', '2013-03-28') ; 
INSERT INTO `utiliseoutils` VALUES (27, 265, 4, NULL, NULL, 'Demande transférée', NULL, '2013-03-26', '2013-03-27') ; 
INSERT INTO `utiliseoutils` VALUES (28, 265, 5, NULL, NULL, 'Retour utilisateur', NULL, '2013-03-26', '2013-04-16') ; 
INSERT INTO `utiliseoutils` VALUES (29, 265, 8, NULL, NULL, 'Retour utilisateur', NULL, '2013-03-26', '2013-03-27') ; 
INSERT INTO `utiliseoutils` VALUES (30, 265, NULL, 1, NULL, 'Retour utilisateur', NULL, '2013-03-26', '2013-03-28') ; 
INSERT INTO `utiliseoutils` VALUES (31, 265, NULL, 4, NULL, 'Retour utilisateur', NULL, '2013-03-26', '2013-03-28') ; 
INSERT INTO `utiliseoutils` VALUES (32, 265, NULL, 14, NULL, 'Retour utilisateur', NULL, '2013-03-26', '2013-03-28') ; 
INSERT INTO `utiliseoutils` VALUES (33, 265, NULL, NULL, 1, 'Retour utilisateur', NULL, '2013-03-26', '2013-03-28') ; 
INSERT INTO `utiliseoutils` VALUES (34, 265, NULL, NULL, 3, 'Retour utilisateur', NULL, '2013-03-26', '2013-03-28') ; 
INSERT INTO `utiliseoutils` VALUES (35, 265, NULL, NULL, 5, 'Retour utilisateur', NULL, '2013-03-26', '2013-03-28') ; 
INSERT INTO `utiliseoutils` VALUES (36, 265, NULL, NULL, 7, 'Retour utilisateur', NULL, '2013-03-26', '2013-03-28') ; 
INSERT INTO `utiliseoutils` VALUES (37, 265, NULL, NULL, 6, 'Retour utilisateur', NULL, '2013-03-26', '2013-03-28') ; 
INSERT INTO `utiliseoutils` VALUES (38, 265, NULL, NULL, 2, 'Retour utilisateur', NULL, '2013-03-27', '2013-03-28') ; 
INSERT INTO `utiliseoutils` VALUES (39, 257, 1, NULL, NULL, 'Retour utilisateur', NULL, '2013-03-28', '2013-03-28') ; 
INSERT INTO `utiliseoutils` VALUES (40, 258, 1, NULL, NULL, 'Retour utilisateur', NULL, '2013-03-28', '2013-03-28') ; 
INSERT INTO `utiliseoutils` VALUES (41, 268, 1, NULL, NULL, 'Retour utilisateur', NULL, '2013-04-02', '2013-04-02') ; 
INSERT INTO `utiliseoutils` VALUES (42, 268, 2, NULL, NULL, 'Retour utilisateur', NULL, '2013-04-02', '2013-04-02') ; 
INSERT INTO `utiliseoutils` VALUES (43, 268, 4, NULL, NULL, 'Demande transférée', NULL, '2013-04-02', '2013-04-02') ; 
INSERT INTO `utiliseoutils` VALUES (44, 268, 5, NULL, NULL, 'Retour utilisateur', NULL, '2013-04-02', '2013-04-16') ; 
INSERT INTO `utiliseoutils` VALUES (45, 268, 8, NULL, NULL, 'Retour utilisateur', NULL, '2013-04-02', '2013-04-03') ; 
INSERT INTO `utiliseoutils` VALUES (46, 268, NULL, 4, NULL, 'Retour utilisateur', NULL, '2013-04-02', '2013-04-02') ; 
INSERT INTO `utiliseoutils` VALUES (47, 268, NULL, 20, NULL, 'Retour utilisateur', NULL, '2013-04-02', '2013-04-02') ; 
INSERT INTO `utiliseoutils` VALUES (48, 268, NULL, NULL, 1, 'Retour utilisateur', NULL, '2013-04-02', '2013-04-04') ; 
INSERT INTO `utiliseoutils` VALUES (49, 268, NULL, NULL, 2, 'Retour utilisateur', NULL, '2013-04-02', '2013-04-04') ; 
INSERT INTO `utiliseoutils` VALUES (50, 268, NULL, NULL, 3, 'Retour utilisateur', NULL, '2013-04-02', '2013-04-04') ; 
INSERT INTO `utiliseoutils` VALUES (51, 268, NULL, NULL, 6, 'Retour utilisateur', NULL, '2013-04-02', '2013-04-02') ; 
INSERT INTO `utiliseoutils` VALUES (52, 268, NULL, NULL, 7, 'Retour utilisateur', NULL, '2013-04-02', '2013-04-04') ; 
INSERT INTO `utiliseoutils` VALUES (53, 267, 1, NULL, NULL, 'Retour utilisateur', NULL, '2013-04-02', '2013-04-02') ; 
INSERT INTO `utiliseoutils` VALUES (54, 267, 2, NULL, NULL, 'Retour utilisateur', NULL, '2013-04-02', '2013-04-02') ; 
INSERT INTO `utiliseoutils` VALUES (55, 267, 3, NULL, NULL, 'Retour utilisateur', NULL, '2013-04-02', '2013-04-02') ; 
INSERT INTO `utiliseoutils` VALUES (56, 267, 4, NULL, NULL, 'Demande transférée', NULL, '2013-04-02', '2013-04-02') ; 
INSERT INTO `utiliseoutils` VALUES (57, 267, 5, NULL, NULL, 'Retour utilisateur', NULL, '2013-04-02', '2013-04-16') ; 
INSERT INTO `utiliseoutils` VALUES (58, 267, 8, NULL, NULL, 'Retour utilisateur', NULL, '2013-04-02', '2013-04-03') ; 
INSERT INTO `utiliseoutils` VALUES (59, 267, NULL, NULL, 1, 'Retour utilisateur', NULL, '2013-04-02', '2013-04-08') ; 
INSERT INTO `utiliseoutils` VALUES (60, 267, NULL, NULL, 6, 'Retour utilisateur', NULL, '2013-04-02', '2013-04-02') ; 
INSERT INTO `utiliseoutils` VALUES (61, 267, NULL, 29, NULL, 'Retour utilisateur', NULL, '2013-04-02', '2013-04-02') ; 
INSERT INTO `utiliseoutils` VALUES (62, 268, 3, NULL, NULL, 'Retour utilisateur', NULL, '2013-04-02', '2013-04-02') ; 
INSERT INTO `utiliseoutils` VALUES (63, 269, 1, NULL, NULL, 'Retour utilisateur', NULL, '2013-04-02', '2013-04-08') ; 
INSERT INTO `utiliseoutils` VALUES (64, 269, 3, NULL, NULL, 'Retour utilisateur', NULL, '2013-04-02', '2013-04-03') ; 
INSERT INTO `utiliseoutils` VALUES (65, 269, 5, NULL, NULL, 'Retour utilisateur', NULL, '2013-04-02', '2013-04-16') ; 
INSERT INTO `utiliseoutils` VALUES (67, 269, 8, NULL, NULL, 'Retour utilisateur', NULL, '2013-04-02', '2013-04-03') ; 
INSERT INTO `utiliseoutils` VALUES (68, 269, NULL, 31, NULL, 'Retour utilisateur', NULL, '2013-04-02', '2013-04-03') ; 
INSERT INTO `utiliseoutils` VALUES (69, 269, NULL, NULL, 1, 'Retour utilisateur', NULL, '2013-04-02', '2013-04-04') ; 
INSERT INTO `utiliseoutils` VALUES (70, 269, NULL, NULL, 6, 'Retour utilisateur', NULL, '2013-04-02', '2013-04-03') ; 
INSERT INTO `utiliseoutils` VALUES (71, 270, 1, NULL, NULL, 'Retour utilisateur', NULL, '2013-04-02', '2013-04-08') ; 
INSERT INTO `utiliseoutils` VALUES (72, 270, 3, NULL, NULL, 'Retour utilisateur', NULL, '2013-04-02', '2013-04-03') ; 
INSERT INTO `utiliseoutils` VALUES (74, 270, 8, NULL, NULL, 'Retour utilisateur', NULL, '2013-04-02', '2013-04-03') ; 
INSERT INTO `utiliseoutils` VALUES (75, 270, NULL, 31, NULL, 'Retour utilisateur', NULL, '2013-04-02', '2013-04-03') ; 
INSERT INTO `utiliseoutils` VALUES (76, 270, 5, NULL, NULL, 'Retour utilisateur', NULL, '2013-04-02', '2013-04-16') ; 
INSERT INTO `utiliseoutils` VALUES (77, 270, NULL, NULL, 1, 'Retour utilisateur', NULL, '2013-04-02', '2013-04-04') ; 
INSERT INTO `utiliseoutils` VALUES (78, 270, NULL, NULL, 6, 'Retour utilisateur', NULL, '2013-04-02', '2013-04-03') ; 
INSERT INTO `utiliseoutils` VALUES (79, 271, 1, NULL, NULL, 'Retour utilisateur', NULL, '2013-04-10', '2013-04-10') ; 
INSERT INTO `utiliseoutils` VALUES (80, 271, 3, NULL, NULL, 'Retour utilisateur', NULL, '2013-04-10', '2013-04-15') ; 
INSERT INTO `utiliseoutils` VALUES (81, 271, 5, NULL, NULL, 'Retour utilisateur', NULL, '2013-04-10', '2013-04-16') ; 
INSERT INTO `utiliseoutils` VALUES (82, 271, NULL, NULL, 1, 'Retour utilisateur', NULL, '2013-04-10', '2013-04-16') ; 
INSERT INTO `utiliseoutils` VALUES (83, 271, NULL, NULL, 6, 'Retour utilisateur', NULL, '2013-04-10', '2013-04-10') ; 
INSERT INTO `utiliseoutils` VALUES (84, 271, NULL, 31, NULL, 'Retour utilisateur', NULL, '2013-04-10', '2013-04-17') ; 
INSERT INTO `utiliseoutils` VALUES (85, 271, 2, NULL, NULL, 'Retour utilisateur', NULL, '2013-04-10', '2013-04-22') ; 
INSERT INTO `utiliseoutils` VALUES (86, 273, 1, NULL, NULL, 'Retour utilisateur', NULL, '2013-04-11', '2013-04-15') ; 
INSERT INTO `utiliseoutils` VALUES (87, 273, 3, NULL, NULL, 'Retour utilisateur', NULL, '2013-04-11', '2013-04-15') ; 
INSERT INTO `utiliseoutils` VALUES (88, 273, NULL, NULL, 1, 'Retour utilisateur', NULL, '2013-04-11', '2013-04-22') ; 
INSERT INTO `utiliseoutils` VALUES (89, 273, NULL, NULL, 6, 'Retour utilisateur', NULL, '2013-04-11', '2013-04-15') ; 
INSERT INTO `utiliseoutils` VALUES (90, 273, 5, NULL, NULL, 'Retour utilisateur', NULL, '2013-04-11', '2013-04-16') ; 
INSERT INTO `utiliseoutils` VALUES (91, 273, NULL, 30, NULL, 'Retour utilisateur', NULL, '2013-04-11', '2013-04-15') ; 
INSERT INTO `utiliseoutils` VALUES (92, 274, NULL, NULL, 1, 'Retour utilisateur', NULL, '2013-04-15', '2013-04-23') ; 
INSERT INTO `utiliseoutils` VALUES (93, 274, NULL, NULL, 6, 'Retour utilisateur', NULL, '2013-04-15', '2013-04-15') ; 
INSERT INTO `utiliseoutils` VALUES (94, 274, 1, NULL, NULL, 'Retour utilisateur', NULL, '2013-04-15', '2013-04-15') ; 
INSERT INTO `utiliseoutils` VALUES (95, 274, 3, NULL, NULL, 'Retour utilisateur', NULL, '2013-04-15', '2013-04-17') ; 
INSERT INTO `utiliseoutils` VALUES (96, 274, 5, NULL, NULL, 'Retour utilisateur', NULL, '2013-04-15', '2013-04-16') ; 
INSERT INTO `utiliseoutils` VALUES (97, 274, NULL, 26, NULL, 'Retour utilisateur', NULL, '2013-04-15', '2013-04-16') ; 
INSERT INTO `utiliseoutils` VALUES (98, 275, 1, NULL, NULL, 'Retour utilisateur', NULL, '2013-04-15', '2013-04-15') ; 
INSERT INTO `utiliseoutils` VALUES (99, 275, 3, NULL, NULL, 'Retour utilisateur', NULL, '2013-04-15', '2013-04-17') ; 
INSERT INTO `utiliseoutils` VALUES (100, 275, 5, NULL, NULL, 'Retour utilisateur', NULL, '2013-04-15', '2013-04-16') ; 
INSERT INTO `utiliseoutils` VALUES (101, 275, NULL, 26, NULL, 'Retour utilisateur', NULL, '2013-04-15', '2013-04-16') ; 
INSERT INTO `utiliseoutils` VALUES (102, 275, NULL, NULL, 1, 'Retour utilisateur', NULL, '2013-04-15', '2013-04-23') ; 
INSERT INTO `utiliseoutils` VALUES (103, 275, NULL, NULL, 6, 'Retour utilisateur', NULL, '2013-04-15', '2013-04-15') ; 
INSERT INTO `utiliseoutils` VALUES (104, 276, NULL, 26, NULL, 'Retour utilisateur', NULL, '2013-05-13', '2013-05-13') ; 
INSERT INTO `utiliseoutils` VALUES (105, 276, NULL, NULL, 6, 'Retour utilisateur', NULL, '2013-05-13', '2013-05-16') ; 
INSERT INTO `utiliseoutils` VALUES (106, 276, NULL, NULL, 1, 'Retour utilisateur', NULL, '2013-05-13', '2013-05-14') ; 
INSERT INTO `utiliseoutils` VALUES (107, 276, 1, NULL, NULL, 'Retour utilisateur', NULL, '2013-05-13', '2013-05-13') ; 
INSERT INTO `utiliseoutils` VALUES (108, 276, 3, NULL, NULL, 'Retour utilisateur', NULL, '2013-05-13', '2013-05-13') ; 
INSERT INTO `utiliseoutils` VALUES (109, 276, 5, NULL, NULL, 'Demande transférée', NULL, '2013-05-13', '2013-05-13') ; 
INSERT INTO `utiliseoutils` VALUES (110, 276, 2, NULL, NULL, 'Retour utilisateur', NULL, '2013-05-13', '2013-05-13') ; 
INSERT INTO `utiliseoutils` VALUES (112, 277, 1, NULL, NULL, 'Retour utilisateur', NULL, '2013-05-13', '2013-05-14') ; 
INSERT INTO `utiliseoutils` VALUES (113, 277, 2, NULL, NULL, 'Retour utilisateur', NULL, '2013-05-13', '2013-05-16') ; 
INSERT INTO `utiliseoutils` VALUES (114, 277, 3, NULL, NULL, 'Retour utilisateur', NULL, '2013-05-13', '2013-05-14') ; 
INSERT INTO `utiliseoutils` VALUES (115, 277, NULL, NULL, 1, 'Retour utilisateur', NULL, '2013-05-13', '2013-05-16') ; 
INSERT INTO `utiliseoutils` VALUES (116, 277, NULL, NULL, 6, 'Retour utilisateur', NULL, '2013-05-13', '2013-05-16') ; 
INSERT INTO `utiliseoutils` VALUES (117, 277, 5, NULL, NULL, 'Demande transférée', NULL, '2013-05-14', '2013-05-14') ; 
INSERT INTO `utiliseoutils` VALUES (118, 277, NULL, 32, NULL, 'Retour utilisateur', NULL, '2013-05-14', '2013-05-14') ; 
INSERT INTO `utiliseoutils` VALUES (119, 278, 1, NULL, NULL, 'Demandé', NULL, '2013-05-21', '2013-05-21') ; 
INSERT INTO `utiliseoutils` VALUES (120, 278, 3, NULL, NULL, 'Demandé', NULL, '2013-05-21', '2013-05-21') ; 
INSERT INTO `utiliseoutils` VALUES (121, 278, 4, NULL, NULL, 'Demandé', NULL, '2013-05-21', '2013-05-21') ; 
INSERT INTO `utiliseoutils` VALUES (122, 278, 5, NULL, NULL, 'Demandé', NULL, '2013-05-21', '2013-05-21') ; 
INSERT INTO `utiliseoutils` VALUES (123, 278, 8, NULL, NULL, 'Demandé', NULL, '2013-05-21', '2013-05-21') ; 
INSERT INTO `utiliseoutils` VALUES (124, 278, NULL, 24, NULL, 'Demandé', NULL, '2013-05-21', '2013-05-21') ; 
INSERT INTO `utiliseoutils` VALUES (125, 278, NULL, NULL, 1, 'Demandé', NULL, '2013-05-21', '2013-05-21') ; 
INSERT INTO `utiliseoutils` VALUES (126, 278, NULL, NULL, 6, 'Demandé', NULL, '2013-05-21', '2013-05-21') ; 
INSERT INTO `utiliseoutils` VALUES (127, 279, 1, NULL, NULL, 'Demandé', NULL, '2013-05-21', '2013-05-21') ; 
INSERT INTO `utiliseoutils` VALUES (128, 279, 3, NULL, NULL, 'Demandé', NULL, '2013-05-21', '2013-05-21') ; 
INSERT INTO `utiliseoutils` VALUES (129, 279, 5, NULL, NULL, 'Demandé', NULL, '2013-05-21', '2013-05-21') ; 
INSERT INTO `utiliseoutils` VALUES (130, 279, 8, NULL, NULL, 'Demandé', NULL, '2013-05-21', '2013-05-21') ; 
INSERT INTO `utiliseoutils` VALUES (131, 279, NULL, 30, NULL, 'Demandé', NULL, '2013-05-21', '2013-05-21') ; 
INSERT INTO `utiliseoutils` VALUES (132, 279, NULL, NULL, 1, 'Demandé', NULL, '2013-05-21', '2013-05-21') ; 
INSERT INTO `utiliseoutils` VALUES (133, 279, NULL, NULL, 6, 'Demandé', NULL, '2013-05-21', '2013-05-21') ;
#
# End of data contents of table utiliseoutils
# --------------------------------------------------------

