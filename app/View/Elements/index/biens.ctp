<?php //filtres par défaut
$pass0 = isset($this->params->pass[0]) ? $this->params->pass[0] : 'tous';
$pass1 = isset($this->params->pass[1]) ? $this->params->pass[1] : 'tous';
$pass2 = isset($this->params->pass[2]) ? $this->params->pass[2] : 'tous';
$pass3 = isset($this->params->pass[3]) ? $this->params->pass[3] : '0';        //actif
$pass4 = isset($this->params->pass[4]) ? $this->params->pass[4] : 'tous';
$pass5 = isset($this->params->pass[5]) ? $this->params->pass[5] : 'tous';
$passaction = $this->params->action;
if (count($this->params->data) > 0) :
    $keyword = $this->params->data['Bien']['SEARCH'];
elseif (isset($this->params->pass[6]) && $this->params->pass[6] !=''):
    $keyword = $this->params->pass[6];
elseif (isset($keywords) && $keywords != ''):
    $keyword = $keywords;
else :
    $keyword = '';
endif;       
?>     
<nav class="navbar toolbar ">
        <ul class="nav navbar-nav toolbar">
        <?php if (userAuth('profil_id')!='2' && isAuthorized('biens', 'add')) : ?>
        <li><?php echo $this->Html->link('<span class="glyphicons plus size14 margintop4"></span>', array('action' => 'add'),array('escape' => false)); ?></li>
        <?php endif; ?>
        <li class="divider-vertical-only"></li>
        <!-- filtres -->
        <li class="dropdown <?php echo filtre_is_actif($pass0,'tous'); ?>">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Filtre Applications <b class="caret"></b></a>
             <ul class="dropdown-menu">
             <li><?php echo $this->Html->link('Toutes', array('action' => $passaction,'tous',$pass1,$pass2,$pass3,$pass4,$pass5,$keyword),array('class'=>'showoverlay'.subfiltre_is_actif($pass0,'tous'))); ?></li>
             <li class="divider"></li>
                 <?php foreach ($applications as $application): ?>
                    <li><?php echo $this->Html->link($application['Application']['NOM'], array('action' => $passaction,$application['Application']['id'],$pass1,$pass2,$pass3,$pass4,$pass5,$keyword),array('class'=>'showoverlay'.subfiltre_is_actif($pass0,$application['Application']['id']))); ?></li>
                 <?php endforeach; ?>
              </ul>
        </li>
        <li class="dropdown <?php echo filtre_is_actif(array($pass1,$pass2,$pass3),array('tous','tous','tous')); ?>">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Filtre Etats <b class="caret"></b></a>
             <ul class="dropdown-menu">
             <li><?php echo $this->Html->link('Tous', array('action' => $passaction,$pass0,'tous','tous','tous',$pass4,$pass5,$keyword),array('escape' => false,'class'=>'showoverlay'.subfiltre_is_actif(array($pass1,$pass2,$pass3),array('tous','tous','tous')))); ?></li>
             <li class="divider"></li>
             <?php
               $inverse_install = get_pass_value($pass1); // == 1  ? 0 : $pass1 != 'tous' ? 1 : 0;
               $img_install = get_pass_check($pass1)." bottom2"; // == 1  ? "unchecked bottom2" :  $pass1 != 'tous' ? "check bottom2" : "unchecked bottom2" ;
               $inverse_valide = get_pass_value($pass2);
               $img_valide = get_pass_check($pass2)." bottom2";
               $inverse_actif = get_pass_value($pass3);
               $img_actif = get_pass_check($pass3)." bottom2";
             ?>                           
             <li><?php echo $this->Html->link('<span class="glyphicons '.$img_install.'"></span> Installés', array('action' => $passaction,$pass0,$inverse_install,$pass2,$pass3,$pass4,$pass5,$keyword),array('escape' => false,'class'=>'showoverlay')); ?></li>
             <li><?php echo $this->Html->link('<span class="glyphicons '.$img_valide.'"></span> Validés', array('action' => $passaction,$pass0,$pass1,$inverse_valide,$pass3,$pass4,$pass5,$keyword),array('escape' => false,'class'=>'showoverlay')); ?></li>                     
             <li><?php echo $this->Html->link('<span class="glyphicons '.$img_actif.'"></span> Actif', array('action' => $passaction,$pass0,$pass1,$pass2,$inverse_actif,$pass4,$pass5,$keyword),array('escape' => false,'class'=>'showoverlay')); ?></li>                     
             </ul>
         </li>
        <li class="dropdown <?php echo filtre_is_actif($pass4,'tous'); ?>">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Filtre Env. <b class="caret"></b></a>
             <ul class="dropdown-menu">
             <li><?php echo $this->Html->link('Tous', array('action' => $passaction,$pass0,$pass1,$pass2,$pass3,'tous',$pass5,$keyword),array('escape' => false,'class'=>'showoverlay'.subfiltre_is_actif($pass4,'tous'))); ?></li>
             <li class="divider"></li>
                 <?php foreach ($types as $type): ?>
                    <li><?php echo $this->Html->link($type['Type']['NOM'], array('action' => $passaction,$pass0,$pass1,$pass2,$pass3,$type['Type']['id'],$pass5,$keyword),array('escape' => false,'class'=>'showoverlay'.subfiltre_is_actif($pass4,$type['Type']['id']))); ?></li>
                 <?php endforeach; ?>
              </ul>
         </li>
        <li class="dropdown <?php echo filtre_is_actif($pass5,'tous'); ?>">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Filtre Usage <b class="caret"></b></a>
             <ul class="dropdown-menu">
             <li><?php echo $this->Html->link('Tous', array('action' => $passaction,$pass0,$pass1,$pass2,$pass3,$pass4,'tous',$keyword),array('escape' => false,'class'=>'showoverlay'.subfiltre_is_actif($pass5,'tous'))); ?></li>
             <li class="divider"></li>
                 <?php foreach ($usages as $usage): ?>
                    <li><?php echo $this->Html->link($usage['Usage']['NOM'], array('action' => $passaction,$pass0,$pass1,$pass2,$pass3,$pass4,$usage['Usage']['id'],$keyword),array('escape' => false,'class'=>'showoverlay'.subfiltre_is_actif($pass5,$usage['Usage']['id']))); ?></li>
                 <?php endforeach; ?>
              </ul>
         </li>        
         <?php if (userAuth('profil_id')!='2' && isAuthorized('biens', 'edit')) : ?>
        <li class="divider-vertical-only"></li>
        <!-- Actions groupées -->  
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicons check"></span> Actions groupées <b class="caret"></b></a>
             <ul class="dropdown-menu">
             <li><?php echo $this->Html->link('Supprimer', "#",array('id'=>'deletelink','class'=>'showoverlay')); ?></li>
             <li><?php echo $this->Html->link('Installer', "#",array('id'=>'installlink','class'=>'showoverlay')); ?></li>
             <li><?php echo $this->Html->link('Valider', "#",array('id'=>'checklink','class'=>'showoverlay')); ?></li>
             </ul>
        </li>    
        <?php endif; ?>
        <li class="divider-vertical-only"></li>
        <!-- Export -->
        <li>
            <?php echo $this->Html->link('<span class="ico-xls" rel="tooltip" data-container="body" data-title="Export Excel"></span>', array('action' => 'export_xls'),array('class'=>"md",'escape' => false)); ?>
        </li>
       <li class="divider-vertical-only"></li>
       <li><?php echo $this->Html->link('<span class="glyphicons eye_close size14 margintop4 notactive" rel="tooltip" data-title="Ouvrir ou fermer le détail des utilisateurs de cette page"></span>', "#",array('class'=>"md btn_eye_close",'escape' => false)); ?></li>
       <li class="divider-vertical-only"></li>         
        </ul> 
        <ul class="nav navbar-nav toolbar pull-right">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle btn-expand" data-toggle="dropdown"><span class="glyphicons expand notchange" style="width:13px;"></span></a>
                <ul class="dropdown-menu" style="left: -205px;min-width: 250px;max-width: 250px;">
                    <li>
                        <?php echo $this->Form->create("Bien",array('url' => array('action' => 'search',$pass0,$pass1,$pass2,$pass3,$pass4,$pass5), 'class'=>'toolbar-form pull-right','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?>
                            <?php echo $this->Form->input('SEARCH',array('placeholder'=>'Recherche ...','style'=>"width: 200px;margin-left:3px;margin-right:-3px;display: inline-table;",'class'=>"form-control",'value'=>$keyword, 'rel'=>"tooltip", 'data-container'=>"body", 'data-title'=>Configure::read('search_tooltip'))); ?>
                            <button type="submit" class="btn form-btn showoverlay"><span class="glyphicons notchange search"></span></button>
                        <?php echo $this->Form->end(); ?> 
                    </li>
                </ul>
            </li>
        </ul> 
</nav>
    <?php if ($this->params['action']=='index') { ?><div class="panel-body panel-filter marginbottom15 ">
    <strong>Filtre appliqué : </strong><em>Liste des biens <?php echo $strfilter; ?></em></div><?php } ?>  
<div class="">
<table cellpadding="0" cellspacing="0" class="table table-bordered table-striped table-hover">
<thead><tr>
                <th style="text-align:center;width:15px !important;vertical-align: middle;padding-left:5px;"><?php echo $this->Form->input('checkall',array('type'=>'checkbox','label'=>false)) ; ?>
                        <?php echo $this->Form->input('all_ids',array('type'=>'hidden')) ; ?>
                </th>
                <th><?php echo $this->Paginator->sort('NOM','Nom'); ?></th>
                <th><?php echo $this->Paginator->sort('usage_id','Usage'); ?></th>
                <th><?php echo $this->Paginator->sort('PVU','PVU'); ?></th>
                <th><?php echo $this->Paginator->sort('application_id','Application'); ?></th>
                <th><?php echo $this->Paginator->sort('type_id','Type d\'environnement'); ?></th>
                <th><?php echo $this->Paginator->sort('lot_id','Lot'); ?></th>
                <th><?php echo $this->Paginator->sort('COEURLICENCE','Coeur licence'); ?></th>
                <th><?php echo $this->Paginator->sort('DATEINSTALL','Installé'); ?></th>
                <th><?php echo $this->Paginator->sort('DATECHECKINSTALL','Validé'); ?></th>
                <th class="actions"><?php echo __('Actions'); ?></th>
</tr></thead>
<?php foreach ($biens as $bien): ?>
<tr>
    <td style="text-align:center;padding-left:5px;padding-right:5px;vertical-align: middle;">
        <?php echo $this->Form->input('id',array('type'=>'checkbox','label'=>false,'class'=>'idselect','value'=>$bien['Bien']['id'])) ; ?>
    </td>
    <td class='text-courrier'><?php echo h($bien['Bien']['NOM']); ?>&nbsp;</td>
    <td><?php echo h($bien['Usage']['NOM']); ?></td>   
    <td style='text-align: right;'><?php echo h($bien['Bien']['PVU']); ?>&nbsp;</td>            
    <td><?php echo h($bien['Application']['NOM']); ?></td>
    <td><?php echo h($bien['Type']['NOM']); ?></td>
    <td style='text-align: right;'><?php echo h($bien['Lot']['NOM']); ?></td>
    <td style='text-align: right;'><?php echo h($bien['Bien']['COEURLICENCE']); ?>&nbsp;</td>
    <td style='text-align: center;'><?php $image = (isset($bien['Bien']['INSTALL']) && $bien['Bien']['INSTALL']==true) ? 'ok_2' : 'ok_2 disabled' ; ?>
    <?php if (userAuth('profil_id')!='2' && isAuthorized('biens', 'edit')) : ?>
        <a href="#" class="installed cursor showoverlay" data-id="<?php echo $bien['Bien']['id']; ?>"  rel='tooltip'  data-container="body" data-title="Installé le <?php echo $bien['Bien']['DATEINSTALL']; ?>"><span class="glyphicons <?php echo $image; ?> notchange"></span></a> 
    <?php else: ?>
        <span class="glyphicons <?php echo $image; ?> notchange"></span>
    <?php endif; ?>
    </td>
    <td style='text-align: center;'><?php $image = (isset($bien['Bien']['CHECK']) && $bien['Bien']['CHECK']==true) ? 'ok_2' : 'ok_2 disabled' ; ?>
     <?php if (userAuth('profil_id')!='2' && isAuthorized('biens', 'add')) : ?>
        <a href="#" class="valided cursor showoverlay" data-id="<?php echo $bien['Bien']['id']; ?>"  rel='tooltip'  data-container="body" data-title="Validé le <?php echo $bien['Bien']['DATECHECKINSTALL']; ?>"><span class="glyphicons <?php echo $image; ?> notchange"></span></a></td>   
    <?php else: ?>
        <span class="glyphicons <?php echo $image; ?> notchange"></span>
    <?php endif; ?>
    </td>
    <td class="actions">
    <?php if (userAuth('profil_id')!='2' && isAuthorized('biens', 'view')) : ?>
        <?php echo '<span class="glyphicons eye_open cursor"></span>'; ?>&nbsp;
    <?php endif; ?>
    <?php if (userAuth('profil_id')!='2' && isAuthorized('biens', 'edit')) : ?>
    <?php echo $this->Html->link('<span class="glyphicons pencil showoverlay notchange"></span>', array('action' => 'edit', $bien['Bien']['id']),array('escape' => false)); ?>&nbsp;
    <?php endif; ?>
    <?php if (userAuth('profil_id')!='2' && isAuthorized('biens', 'delete')) : ?>
    <?php $actif = $bien['Bien']['ACTIF']==true ? '' : ' grey'; ?>
    <?php $action = $bien['Bien']['ACTIF']==true ? 'supprimer' : 'activer'; ?>
    <?php echo $this->Form->postLink('<span class="glyphicons bin notchange'.$actif.'"></span>', array('action' => 'delete', $bien['Bien']['id']),array('escape' => false), __('Etes-vous certain de vouloir '.$action.' ce bien ?')); ?>                    
    <?php endif; ?>  
    <?php if (userAuth('profil_id')!='2' && isAuthorized('biens', 'duplicate')) : ?>
    <?php echo $this->Form->postLink('<span class="glyphicons showoverlay retweet notchange"></span>', array('action' => 'dupliquer', $bien['Bien']['id']),array('escape' => false), __('Etes-vous certain de vouloir dupliquer ce bien ?')); ?>
    <?php endif; ?>            
    </td>
</tr>
<tr class="trhidden" style="display:none;">
    <td colspan="11" align="center">
        <table cellpadding="0" cellspacing="0" class="table table-hidden" style="margin-bottom:-3px;">
            <tr><th>Coeur</th><th>Modèle</th><th>Châssis</th><th>CPU</th><th>Mémoire</th><th>Coût</th><th>Installé le</th><th>Validé le</th><th>Validé par</th></tr>
            <tr><td><?php echo $bien['Bien']['COEUR']; ?></td><td><?php echo $bien['Modele']['NOM']; ?></td><td><?php echo $bien['Chassis']['NOM']; ?></td><td><?php echo $bien['Cpus']['NOM']; ?></td><td><?php echo $bien['Bien']['RAM'].' Mo'; ?></td><td><?php echo isset($bien['Bien']['COUT']) ? $bien['Bien']['COUT'] : '0.00'.' €'; ?></td><td><?php echo $bien['Bien']['DATEINSTALL']; ?></td><td><?php echo $bien['Bien']['DATECHECKINSTALL']; ?></td><td><?php echo isset($bien['Bien']['CHECKBY_NOM']) ? $bien['Bien']['CHECKBY_NOM'] : ''; ?></td></tr>
        </table>
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
<script>
$(document).ready(function () {
    $(document).on('click','.eye_open',function(e){
        $(this).parents('tr').next('.trhidden').slideToggle("slow");
    });
    
    $(document).on('click','.btn_eye_close',function(e){
        var overlay = $('#overlay');
        overlay.show();         
        $('.trhidden').slideToggle("slow");
        $(this).toggleClass('filtreactif');     
        $('.eye_close').toggleClass('margintop4');    
        overlay.hide(); 
    });     
    
    $(document).on('click','.installed',function(e){
        var id = $(this).attr('data-id');
            $.ajax({
                dataType: "html",
                type: "POST",
                url: "<?php echo $this->Html->url(array('controller'=>'biens','action'=>'ajax_install')); ?>/",
                data: ({id:id})
            }).done(function ( data ) {
                location.reload();
            });
    });
    $(document).on('click','.valided',function(e){
        var id = $(this).attr('data-id');
            $.ajax({
                dataType: "html",
                type: "POST",
                url: "<?php echo $this->Html->url(array('controller'=>'biens','action'=>'ajax_check')); ?>/",
                data: ({id:id})
            }).done(function ( data ) {
                location.reload();
            });
    });    
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
    $(document).on('click','#installlink',function(e){
        if(confirm("Voulez-vous modifier le statut d'installation de tous les biens sélectionnées ?")){
            var ids = $("#all_ids").val();
            var overlay = $('#overlay');
            overlay.show(); 
            $.ajax({
                dataType: "html",
                type: "POST",
                url: "<?php echo $this->Html->url(array('controller'=>'biens','action'=>'installall')); ?>/",
                data: ({id:ids})     
            });
        }
        location.reload();
        overlay.hide();   
        $(this).parents().find(':checkbox').prop('checked', false); 
        $("#all_ids").val('');
    });   
    $(document).on('click','#checklink',function(e){
        if(confirm("Voulez-vous modifier le statut de validation de tous les biens sélectionnées ?")){
            var ids = $("#all_ids").val();
            var overlay = $('#overlay');
            overlay.show(); 
            $.ajax({
                dataType: "html",
                type: "POST",
                url: "<?php echo $this->Html->url(array('controller'=>'biens','action'=>'checkall')); ?>/",
                data: ({id:ids})     
            });
        }
        location.reload();
        overlay.hide();   
        $(this).parents().find(':checkbox').prop('checked', false); 
        $("#all_ids").val('');
    });       
    $(document).on('click','#deletelink',function(e){
        if(confirm("Voulez-vous supprimer tous les biens sélectionnées ?")){
            var ids = $("#all_ids").val();
            var overlay = $('#overlay');
            overlay.show(); 
            $.ajax({
                dataType: "html",
                type: "POST",
                url: "<?php echo $this->Html->url(array('controller'=>'biens','action'=>'deleteall')); ?>/",
                data: ({id:ids})     
            });
        }
        location.reload();
        overlay.hide();   
        $(this).parents().find(':checkbox').prop('checked', false); 
        $("#all_ids").val('');
    });    
    
    $(document).on('keyup','#BienSEARCH',function (event){
        var url = "<?php echo $this->webroot;?>biens/search/<?php echo $pass0; ?>/<?php echo $pass1; ?>/<?php echo $pass2; ?>/<?php echo $pass3; ?>/<?php echo $pass4; ?>/<?php echo $pass5; ?>/";
        $(this).parents('form').attr('action',url+$(this).val());
    });       
});
</script>