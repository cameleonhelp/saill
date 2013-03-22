<div class="projets index">
        <div class="navbar">
            <div class="navbar-inner">
                <div class="container">
                <ul class="nav">
                <?php if (userAuth('profil_id')!='2' && isAuthorized('projets', 'add')) : ?>
                <li><?php echo $this->Html->link('<i class="icon-plus"></i>', array('action' => 'add'),array('escape' => false)); ?></li>
                <li class="divider-vertical"></li>
                <?php endif; ?>
                <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Filtre Etats <b class="caret"></b></a>
                     <ul class="dropdown-menu">
                         <li><?php echo $this->Html->link('Tous', array('action' => 'index','tous',isset($this->params->pass[1]) ? $this->params->pass[1] : 'tous')); ?></li>
                         <li class="divider"></li>
                         <li><?php echo $this->Html->link('Actif', array('action' => 'index','actif',isset($this->params->pass[1]) ? $this->params->pass[1] : 'tous')); ?></li>
                         <li><?php echo $this->Html->link('Inactif', array('action' => 'index','inactif',isset($this->params->pass[1]) ? $this->params->pass[1] : 'tous')); ?></li>
                     </ul>
                 </li> 
                <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Filtre Contrats <b class="caret"></b></a>
                     <ul class="dropdown-menu">
                     <li><?php echo $this->Html->link('Tous', array('action' => 'index',isset($this->params->pass[0]) ? $this->params->pass[0] : 'tous','tous')); ?></li>
                     <li class="divider"></li>
                         <?php foreach ($contrats as $contrat): ?>
                            <li><?php echo $this->Html->link($contrat['Contrat']['NOM'], array('action' => 'index',isset($this->params->pass[0]) ? $this->params->pass[0] : 'tous',$contrat['Contrat']['NOM'])); ?></li>
                         <?php endforeach; ?>
                      </ul>
                 </li>                   
                <li class="divider-vertical"></li>                
                <li><a href="#"><i class="ico-xls"></i></a></li>
                </ul> 
                <?php echo $this->Form->create("Projet",array('action' => 'search','class'=>'navbar-form clearfix pull-right','inputDefaults' => array('label'=>false,'div' => false))); ?>
                    <?php echo $this->Form->input('SEARCH',array('class'=>'span8','placeholder'=>'Recherche dans tous les champs')); ?>
                    <button type="submit" class="btn">Rechercher</button>
                <?php echo $this->Form->end(); ?> 
                </div>
            </div>
        </div>
        <?php if ($this->params['action']=='index') { ?><code class="text-normal"  style="margin-bottom: 10px;display: block;"><em>Liste de <?php echo $fetat; ?> sur <?php echo $fcontrat; ?></em></code><?php } ?>        
        <table cellpadding="0" cellspacing="0" class="table table-bordered table-striped table-hover">
        <thead>
	<tr>
			<th><?php echo $this->Paginator->sort('contrat_id','Contrats'); ?></th>
			<th><?php echo $this->Paginator->sort('NOM','Nom'); ?></th>
                        <th><?php echo $this->Paginator->sort('NUMEROGALLILIE','Réf. GALILEI'); ?></th>
			<th width="90px;"><?php echo $this->Paginator->sort('DEBUT','Début'); ?></th>
			<th width="90px;"><?php echo $this->Paginator->sort('FIN','Fin'); ?></th>
			<th width="50px;"><?php echo $this->Paginator->sort('ACTIF','Etat'); ?></th>
			<th width="60px;"><?php echo $this->Paginator->sort('TYPE','Type'); ?></th>
			<th width="60px;"><?php echo $this->Paginator->sort('FACTURATION','Facturation'); ?></th>
			<th class="actions" width="60px;"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
        <tbody>
	<?php foreach ($projets as $projet): ?>
	<tr>
		<td><?php echo h($projet['Contrat']['NOM']); ?>&nbsp;</td>
		<td><?php echo h($projet['Projet']['NOM']); ?>&nbsp;</td>
                <td style="text-align: right;"><?php echo h($projet['Projet']['NUMEROGALLILIE']); ?>&nbsp;</td>
		<td style="text-align: center;"><?php echo h($projet['Projet']['DEBUT']); ?>&nbsp;</td>
		<td style="text-align: center;"><?php echo h($projet['Projet']['FIN']); ?>&nbsp;</td>
		<td style="text-align: center;"><?php echo $projet['Projet']['ACTIF']==1 ? '<i class="icon-ok"></i>' : ''; ?>&nbsp;</td>
		<td style="text-align: center;"><?php echo h($projet['Projet']['TYPE']); ?>&nbsp;</td>
		<td style="text-align: center;"><?php echo h($projet['Projet']['FACTURATION']); ?>&nbsp;</td>
		<td class="actions">
                    <?php if (userAuth('profil_id')!='2' && isAuthorized('projets', 'view')) : ?>
                    <?php echo '<i class="icon-eye-open" rel="popover" data-title="<h3>Projet :</h3>" data-content="<contenttitle>Crée le: </contenttitle>'.h($projet['Projet']['created']).'<br/><contenttitle>Modifié le: </contenttitle>'.h($projet['Projet']['modified']).'" data-trigger="click" style="cursor: pointer;"></i>'; ?>&nbsp;
                    <?php endif; ?>
                    <?php if (userAuth('profil_id')!='2' && isAuthorized('projets', 'edit')) : ?>
                    <?php echo $this->Html->link('<i class="icon-pencil"></i>', array('action' => 'edit', $projet['Projet']['id']),array('escape' => false)); ?>&nbsp;
                    <?php endif; ?>
                    <?php if (userAuth('profil_id')!='2' && isAuthorized('projets', 'delete')) : ?>
                    <?php echo $this->Form->postLink('<i class="icon-trash"></i>', array('action' => 'delete', $projet['Projet']['id']),array('escape' => false), __('Etes-vous certain de vouloir supprimer ce projet ?')); ?>                    
                    <?php endif; ?>
		</td>
	</tr>
<?php endforeach; ?>
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

