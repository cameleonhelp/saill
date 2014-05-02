	<table cellpadding="0" cellspacing="0" class="table table-bordered table-striped table-hover tablemax tablelogiciels">
	<thead><tr>
            <th><?php echo 'Logiciel'; ?></th>
            <th><?php echo 'Application'; ?></th>
            <th><?php echo 'Lot'; ?></th>
            <th><?php echo 'Env. DSIT'; ?></th>
            <th><?php echo 'Installé'; ?></th>
            <th class="actions"><?php echo __('Actions'); ?></th>
            </tr></thead>
	<?php foreach ($assobienlogiciels as $logiciel): ?>
	<tr>
		<td><?php echo $logiciel['Logiciel']['NOM']; ?></td>
                <td><?php echo $logiciel['Logiciel']['APPNOM']; ?></td>
                <td><?php echo $logiciel['Logiciel']['LOTNOM']; ?></td>
                <?php $listenv = isset($logiciel['Assobienlogiciel']['LISTNOMENV']) ? $logiciel['Assobienlogiciel']['LISTNOMENV'] : ''; ?>
                <td><span id='bienlogiciel<?php echo $logiciel['Assobienlogiciel']['id']; ?>'><?php echo $listenv; ?></span>
                <span class="pull-right"><a class="btn btn-xs btn-default addenv" data-span="bienlogiciel<?php echo $logiciel['Assobienlogiciel']['id']; ?>" data-envid="<?php echo $logiciel['Assobienlogiciel']['dsitenv_id']; ?>" data-id="<?php echo $logiciel['Assobienlogiciel']['id']; ?>"><span class="glyphicons notchange electrical_plug"></span></a></span></td>
		<td style="text-align:center;">
                    <?php $image = (isset($logiciel['Assobienlogiciel']['INSTALL']) && $logiciel['Assobienlogiciel']['INSTALL']==true) ? 'ok_2' : 'ok_2 disabled' ; ?>
                <a href="#" class="installed cursor showoverlay" data-id="<?php echo $logiciel['Assobienlogiciel']['id']; ?>"  rel='tooltip'  data-container="body" data-title="Installé le <?php echo $logiciel['Assobienlogiciel']['DATEINSTALL']; ?>"><span class="glyphicons <?php echo $image; ?> notchange"></span></a>
                </td>
		<td class="actions">
                <!-- à mettre en ajax --> 
                <?php if (userAuth('profil_id')!='2' && isAuthorized('logiciels', 'edit')) : ?>
                <?php echo $this->Html->link('<span class="glyphicons pencil notchange"></span>', '#',array('escape' => false,'data-id'=> $logiciel['Assobienlogiciel']['id'],'data-appid'=> $logiciel['Logiciel']['application_id'],'data-lotid'=> $logiciel['Logiciel']['lot_id'])); ?>&nbsp;
                <?php endif; ?>
                <?php if (userAuth('profil_id')!='2' && isAuthorized('logiciels', 'delete')) : ?>
                <!-- à mettre en ajax -->                
                <?php echo $this->Form->postLink('<span class="glyphicons bin notchange"></span>', array('controller'=>'assobienlogiciels','action' => 'ajaxdelete', $logiciel['Assobienlogiciel']['id']),array('escape' => false), __('Etes-vous certain de vouloir supprimer ce logiciels ?')); ?>                    
                <?php endif; ?>   
                <?php if (userAuth('profil_id')!='2' && isAuthorized('logiciels', 'edit')) : ?>
                <?php echo $this->Html->link('<span class="glyphicons nameplate notchange"></span>', array('controller'=>'logiciels','action'=>'edit',$logiciel['Assobienlogiciel']['logiciel_id']),array('escape' => false)); ?>&nbsp;
                <?php endif; ?>                 
            </td>
	</tr>
<?php endforeach; ?>
	</table>
