<div class="linkshareds index">
        <div class="navbar">
            <div class="navbar-inner">
                <div class="container">
                <ul class="nav">
                <li><?php echo $this->Html->link('<i class="icon-plus"></i>', array('action' => 'add'),array('escape' => false)); ?></li>
                <li class="divider-vertical"></li>
                <li><a href="#"><i class="ico-xls"></i></a></li>
                </ul> 
                <?php echo $this->Form->create("Linkshared",array('action' => 'search','class'=>'navbar-form clearfix pull-right','inputDefaults' => array('label'=>false,'div' => false))); ?>
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
			<th><?php echo $this->Paginator->sort('NOM'); ?></th>
			<th><?php echo $this->Paginator->sort('LINK'); ?></th>
			<th><?php echo ""; ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
        </thead>
        <tbody>
	<?php foreach ($linkshareds as $linkshared): ?>
	<tr>
		<td><?php echo h($linkshared['Linkshared']['NOM']); ?>&nbsp;</td>
		<td><?php echo h($linkshared['Linkshared']['LINK']); ?>&nbsp;</td>
		<td><?php echo h($this->Html->link('<i class="glyphicon_global"></i>',$this->Paginator->sort('created'),array('escape' => false,'target'=>'_blank'))); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $linkshared['Linkshared']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $linkshared['Linkshared']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $linkshared['Linkshared']['id']), null, __('Are you sure you want to delete # %s?', $linkshared['Linkshared']['id'])); ?>
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
