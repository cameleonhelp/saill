<div class="dashboards form">
<?php echo $this->Form->create('Dashboard',array('id'=>'formValidate','class'=>'form-horizontal','inputDefaults' => array('label'=>false,'div' => false))); ?>
    <table>
        <tr>
            <td><label class="control-label sstitre  required" for="DashboardProjetId">Projets: </label></td>
            <td>
                    <?php echo $this->Form->select('projet_id',$listprojets,array('data-rule-required'=>'true','multiple'=>'true','size'=>"10",'data-msg-required'=>"Le nom du projet est obligatoire")); ?>               
                <br><?php echo $this->Form->input('SelectAllProjetId',array('type'=>'checkbox')); ?><label class="labelAfter" for="DashboardSelectAllProjetId">&nbsp;Tout sélectionner</label>            
            </td>
            <td><label class="control-label sstitre  required" for="DashboardPlanchargeId">Plan de charge : </label></td>
            <td>
                    <?php echo $this->Form->select('plancharge_id',$listplancharges,array('data-rule-required'=>'true','multiple'=>'true','size'=>"10",'data-msg-required'=>"Le plan de charge est obligatoire")); ?>               
                <br><?php echo $this->Form->input('SelectAllPlanchargeId',array('type'=>'checkbox')); ?><label class="labelAfter" for="DashboardSelectAllPlanchargeId">&nbsp;Tout sélectionner</label>            
            </td>            
        </tr>        
    </table>
    <div class="navbar">
        <div class="navbar-inner">
            <div class="container" style="margin-top:2px;text-align:center;">
                <?php echo $this->Form->button('Calculer le rapport', array('class' => 'btn btn-primary','type'=>'submit')); ?>   
            </div>
        </div>
    </div>  
<?php echo $this->Form->end(); ?>     
</div>
<?php $israpport = isset($results) ? count($results) : 0; ?>
<?php $style = $israpport==0 ? 'style="display:none;"' : ''; ?>
<div id="rapport" <?php echo $style; ?>>
    <div class="pull-right"><?php echo $this->Html->link('<i class="ico-doc"></i> Enregistrer',array('action'=>'export_doc'), array('type'=>'button','class' => 'btn','escape' => false)); ?></div>
<div id="chartcontainer" style="width:80%; height:500px; margin-left: 10%;"></div>
    <table id="datatable" style="display:none;">
        <thead>
            <tr>
                <th></th>
                <th>Contrat</th>
                <th>Consommé</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($results as $result): ?>
            <tr>
                <th><?php echo $result['CONTRAT']['NOM']; ?></th>
                <td><?php echo $result['CONTRAT']['CHARGE']; ?></td>                
                <td><?php echo $result['FACTURATION']['CHARGEFACTUREE']; ?></td> 
            </tr>           
            <?php endforeach; ?>
        </tbody>        
    </table>
