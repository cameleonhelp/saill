<?php echo $this->Form->create('Achat',array('id'=>'formValidate','class'=>'form-horizontal','inputDefaults' => array('label'=>false,'div' => false))); ?>
    <div class="control-group">
        <label class="control-label sstitre  required" for="AchatActiviteId">Activité : </label>
        <div class="controls">
            <select name="data[Achat][activite_id]" data-rule-required="true" data-msg-required="Le nom de l'activité est obligatoire" id="AchatActiviteId"> 
                <option value="">Choisir une activité</option>
                <?php foreach ($activites as $activite) : ?>
                <?php $selected = ''; ?>
                <?php if ($this->params->action == 'edit') $selected = $activite['Activite']['id']==$this->data['Achat']['activite_id'] ? 'selected="selected"' :''; ?>
                    <option value="<?php echo $activite['Activite']['id']; ?>" <?php echo $selected; ?> data-subtext=" <?php echo $activite['Projet']['NOM']; ?>"><?php echo $activite['Activite']['NOM']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label sstitre  required" for="AchatLIBELLEACHAT">Nom : </label>
        <div class="controls">
            <?php echo $this->Form->input('LIBELLEACHAT',array('data-rule-required'=>'true','placeholder'=>'Nom de l\'achat','class'=>'span8','data-msg-required'=>"Le nom de l'achat est obligatoire",'error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label sstitre required" for="AchatDATE">Date de l'achat : </label>
        <div class="controls">
            <div class="input-append date" data-date="<?php echo empty($this->data['Achat']['DATE']) ? date('d/m/Y') : $this->data['Achat']['DATE']; ?>" data-date-format="dd/mm/yyyy">
            <?php $today = date('d/m/Y'); ?>
            <?php echo $this->Form->input('DATE',array('type'=>'text','placeholder'=>'ex.: '.$today,'class'=>"span5","readonly"=>'true','data-rule-required'=>'true','data-msg-required'=>"La date d'achat est obligatoire",'error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
            <button class="btninput dateremove" type="button" id="remove" name="remove" rel="tooltip" data-title="Effacer la date"><i class="glyphicon_remove_only"></i></button>
            <span class="add-on"><i class="glyphicon_calendar"></i></span>
            </div>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label sstitre required" for="AchatMONTANT">Montant : </label>
        <div class="controls">
            <?php echo $this->Form->input('MONTANT',array('placeholder'=>'Montant de l\'achat','class'=>'span8','data-rule-required'=>'true','data-msg-required'=>"Le montant de l'achat est obligatoire",'error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?> €
        </div>
    </div>
    <div class="control-group">
        <label class="control-label sstitre" for="achatDESCRIPTION">Commentaire : </label>
        <div class="controls">
            <?php echo $this->Form->input('DESCRIPTION',array('type'=>'textarea')); ?>
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