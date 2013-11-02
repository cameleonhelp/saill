<div class="marginright20">
<div class="actions form">
<?php echo $this->Form->create('Plancharge',array('id'=>'formValidate','class'=>'form-horizontal','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?>
    <div class='block-panel block-panel-50-left'>
        <div class="form-group">
            <label class="col-lg-4 required" for="PlanchargeId">Plan de charge: </label>
            <div class="col-lg-offset-4">
                    <?php echo $this->Form->select('id',$plancharges,array('data-rule-required'=>'true','multiple'=>'true','class'=>"form-control multiselect size75",'size'=>"10",'data-msg-required'=>"Le nom du plan de charge est obligatoire",'hiddenField' => false)); ?>               
                <br><?php echo $this->Form->input('SelectAll',array('type'=>'checkbox')); ?><label class="labelAfter" for="PlanchargeSelectAll">&nbsp;Tout sélectionner</label>  
            </div>
        </div>         
    </div>
    <div class='block-panel block-panel-50-right'>
        <div class="form-group">
            <label class="col-lg-4 required" for="PlanchargeDomaineId">Domaine : </label>
            <div class="col-lg-offset-4">
                    <?php echo $this->Form->select('domaine_id',$domaines,array('data-rule-required'=>'true','multiple'=>'true','size'=>"10",'class'=>"form-control multiselect size75",'data-msg-required'=>"Le domaine est obligatoire")); ?>               
                <br><?php echo $this->Form->input('SelectAllDomaine',array('type'=>'checkbox')); ?><label class="labelAfter" for="PlanchargeSelectAllDomaine">&nbsp;Tout sélectionner</label>            
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
<?php echo $this->Form->end(); ?>     
</div>
<?php $israpport = isset($rapportresults) ? count($rapportresults) : 0; ?>
<?php $style = $israpport==0 ? 'style="display:none;"' : ''; ?>
<div id="rapport" <?php echo $style; ?>>
    <div class="pull-right"><?php echo $this->Html->link('<span class="ico-doc" style="vertical-align: bottom;"></span> Enregistrer',array('action'=>'export_doc'), array('type'=>'button','class' => 'btn btn-sm btn-default','escape' => false)); ?></div>
<div id="chartcontainer" style="width:80%; height:500px; margin-left: 10%;"></div>
<br><br>
    <div style="font-family:'Lucida Grande', 'Lucida Sans Unicode', Verdana, Arial, Helvetica, sans-serif;font-size:16px;color:#274b6d;fill:#274b6d;text-align: center;" text-anchor="middle" class="highcharts-title" zIndex="4">Répartition des plans de charge par domaines</div><br>
    <table cellpadding="0" cellspacing="0" class="table table-bordered tablemax">
        <thead>
            <tr>
            <th>Année</th>
            <th>Domaine</th>
            <th width="50px">ETP</th>
            <th width="50px">Charge prévue</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($rapportresults as $result): ?>
            <tr>
                <td><?php echo $result['Plancharge']['ANNEE']; ?></td>
                <td><?php echo $result['Domaine']['NOM']; ?></td>
                <td style="text-align:center" class="nbetp1"><?php echo $result[0]['ETP']; ?></td>
                <td style="text-align:center" class="nbcharge1"><?php echo $result[0]['TOTAL']; ?></td> 
            </tr>           
            <?php endforeach; ?>
        </tbody>
        <tfooter>
	<tr>
            <td colspan="2" class="footer" style="text-align:right;">Total :</td>
            <td class="footer" id="totaletp1" style="text-align:center;"></td>
            <td class="footer" id="totalcharges1" style="text-align:center;"></td>
	</tr> 
        </tfooter>
    </table>
<br>
    <div style="font-family:'Lucida Grande', 'Lucida Sans Unicode', Verdana, Arial, Helvetica, sans-serif;font-size:16px;color:#274b6d;fill:#274b6d;text-align: center;" text-anchor="middle" class="highcharts-title" zIndex="4">Détail de la répartition des plans de charge</div><br>
    <table cellpadding="0" cellspacing="0" class="table table-bordered tablemax">
        <thead>
            <tr>
            <th>Année</th>
            <th>Domaine</th>
            <th>Projet/Activité</th>
            <th width="50px">ETP</th>
            <th width="50px">Charge prévue</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($detailrapportresults as $result): ?>
            <tr>
                <td><?php echo $result['Plancharge']['ANNEE']; ?></td>
                <td><?php echo $result['Domaine']['NOM']; ?></td>
                <td><?php echo $result['Detailplancharge']['projet_NOM'].' - '.$result['Activite']['NOM']; ?></td>
                <td style="text-align:center" class="nbetp"><?php echo $result[0]['ETP']; ?></td>
                <td style="text-align:center" class="nbcharge"><?php echo $result[0]['TOTAL']; ?></td> 
            </tr>           
            <?php endforeach; ?>
        </tbody>
        <tfooter>
	<tr>
            <td colspan="3" class="footer" style="text-align:right;">Total :</td>
            <td class="footer" id="totaletp" style="text-align:center;"></td>
            <td class="footer" id="totalcharges" style="text-align:center;"></td>
	</tr> 
        </tfooter>
    </table>
</div>
<?php if(isset($rapportresults) && $israpport==0) : ?>
<div class="bs-callout bs-callout-warning"><b>Aucun résultat pour ce rapport, modifier les paramètres de recherche ...</b></div>
<?php endif; ?>
</div>
<script>
$(document).ready(function (){ 

   $(document).on('click','#PlanchargeSelectAll',function() {
        if($(this).is(':checked')){
            $('#PlanchargeId option').prop('selected', 'selected');
        } else {
            $('#PlanchargeId option').prop('selected', '');
        }
   });   
    
   $(document).on('click','#PlanchargeId',function() {
            $('#PlanchargeSelectAll').prop('checked', false);
    }); 
    
   $(document).on('click','#PlanchargeSelectAllDomaine',function() {
        if($(this).is(':checked')){
            $('#PlanchargeDomaineId option').prop('selected', 'selected');
        } else {
            $('#PlanchargeDomaineId option').prop('selected', '');
        }
    });   
    
   $(document).on('click','#PlanchargeDomaineId',function() {
            $('#PlanchargeSelectAllDomaine').prop('checked', false);
    });
    
    function sumOfColumns(id) {
        var tot = 0;
        $("."+id).each(function() {
          tot += parseFloat($(this).html());
        });
        return parseFloat(tot).toFixed(2);
     }    
    
    $("#totaletp").html(sumOfColumns('nbetp'));
    $("#totalcharges").html(sumOfColumns('nbcharge'));
    $("#totaletp1").html(sumOfColumns('nbetp1'));
    $("#totalcharges1").html(sumOfColumns('nbcharge1'));    
      
<?php if(isset($chartetpresults) && isset($chartchargeresults)): ?>
    <?php foreach($chartetpresults as $result): 
       $dataetp[] = "[".$result[0]['ETP']."]";
    $categories[] = "['".$result['Domaine']['NOM']."-".$result['Plancharge']['ANNEE']."']";
    endforeach; ?>
    <?php foreach($chartchargeresults as $result): 
       $datacharge[] = "[".$result[0]['TOTAL']."]";
    endforeach; ?>
    
    
    $('#chartcontainer').highcharts({
        chart: {
            type: 'column', 
        },      
        colors: ['#A1006B','#E05206','#CCDC00','#009AA6','#CB0044','#FFB612','#7ABB00','#00BBCE','#6E267B'],        
        credits: {
            enabled: false,
        },
        tooltip: {
            formatter: function() {
                return this.series['name'] +' : <b>' + this.y + '</b> sur <b>' + this.x + '</b>';
            }
        },
        title: {
            text: 'Nombre d\'etp et de charge par domaines'
        },
        xAxis: {
            name :'Domaines',         
            categories : [<?php echo join($categories, ',') ?>]   ,  
            tickInterval: 1,
            labels: {
                rotation: -45,
                align: 'right',
                style: {
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }
        },
        yAxis: [{
            title: {
                text: 'etp'
            }},{
            title: {
                 text: 'Charges'
            },
            opposite: true                    
        }],         
        series: [
            {
            name: 'etp',
            data: [<?php echo join($dataetp, ',') ?>],
            yAxis:0
            },
            {
            name: 'Charges',
            data: [<?php echo join($datacharge, ',') ?>],
            yAxis:1
            }              
        ],
        plotOptions: {
            column: {
                dataLabels: {
                    enabled: true
                }
            }
        }
    });
    <?php endif; ?>
});
</script>