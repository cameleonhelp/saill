<div class="outils index">
        <nav class="navbar toolbar marginright20">
                <ul class="nav navbar-nav toolbar">
                <?php if (userAuth('profil_id')!='2' && isAuthorized('outils', 'add')) : ?>
                <li><?php echo $this->Html->link('<span class="glyphicons plus size14 margintop4"></span>', array('action' => 'add'),array('escape' => false)); ?></li>   
                <?php endif; ?>
                </ul> 
                <?php echo $this->Form->create("Outil",array('action' => 'search', 'class'=>'toolbar-form pull-right','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?>
                    <?php echo $this->Form->input('SEARCH',array('placeholder'=>'Recherche ...','style'=>"width: 200px;",'class'=>"form-control")); ?>
                    <button type="submit" class="btn form-btn showoverlay">Rechercher</button>
                <?php echo $this->Form->end(); ?> 
        </nav>
        <div class="marginright10">
        <table cellpadding="0" cellspacing="0" class="table table-bordered table-striped table-hover">
        <thead>
	<tr>
			<th><?php echo $this->Paginator->sort('NOM','Nom'); ?></th>
                        <th><?php echo $this->Paginator->sort('Utilisateur.NOMLONG','Gestionnaire '); ?></th>
			<th width="80px;" style="text-align:center;"><?php echo $this->Paginator->sort('VALIDATION','A faire valider'); ?></th>
			<th class="actions" width="60px;"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
        <tbody>
	<?php if (isset($outils)): ?>
	<?php foreach ($outils as $outil): ?>
	<tr>
		<td><?php echo h($outil['Outil']['NOM']); ?>&nbsp;</td>
                <td><?php echo h($outil['Utilisateur']['NOMLONG']); ?>&nbsp;</td>
		<td style="text-align:center;"><?php echo h($outil['Outil']['VALIDATION']) == 1 ? '<span class="glyphicons ok_2"></span>' : ''; ?>&nbsp;</td>
		<td class="actions">
                    <?php if (userAuth('profil_id')!='2' && isAuthorized('outils', 'view')) : ?>
                    <?php echo '<span class="glyphicons eye_open" data-rel="popover" data-title="<h3>Outil :</h3>" data-content="<contenttitle>Commentaire: </contenttitle>'.h($outil['Outil']['DESCRIPTION']).'<br/><contenttitle>Crée le: </contenttitle>'.h($outil['Outil']['created']).'<br/><contenttitle>Modifié le: </contenttitle>'.h($outil['Outil']['modified']).'" data-trigger="click" style="cursor: pointer;"></span>'; ?>&nbsp;
                    <?php endif; ?>
                    <?php if (userAuth('profil_id')!='2' && isAuthorized('outils', 'edit')) : ?>
                    <?php echo $this->Html->link('<span class="glyphicons pencil showoverlay notchange"></span>', array('action' => 'edit', $outil['Outil']['id']),array('escape' => false)); ?>&nbsp;
                    <?php endif; ?>
                    <?php if (userAuth('profil_id')!='2' && isAuthorized('outils', 'delete')) : ?>
                    <?php echo $this->Form->postLink('<span class="glyphicons bin notchange"></span>', array('action' => 'delete', $outil['Outil']['id']),array('escape' => false), __('Etes-vous certain de vouloir supprimer cet outil ?')); ?>
                    <?php endif; ?>
		</td>
	</tr>
        <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
	</table>
        </div>
        <div class="pull-left">	<?php	echo $this->Paginator->counter('Page {:page} sur {:pages}');	?></div>
        <div class="pull-right marginright20"><?php	echo $this->Paginator->counter('Nombre total d\'éléments : {:count}');	?></div>
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
