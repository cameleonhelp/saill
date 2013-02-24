 <?php
 /**
 * etatMaterielInformatiqueImage method
 *
 * @throws NotFoundException
 * @throws MethodNotAllowedException
 * @param string $etat
 * @return string class
 */  
        function etatUtiliseOutilImage($etat) {
            $class = '';
            switch ($etat){
                 case 'Demandé':
                    $class = 'icon-envelope';
                    break;
                 case 'Pris en compte':
                    $class = 'icon-flag';
                    break;                
                 case 'En validation':
                    $class = 'icon-bookmark icon-grey';
                    break;          
                 case 'Validé':
                    $class = 'icon-bookmark icon-green';
                    break;
                 case 'Demande transférée':
                    $class = 'icon-share-alt';
                    break;                
                 case 'Demande traitée':
                    $class = 'icon-ok';
                    break;
                 case 'Retour utilisateur':
                    $class = 'icon-ok icon-green';
                    break;                
                 case 'A supprimer':
                    $class = 'icon-remove';
                    break;          
                 case 'Supprimée':
                    $class = 'icon-remove icon-red';
                    break; 
            }
            return $class;
        } 
?> 
<div class="utiliseoutils index">
        <div class="navbar">
            <div class="navbar-inner">
                <div class="container">
                <ul class="nav">
                <li><?php echo $this->Html->link('<i class="icon-plus"></i>', array('action' => 'add'),array('escape' => false)); ?></li>
                <li class="divider-vertical"></li>
                <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Filtre Etats <b class="caret"></b></a>
                     <ul class="dropdown-menu">
                     <li><?php echo $this->Html->link('Tous', array('action' => 'index','tous',$this->params->pass[1])); ?></li>
                     <li class="divider"></li>
                         <?php foreach ($etats as $etat): ?>
                            <li><?php echo $this->Html->link($etat['Utiliseoutil']['STATUT'], array('action' => 'index',$etat['Utiliseoutil']['STATUT'],$this->params->pass[1])); ?></li>
                         <?php endforeach; ?>
                      </ul>
                 </li>   
                <!--<li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Filtre Utilisateurs <b class="caret"></b></a>
                     <ul class="dropdown-menu">
                     <li><?php echo $this->Html->link('Tous', array('action' => 'index',$this->params->pass[0],'tous')); ?></li>
                     <li class="divider"></li>
                         <?php foreach ($utilisateurs as $utilisateur): ?>
                            <li><?php echo $this->Html->link($utilisateur['Utilisateur']['NOM'].' '.$utilisateur['Utilisateur']['PRENOM'], array('action' => 'index',$this->params->pass[0],$utilisateur['Utilisateur']['id'])); ; ?></li>
                         <?php endforeach; ?>
                      </ul>
                 </li>  //-->
                 <li class="divider-vertical"></li>
                <li><a href="#"><i class="ico-xls"></i></a></li>                
                </ul> 
                <form class="navbar-form clearfix pull-right ">
                    <input class="span8" type="text" placeholder="Recherche dans tous les champs">
                    <button type="submit" class="btn">Rechercher</button>
                </form>                     
                </div>
            </div>
        </div>
        <code class="text-normal"  style="margin-bottom: 10px;display: block;"><em>Liste des droits <?php echo $fetat; ?></em></code>     
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
                <td style='text-align:center;'><?php echo $this->Html->link('<i class="'.etatUtiliseOutilImage(h($utiliseoutil['Utiliseoutil']['STATUT'])).'" rel="tooltip" data-title="'.h($utiliseoutil['Utiliseoutil']['STATUT']).'"></i>', array('action' => 'progressState', h($utiliseoutil['Utiliseoutil']['id'])), array('escape' => false), __('Etes-vous certain de vouloir mettre à jour le statut de cette demande de droit ?')); ?>
                    </td>
		<td class="actions">
                        <?php echo '<i class="icon-eye-open" rel="popover" data-title="<h3>Demande de droit :</h3>" data-content="<contenttitle>Crée le: </contenttitle>'.h($utiliseoutil['Utiliseoutil']['created']).'<br/><contenttitle>Modifié le: </contenttitle>'.h($utiliseoutil['Utiliseoutil']['modified']).'" data-trigger="click" style="cursor: pointer;"></i>'; ?>&nbsp;
			<?php echo $this->Html->link('<i class="icon-pencil"></i>', array('action' => 'edit', $utiliseoutil['Utiliseoutil']['id']),array('escape' => false)); ?>&nbsp;
			<?php echo $this->Form->postLink('<i class="icon-trash"></i>', array('action' => 'delete', $utiliseoutil['Utiliseoutil']['id']),array('escape' => false), __('Etes-vous certain de vouloir supprimer cette demande de droit ?')); ?>                    
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
