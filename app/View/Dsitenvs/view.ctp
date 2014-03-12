<div class="dsitenvs view">
<div class="">
<?php echo $this->Form->create('Dsitenv',array('id'=>'formValidate','class'=>'form-horizontal','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?>
    <div class="form-group">
        <label class="col-md-2 required" for="DsitenvNOM">Nom : </label>
        <div class="col-md-10">
            <?php echo $dsitenv['Dsitenv']['NOM']; ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 required" for="DsitenvApplicationId">Application: </label>
        <div  class="col-md-6">
            <?php echo $dsitenv['Application']['NOM']; ?>
        </div>
    </div> 
    <div style="clear:both;margin-top: 10px;">
    <div class="form-group">
      <div class="btn-block-horizontal">
            <?php echo $this->Form->button('Annuler', array('type'=>'submit','class' => 'btn btn-sm btn-default showoverlay cancel','value'=>'cancel','div' => false, 'name' => 'cancel')); ?>                
      </div>
    </div>  
    </div>      
<?php echo $this->Form->end(); ?> 
    <div class="panel">
      <div class="panel-heading">
        <h3 class="panel-title">
          <a class="accordion-toggle" data-toggle="collapse" data-parent="#panel_apps" href="#panel_bien">
            Biens
          </a>
        </h3>
      </div>
      <div id="panel_bien" class="panel-collapse collapse in">
        <div class="panel-body">
          <?php echo $this->element('tableViewBiens'); ?>
        </div>
      </div>
    </div>      
</div>
</div>
