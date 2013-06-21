<div class="actions index" id="ActionsRefresh">
        <div class="navbar">
            <div class="navbar-inner">
                <div class="container">
                <ul class="nav">
                <?php if (userAuth('profil_id')!='2' && isAuthorized('actions', 'add')) : ?>
                <li><?php echo $this->Html->link('<i class="icon-plus" rel="tooltip" data-title="Ajoutez une action"></i>', array('action' => 'add'),array('escape' => false)); ?></li>
                <li class="divider-vertical-only"></li>
                <?php endif; ?>
                <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Filtre Priorité <b class="caret"></b></a>
                     <ul class="dropdown-menu">
                         <li><?php echo $this->Html->link('Tous', array('action' => 'index','tous',isset($this->params->pass[1]) ? $this->params->pass[1] : 'tous',isset($this->params->pass[2]) ? $this->params->pass[2] : 'tous')); ?></li>
                         <li class="divider"></li>
                         <li><?php echo $this->Html->link('Normale', array('action' => 'index','1',isset($this->params->pass[1]) ? $this->params->pass[1] : 'tous',isset($this->params->pass[2]) ? $this->params->pass[2] : 'tous')); ?></li>
                         <li><?php echo $this->Html->link('Moyenne', array('action' => 'index','2',isset($this->params->pass[1]) ? $this->params->pass[1] : 'tous',isset($this->params->pass[2]) ? $this->params->pass[2] : 'tous')); ?></li>
                         <li><?php echo $this->Html->link('Haute', array('action' => 'index','3',isset($this->params->pass[1]) ? $this->params->pass[1] : 'tous',isset($this->params->pass[2]) ? $this->params->pass[2] : 'tous')); ?></li>
                     </ul>
                </li>
                <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Filtre Etats <b class="caret"></b></a>
                     <ul class="dropdown-menu">
                         <li><?php echo $this->Html->link('Tous', array('action' => 'index',isset($this->params->pass[0]) ? $this->params->pass[0] : 'tous','tous',isset($this->params->pass[2]) ? $this->params->pass[2] : 'tous')); ?></li>
                         <li class="divider"></li>
                         <li><?php echo $this->Html->link('A faire', array('action' => 'index',isset($this->params->pass[0]) ? $this->params->pass[0] : 'tous','1',isset($this->params->pass[2]) ? $this->params->pass[2] : 'tous')); ?></li>
                         <li><?php echo $this->Html->link('En cours', array('action' => 'index',isset($this->params->pass[0]) ? $this->params->pass[0] : 'tous','2',isset($this->params->pass[2]) ? $this->params->pass[2] : 'tous')); ?></li>
                         <li><?php echo $this->Html->link('Terminée', array('action' => 'index',isset($this->params->pass[0]) ? $this->params->pass[0] : 'tous','3',isset($this->params->pass[2]) ? $this->params->pass[2] : 'tous')); ?></li>
                         <li><?php echo $this->Html->link('Livrée', array('action' => 'index',isset($this->params->pass[0]) ? $this->params->pass[0] : 'tous','4',isset($this->params->pass[2]) ? $this->params->pass[2] : 'tous')); ?></li>
                         <li><?php echo $this->Html->link('Annulée', array('action' => 'index',isset($this->params->pass[0]) ? $this->params->pass[0] : 'tous','5',isset($this->params->pass[2]) ? $this->params->pass[2] : 'tous')); ?></li>
                         <li class="divider"></li>
                         <li><?php echo $this->Html->link('Todolist', array('action' => 'index',isset($this->params->pass[0]) ? $this->params->pass[0] : 'tous','6',isset($this->params->pass[2]) ? $this->params->pass[2] : 'tous')); ?></li>
                     </ul>
                </li> 
                <?php if (areaIsVisible()) :?>
                 <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Filtre Destinataire <b class="caret"></b></a>
                     <ul class="dropdown-menu">
                         <li><?php echo $this->Html->link('Tous', array('action' => 'index',isset($this->params->pass[0]) ? $this->params->pass[0] : 'tous',isset($this->params->pass[1]) ? $this->params->pass[1] : 'tous','tous')); ?></li>
                         <li><?php echo $this->Html->link('Moi', array('action' => 'index',isset($this->params->pass[0]) ? $this->params->pass[0] : 'tous',isset($this->params->pass[1]) ? $this->params->pass[1] : 'tous',  userAuth('id'))); ?></li>
                         <li class="divider"></li>
                         <?php foreach ($responsables as $responsable): ?>
                            <li><?php echo $this->Html->link($responsable['Utilisateur']['NOMLONG'], array('action' => 'index',isset($this->params->pass[0]) ? $this->params->pass[0] : 'tous',isset($this->params->pass[1]) ? $this->params->pass[1] : 'tous',$responsable['Utilisateur']['id'])); ; ?></li>
                         <?php endforeach; ?>
                     </ul>
                 </li> 
                 <?php  endif; ?>
                </ul> 
                <?php echo $this->Form->create("Action",array('action' => 'search','class'=>'navbar-form clearfix pull-right','inputDefaults' => array('label'=>false,'div' => false))); ?>
                    <?php echo $this->Form->input('SEARCH',array('class'=>'span8','placeholder'=>'Recherche dans tous les champs')); ?>
                    <button type="submit" class="btn">Rechercher</button>
                <?php echo $this->Form->end(); ?>               
                </div>
            </div>
        </div>
        <?php if ($this->params['action']=='index') { ?><code class="text-normal"  style="margin-bottom: 10px;display: block;"><em>Liste des actions avec <?php echo $fpriorite; ?>, <?php echo $fetat; ?> <?php echo $fresponsable; ?></em></code><?php } ?>        
        <table cellpadding="0" cellspacing="0" class="table table-bordered table-striped table-hover">
        <thead>
	<tr>
			<th><?php echo $this->Paginator->sort('Domaine.NOM','Domaine'); ?></th>
			<th><?php echo $this->Paginator->sort('Destinataire.NOMLGDEST','Emetteur de l\'action'); ?></th>
			<th><?php echo $this->Paginator->sort('OBJET','Objet'); ?></th>
			<th width='90px'><?php echo $this->Paginator->sort('AVANCEMENT','% avancement'); ?></th>
			<th width='90px'><?php echo $this->Paginator->sort('DEBUT','Date de début'); ?></th>
			<th width='90px'><?php echo $this->Paginator->sort('ECHEANCE','Echéance'); ?></th>
			<th width='60px'><?php echo $this->Paginator->sort('STATUT','Statut'); ?></th>
                        <th width='60px'><?php echo $this->Paginator->sort('CRA','CRA'); ?></th>
			<th width='65px'><?php echo $this->Paginator->sort('DUREEPREVUE','Durée prévue'); ?></th>
			<th width="70px"><?php echo $this->Paginator->sort('PRIORITE','Priorité'); ?></th>
			<th class="actions" width='75px'><?php echo __('Actions'); ?></th>
	</tr>
        </thead>
        <tbody>
        <?php if (isset($actions)): ?>
	<?php foreach ($actions as $action): ?>
	<tr>
		<td><?php echo h($action['Domaine']['NOM']); ?>&nbsp;</td>
		<td><?php echo h($action['Utilisateur']['NOM']." ".$action['Utilisateur']['PRENOM']); ?>&nbsp;</td>
                <td><?php echo h($action['Action']['OBJET']); ?>
                    <?php if($action['Action']['NEW']==1): ?>
                    <span class="pull-right"><i class="icon-asterisk" rel="tooltip" data-title="Nouvelle action en date du <?php echo h($action['Action']['created']); ?>"></i></span>&nbsp;
                    <?php endif; ?>
                </td>
                <?php $style = styleBarre(h($action['Action']['AVANCEMENT'])); ?>
		<td>
                <a href="#" class="reculer cursor" style="float:left;margin-left: -8px;margin-right:2px;" idaction="<?php echo $action['Action']['id']; ?>" avancement="<?php echo $action['Action']['AVANCEMENT']; ?>"><i class="icon-circle-arrow-left"></i></a>
                <div class="progress progress-<?php echo $style; ?>" style="margin-bottom:-10px;width: 80%;float: left;">
                <div class="bar" style="width:<?php echo h($action['Action']['AVANCEMENT']); ?>%;" rel="tooltip" title="Avancement à : <?php echo h($action['Action']['AVANCEMENT']); ?>%" idaction="<?php echo $action['Action']['id']; ?>" avancement="<?php echo $action['Action']['AVANCEMENT']; ?>"><?php echo $action['Action']['AVANCEMENT'] > 0 ? $action['Action']['AVANCEMENT']."%" : ''; ?></div></div>
                <a href="#" class="avancer cursor" style="float:right;margin-right: -8px;" idaction="<?php echo $action['Action']['id']; ?>" avancement="<?php echo $action['Action']['AVANCEMENT']; ?>"><i class="icon-circle-arrow-right"></i></a></td>
		<td style="text-align:center;"><?php echo h($action['Action']['DEBUT']); ?>&nbsp;</td>
                <?php $classtd = enretard($action['Action']['ECHEANCE'],$action['Action']['STATUT']) ? "class='td-error'" : ""; ?>
		<td <?php echo $classtd; ?> style="text-align:center;"><?php echo h($action['Action']['ECHEANCE']); ?>&nbsp;</td>
		<td style="text-align:center;"><?php $image = isset($action['Action']['STATUT']) ? etatAction(h($action['Action']['STATUT'])) : 'icon-blank' ; ?>
                    <a href="#" class="changeetat cursor" idaction="<?php echo $action['Action']['id']; ?>" ><i class="<?php echo $image; ?>" rel="tooltip" data-title="<?php echo etatTooltip(h($action['Action']['STATUT'])); ?>"></i></a></td>
		<td style="text-align:center;"><?php $image = (isset($action['Action']['CRA']) && $action['Action']['CRA']==true) ? 'icon-ok' : 'icon-ok icon-grey' ; ?>
                    <a href="#" class="incra cursor" idaction="<?php echo $action['Action']['id']; ?>" ><i class="<?php echo $image; ?>" rel="tooltip" data-title="Visible dans le CRA ou non"></i></a></td>               
                <td style="text-align:center;">
                    <a href="#" class="moins cursor" style="float:left;margin-left: -3px;margin-right:2px;" idaction="<?php echo $action['Action']['id']; ?>" duree="<?php echo $action['Action']['DUREEPREVUE']; ?>"><i class="icon-minus-sign"></i></a>
                    <span rel="tooltip" data-title="<?php echo CHours2Days($action['Action']['DUREEPREVUE']); ?> jour(s)" style="float: left;width: 55%;"><?php echo h($action['Action']['DUREEPREVUE']); ?> h</span>
                    <a href="#" class="plus cursor" style="float:left;" idaction="<?php echo $action['Action']['id']; ?>" duree="<?php echo $action['Action']['DUREEPREVUE']; ?>"><i class="icon-plus-sign"></i></a>
                </td>
		<td style="text-align:center;" class="<?php echo $action['Action']['PRIORITE']; ?>"><?php echo h($action['Action']['PRIORITE']); ?>&nbsp;</td>
		<td class="actions">
                    <?php if (userAuth('profil_id')!='2' && isAuthorized('actions', 'view')) : ?>
                    <?php echo '<span rel="tooltip" data-title="Cliquez pour avoir un aperçu"><i class="icon-eye-open" rel="popover" data-title="<h3>Action :</h3>" data-content="<contenttitle>Commentaire : </contenttitle>'.h($action['Action']['COMMENTAIRE']).'<br/><contenttitle>Crée le: </contenttitle>'.h($action['Action']['created']).'<br/><contenttitle>Modifié le: </contenttitle>'.h($action['Action']['modified']).'" data-trigger="click" style="cursor: pointer;"></i></span>'; ?>&nbsp;
                    <?php endif; ?>
                    <?php if (userAuth('profil_id')!='2' && isAuthorized('actions', 'edit')) : ?>
                    <?php echo $this->Html->link('<i class="icon-pencil" rel="tooltip" data-title="Modification"></i>', array('action' => 'edit', $action['Action']['id']),array('escape' => false)); ?>&nbsp;
                    <?php endif; ?>
                    <?php if (userAuth('profil_id')!='2' && isAuthorized('actions', 'delete')) : ?>
                    <?php echo $this->Form->postLink('<i class="icon-trash" rel="tooltip" data-title="Suppression"></i>', array('action' => 'delete', $action['Action']['id']),array('escape' => false), __('Etes-vous certain de vouloir supprimer cette action ?')); ?>                    
                    <?php endif; ?>
                    <?php if (userAuth('profil_id')!='2' && isAuthorized('actions', 'duplicate')) : ?>
                    <?php echo $this->Form->postLink('<i class="icon-retweet" rel="tooltip" data-title="Duplication"></i>', array('action' => 'dupliquer', $action['Action']['id']),array('escape' => false), __('Etes-vous certain de vouloir dupliquer cette action ?\r\nCette action vous sera attribuée.')); ?>
                    <?php endif; ?>                        
                </td>
	</tr>
        <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
	</table>
	<div class="pull-left"><?php echo $this->Paginator->counter('Page {:page} sur {:pages}'); ?></div>
	<div class="pull-right"><?php echo $this->Paginator->counter('Nombre total d\'éléments : {:count}'); ?></div>     
	<div class="pagination  pagination-centered">
        <ul>
	<?php
                echo "<li>".$this->Paginator->first('<<', true, null, array('class' => 'disabled'))."</li>";
		echo "<li>".$this->Paginator->prev('<', array(), null, array('class' => 'prev disabled'))."</li>";
		echo "<li>".$this->Paginator->numbers(array('separator' => ''))."</li>";
		echo "<li>".$this->Paginator->next('>', array(), null, array('class' => 'disabled'))."</li>";
                echo "<li>".$this->Paginator->last('>>', true, null, array('class' => 'disabled'))."</li>";
	?>
        </ul>
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
});
</script>
