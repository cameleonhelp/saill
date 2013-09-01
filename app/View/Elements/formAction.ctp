<?php echo $this->Form->create('Action',array('id'=>'formValidate','class'=>'form-horizontal','inputDefaults' => array('label'=>false,'div' => false))); ?>
    <table>
        <tr>
            <td><label class="control-label sstitre required" for="ActionOBJET">Objet : </label></td>
            <td colspan='3'  style='margin-bottom: 10px;padding-bottom: 10px;'>
                <?php echo $this->Form->input('OBJET',array('type'=>'text','data-rule-required'=>'true','style'=>'width:100%','data-msg-required'=>"L'objet de l'action est obligatoire")); ?>
            </td>
        </tr>
        <tr>
            <td><label class="control-label sstitre  required" for="ActionDestinataire">Destinataire: </label></td>
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
                <span class="add-on"><span class="glyphicons calendar"></span></span>
                <button class="btninput dateremove" type="button" id="remove" name="remove" rel="tooltip" data-title="Effacer la date"><span class="glyphicons circle_remove grey"></span></button>                
                <?php echo $this->Form->input('ECHEANCE',array('type'=>'text','placeholder'=>'ex.: '.$today,"readonly"=>'true','error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
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
                <div class="progress progress-striped progress-danger clearfix" style="margin-top:5px;margin-left: 0px !important;margin-right: 10px !important;width:150px;float: left;">
                    <div id="progressbar" class="bar "></div>
                </div>     
                <?php if ($this->params->action == 'add') { ?> 
                    <?php echo $this->Form->input('AVANCEMENT',array('maxlength'=>'3','class' => 'text-right','style'=>'width:45px;','value'=>0,'min'=>"0", 'step'=>"10",'max'=>'100')); ?> %  
                <?php } else { ?>
                    <?php echo $this->Form->input('AVANCEMENT',array('maxlength'=>'3','style'=>'width:45px;','class' => 'text-right','min'=>"0", 'step'=>"10",'max'=>'100')); ?> %
                <?php } ?>                
            </td>            
        </tr> 
        <tr>
            <td><label class="control-label sstitre" for="ActionDEBUT">Début prévu de l'action : </label></td>
            <td>
            <div class="input-append date" data-date="<?php echo empty($this->data['Action']['DEBUT']) ? date('d/m/Y') : $this->data['Action']['DEBUT']; ?>" data-date-format="dd/mm/yyyy">
                <?php $today = date('d/m/Y'); ?>
                <?php echo $this->Form->input('DEBUT',array('type'=>'text','placeholder'=>'ex.: '.$today,"readonly"=>'true','error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
                <button class="btninput dateremove" type="button" id="remove" name="remove" rel="tooltip" data-title="Effacer la date"><span class="glyphicons circle_remove grey"></span></button>
                <span class="add-on"><span class="glyphicons calendar"></span></span>
                </div>                
            </td>
            <td><label class="control-label sstitre" for="ActionDUREEPREVUE">Durée prévue : </label></td>
            <td class="form-inline">
                <?php $value = isset($this->data['Action']['DUREEPREVUE']) ? $this->data['Action']['DUREEPREVUE'] : 0; ?>
                <?php echo $this->Form->input('DUREEPREVUE',array('type'=>"number",'style'=>'width:55px;', 'min'=>"0", 'step'=>"2",'maxlength'=>'3','class' => 'text-right', 'value'=>$value)); ?> heures soit : <label id="ActionLblDUREEPREVUE"></label>              
            </td>            
        </tr>      
    </table> 
    <div class="control-group">
        <?php echo $this->Form->input('periodicite_id', array('type'=>'hidden','value'=>isset($this->data['Action']['periodicite_id']) ? $this->data['Action']['periodicite_id'] : '')); ?>
        <label class="control-label sstitre" for="ActionREPETITIONQ">Périodicité de l'échéance : </label>
        <div class="controls  inline_labels">
             <?php
                echo $this->Form->input('FREQUENCE',array('type'=>'hidden','value'=>isset($periodicite['Periodicite']['PERIODE']) ? $periodicite['Periodicite']['PERIODE'] : '')); 
                $options = array('Q' => 'Unique', 'H' => 'Hebdomadaire', 'M' => 'Mensuelle');
                $attributes = array('legend' => false,'value'=>isset($periodicite['Periodicite']['PERIODE']) ? $periodicite['Periodicite']['PERIODE'] : '','class'=>'testradio');
                echo $this->Form->radio('REPETITION', $options, $attributes);             
             ?>
            <div class="repetitionH">
            <div class="control-group">
                <label class="control-label sstitre" for="ActionREPETITIONHWEEK">Toutes les : </label>
                <div class="controls">
                    <?php
                       echo $this->Form->input('REPETITIONHWEEK', array('maxlength'=>'2','class' => 'text-right','style'=>'width:45px;','value'=>isset($periodicite['Periodicite']['REPEATALL']) ? $periodicite['Periodicite']['REPEATALL'] : '1','min'=>"1", 'step'=>"1",'max'=>'3'));             
                    ?>&nbsp;semaine(s)
                </div>                
                <label class="control-label sstitre" for="ActionREPETITIONHDAY<?php echo date('N'); ?>">Jour : </label>
                <div class="controls">
                    <div class='clearfix'>
                    <?php 
                    $options = array('1' => 'Lundi', '2' => 'Mardi', '3' => 'Mercredi','4' => 'Jeudi', '5' => 'Vendredi', '6' => 'Samedi','7' => 'Dimanche');
                    $selected = array();
                    if (isset($periodicite['Periodicite']['LU']) && $periodicite['Periodicite']['LU']) $selected[] = 1;
                    if (isset($periodicite['Periodicite']['MA']) && $periodicite['Periodicite']['MA']) $selected[] = 2;
                    if (isset($periodicite['Periodicite']['ME']) && $periodicite['Periodicite']['ME']) $selected[] = 3;
                    if (isset($periodicite['Periodicite']['JE']) && $periodicite['Periodicite']['JE']) $selected[] = 4;
                    if (isset($periodicite['Periodicite']['VE']) && $periodicite['Periodicite']['VE']) $selected[] = 5;
                    if (isset($periodicite['Periodicite']['SA']) && $periodicite['Periodicite']['SA']) $selected[] = 6;
                    if (isset($periodicite['Periodicite']['DI']) && $periodicite['Periodicite']['DI']) $selected[] = 7;
                    echo $this->Form->select('REPETITIONHDAY', $options, array('multiple' => 'checkbox','class'=> 'checkboxes_inline','value'=> $selected));
                    ?>  
                    </div>                  
                </div>
                <label class="control-label sstitre" for="ActionREPETITIONHLAST">Fin le : </label>
                <div class="controls"> 
                    <div class="input-append date" data-date="<?php echo date('d/m/Y'); ?>" data-date-format="dd/mm/yyyy">
                       <?php $today = date('d/m/Y'); ?>
                       <?php echo $this->Form->input('REPETITIONHLAST',array('type'=>'text','placeholder'=>'ex.: '.$today,"readonly"=>'true','value'=>isset($periodicite['Periodicite']['END']) ? $periodicite['Periodicite']['END'] : '','error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
                       <button class="btninput dateremove" type="button" id="remove" name="remove" rel="tooltip" data-title="Effacer la date"><span class="glyphicons circle_remove grey"></span></button>
                       <span class="add-on"><span class="glyphicons calendar"></span></span>
                    </div>  
                </div>
            </div>
            </div>
            <div class="repetitionM">
            <div class="control-group">
                <label class="control-label sstitre" for="ActionREPETITIONMMONTH">Tous les : </label>
                <div class="controls">
                    <?php
                       echo $this->Form->input('REPETITIONMMONTH', array('maxlength'=>'2','class' => 'text-right','style'=>'width:45px;','value'=>isset($periodicite['Periodicite']['REPEATALL']) ? $periodicite['Periodicite']['REPEATALL'] : '1','min'=>"1", 'step'=>"1",'max'=>'12'));             
                    ?>&nbsp;mois
                </div>                
                <label class="control-label sstitre" for="ActionREPETITIONMDAY">Le : </label>
                <div class="controls  inline_labels">
                    <?php
                       echo $this->Form->input('REPETITIONMDAY', array('maxlength'=>'2','class' => 'text-right','style'=>'width:45px;','value'=>isset($periodicite['Periodicite']['ALLDAYMONTH']) ? $periodicite['Periodicite']['ALLDAYMONTH'] : date('d'),'min'=>"1", 'step'=>"1",'max'=>'31'));                          
                    ?>  
                </div>
                <label class="control-label sstitre" for="ActionREPETITIONMLAST">Fin le : </label>
                <div class="controls"> 
                    <div class="input-append date" data-date="<?php echo date('d/m/Y'); ?>" data-date-format="dd/mm/yyyy">
                       <?php $today = date('d/m/Y'); ?>
                       <?php echo $this->Form->input('REPETITIONMLAST',array('type'=>'text','placeholder'=>'ex.: '.$today,"readonly"=>'true','value'=>isset($periodicite['Periodicite']['END']) ? $periodicite['Periodicite']['END'] : '','error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
                       <button class="btninput dateremove" type="button" id="remove" name="remove" rel="tooltip" data-title="Effacer la date"><span class="glyphicons circle_remove grey"></span></button>
                       <span class="add-on"><span class="glyphicons calendar"></span></span>
                    </div>  
                </div>
                </div>                
            </div>
            <div class='delete'>
            <?php if(!empty($this->data['Action']['periodicite_id'])): ?>
            <?php echo $this->Html->link('<span class="glyphicons remove_2 red"></span> Supprimer la périodicité de l\'action', array('action' => 'deleteThisPeriodicite', $this->data['Action']['id']), array('class'=>'btn btn-default','escape' => false), __('Etes-vous certain de vouloir supprimer la périodicité de cette action ?')); ?>
            &nbsp;<?php echo $this->Html->link('<span class="glyphicons remove red"></span> Supprimer la périodicité de toutes les mêmes actions',  array('action' => 'deleteAllPeriodicite', $this->data['Action']['id']), array('class'=>'btn btn-default','escape' => false), __('Etes-vous certain de vouloir supprimer la périodicité de toutes les actions dépendantes ?')); ?>
            <?php endif; ?>                
            </div>
        </div>
    </div> 
    <div class="control-group">
        <?php echo $this->Form->input('RISQUE', array('type'=>'hidden','value'=>isset($this->data['Action']['RISQUE']) ? $this->data['Action']['RISQUE'] : '')); ?>
        <?php echo $this->Form->input('NIVEAU', array('type'=>'hidden','value'=>isset($this->data['Action']['NIVEAU']) ? $this->data['Action']['NIVEAU'] : '')); ?>
        <label class="control-label sstitre" for="ActionRISK">Risque : </label>
        <div class="controls"> 
            <div style="padding-bottom:15px;">
              <div style="float:left;width:130px;"><a href="#RiskModal" role="button" class="btn" data-toggle="modal">Evaluer un risque</a></div>
              <div id="squareRisque" style="float:left;padding-left:10px;width:10px;height:19px;margin-top:4px;"></div>
              <label id="commentRisque" style="float:left;padding-left:10px;margin-top:5px;"></label>  
            </div>  
            <div id="RiskModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h3>Evaluation du risque</h3>
            </div>
            <div class="modal-body">
            <table class="table table-bordered" style="margin-bottom: -7px;margin-top: -7px;">
                <tr>
                    <th colspan="2" rowspan="2"></th>
                    <th colspan="3">Gravité</th>
                </tr>
                <tr>
                    <th width="20%">Faible</th>
                    <th width="20%">Moyenne</th>
                    <th width="20%">Grave</th>
                </tr>                
                <tr>
                    <th rowspan="4">Probabilité</th>
                    <th>Très improbable</th>
                    <td style="text-align: center;background-color: #F5F5F5;"><?php echo $this->Form->radio('RISK',  array('0' => ''), array('id'=>'ActionRISK','class'=>'checkrisk','hiddenField' => false,'legend' => false,'value'=>isset($this->data['Action']['RISQUE']) && $this->data['Action']['RISQUE']=='0' ? $this->data['Action']['RISQUE'] :'' ,'data-niv'=>'0')); ?></td>
                    <td style="text-align: center;background-color: #F5F5F5;"><?php echo $this->Form->radio('RISK',  array('1' => ''), array('id'=>'ActionRISK','class'=>'checkrisk','hiddenField' => false,'legend' => false,'value'=>isset($this->data['Action']['RISQUE']) && $this->data['Action']['RISQUE']=='1' ? $this->data['Action']['RISQUE'] :'','data-niv'=>'0')); ?></td>
                    <td style="text-align: center;background-color: #F5F5F5;"><?php echo $this->Form->radio('RISK',  array('2' => ''), array('id'=>'ActionRISK','class'=>'checkrisk','hiddenField' => false,'legend' => false,'value'=>isset($this->data['Action']['RISQUE']) && $this->data['Action']['RISQUE']=='2' ? $this->data['Action']['RISQUE'] :'','data-niv'=>'0')); ?></td>
                </tr>  
                <tr>
                    <th>Improbable</th>
                    <td style="text-align: center;background-color: #CCDC00;"><?php echo $this->Form->radio('RISK',  array('3' => ''), array('id'=>'ActionRISK','class'=>'checkrisk','hiddenField' => false,'legend' => false,'value'=>isset($this->data['Action']['RISQUE']) && $this->data['Action']['RISQUE']=='3' ? $this->data['Action']['RISQUE'] :'','data-niv'=>'1')); ?></td>
                    <td style="text-align: center;background-color: #7AB800;"><?php echo $this->Form->radio('RISK',  array('4' => ''), array('id'=>'ActionRISK','class'=>'checkrisk','hiddenField' => false,'legend' => false,'value'=>isset($this->data['Action']['RISQUE']) && $this->data['Action']['RISQUE']=='4' ? $this->data['Action']['RISQUE'] :'','data-niv'=>'2')); ?></td>
                    <td style="text-align: center;background-color: #FFB612;"><?php echo $this->Form->radio('RISK',  array('5' => ''), array('id'=>'ActionRISK','class'=>'checkrisk','hiddenField' => false,'legend' => false,'value'=>isset($this->data['Action']['RISQUE']) && $this->data['Action']['RISQUE']=='5' ? $this->data['Action']['RISQUE'] :'','data-niv'=>'3')); ?></td>
                </tr>
                <tr>
                    <th>Probable</th>
                    <td style="text-align: center;background-color: #7AB800;"><?php echo $this->Form->radio('RISK',  array('6' => ''), array('id'=>'ActionRISK','class'=>'checkrisk','hiddenField' => false,'legend' => false,'value'=>isset($this->data['Action']['RISQUE']) && $this->data['Action']['RISQUE']=='6' ? $this->data['Action']['RISQUE'] :'','data-niv'=>'2')); ?></td>
                    <td style="text-align: center;background-color: #FFB612;"><?php echo $this->Form->radio('RISK',  array('7' => ''), array('id'=>'ActionRISK','class'=>'checkrisk','hiddenField' => false,'legend' => false,'value'=>isset($this->data['Action']['RISQUE']) && $this->data['Action']['RISQUE']=='7' ? $this->data['Action']['RISQUE'] :'','data-niv'=>'3')); ?></td>
                    <td style="text-align: center;background-color: #A1006B;"><?php echo $this->Form->radio('RISK',  array('8' => ''), array('id'=>'ActionRISK','class'=>'checkrisk','hiddenField' => false,'legend' => false,'value'=>isset($this->data['Action']['RISQUE']) && $this->data['Action']['RISQUE']=='8' ? $this->data['Action']['RISQUE'] :'','data-niv'=>'4')); ?></td>
                </tr>
                <tr>
                    <th>Très probable</th>
                    <td style="text-align: center;background-color: #FFB612;"><?php echo $this->Form->radio('RISK',  array('9' => ''), array('id'=>'ActionRISK','class'=>'checkrisk','hiddenField' => false,'legend' => false,'value'=>isset($this->data['Action']['RISQUE']) && $this->data['Action']['RISQUE']=='9' ? $this->data['Action']['RISQUE'] :'','data-niv'=>'3')); ?></td>
                    <td style="text-align: center;background-color: #A1006B;"><?php echo $this->Form->radio('RISK',  array('10' => ''), array('id'=>'ActionRISK','class'=>'checkrisk','hiddenField' => false,'legend' => false,'value'=>isset($this->data['Action']['RISQUE']) && $this->data['Action']['RISQUE']=='10' ? $this->data['Action']['RISQUE'] :'','data-niv'=>'4')); ?></td>
                    <td style="text-align: center;background-color: #6E267B;"><?php echo $this->Form->radio('RISK',  array('11' => ''), array('id'=>'ActionRISK','class'=>'checkrisk','hiddenField' => false,'legend' => false,'value'=>isset($this->data['Action']['RISQUE']) && $this->data['Action']['RISQUE']=='11' ? $this->data['Action']['RISQUE'] :'','data-niv'=>'5')); ?></td>
                </tr>                
            </table>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn" id="cleanRisque">Effacer</button><button type="button" class="btn" id="closeRisqueModal">Fermer</button>
            </div>
          </div>
          <div class="alert alert-info info-risque" style="margin-top:21px;margin-bottom: -7px;">Vous pouvez ajouter un commentaire ci-dessous pour justifier le risque</div>
        </div>
    </div>
    <hr>
    <div class="control-group">
        <label class="control-label sstitre" for="ActionCOMMENTAIRE">Commentaire : </label>
        <div class="controls">
            <?php echo $this->Form->input('COMMENTAIRE'); ?>   
        </div>
    </div>  
    <!-- ajout de la liste des livrables pouvant être associés //-->
    <?php if ($this->params->action == 'edit') : ?>
    <button type="button" class='btn btn-inverse pull-right showoverlay' onclick="location.href='<?php echo $this->Html->url('/actionslivrables/add/'.$this->data['Action']['id']); ?>';">Ajouter un livrable</button>                    
    <label class="sstitre">Liste des livrables associés</label>
    <?php echo $this->element('tableLivrables'); ?>
    <?php endif; ?>
    <div class="navbar">
        <div class="navbar-inner">
            <div class="container" style="margin-top:2px;text-align:center;">
                <?php echo $this->Form->button('Annuler', array('type'=>'button','class' => 'btn showoverlay','onclick'=>"location.href='".goPrev()."'")); ?>&nbsp;<?php echo $this->Form->button('Enregistrer', array('class' => 'btn btn-primary','type'=>'submit')); ?>   
                <?php //if ($this->params->action == 'edit' && $nbActivite == 0) echo $this->Form->button('Enregistrer la charge consommée', array('class' => 'btn btn-inverse pull-right showoverlay','type'=>'button','onclick'=>"location.href='".$this->Html->url('/activitesreelles/add/'.$utilisateurId['Action']['utilisateur_id'].'/'.$actionId)."'")); ?>
                <?php //if ($this->params->action == 'edit' && $nbActivite == 1) echo $this->Form->button('Modifier la charge consommée', array('class' => 'btn btn-inverse pull-right showoverlay','type'=>'button','onclick'=>"location.href='".$this->Html->url('/activitesreelles/edit/'.$activiteId['Activitesreelle']['id'])."'")); ?>
                <?php //if ($this->params->action == 'edit' && $nbActivite > 1) echo $this->Form->button('Consulter les charges consommées', array('class' => 'btn btn-inverse pull-right showoverlay','type'=>'button','onclick'=>"location.href='".$this->Html->url('/activitesreelles/index/tous/tous/tous/'.$actionId)."'")); ?>                
            </div>
        </div>
    </div>
<?php if ($this->params->action == 'add') echo $this->Form->input('utilisateur_id',array('type'=>'hidden','value'=>userAuth('id'))); ?> 
<?php if ($this->params->action == 'edit') echo $this->Form->input('utilisateur_id',array('type'=>'hidden','value'=>$this->data['Action']['utilisateur_id'])); ?> 
<?php if ($this->params->action == 'edit') echo $this->Form->input('id',array('type'=>'hidden')); ?>    
<?php echo $this->Form->end(); ?>   
<?php if ($this->params->action == 'edit') echo $this->element('tableHistoryAction'); ?>
<script>
$(document).ready(function () {
    updateViewRisque($('#ActionNIVEAU').val());
    
    if ($('#ActionNIVEAU').val() != '' || $('#ActionNIVEAU').val() > 0){
        $('.info-risque').show();
    } else {
        $('.info-risque').hide();
    }
    <?php if ($this->params->action == 'add'): ?>
        $('.repetitionH').hide();
        $('.repetitionM').hide();
        $('.delete').hide();
    <?php endif; ?>
    <?php if ($this->params->action == 'edit'): ?>
        <?php if ($this->data['Action']['FREQUENCE']=='H') : ?>
            $('.repetitionH').show();
            $('.repetitionM').hide();
        <?php endif; ?>
        <?php if ($this->data['Action']['FREQUENCE']=='M') : ?>
            $('.repetitionH').hide();
            $('.repetitionM').show();
        <?php endif; ?>
        <?php if ($this->data['Action']['FREQUENCE']=='Q' || $this->data['Action']['FREQUENCE']=='') : ?>
            $('.repetitionH').hide();
            $('.repetitionM').hide();
        <?php endif; ?>            
    <?php endif; ?>        
    $(document).on('click','#ActionREPETITIONQ',function(){
        $('.repetitionH').fadeOut();
        $('.repetitionM').fadeOut();
        $('.delete').fadeOut();
    });
    
    $(document).on('click','#ActionREPETITIONH',function(){
        $('.repetitionH').fadeIn();
        <?php if ($this->params->action == 'edit') echo "$('.delete').fadeIn();"; ?>
        $('.repetitionM').hide();
    }); 
    
    $(document).on('click','#ActionREPETITIONM',function(){
        $('.repetitionH').hide();
        $('.repetitionM').fadeIn();
        <?php if ($this->params->action == 'edit') echo "$('.delete').fadeIn();"; ?>
    }); 
    
    $(document).on('click','[for=ActionREPETITIONQ]',function(){
        $('.repetitionH').fadeOut();
        $('.repetitionM').fadeOut();
        $('.delete').fadeOut();
    });
    
    $(document).on('click','[for=ActionREPETITIONH]',function(){
        $('.repetitionH').fadeIn();
        <?php if ($this->params->action == 'edit') echo "$('.delete').fadeIn();"; ?>
        $('.repetitionM').hide();
    }); 
    
    $(document).on('click','[for=ActionREPETITIONM]',function(){
        $('.repetitionH').hide();
        $('.repetitionM').fadeIn();
        <?php if ($this->params->action == 'edit') echo "$('.delete').fadeIn();"; ?>
    });
    
    $(document).on('click','.checkrisk',function(e){
        $('#ActionRISQUE').val($(this).val());
        $('#ActionNIVEAU').val($(this).attr('data-niv'));
        //$('input:radio[class=checkrisk]').attr('checked', false);
        //$(this).attr('checked', true);
        if ($(this).attr('data-niv') > 0){
            $('.info-risque').fadeIn();
            if ($(this).attr('data-niv')==1){
                    $("#squareRisque").css("background-color","").css("background-color","#CCDC00");
                    $("#commentRisque").text('Risque évalué de niveau très faible');
            } else if ($(this).attr('data-niv')==2){
                    $("#squareRisque").css("background-color","").css("background-color","#7AB800");
                    $("#commentRisque").text('Risque évalué de niveau faible');
            }else if ($(this).attr('data-niv')==3){
                    $("#squareRisque").css("background-color","").css("background-color","#FFB612");
                    $("#commentRisque").text('Risque évalué de niveau moyen');                
            } else if ($(this).attr('data-niv')==4){
                    $("#squareRisque").css("background-color","").css("background-color","#A1006B");
                    $("#commentRisque").text('Risque évalué de niveau fort'); 
            } else if ($(this).attr('data-niv')==5){
                    $("#squareRisque").css("background-color","").css("background-color","#6E267B");
                    $("#commentRisque").text('Risque évalué de niveau très fort');      
            }              
        } else {
            $("#squareRisque").css("background-color","").css("background-color","#F5F5F5");
            $("#commentRisque").text('Risque évalué de niveau improbable');
            $('.info-risque').fadeOut();
        }
       // updateViewRisque($(this).attr('data-niv'));
        $('#RiskModal').modal('toggle');
    });
    
    $(document).on('click','#closeRisqueModal',function(e){
        $('#RiskModal').modal('toggle');
    });
    
    $(document).on('click','#cleanRisque',function(e){
        $('#ActionRISQUE').val('');
        $('#ActionNIVEAU').val('');
        $('.info-risque').fadeOut();
        $('input:radio[class=checkrisk]').attr('checked', false);
        $("#squareRisque").css("background-color","").css("background-color","none");
        $("#commentRisque").text('Risque non évalué');
        $('#RiskModal').modal('toggle');
    });
    
    function updateViewRisque(niveau){
        if (niveau==''){
                $("#squareRisque").css("background-color","").css("background-color","none");
                $("#commentRisque").text('Risque non évalué');
        } else if (niveau==0){
                $("#squareRisque").css("background-color","").css("background-color","#F5F5F5");
                $("#commentRisque").text('Risque évalué de niveau improbable');
        } else if (niveau==1){
                $("#squareRisque").css("background-color","").css("background-color","#CCDC00");
                $("#commentRisque").text('Risque évalué de niveau très faible');
        } else if (niveau==2){
                $("#squareRisque").css("background-color","").css("background-color","#7AB800");
                $("#commentRisque").text('Risque évalué de niveau faible');
        }else if (niveau==3){
                $("#squareRisque").css("background-color","").css("background-color","#FFB612");
                $("#commentRisque").text('Risque évalué de niveau moyen');                
        } else if (niveau==4){
                $("#squareRisque").css("background-color","").css("background-color","#A1006B");
                $("#commentRisque").text('Risque évalué de niveau fort'); 
        } else if (niveau==5){
                $("#squareRisque").css("background-color","").css("background-color","#6E267B");
                $("#commentRisque").text('Risque évalué de niveau très fort');      
        }                      
    };
});
</script>