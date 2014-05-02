<div class="">
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
            <label class="col-md-4 required" for="DashboardProjetId">Projets: </label>
            <div class="col-md-offset-4">
                    <?php echo $this->Form->select('projet_id',$listprojets,array('data-rule-required'=>'true','multiple'=>'true','class'=>"form-control multiselect size75",'size'=>"10",'data-msg-required'=>"Le nom du projet est obligatoire",'hiddenField' => false)); ?>               
                <br><?php echo $this->Form->input('SelectAllProjetId',array('type'=>'checkbox')); ?><label class="labelAfter" for="DashboardSelectAllProjetId">&nbsp;Tout sélectionner</label>  
            </div>
        </div>        
    </div>
    <div class='block-panel block-panel-50-right'>
        <div class="form-group">
            <label class="col-md-4" for="DashboardPlanchargeId">Plan de charge : </label>
            <div class="col-md-offset-4">
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
    <div class="pull-right"><?php echo $this->Html->link('<span class="ico-doc" style="vertical-align: baseline;"></span> Enregistrer',array('action'=>'export_doc'), array('type'=>'button','class' => 'btn btn-sm btn-default','escape' => false)); ?></div>
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
            <?php if (isset($results)): ?>
            <?php foreach($results as $result): ?>
            <tr>
                <th><?php echo $result['CONTRAT']['NOM']; ?></th>
                <td><?php echo $result[0]['RAF'] < 0 ? 0 : $result[0]['RAF']; ?></td>                
                <td><?php echo $result[0]['TOTALCHARGEFACTUREE']; ?></td> 
            </tr>           
            <?php endforeach; ?>
            <?php endif; ?>
        </tbody>        
    </table>
