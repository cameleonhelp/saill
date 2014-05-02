    <div class="">
        <?php echo $this->Form->create('Entite',array('id'=>'formValidate','class'=>'form-horizontal','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?>
        <div class="form-group">
            <label class="col-md-2 required" for="EntiteNOM">Nom du cercle : </label>
            <div class="col-md-10">
                <?php echo $this->Form->input('NOM',array('class'=>'form-control','placeholder'=>'Nom du cercle','data-rule-required'=>'true','data-msg-required'=>"Le nom du cercle de visibilité est obligatoire")); ?>   
            </div>
        </div>                 
        <div class="form-group">
            <label class="col-md-2" for="EntiteCOMMENTAIRE">Commentaire : </label>
            <div class="col-md-10">
                <?php echo $this->Form->input('COMMENTAIRE',array('type'=>'textarea')); ?>   
            </div>
        </div>          
    <div class="panel-group" id="panelparamters" style="margin-bottom:15px;">
        <div class="panel panel-default">
            <div class="panel-heading"><a data-toggle="collapse" data-parent="#panelparamters" href="#collapsecommentaire">Paramétrages
                    <span class="glyphicons cogwheels pull-left notchange linkcolor" style="margin-right:10px;"></span></a></div>
            <div id="collapsecommentaire" class="panel-collapse collapse">
                <div class="panel-body">
                    <div  class="tabbable">
                        <ul class="nav nav-tabs">
                          <li class="active"><a href="#mails" data-toggle="tab">Emails</a></li>
                          <?php if($this->params->action == "edit"): ?>
                          <li><a href="#templatetools" data-toggle="tab">Ouvertures de droits par défaut</a></li>
                          <li><a href="#memo" data-toggle="tab">Mémo pour facturation</a></li>
                          <?php endif; ?>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade in active" id="mails">
                                <p>
                                <div class="form-group">
                                    <label class="col-md-3" for="EntiteMAILGESTENV">Mail du gestionnaire d'environnement : </label>
                                    <div class="col-md-9">
                                        <?php echo $this->Form->input('MAILGESTENV',array('class'=>'form-control','placeholder'=>'Email du (ou des) gestionnaire(s) d\'environnement')); ?>   
                                    </div>
                                </div>  
                                <div class="form-group">
                                    <label class="col-md-3" for="EntiteCONTACT">Mail du contact pour le formulaire : </label>
                                    <div class="col-md-9">
                                        <?php echo $this->Form->input('CONTACT',array('type'=>'text','class'=>'form-control','placeholder'=>'Email de la personne à contacter')); ?>   
                                    </div>
                                </div>         
                                </p>
                            </div>
                            <?php if($this->params->action == "edit"): ?>
                            <div class="tab-pane fade" id="templatetools">
                                <div class="row clearfix">
                                        <div class="col-md-6 column">
                                            <div class="form-group" style="width:98%">
                                                <label class="col-md-3" for="EntiteTEMPLATEOUTIL">Ouverture des droits par défaut sur les outils  : </label>
                                                <div class="col-md-9">
                                                    <?php $selected = explode(',',$this->request->data['Entite']['TEMPLATEOUTILS']); ?>
                                                    <?php echo $this->Form->input('TEMPLATEOUTILS', array('multiple' => true, 'class'=>"form-control multiselect size75",'options' => $listoutil, 'selected' => $selected));  //  ,$listoutil,array('multiple'=>'true','class'=>"form-control multiselect size75", 'default' => $selected, 'hiddenField' => true)); ?>               
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 column">
                                            <div class="form-group" style="width:98%">
                                                <label class="col-md-3" for="EntiteTEMPLATEGROUPE">Ouverture des droits par défaut sur les groupes  : </label>
                                                <div class="col-md-9">
                                                    <?php $selected = explode(',',$this->request->data['Entite']['TEMPLATEGROUPE']); ?>
                                                    <?php echo $this->Form->input('TEMPLATEGROUPE', array('multiple' => true, 'class'=>"form-control multiselect size75",'options' => $listgroup, 'selected' => $selected));  //  ,$listgroup,array('multiple'=>'true','class'=>"form-control multiselect size75", 'default' => $selected,'hiddenField' => true)); ?>                               
                                                </div> 
                                            </div>
                                        </div>
                                </div>
                          </div>
                          <div class="tab-pane fade" id="memo"><?php echo $this->Form->input('MEMOFACTURATION',array('type'=>'textarea')); ?>   </div>
                          <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
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