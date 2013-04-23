<?php 
    $version = '2.0';
    $build = 'b042';
    echo $version.'.'.$build;
    /** 
     * changelog :
     * 
     * version 2.0.0 finale
     ****** mis sur serveur d'intégration ******
     * bxxx Rapports
     *      Actions -> nombre d'actions par mois par utilisateurs avec les états
     *      Activités réelles -> nombre d'activités réelles par mois par utilisateurs
     *      Facturation -> nombre de facturations par mois par utilisateurs
     *      Plan de charge -> nombre de charges prévues par mois par utilisateurs /ou par domaines par projet
     ****** mis sur serveur d'intégration ******
     * bxxx Nouvelle navigation
     * b042 Evolutions prévues en 2.1.0
     *      Dupliquer action
     *      Dupliquer livrable
     *      Dupliquer profil et autorisations associées
     *      Dupliquer poste informatique
     *      Dupliquer utilisateur même si incomplet - ok
     *      Prolongation en masse des utilisateurs - ok
     *      Archiver en masse les utilisateurs - ok
     *      Modification du menu pour ajouter les rapports des plans de charges - ok 
     ****** mis sur serveur d'intégration ******
     * b041 Travail sur le plan de charge (détail)
     *      Ajout :
     *      (IHM) Ajouter la ligne modèle et la première ligne de la table
     *      (IHM) par défaut etp = 1 et jours pour chaque mois = jours ouvrés si etp change alors jours pour chaque mois = jours ouvrés * etp recalculer le total
     *      (Controller) remonter la liste des utilisateurs pouvant être utilisés dans le plan de charge et ajouter des intervenants supplémentaires (Autre intervenant DSI-T, Réserve, Ressource prévisible)
     *      (Controller) remonter les domaines, activité des projets du contrat
     *      Edit :
     *      (IHM) Ajouter les lignes existantes - tout reste modifible
     *      (Controller) remonter la liste des utilisateurs pouvant être utilisés dans le plan de charge et ajouter des intervenants supplémentaires (Autre intervenant DSI-T, Réserve, Ressource prévisible)
     *      (Controller) remonter les domaines, activité des projets du contrat
     *      (Controller) remonter le détail existant
     *      Index : possibilité d'exporter au format Excel le détail du plan de charge
     *      Facturation search : pour le moment désactivation de la recherche car plantage sur timeout
     * b040 nouvelle feuille d'activité réelle avec insertion de ligne => basculée en intégration
     * b039 Filtres complémentaire sur facturation
     *      déverouillage d'une facturation déjà faite pour avoir la possibilité de la rectifier pour l'agent (reste le problème de récupérer le numéro de la facturation et la version déjà existante)
     *      Corriger le problème sur la récupération de la version et de la facturation existante
     * b038 Quelques corrections et évolutions (facturations et activités réelles : export excel, affichage du nom du projet, ...)
     *      Correction de la navigation sur les feuilles de temps (patch en attendant une nouvelle navigation)
     *      Mise en forme des exports Excel avec ajout de formule dans certains exports
     *      Facturations applications de filtres supplémentaires reste à mettre dans l'IHM
     * b037 Alerte si action ou livrable en retard au niveau de l'échéance ajout d'une class td-error sur les cellules
     * b036 Corrections de quelques bugs mineur en fonctions des profils et droits ouverts
     * b035 A facturer mise en place d'une checkbox et d'une validation en masse
     * b034 IHM du détail du plan de charge dans add.ctp et edit.ctp recopier le contenu de index.ctp et faire la boucle sur les bons objets retournés
     * b033 Modification du menu pour les rapports
     *      creation des methodes rapport pour les actions, activitesreelles, facturations
     *      Correction utilisateur pour l'affichage des outils utiliser dans le détail de l'utilisateur
     *      Ajout et édition du plan de charge, mise à jour du modéle pour restitution des dates au format FR
     * b032 planification à faire -> ajout de la function pour calculer le nombre de jours ouvrés à partir d'une date
     *      bake plancharges et detailplancharges
     *      controllers plancharges et detailplancharges index, add, edit
     *      models plancharges et detailplancharges
     * b031 fin de la facturation et migration vers cakephp 2.3.2 => bascule en production
     * b030 IHM de la liste des facturations faites
     * b029 Travail sur l'apect de la feuille de facturation et la sauvegarde de la facturation
     *      modification schéma de la base de donénes pour la facturation
     * b028 facturation add travail sur l'ajout de ligne dynamiquement, suppression
     *      suppression du composant select, correction effet de bord sur code jquery pour désactiver select
     * b027 correction de bugs + facturations
     * b026 optimisation des requetes
     * b020 utilisation régulière pour le suivi de la logistique et mon usage personnel
     *      Mis sur le serveur d'intégration
     * 
     **/
?>