<br><br>
    <div style="font-family:'Lucida Grande', 'Lucida Sans Unicode', Verdana, Arial, Helvetica, sans-serif;font-size:16px;color:#274b6d;fill:#274b6d;text-align: center;" text-anchor="middle" class="highcharts-title" zIndex="4">Tableau CRA</div><br>
    <table cellpadding="0" cellspacing="0" class="table table-bordered table-striped table1" id="datatable" style="width:100%;">
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
            <?php if (isset($results)): ?>
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
                    <div class="progress <?php echo $styleB1; ?>"  style="margin-bottom:-6px;">
                      <div class="progress-bar progress-bar-<?php echo $styleB2; ?>  " style="width: <?php echo h($result[0]['AVANCEMENTBUDGET']); ?>%;" rel="tooltip" title="Avancement à : <?php echo h($result[0]['AVANCEMENTBUDGET']); ?>%"><?php echo $result[0]['AVANCEMENTBUDGET'] > 0 ? $result[0]['AVANCEMENTBUDGET']."%" : ''; ?></div>
                    </div>
                </td>
                <td style="text-align: right;" class="avancecharge1">
                    <?php $styleC1 = $result[0]['AVANCEMENTCHARGE']>100 ? 'progress-striped' : ''; ?>
                    <?php $styleC2 = styleBarreInd(h($result[0]['AVANCEMENTCHARGE'])); ?>
                    <div class="progress <?php echo $styleC1; ?>"  style="margin-bottom:-6px;">
                      <div class="progress-bar progress-bar-<?php echo $styleC2; ?>  " style="width: <?php echo h($result[0]['AVANCEMENTCHARGE']); ?>%;" rel="tooltip" title="Avancement à : <?php echo h($result[0]['AVANCEMENTCHARGE']); ?>%"><?php echo $result[0]['AVANCEMENTCHARGE'] > 0 ? $result[0]['AVANCEMENTCHARGE']."%" : ''; ?></div>
                    </div>  
                </td>
                <td style="text-align: right;" class="raf1"><?php echo $result[0]['RAF']<0 ? 0 : $result[0]['RAF']; ?></td>    
            </tr>           
            <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
        <tfoot>
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
        </tfoot>
    </table>
    <?php $listeachats = ""; ?>
    <?php if (isset($results)): ?>
    <?php foreach($results as $result): ?>
        <?php if($result['ACHAT']['COUTACHAT']>0): ?>
            <?php $listeachats .= "<li>".$result['CONTRAT']['NOM']." achats d'un montant de ".$result['ACHAT']['COUTACHAT']." € soit une charge de ".$result['ACHAT']['CHARGEACHAT']." jours</li>"; ?>
        <?php endif; ?>
    <?php endforeach; ?>
    <?php endif; ?>
    <?php if($listeachats != ""): ?>
    <div class="bs-callout bs-callout-info">
        Des couts liés à des achats sont imputés sur les projets repérés par ¹ et dont voici le détail :
        <ul><?php echo $listeachats; ?>
        </ul>
    </div>  
    <?php endif; ?>
    <br />
    <div style="font-family:'Lucida Grande', 'Lucida Sans Unicode', Verdana, Arial, Helvetica, sans-serif;font-size:16px;color:#274b6d;fill:#274b6d;text-align: center;" text-anchor="middle" class="highcharts-title" zIndex="4">Tableau équilibre du budget par rapport à la prévision</div><br>    
    <table cellpadding="0" cellspacing="0" class="table table-bordered table-striped table2" id="balance" style="width:100%;">
        <thead>
            <tr>
            <th rowspan="2" style="vertical-align: middle;">Projet</th>
            <th rowspan="2" width="60px" style="vertical-align: middle;">TJM</th>
            <th colspan="2">Contrat</th>
            <th colspan="2">Prévision</th>
            <th colspan="2" class="sorter-false">Ecart</th>
            </tr>
            <tr>
            <th width="80px">Budget (k€)</th>
            <th width="80px">Charge (j)</th>
            <th width="80px">Budget (k€)</th>
            <th width="80px">Charge (j)</th>
            <th width="80px" class="sorter-false">Budget (k€)</th>
            <th width="80px" class="sorter-false">Charge (j)</th>            
            </tr>            
        </thead>
        <tbody>
            <?php if (isset($results)): ?>
            <?php foreach($results as $result): ?>
            <tr>
                <td><?php echo $result['CONTRAT']['NOM']; ?></td>
                <td style="text-align: right;" class="tjm"><?php echo $result['CONTRAT']['TJM']; ?> €/j</td>
                <td style="text-align: right;" class="contratbudgetbalance"><?php echo $result['CONTRAT']['BUDGET']; ?></td>
                <td style="text-align: right;" class="contratchargebalance"><?php echo $result['CONTRAT']['CHARGE']; ?></td>
                <td style="text-align: right;" class="previsionbudgetbalance"><?php echo $result[0]['BUDGETPREVU']; ?></td>
                <td style="text-align: right;" class="previsionchargebalance"><?php echo $result['PREVISION']['CHARGEPREVUE']; ?></td>                  
                <td style="text-align: right;" class="ecartbudgetbalance"></td>   
                <td style="text-align: right;" class="ecartchargebalance"></td> 
            </tr>           
            <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
        <tfoot>
	<tr>
            <td class="footer nowrap" style="text-align:right;">Total :</td>
            <td class="footer nowrap" id="moyennetjm" style="text-align:right;"></td>
            <td class="footer nowrap" id="totalcontratbudgetbalance" style="text-align:right;"></td>
            <td class="footer nowrap" id="totalcontratchargebalance" style="text-align:right;"></td>
            <td class="footer nowrap" id="totalprevisionbudgetbalance" style="text-align:right;"></td>
            <td class="footer nowrap" id="totalprevisionchargebalance" style="text-align:right;"></td>
            <td class="footer nowrap" id="totalecartbudgetbalance" style="text-align:right;"></td> 
            <td class="footer nowrap" id="totalecartchargebalance" style="text-align:right;"></td>
	</tr> 
        </tfoot>
    </table>    
    <br />
    <div style="font-family:'Lucida Grande', 'Lucida Sans Unicode', Verdana, Arial, Helvetica, sans-serif;font-size:16px;color:#274b6d;fill:#274b6d;text-align: center;" text-anchor="middle" class="highcharts-title" zIndex="4">Tableau général</div><br>    
    <table cellpadding="0" cellspacing="0" class="table table-bordered table-striped table1" id="datatable" style="width:100%;">
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
            <?php if (isset($results)): ?>
            <?php foreach($results as $result): ?>
            <tr>
                <td><?php echo $result['CONTRAT']['NOM']; ?></td>
                <td style="text-align: right;" class="tjm" nowrap><?php echo $result['CONTRAT']['TJM']; ?> €/j</td>
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
            <?php endif; ?>
        </tbody>
        <tfoot>
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
        </tfoot>
    </table>
    <br />
    <div style="font-family:'Lucida Grande', 'Lucida Sans Unicode', Verdana, Arial, Helvetica, sans-serif;font-size:16px;color:#274b6d;fill:#274b6d;text-align: center;" text-anchor="middle" class="highcharts-title" zIndex="4">Répartition charge réelle par domaine</div><br>    
    <table cellpadding="0" cellspacing="0" class="table table-bordered tablemax tabledomaine">
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
            <?php if (isset($resultsdom)): ?>
            <?php foreach($resultsdom as $result): ?>
            <tr>
                <td><?php echo $result['CONTRAT']['NOM']; ?></td>
                <td><?php echo $result['domaines']['DOMAINE'] == null ? 'Non défini' : $result['domaines']['DOMAINE']; ?></td>            
                <td style="text-align: right;" class="dombudgetID"><?php echo $result[0]['DOMBUDGETREEL']; ?></td>
                <td style="text-align: right;" class="domchargeID"><?php echo $result[0]['TOTALDOMCHARGEREELLE']; ?></td>  
            </tr>           
            <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
        <tfoot>
	<tr>
            <td class="footer nowrap"></td>
            <td class="footer nowrap" style="text-align:right;">Total :</td>
            <td class="footer nowrap" id="totaldombudgetID" style="text-align:right;"></td>
            <td class="footer nowrap" id="totaldomchargeID" style="text-align:right;"></td>        
	</tr> 
        </tfoot>
    </table>        
    <br />
    <div style="font-family:'Lucida Grande', 'Lucida Sans Unicode', Verdana, Arial, Helvetica, sans-serif;font-size:16px;color:#274b6d;fill:#274b6d;text-align: center;" text-anchor="middle" class="highcharts-title" zIndex="4">Indicateurs département</div><br>    
    <table cellpadding="0" cellspacing="0" class="table table-bordered tablemax table1">
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
            <?php if (isset($results)): ?>
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
                    <div class="progress <?php echo $styleB1; ?>"  style="margin-bottom:-6px;">
                      <div class="progress-bar progress-bar-<?php echo $styleB2; ?>  " style="width: <?php echo h($result[0]['AVANCEMENTBUDGET']); ?>%;" rel="tooltip" title="Avancement à : <?php echo h($result[0]['AVANCEMENTBUDGET']); ?>%"><?php echo $result[0]['AVANCEMENTBUDGET'] > 0 ? $result[0]['AVANCEMENTBUDGET']."%" : ''; ?></div>
                    </div>                    
                </td>
                <td style="text-align: right;" class="avancechargeID">
                    <?php $styleC1 = $result[0]['AVANCEMENTCHARGE']>100 ? 'progress-striped' : ''; ?>
                    <?php $styleC2 = styleBarreInd(h($result[0]['AVANCEMENTCHARGE'])); ?>
                    <div class="progress <?php echo $styleC1; ?>"  style="margin-bottom:-6px;">
                      <div class="progress-bar progress-bar-<?php echo $styleC2; ?>  " style="width: <?php echo h($result[0]['AVANCEMENTCHARGE']); ?>%;" rel="tooltip" title="Avancement à : <?php echo h($result[0]['AVANCEMENTCHARGE']); ?>%"><?php echo $result[0]['AVANCEMENTCHARGE'] > 0 ? $result[0]['AVANCEMENTCHARGE']."%" : ''; ?></div>
                    </div>  
                </td>    
                <td style="text-align: right;" class="rafID"><?php echo $result[0]['RAF']<0 ? 0 : $result[0]['RAF']; ?></td>   
            </tr>           
            <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
        <tfoot>
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
        </tfoot>
    </table>    
