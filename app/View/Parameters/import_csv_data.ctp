<div class="params importCsvData">
    <div class="">
        <?php echo $this->Form->create('Parameter',array('id'=>'formValidate','type' => 'file','class'=>'form-horizontal','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?>
            <div class="form-group">
                  <label for="ParameterFile" class="col-md-2">Fichiers CSV à importer</label>
                  <div class="col-md-7">
                    <?php echo $this->Form->input('file', array('type' => 'file','size'=>"60",'class'=>'pull-left margintop5')); ?><label for="ParameterFile" class="pull-left margintop7 italic"><?php echo 'taille max de '.ini_get('upload_max_filesize'); ?></label>
                  </div>
            </div>            
            <div class="form-group">
                <label class="col-md-2 required" for="ParameterTable">Modèle : </label>
                <div class="col-md-5">
                    <?php echo $this->Form->select('table',$models,array('data-rule-required'=>'true','class'=>'form-control','data-msg-required'=>"Le modèle est obligatoire",'selected' => '','empty' => 'Choisir un modèle')); ?>
                    <div id='listfields' style='margin-top:10px;'><br></div><div style='font-style:italic;' id='facfields'></div>
                </div>
            </div>        
            <div class="" style="clear:both;margin-top: 10px;">
            <div class="form-group">
              <div class="btn-block-horizontal">
                    <?php echo $this->Form->button('Annuler', array('type'=>'submit','class' => 'btn btn-sm btn-default showoverlay cancel','value'=>'cancel','div' => false, 'name' => 'cancel')); ?>&nbsp;<?php echo $this->Form->button('Enregistrer', array('class' => 'btn btn-sm btn-primary','type'=>'submit')); ?>                
              </div>
            </div>  
            </div>    
        <?php echo $this->Form->end(); ?>
        <?php if($messages): ?>
        <div class="">
            <div class="bs-callout bs-callout-warning">
                <h4><small>Journal d'erreur de l'import CSV :</small></h4>
                <?php foreach($messages['message'] as $key=>$value): ?>
                <ul>
                    <li><?php echo $value; ?></li>
                </ul>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>

<script>
$(document).ready(function () {
    $(document).on('change','#ParameterTable',function(e){
        var nom = $("#ParameterTable option:selected").val();
        var overlay = $('#overlay');
        var listfields = "Obligatoire : ";
        var facfields = "Facultatif : ";
        overlay.show();   
        if(nom != ""){
        $.ajax({
            type: "POST",       
            url: "<?php echo $this->Html->url(array('controller'=>'parameters','action'=>'jsongetdatatabledescription')); ?>/"+nom,
            data: {},  
            contentType: "application/json",
            success : function(response) {
                var json = $.parseJSON(response);
                if(json.length>0) {
                    $.each(json, function () {
                        if(this.COLUMNS.Null == 'NO') {
                            if (this.COLUMNS.Field != "id"){
                                if(this.COLUMNS.Field != "created") {
                                    if (this.COLUMNS.Field != "modified"){
                                        if (this.COLUMNS.Field != "entite_id"){
                                            listfields += this.COLUMNS.Field+" ";
                                        }
                                    }
                                }
                            }
                        } else {
                            if (this.COLUMNS.Field != "id"){
                                if(this.COLUMNS.Field != "created") {
                                    if (this.COLUMNS.Field != "modified"){
                                        if (this.COLUMNS.Field != "entite_id"){
                                            facfields += this.COLUMNS.Field+" ";
                                        }
                                    }
                                }
                            }                        
                        }
                    });
                } else {
                    listfields += "";
                    facfields += "";
                }
                $('#listfields').text(listfields);
                $('#facfields').text(facfields);
                overlay.hide();
            },
            error :function(response, status,errorThrown) {
                overlay.hide();
                alert("Erreur! Impossible de mettre à jour les informations\n\rActualiser la page et recommencer."+response.responseText);
            }
         });
         } else {
                $('#listfields').text('');
                $('#facfields').text('');
         }
         overlay.hide();         
    });
});
</script>