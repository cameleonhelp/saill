<?php echo $this->Form->create('Tjmagent',array('id'=>'formValidate','class'=>'form-horizontal','inputDefaults' => array('label'=>false,'div' => false))); ?>
    <div class="control-group">
        <label class="control-label sstitre  required" for="TjmagentNOM">Nomt du TJM agent : </label>
        <div class="controls">
            <?php echo $this->Form->input('NOM',array('data-rule-required'=>'true','placeholder'=>'Nom du TJM agent','class'=>'span8','data-msg-required'=>"Le nom du TJM agent est obligatoire",'error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label sstitre" for="TjmagentTARIFHT">Tarif HT : </label>
        <div class="controls">
            <?php echo $this->Form->input('TARIFHT',array('type'=>'text','placeholder'=>'Tarif HT journalier','class'=>'span4','error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?> €/j
        </div>
    </div>
    <div class="control-group">
        <label class="control-label sstitre" for="TjmagentTARIFTTC">Tarif TTC : </label>
        <div class="controls">
            <?php echo $this->Form->input('TARIFTTC',array('type'=>'text','placeholder'=>'Tarif TTC journalier','class'=>'span4','error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?> €/j
        </div>
    </div>
<div class="alert alert-info"><h5>Aide au calcul du Tarif TTC : </h5><div class='text-center'>((<input type='text' placeholder='Tarif HT' class='span3 text-right' id='prixht' name='prixht'/> + <input placeholder='Frais locaux' type='text' class='span3 text-right' id='locaux' name='locaux' value='70'/> )*<input type='text'  placeholder='Frais DSI-T' class='span3 text-right' id='fraisdsit' name='fraisdsit' value='1.05'/>)*<input  placeholder='Frais division' type='text' class='span3 text-right' id='fraisdiv' name='fraisdiv' value='1.08'/> = <input type='text' class='span3 text-right' disabled id='total' name='total'  placeholder='Total TTC'/>&nbsp;<button class='btn btn-success' id='calculer' name='calculer'>Calculer</button></div></div>
    <div class="control-group">
        <label class="control-label sstitre" for="TjmagentANNEE">Année d'application : </label>
        <div class="controls">
            <?php echo $this->Form->input('ANNEE',array('type'=>'text','placeholder'=>'Année d\'application','class'=>'span4','error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
        </div>
    </div>
    <div class="navbar">
        <div class="navbar-inner">
            <div class="container" style="margin-top:2px;text-align:center;">
                <?php echo $this->Form->button('Annuler', array('type'=>'button','class' => 'btn','onclick'=>"location.href='".$this->Html->url('/tjmagents/index')."'")); ?>&nbsp;<?php echo $this->Form->button('Enregistrer', array('class' => 'btn btn-primary','type'=>'submit')); ?>                
            </div>
        </div>
    </div>
<?php if ($this->params->action == 'edit') echo $this->Form->input('id',array('type'=>'hidden')); ?>    
<?php echo $this->Form->end(); ?>