<div class="">
    <?php echo $this->element('changelogsubmenu'); ?>
    <div class="changelogdemandes index">
	<table cellpadding="0" cellspacing="0" class="table table-bordered table-striped table-hover" style="width:100%;">
	<tr>
			<th><?php echo $this->Paginator->sort('Changelogversion.VERSION','Version'); ?></th>
                        <th><?php echo $this->Paginator->sort('DATEPREVUE','Prévue le'); ?></th>
                        <th><?php echo $this->Paginator->sort('CRITICITE','Criticité'); ?></th>
			<th><?php echo $this->Paginator->sort('utilisateur_id','Demandeur'); ?></th>
			<th><?php echo $this->Paginator->sort('OPEN','Ouverte'); ?></th>
			<th><?php echo $this->Paginator->sort('ETAT','Etat'); ?></th>
			<th><?php echo $this->Paginator->sort('TYPE','Type de demande'); ?></th>
			<th><?php echo $this->Paginator->sort('DEMANDE','Changement demandé'); ?></th>
                        <th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($changelogdemandes as $changelogdemande): ?>
	<tr>
		<td>
			<?php echo $changelogdemande['Changelogversion']['VERSION']; ?>
		</td>
                <td><?php echo $changelogdemande['Changelogdemande']['DATEPREVUE']; ?></td>
                <td><?php echo $changelogcriticites[$changelogdemande['Changelogdemande']['CRITICITE']]; ?></td>
		<td>
			<?php echo $changelogdemande['Utilisateur']['NOMLONG']; ?>
		</td>
		<td style="text-align: center;"><?php $image = $changelogdemande['Changelogdemande']['OPEN']==1 ? 'unlock green' : 'lock red'; ?>
                    <span class="glyphicons <?php echo $image; ?> notchange"></span>
                </td>
		<td style="text-align: center;"><?php echo $changelogetats[$changelogdemande['Changelogdemande']['ETAT']]; ?>&nbsp;</td>
		<td style="text-align: center;"><?php echo $changelogtypes[$changelogdemande['Changelogdemande']['TYPE']]; ?>&nbsp;</td>
		<td><?php echo $changelogdemande['Changelogdemande']['DEMANDE']; ?>&nbsp;</td>
		<td class="actions">
                    <a href="<?php echo $this->Html->url(array('controller'=>'changelogreponses','action'=>'view', $changelogdemande['Changelogdemande']['id'])); ?>">
                    <span class="glyphicons showoverlay comments notchange" style="position:relative;"><span style="position:absolute;color:white;top:2px;left:3.5px;font-weight:bold;;font-size:8px !important;"><?php echo $changelogdemande['Changelogdemande']['COUNT']; ?></span></span>
                    </a>
                </td>                
	</tr>
<?php endforeach; ?>
	</table>
	<div class="pull-left"><?php echo $this->Paginator->counter('Page {:page} sur {:pages}'); ?></div>
	<div class="pull-right"><?php echo $this->Paginator->counter('Nombre total d\'éléments : {:count}'); ?></div>   
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
</div>