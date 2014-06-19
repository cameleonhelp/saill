<div class="">
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
<?php aarsort($files,'time'); ?>
<?php foreach ($files as $file): ?>
<tr>
        <td style="text-align:center;"><span class="ico-<?php echo $file['ext']; ?>">&nbsp;</span></td>
        <td><?php echo $file['name']; ?></td>
        <td style="text-align:center;"><?php echo $file['time']; ?></td>
        <td style="text-align:right;"><?php echo $file['size']; ?></td>
        <?php 
            $nfile = new files_folder();
            $file = realpath(str_replace('..', '.', $file['url']));
            if ($nfile->iswindows()):
                $file = str_replace("\\", "-", $file);
                $file = str_replace(":", "¤", $file);               
            else:
                $file = str_replace('/', '-', $file);                    
            endif;
            
        ?>
        <td style="text-align:center;"><?php echo $this->Html->link('<span class="glyphicons bin notchange"></span>',array('action'=>'deletebackup',$file),array('escape' => false), __('Etes-vous certain de vouloir supprimer cette sauvegarde.')); ?>&nbsp;</td>
        <td style="text-align:center;"><?php echo $this->Html->link('<span class="glyphicons download notchange"></span>',array('action'=>'restorebdd',$file),array('escape' => false), __('Etes-vous certain de vouloir restaurer cette sauvegarde.')); ?>&nbsp;</td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
</div>
<script>
$(document).ready(function () {
    $("table").tablesorter({
        dateFormat: 'dd/mm/YYYY HH:ii:ss',
        headers: {
            2: {sorter: 'fr-datetime'},
            4: {sorter:false}
        },
        widthFixed : true,
        widgets: ["zebra"],
        widgetOptions : {           
            zebra : [ "normal-row", "alt-row" ]
        }
    }); 
});
</script>