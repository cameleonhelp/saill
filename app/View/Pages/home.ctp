<?php
$this->set('title_for_layout','Accueil');
?>
<div class="alert alert-info">
    Ce site à pour objectif de suivre les activités, livrables réalisés sur le projet.<br/><br/>
    Ce site est accessible à toutes personnes travaillant sur le projet.<br/><br/>
    Un accès à votre profil vous permettra de suivre certaines informations vous concernant.<br/>
    A partir de cet emplacement vous pourrez poser vos jours d'absences qui seront soumis à validation si vous n'êtes pas agent SNCF.<br/>
    Pour les agents SNCF la saisie des absences est à faire via l'application de suivi des absences.<br/><br/>
    Le menu 'Absences équipe' vous permettra de voir les indisponibilités de toutes les personnes travaillant sur le projet.<br/><br/>
    Dans les actions un filtre 'Todolist' vous permettra de suivre toutes vos activités ainsi que celles des personnes travaillant sur le même domaine que vous, 
    ou de toute votre équipe si vous avez la charge d'une équipe d'agents.<br/><br/>
    Le suivi des livrables vous permettra de suivre l'avancement des livrables, ces livrables peuvent être liés à une action.<br/><br/>
    Enfin des liens utiles à tous peuvent être partagés, seul celui qui a déposé le lien, ou un administrateur, peux le modifier ou le supprimer.<br/>
    <br/>
    Des fichiers d'aide sont à votre disposition ci-dessous.<br/>
    <br/>
    Nous espérons que ce site vous facilitera votre restitution d'activité et un meilleur partage de l'information.
</div>

<h4>Liste des fichiers d'aide à votre disposition :</h4>
<table cellpadding="0" cellspacing="0" class="table table-bordered table-striped table-hover">
<thead>
<tr>
                <th width="20px;">&nbsp;</th>
                <th>Nom du fichier</th>
                <th width="20px;">&nbsp;</th>
</tr>
</thead>
<tbody>
<?php define("WDS", "/"); ?>
<?php $files = listFolder('.'.WDS.'files'.WDS.'all'.WDS); ?>
<?php $filesadm = listFolder('.'.WDS.'files'.WDS.'admin'.WDS); ?>    
<?php $files = array_merge($files,$filesadm); ?>     
<?php asort($files); ?>      
<?php foreach ($files as $file): ?>
<tr>
        <td style="text-align:center;"><i class="<?php echo $file['ext'] != '' ?'ico-'.$file['ext']  : 'icon-blank' ;?>">&nbsp;</i></td>
        <td><?php echo $file['nom']; ?></td>
        <td style="text-align:center;"><?php echo $this->Html->link('<i class="icon-download-alt"></i>',$file['url'],array('target'=>'blank','escape' => false)); ?>&nbsp;</td>
</tr>
<?php endforeach; ?>
</tbody>
</table>