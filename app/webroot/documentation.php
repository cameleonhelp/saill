<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>SAILL : Documentation</title>
</head>
<body>
<h4>Documentation technique de SAILL</h4>
Le site est réalisé à partir de différents composants php et javascript (JQuery).
<br>
Le compte admin pour se connecter en tant qu'administrateur est : <b>0000000A</b> le mot de passe reste à votre charge et ne peut être communiqué que par un administrateur du site ou de la base de donnéees.
<br>
Le reste des comptes sont liés au compte LDAP pour la connexion avec un simple de test, ensuite il est vérifié que le compte existe au niveau de SAILL pour construire le site en fonction du profil de la personne dans SAILL.
<br>
Certains composants ont été adaptés à l'utilisation faites dans le cadre de SAILL, comme :
<ul>
<li>Chronoline.js : modification faite à partir de la ligne 456 pour remplacer les tooltip par des popover</li>
<li>validate.js : modification partir de la ligne 1042 pour ne pas tenir compte des lignes cachées identifiées par le caractère ¤</li>
</ul>
Les méthodes utilisées sont commenter pour cela consulter le code des controllers.
<br>
Les fonctions communes et autres variables gloabales également. Ces fonctions et autres classes non comprises dans le framework CakePHP sont stockés dnas le dossier app/Vendor
<br>
Pour configurer une nouvelle instance de SAILL sur un serveur vous devez créer une base de données et renseigner les informations relatives à cette base dans le fichier app/Config/database.php.
<br>
D'autres fichier de ce dossier sont également à renseigner comme :
<ul>
    <li>bootstrap.php : contient la majorités des variables globales</li>
    <li>ldap.php : renseignements concernant la connexion au ldap de l'entreprise</li>
    <li>version.php : à modifier à chaque changement de numéro de version</li>
</ul>
<h4>Exemple de cartouche pour expliquer une méthode d'un controller</h4>
/**<br>
    * Méthode permettant de fixer la limite de visibilité dans les conditions des requêtes <i>"description"</i><br>
*<br>
    * @param string $visibility <i>"liste des paramètres avec le type et son nom"</i><br>
    * @return string <i>"type attendu en retour de la méthode"</i><br>
*/<br>
    Il est donc tout à fait envisageable de générer une documentation technique à partir du code avec APIGEN<br>
<h4>Le serveur (configuration minimum)</h4>
Le serveur doit avoir au minimum 2 coeurs et 4 Go de RAM pour un fonctionnement optimal.<br>
Le serveur web doit être un apache (v 2.2.3) avec une base de données MySQL (v 5.0.95) et une gestion de php (v 5.3.3 !!!NON COMPATIBLE 5.4 et +!!!), les extensions nécessaires sont :
<ul>
    <li>Module Apache : mod_rewrite</li>
    <li>Extensions php : php_ldap, php_mysql, php_zip</li>
</ul>
Pour gérer la base MySQL la mise en place de phpMyAdmin vous permettra de faire des sauvegardes ou de restaurer facilement votre base de données, ce qui est aussi faisable depuis SAILL.
<br>
<h4>Les pseudo web services </h4>
<ul>
    <li>notify_actions_echues : permet de notifier les agents ayant des actions qui devraient être terminées depuis un certain délais par rapport à la date du jour</li>
    <li>notify_actions_a_venir : permet de notifier les agents de l'échance proche des actions</li>
    <li>il en existe d'autres que vous pouvez trouver dans le manuel, tous ces pseudos webservices sont à exécuter en lançant depuis un navigateur l'url [dns du site]/webservices/[action]/[paramètres]</li>
</ul>
</body>
</html>