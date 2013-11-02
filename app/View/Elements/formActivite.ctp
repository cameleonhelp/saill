<div class="marginright20">
<?php echo $this->Form->create('Activite',array('id'=>'formValidate','class'=>'form-horizontal','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?>
    <div class="form-group">
        <label class="col-lg-2 required" for="ActiviteProjetId">Projet : </label>
        <div class="col-lg-4">
            <?php if ($this->params->action == 'edit') { ?>
                <?php echo $this->Form->select('projet_id',$projets,array('class'=>'form-control','data-rule-required'=>'true','data-msg-required'=>"Le nom du projet est obligatoire", 'selected' => $this->data['Activite']['projet_id'],'empty' => 'Choisir un projet')); ?>
            <?php } else { ?>
                <?php echo $this->Form->select('projet_id',$projets,array('class'=>'form-control','data-rule-required'=>'true','data-msg-required'=>"Le nom du projet est obligatoire", 'empty' => 'Choisir un projet')); ?>
            <?php } ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-lg-2  required" for="ActiviteNOM">Nom : </label>
        <div class="col-lg-6">
            <?php echo $this->Form->input('NOM',array('class'=>'form-control','data-rule-required'=>'true','placeholder'=>'Nom de l\'activite','data-msg-required'=>"Le nom de l'activité est obligatoire",'error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-lg-2" for="ActiviteNUMEROGALLILIE">Réf. GALILEI : </label>
        <div class="col-lg-3">
            <div class="input-group" style="margin-left: 0px;">
            <?php echo $this->Form->input('NUMEROGALLILIE',array('class'=>'form-control activite-galilei','placeholder'=>'Numéro du projet sous GALILEI','error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
            <span class="input-group-addon addon-middle date-addon-clean btn-addon" data-target="#ActiviteNUMEROGALLILIE"><span class="glyphicons circle_remove grey"></span></span>
            </div>
        </div>
    </div>
<div class="form-group">
        <label class="col-lg-2" for="ActiviteDATEDEBUT">Début de l'activité : </label>
        <div class="col-lg-3">
            <div class="input-group" style="margin-left: 0px;">
            <?php $today = new dateTime(); ?>
            <?php echo $this->Form->input('DATEDEBUT',array('type'=>'text','placeholder'=>'ex.: '.$today->format('d/m/Y'),'class'=>"form-control dateall",'error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
            <span class="input-group-addon addon-middle date-addon-clean btn-addon" data-target="#ActiviteDATEDEBUT"><span class="glyphicons circle_remove grey"></span></span>
            <span class="input-group-addon date-addon-calendar btn-addon" data-target="#ActiviteDATEDEBUT"><span class="glyphicons calendar"></span></span>
            </div> 
        </div>        
    </div>
    <div class="form-group">
        <label class="col-lg-2" for="ActiviteDATEFIN">Fin de l'activité : </label>
        <div class="col-lg-3">
            <div class="input-group" style="margin-left: 0px;">
            <?php $today = new dateTime(); ?>
            <?php echo $this->Form->input('DATEFIN',array('type'=>'text','placeholder'=>'ex.: '.$today->format('d/m/Y'),'class'=>"form-control dateall",'error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
            <span class="input-group-addon addon-middle date-addon-clean btn-addon" data-target="#ActiviteDATEFIN"><span class="glyphicons circle_remove grey"></span></span>
            <span class="input-group-addon date-addon-calendar btn-addon" data-target="#ActiviteDATEFIN"><span class="glyphicons calendar"></span></span>
            </div> 
        </div>           
    </div>
    <div class="form-group">
        <label class="col-lg-2" for="ActiviteACTIVE">Actif : </label>
        <div class="col-lg-4">
            <?php echo $this->Form->input('ACTIVE',array('class'=>'yesno')); ?>
            &nbsp;<label for="ActiviteACTIVE" class='labelAfter'></label>
        </div>
    </div>
    <div class="form-group">
        <label class="col-lg-2" for="ActiviteDELETABLE">Supprimable : </label>
        <div class="col-lg-4">
            <?php echo $this->Form->input('DELETABLE',array('class'=>'yesno','type'=>'checkbox')); ?>
            &nbsp;<label for="ActiviteDELETABLE" class='labelAfter'></label>
        </div>
    </div>
    <?php if($this->params->action=='edit') : ?>
    <div class="form-group">
        <label class="col-lg-2" for="ActiviteBUDJETRA">Budget initial : </label>
        <div class="row">
            <div class="col-lg-2">
            <?php echo $this->Form->input('BUDJETRA',array('class'=>'form-control','placeholder'=>'Budget initial de la RA',"readonly"=>'true','error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
            </div>
            <div> k€</div>            
        </div>
    </div>
    <div class="form-group">
        <label class="col-lg-2" for="ActiviteBUDGETREVU">Dernier budget : </label>
        <div class="row">
            <div class="col-lg-2">
            <?php echo $this->Form->input('BUDGETREVU',array('class'=>'form-control','placeholder'=>'Budget revue = Budget RA à l\'initialisation',"readonly"=>'true','error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
            </div>
            <div> k€</div>            
        </div>
    </div>
    <div class="form-group">
            <label class="col-lg-2">Historique budget : </label>
            <div class="col-lg-10"><?php echo $this->element('tableHistoryBudget'); ?></div>
    </div>
    <?php else : ?>
    <div class="form-group">
    <label class="col-lg-2">Budgets : </label>
    <div class="col-lg-4"><em>Vous pouvez ajouter un nouveau budget après l'enregistrement de l'activité</em></div>
    </div>
    <?php endif; ?>
    <div class="form-group">
        <label class="col-lg-2" for="ActiviteDESCRIPTION">Commentaire : </label>
        <div class="col-lg-10">
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