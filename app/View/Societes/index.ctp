<div class="societes index">
        <div class="navbar">
            <div class="navbar-inner">
                <div class="container">
                <ul class="nav">
                <?php if (userAuth('profil_id')!='2' && isAuthorized('societes', 'add')) : ?>
                <li><?php echo $this->Html->link('<span class="glyphicons plus size14"></span>', array('action' => 'add'),array('escape' => false)); ?></li>
                <?php endif; ?>
                </ul> 
                <?php echo $this->Form->create("Societe",array('action' => 'search','class'=>'navbar-form clearfix pull-right','inputDefaults' => array('label'=>false,'div' => false))); ?>
                    <?php echo $this->Form->input('SEARCH',array('placeholder'=>'Recherche dans tous les champs')); ?>
                    <button type="submit" class="btn">Rechercher</button>
                <?php echo $this->Form->end(); ?> 
                </div>
            </div>
        </div>
        <table cellpadding="0" cellspacing="0" class="table table-bordered table-striped table-hover">
        <thead>
	<tr>
			<th><?php echo $this->Paginator->sort('NOM','Nom'); ?></th>
			<th><?php echo $this->Paginator->sort('NOMCONTACT','Contact'); ?></th>
			<th><?php echo $this->Paginator->sort('TELEPHONE','Téléphone'); ?></th>
			<th><?php echo $this->Paginator->sort('MAIL','Email'); ?></th>
			<th class="actions" width="60px;"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
        <tbody>
	<?php if (isset($societes)): ?>
	<?php foreach ($societes as $societe): ?>
	<tr>
		<td><?php echo h($societe['Societe']['NOM']); ?>&nbsp;</td>
		<td><?php echo h(isset($societe['Societe']['NOMCONTACT']) ? $societe['Societe']['NOMCONTACT'] : ''); ?>&nbsp;</td>
		<td><?php echo h(isset($societe['Societe']['TELEPHONE']) ? $societe['Societe']['TELEPHONE'] : ''); ?>&nbsp;</td>
		<td><?php echo h(isset($societe['Societe']['MAIL']) ? $societe['Societe']['MAIL'] : ''); ?>&nbsp;<?php echo h(!empty($societe['Societe']['MAIL'])) ? '<a href="mailto:'.$societe['Societe']['MAIL'].'"><span class="glyphicons envelope"></span></a>' : ''; ?></td>
                <td class="actions">
                    <?php if (userAuth('profil_id')!='2' && isAuthorized('societes', 'view')) : ?>
                    <?php echo '<span class="glyphicons eye_open" rel="popover" data-title="<h3>Société :</h3>" data-content="<contenttitle>Crée le: </contenttitle>'.h($societe['Societe']['created']).'<br/><contenttitle>Modifié le: </contenttitle>'.h($societe['Societe']['modified']).'" data-trigger="click" style="cursor: pointer;"></span>'; ?>&nbsp;
                    <?php endif; ?>
                    <?php if (userAuth('profil_id')!='2' && isAuthorized('societes', 'edit')) : ?>
                    <?php echo $this->Html->link('<span class="glyphicons pencil"></span>', array('action' => 'edit', $societe['Societe']['id']),array('escape' => false)); ?>&nbsp;
                    <?php endif; ?>
                    <?php if (userAuth('profil_id')!='2' && isAuthorized('societes', 'delete')) : ?>
                    <?php echo $societe['Societe']['id']>1 ? $this->Form->postLink('<span class="glyphicons bin"></span>', array('action' => 'delete', $societe['Societe']['id']),array('escape' => false), __('Etes-vous certain de vouloir supprimer cette société ?')):''; ?>
                    <?php endif; ?>
		</td>
	</tr>
        <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
	</table>
        <div class="pull-left">	<?php	echo $this->Paginator->counter('Page {:page} sur {:pages}');	?></div>
        <div class="pull-right"><?php	echo $this->Paginator->counter('Nombre total d\'éléments : {:count}');	?></div>
        <div class="pagination  pagination-centered showoverlay">
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
