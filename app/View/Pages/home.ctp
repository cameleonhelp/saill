<?php
$this->set('title_for_layout','Accueil');
//echo $this->element('multiselect_user'); 
?>
<div class="row clearfix">
    <div class="col-sm-8 column">
        <div class="carousel slide min-height-420" id="carousel-message"  data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carousel-message" data-slide-to="0" class="active"></li>
                <?php 
                $activeMessages = $this->requestAction('messages/activeMessage');
                if (isset($activeMessages)):
                    $i = 1;
                    foreach ($activeMessages as $activeMessage) { ?>
                        <li data-target="#carousel-message" data-slide-to="<?php echo $i; ?>"></li>                        
                <?php
                    $i++;                
                    }
                endif;
                ?>  
            </ol>        
            <div class="carousel-inner ">
                <div class="item active">
                    <div class="well well-small top-header-orange">
                        Ce site à pour objectif de suivre les activités, livrables réalisés sur le projet.<br/><br/>
                        Ce site est accessible à toutes personnes travaillant sur le projet.<br/><br/>
                        Un accès à votre profil vous permettra de suivre certaines informations vous concernant.<br/>
                        A partir de ce site vous pourrez indiquer vos absences, cela ne dispense pas d'en faire la demande à votre responsable.<br/>
                        Pour les agents SNCF la saisie des absences est à faire via l'application de suivi des absences.<br/><br/>
                        Le menu 'Absences équipe' vous permettra de voir les indisponibilités de toutes les personnes travaillant sur le projet.<br/><br/>
                        Dans les actions un filtre 'Todolist' vous permettra de suivre toutes vos activités ainsi que celles des personnes travaillant sur le même domaine que vous, 
                        ou de toute votre équipe si vous avez la charge d'une équipe d'agents.<br/><br/>
                        Le suivi des livrables vous permettra de suivre l'avancement des livrables, ces livrables peuvent être liés à des actions.<br/><br/>
                        Enfin des liens utiles à tous, peuvent être partagés, seul celui qui a déposé le lien, peux le modifier ou le supprimer.<br/>
                        <br/>
                        Vous trouverez ci-dessous des fichiers qui sont à votre disposition ci-dessous pour vous aider dans votre activité ou des informations à connaître.<br/>
                        <br/>
                        Nous espérons que ce site vous facilitera votre restitution d'activité et un meilleur partage de l'information.
                    </div>                
                </div>
                <?php 
                if (isset($activeMessages)):
                    foreach ($activeMessages as $activeMessage) { ?>
                        <div class="item">
                            <div class="well well-small top-header-orange"><?php echo $activeMessage['Message']['LIBELLE']; ?></div>
                        </div>                           
                <?php    }
                endif;
                ?>        
            </div>
        </div>
    </div>
    <div class="col-sm-4 column">
        <?php echo $this->element('home/mystats'); ?>
    </div>
</div>
<div class="row">
    <div class="col-sm-12 column">
        <div class="col-sm-12 column">
        <div style='display: table;width: 100%;'>
            <?php echo $this->element('home/elementsfields'); ?>
        </div> 
        </div>
    </div>
</div>
<div class="row clearfix">
    <div class="col-sm-12 column">
        <div class="col-sm-4 column">
            <?php echo $this->element('home/info-left'); ?>
        </div>
        <div class="col-sm-4 column">
            <?php echo $this->element('home/info-middle'); ?>
        </div>
        <div class="col-sm-4 column">
            <?php echo $this->element('home/info-right'); ?>
        </div>
    </div>
</div>
<script>
$(document).ready(function () {
    var defaultpswd = "<?php echo md5('SAILL'); ?>";
    var userpswd = "<?php echo userAuth('password'); ?>";
    if(defaultpswd === userpswd){$('#modalpassword').modal('show');}
});
</script>  
