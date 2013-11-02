<div class="marginright20">
<?php echo $this->Form->create('Envoutil',array('id'=>'formValidate','class'=>'form-horizontal','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?>
    <div class="form-group">
        <label class="col-lg-2 required" for="EnvoutilNOM">Nom : </label>
        <div class="col-lg-5">
            <?php echo $this->Form->input('NOM',array('type'=>'text','placeholder'=>'Nom de l\'outil','data-rule-required'=>'true','class'=>'form-control','data-msg-required'=>"Le nom de l'outil est obligatoire")); ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-lg-2" for="EnvoutilOS">OS : </label>
        <div class="col-lg-5">
            <?php echo $this->Form->input('OS',array('class'=>'yesno')); ?>
            &nbsp;<label for="EnvoutilOS" class='labelAfter'></label>
        </div>
    </div>    
    <div style="clear:both;margin-top: 10px;">
    <div class="form-group">
      <div class="btn-block-horizontal">
            <?php echo $this->Form->button('Annuler', array('type'=>'submit','class' => 'btn btn-sm btn-default showoverlay cancel','value'=>'cancel','div' => false, 'name' => 'cancel')); ?>&nbsp;<?php echo $this->Form->button('Enregistrer', array('class' => 'btn btn-sm btn-primary','type'=>'submit')); ?>                
      </div>
    </div>  
    </div>
<?php if ($this->params->action == 'edit') echo $this->Form->input('id',array('type'=>'hidden')); ?>     
<?php echo $this->Form->end(); ?>

<?php if ($this->params->action == 'edit'): ?>
<!-- bouton pour ajouter une version sur un lot -->

<button type="button" data-toggle="modal" data-target="#addModal" class="btn btn-default btn-sm  pull-right" style="margin-bottom:10px;">Ajouter une version</button>                    
<label class="sstitre">Liste des versions</label>
<button type="button" id="labelfilterversion" class="btn btn-sm btn-default active showoverlay" data-toggle="button">actives</button>
<?php echo $this->element('tableEnvversion'); ?>
<?php endif; ?>    
</div>
<!--test modal //-->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Ajout d'une version pour le logiciel <?php echo $this->data['Envoutil']['NOM']; ?></h4>
      </div>
      <?php echo $this->Form->create('Envversion',array('controller'=>'envversions','action'=>'ajaxadd','id'=>'ajaxformValidate','class'=>'form-horizontal','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?>
      <div class="modal-body">
        <?php  echo $this->Form->input('envoutil_id',array('type'=>'hidden','value'=>$this->data['Envoutil']['id'])); ?>
        <div class="form-group">
              <label class="col-lg-4" for="EnvversionVERSION">Version : </label>
              <div class="col-lg-7">
                  <?php echo $this->Form->input('VERSION',array('class'=>'form-control','type'=>'text','placeholder'=>'Numéro de version du logiciel '.$this->data['Envoutil']['NOM'])); ?>                     
              </div>
        </div>   
        <div class="form-group">
              <label class="col-lg-4" for="EnvversionEDITION">Edition : </label>
              <div class="col-lg-7">
                  <?php echo $this->Form->input('EDITION',array('class'=>'form-control','type'=>'text','placeholder'=>'Edition')); ?> 
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
    $(document).on('click','#labelfilterversion',function(e){
        var isactif = $(this).hasClass('active');
        var actif = isactif ? 1 : 0 ;
        isactif ? $('#labelfilterversion').text('actives') : $('#labelfilterversion').text('inactives') ;
        var overlay = $('#overlay');
        overlay.show();         
        $.ajax({
            type: "POST",       
            url: "<?php echo $this->Html->url(array('controller'=>'envversions','action'=>'json_get_version_for')); ?>/<?php echo $this->data['Envoutil']['id']; ?>/"+actif,
            data: {},  
            contentType: "application/json",
            success : function(response) {
                var json = $.parseJSON(response);
                $('#tableEnvversion').find('tbody > tr').remove();
                var table = $('#tableEnvversion tbody');
                if(json.length>0) {
                        $.each(json, function (i, item) {
                            var tr = $("<tr></tr>");
                            table.append(tr);

                            var td = $("<td>" + item['Envversion']['VERSION'] + "</td>");
                            tr.append(td);
                            var td = $("<td>" + item['Envversion']['EDITION'] + "</td>");
                            tr.append(td);
                            var image = item['Envversion']['ACTIF'] ? 'ok_2' : 'ok_2 disabled' ;
                            var td = $("<td style=\"text-align:center;\">" + "<a href=\"#\" class=\"actif cursor showoverlay\" data-id=\"" + item['Envversion']['id'] + "\" ><span class=\"glyphicons " + image + " notchange\"></span></a>" + "</td>");
                            tr.append(td);
                            var edit = "";
                            <?php if (userAuth('profil_id')!='2' && isAuthorized('envversions', 'edit')) : ?>
                            edit = '<a href="#" data-id="'+item['Envversion']['id']+'"><span class="glyphicons pencil notchange"></span></a>';
                            <?php endif; ?>   
                            var bin = "";
                            <?php if (userAuth('profil_id')!='2' && isAuthorized('envversions', 'delete')) : ?>
                            var url = "<?php echo FULL_BASE_URL.$this->params->base.DS; ?>envversions/ajaxdelete/"+ item['Envversion']['id'];
                            bin = '<a href="#" onclick="if (confirm(\'Etes-vous certain de vouloir supprimer cette version applicative\')) { location.href=\'' + url  + '\'; } event.returnValue = false; return false;"><span class="glyphicons bin notchange"></span></a>';
                            <?php endif; ?>                               
                            var td = $("<td class=\"actions\">" + edit + "&nbsp;&nbsp;" + bin + "</td>");
                            tr.append(td);
                        });
                }
                overlay.hide();
            },
            error :function(response, status,errorThrown) {
                overlay.hide();
                alert("Erreur! il se peut que votre session soit expirée\n\rActualiser la page et recommencer.");
            }
         });
         overlay.hide();         
    });
});
</script>