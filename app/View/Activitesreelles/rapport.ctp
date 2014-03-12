<div class="">
<div class="actions form">
<?php echo $this->Form->create('Activitesreelle',array('id'=>'formValidate','class'=>'form-horizontal','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?>
    <div class='block-panel block-panel-50-left'>
        <div class="form-group">
            <label class="col-md-4 required" for="ActivitesreelleUtilisateurId">Utilisateur: </label>
            <div class="col-md-offset-4">
                    <?php echo $this->Form->select('utilisateur_id',$destinataires,array('data-rule-required'=>'true','multiple'=>'true','class'=>"form-control multiselect size75",'size'=>"10",'data-msg-required'=>"Le nom de l'utilisateur est obligatoire",'hiddenField' => false)); ?>               
                <br><?php echo $this->Form->input('SelectAll',array('type'=>'checkbox')); ?><label class="labelAfter" for="ActivitesreelleSelectAll">&nbsp;Tout sélectionner</label>  
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 required" for="ActivitesreelleSTART">Sur la période du: </label>
            <div class="col-md-6">
              <div class="input-group">
              <?php $today = new dateTime(); ?>
              <?php echo $this->Form->input('START',array('type'=>'text','placeholder'=>'ex.: '.$today->format('d/m/Y'),'data-rule-required'=>'true','class'=>"form-control dateall",'data-msg-required'=>"La date de début de Début de période est obligatoire",'error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
              <span class="input-group-addon addon-middle date-addon-clean btn-addon" data-target="#ActivitesreelleSTART"><span class="glyphicons circle_remove grey"></span></span>
              <span class="input-group-addon addon-middle date-addon-default btn-addon" data-target="#ActivitesreelleSTART" data-default="<?php echo date('01/m/Y'); ?>"><span class="glyphicons clock"></span></span>
              <span class="input-group-addon date-addon-calendar btn-addon" data-target="#ActivitesreelleSTART"><span class="glyphicons calendar"></span></span>
              </div>
            </div>  
        </div>          
    </div>
    <div class='block-panel block-panel-50-right'>
        <div class="form-group">
            <label class="col-md-4 required" for="ActivitesreelleProjetId">Projet : </label>
            <div class="col-md-offset-4">
                    <?php echo $this->Form->select('projet_id',$domaines,array('data-rule-required'=>'true','multiple'=>'true','size'=>"10",'class'=>"form-control multiselect size75",'data-msg-required'=>"Le projet est obligatoire")); ?>               
                <br><?php echo $this->Form->input('SelectAllProjet',array('type'=>'checkbox')); ?><label class="labelAfter" for="ActivitesreelleSelectAllProjet">&nbsp;Tout sélectionner</label>            
            </div>            
        </div>
        <div class="form-group">
            <label class="col-md-4 required" for="ActivitesreelleEND">au : </label>
            <div class="col-md-6">
              <div class="input-group">
              <?php $today = new dateTime(); ?>
              <?php echo $this->Form->input('END',array('type'=>'text','placeholder'=>'ex.: '.$today->format('d/m/Y'),'data-rule-required'=>'true','class'=>"form-control dateall",'data-msg-required'=>"La date de fin de Début de période est obligatoire",'error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
              <span class="input-group-addon addon-middle date-addon-clean btn-addon" data-target="#ActivitesreelleEND"><span class="glyphicons circle_remove grey"></span></span>
              <span class="input-group-addon addon-middle date-addon-default btn-addon" data-target="#ActivitesreelleEND" data-default="<?php echo date('t/m/Y'); ?>"><span class="glyphicons clock"></span></span>
              <span class="input-group-addon date-addon-calendar btn-addon" data-target="#ActivitesreelleEND"><span class="glyphicons calendar"></span></span>
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
<?php $israpport = isset($rapportresults) ? count($rapportresults) : 0; ?>
<?php $style = $israpport==0 ? 'style="display:none;"' : ''; ?>
<?php 
?>

<div id="rapport" <?php echo $style; ?>>
    <div class="pull-right"><?php echo $this->Html->link('<span class="ico-doc" style="vertical-align: baseline;"></span> Enregistrer',array('action'=>'export_doc'), array('type'=>'button','class' => 'btn btn-sm btn-default','escape' => false)); ?></div>
    <div id="chartcontainer" style="width:80%; height:500px; margin-left: 10%;"></div>
<br><br>
    <div style="font-family:'Lucida Grande', 'Lucida Sans Unicode', Verdana, Arial, Helvetica, sans-serif;font-size:16px;color:#274b6d;fill:#274b6d;text-align: center;" text-anchor="middle" class="highcharts-title" zIndex="4">Nombre de jour réels consommés par projet</div><br>
    <table cellpadding="0" cellspacing="0" class="table table-bordered tablemax">
        <thead>
            <tr>
            <th>Début de période</th>
            <th>Projet</th>
            <th>Nombre</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($rapportresults as $result): ?>
            <tr>
                <td><?php echo strMonth($result[0]['MONTH']).' '.$result[0]['YEAR']; ?></td>
                <td><?php echo $result['Activitesreelle']['projet_NOM']; ?></td>
                <?php 
                    $nbaction = $result[0]['NB'];
                    foreach($byprojet as $item):
                        if($result['Activite']['projet_id']==$item['projet_id'] && $result[0]['MONTH']==$item['mois']):
                            $nbaction -= $item['sum'];
                            $nbaction = number_format($nbaction, 1);
                        endif;
                    endforeach;
                ?>
                <td style="text-align:center" class="nbaction"><?php echo $nbaction; ?></td>
            </tr>           
            <?php endforeach; ?>
        </tbody>
        <tfooter>
	<tr>
            <td colspan="2" class="footer" style="text-align:right;">Total :</td>
            <td class="footer" id="total" style="text-align:center;"></td>
	</tr> 
        </tfooter>
    </table>
<br>
    <div style="font-family:'Lucida Grande', 'Lucida Sans Unicode', Verdana, Arial, Helvetica, sans-serif;font-size:16px;color:#274b6d;fill:#274b6d;text-align: center;" text-anchor="middle" class="highcharts-title" zIndex="4">Nombre de jour réels consommés par projet et par domaines</div><br>
    <table cellpadding="0" cellspacing="0" class="table table-bordered tablemax">
        <thead>
            <tr>
            <th>Début de période</th>
            <th>Projet</th>
            <th>Domaine</th>
            <th>Nombre</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($rapportdomainesresults as $result): ?>
            <tr>
                <td><?php echo strMonth($result[0]['MONTH']).' '.$result[0]['YEAR']; ?></td>
                <td><?php echo $result['Activitesreelle']['projet_NOM']; ?></td>
                <td><?php echo $result['Domaine']['NOM']; ?></td>
                <?php 
                    $nbaction = $result[0]['NB'];
                    foreach($byprojetdomaine as $item):
                        if($result['Activite']['projet_id']==$item['projet_id'] && $result['Activitesreelle']['domaine_id']==$item['domaine_id'] && $result[0]['MONTH']==$item['mois']):
                            $nbaction -= $item['sum'];
                            $nbaction = number_format($nbaction, 1);
                        endif;
                    endforeach;
                ?>
                <td style="text-align:center" class="nbactionbydomaine"><?php echo $nbaction; ?></td>
            </tr>           
            <?php endforeach; ?>
        </tbody>
        <tfooter>
	<tr>
            <td colspan="3" class="footer" style="text-align:right;">Total :</td>
            <td class="footer" id="totalbydomaine" style="text-align:center;"></td>
	</tr> 
        </tfooter>
    </table>
<br>
    <div style="font-family:'Lucida Grande', 'Lucida Sans Unicode', Verdana, Arial, Helvetica, sans-serif;font-size:16px;color:#274b6d;fill:#274b6d;text-align: center;" text-anchor="middle" class="highcharts-title" zIndex="4">Nombre de jours réels consommés par projet et activité</div><br>
    <table cellpadding="0" cellspacing="0" class="table table-bordered tablemax">
        <thead>
            <tr>
            <th>Début de période</th>
            <th>Projet</th>
            <th>Activité</th>
            <th>Nombre</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($detailrapportresults as $result): ?>
            <tr>
                <td><?php echo strMonth($result[0]['MONTH']).' '.$result[0]['YEAR']; ?></td>
                <td><?php echo $result['Activitesreelle']['projet_NOM']; ?></td>
                <td><?php echo $result['Activite']['NOM']; ?></td>
                <?php 
                    $nbaction = $result[0]['NB'];
                    foreach($byprojetactivite as $item):
                        if($result['Activite']['projet_id']==$item['projet_id'] && $result['Activite']['id']==$item['activite_id'] && $result[0]['MONTH']==$item['mois']):
                            $nbaction -= $item['sum'];
                            $nbaction = number_format($nbaction, 1);
                        endif;
                    endforeach;
                ?>
                <td style="text-align:center" class="nbactiondetail"><?php echo $nbaction; ?></td>
            </tr>           
            <?php endforeach; ?>
        </tbody>
        <tfooter>
	<tr>
            <td colspan="3" class="footer" style="text-align:right;">Total :</td>
            <td class="footer" id="totaldetail" style="text-align:center;"></td>
	</tr> 
        </tfooter>        
    </table>
</div>
<?php if(isset($rapportresults) && $israpport==0) : ?>
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
    
    $(document).on('click','#ActivitesreelleSelectAll',function() {
        if($(this).is(':checked')){
            $('#ActivitesreelleUtilisateurId option').prop('selected', 'selected');
        } else {
            $('#ActivitesreelleUtilisateurId option').prop('selected', '');
        }
    });   
    
   $(document).on('click','#ActivitesreelleUtilisateurId',function() {
            $('#ActivitesreelleSelectAll').prop('checked', false);
    }); 
    
   $(document).on('click','#ActivitesreelleSelectAllProjet',function() {
        if($(this).is(':checked')){
            $('#ActivitesreelleProjetId option').prop('selected', 'selected');
        } else {
            $('#ActivitesreelleProjetId option').prop('selected', '');
        }
    });   
    
   $(document).on('click','#ActivitesreelleProjetId',function() {
            $('#ActivitesreelleSelectAllProjet').prop('checked', false);
    }); 
    
    function sumOfColumns(id) {
        var tot = 0;
        $("."+id).each(function() {
          tot += parseFloat($(this).html());
        });
        return tot.toFixed(2)+' jours';
     }    
        
    $("#total").html(sumOfColumns('nbaction'));
    $("#totalbydomaine").html(sumOfColumns('nbactionbydomaine'));
    $("#totaldetail").html(sumOfColumns('nbactiondetail'));
 
<?php if(isset($chartresults)): ?>
    <?php foreach($chartresults as $result): 
        $nbaction = $result[0]['NB'];
        foreach($byprojet as $item):
            if($result['Activite']['projet_id']==$item['projet_id']):
                $nbaction -= $item['sum'];
            endif;
        endforeach;
       $data[] = $nbaction;
       $categories[] = "'".$result['Activitesreelle']['projet_NOM']."'";
    endforeach; ?>
    
    
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
                return 'Nombre de jours réels consommés <b>' + this.y + '</b> jours sur <b>' + this.x + '</b>, toutes activités confondues';
            }
        },
        title: {
            text: 'Nombre de jours réels consommés'
        },
        subtitle:{
               text:'(par projet)'
        },
        xAxis: {
            name :'Projets',         
            categories : [<?php echo join($categories, ',') ?>],
            labels: {
                rotation: -45,
                align: 'right',
                style: {
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }
        },
        yAxis: {
            title: {
                text: 'Nombre de jours réels consommés'
            },
            tickInterval: 50
        },         
        series: [{
            name: 'Consommation réelles',
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