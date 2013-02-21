<div class="activites index">
        <div class="navbar">
            <div class="navbar-inner">
                <div class="container">
                <ul class="nav">
                <li><?php echo $this->Html->link('<i class="icon-plus"></i>', array('action' => 'add'),array('escape' => false)); ?></li>
                <li class="divider-vertical"></li>
                <li><a href="#"><i class="ico-xls"></i></a></li>
                </ul> 
                </div>
            </div>
        </div>
	<div class="pull-left">
	<?php
	echo $this->Paginator->counter('Page {:page} sur {:pages}');
	?>	
        </div>
	<div class="pull-right">
	<?php
	echo $this->Paginator->counter('Nombre total d\'éléments : {:count}');
	?>	
        </div>
        <table cellpadding="0" cellspacing="0" class="table table-bordered table-striped table-hover">
        <thead>
	<tr>
			<th><?php echo $this->Paginator->sort('PROJET_ID'); ?></th>
			<th><?php echo $this->Paginator->sort('NOM'); ?></th>
			<th><?php echo $this->Paginator->sort('DATEDEBUT'); ?></th>
			<th><?php echo $this->Paginator->sort('DATEFIN'); ?></th>
			<th><?php echo $this->Paginator->sort('NOMGALLILIE'); ?></th>
			<th><?php echo $this->Paginator->sort('BUDJETRA'); ?></th>
			<th><?php echo $this->Paginator->sort('BUDGETREVU'); ?></th>
			<th><?php echo $this->Paginator->sort('ACTIVE'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
        <tbody>
	<?php foreach ($activites as $activite): ?>
	<tr>
		<td><?php echo h($activite['Activite']['PROJET_ID']); ?>&nbsp;</td>
		<td><?php echo h($activite['Activite']['NOM']); ?>&nbsp;</td>
		<td><?php echo h($activite['Activite']['DATEDEBUT']); ?>&nbsp;</td>
		<td><?php echo h($activite['Activite']['DATEFIN']); ?>&nbsp;</td>
		<td><?php echo h($activite['Activite']['NOMGALLILIE']); ?>&nbsp;</td>
		<td><?php echo h($activite['Activite']['BUDJETRA']); ?>&nbsp;</td>
		<td><?php echo h($activite['Activite']['BUDGETREVU']); ?>&nbsp;</td>
		<td><?php echo h($activite['Activite']['ACTIVE']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $activite['Activite']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $activite['Activite']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $activite['Activite']['id']), null, __('Are you sure you want to delete # %s?', $activite['Activite']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
        </tbody>
	</table>
	<div class="pagination  pagination-centered">
        <ul>
	<?php
		echo "<li>".$this->Paginator->prev('«', array(), null, array('class' => 'prev disabled'))."</li>";
		echo "<li>".$this->Paginator->numbers(array('separator' => ''))."</li>";
		echo "<li>".$this->Paginator->next('»', array(), null, array('class' => 'next disabled'))."</li>";
	?>
        </ul>
	</div>
</div>
