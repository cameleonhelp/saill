<h4>Liste des fichiers d'aide à votre disposition:</h4>
<?php if (userAuth('profil_id')==1): ?>
<div class="panel-group" id="addfiles" style="margin-bottom: 15px;">
    <div class="panel">
        <div class="panel-heading  header-default">
          <h3 class="panel-title">
            <a class="accordion-toggle" data-toggle="collapse" data-parent="#addfiles" href="#panelfiles">
              Ajouter un fichier
            </a>
          </h3>
        </div>
        <div id="panelfiles" class="panel-collapse collapse">
          <div class="panel-body">
            <?php echo $this->Form->create('Fileshared',array('action'=>'shared','id'=>'formValidate','class'=>'form-horizontal','type' => 'file','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?>
                <div class="form-group">   
                    <label class="col-lg-4 control-label" for="FilesharedFile">Fichiers à partager : </label>
                    <div class="col-lg-offset-4">
                        <?php echo $this->Form->input('file', array('type' => 'file','size'=>"40",'class'=>'pull-left margintop5')); ?><label for="FilesharedFile" class="pull-left margintop7 italic"><?php echo 'taille max de '.ini_get('upload_max_filesize'); ?></label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-4 control-label" for="FilesharedWith">Avec : </label>
                    <div class="inline_labels margintop5">
                        <?php $options = array('all' => ' Tous ', 'adm' => ' Administrateurs');
                        $attributes = array('legend' => false,'value'=>'all','class'=>'margintop5');
                        ?>
                        <?php echo $this->Form->radio('with', $options, $attributes); ?>
                            <?php echo $this->Form->button('Partager', array('class' => 'btn btn-sm btn-primary pull-right showoverlay marginright15','type'=>'submit')); ?>
                    </div>
                </div>
            <?php echo $this->Form->end(); ?>
          </div>
        </div>
    </div>
</div>
<?php endif; ?>
<table cellpadding="0" cellspacing="0" class="table table-bordered table-striped table-hover" style="width: 100% !important;">
<thead>
<tr>
                <th style="width:30px;">&nbsp;</th>
                <th>Nom du fichier</th>
                <?php if (userAuth('profil_id')==1): ?>
                <th style="width:30px;">&nbsp;</th>
                <?php endif; ?>
                <th style="width:30px;">&nbsp;</th>
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