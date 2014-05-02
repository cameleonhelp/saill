<br/>
<div class="dotations index">
	<table cellpadding="0" cellspacing="0" class="table table-bordered table-striped table-hover tablemax tabledotation">
        <thead>
	<tr>
			<th><?php echo 'Poste informatique'; ?></th>
			<th><?php echo 'Périphérique'; ?></th>
                        <th><?php echo 'Remis'; ?></th>
                        <th><?php echo 'Restitué'; ?></th>
                    <?php if ($this->params->action != 'profil') : ?>                        
                        <th class="actions" width='30px' style="text-align:center;"><?php echo __('Actions'); ?></th>
                    <?php endif; ?>	
        </tr>
        </thead>
        <tbody>
	<?php foreach ($dotations as $dotation): ?>
	<tr>
		<td><?php echo h($dotation['Materielinformatique']['NOM']); ?>&nbsp;</td>
                <td><?php echo h($dotation['Typemateriel']['NOM']); ?>&nbsp;</td>
                <td width="100px" style="text-align:center;"><?php echo h($dotation['Dotation']['DATERECEPTION']); ?>&nbsp;</td>
                <td width="100px" style="text-align:center;"><?php echo h($dotation['Dotation']['DATEREMISE']); ?>&nbsp;</td>
		<?php if ($this->params->action != 'profil') : ?>
                <td class="actions">
                    <?php if (userAuth('profil_id')!='2' && isAuthorized('dotations', 'edit')) : ?>
                    <?php echo $this->Html->link('<span class="glyphicons pencil notchange"></span>', '#',array('escape' => false, 'data-toggle'=>"modal", 'data-target'=>"#modaleditdotation", "data-id"=>$dotation['Dotation']['id'])); ?>&nbsp;
                    <?php endif; ?>
                    <?php if (userAuth('profil_id')!='2' && isAuthorized('dotations', 'delete')) : ?>
                    <?php echo $this->Html->link('<span class="glyphicons bin notchange"></span>', array('controller'=>'Dotations','action' => 'delete', $dotation['Dotation']['id'], $this->params->pass[0]),array('escape' => false), __('Etes-vous certain de vouloir supprimer cette dotation ?')); ?>                    
                    <?php endif; ?> 
		</td>
                <?php endif; ?>
	</tr>
<?php endforeach; ?>
        </tbody>
	</table>
    </div>
<script>
$(document).ready(function () { 
   $(".tabledotation").tablesorter({
        headers: {
            2:{filter:false},
            3:{filter:false},
            4:{filter:false}
        },
        widthFixed : true,
        widgets: ["zebra","filter"],
        widgetOptions : {
            filter_columnFilters : true,
            filter_hideFilters : true,
            filter_ignoreCase : true,
            filter_liveSearch : true,
            filter_saveFilters : true,
            filter_useParsedData : true,
            filter_startsWith : false,
            zebra : [ "normal-row", "alt-row" ]
        }
    }); 

    $(document).on('click','.pencil',function(e){
        var id = $(this).parent('a').attr('data-id');
        $('#modaleditdotation #DotationId').val(id);
    });
    
    $('#modaleditdotation').on('shown.bs.modal', function (e) {
        $('#modaleditdotation #DotationTypematerielId').attr('disabled',false).find('option:not(:first)').remove();
        $('#modaleditdotation #DotationMaterielinformatiquesId').attr('disabled',false).find('option:not(:first)').remove();        
        $.ajax({
            type: "POST",       
            url: "<?php echo $this->Html->url(array('controller'=>'materielinformatiques','action'=>'json_list_all')); ?>",
            data: {},  
            contentType: "application/json",
            success : function(response) {
                var json = $.parseJSON(response);
                var options = $("#modaleditdotation #DotationMaterielinformatiquesId");
                $.each(json, function (index, value) {
                    if(index != undefined) {
                        options.append($("<option />").val(value).text(index));
                    }
                });                       
            },
            error :function(response, status,errorThrown) {
                alert("Erreur! Impossible de mettre à jour les informations concernant le matériel informatique\n\rActualiser la page et recommencer.");
            }      
        });
        
        $.ajax({
            type: "POST",       
            url: "<?php echo $this->Html->url(array('controller'=>'typemateriels','action'=>'json_list_other')); ?>",
            data: {},  
            contentType: "application/json",
            success : function(response) {
                var json = $.parseJSON(response);
                var options = $("#modaleditdotation #DotationTypematerielId");
                $.each(json, function (index, value) {
                    if(index != undefined) {
                        options.append($("<option />").val(value).text(index));
                    }
                });                       
            },
            error :function(response, status,errorThrown) {
                alert("Erreur! Impossible de mettre à jour les informations concernant les types de matériel\n\rActualiser la page et recommencer.");
            }      
        }); 

        var id = $('#DotationId').val();
        setTimeout(function(){
        $.ajax({
            type: "POST",       
            url: "<?php echo $this->Html->url(array('controller'=>'dotations','action'=>'json_get_this')); ?>/"+id,
            data: {},  
            contentType: "application/json",
        }).done(function(data){
            var json = $.parseJSON(data);
            $('#modaleditdotation #DotationId').val(json['Dotation']['id']);
            $('#modaleditdotation #DotationDATERECEPTION').val(json['Dotation']['DATERECEPTION']);
            $('#modaleditdotation #DotationDATEREMISE').val(json['Dotation']['DATEREMISE']);
            $('#modaleditdotation #DotationUtilisateurId').val(json['Dotation']['utilisateur_id']);
            if(json['Dotation']['materielinformatiques_id']==null){
                $('#modaleditdotation #DotationMaterielinformatiquesId').attr('disabled','disabled');
            }else{
                $('#modaleditdotation #DotationMaterielinformatiquesId option[value="'+json['Dotation']['materielinformatiques_id']+'"]').attr('selected','selected');
                $('#modaleditdotation #DotationMaterielinformatiquesId').val(json['Dotation']['materielinformatiques_id']);
            }
            if(json['Dotation']['typemateriel_id']==null){
                $('#modaleditdotation #DotationTypematerielId').attr('disabled','disabled');
            }else{
                $('#modaleditdotation #DotationTypematerielId option[value="'+json['Dotation']['typemateriel_id']+'"]').attr('selected','selected');
                $('#modaleditdotation #DotationTypematerielId').val(json['Dotation']['typemateriel_id']);
            }

        });
        }, 1000);
    });
});
</script>