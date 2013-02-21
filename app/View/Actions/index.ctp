<div class="actions index">
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
			<th><?php echo $this->Paginator->sort('DOMAINE_ID'); ?></th>
			<th><?php echo $this->Paginator->sort('DESTINATAIRE'); ?></th>
			<th><?php echo $this->Paginator->sort('OBJET'); ?></th>
			<th><?php echo $this->Paginator->sort('AVANCEMENT'); ?></th>
			<th><?php echo $this->Paginator->sort('DEBUT'); ?></th>
			<th><?php echo $this->Paginator->sort('ECHEANCE'); ?></th>
			<th><?php echo $this->Paginator->sort('STATUT'); ?></th>
			<th><?php echo $this->Paginator->sort('DUREEPREVUE'); ?></th>
			<th><?php echo $this->Paginator->sort('DUREEREELLE'); ?></th>
			<th><?php echo $this->Paginator->sort('PRIORITE'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
        </thead>
        <tbody>
	<?php foreach ($actions as $action): ?>
	<tr>
		<td><?php echo h($action['Action']['DOMAINE_ID']); ?>&nbsp;</td>
		<td><?php echo h($action['Action']['DESTINATAIRE']); ?>&nbsp;</td>
		<td><?php echo h($action['Action']['OBJET']); ?>&nbsp;</td>
		<td><?php echo h($action['Action']['AVANCEMENT']); ?>&nbsp;</td>
		<td><?php echo h($action['Action']['DEBUT']); ?>&nbsp;</td>
		<td><?php echo h($action['Action']['ECHEANCE']); ?>&nbsp;</td>
		<td><?php echo h($action['Action']['STATUT']); ?>&nbsp;</td>
		<td><?php echo h($action['Action']['DUREEPREVUE']); ?>&nbsp;</td>
		<td><?php echo h($action['Action']['DUREEREELLE']); ?>&nbsp;</td>
		<td><?php echo h($action['Action']['PRIORITE']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $action['Action']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $action['Action']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $action['Action']['id']), null, __('Are you sure you want to delete # %s?', $action['Action']['id'])); ?>
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
