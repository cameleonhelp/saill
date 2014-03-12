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
    
    $('.showpickcolor').colorpicker({format:'hex',horizontal:true,template:
            '<div class="colorpicker dropdown-menu">' +
            '<div class="colorpicker-saturation"><i><b></b></i></div>' +
            '<div class="colorpicker-hue"><i></i></div>' +
            '<div class="colorpicker-alpha"><i></i></div>' +
            '<div class="colorpicker-color"><div /></div>' +
            '<div class="colorpicker-btn"><span class="pull-left glyphicons cursor colorpicker-cancel remove_2 notchange"></span><span data-id data-newcolor class="pull-right glyphicons  cursor colorpicker-submit ok_2 notchange"></span><div />' +
            '</div>'});
    
    $(document).on('click','.showpickcolor',function(e){
        var value = $(this).attr('data-color');
        var id = $(this).find('.colorpicker-submit').attr('data-id',$(this).attr('data-id'));
        $(this).colorpicker('setValue', value).colorpicker('show');
    });
    
    $(document).on('click','.colorpicker-cancel',function(e){
        $('.showpickcolor').colorpicker('hide');
    })
    
    /*$('.showpickcolor').colorpicker().on('hidePicker', function(ev){*/
    $(document).on('click','.colorpicker-submit',function(e){
        var id = $(this).attr('data-id');
        var color = $(this).attr('data-newcolor');
        if(id!='' && color!=''){
        $.ajax({
            dataType: "html",
            type: "POST",
            url: "<?php echo $this->Html->url(array('controller'=>'equipes','action'=>'saveColor')); ?>/"+id+"/"+color.substring(1),
            success : function(response) {
                $('td[data-id="'+id+'"]').css('background-color',color);
            }
        });
        }
        $('.showpickcolor').colorpicker('hide');
     });
     
     $('.showpickcolor').colorpicker().on('changeColor', function(ev){
        $('.colorpicker-submit').attr('data-newcolor',ev.color.toHex());
        $('.colorpicker-submit').attr('data-id',$(this).attr('data-id'));
     });
     
     
});
</script>