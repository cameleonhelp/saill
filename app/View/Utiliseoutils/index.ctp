<div class="utiliseoutils index">
        <div class="navbar">
            <div class="navbar-inner">
                <div class="container">
                <ul class="nav">
                <?php if (userAuth('profil_id')!='2' && isAuthorized('utiliseoutils', 'add')) : ?>
                <li><?php echo $this->Html->link('<i class="icon-plus"></i>', array('action' => 'add'),array('escape' => false)); ?></li>
                <li class="divider-vertical"></li>
                <?php endif; ?>
                <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Filtre Etats <b class="caret"></b></a>
                     <ul class="dropdown-menu">
                     <li><?php echo $this->Html->link('Tous', array('action' => 'index','tous')); ?></li>
                     <li class="divider"></li>
                         <?php foreach ($etats as $etat): ?>
                            <li><?php echo $this->Html->link($etat['Utiliseoutil']['STATUT'], array('action' => 'index',$etat['Utiliseoutil']['STATUT'])); ?></li>
                         <?php endforeach; ?>
                      </ul>
                 </li>   
                 <li class="divider-vertical"></li>
                <li><a href="#"><i class="ico-xls"></i></a></li>                
                </ul> 
                <?php echo $this->Form->create("Utiliseoutil",array('action' => 'search','class'=>'navbar-form clearfix pull-right','inputDefaults' => array('label'=>false,'div' => false))); ?>
                    <?php echo $this->Form->input('SEARCH',array('class'=>'span8','placeholder'=>'Recherche dans tous les champs')); ?>
                    <button type="submit" class="btn">Rechercher</button>
                <?php echo $this->Form->end(); ?>                     
                </div>
            </div>
        </div>
        <?php if ($this->params['action']=='index') { ?><code class="text-normal"  style="margin-bottom: 10px;display: block;"><em>Liste des droits <?php echo $fetat; ?></em></code><?php }?>   
        <table cellpadding="0" cellspacing="0" class="table table-bordered table-striped table-hover">
        <thead>
	<tr>
			<th><?php echo $this->Paginator->sort('utilisateur_id','Utilisateur'); ?></th>
			<th><?php echo $this->Paginator->sort('outil_id','Outil'); ?></th>
                        <th><?php echo $this->Paginator->sort('outil_id','Liste de diffusion'); ?></th>
                        <th><?php echo $this->Paginator->sort('outil_id','Partage réseau'); ?></th>
			<th><?php echo $this->Paginator->sort('STATUT','Etat'); ?></th>
			<th class="actions" width="60px;"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
        <tbody>
	<?php foreach ($utiliseoutils as $utiliseoutil): ?>
	<tr>
		<td><?php echo h($utiliseoutil['Utilisateur']['NOM'].' '.$utiliseoutil['Utilisateur']['PRENOM']); ?>&nbsp;</td>
		<td><?php echo h($utiliseoutil['Outil']['NOM']); ?>&nbsp;</td>
                <td><?php echo h($utiliseoutil['Listediffusion']['NOM']); ?>&nbsp;</td>
                <td><?php echo h($utiliseoutil['Dossierpartage']['NOM']); ?>&nbsp;</td>
                <?php if (userAuth('profil_id')!='2' && isAuthorized('utiliseoutils', 'update')) : ?>
                <td style='text-align:center;'><?php echo $this->Html->link('<i class="'.etatUtiliseOutilImage(h($utiliseoutil['Utiliseoutil']['STATUT'])).'" rel="tooltip" data-title="'.h($utiliseoutil['Utiliseoutil']['STATUT']).'"></i>', array('action' => 'progressState', h($utiliseoutil['Utiliseoutil']['id'])), array('escape' => false), __('Etes-vous certain de vouloir mettre à jour le statut de cette demande de droit ?')); ?></td>
                <?php else : ?>
                <td style='text-align:center;'><?php echo '<i class="'.etatUtiliseOutilImage(h($utiliseoutil['Utiliseoutil']['STATUT'])).'" rel="tooltip" data-title="'.h($utiliseoutil['Utiliseoutil']['STATUT']).'"></i>'; ?></td>                
                <?php endif; ?>
		<td class="actions">
                    <?php if (userAuth('profil_id')!='2' && isAuthorized('utiliseoutils', 'view')) : ?>
                    <?php echo '<i class="icon-eye-open" rel="popover" data-title="<h3>Demande de droit :</h3>" data-content="<contenttitle>Crée le: </contenttitle>'.h($utiliseoutil['Utiliseoutil']['created']).'<br/><contenttitle>Modifié le: </contenttitle>'.h($utiliseoutil['Utiliseoutil']['modified']).'" data-trigger="click" style="cursor: pointer;"></i>'; ?>&nbsp;
                    <?php endif; ?>
                    <?php if (userAuth('profil_id')!='2' && isAuthorized('utiliseoutils', 'edit')) : ?>
                    <?php echo $this->Html->link('<i class="icon-pencil"></i>', array('action' => 'edit', $utiliseoutil['Utiliseoutil']['id']),array('escape' => false)); ?>&nbsp;
                    <?php endif; ?>
                    <?php if (userAuth('profil_id')!='2' && isAuthorized('utiliseoutils', 'delete')) : ?>
                    <?php echo $this->Form->postLink('<i class="icon-trash"></i>', array('action' => 'delete', $utiliseoutil['Utiliseoutil']['id']),array('escape' => false), __('Etes-vous certain de vouloir supprimer cette demande de droit ?')); ?>                    
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
