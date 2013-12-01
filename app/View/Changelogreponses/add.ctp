<div class="marginright20">
    <?php echo $this->element('changelogsubmenu'); ?>
    <div class="changelogreponses form">      
<?php echo $this->Form->create('Changelogreponse',array('id'=>'formValidate','class'=>'form-horizontal','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?>
        <div class="block-panel-50-left">
        <div class="form-group">
            <label class="col-lg-4" for="ChangelogreponseVersionId">Version : </label>
            <div  class="col-lg-6">
                <?php $version = isset($changelogdemande['Changelogdemande']['changelogversion_id']) ? $changelogdemande['Changelogdemande']['changelogversion_id'] : '';
                echo $this->Form->select('version_id',$changelogversions,array('class'=>'form-control','empty'=>'Choisissez une version','default'=>$version)); ?>          
            </div>
        </div>
        <div class="form-group">
            <label class="col-lg-4" for="ChangelogreponseETAT">Etat : </label>
            <div  class="col-lg-6">
                <?php $etat = isset($changelogdemande['Changelogdemande']['ETAT']) ? $changelogdemande['Changelogdemande']['ETAT'] : 0;
		echo $this->Form->select('ETAT',$changelogetats,array('class'=>'form-control','empty'=>false,'default'=>$etat)); ?>          
            </div>
        </div>   
        <div class="form-group">
            <label class="col-lg-4" for="ChangelogreponseDATEPREVUE">Date prévue : </label>
            <div  class="col-lg-5">
              <div class="input-group" style="margin-left: 0px;">
              <?php $today = new dateTime(); ?>
              <?php echo $this->Form->input('DATEPREVUE',array('type'=>'text','placeholder'=>'ex.: '.$today->format('d/m/Y'),'class'=>"form-control dateall", 'value'=>$changelogdemande['Changelogdemande']['DATEPREVUE'])); ?>
              <span class="input-group-addon addon-middle date-addon-clean btn-addon" data-target="#ChangelogreponseDATEPREVUE"><span class="glyphicons circle_remove grey"></span></span>
              <span class="input-group-addon date-addon-calendar btn-addon" data-target="#ChangelogreponseDATEPREVUE"><span class="glyphicons calendar"></span></span>
              </div>         
            </div>
        </div>               
        </div>
        <div class="block-panel-50-right">
        <div class="form-group">
            <label class="col-lg-4" for="ChangelogreponseTYPE">Type : </label>
            <div  class="col-lg-6">
                <?php $type = isset($changelogdemande['Changelogdemande']['TYPE']) ? $changelogdemande['Changelogdemande']['TYPE'] : 0;
		echo $this->Form->select('TYPE',$changelogtypes,array('class'=>'form-control','default' => $type,'empty'=>false)); ?>          
            </div>
        </div>
        <div class="form-group">
            <label class="col-lg-4" for="ChangelogreponseCRITICITE">Criticité : </label>
            <div  class="col-lg-6">
                <?php $criticite = isset($changelogdemande['Changelogdemande']['CRITICITE']) ? $changelogdemande['Changelogdemande']['CRITICITE'] : 1;
                echo $this->Form->select('CRITICITE',$changelogcriticites,array('class'=>'form-control','default' => $criticite,'empty'=>false)); ?>          
            </div>
        </div>  
        <div class="form-group">
            <label class="col-lg-4">&nbsp</label>
            <div class="col-lg-8">&nbsp;</div>
        </div>               
        </div>            
        <div class="form-group" style="clear: both;">
            <label class="col-lg-2" for="ChangelogreponseDEMANDE">Demande : </label>
            <div  class="col-lg-9">
                <div class="well well-sm" style="background-color: #FFFFFF;">
                <?php
                        echo $changelogdemande['Changelogdemande']['DEMANDE'];
                ?>  
                </div>
            </div>
        </div>
	<?php
                echo $this->Form->input('changelogdemande_id',array('type'=>'hidden','value'=>$this->params->pass[0]));
		echo $this->Form->input('utilisateur_id',array('type'=>'hidden','value'=>  userAuth('id')));
	?>

        <div class="changelogreponses form">
            <div class="form-group">
            <label class="col-lg-2" for="ChangelogreponseREPONSE">Réponse : </label>
            </div>
                <?php
                        echo $this->Form->input('REPONSE');
                ?>
        </div>        
    <div style="clear:both;margin-top: 10px;">
    <div class="form-group">
      <div class="btn-block-horizontal">
            <?php echo $this->Form->button('Annuler', array('type'=>'submit','class' => 'btn btn-sm btn-default showoverlay cancel','value'=>'cancel','div' => false, 'name' => 'cancel')); ?>&nbsp;<?php echo $this->Form->button('Enregistrer', array('class' => 'btn btn-sm btn-primary','type'=>'submit')); ?>                
      </div>
    </div>  
    </div>   
<?php echo $this->Form->end(); ?>
    </div>
    <?php if(!isset($reponses)): ?>
    <h6>Voici les réponses apportées à cette demande :</h6>
    <?php echo $this->element('tablereponses'); ?>   
    <?php endif; ?>    
</div>
<script>
$(document).ready(function () {
    $(document).on('change','#ChangelogreponseVersionId',function(e){
        var id = $(this).val();
        console.log(id);
        $.ajax({
            type: "POST",       
            url: "<?php echo $this->Html->url(array('controller'=>'changelogversions','action'=>'json_get_info')); ?>/" + id,
            contentType: "application/json",
            success : function(response) {
                var json = $.parseJSON(response);
                $('#ChangelogreponseDATEPREVUE').val(json['Changelogversion']['DATEPREVUE']);
                $('#ChangelogreponseDATEPREVUE').datepicker("setDate", json['Changelogversion']['DATEPREVUE'] );
            },
            error :function(response,status,errorThrown) {
                alert("Erreur! il se peut que votre session soit expirée\n\rActualiser la page et recommencer.");
            }
         });
    });   
});
</script>



