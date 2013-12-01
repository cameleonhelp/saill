<div class="marginright20">
    <?php echo $this->element('changelogsubmenu'); ?>
    <div class="changelogdemandes view">      
        <div class="block-panel-50-left">
        <div class="form-group">
            <label class="col-lg-4" for="ChangelogreponseVersionId">Version : </label>
            <div  class="col-lg-6">
                <div class="well well-sm" style="background-color: #FFFFFF;">
                <?php echo $changelogdemande['Changelogversion']['VERSION']; ?>&nbsp;  
                </div>    
            </div>
        </div>
        <div class="form-group">
            <label class="col-lg-4" for="ChangelogreponseETAT">Etat : </label>
            <div  class="col-lg-6">
                <div class="well well-sm" style="background-color: #FFFFFF;">
                <?php echo $changelogetats[$changelogdemande['Changelogdemande']['ETAT']]; ?>   
                </div>         
            </div>
        </div>            
        </div>
        <div class="block-panel-50-right">
        <div class="form-group">
            <label class="col-lg-4" for="ChangelogreponseTYPE">Type : </label>
            <div  class="col-lg-6">
                <div class="well well-sm" style="background-color: #FFFFFF;">
                <?php echo $changelogtypes[$changelogdemande['Changelogdemande']['TYPE']]; ?>   
                </div>          
            </div>
        </div>
        <div class="form-group">
            <label class="col-lg-4" for="ChangelogreponseCRITICITE">Criticité : </label>
            <div  class="col-lg-6">
                <div class="well well-sm" style="background-color: #FFFFFF;">
                <?php echo $changelogcriticites[$changelogdemande['Changelogdemande']['CRITICITE']]; ?>   
                </div>          
            </div>
        </div>            
        </div>  
        <div class="form-group">
            <label class="col-lg-2" for="ChangelogreponseDEMANDE">Demande : </label>
            <div  class="col-lg-9">
                <div class="well well-sm" style="background-color: #FFFFFF;">
                <?php echo $changelogdemande['Changelogdemande']['DEMANDE']; ?>  
                </div>
            </div>
        </div>
    </div>
    <div style="clear:both;margin-top: 10px;">
    <div class="form-group">
        <div class="btn-block-horizontal" style="margin:0px;">
            <?php echo $this->Form->create('Changelogdemande',array('id'=>'formValidate','class'=>'form-horizontal','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?>
            <?php echo $this->Form->button('Annuler', array('type'=>'submit','class' => 'btn btn-sm btn-default showoverlay cancel','value'=>'cancel','div' => false, 'name' => 'cancel')); ?>
            <?php echo $this->Form->end(); ?>
            <?php //echo $this->Html->link('Annuler',array('controller'=>'changelogdemandes','action'=>'index/0/1',0,1), array('class' => 'btn btn-sm btn-default showoverlay')); ?>              
      </div>
    </div>  
    </div>     
    <?php //Ajouter toutes les réponses de cette demandes// ?>
    <?php if(!isset($reponses)): ?>
    <h6>Voici les réponses apportées à cette demande :</h6>
    <?php echo $this->element('tablereponses'); ?>   
    <?php endif; ?>
</div>
