
<?php echo $this->Form->create('Affectation',array('id'=>'formValidate','class'=>'form-horizontal','inputDefaults' => array('label'=>false,'div' => false))); ?>
<table>  
    <tr>
    <td>
        <label class="control-label sstitre  required" for="AffectationActiviteId">Activité : </label>
    </td>
    <td>
            <?php if ($this->params->action == 'edit') { ?>
                <?php echo $this->Form->select('activite_id',$activites, array('data-rule-required'=>'true','selected' => $this->data['Affectation']['activite_id'],'empty'=>'Choisir une activité','data-msg-required'=>"L'activité est obligatoire")); ?>
            <?php } else { ?>
                <?php echo $this->Form->select('activite_id',$activites, array('data-rule-required'=>'true','empty'=>'Choisir une activité','class'=>'span8','data-msg-required'=>"L'activité est obligatoire")); ?>
            <?php } ?>            
    </td>
    <td>
        <label class="control-label sstitre" for="AffectationREPARTITION">Clé de répartition : </label>
    </td>
    <td>
                <?php echo $this->Form->input('REPARTITION', array('class'=>'span2')); ?> %        
    </td>
    </tr>
</table>        
<div class="navbar">
    <div class="navbar-inner">
        <div class="container" style="margin-top:2px;text-align:center;">
            <?php $url = $this->Session->read('history'); ?>                   
            <?php echo $this->Form->button('Annuler', array('type'=>'button','class' => 'btn','onclick'=>"location.href='".$this->Html->url($url[1])."'")); ?>&nbsp;<?php echo $this->Form->button('Enregistrer', array('class' => 'btn btn-primary','type'=>'submit')); ?>                
        </div>
    </div>
</div> 
<?php $utilisateurId = $this->params->action == 'edit' ? $this->params->pass[1] : $this->params->pass[0]; ?>    
<?php echo $this->Form->input('utilisateur_id',array('type'=>'hidden','value'=>$utilisateurId)); ?>
<?php if ($this->params->action == 'edit') echo $this->Form->input('id',array('type'=>'hidden')); ?>
<?php echo $this->Form->end(); ?>
