<div class="intergrationapplicatives index">
        <?php //filtres par défaut
        $pass0 = isset($this->params->pass[0]) ? $this->params->pass[0] : 'tous';
        $pass1 = isset($this->params->pass[1]) ? $this->params->pass[1] : 'tous';
        $pass2 = isset($this->params->pass[2]) ? $this->params->pass[2] : 'tous';
        $pass3 = isset($this->params->pass[3]) ? $this->params->pass[3] : '1'; //actif :'tous';        
        $pass4 = isset($this->params->pass[4]) ? $this->params->pass[4] : 'tous';
        $pass5 = isset($this->params->pass[5]) ? $this->params->pass[5] : 'tous';
        ?>     
        <nav class="navbar toolbar ">
                <ul class="nav navbar-nav toolbar">
                <?php if (userAuth('profil_id')!='2' && isAuthorized('intergrationapplicatives', 'add')) : ?>
                <li><?php echo $this->Html->link('<span class="glyphicons plus size14 margintop4"></span>', array('action' => 'add'),array('escape' => false)); ?></li>
                <?php endif; ?>
                <li class="divider-vertical-only"></li>
                <!-- filtres -->
                <li class="dropdown <?php echo filtre_is_actif($pass0,'tous'); ?>">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Filtre Applications <b class="caret"></b></a>
                     <ul class="dropdown-menu">
                     <li><?php echo $this->Html->link('Toutes', array('action' => 'index','tous',$pass1,$pass2,$pass3,$pass4,$pass5),array('escape' => false,'class'=>'showoverlay'.subfiltre_is_actif($pass0,'tous'))); ?></li>
                     <li class="divider"></li>
                     <?php if(count($applications) > 0): ?>
                         <?php foreach ($applications as $application): ?>
                            <li><?php echo $this->Html->link($application['Application']['NOM'], array('action' => 'index',$application['Application']['id'],$pass1,$pass2,$pass3,$pass4,$pass5),array('escape' => false,'class'=>'showoverlay'.subfiltre_is_actif($pass0,$application['Application']['id']))); ?></li>
                         <?php endforeach; ?>
                      <?php endif; ?>
                      </ul>
                 </li>
                <li class="dropdown <?php echo filtre_is_actif(array($pass1,$pass2,$pass3),array('tous','tous','tous')); ?>">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Filtre Etats <b class="caret"></b></a>
                     <ul class="dropdown-menu">
                     <li><?php echo $this->Html->link('Tous', array('action' => 'index',$pass0,'tous','tous','tous',$pass4,$pass5),array('escape' => false,'class'=>'showoverlay'.subfiltre_is_actif(array($pass1,$pass2,$pass3),array('tous','tous','tous')))); ?></li>
                     <li class="divider"></li>
                     <?php
                       $inverse_install = 0;
                       $img_install = 'unchecked bottom2';
                       if ($pass1==='0'):
                           $img_install = 'check bottom2';
                           $inverse_install = 1;
                       endif;
                       $inverse_valide = 0;
                       $img_valide = 'unchecked bottom2';
                       if ($pass2==='0'):
                           $img_valide = 'check bottom2';
                           $inverse_valide = 1;
                       endif;                       
                        switch ($pass3):
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
                     <li><?php echo $this->Html->link('<span class="glyphicons '.$img_install.'"></span> Installés', array('action' => 'index',$pass0,$inverse_install,$pass2,$pass3,$pass4,$pass5),array('escape' => false,'class'=>'showoverlay')); ?></li>
                     <li><?php echo $this->Html->link('<span class="glyphicons '.$img_valide.'"></span> Validés', array('action' => 'index',$pass0,$pass1,$inverse_valide,$pass3,$pass4,$pass5),array('escape' => false,'class'=>'showoverlay')); ?></li>                     
                     <li><?php echo $this->Html->link('<span class="glyphicons '.$img_actif.'"></span> Actif', array('action' => 'index',$pass0,$pass1,$pass2,$inverse_actif,$pass4,$pass5),array('escape' => false,'class'=>'showoverlay')); ?></li>                     
                     </ul>
                 </li>
                <li class="dropdown <?php echo filtre_is_actif($pass4,'tous'); ?>">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Filtre Env. <b class="caret"></b></a>
                     <ul class="dropdown-menu">
                     <li><?php echo $this->Html->link('Tous', array('action' => 'index',$pass0,$pass1,$pass2,$pass3,'tous',$pass5),array('escape' => false,'class'=>'showoverlay'.subfiltre_is_actif($pass4,'tous'))); ?></li>
                     <li class="divider"></li>
                     <?php if(count($types) > 0): ?>
                         <?php foreach ($types as $type): ?>
                            <li><?php echo $this->Html->link($type['Type']['NOM'], array('action' => 'index',$pass0,$pass1,$pass2,$pass3,$type['Type']['id'],$pass5),array('escape' => false,'class'=>'showoverlay'.subfiltre_is_actif($pass4,$type['Type']['id']))); ?></li>
                         <?php endforeach; ?>
                     <?php endif; ?>
                      </ul>
                 </li>     
                <li class="dropdown <?php echo filtre_is_actif($pass5,'tous'); ?>">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Filtre Version <b class="caret"></b></a>
                     <ul class="dropdown-menu">
                     <li><?php echo $this->Html->link('Tous', array('action' => 'index',$pass0,$pass1,$pass2,$pass3,$pass4,'tous'),array('escape' => false,'class'=>'showoverlay'.subfiltre_is_actif($pass5,'tous'))); ?></li>
                     <li class="divider"></li>
                     <?php if(count($versions) > 0): ?>
                         <?php foreach ($versions as $version): ?>
                            <li><?php echo $this->Html->link($version['Version']['NOM'], array('action' => 'index',$pass0,$pass1,$pass2,$pass3,$pass4,$version['Version']['id']),array('escape' => false,'class'=>'showoverlay'.subfiltre_is_actif($pass5,$version['Version']['id']))); ?></li>
                         <?php endforeach; ?>
                     <?php endif; ?>
                      </ul>
                 </li>         
                 <?php if (userAuth('profil_id')!='2' && isAuthorized('intergrationapplicatives', 'edit')) : ?>
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
                </ul>
                <?php echo $this->Form->create("Intergrationapplicative",array('action' => 'search', 'class'=>'toolbar-form pull-right','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?>
                    <?php echo $this->Form->input('SEARCH',array('placeholder'=>'Recherche ...','style'=>"width: 200px;",'class'=>"form-control")); ?>
                    <button type="submit" class="btn form-btn showoverlay"><span class="glyphicons notchange search"></span></button>
                <?php echo $this->Form->end(); ?> 
        </nav>
            <?php if ($this->params['action']=='index') { ?><div class="panel-body panel-filter marginbottom15 ">
            <strong>Filtre appliqué : </strong><em>Liste des intégrations applicatives <?php echo $strfilter; ?></em></div><?php } ?>      
        <div class="">
	<table cellpadding="0" cellspacing="0" class="table table-bordered table-striped table-hover">
	<tr>
                        <th style="text-align:center;width:15px !important;vertical-align: middle;padding-left:5px;"><?php echo $this->Form->input('checkall',array('type'=>'checkbox','label'=>false)) ; ?>
                                <?php echo $this->Form->input('all_ids',array('type'=>'hidden')) ; ?>
                        </th>             
			<th><?php echo $this->Paginator->sort('application_id','Application'); ?></th>
			<th><?php echo $this->Paginator->sort('type_id','Type d\'environnement'); ?></th>
                        <th><?php echo $this->Paginator->sort('lot_id','Lot'); ?></th>
			<th><?php echo $this->Paginator->sort('version_id','Version'); ?></th>
			<th><?php echo $this->Paginator->sort('DATEINSTALL','Installé'); ?></th>
                        <th><?php echo $this->Paginator->sort('DATECHECK','Validé'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($intergrationapplicatives as $intergrationapplicative): ?>
	<tr>
            <td style="text-align:center;padding-left:5px;padding-right:5px;vertical-align: middle;">
                <?php echo $this->Form->input('id',array('type'=>'checkbox','label'=>false,'class'=>'idselect','value'=>$intergrationapplicative['Intergrationapplicative']['id'])) ; ?>
            </td>            
            <td>
                    <?php echo $intergrationapplicative['Application']['NOM']; ?>
            </td>
            <td>
                    <?php echo $intergrationapplicative['Type']['NOM']; ?>
            </td>
            <td style="text-align: right;">
                    <?php echo $intergrationapplicative['Lot']['NOM']; ?>
            </td>
            <td>
                    <?php echo $intergrationapplicative['Version']['NOM']; ?>
            </td>
            <td style='text-align: center;'><?php $image = (isset($intergrationapplicative['Intergrationapplicative']['INSTALL']) && $intergrationapplicative['Intergrationapplicative']['INSTALL']==true) ? 'ok_2' : 'ok_2 disabled' ; ?>
            <?php if (userAuth('profil_id')!='2' && isAuthorized('intergrationapplicatives', 'edit')) : ?>    
                <a href="#"  data-id="<?php echo $intergrationapplicative['Intergrationapplicative']['id']; ?>"  rel='tooltip'  data-container="body" data-title="Installé le <?php echo $intergrationapplicative['Intergrationapplicative']['DATEINSTALL']; ?>"><span class="glyphicons <?php echo $image; ?> notchange"></span></a>
            <?php else: ?>
                <span class="glyphicons <?php echo $image; ?> notchange"></span>
            <?php endif; ?>
            </td>           
            <td style='text-align: center;'><?php $image = (isset($intergrationapplicative['Intergrationapplicative']['CHECK']) && $intergrationapplicative['Intergrationapplicative']['CHECK']==true) ? 'ok_2' : 'ok_2 disabled' ; ?>
            <?php if (userAuth('profil_id')!='2' && isAuthorized('intergrationapplicatives', 'edit')) : ?>
                <a href="#" class="valided cursor showoverlay" data-id="<?php echo $intergrationapplicative['Intergrationapplicative']['id']; ?>"  rel='tooltip'  data-container="body" data-title="Validé le <?php echo $intergrationapplicative['Intergrationapplicative']['DATECHECK']; ?>"><span class="glyphicons <?php echo $image; ?> notchange"></span></a>
            <?php else: ?>
                <span class="glyphicons <?php echo $image; ?> notchange"></span>
            <?php endif; ?>
            </td>   
            <td class="actions">
            <?php if (userAuth('profil_id')!='2' && isAuthorized('intergrationapplicatives', 'view')) : ?>
            <?php echo '<span class="glyphicons eye_open" data-rel="popover" data-title="<h3>Intégration applicative :</h3>" data-content="<contenttitle>Crée le: </contenttitle>'.h($intergrationapplicative['Intergrationapplicative']['created']).'<br/><contenttitle>Modifié le: </contenttitle>'.h($intergrationapplicative['Intergrationapplicative']['modified']).'" data-trigger="click" style="cursor: pointer;"></span>'; ?>&nbsp;
            <?php endif; ?>
            <?php if (userAuth('profil_id')!='2' && isAuthorized('intergrationapplicatives', 'edit')) : ?>
            <?php echo $this->Html->link('<span class="glyphicons pencil showoverlay notchange"></span>', array('action' => 'edit', $intergrationapplicative['Intergrationapplicative']['id']),array('escape' => false)); ?>&nbsp;
            <?php endif; ?>
            <?php if (userAuth('profil_id')!='2' && isAuthorized('intergrationapplicatives', 'delete')) : ?>
            <?php $actif = $intergrationapplicative['Intergrationapplicative']['ACTIF']==true ? '' : ' grey'; ?>
            <?php $action = $intergrationapplicative['Intergrationapplicative']['ACTIF']==true ? 'supprimer' : 'activer'; ?>            
            <?php echo $this->Form->postLink('<span class="glyphicons bin notchange'.$actif.'"></span>', array('action' => 'delete', $intergrationapplicative['Intergrationapplicative']['id']),array('escape' => false), __('Etes-vous certain de vouloir '.$action.' cette instégration ?')); ?>                    
            <?php endif; ?> 
            <?php if (userAuth('profil_id')!='2' && isAuthorized('intergrationapplicatives', 'duplicate')) : ?>
            <?php echo $this->Form->postLink('<span class="glyphicons retweet showoverlay notchange"></span>', array('action' => 'dupliquer', $intergrationapplicative['Intergrationapplicative']['id']),array('escape' => false), __('Etes-vous certain de vouloir dupliquer cette intégration ?')); ?>
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
</div>
<script>
$(document).ready(function () {
    /*$(document).on('click','.installed',function(e){
        var id = $(this).attr('data-id');
            $.ajax({
                dataType: "html",
                type: "POST",
                url: "<?php echo $this->Html->url(array('controller'=>'intergrationapplicatives','action'=>'ajax_install')); ?>/",
                data: ({id:id})
            }).done(function ( data ) {
                location.reload();
            });
    });*/
    $(document).on('click','.valided',function(e){
        var id = $(this).attr('data-id');
            $.ajax({
                dataType: "html",
                type: "POST",
                url: "<?php echo $this->Html->url(array('controller'=>'intergrationapplicatives','action'=>'ajax_check')); ?>/",
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
        if(confirm("Voulez-vous modifier le statut d'installation de toutes les intégrations sélectionnées ?")){
            var ids = $("#all_ids").val();
            var overlay = $('#overlay');
            overlay.show(); 
                $.ajax({
                    dataType: "html",
                    type: "POST",
                    url: "<?php echo $this->Html->url(array('controller'=>'intergrationapplicatives','action'=>'installall')); ?>/",
                    data: ({all_ids:ids})     
                });
        }
        location.reload();
        overlay.hide();   
        $(this).parents().find(':checkbox').prop('checked', false); 
        $("#all_ids").val('');
    });   
    $(document).on('click','#checklink',function(e){
        if(confirm("Voulez-vous modifier le statut de validation de toutes les intégrations sélectionnées ?")){
            var ids = $("#all_ids").val();
            var overlay = $('#overlay');
            overlay.show(); 
            $.ajax({
                dataType: "html",
                type: "POST",
                url: "<?php echo $this->Html->url(array('controller'=>'intergrationapplicatives','action'=>'checkall')); ?>/",
                data: ({all_ids:ids})       
            });
        }
        location.reload();
        overlay.hide();   
        $(this).parents().find(':checkbox').prop('checked', false); 
        $("#all_ids").val('');
    });       
    $(document).on('click','#deletelink',function(e){
        if(confirm("Voulez-vous supprimer toutes les intégrations sélectionnées ?")){
            var ids = $("#all_ids").val();
            var overlay = $('#overlay');
            overlay.show(); 
            $.ajax({
                dataType: "html",
                type: "POST",
                url: "<?php echo $this->Html->url(array('controller'=>'intergrationapplicatives','action'=>'deleteall')); ?>/",
                data: ({all_ids:ids})          
            });
        }
        location.reload();
        overlay.hide();   
        $(this).parents().find(':checkbox').prop('checked', false); 
        $("#all_ids").val('');
    });       
});
</script>