</div>
<?php if(isset($results) && $israpport==0) : ?>
<div class="bs-callout bs-callout-warning"><b>Aucun résultat pour ce rapport, modifier les paramètres de recherche ...</b></div>
<?php endif; ?>
</div>
<script>
$(document).ready(function (){ 
   $(".table1").tablesorter();

   $(".tabledomaine").tablesorter({
        headers: {
            2:{filter:false},
            3:{filter:false}
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
        $("#totaldombudgetID").html(newSumOfColumns('tr:not(.filtered) > td.dombudgetID','k€'));
        $("#totaldomchargeID").html(newSumOfColumns('tr:not(.filtered) > td.domchargeID','j'));
        
    });
    
    function newSumOfColumns(id,symbole) {
        var tot = 0;
        $(id).each(function() {
          value = $(this).html()=='' ? 0: $(this).html();
          tot += parseFloat(value);
        });
        return parseFloat(tot).toFixed(0)+" "+symbole;
     };    
    
   $(".table2").tablesorter();
    
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
    

    var count = $("#balance tr").length;
    var sumc = 0;
    var sumb = 0;
    for (var i = 2; i < (count - 1); i++) {
        var contratb = parseFloat($("#balance tr").eq(i).find(".contratbudgetbalance").html());
        var prevub = parseFloat($("#balance tr").eq(i).find(".previsionbudgetbalance").html());
        if(isNaN(contratb)) { contratb = 0; }
        if(isNaN(prevub)) { prevub = 0; }
        sumb = (contratb - prevub);
        if (sumb < 0) {$("#balance tr").eq(i).find(".ecartbudgetbalance").addClass("td-error");} else {$("#balance tr").eq(i).find(".ecartbudgetbalance").addClass("td-success");}
        $("#balance tr").eq(i).find(".ecartbudgetbalance").html(sumb.toFixed(2));
        var contratc = parseFloat($("#balance tr").eq(i).find(".contratchargebalance").html());
        var prevuc = parseFloat($("#balance tr").eq(i).find(".previsionchargebalance").html());
        if(isNaN(contratc)) { contratc = 0; }
        if(isNaN(prevuc)) { prevuc = 0; }
        sumc = (contratc - prevuc);
        if (sumc < 0) {$("#balance tr").eq(i).find(".ecartchargebalance").addClass("td-error");} else {$("#balance tr").eq(i).find(".ecartchargebalance").addClass("td-success");}
        $("#balance tr").eq(i).find(".ecartchargebalance").html(sumc.toFixed(2));        
    }
    $("#totalcontratbudgetbalance").html(sumOfColumns('contratbudgetbalance','k/€'));
    $("#totalcontratchargebalance").html(sumOfColumns('contratchargebalance','j'));
    $("#totalprevisionbudgetbalance").html(sumOfColumns('previsionbudgetbalance','k/€'));
    $("#totalprevisionchargebalance").html(sumOfColumns('previsionchargebalance','j'));
    $("#totalecartbudgetbalance").html(sumOfColumns('ecartbudgetbalance','k/€'));
    $("#totalecartchargebalance").html(sumOfColumns('ecartchargebalance','j'));
    if (sumOfColumns('ecartbudgetbalance','') < 0) {$("#totalecartbudgetbalance").addClass("td-error");} else {$("#totalecartbudgetbalance").addClass("td-success");}
    if (sumOfColumns('ecartchargebalance','') < 0) {$("#totalecartchargebalance").addClass("td-error");} else {$("#totalecartchargebalance").addClass("td-success");}
    
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
        chart: {
            type: 'bar',
            zoomType: 'y',
            resetZoomButton: {
			"relativeTo": "chart"
		},
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
            stackLabels: {
                enabled : true
            },
            title: {
                text: 'Charges'
            }
        },
        exporting: {
                filename : "Tableau de bord",
	},
        tooltip: {
            useHTML : true,
            shared: true,
            hideDelay: 200,
            formatter: function() {
                var ligne = "<br/>";
                for(l=0;l<this.points.length;l++){
                    ligne += "<b style='color:"+this.points[l].series.color+";'>"+this.points[l].series.name+"</b> : "+this.points[l].y+" jours<br/>";
                }
                ligne += "<b>Contrat</b> : "+this.points[0].total+" jours<br/>";
                return '<b>'+ this.points[0].point.name +'</b><br/>'+ligne;
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