<h4>Liste des fichiers d'aide à votre disposition :</h4>
<?php if (userAuth('profil_id')==1): ?>
<div class="well well-small">
<?php echo $this->Form->create('Fileshared',array('action'=>'shared','id'=>'formValidate','class'=>'form-horizontal','type' => 'file','inputDefaults' => array('label'=>false,'div' => false))); ?>
<div class="control-group">   
    <label class="control-label sstitre" for="FilesharedFile">Fichiers à partager : </label>
    <div class="controls">
        <?php echo $this->Form->input('file', array('type' => 'file','size'=>"40")); ?>  
    </div>
</div>
<div class="control-group">
    <label class="control-label sstitre" for="FilesharedWith">Avec : </label>
    <div class="controls inline_labels">
        <?php $options = array('all' => ' Tous ', 'adm' => ' Administrateurs');
        //$attributes = array('legend' => false,'div' => 'false', 'type' => 'radio', 'options' => $options, 'default' => 'all');
        $attributes = array('legend' => false,'value'=>'all');
        ?>
        <?php echo $this->Form->radio('with', $options, $attributes); ?>
            <?php echo $this->Form->button('Partager', array('class' => 'btn btn-primary pull-right showoverlay','type'=>'submit')); ?>
    </div>
</div>
<?php echo $this->Form->end(); ?>
</div>
<?php endif; ?>
<table cellpadding="0" cellspacing="0" class="table table-bordered table-striped table-hover">
<thead>
<tr>
                <th width="18px;">&nbsp;</th>
                <th>Nom du fichier</th>
                <?php if (userAuth('profil_id')==1): ?>
                <th width="18px;">&nbsp;</th>
                <?php endif; ?>
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
        <td style="text-align:center;line-height: 4px;"><span class="<?php echo $file['ext'] != '' ?'ico-'.$file['ext']  : 'icon-blank' ;?>"></span></td>
        <td><?php echo $file['nom']; ?></td>
        <?php if (userAuth('profil_id')==1): ?>
        <td style="text-align:center;line-height: 4px;"><?php echo $this->Html->link('<span class="glyphicons bin"></span>',array('controller'=>'fileshareds','action'=>'deletefile',  str_replace('/', '+', $file['url'])),array('escape' => false), __('Etes-vous certain de vouloir supprimer ce fichier du partage.')); ?>&nbsp;</td>
        <?php endif; ?>
        <td style="text-align:center;line-height: 4px;"><?php echo $this->Html->link('<span class="glyphicons download_alt"></span>',$file['url'],array('target'=>'blank','escape' => false)); ?>&nbsp;</td>
</tr>
<?php endforeach; ?>
</tbody>
</table>