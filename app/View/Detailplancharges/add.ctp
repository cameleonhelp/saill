<div class="detailplancharges form">
    <?php echo $this->Form->create('Detailplancharge',array('id'=>'formValidate','class'=>'form-horizontal','action'=>'save','inputDefaults' => array('label'=>false,'div' => false))); ?> 
    <table cellpadding="0" cellspacing="0" class="table table-bordered table-striped table-hover" id='detailplanchargeTable'>
        <thead>
	<tr>
			<th><label class="control-label sstitre required center">Utilisateur</label></th>
			<th><label class="control-label sstitre required center">Domaine</label></th>
			<th><label class="control-label sstitre required center">Projet/Activité</label></th>
			<th><?php echo 'Etp'; ?></th>
			<th><?php echo 'Jan.'; ?></th>
			<th><?php echo 'Fév.'; ?></th>
			<th><?php echo 'Mars'; ?></th>
			<th><?php echo 'Avril'; ?></th>
			<th><?php echo 'Mai'; ?></th>
			<th><?php echo 'Juin'; ?></th>
			<th><?php echo 'Juil.'; ?></th>
			<th><?php echo 'Août'; ?></th>
			<th><?php echo 'Sept.'; ?></th>
			<th><?php echo 'Oct.'; ?></th>
			<th><?php echo 'Nov.'; ?></th>
			<th><?php echo 'Déc.'; ?></th>                        
			<th><?php echo 'Total'; ?></th>
			<th class="actions" style="width:35px;"></th>
	</tr>
	</thead>
        <tbody>        
	<tr>
		<td class="tdmonth">
                    <?php echo $this->Form->select('Detailplancharge.0.utilisateur_id',$utilisateurs,array('data-rule-required'=>'true','class'=>'span5','data-msg-required'=>'Le nom de l\'utilisateur est obligatoire','empty' => 'Choisir un utilisateur')); ?>                    
                </td>
		<td class="tdmonth">
                    <?php echo $this->Form->select('Detailplancharge.0.domaine_id',$domaines,array('data-rule-required'=>'true','class'=>'span5','data-msg-required'=>'Le nom du domaine est obligatoire','empty' => 'Choisir un domaine')); ?>                                        
                </td>
		<td class="tdmonth">
                <select name="data[Detailplancharge][0][activite_id]" class='span5' data-rule-required="true" data-msg-required="Le nom de l'activité est obligatoire" id="Detailplancharge0ActiviteId"> 
                    <option value="">Choisir une activité</option>
                    <?php foreach ($activites as $activite) : ?>
                    <?php $selected = ''; ?>
                    <?php if ($this->params->action == 'edit') $selected = $activite['Activite']['id']==$activitesreelle['Activitesreelle']['activite_id'] ? 'selected="selected"' :''; ?>
                        <option value="<?php echo $activite['Activite']['id']; ?>" <?php echo $selected; ?>><?php echo $activite['Projet']['NOM']; ?> - <?php echo $activite['Activite']['NOM']; ?></option>
                    <?php endforeach; ?>
                </select>                        
                </td>
		<td class="tdmonth" style='text-align: center;'><?php echo $this->Form->input('Detailplancharge.0.ETP',array('class'=>'span2 text-right monthpc etp','value'=>'1.0')); ?></td>  
                <td class="tdmonth" style='text-align: center;'><?php echo $this->Form->input('Detailplancharge.0.JANVIER',array('class'=>'span2 text-right monthpc','value'=>nbJoursOuvres(new DateTime($annee.'-01-01')))); ?></td>
                <td class="tdmonth" style='text-align: center;'><?php echo $this->Form->input('Detailplancharge.0.FEVRIER',array('class'=>'span2 text-right monthpc','value'=>nbJoursOuvres(new DateTime($annee.'-02-01')))); ?></td>
                <td class="tdmonth" style='text-align: center;'><?php echo $this->Form->input('Detailplancharge.0.MARS',array('class'=>'span2 text-right monthpc','value'=>nbJoursOuvres(new DateTime($annee.'-03-01')))); ?></td>                
                <td class="tdmonth" style='text-align: center;'><?php echo $this->Form->input('Detailplancharge.0.AVRIL',array('class'=>'span2 text-right monthpc','value'=>nbJoursOuvres(new DateTime($annee.'-04-01')))); ?></td>
                <td class="tdmonth" style='text-align: center;'><?php echo $this->Form->input('Detailplancharge.0.MAI',array('class'=>'span2 text-right monthpc','value'=>nbJoursOuvres(new DateTime($annee.'-05-01')))); ?></td>
                <td class="tdmonth" style='text-align: center;'><?php echo $this->Form->input('Detailplancharge.0.JUIN',array('class'=>'span2 text-right monthpc','value'=>nbJoursOuvres(new DateTime($annee.'-06-01')))); ?></td>
                <td class="tdmonth" style='text-align: center;'><?php echo $this->Form->input('Detailplancharge.0.JUILLET',array('class'=>'span2 text-right monthpc','value'=>nbJoursOuvres(new DateTime($annee.'-07-01')))); ?></td>
                <td class="tdmonth" style='text-align: center;'><?php echo $this->Form->input('Detailplancharge.0.AOUT',array('class'=>'span2 text-right monthpc','value'=>nbJoursOuvres(new DateTime($annee.'-08-01')))); ?></td>
                <td class="tdmonth" style='text-align: center;'><?php echo $this->Form->input('Detailplancharge.0.SEPTEMBRE',array('class'=>'span2 text-right monthpc','value'=>nbJoursOuvres(new DateTime($annee.'-09-01')))); ?></td>
                <td class="tdmonth" style='text-align: center;'><?php echo $this->Form->input('Detailplancharge.0.OCTOBRE',array('class'=>'span2 text-right monthpc','value'=>nbJoursOuvres(new DateTime($annee.'-10-01')))); ?></td>
                <td class="tdmonth" style='text-align: center;'><?php echo $this->Form->input('Detailplancharge.0.NOVEMBRE',array('class'=>'span2 text-right monthpc','value'=>nbJoursOuvres(new DateTime($annee.'-11-01')))); ?></td>
                <td class="tdmonth" style='text-align: center;'><?php echo $this->Form->input('Detailplancharge.0.DECEMBRE',array('class'=>'span2 text-right monthpc','value'=>nbJoursOuvres(new DateTime($annee.'-12-01')))); ?></td>
                <?php $total = nbJoursOuvres(new DateTime($annee.'-01-01')) + nbJoursOuvres(new DateTime($annee.'-02-01')) + nbJoursOuvres(new DateTime($annee.'-03-01'))+ nbJoursOuvres(new DateTime($annee.'-04-01'))+ nbJoursOuvres(new DateTime($annee.'-05-01'))+ nbJoursOuvres(new DateTime($annee.'-06-01')); ?>
                <?php $total += nbJoursOuvres(new DateTime($annee.'-07-01')) + nbJoursOuvres(new DateTime($annee.'-08-01')) + nbJoursOuvres(new DateTime($annee.'-09-01'))+ nbJoursOuvres(new DateTime($annee.'-10-01'))+ nbJoursOuvres(new DateTime($annee.'-11-01'))+ nbJoursOuvres(new DateTime($annee.'-12-01')); ?>                
                <td class="tdmonth" style='text-align: center;'><?php echo $this->Form->input('Detailplancharge.0.TOTAL',array('class'=>'span2 text-right rowTotal','value'=>$total)); ?></td>
		<td>
                    <i class="icon-blank"></i>
                    <i class="icon-plus cursor" id="addRow"></i>
                    <?php echo $this->Form->input('Detailplancharge.0.plancharge_id',array('type'=>'hidden','value'=>isset($this->params->pass[0]) ? $this->params->pass[0] : '')); ?>
		</td>
	</tr>
	<tr id="templateRow">
		<td class="tdmonth">
                    <?php echo $this->Form->select('Detailplancharge.¤.utilisateur_id',$utilisateurs,array('class'=>'span5 newselect','data-msg-required'=>'Le nom de l\'utilisateur est obligatoire','empty' => 'Choisir un utilisateur')); ?>                    
                </td>
		<td class="tdmonth">
                    <?php echo $this->Form->select('Detailplancharge.¤.domaine_id',$domaines,array('class'=>'span5 newselect','data-msg-required'=>'Le nom du domaine est obligatoire','empty' => 'Choisir un domaine')); ?>                                        
                </td>
		<td class="tdmonth">
                <select name="data[Detailplancharge][¤][activite_id]" class='span5 newselect' data-msg-required="Le nom de l'activité est obligatoire" id="Detailplancharge¤ActiviteId"> 
                    <option value="">Choisir une activité</option>
                    <?php foreach ($activites as $activite) : ?>
                    <?php $selected = ''; ?>
                    <?php if ($this->params->action == 'edit') $selected = $activite['Activite']['id']==$activitesreelle['Activitesreelle']['activite_id'] ? 'selected="selected"' :''; ?>
                        <option value="<?php echo $activite['Activite']['id']; ?>" <?php echo $selected; ?>><?php echo $activite['Projet']['NOM']; ?> - <?php echo $activite['Activite']['NOM']; ?></option>
                    <?php endforeach; ?>
                </select>                        
                </td>
		<td class="tdmonth" style='text-align: center;'><?php echo $this->Form->input('Detailplancharge.¤.ETP',array('class'=>'span2 text-right monthpc etp','value'=>'1.0')); ?></td>  
                <td class="tdmonth" style='text-align: center;'><?php echo $this->Form->input('Detailplancharge.¤.JANVIER',array('class'=>'span2 text-right monthpc','value'=>nbJoursOuvres(new DateTime($annee.'-01-01')))); ?></td>
                <td class="tdmonth" style='text-align: center;'><?php echo $this->Form->input('Detailplancharge.¤.FEVRIER',array('class'=>'span2 text-right monthpc','value'=>nbJoursOuvres(new DateTime($annee.'-02-01')))); ?></td>
                <td class="tdmonth" style='text-align: center;'><?php echo $this->Form->input('Detailplancharge.¤.MARS',array('class'=>'span2 text-right monthpc','value'=>nbJoursOuvres(new DateTime($annee.'-03-01')))); ?></td>                
                <td class="tdmonth" style='text-align: center;'><?php echo $this->Form->input('Detailplancharge.¤.AVRIL',array('class'=>'span2 text-right monthpc','value'=>nbJoursOuvres(new DateTime($annee.'-04-01')))); ?></td>
                <td class="tdmonth" style='text-align: center;'><?php echo $this->Form->input('Detailplancharge.¤.MAI',array('class'=>'span2 text-right monthpc','value'=>nbJoursOuvres(new DateTime($annee.'-05-01')))); ?></td>
                <td class="tdmonth" style='text-align: center;'><?php echo $this->Form->input('Detailplancharge.¤.JUIN',array('class'=>'span2 text-right monthpc','value'=>nbJoursOuvres(new DateTime($annee.'-06-01')))); ?></td>
                <td class="tdmonth" style='text-align: center;'><?php echo $this->Form->input('Detailplancharge.¤.JUILLET',array('class'=>'span2 text-right monthpc','value'=>nbJoursOuvres(new DateTime($annee.'-07-01')))); ?></td>
                <td class="tdmonth" style='text-align: center;'><?php echo $this->Form->input('Detailplancharge.¤.AOUT',array('class'=>'span2 text-right monthpc','value'=>nbJoursOuvres(new DateTime($annee.'-08-01')))); ?></td>
                <td class="tdmonth" style='text-align: center;'><?php echo $this->Form->input('Detailplancharge.¤.SEPTEMBRE',array('class'=>'span2 text-right monthpc','value'=>nbJoursOuvres(new DateTime($annee.'-09-01')))); ?></td>
                <td class="tdmonth" style='text-align: center;'><?php echo $this->Form->input('Detailplancharge.¤.OCTOBRE',array('class'=>'span2 text-right monthpc','value'=>nbJoursOuvres(new DateTime($annee.'-10-01')))); ?></td>
                <td class="tdmonth" style='text-align: center;'><?php echo $this->Form->input('Detailplancharge.¤.NOVEMBRE',array('class'=>'span2 text-right monthpc','value'=>nbJoursOuvres(new DateTime($annee.'-11-01')))); ?></td>
                <td class="tdmonth" style='text-align: center;'><?php echo $this->Form->input('Detailplancharge.¤.DECEMBRE',array('class'=>'span2 text-right monthpc','value'=>nbJoursOuvres(new DateTime($annee.'-12-01')))); ?></td>
                <?php $total = nbJoursOuvres(new DateTime($annee.'-01-01')) + nbJoursOuvres(new DateTime($annee.'-02-01')) + nbJoursOuvres(new DateTime($annee.'-03-01'))+ nbJoursOuvres(new DateTime($annee.'-04-01'))+ nbJoursOuvres(new DateTime($annee.'-05-01'))+ nbJoursOuvres(new DateTime($annee.'-06-01')); ?>
                <?php $total += nbJoursOuvres(new DateTime($annee.'-07-01')) + nbJoursOuvres(new DateTime($annee.'-08-01')) + nbJoursOuvres(new DateTime($annee.'-09-01'))+ nbJoursOuvres(new DateTime($annee.'-10-01'))+ nbJoursOuvres(new DateTime($annee.'-11-01'))+ nbJoursOuvres(new DateTime($annee.'-12-01')); ?>                
                <td class="tdmonth" style='text-align: center;'><?php echo $this->Form->input('Detailplancharge.¤.TOTAL',array('class'=>'span2 text-right rowTotal','value'=>$total)); ?></td>
		<td>
                    <i class="icon-minus cursor" id="deleteRow"></i>
                    <i class="icon-plus cursor" id="addRow"></i>
                    <?php echo $this->Form->input('Detailplancharge.¤.plancharge_id',array('type'=>'hidden','value'=>isset($this->params->pass[0]) ? $this->params->pass[0] : '')); ?>                    
		</td>
	</tr>
        </tbody>
        <tfooter>
        <tr>
            <td colspan='13' class="footer" style='text-align:right;'>Total :
            <?php echo $this->Form->input('Detailplancharge.0.TOTALETP',array('type'=>'hidden')); ?>
            <?php echo $this->Form->input('Detailplancharge.0.TOTALCHARGE',array('type'=>'hidden')); ?>
            </td>
            <td class="footer" >Etp </td> 
            <td class="footer" id="totaletps" style='text-align:right;'>0.0</td>
            <td class="footer">pour</td>
            <td class="footer" id="totalrows" style='text-align:right;'>0</td>   
            <td class="footer"> jours</td> 
        </tr>
        </tfooter>
    </table>
    <div class="navbar">
        <div class="navbar-inner">
            <div class="container" style="margin-top:2px;text-align:center;">
                <?php $url = $this->Session->read('history'); $index = count($url) > 1 ? 1 : 0;?>
                <?php echo $this->Form->button('Annuler', array('type'=>'button','class' => 'btn','onclick'=>"location.href='".goPrev()."'")); ?>&nbsp;<?php echo $this->Form->button('Enregistrer', array('class' => 'btn btn-primary','type'=>'submit')); ?>                
            </div>
        </div>
    </div>  
    <?php echo $this->Form->end(); ?>  
