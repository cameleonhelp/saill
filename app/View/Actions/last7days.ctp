<div class="marginright20">
<div class="actions form">
<?php echo $this->Form->create('Action',array('id'=>'formValidate','class'=>'form-horizontal','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?>
    <div class='block-panel block-panel-50-left'>
        <div class="form-group">
            <label class="col-lg-4 required" for="ActionDestinataire">Responsable: </label>
            <div class="col-lg-offset-4">
                    <?php echo $this->Form->select('destinataire',$destinataires,array('data-rule-required'=>'true','multiple'=>'true','class'=>"form-control multiselect size75",'size'=>"10",'data-msg-required'=>"Le nom du responsable est obligatoire",'hiddenField' => false)); ?>               
                <br><?php echo $this->Form->input('SelectAll',array('type'=>'checkbox')); ?><label class="labelAfter" for="ActionSelectAll">&nbsp;Tout sélectionner</label>  
            </div>
        </div>       
    </div>
    <div class='block-panel block-panel-50-right'>
        <div class="form-group">
            <label class="col-lg-4 required" for="ActionDomaineId">Domaine : </label>
            <div class="col-lg-offset-4">
                    <?php echo $this->Form->select('domaine_id',$domaines,array('data-rule-required'=>'true','multiple'=>'true','size'=>"10",'class'=>"form-control multiselect size75",'data-msg-required'=>"Le domaine est obligatoire")); ?>               
                <br><?php echo $this->Form->input('SelectAllDomaine',array('type'=>'checkbox')); ?><label class="labelAfter" for="ActionSelectAllDomaine">&nbsp;Tout sélectionner</label>            
            </div>            
        </div>       
    </div>
    <div style="clear:both;">
    <div class="form-group">
      <div class="btn-block-horizontal">
            <?php echo $this->Form->button('Calculer le rapport', array('class' => 'btn btn-sm btn-primary','type'=>'submit')); ?>   
      </div>
    </div>  
    </div>
<?php echo $this->Form->end(); ?>     
</div>
<?php if (isset($details) && count($details)>0): ?>
<div style="font-family:'Lucida Grande', 'Lucida Sans Unicode', Verdana, Arial, Helvetica, sans-serif;font-size:16px;color:#274b6d;fill:#274b6d;text-align: center;" text-anchor="middle" class="highcharts-title" zIndex="4">Rapport détaillé des actions par utilisateur</div><br>
<table cellpadding="0" cellspacing="0" class="table table-bordered tablemax">
    <thead>
        <tr>
        <th width="10px"></th>
        <th>Modifiée le</th>
        <th>Responsable</th>
        <th>Domaine</th>
        <th>Action</th>
        <th>Etat</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($details as $result): ?>
        <tr>
            <?php $tooltip = $result['Action']['NIVEAU'] != null ? 'Risque identifié de niveau '.$result['Action']['NIVEAU'].' / 5' : 'Aucun risque identifié' ; ?>
            <td style="background-color:<?php echo colorNiveauRisque($result['Action']['NIVEAU']) ?>"><span class="cursor" style="display:block;" rel='tooltip' data-title="<?php echo $tooltip; ?>">&nbsp;</span></td>            
            <td><?php echo $result['Action']['modified']; ?></td>
            <td><?php echo $result['Action']['destinataire_nom']; ?></td>
            <td><?php echo $result['Domaine']['NOM']; ?></td>
            <td><?php echo $result['Action']['OBJET'].'<br>'.$result['Action']['COMMENTAIRE']; ?></td> 
            <td style="text-align:center"><?php echo ucfirst_utf8($result['Action']['STATUT']); ?></td> 
        </tr>           
        <?php endforeach; ?>
    </tbody>          
</table>
<?php endif; ?>

<?php if(isset($details) && count($details)==0) : ?>
<div class="bs-callout bs-callout-warning"><b>Aucun résultat pour ce rapport, modifier les paramètres de recherche ...</b></div>
<?php endif; ?>
</div>
<script>
$(document).ready(function (){ 

   $(document).on('click','#ActionSelectAll',function() {
        if($(this).is(':checked')){
            $('#ActionDestinataire option').prop('selected', 'selected');
        } else {
            $('#ActionDestinataire option').prop('selected', '');
        }
   });   
    
   $(document).on('click','#ActionDestinataire',function() {
            $('#ActionSelectAll').prop('checked', false);
    }); 
    
   $(document).on('click','#ActionSelectAllDomaine',function() {
        if($(this).is(':checked')){
            $('#ActionDomaineId option').prop('selected', 'selected');
        } else {
            $('#ActionDomaineId option').prop('selected', '');
        }
    });   
    
   $(document).on('click','#ActionDomaineId',function() {
            $('#ActionSelectAllDomaine').prop('checked', false);
    });    
});
</script>