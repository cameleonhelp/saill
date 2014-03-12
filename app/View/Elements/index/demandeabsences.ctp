<?php //filtres par défaut
$pass0 = isset($this->params->pass[0]) ? $this->params->pass[0] : 'tous'; //demandeur
$pass1 = isset($this->params->pass[1]) ? $this->params->pass[1] : '0'; //réponse
$pass2 = isset($this->params->pass[2]) ? $this->params->pass[2] : '2'; //traité ou non     
?>      
<nav class="navbar toolbar">
        <ul class="nav navbar-nav toolbar">
        <?php if (userAuth('profil_id')!='2' && isAuthorized('demandeabsences', 'add')) : ?>
        <li><?php echo $this->Html->link('<span class="glyphicons plus size14 margintop4"></span>', "#",array('escape' => false,'data-toggle'=>"modal", 'data-target'=>"#modaldemandeabsences")); ?></li>
        <?php endif; ?>
        <li class="divider-vertical-only"></li>
        <!-- filtres -->
        <li class="dropdown <?php echo filtre_is_actif($pass0,'tous'); ?>">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Filtre demandeur <b class="caret"></b></a>
             <ul class="dropdown-menu">
             <li><?php echo $this->Html->link('Mon équipe', array('action' => 'index','tous',$pass1,$pass2),array('class'=>'showoverlay'.subfiltre_is_actif($pass0,'tous'))); ?></li>
             <li class="divider"></li>
                 <?php foreach ($utilisateurs as $utilisateur): ?>
                    <li><?php echo $this->Html->link($utilisateur['Utilisateur']['NOMLONG'], array('action' => 'index',$utilisateur['Utilisateur']['id'],$pass1,$pass2),array('class'=>'showoverlay'.subfiltre_is_actif($pass0,$utilisateur['Utilisateur']['id']))); ?></li>
                 <?php endforeach; ?>
              </ul>
        </li>    
        <li class="dropdown <?php echo filtre_is_actif($pass1,'tous'); ?>">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Filtre réponse <b class="caret"></b></a>
             <ul class="dropdown-menu">
             <li><?php echo $this->Html->link('Tous', array('action' => 'index',$pass0,'tous',$pass2),array('class'=>'showoverlay'.subfiltre_is_actif($pass1,'tous'))); ?></li>
             <li class="divider"></li>
             <li><?php echo $this->Html->link('En attente', array('action' => 'index',$pass0,0,$pass2),array('class'=>'showoverlay'.subfiltre_is_actif($pass1,'0'))); ?></li>
             <li><?php echo $this->Html->link('Validée', array('action' => 'index',$pass0,1,$pass2),array('class'=>'showoverlay'.subfiltre_is_actif($pass1,'1'))); ?></li>
             <li><?php echo $this->Html->link('Refusée', array('action' => 'index',$pass0,2,$pass2),array('class'=>'showoverlay'.subfiltre_is_actif($pass1,'2'))); ?></li>
             <li><?php echo $this->Html->link('Supprimée', array('action' => 'index',$pass0,3,$pass2),array('class'=>'showoverlay'.subfiltre_is_actif($pass1,'3'))); ?></li>
              </ul>
        </li>     
        <li class="dropdown <?php echo filtre_is_actif($pass2,'tous'); ?>">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Filtre date début <b class="caret"></b></a>
             <ul class="dropdown-menu">
             <li><?php echo $this->Html->link('Aucune contrainte', array('action' => 'index',$pass0,$pass1,'tous'),array('class'=>'showoverlay'.subfiltre_is_actif($pass2,'tous'))); ?></li>
             <li class="divider"></li>
             <li><?php echo $this->Html->link('Avant d\'aujoud\'hui', array('action' => 'index',$pass0,$pass1,1),array('class'=>'showoverlay'.subfiltre_is_actif($pass2,'1'))); ?></li>
             <li><?php echo $this->Html->link('Après d\'aujoud\'hui (inclus)', array('action' => 'index',$pass0,$pass1,2),array('class'=>'showoverlay'.subfiltre_is_actif($pass2,'2'))); ?></li>
             </ul>
        </li>                  
        </ul>             
