<div class="">
<?php echo $this->Form->create('Achat',array('id'=>'formValidate','class'=>'form-horizontal','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?>
    <div class="form-group">
        <label class="col-md-2 required" for="AchatActiviteId">Activité : </label>
        <div class="col-md-3">
            <select name="data[Achat][activite_id]" class="form-control" data-rule-required="true" data-msg-required="Le nom de l'activité est obligatoire" id="AchatActiviteId"> 
                <option value="">Choisir une activité</option>
                <?php foreach ($activites as $activite) : ?>
                <?php $selected = ''; ?>
                <?php if ($this->params->action == 'edit') $selected = $activite['Activite']['id']==$this->data['Achat']['activite_id'] ? 'selected="selected"' :''; ?>
                <option value="<?php echo $activite['Activite']['id']; ?>" <?php echo $selected; ?>>[<?php echo $activite['Projet']['NOM']; ?>] <?php echo $activite['Activite']['NOM']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 required" for="AchatLIBELLEACHAT">Nom : </label>
        <div class="col-md-10">
            <?php echo $this->Form->input('LIBELLEACHAT',array('class'=>'form-control','data-rule-required'=>'true','placeholder'=>'Nom de l\'achat','data-msg-required'=>"Le nom de l'achat est obligatoire",'error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 required" for="AchatDATE">Date de l'achat : </label>
        <div class="col-md-2">
            <div class="input-group" style="margin-left: 0px;">
            <?php $today = new dateTime(); ?>
            <?php echo $this->Form->input('DATE',array('type'=>'text','placeholder'=>'ex.: '.$today->format('d/m/Y'),'class'=>"form-control dateall",'error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
            <span class="input-group-addon addon-middle date-addon-clean btn-addon" data-target="#AchatDATE"><span class="glyphicons circle_remove grey"></span></span>
            <span class="input-group-addon date-addon-calendar btn-addon" data-target="#AchatDATE"><span class="glyphicons calendar"></span></span>
            </div>             
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 required" for="AchatMONTANT">Montant : </label>
        <div class='row'>        
        <div class="col-md-3">
            <?php echo $this->Form->input('MONTANT',array('class'=>'form-control','placeholder'=>'Montant de l\'achat','data-rule-required'=>'true','data-msg-required'=>"Le montant de l'achat est obligatoire",'error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
        </div>
        <div> €</div>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2" for="achatDESCRIPTION">Commentaire : </label>
        <div class="col-md-10">
            <?php echo $this->Form->input('DESCRIPTION',array('type'=>'textarea')); ?>
        </div>
    </div>
    <div style="clear:both;margin-top: 10px;">
    <div class="form-group">
      <div class="btn-block-horizontal">
            <?php echo $this->Form->button('Annuler', array('type'=>'submit','class' => 'btn btn-sm btn-default showoverlay cancel','value'=>'cancel','div' => false, 'name' => 'cancel')); ?>&nbsp;<?php echo $this->Form->button('Enregistrer', array('class' => 'btn btn-sm btn-primary','type'=>'submit')); ?>                
      </div>
    </div>  
    </div>
<?php if ($this->params->action == 'edit') echo $this->Form->input('id',array('type'=>'hidden')); ?>    
<?php echo $this->Form->end(); ?>
</div>