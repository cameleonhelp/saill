<div class="actions index" id="ActionsRefresh">
        <?php //filtres par défaut
        $pass0 = isset($this->params->pass[0]) ? $this->params->pass[0] : 'tous';
        $pass1 = isset($this->params->pass[1]) ? $this->params->pass[1] : 'tous';
        $pass2 = isset($this->params->pass[2]) ? $this->params->pass[2] : 'tous';
        $pass3 = isset($this->params->pass[3]) ? $this->params->pass[3] : 'tous'; //userAuth('id');
        ?>       
        <nav class="navbar toolbar marginright20">
                <ul class="nav navbar-nav toolbar">
                <?php if (userAuth('profil_id')!='2' && isAuthorized('actions', 'add')) : ?>
                <li><?php echo $this->Html->link('<span class="glyphicons plus size14 margintop4" rel="tooltip" data-container="body" data-title="Ajoutez une action"></span>', array('action' => 'add'),array('escape' => false,'class'=>'showoverlay')); ?></li>
                <li class="divider-vertical-only"></li>
                <?php endif; ?>
                <li class="dropdown <?php echo filtre_is_actif(isset($pass0) ? $pass0 : 'tous','tous'); ?>">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Filtre Priorité <b class="caret"></b></a>
                     <ul class="dropdown-menu">
                         <li><?php echo $this->Html->link('Tous', array('action' => 'index','tous',isset($pass1) ? $pass1 : 'tous',isset($pass2) ? $pass2 : 'tous',$pass3),array('class'=>'showoverlay'.subfiltre_is_actif(isset($pass0) ? $pass0 : 'tous','tous'))); ?></li>
                         <li class="divider"></li>
                         <li><?php echo $this->Html->link('Normale', array('action' => 'index','1',isset($pass1) ? $pass1 : 'tous',isset($pass2) ? $pass2 : 'tous',$pass3),array('class'=>'showoverlay'.subfiltre_is_actif(isset($pass0) ? $pass0 : 'tous','1'))); ?></li>
                         <li><?php echo $this->Html->link('Moyenne', array('action' => 'index','2',isset($pass1) ? $pass1 : 'tous',isset($pass2) ? $pass2 : 'tous',$pass3),array('class'=>'showoverlay'.subfiltre_is_actif(isset($pass0) ? $pass0 : 'tous','2'))); ?></li>
                         <li><?php echo $this->Html->link('Haute', array('action' => 'index','3',isset($pass1) ? $pass1 : 'tous',isset($pass2) ? $pass2 : 'tous',$pass3),array('class'=>'showoverlay'.subfiltre_is_actif(isset($pass0) ? $pass0 : 'tous','3'))); ?></li>
                     </ul>
                </li>
                <li class="dropdown <?php echo filtre_is_actif(isset($pass1) ? $pass1 : 'tous','tous'); ?>">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Filtre Etats <b class="caret"></b></a>
                     <ul class="dropdown-menu">
                         <li><?php echo $this->Html->link('Tous', array('action' => 'index',isset($pass0) ? $pass0 : 'tous','tous',isset($pass2) ? $pass2 : 'tous',$pass3),array('class'=>'showoverlay'.subfiltre_is_actif(isset($pass1) ? $pass1 : 'tous','tous'))); ?></li>
                         <li class="divider"></li>
                         <li><?php echo $this->Html->link('Nouvelles', array('action' => 'index',isset($pass0) ? $pass0 : 'tous','news',isset($pass2) ? $pass2 : 'tous',$pass3),array('class'=>'showoverlay'.subfiltre_is_actif(isset($pass1) ? $pass1 : 'tous','news'))); ?></li>
                         <li class="divider"></li>                         
                         <li><?php echo $this->Html->link('A faire', array('action' => 'index',isset($pass0) ? $pass0 : 'tous','1',isset($pass2) ? $pass2 : 'tous',$pass3),array('class'=>'showoverlay'.subfiltre_is_actif(isset($pass1) ? $pass1 : 'tous','1'))); ?></li>
                         <li><?php echo $this->Html->link('En cours', array('action' => 'index',isset($pass0) ? $pass0 : 'tous','2',isset($pass2) ? $pass2 : 'tous',$pass3),array('class'=>'showoverlay'.subfiltre_is_actif(isset($pass1) ? $pass1 : 'tous','2'))); ?></li>
                         <li><?php echo $this->Html->link('Terminée', array('action' => 'index',isset($pass0) ? $pass0 : 'tous','3',isset($pass2) ? $pass2 : 'tous',$pass3),array('class'=>'showoverlay'.subfiltre_is_actif(isset($pass1) ? $pass1 : 'tous','3'))); ?></li>
                         <li><?php echo $this->Html->link('Livrée', array('action' => 'index',isset($pass0) ? $pass0 : 'tous','4',isset($pass2) ? $pass2 : 'tous',$pass3),array('class'=>'showoverlay'.subfiltre_is_actif(isset($pass1) ? $pass1 : 'tous','4'))); ?></li>
                         <li><?php echo $this->Html->link('Annulée', array('action' => 'index',isset($pass0) ? $pass0 : 'tous','5',isset($pass2) ? $pass2 : 'tous',$pass3),array('class'=>'showoverlay'.subfiltre_is_actif(isset($pass1) ? $pass1 : 'tous','5'))); ?></li>
                         <li class="divider"></li>
                         <li><?php echo $this->Html->link('Todolist', array('action' => 'index',isset($pass0) ? $pass0 : 'tous','6',isset($pass2) ? $pass2 : 'tous',$pass3),array('class'=>'showoverlay'.subfiltre_is_actif(isset($pass1) ? $pass1 : 'tous','6'))); ?></li>
                     </ul>
                </li>   
                <li class="dropdown <?php echo filtre_is_actif(isset($pass3) ? $pass3 : 'tous','tous'); ?>">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Filtre Emetteur <b class="caret"></b></a>
                     <ul class="dropdown-menu">                         
                         <li><?php echo $this->Html->link('Tous', array('action' => 'index',isset($pass0) ? $pass0 : 'tous',isset($pass1) ? $pass1 : 'tous',$pass2,  'tous'),array('class'=>'showoverlay'.subfiltre_is_actif(isset($pass3) ? $pass3 : 'tous','tous'))); ?></li>
                         <li><?php echo $this->Html->link('Moi', array('action' => 'index',isset($pass0) ? $pass0 : 'tous',isset($pass1) ? $pass1 : 'tous',$pass2,  userAuth('id')),array('class'=>'showoverlay'.subfiltre_is_actif(isset($pass3) ? $pass3 : 'tous',userAuth('id')))); ?></li>
                         <li class="divider"></li>
                         <?php foreach ($responsables as $responsable): ?>
                            <li><?php echo $this->Html->link($responsable['Utilisateur']['NOMLONG'], array('action' => 'index',isset($pass0) ? $pass0 : 'tous',isset($pass1) ? $pass1 : 'tous',$pass2,$responsable['Utilisateur']['id']),array('class'=>'showoverlay'.subfiltre_is_actif(isset($pass3) ? $pass3 : 'tous',$responsable['Utilisateur']['id']))); ; ?></li>
                         <?php endforeach; ?>
                     </ul>
                 </li>                  
                <?php if (areaIsVisible()) :?>                
                <li class="dropdown <?php echo filtre_is_actif(isset($pass2) ? $pass2 : 'tous',  'tous'); ?>">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Filtre Destinataire <b class="caret"></b></a>
                     <ul class="dropdown-menu">
                         <li><?php echo $this->Html->link('Tous', array('action' => 'index',isset($pass0) ? $pass0 : 'tous',isset($pass1) ? $pass1 : 'tous','tous',$pass3),array('class'=>'showoverlay'.subfiltre_is_actif(isset($pass2) ? $pass2 : 'tous','tous'))); ?></li>
                         <li><?php echo $this->Html->link('Moi', array('action' => 'index',isset($pass0) ? $pass0 : 'tous',isset($pass1) ? $pass1 : 'tous',  userAuth('id'),$pass3),array('class'=>'showoverlay'.subfiltre_is_actif(isset($pass2) ? $pass2 : 'tous',userAuth('id')))); ?></li>
                         <li class="divider"></li>
                         <li><?php echo $this->Html->link('Mon équipe', array('action' => 'index',isset($pass0) ? $pass0 : 'tous',isset($pass1) ? $pass1 : 'tous',  'equipe',$pass3),array('class'=>'showoverlay'.subfiltre_is_actif(isset($pass2) ? $pass2 : 'tous','equipe'))); ?></li>
                         <li class="divider"></li>
                         <?php foreach ($responsables as $responsable): ?>
                            <li><?php echo $this->Html->link($responsable['Utilisateur']['NOMLONG'], array('action' => 'index',isset($pass0) ? $pass0 : 'tous',isset($pass1) ? $pass1 : 'tous',$responsable['Utilisateur']['id'],$pass3),array('class'=>'showoverlay'.subfiltre_is_actif(isset($pass2) ? $pass2 : 'tous',$responsable['Utilisateur']['id']))); ; ?></li>
                         <?php endforeach; ?>
                     </ul>
                 </li>                 
                 <?php  endif; ?>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicons check"></span> Actions groupées <b class="caret"></b></a>
                     <ul class="dropdown-menu">
                     <li><?php echo $this->Html->link('Supprimer', "#",array('id'=>'deletelink','class'=>'showoverlay')); ?></li>
                     <li><?php echo $this->Html->link('Terminer', "#",array('id'=>'closelink','class'=>'showoverlay')); ?></li>
                     <li><?php echo $this->Html->link('CRA', "#",array('id'=>'cralink','class'=>'showoverlay')); ?></li>
                     </ul>
                </li>  
                 <li class="divider-vertical-only"></li>
                <li><?php echo $this->Html->link('<span class="ico-xls" rel="tooltip" data-container="body" data-title="Export Excel"></span>', array('action' => 'export_xls'),array('escape' => false)); ?></li>
                <li class="divider-vertical-only"></li>                
                </ul> 
                <?php echo $this->Form->create("Action",array('action' => 'search', 'class'=>'toolbar-form pull-right','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?>
                    <?php echo $this->Form->input('SEARCH',array('placeholder'=>'Recherche ...','style'=>"width: 200px;",'class'=>"form-control")); ?>
                    <button type="submit" class="btn form-btn showoverlay">Rechercher</button>
                <?php echo $this->Form->end(); ?> 
                <ul class="nav navbar-nav toolbar pull-right">
                    <li><?php echo $this->Html->link('<span class="glyphicons blue circle_question_mark size14 margintop4"></span>', '#',array('escape' => false,'class'=>'showoverlay','data-rel'=>"popover",'data-title'=>"Aide", 'data-placement'=>"bottom", 'data-content'=>$this->element('hlp/hlp-action'))); ?></li>
                </ul>
        </nav>
        <?php if ($this->params['action']=='index') { ?><div class="panel-body panel-filter marginbottom15 marginright20">
            <strong>Filtre appliqué : </strong><em>Liste des actions avec <?php echo $fpriorite; ?>, <?php echo $fetat; ?> ayant pour émetteur  <?php echo $femetteur; ?> et pour destinataire <?php echo $fresponsable; ?></em></div><?php } ?>        
    <div class="marginright10">    
    <table cellpadding="0" cellspacing="0" class="table table-bordered table-striped table-hover" style="width:99.5%;">
        <thead>
	<tr>
                        <th style="min-width:80px;"><?php echo $this->Paginator->sort('id','N°'); ?></th>
                        <th style="text-align:center;width:15px !important;vertical-align: middle;padding-left:5px;"><?php echo $this->Form->input('checkall',array('type'=>'checkbox','label'=>false)) ; ?>
                                <?php echo $this->Form->input('all_ids',array('type'=>'hidden')) ; ?>
                        </th>   
                        <th width="5px">&nbsp;</th>
			<th><?php echo $this->Paginator->sort('Domaine.NOM','Domaine'); ?></th>
			<th><?php echo $this->Paginator->sort('Utilisateur.NOMLONG','Emetteur'); ?></th>
                        <th><?php echo $this->Paginator->sort('Action.destinataire_nom','Destinataire'); ?></th>
			<th><?php echo $this->Paginator->sort('OBJET','Objet'); ?></th>
			<th width='120px'><?php echo $this->Paginator->sort('AVANCEMENT','% avancement'); ?></th>
			<th width='60px'><?php echo $this->Paginator->sort('DEBUT','Date de début'); ?></th>
			<th width='80px'><?php echo $this->Paginator->sort('ECHEANCE','Echéance'); ?></th>
			<th width='50px'><?php echo $this->Paginator->sort('STATUT','Statut'); ?></th>
                        <th width='50px'><?php echo $this->Paginator->sort('CRA','CRA'); ?></th>
			<th width='90px'><?php echo $this->Paginator->sort('DUREEPREVUE','Charge prévue'); ?></th>
			<th width="50px"><?php echo $this->Paginator->sort('PRIORITE','Priorité'); ?></th>
			<th class="actions" width='80px'><?php echo __('Actions'); ?></th>
	</tr>
        </thead>
        <tbody>
        <?php if (isset($actions)): ?>
	<?php foreach ($actions as $action): ?>
	<tr>
                <td style="white-space:nowrap !important;"><?php echo 'A-'.strYear($action['Action']['created']).'-'.$action['Action']['id']; ?></td>
                <td style="text-align:center;"><?php echo $this->Form->input('id',array('type'=>'checkbox','label'=>false,'class'=>'idselect nopadding','value'=>$action['Action']['id'])) ; ?></td>  
                <?php $tooltip = $action['Action']['NIVEAU'] != null ? 'Risque identifié de niveau '.$action['Action']['NIVEAU'].' / 5' : 'Aucun risque identifié' ; ?>
                <td style="background-color:<?php echo colorNiveauRisque($action['Action']['NIVEAU']) ?>"><span class="cursor" style="display:block;" rel='tooltip' data-title="<?php echo $tooltip; ?>">&nbsp;</span></td>
                <td><?php echo h($action['Domaine']['NOM']); ?>&nbsp;</td>
		<td><?php echo h($action['Utilisateur']['NOM']." ".$action['Utilisateur']['PRENOM']); ?>&nbsp;</td>
                <?php $contributeurs = isset($action['Action']['CONTRIBUTEURS']) ? $this->requestAction('utilisateurs/get_nom',array('pass'=>array($action['Action']['CONTRIBUTEURS']))) : 'Aucun contributeur'; ?>
                <?php $contributeurs = $contributeurs != 'Aucun contributeur' ? ';'.$contributeurs : ''; ?>
                <td><?php echo h($action['Action']['destinataire_nom'].$contributeurs); ?>&nbsp;</td>
                <td><?php echo h($action['Action']['OBJET']); ?>
                    <?php if($action['Action']['NEW']==1): ?>
                    <span class="pull-right"><span class="glyphicons asterisk size8 orange" rel="tooltip" data-title="Nouvelle action en date du <?php echo h($action['Action']['created']); ?>"></span></span>&nbsp;
                    <?php endif; ?>
                </td>
                <?php $style = styleBarre(h($action['Action']['AVANCEMENT'])); ?>
		<td>
                    <div class="progress-group margintop5">
                    <span class="glyphicons-progress circle_minus progress-bar-font reculer showoverlay"  idaction="<?php echo $action['Action']['id']; ?>" avancement="<?php echo isset($action['Action']['AVANCEMENT']) ? $action['Action']['AVANCEMENT'] : '0'; ?>"></span>
                    <div class="progress thin thin-col-82">
                      <div class="progress-bar progress-bar-<?php echo $style; ?> thin" id="progress1"  rel="tooltip" title="Avancement à : <?php echo h($action['Action']['AVANCEMENT']); ?>%" data-value="<?php echo h($action['Action']['AVANCEMENT']); ?>" data-step="5" style="width: <?php echo h($action['Action']['AVANCEMENT']); ?>%;"><?php echo $action['Action']['AVANCEMENT'] > 0 ? $action['Action']['AVANCEMENT']."%" : ''; ?></div>
                    </div> 
                    <span class="glyphicons-progress circle_plus progress-bar-font avancer showoverlay" idaction="<?php echo $action['Action']['id']; ?>" avancement="<?php echo isset($action['Action']['AVANCEMENT']) ? $action['Action']['AVANCEMENT'] : '0'; ?>"></span>
                    </div>                    
                </td>
		<td style="text-align:center;"><?php echo h($action['Action']['DEBUT']); ?>&nbsp;</td>
                <?php $classtd = enretard($action['Action']['ECHEANCE'],$action['Action']['STATUT']) ? "class='td-error'" : ""; ?>
		<td <?php echo $classtd; ?> style="text-align:center;"><?php echo h($action['Action']['ECHEANCE']); ?>&nbsp;</td>
		<td style="text-align:center;"><?php $image = isset($action['Action']['STATUT']) ? etatAction(h($action['Action']['STATUT'])) : 'blank' ; ?>
                    <a href="#" class="changeetat cursor showoverlay" idaction="<?php echo $action['Action']['id']; ?>" ><span class="glyphicons <?php echo $image; ?> notchange" rel="tooltip" data-title="<?php echo etatTooltip(h($action['Action']['STATUT'])); ?>"></span></a></td>
		<td style="text-align:center;"><?php $image = (isset($action['Action']['CRA']) && $action['Action']['CRA']==true) ? 'ok_2' : 'ok_2 disabled' ; ?>
                    <a href="#" class="incra cursor showoverlay" idaction="<?php echo $action['Action']['id']; ?>" ><span class="glyphicons <?php echo $image; ?> notchange" rel="tooltip" data-title="Visible dans le CRA ou non"></span></a></td>               
                <td style="text-align:center;">
                    <a href="#" class="moins cursor showoverlay" style="float:left;margin-left: 3px;margin-right:2px;" idaction="<?php echo $action['Action']['id']; ?>" duree="<?php echo $action['Action']['DUREEPREVUE']; ?>"><span class="glyphicons circle_minus notchange top3"></sapn></a>
                    <span rel="tooltip" data-title="<?php echo CHours2Days($action['Action']['DUREEPREVUE']); ?> jour(s)" style="float: left;width: 55%;"><?php echo h($action['Action']['DUREEPREVUE']); ?> h</span>
                    <a href="#" class="plus cursor showoverlay" style="float:left;" idaction="<?php echo $action['Action']['id']; ?>" duree="<?php echo $action['Action']['DUREEPREVUE']; ?>"><span class="glyphicons circle_plus notchange top3"></a>
                </td>
		<td style="text-align:center;" class="<?php echo $action['Action']['PRIORITE']; ?>"><?php echo h($action['Action']['PRIORITE']); ?>&nbsp;</td>
		<td class="actions">
                    <?php if (userAuth('profil_id')!='2' && isAuthorized('actions', 'view')) : ?>
                    <?php echo '<span class="clear"><span rel="tooltip" data-title="Cliquez pour avoir un aperçu"><span class="glyphicons eye_open" data-rel="popover" data-title="<h3>Action :</h3>" data-content="<contenttitle>Commentaire :<br></contenttitle><br>'.h($action['Action']['COMMENTAIRE']).'<br/><contenttitle>Bilan/Résultat :<br></contenttitle><br>'.h($action['Action']['BILAN']).'<br/><contenttitle>Crée le: </contenttitle>'.h($action['Action']['created']).'<br/><contenttitle>Modifié le: </contenttitle>'.h($action['Action']['modified']).'" data-trigger="click" style="cursor: pointer;"></span></span></span>'; ?>
                    <?php endif; ?>
                    <?php if (userAuth('profil_id')!='2' && isAuthorized('actions', 'edit')) : ?>
                    <?php echo $this->Html->link('<span class="glyphicons pencil showoverlay notchange" rel="tooltip" data-title="Modification"></span>', array('action' => 'edit', $action['Action']['id']),array('escape' => false,'class'=>'showoverlay')); ?>
                    <?php endif; ?>
                    <?php if (userAuth('profil_id')!='2' && isAuthorized('actions', 'delete')) : ?>
                    <?php echo $this->Form->postLink('<span class="glyphicons bin notchange" rel="tooltip" data-title="Suppression"></span>', array('action' => 'delete', $action['Action']['id']),array('escape' => false), __('Etes-vous certain de vouloir supprimer cette action ?')); ?>                    
                    <?php endif; ?>
                    <?php if (userAuth('profil_id')!='2' && isAuthorized('actions', 'duplicate')) : ?>
                    <?php echo $this->Form->postLink('<span class="glyphicons showoverlay retweet notchange" rel="tooltip" data-title="Duplication"></span>', array('action' => 'dupliquer', $action['Action']['id']),array('escape' => false), __('Etes-vous certain de vouloir dupliquer cette action ? Cette action vous sera attribuée.')); ?>
                    <?php endif; ?>  
                    <?php echo $this->Html->link('<span class="glyphicons envelope showoverlay notchange" rel="tooltip" data-title="Notifier au destinataire"></span>', array('action' => 'notifier', $action['Action']['id']),array('escape' => false,'class'=>'showoverlay')); ?>
                </td>
	</tr>
        <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
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
        <div id="content-timeline">
        <?php if(count($actions) >0): ?>
        <br>
        <?php $events = $this->requestAction('actions/timelinedata'); ?>
        <?php $myTeam = $this->requestAction('equipes/allMyTeam/'.userAuth('id')); ?>
        <script type="text/javascript">
        $(document).ready(function(){
            var events = [
            <?php 
                foreach($events as $event):
                    $color = '#049CDB';
                    foreach($myTeam as $user):
                        if ($user['Equipe']['agent']==$event['id']):
                            $color = (isset($user['Equipe']['COLOR']) && $user['Equipe']['COLOR']!='') ? $user['Equipe']['COLOR'] : '#049CDB';
                        endif;
                    endforeach;
                    $start = $event['start'];
                    $end = $event['end'];
                    echo "{dates: [new Date(".$start."),new Date(".$end.")], descr:'test', title:\"".h($event['title'])."\", description:\"".$event['description']."\",attrs: {fill: '".$color."',stroke: '".$color."'}},";
                endforeach;
            ?>
            ];
            var timeline = new Chronoline(document.getElementById("chronotime"), events,{animated: true,draggable: true,tooltips:true}); 
            $('#to-today').click(function(e){e.preventDefault(); timeline.goToToday();});
        });
        </script>
        <div id="chronotime" class="timeline-tgt marginright20"></div>
        <?php endif; ?>
        <div style="width:98%;text-align:center;"><?php echo $this->Html->link('⇡ Aujourd\'hui ⇡',"",array('id'=>"to-today",'class'=>'btn btn-sm btn-default')); ?></div>        
        </div>
</div>
<script>
$(document).ready(function () {
    //setTimeout(function() {$('#ActionsRefresh').load('<?php echo $this->params->here; ?>}, 60000); 
    /** PopOver **/ 
    //    $("[rel=popover]").popover({placement:'bottom',trigger:'manual',html:true});
    //    $("[rel=tooltip]").tooltip({placement:'bottom',trigger:'hover',html:true});
  
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
            data: ({all_ids:id})
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
                var overlay = $('#overlay');
                overlay.show(); 
                $.ajax({
                    dataType: "html",
                    type: "POST",
                    url: "<?php echo $this->Html->url(array('controller'=>'actions','action'=>'deleteall')); ?>/",
                    data: ({all_ids:ids})     
                });
            }
            location.reload();
            overlay.hide();   
            $(this).parents().find(':checkbox').prop('checked', false); 
            $("#all_ids").val('');
        });    
        
        $(document).on('click','#closelink',function(e){
            if(confirm("Voulez-vous clore toutes les actions sélectionnées ?")){
                var ids = $("#all_ids").val();
                var overlay = $('#overlay');
                overlay.show(); 
                $.ajax({
                    dataType: "html",
                    type: "POST",
                    url: "<?php echo $this->Html->url(array('controller'=>'actions','action'=>'closeall')); ?>/",
                    data: ({all_ids:ids})     
                });
            }
            location.reload();
            overlay.hide();
            $(this).parents().find(':checkbox').prop('checked', false); 
            $("#all_ids").val('');
        });  
        
        $(document).on('click','#cralink',function(e){
            if(confirm("Voulez-vous modifier ces actions en ce qui concerne leur apparition dans le CRA ?")){
                var ids = $("#all_ids").val();
                var overlay = $('#overlay');
                overlay.show(); 
                $.ajax({
                    dataType: "html",
                    type: "POST",
                    url: "<?php echo $this->Html->url(array('controller'=>'actions','action'=>'incra')); ?>/",
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
