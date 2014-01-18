<div class="changelogdemandes form tablemarginright"> 
<table cellpadding="0" cellspacing="0" class="table table-bordered table-striped table-hover" style="width:100%;">
<tr>
                <th><?php echo 'Attribué à'; ?></th>
                <th><?php echo 'Réponse'; ?></th>
                <th><?php echo 'Le'; ?></th>
                <?php if($this->params->controller == 'changelogreponses' && $this->params->action == 'add' && userAuth('profil_id')=='1'): ?>
                    <th><?php echo 'Editer'; ?></th>
                <?php endif; ?>
</tr>
<?php foreach ($changelogreponses as $changelogreponse): ?>
<tr>
        <td>
                <?php echo $changelogreponse['Utilisateur']['NOMLONG']; ?>
        </td>
        <td><?php echo $changelogreponse['Changelogreponse']['REPONSE']; ?>&nbsp;</td>
        <td style="text-align: center;"><?php echo $changelogreponse['Changelogreponse']['modified']; ?>&nbsp;</td>
        <?php if($this->params->controller == 'changelogreponses' && $this->params->action == 'add' && userAuth('id')==$changelogreponse['Changelogreponse']['utilisateur_id']): ?>
            <td style="text-align: center;"><?php echo $this->Html->link('<span class="glyphicons pencil notchange"></span>','#', array('data-id'=>$changelogreponse['Changelogreponse']['id'],'escape' => false)); ?></td>
        <?php endif; ?>        
</tr>
<?php endforeach; ?>
</table> 
</div>
<!--test modal //-->
        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Mise à jour de la réponse</h4>
              </div>
              <div class="modal-body">
                <form id="Changelogreponse" method="POST" data-async data-target="#myModal1">
                <input type="hidden" name="id" id="id">
                <table>
                    <tbody>
                        <tr><td>
                             <textarea style='width:530px;' name="REPONSE" id="REPONSE"></textarea>                  
                        </td></tr>
                    </tbody>
                </table>
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true">Annuler</button>
                <button type="button" class="btn btn-primary" id="InfroTextSubmit">Sauvegarder</button>
              </div>
            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        <!-- /info alert modal //-->

<script>
$(document).ready(function () {
    $(document).on('click','.pencil',function(e){
        var id = $(this).parent('a').attr('data-id');
        $.ajax({
            type: "POST",       
            url: "<?php echo $this->Html->url(array('controller'=>'changelogreponses','action'=>'json_get_info')); ?>/" + id,
            contentType: "application/json",
            success : function(response) {
                var json = $.parseJSON(response);
                $('#REPONSE').text(json['Changelogreponse']['REPONSE']);
                tinyMCE.get('REPONSE').setContent(json['Changelogreponse']['REPONSE']);
                $('#id').val(json['Changelogreponse']['id']);
                $('#editModal').modal('show')
            },
            error :function(response, status,errorThrown) {
                alert("Erreur! il se peut que votre session soit expirée\n\rActualiser la page et recommencer.");
            }
         });
    });
    
    $(document).on('click','#InfroTextSubmit',function(e){
       //e.preventDefault();
       var memo = tinymce.get('REPONSE').getContent(); //$(this).parents().find('#memo').html();
       var id = $('#id').val();
       $.ajax({
           dataType: "html",
           type: "POST",
           url: "<?php echo $this->Html->url(array('controller'=>'changelogreponses','action'=>'ajaxedit')); ?>/",
           data: ({id:id,memo:memo})
       }).done(function ( data ) {
       location.reload();
       });
       return true;
   });    
});
</script>