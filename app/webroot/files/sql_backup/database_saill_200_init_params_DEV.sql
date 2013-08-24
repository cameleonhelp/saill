UPDATE `utilisateurs` SET `password`=MD5('SAILL'),MAIL='j.levavasseur@gmail.com' WHERE `id` <> 1;
UPDATE `parameters` SET `param`='j.levavasseur@gmail.com' WHERE `nom` = 'contact';
UPDATE `parameters` SET `param`='j.levavasseur@gmail.com' WHERE `nom` = 'gestionnaireannuaire';
UPDATE `parameters` SET `param`='j.levavasseur@gmail.com' WHERE `nom` = 'valideuroutil';
UPDATE `parameters` SET `param`='2.0.1b069' WHERE `nom` = 'version';
UPDATE `parameters` SET `param`='DEV' WHERE `nom` = 'instance';