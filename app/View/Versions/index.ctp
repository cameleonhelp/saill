<div class="versions index">
        <nav class="navbar toolbar ">
                <ul class="nav navbar-nav toolbar">
                <?php if (userAuth('profil_id')!='2' && isAuthorized('versions', 'add')) : ?>
                <li><?php echo $this->Html->link('<span class="glyphicons plus size14 margintop4"></span>', array('action' => 'add'),array('escape' => false)); ?></li>
                <?php endif; ?>
                </ul> 
                <?php echo $this->Form->create("Version",array('action' => 'search', 'class'=>'toolbar-form pull-right','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?>
                    <?php echo $this->Form->input('SEARCH',array('placeholder'=>'Recherche ...','style'=>"width: 200px;",'class'=>"form-control")); ?>
                    <button type="submit" class="btn form-btn showoverlay"><span class="glyphicons notchange search"></span></button>
                <?php echo $this->Form->end(); ?> 
        </nav>
        <div class="">
	<table cellpadding="0" cellspacing="0" class="table table-bordered table-striped table-hover">
	<tr>
            <th><?php echo $this->Paginator->sort('NOM','Nom'); ?></th>
            <th><?php echo $this->Paginator->sort('Lot.NOM','Lot'); ?></th>
            <th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($versions as $version): ?>
	<tr>
            <td><?php echo h($version['Version']['NOM']); ?>&nbsp;</td>
            <td><?php echo h($version['Lot']['NOM']); ?></td>
            <td class="actions">
                <?php if (userAuth('profil_id')!='2' && isAuthorized('versions', 'view')) : ?>
                <?php echo '<span class="glyphicons eye_open" data-rel="popover" data-title="<h3>Version applicative :</h3>" data-content="<contenttitle>Crée le: </contenttitle>'.h($version['Version']['created']).'<br/><contenttitle>Modifié le: </contenttitle>'.h($version['Version']['modified']).'" data-trigger="click" style="cursor: pointer;"></span>'; ?>&nbsp;
                <?php endif; ?>
                <?php if (userAuth('profil_id')!='2' && isAuthorized('versions', 'edit')) : ?>
                <?php echo $this->Html->link('<span class="glyphicons pencil showoverlay notchange"></span>', array('action' => 'edit',$version['Version']['id']),array('escape' => false)); ?>&nbsp;
                <?php endif; ?>
                <?php if (userAuth('profil_id')!='2' && isAuthorized('versions', 'delete')) : ?>
                <?php echo $this->Form->postLink('<span class="glyphicons bin notchange"></span>', array('action' => 'delete',$version['Version']['id']),array('escape' => false), __('Etes-vous certain de vouloir supprimer cette version applicative')); ?>                    
                <?php endif; ?>                    
            </td>
	</tr>
<?php endforeach; ?>
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
