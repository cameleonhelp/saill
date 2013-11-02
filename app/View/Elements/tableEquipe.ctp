<br/>
<div class="dotations index">
	<table cellpadding="0" cellspacing="0" class="table table-bordered table-striped table-hover tablemax">
        <thead>
	<tr>
            <th><?php echo 'Agent'; ?></th>                      
            <th width="20px">Couleur</th>
            <th class="actions" width='30px' style="text-align:center;"><?php echo __('Actions'); ?></th>	
        </tr>
        </thead>
        <tbody>
	<?php foreach ($agents as $agent): ?>
	<tr>
		<td><?php echo h($agent['Agent']['utilisateurs']['NOM']." ".$agent['Agent']['utilisateurs']['PRENOM']); ?>&nbsp;</td>
                <?php $color = isset($agent['Equipe']['COLOR']) ? $agent['Equipe']['COLOR'] : '#049CDB'; ?>
                <td class="cursor showpickcolor" data-id="<?php echo $agent['Equipe']['id']; ?>" data-color="<?php echo $color; ?>" style="background-color:<?php echo $color; ?>;"><div style="width:30px;line-height:20px;" rel="tooltip" data-title="Cliquer pour changer la couleur">&nbsp;</div></td>
                <td class="actions">
                    <?php echo $this->Html->link('<span class="glyphicons bin notchange" rel="tooltip" data-title="Suppression"></span>', array('controller'=>'Equipes','action' => 'delete', $agent['Equipe']['id']),array('escape' => false), __('Etes-vous certain de vouloir supprimer cet agent ?')); ?>                    
		</td>
	</tr>
        <?php endforeach; ?>
        </tbody>
	</table>
    </div>
<script>
$(document).ready(function(e){
    $('.showpickcolor').colorpicker({format:'hex'});
    
    $(document).on('click','.showpickcolor',function(e){
        var value = $(this).attr('data-color');
        $(this).colorpicker('setValue', value).colorpicker('show');
    });
    
    $('.showpickcolor').colorpicker().on('hidePicker', function(ev){
        var id = $(this).attr('data-id');
        var color = ev.color.toHex().substring(1);
        $.ajax({
            dataType: "html",
            type: "POST",
            url: "<?php echo $this->Html->url(array('controller'=>'equipes','action'=>'saveColor')); ?>/"+id+"/"+color
        });
     });
     
     $('.showpickcolor').colorpicker().on('changeColor', function(ev){
        $(this).css('background-color',ev.color.toHex());
     });
     
     
});
</script>