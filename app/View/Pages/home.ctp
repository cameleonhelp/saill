<div class='block-panel block-panel-66-left'>
<?php
$this->set('title_for_layout','Accueil');
?>
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
<div style='display: table;width: 100%;'>
<?php echo $this->element('elementsfields'); ?>
</div>
</div>
<div class='block-panel block-panel-33-right' style="margin-right: 10px !important;">
<?php echo $this->element('mystats'); ?>
</div>