	<table cellpadding="0" cellspacing="0" class="table table-bordered table-striped table-hover tablemax">
	<tr>
            <th><?php echo 'Logiciel'; ?></th>
            <th><?php echo 'Type Env. DSIT'; ?></th>
            <th><?php echo 'Installé'; ?></th>
            <th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($assobienlogiciels as $logiciel): ?>
	<tr>
		<td><?php echo $logiciel['Logiciel']['NOM']; ?></td>
		<td><?php echo h($logiciel['Assobienlogiciel']['ENVDSIT']); ?>&nbsp;</td>
		<td style="text-align:center;">
                    <?php $image = (isset($logiciel['Assobienlogiciel']['INSTALL']) && $logiciel['Assobienlogiciel']['INSTALL']==true) ? 'ok_2' : 'ok_2 disabled' ; ?>
                <a href="#" class="installed cursor showoverlay" data-id="<?php echo $logiciel['Assobienlogiciel']['id']; ?>"  rel='tooltip'  data-container="body" data-title="Installé le <?php echo $logiciel['Assobienlogiciel']['DATEINSTALL']; ?>"><span class="glyphicons <?php echo $image; ?> notchange"></span></a>
                </td>
		<td class="actions">
                <!-- à mettre en ajax --> 
                <?php if (userAuth('profil_id')!='2' && isAuthorized('logiciels', 'edit')) : ?>
                <?php echo $this->Html->link('<span class="glyphicons pencil notchange"></span>', '#',array('escape' => false,'data-id'=> $logiciel['Assobienlogiciel']['id'])); ?>&nbsp;
                <?php endif; ?>
                <?php if (userAuth('profil_id')!='2' && isAuthorized('logiciels', 'delete')) : ?>
                <!-- à mettre en ajax -->                
                <?php echo $this->Form->postLink('<span class="glyphicons showoverlay bin notchange"></span>', array('controller'=>'assobienlogiciels','action' => 'ajaxdelete', $logiciel['Assobienlogiciel']['id']),array('escape' => false), __('Etes-vous certain de vouloir supprimer ce logiciels ?')); ?>                    
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
              <label class="col-lg-4" for="AssobienlogicielLogicielId">Nom : </label>
              <div class="col-lg-7">
                  <?php echo $this->Form->select('logiciel_id',$listlogiciels,array('class'=>'form-control','empty' => 'Choisir un logiciel')); ?>                   
              </div>
        </div>  
        <div class="form-group">
            <label class="col-lg-4" for="AssobienlogicielENVDSIT">Nom environnement DSI-T : </label>      
            <div class="col-lg-7">
                <?php echo $this->Form->input('ENVDSIT',array('type'=>'text','placeholder'=>'Nom environnement DSI-T','class'=>'form-control')); ?>
            </div>         
        </div>  
        <div class="form-group">
            <label class="col-lg-4" for="AssobienlogicielINSTALL">Installé : </label>      
            <div class="col-lg-7">
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

<script>
$(document).ready(function () {
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
                    alert("Erreur! il se peut que votre session soit expirée\n\rActualiser la page et recommencer.");
                }
            });
    });    
});
</script>