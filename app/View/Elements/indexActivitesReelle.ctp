<div class="activitesreelles index" id="ToRefresh">
        <div class="navbar">
            <div class="navbar-inner">
                <div class="container">
                <ul class="nav">
                <?php $defaultEtat = $this->params->action == "afacturer" ? 'facture' : 'tous'; ?>
                <?php $defaultAction = $this->params->action == "search" ? 'index' : $this->params->action; ?>
                <?php if (userAuth('profil_id')!='2' && isAuthorized('activitesreelles', 'add') && strtolower($this->params->controller)=='activitesreelles') : ?>
                <li><?php echo $this->Html->link('<i class="icon-plus"></i>', array('action' => 'newactivite'),array('escape' => false)); ?></li>
                <li class="divider-vertical"></li>
                <?php endif; ?>
                <?php if ($defaultEtat == "tous") : ?>
                <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Filtre Etats <b class="caret"></b></a>
                     <ul class="dropdown-menu">
                         <li><?php echo $this->Html->link('Tous', array('action' => $defaultAction,'tous',isset($this->params->pass[1]) ? $this->params->pass[1] : 'tous',isset($this->params->pass[2]) ? $this->params->pass[2] : 'tous')); ?></li>
                         <li class="divider"></li>
                         <li><?php echo $this->Html->link('Non facturé', array('action' => $defaultAction,'actif',isset($this->params->pass[1]) ? $this->params->pass[1] : 'tous',isset($this->params->pass[2]) ? $this->params->pass[2] : 'tous')); ?></li>
                         <li><?php echo $this->Html->link('Facturé', array('action' => $defaultAction,'facture',isset($this->params->pass[1]) ? $this->params->pass[1] : 'tous',isset($this->params->pass[2]) ? $this->params->pass[2] : 'tous')); ?></li>
                     </ul>
                </li> 
                <?php else : ?>
                <li><?php echo $this->Html->link('Facturé', array('controller'=>'facturations','action' => 'index'),array('escape' => false)); ?></li>
                <?php endif; ?>
                <?php if (areaIsVisible()) :?>
                <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Filtre Utilisateurs <b class="caret"></b></a>
                     <ul class="dropdown-menu">
                     <li><?php echo $this->Html->link('Tous', array('action' => $defaultAction,isset($this->params->pass[0]) ? $this->params->pass[0] : $defaultEtat,'tous',isset($this->params->pass[2]) ? $this->params->pass[2] : 'tous')); ?></li>
                     <li class="divider"></li>
                         <?php foreach ($utilisateurs as $utilisateur): ?>
                            <li><?php echo $this->Html->link($utilisateur['Utilisateur']['NOMLONG'], array('action' => $defaultAction,isset($this->params->pass[0]) ? $this->params->pass[0] : $defaultEtat,$utilisateur['Utilisateur']['id'],isset($this->params->pass[2]) ? $this->params->pass[2] : 'tous')); ?></li>
                         <?php endforeach; ?>
                      </ul>
                </li>   
                <?php endif; ?> 
                <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Filtre Mois <b class="caret"></b></a>
                     <ul class="dropdown-menu">
                     <li><?php echo $this->Html->link('Tous', array('action' => $defaultAction,isset($this->params->pass[0]) ? $this->params->pass[0] : $defaultEtat,isset($this->params->pass[1]) ? $this->params->pass[1] : 'tous','tous')); ?></li>
                     <li class="divider"></li>
                     <li><?php echo $this->Html->link('Janvier', array('action' => $defaultAction,isset($this->params->pass[0]) ? $this->params->pass[0] : $defaultEtat,isset($this->params->pass[1]) ? $this->params->pass[1] : 'tous','01')); ?></li>
                     <li><?php echo $this->Html->link('Février', array('action' => $defaultAction,isset($this->params->pass[0]) ? $this->params->pass[0] : $defaultEtat,isset($this->params->pass[1]) ? $this->params->pass[1] : 'tous','02')); ?></li>
                     <li><?php echo $this->Html->link('Mars', array('action' => $defaultAction,isset($this->params->pass[0]) ? $this->params->pass[0] : $defaultEtat,isset($this->params->pass[1]) ? $this->params->pass[1] : 'tous','03')); ?></li>
                     <li><?php echo $this->Html->link('Avril', array('action' => $defaultAction,isset($this->params->pass[0]) ? $this->params->pass[0] : $defaultEtat,isset($this->params->pass[1]) ? $this->params->pass[1] : 'tous','04')); ?></li>
                     <li><?php echo $this->Html->link('Mai', array('action' => $defaultAction,isset($this->params->pass[0]) ? $this->params->pass[0] : $defaultEtat,isset($this->params->pass[1]) ? $this->params->pass[1] : 'tous','05')); ?></li>
                     <li><?php echo $this->Html->link('Juin', array('action' => $defaultAction,isset($this->params->pass[0]) ? $this->params->pass[0] : $defaultEtat,isset($this->params->pass[1]) ? $this->params->pass[1] : 'tous','06')); ?></li>
                     <li><?php echo $this->Html->link('Juillet', array('action' => $defaultAction,isset($this->params->pass[0]) ? $this->params->pass[0] : $defaultEtat,isset($this->params->pass[1]) ? $this->params->pass[1] : 'tous','07')); ?></li>
                     <li><?php echo $this->Html->link('Août', array('action' => $defaultAction,isset($this->params->pass[0]) ? $this->params->pass[0] : $defaultEtat,isset($this->params->pass[1]) ? $this->params->pass[1] : 'tous','08')); ?></li>
                     <li><?php echo $this->Html->link('Septembre', array('action' => $defaultAction,isset($this->params->pass[0]) ? $this->params->pass[0] : $defaultEtat,isset($this->params->pass[1]) ? $this->params->pass[1] : 'tous','09')); ?></li>
                     <li><?php echo $this->Html->link('Octobre', array('action' => $defaultAction,isset($this->params->pass[0]) ? $this->params->pass[0] : $defaultEtat,isset($this->params->pass[1]) ? $this->params->pass[1] : 'tous','10')); ?></li>
                     <li><?php echo $this->Html->link('Novembre', array('action' => $defaultAction,isset($this->params->pass[0]) ? $this->params->pass[0] : $defaultEtat,isset($this->params->pass[1]) ? $this->params->pass[1] : 'tous','11')); ?></li>
                     <li><?php echo $this->Html->link('Décembre', array('action' => $defaultAction,isset($this->params->pass[0]) ? $this->params->pass[0] : $defaultEtat,isset($this->params->pass[1]) ? $this->params->pass[1] : 'tous','12')); ?></li>                     
                      </ul>
                </li> 
                <?php if ($this->params->action == "afacturer") : ?>
                <li class="divider-vertical"></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-check"></i> Actions groupées <b class="caret"></b></a>
                     <ul class="dropdown-menu">
                     <li><?php echo $this->Html->link('Facturer', "#",array('id'=>'facturerlink')); ?></li>
                     <li><?php echo $this->Html->link('Rejeter', "#",array('id'=>'rejeterlink')); ?></li>
                     </ul>
                </li>
                <li class="divider-vertical"></li>
                <li><?php echo $this->Html->link('<i class="ico-xls"></i>', array('action' => 'export_xls'),array('escape' => false)); ?></li>                 
                <?php endif; ?>
                </ul> 
                <?php if ($this->params->controller == "activitesreelles" && $this->params->action == "index") : ?>
                <?php echo $this->Form->create("Activitesreelle",array('action' => 'search','class'=>'navbar-form clearfix pull-right','inputDefaults' => array('label'=>false,'div' => false))); ?>
                    <?php echo $this->Form->input('SEARCH',array('class'=>'span8','placeholder'=>'Recherche dans tous les champs')); ?>
                    <button type="submit" class="btn">Rechercher</button>
                <?php echo $this->Form->end(); ?>                    
                <?php elseif ($this->params->controller == "facturations") : ?>
                <?php echo $this->Form->create("Facturation",array('action' => 'search','class'=>'navbar-form clearfix pull-right','inputDefaults' => array('label'=>false,'div' => false))); ?>
                    <?php echo $this->Form->input('SEARCH',array('class'=>'span8','placeholder'=>'Recherche dans tous les champs')); ?>
                    <button type="submit" class="btn">Rechercher</button>
                <?php echo $this->Form->end(); ?>                     
                <?php endif; ?>
                </div>
            </div>
        </div>
        <?php if ($this->params['action']=='index') { ?><code class="text-normal"  style="margin-bottom: 10px;display: block;"><em>Liste de <?php echo $fetat; ?> de <?php echo $futilisateur; ?> <?php echo $fperiode; ?></em></code><?php } ?>        
        <table cellpadding="0" cellspacing="0" class="table table-bordered table-striped table-hover" id="data">
        <thead>
	<tr>
                        <th><?php echo 'Agent'; ?></th>
                        <th><?php echo 'Identifiant'; ?></th>
			<th><?php echo 'Date'; ?></th>
                        <?php if ($this->params->action == "afacturer") : ?>
                        <th style="text-align:center;width:15px !important;vertical-align: middle;padding-left:5px;padding-right:0;"><?php echo $this->Form->input('checkall',array('type'=>'checkbox','label'=>false)) ; ?>
                                <?php echo $this->Form->input('all_ids',array('type'=>'hidden')) ; ?>
                        </th>	
                        <?php endif; ?>
                        <th><?php echo 'Activités'; ?></th>
                        <th width="20px"><?php echo 'Lu.'; ?></th>
			<th width="20px"><?php echo 'Ma.'; ?></th>
			<th width="20px"><?php echo 'Me.'; ?></th>
			<th width="20px"><?php echo 'Je.'; ?></th>
			<th width="20px"><?php echo 'Ve.'; ?></th>
			<th width="20px"><?php echo 'Sa.'; ?></th>
			<th width="20px"><?php echo 'Di.'; ?></th>
			<th><?php echo 'Total'; ?></th>
			<th class="actions" width="90px"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
        <tbody>   
        <?php if (count($activitesreelles)>0): ?>
        <?php $r = 0; ?>
        <?php foreach ($groups as $group) : ?>
        <?php $row = $groups[$r][0]['NBACTIVITE']; ?>
        <?php if($row > 1 && count($activitesreelles)>1): ?>
            <tr>
                <td class="header" rowspan="<?php echo $row; ?>" style="vertical-align: middle;"><?php echo $group['Utilisateur']['NOM']." ".$group['Utilisateur']['PRENOM']; ?></td>
                <td class="header" rowspan="<?php echo $row; ?>" style="vertical-align: middle;"><?php echo $group['Utilisateur']['username']; ?></td>
                <td class="header" rowspan="<?php echo $row; ?>" style="vertical-align: middle;text-align: center;"><?php echo $group['Activitesreelle']['DATE']; ?></td>   
        <?php endif; ?>
        <?php foreach ($activitesreelles as $activitesreelle): ?>
            <?php if($activitesreelle['Activitesreelle']['utilisateur_id']==$group['Activitesreelle']['utilisateur_id'] && dateIsEqual($group['Activitesreelle']['DATE'], $activitesreelle['Activitesreelle']['DATE'])): ?>
                <?php if ($row==1): ?>
                <tr>
                <td class="header"><?php echo $activitesreelle['Utilisateur']['NOMLONG']; ?></td>
                <td class="header"><?php echo $activitesreelle['Utilisateur']['username']; ?></td>
                <td class="header" style="text-align: center;" ><?php echo $group['Activitesreelle']['DATE']; ?></td>               
                <?php endif; ?>
                <?php if ($this->params->action == "afacturer") : ?>
                <td style="text-align:center;padding-left:5px;padding-right:0;vertical-align: middle;"><?php echo $this->Form->input('id',array('type'=>'checkbox','label'=>false,'class'=>'idselect','value'=>$activitesreelle['Activitesreelle']['id'])) ; ?></td>
                <?php endif; ?>                 
                <td><?php echo $activitesreelle['Activitesreelle']['projet_NOM'].' - '.$activitesreelle['Activite']['NOM']; ?></td>  
                <!--calculer les jours fériés pour mettre le style week sur les jours fériés //-->
                <?php $date = new DateTime(CUSDate($group['Activitesreelle']['DATE'])); ?> 
                <?php $classLu = isFerie($date) ? 'class="ferie"' : ''; ?>
                <td style="text-align: center;" <?php echo $classLu; ?>><span <?php echo ($activitesreelle['Activite']['projet_id']==1 && $activitesreelle['Activitesreelle']['LU']>0 && $activitesreelle['Activitesreelle']['LU']<1) ? $activitesreelle['Activitesreelle']['LU_TYPE']==1 ? "rel='tooltip' data-title='Matin'" : "rel='tooltip' data-title='Après-midi'" : ""; ?>><?php echo $activitesreelle['Activitesreelle']['LU']!=0 ? $activitesreelle['Activitesreelle']['LU'] : ""; ?></span></td> 
                <?php $date->add(new DateInterval('P1D')); ?>
                <?php $classMA = isFerie($date) ? 'class="ferie"' : ''; ?>                
                <td style="text-align: center;" <?php echo $classMA; ?>><span <?php echo ($activitesreelle['Activite']['projet_id']==1 && $activitesreelle['Activitesreelle']['MA']>0 && $activitesreelle['Activitesreelle']['MA']<1) ? $activitesreelle['Activitesreelle']['MA_TYPE']==1 ? "rel='tooltip' data-title='Matin'" : "rel='tooltip' data-title='Après-midi'" : ""; ?>><?php echo $activitesreelle['Activitesreelle']['MA']!=0 ? $activitesreelle['Activitesreelle']['MA'] : ""; ?></span></td> 
                <?php $date->add(new DateInterval('P1D')); ?>
                <?php $classME = isFerie($date) ? 'class="ferie"' : ''; ?>                
                <td style="text-align: center;" <?php echo $classME; ?>><span <?php echo ($activitesreelle['Activite']['projet_id']==1 && $activitesreelle['Activitesreelle']['ME']>0 && $activitesreelle['Activitesreelle']['ME']<1) ? $activitesreelle['Activitesreelle']['ME_TYPE']==1 ? "rel='tooltip' data-title='Matin'" : "rel='tooltip' data-title='Après-midi'" : ""; ?>><?php echo $activitesreelle['Activitesreelle']['ME']!=0 ? $activitesreelle['Activitesreelle']['ME'] : ""; ?></span></td> 
                <?php $date->add(new DateInterval('P1D')); ?>
                <?php $classJE = isFerie($date) ? 'class="ferie"' : ''; ?>                
                <td style="text-align: center;" <?php echo $classJE; ?>><span <?php echo ($activitesreelle['Activite']['projet_id']==1 && $activitesreelle['Activitesreelle']['JE']>0 && $activitesreelle['Activitesreelle']['JE']<1) ? $activitesreelle['Activitesreelle']['JE_TYPE']==1 ? "rel='tooltip' data-title='Matin'" : "rel='tooltip' data-title='Après-midi'" : ""; ?>><?php echo $activitesreelle['Activitesreelle']['JE']!=0 ? $activitesreelle['Activitesreelle']['JE'] : ""; ?></span></td> 
                <?php $date->add(new DateInterval('P1D')); ?>
                <?php $classVE = isFerie($date) ? 'class="ferie"' : ''; ?>                
                <td style="text-align: center;" <?php echo $classVE; ?>><span <?php echo ($activitesreelle['Activite']['projet_id']==1 && $activitesreelle['Activitesreelle']['VE']>0 && $activitesreelle['Activitesreelle']['VE']<1) ? $activitesreelle['Activitesreelle']['VE_TYPE']==1 ? "rel='tooltip' data-title='Matin'" : "rel='tooltip' data-title='Après-midi'" : ""; ?>><?php echo $activitesreelle['Activitesreelle']['VE']!=0 ? $activitesreelle['Activitesreelle']['VE'] : ""; ?></span></td> 
                <?php $date->add(new DateInterval('P1D')); ?>
                <?php $classSA = isFerie($date) ? ' ferie' : ''; ?> 
                <td style="text-align: center;" class="week <?php echo $classSA; ?>"><span <?php echo ($activitesreelle['Activite']['projet_id']==1 && $activitesreelle['Activitesreelle']['SA']>0 && $activitesreelle['Activitesreelle']['SA']<1) ? $activitesreelle['Activitesreelle']['SA_TYPE']==1 ? "rel='tooltip' data-title='Matin'" : "rel='tooltip' data-title='Après-midi'" : ""; ?>><?php echo $activitesreelle['Activitesreelle']['SA']!=0 ? $activitesreelle['Activitesreelle']['SA'] : ""; ?></span></td> 
                <?php $date->add(new DateInterval('P1D')); ?>
                <?php $classDI = isFerie($date) ? ' ferie' : ''; ?>
                <td style="text-align: center;" class="week <?php echo $classDI; ?>"><span <?php echo ($activitesreelle['Activite']['projet_id']==1 && $activitesreelle['Activitesreelle']['DI']>0 && $activitesreelle['Activitesreelle']['DI']<1) ? $activitesreelle['Activitesreelle']['DI_TYPE']==1 ? "rel='tooltip' data-title='Matin'" : "rel='tooltip' data-title='Après-midi'" : ""; ?>><?php echo $activitesreelle['Activitesreelle']['DI']!=0 ? $activitesreelle['Activitesreelle']['DI'] : ""; ?></span></td> 
                <td style="text-align: center;" class="sstotal"><?php echo $activitesreelle['Activitesreelle']['TOTAL']; ?></td> 
                <td style="text-align: center;">
                <?php if ($this->params->action != "afacturer") : ?>
                    <?php if (userAuth('profil_id')!='2' && isAuthorized('activitesreelles', 'view')) : ?>
                    <?php echo isset($activitesreelle['Activitesreelle']['action_id']) ? '<i class="icon-eye-open" rel="popover" data-title="<h3>Action :</h3>" data-content="<contenttitle>Objet: </contenttitle>'.h($activitesreelle['Action']['OBJET']).'<br/><contenttitle>Avancement: </contenttitle>'.h($activitesreelle['Action']['AVANCEMENT']).'%<br/><contenttitle>Crée le: </contenttitle>'.h($activitesreelle['Action']['created']).'<br/><contenttitle>Modifié le: </contenttitle>'.h($activitesreelle['Action']['modified']).'" data-trigger="click" style="cursor: pointer;"></i>' : "<i class='icon-blank'></i>"; ?>
                    <?php endif; ?>
                    <?php if (userAuth('profil_id')!='2' && isAuthorized('activitesreelles', 'edit') && $activitesreelle['Activitesreelle']['VEROUILLE'] == 1 ) : ?>
                    <?php echo $this->Html->link('<i class="icon-pencil"></i>', array('action' => 'edit', $activitesreelle['Activitesreelle']['id']),array('escape' => false)); ?>
                    <?php endif; ?>
                    <?php if (userAuth('profil_id')!='2' && isAuthorized('activitesreelles', 'delete') && $activitesreelle['Activitesreelle']['VEROUILLE'] == 1) : ?>
                    <?php echo $this->Form->postLink('<i class="icon-trash"></i>', array('action' => 'delete', $activitesreelle['Activitesreelle']['id']),array('escape' => false), __('Etes-vous certain de vouloir supprimer cette feuille de temps ?')); ?>                    
                    <?php endif; ?>
                    <?php if (userAuth('profil_id')!='2' && isAuthorized('activitesreelles', 'update')) : ?>
                    <?php $img = $activitesreelle['Activitesreelle']['VEROUILLE']==0 ? 'icon-thumbs-up' : 'icon-thumbs-down'; ?>
                    <?php echo $this->Form->postLink('<i class="'.$img.'"></i>', array('action' => 'updatefacturation', $activitesreelle['Activitesreelle']['id']),array('escape' => false), __('Etes-vous certain de vouloir mettre à jour cette feuille de temps pour facturation ?')); ?>                    
                    <?php endif; ?>
                    <?php if (userAuth('profil_id')!='2' && isAuthorized('activitesreelles', 'duplicate') && $activitesreelle['Activitesreelle']['VEROUILLE'] == 1) : ?>
                    <?php echo $this->Html->link('<i class=" icon-tags"></i>', array('action' => 'autoduplicate', $activitesreelle['Activitesreelle']['id']),array('escape' => false)); ?>                    
                    <?php endif; ?>
                <?php else : ?>
                    <?php if (userAuth('profil_id')!='2' && isAuthorized('activitesreelles', 'edit')) : ?>
                    <?php echo $this->Html->link('<i class="icon-ok-sign"></i>', array('controller' => 'facturations','action' => 'add', $activitesreelle['Activitesreelle']['utilisateur_id'], $activitesreelle['Activitesreelle']['id']),array('escape' => false)); ?>
                    <?php endif; ?>
                    <?php if (userAuth('profil_id')!='2' && isAuthorized('activitesreelles', 'update')) : ?>
                    <?php $img = 'icon-remove-sign'; ?>
                    <?php echo $this->Form->postLink('<i class="'.$img.'"></i>', array('action' => 'errorfacturation', $activitesreelle['Activitesreelle']['id']),array('escape' => false), __('Etes-vous certain de vouloir mettre à jour cette feuille de temps pour correction ?')); ?>                    
                    <?php endif; ?>
                <?php endif; ?>
                </td>                 
            </tr>
        <?php endif; ?>
        <?php endforeach; ?>
        <?php $r++; ?>
        <?php endforeach; ?> 
        <?php endif; ?> 
        </tbody>
        <tfooter>
	<tr>
            <?php $nbrows = $this->params->action == "afacturer" ? 12 : 11; ?>
            <td colspan="<?php echo $nbrows; ?>" class="footer" style="text-align:right;">Total :</td>
            <td class="footer" id="totalactivites" style="text-align:right;"></td>
            <td class="footer" width="90px" style="text-align:left;">jours</td>
	</tr>            
        </tfooter>
	</table>        
