<div class="">
<div class="actions form">
<?php echo $this->Form->create('Expressionbesoin',array('id'=>'formValidate','class'=>'form-horizontal','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?>
    <div class='block-panel block-panel-50-left'>
        <div class="form-group">
            <label class="col-md-4" for="ExpressionbesoinLotId">Lots : </label>
            <div class="col-md-4">
                    <?php echo $this->Form->select('lot_id',$lots,array('class'=>"form-control",'empty'=>'Tous')); ?>                          
            </div>            
        </div>    
        <div class="form-group">
            <label class="col-md-4" for="ExpressionbesoinPerimetreId">Périmètres : </label>
            <div class="col-md-4">
                    <?php echo $this->Form->select('perimetre_id',$perimetres,array('class'=>"form-control",'empty'=>'Tous')); ?>                          
            </div>            
        </div>    
        <div class="form-group">
            <label class="col-md-4 required" for="ExpressionbesoinMois">Mois :</label>
            <div class="col-md-4">
                    <?php echo $this->Form->select('mois',$mois,array('default'=>date('m'),'class'=>"form-control",'empty'=>false)); ?>           
            </div>            
        </div>        
        <div class="form-group">
            <label class="col-md-4 required" for="ExpressionbesoinAnnee">Année : </label>
            <div class="col-md-4">
                    <?php echo $this->Form->select('annee',$annee,array('default'=>date('Y'),'class'=>"form-control",'empty'=>false)); ?>           
            </div>            
        </div>        
    </div>
    <div class='block-panel block-panel-50-right'>
        <div class="form-group">
            <label class="col-md-4 required" for="ExpressionbesoinEtatId">Etat : </label>
            <div class="col-md-4">
                    <?php echo $this->Form->select('etat_id',$etats,array('data-rule-required'=>'true','data-msg-required'=>"L'état est obligatoire",'multiple'=>'true','size'=>"5",'class'=>"form-control multiselect size75")); ?>                          
                    <br><?php echo $this->Form->input('SelectAll',array('type'=>'checkbox')); ?><label class="labelAfter" for="ExpressionbesoinSelectAll">&nbsp;Tout sélectionner</label>            
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
<!-- rapport avec le graphique et le tableau -->
</div>
<?php $israpport = isset($results) ? count($results) : 0; ?>
<?php if($israpport>0 && isset($results)): ?>
    <div id="chartcontainer" style="width:80%; height:500px; margin-left: 10%;"></div>
<!-- rapport avec le graphique et le tableau -->
    <?php $lots = array_uniquecolumn($chartresults,'lots','LOT'); ?>
    <?php $perimetres = array_uniquecolumn($chartresults,'perimetres','PERIMETRE'); ?>
    <table id="datatable" style="display:none;">
        <thead>
            <tr>
                <th></th>
                <?php foreach($perimetres as $key=>$value): ?>
                <th><?php echo $value; ?></th>
                <?php endforeach; ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach($lots as $key=>$vallot): ?>
            <tr>
                <td><?php echo "Lot ".$vallot; ?></td>
                <?php foreach($perimetres as $key=>$valapp): ?>
                    <?php foreach($chartresults as $chartresult): ?>
                        <?php if($chartresult['lots']['LOT']== $vallot): ?>
                            <?php if($chartresult['perimetres']['PERIMETRE']== $valapp): ?>
                            <td><?php echo $chartresult[0]['NB']; ?></td>
                            <?php endif; ?>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php endforeach; ?>
            </tr>           
            <?php endforeach; ?>
        </tbody>        
    </table>
<br>
    <div id="chartcumulcontainer" style="width:80%; height:500px; margin-left: 10%;"></div>
<!-- rapport avec le graphique et le tableau -->
    <?php $lots = array_uniquecolumn($chartcumulenvresults,'lots','LOT'); ?>
    <?php $perimetres = array_uniquecolumn($chartcumulenvresults,'perimetres','PERIMETRE'); ?>
    <table id="datatablecumul" style="display:none;">
        <thead>
            <tr>
                <th></th>
                <?php foreach($perimetres as $key=>$value): ?>
                <th><?php echo $value; ?></th>
                <?php endforeach; ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach($lots as $key=>$vallot): ?>
            <tr>
                <td><?php echo "Lot ".$vallot; ?></td>
                <?php foreach($perimetres as $key=>$valapp): ?>
                    <?php foreach($chartcumulenvresults as $chartresult): ?>
                        <?php if($chartresult['lots']['LOT']== $vallot): ?>
                            <?php if($chartresult['perimetres']['PERIMETRE']== $valapp): ?>
                            <td><?php echo $chartresult[0]['NB']; ?></td>
                            <?php endif; ?>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php endforeach; ?>
            </tr>           
            <?php endforeach; ?>
        </tbody>        
    </table>
 <?php 
 $nbenv = 0; 
 foreach($chartcumulenvresults as $chartresult):
     $nbenv += $chartresult[0]['NB'];
 endforeach;
 ?>
<br>
   <div id="charthistocontainer" style="width:80%; height:500px; margin-left: 10%;"></div>
<br>
    <div style="font-family:'Lucida Grande', 'Lucida Sans Unicode', Verdana, Arial, Helvetica, sans-serif;font-size:16px;color:#274b6d;fill:#274b6d;text-align: center;" text-anchor="middle" class="highcharts-title" zIndex="4">Nombre d'environnements par mois, lot, application, périmètre et état</div><br>
    <table cellpadding="0" cellspacing="0" class="table table-bordered table-striped" id="sorttable">
        <thead>
            <tr>
                <th>Mois</th>
                <th>Lot</th>
                <th>Application</th>
                <th>Périmètre</th>
                <th>Etats</th>
                <th>Nombres</th>
            </tr>           
        </thead>
        <tbody>
            <?php foreach($results as $result): ?>
            <tr>
                <td><?php echo strMonth($result[0]['MOIS']); ?></td>
                <td><?php echo $result['lots']['LOT']; ?></td>
                <td><?php echo $result['applications']['APPLICATION']; ?></td>                
                <td><?php echo $result['perimetres']['PERIMETRE']; ?></td>
                <td><?php echo $result['etats']['ETAT']; ?></td>
                <td width='40px' style='text-align: center' class='totalapp'><?php echo intval($result[0]['NB']); ?></td>
            </tr>           
            <?php endforeach; ?>
        </tbody>
        <tfoot>
	<tr>
            <td class="footer nowrap" colspan='5' style="text-align:right;">Total :</td>
            <td class="footer nowrap" id="totalall" style="text-align:center;"></td>            
	</tr> 
        </tfoot>
    </table>
    <table cellpadding="0" cellspacing="0" class="table table-bordered table-striped" id="datatable" style="display:none;">
        <thead>
            <tr>
                <th>Mois</th>
                <th>Lot</th>
                <th>Application</th>
                <th>Périmètre</th>
                <th>Etats</th>
                <th>Nombres</th>
            </tr>           
        </thead>
        <tbody>
            <?php foreach($results as $result): ?>
            <tr>
                <td><?php echo strMonth($result[0]['MOIS']); ?></td>
                <td><?php echo $result['lots']['LOT']; ?></td>
                <td><?php echo $result['applications']['APPLICATION']; ?></td>                
                <td><?php echo $result['perimetres']['PERIMETRE']; ?></td>
                <td><?php echo $result['etats']['ETAT']; ?></td>
                <td width='40px' style='text-align: center' class=''><?php echo intval($result[0]['NB']); ?></td>
            </tr>           
            <?php endforeach; ?>
        </tbody>
        <tfoot>
	<tr>
            <td class="footer nowrap" colspan='5' style="text-align:right;">Total :</td>
            <td class="footer nowrap" id="" style="text-align:center;"></td>            
	</tr> 
        </tfoot>
    </table>    
<?php endif; ?> 
<?php if($israpport==0 && isset($results)): ?> 
    <div class="bs-callout bs-callout-warning"><b>Aucun résultat pour ce rapport, modifier les paramètres de recherche ...</b></div>
<?php endif; ?>   
<script>
$(document).ready(function (){ 
    $("#sorttable").tablesorter({
        headers: { 5: { filter: false} },
        widthFixed : true,
        widgets: ["zebra","filter"],
        widgetOptions : {
            filter_columnFilters : true,
            filter_hideFilters : true,
            filter_ignoreCase : true,
            filter_liveSearch : true,
            filter_useParsedData : false,
            zebra : [ "normal-row", "alt-row" ]
        }
    }).bind('filterEnd',function(e,t){
        $("#totalall").html(newSumOfColumns('tr:not(.filtered) > td.totalapp',''));
    });
    
    $(document).on('click','#ExpressionbesoinSelectAll',function() {
        if($(this).is(':checked')){
            $('#ExpressionbesoinEtatId option').prop('selected', 'selected');
        } else {
            $('#ExpressionbesoinEtatId option').prop('selected', '');
        }
    });   
    
   $(document).on('click','#ExpressionbesoinEtatId',function() {
            $('#ExpressionbesoinSelectAll').prop('checked', false);
    }); 
    
    function newSumOfColumns(id,symbole) {
        var tot = 0;
        $(id).each(function() {
          value = $(this).html()=='' ? 0: $(this).html();
          tot += parseFloat(value);
        });
        return parseFloat(tot).toFixed(0)+" "+symbole;
     };    
    
    function sumOfColumns(id,symbole) {
        var tot = 0;
        $("."+id).each(function() {
          value = $(this).html()=='' ? 0: $(this).html();
          tot += parseFloat(value);
        });
        return parseFloat(tot).toFixed(0)+" "+symbole;
     } 
     
     $("#totalall").html(sumOfColumns('totalapp',''));
     
    <?php if($israpport >0) : ?>
    var mois = $("#ExpressionbesoinMois option:selected").text();
    var annee = $("#ExpressionbesoinAnnee option:selected").text();   

    $('#chartcontainer').highcharts({
        colors: ['#A1006B','#E05206','#CCDC00','#009AA6','#CB0044','#FFB612','#7ABB00','#00BBCE','#6E267B'], 
        credits:{
            enabled:false
        },
        chart: {
            renderTo: 'container',
            type: 'column'
        },
        title: {
            useHTML: true,
            text: 'Nombre de nouveaux environnements par lot et périmètre pour '+mois+' '+annee
        },
        data: {
            table: document.getElementById('datatable')
        },
        yAxis: {
            allowDecimals: false,
            title: {
                       text: 'Nombre d\'environnements'
                   }
        },
        exporting: {
		scale: 2,
                filename : "Nouveaux environnements"
	},        
        plotOptions: {
                column: {
                    dataLabels: {
                        enabled: true,
                        color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'grey'
                    }
                }
            }        
        });
    var today = new Date();
    var month = (today.getMonth()+1) < 10 ? '0'+(today.getMonth()+1) : (today.getMonth()+1);
    var nbenv = "<?php echo $nbenv; ?>";
    <?php 
    $categories = array();
    foreach($lots as $key=>$vallot): 
       $categories[] = '"Lot '.$vallot.'"';
    endforeach; 
    $strcat = implode(',',$categories);
    ?>
    $('#chartcumulcontainer').highcharts({
        colors: ['#A1006B','#E05206','#CCDC00','#009AA6','#CB0044','#FFB612','#7ABB00','#00BBCE','#6E267B'], 
        credits:{
            enabled:false
        },
        chart: {
            renderTo: 'container',
            type: 'column'
        },
        title: {
            useHTML: true,
            text: nbenv +' environnements opérationnels au : '+today.getDate()+'/'+ month +'/'+today.getFullYear()
        },
        data: {
            table: document.getElementById('datatablecumul')
        },
        xAxis: {
            categories:[<?php echo $strcat; ?>],
        },
        yAxis: {
            allowDecimals: false,
            title: {
                       text: 'Nombre d\'environnements'
                   }
        },
        tooltip: {
            useHTML : true,
            shared: true,    
            formatter: function() {
                console.log(this);
                var ligne = "<br/>";
                var total = 0;
                for(l=0;l<this.points.length;l++){
                    ligne += "<b style='color:"+this.points[l].series.color+";'>"+this.points[l].series.name+"</b> : "+this.points[l].y+" environnements opérationnels<br/>";
                    total = total + this.points[l].y;
                }
                ligne += "<b>Total pour ce lot</b> : "+total+"  environnements opérationnels<br/>";
                var mois = this.x ;/*Highcharts.dateFormat('%b', new Date(this.x));*/
                return '<b>'+ mois +'</b><br/>'+ligne;
            }
        },          
        exporting: {
		scale: 2,
                filename : "Environnements opérationnels"
	},        
        plotOptions: {
                column: {
                    dataLabels: {
                        enabled: true,
                        color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'grey'
                    }
                }
            }        
        });        
        
    <?php 
    $data = array();
    foreach($charthistoresults as $charthistoresult):
        $datas[$charthistoresult['lots']['LOT']][] = "[".$charthistoresult[0]['MOIS'].",".$charthistoresult[0]['NB']."]";
    endforeach;
    ?>
        
    $('#charthistocontainer').highcharts({
        colors: ['#A1006B','#E05206','#CCDC00','#009AA6','#CB0044','#FFB612','#7ABB00','#00BBCE','#6E267B'], 
        credits:{
            enabled:false
        },
        chart: {
            renderTo: 'container',
            type: 'spline'
        },
        title: {
            useHTML: true,
            text: 'Progression du nombre d\'environnements pour '+annee
        },
        subtitle:{
               text:'(en fonction des critères sélectionnés)'
        },        
        xAxis: {
            title: {
                text: 'Mois'
            },            
            labels: {
                formatter: function() {
                    $mois = ['','Janv.','Fév.','Mars','Avril','Mai','Juin','Juil.','Août','Sept.','Oct.','Nov.','Déc.'];
                    return $mois[this.value];
                },
                rotation: -45,
                align: 'right',
                style: {
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif'
                }                
            },
            tickInterval: 1
            /*type: 'datetime',   
            dateTimeLabelFormats: { // don't display the dummy year
                month: '%b %Y',
                year: '%Y'   },        
            labels: {
                rotation: -45,
                align: 'right',
                style: {
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif'
                }                
            },  */            
        },   
        yAxis: {
            allowDecimals: false,
            title: {
                       text: 'Nombre d\'environnements'
                   }
        },   
        exporting: {
		scale: 2,
                filename : "Historique des demandes d'environnements"
	},        
        tooltip: {
            useHTML : true,
            shared: true,    
            formatter: function() {
                $moisentier = ['Janvier','Février','Mars','Avril','Mai','Juin','Juillet','Août','Septembre','Octobre','Novembre','Décembre','Janvier','Février','Mars','Avril','Mai','Juin','Juillet','Août','Septembre','Octobre','Novembre','Décembre'];
                var ligne = "<br/>";
                var total = 0;
                for(l=0;l<this.points.length;l++){
                    ligne += "<b style='color:"+this.points[l].series.color+";'>"+this.points[l].series.name+"</b> : "+this.points[l].y+" nouveaux environnements<br/>";
                    total = total + this.points[l].y;
                }
                ligne += "<b>Total sur le mois</b> : "+total+" nouveaux environnements<br/>";
                var mois = $moisentier[this.x-1];/*Highcharts.dateFormat('%b', new Date(this.x));*/
                return '<b>'+ mois +'</b><br/>'+ligne;
            }
        },  
        plotOptions: {
                spline: {
                    dataLabels: {
                        enabled: true,
                        color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'grey'
                    }
                }
            } ,        
        series: [
            <?php foreach($datas as $key=>$data): ?>
                {
                name: '<?php echo $key; ?>',
                data: [<?php echo join($data, ',') ?>]
                },
            <?php endforeach; ?>      
        ]     
    });        
    <?php endif; ?>     
});
</script>