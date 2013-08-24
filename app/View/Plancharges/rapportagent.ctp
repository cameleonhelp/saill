<div class="actions form">
<?php echo $this->Form->create('Plancharge',array('id'=>'formValidate','class'=>'form-horizontal','inputDefaults' => array('label'=>false,'div' => false))); ?>
    <table>
        <tr>
            <td><label class="control-label sstitre  required" for="PlanchargeUtilisateurId">Agent : </label></td>
            <td>
                    <?php echo $this->Form->select('utilisateur_id',$utilisateurs,array('data-rule-required'=>'true','data-msg-required'=>"Le nom d'un agent est obligatoire",'empty'=>'Choisir un agent ...')); ?>                          
            </td>   
            <td><label class="control-label sstitre  required" for="PlanchargeANNEE">Année : </label></td>
            <td>
                    <?php echo $this->Form->select('ANNEE',$annees,array('data-rule-required'=>'true','data-msg-required'=>"L'année est obligatoire",'empty'=>'Choisir une année ...')); ?>                          
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
    <div style="font-family:'Lucida Grande', 'Lucida Sans Unicode', Verdana, Arial, Helvetica, sans-serif;font-size:16px;color:#274b6d;fill:#274b6d;text-align: center;" text-anchor="middle" class="highcharts-title" zIndex="4">Répartition du plan de charge pour un agent</div><br>
    <table cellpadding="0" cellspacing="0" class="table table-bordered table-striped">
        <thead>
            <tr>
            <th>Projet</th>
            <th>Activité</th>
            <th>Domaine</th>
            <th width="50px">ETP</th>
            <th width="50px">Charge prévue</th>
            <th width="50px">TJM</th>
            <th width="50px">Coût</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($rapportresults as $result): ?>
            <tr>
                <td><?php echo $result['projets']['NOM']; ?></td>
                <td><?php echo $result['activites']['NOM']; ?></td>
                <td><?php echo $result['domaines']['NOM']; ?></td>
                <td style="text-align:center" class="nbetp1"><?php echo $result['detailplancharges']['ETP']; ?></td>
                <td style="text-align:center" class="nbcharge1"><?php echo $result['detailplancharges']['TOTAL']; ?></td> 
                <td style="text-align:center"><?php echo $result['detailplancharges']['TJM']; ?></td> 
                <td style="text-align:center" class="nbcout1"><?php echo $result['detailplancharges']['COUT']; ?></td> 
            </tr>           
            <?php endforeach; ?>
        </tbody>
        <tfooter>
	<tr>
            <td colspan="3" class="footer" style="text-align:right;">Total :</td>
            <td class="footer" id="totaletp1" style="text-align:center;"></td>
            <td class="footer" id="totalcharges1" style="text-align:center;"></td>
            <td class="footer"></td>
            <td class="footer" id="totalcout1" style="text-align:center;"></td>
	</tr> 
        </tfooter>
    </table>
    <?php echo $this->Html->link('Envoyer par mail à l\'agent',array('controller'=>'plancharges','action'=>'sendmail'),array('type'=>'button','class' => 'btn btn-inverse pull-right')); ?>
</div>
<?php if(isset($rapportresults) && $israpport==0) : ?>
<div class="alert alert-block"><b>Aucun résultat pour ce rapport, modifier les paramètres de recherche ...</b></div>
<?php endif; ?>
<script>
$(document).ready(function (){   
    function sumOfColumns(id) {
        var tot = 0;
        $("."+id).each(function() {
          var val = $(this).html() !== '' ? $(this).html() : '0';
          tot += parseFloat(val);
        });
        var total = parseFloat(tot) !== '' ? parseFloat(tot) : '0';
        return total.toFixed(2);
     }    

    $("#totaletp1").html(sumOfColumns('nbetp1'));
    $("#totalcharges1").html(sumOfColumns('nbcharge1'));   
    $("#totalcout1").html(sumOfColumns('nbcout1'));
});
</script>