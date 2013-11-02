<div class="messages index">
        <nav class="navbar toolbar marginright20">
                <ul class="nav navbar-nav toolbar">
                <?php if (userAuth('profil_id')!='2' && isAuthorized('messages', 'add')) : ?>
                <li><?php echo $this->Html->link('<span class="glyphicons plus size14 margintop4"></span>', array('action' => 'add'),array('escape' => false)); ?></li>
                <?php endif; ?>
                </ul> 
                <?php echo $this->Form->create("Message",array('action' => 'search', 'class'=>'toolbar-form pull-right','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?>
                    <?php echo $this->Form->input('SEARCH',array('placeholder'=>'Recherche ...','style'=>"width: 200px;",'class'=>"form-control")); ?>
                    <button type="submit" class="btn form-btn showoverlay">Rechercher</button>
                <?php echo $this->Form->end(); ?> 
        </nav>
        <div class="marginright10">
        <table cellpadding="0" cellspacing="0" class="table table-bordered table-striped table-hover">
        <thead>
	<tr>
			<th><?php echo $this->Paginator->sort('LIBELLE','Message'); ?></th>
			<th width="150px;"><?php echo $this->Paginator->sort('DATELIMITE','Date de fin de validité'); ?></th>
			<th class="actions" width="80px;"><?php echo __('Actions'); ?></th>
	</tr>
        </thead>
        <tbody>  
	<?php if (isset($messages)): ?>
	<?php foreach ($messages as $message): ?>
	<tr>
		<td><?php echo $message['Message']['LIBELLE']; ?>&nbsp;</td>
		<td style="text-align: center;"><?php echo h($message['Message']['DATELIMITE']); ?>&nbsp;</td>
		<td class="actions">
                    <?php if (userAuth('profil_id')!='2' && isAuthorized('messages', 'view')) : ?>
                    <?php echo '<span class="clear"><span class="glyphicons eye_open" data-rel="popover" data-title="<h3>Message :</h3>" data-content="<contenttitle>Crée le: </contenttitle>'.h($message['Message']['created']).'<br/><contenttitle>Modifié le: </contenttitle>'.h($message['Message']['modified']).'" style="cursor: pointer;"></span></span>'; ?>&nbsp;
                    <?php endif; ?>
                    <?php if (userAuth('profil_id')!='2' && isAuthorized('messages', 'edit')) : ?>
                    <?php echo $this->Html->link('<span class="glyphicons pencil showoverlay notchange"></span>', array('action' => 'edit', $message['Message']['id']),array('escape' => false)); ?>&nbsp;
                    <?php endif; ?>
                    <?php if (userAuth('profil_id')!='2' && isAuthorized('messages', 'delete')) : ?>
                    <?php echo $this->Form->postLink('<span class="glyphicons bin showoverlay notchange"></span>', array('action' => 'delete', $message['Message']['id']),array('escape' => false), __('Etes-vous certain de vouloir supprimer ce message ?')); ?>
                    <?php endif; ?>
                </td>
	</tr>
        <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
	</table>
        </div>
        <div class="pull-left">	<?php	echo $this->Paginator->counter('Page {:page} sur {:pages}');	?></div>
        <div class="pull-right marginright20"><?php echo $this->Paginator->counter('Nombre total d\'éléments : {:count}');	?></div>
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
