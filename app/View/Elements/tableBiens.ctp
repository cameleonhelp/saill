	<table cellpadding="0" cellspacing="0" class="table table-bordered table-striped table-hover tablemax">
	<tr>
                        <th><?php echo 'Nom'; ?></th>
                        <th><?php echo 'Environnement DSI-T'; ?></th>
                        <th><?php echo 'Installé'; ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($biens as $bien): ?>
	<tr>
            <td class="text-courrier"><?php echo h($bien['Bien']['NOM']); ?>&nbsp;</td>
            <?php $listenv = isset($bien['Assobienlogiciel']['LISTNOMENV']) ? $bien['Assobienlogiciel']['LISTNOMENV'] : ''; ?>
            <td><span id='bienlogiciel<?php echo $bien['Assobienlogiciel']['id']; ?>'><?php echo $listenv; ?></span>
                <span class="pull-right"><a class="btn btn-xs btn-default addenv" data-span="bienlogiciel<?php echo $bien['Assobienlogiciel']['id']; ?>" data-envid="<?php echo $bien['Assobienlogiciel']['dsitenv_id']; ?>" data-id="<?php echo $bien['Assobienlogiciel']['id']; ?>"><span class="glyphicons notchange electrical_plug"></span></a></span></td>
            <td style="text-align: center;">
            <?php $image = (isset($bien['Assobienlogiciel']['INSTALL']) && $bien['Assobienlogiciel']['INSTALL']==true) ? 'ok_2' : 'ok_2 disabled' ; ?>
                <a href="#" class="installed cursor showoverlay" data-id="<?php echo $bien['Assobienlogiciel']['id']; ?>"  rel='tooltip'  data-container="body" data-title="Installé le <?php echo $bien['Assobienlogiciel']['DATEINSTALL']; ?>"><span class="glyphicons <?php echo $image; ?> notchange"></span></a>
                </td>
            <td class="actions">
            <?php if (userAuth('profil_id')!='2' && isAuthorized('biens', 'edit')) : ?>
            <?php echo $this->Html->link('<span class="glyphicons pencil notchange"></span>', "#",array('escape' => false,'data-id'=> $bien['Assobienlogiciel']['id'])); ?>&nbsp;
            <?php endif; ?>
            <?php if (userAuth('profil_id')!='2' && isAuthorized('biens', 'delete')) : ?>
            <!-- à mettre en ajax -->
            <?php echo $this->Form->postLink('<span class="glyphicons bin notchange"></span>', array('controller'=>'assobienlogiciels','action' => 'ajaxdelete', $bien['Assobienlogiciel']['id']),array('escape' => false), __('Etes-vous certain de vouloir supprimer ce bien ?')); ?>                    
            <?php endif; ?>   
            <?php if (userAuth('profil_id')!='2' && isAuthorized('biens', 'edit')) : ?>
            <?php echo $this->Html->link('<span class="glyphicons nameplate notchange"></span>', array('controller'=>'biens','action'=>'edit',$bien['Assobienlogiciel']['bien_id']),array('escape' => false)); ?>&nbsp;
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
        <?php  echo $this->Form->input('id',array('type'=>'hidden')); ?>
        <?php  echo $this->Form->input('logiciel_id',array('type'=>'hidden','value'=>$this->data['Logiciel']['id'])); ?>
        <div class="form-group">
              <label class="col-md-4" for="AssobienlogicielLogicielId">Nom : </label>
              <div class="col-md-7">
                  <?php echo $this->Form->select('bien_id',$listbiens,array('class'=>'form-control','empty' => 'Choisir un bien')); ?>                   
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
        $.ajax({
            type: "POST",       
            url: "<?php echo $this->Html->url(array('controller'=>'assobienlogiciels','action'=>'json_get_logiciel_info')); ?>/" + id,
            contentType: "application/json",
            success : function(response) {
                var json = $.parseJSON(response);
                $('#AssobienlogicielId').val(json[0]['Assobienlogiciel']['id']);
                $('#AssobienlogicielBienId').val(json[0]['Assobienlogiciel']['bien_id']);
                $('#AssobienlogicielLogicielId').val(json[0]['Assobienlogiciel']['logiciel_id']);
                $('#AssobienlogicielENVDSIT').val(json[0]['Assobienlogiciel']['ENVDSIT']);
                $checked = json[0]['Assobienlogiciel']['INSTALL'] == 1 ? true : false;
                $('#AssobienlogicielINSTALL').prop('checked', $checked);
                $labelchecked = json[0]['Assobienlogiciel']['INSTALL'] == 1 ? 'Oui' : 'Non';
                $('#AssobienlogicielINSTALL').next('label').text($labelchecked);
                $('#editModal').modal('show');
            },
            error :function(response,status,errorThrown) {
                alert("Erreur! il se peut que votre session soit expirée\n\rActualiser la page et recommencer.");
            }
         });
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
                    alert("Erreur! il se peut que votre session soit expirée\n\rActualiser la page et recommencer."+response.responseText);
                }
            });
    });    
});
</script>