<div class="domaines index">
        <div class="navbar">
            <div class="navbar-inner">
                <div class="container">
                <ul class="nav">
                <?php if (userAuth('profil_id')!='2' && isAuthorized('domaines', 'add')) : ?>
                <li><?php echo $this->Html->link('<span class="glyphicons plus size14"></span>', array('action' => 'add'),array('escape' => false,'class'=>'showoverlay')); ?></li>
                <?php endif; ?>
                </ul> 
                <?php echo $this->Form->create("Domaine",array('action' => 'search','class'=>'navbar-form clearfix pull-right','inputDefaults' => array('label'=>false,'div' => false))); ?>
                    <?php echo $this->Form->input('SEARCH',array('placeholder'=>'Recherche dans tous les champs')); ?>
                    <button type="submit" class="btn showoverlay">Rechercher</button>
                <?php echo $this->Form->end(); ?> 
                </div>
            </div>
        </div>
        <table cellpadding="0" cellspacing="0" class="table table-bordered table-striped table-hover">
        <thead>
	<tr>
			<th><?php echo $this->Paginator->sort('NOM','Nom'); ?></th>
			<th><?php echo $this->Paginator->sort('DESCRIPTION','Description'); ?></th>
			<th class="actions" width="60px;"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
        <tbody>
	<?php if (isset($domaines)): ?>
	<?php foreach ($domaines as $domaine): ?>
	<tr>
		<td><?php echo h($domaine['Domaine']['NOM']); ?>&nbsp;</td>
		<td><?php echo $domaine['Domaine']['DESCRIPTION']; ?>&nbsp;</td>
		<td class="actions">
                    <?php if (userAuth('profil_id')!='2' && isAuthorized('domaines', 'view')) : ?>
                    <?php echo '<span class="glyphicons eye_open" rel="popover" data-title="<h3>Domaine :</h3>" data-content="<contenttitle>Crée le: </contenttitle>'.h($domaine['Domaine']['created']).'<br/><contenttitle>Modifié le: </contenttitle>'.h($domaine['Domaine']['modified']).'" data-trigger="click" style="cursor: pointer;"></span>'; ?>&nbsp;
                    <?php endif; ?>
                    <?php if (userAuth('profil_id')!='2' && isAuthorized('domaines', 'edit')) : ?>
                    <?php echo $this->Html->link('<span class="glyphicons pencil"></span>', array('action' => 'edit', $domaine['Domaine']['id']),array('escape' => false,'class'=>'showoverlay')); ?>&nbsp;
                    <?php endif; ?>
                    <?php if (userAuth('profil_id')!='2' && isAuthorized('domaines', 'delete')) : ?>
                    <?php echo $this->Form->postLink('<span class="glyphicons bin"></span>', array('action' => 'delete', $domaine['Domaine']['id']),array('escape' => false), __('Etes-vous certain de vouloir supprimer ce domaine ?')); ?>
                    <?php endif; ?>
                </td>
	</tr>
        <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
	</table>
        <div class="pull-left">	<?php	echo $this->Paginator->counter('Page {:page} sur {:pages}');	?></div>
        <div class="pull-right"><?php	echo $this->Paginator->counter('Nombre total d\'éléments : {:count}');	?></div>
	<div class="pagination pagination-centered">
        <ul>
	<?php
                echo "<li>".$this->Paginator->first('<<', true, null, array('class' => 'disabled showoverlay'))."</li>";
		echo "<li>".$this->Paginator->prev('<', array(), null, array('class' => 'prev disabled showoverlay'))."</li>";
		echo "<li>".$this->Paginator->numbers(array('separator' => '','class'=>'showoverlay'))."</li>";
		echo "<li>".$this->Paginator->next('>', array(), null, array('class' => 'disabledshowoverlay'))."</li>";
                echo "<li>".$this->Paginator->last('>>', true, null, array('class' => 'disabled showoverlay'))."</li>";
	?>
        </ul>
	</div>
</div>
