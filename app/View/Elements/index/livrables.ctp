<nav class="navbar toolbar ">
        <?php 
        $pass0 = isset($this->params->pass[0]) ? $this->params->pass[0] : 'toutes';
        $pass1 = isset($this->params->pass[1]) ? $this->params->pass[1] : 'tous';
        $pass2 = isset($this->params->pass[2]) ? $this->params->pass[2] : 'tous';
        $passaction = $this->params->action;
        if (count($this->params->data) > 0) :
            $keyword = $this->params->data['Livrable']['SEARCH'];
        elseif (isset($this->params->pass[3]) && $this->params->pass[3] !=''):
            $keyword = $this->params->pass[3];
        elseif (isset($keywords) && $keyword != ''):
            $keyword = $keywords;
        else :
            $keyword = '';
        endif;    
        ?>    
        <ul class="nav navbar-nav toolbar">
        <?php if (userAuth('profil_id')!='2' && isAuthorized('livrables', 'add')) : ?>
        <li><?php echo $this->Html->link('<span class="glyphicons plus size14 margintop4" data-container="body" rel="tooltip" data-title="Ajoutez un livrable"></span>', array('action' => 'add'),array('escape' => false)); ?></li>
        <li class="divider-vertical-only"></li>
        <?php endif; ?>
        <li class="dropdown <?php echo filtre_is_actif($pass0,'toutes'); ?>">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Filtre Chronologie<b class="caret"></b></a>
             <ul class="dropdown-menu">
             <li><?php echo $this->Html->link('Toutes', array('action' => $passaction,'toutes',$pass1,$pass2,$keyword),array('class'=>'showoverlay'.subfiltre_is_actif($pass0,'toutes'))); ?></li>
             <li class="divider"></li>
             <li><?php echo $this->Html->link('En retard', array('action' => $passaction,'tolate',$pass1,$pass2,$keyword),array('class'=>'showoverlay'.subfiltre_is_actif($pass0,'tolate'))); ?></li>
             <li class="divider"></li>
             <li><?php echo $this->Html->link('Semaine précédente', array('action' => $passaction,'previousweek',$pass1,$pass2,$keyword),array('class'=>'showoverlay'.subfiltre_is_actif($pass0,'previousweek'))); ?></li>
             <li><?php echo $this->Html->link('Semaine courante', array('action' => $passaction,'week',$pass1,$pass2,$keyword),array('class'=>'showoverlay'.subfiltre_is_actif($pass0,'week'))); ?></li>
             <li><?php echo $this->Html->link('Semaine suivante', array('action' => $passaction,'nextweek',$pass1,$pass2,$keyword),array('class'=>'showoverlay'.subfiltre_is_actif($pass0,'nextweek'))); ?></li>
             <li class="divider"></li>
             <li><?php echo $this->Html->link('A venir', array('action' => $passaction,'otherweek',$pass1,$pass2,$keyword),array('class'=>'showoverlay'.subfiltre_is_actif($pass0,'otherweek'))); ?></li>
             </ul>
         </li>                   
        <li class="dropdown <?php echo filtre_is_actif($pass1,'tous'); ?>">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Filtre Etat<b class="caret"></b></a>
             <ul class="dropdown-menu">
             <li><?php echo $this->Html->link('Tous', array('action' => $passaction,$pass0,'tous',$pass2,$keyword),array('class'=>'showoverlay'.subfiltre_is_actif($pass1,'tous'))); ?></li>
             <li class="divider"></li>
             <li><?php echo $this->Html->link('A faire', array('action' => $passaction,$pass0,'todo',$pass2,$keyword),array('class'=>'showoverlay'.subfiltre_is_actif($pass1,'todo'))); ?></li>
             <li><?php echo $this->Html->link('En cours', array('action' => $passaction,$pass0,'inmotion',$pass2,$keyword),array('class'=>'showoverlay'.subfiltre_is_actif($pass1,'inmotion'))); ?></li>
             <li><?php echo $this->Html->link('Livré', array('action' => $passaction,$pass0,'delivered',$pass2,$keyword),array('class'=>'showoverlay'.subfiltre_is_actif($pass1,'delivered'))); ?></li>
             <li><?php echo $this->Html->link('Validé', array('action' => $passaction,$pass0,'validated',$pass2,$keyword),array('class'=>'showoverlay'.subfiltre_is_actif($pass1,'validated'))); ?></li>
             <li class="divider"></li>
             <li><?php echo $this->Html->link('Autre que validé', array('action' => $passaction,$pass0,'notvalidated',$pass2,$keyword),array('class'=>'showoverlay'.subfiltre_is_actif($pass1,'notvalidated'))); ?></li>                   
             </ul>
        </li> 
        <?php if (areaIsVisible()) :?>
        <li class="dropdown <?php echo filtre_is_actif($pass2,'tous'); ?>">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Filtre Gestionnaire<b class="caret"></b></a>
             <ul class="dropdown-menu">
             <li><?php echo $this->Html->link('Tous', array('action' => $passaction,$pass0,$pass1,'tous',$keyword),array('class'=>'showoverlay'.subfiltre_is_actif($pass2,'tous'))); ?></li>
             <li><?php echo $this->Html->link('Moi', array('action' => $passaction,$pass0,$pass1,userAuth('id'),$keyword),array('class'=>'showoverlay'.subfiltre_is_actif($pass2, userAuth('id')))); ?></li>
             <li class="divider"></li>
             <li><?php echo $this->Html->link('Mon équipe', array('action' => $passaction,$pass0,$pass1,'equipe',$keyword),array('class'=>'showoverlay'.subfiltre_is_actif($pass2,'equipe'))); ?></li>
             <li class="divider"></li>                    
             <?php //debug($gestionnaires); ?>
                 <?php foreach ($gestionnaires as $gestionnaire): ?>
                    <li><?php echo $this->Html->link($gestionnaire['Utilisateur']['NOMLONG'], array('action' => $passaction,$pass0,$pass1,$gestionnaire['Utilisateur']['id'],$keyword),array('class'=>'showoverlay'.subfiltre_is_actif($pass2,$gestionnaire['Utilisateur']['id']))); ?></li>
                 <?php endforeach; ?>
             </ul>
        </li>   
        <?php endif; ?>
        <li class="divider-vertical-only"></li>
        <li><?php echo $this->Html->link('<span class="ico-xls" rel="tooltip" data-container="body"  data-title="Export Excel"></span>', array('action' => 'export_xls'),array('escape' => false)); ?></li>
        </ul> 
        <ul class="nav navbar-nav toolbar pull-right">
            <li><?php echo $this->Html->link('<span class="glyphicons blue circle_question_mark size14 margintop4"></span>', '#',array('escape' => false,'data-toggle'=>"modal",'data-target'=>"#modalhelp")); ?></li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle btn-expand" data-toggle="dropdown"><span class="glyphicons expand notchange" style="width:13px;"></span></a>
                <ul class="dropdown-menu" style="left: -205px;min-width: 250px;max-width: 250px;">
                    <li>
                        <?php echo $this->Form->create("Livrable",array('url' => array('action' => 'search',$pass0,$pass1,$pass2), 'class'=>'toolbar-form pull-right','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?>
                            <?php echo $this->Form->input('SEARCH',array('placeholder'=>'Recherche ...','style'=>"width: 200px;margin-left:3px;margin-right:-3px;display: inline-table;",'class'=>"form-control",'value'=>$keyword, 'rel'=>"tooltip", 'data-container'=>"body", 'data-title'=>Configure::read('search_tooltip'))); ?>
                            <button type="submit" class="btn form-btn showoverlay"><span class="glyphicons notchange search"></span></button>
                        <?php echo $this->Form->end(); ?> 
                    </li>
                </ul>
            </li>
        </ul>                               
</nav>
<?php echo $this->element('modals/help',array('helpcontent' => $this->element('hlp/hlp-livrables'))); ?>
<div class="panel-body panel-filter marginbottom15 "><strong>Filtre appliqué : </strong><em>Liste de <?php echo $fchronologie; ?>, <?php echo $fetat; ?> et <?php echo $fgestionnaire; ?></em></div>
<div class="">
<table cellpadding="0" cellspacing="0" class="table table-bordered table-striped table-hover">
<thead>
<tr>
                <th><?php echo $this->Paginator->sort('NOM','Nom'); ?></th>
                <th><?php echo $this->Paginator->sort('NOMLONG','Nom du gestionnaire'); ?></th>
                <th width="60px"><?php echo $this->Paginator->sort('REFERENCE','Réf. MINIDOC'); ?></th>
                <th width="40px"><?php echo $this->Paginator->sort('VERSION','Version'); ?></th>
                <th width="40px"><?php echo $this->Paginator->sort('ETAT','Etat'); ?></th>
                <th width="90px"><?php echo $this->Paginator->sort('ECHEANCE','Echéance'); ?></th>
                <th width="90px"><?php echo $this->Paginator->sort('DATELIVRAISON','Date de livraison'); ?></th>                        
                <th width="75px" class="actions"><?php echo __('Actions'); ?></th>
</tr>
</thead>
<tbody>        
<?php if (isset($livrables)): ?>
<?php foreach ($livrables as $livrable): ?>
<tr>
        <td><?php echo h($livrable['Livrable']['NOM']); ?>&nbsp;</td>
        <td><?php echo h($livrable['Utilisateur']['NOMLONG']); ?>&nbsp;</td>
        <?php $urlminidoc = $this->requestAction('parameters/get_minidocurl'); ?>
        <?php $urlreference = !empty($urlminidoc['Parameter']['param']) ? $urlminidoc['Parameter']['param'].$livrable['Livrable']['REFERENCE'] : '#'; ?>
        <td style="text-align: center;"><?php echo $this->Html->link(h($livrable['Livrable']['REFERENCE']),$urlreference,array('target'=>'blank')); ?>&nbsp;</td>
        <td style="text-align: center;"><?php echo h($livrable['Livrable']['VERSION']); ?>&nbsp;</td>
        <td style="text-align: center;"><?php echo isset($livrable['Livrable']['ETAT']) ? '<span class="glyphicons '.etatLivrable(h($livrable['Livrable']['ETAT'])).'" rel="tooltip" data-title="'.h($livrable['Livrable']['ETAT']).'"></span>' : '' ; ?></td>
        <?php $classtd = livrableenretard($livrable['Livrable']['ECHEANCE'],$livrable['Livrable']['DATELIVRAISON'],$livrable['Livrable']['ETAT']) ? "class='td-error'" : ""; ?>
        <td <?php echo $classtd; ?> style="text-align: center;"><?php echo h(isset($livrable['Livrable']['ECHEANCE']) ? $livrable['Livrable']['ECHEANCE'] : ''); ?>&nbsp;</td>
        <td style="text-align: center;"><?php echo h(isset($livrable['Livrable']['DATELIVRAISON']) ? $livrable['Livrable']['DATELIVRAISON'] : ''); ?>&nbsp;</td>
        <td class="actions">
            <?php if (userAuth('profil_id')!='2' && isAuthorized('livrables', 'view')) : ?>
            <?php echo '<span class="glyphicons eye_open cursor"></span>'; ?>&nbsp;
            <?php endif; ?>
            <?php if (userAuth('profil_id')!='2' && isAuthorized('livrables', 'edit')) : ?>
            <?php echo $this->Html->link('<span class="glyphicons pencil showoverlay notchange" rel="tooltip" data-title="Modification"></span>', array('action' => 'edit', $livrable['Livrable']['id']),array('escape' => false)); ?>&nbsp;
            <?php endif; ?>
            <?php if (userAuth('profil_id')!='2' && isAuthorized('livrables', 'delete')) : ?>
            <?php echo $this->Form->postLink('<span class="glyphicons bin notchange" rel="tooltip" data-title="Suppression"></span>', array('action' => 'delete', $livrable['Livrable']['id']),array('escape' => false), __('Etes-vous certain de vouloir supprimer ce livrables ?')); ?>
            <?php endif; ?>
            <?php if (userAuth('profil_id')!='2' && isAuthorized('livrables', 'duplicate')) : ?>
            <?php echo $this->Form->postLink('<span class="glyphicons retweet showoverlay notchange" rel="tooltip" data-title="Duplication"></span>', array('action' => 'dupliquer', $livrable['Livrable']['id']),array('escape' => false), __('Etes-vous certain de vouloir créer une nouvelle version de ce livrable ?')); ?>
            <?php endif; ?>                    
        </td>
</tr>
<tr class="trhidden" style="display:none;">
    <td colspan="5" align="center">
        <table cellpadding="0" cellspacing="0" class="table table-hidden" style="margin-bottom:-3px;">
            <tr><th>Commentaire</th><th>Validé le</th></tr>
            <tr><td><?php echo $livrable['Livrable']['COMMENTAIRE']; ?></td><td><?php echo $livrable['Livrable']['DATEVALIDATION'] ? $livrable['Livrable']['DATEVALIDATION'] : ''; ?></td></tr>
        </table>
    </td>
</tr> 
<?php endforeach; ?>
<?php endif; ?>
</tbody>
</table>
</div>
<div class="pull-left"><?php echo $this->Paginator->counter('Page {:page} sur {:pages}'); ?></div>
<div class="pull-right "><?php echo $this->Paginator->counter('Nombre total d\'éléments : {:count}'); ?></div>    
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
        $(document).on('click','.eye_open',function(e){
            $(this).parents('tr').next('.trhidden').toggle('slow', "easeOutBounce");
        });          
        
        $(document).on('keyup','#LivrableSEARCH',function (event){
            var url = "<?php echo $this->webroot;?>livrables/search/<?php echo $pass0;?>/<?php echo $pass1;?>/<?php echo $pass2;?>/";
            $(this).parents('form').attr('action',url+$(this).val());
        });        
    });
</script> 