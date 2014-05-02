<br/>
<div class="affectations index">
	<table cellpadding="0" cellspacing="0" class="table table-bordered table-striped table-hover tablemax tableaffectation">
        <thead>
	<tr>
			<th><?php echo 'Activités'; ?></th>
                        <th><?php echo 'Commentaire'; ?></th>
                        <th><?php echo 'Répartition'; ?></th>
                    <?php if ($this->params->action != 'profil') : ?>                        
			<th class="actions" width='40px'><?php echo __('Actions'); ?></th>
                    <?php endif; ?>
	</tr>
        </thead>
        <tbody>
	<?php foreach ($affectations as $affectation): ?>
	<tr>
		<td><?php echo h($affectation['Activite']['NOM']); ?>&nbsp;</td>
                <td><?php echo h($affectation['Activite']['DESCRIPTION']); ?>&nbsp;</td>
                <td style="text-align: right;"><?php echo h(isset($affectation['Affectation']['REPARTITION']) ? $affectation['Affectation']['REPARTITION'].'%' : ''); ?>&nbsp;</td>
                <?php if ($this->params->action != 'profil') : ?>		
                <td class="actions">
                    <?php if (userAuth('profil_id')!='2' && isAuthorized('affectations', 'edit')) : ?>
                    <?php echo $this->Html->link('<span class="glyphicons pencil notchange"></span>',"#",array('escape' => false, 'data-toggle'=>"modal", 'data-target'=>"#modaleditaffectation", "data-id"=>$affectation['Affectation']['id'])); ?>&nbsp;
                    <?php endif; ?>
                    <?php if (userAuth('profil_id')!='2' && isAuthorized('affectations', 'delete')) : ?>
                    <?php echo $this->Html->link('<span class="glyphicons bin notchange"></span>', array('controller'=>'affectations','action' => 'delete', $affectation['Affectation']['id'], $this->params->pass[0]),array('escape' => false), __('Etes-vous certain de vouloir supprimer cette affectation ?')); ?>                    
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
   $(".tableaffectation").tablesorter({
        headers: {
            3:{filter:false}
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
        $('#modaleditaffectation #AffectationId').val(id);
    });
    
    $('#modaleditaffectation').on('shown.bs.modal', function (e) {
        $.ajax({
            type: "POST",       
            url: "<?php echo $this->Html->url(array('controller'=>'activites','action'=>'json_all_activite')); ?>",
            data: {},  
            contentType: "application/json",
            success : function(response) {
                var json = $.parseJSON(response);
                var options = $("#modaleditaffectation #AffectationActiviteId");
                $.each(json, function (index, value) {
                    if(index != undefined) {
                        options.append($("<option />").val(value).text(index));
                    }
                });                    
            },
            error :function(response, status,errorThrown) {
                alert("Erreur! Impossible de mettre à jour les informations concernant les activités\n\rActualiser la page et recommencer.");
            }      
        });   
        
        var id = $('#AffectationId').val();
        setTimeout(function(){
        $.ajax({
            type: "POST",       
            url: "<?php echo $this->Html->url(array('controller'=>'affectations','action'=>'json_get_this')); ?>/"+id,
            data: {},  
            contentType: "application/json",
        }).done(function(data){
            var json = $.parseJSON(data);
            $('#modaleditaffectation #AffectationId').val(json['Affectation']['id']);
            $('#modaleditaffectation #AffectationActiviteId').val(json['Affectation']['activite_id']);
            $('#modaleditaffectation #AffectationREPARTITION').val(json['Affectation']['REPARTITION']);
            $('#modaleditaffectation #AffectationUtilisateurId').val(json['Affectation']['utilisateur_id']);
        });     
        }, 1000);
    });
    
    $('#modaleditaffectation').on('hide.bs.modal', function (e) {
        $('#modaleditaffectation #AffectationActiviteId').find('option:not(:first)').remove();
    });    
});
</script>