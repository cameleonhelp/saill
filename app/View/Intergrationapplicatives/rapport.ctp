<div class="marginright20">
<div class="actions form">
<?php echo $this->Form->create('Intergrationapplicative',array('id'=>'formValidate','class'=>'form-horizontal','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?>
    <div class='block-panel block-panel-50-left'>
        <div class="form-group">
            <label class="col-lg-4 required" for="IntergrationapplicativeApplicationId">Applications : </label>
            <div class="col-lg-offset-4">
                    <?php echo $this->Form->select('application_id',$applications,array('data-rule-required'=>'true','multiple'=>'true','size'=>"10",'class'=>"form-control multiselect size75",'data-msg-required'=>"L'application est obligatoire")); ?>               
                <br><?php echo $this->Form->input('SelectAll',array('type'=>'checkbox')); ?><label class="labelAfter" for="IntergrationapplicativeSelectAll">&nbsp;Tout sélectionner</label>            
            </div>            
        </div>  
    </div>
    <div class='block-panel block-panel-50-right'>
        <div class="form-group">
            <label class="col-lg-4 required" for="IntergrationapplicativeMois">Mois :</label>
            <div class="col-lg-4">
                    <?php echo $this->Form->select('mois',$mois,array('default'=>date('m'),'class'=>"form-control",'empty'=>false)); ?>           
            </div>            
        </div>
        <div class="form-group">
            <label class="col-lg-4 required" for="IntergrationapplicativeAnnee">Année : </label>
            <div class="col-lg-4">
                    <?php echo $this->Form->select('annee',$annee,array('default'=>date('Y'),'class'=>"form-control",'empty'=>false)); ?>           
            </div>            
        </div>
        <div class="form-group">
            <label class="col-lg-4" for="IntergrationapplicativeEnvironnementId">Environnements : </label>
            <div class="col-lg-4">
                    <?php echo $this->Form->select('environnement_id',$environnements,array('class'=>"form-control",'empty'=>'Tous')); ?>                          
            </div>            
        </div>         
        <div class="form-group">
            <label class="col-lg-4" for="IntergrationapplicativeLotId">Lots : </label>
            <div class="col-lg-4">
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
    <table cellpadding="0" cellspacing="0" class="table table-bordered table-striped sizemax" id="datatable">
        <thead>
            <tr>
                <th>Lot</th>
                <th>Application</th>
                <th>Environnement</th>
                <th>Nombres</th>
            </tr>           
        </thead>
        <tbody>
            <?php foreach($results as $result): ?>
            <tr>
                <td><?php echo $result['lots']['LOT']; ?></td>
                <td><?php echo $result['applications']['APPLICATION']; ?></td>                
                <td><?php echo $result['types']['TYPE']; ?></td> 
                <td width='40px' style='text-align: center' class='totalapp'><?php echo intval($result[0]['NB']); ?></td>
            </tr>           
            <?php endforeach; ?>
        </tbody>
        <tfooter>
	<tr>
            <td class="footer nowrap" colspan='3' style="text-align:right;">Total :</td>
            <td class="footer nowrap" id="totalall" style="text-align:center;"></td>            
	</tr> 
        </tfooter>
    </table>
<?php endif; ?> 
<?php if($israpport==0 && isset($results)): ?> 
    <div class="bs-callout bs-callout-warning"><b>Aucun résultat pour ce rapport, modifier les paramètres de recherche ...</b></div>
<?php endif; ?> 
</div>
<script>
$(document).ready(function (){ 
    
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
    
    function sumOfColumns(id,symbole) {
        var tot = 0;
        $("."+id).each(function() {
          value = $(this).html()=='' ? 0: $(this).html();
          tot += parseFloat(value);
        });
        return parseFloat(tot).toFixed(0)+" "+symbole;
     } 
     
     $("#totalall").html(sumOfColumns('totalapp',''));
     
    <?php if(isset($chartresults)) : ?>   
    
    var env = $("#IntergrationapplicativeEnvironnementId option:selected").text();
    var mois = $("#IntergrationapplicativeMois option:selected").text();
    var annee = $("#IntergrationapplicativeAnnee option:selected").text(); 
    var title = '';
    if(env=='Tous' || env=='TOUS'){
        title = 'Nombre d\'intégration par lot et application pour';
        title2 = 'Progression du nombre d\'intégration pour ';}
    else{
        title = 'Nombre d\'intégration par lot et application en '+env+' pour';
        title2 = 'Progression du nombre d\'intégration en '+env+' pour ';}

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
                       text: 'Nombre d\'intérgation'
                   }
        },
        xAxis: {
            categories: [<?php echo implode(",", $lots); ?>],
            
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
            text: title2+annee
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
                    $mois = ['','Janv.','Fév.','Mars','Avril','Mai','Juin','Juil.','Août','Setp.','Oct.','Nov.','Déc.'];
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
        },   
        yAxis: {
            allowDecimals: false,
            title: {
                       text: 'Nombre d\'intérgation'
                   }
        },   
        tooltip: {
            formatter: function() {
                $moisentier = ['','Janvier','Février','Mars','Avril','Mai','Juin','Juillet','Août','Setpembre','Octobre','Novembre','Décembre'];
                return 'Nombre d\'intégration <b>' + this.y + '</b> pour le mois de <b>' + $moisentier[this.x] + '</b>, tout confondus';
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