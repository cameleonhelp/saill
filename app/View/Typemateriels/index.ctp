<div class="typemateriels index">
        <div class="navbar">
            <div class="navbar-inner">
                <div class="container">
                <ul class="nav">
                <?php if (userAuth('profil_id')!='2' && isAuthorized('typemateriels', 'add')) : ?>
                <li><?php echo $this->Html->link('<span class="glyphicons plus size14"></span>', array('action' => 'add'),array('escape' => false)); ?></li>
                <?php endif; ?>
                </ul> 
                <?php echo $this->Form->create("Typemateriel",array('action' => 'search','class'=>'navbar-form clearfix pull-right','inputDefaults' => array('label'=>false,'div' => false))); ?>
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
			<th><?php echo $this->Paginator->sort('DESCRIPTION','Description'); ?></th>
			<th class="actions" width="60px;"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
        <tbody>
	<?php if (isset($typemateriels)): ?>
	<?php foreach ($typemateriels as $typemateriel): ?>
	<tr>
		<td><?php echo h($typemateriel['Typemateriel']['NOM']); ?>&nbsp;</td>
		<td><?php echo $typemateriel['Typemateriel']['DESCRIPTION']; ?>&nbsp;</td>
		<td class="actions">
                    <?php if (userAuth('profil_id')!='2' && isAuthorized('typemateriels', 'view')) : ?>
                    <?php echo '<span class="glyphicons eye_open" rel="popover" data-title="<h3>Type de matériel :</h3>" data-content="<contenttitle>Crée le: </contenttitle>'.h($typemateriel['Typemateriel']['created']).'<br/><contenttitle>Modifié le: </contenttitle>'.h($typemateriel['Typemateriel']['modified']).'" data-trigger="click" style="cursor: pointer;"></span>'; ?>&nbsp;
                    <?php endif; ?>
                    <?php if (userAuth('profil_id')!='2' && isAuthorized('typemateriels', 'edit')) : ?>
                    <?php echo $this->Html->link('<span class="glyphicons pencil"></span>', array('action' => 'edit', $typemateriel['Typemateriel']['id']),array('escape' => false)); ?>&nbsp;
                    <?php endif; ?>
                    <?php if (userAuth('profil_id')!='2' && isAuthorized('typemateriels', 'delete')) : ?>
                    <?php echo $typemateriel['Typemateriel']['id']>2 ? $this->Form->postLink('<span class="glyphicons bin"></span>', array('action' => 'delete', $typemateriel['Typemateriel']['id']),array('escape' => false), __('Etes-vous certain de vouloir supprimer ce type de matériel ?')):''; ?>                    
                    <?php endif; ?>
		</td>
	</tr>
        <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
	</table>
	<div class="pull-left"><?php echo $this->Paginator->counter('Page {:page} sur {:pages}'); ?></div>
	<div class="pull-right"><?php echo $this->Paginator->counter('Nombre total d\'éléments : {:count}'); ?></div>     
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
