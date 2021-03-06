<div class="plangantts index">
	<h2><?php echo __('Plangantts'); ?></h2>
	<table cellpadding="0" cellspacing="0" class="table table-bordered table-striped table-hover">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('planetape_id'); ?></th>
			<th><?php echo $this->Paginator->sort('planprojets_id'); ?></th>
			<th><?php echo $this->Paginator->sort('utilisateurs_id'); ?></th>
			<th><?php echo $this->Paginator->sort('NOM'); ?></th>
			<th><?php echo $this->Paginator->sort('DATEDEBUT'); ?></th>
			<th><?php echo $this->Paginator->sort('DATEFIN'); ?></th>
			<th><?php echo $this->Paginator->sort('CHARGE'); ?></th>
			<th><?php echo $this->Paginator->sort('CAPACITE'); ?></th>
			<th><?php echo $this->Paginator->sort('ETAT'); ?></th>
			<th><?php echo $this->Paginator->sort('AVANCEMENT'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($plangantts as $plangantt): ?>
	<tr>
		<td><?php echo h($plangantt['Plangantt']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($plangantt['Planetape']['id'], array('controller' => 'planetapes', 'action' => 'view', $plangantt['Planetape']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($plangantt['Planprojets']['id'], array('controller' => 'planprojets', 'action' => 'view', $plangantt['Planprojets']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($plangantt['Utilisateurs']['id'], array('controller' => 'utilisateurs', 'action' => 'view', $plangantt['Utilisateurs']['id'])); ?>
		</td>
		<td><?php echo h($plangantt['Plangantt']['NOM']); ?>&nbsp;</td>
		<td><?php echo h($plangantt['Plangantt']['DATEDEBUT']); ?>&nbsp;</td>
		<td><?php echo h($plangantt['Plangantt']['DATEFIN']); ?>&nbsp;</td>
		<td><?php echo h($plangantt['Plangantt']['CHARGE']); ?>&nbsp;</td>
		<td><?php echo h($plangantt['Plangantt']['CAPACITE']); ?>&nbsp;</td>
		<td><?php echo h($plangantt['Plangantt']['ETAT']); ?>&nbsp;</td>
		<td><?php echo h($plangantt['Plangantt']['AVANCEMENT']); ?>&nbsp;</td>
		<td><?php echo h($plangantt['Plangantt']['created']); ?>&nbsp;</td>
		<td><?php echo h($plangantt['Plangantt']['modified']); ?>&nbsp;</td>
		<td class="actions">
                    <span class="glyphicons eye_open cursor"></span>
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $plangantt['Plangantt']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $plangantt['Plangantt']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $plangantt['Plangantt']['id']), null, __('Are you sure you want to delete # %s?', $plangantt['Plangantt']['id'])); ?>
		</td>
</tr>
    <tr class="trhidden" style="display:none;"><td colspan="14" align="center">
            <table cellpadding="0" cellspacing="0" class="table table-hidden" style="margin-bottom:-3px;">
                <tr><th>Crée le</th><th>Modifié le</th><th>Commentaire</th></tr>
                <tr><td>21/01/2013</td><td>21/01/2013</td><td><?php echo h($plangantt['Plangantt']['id']); ?>. Mise en place d'une table de détail pour afficher plus d'information sur l'objet.</td></tr>
            </table>
    </td>
</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Plangantt'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Planetapes'), array('controller' => 'planetapes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Planetape'), array('controller' => 'planetapes', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Planprojets'), array('controller' => 'planprojets', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Planprojets'), array('controller' => 'planprojets', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Utilisateurs'), array('controller' => 'utilisateurs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Utilisateurs'), array('controller' => 'utilisateurs', 'action' => 'add')); ?> </li>
	</ul>
</div>
<script>
$(document).ready(function () {  
    $(document).on('click','.eye_open',function(e){
        $(this).parents('tr').next('.trhidden').fadeToggle();
    });
});
</script>