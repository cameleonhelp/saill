<div class="expressionbesoins index">
        <?php //filtres par défaut
        $pass0 = isset($this->params->pass[0]) ? $this->params->pass[0] : 'tous';
        $pass1 = isset($this->params->pass[1]) ? $this->params->pass[1] : 'actif';//actif:'tous';
        $pass2 = isset($this->params->pass[2]) ? $this->params->pass[2] : 'tous';
        $pass3 = isset($this->params->pass[3]) ? $this->params->pass[3] : 'tous';
        $pass4 = isset($this->params->pass[4]) ? $this->params->pass[4] : 'tous';
        $pass5 = isset($this->params->pass[5]) ? $this->params->pass[5] : 'tous';        
        ?>     
        <nav class="navbar toolbar marginright20">
                <ul class="nav navbar-nav toolbar">
                <?php if (userAuth('profil_id')!='2' && isAuthorized('expressionbesoins', 'add')) : ?>
                <li><?php echo $this->Html->link('<span class="glyphicons plus size14 margintop4"></span>', array('action' => 'add'),array('escape' => false)); ?></li>
                <?php endif; ?>
                <li class="divider-vertical-only"></li>
                <!-- filtres -->
                <li class="dropdown <?php echo filtre_is_actif($pass0,'tous'); ?>">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Filtre Applications <b class="caret"></b></a>
                     <ul class="dropdown-menu">
                     <li><?php echo $this->Html->link('Toutes', array('action' => 'index','tous',$pass1,$pass2,$pass3),array('escape' => false,'class'=>'showoverlay'.subfiltre_is_actif($pass0,'tous'))); ?></li>
                     <li class="divider"></li>
                         <?php foreach ($applications as $application): ?>
                            <li><?php echo $this->Html->link($application['Application']['NOM'], array('action' => 'index',$application['Application']['id'],$pass1,$pass2,$pass3),array('escape' => false,'class'=>'showoverlay'.subfiltre_is_actif($pass0,$application['Application']['id']))); ?></li>
                         <?php endforeach; ?>
                      </ul>
                 </li>
                <li class="dropdown <?php echo filtre_is_actif($pass1,'tous'); ?>">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Filtre Etats <b class="caret"></b></a>
                     <ul class="dropdown-menu">
                     <li><?php echo $this->Html->link('Tous', array('action' => 'index',$pass0,'tous',$pass2,$pass3),array('escape' => false,'class'=>'showoverlay'.subfiltre_is_actif($pass1,'tous'))); ?></li>
                     <li><?php echo $this->Html->link('Tous sauf invalidé, désactivé', array('action' => 'index',$pass0,'actif',$pass2,$pass3),array('escape' => false,'class'=>'showoverlay'.subfiltre_is_actif($pass1,'actif'))); ?></li>
                     <li class="divider"></li>
                         <?php foreach ($etats as $etat): ?>
                            <li><?php echo $this->Html->link($etat['Etat']['NOM'], array('action' => 'index',$pass0,$etat['Etat']['id'],$pass2,$pass3),array('escape' => false,'class'=>'showoverlay'.subfiltre_is_actif($pass1,$etat['Etat']['id']))); ?></li>
                         <?php endforeach; ?>
                      </ul>
                 </li>
                <li class="dropdown <?php echo filtre_is_actif($pass2,'tous'); ?>">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Filtre Env. <b class="caret"></b></a>
                     <ul class="dropdown-menu">
                     <li><?php echo $this->Html->link('Tous', array('action' => 'index',$pass0,$pass1,'tous',$pass3),array('escape' => false,'class'=>'showoverlay'.subfiltre_is_actif($pass2,'tous'))); ?></li>
                     <li class="divider"></li>
                         <?php foreach ($types as $type): ?>
                            <li><?php echo $this->Html->link($type['Type']['NOM'], array('action' => 'index',$pass0,$pass1,$type['Type']['id'],$pass3),array('escape' => false,'class'=>'showoverlay'.subfiltre_is_actif($pass2,$type['Type']['id']))); ?></li>
                         <?php endforeach; ?>
                      </ul>
                 </li>
                <li class="dropdown <?php echo filtre_is_actif($pass3,'tous'); ?>">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Filtre périmètre <b class="caret"></b></a>
                     <ul class="dropdown-menu">
                     <li><?php echo $this->Html->link('Tous', array('action' => 'index',$pass0,$pass1,$pass2,'tous'),array('escape' => false,'class'=>'showoverlay'.subfiltre_is_actif($pass3,'tous'))); ?></li>
                     <li class="divider"></li>
                         <?php foreach ($perimetres as $perimetre): ?>
                            <li><?php echo $this->Html->link($perimetre['Perimetre']['NOM'], array('action' => 'index',$pass0,$pass1,$pass2,$perimetre['Perimetre']['id']),array('escape' => false,'class'=>'showoverlay'.subfiltre_is_actif($pass3,$perimetre['Perimetre']['id']))); ?></li>
                         <?php endforeach; ?>
                      </ul>
                 </li>                 
                <li class="divider-vertical-only"></li>
                <!-- Actions groupées -->  
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicons check"></span> Actions groupées <b class="caret"></b></a>
                     <ul class="dropdown-menu">
                     <li><?php echo $this->Html->link('Supprimer', "#",array('id'=>'deletelink','class'=>'showoverlay')); ?></li>
                     <!--<li><?php echo $this->Html->link('Livrer', "#",array('id'=>'livrelink')); ?></li>
                     <li><?php echo $this->Html->link('Terminer', "#",array('id'=>'closelink')); ?></li>-->
                     </ul>
                </li>                    
                <li class="divider-vertical-only"></li>
                <!-- Export -->
                <li>
                    <?php echo $this->Html->link('<span class="ico-xls" rel="tooltip" data-container="body" data-title="Export Excel"></span>', array('action' => 'export_xls'),array('class'=>"md",'escape' => false)); ?>
                </li>
                <li>
                    <?php echo $this->Html->link('<span class="ico-csv importcsv" rel="tooltip" data-container="body" data-title="Import CSV"></span>', "#",array('class'=>"md",'escape' => false,'data-toggle'=>"modal", 'data-target'=>"#csvModal")); ?>
                </li>                 
                </ul> 
                <?php echo $this->Form->create("Expressionbesoin",array('action' => 'search', 'class'=>'toolbar-form pull-right','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?>
                    <?php echo $this->Form->input('SEARCH',array('placeholder'=>'Recherche ...','style'=>"width: 180px;",'class'=>"form-control")); ?>
                    <button type="submit" class="btn form-btn showoverlay">Rechercher</button>
                <?php echo $this->Form->end(); ?> 
        </nav>
            <?php if ($this->params['action']=='index') { ?><div class="panel-body panel-filter marginbottom15 marginright20">
                <?php $sort = isset($this->params->paging['Expressionbesoin']['options']['sort']) && $this->params->paging['Expressionbesoin']['options']['sort']== 'modified' ? true : false; ?>
                <?php $arrow = $sort ? isset($this->params->paging['Expressionbesoin']['options']['direction']) && $this->params->paging['Expressionbesoin']['options']['direction']== 'asc' ? 'up_arrow' : 'down_arrow' : "blank"; ?>
                <strong>Filtre appliqué : </strong><em>Liste des expressions de besoins <?php echo $strfilter; ?></em><span class="pull-right"><?php echo $this->Paginator->sort('modified','<span class="glyphicons '.$arrow.' showoverlay notchange"></span><span class="glyphicons calendar showoverlay notchange"></span>',array('escape' => false)); ?></div><?php } ?>     
        <div class="marginright10">
	<table cellpadding="0" cellspacing="0" class="table table-bordered table-striped table-hover">
	<tr>
            <th style="text-align:center;width:15px !important;vertical-align: middle;padding-left:5px;"><?php echo $this->Form->input('checkall',array('type'=>'checkbox','label'=>false)) ; ?>
                    <?php echo $this->Form->input('all_ids',array('type'=>'hidden')) ; ?>
            </th>  
            <th><?php echo $this->Paginator->sort('Application.NOM','Application'); ?></th>
            <th><?php echo $this->Paginator->sort('Composant.NOM','Composant'); ?></th>
            <th><?php echo $this->Paginator->sort('Perimetre.NOM','Périmètre'); ?></th>
            <th><?php echo $this->Paginator->sort('Type.NOM','Type d\'environnement'); ?></th>
            <th><?php echo $this->Paginator->sort('NOMINTERNE','Type Env. DSIT'); ?></th>
            <th><?php echo $this->Paginator->sort('Phase.NOM','Phase'); ?></th>
            <th><?php echo $this->Paginator->sort('USAGE','Usage'); ?></th>
            <th><?php echo $this->Paginator->sort('NOMUSAGE','Nom d\'usage'); ?></th>
            <th><?php echo $this->Paginator->sort('Lot.NOM','Lot'); ?></th>
            <th><?php echo $this->Paginator->sort('Etat.NOM','Etat'); ?></th>
            <th><?php echo $this->Paginator->sort('DATELIVRAISON','Date de livraison'); ?></th>
            <th><?php echo $this->Paginator->sort('DATEFIN','Date de fin'); ?></th>
            <th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($expressionbesoins as $expressionbesoin): ?>
	<tr>
            <td style="text-align:center;padding-left:5px;padding-right:5px;">
                <?php echo $this->Form->input('id',array('type'=>'checkbox','label'=>false,'class'=>'idselect','value'=>$expressionbesoin['Expressionbesoin']['id'])) ; ?>
            </td>              
		<td>
			<?php echo $expressionbesoin['Application']['NOM']; ?>
		</td>
		<td>
			<?php echo $expressionbesoin['Composant']['NOM']; ?>
		</td>                
		<td>
			<?php echo $expressionbesoin['Perimetre']['NOM']; ?>
		</td>
		<td>
			<?php echo $expressionbesoin['Type']['NOM']; ?>
		</td>
		<td>
			<?php echo $expressionbesoin['Expressionbesoin']['ENVIRONNEMENT']; ?>
		</td>                
		<td>
			<?php echo $expressionbesoin['Phase']['NOM']; ?>
		</td>
		<td><?php echo h($expressionbesoin['Expressionbesoin']['USAGE']); ?>&nbsp;</td> <!-- pourquoi pas usage_id -->
		<td><?php echo h($expressionbesoin['Expressionbesoin']['NOMUSAGE']); ?>&nbsp;</td>                
		<td style="text-align: center">
			<?php echo $expressionbesoin['Lot']['NOM']; ?>
		</td>
		<td>
			<?php echo $expressionbesoin['Etat']['NOM']; ?>
		</td>
                <td style="text-align: center"><?php echo h($expressionbesoin['Expressionbesoin']['DATELIVRAISON']); ?>&nbsp;</td>
		<td style="text-align: center"><?php echo h($expressionbesoin['Expressionbesoin']['DATEFIN']); ?>&nbsp;</td>
		<td class="actions">
                <?php if (userAuth('profil_id')!='2' && isAuthorized('expressionbesoins', 'view')) : ?>
                <?php $connect = (isset($expressionbesoin['Expressionbesoin']['CONNECT']) && $expressionbesoin['Expressionbesoin']['CONNECT']==true) ? 'Oui' : 'Non' ; ?>
                <?php echo '<span class="glyphicons eye_open" data-rel="popover" data-title="<h3>Expression du besoin :</h3>" '
                . 'data-content="'
                        . '<contenttitle>Volumétrie: </contenttitle>'.h($expressionbesoin['Volumetrie']['NOM']).'<br/><contenttitle>'
                        . '<contenttitle>Puissance: </contenttitle>'.h($expressionbesoin['Puissance']['NOM']).'<br/><contenttitle>'
                        . '<contenttitle>Architecture: </contenttitle>'.h($expressionbesoin['Architecture']['NOM']).'<br/><contenttitle>'
                        . '<contenttitle>PVU: </contenttitle>'.h($expressionbesoin['Expressionbesoin']['PVU']).'<br/><contenttitle>'
                        . '<contenttitle>Connecté: </contenttitle>'.$connect.'<br/><contenttitle>'
                        . '<contenttitle>Crée le: </contenttitle>'.h($expressionbesoin['Expressionbesoin']['created']).'<br/><contenttitle>Modifié le: </contenttitle>'.h($expressionbesoin['Expressionbesoin']['modified']).'" data-trigger="click" style="cursor: pointer;"></span>'; ?>&nbsp;
                <?php endif; ?>
                <?php if (userAuth('profil_id')!='2' && isAuthorized('expressionbesoins', 'edit')) : ?>
                <?php echo $this->Html->link('<span class="glyphicons pencil showoverlay notchange"></span>', array('action' => 'edit', $expressionbesoin['Expressionbesoin']['id']),array('escape' => false)); ?>&nbsp;
                <?php endif; ?>
                <?php if (userAuth('profil_id')!='2' && isAuthorized('expressionbesoins', 'delete')) : ?>
                <?php $actif = $expressionbesoin['Expressionbesoin']['ACTIF']==true ? '' : ' grey'; ?>
                <?php $action = $expressionbesoin['Expressionbesoin']['ACTIF']==true ? 'supprimer' : 'activer'; ?>                  
                <?php echo $this->Form->postLink('<span class="glyphicons bin notchange'.$actif.'"></span>', array('action' => 'delete', $expressionbesoin['Expressionbesoin']['id']),array('escape' => false), __('Etes-vous certain de vouloir '.$action.' cette expression du besoin ?')); ?>                    
                <?php endif; ?>  
                <?php if (userAuth('profil_id')!='2' && isAuthorized('expressionbesoins', 'duplicate')) : ?>
                <?php echo $this->Form->postLink('<span class="glyphicons retweet showoverlay notchange"></span>', array('action' => 'dupliquer', $expressionbesoin['Expressionbesoin']['id']),array('escape' => false), __('Etes-vous certain de vouloir dupliquer cette expression du besoin ?')); ?>
                <?php endif; ?>                 
            </td>
	</tr>
<?php endforeach; ?>
	</table>
        </div>
	<div class="pull-left"><?php echo $this->Paginator->counter('Page {:page} sur {:pages}'); ?></div>
	<div class="pull-right marginright20"><?php echo $this->Paginator->counter('Nombre total d\'éléments : {:count}'); ?></div>   
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
        <!--insert ICS modal //-->
        <div class="modal fade" id="csvModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Importation de fichier CSV</h4>
              </div>
              <?php echo $this->Form->create('Expressionbesoin',array('action'=>'importCSV','id'=>'formValidate','class'=>'form-horizontal', 'style'=>'margin-bottom:-7px !important;','type' => 'file','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?>
              <div class="modal-body">
                  <div class="form-group">
                        <label for="ExpressionbesoinFile" class="col-lg-4 control-label">Fichiers CSV à intégrer</label>
                        <div class="col-lg-offset-4">
                          <?php echo $this->Form->input('file', array('type' => 'file','size'=>"40")); ?><label for="FilesharedFile" class="pull-left margintop7 italic"><?php echo 'taille max de '.ini_get('upload_max_filesize'); ?></label>
                        </div>
                  </div>
                  <div class="form-group">
                        <div class="col-lg-offset-4">
                          <?php $csvfile = '../files/csv/expressionbesoins.csv'; ?>
                          <?php echo $this->Html->link('Modèle de fichier CSV',$csvfile,array('target'=>'blank')); ?>
                        </div>
                  </div>                  
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-default" data-dismiss="modal" aria-hidden="true">Annuler</button>
                <?php echo $this->Form->button('Intégrer', array('class' => 'btn btn-sm btn-primary pull-right showoverlay','type'=>'submit')); ?>
              </div>
              <?php echo $this->Form->end(); ?>
            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        <!-- /insert ICS modal //-->   
<script>
$(document).ready(function () {
    $(document).on('click','#checkall',function(e){
        $(this).parents().find(':checkbox').prop('checked', this.checked);
        if ($(this).is(':checked')){
            $(".idselect").each(
                    function() {
                        if ($("#all_ids").val()==""){
                            $("#all_ids").val($(this).val());                    
                        }else{
                            $("#all_ids").val($("#all_ids").val()+"-"+$(this).val());
                        }
                    });          
        }else{
            $("#all_ids").val("");
        }
    });

    $(document).on('click','.idselect',function(e){
        if ($(this).is(':checked')){
            if ($("#all_ids").val()==""){
                $("#all_ids").val($(this).val());                    
            }else{
                $("#all_ids").val($("#all_ids").val()+"-"+$(this).val());
            }
        } else {
            var list = $("#all_ids").val();
            $("#all_ids").val("");
            tmp = list.replace($(this).val()+"-", "");
            if (tmp == list) tmp = list.replace("-"+$(this).val(), ""); 
            $("#all_ids").val(tmp);
        }
    });  
     
    $(document).on('click','#deletelink',function(e){
        if(confirm("Voulez-vous supprimer toutes les expressions de besoin sélectionnées ?")){
            var ids = $("#all_ids").val();
            var overlay = $('#overlay');
            overlay.show(); 
            $.ajax({
                dataType: "html",
                type: "POST",
                url: "<?php echo $this->Html->url(array('controller'=>'expressionbesoins','action'=>'deleteall')); ?>/", //+myarr[i],
                data: ({id:ids})     
            });
        }
        location.reload();
        overlay.hide();   
        $(this).parents().find(':checkbox').prop('checked', false); 
        $("#all_ids").val('');
    });       
});
</script>