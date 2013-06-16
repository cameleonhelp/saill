<?php echo $this->Form->create('Rapport',array('id'=>'formValidate','class'=>'form-horizontal','inputDefaults' => array('label'=>false,'div' => false))); ?>
    <table>
        <tr>
            <td><label class="control-label sstitre" for="RapportMois">Mois : </label></td>
            <td>
                <?php echo $this->Form->select('mois',$mois,array('default'=>date('m'),'empty'=>false)); ?>
            </td>
            <td><label class="control-label sstitre" for="RapportAnnee">Année : </label></td>
            <td>
                <?php echo $this->Form->select('annee',$annee,array('default'=>date('Y'),'empty'=>false)); ?>
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
<div style="font-family:'Lucida Grande', 'Lucida Sans Unicode', Verdana, Arial, Helvetica, sans-serif;font-size:16px;color:#274b6d;fill:#274b6d;text-align: center;" text-anchor="middle" class="highcharts-title" zIndex="4">Saisie activités des agents</div><br>
<table cellpadding="0" cellspacing="0" class="table table-bordered table-striped">
    <thead>
        <tr>
        <th>Agent</th>
        <th>Etat et jours saisis sur <?php echo $nbmaxopen; ?></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($results as $result): ?>
        <tr>
            <td><?php echo $result['SAISIE']['NOMLONG']; ?></td>
            <?php
            if(($result['SAISIE']['TOTAL']-intval($nbmaxopen))!=0):
                $badge = 'badge-important';
            elseif(($result['SAISIE']['TOTAL']-intval($nbmaxopen))==0 && $result['SAISIE']['VEROUILLE']!=0):
                $badge = 'badge-warning';
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
<?php endif; ?>
<script>
$(document).ready(function () {    
    $(document).on('click','.sendmail',function(e){
        var id = $(this).attr('userid');
        $.ajax({
            dataType: "html",
            type: "POST",
            url: "<?php echo $this->Html->url(array('controller'=>'rapports','action'=>'sendmailsaisie')); ?>/"+id,
            data: ({})
        }).error(function ( data ) {
            location.reload();
        });
    });  
});    
</script>