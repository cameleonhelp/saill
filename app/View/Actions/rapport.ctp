<div class="actions form">
<?php echo $this->Form->create('Action',array('id'=>'formValidate','class'=>'form-horizontal','inputDefaults' => array('label'=>false,'div' => false))); ?>
    <table>
        <tr>
            <td><label class="control-label sstitre  required" for="ActionDestinataire">Responsable: </label></td>
            <td>
                    <?php echo $this->Form->select('destinataire',$destinataires,array('data-rule-required'=>'true','data-msg-required'=>"Le nom du responsable est obligatoire", 'empty' => 'Choisir un responsable')); ?>               
            </td>
            <td><label class="control-label sstitre  required" for="ActionDomaineId">Domaine : </label></td>
            <td>
                    <?php echo $this->Form->select('domaine_id',$domaines,array('data-rule-required'=>'true','data-msg-required'=>"Le domaine est obligatoire", 'empty' => 'Choisir un domaine')); ?>               
            </td>            
        </tr>        
        <tr>
            <td><label class="control-label sstitre  required" for="ActionSTART">Sur la période du: </label></td>
            <td>
                <div class="input-prepend date" data-date="<?php echo date('d/m/Y'); ?>" data-date-format="dd/mm/yyyy">
                <?php $today = new dateTime(); ?>
                <span class="add-on"><i class="glyphicon_calendar"></i></span>             
                <?php echo $this->Form->input('START',array('type'=>'text','placeholder'=>'ex.: '.$today->format('d/m/Y'),'class'=>"span5","readonly"=>'true','data-rule-required'=>'true','data-msg-required'=>"La date de début de période est obligatoire",'error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
                </div>  
            </td>
            <td><label class="control-label sstitre  required" for="ActionEND">au : </label></td>
            <td>
                <div class="input-prepend date" data-date="<?php echo date('d/m/Y'); ?>" data-date-format="dd/mm/yyyy">
                <?php $today->add(new DateInterval('P1M')); ?>
                <span class="add-on"><i class="glyphicon_calendar"></i></span>             
                <?php echo $this->Form->input('END',array('type'=>'text','placeholder'=>'ex.: '.$today->format('d/m/Y'),'class'=>"span5","readonly"=>'true','data-rule-required'=>'true','data-msg-required'=>"La date de fin de période est obligatoire",'error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
                </div> 
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
<?php $israpport = isset($rapportresults) ? count($rapportresults) : 0; ?>
<?php $style = $israpport==0 ? 'style="display:none;"' : ''; ?>
<div id="rapport" <?php echo $style; ?>>
    <div class="pull-right"><?php echo $this->Html->link('<i class="ico-doc"></i> Enregistrer',array('action'=>'export_doc'), array('type'=>'button','class' => 'btn','escape' => false)); ?></div>
<div id="chartcontainer" style="width:80%; height:400px; margin-left: 10%;"></div>
<br>
    <div style="font-family:'Lucida Grande', 'Lucida Sans Unicode', Verdana, Arial, Helvetica, sans-serif;font-size:16px;color:#274b6d;fill:#274b6d;text-align: center;" text-anchor="middle" class="highcharts-title" zIndex="4">Nombre d'actions par mois, par destinataire et par état</div><br>
    <table cellpadding="0" cellspacing="0" class="table table-bordered table-striped">
        <thead>
            <tr>
            <th>Période</th>
            <th>Destinataire</th>
            <th width="50px">Nombre</th>
            <th>Etat</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($rapportresults as $result): ?>
            <tr>
                <td><?php echo strMonth($result[0]['MONTH']).' '.$result[0]['YEAR']; ?></td>
                <td><?php echo $result['Utilisateur']['NOM'].' '.$result['Utilisateur']['PRENOM']; ?></td>
                <td style="text-align:center" class="nbaction"><?php echo $result[0]['NB']; ?></td>
                <td style="text-align:center"><?php echo ucfirst_utf8($result['Action']['STATUT']); ?></td> 
            </tr>           
            <?php endforeach; ?>
        </tbody>
        <tfooter>
	<tr>
            <td colspan="2" class="footer" style="text-align:right;">Total :</td>
            <td class="footer" id="total" style="text-align:center;"></td>
            <td class="footer" width="90px" style="text-align:left;">actions</td>
	</tr> 
        </tfooter>
    </table>
<br>
    <div style="font-family:'Lucida Grande', 'Lucida Sans Unicode', Verdana, Arial, Helvetica, sans-serif;font-size:16px;color:#274b6d;fill:#274b6d;text-align: center;" text-anchor="middle" class="highcharts-title" zIndex="4">Détail des actions par mois</div><br>
    <table cellpadding="0" cellspacing="0" class="table table-bordered table-striped">
        <thead>
            <tr>
            <th>Période</th>
            <th>Objet</th>
            <th>Etat</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($detailrapportresults as $result): ?>
            <tr>
                <td><?php echo strMonth($result[0]['MONTH']).' '.$result[0]['YEAR']; ?></td>
                <td><?php echo $result['Action']['OBJET']; ?></td>
                <td style="text-align:center"><?php echo ucfirst_utf8($result['Action']['STATUT']); ?></td> 
            </tr>           
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<script>
$(document).ready(function (){ 
    
    function sumOfColumns() {
        var tot = 0;
        $(".nbaction").each(function() {
          tot += parseFloat($(this).html());
        });
        return tot;
     }    
    
    function addMonth($date,$nb){
        var dateTimeSplit = $date.split(' ');
        var dateSplit = dateTimeSplit[0].split('/');
        var mois = (parseInt(dateSplit[1])+$nb) < 10 ? "0"+(parseInt(dateSplit[1])+$nb) : (parseInt(dateSplit[1])+$nb);
        var currentDate = dateSplit[0] + '/' + mois + '/' + dateSplit[2];
        return currentDate;
    }
    
    $("#total").html(sumOfColumns());
    
    $(document).on('change','#ActionSTART',function(e){
        newDate = addMonth($(this).val(),1);
        $('#ActionEND').val(newDate);
        $('#ActionEND').datepicker('update', newDate);
        $('#ActionEND').focus();
    })    

    <?php foreach($chartresults as $result): 
       $data[] = "[".$result[0]['MONTH'].",".$result[0]['NB']."]";
    endforeach; ?>
    
    
    $('#chartcontainer').highcharts({
        chart: {
            type: 'column', 
        },  
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
            text: 'Nombre d\'actions'
        },
        subtitle:{
               text:'(de '+$('#ActionDestinataire :selected').text().toLowerCase()+', sur '+$('#ActionDomaineId :selected').text().toLowerCase()+' et de tous les états)'
        },
        xAxis: {
            title: {
                text: 'Mois'
            },            
            labels: {
                formatter: function() {
                    $mois = ['','Janv.','Fév.','Mars','Avril','Mai','Juin','Juil.','Août','Setp.','Oct.','Nov.','Déc.'];
                    return $mois[this.value];
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
        }]
    });
});
</script>