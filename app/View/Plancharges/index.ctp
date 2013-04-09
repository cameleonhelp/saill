<div class="plancharges index">
        <div class="navbar">
            <div class="navbar-inner">
                <div class="container">
                <ul class="nav">
                <?php if (userAuth('profil_id')!='2' && isAuthorized('contrats', 'add')) : ?>
                <li><?php echo $this->Html->link('<i class="icon-plus"></i>', array('action' => 'add'),array('escape' => false)); ?></li>
                <li class="divider-vertical"></li>
                <?php endif; ?>
                <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Filtre années <b class="caret"></b></a>
                     <ul class="dropdown-menu">
                         <li><?php echo $this->Html->link('Tous', array('action' => 'index','tous',isset($this->params->pass[1]) ? $this->params->pass[1] : 'tous')); ?></li>
                         <li class="divider"></li>
                         <?php //liste des années ayant un plan de charge ?>
                     </ul>
                 </li>                 
                <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Filtre projets <b class="caret"></b></a>
                     <ul class="dropdown-menu">
                         <li><?php echo $this->Html->link('Tous', array('action' => 'index',isset($this->params->pass[0]) ? $this->params->pass[0] : 'tous','tous')); ?></li>
                         <li class="divider"></li>
                         <?php //liste des projets ayant un plan de charge ?>
                     </ul>
                 </li> 
                </ul> 
                </div>
            </div>
        </div>
        <?php if ($this->params['action']=='index') { ?><code class="text-normal"  style="margin-bottom: 10px;display: block;"><em>Liste de <?php echo $fannee; ?>, <?php echo $fprojet; ?></em></code><?php } ?>        
        <table cellpadding="0" cellspacing="0" class="table table-bordered table-striped table-hover">
        <thead>
	<tr>
			<th><?php echo $this->Paginator->sort('ANNEE','Année'); ?></th>
                        <th><?php echo $this->Paginator->sort('projet_id','Projet'); ?></th>
			<th><?php echo $this->Paginator->sort('NOM','Nom du plan de charge'); ?></th>
			<th><?php echo $this->Paginator->sort('ETP','etp'); ?></th>
			<th><?php echo $this->Paginator->sort('CHARGES','Charges'); ?></th>
			<th><?php echo $this->Paginator->sort('TJM','tjm'); ?></th>
			<th><?php echo $this->Paginator->sort('VERSION','Version'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
        <tbody>        
	<?php foreach ($plancharges as $plancharge): ?>
	<tr>
		<td><?php echo h($plancharge['Plancharge']['ANNEE']); ?>&nbsp;</td>
                <td><?php echo h($plancharge['Plancharge']['projet_id']); ?>&nbsp;</td>
		<td><?php echo h($plancharge['Plancharge']['NOM']); ?>&nbsp;</td>
		<td><?php echo h($plancharge['Plancharge']['ETP']); ?>&nbsp;</td>
		<td><?php echo h($plancharge['Plancharge']['CHARGES']); ?>&nbsp;</td>
		<td><?php echo h($plancharge['Plancharge']['TJM']); ?>&nbsp;</td>
		<td><?php echo h($plancharge['Plancharge']['VERSION']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $plancharge['Plancharge']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $plancharge['Plancharge']['id'])); ?>
                        <?php echo $this->Html->link(__('List'), array('controller'=>'detalplancharges','action' => 'index', $plancharge['Plancharge']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
        </tbody>
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

