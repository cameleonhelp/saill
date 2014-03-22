<nav class="navbar toolbar ">
<?php 
$pass0 = isset($this->params->pass[0]) ? $this->params->pass[0] : 'actif';
$passaction = $this->params->action;
if (count($this->params->data) > 0) :
    $keyword = $this->params->data['Contrat']['SEARCH'];
elseif (isset($this->params->pass[1]) && $this->params->pass[1] !=''):
    $keyword = $this->params->pass[1];
elseif (isset($keywords) && $keywords != ''):
    $keyword = $keywords;
else :
    $keyword = '';
endif;    
?>       
        <ul class="nav navbar-nav toolbar">
        <?php if (userAuth('profil_id')!='2' && isAuthorized('contrats', 'add')) : ?>
        <li><?php echo $this->Html->link('<span class="glyphicons plus size14 margintop4"></span>', array('action' => 'add'),array('escape' => false,'class'=>'showoverlay')); ?></li>
        <li class="divider-vertical-only"></li>
        <?php endif; ?>
        <li class="dropdown <?php echo filtre_is_actif($pass0,'tous'); ?>">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Filtre Etats <b class="caret"></b></a>
             <ul class="dropdown-menu">
                 <li><?php echo $this->Html->link('Tous', array('action' => $passaction,'tous',$keyword),array('class'=>'showoverlay'.subfiltre_is_actif($pass0,'tous'))); ?></li>
                 <li class="divider"></li>
                 <li><?php echo $this->Html->link('Actif', array('action' => $passaction,'actif',$keyword),array('class'=>'showoverlay'.subfiltre_is_actif($pass0,'actif'))); ?></li>
                 <li><?php echo $this->Html->link('Inactif', array('action' => $passaction,'inactif',$keyword),array('class'=>'showoverlay'.subfiltre_is_actif($pass0,'inactif'))); ?></li>
             </ul>
         </li>                 
        </ul> 
        <ul class="nav navbar-nav toolbar pull-right">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle btn-expand" data-toggle="dropdown"><span class="glyphicons expand notchange" style="width:13px;"></span></a>
                <ul class="dropdown-menu" style="left: -205px;min-width: 250px;max-width: 250px;">
                    <li>
                        <?php echo $this->Form->create("Contrat",array('url' => array('action' => 'search',$pass0), 'class'=>'toolbar-form pull-right','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?>
                            <?php echo $this->Form->input('SEARCH',array('placeholder'=>'Recherche ...','style'=>"width: 200px;margin-left:3px;margin-right:-3px;display: inline-table;",'class'=>"form-control",'value'=>$keyword, 'rel'=>"tooltip", 'data-container'=>"body", 'data-title'=>Configure::read('search_tooltip'))); ?>
                            <button type="submit" class="btn form-btn showoverlay"><span class="glyphicons notchange search"></span></button>
                        <?php echo $this->Form->end(); ?> 
                    </li>
                </ul>
            </li>
        </ul>   
</nav>
<?php if ($this->params['action']=='index') { ?><div class="panel-body panel-filter marginbottom15 "><strong>Filtre appliqué : </strong><em>Liste de <?php echo $fcontrat; ?></em></div><?php } ?>        
<div class="">
<table cellpadding="0" cellspacing="0" class="table table-bordered table-striped table-hover">
<thead>
<tr>
                <th><?php echo $this->Paginator->sort('NOM','Nom'); ?></th>
                <th width="60px;"><?php echo $this->Paginator->sort('tjmcontrat_id','TJM moyen'); ?></th>
                <th width="60px;"><?php echo $this->Paginator->sort('ANNEEDEBUT','Début'); ?></th>
                <th width="60px;"><?php echo $this->Paginator->sort('ANNEEFIN','Fin'); ?></th>
                <!--<th><?php echo $this->Paginator->sort('MONTANT','Montant en k€'); ?></th>//-->
                <th width="40px;"><?php echo $this->Paginator->sort('ACTIF','Actif'); ?></th>
                <th class="actions" width="60px;"><?php echo __('Actions'); ?></th>
</tr>
</thead>
<tbody>
<?php if (isset($contrats)): ?>
<?php foreach ($contrats as $contrat): ?>
<tr>
        <td><?php echo h($contrat['Contrat']['NOM']); ?>&nbsp;</td>
        <td style='text-align: center;'><?php echo h($contrat['Tjmcontrat']['TJM']); ?>&nbsp;</td>
        <td style='text-align: center;'><?php echo h($contrat['Contrat']['ANNEEDEBUT']); ?>&nbsp;</td>
        <td style='text-align: center;'><?php echo h($contrat['Contrat']['ANNEEFIN']); ?>&nbsp;</td>
        <!--<td style='text-align: right;'><?php echo h($contrat['Contrat']['MONTANT']); ?> k€&nbsp;</td>//-->
        <td style='text-align: center;'><?php echo $contrat['Contrat']['ACTIF']==1 ? '<span class="glyphicons ok_2"></span>' : ''; ?>&nbsp;</td>
        <td class="actions">
            <?php if (userAuth('profil_id')!='2' && isAuthorized('contrats', 'view')) : ?>
            <?php echo '<span class="glyphicons eye_open" data-rel="popover" data-title="<h3>Contrat :</h3>" data-content="<contenttitle>Crée le: </contenttitle>'.h($contrat['Contrat']['created']).'<br/><contenttitle>Modifié le: </contenttitle>'.h($contrat['Contrat']['modified']).'" data-trigger="click" style="cursor: pointer;"></span>'; ?>&nbsp;
            <?php endif; ?>
            <?php if (userAuth('profil_id')!='2' && isAuthorized('contrats', 'edit')) : ?>        
            <?php echo $this->Html->link('<span class="glyphicons pencil showoverlay notchange"></span>', array('action' => 'edit', $contrat['Contrat']['id']),array('escape' => false,'class'=>'showoverlay')); ?>&nbsp;
            <?php endif; ?>
            <?php if (userAuth('profil_id')!='2' && isAuthorized('contrats', 'delete')) : ?>
            <?php echo $this->Form->postLink('<span class="glyphicons bin notchange"></span>', array('action' => 'delete', $contrat['Contrat']['id']),array('escape' => false), __('Etes-vous certain de vouloir supprimer ce contrat ?')); ?>
            <?php endif; ?>
        </td>
</tr>
<?php endforeach; ?>
<?php endif; ?>
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
    $(document).on('keyup','#ContratSEARCH',function (event){
        var url = "<?php echo $this->webroot;?>contrats/search/<?php echo $pass0; ?>/";
        $(this).parents('form').attr('action',url+$(this).val());
    });       
});
</script>