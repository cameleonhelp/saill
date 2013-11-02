<div class="autorisations index">
        <nav class="navbar toolbar marginright20">
                <ul class="nav navbar-nav toolbar">
                <?php if (userAuth('profil_id')!='2' && isAuthorized('autorisations', 'add')) : ?>
                <li><?php echo $this->Html->link('<span class="glyphicons plus size14 margintop4"></span>', array('action' => 'add'),array('escape' => false,'class'=>'showoverlay')); ?></li>
                <li class="divider-vertical-only"></li>
                <?php endif; ?>
                <li class="dropdown <?php echo filtre_is_actif(isset($this->params->pass[0]) ? $this->params->pass[0] : 'tous','tous'); ?>">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Filtre Profils <b class="caret"></b></a>
                     <ul class="dropdown-menu">
                     <li><?php echo $this->Html->link('Tous', array('action' => 'index','tous'),array('class'=>'showoverlay'.subfiltre_is_actif(isset($this->params->pass[0]) ? $this->params->pass[0] : 'tous','tous'))); ?></li>
                     <li class="divider"></li>
                         <?php foreach ($profils as $profil): ?>
                            <li><?php echo $this->Html->link($profil['Profil']['NOM'], array('action' => 'index',$profil['Profil']['id']),array('class'=>'showoverlay'.subfiltre_is_actif(isset($this->params->pass[0]) ? $this->params->pass[0] : 'tous',$profil['Profil']['id']))); ?></li>
                         <?php endforeach; ?>
                      </ul>
                 </li>                
                </ul> 
                <?php echo $this->Form->create("Autorisation",array('action' => 'search', 'class'=>'toolbar-form pull-right','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?>
                    <?php echo $this->Form->input('SEARCH',array('placeholder'=>'Recherche ...','style'=>"width: 200px;",'class'=>"form-control")); ?>
                    <button type="submit" class="btn form-btn showoverlay">Rechercher</button>
                <?php echo $this->Form->end(); ?>                                 
        </nav>
        <?php if ($this->params['action']=='index') { ?><div class="panel-body panel-filter marginbottom15 marginright20"><strong>Filtre appliqué : </strong><em>Liste des autorisations pour <?php echo $fprofil; ?></em></div><?php } ?>
        <div class="marginright10"> 
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
                    <?php echo '<span class="glyphicons eye_open" data-rel="popover" data-title="<h3>Autorisation :</h3>" data-content="<contenttitle>Crée le: </contenttitle>'.h($autorisation['Autorisation']['created']).'<br/><contenttitle>Modifié le: </contenttitle>'.h($autorisation['Autorisation']['modified']).'" data-trigger="click" style="cursor: pointer;"></span>'; ?>&nbsp;
                    <?php endif; ?>
                    <?php if ((userAuth('profil_id')!='1' || userAuth('profil_id')!='2') && h($autorisation['Autorisation']['MODEL'])!='autorisations' && isAuthorized('autorisations', 'edit')) : ?>
                    <?php echo $this->Html->link('<span class="glyphicons pencil showoverlay notchange"></span>', array('action' => 'edit', $autorisation['Autorisation']['id']),array('escape' => false,'class'=>'showoverlay')); ?>&nbsp;
                    <?php endif; ?>
                    <?php if (userAuth('profil_id')!='2' && isAuthorized('autorisations', 'delete')) : ?>
                    <?php echo $autorisation['Autorisation']['profil_id']>1 ?  $this->Form->postLink('<span class="glyphicons showoverlay bin notchange"></span>', array('action' => 'delete', $autorisation['Autorisation']['id']),array('escape' => false), __('Etes-vous certain de vouloir supprimer cette autorisation ?')) : ''; ?>                    
                    <?php endif; ?>
                </td>
	</tr>
        <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
	</table>
        </div>
	<div class="pull-left"><?php echo $this->Paginator->counter('Page {:page} sur {:pages}'); ?></div>
	<div class="pull-right marginright20"><?php echo $this->Paginator->counter('Nombre total d\'éléments : {:count}'); ?></div>     
        <div class='text-center'>
        <ul class="pagination pagination-sm">
	<?php
                echo "<li>".$this->Paginator->first('<<', true, null, array('class' => 'disabled showoverlay','escape'=>false))."</li>";
		echo "<li>".$this->Paginator->prev('<', array(), null, array('class' => 'prev disabled showoverlay','escape'=>false))."</li>";
		echo "<li>".$this->Paginator->numbers(array('separator' => '','class'=>'showoverlay'))."</li>";
		echo "<li>".$this->Paginator->next('>', array(), null, array('class' => 'disabled showoverlay','escape'=>false))."</li>";
                echo "<li>".$this->Paginator->last('>>', true, null, array('class' => 'disabled showoverlay','escape'=>false))."</li>";
	?>
        </ul>
        </div>
</div>
