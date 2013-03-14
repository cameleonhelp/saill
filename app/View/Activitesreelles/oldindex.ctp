      
	<tr>
		<td><?php echo h($activitesreelle['Activitesreelle']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($activitesreelle['Utilisateur']['id'], array('controller' => 'utilisateurs', 'action' => 'view', $activitesreelle['Utilisateur']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($activitesreelle['Action']['id'], array('controller' => 'actions', 'action' => 'view', $activitesreelle['Action']['id'])); ?>
		</td>
            <tr>                
                <?php echo $i > 1 ? "":"<td rowspan='".$group['Activitesreelle']['NBACTIVITE']."'>".$activitesreelle['Utilisateur']['NOMLONG']."</td>"; ?>
                <?php echo $i > 1 ? "":"<td rowspan='".$group['Activitesreelle']['NBACTIVITE']."'>".$activitesreelle['Activitesreelle']['DATE']."</td>"; ?>
                <td><?php echo h($activitesreelle['Activite']['NOM']); ?>&nbsp;</td>
                <td style="text-align: center;"><?php echo h($activitesreelle['Activitesreelle']['LU'] != 0 ? $activitesreelle['Activitesreelle']['LU'] : ""); ?>&nbsp;</td>
                <td style="text-align: center;"><?php echo h($activitesreelle['Activitesreelle']['MA'] != 0 ? $activitesreelle['Activitesreelle']['MA'] : ""); ?>&nbsp;</td>
                <td style="text-align: center;"><?php echo h($activitesreelle['Activitesreelle']['ME'] != 0 ? $activitesreelle['Activitesreelle']['ME'] : ""); ?>&nbsp;</td>                
                <td style="text-align: center;"><?php echo h($activitesreelle['Activitesreelle']['JE'] != 0 ? $activitesreelle['Activitesreelle']['JE'] : ""); ?>&nbsp;</td>
                <td style="text-align: center;"><?php echo h($activitesreelle['Activitesreelle']['VE'] != 0 ? $activitesreelle['Activitesreelle']['VE'] : ""); ?>&nbsp;</td>                
                <td style="text-align: center;"><?php echo h($activitesreelle['Activitesreelle']['SA'] != 0 ? $activitesreelle['Activitesreelle']['SA'] : ""); ?>&nbsp;</td>
                <td style="text-align: center;"><?php echo h($activitesreelle['Activitesreelle']['DI'] != 0 ? $activitesreelle['Activitesreelle']['DI'] : ""); ?>&nbsp;</td>
                <td style="text-align: center;"><?php echo h($activitesreelle['Activitesreelle']['TOTAL']); ?>&nbsp;</td>
                <td></td>
             </tr>        
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $activitesreelle['Activitesreelle']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $activitesreelle['Activitesreelle']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $activitesreelle['Activitesreelle']['id']), null, __('Are you sure you want to delete # %s?', $activitesreelle['Activitesreelle']['id'])); ?>
		</td>
	</tr>