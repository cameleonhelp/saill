<div class="marginleft-15 marginright-15">
<?php echo $this->Form->create('Puissance',array('id'=>'formValidate','class'=>'form-horizontal','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?>
    <div class="col-md-12 column">
            <div class="row clearfix">
                    <div class="col-md-6 column">
                        <div class="form-group">
                            <label class="col-md-4 required" for="PuissanceNOM">Nom : </label>
                            <div class="col-md-8">
                                <?php echo $this->Form->input('NOM',array('type'=>'text','placeholder'=>'Nom','class'=>'form-control','data-rule-required'=>'true','data-msg-required'=>"Le nom est obligatoire")); ?>
                            </div>
                        </div>  
                        <div class="form-group">
                            <label class="col-md-4" for="PuissanceDATABASE">Serveur DB : </label>
                            <div class="col-md-8">
                                <?php echo $this->Form->input('DATABASE',array('class'=>'yesno')); ?>
                                &nbsp;<label for="PuissanceDATABASE" class='labelAfter'></label>
                            </div>
                        </div>      
                        <div class="form-group">
                            <label class="col-md-4" for="PuissancePUISSANCE">Puissance : </label>      
                            <div class="col-md-8">
                                <?php echo $this->Form->input('PUISSANCE',array('type'=>'text','placeholder'=>'Puissance','class'=>'form-control')); ?>
                            </div>         
                        </div>                         
                    </div>
                    <div class="col-md-6 column">
                        <div class="form-group">
                            <label class="col-md-4 required" for="PuissanceApplicationId">Application : </label>
                            <div class="col-md-8">
                                <?php if ($this->params->action == 'edit') { ?>
                                    <?php echo $this->Form->select('application_id',$applications,array('class'=>'form-control','data-rule-required'=>'true','data-msg-required'=>"L'application est obligatoire", 'selected' => $this->data['Puissance']['application_id'],'empty' => 'Choisir une application')); ?>
                                <?php } else { ?>
                                    <?php echo $this->Form->select('application_id',$applications,array('class'=>'form-control','data-rule-required'=>'true','data-msg-required'=>"L'application est obligatoire", 'empty' => 'Choisir une application')); ?>
                                <?php } ?>        
                            </div>        
                        </div>   
                        <div class="form-group">
                            <label class="col-md-4" for="PuissanceAPPLICATION">Serveur Applicatif : </label>
                            <div class="col-md-8">
                                <?php echo $this->Form->input('APPLICATION',array('class'=>'yesno')); ?>
                                &nbsp;<label for="PuissanceAPPLICATION" class='labelAfter'></label>
                            </div>
                        </div> 
                        <div class="form-group">
                            <label class="col-md-4" for="PuissanceEntiteId">Cercle de visibilité : </label>
                            <div class="col-md-8">
                                <?php if ($this->params->action == 'edit') { ?>
                                    <?php echo $this->Form->select('entite_id',$cercles,array('class'=>'form-control','selected' => $this->data['Puissance']['entite_id'],'empty' => 'Choisir un cercle de visibilité ou visible par tous')); ?>
                                <?php } else { ?>
                                    <?php $entite_id = is_null(userAuth('entite_id')) ? '' : userAuth('entite_id'); ?>
                                    <?php echo $this->Form->select('entite_id',$cercles,array('class'=>'form-control','selected' => $entite_id, 'default' => $entite_id, 'empty' => 'Choisir un cercle de visibilité ou visible par tous')); ?>
                                <?php } ?>
                            </div>
                        </div>                           
                    </div>
            </div>
            <div class="row clearfix">
                    <div class="col-md-12 column">
                        <div class="form-group">
                            <label class="col-md-2" for="PuissanceCOMMENTAIRE">Commentaire : </label>       
                            <div class="col-md-10">
                                <?php echo $this->Form->input('COMMENTAIRE',array('class'=>'form-control')); ?>
                            </div>          
                        </div>  
                        <div class="form-group">
                          <div class="btn-block-horizontal">
                                <?php echo $this->Form->button('Annuler', array('type'=>'submit','class' => 'btn btn-sm btn-default showoverlay cancel','value'=>'cancel','div' => false, 'name' => 'cancel')); ?>&nbsp;<?php echo $this->Form->button('Enregistrer', array('class' => 'btn btn-sm btn-primary','type'=>'submit')); ?>                
                          </div>
                        </div>                          
                    </div>
            </div>
    </div>
<?php if ($this->params->action == 'edit') echo $this->Form->input('id',array('type'=>'hidden')); ?>     
<?php echo $this->Form->end(); ?>
</div>