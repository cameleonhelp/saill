<div class="actions index" id="ActionsRefresh">
        <div class="navbar">
            <div class="navbar-inner">
                <div class="container">
                <ul class="nav">
                <?php if (userAuth('profil_id')!='2' && isAuthorized('actions', 'add')) : ?>
                <li><?php echo $this->Html->link('<span class="glyphicons plus size14" rel="tooltip" data-title="Ajoutez une action"></span>', array('action' => 'add'),array('escape' => false,'class'=>'showoverlay')); ?></li>
                <li class="divider-vertical-only"></li>
                <?php endif; ?>
                <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Filtre Priorité <b class="caret"></b></a>
                     <ul class="dropdown-menu">
                         <li><?php echo $this->Html->link('Tous', array('action' => 'index','tous',isset($this->params->pass[1]) ? $this->params->pass[1] : 'tous',isset($this->params->pass[2]) ? $this->params->pass[2] : 'tous'),array('class'=>'showoverlay')); ?></li>
                         <li class="divider"></li>
                         <li><?php echo $this->Html->link('Normale', array('action' => 'index','1',isset($this->params->pass[1]) ? $this->params->pass[1] : 'tous',isset($this->params->pass[2]) ? $this->params->pass[2] : 'tous'),array('class'=>'showoverlay')); ?></li>
                         <li><?php echo $this->Html->link('Moyenne', array('action' => 'index','2',isset($this->params->pass[1]) ? $this->params->pass[1] : 'tous',isset($this->params->pass[2]) ? $this->params->pass[2] : 'tous'),array('class'=>'showoverlay')); ?></li>
                         <li><?php echo $this->Html->link('Haute', array('action' => 'index','3',isset($this->params->pass[1]) ? $this->params->pass[1] : 'tous',isset($this->params->pass[2]) ? $this->params->pass[2] : 'tous'),array('class'=>'showoverlay')); ?></li>
                     </ul>
                </li>
                <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Filtre Etats <b class="caret"></b></a>
                     <ul class="dropdown-menu">
                         <li><?php echo $this->Html->link('Tous', array('action' => 'index',isset($this->params->pass[0]) ? $this->params->pass[0] : 'tous','tous',isset($this->params->pass[2]) ? $this->params->pass[2] : 'tous'),array('class'=>'showoverlay')); ?></li>
                         <li class="divider"></li>
                         <li><?php echo $this->Html->link('Nouvelles', array('action' => 'index',isset($this->params->pass[0]) ? $this->params->pass[0] : 'tous','news',isset($this->params->pass[2]) ? $this->params->pass[2] : 'tous'),array('class'=>'showoverlay')); ?></li>
                         <li class="divider"></li>                         
                         <li><?php echo $this->Html->link('A faire', array('action' => 'index',isset($this->params->pass[0]) ? $this->params->pass[0] : 'tous','1',isset($this->params->pass[2]) ? $this->params->pass[2] : 'tous'),array('class'=>'showoverlay')); ?></li>
                         <li><?php echo $this->Html->link('En cours', array('action' => 'index',isset($this->params->pass[0]) ? $this->params->pass[0] : 'tous','2',isset($this->params->pass[2]) ? $this->params->pass[2] : 'tous'),array('class'=>'showoverlay')); ?></li>
                         <li><?php echo $this->Html->link('Terminée', array('action' => 'index',isset($this->params->pass[0]) ? $this->params->pass[0] : 'tous','3',isset($this->params->pass[2]) ? $this->params->pass[2] : 'tous'),array('class'=>'showoverlay')); ?></li>
                         <li><?php echo $this->Html->link('Livrée', array('action' => 'index',isset($this->params->pass[0]) ? $this->params->pass[0] : 'tous','4',isset($this->params->pass[2]) ? $this->params->pass[2] : 'tous'),array('class'=>'showoverlay')); ?></li>
                         <li><?php echo $this->Html->link('Annulée', array('action' => 'index',isset($this->params->pass[0]) ? $this->params->pass[0] : 'tous','5',isset($this->params->pass[2]) ? $this->params->pass[2] : 'tous'),array('class'=>'showoverlay')); ?></li>
                         <li class="divider"></li>
                         <li><?php echo $this->Html->link('Todolist', array('action' => 'index',isset($this->params->pass[0]) ? $this->params->pass[0] : 'tous','6',isset($this->params->pass[2]) ? $this->params->pass[2] : 'tous'),array('class'=>'showoverlay')); ?></li>
                     </ul>
                </li> 
                <?php if (areaIsVisible()) :?>
                 <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Filtre Destinataire <b class="caret"></b></a>
                     <ul class="dropdown-menu">
                         <li><?php echo $this->Html->link('Tous', array('action' => 'index',isset($this->params->pass[0]) ? $this->params->pass[0] : 'tous',isset($this->params->pass[1]) ? $this->params->pass[1] : 'tous','tous'),array('class'=>'showoverlay')); ?></li>
                         <li><?php echo $this->Html->link('Moi', array('action' => 'index',isset($this->params->pass[0]) ? $this->params->pass[0] : 'tous',isset($this->params->pass[1]) ? $this->params->pass[1] : 'tous',  userAuth('id')),array('class'=>'showoverlay')); ?></li>
                         <li class="divider"></li>
                         <li><?php echo $this->Html->link('Mon équipe', array('action' => 'index',isset($this->params->pass[0]) ? $this->params->pass[0] : 'tous',isset($this->params->pass[1]) ? $this->params->pass[1] : 'tous',  'equipe'),array('class'=>'showoverlay')); ?></li>
                         <li class="divider"></li>
                         <?php foreach ($responsables as $responsable): ?>
                            <li><?php echo $this->Html->link($responsable['Utilisateur']['NOMLONG'], array('action' => 'index',isset($this->params->pass[0]) ? $this->params->pass[0] : 'tous',isset($this->params->pass[1]) ? $this->params->pass[1] : 'tous',$responsable['Utilisateur']['id']),array('class'=>'showoverlay')); ; ?></li>
                         <?php endforeach; ?>
                     </ul>
                 </li> 
                 <?php  endif; ?>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicons check"></span> Actions groupées <b class="caret"></b></a>
                     <ul class="dropdown-menu">
                     <li><?php echo $this->Html->link('Supprimer', "#",array('id'=>'deletelink','class'=>'showoverlay')); ?></li>
                     <li><?php echo $this->Html->link('Terminer', "#",array('id'=>'closelink','class'=>'showoverlay')); ?></li>
                     </ul>
                </li>                 
                </ul> 
                <?php echo $this->Form->create("Action",array('action' => 'search','class'=>'navbar-form clearfix pull-right','inputDefaults' => array('label'=>false,'div' => false))); ?>
                    <?php echo $this->Form->input('SEARCH',array('placeholder'=>'Recherche dans tous les champs')); ?>
                    <button type="submit" class="btn showoverlay">Rechercher</button>
                <?php echo $this->Form->end(); ?> 
                <ul class="nav pull-right">
                    <li><a href="#" rel="popover" data-title="Aide" data-placement="bottom" data-content="<?php echo $this->element('hlp/hlp-action'); ?>"><span><span class="glyphicons blue circle_question_mark size14"></span></span></a></li>
                </ul>
                </div>
            </div>
        </div>
        <?php if ($this->params['action']=='index') { ?><code class="text-normal"  style="margin-bottom: 10px;display: block;"><em>Liste des actions avec <?php echo $fpriorite; ?>, <?php echo $fetat; ?> <?php echo $fresponsable; ?></em></code><?php } ?>        
        <table cellpadding="0" cellspacing="0" class="table table-bordered table-striped table-hover">
        <thead>
	<tr>
                        <th style="text-align:center;width:15px !important;vertical-align: middle;padding-left:5px;"><?php echo $this->Form->input('checkall',array('type'=>'checkbox','label'=>false)) ; ?>
                                <?php echo $this->Form->input('all_ids',array('type'=>'hidden')) ; ?>
                        </th>   
                        <th width="5px">&nbsp;</th>
			<th><?php echo $this->Paginator->sort('Domaine.NOM','Domaine'); ?></th>
			<th><?php echo $this->Paginator->sort('Utilisateur.NOMLONG','Emetteur'); ?></th>
                        <th><?php echo $this->Paginator->sort('Action.destinataire_nom','Destinataire'); ?></th>
			<th><?php echo $this->Paginator->sort('OBJET','Objet'); ?></th>
			<th width='90px'><?php echo $this->Paginator->sort('AVANCEMENT','% avancement'); ?></th>
			<th width='60px'><?php echo $this->Paginator->sort('DEBUT','Date de début'); ?></th>
			<th width='60px'><?php echo $this->Paginator->sort('ECHEANCE','Echéance'); ?></th>
			<th width='50px'><?php echo $this->Paginator->sort('STATUT','Statut'); ?></th>
                        <th width='50px'><?php echo $this->Paginator->sort('CRA','CRA'); ?></th>
			<th width='80px'><?php echo $this->Paginator->sort('DUREEPREVUE','Charge prévue'); ?></th>
			<th width="50px"><?php echo $this->Paginator->sort('PRIORITE','Priorité'); ?></th>
			<th class="actions" width='80px'><?php echo __('Actions'); ?></th>
	</tr>
        </thead>
        <tbody>
        <?php if (isset($actions)): ?>
	<?php foreach ($actions as $action): ?>
	<tr>
                <td style="text-align:center;padding-left:5px;vertical-align: middle;"><?php echo $this->Form->input('id',array('type'=>'checkbox','label'=>false,'class'=>'idselect','value'=>$action['Action']['id'])) ; ?></td>  
                <?php $tooltip = $action['Action']['NIVEAU'] != null ? 'Risque identifié de niveau '.$action['Action']['NIVEAU'].' / 5' : 'Aucun risque identifié' ; ?>
                <td style="background-color:<?php echo colorNiveauRisque($action['Action']['NIVEAU']) ?>"><span class="cursor" style="display:block;line-height:40px;" rel='tooltip' data-title="<?php echo $tooltip; ?>">&nbsp;</span></td>
                <td><?php echo h($action['Domaine']['NOM']); ?>&nbsp;</td>
		<td><?php echo h($action['Utilisateur']['NOM']." ".$action['Utilisateur']['PRENOM']); ?>&nbsp;</td>
                <td><?php echo h($action['Action']['destinataire_nom']); ?>&nbsp;</td>
                <td><?php echo h($action['Action']['OBJET']); ?>
                    <?php if($action['Action']['NEW']==1): ?>
                    <span class="pull-right"><span class="glyphicons asterisk size8 orange" rel="tooltip" data-title="Nouvelle action en date du <?php echo h($action['Action']['created']); ?>"></span></span>&nbsp;
                    <?php endif; ?>
                </td>
                <?php $style = styleBarre(h($action['Action']['AVANCEMENT'])); ?>
		<td>
                <a href="#" class="reculer cursor showoverlay" style="float:left;margin-left: -8px;margin-right:2px;" idaction="<?php echo $action['Action']['id']; ?>" avancement="<?php echo isset($action['Action']['AVANCEMENT']) ? $action['Action']['AVANCEMENT'] : '0'; ?>"><span class="glyphicons circle_arrow_left top3"></span></a>
                <div class="progress progress-<?php echo $style; ?>" style="margin-bottom:-10px;width: 80%;float: left;">
                <div class="bar" style="width:<?php echo h($action['Action']['AVANCEMENT']); ?>%;" rel="tooltip" title="Avancement à : <?php echo h($action['Action']['AVANCEMENT']); ?>%" idaction="<?php echo $action['Action']['id']; ?>" avancement="<?php echo isset($action['Action']['AVANCEMENT']) ? $action['Action']['AVANCEMENT'] : '0'; ?>"><?php echo $action['Action']['AVANCEMENT'] > 0 ? $action['Action']['AVANCEMENT']."%" : ''; ?></div></div>
                <a href="#" class="avancer cursor showoverlay" style="float:right;margin-right: -8px;" idaction="<?php echo $action['Action']['id']; ?>" avancement="<?php echo isset($action['Action']['AVANCEMENT']) ? $action['Action']['AVANCEMENT'] : '0'; ?>"><span class="glyphicons circle_arrow_right top3"></span></a></td>
		<td style="text-align:center;"><?php echo h($action['Action']['DEBUT']); ?>&nbsp;</td>
                <?php $classtd = enretard($action['Action']['ECHEANCE'],$action['Action']['STATUT']) ? "class='td-error'" : ""; ?>
		<td <?php echo $classtd; ?> style="text-align:center;"><?php echo h($action['Action']['ECHEANCE']); ?>&nbsp;</td>
		<td style="text-align:center;"><?php $image = isset($action['Action']['STATUT']) ? etatAction(h($action['Action']['STATUT'])) : 'blank' ; ?>
                    <a href="#" class="changeetat cursor showoverlay" idaction="<?php echo $action['Action']['id']; ?>" ><span class="glyphicons <?php echo $image; ?>" rel="tooltip" data-title="<?php echo etatTooltip(h($action['Action']['STATUT'])); ?>"></span></a></td>
		<td style="text-align:center;"><?php $image = (isset($action['Action']['CRA']) && $action['Action']['CRA']==true) ? 'ok_2' : 'ok_2 disabled' ; ?>
                    <a href="#" class="incra cursor showoverlay" idaction="<?php echo $action['Action']['id']; ?>" ><span class="glyphicons <?php echo $image; ?>" rel="tooltip" data-title="Visible dans le CRA ou non"></span></a></td>               
                <td style="text-align:center;">
                    <a href="#" class="moins cursor showoverlay" style="float:left;margin-left: 3px;margin-right:2px;" idaction="<?php echo $action['Action']['id']; ?>" duree="<?php echo $action['Action']['DUREEPREVUE']; ?>"><span class="glyphicons circle_minus top3"></sapn></a>
                    <span rel="tooltip" data-title="<?php echo CHours2Days($action['Action']['DUREEPREVUE']); ?> jour(s)" style="float: left;width: 55%;"><?php echo h($action['Action']['DUREEPREVUE']); ?> h</span>
                    <a href="#" class="plus cursor showoverlay" style="float:left;" idaction="<?php echo $action['Action']['id']; ?>" duree="<?php echo $action['Action']['DUREEPREVUE']; ?>"><span class="glyphicons circle_plus top3"></a>
                </td>
		<td style="text-align:center;" class="<?php echo $action['Action']['PRIORITE']; ?>"><?php echo h($action['Action']['PRIORITE']); ?>&nbsp;</td>
		<td class="actions">
                    <?php if (userAuth('profil_id')!='2' && isAuthorized('actions', 'view')) : ?>
                    <?php echo '<span><span rel="tooltip" data-title="Cliquez pour avoir un aperçu"><span class="glyphicons eye_open" rel="popover" data-title="<h3>Action :</h3>" data-content="<contenttitle>Commentaire : </contenttitle>'.h($action['Action']['COMMENTAIRE']).'<br/><contenttitle>Crée le: </contenttitle>'.h($action['Action']['created']).'<br/><contenttitle>Modifié le: </contenttitle>'.h($action['Action']['modified']).'" data-trigger="click" style="cursor: pointer;"></span></span></span>'; ?>&nbsp;
                    <?php endif; ?>
                    <?php if (userAuth('profil_id')!='2' && isAuthorized('actions', 'edit')) : ?>
                    <?php echo $this->Html->link('<span class="glyphicons pencil" rel="tooltip" data-title="Modification"></span>', array('action' => 'edit', $action['Action']['id']),array('escape' => false,'class'=>'showoverlay')); ?>&nbsp;
                    <?php endif; ?>
                    <?php if (userAuth('profil_id')!='2' && isAuthorized('actions', 'delete')) : ?>
                    <?php echo $this->Form->postLink('<span class="glyphicons bin" rel="tooltip" data-title="Suppression"></span>', array('action' => 'delete', $action['Action']['id']),array('escape' => false), __('Etes-vous certain de vouloir supprimer cette action ?')); ?>                    
                    <?php endif; ?>
                    <?php if (userAuth('profil_id')!='2' && isAuthorized('actions', 'duplicate')) : ?>
                    <?php echo $this->Form->postLink('<span class="glyphicons retweet" rel="tooltip" data-title="Duplication"></span>', array('action' => 'dupliquer', $action['Action']['id']),array('escape' => false), __('Etes-vous certain de vouloir dupliquer cette action ?\r\nCette action vous sera attribuée.')); ?>
                    <?php endif; ?>                        
                </td>
	</tr>
        <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
	</table>
	<div class="pull-left"><?php echo $this->Paginator->counter('Page {:page} sur {:pages}'); ?></div>
	<div class="pull-right"><?php echo $this->Paginator->counter('Nombre total d\'éléments : {:count}'); ?></div>     
	<div class="pagination pagination-centered">
        <ul>
	<?php
                echo "<li>".$this->Paginator->first('<<', true, null, array('class' => 'disabled showoverlay'))."</li>";
		echo "<li>".$this->Paginator->prev('<', array(), null, array('class' => 'prev disabled showoverlay'))."</li>";
		echo "<li>".$this->Paginator->numbers(array('separator' => '','class'=>'showoverlay'))."</li>";
		echo "<li>".$this->Paginator->next('>', array(), null, array('class' => 'disabledshowoverlay'))."</li>";
                echo "<li>".$this->Paginator->last('>>', true, null, array('class' => 'disabled showoverlay'))."</li>";
	?>
        </ul>
	</div>
        <div id="content-timeline">
        <div style="width:100%;text-align:center;"><?php echo $this->Html->link('Aujourd\'hui ⇣',"#",array('class'=>'btn btn-default',"onclick"=>"javascript:centerTimeline();")); ?></div>
        <br>
        <div id="timeline" style="width:100%;min-height:80px;"></div>
        </div>