</div>
<script>
    function sumOfColumns() {
        var tot = 0;
        $(".sstotal").each(function() {
          tot += parseFloat($(this).html());
        });
        return tot;
     }
     
     $(document).ready(function () {
        $("#totalactivites").html(sumOfColumns());

        setTimeout(function() {$('#ToRefresh').load('<?php echo $this->params->here; ?>');}, 120000); 
        $("[rel=tooltip]").tooltip({placement:'bottom',trigger:'hover',html:true});
        
        $(document).on('click','#facturerlink',function(e){
            var ids = $("#all_ids").val();
            var overlay = jQuery('<div id="overlay"> </div>');
            overlay.appendTo(document.body)
            $.ajax({
                dataType: "html",
                type: "POST",
                url: "<?php echo $this->Html->url(array('controller'=>'activitesreelles','action'=>'facturer')); ?>/",
                data: ({all_ids:ids})
            }).done(function ( data ) {
                location.reload();
                overlay.remove();
            });
            $(this).parents().find(':checkbox').prop('checked', false); 
        });
        
        $(document).on('click','#rejeterlink',function(e){
            var ids = $("#all_ids").val();
            var overlay = jQuery('<div id="overlay"> </div>');
            overlay.appendTo(document.body)            
            $.ajax({
                dataType: "html",
                type: "POST",
                url: "<?php echo $this->Html->url(array('controller'=>'activitesreelles','action'=>'rejeter')); ?>/",
                data: ({all_ids:ids})     
            }).done(function ( data ) {
                location.reload();
                overlay.remove();                
            });
            $(this).parents().find(':checkbox').prop('checked', false); 
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