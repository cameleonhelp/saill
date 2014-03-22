<!-- Fixed navbar -->
<nav class="navbar navbar-default navbar-inverse navbar-fixed-top" role="navigation">
        <div class="navbar-header" style="padding-left:20px;">
            <div class="pull-left margintop5"><?php echo $this->Html->link($this->Html->image('logo-sncf-galactic.png'),"https://www.int.sncf.fr/",array('escape' => false,'target'=>'blank')); ?></div>
            <?php echo $this->Html->link('<span class="glyphicons home hard-grey margintop4 icons-navbar size14"></span>&nbsp;S.A.I.L.L. -',array('controller'=>'pages','action'=>'home'),array('class'=>"navbar-brand showoverlay",'escape' => false)); ?>
            <?php echo $this->Html->link($title_for_layout,"#",array('class'=>"navbar-brand","style"=>"margin-left:-20px;margin-top:0px;margin-bottom:0px;",'escape' => false)); ?>       
            <?php if ($this->Session->check('Auth.User')) echo $this->element('layout/server'); ?>
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-navbar-collapse-1"> 
            <span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
        </div>

        <div class="collapse navbar-collapse" id="bs-navbar-collapse-1" style="padding-left:20px;padding-right: 20px;">
                <?php if (userAuth('id') > 0): ?>
                <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicons user size14 hard-grey "></span>&nbsp;&nbsp;<?php echo userAuth('PRENOM'); ?> <?php echo userAuth('NOM'); ?>&nbsp;&nbsp;<b class="caret"></b></a>
                            <ul class="dropdown-menu">
                               <li><?php echo $this->Html->link('<span class="glyphicons keys margintop4 size14 notchange" ></span> Mot de passe','#',array( 'data-toggle'=>"modal",'data-target'=>"#modalpassword",'escape' => false)); ?></li>
                               <li><?php echo $this->Html->link('<span class="glyphicons nameplate margintop4 size14 notchange" ></span> Mon profil',array('controller'=>'utilisateurs','action'=>'profil',userAuth('id')),array('escape' => false,'class'=>'showoverlay')); ?></li>
                               <li class="divider"></li>
                               <li><?php echo $this->Html->link('<span class="glyphicons log_out margintop4 size14 notchange" ></span> Se déconnecter',array('controller'=>'utilisateurs','action'=>'logout'),array('class'=>'showoverlay','escape' => false)); ?></li>
                            </ul>
                        </li>
                </ul>
                <?php endif; ?>
        </div>
</nav>