<?php

/* 
 * Permet de fixer les information de connextion au serveur ldap
 */
$config = array('ldap');

Configure::write(
    'ldap',array('host'=>'localhost',
                 'port'=>'389', 
                 'version'=>3,
                 'prefix'=>'uid=',
                 'domaine'=>',cn=users,dc=ldap,dc=test,dc=domaine,dc=me'
                )
);


?>