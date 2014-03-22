<nav class="navbar toolbar ">
<?php 
$pass0 = isset($this->params->pass[0]) ? $this->params->pass[0] : 'tous';
$pass1 = isset($this->params->pass[1]) ? $this->params->pass[1] : 'tous';
$passaction = $this->params->action;
if (count($this->params->data) > 0) :
    $keyword = $this->params->data['Projet']['SEARCH'];
elseif (isset($this->params->pass[2]) && $this->params->pass[2] !=''):
    $keyword = $this->params->pass[2];
elseif (isset($keywords) && $keywords != ''):
    $keyword = $keywords;
else :
    $keyword = '';
endif;    
?>         
        <ul class="nav navbar-nav toolbar">
        <?php if (userAuth('profil_id')!='2' && isAuthorized('projets', 'add')) : ?>
        <li><?php echo $this->Html->link('<span class="glyphicons plus size14 margintop4"></span>', array('action' => 'add'),array('escape' => false)); ?></li>
        <li class="divider-vertical-only"></li>
        <?php endif; ?>
        <li class="dropdown <?php echo filtre_is_actif($pass0,'tous'); ?>">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Filtre Etats <b class="caret"></b></a>
             <ul class="dropdown-menu">
                 <li><?php echo $this->Html->link('Tous', array('action' => $passaction,'tous',$pass1,$keyword),array('class'=>'showoverlay'.subfiltre_is_actif($pass0,'tous'))); ?></li>
                 <li class="divider"></li>
                 <li><?php echo $this->Html->link('Actif', array('action' => $passaction,'actif',$pass1,$keyword),array('class'=>'showoverlay'.subfiltre_is_actif($pass0,'actif'))); ?></li>
                 <li><?php echo $this->Html->link('Inactif', array('action' => $passaction,'inactif',$pass1,$keyword),array('class'=>'showoverlay'.subfiltre_is_actif($pass0,'inactif'))); ?></li>
             </ul>
         </li> 
        <li class="dropdown <?php echo filtre_is_actif($pass1,'tous'); ?>">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Filtre Contrats <b class="caret"></b></a>
             <ul class="dropdown-menu">
             <li><?php echo $this->Html->link('Tous', array('action' => $passaction,$pass0,'tous',$keyword),array('class'=>'showoverlay'.subfiltre_is_actif(isset($this->params->pass[1]) ? $this->params->pass[1] : 'tous','tous'))); ?></li>
             <li class="divider"></li>
                 <?php foreach ($contrats as $contrat): ?>
                    <li><?php echo $this->Html->link($contrat['Contrat']['NOM'], array('action' => $passaction,$pass0,$contrat['Contrat']['id'],$keyword),array('class'=>'showoverlay'.subfiltre_is_actif(isset($this->params->pass[1]) ? $this->params->pass[1] : 'tous',$contrat['Contrat']['NOM']))); ?></li>
                 <?php endforeach; ?>
              </ul>
         </li>                   
        <li class="divider-vertical-only"></li>                
        <li><?php echo $this->Html->link('<span class="ico-xls"></span>', array('action' => 'export_xls'),array('escape' => false)); ?></li>
        </ul> 
        <ul class="nav navbar-nav toolbar pull-right">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle btn-expand" data-toggle="dropdown"><span class="glyphicons expand notchange" style="width:13px;"></span></a>
                <ul class="dropdown-menu" style="left: -205px;min-width: 250px;max-width: 250px;">
                    <li>
                        <?php echo $this->Form->create("Projet",array('url' => array('action' => 'search',$pass0,$pass1), 'class'=>'toolbar-form pull-right','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?>
                            <?php echo $this->Form->input('SEARCH',array('placeholder'=>'Recherche ...','style'=>"width: 200px;margin-left:3px;margin-right:-3px;display: inline-table;",'class'=>"form-control",'value'=>$keyword, 'rel'=>"tooltip", 'data-container'=>"body", 'data-title'=>Configure::read('search_tooltip'))); ?>
                            <button type="submit" class="btn form-btn showoverlay"><span class="glyphicons notchange search"></span></button>
                        <?php echo $this->Form->end(); ?> 
                    </li>
                </ul>
            </li>
        </ul> 
</nav>
<?php if ($this->params['action']=='index') { ?><div class="panel-body panel-filter marginbottom15 "><strong>Filtre appliqué : </strong><em>Liste de <?php echo $fetat; ?> sur <?php echo $fcontrat; ?></em></div><?php } ?>        
<div class="">
<table cellpadding="0" cellspacing="0" class="table table-bordered table-striped table-hover">
<thead>
<tr>
                <th><?php echo $this->Paginator->sort('contrat_id','Contrats'); ?></th>
                <th><?php echo $this->Paginator->sort('NOM','Nom'); ?></th>
                <th><?php echo $this->Paginator->sort('NUMEROGALLILIE','Réf. GALILEI'); ?></th>
                <th width="90px;"><?php echo $this->Paginator->sort('DEBUT','Début'); ?></th>
                <th width="90px;"><?php echo $this->Paginator->sort('FIN','Fin'); ?></th>
                <th width="50px;"><?php echo $this->Paginator->sort('ACTIF','Etat'); ?></th>
                <th width="60px;"><?php echo $this->Paginator->sort('TYPE','Type'); ?></th>
                <th width="60px;"><?php echo $this->Paginator->sort('FACTURATION','Facturation'); ?></th>
                <th class="actions" width="60px;"><?php echo __('Actions'); ?></th>
</tr>
</thead>
<tbody>
<?php if (isset($projets)): ?>
<?php foreach ($projets as $projet): ?>
<tr>
        <td><?php echo h($projet['Contrat']['NOM']); ?>&nbsp;</td>
        <td><?php echo h($projet['Projet']['NOM']); ?>&nbsp;</td>
        <td style="text-align: right;"><?php echo h($projet['Projet']['NUMEROGALLILIE']); ?>&nbsp;</td>
        <td style="text-align: center;"><?php echo h($projet['Projet']['DEBUT']); ?>&nbsp;</td>
        <td style="text-align: center;"><?php echo h($projet['Projet']['FIN']); ?>&nbsp;</td>
        <td style="text-align: center;"><?php echo $projet['Projet']['ACTIF']==1 ? '<span class="glyphicons ok_2"></span>' : ''; ?>&nbsp;</td>
        <td style="text-align: center;"><?php echo h($projet['Projet']['TYPE']); ?>&nbsp;</td>
        <td style="text-align: center;"><?php echo h($projet['Projet']['FACTURATION']); ?>&nbsp;</td>
        <td class="actions">
            <?php if (userAuth('profil_id')!='2' && isAuthorized('projets', 'view')) : ?>
            <?php echo '<span class="glyphicons eye_open" data-rel="popover" data-title="<h3>Projet :</h3>" data-content="<contenttitle>Crée le: </contenttitle>'.h($projet['Projet']['created']).'<br/><contenttitle>Modifié le: </contenttitle>'.h($projet['Projet']['modified']).'" data-trigger="click" style="cursor: pointer;"></span>'; ?>&nbsp;
            <?php endif; ?>
            <?php if (userAuth('profil_id')!='2' && isAuthorized('projets', 'edit')) : ?>
            <?php echo $this->Html->link('<span class="glyphicons pencil showoverlay notchange"></span>', array('action' => 'edit', $projet['Projet']['id']),array('escape' => false)); ?>&nbsp;
            <?php endif; ?>
            <?php if (userAuth('profil_id')!='2' && isAuthorized('projets', 'delete')) : ?>
            <?php echo $this->Form->postLink('<span class="glyphicons bin notchange"></span>', array('action' => 'delete', $projet['Projet']['id']),array('escape' => false), __('Etes-vous certain de vouloir supprimer ce projet ?')); ?>                    
            <?php endif; ?>
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
    $(document).on('keyup','#ProjetSEARCH',function (event){
        var url = "<?php echo $this->webroot;?>projets/search/<?php echo $pass0; ?>/<?php echo $pass1; ?>/";
        $(this).parents('form').attr('action',url+$(this).val());
    });        
});
</script>