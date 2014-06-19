<div class="block-title  top-header-blue">
    <h4>Mes statistiques</h4>
</div>
<div class="block-content">
        <div class="carousel slide min-height-350" id="carousel-stats"  data-ride="carousel">
            <ol class="carousel-indicators carousel-right">
                <li data-target="#carousel-stats" data-slide-to="0" class="active"></li>
                <li data-target="#carousel-stats" data-slide-to="1"></li>
                <li data-target="#carousel-stats" data-slide-to="2"></li>
                <li data-target="#carousel-stats" data-slide-to="3"></li>
            </ol>        
            <div class="carousel-inner">
                <div class="item active">
                    <?php $listeactions = $this->requestAction('actions/homeListeActions'); ?> 
                    <div class="panel-group panel-price-group col-100">
                      <div class="panel">
                        <div class="panel-heading">
                          <h3 class="panel-title">Mes 5 prochaines actions</h3>
                        </div>
                        <div class="panel-body panel-price">
                          <?php if(!empty($listeactions)): ?>
                          <ul class="list-group">
                          <?php foreach ($listeactions as $action) :  ?>
                          <?php $class = CUSDate($action['Action']['ECHEANCE']) < date('Y-m-d') ? 'tolate' : ''; ?>
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
                          $warning_sign = '<span class="glyphicons warning_sign red"></span>';
                          ?>
                              <li class="list-group-item"><div><span class="glyphicons <?php echo $priority; ?>  notchange margintop4"></span><span class="bold size14 <?php echo $class; ?>"><?php echo $action['Action']['ECHEANCE']; ?>&nbsp;<span class='text-exposant'><?php echo $chronos != '' ? "[".$chronos."] ".$warning_sign : ''; ?></span></span></div><span class="objet"><?php echo $action['Action']['OBJET']; ?></span>
                                  <span class="pull-right"><?php echo $this->Html->link('<span class="glyphicons pencil showoverlay notchange" rel="tooltip" data-title="Modification"></span>', array('controller'=>'actions','action' => 'edit', $action['Action']['id']),array('escape' => false,'class'=>'showoverlay')); ?></span>
                              </li>
                          <?php endforeach; ?>  
                          <?php else: ?>
                              <li class="list-group-item" style="border: none;"><div>Aucune action</div></li>
                          <?php endif; ?>
                          </ul>                          
                        </div>
                      </div>  
                    </div>  
                </div>
                <div class="item">
                    <!-- les livrables -->
                    <?php $listelivrables = $this->requestAction('livrables/homeListeLivrables'); ?> 
                    <div class="panel-group panel-price-group col-100">
                      <div class="panel">
                        <div class="panel-heading">
                          <h3 class="panel-title">Mes 5 prochains livrables</h3>
                        </div>
                        <div class="panel-body panel-price">
                          <?php if(!empty($listelivrables)): ?>
                          <ul class="list-group">
                          <?php foreach ($listelivrables as $livrable) :  ?>
                          <?php $class = CUSDate($livrable['Livrable']['ECHEANCE']) < date('Y-m-d') ? 'tolate' : ''; ?>
                          <?php $chronos = CUSDate($livrable['Livrable']['ECHEANCE']) < date('Y-m-d') ? 'En retard' : ''; ?>
                          <?php $warning_sign = '<span class="glyphicons warning_sign red"></span>'; ?>
                              <li class="list-group-item"><div><span class="bold size14 <?php echo $class; ?>"><?php echo $livrable['Livrable']['ECHEANCE']; ?>&nbsp;<span class='text-exposant'><?php echo $chronos != '' ? "[".$chronos."] ".$warning_sign : ''; ?></span></span></div><span class="objet"><?php echo $livrable['Livrable']['NOM']; ?></span>
                                  <span class="pull-right"><?php echo $this->Html->link('<span class="glyphicons pencil showoverlay notchange" rel="tooltip" data-title="Modification"></span>', array('controller'=>'livrables','action' => 'edit', $livrable['Livrable']['id']),array('escape' => false,'class'=>'showoverlay')); ?></span>
                              </li>
                          <?php endforeach; ?>  
                          <?php else: ?>
                              <li class="list-group-item" style="border: none;"><div>Aucun livrable</div></li>
                          <?php endif; ?>
                          </ul>                          
                        </div>
                      </div>  
                    </div>  
                    <div class="carousel-caption">
                    </div>
                </div>     
                <div class="item">
                    <!--les statistiques sur le nombre d'action et livrables-->
                    <div class="panel-group panel-price-group col-100">
                      <div class="panel">
                        <div class="panel-heading">
                          <h3 class="panel-title">Statistiques Mes actions - Mes livrables</h3>
                        </div>
                        <div class='block-panel-stats-50-left'>
                        <div class="panel-body panel-price-stats">
                          <ul class="list-group">
                              <li class="list-group-item title"><div style="margin-bottom: 15px;">
                                <span class="pull-left"><?php echo $this->Html->link('<span class="bold">Actions</span>', array('controller'=>'actions','action' => 'index'),array('escape' => false,'class'=>'showoverlay')); ?></span></div></li>
                            <?php $nbactions = $this->requestAction('actions/homeNBRETARDActions'); ?>
                            <li class="list-group-item"><div><span class="size14">En retard</span></div><span class="tolate"><?php echo isset($nbactions[0][0]['NB']) ? $nbactions[0][0]['NB'] : 0; ?></span></li>
                            <?php $nbactions = $this->requestAction('actions/homeNBENCOURSActions'); ?>
                            <li class="list-group-item"><div><span class="size14">En cours</span></div><span class="onway"><?php echo isset($nbactions[0][0]['NB']) ? $nbactions[0][0]['NB'] : 0; ?></span></li>
                            <?php $nbactions = $this->requestAction('actions/homeNBAFAIREActions'); ?>
                            <li class="list-group-item"><div><span class="size14">A faire</span></div><span class="todo"><?php echo isset($nbactions[0][0]['NB']) ? $nbactions[0][0]['NB'] : 0; ?></span></li>
                          </ul>                          
                        </div>
                        </div>                          
                        <div class='block-panel-stats-50-right'>
                        <div class="panel-body panel-price-stats border-left">
                          <ul class="list-group">
                            <li class="list-group-item title"><div style="margin-bottom: 15px;">
                                    <span class="pull-left"><?php echo $this->Html->link('<span class="bold">Livrables</span>', array('controller'=>'livrables','action' => 'index'),array('escape' => false,'class'=>'showoverlay')); ?></span></div></li>
                            <?php $nblivrables = $this->requestAction('livrables/homeNBRETARDLivrables'); ?>
                            <li class="list-group-item"><div><span class="size14">En retard</span></div><span class="tolate"><?php echo isset($nblivrables[0][0]['NB']) ? $nblivrables[0][0]['NB'] : 0; ?></span></li>
                            <?php $nblivrables = $this->requestAction('livrables/homeNBENCOURSLivrables'); ?>
                            <li class="list-group-item"><div><span class="size14">En cours</span></div><span class="onway"><?php echo isset($nblivrables[0][0]['NB']) ? $nblivrables[0][0]['NB'] : 0; ?></span></li>
                            <?php $nblivrables = $this->requestAction('livrables/homeNBAFAIRELivrables'); ?>
                            <li class="list-group-item"><div><span class="size14">A faire</span></div><span class="todo"><?php echo isset($nblivrables[0][0]['NB']) ? $nblivrables[0][0]['NB'] : 0; ?></span></li>
                          </ul>                         
                        </div>
                        </div>                          
                      </div>  
                    </div> 
                    <div class="carousel-caption">
                    </div>
                </div>       
                <div class="item">
                    <!--Ma saisie-->
                    <div class="panel-group panel-price-group col-100">
                      <div class="panel">
                        <div class="panel-heading">
                          <h3 class="panel-title">Situation de ma saisie mensuelle</h3>
                        </div>
                        <div class="panel-body panel-price-stats">
                          <ul class="list-group">
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
                                  $date = new DateTime(CUSDate($activitesreelle['Activitesreelle']['DATE']));
                                  $openday = nbJoursOuvresWeek($date);
                                  if ((isset($activitesreelle[0]['TOTAL']) && $activitesreelle[0]['TOTAL']==$openday) && $activitesreelle['Activitesreelle']['VEROUILLE']==false) : 
                                      $etatsaisie = ucfirst_utf8('facturé');$etat = "thin-do";$etatnb = "do-10";
                                  else:
                                      $etatsaisie = ucfirst_utf8('à facturer'); $etat = "thin-todo";$etatnb = "todo-10";
                                  endif;
                                  if (isset($activitesreelle[0]['TOTAL']) && $activitesreelle[0]['TOTAL']<$openday && $activitesreelle['Activitesreelle']['VEROUILLE']==true) : $etatsaisie = ucfirst_utf8('à compléter');$etat = "thin-onway";$etatnb = "onway-10"; endif;
                                  if (!isset($activitesreelle[0]['TOTAL'])) : $etatsaisie = ucfirst_utf8('thin-todo');$etatnb = "todo-10"; endif;
                                  if ($activitesreelle['Activitesreelle']['VEROUILLE']==false): $etatsaisie = ucfirst_utf8('facturé'); $etat = "thin-do";$etatnb = "do-10"; endif;
                              ?>
                              <li class="list-group-item"><div class=" margintop-10">
                                      <span class="bold size14"><?php echo $monday; ?></span><br>
                                      <span class="<?php echo $etat; ?>"><?php echo $etatsaisie; ?></span>
                                      <?php if($etatsaisie == ucfirst_utf8('à facturer')): ?>
                                      <span class="marginleft15"><?php echo $this->Html->link('<span class="glyphicons thumbs_down showoverlay notchange" rel="tooltip" data-title="Soumettre"></span>', array('controller'=>'activitesreelles','action' => 'updatefacturationallweek', $activitesreelle['Activitesreelle']['id']),array('escape' => false,'class'=>'showoverlay')); ?></span>
                                      <?php elseif($etatsaisie == ucfirst_utf8('à compléter')): ?>
                                      <span class="marginleft15"><?php echo $this->Html->link('<span class="glyphicons pencil showoverlay notchange" rel="tooltip" data-title="Modification"></span>', array('controller'=>'activitesreelles','action' => 'edit', $activitesreelle['Activitesreelle']['id']),array('escape' => false,'class'=>'showoverlay')); ?></span>
                                      <?php endif; ?>
                                  </div>
                                  <span class="<?php echo $etatnb; ?>"><?php echo isset($activitesreelle[0]['TOTAL']) ? $activitesreelle[0]['TOTAL']: '0.0'; ?></span></li>
                              <?php endif; ?>
                              <?php endforeach; ?>
                              <?php endforeach; ?>                     
                              </ul>                          
                        </div>                       
                      </div> 
                    </div>  
                    <div class="carousel-caption">
                    </div>
                </div>       
            </div>
        </div>         
    </div>
