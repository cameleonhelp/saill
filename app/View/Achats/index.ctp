<div class="achats index">
        <div class="navbar">
            <div class="navbar-inner">
                <div class="container">
                <ul class="nav">
                <li><?php echo $this->Html->link('<i class="icon-plus"></i>', array('action' => 'add'),array('escape' => false)); ?></li>
                <li class="divider-vertical"></li>
                <li><a href="#"><i class="ico-xls"></i></a></li>
                </ul> 
                <form class="navbar-form clearfix pull-right ">
                    <input class="span8" type="text" placeholder="Recherche dans tous les champs">
                    <button type="submit" class="btn">Rechercher</button>
                </form> 
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
			<th><?php echo $this->Paginator->sort('LIBELLEACHAT','Achat'); ?></th>
                        <th><?php echo $this->Paginator->sort('ACTIVITE_ID','Activité'); ?></th>
			<th><?php echo $this->Paginator->sort('DATE','Date d\'achat'); ?></th>
			<th><?php echo $this->Paginator->sort('MONTANT','Montant en €'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
        </thead>
        <tbody>
	<?php foreach ($achats as $achat): ?>
	<tr>
		<td><?php echo h($achat['Achat']['LIBELLEACHAT']); ?>&nbsp;</td>
                <td><?php echo h($achat['Achat']['ACTIVITE_ID']); ?>&nbsp;</td>
		<td><?php echo h($achat['Achat']['DATE']); ?>&nbsp;</td>
		<td><?php echo h($achat['Achat']['MONTANT']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $achat['Achat']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $achat['Achat']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $achat['Achat']['id']), null, __('Are you sure you want to delete # %s?', $achat['Achat']['id'])); ?>
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