<br>
    <div style="font-family:'Lucida Grande', 'Lucida Sans Unicode', Verdana, Arial, Helvetica, sans-serif;font-size:16px;color:#274b6d;fill:#274b6d;text-align: center;" text-anchor="middle" class="highcharts-title" zIndex="4">Indicateurs</div><br>
    <table cellpadding="0" cellspacing="0" class="table table-bordered table-striped" id="datatable">
        <thead>
            <tr>
            <th rowspan="2" style="vertical-align: middle;">Projet</th>
            <th rowspan="2" width="60px" style="vertical-align: middle;">TJM</th>
            <th colspan="2">Contrat</th>
            <th colspan="2">Facturation</th>
            <th colspan="2">% Avancement</th>
            <th rowspan="2" style="vertical-align: middle;" width="70px">Reste à faire</th>
            </tr>
            <tr>
            <th width="70px">Budget (k€)</th>
            <th width="70px">Charge (j)</th>
            <th width="70px">Budget (k€)</th>
            <th width="70px">Charge (j)</th>            
            <th width="70px">Budget</th>
            <th width="70px">Charge</th>
            </tr>            
        </thead>
        <tbody>
            <?php foreach($results as $result): ?>
            <tr>
                <td><?php echo $result['CONTRAT']['NOM']; ?></td>
                <td style="text-align: right;" class="tjm1"><?php echo $result['CONTRAT']['TJM']; ?> €/j</td>
                <td style="text-align: right;" class="contratbudget1"><?php echo $result['CONTRAT']['BUDGET']; ?></td>
                <td style="text-align: right;" class="contratcharge1"><?php echo $result['CONTRAT']['CHARGE']; ?></td>  
                <td style="text-align: right;" class="facturebudget1"><?php echo $result[0]['BUDGETFACTURE']; ?></td>
                <td style="text-align: right;" class="facturecharge1"><?php echo $result['FACTURATION']['CHARGEFACTUREE']; ?></td> 
                <td style="text-align: right;" class="avancebudget1"><?php echo $result[0]['AVANCEMENTBUDGET']; ?></td>
                <td style="text-align: right;" class="avancecharge1"><?php echo $result[0]['AVANCEMENTCHARGE']; ?></td>       
                <td style="text-align: right;" class="raf1"><?php echo $result[0]['RAF']; ?></td>   
            </tr>           
            <?php endforeach; ?>
        </tbody>
        <tfooter>
	<tr>
            <td class="footer" style="text-align:right;">Total :</td>
            <td class="footer" id="moyennetjm1" style="text-align:right;"></td>
            <td class="footer" id="totalcontratbudget1" style="text-align:right;"></td>
            <td class="footer" id="totalcontratcharge1" style="text-align:right;"></td>
            <td class="footer" id="totalfacturebudget1" style="text-align:right;"></td>
            <td class="footer" id="totalfacturecharge1" style="text-align:right;"></td>
            <td class="footer" id="moyenneavancebudget1" style="text-align:right;"></td>
            <td class="footer" id="moyenneavancecharge1" style="text-align:right;"></td>
            <td class="footer" id="totalraf1" style="text-align:right;"></td>            
	</tr> 
        </tfooter>
    </table>
    <br />
    <table cellpadding="0" cellspacing="0" class="table table-bordered table-striped" id="datatable">
        <thead>
            <tr>
            <th rowspan="2" style="vertical-align: middle;">Projet</th>
            <th rowspan="2" width="60px" style="vertical-align: middle;">TJM</th>
            <th colspan="2">Contrat</th>
            <th colspan="2">Prévision</th>
            <th colspan="2">Consommation</th>
            <th colspan="2">Facturation estimée</th>
            <th colspan="2">% Avancement</th>
            <th rowspan="2" style="vertical-align: middle;">Ecart<br><span rel="tooltip" title="Charges réelles - charges facturées"><i class="icon-question-sign"></i></span></th>
            <th colspan="2">Reste à</th>
            </tr>
            <tr>
            <th width="70px">Budget (k€)</th>
            <th width="70px">Charge (j)</th>
            <th width="70px">Budget (k€)</th>
            <th width="70px">Charge (j)</th>
            <th width="70px">Budget (k€)</th>
            <th width="70px">Charge (j)</th>
            <th width="70px">Budget (k€)</th>
            <th width="70px">Charge (j)</th>            
            <th width="70px">Budget</th>
            <th width="70px">Charge</th>
            <th width="70px">Consommer</th>            
            <th width="70px">Faire</th>
            </tr>            
        </thead>
        <tbody>
            <?php foreach($results as $result): ?>
            <tr>
                <td><?php echo $result['CONTRAT']['NOM']; ?></td>
                <td style="text-align: right;" class="tjm"><?php echo $result['CONTRAT']['TJM']; ?> €/j</td>
                <td style="text-align: right;" class="contratbudget"><?php echo $result['CONTRAT']['BUDGET']; ?></td>
                <td style="text-align: right;" class="contratcharge"><?php echo $result['CONTRAT']['CHARGE']; ?></td>
                <td style="text-align: right;" class="previsionbudget"><?php echo $result[0]['BUDGETPREVU']; ?></td>
                <td style="text-align: right;" class="previsioncharge"><?php echo $result['PREVISION']['CHARGEPREVUE']; ?></td>                
                <td style="text-align: right;" class="reelbudget"><?php echo $result[0]['BUDGETREEL']; ?></td>
                <td style="text-align: right;" class="reelcharge"><?php echo $result['CONSOMMATION']['CHARGEREELLE']; ?></td>   
                <td style="text-align: right;" class="facturebudget"><?php echo $result[0]['BUDGETFACTURE']; ?></td>
                <td style="text-align: right;" class="facturecharge"><?php echo $result['FACTURATION']['CHARGEFACTUREE']; ?></td> 
                <td style="text-align: right;" class="avancebudget"><?php echo $result[0]['AVANCEMENTBUDGET']; ?></td>
                <td style="text-align: right;" class="avancecharge"><?php echo $result[0]['AVANCEMENTCHARGE']; ?></td>     
                <td style="text-align: center;" class="ecart"><?php echo $result[0]['ECART']; ?></td>   
                <td style="text-align: right;" class="rac"><?php echo $result[0]['RAC']; ?></td>   
                <td style="text-align: right;" class="raf"><?php echo $result[0]['RAF']; ?></td>   
            </tr>           
            <?php endforeach; ?>
        </tbody>
        <tfooter>
	<tr>
            <td class="footer" style="text-align:right;">Total :</td>
            <td class="footer" id="moyennetjm" style="text-align:right;"></td>
            <td class="footer" id="totalcontratbudget" style="text-align:right;"></td>
            <td class="footer" id="totalcontratcharge" style="text-align:right;"></td>
            <td class="footer" id="totalprevisionbudget" style="text-align:right;"></td>
            <td class="footer" id="totalprevisioncharge" style="text-align:right;"></td>
            <td class="footer" id="totalreelbudget" style="text-align:right;"></td>
            <td class="footer" id="totalreelcharge" style="text-align:right;"></td>
            <td class="footer" id="totalfacturebudget" style="text-align:right;"></td>
            <td class="footer" id="totalfacturecharge" style="text-align:right;"></td>
            <td class="footer" id="moyenneavancebudget" style="text-align:right;"></td>
            <td class="footer" id="moyenneavancecharge" style="text-align:right;"></td>
            <td class="footer" id="totalecart" style="text-align:center;"></td>
            <td class="footer" id="totalrac" style="text-align:right;"></td>
            <td class="footer" id="totalraf" style="text-align:right;"></td>            
	</tr> 
        </tfooter>
    </table>
