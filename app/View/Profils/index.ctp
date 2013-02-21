<div class="profils index">
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
        <table cellpadding="0" cellspacing="0" class="table table-bordered table-striped table-hover">
        <thead>
	<tr>
			<th><?php echo $this->Paginator->sort('NOM','Nom'); ?></th>
			<th><?php echo $this->Paginator->sort('COMMENTAIRE','Description'); ?></th>
			<th class="actions" width="60px;"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
        <tbody>
	<?php foreach ($profils as $profil): ?>
	<tr>
		<td><?php echo h($profil['Profil']['NOM']); ?>&nbsp;</td>
		<td><?php echo h($profil['Profil']['COMMENTAIRE']); ?>&nbsp;</td>
		<td class="actions">
                        <?php echo '<i class="icon-eye-open" rel="popover" data-title="<h3>Profil :</h3>" data-content="<contenttitle>Crée le: </contenttitle>'.h($profil['Profil']['created']).'<br/><contenttitle>Modifié le: </contenttitle>'.h($profil['Profil']['modified']).'" data-trigger="click" style="cursor: pointer;"></i>'; ?>&nbsp;
			<?php echo $this->Html->link('<i class="icon-pencil"></i>', array('action' => 'edit', $profil['Profil']['id']),array('escape' => false)); ?>&nbsp;
			<?php echo $this->Form->postLink('<i class="icon-trash"></i>', array('action' => 'delete', $profil['Profil']['id']),array('escape' => false), __('Etes-vous certain de vouloir supprimer ce profil ?')); ?>
		</td>
	</tr>
<?php endforeach; ?>
        </tbody>
	</table>
	<div class="pull-left"><?php echo $this->Paginator->counter('Page {:page} sur {:pages}'); ?></div>
	<div class="pull-right"><?php echo $this->Paginator->counter('Nombre total d\'éléments : {:count}'); ?></div>    
	<div class="pagination  pagination-centered">
        <ul>
	<?php
                echo "<li>".$this->Paginator->first('<<', true, null, array('class' => 'disabled'))."</li>";
		echo "<li>".$this->Paginator->prev('<', array(), null, array('class' => 'prev disabled'))."</li>";
		echo "<li>".$this->Paginator->numbers(array('separator' => ''))."</li>";
		echo "<li>".$this->Paginator->next('>', array(), null, array('class' => 'disabled'))."</li>";
                echo "<li>".$this->Paginator->last('>>', true, null, array('class' => 'disabled'))."</li>";
	?>
        </ul>
	</div>
</div>
