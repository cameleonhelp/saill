<div class="span22" style="margin-right: 25px !important;margin-left: 0px !important;">
<?php
$this->set('title_for_layout','Accueil');
?>
<div class="alert alert-info">
    Ce site à pour objectif de suivre les activités, livrables réalisés sur le projet.<br/><br/>
    Ce site est accessible à toutes personnes travaillant sur le projet.<br/><br/>
    Un accès à votre profil vous permettra de suivre certaines informations vous concernant.<br/>
    A partir de ce site vous pourrez indiquer vos absences, cela ne dispense pas d'en faire la demande à votre responsable.<br/>
    Pour les agents SNCF la saisie des absences est à faire via l'application de suivi des absences.<br/><br/>
    Le menu 'Absences équipe' vous permettra de voir les indisponibilités de toutes les personnes travaillant sur le projet.<br/><br/>
    Dans les actions un filtre 'Todolist' vous permettra de suivre toutes vos activités ainsi que celles des personnes travaillant sur le même domaine que vous, 
    ou de toute votre équipe si vous avez la charge d'une équipe d'agents.<br/><br/>
    Le suivi des livrables vous permettra de suivre l'avancement des livrables, ces livrables peuvent être liés à des actions.<br/><br/>
    Enfin des liens utiles à tous, peuvent être partagés, seul celui qui a déposé le lien, peux le modifier ou le supprimer.<br/>
    <br/>
    Vous trouverez ci-dessous des fichiers qui sont à votre disposition ci-dessouspour vous aider dans votre activité ou des informations à connaître.<br/>
    <br/>
    Nous espérons que ce site vous facilitera votre restitution d'activité et un meilleur partage de l'information.
</div>
<div style='display: table;width: 100%;'>
<h4>Liste des fichiers d'aide à votre disposition :</h4>
<table cellpadding="0" cellspacing="0" class="table table-bordered table-striped table-hover">
<thead>
<tr>
                <th width="18px;">&nbsp;</th>
                <th>Nom du fichier</th>
                <th width="18px;">&nbsp;</th>
</tr>
</thead>
<tbody>
<?php define("WDS", "/"); ?>
<?php $files = listFolder('.'.WDS.'files'.WDS.'all'.WDS); ?>
<?php $filesadm = (userAuth('profil_id')<6 || userAuth('profil_id')==8) ? listFolder('.'.WDS.'files'.WDS.'admin'.WDS) : array(); ?>    
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
</div>
</div>
<div class='offset22 block'>
<?php echo $this->element('mystats'); ?>
</div>