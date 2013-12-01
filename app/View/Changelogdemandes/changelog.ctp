<div class="marginright20">
    <?php echo $this->element('changelogsubmenu'); ?>
    <?php foreach($versions as $version): ?>
    <div class="panel-group" id="panel_<?php echo $version['Changelogversion']['id']; ?>" style="margin-bottom:10px;">
          <div class="panel">
            <div class="panel-heading">
              <h3 class="panel-title">
                <a class="accordion-toggle" data-toggle="collapse" data-parent="#panel_<?php echo $version['Changelogversion']['id']; ?>" href="#panel_<?php echo $version['Changelogversion']['id']; ?>_content">
                    <?php echo 'Version '.$version['Changelogversion']['VERSION'].' finalisée le '.$version['Changelogversion']['DATEREELLE']; ?>
                </a>
              </h3>
            </div>
            <div id="panel_<?php echo $version['Changelogversion']['id']; ?>_content" class="panel-collapse collapse">
                <div class="panel-body">
                    <?php foreach ($changelogdemandes as $changelogdemande): ?>
                        <?php if($version['Changelogversion']['id'] == $changelogdemande['Changelogdemande']['changelogversion_id']): ?>
                            <ul style="margin-bottom:5px !important;">
                                <li style="font-weight: bold;">[<?php echo $changelogtypes[$changelogdemande['Changelogdemande']['TYPE']]; ?>] <?php echo $changelogdemande['Changelogdemande']['DEMANDE']; ?></li>
                                <ul style="font-style: italic;">
                                    <?php $reponses = $this->requestAction('changelogreponses/get_all_reponses/'.$changelogdemande['Changelogdemande']['id']); ?>
                                    <?php foreach($reponses as $reponse):
                                        echo '<li>Le : '.$reponse['Changelogreponse']['modified'].'<br>'.$reponse['Changelogreponse']['REPONSE'].'</li>';
                                    endforeach; ?>                                    
                                </ul>
                            </ul>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </div>
          </div>  
        </div>
    <?php endforeach; ?>
</div>
