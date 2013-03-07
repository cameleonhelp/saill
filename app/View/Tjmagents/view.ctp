<div class="tjmagents view">
<h2><?php  echo __('Tjmagent'); ?></h2>
	<dl>
		<dt><?php echo __('ID'); ?></dt>
		<dd>
			<?php echo h($tjmagent['Tjmagent']['ID']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('NOM'); ?></dt>
		<dd>
			<?php echo h($tjmagent['Tjmagent']['NOM']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('TARIFHT'); ?></dt>
		<dd>
			<?php echo h($tjmagent['Tjmagent']['TARIFHT']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('TARIFTTC'); ?></dt>
		<dd>
			<?php echo h($tjmagent['Tjmagent']['TARIFTTC']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('ANNEE'); ?></dt>
		<dd>
			<?php echo h($tjmagent['Tjmagent']['ANNEE']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($tjmagent['Tjmagent']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($tjmagent['Tjmagent']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Tjmagent'), array('action' => 'edit', $tjmagent['Tjmagent']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Tjmagent'), array('action' => 'delete', $tjmagent['Tjmagent']['id']), null, __('Are you sure you want to delete # %s?', $tjmagent['Tjmagent']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Tjmagents'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Tjmagent'), array('action' => 'add')); ?> </li>
	</ul>
</div>
