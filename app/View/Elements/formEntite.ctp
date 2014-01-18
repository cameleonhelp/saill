    <div class="marginright20">
        <?php echo $this->Form->create('Entite',array('id'=>'formValidate','class'=>'form-horizontal','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?>
        <div class="form-group">
            <label class="col-lg-2" for="EntiteNOM">Nom du cercle : </label>
            <div class="col-lg-10">
                <?php echo $this->Form->input('NOM',array('class'=>'form-control')); ?>   
            </div>
        </div>
        <div class="form-group">
            <label class="col-lg-2" for="EntiteMAILVALIDEUR">Mail du valideur : </label>
            <div class="col-lg-10">
                <?php echo $this->Form->input('MAILVALIDEUR',array('class'=>'form-control')); ?>   
            </div>
        </div>        
        <div class="form-group">
            <label class="col-lg-2" for="EntiteMAILGESTANNUAIRE">Mail du gestionnaire d'annuaire : </label>
            <div class="col-lg-10">
                <?php echo $this->Form->input('MAILGESTANNUAIRE',array('class'=>'form-control')); ?>   
            </div>
        </div>           
        <div class="form-group">
            <label class="col-lg-2" for="EntiteMAILGESTENV">Mail du gestionnaire d'environnement : </label>
            <div class="col-lg-10">
                <?php echo $this->Form->input('MAILGESTENV',array('class'=>'form-control')); ?>   
            </div>
        </div>         
        <div class="form-group">
            <label class="col-lg-2" for="EntiteCOMMENTAIRE">Commentaire : </label>
            <div class="col-lg-10">
                <?php echo $this->Form->input('COMMENTAIRE'); ?>   
            </div>
        </div>          
    <div style="clear:both;margin-top: 10px;">
    <div class="form-group">
      <div class="btn-block-horizontal">
            <?php echo $this->Form->button('Annuler', array('type'=>'submit','class' => 'btn btn-sm btn-default showoverlay cancel','value'=>'cancel','div' => false, 'name' => 'cancel')); ?>&nbsp;<?php echo $this->Form->button('Enregistrer', array('class' => 'btn btn-sm btn-primary','type'=>'submit')); ?>                 
      </div>
    </div>  
    </div> 
    <?php echo $this->Form->end(); ?>
    </div>