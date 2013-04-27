<div class="utilisateurs view">
<h2><?php  echo __('Utilisateur'); ?></h2>
	<dl>
		<dt><?php echo __('ID'); ?></dt>
		<dd>
			<?php echo h($utilisateur['Utilisateur']['ID']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('PROFIL ID'); ?></dt>
		<dd>
			<?php echo h($utilisateur['Utilisateur']['PROFIL_ID']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('SOCIETE ID'); ?></dt>
		<dd>
			<?php echo h($utilisateur['Utilisateur']['SOCIETE_ID']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('ASSISTANCE ID'); ?></dt>
		<dd>
			<?php echo h($utilisateur['Utilisateur']['ASSISTANCE_ID']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('SECTION ID'); ?></dt>
		<dd>
			<?php echo h($utilisateur['Utilisateur']['SECTION_ID']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('UTILISATEUR ID'); ?></dt>
		<dd>
			<?php echo h($utilisateur['Utilisateur']['UTILISATEUR_ID']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('DOMAINE ID'); ?></dt>
		<dd>
			<?php echo h($utilisateur['Utilisateur']['DOMAINE_ID']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('SITE ID'); ?></dt>
		<dd>
			<?php echo h($utilisateur['Utilisateur']['SITE_ID']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('TJMAGENT ID'); ?></dt>
		<dd>
			<?php echo h($utilisateur['Utilisateur']['TJMAGENT_ID']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('DOTATION ID'); ?></dt>
		<dd>
			<?php echo h($utilisateur['Utilisateur']['DOTATION_ID']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Password'); ?></dt>
		<dd>
			<?php echo h($utilisateur['Utilisateur']['password']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Username'); ?></dt>
		<dd>
			<?php echo h($utilisateur['Utilisateur']['username']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('ACTIF'); ?></dt>
		<dd>
			<?php echo h($utilisateur['Utilisateur']['ACTIF']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('DATEDEBUTACTIF'); ?></dt>
		<dd>
			<?php echo h($utilisateur['Utilisateur']['DATEDEBUTACTIF']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('NAISSANCE'); ?></dt>
		<dd>
			<?php echo h($utilisateur['Utilisateur']['NAISSANCE']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('NOM'); ?></dt>
		<dd>
			<?php echo h($utilisateur['Utilisateur']['NOM']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('PRENOM'); ?></dt>
		<dd>
			<?php echo h($utilisateur['Utilisateur']['PRENOM']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('COMMENTAIRE'); ?></dt>
		<dd>
			<?php echo h($utilisateur['Utilisateur']['COMMENTAIRE']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('FINMISSION'); ?></dt>
		<dd>
			<?php echo h($utilisateur['Utilisateur']['FINMISSION']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('MAIL'); ?></dt>
		<dd>
			<?php echo h($utilisateur['Utilisateur']['MAIL']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('TELEPHONE'); ?></dt>
		<dd>
			<?php echo h($utilisateur['Utilisateur']['TELEPHONE']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('WORKCAPACITY'); ?></dt>
		<dd>
			<?php echo h($utilisateur['Utilisateur']['WORKCAPACITY']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('CONGE'); ?></dt>
		<dd>
			<?php echo h($utilisateur['Utilisateur']['CONGE']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('RQ'); ?></dt>
		<dd>
			<?php echo h($utilisateur['Utilisateur']['RQ']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('VT'); ?></dt>
		<dd>
			<?php echo h($utilisateur['Utilisateur']['VT']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('HIERARCHIQUE'); ?></dt>
		<dd>
			<?php echo h($utilisateur['Utilisateur']['HIERARCHIQUE']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('GESTIONABSENCES'); ?></dt>
		<dd>
			<?php echo h($utilisateur['Utilisateur']['GESTIONABSENCES']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($utilisateur['Utilisateur']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($utilisateur['Utilisateur']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Utilisateur'), array('action' => 'edit', $utilisateur['Utilisateur']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Utilisateur'), array('action' => 'delete', $utilisateur['Utilisateur']['id']), null, __('Are you sure you want to delete # %s?', $utilisateur['Utilisateur']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Utilisateurs'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Utilisateur'), array('action' => 'add')); ?> </li>
	</ul>
</div>
