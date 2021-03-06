<div class="">
<div class="detailplancharges form">
    <div class="bs-callout bs-callout-info" style="margin-top:0px;">
        Les vacances de février (5 jours), pâques (5 jours), été (5 jours en juillet et 10 jours en août) et noël (5 jours en décembre) sont prises en comptes
    </div>      
    <?php echo $this->Form->create('Detailplancharge',array('id'=>'formValidate','class'=>'form-horizontal','novalidate'=>true,'action'=>'save','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?> 
    <table cellpadding="0" cellspacing="0" class="table table-bordered table-striped table-hover tablemax" id='detailplanchargeTable'>
        <thead>
	<tr>
			<th><label class="required center">Utilisateur</label></th>
			<th><label class="required center">Domaine</label></th>
			<th><label class="required center">Projet/Activité</label></th>
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
			<th><?php echo 'TJM'; ?></th>                        
			<th><?php echo 'Coût'; ?></th> 			
                        <th class="actions" style="width:35px;"></th>
	</tr>
	</thead>
        <tbody>  
        <?php $i=0; ?>
	<?php foreach ($detailplancharges as $detailplancharge): ?>
	<tr rowindex="<?php echo $i; ?>">
		<td class="tdmonth">
                    <?php if($detailplancharge['Detailplancharge']['userIsActif'] ||$detailplancharge['Detailplancharge']['utilisateur_id']<0 ) :?>
                    <?php echo $this->Form->select('Detailplancharge.'.$i.'.utilisateur_id',$utilisateurs,array('data-rule-required'=>'true','class'=>'utilisateur form-control','default'=>$detailplancharge['Detailplancharge']['utilisateur_id'],'data-msg-required'=>'Le nom de l\'utilisateur est obligatoire','empty' => 'Choisir un utilisateur','rel'=>"tooltip",'data-trigger'=>"hover",'data-placement'=>"auto",'title'=>$detailplancharge['Utilisateur']['NOMLONG'])); ?>                    
                    <?php else : ?>
                    <?php echo $detailplancharge['Utilisateur']['NOMLONG']; ?>                    
                    <?php endif; ?>
                </td>
		<td class="tdmonth">
                    <?php echo $this->Form->select('Detailplancharge.'.$i.'.domaine_id',$domaines,array('class'=>'domaine form-control','data-rule-required'=>'true','default'=>$detailplancharge['Detailplancharge']['domaine_id'],'data-msg-required'=>'Le nom du domaine est obligatoire','empty' => 'Choisir un domaine','rel'=>"tooltip",'data-trigger'=>"hover",'data-placement'=>"auto",'title'=>$detailplancharge['Domaine']['NOM'])); ?>                                        
                </td>
		<td class="tdmonth">
                <select name="data[Detailplancharge][<?php echo $i; ?>][activite_id]" class="activite form-control" data-rule-required="true" data-msg-required="Le nom de l'activité est obligatoire" id="Detailplancharge<?php echo $i; ?>ActiviteId" rel="tooltip" data-trigger="hover" data-placement="auto" title="<?php echo $detailplancharge['Activite']['NOM']; ?>"> 
                    <option value="">Choisir une activité</option>
                    <?php foreach ($activites as $activite) : ?>
                    <?php $selected = ''; ?>
                    <?php $selected = $activite['Activite']['id']==$detailplancharge['Detailplancharge']['activite_id'] ? 'selected="selected"' :''; ?>
                        <option value="<?php echo $activite['Activite']['id']; ?>" <?php echo $selected; ?>><?php echo $activite['Projet']['NOM']; ?> - <?php echo $activite['Activite']['NOM']; ?></option>
                    <?php endforeach; ?>
                </select>                        
                </td>
		<td class="tdmonth" style='text-align: center;'><?php echo $this->Form->input('Detailplancharge.'.$i.'.ETP',array('class'=>'text-right form-control monthpc etp','style'=>'width:35px;','type'=>'text','value'=>$detailplancharge['Detailplancharge']['ETP'])); ?></td>  
                <td class="tdmonth" style='text-align: center;'><?php echo $this->Form->input('Detailplancharge.'.$i.'.JANVIER',array('class'=>'text-right form-control monthpc charge','style'=>'width:35px;','type'=>'text','value'=>$detailplancharge['Detailplancharge']['JANVIER'])); ?></td>
                <td class="tdmonth" style='text-align: center;'><?php echo $this->Form->input('Detailplancharge.'.$i.'.FEVRIER',array('class'=>'text-right form-control monthpc charge','style'=>'width:35px;','type'=>'text','value'=>$detailplancharge['Detailplancharge']['FEVRIER'])); ?></td>
                <td class="tdmonth" style='text-align: center;'><?php echo $this->Form->input('Detailplancharge.'.$i.'.MARS',array('class'=>'text-right form-control monthpc charge','style'=>'width:35px;','type'=>'text','value'=>$detailplancharge['Detailplancharge']['MARS'])); ?></td>                
                <td class="tdmonth" style='text-align: center;'><?php echo $this->Form->input('Detailplancharge.'.$i.'.AVRIL',array('class'=>'text-right form-control monthpc charge','style'=>'width:35px;','type'=>'text','value'=>$detailplancharge['Detailplancharge']['AVRIL'])); ?></td>
                <td class="tdmonth" style='text-align: center;'><?php echo $this->Form->input('Detailplancharge.'.$i.'.MAI',array('class'=>'text-right form-control monthpc charge','style'=>'width:35px;','type'=>'text','value'=>$detailplancharge['Detailplancharge']['MAI'])); ?></td>
                <td class="tdmonth" style='text-align: center;'><?php echo $this->Form->input('Detailplancharge.'.$i.'.JUIN',array('class'=>'text-right form-control monthpc charge','style'=>'width:35px;','type'=>'text','value'=>$detailplancharge['Detailplancharge']['JUIN'])); ?></td>
                <td class="tdmonth" style='text-align: center;'><?php echo $this->Form->input('Detailplancharge.'.$i.'.JUILLET',array('class'=>'text-right form-control monthpc charge','style'=>'width:35px;','type'=>'text','value'=>$detailplancharge['Detailplancharge']['JUILLET'])); ?></td>
                <td class="tdmonth" style='text-align: center;'><?php echo $this->Form->input('Detailplancharge.'.$i.'.AOUT',array('class'=>'text-right form-control monthpc charge','style'=>'width:35px;','type'=>'text','value'=>$detailplancharge['Detailplancharge']['AOUT'])); ?></td>
                <td class="tdmonth" style='text-align: center;'><?php echo $this->Form->input('Detailplancharge.'.$i.'.SEPTEMBRE',array('class'=>'text-right form-control monthpc charge','style'=>'width:35px;','type'=>'text','value'=>$detailplancharge['Detailplancharge']['SEPTEMBRE'])); ?></td>
                <td class="tdmonth" style='text-align: center;'><?php echo $this->Form->input('Detailplancharge.'.$i.'.OCTOBRE',array('class'=>'text-right form-control monthpc charge','style'=>'width:35px;','type'=>'text','value'=>$detailplancharge['Detailplancharge']['OCTOBRE'])); ?></td>
                <td class="tdmonth" style='text-align: center;'><?php echo $this->Form->input('Detailplancharge.'.$i.'.NOVEMBRE',array('class'=>'text-right form-control monthpc charge','style'=>'width:35px;','type'=>'text','value'=>$detailplancharge['Detailplancharge']['NOVEMBRE'])); ?></td>
                <td class="tdmonth" style='text-align: center;'><?php echo $this->Form->input('Detailplancharge.'.$i.'.DECEMBRE',array('class'=>'text-right form-control monthpc charge','style'=>'width:35px;','type'=>'text','value'=>$detailplancharge['Detailplancharge']['DECEMBRE'])); ?></td>
                <td class="tdmonth" style='text-align: center;'><?php echo $this->Form->input('Detailplancharge.'.$i.'.TOTAL',array('class'=>'text-right form-control rowTotal','style'=>'width:35px;','type'=>'text','value'=>$detailplancharge['Detailplancharge']['TOTAL'])); ?></td>
		<td class="tdmonth" style='text-align: center;'><?php echo $this->Form->input('Detailplancharge.'.$i.'.TJM',array('class'=>'text-right form-control','style'=>'width:35px;margin-top:5px;margin-bottom:-9px;','type'=>'text','value'=>$detailplancharge['Detailplancharge']['TJM'])); ?></td>
                <td id="Detailplancharge<?php echo $i; ?>CoutHtml" style='text-align: right;' class="rowcout"><?php echo $detailplancharge['Detailplancharge']['COUT']; ?></td>		
                <td>
                    <?php if ($i==0) : ?>
                    <span class="glyphicons blank"></span>
                    <?php else : ?>
                    <span class="glyphicons minus cursor" id="deleteExistRow"></span>
                    <?php endif; ?>
                    <span class="glyphicons plus cursor" id="addRow"></span>
                    <?php echo $this->Form->input('Detailplancharge.'.$i.'.plancharge_id',array('type'=>'hidden','value'=>$detailplancharge['Detailplancharge']['plancharge_id'])); ?>
                    <?php echo $this->Form->input('Detailplancharge.'.$i.'.id',array('type'=>'hidden','value'=>$detailplancharge['Detailplancharge']['id'])); ?>
                    <?php echo $this->Form->input('Detailplancharge.'.$i.'.COUT',array('class'=>'text-right form-control monthpc','type'=>'hidden','value'=>$detailplancharge['Detailplancharge']['COUT'])); ?>
		</td>
	</tr>
        <?php $i++; ?>
        <?php endforeach; ?>           
	<tr id="templateRow">
		<td class="tdmonth">
                    <?php echo $this->Form->select('Detailplancharge.¤.utilisateur_id',$utilisateurs,array('class'=>'newselect form-control utilisateur','data-msg-required'=>'Le nom de l\'utilisateur est obligatoire','empty' => 'Choisir un utilisateur')); ?>                    
                </td>
		<td class="tdmonth">
                    <?php echo $this->Form->select('Detailplancharge.¤.domaine_id',$domaines,array('class'=>'newselect form-control','data-msg-required'=>'Le nom du domaine est obligatoire','empty' => 'Choisir un domaine')); ?>                                        
                </td>
		<td class="tdmonth">
                <select name="data[Detailplancharge][¤][activite_id]" class='newselect form-control' data-msg-required="Le nom de l'activité est obligatoire" id="Detailplancharge¤ActiviteId"> 
                    <option value="">Choisir une activité</option>
                    <?php foreach ($activites as $activite) : ?>
                    <?php $selected = ''; ?>
                    <?php if ($this->params->action == 'edit') $selected = isset($activitesreelle['Activitesreelle']['activite_id'])&& $activite['Activite']['id']==$activitesreelle['Activitesreelle']['activite_id'] ? 'selected="selected"' :''; ?>
                        <option value="<?php echo $activite['Activite']['id']; ?>" <?php echo $selected; ?>><?php echo $activite['Projet']['NOM']; ?> - <?php echo $activite['Activite']['NOM']; ?></option>
                    <?php endforeach; ?>
                </select>                        
                </td>
		<td class="tdmonth" style='text-align: center;'><?php echo $this->Form->input('Detailplancharge.¤.ETP',array('class'=>'text-right form-control monthpc etp newetp','style'=>'width:35px;','type'=>'text','value'=>'1.0')); ?></td>  
                <td class="tdmonth" style='text-align: center;'><?php echo $this->Form->input('Detailplancharge.¤.JANVIER',array('class'=>'text-right form-control monthpc newrow charge','style'=>'width:35px;','type'=>'text','value'=>nbJoursOuvres(new DateTime($annee.'-01-01')))); ?></td>
                <td class="tdmonth" style='text-align: center;'><?php echo $this->Form->input('Detailplancharge.¤.FEVRIER',array('class'=>'text-right form-control monthpc newrow charge','style'=>'width:35px;','type'=>'text','value'=>nbJoursOuvres(new DateTime($annee.'-02-01')))); ?></td>
                <td class="tdmonth" style='text-align: center;'><?php echo $this->Form->input('Detailplancharge.¤.MARS',array('class'=>'text-right form-control monthpc newrow charge','style'=>'width:35px;','type'=>'text','value'=>nbJoursOuvres(new DateTime($annee.'-03-01')))); ?></td>                
                <td class="tdmonth" style='text-align: center;'><?php echo $this->Form->input('Detailplancharge.¤.AVRIL',array('class'=>'text-right form-control monthpc newrow charge','style'=>'width:35px;','type'=>'text','value'=>nbJoursOuvres(new DateTime($annee.'-04-01')))); ?></td>
                <td class="tdmonth" style='text-align: center;'><?php echo $this->Form->input('Detailplancharge.¤.MAI',array('class'=>'text-right form-control monthpc newrow charge','style'=>'width:35px;','type'=>'text','value'=>nbJoursOuvres(new DateTime($annee.'-05-01')))); ?></td>
                <td class="tdmonth" style='text-align: center;'><?php echo $this->Form->input('Detailplancharge.¤.JUIN',array('class'=>'text-right form-control monthpc newrow charge','style'=>'width:35px;','type'=>'text','value'=>nbJoursOuvres(new DateTime($annee.'-06-01')))); ?></td>
                <td class="tdmonth" style='text-align: center;'><?php echo $this->Form->input('Detailplancharge.¤.JUILLET',array('class'=>'text-right form-control monthpc newrow charge','style'=>'width:35px;','type'=>'text','value'=>nbJoursOuvres(new DateTime($annee.'-07-01')))); ?></td>
                <td class="tdmonth" style='text-align: center;'><?php echo $this->Form->input('Detailplancharge.¤.AOUT',array('class'=>'text-right form-control monthpc newrow charge','style'=>'width:35px;','type'=>'text','value'=>nbJoursOuvres(new DateTime($annee.'-08-01')))); ?></td>
                <td class="tdmonth" style='text-align: center;'><?php echo $this->Form->input('Detailplancharge.¤.SEPTEMBRE',array('class'=>'text-right form-control monthpc newrow charge','style'=>'width:35px;','type'=>'text','value'=>nbJoursOuvres(new DateTime($annee.'-09-01')))); ?></td>
                <td class="tdmonth" style='text-align: center;'><?php echo $this->Form->input('Detailplancharge.¤.OCTOBRE',array('class'=>'text-right form-control monthpc newrow charge','style'=>'width:35px;','type'=>'text','value'=>nbJoursOuvres(new DateTime($annee.'-10-01')))); ?></td>
                <td class="tdmonth" style='text-align: center;'><?php echo $this->Form->input('Detailplancharge.¤.NOVEMBRE',array('class'=>'text-right form-control monthpc newrow charge','style'=>'width:35px;','type'=>'text','value'=>nbJoursOuvres(new DateTime($annee.'-11-01')))); ?></td>
                <td class="tdmonth" style='text-align: center;'><?php echo $this->Form->input('Detailplancharge.¤.DECEMBRE',array('class'=>'text-right form-control monthpc newrow charge','style'=>'width:35px;','type'=>'text','value'=>nbJoursOuvres(new DateTime($annee.'-12-01')))); ?></td>
                <?php $total = nbJoursOuvres(new DateTime($annee.'-01-01')) + nbJoursOuvres(new DateTime($annee.'-02-01')) + nbJoursOuvres(new DateTime($annee.'-03-01'))+ nbJoursOuvres(new DateTime($annee.'-04-01'))+ nbJoursOuvres(new DateTime($annee.'-05-01'))+ nbJoursOuvres(new DateTime($annee.'-06-01')); ?>
                <?php $total += nbJoursOuvres(new DateTime($annee.'-07-01')) + nbJoursOuvres(new DateTime($annee.'-08-01')) + nbJoursOuvres(new DateTime($annee.'-09-01'))+ nbJoursOuvres(new DateTime($annee.'-10-01'))+ nbJoursOuvres(new DateTime($annee.'-11-01'))+ nbJoursOuvres(new DateTime($annee.'-12-01')); ?>                
                <td class="tdmonth" style='text-align: center;'><?php echo $this->Form->input('Detailplancharge.¤.TOTAL',array('class'=>'text-right form-control rowTotal','style'=>'width:35px;','type'=>'text','value'=>$total)); ?></td>
		<td class="tdmonth" style='text-align: center;'><?php echo $this->Form->input('Detailplancharge.¤.TJM',array('class'=>'text-right form-control','style'=>'width:35px;margin-top:5px;margin-bottom:-9px;','type'=>'text','value'=>'')); ?></td>
                <td id="Detailplancharge¤CoutHtml" style='text-align: right;' class="rowcout"></td>		
                <td>
                    <span class="glyphicons minus cursor" id="deleteRow"></span>
                    <span class="glyphicons plus cursor" id="addRow"></span>
                    <?php echo $this->Form->input('Detailplancharge.¤.plancharge_id',array('type'=>'hidden','value'=>isset($this->params->pass[0]) ? $this->params->pass[0] : '')); ?>    
                    <?php echo $this->Form->input('Detailplancharge.¤.COUT',array('class'=>'text-right monthpc','type'=>'hidden')); ?>
		</td>
	</tr>
        </tbody>
        <tfoot>
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
            <td class="footer" id="totalcout" style='text-align:right;'></td>
            <td class="footer"> k€</td>  
        </tr>
        </tfoot>
    </table>
    <div style="clear:both;margin-top: 10px;">
    <div class="form-group">
      <div class="btn-block-horizontal">
            <?php echo $this->Form->button('Annuler', array('type'=>'submit','class' => 'btn btn-sm btn-default showoverlay cancel','value'=>'cancel','div' => false, 'name' => 'cancel')); ?>&nbsp;<?php echo $this->Form->button('Enregistrer', array('class' => 'btn btn-sm btn-primary','type'=>'submit')); ?>                
      </div>
    </div>  
    </div> 
    <?php echo $this->Form->end(); ?>  
</div>
</div>
<script>
      
$(document).ready(function () {
        $("#totaletps").html(sumOfETP());
        $("#totalrows").html(sumOfTotal());
        $("#totalcout").html(sumOfCout());    
    $(document).on('change','.monthpc',function(e){
        e.preventDefault;
        var index = 0;
        if ($(this).hasClass('newrow')) {
            index = $('#detailplanchargeTable tr').length-4; 
        } else {
            index = $(this).parents('tr').attr('rowindex');
        }
        value = isNaN($(this).val()) || $(this).val()=='' || typeof $(this).val()=== "undefined" ? 0 : $(this).val();
        $(this).val(value);
        var id = 'Detailplancharge'+index; 
        $('#'+id+'TOTAL').val(parseFloat($('#'+id+'JANVIER').val())+parseFloat($('#'+id+'FEVRIER').val())+parseFloat($('#'+id+'MARS').val())+parseFloat($('#'+id+'AVRIL').val())+parseFloat($('#'+id+'MAI').val())+parseFloat($('#'+id+'JUIN').val()));
        $('#'+id+'TOTAL').val(parseFloat($('#'+id+'TOTAL').val())+parseFloat($('#'+id+'JUILLET').val())+parseFloat($('#'+id+'AOUT').val())+parseFloat($('#'+id+'SEPTEMBRE').val())+parseFloat($('#'+id+'OCTOBRE').val())+parseFloat($('#'+id+'NOVEMBRE').val())+parseFloat($('#'+id+'DECEMBRE').val()));
        $("#totalrows").html(sumOfTotal());
        $('#'+id+'CoutHtml').html((($('#'+id+'TOTAL').val()*$('#'+id+'TJM').val())/1000).toFixed(2))        
        $("#totalcout").html(sumOfCout()); 
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
        $('#'+id+'CoutHtml').html((($('#'+id+'TOTAL').val()*$('#'+id+'TJM').val())/1000).toFixed(2))          
        $("#totalcout").html(sumOfCout());        
    });    
    $(document).on('click','#deleteRow',function(e){
        e.preventDefault;
        $(this).parent().parent('tr').remove();
        $("#totaletps").html(sumOfETP());
        $("#totalrows").html(sumOfTotal());  
        $("#totalcout").html(sumOfCout());        
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
        $('#Detailplancharge'+index+'CoutHtml').html((($('#Detailplancharge'+index+'TOTAL').val()*$('#Detailplancharge'+index+'TJM').val())/1000).toFixed(2))          
        $("#totalcout").html(sumOfCout());        
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
        $("tr:last-child td").each(function() {
            var idAttr = typeof $(this).attr('id') === "undefined" ? "" : $(this).attr('id');
            var newIndex = $('#detailplanchargeTable tr').length-4; 
            if (idAttr != "") $(this).attr('id',idAttr.replace('¤',newIndex));     
        });         
        $("#totaletps").html(sumOfETP());
        $("#totalrows").html(sumOfTotal());  
        $("#totalcout").html(sumOfCout());         
    });      
    $(document).on('change','.utilisateur',function(e){
        var id = $(this).val();        
        var index = 0;
        if ($(this).hasClass('newselect')) {
            index = $('#detailplanchargeTable tr').length-4; 
        } else {
            index = $(this).parents('tr').attr('rowindex');
        }
        var ETP = 'Detailplancharge'+index+'ETP';  
        var TJM = 'Detailplancharge'+index+'TJM';
        $(this).attr('data-original-title',$('#Detailplancharge'+index+'UtilisateurId'+" option:selected").text());
        $.ajax({
            type: "POST",       
            url: "<?php echo $this->Html->url(array('controller'=>'utilisateurs','action'=>'infoutilisateur')); ?>/"+id,
            data: {},  
            contentType: "application/json",
            success: function(response) {
                var json = $.parseJSON(response);
                $("#"+ETP).val(json.ETP);  
                var idx = 'Detailplancharge'+index;
                $('#'+idx+'JANVIER').val(parseInt(parseFloat(<?php echo nbJoursOuvres(new DateTime($annee.'-01-01')); ?>)*parseFloat(json.ETP)));
                $('#'+idx+'FEVRIER').val(parseInt(parseFloat(<?php echo nbJoursOuvres(new DateTime($annee.'-02-01')); ?>)*parseFloat(json.ETP)));
                $('#'+idx+'MARS').val(parseInt(parseFloat(<?php echo nbJoursOuvres(new DateTime($annee.'-03-01')); ?>)*parseFloat(json.ETP)));
                $('#'+idx+'AVRIL').val(parseInt(parseFloat(<?php echo nbJoursOuvres(new DateTime($annee.'-04-01')); ?>)*parseFloat(json.ETP)));
                $('#'+idx+'MAI').val(parseInt(parseFloat(<?php echo nbJoursOuvres(new DateTime($annee.'-05-01')); ?>)*parseFloat(json.ETP)));
                $('#'+idx+'JUIN').val(parseInt(parseFloat(<?php echo nbJoursOuvres(new DateTime($annee.'-06-01')); ?>)*parseFloat(json.ETP)));
                $('#'+idx+'JUILLET').val(parseInt(parseFloat(<?php echo nbJoursOuvres(new DateTime($annee.'-07-01')); ?>)*parseFloat(json.ETP)));
                $('#'+idx+'AOUT').val(parseInt(parseFloat(<?php echo nbJoursOuvres(new DateTime($annee.'-08-01')); ?>)*parseFloat(json.ETP)));
                $('#'+idx+'SEPTEMBRE').val(parseInt(parseFloat(<?php echo nbJoursOuvres(new DateTime($annee.'-09-01')); ?>)*parseFloat(json.ETP)));
                $('#'+idx+'OCTOBRE').val(parseInt(parseFloat(<?php echo nbJoursOuvres(new DateTime($annee.'-10-01')); ?>)*parseFloat(json.ETP)));
                $('#'+idx+'NOVEMBRE').val(parseInt(parseFloat(<?php echo nbJoursOuvres(new DateTime($annee.'-11-01')); ?>)*parseFloat(json.ETP)));
                $('#'+idx+'DECEMBRE').val(parseInt(parseFloat(<?php echo nbJoursOuvres(new DateTime($annee.'-12-01')); ?>)*parseFloat(json.ETP)));        
                $('#'+idx+'TOTAL').val(parseFloat($('#'+idx+'JANVIER').val())+parseFloat($('#'+idx+'FEVRIER').val())+parseFloat($('#'+idx+'MARS').val())+parseFloat($('#'+idx+'AVRIL').val())+parseFloat($('#'+idx+'MAI').val())+parseFloat($('#'+idx+'JUIN').val()));
                $('#'+idx+'TOTAL').val(parseFloat($('#'+idx+'TOTAL').val())+parseFloat($('#'+idx+'JUILLET').val())+parseFloat($('#'+idx+'AOUT').val())+parseFloat($('#'+idx+'SEPTEMBRE').val())+parseFloat($('#'+idx+'OCTOBRE').val())+parseFloat($('#'+idx+'NOVEMBRE').val())+parseFloat($('#'+idx+'DECEMBRE').val()));
                $("#totalrows").html(sumOfTotal());
                $("#totaletps").html(sumOfETP()); 
                $("#"+TJM).val(json.TJM);  
                json.TJM != '' ? $('#'+idx+'COUT').val((($('#'+idx+'TOTAL').val()*json.TJM)/1000).toFixed(2)) : $('#'+idx+'COUT').val('0');  
                json.TJM != '' ? $('#'+idx+'CoutHtml').html((($('#'+idx+'TOTAL').val()*json.TJM)/1000).toFixed(2)) : $('#'+idx+'CoutHtml').html('0');   
                $("#totalcout").html(sumOfCout()); 
            },
            error: function(response, status,errorThrown) {
                alert("Erreur! response=" + response + " status=" + status+ " "+errorThrown);
            }
        });
    }); 
    $(document).on('change','.domaine',function(e){       
        var index = 0;
        if ($(this).hasClass('newselect')) {
            index = $('#detailplanchargeTable tr').length-4; 
        } else {
            index = $(this).parents('tr').attr('rowindex');
        }
        $(this).attr('data-original-title',$('#Detailplancharge'+index+'DomaineId'+" option:selected").text());
    });
    $(document).on('change','.activite',function(e){       
        var index = 0;
        if ($(this).hasClass('newselect')) {
            index = $('#detailplanchargeTable tr').length-4; 
        } else {
            index = $(this).parents('tr').attr('rowindex');
        }
        $(this).attr('data-original-title',$('#Detailplancharge'+index+'ActiviteId'+" option:selected").text());
    });    
});    
</script>
