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
        <?php $i=0; ?>
	<?php foreach ($detailplancharges as $detailplancharge): ?>
	<tr rowindex="<?php echo $i; ?>">
		<td class="tdmonth">
                    <?php echo $this->Form->select('Detailplancharge.'.$i.'.utilisateur_id',$utilisateurs,array('data-rule-required'=>'true','class'=>'span5','default'=>$detailplancharge['Detailplancharge']['utilisateur_id'],'data-msg-required'=>'Le nom de l\'utilisateur est obligatoire','empty' => 'Choisir un utilisateur')); ?>                    
                </td>
		<td class="tdmonth">
                    <?php echo $this->Form->select('Detailplancharge.'.$i.'.domaine_id',$domaines,array('data-rule-required'=>'true','class'=>'span5','default'=>$detailplancharge['Detailplancharge']['domaine_id'],'data-msg-required'=>'Le nom du domaine est obligatoire','empty' => 'Choisir un domaine')); ?>                                        
                </td>
		<td class="tdmonth">
                <select name="data[Detailplancharge][<?php echo $i; ?>][activite_id]" class='span5' data-rule-required="true" data-msg-required="Le nom de l'activité est obligatoire" id="Detailplancharge<?php echo $i; ?>ActiviteId"> 
                    <option value="">Choisir une activité</option>
                    <?php foreach ($activites as $activite) : ?>
                    <?php $selected = ''; ?>
                    <?php $selected = $activite['Activite']['id']==$detailplancharge['Detailplancharge']['activite_id'] ? 'selected="selected"' :''; ?>
                        <option value="<?php echo $activite['Activite']['id']; ?>" <?php echo $selected; ?>><?php echo $activite['Projet']['NOM']; ?> - <?php echo $activite['Activite']['NOM']; ?></option>
                    <?php endforeach; ?>
                </select>                        
                </td>
		<td class="tdmonth" style='text-align: center;'><?php echo $this->Form->input('Detailplancharge.'.$i.'.ETP',array('class'=>'span2 text-right monthpc etp','value'=>$detailplancharge['Detailplancharge']['ETP'])); ?></td>  
                <td class="tdmonth" style='text-align: center;'><?php echo $this->Form->input('Detailplancharge.'.$i.'.JANVIER',array('class'=>'span2 text-right monthpc','value'=>$detailplancharge['Detailplancharge']['JANVIER'])); ?></td>
                <td class="tdmonth" style='text-align: center;'><?php echo $this->Form->input('Detailplancharge.'.$i.'.FEVRIER',array('class'=>'span2 text-right monthpc','value'=>$detailplancharge['Detailplancharge']['FEVRIER'])); ?></td>
                <td class="tdmonth" style='text-align: center;'><?php echo $this->Form->input('Detailplancharge.'.$i.'.MARS',array('class'=>'span2 text-right monthpc','value'=>$detailplancharge['Detailplancharge']['MARS'])); ?></td>                
                <td class="tdmonth" style='text-align: center;'><?php echo $this->Form->input('Detailplancharge.'.$i.'.AVRIL',array('class'=>'span2 text-right monthpc','value'=>$detailplancharge['Detailplancharge']['AVRIL'])); ?></td>
                <td class="tdmonth" style='text-align: center;'><?php echo $this->Form->input('Detailplancharge.'.$i.'.MAI',array('class'=>'span2 text-right monthpc','value'=>$detailplancharge['Detailplancharge']['MAI'])); ?></td>
                <td class="tdmonth" style='text-align: center;'><?php echo $this->Form->input('Detailplancharge.'.$i.'.JUIN',array('class'=>'span2 text-right monthpc','value'=>$detailplancharge['Detailplancharge']['JUIN'])); ?></td>
                <td class="tdmonth" style='text-align: center;'><?php echo $this->Form->input('Detailplancharge.'.$i.'.JUILLET',array('class'=>'span2 text-right monthpc','value'=>$detailplancharge['Detailplancharge']['JUILLET'])); ?></td>
                <td class="tdmonth" style='text-align: center;'><?php echo $this->Form->input('Detailplancharge.'.$i.'.AOUT',array('class'=>'span2 text-right monthpc','value'=>$detailplancharge['Detailplancharge']['AOUT'])); ?></td>
                <td class="tdmonth" style='text-align: center;'><?php echo $this->Form->input('Detailplancharge.'.$i.'.SEPTEMBRE',array('class'=>'span2 text-right monthpc','value'=>$detailplancharge['Detailplancharge']['SEPTEMBRE'])); ?></td>
                <td class="tdmonth" style='text-align: center;'><?php echo $this->Form->input('Detailplancharge.'.$i.'.OCTOBRE',array('class'=>'span2 text-right monthpc','value'=>$detailplancharge['Detailplancharge']['OCTOBRE'])); ?></td>
                <td class="tdmonth" style='text-align: center;'><?php echo $this->Form->input('Detailplancharge.'.$i.'.NOVEMBRE',array('class'=>'span2 text-right monthpc','value'=>$detailplancharge['Detailplancharge']['NOVEMBRE'])); ?></td>
                <td class="tdmonth" style='text-align: center;'><?php echo $this->Form->input('Detailplancharge.'.$i.'.DECEMBRE',array('class'=>'span2 text-right monthpc','value'=>$detailplancharge['Detailplancharge']['DECEMBRE'])); ?></td>
                <td class="tdmonth" style='text-align: center;'><?php echo $this->Form->input('Detailplancharge.'.$i.'.TOTAL',array('class'=>'span2 text-right rowTotal','value'=>$detailplancharge['Detailplancharge']['TOTAL'])); ?></td>
		<td>
                    <?php if ($i==0) : ?>
                    <i class="icon-blank"></i>
                    <?php else : ?>
                    <i class="icon-minus cursor" id="deleteExistRow"></i>
                    <?php endif; ?>
                    <i class="icon-plus cursor" id="addRow"></i>
                    <?php echo $this->Form->input('Detailplancharge.'.$i.'.plancharge_id',array('type'=>'hidden','value'=>$detailplancharge['Detailplancharge']['plancharge_id'])); ?>
                    <?php echo $this->Form->input('Detailplancharge.'.$i.'.id',array('type'=>'hidden','value'=>$detailplancharge['Detailplancharge']['id'])); ?>
		</td>
	</tr>
        <?php $i++; ?>
        <?php endforeach; ?>           
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
		<td class="tdmonth" style='text-align: center;'><?php echo $this->Form->input('Detailplancharge.¤.ETP',array('class'=>'span2 text-right monthpc etp newetp','value'=>'1.0')); ?></td>  
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
            <?php echo $this->Form->input('Detailplancharge.0.TODELETE',array('type'=>'hidden')); ?>
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
        var index = 0;
        if ($(this).hasClass('newetp')) {
            index = $('#detailplanchargeTable tr').length-4; 
        } else {
            index = $(this).parents('tr').attr('rowindex');
        }
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
    $(document).on('click','#deleteExistRow',function(e){
        e.preventDefault;
        var index = $(this).parents('tr').attr('rowindex');
        var id = 'Detailplancharge'+index+'Id';
        if($('#Detailplancharge0TODELETE').val()==''){
            $('#Detailplancharge0TODELETE').val($('#'+id).val()+',');
        } else {
            $('#Detailplancharge0TODELETE').val($('#Detailplancharge0TODELETE').val()+$('#'+id).val()+",");
        }
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
