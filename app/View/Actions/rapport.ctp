<div class="">
<div class="actions form">
    <?php echo $this->Form->create('Action',array('id'=>'formValidate','class'=>'form-horizontal','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?>
    <div class='block-panel block-panel-50-left'>
        <div class="form-group">
            <label class="col-md-4 required" for="ActionDestinataire">Responsable: </label>
            <div class="col-md-offset-4">
                    <?php echo $this->Form->select('destinataire',$destinataires,array('data-rule-required'=>'true','multiple'=>'true','class'=>"form-control multiselect size75",'size'=>"10",'data-msg-required'=>"Le nom du responsable est obligatoire",'hiddenField' => false)); ?>               
                <br><?php echo $this->Form->input('SelectAll',array('type'=>'checkbox')); ?><label class="labelAfter" for="ActionSelectAll">&nbsp;Tout sélectionner</label>  
            </div>
        </div>
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
            <label class="col-md-4 required"  for="ActionRepartitionUtilisateur">Afficher répartition par utilisateur : </label>
            <?php echo $this->Form->input('RepartitionUtilisateur',array('type'=>'checkbox','class'=>'yesno')); ?>&nbsp;<label class="labelAfter" for="ActionRepartitionUtilisateur"></label>            
        </div>         
    </div>
    <div class='block-panel block-panel-50-right'>
        <div class="form-group">
            <label class="col-md-4 required" for="ActionDomaineId">Domaine : </label>
            <div class="col-md-offset-4">
                    <?php echo $this->Form->select('domaine_id',$domaines,array('data-rule-required'=>'true','multiple'=>'true','size'=>"10",'class'=>"form-control multiselect size75",'data-msg-required'=>"Le domaine est obligatoire")); ?>               
                <br><?php echo $this->Form->input('SelectAllDomaine',array('type'=>'checkbox')); ?><label class="labelAfter" for="ActionSelectAllDomaine">&nbsp;Tout sélectionner</label>            
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
        <div class="form-group">
            <label class="col-md-4 required"  for="ActionDetail">Rapport Détaillé : </label>
            <?php echo $this->Form->input('Rapportdetail',array('type'=>'checkbox','class'=>'yesno','value'=>1)); ?>&nbsp;<label class="labelAfter" for="ActionRapportdetail"></label>            
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
<?php $israpport = isset($rapportresults) ? count($rapportresults) : 0; ?>
<?php $style = $israpport==0 ? 'style="display:none;"' : ''; ?>
<div id="rapport" <?php echo $style; ?>>
    <?php $index = count($chartresults) > 2 ? 0 : 1; ?>
    <div class="pull-right"><?php echo $this->Html->link('<span class="ico-doc" style="vertical-align: baseline;"></span> Enregistrer',array('action'=>'export_doc'), array('type'=>'button','class' => 'btn btn-sm btn-default','escape' => false)); ?></div>
<div id="chartcontainer" style="width:80%; height:500px; margin-left: 10%;"></div>
<br>
<br>
    <div style="font-family:'Lucida Grande', 'Lucida Sans Unicode', Verdana, Arial, Helvetica, sans-serif;font-size:16px;color:#274b6d;fill:#274b6d;text-align: center;" text-anchor="middle" class="highcharts-title" zIndex="4">Détail des actions par mois</div><br>
    <table cellpadding="0" cellspacing="0" class="table table-bordered tablemax table1">
        <thead>
            <tr>
            <th width="10px"></th>
            <th>Période</th>
            <th>Domaine</th>
            <th>Objet</th>
            <th>Etat</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($detailrapportresults as $result): ?>
            <tr>
                <?php $tooltip = $result['Action']['NIVEAU'] != null ? 'Risque identifié de niveau '.$result['Action']['NIVEAU'].' / 5' : 'Aucun risque identifié' ; ?>
                <td style="background-color:<?php echo colorNiveauRisque($result['Action']['NIVEAU']) ?>"><span class="cursor" style="display:block;" rel='tooltip' data-title="<?php echo $tooltip; ?>">&nbsp;</span></td>
                <td><?php echo strMonth($result[0]['MONTH']).' '.$result[0]['YEAR']; ?></td>
                <td><?php echo $result['Domaine']['NOM']; ?></td>
                <td><?php echo $result['Action']['OBJET']; ?></td>
                <td style="text-align:center"><?php echo ucfirst_utf8($result['Action']['STATUT']); ?></td> 
            </tr>           
            <?php endforeach; ?>
        </tbody>
    </table>
    <br>
    <div style="font-family:'Lucida Grande', 'Lucida Sans Unicode', Verdana, Arial, Helvetica, sans-serif;font-size:16px;color:#274b6d;fill:#274b6d;text-align: center;" text-anchor="middle" class="highcharts-title" zIndex="4">Détail des actions par mois pour le CRA client</div><br>
    <table cellpadding="0" cellspacing="0" class="table table-bordered tablemax table2">
        <thead>
            <tr>
            <th>Période</th>
            <th>Domaine</th>
            <th>Objet</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($detailrapportresults as $result): ?>
            <tr>
                <td><?php echo strMonth($result[0]['MONTH']).' '.$result[0]['YEAR']; ?></td>
                <td><?php echo $result['Domaine']['NOM']; ?></td>
                <td><?php echo $result['Action']['OBJET']; ?></td>
            </tr>           
            <?php endforeach; ?>
        </tbody>
    </table>    
    <br>
    <div style="font-family:'Lucida Grande', 'Lucida Sans Unicode', Verdana, Arial, Helvetica, sans-serif;font-size:16px;color:#274b6d;fill:#274b6d;text-align: center;" text-anchor="middle" class="highcharts-title" zIndex="4">Nombre d'actions par mois, par destinataire et par état</div><br>
    <table cellpadding="0" cellspacing="0" class="table table-bordered tablemax">
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
                <td><?php echo $result['Action']['destinataire_nom']; ?></td>
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
    <?php if (isset($repartitions)): ?>
    <br />
        <div style="font-family:'Lucida Grande', 'Lucida Sans Unicode', Verdana, Arial, Helvetica, sans-serif;font-size:16px;color:#274b6d;fill:#274b6d;text-align: center;" text-anchor="middle" class="highcharts-title" zIndex="4">Nombre d'actions par mois, par destinataire, par domaine et par état</div><br>
    <table cellpadding="0" cellspacing="0" class="table table-bordered tablemax table2">
        <thead>
            <tr>
            <th>Période</th>
            <th>Utilisateur</th>
            <th>Domaine</th>
            <th width="50px">Nombre</th>
            <th>Etat</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($repartitions as $result): ?>
            <tr>              
                <td><?php echo strMonth($result[0]['MONTH']).' '.$result[0]['YEAR']; ?></td>
                <td><?php echo $result['Action']['destinataire_nom']; ?></td>
                <td><?php echo $result['Domaine']['NOM']; ?></td>
                <td style="text-align:center" class="nbrepartition"><?php echo $result[0]['NB']; ?></td> 
                <td style="text-align:center"><?php echo ucfirst_utf8($result['Action']['STATUT']); ?></td> 
            </tr>           
            <?php endforeach; ?>
        </tbody>  
        <tfooter>
	<tr>
            <td colspan="3" class="footer" style="text-align:right;">Total :</td>
            <td class="footer" id="totalrepartition" style="text-align:center;"></td>
            <td class="footer"> actions</td>
	</tr> 
        </tfooter>          
    </table>
    <?php endif; ?>   
    <?php if (isset($details)): ?>
    <br />
        <div style="font-family:'Lucida Grande', 'Lucida Sans Unicode', Verdana, Arial, Helvetica, sans-serif;font-size:16px;color:#274b6d;fill:#274b6d;text-align: center;" text-anchor="middle" class="highcharts-title" zIndex="4">Rapport détaillé des actions par utilisateur</div><br>
    <table cellpadding="0" cellspacing="0" class="table table-bordered tablemax">
        <thead>
            <tr>
            <th width="10px"></th>
            <th>Période</th>
            <th>Utilisateur</th>
            <th>Domaine</th>
            <th>Action</th>
            <th>Etat</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($details as $result): ?>
            <tr>
                <?php $tooltip = $result['Action']['NIVEAU'] != null ? 'Risque identifié de niveau '.$result['Action']['NIVEAU'].' / 5' : 'Aucun risque identifié' ; ?>
                <td style="background-color:<?php echo colorNiveauRisque($result['Action']['NIVEAU']) ?>"><span class="cursor" style="display:block;" rel='tooltip' data-title="<?php echo $tooltip; ?>">&nbsp;</span></td>                
                <td><?php echo strMonth($result[0]['MONTH']).' '.$result[0]['YEAR']; ?></td>
                <td><?php echo $result['Action']['destinataire_nom']; ?></td>
                <td><?php echo $result['Domaine']['NOM']; ?></td>
                <td><?php echo $result['Action']['OBJET'].'<br>'.$result['Action']['COMMENTAIRE']; ?></td> 
                <td style="text-align:center"><?php echo ucfirst_utf8($result['Action']['STATUT']); ?></td> 
            </tr>           
            <?php endforeach; ?>
        </tbody>          
    </table>

    <?php endif; ?>         
</div>

<?php if(isset($rapportresults) && $israpport==0) : ?>
<div class="bs-callout bs-callout-warning"><b>Aucun résultat pour ce rapport, modifier les paramètres de recherche ...</b></div>
<?php endif; ?>
</div>
<script>
$(document).ready(function (){ 
   $(".table2").tablesorter({
        headers: {
            0: {
                sorter: 'mois-annee'
            }
        }
    });
   
   $(".table1").tablesorter({
        headers: {
            1: {
                sorter: 'mois-annee'
            }
        }
    });
    
   $(document).on('click','#ActionSelectAll',function() {
        if($(this).is(':checked')){
            $('#ActionDestinataire option').prop('selected', 'selected');
        } else {
            $('#ActionDestinataire option').prop('selected', '');
        }
   });   
    
   $(document).on('click','#ActionDestinataire',function() {
            $('#ActionSelectAll').prop('checked', false);
    }); 
    
   $(document).on('click','#ActionSelectAllDomaine',function() {
        if($(this).is(':checked')){
            $('#ActionDomaineId option').prop('selected', 'selected');
        } else {
            $('#ActionDomaineId option').prop('selected', '');
        }
    });   
    
   $(document).on('click','#ActionDomaineId',function() {
            $('#ActionSelectAllDomaine').prop('checked', false);
    }); 
    
    function sumOfColumns(id) {
        var tot = 0;
        $("."+id).each(function() {
          tot += parseFloat($(this).html());
        });
        return tot.toFixed(2);
     }   
        
    $("#total").html(sumOfColumns('nbaction'));
    $("#totalrepartition").html(sumOfColumns('nbrepartition'));
      
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
            text: 'Nombre d\'actions'
        },
        subtitle:{
               text:'(des utilisateurs, sur les domaines et pour tous les états)'
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