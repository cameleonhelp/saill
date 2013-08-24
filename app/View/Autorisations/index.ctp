<div class="autorisations index">
        <div class="navbar">
            <div class="navbar-inner">
                <div class="container">
                <ul class="nav">
                <?php if (userAuth('profil_id')!='2' && isAuthorized('autorisations', 'add')) : ?>
                <li><?php echo $this->Html->link('<span class="glyphicons plus size14"></span>', array('action' => 'add'),array('escape' => false,'class'=>'showoverlay')); ?></li>
                <li class="divider-vertical-only"></li>
                <?php endif; ?>
                <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Filtre Profils <b class="caret"></b></a>
                     <ul class="dropdown-menu">
                     <li><?php echo $this->Html->link('Tous', array('action' => 'index','tous'),array('class'=>'showoverlay')); ?></li>
                     <li class="divider"></li>
                         <?php foreach ($profils as $profil): ?>
                            <li><?php echo $this->Html->link($profil['Profil']['NOM'], array('action' => 'index',$profil['Profil']['id']),array('class'=>'showoverlay')); ?></li>
                         <?php endforeach; ?>
                      </ul>
                 </li>                
                </ul> 
                <?php echo $this->Form->create("Autorisation",array('action' => 'search','class'=>'navbar-form clearfix pull-right','inputDefaults' => array('label'=>false,'div' => false))); ?>
                    <?php echo $this->Form->input('SEARCH',array('placeholder'=>'Recherche dans tous les champs')); ?>
                    <button type="submit" class="btn showoverlay">Rechercher</button>
                <?php echo $this->Form->end(); ?>                     
                </div>
            </div>
        </div>
        <?php if ($this->params['action']=='index') { ?><code class="text-normal"  style="margin-bottom: 10px;display: block;"><em>Liste des autorisations pour <?php echo $fprofil; ?></em></code><?php } ?>
        <table cellpadding="0" cellspacing="0" class="table table-bordered table-striped table-hover">
        <thead>
	<tr>
			<th><?php echo $this->Paginator->sort('profil_id','Profil'); ?></th>
			<th><?php echo $this->Paginator->sort('MODEL','Modèle'); ?></th>
			<th><?php echo $this->Paginator->sort('INDEX','Lister'); ?></th>
			<th><?php echo $this->Paginator->sort('ADD','Ajouter'); ?></th>
			<th><?php echo $this->Paginator->sort('EDIT','Modifier'); ?></th>
			<th><?php echo $this->Paginator->sort('VIEW','Visualiser'); ?></th>
			<th><?php echo $this->Paginator->sort('DELETE','Supprimer'); ?></th>
			<th><?php echo $this->Paginator->sort('DUPLICATE','Dupliquer'); ?></th>
			<th><?php echo $this->Paginator->sort('INITPASSWORD','Initialiser le mot de passe'); ?></th>
                        <th><?php echo $this->Paginator->sort('ABSENCES','Calendrier des absences'); ?></th>
                        <th><?php echo $this->Paginator->sort('RAPPORTS','Rapports'); ?></th>
                        <th><?php echo $this->Paginator->sort('UPDATE','Mise à jour'); ?></th>
                        <th><?php echo $this->Paginator->sort('MYPROFIL','Mon profil'); ?></th>
                        <th><?php echo $this->Paginator->sort('MASSE','Saisie en masse'); ?></th>
			<th class="actions" width="60px;"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
        <tbody>
	<?php if (isset($autorisations)): ?>
	<?php foreach ($autorisations as $autorisation): ?>
	<tr>
		<td><?php echo h($autorisation['Profil']['NOM']); ?>&nbsp;</td>
		<td><?php echo h($autorisation['Autorisation']['MODEL']); ?>&nbsp;</td>
		<td style='text-align:center;'><?php echo h($autorisation['Autorisation']['INDEX'])==1 ? '<span class="glyphicons ok_2 green"></span>' : ''; ?>&nbsp;</td>
		<td style='text-align:center;'><?php echo h($autorisation['Autorisation']['ADD'])==1 ? '<span class="glyphicons ok_2 green"></span>' : ''; ?>&nbsp;</td>
		<td style='text-align:center;'><?php echo h($autorisation['Autorisation']['EDIT'])==1 ? '<span class="glyphicons ok_2 green"></span>' : ''; ?>&nbsp;</td>
		<td style='text-align:center;'><?php echo h($autorisation['Autorisation']['VIEW'])==1 ? '<span class="glyphicons ok_2 green"></span>' : ''; ?>&nbsp;</td>
		<td style='text-align:center;'><?php echo h($autorisation['Autorisation']['DELETE'])==1 ? '<span class="glyphicons ok_2 green"></span>' : ''; ?>&nbsp;</td>
		<td style='text-align:center;'><?php echo h($autorisation['Autorisation']['DUPLICATE'])==1 ? '<span class="glyphicons ok_2 green"></span>' : ''; ?>&nbsp;</td>
		<td style='text-align:center;'><?php echo h($autorisation['Autorisation']['INITPASSWORD'])==1 ? '<span class="glyphicons ok_2 green"></span>' : ''; ?>&nbsp;</td>
                <td style='text-align:center;'><?php echo h($autorisation['Autorisation']['ABSENCES'])==1 ? '<span class="glyphicons ok_2 green"></span>' : ''; ?>&nbsp;</td>
                <td style='text-align:center;'><?php echo h($autorisation['Autorisation']['RAPPORTS'])==1 ? '<span class="glyphicons ok_2 green"></span>' : ''; ?>&nbsp;</td>
                <td style='text-align:center;'><?php echo h($autorisation['Autorisation']['UPDATE'])==1 ? '<span class="glyphicons ok_2 green"></span>' : ''; ?>&nbsp;</td>
                <td style='text-align:center;'><?php echo h($autorisation['Autorisation']['MYPROFIL'])==1 ? '<span class="glyphicons ok_2 green"></span>' : ''; ?>&nbsp;</td>
                <td style='text-align:center;'><?php echo h($autorisation['Autorisation']['MASSE'])==1 ? '<span class="glyphicons ok_2 green"></span>' : ''; ?>&nbsp;</td>
		<td class="actions">
                    <?php if (userAuth('profil_id')!='2' && isAuthorized('autorisations', 'view')) : ?>
                    <?php echo '<span class="glyphicons eye_open" rel="popover" data-title="<h3>Autorisation :</h3>" data-content="<contenttitle>Crée le: </contenttitle>'.h($autorisation['Autorisation']['created']).'<br/><contenttitle>Modifié le: </contenttitle>'.h($autorisation['Autorisation']['modified']).'" data-trigger="click" style="cursor: pointer;"></span>'; ?>&nbsp;
                    <?php endif; ?>
                    <?php if ((userAuth('profil_id')!='1' || userAuth('profil_id')!='2') && h($autorisation['Autorisation']['MODEL'])!='autorisations' && isAuthorized('autorisations', 'edit')) : ?>
                    <?php echo $this->Html->link('<span class="glyphicons pencil"></span>', array('action' => 'edit', $autorisation['Autorisation']['id']),array('escape' => false,'class'=>'showoverlay')); ?>&nbsp;
                    <?php endif; ?>
                    <?php if (userAuth('profil_id')!='2' && isAuthorized('autorisations', 'delete')) : ?>
                    <?php echo $autorisation['Autorisation']['profil_id']>1 ?  $this->Form->postLink('<span class="glyphicons bin"></span>', array('action' => 'delete', $autorisation['Autorisation']['id']),array('escape' => false), __('Etes-vous certain de vouloir supprimer cette autorisation ?')) : ''; ?>                    
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
