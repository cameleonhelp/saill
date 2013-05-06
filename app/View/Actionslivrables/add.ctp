<div class="actionslivrables form">
<?php echo $this->Form->create('Actionslivrable',array('id'=>'formValidate','class'=>'form-horizontal','inputDefaults' => array('label'=>false,'div' => false))); ?>
        <div class="control-group">
            <label class="control-label sstitre required" for="ActionslivrableLivrableId">Livrable : </label>
            <div class="controls">  
                <?php echo $this->Form->select('livrable_id',$livrables,array('default' => userAuth('id'),'empty' => 'Choisir un livrable','data-rule-required'=>'true','data-msg-required'=>"Le livrable est obligatoire")); ?>
            </div>
        </div>	
    <?php echo $this->Form->input('action_id',array('type'=>'hidden','value'=>$this->params->pass[0])); ?>
        <div class="navbar">
            <div class="navbar-inner">
                <div class="container" style="margin-top:2px;text-align:center;">
                    <?php $url = $this->Session->read('history'); $index = count($url) > 1 ? 1 : 0;?>
                    <?php echo $this->Form->button('Annuler', array('type'=>'button','class' => 'btn','onclick'=>"location.href='".$this->Html->url($url[$index]['here'])."/<'")); ?>&nbsp;<?php echo $this->Form->button('Enregistrer', array('class' => 'btn btn-primary','type'=>'submit')); ?>                
                </div>
            </div>
        </div>
<?php echo $this->Form->end(); ?>
