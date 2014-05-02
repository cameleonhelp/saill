<nav class="navbar toolbar ">
        <ul class="nav navbar-nav toolbar">
        <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Demandes <b class="caret"></b></a>
             <ul class="dropdown-menu">
             <?php if ($this->params->controller!='changelogdemandes' || $this->params->action!='add') : ?>
             <li><?php echo $this->Html->link('Ajouter', array('controller'=>'changelogdemandes','action' => 'add'),array('class'=>'showoverlay')); ?></li>
             <li class='divider'></li>
             <?php endif; ?>
            <?php if (userAuth('profil_id')=='1' || isAuthorized('changelogreponses', 'add')) : ?>
             <li><?php echo $this->Html->link('Liste des demandes', array('controller'=>'changelogdemandes','action' => 'index',0,1),array('class'=>'showoverlay')); ?></li>
             <?php else: ?>
             <li><?php echo $this->Html->link('Mes demandes', array('controller'=>'changelogdemandes','action' => 'index',0,1),array('class'=>'showoverlay')); ?></li>
             <li><?php echo $this->Html->link('Changements à venir', array('controller'=>'changelogdemandes','action' => 'listetodo'),array('class'=>'showoverlay')); ?></li>
             <?php endif; ?>   
             <li class='divider'></li>
             <li><?php echo $this->Html->link('Journal des changements', array('controller'=>'changelogdemandes','action' => 'changelog'),array('class'=>'showoverlay')); ?></li>
             </ul>
        </li>   
        <?php if (userAuth('profil_id')=='1' || isAuthorized('changelogreponses', 'add')) : ?>
        <li class="divider-vertical-only"></li>
        <li><?php echo $this->Html->link('Versions', array('controller'=>'changelogversions','action' => 'index'),array('class'=>'paddingtop3 showoverlay')); ?></li>
        <?php if($this->params->controller=='changelogdemandes' && $this->params->action == "index"): ?>
        <li class="divider-vertical-only"></li>
        <li><?php echo $this->Html->link('<span class="ico-xls" rel="tooltip" data-container="body" data-title="Export Excel"></span>', array('action' => 'export_xls'),array('escape' => false)); ?></li>        
        <?php endif; ?>
        <?php endif; ?>      
        </ul>    
        <?php if($this->params->controller=='changelogdemandes' && $this->params->action == "index"): ?>
            <?php $checked = isset($this->params->pass[1]) && $this->params->pass[1]==1 ? 'checked' : ''; ?>
            <?php $labelchecked = isset($this->params->pass[1]) && $this->params->pass[1]==1 ? 'Ouvertes ' : 'Toutes '; ?>
            <ul class="nav navbar-nav navbar-right" style="margin-right:7px;">
                <li class="pull-right"><label id="filterlabel" name="filterlabel" for="filter" style="float:left;margin-top:8px;margin-right: 5px;"><?php echo $labelchecked; ?></label><label><input type="checkbox" id="filter" class="ios-switch green tinyswitch" <?php echo $checked; ?>/><div style="margin:8px 3px;"><div></div></div></label></li>
            </ul>
        <?php endif; ?>      
</nav>
<script>
    <?php 
        $pass2 = isset($this->params->pass[2]) ? $this->params->pass[2] : 'tous';
        $pass3 = isset($this->params->pass[3]) ? $this->params->pass[3] : 'tous';        
        $pass4 = isset($this->params->pass[4]) ? $this->params->pass[4] : 'tous';   
        $pass5 = isset($this->params->pass[5]) ? $this->params->pass[5] : 'tous';
        $pass = $pass2."/".$pass3."/".$pass4."/".$pass5;
        
    ?>
    $(document).ready(function () {
        $(document).on('click',".ios-switch",function() {
            var overlay = $('#overlay');
            overlay.show();            
            var checked = $(this).prop("checked");
            if(checked){
                checked = '1';
                $("#filterlabel").text('Ouvertes ');
            } else {
                $("#filterlabel").text('Toutes ');
                checked = '0';
            }
            location.href =  "<?php echo $this->Html->url(array('controller'=>'changelogdemandes')); ?>/index/0/"+checked+"/<?php echo $pass?>";          
        });
    });
</script>