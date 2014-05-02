<div class="">
<?php echo $this->Form->create('Utiliseoutil',array('id'=>'formValidate','class'=>'form-horizontal','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?>
    <div class="form-group">
        <label class="col-md-2 required" for="UtiliseoutilUtilisateurId">Utilisateur : </label>
        <div class="col-md-3">
            <?php if ($this->params->action == 'edit') { ?>
                <?php echo $this->Form->input('utilisateur_id',array('type'=>'hidden','value'=>$this->data['Utiliseoutil']['utilisateur_id'])); ?>
                <?php echo h($utiliseoutil['Utilisateur']['NOMLONG']); ?>            
            <?php } else { ?>
                <?php if (!isset($this->params->pass[0])) { 
                    echo $this->Form->select('utilisateur_id',$utilisateur,array('class'=>'form-control','data-rule-required'=>'true','data-msg-required'=>'Le nom de l\'utilisateur est obligatoire','empty' => 'Choisir un utilisateur')); ?>
                <?php } else { 
                    echo $this->Form->input('utilisateur_id',array('type'=>'hidden','value'=>$this->params->pass[0])); 
                    echo $utilisateur[$this->params->pass[0]];
                    } 
                ?>
            <?php } ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2" for="UtiliseoutilOutilId">Outil : </label>
        <div class="col-md-3">
            <?php if ($this->params->action == 'edit') { ?>
                <?php echo $this->Form->input('outil_id',array('type'=>'hidden','value'=>$this->data['Utiliseoutil']['outil_id'])); ?>
                <?php echo h($utiliseoutil['Outil']['NOM']); ?> 
            <?php } else { ?>
                <?php echo $this->Form->select('outil_id',$outil,array('class'=>'form-control','empty' => 'Choisir un outil')); ?>
            <?php } ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2" for="UtiliseoutilListediffusionId">Liste de diffusion : </label>
        <div class="col-md-3">
            <?php if ($this->params->action == 'edit') { ?>
                <?php echo $this->Form->input('listediffusion_id',array('type'=>'hidden','value'=>$this->data['Utiliseoutil']['listediffusion_id'])); ?>
                <?php echo h($utiliseoutil['Listediffusion']['NOM']); ?> 
            <?php } else { ?>
                <?php echo $this->Form->select('listediffusion_id',$listediffusion,array('class'=>'form-control','empty' => 'Choisir une liste de diffusion')); ?>
            <?php } ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2" for="UtiliseoutilDossierpartageId">Partage réseau : </label>
        <div class="col-md-3">
            <?php if ($this->params->action == 'edit') { ?>
                <?php echo $this->Form->input('dossierpartage_id',array('type'=>'hidden','value'=>$this->data['Utiliseoutil']['dossierpartage_id'])); ?>
                <?php echo h($utiliseoutil['Dossierpartage']['NOM']); ?> 
            <?php } else { ?>
                <?php echo $this->Form->select('dossierpartage_id',$dossierpartage,array('class'=>'form-control','empty' => 'Choisir un partage réseau')); ?>
            <?php } ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 required" for="UtiliseoutilSTATUT">Etat : </label>
        <div class="col-md-3">
            <?php if ($this->params->action == 'edit') { ?>
                <?php echo $this->Form->select('STATUT',$etat,array('class'=>'form-control','data-rule-required'=>'true','data-msg-required'=>'L\'état est obligatoire','selected' => $this->data['Utiliseoutil']['STATUT'],'empty' => 'Choisir un état')); ?>
            <?php } else { ?>
                <?php echo $this->Form->select('STATUT',$etat,array('class'=>'form-control','data-rule-required'=>'true','data-msg-required'=>'L\'état est obligatoire','empty' => 'Choisir un état')); ?>
            <?php } ?>
        </div>
    </div>
    <div style="clear:both;margin-top: 10px;">
    <div class="form-group">
      <div class="btn-block-horizontal">
            <?php echo $this->Form->button('Annuler', array('type'=>'submit','class' => 'btn btn-sm btn-default showoverlay cancel','value'=>'cancel','div' => false, 'name' => 'cancel')); ?>&nbsp;<?php echo $this->Form->button('Enregistrer', array('class' => 'btn btn-sm btn-primary showoverlay','type'=>'submit')); ?>                
      </div>
    </div>  
    </div>
    <div class="row">
        <div class="col-md-6 column">	
            <?php if ($this->params->action == 'edit') echo $this->Form->input('id',array('type'=>'hidden')); ?>
            <?php echo $this->Form->end(); ?>
            <?php if ($this->params->action == 'add') : ?>
            <?php echo $this->Form->create('Utiliseoutil',array('id'=>'formValidate','action'=>'add_template','class'=>'form-horizontal','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?>
                <div class="form-group">
                    <label class="col-md-4 required" for="UtiliseoutilUtilisateurId">Utilisateur : </label>
                    <div class="col-md-6">
                            <?php if (!isset($this->params->pass[0])) { 
                                echo $this->Form->select('utilisateur_id',$utilisateur,array('class'=>'form-control','data-rule-required'=>'true','data-msg-required'=>'Le nom de l\'utilisateur est obligatoire','empty' => 'Choisir un utilisateur')); ?>
                            <?php } else { 
                                echo $this->Form->input('utilisateur_id',array('type'=>'hidden','value'=>$this->params->pass[0])); 
                                echo $utilisateur[$this->params->pass[0]];
                                } 
                            ?>
                    </div>
                </div>
                <div style="clear:both;margin-top: 10px;">
                <div class="form-group">
                  <div class="btn-block-horizontal">
                        <?php echo $this->Form->button('Enregistrer les outils et partages par défaut', array('class' => 'btn btn-sm btn-default showoverlay','type'=>'submit')); ?>                
                  </div>
                </div>  
                </div>
            <?php echo $this->Form->end(); ?>
            <?php endif; ?>
        </div>
        <div class="col-md-6 column">
            <?php if ($this->params->action == 'edit') echo $this->Form->input('id',array('type'=>'hidden')); ?>
            <?php echo $this->Form->end(); ?>
            <?php if ($this->params->action == 'add') : ?>
            <?php echo $this->Form->create('Utiliseoutil',array('id'=>'formValidate','action'=>'dupliquer','class'=>'form-horizontal','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?>
                <div class="form-group">
                    <label class="col-md-4 required" for="UtiliseoutilORIGINE">Utilisateur à copier : </label>
                    <div class="col-md-6">
                            <?php echo $this->Form->select('ORIGINE',$utilisateur,array('class'=>'form-control','data-rule-required'=>'true','data-msg-required'=>'Le nom de l\'utilisateur d\'origine est obligatoire','empty' => 'Choisir un utilisateur')); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-4 required" for="UtiliseoutilUtilisateurId">Utilisateur : </label>
                    <div class="col-md-6">
                            <?php if (!isset($this->params->pass[0])) { 
                                echo $this->Form->select('utilisateur_id',$utilisateur,array('class'=>'form-control','data-rule-required'=>'true','data-msg-required'=>'Le nom de l\'utilisateur est obligatoire','empty' => 'Choisir un utilisateur')); ?>
                            <?php } else { 
                                echo $this->Form->input('utilisateur_id',array('type'=>'hidden','value'=>$this->params->pass[0])); 
                                echo $utilisateur[$this->params->pass[0]];
                                } 
                            ?>
                    </div>
                </div>            
                <div style="clear:both;margin-top: 10px;">
                <div class="form-group">
                  <div class="btn-block-horizontal">
                        <?php echo $this->Form->button('Dupliquer les droits', array('class' => 'btn btn-sm btn-default showoverlay','type'=>'submit')); ?>                
                  </div>
                </div>  
                </div>
            <?php echo $this->Form->end(); ?>
            <?php endif; ?>
	</div>
    </div>
</div>