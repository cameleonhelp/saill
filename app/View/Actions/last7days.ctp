<div class="actions form">
<?php echo $this->Form->create('Action',array('id'=>'formValidate','class'=>'form-horizontal','inputDefaults' => array('label'=>false,'div' => false))); ?>
    <table>
        <tr>
            <td><label class="control-label sstitre  required" for="ActionDestinataire">Responsable: </label></td>
            <td>
                    <?php echo $this->Form->select('destinataire',$destinataires,array('data-rule-required'=>'true','multiple'=>'true','size'=>"10",'data-msg-required'=>"Le nom du responsable est obligatoire")); ?>               
                <br><?php echo $this->Form->input('SelectAll',array('type'=>'checkbox')); ?><label class="labelAfter" for="ActionSelectAll">&nbsp;Tout sélectionner</label>            
            </td>
            <td><label class="control-label sstitre  required" for="ActionDomaineId">Domaine : </label></td>
            <td>
                    <?php echo $this->Form->select('domaine_id',$domaines,array('data-rule-required'=>'true','multiple'=>'true','size'=>"10",'data-msg-required'=>"Le domaine est obligatoire")); ?>               
                <br><?php echo $this->Form->input('SelectAllDomaine',array('type'=>'checkbox')); ?><label class="labelAfter" for="ActionSelectAllDomaine">&nbsp;Tout sélectionner</label>            
            </td>            
        </tr>        
    </table>
    <div class="navbar">
        <div class="navbar-inner">
            <div class="container" style="margin-top:2px;text-align:center;">
                <?php echo $this->Form->button('Calculer le rapport', array('class' => 'btn btn-primary','type'=>'submit')); ?>   
            </div>
        </div>
    </div>  
<?php echo $this->Form->end(); ?>     
</div>
<?php if (isset($details)): ?>
<div style="font-family:'Lucida Grande', 'Lucida Sans Unicode', Verdana, Arial, Helvetica, sans-serif;font-size:16px;color:#274b6d;fill:#274b6d;text-align: center;" text-anchor="middle" class="highcharts-title" zIndex="4">Rapport détaillé des actions par utilisateur</div><br>
<table cellpadding="0" cellspacing="0" class="table table-bordered table-striped">
    <thead>
        <tr>
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