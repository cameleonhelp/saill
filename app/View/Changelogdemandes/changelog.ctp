<div class="marginbottom10">
    <?php echo $this->element('changelogsubmenu'); ?>
    <?php echo $this->element('changelognextversion'); ?>
    <div class="btn-group pull-left" style="margin-bottom:15px;">
        <a class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown" href="#">
          Version <?php echo $changelogdemandes[0]['Changelogversion']['VERSION'] ; ?>
          <span class="caret"></span>
        </a>
        <ul class="dropdown-menu">
            <?php foreach($versions as $version): ?>
            <li style="text-align:left;"><?php echo $this->Html->link($version['Changelogversion']['VERSION'], array('action'=>'changelog',$version['Changelogversion']['id']),array('class'=>'showoverlay')); ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <div style="clear:both;border: solid 1px #D5D5D5; padding-top:15px !important">
    <?php foreach ($changelogdemandes as $changelogdemande): ?>
        <ul style="margin-bottom:5px !important;">
            <li style="font-weight: bold;">[<?php echo $changelogtypes[$changelogdemande['Changelogdemande']['TYPE']]; ?>] <?php echo $changelogdemande['Changelogdemande']['DEMANDE']; ?></li>
            <ul style="font-style: italic;">
                <?php $reponses = $this->requestAction('changelogreponses/get_all_reponses/'.$changelogdemande['Changelogdemande']['id']); ?>
                <?php foreach($reponses as $reponse):
                    echo '<li>Le : '.$reponse['Changelogreponse']['modified'].'<br>'.$reponse['Changelogreponse']['REPONSE'].'</li>';
                endforeach; ?>                                    
            </ul>
        </ul>
    <?php endforeach; ?>
    </div>
</div>  