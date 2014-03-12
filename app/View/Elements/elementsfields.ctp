<h4>Liste des fichiers d'aide à votre disposition:</h4>
<?php if (userAuth('profil_id')==1): ?>
    <?php echo $this->element('modals/addfiles'); ?>
<?php endif; ?>
<table cellpadding="0" cellspacing="0" class="table table-bordered table-striped table-hover" style="width: 100% !important;">
<thead>
<tr>
    <?php $nbrow = userAuth('profil_id')==1 ? 4 : 3; ?>
    <th colspan="<?php echo $nbrow; ?>">Nom du fichier<div class="pull-right">
        <?php if (userAuth('profil_id')==1): ?>
            <a class="btn btn-sm btn-default" data-toggle="modal" data-target="#modaladdfiles">
              Ajouter un fichier
            </a>        
        <?php endif; ?>
    </div></th>
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
        <td style="text-align:center;line-height: 4px;"><span class="<?php echo $file['ext'] != '' ?'ico-'.$file['ext']  : 'icon-blank' ;?>"></span></td>
        <td><?php echo $file['nom']; ?></td>
        <?php if (userAuth('profil_id')==1): ?>
        <td style="text-align:center;line-height: 4px;"><?php echo $this->Html->link('<span class="glyphicons bin notchange"></span>',array('controller'=>'fileshareds','action'=>'deletefile',  str_replace('/', '+', $file['url'])),array('escape' => false), __('Etes-vous certain de vouloir supprimer ce fichier du partage.')); ?>&nbsp;</td>
        <?php endif; ?>
        <td style="text-align:center;line-height: 4px;"><?php echo $this->Html->link('<span class="glyphicons download_alt notchange"></span>',$file['url'],array('target'=>'blank','escape' => false)); ?>&nbsp;</td>
</tr>
<?php endforeach; ?>
</tbody>
</table>