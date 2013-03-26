<br/>
<div class="affectations index">
	<table cellpadding="0" cellspacing="0" class="table table-bordered table-striped table-hover">
        <thead>
	<tr>
			<th><?php echo 'Activités'; ?></th>
                        <th><?php echo 'Commentaire'; ?></th>
                        <th><?php echo 'Répartition'; ?></th>
                    <?php if ($this->params->action != 'profil') : ?>                        
			<th class="actions" width='40px'><?php echo __('Actions'); ?></th>
                    <?php endif; ?>
	</tr>
        </thead>
        <tbody>
	<?php foreach ($affectations as $affectation): ?>
	<tr>
		<td><?php echo h($affectation['Activite']['NOM']); ?>&nbsp;</td>
                <td><?php echo h($affectation['Activite']['DESCRIPTION']); ?>&nbsp;</td>
                <td style="text-align: right;"><?php echo h(isset($affectation['Affectation']['REPARTITION']) ? $affectation['Affectation']['REPARTITION'].'%' : ''); ?>&nbsp;</td>
                <?php if ($this->params->action != 'profil') : ?>		
                <td class="actions">
                    <?php if (userAuth('profil_id')!='2' && isAuthorized('affectations', 'edit')) : ?>
                    <?php echo $this->Html->link('<i class="icon-pencil"></i>', array('controller'=>'affectations','action' => 'edit', $affectation['Affectation']['id'], $this->params->pass[0]),array('escape' => false)); ?>&nbsp;
                    <?php endif; ?>
                    <?php if (userAuth('profil_id')!='2' && isAuthorized('affectations', 'delete')) : ?>
                    <?php echo $this->Html->link('<i class="icon-trash"></i>', array('controller'=>'affectations','action' => 'delete', $affectation['Affectation']['id'], $this->params->pass[0]),array('escape' => false), __('Etes-vous certain de vouloir supprimer cette affectation ?')); ?>                    
                    <?php endif; ?>
		</td>
                <?php endif; ?>
	</tr>
<?php endforeach; ?>
        </tbody>
	</table>
    </div>

