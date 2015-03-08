<?php //filtres par défaut
$pass0 = isset($this->params->pass[0]) ? $this->params->pass[0] : 'tous';
$pass1 = isset($this->params->pass[1]) ? $this->params->pass[1] : 'tous';
$pass2 = isset($this->params->pass[2]) ? $this->params->pass[2] : '1'; //actif :'tous';
$pass3 = isset($this->params->pass[3]) ? $this->params->pass[3] : 'tous';
$pass4 = isset($this->params->pass[4]) ? $this->params->pass[4] : 'tous';
$passaction = $this->params->action;
if (count($this->params->data) > 0) :
    $keyword = $this->params->data['Logiciel']['SEARCH'];
elseif (isset($this->params->pass[5]) && $this->params->pass[5] !=''):
    $keyword = $this->params->pass[5];
elseif (isset($keywords) && $keywords != ''):
    $keyword = $keywords;
else :
    $keyword = '';
endif;  
?>     
<nav class="navbar toolbar ">
        <ul class="nav navbar-nav toolbar">
        <?php if (userAuth('profil_id')!='2' && isAuthorized('logiciels', 'add')) : ?>
        <li><?php echo $this->Html->link('<span class="glyphicons plus size14 margintop4"></span>', array('action' => 'add'),array('escape' => false)); ?></li>
        <?php endif; ?>
        <li class="divider-vertical-only"></li>
        <!-- filtres -->
        <li class="dropdown <?php echo filtre_is_actif($pass0,'tous'); ?>">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Filtre Applications <b class="caret"></b></a>
             <ul class="dropdown-menu">
             <li><?php echo $this->Html->link('Toutes', array('action' => $passaction,'tous',$pass1,$pass2,$pass3,$pass4,$keyword),array('escape' => false,'class'=>'showoverlay'.subfiltre_is_actif($pass0,'tous'))); ?></li>
             <li class="divider"></li>
                 <?php foreach ($applications as $application): ?>
                    <li><?php echo $this->Html->link($application['Application']['NOM'], array('action' => $passaction,$application['Application']['id'],$pass1,$pass2,$pass3,$pass4,$keyword),array('escape' => false,'class'=>'showoverlay'.subfiltre_is_actif($pass0,$application['Application']['id']))); ?></li>
                 <?php endforeach; ?>
              </ul>
         </li>
        <li class="dropdown <?php echo filtre_is_actif(array($pass1,$pass2),array('tous','tous')); ?>">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Filtre Etats <b class="caret"></b></a>
             <ul class="dropdown-menu">
             <li><?php echo $this->Html->link('Tous', array('action' => $passaction,$pass0,'tous','tous',$pass3,$pass4,$keyword),array('escape' => false,'class'=>'showoverlay'.subfiltre_is_actif(array($pass1,$pass2),array('tous','tous')))); ?></li>
             <li class="divider"></li>
             <?php
                switch ($pass1):
                    case 'tous':
                        $inverse_install = 0;
                        $img_install = "unchecked bottom2";
                        break;
                    case '0':
                        $inverse_install = 1;
                        $img_install = "check bottom2";
                        break; 
                    case '1':
                        $inverse_install = 0;
                        $img_install = "unchecked bottom2";
                        break;                                 
                endswitch;
                switch ($pass2):
                    case 'tous':
                        $inverse_actif = 0;
                        $img_actif = "unchecked bottom2";
                        break;
                    case '0':
                        $inverse_actif = 1;
                        $img_actif = "unchecked bottom2";
                        break; 
                    case '1':
                        $inverse_actif = 0;
                        $img_actif = "check bottom2";
                        break;                                 
                endswitch;                        
             ?>                           
             <!--<li><?php echo $this->Html->link('<span class="glyphicons '.$img_install.'"></span> Installés', array('action' => $passaction,$pass0,$inverse_install,$pass2,$pass3,$pass4,$keyword),array('escape' => false,'class'=>'showoverlay')); ?></li>-->
             <li><?php echo $this->Html->link('<span class="glyphicons '.$img_actif.'"></span> Actif', array('action' => $passaction,$pass0,$pass1,$inverse_actif,$pass3,$pass4,$keyword),array('escape' => false,'class'=>'showoverlay')); ?></li>                     
             </ul>
         </li>
       <!-- <li class="dropdown <?php echo filtre_is_actif($pass3,'tous'); ?>">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Filtre Env. <b class="caret"></b></a>
             <ul class="dropdown-menu">
             <li><?php echo $this->Html->link('Tous', array('action' => $passaction,$pass0,$pass1,$pass2,'tous',$pass4,$keyword),array('escape' => false,'class'=>'showoverlay'.subfiltre_is_actif($pass3,'tous'))); ?></li>
             <li class="divider"></li>
                 <?php foreach ($types as $type): ?>
                    <li><?php echo $this->Html->link($type['Type']['NOM'], array('action' => $passaction,$pass0,$pass1,$pass2,$type['Type']['id'],$pass4,$keyword),array('escape' => false,'class'=>'showoverlay'.subfiltre_is_actif($pass3,$type['Type']['id']))); ?></li>
                 <?php endforeach; ?>
              </ul>
         </li>-->
        <li class="dropdown <?php echo filtre_is_actif($pass4,'tous'); ?>">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Filtre Outils <b class="caret"></b></a>
             <ul class="dropdown-menu">
             <li><?php echo $this->Html->link('Tous', array('action' => $passaction,$pass0,$pass1,$pass2,$pass3,'tous',$keyword),array('escape' => false,'class'=>'showoverlay'.subfiltre_is_actif($pass4,'tous'))); ?></li>
             <li class="divider"></li>
                 <?php foreach ($outils as $outil): ?>
                    <li><?php echo $this->Html->link($outil['Envoutil']['NOM'], array('action' => $passaction,$pass0,$pass1,$pass2,$pass3,$outil['Envoutil']['id'],$keyword),array('escape' => false,'class'=>'showoverlay'.subfiltre_is_actif($pass4,$outil['Envoutil']['id']))); ?></li>
                 <?php endforeach; ?>
              </ul>
         </li>                 
        <li class="divider-vertical-only"></li>
        <!-- Actions groupées -->  
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicons check"></span> Actions groupées <b class="caret"></b></a>
             <ul class="dropdown-menu">
             <li><?php echo $this->Html->link('Supprimer', "#",array('id'=>'deletelink','class'=>'showoverlay')); ?></li>
             <!--<li><?php echo $this->Html->link('Installer', "#",array('id'=>'installlink')); ?></li>-->
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
        <ul class="nav navbar-nav toolbar pull-right">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle btn-expand" data-toggle="dropdown"><span class="glyphicons expand notchange" style="width:13px;"></span></a>
                <ul class="dropdown-menu" style="left: -205px;min-width: 250px;max-width: 250px;">
                    <li>
                        <?php echo $this->Form->create("Logiciel",array('url' => array('action' => 'search',$pass0,$pass1,$pass2,$pass3,$pass4), 'class'=>'toolbar-form pull-right','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?>
                            <?php echo $this->Form->input('SEARCH',array('placeholder'=>'Recherche ...','style'=>"width: 200px;margin-left:3px;margin-right:-3px;display: inline-table;",'class'=>"form-control",'value'=>$keyword, 'rel'=>"tooltip", 'data-container'=>"body", 'data-title'=>Configure::read('search_tooltip'))); ?>
                            <button type="submit" class="btn form-btn showoverlay"><span class="glyphicons notchange search"></span></button>
                        <?php echo $this->Form->end(); ?> 
                    </li>
                </ul>
            </li>
        </ul> 
</nav>
<?php if ($this->params['action']=='index') { ?><div class="panel-body panel-filter marginbottom15 ">
    <strong>Filtre appliqué : </strong><em>Liste des logiciels <?php echo $strfilter; ?></em></div><?php } ?>     
<div class="">             
<table cellpadding="0" cellspacing="0" class="table table-bordered table-striped table-hover">
<thead><tr>
    <th style="text-align:center;width:15px !important;vertical-align: middle;padding-left:5px;"><?php echo $this->Form->input('checkall',array('type'=>'checkbox','label'=>false)) ; ?>
            <?php echo $this->Form->input('all_ids',array('type'=>'hidden')) ; ?>
    </th> 
    <th><?php echo $this->Paginator->sort('NOM','Nom'); ?></th>
    <th><?php echo $this->Paginator->sort('envoutil_id','Outil'); ?></th>
    <th><?php echo $this->Paginator->sort('application_id','Application'); ?></th>
    <!--<th><?php echo $this->Paginator->sort('type_id','Type d\'environnement'); ?></th>-->
    <th><?php echo $this->Paginator->sort('lot_id','Lot'); ?></th>
    <th class="actions"><?php echo __('Actions'); ?></th>
</tr></thead>
<?php foreach ($logiciels as $logiciel): ?>
<tr>
    <td style="text-align:center;padding-left:5px;padding-right:5px;vertical-align: middle;">
        <?php echo $this->Form->input('id',array('type'=>'checkbox','label'=>false,'class'=>'idselect','value'=>$logiciel['Logiciel']['id'])) ; ?>
    </td>     
        <td><?php echo h($logiciel['Logiciel']['NOM']); ?>&nbsp;</td>
        <td><?php echo h($logiciel['Envoutil']['NOM']); ?>&nbsp;</td>
        <td><?php echo h($logiciel['Application']['NOM']); ?>&nbsp;</td>
        <!--<td><?php echo h(isset($logiciel['Type']) ? $logiciel['Type']['NOM'] : ""); ?>&nbsp;</td>-->
        <td style="text-align:right;"><?php echo h($logiciel['Lot']['NOM']); ?>&nbsp;</td>  
        <td class="actions">
        <?php if (userAuth('profil_id')!='2' && isAuthorized('logiciels', 'view')) : ?>
        <?php echo '<span class="glyphicons eye_open" data-rel="popover" data-title="<h3>Logiciel :</h3>" data-content="<contenttitle>Crée le: </contenttitle>'.h($logiciel['Logiciel']['created']).'<br/><contenttitle>Modifié le: </contenttitle>'.h($logiciel['Logiciel']['modified']).'" data-trigger="click" style="cursor: pointer;"></span>'; ?>&nbsp;
        <?php endif; ?>
        <?php if (userAuth('profil_id')!='2' && isAuthorized('logiciels', 'edit')) : ?>
        <?php echo $this->Html->link('<span class="glyphicons pencil showoverlay notchange"></span>', array('action' => 'edit', $logiciel['Logiciel']['id']),array('escape' => false)); ?>&nbsp;
        <?php endif; ?>
        <?php $actif = $logiciel['Logiciel']['ACTIF']==true ? '' : ' grey'; ?>
        <?php $action = $logiciel['Logiciel']['ACTIF']==true ? 'supprimer' : 'activer'; ?>                
        <?php if (userAuth('profil_id')!='2' && isAuthorized('logiciels', 'delete')) : ?>
        <?php echo $this->Form->postLink('<span class="glyphicons bin notchange'.$actif.'"></span>', array('action' => 'delete', $logiciel['Logiciel']['id']),array('escape' => false), __('Etes-vous certain de vouloir '.$action.' ce logiciels ?')); ?>                    
        <?php endif; ?>    
        <?php if (userAuth('profil_id')!='2' && isAuthorized('logiciels', 'duplicate')) : ?>
        <?php echo $this->Form->postLink('<span class="glyphicons retweet showoverlay notchange"></span>', array('action' => 'dupliquer', $logiciel['Logiciel']['id']),array('escape' => false), __('Etes-vous certain de vouloir dupliquer ce logiciel ?')); ?>
        <?php endif; ?>                  
    </td>
</tr>
<?php endforeach; ?>
</table>
</div>
<div class="pull-left"><?php echo $this->Paginator->counter('Page {:page} sur {:pages}'); ?></div>
<div class="pull-right "><?php echo $this->Paginator->counter('Nombre total d\'éléments : {:count}'); ?></div>   
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
<!--insert csv modal //-->
<div class="modal fade" id="csvModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Importation de fichier CSV</h4>
      </div>
      <?php echo $this->Form->create('Logiciel',array('action'=>'importCSV','id'=>'formValidate','class'=>'form-horizontal', 'style'=>'margin-bottom:-7px !important;','type' => 'file','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?>
      <div class="modal-body">
          <div class="form-group">
                <label for="LogicielFile" class="col-md-4 control-label">Fichiers CSV à intégrer</label>
                <div class="col-md-offset-4">
                  <?php echo $this->Form->input('file', array('type' => 'file','size'=>"40")); ?><label for="LogicielFile" class="pull-left margintop7 italic"><?php echo 'taille max de '.ini_get('upload_max_filesize'); ?></label>
                </div>
          </div>
          <div class="form-group">
                <div class="col-md-offset-4">
                  <?php $csvfile = '../files/csv/logiciels.csv'; ?>
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
<!-- /insert csv modal //-->  
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
        if(confirm("Voulez-vous supprimer tous les logciels sélectionnés ?")){
            var ids = $("#all_ids").val();
            var overlay = $('#overlay');
            overlay.show(); 
            $.ajax({
                dataType: "html",
                type: "POST",
                url: "<?php echo $this->Html->url(array('controller'=>'logiciels','action'=>'deleteall')); ?>/",
                data: ({all_ids:ids})     
            });
        }
        location.reload();
        overlay.hide();   
        $(this).parents().find(':checkbox').prop('checked', false); 
        $("#all_ids").val('');
    });   
    
    $(document).on('keyup','#LogicielSEARCH',function (event){
        var url = "<?php echo $this->webroot;?>logiciels/search/<?php echo $pass0; ?>/<?php echo $pass1; ?>/<?php echo $pass2; ?>/<?php echo $pass3; ?>/<?php echo $pass4; ?>/";
        $(this).parents('form').attr('action',url+$(this).val());
    });         
});
</script>