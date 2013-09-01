<div class="actions form">
<?php echo $this->Form->create('Action',array('id'=>'formValidate','class'=>'form-horizontal','inputDefaults' => array('label'=>false,'div' => false))); ?>
    <div class="control-group">
        <label class="control-label sstitre  required" for="ActionDomaineId">Domaine : </label>
        <div class="controls">
            <?php echo $this->Form->select('domaine_id',$domaines,array('data-rule-required'=>'true','data-msg-required'=>"Le domaine est obligatoire",'empty'=>'Choisir un domaine')); ?>                  
        </div>
    </div>
    <div class="navbar">
        <div class="navbar-inner">
            <div class="container" style="margin-top:2px;text-align:center;">
                <?php echo $this->Form->button('Calculer le rapport', array('class' => 'btn btn-primary','type'=>'submit')); ?>   
            </div>
        </div>
    </div>  
<?php echo $this->Form->end(); ?>     
</div>
<?php $israpport = isset($rapportresults) ? count($rapportresults) : 0; ?>
<?php $style = $israpport==0 ? 'style="display:none;"' : ''; ?>
<div id="rapport" <?php echo $style; ?>>
<div id="chartcontainer" style="width:80%; height:500px; margin-left: 10%;"></div>
<br>
<br>
    <div style="font-family:'Lucida Grande', 'Lucida Sans Unicode', Verdana, Arial, Helvetica, sans-serif;font-size:16px;color:#274b6d;fill:#274b6d;text-align: center;" text-anchor="middle" class="highcharts-title" zIndex="4">Nombre d'actions par niveau de risque</div><br>
    <table cellpadding="0" cellspacing="0" class="table table-bordered table-striped">
        <thead>
            <tr>
            <th>Niveau</th>
            <th>Nombre d'action à risque</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($rapportresults as $result): ?>
            <tr>
                <td><?php echo niveauToString($result['Action']['NIVEAU']); ?></td>
                <td><?php echo $result[0]['NB']; ?></td>
            </tr>           
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php if(isset($rapportresults) && $israpport==0) : ?>
<div class="alert alert-block"><b>Aucun résultat pour ce rapport, modifier les paramètres de recherche ...</b></div>
<?php endif; ?>
<script>
$(document).ready(function (){ 
    
    function sumOfColumns(id) {
        var tot = 0;
        $("."+id).each(function() {
          tot += parseFloat($(this).html());
        });
        return tot;
     }   
    
    $("#total").html(sumOfColumns('nbaction'));
    $("#totalrepartition").html(sumOfColumns('nbrepartition'));
    
 
<?php if(isset($chartresults)): ?>
    <?php $nb = array('0'=>0,'1'=>0,'2'=>0,'3'=>0,'4'=>0); ?>
    <?php foreach($chartresults as $result): 
        $nb[0] = isset($result['Action']['NIVEAU']) && $result['Action']['NIVEAU']==1 ? $result[0]['NB'] : $nb[0];
        $nb[1] = isset($result['Action']['NIVEAU']) && $result['Action']['NIVEAU']==2 ? $result[0]['NB'] : $nb[1];
        $nb[2] = isset($result['Action']['NIVEAU']) && $result['Action']['NIVEAU']==3 ? $result[0]['NB'] : $nb[2];
        $nb[3] = isset($result['Action']['NIVEAU']) && $result['Action']['NIVEAU']==4 ? $result[0]['NB'] : $nb[3];
        $nb[4] = isset($result['Action']['NIVEAU']) && $result['Action']['NIVEAU']==5 ? $result[0]['NB'] : $nb[4];
    endforeach; ?>
    <?php $data = "[".$nb[0].','.$nb[1].','.$nb[2].','.$nb[3].','.$nb[4]."]";; ?>
 
    $('#chartcontainer').highcharts({
        chart: {
            polar: true,
            type: 'area'
        },     
        title: {
            text: 'Etude de risques',
        },
        pane: {
            size: '80%'
        },
        xAxis: {
            categories: ['Trés faible', 'Faible', 'Moyen','Fort', 'Très fort'],
            tickmarkPlacement: 'on',
            lineWidth: 0
        },
        yAxis: {
            gridLineInterpolation: 'polygon',
            lineWidth: 0,
            min: 0
        },
        tooltip: {
            formatter: function() {
                return '<b>'+this.y+'</b> risques de niveau <b>'+this.x+'</b> pour <span style="color:'+this.series.color+'">'+this.series.name+'</span>'
            }
	},
        series: [{
            name: $("select[id=ActionDomaineId] option:selected").text(),
            data: <?php echo $data; ?>,
            pointPlacement: 'on'
        }],
        colors: ['#A1006B','#E05206','#CCDC00','#009AA6','#CB0044','#FFB612','#7ABB00','#00BBCE','#6E267B'],        
        credits: {
            enabled: false,
        }        
    });
    <?php endif; ?>
});
</script>