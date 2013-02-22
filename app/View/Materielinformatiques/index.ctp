 <?php
 /**
 * etatMaterielInformatiqueImage method
 *
 * @throws NotFoundException
 * @throws MethodNotAllowedException
 * @param string $etat
 * @return string class
 */  
        function etatMaterielInformatiqueImage($etat) {
            $class = '';
            switch ($etat){
                 case 'En stock':
                    $class = 'icon-inbox';
                    break;
                 case 'En dotation':
                    $class = 'icon-lock';
                    break;                
                 case 'En réparation':
                    $class = 'icon-wrench';
                    break;          
                 case 'Au rebut':
                    $class = 'icon-trash icon-grey';
                    break;
                 case 'Non localisé':
                    $class = 'icon-map-marker icon-red';
                    break;                
            }
            return $class;
        } 
?>        
<div class="materielinformatiques index">
        <div class="navbar">
            <div class="navbar-inner">
                <div class="container">
                <ul class="nav">
                <li><?php echo $this->Html->link('<i class="icon-plus"></i>', array('action' => 'add'),array('escape' => false)); ?></li>
                <li class="divider-vertical"></li>
                <li><a href="#"><i class="ico-xls"></i></a></li>
                </ul> 
                </div>
            </div>
        </div>
        <table cellpadding="0" cellspacing="0" class="table table-bordered table-striped table-hover">
        <thead>
	<tr>
			<th><?php echo $this->Paginator->sort('NOM','Nom'); ?></th>
			<th><?php echo $this->Paginator->sort('typemateriel_id','Type de matériel'); ?></th>
			<th><?php echo $this->Paginator->sort('section_id','Section'); ?></th>
			<th><?php echo $this->Paginator->sort('assistance_id','Assistance'); ?></th>
                        <th width="40px;"><?php echo $this->Paginator->sort('WIFI','Wifi'); ?></th>
			<th width="40px;"><?php echo $this->Paginator->sort('VPN','Accès distant'); ?></th>
			<th><?php echo $this->Paginator->sort('ETAT','Etat'); ?></th>
                        <th class="actions" width="60px;"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
        <tbody>
	<?php foreach ($materielinformatiques as $materielinformatique): ?>
	<tr>
		<td><?php echo h($materielinformatique['Materielinformatique']['NOM']); ?>&nbsp;</td>
		<td><?php echo h($materielinformatique['Typemateriel']['NOM']); ?>&nbsp;</td>
		<td><?php echo h($materielinformatique['Section']['NOM']); ?>&nbsp;</td>
		<td><?php echo h($materielinformatique['Assistance']['NOM']); ?>&nbsp;</td>
		<td style='text-align:center;'><?php echo h($materielinformatique['Materielinformatique']['WIFI'])==1 ? '<i class="icon-ok"></i>' : ''; ?>&nbsp;</td>
		<td style='text-align:center;'><?php echo h($materielinformatique['Materielinformatique']['VPN'])==1 ? '<i class="icon-ok"></i>' : ''; ?>&nbsp;</td>
                <td style='text-align:center;'><i class="<?php echo etatMaterielInformatiqueImage(h($materielinformatique['Materielinformatique']['ETAT'])); ?>" rel="tooltip" data-title="<?php echo h($materielinformatique['Materielinformatique']['ETAT']); ?>"></i>&nbsp;</td>
		<td class="actions">
                        <?php echo '<i class="icon-eye-open" rel="popover" data-title="<h3>Poste informatique :</h3>" data-content="<contenttitle>Crée le: </contenttitle>'.h($materielinformatique['Materielinformatique']['created']).'<br/><contenttitle>Modifié le: </contenttitle>'.h($materielinformatique['Materielinformatique']['modified']).'" data-trigger="click" style="cursor: pointer;"></i>'; ?>&nbsp;
			<?php echo $this->Html->link('<i class="icon-pencil"></i>', array('action' => 'edit', $materielinformatique['Materielinformatique']['id']),array('escape' => false)); ?>&nbsp;
			<?php echo $this->Form->postLink('<i class="icon-trash"></i>', array('action' => 'delete', $materielinformatique['Materielinformatique']['id']),array('escape' => false), __('Etes-vous certain de vouloir supprimer ce poste informatique ?')); ?>

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
