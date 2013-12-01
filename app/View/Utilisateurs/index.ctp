<div class="utilisateurs index">
                 <?php 
                $pass0 = isset($this->params->pass[0]) ? $this->params->pass[0] : 'actif';
                $pass1 = isset($this->params->pass[1]) ? $this->params->pass[1] : 'allsections';
                $pass2 = isset($this->params->pass[2]) ? $this->params->pass[2] : 'tous';
                $pass3 = isset($this->params->pass[3]) ? $this->params->pass[3] : null;
                ?>  
    <nav class="navbar toolbar marginright20">
                <ul class="nav navbar-nav toolbar">
                <?php if (userAuth('profil_id')!='2' && isAuthorized('utilisateurs', 'add')) : ?>
                <li><?php echo $this->Html->link('<span class="glyphicons plus size14 margintop4"></span>', array('action' => 'add'),array('escape' => false)); ?></li>
                <li class="divider-vertical-only"></li>
                <?php endif; ?>
                <li class="dropdown <?php echo filtre_is_actif($pass0,'actif'); ?>">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Filtre Etats <b class="caret"></b></a>
                     <ul class="dropdown-menu">
                         <li><?php echo $this->Html->link('Tous', array('action' => 'index','tous',$pass1,$pass2,$pass3),array('class'=>'showoverlay'.subfiltre_is_actif($pass0,'tous'))); ?></li>
                         <li class="divider"></li>
                         <li><?php echo $this->Html->link('Actif', array('action' => 'index','actif',$pass1,$pass2,$pass3),array('class'=>'showoverlay'.subfiltre_is_actif($pass0,'actif'))); ?></li>
                         <li><?php echo $this->Html->link('Inactif', array('action' => 'index','inactif',$pass1,$pass2,$pass3),array('class'=>'showoverlay'.subfiltre_is_actif($pass0,'inactif'))); ?></li>
                         <li class="divider"></li>
                         <li><?php echo $this->Html->link('Nouveaux', array('action' => 'index','nouveau',$pass1,$pass2,$pass3),array('class'=>'showoverlay'.subfiltre_is_actif($pass0,'nouveau'))); ?></li>
                         <li><?php echo $this->Html->link('Incomplet', array('action' => 'index','incomplet',$pass1,$pass2,$pass3),array('class'=>'showoverlay'.subfiltre_is_actif($pass0,'incomplet'))); ?></li>
                         <li class="divider"></li>
                         <li><?php echo $this->Html->link('A prolonger', array('action' => 'index','aprolonger',$pass1,$pass2,$pass3),array('class'=>'showoverlay'.subfiltre_is_actif($pass0,'aprolonger'))); ?></li>
                      </ul>
                 </li> 
                <li class="dropdown <?php echo filtre_is_actif($pass1,'allsections'); ?>">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Filtre Sections <b class="caret"></b></a>
                     <ul class="dropdown-menu">
                     <li><?php echo $this->Html->link('Toutes', array('action' => 'index',$pass0,'allsections',$pass2,$pass3),array('class'=>'showoverlay'.subfiltre_is_actif($pass1,'allsections'))); ?></li>
                     <li class="divider"></li>
                         <?php foreach ($sections as $section): ?>
                            <li><?php echo $this->Html->link($section['Section']['NOM'], array('action' => 'index',$pass0,$section['Section']['id'],$pass2,$pass3),array('class'=>'showoverlay'.subfiltre_is_actif($pass1,$section['Section']['id']))); ?></li>
                         <?php endforeach; ?>
                      </ul>
                 </li>
                <li class="dropdown <?php echo filtre_is_actif($pass2,'tous'); ?>">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Filtre Sociétés <b class="caret"></b></a>
                     <ul class="dropdown-menu">
                     <li><?php echo $this->Html->link('Toutes', array('action' => 'index',$pass0,$pass1,'tous',$pass3),array('class'=>'showoverlay'.subfiltre_is_actif($pass2,'tous'))); ?></li>
                     <li class="divider"></li>
                     <li><?php echo $this->Html->link('SNCF', array('action' => 'index',$pass0,$pass1,'1',$pass3),array('class'=>'showoverlay'.subfiltre_is_actif($pass2,'1'))); ?></li>
                     <li><?php echo $this->Html->link('Autres', array('action' => 'index',$pass0,$pass1,'0',$pass3),array('class'=>'showoverlay'.subfiltre_is_actif($pass2,'0'))); ?></li>
                     </ul>
                 </li>                 
                <li class="divider-vertical-only"></li>
                <li><?php echo $this->Html->link('Filtre alphabétique','#',array('escape' => false,'id'=>'tooglealphafilter','class'=>'paddingtop3'.filtre_is_actif($pass3,''))); ?></li>
                <li class="divider-vertical-only"></li>                
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicons check"></span> Actions groupées <b class="caret"></b></a>
                     <ul class="dropdown-menu">
                     <li><?php echo $this->Html->link('Prolonger', "#",array('id'=>'prolongerlink','class'=>'')); ?></li>
                     <li><?php echo $this->Html->link('Désactiver', "#",array('id'=>'desactiverlink','class'=>'showoverlay')); ?></li>
                     </ul>
                </li>                 
                 <li class="divider-vertical-only"></li>
                <li><?php echo $this->Html->link('<span class="ico-xls" rel="tooltip" data-title="Export Excel"></span>', array('action' => 'export_xls'),array('class'=>"md",'escape' => false)); ?></li>
                <li class="divider-vertical-only"></li>
                </ul> 
                <?php echo $this->Form->create("Utilisateur",array('action' => 'search', 'class'=>'toolbar-form pull-right','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?>
                    <?php echo $this->Form->input('SEARCH',array('placeholder'=>'Recherche ...','style'=>"width: 188px;",'class'=>"form-control")); ?>
                    <button type="submit" class="btn form-btn showoverlay">Rechercher</button>
                <?php echo $this->Form->end(); ?>                    
        </nav>
        <nav class="navbar toolbar marginright20" id="subnavfilter" style="z-index:550;">
                <ul class="nav navbar-nav toolbar">
                        <li><?php echo $this->Html->link('Tous', array('action' => 'index',$pass0,$pass1,$pass2),array('class'=>'paddingtop3 sortalpha'.subfiltre_is_actif($pass3,''))); ?></li>
                        <li><?php echo $this->Html->link('A', array('action' => 'index',$pass0,$pass1,$pass2,0),array('class'=>'paddingtop3 sortalpha'.subfiltre_is_actif($pass3,'0'))); ?></li>
                        <li><?php echo $this->Html->link('B', array('action' => 'index',$pass0,$pass1,$pass2,1),array('class'=>'paddingtop3 sortalpha'.subfiltre_is_actif($pass3,'1'))); ?></li>
                        <li><?php echo $this->Html->link('C', array('action' => 'index',$pass0,$pass1,$pass2,2),array('class'=>'paddingtop3 sortalpha'.subfiltre_is_actif($pass3,'2'))); ?></li>
                        <li><?php echo $this->Html->link('D', array('action' => 'index',$pass0,$pass1,$pass2,3),array('class'=>'paddingtop3 sortalpha'.subfiltre_is_actif($pass3,'3'))); ?></li>
                        <li><?php echo $this->Html->link('E', array('action' => 'index',$pass0,$pass1,$pass2,4),array('class'=>'paddingtop3 sortalpha'.subfiltre_is_actif($pass3,'4'))); ?></li>
                        <li><?php echo $this->Html->link('F', array('action' => 'index',$pass0,$pass1,$pass2,5),array('class'=>'paddingtop3 sortalpha'.subfiltre_is_actif($pass3,'5'))); ?></li>
                        <li><?php echo $this->Html->link('G', array('action' => 'index',$pass0,$pass1,$pass2,6),array('class'=>'paddingtop3 sortalpha'.subfiltre_is_actif($pass3,'6'))); ?></li>
                        <li><?php echo $this->Html->link('H', array('action' => 'index',$pass0,$pass1,$pass2,7),array('class'=>'paddingtop3 sortalpha'.subfiltre_is_actif($pass3,'7'))); ?></li>
                        <li><?php echo $this->Html->link('I', array('action' => 'index',$pass0,$pass1,$pass2,8),array('class'=>'paddingtop3 sortalpha'.subfiltre_is_actif($pass3,'8'))); ?></li>
                        <li><?php echo $this->Html->link('J', array('action' => 'index',$pass0,$pass1,$pass2,9),array('class'=>'paddingtop3 sortalpha'.subfiltre_is_actif($pass3,'9'))); ?></li>
                        <li><?php echo $this->Html->link('K', array('action' => 'index',$pass0,$pass1,$pass2,10),array('class'=>'paddingtop3 sortalpha'.subfiltre_is_actif($pass3,'10'))); ?></li>
                        <li><?php echo $this->Html->link('L', array('action' => 'index',$pass0,$pass1,$pass2,11),array('class'=>'paddingtop3 sortalpha'.subfiltre_is_actif($pass3,'11'))); ?></li>
                        <li><?php echo $this->Html->link('M', array('action' => 'index',$pass0,$pass1,$pass2,12),array('class'=>'paddingtop3 sortalpha'.subfiltre_is_actif($pass3,'12'))); ?></li>
                        <li><?php echo $this->Html->link('N', array('action' => 'index',$pass0,$pass1,$pass2,13),array('class'=>'paddingtop3 sortalpha'.subfiltre_is_actif($pass3,'13'))); ?></li>
                        <li><?php echo $this->Html->link('O', array('action' => 'index',$pass0,$pass1,$pass2,14),array('class'=>'paddingtop3 sortalpha'.subfiltre_is_actif($pass3,'14'))); ?></li>
                        <li><?php echo $this->Html->link('P', array('action' => 'index',$pass0,$pass1,$pass2,15),array('class'=>'paddingtop3 sortalpha'.subfiltre_is_actif($pass3,'15'))); ?></li>
                        <li><?php echo $this->Html->link('Q', array('action' => 'index',$pass0,$pass1,$pass2,16),array('class'=>'paddingtop3 sortalpha'.subfiltre_is_actif($pass3,'16'))); ?></li>
                        <li><?php echo $this->Html->link('R', array('action' => 'index',$pass0,$pass1,$pass2,17),array('class'=>'paddingtop3 sortalpha'.subfiltre_is_actif($pass3,'17'))); ?></li>
                        <li><?php echo $this->Html->link('S', array('action' => 'index',$pass0,$pass1,$pass2,18),array('class'=>'paddingtop3 sortalpha'.subfiltre_is_actif($pass3,'18'))); ?></li>
                        <li><?php echo $this->Html->link('T', array('action' => 'index',$pass0,$pass1,$pass2,19),array('class'=>'paddingtop3 sortalpha'.subfiltre_is_actif($pass3,'19'))); ?></li>
                        <li><?php echo $this->Html->link('U', array('action' => 'index',$pass0,$pass1,$pass2,20),array('class'=>'paddingtop3 sortalpha'.subfiltre_is_actif($pass3,'20'))); ?></li>
                        <li><?php echo $this->Html->link('V', array('action' => 'index',$pass0,$pass1,$pass2,21),array('class'=>'paddingtop3 sortalpha'.subfiltre_is_actif($pass3,'21'))); ?></li>
                        <li><?php echo $this->Html->link('W', array('action' => 'index',$pass0,$pass1,$pass2,22),array('class'=>'paddingtop3 sortalpha'.subfiltre_is_actif($pass3,'22'))); ?></li>
                        <li><?php echo $this->Html->link('X', array('action' => 'index',$pass0,$pass1,$pass2,23),array('class'=>'paddingtop3 sortalpha'.subfiltre_is_actif($pass3,'23'))); ?></li>
                        <li><?php echo $this->Html->link('Y', array('action' => 'index',$pass0,$pass1,$pass2,24),array('class'=>'paddingtop3 sortalpha'.subfiltre_is_actif($pass3,'24'))); ?></li>
                        <li><?php echo $this->Html->link('Z', array('action' => 'index',$pass0,$pass1,$pass2,25),array('class'=>'paddingtop3 sortalpha'.subfiltre_is_actif($pass3,'25'))); ?></li>
                    </ul>
        </nav>
        <?php if ($this->params['action']=='index') { ?><div class="panel-body panel-filter marginbottom15 marginright20">
            <strong>Filtre appliqué : </strong><em>Liste de <?php echo $futilisateur; ?> de <?php echo $fsection; ?> <?php echo $fsociete; ?> <?php echo $falpha; ?></em></div><?php } ?>
        <div class="marginright10">
        <table cellpadding="0" cellspacing="0" class="table table-bordered table-striped table-hover">
        <thead>
	<tr>
			<th><?php echo $this->Paginator->sort('NOM','Nom'); ?></th>
			<th><?php echo $this->Paginator->sort('PRENOM','Prénom'); ?></th>
                        <th style="text-align:center;width:15px !important;vertical-align: middle;padding-left:5px;padding-right:5px;"><?php echo $this->Form->input('checkall',array('type'=>'checkbox','label'=>false)) ; ?>
                                <?php echo $this->Form->input('all_ids',array('type'=>'hidden')) ; ?>
                        </th>	
			<th><?php echo $this->Paginator->sort('section_id','Section'); ?></th>
			<th  width="100px"><?php echo $this->Paginator->sort('FINMISSION','Date de fin de mission'); ?></th>
                        <th><?php echo $this->Paginator->sort('ACTIF','Etat du compte'); ?></th>

			<th class="actions" width="111px"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
        <tbody>
	<?php if (isset($utilisateurs)): ?>
	<?php foreach ($utilisateurs as $utilisateur): ?>
	<tr>
		<td><?php echo h($utilisateur['Utilisateur']['NOM']); ?>&nbsp;</td>
		<td><?php echo h($utilisateur['Utilisateur']['PRENOM']); ?>&nbsp;</td>
                <td style="text-align:center;padding-left:5px;padding-right:5px;vertical-align: middle;"><?php echo $this->Form->input('id',array('type'=>'checkbox','label'=>false,'class'=>'idselect','value'=>$utilisateur['Utilisateur']['id'])) ; ?></td>
		<td><?php echo h($utilisateur['Section']['NOM']); ?>&nbsp;</td>
		<td style="text-align: center;"><?php echo h($utilisateur['Utilisateur']['FINMISSION']); ?>&nbsp;</td>
                <td  width="80px" style="text-align: center;"><?php echo h($utilisateur['Utilisateur']['ACTIF']) == 1 ? '<span etat="0" iduser="'.$utilisateur['Utilisateur']['id'].'" class="glyphicons ok_2 cursor changeetat"></span>' : '<span etat="1" iduser="'.$utilisateur['Utilisateur']['id'].'" class="glyphicons ok_2 disabled cursor changeetat"></span>'; ?>&nbsp;</td>
		<td class="actions">
                    <?php if (userAuth('profil_id')!='2' && isAuthorized('utilisateurs', 'view')) : ?>
                    <?php $mail = (isset($utilisateur['Utilisateur']['MAIL']) && !empty($utilisateur['Utilisateur']['MAIL'])) ? '<a href=\'mailto:'.h($utilisateur['Utilisateur']['MAIL']).'\'>'.h($utilisateur['Utilisateur']['MAIL']).'</a>': 'Non attribué'; ?>
                    <?php echo '<span class="glyphicons eye_open" data-rel="popover" data-title="<h3>Utilisateur :</h3>" data-content="<contenttitle>Nom Prénom: </contenttitle>'.h($utilisateur['Utilisateur']['NOMLONG'])
                                .'<br/><contenttitle>Date naissance: </contenttitle>'.h($utilisateur['Utilisateur']['NAISSANCE'])
                                .'<br/><contenttitle>Email: </contenttitle>'.$mail
                                .'<br/><contenttitle>Login: </contenttitle>'.h($utilisateur['Utilisateur']['username'])
                                .'<br/><contenttitle>Société: </contenttitle>'.h($utilisateur['Societe']['NOM'])
                                .'<br/><contenttitle>Site: </contenttitle>'.h($utilisateur['Site']['NOM'])
                                .'<br/><contenttitle>Assistance: </contenttitle>'.h($utilisateur['Assistance']['NOM'])
                                .'<br/><contenttitle>Créé le: </contenttitle>'.h($utilisateur['Utilisateur']['created'])
                                .'<br/><contenttitle>Modifié le: </contenttitle>'.h($utilisateur['Utilisateur']['modified']).'" data-trigger="click" style="cursor: pointer;"></span>'; ?>&nbsp;
                    <?php endif; ?>
                    <?php if (userAuth('profil_id')!='2' && isAuthorized('utilisateurs', 'edit')) : ?>
                    <?php echo $this->Html->link('<span class="glyphicons pencil showoverlay notchange"></span>', array('action' => 'edit', $utilisateur['Utilisateur']['id']),array('escape' => false)); ?>&nbsp;
                    <?php else: ?>
                    <span class="glyphicons blank"></span>
                    <?php endif; ?>
                    <?php if (userAuth('profil_id')!='2' && isAuthorized('utilisateurs', 'delete')) : ?>
                    <?php echo $this->Form->postLink('<span class="glyphicons bin notchange"></span>', array('action' => 'delete', $utilisateur['Utilisateur']['id']),array('escape' => false), __('Etes-vous certain de vouloir supprimer cet utilisateur ?')); ?>                    
                    <?php else: ?>
                    <span class="glyphicons blank"></span>
                    <?php endif; ?>
                    <?php if (userAuth('profil_id')!='2' && isAuthorized('utilisateurs', 'initpassword')) : ?>
                    <?php echo $this->Form->postLink('<span class="glyphicons showoverlay rotation_lock notchange"></span>', array('action' => 'initpassword', $utilisateur['Utilisateur']['id']),array('escape' => false), __('Etes-vous certain de vouloir initialiser le mot de passe de cet utilisateur ?')); ?>                                            
                    <?php else: ?>
                    <span class="glyphicons blank"></span>
                    <?php endif; ?>
                    <?php if (userAuth('profil_id')!='2' && isAuthorized('utilisateurs', 'duplicate')) : ?>
                    <?php echo $this->Form->postLink('<span class="glyphicons showoverlay retweet notchange"></span>', array('action' => 'dupliquer', $utilisateur['Utilisateur']['id']),array('escape' => false), __('Etes-vous certain de vouloir dupliquer cet utilisateur ?')); ?>
                    <?php else: ?>
                    <span class="glyphicons blank"></span>
                    <?php endif; ?>
                    <?php if (userAuth('profil_id')!='2' && isAuthorized('dotations', 'add')) : ?>
                    <?php echo $this->Html->link('<span class="glyphicons showoverlay cargo notchange"></span>', array('controller'=>'dotations','action' => 'add', $utilisateur['Utilisateur']['id']),array('escape' => false)); ?>&nbsp;
                    <?php endif; ?>  
                    <?php echo $this->Html->link('<span class="glyphicons showoverlay envelope notchange"></span>', array('action' => 'sendmailgestannuaire', $utilisateur['Utilisateur']['id']),array('escape' => false)); ?>&nbsp;
                </td>
	</tr>
        <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
	</table>
        </div>
	<div class="pull-left"><?php echo $this->Paginator->counter('Page {:page} sur {:pages}'); ?></div>
	<div class="pull-right marginright20"><?php echo $this->Paginator->counter('Nombre total d\'éléments : {:count}'); ?></div>     
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
</div>
<?php echo $this->element('modalprolongation'); ?>
<script>
    
     $(document).ready(function () {
        <?php if($pass3==null) : ?>$('#subnavfilter').hide();<?php endif; ?>
        
        $(document).on('click','#tooglealphafilter',function(e){
            $('#subnavfilter').fadeIn('slow');
        });        
    
        $(document).on('click','#prolongerlink',function(e){
            var ids = $("#all_ids").val();
            $("#UtilisateurIds").val(ids);
            $('#modalprolongation').modal('toggle');
        });
        
        $(document).on('click','#desactiverlink',function(e){
            var ids = $("#all_ids").val();
            var overlay = $('#overlay');
            overlay.show(); 
            $.ajax({
                dataType: "html",
                type: "POST",
                url: "<?php echo $this->Html->url(array('controller'=>'utilisateurs','action'=>'desactiver')); ?>/",
                data: ({all_ids:ids})
            }).done(function ( data ) {
                location.reload();
                overlay.hide();
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
               
        $(document).on('click','.changeetat',function(e){
            if (confirm("Merci de confirmer le change d'état de cette personne.")){
                var id = $(this).attr('iduser');
                var etat = $(this).attr('etat');
                $.ajax({
                    dataType: "html",
                    type: "POST",
                    url: "<?php echo $this->Html->url(array('controller'=>'utilisateurs','action'=>'changeetat')); ?>/",
                    data: ({id:id,etat:etat})
                }).done(function ( data ) {
                    location.reload();
                });
            }
        });
    });
</script>