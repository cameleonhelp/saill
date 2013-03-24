<div class="actions index">
        <div class="navbar">
            <div class="navbar-inner">
                <div class="container">
                <ul class="nav">
                <?php if (userAuth('profil_id')!='2' && isAuthorized('actions', 'add')) : ?>
                <li><?php echo $this->Html->link('<i class="icon-plus"></i>', array('action' => 'add'),array('escape' => false)); ?></li>
                <li class="divider-vertical"></li>
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
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Filtre Responsable <b class="caret"></b></a>
                     <ul class="dropdown-menu">
                         <li><?php echo $this->Html->link('Tous', array('action' => 'index',isset($this->params->pass[0]) ? $this->params->pass[0] : 'tous',isset($this->params->pass[1]) ? $this->params->pass[1] : 'tous','tous')); ?></li>
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
			<th><?php echo $this->Paginator->sort('Destinataire.NOMLGDEST','Responsable de l\'action'); ?></th>
			<th><?php echo $this->Paginator->sort('OBJET','Objet'); ?></th>
			<th><?php echo $this->Paginator->sort('AVANCEMENT','% avancement'); ?></th>
			<th width='90px'><?php echo $this->Paginator->sort('DEBUT','Date de début'); ?></th>
			<th width='90px'><?php echo $this->Paginator->sort('ECHEANCE','Echéance'); ?></th>
			<th width='60px'><?php echo $this->Paginator->sort('STATUT','Statut'); ?></th>
			<th width='50px'><?php echo $this->Paginator->sort('DUREEPREVUE','Durée prévue'); ?></th>
			<th><?php echo $this->Paginator->sort('PRIORITE','Priorité'); ?></th>
			<th class="actions" width='60px'><?php echo __('Actions'); ?></th>
	</tr>
        </thead>
        <tbody>
	<?php foreach ($actions as $action): ?>
	<tr>
		<td><?php echo h($action['Domaine']['NOM']); ?>&nbsp;</td>
		<td><?php echo h($action['Destinataire']['NOM']." ".$action['Destinataire']['PRENOM']); ?>&nbsp;</td>
		<td><?php echo h($action['Action']['OBJET']); ?>&nbsp;</td>
                <?php $style = styleBarre(h($action['Action']['AVANCEMENT'])); ?>
		<td><div class="progress progress-<?php echo $style; ?>" style="margin-bottom:-10px;">
                <div class="bar " style="width:<?php echo h($action['Action']['AVANCEMENT']); ?>%;" rel="tooltip" title="Avancement à : <?php echo h($action['Action']['AVANCEMENT']); ?>%"></div></div></td>
		<td style="text-align:center;"><?php echo h($action['Action']['DEBUT']); ?>&nbsp;</td>
		<td style="text-align:center;"><?php echo h($action['Action']['ECHEANCE']); ?>&nbsp;</td>
		<td style="text-align:center;"><?php echo isset($action['Action']['STATUT']) ? '<i class="'.etatAction(h($action['Action']['STATUT'])).'" rel="tooltip" data-title="'.etatTooltip(h($action['Action']['STATUT'])).'"></i>' : '' ; ?>&nbsp;</td>
		<td style="text-align:center;"><?php echo h($action['Action']['DUREEPREVUE']); ?> h</td>
		<td style="text-align:center;"><?php echo h($action['Action']['PRIORITE']); ?>&nbsp;</td>
		<td class="actions">
                        <?php if (userAuth('profil_id')!='2' && isAuthorized('actions', 'view')) : ?>
                        <?php echo '<i class="icon-eye-open" rel="popover" data-title="<h3>Action :</h3>" data-content="<contenttitle>Crée le: </contenttitle>'.h($action['Action']['created']).'<br/><contenttitle>Modifié le: </contenttitle>'.h($action['Action']['modified']).'" data-trigger="click" style="cursor: pointer;"></i>'; ?>&nbsp;
			<?php endif; ?>
                        <?php if (userAuth('profil_id')!='2' && isAuthorized('actions', 'edit')) : ?>
                        <?php echo $this->Html->link('<i class="icon-pencil"></i>', array('action' => 'edit', $action['Action']['id']),array('escape' => false)); ?>&nbsp;
			<?php endif; ?>
                        <?php if (userAuth('profil_id')!='2' && isAuthorized('actions', 'delete')) : ?>
                        <?php echo $this->Form->postLink('<i class="icon-trash"></i>', array('action' => 'delete', $action['Action']['id']),array('escape' => false), __('Etes-vous certain de vouloir supprimer cette action ?')); ?>                    
                        <?php endif; ?>
                </td>
	</tr>
<?php endforeach; ?>
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
