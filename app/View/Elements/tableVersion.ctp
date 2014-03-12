<table cellpadding="0" cellspacing="0" class="table table-bordered table-striped table-hover tablemax" id="tableVersion">
    <thead>
    <tr>
    <th><?php echo 'Nom'; ?></th>
    <th width='30px'><?php echo 'Actif'; ?></th>
    <th class="actions"><?php echo __('Actions'); ?></th>
    </tr>
    </thead>
<tbody>
<?php foreach ($versions as $version): ?>
<tr>
    <td><?php echo h($version['Version']['NOM']); ?>&nbsp;</td>
            <td style="text-align:center;"><?php $image = (isset($version['Version']['ACTIF']) && $version['Version']['ACTIF']==true) ? 'ok_2' : 'ok_2 disabled' ; ?>
                <a href="#" class="actif cursor showoverlay" data-id="<?php echo $version['Version']['id']; ?>" ><span class="glyphicons <?php echo $image; ?> notchange"></span></a></td>  
    <td class="actions">
        <?php if (userAuth('profil_id')!='2' && isAuthorized('versions', 'edit')) : ?>
        <?php echo $this->Html->link('<span class="glyphicons pencil notchange"></span>','#', array('data-id'=>$version['Version']['id'],'escape' => false)); ?>&nbsp;
        <?php endif; ?>
        <?php if (userAuth('profil_id')!='2' && isAuthorized('versions', 'delete')) : ?>
        <?php echo $this->Form->postLink('<span class="glyphicons bin notchange"></span>', array('controller'=>'versions','action' => 'ajaxdelete',$version['Version']['id']),array('escape' => false), __('Etes-vous certain de vouloir supprimer cette version applicative')); ?>                    
        <?php endif; ?>                    
    </td>
</tr>
<?php endforeach; ?>
</tbody>
</table>

<!--test modal //-->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Modification d'une version pour le lot <?php echo $this->data['Lot']['NOM']; ?></h4>
      </div>
      <?php echo $this->Form->create('Version',array('controller'=>'versions','action'=>'ajaxedit','id'=>'formValidate','class'=>'form-horizontal','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?>
      <div class="modal-body">
        <?php  echo $this->Form->input('lot_id',array('type'=>'hidden','value'=>$this->data['Lot']['id'])); ?>
        <?php  echo $this->Form->input('id',array('type'=>'hidden')); ?>
        <div class="form-group">
              <label class="col-md-4" for="VersionNOM">Nom : </label>
              <div class="col-md-7">
                  <?php echo $this->Form->input('NOM',array('class'=>'form-control','type'=>'text','placeholder'=>'Numéro de version du lot '.$this->data['Lot']['NOM'])); ?>                     
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
    $("table").tablesorter();
    
    $(document).on('click','.actif',function(e){
        var id = $(this).attr('data-id');
            $.ajax({
                dataType: "html",
                type: "POST",
                url: "<?php echo $this->Html->url(array('controller'=>'versions','action'=>'ajax_actif')); ?>/",
                data: ({id:id})
            }).done(function ( data ) {
                location.reload();
            });
    });
    $(document).on('click','.pencil',function(e){
        var id = $(this).parent('a').attr('data-id');
        $.ajax({
            type: "POST",       
            url: "<?php echo $this->Html->url(array('controller'=>'versions','action'=>'json_get_version_info')); ?>/" + id,
            contentType: "application/json",
            success : function(response) {
                var json = $.parseJSON(response);
                $('#VersionNOM').val(json[0]['Version']['NOM']);
                $('#VersionLotId').val(json[0]['Version']['lot_id']);
                $('#VersionId').val(json[0]['Version']['id']);
                $('#editModal').modal('show')
            },
            error :function(response, status,errorThrown) {
                alert("Erreur! il se peut que votre session soit expirée\n\rActualiser la page et recommencer.");
            }
         });
    });
});
</script>