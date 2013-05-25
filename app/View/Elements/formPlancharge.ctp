<?php if ($this->params->action == 'edit'): ?>
<div class="alert alert-info">Vous allez créer une nouvelle version de ce plan de charge, cela va recopier également la liste des personnes de ce plan de charge.</div>
<?php endif; ?>
<?php echo $this->Form->create('Plancharge',array('id'=>'formValidate','class'=>'form-horizontal','inputDefaults' => array('label'=>false,'div' => false))); ?>
<table>
    <tr>
        <td><label class="control-label sstitre required" for="PlanchargeANNEE">Année : </label></td>
        <td>
            <select name="data[Plancharge][ANNEE]" data-rule-required="true" data-msg-required="L'année est obligatoire" id="PlanchargeANNEE">
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
        </td> 
        <td><label class="control-label sstitre required" for="PlanchargeContratId">Contrat : </label></td>
        <td>
            <?php if ($this->params->action == 'add'): ?>
            <?php echo $this->Form->select('contrat_id',$contrats,array('data-rule-required'=>'true','data-msg-required'=>"Le nom du contrat est obligatoire", 'empty' => 'Choisir un contrat')); ?>                     
            <?php else : ?>
            <?php echo $this->request->data['Contrat']['NOM']; ?><?php echo $this->Form->input('contrat_id',array('type'=>'hidden')); ?><?php echo $this->Form->input('contrat_nom',array('type'=>'hidden','id'=>'PlanchargeContratNOM','value'=>$this->request->data['Contrat']['NOM'])); ?>
            <?php endif; ?>
        </td>
       
    </tr>
    <tr>
        <td><label class="control-label sstitre required" for="PlanchargeNOM">Nom : </label></td>
        <td>
                <?php echo $this->Form->input('NOM',array('type'=>'text','class'=>'span10','placeholder'=>'Nom du plan de charge','data-rule-required'=>'true','data-msg-required'=>"Le nom du projet est obligatoire")); ?>          
        </td>
        <td><label class="control-label sstitre required" for="PlanchargeTJM">TJM : </label></td>
        <td>
                <?php echo $this->Form->input('TJM',array('type'=>'text','class'=>'text-right span3','placeholder'=>'TJM','data-rule-required'=>'true','data-msg-required'=>"Le TJM est obligatoire")); ?> €/j               
        </td>        
    </tr>
    <?php $valVersion = $this->params->action == 'edit' ? $this->request->data['Plancharge']['VERSION']+ 1 : '0'; ?>
    <?php echo $this->Form->input('VERSION',array('type'=>'hidden','value'=>$valVersion)); ?>
</table>
    <div class="navbar">
        <div class="navbar-inner">
            <div class="container" style="margin-top:2px;text-align:center;">
                <?php echo $this->Form->button('Annuler', array('type'=>'button','class' => 'btn','onclick'=>"location.href='".goPrev()."'")); ?>&nbsp;<?php echo $this->Form->button('Continuer', array('class' => 'btn btn-primary','type'=>'submit')); ?>
            </div>
        </div>
    </div>  
<?php echo $this->Form->end(); ?>  
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