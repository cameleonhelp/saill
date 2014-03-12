<div class="tjmagents index">
        <nav class="navbar toolbar ">
                <ul class="nav navbar-nav toolbar">
                <?php if (userAuth('profil_id')!='2' && isAuthorized('tjmagents', 'add')) : ?>
                <li><?php echo $this->Html->link('<span class="glyphicons plus size14 margintop4"></span>', array('action' => 'add'),array('escape' => false)); ?></li>
                <?php endif; ?>
                </ul> 
                <?php echo $this->Form->create("Tjmagent",array('action' => 'search', 'class'=>'toolbar-form pull-right','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?>
                    <?php echo $this->Form->input('SEARCH',array('placeholder'=>'Recherche ...','style'=>"width: 200px;",'class'=>"form-control")); ?>
                    <button type="submit" class="btn form-btn showoverlay"><span class="glyphicons notchange search"></span></button>
                <?php echo $this->Form->end(); ?> 
        </nav>
        <div class="">
        <table cellpadding="0" cellspacing="0" class="table table-bordered table-striped table-hover">
        <thead>
	<tr>
			<th><?php echo $this->Paginator->sort('NOM','Nom'); ?></th>
			<th><?php echo $this->Paginator->sort('TARIFHT','Tarif HT'); ?></th>
			<th><?php echo $this->Paginator->sort('TARIFTTC','Tarif TTC'); ?></th>
			<th width="40px;"><?php echo $this->Paginator->sort('ANNEE','Année'); ?></th>
			<th width="60px;" class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
        <tbody>
	<?php if (isset($tjmagents)): ?>
	<?php foreach ($tjmagents as $tjmagent): ?>
	<tr>
		<td><?php echo h($tjmagent['Tjmagent']['NOM']); ?>&nbsp;</td>
		<td style="text-align: right;"><?php echo h(isset($tjmagent['Tjmagent']['TARIFHT']) ? $tjmagent['Tjmagent']['TARIFHT'] : '0'); ?> €/j&nbsp;</td>
		<td style="text-align: right;"><?php echo h(isset($tjmagent['Tjmagent']['TARIFTTC']) ? $tjmagent['Tjmagent']['TARIFTTC'] : '0'); ?> €/j&nbsp;</td>
		<td style="text-align: center;"><?php echo h($tjmagent['Tjmagent']['ANNEE']); ?>&nbsp;</td>
		<td class="actions">
                    <?php if (userAuth('profil_id')!='2' && isAuthorized('tjmagents', 'view')) : ?>
                    <?php echo '<span class="glyphicons eye_open" data-rel="popover" data-title="<h3>TJM Agent :</h3>" data-content="<contenttitle>Crée le: </contenttitle>'.h($tjmagent['Tjmagent']['created']).'<br/><contenttitle>Modifié le: </contenttitle>'.h($tjmagent['Tjmagent']['modified']).'" data-trigger="click" style="cursor: pointer;"></span>'; ?>&nbsp;
                    <?php endif; ?>
                    <?php if (userAuth('profil_id')!='2' && isAuthorized('tjmagents', 'edit')) : ?>
                    <?php echo $this->Html->link('<span class="glyphicons pencil showoverlay notchange"></span>', array('action' => 'edit', $tjmagent['Tjmagent']['id']),array('escape' => false)); ?>&nbsp;
                    <?php endif; ?>
                    <?php if (userAuth('profil_id')!='2' && isAuthorized('tjmagents', 'delete')) : ?>
                    <?php echo $this->Form->postLink('<span class="glyphicons bin notchange"></span>', array('action' => 'delete', $tjmagent['Tjmagent']['id']),array('escape' => false), __('Etes-vous certain de vouloir supprimer ce TJM agent ?')); ?>                    
                    <?php endif; ?>
		</td>
	</tr>
        <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
	</table>
        </div>
	<div class="pull-left"><?php echo $this->Paginator->counter('Page {:page} sur {:pages}'); ?></div>
	<div class="pull-right "><?php echo $this->Paginator->counter('Nombre total d\'éléments : {:count}'); ?></div>     
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
