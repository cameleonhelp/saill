<?php 
    $version = '2.0';
    $build = 'b032';
    echo $version.'.'.$build;
    /** 
     * changelog :
     * 
     * b020 utilisation régulière pour le suivi de la logistique et mon usage personnel
     * b026 optimisation des requetes
     * b027 correction de bugs + facturations
     * b028 facturation add travail sur l'ajout de ligne dynamiquement, suppression
     *      suppression du composant select, correction effet de bord sur code jquery pour désactiver select
     * b029 Travail sur l'apect de la feuille de facturation et la sauvegarde de la facturation
     *      modification schéma de la base de donénes pour la facturation
     * b030 IHM de la liste des facturations faites
     * b031 fin de la facturation et migration vers cakephp 2.3.2 => bascule en production
     * b032 planification à faire -> ajout de la function pour calculer le nombre de jours ouvrés à partir d'une date
     *      bake plancharges et detailplancharges
     *      controllers plancharges et detailplancharges index, add, edit
     *      models plancharges et detailplancharges
     * b033 Modification du menu pour les rapports
     *      creation des methodes rapport pour les actions, activitesreelles, facturations
     * 
     **/
?>