</div>
<?php if(isset($results) && $israpport==0) : ?>
<div class="alert alert-block"><b>Aucun résultat pour ce rapport, modifier les paramètres de recherche ...</b></div>
<?php endif; ?>
<script>
$(document).ready(function (){ 

   $(document).on('click','#DashboardSelectAllProjetId',function() {
        if($(this).is(':checked')){
            $('#DashboardProjetId option').prop('selected', 'selected');
        } else {
            $('#DashboardProjetId option').prop('selected', '');
        }
   });   
    
   $(document).on('click','#DashboardProjetId',function() {
            $('#DashboardSelectAllProjetId').prop('checked', false);
    }); 
    
   $(document).on('click','#DashboardSelectAllPlanchargeId',function() {
        if($(this).is(':checked')){
            $('#DashboardPlanchargeId option').prop('selected', 'selected');
        } else {
            $('#DashboardPlanchargeId option').prop('selected', '');
        }
    });   
    
   $(document).on('click','#DashboardPlanchargeId',function() {
            $('#DashboardSelectAllPlanchargeId').prop('checked', false);
    }); 
    
    function sumOfColumns(id,symbole) {
        var tot = 0;
        $("."+id).each(function() {
          value = $(this).html()=='' ? 0: $(this).html();
          tot += parseFloat(value);
        });
        return parseFloat(tot).toFixed(2)+" "+symbole;
     }  
     
    function sumOfColumnsOnly(id) {
        var tot = 0;
        $("."+id).each(function() {
          value = $(this).html()=='' ? 0: $(this).html();
          tot += parseFloat(value);
        });
        return parseFloat(tot).toFixed(2);
     }    
    
    function moyenneOfColumns(id,symbole) {
        var tot = 0;
        $i = 0;
        $("."+id).each(function() {
          tot += parseFloat($(this).html());
          $i++;
        });
        return parseFloat(tot/$i).toFixed(2)+" "+symbole;
     } 
     
    function avancementBudget(id){
        var diviser = sumOfColumnsOnly('contratbudget'+id);
        var result = diviser=='0.00' ? '0.00' : sumOfColumnsOnly('facturebudget'+id)/diviser;
        return parseFloat(result*100).toFixed(2)+" %";
    }
    
    function avancementCharge(id){
        var diviser = sumOfColumnsOnly('contratcharge'+id);
        var result = diviser=='0.00' ? '0.00' : sumOfColumnsOnly('facturecharge'+id)/diviser;
        return parseFloat(result*100).toFixed(2)+" %";        
    }    
    
    $("#moyennetjm").html(moyenneOfColumns('tjm','€/j'));
    $("#totalcontratbudget").html(sumOfColumns('contratbudget','k€'));
    $("#totalprevisionbudget").html(sumOfColumns('previsionbudget','k€'));
    $("#totalreelbudget").html(sumOfColumns('reelbudget','k€'));
    $("#totalfacturebudget").html(sumOfColumns('facturebudget','k€'));
    $("#totalcontratcharge").html(sumOfColumns('contratcharge','j'));
    $("#totalprevisioncharge").html(sumOfColumns('previsioncharge','j'));
    $("#totalreelcharge").html(sumOfColumns('reelcharge','j'));
    $("#totalfacturecharge").html(sumOfColumns('facturecharge','j'));
    $("#totalecart").html(sumOfColumns('ecart','j'));
    $("#totalrac").html(sumOfColumns('rac','j'));
    $("#totalraf").html(sumOfColumns('raf','j'));
    $("#moyenneavancebudget").html(avancementBudget(''));
    $("#moyenneavancecharge").html(avancementCharge(''));
    
    $("#moyennetjm1").html(moyenneOfColumns('tjm1','€/j'));
    $("#totalcontratbudget1").html(sumOfColumns('contratbudget1','k€'));
    $("#totalfacturebudget1").html(sumOfColumns('facturebudget1','k€'));
    $("#totalcontratcharge1").html(sumOfColumns('contratcharge1','j'));
    $("#totalfacturecharge1").html(sumOfColumns('facturecharge1','j'));
    $("#totalraf1").html(sumOfColumns('raf1','j'));
    $("#moyenneavancebudget1").html(avancementBudget('1'));
    $("#moyenneavancecharge1").html(avancementCharge('1'));
    
    $('#chartcontainer').highcharts({
        data: {
            table: document.getElementById('datatable')
        },
        colors: ['#A1006B','#E05206','#CCDC00','#009AA6','#CB0044','#FFB612','#7ABB00','#00BBCE','#6E267B'], 
        chart: {
            type: 'bar'
        },
        credits:{
            enabled:false
        },
        title: {
            text: 'Consommation'
        },
        subtitle:{
               text:'Par rapport à la charge contractuelle'
        },
        yAxis: {
            title: {
                text: 'Charges'
            }
        },
        tooltip: {
            formatter: function() {
                return '<b>'+ this.series.name +'</b><br/>'+
                    this.y +' jours sur '+ this.x;
            }
        },
        plotOptions: {
            bar: {
                dataLabels: {
                    enabled: true,
                    color: '#FFFFFF'
                }
            },
            series: {
                stacking: 'normal'
            }
        }
    });
});
</script>