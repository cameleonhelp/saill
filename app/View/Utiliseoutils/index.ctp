<div class="utiliseoutils index">
        <div class="navbar">
            <div class="navbar-inner">
                <div class="container">
                <ul class="nav">
                <?php 
                    $pass0 = isset($this->params->pass[0]) ? $this->params->pass[0] : 'tous';
                    $pass1 = isset($this->params->pass[1]) ? $this->params->pass[1] : 'tous';
                    $pass2 = isset($this->params->pass[2]) ? $this->params->pass[2] : 'tous';
                ?>
                <?php if (userAuth('profil_id')!='2' && isAuthorized('utiliseoutils', 'add')) : ?>
                <li><?php echo $this->Html->link('<i class="icon-plus"></i>', array('action' => 'add'),array('escape' => false)); ?></li>
                <li class="divider-vertical-only"></li>
                <?php endif; ?>
                <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Filtre Etats <b class="caret"></b></a>
                     <ul class="dropdown-menu">
                     <li><?php echo $this->Html->link('Tous sans retour utilisateur', array('action' => 'index','tous',$pass1,$pass2)); ?></li>
                     <li class="divider"></li>
                         <?php foreach ($etats as $etat): ?>
                            <li><?php echo $this->Html->link($etat['Utiliseoutil']['STATUT'], array('action' => 'index',$etat['Utiliseoutil']['STATUT'],$pass1,$pass2)); ?></li>
                         <?php endforeach; ?>
                      </ul>
                 </li>   
                <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Filtre Utilisateur <b class="caret"></b></a>
                     <ul class="dropdown-menu">
                     <li><?php echo $this->Html->link('Tous', array('action' => 'index',$pass0,'tous',$pass2)); ?></li>
                     <li class="divider"></li>
                         <?php foreach ($utilisateurs as $utilisateur): ?>
                            <li><?php echo $this->Html->link($utilisateur['Utilisateur']['NOMLONG'], array('action' => 'index',$pass0,$utilisateur['Utilisateur']['id'],$pass2)); ?></li>
                         <?php endforeach; ?>
                      </ul>
                </li> 
                <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Filtre Outils <b class="caret"></b></a>
                     <ul class="dropdown-menu">
                     <li><?php echo $this->Html->link('Tous', array('action' => 'index',$pass0,$pass1,'tous')); ?></li>
                     <li class="divider"></li>
                         <?php foreach ($outils as $outil): ?>
                            <li><?php echo $this->Html->link($outil['Outil']['NOM'], array('action' => 'index',$pass0,$pass1,'O_'.$outil['Outil']['id'])); ?></li>
                         <?php endforeach; ?>
                      <li class="divider"></li>
                         <?php foreach ($listes as $liste): ?>
                            <li><?php echo $this->Html->link($liste['Listediffusion']['NOM'], array('action' => 'index',$pass0,$pass1,'L_'.$liste['Listediffusion']['id'])); ?></li>
                         <?php endforeach; ?>
                      <li class="divider"></li>
                         <?php foreach ($partages as $partage): ?>
                            <li><?php echo $this->Html->link($partage['Dossierpartage']['NOM'], array('action' => 'index',$pass0,$pass1,'P_'.$partage['Dossierpartage']['id'])); ?></li>
                         <?php endforeach; ?>                            
                      </ul>
                 </li>                 
                <?php if (userAuth('profil_id')!='2' && isAuthorized('utiliseoutils', 'update')) : ?>
                <li class="divider-vertical-only"></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-check"></i> Actions groupées <b class="caret"></b></a>
                     <ul class="dropdown-menu">
                     <li><?php echo $this->Html->link('Mettre à jour l\'état', "#",array('id'=>'updatelink')); ?></li>
                     </ul>
                </li> 
                <?php endif; ?>
                </ul> 
                <?php echo $this->Form->create("Utiliseoutil",array('action' => 'search','class'=>'navbar-form clearfix pull-right','inputDefaults' => array('label'=>false,'div' => false))); ?>
                    <?php echo $this->Form->input('SEARCH',array('class'=>'span8','placeholder'=>'Recherche dans tous les champs')); ?>
                    <button type="submit" class="btn">Rechercher</button>
                <?php echo $this->Form->end(); ?>                     
                </div>
            </div>
        </div>
        <?php if ($this->params['action']=='index') { ?><code class="text-normal"  style="margin-bottom: 10px;display: block;"><em>Liste des droits <?php echo $fetat; ?> <?php echo $futilisateur; ?> <?php echo $foutil; ?></em></code><?php }?>   
        <table cellpadding="0" cellspacing="0" class="table table-bordered table-striped table-hover">
        <thead>
	<tr>
			<th><?php echo $this->Paginator->sort('utilisateur_id','Utilisateur'); ?></th>
			<th><?php echo $this->Paginator->sort('outil_id','Outil'); ?></th>
                        <th><?php echo $this->Paginator->sort('outil_id','Liste de diffusion'); ?></th>
                        <th><?php echo $this->Paginator->sort('outil_id','Partage réseau'); ?></th>
                        <?php if (userAuth('profil_id')!='2' && isAuthorized('utiliseoutils', 'update')) : ?>
                        <th style="text-align:center;width:15px !important;vertical-align: middle;padding-left:5px;padding-right:5px;"><?php echo $this->Form->input('checkall',array('type'=>'checkbox','label'=>false)) ; ?>
                                <?php echo $this->Form->input('all_ids',array('type'=>'hidden')) ; ?>
                        </th>      
                        <?php endif; ?>
			<th><?php echo $this->Paginator->sort('STATUT','Etat'); ?></th>
                        <th width="80px;"><?php echo $this->Paginator->sort('modified','Dernière mise à jour'); ?></th>
			<th class="actions" width="60px;"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
        <tbody>
	<?php if (isset($utiliseoutils)): ?>
	<?php foreach ($utiliseoutils as $utiliseoutil): ?>
	<tr>
		<td><?php echo h($utiliseoutil['Utilisateur']['NOM'].' '.$utiliseoutil['Utilisateur']['PRENOM']); ?>&nbsp;</td>
		<td><?php echo h($utiliseoutil['Outil']['NOM']); ?>&nbsp;</td>
                <td><?php echo h($utiliseoutil['Listediffusion']['NOM']); ?>&nbsp;</td>
                <td><?php echo h($utiliseoutil['Dossierpartage']['NOM']); ?>&nbsp;</td>
                <?php if (userAuth('profil_id')!='2' && isAuthorized('utiliseoutils', 'update')) : ?>
                <td style="text-align:center;padding-left:5px;padding-right:5px;vertical-align: middle;"><?php echo $this->Form->input('id',array('type'=>'checkbox','label'=>false,'class'=>'idselect','value'=>$utiliseoutil['Utiliseoutil']['id'])) ; ?></td>                
                <td style='text-align:center;'><?php echo $this->Html->link('<i class="changeetat '.etatUtiliseOutilImage(h($utiliseoutil['Utiliseoutil']['STATUT'])).'" rel="tooltip" data-title="'.h($utiliseoutil['Utiliseoutil']['STATUT']).'" idaction="'.$utiliseoutil['Utiliseoutil']['id'].'"></i>', '#', array('escape' => false,'idaction'=>$utiliseoutil['Utiliseoutil']['id'])); ?></td>
                <td style="text-align: center;"><?php echo h($utiliseoutil['Utiliseoutil']['modified']); ?>&nbsp;</td>
                <?php else : ?>
                <td style='text-align:center;'><?php echo '<i class="'.etatUtiliseOutilImage(h($utiliseoutil['Utiliseoutil']['STATUT'])).'" rel="tooltip" data-title="'.h($utiliseoutil['Utiliseoutil']['STATUT']).'"></i>'; ?></td>                
                <?php endif; ?>
		<td class="actions">
                    <?php if (userAuth('profil_id')!='2' && isAuthorized('utiliseoutils', 'view')) : ?>
                    <?php echo '<i class="icon-eye-open" rel="popover" data-title="<h3>Demande de droit :</h3>" data-content="<contenttitle>Crée le: </contenttitle>'.h($utiliseoutil['Utiliseoutil']['created']).'<br/><contenttitle>Modifié le: </contenttitle>'.h($utiliseoutil['Utiliseoutil']['modified']).'" data-trigger="click" style="cursor: pointer;"></i>'; ?>&nbsp;
                    <?php endif; ?>
                    <?php if (userAuth('profil_id')!='2' && isAuthorized('utiliseoutils', 'edit')) : ?>
                    <?php echo $this->Html->link('<i class="icon-pencil"></i>', array('action' => 'edit', $utiliseoutil['Utiliseoutil']['id']),array('escape' => false)); ?>&nbsp;
                    <?php endif; ?>
                    <?php if (userAuth('profil_id')!='2' && isAuthorized('utiliseoutils', 'delete')) : ?>
                    <?php echo $this->Form->postLink('<i class="icon-trash"></i>', array('action' => 'delete', $utiliseoutil['Utiliseoutil']['id']),array('escape' => false), __('Etes-vous certain de vouloir supprimer cette demande de droit ?')); ?>                    
                    <?php endif; ?>
		</td>
	</tr>
        <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
	</table>
	<div class="pull-left"><?php echo $this->Paginator->counter('Page {:page} sur {:pages}'); ?></div>
	<div class="pull-right"><?php echo $this->Paginator->counter('Nombre total d\'éléments : {:count}'); ?></div>     
	<div class="pagination  pagination-centered">
        <ul>
	<?php
                echo "<li>".$this->Paginator->first('<<', true, null, array('class' => 'disabled'))."</li>";
		echo "<li>".$this->Paginator->prev('<', array(), null, array('class' => 'prev disabled'))."</li>";
		echo "<li>".$this->Paginator->numbers(array('separator' => ''))."</li>";
		echo "<li>".$this->Paginator->next('>', array(), null, array('class' => 'disabled'))."</li>";
                echo "<li>".$this->Paginator->last('>>', true, null, array('class' => 'disabled'))."</li>";
	?>
        </ul>
	</div>
