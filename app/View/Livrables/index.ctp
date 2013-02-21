<div class="livrables index">
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
			<th><?php echo $this->Paginator->sort('REFERENCE'); ?></th>
			<th><?php echo 'ETAT'; ?></th>
			<th><?php echo 'ECHEANCE'; ?></th>
			<th><?php echo 'DATE LIVRAISON'; ?></th>                        
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
        </thead>
        <tbody>        
	<?php foreach ($livrables as $livrable): ?>
	<tr>
		<td><?php echo h($livrable['Livrable']['NOM']); ?>&nbsp;</td>
		<td><?php echo h($livrable['Livrable']['REFERENCE']); ?>&nbsp;</td>
		<td><?php echo h(); ?>&nbsp;</td>
		<td><?php echo h(); ?>&nbsp;</td>
		<td><?php echo h(); ?>&nbsp;</td>
                <td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $livrable['Livrable']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $livrable['Livrable']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $livrable['Livrable']['id']), null, __('Are you sure you want to delete # %s?', $livrable['Livrable']['id'])); ?>
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