<!--test modal //-->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Ajout d'un logiciel existant</h4>
      </div>
      <?php echo $this->Form->create('Assobienlogiciel',array('controller'=>'assobienlogiciels','action'=>'ajaxedit','id'=>'formValidate','class'=>'form-horizontal','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?>
      <div class="modal-body">
        <?php  echo $this->Form->input('bien_id',array('type'=>'hidden','value'=>$this->data['Bien']['id'])); ?>
        <?php  echo $this->Form->input('id',array('type'=>'hidden')); ?>
        <div class="form-group">
              <label class="col-md-4" for="AssobienlogicielApplicationId">Application : </label>
              <div class="col-md-7">
                  <?php echo $this->Form->input('application_id',array('type'=>'hidden','value'=>$this->data['Bien']['application_id'])); ?>
                  <?php echo $this->Form->select('application_id',$applications,array('class'=>'form-control','id'=>'SelectApplicationId','empty'=>false,'selected' => $this->data['Bien']['application_id'])); ?>                   
              </div>
        </div>     
        <div class="form-group">
              <label class="col-md-4" for="AssobienlogicielLotId">Lot : </label>
              <div class="col-md-7">
                  <?php echo $this->Form->input('lot_id',array('type'=>'hidden','value'=>$this->data['Bien']['lot_id'])); ?>
                  <?php echo $this->Form->select('lot_id',$lots,array('class'=>'form-control','id'=>'SelectLotId','empty'=>false,'selected' => $this->data['Bien']['lot_id'])); ?>                   
              </div>
        </div>             
        <div class="form-group">
              <label class="col-md-4" for="AssobienlogicielLogicielId">Nom : </label>
              <div class="col-md-7">
                  <?php echo $this->Form->select('logiciel_id',$listlogiciels,array('class'=>'form-control','empty' => 'Choisir un logiciel')); ?>                   
              </div>
        </div>  
        <!--<div class="form-group">
            <label class="col-md-4" for="AssobienlogicielENVDSIT">Nom environnement DSI-T : </label>      
            <div class="col-md-7">
                <?php echo $this->Form->input('ENVDSIT',array('type'=>'text','placeholder'=>'Nom environnement DSI-T','class'=>'form-control')); ?>
            </div>         
        </div>  -->
        <div class="form-group">
            <label class="col-md-4" for="AssobienlogicielINSTALL">Installé : </label>      
            <div class="col-md-7">
                <?php echo $this->Form->input('INSTALL',array('class'=>'yesno')); ?>
                &nbsp;<label for="AssobienlogicielINSTALL" class='labelAfter'></label>
            </div>
        </div>                    
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true">Annuler</button>
        <button type="submit" class="btn btn-primary">Enregistrer</button>
      <?php echo $this->Form->end(); ?>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /test modal //-->
<?php echo $this->element('modals/envdsit'); ?>
<script>
$(document).ready(function () {
   $(".tablelogiciels").tablesorter({
        headers: {
            4:{filter:false},
            5:{filter:false},
            6:{filter:false}
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

    $(document).on('click','.addenv',function(e){
        var id = $(this).attr('data-id');
        var envsid = $(this).attr('data-envid');
        var bienlogicielid = $(this).attr('data-span');
        $('#modalenvdsit #assoid').val(id);
        $('#modalenvdsit #envsid').val(envsid);
        $('#modalenvdsit #tospan').val("#"+bienlogicielid);
        $('#modalenvdsit').modal('show');
    });
    
    $(document).on('click','.pencil',function(e){
        var id = $(this).parent('a').attr('data-id');
        var appid = $(this).parent('a').attr('data-appid');
        var lotid = $(this).parent('a').attr('data-lotid');
        $("#editModal #AssobienlogicielLogicielId").find('option:not(:first)').remove();
        //remplir select logiciel_id avec bon liste
        $.ajax({
            type: "POST",       
            url: "<?php echo $this->Html->url(array('controller'=>'logiciels','action'=>'json_get_select_compatible')); ?>/"+ lotid +"/"+appid, 
            contentType: "application/json",
            success : function(response) {
                var json = $.parseJSON(response);
                var options = $("#editModal #AssobienlogicielLogicielId");
                $.each(json, function (index, value) {
                    if(index != undefined) {
                        options.append($("<option />").val(value).text(index));
                    }
                });                        
            },
            error :function(response, status,errorThrown) {
                alert("Erreur! Impossible de mettre à jour les informations\n\rActualiser la page et recommencer.");
            }
        }); 
        $(this).delay(500);
        $.ajax({
            type: "POST",       
            url: "<?php echo $this->Html->url(array('controller'=>'assobienlogiciels','action'=>'json_get_logiciel_info')); ?>/" + id,
            contentType: "application/json",
            success : function(response) {
                var json = $.parseJSON(response);
                console.log(json);
                $('#editModal #AssobienlogicielId').val(json[0]['Assobienlogiciel']['id']);
                $('#editModal #AssobienlogicielBienId').val(json[0]['Assobienlogiciel']['bien_id']);
                $("#editModal #AssobienlogicielLotId").val(json[0]['Logiciel']['lot_id']);
                $("#editModal #SelectLotId").attr('data-lotid',json[0]['Logiciel']['lot_id']);
                $("#editModal #AssobienlogicielApplicationId").val(json[0]['Logiciel']['application_id']);
                $("#editModal #SelectApplicationId").attr('data-appid',json[0]['Logiciel']['application_id']);
                $('#editModal #AssobienlogicielLogicielId').attr('data-logid',json[0]['Assobienlogiciel']['logiciel_id']);                
                $('#editModal #AssobienlogicielENVDSIT').val(json[0]['Assobienlogiciel']['ENVDSIT']);
                $checked = json[0]['Assobienlogiciel']['INSTALL'] == 1 ? true : false;
                $('#editModal #AssobienlogicielINSTALL').prop('checked', $checked);
                $labelchecked = json[0]['Assobienlogiciel']['INSTALL'] == 1 ? 'Oui' : 'Non';
                $('#editModal #AssobienlogicielINSTALL').next('label').text($labelchecked);
                $('#editModal').modal('show');
            },
            error :function(response,status,errorThrown) {
                alert("Erreur! Impossible de mettre à jour les informations\n\rActualiser la page et recommencer.");
            }
         });
    });
    
            
    $('#editModal').on('shown.bs.modal', function (e) {
        $('#editModal #AssobienlogicielLogicielId').val($('#editModal #AssobienlogicielLogicielId').attr('data-logid'));
        //$('#editModal #SelectApplicationId option:selected').attr("selected",false);
        $('#editModal #SelectApplicationId').val($('#editModal #SelectApplicationId').attr('data-appid'));
        $('#editModal #SelectLotId').val($('#editModal #SelectLotId').attr('data-lotid'));
    });
    
    $(document).on('click','.installed',function(e){
        var id = $(this).attr('data-id');
            $.ajax({
                dataType: "html",
                type: "POST",
                url: "<?php echo $this->Html->url(array('controller'=>'assobienlogiciels','action'=>'ajax_install')); ?>/",
                data : ({id:id}),
                success :function(response) {
                    location.reload();
                },
                error : function(response,status,errorThrown) {
                    $('#overlay').hide();
                    alert("Erreur! Impossible de mettre à jour les informations\n\rActualiser la page et recommencer.");
                }
            });
    });   
    
    $(document).on('change','#editModal #SelectApplicationId',function(e){
        var nom = $("#editModal #SelectApplicationId option:selected").text();
        var id = $("#editModal #SelectApplicationId option:selected").val();
        $("#editModal #AssobienlogicielApplicationId").val(id);
        var lotid = $("#editModal #AssobienlogicielLotId").val();
        if(lotid != '') {
            $("#editModal #AssobienlogicielLogicielId").find('option:not(:first)').remove();
            if(id!=''){
            $.ajax({
                type: "POST",       
                url: "<?php echo $this->Html->url(array('controller'=>'logiciels','action'=>'json_get_select_compatible')); ?>/"+ lotid +"/"+id, 
                contentType: "application/json",
                success : function(response) {
                    var json = $.parseJSON(response);
                    var options = $("#editModal #AssobienlogicielLogicielId");
                    $.each(json, function (index, value) {
                        if(index != undefined) {
                            options.append($("<option />").val(value).text(index));
                        }
                    });                       
                },
                error :function(response, status,errorThrown) {
                    alert("Erreur! Impossible de mettre à jour les informations\n\rActualiser la page et recommencer.");
                }
             }); 
           }
       }
    });    
    
    $(document).on('change','#editModal #SelectLotId',function(e){
        var nom = $("#editModal #SelectLotId option:selected").text();
        var id = $("#editModal #SelectLotId option:selected").val();
        $("#editModal #AssobienlogicielLotId").val(id);
        var appid = $("#editModal #AssobienlogicielApplicationId").val();
        if(appid != '') {
            $("#editModal #AssobienlogicielLogicielId").find('option:not(:first)').remove();
            if(id!=''){
            $.ajax({
                type: "POST",       
                url: "<?php echo $this->Html->url(array('controller'=>'logiciels','action'=>'json_get_select_compatible')); ?>/"+ id +"/"+appid, 
                contentType: "application/json",
                success : function(response) {
                    var json = $.parseJSON(response);
                    var options = $("#editModal #AssobienlogicielLogicielId");
                    $.each(json, function (index, value) {
                        if(index != undefined) {
                            options.append($("<option />").val(value).text(index));
                        }
                    });                       
                },
                error :function(response, status,errorThrown) {
                    alert("Erreur! Impossible de mettre à jour les informations\n\rActualiser la page et recommencer.");
                }
             }); 
           }
       }
    });    
});
</script>