</div>
<script>
$(document).ready(function () {
    //setTimeout(function() {$('#ActionsRefresh').load('<?php echo $this->params->here; ?>}, 60000); 
    /** PopOver **/ 
        $("[rel=popover]").popover({placement:'bottom',trigger:'manual',html:true});
        $("[rel=tooltip]").tooltip({placement:'bottom',trigger:'hover',html:true});
  
    $(document).on('click','.avancer',function(e){
        var id = $(this).attr('idaction');
        var avancement = parseInt($(this).attr('avancement'))+10;
        var $bar = $(this).parent().find('.bar');
        if (avancement <= 100){
            $.ajax({
                dataType: "html",
                type: "POST",
                url: "<?php echo $this->Html->url(array('controller'=>'actions','action'=>'progressavancement')); ?>/",
                data: ({id:id,avancement:avancement})
            }).done(function ( data ) {
                location.reload();
            });
        }
    }); 
    
    $(document).on('click','.reculer',function(e){
        var id = $(this).attr('idaction');
        var avancement = parseInt($(this).attr('avancement'))-10;
        var $bar = $(this).parent().find('.bar'); 
        if (avancement >= 0){
            $.ajax({
                dataType: "html",
                type: "POST",
                url: "<?php echo $this->Html->url(array('controller'=>'actions','action'=>'progressavancement')); ?>/",
                data: ({id:id,avancement:avancement})
            }).done(function ( data ) {
                location.reload();
            });
        }
    }); 
    
    $(document).on('click','.changeetat',function(e){
        var id = $(this).attr('idaction');
        $.ajax({
            dataType: "html",
            type: "POST",
            url: "<?php echo $this->Html->url(array('controller'=>'actions','action'=>'progressstatut')); ?>/",
            data: ({id:id})
        }).done(function ( data ) {
            location.reload();
        });
    }); 
    
    $(document).on('click','.incra',function(e){
        var id = $(this).attr('idaction');
        $.ajax({
            dataType: "html",
            type: "POST",
            url: "<?php echo $this->Html->url(array('controller'=>'actions','action'=>'incra')); ?>/",
            data: ({id:id})
        }).done(function ( data ) {
            location.reload();
        });
    });    
    
    $(document).on('click','.plus',function(e){
        var id = $(this).attr('idaction');
        var duree = parseInt($(this).attr('duree'))+2;
        var $bar = $(this).parent().find('.bar');
        $.ajax({
            dataType: "html",
            type: "POST",
            url: "<?php echo $this->Html->url(array('controller'=>'actions','action'=>'progressduree')); ?>/",
            data: ({id:id,duree:duree})
        }).done(function ( data ) {
            location.reload();
        });
    }); 
    
    $(document).on('click','.moins',function(e){
        var id = $(this).attr('idaction');
        var duree = parseInt($(this).attr('duree'))-2;
        var $bar = $(this).parent().find('.bar');   
        if(duree >= 0){
            $.ajax({
                dataType: "html",
                type: "POST",
                url: "<?php echo $this->Html->url(array('controller'=>'actions','action'=>'progressduree')); ?>/",
                data: ({id:id,duree:duree})
            }).done(function ( data ) {
                location.reload();
            });
        }
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
        
        $(document).on('click','#deletelink',function(e){
            if(confirm("Voulez-vous supprimer toutes les actions sélectionnées ?")){
                var ids = $("#all_ids").val();
                var myarr = ids.split("-");
                var length = myarr.length;
                var overlay = $('#overlay');
                for(var i = 0; i < length; i++){
                    //alert(myarr[i]); 
                    overlay.show();
                    $.ajax({
                        dataType: "html",
                        type: "POST",
                        url: "<?php echo $this->Html->url(array('controller'=>'actions','action'=>'deleteall')); ?>/"+myarr[i],
                        success: function(){
                            if (i === length) {
                            overlay.hide();
                            location.reload();
                            $(this).parents().find(':checkbox').prop('checked', false); 
                            $("#all_ids").val('');
                            }                    
                        },
                        error: function(){
                            if (i === length) {
                            overlay.hide();
                            location.reload();
                            $(this).parents().find(':checkbox').prop('checked', false); 
                            $("#all_ids").val('');
                            }                    
                        }                        
                    });
                }
            }  
        });    
        
        $(document).on('click','#closelink',function(e){
            if(confirm("Voulez-vous clore toutes les actions sélectionnées ?")){
                var ids = $("#all_ids").val();
                var myarr = ids.split("-");
                var length = myarr.length;
                var overlay = $('#overlay');
                overlay.show(); 
                for(var i = 0; i < length; i++){
                    $.ajax({
                        dataType: "html",
                        type: "POST",
                        url: "<?php echo $this->Html->url(array('controller'=>'actions','action'=>'closeall')); ?>/"+myarr[i],
                        success: function(){
                            if (i === length) {
                            overlay.hide();
                            location.reload();
                            $(this).parents().find(':checkbox').prop('checked', false); 
                            $("#all_ids").val('');
                            }                    
                        },
                        error: function(){
                            if (i === length) {
                            overlay.hide();
                            location.reload();
                            $(this).parents().find(':checkbox').prop('checked', false); 
                            $("#all_ids").val('');
                            }                    
                        }                        
                    });
                }
             }
        });           
});
</script>
