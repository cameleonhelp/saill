<div class="projets index">
        <div class="navbar">
            <div class="navbar-inner">
                <div class="container">
                <ul class="nav">
                <li><?php echo $this->Html->link('<i class="icon-plus"></i>', array('action' => 'add'),array('escape' => false)); ?></li>
                <li class="divider-vertical"></li>
                <li><a href="#"><i class="ico-xls"></i></a></li>
                </ul> 
                <?php echo $this->Form->create("Projet",array('action' => 'search','class'=>'navbar-form clearfix pull-right','inputDefaults' => array('label'=>false,'div' => false))); ?>
                    <?php echo $this->Form->input('SEARCH',array('class'=>'span8','placeholder'=>'Recherche dans tous les champs')); ?>
                    <button type="submit" class="btn">Rechercher</button>
                <?php echo $this->Form->end(); ?> 
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
			<th><?php echo $this->Paginator->sort('CONTRAT_ID'); ?></th>
			<th><?php echo $this->Paginator->sort('NOM'); ?></th>
			<th><?php echo $this->Paginator->sort('DEBUT'); ?></th>
			<th><?php echo $this->Paginator->sort('FIN'); ?></th>
			<th><?php echo $this->Paginator->sort('ACTIF'); ?></th>
			<th><?php echo $this->Paginator->sort('TYPE'); ?></th>
			<th><?php echo $this->Paginator->sort('FACTURATION'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
        <tbody>
	<?php foreach ($projets as $projet): ?>
	<tr>
		<td><?php echo h($projet['Projet']['CONTRAT_ID']); ?>&nbsp;</td>
		<td><?php echo h($projet['Projet']['NOM']); ?>&nbsp;</td>
		<td><?php echo h($projet['Projet']['DEBUT']); ?>&nbsp;</td>
		<td><?php echo h($projet['Projet']['FIN']); ?>&nbsp;</td>
		<td><?php echo h($projet['Projet']['ACTIF']); ?>&nbsp;</td>
		<td><?php echo h($projet['Projet']['TYPE']); ?>&nbsp;</td>
		<td><?php echo h($projet['Projet']['FACTURATION']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $projet['Projet']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $projet['Projet']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $projet['Projet']['id']), null, __('Are you sure you want to delete # %s?', $projet['Projet']['id'])); ?>
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
