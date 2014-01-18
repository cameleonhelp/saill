<div class="biens index">
        <?php //filtres par défaut
        $pass0 = isset($this->params->pass[0]) ? $this->params->pass[0] : 'tous';
        $pass1 = isset($this->params->pass[1]) ? $this->params->pass[1] : 'tous';
        $pass2 = isset($this->params->pass[2]) ? $this->params->pass[2] : 'tous';
        $pass3 = isset($this->params->pass[3]) ? $this->params->pass[3] : '0';        //actif
        $pass4 = isset($this->params->pass[4]) ? $this->params->pass[4] : 'tous';
        $pass5 = isset($this->params->pass[5]) ? $this->params->pass[5] : 'tous';
        // si inactif $pass3==1 alors les autres sont = 0 et image uncheked
        /*if($pass3 == 0):
             $pass1 = 1;
             $pass2 = 1 ;
        endif;  */      
        ?>     
        <nav class="navbar toolbar marginright20">
                <ul class="nav navbar-nav toolbar">
                <?php if (userAuth('profil_id')!='2' && isAuthorized('biens', 'add')) : ?>
                <li><?php echo $this->Html->link('<span class="glyphicons plus size14 margintop4"></span>', array('action' => 'add'),array('escape' => false)); ?></li>
                <?php endif; ?>
                <li class="divider-vertical-only"></li>
                <!-- filtres -->
                <li class="dropdown <?php echo filtre_is_actif($pass0,'tous'); ?>">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Filtre Applications <b class="caret"></b></a>
                     <ul class="dropdown-menu">
                     <li><?php echo $this->Html->link('Toutes', array('action' => 'index','tous',$pass1,$pass2,$pass3,$pass4,$pass5),array('class'=>'showoverlay'.subfiltre_is_actif($pass0,'tous'))); ?></li>
                     <li class="divider"></li>
                         <?php foreach ($applications as $application): ?>
                            <li><?php echo $this->Html->link($application['Application']['NOM'], array('action' => 'index',$application['Application']['id'],$pass1,$pass2,$pass3,$pass4,$pass5),array('class'=>'showoverlay'.subfiltre_is_actif($pass0,$application['Application']['id']))); ?></li>
                         <?php endforeach; ?>
                      </ul>
                </li>
                <li class="dropdown <?php echo filtre_is_actif(array($pass1,$pass2,$pass3),array('tous','tous','tous')); ?>">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Filtre Etats <b class="caret"></b></a>
                     <ul class="dropdown-menu">
                     <li><?php echo $this->Html->link('Tous', array('action' => 'index',$pass0,'tous','tous','tous',$pass4,$pass5),array('escape' => false,'class'=>'showoverlay'.subfiltre_is_actif(array($pass1,$pass2,$pass3),array('tous','tous','tous')))); ?></li>
                     <li class="divider"></li>
                     <?php
                       $inverse_install = get_pass_value($pass1); // == 1  ? 0 : $pass1 != 'tous' ? 1 : 0;
                       $img_install = get_pass_check($pass1)." bottom2"; // == 1  ? "unchecked bottom2" :  $pass1 != 'tous' ? "check bottom2" : "unchecked bottom2" ;
                       $inverse_valide = get_pass_value($pass2);
                       $img_valide = get_pass_check($pass2)." bottom2";
                       $inverse_actif = get_pass_value($pass3);
                       $img_actif = get_pass_check($pass3)." bottom2";
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
                         <?php foreach ($types as $type): ?>
                            <li><?php echo $this->Html->link($type['Type']['NOM'], array('action' => 'index',$pass0,$pass1,$pass2,$pass3,$type['Type']['id'],$pass5),array('escape' => false,'class'=>'showoverlay'.subfiltre_is_actif($pass4,$type['Type']['id']))); ?></li>
                         <?php endforeach; ?>
                      </ul>
                 </li>
                <li class="dropdown <?php echo filtre_is_actif($pass5,'tous'); ?>">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Filtre Usage <b class="caret"></b></a>
                     <ul class="dropdown-menu">
                     <li><?php echo $this->Html->link('Tous', array('action' => 'index',$pass0,$pass1,$pass2,$pass3,$pass4,'tous'),array('escape' => false,'class'=>'showoverlay'.subfiltre_is_actif($pass5,'tous'))); ?></li>
                     <li class="divider"></li>
                         <?php foreach ($usages as $usage): ?>
                            <li><?php echo $this->Html->link($usage['Usage']['NOM'], array('action' => 'index',$pass0,$pass1,$pass2,$pass3,$pass4,$usage['Usage']['id']),array('escape' => false,'class'=>'showoverlay'.subfiltre_is_actif($pass5,$usage['Usage']['id']))); ?></li>
                         <?php endforeach; ?>
                      </ul>
                 </li>                 
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
                <li class="divider-vertical-only"></li>
                <!-- Export -->
                <li>
                    <?php echo $this->Html->link('<span class="ico-xls" rel="tooltip" data-container="body" data-title="Export Excel"></span>', array('action' => 'export_xls'),array('class'=>"md",'escape' => false)); ?>
                </li>
                </ul> 
                <?php echo $this->Form->create("Bien",array('action' => 'search', 'class'=>'toolbar-form pull-right','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?>
                    <?php echo $this->Form->input('SEARCH',array('placeholder'=>'Recherche ...','style'=>"width: 200px;",'class'=>"form-control")); ?>
                    <button type="submit" class="btn form-btn showoverlay">Rechercher</button>
                <?php echo $this->Form->end(); ?> 
        </nav>
            <?php if ($this->params['action']=='index') { ?><div class="panel-body panel-filter marginbottom15 marginright20">
            <strong>Filtre appliqué : </strong><em>Liste des biens <?php echo $strfilter; ?></em></div><?php } ?>  
        <div class="marginright10">
	<table cellpadding="0" cellspacing="0" class="table table-bordered table-striped table-hover">
	<tr>
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
	</tr>
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
                <a href="#" class="installed cursor showoverlay" data-id="<?php echo $bien['Bien']['id']; ?>"  rel='tooltip'  data-container="body" data-title="Installé le <?php echo $bien['Bien']['DATEINSTALL']; ?>"><span class="glyphicons <?php echo $image; ?> notchange"></span></a></td>           
            <td style='text-align: center;'><?php $image = (isset($bien['Bien']['CHECK']) && $bien['Bien']['CHECK']==true) ? 'ok_2' : 'ok_2 disabled' ; ?>
                <a href="#" class="valided cursor showoverlay" data-id="<?php echo $bien['Bien']['id']; ?>"  rel='tooltip'  data-container="body" data-title="Validé le <?php echo $bien['Bien']['DATECHECKINSTALL']; ?>"><span class="glyphicons <?php echo $image; ?> notchange"></span></a></td>   
            <td class="actions">
            <?php if (userAuth('profil_id')!='2' && isAuthorized('biens', 'view')) : ?>
            <?php echo '<span class="glyphicons eye_open" data-rel="popover" data-title="<h3>Biens :</h3>" data-content="<contenttitle>Coeur : </contenttitle>'.h($bien['Bien']['COEUR']).
                    '<br/><contenttitle>Modèle : </contenttitle>'.h($bien['Modele']['NOM']).
                    '<br/><contenttitle>Châssis : </contenttitle>'.h($bien['Chassis']['NOM']).
                    '<br/><contenttitle>CPU : </contenttitle>'.h($bien['Cpus']['NOM']).
                    '<br/><contenttitle>Mémoire : </contenttitle>'.h($bien['Bien']['RAM']).' Mo'.
                    '<br/><contenttitle>Coût : </contenttitle>'.h(isset($bien['Bien']['COUT']) ? $bien['Bien']['COUT'] : '0.00').' €'.
                    '<br/><contenttitle>Installé le: </contenttitle>'.h($bien['Bien']['DATEINSTALL']).
                    '<br/><contenttitle>Validé le: </contenttitle>'.h($bien['Bien']['DATECHECKINSTALL']).'<br/><contenttitle>Validé par : </contenttitle>'.h(isset($bien['Bien']['CHECKBY_NOM']) ? $bien['Bien']['CHECKBY_NOM'] : '').
                    '<br/><contenttitle>Crée le: </contenttitle>'.h($bien['Bien']['created']).
                    '<br/><contenttitle>Modifié le: </contenttitle>'.h($bien['Bien']['modified']).'" data-trigger="click" style="cursor: pointer;"></span>'; ?>&nbsp;
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
<script>
$(document).ready(function () {
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
});
</script>