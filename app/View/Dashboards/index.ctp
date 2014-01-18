<div class="marginright20">
<div class="dashboards form">
<?php echo $this->Form->create('Dashboard',array('id'=>'formValidate','class'=>'form-horizontal','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?>
    <div class="bs-callout bs-callout-info" style="margin-top:0px;">
        <div style="display: table;">
        <div style="float:left;vertical-align: middle;margin-right: 10px;">Ce rapport est calculé pour l'année en cours, vous pouvez remonté la consommation pour une autre année en saisissant l'année ci-contre.</div>&nbsp;
        <?php echo $this->Form->input('ANNEE',array('type'=>'text','class'=>'form-control size-fix-75 dateyear-year')); ?><br>
        <div style="float:left;">Le budget contractuel et les prévisions resteront ceux de l'année courante. Pour plus d'information, consultez les activités des projets et les plan de charges de l'année concernée.</div>
        </div>
    </div> 
    <div class='block-panel block-panel-50-left'>
        <div class="form-group">
            <label class="col-lg-4 required" for="DashboardProjetId">Projets: </label>
            <div class="col-lg-offset-4">
                    <?php echo $this->Form->select('projet_id',$listprojets,array('data-rule-required'=>'true','multiple'=>'true','class'=>"form-control multiselect size75",'size'=>"10",'data-msg-required'=>"Le nom du projet est obligatoire",'hiddenField' => false)); ?>               
                <br><?php echo $this->Form->input('SelectAllProjetId',array('type'=>'checkbox')); ?><label class="labelAfter" for="DashboardSelectAllProjetId">&nbsp;Tout sélectionner</label>  
            </div>
        </div>        
    </div>
    <div class='block-panel block-panel-50-right'>
        <div class="form-group">
            <label class="col-lg-4" for="DashboardPlanchargeId">Plan de charge : </label>
            <div class="col-lg-offset-4">
                    <?php echo $this->Form->select('plancharge_id',$listplancharges,array('multiple'=>'true','size'=>"10",'class'=>"form-control multiselect size75")); ?>               
                <br><?php echo $this->Form->input('SelectAllPlanchargeId',array('type'=>'checkbox')); ?><label class="labelAfter" for="DashboardSelectAllPlanchargeId">&nbsp;Tout sélectionner</label>            
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
<?php $israpport = isset($results) ? count($results) : 0; ?>
<?php $style = $israpport==0 ? 'style="display:none;"' : ''; ?>
<div id="rapport" <?php echo $style; ?>>
    <div class="pull-right"><?php echo $this->Html->link('<span class="ico-doc" style="vertical-align: bottom;"></span> Enregistrer',array('action'=>'export_doc'), array('type'=>'button','class' => 'btn btn-sm btn-default','escape' => false)); ?></div>
<div id="chartcontainer" style="width:80%; height:500px; margin-left: 10%;"></div>
    <table id="datatable" style="display:none;">
        <thead>
            <tr>
                <th></th>
                <th>Reste à faire</th>
                <th>Consommé</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($results as $result): ?>
            <tr>
                <th><?php echo $result['CONTRAT']['NOM']; ?></th>
                <td><?php echo $result[0]['RAF']; ?></td>                
                <td><?php echo $result[0]['TOTALCHARGEFACTUREE']; ?></td> 
            </tr>           
            <?php endforeach; ?>
        </tbody>        
    </table>
<br><br>
    <div style="font-family:'Lucida Grande', 'Lucida Sans Unicode', Verdana, Arial, Helvetica, sans-serif;font-size:16px;color:#274b6d;fill:#274b6d;text-align: center;" text-anchor="middle" class="highcharts-title" zIndex="4">Tableau CRA</div><br>
    <table cellpadding="0" cellspacing="0" class="table table-bordered table-striped" id="datatable" style="width:100%;">
        <thead>
            <tr>
            <th rowspan="2" style="vertical-align: middle;">Projet</th>
            <th rowspan="2" width="60px" style="vertical-align: middle;">TJM</th>
            <th colspan="2">Contrat</th>
            <th colspan="2">Facturation estimée</th>
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
                <td><?php echo $result['CONTRAT']['NOM']; ?> <?php echo ($result['ACHAT']['COUTACHAT']>0) ? '¹':''; ?></td>
                <td style="text-align: right;" class="tjm1"><?php echo $result['CONTRAT']['TJM']; ?> €/j</td>
                <td style="text-align: right;" class="contratbudget1"><?php echo $result['CONTRAT']['BUDGET']; ?></td>
                <td style="text-align: right;" class="contratcharge1"><?php echo $result['CONTRAT']['CHARGE']; ?></td>  
                <td style="text-align: right;" class="facturebudget1"><?php echo $result[0]['BUDGETFACTURE']; ?></td>
                <td style="text-align: right;" class="facturecharge1"><?php echo $result[0]['TOTALCHARGEFACTUREE']; ?></td> 
                <td style="text-align: right;" class="avancebudget1">
                    <?php $styleB1 = $result[0]['AVANCEMENTBUDGET']>100 ? 'progress-striped' : ''; ?>
                    <?php $styleB2 = styleBarreInd(h($result[0]['AVANCEMENTBUDGET'])); ?>
                    <div class="progress <?php echo $styleB1; ?>"  style="margin-bottom:-10px;">
                      <div class="progress-bar progress-bar-<?php echo $styleB2; ?>  " style="width: <?php echo h($result[0]['AVANCEMENTBUDGET']); ?>%;" rel="tooltip" title="Avancement à : <?php echo h($result[0]['AVANCEMENTBUDGET']); ?>%"><?php echo $result[0]['AVANCEMENTBUDGET'] > 0 ? $result[0]['AVANCEMENTBUDGET']."%" : ''; ?></div>
                    </div>
                </td>
                <td style="text-align: right;" class="avancecharge1">
                    <?php $styleC1 = $result[0]['AVANCEMENTCHARGE']>100 ? 'progress-striped' : ''; ?>
                    <?php $styleC2 = styleBarreInd(h($result[0]['AVANCEMENTCHARGE'])); ?>
                    <div class="progress <?php echo $styleC1; ?>"  style="margin-bottom:-10px;">
                      <div class="progress-bar progress-bar-<?php echo $styleC2; ?>  " style="width: <?php echo h($result[0]['AVANCEMENTCHARGE']); ?>%;" rel="tooltip" title="Avancement à : <?php echo h($result[0]['AVANCEMENTCHARGE']); ?>%"><?php echo $result[0]['AVANCEMENTCHARGE'] > 0 ? $result[0]['AVANCEMENTCHARGE']."%" : ''; ?></div>
                    </div>  
                </td>
                <td style="text-align: right;" class="raf1"><?php echo $result[0]['RAF']<0 ? 0 : $result[0]['RAF']; ?></td>    
            </tr>           
            <?php endforeach; ?>
        </tbody>
        <tfooter>
	<tr>
            <td class="footer nowrap" style="text-align:right;">Total :</td>
            <td class="footer nowrap" id="moyennetjm1" style="text-align:right;"></td>
            <td class="footer nowrap" id="totalcontratbudget1" style="text-align:right;"></td>
            <td class="footer nowrap" id="totalcontratcharge1" style="text-align:right;"></td>
            <td class="footer nowrap" id="totalfacturebudget1" style="text-align:right;"></td>
            <td class="footer nowrap" id="totalfacturecharge1" style="text-align:right;"></td>
            <td class="footer nowrap" id="moyenneavancebudget1" style="text-align:right;"></td>
            <td class="footer nowrap" id="moyenneavancecharge1" style="text-align:right;"></td>
            <td class="footer nowrap" id="totalraf1" style="text-align:right;"></td>            
	</tr> 
        </tfooter>
    </table>
    <?php $listeachats = ""; ?>
    <?php foreach($results as $result): ?>
        <?php if($result['ACHAT']['COUTACHAT']>0): ?>
            <?php $listeachats .= "<li>".$result['CONTRAT']['NOM']." achats d'un montant de ".$result['ACHAT']['COUTACHAT']." € soit une charge de ".$result['ACHAT']['CHARGEACHAT']." jours</li>"; ?>
        <?php endif; ?>
    <?php endforeach; ?>
    <?php if($listeachats != ""): ?>
    <div class="alert alert-info">
        Des couts liés à des achats sont imputés sur les projets repérés par ¹ et dont voici le détail :
        <ul><?php echo $listeachats; ?>
        </ul>
    </div>  
    <?php endif; ?>
    <br />
    <div style="font-family:'Lucida Grande', 'Lucida Sans Unicode', Verdana, Arial, Helvetica, sans-serif;font-size:16px;color:#274b6d;fill:#274b6d;text-align: center;" text-anchor="middle" class="highcharts-title" zIndex="4">Tableau général</div><br>    
    <table cellpadding="0" cellspacing="0" class="table table-bordered table-striped" id="datatable" style="width:100%;">
        <thead>
            <tr>
            <th rowspan="2" style="vertical-align: middle;">Projet</th>
            <th rowspan="2" width="60px" style="vertical-align: middle;">TJM</th>
            <th colspan="2">Contrat</th>
            <th colspan="2">Prévision</th>
            <th colspan="2">Consommation</th>
            <th colspan="2">Facturation estimée</th>
            <th colspan="2">% Avancement</th>
            <th rowspan="2" style="vertical-align: middle;">Ecart<br><span rel="tooltip" title="Charges réelles - charges facturées"><span class="glyphicons circle_question_mark size10 blue"></span></span></th>
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
                <td style="text-align: right;" class="reelcharge"><?php echo $result[0]['TOTALCHARGEREELLE']; ?></td>   
                <td style="text-align: right;" class="facturebudget"><?php echo $result[0]['BUDGETFACTURE']; ?></td>
                <td style="text-align: right;" class="facturecharge"><?php echo $result[0]['TOTALCHARGEFACTUREE']; ?></td> 
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
            <td class="footer nowrap" style="text-align:right;">Total :</td>
            <td class="footer nowrap" id="moyennetjm" style="text-align:right;"></td>
            <td class="footer nowrap" id="totalcontratbudget" style="text-align:right;"></td>
            <td class="footer nowrap" id="totalcontratcharge" style="text-align:right;"></td>
            <td class="footer nowrap" id="totalprevisionbudget" style="text-align:right;"></td>
            <td class="footer nowrap" id="totalprevisioncharge" style="text-align:right;"></td>
            <td class="footer nowrap" id="totalreelbudget" style="text-align:right;"></td>
            <td class="footer nowrap" id="totalreelcharge" style="text-align:right;"></td>
            <td class="footer nowrap" id="totalfacturebudget" style="text-align:right;"></td>
            <td class="footer nowrap" id="totalfacturecharge" style="text-align:right;"></td>
            <td class="footer nowrap" id="moyenneavancebudget" style="text-align:right;"></td>
            <td class="footer nowrap" id="moyenneavancecharge" style="text-align:right;"></td>
            <td class="footer nowrap" id="totalecart" style="text-align:center;"></td>
            <td class="footer nowrap" id="totalrac" style="text-align:right;"></td>
            <td class="footer nowrap" id="totalraf" style="text-align:right;"></td>            
	</tr> 
        </tfooter>
    </table>
    <br />
    <div style="font-family:'Lucida Grande', 'Lucida Sans Unicode', Verdana, Arial, Helvetica, sans-serif;font-size:16px;color:#274b6d;fill:#274b6d;text-align: center;" text-anchor="middle" class="highcharts-title" zIndex="4">Répartition charge réelle par domaine</div><br>    
    <table cellpadding="0" cellspacing="0" class="table table-bordered tablemax">
        <thead>
            <tr>
            <th rowspan="2" style="vertical-align: middle;">Projet</th>
            <th rowspan="2" style="vertical-align: middle;">Domaine</th>
            <th colspan="2">Consommation estimée</th>
            </tr>
            <tr>
            <th width="70px">Budget (k€)</th>
            <th width="70px">Charge (j)</th>        
            </tr>            
        </thead>
        <tbody>
            <?php foreach($resultsdom as $result): ?>
            <tr>
                <td><?php echo $result['CONTRAT']['NOM']; ?></td>
                <td><?php echo $result['domaines']['DOMAINE'] == null ? 'Non défini' : $result['domaines']['DOMAINE']; ?></td>            
                <td style="text-align: right;" class="dombudgetID"><?php echo $result[0]['DOMBUDGETREEL']; ?></td>
                <td style="text-align: right;" class="domchargeID"><?php echo $result[0]['TOTALDOMCHARGEREELLE']; ?></td>  
            </tr>           
            <?php endforeach; ?>
        </tbody>
        <tfooter>
	<tr>
            <td class="footer nowrap"></td>
            <td class="footer nowrap" style="text-align:right;">Total :</td>
            <td class="footer nowrap" id="totaldombudgetID" style="text-align:right;"></td>
            <td class="footer nowrap" id="totaldomchargeID" style="text-align:right;"></td>        
	</tr> 
        </tfooter>
    </table>        
    <br />
    <div style="font-family:'Lucida Grande', 'Lucida Sans Unicode', Verdana, Arial, Helvetica, sans-serif;font-size:16px;color:#274b6d;fill:#274b6d;text-align: center;" text-anchor="middle" class="highcharts-title" zIndex="4">Indicateurs département</div><br>    
    <table cellpadding="0" cellspacing="0" class="table table-bordered tablemax">
        <thead>
            <tr>
            <th rowspan="2" style="vertical-align: middle;">Projet</th>
            <th colspan="2">Contrat</th>
            <th colspan="2">Consommation estimée</th>
            <th colspan="2">% Avancement</th>
            <th rowspan="2" style="vertical-align: middle;">Reste à faire</th>
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
                <td style="text-align: right;" class="contratbudgetID"><?php echo $result['CONTRAT']['BUDGET']; ?></td>
                <td style="text-align: right;" class="contratchargeID"><?php echo $result['CONTRAT']['CHARGE']; ?></td>               
                <td style="text-align: right;" class="facturebudgetID"><?php echo $result[0]['BUDGETFACTURE']; ?></td>
                <td style="text-align: right;" class="facturechargeID"><?php echo $result[0]['TOTALCHARGEFACTUREE']; ?></td> 
                <td style="text-align: right;" class="avancebudgetID">
                    <?php $styleB1 = $result[0]['AVANCEMENTBUDGET']>100 ? 'progress-striped' : ''; ?>
                    <?php $styleB2 = styleBarreInd(h($result[0]['AVANCEMENTBUDGET'])); ?>
                    <div class="progress <?php echo $styleB1; ?>"  style="margin-bottom:-10px;">
                      <div class="progress-bar progress-bar-<?php echo $styleB2; ?>  " style="width: <?php echo h($result[0]['AVANCEMENTBUDGET']); ?>%;" rel="tooltip" title="Avancement à : <?php echo h($result[0]['AVANCEMENTBUDGET']); ?>%"><?php echo $result[0]['AVANCEMENTBUDGET'] > 0 ? $result[0]['AVANCEMENTBUDGET']."%" : ''; ?></div>
                    </div>                    
                </td>
                <td style="text-align: right;" class="avancechargeID">
                    <?php $styleC1 = $result[0]['AVANCEMENTCHARGE']>100 ? 'progress-striped' : ''; ?>
                    <?php $styleC2 = styleBarreInd(h($result[0]['AVANCEMENTCHARGE'])); ?>
                    <div class="progress <?php echo $styleC1; ?>"  style="margin-bottom:-10px;">
                      <div class="progress-bar progress-bar-<?php echo $styleC2; ?>  " style="width: <?php echo h($result[0]['AVANCEMENTCHARGE']); ?>%;" rel="tooltip" title="Avancement à : <?php echo h($result[0]['AVANCEMENTCHARGE']); ?>%"><?php echo $result[0]['AVANCEMENTCHARGE'] > 0 ? $result[0]['AVANCEMENTCHARGE']."%" : ''; ?></div>
                    </div>  
                </td>    
                <td style="text-align: right;" class="rafID"><?php echo $result[0]['RAF']<0 ? 0 : $result[0]['RAF']; ?></td>   
            </tr>           
            <?php endforeach; ?>
        </tbody>
        <tfooter>
	<tr>
            <td class="footer nowrap" style="text-align:right;">Total :</td>
            <td class="footer nowrap" id="totalcontratbudgetID" style="text-align:right;"></td>
            <td class="footer nowrap" id="totalcontratchargeID" style="text-align:right;"></td>
            <td class="footer nowrap" id="totalfacturebudgetID" style="text-align:right;"></td>
            <td class="footer nowrap" id="totalfacturechargeID" style="text-align:right;"></td>
            <td class="footer nowrap" id="moyenneavancebudgetID" style="text-align:right;"></td>
            <td class="footer nowrap" id="moyenneavancechargeID" style="text-align:right;"></td>
            <td class="footer nowrap" id="totalrafID" style="text-align:right;"></td>            
	</tr> 
        </tfooter>
    </table>    
</div>
<?php if(isset($results) && $israpport==0) : ?>
<div class="bs-callout bs-callout-warning"><b>Aucun résultat pour ce rapport, modifier les paramètres de recherche ...</b></div>
<?php endif; ?>
</div>
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
          value = $(this).html()=='€/j' ? 0: $(this).html().replace("€/j", "");;
          if(value > 0){
            tot += parseFloat(value);
            $i++;
          }
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
    
    $("#totalcontratbudgetID").html(sumOfColumns('contratbudgetID','k€'));
    $("#totalfacturebudgetID").html(sumOfColumns('facturebudgetID','k€'));
    $("#totalcontratchargeID").html(sumOfColumns('contratchargeID','j'));
    $("#totalfacturechargeID").html(sumOfColumns('facturechargeID','j'));
    $("#totalrafID").html(sumOfColumns('rafID','j'));
    $("#moyenneavancebudgetID").html(avancementBudget('1'));
    $("#moyenneavancechargeID").html(avancementCharge('1'));
    $("#totaldombudgetID").html(sumOfColumns('dombudgetID','k€'));
    $("#totaldomchargeID").html(sumOfColumns('domchargeID','j'));
    
    <?php if($israpport >0) : ?>
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
                    this.y +' jours sur '+ this.x +'<br/>Contrat: '+ this.point.stackTotal;;
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
    <?php endif; ?>
});
</script>