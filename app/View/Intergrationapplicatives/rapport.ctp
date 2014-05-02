<div class="">
<div class="actions form">
<?php echo $this->Form->create('Intergrationapplicative',array('id'=>'formValidate','class'=>'form-horizontal','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?>
    <div class='block-panel block-panel-50-left'>
        <div class="form-group">
            <label class="col-md-4 required" for="IntergrationapplicativeApplicationId">Applications : </label>
            <div class="col-md-offset-4">
                    <?php echo $this->Form->select('application_id',$applications,array('data-rule-required'=>'true','multiple'=>'true','size'=>"10",'class'=>"form-control multiselect size75",'data-msg-required'=>"L'application est obligatoire")); ?>               
                <br><?php echo $this->Form->input('SelectAll',array('type'=>'checkbox')); ?><label class="labelAfter" for="IntergrationapplicativeSelectAll">&nbsp;Tout sélectionner</label>            
            </div>            
        </div>  
    </div>
    <div class='block-panel block-panel-50-right'>
        <div class="form-group">
            <label class="col-md-4 required" for="IntergrationapplicativeMois">Mois :</label>
            <div class="col-md-4">
                    <?php echo $this->Form->select('mois',$mois,array('default'=>date('m'),'class'=>"form-control",'empty'=>false)); ?>           
            </div>            
        </div>
        <div class="form-group">
            <label class="col-md-4 required" for="IntergrationapplicativeAnnee">Année : </label>
            <div class="col-md-4">
                    <?php echo $this->Form->select('annee',$annee,array('default'=>date('Y'),'class'=>"form-control",'empty'=>false)); ?>           
            </div>            
        </div>
        <div class="form-group">
            <label class="col-md-4" for="IntergrationapplicativeEnvironnementId">Environnements : </label>
            <div class="col-md-4">
                    <?php echo $this->Form->select('environnement_id',$environnements,array('class'=>"form-control",'empty'=>'Tous')); ?>                          
            </div>            
        </div>         
        <div class="form-group">
            <label class="col-md-4" for="IntergrationapplicativeLotId">Lots : </label>
            <div class="col-md-4">
                    <?php echo $this->Form->select('lot_id',$lots,array('class'=>"form-control",'empty'=>'Tous')); ?>                          
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
<?php if($israpport>0 && isset($results)): ?>
    <div id="chartcontainer" style="width:80%; height:500px; margin-left: 10%;"></div>
<!-- rapport avec le graphique et le tableau -->
    <?php $lots = array_uniquecolumn($chartresults,'lots','LOT'); ?>
    <?php $applications = array_uniquecolumn($chartresults,'applications','APPLICATION');?>
    <table id="datatable" style="display:none;">
        <thead>
            <tr>
                <th></th>
                <?php foreach($applications as $key=>$value): ?>
                <th><?php echo $value; ?></th>
                <?php endforeach; ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach($lots as $key=>$vallot): ?>
            <tr>
                <td><?php echo "Lot ".$vallot; ?></td>
                <?php foreach($applications as $key=>$valapp): ?>
                     <?php foreach($chartresults as $chartresult): ?> 
                         <?php if($chartresult['lots']['LOT']== $vallot): ?>
                            <?php if($chartresult['applications']['APPLICATION']=== $valapp): ?>
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
   <div id="charthistocontainer" style="width:80%; height:500px; margin-left: 10%;"></div>
<br>
    <div style="font-family:'Lucida Grande', 'Lucida Sans Unicode', Verdana, Arial, Helvetica, sans-serif;font-size:16px;color:#274b6d;fill:#274b6d;text-align: center;" text-anchor="middle" class="highcharts-title" zIndex="4">Nombre d'intégration par lot, application et environnement</div><br>
    <table cellpadding="0" cellspacing="0" class="table table-bordered table-striped" id="sorttable">
        <thead>
            <tr>
                <th>Lot</th>
                <th>Version</th>
                <th>Date installation</th>
                <th>Application</th>
                <th>Environnement</th>
                <th>Nombres</th>
            </tr>           
        </thead>
        <tbody>
            <?php foreach($results as $result): ?>
            <tr>
                <td><?php echo $result['lots']['LOT']; ?></td>
                <td><?php echo $result['versions']['VERSION']; ?></td>
                <td><?php echo CUSDatetimeToFRDate($result['intergrationapplicatives']['DATEINSTALL']); ?></td>
                <td><?php echo $result['applications']['APPLICATION']; ?></td>                
                <td><?php echo $result['types']['TYPE']; ?></td> 
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
<?php endif; ?> 
<?php if($israpport==0 && isset($results)): ?> 
    <div class="bs-callout bs-callout-warning"><b>Aucun résultat pour ce rapport, modifier les paramètres de recherche ...</b></div>
<?php endif; ?> 
</div>
<script>
$(document).ready(function (){ 
    //tri sur le tableau 
    $("#sorttable").tablesorter({
        headers: {
            2: {sorter: 'fr-date',filter:false},
            5: {filter:false}
        },
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
    
    $(document).on('click','#IntergrationapplicativeSelectAll',function() {
        if($(this).is(':checked')){
            $('#IntergrationapplicativeApplicationId option').prop('selected', 'selected');
        } else {
            $('#IntergrationapplicativeApplicationId option').prop('selected', '');
        }
    });   
    
   $(document).on('click','#IntergrationapplicativeApplicationId',function() {
            $('#IntergrationapplicativeSelectAll').prop('checked', false);
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
     };
     
     $("#totalall").html(sumOfColumns('totalapp',''));
     
    <?php if(isset($chartresults)) : ?>   
    
    var env = $("#IntergrationapplicativeEnvironnementId option:selected").text();
    var mois = $("#IntergrationapplicativeMois option:selected").text();
    var annee = $("#IntergrationapplicativeAnnee option:selected").text(); 
    var title = '';
    if(env=='Tous' || env=='TOUS'){
        title = 'Nombre d\'intégration par lot et application pour';
        title2 = 'Progression du nombre d\'intégration pour la période ';}
    else{
        title = 'Nombre d\'intégration par lot et application en '+env+' pour';
        title2 = 'Progression du nombre d\'intégration en '+env+' pour la période ';}

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
            text: title +' '+mois+' '+annee
        },
        data: {
            table: document.getElementById('datatable')
        },
        yAxis: {
            allowDecimals: false,
            title: {
                       text: 'Nombre d\'intégration'
                   }
        },
        xAxis: {
            categories: [<?php echo implode(",", $lots); ?>],
            
        },
        exporting: {
		scale: 2,
                filename : "Intégrations applicatives"
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
        $time = explode('/',$charthistoresult[0]['MOISANNEE']);
        $datas[$charthistoresult['lots']['LOT']][] = "[Date.UTC(".$time[1].",".($time[0]-1).",1),".$charthistoresult[0]['NB']."]";
    endforeach;
    ?>
            
    $('#charthistocontainer').highcharts('StockChart',{
        credits:{
            enabled:false
        },
        navigator: {
            xAxis: {
                dateTimeLabelFormats: {
                    day: '%b %Y',
                    week: '%b %Y',
                    month: '%b %Y',
                    year: '%b %Y'
                }
            },
            adaptToUpdatedData: true,
        },     
        scrollbar : {
            enabled : false
        },
        rangeSelector:{
            inputEnabled: $('#container').width() > 480,
            buttonSpacing: 15, 
            buttonTheme: { // styles for the buttons
                fill: 'none',
    		states: {
                    hover: {
                        fill: 'none',
                        style:{
                            fontWeight: 'bold'
                        }
                    },
                    select: {
                        fill: 'none',
                        style: {
                            color: '#A1006B'
                        }
                    }
                }                   
            },
            buttons: [ {
                type: 'all',
                text: 'Tout'
            },{
                type: 'month',
                count: 24,
                text: '2 ans'
            }, {
                type: 'month',
                count: 12,
                text: '1 an'
            }, {
                type: 'month',
                count: 6,
                text: '6 mois'
            }],
            selected: 1,
            
        },        
        chart: {
            renderTo: 'container',
            type: 'spline'
        },
        title: {
            useHTML: true,
            text: title2+<?php echo $charthistoresults[0][0]['MINANNEE']; ?>+"-"+annee
        },
        subtitle:{
               text:'(en fonction des critères sélectionnés)'
        },        
        xAxis: {
            type: 'datetime',   
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
            },          
        },   
        yAxis: {
            allowDecimals: false,
            title: {
                       text: 'Nombre d\'intégration'
                   },
             min:0
        },  
        exporting: {
		scale: 2,
                filename : "Historique intégration applicatives"
	},        
        tooltip: {
            useHTML : true,
            shared: true,    
            xDateFormat: "mmm yyyy",
            formatter: function() {
                $moisentier = ['Janvier','Février','Mars','Avril','Mai','Juin','Juillet','Août','Septembre','Octobre','Novembre','Décembre','Janvier','Février','Mars','Avril','Mai','Juin','Juillet','Août','Septembre','Octobre','Novembre','Décembre'];
                var ligne = "<br/>";
                var total = 0;
                for(l=0;l<this.points.length;l++){
                    ligne += "<b style='color:"+this.points[l].series.color+";'>"+this.points[l].series.name+"</b> : "+this.points[l].y+" intégrations<br/>";
                    total = total + this.points[l].y;
                }
                ligne += "<b>Total sur le mois</b> : "+total+" intégrations<br/>";
                var mois = Highcharts.dateFormat('%b %Y', new Date(this.x));
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
    }) ;
    <?php endif; ?>     
});
</script>