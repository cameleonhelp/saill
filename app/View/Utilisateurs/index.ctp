<div class="utilisateurs index">
        <div class="navbar">
            <div class="navbar-inner">
                <div class="container">
                <ul class="nav">
                <?php if (userAuth('profil_id')!='2' && isAuthorized('utilisateurs', 'add')) : ?>
                <li><?php echo $this->Html->link('<i class="icon-plus"></i>', array('action' => 'add'),array('escape' => false)); ?></li>
                <li class="divider-vertical"></li>
                <?php endif; ?>
                <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Filtre Etats <b class="caret"></b></a>
                     <ul class="dropdown-menu">
                         <li><?php echo $this->Html->link('Tous', array('action' => 'index','tous',isset($this->params->pass[1]) ? $this->params->pass[1] : 'allsections')); ?></li>
                         <li class="divider"></li>
                         <li><?php echo $this->Html->link('Actif', array('action' => 'index','actif',isset($this->params->pass[1]) ? $this->params->pass[1] : 'allsections')); ?></li>
                         <li><?php echo $this->Html->link('Inactif', array('action' => 'index','inactif',isset($this->params->pass[1]) ? $this->params->pass[1] : 'allsections')); ?></li>
                         <li class="divider"></li>
                         <li><?php echo $this->Html->link('Incomplet', array('action' => 'index','incomplet',isset($this->params->pass[1]) ? $this->params->pass[1] : 'allsections')); ?></li>
                         <li class="divider"></li>
                         <li><?php echo $this->Html->link('A prolonger', array('action' => 'index','aprolonger',isset($this->params->pass[1]) ? $this->params->pass[1] : 'allsections')); ?></li>
                      </ul>
                 </li> 
                <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Filtre Sections <b class="caret"></b></a>
                     <ul class="dropdown-menu">
                     <li><?php echo $this->Html->link('Toutes', array('action' => 'index',isset($this->params->pass[0]) ? $this->params->pass[0] : 'tous','allsections')); ?></li>
                     <li class="divider"></li>
                         <?php foreach ($sections as $section): ?>
                            <li><?php echo $this->Html->link($section['Section']['NOM'], array('action' => 'index',isset($this->params->pass[0]) ? $this->params->pass[0] : 'tous',$section['Section']['id'])); ?></li>
                         <?php endforeach; ?>
                      </ul>
                 </li>
                <li class="divider-vertical"></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-check"></i> Actions groupées <b class="caret"></b></a>
                     <ul class="dropdown-menu">
                     <li><?php echo $this->Html->link('Prolonger', "#",array('id'=>'prolongerlink')); ?></li>
                     <li><?php echo $this->Html->link('Désactiver', "#",array('id'=>'desactiverlink')); ?></li>
                     </ul>
                </li>                 
                 <li class="divider-vertical"></li>
                <li><?php echo $this->Html->link('<i class="ico-xls"></i>', array('action' => 'export_xls'),array('escape' => false)); ?></li>
                <li class="divider-vertical"></li>
                </ul> 
                <?php echo $this->Form->create("Utilisateur",array('action' => 'search','class'=>'navbar-form clearfix pull-right','inputDefaults' => array('label'=>false,'div' => false))); ?>
                    <?php echo $this->Form->input('SEARCH',array('class'=>'span8','placeholder'=>'Recherche dans tous les champs')); ?>
                    <button type="submit" class="btn">Rechercher</button>
                <?php echo $this->Form->end(); ?>                    
                </div>
            </div>
        </div>
        <?php if ($this->params['action']=='index') { ?><code class="text-normal"  style="margin-bottom: 10px;display: block;"><em>Liste de <?php echo $futilisateur; ?> de <?php echo $fsection; ?></em></code><?php } ?>
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
	<?php foreach ($utilisateurs as $utilisateur): ?>
	<tr>
		<td><?php echo h($utilisateur['Utilisateur']['NOM']); ?>&nbsp;</td>
		<td><?php echo h($utilisateur['Utilisateur']['PRENOM']); ?>&nbsp;</td>
                <td style="text-align:center;padding-left:5px;padding-right:5px;vertical-align: middle;"><?php echo $this->Form->input('id',array('type'=>'checkbox','label'=>false,'class'=>'idselect','value'=>$utilisateur['Utilisateur']['id'])) ; ?></td>
		<td><?php echo h($utilisateur['Section']['NOM']); ?>&nbsp;</td>
		<td style="text-align: center;"><?php echo h($utilisateur['Utilisateur']['FINMISSION']); ?>&nbsp;</td>
                <td  width="80px" style="text-align: center;"><?php echo h($utilisateur['Utilisateur']['ACTIF']) == 1 ? '<i class="icon-ok"></i>' : '<i class="icon-ok icon-grey"></i>'; ?>&nbsp;</td>
		<td class="actions">
                    <?php if (userAuth('profil_id')!='2' && isAuthorized('utilisateurs', 'view')) : ?>
                    <?php $mail = (isset($utilisateur['Utilisateur']['MAIL']) && !empty($utilisateur['Utilisateur']['MAIL'])) ? '<a href=\'mailto:'.h($utilisateur['Utilisateur']['MAIL']).'\'>'.h($utilisateur['Utilisateur']['MAIL']).'</a>': 'Non attribué'; ?>
                    <?php echo '<i class="icon-eye-open" rel="popover" data-title="<h3>Utilisateur :</h3>" data-content="<contenttitle>Nom Prénom: </contenttitle>'.h($utilisateur['Utilisateur']['NOMLONG'])
                                .'<br/><contenttitle>Date naissance: </contenttitle>'.h($utilisateur['Utilisateur']['NAISSANCE'])
                                .'<br/><contenttitle>Email: </contenttitle>'.$mail
                                .'<br/><contenttitle>Login: </contenttitle>'.h($utilisateur['Utilisateur']['username'])
                                .'<br/><contenttitle>Société: </contenttitle>'.h($utilisateur['Societe']['NOM'])
                                .'<br/><contenttitle>Site: </contenttitle>'.h($utilisateur['Site']['NOM'])
                                .'<br/><contenttitle>Assistance: </contenttitle>'.h($utilisateur['Assistance']['NOM'])
                                .'<br/><contenttitle>Créé le: </contenttitle>'.h($utilisateur['Utilisateur']['created'])
                                .'<br/><contenttitle>Modifié le: </contenttitle>'.h($utilisateur['Utilisateur']['modified']).'" data-trigger="click" style="cursor: pointer;"></i>'; ?>&nbsp;
                    <?php endif; ?>
                    <?php if (userAuth('profil_id')!='2' && isAuthorized('utilisateurs', 'edit')) : ?>
                    <?php echo $this->Html->link('<i class="icon-pencil"></i>', array('action' => 'edit', $utilisateur['Utilisateur']['id']),array('escape' => false)); ?>&nbsp;
                    <?php else: ?>
                    <i class="icon-blank"></i>
                    <?php endif; ?>
                    <?php if (userAuth('profil_id')!='2' && isAuthorized('utilisateurs', 'delete')) : ?>
                    <?php echo $this->Form->postLink('<i class="icon-trash"></i>', array('action' => 'delete', $utilisateur['Utilisateur']['id']),array('escape' => false), __('Etes-vous certain de vouloir supprimer cet utilisateur ?')); ?>                    
                    <?php else: ?>
                    <i class="icon-blank"></i>
                    <?php endif; ?>
                    <?php if (userAuth('profil_id')!='2' && isAuthorized('utilisateurs', 'initpassword')) : ?>
                    <?php echo $this->Form->postLink('<i class="icon-asterisk"></i>', array('action' => 'initpassword', $utilisateur['Utilisateur']['id']),array('escape' => false), __('Etes-vous certain de vouloir initialiser le mot de passe de cet utilisateur ?')); ?>                                            
                    <?php else: ?>
                    <i class="icon-blank"></i>
                    <?php endif; ?>
                    <?php if (userAuth('profil_id')!='2' && isAuthorized('utilisateurs', 'duplicate')) : ?>
                    <?php echo $this->Form->postLink('<i class="icon-retweet"></i>', array('action' => 'dupliquer', $utilisateur['Utilisateur']['id']),array('escape' => false), __('Etes-vous certain de vouloir dupliquer cet utilisateur ?')); ?>
                    <?php else: ?>
                    <i class="icon-blank"></i>
                    <?php endif; ?>
                    <?php if (userAuth('profil_id')!='2' && isAuthorized('dotations', 'add')) : ?>
                    <?php echo $this->Html->link('<i class="icon-shopping-cart"></i>', array('controller'=>'dotations','action' => 'add', $utilisateur['Utilisateur']['id']),array('escape' => false)); ?>&nbsp;
                    <?php endif; ?>                    
                </td>
	</tr>
<?php endforeach; ?>
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
       
        $(document).on('click','#prolongerlink',function(e){
            var ids = $("#all_ids").val();
            var overlay = jQuery('<div id="overlay"><?php echo $this->Html->image("loading.gif"); ?> Travail en cours, veuillez patienter ...</div>');
            overlay.appendTo(document.body)
            $.ajax({
                dataType: "html",
                type: "POST",
                url: "<?php echo $this->Html->url(array('controller'=>'utilisateurs','action'=>'prolonger')); ?>/",
                data: ({all_ids:ids})
            }).done(function ( data ) {
                location.reload();
                overlay.remove();
            });
            $(this).parents().find(':checkbox').prop('checked', false);  
            $("#all_ids").val('');
        });
        
        $(document).on('click','#desactiverlink',function(e){
            var ids = $("#all_ids").val();
            var overlay = jQuery('<div id="overlay"><?php echo $this->Html->image("loading.gif"); ?> Travail en cours, veuillez patienter ...</div>');
            overlay.appendTo(document.body)
            $.ajax({
                dataType: "html",
                type: "POST",
                url: "<?php echo $this->Html->url(array('controller'=>'utilisateurs','action'=>'desactiver')); ?>/",
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