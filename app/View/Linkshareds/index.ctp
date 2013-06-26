<div class="linkshareds index">
        <div class="navbar">
            <div class="navbar-inner">
                <div class="container">
                <ul class="nav">
                <?php if (userAuth('profil_id')!='2' && isAuthorized('linkshareds', 'add')) : ?>
                <li><?php echo $this->Html->link('<i class="icon-plus" rel="tooltip" data-title="Ajoutez un lien"></i>', array('action' => 'add'),array('escape' => false)); ?></li>
                <?php endif; ?>
                </ul> 
                <?php echo $this->Form->create("Linkshared",array('action' => 'search','class'=>'navbar-form clearfix pull-right','inputDefaults' => array('label'=>false,'div' => false))); ?>
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
			<th><?php echo $this->Paginator->sort('LINK','Url'); ?></th>
                        <th width="40px"><?php echo $this->Paginator->sort('LINK','Lien'); ?></th>
			<th width="60px" class="actions"><?php echo __('Actions'); ?></th>
	</tr>
        </thead>
        <tbody>
	<?php if (isset($linkshareds)): ?>
	<?php foreach ($linkshareds as $linkshared): ?>
	<tr>
		<td><?php echo h($linkshared['Linkshared']['NOM']); ?>&nbsp;</td>
		<td><?php echo h($linkshared['Linkshared']['LINK']); ?>&nbsp;</td>
		<td style="text-align: center;"><?php echo $this->Html->link('<i class="glyphicon_global" rel="tooltip" data-title="Cliquez pour ouvrir dans un nouvel onglet"></i>',$linkshared['Linkshared']['LINK'],array('escape' => false,'target'=>'_blank')); ?>&nbsp;</td>
		<td class="actions">
                    <?php if (userAuth('profil_id')!='2' && isAuthorized('linkshareds', 'view')) : ?>
                    <?php echo '<span rel="tooltip" data-title="Cliquez pour avoir un aperçu"><i class="icon-eye-open" rel="popover" data-title="<h3>Lien :</h3>" data-content="<contenttitle>Crée par: </contenttitle>'.h($linkshared['Utilisateur']['NOMLONG']).'<br/><contenttitle>Crée le: </contenttitle>'.h($linkshared['Linkshared']['created']).'<br/><contenttitle>Modifié le: </contenttitle>'.h($linkshared['Linkshared']['modified']).'" data-trigger="click" style="cursor: pointer;"></i></span>'; ?>&nbsp;
                    <?php endif; ?>
                    <?php if (userAuth('profil_id')!='2' && isAuthorized('linkshareds', 'edit') && userAuth('id')==$linkshared['Linkshared']['utilisateur_id']) : ?>
                    <?php echo $this->Html->link('<i class="icon-pencil" rel="tooltip" data-title="Modification"></i>', array('action' => 'edit', $linkshared['Linkshared']['id']),array('escape' => false)); ?>&nbsp;
                    <?php endif; ?>
                    <?php if (isAuthorized('linkshareds', 'delete') && userAuth('id')==$linkshared['Linkshared']['utilisateur_id']) : ?>
                    <?php echo $this->Form->postLink('<i class="icon-trash" rel="tooltip" data-title="Suppression"></i>', array('action' => 'delete', $linkshared['Linkshared']['id']),array('escape' => false), __('Etes-vous certain de vouloir supprimer ce lien ?')); ?>
                    <?php endif; ?>
		</td>
	</tr>
        <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
	</table>
	<div class="pull-left"><?php echo $this->Paginator->counter('Page {:page} sur {:pages}'); ?></div>
	<div class="pull-right"><?php echo $this->Paginator->counter('Nombre total d\'éléments : {:count}'); ?></div>    
	<div class="pagination  pagination-centered">
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
