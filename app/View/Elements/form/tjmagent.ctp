<div class="">
<?php echo $this->Form->create('Tjmagent',array('id'=>'formValidate','class'=>'form-horizontal','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?>
    <div class="form-group">
        <label class="col-md-2 required" for="TjmagentNOM">Nomt du TJM agent : </label>
        <div class="col-md-5">
            <?php echo $this->Form->input('NOM',array('class'=>'form-control','data-rule-required'=>'true','placeholder'=>'Nom du TJM agent','data-msg-required'=>"Le nom du TJM agent est obligatoire",'error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2" for="TjmagentTARIFHT">Tarif HT : </label>
        <div class='row'>
        <div class="col-md-2">
            <?php echo $this->Form->input('TARIFHT',array('class'=>'form-control','type'=>'text','placeholder'=>'Tarif HT journalier','error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
        </div>
        <div> €/j</div>
        </div>    
    </div>
    <div class="form-group">
        <label class="col-md-2" for="TjmagentTARIFTTC">Tarif TTC : </label>
        <div class='row'>        
        <div class="col-md-2">
            <?php echo $this->Form->input('TARIFTTC',array('class'=>'form-control','type'=>'text','placeholder'=>'Tarif TTC journalier','error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
        </div>
        <div> €/j</div>
        </div>
    </div>
<div class="bs-callout bs-callout-info"><h5>Aide au calcul du Tarif TTC : </h5><div class='text-center'>((<input type='text' placeholder='Tarif HT' class='span3 text-right' id='prixht' name='prixht'/> + <input placeholder='Frais locaux' type='text' class='span3 text-right' id='locaux' name='locaux' value='70'/> )*<input type='text'  placeholder='Frais DSI-T' class='span3 text-right' id='fraisdsit' name='fraisdsit' value='1.05'/>)*<input  placeholder='Frais division' type='text' class='span3 text-right' id='fraisdiv' name='fraisdiv' value='1.08'/> = <input type='text' class='span3 text-right' disabled id='total' name='total'  placeholder='Total TTC'/>&nbsp;<button class='btn btn-sm btn-success' id='calculer' name='calculer'>Calculer</button></div></div>
    <div class="form-group">
        <label class="col-md-2" for="TjmagentANNEE">Année d'application : </label>
        <div class="col-md-2">
            <?php echo $this->Form->input('ANNEE',array('class'=>'form-control year-only','type'=>'text','placeholder'=>'Année d\'application','error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
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
</div>