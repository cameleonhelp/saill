<div class="profils index">
        <div class="navbar">
            <div class="navbar-inner">
                <div class="container">
                <ul class="nav">
                <?php if (userAuth('profil_id')!='2' && isAuthorized('profils', 'add')) : ?>
                <li><?php echo $this->Html->link('<span class="glyphicons plus size14"></span>', array('action' => 'add'),array('escape' => false)); ?></li>
                <?php endif; ?>
                </ul> 
                <?php echo $this->Form->create("Profil",array('action' => 'search','class'=>'navbar-form clearfix pull-right','inputDefaults' => array('label'=>false,'div' => false))); ?>
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
			<th><?php echo $this->Paginator->sort('COMMENTAIRE','Description'); ?></th>
			<th class="actions" width="75px;"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
        <tbody>
	<?php if (isset($profils)): ?>
	<?php foreach ($profils as $profil): ?>
	<tr>
		<td><?php echo h($profil['Profil']['NOM']); ?>&nbsp;</td>
		<td><?php echo $profil['Profil']['COMMENTAIRE']; ?>&nbsp;</td>
		<td class="actions">
                    <?php if (userAuth('profil_id')!='2' && isAuthorized('profils', 'view')) : ?>
                    <?php echo '<span class="glyphicons eye_open" rel="popover" data-title="<h3>Profil :</h3>" data-content="<contenttitle>Crée le: </contenttitle>'.h($profil['Profil']['created']).'<br/><contenttitle>Modifié le: </contenttitle>'.h($profil['Profil']['modified']).'" data-trigger="click" style="cursor: pointer;"></span>'; ?>&nbsp;
                    <?php endif; ?>
                    <?php if (userAuth('profil_id')!='2' && isAuthorized('profils', 'edit')) : ?>
                    <?php echo $this->Html->link('<span class="glyphicons pencil"></span>', array('action' => 'edit', $profil['Profil']['id']),array('escape' => false)); ?>&nbsp;
                    <?php endif; ?>
                    <?php if (userAuth('profil_id')!='2' && isAuthorized('profils', 'delete')) : ?>
                    <?php echo $profil['Profil']['id'] > 10 ? $this->Form->postLink('<span class="glyphicons bin"></span>', array('action' => 'delete', $profil['Profil']['id']),array('escape' => false), __('Etes-vous certain de vouloir supprimer ce profil ?') ): '<span class="glyphicons blank"></span>'; ?>
                    <?php else : ?>
                    <span class="glyphicons blank"></span>
                    <?php endif; ?>
                    <?php if (userAuth('profil_id')!='2' && isAuthorized('profils', 'duplicate')) : ?>
                    <?php echo $this->Form->postLink('<span class="glyphicons retweet"></span>', array('action' => 'dupliquer', $profil['Profil']['id']),array('escape' => false), __('Etes-vous certain de vouloir dupliquer ce profil et ses autorisations ?')); ?>
                    <?php endif; ?>                    
		</td>
	</tr>
        <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
	</table>
	<div class="pull-left"><?php echo $this->Paginator->counter('Page {:page} sur {:pages}'); ?></div>
	<div class="pull-right"><?php echo $this->Paginator->counter('Nombre total d\'éléments : {:count}'); ?></div>    
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
