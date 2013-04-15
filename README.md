OSACT 2
=======

OSACT est un site pour suivre l'activité d'une équipe de développeurs, ainsi que le suivi logistique du matériel mis à disposition.

**Nouvelle version car modification de la conception pour les actions pour un suivi de l'activité réelle et de la facturation séparé**

OSACT_MCD.mwb => Schéma de base de données [MySQLWorkbench 5.2.47](http://www.mysql.fr/products/workbench/)

## Cette version s'appuie sur :

* [CakePhp 2.3.2] (http://cakephp.org) - Framework

* [BootStrap 2.3.1] (http://twitter.github.com/bootstrap/) - Style et javascript

* [JQuery 1.9.1] (http://jquery.com) - La dernière version de JQuery

* [Datepicker pour BootStrap] (https://github.com/vitalets/bootstrap-datepicker) - Pour changer du datepicker de JQuery-UI

* [Highcharts 3.0.1 et Highstock 1.3.1](http://www.highcharts.com) - bonne documentation (http://docs.highcharts.com)

## A venir l'utilisation de :

* [CakePDF] (https://github.com/ceeram/CakePdf) - Pour exporter au format PDF pour les rapports

## A venir jusqu'à fin avril :

* Facturation **FAIT**

* Limitation du périmètre de vision en fonction de l'utilisateur (test sur profil ou est hiérarchique ?) **FAIT**

* Incorporation des données référentielles **FAIT**

* Incorporation des données (Utilisateurs, Matériels informatique) **FAIT**

* Utilisation limité de l'outil ***En cours***

* Ajout du plan de charge ***En cours***

## A venir en version 2.1 :

* Duplication : 
 - Action
 - Livrable (demander si nouvelle version)
 - Profil et autorisations associées
 - Poste informatique
 - Utilisateur : déjà fait mais ajouter la duplication des ouverture de droit à l'état demandé, et les affectations.
                 Donner la possibilité d'ajouter un utilisateur incomplet juste sur les champs de l'ajout
 
* Prolongation des utilisateur en masse, ajouter une checkbox et si cocher faire la mise à jour.

* Postes informatique : dans vue ajouter le nom de la personne ayant le poste en dotation

* Feuille de temps avoir la possibilité d'ajouter des lignes dynamiquement, 
  ne pas créer d'enregistrement avant juste donner le choix de l'utilisateur 
  et de la date et afficher une ligne avec choix de l'activité, possibilité de suppression comme pour facturation.
  Voir si faisabilité en 2.0

* Génération de rapport avec graphique au format pdf.

## Bugs connus :

* Pour le moment un j'ai rescencé un bug sur l'utilisation de accordion 
(https://groups.google.com/forum/?fromgroups=#!topic/twitter-bootstrap/DhDWN1sGfTM) 
voici un test en ligne si vous avez une solution (http://jsfiddle.net/cameleonhelp/a5xxs/10/)

* [Select pour BootStrap] (http://caseyjhol.github.com/bootstrap-select/) - Pour modifier l'aspect des select => mise à jour des composant ajouter dynamiquement impossible
