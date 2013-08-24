
<?php echo $this->Form->create('Affectation',array('id'=>'formValidate','class'=>'form-horizontal','inputDefaults' => array('label'=>false,'div' => false))); ?>
<table>  
    <tr>
    <td>
        <label class="control-label sstitre  required" for="AffectationActiviteId">Activité : </label>
    </td>
    <td>
            <select name="data[Affectation][activite_id]" data-rule-required="true" data-msg-required="Le nom de l'activité est obligatoire" id="AchatActiviteId"> 
                <option value="">Choisir une activité</option>
                <?php foreach ($activites as $activite) : ?>
                <?php $selected = ''; ?>
                <?php if ($this->params->action == 'edit') $selected = $activite['Activite']['id']==$this->data['Affectation']['activite_id'] ? 'selected="selected"' :''; ?>
                    <option value="<?php echo $activite['Activite']['id']; ?>" <?php echo $selected; ?> data-subtext=" <?php echo $activite['Projet']['NOM']; ?>"><?php echo $activite['Activite']['NOM']; ?></option>
                <?php endforeach; ?>
            </select>           
    </td>
    <td>
        <label class="control-label sstitre" for="AffectationREPARTITION">Clé de répartition : </label>
    </td>
    <td>
                <?php echo $this->Form->input('REPARTITION'); ?> %        
    </td>
    </tr>
</table>        
<div class="navbar">
    <div class="navbar-inner">
        <div class="container" style="margin-top:2px;text-align:center;">                
            <?php echo $this->Form->button('Annuler', array('type'=>'button','class' => 'btn showoverlay','onclick'=>"location.href='".goPrev()."'")); ?>&nbsp;<?php echo $this->Form->button('Enregistrer', array('class' => 'btn btn-primary','type'=>'submit')); ?>                
        </div>
    </div>
</div> 
<?php $utilisateurId = $this->params->action == 'edit' ? $this->params->pass[1] : $this->params->pass[0]; ?>    
<?php echo $this->Form->input('utilisateur_id',array('type'=>'hidden','value'=>$utilisateurId)); ?>
<?php if ($this->params->action == 'edit') echo $this->Form->input('id',array('type'=>'hidden')); ?>
<?php echo $this->Form->end(); ?>
