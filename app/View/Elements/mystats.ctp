<div class="block-title">
    <h4>Mes statistiques</h4>
</div>
<div class="block-content">
    <div style='text-align:center;'><h4>Mes 5 prochaines échéances:</h4></div>
    <div style='display: table;width: 95%;margin-left: auto;margin-right:auto;'>
    <table cellpadding="0" cellspacing="0">
        <?php $listeactions = $this->requestAction('actions/homeListeActions'); ?> 
        <?php foreach ($listeactions as $action) :  ?>
        <?php $class = CUSDate($action['Action']['ECHEANCE']) < date('Y-m-d') ? 'to-late' : ''; ?>
        <?php $chronos = CUSDate($action['Action']['ECHEANCE']) < date('Y-m-d') ? 'En retard' : ''; ?>
        <?php 
        $priority = $action['Action']['PRIORITE']; 
        switch ($priority){
            case 'haute':
                $priority = 'up_arrow red size10';
                break;
            case 'moyenne':
                $priority = 'minus size10';
                break;
            case 'normale':
                $priority = 'down_arrow size10';
                break;          
        }
        ?>
         <tr>
             <td>
                <div class="font-default">
                    <div class="title">Action</div>
                    <div><span class='glyphicons <?php echo $priority; ?>'></span>&nbsp;<span class='<?php echo $class; ?>'><?php echo $action['Action']['ECHEANCE']; ?>&nbsp;<?php echo $chronos != '' ? "[".$chronos."] " : ''; ?></span><br><span class="font-higth"><?php echo $action['Action']['OBJET']; ?></span></div>
                </div>  
             </td>
         </tr>
        <?php endforeach; ?>
        <?php if(empty($listeactions)): ?>
         <tr>
             <td>
                <div class="font-default">
                    <div class="title">Aucune action</div>
                </div>  
             </td>
         </tr>
        <?php endif;?>
    </table>
    <hr class="hrstat">        
    <table cellpadding="0" cellspacing="0">    
        <?php $listelivrables = $this->requestAction('livrables/homeListeLivrables'); ?> 
        <?php foreach ($listelivrables as $livrable) :  ?>
        <?php $class = CUSDate($livrable['Livrable']['ECHEANCE']) < date('Y-m-d') ? 'to-late' : ''; ?>
        <?php $chronos = CUSDate($livrable['Livrable']['ECHEANCE']) < date('Y-m-d') ? 'En retard' : ''; ?>
         <tr>
             <td>
                <div class="font-default">
                    <div class="title">Livrable</div>
                    <div><span class='<?php echo $class; ?>'><?php echo $livrable['Livrable']['ECHEANCE']; ?>&nbsp;<?php echo $chronos != '' ? "[".$chronos."] " : ''; ?></span><br><span class="font-higth"><?php echo $livrable['Livrable']['NOM']; ?></span></div>
                </div>                   
             </td>
         </tr>
        <?php endforeach; ?> 
        <?php if(empty($listelivrables)): ?>
         <tr>
             <td>
                <div class="font-default">
                    <div class="title">Aucun livrable</div>
                </div>  
             </td>
         </tr>
        <?php endif;?>         
     </table>
    </div>
    <hr class="hrstat">
    <div style='text-align:center;'><h4>Mes actions et livrables:</h4></div>
    <div style='display: table;margin-left: auto;margin-right:auto;'>
        <table  cellpadding="0" cellspacing="0">
                <tr>
                    <td  style="border-right:solid 1px #DDD;">
                        <table  cellpadding="0" cellspacing="0" style="margin:0px;">
                            <tr><td>
                            <div class="font-default">
                                <div class="title">Actions</div>
                                <?php $nbactions = $this->requestAction('actions/homeNBRETARDActions'); ?>
                                <div class="information">En retard</div>
                                <div class="saisie to-late pull-right"><?php echo isset($nbactions[0][0]['NB']) ? $nbactions[0][0]['NB'] : 0; ?></div>
                            </div>        
                            </td></tr>
                        </table>
                        <table  cellpadding="0" cellspacing="0" style="margin:0px;">
                            <tr><td>
                            <div class="font-default">
                                <div class="title">Actions</div>
                                <?php $nbactions = $this->requestAction('actions/homeNBENCOURSActions'); ?>
                                <div class="information">En cours</div>
                                <div class="saisie in-line pull-right"><?php echo isset($nbactions[0][0]['NB']) ? $nbactions[0][0]['NB'] : 0; ?></div>
                            </div>        
                            </td></tr>                            
                        </table>
                        <table  cellpadding="0" cellspacing="0" style="margin:0px;">
                            <tr><td>
                            <div class="font-default">
                                <div class="title">Actions</div>
                                <?php $nbactions = $this->requestAction('actions/homeNBAFAIREActions'); ?>
                                <div class="information">A faire</div>
                                <div class="saisie to-do pull-right"><?php echo isset($nbactions[0][0]['NB']) ? $nbactions[0][0]['NB'] : 0; ?></div>
                            </div>        
                            </td></tr>                              
                        </table>                        
                    </td>
                    <td>
                        <table  cellpadding="0" cellspacing="0" style="margin:0px;">
                            <tr><td>                            
                            <div class="font-default">
                                <div class="title">Livrables</div>
                                <?php $nblivrables = $this->requestAction('livrables/homeNBRETARDLivrables'); ?>
                                <div class="information">En retard</div>
                                <div class="saisie to-late pull-right"><?php echo isset($nblivrables[0][0]['NB']) ? $nblivrables[0][0]['NB'] : 0; ?></div>
                            </div>        
                            </td></tr>                              
                        </table>
                        <table  cellpadding="0" cellspacing="0" style="margin:0px;">
                            <tr><td>                            
                            <div class="font-default">
                                <div class="title">Livrables</div>
                                <?php $nblivrables = $this->requestAction('livrables/homeNBENCOURSLivrables'); ?>
                                <div class="information">En cours</div>
                                <div class="saisie in-line pull-right"><?php echo isset($nblivrables[0][0]['NB']) ? $nblivrables[0][0]['NB'] : 0; ?></div>
                            </div>        
                            </td></tr>                              
                        </table>
                        <table  cellpadding="0" cellspacing="0" style="margin:0px;">
                            <tr><td>                            
                            <div class="font-default">
                                <div class="title">Livrables</div>
                                <?php $nblivrables = $this->requestAction('livrables/homeNBAFAIRELivrables'); ?>
                                <div class="information">A faire</div>
                                <div class="saisie to-do pull-right"><?php echo isset($nblivrables[0][0]['NB']) ? $nblivrables[0][0]['NB'] : 0; ?></div>
                            </div>        
                            </td></tr>                              
                        </table>                        
                    </td>
                </tr>
        </table>
    </div> 
    <hr class="hrstat">
    <div style='text-align:center;'><h4>Ma saisie d'activité :</h4></div>
    <div style='display: table;margin-left: auto;margin-right:auto;'>
        <?php $mondays = getallmonday(); ?>
        <?php foreach($mondays as $monday) : ?>
        <?php $activitesreelle[0]['TOTAL']=0;
        $activitesreelle['Activitesreelle']['VEROUILLE']=false;
        ?>
        <?php 
            $etat = "not-active";
        ?>
        <?php $activitesreelles = $this->requestAction('activitesreelles/homeNBActivitesReelles'); ?>
        <?php foreach($activitesreelles as $activitesreelle) : ?>
        <?php if ($monday == $activitesreelle['Activitesreelle']['DATE']): ?>
        <?php 
            if ((isset($activitesreelle[0]['TOTAL']) && $activitesreelle[0]['TOTAL']==5) && $activitesreelle['Activitesreelle']['VEROUILLE']==false) : 
                $etatsaisie = ucfirst_utf8('facturé');$etat = "facture";
            else:
                $etatsaisie = ucfirst_utf8('à facturer'); $etat = "to-facture";
            endif;
            if (isset($activitesreelle[0]['TOTAL']) && $activitesreelle[0]['TOTAL']<5 && $activitesreelle['Activitesreelle']['VEROUILLE']==true) : $etatsaisie = ucfirst_utf8('à compléter');$etat = "to-complete"; endif;
            if (!isset($activitesreelle[0]['TOTAL'])) : $etatsaisie = ucfirst_utf8('à saisir'); endif;
			if ($activitesreelle['Activitesreelle']['VEROUILLE']==false): $etatsaisie = ucfirst_utf8('facturé'); $etat = "facture"; endif;
        ?>
        <div class="font-default">
            <div class="title">Saisie d'activité hebdomadaire</div>
            <div class="information"><?php echo $monday; ?><br><span class='font-ligth <?php echo $etat; ?>'><?php echo $etatsaisie; ?></span></div>
            <div class="saisie <?php echo $etat; ?>  pull-right"><?php echo isset($activitesreelle[0]['TOTAL']) ? $activitesreelle[0]['TOTAL']: '0.0'; ?></div>
        </div>
        <?php endif; ?>
        <?php endforeach; ?>
        <?php endforeach; ?>       
    </div>  
</div>