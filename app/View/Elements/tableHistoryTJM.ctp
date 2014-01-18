<table cellpadding="0" cellspacing="0" class="table table-bordered table-striped table-hover tablemax" id="HistoryTJMTable">
        <thead>
	<tr>
			<th style="vertical-align: middle;"><?php echo 'Année'; ?></th>
			<th ><?php echo 'TJM'; ?></th>
			<th  style="vertical-align: middle;" width="40px"><?php echo 'Actions'; ?></th>

	</tr>
        </thead>
        <tbody>
        <?php if (isset($historytjms)) : ?>
	<?php foreach ($historytjms as $tjm): ?>
        <tr>
		<td style="text-align:center;"><?php echo $tjm['Historytjm']['ANNEE']; ?>&nbsp;</td>
                <td style="text-align:center;"><?php echo $this->Form->input('TJM',array('class'=>'budgetprevu','value'=>$tjm['Historytjm']['PREVU']));?><?php echo $tjm['Historytjm']['PREVU']; ?>&nbsp;€/j</td>
                <td>
                    <?php if (userAuth('profil_id')!='2' && isAuthorized('activites', 'edit')) : ?>
                    <?php echo $this->Html->link('<span class="glyphicons pencil notchange"></span>', "#",array('escape' => false,'data-id'=>$tjm['Historytjm']['id'])); ?>&nbsp;
                    <?php endif; ?>
                    <?php if (userAuth('profil_id')!='2' && isAuthorized('activites', 'delete')) : ?>
                    <?php echo $this->Html->link('<span class="glyphicons bin notchange"></span>', array('controller'=>'historybudgets','action' => 'delete', $tjm['Historytjm']['id']),array('escape' => false), __('Etes-vous certain de vouloir supprimer ce budget ?')); ?>
                    <?php endif; ?>                    
                </td>
	</tr>
        <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
        <tfooter>
            <tr>
                <th colspan="5" class="footer" style="text-align: center;">
                    <?php echo $this->Html->link('Nouveau TJM',"#", array('class' => 'btn btn-sm btn-default','data-toggle'=>"modal", 'data-target'=>"#modalnewtjm")); ?>
                </th>
            </tr>
        </tfooter>
</table>
<script>
$(document).ready(function () {
    $(document).on('click','.savebudget',function(e){
        e.preventDefault; 
        var id = $(this).parents('tr').find('.idhistory').val();
        var overlay = $('#overlay');
        overlay.show(); 
        $.ajax({
            dataType: "html",
            type: "POST",
            url: "<?php echo $this->Html->url(array('controller'=>'historybudgets','action'=>'budgetisactif')); ?>/",
            data: ({id:id,activite_id:<?php echo $this->params->pass[0]; ?>})
        }).done(function (data) {
            overlay.hide();
        });
     
    });    
      
    $(document).on('click','.pencil',function(e){
        var id = $(this).parent('a').attr('data-id');
        $.ajax({
            type: "POST",       
            url: "<?php echo $this->Html->url(array('controller'=>'historybudgets','action'=>'json_get_info')); ?>/" + id,
            contentType: "application/json",
            success : function(response) {
                var json = $.parseJSON(response);
                $('.form-horizontal').append("<input type='hidden' name='data[Historytjm][id]' id='HistorytjmId' value='"+json[0]['Historytjm']['id']+"'>");
                $('#closemodalnewbudget').attr('type', "submit");
                $('#HistorytjmActiviteId').val(json[0]['Historytjm']['activite_id']);
                $('#HistorytjmANNEE').val(json[0]['Historytjm']['ANNEE']);
                $('#HistorytjmPREVU').val(json[0]['Historytjm']['PREVU']);
                $('#HistorytjmREVU').val(json[0]['Historytjm']['REVU']);
                $checked = json[0]['Historytjm']['ACTIF'] == 1 ? true : false;
                $('#HistorytjmACTIF').prop('checked', $checked);
                $('.modal-title').html('Modification du budget');
                $('.form-horizontal').attr('action', "<?php echo $this->Html->url(array('controller'=>'historybudgets','action'=>'edit')); ?>");
                $('#modalnewbudget').modal('show');
            },
            error :function(response,status,errorThrown) {
                alert("Erreur! il se peut que votre session soit expirée\n\rActualiser la page et recommencer.");
            }
         });
    });      
});
</script>