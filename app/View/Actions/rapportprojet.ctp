<div class="">
<div class="actions form">
    <?php echo $this->Form->create('Action',array('id'=>'formValidate','class'=>'form-horizontal','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?>
    <div class='block-panel block-panel-50-left'>
        <div class="form-group">
            <label class="col-md-4 required" for="ActionProjets">Projet: </label>
            <div class="col-md-offset-4">
                    <?php echo $this->Form->select('projets',$projets,array('data-rule-required'=>'true','multiple'=>'true','class'=>"form-control multiselect size75",'size'=>"10",'data-msg-required'=>"Le nom du projet est obligatoire",'hiddenField' => false)); ?>               
                <br><?php echo $this->Form->input('SelectAll',array('type'=>'checkbox')); ?><label class="labelAfter" for="ActionSelectAll">&nbsp;Tout sélectionner</label>  
            </div>
        </div>        
    </div>
    <div class='block-panel block-panel-50-right'>
        <div class="form-group">
            <label class="col-md-4 required" for="ActionSTART">Sur la période du: </label>
            <div class="col-md-6">
              <div class="input-group">
              <?php $today = new dateTime(); ?>
              <?php echo $this->Form->input('START',array('type'=>'text','placeholder'=>'ex.: '.$today->format('d/m/Y'),'data-rule-required'=>'true','class'=>"form-control dateall",'data-msg-required'=>"La date de début de période est obligatoire",'error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
              <span class="input-group-addon addon-middle date-addon-clean btn-addon" data-target="#ActionSTART"><span class="glyphicons circle_remove grey"></span></span>
              <span class="input-group-addon addon-middle date-addon-default btn-addon" data-target="#ActionSTART" data-default="<?php echo date('01/m/Y'); ?>"><span class="glyphicons clock"></span></span>
              <span class="input-group-addon date-addon-calendar btn-addon" data-target="#ActionSTART"><span class="glyphicons calendar"></span></span>
              </div>
            </div>  
        </div>  
        <div class="form-group">
            <label class="col-md-4 required" for="ActionEND">au : </label>
            <div class="col-md-6">
              <div class="input-group">
              <?php $today = new dateTime(); ?>
              <?php echo $this->Form->input('END',array('type'=>'text','placeholder'=>'ex.: '.$today->format('d/m/Y'),'data-rule-required'=>'true','class'=>"form-control dateall",'data-msg-required'=>"La date de fin de période est obligatoire",'error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
              <span class="input-group-addon addon-middle date-addon-clean btn-addon" data-target="#ActionEND"><span class="glyphicons circle_remove grey"></span></span>
              <span class="input-group-addon addon-middle date-addon-default btn-addon" data-target="#ActionEND" data-default="<?php echo date('t/m/Y'); ?>"><span class="glyphicons clock"></span></span>
              <span class="input-group-addon date-addon-calendar btn-addon" data-target="#ActionEND"><span class="glyphicons calendar"></span></span>
              </div>
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
<?php $israpport = isset($detailrapportresults) ? count($detailrapportresults) : 0; ?>
<?php $style = $israpport==0 ? 'style="display:none;"' : ''; ?>
<div id="rapport" <?php echo $style; ?>>
    <?php $index = count($chartresults) > 2 ? 0 : 1; ?>
    <div class="pull-right"><?php echo $this->Html->link('<span class="ico-doc" style="vertical-align: baseline;"></span> Enregistrer',array('action'=>'export_doc'), array('type'=>'button','class' => 'btn btn-sm btn-default','escape' => false)); ?></div>
<div id="chartcontainer" style="width:80%; height:500px; margin-left: 10%;"></div>
<br>
<br>
    <div style="font-family:'Lucida Grande', 'Lucida Sans Unicode', Verdana, Arial, Helvetica, sans-serif;font-size:16px;color:#274b6d;fill:#274b6d;text-align: center;" text-anchor="middle" class="highcharts-title" zIndex="4">Détail des actions par mois pour le CRA client</div><br>
    <table cellpadding="0" cellspacing="0" class="table table-bordered tablemax">
        <thead>
            <tr>
            <th>Période</th>
            <th>Projet</th>
            <th>Domaine</th>
            <th>Objet</th>
            </tr>
        </thead>
        <tbody>
            <?php if(count($detailrapportresults)>0): ?>
            <?php foreach($detailrapportresults as $result): ?>
            <tr>
                <td><?php echo strMonth($result[0]['MONTH']).' '.$result[0]['YEAR']; ?></td>
                <td><?php echo $result['Action']['projet_nom']; ?></td>
                <td><?php echo $result['Domaine']['NOM']; ?></td>
                <td><?php echo $result['Action']['OBJET']; ?></td>
            </tr>           
            <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>    
</div>

<?php if(isset($detailrapportresults) && $israpport==0) : ?>
<div class="bs-callout bs-callout-warning"><b>Aucun résultat pour ce rapport, modifier les paramètres de recherche ...</b></div>
<?php endif; ?>
</div>
<script>
$(document).ready(function (){ 
   $("table").tablesorter({
        headers: {
            0: {
                sorter: 'mois-annee'
            }
        }
    });
   
   $(document).on('click','#ActionSelectAll',function() {
        if($(this).is(':checked')){
            $('#ActionProjets option').prop('selected', 'selected');
        } else {
            $('#ActionProjets option').prop('selected', '');
        }
   });   
    
   $(document).on('click','#ActionProjets',function() {
            $('#ActionSelectAll').prop('checked', false);
    }); 
    
<?php if(isset($chartresults)): ?>
    <?php foreach($chartresults as $result): 
       $data[] = "[".$result[0]['MONTH'].",".$result[0]['NB']."]";
    endforeach; ?>
    <?php 
        $strmonth = "'','Janv.','Fév.','Mars','Avril','Mai','Juin','Juil.','Août','Setp.','Oct.','Nov.','Déc.'";
    ?>

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
                $moisentier = ['','Janvier','Février','Mars','Avril','Mai','Juin','Juillet','Août','Setpembre','Octobre','Novembre','Décembre'];
                return 'Nombre d\'actions <b>' + this.y + '</b> pour le mois de <b>' + $moisentier[this.x] + '</b>, tout états confondus';
            }
        },
        title: {
            text: 'Nombre d\'actions par mois'
        },
        xAxis: {
            title: {
                text: 'Mois'
            },            
            labels: {
                formatter: function() {
                    $mois = [<?php echo $strmonth; ?>];
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
            title: {
                text: 'Nombre d\'actions'
            },
            tickInterval: 1
        },         
        series: [{
            name: 'Actions (tout état)',
            data: [<?php echo join($data, ',') ?>]
        }],
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