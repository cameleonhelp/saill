<div class="outils index">
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
                        <th><?php echo $this->Paginator->sort('utilisateur_id','Gestionnaire '); ?></th>
			<th width="80px;" style="text-align:center;"><?php echo $this->Paginator->sort('VALIDATION','A faire valider'); ?></th>
			<th class="actions" width="60px;"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
        <tbody>
	<?php foreach ($outils as $outil): ?>
	<tr>
		<td><?php echo h($outil['Outil']['NOM']); ?>&nbsp;</td>
                <td><?php echo h($outil['Outil']['utilisateur_id']); ?>&nbsp;</td>
		<td><?php echo h($outil['Outil']['VALIDATION']); ?>&nbsp;</td>
		<td class="actions">
                        <?php echo '<i class="icon-eye-open" rel="popover" data-title="<h3>Outil :</h3>" data-content="<contenttitle>Crée le: </contenttitle>'.h($outil['Outil']['created']).'<br/><contenttitle>Modifié le: </contenttitle>'.h($outil['Outil']['modified']).'" data-trigger="click" style="cursor: pointer;"></i>'; ?>&nbsp;
			<?php echo $this->Html->link('<i class="icon-pencil"></i>', array('action' => 'edit', $outil['Outil']['id']),array('escape' => false)); ?>&nbsp;
			<?php echo $this->Form->postLink('<i class="icon-trash"></i>', array('action' => 'delete', $outil['Outil']['id']),array('escape' => false), __('Etes-vous certain de vouloir supprimer cet outil ?')); ?>
		</td>
	</tr>
<?php endforeach; ?>
        </tbody>
	</table>
        <div class="pull-left">	<?php	echo $this->Paginator->counter('Page {:page} sur {:pages}');	?></div>
        <div class="pull-right"><?php	echo $this->Paginator->counter('Nombre total d\'éléments : {:count}');	?></div>
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