</nav>    
    <?php if ($this->params['action']=='index') { ?><div class="panel-body panel-filter marginbottom15 ">
    <strong>Filtre appliqué : </strong><em>Liste des demandes d'absences <?php echo $strfilter; ?></em></div><?php } ?>     
<div class="">
<table cellpadding="0" cellspacing="0" class="table table-bordered table-striped table-hover">
<thead>
<tr>
                <th><?php echo $this->Paginator->sort('Utilisateur.NOM','Demandeur'); ?></th>
                <th><?php echo $this->Paginator->sort('DATEDU','Du'); ?></th>
                <th><?php echo $this->Paginator->sort('DATEAU','Au'); ?></th>
                <th><?php echo $this->Paginator->sort('DATEDEMANDE','Demandé le'); ?></th>
                <th><?php echo $this->Paginator->sort('REPONSE','Réponse'); ?></th>
                <th><?php echo $this->Paginator->sort('DATEREPONSE','Réponse le'); ?></th>
                <th><?php echo $this->Paginator->sort('REPONSEBY','Responsable'); ?></th>
                <th class="actions"><?php echo __('Actions'); ?></th>
</tr>
</thead>
<tbody>        
<?php foreach ($demandeabsences as $demandeabsence): ?>
<tr>
        <td><?php echo h($demandeabsence['Utilisateur']['NOMLONG']); ?></td>
        <?php $heuredeb = $demandeabsence['Demandeabsence']['DATEDUTYPE']=='8' ? '08:00' : '13:00'; ?>
        <td><?php echo h($demandeabsence['Demandeabsence']['DATEDU']." ".$heuredeb); ?>&nbsp;</td>
        <?php $heurefin = $demandeabsence['Demandeabsence']['DATEAUTYPE']=='16' ? '17:00' : '12:00'; ?>
        <td><?php echo h($demandeabsence['Demandeabsence']['DATEAU']." ".$heurefin); ?>&nbsp;</td>
        <td><?php echo h($demandeabsence['Demandeabsence']['DATEDEMANDE']); ?>&nbsp;</td>
        <td style="text-align: center;">
            <?php 
            if(userAuth('societe_id')==1):
                if($demandeabsence['Demandeabsence']['REPONSE']==NULL):
                    echo $this->Html->link('<span class="glyphicons ok_2 disabled notchange"></span>', "#",array('escape' => false,'data-id'=>$demandeabsence['Demandeabsence']['id']));
                    echo '<span class="glyphicons blank"></span>';
                    echo $this->Html->link('<span class="glyphicons remove_2 disabled notchange"></span>', "#",array('escape' => false,'data-id'=>$demandeabsence['Demandeabsence']['id']));
                else:
                    if ($demandeabsence['Demandeabsence']['REPONSE']=='3'):
                        echo '<span class="glyphicons bin disabled"></span>';
                    else:
                        $valide = $demandeabsence['Demandeabsence']['REPONSE']=='1' ? 'green' : 'disabled';
                        $refuse = $demandeabsence['Demandeabsence']['REPONSE']=='2' ? 'red' : 'disabled';
                        echo '<span class="glyphicons ok_2 '.$valide.' notchange"></span>';
                        echo '<span class="glyphicons blank"></span>';
                        echo '<span class="glyphicons remove_2 '.$refuse.' notchange"></span>';                                
                    endif;
                endif;
            else:
                echo CReponse($demandeabsence['Demandeabsence']['REPONSE']);
            endif;
            ?>
        </td>
        <td><?php echo h($demandeabsence['Demandeabsence']['DATEREPONSE']); ?>&nbsp;</td>
        <td><?php echo h($demandeabsence['Demandeabsence']['REPONSEBY_NOM']); ?>&nbsp;</td>
        <td class="actions">
            <?php echo '<span class="glyphicons eye_open" data-rel="popover" data-title="<h3>Détail de la demande :</h3>" data-content="<contenttitle>Motif: </contenttitle>'.$demandeabsence['Demandeabsence']['MOTIF'].'" data-trigger="click" style="cursor: pointer;"></span>'; ?>&nbsp;
            <?php if (userAuth('profil_id')!='2' && isAuthorized('demandeabsences', 'edit')) : ?>
            <?php //echo $this->Html->link('<span class="glyphicons pencil notchange"></span>', "#",array('escape' => false,'data-id'=>$demandeabsence['Demandeabsence']['id'])); ?>&nbsp;
            <?php endif; ?>
            <?php if (userAuth('profil_id')!='2' && isAuthorized('demandeabsences', 'delete') && $demandeabsence['Demandeabsence']['REPONSE']==NULL) : ?>
            <?php echo $this->Html->link('<span class="glyphicons bin notchange"></span>', "#",array('escape' => false,'data-id'=>$demandeabsence['Demandeabsence']['id'])); ?>
            <?php echo $this->Html->link('<span class="glyphicons envelope notchange"></span>', array('action' => 'sendmailrelancedemande',$demandeabsence['Demandeabsence']['id']),array('escape' => false),'Confirmez vous l\'envois de ce mail de relance ?'); ?>
            <?php endif; ?>      

        </td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
</div>
<div class="pull-left">	<?php	echo $this->Paginator->counter('Page {:page} sur {:pages}');	?></div>
<div class="pull-right "><?php	echo $this->Paginator->counter('Nombre total d\'éléments : {:count}');	?></div>
<div class='text-center'>
<ul class="pagination pagination-sm">
<?php
        echo "<li>".$this->Paginator->first('<<', true, null, array('class' => 'disabled showoverlay','escape'=>false))."</li>";
        echo "<li>".$this->Paginator->prev('<', array(), null, array('class' => 'prev disabled showoverlay','escape'=>false))."</li>";
        echo "<li>".$this->Paginator->numbers(array('separator' => '','class'=>'showoverlay'))."</li>";
        echo "<li>".$this->Paginator->next('>', array(), null, array('class' => 'disabled showoverlay','escape'=>false))."</li>";
        echo "<li>".$this->Paginator->last('>>', true, null, array('class' => 'disabled showoverlay','escape'=>false))."</li>";
?>
</ul>
</div>
<script>
$(document).ready(function () {    
    $(document).on('click','.pencil',function(e){
        var id = $(this).parent('a').attr('data-id');
        $.ajax({
            type: "POST",       
            url: "<?php echo $this->Html->url(array('controller'=>'demandeabsences','action'=>'json_get_info')); ?>/" + id,
            contentType: "application/json",
            success : function(response) {
                var json = $.parseJSON(response);
                $('.form-horizontal').append("<input type='hidden' name='data[Demandeabsence][id]' id='DemandeabsenceId' value='"+json[0]['Demandeabsence']['id']+"'>");
                $('#closemodaldemandeabsences').attr('type', "submit");
                $('#DemandeabsenceUtilisateurId').val(json[0]['Demandeabsence']['utilisateur_id']);
                $('#DemandeabsenceDATEDU').val(json[0]['Demandeabsence']['DATEDU']);
                $('#DemandeabsenceDATEDUTYPE').val(json[0]['Demandeabsence']['DATEDUTYPE']);
                $('#DemandeabsenceDATEAU').val(json[0]['Demandeabsence']['DATEAU']);
                $('#DemandeabsenceDATEAUTYPE').val(json[0]['Demandeabsence']['DATEAUTYPE']);
                $('.form-horizontal').attr('action', "<?php echo $this->Html->url(array('controller'=>'demandeabsences','action'=>'edit')); ?>");
                $('#modaldemandeabsences').modal('show');
            },
            error :function(response,status,errorThrown) {
                alert("Erreur! il se peut que votre session soit expirée\n\rActualiser la page et recommencer.");
            }
         });
    });     
    
    $(document).on('click','.ok_2',function(e){
        var id = $(this).parent('a').attr('data-id');
        if(confirm("Voulez-vous valider cette demande d'absences ?")){
            $.ajax({
                dataType: "html",
                type: "POST",
                url: "<?php echo $this->Html->url(array('controller'=>'demandeabsences','action'=>'valid')); ?>/",
                data: ({id:id,etat:1})
            }).done(function ( data ) {
                location.reload();
            });
        }
    });
    
    $(document).on('click','.remove_2',function(e){
        var id = $(this).parent('a').attr('data-id');
        if(confirm("Voulez-vous refuser cette demande d'absences ?")){
            $.ajax({
                dataType: "html",
                type: "POST",
                url: "<?php echo $this->Html->url(array('controller'=>'demandeabsences','action'=>'valid')); ?>/",
                data: ({id:id,etat:2})
            }).done(function ( data ) {
                location.reload();
            });
        }        
    });  
    
    $(document).on('click','.bin',function(e){
        var id = $(this).parent('a').attr('data-id');
        if(confirm("Voulez-vous supprimer cette demande d'absences ?")){
            $.ajax({
                dataType: "html",
                type: "POST",
                url: "<?php echo $this->Html->url(array('controller'=>'demandeabsences','action'=>'valid')); ?>/",
                data: ({id:id,etat:3})
            }).done(function ( data ) {
                location.reload();
            });
        }        
    });     
});
</script>