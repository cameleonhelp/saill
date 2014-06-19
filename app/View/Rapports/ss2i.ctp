<div class="">
<div class="ss2i form">
<?php echo $this->Form->create('Rapport',array('id'=>'formValidate','class'=>'form-horizontal','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?>
    <div class='block-panel block-panel-50-left'>
        <div class="form-group">
            <label class="col-md-4 required"  for="RapportSociete">Sociétés : </label>
            <div class="col-md-offset-4">
                    <?php echo $this->Form->select('societe',$societes,array('data-rule-required'=>'true','multiple'=>'true','class'=>"form-control multiselect size75",'size'=>"10",'data-msg-required'=>"La société est obligatoire",'hiddenField' => false)); ?>                 
            </div>
        </div>         
    </div>
    <div class='block-panel block-panel-50-right'>
        <div class="form-group">
            <label class="col-md-4 required" for="RapportMois">Mois :</label>
            <div class="col-md-4">
                    <?php echo $this->Form->select('mois',$mois,array('default'=>date('m'),'class'=>"form-control",'empty'=>false)); ?>           
            </div>            
        </div>
        <div class="form-group">
            <label class="col-md-4 required" for="RapportAnnee">Année : </label>
            <div class="col-md-4">
                    <?php echo $this->Form->select('annee',$annee,array('default'=>date('Y'),'class'=>"form-control",'empty'=>false)); ?>           
            </div>            
        </div>
        <div class="form-group">
            <label class="col-md-4 required" for="RapportIndisponibilite">Indisponibilité : </label>
            <div class="col-md-4">
                    <?php echo $this->Form->input('indisponibilite',array('type'=>'checkbox','class'=>'yesno','value'=>1)); ?>&nbsp;<label class="labelAfter" for="RapportIndisponibilite"></label>         
            </div>            
        </div>        
    </div>
    <div style="clear:both;">
    <div class="form-group">
      <div class="btn-block-horizontal">
            <?php echo $this->Form->button('Calculer le rapport', array('class' => 'btn btn-sm btn-primary','type'=>'submit')); ?>   
      </div>
    </div>  
    </div>  
</div>
<?php echo $this->Form->end(); ?>
<?php if (isset($results) && count($results)>0): ?>
<div class="pull-right"><?php echo $this->Html->link('<span class="ico-xls" style="vertical-align: baseline;"></span> Export XLS',array('action'=>'xls_ss2i'), array('type'=>'button','class' => 'btn btn-sm btn-default','escape' => false)); ?></div>
<div style="font-family:'Lucida Grande', 'Lucida Sans Unicode', Verdana, Arial, Helvetica, sans-serif;font-size:16px;color:#274b6d;fill:#274b6d;text-align: center;" text-anchor="middle" class="highcharts-title" zIndex="4">Facturation estimée par société</div><br>
<table cellpadding="0" cellspacing="0" class="table table-bordered tablemax">
    <thead>
        <tr>
        <th>Société</th>
        <th>Agents</th>
        <th>Projet CDC</th>
        <th>Libelle CDC</th>
        <th>Activité CDC</th>        
        <th>Jours</th>
        <th>frais (€)</th>
        <th>Code projet</th>
        <th>Projet</th>
        <th>Code activité</th>
        <th>Activité</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($results as $result): ?>
        <?php $mois = $result[0]['MONTH'] < 10 ? '0'.$result[0]['MONTH'] : $result[0]['MONTH']; ?>
        <?php 
                $nbaction = $result[0]['NB'];
                foreach($entrops as $item):
                    if($result['Activite']['projet_id']==$item['projet_id'] && $result['Activite']['id']==$item['activite_id'] && $result['Utilisateur']['id']==$item['utilisateur_id']):
                        $nbaction -= $item['sum'];
                        $nbaction = number_format($nbaction, 1);
                    endif;
                endforeach;
            ?>   
        <?php if($nbaction != '0.0' && ($result[0]['FRAIS']!='' || $result[0]['FRAIS']!='0.0')): ?>        
        <tr>
            <td><?php echo $result['Utilisateur']['societe_NOM']; ?></td>
            <td><?php echo $result['Utilisateur']['NOM'].' '.$result['Utilisateur']['PRENOM']; ?></td>
            <td><?php echo $result['Facturation']['cdc_CODEPROJET']; ?></td>
            <td><?php echo $result['Facturation']['cdc_NOM']; ?></td>
            <td><?php echo $result['Facturation']['cdc_CODEACTIVITE']; ?></td>            
            <td class="nb" style="text-align:right;"><?php echo $nbaction; ?></td>
            <td class="frais" style="text-align:right;"><?php echo $result[0]['FRAIS']; ?></td>
            <td><?php echo $result['Facturation']['projet_GALILEI']; ?></td>
            <td><?php echo $result['Facturation']['projet_NOM']; ?></td>
            <td><?php echo $result['Activite']['NUMEROGALLILIE']; ?></td>
            <td><?php echo $result['Activite']['NOM']; ?></td>
        </tr>           
        <?php endif; ?>
        <?php endforeach; ?>
    </tbody>  
    <tfoot>
    <tr>
        <td colspan="5" class="footer" style="text-align:right;">Total :</td>
        <td class="footer" id="total" style="text-align:center;" nowrap></td>
        <td class="footer" id="totalfrais" style="text-align:center;" nowrap></td>
        <td class="footer" colspan="4" style="text-align:left;">&nbsp;</td>
    </tr> 
    </tfoot>    
</table>
<?php elseif (isset($results) && count($results)==0) : ?>
<div class="bs-callout bs-callout-warning"><b>Aucun résultat pour ce rapport, modifier les paramètres de recherche ...</b></div>
<?php endif; ?>
</div>
<?php //debug($entrops); ?>
<?php //debug($results); ?>
<script>
$(document).ready(function (){ 
   $("table").tablesorter({
        headers: {
            5:{filter:false}
        },
        widthFixed : true,
        widgets: ["zebra","filter"],
        widgetOptions : {
            filter_columnFilters : true,
            filter_hideFilters : true,
            filter_ignoreCase : true,
            filter_liveSearch : true,
            filter_saveFilters : true,
            filter_useParsedData : true,
            filter_startsWith : false,
            zebra : [ "normal-row", "alt-row" ]
        }
    }).bind('filterEnd',function(e,t){
        $("#total").html(newSumOfColumns('tr:not(.filtered) > td.nb','j'));
        $("#totalfrais").html(newSumOfColumns('tr:not(.filtered) > td.frais','€'));
    });
    
    $("#total").html(sumOfColumns('.nb','j'));
    $("#totalfrais").html(sumOfColumns('.frais','€'));
});
</script>