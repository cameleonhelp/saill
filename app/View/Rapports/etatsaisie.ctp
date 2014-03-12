<div class="">
<div class="etatsaisie form">
<?php echo $this->Form->create('Rapport',array('id'=>'formValidate','class'=>'form-horizontal','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?>
    <div class='block-panel block-panel-50-left'>
        <div class="form-group">
            <label class="col-md-4 required" for="RapportMois">Mois : </label>
            <div class="col-md-4">
                    <?php echo $this->Form->select('mois',$mois,array('default'=>date('m'),'class'=>"form-control",'empty'=>false)); ?>  
            </div>
        </div>        
    </div>
    <div class='block-panel block-panel-50-right'>
        <div class="form-group">
            <label class="col-md-4 required" for="RapportAnnee">Année : </label>
            <div class="col-md-4">
                    <?php echo $this->Form->select('annee',$annee,array('default'=>date('Y'),'class'=>"form-control",'empty'=>false)); ?>           
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
<?php if (isset($results) && count($results)>0): ?>
<div style="font-family:'Lucida Grande', 'Lucida Sans Unicode', Verdana, Arial, Helvetica, sans-serif;font-size:16px;color:#274b6d;fill:#274b6d;text-align: center;" text-anchor="middle" class="highcharts-title" zIndex="4">Saisie activités des agents</div><br>
<table cellpadding="0" cellspacing="0" class="table table-bordered tablemax">
    <thead>
        <tr>
        <th>Agent</th>
        <th>Etat et jours saisis sur <?php echo $nbmaxopen; ?> (jours ouvrés du mois : <?php echo $nbopenday; ?>)</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($results as $result): ?>
        <tr>
            <td><?php echo $result['SAISIE']['NOMLONG']; ?></td>
            <?php
            if(($result['SAISIE']['TOTAL']-intval($nbmaxopen)) < 0):
                $badge = 'badge-important showoverlay';
            elseif(($result['SAISIE']['TOTAL']-intval($nbmaxopen))==0 && $result['SAISIE']['VEROUILLE']!=0):
                $badge = 'badge-warning showoverlay';
            elseif($result['SAISIE']['VEROUILLE']!=0):
                $badge = 'badge-warning showoverlay';
            else:
                $badge = 'badge-success';
            endif;
            ?>
            <?php if($badge=='badge-success'): ?>
            <td style="text-align: center"><span class="badgeround <?php echo $badge; ?> white-bold-font"><?php echo round($result['SAISIE']['TOTAL']) < 10 ? '0'.round($result['SAISIE']['TOTAL']) : round($result['SAISIE']['TOTAL']); ?></span></td>
            <?php else : ?>
            <td style="text-align: center"><span class="badgeround <?php echo $badge; ?> white-bold-font cursor sendmail" userid="<?php echo $result['SAISIE']['USERID']; ?>"><?php echo round($result['SAISIE']['TOTAL']) < 10 ? '0'.round($result['SAISIE']['TOTAL']) : round($result['SAISIE']['TOTAL']); ?></span></td>
            <?php endif; ?>
        </tr>           
        <?php endforeach; ?>
    </tbody>    
</table>
<br/>
<div style="font-family:'Lucida Grande', 'Lucida Sans Unicode', Verdana, Arial, Helvetica, sans-serif;font-size:16px;color:#274b6d;fill:#274b6d;text-align: center;" text-anchor="middle" class="highcharts-title" zIndex="4">Agents avec aucune saisie</div><br>
<table cellpadding="0" cellspacing="0" class="table table-bordered tablemax">
    <thead>
        <tr>
        <th>Agent</th>
        <th>Relance</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($resultvides as $result): ?>
        <tr>
            <td><?php echo $result['Utilisateur']['NOMLONG']; ?></td>
            <td style="text-align: center">
                <a href="#"><span rel="tooltip" data-title="Envoyer un mail de relance" class="sendmailrelance"  userid="<?php echo $result['Utilisateur']['id']; ?>"><span class="glyphicons envelope notchange showoverlay"></span></span></a>
            </td>
        </tr>           
        <?php endforeach; ?>
    </tbody>    
</table>
<?php endif; ?>

<?php if (isset($results) && count($results)==0): ?>
<div class="bs-callout bs-callout-warning"><b>Aucun résultat pour ce rapport, modifier les paramètres de recherche ...</b></div>
<?php endif; ?>
</div>
<script>
$(document).ready(function () {    
    $("table").tablesorter();
    $(document).on('click','.sendmail',function(e){
        var id = $(this).attr('userid');
        var overlay = $('#overlay');
        $.ajax({
            dataType: "html",
            type: "POST",
            url: "<?php echo $this->Html->url(array('controller'=>'rapports','action'=>'sendmailsaisie')); ?>/"+id,
            data: ({})
        }).error(function ( data ) {
            location.reload();
            overlay.hide();
        }).success(function ( data ) {
            overlay.hide();
        });
    });  
    $(document).on('click','.sendmailrelance',function(e){
        var id = $(this).attr('userid');
        var overlay = $('#overlay');
        $.ajax({
            dataType: "html",
            type: "POST",
            url: "<?php echo $this->Html->url(array('controller'=>'activitesreelles','action'=>'sendmailrelance')); ?>/"+id,
            data: ({})
        }).error(function ( data ) {
            location.reload();
            overlay.hide();            
        }).success(function ( data ) {
            overlay.hide();
        });
    });
});    
</script>