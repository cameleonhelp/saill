<?php echo $this->Form->create('Action',array('id'=>'formValidate','class'=>'form-horizontal','inputDefaults' => array('label'=>false,'div' => false))); ?>
    <div class="control-group">
        <label class="control-label sstitre required" for="ActionOBJET">Objet : </label>
        <div class="controls">
                <?php echo $this->Form->input('OBJET',array('type'=>'text','data-rule-required'=>'true','data-msg-required'=>"L'objet de l'action est obligatoire",'class' => 'span20')); ?>
        </div>
    </div>  
    <hr>
    <table>
        <tr>
            <td><label class="control-label sstitre  required" for="ActionDestinataire">Responsable: </label></td>
            <td>
                <?php if ($this->params->action == 'edit') { ?>
                    <?php echo $this->Form->select('destinataire',$destinataires,array('data-rule-required'=>'true','data-msg-required'=>"Le nom de l'utilisateur est obligatoire dans l'onglet Destinataire", 'selected' => $this->data['Action']['destinataire'],'empty' => 'Choisir un utilisateur')); ?>
                <?php } else { ?>
                    <?php echo $this->Form->select('destinataire',$destinataires,array('data-rule-required'=>'true','data-msg-required'=>"Le nom de l'utilisateur est obligatoire dans l'onglet Destinataire", 'empty' => 'Choisir un utilisateur')); ?>
                <?php } ?>                
            </td>
            <td><label class="control-label sstitre  required" for="ActionDomaineId">Domaine : </label></td>
            <td>
                <?php if ($this->params->action == 'edit') { ?>
                    <?php echo $this->Form->select('domaine_id',$domaines,array('data-rule-required'=>'true','data-msg-required'=>"Le domaine est obligatoire dans l'onglet Destinataire", 'selected' => $this->data['Action']['domaine_id'],'empty' => 'Choisir un domaine')); ?>
                <?php } else { ?>
                    <?php echo $this->Form->select('domaine_id',$domaines,array('data-rule-required'=>'true','data-msg-required'=>"Le domaine est obligatoire dans l'onglet Destinataire", 'empty' => 'Choisir un domaine')); ?>
                <?php } ?>                
            </td>            
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td><label class="control-label sstitre  required" for="ActionActiviteId">Activité : </label></td>
            <td>
                <?php if ($this->params->action == 'edit') { ?>
                    <?php echo $this->Form->select('activite_id',$activitesagent,array('data-rule-required'=>'true','data-msg-required'=>"Le nom de l'activité est obligatoire dans l'onglet Facturation", 'selected' => $this->data['Action']['activite_id'],'empty' => 'Choisir une activité')); ?>
                <?php } else { ?>
                    <?php echo $this->Form->select('activite_id',$activitesagent,array('data-rule-required'=>'true','data-msg-required'=>"Le nom de l'activité est obligatoire dans l'onglet Facturation", 'empty' => 'Choisir une activité')); ?>
                <?php } ?>                
            </td>            
        </tr>
    </table>
    <hr>    
    <table>
        <tr>
            <td><label class="control-label sstitre  required" for="ActionPRIORITE">Priorité : </label></td>
            <td>
                <?php if ($this->params->action == 'edit') { ?>
                    <?php echo $this->Form->select('PRIORITE',$priorites,array('data-rule-required'=>'true','data-msg-required'=>"La priorité est obligatoire dans l'onglet Chronologie", 'selected' => $this->data['Action']['PRIORITE'],'empty' => 'Choisir une priorité')); ?>
                <?php } else { ?>
                    <?php echo $this->Form->select('PRIORITE',$priorites,array('data-rule-required'=>'true','data-msg-required'=>"La priorité est obligatoire dans l'onglet Chronologie",'empty' => 'Choisir une priorité')); ?>
                <?php } ?>                
            </td>
            <td><label class="control-label sstitre required" for="ActionECHEANCE">Echéance de l'Action : </label></td>
            <td>
                <div class="input-append date" data-date="<?php echo empty($this->data['Action']['ECHEANCE']) ? date('d/m/Y') : $this->data['Action']['ECHEANCE']; ?>" data-date-format="dd/mm/yyyy">
                <?php $today = date('d/m/Y'); ?>
                <?php echo $this->Form->input('ECHEANCE',array('type'=>'text','placeholder'=>'ex.: '.$today,'class'=>"span5","readonly"=>'true','data-rule-required'=>'true','data-msg-required'=>"L'échéance de l'action est obligatoire dans l'onglet Chronologie",'error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
                <button class="btninput dateremove" type="button" id="remove" name="remove" rel="tooltip" data-title="Effacer la date"><i class="glyphicon_remove_only"></i></button>
                <span class="add-on"><i class="glyphicon_calendar"></i></span>
                </div>                
            </td>            
        </tr>
        <tr>
            <td><label class="control-label sstitre  required" for="ActionSTATUT">Statut : </label></td>
            <td>
                <?php if ($this->params->action == 'edit') { ?>
                    <?php echo $this->Form->select('STATUT',$etats,array('data-rule-required'=>'true','data-msg-required'=>"Le statut est obligatoire dans l'onglet Avancement - Livrable attaché", 'selected' => $this->data['Action']['STATUT'],'empty' => 'Choisir un statut')); ?>
                <?php } else { ?>
                    <?php echo $this->Form->select('STATUT',$etats,array('data-rule-required'=>'true','data-msg-required'=>"Le statut est obligatoire dans l'onglet Avancement - Livrable attaché",'empty' => 'Choisir un statut')); ?>
                <?php } ?>                
            </td>
            <td><label class="control-label sstitre" for="ActionAVANCEMENT">Avancement : </label></td>
            <td>
                <div class="progress progress-striped progress-danger span4 clearfix" style="margin-top:5px;margin-left: 0 !important;">
                    <div id="progressbar" class="bar "></div>
                </div>&nbsp;     
                <?php if ($this->params->action == 'add') { ?> 
                    <?php echo $this->Form->input('AVANCEMENT',array('maxlength'=>'3','class' => 'span2 text-right','value'=>0)); ?> %  
                <?php } else { ?>
                    <?php echo $this->Form->input('AVANCEMENT',array('maxlength'=>'3','class' => 'span2 text-right')); ?> %
                <?php } ?>                
            </td>            
        </tr> 
        <tr>
            <td><label class="control-label sstitre required" for="ActionDEBUT">Début prévu de l'action : </label></td>
            <td>
            <div class="input-append date" data-date="<?php echo empty($this->data['Action']['DEBUT']) ? date('d/m/Y') : $this->data['Action']['DEBUT']; ?>" data-date-format="dd/mm/yyyy">
                <?php $today = date('d/m/Y'); ?>
                <?php echo $this->Form->input('DEBUT',array('type'=>'text','placeholder'=>'ex.: '.$today,'class'=>"span5","readonly"=>'true','data-rule-required'=>'true','data-msg-required'=>"La date de début de l'action est obligatoire dans l'onglet Chronologie",'error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
                <button class="btninput dateremove" type="button" id="remove" name="remove" rel="tooltip" data-title="Effacer la date"><i class="glyphicon_remove_only"></i></button>
                <span class="add-on"><i class="glyphicon_calendar"></i></span>
                </div>                
            </td>
            <td><label class="control-label sstitre required" for="ActionDUREEPREVUE">Durée prévue : </label></td>
            <td class="form-inline">
                <?php $value = isset($this->data['Action']['DUREEPREVUE']) ? $this->data['Action']['DUREEPREVUE'] : 0; ?>
                <?php echo $this->Form->input('DUREEPREVUE',array('type'=>"number", 'min'=>"0", 'step'=>"2",'maxlength'=>'3','class' => 'span2 text-right', 'value'=>$value,'data-msg-required'=>"La durée prévue de l'action est obligatoire dans l'onglet Chronologie")); ?> heures soit : <label id="ActionLblDUREEPREVUE"></label>              
            </td>            
        </tr>
        <tr>
            <td><label class="control-label sstitre" for="ActionDEBUTREELLE">Début réel de l'action : </label></td>
            <td>
                <div class="input-append date" data-date="<?php echo empty($this->data['Action']['DEBUTREELLE']) ? date('d/m/Y') : $this->data['Action']['DEBUTREELLE']; ?>" data-date-format="dd/mm/yyyy">
                <?php $today = date('d/m/Y'); ?>
                <?php echo $this->Form->input('DEBUTREELLE',array('type'=>'text','placeholder'=>'ex.: '.$today,'class'=>"span5","readonly"=>'true','error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
                <button class="btninput dateremove" type="button" id="remove" name="remove" rel="tooltip" data-title="Effacer la date"><i class="glyphicon_remove_only"></i></button>
                <span class="add-on"><i class="glyphicon_calendar"></i></span>
                </div>                
            </td>
            <td><label class="control-label sstitre" for="ActionDUREEREELLE">Durée réelle : </label></td>
            <td class="form-inline">
             <?php $value = isset($this->data['Action']['DUREEREELLE']) ? $this->data['Action']['DUREEREELLE'] : 0; ?>            
            <?php echo $this->Form->input('DUREEREELLE',array('type'=>"number", 'min'=>"0", 'step'=>"2",'maxlength'=>'3','class' => 'span2 text-right', 'value'=>$value)); ?> heures soit : <label id="ActionLblDUREEREELLE"></label>                
            </td>            
        </tr>        
    </table>
    <hr>
    <div class="control-group">
        <label class="control-label sstitre" for="ActionCOMMENTAIRE">Commentaire : </label>
        <div class="controls">
            <?php echo $this->Form->input('COMMENTAIRE'); ?>   
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
<?php echo $this->Form->input('utilisateur_id',array('type'=>'hidden','value'=>2)); ?> 
<?php if ($this->params->action == 'edit') echo $this->Form->input('id',array('type'=>'hidden')); ?>    
<?php echo $this->Form->end(); ?>