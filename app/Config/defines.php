<?php

/* 
 * Permet de fixer les variables globales de saill
 */
$config = array('defines');

Configure::write(
    'etatOuvertureDroit',array('Demandé'=>'Demandé','Pris en compte'=>'Pris en compte','En validation'=>'En validation','Validé'=>'Validé','Demande transférée'=>'Demande transférée','Demande traitée'=>'Demande traitée','Retour utilisateur'=>'Retour utilisateur','A supprimer'=>"A supprimer",'Supprimée'=>'Supprimée')
);

Configure::write(
    'etatMaterielInformatique',array('En stock'=>'En stock','En dotation'=>'En dotation','En réparation'=>'En réparation','Au rebut'=>'Au rebut','Non localisé'=>'Non localisé','En prêt'=>'En prêt')
);

Configure::write(
    'workCapacity',array('100'=>'5 jours par semaine','80'=>'4 jours par semaine','60'=>'3 jours par semaine','40'=>'2 jours par semaine','20'=>'1 jour par semaine')
);

Configure::write(
    'typeProjet',array('Projet'=>'Projet','MCO'=>'MCO','Evolution'=>'Evolution','Intégration'=>'Intégration','Exploitation'=>'Exploitation') //,'Indisponibilité'=>'Indisponibilité'
);

Configure::write(
    'factureProjet',array('régie'=>'Régie','forfait'=>'Forfait') //,'autre'=>'Autre'
);

Configure::write(
    'etatLivrable',array('à faire'=>'A faire','en cours'=>'En cours','livré'=>'Livré','validé'=>'Validé','refusé'=>'Refusé','annulé'=>'Annulé') //,'autre'=>'Autre'
);

Configure::write(
    'etatAction',array('à faire'=>'A faire','en cours'=>'En cours','terminée'=>'Terminée','livré'=>'Livrée','annulée'=>'Annulée') 
);

Configure::write(
    'prioriteAction',array('normale'=>'Normale','moyenne'=>'Moyenne','haute'=>'Haute') 
);

Configure::write(
    'typeAction',array('action'=>'Action','indisponibilité'=>'Absences','standard'=>'Automatique')
);

Configure::write(
    'changelogEtatDemande',array('0'=>'Ouverte','5'=>'Prise en compte','6'=>'Attribuée','1'=>'Version future','2'=>'Rejetée','3'=>'En cours','4'=>'Fermée') 
);

Configure::write(
    'changelogEtatVersion',array('0'=>'Ouverte','1'=>'Fermée') 
);

Configure::write(
    'changelogType',array('0'=>'Demande','1'=>'Anomalie','2'=>'Evolution','3'=>'Mise à jour composant','4'=>'Modélisation','5'=>"Documentation") 
);

Configure::write(
    'changelogCriticite',array('0'=>'Sans contrainte','1'=>'Normale','2'=>'Urgente','3'=>'Bloquante') 
);

Configure::write(
    'planprojetPublic',array('0'=>'Moi uniquement','1'=>'Mon équipe','2'=>'Public') 
);

Configure::write(
    'engagementConf',array('0'=>'Non remis','1'=>'Agent','2'=>'SNCF','3'=>'Sécutité et Risques SO') 
);

//Configure::write('versionapp', '3.0.1.001');

Configure::write('mailapp', 'saill.nepasrepondre@sncf.fr');

Configure::write('Config.language', 'fra');

Configure::write('search_tooltip',"Recherche multi-critère en séparant par un <u><b>espace</b></u> les différents mots.<br>Effacer la recherche pour revenir à l'affichage normal.");

?>

