<div class="">
<div class="ss2i form">
<?php echo $this->Form->create('Rapport',array('id'=>'formValidate','class'=>'form-horizontal','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?>
    <div class='block-panel block-panel-50-left'>
        <div class="form-group">
            <label class="col-md-4 required" for="RapportDU">Du :</label>
            <div class="col-md-6">
              <div class="input-group">
              <?php $today = new dateTime(); ?>
              <?php echo $this->Form->input('DU',array('type'=>'text','placeholder'=>'ex.: '.$today->format('d/m/Y'),'data-rule-required'=>'true','class'=>"form-control dateall",'data-msg-required'=>"La date de début de période est obligatoire",'error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
              <span class="input-group-addon addon-middle date-addon-clean btn-addon" data-target="#RapportDU"><span class="glyphicons circle_remove grey"></span></span>
              <span class="input-group-addon addon-middle date-addon-default btn-addon" data-target="#RapportDU" data-default="<?php echo date('01/m/Y'); ?>"><span class="glyphicons clock"></span></span>
              <span class="input-group-addon date-addon-calendar btn-addon" data-target="#RapportDU"><span class="glyphicons calendar"></span></span>
              </div>          
            </div>            
        </div>
        <div class="form-group">
            <label class="col-md-4 required" for="RapportAU">Au : </label>
            <div class="col-md-6">
              <div class="input-group">
              <?php $today = new dateTime(); ?>
              <?php echo $this->Form->input('AU',array('type'=>'text','placeholder'=>'ex.: '.$today->format('t/m/Y'),'data-rule-required'=>'true','class'=>"form-control dateall",'data-msg-required'=>"La date de fin de période est obligatoire",'error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
              <span class="input-group-addon addon-middle date-addon-clean btn-addon" data-target="#RapportAU"><span class="glyphicons circle_remove grey"></span></span>
              <span class="input-group-addon addon-middle date-addon-default btn-addon" data-target="#RapportAU" data-default="<?php echo date('t/m/Y'); ?>"><span class="glyphicons clock"></span></span>
              <span class="input-group-addon date-addon-calendar btn-addon" data-target="#RapportAU"><span class="glyphicons calendar"></span></span>
              </div>
            </div>             
        </div>
        <div class="form-group">
            <label class="col-md-4 required" for="RapportIndisponibilite">Indisponibilité : </label>
            <div class="col-md-4">
                    <?php $checked = isset($this->data['Rapport']['indisponibilite']) ? $this->data['Rapport']['indisponibilite'] : 'checked'; ?>
                    <?php echo $this->Form->input('indisponibilite',array('type'=>'checkbox','class'=>'yesno','value'=>1,'checked'=>$checked)); ?>&nbsp;<label class="labelAfter" for="RapportIndisponibilite"></label>         
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
<div class="pull-right"><?php echo $this->Html->link('<span class="ico-xls" style="vertical-align: baseline;"></span> Export XLS',array('action'=>'xls_sncf'), array('type'=>'button','class' => 'btn btn-sm btn-default','escape' => false)); ?></div>
<div style="font-family:'Lucida Grande', 'Lucida Sans Unicode', Verdana, Arial, Helvetica, sans-serif;font-size:16px;color:#274b6d;fill:#274b6d;text-align: center;" text-anchor="middle" class="highcharts-title" zIndex="4">Facturation estimée des agents SNCF</div><br>
<table cellpadding="0" cellspacing="0" class="table table-bordered tablemax">
    <thead>
        <tr>
        <th>Société</th>
        <th>Identifiant</th>
        <th>Agents</th>
        <th>Projet CDC</th>
        <th>Libelle CDC</th>
        <th>Activité CDC</th>
        <th>Jours</th>
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
        <?php if($nbaction != '0.0'): ?>
        <tr>
            <td><?php echo $result['Utilisateur']['societe_NOM']; ?></td>
            <td><?php echo $result['Utilisateur']['username']; ?></td>
            <td><?php echo $result['Utilisateur']['NOM'].' '.$result['Utilisateur']['PRENOM']; ?></td>
            <td><?php echo $result['Facturation']['cdc_CODEPROJET']; ?></td>
            <td><?php echo $result['Facturation']['cdc_NOM']; ?></td>
            <td><?php echo $result['Facturation']['cdc_CODEACTIVITE']; ?></td>
            <td class="nb" style="text-align:right;"><?php echo $nbaction; ?></td>
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
        <td colspan="6" class="footer" style="text-align:right;">Total :</td>
        <td class="footer" id="total" style="text-align:center;" nowrap></td>
        <td class="footer" colspan="4" style="text-align:left;">&nbsp;</td>
    </tr> 
    </tfoot>    
</table>
<?php else : ?>
<div class="bs-callout bs-callout-warning"><b>Aucun résultat pour ce rapport, modifier les paramètres de recherche ...</b></div>
<?php endif; ?>
</div>
<script>
$(document).ready(function (){ 
   $("table").tablesorter({
        headers: {
            6:{filter:false}
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
            
    function newSumOfColumns(id,symbole) {
        var tot = 0;
        $(id).each(function() {
          value = $(this).html()=='' ? 0: $(this).html();
          tot += parseFloat(value);
        });
        return parseFloat(tot).toFixed(2)+" "+symbole;
     };    
    function sumOfColumns(id,type) {
        var tot = 0;
        $("."+id).each(function() {
          tot += parseFloat($(this).html());
        });
        tot = isNaN(tot) ? 0 : tot;
        return tot.toFixed(2)+" "+type;
     }   
    
    $("#total").html(sumOfColumns('nb','j'));
    $("#totalfrais").html(sumOfColumns('frais','€'));
});
</script>