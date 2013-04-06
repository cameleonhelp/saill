<div class="facturations index">
        <div class="navbar">
            <div class="navbar-inner">
                <div class="container">
                <ul class="nav">
                <?php $defaultEtat = $this->params->action == "afacturer" ? 'facture' : 'tous'; ?>
                <?php $defaultAction = $this->params->action == "search" ? 'index' : $this->params->action; ?>
                <?php if (userAuth('profil_id')!='2' && isAuthorized('activitesreelles', 'add')) : ?>
                <li><?php echo $this->Html->link('<i class="icon-plus"></i>', array('action' => 'add'),array('escape' => false)); ?></li>
                <li class="divider-vertical"></li>
                <?php endif; ?>
                 <li><?php echo $this->Html->link('A facturer', array('controller'=>'activitesreelles','action' => 'afacturer'),array('escape' => false)); ?></li>
                 <?php if (areaIsVisible()) :?>
                <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Filtre Utilisateurs <b class="caret"></b></a>
                     <ul class="dropdown-menu">
                     <li><?php echo $this->Html->link('Tous', array('action' => $defaultAction,isset($this->params->pass[0]) ? $this->params->pass[0] : $defaultEtat,'tous',isset($this->params->pass[2]) ? $this->params->pass[2] : 'tous')); ?></li>
                     <li class="divider"></li>
                         <?php foreach ($utilisateurs as $utilisateur): ?>
                            <li><?php echo $this->Html->link($utilisateur['Utilisateur']['NOMLONG'], array('action' => $defaultAction,isset($this->params->pass[0]) ? $this->params->pass[0] : $defaultEtat,$utilisateur['Utilisateur']['id'],isset($this->params->pass[2]) ? $this->params->pass[2] : 'tous')); ?></li>
                         <?php endforeach; ?>
                      </ul>
                </li>   
                <?php endif; ?> 
                <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Filtre Mois <b class="caret"></b></a>
                     <ul class="dropdown-menu">
                     <li><?php echo $this->Html->link('Tous', array('action' => $defaultAction,isset($this->params->pass[0]) ? $this->params->pass[0] : $defaultEtat,isset($this->params->pass[1]) ? $this->params->pass[1] : 'tous','tous')); ?></li>
                     <li class="divider"></li>
                     <li><?php echo $this->Html->link('Janvier', array('action' => $defaultAction,isset($this->params->pass[0]) ? $this->params->pass[0] : $defaultEtat,isset($this->params->pass[1]) ? $this->params->pass[1] : 'tous','01')); ?></li>
                     <li><?php echo $this->Html->link('Février', array('action' => $defaultAction,isset($this->params->pass[0]) ? $this->params->pass[0] : $defaultEtat,isset($this->params->pass[1]) ? $this->params->pass[1] : 'tous','02')); ?></li>
                     <li><?php echo $this->Html->link('Mars', array('action' => $defaultAction,isset($this->params->pass[0]) ? $this->params->pass[0] : $defaultEtat,isset($this->params->pass[1]) ? $this->params->pass[1] : 'tous','03')); ?></li>
                     <li><?php echo $this->Html->link('Avril', array('action' => $defaultAction,isset($this->params->pass[0]) ? $this->params->pass[0] : $defaultEtat,isset($this->params->pass[1]) ? $this->params->pass[1] : 'tous','04')); ?></li>
                     <li><?php echo $this->Html->link('Mai', array('action' => $defaultAction,isset($this->params->pass[0]) ? $this->params->pass[0] : $defaultEtat,isset($this->params->pass[1]) ? $this->params->pass[1] : 'tous','05')); ?></li>
                     <li><?php echo $this->Html->link('Juin', array('action' => $defaultAction,isset($this->params->pass[0]) ? $this->params->pass[0] : $defaultEtat,isset($this->params->pass[1]) ? $this->params->pass[1] : 'tous','06')); ?></li>
                     <li><?php echo $this->Html->link('Juillet', array('action' => $defaultAction,isset($this->params->pass[0]) ? $this->params->pass[0] : $defaultEtat,isset($this->params->pass[1]) ? $this->params->pass[1] : 'tous','07')); ?></li>
                     <li><?php echo $this->Html->link('Août', array('action' => $defaultAction,isset($this->params->pass[0]) ? $this->params->pass[0] : $defaultEtat,isset($this->params->pass[1]) ? $this->params->pass[1] : 'tous','08')); ?></li>
                     <li><?php echo $this->Html->link('Septembre', array('action' => $defaultAction,isset($this->params->pass[0]) ? $this->params->pass[0] : $defaultEtat,isset($this->params->pass[1]) ? $this->params->pass[1] : 'tous','09')); ?></li>
                     <li><?php echo $this->Html->link('Octobre', array('action' => $defaultAction,isset($this->params->pass[0]) ? $this->params->pass[0] : $defaultEtat,isset($this->params->pass[1]) ? $this->params->pass[1] : 'tous','10')); ?></li>
                     <li><?php echo $this->Html->link('Novembre', array('action' => $defaultAction,isset($this->params->pass[0]) ? $this->params->pass[0] : $defaultEtat,isset($this->params->pass[1]) ? $this->params->pass[1] : 'tous','11')); ?></li>
                     <li><?php echo $this->Html->link('Décembre', array('action' => $defaultAction,isset($this->params->pass[0]) ? $this->params->pass[0] : $defaultEtat,isset($this->params->pass[1]) ? $this->params->pass[1] : 'tous','12')); ?></li>                     
                      </ul>
                </li>  
                </ul> 
                <?php if ($this->params->controller == "activitesreelles" && $this->params->action == "index") : ?>
                <?php echo $this->Form->create("Activitesreelle",array('action' => 'search','class'=>'navbar-form clearfix pull-right','inputDefaults' => array('label'=>false,'div' => false))); ?>
                    <?php echo $this->Form->input('SEARCH',array('class'=>'span8','placeholder'=>'Recherche dans tous les champs')); ?>
                    <button type="submit" class="btn">Rechercher</button>
                <?php echo $this->Form->end(); ?>                    
                <?php elseif ($this->params->controller == "facturations") : ?>
                <?php echo $this->Form->create("Facturation",array('action' => 'search','class'=>'navbar-form clearfix pull-right','inputDefaults' => array('label'=>false,'div' => false))); ?>
                    <?php echo $this->Form->input('SEARCH',array('class'=>'span8','placeholder'=>'Recherche dans tous les champs')); ?>
                    <button type="submit" class="btn">Rechercher</button>
                <?php echo $this->Form->end(); ?>                     
                <?php endif; ?>
                </div>
            </div>
        </div>
        <?php if ($this->params['action']=='index') { ?><code class="text-normal"  style="margin-bottom: 10px;display: block;"><em>Liste des facturations de <?php echo $futilisateur; ?> <?php echo $fperiode; ?></em></code><?php } ?>        
        <table cellpadding="0" cellspacing="0" class="table table-bordered table-striped table-hover" id="data">
	<thead>
            <tr>
			<th><?php echo 'Utilisateur'; ?></th>
			<th><?php echo 'Date'; ?></th>
 			<th><?php echo 'Réf. FT GALILEI'; ?></th>
			<th><?php echo 'Version'; ?></th>
                        <th><?php echo 'Activités'; ?></th>
			<th><?php echo 'Lu.'; ?></th>
			<th><?php echo 'Ma.'; ?></th>
			<th><?php echo 'Me.'; ?></th>
			<th><?php echo 'Je.'; ?></th>
			<th><?php echo 'Ve.'; ?></th>
			<th><?php echo 'Sa.'; ?></th>
			<th><?php echo 'Di.'; ?></th>
			<th><?php echo 'Total'; ?></th>
			<th class="actions">Actions</th>
	</tr>
	</thead>
        <tbody>         
	<?php foreach ($facturations as $facturation): ?>
	<tr>    
		<td>
			<?php echo $this->Html->link($facturation['Utilisateur']['NOMLONG'], array('controller' => 'utilisateurs', 'action' => 'view', $facturation['Utilisateur']['id'])); ?>
		</td>
		<td><?php echo h($facturation['Facturation']['DATE']); ?>&nbsp;</td>
  		<td><?php echo h($facturation['Facturation']['NUMEROFTGALILEI']); ?>&nbsp;</td>
		<td><?php echo h($facturation['Facturation']['VERSION']); ?>&nbsp;</td>
                <td>
			<?php echo $this->Html->link($facturation['Activite']['NOM'], array('controller' => 'activites', 'action' => 'view', $facturation['Activite']['id'])); ?>
		</td>
		<td><?php echo h($facturation['Facturation']['LU']); ?>&nbsp;</td>
		<td><?php echo h($facturation['Facturation']['MA']); ?>&nbsp;</td>
		<td><?php echo h($facturation['Facturation']['ME']); ?>&nbsp;</td>
		<td><?php echo h($facturation['Facturation']['JE']); ?>&nbsp;</td>
		<td><?php echo h($facturation['Facturation']['VE']); ?>&nbsp;</td>
		<td><?php echo h($facturation['Facturation']['SA']); ?>&nbsp;</td>
		<td><?php echo h($facturation['Facturation']['DI']); ?>&nbsp;</td>
		<td><?php echo h($facturation['Facturation']['TOTAL']); ?>&nbsp;</td>
		<td class="actions">
                    <?php if (userAuth('profil_id')!='2' && isAuthorized('facturations', 'view')) : ?>
                    <?php echo '<i class="icon-eye-open" rel="popover" data-title="<h3>Facturation :</h3>" data-content="<contenttitle>Crée le: </contenttitle>'.h($facturation['Facturation']['created']).'<br/><contenttitle>Modifié le: </contenttitle>'.h($facturation['Facturation']['modified']).'" data-trigger="click" style="cursor: pointer;"></i>'; ?>&nbsp;
                    <?php endif; ?>
                    <?php if (userAuth('profil_id')!='2' && isAuthorized('facturations', 'edit')) : ?>
                    <?php echo $this->Html->link('<i class="icon-pencil"></i>', array('action' => 'add', $facturation['Facturation']['id']),array('escape' => false)); ?>&nbsp;
                    <?php endif; ?>
                    <?php if (userAuth('profil_id')!='2' && isAuthorized('facturations', 'delete')) : ?>
                    <?php echo $this->Form->postLink('<i class="icon-trash"></i>', array('action' => 'delete', $facturation['Facturation']['id']),array('escape' => false), __('Etes-vous certain de vouloir supprimer ce domaine ?')); ?>
                    <?php endif; ?>
                </td>
	</tr>
<?php endforeach; ?>
        </tbody>
        <tfooter>
	<tr>
            <td colspan="12" class="footer" style="text-align:right;">Total :</td>
            <td class="footer" id="totalactivites" style="text-align:right;"></td>
            <td class="footer" width="90px" style="text-align:left;">jours</td>
	</tr>            
        </tfooter>        
	</table>
        <div class="pull-left">	<?php	echo $this->Paginator->counter('Page {:page} sur {:pages}');	?></div>
        <div class="pull-right"><?php	echo $this->Paginator->counter('Nombre total d\'éléments : {:count}');	?></div>
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
