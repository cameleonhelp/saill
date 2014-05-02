<div class="">
<?php echo $this->Form->create('Action',array('id'=>'formValidate','class'=>'form-horizontal','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?>
    <div class="form-group">
        <label class="col-md-2 required" for="ActionOBJET">Objet : </label>
        <div class="col-md-10">
            <?php echo $this->Form->input('OBJET',array('type'=>'text','data-rule-required'=>'true','class'=>'form-control','data-msg-required'=>"L'objet de l'action est obligatoire")); ?>
        </div>
    </div>
    <div class="block-panel-50-left">
        <div class="form-group">
            <label class="col-md-4 required" for="ActionDestinataire">Responsable: </label>
            <div  class="col-md-6">
                <?php if ($this->params->action == 'edit') { ?>
                    <?php if (userAuth('WIDEAREA')==1): ?>
                    <?php echo $this->Form->select('destinataire',$destinataires,array('data-rule-required'=>'true','class'=>'form-control','data-msg-required'=>"Le nom de l'utilisateur est obligatoire dans l'onglet Destinataire", 'selected' => $this->data['Action']['destinataire'],'empty' => 'Choisir un utilisateur')); ?>
                    <?php else : ?>
                    <?php echo $nomlong; ?>
                    <?php echo $this->Form->input('destinataire',array('type'=>'hidden','value'=>userAuth('id'))); ?>
                    <?php endif; ?>                
                <?php } else { ?>
                    <?php if (userAuth('WIDEAREA')==1): ?>
                    <?php echo $this->Form->select('destinataire',$destinataires,array('data-rule-required'=>'true','class'=>'form-control','default'=>  userAuth('id'),'data-msg-required'=>"Le nom de l'utilisateur est obligatoire dans l'onglet Destinataire", 'empty' => 'Choisir un utilisateur')); ?>
                    <?php else : ?>
                    <?php echo $nomlong; ?>
                    <?php echo $this->Form->input('destinataire',array('type'=>'hidden','value'=>userAuth('id'))); ?>
                    <?php endif; ?>                
                <?php } ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 required" for="ActionDomaineId">Domaine : </label>
            <div class="col-md-6">
                <?php if ($this->params->action == 'edit') { ?>
                    <?php echo $this->Form->select('domaine_id',$domaines,array('class'=>'form-control','data-rule-required'=>'true','data-msg-required'=>"Le domaine est obligatoire dans l'onglet Destinataire", 'selected' => $this->data['Action']['domaine_id'],'empty' => 'Choisir un domaine')); ?>
                <?php } else { ?>
                    <?php echo $this->Form->select('domaine_id',$domaines,array('class'=>'form-control','data-rule-required'=>'true','data-msg-required'=>"Le domaine est obligatoire dans l'onglet Destinataire", 'empty' => 'Choisir un domaine')); ?>
                <?php } ?>   
            </div>
        </div>          
        <div class="form-group">
            <label class="col-md-4" for="ActionDEBUT">Début de l'Action : </label>
            <div class="col-md-5">
              <div class="input-group" style="margin-left: 0px;">
              <?php $today = new dateTime(); ?>
              <?php echo $this->Form->input('DEBUT',array('type'=>'text','placeholder'=>'ex.: '.$today->format('d/m/Y'),'class'=>"form-control dateall")); ?>
              <span class="input-group-addon addon-middle date-addon-clean btn-addon" data-target="#ActionDEBUT"><span class="glyphicons circle_remove grey"></span></span>
              <span class="input-group-addon date-addon-calendar btn-addon" data-target="#ActionDEBUT"><span class="glyphicons calendar"></span></span>
              </div>
            </div>
        </div>   
        <div class="form-group">
            <label class="col-md-4" for="ActionPRIORITE">Priorité : </label>
            <div class="col-md-6">
                <?php if ($this->params->action == 'edit') { ?>
                    <?php echo $this->Form->select('PRIORITE',$priorites,array('class'=>'form-control','selected' => $this->data['Action']['PRIORITE'],'empty' => 'Choisir une priorité')); ?>
                <?php } else { ?>
                    <?php echo $this->Form->select('PRIORITE',$priorites,array('class'=>'form-control','empty' => 'Choisir une priorité')); ?>
                <?php } ?>    
            </div>
        </div>    
        <div class="form-group">
            <label class="col-md-4" for="ActionDUREEPREVUE">Durée prévue : </label>
            <div class="col-md-8 form-inline">
                <?php $value = isset($this->data['Action']['DUREEPREVUE']) ? $this->data['Action']['DUREEPREVUE'] : 0; ?>
                <?php echo $this->Form->input('DUREEPREVUE',array('type'=>"number",'style'=>'width:55px;', 'min'=>"0", 'step'=>"2",'maxlength'=>'3','class' => 'form-control text-right', 'value'=>$value)); ?> heures soit : <label id="ActionLblDUREEPREVUE"></label>              
            </div>
        </div> 
        <div class="form-group">
            <?php echo $this->Form->input('periodicite_id', array('type'=>'hidden','value'=>isset($this->data['Action']['periodicite_id']) ? $this->data['Action']['periodicite_id'] : '')); ?>
            <label class="col-md-4" for="ActionREPETITIONQ">Périodicité de l'échéance</label>
            <div class="col-md-5 inline_labels" >
                 <?php
                    echo $this->Form->input('FREQUENCE',array('type'=>'hidden','value'=>isset($this->data['Action']['FREQUENCE']) ? $this->data['Action']['FREQUENCE'] : 'Q'));
                    echo $this->Form->input('REPETITION',array('type'=>'hidden','value'=>isset($periodicite['Periodicite']['PERIODE']) ? $periodicite['Periodicite']['PERIODE'] : 'Q')); 
                 ?>
                <div class="btn-group btn-group-sm" data-toggle="buttons">
                  <label class="btn btn-default nomargin <?php echo !isset($periodicite['Periodicite']['PERIODE']) || $periodicite['Periodicite']['PERIODE']=='Q' ? 'active' : ''; ?>" for="ActionREPETITIONQ">
                    <input type="radio" name="data[Action][REPETITION1]" id="ActionREPETITIONQ"> Quotidien
                  </label>
                  <label class="btn btn-default nomargin <?php echo isset($periodicite['Periodicite']['PERIODE']) && $periodicite['Periodicite']['PERIODE']=='H' ? 'active' : ''; ?>" for="ActionREPETITIONH">
                    <input type="radio" name="data[Action][REPETITION1]"  data-toggle="modal" data-target="#HebdoModal" id="ActionREPETITIONH"> Hebdomadaire
                  </label>
                  <label class="btn btn-default nomargin <?php echo isset($periodicite['Periodicite']['PERIODE']) && $periodicite['Periodicite']['PERIODE']=='M' ? 'active' : ''; ?>" for="ActionREPETITIONM">
                    <input type="radio" name="data[Action][REPETITION1]"  data-toggle="modal" data-target="#MoisModal" id="ActionREPETITIONM"> Mensuel
                  </label>
                </div>            
                <?php echo $this->element('modals/periodicite'); ?>
                <?php if(isset($this->data['Action']['id']) && !empty($this->data['Action']['periodicite_id'])): ?>
                <div class='delete margintop15'>
                <?php echo $this->Html->link('<span class="glyphicons remove_2 red notchange"></span> Supprimer la périodicité de l\'action', array('action' => 'deleteThisPeriodicite', $this->data['Action']['id']), array('class'=>'btn btn-sm btn-default','escape' => false), __('Etes-vous certain de vouloir supprimer la périodicité de cette action ?')); ?>
                &nbsp;<?php echo $this->Html->link('<span class="glyphicons remove red notchange"></span> Supprimer la périodicité de toutes les mêmes actions',  array('action' => 'deleteAllPeriodicite', $this->data['Action']['id']), array('class'=>'btn btn-sm btn-default','escape' => false), __('Etes-vous certain de vouloir supprimer la périodicité de toutes les actions dépendantes ?')); ?>          
                </div>
                <?php endif; ?>      
            </div>
        </div>         
    </div>
    <div class="block-panel-50-right">
        <div class="form-group">
            <label class="col-md-4" for="ActionCONTRIBUTEURS">Contributeurs : </label>
            <div class="col-md-6">
                    <?php $nbcontributeurs = isset($nbcontrib) && count($nbcontrib) > 0 ? $nbcontrib : 0 ; ?>
                    <?php $contributeurs_nom = isset($nbcontrib) && count($nbcontrib) > 0 ? $contributeurs_nom : 'Aucun contributeur'; ?>
                    <?php echo $this->Html->link('<span class="glyphicons notchange group"></span>&nbsp; <span id="NBCONTRIBUTEURS" name="NBCONTRIBUTEURS">'.$nbcontributeurs.'</span>','#',array('data-toggle'=>"modal",'id'=>'btnCONTRIBUTEURS','data-target'=>"#modaladdcontributeurs","rel"=>"tooltip","data-title"=>"$contributeurs_nom",'class'=>'btn  btn-sm btn-default','escape' => false)); ?> 
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 required" for="ActionActiviteId">Activité : </label>
            <div class="col-md-6">
                <select class="form-control" name="data[Action][activite_id]" data-rule-required="true" data-msg-required="Le nom de l'activité est obligatoire" id="ActionActiviteId"> 
                    <option value="">Choisir une activité</option>
                    <?php foreach ($activitesagent as $activite) : ?>
                    <?php $selected = ''; ?>
                    <?php if ($this->params->action == 'edit') $selected = $activite['Activite']['id']==$this->data['Action']['activite_id'] ? 'selected="selected"' :''; ?>
                        <option value="<?php echo $activite['Activite']['id']; ?>" <?php echo $selected; ?>><?php echo $activite['Projet']['NOM']; ?> - <?php echo $activite['Activite']['NOM']; ?></option>
                    <?php endforeach; ?>
                </select> 
            </div>
        </div>     
        <div class="form-group">
            <label class="col-md-4" for="ActionECHEANCE">Echéance de l'Action : </label>
            <div class="col-md-5">
              <div class="input-group" style="margin-left: 0px;">
              <?php $today = new dateTime(); ?>
              <?php echo $this->Form->input('ECHEANCE',array('type'=>'text','placeholder'=>'ex.: '.$today->format('d/m/Y'),'data-rule-frdateisgreater'=>'#ActionDEBUT','data-msg-frdateisgreater'=>"L'échéance doit être postérieure à la date de début.",'class'=>"form-control dateall")); ?>
              <span class="input-group-addon addon-middle date-addon-clean btn-addon" data-target="#ActionECHEANCE"><span class="glyphicons circle_remove grey"></span></span>
              <span class="input-group-addon date-addon-calendar btn-addon" data-target="#ActionECHEANCE"><span class="glyphicons calendar"></span></span>
              </div>
            </div>
        </div>   
        <div class="form-group">
            <label class="col-md-4" for="ActionSTATUT">Statut : </label>
            <div class="col-md-6">
                <?php if ($this->params->action == 'edit') { ?>
                    <?php echo $this->Form->select('STATUT',$etats,array('class'=>'form-control','selected' => $this->data['Action']['PRIORITE'],'empty' => 'Choisir un statut')); ?>
                <?php } else { ?>
                    <?php echo $this->Form->select('STATUT',$etats,array('class'=>'form-control','empty' => 'Choisir un statut')); ?>
                <?php } ?>    
            </div>
        </div>  
        <div class="form-group">
            <label class="col-md-4" for="ActionAVANCEMENT">Avancement : </label>
            <div class="col-md-8 form-inline">
                <div class="progress progress-striped" style="margin-top:6px;margin-left: 0px !important;margin-right: 10px !important;width:150px;float: left;">
                  <div id="progressbar" class="progress-bar progress-bar-black"></div>
                </div>                
                <?php if ($this->params->action == 'add') { ?> 
                    <?php echo $this->Form->input('AVANCEMENT',array('maxlength'=>'3','class' => 'form-control text-right','style'=>'width:55px;','value'=>0,'min'=>"0", 'step'=>"10",'max'=>'100')); ?> %  
                <?php } else { ?>
                    <?php echo $this->Form->input('AVANCEMENT',array('maxlength'=>'3','style'=>'width:55px;','class' => 'form-control text-right','min'=>"0", 'step'=>"10",'max'=>'100')); ?> %
                <?php } ?>   
            </div>
        </div>  
        <div class="form-group">
            <label class="col-md-4" for="ActionCRA">CRA : </label>
            <div class="col-md-offset-4" style="margin-left:36.5%;">
                    <?php echo $this->Form->input('CRA',array('class'=>'yesno')); ?>
                    &nbsp;<label class='labelAfter' for="ActionCRA"></label> 
            </div>
        </div>         
    </div> 
    <div style="clear:both;">
    <div class="form-group">
        <?php echo $this->Form->input('RISQUE', array('type'=>'hidden','value'=>isset($this->data['Action']['RISQUE']) ? $this->data['Action']['RISQUE'] : '')); ?>
        <?php echo $this->Form->input('NIVEAU', array('type'=>'hidden','value'=>isset($this->data['Action']['NIVEAU']) ? $this->data['Action']['NIVEAU'] : '')); ?>
        <label class="col-md-2" for="ActionRISK">Risque : </label>
        <div class="col-md-10"> 
            <div style="padding-bottom:15px;">
              <div style="float:left;width:130px;">
                  <button type="button" data-toggle="modal" data-target="#RiskModal" class="btn btn-default btn-sm">Evaluer un risque</button>
              </div>
              <div id="squareRisque" style="float:left;padding-left:20px;width:10px;height:19px;margin-top:4px;"></div>
              <label id="commentRisque" style="float:left;padding-left:10px;margin-top:5px;"></label>  
            </div>  
            <!--test modal //-->
            <div class="modal fade" id="RiskModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Evaluation du risque</h4>
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
                  <button type="button" class="btn btn-sm btn-default" id="cleanRisque">Effacer</button><button type="button" class="btn btn-sm btn-default" id="closeRisqueModal">Fermer</button>
                </div>
              </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
          </div><!-- /.modal -->
          <!-- /test modal //-->                      
          <div class="bs-callout bs-callout-warning info-risque" style="width:100%;margin-top:21px;margin-bottom: -7px;">Vous pouvez ajouter un commentaire ci-dessous pour justifier le risque</div>
        </div>
    </div>
    <hr>   
    <div class="form-group">
        <label class="col-md-2" for="ActionRESUME">Résumé : </label>
        <div class="col-md-10">
            <?php echo $this->Form->input('RESUME', array('class'=>'form-control')); ?>   
        </div>
    </div>   
    <div class="panel-group" id="panelcommentaire" style="margin-bottom:15px;">
    <div class="panel panel-default">
        <?php $sapnright = $this->params["action"]=='edit' && $this->data['Action']['COMMENTAIRE']!=''? 'edit' : 'unchecked'; ?>
        <div class="panel-heading"><a data-toggle="collapse" data-parent="#panelcommentaire" href="#collapsecommentaire">Commentaire
                <span class="pull-right badge badge-default"><span class="glyphicons notchange <?php echo $sapnright; ?>"></span></span></a></div>
                <?php $in = $this->params["action"]=='edit' && $this->data['Action']['utilisateur_id'] == userAuth('id') ? ' in' : ''; ?>
                <?php $in =  $this->params["action"]=='add'  ? ' in' : $in; ?>
        <div id="collapsecommentaire" class="panel-collapse collapse<?php echo $in; ?>">
        <div class="panel-body">
          <?php echo $this->Form->input('COMMENTAIRE'); ?> 
        </div>
        </div>
    </div>
    </div>
    <?php if ($this->params->action == 'edit'): ?>
    <div class="panel-group" id="panelbilan" style="margin-bottom:15px;">
    <div class="panel panel-default">
        <div class="panel-heading"><a data-toggle="collapse" data-parent="#panelbilan" href="#collapsebilan">Bilan / Résultat : 
                <span class="pull-right badge badge-default"><span class="glyphicons notchange <?php echo $this->data['Action']['BILAN']!='' ? "edit" : "unchecked"; ?>"></span></span></a></div>
        <?php $destinataires = explode(",",$this->data['Action']['CONTRIBUTEURS']); ?>
        <?php $destinataires[] = $this->data['Action']['destinataire']; ?>
        <div id="collapsebilan" class="panel-collapse collapse<?php echo in_array(userAuth('id'),$destinataires) ? ' in' : ''; ?>">
        <div class="panel-body">
          <?php echo $this->Form->input('BILAN',array('type'=>'textarea')); ?>  
        </div>
        </div>
    </div>
    </div>      
    <?php endif; ?>
    <!-- ajout de la liste des livrables pouvant être associés //-->
    <?php if ($this->params->action == 'edit') : ?>
    <button type="button" data-toggle="modal" data-target="#modaladdlivrable" class="btn btn-default btn-sm pull-right addlivrable">Ajouter un livrable</button><br>
    <label class="sstitre">Liste des livrables associés</label>
    <?php echo $this->element('tableLivrables'); ?>
    <?php endif; ?>
    <div style="clear:both;margin-top: 10px;">
    <div class="form-group">
      <div class="btn-block-horizontal">
            <?php echo $this->Form->button('Annuler', array('type'=>'submit','class' => 'btn btn-sm btn-default showoverlay cancel','value'=>'cancel','div' => false, 'name' => 'cancel')); ?>&nbsp;<?php echo $this->Form->button('Enregistrer', array('class' => 'btn btn-sm btn-primary','type'=>'submit')); ?>                
            <?php //if ($this->params->action == 'edit' && $nbActivite == 0) echo $this->Form->button('Enregistrer la charge consommée', array('class' => 'btn btn-sm btn-default pull-right showoverlay','type'=>'button','onclick'=>"location.href='".$this->Html->url('/activitesreelles/add/'.$utilisateurId['Action']['utilisateur_id'].'/'.$actionId)."'")); ?>
            <?php //if ($this->params->action == 'edit' && $nbActivite == 1) echo $this->Form->button('Modifier la charge consommée', array('class' => 'btn btn-sm btn-default pull-right showoverlay','type'=>'button','onclick'=>"location.href='".$this->Html->url('/activitesreelles/edit/'.$activiteId['Activitesreelle']['id'])."'")); ?>
            <?php //if ($this->params->action == 'edit' && $nbActivite > 1) echo $this->Form->button('Consulter les charges consommées', array('class' => 'btn btn-sm btn-default pull-right showoverlay','type'=>'button','onclick'=>"location.href='".$this->Html->url('/activitesreelles/index/tous/tous/tous/'.$actionId)."'")); ?>                            
      </div>
    </div>  
    </div>  
    </div>
<?php if ($this->params->action == 'add') echo $this->Form->input('utilisateur_id',array('type'=>'hidden','value'=>userAuth('id'))); ?> 
<?php if ($this->params->action == 'edit') echo $this->Form->input('utilisateur_id',array('type'=>'hidden','value'=>$this->data['Action']['utilisateur_id'])); ?> 
<?php echo $this->Form->input('CONTRIBUTEURS',array('type'=>'hidden','value'=>isset($this->data['Action']['CONTRIBUTEURS']) ? $this->data['Action']['CONTRIBUTEURS'] : '')); ?> 
<?php if ($this->params->action == 'edit') echo $this->Form->input('id',array('type'=>'hidden')); ?>    
<?php echo $this->Form->end(); ?>   
<?php if ($this->params->action == 'edit') echo $this->element('tableHistoryAction'); ?>
<?php if ($this->params->action == 'edit') echo $this->element('modals/addlivrable'); ?>
<?php echo $this->element('modals/addcontributeurs'); ?>
</div>
<script>
$(document).ready(function () {
<?php if ($this->params->action == 'edit') : ?>    
    updateViewRisque($('#ActionNIVEAU').val());
    
    if ($('#ActionNIVEAU').val() != '' || $('#ActionNIVEAU').val() > 0){
        $('.info-risque').show();
    } else {
        $('.info-risque').hide();
    }
 <?php endif; ?>
     
<?php if ($this->params->action == 'add') : ?> 
    $('.info-risque').hide();
<?php endif; ?>
        
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
        $('#RiskModal').modal('hide');
    });
    
    $(document).on('click','#cleanRisque',function(e){
        $('#ActionRISQUE').val('');
        $('#ActionNIVEAU').val('');
        $('.info-risque').fadeOut();
        $('input:radio[class=checkrisk]').attr('checked', false);
        $("#squareRisque").css("background-color","").css("background-color","none");
        $("#commentRisque").text('Risque non évalué');
        $('#RiskModal').modal('hide');
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
    
    $(document).on('click','[for=ActionREPETITIONQ]',function(){
        $('#ActionREPETITION').val('Q');
    });
    
    $(document).on('click','[for=ActionREPETITIONH]',function(){
        $('#HebdoModal').modal('toggle');
    }); 
    
    $(document).on('click','[for=ActionREPETITIONM]',function(){
        $('#MoisModal').modal('toggle');
    });  
<?php if ($this->params->action == 'edit') : ?>      
    $(document).on('click','.addlivrable',function(e){
        $('#ActionslivrableActionId').val(<?php echo $this->params->pass[0]; ?>);
        $('#modaladdlivrable').modal('show');
    });   
<?php endif; ?>    
});
</script>