</div>
<script>
    
     $(document).ready(function () {
       
        $(document).on('click','#updatelink',function(e){
            var ids = $("#all_ids").val();
            var overlay = jQuery('<div id="overlay"><?php echo $this->Html->image("loading.gif"); ?> Travail en cours, veuillez patienter ...</div>');
            overlay.appendTo(document.body)
            $.ajax({
                dataType: "html",
                type: "POST",
                url: "<?php echo $this->Html->url(array('controller'=>'utiliseoutils','action'=>'allupdate')); ?>/",
                data: ({all_ids:ids})
            }).done(function ( data ) {
                location.reload();
                overlay.remove();
            });
            $(this).parents().find(':checkbox').prop('checked', false);
            $("#all_ids").val('');
        });
        
        $(document).on('click','#checkall',function(e){
            $(this).parents().find(':checkbox').prop('checked', this.checked);
            if ($(this).is(':checked')){
                $(".idselect").each(
                        function() {
                            if ($("#all_ids").val()==""){
                                $("#all_ids").val($(this).val());                    
                            }else{
                                $("#all_ids").val($("#all_ids").val()+"-"+$(this).val());
                            }
                        });          
            }else{
                $("#all_ids").val("");
            }
        });
        
        $(document).on('click','.changeetat',function(e){
            var id = $(this).attr('idaction');
            if(confirm('Etes-vous certain de vouloir mettre à jour le statut de cette demande de droit ?')){
                $.ajax({
                    dataType: "html",
                    type: "POST",
                    url: "<?php echo $this->Html->url(array('controller'=>'utiliseoutils','action'=>'progressstate')); ?>/",
                    data: ({id:id})
                }).done(function ( data ) {
                    location.reload();
                });
            }
        });
    
        $(document).on('click','.idselect',function(e){
            if ($(this).is(':checked')){
                if ($("#all_ids").val()==""){
                    $("#all_ids").val($(this).val());                    
                }else{
                    $("#all_ids").val($("#all_ids").val()+"-"+$(this).val());
                }
            } else {
                var list = $("#all_ids").val();
                $("#all_ids").val("");
                tmp = list.replace($(this).val()+"-", "");
                if (tmp == list) tmp = list.replace("-"+$(this).val(), ""); 
                $("#all_ids").val(tmp);
            }
        });
    });
</script>