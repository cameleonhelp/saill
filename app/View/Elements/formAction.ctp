<?php echo $this->Form->create('Action',array('id'=>'formValidate','class'=>'form-horizontal','inputDefaults' => array('label'=>false,'div' => false))); ?>
    <table>
        <tr>
            <td><label class="control-label sstitre required" for="ActionOBJET">Objet : </label></td>
            <td colspan='3'  style='margin-bottom: 10px;padding-bottom: 10px;'>
                <?php echo $this->Form->input('OBJET',array('type'=>'text','data-rule-required'=>'true','data-msg-required'=>"L'objet de l'action est obligatoire",'class' => 'span23')); ?>
            </td>
        </tr>
        <tr>
            <td><label class="control-label sstitre  required" for="ActionDestinataire">Responsable: </label></td>
            <td>
                <?php if ($this->params->action == 'edit') { ?>
                    <?php if (userAuth('WIDEAREA')==1): ?>
                    <?php echo $this->Form->select('destinataire',$destinataires,array('data-rule-required'=>'true','data-msg-required'=>"Le nom de l'utilisateur est obligatoire dans l'onglet Destinataire", 'selected' => $this->data['Action']['destinataire'],'empty' => 'Choisir un utilisateur')); ?>
                    <?php else : ?>
                    <?php echo $nomlong['Utilisateur']['NOMLONG']; ?>
                    <?php echo $this->Form->input('destinataire',array('type'=>'hidden','value'=>userAuth('id'))); ?>
                    <?php endif; ?>                
                <?php } else { ?>
                    <?php if (userAuth('WIDEAREA')==1): ?>
                    <?php echo $this->Form->select('destinataire',$destinataires,array('data-rule-required'=>'true','default'=>  userAuth('id'),'data-msg-required'=>"Le nom de l'utilisateur est obligatoire dans l'onglet Destinataire", 'empty' => 'Choisir un utilisateur')); ?>
                    <?php else : ?>
                    <?php echo $nomlong['Utilisateur']['NOMLONG']; ?>
                    <?php echo $this->Form->input('destinataire',array('type'=>'hidden','value'=>userAuth('id'))); ?>
                    <?php endif; ?>                
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
                <select name="data[Action][activite_id]" data-rule-required="true" data-msg-required="Le nom de l'activité est obligatoire" id="ActionActiviteId"> 
                    <option value="">Choisir une activité</option>
                    <?php foreach ($activitesagent as $activite) : ?>
                    <?php $selected = ''; ?>
                    <?php if ($this->params->action == 'edit') $selected = $activite['Activite']['id']==$this->data['Action']['activite_id'] ? 'selected="selected"' :''; ?>
                        <option value="<?php echo $activite['Activite']['id']; ?>" <?php echo $selected; ?>><?php echo $activite['Projet']['NOM']; ?> - <?php echo $activite['Activite']['NOM']; ?></option>
                    <?php endforeach; ?>
                </select>                              
            </td>            
        </tr>
        <tr>
            <td><label class="control-label sstitre" for="ActionPRIORITE">Priorité : </label></td>
            <td>
                <?php if ($this->params->action == 'edit') { ?>
                    <?php echo $this->Form->select('PRIORITE',$priorites,array('selected' => $this->data['Action']['PRIORITE'],'empty' => 'Choisir une priorité')); ?>
                <?php } else { ?>
                    <?php echo $this->Form->select('PRIORITE',$priorites,array('empty' => 'Choisir une priorité')); ?>
                <?php } ?>                
            </td>
            <td><label class="control-label sstitre" for="ActionECHEANCE">Echéance de l'Action : </label></td>
            <td>
                <div class="input-prepend date" data-date="<?php echo empty($this->data['Action']['ECHEANCE']) ? date('d/m/Y') : $this->data['Action']['ECHEANCE']; ?>" data-date-format="dd/mm/yyyy">
                <?php $today = date('d/m/Y'); ?>
                <span class="add-on"><i class="glyphicon_calendar"></i></span>
                <button class="btninput dateremove" type="button" id="remove" name="remove" rel="tooltip" data-title="Effacer la date"><i class="glyphicon_remove_only"></i></button>                
                <?php echo $this->Form->input('ECHEANCE',array('type'=>'text','placeholder'=>'ex.: '.$today,'class'=>"span5","readonly"=>'true','error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
                </div>                
            </td>            
        </tr>
        <tr>
            <td><label class="control-label sstitre" for="ActionSTATUT">Statut : </label></td>
            <td>
                <?php if ($this->params->action == 'edit') { ?>
                    <?php echo $this->Form->select('STATUT',$etats,array( 'selected' => $this->data['Action']['STATUT'],'empty' => 'Choisir un statut')); ?>
                <?php } else { ?>
                    <?php echo $this->Form->select('STATUT',$etats,array('empty' => 'Choisir un statut')); ?>
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
            <td><label class="control-label sstitre" for="ActionDEBUT">Début prévu de l'action : </label></td>
            <td>
            <div class="input-append date" data-date="<?php echo empty($this->data['Action']['DEBUT']) ? date('d/m/Y') : $this->data['Action']['DEBUT']; ?>" data-date-format="dd/mm/yyyy">
                <?php $today = date('d/m/Y'); ?>
                <?php echo $this->Form->input('DEBUT',array('type'=>'text','placeholder'=>'ex.: '.$today,'class'=>"span5","readonly"=>'true','error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
                <button class="btninput dateremove" type="button" id="remove" name="remove" rel="tooltip" data-title="Effacer la date"><i class="glyphicon_remove_only"></i></button>
                <span class="add-on"><i class="glyphicon_calendar"></i></span>
                </div>                
            </td>
            <td><label class="control-label sstitre" for="ActionDUREEPREVUE">Durée prévue : </label></td>
            <td class="form-inline">
                <?php $value = isset($this->data['Action']['DUREEPREVUE']) ? $this->data['Action']['DUREEPREVUE'] : 0; ?>
                <?php echo $this->Form->input('DUREEPREVUE',array('type'=>"number", 'min'=>"0", 'step'=>"2",'maxlength'=>'3','class' => 'span2 text-right', 'value'=>$value)); ?> heures soit : <label id="ActionLblDUREEPREVUE"></label>              
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
    <!-- ajout de la liste des livrables pouvant être associés //-->
    <?php if ($this->params->action == 'edit') : ?>
    <button type="button" class='btn btn-inverse pull-right' onclick="location.href='<?php echo $this->Html->url('/actionslivrables/add/'.$this->data['Action']['id']); ?>';">Ajouter un livrable</button>                    
    <label class="sstitre">Liste des livrables associés</label>
    <?php echo $this->element('tableLivrables'); ?>
    <?php endif; ?>
    <div class="navbar">
        <div class="navbar-inner">
            <div class="container" style="margin-top:2px;text-align:center;">
                <?php $url = $this->Session->read('history'); $index = count($url) > 1 ? 1 : 0; ?>
                <?php echo $this->Form->button('Annuler', array('type'=>'button','class' => 'btn','onclick'=>"location.href='".$this->Html->url($url[$index]['here'])."/<'")); ?>&nbsp;<?php echo $this->Form->button('Enregistrer', array('class' => 'btn btn-primary','type'=>'submit')); ?>   
                <?php if ($this->params->action == 'edit' && $nbActivite == 0) echo $this->Form->button('Enregistrer la charge consommée', array('class' => 'btn btn-inverse pull-right','type'=>'button','onclick'=>"location.href='".$this->Html->url('/activitesreelles/add/'.$utilisateurId['Action']['utilisateur_id'].'/'.$actionId)."'")); ?>
                <?php if ($this->params->action == 'edit' && $nbActivite == 1) echo $this->Form->button('Modifier la charge consommée', array('class' => 'btn btn-inverse pull-right','type'=>'button','onclick'=>"location.href='".$this->Html->url('/activitesreelles/edit/'.$activiteId['Activitesreelle']['id'])."'")); ?>
                <?php if ($this->params->action == 'edit' && $nbActivite > 1) echo $this->Form->button('Consulter les charges consommées', array('class' => 'btn btn-inverse pull-right','type'=>'button','onclick'=>"location.href='".$this->Html->url('/activitesreelles/index/tous/tous/tous/'.$actionId)."'")); ?>                
            </div>
        </div>
    </div>
<?php if ($this->params->action == 'add') echo $this->Form->input('utilisateur_id',array('type'=>'hidden','value'=>userAuth('id'))); ?> 
<?php if ($this->params->action == 'edit') echo $this->Form->input('utilisateur_id',array('type'=>'hidden','value'=>$this->data['Action']['utilisateur_id'])); ?> 
<?php if ($this->params->action == 'edit') echo $this->Form->input('id',array('type'=>'hidden')); ?>    
<?php echo $this->Form->end(); ?>   
<?php if ($this->params->action == 'edit') echo $this->element('tableHistoryAction'); ?>