</div>
<script>
    function sumOfETP() {
        var tot = 0;
        $(".etp").each(function() {
          if($(this).parents('tr').attr('id')!='templateRow') tot += parseFloat($(this).val());
          $('#Detailplancharge0TOTALETP').val(parseFloat(tot).toFixed(2));
        });
        return parseFloat(tot).toFixed(2);
     }
    function sumOfTotal() {
        var tot = 0;
        $(".rowTotal").each(function() {
          if($(this).parents('tr').attr('id')!='templateRow') tot += parseFloat($(this).val());
          $('#Detailplancharge0TOTALCHARGE').val(tot);
        });
        return tot;
     }     
     $(document).ready(function () {
        $("#totaletps").html(sumOfETP());
        $("#totalrows").html(sumOfTotal());
    });
    $(document).on('change','.monthpc',function(e){
        e.preventDefault;
        var index = $('#detailplanchargeTable tr').length-4; 
        var id = 'Detailplancharge'+index; 
        $('#'+id+'TOTAL').val(parseFloat($('#'+id+'JANVIER').val())+parseFloat($('#'+id+'FEVRIER').val())+parseFloat($('#'+id+'MARS').val())+parseFloat($('#'+id+'AVRIL').val())+parseFloat($('#'+id+'MAI').val())+parseFloat($('#'+id+'JUIN').val()));
        $('#'+id+'TOTAL').val(parseFloat($('#'+id+'TOTAL').val())+parseFloat($('#'+id+'JUILLET').val())+parseFloat($('#'+id+'AOUT').val())+parseFloat($('#'+id+'SEPTEMBRE').val())+parseFloat($('#'+id+'OCTOBRE').val())+parseFloat($('#'+id+'NOVEMBRE').val())+parseFloat($('#'+id+'DECEMBRE').val()));
        $("#totalrows").html(sumOfTotal());
    });
    $(document).on('change','.etp',function(e){
        e.preventDefault;
        var index = $('#detailplanchargeTable tr').length-4; 
        var id = 'Detailplancharge'+index; 
        $('#'+id+'JANVIER').val(parseInt(parseFloat(<?php echo nbJoursOuvres(new DateTime($annee.'-01-01')); ?>)*parseFloat($(this).val())));
        $('#'+id+'FEVRIER').val(parseInt(parseFloat(<?php echo nbJoursOuvres(new DateTime($annee.'-02-01')); ?>)*parseFloat($(this).val())));
        $('#'+id+'MARS').val(parseInt(parseFloat(<?php echo nbJoursOuvres(new DateTime($annee.'-03-01')); ?>)*parseFloat($(this).val())));
        $('#'+id+'AVRIL').val(parseInt(parseFloat(<?php echo nbJoursOuvres(new DateTime($annee.'-04-01')); ?>)*parseFloat($(this).val())));
        $('#'+id+'MAI').val(parseInt(parseFloat(<?php echo nbJoursOuvres(new DateTime($annee.'-05-01')); ?>)*parseFloat($(this).val())));
        $('#'+id+'JUIN').val(parseInt(parseFloat(<?php echo nbJoursOuvres(new DateTime($annee.'-06-01')); ?>)*parseFloat($(this).val())));
        $('#'+id+'JUILLET').val(parseInt(parseFloat(<?php echo nbJoursOuvres(new DateTime($annee.'-07-01')); ?>)*parseFloat($(this).val())));
        $('#'+id+'AOUT').val(parseInt(parseFloat(<?php echo nbJoursOuvres(new DateTime($annee.'-08-01')); ?>)*parseFloat($(this).val())));
        $('#'+id+'SEPTEMBRE').val(parseInt(parseFloat(<?php echo nbJoursOuvres(new DateTime($annee.'-09-01')); ?>)*parseFloat($(this).val())));
        $('#'+id+'OCTOBRE').val(parseInt(parseFloat(<?php echo nbJoursOuvres(new DateTime($annee.'-10-01')); ?>)*parseFloat($(this).val())));
        $('#'+id+'NOVEMBRE').val(parseInt(parseFloat(<?php echo nbJoursOuvres(new DateTime($annee.'-11-01')); ?>)*parseFloat($(this).val())));
        $('#'+id+'DECEMBRE').val(parseInt(parseFloat(<?php echo nbJoursOuvres(new DateTime($annee.'-12-01')); ?>)*parseFloat($(this).val())));        
        $('#'+id+'TOTAL').val(parseFloat($('#'+id+'JANVIER').val())+parseFloat($('#'+id+'FEVRIER').val())+parseFloat($('#'+id+'MARS').val())+parseFloat($('#'+id+'AVRIL').val())+parseFloat($('#'+id+'MAI').val())+parseFloat($('#'+id+'JUIN').val()));
        $('#'+id+'TOTAL').val(parseFloat($('#'+id+'TOTAL').val())+parseFloat($('#'+id+'JUILLET').val())+parseFloat($('#'+id+'AOUT').val())+parseFloat($('#'+id+'SEPTEMBRE').val())+parseFloat($('#'+id+'OCTOBRE').val())+parseFloat($('#'+id+'NOVEMBRE').val())+parseFloat($('#'+id+'DECEMBRE').val()));
        $("#totalrows").html(sumOfTotal());
        $("#totaletps").html(sumOfETP());
    });    
    $(document).on('click','#deleteRow',function(e){
        e.preventDefault;
        $(this).parent().parent('tr').remove();
        $("#totaletps").html(sumOfETP());
        $("#totalrows").html(sumOfTotal());         
    });    
    $(document).on('click','#addRow',function(e){
        e.preventDefault;
        $("#templateRow").clone().removeAttr("id").appendTo( $("#templateRow").parent());
        $("tr:last-child .newselect").attr('data-rule-required',"true");
        $("tr:last-child :input").each(function() {
            var nameAttr = typeof $(this).attr('name') === "undefined" ? "" : $(this).attr('name');
            var idAttr = typeof $(this).attr('id') === "undefined" ? "" : $(this).attr('id');
            var newIndex = $('#detailplanchargeTable tr').length-4; 
            if (nameAttr != "") $(this).attr('name',nameAttr.replace('¤',newIndex));
            if (idAttr != "") $(this).attr('id',idAttr.replace('¤',newIndex));     
        });   
        $("#totaletps").html(sumOfETP());
        $("#totalrows").html(sumOfTotal());        
    });      
</script>