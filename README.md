OSACT
=======

OSACT est un site pour suivre l'activité d'une équipe de développeurs, ainsi que le suivi logistique du matériel mis à disposition.

**Nouvelle version car modification de la conception pour les actions**

Maintenant une action et géré à part le calcul de l'activité réelle et la facturation sont elles aussi distinctes pour une facilité de calcul et de restitution ensuite.

Lorsque l'on enregistre une action une activité réelle est automatiquement enregistrée si la somme en base pour cette action et la date est < 1

Pour être certain en fin de mois que la saisie est correct l'agent pourra via un tableau compléter le manque de saisie

OSACT_MCD.mwb => Schéma de base de données [MySQLWorkbench](http://www.mysql.fr/products/workbench/)

## Cette version s'appuie sur :

* [CakePhp 2.3.1] (http://cakephp.org) - Framework

* [BootStrap 2.3.1] (http://twitter.github.com/bootstrap/) - Style et javascript

* [JQuery 1.9.1] (http://jquery.com) - La dernière version de JQuery

* [Datepicker pour BootStrap] (https://github.com/vitalets/bootstrap-datepicker) - Pour changer du datepicker de JQuery-UI

* [ContextMenu pour BootStrap] (https://github.com/nikolka/bootstrap-contextmenu) - Pour le moment pas encore implémenté

* [Editable pour BootStrap] (http://vitalets.github.com/bootstrap-editable/) - Testé pour utilisation dans une table

* [Select pour BootStrap] (http://caseyjhol.github.com/bootstrap-select/) - Pour modifier l'aspect des select

## A venir l'utilisation de :
 
* [Authorize] (https://github.com/ceeram/Authorize) - Prévois de l'utiliser pour savoir gérer les profils

* [CakePDF] (https://github.com/ceeram/CakePdf) - Pour exporter au format PDF je cherche la même chose pour Excel

* [Authentificate] (https://github.com/ceeram/Authenticate) - Prévois de l'utiliser pour s'authentifier

* Graphiques : 

 1. [Highcharts](http://www.highcharts.com) - bonne documentation (http://docs.highcharts.com)

 2. [amCharts](http://www.amcharts.com/download/)

 3. [Google api cakePhp](https://github.com/cjsaylor/Google-visualization-api-cakephp)

 4. [GoogleChart API Helper](http://bakery.cakephp.org/articles/ixu38/2010/04/30/googlechart-api-helper)

 5. [FusionCharts](https://github.com/lecterror/cakephp-fusion-charts-plugin)



## Bugs connus :

Pour le moment un j'ai rescencé un bug sur l'utilisation de accordion (https://groups.google.com/forum/?fromgroups=#!topic/twitter-bootstrap/DhDWN1sGfTM) voici un test en ligne si vous avez une solution (http://jsfiddle.net/cameleonhelp/a5xxs/10/)