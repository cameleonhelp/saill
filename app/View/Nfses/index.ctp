<div class="nfses index">
	<h2><?php echo __('Nfses'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('NB'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($nfses as $nfse): ?>
	<tr>
		<td><?php echo h($nfse['Nfse']['id']); ?>&nbsp;</td>
		<td><?php echo h($nfse['Nfse']['NB']); ?>&nbsp;</td>
		<td><?php echo h($nfse['Nfse']['created']); ?>&nbsp;</td>
		<td><?php echo h($nfse['Nfse']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $nfse['Nfse']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $nfse['Nfse']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $nfse['Nfse']['id']), null, __('Are you sure you want to delete # %s?', $nfse['Nfse']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
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
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Nfse'), array('action' => 'add')); ?></li>
	</ul>
</div>
