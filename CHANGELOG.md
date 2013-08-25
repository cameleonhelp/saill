## LEGEND ##
[X] A faire
[O] En cours il existe déjà des choses de faites
[F] A corriger existe encore des bugs
[V] Vérifié et validé
(1) pas urgent
(2) normal
(3) urgent
(4) bloquant
## LEGEND ##

## 210.001
 * [X](1) [CakePHP] : intégration de la version 3.0.0 à sa sortie

## 202.002
 * [X](1) [Actions-index] : test de remplacement la timeline par chronoline.js si concluant inclure dans cette version
 * [X](1) [Actions-Add-Edit-index] : Intégrer une gestion de risque sur l'action reprendre tableau de criticité IDEO et ajouter un champs risque dans l'action (combinaison entre probabilité et gravité)
 *                                   Gravité = (impact coût + impact délais + impact qualité)/3 pour simplifier on va parler que gravité le mieux étant de mettre en place une matrice de risque sous forme de tableau
 *                                   avec un indice pour chaque point d'intersection et un niveau à afficher

## 202.001
 * [V](1) Nouvelle numérotation de version
 * [V](2) [Activitésréelles-Index] : Date n'étant pas du mois apparaissent en grisé
 * [V](2) [Activitésréelles-Index] : Décompter les date en grisé du total de la semaine
 * [V](2) [Utilisateurs-Login] : ajout d'une fonctionnalité et d'une vue pour initialiser le mot de passe généré de façon aléatoire par l'application, envois d'un mail à l'utilisateur 
 * [V](2) [Activitésréelles-Index] : Ajouter un filtre sur les indisponibilités pour les afficher ou non dans le filtre etats à renommer en filtres ... et en mettant des headers dans la dropdown
 * [V](1) [TinyMCE] : Intégrer la nouvelle version 4.0.4 
 * [V](1) [Highcharts] : Intégrer la nouvelle version 3.0.5 
 * [V](1) [TinyMCE] : Ajout du plugin unlink 
 * [V](1) [CakePHP] : Intégrer la version 2.3.9 
 * [V](1) [All submit form] : Intégration de la mise en place de l'overlay
 * [V](1) [MCD] : révision du MCD pour intégrer la mise en place de la périodicité, création d'une nouvelle table et ajout de champs dans la table actions. 
 * [V](1) [MCD] : révision du MCD pour intégrer la mise en place de la criticité INT nullable pour future version
 * [V](1) [MCD] : Prévoir un script de création du compte admin, profil, autorisation
 * [V](1)         Export du script de création de la base. 
 * [V](2) [Actions-Add-Edit] : ajout de la périodicité, création d'une table pour sauvegarder la périodicité et ajout de champs dans la table action.
 * [V](2)                      Modification de la vue pour l'ajout et la modification
 * [V](2)                      Sauvegarde de la périodicité
 * [V](2)                      Calcul des jours pour lesquels il faut créer une action
 * [V](2)                      Suppression des boutons pour ajouter des feuilles de temps, modifier ou consulter (pour éviter une confusion entre les actions et les activités réelles)
 * [F](2)                      (controller) Modification de l'ajout pour la création des actions
 * [X](2)                      (controller) Modification de l'edit pour mettre à jour l'action et la périodicité (suppression des actions encore à faire et création de nouvelles actions à partir de la date du jour)
 * [V](2)                      Suppression de la périodicité de l'action
 * [V](2)                      Suppression de la périodicité des action encore à faire liées à cette périodicité
 * [O](1) [Facturation-RapportSS2I] : Nouveau créer un rapport pour calculer la charges des agents à facturer à la SS2I
 * [X](2) [#FIX:Facturation-edit] édition de la facturation (enregistrement d'une nouvelle version, erreur ou ne fait rien)
 * [X](3) [#FIX:Facturation-Rapport] calcul sur les rapports activités - facturation erronés à revoir
 * [X](2) [Action-index] : donner la possibilité de sélectionner plusieurs actions pour les supprimer ou les dupliquer
 * [X](1) [#FIX:Utiliseoutils-index] : liste des utilisateurs incorrecte
 * [V](2) [#FIX: toutes les pages] : showoverlay à mettre sur les boutons et non sur pagination class="pagination pagination-centered !showoverlay!"

## b069
 * Intégrer la mise à jour de bootstrap 3.0.0RC1 => travail énorme remis à plus tard car prévoir une refonte des pages cf 2.1.0 maquette en place reste à intégrer le framework php et le MVC
 * Intégrer les icones glyphicons sous forme de police avec différentes tailles et couleurs travail sur le css à part pour déjà avoir une bonne base puis intégration au code ensuite. - OK
 * appliquer overlay sur les actions le demandant en même temps - ajouter la classe showoverlay - OK
 * [#FIX] Achats filtre activités revoir requete ne pas remonter toutes les activités mais uniquement celles ayant des achats - OK
 * [#FIX] Activites filtre projets revoir requete ne pas remonter tous les projets mais uniquement cceux avec des activités - OK
 * ActionLivrables/Add voir si possible de mettre sous forme de tableau avec selection multiple - OK
 * mettre en place une meilleure gestion des erreurs que dans le appcontroller - ajout dans /lib/Cake/Error/exceptions.php de l'exception NotAuthorizedException - OK
 * [#FIX] Ajout de la date de création et de modification sur la duplication de matériel - OK
 * traduction de l'application à l'aide du fichier default.po - Abandonné
 * utilisateur ajout possibilité de modifier l'état sans avoir à éditer l'utilisateur - OK

## b068
 * Livrable ajouter un filtre mon équipe comme pour action pour le gestionnaire - OK
 * Rapports Dashbord manque un choix sur l'année. - OK
 * Feuille de temps refuser et alerter si total lignes inférieure au nombre de jours ouvrés de la semaine - OK
 * facturation ajouter un memo avec zone de saisie si on clique dessus change en éditeur de texte apparition d'un symbole alert /!\ - OK
 * Sur détail plan de charges si agent désactivé cacher le select et mettre le nom de l'agent dans la cellule - OK
 * Initialiser le mot de passe admin dans paramétrage - OK
 * Rapports Activités réelles essayer de faire le calcul en enlevant les jours qui ne sont pas entre le 1er et le dernier jour du mois, - OK
 * Rapports facturation estimée essayer de faire le calcul en enlevant les jours qui ne sont pas entre le 1er et le dernier jour du mois, - OK
 * Ajout d'un bouton dans la zone de texte du mémo pour effacer en un clique le mémo - OK
 * [#FIX] Mes statistiques afficher un message si aucune information sur action et livrables - OK
 * ajouter une timeline dans la liste des actions - mis en place reste à remonter les actions dans la timeline - OK
 * ajout overlays sur le changement dans absences équipe - OK
 * [#FIX] passe le statut à en cours si avancement = 10 - OK
 * [#FIX] listes des utilisateur dans les rapports activités réelles et facturation en fonction des utilisateurs ayant fait une saisie - OK
 * [#FIX] chargement des fonctions javascript pour la timeline si besoin - OK
 * [#FIX] prise en compte des caractères accentué pour les exports - OK
 * [#FIX] Liste des agents destinataires des action (index,add et edit) - OK
 * ajout envois de mail du plan de charge agent - OK
 * Imputer en charge le montant des achats effectués sur un projet, faire apparaître un message indiquant l'équivalence jour et le montant facturé. Dans le tableau de bord.

## b067
 * Import ICS controler que le jour n'est pas férié  - OK
 * Ajouter une alerte modal rouge pour inviter les personnes utilisant IE à utiliser un autre navigateur - OK
 * Fermeture du message flash au bout de 10 secondes - OK
 * Ajouter un filtre pour les actions nouvellement créées et pour filtrer sur mon équipe - OK
 * Action : ajouter une colonne destinataire - OK
 * Plan de charge indication des prise en compte des vacances - OK
 * Etat saisie calculer le nombre d'agent qui n'ont pas fait leur saisie, si possible en trouver la liste, avoir la possibilité d'envoyer un mail de relance - OK
 * Budget/Plan de charge ajouter un parametrage de visibilité ainsi qu'un filtre visible comme pour Facturations/Facturé - OK

## b066
 * Mise à jour TinyMCE en 4.0.2
 * Mise à jour CakePHP en 2.3.8
 * Corrections mineures sur Dashboard (calcul premier tableau incorrect)
 * Corrections mineures sur les actions et la progression de l'avancement
 
## b065
 * Gestion des erreur et redirection vers la page d'accueil ou de connexion
 * Création du plan de charge par agent

## b064
 * Nouveau theme en relation avec le nouvel intranet et le site SNCF.com
 * Intégration de la version 2.3.7 de cakephp
 * Intégration de la version 1.10.2 de jQuery
 * Mise en place d'aide dans les pages (les plus utilisées) à côté de la zone de recherche

## b063
 * amélioration de la sauvegarde de l'historique des actions pour éviter un trop grand nombre d'historique
 * Activité réelle controle du total avant insertion en base
 * Import ICS enlève les jours fériés en week end
 * Optimisation de la function pour rechercher les jours fériés en fonction de l'OS d'installation

## b062
 * rapport logistique par section à choisir
 * rapport sur l'état de la saisie du mois
 * en cas de duplication d'une activité réelle envoyer mail s'il s'agit d'une indisponibilité
 * ajout de tooltip sur les icones d'action
 * ajouter un bouton pour cacher le menu et le faire apparaitre en changeant la taille du contenu

## b061
 * Correction sur facturation avec insertion d'une ligne vide
 * Correction sur proposition d'un feuille de temps déjà soumise à facturation
 * Evolution ajout année en filtre sur facturation/index, activitesreelle/afacturer, activitésreelle/index

## b060
 * **version 2.0.1 finale**
 * Mise en place d'envois de mail sur :
  * la création d'utilisateur
  * saisie d'une indisponibilité
  * création d'une action
  * création ou mise à jour d'une demande de droit
 * Gestion d'erreur dans l'envois de mail
 * conversion des messages en français sur retour erreur d'envois de mail
 * validation ou avertissement d'un valideur d'indisponibilité (spécifique aux prestataires, concerne un petite population)
 * mise à jour de jquery en 1.10.1
 * retrait des model, controller et view MailTemplate et replaceString
 * Rapport plan de charge calculer le cout à partir du TJM agent attribué à chaque agent, calculer le TJM moyen.
 * Template d'email avec envois si demandé (choix laissé à l'utilisateur ou action de notification, envois automatique sur certaines actions)
 * Ajout d'un rapport détaillé sur les actions
 * Ajout d'un rapport sur les action pour avoir le détail de celle-ci
 * Ajout des mails du gestionnaire d'annuaire et du service manager
 * sur création utilisateur ou activation, anvois mail au gestionnaire d'annuaire
 * Dans les filtre ajout d'un filtre rapide pour Moi sur les gestionnaires
 * Sur demande validation ouverture de droit envois mail au service manager
 * Ajout d'un lien pour mettre à jour l'avancement de la demande de droit dans le mail

## b059
 * lors de la suppresion d'une ligne dans activité réelle enlever la ligne de la base en ajax >>FAIT<<
 * Mise à jour des paramétrage du site >>FAIT<<
 * Prise en compte des environnements sous Windows pour la gestion des sauvegardes et restaurations >>FAIT<<
 * Importation des fichier ics >>FAIT<<
 * saisie en masse pour autrui si administrateur ou si ressources génériques >>FAIT<<
 * Création de l'équipe pour validation des indisponibilités >>FAIT<<
 * correction sur la page activités réelles >>FAIT<<
 * Screenshot de la page absences équipe >>FAIT<<
 * Indicateurs département sans les dates uniquement sur le budget >>FAIT<<
 * Tableau de bord : Mis le plan de charge facultatif >>FAIT<<
 * Ajout d'une autorisation pour la saisie en masse >>FAIT<<

## b058 /!\ extension php_mysql obligatoire pour backup_retsore.class.php
 * Gestions des fichiers des dossiers admin, all avec add, delete >>FAIT<<
 * Sur la création d'action en automatique des ouvertures de droits ajouter le sujet de la demande dans l'objet >>FAIT<<
 * Créer une action automatiquement lors de la création d'un livrable avec le livrable associé rediriger vers cette action pour la compléter >>FAIT<<
 * ne pas afficher la possibilité d'intégrer un ics si action = afacturer >>FAIT<<
 * Problème sur la facturation création d'une ligne vide >>FAIT<<
 * Revoir la navigation >>FAIT<<
 * Vue des paramétrage >>FAIT<<
 * Méthode de sauvegarde de la base de données (data uniquement) >>FAIT<<
 * vue de restauration >>FAIT<< + méthode >>FAIT<<
 * rétablissement de contact avec envois à partir d'une adresse mail gmail >>FAIT<<

## b057 
 * Livrables dates rendues facultatives sauf échéance (idem pour suivilivrable)
 * actions : corriger le changement d'émetteur de l'action en cas de mise à jour l'émetteur reste inchangé
 * mon profil possibilité donné d'ajouter son matériel informatique par les utilisateurs avec ce droit

## b056 
 * filtre alphabétique sur les utilisateurs
 * préparation des fichiers pour le paramétrage, les mails
 * quelques corrections mineures

## b055 
 * création de compte générique
 * Ouverture de droits ajout de la date de dernière mise à jour dans l'index
 * Affichage d'un message lors de la saisie des feuille de temps pour avertir que les semaines doivent être saisie en entier et par semaine entière
 * si début de semaine en mois 0 et fin de semaine sur le mois suivant alors saisir la semaine entière
 * *mis sur serveur d'intégration*

## b054 
 * corrections mineures
 * actions ajouts du choix si CRA ou pas
 * actions rapports rapport par domaine
 * activitésréelles ajout du domaines et rapport modifié en conséquence
 * activitésréelles comme facturation donner la possibilité de faire des actions groupées
 * **version 2.0.0 finale**
 * *mis sur serveur d'intégration*
 
## b053 
 * Corrections mineures avant démonstrations et création du manuel utilisateur

## b052 
 * Révision de la navigation en enregistrant sous forme de tableau les valeurs à tester et l'url

## b051 
 * Historiser les budgets sur les actions par années, sélectionner le budget à prendre par défaut
 * modifier le schéma de base pour cela en ajoutant une table historybudget
 * optimisation requete absences

## b050 
 * Tableau de bord accostage contrat,facturé reste à faire -> requetage fait reste à mettre en forme

## b049 
 * Rapports
 * Plan de charge -> nombre de charges prévues par mois par utilisateurs /ou par domaines par projet    

## b048 
 * Activités réelles -> nombre d'activités réelles par mois par utilisateurs
 * Facturation -> nombre de facturations par mois par utilisateurs

## b047 
 * Actions -> nombre d'actions par mois par utilisateurs avec les états avec graphique et export au format doc
 * ! mise en place de la version 2.3.4 de cakephp - security patch !

## b046 
 * mise en place des liens en ajax/jquery pour une harmonisation des actions avec un overlay de la fenêtre entière

## b045 
 * Mise à jour en masse des ouvertures de droits
 * correction sur la navigation 
 * mise à jour de l'affichage des absences si le compte est actif en cours de mois
 * passe sur les controllers pour s'asurer que les index par défaut sont bien prix en compte
 * *mis sur serveur d'intégration* le 25/04/2013

## b044 
 * Nouvelle navigation - ok
 * Corrections mineures (listage de fichier retirer les fichiers 'empty', class 'month' dupliquée pour le plan de charge) - ok
 * ! mise en place de la version 2.3.3 de cakephp - security patch !
 * *mis sur serveur d'intégration* le 24/04/2013

## b043 
 * Ajout d'action lors de la création d'utilisateur et d'ouverture de droit - ok
 * *mis sur serveur d'intégration*
 
## b042 
 * Evolutions prévues en 2.1.0
 * Dupliquer action - ok
 * Dupliquer livrable - ok
 * Dupliquer profil et autorisations associées - ok y compris delete
 * Dupliquer poste informatique - ok
 * Dupliquer utilisateur même si incomplet - ok
 * Prolongation en masse des utilisateurs - ok
 * Archiver en masse les utilisateurs - ok
 * Modification du menu pour ajouter les rapports des plans de charges - ok 
 * *mis sur serveur d'intégration*

## b041 
 * Travail sur le plan de charge (détail)
 * Ajout :
 * (IHM) Ajouter la ligne modèle et la première ligne de la table
 * (IHM) par défaut etp = 1 et jours pour chaque mois = jours ouvrés si etp change alors jours pour chaque mois = jours ouvrés * etp recalculer le total
 * (Controller) remonter la liste des utilisateurs pouvant être utilisés dans le plan de charge et ajouter des intervenants supplémentaires (Autre intervenant DSI-T, Réserve, Ressource prévisible)
 * (Controller) remonter les domaines, activité des projets du contrat
 * Edit :
 * (IHM) Ajouter les lignes existantes - tout reste modifible
 * (Controller) remonter la liste des utilisateurs pouvant être utilisés dans le plan de charge et ajouter des intervenants supplémentaires (Autre intervenant DSI-T, Réserve, Ressource prévisible)
 * (Controller) remonter les domaines, activité des projets du contrat
 * (Controller) remonter le détail existant
 * Index : possibilité d'exporter au format Excel le détail du plan de charge
 * Facturation search : pour le moment désactivation de la recherche car plantage sur timeout

## b040 
 * nouvelle feuille d'activité réelle avec insertion de ligne => basculée en intégration

## b039 
 * Filtres complémentaire sur facturation
 * déverouillage d'une facturation déjà faite pour avoir la possibilité de la rectifier pour l'agent (reste le problème de récupérer le numéro de la facturation et la version déjà existante)
 * Corriger le problème sur la récupération de la version et de la facturation existante

## b038 
 * Quelques corrections et évolutions (facturations et activités réelles : export excel, affichage du nom du projet, ...)
 * Correction de la navigation sur les feuilles de temps (patch en attendant une nouvelle navigation)
 * Mise en forme des exports Excel avec ajout de formule dans certains exports
 * Facturations applications de filtres supplémentaires reste à mettre dans l'IHM

## b037 
 * Alerte si action ou livrable en retard au niveau de l'échéance ajout d'une class td-error sur les cellules

## b036 
 * Corrections de quelques bugs mineur en fonctions des profils et droits ouverts

## b035 
 * A facturer mise en place d'une checkbox et d'une validation en masse

## b034 
 * IHM du détail du plan de charge dans add.ctp et edit.ctp recopier le contenu de index.ctp et faire la boucle sur les bons objets retournés

## b033 
 * Modification du menu pour les rapports
 * creation des methodes rapport pour les actions, activitesreelles, facturations
 * Correction utilisateur pour l'affichage des outils utiliser dans le détail de l'utilisateur
 * Ajout et édition du plan de charge, mise à jour du modéle pour restitution des dates au format FR

## b032 
 * planification à faire -> ajout de la function pour calculer le nombre de jours ouvrés à partir d'une date
 * bake plancharges et detailplancharges
 * controllers plancharges et detailplancharges index, add, edit
 * models plancharges et detailplancharges

## b031 
 * fin de la facturation et migration vers cakephp 2.3.2 => bascule en production

## b030 
 * IHM de la liste des facturations faites

## b029 
 * Travail sur l'apect de la feuille de facturation et la sauvegarde de la facturation
 * modification schéma de la base de donénes pour la facturation

## b028 
 * facturation add travail sur l'ajout de ligne dynamiquement, suppression
 * suppression du composant select, correction effet de bord sur code jquery pour désactiver select

## b027 
 * correction de bugs + facturations

## b026 
 * optimisation des requetes

## b020 
 * utilisation régulière pour le suivi de la logistique et mon usage personnel
 * Mis sur le serveur d'intégration
