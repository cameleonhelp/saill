<div class="actions view">
<h2><?php  echo __('Action'); ?></h2>
	<dl>
		<dt><?php echo __('ID'); ?></dt>
		<dd>
			<?php echo h($action['Action']['ID']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('DOMAINE ID'); ?></dt>
		<dd>
			<?php echo h($action['Action']['DOMAINE_ID']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('ACTIVITE ID'); ?></dt>
		<dd>
			<?php echo h($action['Action']['ACTIVITE_ID']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('UTILISATEUR ID'); ?></dt>
		<dd>
			<?php echo h($action['Action']['UTILISATEUR_ID']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('DESTINATAIRE'); ?></dt>
		<dd>
			<?php echo h($action['Action']['DESTINATAIRE']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('LIVRABLE ID'); ?></dt>
		<dd>
			<?php echo h($action['Action']['LIVRABLE_ID']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('FACTURATION'); ?></dt>
		<dd>
			<?php echo h($action['Action']['FACTURATION']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('OBJET'); ?></dt>
		<dd>
			<?php echo h($action['Action']['OBJET']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('DESCRIPTION'); ?></dt>
		<dd>
			<?php echo h($action['Action']['DESCRIPTION']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('AVANCEMENT'); ?></dt>
		<dd>
			<?php echo h($action['Action']['AVANCEMENT']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('COMMENTAIRE'); ?></dt>
		<dd>
			<?php echo h($action['Action']['COMMENTAIRE']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('DEBUT'); ?></dt>
		<dd>
			<?php echo h($action['Action']['DEBUT']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('ECHEANCE'); ?></dt>
		<dd>
			<?php echo h($action['Action']['ECHEANCE']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('DEBUTREELLE'); ?></dt>
		<dd>
			<?php echo h($action['Action']['DEBUTREELLE']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('PERIODE'); ?></dt>
		<dd>
			<?php echo h($action['Action']['PERIODE']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('STATUT'); ?></dt>
		<dd>
			<?php echo h($action['Action']['STATUT']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('HIERARCHIQUE'); ?></dt>
		<dd>
			<?php echo h($action['Action']['HIERARCHIQUE']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('DUREEPREVUE'); ?></dt>
		<dd>
			<?php echo h($action['Action']['DUREEPREVUE']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('DUREEREELLE'); ?></dt>
		<dd>
			<?php echo h($action['Action']['DUREEREELLE']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('PRIORITE'); ?></dt>
		<dd>
			<?php echo h($action['Action']['PRIORITE']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('TYPE'); ?></dt>
		<dd>
			<?php echo h($action['Action']['TYPE']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($action['Action']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($action['Action']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Action'), array('action' => 'edit', $action['Action']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Action'), array('action' => 'delete', $action['Action']['id']), null, __('Are you sure you want to delete # %s?', $action['Action']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Actions'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Action'), array('action' => 'add')); ?> </li>
	</ul>
</div>
