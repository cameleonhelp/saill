<div class="materielinformatiques view">
<h2><?php  echo __('Materielinformatique'); ?></h2>
	<dl>
		<dt><?php echo __('ID'); ?></dt>
		<dd>
			<?php echo h($materielinformatique['Materielinformatique']['ID']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('TYPEMATERIEL ID'); ?></dt>
		<dd>
			<?php echo h($materielinformatique['Materielinformatique']['TYPEMATERIEL_ID']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('SECTION ID'); ?></dt>
		<dd>
			<?php echo h($materielinformatique['Materielinformatique']['SECTION_ID']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('ASSISTANCE ID'); ?></dt>
		<dd>
			<?php echo h($materielinformatique['Materielinformatique']['ASSISTANCE_ID']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('NOM'); ?></dt>
		<dd>
			<?php echo h($materielinformatique['Materielinformatique']['NOM']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('ETAT'); ?></dt>
		<dd>
			<?php echo h($materielinformatique['Materielinformatique']['ETAT']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('WIFI'); ?></dt>
		<dd>
			<?php echo h($materielinformatique['Materielinformatique']['WIFI']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('VPN'); ?></dt>
		<dd>
			<?php echo h($materielinformatique['Materielinformatique']['VPN']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('COMMENTAIRE'); ?></dt>
		<dd>
			<?php echo h($materielinformatique['Materielinformatique']['COMMENTAIRE']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($materielinformatique['Materielinformatique']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($materielinformatique['Materielinformatique']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Materielinformatique'), array('action' => 'edit', $materielinformatique['Materielinformatique']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Materielinformatique'), array('action' => 'delete', $materielinformatique['Materielinformatique']['id']), null, __('Are you sure you want to delete # %s?', $materielinformatique['Materielinformatique']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Materielinformatiques'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Materielinformatique'), array('action' => 'add')); ?> </li>
	</ul>
</div>
