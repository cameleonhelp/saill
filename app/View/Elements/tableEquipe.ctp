<br/>
<div class="dotations index">
	<table cellpadding="0" cellspacing="0" class="table table-bordered table-striped table-hover">
        <thead>
	<tr>
            <th><?php echo 'Agent'; ?></th>                      
            <th class="actions" width='30px' style="text-align:center;"><?php echo __('Actions'); ?></th>	
        </tr>
        </thead>
        <tbody>
	<?php foreach ($agents as $agent): ?>
	<tr>
		<td><?php echo h($agent['Agent']['utilisateurs']['NOM']." ".$agent['Agent']['utilisateurs']['PRENOM']); ?>&nbsp;</td>
                <td class="actions">
                    <?php echo $this->Html->link('<i class="icon-trash"></i>', array('controller'=>'Equipes','action' => 'delete', $agent['Equipe']['id']),array('escape' => false), __('Etes-vous certain de vouloir supprimer cet agent ?')); ?>                    
		</td>
	</tr>
        <?php endforeach; ?>
        </tbody>
	</table>
    </div>