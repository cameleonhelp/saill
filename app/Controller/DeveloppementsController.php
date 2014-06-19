<?php
/**
 * Description of DeveloppementsController
 *
 * @version 3.0.1.002 le 28/05/2014 par Jacques LEVAVASSEUR
 */
class DeveloppementsController {
    /**
     Cet outil est développé à partir du framework CakePHP.
     La conception de la base de données est géré avec MySQLWorkbench.
     La partie IHM se base sur le framework CSS Bootstrap
     Un éditeur WYSWYG TinyMCE
     Des composants javascript sont utilisés pour rendre cet outil aussi agréable que possible à utiliser.
     - JQuery
     - Filemanager : plugin pour TinyMCE pour gérer l'uplod des fichiers
     - Highcharts / Histocks pour les graphiques
     - Validation pour valider avant le post les formulaires (1)
     - Chronoline pour visualiser dans le temps les actions
     - Datepicker pour choisir une date dans les input
     - Colorpicker pour choisir une couleur qui représentera un utilisateur
     - Maskeinput pour mettre un masque sur un input
     - TableSorter pour ahjouter les tris et les recherches sur les tableaux non gérés par CakePHP car remonte toutes les lignes donc sans pagination
     - FlipCOuntDown pour afficher le jour et l'heure au dessus du menu
     - X-editable pour modifier directement dans un tableau des valeurs (doublon avec tablesorter voir la faisabilité d'utiliser tableasorter à la place)
     
     (1) modification de celui-ci pour la gestion des lignes cachées dans les tableaux avec ajout de ligne:
         required: function( value, element, param ) {
            //JLR - spécifique SAILL
            var id = $(element).attr('id');
            var n=id.indexOf("¤"); //Ligne importante car recherche si l'index contient le caractère ¤ qui symbolise les lignes cachées
     */
}
