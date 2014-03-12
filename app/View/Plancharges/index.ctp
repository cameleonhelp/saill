<div class="plancharges index">
        <!--insert Add newplancharge modal //-->
        <div class="modal fade" id="newpcModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Ajouter un nouveau plan de charge</h4>
              </div>
              <?php echo $this->Form->create('Plancharge',array('action'=>'addnewpc','class'=>'form-horizontal','novalidate'=>true, 'style'=>'margin-bottom:-7px !important;','type' => 'file','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?>
              <div class="modal-body">
                  <div class="form-group">
                        <label for="PlanchargeANNEE" class="col-md-4 required">Année :</label>
                        <div class="col-md-4">
                            <select class="form-control" name="data[Plancharge][ANNEE]" data-rule-required="true" data-msg-required="L'année est obligatoire" id="PlanchargeANNEE">
                                <option value="">Choisir une année</option>
                                <?php $annee = new DateTime(); $annee = $annee->format('Y'); ?>
                                <?php for ($i=-0; $i<6; $i++): ?>
                                <?php $newannee = $annee+$i; ?>
                                <?php 
                                if ($this->params->action == 'edit') :
                                    $selected = ($newannee == $this->request->data['Plancharge']['ANNEE']) ? "selected='selected'" : "";
                                else:
                                    $selected = "";
                                endif;
                                ?>
                                <option value="<?php echo $newannee; ?>" <?php echo $selected; ?>><?php echo $newannee; ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>
                  </div>    
                  <div class="form-group">
                        <label class="col-md-4 required" for="PlanchargeContratId">Contrat : </label>
                        <div class="col-md-4">
                            <?php echo $this->Form->select('contrat_id',$addcontrats,array('class'=>'form-control','data-rule-required'=>'true','data-msg-required'=>"Le nom du contrat est obligatoire", 'empty' => 'Choisir un contrat')); ?>                     
                        </div>
                  </div>   
                  <div class="form-group">
                        <label class="col-md-4 required" for="PlanchargeNOM">Nom : </label>
                        <div class="col-md-7">
                            <?php echo $this->Form->input('NOM',array('class'=>'form-control','type'=>'text','placeholder'=>'Nom du plan de charge','data-rule-required'=>'true','data-msg-required'=>"Le nom du projet est obligatoire")); ?>                     
                        </div>
                  </div>  
                  <div class="form-group">
                        <label class="col-md-4 required" for="PlanchargeTJM">TJM : </label>
                        <div class="row">
                        <div class="col-md-1" style="margin-right:15px;">
                            <?php echo $this->Form->input('TJM',array('class'=>'form-control text-right','type'=>'text','style'=>"width:45px;",'placeholder'=>'TJM','data-rule-required'=>'true','data-msg-required'=>"Le TJM est obligatoire")); ?>           
                        </div>
                        <div> €/j</div> 
                        </div>
                  </div>                    
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-default" name="cancel" id="closemodal">Annuler</button>
                <?php echo $this->Form->button('Continuer', array('class' => 'btn btn-sm btn-primary pull-right showoverlay','type'=>'submit')); ?>
              </div>
              <?php echo $this->Form->end(); ?>
            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        <!-- /insert Add newplancharge modal //-->   

        <!--insert Edit newplancharge modal //-->
        <div class="modal fade" id="editpcModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Ajouter un nouveau plan de charge</h4>
              </div>
              <?php echo $this->Form->create('Plancharge',array('action'=>'edit','id'=>'formValidate','class'=>'form-horizontal','novalidate'=>true, 'style'=>'margin-bottom:-7px !important;','type' => 'file','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?>
              <div class="modal-body">
                  <div class="form-group">
                        <label for="PlanchargeANNEE" class="col-md-4 required">Année :</label>
                        <div class="col-md-4">
                            <select class="form-control" name="data[Plancharge][ANNEE]" data-rule-required="true" data-msg-required="L'année est obligatoire" id="PlanchargeANNEE">
                                <option value="">Choisir une année</option>
                                <?php $annee = new DateTime(); $annee = $annee->format('Y'); ?>
                                <?php for ($i=-0; $i<6; $i++): ?>
                                <?php $newannee = $annee+$i; ?>
                                <?php 
                                if ($this->params->action == 'edit') :
                                    $selected = ($newannee == $this->request->data['Plancharge']['ANNEE']) ? "selected='selected'" : "";
                                else:
                                    $selected = "";
                                endif;
                                ?>
                                <option value="<?php echo $newannee; ?>" <?php echo $selected; ?>><?php echo $newannee; ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>
                  </div>    
                  <div class="form-group">
                        <label class="col-md-4 required" for="PlanchargeContratId">Contrat : </label>
                        <div class="col-md-4">
                            <?php echo $this->Form->select('contrat_id',$addcontrats,array('class'=>'form-control','data-rule-required'=>'true','data-msg-required'=>"Le nom du contrat est obligatoire", 'empty' => 'Choisir un contrat')); ?>                     
                        </div>
                  </div>   
                  <div class="form-group">
                        <label class="col-md-4 required" for="PlanchargeNOM">Nom : </label>
                        <div class="col-md-7">
                            <?php echo $this->Form->input('NOM',array('class'=>'form-control','type'=>'text','placeholder'=>'Nom du plan de charge','data-rule-required'=>'true','data-msg-required'=>"Le nom du projet est obligatoire")); ?>                     
                        </div>
                  </div>  
                  <div class="form-group">
                        <label class="col-md-4 required" for="PlanchargeTJM">TJM : </label>
                        <div class="col-md-2">
                            <?php echo $this->Form->input('TJM',array('class'=>'form-control','type'=>'text','style'=>"width:45px;",'class'=>'text-right','placeholder'=>'TJM','data-rule-required'=>'true','data-msg-required'=>"Le TJM est obligatoire")); ?> €/j               
                        </div>
                  </div>                    
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-default" data-dismiss="modal" aria-hidden="true">Annuler</button>
                <?php echo $this->Form->button('Continuer', array('class' => 'btn btn-sm btn-primary pull-right showoverlay','type'=>'submit')); ?>
              </div>
              <?php echo $this->Form->end(); ?>
            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        <!-- /insert Edit newplancharge modal //--> 
        <nav class="navbar toolbar ">
                <ul class="nav navbar-nav toolbar">
                <?php 
                $filtre_visible = isset($this->params->pass[2]) ? $this->params->pass[2] : '1';
                if (userAuth('profil_id')!='2' && isAuthorized('plancharges', 'add')) : ?>
                <li><?php echo $this->Html->link('<span class="glyphicons plus size14 margintop4"></span>',  '#',array('escape' => false,'class'=>'','data-toggle'=>"modal", 'data-target'=>"#newpcModal")); ?></li>
                <li class="divider-vertical-only"></li>
                <?php endif; ?>
                <li class="dropdown <?php echo filtre_is_actif(isset($this->params->pass[0]) ? $this->params->pass[0] : 'tous','tous'); ?>">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Filtre années <b class="caret"></b></a>
                     <ul class="dropdown-menu">
                         <li><?php echo $this->Html->link('Tous', array('action' => 'index','tous',isset($this->params->pass[1]) ? $this->params->pass[1] : 'tous',$filtre_visible),array('class'=>'showoverlay'.subfiltre_is_actif(isset($this->params->pass[0]) ? $this->params->pass[0] : 'tous','tous'))); ?></li>
                         <li class="divider"></li>
                         <?php foreach ($annees as $annee) : ?>
                            <li><?php echo $this->Html->link($annee['Plancharge']['ANNEE'], array('action' => 'index',$annee['Plancharge']['ANNEE'],isset($this->params->pass[1]) ? $this->params->pass[1] : 'tous',$filtre_visible),array('class'=>'showoverlay'.subfiltre_is_actif(isset($this->params->pass[0]) ? $this->params->pass[0] : 'tous',$annee['Plancharge']['ANNEE']))); ?></li>
                         <?php endforeach; ?>
                     </ul>
                 </li>                 
                <li class="dropdown <?php echo filtre_is_actif(isset($this->params->pass[1]) ? $this->params->pass[1] : 'tous','tous'); ?>">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Filtre contrats <b class="caret"></b></a>
                     <ul class="dropdown-menu">
                         <li><?php echo $this->Html->link('Tous', array('action' => 'index',isset($this->params->pass[0]) ? $this->params->pass[0] : 'tous','tous',$filtre_visible),array('class'=>'showoverlay'.subfiltre_is_actif(isset($this->params->pass[1]) ? $this->params->pass[1] : 'tous','tous'))); ?></li>
                         <li class="divider"></li>
                         <?php foreach ($contrats as $contrat) : ?>
                            <li><?php echo $this->Html->link($contrat['Contrat']['NOM'], array('action' => 'index',isset($this->params->pass[0]) ? $this->params->pass[0] : 'tous',$contrat['Plancharge']['contrat_id'],$filtre_visible),array('class'=>'showoverlay'.subfiltre_is_actif(isset($this->params->pass[1]) ? $this->params->pass[1] : 'tous',$contrat['Plancharge']['contrat_id']))); ?></li>
                         <?php endforeach; ?>
                     </ul>
                 </li> 
                <li class="dropdown <?php echo filtre_is_actif($filtre_visible,'0'); ?>">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Filtres ... <b class="caret"></b></a>
                     <ul class="dropdown-menu">
                     <?php
                     $inserse_visible = $filtre_visible == 0 ? 1 : 0;
                     $img_visible = $filtre_visible == 1 ? "unchecked bottom2" : "check bottom2";
                     ?>
                     <li><?php echo $this->Html->link('<span class="glyphicons '.$img_visible.'"></span> Non visible inclus ', array('action' => 'index',isset($this->params->pass[0]) ? $this->params->pass[0] : 'tous',isset($this->params->pass[1]) ? $this->params->pass[1] : 'tous',$inserse_visible),array('escape' => false)); ?></li>
                      </ul>
                </li>                    
                </ul> 
        </nav>
        <?php if ($this->params['action']=='index') { ?><div class="panel-body panel-filter marginbottom15 "><strong>Filtre appliqué : </strong><em>Liste de <?php echo $fannee; ?>, <?php echo $fprojet; ?></em></div><?php } ?>        
        <div class="">
        <table cellpadding="0" cellspacing="0" class="table table-bordered table-striped table-hover">
        <thead>
	<tr>
			<th><?php echo $this->Paginator->sort('ANNEE','Année'); ?></th>
                        <th><?php echo $this->Paginator->sort('Contrat.NOM','Contrat'); ?></th>
			<th><?php echo $this->Paginator->sort('NOM','Nom du plan de charge'); ?></th>
			<th><?php echo $this->Paginator->sort('ETP','etp'); ?></th>
			<th><?php echo $this->Paginator->sort('CHARGES','Charges'); ?></th>
			<th><?php echo $this->Paginator->sort('TJM','tjm'); ?></th>
			<th><?php echo $this->Paginator->sort('VERSION','Version'); ?></th>
                        <th width="60px"><?php echo 'Visible'; ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
        <tbody>        
	<?php if (isset($plancharges)): ?>
	<?php foreach ($plancharges as $plancharge): ?>
	<tr>
		<td style='text-align:center;'><?php echo h($plancharge['Plancharge']['ANNEE']); ?>&nbsp;</td>
                <td><?php echo h($plancharge['Contrat']['NOM']); ?>&nbsp;</td>
		<td><?php echo h($plancharge['Plancharge']['NOM']); ?>&nbsp;</td>
		<td style='text-align:right;' class="etprow"><?php echo h($plancharge['Plancharge']['ETP']); ?>&nbsp;</td>
		<td style='text-align:right;' class="chargerow"><?php echo h($plancharge['Plancharge']['CHARGES']); ?>&nbsp;j</td>
		<td style='text-align:right;'><?php echo h($plancharge['Plancharge']['TJM']); ?>&nbsp;€/j</td>
		<td style='text-align:right;'><?php echo h($plancharge['Plancharge']['VERSION']); ?>&nbsp;</td>               
		<td style="text-align:center;" nowrap><?php $image = (isset($plancharge['Plancharge']['VISIBLE']) && $plancharge['Plancharge']['VISIBLE']==true) ? 'ok_2 notchange' : 'ok_2 disabled notchange' ; ?>
                    <a href="#" class="isvisible cursor" idplancharge="<?php echo $plancharge['Plancharge']['id']; ?>" ><span class="glyphicons <?php echo $image; ?>" rel="tooltip" data-title="Plan de charge visible ou non"></span></a></td>               
                <td class="actions">
                    <?php if (userAuth('profil_id')!='2' && isAuthorized('plancharges', 'view')) : ?>
                    <?php echo '<span><span rel="tooltip" data-title="Cliquez pour avoir un aperçu"><span class="glyphicons eye_open notchange" data-rel="popover" data-title="<h3>Plan de charge :</h3>" data-content="<contenttitle>Crée le: </contenttitle>'.h($plancharge['Plancharge']['created']).'<br/><contenttitle>Modifié le: </contenttitle>'.h($plancharge['Plancharge']['modified']).'" data-trigger="click" style="cursor: pointer;"></span></span></span>'; ?>&nbsp;
                    <?php endif; ?>
                    <?php if (userAuth('profil_id')!='2' && isAuthorized('plancharges', 'edit')) : ?>
                    <?php echo $this->Html->link('<span class="glyphicons retweet notchange"></span>', "#",array('escape' => false,'data-id'=>$plancharge['Plancharge']['id'])); ?>&nbsp;                    
                    <?php //echo $this->Html->link('<span class="glyphicons retweet showoverlay notchange" rel="tooltip" data-title="Créer une nouvelle version"></span>', array('action' => 'edit', $plancharge['Plancharge']['id']),array('escape' => false)); ?>&nbsp;
                    <?php endif; ?>
                    <?php if (userAuth('profil_id')!='2' && isAuthorized('plancharges', 'add')) : ?>
                    <?php echo $this->Html->link('<span class="glyphicons pencil showoverlay notchange" rel="tooltip" data-title="Modification"></span>', array('controller'=>'detailplancharges','action' => 'edit', $plancharge['Plancharge']['id']),array('escape' => false)); ?>&nbsp;
                    <?php endif; ?> 
                    <?php if (userAuth('profil_id')!='2' && isAuthorized('plancharges', 'delete')) : ?>
                    <?php echo $this->Form->postLink('<span class="glyphicons bin notchange" rel="tooltip" data-title="Suppression"></span>', array('controller'=>'plancharges','action' => 'delete', $plancharge['Plancharge']['id']),array('escape' => false), __('Etes-vous certain de vouloir supprimer ce plan de charge ?')); ?>
                    <?php endif; ?>                     
                    <?php if (userAuth('profil_id')!='2' && isAuthorized('plancharges', 'view')) : ?>
                    <?php echo $this->Html->link('<span class="ico-xls" rel="tooltip" data-title="Export Excel"></span>', array('action' => 'export_xls', $plancharge['Plancharge']['id']),array('escape' => false,'style'=>'margin-top:1px;display: inline-table;')); ?>&nbsp;
                    <?php endif; ?>                    
		</td>
	</tr>
        <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
        <tfooter>
            <tr>
                <td class="footer" colspan="3" style="text-align:right;">Total</td>
                <td class="footer" style="text-align:right;" id="totaletp">0</td>
                <td class="footer" style="text-align:right;" id="totalcharges">0</td>
                <td class="footer" colspan="4">&nbsp;</td>  
            </tr>
        </tfooter>
	</table>
        </div>
        <div class="pull-left">	<?php	echo $this->Paginator->counter('Page {:page} sur {:pages}');	?></div>
        <div class="pull-right "><?php	echo $this->Paginator->counter('Nombre total d\'éléments : {:count}');	?></div>
        <div class='text-center'>
        <ul class="pagination pagination-sm">
	<?php
                echo "<li>".$this->Paginator->first('<<', true, null, array('class' => 'disabled showoverlay','escape'=>false))."</li>";
		echo "<li>".$this->Paginator->prev('<', array(), null, array('class' => 'prev disabled showoverlay','escape'=>false))."</li>";
		echo "<li>".$this->Paginator->numbers(array('separator' => '','class'=>'showoverlay'))."</li>";
		echo "<li>".$this->Paginator->next('>', array(), null, array('class' => 'disabled showoverlay','escape'=>false))."</li>";
                echo "<li>".$this->Paginator->last('>>', true, null, array('class' => 'disabled showoverlay','escape'=>false))."</li>";
	?>
        </ul>
        </div>
</div>
<script>
    function sumOfETP() {
        var tot = 0;
        $(".etprow").each(function() {
          tot += parseFloat($(this).html());
        });
        return parseFloat(tot).toFixed(2);
     }
    function sumOfCharges() {
        var tot = 0;
        $(".chargerow").each(function() {
          tot += parseFloat($(this).html());
        });
        return tot+" j";
     }     
$(document).ready(function () {
        $("#totaletp").html(sumOfETP());
        $("#totalcharges").html(sumOfCharges());
        
    $(document).on('click','.isvisible',function(e){
        var id = $(this).attr('idplancharge');
        $.ajax({
            dataType: "html",
            type: "POST",
            url: "<?php echo $this->Html->url(array('controller'=>'plancharges','action'=>'isvisible')); ?>/"+id
        }).done(function ( data ) {
            location.reload();
        });
    }); 
    
    $(document).on('change','#PlanchargeANNEE',function(e){
        e.preventDefault;
        <?php if ($this->params->action == "add") : ?>
        $('#PlanchargeNOM').val($('#PlanchargeANNEE').val()+"-"+$('#PlanchargeContratId option:selected').text());
        <?php else : ?>
        $('#PlanchargeNOM').val($('#PlanchargeANNEE').val()+"-"+$('#PlanchargeContratNOM').val());
        <?php endif; ?>
    }); 
    
    $(document).on('change','#PlanchargeContratId',function(e){
        e.preventDefault;
        $('#PlanchargeNOM').val($('#PlanchargeANNEE').val()+"-"+$('#PlanchargeContratId option:selected').text());
    }); 
    
    $(document).on('click','.retweet',function(e){
        var id = $(this).parent('a').attr('data-id');
        $.ajax({
            type: "POST",       
            url: "<?php echo $this->Html->url(array('controller'=>'plancharges','action'=>'json_get_info')); ?>/" + id,
            contentType: "application/json",
            success : function(response) {
                var json = $.parseJSON(response);
                $('.form-horizontal').append("<input type='hidden' name='data[Plancharge][id]' id='PlanchargeId' value='"+json[0]['Plancharge']['id']+"'>");
                $('#closemodal').attr('type', "submit");
                $('#PlanchargeContratId').val(json[0]['Plancharge']['contrat_id']);
                $('#PlanchargeANNEE').val(json[0]['Plancharge']['ANNEE']);
                $('#PlanchargeNOM').val(json[0]['Plancharge']['NOM']);
                $('#PlanchargeTJM').val(json[0]['Plancharge']['TJM']);
                $('.modal-title').html('Duplication du plan de charges');
                $('.form-horizontal').attr('action', "<?php echo $this->Html->url(array('controller'=>'plancharges','action'=>'edit')); ?>");
                $('#newpcModal').modal('show');
            },
            error :function(response,status,errorThrown) {
                alert("Erreur! il se peut que votre session soit expirée\n\rActualiser la page et recommencer.");
            }
         });
    });  
    
   $(document).on('click','#closemodal',function(e){
        $('#newpcModal').modal('toggle');
    });     
});
</script>