<div class="">
<div class="biens form">
<?php echo $this->Form->create('Bien',array('id'=>'formValidate','class'=>'form-horizontal','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?>
    <div class='block-panel block-panel-50-left'>
        <div class="form-group">
            <label class="col-md-4" for="BiensChassisId">Châssis: </label>
            <div class="col-md-offset-4">
                    <?php echo $this->Form->select('chassis_id',$chassis,array('data-rule-required'=>'false','multiple'=>'true','class'=>"form-control multiselect size75",'size'=>"10")); ?>               
                <br><?php echo $this->Form->input('SelectAllChassis',array('type'=>'checkbox')); ?><label class="labelAfter" for="BienSelectAllChassis">&nbsp;Tout sélectionner</label>  
                <br><div class="bs-callout bs-callout-info" style="width:85%;">Permet de calculer le rapport sur les coeurs restant et mémoire restante</div>
            </div>
        </div>     
    </div>
    <div class='block-panel block-panel-50-right'>
        <div class="form-group">
            <label class="col-md-4" for="BiensEnvoutilsId">Outils : </label>
            <div class="col-md-offset-4">
                    <?php echo $this->Form->select('envoutil_id',$envoutils,array('multiple'=>'true','size'=>"10",'class'=>"form-control multiselect size75")); ?>               
                <br><?php echo $this->Form->input('SelectAllEnvoutils',array('type'=>'checkbox')); ?><label class="labelAfter" for="BienSelectAllEnvoutils">&nbsp;Tout sélectionner</label>            
                <br><div class="bs-callout bs-callout-info" style="width:85%;">Permet de calculer le rapport sur les PVU par application</div>
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
    
<?php 
if(isset($resultpx70) && count($resultpx70)>0):
    //debug($resultpx70); ?>
    <div style="font-family:'Lucida Grande', 'Lucida Sans Unicode', Verdana, Arial, Helvetica, sans-serif;font-size:16px;color:#274b6d;fill:#274b6d;text-align: center;" text-anchor="middle" class="highcharts-title" zIndex="4">Nombre de coeur et mémoire utilisées par châssis</div><br>
    <table cellpadding="0" cellspacing="0" class="table table-bordered tablemax tablechassis">
        <thead>
            <tr>
            <th>Châssis</th>
            <th>Coeur installés</th>
            <th>Coeur activés</th>
            <th>Coeur utilisés</th>
            <th>Coeur disponibles</th>
            <th>Mémoire installée</th>
            <th>Mémoire Activée</th>
            <th>Mémoire utilisée</th>
            <th>Mémoire disponible</th>
            <th width="16px"></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($resultpx70 as $result): ?>
            <tr>
                <td><?php echo $result['chassis']['NOM']; ?></td>
                <td style="text-align: right;" class="cinstalled"><?php echo $result[0]['SCINSTALLE']; ?></td>
                <td style="text-align: right;" class="cactived"><?php echo $result[0]['SCACTIVE']; ?></td>
                <td style="text-align: right;" class="cused"><?php echo $result[0]['CUSED']; ?></td>
                <?php $error = $result[0]['SCACTIVE']-$result[0]['CUSED'] < 0 ? 'td-error':''; ?>
                <td style="text-align: right;" class="cfree <?php echo $error; ?>"><?php echo $result[0]['SCACTIVE']-$result[0]['CUSED']; ?></td>
                <td style="text-align: right;" class="raminstalled"><?php echo $result[0]['SRAMINSTALLE']; ?></td>
                <td style="text-align: right;" class="ramactived"><?php echo $result[0]['SRAMACTIVE']; ?></td>
                <td style="text-align: right;" class="ramused"><?php echo $result[0]['RAMUSED']; ?></td>
                <?php $error = $result[0]['SRAMACTIVE']-$result[0]['RAMUSED'] < 0 ? 'td-error':''; ?>
                <td style="text-align: right;" class="ramfree <?php echo $error; ?>"><?php echo $result[0]['SRAMACTIVE']-$result[0]['RAMUSED']; ?></td>
                <td><span class="glyphicons charts notchange cursor chartpx70s" data-ctitle="<?php echo $result['chassis']['NOM'] ; ?>" data-cmax="<?php echo $result[0]['SCINSTALLE']+25 ; ?>" data-cactive="<?php echo $result[0]['SCACTIVE'] ; ?>" data-cinter="<?php echo $result[0]['SCINSTALLE'] ; ?>"  data-cused="<?php echo $result[0]['CUSED'] ; ?>" data-cdispo="<?php echo $result[0]['SCACTIVE']-$result[0]['CUSED']; ?>"
                          data-rmax="<?php echo $result[0]['SRAMINSTALLE']+(1024*100) ; ?>" data-ractive="<?php echo $result[0]['SRAMACTIVE'] ; ?>" data-rinter="<?php echo $result[0]['SRAMINSTALLE'] ; ?>"  data-rused="<?php echo $result[0]['RAMUSED'] ; ?>" data-rdispo="<?php echo $result[0]['SRAMACTIVE']-$result[0]['RAMUSED']; ?>"></span></td>
            </tr>           
            <?php endforeach; ?>
        </tbody>
        <tfoot>
	<tr>
            <td class="footer" style="text-align:right;">Total :</td>
            <td class="footer" id="totalcinstalled" style="text-align:right;"></td>
            <td class="footer" id="totalcactived" style="text-align:right;"></td>
            <td class="footer" id="totalcused" style="text-align:right;"></td>
            <td class="footer" id="totalcfree" style="text-align:right;"></td>
            <td class="footer" id="totalraminstalled" style="text-align:right;"></td>
            <td class="footer" id="totalramactived" style="text-align:right;"></td>
            <td class="footer" id="totalramused" style="text-align:right;"></td>
            <td class="footer" id="totalramfree" style="text-align:right;"></td>
            <td class="footer"></td>
	</tr> 
        </tfoot>
    </table>
<?php elseif(isset($resultpx70) && count($resultpx70)==0): ?>
    <div class="bs-callout bs-callout-warning">Aucun rapport pour le nombre de coeur et de mémoire utilisé</div>
<?php endif;?>
<?php 
if(isset($resultpvu) && count($resultpvu)>0):
    //debug($resultpvu); ?>
    <div style="font-family:'Lucida Grande', 'Lucida Sans Unicode', Verdana, Arial, Helvetica, sans-serif;font-size:16px;color:#274b6d;fill:#274b6d;text-align: center;" text-anchor="middle" class="highcharts-title" zIndex="4">Nombre de PVU par outils</div><br>
    <table cellpadding="0" cellspacing="0" class="table table-bordered tablemax tablepvu">
        <thead>
            <tr>
            <th>Outils</th>
            <th>PVU utilisé</th>
            <th>PVU restant</th>
            <th width="16px"></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($resultpvu as $result): ?>
            <tr>
                <td><?php echo $result['envoutils']['NOM']; ?></td>
                <td style="text-align: right;" class="pvu"><?php echo $result[0]['PVU']; ?></td>
                <?php $error = $result[0]['SPVUMAX'] < 0 ? 'td-error':''; ?>
                <td style="text-align: right;" class="pvurestant <?php echo $error; ?>"><?php echo $result[0]['SPVUMAX']; ?></td>
                <td><span class="glyphicons charts notchange cursor chartpvu" data-title="<?php echo $result['envoutils']['NOM'] ; ?>" data-used="<?php echo $result[0]['PVU'] ; ?>" data-dispo="<?php echo $result[0]['SPVUMAX'] ; ?>" data-active="<?php echo $result[0]['PVU']+$result[0]['SPVUMAX']-250 ; ?>" data-max="<?php echo $result[0]['PVU']+$result[0]['SPVUMAX']+250 ; ?>" data-inter="<?php echo $result[0]['PVU']+$result[0]['SPVUMAX'] ; ?>"></span></td>
            </tr>           
            <?php endforeach; ?>
        </tbody>
        <tfoot>
	<tr>
            <td class="footer" style="text-align:right;">Total :</td>
            <td class="footer" id="totalpvu" style="text-align:right;"></td>
            <td class="footer" id="totalpvurestant" style="text-align:right;"></td>
            <td class="footer"></td>
	</tr> 
        </tfoot>
    </table>
<?php elseif(isset($resultpx70) && count($resultpx70)==0): ?>
    <div class="bs-callout bs-callout-warning">Aucun rapport pour le nombre de PVU</div>
<?php endif;?>
<?php if((isset($resultpvu) && count($resultpvu)>0) || (isset($resultpx70) && count($resultpx70)>0)): ?>
    <div class="row clearfix">
            <div class="col-md-4 column">
                <div id="chartpx70container" style="width:80%; margin-left: 10%;text-align: center; height: 200px;"></div>
            </div>
            <div class="col-md-4 column">
                <div id="chartramcontainer" style="width:80%; margin-left: 10%;text-align: center; height: 200px;"></div>
            </div>        
            <div class="col-md-4 column">
                <div id="chartpvucontainer" style="width:80%; margin-left: 10%;text-align: center; height: 200px;"></div>
            </div>
    </div>
<?php endif; ?>
</div>
<script>
$(document).ready(function (){ 
   $(".tablechassis").tablesorter({
        headers: {
            1: {filter: false },
            2: {filter:false},
            3: {filter: false },
            4: {filter:false},
            5: {filter: false },
            6: {filter:false} ,
            7: {filter: false },
            8: {filter:false},
            9: {filter: false },
        },
        widthFixed : true,
        widgets: ["zebra","filter"],
        widgetOptions : {
            filter_columnFilters : true,
            filter_hideFilters : true,
            filter_ignoreCase : true,
            filter_liveSearch : true,
            filter_saveFilters : true,
            filter_useParsedData : false,
            filter_startsWith : false,
            zebra : [ "normal-row", "alt-row" ]
        }
    }).bind('filterEnd',function(e,t){
        $("#totalcinstalled").html(newSumOfColumns('tr:not(.filtered) > td.cinstalled',''));
        $("#totalraminstalled").html(newSumOfColumns('tr:not(.filtered) > td.raminstalled',''));
        $("#totalcactived").html(newSumOfColumns('tr:not(.filtered) > td.cactived',''));
        $("#totalramactived").html(newSumOfColumns('tr:not(.filtered) > td.ramactived','')); 
        $("#totalcfree").html(newSumOfColumns('tr:not(.filtered) > td.cfree',''));
        $("#totalramfree").html(newSumOfColumns('tr:not(.filtered) > td.ramfree',''));        
        $("#totalcused").html(newSumOfColumns('tr:not(.filtered) > td.cused',''));
        $("#totalramused").html(newSumOfColumns('tr:not(.filtered) > td.ramused',''));         
    });

    $("#totalcinstalled").html(sumOfColumns('.cinstalled',''));
    $("#totalraminstalled").html(sumOfColumns('.raminstalled',''));
    $("#totalcactived").html(sumOfColumns('.cactived',''));
    $("#totalramactived").html(sumOfColumns('.ramactived',''));
    $("#totalcfree").html(sumOfColumns('.cfree',''));
    $("#totalramfree").html(sumOfColumns('.ramfree',''));
    $("#totalcused").html(sumOfColumns('.cused',''));
    $("#totalramused").html(sumOfColumns('.ramused',''));
    
   $(".tablepvu").tablesorter({
        headers: {
            1: {filter: false },
            2: {filter: false },
            3: {filter: false },
        },
        widthFixed : true,
        widgets: ["zebra","filter"],
        widgetOptions : {
            filter_columnFilters : true,
            filter_hideFilters : true,
            filter_ignoreCase : true,
            filter_liveSearch : true,
            filter_saveFilters : true,
            filter_useParsedData : false,
            filter_startsWith : false,
            zebra : [ "normal-row", "alt-row" ]
        }
    }).bind('filterEnd',function(e,t){
        $("#totalpvu").html(newSumOfColumns('tr:not(.filtered) > td.pvu',''));
        $("#totalpvurestant").html(newSumOfColumns('tr:not(.filtered) > td.pvurestant',''));
    });

    $("#totalpvu").html(sumOfColumns('.pvu',''));
    $("#totalpvurestant").html(sumOfColumns('.pvurestant',''));
    
    $(document).on('click','#BienSelectAllChassis',function() {
        if($(this).is(':checked')){
            $('#BienChassisId option').prop('selected', 'selected');
        } else {
            $('#BienChassisId option').prop('selected', '');
        }
    });   
    
   $(document).on('click','#BienChassisId',function() {
            $('#BienSelectAllChassis').prop('checked', false);
    }); 
    
   $(document).on('click','#BienSelectAllEnvoutils',function() {
        if($(this).is(':checked')){
            $('#BienEnvoutilId option').prop('selected', 'selected');
        } else {
            $('#BienEnvoutilId option').prop('selected', '');
        }
    });   
    
   $(document).on('click','#BienEnvoutilId',function() {
            $('#BienSelectAllEnvoutils').prop('checked', false);
    }); 
    
    var gaugeOptions = {
        chart: {
            type: 'solidgauge'
        },
        credits: {
            enabled: false
        },
        title: null,
        pane: {
            center: ['50%', '85%'],
            size: '100%',
            startAngle: -90,
            endAngle: 90,
            background: {
                backgroundColor: '#e5e5e5',
                innerRadius: '60%',
                outerRadius: '95%',
                shape: 'arc'
            }
        },
        tooltip: {
            enabled: false
        },
        // the value axis
        yAxis: {
            stops: [
                    [0.1, '#55BF3B'], // green
                    [0.6, '#DDDF0D'], // yellow
                    [0.9, '#DF5353'] // red
                    ],
            lineWidth: 0,
            minorTickInterval: null,
            tickPixelInterval: 200,
            tickWidth: 0,
            title: {
                y: -70
            },
            labels: { 
                enabled:false
            }        
        },        
        plotOptions: {
            solidgauge: {
                dataLabels: {
                    y: 30,
                    borderWidth: 0,
                    useHTML: true
                }
            }
        }
    };
      
   $(document).on("click",".chartpx70s",function(){
        var ctitle = $(this).attr("data-ctitle");
        var cmax = parseInt($(this).attr("data-cmax"));
        var cactive = parseInt($(this).attr("data-cactive"));
        var cinter = parseInt($(this).attr("data-cinter"));
        var cused = parseFloat($(this).attr("data-cused"));
        var cdispo = $(this).attr("data-cdispo");
        if(parseFloat(cdispo) >= 0){
            $('#chartpx70container').highcharts(Highcharts.merge(gaugeOptions, {
                exporting: {
                    filename : ctitle + "_Coeurs utilisés",
                    enabled:false
                },                  
                yAxis: {
                    min: 0,
                    max: cmax, 
                    tickPixelInterval: cmax,
                    label:{
                      step:10  
                    },
                    title: {
                        text: ctitle + "<br>Coeurs utilisés"
                    },
                    plotBands: [{
                    thickness: '5%',
                        from: 0,
                        to: cactive,
                        color: '#55BF3B' // green
                    }, {
                    thickness: '5%',
                        from: cactive,
                        to: cinter,
                        color: '#DDDF0D' // yellow
                    }, {
                    thickness: '5%',
                        from: cinter,
                        to: cmax,
                        color: '#DF5353' // red
                    }]             
                },	
                series: [{
                    name: ctitle,
                    data: [cused],
                    dataLabels: {
                            format: '<div style="text-align:center"><span style="font-size:25px;color:black">{y}</span></div>'
                    },
                }]	
        }));
        } else {
             $('#chartpx70container').html("Donnée sur l'utilisation des coeurs impossible à afficher.");
        }
       var rtitle = $(this).attr("data-ctitle");
       var rmax = parseInt($(this).attr("data-rmax"));
       var ractive = parseInt($(this).attr("data-ractive"));
       var rinter = parseInt($(this).attr("data-rinter"));
       var rused = parseFloat($(this).attr("data-rused"));
       var rdispo = $(this).attr("data-rdispo");
       if(parseFloat(rdispo) >= 0){
        $('#chartramcontainer').highcharts(Highcharts.merge(gaugeOptions, {
            exporting: {
                filename : rtitle + "_Mémoire utilisée",
                enabled:false
            },            
            yAxis: {
                    min: 0,
                    max: rmax, 
                    tickPixelInterval: rmax,
                    label:{
                      step:1000  
                    },                    
                    title: {
                        text: rtitle + "<br>Mémoire utilisée"
                    },
                    plotBands: [{
                    thickness: '5%',
                        from: 0,
                        to: ractive,
                        color: '#55BF3B' // green
                    }, {
                    thickness: '5%',
                        from: ractive,
                        to: rinter,
                        color: '#DDDF0D' // yellow
                    }, {
                    thickness: '5%',
                        from: rinter,
                        to: rmax,
                        color: '#DF5353' // red
                    }]             
                },	
                series: [{
                    name: rtitle,
                    data: [rused],
                    dataLabels: {
                            format: '<div style="text-align:center"><span style="font-size:25px;color:black">{y}</span></div>'
                    },
                }]	
        }));
        } else {
            $('#chartramcontainer').html("Donnée sur l'utilisation de la mémoire impossible à afficher.");
        }      
   });
   
   $(document).on("click",".chartpvu",function(){
         var title_text = $(this).attr("data-title");
        var max = parseInt($(this).attr("data-max"));
        var active = parseInt($(this).attr("data-active"));
        var inter = parseInt($(this).attr("data-inter"));
        var used = parseFloat($(this).attr("data-used"));
        var dispo = $(this).attr("data-dispo");
        console.log(active);console.log(inter);console.log(max);
        if(parseFloat(dispo) >= 0){         
        $('#chartpvucontainer').highcharts(Highcharts.merge(gaugeOptions, {
            exporting: {
                filename : title_text+"_PVU utilisés",
                enabled:false
            },            
            yAxis: {
                    min: 0,
                    max: max,        
                    title: {
                        text: title_text+"<br>PVU utilisés"
                    },
                    stops: [
                        [0.1, '#55BF3B'], // green
                        [0.85, '#DDDF0D'], // yellow
                        [0.95, '#DF5353'] // red
                    ],                    
                    plotBands: [{
                    thickness: '5%',
                        from: 0,
                        to: active,
                        color: '#55BF3B' // green
                    }, {
                    thickness: '5%',
                        from: active,
                        to: inter,
                        color: '#DDDF0D' // yellow
                    }, {
                    thickness: '5%',
                        from: inter,
                        to: max,
                        color: '#DF5353' // red
                    }]             
                },	
                series: [{
                    name: title_text,
                    data: [used],
                    dataLabels: {
                            format: '<div style="text-align:center"><span style="font-size:25px;color:black">{y}</span></div>'
                    },
                }]	
        }));
        } else {
            $('#chartpvucontainer').html("Donnée sur l'utilisation du PVU impossible à afficher.");
        }         
   });   
    
});
</script>