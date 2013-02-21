<div class="utilisateurs index">
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
			<th><?php echo $this->Paginator->sort('PRENOM','Prénom'); ?></th>
			<th><?php echo $this->Paginator->sort('section_id','Section'); ?></th>
			<th  width="80px"><?php echo $this->Paginator->sort('FINMISSION','Date de fin de mission'); ?></th>
                        <th><?php echo $this->Paginator->sort('ACTIF','Etat du compte'); ?></th>

			<th class="actions" width="80px"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
        <tbody>
	<?php foreach ($utilisateurs as $utilisateur): ?>
	<tr>
		<td><?php echo h($utilisateur['Utilisateur']['NOM']); ?>&nbsp;</td>
		<td><?php echo h($utilisateur['Utilisateur']['PRENOM']); ?>&nbsp;</td>
		<td><?php echo h($utilisateur['Section']['NOM']); ?>&nbsp;</td>
		<td><?php echo h($utilisateur['Utilisateur']['FINMISSION']); ?>&nbsp;</td>
                <td  width="80px" style="text-align: center;"><?php echo h($utilisateur['Utilisateur']['ACTIF']) == 1 ? '<i class="icon-ok"></i>' : '<i class="icon-ok icon-grey"></i>'; ?>&nbsp;</td>
		<td class="actions">
                        <?php $mail = (isset($utilisateur['Utilisateur']['MAIL']) && !empty($utilisateur['Utilisateur']['MAIL'])) ? '<a href=\'mailto:'.h($utilisateur['Utilisateur']['MAIL']).'\'>'.h($utilisateur['Utilisateur']['MAIL']).'</a>': 'Non attribué'; ?>
                        <?php echo '<i class="icon-eye-open" rel="popover" data-title="<h3>Utilisateur :</h3>" data-content="<contenttitle>Nom Prénom: </contenttitle>'.h($utilisateur['Utilisateur']['NOMLONG'])
                                    .'<br/><contenttitle>Date naissance: </contenttitle>'.h($utilisateur['Utilisateur']['NAISSANCE'])
                                    .'<br/><contenttitle>Email: </contenttitle>'.$mail
                                    .'<br/><contenttitle>Login: </contenttitle>'.h($utilisateur['Utilisateur']['username'])
                                    .'<br/><contenttitle>Société: </contenttitle>'.h($utilisateur['Societe']['NOM'])
                                    .'<br/><contenttitle>Site: </contenttitle>'.h($utilisateur['Site']['NOM'])
                                    .'<br/><contenttitle>Assistance: </contenttitle>'.h($utilisateur['Assistance']['NOM'])
                                    .'<br/><contenttitle>Créé le: </contenttitle>'.h($utilisateur['Utilisateur']['created'])
                                    .'<br/><contenttitle>Modifié le: </contenttitle>'.h($utilisateur['Utilisateur']['modified']).'" data-trigger="click" style="cursor: pointer;"></i>'; ?>&nbsp;
			<?php echo $this->Html->link('<i class="icon-pencil"></i>', array('action' => 'edit', $utilisateur['Utilisateur']['id']),array('escape' => false)); ?>&nbsp;
			<?php echo $this->Form->postLink('<i class="icon-trash"></i>', array('action' => 'delete', $utilisateur['Utilisateur']['id']),array('escape' => false), __('Etes-vous certain de vouloir supprimer cet utilisateur ?')); ?>                    
                        <?php echo $this->Form->postLink('<i class="icon-retweet"></i>', array('action' => 'dupliquer', $utilisateur['Utilisateur']['id']),array('escape' => false), __('Etes-vous certain de vouloir dupliquer cet utilisateur ?')); ?>
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
