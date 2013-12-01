<table cellpadding="0" cellspacing="0" class="table table-bordered table-striped table-hover tablemax" id="HistoryBudgetTable">
        <thead>
	<tr>
			<th rowspan="2" style="vertical-align: middle;"><?php echo 'Année'; ?></th>
			<th colspan="2"><?php echo 'Budget'; ?></th>
			<th rowspan="2" style="vertical-align: middle;"><?php echo 'Actif'; ?></th>
			<th rowspan="2" style="vertical-align: middle;" width="40px"><?php echo 'Actions'; ?></th>

	</tr>
        <tr>
			<th><?php echo 'Initial'; ?></th>
			<th><?php echo 'Revu'; ?></th>

	</tr>
        </thead>
        <tbody>
        <?php if (isset($historybudgets)) : ?>
	<?php foreach ($historybudgets as $budget): ?>
        <tr>
		<td style="text-align:center;"><?php echo $budget['Historybudget']['ANNEE']; ?>&nbsp;</td>
                <td style="text-align:center;"><?php echo $this->Form->input('PREVU',array('type'=>'hidden','class'=>'budgetprevu','value'=>$budget['Historybudget']['PREVU']));?><?php echo $budget['Historybudget']['PREVU']; ?>&nbsp;k€</td>
		<td style="text-align:center;"><?php echo $this->Form->input('REVU',array('type'=>'hidden','class'=>'budgetrevu','value'=>$budget['Historybudget']['REVU']));?><?php echo $budget['Historybudget']['REVU']; ?>&nbsp;k€</td>
		<td style="text-align:center;"><?php echo $this->Form->input('REVU',array('type'=>'hidden','class'=>'idhistory','value'=>$budget['Historybudget']['id']));?><?php echo $this->Form->input('ACTIF',array('type'=>'checkbox','class'=>'isactive savebudget','value'=>1,'checked'=>$budget['Historybudget']['ACTIF'],'error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>&nbsp;</td>
                <td>
                    <?php if (userAuth('profil_id')!='2' && isAuthorized('activites', 'edit')) : ?>
                    <?php echo $this->Html->link('<span class="glyphicons pencil notchange"></span>', "#",array('escape' => false,'data-id'=>$budget['Historybudget']['id'])); ?>&nbsp;
                    <?php endif; ?>
                    <?php if (userAuth('profil_id')!='2' && isAuthorized('activites', 'delete')) : ?>
                    <?php echo $this->Html->link('<span class="glyphicons bin notchange"></span>', array('controller'=>'historybudgets','action' => 'delete', $budget['Historybudget']['id']),array('escape' => false), __('Etes-vous certain de vouloir supprimer ce budget ?')); ?>
                    <?php endif; ?>                    
                </td>
	</tr>
        <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
        <tfooter>
            <tr>
                <th colspan="5" class="footer" style="text-align: center;">
                    <?php echo $this->Html->link('Nouveau budget',"#", array('class' => 'btn btn-sm btn-default','data-toggle'=>"modal", 'data-target'=>"#modalnewbudget")); ?>
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
    
    $(document).on('click','.isactive',function(e){
        e.preventDefault;
        var id = $(this).attr('id').substring(0,($(this).attr('id').length)-5); 
        $('#ActiviteBUDJETRA').val($(this).parents('tr').find('.budgetprevu').val());
        $('#ActiviteBUDGETREVU').val($(this).parents('tr').find('.budgetrevu').val());            
        $(this).parents().find('.isactive').prop('checked', false); 
        $(this).prop('checked', true);  
    });
      
    $(document).on('click','.pencil',function(e){
        var id = $(this).parent('a').attr('data-id');
        $.ajax({
            type: "POST",       
            url: "<?php echo $this->Html->url(array('controller'=>'historybudgets','action'=>'json_get_info')); ?>/" + id,
            contentType: "application/json",
            success : function(response) {
                var json = $.parseJSON(response);
                $('.form-horizontal').append("<input type='hidden' name='data[Historybudget][id]' id='HistorybudgetId' value='"+json[0]['Historybudget']['id']+"'>");
                $('#closemodalnewbudget').attr('type', "submit");
                $('#HistorybudgetActiviteId').val(json[0]['Historybudget']['activite_id']);
                $('#HistorybudgetANNEE').val(json[0]['Historybudget']['ANNEE']);
                $('#HistorybudgetPREVU').val(json[0]['Historybudget']['PREVU']);
                $('#HistorybudgetREVU').val(json[0]['Historybudget']['REVU']);
                $checked = json[0]['Historybudget']['ACTIF'] == 1 ? true : false;
                $('#HistorybudgetACTIF').prop('checked', $checked);
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