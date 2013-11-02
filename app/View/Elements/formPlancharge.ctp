<div class="marginright20">
<?php if ($this->params->action == 'edit'): ?>
<div class="bs-callout bs-callout-info">Vous allez créer une nouvelle version de ce plan de charge, cela va recopier également la liste des personnes de ce plan de charge.</div>
<?php endif; ?>
<?php echo $this->Form->create('Plancharge',array('id'=>'formValidate','class'=>'form-horizontal','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?>
    <div class="form-group">
    <label class="col-lg-2 required" for="PlanchargeANNEE">Année : </label>
    <div class="col-lg-2">
        <select name="data[Plancharge][ANNEE]" class='form-control' data-rule-required="true" data-msg-required="L'année est obligatoire" id="PlanchargeANNEE">
            <option value="">Choisir une année</option>
            <?php $annee = new DateTime(); $annee = $annee->format('Y'); ?>
            <?php for ($i=-0; $i<6; $i++): ?>
            <?php $newannee = $annee+$i; ?>
            <?php 
            if ($this->params->action == 'edit') :
                $selected = ($newannee == $this->request->data['Plancharge']['ANNEE']) ? "selected='selected'" : "";
            else:
                $selected = "";
            endif;
            ?>
            <option value="<?php echo $newannee; ?>" <?php echo $selected; ?>><?php echo $newannee; ?></option>
            <?php endfor; ?>
        </select>
    </div>
    </div>
    <div class="form-group">
    <label class="col-lg-2 required" for="PlanchargeContratId">Contrat : </label>
    <div class="col-lg-3">
            <?php if ($this->params->action == 'add'): ?>
            <?php echo $this->Form->select('contrat_id',$contrats,array('class'=>'form-control','data-rule-required'=>'true','data-msg-required'=>"Le nom du contrat est obligatoire", 'empty' => 'Choisir un contrat')); ?>                     
            <?php else : ?>
            <?php echo $this->request->data['Contrat']['NOM']; ?><?php echo $this->Form->input('contrat_id',array('type'=>'hidden')); ?><?php echo $this->Form->input('contrat_nom',array('type'=>'hidden','id'=>'PlanchargeContratNOM','value'=>$this->request->data['Contrat']['NOM'])); ?>
            <?php endif; ?>
    </div>
    </div>
    <div class="form-group">
        <label class="col-lg-2 required" for="PlanchargeNOM">Nom : </label>
    <div class="col-lg-4">
                <?php echo $this->Form->input('NOM',array('class'=>'form-control','type'=>'text','placeholder'=>'Nom du plan de charge','data-rule-required'=>'true','data-msg-required'=>"Le nom du projet est obligatoire")); ?>          
    </div>
    </div>
    <div class="form-group">
        <label class="col-lg-2 required" for="PlanchargeTJM">TJM : </label></td>
    <div class="col-lg-2">
                <?php echo $this->Form->input('TJM',array('class'=>'form-control','type'=>'text','style'=>"width:45px;",'class'=>'text-right','placeholder'=>'TJM','data-rule-required'=>'true','data-msg-required'=>"Le TJM est obligatoire")); ?> €/j               
    </div>
    </div>
    <?php $valVersion = $this->params->action == 'edit' ? $this->request->data['Plancharge']['VERSION']+ 1 : '0'; ?>
    <?php echo $this->Form->input('VERSION',array('type'=>'hidden','value'=>$valVersion)); ?>
    <div style="clear:both;margin-top: 10px;">
    <div class="form-group">
      <div class="btn-block-horizontal">
            <?php echo $this->Form->button('Annuler', array('type'=>'submit','class' => 'btn btn-sm btn-default showoverlay cancel','value'=>'cancel','div' => false, 'name' => 'cancel')); ?>&nbsp;<?php echo $this->Form->button('Enregistrer', array('class' => 'btn btn-sm btn-primary','type'=>'submit')); ?>                
      </div>
    </div>  
    </div>
<?php echo $this->Form->end(); ?> 
</div>
<script>
    $(document).ready(function () {
        $(document).on('change','#PlanchargeANNEE',function(e){
            e.preventDefault;
            <?php if ($this->params->action == "add") : ?>
            $('#PlanchargeNOM').val($('#PlanchargeANNEE').val()+"-"+$('#PlanchargeContratId option:selected').text());
            <?php else : ?>
            $('#PlanchargeNOM').val($('#PlanchargeANNEE').val()+"-"+$('#PlanchargeContratNOM').val());
            <?php endif; ?>
        });   
        $(document).on('change','#PlanchargeContratId',function(e){
            e.preventDefault;
            $('#PlanchargeNOM').val($('#PlanchargeANNEE').val()+"-"+$('#PlanchargeContratId option:selected').text());
        });          
    });
</script>