<div class="actions form">
<?php echo $this->Form->create('Facturation',array('id'=>'formValidate','class'=>'form-horizontal','inputDefaults' => array('label'=>false,'div' => false))); ?>
    <table>
        <tr>
            <td ><label class="control-label sstitre  required" for="FacturationUtilisateurId">Utilisateur: </label></td>
            <td >
                    <?php echo $this->Form->select('utilisateur_id',$destinataires,array('data-rule-required'=>'true','multiple'=>'true','size'=>"10",'data-msg-required'=>"Le choix d'un utilisateur est obligatoire")); ?>               
                <br><?php echo $this->Form->input('SelectAll',array('type'=>'checkbox')); ?><label class="labelAfter" for="FacturationSelectAll">&nbsp;Tout sélectionner</label>
            </td>
            <td style="height:54px !important;"><label class="control-label sstitre  required" for="FacturationProjetId">Projet : </label></td>
            <td>
                    <?php echo $this->Form->select('projet_id',$domaines,array('data-rule-required'=>'true','multiple'=>'true','size'=>"10",'data-msg-required'=>"Le projet est obligatoire")); ?>               
                <br><?php echo $this->Form->input('SelectAllProjet',array('type'=>'checkbox')); ?><label class="labelAfter" for="FacturationSelectAllProjet">&nbsp;Tout sélectionner</label>            
            </td>            
        </tr>        
        <tr>
            <td><label class="control-label sstitre  required" for="FacturationSTART">Sur la période du: </label></td>
            <td>
                <div class="input-prepend date" data-date="<?php echo date('d/m/Y'); ?>" data-date-format="dd/mm/yyyy">
                <?php $today = new dateTime(); ?>
                <span class="add-on"><span class="glyphicons calendar"></span></span>             
                <?php echo $this->Form->input('START',array('type'=>'text','placeholder'=>'ex.: '.$today->format('d/m/Y'),"readonly"=>'true','data-rule-required'=>'true','data-msg-required'=>"La date de début de période est obligatoire",'error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
                </div>  
            </td>           
            <td><label class="control-label sstitre  required" for="FacturationEND">au : </label></td>
            <td>
                <div class="input-prepend date" data-date="<?php echo date('d/m/Y'); ?>" data-date-format="dd/mm/yyyy">
                <?php $today->add(new DateInterval('P1M')); ?>
                <span class="add-on"><span class="glyphicons calendar"></span></span>             
                <?php echo $this->Form->input('END',array('type'=>'text','placeholder'=>'ex.: '.$today->format('d/m/Y'),"readonly"=>'true','data-rule-required'=>'true','data-msg-required'=>"La date de fin de période est obligatoire",'error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
                </div> 
            </td>            
        </tr> 
        <tr>
            <td><label class="control-label sstitre  required"  for="FacturationRepartitionUtilisateur">Afficher répartition activité par utilisateur : </label></td>
            <td>
                <?php echo $this->Form->input('RepartitionUtilisateur',array('type'=>'checkbox','class'=>'yesno')); ?>&nbsp;<label class="labelAfter" for="FacturationRepartitionUtilisateur"></label>            
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
    <div class="pull-right"><?php echo $this->Html->link('<span class="ico-doc icon-top2"></span> Enregistrer',array('action'=>'export_doc'), array('type'=>'button','class' => 'btn','escape' => false)); ?></div>
    <div id="chartcontainer" style="width:80%; height:500px; margin-left: 10%;"></div>
<br><br>
    <div style="font-family:'Lucida Grande', 'Lucida Sans Unicode', Verdana, Arial, Helvetica, sans-serif;font-size:16px;color:#274b6d;fill:#274b6d;text-align: center;" text-anchor="middle" class="highcharts-title" zIndex="4">Nombre de jour facturés par projet</div><br>
    <table cellpadding="0" cellspacing="0" class="table table-bordered table-striped">
        <thead>
            <tr>
            <th>Période</th>
            <th>Projet</th>
            <th>Nombre</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($rapportresults as $result): ?>
            <tr>
                <td><?php echo strMonth($result[0]['MONTH']).' '.$result[0]['YEAR']; ?></td>
                <td><?php echo $result['Facturation']['projet_NOM']; ?></td>
                <?php 
                    $nbaction = $result[0]['NB'];
                    foreach($byprojet as $item):
                        if($result['Activite']['projet_id']==$item['projet_id']):
                            $nbaction -= $item['sum'];
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
    <div style="font-family:'Lucida Grande', 'Lucida Sans Unicode', Verdana, Arial, Helvetica, sans-serif;font-size:16px;color:#274b6d;fill:#274b6d;text-align: center;" text-anchor="middle" class="highcharts-title" zIndex="4">Nombre de jours facturés par projet et activité</div><br>
    <table cellpadding="0" cellspacing="0" class="table table-bordered table-striped">
        <thead>
            <tr>
            <th>Période</th>
            <th>Projet</th>
            <th>Activité</th>
            <th>Nombre</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($detailrapportresults as $result): ?>
            <tr>
                <td><?php echo strMonth($result[0]['MONTH']).' '.$result[0]['YEAR']; ?></td>
                <td><?php echo $result['Facturation']['projet_NOM']; ?></td>
                <td><?php echo $result['Activite']['NOM']; ?></td>
                <?php 
                    $nbaction = $result[0]['NB'];
                    foreach($byprojetactivite as $item):
                        if($result['Activite']['projet_id']==$item['projet_id'] && $result['Activite']['id']==$item['activite_id']):
                            $nbaction -= $item['sum'];
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
    <?php if (isset($repartitions)): ?>
    <br />
        <div style="font-family:'Lucida Grande', 'Lucida Sans Unicode', Verdana, Arial, Helvetica, sans-serif;font-size:16px;color:#274b6d;fill:#274b6d;text-align: center;" text-anchor="middle" class="highcharts-title" zIndex="4">Nombre de jours facturés par utilisateur et par activité</div><br>
    <table cellpadding="0" cellspacing="0" class="table table-bordered table-striped">
        <thead>
            <tr>
            <th>Période</th>
            <th>Utilisateur</th>
            <th>Projet</th>
            <th>Activité</th>
            <th>Nombre</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($repartitions as $result): ?>
            <tr>
                <td><?php echo strMonth($result[0]['MONTH']).' '.$result[0]['YEAR']; ?></td>
                <td><?php echo $result['Utilisateur']['NOM'].' '.$result['Utilisateur']['PRENOM']; ?></td>
                <td><?php echo $result['Facturation']['projet_NOM']; ?></td>
                <td><?php echo $result['Activite']['NOM']; ?></td>
                <?php 
                    $nbaction = $result[0]['NB'];
                    foreach($byprojetactiviteutilisateur as $item):
                        if($result['Activite']['projet_id']==$item['projet_id'] && $result['Activite']['id']==$item['activite_id'] && $result['Utilisateur']['id']==$item['utilisateur_id']):
                            $nbaction -= $item['sum'];
                        endif;
                    endforeach;
                ?>                
                <td style="text-align:center" class="nbrepartition"><?php echo $nbaction; ?></td> 
            </tr>           
            <?php endforeach; ?>
        </tbody>
        <tfooter>
	<tr>
            <td colspan="4" class="footer" style="text-align:right;">Total :</td>
            <td class="footer" id="totalrepartition" style="text-align:center;"></td>
	</tr> 
        </tfooter>        
    </table>
    <?php endif; ?>
</div>
<?php if(isset($rapportresults) && $israpport==0) : ?>
<div class="alert alert-block"><b>Aucun résultat pour ce rapport, modifier les paramètres de recherche ...</b></div>
<?php endif; ?>
<script>
$(document).ready(function (){ 
    
    $(document).on('click','#FacturationSelectAll',function() {
        if($(this).is(':checked')){
            $('#FacturationUtilisateurId option').prop('selected', 'selected');
        } else {
            $('#FacturationUtilisateurId option').prop('selected', '');
        }
    });   
    
   $(document).on('click','#FacturationUtilisateurId',function() {
            $('#FacturationSelectAll').prop('checked', false);
    }); 
    
   $(document).on('click','#FacturationSelectAllProjet',function() {
        if($(this).is(':checked')){
            $('#FacturationProjetId option').prop('selected', 'selected');
        } else {
            $('#FacturationProjetId option').prop('selected', '');
        }
    });   
    
   $(document).on('click','#FacturationProjetId',function() {
            $('#FacturationSelectAllProjet').prop('checked', false);
    }); 
    
    function sumOfColumns(id) {
        var tot = 0;
        $("."+id).each(function() {
          tot += parseFloat($(this).html());
        });
        return tot+' jours';
     }    
    
    function addMonth($date,$nb){
        var dateTimeSplit = $date.split(' ');
        var dateSplit = dateTimeSplit[0].split('/');
        var mois = (parseInt(dateSplit[1])+$nb) < 10 ? "0"+(parseInt(dateSplit[1])+$nb) : (parseInt(dateSplit[1])+$nb);
        var currentDate = dateSplit[0] + '/' + mois + '/' + dateSplit[2];
        return currentDate;
    }
    
    $("#total").html(sumOfColumns('nbaction'));
    $("#totaldetail").html(sumOfColumns('nbactiondetail'));
    $("#totalrepartition").html(sumOfColumns('nbrepartition'));
    
    $(document).on('change','#ActionSTART',function(e){
        newDate = addMonth($(this).val(),1);
        $('#ActionEND').val(newDate);
        $('#ActionEND').datepicker('update', newDate);
        $('#ActionEND').focus();
    })    
<?php if(isset($chartresults)): ?>
    <?php foreach($chartresults as $result): 
        $nbaction = $result[0]['NB'];
        foreach($byprojet as $item):
            if($result['Activite']['projet_id']==$item['projet_id']):
                $nbaction -= $item['sum'];
            endif;
        endforeach;
       $data[] = $nbaction;
       $categories[] = "'".$result['Facturation']['projet_NOM']."'";
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
                return 'Nombre de jours facturés <b>' + this.y + '</b> jours sur <b>' + this.x + '</b>, toutes activités confondues';
            }
        },
        title: {
            text: 'Nombre de jours facturés'
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
                text: 'Nombre de jours facturés'
            },
            tickInterval: 50
        },         
        series: [{
            name: 'Facturation',
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