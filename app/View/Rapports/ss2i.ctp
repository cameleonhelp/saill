<?php echo $this->Form->create('Rapport',array('id'=>'formValidate','class'=>'form-horizontal','inputDefaults' => array('label'=>false,'div' => false))); ?>
    <table>
        <tr>
            <td rowspan="3"><label class="control-label sstitre required" for="RapportSociete">Sociétés : </label></td>
            <td rowspan="3">
                <?php echo $this->Form->select('societe',$societes,array('data-rule-required'=>'true','multiple'=>'true','size'=>"10",'data-msg-required'=>"Le nom de la société est obligatoire")); ?>
            </td>
            <td style="height:56px"><label class="control-label sstitre" for="RapportMois">Mois : </label></td>
            <td>
                <?php echo $this->Form->select('mois',$mois,array('default'=>date('m'),'empty'=>false)); ?>
            </td>
        </tr>
        <tr>
            <td  style="height:56px"><label class="control-label sstitre" for="RapportAnnee">Année : </label></td>
            <td>
                <?php echo $this->Form->select('annee',$annee,array('default'=>date('Y'),'empty'=>false)); ?>
            </td>
        </tr>
        <tr>
            <td style="height:56px"><label class="control-label sstitre" for="RapportIndisponibilite">Indisponibilité : </label></td>
            <td>
                <?php echo $this->Form->input('indisponibilite',array('type'=>'checkbox','class'=>'yesno','value'=>1)); ?>&nbsp;<label class="labelAfter" for="RapportIndisponibilite"></label>            
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
<?php if (isset($results)): ?>
<div style="font-family:'Lucida Grande', 'Lucida Sans Unicode', Verdana, Arial, Helvetica, sans-serif;font-size:16px;color:#274b6d;fill:#274b6d;text-align: center;" text-anchor="middle" class="highcharts-title" zIndex="4">Facturation estimée par société</div><br>
<table cellpadding="0" cellspacing="0" class="table table-bordered table-striped">
    <thead>
        <tr>
        <th>Société</th>
        <th>Agents</th>
        <th>Jours</th>
        <th>Projet</th>
        <th>Activité</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($results as $result): ?>
        <tr>
            <td><?php echo $result['Utilisateur']['societe_NOM']; ?></td>
            <td><?php echo $result['Utilisateur']['NOM'].' '.$result['Utilisateur']['PRENOM']; ?></td>
            <?php $mois = $result[0]['MONTH'] < 10 ? '0'.$result[0]['MONTH'] : $result[0]['MONTH']; ?>
            <?php 
                    $nbaction = $result[0]['NB'];
                    foreach($entrops as $item):
                        if($result['Activite']['projet_id']==$item['projet_id'] && $result['Activite']['id']==$item['activite_id'] && $result['Utilisateur']['id']==$item['utilisateur_id'] && $mois==$item['mois']):
                            $nbaction -= $item['sum'];
                            $nbaction = number_format($nbaction, 1);
                        endif;
                    endforeach;
                ?>
            <td class="nb" style="text-align:right;"><?php echo $nbaction; ?></td>
            <td><?php echo $result['Facturation']['projet_NOM']; ?></td>
            <td><?php echo $result['Activite']['NOM']; ?></td>
        </tr>           
        <?php endforeach; ?>
    </tbody>  
    <tfooter>
    <tr>
        <td colspan="2" class="footer" style="text-align:right;">Total :</td>
        <td class="footer" id="total" style="text-align:center;"></td>
        <td class="footer" colspan="2" style="text-align:left;">jours</td>
    </tr> 
    </tfooter>    
</table>
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
    
    $("#total").html(sumOfColumns('nb'));
});
</script>