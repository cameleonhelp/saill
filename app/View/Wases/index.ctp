<div class="wases index">
	<h2><?php echo __('Wases'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('VERSION'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($wases as $wase): ?>
	<tr>
		<td><?php echo h($wase['Wase']['id']); ?>&nbsp;</td>
		<td><?php echo h($wase['Wase']['VERSION']); ?>&nbsp;</td>
		<td><?php echo h($wase['Wase']['created']); ?>&nbsp;</td>
		<td><?php echo h($wase['Wase']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $wase['Wase']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $wase['Wase']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $wase['Wase']['id']), null, __('Are you sure you want to delete # %s?', $wase['Wase']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Wase'), array('action' => 'add')); ?></li>
	</ul>
</div>
