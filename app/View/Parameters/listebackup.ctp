<table cellpadding="0" cellspacing="0" class="table table-bordered table-striped table-hover">
<thead>
<tr>
                <th width="18px;">&nbsp;</th>
                <th>Nom du fichier</th>
                <th>Date de modification</th>
                <th>Taille</th>
                <th colspan="2" width="18px;">&nbsp;</th>
</tr>
</thead>
<tbody>    
<?php aarsort($files,'name'); ?>
<?php foreach ($files as $file): ?>
<tr>
        <td style="text-align:center;"><i class="ico-file">&nbsp;</i></td>
        <td><?php echo $file['name']; ?></td>
        <td style="text-align:center;"><?php echo $file['created']; ?></td>
        <td style="text-align:right;"><?php echo $file['size']; ?></td>
        <td style="text-align:center;"><?php echo $this->Html->link('<i class="icon-trash"></i>',array('action'=>'deletebackup',str_replace('/', '-', $file['file'])),array('escape' => false), __('Etes-vous certain de vouloir supprimer cette sauvegarde.')); ?>&nbsp;</td>
        <td style="text-align:center;"><?php echo $this->Html->link('<i class="icon-download"></i>',array('action'=>'restorebdd',str_replace('/', '-', $file['file'])),array('escape' => false), __('Etes-vous certain de vouloir restaurer cette sauvegarde.')); ?>&nbsp;</td>
</tr>
<?php endforeach; ?>
</tbody>
</table>