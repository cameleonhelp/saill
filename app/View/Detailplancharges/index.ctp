<div class="detailplancharges index">
    <?php echo $this->Form->create('Detailplancharge',array('id'=>'formValidate','class'=>'form-horizontal','action'=>'save','inputDefaults' => array('label'=>false,'div' => false))); ?> 
    <table cellpadding="0" cellspacing="0" class="table table-bordered table-striped table-hover">
        <thead>
	<tr>
			<th><?php echo 'Utilisateur'; ?></th>
			<th><?php echo 'Domaine'; ?></th>
			<th><?php echo 'Projet/Activité'; ?></th>
			<th><?php echo 'Etp'; ?></th>
			<th><?php echo 'Jan.'; ?></th>
			<th><?php echo 'Fév.'; ?></th>
			<th><?php echo 'Mars'; ?></th>
			<th><?php echo 'Avril'; ?></th>
			<th><?php echo 'Mai'; ?></th>
			<th><?php echo 'Juin'; ?></th>
			<th><?php echo 'Juil.'; ?></th>
			<th><?php echo 'Août'; ?></th>
			<th><?php echo 'Sept.'; ?></th>
			<th><?php echo 'Oct.'; ?></th>
			<th><?php echo 'Nov.'; ?></th>
			<th><?php echo 'Déc.'; ?></th>                        
			<th><?php echo 'Total'; ?></th>
			<th class="actions"></th>
	</tr>
	</thead>
        <tbody>        
	<?php if (isset($detailplancharges)): ?>
	<?php foreach ($detailplancharges as $detailplancharge): ?>
	<tr>
		<td><?php echo h($detailplancharge['Utilisateur']['NOMLONG']); ?>&nbsp;</td>
		<td><?php echo h($detailplancharge['Domaine']['NOM']); ?>&nbsp;</td>
		<td><?php echo h($detailplancharge['Projet']['NOM'].'-'.$detailplancharge['Activite']['NOM']); ?>&nbsp;</td>
		<td style='text-align: right;'><?php echo h($detailplancharge['Utilisateur']['WORKCAPACITY']); ?>&nbsp;</td>  
                <?php for($i=0; $i<12;$i++): ?>
                    <td style='text-align: right;'><?php echo h($detailplancharge['Detailplancharge']['CHARGEPREVUE']); ?>&nbsp;j</td>
                <?php endfor; ?>
                <td style='text-align: right;'>&nbsp;j</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $detailplancharge['Detailplancharge']['id'])); ?>
		</td>
	</tr>
        <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
        <tfooter>
        <tr>
            <td colspan='16' class="footer" style='text-align:right;'>Total :</td>
            <td class="footer" colspan='2'></td>
        </tr>
        </tfooter>
    </table>
    <div class="navbar">
        <div class="navbar-inner">
            <div class="container" style="margin-top:2px;text-align:center;">
                <?php echo $this->Form->button('Annuler', array('type'=>'button','class' => 'btn showoverlay','onclick'=>"location.href='".goPrev()."'")); ?>&nbsp;<?php echo $this->Form->button('Enregistrer', array('class' => 'btn btn-primary','type'=>'submit')); ?>                
            </div>
        </div>
    </div>  
    <?php echo $this->Form->end(); ?>  
</div>
