<div class="block-title">
    <h2>Mes statistiques</h2>
</div>
<div class="block-content">
    <div style='text-align:center;'><h4>Mes 5 prochaines échéances:</h4></div>
    <div style='display: table;width: 100%''>
    <table>
        <thead>
         <tr><th colspan='2' style='text-align:center;'>Actions</th></tr>
        </thead>
        <?php $listeactions = $this->requestAction('actions/homeListeActions'); ?> 
        <?php foreach ($listeactions as $action) :  ?>
        <?php $class = CUSDate($action['Action']['ECHEANCE']) < date('Y-m-d') ? 'alert-danger' : ''; ?>
        <?php 
        $priority = $action['Action']['PRIORITE']; 
        switch ($priority){
            case 'haute':
                $priority = 'icon-arrow-up icon-red';
                break;
            case 'moyenne':
                $priority = 'icon-minus';
                break;
            case 'normale':
                $priority = 'icon-arrow-down';
                break;          
        }
        ?>
         <tr class='<?php echo $class; ?>'>
             <td><i class='<?php echo $priority; ?>'></i></td><td><?php echo $action['Action']['OBJET']; ?></td>
         </tr>
        <?php endforeach; ?>
    </table>
    <table>    
        <thead>
         <tr><th style='text-align:center;'>Livrables</th></tr>
        </thead>
        <?php $listelivrables = $this->requestAction('livrables/homeListeLivrables'); ?> 
        <?php foreach ($listelivrables as $livrable) :  ?>
        <?php $class = CUSDate($livrable['Livrable']['ECHEANCE']) < date('Y-m-d') ? 'alert-danger' : ''; ?>
         <tr class='<?php echo $class; ?>'>
             <td><?php echo $livrable['Livrable']['NOM']; ?></td>
         </tr>
        <?php endforeach; ?>        
     </table>
    </div>
    <hr class="hrstat">
    <h4>Mes actions et livrables:</h4>
    <div style='display: table;width: 100%'>
        <table  cellpadding="0" cellspacing="0">
            <thead>
                <tr><th>Actions</th><th>Livrables</th></tr>
                <tr>
                    <td>
                        <table>
                        <thead>
                         <tr><th style='text-align:center;' class='info-danger'>En retard</th></tr>
                        </thead>
                        <?php $nbactions = $this->requestAction('actions/homeNBRETARDActions'); ?>
                        <tr><td align='center'><div class='sleek'><div class='line-vertical'><div class='sleek-label'><?php echo isset($nbactions[0][0]['NB']) ? $nbactions[0][0]['NB'] : 0; ?></div></div></div></td></tr>
                        </table>
                        <table>
                        <thead>
                         <tr><th style='text-align:center;' class='info-warning'>En cours</th></tr>
                        </thead>
                        <?php $nbactions = $this->requestAction('actions/homeNBENCOURSActions'); ?>
                        <tr><td align='center'><span class='sleek'><div class='line-vertical'><div class='sleek-label'><?php echo isset($nbactions[0][0]['NB']) ? $nbactions[0][0]['NB'] : 0; ?></div></div></span></td></tr>
                        </table>
                        <table>
                        <thead>
                        <?php $nbactions = $this->requestAction('actions/homeNBAFAIREActions'); ?>
                        <tr><th style='text-align:center;' class='info-success'>A faire</th></tr>
                        </thead>
                        <tr><td align='center'><span class='sleek'><div class='line-vertical'><div class='sleek-label'><?php echo isset($nbactions[0][0]['NB']) ? $nbactions[0][0]['NB'] : 0; ?></div></div></span></td></tr>
                        </table>                        
                    </td>
                    <td>
                        <table>
                        <thead>
                         <tr><th style='text-align:center;' class='info-danger'>En retard</th></tr>
                        </thead>
                        <?php $nblivrables = $this->requestAction('livrables/homeNBRETARDLivrables'); ?>
                        <tr><td align='center'><span class='sleek'><div class='line-vertical'><div class='sleek-label'><?php echo isset($nblivrables[0][0]['NB']) ? $nblivrables[0][0]['NB'] : 0; ?></div></div></span></td></tr>
                        </table>
                        <table>
                        <thead>
                         <tr><th style='text-align:center;' class='info-warning'>En cours</th></tr>
                        </thead>
                        <?php $nblivrables = $this->requestAction('livrables/homeNBENCOURSLivrables'); ?>
                        <tr><td align='center'><span class='sleek'><div class='line-vertical'><div class='sleek-label'><?php echo isset($nblivrables[0][0]['NB']) ? $nblivrables[0][0]['NB'] : 0; ?></div></div></span></td></tr>
                        </table>
                        <table>
                        <thead>
                        <?php $nblivrables = $this->requestAction('livrables/homeNBAFAIRELivrables'); ?>
                        <tr><th style='text-align:center;' class='info-success'>A faire</th></tr>
                        </thead>
                        <tr><td align='center'><span class='sleek'><div class='line-vertical'><div class='sleek-label'><?php echo isset($nblivrables[0][0]['NB']) ? $nblivrables[0][0]['NB'] : 0; ?></div></div></span></td></tr>
                        </table>                        
                    </td>
                </tr>
            </thead>
        </table>
    </div> 
    <hr class="hrstat">
    <h4>Ma saisie d'activité :</h4>
    <div style='display: table;width: 100%'>
        <table  cellpadding="0" cellspacing="0">
        <?php $mondays = getallmonday(); ?>
        <?php foreach($mondays as $monday) : ?>
        <thead>
         <tr><th style='text-align:center;' colspan='2'><?php echo $monday; ?></th></tr>
        </thead>
        <?php $activitesreelles = $this->requestAction('activitesreelles/homeNBActivitesReelles'); ?>
        <?php foreach($activitesreelles as $activitesreelle) : ?>
        <?php if ($monday == $activitesreelle['Activitesreelle']['DATE']): ?>
        <?php 
            if (isset($activitesreelle[0]['TOTAL']) && $activitesreelle[0]['TOTAL']==5 && $activitesreelle['Activitesreelle']['VEROUILLE']==true) : 
                $etatsaisie = ucfirst_utf8('facturé');
                $badge = 'badge-success';
            else:
                $etatsaisie = ucfirst_utf8('à facturer'); 
                $badge = 'badge-warning';
            endif;
            if (isset($activitesreelle[0]['TOTAL']) && $activitesreelle[0]['TOTAL']<5) : $etatsaisie = ucfirst_utf8('à compléter'); $badge = 'badge-important'; endif;
            if (!isset($activitesreelle[0]['TOTAL'])) : $etatsaisie = ucfirst_utf8('à faire'); $badge = 'badge-important'; endif;
        ?>
        <tr><td align='center' width='10px'><span class='sleek'><div class='line-vertical'><div class='sleek-label'><?php echo isset($activitesreelle[0]['TOTAL']) ? $activitesreelle[0]['TOTAL']: 0; ?></div></div></span></td><td style='text-align:left;padding-left: 20px;font-size: 18px;'><span class="badgeround <?php echo $badge; ?>">&nbsp;</span> <?php echo $etatsaisie; ?></td></tr>
        <?php endif; ?>
        <?php endforeach; ?>
        <?php endforeach; ?>
        </table>        
    </div>  
</div>