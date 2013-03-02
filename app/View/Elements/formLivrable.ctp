<?php echo $this->Form->create('Livrable',array('id'=>'formValidate','class'=>'form-horizontal','inputDefaults' => array('label'=>false,'div' => false))); ?>
    <div class="control-group">
        <label class="control-label sstitre required" for="LivrableUtilisateurId">Gestionnaire du livrable : </label>
        <div class="controls">        
            <?php echo $this->Form->select('utilisateur_id',$utilisateur,array('data-rule-required'=>'true','data-msg-required'=>'Le nom du gestionnaire est obligatoire','empty' => 'Choisir un gestionnaire')); ?>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label sstitre  required" for="LivrableNOM">Nom du livrable: </label>
        <div class="controls">
            <?php echo $this->Form->input('NOM',array('data-rule-required'=>'true','placeholder'=>'Nom de livrable','class'=>'span10','data-msg-required'=>'Le nom de livrable est obligatoire','error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label sstitre" for="LivrableREFERENCE">Référence MINIDOC  : </label>
        <div class="controls">
            <?php echo $this->Form->input('REFERENCE',array('placeholder'=>'Référence MINIDOC','class'=>'span6','error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
        </div>
    </div>
    <div class="navbar">
        <div class="navbar-inner">
            <div class="container" style="margin-top:2px;text-align:center;">
                <?php $url = $this->Session->read('history'); ?>
                <?php echo $this->Form->button('Annuler', array('type'=>'button','class' => 'btn','onclick'=>"location.href='".$this->Html->url($url[0])."'")); ?>&nbsp;<?php echo $this->Form->button('Enregistrer', array('class' => 'btn btn-primary','type'=>'submit')); ?>                
            </div>
        </div>
    </div>
<?php if ($this->params->action == 'edit') echo $this->Form->input('id',array('type'=>'hidden')); ?>    
<?php echo $this->Form->end(); ?>
<?php if ($this->params['action']=='edit'){ ?>
<hr>
<button type="button" class='btn btn-inverse pull-right' onclick="location.href='<?php echo $this->Html->url('/suivilivrables/add/'.$this->data['Livrable']['id']); ?>';">Nouveau suivi</button>                    
<?php echo $this->element('tableSuiviLivrable'); ?>
<?php } ?>