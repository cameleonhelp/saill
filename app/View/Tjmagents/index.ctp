<div class="tjmagents index">
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
			<th><?php echo $this->Paginator->sort('NOM'); ?></th>
			<th><?php echo $this->Paginator->sort('TARIFHT'); ?></th>
			<th><?php echo $this->Paginator->sort('TARIFTTC'); ?></th>
			<th><?php echo $this->Paginator->sort('ANNEE'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
        <tbody>
	<?php foreach ($tjmagents as $tjmagent): ?>
	<tr>
		<td><?php echo h($tjmagent['Tjmagent']['NOM']); ?>&nbsp;</td>
		<td><?php echo h($tjmagent['Tjmagent']['TARIFHT']); ?>&nbsp;</td>
		<td><?php echo h($tjmagent['Tjmagent']['TARIFTTC']); ?>&nbsp;</td>
		<td><?php echo h($tjmagent['Tjmagent']['ANNEE']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $tjmagent['Tjmagent']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $tjmagent['Tjmagent']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $tjmagent['Tjmagent']['id']), null, __('Are you sure you want to delete # %s?', $tjmagent['Tjmagent']['id'])); ?>
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
