<table cellpadding="0" cellspacing="0" class="table table-bordered table-striped table-hover" id="HistoryBudgetTable">
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
                    <?php echo $this->Html->link('<i class="icon-pencil"></i>', array('controller'=>'historybudgets','action' => 'edit', $budget['Historybudget']['id']),array('escape' => false)); ?>&nbsp;
                    <?php endif; ?>
                    <?php if (userAuth('profil_id')!='2' && isAuthorized('activites', 'delete')) : ?>
                    <?php echo $this->Html->link('<i class="icon-trash"></i>', array('controller'=>'historybudgets','action' => 'delete', $budget['Historybudget']['id']),array('escape' => false), __('Etes-vous certain de vouloir supprimer ce budget ?')); ?>
                    <?php endif; ?>                    
                </td>
	</tr>
        <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
        <tfooter>
            <tr>
                <th colspan="5" class="footer" style="text-align: center;">
                    <?php echo $this->Html->link('Nouveau budget',array('controller'=>'historybudgets','action'=>'add',$this->params->pass[0]), array('class' => 'btn btn-inverse')); ?>
                </th>
            </tr>
        </tfooter>
</table>
<script>
$(document).ready(function () {
    $(document).on('click','.savebudget',function(e){
        e.preventDefault; 
        var id = $(this).parents('tr').find('.idhistory').val();
        var overlay = jQuery('<div id="overlay"><?php echo $this->Html->image("loading.gif"); ?> Travail en cours, veuillez patienter ...</div>');
        overlay.appendTo(document.body)
        $.ajax({
            dataType: "html",
            type: "POST",
            url: "<?php echo $this->Html->url(array('controller'=>'historybudgets','action'=>'budgetisactif')); ?>/",
            data: ({id:id,activite_id:<?php echo $this->params->pass[0]; ?>})
        }).done(function (data) {
            overlay.remove();
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
             
});
</script>