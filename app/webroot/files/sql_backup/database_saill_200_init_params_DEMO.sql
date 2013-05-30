UPDATE `utilisateurs` SET `password`=MD5('SAILL'),MAIL='j.levavasseur@gmail.com' WHERE `id` <> 1;
UPDATE `parameters` SET `param`='j.levavasseur@gmail.com' WHERE `nom` = 'contact';
UPDATE `parameters` SET `param`='2.0.0' WHERE `nom` = 'version';
UPDATE `parameters` SET `param`='DEMO' WHERE `nom` = 'instance';